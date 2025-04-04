@extends('layouts.Myapp')
@section('content')
    @include('sweetalert::alert')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="teamlist">
                                <div class="team-list grid-view-filter row" id="team-member-list">
                                    @foreach ($customers as $customerdata)
                                        <div class="col">
                                            <div class="card team-box">
                                                {{-- {{dd($customerdata->name)}} --}}
                                                <div class="team-cover"> <img
                                                        src="{{ $customerdata->profile_pic ? asset('storage/uploads/' . $customerdata->profile_pic) : asset('storage/uploads/17436829592146840487PI.png') }}"
                                                        alt="" class="img-fluid"> </div>
                                                <div class="card-body p-4">
                                                    <div class="row align-items-center team-row">
                                                        <div class="col-lg-4 mt-3 col">
                                                            <div class="team-profile-img">
                                                                <div
                                                                    class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                    <img src="{{ $customerdata->profile_pic ? asset('storage/uploads/' . $customerdata->profile_pic) : asset('storage/uploads/17436829592146840487PI.png') }}"
                                                                        alt=""
                                                                        class="member-img img-fluid d-block rounded-circle">
                                                                </div>
                                                                <div class="team-content"> <a class="member-name"
                                                                        data-bs-toggle="offcanvas"
                                                                        href="#member-overview-{{ $customerdata->id }}"
                                                                        aria-controls="member-overview">
                                                                        <h5 class="fs-16 mb-1">{{ $customerdata->name }}
                                                                        </h5>
                                                                    </a>

                                                                    <p
                                                                        class="member-designation mb-0
                                                                        {{ $customerdata->status == 1 ? 'text-success' : 'text-danger' }}">
                                                                        {{ $customerdata->status == 1 ? 'Active' : 'Pending' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col">
                                                            <div class="row text-muted text-center">
                                                                <div class="col-6 border-end border-end-dashed">
                                                                    <h5 class="mb-1 projects-num">225</h5>
                                                                    <p class="text-muted mb-0">Enquiries</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <h5 class="mb-1 tasks-num">$ 197</h5>
                                                                    <p class="text-muted mb-0">Totel Payout</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col">
                                                            <div class="text-end"> <a data-bs-toggle="offcanvas"
                                                                    href="#member-overview-{{ $customerdata->id }}"
                                                                    aria-controls="member-overview"
                                                                    class="btn btn-light view-btn">View Profile</a> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @foreach ($customers as $customerdata)
                                <div class="offcanvas offcanvas-end border-0" tabindex="-1"
                                    id="member-overview-{{ $customerdata->id }}">
                                    <!--end offcanvas-header-->
                                    <div class="offcanvas-body profile-offcanvas p-0">
                                        <div class="team-cover">
                                            <img src="{{ $customerdata->profile_pic ? asset('storage/uploads/' . $customerdata->profile_pic) : asset('storage/uploads/17436829592146840487PI.png') }}"
                                                alt="" class="img-fluid">
                                        </div>
                                        <div class="p-3">
                                            <div class="team-settings">
                                                <div class="row">

                                                    <div class="col text-end dropdown">
                                                        <a href="javascript:void(0);" id="dropdownMenuLink14"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill fs-17"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end"
                                                            aria-labelledby="dropdownMenuLink14">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                        class="ri-check-line me-2 align-middle"></i>Active</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"> <i class="fa-solid fa-exclamation me-2 align-middle"></i>Pending</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <div class="p-3 text-center">
                                            <img src="{{ $customerdata->profile_pic ? asset('storage/uploads/' . $customerdata->profile_pic) : asset('storage/uploads/17436829592146840487PI.png') }}"
                                                alt=""
                                                class="avatar-lg img-thumbnail rounded-circle mx-auto profile-img">
                                            <div class="mt-3">
                                                <h5 class="fs-15 profile-name">{{ $customerdata->name }}</h5>
                                                <p class="text-muted profile-designation">Customer</p>
                                            </div>

                                        </div>
                                        <div class="row g-0 text-center">
                                            <div class="col-6">
                                                <div class="p-3 border border-dashed border-start-0">
                                                    <h5 class="mb-1 profile-project">124</h5>
                                                    <p class="text-muted mb-0">Enquiries</p>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-6">
                                                <div class="p-3 border border-dashed border-start-0">
                                                    <h5 class="mb-1 profile-task">81</h5>
                                                    <p class="text-muted mb-0">Totel Payout</p>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                        <div class="p-3">
                                            <h5 class="fs-15 mb-3">Personal Details</h5>
                                            <div class="mb-3">
                                                <p class="text-muted text-uppercase fw-semibold fs-12 mb-2">Number</p>
                                                <h6>{{ $customerdata->phone }}</h6>
                                            </div>
                                            <div class="mb-3">
                                                <p class="text-muted text-uppercase fw-semibold fs-12 mb-2">Email</p>
                                                <h6>{{ $customerdata->email }}</h6>
                                            </div>
                                            <div>
                                                <p class="text-muted text-uppercase fw-semibold fs-12 mb-2">Location</p>
                                                <h6 class="mb-0">Carson City - USA</h6>
                                            </div>
                                        </div>

                                    </div>
                                    <!--end offcanvas-body-->
                                </div>
                            @endforeach
                            <!--end offcanvas-->
                        </div><!-- end col -->
                    </div>
                    <!--end row-->
                </div>
            </div>
            <!--end row-->
        </div><!-- container-fluid -->
    </div>
@endsection
