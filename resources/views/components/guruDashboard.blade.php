<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row ">
        <div class="row g-4 mb-4">
            <div class="col-xl-4 mb-4 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-column">
                                <div class="card-title mb-auto">
                                    <h5 class="mb-1 text-nowrap">Personal Statistics</h5>
                                    <small>Monthly Report</small>
                                </div>
                                <div class="chart-statistics">
                                    <h3 class="card-title mb-1">{{ $monthlyReport->count() }}</h3>
                                    <small class="text-success text-nowrap fw-semibold">Total absensi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 mb-4 col-lg-7 col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="card-title mb-0">Statistics</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-6 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                        <i class="ti ti-chart-pie-2 ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ $matpelGuru->count() }}</h5>
                                        <small>Total mata pelajaran yang diikuti</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-info me-3 p-2">
                                        <i class="ti ti-users ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ $santriGuru->count() }}</h5>
                                        <small>Total santri yang mengikuti pelajaran</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row">
            <!-- Last Transaction -->
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-title m-0 me-2">
                            <h5 class="m-0 me-2">Transactions</h5>
                            <small class="text-muted">Total 58 Transactions done in this Month</small>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-3 pb-1 align-items-center">
                                <div class="badge bg-label-primary me-3 rounded p-2">
                                    <i class="ti ti-wallet ti-sm"></i>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Wallet</h6>
                                        <small class="text-muted d-block">Starbucks</small>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0 text-danger">-$75</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-3 pb-1 align-items-center">
                                <div class="badge bg-label-success rounded me-3 p-2">
                                    <i class="ti ti-browser-check ti-sm"></i>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Bank Transfer</h6>
                                        <small class="text-muted d-block">Add Money</small>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0 text-success">+$480</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-3 pb-1 align-items-center">
                                <div class="badge bg-label-danger rounded me-3 p-2">
                                    <i class="ti ti-brand-paypal ti-sm"></i>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Paypal</h6>
                                        <small class="text-muted d-block mb-1">Client Payment</small>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0 text-success">+$268</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-3 pb-1 align-items-center">
                                <div class="badge bg-label-secondary me-3 rounded p-2">
                                    <i class="ti ti-credit-card ti-sm"></i>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Master Card</h6>
                                        <small class="text-muted d-block mb-1">Ordered iPhone 13</small>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0 text-danger">-$699</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-3 pb-1 align-items-center">
                                <div class="badge bg-label-info me-3 rounded p-2">
                                    <i class="ti ti-currency-dollar ti-sm"></i>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Bank Transactions</h6>
                                        <small class="text-muted d-block mb-1">Refund</small>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0 text-success">+$98</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-3 pb-1 align-items-center">
                                <div class="badge bg-label-danger me-3 rounded p-2">
                                    <i class="ti ti-brand-paypal ti-sm"></i>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Paypal</h6>
                                        <small class="text-muted d-block mb-1">Client Payment</small>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0 text-success">+$126</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="badge bg-label-success me-3 rounded p-2">
                                    <i class="ti ti-browser-check ti-sm"></i>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Bank Transfer</h6>
                                        <small class="text-muted d-block mb-1">Pay Office Rent</small>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0 text-danger">-$1290</h6>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Activity Timeline -->
            <div class="col-lg-8">
                <div class="card h-100">
                    <div class="table-responsive card-datatable">
                        <table class="table datatable-invoice border-top" id="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th><i class="ti ti-trending-up"></i></th>
                                    <th>Total</th>
                                    <th>Issued Date</th>
                                    <th>Invoice Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matpelGuru as $matpel)
                                    <tr>
                                        <td></td>
                                        <td>#INV-001</td>
                                        <td><i class="ti ti-arrow-up text-success"></i></td>
                                        <td>$ 1,200</td>
                                        <td>12/12/2021</td>
                                        <td><span class="badge bg-label-success">Paid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="dropdownMenuButton"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="ti ti-more-alt text-muted"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="javascript:void(0);">View</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Print</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Statistics -->
    </div>
</div>
