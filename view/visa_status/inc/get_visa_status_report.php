<?php
include "../../../model/model.php";
$booking_id = $_POST['booking_id'];
$booking_type = $_POST['booking_type'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$cust_type = $_POST['cust_type'];
$company_name = $_POST['company_name'];
$customer_id = $_POST['customer_id'];
$customerIds = getCustomerIdOnly($cust_type, $company_name, $customer_id);
$visaIds = getBookingIdOnCustomer($customerIds);



$count = 0;
$mainQry = "select * from visa_status_entries where 1";
if (!empty($booking_type) && !empty($booking_id)) {
	$mainQry .= " and booking_type ='$booking_type' and booking_id = '$booking_id'";
}
if (!empty($visaIds)) {
	$mainQry .= " and booking_id IN(" . implode(",", $visaIds) . ")";
}
if (!empty($from_date) && !empty($to_date)) {
	$filter_from_date = date('Y-m-d h:i:s', strtotime($from_date));
	$filter_to_date = date('Y-m-d h:i:s', strtotime($to_date));
	$mainQry .= " and created_at BETWEEN '" . $filter_from_date . "' AND '" . $filter_to_date . "'";
}
$sq_report = mysqlQuery($mainQry);
?>
<div class="row mg_tp_20">
	<div class="table-responsive">

		<table class="table table-hover table-bordered" id="tbl_status_list" style="margin: 20px 0 !important;">
			<thead>
				<tr class="table-heading-row">
					<th>S_No.</th>
					<th>Booking Id</th>
					<th>Status_Date</th>
					<th>Passenger_Name</th>
					<th>Visa_Status</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while ($row_report = mysqli_fetch_assoc($sq_report)) {
					$count++;



				?>
					<tr>
						<td><?php echo $count; ?></td>
						<td><?php echo get_visa_booking_id($row_report['booking_id']); ?></td>
						<td><?php echo get_date_user($row_report['created_at']); ?></td>
						<?php
						if ($booking_type == "visa_booking") {
							$sq_visa = mysqli_fetch_assoc(mysqlQuery("select * from visa_master_entries where entry_id='$row_report[traveler_id]' "));  ?>
							<td><?php echo $sq_visa['first_name'] . ' ' . $sq_visa['last_name']; ?></td>

						<?php }
						if ($booking_type == "package_tour") {
							$sq_package = mysqli_fetch_assoc(mysqlQuery("select * from package_travelers_details where traveler_id='$row_report[traveler_id]' "));
						?>
							<td><?php echo $sq_package['first_name'] . ' ' . $sq_package['last_name']; ?></td>

						<?php }
						if ($booking_type == "group_tour") {
							$sq_group = mysqli_fetch_assoc(mysqlQuery("select * from travelers_details where traveler_id='$row_report[traveler_id]' "));
						?>
							<td><?php echo $sq_group['first_name'] . ' ' . $sq_group['last_name']; ?></td>

						<?php }
						if ($booking_type == "flight_booking") {
							$sq_flight = mysqli_fetch_assoc(mysqlQuery("select * from ticket_master_entries where entry_id='$row_report[traveler_id]' "));
						?>
							<td><?php echo $sq_flight['first_name'] . ' ' . $sq_flight['last_name']; ?></td>

						<?php } ?>

						<!-- //document status -->
						<td>
							<select name="" id="visa_status_single" class="form-control" onchange="changeVisaStatus(this.value,'<?= $row_report['id'] ?>')" title="VISA Status">
								<option value="">Select Status</option>
								<option value="Document Confirmed" <?=  $row_report['doc_status'] == "Document Confirmed" ? "selected" : "" ?>>Document Confirmed</option>
								<option value="Document Received" <?=  $row_report['doc_status'] == "Document Received" ? "selected" : "" ?>>Document Received</option>
								<option value="Document Pending" <?=  $row_report['doc_status'] == "Document Pending" ? "selected" : "" ?>>Document Pending</option>
								<option value="Document Processed" <?=  $row_report['doc_status'] == "Document Processed" ? "selected" : "" ?>>Document Processed</option>
								<option value="Visa Confirmed" <?=  $row_report['doc_status'] == "Visa Confirmed" ? "selected" : "" ?>>Visa Confirmed</option>
								<option value="Visa Cancellation" <?=  $row_report['doc_status'] == "Visa Cancellation" ? "selected" : "" ?>>Visa Cancellation</option>
								<option value="Visa By Own" <?=  $row_report['doc_status'] == "Visa By Own" ? "selected" : "" ?>>Visa By Own</option>
							</select>

						</td>
						<td><?php echo $row_report['comment']; ?> </td>
					</tr>

				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$('#tbl_status_list').dataTable({
		"pagingType": "full_numbers"
	});

	function changeVisaStatus(value,id) {
			var base_url = $('#base_url').val();
			$.post(base_url+'view/visa_status/update_visa_status.php',{
				value:value,
				id:id
			},function(data){
				success_msg_alert(data);
				load_visa_report('visa_booking','visa_status_div');
			});
	}
</script>

<?php
function getCustomerIdOnly($cust_type, $company_name, $customer_id)
{
	$data = [];
	if (!empty($cust_type)) {
		$customerQuery = "select customer_id from customer_master where type='$cust_type'";
		if (!empty($company_name)) {
			$customerQuery .= " and company_name='$company_name'";
		}
		$customerQuery = mysqlQuery($customerQuery);
		if (mysqli_num_rows($customerQuery) > 0) {
			while ($db = mysqli_fetch_array($customerQuery)) {
				$data[] = $db['customer_id'];
			}
		}
	} elseif (!empty($customer_id)) {
		$data[] = $customer_id;
	}
	return $data;
}

function getBookingIdOnCustomer($customerId)
{
	$data = [];
	if (!empty($customerId)) {
		$query = mysqlQuery("select visa_id from visa_master where customer_id IN(" . implode(',', $customerId) . ")");
		if (mysqli_num_rows($query) > 0) {
			while ($db = mysqli_fetch_array($query)) {
				$data[] = $db['visa_id'];
			}
		}
	}
	return $data;
}

?>