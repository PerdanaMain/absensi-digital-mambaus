<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Guru</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{ $countGuru }}</h4>
                            </div>
                            <span>Total Pengguna</span>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="ti ti-user ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Pengurus</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{ $countPengurus }}</h4>
                            </div>
                            <span>Total Pengguna</span>
                        </div>
                        <span class="badge bg-label-danger rounded p-2">
                            <i class="ti ti-user-plus ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Santri</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{ $countSantri }}</h4>
                            </div>
                            <span>Total Pengguna</span>
                        </div>
                        <span class="badge bg-label-success rounded p-2">
                            <i class="ti ti-user-check ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <div class="card-title">
                        <h5 class="mb-0">Statistik Absensi</h5>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
                    <div class="card-title mb-0">
                        <h5 class="mb-0">Statistik Absensi</h5>
                    </div>
                    <!-- </div> -->
                </div>
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-12 col-md-12 d-flex flex-column align-self-end">
                            <div class="d-flex gap-2 align-items-center mb-2 pb-1 flex-wrap">
                                <h1 class="mb-0">{{ $countAbsensi }}</h1>
                                <div class="badge rounded bg-label-success">Data Absensi</div>
                            </div>
                            <small class="text-muted">
                                Data absensi santri yang telah diinputkan
                            </small>
                        </div>
                    </div>
                    <div class="border rounded p-3 mt-2">
                        <div class="row gap-4 gap-sm-0">
                            <div class="col-12 col-sm-4">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="badge rounded bg-label-primary p-1">
                                        <i class="ti ti-currency-dollar ti-sm"></i>
                                    </div>
                                    <h6 class="mb-0">Sekolah</h6>
                                </div>
                                <h4 class="my-2 pt-1">{{ $countSekolah }}</h4>
                                <span class="text-muted">Total Data</span>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="badge rounded bg-label-info p-1"><i class="ti ti-chart-pie-2 ti-sm"></i>
                                    </div>
                                    <h6 class="mb-0">Madin</h6>
                                </div>
                                <h4 class="my-2 pt-1">{{ $countMadin }}</h4>
                                <span class="text-muted">Total Data</span>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="badge rounded bg-label-danger p-1">
                                        <i class="ti ti-brand-paypal ti-sm"></i>
                                    </div>
                                    <h6 class="mb-0">Mandiri</h6>
                                </div>
                                <h4 class="my-2 pt-1">{{ $countMandiri }}</h4>
                                <span class="text-muted">Total Data</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 mb-4 col-lg-6 col-12">
            <div class="row" style="margin-left: 0px;">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title mb-0">Perizinan Santri</h5>
                        <small class="text-muted">Rekapitulasi Perizinan</small>
                    </div>
                    <div class="card-body">
                        <div id="profitLastMonth"></div>
                        <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                            <h4 class="mb-0">{{ $santriKembali }}</h4>
                            <small class="text-success">Santri Kembali</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-left: 0px; margin-top:33px;">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title mb-0">Perizinan Santri</h5>
                        <small class="text-muted">Rekapitulasi Perizinan</small>
                    </div>
                    <div class="card-body">
                        <div id="profitLastMonth"></div>
                        <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                            <h4 class="mb-0">{{ $santriKeluar }}</h4>
                            <small class="text-danger">Santri Keluar</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title m-0 me-2 pt-1 mb-2">Log Perizinan</h5>
                </div>
                <div class="card-body pb-0">
                    <ul class="timeline ms-1 mb-0">
                        @foreach ($latestPermissions as $key => $lp)
                            <li class="timeline-item timeline-item-transparent ps-4">
                                @if ($key == 0)
                                    <span class="timeline-point timeline-point-primary"></span>
                                @elseif ($key == 1)
                                    <span class="timeline-point timeline-point-danger"></span>
                                @else
                                    <span class="timeline-point timeline-point-success"></span>
                                @endif
                                <div class="timeline-event">
                                    <div class="timeline-header">
                                        <h6 class="mb-0">
                                            {{ $lp->santri->name . ' - ' . $lp->santri->pengurus->name }}
                                        </h6>
                                        <small class="text-muted">
                                            {{ $lp->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <p class="mb-2">{{ $lp->description }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
