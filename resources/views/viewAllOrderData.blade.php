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
                            <h4 class="card-title mb-0">Order View</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-5 mb-3">
                                    <div class="col-sm">
                                        {{-- <form action="{{ route('manage-Orders') }}" method="get">
                                            <div class="row justify-content-end">
                                                <input type="hidden" name="sort"
                                                    value="{{ @$_GET['sort'] ? $_GET['sort'] : '' }}">
                                                <input type="hidden" name="direction"
                                                    value="{{ @$_GET['direction'] ? $_GET['direction'] : '' }}">
                                                    <input type="hidden" name="addressId"
                                                    value="{{ @$_GET['addressId'] ? $_GET['addressId'] : '' }}">

                                                <?php
                                                $status = [
                                                    '0' => 'Pending',
                                                    '1' => 'Delivering',
                                                    '2' => 'Delivered',
                                                    '3' => 'Cancelled',
                                                ];
                                                ?>
                                                <div class="col-xxl-3 col-md-3" title="Order Id" >
                                                    <input type="search" class="form-control" name="order_id"
                                                        value="{{ isset($_GET['order_id']) ? $_GET['order_id'] : '' }}"
                                                        placeholder="Search Order Id">
                                                </div>

                                                <div class="col-xxl-3 col-md-3" title="Select status"
                                                    >
                                                    <select class="form-control" id="choices-multiple-remove-button"
                                                        data-choices data-choices-removeItem name="status[]" multiple
                                                        data-placeholder="Select Status">
                                                        @foreach ($status as $index => $stu)
                                                            <option value="{{ $index }}"
                                                                {{ @is_array($_GET['status']) && in_array($index, $_GET['status']) ? 'selected' : '' }}>
                                                                {{ $stu }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-xxl-2 col-md-2" title="Select Refill Type" >
                                                    <select class="form-control" name="refill_type"
                                                        data-placeholder="Select Refill Type">
                                                        <option value="" selected>Refill Type</option>
                                                        <option value="Refill"
                                                            {{ isset($_GET['refill_type']) && $_GET['refill_type'] == 'Refill' ? 'selected' : '' }}>
                                                            Refill
                                                        </option>
                                                        <option value="Exchange"
                                                            {{ isset($_GET['refill_type']) && $_GET['refill_type'] == 'Exchange' ? 'selected' : '' }}>
                                                            Exchange
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-xxl-2 col-md-2" title="Select Cashier"
                                                   >
                                                    <select class="form-control" name="cashier_id"
                                                        data-placeholder="Select Gas Refill Type">
                                                        <option value="" selected>Select Cashier</option>
                                                        @foreach ($cashierdata as $cashier)
                                                            <option value="{{ $cashier->id }}"
                                                                {{ isset($_GET['cashier_id']) && $_GET['cashier_id'] == $cashier->id ? 'selected' : '' }}>
                                                                {{ $cashier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-xxl-2 col-md-2" title="Select OMC"
                                                   >
                                                    <select class="form-control" name="omc_id"
                                                        data-placeholder="Select Gas Refill Type">
                                                        <option value="" selected>Select OMC</option>
                                                        @foreach ($OMCdata as $omc)
                                                            <option value="{{ $omc->id }}"
                                                                {{ isset($_GET['omc_id']) && $_GET['omc_id'] == $omc->id ? 'selected' : '' }}>
                                                                {{ $omc->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Start Date Field -->
                                                <div class="col-xxl-2 col-md-2 mt-2" title="Start Date">
                                                    <input type="text" class="form-control date-input" name="start_date"
                                                        value="{{ isset($_GET['start_date']) ? $_GET['start_date'] : '' }}"
                                                        placeholder="Start Date" onfocus="(this.type='date')" onblur="if(this.value===''){this.type='text'}">
                                                </div>

                                                <div class="col-xxl-2 col-md-2 mt-2" title="End Date">
                                                    <input type="text" class="form-control date-input" name="end_date"
                                                        value="{{ isset($_GET['end_date']) ? $_GET['end_date'] : '' }}"
                                                        placeholder="End Date" onfocus="(this.type='date')" onblur="if(this.value===''){this.type='text'}">
                                                </div>
                                                <div class="col-xxl-2 col-md-2 mt-2" title="End Date" >
                                                    <button  type="submit"
                                                        class=" w-100 btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                        </form> --}}

                                    </div>
                                </div>

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
