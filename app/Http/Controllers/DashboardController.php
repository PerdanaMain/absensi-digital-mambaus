<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Pengurus;
use App\Models\Permission;
use App\Models\Santri;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $countGuru = Guru::count();
        $countSantri = Santri::count();
        $countPengurus = Pengurus::count();

        $santriKeluar = Permission::where('isComback', false)->count();
        $santriKembali = Permission::where('isComback', true)->count();

        $latestPermissions = Permission::with([
            "santri" => [
                "pengurus",
            ],
        ])
            ->latest()->take(3)->get();

        $sekolah = [];
        $madin = [];
        $mandiri = [];

        for ($month = 1; $month <= 12; $month++) {
            $start = Carbon::create(null, $month, 1)->startOfMonth();
            $end = Carbon::create(null, $month, 1)->endOfMonth();

            $sekolah[$start->format('F')] = Absensi::whereBetween('created_at', [$start, $end])
                ->where('typeId', 1)
                ->count();

            $madin[$start->format('F')] = Absensi::whereBetween('created_at', [$start, $end])
                ->where('typeId', 2)
                ->count();

            $mandiri[$start->format('F')] = Absensi::whereBetween('created_at', [$start, $end])
                ->where('description', "!=", null)
                ->count();
        }

        $chartData = [
            "labels" => array_keys($sekolah),
            "sekolah" => array_values($sekolah),
            "madin" => array_values($madin),
            "mandiri" => array_values($mandiri),
        ];

        $countAbsensi = Absensi::count();
        $countSekolah = Absensi::where('typeId', 1)->count();
        $countMadin = Absensi::where('typeId', 2)->count();
        $countMandiri = Absensi::where('description', "!=", null)->count();

        $santri = [];
        $sekolahInfo = [];
        $madinInfo = [];
        $mandiriInfo = [];

        if ($user->roleId == 4) {
            $santri = Santri::with([
                "permissions",
                "pengurus",
                "absensis",
            ])->where('waliId', $user->wali->waliId)->first();

            $sekolahInfo = [
                "total" => $santri->absensis->where('typeId', 1)->count(),
                "hadir" => $santri->absensis->where('typeId', 1)->where('statusId', 1)->count(),
                "izinDanSakit" => $santri->absensis->where('typeId', 1)->where('statusId', 2)->count() + $santri->absensis->where('typeId', 1)->where('statusId', 3)->count(),
                "tdkHadir" => $santri->absensis->where('typeId', 1)->where('statusId', 4)->count(),
            ];

            $madinInfo = [
                "total" => $santri->absensis->where('typeId', 2)->count(),
                "hadir" => $santri->absensis->where('typeId', 2)->where('statusId', 1)->count(),
                "izinDansakit" => $santri->absensis->where('typeId', 2)->where('statusId', 2)->count() + $santri->absensis->where('typeId', 2)->where('statusId', 3)->count(),
                "tdkHadir" => $santri->absensis->where('typeId', 2)->where('statusId', 4)->count(),
            ];

            $mandiriInfo = [
                "total" => $santri->absensis->where('description', "!=", null)->count(),
                "hadir" => $santri->absensis->where('description', "!=", null)->where('statusId', 1)->count(),
                "izinDanSakit" => $santri->absensis->where('description', "!=", null)->where('statusId', 2)->count() + $santri->absensis->where('description', "!=", null)->where('statusId', 3)->count(),
                "tdkHadir" => $santri->absensis->where('description', "!=", null)->where('statusId', 4)->count(),
            ];
        }

        return view(
            'pages.dashboard',
            compact(
                "user",
                "countGuru",
                "countSantri",
                "countPengurus",
                "santriKeluar",
                "santriKembali",
                "latestPermissions",
                "chartData",
                "countAbsensi",
                "countSekolah",
                "countMadin",
                "countMandiri",
                "santri",
                "sekolahInfo",
                "madinInfo",
                "mandiriInfo"
            )
        );
    }
}
