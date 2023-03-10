<?php 
include "../../../model/model.php";
include_once('../../layouts/fullwidth_app_header.php');
$role = $_SESSION['role'];
$branch_admin_id = $_SESSION['branch_admin_id']; 
$tourwise_id = $_POST['booking_id'];
$branch_status = $_POST['branch_status'];

$sq_tourwise_id = mysqli_fetch_assoc(mysqlQuery("select * from tourwise_traveler_details where id='$tourwise_id' and delete_status='0' "));

$tour_id = $sq_tourwise_id['tour_id'];
$tour_group_id = $sq_tourwise_id['tour_group_id'];
$traveler_group_id = $sq_tourwise_id['traveler_group_id'];
$reflections = json_decode($sq_tourwise_id['reflections']);
$tour_name_sq = mysqli_fetch_assoc(mysqlQuery("select tour_name,tour_type from tour_master where tour_id='$tour_id'"));
$tour_name = $tour_name_sq['tour_name'];
$tour_group_sq = mysqli_fetch_assoc(mysqlQuery("select from_date, to_date from tour_groups where tour_id='$tour_id' and group_id='$tour_group_id'"));
$tour_group_name = date("d-m-Y", strtotime($tour_group_sq['from_date']))." to ".date("d-m-Y", strtotime($tour_group_sq['to_date']));

$tourwise_details = mysqli_fetch_assoc(mysqlQuery("select * from tourwise_traveler_details where id='$tourwise_id' and delete_status='0'"));
$date = $tourwise_details['form_date'];
$yr = explode("-", $date);
$year =$yr[0];

$sq_tcs = mysqli_fetch_assoc(mysqlQuery("select * from tcs_master where entry_id='1'"));
$tcs_readonly = ($sq_tcs['apply'] == '0' || $tour_name_sq['tour_type']=='Domestic' || $sq_tcs['calc'] == '0') ? 'readonly' : '';

if($reflections[0]->tax_apply_on == '1') { 
    $tax_apply_on = 'Tour Amount';
}
else if($reflections[0]->tax_apply_on == '2') { 
    $tax_apply_on = 'Basic Amount';
}else{
    $tax_apply_on = '';
}
?>
<input type="hidden" id="cmb_tour_name" name="cmb_tour_name" value="<?php echo $tour_id; ?>">
<input type="hidden" id="txt_tourwise_id" name="txt_tourwise_id" value="<?php echo $tourwise_id; ?>">
<input type="hidden" id="hotel_markup" name="hotel_markup" value="<?php echo $reflections[0]->hotel_markup ?>">
<input type="hidden" id="hotel_taxes" name="hotel_taxes" value="<?php echo $reflections[0]->hotel_taxes ?>">
<input type="hidden" id="hotel_markup_taxes" name="hotel_markup_taxes" value="<?php echo $reflections[0]->hotel_markup_taxes ?>">
<input type="hidden" id="hotel_tds" name="hotel_tds" value="<?php echo $reflections[0]->hotel_tds ?>">
<input type="hidden" id="tcs" name="tcs" value="<?= $sq_tcs['tax_amount'] ?>">
<input type="hidden" id="tcs_apply" name="tcs_apply" value="<?= $sq_tcs['apply'] ?>">
<input type="hidden" id="tcs_calc" name="tcs_calc" value="<?= $sq_tcs['calc'] ?>">
<input type="hidden" id="atax_apply_on" name="atax_apply_on" value="<?php echo $reflections[0]->tax_apply_on ?>">
<input type="hidden" id="tax_value1" name="tax_value1" value="<?php echo $reflections[0]->tax_value ?>">

<div class="bk_tab_head bg_light">
    <ul>
        <li>
            <a href="javascript:void(0)" id="tab_1_head" class="active">
                <span class="num">1<i class="fa fa-check"></i></span><br>
                <span class="text">Tour Details</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)" id="tab_2_head">
                <span class="num">2<i class="fa fa-check"></i></span><br>
                <span class="text">Travelling</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)" id="tab_3_head">
                <span class="num">3<i class="fa fa-check"></i></span><br>
                <span class="text">Costing</span>
            </a>
        </li>
    </ul>
</div>

<div class="bk_tabs">
    <div id="tab_1" class="bk_tab active">
        <?php include_once('tab_1/tab_1.php') ?>
    </div>
    <div id="tab_2" class="bk_tab">
        <?php include_once('tab_2/tab_2.php') ?>
    </div>
    <div id="tab_3" class="bk_tab">
        <?php include_once('tab_3/tab_3.php') ?>
    </div>
</div>
<script src="<?= BASE_URL ?>js/app/field_validation.js"></script>

<script src="../js/calculations.js"></script>
<script src="../js/business_rule.js"></script>
<?php 
include_once('../../layouts/fullwidth_app_footer.php');
?>