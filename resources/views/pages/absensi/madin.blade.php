@extends('layouts.app')

@section('title', 'Absensi Madin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Data Absensi Madin</h4>

        <div class="d-block">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exportModal">
                Export
            </button>
        </div>

        <!-- Modal Tambah-->
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('madin.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahModalLabel">Tambah Data Absensi Madin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Mata Pelajaran<span
                                                style="color:red">*</span></label>
                                        <select name="matpelId" id="matpelId" class="form-select select2">
                                            <option selected hidden>=== Pilih Mata Pelajaran ===</option>
                                            @foreach ($matpels as $m)
                                                <option value="{{ $m->matpelId }}">
                                                    {{ $m->name . ' - ' . $m->type->name . ' - ' . $m->kelas->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="santriId" class="form-label">Nama Santri <span
                                                style="color:red">*</span></label>
                                        <select name="santriId" id="santriId" class="form-select select2">
                                        </select>
                                        <span id="response-msg" style="color:red;font-style:italic;"></span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="statusId" class="form-label">Kehadiran <span
                                                style="color:red">*</span></label>
                                        <select name="statusId" id="statusId" class="form-select select2">
                                            <option selected hidden>=== Pilih Kehadiran ===</option>
                                            @foreach ($statuses as $s)
                                                <option value="{{ $s->statusId }}">
                                                    {{ $s->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="flatpickr-date" class="form-label">Tanggal <span
                                                style="color:red">*</span></label>
                                        <input type="text" class="form-control" placeholder="YYYY-MM-DD"
                                            id="flatpickr-date" name="tglAbsensi" />
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Modal Import-->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('madin.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="importModalLabel">Import Data Absensi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="File">File (xlsx,xls) <span style="color:red">*</span></label>
                                        <input type="file" name="excelFile" id="excelFile" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <a role="button" href="{{ route('madin.template') }}"
                                            class="btn btn-warning">Download Template</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Export -->
        <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ url('/madin/export') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exportModalLabel">Export Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Jenis Export<span
                                                style="color:red">*</span></label>
                                        <select name="jenisId" id="jenisId" class="form-select select2">
                                            <option selected hidden>=== Pilih Jenis ===</option>
                                            <option value="1">Export Data Santri</option>
                                            <option value="2">Export Data Mata Pelajaran</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12" id="exportMatpel">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Siswa Mengikuti Mata Pelajaran<span
                                                style="color:red">*</span></label>
                                        <select name="matpelId" id="matpelId" class="form-select select2">
                                            <option selected hidden>=== Pilih Mata Pelajaran ===</option>
                                            @foreach ($matpels as $m)
                                                <option value="{{ $m->matpelId }}">
                                                    {{ $m->name . ' - ' . $m->type->name . ' - ' . $m->kelas->name }}
                                                </option>
                                            @endforeach
                                        </select>
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
                            <button type="submit" class="btn btn-primary">Save</button>
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
                        <th>Nama Santri</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Tipe</th>
                        <th>Kehadiran</th>
                        <th>Tanggal</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($absensi as $key => $a)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $a->santri->name }}</td>
                            <td>{{ $a->matpel->name . ' - ' . $a->matpel->kelas->name }}</td>
                            <td>{{ $a->type->name }}</td>
                            <td>{{ $a->status->name }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $a->date)->locale('id-ID')->translatedFormat('d F Y') }}
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#updateModal{{ $a->absensiId }}"><i
                                                class="ti ti-pencil me-1"></i>Edit</button>
                                        <button class="dropdown-item" id="delete-absensi"
                                            data-id="{{ $a->absensiId }}"><i class="ti ti-trash me-1"></i>Delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Update-->
                        <div class="modal fade" id="updateModal{{ $a->absensiId }}" tabindex="-1"
                            aria-labelledby="updateModal{{ $a->absensiId }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('madin.update', ['id' => $a->absensiId]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModal{{ $a->absensiId }}Label">Update Data
                                                Absensi Madin</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Mata Pelajaran<span
                                                                style="color:red">*</span></label>
                                                        <select name="matpelId" id="matpelId" class="form-select"
                                                            disabled>
                                                            <option selected hidden value="{{ $a->matpelId }}">
                                                                {{ $a->matpel->name . ' - ' . $a->matpel->kelas->name }}
                                                            </option>
                                                            @foreach ($matpels as $m)
                                                                <option value="{{ $m->matpelId }}">
                                                                    {{ $m->name . ' - ' . $m->type->name . ' - ' . $m->kelas->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="santriId" class="form-label">Nama Santri <span
                                                                style="color:red">*</span></label>
                                                        <select name="santriId" id="santriId"
                                                            class="form-select"disabled>
                                                            <option selected hidden value="{{ $a->santriId }}">
                                                                {{ $a->santri->name }}</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="statusId" class="form-label">Kehadiran <span
                                                                style="color:red">*</span></label>
                                                        <select name="statusId" id="statusId" class="form-select">
                                                            <option selected hidden value="{{ $a->statusId }}">
                                                                {{ $a->status->name }}</option>
                                                            @foreach ($statuses as $s)
                                                                <option value="{{ $s->statusId }}">
                                                                    {{ $s->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="flatpickr-date" class="form-label">Tanggal <span
                                                                style="color:red">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="YYYY-MM-DD" id="flatpickr-date"
                                                            name="tglAbsensi" value="{{ $a->date }}" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#exportMatpel").hide();
        });

        $(document).on("change", "#matpelId", function() {
            let matpelId = $(this).val();
            if (matpelId) {
                $("#santriId").empty();
                $("#response-msg").text("");
                $.ajax({
                    type: "GET",
                    url: "/madin/api-santri/" + matpelId,
                    success: function(res) {
                        $("#response-msg").text("");
                        if (res) {
                            $("#santriId").empty();
                            $("#santriId").append(
                                '<option selected hidden>=== Pilih Santri ===</option>');
                            $.each(res.data, function(key, value) {
                                $("#santriId").append('<option value="' + value.santriId +
                                    '">' + value.santri.name +
                                    '</option>');
                            });
                        } else {
                            $("#santriId").empty();
                        }
                    },
                    error: function(err) {
                        $("#response-msg").text("*" + err.responseJSON.message);
                    }
                });
            } else {
                $("#santriId").empty();
            }
        });

        $(document).on("change", "#jenisId", function() {
            let jenisId = $(this).val();
            if (jenisId == 1) {
                $("#exportMatpel").show();
            } else {
                $("#exportMatpel").hide();
            }
        });

        $(document).on("click", "#delete-absensi", function() {
            let absensiId = $(this).data("id");
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "/madin/" + absensiId,
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            Swal.fire(
                                'Berhasil!',
                                res.message,
                                'success'
                            ).then((result) => {
                                location.reload();
                            });
                        },
                        error: function(err) {
                            Swal.fire(
                                'Gagal!',
                                err.responseJSON.message,
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
@endpush
