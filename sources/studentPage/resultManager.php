<!--
 
	wizGrade V 1
	Copyright 2017 SOFT DIGIT LTD

	wizGrade is Dedicated To Almighty God, To My Parents, To My Fabulous and Supporting Wife Nkiruka 
	and To My Inestimable Sons Osinachi and Ifechukwu.

	This product includes responsive web and mobile application developed at SOFT DIGIT LTD by Mr Igweze Ebele Mark
	
	wizGrade Contacts and Supports
	
	WEBSITE 					PHONES
	https://www.wizgrade.com		+234 - 80 - 30 716 751, 		+234 - 80 - 22 000 490 
	
	EMAILS		SALES						SUPPORT						
				sales@wizgrade.com			info@wizgrade.com
	
	
	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Page/Code Explanation~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	This page is the student result search manager
		
-->

<?php

		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
	 

?>

 		
			 
                 	<!-- row -->	
					<div class="row">  
						<div class="col-lg-6">
						<section class="panel wizgrade-section-div">
                      	
							<header class="panel-heading">
                            <i class="fa fa-book fa-lg"></i>  Results Manager
							<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line"> 
							
						 
								<!-- form -->
								<form class="form-horizontal" id="frmviewRs" role="form">
                              
                              	
								 
								 
								<!-- 
								<div class="form-group">
                                      <label for="rsType" class="col-lg-4 col-sm-4 control-label">* Result Type</label>
                                     
                                  <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-clock-o"></i>
                                              
                                              <select class="form-control"  id="rsType" name="rsType" required>
												<?php


													foreach($rsTypeArr as $rsTypeKey => $rsTypeVal){

														if ($rsType == $rsTypeKey){
															
															$selected = "SELECTED";
															
														} else {
															
															$selected = "";
															
														}

														echo '<option value="'.$rsTypeKey.'"'.$selected.'>'.$rsTypeVal.'</option>' ."\r\n";

													}

												?>
									   
                                              </select>
                                          </div>
										  <span class='label label-danger'>NOTE!</span>
											<span style='color:#ff0000'>This is for demo purpose only. Meanwhile, only one 
											result type is allowed at a time.  </span>
                                      </div>
                                  </div>
								 
								-->  
                              	<div class="form-group">
                                      <label for="level" class="col-lg-4 col-sm-4 control-label">* School Level</label>
                                     
                                  <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-level-up"></i>
                                              
                                              <select class="form-control"  id="level" name="level" required>
                                              
                                				<option value = "">Please select One</option>
												<?php 
													try {
														
														studentLevel($conn);  /* retrieve student level */
												 
														}catch(PDOException $e) {
							
															wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
														} 
												?>
                                              
                                              
                                              </select>
                                          </div>
                                      </div>
                                  </div>


                              	<div class="form-group">
                                      <label for="term" class="col-lg-4 col-sm-4 control-label">* School Term</label>
                                     
                                  <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-level-up"></i>
                                              
                                              <select class="form-control"  id="term" name="term" required>
                                              
                                				<option value = "">Please select One</option>
                                
												 <?php

														foreach($term_list as $term_key => $term_value){    /* loop array */

															if ($term_list == $term_value){
															$selected = "SELECTED";
															} else {
															$selected = "";
															}

															echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";
															

														}
														if($rsType == $fiVal){
															echo '<option value="all"'.$selected.'>Annual Result</option>' ."\r\n";
														}

												 ?>

                                              
                                              </select>
                                          </div>
                                      </div>
                                  </div>
								  
								<span id="wait_1" style="display: none;"> <center><img alt="Please Wait" src="loading.gif"/> <!-- loading image --></center> <!-- loading image --> </span>
    							<span id="result_1" style="display: none;"></span> <!-- loading div -->  <!-- jquery loading div -->  

		 

                                 <div class="form-group display-nonea">
                                      
                                          <input name="rsData" value="viewRs" type="hidden"  />
                                          <center><button type="submit" class="btn btn-danger buttonMargin" id="viewRs">
                                          <i class="fa fa-check-square-o"></i> View  </button></center>
                                      
                                  </div>
  

                              </form><!-- / form -->
							  <!-- form -->
                          </div>
                         
                      </section>
                      </div>
					  
					  <?php  if(trim($ewalletCheck) != trim($i_false)) {?>
					  
					  <div class="col-lg-6 checkRSDiv">
							<section class="panel wizgrade-section-div">
							<header class="panel-heading"> 
							 
								<i class="fa fa-info-circle fa-lg"></i> Checking Result Instruction
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line">  
							
									<?php
				
										$msg_i = 'Please recharge your <span style="color:#000;font-weight:bold;">e-Wallet</span> 
										for the particular school level and term(annual) result you intend to view. 
										Hence, once a student recharge their 
										<span style="color:#000;font-weight:bold;">e-Wallet</span> for the school level and term(annual), 
										the do 
										have unlimited access to
										the said result forever. <span style="color:#000;font-weight:bold; font-size:18px;">
										<a  href="javascript:;">Click here to your recharge e-Wallet.</a></span>';
										
										echo $infMsg.$msg_i.$msgEnd;

									?>
                          
							</div>
							</section> 
                      
						</div>
						
						
						
						<div class="col-lg-6 checkeWalletDiv display-none">
						<section class="panel wizgrade-section-div">
                      	
                          <header class="panel-heading">
                            <i class="fa fa-money fa-lg"></i> Recharge My E-Wallet
							<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
                          <div class="panel-body wizGrade-line"> 
                          
                          <center><img src="loading.gif" alt="Loading >>>>>" id="rechargeLoader" 
									  style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>
                          <div id="msgBoxR"></div>
                          
                              <!-- form --><form class="form-horizontal" id="frmrechargeWallet" role="form">
                              
								<div class="form-group">
                                      <label for="level" class="col-lg-4 col-sm-4 control-label">* School Level</label>
                                
                                  <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-level-up"></i>
                                              
                                              <select class="form-control"  id="level" name="level" required>
                                              
                                				<option value = "">Please select One</option>
												<?php 
													 try {
														
														studentLevel($conn);  /* retrieve student level */
												 
														}catch(PDOException $e) {
							
														wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
														} 
												?>

                                              
                                              </select>
                                          </div>
                                      </div>
                                  </div>

                         	<div class="form-group">
                                      <label  for="term" class="col-lg-4 col-sm-4 control-label">* School Term</label>
                                     
                                  <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              
                                              <select class="form-control"  id="term" name="term" required>
                                              
                                				 
												 <?php

													
													if($ewalletCheck == $seVal){
														
														$selected = "SELECTED";
														echo '<option value="'.$foVal.'"'.$selected.'> Annual</option>' ."\r\n";
														
													}else{	
													
														try {
														
																$curTerm = currentSessionTerm($conn);    /* current school term  */
												 
														}catch(PDOException $e) {
							
														wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
														} 


														foreach($term_list as $term_key => $term_value){    /* loop array */

															if ($curTerm == $term_key){
																$selected = "SELECTED";
															} else {
																$selected = "";
															}

															echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

														}
													
													}

												 ?>
                                              
                                              </select>

                                          </div>
                                      </div>
                                  </div>

                              	
                                  <div class="form-group">
                                      <label for="card_pin"  class="col-lg-4 col-sm-4 control-label">* Scratch Pin No.
                                       </label>
                                      <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-key"></i>
                                              <input type="password" class="form-control" placeholder="111133334444" 
                                              name="card_pin" id="card_pin" required />
                                          </div>
                                      </div>
                                  </div>

                                 <div class="form-group">
                                      
                                          <input name="eWalletData" value="recharge" type="hidden"  />
                                          <center><button type="submit" class="btn btn-danger buttonMargin" id="rechargeWallet">
                                          
                                          <i class="fa fa-check-square-o"></i> Recharge </button></center>
                                      
                                  </div>
  

                              </form><!-- / form -->
                          </div>
                         
						</section>
						</div>
					  
						<?php } ?>  
						
						
					  
					</div>
                    <!-- /row -->
					
                	 
					<!-- row -->	
					<div class="row">    <div id="hiRSData" class="display-none"></div>
						<div class="col-lg-12">						  
					  
							<div id="wizgrade-page-div"> </div> <!-- This a div where jquery loads its contents -->					 
					 
						</div>
					</div>
					<!-- /row -->					  