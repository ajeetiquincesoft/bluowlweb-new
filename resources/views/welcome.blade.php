<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blueowl - Home & Emergency Services</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link href="https://cdn.jsdelivr.net/gh/github/mona-sans@latest/fonts.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid home-img" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="gap: 10px;">
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
                <form class="d-none d-lg-flex">
                    <div class="position-relative me-2 input-group-lg w-60">
                        <!-- Left image -->
                        <img src="{{ asset('assets/images/location_on.png') }}" class="position-absolute"
                            style="top: 50%; left: 10px; transform: translateY(-50%); width:20px; height:20px;" />

                        <!-- Input field -->
                        <input type="text" class="form-control ps-5 pe-5" placeholder="Location">

                        <!-- Right image -->
                        <img src="{{ asset('assets/images/my_location.png') }}" class="position-absolute"
                            style="top: 50%; right: 10px; transform: translateY(-50%); width:20px; height:20px;" />
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-0071BD mx-3 btn-md d-flex align-items-center">
                        <img src="{{ asset('assets/images/account_circle.png') }}" alt="user" class="me-2"
                            style="width:20px; height:20px;">
                        Login
                    </a>
                    <a href="{{ route('userRegister') }}" class="btn btn-0071BD btn-md d-flex align-items-center">
                        <img src="{{ asset('assets/images/account_circle.png') }}" alt="user" class="me-2"
                            style="width:20px; height:20px;">
                       Register
                    </a>
                </form>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="container hero" style="background-image: url('{{ asset('assets/images/Frame.png') }}');">
        <div class="row">
            <div class="col-md-8">
                <h1 class="fw-42">Blueowl – Your One-Stop Platform for Home & Emergency Services</h1>
                <p class="mt-3 fw-20">Find trusted locksmiths, plumbers, electricians, and general service providers
                    near you –
                    fast,
                    reliable, and affordable.</p>
            </div>
            <div class="col-md-4 d-flex flex-column justify-content-end text-md-start text-center">
                <div class=" mb-1">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                        height="45" class="me-2">
                    <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                        height="45">
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="container my-5">
        <h3 class="color-1A1363 fw-bold mb-4">Customer Services</h3>
        <div class="row d-flex justify-content-between g-1">
            <div class="col-md-2 col-6">
                <div class="service-card ">
                    <img src="{{ asset('assets/images/locksmith.png') }}" class="static-img" alt="Locksmith"
                        style="width:45px; height:45px;">
                    <img src="{{ asset('assets/images/LocksmithGIF.gif') }}" class="hover-img" alt="Locksmith"
                        style="width:45px; height:45px;">
                    <p class="mt-2 p-0 mt-2 m-0"><b>Locksmith <i class="fa-solid fa-arrow-right arrow-icon"></i></b></p>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="service-card ">
                    <img src="{{ asset('assets/images/Plumber.png') }}" class="static-img" alt="Plumber"
                        style="width:45px; height:45px;">
                    <img src="{{ asset('assets/images/PlumberGIF.gif') }}" class="hover-img" alt="Plumber"
                        style="width:45px; height:45px;">
                    <p class="mt-2 p-0 mt-2 m-0"><b>Plumber <i class="fa-solid fa-arrow-right arrow-icon"></i></b></p>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="service-card ">
                    <img src="{{ asset('assets/images/General Contractor.png') }}" class="static-img"
                        alt="Contractor" style="width:45px; height:45px;">
                    <img src="{{ asset('assets/images/General ContractorGIF.gif') }}" class="hover-img"
                        alt="Contractor" style="width:45px; height:45px;">
                    <p class="mt-2 p-0 mt-2 m-0"><b>Contractor <i class="fa-solid fa-arrow-right arrow-icon"></i></b>
                    </p>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="service-card ">
                    <img src="{{ asset('assets/images/Electrician.png') }}" class="static-img" alt="Electrician"
                        style="width:45px; height:45px;">
                    <img src="{{ asset('assets/images/ElectricianGIF.gif') }}" class="hover-img" alt="Electrician"
                        style="width:45px; height:45px;">
                    <p class="mt-2 p-0 mt-2 m-0"><b>Electrician <i class="fa-solid fa-arrow-right arrow-icon"></i></b>
                    </p>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="service-card ">
                    <img src="{{ asset('assets/images/Others.png') }}" class="static-img" alt="Other"
                        style="width:45px; height:45px;">
                    <img src="{{ asset('assets/images/OthersGIF.gif') }}" class="hover-img" alt="Other"
                        style="width:45px; height:45px;">
                    <p class="mt-2 p-0 mt-2 m-0"><b>Other <i class="fa-solid fa-arrow-right arrow-icon"></i></b></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Blueowl -->
    <section class="container my-5">
        <div class="row g-5 align-items-start">
            <div class="col-md-6 ">
                <div class="row info-user-box ">
                    <div class="col-md-8">
                        <div>
                            <h5>Why Blueowl App As An User?</h5>
                            <ul style="line-height: 1.5;">
                                <li>All services in one app</li>
                                <li>Instant & reliable bookings</li>
                                <li>Verified, trusted professionals</li>
                                <li>Transparent pricing, no surprises</li>
                                <li>Track & manage requests anytime</li>
                            </ul>
                            <button class="btn btn-0071BD btn-experience">Login to book now
                                <i class="fa-solid fa-arrow-right arrow-icon" style="  font-size: 12px;"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('assets/images/User mockup.png') }}" style="height: 79%;" alt="User App"
                            class="img-fluid phone-img">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row info-vendor-box  ">
                    <div class="col-md-8">
                        <div>
                            <h5>Why Blueowl App As A Vendor?</h5>
                            <ul style="line-height: 1.5;">
                                <li>Get more customers easily</li>
                                <li>Simple app-based service requests</li>
                                <li>Fast & transparent payments</li>
                                <li>Build reputation with reviews</li>
                                <li>Work when you want, earn more</li>
                            </ul>
                            <button class="btn btn-0071BD btn-experience">Login to book now
                                <i class="fa-solid fa-arrow-right arrow-icon" style="  font-size: 12px;"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('assets/images/User mockup.png') }}" style="height: 79%;" alt="User App"
                            class="img-fluid phone-img">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-box container my-5">
        <div class="row">
            <div class="col-md-3 service-heading">
                <h2>Book a Service Now</h2>
            </div>
            <div class="col-md-6 service-content">
                <p>
                    Connect instantly with trusted locksmiths, plumbers, electricians, and more.
                    Fast, reliable, and affordable services right at your doorstep.
                </p>
                <button class="btn btn-0071BD">Book Now <i class="fa-solid fa-arrow-right arrow-icon"
                        style="font-size:12px;"></i></button>
            </div>
            <div class="col-md-3"></div>
        </div>
    </section>

    <!-- Contact -->
    <section class="container my-5">
        <div class="row g-4">
            <div class="col-md-6">
                <h3 class="color-1A1363 fw-bold">Get in Touch with Blueowl</h3>
                <p class="mt-4">Have a question or need support? We're here to help you connect with trusted
                    locksmiths,
                    plumbers,
                    electricians, and more.</p>
                <p class="mt-4">Fill out the form below, and our team will get back to you shortly.</p>
                <div class="mt-4 text-center text-lg-start">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                        height="45" class="me-2 mb-2">
                    <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                        height="45" class="mb-2">
                </div>

                <div class="mt-4 text-center text-lg-start">
                    <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid home-img" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-box ">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Last Name">
                            </div>

                            <div class="col-md-12">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Phone">
                            </div>

                            <div class="col-md-12">
                                <select class="form-select">
                                    <option selected disabled>Select Service</option>
                                    <option>Locksmith</option>
                                    <option>Plumber</option>
                                    <option>Electrician</option>
                                    <option>General Contractor</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" rows="4" placeholder="Service Request Details"></textarea>
                            </div>

                            <div class="col-md-12 text-center text-lg-start">
                                <button type="submit" class="btn btn-1A1363">Send Message <i
                                        class="fa-solid fa-arrow-right arrow-icon"
                                        style="font-size:12px;"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        © Copyright by Blueowl 2025. All rights reserved
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
