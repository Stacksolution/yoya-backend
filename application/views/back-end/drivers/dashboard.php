<?php include(__DIR__.'/../common/_header.php'); ?>
<?php include(__DIR__.'/../common/_sidebar.php'); ?>
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">Scrollable</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Scrollable</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
      <div class="row">
      
         <!--<div class="col-md-12">-->
         <!--   <div class="alert alert-danger alert-dismissible fade show" role="alert">-->
         <!--      <i class="mdi mdi-block-helper me-2"></i>-->
         <!--      Your KYC Verification Still pending after upload your documents and wait some time for KYC update Process !-->
         <!--      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>-->
         <!--   </div>-->
         <!--</div>-->
         <div class="col-xl-4">
            <div class="card overflow-hidden">
               <div class="bg-primary bg-soft">
                  <div class="row">
                     <div class="col-7">
                        <div class="text-primary p-3">
                           <h5 class="text-primary"> Welcome Back <?= $drivers->user_name ?> !</h5>
                           <p> <?= $drivers->user_name ?> Dashboard</p>
                        </div>
                     </div>
                     <div class="col-5 align-self-end">
                        <img src="<?= base_url('back-end') ?>/images/profile-img.png" alt="" class="img-fluid">
                     </div>
                  </div>
               </div>
               <div class="card-body pt-0">
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="avatar-md profile-user-wid mb-4">
                           <img src="<?= base_url('back-end') ?>/images/users/avatar-1.jpg" alt="" class="img-thumbnail rounded-circle">
                        </div>
                        <h5 class="font-size-15 text-truncate"><?= $drivers->user_name ?></h5>
                        <p class="text-muted mb-0 text-truncate"><?= $drivers->user_type ?></p>
                     </div>
                     <div class="col-sm-8">
                        <div class="pt-4">
                           <div class="mt-4">
                              <a href="<?= site_url('admin/drivers/document/'.$drivers->user_id) ?>" class="btn btn-primary waves-effect waves-light btn-sm">Check Kyc<i class="mdi mdi-arrow-right ms-1"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-8">
               <div class="row">
                  <div class="col-md-4">
                     <div class="card mini-stats-wid">
                        <div class="card-body">
                           <div class="d-flex">
                              <div class="flex-grow-1">
                                 <p class="text-muted fw-medium">Orders</p>
                                 <h4 class="mb-0">1,235</h4>
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
                  <div class="col-md-4">
                     <div class="card mini-stats-wid">
                        <div class="card-body">
                           <div class="d-flex">
                              <div class="flex-grow-1">
                                 <p class="text-muted fw-medium">Revenue</p>
                                 <h4 class="mb-0">$35, 723</h4>
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
                  <div class="col-md-4">
                     <div class="card mini-stats-wid">
                        <div class="card-body">
                           <div class="d-flex">
                              <div class="flex-grow-1">
                                 <p class="text-muted fw-medium">Average Price</p>
                                 <h4 class="mb-0">$16.2</h4>
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
                   <div class="col-md-4">
                     <div class="card mini-stats-wid">
                        <div class="card-body">
                           <div class="d-flex">
                              <div class="flex-grow-1">
                                 <p class="text-muted fw-medium">Orders</p>
                                 <h4 class="mb-0">1,235</h4>
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
                  <div class="col-md-4">
                     <div class="card mini-stats-wid">
                        <div class="card-body">
                           <div class="d-flex">
                              <div class="flex-grow-1">
                                 <p class="text-muted fw-medium">Revenue</p>
                                 <h4 class="mb-0">$35, 723</h4>
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
                  <div class="col-md-4">
                     <div class="card mini-stats-wid">
                        <div class="card-body">
                           <div class="d-flex">
                              <div class="flex-grow-1">
                                 <p class="text-muted fw-medium">Average Price</p>
                                 <h4 class="mb-0">$16.2</h4>
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
               <!-- end row -->
            </div>
      </div>
      <div class="col-xl-12">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title"><?= $drivers->user_name ?> Transaction And details</h4>
               <!-- Nav tabs -->
               <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" data-bs-toggle="tab" href="#wallet" role="tab">
                     <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                     <span class="d-none d-sm-block">Wallet</span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-bs-toggle="tab" href="#booking" role="tab">
                     <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                     <span class="d-none d-sm-block">Booking</span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-bs-toggle="tab" href="#bookingrequest" role="tab">
                     <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                     <span class="d-none d-sm-block">Booking Request</span>
                     </a>
                  </li>
               </ul>
               <!-- Tab panes -->
               <div class="tab-content p-3 text-muted">
                  <div class="tab-pane active" id="wallet" role="tabpanel">
                     <div class="col-12">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                           <thead>
                              <tr>
                                <th class="align-middle">Sr.</th>
                                <th class="align-middle">Symbol</th>
                                <th class="align-middle">Currency rate</th>
                                <th class="align-middle">Amount</th>
                                <th class="align-middle">Credit/Debit</th>
                              </tr>
                           </thead>
                           <!--<tbody>-->
                           <!--    <?php foreach($transactions->result() as $key => $data) { ?>-->
                           <!--      <tr>-->
                           <!--         <td><a href="javascript: void(0);" class="text-body fw-bold">#<?= $key + 1 ?></a> </td>-->
                           <!--         <td><?= $data->transaction_symbol ?></td>-->
                           <!--         <td><?= $data->transaction_currency_rate ?></td>-->
                           <!--         <td><?= $data->transaction_amount ?></td>-->
                           <!--         <td>-->
                           <!--          <?php if($data->transaction_types == 1){ ?>-->
                           <!--          <span class="badge badge-pill badge-soft-success font-size-11">Credit</span>-->
                           <!--          <?php } ?>-->
                           <!--          <?php if($data->transaction_types == 0){ ?>-->
                           <!--          <span class="badge badge-pill badge-soft-warning font-size-11">Debit</span>-->
                           <!--           <?php } ?>-->
                           <!--         </td>-->
                           <!--      </tr>-->
                           <!--      <?php } ?>-->
                           <!--</tbody>-->
                        </table>
                     </div>
                  </div>
                  <div class="tab-pane" id="booking" role="tabpanel">
                     <div class="col-12">
                        <table id="datatable-button" class="table table-bordered dt-responsive nowrap w-100">
                           <thead>
                              <tr>
                                 <th>Sr#</th>
                                 <th>Symbol</th>
                                 <th>Amount</th>
                                 <th>Date</th>
                                 <th>Status</th>
                                 <th>Hash</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <!--<tbody>-->
                           <!--   <?php foreach($diposits->result() as $key => $data) { ?>-->
                           <!--   <tr>-->
                           <!--      <td><?= $key + 1 ?></td>-->
                           <!--      <td><?= $data->deposit_currency_symbol ?></td>-->
                           <!--      <td><?= $data->deposit_amount ?></td>-->
                           <!--      <td><?= $data->deposit_create_at ?></td>-->
                           <!--      <?php if($data->deposit_status == '1'){ ?>-->
                           <!--      <td class="badge"><span class="badge badge-pill badge-soft-success font-size-11">Approved</span></td>-->
                           <!--      <?php }else{ ?>-->
                           <!--      <td class="badge"><span class="badge badge-pill badge-soft-danger font-size-11">Pending</span></td>-->
                           <!--      <?php } ?>-->
                           <!--      <td><?= $data->deposit_hash ?></td>-->
                           <!--      <td><input type="checkbox" class="deposit-status" data-id="<?= $data->deposit_id ?>"  <?= $data->deposit_status =="1" ? "checked disabled" : "" ?> id="buysale<?= $key + 1 ?>" switch="info"/>-->
                           <!--      <label for="buysale<?= $key + 1 ?>" data-on-label="Yes" data-off-label="No"></label></td>-->
                           <!--   </tr>-->
                           <!--   <?php } ?>-->
                           <!--</tbody>-->
                        </table>
                     </div>
                  </div>
                  <div class="tab-pane" id="bookingrequest" role="tabpanel">
                     <div class="col-12">
                        <table id="datatable-buttond" class="table table-bordered dt-responsive nowrap w-100">
                           <thead>
                              <tr>
                                 <th>Sr#</th>
                                 <th>Symbol</th>
                                 <th>Amount</th>
                                 <th>Date</th>
                                 <th>Status</th>
                                 <th>Hash</th>
                                 <th>Action</th>
                                 <th>Action Status</th>
                              </tr>
                           </thead>
                           <!--<tbody>-->
                           <!--   <?php foreach($withdraw->result() as $key => $data) { ?>-->
                           <!--   <tr>-->
                           <!--      <td><?= $key + 1 ?></td>-->
                           <!--      <td><?= $data->withdraw_currency_symbol ?></td>-->
                           <!--      <td><?= $data->withdraw_amount ?></td>-->
                           <!--      <td><?= $data->withdraw_create_at ?></td>-->
                           <!--      <?php if($data->withdraw_status == '1'){ ?>-->
                           <!--      <td class="badge"><span class="badge badge-pill badge-soft-success font-size-11">Approved</span></td>-->
                           <!--      <?php }else{ ?>-->
                           <!--      <td class="badge"><span class="badge badge-pill badge-soft-danger font-size-11">Pending</span></td>-->
                           <!--      <?php } ?>-->
                           <!--      <td><?= $data->withdraw_hash ?></td>-->
                           <!--      <td>-->
                           <!--      <a href="<?= site_url('admin/customer/withdraw/'.$data->withdraw_id) ?>" class="btn btn-outline-secondary btn-sm"><i class="mdi mdi-pencil font-size-13"></i></a></td>-->
                           <!--     <td> <?php if($data->withdraw_hash !="" ){ ?><input type="checkbox" class="withdraw-status" data-id="<?= $data->withdraw_id ?>"  <?= $data->withdraw_status =="1" ? "checked disabled" : "" ?> id="withdraw<?= $key + 1 ?>" switch="info"/>-->
                           <!--      <label for="withdraw<?= $key + 1 ?>" data-on-label="Yes" data-off-label="No"></label> <?php }else{ ?> <span class="badge badge-pill badge-soft-danger font-size-11">Pending Hash</span <?php } ?></td>-->
                           <!--   </tr>-->
                           <!--   <?php } ?>-->
                           <!--</tbody>-->
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<!-- End Page-content -->
<?php include(__DIR__.'/../common/_footer.php'); ?>
<script src="<?= base_url('back-end/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('back-end/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<!-- Buttons examples -->
<script src="<?= base_url('back-end/libs/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('back-end/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('back-end/libs/jszip/jszip.min.js') ?>"></script>
<script src="<?= base_url('back-end/libs/pdfmake/build/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('back-end/libs/pdfmake/build/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('back-end/libs/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('back-end/libs/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('back-end/libs/datatables.net-buttons/js/buttons.colVis.min.js') ?>"></script>
<!-- Datatable init js -->
<script src="<?= base_url('back-end/js/pages/datatables.init.js') ?>"></script>
<script type="text/javascript">
   /*for currency active*/
   $(document).on('change','.deposit-status',function(){
    var _this = $(this),_data_id,_data_status;
    _data_id = _this.data('id');
    
    _data_status = '0';
        if (_this.prop('checked') == true){ 
            _this.prop('disabled', true);
           _data_status = '1';
           _this.closest('tr').find('td .badge').html('<span class="badge badge-pill badge-soft-success font-size-11">Approved</span>');
        }else{
            _this.closest('tr').find('td .badge').html('<span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>');
        }

      $.ajax({
        method: "POST",
        url: "<?= base_url('admin/customer/deposit_status') ?>",
        data: { deposit_id: _data_id, status: _data_status }
      }).done(function(response) {
         console.log(response);
      }).fail(function(errors){
         console.log(errors);
      });
   })
   
   
    $(document).on('change','.withdraw-status',function(){
    var _this = $(this),_data_id,_data_status;
    _data_id = _this.data('id');
    
    _data_status = '0';
        if (_this.prop('checked') == true){ 
            _this.prop('disabled', true);
           _data_status = '1';
           _this.closest('tr').find('td .badge').html('<span class="badge badge-pill badge-soft-success font-size-11">Approved</span>');
        }else{
            _this.closest('tr').find('td .badge').html('<span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>');
        }

      $.ajax({
        method: "POST",
        url: "<?= base_url('admin/customer/withdraw_status') ?>",
        data: { withdraw_id: _data_id, status: _data_status }
      }).done(function(response) {
         console.log(response);
      }).fail(function(errors){
         console.log(errors);
      });
   })

</script>

