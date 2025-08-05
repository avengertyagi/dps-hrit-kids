@extends('admin.layouts.app')
@section('title')
    {{ 'Settings' }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title mb-0">Settings</h4>
                        </div>
                        <div class="card-body">
                            <form id="settingsForm" method="POST" action="{{ route('settings.store') }}">
                                @csrf
                                <div id="basicwizard">
                                    <ul class="nav nav-pills nav-justified form-wizard-header mb-4" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a href="#contacttab" data-bs-toggle="tab" data-toggle="tab"
                                                class="nav-link rounded-0 py-2 active" aria-selected="true" role="tab">
                                                <i class="ri-account-circle-line fw-normal fs-20 align-middle me-1"></i>
                                                <span class="d-none d-sm-inline">Contact Us</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#socialtab" data-bs-toggle="tab" data-toggle="tab"
                                                class="nav-link rounded-0 py-2" aria-selected="false" tabindex="-1"
                                                role="tab">
                                                <i class="ri-profile-line fw-normal fs-20 align-middle me-1"></i>
                                                <span class="d-none d-sm-inline">Social link</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content b-0 mb-0">
                                        <div class="tab-pane active show" id="contacttab" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label" for="address">Address<code
                                                                class="text-danger fs-4">*</code></label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" id="address"
                                                                name="address" value="{{ $module_data['address'] ?? '' }}"
                                                                placeholder="Address">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label" for="phone">
                                                            Phone<code class="text-danger fs-4">*</code></label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="phone" name="phone"
                                                                class="form-control"
                                                                value="{{ $module_data['phone'] ?? '' }}"
                                                                placeholder="Phone">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label" for="email">Email<code
                                                                class="text-danger fs-4">*</code></label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="email" name="email"
                                                                class="form-control"
                                                                value="{{ $module_data['email'] ?? '' }}"
                                                                placeholder="Email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="socialtab" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label" for="facebook">Facebook<code
                                                                class="text-danger fs-4">*</code></label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="facebook" name="facebook"
                                                                class="form-control"
                                                                value="{{ $module_data['facebook'] ?? '' }}"
                                                                placeholder="Facebook">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label" for="youtube">Youtube<code
                                                                class="text-danger fs-4">*</code></label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="youtube" name="youtube"
                                                                class="form-control"
                                                                value="{{ $module_data['youtube'] ?? '' }}"
                                                                placeholder="Youtube">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="pager wizard mb-0 list-inline">
                                                <li class="next list-inline-item float-end">
                                                    <button id="submit-btn" type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        const validation = new JustValidate('#settingsForm');
        validation
            .addField('#address', [{
                rule: 'required',
                errorMessage: 'The title field is required.',
            }])
            .addField('#phone', [{
                    rule: 'required',
                    errorMessage: 'The phone field is required.',
                },
                {
                    rule: 'customRegexp',
                    value: /^([6-9]{1})\d{9}$/,
                    errorMessage: 'Please enter a valid mobile number.',
                },
                {
                    rule: 'minLength',
                    value: 10,
                    errorMessage: 'The mobile number must be at least 10 digits long.',
                },
                {
                    rule: 'maxLength',
                    value: 10,
                    errorMessage: 'The mobile number must be at most 10 digits long.',
                }
            ])
            .addField('#email', [{
                    rule: 'required',
                    errorMessage: 'The email field is required.',
                },
                {
                    rule: 'email',
                    errorMessage: 'Please enter a valid email address.',
                }
            ])
            .addField('#facebook', [{
                rule: 'required',
                errorMessage: 'The facebook field is required.',
            }])
            .addField('#youtube', [{
                rule: 'required',
                errorMessage: 'The youtube field is required.',
            }])
            .onSuccess(() => {
                console.log("Form validated successfully!")
                $("#submit-btn").prop("disabled", true).text("Please wait...");
                const form = document.querySelector('#settingsForm');
                form.submit();
            });
    </script>
@endpush
