@extends('layouts.Myapp')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row project-wrapper">
                <div class="col-xxl-12">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                                <i class="fas fa-users" class="text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total
                                                Customers
                                            </p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                        data-target="{{ $customer_count }}">0</span></h4>

                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <div class="col-xl-4">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-warning text-warning rounded-2 fs-2">
                                                <i class="las la-user-cog" class="text-warning"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-medium text-muted mb-3">Total Vendors</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                        data-target="{{ $vendor_count }}">0</span></h4>

                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <div class="col-xl-4">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-info text-info rounded-2 fs-2">
                                                <i class=" fas fa-cogs" class="text-info"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total Services
                                            </p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                        data-target="7522">0</span></h4>
                                            </div>

                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    {{-- <div class="row">
                        <div class="col-xl-12">
                            <div class="card">


                                <div class="card-header p-0 border-0 bg-soft-light">
                                    <div class="row g-0 text-center">
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1"><span class="counter-value" data-target="9851">0</span>
                                                </h5>
                                                <p class="text-muted mb-0">Number of Orders</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1"><span class="counter-value" data-target="1026">0</span>
                                                </h5>
                                                <p class="text-muted mb-0">Active Projects</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1">$<span class="counter-value"
                                                        data-target="228.89">0</span>k</h5>
                                                <p class="text-muted mb-0">Revenue</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                <h5 class="mb-1 text-success"><span class="counter-value"
                                                        data-target="10589">0</span>h</h5>
                                                <p class="text-muted mb-0">Working Hours</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                </div><!-- end card header -->
                                <div class="card-body p-0 pb-2">
                                    <div>
                                        <div id="projects-overview-chart"
                                            data-colors='["--vz-primary", "--vz-warning", "--vz-success"]' dir="ltr"
                                            class="apex-charts"></div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!-- end row --> --}}
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-xl-7">
                    <div class="card card-height-100">
                        <div class="card-header d-flex align-items-center">
                            <h4 class="card-title flex-grow-1 mb-0">Recent Orders</h4>

                        </div><!-- end cardheader -->
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-nowrap table-centered align-middle">
                                    <thead class="bg-light text-muted">
                                        <tr>
                                            <th scope="col">Order Id</th>
                                            <th data-sort="customer_name">Company Name</th>
                                            <th data-sort="email"> Date</th>
                                            <th data-sort="phone">Customer Name </th>
                                            <th data-sort="date">Amount ($)</th>
                                            <th data-sort="status">Status</th>
                                            <th data-sort="status">Action</th>
                                        </tr><!-- end tr -->
                                    </thead><!-- thead -->

                                    <tbody>
                                        @foreach ($orderData as $data)
                                            <tr>
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
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1 py-1">My Tasks</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <canvas id="topServicesChart" width="400" height="400"></canvas>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Newly Added Vendor</h4>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <div class="table-responsive table-card">
                                <table class="table table-borderless table-nowrap align-middle mb-0">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th scope="col">Member</th>
                                            <th scope="col">Joining Date</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Licence Number</th>
                                            <th scope="col">Phone </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vendorData as $item)
                                            {{-- {{dd($item)}} --}}
                                            <tr>
                                                <td class="d-flex">
                                                    <img src="{{ asset('storage/uploads/' . ($item->profile_pic ?? 'default.png')) }}"
                                                        alt="" class="avatar-xs rounded-3 me-2">
                                                    <div>
                                                        <h5 class="fs-13 mb-0">{{ $item->name }}</h5>
                                                        <p class="fs-12 mb-0 text-muted">
                                                            {{ $item->vendorservicedata->getServiceData($item->vendorservicedata->service_id)->name }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-muted">{{ $item->created_at->format('M-d-Y') }}</p>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-muted">{{ $item->email }}</h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-muted">{{ $item->licence_number }}</h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-muted">{{ $item->phone }}</h6>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->

            </div><!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>

    <script>
        // Laravel data to JS
        const serviceLabels = @json($serviceOrders->pluck('service_name'));
        const serviceData = @json($serviceOrders->pluck('total_orders'));

        const ctx = document.getElementById('topServicesChart').getContext('2d');
        const topServicesChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: serviceLabels,
                datasets: [{
                    label: 'Order Numbers',
                    data: serviceData,
                    backgroundColor: [
                        '#36A2EB',
                        '#FF6384',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF'
                    ],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.parsed || 0;
                                return `${label}: ${value} orders`;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
