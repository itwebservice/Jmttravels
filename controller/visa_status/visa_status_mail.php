<?php 
include_once('../../model/model.php');
global $model,$encrypt_decrypt,$secret_key;
$visa_entry_id = $_POST['entry_id'];
$type = $_POST['type'];
$send = 0;
$data = mysqli_fetch_array(mysqlQuery("select * from visa_master_entries where entry_id='$visa_entry_id'"));
$mainVisa = mysqli_fetch_array(mysqlQuery("select * from visa_master where visa_id='".$data['visa_id']."'"));
$customer = mysqli_fetch_assoc(mysqlQuery("SELECT * FROM `customer_master` where customer_id='".$mainVisa['customer_id']."'"));
$name = $data['first_name']." ".$data['last_name'];
global $app_email_id;
$email_id = $encrypt_decrypt->fnDecrypt($customer['email_id'], $secret_key);

if($type == "Visa issued")
{
$subject = 'Your Visa Has Been Issued';
$content = "Dear <b>".$data['first_name']." ".$data['last_name']."</b>, <br>
We are pleased to inform you that your visa application has been approved. Your visa will be issued shortly, and we will notify you when it is ready for collection or delivery.
<br>
Thank you for choosing [Jmt Trave & Tourism] we wish you a safe and enjoyable trip.
";
$send =1;
}

if($type == "Visa Confirmed")
{
$subject = 'Your Visa Application Has Been Approved';
$content = "Dear <b>".$data['first_name']." ".$data['last_name']."</b>, <br>
We are pleased to inform you that your visa application has been approved. Your visa will be issued shortly, and we will notify you when it is ready for collection or delivery.
<br>
Thank you for choosing [Jmt Trave & Tourism] we wish you a safe and enjoyable trip.
";
$send =1;
}

if($type == "Visa Renewal")
{
$subject = 'Your Visa Renewal is Due Soon';
$content = "Dear <b>".$data['first_name']." ".$data['last_name']."</b>, <br>
We would like to remind you that your visa renewal is due soon. Please start the renewal process well in advance of the expiry date to ensure that you have enough time to complete all the necessary steps. contact us for assistance.
<br>
Thank you for choosing [Jmt Trave & Tourism] we wish you a safe and enjoyable trip.
";
$send =1;
}


if($type == "Expired")
{
$subject = 'VISA EXPIRED';
$content = "Dear <b>".$data['first_name']." ".$data['last_name']." PASSPORT:".$data['passport_id']."</b>, <br>
We regret to inform you that your visa has expired as of ".$data['expiry_date'].". As per the immigration laws and regulations of the country, it is necessary for you to have a valid visa to remain in the country. Therefore, it is important that you take immediate action to either renew your visa or exit the country before the expiry of your grace period.
 <br>
Failure to exit from Oman on within visa validity period results in penalty and legal consequences apply.
<br>
If you have any questions or concerns regarding the visa renewal  process, please feel free to contact us for assistance. We are always here to help you with any Visa-related matters.
Thank you for your attention, and we look forward to hearing from you soon.
<br>Best regards,

";
$send =1;
}


if($send == 1)
{
    if(empty($email_id))
    {
        echo "Email not exist for this customer!";
        exit;       
    }
$model->app_email_send('',$name,$email_id, $content,$subject,'1');
 echo "Mail sent successfully! ".$email_id;

}
else{
    echo "Mail not sent for this Status!";
    
}
