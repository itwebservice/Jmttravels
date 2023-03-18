<?php 
include "../../model/model.php"; 
include "../../model/visa_password_ticket/visa/visa_master.php"; 
include('../../model/mediaable/mediaable.php');


$visa_master = new visa_master(); 
// var_dump($visa_master);
 $visa_master->visa_master_entries_update();


?>