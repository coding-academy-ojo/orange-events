<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard.index') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/brand/orange-is-here-white.png') }}" alt="" class="img-fluid">
            <span class="d-none d-lg-block text-white">OrangeEvents</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn text-white"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false" aria-label="Notifications">
                <i class="bi bi-bell text-light"></i>
                <span class="badge bg-primary badge-number" style="display: none;">0</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications"
                style="max-height: 500px; overflow-y: auto;">
                <li class="dropdown-header">
                    You have 0 new notifications
                    <a href="#" id="markAllAsRead">
                        <span class="badge rounded-pill bg-primary p-2 ms-2">Mark all as read</span>
                    </a>
                </li>
                <div id="loadingSpinner" class="text-center my-2" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <!-- Notification items will be inserted here -->
                <li class="dropdown-footer text-center"></li>
            </ul>


            <!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->



            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0 text-white" href="#"
                    data-bs-toggle="dropdown">
                    @if (Auth::guard('admin')->user()->image_path)
                        <img src="{{ asset('storage') }}/{{ Auth::guard('admin')->user()->image_path }}/{{ Auth::guard('admin')->user()->image }}"
                            alt="Profile" class="rounded-circle">
                    @else
                        <img src="{{ asset('dashboard/assets/img/default-profile.jpg') }}" alt="Profile"
                            class="rounded-circle">
                    @endif
                    <span
                        class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::guard('admin')?->user()?->full_name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::guard('admin')->user()?->full_name }}</h6>
                        <p class="fw-bold">{{ Auth::guard('admin')->user()?->role }}</p>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile') }}">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>

                        <form action="{{ route('logout') }}" method="post" id="logout">
                            @csrf
                            <a class="dropdown-item d-flex align-items-center" type="button"
                                onclick="document.getElementById('logout').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
<script src="{{ asset('assets/js/notifications.js') }}"></script>
