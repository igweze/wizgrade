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
	This page is achool annoucements manager
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?> 
 		
				<!-- row -->			
				<!-- row -->	
					<div class="row">  
					<div class="col-sm-12">
						<section class="panel">
							<header class="panel-heading">                              
								<i class="fa fa-bullhorn fa-lg"></i> <span class="hide-res">School</span> Annoucements <span class="hide-res">Manager</span>
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line"> 
				  
								<!--tab nav start-->
								<section class="panel">
									<header class="panel-heading tab-bg-dark-navy-blue" id="scrollTarget">
									  <ul class="nav nav-tabs nav-justified">
										  <li class="active">
											  <a data-toggle="tab" href="#viewExp">
												  <i class="fa fa-home"></i>
												  School Annoucements
											  </a>
										  </li>
										  
										  <li>
											  <a data-toggle="tab" href="#addBroadcast">
												  <i class="fa fa-plus-square"></i>
												  Add New  
											  </a>
										  </li>
									  </ul>
									</header>
									<div class="panel-body">
										<div class="tab-content"> 											 
											  
											<div id="viewExp" class="tab-pane active"> 								 
												<br clear="all" />
												<div id="viewBroadcast"> <?php require 'wizGradeBroadcastInfo.php';  ?> </div>							  
											</div> 
										  
											<div id="addBroadcast" class="tab-pane"> 
										  
												<!-- row -->	
												<div class="row">  
													<div class="col-lg-10"> 
												  
													<br clear="all" />
													<span id="eAmount" class="display-none"></span>
													<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="saveLoader"  
														  style="cursor:pointer; display:none; margin-bottom:5px;" /></center>
						
													<div id="hmsgBox"> </div>
												  
													<!-- form --><form class="form-horizontal" id="frmsaveBroadcast" role="form"> 
											  
													<div class="form-group" >
													<label for="title" class="col-lg-4 col-sm-4 control-label"> * Broadcast Title</label>                                      
														<div class="col-lg-8">                                        
														<div class="iconic-input">
														<i class="fa fa-comment"></i>													  
														<input type="text" class="form-control" placeholder="Enter Broadcast Title" 
														name="title"  id="title" required>
														
														</div>
														
														</div>
													</div> 
											  
													<div class="form-group">
													<label for="broadcastMsg" class="col-lg-4 col-sm-4 control-label">* Broadcast Details</label>                                      
														<div class="col-lg-8">                                        
														<textarea rows="4" cols="10" class="form-control" name="broadcastMsg" id="broadcastMsg" 
														placeholder="Broadcast Message"></textarea>                                           
														</div>
													</div>  
											  
													<div class="form-group">
															  <label class="control-label col-lg-4 col-sm-4">* Broadcast Date:</label>
															  <div class="col-lg-7 col-sm-7">
																  <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" 
																  data-date="2012-12-02"  
																  class="input-append date dpYears">
																	  <input type="text" readonly="" 
																	  value="<?php echo $bDay; ?>" 
																	  size="10" class="form-control"  name="bDay"  required />
																	  <span class="input-group-btn add-on">
																		<button class="btn btn-danger" type="button">
																		<i class="fa fa-calendar"></i></button>
																	  </span>
																  </div>
																  <span class="help-block">Select date</span>
															  </div>
													</div> 
												  
													<div class="form-group">									  
														<input type="hidden" name="broadcastData" value="saveBroadcast" /> 	
														<center><button type="submit" class="btn btn-danger buttonMargin" id="saveBroadcast">
														<i class="fa fa-save"></i> Save  </button></center>
													  
													</div>
													
													</form><!-- / form --> 
												
													</div>
												  
												</div>
											  
												 
											
											</div> 

											  
										  
										</div>
										  
									</div>
									<!--</div>-->
								</section>
								<!--tab nav start-->

						  
                       
                        	</div>
						</section>
					</div>
				  
				</div>
				
				<!-- broadcast information removal pop up modal start -->	
				<a href="#removeModal" data-toggle="modal" id="modalRemoveBtn" class=""> </a>
				
				<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" 
				aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					<div class="modal-dialog">
					  <div class="modal-content">
						  <div class="modal-header">
							  <button type="button" class="close" 
							  data-dismiss="modal" aria-hidden="true">
							  <span style='color:#fff !important;'>&times;</span></button>
							  <h4 class="modal-title"> Are sure you want to remove this broadcast information ?
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
							  <button  class="btn btn-danger demoDisenable" id="removeBroadcast" 
							  type="button">Yes</button>
							  <button data-dismiss="modal" class="btn btn-danger" 
							  type="button">Cancel</button>
						  </div>
					  </div>
					</div>
				</div>
				<!-- broadcast information removal pop up modal end -->	
		  
				<!-- broadcast information edit pop up modal start -->	
				<a href="#editModal" data-toggle="modal" id="modalEditBtn" class=""> </a>

				<div class="modal fade" id="editModal" tabindex="-1" role="dialog" 
					aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					<div class="modal-dialog">
					  <div class="modal-content">
						  <div class="modal-header">
							  <button type="button" class="close" 
							  data-dismiss="modal" aria-hidden="true">
							  <span style='color:#fff !important;'>&times;</span></button>
							  <h4 class="modal-title"> Annoucements  Manager
							  </h4>
						  </div>
						  <div class="modal-body modal-body-scroll"> 
						 
								<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="editLoader"  
												  style="cursor:pointer; display:none; margin-bottom:5px;" /></center>
				
								<div id="editMsg"> </div> 
										
								<div class="slideUpFrmUDiv">
					 
									<section class="panel">
									
									<div class="panel-body"> 
									
										<div id="editBroadcastDiv"></div> 
										  
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
			  
			  <script type='text/javascript'>  $('.dpYears').datepicker();   </script> 
			  <!-- broadcast information edit pop up modal end -->	