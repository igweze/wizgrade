<?php

/*  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 	
	wizGrade V 1.2 (Formerly SDOSMS) is Designed & Developed by Igweze Ebele Mark | https://www.iem.wizgrade.com
	https://www.wizgrade.com
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 	
	Copyright 2014 - 2020 c wizGrade | IGWEZE EBELE MARK 
	
	Licensed under the Apache License, Version 2.0 (the "License");
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

		http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an "AS IS" BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
	wizGrade School App is Dedicated To Almighty God, My Amazing Parents ENGR Mr & Mrs Igweze Okwudili Godwin, 
	To My Fabulous and Supporting Wife Mrs Igweze Nkiruka Jennifer
	and To My Inestimable Sons Osinachi Michael, Ifechukwu Othniel and Naetochukwu Ryan.  
	
	WEBSITE 					PHONES												EMAILS
	https://www.wizgrade.com	+234 - 80 - 30 716 751, +234 - 80 - 22 000 490 		info@wizgrade.com	
	
	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Page/Code Explanation~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	This page load eWallet recharge manager
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>	

                 	<!-- row -->	
					<div class="row">  
     				  <div class="col-lg-7">
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
				
				</div>
				<!-- / row -->
                    
                		
				<!-- row -->	
				<div class="row">  
					<div class="col-lg-12">						  
					  
						<div id="wizgrade-page-div"> </div> <!-- This a div where jquery loads its contents -->					 
					 
					</div>
				</div>
				<!-- / row -->		