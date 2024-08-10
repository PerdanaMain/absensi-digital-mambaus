@extends('layouts.app')

@section('title', 'Data Santri')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Data Santri</h4>

        <div class="d-block">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
        </div>

        <!-- Modal Tambah-->
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('santri.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahModalLabel">Tambah Data Santri</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama <span
                                                style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="name" placeholder="Nama Lengkap"
                                            name="name" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="telpon" class="form-label">Umur <span
                                                style="color:red">*</span></label>

                                        <div class="input-group">
                                            <input type="number" class="form-control"placeholder="Umur" name="age" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="birthPlace" class="form-label">Tempat Lahir</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control"placeholder="Masukkan Tempat Lahir"
                                                name="birthPlace" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="flatpickr-date" class="form-label">Tanggal Lahir</label>
                                        <input type="text" class="form-control" placeholder="YYYY-MM-DD"
                                            id="flatpickr-date" name="birthDate" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">Alamat</label>
                                        <textarea name="address" id="address" cols="30" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Pengurus<span
                                                style="color:red">*</span></label>
                                        <select name="pengurusId" id="santriId" class="form-select select2">
                                            <option selected hidden>=== Pilih Pengurus ===</option>
                                            @foreach ($pengurus as $item)
                                                <option value="{{ $item->pengurusId }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="waliName" class="form-label">Nama Wali Santri<span
                                                style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="waliName"
                                            placeholder="Masukkan nama wali santri" name="waliName" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">
                                            Alamat Wali Santri
                                        </label>

                                        <textarea id="waliAddress" cols="30" rows="4" class="form-control" name="waliAddress"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username untuk Wali<span
                                                style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="username"
                                            placeholder="Masukkan username baru untuk wali" name="username" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="waliTelpon" class="form-label">No Telpon Wali<span
                                                style="color:red">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon11">+62</span>
                                            <input type="text" class="form-control" id="waliTelpon"
                                                placeholder="Masukkan No Telpon " name="waliTelpon" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Modal Import-->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('santri.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="importModalLabel">Import Data Santri</h5>
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
                                        <a role="button" href="{{ route('santri.template') }}"
                                            class="btn btn-warning">Download Template</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
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
                        <th>Umur</th>
                        <th>Nama Pengurus</th>
                        <th>Nama Wali</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($santris as $key => $s)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $s->name }}</td>
                            <td>{{ $s->age }}</td>
                            <td>{{ $s->pengurus->name }}</td>
                            <td>{{ $s->wali->name }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#infoModal{{ $s->santriId }}"><i
                                                class="ti ti-info-circle me-1"></i>Info</button>
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#updateModal{{ $s->santriId }}"><i
                                                class="ti ti-pencil me-1"></i>Edit</button>
                                        <button class="dropdown-item" id="delete-santri"
                                            data-id="{{ $s->santriId }}"><i class="ti ti-trash me-1"></i>Delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal Info-->
                        <div class="modal fade" id="infoModal{{ $s->santriId }}" tabindex="-1"
                            aria-labelledby="infoModal{{ $s->santriId }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="infoModal{{ $s->santriId }}Label">Info Data
                                            Santri</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <p>
                                                        <b>Nama :</b> {{ $s->name }}
                                                    </p>
                                                    <p>
                                                        <b>Umur :</b> {{ $s->age }}
                                                    </p>
                                                    <p>
                                                        <b>TTL :</b>
                                                        {{ $s->birthPlace }} ,
                                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $s->birthDate)->format('jS F Y') }}
                                                    </p>
                                                    <p>
                                                        <b>Alamat :</b> {{ $s->address == null ? null : $s->address }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <p>
                                                        <b>Nama Wali :</b> {{ $s->wali->name }}
                                                    </p>
                                                    <p>
                                                        <b>Alamat Wali :</b> {{ $s->wali->address }}
                                                    </p>
                                                    <p>
                                                        <b>No Telpon Wali :</b> {{ $s->wali->phone }}
                                                    </p>
                                                    <p>
                                                        <b>Nama Pengurus :</b> {{ $s->pengurus->name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit-->
                        <div class="modal fade" id="updateModal{{ $s->santriId }}" tabindex="-1"
                            aria-labelledby="updateModal{{ $s->santriId }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('santri.update', ['id' => $s->santriId]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModal{{ $s->santriId }}Label">Update Data
                                                Santri</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama <span
                                                                style="color:red">*</span></label>
                                                        <input type="text" class="form-control" id="name"
                                                            placeholder="Nama Lengkap" name="name"
                                                            value="{{ $s->name }}" />
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-md-6
                                                            col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="telpon" class="form-label">Umur <span
                                                                style="color:red">*</span></label>

                                                        <div class="input-group">
                                                            <input type="number" class="form-control"placeholder="Umur"
                                                                name="age" value="{{ $s->age }}" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="birthPlace" class="form-label">Tempat
                                                            Lahir</label>
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control"placeholder="Masukkan Tempat Lahir"
                                                                name="birthPlace" value="{{ $s->birthPlace }}" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="flatpickr-date" class="form-label">Tanggal
                                                            Lahir</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="YYYY-MM-DD" id="flatpickr-date" name="birthDate"
                                                            value="{{ $s->birthDate }}" />
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput3"
                                                            class="form-label">Alamat</label>
                                                        <textarea name="address" id="address" cols="30" rows="4" class="form-control">
                                                            {{ $s->address }}
                                                        </textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama Pengurus<span
                                                                style="color:red">*</span></label>
                                                        <select name="pengurusId" id="pengurusId" class="form-select">
                                                            <option selected hidden value="{{ $s->pengurusId }}">
                                                                {{ $s->pengurus->name }}
                                                            </option>
                                                            @foreach ($pengurus as $p)
                                                                <option value="{{ $p->pengurusId }}">{{ $p->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="waliName" class="form-label">Nama Wali Santri<span
                                                                style="color:red">*</span></label>
                                                        <input type="text" class="form-control" id="waliName"
                                                            placeholder="Masukkan nama wali santri" name="waliName"
                                                            value="{{ $s->wali->name }}" />
                                                        <input type="text" class="form-control" name="waliId"
                                                            value="{{ $s->waliId }}" hidden />
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput3" class="form-label">
                                                            Alamat Wali Santri
                                                        </label>
                                                        <textarea id="waliAddress" cols="30" rows="4" class="form-control" name="waliAddress">
                                                            {{ $s->wali->address }}
                                                        </textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="waliTelpon" class="form-label">No Telpon Wali<span
                                                                style="color:red">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon11">+62</span>
                                                            <input type="text" class="form-control" id="waliTelpon"
                                                                placeholder="Masukkan No Telpon " name="waliTelpon"
                                                                value="{{ $s->wali->phone }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
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
        $(document).on('click', '#delete-santri', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/santri/" + id,
                        type: 'DELETE',
                        data: {
                            _token: $("input[name=_token]").val(),
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Terhapus!',
                                response.message,
                                'success'
                            )
                            location.reload();
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                xhr.responseJSON.message,
                                'error'
                            )
                        }
                    })
                }
            })
        })
    </script>
@endpush
