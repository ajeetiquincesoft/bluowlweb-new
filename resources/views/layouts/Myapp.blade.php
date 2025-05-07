<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark"
    data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <META NAME="robots" CONTENT="noindex,nofollow">
    <title>Blue Owl</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/blue-owl.png') }}">
    <!-- jsvectormap css -->
    <link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    @include('layouts.partials.head-css')

</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">


        @include('layouts.partials.menu')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @yield('content')
            @include('layouts.partials.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    @include('layouts.partials.customizer')

    @include('layouts.partials.vendor-scripts')

    <!--select2 cdn-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>


    <!-- Dashboard init -->
    <script src="{{ asset('assets/js/pages/dashboard-ecommerce.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"
        integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-messaging-compat.js"></script>

    <script>
        // Firebase config
        const firebaseConfig = {
            apiKey: "AIzaSyBYKwxAi3gRg8Vh6gbfHN56inKG_m5CDFM",
            authDomain: "blueowl-c5879.firebaseapp.com",
            projectId: "blueowl-c5879",
            storageBucket: "blueowl-c5879.appspot.com",
            messagingSenderId: "902164999109",
            appId: "1:902164999109:web:af67af0db05aa4f6cb39ac",
            measurementId: "G-HWQX2YENS2"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        // Request notification permission
        function requestPermission() {
            Notification.requestPermission().then(permission => {
                if (permission === 'granted') {
                    console.log('Notification permission granted.');
                    messaging.getToken({
                        vapidKey:BCTBStB5JjqQOCqTq4zNxVH_tNbmMlkH4LIuyZKjECmzeFMzjTGa4j9pU1g_K155CK233Kvp4r7wpkL8KpUvHWI
                    }).then((token) => {
                        console.log("FCM Token:", token);
                        $.ajax({
                            url: '{{ route('fcmToken') }}', // Replace with your server endpoint
                            type: 'POST',
                            data: {
                                fcmtoken: token,
                                _token: '{{ csrf_token() }}' // Include CSRF token if using Laravel
                            },
                            success: function(response) {
                                console.log("Token saved successfully:", response);
                            },
                            error: function(xhr, status, error) {
                                console.error("Error saving token:", error);
                            }
                        });
                        // Send this token to your server using fetch or axios
                    }).catch((err) => {
                        console.error("Error getting token:", err);
                    });
                } else {
                    console.error('Notification permission not granted.');
                }
            });
        }

        // Handle foreground messages
        messaging.onMessage((payload) => {
            console.log('Message received:', payload);
            // alert(payload.notification.title + ": " + payload.notification.body);
            if (payload.notification) {
                const notificationTitle = payload.notification.title;
                const notificationOptions = {
                    body: payload.notification.body,
                    icon: payload.notification.icon ||
                        'https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png', // Add fallback icon
                };

                // Create the notification
                new Notification(notificationTitle, notificationOptions);
            } else {
                console.log('No notification data found in payload');
            }
        });

        // Call the function
        requestPermission();
    </script>
</body>

</html>
