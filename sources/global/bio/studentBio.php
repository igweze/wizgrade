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
	This page load student profile form
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */  

if(!session_id()){
    session_start();
}

		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
		 
		 
			try {
		 
				
				$reg = strip_tags($_REQUEST['reg']);

  				$sessionID = studentRegSessionID($conn, $reg);  /* student school session ID */
				$session_fi = wizGradeSession($conn, $sessionID);  /* school session */
									 
		 		$session_se = $session_fi + $foreal;  
				
				if($schoolExt == $wizGradeNurAbr){  /* check if school is nursery */
					
					$class = 'class_1, class_2, class_3,';
					
				}else{  /* else normal school */
					
					$class = 'class_1, class_2, class_3, class_4, class_5, class_6,';
				
				}
				
				/* select information */ 
				
  				$ebele_mark = "SELECT r.ireg_id, nk_regno, $class
								s.stu_id, i_stupic, i_firstname, i_lastname, i_midname, i_gender, i_dob, 
								i_country, i_state, i_lga, i_city, i_add_fi, i_add_se, i_stu_phone, i_email,
								i_sponsor, i_spo_phone, i_spo_add,
								genotype, bloodgp, hostel, route, disability

									 FROM $i_reg_tb r, $i_student_tb s

									 WHERE r.nk_regno = :nk_regno
									 
									 AND r.ireg_id = s.ireg_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);	
  				$igweze_prep->bindValue(':nk_regno', $reg);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {  /* check array is empty */
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */			
	   
						$regNum = $row['nk_regno'];
						$ID = $row['ireg_id'];
						$pic = $row['i_stupic'];
						$fname = $row['i_firstname'];
						$lname = $row['i_lastname'];
						$mname = $row['i_midname'];					
						$fiClass = $row['class_1'];
						$seClass = $row['class_2'];
						$thClass = $row['class_3'];
						$foClass = $row['class_4'];
						$fifClass = $row['class_5'];
						$sixClass = $row['class_6'];					
						$sex = $row['i_gender'];
						$dateofbirth = $row['i_dob'];
						$country = $row['i_country']; 
						$state = $row['i_state'];
						$lga = $row['i_lga'];
						$city = $row['i_city'];
						$add1 = $row['i_add_fi'];
						$add2 = $row['i_add_se'];
						$studphone = $row['i_stu_phone'];
						$email = $row['i_email'];
						$sponsor = $row['i_sponsor'];
						$sponphone = $row['i_spo_phone'];
						$sponadd = $row['i_spo_add'];
						$bloodGP = $row['bloodgp'];
						$genoTP = $row['genotype'];
						$hostelID = $row['hostel'];
						$routeID = $row['route'];
						$disability = $row['disability'];
					}	

					if (is_null($pic)){
			
						$studentPic = $wizGradeDefaultPic; 

					}else{
			
						$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$pic;

					}

					if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }  /* check if picture exists */
					
					 		 

	  				$levelArray = studentLevelsArray($conn); /* student level array */
					$clArray_fi = studentClassArray($conn, $fiVal);  /* retrieve student 100 level class array */
					$clArray_se = studentClassArray($conn, $seVal);  /* retrieve student 200 level class array */
					$clArray_th = studentClassArray($conn, $thVal);  /* retrieve student 300 level class array */
					$clArray_fo = studentClassArray($conn, $foVal);  /* retrieve student 400 level class array */
					$clArray_fif = studentClassArray($conn, $fifVal);  /* retrieve student 500 level class array */
					$clArray_six = studentClassArray($conn, $sixVal);  /* retrieve student 600 level class array */
					$classArray_fi = unserialize($clArray_fi);
					$classArray_se = unserialize($clArray_se);
					$classArray_th = unserialize($clArray_th);
					$classArray_fo = unserialize($clArray_fo);
					$classArray_fif = unserialize($clArray_fif);
					$classArray_six = unserialize($clArray_six);
						
				
				}else{  /* display error */ 
		
						$msg_e =  "Student's record with <span>$reg </span> was not found.";						  
						echo $errorMsg.$msg_e.$eEnd; echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	 echo $scrollUp; exit; 			
										  
				}
				
				
			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			}
		
		
		
?>		


 
		
		<center><img src="loading.gif" alt="Loading >>>>>" class="studentLoader"  
		style="cursor:pointer; display:none; margin-bottom:10px;" /> </center><!-- loading image -->
									  
        <!--tab nav start-->
	    <section class="panel" id="wizGradeScrollTarget">
			<header class="panel-heading tab-bg-dark-navy-blue">
				<ul class="nav nav-tabs nav-justified">
					<li class="active">
					  <a data-toggle="tab" href="#bio-1">
						  
						  Step 1
					  </a>
					</li>
					<li>
					  <a data-toggle="tab" href="#bio-2">
						  
						  Step 2
					  </a>
					</li>
					<li class="">
					  <a data-toggle="tab" href="#bio-3">
						  
						  Step 3
					  </a>
					</li>
					<li class="">
					  <a data-toggle="tab" href="#bio-4">
						  
						  Step 4
					  </a>
					</li>
					<?php if(($admin_grade == $adminGrade) && ($admin_level == $adminGradeInt)) {  /* check if school admin */ ?>
					<li class="">
					  <a data-toggle="tab" href="#bio-5">
						  
						  Step 5
					  </a>
					</li>
					<?php }?>
				</ul>
			</header>
			<div class="panel-body">
			  <div class="tab-content">
			  
				<div id="bio-1" class="tab-pane active"><!-- tab 1 -->				
			
                		<div class="msgBoxPic"></div>	
                        	
						  <section class="panel" id = 'editBioPic'>
                          <header class="panel-heading">
                              Upload  Picture - <?php echo $pre_regnum.$regNum; ?>
                          </header>
                          <div class="panel-body">

                              <!-- form --><form method="POST" id = "frmBioPic"  enctype="multipart/form-data" 
                              action='studentBioManager.php'>


                                      <div class="form-group last">
                                          <label class="control-label col-md-3">* Select Picture </label>
                                          <div class="col-md-9">
                                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                                  <div class="fileupload-new thumbnail msgSoftBoxPic" style="width: 
                                                  200px; height: 150px;">
                                                      <img src="<?php echo $studentPic; ?>" alt="" />
                                                  </div>
                                                  <div class="fileupload-preview fileupload-exists thumbnail" 
                                                  style="max-width: 
                                                  200px; max-height: 150px; line-height: 20px;"></div>
                                                  <div>
                                                   <span class="btn btn-white btn-file pictureUploader">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> 
                                                   Select image</span>
                                                   
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> 
                                                   Select Image</span>
                                                   <input type="file" id="uploadStudentPic" 
                                                   name="uploadPic" class="default" required />
                                                   </span>
                                                 
                                                  </div>
                                              </div>

												<span class="label label-danger">NOTE!</span>
												<span style="color:#ff0000">Only max image size of 2MB &amp; format 
												of <?php echo $allowedPicExt; ?> are allowed.  </span>
                                          </div>
                                      </div>
                                      

                                      <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10"> 
                                          <input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />
                                          <input type="hidden" name="profileData" value="studentPic" />                                          
                                          
                                      </div>
                                  </div>
  

                                      
                         
                 
                              </form><!-- / form -->
                          </div>
                         
                      </section> 

					 
				</div>
				 
				
				<div id="bio-2" class="tab-pane "><!-- tab 2 -->	
				
				
					<div class="msgBox1"></div>		
						
                      <section class="panel" id = 'editBio2'>
                          <header class="panel-heading">
                             Personal Data Step 2 <?php echo $pre_regnum.$regNum; ?>
                          </header>
                          <div class="panel-body">
                              <!-- form --><form class="form-horizontal" id="frmBioData1" role="form" AUTOCOMPLETE=OFF>

									<div class="form-group">
                                      <label for="lname" class="col-lg-5 col-sm-5 control-label">* Surname Name:</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-user"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $lname; ?>" 
                                              id="lname" 
                                              name="lname"  required />
                                              
                                          </div>
                                      </div>
									</div>


									<div class="form-group">
                                      <label for="fname" class="col-lg-5 col-sm-5 control-label">* First Name:</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-user"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $fname; ?>" 
                                              id="fname" 
                                              name="fname"  required />
                                              
                                          </div>
                                      </div>
									</div>

									<div class="form-group">
                                      <label for="mname" class="col-lg-5 col-sm-5 control-label"> Middle Name:</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-user"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $mname; ?>" 
                                              id="mname" 
                                              name="mname"  />
                                              
                                          </div>
                                      </div>
									</div> 

									<div class="form-group">
										<label for="sex" class="col-lg-5 col-sm-5 control-label">* Sex</label>                                     
										<div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-user"></i>
                                              
                                              <select class="form-control"  id="sex" name="sex" required>
                                              
                                				<option value = "">Please Select One</option>

												<?php

													foreach($gender_list as $gender => $genderVal){  /* loop array */

														if ($sex == $gender){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$gender.'"'.$selected.'>'.$genderVal.'</option>' ."\r\n";

													}

												?>
												
                                              </select>

                                          </div>
                                      </div>
									</div>
                                  


									<div class="form-group">
                                                  <label class="control-label col-md-5">* Date Of Birth :</label>
                                                  <div class="col-md-3 col-xs-3">

                                                      <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="2012-12-02"  
                                                      class="input-append date dpYears">
                                                          <input type="text" readonly="" value="<?php echo $dateofbirth; ?>" 
                                                          size="10" class="form-control" d="dob" name="dob"  required />
                                                          <span class="input-group-btn add-on">
                                                            <button class="btn btn-danger" type="button"><i class="fa fa-calendar"></i></button>
                                                          </span>
                                                      </div>
                                                      <span class="help-block">Select date</span>
                                                  </div>
                                    </div>
											  
                                   


									<div class="form-group">
										<label for="bloodgr" class="col-lg-5 col-sm-5 control-label">* Blood Group</label>
                                     
										<div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-medkit"></i>
                                              
                                              <select class="form-control" id="bloodgr" name="bloodgr" require>
                                              
                                				<option value = "">Please Select One</option>

												<?php 

													foreach($bloodgr_list as $bloodgrVal => $bloodGroup){  /* loop array */

														if ($bloodgrVal == $bloodGP){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$bloodgrVal.'"'.$selected.'>'.$bloodGroup.'</option>' ."\r\n";

													}

												?>
                                              </select>

                                          </div>
                                      </div>
									</div>


									<div class="form-group">
										<label for="genotype" class="col-lg-5 col-sm-5 control-label">* Genotype</label>
                                     
										<div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-medkit"></i>
                                              
                                              <select class="form-control" id="genotype" name="genotype" require>
                                              
                                				<option value = "">Please Select One</option>

												<?php

													foreach($genotype_list as $genotype => $genotypeVal){  /* loop array */

														if ($genoTP == $genotype){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$genotype.'"'.$selected.'>'.$genotypeVal.'</option>' ."\r\n";

													}

												?>
                                              </select>

                                          </div>
                                      </div>
									</div> 
							
									<div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10"> 
                                          <input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />
                                         <input type="hidden" name="profileData" value="saveStudentS1" />
                                          <center><button type="submit" class="btn btn-danger buttonMargin"id="saveStudentS1">
                                          <i class="fa fa-mail-forward"></i> Save Profile</button></center>
                                      </div>
									</div>
  

								</form><!-- / form -->
							</div>
                         
						</section>  
				
				</div> 
				
				
				<div id="bio-3" class="tab-pane"><!-- tab 3 --> 
				
					<div class="msgBox2"></div>	 
			
						<section class="panel" id = 'editBio3'>
							<header class="panel-heading">
                              Personal Data Step 3 <?php echo $pre_regnum.$regNum; ?>
							</header>
							<div class="panel-body">
                              <!-- form --><form class="form-horizontal" id="frmBioData2" role="form" AUTOCOMPLETE=OFF>
                              

									<div class="form-group">
										<label for="country" class="col-lg-5 col-sm-5 control-label">* Country/Nationality</label>
                                     
										<div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-flag"></i>
                                              
                                              <select class="form-control"  id="country" name="country" required>
                                              
                                				<option value = "">Please Select One</option>

												<?php

													foreach($countrylist as $countryname){  /* loop array */

														if ($country == $countryname){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$countryname.'"'.$selected.'>'.$countryname.'</option>' ."\r\n";

													}

												?>

											 
                                              
                                              </select>

                                          </div>
										</div>
									</div>
                                  
                                 
									<div class="form-group">
                                      <label for="state" class="col-lg-5 col-sm-5 control-label">* State/Province</label>
									  
									  <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-home"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $state; ?>" id="state"  name="state"  required />
                                              
                                          </div>
                                      </div> 
										 
									</div> 
									
									<div class="form-group">
                                      <label for="city" class="col-lg-5 col-sm-5 control-label">* City :</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-home"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $city; ?>" id="city" 
                                              name="city"  required />
                                              
                                          </div>
                                      </div>
									</div>


									<div class="form-group">
                                      <label for="add1" class="col-lg-5 col-sm-5 control-label">* Student Address :</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-home"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $add1; ?>" id="add1" 
                                              name="add1"  required />
                                              
                                          </div>
                                      </div>
									</div>


									<div class="form-group">
                                      <label for="add2" class="col-lg-5 col-sm-5 control-label"> Student 2nd Address :</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-home"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $add2; ?>" id="add2" 
                                              name="add2"  />
                                              
                                          </div>
                                      </div>
									</div>

  
									<div class="form-group">
                                      <label for="studphone" class="col-lg-5 col-sm-5 control-label"> Student Mobile No. :</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-phone"></i>
                                              <input placeholder="e.g. +2348030716751" type="tel" 
                                              class="form-control capWords" value ="<?php echo $studphone; ?>" id="studphone" 
                                              name="studphone"   />
                                              
                                          </div>
                                      </div>
									</div>


									<div class="form-group">
                                      <label for="email" class="col-lg-5 col-sm-5 control-label"> Student Email :</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-envelope"></i>
                                              <input type="email" class="form-control lowWords" value ="<?php echo $email; ?>" id="email" 
                                              name="email" placeholder="igweze@gmail.com" />
                                              
                                          </div>
                                      </div>
									</div>
								  
								  
									<div class="form-group">
                                      <label for="hostel" class="col-lg-5 col-sm-5 control-label">School Hostel</label>
                                     
										<div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-home"></i>
                                              
                                              <select class="form-control"  id="hostel" name="hostel">
                                              
                                				<option value = "">Please Select One</option>

												<?php
												 
													try{

														$hostelDataArr = wizGradeHostelData($conn);  /* school hostel array */
														$hostelDataCount = count($hostelDataArr);
														
													}catch(PDOException $e) {
							
														wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
													}
							
													for($i = $fiVal; $i <= $hostelDataCount; $i++){  /* loop array */
														
														$hID = $hostelDataArr[$i]["h_id"];
														$hostel = $hostelDataArr[$i]["hostel"]; 
														
															if ($hID == $hostelID){
																$selected = "SELECTED";
															}else{
																$selected = "";
															} 
															
															echo '<option value="'.$hID.'"'.$selected.'>'.$hostel.'</option>' ."\r\n";
													}

												?> 
                                              
                                              </select>

                                          </div>
                                      </div>
									</div>
								  
								  
									<div class="form-group">
                                      <label for="route" class="col-lg-5 col-sm-5 control-label">School Route</label>
                                     
										<div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-home"></i>
                                              
                                              <select class="form-control"  id="route" name="route">
                                              
                                				<option value = "">Please Select One</option>

												<?php
												 
													try{

														$routeDataArr = wizGradeRouteData($conn);  /* school route array */
														$routeDataCount = count($routeDataArr);
														
													}catch(PDOException $e) {
							
														wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
													}
							
													for($i = $fiVal; $i <= $routeDataCount; $i++){  /* loop array */
														
														$rID = $routeDataArr[$i]["r_id"];
														$route = $routeDataArr[$i]["route"]; 
														
															if ($rID == $routeID){
																$selected = "SELECTED";
															}else{
																$selected = "";
															}

															
															echo '<option value="'.$rID.'"'.$selected.'>'.$route.'</option>' ."\r\n";
					
													}

												?>

                                              
                                              </select>

                                          </div>
										</div>
									</div>

									<div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10"> 
                                          <input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />
                                          <input type="hidden" name="profileData" value="saveStudentS2" />
                                          <center><button type="submit" class="btn btn-danger buttonMargin"id="saveStudentS2">
                                          <i class="fa fa-mail-forward"></i> Save Profile</button></center>
                                          
                                          
                                      </div>
									</div>
  

								</form><!-- / form -->
                          </div>
                         
						</section> 
				
				</div> 
				
				
				<div id="bio-4" class="tab-pane "><!-- tab 4 -->
				
					<div class="msgBox3"></div> 
					
						<section class="panel" id = 'editBio4'>
							<header class="panel-heading">
                              Sponsor Data Step 4 <?php echo $pre_regnum.$regNum; ?>
							</header>
							<div class="panel-body">
								<!-- form --><form class="form-horizontal" id="frmBioData3" role="form" AUTOCOMPLETE=OFF>
                              
									<div class="form-group">
                                      <label for="sponsor"  class="col-lg-5 col-sm-5 control-label">* Sponsor Name :
                                      </label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-male"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $sponsor; ?>" 
                                              id="sponsor" 
                                              name="sponsor"  required />
                                              
                                          </div>
                                      </div>
									</div> 

									<div class="form-group">
                                      <label  for="sponphone" class="col-lg-5 col-sm-5 control-label">* 
                                      Sponsor Mobile Number:</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-phone"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $sponphone; ?>" 
                                              id="sponphone" 
                                              name="sponphone" placeholder="e.g. +2348030716751" required />
                                              
                                          </div>
                                      </div>
									</div> 

									<div class="form-group">
                                      <label for="sponadd" class="col-lg-5 col-sm-5 control-label">* Sponsor Address :
                                      </label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-home"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $sponadd; ?>" 
                                              id="sponadd" 
                                              name="sponadd"  required />
                                              
                                          </div>
                                      </div>
									</div> 
                                      
									<div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10"> 
                                          <input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />
                                          <input type="hidden" name="profileData" value="sponsorData" />
                                          <center><button type="submit" class="btn btn-danger buttonMargin" 
                                          id="sponsorData">
                                          <i class="fa fa-mail-forward"></i> Save Profile </button></center>
                                          
                                          
                                      </div>
									</div>
  

								</form><!-- / form -->
							</div>
                         
						</section> 
					
				</div> 
				
				
				<?php if(($admin_grade == $adminGrade) && ($admin_level == $adminGradeInt)) {  /* check if school admin */ ?> 
				
				
				<div id="bio-5" class="tab-pane "><!-- tab 5 -->  
                
					<div class="msgBoxClass"></div>	 
															
						<section class="panel" id = 'editBio5'>
							<header class="panel-heading">
                              Class Settings <?php echo $pre_regnum.$regNum; ?>
							</header>
							<div class="panel-body">
                          
							<?php
						  
								$msg_i = 'Note: Student Should be move to another
								class at the end of each session. Thanks';
								echo $infMsg.$msg_i.$msgEnd;
						  
						  
							?>
								<!-- form --><form class="form-horizontal" id="frmsaveBioClass" role="form" AUTOCOMPLETE=OFF> 

									<div class="form-group">
                                      <label for="country" class="col-lg-5 col-sm-5 control-label">*
                                       <?php echo $levelArray[0]['level']; ?></label>
                                     
									<div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              
                                              <select class="form-control"  id="class_fi" name="class_fi">
                                              
                                				<option value = "">No Class</option>

												<?php

													foreach($classArray_fi as $class_fi){  /* loop array */

														if ($fiClass == $class_fi){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$class_fi.'"'.$selected.'>'.$class_fi.'</option>' ."\r\n";

													}

												?>
                                              
                                              </select>

                                          </div>
                                      </div>
									</div> 

									<div class="form-group">
                                      <label for="country" class="col-lg-5 col-sm-5 control-label">*
                                       <?php echo $levelArray[1]['level']; ?></label>
                                     
										<div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              
                                              <select class="form-control"  id="class_se" name="class_se">
                                              
                                				<option value = "">No Class</option>

												<?php

													foreach($classArray_se as $class_se){  /* loop array */

														if ($seClass == $class_se){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$class_se.'"'.$selected.'>'.$class_se.'</option>' ."\r\n";

													}

												?>
                                              
                                              </select>

                                          </div>
                                      </div>
									</div> 

									<div class="form-group">
                                      <label for="country" class="col-lg-5 col-sm-5 control-label">*
                                       <?php echo $levelArray[2]['level']; ?></label>
                                     
										<div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              
                                              <select class="form-control"  id="class_th" name="class_th">
                                              
                                				<option value = "">No Class</option>

												<?php

													foreach($classArray_th as $class_th){  /* loop array */

														if ($thClass == $class_th){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$class_th.'"'.$selected.'>'.$class_th.'</option>' ."\r\n";

													}

												?>
                                              
                                              </select>

                                          </div>
                                      </div>
									</div> 

									<?php
								

										if($schoolExt != $wizGradeNurAbr){  /* check if school is not nursery */
					
									?>
                                
									<div class="form-group">
                                      <label for="country" class="col-lg-5 col-sm-5 control-label">*
                                       <?php echo $levelArray[3]['level']; ?></label>
                                     
										<div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              
                                              <select class="form-control"  id="class_fo" name="class_fo">
                                              
                                				<option value = "">No Class</option>

												<?php

													foreach($classArray_fo as $class_fo){  /* loop array */

														if ($foClass == $class_fo){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$class_fo.'"'.$selected.'>'.$class_fo.'</option>' ."\r\n";

													}

												?>
                                              
                                              </select>

                                          </div>
                                      </div>
									</div> 

									<div class="form-group">
                                      <label for="country" class="col-lg-5 col-sm-5 control-label">*
                                       <?php echo $levelArray[4]['level']; ?></label>
                                     
										<div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              
                                              <select class="form-control"  id="class_fif" name="class_fif">
                                              
                                				<option value = "">No Class</option>

												<?php

												foreach($classArray_fif as $class_fif){  /* loop array */

													if ($fifClass == $class_fif){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$class_fif.'"'.$selected.'>'.$class_fif.'</option>' ."\r\n";

												}

												?>
                                              
                                              </select>

                                          </div>
                                      </div>
									</div> 

									<div class="form-group">
                                      <label for="country" class="col-lg-5 col-sm-5 control-label">*
                                       <?php echo $levelArray[5]['level']; ?></label>
                                     
										<div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              
                                              <select class="form-control"  id="class_six" name="class_six">
                                              
                                				<option value = "">No Class</option>

												<?php

												foreach($classArray_six as $class_six){  /* loop array */

													if ($sixClass == $class_six){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$class_six.'"'.$selected.'>'.$class_six.'</option>' ."\r\n";

												}

												?>
                                              
                                              </select>

                                          </div>
                                      </div>
									</div>
									<?php } ?> 
                              	

									<div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10"> 
                                          <input type='hidden' value = "<?php echo $regNum; ?>" name="regNum" />
                                          <input type="hidden" name="profileData" value="classSettings" />
                                          <center><button type="submit" class="btn btn-danger buttonMargin" 
                                          id="saveBioClass">
                                          <i class="fa fa-mail-forward"></i> Save Class </button></center>
                                      </div>
									</div> 

							</form><!-- / form -->
						</div>
                         
					</section> 
				
				</div>
				
				<?php }?> 
				
			  </div>
		  </div>
		</section>
		<!--tab nav start-->

		<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ $('.dpYears').datepicker(); /* initiates date selector */  </script>