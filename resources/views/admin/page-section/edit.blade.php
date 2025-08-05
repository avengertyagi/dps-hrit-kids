@extends('admin.layouts.app')
@section('title')
    {{ 'Edit Page Section' }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title">Edit Page Section</h4>
                        </div>
                        <form class="form-horizontal" id="pageForm" method="POST"
                            action="{{ route('page-sections.update', $module_data->id) }}" class="form-horizontal"
                            autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="mb-2 row">
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="page_id">Parent Page</label><code
                                            class="text-danger fs-4">*</code>
                                            <input type="hidden" name="page_id" value="{{ $module_data->page->id }}">
                                            <input type="hidden" name="parent_id" value="{{ $module_data->parent->id ?? '' }}">
                                        <select class="form-control" id="page_id" name="page_id">
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="parent_id">Parent Page Section</label>
                                        <select class="form-control" id="parent_id" name="parent_id">
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="section_title">Section Title</label><code
                                            class="text-danger fs-4">*</code>
                                        <input type="text" class="form-control" id="section_title" name="section_title"
                                            value="{{ old('section_title', $module_data->section_title ?? '') }}"
                                            placeholder="Section Title" maxlength="100">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="section_name">Section Name</label><code
                                            class="text-danger fs-4">*</code>
                                        <input type="text" class="form-control" id="section_name" name="section_name"
                                            value="{{ old('section_name', $module_data->section_name ?? '') }}"
                                            placeholder="Section Name" maxlength="100">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="section_slug">Image</label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            onchange="imagePreview(this);">
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ asset($module_data->featured_image ?? 'assets/backend/images/picture.png') }}"
                                            data-fancybox="gallery" id="image_link">
                                            <img id="image-preview"
                                                src="{{ asset($module_data->featured_image ?? 'assets/backend/images/picture.png') }}"
                                                alt="thumbnail" class="img-fluid avatar-xl rounded mt-2">
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-md-12">
                                        <label class="col-form-label" for="description">Description</label>
                                        <div id="description-editor" style="height: 300px;">{{old('description', $module_data->content)}}
                                        </div>
                                        <input type="hidden" name="description" id="hidden_description">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-md-12 text-end">
                                        <a href="{{ route('page-sections.index') }}" type="button"
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
    <!-- Quill css -->
    <link href="{{ asset('assets/backend/vendor/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/vendor/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/vendor/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
    <!-- Quill Editor js -->
    <link href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="{{ asset('assets/backend/vendor/quill/quill.min.js') }}"></script>
    <script>
        let selectedparentPage = @json($module_data->page ?? null);
        let selectedparentPageSection = @json($module_data->parent ?? null);
        $(document).ready(function() {
            const quill = new Quill("#description-editor", {
                theme: "snow",
                modules: {
                    toolbar: [
                        [{
                            font: []
                        }],
                        ["bold", "italic", "underline", "strike"],
                        [{
                            color: []
                        }, {
                            background: []
                        }],
                        [{
                            script: "super"
                        }, {
                            script: "sub"
                        }],
                        [{
                            header: [1, 2, 3, 4, 5, 6, false]
                        }, "blockquote", "code-block"],
                        [{
                            list: "ordered"
                        }, {
                            list: "bullet"
                        }, {
                            indent: "-1"
                        }, {
                            indent: "+1"
                        }],
                        ["direction", {
                            align: []
                        }],
                        ["link"]
                    ]
                }
            });
            // On form submit, copy Quill content to hidden input
            $('#pageForm').on('submit', function() {
                $('#hidden_description').val(quill.root.innerHTML);
            });
            $('#page_id').select2({
                placeholder: "Please Select",
                allowClear: true,
                disabled: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: "{{ route('pages.list') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.title.charAt(0).toUpperCase() + item.title.slice(
                                        1)
                                };
                            }),
                            pagination: {
                                more: data.current_page < data.last_page
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0,
                language: {
                    searching: function() {
                        return "Searching...";
                    },
                    noResults: function() {
                        return "No result found";
                    }
                }
            }).on('select2:select', function(e) {
                validation.revalidateField('#page_id');
            });
            if (selectedparentPage) {
                const parentPage = {
                    id: selectedparentPage.id,
                    text: selectedparentPage.title
                };
                var newOption = new Option(parentPage.text.charAt(0).toUpperCase() + parentPage.text.slice(1),
                    parentPage
                    .id, true, true);
                $('#page_id').append(newOption).trigger('change');
            }
            $('#parent_id').select2({
                placeholder: "Please Select",
                allowClear: true,
                disabled: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: "{{ route('page-sections.list') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.section_title.charAt(0).toUpperCase() + item
                                        .section_title.slice(
                                            1)
                                };
                            }),
                            pagination: {
                                more: data.current_page < data.last_page
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0,
                language: {
                    searching: function() {
                        return "Searching...";
                    },
                    noResults: function() {
                        return "No result found";
                    }
                }
            });
            if (selectedparentPageSection) {
                const parentPage = {
                    id: selectedparentPageSection.id,
                    text: selectedparentPageSection.section_title
                };
                var newOption = new Option(parentPage.text.charAt(0).toUpperCase() + parentPage.text.slice(1),
                    parentPage
                    .id, true, true);
                $('#parent_id').append(newOption).trigger('change');
            }
            const validation = new JustValidate('#pageForm');
            validation
                .addField('#section_title', [{
                        rule: 'required',
                        errorMessage: 'The section title field is required.',
                    },
                    {
                        rule: 'minLength',
                        value: 2,
                        errorMessage: 'Please enter at least 2 characters.',
                    },
                    {
                        rule: 'maxLength',
                        value: 100,
                        errorMessage: 'Please enter no more than 100 characters.',
                    },
                    {
                        validator: (value) => {
                            const hasDoubleSpaces = /\s{2,}/.test(value);
                            return !hasDoubleSpaces;
                        },
                        errorMessage: 'The section title must not contain double spaces.',
                    },
                    {
                        validator: (value) => {
                            const hasLeadingSpace = /^\s/.test(value);
                            return !hasLeadingSpace;
                        },
                        errorMessage: 'The section title must not start with a space.',
                    },
                    {
                        validator: (value) => () =>
                            new Promise((resolve) => {
                                fetch("{{ route('page-sections.check-unique') }}", {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector(
                                                    'meta[name="csrf-token"]')
                                                .getAttribute('content')
                                        },
                                        body: JSON.stringify({
                                            section_title: value,
                                            page_section_id: @json($module_data->id ?? null),
                                        })
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok');
                                        }
                                        return response.json();
                                    })
                                    .then(isUnique => {
                                        resolve(isUnique);
                                    })
                                    .catch(error => {
                                        console.error('Error during validation:', error);
                                        resolve(false);
                                    });
                            }),
                        errorMessage: 'The section title has already been taken.',
                    }
                ])
                .addField('#page_id', [{
                    rule: 'required',
                    errorMessage: 'The parent page field is required.',
                }])
                .addField('#section_name', [{
                        rule: 'required',
                        errorMessage: 'The section name field is required.',
                    },
                    {
                        rule: 'minLength',
                        value: 2,
                        errorMessage: 'Please enter at least 2 characters.',
                    },
                    {
                        rule: 'maxLength',
                        value: 100,
                        errorMessage: 'Please enter no more than 100 characters.',
                    }
                ]);
            validation.onSuccess((event) => {
                    const descriptionInput = document.querySelector('#description-editor');
                    descriptionInput.value = quill.root.innerHTML;
                    $('#hidden_description').val(quill.getText().trim());
                    const submitButton = document.querySelector('#submit-btn');
                    submitButton.disabled = true;
                    submitButton.textContent = 'Please wait...';
                    const form = document.querySelector('#pageForm');
                    form.submit();
                })
                .onFail((fields) => {
                    const submitButton = document.querySelector('#submit-btn');
                    submitButton.disabled = false;
                    submitButton.textContent = 'Submit';
                });
        });

        function imagePreview(input) {
            const file = input.files[0];
            const preview = document.getElementById('image-preview');
            const link = document.getElementById('image_link');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    link.href = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = "{{ asset('assets/backend/images/picture.png') }}";
                link.href = "{{ asset('assets/backend/images/picture.png') }}";
            }
        }
    </script>
@endpush
