<?php
//Generic Files
include "../../../../model.php"; 
include "printFunction.php";
global $app_quot_img,$similar_text,$quot_note,$currency;

$role = $_SESSION['role'];
$branch_admin_id = $_SESSION['branch_admin_id'];
$sq = mysqli_fetch_assoc(mysqlQuery("select * from branch_assign where link='b2c/sales/index.php'"));
$branch_status = $sq['branch_status'];
$branch_details = mysqli_fetch_assoc(mysqlQuery("select * from branches where branch_id='$branch_admin_id'"));

$quotation_id = $_GET['quotation_id'];

$sq_quotation = mysqli_fetch_assoc(mysqlQuery("select * from package_tour_quotation_master where quotation_id='$quotation_id'"));
$transport_agency_id = $sq_quotation['transport_agency_id'];
$sq_transport1 = mysqli_fetch_assoc(mysqlQuery("select * from transport_agency_master where transport_agency_id='$transport_agency_id'"));
$sq_package_name = mysqli_fetch_assoc(mysqlQuery("select * from custom_package_master where package_id = '$sq_quotation[package_id]'"));
$sq_terms_cond = mysqli_fetch_assoc(mysqlQuery("select * from terms_and_conditions where type='Package Quotation' and dest_id='$sq_package_name[dest_id]' and active_flag ='Active'"));
$sq_dest = mysqli_fetch_assoc(mysqlQuery("select link from video_itinerary_master where dest_id = '$sq_package_name[dest_id]'"));

$sq_transport = mysqli_fetch_assoc(mysqlQuery("select * from package_tour_quotation_transport_entries2 where quotation_id='$quotation_id'"));
$sq_costing = mysqli_fetch_assoc(mysqlQuery("select * from package_tour_quotation_costing_entries where quotation_id='$quotation_id'"));
$sq_package_program = mysqlQuery("select * from  package_quotation_program where quotation_id='$quotation_id'");

$sq_login = mysqli_fetch_assoc(mysqlQuery("select * from roles where id='$sq_quotation[login_id]'"));
$sq_emp_info = mysqli_fetch_assoc(mysqlQuery("select * from emp_master where emp_id='$sq_login[emp_id]'"));
$quotation_date = $sq_quotation['quotation_date'];
$yr = explode("-", $quotation_date);
$year =$yr[0];

$sq_customer = mysqli_fetch_assoc(mysqlQuery("select * from customer_master where customer_id='$customer_id'"));

if($sq_emp_info['first_name']==''){
  $emp_name = 'Admin';
}
else{
  $emp_name = $sq_emp_info['first_name'].' '.$sq_emp_info['last_name'];
}

$basic_cost = $sq_costing['basic_amount'];
$service_charge = $sq_costing['service_charge'];
$tour_cost= $basic_cost + $service_charge;
    $service_tax_amount = 0;
    $tax_show = '';
    $bsmValues = json_decode($sq_costing['bsmValues']);
    // var_dump($bsmValues);
if($sq_costing['service_tax_subtotal'] !== 0.00 && ($sq_costing['service_tax_subtotal']) !== ''){
  $service_tax_subtotal1 = explode(',',$sq_costing['service_tax_subtotal']);
  for($i=0;$i<sizeof($service_tax_subtotal1);$i++){
    $service_tax = explode(':',$service_tax_subtotal1[$i]);
    $service_tax_amount +=  $service_tax[2];
    $name .= $service_tax[0]  . $service_tax[1] .', ';
  }
}
$service_tax_amount_show = currency_conversion($currency,$sq_quotation['currency_code'],$service_tax_amount);
if($bsmValues[0]->service != ''){   //inclusive service charge
  $newBasic = $tour_cost + $service_tax_amount;
  $tax_show = '';
}
else{
  // $tax_show = $service_tax_amount;
  $tax_show =  rtrim($name, ', ').' : ' . ($service_tax_amount);
  $newBasic = $tour_cost;
}

////////////Basic Amount Rules
if($bsmValues[0]->basic != ''){ //inclusive markup
  $newBasic = $tour_cost + $service_tax_amount;
  $tax_show = '';
}

$quotation_cost = $basic_cost +$service_charge+ $service_tax_amount+ $sq_quotation['train_cost'] + $sq_quotation['cruise_cost']+ $sq_quotation['flight_cost'] + $sq_quotation['visa_cost'] + $sq_quotation['guide_cost'] + $sq_quotation['misc_cost'];
////////////////Currency conversion ////////////
$currency_amount1 = currency_conversion($currency,$sq_quotation['currency_code'],$quotation_cost);
?>

    <!-- landingPage -->
    <section class="landingSec main_block">

      <div class="landingPageTop main_block">
        <img src="<?= $app_quot_img?>" class="img-responsive">
        <h1 class="landingpageTitle"><?= $sq_package_name['package_name']?><?=' ('.$sq_package_name['package_code'].')' ?></h1>
        <span class="landingPageId"><?= get_quotation_id($quotation_id,$year) ?></span>
      </div>

      <div class="ladingPageBottom main_block side_pad">
        <div class="row">
          <div class="col-md-12 mg_tp_30">
              <h3 class="customerFrom">PREPARED FOR</h3>
          </div>
          <div class="col-md-5">
            <div class="landigPageCustomer">
              <span class="customerName mg_tp_10"><i class="fa fa-user"></i> : <?= $sq_quotation['customer_name'] ?></span><br>
              <span class="customerMail mg_tp_10"><i class="fa fa-envelope"></i> : <?= $sq_quotation['email_id'] ?></span><br>
              <span class="customerMobile mg_tp_10"><i class="fa fa-phone"></i> : <?= $sq_quotation['mobile_no'] ?></span><br>
            </div>
          </div>
          <div class="col-md-7 text-right">
          
            <div class="detailBlock text-center">
              <div class="detailBlockIcon detailBlockBlue">
                <i class="fa fa-calendar"></i>
              </div>
              <div class="detailBlockContent">
                <h3 class="contentValue"><?= get_date_user($sq_quotation['quotation_date']) ?></h3>
                <span class="contentLabel">QUOTATION DATE</span>
              </div>
            </div>

            <div class="detailBlock text-center">
              <div class="detailBlockIcon detailBlockGreen">
                <i class="fa fa-hourglass-half"></i>
              </div>
              <div class="detailBlockContent">
                <h3 class="contentValue"><?php echo ($sq_quotation['total_days']-1).'N/'.$sq_quotation['total_days'].'D' ?></h3>
                <span class="contentLabel">DURATION</span>
              </div>
            </div>

            <div class="detailBlock text-center">
              <div class="detailBlockIcon detailBlockYellow">
                <i class="fa fa-users"></i>
              </div>
              <div class="detailBlockContent">
                <h3 class="contentValue"><?= $sq_quotation['total_passangers'] ?></h3>
                <span class="contentLabel">TOTAL GUEST</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <!-- Count queries -->
  <?php
  $sq_package_count = mysqli_num_rows(mysqlQuery("select * from  package_quotation_program where quotation_id='$quotation_id'"));
  $sq_hotel_count = mysqli_num_rows(mysqlQuery("select * from package_tour_quotation_hotel_entries where quotation_id='$quotation_id'"));
  $sq_transport_count = mysqli_num_rows(mysqlQuery("select * from package_tour_quotation_transport_entries2 where quotation_id='$quotation_id'"));
  $sq_train_count = mysqli_num_rows(mysqlQuery("select * from package_tour_quotation_train_entries where quotation_id='$quotation_id'"));
  $sq_plane_count = mysqli_num_rows(mysqlQuery("select * from package_tour_quotation_plane_entries where quotation_id='$quotation_id'"));
  $sq_cruise_count = mysqli_num_rows(mysqlQuery("select * from package_tour_quotation_cruise_entries where quotation_id='$quotation_id'"));
  $sq_exc_count = mysqli_num_rows(mysqlQuery("select * from package_tour_quotation_excursion_entries where quotation_id='$quotation_id'"));

  $overall_count = 0;
  if($sq_train_count>0) $overall_count++; 
  if($sq_plane_count>0) $overall_count++; 
  if($sq_cruise_count>0) $overall_count++; 
  if($sq_hotel_count>0) $overall_count++; 
  if($sq_transport_count>0) $overall_count++; 
  if($sq_exc_count>0) $overall_count++; 
  
  if($overall_count <= 3){
    ?>

  <?php } ?>
  
  <?php if($sq_hotel_count || $sq_plane_count || $sq_transport_count){ ?>
    <section class="pageSection main_block">
    <!-- background Image -->
    <img src="<?= BASE_URL ?>images/quotation/p4/pageBGF.jpg" class="img-responsive pageBGImg">
    <section class="travelingDetails main_block mg_tp_30 pageSectionInner">
        <?php if($sq_hotel_count){ ?>
          
          <section class="transportDetailsPanel main_block side_pad mg_tp_30 mg_bt_30">
            <?php
            $sq_package_type = mysqlQuery("select DISTINCT(package_type) from package_tour_quotation_hotel_entries where quotation_id='$quotation_id' order by package_type");
            while($row_hotel1 = mysqli_fetch_assoc($sq_package_type)){

              $sq_package_type1 = mysqlQuery("select * from package_tour_quotation_hotel_entries where quotation_id='$quotation_id' and package_type='$row_hotel1[package_type]' order by package_type");
              ?>
              <h6 class="text-center"><?= strtoupper('PACKAGE TYPE') ?> - <?= strtoupper($row_hotel1['package_type']) ?></h6>
              <div class="travsportInfoBlock">
                <div class="transportIcon">
                  <img src="<?= BASE_URL ?>images/quotation/p4/TI_hotel.png" class="img-responsive">
                </div>
                <div class="transportDetails">
                  <div class="col-md-12 no-pad">
                    <div class="table-responsive" style="margin-top:1px;margin-right: 1px;">
                      <table class="table tableTrnasp no-marg" id="tbl_emp_list">
                        <thead>
                          <tr class="table-heading-row">
                            <th>City</th>
                            <th>Hotel Name</th>
                            <th>room_category</th>
                            <th>Check_IN</th>
                            <th>Check_OUT</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          while($row_hotel = mysqli_fetch_assoc($sq_package_type1)){

                            $hotel_name = mysqli_fetch_assoc(mysqlQuery("select * from hotel_master where hotel_id='$row_hotel[hotel_name]'"));
                            $city_name = mysqli_fetch_assoc(mysqlQuery("select * from city_master where city_id='$row_hotel[city_name]'"));
                            ?>
                            <tr>
                              <td><?php echo $city_name['city_name']; ?></td>
                              <td><?php echo $hotel_name['hotel_name'].$similar_text; ?></td>
                              <td><?php echo $row_hotel['room_category']; ?></td>
                              <td><?= get_date_user($row_hotel['check_in']) ?></td>
                              <td><?= get_date_user($row_hotel['check_out']) ?></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </section>
        <?php } ?>
      <?php if($sq_plane_count){ ?>
        <!-- Flight -->
          <section class="transportDetailsPanel main_block side_pad mg_tp_30 mg_bt_30">
            <div class="travsportInfoBlock">
              <div class="transportIcon">
                <img src="<?= BASE_URL ?>images/quotation/p4/TI_flight.png" class="img-responsive">
              </div>
              <div class="transportDetails">
                <div class="table-responsive" style="margin-top:1px;margin-right: 1px;">
                  <table class="table tableTrnasp no-marg" id="tbl_emp_list">
                    <thead>
                      <tr class="table-heading-row">
                        <th>From_Sector</th>
                        <th>To_sector</th>
                        <th>Airline</th>
                        <th>Class</th>
                        <th>Departure_D/T</th>
                        <th>Arrival_D/T</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $sq_plane = mysqlQuery("select * from package_tour_quotation_plane_entries where quotation_id='$quotation_id'");
                        while($row_plane = mysqli_fetch_assoc($sq_plane)){
                        $sq_airline = mysqli_fetch_assoc(mysqlQuery("select * from airline_master where airline_id='$row_plane[airline_name]'"));
                        $airline = ($row_plane['airline_name'] != '') ? $sq_airline['airline_name'].' ('.$sq_airline['airline_code'].')' : 'NA';
                      ?>   
                      <tr>
                        <td><?= $row_plane['from_location'] ?></td>
                        <td><?= $row_plane['to_location'] ?></td>
                        <td><?= $airline ?></td>
                        <td><?= $row_plane['class'] ?></td>
                        <td><?= get_datetime_user($row_plane['dapart_time']) ?></td>
                        <td><?= get_datetime_user($row_plane['arraval_time']) ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>
        <?php } ?>
        <?php if($sq_transport_count){ ?>
          <!-- transport -->
          <section class="transportDetailsPanel main_block side_pad mg_tp_30 mg_bt_30">
            <div class="travsportInfoBlock">
              <div class="transportIcon">
                <img src="<?= BASE_URL ?>images/quotation/p4/TI_car.png" class="img-responsive">
              </div>

              <div class="transportDetails">
                <div class="table-responsive" style="margin-top:1px;margin-right: 1px;">
                  <table class="table no-marg tableTrnasp">
                    <thead>
                      <tr class="table-heading-row">
                        <th>VEHICLE NAME</th>
                        <th>T_START_DATE</th>
                        <th>T_END_DATE</th>
                        <th>PICKUP LOCATION</th>
                        <th>DROP LOCATION</th>
                        <th>TOTAL_VEHICLES</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $count = 0;
                      $sq_hotel = mysqlQuery("select * from package_tour_quotation_transport_entries2 where quotation_id='$quotation_id'");
                      while($row_hotel = mysqli_fetch_assoc($sq_hotel))
                      {
                        $transport_name = mysqli_fetch_assoc(mysqlQuery("select * from b2b_transfer_master where entry_id='$row_hotel[vehicle_name]'"));
                        // Pickup
                        if($row_hotel['pickup_type'] == 'city'){
                          $row = mysqli_fetch_assoc(mysqlQuery("select city_id,city_name from city_master where city_id='$row_hotel[pickup]'"));
                          $pickup = $row['city_name'];
                        }
                        else if($row_hotel['pickup_type'] == 'hotel'){
                          $row = mysqli_fetch_assoc(mysqlQuery("select hotel_id,hotel_name from hotel_master where hotel_id='$row_hotel[pickup]'"));
                          $pickup = $row['hotel_name'];
                        }
                        else{
                          $row = mysqli_fetch_assoc(mysqlQuery("select airport_name, airport_code, airport_id from airport_master where airport_id='$row_hotel[pickup]'"));
                          $airport_nam = clean($row['airport_name']);
                          $airport_code = clean($row['airport_code']);
                          $pickup = $airport_nam." (".$airport_code.")";
                        }
                        //Drop-off
                        if($row_hotel['drop_type'] == 'city'){
                          $row = mysqli_fetch_assoc(mysqlQuery("select city_id,city_name from city_master where city_id='$row_hotel[drop]'"));
                          $drop = $row['city_name'];
                        }
                        else if($row_hotel['drop_type'] == 'hotel'){
                          $row = mysqli_fetch_assoc(mysqlQuery("select hotel_id,hotel_name from hotel_master where hotel_id='$row_hotel[drop]'"));
                          $drop = $row['hotel_name'];
                        }
                        else{
                          $row = mysqli_fetch_assoc(mysqlQuery("select airport_name, airport_code, airport_id from airport_master where airport_id='$row_hotel[drop]'"));
                          $airport_nam = clean($row['airport_name']);
                          $airport_code = clean($row['airport_code']);
                          $drop = $airport_nam." (".$airport_code.")";
                        }
                        ?>
                        <tr>
                          <td><?= $transport_name['vehicle_name'].$similar_text ?></td>
                          <td><?= date('d-m-Y', strtotime($row_hotel['start_date'])) ?></td>
                          <td><?= date('d-m-Y', strtotime($row_hotel['end_date'])) ?></td>
                          <td><?= $pickup ?></td>
                          <td><?= $drop ?></td>
                          <td><?= $row_hotel['vehicle_count'] ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>
        <?php } ?>
    </section>
    </section>
  <?php } ?>

  <?php if($sq_train_count || $sq_cruise_count || $sq_exc_count){
    ?>
    <section class="pageSection main_block">
    <!-- background Image -->
    <img src="<?= BASE_URL ?>images/quotation/p4/pageBGF.jpg" class="img-responsive pageBGImg">
    <section class="travelingDetails main_block mg_tp_30 pageSectionInner">
      
    <?php if($sq_train_count>0){ ?>
        <section class="transportDetailsPanel main_block side_pad mg_tp_30 mg_bt_30">
          <div class="travsportInfoBlock">
            <div class="transportIcon">
              <img src="<?= BASE_URL ?>images/quotation/p4/TI_train.png" class="img-responsive">
            </div>
            <div class="transportDetails">
              <div class="table-responsive" style="margin-top:1px;margin-right: 1px;">
                <table class="table tableTrnasp no-marg" id="tbl_emp_list">
                  <thead>
                    <tr class="table-heading-row">
                      <th>From_location</th>
                      <th>To_location</th>
                      <th>Class</th>
                      <th>Departure_D/T</th>
                      <th>Arrival_D/T</th>
                    </tr>
                  </thead>
                  <tbody>  
                  <?php 
                  $sq_train = mysqlQuery("select * from package_tour_quotation_train_entries where quotation_id='$quotation_id'");
                  while($row_train = mysqli_fetch_assoc($sq_train)){  
                    ?>
                    <tr>
                      <td><?= $row_train['from_location'] ?></td>
                      <td><?= $row_train['to_location'] ?></td>
                      <td><?php echo ($row_train['class']!='')?$row_train['class']:'NA'; ?></td>
                      <td><?= date('d-m-Y H:i', strtotime($row_train['departure_date'])) ?></td>
                      <td><?= date('d-m-Y H:i', strtotime($row_train['arrival_date'])) ?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
      <?php } ?>
        <?php if($sq_cruise_count){ ?>
        <!-- Cruise -->
          <section class="transportDetailsPanel main_block side_pad mg_tp_30 mg_bt_30">
            <div class="travsportInfoBlock">
              <div class="transportIcon">
                <img src="<?= BASE_URL ?>images/quotation/p4/TI_cruise.png" class="img-responsive">
              </div>

              <div class="transportDetails">
                <div class="table-responsive" style="margin-top:1px;margin-right: 1px;">
                  <table class="table tableTrnasp no-marg" id="tbl_emp_list">
                    <thead>
                      <tr class="table-heading-row">
                        <th>Departure_D/T</th>
                        <th>Arrival_D/T</th>
                        <th>Route</th>
                        <th>Cabin</th>
                        <th>Sharing</th>
                      </tr>
                    </thead>
                    <tbody>  
                    <?php 
                    $sq_cruise = mysqlQuery("select * from package_tour_quotation_cruise_entries where quotation_id='$quotation_id'");
                    while($row_cruise = mysqli_fetch_assoc($sq_cruise)){  
                      ?>
                      <tr>
                        <td><?= date('d-m-Y H:i', strtotime($row_cruise['dept_datetime'])) ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($row_cruise['arrival_datetime'])) ?></td>
                        <td><?= $row_cruise['route'] ?></td>
                        <td><?= $row_cruise['cabin'] ?></td>
                        <td><?= $row_cruise['sharing'] ?></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>
        <?php } ?>
        <?php if($sq_exc_count){ ?>
          <!-- Excursion -->
          <section class="transportDetailsPanel main_block side_pad mg_tp_30 mg_bt_30">
            <div class="travsportInfoBlock">
              <div class="transportIcon">
                <img src="<?= BASE_URL ?>images/quotation/p4/TI_excursion.png" class="img-responsive">
              </div>

              <div class="transportDetails">
                <div class="table-responsive" style="margin-top:1px;margin-right: 1px;">
                  <table class="table no-marg tableTrnasp">
                    <thead>
                      <tr class="table-heading-row">
                        <th>City </th>
                        <th>Activity_D/T</th>
                        <th>Activity Name</th>
                        <th>Transfer Option</th>
                        <th>Adult(s)</th>
                        <th>CWB</th>
                        <th>CWOB</th>
                        <th>Infant(s)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $count = 0;
                      $sq_ex = mysqlQuery("select * from package_tour_quotation_excursion_entries where quotation_id='$quotation_id'");
                      while($row_ex = mysqli_fetch_assoc($sq_ex)){
                        $sq_city = mysqli_fetch_assoc(mysqlQuery("select * from city_master where city_id='$row_ex[city_name]'"));
                        $sq_ex_name = mysqli_fetch_assoc(mysqlQuery("select * from excursion_master_tariff where entry_id='$row_ex[excursion_name]'"));
                        ?>
                        <tr>
                          <td><?= $sq_city['city_name'] ?></td>
                          <td><?= get_datetime_user($row_ex['exc_date']) ?></td>
                          <td><?= $sq_ex_name['excursion_name'] ?></td>
                          <td><?= $row_ex['transfer_option'] ?></td>
                          <td><?= $row_ex['adult'] ?></td>
                          <td><?= $row_ex['chwb'] ?></td>
                          <td><?= $row_ex['chwob'] ?></td>
                          <td><?= $row_ex['infant'] ?></td>
                        </tr>
                        <?php }	?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>
        <?php } ?>
    </section>
    </section>
  <?php } ?>

    <!-- Itinerary -->
    <?php 
      $count = 1;
      $checkPageEnd = 0;
      $i = 0;
      while($row_itinarary = mysqli_fetch_assoc($sq_package_program)){
      
        $dates =(array) get_dates_for_package_itineary($_GET['quotation_id']);
        $sq_day_image = mysqli_fetch_assoc(mysqlQuery("select * from package_tour_quotation_images where quotation_id='$row_itinarary[quotation_id]'"));
        $day_url1 = explode(',',$sq_day_image['image_url']);
        $daywise_image = 'http://itourscloud.com/quotation_format_images/dummy-image.jpg';
        for($count1 = 0; $count1<sizeof($day_url1);$count1++){
            $day_url2 = explode('=',$day_url1[$count1]);
            if($day_url2[1]==$row_itinarary['day_count'] && $day_url2[0]==$row_itinarary['package_id']){
              $daywise_image = $day_url2[2];
            }
        }
        if($checkPageEnd%2==0 || $checkPageEnd==0){
          $go = $checkPageEnd + 2;
          $flag = 0;
          ?>
          <section class="pageSection main_block">
            
          <!-- background Image -->
          <img src="<?= BASE_URL ?>images/quotation/p5/pageBGF.jpg" class="img-responsive pageBGImg">

          <section class="itinerarySec pageSectionInner main_block mg_tp_30">
          <?php if($checkPageEnd==0 && $sq_dest['link']!=''){ ?>
            <div class="vitinerary_div" style="margin-bottom:20px!important;">
              <h6>Destination Guide Video</h6>
              <img src="<?php echo BASE_URL.'images/quotation/youtube-icon.png'; ?>" class="itinerary-img img-responsive"><br/>
              <a href="<?=$sq_dest['link']?>" class="no-marg" target="_blank"></a>
            </div>
            <?php }
        }
          ?>
          <section class="print_single_itinenary leftItinerary">
              <div class="itneraryImg">
                <div class="itneraryImgblock">
                  <img src="<?= $daywise_image ?>" class="img-responsive">
                </div>
                <div class="itneraryText">
                  <div class="itneraryDayInfo">
                    <i class="fa fa-map-marker" aria-hidden="true"></i><span> Day <?= $count ?> <?= '('.$dates[$i++].')' ?>: <?= $row_itinarary['attraction'] ?> </span>
                  </div>
                  <div class="itneraryDayPlan">
                    <p><?= $row_itinarary['day_wise_program'] ?></p>
                  </div>
                </div>
              </div>
                <div class="itneraryDayAccomodation">
                  <span><i class="fa fa-bed"></i> : <?=  $row_itinarary['stay'] ?></span>
                  <span><i class="fa fa-cutlery"></i> : <?= $row_itinarary['meal_plan'] ?></span>
                </div>
          </section>

          <?php 
          if($go == $checkPageEnd){
            $flag = 1;
            ?>

              </section>
            </section>
            <?php
          }
        $count++;
        $checkPageEnd++; 
      }
      if($flag == 0){
        ?>
        </section>
        </section>
      <?php } ?>

  <!-- Inclusion -->
  <?php if(($sq_quotation['inclusions'] != '' && $sq_quotation['inclusions'] != ' ' && $sq_quotation['inclusions'] != '<div><br></div>') || $sq_quotation['exclusions'] != '' && $sq_quotation['exclusions'] != ' ' && $sq_quotation['exclusions'] != '<div><br></div>'){ ?>
  <section class="pageSection main_block">
      <!-- background Image -->
      <img src="<?= BASE_URL ?>images/quotation/p4/pageBGF.jpg" class="img-responsive pageBGImg">
      <section class="incluExcluTerms main_block side_pad mg_tp_10 pageSectionInner">
      <?php
      if($sq_quotation['inclusions'] != '' && $sq_quotation['inclusions'] != ' ' && $sq_quotation['inclusions'] != '<div><br></div>'){ ?>
        <!-- Inclusion -->
        <div class="row side_pad">
          <div class="col-md-12">
            <div class="incluExcluTermsTabPanel inclusions main_block">
                <h3 class="incexTitle">INCLUSIONS</h3>
                <div class="tabContent">
                    <pre class="real_text"><?= $sq_quotation['inclusions'] ?></pre>
                </div>
            </div>
          </div>
        </div>
      <?php } ?>
      <?php
      if($sq_quotation['exclusions'] != '' && $sq_quotation['exclusions'] != ' ' && $sq_quotation['exclusions'] != '<div><br></div>'){ ?>
        <!-- Exclusion -->
          <div class="col-md-12">
            <div class="incluExcluTermsTabPanel exclusions main_block">
                <h3 class="incexTitle">EXCLUSIONS</h3>
                <div class="tabContent">
                    <article class="real_text"><?= $sq_quotation['exclusions'] ?></article>
                </div>
            </div>
          </div>
        </div>
      <?php } ?>

      </section>
  </section>
  <?php } ?>

  <!-- Terms and Conditions -->
  <?php if($sq_terms_cond['terms_and_conditions'] != ''||$sq_package_name['note'] != '' || $quot_note){ ?>
  <section class="pageSection main_block">
      <!-- background Image -->
      <img src="<?= BASE_URL ?>images/quotation/p4/pageBGF.jpg" class="img-responsive pageBGImg">
      <section class="incluExcluTerms main_block side_pad mg_tp_30 pageSectionInner">
        <!-- Terms and Conditions -->
        <?php if($sq_terms_cond['terms_and_conditions'] != ''){ ?>
        <div class="row">
          
          <div class="col-md-12 mg_tp_30">
            <div class="incluExcluTermsTabPanel main_block">
                <h3 class="incexTitle">TERMS AND CONDITIONS</h3>
                <div class="tncContent">
                    <pre class="real_text"><?php echo $sq_terms_cond['terms_and_conditions']; ?></pre>      
                </div>
            </div>
          </div>
        <?php } ?>
        <?php if($sq_package_name['note'] != ''){ ?>
        <div class="row mg_bt_10">
          
          <div class="col-md-12 mg_tp_30">
            <div class="incluExcluTermsTabPanel main_block">
                <h3 class="incexTitle">NOTE</h3>
                <div class="tncContent">
                    <pre class="real_text"><?php echo $sq_package_name['note']; ?></pre>
                </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <?php if($quot_note != ''){ ?>
        <div class="row mg_tp_10">
          <div class="col-md-12">
            <div class="tncContent">
                <pre class="real_text"><?php echo $quot_note; ?></pre>      
            </div>              
          </div>
        </div>
        <?php } ?>
      </div>
      </section>
    </section>
    <?php } ?>



  <!-- Costing & Banking Page -->
  <section class="pageSection main_block">
      <!-- background Image -->
      <img src="<?= BASE_URL ?>images/quotation/p4/pageBGF.jpg" class="img-responsive pageBGImg">
      <section class="endPageSection main_block mg_tp_30 pageSectionInner">

        <div class="row">
          <!-- Guest Detail -->
          <div class="col-md-12 passengerPanel endPagecenter mg_bt_30">
                <h3 class="endingPageTitle text-center">TOTAL GUEST</h3>
                <div class="col-md-3 text-center mg_bt_30">
                  <div class="icon">
                    <img src="<?= BASE_URL ?>images/quotation/p4/adult.png" class="img-responsive">
                    <h4 class="no-marg">Adult : <?= $sq_quotation['total_adult'] ?></h4>
                  </div>
                </div>
                <div class="col-md-3 text-center mg_bt_30">
                  <div class="icon">
                    <img src="<?= BASE_URL ?>images/quotation/p4/child.png" class="img-responsive">
                    <h4 class="no-marg">CWB : <?= $sq_quotation['children_with_bed'] ?></h4>
                  </div>
                </div>
                <div class="col-md-3 text-center mg_bt_30">
                  <div class="icon">
                    <img src="<?= BASE_URL ?>images/quotation/p4/child.png" class="img-responsive">
                    <h4 class="no-marg">CWOB : <?= $sq_quotation['children_without_bed'] ?></h4>
                  </div>
                </div>
                <div class="col-md-3 text-center mg_bt_30">
                  <div class="icon">
                    <img src="<?= BASE_URL ?>images/quotation/p4/infant.png" class="img-responsive">
                    <h4 class="no-marg">Infant : <?= $sq_quotation['total_infant'] ?></h4>
                  </div>
                </div>
          </div>
          
        </div>
        <div class="row">
          <!-- Costing -->
          <div class="col-md-12 constingBankingPanel BankingPanel">
            <?php
            $discount1 = currency_conversion($currency,$sq_quotation['currency_code'],$sq_quotation['discount']);
            if($sq_quotation['discount']!=0){ $discount = ' (Applied Discount : '.$discount1.')'; } else{ $discount = ''; }
            ?>
            <!-- costBankTitle -->
              <h3 class="endingPageTitle text-center no-pad">COSTING DETAILS</h3>
              <h5 class="endingPageTitle text-center"><?= $discount ?></h5>
                <!-- Group Costing -->
                <?php
                if($sq_quotation['costing_type'] == 1){ ?>
                  <div class="travsportInfoBlock1">
                    <div class="transportDetails_costing">
                      <div class="table-responsive">
                        <table class="table no-marg tableTrnasp">
                          <thead>
                            <tr class="table-heading-row">
                              <th style="font-size: 16px !important; font-weight: 600 !important; padding: 8px  20px !important;">Package Type</th>
                              <th style="font-size: 16px !important; font-weight: 600 !important; padding: 8px  20px !important;">Tour Cost</th>
                              <th style="font-size: 16px !important; font-weight: 600 !important; padding: 8px  20px !important;">Tax</th>
                              <th style="font-size: 16px !important; font-weight: 600 !important; padding: 8px  20px !important;">TRAVEL/OTHER</th>
                              <th style="font-size: 16px !important; font-weight: 600 !important; padding: 8px  20px !important;">Total Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sq_costing1 = mysqlQuery("select * from package_tour_quotation_costing_entries where quotation_id='$quotation_id' order by package_type");
                        while($sq_costing = mysqli_fetch_assoc($sq_costing1)){

                            $basic_cost = $sq_costing['basic_amount'];
                            $service_charge = $sq_costing['service_charge'];
                            $tour_cost= $basic_cost + $service_charge;
                            $service_tax_amount = 0;
                            $tax_show = '';
                            $bsmValues = json_decode($sq_costing['bsmValues']);
                            $name = '';
                            if($sq_costing['service_tax_subtotal'] !== 0.00 && ($sq_costing['service_tax_subtotal']) !== ''){
                              $service_tax_subtotal1 = explode(',',$sq_costing['service_tax_subtotal']);
                              for($i=0;$i<sizeof($service_tax_subtotal1);$i++){
                                $service_tax = explode(':',$service_tax_subtotal1[$i]);
                                $service_tax_amount +=  $service_tax[2];
                                $name .= $service_tax[0] . $service_tax[1] .', ';
                              }
                            }
                            $service_tax_amount_show = currency_conversion($currency,$sq_quotation['currency_code'],$service_tax_amount);
                            // if($bsmValues[0]->service != ''){   //inclusive service charge
                            //   $newBasic = $tour_cost + $service_tax_amount;
                            //   $tax_show = '';
                            // }
                            // else{
                            //   $tax_show =  rtrim($name, ', ').' : ' . ($service_tax_amount);
                            //   $newBasic = $tour_cost;
                            // }
                            
                            // ////////////Basic Amount Rules
                            // if($bsmValues[0]->basic != ''){ //inclusive markup
                            //   $newBasic = $tour_cost + $service_tax_amount;
                            //   $tax_show = '';
                            // }
                            $quotation_cost = $basic_cost + $service_charge + $service_tax_amount + $sq_quotation['train_cost'] + $sq_quotation['cruise_cost'] + $sq_quotation['flight_cost'] + $sq_quotation['visa_cost'] + $sq_quotation['guide_cost'] + $sq_quotation['misc_cost'];
                            ////////////////Currency conversion ////////////
                            $currency_amount1 = currency_conversion($currency,$sq_quotation['currency_code'],$quotation_cost);
                            
                            $newBasic = currency_conversion($currency,$sq_quotation['currency_code'],$tour_cost);
                            $travel_cost = floatval($sq_quotation['train_cost']) + floatval($sq_quotation['flight_cost']) + floatval($sq_quotation['cruise_cost']) + floatval($sq_quotation['visa_cost']) + floatval($sq_quotation['guide_cost'])+ floatval($sq_quotation['misc_cost']);
                            $travel_cost = currency_conversion($currency,$sq_quotation['currency_code'],$travel_cost);
                          ?>
                          <tr>
                            <td style="font-size: 14px !important; padding: 8px  20px !important;"><?php echo $sq_costing['package_type']?></td>
                            <td style="font-size: 14px !important; padding: 8px  20px !important;"><?= $newBasic ?></td>
                            <td style="font-size: 14px !important; padding: 8px  20px !important;"><?= str_replace(',','',$name).$service_tax_amount_show ?></td>
                            <td style="font-size: 14px !important; padding: 8px  20px !important;"><?= $travel_cost ?></td>
                            <td style="font-size: 14px !important; padding: 8px  20px !important;"><?= $currency_amount1 ?></td>
                          </tr>
                            <?php
                        } ?>
                        </tbody>
                      </table>
                    </div>
                    </div>
                  </div>
                <?php }
                else{
                  ?>
                  <div class="travsportInfoBlock1">
                    <div class="transportDetails_costing">
                      <div class="table-responsive">
                        <table class="table table-bordered no-marg tableTrnasp">
                          <thead>
                            <tr class="table-heading-row">
                              <th>Package Type</th>
                              <th>ADULT(PP)</th>
                              <th>CWB(PP)</th>
                              <th>CWOB(PP)</th>
                              <th>INFANT(PP)</th>
                              <th>TAX</th>
                              <th>TRAVEL/OTHER</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          $sq_costing1 = mysqlQuery("select * from package_tour_quotation_costing_entries where quotation_id='$quotation_id' order by package_type");
                          while($sq_costing = mysqli_fetch_assoc($sq_costing1)){
        
                            $service_charge = $sq_costing['service_charge'];
                            $total_pax = intval($sq_quotation['total_adult'])+intval($sq_quotation['children_with_bed'])+intval($sq_quotation['children_without_bed'])+intval($sq_quotation['total_infant']);
                            $per_service_charge = floatval($service_charge)/floatval($total_pax);
                  
                            $adult_cost = ($sq_quotation['total_adult']!='0')? currency_conversion($currency,$sq_quotation['currency_code'],(floatval($sq_costing['adult_cost']+floatval($per_service_charge)))) : currency_conversion($currency,$sq_quotation['currency_code'],0);
                            $child_with = ($sq_quotation['children_with_bed']!='0') ? currency_conversion($currency,$sq_quotation['currency_code'],(floatval($sq_costing['child_with']+floatval($per_service_charge)))) : currency_conversion($currency,$sq_quotation['currency_code'],0);
                            $child_without = ($sq_quotation['children_without_bed']!='0')? currency_conversion($currency,$sq_quotation['currency_code'],(floatval($sq_costing['child_without']+floatval($per_service_charge)))) : currency_conversion($currency,$sq_quotation['currency_code'],0);
                            $infant_cost = ($sq_quotation['total_infant']!='0') ? currency_conversion($currency,$sq_quotation['currency_code'],(floatval($sq_costing['infant_cost']+floatval($per_service_charge)))) : currency_conversion($currency,$sq_quotation['currency_code'],0);
                  
                            $tour_cost= $basic_cost + $service_charge;
                            $service_tax_amount = 0;
                            $tax_show = '';
                            $bsmValues = json_decode($sq_costing['bsmValues']);
                            $name = '';
                            if($sq_costing['service_tax_subtotal'] !== 0.00 && ($sq_costing['service_tax_subtotal']) !== ''){
                              $service_tax_subtotal1 = explode(',',$sq_costing['service_tax_subtotal']);
                              for($i=0;$i<sizeof($service_tax_subtotal1);$i++){
                                $service_tax = explode(':',$service_tax_subtotal1[$i]);
                                $service_tax_amount +=  $service_tax[2];
                                $name .= $service_tax[0] . $service_tax[1] .', ';
                              }
                            }
                            $service_tax_amount_show = currency_conversion($currency,$sq_quotation['currency_code'],$service_tax_amount);
                            if($bsmValues[0]->service != ''){   //inclusive service charge
                              $newBasic = $tour_cost + $service_tax_amount;
                              $tax_show = '';
                            }
                            else{
                              $tax_show =  rtrim($name, ', ').' : ' . ($service_tax_amount);
                              $newBasic = $tour_cost;
                            }
                            
                            ////////////Basic Amount Rules
                            if($bsmValues[0]->basic != ''){ //inclusive markup
                              $newBasic = $tour_cost + $service_tax_amount;
                              $tax_show = '';
                            }
        
                            $travel_cost = floatval($sq_quotation['train_cost']) + floatval($sq_quotation['flight_cost']) + floatval($sq_quotation['cruise_cost']) + floatval($sq_quotation['visa_cost']) + floatval($sq_quotation['guide_cost']) + floatval($sq_quotation['misc_cost']);
                            $travel_cost = currency_conversion($currency,$sq_quotation['currency_code'],$travel_cost);
                            $basic_cost = $sq_costing['basic_amount'];
                            $quotation_cost = $basic_cost + $service_charge + $service_tax_amount + $sq_quotation['train_cost'] + $sq_quotation['cruise_cost'] + $sq_quotation['flight_cost'] + $sq_quotation['visa_cost'] + $sq_quotation['guide_cost'] + $sq_quotation['misc_cost'];
                            ////////////////Currency conversion ////////////
                            $currency_amount1 = currency_conversion($currency,$sq_quotation['currency_code'],$quotation_cost);
                            ?>
                            <tr>
                              <td><?php echo $sq_costing['package_type'].' (<b>'.$currency_amount1.'</b>)' ?></td>
                              <td><?= $adult_cost ?></td>
                              <td><?= $child_with ?></td>
                              <td><?= $child_without  ?></td>
                              <td><?= $infant_cost ?></td>
                              <td><?= str_replace(',','',$name).$service_tax_amount_show ?></td>
                              <td><?= $travel_cost ?></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  </div>
                <?php } ?>
                <!-- Per Person COSTING eND -->
          </div>
        </div>

      </section>
    </section>
    <section>
      <?php
      $sq_bank_details=mysqli_fetch_assoc(mysqlQuery("select * from bank_master where active_flag='Active' Limit 1"));
      
      
      ?>
    <section class="pageSection main_block">
      <div class="row constingBankingPanelRow">
        <!-- Bank Detail -->
        <div class="col-md-12 constingBankingPanel BankingPanel">
            <h3 class="costBankTitle text-center">BANK DETAILS</h3>
            <div class="col-md-4 text-center mg_bt_30">
              <div class="icon"><img src="<?= BASE_URL ?>images/quotation/p4/bankName.png" class="img-responsive"></div>
              <h4 class="no-marg"><?= ($sq_bank_details['bank_name'] != '') ? $sq_bank_details['bank_name'] : 'NA' ?></h4>
              <p>BANK NAME</p>
            </div>
            <div class="col-md-4 text-center mg_bt_30">
              <div class="icon"><img src="<?= BASE_URL ?>images/quotation/p4/branchName.png" class="img-responsive">      </div>
              <h4 class="no-marg"><?= ($sq_bank_details['branch_name']!= '') ? $sq_bank_details['branch_name'] : 'NA' ?>(<?= ($sq_bank_details['ifsc_code'] != '') ? $sq_bank_details['ifsc_code'] : 'NA' ?>)</h4>
              <p>BRANCH</p>
            </div>
            <div class="col-md-4 text-center mg_bt_30">
              <div class="icon"><img src="<?= BASE_URL ?>images/quotation/p4/accName.png" class="img-responsive"></div>
              <h4 class="no-marg"><?= ($sq_bank_details['account_type'] != '') ? $sq_bank_details['account_type'] : 'NA' ?></h4>
              <p>A/C TYPE</p>
            </div>
            <div class="col-md-4 text-center mg_bt_30">
              <div class="icon"><img src="<?= BASE_URL ?>images/quotation/p4/accNumber.png" class="img-responsive"></div>
              <h4 class="no-marg"><?= ($sq_bank_details['account_no'] != '') ? $sq_bank_details['account_no'] : 'NA' ?></h4>
              <p>A/C NO</p>
            </div>
            <div class="col-md-4 text-center mg_bt_30">
              <div class="icon"><img src="<?= BASE_URL ?>images/quotation/p4/code.png" class="img-responsive"></div>
              <h4 class="no-marg"><?= ($sq_bank_details['account_name'] != '') ? $sq_bank_details['account_name'] : 'NA' ?></h4>
              <p>BANK ACCOUNT NAME</p>
            </div>
            <div class="col-md-4 text-center mg_bt_30">
              <div class="icon"><img src="<?= BASE_URL ?>images/quotation/p4/code.png" class="img-responsive"></div>
              <h4 class="no-marg"><?= ($sq_bank_details['swift_code'] != '') ? $sq_bank_details['swift_code'] : 'NA' ?></h4>
              <p>SWIFT CODE</p>
            </div>
            <?php if(check_qr()) { ?>
          <div class="col-md-12 text-center" style="margin-top:20px; margin-bottom:20px;">
              <?= get_qr('Protrait Creative') ?>
              <br>
              <h4 class="no-marg">Scan & Pay </h4>
          </div>
          <?php } ?>
          </div>
        </div>
    </section>

  <!-- Costing & Banking Page -->
  <section class="pageSection main_block">
    <!-- background Image -->
    <img src="<?= BASE_URL ?>images/quotation/p4/pageBG.jpg" class="img-responsive pageBGImg">
    <section class="contactSection main_block mg_tp_30 text-center pageSectionInner">
        <div class="companyLogo">
          <img src="<?= $admin_logo_url ?>">
        </div>
        <div class="companyContactDetail">
            <h3><?= $app_name ?></h3>
            <?php //if($app_address != ''){ ?>
            <div class="contactBlock">
              <i class="fa fa-map-marker"></i>
              <p><?php echo ($branch_status=='yes' && $role!='Admin') ? $branch_details['address1'].','.$branch_details['address2'].','.$branch_details['city'] : $app_address; ?></p>
            </div>
            <?php //} ?>
            <?php //if($app_contact_no != ''){?>
            <div class="contactBlock">
              <i class="fa fa-phone"></i>
              <p><?php echo ($branch_status=='yes' && $role!='Admin') ? $branch_details['contact_no']  : $app_contact_no; ?></p>
            </div>
            <?php //} ?>
            <?php //if($app_email_id != ''){?>
            <div class="contactBlock">
              <i class="fa fa-envelope"></i>
              <p><?php echo ($branch_status=='yes' && $role!='Admin' && $branch_details['email_id'] != '') ? $branch_details['email_id'] : $app_email_id; ?></p>
            </div>
            <?php //} ?>
            <?php if($app_website != ''){?>
            <div class="contactBlock">
              <i class="fa fa-globe"></i>
              <p><?php echo $app_website; ?></p>
            </div>
            <?php } ?>
            <div class="contactBlock">
              <i class="fa fa-pencil-square-o"></i>
              <p>PREPARED BY : <?= $emp_name?></p>
            </div>
        </div>
    </section>
  </section>

  </body>
</html>