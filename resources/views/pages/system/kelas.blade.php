@extends('layouts.app')

@section('title', 'Data Santri')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Data Santri</h4>

        <div class="d-block">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
        </div>

        <!-- Modal Tambah-->
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('kelas.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahModalLabel">Tambah Data Kelas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Kelas<span
                                                style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="name" placeholder="Nama Lengkap"
                                            name="name" />
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
                        <th>Nama Kelas</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($kelas as $key => $k)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $k->name }}</td>
                            <td>
                                <div class="d-block">
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#updateModal{{ $k->kelasId }}"><i
                                            class="ti ti-pencil me-1"></i>Edit</button>
                                    <button class="btn btn-danger" id="delete-kelas" data-id="{{ $k->kelasId }}"><i
                                            class="ti ti-trash me-1"></i>Delete</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Tambah-->
                        <div class="modal fade" id="updateModal{{ $k->kelasId }}" tabindex="-1"
                            aria-labelledby="updateModal{{ $k->kelasId }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('kelas.update', ['id' => $k->kelasId]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModal{{ $k->kelasId }}Label">Tambah Data
                                                Kelas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama Kelas<span
                                                                style="color:red">*</span></label>
                                                        <input type="text" class="form-control" id="name"
                                                            placeholder="Nama Lengkap" name="name"
                                                            value="{{ $k->name }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save </button>
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
        $(document).on('click', '#delete-kelas', function() {
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
                        url: "/kelas/" + id,
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
