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
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Totel
                                                Customers
                                            </p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                        data-target="825">0</span></h4>

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
                                            <p class="text-uppercase fw-medium text-muted mb-3">Totel Vendors</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                        data-target="7522">0</span></h4>

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
                            <h4 class="card-title flex-grow-1 mb-0">Recent Activity</h4>
                            <div class="flex-shrink-0">
                                <a href="javascript:void(0);" class="btn btn-soft-info btn-sm">Export Report</a>
                            </div>
                        </div><!-- end cardheader -->
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-nowrap table-centered align-middle">
                                    <thead class="bg-light text-muted">
                                        <tr>
                                            <th scope="col">Project Name</th>
                                            <th scope="col">Project Lead</th>
                                            <th scope="col">Progress</th>
                                            <th scope="col">Assignee</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" style="width: 10%;">Due Date</th>
                                        </tr><!-- end tr -->
                                    </thead><!-- thead -->

                                    <tbody>
                                        <tr>
                                            <td class="fw-medium">Brand Logo Design</td>
                                            <td>
                                                <img src="assets/images/users/avatar-1.jpg"
                                                    class="avatar-xxs rounded-circle me-1" alt="">
                                                <a href="javascript: void(0);" class="text-reset">Donald Risher</a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-1 text-muted fs-13">53%</div>
                                                    <div class="progress progress-sm  flex-grow-1" style="width: 68%;">
                                                        <div class="progress-bar bg-primary rounded" role="progressbar"
                                                            style="width: 53%" aria-valuenow="53" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group flex-nowrap">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="assets/images/users/avatar-1.jpg" alt=""
                                                                class="rounded-circle avatar-xxs">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="assets/images/users/avatar-2.jpg" alt=""
                                                                class="rounded-circle avatar-xxs">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="assets/images/users/avatar-3.jpg" alt=""
                                                                class="rounded-circle avatar-xxs">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-soft-warning">Inprogress</span></td>
                                            <td class="text-muted">06 Sep 2021</td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <td class="fw-medium">Redesign - Landing Page</td>
                                            <td>
                                                <img src="assets/images/users/avatar-2.jpg"
                                                    class="avatar-xxs rounded-circle me-1" alt="">
                                                <a href="javascript: void(0);" class="text-reset">Prezy William</a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 text-muted me-1">0%</div>
                                                    <div class="progress progress-sm flex-grow-1" style="width: 68%;">
                                                        <div class="progress-bar bg-primary rounded" role="progressbar"
                                                            style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="assets/images/users/avatar-5.jpg" alt=""
                                                                class="rounded-circle avatar-xxs">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="assets/images/users/avatar-6.jpg" alt=""
                                                                class="rounded-circle avatar-xxs">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-soft-danger">Pending</span></td>
                                            <td class="text-muted">13 Nov 2021</td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <td class="fw-medium">Multipurpose Landing Template</td>
                                            <td>
                                                <img src="assets/images/users/avatar-3.jpg"
                                                    class="avatar-xxs rounded-circle me-1" alt="">
                                                <a href="javascript: void(0);" class="text-reset">Boonie Hoynas</a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 text-muted me-1">100%</div>
                                                    <div class="progress progress-sm flex-grow-1" style="width: 68%;">
                                                        <div class="progress-bar bg-primary rounded" role="progressbar"
                                                            style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="assets/images/users/avatar-7.jpg" alt=""
                                                                class="rounded-circle avatar-xxs">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="assets/images/users/avatar-8.jpg" alt=""
                                                                class="rounded-circle avatar-xxs">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-soft-success">Completed</span></td>
                                            <td class="text-muted">26 Nov 2021</td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <td class="fw-medium">Chat Application</td>
                                            <td>
                                                <img src="assets/images/users/avatar-5.jpg"
                                                    class="avatar-xxs rounded-circle me-1" alt="">
                                                <a href="javascript: void(0);" class="text-reset">Pauline Moll</a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 text-muted me-1">64%</div>
                                                    <div class="progress flex-grow-1 progress-sm" style="width: 68%;">
                                                        <div class="progress-bar bg-primary rounded" role="progressbar"
                                                            style="width: 64%" aria-valuenow="64" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="assets/images/users/avatar-2.jpg" alt=""
                                                                class="rounded-circle avatar-xxs">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-soft-warning">Progress</span></td>
                                            <td class="text-muted">15 Dec 2021</td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <td class="fw-medium">Create Wireframe</td>
                                            <td>
                                                <img src="assets/images/users/avatar-6.jpg"
                                                    class="avatar-xxs rounded-circle me-1" alt="">
                                                <a href="javascript: void(0);" class="text-reset">James Bangs</a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 text-muted me-1">77%</div>
                                                    <div class="progress flex-grow-1 progress-sm" style="width: 68%;">
                                                        <div class="progress-bar bg-primary rounded" role="progressbar"
                                                            style="width: 77%" aria-valuenow="77" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="assets/images/users/avatar-1.jpg" alt=""
                                                                class="rounded-circle avatar-xxs">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="assets/images/users/avatar-6.jpg" alt=""
                                                                class="rounded-circle avatar-xxs">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="assets/images/users/avatar-4.jpg" alt=""
                                                                class="rounded-circle avatar-xxs">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-soft-warning">Progress</span></td>
                                            <td class="text-muted">21 Dec 2021</td>
                                        </tr><!-- end tr -->
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>

                            <div class="align-items-center mt-xl-3 mt-4 justify-content-between d-flex">
                                <div class="flex-shrink-0">
                                    <div class="text-muted">Showing <span class="fw-semibold">5</span> of <span
                                            class="fw-semibold">25</span> Results </div>
                                </div>
                                <ul class="pagination pagination-separated pagination-sm mb-0">
                                    <li class="page-item disabled">
                                        <a href="#" class="page-link">←</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">1</a>
                                    </li>
                                    <li class="page-item active">
                                        <a href="#" class="page-link">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">→</a>
                                    </li>
                                </ul>
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
                                            <th scope="col">Hours</th>
                                            <th scope="col">Tasks</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="d-flex">
                                                <img src="assets/images/users/avatar-1.jpg" alt=""
                                                    class="avatar-xs rounded-3 me-2">
                                                <div>
                                                    <h5 class="fs-13 mb-0">Donald Risher</h5>
                                                    <p class="fs-12 mb-0 text-muted">Product Manager</p>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-0">110h : <span class="text-muted">150h</span></h6>
                                            </td>
                                            <td>
                                                258
                                            </td>
                                            <td style="width:5%;">
                                                <div id="radialBar_chart_1" data-colors='["--vz-primary"]'
                                                    data-chart-series="50" class="apex-charts" dir="ltr"></div>
                                            </td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <td class="d-flex">
                                                <img src="assets/images/users/avatar-2.jpg" alt=""
                                                    class="avatar-xs rounded-3 me-2">
                                                <div>
                                                    <h5 class="fs-13 mb-0">Jansh Brown</h5>
                                                    <p class="fs-12 mb-0 text-muted">Lead Developer</p>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-0">83h : <span class="text-muted">150h</span></h6>
                                            </td>
                                            <td>
                                                105
                                            </td>
                                            <td>
                                                <div id="radialBar_chart_2" data-colors='["--vz-primary"]'
                                                    data-chart-series="45" class="apex-charts" dir="ltr"></div>
                                            </td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <td class="d-flex">
                                                <img src="assets/images/users/avatar-7.jpg" alt=""
                                                    class="avatar-xs rounded-3 me-2">
                                                <div>
                                                    <h5 class="fs-13 mb-0">Carroll Adams</h5>
                                                    <p class="fs-12 mb-0 text-muted">Lead Designer</p>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-0">58h : <span class="text-muted">150h</span></h6>
                                            </td>
                                            <td>
                                                75
                                            </td>
                                            <td>
                                                <div id="radialBar_chart_3" data-colors='["--vz-primary"]'
                                                    data-chart-series="75" class="apex-charts" dir="ltr"></div>
                                            </td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <td class="d-flex">
                                                <img src="assets/images/users/avatar-4.jpg" alt=""
                                                    class="avatar-xs rounded-3 me-2">
                                                <div>
                                                    <h5 class="fs-13 mb-0">William Pinto</h5>
                                                    <p class="fs-12 mb-0 text-muted">UI/UX Designer</p>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-0">96h : <span class="text-muted">150h</span></h6>
                                            </td>
                                            <td>
                                                85
                                            </td>
                                            <td>
                                                <div id="radialBar_chart_4" data-colors='["--vz-warning"]'
                                                    data-chart-series="25" class="apex-charts" dir="ltr"></div>
                                            </td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <td class="d-flex">
                                                <img src="assets/images/users/avatar-6.jpg" alt=""
                                                    class="avatar-xs rounded-3 me-2">
                                                <div>
                                                    <h5 class="fs-13 mb-0">Garry Fournier</h5>
                                                    <p class="fs-12 mb-0 text-muted">Web Designer</p>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-0">76h : <span class="text-muted">150h</span></h6>
                                            </td>
                                            <td>
                                                69
                                            </td>
                                            <td>
                                                <div id="radialBar_chart_5" data-colors='["--vz-primary"]'
                                                    data-chart-series="60" class="apex-charts" dir="ltr"></div>
                                            </td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <td class="d-flex">
                                                <img src="assets/images/users/avatar-5.jpg" alt=""
                                                    class="avatar-xs rounded-3 me-2">
                                                <div>
                                                    <h5 class="fs-13 mb-0">Susan Denton</h5>
                                                    <p class="fs-12 mb-0 text-muted">Lead Designer</p>
                                                </div>
                                            </td>

                                            <td>
                                                <h6 class="mb-0">123h : <span class="text-muted">150h</span></h6>
                                            </td>
                                            <td>
                                                658
                                            </td>
                                            <td>
                                                <div id="radialBar_chart_6" data-colors='["--vz-success"]'
                                                    data-chart-series="85" class="apex-charts" dir="ltr"></div>
                                            </td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <td class="d-flex">
                                                <img src="assets/images/users/avatar-3.jpg" alt=""
                                                    class="avatar-xs rounded-3 me-2">
                                                <div>
                                                    <h5 class="fs-13 mb-0">Joseph Jackson</h5>
                                                    <p class="fs-12 mb-0 text-muted">React Developer</p>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-0">117h : <span class="text-muted">150h</span></h6>
                                            </td>
                                            <td>
                                                125
                                            </td>
                                            <td>
                                                <div id="radialBar_chart_7" data-colors='["--vz-primary"]'
                                                    data-chart-series="70" class="apex-charts" dir="ltr"></div>
                                            </td>
                                        </tr><!-- end tr -->
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
        const ctx = document.getElementById('topServicesChart').getContext('2d');
        const topServicesChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Locksmith', 'Plumber', 'Electrician'],
                datasets: [{
                    label: 'Order Numbers',
                    data: [25, 30, 15],
                    backgroundColor: [
                        '#36A2EB', // blue
                        '#FF6384', // red
                        '#FFCE56' // yellow
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
