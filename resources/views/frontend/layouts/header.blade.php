<header>
    <div class="bd-header">
        <div class="bd-header-top bd-header-top-2 d-none d-xl-block">
            <div class="bd-header-top-clip-shape"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bd-header-top-wrapper d-flex justify-content-between">
                            <div class="bd-header-top-left">
                                <div class="bd-header-meta-items-2 d-flex align-items-center">
                                    <div class="bd-header-meta-item is-white d-flex align-items-center">
                                        <div class="bd-header-meta-icon">
                                            <i class="fa-sharp fa-solid fa-flag"></i>
                                        </div>
                                        <div class="bd-header-meta-text">
                                            <p>Journey Since 2025</p>
                                        </div>
                                    </div>
                                    <div class="bd-header-meta-item d-flex align-items-center">
                                        <div class="bd-header-meta-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="bd-header-meta-text">
                                            <p><a href="javascript:void(0)">{{ contactAddress() }}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bd-header-top-right d-flex align-items-center">
                                <div class="bd-header-meta-items d-flex align-items-center">
                                    <div class="bd-header-meta-item d-flex align-items-center">
                                        <div class="bd-header-meta-icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="bd-header-meta-text">
                                            <p><a href="mailto:{{ contactEmail() }}">{{ contactEmail() }}</a></p>
                                        </div>
                                    </div>
                                    <div class="bd-header-meta-item d-flex align-items-center">
                                        <div class="bd-header-meta-icon">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div class="bd-header-meta-text">
                                            <p><script>document.write(new Date().toLocaleString())</script></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="header-sticky" class="bd-header-bottom-2">
            <div class="bd-header-bottom-clip-shape"></div>
            <div class="container">
                <div class="mega-menu-wrapper p-relative">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="bd-header-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/frontend/img/') }}" alt="logo">
                            </a>
                        </div>
                        <div class="bd-main-menu d-none d-lg-flex align-items-center">
                            <nav id="mobile-menu">
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('about-us') }}">About</a></li>
                                    <li class="has-dropdown">
                                        <a href="{{ route('photos') }}">Gallery</a>
                                        <ul class="submenu">
                                            <li><a href="{{ route('photos') }}">Photo</a></li>
                                            <li><a href="{{ route('videos') }}">Video</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('media') }}">Media</a></li>
                                </ul>
                                <div class="bd-header-btn d-block d-xl-none">
                                    <a href="javascript:void(0)" class="bd-btn" data-bs-toggle="modal" data-bs-target="#enquiryModal">
                                        <span class="bd-btn-inner">
                                            <span class="bd-btn-normal">Admissions</span>
                                            <span class="bd-btn-hover">Admissions</span>
                                        </span>
                                    </a>
                                </div>
                            </nav>
                        </div>
                        <div class="bd-header-bottom-right d-flex justify-content-end align-items-center">
                            <div class="bd-header-meta-item d-none bd-header-menu-meta d-xxl-flex align-items-center">
                                <div class="bd-header-meta-icon">
                                    <i class="flaticon-phone-call"></i>
                                </div>
                                <div class="bd-header-meta-text">
                                    <p><a href="tel:{{ contactPhone() }}">{{ contactPhone() }}</a></p>
                                </div>
                            </div>
                            <div class="bd-header-btn d-none d-xl-block">
                                <a href="javascript:void(0)" class="bd-btn" data-bs-toggle="modal" data-bs-target="#enquiryModal">
                                    <span class="bd-btn-inner">
                                        <span class="bd-btn-normal">Admissions</span>
                                        <span class="bd-btn-hover">Admissions</span>
                                    </span>
                                </a>
                            </div>
                            <div class="header-hamburger">
                                <button type="button" class="hamburger-btn offcanvas-open-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

