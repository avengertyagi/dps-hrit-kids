@extends('admin.layouts.app')
@section('title')
    {{ 'Edit Media' }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title">Edit Media</h4>
                        </div>
                        <form class="form-horizontal" id="mediaForm" method="POST"
                            action="{{ route('media.update', $module_data->id) }}" class="form-horizontal"
                            autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="mb-2 row">
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="title">Title</label><code
                                            class="text-danger fs-4">*</code>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ old('title', $module_data->widget_name ?? '') }}" placeholder="Title"
                                            maxlength="50">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="url">URL</label><code
                                            class="text-danger fs-4">*</code>
                                        <input type="text" class="form-control" id="url" name="content" value="{{ old('url', $module_data->content ?? '') }}" placeholder="URL">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-md-12 text-end">
                                        <a href="{{ route('media.index') }}" type="button"
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
        const validation = new JustValidate('#mediaForm');
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
            ]).addField('#url', [{
                rule: 'required',
                errorMessage: 'The url field is required.',
            }]).onSuccess((event) => {
                const submitButton = document.querySelector('#submit-btn');
                submitButton.disabled = true;
                submitButton.textContent = 'Please wait...';
                const form = document.querySelector('#mediaForm');
                form.submit();
            })
            .onFail((fields) => {
                const submitButton = document.querySelector('#submit-btn');
                submitButton.disabled = false;
                submitButton.textContent = 'Submit';
            });
    </script>
@endpush
