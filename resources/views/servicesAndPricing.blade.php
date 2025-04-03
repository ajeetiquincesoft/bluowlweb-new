@extends('layouts.Myapp')
@section('content')
    @include('sweetalert::alert')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Add & Edit</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                                id="create-btn" data-bs-target="#showModal" title="Add"><i
                                                    class="ri-add-line align-bottom me-1"></i> Add</button>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <form action="{{ route('servicesAndPricing') }}" method="get">
                                            <div class="row justify-content-end">
                                                <input type="hidden" name="sort"
                                                    value="{{ @$_GET['sort'] ? $_GET['sort'] : '' }}">
                                                <input type="hidden" name="direction"
                                                    value="{{ @$_GET['direction'] ? $_GET['direction'] : '' }}">


                                                <div class="col-xxl-3 col-md-3" title="Select Service">
                                                    <select id="service_search_cetegory" name="service_id" class="form-control"
                                                        required>
                                                        <option value="" disabled selected>Select Service
                                                        </option>
                                                        @foreach ($services as $value)
                                                            <option value="{{ $value->id }}"
                                                                {{ isset($_GET['service_id']) && $_GET['service_id'] == $value->id ? 'selected' : '' }}>
                                                                {{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-xxl-3 col-md-3">
                                                    <select id="category_search_id" name="category_id" class="form-control" >
                                                        <option value="" disabled selected>Select Category</option>
                                                    </select>
                                                </div>


                                                <div class="col-xxl-2 col-md-2" title="End Date">
                                                    <button type="submit" class=" w-100 btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 50px;">

                                                </th>
                                                <th data-sort="customer_name">Title</th>
                                                <th data-sort="customer_name">Value</th>
                                                <th data-sort="customer_name">Service Name</th>
                                                <th data-sort="customer_name">Service Category</th>
                                                <th data-sort="status">Status</th>
                                                <th data-sort="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @if (count($servicepricingdata) > 0)
                                                @foreach ($servicepricingdata as $item)
                                                    <tr>
                                                        <th scope="row">
                                                        </th>
                                                        <td class="id" style="display:none;"><a
                                                                href="javascript:void(0);"
                                                                class="fw-medium link-primary">#VZ2101</a></td>
                                                        <td class="email">{{ $item->Title }}</td>
                                                        <td class="email">$ {{ $item->value }}</td>
                                                        <td class="email">{{ $item->servicewithpricing->name }}</td>
                                                        <td class="email">{{ $item->categorywithpricing->category_name }}
                                                        </td>

                                                        <td class="status"><span
                                                                class="badge {{ $item->status == 0 ? 'badge-soft-danger' : 'badge-soft-success' }} text-uppercase">{{ $item->status == 0 ? 'Inactive' : 'Active' }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-success add-btn"
                                                                        data-bs-toggle="modal" id="create-btn"
                                                                        data-bs-target="#EditModel{{ $item->id }}"
                                                                        title="Edit"> Edit</button>

                                                                    <div class="modal fade"
                                                                        id="EditModel{{ $item->id }}" tabindex="-1"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header bg-light p-3">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLabel"></h5>
                                                                                    <button type="button" class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"
                                                                                        id="close-modal"></button>
                                                                                </div>
                                                                                @if (count($errors) > 0)
                                                                                    <div class="alert alert-danger">
                                                                                        <ul>
                                                                                            @foreach ($errors->all() as $error)
                                                                                                <li>{{ $error }}
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                @endif
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <form class="tablelist-form"
                                                                                            id="adduserform"
                                                                                            action="{{ route('edit-service-pricing', ['id' => Crypt::encrypt($item->id)]) }}"
                                                                                            method="POST"
                                                                                            autocomplete="off">
                                                                                            @csrf
                                                                                            <div class="modal-body">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="service_edit_cetegory"
                                                                                                        class="form-label">Select
                                                                                                        Service</label>
                                                                                                    <select
                                                                                                        id="service_edit_cetegory"
                                                                                                        name="service_id"
                                                                                                        class="form-control"
                                                                                                        required>
                                                                                                        <option
                                                                                                            value="{{ $item->servicewithpricing->id }}"
                                                                                                            selected>
                                                                                                            {{ $item->servicewithpricing->name }}
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </div>

                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="category_edit_id"
                                                                                                        class="form-label">Select
                                                                                                        Category</label>
                                                                                                    <select
                                                                                                        id="category_edit_id"
                                                                                                        name="category_id"
                                                                                                        class="form-control"
                                                                                                        required>
                                                                                                        <option
                                                                                                            value=" {{ $item->categorywithpricing->id }}"
                                                                                                            selected>
                                                                                                            {{ $item->categorywithpricing->category_name }}
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </div>

                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="fixed_charge"
                                                                                                        class="form-label">Title</label>
                                                                                                    <div class="form-icon">
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            name="title"
                                                                                                            value="{{ $item->Title }}"
                                                                                                            placeholder="Enter Service Name">
                                                                                                    </div>
                                                                                                </div>

                                                                                                <!-- Value -->
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="fixed_charge"
                                                                                                        class="form-label">Value</label>
                                                                                                    <div class="form-icon">
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            value="{{ $item->value }}"
                                                                                                            class="form-control form-control-icon"
                                                                                                            id="iconInput"
                                                                                                            name="value"
                                                                                                            placeholder="Enter Service Value"
                                                                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                                                                                                        <i
                                                                                                            class="fa-solid fa-dollar-sign"></i>
                                                                                                    </div>
                                                                                                </div>


                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <div
                                                                                                    class="hstack gap-2 justify-content-end">
                                                                                                    <button type="button"
                                                                                                        class="btn btn-light"
                                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                                    <button type="submit"
                                                                                                        value="submit"
                                                                                                        class="btn btn-success"
                                                                                                        id="add-btn">Save
                                                                                                    </button>
                                                                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="8" class="text-center text-muted">No Service Found.
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#121331,secondary:#08a88a"
                                                style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find
                                                any orders for you search.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                id="close-modal"></button>
                        </div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <form class="tablelist-form" id="adduserform"
                                    action="{{ route('add-service-pricing') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="modal-body">
                                        <!-- Service Dropdown -->
                                        <div class="mb-3">
                                            <label for="service_cetegory" class="form-label">Select Service</label>
                                            <select id="service_cetegory" name="service_id" class="form-control"
                                                required>
                                                <option value="" disabled selected>Select Service</option>
                                                @foreach ($services as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Category Dropdown (Initially Empty) -->
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Select Category</label>
                                            <select id="category_id" name="category_id" class="form-control" required>
                                                <option value="" disabled selected>Select Category</option>
                                            </select>
                                        </div>

                                        <!-- Title -->
                                        <div class="mb-3">
                                            <label for="fixed_charge" class="form-label">Title</label>
                                            <div class="form-icon">
                                                <input type="text" class="form-control" name="title"
                                                    placeholder="Enter Service Name">
                                            </div>
                                        </div>

                                        <!-- Value -->
                                        <div class="mb-3">
                                            <label for="fixed_charge" class="form-label">Value</label>
                                            <div class="form-icon">
                                                <input type="text" class="form-control" name="value"
                                                    placeholder="Enter Service Value">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <script>
        $(document).ready(function() {
            $('#service_cetegory').on('change', function() {
                var serviceId = $(this).val();
                if (serviceId) {
                    $.ajax({
                        url: "{{ route('get-categories') }}", // Route to fetch categories
                        type: "GET",
                        data: {
                            service_id: serviceId
                        },
                        success: function(data) {
                            $('#category_id').html(
                                '<option value="" disabled selected>Select Category</option>'
                            );
                            $.each(data, function(key, value) {
                                $('#category_id').append('<option value="' + value.id +
                                    '">' + value.category_name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#category_id').html('<option value="" disabled selected>Select Category</option>');
                }
            });
        });
    </script>
     <script>
        $(document).ready(function() {
            $('#service_search_cetegory').on('change', function() {
                var serviceId = $(this).val();
                if (serviceId) {
                    $.ajax({
                        url: "{{ route('get-categories') }}", // Route to fetch categories
                        type: "GET",
                        data: {
                            service_id: serviceId
                        },
                        success: function(data) {
                            $('#category_search_id').html(
                                '<option value="" disabled selected>Select Category</option>'
                            );
                            $.each(data, function(key, value) {
                                $('#category_search_id').append('<option value="' + value.id +
                                    '">' + value.category_name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#category_search_id').html('<option value="" disabled selected>Select Category</option>');
                }
            });
        });
    </script>

@endsection
