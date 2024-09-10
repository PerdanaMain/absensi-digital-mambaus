<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Models\Absensi;
use App\Models\Matpel;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;

class RekapAbsensiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $matpel = Matpel::with([
            "guru",
            "kelas",
            "type",
        ]);
        $absensi = Absensi::with([
            "santri" => [
                "wali",
            ],
            "matpel" => [
                "guru",
                "kelas",
            ],
            "status",
            "type",
        ])->where("typeId", "!=", 3);

        if ($user->roleId == 2) {
            $absensi = $absensi->whereHas("matpel", function ($query) use ($user) {
                $query->where("guruId", $user->guru->guruId);
            });

            $matpel = $matpel->where("guruId", $user->guru->guruId);
        } else if ($user->roleId == 4) {
            $absensi = $absensi->whereHas("santri", function ($query) use ($user) {
                $query->where("waliId", $user->wali->waliId);
            });

            $matpel = $matpel->whereHas("absensi", function ($query) use ($user) {
                $query->whereHas("santri", function ($query) use ($user) {
                    $query->where("waliId", $user->wali->waliId);
                });
            });
        }

        $absensi = $absensi
            ->orderBy('date', 'desc')
            ->get();

        $matpel = $matpel->get();

        return view(
            'pages.rekap.absensi',
            compact(
                'absensi',
                "matpel"
            )
        );
    }

    public function export(Request $request)
    {
        try {
            $request->validate([
                'format' => 'required',
            ]);
            $user = auth()->user();
            $format = (int) $request->format;
            $matpel = $request->matpel_id != null ? (int) $request->matpel_id : null;

            $absensi = Absensi::with([
                "santri" => [
                    "wali",
                ],
                "matpel" => [
                    "guru",
                    "kelas",
                ],
                "status",
                "type",
            ])->where("typeId", "!=", 3);

            if ($user->roleId == 2) {
                $absensi = $absensi->whereHas("matpel", function ($query) use ($user) {
                    $query->where("guruId", $user->guru->guruId);
                });
            } else if ($user->roleId == 4) {
                $absensi = $absensi->whereHas("santri", function ($query) use ($user) {
                    $query->where("waliId", $user->wali->waliId);
                });
            }

            if ($matpel != null) {
                $absensi = $absensi->where("matpelId", $matpel);
            }

            if ($request->tglMulai != null && $request->tglAkhir != null) {
                $absensi = $absensi->whereBetween('date', [$request->tglMulai, $request->tglAkhir]);
            } else if ($request->tglMulai != null) {
                $absensi = $absensi->where('date', '>=', $request->tglMulai);
            } else if ($request->tglAkhir != null) {
                $absensi = $absensi->where('date', '<=', $request->tglAkhir);
            }

            $absensi = $absensi
                ->orderBy('date', 'desc')
                ->get();

            if ($absensi->isEmpty()) {
                return back()->with('error', 'Data not found');
            }

            if ($format == 1) {
                return Excel::download(new AbsensiExport($absensi), 'Absensi.xlsx');
            } else {
                $pdf = \PDF::loadView('pages.exports.absensi', compact('absensi'))
                    ->setPaper('a4', 'landscape');

                return $pdf->download('Absensi.pdf');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
