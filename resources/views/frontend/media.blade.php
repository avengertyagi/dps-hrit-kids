@extends('frontend.layouts.app')
@section('title')
    {{ 'Media' }}
@endsection
@section('content')
    <main>
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
                                    <h1 class="bd-breadcrumb-title">Media</h1>
                                    <div class="bd-breadcrumb-list">
                                        <span><a href="{{ route('home') }}"><i class="flaticon-hut"></i>DPS HRIT KIDS</a></span>
                                        <span>Media</span>
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
        <section class="media-section">
            <div class="container">
                <h2 class="bd-section-title mb-20 mb-md-50 text-center">Media</h2>
                @if (isset($module_data['media']) && count($module_data['media']) > 0)
                    @foreach ($module_data['media'] as $news_item)
                        <div class="row align-items-center custom-row">
                            <div class="col-4 col-md-3 col-lg-2">
                                <div class="date-box">
                                    <div>{{ \Carbon\Carbon::parse($news_item['created_at'])->format('F') }}</div>
                                    <div>{{ \Carbon\Carbon::parse($news_item['created_at'])->format('d') }}</div>
                                    <div>{{ \Carbon\Carbon::parse($news_item['created_at'])->format('Y') }}</div>
                                </div>
                            </div>
                            <div class="col-8 col-md-9 col-lg-10">
                                <h5>{{ $news_item['widget_name'] }}</h5>
                                <p class="text-muted">{{ $news_item['content'] }}</p>
                            </div>
                        </div>
                        @if (!$loop->last)
                            <div class="divider"></div>
                        @endif
                    @endforeach
                @endif
            </div>
        </section>
    </main>
@endsection
