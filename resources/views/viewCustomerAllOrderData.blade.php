@extends('layouts.Myapp')

@section('content')
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Orders List</li>
                            </ol>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Customer Order View</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
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
                                                colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                            </lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find
                                                any orders for you search.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    {{ $orderData->links('vendor.pagination.custom') }}
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>


        </div>
    </div>
@endsection
