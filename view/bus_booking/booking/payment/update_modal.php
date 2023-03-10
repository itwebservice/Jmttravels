<?php
include "../../../../model/model.php";
$role = $_SESSION['role'];
$branch_admin_id = $_SESSION['branch_admin_id']; 
$branch_status = $_POST['branch_status'];
$payment_id = $_POST['payment_id'];

$sq_payment_info = mysqli_fetch_assoc(mysqlQuery("select * from bus_booking_payment_master where payment_id='$payment_id'"));

$sq_booking = mysqli_fetch_assoc(mysqlQuery("select * from bus_booking_master where booking_id='$sq_payment_info[booking_id]'"));
$date = $sq_booking['created_at'];
$yr = explode("-", $date);
$year =$yr[0];

$enable = ($sq_payment_info['payment_mode']=="Cash" || $sq_payment_info['payment_mode']=="Credit Note"|| $sq_payment_info['payment_mode']=="Credit Card"|| $sq_payment_info['payment_mode'] == "Advance") ? "disabled" : "";
?>

<div class="modal fade" id="update_modal" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Receipt</h4>
      </div>
      <div class="modal-body">

        <form id="frm_update">

			   <input type="hidden" id="payment_id_update" name="payment_id_update" value="<?= $payment_id ?>">
         <input type="hidden" id="payment_old_value" name="payment_old_value" value="<?= $sq_payment_info['payment_amount'] ?>">

         <div class="row mg_bt_10">
          <div class="col-md-3">
              <select name="customer_id" id="customer_id" title="Customer Name" style="width:100%" disabled onchange="booking_dropdown_load('customer_id', 'booking_id');" disabled>
                <?php 
                $sq_customer = mysqli_fetch_assoc(mysqlQuery("select * from customer_master where customer_id='$sq_booking[customer_id]'"));
                if($sq_customer['type']=='Corporate'||$sq_customer['type'] == 'B2B'){
                ?>
                  <option value="<?= $sq_customer['customer_id'] ?>"><?= $sq_customer['company_name'] ?></option>
                <?php }  else{ ?>
                  <option value="<?= $sq_customer['customer_id'] ?>"><?= $sq_customer['first_name'].' '.$sq_customer['last_name'] ?></option>
                <?php } ?>
                <?php get_customer_dropdown($role,$branch_admin_id,$branch_status); ?>
              </select>
          </div>
          <div class="col-md-3">
            <select name="booking_id" id="booking_id" style="width:100%" disabled>              
			         <option value="<?= $sq_booking['booking_id'] ?>"><?= get_bus_booking_id($sq_booking['booking_id'],$year) ?></option>
              <?php
              $sq_booking = mysqlQuery("select * from bus_booking_master where customer_id='$sq_booking[customer_id]' and delete_status='0'");
              while($row_booking = mysqli_fetch_assoc($sq_booking)){
                ?>
                <option value="<?= $row_booking['booking_id'] ?>"><?= get_bus_booking_id($row_booking['booking_id'],$year) ?></option>
                <?php
              }
              ?>
            </select>
          </div>
          <div class="col-md-3">
            <input type="text" id="payment_date" name="payment_date" placeholder="Date" readonly title="Date" value="<?= date('d-m-Y', strtotime($sq_payment_info['payment_date'])) ?>">
          </div>
          <div class="col-md-3">
            <input type="text" id="payment_amount" name="payment_amount" placeholder="Amount" title="Amount" value="<?= $sq_payment_info['payment_amount'] ?>" onchange="validate_balance(this.id);get_credit_card_charges('identifier','payment_mode','payment_amount','credit_card_details1','credit_charges1');">
          </div>          
        </div>
        <div class="row mg_bt_10">
          <div class="col-md-3">
            <select name="payment_mode" id="payment_mode" disabled title="Mode" onchange="payment_master_toggles(this.id, 'bank_name', 'transaction_id', 'bank_id')">
                <option value="<?= $sq_payment_info['payment_mode'] ?>"><?= $sq_payment_info['payment_mode'] ?></option>
                <?php get_payment_mode_dropdown(); ?>
            </select>
          </div>
          <div class="col-md-3">
            <input type="text" id="bank_name" name="bank_name"  class="form-control bank_suggest" placeholder="Bank Name" title="Bank Name" value="<?= $sq_payment_info['bank_name'] ?>" <?= $enable ?>>
          </div>
          <div class="col-md-3">
            <input type="number" id="transaction_id" name="transaction_id" onchange="validate_specialChar(this.id)" placeholder="Cheque No/ID" title="Cheque No/ID" value="<?= $sq_payment_info['transaction_id'] ?>" <?= $enable ?>>
          </div>
          <div class="col-md-3">
            <select name="bank_id" id="bank_id" title="Creditor Bank" <?= $enable ?> disabled>
              <?php 
              $sq_bank = mysqli_fetch_assoc(mysqlQuery("select * from bank_master where bank_id='$sq_payment_info[bank_id]'"));
              if($sq_bank['bank_id'] != ''){
              ?>
              <option value="<?= $sq_bank['bank_id'] ?>"><?= $sq_bank['bank_name'] ?></option>
              <?php } get_bank_dropdown(); ?>
            </select>
          </div>
        </div>
        <?php if($sq_payment_info['payment_mode'] == 'Credit Card'){?>
        <div class="row mg_tp_10">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <input type="text" id="credit_charges1" name="credit_charges1" title="Credit card charges" value="<?=$sq_payment_info['credit_charges']?>" disabled>
            <input type="hidden" id="credit_charges_old" name="credit_charges_old" title="Credit card charges" value="<?=$sq_payment_info['credit_charges']?>" disabled>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <input class="text" type="text" id="credit_card_details1" name="credit_card_details1" title="Credit card details"  value="<?= $sq_payment_info['credit_card_details'] ?>" disabled>
          </div>
        </div>
        <?php } ?>

        <input type="hidden" id="canc_status1" name="canc_status" value="<?= $sq_payment_info['status'] ?>" class="form-control"/>
        <div class="row text-center mg_tp_20">
            <div class="col-md-12">
              <button class="btn btn-sm btn-success" id="bus_p_update"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Update</button>
            </div>
        </div>

        </form>
        
      </div>     
    </div>
  </div>
</div>

<script>
$('#customer_id, #booking_id').select2();
$('#payment_date').datetimepicker({ timepicker:false, format:'d-m-Y' });

$('#update_modal').modal('show');  
$(function(){

$('#frm_update').validate({
  rules:{
    booking_id : { required : true },
    payment_date : { required : true },
    payment_amount : { required : true, number: true },
    payment_mode : { required : true },  
    bank_id : { required : function(){  if($('#payment_mode').val()!="Cash"){ return true; }else{ return false; }  }  },     
  },
  submitHandler:function(form){

    var payment_id = $('#payment_id_update').val();
    var booking_id = $('#booking_id').val();
    var payment_date = $('#payment_date').val();
    var payment_amount = $('#payment_amount').val();
    var payment_mode = $('#payment_mode').val();
    var bank_name = $('#bank_name').val();
    var transaction_id = $('#transaction_id').val();  
    var bank_id = $('#bank_id').val();
    var payment_old_value = $('#payment_old_value').val();
    var credit_charges = $('#credit_charges1').val();
    var credit_card_details = $('#credit_card_details1').val();
    var credit_charges_old = $('#credit_charges_old').val();
    var canc_status = $('#canc_status1').val();

    if(!check_updated_amount(payment_old_value,payment_amount)){
      error_msg_alert("You can update receipt to 0 only!");
      return false;
    }

    $('#bus_p_update').button('loading');

      $.ajax({
        type: 'post',
        url: base_url()+'controller/bus_booking/payment/payment_update.php',
        data:{ payment_id : payment_id, booking_id : booking_id, payment_date : payment_date, payment_amount : payment_amount, payment_mode : payment_mode, bank_name : bank_name, transaction_id : transaction_id, bank_id : bank_id, payment_old_value : payment_old_value,credit_card_details:credit_card_details,credit_charges_old:credit_charges_old,credit_charges:credit_charges,canc_status:canc_status },
        success: function(result){
          var msg = result.split('-');
          if(msg[0]=='error'){
            msg_alert(result);
            $('#bus_p_update').button('reset');
          }
          else{
            msg_alert(result);
            reset_form('frm_update');
            $('#bus_p_update').button('reset');
            $('#update_modal').modal('hide');  
            list_reflect();
          }
          
        }
      });
  }
});

});
</script>
<script src="<?php echo BASE_URL ?>js/app/footer_scripts.js"></script>