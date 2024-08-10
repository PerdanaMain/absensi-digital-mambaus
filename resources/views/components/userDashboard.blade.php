<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-4 mb-4">
        <div class="row mt-4">
            <div class="col-12">
                <h5 class="fw-bold">Nama Santri:
                    <span class="text-muted">{{ $santri->name ?? null }}</span>
                </h5>
            </div>
            <div class="col-12">
                <h5 class="fw-bold">Pengurus : <span class="text-muted">{{ $santri->pengurus->name ?? null }}</span>
                </h5>
            </div>
        </div>

        <!-- Statistics -->
        <div class="col-xl-6 mb-4 col-lg-6 col-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0">Statistik Santri</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <h6 class="text-bold">Absensi Sekolah</h6>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $sekolahInfo['total'] ?? null }}</h5>
                                    <small>Total Absensi Sekolah</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-info me-3 p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $sekolahInfo['hadir'] ?? null }}</h5>
                                    <small>Total Hadir</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">
                                        {{ $sekolahInfo['izinDanSakit'] ?? null }}
                                    </h5>
                                    <small>Total Izin dan Sakit</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $sekolahInfo['tdkHadir'] ?? null }}</h5>
                                    <small>Total Tidak Hadir</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 mb-4 col-lg-6 col-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0">Statistik Santri</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <h6 class="text-bold">Absensi Madin</h6>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $madinInfo['total'] ?? null }}</h5>
                                    <small>Total Absensi Madin</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-info me-3 p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $madinInfo['hadir'] ?? null }}</h5>
                                    <small>Total Hadir</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $madinInfo['izinDanSakit'] ?? null }}
                                    </h5>
                                    <small>Total Izin dan Sakit</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $madinInfo['tdkHadir'] ?? null }}</h5>
                                    <small>Total Tidak Hadir</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 mb-4 col-lg-12 col-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0">Statistik Santri</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <h6 class="text-bold">Absensi Kegiatan Mandiri / Malam</h6>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $mandiriInfo['total'] ?? null }}</h5>
                                    <small>Total Absensi</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-info me-3 p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $mandiriInfo['hadir'] ?? null }}</h5>
                                    <small>Total Hadir</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $mandiriInfo['izinDanSakit'] ?? null }}</h5>
                                    <small>Total Izin dan Sakit</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $mandiriInfo['tdkHadir'] ?? null }}</h5>
                                    <small>Total Tidak Hadir</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Statistics -->
    </div>
</div>
