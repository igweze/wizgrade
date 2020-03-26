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
	This script load online registration form
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		define('wizGrade', 'igweze');  /* defin55e a check for wrong access of file */ 
		
		require_once 'sources/functions/configDirIn.php';  /* include configuration script */
		
		require_once $wizGradeFunctionDir;  /* load script functions */			
		require ($wizGradeDBConnectIndDir);   /* load connection string */
		
		try {
		
			$schoolArray = wizGradeSchool($conn, $i_db_ext);  /* school configuration setup array  */
			$schoolTheme = $schoolArray[0]['school_theme'];
			$schoolNameTop = $schoolArray[0]['school_name'];
			$schoolThemeC = $schoolTheme;
			$wizGradeTheme = wizGradeThemeColor($schoolTheme, $wizGradeTemplateIN); /* wizGrade theme  */
			
			list ($cssTheme, $cssThemeReset) = explode ('@$$@', $wizGradeTheme);
						
		}catch(PDOException $e) {
		
				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
		 
		} 
		
		$wizGradeTemplate = $wizGradeTemplateIN; require_once ($wizGradeTemplateIN.'wizGradeHeader.php');  /* include template head */  

?>


		<body id="scrollBTarget" class="lock-screen">
	  
		<section id="container" style="margin:15px  auto;">

		<!-- page start--> 
	 
			<section class="panel col-lg-2"></section>

				<section class="panel col-lg-8">

				<header class="panel-heading"> 
					<i class="fa fa-user-plus fa-lg"></i> 
					<span class="hide-res"><?php echo $schoolNameTop ?> - </span> Online Registration 
					<span class="tools pull-right">
					<a href="javascript:;" class="fa fa-chevron-down"></a>
					<a href="javascript:;" class="fa fa-times"></a>
					</span>
				</header>


				<div class="panel-body wizGrade-linea">

				<div class="login-link">
					<!--
					<a href="<?php echo $wizGradeLogOutDir; ?>" class="application">
					<i class="fa fa-user"></i>
					School Website
					</a>
					-->
					<a href="<?php echo $wizGradeLogOutDir; ?>" class="home-login">
					<i class="fa fa-home"></i>
					Home
					</a> 

				</div>
				
				<div class="display-none"  id="wizCall"><span class="col-i-1">wizGrade call</span></div>				
				
				<span class="tools pull-right">

				</span>

				<div class="stepy-tab" id="scrollToTarget">
					<ul id="default-titles" class="stepy-titles clearfix">
						<li id="default-title-0" class="current-step step-one">
						<div>Step 1 </div>
						</li>
						<li id="default-title-1" class="">
						<div>Step 2</div>
						</li>
						<li id="default-title-2" class="">
						<div>Step 3</div>
						</li> 
					</ul>
				</div>

				<center><img src="loading.gif" alt="Loading >>>>>" id="reg-loader" 
				style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>

					<div id="msgBox"></div> 
					<!-- form -->
					<form enctype="multipart/form-data" class="form-horizontal frmsaveReg" id="wizardfrm" 
						method="POST" action="online-reg-manager.php">

						<fieldset title="Step 1" class="step" id="default-step-0">
							<legend> </legend>

							<progress class="progress display-none" value="0" max="100"></progress>
							<div class="form-group">
								<label class="control-label col-md-5" style="color:#333;">* Student 
								Picture Upload</label>
								<div class="col-md-7">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail msgSoftBoxPic" style="width: 
									200px; height: 150px;">
									<img src="<?php echo $studentPic; ?>" alt="" />
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail" 
									style="max-width: 
									200px; max-height: 150px; line-height: 20px;"></div>
									<div>
									<span class="btn btn-white btn-file">
									<span class="fileupload-new"><i class="fa fa-paper-clip"></i> 
									Select image</span>

									<span class="fileupload-exists"><i class="fa fa-undo"></i> 
									Select Image</span>
									<input type="file" id="uploadPic" 
									name="uploadPic" class="default" requir />
									</span>

									</div>
								</div>

								<span class="label label-danger">NOTE!</span>
								<span style="color:#ff0000">Only max image size of 2MB &amp; format 
								of <?php echo $allowedPicExt; ?> are allowed.  </span>
								</div>
							</div>


							<div class="form-group">
								<label for="school" class="col-lg-5 col-sm-5 control-label">* 
								Enrollment School Type</label>

								<div class="col-lg-7">
									<div class="iconic-input">
									<i class="fa fa-level-up"></i>

									<select class="form-control"  id="school" name="school" requir>

									<option value = "">Please select One</option>

									<?php

										foreach($school_list as $school => $schoolVal){  /* loop array */

											if ($sex == $school){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$school.'"'.$selected.'>'.$schoolVal.'</option>' ."\r\n";

										}

									?> 
									</select>
									</div>
								</div>
							</div>


							<span id="wait_11" style="display: none;">
							<center><img alt="Please Wait" src="loading.gif"/></center><!-- loading image -->
							</span>
							<span id="result_11" style="display: none;"></span> <!-- loading div -->


							<div class="form-group">
								<label for="lname" class="col-lg-5 col-sm-5 control-label">* Last Name:</label>

								<div class="col-lg-7">
								<div class="iconic-input">
								<i class="fa fa-user"></i>
								<input type="text" class="form-control" value ="" 
								id="lname" 
								name="lname"  requir />

								</div>
								</div>
							</div>


							<div class="form-group">
								<label for="fname" class="col-lg-5 col-sm-5 control-label">* First Name:</label>

								<div class="col-lg-7">
								<div class="iconic-input">
								<i class="fa fa-user"></i>
								<input type="text" class="form-control" value ="" 
								id="fname" 
								name="fname"  requir />

								</div>
								</div>
							</div>

							<div class="form-group">
								<label for="mname" class="col-lg-5 col-sm-5 control-label">* Middle Name:</label>

								<div class="col-lg-7">
								<div class="iconic-input">
								<i class="fa fa-user"></i>
								<input type="text" class="form-control" value ="" 
								id="mname" 
								name="mname"  requir />

								</div>
								</div>
							</div>  

							<div class="form-group">
								<label for="sex" class="col-lg-5 col-sm-5 control-label">* Sex</label>

								<div class="col-lg-7">
								<div class="iconic-input">
								<i class="fa fa-user"></i>

									<select class="form-control"  id="sex" name="sex" requir>

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
								<div class="col-md-5 col-xs-11">

								<div data-date-viewmode="years" data-date-format="yyyy-mm-dd" 
								data-date="2017-12-02"  
								class="input-append date dpYears">
								  <input type="text" readonly="" 
								  value="" 
								  size="10" class="form-control" d="dob" name="dob"  requir />
								  <span class="input-group-btn add-on">
									<button class="btn btn-danger" type="button">
									<i class="fa fa-calendar"></i></button>
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

									<select class="form-control" id="bloodgr" name="bloodgr" requir>

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

								<select class="form-control" id="genotype" name="genotype" requir>

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

						</fieldset>
						
						
						<fieldset title="Step 2" class="step" id="default-step-1" >
							<legend> </legend>

							<div class="form-group">
								<label for="country" class="col-lg-5 col-sm-5 control-label">* Country/Nationality</label>

								<div class="col-lg-7">
								<div class="iconic-input">
								<i class="fa fa-flag"></i>

									<select class="form-control"  id="country" name="country" requir>

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
								<input type="text" class="form-control" value ="<?php echo $state; ?>" id="state"  name="state"  requir />

								</div>
								</div>
							</div>
 
							<div class="form-group">
								<label for="city" class="col-lg-5 col-sm-5 control-label">* City :</label>

								<div class="col-lg-7">
								<div class="iconic-input">
								<i class="fa fa-home"></i>
								<input type="text" class="form-control" value ="" id="city" 
								name="city"  requir />

								</div>
								</div>
							</div> 

							<div class="form-group">
								<label for="add1" class="col-lg-5 col-sm-5 control-label">* Student Address :</label>
								<div class="col-lg-7">
								<div class="iconic-input">
								<i class="fa fa-home"></i>
								<input type="text" class="form-control" value ="" id="add1" 
								name="add1"  requir />
								</div>
								</div>
							</div>


							<div class="form-group">
								<label for="add2" class="col-lg-5 col-sm-5 control-label"> Student 2nd Address :</label>
								<div class="col-lg-7">
								<div class="iconic-input">
								<i class="fa fa-home"></i>
								<input type="text" class="form-control" value ="" id="add2" 
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
								class="form-control" value ="" id="studphone" 
								name="studphone"  requir />
								</div>
								</div>
							</div> 

							<div class="form-group">
								<label for="email" class="col-lg-5 col-sm-5 control-label"> Student Email :</label>
								<div class="col-lg-7">
								<div class="iconic-input">
								<i class="fa fa-envelope"></i>
								<input type="email" class="form-control" value ="" id="email" 
								name="email" placeholder="igweze@gmail.com" requir />
								</div>
								</div>
							</div> 

						</fieldset>
						
						<fieldset title="Step 3" class="step" id="default-step-2" >
							<legend> </legend>

							<div class="form-group">
								<label for="sponsor"  class="col-lg-5 col-sm-5 control-label">* Sponsor Name :
								</label>
								<div class="col-lg-7">
								<div class="iconic-input">
								<i class="fa fa-male"></i>
								<input type="text" class="form-control" 
								id="sponsor"  name="sponsor"  requir />
								</div>
								</div>
							</div>


							<div class="form-group">
								<label  for="sponphone" class="col-lg-5 col-sm-5 control-label">* 
								Sponsor Mobile Number:</label>
								<div class="col-lg-7">
								<div class="iconic-input">
								<i class="fa fa-phone"></i>
								<input type="text" class="form-control"
								id="sponphone" 
								name="sponphone" placeholder="e.g. +2348030716751, +2348030716751" requir />
								</div>
								</div>
							</div> 

							<div class="form-group">
								<label for="soccup"  class="col-lg-5 col-sm-5 control-label">* Sponsor Occupation :
								</label>
								<div class="col-lg-7">
								<div class="iconic-input">
								<i class="fa fa-male"></i>
								<input type="text" class="form-control" 
								id="soccup" 
								name="soccup"  requir />
								</div>
								</div>
							</div> 

							<div class="form-group">
								<label for="sponadd" class="col-lg-5 col-sm-5 control-label">* Sponsor Address :
								</label>
								<div class="col-lg-7">
								<div class="iconic-input">
								<i class="fa fa-home"></i>
								<input type="text" class="form-control" value ="<?php echo $sponadd; ?>" 
								id="sponadd" 
								name="sponadd"  requir />
								</div>
								</div>
							</div>  

						</fieldset> 

						<input type="hidden" name="registration" value="onlineReg" />
						<div class="display-none" id="wizAns"><span class="col-i-2">wizGrade ans</span></div>
						<button type="submit" class="btn btn-danger finish"  id="saveReg">
						<i class="fa fa-save"></i> Submit </button>
					</form>
						
					<!-- form -->

				</div><br />	<br /><br /><br />
			</section>

			<section class="panel col-lg-2"></section>
			<!-- page end-->
				

		</section>  
			<?php   require_once ($wizGradeTemplateIN.'footer-section-iframe.php');   /* include template footer */  ?>
				

            <script type="text/javascript">
			  
				$(function() {   /* format form with stepy jquery plugin */ 
					$('#wizardfrm').stepy({
						backLabel: 'Previous',
						block: true,
						nextLabel: 'Next',
						titleClick: true,
						titleTarget: '.stepy-tab'
					});
				});
				$('.dpYears').datepicker();   /* initialise date picker */ 
				
			</script>
                