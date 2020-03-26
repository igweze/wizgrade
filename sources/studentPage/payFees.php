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
	This page is the student fee payment
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
                            <i class="fa fa-dollar fa-lg"></i>   Pay Fees Online
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
                          <div class="panel-body wizGrade-line success-pay-div"> 
                            <!-- form --><form class="form-horizontal" id="frmpayFee" role="form">
                              
                              	
							<div class="form-group">
							<label for="selectFee" class="col-lg-4 col-sm-4 control-label">* Select Fee To Pay</label>

								<div class="col-lg-8">
								<div class="iconic-input">
								<i class="fa fa-sort-alpha-asc"></i>

									<select class="form-control"  id="selectFee" name="selectFee" required>

									<option value = "">Please select One</option>

									<?php


										try {

											$feeCategoryDataArr = feeCategoryData($conn);
											$feeCategoryDataCount = count($feeCategoryDataArr);
											
										}catch(PDOException $e) {
										
												wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
										 
										}		
									 
										if($feeCategoryDataCount >= $fiVal){  /* check array is empty */ 

											for($i = $fiVal; $i <= $feeCategoryDataCount; $i++){  /* loop array */	
											
												$fID = $feeCategoryDataArr[$i]["f_id"];
												$feeCategory = $feeCategoryDataArr[$i]["fee"];
												$amount = $feeCategoryDataArr[$i]["amount"];
												$status = $feeCategoryDataArr[$i]["status"];
												
												$feeCategory = trim($feeCategory);
												$amount = trim($amount);
												$status = trim($status);
												
												$amountS = wizGradeCurrency($amount, $curSymbol);



												
												echo '<option value="'.$fID.'"'.$selected.'>
												'.$feeCategory.' - '.$amountS.'</option>' ."\r\n";

											}
											
										}else{
											
												echo '<option value="">Oooooooops Error, could not find fee 
												category.</option>' ."\r\n"; 
											
										}	



									?>


									</select>


								</div>
								</div>
							</div>
									  
							<span id="payLoader" style="display: none;">
								<center><img alt="Please Wait" src="loading.gif"/> <!-- loading image --></center> <!-- loading image -->
							</span>
									  
							<div id="loadPayG"> </div>
							
							<div id="payMethodDiv" class="display-none">
                         	<div class="form-group">
                                      <label  for="payMethod" class="col-lg-4 col-sm-4 control-label">* You  Payment Method </label>
                                     
                                  <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              
                                              <select class="form-control"  id="payMethod" name="payMethod" required>
											  
												<option value = "">Please select one</option>
												<option value = "paypal">Paypal</option>
												<option value = "2Checkout">2Checkout</option>
                                				<!--<option value = "cashEnvoy">Cash Envoy</option>-->
												<option value = "payStack">Paystack</option>
												<option value = "voguePay">Vogue Pay</option>
												
                                               
                                              </select>

                                          </div>
                                      </div>
                                  </div> 
		 

                                 <div class="form-group">                                      
                                    <input name="epayData" value="ePay" type="hidden"  />
                                    <center><button type="submit" class="btn btn-danger buttonMargin" id="placeOrder">                                          
                                    <i class="fa fa-money"></i> Pay  </button></center>                                      
                                  </div>
								  
								</div>  
  

                              </form><!-- / form -->
                          </div> 
                         
						</section>
						
						</div>
                      
					</div>
				
				 
					<!-- / row --> 