<?php
include "../../../../model/model.php";
$role = $_SESSION['role'];
$branch_admin_id = $_SESSION['branch_admin_id'];
$branch_status = $_POST['branch_status'];
$visa_id = $_POST['visa_id'];

$sq_visa_info = mysqli_fetch_assoc(mysqlQuery("select * from visa_master where visa_id='$visa_id' and delete_status='0'"));
$reflections = json_decode($sq_visa_info['reflections']);
if ($reflections[0]->tax_apply_on == '1') {
    $tax_apply_on = 'Basic Amount';
} else if ($reflections[0]->tax_apply_on == '2') {
    $tax_apply_on = 'Service Charge';
} else if ($reflections[0]->tax_apply_on == '3') {
    $tax_apply_on = 'Total';
} else {
    $tax_apply_on = '';
}
?>
<div class="modal fade" id="visa_update_modal" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document" style="min-width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Visa Booking</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="booking_id" name="booking_id" value="<?= $visa_id ?>">
                <input type="hidden" id="hotel_sc" name="hotel_sc" value="<?php echo $reflections[0]->hotel_sc ?>">
                <input type="hidden" id="hotel_markup" name="hotel_markup" value="<?php echo $reflections[0]->hotel_markup ?>">
                <input type="hidden" id="hotel_taxes" name="hotel_taxes" value="<?php echo $reflections[0]->hotel_taxes ?>">
                <input type="hidden" id="hotel_markup_taxes" name="hotel_markup_taxes" value="<?php echo $reflections[0]->hotel_markup_taxes ?>">
                <input type="hidden" id="hotel_tds" name="hotel_tds" value="<?php echo $reflections[0]->hotel_tds ?>">

                <input type="hidden" id="tax_apply_on" name="tax_apply_on" value="<?php echo $tax_apply_on ?>">
                <input type="hidden" id="atax_apply_on" name="atax_apply_on" value="<?php echo $reflections[0]->tax_apply_on ?>">
                <input type="hidden" id="tax_value1" name="tax_value1" value="<?php echo $reflections[0]->tax_value ?>">
                <input type="hidden" id="markup_tax_value1" name="markup_tax_value1" value="<?php echo $reflections[0]->markup_tax_value ?>">
                <form id="frm_visa_update" name="frm_visa_save">

                    <input type="hidden" id="visa_id_hidden" name="visa_id_hidden" value="<?= $visa_id ?>">

                    <div class="panel panel-default panel-body fieldset">
                        <legend>Customer Details</legend>

                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10_xs">
                                <select name="customer_id1" id="customer_id1" style="width:100%" onchange="customer_info_load('1')" disabled>
                                    <?php
                                    $sq_customer = mysqli_fetch_assoc(mysqlQuery("select * from customer_master where customer_id='$sq_visa_info[customer_id]'"));
                                    if ($sq_customer['type'] == 'Corporate' || $sq_customer['type'] == 'B2B') {
                                    ?>
                                        <option value="<?= $sq_customer['customer_id'] ?>">
                                            <?= $sq_customer['company_name'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $sq_customer['customer_id'] ?>">
                                            <?= $sq_customer['first_name'] . ' ' . $sq_customer['last_name'] ?></option>
                                    <?php } ?>
                                    <?php get_customer_dropdown($role, $branch_admin_id, $branch_status); ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10_xs">
                                <input type="text" id="email_id1" name="email_id1" placeholder="Email ID" title="Email ID" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10_xs">
                                <input type="text" id="mobile_no1" name="mobile_no1" placeholder="Mobile No" title="Mobile No" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10_xs">
                                <input type="text" id="company_name1" class="hidden" name="company_name1" title="Company Name" placeholder="Company Name" title="Company Name" readonly>
                            </div>
                        </div>
                        <script>
                            customer_info_load('1');
                        </script>

                    </div>

                    <div class="panel panel-default panel-body fieldset mg_tp_30">
                        <legend>Passenger Details</legend>

                        <div class="row mg_bt_10">
                            <div class="col-xs-12 text-right text_center_xs">
                                <button type="button" class="btn btn-info btn-sm ico_left" onClick="addRow('tbl_dynamic_visa_update')"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-responsive">
                                    <?php $offset = ""; ?>
                                    <table id="tbl_dynamic_visa_update" name="tbl_dynamic_visa_update" class="table table-bordered no-marg pd_bt_51" style="width:1685px">
                                        <?php
                                        $offset = "_u";
                                        $sq_entry_count = mysqli_num_rows(mysqlQuery("select * from visa_master_entries where visa_id='$visa_id'"));
                                        if ($sq_entry_count == 0) {
                                            include_once('visa_member_tbl.php');
                                        } else {
                                            $count = 0;
                                            $bg = "";
                                            $sq_entry = mysqlQuery("select * from visa_master_entries where visa_id='$visa_id'");
                                            while ($row_entry = mysqli_fetch_assoc($sq_entry)) {
                                                if ($row_entry['status'] == 'Cancel') {
                                                    $bg = "danger";
                                                } else {
                                                    $bg = "FFF";
                                                }
                                                $count++;
                                        ?>
                                                <tr class="<?= $bg ?>">
                                                    <td><input class="css-checkbox" id="chk_visa<?= $offset . $count ?>_d" type="checkbox" checked disabled><label class="css-label" for="chk_visa<?= $offset ?>"> <label></td>
                                                    <td><input maxlength="15" value="<?= $count ?>" type="text" name="username" placeholder="Sr. No." class="form-control" disabled /></td>
                                                    <td><input class="form-control" type="text" id="first_name<?= $offset . $count ?>_d" onchange="fname_validate(this.id)" name="first_name<?= $offset . $count ?>_d" placeholder="First Name" title="First Name" value="<?= $row_entry['first_name'] ?>" style="width:150px;" /></td>
                                                    <td><input class="form-control" type="text" id="middle_name<?= $offset . $count ?>_d" name="middle_name<?= $offset . $count ?>_d" onchange="fname_validate(this.id)" placeholder="Middle Name" title="Middle Name" value="<?= $row_entry['middle_name'] ?>" style="width:150px;" /></td>
                                                    <td><input class="form-control" type="text" id="last_name<?= $offset . $count ?>_d" name="last_name<?= $offset . $count ?>_d" onchange="fname_validate(this.id)" placeholder="Last Name" title="Last Name" value="<?= $row_entry['last_name'] ?>" style="width:150px;" /></td>
                                                    <td><input type="text" id="birth_date<?= $offset . $count ?>_d" name="birth_date<?= $offset . $count ?>_d" placeholder="Birth Date" title="Birth Date" class="form-control app_datepicker" onchange="adolescence_reflect(this.id)" value="<?= get_date_user($row_entry['birth_date']) ?>" style="width:150px;" /></td>
                                                    <td style="width:80px"><input type="text" id="adolescence<?= $offset . $count ?>_d" name="adolescence<?= $offset . $count ?>_d" placeholder="Adolescence" title="Adolescence" readonly value="<?= $row_entry['adolescence'] ?>" style="width:150px;" />
                                                    </td>
                                                    <td><select name="visa_country_name<?= $offset ?>1" id="visa_country_name<?= $offset ?>1" title="Visa Country Name" style="width:150px" class="form-control app_select2">
                                                            <option value="<?= $row_entry['visa_country_name'] ?>">
                                                                <?= $row_entry['visa_country_name'] ?></option>
                                                            <?php
                                                            $sq_country = mysqlQuery("select * from country_list_master");
                                                            while ($row_country = mysqli_fetch_assoc($sq_country)) {
                                                            ?>
                                                                <option value="<?= $row_country['country_name'] ?>">
                                                                    <?= $row_country['country_name'] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td><select name="visa_type<?= $offset ?>1" id="visa_type<?= $offset ?>1" title="Visa Type" class="form-control" style="width:150px;">
                                                            <option value="<?= $row_entry['visa_type'] ?>">
                                                                <?= $row_entry['visa_type'] ?></option>
                                                            <?php
                                                            $sq_visa_type = mysqlQuery("select * from visa_type_master");
                                                            while ($row_visa_type = mysqli_fetch_assoc($sq_visa_type)) {
                                                            ?>
                                                                <option value="<?= $row_visa_type['visa_type'] ?>">
                                                                    <?= $row_visa_type['visa_type'] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" id="passport_id<?= $offset . $count ?>_d" name="passport_id<?= $offset . $count ?>_d" placeholder="Passport ID" title="Passport ID" value="<?= $row_entry['passport_id'] ?>" onchange="validate_passport(this.id);" style="text-transform: uppercase;width:150px;" class="form-control" /></td>
                                                    <td><input type="text" id="issue_date<?= $offset ?>1" name="issue_date<?= $offset ?>1" class="form-control app_datepicker" placeholder="Issue Date" title="Issue Date" value="<?= get_date_user($row_entry['issue_date']) ?>" onchange="checkPassportDate(this.id);" style="width:110px;" /></td>
                                                    <td><input type="text" id="expiry_date<?= $offset ?>1" name="expiry_date<?= $offset ?>1" class="form-control app_datepicker" placeholder="Expiry Date" title="Expiry Date" value="<?= get_date_user($row_entry['expiry_date']) ?>" onchange="validate_issueDate('issue_date<?= $offset ?>1',this.id)" style="width:110px;"></td>
                                                    <td><input type="text" id="nationality<?= $offset ?>1" name="nationality<?= $offset ?>1" onchange="validate_city(this.id)" placeholder="*Nationality" title="Nationality" value="<?= $row_entry['nationality'] ?>" class="form-control" style="width:150px;" /></td>
                                                    <td><input type="text" id="appointment<?= $offset ?>1" name="appointment<?= $offset ?>1" class="form-control app_datepicker" placeholder="Appointment Date" title="Appointment Date" value="<?= get_date_user($row_entry['appointment_date']) ?>" style="width:150px;"></td>
                                                    <td><input class="form-control app_datepicker" type="text" id="start_date<?= $offset . $count ?>" value="<?= $row_entry['start_date'] ?>" name="start_date<?= $offset ?>1" placeholder="Travel Start Date" title="Travel Start Date" style="width:160px;"></td>
                                                    <td><input class="form-control app_datepicker" type="text" id="end_date<?= $offset . $count ?>" name="end_date<?= $offset ?>1" placeholder="Travel End Date" value="<?= $row_entry['end_date'] ?>" title="Travel End Date" style="width:160px;"></td>
                                                    <td><select name="status_type<?= $offset ?>1" id="status_type<?= $offset . $count ?>" class="app_select2 form-control" title="Status" style="width:150px">
                                                            <option value="">*Status</option>
                                                            <option value="Unused" <?= $row_entry['pass_status'] == "Unused" ? "selected"  : "" ?>>Unused</option>
                                                            <option value="In-Use" <?= $row_entry['pass_status'] == "In-Use" ? "selected"  : "" ?>>In-Use</option>
                                                            <option value="Completed" <?= $row_entry['pass_status'] == "Completed" ? "selected"  : "" ?>>Completed</option>
                                                            <option value="Cancelled" <?= $row_entry['pass_status'] == "Cancelled" ? "selected"  : "" ?>>Cancelled</option>
                                                            <option value="Visa Expired" <?= $row_entry['pass_status'] == "Visa Expired" ? "selected" : "" ?>>Visa Expired</option>
                                                            <option value="Documents received" <?= $row_entry['pass_status'] == "Documents received" ? "selected" : "" ?>>Documents received</option>
                                                            <option value="Documents pending" <?= $row_entry['pass_status'] == "Documents pending" ? "selected" : "" ?>>Documents pending</option>
                                                            <option value="Hold" <?= $row_entry['pass_status'] == "Hold" ? "selected" : "" ?>>Hold</option>
                                                            <option value="Return" <?= $row_entry['pass_status'] == "Return" ? "selected" : "" ?>>Return</option>
                                                            <option value="Proceed" <?= $row_entry['pass_status'] == "Proceed" ? "selected" : "" ?>>Proceed</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" placeholder="Mother Name" style="width:150px" name="mother_name" value="<?= $row_entry['mother_name'] ?>" id="mother_name<?= $offset . $count ?>" class="form-control" title="Mother Name">
                                                    </td>
                                                    <td><input type="text" placeholder="Father Name" style="width:150px" name="father_name" value="<?= $row_entry['father_name'] ?>" id="father_name<?= $offset . $count ?>" class="form-control" title="Father Name">
                                                    </td>
                                                    <td><input type="text" placeholder="Place Of Issue" style="width:150px" name="place_of_issue" value="<?= $row_entry['place_of_issue'] ?>" id="place_of_issue<?= $offset . $count ?>" class="form-control" title="Place Of Issue">
                                                    </td>
                                                    <td><input type="text" placeholder="Birth Place" style="width:150px" name="birth_place" value="<?= $row_entry['birth_place'] ?>" id="birth_place<?= $offset . $count ?>" class="form-control" title="Birth Place">
                                                    </td>
                                                    <td><input type="text" placeholder="Birth Country" style="width:150px" name="birth_country" value="<?= $row_entry['birth_country'] ?>" id="birth_country<?= $offset . $count ?>" class="form-control" title="Birth Country">
                                                    </td>
                                                    <td><select style="width:150px" name="marital_status" id="marital_status<?= $offset . $count ?>" class="form-control" title="Marital Status">
                                                            <option value="">Marital Status</option>
                                                            <option value="Married" <?= $row_entry['marital_status'] == "Married" ? "selected" : ""  ?>>Married</option>
                                                            <option value="Unmarried" <?= $row_entry['marital_status'] == "Unmarried" ? "selected" : ""  ?>>Unmarried</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" placeholder="Documents Nationality" style="width:150px" name="documents_nationality" value="<?= $row_entry['documents_nationality'] ?>" id="documents_nationality<?= $offset . $count ?>" class="form-control" title="Documents Nationality">
                                                    </td>
                                                    <td><input type="text" placeholder="Travel Document Type" style="width:150px" name="travel_document_type" value="<?= $row_entry['travel_document_type'] ?>" id="travel_document_type<?= $offset . $count ?>" class="form-control" title="Travel Document Type">
                                                    </td>
                                                    <td><select style="width:150px" name="gender" id="gender<?= $offset . $count ?>" class="form-control" title="Gender">
                                                            <option value="">Gender</option>
                                                            <option value="Male" <?= $row_entry['gender'] == "Male" ? "selected" : ""  ?>>Male</option>
                                                            <option value="Female" <?= $row_entry['gender'] == "Female" ? "selected" : ""  ?>>Female</option>
                                                        </select>
                                                    </td>
                                                    <td class="hidden"><input type="text" value="<?= $row_entry['entry_id'] ?>">
                                                    </td>
                                                    <td><input type="hidden" id="visa_cost<?= $offset ?>1" name="visa_cost<?= $offset ?>1"></td>
                                                </tr>
                                                <script>
                                                    $("#birth_date<?= $offset . $count ?>_d, #issue_date<?= $offset ?>1")
                                                        .datetimepicker({
                                                            timepicker: false,
                                                            format: 'd-m-Y'
                                                        });
                                                    $('#expiry_date<?= $offset ?>1').datetimepicker({
                                                        timepicker: false,
                                                        format: 'd-m-Y'
                                                    });
                                                    var date = new Date();
                                                    var yest = date.setDate(date.getDate() - 1);
                                                    var tom = date.setDate(date.getDate() + 1);
                                                    $('#appointment<?= $offset ?>1').datetimepicker({
                                                        timepicker: false,
                                                        minDate: tom,
                                                        format: 'd-m-Y'
                                                    });
                                                    $('#start_date<?= $offset . $count ?>').datetimepicker({
                                                        timepicker: false,

                                                        format: 'd-m-Y'
                                                    });
                                                    $('#end_date<?= $offset . $count ?>').datetimepicker({
                                                        timepicker: false,

                                                        format: 'd-m-Y'
                                                    });
                                                    $('#visa_country_name<?= $offset ?>1').select2();
                                                </script>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php
                    $visa_issue_amount = $sq_visa_info['visa_issue_amount'];
                    $service_charge = $sq_visa_info['service_charge'];
                    $markup = $sq_visa_info['markup'];

                    $bsmValues = json_decode($sq_visa_info['bsm_values']);
                    $service_tax_amount = 0;
                    if ($sq_visa_info['service_tax_subtotal'] !== 0.00 && ($sq_visa_info['service_tax_subtotal']) !== '') {
                        $service_tax_subtotal1 = explode(',', $sq_visa_info['service_tax_subtotal']);
                        for ($i = 0; $i < sizeof($service_tax_subtotal1); $i++) {
                            $service_tax = explode(':', $service_tax_subtotal1[$i]);
                            $service_tax_amount = $service_tax_amount + $service_tax[2];
                        }
                    }
                    $markupservice_tax_amount = 0;
                    if ($sq_visa_info['markup_tax'] !== 0.00 && $sq_visa_info['markup_tax'] !== "") {
                        $service_tax_markup1 = explode(',', $sq_visa_info['markup_tax']);
                        for ($i = 0; $i < sizeof($service_tax_markup1); $i++) {
                            $service_tax = explode(':', $service_tax_markup1[$i]);
                            $markupservice_tax_amount = $markupservice_tax_amount + $service_tax[2];
                        }
                    }
                    foreach ($bsmValues[0] as $key => $value) {
                        switch ($key) {
                            case 'basic':
                                $visa_issue_amount = ($value != "") ? $visa_issue_amount + $service_tax_amount : $visa_issue_amount;
                                $inclusive_b = $value;
                                break;
                            case 'service':
                                $service_charge = ($value != "") ? $service_charge +  $service_tax_amount : $service_charge;
                                $inclusive_s = $value;
                                break;
                            case 'markup':
                                $markup = ($value != "") ? $markup + $markupservice_tax_amount : $markup;
                                $inclusive_m = $value;
                                break;
                        }
                    }
                    // echo "<pre>";
                    // var_dump($bsmValues)
                    ?>
                    <div class="panel panel-default panel-body fieldset mg_tp_30">
                        <legend>Costing Details</legend>

                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <small id="basic_show1" style="color:red"><?= ($inclusive_b == '') ? '&nbsp;' : 'Inclusive Amount : <span>' . $inclusive_b ?></span></small>
                                <input type="number" id="visa_issue_amount1" name="visa_issue_amount1" placeholder="Basic Amount" title="Basic Amount" value="<?= $visa_issue_amount ?>" onchange="get_auto_values('balance_date1','visa_issue_amount1','payment_mode','service_charge1','markup1','update','true','service_charge','discount1');validate_balance(this.id);calculate_total_amount('1')">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">
                                <small id="service_show1" style="color:red"><?= ($inclusive_s == '') ? '&nbsp;' : 'Inclusive Amount : <span>' . $inclusive_s ?></span></small>
                                <input type="text" name="service_charge1" id="service_charge1" placeholder="Service Charge" title="Service Charge" value="<?= $service_charge ?>" onchange="validate_balance(this.id);get_auto_values('balance_date1','visa_issue_amount1','payment_mode','service_charge1','markup1','update','true','service_charge','discount')">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">
                                <small>&nbsp;</small>
                                <input type="text" name="service_tax_subtotal1" id="service_tax_subtotal1" placeholder="Tax Amount" title="Tax Amount" value="<?= $sq_visa_info['service_tax_subtotal'] ?>" onchange="validate_balance(this.id);" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">
                                <small id="markup_show1" style="color:red"><?= ($inclusive_m == '') ? '&nbsp;' : 'Inclusive Amount : <span>' . $inclusive_m ?></span></small>
                                <input type="text" id="markup1" name="markup1" placeholder="Markup " title="Markup" onchange="validate_balance(this.id);get_auto_values('balance_date1','visa_issue_amount1','payment_mode','service_charge1','markup1','update','true','markup','discount1');" value="<?= $markup ?>">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">
                                <input type="text" id="service_tax_markup1" name="service_tax_markup1" placeholder="Tax on Markup" title="Tax on Markup" value="<?= $sq_visa_info['markup_tax'] ?>" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">
                                <input type="text" name="roundoff1" id="roundoff1" class="text-right" placeholder="Round Off" title="RoundOff" value="<?= $sq_visa_info['roundoff'] ?> " readonly>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">
                                <input type="text" name="visa_total_cost1" id="visa_total_cost1" class="amount_feild_highlight text-right" placeholder="Net Total" title="Net Total" value="<?= $sq_visa_info['visa_total_cost'] ?>" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">
                                <input type="text" name="due_date1" id="due_date1" placeholder="Due Date" title="Due Date" value="<?= get_date_user($sq_visa_info['due_date']) ?>">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">
                                <input type="text" name="balance_date1" id="balance_date1" value="<?= date('d-m-Y', strtotime($sq_visa_info['created_at'])) ?>" placeholder="Booking Date" title="Booking Date" onchange="check_valid_date(this.id);get_auto_values('balance_date1','visa_issue_amount1','payment_mode','service_charge1','markup1','update','false','markup','discount1',true);">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mg_bt_10">
                                <select name="currency_code" id="vcurrency_code1" title="Currency" style="width:100%" data-toggle="tooltip" required>
                                    <?php
                                    $sq_app_setting = mysqli_fetch_assoc(mysqlQuery("select currency_code from visa_master where visa_id='$sq_visa_info[visa_id]'"));
                                    $sq_currencyd = mysqli_fetch_assoc(mysqlQuery("SELECT `id`,`currency_code` FROM `currency_name_master` WHERE id=" . $sq_app_setting['currency_code']));
                                    ?>
                                    <option value="<?= $sq_currencyd['id'] ?>"><?= $sq_currencyd['currency_code'] ?>
                                    </option>
                                    <?php
                                    $sq_currency = mysqlQuery("select * from currency_name_master order by currency_code");
                                    while ($row_currency = mysqli_fetch_assoc($sq_currency)) {
                                    ?>
                                        <option value="<?= $row_currency['id'] ?>"><?= $row_currency['currency_code'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col-md-12">
                            <button class="btn btn-sm btn-success" id="visa_update"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Update</button>
                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL ?>js/app/footer_scripts.js"></script>
<script>
    $('#customer_id1,#vcurrency_code1').select2();
    $('#due_date1,#balance_date1').datetimepicker({
        timepicker: false,
        format: 'd-m-Y'
    });

    var date = new Date();
    var yest = date.setDate(date.getDate() - 1);

    $('#birth_date1,#issue_date_u1').datetimepicker({
        timepicker: false,
        maxDate: yest,
        format: 'd-m-Y'
    });

    $('#visa_update_modal').modal('show');
    //check future date
    function checkPassportDate(id) {
        var date1 = document.getElementById(id).value;
        var dates = date1.split("-");
        dates = new Date(dates[2], dates[1] - 1, dates[0]).getTime();
        if (dates == '') {
            error_msg_alert('Please enter the Date..!!');
            return false;
        } else if (!date1.match(/^(0[1-9]|[12][0-9]|3[01])[\- \/.](?:(0[1-9]|1[012])[\- \/.](19|20)[0-9]{2})$/)) {
            error_msg_alert('Date format is wrong');
            return false;
        }

        var today = new Date().getTime()
        date = Date.parse(date);
        if (today < dates) {
            error_msg_alert("Date cannot be future date");
            $('#' + id).css({
                'border': '1px solid red'
            });
            document.getElementById(id).value = "";
            $('#' + id).focus();
            g_validate_status = false;
            return false;
        }
    }

    function validate_issueDate(from, to) {
        var from_date = $('#' + from).val();
        var to_date = $('#' + to).val();

        var parts = from_date.split('-');
        var date = new Date();
        var new_month = parseInt(parts[1]) - 1;
        date.setFullYear(parts[2]);
        date.setDate(parts[0]);
        date.setMonth(new_month);

        var parts1 = to_date.split('-');
        var date1 = new Date();
        var new_month1 = parseInt(parts1[1]) - 1;
        date1.setFullYear(parts1[2]);
        date1.setDate(parts1[0]);
        date1.setMonth(new_month1);

        var one_day = 1000 * 60 * 60 * 24;

        var from_date_ms = date.getTime();
        var to_date_ms = date1.getTime();

        if (from_date_ms > to_date_ms) {
            error_msg_alert(" Date should be greater than passport issue date");
            $('#' + to).css({
                'border': '1px solid red'
            });
            document.getElementById(to).value = "";
            $('#' + to).focus();
            g_validate_status = false;
            return false;
        }
    }
    $(function() {

        $('#frm_visa_update').validate({
            rules: {
                customer_id1: {
                    required: true
                },
                visa_issue_amount1: {
                    required: true,
                    number: true
                },
                service_charge1: {
                    required: true,
                    number: true
                },
                markup1: {
                    required: true,
                    number: true
                },
                visa_total_cost1: {
                    required: true,
                    number: true
                },
                balance_date1: {
                    required: true
                },

            },
            submitHandler: function(form) {
                $('#visa_update').prop('disabled', true);
                var visa_id = $('#visa_id_hidden').val();
                var customer_id = $('#customer_id1').val();
                var visa_issue_amount = $('#visa_issue_amount1').val();
                var service_charge = $('#service_charge1').val();
                var service_tax_subtotal = $('#service_tax_subtotal1').val();
                var visa_total_cost = $('#visa_total_cost1').val();
                var roundoff = $('#roundoff1').val();
                var due_date1 = $('#due_date1').val();
                var balance_date1 = $('#balance_date1').val();
                var markup = $('#markup1').val();
                var service_tax_markup = $('#service_tax_markup1').val();

                var first_name_arr = new Array();
                var middle_name_arr = new Array();
                var last_name_arr = new Array();
                var birth_date_arr = new Array();
                var adolescence_arr = new Array();
                var visa_country_name_arr = new Array();
                var visa_type_arr = new Array();
                var passport_id_arr = new Array();
                var issue_date_arr = new Array();
                var expiry_date_arr = new Array();
                var nationality_arr = new Array();
                var start_date_arr = new Array();
                var end_date_arr = new Array();
                var status_arr = new Array();
                //	var received_documents_arr = new Array();
                var appointment_date_arr = new Array();
                var entry_id_arr = new Array();
                var mother_name_arr = new Array();
                var father_name_arr = new Array();
                var place_of_issue_arr = new Array();
                var birth_place_arr = new Array();
                var birth_country_arr = new Array();
                var marital_status_arr = new Array();
                var documents_nationality_arr = new Array();
                var travel_document_type_arr = new Array();
                var gender_arr = new Array();


                var table = document.getElementById("tbl_dynamic_visa_update");
                var rowCount = table.rows.length;

                for (var i = 0; i < rowCount; i++) {
                    var row = table.rows[i];
                    if (rowCount == 1) {
                        if (!row.cells[0].childNodes[0].checked) {
                            error_msg_alert("Atleast one passenger is required!");
                            $('#visa_update').prop('disabled', false);
                            return false;
                        }
                    }
                    if (row.cells[0].childNodes[0].checked) {
                        var first_name = row.cells[2].childNodes[0].value;
                        var middle_name = row.cells[3].childNodes[0].value;
                        var last_name = row.cells[4].childNodes[0].value;
                        var birth_date = row.cells[5].childNodes[0].value;
                        var adolescence = row.cells[6].childNodes[0].value;
                        var visa_country_name = row.cells[7].childNodes[0].value;
                        var visa_type = row.cells[8].childNodes[0].value;
                        var passport_id = row.cells[9].childNodes[0].value;
                        var issue_date = row.cells[10].childNodes[0].value;
                        var expiry_date = row.cells[11].childNodes[0].value;
                        var nationality = row.cells[12].childNodes[0].value;
                        //var received_documents = "";
                        // $(row.cells[13]).find('option:selected').each(function(){ received_documents += $(this).attr('value')+','; });
                        // received_documents = received_documents.trimChars(",");
                        var apointment = row.cells[13].childNodes[0].value;
                        var start_date = row.cells[14].childNodes[0].value;
                        var end_date = row.cells[15].childNodes[0].value;
                        var pass_status = row.cells[16].childNodes[0].value;
                        var mother_name = row.cells[17].childNodes[0].value;
                        var father_name = row.cells[18].childNodes[0].value;
                        var place_of_issue = row.cells[19].childNodes[0].value;
                        var birth_place = row.cells[20].childNodes[0].value;
                        var birth_country = row.cells[21].childNodes[0].value;
                        var marital_status = row.cells[22].childNodes[0].value;
                        var documents_nationality = row.cells[23].childNodes[0].value;
                        var travel_document_type = row.cells[24].childNodes[0].value;
                        var gender = row.cells[25].childNodes[0].value;



                        if (row.cells[26]) {
                            var entry_id = row.cells[26].childNodes[0].value;
                        } else {
                            var entry_id = "";
                        }

                        var msg = "";
                        if (dateDaysValidation(expiry_date) == false) {
                            $('#visa_update').prop('disabled', false);
                            return false;
                        }
                        if (first_name == "") {
                            msg += "First name is required in row:" + (i + 1) + "<br>";
                        }
                        if (visa_country_name == "") {
                            msg += "Visa Country name is required in row:" + (i + 1) + "<br>";
                        }
                        if (visa_type == "") {
                            msg += "Visa Type is required in row:" + (i + 1) + "<br>";
                        }
                        if (nationality == "") {
                            msg += "Nationality is required in row:" + (i + 1) + "<br>";
                        }
                        if (start_date == "") {
                            msg += "Start Date is required in row:" + (i + 1) + "<br>";
                        }
                        if (end_date == "") {
                            msg += "End Date is required in row:" + (i + 1) + "<br>";
                        }
                        if (pass_status == "") {
                            msg += "Passenger Status is required in row:" + (i + 1) + "<br>";
                        }

                        if (msg != "") {
                            error_msg_alert(msg);
                            $('#visa_update').prop('disabled', false);
                            return false;
                        }

                        first_name_arr.push(first_name);
                        middle_name_arr.push(middle_name);
                        last_name_arr.push(last_name);
                        birth_date_arr.push(birth_date);
                        adolescence_arr.push(adolescence);
                        visa_country_name_arr.push(visa_country_name);
                        visa_type_arr.push(visa_type);
                        passport_id_arr.push(passport_id);
                        issue_date_arr.push(issue_date);
                        expiry_date_arr.push(expiry_date);
                        nationality_arr.push(nationality);
                        //	received_documents_arr.push(received_documents);
                        entry_id_arr.push(entry_id);
                        appointment_date_arr.push(apointment);
                        start_date_arr.push(start_date);
                        end_date_arr.push(end_date);
                        status_arr.push(pass_status);
                        mother_name_arr.push(mother_name);
                        father_name_arr.push(father_name);
                        place_of_issue_arr.push(place_of_issue);
                        birth_place_arr.push(birth_place);
                        birth_country_arr.push(birth_country);
                        marital_status_arr.push(marital_status);
                        documents_nationality_arr.push(documents_nationality);
                        travel_document_type_arr.push(travel_document_type);
                        gender_arr.push(gender);
                    }
                }

                var hotel_sc = $('#hotel_sc').val();
                var hotel_markup = $('#hotel_markup').val();
                var hotel_taxes = $('#hotel_taxes').val();
                var hotel_markup_taxes = $('#hotel_markup_taxes').val();
                var hotel_tds = $('#hotel_tds').val();
                var tax_apply_on = $('#atax_apply_on').val();
                var tax_value = $('#tax_value1').val();
                var markup_tax_value = $('#markup_tax_value1').val();
                var reflections = [];
                reflections.push({
                    'hotel_sc': hotel_sc,
                    'hotel_markup': hotel_markup,
                    'hotel_taxes': hotel_taxes,
                    'hotel_markup_taxes': hotel_markup_taxes,
                    'hotel_tds': hotel_tds,
                    'tax_apply_on': tax_apply_on,
                    'tax_value': tax_value,
                    'markup_tax_value': markup_tax_value
                });
                var bsmValues = [];
                bsmValues.push({
                    "basic": $('#basic_show1').find('span').text(),
                    "service": $('#service_show1').find('span').text(),
                    "markup": $('#markup_show1').find('span').text()
                });
                var currency_code = $('#vcurrency_code1').val();
                var base_url = $('#base_url').val();
                //Validation for booking and payment date in login financial year
                var check_date1 = $('#balance_date1').val();
                $.post(base_url + 'view/load_data/finance_date_validation.php', {
                    check_date: check_date1
                }, function(data) {
                    if (data !== 'valid') {
                        error_msg_alert(
                            "The Booking date does not match between selected Financial year."
                        );
                        $('#visa_update').prop('disabled', false);
                        return false;
                    } else {
                        $('#visa_update').button('loading');
                        $.ajax({
                            type: 'post',
                            url: base_url +
                                'controller/visa_passport_ticket/visa/visa_master_update.php',
                            data: {
                                visa_id: visa_id,
                                customer_id: customer_id,
                                visa_issue_amount: visa_issue_amount,
                                service_charge: service_charge,
                                service_tax_subtotal: service_tax_subtotal,
                                visa_total_cost: visa_total_cost,
                                first_name_arr: first_name_arr,
                                middle_name_arr: middle_name_arr,
                                last_name_arr: last_name_arr,
                                birth_date_arr: birth_date_arr,
                                adolescence_arr: adolescence_arr,
                                visa_country_name_arr: visa_country_name_arr,
                                visa_type_arr: visa_type_arr,
                                passport_id_arr: passport_id_arr,
                                issue_date_arr: issue_date_arr,
                                expiry_date_arr: expiry_date_arr,
                                entry_id_arr: entry_id_arr,
                                due_date1: due_date1,
                                balance_date1: balance_date1,
                                nationality_arr: nationality_arr,
                                appointment_date_arr: appointment_date_arr,
                                markup: markup,
                                service_tax_markup: service_tax_markup,
                                reflections: reflections,
                                bsmValues: bsmValues,
                                roundoff: roundoff,
                                currency_code: currency_code,
                                start_date_arr: start_date_arr,
                                end_date_arr: end_date_arr,
                                status_arr: status_arr,
                                mother_name_arr: mother_name_arr,
                                father_name_arr: father_name_arr,
                                place_of_issue_arr: place_of_issue_arr,
                                birth_place_arr: birth_place_arr,
                                birth_country_arr: birth_country_arr,
                                marital_status_arr: marital_status_arr,
                                documents_nationality_arr: documents_nationality_arr,
                                travel_document_type_arr: travel_document_type_arr,
                                gender_arr: gender_arr
                            },
                            success: function(result) {
                                var msg = result.split('-');
                                if (msg[0] == 'error') {
                                    msg_alert(result);
                                } else {
                                    msg_alert(result);
                                    $('#visa_update').button('reset');
                                    $('#visa_update').prop('disabled', false);
                                    reset_form('frm_visa_update');
                                    $('#visa_update_modal').modal('hide');
                                    visa_customer_list_reflect();
                                }
                            }
                        });
                    }
                });
            }
        });

    });

    function alltable_visa_cost(id) {
        $('#visa_issue_amount1').val(0);
        $('#markup1').val(0);
        var table = document.getElementById(id);
        var rowCount = table.rows.length;
        var total_amt = 0,
            total_markup = 0;
        for (var i = 0; i < rowCount; i++) {
            var row = table.rows[i];
            if (row.cells[0].childNodes[0].checked == true) {
                var amt1 = row.cells[15].childNodes[0].value;
                var amt = amt1.split('-');
                total_amt += parseFloat(amt[0]);
                total_markup += parseFloat(amt[1]);
            }
        }
        if (isNaN(total_amt)) total_amt = 0;
        if (isNaN(total_markup)) total_markup = 0;
        $('#visa_issue_amount1').val(total_amt);
        $('#visa_issue_amount1').trigger('change');
        $('#markup1').val(total_markup);
        $('#markup1').trigger('change');
    }

    function reflect_cost(id) {
        var offset = id.substr(9);

        var table = document.getElementById('tbl_dynamic_visa_update');
        var rowCount = table.rows.length;
        for (var i = 0; i < rowCount; i++) {
            var row = table.rows[i];
            if (row.cells[0].childNodes[0].checked == true) {

                var visa_type = row.cells[8].childNodes[0].value;
                var visa_country = row.cells[7].childNodes[0].value;
                // var visa_type = $('#visa_type'+offset).val(), visa_country = $('#visa_country_name'+offset).val();
                $.post('<?= BASE_URL ?>view/visa_passport_ticket/visa/home/visa_cost_reflect.php', {
                    visa_type: visa_type,
                    visa_country: visa_country
                }, function(data) {
                    var json_data = JSON.parse(data);
                    var amount = isNaN(parseFloat(json_data.amount)) ? 0.00 : parseFloat(json_data.amount);
                    var service = isNaN(parseFloat(json_data.service)) ? 0.00 : parseFloat(json_data.service);
                    // $('#visa_cost'+offset).val(amount+'-'+service);
                    row.cells[15].childNodes[0].value = amount + '-' + service;
                    alltable_visa_cost('tbl_dynamic_visa_update');
                });
            }
        }
    }


    function dateDaysValidation(date1Main) {
		var booking_date = $('#balance_date1').val();
		const date1 = new Date(convertDateString(booking_date));
		const date2 = new Date(convertDateString(date1Main));
		// alert(date1);
		// alert(date2);
		const diffTime = Math.abs(date2 - date1);
		const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
		// alert(diffDays);
		if(diffDays < 185)
		{
			error_msg_alert("Expiry Date and Booking Date Is In 185 Days");
			 return false;
		}
		return true;
	}
	function convertDateString(date1)
	{
			var spDate = date1.split("-");
			return spDate[2]+"-"+spDate[1]+"-"+spDate[0];
	}
</script>