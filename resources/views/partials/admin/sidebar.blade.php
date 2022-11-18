<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="/admin/dashboard">
       <h3>LOGO</h3> 
      </a>
    </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/dashboard') || request()->is('admin/dashboard/*') ? 'active' : '' }}" href="/admin/dashboard">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-house text-danger text-sm"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/students') || request()->is('admin/students/*') ? 'active' : '' }}" href="/admin/students">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-list text-danger text-sm"></i>
          </div>
          <span class="nav-link-text ms-1">Manage Students</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/attendance') || request()->is('admin/attendance/*') ? 'active' : '' }}" href="/admin/attendance">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-list text-danger text-sm"></i>
          </div>
          <span class="nav-link-text ms-1">Manage Attendance</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/finder_student') || request()->is('admin/finder_student/*') ? 'active' : '' }}" href="/admin/finder_student">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-magnifying-glass text-danger  text-sm"></i>
          </div>
          <span class="nav-link-text  ms-1">Student Finder</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/attendance_records') || request()->is('admin/attendance_records/*') ? 'active' : '' }}" href="/admin/attendance_records/daily">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-list text-danger text-sm"></i>
          </div>
          <span class="nav-link-text  ms-1">Attendance Records</span>
        </a>
      </li>
      @can('admin_access')
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin/admins') ? 'active' : '' }}" href="/admin/admins">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Administrator</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin/staffs') ? 'active' : '' }}" href="/admin/staffs">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Teachers</span>
          </a>
        </li>
      @endcan
    </ul>
  </div>

</aside>