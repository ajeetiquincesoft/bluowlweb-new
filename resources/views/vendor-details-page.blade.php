@extends('layouts.Myapp')
@section('content')
<style>
    .gallery-wrapper {
        position: relative;
        display: inline-block;
        width: 150px;
        height: 150px;
        margin: 5px;
    }

    .gallery-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 6px;
    }

    .view-icon {
    position: absolute;
    top: 91%;
    left: 91%;
    transform: translate(-50%, -50%);
    font-size: 17px;
    color: white;
    padding: 8px;
    border-radius: 50%;
    opacity: 0;
    transition: 0.3s ease;
    pointer-events: none;
}

    .gallery-wrapper:hover .view-icon {
        opacity: 1;
        pointer-events: auto;
    }
</style>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-3 col-lg-4 col-sm-12">
                    <div class="card pricing-box ribbon-box right">
                        <div class="card-body bg-light m-2 p-4">
                            <div class="ribbon-two ribbon-two-{{ $userMeta->status == 1 ? 'success' : 'danger' }}">
                                <span>{{ $userMeta->status == 1 ? 'Active' : 'Pending' }} </span>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <img src="{{ asset('storage/uploads/' . ($userMeta->profile_pic ?? 'default.png')) }}"
                                    class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="">
                            </div>
                            <h5 class=" text-center">{{ $userMeta->name }}</h5>

                            <p class="text-center">Licence No :<span class="text-muted ">
                                    {{ $userMeta->licence_number }}</span></p>
                            <p class="text-muted text-center m-0"></p>
                            <div>
                                <div class="mt-3 pt-2">
                                    <a href="javascript:void(0);" class="btn  btn-primary w-100">Contact Vendor</a>

                                </div>
                                <div class="mt-3 pt-2">
                                    <a href="javascript:void(0);" class="btn  btn-soft-success w-100">Suspend account</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xxl-9 col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified mb-3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab"
                                        aria-selected="false" tabindex="-1">
                                        Vendor information
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab"
                                        aria-selected="false" tabindex="-1">
                                        Services
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab"
                                        aria-selected="false" tabindex="-1">
                                        Employees
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link " data-bs-toggle="tab" href="#settings1" role="tab"
                                        aria-selected="true">
                                        Transactions
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content text-muted">
                                <div class="tab-pane active show" id="home1" role="tabpanel">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-2">
                                            {{ $userMeta->about_service }}

                                        </div>
                                        <div class="flex-shrink-0">
                                            <i class="ri-checkbox-multiple-blank-fill text-success"></i>
                                        </div>
                                    </div>
                                    <h4 class=" px-2 py-4">Gallery</h4>
                                    <div class="gallery">
                                        <div>
                                            @foreach ($userMeta->vendorwithgallery as $imageData)
                                                <div class="gallery-wrapper">
                                                    <img class="gallery-img"
                                                        src="{{ asset('storage/uploads/' . ($imageData->image ?? 'default.png')) }}"
                                                        alt="">
                                                    <span class="view-icon">
                                                        <a  href="{{ asset('storage/uploads/' . ($imageData->image))  }}" download  title="Download">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    </span>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile1" role="tabpanel">
                                    <div class="row">
                                        @if (!empty($userMeta->vendorwithserviceoffer))
                                            @foreach ($userMeta->vendorwithserviceoffer as $offer)
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
                                <div class="tab-pane" id="messages1" role="tabpanel">
                                    <div class="row">
                                        @foreach ($userMeta->vendorwithemployee as $emp)
                                            <div class="col-sm-6">
                                                <div class="d-flex mt-3">
                                                    <div class="flex-shrink-0">
                                                        <img src="{{ asset('storage/uploads/' . ($emp->profile_pic ?? 'default.png')) }}"
                                                            alt="" class="avatar-sm rounded">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1 fs-14">{{ $emp->name }}</h6>
                                                        <p class="mb-0">Locksmith</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <!--end col-->

                                        <!--end col-->
                                    </div>
                                </div>
                                <div class="tab-pane " id="settings1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-6 col-xxl-6 col-md-6">
                                            <!-- card -->
                                            <div class="card card-animate">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <p
                                                                class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                                Monthy Fee</p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <h5 class="text-success fs-14 mb-0">
                                                                $21
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-md-6">
                                                            <div class=" bg-light text-center card p-3">
                                                                <div>
                                                                    <h6 class="mb-1 ">Issue date</h6>
                                                                    <small class="mb-0 text-muted">12 Dec, 2021</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class=" bg-light text-center card p-3">
                                                                <div>
                                                                    <h6 class="mb-1 ">Issue date</h6>
                                                                    <small class="mb-0 text-muted">12 Dec, 2021</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="align-items-center text-center">
                                                        <button class="btn btn-danger">Unpaid</button>
                                                    </div>

                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div><!-- end col -->

                                        <div class="col-xl-6 col-xxl-6 col-md-6">
                                            <!-- card -->
                                            <div class="card card-animate">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <p
                                                                class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                                Monthy Fee</p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <h5 class="text-success fs-14 mb-0">
                                                                $21
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-md-6">
                                                            <div class=" bg-light text-center card p-3">
                                                                <div>
                                                                    <h6 class="mb-1 ">Issue date</h6>
                                                                    <small class="mb-0 text-muted">12 Dec, 2021</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class=" bg-light text-center card p-3">
                                                                <div>
                                                                    <h6 class="mb-1 ">Issue date</h6>
                                                                    <small class="mb-0 text-muted">12 Dec, 2021</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="align-items-center text-center">
                                                        <button class="btn btn-success">Paid</button>
                                                    </div>

                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div><!-- end col -->

                                        <div class="col-xl-6 col-xxl-6 col-md-6">
                                            <!-- card -->
                                            <div class="card card-animate">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <p
                                                                class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                                Monthy Fee</p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <h5 class="text-success fs-14 mb-0">
                                                                $21
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-md-6">
                                                            <div class=" bg-light text-center card p-3">
                                                                <div>
                                                                    <h6 class="mb-1 ">Issue date</h6>
                                                                    <small class="mb-0 text-muted">12 Dec, 2021</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class=" bg-light text-center card p-3">
                                                                <div>
                                                                    <h6 class="mb-1 ">Issue date</h6>
                                                                    <small class="mb-0 text-muted">12 Dec, 2021</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="align-items-center text-center">
                                                        <button class="btn btn-success">Paid</button>
                                                    </div>

                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div><!-- end col -->

                                        <div class="col-xl-6 col-xxl-6 col-md-6">
                                            <!-- card -->
                                            <div class="card card-animate">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <p
                                                                class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                                Monthy Fee</p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <h5 class="text-success fs-14 mb-0">
                                                                $21
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-md-6">
                                                            <div class=" bg-light text-center card p-3">
                                                                <div>
                                                                    <h6 class="mb-1 ">Issue date</h6>
                                                                    <small class="mb-0 text-muted">12 Dec, 2021</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class=" bg-light text-center card p-3">
                                                                <div>
                                                                    <h6 class="mb-1 ">Issue date</h6>
                                                                    <small class="mb-0 text-muted">12 Dec, 2021</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="align-items-center text-center">
                                                        <button class="btn btn-success">Paid</button>
                                                    </div>

                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div><!-- end col -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
@endsection
