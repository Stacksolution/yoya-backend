<?php include(__DIR__.'/../common/_header.php'); ?>
<?php include(__DIR__.'/../common/_sidebar.php'); ?>
<!-- page wise css -->
<link href="<?= base_url('back-end') ?>/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?= base_url('back-end') ?>/libs/%40chenfengyuan/datepicker/datepicker.min.css">
<!-- page wise css -->
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">Documents Required</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Documents Required</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <?php include(__DIR__.'/../common/_message.php'); ?>
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="row mb-4">
                    <div class="col-md-8">
                        <h4 class="card-title">Documents Required</h4>
                    </div>
                     <div class="col-md-4 text-right">
                        <div class="card-footer bg-transparent" style="margin-top: -15px;">
                            <div class="text-center">
                                <a href="<?= site_url('admin/documentrequire/create') ?>" class="btn btn-outline-success btn-sm align-middle me-2" title="New Pages" style="float: right;">
                                    <i class="fas fa-plus"></i> New Documents
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                  <div class="table-responsive">
                     <table class="table align-middle table-nowrap table-check">
                        <thead class="table-light">
                           <tr>
                              <th class="align-middle">Sr.</th>
                              <th class="align-middle">Document label</th>
                              <th class="align-middle">Document Placeholder</th>
                              <th class="align-middle">Document Description</th>
                              <th class="align-middle">Document Minimum char</th>
                              <th class="align-middle">Document Maximum char</th>
                              <th class="align-middle">Country</th>
                              <th class="align-middle">Action</th>
                           </tr>
                        </thead>
                        <tbody>  
                           <?php foreach($documents->result() as $key => $data) { ?>
                           <tr>
                              <td><a href="javascript: void(0);" class="text-body fw-bold">#<?= $key + 1 ?></a> </td>
                              <td><?= $data->document_label ?></td>
                              <td><?= $data->document_placeholder ?></td>
                              <td><?= $data->document_description ?></td>
                              <td><?= $data->document_minimum_char ?></td>
                              <td><?= $data->document_maximum_char ?></td>
                              <td><?= $data->country_name ?></td>
                              <td>
                                 <div class="d-flex gap-3">
                                    <a href="<?= site_url('admin/documentrequire/update/'.$data->document_id) ?>" class="btn btn-outline-secondary btn-sm"><i class="mdi mdi-pencil font-size-13"></i></a>
                                    <a href="<?= site_url('admin/documentrequire/remove/'.$data->document_id) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to remove this fare ?');"><i class="mdi mdi-delete font-size-13"></i></a>
                                 </div>   
                              </td>
                           </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?php include(__DIR__.'/../common/_footer.php'); ?>
<script type="text/javascript">
   /*for currency active*/
   $(document).on('change','.page-status',function(){
    var _this = $(this),_data_id,_data_status;
    _data_id = _this.data('id');
    _data_status = '1';
    if (_this.prop('checked') == true){ 
       _data_status = '0';
    }

      $.ajax({
        method: "POST",
        url: "<?= base_url('admin/documentrequire/page_delete') ?>",
        data: { page_id: _data_id, status: _data_status }
      }).done(function(response) {
         console.log(response);
      }).fail(function(errors){
         console.log(errors);
      });
   })
</script>