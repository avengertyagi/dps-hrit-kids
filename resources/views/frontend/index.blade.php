@extends('frontend.layouts.app')
@section('title')
    {{ 'Home' }}
@endsection
@section('content')
    <main>
        <section class="bd-hero-area-2 p-relative">
            <div class="bd-hero-social-wrapper is-white">
                <div class="bd-hero-social">
                    <a href="{{ facebooklink() }}"><i class="fa-brands fa-facebook-f"></i>facebook</a>
                </div>
                <div class="bd-hero-social">
                    <a href="javascript:void(0)"><i class="fa-brands fa-instagram"></i>Instagram</a>
                </div>
                <div class="bd-hero-social">
                    <a href="{{ youtubelink() }}"><i class="fa-brands fa-youtube"></i>youtube</a>
                </div>
            </div>
            <div class="bd-hero-navigation mb-15 d-none d-md-flex">
                <button class="bd-hero-prev">
                    <i class="fa-regular fa-angle-left"></i>
                </button>
                <button class="bd-hero-next">
                    <i class="fa-regular fa-angle-right"></i>
                </button>
            </div>
            <div class="swiper-container bd-hero-slider bd-hero-active">
                <div class="swiper-wrapper">
                    @if (isset($module_data['banners']) && count($module_data['banners']) > 0)
                        @foreach ($module_data['banners'] as $banner)
                            <div class="swiper-slide">
                                <div class="bd-hero-inner-2">
                                    <div class="container">
                                        <div class="bd-hero-shape-wrapper d-none d-lg-block">
                                            <div class="bd-hero-shape bd-hero-shape-2">
                                                <img src="{{ asset('assets/frontend/img/shape/curved-line-2.png') }}"
                                                    alt="Shape not found">
                                            </div>
                                            <div class="bd-hero-shape bd-hero-shape-1">
                                                <img src="{{ asset('assets/frontend/img/shape/curved-line-2.png') }}"
                                                    alt="Shape not found">
                                            </div>
                                        </div>
                                        <div class="bd-hero-2">
                                            <div class="bd-hero-bg"
                                                data-background="{{ asset($banner->image ?? 'assets/frontend/img/hero/slider-3.jpg') }}">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="bd-hero-content-wrapper-2 d-flex align-items-center">
                                                        <div class="bd-hero-content bd-hero-content-2 is-white">
                                                            <span class="animate__animated" data-animation="fadeInUp"
                                                                data-delay=".3s">DPS HRIT KIDS Program</span>
                                                            <h1 class="bd-hero-title animate__animated"
                                                                data-animation="fadeInUp" data-delay=".5s">
                                                                {{ $banner->title ?? '' }}
                                                            </h1>
                                                            <div class="bd-hero-btn animate__animated"
                                                                data-animation="fadeInUp" data-delay=".7s">
                                                                <a href="javascript:void(0)" class="bd-btn">
                                                                    <span class="bd-btn-inner">
                                                                        <span class="bd-btn-normal">Admission open
                                                                            <script>
                                                                                document.write(new Date().getFullYear())
                                                                            </script>-
                                                                            <script>
                                                                                document.write(new Date().getFullYear() + 1)
                                                                            </script>
                                                                        </span>
                                                                        <span class="bd-btn-hover">Admission open
                                                                            <script>
                                                                                document.write(new Date().getFullYear())
                                                                            </script>-
                                                                            <script>
                                                                                document.write(new Date().getFullYear() + 1)
                                                                            </script>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <section class="bd-promotion-area pt-60">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="bd-promotion-thumb-wrapper mb-60">
                            <div class="bd-promotion-thumb">
                                <div class="bd-promotion-thumb-mask p-relative wow fadeInLeft" data-wow-delay=".3s"
                                    data-wow-duration="1">
                                    <img src="{{ asset($module_data['about_section']->featured_image ?? '') }}"
                                        alt="Image not found">
                                    <div class="panel wow"></div>
                                </div>
                            </div>
                            <div class="bd-promotion-shape d-none d-lg-block">
                                <img src="{{ asset('assets/frontend/img/shape/tripple-line.png') }}" alt="Shape not found">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="bd-promotion mb-60 wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="bd-section-title-wrapper mb-35">
                                <h2 class="bd-section-title mb-10">
                                    {{ $module_data['about_section']->section_title ?? '' }}
                                </h2>
                                <p>{{ $module_data['about_section']->content ?? '' }}</p>
                            </div>
                            <div class="bd-promotion-list mb-50">
                                <ul>
                                    <li>We believe every child is intelligent so we care.</li>
                                    <li>Teachers make a difference of your child.</li>
                                </ul>
                            </div>
                            <div class="bd-promotion-btn-wrapper flex-wrap">
                                <div class="bd-promotion-btn">
                                    <a href="{{ route('about-us') }}" class="bd-btn">
                                        <span class="bd-btn-inner">
                                            <span class="bd-btn-normal">View More</span>
                                            <span class="bd-btn-hover">View More</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="unique-offer-section">
            <div class="container">
                <div class="row align-items-lg-center">
                    <div class="col-lg-6">
                        <div class="block-header">
                            <h2 class="bd-section-title mb-10">
                                {{ $module_data['unique_offering_section']->section_title ?? '' }}</h2>
                        </div>
                        <p>{{ $module_data['unique_offering_section']->content ?? '' }}</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="our_usps">
                            <div class="circle_outer">
                                <div class="circle-container">
                                    <div class="learning-item" data-learn-tab="#0"
                                        style="transform: rotate(0deg) translate(0px, -205px) rotate(0deg);"><img
                                            class="img-fluid" src="https://www.bachpanglobal.com/img/Smart Classes (1).webp"
                                            alt="Bachpan Smart Classes for Kids"title="Bachpan Smart Classes for Kids">
                                    </div>
                                    <div class="learning-item" data-learn-tab="#1"
                                        style="transform: rotate(45deg) translate(0px, -205px) rotate(-45deg);"><img
                                            class="img-fluid" src="https://www.bachpanglobal.com/img/Virtual Reality.webp"
                                            alt="Virtual Reality (VR) Classes for Kids"title="Virtual Reality (VR) Classes for Kids">
                                    </div>
                                    <div class="learning-item" data-learn-tab="#2"
                                        style="transform: rotate(90deg) translate(0px, -205px) rotate(-90deg);"><img
                                            class="img-fluid"
                                            src="https://www.bachpanglobal.com/img/SPROUT Curriculum (2).webp"
                                            alt="SPROUT Curriculum at Bachpan"title="SPROUT Curriculum at Bachpan">
                                    </div>
                                    <div class="learning-item" data-learn-tab="#3"
                                        style="transform: rotate(135deg) translate(0px, -205px) rotate(-135deg);"><img
                                            class="img-fluid"
                                            src="https://www.bachpanglobal.com/img/360° Support App (1).webp"
                                            alt="Bachpan 360 App"title="Bachpan 360 App"></div>
                                    <div class="learning-item" data-learn-tab="#4"
                                        style="transform: rotate(180deg) translate(0px, -205px) rotate(-180deg);"><img
                                            class="img-fluid"
                                            src="https://www.bachpanglobal.com/img/Montessori Toys (1).webp"
                                            alt="Montessori Toys" title="Montessori Toys"></di>
                                </div>
                                <div class="tab-element-content">
                                    <div class="for-tab start">
                                        <h3>Our USPs</h3>
                                    </div>
                                    <div class="for-tab" id="0">
                                        <h3>Smart Classes</h3>
                                        <p class="mb-0">Our Smart Classes consist of powerful visuals and
                                            curriculum-mapped content for increasing your child’s learning retention.
                                        </p>
                                    </div>
                                    <div class="for-tab" id="1">
                                        <h3>Virtual Reality (VR)</h3>
                                        <p class="mb-0">We are the first-ever preschool brand in India to use VR for
                                            your child’s experiential and futuristic learning.</p>
                                    </div>
                                    <div class="for-tab" id="2">
                                        <h3>SPROUT Curriculum</h3>
                                        <p class="mb-0">We at Bachpan are the pioneers in age-specific and integrated
                                            curriculum development for your child’s all-round growth.</p>
                                    </div>
                                    <div class="for-tab" id="3">
                                        <h3>360° Support App</h3>
                                        <p class="mb-0">No other preschool in India provides your child with an app
                                            like the 360°, making 500+ hours of digital content accessible and much
                                            more. </p>
                                    </div>
                                    <div class="for-tab" id="4">
                                        <h3>Montessori Toys</h3>
                                        <p class="mb-0">Our top-notch Montessori Toys ensure that your child learns
                                            while playing and also has fun while learning.</p>
                                    </div>
                                    <div class="for-tab" id="5">
                                        <h3>Concept Rooms</h3>
                                        <p class="mb-0">Our innovative Concept Rooms like the AV Room, Dining Room,
                                            Doll Room, and Ball Room foster your child’s multiple intelligences.</p>
                                    </div>
                                    <div class="for-tab" id="6">
                                        <h3>Robotime</h3>
                                        <p class="mb-0">Our Robotime Kit lays a solid foundation of STEAM learning
                                            and builds your child’s core life skills like problem-solving.</p>
                                    </div>
                                    <div class="for-tab" id="7">
                                        <h3>Speak-O-Kit</h3>
                                        <p class="mb-0">Our Speak-O-Kit is a nanotechnology-based passive learning
                                            tool that enables your child to learn from anywhere at any time.</p>
                                    </div>
                                </div>
                                <div class="my-paroller" data-paroller-factor="0.3" data-paroller-type="foreground"
                                    data-paroller-direction="vertical"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="why-choose-bachpan-sec pt-60 pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-header on-scroll pb-20">
                            <h2 class="bd-section-title mb-10 text-center">
                                {{ $module_data['why_choose_bachpan']->section_title ?? '' }} </h2>
                        </div>
                        <ol class="advantage-list pt-xs-0 pt-md-0 pt-lg-20 fun">
                            @if (isset($module_data['why_choose_bachpan_child']) && count($module_data['why_choose_bachpan_child']) > 0)
                                @foreach ($module_data['why_choose_bachpan_child'] as $key => $choose_bachpan_child)
                                    @php
                                        $classNames = ['funz', 'concept', 'skillz', 'tech'];
                                        $randomClass = $classNames[array_rand($classNames)];
                                    @endphp
                                    <li class="on-scroll fade-up {{ $randomClass }}">
                                        <div class="advantage-block">
                                            <h5 class="{{ $randomClass }}">
                                                {{ $choose_bachpan_child->section_title ?? '' }}
                                            </h5>
                                            <p>{{ $choose_bachpan_child->content ?? '' }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
        </section>
         <section class="bd-program-area pt-120 pb-120">
            <div class="container">
                <!-- program bg -->
                <div class="bd-gradient-bg"></div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="bd-section-title-wrapper text-center mb-55 wow fadeInUp" data-wow-duration="1s"
                             data-wow-delay=".2s">
                            <h2 class="bd-section-title mb-0">{{ $module_data['our_features_programs']->section_title ?? '' }}</h2>
                            <p>{{ $module_data['our_features_programs']->content ?? '' }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="bd-program-active swiper-container wow fadeInUp" data-wow-duration="1s"
                             data-wow-delay=".4s">
                            <div class="swiper-wrapper">
                                @if (isset($module_data['our_features_programs_child']) && count($module_data['our_features_programs_child']) > 0)
                                 @foreach ($module_data['our_features_programs_child'] as $key => $our_features_programs_child)
                                <div class="swiper-slide">
                                    <div class="bd-program">
                                        <div class="bd-program-thumb-wrapper">
                                            <a href="javascript:void(0)">
                                                <div class="bd-program-thumb">
                                                    <img src="{{ asset($our_features_programs_child->featured_image ?? '') }}" alt="Image not found">
                                                </div>
                                            </a>
                                            <div class="bd-program-shape">
                                                <svg width="97" height="61" viewBox="0 0 97 61" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M64.6716 54.1604C66.9487 53.8135 68.0029 53.176 70.1655 51.8716C72.687 50.3497 74.6533 48.7547 76.851 46.7751C81.5182 42.5716 85.6125 37.7759 88.3885 32.1351C89.3558 30.1686 90.1276 27.6273 90.1313 25.5758C90.1315 25.3005 90.1117 25.0277 90.0918 24.7549C90.0265 23.8818 90.2031 25.3139 90.0405 24.4639C89.9925 24.2075 89.5555 22.9191 89.7728 23.4319C89.2072 22.1159 89.0297 21.9948 87.919 21.0408C88.3994 21.4535 87.6126 20.8359 87.5796 20.8122C87.3117 20.6295 87.0241 20.4728 86.742 20.3146C86.1464 19.9801 86.0413 19.952 85.2752 19.7431C84.1901 19.448 82.8104 19.4448 81.687 19.6363C78.5001 20.1766 75.6296 21.8098 72.9716 23.5842C68.3495 26.675 64.3591 30.7652 60.7083 34.9302C57.6486 38.419 54.7864 42.1477 52.4483 46.1651C50.7786 49.0329 45.5641 47.1191 46.89 43.8848C51.1259 33.5329 58.2673 24.4618 60.3324 13.286C60.5123 12.3117 60.5829 11.5264 60.5346 10.2197C60.5086 9.53722 60.3305 8.76235 60.0088 8.17986C59.9287 8.03562 59.4795 7.46359 59.9681 8.0724C59.8265 7.8973 59.6603 7.74064 59.4975 7.586C58.9409 7.05461 60.0584 7.95649 59.4036 7.52241C59.2016 7.38715 58.978 7.28138 58.7599 7.17412C59.5708 7.57229 57.6109 6.91683 58.1827 6.98555C57.3018 6.87835 57.1842 6.93649 56.5835 7.0797C54.2764 7.62392 52.1345 9.91104 50.3687 12.0559C48.1084 14.8068 46.3554 18.0372 44.7495 21.1985C42.4766 25.6689 40.4435 30.4271 39.1985 35.2997C38.3627 38.5742 33.0058 38.039 33.2313 34.5522C33.5916 28.9728 33.2617 22.5516 29.4062 18.2114C26.7668 15.2407 23.0084 14.0789 19.1031 14.0364C15.4058 13.9974 11.8239 14.9631 8.76894 16.835C8.46428 17.0232 8.16959 17.2264 7.8819 17.4337C8.43815 17.0361 7.48374 17.7919 7.35335 17.9126C7.12532 18.1217 6.91976 18.3484 6.71218 18.5786C6.49139 18.8478 6.52116 18.8043 6.8015 18.4481C6.67742 18.6145 6.57085 18.791 6.46227 18.971C6.33953 19.1755 6.03656 19.9994 6.36393 19.1009C6.3243 19.2181 6.28817 19.3372 6.26107 19.4569C6.09281 20.0879 6.30183 18.7477 6.25786 19.3897C6.20414 20.1941 6.07556 18.8971 6.28012 19.6826C6.38155 19.9839 6.34925 19.9186 6.18121 19.4902C6.25911 19.6705 6.36665 19.8399 6.47068 20.0073C8.54804 23.3209 3.27758 26.3221 1.20373 23.0105C-1.32813 18.9724 1.35314 14.7891 4.67051 12.3172C8.5432 9.43318 13.6276 8.1448 18.3911 7.97801C23.9493 7.78467 29.5454 9.6761 33.4772 13.6823C38.7859 19.0949 39.7676 27.2972 39.2968 34.507C37.3071 34.259 35.3194 34.0075 33.3296 33.7595C34.8894 27.6545 37.5757 21.6679 40.5532 16.1388C43.6956 10.3081 48.0598 3.42806 54.7197 1.29441C60.5782 -0.583104 65.8989 3.60425 66.5299 9.38255C67.1754 15.2812 64.4622 21.4763 62.1681 26.7512C60.4793 30.6302 58.5384 34.3961 56.561 38.1364C55.7379 39.6914 54.9022 41.2438 54.0826 42.8009C53.7803 43.3731 53.4869 43.9458 53.1986 44.5261C53.0443 44.8337 52.3024 46.5149 52.7585 45.4015C50.9044 44.6437 49.0523 43.8824 47.2002 43.1212C50.572 37.3296 54.9473 32.0148 59.5792 27.1934C64.7323 21.8329 70.81 16.6656 77.9757 14.3106C84.0554 12.3087 90.9808 13.9268 94.5512 19.4886C97.6943 24.3837 95.8393 30.7009 93.4918 35.4782C90.5195 41.5238 85.8091 46.8692 80.8339 51.3476C76.879 54.9076 71.7076 59.1841 66.2523 60.0156C64.6203 60.2635 63.0014 59.5995 62.5384 57.8713C62.1353 56.4111 63.0341 54.4098 64.6716 54.1604Z"
                                                        fill="#00BBAE" />
                                                </svg>
                                            </div>
                                        </div>
                                        {!! $our_features_programs_child->content ?? '' !!}
{{--                                        <div class="bd-program-content mb-30">--}}
{{--                                            <h3 class="bd-program-title"><a class="hover-clr-1" href="program-details.html">Settling</a>--}}
{{--                                            </h3>--}}
{{--                                            <p>To round out our weekend of celebra tions, we are holding our reunion.</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="bd-program-info-wrapper theme-bg">--}}
{{--                                            <div class="bd-program-info">--}}
{{--                                                <h5 class="bd-program-info-title">4-5 Yrs <br><span>age</span></h5>--}}
{{--                                            </div>--}}
{{--                                            <div class="bd-program-info">--}}
{{--                                                <h5 class="bd-program-info-title">5 Days <br><span>weekly</span></h5>--}}
{{--                                            </div>--}}
{{--                                            <div class="bd-program-info">--}}
{{--                                                <h5 class="bd-program-info-title">3.30 Hrs<br><span>period</span></h5>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- program slider dots pagination  -->
                <div class="bd-program-pagination bd-dots-pagination"></div>
            </div>
        </section>
    </main>
@endsection
