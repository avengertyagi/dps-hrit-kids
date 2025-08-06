@extends('frontend.layouts.app')
@section('title')
    {{ 'All Photos' }}
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
                                <h1 class="bd-breadcrumb-title">Gallery</h1>
                                <div class="bd-breadcrumb-list">
                                    <span><a href="{{ route('home') }}"><i class="flaticon-hut"></i>DPS HRIT KIDS</a></span>
                                    <span>All Photos</span>
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
    <div class="bd-gallery-area p-relative pt-120 pb-95 p-relative">
        <div class="container">
            <div class="row">
                @if (count($module_data['photos']->photoImages) > 0)
                    @foreach ($module_data['photos']->photoImages as $photo)
                        <div class="col-lg-3">
                            <div class="bd-gallery mb-25 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                                <div class="bd-gallery-thumb-wrapper">
                                    <div class="bd-gallery-thumb">
                                        <img src="{{ asset($photo->image ?? 'assets/frontend/img/gallery/d2.png') }}"
                                            alt="img not found!">
                                    </div>
                                    <div class="bd-gallery-icon">
                                        <i class="flaticon-eye"></i>
                                    </div>
                                    <div class="img-title">
                                        <h5 class="text-white">{{ $photo->title ?? '' }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
