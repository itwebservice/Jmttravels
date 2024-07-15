<?php
include "../../../../../model/model.php";
$branch_admin_id = $_SESSION['branch_admin_id'];
$emp_id = $_SESSION['emp_id'];
$role = $_SESSION['role'];
$sq = mysqli_fetch_assoc(mysqlQuery("select * from branch_assign where link='reports/reports_homepage.php'"));
$branch_status = $sq['branch_status'];
?>
<div class="app_panel_content Filter-panel mg_bt_10">
	<div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">
		<select id="booking_id_filter1" name="booking_id_filter" style="width:100%" title="Booking ID" class="form-control" onchange="refund_reflect()"> 
			<?php get_package_booking_dropdown($role, $branch_admin_id, $branch_status,$emp_id); ?>
		</select>
	</div>
</div>
<div id="div_list" class="main_block mg_tp_20">
<div class="row"> <div class="col-md-12 no-pad"> <div class="table-responsive">
<table id="gtc_tour_report" class="table table-hover" style="margin: 20px 0 !important;">         
</table>
</div></div></div>
</div>
<script>
	$('#booking_id_filter1').select2();
	var column = [
	{ title: "S_No." },
	{ title: "Refund_Date" },
	{ title: "Tour_name" },
	{ title: "booking_id" },
	{ title: "Bank_name" },
	{ title: "Cheque_no" },
	{ title: "Refund_mode" },
	{ title: "refund_Amount"}
];
	function refund_reflect(){
		var booking_id = $('#booking_id_filter1').val();
		$.post('reports_content/package_tour/refund_report/refund_report.php', {booking_id : booking_id}, function(data){
			pagination_load(data, column, true, true, 20, 'gtc_tour_report',true);
	});
	}
	refund_reflect();
</script>