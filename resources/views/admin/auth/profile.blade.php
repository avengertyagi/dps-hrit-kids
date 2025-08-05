@extends('admin.layouts.app')
@section('title')
    {{ 'Edit Profile' }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Profile</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card p-0">
                        <div class="card-body p-0">
                            <div class="profile-content">
                                <div class="tab-content m-0 p-4">
                                    <div id="edit-profile" class="tab-pane active show" role="tabpanel">
                                        <div class="user-profile-content">
                                            <form method="POST" action="{{ route('profile.update') }}"
                                            enctype="multipart/form-data" id="profile-form">
                                                @csrf
                                                <div class="row row-cols-sm-2 row-cols-1">
                                                    <div class="mb-2">
                                                        <label class="form-label" for="FullName">Name</label><code
                                                            class="text-danger fs-4">*</code>
                                                        <input type="text" value="{{ Auth::user()->name ?? '' }}"
                                                            name="name" id="name" class="form-control"
                                                            placeholder="Name" maxlength="25">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="Email">Email</label><code
                                                            class="text-danger fs-4">*</code>
                                                        <input type="email" value="{{ Auth::user()->email ?? '' }}"
                                                            name="email" id="email" class="form-control"
                                                            placeholder="Email" maxlength="50">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="web-url">Logo</label><code
                                                            class="text-danger fs-4">*</code>
                                                        <input type="file" id="admin_logo" name="logo"
                                                            class="form-control" onchange="filePreview();">
                                                        <img id="image_preview"
                                                            src="{{ asset(Auth::user()->image ?? 'assets/backend/images/users/avatar-1.jpg') }}"
                                                            alt="image" class="img-fluid avatar-lg rounded mt-2">
                                                        <p>
                                                            <code>Allowed file types: png, jpg, jpeg</code>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 text-end">
                                                        <button id="profile_submit" class="btn btn-sm btn-primary"
                                                            type="submit">Submit
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
        </div>
    </div>
@endsection
@push('js')
    <script>
        const existingLogo = "{{ Auth::user()->image }}" ?? '';
        console.log(existingLogo);
        const validation = new JustValidate('#profile-form');
        validation
            .addField('#email', [{
                    rule: 'required',
                    errorMessage: 'The email address field is required.',
                },
                {
                    rule: 'email',
                    errorMessage: 'Please enter a valid email address.',
                }
            ])
            .addField('#name', [{
                    rule: 'required',
                    errorMessage: 'The name field is required.',
                },
                {
                    rule: 'customRegexp',
                    value: /^[A-Za-z\s]+$/,
                    errorMessage: 'Please enter a name containing only letters..',
                },
                {
                    validator: (value) => {
                        return !/\s{2,}/.test(value);
                    },
                    errorMessage: 'The name must not contain double spaces.',
                },
                {
                    validator: (value) => {
                        return !/^\s/.test(value);
                    },
                    errorMessage: 'The name must not start with a space.',
                }
            ]);
        if (!existingLogo) {
            validation.addField('#admin_logo', [{
                    rule: 'required',
                    errorMessage: 'The logo field is required.',
                },
                {
                    rule: 'minFilesCount',
                    value: 1,
                    errorMessage: 'Please upload a file.',
                },
                {
                    rule: 'files',
                    value: {
                        files: {
                            extensions: ['jpeg', 'jpg', 'png'],
                            maxSize: 2000000,
                            minSize: 10000,
                            types: ['image/jpeg', 'image/jpg', 'image/png'],
                        },
                    },
                    errorMessage: 'Please upload a valid image file (JPEG, JPG, PNG) between 10KB and 2MB.',
                }
            ]);
        }
        validation.onSuccess(() => {
            $("#profile_submit").prop("disabled", true).text("Please wait...");
            const form = document.querySelector('#profile-form');
            form.submit();
        });

        function filePreview() {
            var fileInput = document.getElementById('admin_logo');
            var filePath = fileInput.value;
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    </script>
@endpush
