<?php
include_once('../../../../model/model.php');
include_once('../../../../model/vendor/dashboard/vendor_estimate_master.php');
include_once('../../../../model/app_settings/transaction_master.php');
include_once('../../../../view/vendor/inc/vendor_generic_functions.php');
include_once('../../../../model/app_settings/deleted_entries_save.php');

$vendor_estimate_master = new vendor_estimate_master;
$vendor_estimate_master->vendor_estimate_delete();
?>