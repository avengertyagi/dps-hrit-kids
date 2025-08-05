@extends('admin.layouts.app')
@section('title')
    {{ 'View Photo' }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row p-2 mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="header-title">View Photo</h4>
                                <a href="javascript:void(0);" class="btn btn-sm btn-primary text-white"
                                    onclick="history.back()">
                                    <i class="ri-arrow-left-line"></i>&nbsp;Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if (count($module_data->photoImages) > 0)
                                    @foreach ($module_data->photoImages as $image)
                                        <div class="col-sm-2">
                                            <img src="{{ asset($image->image ?? 'assets/backend/images/picture.png') }}"
                                                alt="image" class="img-fluid rounded" width="200">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
