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
	This page enroll new student to school database
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>
 
					<!-- row -->
                 	  <div class="row wizgrade-section-div">
     				  <div class="col-lg-7">
                      <section class="panel">
                          <header class="panel-heading">
                             <i class="fa fa-user-plus fa-lg"></i> Enroll New Student
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>  
                          </header>
                          <div class="panel-body wizGrade-line">
                          
                              <!-- form --><form class="form-horizontal" id="frmnewStudent" role="form">
							  

                                  <div class="form-group">
                                      <label for="lname" class="col-lg-4 col-sm-4 control-label">* Last Name:</label>

                                      <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-user"></i>
                                              <input type="text" class="form-control capWords" id="lname" 
                                              name="lname"  required />
                                              
                                          </div>
                                      </div>
                                  </div>


                                  <div class="form-group">
                                      <label for="fname" class="col-lg-4 col-sm-4 control-label">* First Name:</label>

                                      <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-user"></i>
                                              <input type="text" class="form-control capWords"  id="fname" 
                                              name="fname"  required />
                                              
                                          </div>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label for="mname" class="col-lg-4 col-sm-4 control-label">* Middle Name:</label>

                                      <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-user"></i>
                                              <input type="text" class="form-control capWords"  id="mname" 
                                              name="mname"  />
                                              
                                          </div>
                                      </div>
                                  </div>

                              	<div class="form-group">
                                      <label for="sess" class="col-lg-4 col-sm-4 control-label">* Student's Level 
                                      </label>
                                     
                                  <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-clock-o"></i>
                                              
                                              <select class="form-control RegNumNew"  id="sess" name="sess" required>
                                              
                                				<option value = "">Please select One</option>
												<?php 
										
													try {
													
														schoolSessionL($conn);  /* school session  */
											 
													}catch(PDOException $e) {
						
													wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
						 
													} 
										
												?>
                                              
                                              </select>
                                          </div>
											<span class="label label-danger">NOTE!</span>
                                            <span style="color:#ff0000">This is the level this student is been admitted 
                                            or enrolled to. </span>
                                      </div>
                                      
                                      
                                  </div>

                                  


								  <span id="wait_11" style="display: none;">
    							  <img alt="Please Wait" src="loading.gif"/> <!-- loading image -->
    							  </span>
    							  <span id="result_11" style="display: none;"></span> <!-- loading div -->
							  

                                
                              </form><!-- / form -->
                          </div>
                      </section>
                      
                      </div>
                      
					  
     				  <div class="col-lg-5">
                      <section class="panel">
                          <header class="panel-heading">
                            
							 <i class="fa fa-file-excel-o fa-lg"></i>  Use Bulk Registration ?
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
                          <div class="panel-body wizGrade-line">
						  
							<button  class="btn btn-white pull-left" onclick="window.open('bulkRegFormat.xls')">
							<i class="fa fa-cloud-download text-info"></i> 
							<span class="text-info"> Donwload Format</span>
							</button>
							
							<button  class="btn btn-white pull-right" onclick="window.open('bulkRegExample.xls')">
							<i class="fa fa-cloud-download text-info"></i> 
							<span class="text-info"> Donwload Example </span>
							</button>
							
							<br clear="all" /><br clear="all" />
							
									<?php   
				
										$msg_i = 'To upload bulk excel registration, you have to 
										<span style="color:#000;font-weight:bold;">
										download the registration bulk format</span>. 
										
										<br />
										<br />
										Meanwhile, every empty field should be replace with  a <span style="color:#000;font-weight:bold;">-</span> ie dashed. 
										Download and cross check Bulk Registration example as a guide.';
										
										echo $infMsg.$msg_i.$msgEnd; 

									?> 
                          
                          
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
					