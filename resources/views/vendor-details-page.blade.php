@extends('layouts.Myapp')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-3 col-lg-4 col-sm-12">
                    <div class="card pricing-box ribbon-box right">
                        <div class="card-body bg-light m-2 p-4">
                            <div class="ribbon-two ribbon-two-danger"><span>Pending </span></div>
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnSA1zygA3rubv-VK0DrVcQ02Po79kJhXo_A&s"
                                    class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="">
                            </div>
                            <h5 class=" text-center">Fast Service Nevada</h5>

                            <p class="text-center">Licence No :<span class="text-muted ">335515667</span></p>
                            <p class="text-muted text-center m-0">Plumbing</p>
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
                                            Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before
                                            they sold out master cleanse gluten-free squid scenester freegan cosby sweater.
                                            Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo
                                            park Austin. Cred vinyl keffiyeh DIY salvia PBR.

                                        </div>
                                        <div class="flex-shrink-0">
                                            <i class="ri-checkbox-multiple-blank-fill text-success"></i>
                                        </div>
                                    </div>
                                    {{-- <div>
                                        <div class=" card border-primary mt-2 col-md-4">
                                            <div class="py-3 px-2">
                                                <h5 class="text-muted  fs-13">Licence No
                                                </h5>
                                                <div class="align-items-center">
                                                    <h3 class="mb-0"><span>335515667</span></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <h4 class=" px-2 py-4">Gallery</h4>
                                    <div class="gallery">
                                        <div>
                                            <img class="gallery-img img-fluid mx-1 my-1"
                                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnSA1zygA3rubv-VK0DrVcQ02Po79kJhXo_A&s"
                                                alt="" width="17%">
                                            <img class="gallery-img img-fluid mx-1 my-1"
                                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnSA1zygA3rubv-VK0DrVcQ02Po79kJhXo_A&s"
                                                alt="" width="17%">
                                            <img class="gallery-img img-fluid mx-1 my-1"
                                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnSA1zygA3rubv-VK0DrVcQ02Po79kJhXo_A&s"
                                                alt="" width="17%">
                                        </div>


                                    </div>
                                </div>
                                <div class="tab-pane" id="profile1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6  col-xxl-4">
                                            <div class="card bg-info">
                                                <p class=" fw-semibold text-center p-2 m-0 text-white">Water
                                                    Leak Detection</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xxl-4">
                                            <div class="card  bg-info">
                                                <p class=" fw-semibold text-center p-2 m-0 text-white">
                                                    Water Heater Installation </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4  col-sm-6 col-xxl-4">
                                            <div class="card  bg-info">
                                                <p class=" fw-semibold text-center p-2 m-0 text-white">
                                                    Kitchens and Bathrooms</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xxl-4">
                                            <div class="card  bg-info">
                                                <p class=" fw-semibold text-center p-2 m-0 text-white">
                                                    Kitchens and Bathrooms</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="messages1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-7.jpg" alt=""
                                                        class="avatar-sm rounded">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 fs-14">Dominic Charlton</h6>
                                                    <p class="mb-0">Locksmith</p>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-8.jpg" alt=""
                                                        class="avatar-sm rounded">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 fs-14">Matilda Walker</h6>
                                                    <p class="mb-0">Locksmith</p>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-4.jpg" alt=""
                                                        class="avatar-sm rounded">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 fs-14">Jennifer Barker</h6>
                                                    <p class="mb-0">Locksmith</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-sm-6">
                                            <div class="d-flex mt-3 mt-sm-0">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-5.jpg" alt=""
                                                        class="avatar-sm rounded">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 fs-14">Amelie Townsend</h6>
                                                    <p class="mb-0">Locksmith</p>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-1.jpg" alt=""
                                                        class="avatar-sm rounded">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 fs-14">Emily Slater</h6>
                                                    <p class="mb-0">Locksmith</p>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-2.jpg" alt=""
                                                        class="avatar-sm rounded">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 fs-14">Declan Long</h6>
                                                    <p class="mb-0">Locksmith</p>
                                                </div>
                                            </div>
                                        </div>
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
