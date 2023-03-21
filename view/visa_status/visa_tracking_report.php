<?php 
include "../../model/model.php";
$booking_type = $_POST['booking_type'];
$traveler_id = $_POST['traveler_id'];

$query = "select * from visa_status_entries where booking_type ='$booking_type' and traveler_id = '$traveler_id'";
$sq_report = mysqli_fetch_assoc(mysqlQuery($query));
if($sq_report['doc_status'] != ''){ 
	?>
	<option value="<?php echo $sq_report['doc_status']; ?>"><?php echo $sq_report['doc_status']; ?></option>	
<?php }
else{ ?>
	<option value="">Select Status</option>
<?php } ?>
<option value="Document Confirmed">Document Confirmed</option>
<option value="Document Received">Document Received</option>
<option value="Document Pending">Document Pending</option>
<option value="Document Processed">Document Processed</option>
<option value="Visa Confirmed">Visa Confirmed</option>
<option value="Visa Cancellation">Visa Cancellation</option>
<option value="Visa By Own">Visa By Own</option>
<option value="Return"> Return</option>
<option value="Reject" > Reject</option>
<option value="Extend"> Extend</option>
<option value="Expired"> Expired</option>
<option value="Exit"> Exit</option>
<option value="Documents received"> Documents received</option>
<option value="Payment pending"> Payment pending</option>
<option value="Hold"> Hold</option>
<option value="Proceed"> Proceed</option>
<option value="Visa issued"> Visa issued</option>
<option value="Visa approval"> Visa approval</option>
<option value="Visa Renewal"> Visa Renewal</option>
