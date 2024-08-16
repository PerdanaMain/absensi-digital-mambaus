<?php

namespace App\Http\Controllers;

use App\Exports\IzinExport;
use App\Models\Permission;
use App\Models\Santri;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;

class RekapIzinController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $santri = Santri::with([
            "pengurus",
        ]);

        $permissions = Permission::with([
            "santri" => [
                "pengurus",
            ],
        ]);

        if ($user->roleId == 3) {
            $santri = $santri->where("pengurusId", $user->pengurus->pengurusId);
            $permissions = $permissions->whereHas("santri", function ($query) use ($user) {
                $query->where("pengurusId", $user->pengurus->pengurusId);
            });
        }

        $santri = $santri->get();
        $permissions = $permissions->orderBy('permissionId', 'desc')->get();

        return view(
            'pages.rekap.izin',
            compact(
                "santri",
                "permissions"
            )
        );
    }

    public function export(Request $request)
    {
        try {
            $request->validate([
                "format" => "required",
            ]);

            $user = Auth::user();
            $format = (int) $request->format;
            $tglMulai = $request->tglMulai;
            $tglAkhir = $request->tglAkhir;

            $permissions = Permission::with([
                "santri" => [
                    "pengurus",
                    "wali",
                ],
            ]);

            if ($user->roleId == 3) {
                $permissions = $permissions->whereHas("santri", function ($query) use ($user) {
                    $query->where("pengurusId", $user->pengurus->pengurusId);
                });
            } else if ($user->roleId == 4) {
                $permissions = $permissions->whereHas("santri", function ($query) use ($user) {
                    $query->where("waliId", $user->wali->waliId);
                });
            }

            if ($tglAkhir != null && $tglMulai != null) {
                $permissions = $permissions->whereBetween('tglKeluar', [$tglMulai, $tglAkhir]);
            } else if ($tglAkhir != null) {
                $permissions = $permissions->where('tglKeluar', '<=', $tglAkhir);
            } else if ($tglMulai != null) {
                $permissions = $permissions->where('tglKeluar', '>=', $tglMulai);
            }

            $permissions = $permissions->orderBy('permissionId', 'desc')->get();

            if ($permissions->isEmpty()) {
                return back()->with('error', 'Data tidak ditemukan');
            }

            if ($format == 1) {
                return Excel::download(new IzinExport($permissions), 'Perizinan.xlsx');
            } else {
                $pdf = \PDF::loadView('pages.exports.izin', compact('permissions'))
                    ->setPaper('a4', 'landscape');

                return $pdf->download('Perizinan.pdf');
            }

        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
