@extends('frontend.layouts.app')
@section('title')
    {{ 'Videos' }}
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
                                    <span>Videos</span>
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
    <div class="bd-gallery-area p-relative pt-120 pb-95">
        <div class="container">
            <div class="row">
                @if (isset($module_data['videos']) && count($module_data['videos']) > 0)
                    @foreach ($module_data['videos'] as $video)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="video-card-modern">
                                <a href="{{ asset($video->video ?? '') }}" class="popup-video">
                                    <div class="video-thumb">
                                        <img src="{{ asset($video->thumbnail_image ?? 'assets/frontend/img/gallery/d2.png') }}" alt="Video" class="img-fluid">
                                        <div class="play-btn">
                                            <i class="flaticon-play-button"></i>
                                        </div>
                                    </div>
                                </a>
                                <h6 class="video-title text-center mt-2">{{ $video->title ?? '' }}</h6>
                            </div>
                        </div>
                    @endforeach
                     @else
                    <p class="text-center">No photos found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- Include jQuery + Magnific Popup JS/CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.popup-video').magnificPopup({
                type: 'iframe'
            });
        });
    </script>
@endpush
   <style>
       .video-card-modern .video-thumb {
           position: relative;
           overflow: hidden;
           border-radius: 20px;
           transition: transform 0.3s;
       }

       .video-card-modern .video-thumb img {
           width: 100%;
           transition: transform 0.4s ease;
       }

       .video-card-modern .video-thumb:hover img {
           transform: scale(1.05);
       }

       .video-card-modern .play-btn {
           position: absolute;
           top: 50%;
           left: 50%;
           transform: translate(-50%, -50%);
           background-color: rgba(3, 174, 70, 0.8);
           color: #fff;
           font-size: 32px;
           padding: 15px;
           border-radius: 50%;
           transition: opacity 0.3s;
           opacity: 0;
       }

       .video-card-modern .video-thumb:hover .play-btn {
           opacity: 1;
       }
   </style>
