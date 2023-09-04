<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{url('/')}}/dashbord">
        <img src="{{asset('assets/img/logo-ct.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Asha Properties</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="{{url('/')}}/dashbord">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
    
        <li class="nav-item">
          <a class="nav-link text-white @if(Request::segment(1)=='manage_property_type' || Request::segment(1)=='add_property_type' || Request::segment(1)=='edit_property_type' || Request::segment(1)=='view_property_type') active @endif" href="{{url('/')}}/manage_property_type">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Property Type</span>
          </a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link text-white @if(Request::segment(1)=='manage_projects' || Request::segment(1)=='add_projects' || Request::segment(1)=='edit_projects' || Request::segment(1)=='view_projects') active @endif" href="{{url('/')}}/manage_projects">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Projects</span>
          </a>
        </li>

        {{-- <li class="nav-item">
          <a class="nav-link text-white @if(Request::segment(1)=='manage_layouts' || Request::segment(1)=='add_layouts' || Request::segment(1)=='edit_layouts' || Request::segment(1)=='view_layouts') active @endif"  href="{{url('/')}}/manage_layouts">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Layouts</span>
          </a>
        </li>
        --}}
        <li class="nav-item">
          <a class="nav-link text-white @if(Request::segment(1)=='manage_aboutus' || Request::segment(1)=='add_aboutus' || Request::segment(1)=='edit_aboutus' || Request::segment(1)=='view_aboutus') active @endif" href="{{url('/')}}/manage_aboutus">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">About Us</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white  @if(Request::segment(1)=='manage_contactdetails' || Request::segment(1)=='add_contactdetails' || Request::segment(1)=='edit_contactdetails' || Request::segment(1)=='view_contactdetails') active @endif" href="{{url('/')}}/manage_contactdetails">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Company Contact Details</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white @if(Request::segment(1)=='manage_socialmedialinks' || Request::segment(1)=='add_socialmedialinks' || Request::segment(1)=='edit_socialmedialinks' || Request::segment(1)=='view_socialmedialinks') active @endif" href="{{url('/')}}/manage_socialmedialinks">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Social Media Links</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white @if(Request::segment(1)=='manage_newsletter' || Request::segment(1)=='add_newsletter' || Request::segment(1)=='edit_newsletter' || Request::segment(1)=='view_newsletter') active @endif" href="{{url('/')}}/manage_newsletter">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Newsletter List</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white @if(Request::segment(1)=='manage_review' || Request::segment(1)=='add_review' || Request::segment(1)=='edit_review' || Request::segment(1)=='view_review') active @endif" href="{{url('/')}}/manage_review">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Review</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white @if(Request::segment(1)=='manage_counts' || Request::segment(1)=='add_counts' || Request::segment(1)=='edit_counts' || Request::segment(1)=='view_counts') active @endif" href="{{url('/')}}/manage_counts">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Count Master</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white @if(Request::segment(1)=='manage_getintouch' || Request::segment(1)=='add_getintouch' || Request::segment(1)=='edit_getintouch' || Request::segment(1)=='view_getintouch') active @endif" href="{{url('/')}}/manage_getintouch">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Get In Touch</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>