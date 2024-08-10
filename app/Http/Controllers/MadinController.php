<?php

namespace App\Http\Controllers;

use App\Exports\MatpelExport;
use App\Exports\SantriExport;
use App\Models\Absensi;
use App\Models\Matpel;
use App\Models\Mengikuti;
use App\Models\Status;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;

class MadinController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $matpels = Matpel::with([
            'guru',
            'kelas',
            'type',
        ])
            ->where("typeId", 2);

        $statuses = Status::all();
        $absensi = Absensi::with([
            "matpel" => [
                "guru",
                "kelas",
            ],
            "santri",
            "status",
        ])
            ->where("typeId", 2);

        if ($user->roleId == 2) {
            $matpels = $matpels->where("guruId", $user->guru->guruId);
            $absensi = $absensi->whereHas("matpel", function ($query) use ($user) {
                $query->where("guruId", $user->guru->guruId);
            });
        }
        $matpels = $matpels->get();
        $absensi = $absensi->get();
        return view(
            'pages.absensi.madin',
            compact(
                "matpels",
                "statuses",
                "absensi"
            )
        );
    }

    public function apiSantri($id)
    {
        try {
            $mengikuti = Mengikuti::with([
                "santri",
                "matpel",
            ])
                ->where("matpelId", $id)
                ->get();

            if ($mengikuti->isEmpty()) {
                return response()->json([
                    "status" => false,
                    'message' => "Santri tidak ditemukan",
                ])->setStatusCode(404);
            }

            return response()->json([
                "status" => true,
                'data' => $mengikuti,
            ])->setStatusCode(200);

        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function template()
    {
        return response()->download(Storage::path('public/Madin-Template.xlsx'));
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'excelFile' => 'required|mimes:xlsx,xls',
            ]);

            $file = $request->file('excelFile');
            $data = Excel::toCollection(new Absensi, $file);

            foreach ($data as $key => $value) {
                foreach ($value as $key => $value) {
                    if ($key == 0) {
                        continue;
                    }
                    Validator::make([
                        'ID Matpel' => $value[0],
                        'ID Santri' => $value[1],
                        'Kehadiran' => $value[2],
                        "tglAbsensi" => $value[3],
                    ], [
                        'ID Matpel' => 'required',
                        'ID Santri' => 'required',
                        'Kehadiran' => 'required',
                        'tglAbsensi' => 'required',
                    ])->validate();
                    $check = Absensi::with([
                        "matpel",
                        "santri",
                    ])->where([
                        "matpelId" => $value[0],
                        "santriId" => $value[1],
                        "date" => $value[3],
                    ])->first();

                    if ($check) {
                        return back()->with('error', $check->matpel->name . "-" . $check->santri->name . " - " . $check->date . "  " . ', Data absensi sudah ada');
                    }

                    $status = Status::where("name", 'like', '%' . $value[2] . '%')->first();

                    Absensi::create([
                        "matpelId" => $value[0],
                        "santriId" => $value[1],
                        "statusId" => $status->statusId,
                        "typeId" => 2,
                        "date" => $value[3],
                    ]);
                }
            }

            return back()->with('success', 'Data absensi berhasil diimport');
        } catch (\Throwable $th) {

            return back()->with('error', $th->getMessage());
        }
    }

    public function export(Request $request)
    {
        try {
            $request->validate([
                "jenisId" => "required",
                "format" => "required",
            ]);
            $jenis = (int) $request->jenisId;
            $format = (int) $request->format;
            $user = Auth::user();

            if ($jenis == 1) {
                $santri = Mengikuti::with([
                    "santri",
                    "matpel" => [
                        "type",
                        "kelas",
                    ],
                ])
                    ->where("matpelId", $request->matpelId)
                    ->get();

                if ($santri->isEmpty()) {
                    return back()->with('error', 'Data santri tidak ditemukan');
                }

                if ($format == 1) {
                    return Excel::download(new SantriExport($santri), 'Data-Santri.xlsx');
                } else {
                    $pdf = \PDF::loadView('pages.exports.santri', compact('santri'))
                        ->setPaper('a4', 'landscape');

                    return $pdf->download('Data-Santri.pdf');
                }
            } else {
                $matpel = Matpel::with([
                    "guru",
                    "kelas",
                    "type",
                ]);

                if ($user->roleId == 2) {
                    $matpel = $matpel->where("guruId", $user->guru->id);
                }

                $matpel = $matpel->get();

                if ($matpel->isEmpty()) {
                    return back()->with('error', 'Data matpel tidak ditemukan');
                }

                if ($format == 1) {
                    return Excel::download(new MatpelExport($matpel), 'Data-Matpel.xlsx');
                } else {
                    $pdf = \PDF::loadView('pages.exports.matpel', compact('matpel'))
                        ->setPaper('a4', 'landscape');
                    return $pdf->download('Data-Matpel.pdf');
                }
            }

        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                "matpelId" => "required",
                "santriId" => "required",
                "statusId" => "required",
                "tglAbsensi" => "required",
            ]);

            $check = Absensi::where([
                "matpelId" => $request->matpelId,
                "santriId" => $request->santriId,
                "date" => $request->tglAbsensi,
            ])->first();

            if ($check) {
                return back()->with('error', 'Data absensi sudah ada');
            }

            Absensi::create([
                "matpelId" => $request->matpelId,
                "santriId" => $request->santriId,
                "statusId" => $request->statusId,
                "typeId" => 2,
                "date" => $request->tglAbsensi,
                "description" => $request->keterangan,
            ]);

            return back()->with('success', 'Data absensi berhasil disimpan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                "statusId" => "required",
                "tglAbsensi" => "required",
            ]);

            $absensi = Absensi::find($id);

            if (!$absensi) {
                return back()->with('error', 'Data absensi tidak ditemukan');
            }

            $absensi->update([
                "statusId" => $request->statusId,
                "typeId" => 2,
                "date" => $request->tglAbsensi,
                "description" => $request->keterangan,
            ]);

            return back()->with('success', 'Data absensi berhasil diubah');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $absensi = Absensi::find($id);

            if (!$absensi) {
                return response()->json([
                    "status" => false,
                    'message' => 'Data absensi tidak ditemukan',
                ])->setStatusCode(404);
            }

            $absensi->delete();

            return response()->json([
                "status" => true,
                'message' => 'Data absensi berhasil dihapus',
            ])->setStatusCode(200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
