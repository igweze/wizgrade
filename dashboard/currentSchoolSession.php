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
	This page handle current school session
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configINwizGrade.php';  /* load wizGrade configuration files */
		 		 
		 
		
?>		

					<!-- row -->	
					<div class="row"> 
					
                    <div class="col-sm-7">
                      <section class="panel">
                          <header class="panel-heading">
                              <i class="fa fa-calendar-check-o fa-lg"></i> Current <span class="hide-res">School</span> Session
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
							<form class="form-horizontal" id="frmcurrentSession" role="form">
                              	<div class="form-group">
                                      <label for="sess" class="col-lg-4 col-sm-4 control-label">* Current School 
                                      Session</label>
                                     
                                  <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-clock-o"></i>
                                              
                                              <select class="form-control"  id="sess" name="sess" required>
                                              
                                				<option value = "">Please select One</option>
												<?php 
														try {
														
																currentSession($conn);  /* current school session  */
												 
														}catch(PDOException $e) {
							
														wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
														} 
												?>
                                              
                                              </select>
                                          </div>
                                      </div>
                                </div> 									 

								<div class="form-group">
                                      <label  for="term" class="col-lg-4 col-sm-4 control-label">* Current Term</label>
                                     
                                  <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              
                                              <select class="form-control"  id="term" name="term" required>
                                              
                                				<option value = "">Please select One</option>
												<?php

													try {
													
															$curTerm = currentSessionTerm($conn); /* current school term  */
											 
													}catch(PDOException $e) {
						
													wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
						 
													} 


													foreach($term_list as $term_key => $term_value){  /* loop array */

														if ($curTerm == $term_key){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

													}

												?>
                                              
                                              </select>
                                              
                                          </div>
                                      </div>
                                </div> 

                                      
                                <div class="form-group">
                                      	  <input type="hidden" name="currentSess" value="currentSession" />                                     		
	                                      <center><button type="submit" class="btn btn-danger buttonMargin demoDisenable" 
                                          id="currentSession">
                                          <i class="fa fa-save"></i> Save </button></center>                                          
                                </div>
                                      
                            </form>                         
							<!-- / form -->
                                      
                          </div>
                      </section>
                  </div>
				</div>
				<!-- row -->	 