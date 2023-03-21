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
	$mailto = getEmailId($data);
	if ($days_ago_db >= $days_ago && $days_ago_db <= date('Y-m-d') && !empty($mailto)) {

		if ($sq_count == 0) {
			email($name, $visa_country_name, $issue_date, $expiry_date, $renewal_amount,$mailto);
		}
	}
}
if ($sq_count == 0) {
	$row = mysqlQuery("SELECT max(id) as max from remainder_status");
	$value = mysqli_fetch_assoc($row);
	$max = $value['max'] + 1;
	$sq_check_status = mysqlQuery("INSERT INTO `remainder_status`(`id`, `remainder_name`, `date`, `status`) VALUES ('$max','customer_visa_renewal','$today','Done')");
}


function email($name, $visa_country_name, $issue_date, $expiry_date, $renewal_amount,$mailto)
{
	global $app_email_id, $app_name, $app_contact_no, $admin_logo_url, $app_website, $mail_strong_style;

	$content1 = '
	Dear '.$name.',
	We would like to remind you that your visa will expire soon. It is essential to make arrangements for visa renewal or exit the country before the visa expiry date.
	Failure to comply with visa regulations may result in legal consequences, including fines, deportation, and restrictions on future visa applications.
	If you have any questions or concerns about your visa, please contact us as soon as possible.
	Thank you for choosing [Jmt travel & Tourism] we wish you a safe and enjoyable trip.';
	$subject = 'Your Visa Is Expiring Soon';
	global $model;
	$model->app_email_send('91', 'Admin', $mailto, $content1, $subject);
}


function getEmailId($data)
{
	global $model,$encrypt_decrypt,$secret_key;
	$mainVisa = mysqli_fetch_array(mysqlQuery("select * from visa_master where visa_id='".$data['visa_id']."'"));
$customer = mysqli_fetch_assoc(mysqlQuery("SELECT * FROM `customer_master` where customer_id='".$mainVisa['customer_id']."'"));
$name = $data['first_name']." ".$data['last_name'];
global $app_email_id;
$email_id = $encrypt_decrypt->fnDecrypt($customer['email_id'], $secret_key);
return $email_id; 
}