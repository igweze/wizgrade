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
	This script handle exam configuration
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configwizGrade.php';  /* load wizGrade configuration files */	   
		 		 
		 
		 try {
		 

  				$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
				$exam_status = $examArray[0]['status'];
				$rsType = $examArray[0]['rsType'];	
				
		 }catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		 }
		
		
		
?>		

				<!-- row -->	
				<div class="row">  
					
                    <div class="col-sm-7"> 
                      <section class="panel">
                          <header class="panel-heading">
                              
							  <i class="fa fa-wrench fa-lg"></i> <span class="hide-res">School</span> Exam Configuration
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
						  
                          <div class="panel-body wizGrade-line">
                          <center><img src="loading.gif" alt="Loading >>>>>" class="configLoading" 
									  style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>
                          <div class="msgBoxSettings"></div>
							
							<!-- form -->
							
							<form class="form-horizontal" id="frmexamConfigs" role="form">
							
							
								<div class="form-group">
                                      <label  for="rsType" class="col-lg-5 col-sm-5 control-label">* School Result Type</label>
                                     
									<div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-bars"></i>
                                              
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
                                      </div>
                                 </div>
								  

								<div class="form-group">
									<label  for="status" class="col-lg-5 col-sm-5 control-label">* 
                                      School No. of Continous Assessment </label>
                                     
									<div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              
                                              <select class="form-control"  id="status" name="status" require>
                                              
                                				<option value = "">Please select One</option>
												<?php
								
													for($i = $fiVal; $i <= $sixVal; $i++){  /* loop array */															
															
														if($i == $exam_status){
										
															$select = 'selected';
										
														}else{
										
															$select = '';
															
														}															

														echo '<option value="'.$i.'" '.$select.'>'.$i.'</option>' ."\r\n";
				
													}														 

												?>
															  
                                              </select>
                                              
                                          </div>
                                      </div>
                                </div>                   

								<div class="form-group" id="first-div">
								  <label for="first" class="col-lg-5 control-label">*
								   1st  Assessment Score</label>
								  <div class="col-lg-7">
								  <div class="iconic-input">
									  <i class="fa fa-home"></i>
									  <input type="number"  id="first" name="first" 
									  value ="<?php echo $examArray[0]['fi_ass']; ?>"
									  class="form-control" placeholder="10, 20" required>
								  </div>
								  </div>
								</div>    

								<div class="form-group" id="second-div">
								  <label for="second" class="col-lg-5 control-label">*
								   2nd  Assessment Score</label>
								  <div class="col-lg-7">
								  <div class="iconic-input">
									  <i class="fa fa-home"></i>
									  <input type="number"  id="second" name="second" 
									  value ="<?php echo $examArray[0]['se_ass']; ?>"
									  class="form-control" placeholder="10, 20">
								  </div>
								  </div>
								</div>    

								<div class="form-group" id="third-div">
								  <label for="third" class="col-lg-5 control-label">*
								   3rd  Assessment Score</label>
								  <div class="col-lg-7">
								  <div class="iconic-input">
									  <i class="fa fa-home"></i>
									  <input type="number"  id="third" name="third" 
									  value ="<?php echo $examArray[0]['th_ass']; ?>"
									  class="form-control" placeholder="10, 20">
								  </div>
								  </div>
								</div> 

								<div class="form-group" id="fourth-div">
								  <label for="fourth" class="col-lg-5 control-label">*
								   4th  Assessment Score</label>
								  <div class="col-lg-7">
								  <div class="iconic-input">
									  <i class="fa fa-home"></i>
									  <input type="number"  id="fourth" name="fourth" 
									  value ="<?php echo $examArray[0]['fo_ass']; ?>"
									  class="form-control" placeholder="10, 20">
								  </div>
								  </div>
								</div>

								<div class="form-group" id="fifth-div">
								  <label for="fifth" class="col-lg-5 control-label">*
								   5th  Assessment Score</label>
								  <div class="col-lg-7">
								  <div class="iconic-input">
									  <i class="fa fa-home"></i>
									  <input type="number"  id="fifth" name="fifth" 
									  value ="<?php echo $examArray[0]['fif_ass']; ?>"
									  class="form-control" placeholder="10, 20">
								  </div>
								  </div>
								</div>

								<div class="form-group" id="sixth-div">
								  <label for="sixth" class="col-lg-5 control-label">*
								   6th  Assessment Score</label>
								  <div class="col-lg-7">
								  <div class="iconic-input">
									  <i class="fa fa-home"></i>
									  <input type="number"  id="sixth" name="sixth" 
									  value ="<?php echo $examArray[0]['six_ass']; ?>"
									  class="form-control" placeholder="10, 20">
								  </div>
								  </div>
								</div>									  


								<div class="form-group">
								  <label for="exam" class="col-lg-5 control-label">*
								   Exam Score</label>
								  <div class="col-lg-7">
								  <div class="iconic-input">
									  <i class="fa fa-home"></i>
									  <input type="number"  id="exam" name="exam" 
									  value ="<?php echo $examArray[0]['exam']; ?>"
									  class="form-control" placeholder="60, 70" required>
								  </div>
								  </div>
								</div>    


								<div class="form-group">
								  <input type="hidden" name="schoolSettings" value="examConfigs" />                                     		
								  <center><button type="submit" class="btn btn-danger buttonMargin demoDisenable" id="examConfigs">
								  <i class="fa fa-save"></i> Save </button></center>                                          
								</div>
                                      
                            </form> 
							<!-- / form -->	

                                      
                          </div>
                      </section>
					</div>
				</div>
				<!-- / row -->	
				
              
                                 
              		<script type="text/javascript">
			
					$(document).ready(function() {
						
						function setExamPara(){	 /* fuction to show or hide exam inputs depending on the exam status */						
							
							var status = $('#status').val();
							
							if(status == 1){
								
								 $('#first-div').show();
								 $('#second-div, #third-div, #fourth-div, #fifth-div, #sixth-div').hide(); 
								 
								 $('#second').val('');
								 $('#third').val('');
								 $('#fourth').val('');
								 $('#fifth').val('');
								 $('#sixth').val('');
								 
							}else if(status == 2){
								 
								 $('#first-div, #second-div').show();
								 $('#third-div, #fourth-div, #fifth-div, #sixth-div').hide(); 
								 
								 $('#third').val('');
								 $('#fourth').val('');
								 $('#fifth').val('');
								 $('#sixth').val('');
								
							}else if(status == 3){
								 
								 $('#first-div, #second-div, #third-div').show();
								 $('#fourth-div, #fifth-div, #sixth-div').hide();  
								 
								 $('#fourth').val('');
								 $('#fifth').val('');
								 $('#sixth').val('');
								
							}else if(status == 4){
								 
								 $('#first-div, #second-div, #third-div, #fourth-div').show();
								 $('#fifth-div, #sixth-div').hide();  
								 
								 $('#fifth').val('');
								 $('#sixth').val('');
								
							}else if(status == 5){
								 
								 $('#first-div, #second-div, #third-div, #fourth-div, #fifth-div').show();
								 $('#sixth-div').hide();  
								 
								 $('#sixth').val('');
								
							}else{

								 $('#first-div, #second-div, #third-div, #fourth-div, #fifth-div, #sixth-div').show();

							}
							
							
						}	
						
						$('body').on('change','#status',function(){
																	
							setExamPara();
				
							return false;
							
						});
						
						setExamPara();
					}); 

					</script>