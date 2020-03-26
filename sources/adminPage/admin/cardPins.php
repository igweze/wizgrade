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
	This script handle school scratch card pins
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?> 
 		
				<!-- row -->	
					<div class="row">  
					<div class="col-sm-10">
						<section class="panel">
							<header class="panel-heading">                              
								<i class="fa fa-paw fa-lg"></i> Scratch Card Pin <span class="hide-res">Manager</span>
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
												   Card Pins
												</a>
											</li>
										  
											<li>
												<a data-toggle="tab" href="#addCardPin">
												  <i class="fa fa-plus-square"></i>
												  Auto Generate  
												</a>
											</li>
									  </ul>
									</header>
									<div class="panel-body">
										<div class="tab-content"> 											 
											  
											<div id="viewExp" class="tab-pane active"> 								 
												<br clear="all" />
												<div id="viewCardPin"> <?php require 'cardPinsInfo.php';  ?> </div>							  
											</div> 
										  
											<div id="addCardPin" class="tab-pane"> 
										  
												<!-- row -->	
												<div class="row">  
													<div class="col-lg-8"> 
												  
													<br clear="all" />
													
													<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="saveLoader"  
														  style="cursor:pointer; display:none; margin-bottom:5px;" /></center>
						
													<div id="hmsgBox"> </div>
												  
													<!-- form --><form class="form-horizontal" id="frmsaveCardPin" role="form"> 
											  
													<div class="form-group" >
													<label for="pinCount" class="col-lg-5 col-sm-5 control-label"> * 
													No. of Pins to Generate</label>                                      
														<div class="col-lg-7">                                        
														<div class="iconic-input">
														<i class="fa fa-lock"></i>													  
														<input type="number" class="form-control" placeholder="Enter No. of Pins to Generate" 
														name="pinCount"  id="pinCount" maxlength="5" >
														
														</div>
														
														</div>
													</div> 
													
													<div class="form-group" >
													<label for="iiii_serial_iiii" class="col-lg-5 col-sm-5 control-label"> * Enter Card Serial No.</label>                                      
														<div class="col-lg-7">                                        
														<div class="iconic-input">
														<i class="fa fa-lock"></i>													  
														<input type="text" class="form-control" placeholder="Enter Card Serial No." 
														name="iiii_serial_iiii" maxlength="15" id="iiii_serial_iiii" >
														
														</div>
														
														</div>
													</div> 
												  
													<div class="form-group">									  
														<input type="hidden" name="cardPinData" value="saveCardPin" /> 	
														<center><button type="submit" class="btn btn-danger buttonMargin demoDisenable" id="saveCardPin">
														<i class="fa fa-check-square-o"></i> Generate  </button></center>
													  
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
				
				<!-- cardPin information removal pop up modal start -->	
				<a href="#removeModal" data-toggle="modal" id="modalRemoveBtn" class=""> </a>
				
				<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" 
				aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					<div class="modal-dialog">
					  <div class="modal-content">
						  <div class="modal-header">
							  <button type="button" class="close" 
							  data-dismiss="modal" aria-hidden="true">
							  <span style='color:#fff !important;'>&times;</span></button>
							  <h4 class="modal-iiii_pin_iiii"> Are sure you want to remove this Scratch Card Pin information ?
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
							  <button  class="btn btn-danger demoDisenable" id="removeCardPin" 
							  type="button">Yes</button>
							  <button data-dismiss="modal" class="btn btn-danger" 
							  type="button">Cancel</button>
						  </div>
					  </div>
					</div>
				</div>
				<!-- cardPin information removal pop up modal end -->	
		  
				<!-- cardPin information edit pop up modal start -->	
				<a href="#editModal" data-toggle="modal" id="modalEditBtn" class=""> </a>

				<div class="modal fade" id="editModal" tabindex="-1" role="dialog" 
					aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					<div class="modal-dialog">
					  <div class="modal-content">
						  <div class="modal-header">
							  <button type="button" class="close" 
							  data-dismiss="modal" aria-hidden="true">
							  <span style='color:#fff !important;'>&times;</span></button>
							  <h4 class="modal-iiii_pin_iiii"> Scratch Card Pin  <span class="hide-res">Manager</span>
							  </h4>
						  </div>
						  <div class="modal-body modal-body-scroll"> 
						 
								<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="editLoader"  
												  style="cursor:pointer; display:none; margin-bottom:5px;" /></center>
				
								<div id="editMsg"> </div> 
										
								<div class="slideUpFrmUDiv">
					 
									<section class="panel">
									
									<div class="panel-body"> 
									
										<div id="editCardPinDiv"></div> 
										  
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
				<!-- cardPin information edit pop up modal end -->	
			  