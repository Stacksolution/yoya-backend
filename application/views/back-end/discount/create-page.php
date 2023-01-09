<?php include(__DIR__.'/../common/_header.php'); ?>
<?php include(__DIR__.'/../common/_sidebar.php'); ?>
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <?php include(__DIR__.'/../common/_message.php'); ?>
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">Discount</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Discount Create</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="row mb-4">
                     <div class="col-md-8">
                        <h4 class="card-title">Discount Create</h4>
                     </div>
                     <div class="col-md-4 text-right">
                        <div class="card-footer bg-transparent" style="margin-top: -15px;">
                           <div class="text-center">
                              <a href="<?= site_url('admin/discount') ?>" class="btn btn-outline-dark btn-sm align-middle me-2" title="Pages" style="float: right;">
                              <i class="bx bx-arrow-back"></i> Discount
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?= form_open() ?>
                  <div class="row mb-2 mt-2">
                     <div class="col-md-4">
                        <label>Select Country</label>
                        <div class="input-group" id="country">
                           <?= form_dropdown('country_id',$country,set_value('country_id'),'class="form-control" id="country_id"') ?>
                        </div>
                        <?= form_error('country_id', '<div class="error">', '</div>'); ?>
                     </div>
                     <div class="col-md-4">
                        <label>Select State</label>
                        <div class="input-group" id="state">
                           <?= form_dropdown('state_id',[''=>'--Select State--'],set_value('state_id'),'class="form-control" id="state_id" placeholder="Select State"') ?>
                        </div>
                        <?= form_error('state_id', '<div class="error">', '</div>'); ?>
                     </div>
                     <div class="col-md-4">
                        <label>Select City</label>
                        <div class="input-group" id="city_id">
                           <?= form_dropdown('city_id',[''=>'--Select City--'],set_value('city_id'),'class="form-control" id="city_id" placeholder="Select city" ') ?>
                        </div>
                        <?= form_error('city_id','<div class="error">','</div>'); ?>
                     </div>
                  </div>

                  <hr>
                  <div class="row mb-2 mt-2">
                     <div class="col-md-4">
                        <label>Job Process</label>
                        <div class="input-group" id="discount_job_process_id">
                        <?= form_dropdown('discount_job_process_id',$process,set_value('discount_job_process_id'),'class="form-control"') ?>
                        </div>
                        <?= form_error('discount_job_process_id', '<div class="error">', '</div>'); ?>
                     </div>
                     <div class="col-md-4">
                        <label>Vehicle Type</label>
                        <div class="input-group" id="discount_vehicle_type_id">
                        <?= form_dropdown('discount_vehicle_type_id',$vehicletype,set_value('discount_vehicle_type_id'),'class="form-control"') ?>
                        </div>
                        <?= form_error('discount_vehicle_type_id', '<div class="error">', '</div>'); ?>
                     </div>
                     <div class="col-md-4">
                        <label>Vehicles</label>
                        <div class="input-group" id="state">
                        <?= form_dropdown('discount_vehicle_id',$vehicle,set_value('discount_vehicle_id'),'class="form-control"') ?>
                        </div>
                        <?= form_error('discount_vehicle_id', '<div class="error">', '</div>'); ?>
                     </div>
                  </div>
                  <hr>
                  <div class="row mb-2 mt-2">
                     <div class="col-md-3">
                        <label>Discount Code</label>
                        <div class="input-group" id="fare_base_price">
                           <input type="text" class="form-control" placeholder="Discount code" onkeyup="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');" name="discount_code" value="<?= set_value('discount_code') ?>">
                        </div>
                        <?= form_error('discount_code', '<div class="error">', '</div>'); ?>
                     </div>
                     <div class="col-md-3">
                        <label>Start Date</label>
                        <div class="input-group" id="discount_start_date">
                           <input type="date" class="form-control" placeholder="start date" name="discount_start_date" value="<?= set_value('discount_start_date') ?>">
                        </div>
                        <?= form_error('discount_start_date', '<div class="error">', '</div>'); ?>
                     </div>
                     <div class="col-md-3">
                        <label>End Date</label>
                        <div class="input-group" id="discount_end_date">
                           <input type="date" class="form-control" placeholder="end date" name="discount_end_date" value="<?= set_value('discount_end_date') ?>">
                        </div>
                        <?= form_error('discount_end_date', '<div class="error">', '</div>'); ?>
                     </div>
                     <div class="col-md-3">
                        <label>Discount Type</label>
                        <div class="input-group" id="discount_type">
                           <?php $discount_type = array('flat'=>'Flat Discount','percent'=>'Percentage Discount','cashback'=>'Cashback Discount','freeride'=>'Free Ride'); ?>
                           <?= form_dropdown('discount_type',$discount_type,set_value('discount_type'),'class="form-control" id="discount_type"') ?>
                        </div>
                        <?= form_error('discount_type', '<div class="error">', '</div>'); ?>
                     </div>
                  </div>

                  <hr>
                  <div class="row mb-2 mt-2">
                     <div class="col-md-4">
                        <label>Discount</label>
                        <div class="input-group" id="discount_amount">
                           <input type="text" class="form-control" placeholder="Discount" name="discount_amount" value="<?= set_value('discount_amount') ?>">
                           <div class="input-group-prepend">
                              <span class="input-group-text" id="discounttype">Flat Discount</span>
                           </div>
                        </div>
                        <small><b class="text-danger">Note:</b>Please enter amount here for discount</small>
                        <?= form_error('discount_amount', '<div class="error">', '</div>'); ?>
                     </div>
                     <div class="col-md-4">
                        <label>MaxDiscount</label>
                        <div class="input-group" id="discount_max_amount">
                           <input type="text" class="form-control" placeholder="MaxDiscount" name="discount_max_amount" value="<?= set_value('discount_max_amount') ?>">
                           <div class="input-group-prepend">
                              <span class="input-group-text">Max Discount</span>
                           </div>
                        </div>
                        <small><b class="text-danger">Note:</b>Please enter amount here for discount</small>
                        <?= form_error('discount_max_amount', '<div class="error">', '</div>'); ?>
                     </div>
                     <div class="col-md-4">
                        <label>User Use Limit</label>
                        <div class="input-group" id="discount_user_uses_at_time">
                           <input type="number" class="form-control" placeholder="User Use Limit" name="discount_user_uses_at_time" value="<?= set_value('discount_user_uses_at_time') ?>">
                        </div>
                        <small><b class="text-danger">Note:</b> That means user this code use limit. <b>Default limit a user use code one time only !</b></small>
                        <?= form_error('discount_user_uses_at_time', '<div class="error">', '</div>'); ?>
                     </div>
                  </div>
                  <hr>
                  <div class="col-md-12">
                     <label>Discount Description</label>
                     <div class="input-group" id="fare_base_price">
                        <textarea  class="form-control" placeholder="dicount description" name="discount_description" value="<?= set_value('discount_description') ?>"> </textarea>
                     </div>
                     <?= form_error('discount_description', '<div class="error">', '</div>'); ?>
                  </div>
                  <div class="row mt-4">
                     <div class="col-md-6">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                        <i class="bx bx-save font-size-16 align-middle me-2"></i>submit
                        </button>
                     </div>
                  </div>
                  <?= form_close() ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include(__DIR__.'/../common/_footer.php'); ?>
<?php include(__DIR__.'/../common/_get_dependent_location.php'); ?>
<script>
   $(document).on('change','#discount_type',function(){
      var selectedText = $(this).find("option:selected").text();
      $('#discounttype').text(selectedText);
   })
</script>