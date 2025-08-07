<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DPS HRIT Kids | @yield('title')</title>
    <!-- META Description: Add a short summary -->
    <meta name="description" content="DPS HRIT Kids is a leading preschool in Ghaziabad focused on holistic child development and joyful learning.">

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- KEYWORDS (optional, low SEO impact) -->
    <meta name="keywords" content="DPS HRIT Kids, Ghaziabad preschool, best play school, kindergarten in Ghaziabad, DPS Kids HRIT">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.dpshritkids.in/" />

    <!-- Favicons -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/favicon.png')}}">

    <!-- Open Graph (for Facebook and other social media previews) -->
    <meta property="og:title" content="DPS HRIT Kids - Best Preschool in Ghaziabad" />
    <meta property="og:description" content="Join DPS HRIT Kids for a joyful and nurturing early learning experience. Admissions open!" />
    <meta property="og:url" content="https://www.dpshritkids.in/" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('assets/frontend/img/social-preview.jpg') }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/nouislider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/backtotop.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon_kindedo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}">
    <!-- Select2 css -->
    <link href="{{ asset('assets/backend/vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/css/laravel-toaster-magic.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="loading">
        <div id="preloader">
            <div class="preloader-thumb-wrap">
                <div class="preloader-thumb">
                    <div class="preloader-border"></div>
                    <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="img not found!">
                </div>
            </div>
        </div>
    </div>
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    @include('frontend.layouts.header')
    @yield('content')
    @include('frontend.layouts.footer')
    <div class="offcanvas__area">
        <div class="offcanvas__bg"></div>
        <div class="offcanvas__wrapper">
            <div class="offcanvas__content">
                <div class="offcanvas__top mb-40 d-flex justify-content-between align-items-center">
                    <div class="offcanvas__logo logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="logo">
                        </a>
                    </div>
                    <div class="offcanvas__close">
                        <button class="offcanvas__close-btn">
                            <i class="fa-thin fa-times"></i>
                        </button>
                    </div>
                </div>
                {{-- <div class="offcanvas__search mb-0">
                    <form action="#">
                        <button type="submit"><i class="flaticon-search"></i></button>
                        <input type="text" placeholder="Search here">
                    </form>
                </div> --}}
                <div class="mobile-menu fix mt-40"></div>
                {{-- <div class="offcanvas__about d-none d-lg-block mt-30 mb-30">
                    <h4>About Kindedo</h4>
                    <p>With the help of teachers and environment as the third teacher, students
                        have opportunities to confidently take risks.</p>
                </div> --}}
                {{-- <div class="offcanvas__contact mt-30 mb-30">
                    <h4>Contact Info</h4>
                    <ul>
                        <li class="d-flex align-items-center gap-2">
                            <div class="offcanvas__contact-icon">
                                <a target="_blank"
                                    href="../../../../www.google.com/maps/place/Dhaka/%4023.7806207%2c90.3492859%2c12z/data%3d%213m1%214b1%214m5%213m4%211s0x3755b8b087026b81_0x8fa563bbdd5904c2%218m2%213d23.8104753%214d90.html">
                                    <i class="fal fa-map-marker-alt"></i></a>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a target="_blank"
                                    href="../../../../www.google.com/maps/place/Dhaka/%4023.7806207%2c90.3492859%2c12z/data%3d%213m1%214b1%214m5%213m4%211s0x3755b8b087026b81_0x8fa563bbdd5904c2%218m2%213d23.8104753%214d90.html">12/A,
                                    Mirnada City Tower, NYC</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <div class="offcanvas__contact-icon">
                                <a href="tel:+088889797697"><i class="far fa-phone"></i></a>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a href="tel:+088889797697">088889797697</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <div class="offcanvas__contact-icon">
                                <a href="mailto:support@gmail.com"><i class="fal fa-envelope"></i></a>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a href="mailto:support@gmail.com">support@mail.com</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="offcanvas__social">
                    <ul>
                        <li><a target="_blank" href="../../../../www.facebook.com/index.html"><i
                                    class="fa-brands fa-facebook-f"></i></a>
                        </li>
                        <li><a target="_blank" href="../../../../twitter.com/index.html"><i
                                    class="fa-brands fa-twitter"></i></a></li>
                        <li><a target="_blank" href="../../../../www.youtube.com/index.html"><i
                                    class="fa-brands fa-youtube"></i></a>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="body-overlay"></div>
    <div class="bd-search-popup-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bd-search-popup">
                        <div class="bd-search-form">
                            <form action="#">
                                <div class="bd-search-input">
                                    <input type="search" placeholder="Type here to serach ...">
                                    <div class="bd-search-submit">
                                        <button type="submit"><i class="flaticon-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div class="bd-search-close">
                                <div class="bd-search-close-btn">
                                    <button><i class="fa-thin fa-close"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bd-search-overlay"></div>
    <!-- Modal -->
    <div class="modal fade application-form-modal" id="enquiryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="admissionForm" action="{{ route('admission.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="modal-rightbox">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="offcanvas__close">
                                                <button type="button "class="offcanvas__close-btn"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="fa-thin fa-times"></i>
                                                </button>
                                            </div>
                                            <h5 class="modal-title text-center" id="exampleModalLabel">For Admissions
                                            </h5>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="bd-contact-input mb-0">
                                                <label for="admission_for">Admission For <sup><i
                                                            class="fa-solid fa-star-of-life"></i></sup></label>
                                                <select name="admission_for" id="admission_for"
                                                    class="form-control">
                                                    <option value="" disabled selected>Please Select</option>
                                                    <option value="playgroup">Play Group</option>
                                                    <option value="nursery">Nursery</option>
                                                    <option value="lkg">LKG</option>
                                                    <option value="ukg">UKG</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="bd-contact-input">
                                                <label for="name">Student Name <sup><i
                                                            class="fa-solid fa-star-of-life"></i></sup></label>
                                                <input id="student_name" type="text" name="student_name"
                                                    placeholder="Student Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="bd-contact-input">
                                                <label for="email">Email Id<sup><i
                                                            class="fa-solid fa-star-of-life"></i></sup></label>
                                                <input id="email" type="text" name="email"
                                                    placeholder="Email Id">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="bd-contact-input">
                                                <label for="phone">Mobile Number<sup><i
                                                            class="fa-solid fa-star-of-life"></i></sup></label>
                                                <input id="phone" type="text" name="phone"
                                                    placeholder="Mobile Number">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="bd-contact-input">
                                                <label for="textarea">Address<sup><i class="fa-solid fa-star-of-life"></i></sup></label>
                                                <textarea id="address" name="address" placeholder="Address"></textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="bd-contact-input mb-15">
                                                <label for="textarea">State<sup><i
                                                            class="fa-solid fa-star-of-life"></i></sup></label>
                                                <select name="state" id="state" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="bd-contact-input mb-15">
                                                <label for="textarea">City<sup><i
                                                            class="fa-solid fa-star-of-life"></i></sup></label>
                                                <select name="city" id="city" class="form-control">
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-12">
                                            <div class="bd-contact-agree-btn text-center">
                                                <button type="submit" id="submit-btn" class="bd-btn">
                                                    <span class="bd-btn-inner">
                                                        <span class="bd-btn-normal">Submit</span>
                                                        <span class="bd-btn-hover">Submit</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @stack('plugin-scripts')
    <!-- JS here -->
    <script src="{{ asset('assets/frontend/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/vendor/waypoints.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/meanmenu.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/slick.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/nouislider.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/parallax.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/backtotop.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/nice-select.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/isotope-pkgd.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/imagesloaded-pkgd.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.odometer.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/just-validate.production.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/laravel-toaster-magic.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
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
    <script>
        const validation = new JustValidate('#admissionForm');
        validation
            .addField('#admission_for', [{
                rule: 'required',
                errorMessage: 'The admission for field is required.',
            }])
            .addField('#student_name', [{
                    rule: 'required',
                    errorMessage: 'The student name field is required.',
                },
                {
                    rule: 'customRegexp',
                    value: /^[A-Za-z\s]+$/,
                    errorMessage: 'Please enter an student name containing only letters.',
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
                    errorMessage: 'The student name must not contain double spaces.',
                },
                {
                    validator: (value) => {
                        const hasLeadingSpace = /^\s/.test(value);
                        return !hasLeadingSpace;
                    },
                    errorMessage: 'The student name must not start with a space.',
                },
            ])
            .addField('#email', [{
                    rule: 'required',
                    errorMessage: 'The email field is required.',
                },
                {
                    rule: 'email',
                    errorMessage: 'Please enter a valid email.',
                },
            ])
            .addField('#phone', [{
                    rule: 'required',
                    errorMessage: 'The phone field is required.',
                },
                {
                    rule: 'customRegexp',
                    value: /^([6-9]{1})\d{9}$/,
                    errorMessage: 'Please enter a valid mobile.',
                },
                {
                    rule: 'minLength',
                    value: 10,
                    errorMessage: 'The mobile must be at least 10 digits long.',
                },
                {
                    rule: 'maxLength',
                    value: 10,
                    errorMessage: 'The mobile must be at most 10 digits long.',
                }
            ])
            .addField('#address', [{
                    rule: 'required',
                    errorMessage: 'The address field is required.',
            }])
            // .addField('#city', [{
            //         rule: 'required',
            //         errorMessage: 'The city field is required.',
            // }])
            .onSuccess((event) => {
                const submitButton = document.querySelector('#submit-btn');
                submitButton.disabled = true;
                submitButton.textContent = 'Please wait...';
                const form = document.querySelector('#admissionForm');
                form.submit();
            })
            .onFail((fields) => {
                const submitButton = document.querySelector('#submit-btn');
                submitButton.disabled = false;
                submitButton.textContent = 'Submit';
            });
        $(document).ready(function() {
            $('#state').select2({
                placeholder: "Please Select",
                allowClear: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: "{{ route('states.list') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            country_id: $('#country').val(),
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
                                    text: item.name.charAt(0).toUpperCase() + item.name.slice(1)
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
            }).on('select2:unselecting', function() {
                $(this).data('unselecting', true);
            }).on('select2:opening', function(e) {
                if ($(this).data('unselecting')) {
                    $(this).removeData('unselecting');
                    e.preventDefault();
                }
            }).on('select2:select', function(e) {
                validation.revalidateField('#state');
            });
            $('#city').select2({
                placeholder: "Please Select",
                allowClear: true,
                width: 'resolve',
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: "{{ route('cities.list') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            state_id: $('#state').val(),
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
                                    text: item.name.charAt(0).toUpperCase() + item.name.slice(1)
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
            }).on('select2:unselecting', function() {
                $(this).data('unselecting', true);
            }).on('select2:opening', function(e) {
                if ($(this).data('unselecting')) {
                    $(this).removeData('unselecting');
                    e.preventDefault();
                }
            }).on('select2:select', function(e) {
                validation.revalidateField('#city');
            });
            $('#admission_for').select2({
                placeholder: "Please Select",
                allowClear: true,
            }).on('select2:unselecting', function() {
                $(this).data('unselecting', true);
            }).on('select2:opening', function(e) {
                if ($(this).data('unselecting')) {
                    $(this).removeData('unselecting');
                    e.preventDefault();
                }
            }).on('select2:select', function(e) {
                validation.revalidateField('#admission_for');
            });
        });
    </script>
@verbatim
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "DPS HRIT Kids",
  "url": "https://www.dpshritkids.in",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "HRIT Campus",
    "addressLocality": "Ghaziabad",
    "addressRegion": "UP",
    "postalCode": "201001",
    "addressCountry": "IN"
  }
}
</script>
@endverbatim


</body>
</html>
