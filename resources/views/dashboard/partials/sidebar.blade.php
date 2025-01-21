<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link @yield('dashboard_activation')" href="{{ route('dashboard.index') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link @yield('events_activation')" href="{{ route('event.index') }}">
        <i class="bi bi-calendar-event"></i>
        <span>Events Management</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link @yield('attendees_activation')" href="{{ route('attendee.all') }}">
        <i class="bi bi-people"></i>
        <span>All Attendees</span>
      </a>
    </li>

    @if (Auth::guard('admin')->user()->role == "super_admin")
      <li class="nav-item">
        <a class="nav-link @yield('admins_activation')" href="{{ route('admin.index') }}">
          <i class="bi bi-person-gear"></i>
          <span>Admins Management</span>
        </a>
      </li>
    @endif

  </ul>

</aside><!-- End Sidebar-->