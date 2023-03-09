<?php

include_once('../model.php');
global $model;

$today = date('Y-m-d');
$sq_query = "SELECT * FROM `visa_master_entries`";
$data = mysqlQuery($sq_query);
$sq_count = mysqli_num_rows(mysqlQuery("SELECT * from  remainder_status where remainder_name = 'customer_visa_renewal' and date='$today' and status='Done'"));
while ($row_emp = mysqli_fetch_assoc($data)) {
	$days_ago = date('Y-m-d', strtotime('-3 days', strtotime(date('Y-m-d'))));
	$days_ago_db = date('Y-m-d', strtotime('-3 days', strtotime($row_emp['expiry_date'])));

	$emp_id = $row_emp['emp_id'];
	$name = $row_emp['first_name'] . " " . $row_emp['last_name'];
	$visa_country_name = $row_emp['visa_country_name'];
	$issue_date = $row_emp['issue_date'];
	$expiry_date = $row_emp['expiry_date'];
	$renewal_amount = $row_emp['pass_status'];
	
	if ($days_ago_db >= $days_ago && $days_ago_db <= date('Y-m-d')) {

		if ($sq_count == 0) {
			email($name, $visa_country_name, $issue_date, $expiry_date, $renewal_amount);
		}
	}
}
if ($sq_count == 0) {
	$row = mysqlQuery("SELECT max(id) as max from remainder_status");
	$value = mysqli_fetch_assoc($row);
	$max = $value['max'] + 1;
	$sq_check_status = mysqlQuery("INSERT INTO `remainder_status`(`id`, `remainder_name`, `date`, `status`) VALUES ('$max','customer_visa_renewal','$today','Done')");
}


function email($name, $visa_country_name, $issue_date, $expiry_date, $renewal_amount)
{
	global $app_email_id, $app_name, $app_contact_no, $admin_logo_url, $app_website, $mail_strong_style;

	$content1 = '
		<tr>
			<table width="85%" cellspacing="0" cellpadding="5" style="color: #888888;border: 1px solid #888888;margin: 0px auto;margin-top:20px; min-width: 100%;" role="presentation">
				<tr><td style="text-align:left;border: 1px solid #888888;">Customer name</td>   <td style="text-align:left;border: 1px solid #888888;">' . $name . '</td></tr>
				<tr><td style="text-align:left;border: 1px solid #888888;"> Country</td>   <td style="text-align:left;border: 1px solid #888888;" >' . $visa_country_name . '</td></tr>
				<tr><td style="text-align:left;border: 1px solid #888888;">Issue Date</td>   <td style="text-align:left;border: 1px solid #888888;">' . get_date_user($issue_date) . '</td></tr>
				<tr><td style="text-align:left;border: 1px solid #888888;">Expiry Date </td>   <td style="text-align:left;border: 1px solid #888888;">' . get_date_user($expiry_date) . '</td></tr>
				<tr><td style="text-align:left;border: 1px solid #888888;">Status </td>   <td style="text-align:left;border: 1px solid #888888;">' . $renewal_amount . '</td></tr>
				
			</table>
		</tr>';
	$subject = 'Customer Visa Status ( Customer Name :' . $name . ' ).';
	global $model;
	$model->app_email_send('91', 'Admin', $app_email_id, $content1, $subject);
}
