<?php
include_once('../../../model/model.php');
include_once('../../../model/mediaable/mediaable.php');
$visa_id = $_POST['entry_id'];

$query = mysqlQuery("select * from visa_master_entries where entry_id='$visa_id'");
?>
<div class="mg_tp_20"></div>
<h3 class="editor_title">id proof Information</h3>
<div class="panel panel-default panel-body">

  <div class="table-responsive">
    <table class="table table-hover" id="dataTableMain">
      <thead style="background-color: gray;">
        <tr>
          <td>SR No.</td>
          <td>Passenger Name</td>
          <td>Passenger Passport ID</td>
          <td>Issue Date</td>
          <td>Expiry Date</td>
          <td>File Action</td>
          <td>Customer Uploads</td>
          <td>Admin Uploads</td>
        </tr>
      </thead>
      <tbody>
        <?php
        $count = 1;
        while ($db = mysqli_fetch_array($query)) {
          $media = new mediaable();
          $imgs = $media->getMedia($db['entry_id'], 'VISA_ID_PROFF');
          $imgsAdmin = $media->getMedia($db['entry_id'], 'VISA_ID_PROFF_ADMIN');
        ?>
          <tr>
            <td><?= $count++ ?></td>
            <td><?= $db['first_name'] ?> <?= $db['last_name'] ?> </td>
            <td>
              <input type="text" placeholder="Passport Id" title="Passport Id" style="width: 160px;" value="<?= $db['passport_id'] ?>" id="passport_no<?= $db['entry_id'] ?>" onchange="updateDetails(`<?= $db['entry_id'] ?>`)" class="form-control">
            </td>
            <td>
              <input type="text" placeholder="Issue Date" title="Issue Date" style="width: 160px;" value="<?= get_date_db($db['issue_date']) ?>" id="issue_date<?= $db['entry_id'] ?>" onchange="updateDetails(`<?= $db['entry_id'] ?>`)" class="form-control">
            </td>
            <td>
              <input type="text" placeholder="Expiry Date" title="Expiry Date" style="width: 160px;" value="<?= get_date_db($db['expiry_date']) ?>" id="expiry_date<?= $db['entry_id'] ?>" onchange="updateDetails(`<?= $db['entry_id'] ?>`)" class="form-control">
            </td>
            <td style="display:flex;">
              <form method="post" id="form_upload_<?= $db['entry_id'] ?>" enctype="multipart/form-data">
             <div class="row">
             
                <div class="col-md-8 mg_tp_10">
                <input type="file" name="file" >
                <input type="hidden" name="model_id" value="<?= $db['entry_id'] ?>">
                <input type="hidden" name="model_name" value="VISA_ID_PROFF_ADMIN">
                </div>
                <div class="col-md-4">
                <button type="button" class="btn btn-sm btn-success" onclick="fileUploadManual(`form_upload_<?= $db['entry_id'] ?>`)"><i class="fa fa-upload"></i>&nbsp;&nbsp;Upload</button>
                
                </div>
               
              </div>  
              
              </form>
            </td>
            <td>
              
               <div class="" style="display: flex;">
              <?php
              foreach ($imgs as $img) {
              ?>
               
                <a href="<?= BASE_URL . $img ?>" target="_blank" data-toggle="tooltip" class="btn btn-info btn-sm" title="Id Proof" data-original-title="View Image"><i class="fa fa-eye"></i></a> 
               
              <?php
              }
              ?>
              </div>
            </td>
            <td>
            <div class="" style="display: flex;">
              <?php
              foreach ($imgsAdmin as $img) {
              ?>
                <a href="<?= BASE_URL . $img ?>" target="_blank" data-toggle="tooltip" class="btn btn-info btn-sm" title="Id Proof" data-original-title="View Image"><i class="fa fa-eye"></i></a>
              <?php
              }
              ?>
            </div>  
            </td>
          </tr>
          <script>
            $('#issue_date<?= $db['entry_id'] ?>,#expiry_date<?= $db['entry_id'] ?>').datetimepicker({
              timepicker: false,
              format: 'd-m-Y'
            });
          </script>
        <?php } ?>
      </tbody>
    </table>
  </div>


</div>
<script type="text/javascript">
  function updateDetails(entryId) {
    var passport_no = $('#passport_no' + entryId).val();
    var issue_date = $('#issue_date' + entryId).val();
    var expiry_date = $('#expiry_date' + entryId).val();
    var entry_id = entryId;
    var base_url = $('#base_url').val();


    $.ajax({
      type: 'post',
      url: base_url + 'controller/passport_id_details/visa_passport_details.php',
      data: {
        passport_no: passport_no,
        issue_date: issue_date,
        expiry_date: expiry_date,
        entry_id: entry_id
      },
      success: function(result) {
        msg_alert(result);

        traveler_id_proof_info_reflect();
      }
    });
  }
</script>
<script src="<?php echo BASE_URL ?>js/app/footer_scripts.js"></script>

<script type="text/javascript">
  // $('#dataTableMain').dataTable({
  // 	"pagingType": "full_numbers"
  // });
</script>

<script>
  function fileUploadManual(formid) {
    var base_url = $('#base_url').val();
    const formMain = $('#' + formid);
    if (fileValidation(formMain[0].file) == false) {
      return false;
    }
    $('#' + formid).on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: base_url + "controller/mediaable/save.php",
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          msg_alert("File Successfully Uploaded");
          traveler_id_proof_info_reflect();
        },
        error: function(msg) {
          console.log(msg);
          error_msg_alert("File Upload Error");
        }
      });
    });
    $('#' + formid).submit();
  }

  function fileValidation(fileInput) {
    const file = fileInput.files[0];
    if (file == "" || file == undefined) {
      error_msg_alert("Select File First");
      return false;
    }
    const fileSize = file.size / 1024 / 1024; // in megabytes
    const fileType = file.type;
    const fileName = file.name;
    if (fileName == "") {
      error_msg_alert("Select File First");
      return false;
    }
    if (fileSize > 3) {
      alert("File size must be less than 5 MB");
      fileInput.value = ""; // clear the input value
      return false;
    }

    // if (!fileType.startsWith("image/")) {
    //   alert("File must be an image");
    //   fileInput.value = ""; // clear the input value
    //   return false;
    // }
  }
</script>