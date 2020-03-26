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
	This page is online student assignment manager
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?> 
 		
					<!-- row -->
					<div class="row" id="assignQSlideDiv">
						<div class="col-sm-7">
						<section class="panel">
							<header class="panel-heading">                            
							<i class="fa fa-cubes fa-lg"></i> CBT Assignment <span class="hide-res">Manager</span>
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>	
							</header>
							<div class="panel-body wizGrade-line"> 
							
							<!-- form -->
                            <!-- form --><form class="form-horizontal" id="frmsaveAssign" role="form">
                              
							  
								<div class="form-group">
                                    <label  for="subjTerm" class="col-lg-4 col-sm-4 control-label">* Select Term</label>                                     
									<div class="col-lg-8">
											<div class="iconic-input">
												<i class="fa fa-book"></i>                                              
												<select class="form-control"  id="subjTerm" name="eTerm" required>
                                              
                                				<option value = "">Please select One</option>
												<?php 

													foreach($term_list as $term_key => $term_value){    /* loop array */

														if ($curTerm == $term_key){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

													}

												?> 
                                              </select>
                                              <input type="hidden" value="saveAssign" name = "onlineAssignData"/>
											  <input type="hidden" value="<?php echo $fiVala.':<$?$>:'.$fiVala.':<$?$>:'.$fiVala; ?>" 
											  name = "euData" id="euData"/>
											  
											</div>
                                    </div>
                                </div> 
								
								<span id="wait" style="display: none;"> <center><img alt="Please Wait" src="loading.gif"/> <!-- loading image --></center> <!-- loading image --> </span>
    							<span id="result" style="display: none;"></span>  <!-- jquery loading div -->
								
								<div id="subjectExamDiv" style="display:none;">   
								
								<?php if ($admin_grade == $staffGrade) {  ?>
								
									<div class="form-group">
										<label for="subjectLevel" class="col-lg-4 col-sm-4 control-label">*  School Level</label>                                     
										<div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-clock-o"></i>                                              
                                              <select class="form-control"  id="subjectLevel" name="subjectLevel" required>
                                              
                                				<option value = "">Please select One</option>
												<?php 
												
												   try  {
														
															formTeacherSession($conn, $adminID, $wizGradeMode);  /* class teacher school session  */ 
												 
														}catch(PDOException $e) {
							
															wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
														} 
														
												?>
                                              
                                              </select>
											  <input type="hidden" name ="classAll" id="classAll" value="<?php echo $i_false; ?>" />
                                          </div>
										</div>
									</div>
								  
								<?php
								}else{
									
								?>	
								
								
								<div class="form-group">
                                    <label for="subjectLevel" class="col-lg-4 col-sm-4 control-label">* School Level</label>                                     
									<div class="col-lg-8">
											<div class="iconic-input">
                                            <i class="fa fa-clock-o"></i>
                                              
                                            <select class="form-control"  id="subjectLevel" name="subjectLevel" required>
                                              
													<option value = "">Please select One</option>
													<?php 
													
													 try {
														
															schoolSessionL($conn);  /* school session  */
												 
														}catch(PDOException $e) {
							
														wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
														}

													?>
                                              
                                            </select>
											<input type="hidden" name ="classAll" id="classAll" value="<?php echo $fiVal; ?>" />
											</div>
                                          
                                    </div>
                                </div>
								
								<?php } ?>

								 
								<span id="wait_1" style="display: none;"> <center><img alt="Please Wait" src="loading.gif"/> <!-- loading image --></center> <!-- loading image --> </span>
    							<span id="result_1" style="display: none;"></span> <!-- loading div -->  <!-- jquery loading div -->
                                    
                              	
								<div class="form-group">
                                    <label for="eTime" class="col-lg-4 col-sm-4 control-label">* Assignment Duration (In Minutes)</label>
                                          <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-clock-o"></i>
                                              <input type="number"  id="eTime" name="eTime" 
                                              class="form-control" placeholder="60" maxlength="3" required>
                                          </div>
                                          </div>
                                </div> 
								
								<div class="form-group">
                                    <label for="eTime" class="col-lg-4 col-sm-4 control-label">* Assignment Deadline </label>                                          
										  <div class="col-lg-7 col-sm-7">
                                                      <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" 
                                                      data-date="2017-02-02"  
                                                      class="input-append date dpYears">
                                                          <input type="text" readonly="" 
                                                          size="5" class="form-control"  name="dDate" value=""  required />
                                                          <span class="input-group-btn add-on">
                                                            <button class="btn btn-danger" type="button">
                                                            <i class="fa fa-calendar"></i></button>
                                                          </span>
                                                      </div>                                                      
                                                  </div>												  
										  
                                </div> 

								<div class="form-group">
                                    <label for="eDetail" class="col-lg-4 col-sm-4 control-label"> * Assignment Instruction/s</label>                                      
                                    <div class="col-lg-8">                                        
                                            <textarea rows="4" cols="10" class="form-control" name="eDetail" id="eDetail" 
                                            placeholder="Enter Assignment Instructions"></textarea>                                           
                                    </div>
                                </div>	
                              	
                                <div class="form-group">

                                          <center><button type="submit" class="btn btn-danger buttonMargin" id="saveAssign">
                                          <i class="fa fa-save"></i> Continue </button></center>
                                </div>
  
								</div>
							
                            </form><!-- / form -->
							<!-- /form -->
							</div>
                         
						</section>
						</div>
					</div>
                    <!-- /row -->
					
                	<!-- row -->	
					<!-- row -->	
					<div class="row">  
						<div class="col-lg-12">						  
					  
							<div id="wizgrade-page-div"> </div> <!-- This a div where jquery loads its contents -->					 
					 
						</div>
					</div>
					<!-- /row -->
					<!-- /row -->		
				   
					<!-- assignment removal pop up modal start -->
					<a href="#removeModal" data-toggle="modal" id="modalRemoveBtn" class=""> </a>

					<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" 
					aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						  <div class="modal-content">
							  <div class="modal-header">
								  <button type="button" class="close" 
								  data-dismiss="modal" aria-hidden="true">
								  <span style='color:#fff !important;'>&times;</span></button>
								  <h4 class="modal-title"> Are sure you want to remove this Assignment information ?
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
								  <button  class="btn btn-danger demoDisenable" id="removeAssign" 
								  type="button">Yes</button>
								  <button data-dismiss="modal" class="btn btn-danger" 
								  type="button">Cancel</button>
							  </div>
						  </div>
					  </div>
					</div> 
					<!-- assignment removal pop up modal end -->
					
					<!-- assignment edit pop up modal start -->
					<a href="#editModal" data-toggle="modal" id="modalEditBtn" class=""> </a>

					<div class="modal fade" id="editModal" tabindex="-1" role="dialog" 
					aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						  <div class="modal-content">
							  <div class="modal-header">
								  <button type="button" class="close" 
								  data-dismiss="modal" aria-hidden="true">
								  <span style='color:#fff !important;'>&times;</span></button>
								  <h4 class="modal-title"> Online Assignment Manager
								  </h4>
							  </div>
							  <div class="modal-body modal-body-scroll">					 
		 
									<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="editLoader"  
													  style="cursor:pointer; display:none; margin-bottom:5px;" /></center>
					
									<div id="editMsg"> </div>											
											
									<div class="slideUpFrmUDiv">
						 
										<section class="panel">
										
										<div class="panel-body"> 
										
											<div id="editAssignDiv"></div> 
											  
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
					<!-- assignment edit pop up modal end -->
  
					<!-- assignment question remove pop up modal start -->
					<a href="#removeQModal" data-toggle="modal" id="modalRemoveQBtn" class=""> </a>
					<div class="modal fade" id="removeQModal" tabindex="-1" role="dialog" 
					aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						  <div class="modal-content">
							  <div class="modal-header">
								  <button type="button" class="close" 
								  data-dismiss="modal" aria-hidden="true">
								  <span style='color:#fff !important;'>&times;</span></button>
								  <h4 class="modal-title"> Are sure you want to remove this Assignment Question Information ?
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
							  <div class="modal-footer slideUpFrmDiv display-none">
								  <button  class="btn btn-danger demoDisenable" id="removeAssignQuestion" 
								  type="button">Yes</button>
								  <button data-dismiss="modal" class="btn btn-danger" 
								  type="button">Cancel</button>
							  </div>
						  </div>
					  </div>
					</div>
					<!-- assignment question remove pop up modal end -->
				  
					<!-- assignment question edit pop up modal start -->
					<a href="#editQModal" data-toggle="modal" id="modalEditQBtn" class=""> </a>

					<div class="modal fade" id="editQModal" tabindex="-1" role="dialog" 
					aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						  <div class="modal-content">
							  <div class="modal-header">
								  <button type="button" class="close" 
								  data-dismiss="modal" aria-hidden="true">
								  <span style='color:#fff !important;'>&times;</span></button>
								  <h4 class="modal-title"> Assignment Question  Manager
								  </h4>
							  </div>
							  <div class="modal-body modal-body-scroll"> 
		 
									<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="editLoader"  
									style="cursor:pointer; display:none; margin-bottom:5px;" /></center>

									<div id="editMsg"> </div> 
						
									<div class="slideUpFrmUDiv">
						 
										<section class="panel">
										
										<div class="panel-body"> 
										
											<div id="editAssignQuestionDiv"></div> 
											  
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

				<script type='text/javascript'> $('.dpYears').datepicker(); </script>	
				<!-- assignment question edit pop up modal end -->	