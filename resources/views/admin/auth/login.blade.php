<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>DPS | Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />
    <link rel="shortcut icon" href="{{ asset('assets/frontend/img/favicon.png') }}">
    <script src="{{ asset('assets/backend/js/config.js') }}"></script>
    <link href="{{ asset('assets/backend/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/css/toastr.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/backend/css/laravel-toaster-magic.css') }}" rel="stylesheet" type="text/css">
</head>

<body class="authentication-bg position-relative">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-lg-10">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6 d-none d-lg-block p-2">
                                <img src="{{ asset('assets/backend/images/login-bg.jpg') }}" alt=""
                                    class="img-fluid rounded h-100">
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex flex-column h-100">
                                    <div class="auth-brand p-4">
                                        <a href="index.html" class="logo-light">
                                            <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="logo"
                                                height="100">
                                        </a>
                                        <a href="index.html" class="logo-dark">
                                            <img src="{{ asset('assets/frontend/img/logo.png') }}"
                                                alt="dark logo" height="100">
                                        </a>
                                    </div>
                                    <div class="p-4 my-auto">
                                        <h4 class="fs-20">Sign In</h4>
                                        <p class="text-muted mb-3">Enter your email address and password to access
                                            account.
                                        </p>
                                        <form action="{{ route('login.authenticate') }}" method="POST" id="login-form">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Email address</label>
                                                <input class="form-control" type="email" id="emailaddress" name="email" value="{{ old('email') }}"
                                                    required="" placeholder="Email address">
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control" type="password" name="password" required=""
                                                    id="password" placeholder="Password">
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="checkbox-signin">
                                                    <label class="form-check-label" for="checkbox-signin">Remember
                                                        me</label>
                                                </div>
                                            </div>
                                            <div class="mb-0 text-start">
                                                <button class="btn btn-soft-primary w-100" type="submit"><i
                                                        class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log
                                                        In</span> </button>
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
    <script src="{{ asset('assets/backend/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/just-validate.production.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/laravel-toaster-magic.js') }}"></script>
    <script>
        const validation = new JustValidate('#login-form');
        validation
            .addField('#emailaddress', [{
                    rule: 'required',
                    errorMessage: 'The email address field is required.',
                },
                {
                    rule: 'email',
                    errorMessage: 'Please enter a valid email address.',
                }
            ])
            .addField('#password', [{
                rule: 'required',
                errorMessage: 'The password field is required.',
            }, ])
            .onSuccess((event) => {
                event.target.submit();
            });
    </script>
    @if (session()->has('success'))
        <script type="text/javascript">
            $(function() {
                toastMagic.success("{{ session()->get('success') }}");
            });
        </script>
    @endif
    @if (session()->has('error'))
        <script type="text/javascript">
            $(function() {
                toastMagic.error("{{ session()->get('error') }}");
            });
        </script>
    @endif
</body>

</html>
