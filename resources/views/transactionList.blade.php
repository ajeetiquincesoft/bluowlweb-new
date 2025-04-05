@extends('layouts.Myapp')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Transaction</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <div class="table-responsive table-card mt-3 mb-1">
                                        <table class="table align-middle table-nowrap" id="customerTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col" style="width: 50px;">

                                                    </th>
                                                    <th class="sort" data-sort="customer_name">Company Name</th>
                                                    <th class="sort" data-sort="email">Due Date</th>
                                                    <th class="sort" data-sort="phone">Issue Date</th>
                                                    <th class="sort" data-sort="date">Amount ($)</th>
                                                    <th class="sort" data-sort="status">Status</th>
                                                    <th >Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <tr>
                                                    <th scope="row">

                                                    </th>
                                                    <td class="id" style="display:none;"><a href="javascript:void(0);"
                                                            class="fw-medium link-primary">#VZ10</a></td>
                                                    <td class="customer_name">Timothy Smith</td>
                                                    <td class="email">timothysmith@velzon.com</td>
                                                    <td class="phone">973-277-6950</td>
                                                    <td class="date">$10</td>
                                                    <td class="status"><span
                                                            class="badge badge-soft-success text-uppercase">Active</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                <button class="btn btn-sm btn-success edit-item-btn"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#showModal">View</button>
                                                            </div>

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">

                                                    </th>
                                                    <td class="id" style="display:none;"><a href="javascript:void(0);"
                                                            class="fw-medium link-primary">#VZ9</a></td>
                                                    <td class="customer_name">Herbert Stokes</td>
                                                    <td class="email">herbertstokes@velzon.com</td>
                                                    <td class="phone">312-944-1448</td>
                                                    <td class="date">$10</td>
                                                    <td class="status"><span
                                                            class="badge badge-soft-danger text-uppercase">Block</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                <button class="btn btn-sm btn-success edit-item-btn"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#showModal">View</button>
                                                            </div>

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">

                                                    </th>
                                                    <td class="id" style="display:none;"><a
                                                            href="javascript:void(0);"
                                                            class="fw-medium link-primary">#VZ8</a></td>
                                                    <td class="customer_name">Charles Kubik</td>
                                                    <td class="email">charleskubik@velzon.com</td>
                                                    <td class="phone">231-480-8536</td>
                                                    <td class="date">$10</td>
                                                    <td class="status"><span
                                                            class="badge badge-soft-danger text-uppercase">Block</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                <button class="btn btn-sm btn-success edit-item-btn"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#showModal">View</button>
                                                            </div>

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">

                                                    </th>
                                                    <td class="id" style="display:none;"><a
                                                            href="javascript:void(0);"
                                                            class="fw-medium link-primary">#VZ7</a></td>
                                                    <td class="customer_name">Glen Matney</td>
                                                    <td class="email">glenmatney@velzon.com</td>
                                                    <td class="phone">02 Nov, 2021</td>
                                                    <td class="date">$10</td>
                                                    <td class="status"><span
                                                            class="badge badge-soft-success text-uppercase">Active</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                <button class="btn btn-sm btn-success edit-item-btn"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#showModal">View</button>
                                                            </div>

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">

                                                    </th>
                                                    <td class="id" style="display:none;"><a
                                                            href="javascript:void(0);"
                                                            class="fw-medium link-primary">#VZ6</a></td>
                                                    <td class="customer_name">Carolyn Jones</td>
                                                    <td class="email">carolynjones@velzon.com</td>
                                                    <td class="phone">414-453-5725</td>
                                                    <td class="date">$10</td>
                                                    <td class="status"><span
                                                            class="badge badge-soft-success text-uppercase">Active</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                <button class="btn btn-sm btn-success edit-item-btn"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#showModal">View</button>
                                                            </div>

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">

                                                    </th>
                                                    <td class="id" style="display:none;"><a
                                                            href="javascript:void(0);"
                                                            class="fw-medium link-primary">#VZ5</a></td>
                                                    <td class="customer_name">Kevin Dawson</td>
                                                    <td class="email">kevindawson@velzon.com</td>
                                                    <td class="phone">213-741-4294</td>
                                                    <td class="date">$10</td>
                                                    <td class="status"><span
                                                            class="badge badge-soft-success text-uppercase">Active</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                <button class="btn btn-sm btn-success edit-item-btn"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#showModal">View</button>
                                                            </div>

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">

                                                    </th>
                                                    <td class="id" style="display:none;"><a
                                                            href="javascript:void(0);"
                                                            class="fw-medium link-primary">#VZ4</a></td>
                                                    <td class="customer_name">Michael Morris</td>
                                                    <td class="email">michaelmorris@velzon.com</td>
                                                    <td class="phone">805-447-8398</td>
                                                    <td class="date">$10</td>
                                                    <td class="status"><span
                                                            class="badge badge-soft-danger text-uppercase">Block</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                <button class="btn btn-sm btn-success edit-item-btn"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#showModal">View</button>
                                                            </div>

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">

                                                    </th>
                                                    <td class="id" style="display:none;"><a
                                                            href="javascript:void(0);"
                                                            class="fw-medium link-primary">#VZ3</a></td>
                                                    <td class="customer_name"></td>
                                                    <td class="email"></td>
                                                    <th class="phone"> <span class="text-bold text-danger">Totel paid</span> </td>
                                                    <th class="date">$70</td>
                                                    <td class="status">
                                                    </td>
                                                    <td>

                                                    </td>
                                                </tr>
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
                                        <div class="pagination-wrap hstack gap-2" style="display: flex;">
                                            <a class="page-item pagination-prev disabled" href="javascrpit:void(0)">
                                                Previous
                                            </a>
                                            <ul class="pagination listjs-pagination mb-0">
                                                <li class="active"><a class="page" href="#" data-i="1"
                                                        data-page="8">1</a></li>
                                                <li><a class="page" href="#" data-i="2" data-page="8">2</a>
                                                </li>
                                            </ul>
                                            <a class="page-item pagination-next" href="javascrpit:void(0)">
                                                Next
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end col -->
                </div>
            </div><!-- end row -->
        </div>
    </div>
@endsection
