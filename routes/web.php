<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\InputMatpelSantriController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MadinController;
use App\Http\Controllers\MandiriController;
use App\Http\Controllers\MatpelController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapAbsensiController;
use App\Http\Controllers\RekapIzinController;
use App\Http\Controllers\RekapMandiriController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

/**
 * ==========================================================================================================
 * Route to the home page
 * ==========================================================================================================
 */
Route::get('/', [AuthController::class, 'index'])->name('home');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix("/")->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * =======================================================================================================
     * Route to the Abensi page
     * =======================================================================================================
     */
    Route::prefix("sekolah")->middleware('role:Admin,Guru')->group(function () {
        Route::get('/', [SekolahController::class, 'index'])->name('sekolah.index');
        Route::get("/api-santri/{id}", [SekolahController::class, 'apiSantri'])->name('sekolah.api-santri');
        Route::get("/template", [SekolahController::class, 'template'])->name('sekolah.template');
        Route::post('/', [SekolahController::class, 'store'])->name('sekolah.store');
        Route::post("/import", [SekolahController::class, 'import'])->name('sekolah.import');
        Route::post("/export", [SekolahController::class, 'export'])->name('sekolah.export');
        Route::put("/{id}", [SekolahController::class, 'update'])->name('sekolah.update');
        Route::delete("/{id}", [SekolahController::class, 'destroy'])->name('sekolah.destroy');
    });

    Route::prefix("madin")->middleware("role:Admin,Guru")->group(function () {
        Route::get("/", [MadinController::class, 'index'])->name('madin.index');
        Route::get("/api-santri/{id}", [MadinController::class, 'apiSantri'])->name('madin.api-santri');
        Route::get("/template", [MadinController::class, 'template'])->name('madin.template');
        Route::post("/", [MadinController::class, 'store'])->name('madin.store');
        Route::post("/import", [MadinController::class, 'import'])->name('madin.import');
        Route::post("/export", [MadinController::class, 'export'])->name('madin.export');
        Route::put("/{id}", [MadinController::class, 'update'])->name('madin.update');
        Route::delete("/{id}", [MadinController::class, 'destroy'])->name('madin.destroy');
    });

    Route::prefix("mandiri")->middleware("role:Admin,Pengurus")->group(function () {
        Route::get("/", [MandiriController::class, 'index'])->name('mandiri.index');
        Route::get("/api-santri/{id}", [MandiriController::class, 'apiSantri'])->name('mandiri.api-santri');
        Route::get("/template", [MandiriController::class, 'template'])->name('mandiri.template');
        Route::post("/", [MandiriController::class, 'store'])->name('mandiri.store');
        Route::post("/import", [MandiriController::class, 'import'])->name('mandiri.import');
        Route::post("/export", [MandiriController::class, 'export'])->name('mandiri.export');
        Route::put("/{id}", [MandiriController::class, 'update'])->name('mandiri.update');
        Route::delete("/{id}", [MandiriController::class, 'destroy'])->name('mandiri.destroy');
    });

    Route::prefix("perizinan")->middleware("role:Admin,Pengurus")->group(function () {
        Route::get("/", [SubmissionController::class, 'index'])->name('perizinan.index');
        Route::get("/check/{id}", [SubmissionController::class, 'check'])->name('perizinan.check');
        Route::post("/", [SubmissionController::class, 'store'])->name('perizinan.store');
        Route::put("/update-status/{id}", [SubmissionController::class, 'updateStatus'])->name('perizinan.updateStatus');
        Route::put("/{id}", [SubmissionController::class, 'update'])->name('perizinan.update');
        Route::delete("/{id}", [SubmissionController::class, 'destroy'])->name('perizinan.destroy');
    });

    /**
     * =======================================================================================================
     * Route to the Rekap page
     * =======================================================================================================
     */
    Route::prefix("rekap-absensi")->middleware("role:Admin,Guru,Wali Santri")->group(function () {
        Route::get("/", [RekapAbsensiController::class, 'index'])->name('rekapAbsensi.index');
        Route::post("/export", [RekapAbsensiController::class, 'export'])->name('rekapAbsensi.export');
    });

    Route::prefix("rekap-mandiri")->middleware("role:Admin,Pengurus,Wali Santri")->group(function () {
        Route::get("/", [RekapMandiriController::class, 'index'])->name('rekapMandiri.index');
        Route::post("/export", [RekapMandiriController::class, 'export'])->name('rekapMandiri.export');
    });

    Route::prefix("rekap-perizinan")->middleware("role:Admin,Pengurus,Wali Santri")->group(function () {
        Route::get("/", [RekapIzinController::class, 'index'])->name('rekapPerizinan.index');
        Route::post("/export", [RekapIzinController::class, 'export'])->name('rekapPerizinan.export');
    });

    /**
     * =======================================================================================================
     * Route to the Admin page
     * =======================================================================================================
     */
    Route::prefix("guru")->middleware('role:Admin')->group(function () {
        Route::get('/', [GuruController::class, 'index'])->name('guru.index');
        Route::get("/template", [GuruController::class, 'template'])->name('guru.template');
        Route::post('/', [GuruController::class, 'store'])->name('guru.store');
        Route::post("/import", [GuruController::class, 'import'])->name('guru.import');
        Route::put("/{id}", [GuruController::class, 'update'])->name('guru.update');
        Route::delete("/{id}", [GuruController::class, 'destroy'])->name('guru.destroy');
    });

    Route::prefix("/pengurus")->middleware('role:Admin')->group(function () {
        Route::get('/', [PengurusController::class, 'index'])->name('pengurus.index');
        Route::get("/template", [PengurusController::class, 'template'])->name('pengurus.template');
        Route::post('/', [PengurusController::class, 'store'])->name('pengurus.store');
        Route::post("/import", [PengurusController::class, 'import'])->name('pengurus.import');
        Route::put("/{id}", [PengurusController::class, 'update'])->name('pengurus.update');
        Route::delete("/{id}", [PengurusController::class, 'destroy'])->name('pengurus.destroy');
    });

    Route::prefix("santri")->middleware('role:Admin')->group(function () {
        Route::get('/', [SantriController::class, 'index'])->name('santri.index');
        Route::get("/template", [SantriController::class, 'template'])->name('santri.template');
        Route::post('/', [SantriController::class, 'store'])->name('santri.store');
        Route::post("/import", [SantriController::class, 'import'])->name('santri.import');
        Route::put("/{id}", [SantriController::class, 'update'])->name('santri.update');
        Route::delete("/{id}", [SantriController::class, 'destroy'])->name('santri.destroy');
    });

    Route::prefix("matpel")->middleware("role:Admin")->group(function () {
        Route::get("/", [MatpelController::class, 'index'])->name('matpel.index');
        Route::get("/template", [MatpelController::class, 'template'])->name('matpel.template');
        Route::post("/", [MatpelController::class, 'store'])->name('matpel.store');
        Route::post("/import", [MatpelController::class, 'import'])->name('matpel.import');
        Route::put("/{id}", [MatpelController::class, 'update'])->name('matpel.update');
        Route::delete("/{id}", [MatpelController::class, 'destroy'])->name('matpel.destroy');
    });

    Route::prefix("input-matpel-santri")->middleware("role:Admin")->group(function () {
        Route::get("/", [InputMatpelSantriController::class, 'index'])->name('inputMatpelSantri.index');
        Route::get("/template", [InputMatpelSantriController::class, 'template'])->name('inputMatpelSantri.template');
        Route::post("/import", [InputMatpelSantriController::class, 'import'])->name('inputMatpelSantri.import');
        Route::post("/export", [InputMatpelSantriController::class, 'export'])->name('inputMatpelSantri.export');
        Route::post("/", [InputMatpelSantriController::class, 'store'])->name('inputMatpelSantri.store');
        Route::put("/{id}", [InputMatpelSantriController::class, 'update'])->name('inputMatpelSantri.update');
        Route::delete("/{id}", [InputMatpelSantriController::class, 'destroy'])->name('inputMatpelSantri.destroy');
    });

    Route::prefix("kelas")->middleware("role:Admin")->group(function () {
        Route::get("/", [KelasController::class, 'index'])->name('kelas.index');
        Route::get("/template", [KelasController::class, 'template'])->name('kelas.template');
        Route::post("/", [KelasController::class, 'store'])->name('kelas.store');
        Route::post("/import", [KelasController::class, 'import'])->name('kelas.import');
        Route::put("/{id}", [KelasController::class, 'update'])->name('kelas.update');
        Route::delete("/{id}", [KelasController::class, 'destroy'])->name('kelas.destroy');
    });

    /**
     * =======================================================================================================
     * Route to the Profile page
     * =======================================================================================================
     */

    Route::prefix("profile")->group(function () {
        Route::get("/", [ProfileController::class, 'index'])->name('profile.index');
        Route::put("/{id}", [ProfileController::class, 'update'])->name('profile.update');
        Route::put("/change-password/{id}", [ProfileController::class, 'updatePassword'])->name('profile.changePassword');
    });
});
