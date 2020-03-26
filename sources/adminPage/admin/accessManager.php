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
	This page is the student change password manager
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>

 
                <!-- row -->	
					<div class="row">  
     				  <div class="col-lg-7">
					  <div id="msgBox"></div>
                      <section class="panel wizgrade-section-div">
                      	
                          <header class="panel-heading">
                              
							  <i class="fa fa-key fa-lg"></i> Change My Password
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
                          <div class="panel-body wizGrade-line"> 
                              <!-- form --><form class="form-horizontal" id="frmchangeAPass" role="form">
                              
                              	
                                  <div class="form-group">
                                      <label for="old_pass"  class="col-lg-4 col-sm-4 control-label">* Old Password </label>
                                      <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-key"></i>
                                              <input type="password" class="form-control"
                                              name="old_pass" id="old_pass" require />
                                          </div>
                                      </div>
                                  </div>


                                  <div class="form-group">
                                      <label for="new_pass"  class="col-lg-4 col-sm-4 control-label">* New Password </label>
                                      <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-key"></i>
                                              <input type="password" class="form-control"
                                              name="new_pass" id="new_pass" require/>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label for="confirm_new"  class="col-lg-4 col-sm-4 control-label">* Confirm Password</label>
                                      <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-key"></i>
                                              <input type="password" class="form-control" 
                                              name="confirm_new" id="confirm_new" require />
                                          </div>
                                      </div>
                                  </div>
		 

                                 <div class="form-group">
                                      
                                          <input type="hidden" name="adminPass" value="changePass" />
                                          <center><button type="submit" class="btn btn-danger buttonMargin demoDisenable" id="changeAPass">
                                          
                                          <i class="fa fa-lock"></i> Change Password </button></center>
                                      
                                  </div>
  

                              </form><!-- / form -->
                          </div>
                         
                      </section>
                      </div></div>
                    
                		
					<!-- row -->	
					<div class="row">  
						<div class="col-lg-12">						  
					  
							<div id="wizgrade-page-div"> </div> <!-- This a div where jquery loads its contents -->					 
					 
						</div>
					</div>
					<!-- / row -->	