@extends('layouts.app')

@section('title', 'Profile Account')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Profile Account</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-4">
                    @if ($profile->roleId != 1)
                        <li class="nav-item">
                            <button class="nav-link active" id="btn-account"><i class="ti-xs ti ti-user me-1"></i>
                                Account</button>
                        </li>
                    @endif
                    <li class="nav-item">
                        <button class="nav-link" id="btn-security"><i class="ti-xs ti ti-lock me-1"></i> Security</button>
                    </li>
                </ul>

                <div class="card mb-4" id="profile-account">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <form id="formAccountSettings" method="POST"
                        action="{{ route('profile.update', ['id' => $profile->userId]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ $profile->image ? url('storage/profile/' . $profile->image) : '../../assets/img/avatars/1.png' }}"
                                    alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="ti ti-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" class="account-file-input" hidden
                                            accept="image/png, image/jpeg" name="image" />

                                    </label>

                                    <div class="text-muted">Allowed JPG, JPEG, PNG. Max size of 512Kb</div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        @if ($profile->roleId != 1)
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label for="name" class="form-label">Nama</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            value="{{ $data['name'] }}" autofocus />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">(+62)</span>
                                            <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                                value="{{ $data['phone'] }}" />
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ $data['address'] }}" />
                                    </div>

                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save</button>
                                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                </div>
                            </div>
                        @endif
                        <!-- /Account -->
                    </form>

                </div>

                <!-- Change Password -->
                <div class="card mb-4" id="profile-security">
                    <h5 class="card-header">Change Password</h5>
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST"
                            action="{{ route('profile.changePassword', ['id' => $profile->userId]) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="currentPassword">Current Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" name="currentPassword"
                                            id="currentPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" id="newPassword" name="newPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" name="confirmPassword"
                                            id="confirmPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary me-2">Save</button>
                                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/ Change Password -->

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const role = '{{ $profile->roleId }}';
            if (role == 1) {
                $('#profile-account').hide();
                $('#profile-security').show();
                $('#btn-account').removeClass('active');
                $('#btn-security').addClass('active');
            } else {
                $('#profile-account').show();
                $('#profile-security').hide();
                $('#btn-account').addClass('active');
                $('#btn-security').removeClass('active');
            }
        })

        $(document).on("change", "#upload", function() {
            const file = $(this).prop('files')[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#uploadedAvatar').attr('src', e.target.result);
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        });

        $(document).on('click', '#btn-account', function() {
            $('#profile-account').show();
            $('#profile-security').hide();
            $('#btn-account').addClass('active');
            $('#btn-security').removeClass('active');
        })

        $(document).on('click', '#btn-security', function() {
            $('#profile-account').hide();
            $('#profile-security').show();
            $('#btn-account').removeClass('active');
            $('#btn-security').addClass('active');
        })
    </script>
@endpush
