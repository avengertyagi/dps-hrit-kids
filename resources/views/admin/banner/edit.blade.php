@extends('admin.layouts.app')
@section('title')
    {{ 'Edit Banner' }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title">Edit Banner</h4>
                        </div>
                        <form class="form-horizontal" id="bannerForm" method="POST" action="{{ route('banners.update', $module_data->id) }}"
                            class="form-horizontal" autocomplete="off" novalidate="novalidate"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="mb-2 row">
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="title">Title</label><code
                                            class="text-danger fs-4">*</code>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ old('title', $module_data->title ?? '') }}" placeholder="Title" maxlength="50">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="image">Image</label><code
                                            class="text-danger fs-4">*</code>
                                        <input type="file" class="form-control" id="image" name="image" onchange="imagePreview();"> 
                                        <code>Allowed file types: png, jpg, jpeg</code>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <img id="image-preview"
                                            src="{{ asset($module_data->image ?? 'assets/backend/images/picture.png') }}"
                                            alt="Image Preview" class="img-fluid avatar-lg rounded mt-2">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-md-12 text-end">
                                        <a href="{{ route('banners.index') }}" type="button"
                                            class="btn btn-sm btn-outline-warning waves-effect waves-light">Cancel</a>
                                        <button id="submit-btn" type="submit"class="btn btn-sm btn-primary">Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        let is_video_required = @json($module_data->video ? false : true);
        const validation = new JustValidate('#bannerForm');
        validation
            .addField('#title', [{
                    rule: 'required',
                    errorMessage: 'The title field is required.',
                },
                {
                    rule: 'customRegexp',
                    value: /^[A-Za-z\s]+$/,
                    errorMessage: 'Please enter an attribute containing only letters.',
                },
                {
                    rule: 'minLength',
                    value: 2,
                    errorMessage: 'Please enter at least 2 characters.',
                },
                {
                    rule: 'maxLength',
                    value: 25,
                    errorMessage: 'Please enter no more than 25 characters.',
                },
                {
                    validator: (value) => {
                        const hasDoubleSpaces = /\s{2,}/.test(value);
                        return !hasDoubleSpaces;
                    },
                    errorMessage: 'The title must not contain double spaces.',
                },
                {
                    validator: (value) => {
                        const hasLeadingSpace = /^\s/.test(value);
                        return !hasLeadingSpace;
                    },
                    errorMessage: 'The title must not start with a space.',
                }
            ]);
            if(is_video_required){
            validation.addField('#image', [{
                    rule: 'minFilesCount',
                    value: 1,
                    errorMessage: 'The image field is required.',
                },
                {
                    rule: 'files',
                    value: {
                        files: {
                            extensions: ['jpeg', 'jpg', 'png'],
                            maxSize: 5000000,
                            minSize: 10000,
                            types: ['image/jpeg', 'image/jpg', 'image/png'],
                        },
                    },
                    errorMessage: 'Please upload a valid image (JPEG, JPG, PNG) between 10KB and 5MB.',
                }
            ]);
            }
            validation.onSuccess((event) => {
                const submitButton = document.querySelector('#submit-btn');
                submitButton.disabled = true;
                submitButton.textContent = 'Please wait...';
                const form = document.querySelector('#bannerForm');
                form.submit();
            })
            .onFail((fields) => {
                const submitButton = document.querySelector('#submit-btn');
                submitButton.disabled = false;
                submitButton.textContent = 'Submit';
            });
        function imagePreview() {
            const fileInput = document.getElementById('image');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
                toastr.error("The image must be a file of type: jpeg, jpg, png, gif.");
                fileInput.value = '';
                return false;
            }
            if (fileInput.files[0].size > 5048 * 1024) {
                toastr.error("File size must be less than 2MB.");
                fileInput.value = '';
                return false;
            }
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    </script>
@endpush
