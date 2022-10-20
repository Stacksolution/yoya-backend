<?php include(__DIR__.'/common/_header.php'); ?>
<?php include(__DIR__.'/common/_sidebar.php'); ?>
   <div class="page-content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-13">
               <div class="row">
                  <div class="col-md-3">
                     <div class="card mini-stats-wid">
                        <div class="card-body">
                           <div class="d-flex">
                              <div class="flex-grow-1">
                                 <p class="text-muted fw-medium">Users</p>
                                 <h4 class="mb-0">0</h4>
                              </div>
                              <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                 <span class="avatar-title">
                                 <i class="bx bx-copy-alt font-size-24"></i>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card mini-stats-wid">
                        <div class="card-body">
                           <div class="d-flex">
                              <div class="flex-grow-1">
                                 <p class="text-muted fw-medium">Drivers</p>
                                 <h4 class="mb-0">0</h4>
                              </div>
                              <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                 <span class="avatar-title rounded-circle bg-primary">
                                 <i class="bx bx-archive-in font-size-24"></i>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card mini-stats-wid">
                        <div class="card-body">
                           <div class="d-flex">
                              <div class="flex-grow-1">
                                 <p class="text-muted fw-medium">Bookings</p>
                                 <h4 class="mb-0">0</h4>
                              </div>
                              <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                 <span class="avatar-title rounded-circle bg-primary">
                                 <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card mini-stats-wid">
                        <div class="card-body">
                           <div class="d-flex">
                              <div class="flex-grow-1">
                                 <p class="text-muted fw-medium">Bookings</p>
                                 <h4 class="mb-0">0</h4>
                              </div>
                              <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                 <span class="avatar-title rounded-circle bg-primary">
                                 <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Pie Chart</h4>
                        <div id="pie-chart" class="e-charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Pie Chart</h4>
                        <div id="pie-chart" class="e-charts"></div>
                    </div>
                </div>
            </div>
         </div>
      </div>
   </div>
<?php include(__DIR__.'/common/_footer.php'); ?>
<script src="<?= base_url('back-end') ?>/js/pages/dashboard.init.js"></script>
<script src="<?= base_url('back-end') ?>/libs/echarts/echarts.min.js"></script>
