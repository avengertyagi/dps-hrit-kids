@extends('admin.layouts.app')
@section('title')
    {{ 'Change Password' }}
@endsection
@section('content')
    <style>
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }
        .just-validate-error-label {
            order: 3;
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Change Password</h4>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="p-2">
                                    <form class="form-horizontal" id="chanage-passwordForm"
                                        action="{{ route('submit-change-password') }}" method="POST">
                                        @csrf
                                        <div class="mb-2 row form-group">
                                            <label class="col-md-5 col-form-label" for="simpleinput">Current Password<code
                                                    class="text-danger fs-4">*</code></label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="current_password"
                                                        name="current_password" value="{{ old('current_password')}}" placeholder="Current Password"
                                                        maxlength="50">
                                                    <span class="input-group-text"><i
                                                            class="bi bi-eye-slash-fill"
                                                            id="togglecurrent_password"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-2 row form-group">
                                            <label class="col-md-5 col-form-label" for="example-email">New Password<code
                                                    class="text-danger fs-4">*</code></label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="password" id="new_password" name="new_password" value="{{ old('new_password')}}"
                                                        class="form-control" placeholder="New Password" maxlength="50">
                                                    <span class="input-group-text"><i
                                                            class="bi bi-eye-slash-fill"
                                                            id="togglenew_password"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-2 row form-group">
                                            <label class="col-md-5 col-form-label" for="example-email">Confirm New
                                                Password<code class="text-danger fs-4">*</code></label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="password" name="confirm_password" value="{{ old('confirm_password')}}" class="form-control"
                                                        placeholder="Confirm New Password" maxlength="50"
                                                        id="confirm_password">
                                                    <span class="input-group-text"><i
                                                            class="bi bi-eye-slash-fill"
                                                            id="toggleconfirm_password"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <div class="col-md-12 text-end">
                                                <a href="{{ route('dashboard') }}"
                                                    class="btn btn-outline-warning waves-effect waves-light">Cancel</a>
                                                <button id="submit-btn" type="submit" class="btn btn-primary">Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#togglecurrent_password').on('click', function() {
                $(this).toggleClass(
                    "bi-eye-fill bi-eye-slash-fill");
                var input = $("#current_password");
                input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            });
            $('#togglenew_password').on('click', function() {
                $(this).toggleClass(
                    "bi-eye-fill bi-eye-slash-fill");
                var input = $("#new_password");
                input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            });
            $('#toggleconfirm_password').on('click', function() {
                $(this).toggleClass(
                    "bi-eye-fill bi-eye-slash-fill");
                var input = $("#confirm_password");
                input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            });
        });
        const validation = new JustValidate('#chanage-passwordForm');
        validation
            .addField('#current_password', [{
                    rule: 'required',
                    errorMessage: 'The current password field is required.',
                },
                {
                    rule: 'minLength',
                    value: 8,
                    errorMessage: 'The current password field must be at least 8 characters.',
                },
                {
                    rule: 'maxLength',
                    value: 10,
                    errorMessage: 'The current password field must be at least 10 characters.',
                }
            ])
            .addField('#new_password', [{
                    rule: 'required',
                    errorMessage: 'The new password field is required.',
                },
                {
                    rule: 'minLength',
                    value: 8,
                    errorMessage: 'The new password field must be at least 8 characters.',
                },
                {
                    rule: 'maxLength',
                    value: 10,
                    errorMessage: 'The new password field must be at least 10 characters.',
                },
                {
                    rule: 'strongPassword',
                    errorMessage: 'The new password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
                }
            ])
            .addField('#confirm_password', [{
                    rule: 'required',
                    errorMessage: 'The confirm new password field is required.',
                },
                {
                    rule: 'minLength',
                    value: 8,
                    errorMessage: 'The confirm new password field must be at least 8 characters.'
                },
                {
                    rule: 'maxLength',
                    value: 10,
                    errorMessage: 'The confirm new password field must be at least 10 characters.',
                },
                {
                    rule: 'custom',
                    validator: (value) => {
                        const newPassword = document.querySelector('#new_password').value;
                        return value === newPassword;
                    },
                    errorMessage: 'New password and confirm password are not same.',
                }
            ])
            .onSuccess((event) => {
                $("#submit-btn").prop("disabled", true).text("Please wait...");
                event.currentTarget.submit();
            });
    </script>
@endpush
