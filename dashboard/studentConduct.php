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
	This script load student conducts field
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

		 require 'configwizGrade.php';  /* load wizGrade configuration files */	   
		 	
		 if ((isset($_REQUEST['studentConductData'])))  {
		 
		 $SConductData = $_REQUEST['studentConductData'];
		 
		 list ($regNum, $level, $term, $class, $isOverLay) = explode ("@@", $SConductData);
		 
		 require  $wizGradeClassConfigDir;   /* include class configuration script */
		 		 
			try {
				
		 		$gsRemarkArray =	teacherRemarksArrays($conn);  /* teacher remarks array */ 
				$clubArray = studentsClubArrays($conn);  /* school clubs array */
				$clubPostArray = clubPostArrays($conn);  /* school clubs position array */
				$sportArray = sportsArrays($conn);  /* school sports array */
				$sportsToken = sportsToken($conn);  /* school sports token array */
				$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */
				$session_fi = wizGradeSession($conn, $sessionID);  /* student school session */					
		 
		 		$session_se = $session_fi + $foreal;  

  				$ebele_mark = "SELECT r.ireg_id, nk_regno, s.$conducts_field

                     FROM $i_reg_tb r, $sdoracle_student_remark_nk s

                     WHERE r.nk_regno = :nk_regno
					 
                     AND r.ireg_id = s.ireg_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				
    			$igweze_prep->bindValue(':nk_regno', $regNum);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {  /* check array is empty */
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */
		   
						$regNum = $row['nk_regno'];
						$ID = $row['ireg_id'];
						$attendance = $row[$attendance_r];
						$conducts = $row[$conducts_r];
						$i_sport = $row[$sports_r];
						$organization = $row[$organization_r];
						$comment = $row[$comment_r];
						$teacherComment = $row[$comment_t];
						$pr_comment = $row[$pr_comment_r];
					
					}	
				
					list ($notSchOpen, $notPresent, $notPunc) = explode (",", $attendance);
					
					list ( $i_neatness, $i_politeness, $i_honesty, $i_leadership, $i_attentiveness, $i_emotionalstab,
							$i_health, $i_attitudesch, $i_speaking, $i_handwriting) = explode (",", $conducts);
												
  				    list ($i_sport_1, $i_sport_2, $i_sport_3, $i_sport_4, $i_sport_5, $i_sport_6, $i_sport_7, 
						  $i_sport_8) = explode (",", $i_sport);
	   
					if (isset($i_sport_1)) { $sp1 = "$i_sport_1";  settype($sp1, "integer");  $sports_array = array($sp1);}
					if (isset($i_sport_2)) { $sp2 = "$i_sport_2";  settype($sp2, "integer"); $sports_array = ""; 
					$sports_array = array($sp1, $sp2);}
					if (isset($i_sport_3)) { $sp3 = "$i_sport_3";  settype($sp3, "integer"); $sports_array = ""; 
					$sports_array = array($sp1, $sp2, $sp3);}   
					if (isset($i_sport_4)) { $sp4 = "$i_sport_4";  settype($sp4, "integer"); $sports_array = ""; 
					$sports_array = array($sp1, $sp2, $sp3, $sp4);}
					if (isset($i_sport_5)) { $sp5 = "$i_sport_5";  settype($sp5, "integer"); $sports_array = ""; 
					$sports_array = array($sp1, $sp2, $sp3, $sp4, $sp5);}   
					if (isset($i_sport_6)) { $sp6 = "$i_sport_6";  settype($sp6, "integer"); $sports_array = ""; 
					$sports_array = array($sp1, $sp2, $sp3, $sp4, $sp5, $sp6);}
					if (isset($i_sport_7)) { $sp7 = "$i_sport_7";  settype($sp7, "integer");
											 $sports_array = ""; $sports_array = array($sp1, $sp2, $sp3, $sp4, $sp5, $sp6,
																					   $sp7);}   
					if (isset($i_sport_8)) { $sp8 = "$i_sport_8";  settype($sp8, "integer"); 
					  						 $sports_array = ""; $sports_array = array($sp1, $sp2, $sp3, $sp4, $sp5, $sp6, 
																					   $sp7, $sp8);}	
																	
  				    list ($fi_social_info, $se_social_info, $th_social_info, $fo_social_info, $fif_social_info) = explode 
					("%##%", $organization);
					
					list ($i_fi_org, $i_fi_off, $fi_contrib) = explode ("@@", $fi_social_info); 
					list ($i_se_org, $i_se_off, $se_contrib) = explode ("@@", $se_social_info);
					list ($i_th_org, $i_th_off, $th_contrib) = explode ("@@", $th_social_info);
					list ($i_fo_org, $i_fo_off, $fo_contrib) = explode ("@@", $fo_social_info);
					list ($i_fif_org, $i_fif_off, $fif_contrib) = explode ("@@", $fif_social_info);
					
					if(isset($fi_social_info)){ settype($i_fi_org, "integer"); settype($i_fi_off, "integer"); }
					if(isset($se_social_info)){ settype($i_se_org, "integer"); settype($i_se_off, "integer"); }
					if(isset($th_social_info)){ settype($i_th_org, "integer"); settype($i_th_off, "integer"); }
					if(isset($fo_social_info)){ settype($i_fo_org, "integer"); settype($i_fo_off, "integer"); }
					if(isset($fif_social_info)){ settype($i_fif_org, "integer"); settype($i_fif_off, "integer"); } 
						 	
				}else{  /* display error */ 
		
					$msg_e .=  "Student record with <span>$regNum
                          </span> was not found.";
					echo $errorMsg.$msg_e.$eEnd;  exit;						  
				}
				
			}catch(PDOException $e) {
				
				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			}
	
?>

 <!-- page start-->


						<section class="panel">                      
							<header class="panel-heading">  
                              <?php echo $pre_regnum.$regNum; ?>  Student's Conduct C Panel							  
							</header> 
							<div class="panel-body wizGrade-line">
                          
                          	<span class="tools pull-right">
								<?php 
							  		if($isOverLay == $foreal){  /* check if verlay is true */ 

										echo"<div class='close-ov-btn'><img src='";
										echo $wizGradeTemplate; echo "images/exitbtn.png' alt='Exit Page' 
										class ='exit-overlay-box showPrintBtn'/></div>";
										echo "<span class='clear' style='margin-top:0px;'> </span>";

									}
								?>
                            </span>

							<!-- stepy tab start -->
							
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
								  <li id="default-title-3" class="">
									  <div>Step 4</div>
								  </li>
								  
							  </ul>
							</div>

							<center><img src="loading.gif" alt="Loading >>>>>" class="conductLoader" 
								  style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>
							<div id="msgBoxC"> </div>
							
							<!-- form -->
							<form class="form-horizontal frmConducts" id="wizardfrm">
								<fieldset title="Step 1" class="step" id="default-step-0">
								  <legend> </legend> 

								  <div class="form-group">
									  <label for="noschopen" class="col-lg-5 control-label">* 
									  No of Times School Open</label>
									  <div class="col-lg-7">
									  <div class="iconic-input">
										  <i class="fa fa-calendar"></i>
										  <input type="text"  id="noschopen" name="noschopen"  
										  value = "<?php echo $notSchOpen ?>" 
										  class="form-control" placeholder="300" require>
									  </div>
									  </div>
								  </div>
								  <div class="form-group">
									  <label for="nopre" class="col-lg-5 control-label">* No of Times Present</label>
									  <div class="col-lg-7">
									  <div class="iconic-input">
										  <i class="fa fa-calendar"></i>
										  <input type="text" id="nopre" name="nopre"  value = "<?php echo $notPresent ?>" 
										  class="form-control" placeholder="270" require>
									  </div>
									  </div>
								  </div>
								  <div class="form-group">
									  <label for="nopunt" class="col-lg-5 control-label">* No of Times Punctual</label>
									  <div class="col-lg-7">
									  <div class="iconic-input">
										  <i class="fa fa-calendar"></i>
										  <input type="text" id="nopunt" name="nopunt"  value = "<?php echo $notPunc ?>" 
										  class="form-control" placeholder="250" require>
									  </div>
									  </div>
								  </div>
								  <input type="hidden" name="studentConducts" value="ConductsFi" />

								</fieldset>
								<fieldset title="Step 2" class="step" id="default-step-1" >
								  
								  <legend> </legend>
								  
								  <div class="form-group">
								  <label for="neatness" class="col-lg-4 col-sm-4 control-label">* Neatness: </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select id="neatness" name="neatness" class="form-control"  require>

											<option value = "">Please select One</option>

											<?php

												foreach($conduct_list as $neatness){  /* loop array */

													if ($i_neatness == $neatness){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$neatness.'"'.$selected.'>'.$neatness.'</option>' ."\r\n";

												}

											?>

											</select>
									  </div>
								  </div>
								  </div>

								  <div class="form-group">
								  <label for="politenes" class="col-lg-4 col-sm-4 control-label">* Politeness: </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select  id="politeness" name="politeness"  class="form-control"  require>

											<option value = "">Please select One</option>

											<?php

												foreach($conduct_list as $politeness){  /* loop array */

													if ($i_politeness == $politeness){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$politeness.'"'.$selected.'>'.$politeness.'</option>' ."\r\n";

												}

											?>


											</select>
									  </div>
								  </div>
								  </div>


								  <div class="form-group">
								  <label for="honesty" class="col-lg-4 col-sm-4 control-label">* Honesty: </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select id="honesty" name="honesty"  class="form-control"  require>

											<option value = "">Please select One</option>
											<?php

												foreach($conduct_list as $honesty){  /* loop array */

													if ($i_honesty == $honesty){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$honesty.'"'.$selected.'>'.$honesty.'</option>' ."\r\n";

												}

											?>

											</select>
									  </div>
								  </div>
								  </div>
								  
								  <div class="form-group">
								  <label for="leadership" class="col-lg-4 col-sm-4 control-label">* Leadership: </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select id="leadership" name="leadership" class="form-control"  require>

											<option value = "">Please select One</option>

											<?php

												foreach($conduct_list as $leadership){  /* loop array */

													if ($i_leadership == $leadership){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$leadership.'"'.$selected.'>'.$leadership.'</option>' ."\r\n";

												}

											?>


											</select>
									  </div>
								  </div>
								  </div>
								  
								  <div class="form-group">
								  <label for="attentiveness" class="col-lg-4 col-sm-4 control-label">* Attentiveness: : </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select id="attentiveness" name="attentiveness" class="form-control"  require>

											<option value = "">Please select One</option>
											<?php

												foreach($conduct_list as $attentiveness){  /* loop array */

													if ($i_attentiveness == $attentiveness){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$attentiveness.'"'.$selected.'>'.$attentiveness.'</option>' ."\r\n";

												}

											?>


											</select>
									  </div>
								  </div>
								  </div>
								  
								  <div class="form-group">
								  <label for="emotionalstab" class="col-lg-4 col-sm-4 control-label">* Emotional Stability: </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select id="emotionalstab" name="emotionalstab" class="form-control"  require>

											<option value = "">Please select One</option>

											<?php

												foreach($conduct_list as $emotionalstab){  /* loop array */

													if ($i_emotionalstab == $emotionalstab){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$emotionalstab.'"'.$selected.'>'.$emotionalstab.'</option>' ."\r\n";

												}

											?>

											</select>
									  </div>
								  </div>
								  </div>
								  

								  <div class="form-group">
								  <label for="health" class="col-lg-4 col-sm-4 control-label">* Health: </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select d="health" name="health" class="form-control"  require>

											<option value = "">Please select One</option>

											<?php

												foreach($conduct_list as $health){  /* loop array */

													if ($i_health == $health){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$health.'"'.$selected.'>'.$health.'</option>' ."\r\n";

												}

											?>

											</select>
									  </div>
								  </div>
								  </div>


								  <div class="form-group">
								  <label for="attitudesch" class="col-lg-4 col-sm-4 control-label">* Attitude to School Work: </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select id="attitudesch" name="attitudesch" class="form-control"  require>

											<option value = "">Please select One</option>
											<?php

												foreach($conduct_list as $attitudesch){  /* loop array */

													if ($i_attitudesch == $attitudesch){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$attitudesch.'"'.$selected.'>'.$attitudesch.'</option>' ."\r\n";

												}

											?>


											</select>
									  </div>
								  </div>
								  </div>


								  <div class="form-group">
								  <label for="speaking" class="col-lg-4 col-sm-4 control-label">* Speaking: </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select id="speaking" name="speaking" class="form-control"  require>

											<option value = "">Please select One</option>
											<?php

												foreach($conduct_list as $speaking){  /* loop array */

													if ($i_speaking == $speaking){
													$selected = "SELECTED";
													} else {
													$selected = "";
													}

													echo '<option value="'.$speaking.'"'.$selected.'>'.$speaking.'</option>' ."\r\n";

												}

											?> 

											</select>
									  </div>
								  </div>
								  </div>



								  <div class="form-group">
								  <label for="handwriting" class="col-lg-4 col-sm-4 control-label">* Handwriting : </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select id="handwriting" name="handwriting" class="form-control"  require>

											<option value = "">Please select One</option>

											<?php

												foreach($conduct_list as $handwriting){  /* loop array */

													if ($i_handwriting == $handwriting){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$handwriting.'"'.$selected.'>'.$handwriting.'</option>' ."\r\n";

												}

											?>

											</select>
									  </div>
								  </div>
								  </div> 

								  
								</fieldset>
								<fieldset title="Step 3" class="step" id="default-step-2" >
								  <legend> </legend>

								  <div class="form-group">
								  <label for="fi_organ" class="col-lg-4 col-sm-4 control-label"> Organization : </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-users"></i>
										  
											<select id="fi_organ" name="fi_organ" class="form-control">

											<option value = "">Please select One</option>

											<?php
											
												foreach ($clubArray as $clubKey => $clubValue){  /* loop array */
													settype($clubKey, "integer");
													$clubVal = $clubArray[$clubKey]['name'];
													if ($i_fi_org == $clubKey){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}
													echo '<option value="'.$clubKey.'"'.$selected.'>'.$clubVal.$clubKey.'</option>' ."\r\n";
													$clubVal =''; $clubKey = '';

												}
											
											
											?>

											</select>
									  </div>
								  </div>
								  </div>



								  <div class="form-group">
								  <label for="fi_off" class="col-lg-4 col-sm-4 control-label"> Office Held : </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select id="fi_off" name="fi_off" class="form-control" >

											<option value = "">Please select One</option>


											<?php
											
												foreach ($clubPostArray as $clubPostKey => $clubpostValue){  /* loop array */
													settype($clubPostKey, "integer");
													$clubpostVal = $clubPostArray[$clubPostKey]['name'];
													if ($i_fi_off == $clubPostKey){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}
													echo '<option value="'.$clubPostKey.'"'.$selected.'>'.$clubpostVal.'</option>' ."\r\n";
													$clubpostVal =''; $clubPostKey = '';

												}
											
											
											?>

											</select>
									  </div>
								  </div>
								  </div>

								 <div class="form-group">
									  <label for="fi_contrib" class="col-lg-4 control-label">Contribution</label>
									  <div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  <input type="text"  id="fi_contrib" name="fi_contrib"  value = "<?php echo $fi_contrib ?>" 
										  class="form-control" placeholder="Help His/Her Club . . . . .">
									  </div>
									  </div>
								  </div>
								  <hr />    
							 

								  <div class="form-group">
								  <label for="se_organ" class="col-lg-4 col-sm-4 control-label"> Organization : </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-users"></i>
										  
											<select id="se_organ" name="se_organ" class="form-control">

											<option value = "">Please select One</option>

											<?php
											
												foreach ($clubArray as $clubKey => $clubValue){  /* loop array */
													settype($clubKey, "integer");
													$clubVal = $clubArray[$clubKey]['name'];
													if ($i_se_org == $clubKey){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}
													echo '<option value="'.$clubKey.'"'.$selected.'>'.$clubVal.'</option>' ."\r\n";
													$clubVal =''; $clubKey = '';

												}
											
											
											?>



											</select>
									  </div>
								  </div>
								  </div>



								  <div class="form-group">
								  <label for="se_off" class="col-lg-4 col-sm-4 control-label"> Office Held : </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select id="se_off" name="se_off" class="form-control" >

											<option value = "">Please select One</option>


											<?php
											
												foreach ($clubPostArray as $clubPostKey => $clubpostValue){  /* loop array */
													settype($clubPostKey, "integer");
													$clubpostVal = $clubPostArray[$clubPostKey]['name'];
													if ($i_se_off == $clubPostKey){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}
													echo '<option value="'.$clubPostKey.'"'.$selected.'>'.$clubpostVal.'</option>' ."\r\n";
													$clubpostVal =''; $clubPostKey = '';

												}
											
											
											?>

											</select>
									  </div>
								  </div>
								  </div>

								 <div class="form-group">
									  <label for="se_contrib" class="col-lg-4 control-label">Contribution</label>
									  <div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  <input type="text"  id="se_contrib" name="se_contrib"  value = "<?php echo $se_contrib ?>" 
										  class="form-control" placeholder="Help His/Her Club . . . . .">
									  </div>
									  </div>
								  </div>
							 <hr />    
							 

								  <div class="form-group">
								  <label for="th_organ" class="col-lg-4 col-sm-4 control-label"> Organization : </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-users"></i>
										  
											<select id="th_organ" name="th_organ" class="form-control">

											<option value = "">Please select One</option>
											<?php
											
												foreach ($clubArray as $clubKey => $clubValue){  /* loop array */
													settype($clubKey, "integer");
													$clubVal = $clubArray[$clubKey]['name'];
													if ($i_th_org == $clubKey){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}
													echo '<option value="'.$clubKey.'"'.$selected.'>'.$clubVal.'</option>' ."\r\n";
													$clubVal =''; $clubKey = '';

												}
												
												
											?>

											</select>
									  </div>
								  </div>
								  </div>



								  <div class="form-group">
								  <label for="th_off" class="col-lg-4 col-sm-4 control-label"> Office Held : </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select id="th_off" name="th_off" class="form-control" >

											<option value = "">Please select One</option>


											<?php
											
												foreach ($clubPostArray as $clubPostKey => $clubpostValue){  /* loop array */
													settype($clubPostKey, "integer");
													$clubpostVal = $clubPostArray[$clubPostKey]['name'];
													if ($i_th_off == $clubPostKey){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}
													echo '<option value="'.$clubPostKey.'"'.$selected.'>'.$clubpostVal.'</option>' ."\r\n";
													$clubpostVal =''; $clubPostKey = '';

												}
												
											
											?>

											</select>
									  </div>
								  </div>
								  </div>

								 <div class="form-group">
									  <label for="th_contrib" class="col-lg-4 control-label">Contribution</label>
									  <div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  <input type="text"  id="th_contrib" name="th_contrib"  
										  value = "<?php echo $th_contrib ?>" 
										  class="form-control" placeholder="Help His/Her Club . . . . .">
									  </div>
									  </div>
								  </div>


								 <hr />    
								 
								  <div class="form-group">
								  <label for="fo_organ" class="col-lg-4 col-sm-4 control-label"> Organization : </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-users"></i>
										  
											<select id="fo_organ" name="fo_organ" class="form-control">

											<option value = "">Please select One</option>

											<?php
											
												foreach ($clubArray as $clubKey => $clubValue){  /* loop array */
													settype($clubKey, "integer");
													$clubVal = $clubArray[$clubKey]['name'];
													if ($i_fo_org == $clubKey){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}
													echo '<option value="'.$clubKey.'"'.$selected.'>'.$clubVal.'</option>' ."\r\n";
													$clubVal =''; $clubKey = '';

												}
											
											
											?>

											</select>
									  </div>
								  </div>
								  </div>



								  <div class="form-group">
								  <label for="fo_off" class="col-lg-4 col-sm-4 control-label"> Office Held : </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select id="fo_off" name="fo_off" class="form-control" >

											<option value = "">Please select One</option>


											<?php
											
												foreach ($clubPostArray as $clubPostKey => $clubpostValue){  /* loop array */
													settype($clubPostKey, "integer");
													$clubpostVal = $clubPostArray[$clubPostKey]['name'];
													if ($i_fo_off == $clubPostKey){
													$selected = "SELECTED";
													} else {
													$selected = "";
													}
													echo '<option value="'.$clubPostKey.'"'.$selected.'>'.$clubpostVal.'</option>' ."\r\n";
													$clubpostVal =''; $clubPostKey = '';

												}
												
											
											?>

											</select>
									  </div>
								  </div>
								  </div>

								 <div class="form-group">
									  <label for="fo_contrib" class="col-lg-4 control-label">Contribution</label>
									  <div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  <input type="text"  id="fo_contrib" name="fo_contrib"  
										  value = "<?php echo $fo_contrib ?>" 
										  class="form-control" placeholder="Help His/Her Club . . . . .">
									  </div>
									  </div>
								  </div>
								 
								 <hr /> 
								 

								  <div class="form-group">
								  <label for="fif_organ" class="col-lg-4 col-sm-4 control-label"> Organization : </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-users"></i>
										  
											<select id="fif_organ" name="fif_organ" class="form-control">

											<option value = "">Please select One</option>
											<?php
											
												foreach ($clubArray as $clubKey => $clubValue){  /* loop array */
													settype($clubKey, "integer");
													$clubVal = $clubArray[$clubKey]['name'];
													if ($i_fif_org == $clubKey){
													$selected = "SELECTED";
													} else {
													$selected = "";
													}
													echo '<option value="'.$clubKey.'"'.$selected.'>'.$clubVal.'</option>' ."\r\n";
													$clubVal =''; $clubKey = '';

												}
												
											
											?>

											</select>
									  </div>
								  </div>
								  </div>



								  <div class="form-group">
								  <label for="fif_off" class="col-lg-4 col-sm-4 control-label"> Office Held : </label>
								 
									<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  
											<select id="fif_off" name="fif_off" class="form-control" >

											<option value = "">Please select One</option>


											<?php
											
												foreach ($clubPostArray as $clubPostKey => $clubpostValue){  /* loop array */
													settype($clubPostKey, "integer");
													$clubpostVal = $clubPostArray[$clubPostKey]['name'];
													if ($i_fif_off == $clubPostKey){
													$selected = "SELECTED";
													} else {
													$selected = "";
													}
													echo '<option value="'.$clubPostKey.'"'.$selected.'>'.$clubpostVal.'</option>' ."\r\n";
													$clubpostVal =''; $clubPostKey = '';

												}
												
											
											?>

											</select>
									  </div>
								  </div>
								  </div>

								 <div class="form-group">
									  <label for="fif_contrib" class="col-lg-4 control-label">Contribution</label>
									  <div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  <input type="text"  id="fif_contrib" name="fif_contrib"  
										  value = "<?php echo $fif_contrib ?>" 
										  class="form-control" placeholder="Help His/Her Club . . . . .">
									  </div>
									  </div>
								  </div>
								 
								  
							  </fieldset>

							  
							<fieldset title="Step 4" class="step" id="default-step-3">
								  <legend> </legend>


								   <div class="form-group">
									  <label for="sports_inputs" class="col-lg-5 control-label">Student's Sports</label>
									  <div class="col-lg-7">
									  <div class="iconic-input">
										  <i class="fa fa-user"></i>
										  <input type="text"  id="sports_inputs" name="sports" class="form-control" >


<?php
													if(isset($i_sport)){  /* check array is empty */
														
														foreach($sports_array as $spID => $spKey){  /* loop array */
															
															$sport = $sportArray[$spKey]['name'];
															
															$selSport .=  "{ value: '$spKey', label: '$sport' },";	
															
														}
														
														$selSport = trim($selSport, ',');	
													}	

$showSports =<<<IGWEZE

													<script type='text/javascript'>  
																											  
													$('#sports_inputs').tokenfield({   /* tokenize field using tokenfield jQuery plugin */
													  autocomplete: {
														  
														source: [ $sportsToken ],
														delay: 100,
														limit:5														
													  },
													  showAutocompleteOnFocus: true
													})
												  
													$('#sports_inputs').tokenfield('setTokens', [$selSport]); 
												  
												  
													$('#sports_inputs').on('tokenfield:createtoken', function (event) {
														var existingTokens = $(this).tokenfield('getTokens');
														$.each(existingTokens, function(index, token) {
															if (token.value === event.attrs.value)
																event.preventDefault();
														});
													});	

													</script>

IGWEZE;
												echo $showSports;													

?>				
										  


									  </div>
									  </div>
								  </div>	
								  
									<!--
								   <div class="form-group">
									  <label for="teachers_remark" class="col-lg-5 control-label">
									  Guidance & Counsellor's Remarks </label>
									  <div class="col-lg-7">
									  <div class="iconic-input">
										  <i class="fa fa-comment"></i>
										  <input type="text"  id="teachers_remark" name="remarks" class="form-control" >
										  
										   
									  </div>
									  </div>
								  </div>	
								  
									-->
									 

								  <div class="form-group">
									  <label for="teacherCom" class="col-lg-5 control-label">
									 Form Teacher's Comment </label>
									  <div class="col-lg-7">
									  <div class="iconic-input">
										  <i class="fa fa-comment-o"></i>
										  <input type="text" id="teacherCom" name="teacherCom" maxlength="100" 

										  value = "<?php echo $teacherComment; ?>" 
										  class="form-control" placeholder="">
									  </div>
									  
										 
									  </div>
								  </div>


								  <div class="form-group">
									  <label for="pr_comment" class="col-lg-5 control-label">
									  Principal Comment (Optional)</label>
									  <div class="col-lg-7">
									  <div class="iconic-input">
										  <i class="fa fa-comment"></i>
										  <input type="text" id="pr_comment" name="pr_comment" maxlength="100" 
										  value = "<?php echo $pr_comment; ?>" 
										  class="form-control" placeholder="">
									  </div>
									  <span class="label label-danger">NOTE!</span>
										 <span style="color:#ff0000"> Principal Comment is automatically generated
										 by the application, if not entered.
										 </span>
										 
									  </div>
								  </div>
								 
							  </fieldset>
							  <input type="hidden" name="studentData" value="studentConducts" />
							  <input type='hidden' value = "<?php echo $SConductData; ?>" name="SConductData" />	
							  <input type="submit" class="finish btn btn-danger" id="saveConducts" value="Finish"/>
							</form>
							<!-- / form -->

							<!-- stepy tab end -->
							</div>
							</section>


				<!-- page end--> 

				<script type="text/javascript">
					
					 	$(function() {
          					$('#wizardfrm').stepy({   /* invoke step tab form jQuery plugin */
              				backLabel: 'Previous',
              				block: true,
              				nextLabel: 'Next',
              				titleClick: true,
              				titleTarget: '.stepy-tab'
          					});
      					});
						
						hidePageLoader();  /* hide page loader */
				
				</script> 
 
<?php  
				
				
				}else{				
				
					echo $userNavPageError; exit;  /* else exit or redirect to 404 page */				
				
				}
exit;				
?>                