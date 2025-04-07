@extends('layouts.Myapp')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="justify-content-between d-flex align-items-center mt-3 mb-4">
                        <h5 class="mb-0 pb-1 ">Vendors</h5>
                    </div>
                    <div class="row">
                        <div class="col-xxl-6 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img class="rounded-start img-fluid h-100 object-cover"
                                            src="assets/images/small/img-12.jpg" alt="Card image">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="card-title mb-0">Fast Service Nevada</h5>
                                                </div>
                                                <div>
                                                   <a href="{{route('vendor-details')}}"><button class="btn btn-primary">View Details</button></a>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-text text-primary fw-bold f-24 mb-2">Plumbing</h5>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-6  col-xxl-4">
                                                    <div class="card card-animate bg-info">
                                                        <p class=" fw-semibold text-center p-2 m-0 text-white">Water
                                                            Leak Detection</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-xxl-4">
                                                    <div class="card card-animate bg-info">
                                                        <p class=" fw-semibold text-center p-2 m-0 text-white">
                                                            Water Heater Installation </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4  col-sm-6 col-xxl-4">
                                                    <div class="card card-animate bg-info">
                                                        <p class=" fw-semibold text-center p-2 m-0 text-white">
                                                            Kitchens and Bathrooms</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-xxl-4">
                                                    <div class="card card-animate bg-info">
                                                        <p class=" fw-semibold text-center p-2 m-0 text-white">
                                                            Kitchens and Bathrooms</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card -->
                        </div><!-- end col -->
                        <div class="col-xxl-6 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="row g-0">
                                    <div class="col-md-8">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="card-title mb-0">Fast Service Nevada</h5>
                                                </div>
                                                <div>
                                                    <button class="btn btn-primary">View Details</button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-text text-primary fw-bold f-24 mb-2">Plumbing</h5>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-6  col-xxl-4">
                                                    <div class="card card-animate bg-info">
                                                        <p class=" fw-semibold text-center p-2 m-0 text-white">Water
                                                            Leak Detection</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-xxl-4">
                                                    <div class="card card-animate bg-info">
                                                        <p class=" fw-semibold text-center p-2 m-0 text-white">
                                                            Water Heater Installation </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4  col-sm-6 col-xxl-4">
                                                    <div class="card card-animate bg-info">
                                                        <p class=" fw-semibold text-center p-2 m-0 text-white">
                                                            Kitchens and Bathrooms</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-xxl-4">
                                                    <div class="card card-animate bg-info">
                                                        <p class=" fw-semibold text-center p-2 m-0 text-white">
                                                            Kitchens and Bathrooms</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <img class="rounded-end img-fluid h-100 object-cover"
                                            src="assets/images/small/img-4.jpg" alt="Card image">
                                    </div>
                                </div>
                            </div><!-- end card -->
                        </div><!-- end col -->
                        {{-- @if (count($services) > 0)
                            @foreach ($services as $service)
                                <div class="col-xxl-6 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="row g-0">
                                            <div class="col-md-8">
                                                <div class="card-header">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h5 class="card-title mb-0">{{ $service->title }}</h5>
                                                        </div>
                                                        <div>
                                                            <a href="{{ $service->link ?? '#' }}"
                                                                class="btn btn-primary">View Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-text text-primary fw-bold f-24 mb-2">
                                                        {{ $service->category }}</h5>
                                                    <div class="row">
                                                        @foreach ($service->features as $feature)
                                                            <div class="col-md-4 col-sm-6 col-xxl-4">
                                                                <div class="card card-animate bg-info">
                                                                    <p class="fw-semibold text-center p-2 m-0 text-white">
                                                                        {{ $feature }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <img class="rounded-end img-fluid h-100 object-cover"
                                                    src="{{ asset('assets/images/' . ($service->image ?? 'default.jpg')) }}"
                                                    alt="Card image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-xxl-6 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="row g-0">
                                        <div class="col-md-8">
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="placeholder-glow">
                                                        <span class="placeholder col-6"></span>
                                                    </div>
                                                    <div>
                                                        <span class="btn btn-primary disabled placeholder col-4"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="placeholder-glow">
                                                    <span class="placeholder col-4"></span>
                                                </h5>
                                                <div class="row">
                                                    @for ($i = 0; $i < 3; $i++)
                                                        <div class="col-md-4 col-sm-6 col-xxl-4 mb-2">
                                                            <div class="card card-animate bg-secondary placeholder-glow">
                                                                <p
                                                                    class="fw-semibold text-center p-2 m-0 placeholder col-10">
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="bg-light placeholder-glow h-100">
                                                <span class="placeholder col-12 h-100 d-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif --}}

                    </div><!-- end row -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div>
    </div>
@endsection
