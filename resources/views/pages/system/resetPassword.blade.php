@extends('layouts.app')

@section('title', 'Data Santri')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Data Pengajuan Reset Password</h4>

        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                {{ $user->username }}
                            </td>
                            <td>
                                {{ $user->role->name }}
                            </td>
                            <td>
                                @if ($user->pengurus)
                                    {{ $user->pengurus->name }}
                                @endif

                                @if ($user->guru)
                                    {{ $user->guru->name }}
                                @endif

                                @if ($user->wali)
                                    {{ $user->wali->name }}
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-primary" id="reset-btn" data-id="{{ $user->userId }}">Reset</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on("click", "#reset-btn", function() {
            let user = $(this).data("id");

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Password yang direset tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        url: "/reset-password/" + user,
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
        })
    </script>
@endpush
