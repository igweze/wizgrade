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
	This page handle staff SMS
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */
 	

		try {
				
				$staffToken = staffToken($conn); /* rettieve all active school staff information */ 
				

		}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		}
		
?>
 
 				
               <!-- row -->	
					<div class="row">  
					<div class="col-sm-12">
                      <section class="panel">
                          <header class="panel-heading">
                             
							 <i class="fa fa-wrench fa-lg"></i> Send SMS <span class="hide-res">To School Staff/s</span>
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
                          <div class="panel-body wizGrade-line">
						  
                
                          <header class="panel-heading">
                              <ul class="nav nav-tabs nav-justified">
                                  
                                  <li class="active">
                                      <a data-toggle="tab" href="#smsDiv1">
                                          <i class="fa fa-user"></i>
                                          SMS Staff/s
                                      </a>
                                  </li>
                                  <li class="">
                                      <a data-toggle="tab" href="#smsDiv2">
                                          <i class="fa fa-envelope-o"></i>
                                         SMS All Staffs
                                      </a>
                                  </li>
                              </ul>
                          </header>
                          <div class="panel-body">
                              <div class="tab-content">
                                  
                                  <div id="smsDiv1" class="tab-pane active"> 
								  
									  <section class="panel">
									
									  <div class="panel-body"> 
										<div id="testata"></div>
			  
										  <!-- form --><form class="form-horizontal" id="frmstaffSMS" role="form">  
			  
												<div class="form-group">
												  <div class="col-lg-12">
													  
														  <input type="text" class="form-control" 
														  name="staffData" id="staffs" placeholder="search for staff/s" required />
														<!-- using jquery tokenfield to populate staff/s information to staffData input field -->
														<script type='text/javascript'>  
															  			
															  $('#staffs').tokenfield({
																  autocomplete: {
																	source: [<?php echo $staffToken; ?>],
																	delay: 100
																  },
																  showAutocompleteOnFocus: true
															  })
															  
														</script> 
														
												  </div>
											  </div> 

											  <div class="form-group">
												  <div class="col-lg-12">
													  <div class="iconic-input">
														  <i class="fa fa-envelope"></i>
														  <textarea class="form-control" name="message" id="smsFiMsg" 
														  style="padding: 5px 30px;" 
														  placeholder="Write your mesaage here" rows="10" required></textarea>
														 
													  </div>
														 <span id="remaining_fi" class="label label-info">160</span>&nbsp;
														 Character
														 <span class="cplural_fi">s</span> 
														 Remaining Total&nbsp;
														 <span id="messages_fi" class="label label-warning">1</span>&nbsp;
														 Message<span class="mplural_fi">s</span>
														 &nbsp;<span id="total_fi" class="tplural_fi label label-info">0</span>&nbsp;
														 Character<span class="tplural_fi">s</span>
												  </div>
											  </div> 

											 <div class="form-group"> 
													  <input type="hidden" name="sendTextMsg" value="staffSMS"/>
													  <center><button type="submit" class="btn btn-danger buttonMargin" id="staffSMS">
													  <i class="fa fa-mail-forward"></i> Send Text </button></center>
													 
											  </div>
			  

										  </form><!-- / form -->
									  </div>
									 
									</section> 
                                  
                                  </div>

								  <div id="smsDiv2" class="tab-pane ">
                                  
									  <section class="panel">
									  
									  <div class="panel-body"> 
									  
										  <!-- form --><form class="form-horizontal" id="frmstaffsSMS" role="form"> 
											 
											  <div class="form-group">
												  <div class="col-lg-12">
													  <div class="iconic-input">
														  <i class="fa fa-envelope"></i>
														  <textarea class="form-control" name="message" id="smsSeMsg" 
														  style="padding: 5px 30px;" 
														  placeholder="Write your mesaage here" rows="10" required></textarea>
														 
													  </div>
														 <span id="remaining_se" class="label label-info">160</span>&nbsp;Character
														 <span class="cplural_se">s</span> 
														 Remaining Total&nbsp;
														 <span id="messages_se" class="label label-warning">1</span>&nbsp;
														 Message<span class="mplural_se">s</span>
														 &nbsp;<span id="total_se" class="tplural_se label label-info">0</span>&nbsp;
														 Character<span class="tplural_se">s</span>
												  </div>
											  </div> 

											 <div class="form-group">
													  <input type="hidden" name="sendTextMsg" value="allStaffSMS"/>
													  <center><button type="submit" class="btn btn-danger buttonMargin" id="staffsSMS">
													  <i class="fa fa-mail-forward"></i> Send Text  </button></center>
													  
													  
												  </div>  

										  </form><!-- / form -->
									  </div>
									 
								  </section>
                                  
                                  
                                  </div>
                              </div>
                          </div>
                     
					 
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
				
				<!-- jquery sms manager start -->		
				<script type="text/javascript">
					
								
								
					$('#smsFiMsg').keyup(function(){
						
						var part1Count = 160; var part2Count = 145; var part3Count = 152;								 
						var chars = $(this).val().length;
							messages = 0;
							remaining = 0;
							total = 0;
						if (chars <= part1Count) {
							messages = 1;
							remaining = part1Count - chars;
						} else if (chars <= (part1Count + part2Count)) { 
							messages = 2;
							remaining = part1Count + part2Count - chars;
						} else if (chars > (part1Count + part2Count)) { 
							moreM = Math.ceil((chars - part1Count - part2Count) / part3Count) ;
							remaining = part1Count + part2Count + (moreM * part3Count) - chars;
							messages = 2 + moreM;
						}
						$('#remaining_fi').text(remaining);
						$('#messages_fi').text(messages);
						$('#total_fi').text(chars);
						if (remaining > 1) $('.cplural_fi').show();
							else $('.cplural_fi').hide();
						if (messages > 1) $('.mplural_fi').show();
							else $('.mplural_fi').hide();
						if (chars > 1) $('.tplural_fi').show();
							else $('.tplural_fi').hide();
					});
					
					$('#smsFiMsg').keyup();

					$('#smsSeMsg').keyup(function(){
						
						var part1Count = 160; var part2Count = 145; var part3Count = 152;								 
						var chars = $(this).val().length;
							messages = 0;
							remaining = 0;
							total = 0;
						if (chars <= part1Count) {
							messages = 1;
							remaining = part1Count - chars;
						} else if (chars <= (part1Count + part2Count)) { 
							messages = 2;
							remaining = part1Count + part2Count - chars;
						} else if (chars > (part1Count + part2Count)) { 
							moreM = Math.ceil((chars - part1Count - part2Count) / part3Count) ;
							remaining = part1Count + part2Count + (moreM * part3Count) - chars;
							messages = 2 + moreM;
						}
						$('#remaining_se').text(remaining);
						$('#messages_se').text(messages);
						$('#total_se').text(chars);
						if (remaining > 1) $('.cplural_se').show();
							else $('.cplural_se').hide();
						if (messages > 1) $('.mplural_se').show();
							else $('.mplural_se').hide();
						if (chars > 1) $('.tplural_se').show();
							else $('.tplural_se').hide();
					});
					
					$('#smsSeMsg').keyup(); 

				</script>
				<!-- jquery sms manager end -->		