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
                                                            <div class="Normal main_block collapsedn" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?= $db['entry_id'] ?>" aria-expanded="false" aria-controls="collapse_<?= $db['entry_id'] ?>" id="collapsed_<?= $db['entry_id'] ?>">
                                                                <div class="col-md-6"><span><em style="margin-left: 15px;"><?= $db['first_name'] . " " . $db['last_name'] ?> (<?php echo $db['pass_status']; ?>)</em></span>
                                                                
                                                                </div>
                                                                <div class="col-md-6 text-right">
                                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="collapse_<?= $db['entry_id'] ?>" class="panel-collapse collapse main_block" role="tabpanel" aria-labelledby="heading_<?= $db['entry_id'] ?>">
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <input type="hidden" name="id[]" value="<?= $db['entry_id'] ?>">
                                                                    <input type="hidden" name="visa_id" value="<?= $visa_id ?>">

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" required placeholder="First Name" name="first_name[]" value="<?= $db['first_name'] ?>" id="" class="form-control" title="First Name">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" placeholder="Middle Name" name="middle_name[]" value="<?= $db['middle_name'] ?>" id="" class="form-control" title="Middle Name">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" required placeholder="Last Name" name="last_name[]" value="<?= $db['last_name'] ?>" id="" class="form-control" title="Last Name">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" required name="birth_date[]" placeholder="Date Of BIrth" value="<?= $db['birth_date'] ?>" id="" class="form-control app_datepicker" title="Date Of Birth">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" required placeholder="Passport Id" name="passport_id[]" value="<?= $db['passport_id'] ?>" id="" class="form-control text-uppercase" title="Passport Id">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" required name="issue_date[]" placeholder="Issue Date" value="<?= $db['issue_date'] != "1970-01-01" ? $db['issue_date'] : "" ?>" id="issue_date<?= $db['entry_id'] ?>" class="form-control app_datetimepicker" title="Issue Date" onchange="get_to_date(this.id,'expiry_date<?= $db['entry_id'] ?>');">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" required name="expiry_date[]" placeholder="Expiry Date" value="<?= $db['expiry_date'] != "1970-01-01" ? $db['expiry_date'] : "" ?>" id="expiry_date<?= $db['entry_id'] ?>" class="form-control app_datetimepicker" title="Expiry Date" onchange="validate_validDate('issue_date<?= $db['entry_id'] ?>','expiry_date<?= $db['entry_id'] ?>');">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" required placeholder="Nationality" name="nationality[]" value="<?= $db['nationality'] ?>" id="" class="form-control" title="Nationality">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" placeholder="Mother Name" name="mother_name[]" value="<?= $db['mother_name'] ?>" id="" class="form-control" title="Mother Name">
                                                                    </div>

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" placeholder="Father Name" name="father_name[]" value="<?= $db['father_name'] ?>" id="" class="form-control" title="Father Name">
                                                                    </div>

                                                                    
                                                                    
                                                            

                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" placeholder="Place Of Issue" name="place_of_issue[]" value="<?= $db['place_of_issue'] ?>" id="" class="form-control" title="Place Of Issue">
                                                                    </div>
                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" placeholder="Birth Place" name="birth_place[]" value="<?= $db['birth_place'] ?>" id="" class="form-control" title="Birth Place">
                                                                    </div>
                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" placeholder="Birth Country" name="birth_country[]" value="<?= $db['birth_country'] ?>" id="" class="form-control" title="Birth Country">
                                                                    </div>
                                                                    <div class="col-md-4 mg_tp_10"> 
                                                                    <select name="marital_status[]" id="" class="form-control" title="Marital Status">
                                                                        <option value="">Marital Status</option>
                                                                        <option value="Married" <?= $db['marital_status'] == "Married" ? "selected" : ""  ?>>Married</option>
                                                                        <option value="Unmarried" <?= $db['marital_status'] == "Unmarried" ? "selected" : ""  ?>>Unmarried</option>
                                                                    </select>    
                                                                        
                                                                    
                                                                    </div>
                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" placeholder="Documents Nationality" name="documents_nationality[]" value="<?= $db['documents_nationality'] ?>" id="" class="form-control" title="Documents Nationality">
                                                                    </div>
                                                                    <div class="col-md-4 mg_tp_10"> <input type="text" placeholder="Travel Document Type" name="travel_document_type[]" value="<?= $db['travel_document_type'] ?>" id="" class="form-control" title="Travel Document Type">
                                                                    </div>
                                                                    <div class="col-md-4 mg_tp_10">
                                                                    <select name="gender[]" id="" class="form-control" title="Gender">
                                                                        <option value="">Gender</option>
                                                                        <option value="Male" <?= $db['gender'] == "Male" ? "selected" : ""  ?>>Male</option>
                                                                        <option value="Female" <?= $db['gender'] == "Female" ? "selected" : ""  ?>>Female</option>
                                                                    </select>    
                                                                    
                                                                    </div>

                                                                  
                                                                </div>
                                                                <div class="row">
                                                                <div class="col-md-4 mg_tp_10"> <input type="file" id="file_<?= $db['entry_id'] ?>" accept="image/*" onchange="fileSizeCheck(this.id)" multiple placeholder="" name="id_proff_<?= $db['entry_id'] ?>[]"  class="form-control" title="ID PROOF"> 
                                                                    
                                                                    <span style="color: red;" class="note" data-original-title="" title="">Note : Upload Image size below 512KB, resolution : 900X450. </span>

                                                                    </div>
                                                                    <div class="col-md-4 mg_tp_10">
                                                            <?php
                                                                    if (!empty($db['id_proof_url'])) {
                                                                        $url = $db['id_proof_url'];
                                                                        $pos = strstr($url, 'uploads');
                                                                        if ($pos != false) {
                                                                            $newUrl1 = preg_replace('/(\/+)/', '/', $db['id_proof_url']);
                                                                            $newUrl = BASE_URL . str_replace('../', '', $newUrl1);
                                                                        } else {
                                                                            $newUrl =  $db['id_proof_url'];
                                                                        }

                                                                    ?>
                                                                        <div class="col-md-4 mg_tp_10">
                                                                            <a href="<?= $newUrl ?>" target="_blank" data-toggle="tooltip" class="btn btn-info btn-sm" title="Id Proof" data-original-title="View Image"><i class="fa fa-eye"></i></a>
                                                                        </div>
                                                                    <?php } ?>
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
<script src="<?php echo BASE_URL ?>js/app/field_validation.js"></script>
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
        format: "d-m-Y"
    })
</script>

<script>
    function fileSizeCheck(id) {
        var fileUpload = document.getElementById(id);
        // for(i=0;i<=fileUpload.length; i++)
        // {
          
            if (typeof (fileUpload.files) != "undefined" ) {
            var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
            if(size > 300)
            {
                fileUpload.value = "";
                error_msg_alert('File Size Exceeds');
                $('#btn_update').button('update');
                $('#btn_update').removeAttr("disabled");
                return false;
            }
        
        } 
        // }
    }
</script>