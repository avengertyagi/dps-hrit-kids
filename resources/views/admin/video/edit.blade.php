@extends('admin.layouts.app')
@section('title')
    {{ 'Edit Video' }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title">Edit Video</h4>
                        </div>
                        <form class="form-horizontal" id="videoForm" method="POST" action="{{ route('videos.update', $module_data->id) }}"
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
                                        <label class="col-form-label" for="thumbnail_image">Thumbnail Image</label><code
                                            class="text-danger fs-4">*</code>
                                        <input type="file" class="form-control" id="thumbnail_image"
                                            name="thumbnail_image" onchange="thumbnailPreview();">
                                        <code>Allowed file types: png, jpg, jpeg</code>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="video">Video</label><code
                                            class="text-danger fs-4">*</code>
                                        <input type="file" class="form-control" id="video" name="video" onchange="videoPreview();"> 
                                        <code>Allowed file types: mp4
                                        <video id="video-preview" controls
                                            style="@if($module_data->video) display: block; @else display: none; @endif margin-top: 10px; max-width: 100%;" src="{{ asset($module_data->video) }}"></video>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-md-12 text-end">
                                        <a href="{{ route('videos.index') }}" type="button"
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
        let is_thumbanil_required = @json($module_data->thumbnail_image ? false : true);
        const validation = new JustValidate('#videoForm');
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
            if(is_thumbanil_required){
                 validation.addField('#thumbnail_image', [{
                    rule: 'minFilesCount',
                    value: 1,
                    errorMessage: 'The thumbnail image field is required.',
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
            if(is_video_required){
            validation.addField('#video', [{
                    rule: 'minFilesCount',
                    value: 1,
                    errorMessage: 'The video field is required.',
                },
                {
                    rule: 'files',
                    value: {
                        files: {
                            extensions: ['mp4'],
                            maxSize: 5000000,
                            minSize: 10000,
                            types: ['video/mp4'],
                        },
                    },
                    errorMessage: 'Please upload a valid video (MP4) between 10KB and 5MB.',
                }
            ]);
            }
            validation.onSuccess((event) => {
                const submitButton = document.querySelector('#submit-btn');
                submitButton.disabled = true;
                submitButton.textContent = 'Please wait...';
                const form = document.querySelector('#videoForm');
                form.submit();
            })
            .onFail((fields) => {
                const submitButton = document.querySelector('#submit-btn');
                submitButton.disabled = false;
                submitButton.textContent = 'Submit';
            });

        function videoPreview() {
            const fileInput = document.getElementById('video');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.mp4|\.mov|\.avi|\.mkv)$/i;
            if (!allowedExtensions.exec(filePath)) {
                toastMagic.error("The video must be a file of type: mp4, mov, avi, mkv.");
                fileInput.value = ''; 
                document.getElementById('video-preview').style.display = 'none';
                return false;
            }
            if (fileInput.files[0].size > 5 * 1024 * 1024) {
                toastMagic.error("File size must be less than 5MB.");
                fileInput.value = '';
                document.getElementById('video-preview').style.display = 'none';
                return false;
            }
            const videoPreviewElement = document.getElementById('video-preview');
            videoPreviewElement.style.display = 'block';
            videoPreviewElement.src = URL.createObjectURL(fileInput.files[0]);
        }
    </script>
@endpush
