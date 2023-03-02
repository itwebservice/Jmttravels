<?php
include "../../../../../../model/model.php";

$visa_id = $_POST['visa_id'];

$sq_visa_info = mysqli_fetch_assoc(mysqlQuery("select * from visa_master where visa_id='$visa_id' and delete_status='0'"));
$date = $sq_visa_info['created_at'];
$yr = explode("-", $date);
$year = $yr[0];

$sq_entry = mysqlQuery("select * from visa_master_entries where visa_id='$visa_id'");

?>
<div class="modal fade profile_box_modal" id="visa_edit_modal" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" style="width: 1200px !important;" role="document">
        <div class="modal-content">
            <div class="modal-body profile_box_padding">

                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#basic_information" aria-controls="home" role="tab" data-toggle="tab" class="tab_name">Guest Information</a></li>

                        <li class="pull-right"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></li>
                    </ul>




                    <form id="upd_form" method="post" enctype="multipart/form-data">
                        <?php
                        if (mysqli_num_rows($sq_entry) > 0) {
                        ?>
                            <div class="row">
                                <div class="col-md-12">


                                    <div class="table-responsive">
                                        <table>
                                            <?php
                                            while ($db = mysqli_fetch_assoc($sq_entry)) {


                                            ?>

                                                <!-- accordian -->
                                                <div class="accordion_content package_content mg_bt_10">
                                                    <div class="panel panel-default main_block">
                                                        <div class="panel-heading main_block" role="tab" id="heading_<?= $db['entry_id'] ?>">
                                                            <div class="Normal collapsed main_block" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?= $db['entry_id'] ?>" aria-expanded="false" aria-controls="collapse_<?= $db['entry_id'] ?>" id="collapsed_<?= $db['entry_id'] ?>">
                                                                <div class="col-md-12"><span><em style="margin-left: 15px;"><?= $db['first_name']." ".$db['last_name'] ?></em></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="collapse_<?= $db['entry_id'] ?>" class="panel-collapse collapse main_block" role="tabpanel" aria-labelledby="heading_<?= $db['entry_id'] ?>">
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <input type="hidden" name="id[]" value="<?= $db['entry_id'] ?>">
                                                                    <input type="hidden" name="visa_id" value="<?= $visa_id ?>">

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" required placeholder="First Name"  name="first_name[]" value="<?= $db['first_name'] ?>" id="" class="form-control" title="First Name">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text"  placeholder="Middle Name"  name="middle_name[]" value="<?= $db['middle_name'] ?>" id="" class="form-control" title="Middle Name">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" required placeholder="Last Name"  name="last_name[]" value="<?= $db['last_name'] ?>" id="" class="form-control" title="Last Name">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" required name="birth_date[]"  placeholder="Date Of BIrth" value="<?= $db['birth_date'] ?>" id="" class="form-control app_datepicker" title="Date Of Birth">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" required placeholder="Passport Id"  name="passport_id[]" value="<?= $db['passport_id'] ?>" id="" class="form-control" title="Passport Id">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" required name="issue_date[]"  value="<?= $db['issue_date'] ?>" id="" class="form-control app_datetimepicker" title="Issue Date">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" required name="expiry_date[]"  value="<?= $db['expiry_date'] ?>" id="" class="form-control app_datetimepicker" title="Expiry Date">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" required placeholder="Nationality"  name="nationality[]" value="<?= $db['nationality'] ?>" id="" class="form-control" title="Nationality">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text"  placeholder="Mother Name"  name="mother_name[]" value="<?= $db['mother_name'] ?>" id="" class="form-control" title="Mother Name">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text"  placeholder="Father Name"  name="father_name[]" value="<?= $db['father_name'] ?>" id="" class="form-control" title="Father Name">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="file" multiple placeholder=""  name="id_proff[]" value="<?= $db['id_proff'] ?>" id="" class="form-control" title="ID PROOF">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- accordian -->

                                            <?php } ?>

                                        </table>

                                    </div>

                                </div>
                            </div>
                            <div class="row text-center mg_tp_20">
                                <div class="col-md-12">
                                    <!-- <button type="button" class="btn btn-sm btn-success" id="btn_update" onclick="visa_update_modal(`<?= $visa_id ?>`)"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Update</button> -->
                                    <button type="submit" class="btn btn-sm btn-success" id="btn_update"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Update</button>
                                </div>
                            </div>
                        <?php

                        }
                        ?>
                    </form>







                </div>

            </div>

        </div>
    </div>

</div>
<script src="<?php echo BASE_URL ?>js/app/footer_scripts.js"></script>
<script>
    $('#upd_form').on('submit', function(e) {
        e.preventDefault();
        $('#btn_update').html('loading');
        $('#btn_update').attr("disabled", true);
        var formData = new FormData(this);
        var base_url = $('#base_url').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'controller/visa_master/customer_visa_entry_update.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log("success");

                $('#btn_update').button('update');
                $('#btn_update').removeAttr("disabled");
                $('#visa_edit_modal').modal('hide');
                success_msg_alert("Visa Details Updated");
            },
            error: function(data) {
                $('#btn_update').button('update');
                $('#btn_update').removeAttr("disabled");
                $('#visa_edit_modal').modal('hide');
                error_msg_alert("Visa Details Error");
                console.log(data);
            }
        });

    });
    $('#visa_edit_modal').modal('show');
    $("input[name='birth_date[]'],input[name='issue_date[]'],input[name='expiry_date[]']").datetimepicker({
        timepicker: false,
        format: "Y-m-d"
    })
</script>