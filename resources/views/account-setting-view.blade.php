@extends('layouts.Myapp')
@section('content')
    @include('sweetalert::alert')
    <div class="page-content">
        <div class="container-fluid">

            <div class="position-relative mx-n4 mt-n4">
                <div class="profile-wid-bg profile-setting-img">
                    <img src="https://s3-alpha-sig.figma.com/img/1d16/581d/b5d5e1b7e7424a7a7086b2807c49b73c?Expires=1744588800&Key-Pair-Id=APKAQ4GOSFWCW27IBOMQ&Signature=H~0h4YHWt7Ztpv-rm8lsVxDmChmozWfZ1-E8muGiicsBIzyQXoUekFkl2Cn~x~snCcCNJEz8L0UtHDAK6OVGfjI-wpILdgBq9FBFew8sBW5rlgkIEKKBlh7lTB4CEpu~iL0D5d4AZLsVfkbGc0TWgi-AX8ahU1gKi4~HGPsyX8He5DpUKtH7JSiLCLwPMxpu55wwo1Ut-CcWi~XPTEh69urqJEZlt5qOX-QNhNwHtbqgScxQEIcwqsXqLu-P8NgCNSXc9VYxWMNYQPB-bfZ0b78Y~EtQxoR4o1xwV-DGOCW~qmueBuOG3aT7OGhiv77oN1cjdY5bs128FQkhYbDC4A__"
                        class="profile-wid-img" alt="">
                    <div class="overlay-content">
                        <div class="text-end p-3">
                            <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                <input id="profile-foreground-img-file-input" type="file"
                                    class="profile-foreground-img-file-input">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-3">
                    <div class="card mt-n5">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto  ">
                                    <img src="{{ Auth::user()->profile_pic ? asset('storage/uploads/' . Auth::user()->profile_pic) : asset('storage/uploads/17436829592146840487PI.png') }}"
                                        class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                        alt="user-profile-image">
                                    <form method="POST" enctype="multipart/form-data" id="profile_pic_form">
                                        @csrf
                                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                            <input id="profile-img-file-input" name="profile_image" type="file"
                                                class="profile-img-file-input" accept="image/png, image/gif, image/jpeg"
                                                onchange="Profile_pic_update()">
                                            <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                <span class="avatar-title rounded-circle bg-light text-body">
                                                    <i class="ri-camera-fill"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </form>
                                </div>
                                <h5 class="fs-16 mb-1">{{ Auth::user()->companyname }}</h5>
                                <p class="text-muted mb-0">{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                        <i class="fas fa-home fs-14"></i> Personal Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                        <i class="far fa-user fs-14"></i> Change Password
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#privacy" role="tab">
                                        <i class="bx bx-bell fs-18"></i> Notification settings
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <form method="post" action="{{ route('update_profile') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="firstnameInput" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" name="fullname"
                                                        id="firstnameInput" placeholder="Enter your firstname"
                                                        value="{{ Auth::user()->name }}">
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="phonenumberInput" class="form-label">Phone Number</label>
                                                    <input type="text" class="form-control" name="phone"
                                                        id="phonenumberInput" placeholder="Enter your phone number"
                                                        value="{{ Auth::user()->phone }}">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" id="emailInput"
                                                        placeholder="Enter your email" readonly
                                                        value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>

                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="websiteInput1" class="form-label">Website</label>
                                                    <input type="text" class="form-control" name="website"
                                                        id="websiteInput1" placeholder="www.example.com"
                                                        value="{{ Auth::user()->website_url }}" />
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3 pb-2">
                                                    <label for="exampleFormControlTextarea" class="form-label">About
                                                        Company & Services</label>
                                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea"
                                                        placeholder="Enter your description" rows="3">{{ auth::user()->about_service }}</textarea>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Updates</button>
                                                    <button type="button" class="btn btn-soft-success">Cancel</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane" id="changePassword" role="tabpanel">
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <form action="{{ route('changepassword') }}" method="POST">
                                        @csrf
                                        <div class="row g-2">
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                                    <input type="password" class="form-control" name="current-password"
                                                        id="oldpasswordInput" placeholder="Enter current password">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="newpasswordInput" class="form-label">New Password*</label>
                                                    <input type="password" class="form-control" name="new-password"
                                                        id="newpasswordInput" placeholder="Enter new password">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="confirmpasswordInput" class="form-label">Confirm
                                                        Password*</label>
                                                    <input type="password" class="form-control"
                                                        name="new-password_confirmation" id="confirmpasswordInput"
                                                        placeholder="Confirm password">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">

                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-success">Change
                                                        Password</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <!--end tab-pane-->

                                <!--end tab-pane-->
                                <div class="tab-pane" id="privacy" role="tabpanel">
                                    <form id="notificationForm" action="{{ route('update-notification-setting') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <h5 class="card-title text-decoration-underline mb-3">Application Notifications:</h5>
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <label for="directMessage" class="form-check-label fs-14">Notifications</label>
                                                        <p class="text-muted">Allow to notify vendor payments, etc</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="directMessage"
                                                                name="notification_status" value="1"
                                                                {{ isset($setting) && $setting->notification ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>

                                    {{-- <div class="mb-3">
                                        <h5 class="card-title text-decoration-underline mb-3">Application Notifications:
                                        </h5>
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex">
                                                <div class="flex-grow-1">
                                                    <label for="directMessage"
                                                        class="form-check-label fs-14">Notifications
                                                    </label>
                                                    <p class="text-muted">Alow to Notify vendor Payments , etc</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="directMessage" checked />
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div> --}}
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div><!-- End Page-content -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        function Profile_pic_update() {
            var fd = new FormData();
            var files = $('.profile-img-file-input')[0].files;
            var token = "{{ csrf_token() }}";
            if (files.length > 0) {
                fd.append('file', files[0]);
            }
            fd.append('_token', token);
            $.ajax({
                url: '{{ route('Profile_Image_update') }}',
                type: 'POST',
                data: fd,
                success: function(data) {
                    $('.user-profile-image').attr('src', data);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    </script>
    <script>
        document.getElementById('directMessage').addEventListener('change', function() {
            document.getElementById('notificationForm').submit();
        });
    </script>
@endsection
