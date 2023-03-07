<div class="row">
	<div class="col-md-12">
		<div class="profile_box main_block">
    	 	<?php 
               
				$count = 0;
				$sq_visa = mysqli_fetch_assoc(mysqlQuery($query));
    	 	?>
               <span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <?php echo "<label>Country Name <em>:</em></label>".$sq_visa['country_id'] ?>
	            </span>
	            <span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <?php echo "<label>Type Of Visa <em>:</em></label> ".$sq_visa['visa_type'] ?>
	            </span>
	            <span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <?php echo "<label>Basic Amount B2C<em>:</em></label> ".number_format($sq_visa['fees'],2) ?>
	            </span>
	            <span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <?php echo "<label>Markup cost B2C<em>:</em></label> ".number_format($sq_visa['markup'],2) ?>
	            </span>
				<span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <?php echo "<label>Basic Amount B2B<em>:</em></label> ".number_format($sq_visa['fees_b2b'],2) ?>
	            </span>
	            <span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <?php echo "<label>Markup cost B2B<em>:</em></label> ".number_format($sq_visa['markup_b2b'],2) ?>
	            </span>
	            <span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <?php echo "<label>Time Taken <em>:</em></label> ".$sq_visa['time_taken'] ?>
	            </span>
	            <?php
                if($sq_visa['upload_url']!=""){
                	$newUrl1 = preg_replace('/(\/+)/','/',$sq_visa['upload_url']); ?>	
                <span class="main_block">
                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
                  <?php echo "<label>Form 1 <em>:</em></label> "?><a href="<?php echo $newUrl1; ?>" download title="Download Form"><i class="fa fa-id-card-o"></i></a> 
                </span>
                <?php }
                if($sq_visa['upload_url2']!=""){
                	$newUrl2 = preg_replace('/(\/+)/','/',$sq_visa['upload_url2']); ?>	
                <span class="main_block">
                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
                  <?php echo "<label>Form 2 <em>:</em></label> "?><a href="<?php echo $newUrl2; ?>" download title="Download Form"><i class="fa fa-id-card-o"></i></a> 
                </span>
                <?php }
                if($sq_visa['upload_url3']!=""){
                	$newUrl3 = preg_replace('/(\/+)/','/',$sq_visa['upload_url3']); ?>	
                <span class="main_block">
                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
                  <?php echo "<label>Form 3 <em>:</em></label> "?><a href="<?php echo $newUrl3; ?>" download title="Download Form"><i class="fa fa-id-card-o"></i></a> 
                </span>
                <?php }
                if($sq_visa['upload_url4']!=""){
                	$newUrl4 = preg_replace('/(\/+)/','/',$sq_visa['upload_url4']); ?>	
                <span class="main_block">
                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
                  <?php echo "<label>Form 4 <em>:</em></label> "?><a href="<?php echo $newUrl4; ?>" download title="Download Form"><i class="fa fa-id-card-o"></i></a> 
                </span>
                <?php }
                if($sq_visa['upload_url5']!=""){
                	$newUrl5 = preg_replace('/(\/+)/','/',$sq_visa['upload_url5']); ?>	
                <span class="main_block">
                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
                  <?php echo "<label>Form 5 <em>:</em></label> "?><a href="<?php echo $newUrl5; ?>" download title="Download Form"><i class="fa fa-id-card-o"></i></a> 
                </span>
                <?php } ?>	 	 

	            <div class="main_block">
	            <span class="main_block">
	                  <i class="fa fa-angle-double-right cost_arrow" aria-hidden="true"></i>
	                  <label>List Of Documents <em>:</em></label>
	            </span>
	            	<div class="">
	            		<?= ($sq_visa['list_of_documents'] != '') ? $sq_visa['list_of_documents'] : 'NA' ?>
	            	</div>
	            </div>
		</div>
    </div>
</div>

