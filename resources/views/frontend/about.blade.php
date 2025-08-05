@extends('frontend.layouts.app')
@section('title')
    {{ 'About Us' }}
@endsection
@section('content')
    <section class="bd-breadcrumb-area p-relative fix theme-bg">
        <div class="bd-breadcrumb-bg" data-background="{{ asset('assets/frontend/img/bg/breadcrumb-bg.jpg') }}"></div>
        <div class="bd-breadcrumb-wrapper mb-60 p-relative">
            <div class="container">
                <div class="bd-breadcrumb-shape d-none d-sm-block p-relative">
                    <div class="bd-breadcrumb-shape-1">
                        <img src="{{ asset('assets/frontend/img/shape/curved-line-2.png') }}" alt="img not found!">
                    </div>
                    <div class="bd-breadcrumb-shape-2">
                        <img src="{{ asset('assets/frontend/img/shape/white-curved-line.png') }}" alt="img not found!">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="bd-breadcrumb d-flex align-items-center justify-content-center">
                            <div class="bd-breadcrumb-content text-center">
                                <h1 class="bd-breadcrumb-title">About US</h1>
                                <div class="bd-breadcrumb-list">
                                    <span><a href="{{ route('home') }}"><i class="flaticon-hut"></i>DPS HRIT KIDS</a></span>
                                    <span>About US</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bd-wave-wrapper bd-wave-wrapper-3">
            <div class="bd-wave bd-wave-3"></div>
            <div class="bd-wave bd-wave-3"></div>
        </div>
    </section>
    <section class="bd-promotion-area pt-120 pb-60">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="bd-promotion-thumb-wrapper mb-60 wow fadeInLeft" data-wow-duration="1s"
                        data-wow-delay=".3s">
                        <div class="bd-promotion-thumb">
                            <div class="bd-promotion-thumb-mask p-relative">
                                <img src="{{ asset($module_data['about']->sections[0]->featured_image ?? 'assets/frontend/img/promotion/2.png') }}" alt="Image not found">
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
                            <h2 class="bd-section-title mb-10">{{ $module_data['about']->sections[0]->section_title ?? '' }}</h2>
                            <p>{{ $module_data['about']->sections[0]->content ?? '' }}</p>
                        </div>
                        <div class="bd-promotion-list mb-50">
                            <ul>
                                <li>We believe every child is intelligent so we care.</li>
                                <li>Teachers make a difference of your child.</li>
                            </ul>
                        </div>
                        <div class="bd-promotion-btn-wrapper flex-wrap">
                            {{-- <div class="bd-promotion-btn">
                                <a href="#" class="bd-btn">
                                    <span class="bd-btn-inner">
                                        <span class="bd-btn-normal">View More</span>
                                        <span class="bd-btn-hover">View More</span>
                                    </span>
                                </a>
                            </div> --}}
                            <div class="bd-promotion-btn-2 bd-pulse-btn btn-2">
                                <a href="https://www.instagram.com/reel/DIvBzlLvHj6/?utm_source=ig_web_copy_link" class="popup-video"><i
                                        class="flaticon-play-button"></i> Promotional Video</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="bd-counter-area-2 pb-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-10 col-sm-10">
                    <div class="bd-counter-2 mb-30">
                        <div class="bd-counter-2-icon">
                            <i class="flaticon-user-interface"></i>
                        </div>
                        <div class="bd-counter-2-content">
                            <div class="bd-counter-2-number">
                                <span>1</span><span>+</span>
                            </div>
                            <div class="bd-counter-2-text">
                                <span>years of
                                    <br>experience</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-10 col-sm-10">
                    <div class="bd-counter-2 mb-30">
                        <div class="bd-counter-2-icon">
                            <i class="flaticon-reading"></i>
                        </div>
                        <div class="bd-counter-2-content">
                            <div class="bd-counter-2-number">
                                <span>50</span><span>+</span>
                            </div>
                            <div class="bd-counter-2-text">
                                <span>Students
                                    <br>each year</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-10 col-sm-10">
                    <div class="bd-counter-2 mb-30">
                        <div class="bd-counter-2-icon">
                            <i class="flaticon-badge"></i>
                        </div>
                        <div class="bd-counter-2-content">
                            <div class="bd-counter-2-number">
                                <span>10</span><span>+</span>
                            </div>
                            <div class="bd-counter-2-text">
                                <span>Award
                                    <br> Wining</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
