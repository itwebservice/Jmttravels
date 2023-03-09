<?php 
include "../../model/model.php";
$value = $_POST['value'];
$id = $_POST['id'];

$query = mysqlQuery("update visa_status_entries set doc_status='$value' where id='$id'");
echo json_encode('VISA Status Updated',200);
