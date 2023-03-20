<?php  
include "../../../model/model.php";
$emp_id = $_SESSION['emp_id'];
$role = $_SESSION['role'];
$role_id = $_SESSION['role_id'];
$branch_admin_id = $_SESSION['branch_admin_id'];
$branch_status = $_POST['branch_status'];
?>
<div class="app_panel_content Filter-panel">
<div class="row">
      <div class="col-sm-4 col-sm-offset-4">
      <!--  -->
        <select id="fcmb_traveler_id" name="fcmb_traveler_id" title="VISA" style="width:100%;" onchange="traveler_id_proof_info_reflect()"  title="Passenger">
            <option value="">VISA</option>
            <?php
            $query = "select * from visa_master where 1 and delete_status='0'";
            if($branch_status=='yes' && $role!='Admin'){
                $query .= " and visa_id in (select visa_id from visa_master where branch_admin_id = '$branch_admin_id')";
            }
            elseif($role!='Admin' && $role!='Branch Admin' && $role_id!='7' && $role_id<'7'){
              $query .= " and visa_id in (select visa_id from visa_master where emp_id ='$emp_id')";
            }
            $query .= " and cancel_flag!= 1";
            $query .= " order by visa_id desc";


            $sq_travelers_details = mysqlQuery($query);   
            while($row_travelers_details = mysqli_fetch_assoc( $sq_travelers_details ))
                  {
                    $cust = mysqli_fetch_array(mysqlQuery("SELECT * FROM `customer_master` where customer_id='$row_travelers_details[customer_id]'"));
                    $sql_booking = mysqli_fetch_assoc(mysqlQuery("select * from visa_master where visa_id = '$row_travelers_details[visa_id]' and delete_status='0'"));
                    $booking_date = $sql_booking['created_at'];
                    $yr = explode("-", $booking_date);
                    $year = $yr[0];
                    ?>
                    <option value="<?php echo $row_travelers_details['visa_id'] ?>"><?php echo get_visa_booking_id($row_travelers_details['visa_id'],$year).' : '.$cust['first_name'].' '.$cust['last_name']; ?></option>
                    <?php
                  }
            ?>
          </select>  
    </div>
</div>
</div>
<div id="div_traveler_id_proof_info1" class="main_block mg_tp_20"></div>

<script src="<?= BASE_URL ?>js/app/field_validation.js"></script>

<script src="<?= BASE_URL ?>js/ajaxupload.3.5.js"></script>
<script>
$('#fcmb_traveler_id').select2();
function traveler_id_proof_info_reflect()
{
    var traveler_id = $('#fcmb_traveler_id').val();
    if(traveler_id == ''){
      error_msg_alert("Select Passenger first!");
      $('#div_traveler_id_proof_info1').addClass('hidden'); 
      return false;
    }else{
      $('#div_traveler_id_proof_info1').removeClass('hidden');
    }

    $.post('visa/traveler_id_proof_info_reflect.php', { entry_id : traveler_id }, function(data){
        $('#div_traveler_id_proof_info1').html(data);
    });
}

</script>

<script src="<?php echo BASE_URL ?>js/app/footer_scripts.js"></script>