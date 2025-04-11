@extends('layouts.Myapp')

@section('content')
    {{-- {{dd($userMeta)}} --}}
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="justify-content-between d-flex align-items-center mt-3 mb-4">
                        <h5 class="mb-0 pb-1 ">Vendors</h5>
                    </div>
                    <div class="row">
                        @foreach ($userMeta as $value)
                        <div class="col-xxl-6 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img class="rounded-start img-fluid h-100 object-cover"
                                            src="{{ asset('storage/uploads/' . ($value->profile_pic ?? 'default.png')) }}"
                                            alt="Vendor Profile image">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="card-title mb-0">{{ $value->name ?? 'N/A' }}</h5>
                                                </div>
                                                <div>
                                                    <a href="{{ route('vendor-details', ['id' => Crypt::encrypt($value->id)]) }}">
                                                        <button class="btn btn-primary">View Details</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-text text-primary fw-bold f-24 mb-2">
                                                {{ optional(optional($value->vendorservicedata)->vendorserviveUserwithvendor)->name ?? 'Service not available' }}
                                            </h5>
                                            <div class="row">
                                                @if (!empty($value->vendorwithserviceoffer))
                                                    @foreach ($value->vendorwithserviceoffer as $offer)
                                                        <div class="col-md-4 col-sm-6 col-xxl-4">
                                                            <div class="card card-animate bg-info">
                                                                <p class="fw-semibold text-center p-2 m-0 text-white">
                                                                    {{ optional($offer->vendorserviceofferdata)->category_name ?? 'N/A' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-12">
                                                        <p class="text-muted text-center">No offers available</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card -->
                        </div><!-- end col -->
                    @endforeach
                    </div><!-- end row -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div>
    </div>
@endsection
