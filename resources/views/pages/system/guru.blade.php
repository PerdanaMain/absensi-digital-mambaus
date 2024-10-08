@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Data Guru</h4>

        <div class="d-block">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
        </div>

        <!-- Modal Tambah-->
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('guru.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahModalLabel">Tambah Data Guru</h5>
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
                                        <label for="telpon" class="form-label">No Telpon</label>

                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon11">+62</span>
                                            <input type="text" class="form-control"placeholder="No Telpon"
                                                name="phone" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">Alamat</label>
                                        <textarea name="address" id="phone" cols="30" rows="4" class="form-control" name="address"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username <span
                                                style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="username"
                                            placeholder="Masukkan username baru" name="username" />
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
                    <form action="{{ route('guru.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="importModalLabel">Import Data Guru</h5>
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
                                        <a role="button" href="{{ route('guru.template') }}"
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
            <table class="table" id="table-guru">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Guru</th>
                        <th>No Telpon</th>
                        <th>Alamat</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($guru as $key => $g)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $g->name }}</td>
                            <td>{{ $g->phone }}</td>
                            <td>{{ Str::limit($g->address, 25) }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#updateModal{{ $g->guruId }}"><i
                                                class="ti ti-pencil me-1"></i>Edit</button>
                                        <button class="dropdown-item" id="delete-guru" data-id="{{ $g->guruId }}"><i
                                                class="ti ti-trash me-1"></i>Delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit-->
                        <div class="modal fade" id="updateModal{{ $g->guruId }}" tabindex="-1"
                            aria-labelledby="updateModal{{ $g->guruId }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('guru.update', ['id' => $g->guruId]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModal{{ $g->guruId }}Label">Update Data
                                                Guru</h5>
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
                                                            value="{{ $g->name }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="telpon" class="form-label">No Telpon</label>

                                                        <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon11">+62</span>
                                                            <input type="text"
                                                                class="form-control"placeholder="No Telpon" name="phone"
                                                                value="{{ $g->phone }}" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput3"
                                                            class="form-label">Alamat</label>
                                                        <textarea name="address" id="phone" cols="30" rows="4" class="form-control" name="address">
                                                            {{ $g->address }}
                                                        </textarea>
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
        $(document).ready(function() {
            $('#table-guru').DataTable();
        })

        $(document).on("click", "#delete-guru", function() {
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
                        url: "/guru/" + id,
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
        });
    </script>
@endpush
