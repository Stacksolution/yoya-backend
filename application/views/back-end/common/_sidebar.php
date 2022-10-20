<div class="vertical-menu">
   <div data-simplebar class="h-100">
      <!--- Sidemenu -->
      <div id="sidebar-menu">
         <!-- Left Menu Start -->
         <ul class="metismenu list-unstyled" id="side-menu">
            <li>
               <a href="<?= base_url('admin/dashboard') ?>" class="waves-effect">
               <i class="bx bx-home-circle"></i>
               <span key="t-dashboards">Dashboards</span>
               </a>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow waves-effect">
               <i class="bx bxs-user"></i>
               <span key="t-customer"><span>Manage Customers</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="<?= site_url('admin/customer') ?>" key="t-customer">Customers</a></li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow waves-effect">
               <i class="bx bxs-group"></i>
               <span key="t-drivers"><span>Manage Drivers</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="<?= site_url('admin/drivers') ?>" key="t-drivers">Drivers</a></li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow waves-effect">
               <i class="bx bxl-redux"></i>
               <span key="t-booking"><span>Manage Bookings</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="<?= site_url('admin/booking') ?>" key="t-booking">Booking</a></li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow waves-effect">
               <i class="bx bxs-truck"></i>
               <span key="t-vehicle"><span>Manage Vehicles </span>
               </a>
               <ul class="sub-menu"Vehicle aria-expanded="false">
                  <li><a href="<?= site_url('admin/vehicletype') ?>" key="t-vehicletype">Vehicles type</a></li>
                  <li><a href="<?= site_url('admin/vehicle') ?>" key="t-vehicle">Vehicles</a></li>
                  <li><a href="<?= site_url('admin/vehiclefare') ?>" key="t-vehicle">Vehicles Fare</a></li>
                  <li><a href="<?= site_url('admin/packagefare') ?>" key="t-vehicle">Package Fare</a></li>
                  <li><a href="<?= site_url('admin/rental') ?>" key="t-vehicle">Rental Fare</a></li>
                  <li><a href="<?= site_url('admin/') ?>" key="t-vehicle">Outstation Fare</a></li>
                  <li><a href="<?= site_url('admin/transport') ?>" key="t-vehicle">Transport Fare</a></li>
               </ul>
            </li>
             <li>
               <a href="javascript: void(0);" class="has-arrow waves-effect">
               <i class="bx bx-search-alt"></i>
               <span key="t-search"><span>Recently Searched</span>
               </a>
               <ul class="sub-menu"Vehicle aria-expanded="false">
                  <li><a href="<?= site_url('admin/recentsearch') ?>" key="t-search">All Request</a></li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow waves-effect">
               <i class="bx bx-briefcase"></i>
               <span key="t-process"><span>Manage Job Process</span>
               </a>
               <ul class="sub-menu"Vehicle aria-expanded="false">
                  <li><a href="<?= site_url('admin/jobprocess') ?>" key="t-process">Job Process</a></li>
                  <li><a href="<?= site_url('admin/jobprocesscites') ?>" key="t-process">Job Process cites</a></li>
                  <li><a href="<?= site_url('admin/Jobprocessvehicle') ?>" key="t-process">Job Process vehicle</a></li>
               </ul>
            </li>
              <li>
               <a href="javascript: void(0);" class="has-arrow waves-effect">
               <i class="bx bx-collection"></i>
               <span key="t-discount"><span>Discount Management</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="<?= site_url('admin/discount') ?>" key="t-discount">Discount Code</a></li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow waves-effect">
               <i class="bx bx-cog"></i>
               <span key="t-system"><span>System configuration</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="<?= site_url('admin/setting') ?>" key="t-system">Admin Setting</a></li>
                  <li><a href="<?= site_url('admin/setting/google') ?>" key="t-system">App Setting</a></li>
                  <li><a href="<?= site_url('admin/page') ?>" key="t-system">Content Pages</a></li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow waves-effect">
               <i class="bx bxs-map-pin"></i>
               <span key="t-states"><span>Manage Location</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="<?= site_url('admin/countrys') ?>" key="t-states">Countrys</a></li>
                  <li><a href="<?= site_url('admin/states') ?>" key="t-states">States</a></li>
                  <li><a href="<?= site_url('admin/citys') ?>" key="t-city">Citys</a></li>
               </ul>
            </li>
         </ul>
      </div>
   </div>
</div>
<div class="main-content">