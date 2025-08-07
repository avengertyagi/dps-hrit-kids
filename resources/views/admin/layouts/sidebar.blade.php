 <div class="leftside-menu">
     <!-- Brand Logo Light -->
     <a href="{{ route('admission.index') }}" class="logo logo-light">
         <span class="logo-lg">
             <img src="{{ asset('assets/frontend/img/logo.png') }}" height="100px" width="100px" alt="logo">
         </span>
         <span class="logo-sm">
             <img src="{{ asset('assets/frontend/img/logo.png') }}" height="100px"width="100px"alt="small logo">
         </span>
     </a>
     <!-- Brand Logo Dark -->
     <a href="{{ route('admission.index') }}" class="logo logo-dark">
         <span class="logo-lg">
             <img src="{{ asset('assets/backend/images/logo-dark.png') }}" alt="dark logo">
         </span>
         <span class="logo-sm">
             <img src="{{ asset('assets/backend/images/logo-sm.png') }}" alt="small logo">
         </span>
     </a>
     <!-- Sidebar -left -->
     <div class="h-100" id="leftside-menu-container" data-simplebar>
         <!--- Sidemenu -->
         <ul class="side-nav">
             {{-- <li class="side-nav-title">Dashboard</li>
             <li class="side-nav-item">
                 <a href="{{ route('dashboard') }}"
                     class="side-nav-link {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                     <i class="ri-dashboard-3-line"></i>
                     <span> Dashboard </span>
                 </a>
             </li> --}}
             <li class="side-nav-title">Admission</li>
             <li class="side-nav-item">
                 <a href="{{ route('admission.index') }}"
                     class="side-nav-link {{ Request::segment(2) == 'admission' ? 'active' : '' }}">
                     <i class="ri-school-line"></i>
                     <span>Admission</span>
                 </a>
             </li>
             <li class="side-nav-title">Banner</li>
             <li class="side-nav-item">
                 <a href="{{ route('banners.index') }}"
                     class="side-nav-link {{ Request::segment(2) == 'banners' ? 'active' : '' }}">
                     <i class="ri-image-line"></i>
                     <span>Banner</span>
                 </a>
             </li>
             <li class="side-nav-title">Gallery</li>
             <li
                 class="side-nav-item {{ in_array(Request::segment(2), ['photos', 'videos']) ? 'menuitem-active' : '' }}">
                 <a data-bs-toggle="collapse" href="#gallery" aria-expanded="false" aria-controls="sidebarPages"
                     class="side-nav-link">
                     <i class="ri-gallery-upload-line"></i>
                     <span> Gallery </span>
                     <span class="menu-arrow"></span>
                 </a>
                 <div class="collapse {{ in_array(Request::segment(2), ['photos', 'videos']) ? 'show' : '' }}"
                     id="gallery">
                     <ul class="side-nav-second-level">
                         <li class="{{ in_array(Request::segment(2), ['photos']) ? 'menuitem-active' : '' }}">
                             <a class="{{ in_array(Request::segment(2), ['photos']) ? 'active' : '' }}"
                                 href="{{ route('photos.index') }}">Photos</a>
                         </li>
                         <li class="{{ in_array(Request::segment(2), ['videos']) ? 'menuitem-active' : '' }}">
                             <a class="{{ in_array(Request::segment(2), ['videos']) ? 'active' : '' }}"
                                 href="{{ route('videos.index') }}">Videos</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="side-nav-title">Pages</li>
             <li
                 class="side-nav-item {{ in_array(Request::segment(2), ['pages', 'page-sections']) ? 'menuitem-active' : '' }}">
                 <a data-bs-toggle="collapse" href="#pages" aria-expanded="false" aria-controls="sidebarPages"
                     class="side-nav-link">
                     <i class="ri-gallery-upload-line"></i>
                     <span> Pages </span>
                     <span class="menu-arrow"></span>
                 </a>
                 <div class="collapse {{ in_array(Request::segment(2), ['pages', 'page-sections']) ? 'show' : '' }}"
                     id="pages">
                     <ul class="side-nav-second-level">
                         <li class="{{ in_array(Request::segment(2), ['pages']) ? 'menuitem-active' : '' }}">
                             <a class="{{ in_array(Request::segment(2), ['pages']) ? 'active' : '' }}"
                                 href="{{ route('pages.index') }}">Page</a>
                         </li>
                         <li class="{{ in_array(Request::segment(2), ['page-sections']) ? 'menuitem-active' : '' }}">
                             <a class="{{ in_array(Request::segment(2), ['page-sections']) ? 'active' : '' }}"
                                 href="{{ route('page-sections.index') }}">Page Section</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="side-nav-title">Media</li>
             <li class="side-nav-item">
                 <a href="{{ route('media.index') }}"
                     class="side-nav-link {{ Request::segment(2) == 'media' ? 'active' : '' }}">
                     <i class="ri-image-line"></i>
                     <span>Media</span>
                 </a>
             </li>
             <li class="side-nav-title">Settings</li>
             <li class="side-nav-item">
                 <a href="{{ route('settings.index') }}"
                     class="side-nav-link {{ Request::segment(2) == 'settings' ? 'active' : '' }}">
                     <i class="ri-settings-5-line"></i>
                     <span>Settings</span>
                 </a>
             </li>
         </ul>
         <div class="clearfix"></div>
     </div>
 </div>
