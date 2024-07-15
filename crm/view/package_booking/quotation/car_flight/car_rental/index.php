<?php
include "../../../../../model/model.php";
include_once('../inc/quotation_hints_modal.php');
/*======******Header******=======*/
require_once('../../../../layouts/admin_header.php');
$role = $_SESSION['role'];
$emp_id = $_SESSION['emp_id'];
$branch_admin_id = $_SESSION['branch_admin_id'];
$financial_year_id = $_SESSION['financial_year_id'];
$sq =mysqli_fetch_assoc(mysqlQuery("select * from branch_assign where link='package_booking/quotation/car_flight/car_rental/index.php'"));
$branch_status = $sq['branch_status'];
 
?>
<div id="markup_confirm"></div>
<input type="hidden" id="branch_status" name="branch_status" value="<?= $branch_status ?>" >
<?= begin_panel('Car Rental Quotation',42) ?>
  <!--=======Header panel end======-->

	<div class="app_panel_content">
	    <div class="row">
	        <div class="col-md-12">
	            <div id="div_id_proof_content">
			        <div class="row mg_bt_20">
			            <div class="col-md-8">
			            </div>
			            <div class="col-md-4 text-right">
			                <button class="btn btn-info btn-sm ico_left" onclick="save_modal()" id="cquot_save"><i class="fa fa-plus"></i>&nbsp;&nbsp;Quotation</button>
			            </div>
			        </div>

					<div class="app_panel_content Filter-panel">
						<div class="row">
							<div class="col-md-3 col-sm-4 col-xs-12 mg_bt_10_xs">
								<input type="text" id="from_date_filter"  name="from_date_filter" placeholder="From Date" title="From Date" onchange="get_to_date(this.id,'to_date_filter');quotation_list_reflect()">
							</div>
							<div class="col-md-3 col-sm-3 col-xs-12 mg_bt_10_xs">
								<input type="text" id="to_date_filter" name="to_date_filter" placeholder="To Date" title="To Date" onchange="validate_validDate('from_date_filter','to_date_filter');quotation_list_reflect()">
							</div>
							<div class="col-md-3 col-sm-4 col-xs-12 mg_bt_10_xs">
								<select name="quotation_id" title="Select Quotation" id="quotation_id" onchange="quotation_list_reflect()" style="width:100%">
									<option value="">Select Quotation</option>
									<?php 
									$query = "select * from car_rental_quotation_master where 1 and financial_year_id='$financial_year_id' and status='1'";
									if($role=='Sales' || $role=='Backoffice'){
										$query .= " and emp_id='$emp_id'";
									}
									if($branch_status=='yes' && $role!='Admin'){
											$query .= " and branch_admin_id = '$branch_admin_id'";
									}
									if($branch_status=='yes' && $role=='Branch Admin'){
										$query .= " and branch_admin_id='$branch_admin_id'";
									}
									$query .= " order by quotation_id desc";
									$sq_quotation = mysqlQuery($query);
									while($row_quotation = mysqli_fetch_assoc($sq_quotation)){
									$quotation_date = $row_quotation['quotation_date'];
									$yr = explode("-", $quotation_date);
									$year =$yr[0];
										?>
										<option value="<?= $row_quotation['quotation_id'] ?>"><?= get_quotation_id($row_quotation['quotation_id'],$year) ?></option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="col-md-3 col-sm-6 col-xs-12">
								<select name="status" id="status" title="Status" style="width:100%" onchange="quotation_list_reflect()">
									<option value="">Status</option>
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								</select>
							</div>
						</div>
					</div>

					<div id="div_quotation_list_reflect" class="main_block">
					<div class="row mg_tp_20"> <div class="col-md-12 no-pad"> <div class="table-responsive">
        				<table id="car_table" class="table table-hover" style="width:100%;margin: 20px 0 !important;"></table>
    				</div></div></div>
					</div>
					<div id="div_quotation_form"></div>
					<div id="div_quotation_update"></div>
					<div id="div_modal_content"></div>

	            </div>
	        </div>
	    </div>
	</div>
<?= end_panel() ?>
<script src="<?= BASE_URL ?>js/app/field_validation.js"></script>

<script>
$('#quotation_id').select2();
$('#from_date_filter, #to_date_filter').datetimepicker({ timepicker:false, format:'d-m-Y' });

column = [
	{ title : "S_No." },
	{ title : "Quotation_id"},
	{ title : "Customer" },
	{ title : "QUOTATION_Date&nbsp;&nbsp;" },
	{ title : "Amount" },
	{ title : "Created_by" },
	{ title : "Actions" , className:"text-center"}
]
function quotation_list_reflect()
{	
	$('#div_quotation_list_reflect').append('<div class="loader"></div>');
	var from_date = $('#from_date_filter').val();
	var to_date = $('#to_date_filter').val();
	var quotation_id = $('#quotation_id').val();
	var branch_status = $('#branch_status').val();
	var status = $('#status').val();

	$.post('quotation_list_reflect.php', { from_date : from_date, to_date : to_date, quotation_id : quotation_id , branch_status : branch_status,status:status}, function(data){
		pagination_load(data, column, true, false, 20, 'car_table');
		$('.loader').remove();
	})
}
quotation_list_reflect();

$(document).ready(function(){
	let searchParams = new URLSearchParams(window.location.search);
	if( searchParams.get('enquiry_id') ){
		save_modal();
	}
});

function save_modal()
{
	var branch_status = $('#branch_status').val();
	$('#cquot_save').button('loading');
	$.post('save/index.php', { branch_status : branch_status}, function(data){
		$('#div_quotation_form').html(data);
		$('#cquot_save').button('reset');
	});
}
function update_modal(quotation_id)
{
    $('#edit-'+quotation_id).prop('disabled',true);
    $('#edit-'+quotation_id).button('loading');
	var branch_status = $('#branch_status').val();
	$.post('update/index.php', { quotation_id : quotation_id , branch_status : branch_status}, function(data){
		$('#div_quotation_update').html(data);
        $('#edit-'+quotation_id).button('reset');
	});
}
function quotation_whatsapp(quotation_id){
	var base_url = $('#base_url').val();
	$.post(base_url+'controller/package_tour/quotation/car_rental/quotation_whatsapp.php', { quotation_id : quotation_id}, function(link){
		// console.log(link)
		window.open(link);
	});
}
</script>
<script src="<?php echo BASE_URL ?>view/package_booking/quotation/car_flight/js/car_calculation.js"></script>
<?php
/*======******Footer******=======*/
require_once('../../../../layouts/admin_footer.php'); 
?>