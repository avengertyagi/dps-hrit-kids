@extends('admin.layouts.app')
@section('title')
    {{ 'Edit Photo' }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title">Edit Photo</h4>
                        </div>
                        <form class="form-horizontal" id="photoForm" method="POST"
                            action="{{ route('photos.update', $module_data->id) }}" class="form-horizontal"
                            autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="mb-2 row">
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="title">Title</label><code
                                            class="text-danger fs-4">*</code>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ old('title', $module_data->title ?? '') }}" placeholder="Title"
                                            maxlength="50">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="thumbnail_image">Thumbnail Image</label><code
                                            class="text-danger fs-4">*</code>
                                        <input type="file" class="form-control" id="thumbnail_image"
                                            name="thumbnail_image" onchange="thumbnailPreview();">
                                        <code>Allowed file types: png, jpg, jpeg</code>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <img id="image-preview"
                                            src="{{ asset($module_data->thumbnail_image ?? 'assets/backend/images/picture.png') }}"
                                            alt="Image Preview" class="img-fluid avatar-lg rounded mt-2">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                        <table class="table mb-0" id="images_table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Image <code>Allowed file types: png, jpg, jpeg</code></th>
                                                    <th style="min-width: 120px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($module_data->photoImages as $key => $image)
                                                    <tr>
                                                        <td>
                                                            <input type="hidden" name="image_id[]"
                                                                value="{{ $image->id }}">
                                                            <input type="file" class="form-control image-upload"
                                                                name="images[]" onchange="uploadImages(this)">
                                                            <input type="hidden" class="final-uploaded"
                                                                name="final_images[]" value="{{ basename($image->image) }}">
                                                            <ul class="list-unstyled images-preview"
                                                                style="max-height: 300px; overflow-y: auto;">
                                                                <li class="variantImage">
                                                                    <div
                                                                        class="position-relative d-flex align-items-center mt-2">
                                                                        <a href="{{ asset($image->image) }}"
                                                                            data-fancybox="gallery">
                                                                            <img class="img-fluid avatar-md rounded"
                                                                                src="{{ asset($image->image) }}">
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-success btn-sm waves-effect waves-light"
                                                                onclick="addImagesRow()">
                                                                <i class="mdi mdi-plus"></i>
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm waves-effect waves-light"
                                                                onclick="deleteImageRow(this)">
                                                                <i class="mdi mdi-close"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-md-12 text-end">
                                        <a href="{{ route('photos.index') }}" type="button"
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
        let isImageRequired = @json($module_data->thumbnail_image ? false : true);
        const validation = new JustValidate('#photoForm');
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
                },
                {
                    validator: (value) => {
                        return fetch("{{ route('photos.checkUnique') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                },
                                body: JSON.stringify({
                                    name: value,
                                }),
                            })
                            .then((response) => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then((isUnique) => {
                                return isUnique;
                            })
                            .catch((error) => {
                                console.error('Error during validation:', error);
                                return false;
                            });
                    },
                    errorMessage: 'The title has already been taken.',
                },
            ]);
        if (isImageRequired) {
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
                },
            ]);
        }
        // validation.addField('.image-upload', [{
        //         rule: 'minFilesCount',
        //         value: 1,
        //         errorMessage: 'The image field is required.',
        //     },
        //     {
        //         rule: 'files',
        //         value: {
        //             files: {
        //                 extensions: ['jpeg', 'jpg', 'png'],
        //                 maxSize: 5000000,
        //                 minSize: 10000,
        //                 types: ['image/jpeg', 'image/jpg', 'image/png'],
        //             },
        //         },
        //         errorMessage: 'Please upload a valid image (JPEG, JPG, PNG) between 10KB and 5MB.',
        //     },
        // ]);
        validation
            .onSuccess((event) => {
                const submitButton = document.querySelector('#submit-btn');
                submitButton.disabled = true;
                submitButton.textContent = 'Please wait...';
                const form = document.querySelector('#photoForm');
                form.submit();
            })
            .onFail((fields) => {
                const submitButton = document.querySelector('#submit-btn');
                submitButton.disabled = false;
                submitButton.textContent = 'Submit';
            });
        function addImagesRow() {
            const modalTable = $(`#images_table tbody`);
            const tableContainer = modalTable.closest('.table-responsive');
            const rowCount = modalTable.find('tr').length;
            if (rowCount >= 30) {
                toastr.warning('You can only add up to 30 variant images per type.');
                return;
            }
            const newRowCount = rowCount;
            const newRow = `
        <tr>
            <td>
                <input type="file" class="form-control image-upload" name="images[]" onchange="uploadImages(this)">
                <input type="hidden" class="final-uploaded" name="final_images[]">
                <div class="position-relative d-flex align-items-start">
                    <ul class="list-unstyled images-preview" style="max-height: 300px; overflow-y: auto;"></ul>
                </div>
            </td>
            <td>
                <button type="button"
                    class="btn btn-success btn-sm waves-effect waves-light"
                    onclick="addImagesRow(this)">
                    <i class="mdi mdi-plus"></i>
                </button>
                <button type="button"
                    class="btn btn-danger btn-sm waves-effect waves-light"
                    onclick="deleteImageRow(this)">
                    <i class="mdi mdi-close"></i>
                </button>
            </td>
        </tr>
    `;
            modalTable.append(newRow);
            // const newFileInput = modalTable.find('tr:last .image-upload')[0];
            // validation.addField(newFileInput, [{
            //         rule: 'minFilesCount',
            //         value: 1,
            //         errorMessage: 'The image field is required.',
            //     },
            //     {
            //         rule: 'files',
            //         value: {
            //             files: {
            //                 extensions: ['jpeg', 'jpg', 'png'],
            //                 maxSize: 5000000,
            //                 minSize: 10000,
            //                 types: ['image/jpeg', 'image/jpg', 'image/png'],
            //             },
            //         },
            //         errorMessage: 'Please upload a valid image (JPEG, JPG, PNG) between 10KB and 5MB.',
            //     }
            // ]);
            const addedRow = modalTable.find('tr:last');
            tableContainer.animate({
                scrollTop: addedRow.offset().top - tableContainer.offset().top + tableContainer.scrollTop()
            }, 500);
        }

        function uploadImages(inputElement) {
            const fileInput = inputElement.files ? inputElement : inputElement.closest('tr').querySelector('.image-upload');
            const file = fileInput.files[0];
            if (!file) {
                toastMagic.error("Please select a file.");
                return false;
            }
            const allowedExtensions = /\.(jpg|jpeg|png)$/i;
            if (!allowedExtensions.test(file.name)) {
                toastMagic.error("The image must be a file of type: jpeg, jpg, png.");
                fileInput.value = '';
                return false;
            }
            if (file.size > 2048 * 1024) {
                toastMagic.error("File size must be less than 2MB.");
                fileInput.value = '';
                return false;
            }
            const formData = new FormData();
            formData.append('files', file);
            const previewContainer = inputElement.closest('tr').querySelector('.images-preview');
            if (!previewContainer) {
                toastMagic.error("Preview container not found.");
                return false;
            }
            const loadingSpinner = `
                    <li class="loading-spinner">
                        <div class="spinner-border text-primary m-2" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </li>`;
            previewContainer.innerHTML = loadingSpinner;
            document.getElementById('submit-btn').disabled = true;
            $.ajax({
                url: "{{ route('photos.upload.tmp') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    previewContainer.innerHTML = '';
                    document.getElementById('submit-btn').disabled = false;
                    if (response.success) {
                        fileInput.value = '';
                        const imagePath =
                            `{{ asset('uploads/tmp/photo') }}/${response.images}`;
                        const html = `
                    <li class="variantImage">
                        <div class="position-relative d-flex align-items-center mt-2">
                            <a href="${imagePath}" data-fancybox="gallery">
                                <img class="img-fluid avatar-md rounded" src="${imagePath}">
                            </a>
                        </div>
                    </li>`;
                        previewContainer.innerHTML = html;
                        previewContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        inputElement.closest('tr').querySelector('.final-uploaded').value = response.images;
                    } else {
                        toastMagic.error('Failed to upload images.');
                    }
                },
                error: function(xhr) {
                    previewContainer.innerHTML = '';
                    toastMagic.error('Error uploading images: ' + xhr.responseText);
                },
                complete: function() {
                    fileInput.disabled = false;
                }
            });
        }

        function deleteImageRow(element) {
            const row = $(element).closest('tr');
            row.fadeOut(500, function() {
                $(this).remove();
                const tableContainer = $('#images_table').closest('.table-responsive');
                tableContainer.animate({
                    scrollTop: 0
                }, 500);
            });
        }

        function thumbnailPreview() {
            const fileInput = document.getElementById('thumbnail_image');
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
