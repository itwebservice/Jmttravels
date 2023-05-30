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
                            <input type="text" name="" id="cust_first_name" placeholder="*Customer Name" title="Customer Name" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <select name="" id="cust_gender" class="form-control">
                                <option value="">Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="" id="cust_birth_date" placeholder="*Date Of Birth" title="Date Of Birth" class="form-control app_datepicker">
                        </div>
                        <div class="col-md-4">
                            <input type="email" name="" id="cust_email_id" placeholder="*Email ID" title="Email ID" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="" id="cust_contact_no" placeholder="*Mobile No" title="Mobile No" class="form-control">
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
                                <table id="tbl_dynamic_visa" name="tbl_dynamic_visa" class="table" style="width:1685px">
                                    <?php include_once('visa_member_tbl.php'); ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <h5>Costing Details</h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Sub Total:</label>
                            <input type="number" name="" id="visa_issue_amount" placeholder="Sub Total" title="Sub Total" class="form-control" disabled>
                        </div>

                        <input type="hidden" id="markup">

                        <div class="col-md-4">
                            <label for="" class="form-label">Tax:</label>
                            <input type="text" id="total_tax" class="form-control disabled" disabled>

                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Total:</label>
                            <input type="number" name="" id="visa_total_cost" placeholder="Total" title="Total" class="form-control" disabled>
                            <input type="hidden" id="due_date" value="<?= date('Y-m-d') ?>">
                            <input type="hidden" id="booking_date" value="<?= date('Y-m-d') ?>">
                            <input type="hidden" id="payment_date" value="<?= date('Y-m-d') ?>">
                            <input type="hidden" id="tax_ledger">
                        </div>
                    </div>

                </form>



            </div>
            <div class="modal-footer text-right">
                <button type="button" onclick="saveData()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#visa_save_modal').modal('show');
    // $('#vcurrency_code').select2();
    $('.app_datepicker').datetimepicker({
        timepicker: false,
        format: 'd-m-Y',
    });


    function adolescence_reflect(id) {
        var dateString1 = $("#" + id).val();
        var today = new Date();
        var birthDate = php_to_js_date_converter(dateString1);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        var d = today.getDate() - birthDate.getDate();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        var millisecondsPerDay = 1000 * 60 * 60 * 24;
        var millisBetween = today.getTime() - birthDate.getTime();
        var days = millisBetween / millisecondsPerDay;

        var count = id.substr(10);
        var adl = "";
        var no_days = Math.floor(days);

        if (no_days <= 730 && no_days > 0) {
            adl = "Infant";
        }
        if (no_days > 730 && no_days <= 4383) {
            adl = "Children";
        }
        if (no_days > 4383) {
            adl = "Adult";
        }

        $('#adolescence' + count).val(adl);

    }

    function reflect_cost(id) {

        var offset = id.substr(9);
        var visa_type = $('#visa_type' + offset).val(),
            visa_country = $('#visa_country_name' + offset).val();
        $.post('<?= BASE_URL ?>view/visa_passport_ticket/visa/home/visa_cost_reflect.php', {
            visa_type: visa_type,
            visa_country: visa_country
        }, function(data) {
            var json_data = JSON.parse(data);
            var amount = isNaN(parseFloat(json_data.amount)) ? 0.00 : parseFloat(json_data.amount);
            var service_charge = isNaN(parseFloat(json_data.service)) ? 0.00 : parseFloat(json_data.service);
            $('#visa_cost' + offset).val(amount + '-' + service_charge);
            alltable_visa_cost();
            get_tax2('visa_country_name1', 'visa_issue_amount', 'Visa');
        });
    }

    function alltable_visa_cost() {
        var table = document.getElementById('tbl_dynamic_visa');
        var total_tax = $('#total_tax').val();

        $('#visa_issue_amount').val(0);
        $('#markup').val(0);
        var rowCount = table.rows.length;
        var total_amt = 0,
            total_markup = 0;
        for (var i = 0; i < rowCount; i++) {
            var row = table.rows[i];
            if (row.cells[0].childNodes[0].checked == true) {
                var amt1 = row.cells[14].childNodes[0].value;
                var amt = amt1.split('-');
                total_amt += parseFloat(amt[0]);
                total_markup += parseFloat(amt[1]);
            }
        }
        if (isNaN(total_amt)) total_amt = 0;
        if (isNaN(total_markup)) total_markup = 0;
        var total_cost = total_amt + total_markup;
        $('#visa_issue_amount').val(total_amt + total_markup);
       
        //
        //Calculating tax amount
        var taxes = total_tax && total_tax.split(',');
        var tax_amount = 0;
        for (var i = 0; i < taxes.length; i++) {

            var single_tax = taxes[i].split(':');
            tax_amount += parseFloat(single_tax[1]);
        }

        var grand_cost = parseFloat(total_cost) + parseFloat(tax_amount);
        $('#visa_total_cost').val(parseFloat(grand_cost).toFixed(2));
        //


        $('#visa_issue_amount').trigger('change');
        $('#markup').val(total_markup);
        $('#markup').trigger('change');
    }

    //tax

    function get_tax2(state_id, total_cost1, travel_type) {

        var cust_state = $('#' + state_id).val();
        var total_cost = $('#' + total_cost1).val();
        var tax_string = '';
        const rules = get_other_rules2(travel_type);
        var applied_taxes = rules && get_service_tax2(rules, cust_state);
        applied_taxes = applied_taxes.split(',');
        if (applied_taxes.length !== 0) {
            var taxes = applied_taxes[0].split('+');
            for (var i = 0; i < taxes.length; i++) {
                if (taxes[i] != '') {

                    var single_tax = taxes[i].split(':');
                    tax_string += single_tax[0];
                    if (single_tax[2] == 'Percentage') {
                        var tax_amount = parseFloat(total_cost) * (parseFloat(single_tax[1]) / 100);
                        tax_string += ':' + (tax_amount).toFixed(2) + ' (' + single_tax[1] + '%) ';
                    } else {
                        var tax_amount = parseFloat(single_tax[1]);
                        tax_string += ':' + (tax_amount).toFixed(2) + ' (' + single_tax[1] + ')';
                    }
                    if (i != (taxes.length - 1)) {
                        tax_string += ', ';
                    }
                }
            }
            $('#tax_ledger').val(applied_taxes[1]);
        } else {
            $('#tax_ledger').val(parseFloat(0));
        }
        $('#total_tax').val(tax_string);
        alltable_visa_cost();
    }

    function get_other_rules2(travel_type) {

        var today = get_today_date2();
        var data = new Date(today);
        let month = data.getMonth() + 1;
        let day = data.getDate();
        let year = data.getFullYear();
        if (day <= 9)
            day = '0' + day;
        if (month < 10)
            month = '0' + month;
        invoice_date = year + '-' + month + '-' + day;

        var cache_rules = JSON.parse($('#cache_currencies').val());
        var taxes = [];
        taxes = (cache_rules.filter((el) =>
            el.entry_id !== '' && el.rule_id === undefined && el.entry_id !== undefined && el.currency_id === undefined
        ));

        //Taxes
        var taxes1 = taxes.filter((tax) => {
            return tax['status'] === 'Active';
        });

        //Tax Rules
        var tax_rules = [];
        tax_rules = (cache_rules.filter((el) =>
            el.rule_id !== '' && el.rule_id !== undefined
        ));

        invoice_date = new Date(invoice_date).getTime();
        var tax_rules1 = tax_rules.filter((rule) => {
            var from_date = new Date(rule['from_date']).getTime();
            var to_date = new Date(rule['to_date']).getTime();

            return (
                rule['status'] === 'Active' &&
                (rule['travel_type'] === travel_type || rule['travel_type'] === 'All') &&
                (rule['validity'] == 'Permanent' || (invoice_date >= from_date && invoice_date <= to_date))
            );
        });

        var result = taxes1.concat(tax_rules1);
        return result;
    }

    function get_service_tax2(result, cust_state) {

        //////////////////////////////
        var taxes_result = result && result.filter((rule) => {
            var {
                entry_id,
                rule_id
            } = rule;
            return entry_id !== '' && !rule_id;
        });
        //////////////////////////////
        var final_taxes_rules = [];
        taxes_result &&
            taxes_result.filter((tax_rule) => {
                var tax_rule_array = [];
                result &&
                    result.forEach((rule) => {
                        if (parseInt(tax_rule['entry_id']) === parseInt(rule['entry_id']) && rule['rule_id'])
                            tax_rule_array.push(rule);
                    });
                final_taxes_rules.push({
                    entry_id: tax_rule['entry_id'],
                    tax_rule_array
                });
            });
        ///////////////////////////
        let applied_rules = [];
        final_taxes_rules &&
            final_taxes_rules.map((tax) => {
                var entry_id_rules = tax['tax_rule_array'];
                var flag = false;
                var conditions_flag_array = [];
                entry_id_rules &&
                    entry_id_rules.forEach((rule) => {

                        if (rule['applicableOn'] == '1')
                            return;
                        var condition = JSON.parse(rule['conditions']);
                        condition &&
                            condition.forEach((cond) => {
                                var condition = cond.condition;
                                var for1 = cond.for1;
                                var value = cond.value;
                                if (condition === "1") {
                                    var place_flag = null;
                                    place_flag_array = [];
                                    switch (for1) {
                                        case '!=':
                                            if (cust_state !== value) place_flag = true;
                                            else place_flag = false;
                                            break;
                                        case '==':
                                            if (cust_state === value) place_flag = true;
                                            else place_flag = false;
                                            break;
                                        default:
                                            place_flag = false;
                                    }
                                    flag = place_flag;
                                }
                            })
                        if (flag === true) applied_rules.push(rule);
                    });
            });
        ////////////////////////////////////////
        var applied_taxes = '';
        var ledger_posting = '';
        applied_rules && applied_rules.map((rule) => {
            var tax_data = taxes_result.find((entry_id_tax) => entry_id_tax['entry_id'] === rule['entry_id']);
            var {
                ledger1,
                ledger2,
                name1,
                name2,
                amount1,
                amount2
            } = tax_data;
            var {
                name
            } = rule;
            if (applied_taxes == '') {
                applied_taxes = name1 + ':' + amount1 + ':' + 'Percentage';
                ledger_posting = ledger1;
                if (name2 != '') {
                    applied_taxes += '+' + name2 + ':' + amount2 + ':' + 'Percentage';
                    ledger_posting += '+' + ledger2;
                }
            } else {
                applied_taxes += name1 + ':' + amount1 + ':' + 'Percentage';
                ledger_posting = ledger_posting + '+' + ledger1;
                if (name2 != '') {
                    applied_taxes += '+' + name2 + ':' + amount2 + ':' + 'Percentage';
                    ledger_posting += '+' + ledger2;
                }
            }
        });
        return applied_taxes + ',' + ledger_posting;
    }
    //taxt
    function get_today_date2() {

        // convert date to y/m/data
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        return today;
    }
</script>
<script src="<?php echo BASE_URL ?>js/app/footer_scripts.js"></script>
<script src="<?php echo BASE_URL ?>js/app/validation.js"></script>