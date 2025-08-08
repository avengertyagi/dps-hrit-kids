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
        @foreach ($module_data['videos'] as $index => $video)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="video-card-modern">
                    <video
                        id="video_{{ $index }}"
                        class="video-js vjs-default-skin vjs-fluid"
                        controls
                        preload="auto"
                        poster="{{ asset($video->thumbnail_image ?? 'assets/frontend/img/gallery/d2.png') }}"
                        data-setup='{}'>
                        <source src="{{ asset($video->video ?? '') }}" type="video/mp4" />
                        Your browser does not support the video tag.
                    </video>
                    <h6 class="video-title text-center mt-2">{{ $video->title ?? '' }}</h6>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center">No videos found.</p>
    @endif
</div>

        </div>
    </div>
@endsection
@push('js')
<!-- Video.js CDN -->
<link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
<script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
<style>
.video-card-modern {
    position: relative;
    width: 100%;
}
.video-card-modern video {
    width: 100%;
    height: auto;
    border-radius: 8px;
}
</style>
@endpush