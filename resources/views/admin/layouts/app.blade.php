<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>DPS | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/frontend/img/favicon.png') }}">

    <!-- Datatables css -->
    <link href="{{ asset('assets/backend/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/backend/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/daterangepicker/daterangepicker.css') }}">
    <!-- Vector Map css -->
    <link rel="stylesheet"
        href="{{ asset('assets/backend/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Theme Config Js -->
    <script src="{{ asset('assets/backend/js/config.js') }}"></script>
    <!-- App css -->
    <link href="{{ asset('assets/backend/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons css -->
    <link href="{{ asset('assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/css/laravel-toaster-magic.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/backend/vendor/sweetalert2/sweetalert2.min.css') }}"
        rel="stylesheet"type="text/css" />
    <!-- Select2 css -->
    <link href="{{ asset('assets/backend/vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<style>
    .form-switch .form-check-input {
        width: 4em;
        height: 2em;
    }

    .select2-selection__clear {
        color: #d6cdce;
        font-size: 24px;
        font-weight: 500;
        margin-right: 20px;
        transition: all .2s ease-in-out;
    }

    .select2-selection__clear:hover {
        color: #dc3545;
        font-size: 24px;
        font-weight: 500;
        margin-right: 20px;
    }

    .cancelBtn {
        color: red !important;
        font-size: 24px;
        font-weight: 500;
        transition: all .2s ease-in-out;
        position: absolute;
        top: 36px;
        margin-left: 28%;
    }

    .cancelBtn:hover {
        color: #dc3545 !important;
        cursor: pointer;
        font-size: 24px;
        font-weight: 500;
    }

    .select2-container--default .select2-selection--single {
        background: #f6f6f6 !important;
        padding: 5px 0 10px 10px !important;
        /* border: none !important; */
        height: initial !important;

    }

    .select2-container--default .select2-selection--single span {
        font-family: var(--font);
        color: #000000 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 17px;
        right: 10px;
    }

    .select2-dropdown {
        border: none;
        background: #fff;
    }

    .select2-results__option {
        font-family: var(--font);
        font-size: 16px;
    }

    ::-moz-focus-inner {
        padding: 0;

        border-style: none;

    }

    ::-moz-focus-inner {
        padding: 0;

        border-style: none;

    }

    .select2-container--default .select2-selection--single .select2-selection__clear {
        margin-right: 30px !important;
    }
</style>

<body>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Topbar Start ========== -->
        @include('admin.layouts.topbar')
        <!-- ========== Topbar End ========== -->
        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.layouts.sidebar')
        <!-- ========== Left Sidebar End ========== -->
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            @yield('content')
            <!-- content -->
            <!-- Footer Start -->
            @include('admin.layouts.footer')
            <!-- end Footer -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->
    <!-- Vendor js -->
    @stack('plugin-scripts')
    <script src="{{ asset('assets/backend/js/vendor.min.js') }}"></script>
    <!-- Datatables js -->
    <script src="{{ asset('assets/backend/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
    </script>
    <script src="{{ asset('assets/backend/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js') }}">
    </script>
    <script src="{{ asset('assets/backend/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}">
    </script>
    <script src="{{ asset('assets/backend/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <!-- Daterangepicker js -->
    <script src="{{ asset('assets/backend/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Apex Charts js -->
    <script src="{{ asset('assets/backend/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Vector Map js -->
    <script src="{{ asset('assets/backend/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
    </script>
    <script
        src="{{ asset('assets/backend/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
    </script>
    <!-- Dashboard App js -->
    <script src="{{ asset('assets/backend/js/pages/dashboard.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('assets/backend/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/just-validate.production.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/laravel-toaster-magic.js') }}"></script>
    <!--  Select2 Plugin Js -->
    <script src="{{ asset('assets/backend/vendor/select2/js/select2.min.js') }}"></script>
    @stack('js')
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
