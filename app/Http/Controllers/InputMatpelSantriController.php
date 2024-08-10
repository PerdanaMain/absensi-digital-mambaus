<?php

namespace App\Http\Controllers;

use App\Exports\MatpelExport;
use App\Exports\SantriSecondExport;
use App\Models\Matpel;
use App\Models\Mengikuti;
use App\Models\Santri;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;

class InputMatpelSantriController extends Controller
{
    public function index()
    {
        $matpels = Matpel::with([
            'kelas',
            "type",
        ])->get();

        $santris = Santri::with([
            'wali',
            'pengurus',
        ])->get();

        $mengikuti = Mengikuti::with([
            'santri',
            'matpel' => [
                'kelas',
                'type',
            ],
        ])->get();
        return view(
            'pages.system.input-matpel',
            compact(
                "matpels",
                "santris",
                "mengikuti"
            )
        );
    }

    public function template()
    {
        return response()->download(Storage::path('public/Santri-Template2.xlsx'));

    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'excelFile' => 'required|mimes:xlsx,xls',
            ]);

            $file = $request->file('excelFile');
            $data = Excel::toCollection(new Mengikuti, $file);

            foreach ($data as $key => $value) {
                foreach ($value as $key => $value) {
                    if ($key == 0) {
                        continue;
                    }
                    Validator::make([
                        'santriId' => $value[0],
                        'matpelId' => $value[1],
                    ], [
                        'santriId' => 'required',
                        'matpelId' => 'required',
                    ])->validate();

                    $check = Mengikuti::where('santriId', $value[0])
                        ->where('matpelId', $value[1])
                        ->first();

                    $santri = Santri::where('santriId', $value[0])->first();
                    $matpel = Matpel::where('matpelId', $value[1])->first();

                    if (!$santri || !$matpel) {
                        continue;
                    }

                    if ($check) {
                        continue;
                    }

                    Mengikuti::create([
                        'santriId' => $value[0],
                        'matpelId' => $value[1],
                    ]);
                }
            }
            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function export(Request $request)
    {
        try {
            $request->validate([
                'jenisId' => 'required',
            ]);

            $jenis = (int) $request->jenisId;
            $format = (int) $request->format;

            $matpels = [];
            $santri = [];

            if ($jenis === 1) {
                $santri = Santri::with([
                    'wali',
                    'pengurus',
                ])->get();

                if ($format === 1) {
                    return Excel::download(new SantriSecondExport($santri), 'Data-Santri.xlsx');
                } else {
                    $pdf = \PDF::loadView('pages.exports.santri-second', compact('santri'))
                        ->setPaper('a4', 'landscape');
                    return $pdf->download('Data-Santri.pdf');
                }
            } else {

                $matpel = Matpel::with([
                    'kelas',
                    'type',
                ])->get();

                if ($format === 1) {
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
                'santriId' => 'required|exists:santris,santriId',
                'matpelId' => 'required|exists:matpels,matpelId',
            ]);
            $mengikuti = Mengikuti::where('santriId', $request->santriId)
                ->where('matpelId', $request->matpelId)
                ->first();

            if ($mengikuti) {
                return back()->with('error', 'Data sudah ada');
            }

            Mengikuti::create([
                'santriId' => $request->santriId,
                'matpelId' => $request->matpelId,
            ]);

            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'santriId' => 'required',
                'matpelId' => 'required',
            ]);

            $check = Mengikuti::where('santriId', (int) $request->santriId)
                ->where("matpelId", (int) $request->matpelId)
                ->first();

            if ($check) {
                return back()->with('error', 'Data sudah ada');
            }

            Mengikuti::where('mengikutiId', $id)->update([
                'santriId' => $request->santriId,
                'matpelId' => $request->matpelId,
            ]);

            return back()->with('success', 'Data berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Mengikuti::where('mengikutiId', $id)->delete();

            return response()->json([
                "status" => true,
                'message' => 'Data berhasil dihapus',
            ])->setStatusCode(200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                'message' => $th->getMessage(),
            ])->setStatusCode(500);
        }
    }
}
