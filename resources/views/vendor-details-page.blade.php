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
                                    <a href="mailto:{{ $userMeta->email }}" class="btn  btn-primary w-100">Contact
                                        Vendor</a>

                                </div>
                                <form method="POST"
                                    action="{{ route('vendor-status-update', ['id' => Crypt::encrypt($userMeta->id)]) }}"
                                    id="statusForm">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="status" id="statusInput" value="">

                                    <div class="mt-3 pt-2">
                                        <a href="javascript:void(0);"
                                            class="btn w-100 {{ $userMeta->status == 1 ? 'btn-soft-danger' : 'btn-soft-success' }}"
                                            onclick="submitStatusForm({{ $userMeta->status == 1 ? 0 : 1 }})">
                                            {{ $userMeta->status == 1 ? 'Suspend Account' : 'Activate Account' }}
                                        </a>
                                    </div>
                                </form>
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
                                    <a class="nav-link" data-bs-toggle="tab" href="#area" role="tab"
                                        aria-selected="false" tabindex="-1">
                                        Areas
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
                                            <div class="scroll-wrapper d-flex flex-nowrap overflow-auto py-3"
                                                style="gap: 1rem;">
                                                @foreach ($userMeta->vendorwithgallery as $imageData)
                                                    <div class="gallery-wrapper"
                                                        style="min-width: 200px; position: relative;">
                                                        <img class="gallery-img"
                                                            src="{{ asset('storage/uploads/' . ($imageData->image ?? 'default.png')) }}"
                                                            alt=""
                                                            style="width: 100%; height: 100%; border-radius: 8px; object-fit: cover;">

                                                        <span class="view-icon"
                                                            style="position: absolute; bottom: 10px; right: 10px;">
                                                            <a href="{{ asset('storage/uploads/' . $imageData->image) }}"
                                                                download title="Download" style="color: white;">
                                                                <i class="fas fa-download"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>
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
                                <div class="tab-pane" id="area" role="tabpanel">
                                    <div class="scroll-wrapper d-flex flex-nowrap overflow-auto py-3" style="gap: 1rem;">

                                        <!-- Location 1 -->
                                        <div style="min-width: 300px;">
                                            <div style="width:200px; height:150px" id="map"></div>
                                        </div>

                                        <!-- Location 2 -->
                                        {{-- <div style="min-width: 300px;">
                                            <iframe src="https://www.google.com/maps/embed?pb=YOUR_SECOND_LOCATION_URL"
                                                width="100%" height="200" style="border:0;" allowfullscreen=""
                                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>

                                        <!-- Location 3 -->
                                        <div style="min-width: 300px;">
                                            <iframe src="https://www.google.com/maps/embed?pb=YOUR_SECOND_LOCATION_URL"
                                                width="100%" height="200" style="border:0;" allowfullscreen=""
                                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div> --}}

                                        <!-- Add more locations the same way -->

                                    </div>
                                </div>
                                <!-- Add more as needed -->

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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOQvjHOXgCiNYrOHZawZbr0Z31Tu-yaIU&callback=initMap" async
        defer></script>
    <script>
        function submitStatusForm(status) {
            document.getElementById('statusInput').value = status;
            document.getElementById('statusForm').submit();
        }
    </script>
  <script>
    function initMap() {
        const dummyLocation = {
            lat: 37.7749,
            lng: -122.4194
        }; // San Francisco

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10,
            center: dummyLocation,
        });

        const marker = new google.maps.Marker({
            position: dummyLocation,
            map: map,
        });

        // Add 10 km radius circle
        const circle = new google.maps.Circle({
            strokeColor: "#FF0000",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#FF0000",
            fillOpacity: 0.2,
            map: map,
            center: dummyLocation,
            radius: 10000, // in meters
        });
    }
</script>

@endsection
