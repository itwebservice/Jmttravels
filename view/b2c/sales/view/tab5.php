<!-- Tour Payment details-->
<?php
$query = mysqli_fetch_assoc(mysqlQuery("SELECT sum(payment_amount) as sum,sum(`credit_charges`) as sumc from b2c_payment_master where booking_id='$sq_package_info[booking_id]' and clearance_status != 'Pending' and clearance_status != 'Cancelled'"));
$credit_card_amount = $query['sumc'];
$paid_amount = $query['sum'];
$paid_amount = ($paid_amount == '') ? '0' : $paid_amount;
$sale_total_amount = $net_total;
if ($sale_total_amount == "") {
	$sale_total_amount = 0;
}
$cancel_amount = $sq_package_info['cancel_amount'];
if ($cancel_amount != 0) {
	if ($cancel_amount <= $paid_amount) {
		$balance_amount = 0;
	} else {
		$balance_amount =  $cancel_amount - $paid_amount;
	}
} else {
	$cancel_amount = ($cancel_amount == '') ? '0' : $cancel_amount;
	$balance_amount = $sale_total_amount - $paid_amount;
}
include "../../../../model/app_settings/generic_sale_widget.php";
?>
<div class="row">
	<div class="col-xs-12">
		<div class="profile_box main_block" style="margin-top: 25px">
			<h3 class="editor_title">Summary</h3>
			<div class="table-responsive">
				<table class="table table-bordered no-marg">
					<thead>
						<tr class="table-heading-row">
							<th>S_No.</th>
							<th>Date</th>
							<th>Mode</th>
							<th>Receipt_ID</th>
							<th>Bank_Name</th>
							<th>Cheque_No/ID</th>
							<th class="text-right">Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 0;
						$query2 = "SELECT * from b2c_payment_master where booking_id='$sq_package_info[booking_id]' and payment_amount != '0'";
						$sq_package_payment = mysqlQuery($query2);
						$bg = "";

						while ($row_package_payment = mysqli_fetch_assoc($sq_package_payment)) {

							$count++;
							$bg = '';
							if ($row_package_payment['clearance_status'] == "Pending") {
								$bg = "warning";
							} else if ($row_package_payment['clearance_status'] == "Cancelled") {
								$bg = "danger";
							} else if ($row_package_payment['clearance_status'] == "Cleared") {
								$bg = "success";
							}else{
								$bg = "";
							}
						?>
							<tr class="<?php echo $bg; ?>">
								<td><?php echo $count; ?></td>
								<td><?php echo get_date_user($row_package_payment['payment_date']); ?></td>
								<td><?php echo $row_package_payment['payment_mode']; ?></td>
								<td><?php echo ($row_package_payment['payment_mode'] == 'Online') ? $row_package_payment['payment_id'] : 'NA'; ?></td>
								<td><?php echo $row_package_payment['bank_name']; ?></td>
								<td><?php echo $row_package_payment['transaction_id']; ?></td>
								<td class="text-right"><?php echo number_format($row_package_payment['payment_amount'] + $row_package_payment['credit_charges'], 2); ?></td>
							</tr>
						<?php }  ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>