<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" sizes="16x16">
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lib/flatpickr.min.css') }}">
    <!-- Calendar css -->
    <!-- Popup css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/magnific-popup.css') }}">
    <!-- prism css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/prism.css') }}">
    <!-- file upload css -->
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <aside class="sidebar">
        <button type="button" class="sidebar-close-btn">
            <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
        </button>
        <div>
            <a href="{{ route('home') }}" class="sidebar-logo">
                <img src="https://ui-avatars.com/api/?name={{ env('APP_NAME') }}" alt="site logo" class="light-logo">
                <img src="https://ui-avatars.com/api/?name={{ env('APP_NAME') }}" alt="site logo" class="dark-logo">
                <img src="https://ui-avatars.com/api/?name={{ env('APP_NAME') }}" alt="site logo" class="logo-icon">
            </a>
        </div>
        <div class="sidebar-menu-area">
            <ul class="sidebar-menu" id="sidebar-menu">
                @role('admin')
                    <li>
                        <a href="{{ route('home') }}">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                            <span>Dashboard</span>
                        </a>

                    </li>
                    <li>
                        <a href="{{ route('admin.providers') }}">
                            <iconify-icon icon="mage:email" class="menu-icon"></iconify-icon>
                            <span>Service Providers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.clients.list') }}">
                            <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
                            <span>Clients</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.payments')}}">
                            <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
                            <span>Payments</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.complains')}}">
                            <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
                            <span>Complains</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
                            <span>Service Categories</span>
                        </a>
                    </li>
                @endrole
                @role('provider')
                    <li>
                        <a href="{{ route('home') }}">
                            <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('provider.bookings')}}">
                            <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                            <span>Bookings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('provider.services')}}">
                            <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('provider.complains')}}">
                            <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                            <span>Complains</span>
                        </a>
                    </li>
                @endrole
                @role('client')
                    <li>
                        <a href="{{ route('home') }}">
                            <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.bookings')}}">
                            <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                            <span>Bookings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.complains')}}">
                            <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                            <span>Complains</span>
                        </a>
                    </li>
                @endrole

                {{-- <li class="sidebar-menu-group-title">UI Elements</li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="solar:document-text-outline" class="menu-icon"></iconify-icon>
                        <span>Components</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="typography.html"><i
                                    class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Typography</a>
                        </li>
                        <li>
                            <a href="colors.html"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>
                                Colors</a>
                        </li>
                        <li>
                            <a href="button.html"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i>
                                Button</a>
                        </li>
                        <li>
                            <a href="dropdown.html"><i class="ri-circle-fill circle-icon text-lilac-600 w-auto"></i>
                                Dropdown</a>
                        </li>
                        <li>
                            <a href="alert.html"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>
                                Alerts</a>
                        </li>
                        <li>
                            <a href="card.html"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i>
                                Card</a>
                        </li>
                        <li>
                            <a href="carousel.html"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                                Carousel</a>
                        </li>
                        <li>
                            <a href="avatar.html"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i>
                                Avatars</a>
                        </li>
                        <li>
                            <a href="progress.html"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Progress bar</a>
                        </li>
                        <li>
                            <a href="tabs.html"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>
                                Tab & Accordion</a>
                        </li>
                        <li>
                            <a href="pagination.html"><i
                                    class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Pagination</a>
                        </li>
                        <li>
                            <a href="badges.html"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                                Badges</a>
                        </li>
                        <li>
                            <a href="tooltip.html"><i class="ri-circle-fill circle-icon text-lilac-600 w-auto"></i>
                                Tooltip & Popover</a>
                        </li>
                        <li>
                            <a href="videos.html"><i class="ri-circle-fill circle-icon text-cyan w-auto"></i>
                                Videos</a>
                        </li>
                        <li>
                            <a href="star-rating.html"><i class="ri-circle-fill circle-icon text-indigo w-auto"></i>
                                Star Ratings</a>
                        </li>
                        <li>
                            <a href="tags.html"><i class="ri-circle-fill circle-icon text-purple w-auto"></i> Tags</a>
                        </li>
                        <li>
                            <a href="list.html"><i class="ri-circle-fill circle-icon text-red w-auto"></i> List</a>
                        </li>
                        <li>
                            <a href="calendar.html"><i class="ri-circle-fill circle-icon text-yellow w-auto"></i>
                                Calendar</a>
                        </li>
                        <li>
                            <a href="radio.html"><i class="ri-circle-fill circle-icon text-orange w-auto"></i>
                                Radio</a>
                        </li>
                        <li>
                            <a href="switch.html"><i class="ri-circle-fill circle-icon text-pink w-auto"></i>
                                Switch</a>
                        </li>
                        <li>
                            <a href="image-upload.html"><i
                                    class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Upload</a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="heroicons:document" class="menu-icon"></iconify-icon>
                        <span>Forms</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="form.html"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Input Forms</a>
                        </li>
                        <li>
                            <a href="form-layout.html"><i
                                    class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Input Layout</a>
                        </li>
                        <li>
                            <a href="form-validation.html"><i
                                    class="ri-circle-fill circle-icon text-success-main w-auto"></i> Form
                                Validation</a>
                        </li>
                        <li>
                            <a href="wizard.html"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i>
                                Form Wizard</a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="mingcute:storage-line" class="menu-icon"></iconify-icon>
                        <span>Table</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="table-basic.html"><i
                                    class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Basic Table</a>
                        </li>
                        <li>
                            <a href="table-data.html"><i
                                    class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Data Table</a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="solar:pie-chart-outline" class="menu-icon"></iconify-icon>
                        <span>Chart</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="line-chart.html"><i
                                    class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Line Chart</a>
                        </li>
                        <li>
                            <a href="column-chart.html"><i
                                    class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Column Chart</a>
                        </li>
                        <li>
                            <a href="pie-chart.html"><i
                                    class="ri-circle-fill circle-icon text-success-main w-auto"></i> Pie Chart</a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li>
                    <a href="widgets.html">
                        <iconify-icon icon="fe:vector" class="menu-icon"></iconify-icon>
                        <span>Widgets</span>
                    </a>
                </li> --}}
                {{-- <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                        <span>Users</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="users-list.html"><i
                                    class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Users List</a>
                        </li>
                        <li>
                            <a href="users-grid.html"><i
                                    class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Users Grid</a>
                        </li>
                        <li>
                            <a href="add-user.html"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                                Add User</a>
                        </li>
                        <li>
                            <a href="view-profile.html"><i
                                    class="ri-circle-fill circle-icon text-danger-main w-auto"></i> View Profile</a>
                        </li>
                        <li>
                            <a href="users-role-permission.html"><i
                                    class="ri-circle-fill circle-icon text-info-main w-auto"></i> User Role &
                                Permission</a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-user-settings-line text-xl me-14 d-flex w-auto"></i>
                        <span>Role & Access</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="role-access.html"><i
                                    class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Role & Access</a>
                        </li>
                        <li>
                            <a href="assign-role.html"><i
                                    class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Assign Role</a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="sidebar-menu-group-title">Application</li>

                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="simple-line-icons:vector" class="menu-icon"></iconify-icon>
                        <span>Authentication</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="sign-in.html"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Sign In</a>
                        </li>
                        <li>
                            <a href="sign-up.html"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>
                                Sign Up</a>
                        </li>
                        <li>
                            <a href="forgot-password.html"><i
                                    class="ri-circle-fill circle-icon text-info-main w-auto"></i> Forgot Password</a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="solar:gallery-wide-linear" class="menu-icon"></iconify-icon>
                        <span>Gallery</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="gallery-grid.html"><i
                                    class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Gallery Grid</a>
                        </li>
                        <li>
                            <a href="gallery.html"><i class="ri-circle-fill circle-icon text-danger-600 w-auto"></i>
                                Gallery Grid Desc</a>
                        </li>
                        <li>
                            <a href="gallery-masonry.html"><i
                                    class="ri-circle-fill circle-icon text-info-main w-auto"></i> Gallery Masonry</a>
                        </li>
                        <li>
                            <a href="gallery-hover.html"><i
                                    class="ri-circle-fill circle-icon text-info-main w-auto"></i> Gallery Hover
                                Effect</a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li>
                    <a href="pricing.html">
                        <iconify-icon icon="hugeicons:money-send-square" class="menu-icon"></iconify-icon>
                        <span>Pricing</span>
                    </a>
                </li> --}}
                {{-- <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-news-line text-xl me-14 d-flex w-auto"></i>
                        <span>Blog</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="blog.html"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Blog</a>
                        </li>
                        <li>
                            <a href="blog-details.html"><i
                                    class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Blog Details</a>
                        </li>
                        <li>
                            <a href="add-blog.html"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                                Add Blog</a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li>
                    <a href="testimonials.html">
                        <i class="ri-star-line text-xl me-14 d-flex w-auto"></i>
                        <span>Testimonial</span>
                    </a>
                </li> --}}
                {{-- <li>
                    <a href="faq.html">
                        <iconify-icon icon="mage:message-question-mark-round" class="menu-icon"></iconify-icon>
                        <span>FAQs</span>
                    </a>
                </li> --}}
                {{-- <li>
                    <a href="error.html">
                        <iconify-icon icon="streamline:straight-face" class="menu-icon"></iconify-icon>
                        <span>404</span>
                    </a>
                </li> --}}
                <li>
                    <a href="{{ url('/')}}">
                        <iconify-icon icon="octicon:info-24" class="menu-icon"></iconify-icon>
                        <span>Return Home</span>
                    </a>
                </li>


            </ul>
        </div>
    </aside>

    <main class="dashboard-main">
        <div class="navbar-header">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <button type="button" class="sidebar-toggle">
                            <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
                            <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
                        </button>
                        <button type="button" class="sidebar-mobile-toggle">
                            <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
                        </button>
                        <form class="navbar-search">
                            <input type="text" name="search" placeholder="Search">
                            <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                        </form>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <button type="button" data-theme-toggle
                            class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"></button>
                        <div class="dropdown d-none d-sm-inline-block">


                        </div>
                        <!-- Language dropdown end -->


                        <!-- Message dropdown end -->


                        <!-- Notification dropdown end -->

                        <div class="dropdown">
                            <button class="d-flex justify-content-center align-items-center rounded-circle"
                                type="button" data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="image"
                                    class="w-40-px h-40-px object-fit-cover rounded-circle">
                            </button>
                            <div class="dropdown-menu to-top dropdown-menu-sm">
                                <div
                                    class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                                    <div>
                                        <h6 class="text-lg text-primary-light fw-semibold mb-2">
                                            {{ Auth::user()->email }}</h6>
                                        <span
                                            class="text-secondary-light fw-medium text-sm">{{ Auth::user()->name }}</span>
                                    </div>
                                    <button type="button" class="hover-text-danger">
                                        <iconify-icon icon="radix-icons:cross-1" class="icon text-xl"></iconify-icon>
                                    </button>
                                </div>
                                <ul class="to-top-list">


                                    <li>
                                        <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3"
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                            <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon> Log
                                            Out</a>


                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Profile dropdown end -->
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-main-body">
            @if (session('success'))
                <div class="alert alert-success bg-success-100 text-success-600 border-success-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8"
                    role="alert">
                    <div class="d-flex align-items-center justify-content-between text-lg">
                        Success
                        <button class="remove-button text-success-600 text-xxl line-height-1"> <iconify-icon
                                icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                    </div>
                    <p class="fw-medium text-success-600 text-sm mt-8">
                        {{ session('success') }}
                    </p>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8"
                    role="alert">
                    <div class="d-flex align-items-center justify-content-between text-lg">
                        Error
                        <button class="remove-button text-danger-600 text-xxl line-height-1"> <iconify-icon
                                icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                    </div>
                    <p class="fw-medium text-danger-600 text-sm mt-8">
                        {{ session('error') }}
                    </p>
                </div>
            @endif

            @yield('content')
        </div>

        <footer class="d-footer">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <p class="mb-0">© <?php echo date('Y'); ?> {{ env('APP_NAME') }}. All Rights Reserved.</p>
                </div>

            </div>
        </footer>
    </main>

    <!-- Bootstrap js -->
    <script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    <!-- Iconify Font js -->
    <script src="{{ asset('assets/js/lib/iconify-icon.min.js') }}"></script>
    <!-- jQuery UI js -->
    <script src="{{ asset('assets/js/lib/jquery-ui.min.js') }}"></script>
    <!-- Vector Map js -->
    <!-- Popup js -->
    <script src="{{ asset('assets/js/lib/magnifc-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/prism.js') }}"></script>

    <!-- main js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    @yield('scripts')
</body>

</html>
