@extends('layouts.Myapp')

@section('content')
    @include('sweetalert::alert')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Order List</a></li>
                                <li class="breadcrumb-item active">View Order Details</li>
                            </ol>
                        </div>
                    </div>

                    <div class="accordion" id="orderAccordion">

                        <!-- Order Details Accordion -->
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="orderDetailsHeader">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#orderDetails" aria-expanded="true" aria-controls="orderDetails">
                                    Order Details
                                </button>
                            </h2>
                            <div id="orderDetails" class="accordion-collapse collapse show"
                                aria-labelledby="orderDetailsHeader" data-bs-parent="#orderAccordion">
                                <div class="accordion-body">
                                    <table class="table">
                                        <tr>
                                            <th>Order Id:</th>
                                            <th>#{{ $Order->id }}</th>
                                        </tr>
                                        <tr>
                                            <th>Order Amount:</th>
                                            <th>{{ $Order->total_amount }}</th>
                                        </tr>
                                        <tr>
                                            <th style="width: 66%">Order Status:</th>
                                            <td>
                                                @if ($Order->status == 0)
                                                    <span class="">Pending</span>
                                                @elseif ($Order->status == 1)
                                                    <span class="">Delivering</span>
                                                @elseif ($Order->status == 2)
                                                    <span class="">Delivered</span>
                                                @elseif ($Order->status == 3)
                                                    <span class="">Cancelled</span>
                                                @elseif ($Order->status == 4)
                                                    <span class="">Waiting For Payment</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Order Date:</th>
                                            <td>{{ \Carbon\Carbon::parse($Order->created_at)->format('m-d-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Order Items:</th>
                                        </tr>
                                        {{-- {{dd($Order->OrderitemDartaWithOrder)}} --}}
                                        <tr>
                                            <td colspan="2">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Service Categories</th>
                                                            <th>Quantity</th>
                                                            <th>Total Cost (₵)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($Order->OrderitemDartaWithOrder as $detail)
                                                        {{-- {{dd($detail->service_categories_id)}} --}}
                                                            <tr>
                                                                <td>{{ $detail->getServiceCategoryData($detail->service_categories_id)->category_name }}
                                                                    </td>
                                                                <td>{{ $detail->quantity}}</td>
                                                                <td>₵
                                                                    {{ number_format($detail->price * $detail->quantity, 2) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Data Accordion -->
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="customerDataHeader">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#customerData" aria-expanded="false" aria-controls="customerData">
                                    Customer Data
                                </button>
                            </h2>
                            <div id="customerData" class="accordion-collapse collapse" aria-labelledby="customerDataHeader"
                                data-bs-parent="#orderAccordion">
                                <div class="accordion-body">
                                    <table class="table">
                                        <tr>
                                            <th>Customer Name:</th>
                                            <td>{{ $Order->getCustomerData($Order->customer_id)->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Customer Address:</th>
                                            <td>{{ $Order->user_address }}</td>
                                        </tr>
                                        <tr>
                                            <th>Customer Email:</th>
                                            <td>{{ $Order->getCustomerData($Order->customer_id)->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Customer Phone:</th>
                                            <td>{{ $Order->getCustomerData($Order->customer_id)->phone }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Branch Data Accordion -->
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="branchDataHeader">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#branchData" aria-expanded="false" aria-controls="branchData">
                                    Vendor Data
                                </button>
                            </h2>
                            <div id="branchData" class="accordion-collapse collapse" aria-labelledby="branchDataHeader"
                                data-bs-parent="#orderAccordion">
                                <div class="accordion-body">
                                    <table class="table">
                                        <tr>
                                            <th>Vendor Name:</th>
                                            <td>{{ $Order->getVendorData($Order->vendor_id)->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vendor Email:</th>
                                            <td>{{ $Order->getVendorData($Order->vendor_id)->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vendor Phone:</th>
                                            <td>{{ $Order->getVendorData($Order->vendor_id)->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vendor Area:</th>
                                            <td>{{ $Order->getVendorAreaData($Order->area_id)->address }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
