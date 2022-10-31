<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="/admin/dashboard">
          Dashboard
        </a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">
        @if(request()->is('admin/dashboard'))
          Dashboard
        @elseif(request()->is('admin/residents'))
          Manage Residents
        @elseif(request()->is('admin/request_document/*'))
          Request Docuement
        @elseif(request()->is('admin/requested_document'))
          Requested Docuement
        @elseif(request()->is('admin/finder_resident/*'))
          Resident Finder
        @elseif(request()->is('admin/finder_resident/*'))
          Resident Finder
        @elseif(request()->is('admin/documents'))
          Manage Documents
        @elseif(request()->is('admin/admins'))
          Manage Administrator
        @elseif(request()->is('admin/staffs'))
          Manage Staffs
        @elseif(request()->is('admin/activity_logs'))
          Activity Logs
        @endif 
        </li>
      </ol>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        
      </div>
      <ul class="navbar-nav  justify-content-end">
    
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
            </div>
          </a>
        </li>
        <li class="nav-item px-3 d-flex align-items-center">
          
        </li>
        <li class="nav-item dropdown pe-2 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-user me-sm-1"></i>
              <span class="d-sm-inline d-none text-uppercase">{{auth()->user()->name}}</span>
            <i class="fa-solid fa-angle-down"></i>
          </a>
        
          <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
            <li class="">
              <a class="dropdown-item border-radius-md" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <div class="d-flex py-1">
                  <div class="my-auto">
                    <i class="fa-solid fa-arrow-right-from-bracket me-3"></i>
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="text-sm font-weight-normal mb-1">
                      <span class="font-weight-bold text-dark">LOGOUT</span>
                    </h6>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>