<?php  
include "../../../model/model.php";
$role = $_SESSION['role'];
$branch_admin_id = $_SESSION['branch_admin_id'];
$branch_status = $_POST['branch_status'];
?>

  <div class="row mg_bt_20">
    <div class="col-sm-12 text-right text_left_sm_xs">
    <button class="btn btn-info btn-sm ico_left" id="btn_save_modal" onclick="save_modal()"><i class="fa fa-plus"></i>&nbsp;&nbsp;New Status</button>
    </div>
  </div>
<div class="app_panel_content Filter-panel">
    <div class="row"> 
    <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">
			<select name="cust_type_filter" id="cust_type_filter" style="width:100%" onchange="dynamic_customer_load(this.value,'company_filter');company_name_reflect();" title="Customer Type">
				<?php get_customer_type_dropdown(); ?>
			</select>
	    </div>
      <div id="company_div" class="hidden">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10" id="customer_div">    
        </div> 
        <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">

          <select name="visa_id_filter1" id="visa_id_filter_reflect" style="width:100%" title="Booking ID" >
            <option value="">Booking ID</option>
            <?php
            $query = "select * from visa_master where 1 and delete_status='0'";
            if($branch_status=='yes' && $role!='Admin'){
              $query .= " and branch_admin_id = '$branch_admin_id'";
            }
            elseif($role!='Admin' && $role!='Branch Admin' && $role_id!='7' && $role_id<'7'){
              $query .= " and emp_id='$emp_id'";
            }
            
            $query .= " order by visa_id desc";
            $sq_visa = mysqlQuery($query);
            while($row_visa = mysqli_fetch_assoc($sq_visa)){
              $booking_date = $row_visa['created_at'];
              $yr = explode("-", $booking_date);
              $year =$yr[0];
              $sq_customer = mysqli_fetch_assoc(mysqlQuery("select * from customer_master where customer_id='$row_visa[customer_id]'"));
              if($sq_customer['type'] == 'Corporate'||$sq_customer['type'] == 'B2B'){
                  $customer_name = $sq_customer['company_name'];
                }else{
                  $customer_name = $sq_customer['first_name'].' '.$sq_customer['last_name'];
                }
              
              ?>
              <option value="<?= $row_visa['visa_id'] ?>"><?= get_visa_booking_id($row_visa['visa_id'],$year).' : '.$customer_name ?></option>
              <?php
            }
            ?>
          </select>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">
			<input type="text" id="from_date" name="from_date" class="form-control" placeholder="From Date" title="From Date" onchange="get_to_date(this.id,'to_date');">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">
			<input type="text" id="to_date" name="to_date" class="form-control" onchange="validate_validDate('from_date','to_date');" placeholder="To Date" title="To Date">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">
			<button class="btn btn-sm btn-info ico_right" onclick="load_visa_report('visa_booking','visa_status_div')">Proceed&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
		</div>
    </div>
</div>

<div id="save_div"></div>
<div id="visa_status_div" class="main_block"></div>


<script>
$('#visa_id_filter_reflect').select2();
$('#from_date, #to_date').datetimepicker({ timepicker:false, format:'d-m-Y' });

if (typeof dynamic_customer_load === 'function') {
		dynamic_customer_load('','');
	}
function save_modal()
{
  var branch_status = $('#branch_status').val();
  $.post( '../../visa_status/visa/save_modal.php' , {branch_status : branch_status} , function ( data ) {
        $("#save_div").html(data);
   });
}
function load_passenger(booking_id)
{
	var booking_id = $('#'+booking_id).val();
	$.post( base_url()+"view/visa_status/inc/load_visa_passenger.php" , {booking_id : booking_id} , function ( data ) {
        $("#cmb_traveler_id2").html(data);
   });
}

function load_visa_status(traveler_id,offset)
{
   var booking_type = $('#booking_type').val();
   var traveler_id = $('#'+traveler_id).val();
   $.post( base_url()+"view/visa_status/visa_tracking_report.php" , {booking_type : booking_type, traveler_id : traveler_id } , function ( data ) {
        $ ("#doc_status"+offset).html(data) ;
   });
}
function load_visa_report(booking_type,result_div)
{
    var booking_id = $('#visa_id_filter_reflect').val();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var cust_type = $('#cust_type_filter').val();
		var company_name = $('#company_filter').val();
		var customer_id = $('#customer_id_filter').val();


    $.post( base_url()+"view/visa_status/inc/get_visa_status_report.php" , {booking_id : booking_id, booking_type : booking_type,
      from_date :from_date,
      to_date :to_date,
      cust_type :cust_type,
      company_name :company_name,
      customer_id :customer_id
    } , function ( data ) {
        $ ("#"+result_div).html(data) ;
    });
}

function dynamic_customer_load(cust_type, company_name) {
    var cust_type = $('#cust_type_filter').val();
    var company_name = $('#company_filter').val();
    var branch_status = $('#branch_status').val();
    $.get("../../visa_passport_ticket/visa/home/get_customer_dropdown.php", {
        cust_type: cust_type,
        company_name: company_name,
        branch_status: branch_status
    }, function(data) {
        $('#customer_div').html(data);
    });
}

function visa_id_dropdown_load(customer_id_filter, visa_id_filter) {
	var customer_id = $('#' + customer_id_filter).val();
	var branch_status = $('#branch_status').val();
	$.post('../../visa_passport_ticket//visa/visa_id_dropdown_load.php', { customer_id: customer_id, branch_status: branch_status }, function (data) {
		$('#' + visa_id_filter).html(data);
	});
}
</script>

<script src="<?php echo BASE_URL ?>js/app/footer_scripts.js"></script>