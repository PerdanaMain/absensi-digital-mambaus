@extends('layouts.app')

@section('title', 'Mata Pelajaran')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Data Mata Pelajaran</h4>

        <div class="d-block">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
        </div>

        <!-- Modal Tambah-->
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('matpel.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahModalLabel">Tambah Data Mata Pelajaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Mata Pelajaran<span
                                                style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Nama mata pelajaran" name="name" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="telpon" class="form-label">Hari </label>
                                        <select name="day" id="day" class="form-select select2">
                                            <option selected hidden>=== Pilih Hari ===</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                            <option value="Minggu">Minggu</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="birthPlace" class="form-label">Jam</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="HH:MM"
                                                id="flatpickr-time" name="time" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="kelasId" class="form-label">Kelas <span
                                                style="color:red">*</span></label>
                                        <select name="kelasId" id="kelasId" class="form-select select2">
                                            <option selected hidden>=== Pilih Kelas ===</option>
                                            @foreach ($kelas as $k)
                                                <option value="{{ $k->kelasId }}">{{ $k->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="typeId" class="form-label">Tipe Mata Pelajaran <span
                                                style="color:red">*</span></label>
                                        <select name="typeId" id="typeId" class="form-select select2">
                                            <option selected hidden>=== Pilih Tipe ===</option>
                                            @foreach ($types as $t)
                                                <option value="{{ $t->typeId }}">{{ $t->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            Deskripsi Mata Pelajaran
                                        </label>
                                        <textarea id="description" cols="30" rows="4" class="form-control" name="description"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Guru<span
                                                style="color:red">*</span></label>
                                        <select name="guruId" id="guruId" class="form-select select2">
                                            <option selected hidden>=== Pilih Guru ===</option>
                                            @foreach ($guru as $g)
                                                <option value="{{ $g->guruId }}">{{ $g->name }}</option>
                                            @endforeach
                                        </select>
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
                    <form action="{{ route('matpel.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="importModalLabel">Import Data Mata Pelajaran</h5>
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
                                        <a role="button" href="{{ route('matpel.template') }}"
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
                        <th>Nama Mata Pelajaran</th>
                        <th>Jadwal (Hari)</th>
                        <th>Waktu (Jam)</th>
                        <th>Nama Guru</th>
                        <th>Tipe</th>
                        <th>Kelas</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($matpels as $key => $m)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $m->name }}</td>
                            <td>{{ $m->day }}</td>
                            <td>{{ $m->time == null ? '-' : DateTime::createFromFormat('H:i:s', $m->time)->format('g:i A') }}
                            </td>
                            <td>{{ $m->guru->name }}</td>
                            <td>{{ $m->type->name }}</td>
                            <td>{{ $m->kelas->name }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#infoModal{{ $m->matpelId }}"><i
                                                class="ti ti-info-circle me-1"></i>Info</button>
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#updateModal{{ $m->matpelId }}"><i
                                                class="ti ti-pencil me-1"></i>Edit</button>
                                        <button class="dropdown-item" id="delete-matpel"
                                            data-id="{{ $m->matpelId }}"><i class="ti ti-trash me-1"></i>Delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Info-->
                        <div class="modal fade" id="infoModal{{ $m->matpelId }}" tabindex="-1"
                            aria-labelledby="infoModal{{ $m->matpelId }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="infoModal{{ $m->matpelId }}Label">Info Data
                                            Mata Pelajaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <p>
                                                        <b>Nama Mata Pelajaran:</b> {{ $m->name }}
                                                    </p>
                                                    <p>
                                                        <b>Jadwal - Waktu:</b>
                                                        @if ($m->time != null)
                                                            {{ $m->day . ' - ' . DateTime::createFromFormat('H:i:s', $m->time)->format('g:i A') }}
                                                        @else
                                                            {{ $m->day }}
                                                        @endif
                                                    </p>
                                                    <p>
                                                        <b>Deskripsi:</b> {{ $m->description }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <p>
                                                        <b>Kelas :</b> {{ $m->kelas->name }}
                                                    </p>
                                                    <p>
                                                        <b>Tipe :</b> {{ $m->type->name }}
                                                    </p>
                                                    <p>
                                                        <b>Nama Guru :</b> {{ $m->guru->name }}
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

                        <!-- Modal Update-->
                        <div class="modal fade" id="updateModal{{ $m->matpelId }}" tabindex="-1"
                            aria-labelledby="updateModal{{ $m->matpelId }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('matpel.update', ['id' => $m->matpelId]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModal{{ $m->matpelId }}Label">Update Data
                                                Mata Pelajaran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama Mata Pelajaran<span
                                                                style="color:red">*</span></label>
                                                        <input type="text" class="form-control" id="name"
                                                            placeholder="Nama mata pelajaran" name="name"
                                                            value="{{ $m->name }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="telpon" class="form-label">Hari </label>
                                                        <select name="day" id="day" class="form-select">
                                                            <option selected hidden value="{{ $m->day }}">
                                                                {{ $m->day }}</option>
                                                            <option value="Senin">Senin</option>
                                                            <option value="Selasa">Selasa</option>
                                                            <option value="Rabu">Rabu</option>
                                                            <option value="Kamis">Kamis</option>
                                                            <option value="Jumat">Jumat</option>
                                                            <option value="Sabtu">Sabtu</option>
                                                            <option value="Minggu">Minggu</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="birthPlace" class="form-label">Jam</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                placeholder="HH:MM" id="flatpickr-time" name="time"
                                                                value="{{ $m->time }}" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="kelasId" class="form-label">Kelas <span
                                                                style="color:red">*</span></label>
                                                        <select name="kelasId" id="kelasId" class="form-select">
                                                            <option selected hidden value="{{ $m->kelasId }}">
                                                                {{ $m->kelas->name }}</option>
                                                            @foreach ($kelas as $k)
                                                                <option value="{{ $k->kelasId }}">{{ $k->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="typeId" class="form-label">Tipe Mata Pelajaran <span
                                                                style="color:red">*</span></label>
                                                        <select name="typeId" id="typeId" class="form-select">
                                                            <option selected hidden value="{{ $m->typeId }}">
                                                                {{ $m->type->name }}</option>
                                                            @foreach ($types as $t)
                                                                <option value="{{ $t->typeId }}">{{ $t->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">
                                                            Deskripsi Mata Pelajaran
                                                        </label>
                                                        <textarea id="description" cols="30" rows="4" class="form-control" name="description">
                                                            {{ $m->description }}
                                                        </textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama Guru<span
                                                                style="color:red">*</span></label>
                                                        <select name="guruId" id="guruId" class="form-select">
                                                            <option selected hidden value="{{ $m->guruId }}">
                                                                {{ $m->guru->name }}</option>
                                                            @foreach ($guru as $g)
                                                                <option value="{{ $g->guruId }}">{{ $g->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
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
        $(document).on('click', '#delete-matpel', function() {
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
                        url: "/matpel/" + id,
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
