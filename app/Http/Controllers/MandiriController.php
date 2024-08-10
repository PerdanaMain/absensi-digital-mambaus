<?php

namespace App\Http\Controllers;

use App\Exports\SantriSecondExport;
use App\Models\Absensi;
use App\Models\Santri;
use App\Models\Status;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;

class MandiriController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $statuses = Status::all();
        $santri = Santri::with([
            "pengurus",
        ]);

        $absensi = Absensi::with([
            "santri" => [
                "pengurus",
            ],
            "status",
        ])->where("typeId", 3);

        if ($user->roleId == 3) {
            $santri = $santri->where("pengurusId", $user->pengurus->pengurusId);
            $absensi = $absensi->whereHas("santri", function ($query) use ($user) {
                $query->where("pengurusId", $user->pengurus->pengurusId);
            });
        }

        $santri = $santri->get();
        $absensi = $absensi->get();

        return view(
            'pages.absensi.mandiri',
            compact(
                "santri",
                "statuses",
                "absensi"
            )
        );
    }
    public function template()
    {
        return response()->download(Storage::path('public/Mandiri-Template-New.xlsx'));
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
                        'ID Santri' => $value[0],
                        'Deskripsi' => $value[1],
                        "Kehadiran" => $value[2],
                        "tglAbsensi" => $value[3],
                    ], [
                        'ID Santri' => 'required',
                        'Deskripsi' => 'required',
                        'Kehadiran' => 'required',
                        'tglAbsensi' => 'required',
                    ])->validate();

                    $check = Absensi::with([
                        "matpel",
                        "santri",
                    ])->where([
                        "santriId" => $value[1],
                        "description" => $value[2],
                        "date" => $value[3],
                    ])->first();

                    if ($check) {
                        return back()->with('error', $check->santri->name . "-" . $check->description . " - " . $check->date . "  " . ', Data absensi sudah ada');
                    }

                    $status = Status::where("name", 'like', '%' . $value[2] . '%')->first();

                    Absensi::create([
                        "santriId" => $value[0],
                        "description" => $value[1],
                        "statusId" => $status->statusId,
                        "typeId" => 3,
                        "date" => $value[3],
                    ]);
                }
            }

            return back()->with('success', 'Data berhasil diimport');
        } catch (\Throwable $th) {
            return bacK()->with('error', $th->getMessage());
        }
    }

    public function export(Request $request)
    {
        try {
            $request->validate([
                "format" => "required",
            ]);
            $format = (int) $request->format;
            $user = Auth::user();

            $santri = Santri::with([
                "pengurus",
                "wali",
            ]);

            if ($user->roleId == 3) {
                $santri = $santri->where("pengurusId", $user->pengurus->pengurusId);
            }

            $santri = $santri->get();

            if ($santri->isEmpty()) {
                return back()->with('error', 'Data santri tidak ditemukan');
            }

            if ($format == 1) {
                return Excel::download(new SantriSecondExport($santri), 'Data-Santri.xlsx');
            } else {
                $pdf = \PDF::loadView('pages.exports.santri-second', compact('santri'))
                    ->setPaper('a4', 'landscape');

                return $pdf->download('Data-Santri.pdf');
            }

        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                "santriId" => "required",
                "description" => "required",
                "statusId" => "required",
                "tglAbsensi" => "required",
            ]);

            $check = Absensi::where([
                "santriId" => $request->santriId,
                "description" => $request->description,
                "date" => $request->tglAbsensi,
            ])->first();

            if ($check) {
                return back()->with('error', 'Data absensi sudah ada');
            }

            Absensi::create([
                "santriId" => $request->santriId,
                "description" => $request->description,
                "statusId" => $request->statusId,
                "typeId" => 3,
                "date" => $request->tglAbsensi,
            ]);

            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                "santriId" => "required",
                "description" => "required",
                "statusId" => "required",
                "tglAbsensi" => "required",
            ]);

            $absensi = Absensi::find($request->id);

            if (!$absensi) {
                return back()->with('error', 'Data absensi tidak ditemukan');
            }

            $absensi->update([
                "santriId" => (int) $request->santriId,
                "description" => $request->description,
                "statusId" => (int) $request->statusId,
                "date" => $request->tglAbsensi,
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
                return back()->with('error', 'Data absensi tidak ditemukan');
            }

            $absensi->delete();

            return response()->json([
                "status" => true,
                "message" => "Data berhasil dihapus",
            ])->setStatusCode(200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
            ])->setStatusCode(500);
        }
    }
}
