<?php 
include "../../../model/model.php"; 
include "../../../model/package_tour/quotation/quotation_save.php"; 

$quotation_save = new quotation_save;
$quotation_save->quotation_master_save();
?>