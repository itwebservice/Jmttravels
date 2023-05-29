<?php
include '../../crm/model/model.php';
$role = $_SESSION['role'];
$role_id = $_SESSION['role_id'];
$branch_admin_id = $_SESSION['branch_admin_id'];
$financial_year_id = $_SESSION['financial_year_id'];
$sq = mysqli_fetch_assoc(mysqlQuery("select * from branch_assign where link='visa_passport_ticket/visa/index.php'"));
$branch_status = $sq['branch_status'];
?>
<input type="hidden" id="branch_admin_id1" name="branch_admin_id1" value="<?= $branch_admin_id ?>">
<input type="hidden" id="financial_year_id" name="financial_year_id" value="<?= $financial_year_id ?>">

<input type="hidden" id="unique_timestamp" name="unique_timestamp" value="<?= md5(time()) ?>">
<input type="hidden" id="hotel_sc" name="hotel_sc">
<input type="hidden" id="hotel_markup" name="hotel_markup">
<input type="hidden" id="hotel_taxes" name="hotel_taxes">
<input type="hidden" id="hotel_markup_taxes" name="hotel_markup_taxes">
<input type="hidden" id="hotel_tds" name="hotel_tds">

<div class="modal fade" id="visa_save_modal" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document" style="min-width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">New Visa Booking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                    <form id="visa_booking_frm" class="mt-5 mb-5">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="" id="" placeholder="*Customer Name" title="Customer Name" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <input type="email" name="" id="" placeholder="*Email ID" title="Email ID" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="" id="" placeholder="*Mobile No" title="Mobile No" class="form-control">
                            </div>
                            
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <h5>Passenger Details</h5>
                            </div>
                            <div class="col-xs-12 text-right text_center_xs">
								<button type="button" class="btn btn-info btn-sm ico_left" onClick="addRow('tbl_dynamic_visa')"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add</button>
								<button type="button" class="btn btn-danger btn-sm ico_left" onClick="deleteRow('tbl_dynamic_visa');alltable_visa_cost('tbl_dynamic_visa');"><i class="fa fa-times"></i>&nbsp;&nbsp;Delete</button>
							</div>
                            <div class="col-md-12">
								<div class="table-responsive">
									<?php $offset = ""; ?>
									<table id="tbl_dynamic_visa" name="tbl_dynamic_visa" class="table table-bordered no-marg pd_bt_51" style="width:1685px">
										<?php include_once('visa_member_tbl.php'); ?>
									</table>
								</div>
							</div>
                        </div>

                    </form>
                


            </div>
        </div>
    </div>
</div>

<script>
    $('#visa_save_modal').modal('show');
    // $('#vcurrency_code').select2();
    // $('#expiry_date1,#payment_date,#due_date,#booking_date').datetimepicker({
    //     timepicker: false,
    //     format: 'd-m-Y',
    // });
   
</script>
<script src="<?php echo BASE_URL ?>js/app/footer_scripts.js"></script>
<script src="<?php echo BASE_URL ?>js/app/validation.js"></script>