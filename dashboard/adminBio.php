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
	This script handle admin profile
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configINwizGrade.php';  /* load wizGrade configuration files */	   
		 		 
		if ($_REQUEST['editAdmin'] != '') { 
		 
			try { 
					
					/* select information */ 
					$ebele_mark = "SELECT  admin_id, a_title, a_fname, a_lname, a_mname, a_picture,
									a_gender, a_dob, a_mstatus, a_country, a_state, a_lga, a_city, a_paradd, a_temadd, a_phone,
									a_mail, a_grade, a_sponsor, a_spo_phone, a_spo_add, genotype, bloodgp

									FROM $adminAccessTB

									WHERE admin_id = :admin_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':admin_id', $adminID);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {  /* check array is empty */
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
		   
							$adminID = $row['admin_id'];
							$title = $row['a_title'];					
							$fname = $row['a_fname'];
							$lname = $row['a_lname'];
							$mname = $row['a_mname'];
							$picture = $row['a_picture'];
							$genderV = $row['a_gender'];
							$dateofbirth = $row['a_dob'];
							$mstatus = $row['a_mstatus'];
							$country = $row['a_country'];
							$state = $row['a_state'];
							$lga = $row['a_lga'];
							$city = $row['a_city'];
							$add1 = $row['a_paradd'];
							$add2 = $row['a_temadd'];
							$i_phone = $row['a_phone'];
							$email = $row['a_mail'];
							$bloodGP = $row['bloodgp'];
							$genoTP = $row['genotype'];
							$spon = $row['a_sponsor'];
							$sphone = $row['a_spo_phone'];
							$adds = $row['a_spo_add'];
							$grade = $row['a_grade'];
						
						}	

						if ( (is_null($picture)) || ($picture == '') || (!file_exists($wizGradeAdminPicDir.$picture)) ){ 
									$adminPic = $wizGradeDefaultPic; }
						else { $adminPic = $wizGradeAdminPicDir.$picture; }
					   
						if($email == ''){ $adminMail = ''; }
						else {$adminMail = $email.'@wizgrade.com'; }
						
						
					
					}else{  /* display error */ 
					
							$msg =  "Admin's record with <span>$reg
									  </span> was not found.";									  
							echo $errorMsg.$msg.$eEnd;  
							echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>"; echo $scrollUp; exit; 			
													  
					}
					
				}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
				}
			
		
		
?>		
  
			<center><img src="loading.gif" alt="Loading >>>>>" class="adminLoader"  
			style="cursor:pointer; display:none; margin-bottom:10px;" /> </center> <!-- loading image-->

			<!--tab nav start-->
			<section class="panel">
			<header class="panel-heading tab-bg-dark-navy-blue wizGradeScrollTarget">
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
				  
			  </ul>
		  </header>
		  <div class="panel-body">
			  <div class="tab-content">
				  <div id="bio-1" class="tab-pane active"><!-- tab 1  -->
			  

					<div class="msgBoxPic"></div>	
                        	
						  <section class="panel" id = 'editBioPic'>
                          <header class="panel-heading">
                              Upload Admin Picture 
                          </header>
                          <div class="panel-body">
							<!-- form -->	
                              <form method="POST" id = "frmAminPic"  enctype="multipart/form-data" action='adminProfileManager.php'>


                                      <div class="form-group last">
                                          <label class="control-label col-md-5">*Select Picture</label>
                                          <div class="col-md-7">
                                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                                  <div class="fileupload-new thumbnail msgSoftBoxPic" style="width: 
                                                  200px; height: 150px;">
                                                      <img src="<?php echo $adminPic; ?>" alt="" />
                                                  </div>
                                                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 
                                                  200px; max-height: 150px; line-height: 20px;"></div>
                                                  <div>
                                                   <span class="btn btn-white btn-file pictureUploader">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> 
                                                   Select image</span>
                                                   
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Select Image</span>
                                                   <input type="file" id="uploadAdminPic" 
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
                                          <input type='hidden' value = "<?php echo $adminID; ?>" name="adminID" />
                                          <input type="hidden" name="adminData" value="adminPic" />                                          
                                          
                                      </div>
                                  </div>
  

                                      
                         
                 
                              </form>
							  <!-- / form -->
                          </div>
                         
                      </section>			  
				  
			  </div>  
			  
			  <div id="bio-2" class="tab-pane "><!-- tab 2 --> 
			  
					<div class="msgBox1"></div>	 
					
                      <section class="panel" id = 'editBio2'>
                          <header class="panel-heading">
                             Admin Personal Data Step 2 
                          </header>
                          <div class="panel-body">
						  
                              <!-- form -->
							  <form class="form-horizontal" id="frmStep1" role="form" AUTOCOMPLETE=OFF> 
							  
                              	<div class="form-group">
                                      <label for="title" class="col-lg-5 col-sm-5 control-label"> Title</label>
                                     
                                  <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-user"></i>
                                              
                                              <select class="form-control" id="title" name="title" >
                                              
                                				<option value = "">Please Select One</option>

												<?php

													foreach($title_list as $titleVal => $titleValue){  /* loop array */

														if ($titleVal == $title){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$titleVal.'"'.$selected.'>'.$titleValue.'</option>' ."\r\n";

													}

												?>
                                              </select>

                                          </div>
                                      </div>
                                  </div>
								
								
                                  <div class="form-group">
                                      <label for="lname" class="col-lg-5 col-sm-5 control-label">* Surname:</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-user"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $lname; ?>" id="lname" 
                                              name="lname"  required />
                                              
                                          </div>
                                      </div>
                                  </div> 

                                  <div class="form-group">
                                      <label for="fname" class="col-lg-5 col-sm-5 control-label">* First Name:</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-user"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $fname; ?>" id="fname" 
                                              name="fname"  required />
                                              
                                          </div>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label for="mname" class="col-lg-5 col-sm-5 control-label"> Middle Name:</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-user"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $mname; ?>" id="mname" 
                                              name="mname"   />
                                              
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

														if ($genderV == $genderVal){
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
                                              
                                              <select class="form-control" id="bloodgr" name="bloodgr" required>
                                              
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
                                              
                                              <select class="form-control" id="genotype" name="genotype" required>
                                              
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
                                          <input type='hidden' value = "<?php echo $adminID; ?>" name="adminID" />
                                         <input type="hidden" name="adminData" value="saveStep1" />
                                          <center><button type="submit" class="btn btn-danger buttonMargin"id="saveStep1">
                                          <i class="fa fa-mail-forward"></i> Save Profile</button></center>
                                          
                                          
                                      </div>
                                </div>
  

                              </form>
							  <!-- / form -->
                          </div>
                         
                      </section> 
			  
			  </div> 
			  
			  <div id="bio-3" class="tab-pane "><!-- tab 3 --> 
			  
				<div class="msgBox2"></div> 
			
                      <section class="panel" id = 'editBio3'>
                          <header class="panel-heading">
                              Admin Personal Data Step 3 
                          </header>
                          <div class="panel-body">
                              <!-- form -->
							  <form class="form-horizontal" id="frmStep2" role="form" AUTOCOMPLETE=OFF> 

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
                                      <label for="add1" class="col-lg-5 col-sm-5 control-label">* Admin Address :</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-home"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $add1; ?>" id="add1" 
                                              name="add1"  required />
                                              
                                          </div>
                                      </div>
                                  </div> 

                                  <div class="form-group">
                                      <label for="add2" class="col-lg-5 col-sm-5 control-label"> Admin 2nd Address :</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-home"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $add2; ?>" id="add2" 
                                              name="add2"  />
                                              
                                          </div>
                                      </div>
                                  </div> 
  
                                  <div class="form-group">
                                      <label for="i_phone" class="col-lg-5 col-sm-5 control-label">* Admin Mobile No. :</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-phone"></i>
                                              <input placeholder="e.g. +2348030716751" type="tel" 
                                              class="form-control capWords" value ="<?php echo $i_phone; ?>" id="i_phone" 
                                              name="i_phone"  required />
                                              
                                          </div>
                                      </div>
                                  </div> 

                                  <div class="form-group">
                                      <label for="email" class="col-lg-5 col-sm-5 control-label">* Admin Email :</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-envelope"></i>
                                              <input type="email" class="form-control lowWords" value ="<?php echo $email; ?>" id="email" 
                                              name="email" placeholder="igweze@gmail.com" required />
                                              
                                          </div>
                                      </div>
                                  </div>

                                 <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10"> 
                                          <input type='hidden' value = "<?php echo $adminID; ?>" name="adminID" />
                                          <input type="hidden" name="adminData" value="saveStep2" />
                                          <center><button type="submit" class="btn btn-danger buttonMargin"id="saveStep2">
                                          <i class="fa fa-mail-forward"></i> Save Profile</button></center>
                                          
                                          
                                      </div>
                                  </div> 

                              </form>
							  <!-- / form -->
                          </div>
                         
                      </section>
					  
			  </div> 
			  
			  
			  <div id="bio-4" class="tab-pane "><!-- tab 4 -->
			  
					<div class="msgBox3"></div>		
				 
                      <section class="panel" id = 'editBio4'>
                          <header class="panel-heading">
                              Admin Next of Kin Step  4 
                          </header>
                          <div class="panel-body">
                              
							  <!-- form -->
							  <form class="form-horizontal" id="frmStep3" role="form" AUTOCOMPLETE=OFF>
                              
                                  <div class="form-group">
                                      <label for="sponsor"  class="col-lg-5 col-sm-5 control-label">* Next of Kin Name :</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-male"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $spon; ?>" id="sponsor" 
                                              name="sponsor"  required />
                                              
                                          </div>
                                      </div>
                                  </div>


                                  <div class="form-group">
                                      <label  for="sponphone" class="col-lg-5 col-sm-5 control-label">* Next of Kin Mobile Number:</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-phone"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $sphone; ?>" id="sponphone" 
                                              name="sponphone" placeholder="e.g. +2348030716751" required />
                                              
                                          </div>
                                      </div>
                                  </div> 

                                  <div class="form-group">
                                      <label for="sponadd" class="col-lg-5 col-sm-5 control-label">* Next of Kin Address :</label>

                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-home"></i>
                                              <input type="text" class="form-control capWords" value ="<?php echo $adds; ?>" id="sponadd" 
                                              name="sponadd"  required />
                                              
                                          </div>
                                      </div>
                                  </div> 
                                      
                                 <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10"> 
                                          <input type='hidden' value = "<?php echo $adminID; ?>" name="adminID" />
                                          <input type="hidden" name="adminData" value="saveStep3" />
                                          <center><button type="submit" class="btn btn-danger buttonMargin" id="saveStep3">
                                          <i class="fa fa-mail-forward"></i> Save Profile </button></center>
                                          
                                          
                                      </div>
                                  </div> 

                              </form>
							  <!-- / form -->
                          </div>
                         
                      </section>

					  
			  </div>
			  
			  
			  
			  
			</div>
			</div>
		</section>
		<!--tab nav start-->		
  
		<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ $('.dpYears').datepicker(); /* initiates date selector */  </script> 


<?php
				
		}else{ 
		
					echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
		} 	
?>
				