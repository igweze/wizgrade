<?php

/*   
	Copyright (C) fobrain Tech LTD (2014 - 2024) - All Rights Reserved
	
	Licensed under the Apache License, Version 2.0 (the 'License');
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an 'AS IS' BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License	
	 
	#####################################################################################################
	fobrain (wizgrade open source) app is designed & developed by Igweze Ebele Mark for fobrain Tech LTD
	#####################################################################################################

	fobrain is Dedicated To Almighty God, My fabulous FAMILY and Amazing Parents.  
	
	WEBSITE 							PHONES/WHATSAPP					EMAILS
	https://www.fobrain.com				+234 - 80 30 716 751  			opensource@fobrain.com
										+234 - 80 22 000 490 	
	
	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Page/Code Explanation~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	This script handle school grades
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?> 
 		
				<!-- row -->	
					<div class="row">  
					<div class="col-sm-8">
						<section class="panel">
							<header class="panel-heading">                              
								<i class="fa fa-bullhorn fa-lg"></i> School Grades Manager
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
												  School Grades
											  </a>
										  </li>
										  
										  <li>
											  <a data-toggle="tab" href="#addGrade">
												  <i class="fa fa-plus-square"></i>
												  Add New Grades
											  </a>
										  </li>
									  </ul>
									</header>
									<div class="panel-body">
										<div class="tab-content"> 											 
											  
											<div id="viewExp" class="tab-pane active"> 								 
												<br clear="all" />
												<div id="viewGrade"> <?php require 'wizGradeGradeInfo.php';  ?> </div>							  
											</div> 
										  
											<div id="addGrade" class="tab-pane"> 
										  
												<!-- row -->	
												<div class="row">  
													<div class="col-lg-12"> 
												  
													<br clear="all" />
													
													<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="saveLoader"  
														  style="cursor:pointer; display:none; margin-bottom:5px;" /></center>
						
													<div id="hmsgBox"> </div>
												  
													<!-- form --><form class="form-horizontal" id="frmsaveGrade" role="form"> 
											  
													<div class="form-group" >
													<label for="fromGrade" class="col-lg-5 col-sm-5 control-label"> * Score From (Lowest Score)</label>                                      
														<div class="col-lg-7">                                        
														<div class="iconic-input">
														<i class="fa fa-comment"></i>													  
														<input type="number" class="form-control" placeholder="Enter Grade From" 
														name="fromGrade"  id="fromGrade" required>
														
														</div>
														
														</div>
													</div> 
													
													<div class="form-group" >
													<label for="toGrade" class="col-lg-5 col-sm-5 control-label"> * Score To  (Highest Score)</label>                                      
														<div class="col-lg-7">                                        
														<div class="iconic-input">
														<i class="fa fa-comment"></i>													  
														<input type="number" class="form-control" placeholder="Enter Grade From" 
														name="toGrade"  id="toGrade" required>
														
														</div>
														
														</div>
													</div>
													
													<div class="form-group" >
													<label for="grade" class="col-lg-5 col-sm-5 control-label"> * Score Grade</label>                                      
														<div class="col-lg-7">                                        
														<div class="iconic-input">
														<i class="fa fa-comment"></i>													  
														<input type="text" class="form-control" placeholder="Enter Score Grade" 
														name="grade"  id="grade" required>
														
														</div>
														
														</div>
													</div> 
												  
													<div class="form-group">									  
														<input type="hidden" name="gradeData" value="saveGrade" /> 	
														<center><button type="submit" class="btn btn-danger buttonMargin" id="saveGrade">
														<i class="fa fa-save"></i> Save Grade </button></center>
													  
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
				
				<!-- grade information removal pop up modal start -->	
				<a href="#removeModal" data-toggle="modal" id="modalRemoveBtn" class=""> </a>
				
				<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" 
				aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					<div class="modal-dialog">
					  <div class="modal-content">
						  <div class="modal-header">
							  <button type="button" class="close" 
							  data-dismiss="modal" aria-hidden="true">
							  <span style='color:#fff !important;'>&times;</span></button>
							  <h4 class="modal-fromGrade"> Are sure you want to remove this grade information ?
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
							  <button  class="btn btn-danger demoDisenable" id="removeGrade" 
							  type="button">Yes</button>
							  <button data-dismiss="modal" class="btn btn-danger" 
							  type="button">Cancel</button>
						  </div>
					  </div>
					</div>
				</div>
				<!-- grade information removal pop up modal end -->	
		  
				<!-- grade information edit pop up modal start -->	
				<a href="#editModal" data-toggle="modal" id="modalEditBtn" class=""> </a>

				<div class="modal fade" id="editModal" tabindex="-1" role="dialog" 
					aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					<div class="modal-dialog">
					  <div class="modal-content">
						  <div class="modal-header">
							  <button type="button" class="close" 
							  data-dismiss="modal" aria-hidden="true">
							  <span style='color:#fff !important;'>&times;</span></button>
							  <h4 class="modal-fromGrade"> Grades  Manager
							  </h4>
						  </div>
						  <div class="modal-body modal-body-scroll"> 
						 
								<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="editLoader"  
												  style="cursor:pointer; display:none; margin-bottom:5px;" /></center>
				
								<div id="editMsg"> </div> 
										
								<div class="slideUpFrmUDiv">
					 
									<section class="panel">
									
									<div class="panel-body"> 
									
										<div id="editGradeDiv"></div> 
										  
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
				<!-- grade information edit pop up modal end -->	
			  