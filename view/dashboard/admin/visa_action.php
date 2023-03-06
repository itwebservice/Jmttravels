<?php
include '../../../model/model.php';
$sq_query = "update `visa_master_entries` set pass_status='".$_POST['opt']."' where entry_id='".$_POST['visa_id']."'";
$data = mysqlQuery($sq_query);
echo json_encode("success");

?>

