@extends('layouts.app')

@section('title', 'Laporan Perizinan')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Data Laporan Perizinan</h4>

        <div class="d-block">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exportModal">Export</button>
        </div>

        <!-- Export -->
        <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('rekapPerizinan.export') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exportModalLabel">Export Data Perizinan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="tglMulai" class="form-label">Tanggal Mulai</label>
                                        <input type="text" class="form-control" placeholder="YYYY-MM-DD"
                                            id="flatpickr-date" name="tglMulai" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12" id="exportMatpel">
                                    <div class="mb-3">
                                        <label for="tglAkhir" class="form-label">Tanggal Akhir</label>
                                        <input type="text" class="form-control" placeholder="YYYY-MM-DD"
                                            id="flatpickr-date" name="tglAkhir" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Format<span
                                                style="color:red">*</span></label>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label class="form-check-label custom-option-content"
                                                    for="customRadioTemp2">
                                                    <input name="format" class="form-check-input" type="radio"
                                                        value="1" id="customRadioTemp2" name="format" checked />
                                                    <span class="custom-option-header">
                                                        <span class="fw-medium">Excel</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label class="form-check-label custom-option-content"
                                                    for="customRadioTemp2">
                                                    <input name="format" class="form-check-input" type="radio"
                                                        value="2" id="customRadioTemp2" name="format" />
                                                    <span class="custom-option-header">
                                                        <span class="fw-medium">Pdf</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Alasan Perizinan</th>
                        <th>Nama Santri</th>
                        <th>Tanggal Keluar</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Bukti Pendukung</th>
                        <th>Pengurus</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($permissions as $key => $p)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td style="world-wrap:break-world;">{{ $p->description }}</td>
                            <td style="world-wrap:break-world;">{{ $p->santri->name }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $p->tglKeluar)->locale('id-ID')->translatedFormat('d F Y') }}
                            </td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $p->tglKembali)->locale('id-ID')->translatedFormat('d F Y') }}
                            </td>
                            <td>
                                @if ($p->isComback)
                                    <span class="badge rounded-pill bg-success">Sudah Kembali</span>
                                @else
                                    <span class="badge rounded-pill bg-warning">Belum Kembali</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($p->file !== null)
                                    <button class="btn btn-primary" id="bukti-permission"
                                        data-file="{{ $p->file }}">Bukti</button>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $p->santri->pengurus->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on("click", "#bukti-permission", function() {
            let file = $(this).data("file");
            Swal.fire({
                imageUrl: `/storage/bukti/${file}`,
                imageWidth: 800,
                imageHeight: 800,
                imageAlt: "A tall image"
            });
        })
    </script>
@endpush
