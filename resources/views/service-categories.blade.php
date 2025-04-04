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
                                        <form action="{{route('service-category')}}" method="get">
                                            <div class="row justify-content-end">
                                                <input type="hidden" name="sort"
                                                    value="{{ @$_GET['sort'] ? $_GET['sort'] : '' }}">
                                                <input type="hidden" name="direction"
                                                    value="{{ @$_GET['direction'] ? $_GET['direction'] : '' }}">


                                                <div class="col-xxl-3 col-md-3" title="Select status">
                                                    <select id="service_cetegory" name="service_id" class="form-control"
                                                        required>
                                                        <option value="" disabled selected>Select Service
                                                        </option>
                                                        @foreach ($services as $value)
                                                            <option value="{{ $value->id }}"  {{ isset($_GET['service_id']) && $_GET['service_id'] == $value->id  ? 'selected' : '' }}>{{ $value->name }}</option>
                                                        @endforeach
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
                                                <th data-sort="customer_name">Category Name</th>
                                                <th data-sort="customer_name">Service Name</th>
                                                <th data-sort="status">Status</th>
                                                <th data-sort="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @if (count($category) > 0)
                                                @foreach ($category as $item)
                                                    <tr>
                                                        <th scope="row">
                                                        </th>
                                                        <td class="id" style="display:none;"><a
                                                                href="javascript:void(0);"
                                                                class="fw-medium link-primary">#VZ2101</a></td>
                                                        <td class="email">{{ $item->category_name }}</td>
                                                        <td class="email">
                                                            {{ $item->getservicedata($item->service_id)->name }}</td>
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
                                                                                    <div class = "alert alert-danger">
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
                                                                                            action="{{ route('edit-Service-category', ['id' => Crypt::encrypt($item->id)]) }}"
                                                                                            method="POST"
                                                                                            autocomplete="off">
                                                                                            @csrf
                                                                                            <div class="modal-body">
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="service_cetegory"
                                                                                                        class="form-label">Select
                                                                                                        Service
                                                                                                    </label>
                                                                                                    <select
                                                                                                        id="service_cetegory"
                                                                                                        name="service_id"
                                                                                                        class="form-control"
                                                                                                        required>
                                                                                                        <option
                                                                                                            value=""
                                                                                                            disabled
                                                                                                            selected>Select
                                                                                                            Service
                                                                                                        </option>
                                                                                                        @foreach ($services as $value)
                                                                                                            <option
                                                                                                                value="{{ $value->id }}"
                                                                                                                {{ $value->id == $item->service_id ? 'selected' : '' }}>
                                                                                                                {{ $value->name }}
                                                                                                            </option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="fixed_charge"
                                                                                                        class="form-label">
                                                                                                        Service Category
                                                                                                        Name</label>
                                                                                                    <div class="form-icon">
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control "
                                                                                                            id="iconInput"
                                                                                                            name="category_name"
                                                                                                            value="{{ $item->category_name }}"
                                                                                                            placeholder="Enter   Service Category Name">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="mb-3">
                                                                                                    <label
                                                                                                        for="status-select{{ $item->id }}"
                                                                                                        class="form-label">Select
                                                                                                        Status</label>
                                                                                                    <select
                                                                                                        class="form-control"
                                                                                                        name="status"
                                                                                                        id="status-select{{ $item->id }}">
                                                                                                        <option
                                                                                                            value="">
                                                                                                            Select Status
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="1"
                                                                                                            {{ $item->status == 1 ? 'selected' : '' }}>
                                                                                                            Active</option>
                                                                                                        <option
                                                                                                            value="0"
                                                                                                            {{ $item->status == 0 ? 'selected' : '' }}>
                                                                                                            Inactive
                                                                                                        </option>
                                                                                                    </select>
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
                                    <div class="d-flex justify-content-end px-2">
                                        {{ $category->links('vendor.pagination.custom') }}
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
                            <div class = "alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <form class="tablelist-form" id="adduserform" action="{{ route('add-cetegory') }}"
                                    method="POST" autocomplete="off">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="service_cetegory" class="form-label">Select Service
                                            </label>
                                            <select id="service_cetegory" name="service_id" class="form-control"
                                                required>
                                                <option value="" disabled selected>Select Service
                                                </option>
                                                @foreach ($services as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="mb-3">
                                            <label for="fixed_charge" class="form-label"> Service Category Name</label>
                                            <div class="form-icon">
                                                <input type="text" class="form-control " id="iconInput"
                                                    name="category_name" placeholder="Enter  Service Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" value="submit" class="btn btn-success"
                                                id="add-btn">Add</button>
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
        <!-- container-fluid -->
    </div>
@endsection
