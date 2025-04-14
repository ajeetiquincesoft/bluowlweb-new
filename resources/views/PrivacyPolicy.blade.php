<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Term & Conditions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images//blue-owl-white.png') }}">

    <!-- Layout config Js -->
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="layout-wrapper">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="bg-soft-warning position-relative">
                                <div class="card-body p-5">
                                    <div class="text-center">
                                        <h3>{{ $data->title }}</h3>
                                        <p class="mb-0 text-muted">Last update:
                                            {{ date('d M,Y', strtotime($data->updated_at)) }}</p>
                                    </div>
                                </div>
                                <div class="shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                                        width="1440" height="60" preserveAspectRatio="none" viewBox="0 0 1440 60">
                                        <g mask="url(&quot;#SvgjsMask1001&quot;)" fill="none">
                                            <path
                                                d="M 0,4 C 144,13 432,48 720,49 C 1008,50 1296,17 1440,9L1440 60L0 60z"
                                                style="fill: var(--vz-card-bg-custom);"></path>
                                        </g>
                                        <defs>
                                            <mask id="SvgjsMask1001">
                                                <rect width="1440" height="60" fill="#ffffff"></rect>
                                            </mask>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div>
                                    {!!$data->content!!}
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

            </div>
            <!-- container-fluid -->
        </div>
    </div>
</body>

</html>
