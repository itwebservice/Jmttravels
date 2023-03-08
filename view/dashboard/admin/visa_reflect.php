<?php
include '../../../model/model.php';
$sq_query = "SELECT * FROM `visa_master_entries`";
$data = mysqlQuery($sq_query);
?>
<div class="dashboard_table dashboard_table_panel main_block">
    <div class="row text-left mg_tp_10">
        <div class="col-md-12">
            <div class="col-md-12 no-pad table_overflow">
                <div class="row mg_tp_20">
                    <div class="col-md-12 no-pad">
                        <div class="table-responsive">
                            <table class="table table-hover" style="border: 0;" id="tbl_visa_list">
                                <thead>
                                    <tr class="table-heading-row">
                                        <th>Booking Id</th>
                                        <th>Passenger Name</th>
                                        <th>VISA Issue Date</th>
                                        <th>VISA Expiry Date</th>
                                        <th>Passenger Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;

                                    if (mysqli_num_rows($data) > 0) {
                                        while ($db = mysqli_fetch_assoc($data)) {
                                            $days_ago = date('Y-m-d', strtotime('-3 days', strtotime(date('Y-m-d'))));
                                            $days_ago_db = date('Y-m-d', strtotime('-3 days', strtotime($db['expiry_date'])));
                                            if ($days_ago_db >= $days_ago && $days_ago_db <= date('Y-m-d')) {
                                                $color = $db['pass_status'] == "Completed" ? "#dff0d8" : ($db['pass_status'] == "In-Use" ? "#fcf8e3" : "#fff"); 
                                                if($db['pass_status'] == "Cancelled")
                                                {
                                                    $color = "#f2dede";
                                                }
                                    ?>
                                                <tr style="background:<?= $color ?> !important;">
                                                    <td><?= get_visa_booking_id($db['visa_id']); ?></td>
                                                    <td><?= $db['first_name'] . " " . $db['middle_name'] . " " . $db['last_name'] ?></td>
                                                    <td><?= $db['issue_date'] ?></td>
                                                    <td><?= $db['expiry_date'] ?></td>
                                                    <td><?= $db['pass_status'] ?></td>
                                                    <td>
                                                        <select name="status_type" id="status_type<?= $db['entry_id'] ?>" onchange="updateVisaStatus(this.id,`<?= $db['entry_id'] ?>`)" class="app_select2 form-control" title="Status" style="width:110px">
                                                            <option value="">*Status</option>
                                                            <option value="Unused" <?= $db['pass_status'] == "Unused" ? "selected" : "" ?>>Unused</option>
                                                            <option value="In-Use" <?= $db['pass_status'] == "In-Use" ? "selected" : "" ?>>In-Use</option>
                                                            <option value="Completed" <?= $db['pass_status'] == "Completed" ? "selected" : "" ?>>Completed</option>
                                                            <option value="Cancelled" <?= $db['pass_status'] == "Cancelled" ? "selected" : "" ?>>Cancelled</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                    <?php
                                            }
                                        }
                                    }


                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#tbl_visa_list').dataTable({
        "pagingType": "full_numbers"
    });

    function updateVisaStatus(id,visa_id)
    {
        var opt = $('#'+id).val();
        var base_url = $('#base_url').val();
        if(opt == "")
    {
        error_msg_alert("Please Select Status");
        return false;
    }
        $.post(base_url+'/view/dashboard/admin/visa_action.php',{opt:opt,visa_id:visa_id},function(data){
            visa_reflect();
            success_msg_alert("Visa Updated Successfully");    
        });
    }
</script>