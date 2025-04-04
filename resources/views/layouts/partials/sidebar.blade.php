<!-- ========== App Menu ========== -->
<style>
    .navbar-menu {
        background: var(--vz-vertical-menu-bg-dark);
        border-right: 1px solid var(--vz-vertical-menu-bg-dark);
    }
</style>
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box p-2">
        <!-- Dark Logo-->
        <a class="logo logo-dark" href="{{route('home')}}">
            <span class="logo-sm">
                <img src="assets/images/blue-owl-white-single.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/blue-owl-white.png" alt="" height="70">
            </span>
        </a>
        <!-- Light Logo-->
        <a class="logo logo-light" href="{{route('home')}}">
            <span class="logo-sm">
                <img src="assets/images/blue-owl-white-single.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/blue-owl-white.png" alt="" height="70">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link  {{ request()->is('home') ? 'active' : '' }}" href="{{route('home')}}">
                        <i class="ri-dashboard-2-line" style="font-size: 24px;"></i> <span data-key="t-widgets">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('customers') ? 'active' : '' }}" href="{{route('customers')}}">
                        <i class="fas fa-users" style="font-size: 20px;"></i> <span data-key="t-widgets">Customer</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('vendors') ? 'active' : '' }}" href="{{route('vendors')}}">
                        <i class="las la-user-cog" style="font-size: 20px;"></i> <span data-key="t-widgets">Vendors</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link  {{ request()->is('our-services') ? 'active' : '' }}" href="{{route('our-services')}}">
                        <i class=" fas fa-cogs" style="font-size: 20px;"></i> <span data-key="t-widgets">Our Services</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('service-category') ? 'active' : '' }}" href="{{route('service-category')}}">
                        <i class="ri-apps-2-line" style="font-size: 24px;"></i> <span data-key="t-widgets">Service Categories</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('services-pricing') ? 'active' : '' }}" href="{{route('servicesAndPricing')}}">
                        <i class="ri-money-dollar-circle-line" style="font-size: 24px;"></i> <span data-key="t-widgets">Service & Pricing</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link  {{ request()->is('transactions') ? 'active' : '' }}" href="{{route('transactions')}}">
                        <i class="fas fa-file-invoice-dollar" style="font-size: 20px;"></i> <span data-key="t-widgets">Transactions</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('setting') ? 'active' : '' }}" href="{{route('setting')}}">
                        <i class="ri-settings-2-line" style="font-size: 24px;"></i> <span data-key="t-widgets">Settings</span>
                    </a>
                </li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
