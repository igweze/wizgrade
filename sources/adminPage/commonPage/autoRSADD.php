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
	This page load the bulk excel student result upload
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?> 
				 
                 	<!-- row -->	
					<div class="row">  
						<div class="col-lg-6">
						<section class="panel wizgrade-section-div">
							<header class="panel-heading">                             
								<i class="fa fa-book fa-lg"></i> Bulk Excel Result <span class="hide-res">Manager</span>
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line"> 
						  
							<!-- form -->
							<!-- form --><form class="form-horizontal" id = "frmbulkRSExcel"  enctype="multipart/form-data" 
							action='wizGradeBulkRS.php' role="form">
							  
							<?php if ($admin_grade == $staffGrade) {  /*  check if school staff */ ?>

                              	<?php if ($wizGradeMode == $fiVal){  /* session run mode */ ?>
								<div class="form-group">
                                    <label for="sess" class="col-lg-4 col-sm-4 control-label">* School Session</label>                                     
									<div class="col-lg-8">
											<div class="iconic-input">
												<i class="fa fa-clock-o"></i>                                              
												<select class="form-control"  id="ftSession" name="sess" required>
                                              
                                				<option value = "">Please select One</option>
												<?php 
												
												   try  {
														
															formTeacherSession($conn, $adminID, $wizGradeMode);  /* class teacher school session  */ 
												 
														}catch(PDOException $e) {
							
															wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
														} 
														
												?>
                                              
												</select>
											</div>
										  <?php echo $sessNote; ?>
                                    </div>                                  
								</div>
								<?php } ?>
								
								<?php if ($wizGradeMode == $seVal){  /* current run mode */ ?>
								<div class="form-group">
                                    <label for="sess" class="col-lg-4 col-sm-4 control-label">*  School Level</label>                                     
									<div class="col-lg-8">
											<div class="iconic-input">
												<i class="fa fa-clock-o"></i>                                              
												<select class="form-control"  id="ftSessL" name="ftSessL" required>
                                              
                                				<option value = "">Please select One</option>
												<?php 
												
												   try  {
														
															formTeacherSession($conn, $adminID, $wizGradeMode);  /* class teacher school session  */ 
												 
														}catch(PDOException $e) {
							
															wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
														} 
														
												?>
                                              
												</select>
											</div>
                                    </div>
                                </div>
								<?php } ?> 
                                              
								<?php }else{ ?>  	
							
								<?php if ($wizGradeMode == $fiVal){  /* session run mode */ ?>
                              
                              	<div class="form-group">
                                    <label for="sess" class="col-lg-4 col-sm-4 control-label">* School Session</label>                                     
									<div class="col-lg-8">
											<div class="iconic-input">
												<i class="fa fa-clock-o"></i>                                              
												<select class="form-control"  id="sess" name="sess" required>
                                              
                                				<option value = "">Please select One</option>
												<?php 
													 try {
														
															schoolSession($conn); /* school session  */
												 
														}catch(PDOException $e) {
							
														wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
														} 
												?>
                                              
												</select>
											</div>
                                           
                                             <?php echo $sessNote; ?>
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="level" class="col-lg-4 col-sm-4 control-label">* School Level</label>                                     
									<div class="col-lg-8">
											<div class="iconic-input">
												<i class="fa fa-level-up"></i>                                              
												<select class="form-control"  id="levelCM" name="level" required>
                                              
                                				<option value = "">Please select One</option>
												<?php 
												
													 try {
														
															studentLevel($conn);  /* retrieve student level */
												 
														}catch(PDOException $e) {
							
														wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
														} 
												?> 
                                              
												</select>
											</div>
                                    </div>
                                </div>
								  
								<?php } ?>
								
								<?php if ($wizGradeMode == $seVal){  /* current run mode */ ?>  
								
								
								<div class="form-group">
									<label for="sess" class="col-lg-4 col-sm-4 control-label">* School Level</label>                                     
									<div class="col-lg-8">
											<div class="iconic-input">
												<i class="fa fa-clock-o"></i>                                              
												<select class="form-control"  id="sesslevel" name="sesslevel" required>
                                              
													<option value = "">Please select One</option>
													<?php 
													
													 try {
														
															schoolSessionL($conn);  /* school session  */
												 
														}catch(PDOException $e) {
							
														wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
														}

													?>
                                              
												</select>
												<input type="hidden" name ="classAll" id="classAll" value="<?php echo $i_false; ?>" />
											</div>
                                          
                                    </div>
                                </div>
								<?php } ?>  
                                  

								<?php } ?>  	

								<span id="wait_1" style="display: none;"> <center><img alt="Please Wait" src="loading.gif"/> <!-- loading image --></center> <!-- loading image --> </span>
    							<span id="result_1" style="display: none;"></span> <!-- loading div -->  <!-- jquery loading div -->

								<div class="form-group">
                                    <label  for="term" class="col-lg-4 col-sm-4 control-label">* School Term</label>                                     
									<div class="col-lg-8">
											<div class="iconic-input">
												<i class="fa fa-cubes"></i>                                              
												<select class="form-control"  id="term" name="term" required>
                                              
                                				<option value = "">Please select One</option>
												<?php
												
													try {
													
															$curTerm = currentSessionTerm($conn);    /* current school term  */
											 
													}catch(PDOException $e) {
						
													wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
						 
													} 


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
											</div>
                                      </div>
                                </div>
								
								<div class="form-group">
											<label class="control-label col-lg-4 col-ms-4"> * Validate & Preview Excel</label>
											<div class="controls col-lg-8 col-ms-8">
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<span class="btn btn-white btn-file">
													<span class="fileupload-new"><i class="fa fa-paper-clip"></i>  Select Excel  </span>
													<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
													<input type="file" class="default" name="bulkExcel" id="bulkRSExcel" /> </span>
													<span class="fileupload-preview" style="margin-left:5px;"></span>
													<a href="javascript:;" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;">
													</a>
												</div>
											  
												<span class="label label-danger">NOTE!</span>
												<span style="color:#ff0000">Only Microsoft Excel 1997 - 2003 format is allowed  at the moment. </span>
                                          </div>
                                </div>
                              	<input type="hidden" name="uMode" value="1" />
								<input type="hidden" name="rsData" value="bulkExcelRS" />
								 
                            </form><!-- / form -->
							<!-- /form -->
							</div>
                         
						</section>
                    </div>
					  
					<div class="col-lg-6">
							<section class="panel wizgrade-section-div">
							<header class="panel-heading"> 
							 
								<i class="fa fa-info-circle fa-lg"></i> Bulk Registration Format
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line"> 
							
							<button  class="btn btn-white pull-left wizGradeMenu">
							<i class="fa fa-cloud-download text-info"></i> 
							<span class="text-info"> <a  href="javascript:;" id="exportResult">Export Result Format</a></span>
							</button>
							
							<button  class="btn btn-white pull-right" onclick="window.open('bulkRSExample.xls')">
							<i class="fa fa-cloud-download text-info"></i> 
							<span class="text-info"> Donwload Example </span>
							</button>
							<br clear="all" /><br clear="all" />
							
									<?php
				
										$msg_i = 'To upload excel result, you have to export the result format using the <b> Export Class Result
										Module</b>	and save it as 
										<span style="color:#000;font-weight:bold;">
										Excel 1997 - 2003</span>. <br />
										<br />
										Meanwhile, you have to input students score and separate the scores with a comma 
										(,) eg <span style="color:#000;font-weight:bold;"> 8,9,8,55, 15,15,65 or 30, 70 </span> and subject scores  
										must not be more than 100. 
										Note: Every empty field should be replace with  a <span style="color:#000;font-weight:bold;">-</span> ie dashed. ';
										
										echo $infMsg.$msg_i.$msgEnd;

									?>
                          
							</div>
							</section> 
                      
						</div>
					  
					</div>
                    <!-- /row -->
					
               	
					<!-- row -->	
					<div class="row">    <div id="hiRSData" class="display-none"></div>
						<div class="col-lg-12">						  
					  
							<div id="wizgrade-page-div"> </div> <!-- This a div where jquery loads its contents -->					 
					 
						</div>
					</div>
					<!-- /row -->					  
                		
 
				   
				   <script type='text/javascript'>  
                      hidePageLoader();  /* hide page loader */
					</script>