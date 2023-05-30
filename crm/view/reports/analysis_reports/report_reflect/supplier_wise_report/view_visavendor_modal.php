<?php
include "../../../../../model/model.php";

$visaId = $_POST['visa_id'];
$companyName = $_POST['vendor_name'];
$qry = mysqlQuery("select * from vendor_estimate inner join visa_vendor on vendor_estimate.vendor_type_id = visa_vendor.vendor_id 
inner join customer_master on visa_vendor.vendor_id=customer_master.customer_id where vendor_type_id='$visaId' and vendor_type='$companyName' and vendor_estimate.delete_status='0'") or die('error');


?>

<div class="modal fade" id="supp_wise_modal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-left" id="myModalLabel">Enquiry Details</h4>

            </div>
            <div class="modal-body profile_box_padding">

                <!-- print work -->
                <table class="table">
                    <tr>
                        <th>Booking Id</th>
                        <th>Customer Name</th>
                        <th>Purchase Amount</th>
                    </tr>

                    <?php
                    if (mysqli_num_rows($qry) > 0) {
                        while ($db = mysqli_fetch_array($qry)) {
                            // var_dump($db);
                    ?>
                            <tr>
                                <td><?php echo $db['customer_id']; ?></td>
                                <td><?php echo $db['first_name'].$db['last_name']; ?></td>
                                <td><?php echo $db['net_total']; ?></td>
                            </tr>


                    <?php
                        }
                    }
                    ?>
                </table>
                    <!-- print work -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#supp_wise_modal').modal('show');
</script>