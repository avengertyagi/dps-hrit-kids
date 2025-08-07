<footer>
    <div class="bd-footer-area fix pt-170 theme-bg-6">
        <div class="bd-wave-wrapper">
            <div class="bd-wave"></div>
            <div class="bd-wave"></div>
        </div>
        <div class="theme-bg bd-footer-wrapper p-relative pt-60">
            <div class="container">
                <!-- footer area bg here  -->
                <div class="bd-footer-bg-2" data-background="{{ asset('assets/frontend/img/bg/bg-shape.jpg')}}"></div>
                <div class="bd-footer-top">
                    <div class="row align-items-end">
                        <div class="col-lg-6">
                            <div class="bd-footer-top-widget-1 mb-60">
                                <div class="bd-footer-logo mb-15">
                                    <a href="{{ route('home') }}"> 
                                        <img src="{{ asset('assets/frontend/img/logo/logo-white.svg')}}" alt="img not found!">
                                    </a>
                                </div>
                                <div class="bd-footer-widget-content is-white mb-40">
                                    <p>In our Adult Participation programs, for most students, it is their first program in Kindedo.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bd-footer-2 pb-15 pt-60 p-relative">
                    <div class="bd-footer-shape d-none d-lg-block">
                        <img src="{{ asset('assets/frontend/img/shape/white-curved-line.png')}}" alt="img not found!">
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="bd-footer-widget-2 mb-50">
                                <div class="bd-footer-widget-content">
                                    <h4 class="bd-footer-widget-title is-white mb-20">Quick links</h4>
                                    <div class="bd-footer-list bd-footer-list-2">
                                        <ul>
                                            <li><a href="{{ route('home') }}">Home</a></li>
                                            <li><a href="{{ route('about-us') }}">About</a></li>
                                            <li><a href="{{ route('photos') }}">Gallery</a></li>
                                            <li><a href="{{ route('media') }}">Media</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="bd-footer-widget-2 mb-50">
                                <div class="bd-footer-widget-content">
                                    <h4 class="bd-footer-widget-title is-white mb-20">Social links</h4>
                                    <div class="bd-footer-list bd-footer-list-2">
                                        <div class="bd-footer-social-wrapper is-white">
                                            <div class="bd-footer-social">
                                                <a href="{{ facebooklink() }}"><i class="fa-brands fa-facebook-f"></i>facebook</a>
                                            </div>
                                            <div class="bd-footer-social">
                                                <a href="{{ instagramlink() }}"><i class="fa-brands fa-instagram"></i>Instagram</a>
                                            </div>
                                            <div class="bd-footer-social">
                                                <a href="{{ youtubelink() }}"><i class="fa-brands fa-youtube"></i>youtube</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="bd-footer-widget-2 mb-50">
                                <div class="bd-footer-widget-content">
                                    <h4 class="bd-footer-widget-title is-white mb-20">Contact Us</h4>
                                    <div class="bd-footer-contact is-white">
                                        <ul>
                                            <li>
                                                <i class="fa-light fa-location-dot"></i>
                                                <a href="javascript:void(0)">{{ contactAddress() }}</a>
                                            </li>
                                            <li>
                                                <i class="fa-light fa-phone"></i>
                                                <a href="tel:{{ contactPhone() }}">{{ contactPhone() }}</a>
                                            </li>
                                            <li>
                                                <i class="fa-light fa-envelope"></i>
                                                <a href="mailto:{{ contactEmail() }}">{{ contactEmail() }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bd-footer-copyright pb-5 pt-25">
                    <div class="bd-footer-copyright-wrap d-flex justify-content-center">
                        <div class="bd-footer-copyright-text is-white pb-20">
                            <p>Copyrighted by &copy; <script> document.write(new Date().getFullYear()) </script></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

