<?php
include "../../../../../../model/model.php";

$customer_id = $_SESSION['customer_id'];
?>
<!-- Filter-panel -->

<div class="app_panel_content Filter-panel">
	<div class="row">
		<div class="col-md-3">
			<select name="visa_id_filter" id="visa_id_filter" class="form-control" onchange="visa_customer_list_reflect()">
				<option value="">Select Booking</option>
				<?php
				$sq_visa = mysqlQuery("select * from visa_master where customer_id='$customer_id' and delete_status='0'");
				while ($row_visa = mysqli_fetch_assoc($sq_visa)) {
					$date = $row_visa['created_at'];
					$yr = explode("-", $date);
					$year = $yr[0];
					$sq_customer = mysqli_fetch_assoc(mysqlQuery("select * from customer_master where customer_id='$row_visa[customer_id]'"));
				?>
					<option value="<?= $row_visa['visa_id'] ?>"><?= get_visa_booking_id($row_visa['visa_id'], $year) . ' : ' . $sq_customer['first_name'] . ' ' . $sq_customer['last_name'] ?></option>
				<?php
				}
				?>
			</select>
		</div>
	</div>
</div>

<div id="div_visa_customer_list_reflect" class="main_block"></div>
<div id="div_visa_content_display" class="main_block"></div>
<script>
	$('#visa_id_filter').select2();

	function visa_customer_list_reflect() {
		var visa_id = $('#visa_id_filter').val()
		$.post('bookings/visa/home/visa_list_reflect.php', {
			visa_id: visa_id
		}, function(data) {
			$('#div_visa_customer_list_reflect').html(data);
		});
	}
	visa_customer_list_reflect();

	function visa_display_modal(visa_id) {
		$('#visa-' + visa_id).button('loading');
		$.post('bookings/visa/home/view/index.php', {
			visa_id: visa_id
		}, function(data) {
			$('#div_visa_content_display').html(data);
			$('#visa-' + visa_id).button('reset');
		});
	}

	function visa_edit_modal(visa_id) {
		$('#visaEdit-' + visa_id).button('loading');
		$.post('bookings/visa/home/edit.php', {
			visa_id: visa_id
		}, function(data) {
			$('#div_visa_content_display').html(data);
			$('#visaEdit-' + visa_id).button('reset');
		});
	}

	function visa_update_modal(visa_id) {
		var base_url = $('#base_url').val();
		$('#btn_update').html('loading');
		$('#btn_update').attr("disabled", true);
		let ids = $("input[name='id[]']").map(function() {
			return $(this).val();
		}).get();
		let first_name = $("input[name='first_name[]']").map(function() {
			return $(this).val();
		}).get();
		let middle_name = $("input[name='middle_name[]']").map(function() {
			return $(this).val();
		}).get();
		let last_name = $("input[name='last_name[]']").map(function() {
			return $(this).val();
		}).get();
		let birth_date = $("input[name='birth_date[]']").map(function() {
			return $(this).val();
		}).get();
		let passport_id = $("input[name='passport_id[]']").map(function() {
			return $(this).val();
		}).get();
		let issue_date = $("input[name='issue_date[]']").map(function() {
			return $(this).val();
		}).get();
		let expiry_date = $("input[name='expiry_date[]']").map(function() {
			return $(this).val();
		}).get();
		let nationality = $("input[name='nationality[]']").map(function() {
			return $(this).val();
		}).get();
		let mother_name = $("input[name='mother_name[]']").map(function() {
			return $(this).val();
		}).get();
		let father_name = $("input[name='father_name[]']").map(function() {
			return $(this).val();
		}).get();
		let id_proff = $("input[name='id_proff[]']").map(function() {
			return $(this).val();
		}).get();

		
		$.post(base_url+'controller/visa_master/customer_visa_entry_update.php', {
			visa_id:visa_id,
			ids : ids,
			first_name : first_name,
			middle_name : middle_name,
			last_name : last_name,
			birth_date : birth_date,
			passport_id : passport_id,
			issue_date : issue_date,
			expiry_date : expiry_date,
			nationality : nationality,
			mother_name : mother_name,
			father_name : father_name,
			id_proff : id_proff,
		}, function(data) {
		$('#btn_update').button('update');
		$('#btn_update').removeAttr("disabled");
			$('#visa_edit_modal').modal('hide');
			success_msg_alert("Visa Updated");
		});



	}
	// function form_update_visa()
	// {
	
	// }
</script>
<script src="<?php echo BASE_URL ?>js/app/footer_scripts.js"></script>