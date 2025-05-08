@extends('layouts.Myapp')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.stripe.com/v3/"></script>
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
                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link " data-bs-toggle="tab" href="#settings1" role="tab"
                                        aria-selected="true">
                                        Transactions
                                    </a>
                                </li> --}}
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

                                    <div class="tab-pane" id="area" role="tabpanel">
                                        <div id="vendorMap" style="width: 100%; height: 300px;"></div>
                                    </div>

                                </div>
                                <!-- Add more as needed -->

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5>Vendor Orders</h5>
                            <div class="listjs-table" id="customerList">
                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 50px;">

                                                </th>
                                                <th data-sort="order_id">Order Id </th>
                                                <th data-sort="customer_name">Company Name</th>
                                                <th data-sort="email"> Date</th>
                                                <th data-sort="phone">Customer Name </th>
                                                <th data-sort="date">Amount ($)</th>
                                                <th data-sort="status">Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach ($orderData as $data)
                                                <tr>
                                                    <th scope="row">

                                                    </th>
                                                    <th class="order_id">#{{ $data->id }}</th>
                                                    <td class="customer_name">
                                                        {{ $data->getVendorData($data->vendor_id)->name }}</td>
                                                    <td class="date">{{ $data->created_at->format('M-d-y') }}</td>
                                                    <td class="customer_name">
                                                        {{ $data->getCustomerData($data->customer_id)->name }}</td>
                                                    <td class="date">${{ $data->total_amount }}</td>
                                                    <td class="status">
                                                        @if ($data->status == 0)
                                                            <span class="badge badge-soft-warning">Pending</span>
                                                        @elseif ($data->status == 1)
                                                            <span class="badge badge-soft-success">Complete</span>
                                                        @elseif ($data->status == 2)
                                                            <span class="badge badge-soft-success">Due To Payment</span>
                                                            <p></p>
                                                        @elseif ($data->status == 3)
                                                            <span class="badge badge-soft-danger">Cancelled</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a
                                                                href="{{ route('ShowOrderdatadetails', ['id' => Crypt::encrypt($data->id)]) }}"><button
                                                                    title="view"
                                                                    class="btn btn-sm btn-success edit-item-btn">View</button></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#121331,secondary:#08a88a"
                                                style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We've searched more than 150+ Orders We did
                                                not find any orders for you search.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    {{ $orderData->links('vendor.pagination.custom') }}
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div>
                </div><!-- end card-body -->
            </div>
        </div>
    </div>
    </div>
    <!-- container-fluid -->
    </div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap">
    </script>

    <script>
        function submitStatusForm(status) {
            document.getElementById('statusInput').value = status;
            document.getElementById('statusForm').submit();
        }
    </script>
  <script>
    function getRandomColor() {
        // Generate a random hex color
        return '#' + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0');
    }

    const vendorAreas = @json($vendor_areas);

    function initMap() {
        const map = new google.maps.Map(document.getElementById("vendorMap"), {
            zoom: 10,
            center: { lat: 0, lng: 0 },
        });

        const bounds = new google.maps.LatLngBounds();

        vendorAreas.forEach(area => {
            const location = {
                lat: parseFloat(area.latitude),
                lng: parseFloat(area.longitude)
            };

            const randomColor = getRandomColor(); // ✅ Assign random color here

            // Add marker
            new google.maps.Marker({
                position: location,
                map: map
            });

            // Add circle with random color
            new google.maps.Circle({
                strokeColor: randomColor,
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: randomColor,
                fillOpacity: 0.2,
                map: map,
                center: location,
                radius: 10000 // 10 km
            });

            bounds.extend(location);
        });

        if (!bounds.isEmpty()) {
            map.fitBounds(bounds);
        }
    }
</script>

@endsection
