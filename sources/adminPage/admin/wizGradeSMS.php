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
	This page is the SMS gateway manager
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?> 			
				
				<!-- row -->	
					<div class="row">  
					<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <i class="fa fa-wrench fa-lg"></i> SMS Gateway <span class="hide-res">Manager</span>
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span> 
                          </header>
                          <div class="panel-body wizGrade-line"> 
						  
                              <div id="viewSMS" class="tab-pane active"> <?php require 'wizGradeSMSInfo.php';  ?> </div>	 
				
							</div>
                      </section>
					</div>
				  
				</div>
				<!-- / row -->	

					
							<!-- sms gateways removal pop up modal start -->
							<a href="#removeModal" data-toggle="modal" id="modalRemoveBtn" class=""> </a>

							<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" 
							aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
									  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" 
                                              data-dismiss="modal" aria-hidden="true">
											  <span style='color:#fff !important;'>&times;</span></button>
                                              <h4 class="modal-api"> Are sure you want to remove this SMS information ?
											  </h4>
                                          </div>
                                          <div class="modal-body"> 
					 
												<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="removeLoader"  
													style="cursor:pointer; display:none; margin-bottom:5px;" /></center>
			
												<div id="removeMsg"> </div> 
									
												<div class="slideUpFrmDiv">
									 
													<section class="panel">
													
														<div class="panel-body">
														
															<div id="removeHData" style="display:none;"></div>
														
															<?php 
															
															echo "$infoMsgNX  Are sure you want to remove? <br />
															<span style='color:#000;font-weight:bold;'  id='removeInfo'> </span> $msgEnd";
															?> 
															  
														</div>
													
													</section>
										  
												</div>

                                          </div>
                                          <div class="modal-footer slideUpFrmDiv">
                                              <button  class="btn btn-danger" id="removeSMS" 
                                              type="button">Yes</button>
											  <button data-dismiss="modal" class="btn btn-danger" 
                                              type="button">Cancel</button>
                                          </div>
                                      </div>
                                  </div>
                            </div>
							<!-- sms gateways removal pop up modal end -->  
							
							<!-- sms gateways tasks pop up modal start -->
							<a href="#editModal" data-toggle="modal" id="modalEditBtn" class=""> </a>

							<div class="modal fade" id="editModal" tabindex="-1" role="dialog" 
							aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" 
                                              data-dismiss="modal" aria-hidden="true">
											  <span style='color:#fff !important;'>&times;</span></button>
                                              <h4 class="modal-api"> SMS Gateway Manager
											  </h4>
                                          </div>
                                          <div class="modal-body modal-body-scroll"> 
					 
												<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="editLoader"  
												style="cursor:pointer; display:none; margin-bottom:5px;" /></center>
			
													<div id="editMsg"> </div> 
									
													<div class="slideUpFrmUDiv">
										 
														<section class="panel">
														
															<div class="panel-body"> 
																
																<div id="editSMSDiv"></div> 
																  
															</div>
														
														</section>
											  
													</div>

                                          </div>
                                          <div class="modal-footer slideUpFrmDiv">
                                              
											  <button data-dismiss="modal" class="btn btn-danger" 
                                              type="button">Close</button>
                                          </div>
                                      </div>
                                  </div>
								</div>
								<!-- sms gateways tasks pop up modal end --> 