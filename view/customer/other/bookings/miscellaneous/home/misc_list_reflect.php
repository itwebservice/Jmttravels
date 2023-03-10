<?php
include "../../../../../../model/model.php";
$misc_id = $_POST['misc_id'];
$customer_id = $_SESSION['customer_id'];
?>
<div class="row mg_tp_20">
	<div class="col-md-12">
		<div class="table-responsive">

			<table class="table table-bordered bg_white cust_table" id="tbl_miscellaneous_list" style="margin:20px 0 !important">
				<thead>
					<tr class="table-heading-row">
						<th>S_No.</th>
						<th>Booking_ID</th>
						<th>Total_pax</th>
						<th>View</th>
						<th class="info">Total_Amount</th>
						<th class="success">Paid_Amount</th>
						<th class="danger">Cncel_amount</th>
						<th class="warning">Balance</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "select * from miscellaneous_master where customer_id='$customer_id' and delete_status='0'";
					if ($misc_id != '') {
						$query .= " and misc_id='$misc_id'";
					}
					$count = 0;
					$booking_amount = 0;
					$cancelled_amount = 0;
					$total_amount = 0;
					$sq_miscellaneous = mysqlQuery($query);
					while ($row_miscellaneous = mysqli_fetch_assoc($sq_miscellaneous)) {

						$pass_count = mysqli_num_rows(mysqlQuery("select * from  miscellaneous_master_entries where misc_id='$row_miscellaneous[misc_id]'"));
						$cancel_count = mysqli_num_rows(mysqlQuery("select * from  miscellaneous_master_entries where misc_id='$row_miscellaneous[misc_id]' and status='Cancel'"));
						$bg = "";
						if ($pass_count == $cancel_count) {
							$bg = "danger";
						} else {
							$bg = "#fff";
						}
						$sq_customer_info = mysqli_fetch_assoc(mysqlQuery("select * from customer_master where customer_id='$row_miscellaneous[customer_id]'"));

						//Get Total no of miscellaneous members
						$sq_total_member = mysqli_num_rows(mysqlQuery("select misc_id from miscellaneous_master_entries where misc_id='$row_miscellaneous[misc_id]'"));

						$query1 = mysqli_fetch_assoc(mysqlQuery("SELECT sum(payment_amount) as sum,sum(credit_charges) as sumc from miscellaneous_payment_master where misc_id='$row_miscellaneous[misc_id]' and clearance_status != 'Pending' and clearance_status != 'Cancelled'"));
						//Get Total miscellaneous Cost
						$sale_total_amount = $row_miscellaneous['misc_total_cost'] + $query1['sumc'];
						if ($sale_total_amount == "") {
							$sale_total_amount = 0;
						}
						$cancel_amount = $row_miscellaneous['cancel_amount'];
						$paid_amount = $query1['sum'] + $query1['sumc'];
						$paid_amount = ($paid_amount == '') ? '0' : $paid_amount;

						if ($pass_count == $cancel_count) {
							if ($paid_amount > 0) {
								if ($cancel_amount > 0) {
									if ($paid_amount > $cancel_amount) {
										$balance_amount = 0;
									} else {
										$balance_amount = $cancel_amount - $paid_amount + $query1['sumc'];
									}
								} else {
									$balance_amount = 0;
								}
							} else {
								$balance_amount = $cancel_amount;
							}
						} else {
							$balance_amount = $sale_total_amount - $paid_amount;
						}

						//Total
						$total_amount += $sale_total_amount;
						$total_paid += $paid_amount;
						$total_cancel += $cancel_amount;
						$total_balance += $balance_amount;
						$created_at = $row_miscellaneous['created_at'];
						$year = explode("-", $created_at);
						$year = $year[0];
					?>
						<tr class="<?= $bg ?>">
							<td><?= ++$count ?></td>
							<td><?= get_misc_booking_id($row_miscellaneous['misc_id'], $year) ?></td>
							<td><?php echo $sq_total_member; ?></td>
							<td>
								<button class="btn btn-info btn-sm" onclick="misc_display_modal(<?= $row_miscellaneous['misc_id'] ?>)" title="View Details" id="misc-<?= $row_miscellaneous['misc_id'] ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
							</td>
							<td class="info"><?php echo $sale_total_amount; ?></td>
							<td class="success"><?= $paid_amount ?></td>
							<td class="danger"><?php echo $cancel_amount; ?></td>
							<td class="warning"><?php echo number_format($balance_amount, 2); ?></td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4" class="text-right active">Total</th>
						<th class="info text-right"><?php echo number_format($total_amount, 2); ?></th>
						<th class="success text-right"><?php echo number_format($total_paid, 2); ?></th>
						<th class="danger text-right"><?php echo number_format($total_cancel, 2); ?></th>
						<th class="warning text-right"><?php echo number_format($total_balance, 2); ?></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<script>
$('#tbl_miscellaneous_list').dataTable({
	"pagingType": "full_numbers"
});
</script>