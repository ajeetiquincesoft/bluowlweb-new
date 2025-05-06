@extends('layouts.Myapp')
@section('content')
@include('sweetalert::alert')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Vendors</h4>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <div>
                                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                    id="create-btn" data-bs-target="#showModal"><i
                                        class="ri-add-line align-bottom me-1"></i> Add Vendor</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($userMeta as $value)
                            <div class="col-xxl-6 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img class="rounded-start img-fluid h-100 object-cover"
                                                src="{{ $value->profile_pic ? asset('storage/uploads/' . $value->profile_pic) : asset('storage/uploads/17436829592146840487PI.png') }}"
                                                alt="Vendor Profile image">

                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h5 class="card-title mb-0">{{ $value->name ?? 'N/A' }}</h5>
                                                    </div>
                                                    <div>
                                                        <a
                                                            href="{{ route('vendor-details', ['id' => Crypt::encrypt($value->id)]) }}">
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
                    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        id="close-modal"></button>
                                </div>
                                <form class="tablelist-form" method="POST" action="{{ route('addVendor') }}" autocomplete="off">
                                    @csrf
                                    <div class="modal-body">
                                        <!-- Company Name -->
                                        <div class="mb-3">
                                            <label for="company-field" class="form-label">Company Name</label>
                                            <input type="text" name="company_name" id="company-field" class="form-control" placeholder="Enter Company Name" required />
                                        </div>

                                        <!-- License No -->
                                        <div class="mb-3">
                                            <label for="license-field" class="form-label">License No</label>
                                            <input type="text" name="license_no" id="license-field" class="form-control" placeholder="Enter License No" />
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="email-field" class="form-label">Email</label>
                                            <input type="email" name="email" id="email-field" class="form-control" placeholder="Enter Email" required />
                                        </div>

                                        <!-- Website -->
                                        <div class="mb-3">
                                            <label for="website-field" class="form-label">Website</label>
                                            <input type="url" name="website" id="website-field" class="form-control" placeholder="Enter Website" />
                                        </div>

                                        <!-- Phone -->
                                        <div class="mb-3">
                                            <label for="phone-field" class="form-label">Phone</label>
                                            <input type="text" name="phone" id="phone-field" class="form-control" placeholder="Enter Phone no." required />
                                        </div>

                                        <!-- Yelp Profile -->
                                        <div class="mb-3">
                                            <label for="yelp_profile" class="form-label">Yelp Profile</label>
                                            <input type="url" name="yelp_profile" id="yelp-profile" class="form-control" placeholder="Enter Yelp Profile URL" />
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" id="add-btn">Add Customer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div>
    </div>
@endsection
