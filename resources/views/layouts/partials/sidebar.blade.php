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
                <img src="{{asset('assets/images/blue-owl-white-single.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('assets/images/blue-owl-white.png')}}" alt="" height="70">
            </span>
        </a>
        <!-- Light Logo-->
        <a class="logo logo-light" href="{{route('home')}}">
            <span class="logo-sm">
                <img src="{{asset('assets/images/blue-owl-white-single.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('assets/images/blue-owl-white.png')}}" alt="" height="70">
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
                        <i class="ri-dashboard-2-line" style="font-size: 20px;"></i> <span data-key="">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('customers') ? 'active' : '' }}" href="{{route('customers')}}">
                        <i class="fas fa-users" style="font-size: 20px;"></i> <span data-key="">Customer</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('vendors') ? 'active' : '' }}" href="{{route('vendors')}}">
                        <i class="fas fa-user-cog" style="font-size: 20px;"></i> <span data-key="">Vendors</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link  {{ request()->is('our-services') ? 'active' : '' }}" href="{{route('our-services')}}">
                        <i class="fas fa-cogs" style="font-size: 20px;"></i> <span data-key="">Our Services</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('service-category') ? 'active' : '' }}" href="{{route('service-category')}}">
                        <i class="ri-apps-2-line" style="font-size: 20px;"></i> <span data-key="">Service Categories</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('services-pricing') ? 'active' : '' }}" href="{{route('servicesAndPricing')}}">
                        <i class="ri-money-dollar-circle-line" style="font-size: 20px;"></i> <span data-key="t-widgets">Service & Pricing</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link  {{ request()->is('transactions') ? 'active' : '' }}" href="{{route('transactions')}}">
                        <i class="fas fa-file-invoice-dollar" style="font-size: 20px;"></i> <span data-key="t-widgets">Transactions</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('setting') ? 'active' : '' }}" href="{{route('setting')}}">
                        <i class="ri-settings-2-line" style="font-size: 20px;"></i> <span data-key="t-widgets">Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('Setting') ? 'active' : '' }} {{ request()->is('admin/App_support') ? 'active' : '' }} {{ request()->is('admin/News') ? 'active' : '' }} {{ request()->is('admin/News') ? 'active' : '' }} {{ request()->is('admin/contact_us') ? 'active' : '' }}{{ request()->is('admin/FAQ') ? 'active' : '' }}{{ request()->is('admin/AddTermAndConditionData') ? 'active' : '' }}{{ request()->is('admin/PrivacyPolicyData') ? 'active' : '' }}" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-apps-2-line"></i> <span data-key="t-layouts" title="Admin Tools">Admin Tools</span>
                    </a>
                    <div class="collapse menu-dropdown  {{ request()->is('admin/App_support') ? 'show' : '' }} {{ request()->is('Setting') ? 'show' : '' }}  {{ request()->is('admin/News') ? 'show' : '' }}  {{ request()->is('admin/contact_us') ? 'show' : '' }}{{ request()->is('admin/FAQ') ? 'show' : '' }}{{ request()->is('admin/AddTermAndConditionData') ? 'show' : '' }}{{ request()->is('admin/PrivacyPolicyData') ? 'show' : '' }}" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a href="{{route('help')}}"  class="nav-link {{ request()->is('admin/FAQ') ? 'active' : '' }}" data-key="t-detached" title="FAQ">Help</a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{route('AddTermAndConditionData')}}"  class="nav-link {{ request()->is('admin/AddTermAndConditionData') ? 'active' : '' }}" data-key="t-detached" title="Term & Conditions">Term & Conditions</a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{route('PrivacyPolicyData')}}"  class="nav-link {{ request()->is('admin/PrivacyPolicyData') ? 'active' : '' }}" data-key="t-detached" title="Privacy Policy">Privacy Policy</a>
                            </li>

                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->



            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
