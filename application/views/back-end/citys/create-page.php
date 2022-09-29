<?php include(__DIR__.'/../common/_header.php'); ?>
<?php include(__DIR__.'/../common/_sidebar.php'); ?>
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <?php include(__DIR__.'/../common/_message.php'); ?>
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">Citys</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Citys Create</li>
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
                        <h4 class="card-title">Citys Create</h4>
                     </div>
                     <div class="col-md-4 text-right">
                        <div class="card-footer bg-transparent" style="margin-top: -15px;">
                           <div class="text-center">
                              <a href="<?= site_url('admin/citys') ?>" class="btn btn-outline-dark btn-sm align-middle me-2" title="Citys" style="float: right;">
                              <i class="bx bx-arrow-back"></i> citys
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                   <?= form_open() ?>
                     <div class="row mb-2 mt-2">
                           <div class="col-md-6">
                           <label>Select Country</label>
                           <div class="input-group" id="Country">
                              <?= form_dropdown('country_id',$country,set_value('country_id'),'class="form-control" id="country_id"') ?>
                          </div>
                           <?= form_error('country_id', '<div class="error">', '</div>'); ?>
                          </div>
                            <div class="col-md-6">
                           <label>Select State</label>
                           <div class="input-group" id="state_id">
                              <?= form_dropdown('state_id','',set_value('state_id'),'class="form-control" id="state_id"') ?>
                          </div>
                           <?= form_error('state_id', '<div class="error">', '</div>'); ?>
                          </div>
                           </div>
                          <div class="col-md-12">
                           <label>City Name</label>
                           <div class="input-group" id="name">
                              <input type="text" class="form-control" placeholder="City name" name="city_name" value="<?= set_value('city_name') ?>">
                              <span class="input-group-text"><i class="bx bx-user"></i></span>
                           </div>
                           <?= form_error('city_name','<div class="error">', '</div>'); ?>
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
   <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?php include(__DIR__.'/../common/_footer.php'); ?>
<script> CKEDITOR.replace( 'page_description' ); </script>
<script src="<?= base_url('back-end') ?>/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url('back-end') ?>/js/pages/form-advanced.init.js"></script>
<script src="<?= base_url('back-end') ?>/libs/simplebar/simplebar.min.js"></script>
<script>
// get state 
$(document).on('change', 'select#country_id', function (e) {
    e.preventDefault();
    var CountryID = $(this).val();
    getstatelist(CountryID);
});
function getstatelist(CountryID) {
    $.ajax({
        url:  "<?= base_url("admin/citys/getState") ?>",
        type: 'POST',
        data: {CountryID: CountryID},
        dataType: 'json',
        beforeSend: function (){
            $('select#state_id').find("option:eq(0)").html("Please wait..");
        },
        success: function (json){
            var options = '';
            options +='<option value="">Select State</option>';
            for (var i = 0; i < json.length; i++) {
                options += '<option value="' + json[i].state_id + '">' + json[i].state_name + '</option>';
            }
            $("select#state_id").html(options);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}
</script>


