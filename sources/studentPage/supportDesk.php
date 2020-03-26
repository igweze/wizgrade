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
	This page handle student support 
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>
 
                <!-- row -->	
				<div class="row">  
					<div class="col-sm-12">
						<section class="panel">
							<header class="panel-heading">
								<i class="fa fa-question-circle-o fa-lg"></i> Help Desks
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line">
						  
								<div class="mail-box">
								<aside class="sm-side">
								   
							 

								  <div class="inbox-body"> 

								  </div>
								  <ul class="inbox-nav inbox-divider">
									  <li class="active">
										  <a href="javascript:;">
										  <i class="fa fa-inbox"></i> Send Admin Message </a>

									  </li>
									  
								  </ul>
							   
							  


								</aside>
							  
							  
								<aside class="lg-side scrollMailTarget">
								  <div class="inbox-head">
										<h3><div id="mailTopTitle">Compose Message </div> </h3> 									   
								  </div>
								  
								   <div class="row" id="composeMsgBoxDiv">
								   
										<div class="col-lg-12">
			   
										<section class="panel">
									 
										<div class="panel-body" style="background: #FFF8DC !important;">
									  
										<div id="msgBoxInfo"> </div>
												  
										<div id="msgBox"> </div>
									  
										<!-- form --><form class="form-horizontal" id="frmSupportDesk" role="form">
										  
										  <div class="form-group">
											  <div class="col-lg-12">
													  <div class="iconic-input">
														  <i class="fa fa-user-plus"></i>
														  
															<select class="form-control"  id="msgRecep" name="msgRecep" required> 

																<option value = "2">Send Mail to School Admin</option>

															</select>
							 
													  </div>
												  </div>
											  </div>
										  
										 <div class="form-group">
											  <div class="col-lg-12">
												  <div class="iconic-input">
													  <i class="fa fa-comment-o"></i>
													  <input type="text" class="form-control" placeholder="Write your mesaage title here" 
													  name="msgTitle" id="msgTitle" required />
												  </div>
											  </div>
										  </div> 

										  <div class="form-group">
											  <div class="col-lg-12">
												  <div class="iconic-input">
													  <i class="fa fa-envelope"></i>
													  <textarea class="form-control" name="msg" id="msg"
													   style="padding: 5px 30px; 
													  text-align:justify !important;"
													  placeholder="Write your mesaage here" rows="10" required></textarea>
													 
												  </div>
											  </div>
										  </div> 
									

										 <div class="form-group">
											  <div class="col-lg-2"> 
												 <input type="hidden" name="msgData" value="support"/>	
												  <button type="submit" class="btn btn-danger" id="supportDesk">
												  <i class="fa fa-mail-forward"></i> Send Message </button>
												  
												  
												   
											  </div>
										  </div>
		  

										</form><!-- / form -->
									  
										</div>
								 
										</section>
							  
										</div>
						  
										</div>
										  
										<div id="mailMsgBox"> </div>
                
									</aside>
                


					</div>

					<!--mail inbox end-->
				
							</div>
							</section>
					</div>
				  
				</div>	
				<!-- / row -->				
                    
             