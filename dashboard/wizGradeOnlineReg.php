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
	This script load student online registration
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

      	require 'configINwizGrade.php';  /* load wizGrade configuration files */
		 
		if ($_REQUEST['reg'] != '') {

			/* script validation */ 
			
			try {
		 				
				$reg = $_REQUEST['reg'];
				

				$ebele_mark = "SELECT stu_id, i_stupic, i_school, i_level, i_firstname, i_midname, i_lastname, i_gender, i_dob, 
								i_country, i_state, i_city, i_add_fi, i_add_se, i_stu_phone, i_email, i_sponsor, i_spo_add, bloodgp, genotype, 
								i_spon_occup, i_spo_phone

                     			FROM $studentOnlineRegTB

                     			WHERE stu_id = :stu_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':stu_id', $reg);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {  /* check array is empty */
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */	
					
						$stu_id = $row['stu_id'];
						$school = $row['i_school'];
						$level = $row['i_level'];
						$pic = $row['i_stupic'];
						$fname = $row['i_firstname'];
						$lname = $row['i_lastname'];
						$mname = $row['i_midname'];
						$gender = $row['i_gender'];
						$date = $row['i_dob'];
						$country = $row['i_country'];
						$state = $row['i_state'];
						$lga = $row['i_lga'];
						$city = $row['i_city'];
						$add1 = $row['i_add_fi'];
						$add2 = $row['i_add_se'];
						$phone = $row['i_stu_phone'];
						$email = $row['i_email'];
						$spon = $row['i_sponsor'];
						$soccup = $row['i_spon_occup'];
						$sphone = $row['i_spo_phone'];
						$adds = $row['i_spo_add'];
						$bloodGP = $row['bloodgp'];
						$genoTP = $row['genotype'];

					}	

							
					if($school == $fiVal){  /* check school is nursery */
					 
						$level_list = $nursery_list;

					}elseif($school == $seVal){  /* check school is primary */
					 
						$level_list = $primary_list;

					}elseif($school == $thVal){  /* check school is secondary */
					 
						$level_list = $secondary_list;

					}else{

						$level_list = '';
					 
					}

					foreach($level_list as $levels => $levelVal){  /* loop array */
						
						if ($levels == $level){
							$selected = "SELECTED";
						} else {
							$selected = "";
						}

						$levelRegVal .= '<option value="'.$school.'-'.$levels.'"'.$selected.'>'.$levelVal.'</option>' ."\r\n";

					} 

					$genderM = $gender_list[$gender];
					$bloodGroup = $bloodgr_list[$bloodGP];
					$genoType = $genotype_list[$genoTP];
					$school = $school_list[$school];
					$level = $level_list[$level];



					if (is_null($pic)){

						$studentPic = $wizGradeDefaultPic;

					}else{

						$studentPic = $applyPSrc.$pic;


					}

					if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }  /* check if picture exits */

					$levelReg .= '
					 
						  <div class="col-lg-6 pull-rights">
							<div class="iconic-input">
							  <i class="fa fa-level-down"></i>
							  
							  <select class="form-control"  id="levelReg" name="levelReg" >
							  
								<option value = "">Select  Level  </option>'.$levelRegVal;
					$levelReg .= '</select>
						  </div>
								</div>';


								

$table =<<<IGWEZE

					<center><img src="loading.gif" alt="Loading Page >>>>> . . . Please wait" class="registration-loader" 
					 style="cursor:pointer; display:none;  margin-bottom:8px;" /> </center><!-- loading image -->
					
					<div id ='msgBoxDiv'> </div>
					
					<div id = 'wizGradePrintArea' class='newRegDiv'>
					
						<div class='pull-right' style='margin-bottom:15px;'>
						<a href='javascript:;' id='$stu_id' class ='admitNewReg'><button class="btn btn-danger btn-ls">
							<i class="fa fa-save"></i> Admit Student</button></a> 
						
						<a href='javascript:;' id='$stu_id' class ='removeNewReg' style="cursor:pointer; display:none;">
						<button class="btn btn-danger btn-ls">
							<i class="fa fa-times"></i> Discard Student</button></a> 
						
						<a href="#removeStu-modal" data-toggle="modal" class="btn btn-danger btn-ls">
												<i class="fa fa-times"></i> Discard Student 
						
						 </a>

						</div>
						<br clear='all' />


						<!-- remove student registration modal start -->
						<div class="modal fade" id="removeStu-modal" tabindex="-1" role="dialog" aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" 
								data-dismiss="modal" aria-hidden="true">
								<span style='color:#fff !important;'>&times;</span></button>
								<h4 class="modal-title"> Are sure you want to remove this student information ?
								</h4>
							</div>
							<div class="modal-body">
							<div id="filterSettingsMsg"> </div>
							<div class="wizgrade-section-div">

								<section class="panel">

									<div class="panel-body">
									<img src = "$studentPic" height = '100'	width = '100' id='wizGradeStudentPic' class='pull-left'> 
									<span style='color:#000;font-weight:bold;' class='pull-left'>
									$lname  $fname $mname</span> 
									</div>

								</section>

							</div>

							</div>
							<div class="modal-footer">
								<button data-dismiss="modal" class="btn btn-danger" id="mregRemoveBtn" 
								type="button">Yes</button>
								<button data-dismiss="modal" class="btn btn-danger" 
								type="button">Cancel</button>
								</div>
							</div>
							</div>
						</div>
						<!-- remove student registration modal end --> 

						<!-- table -->
						<table width = '100%' border = '0' align = 'center' class="digit-table table table-striped table-advance table-hover">

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-level-up"></i> Choose Class to Enroll
						<br />	<br />
						<i class="fa fa-user"></i> New Student Reg Num</td>
						<td style="padding-left: 30px; text-align:left; width: 60%;;"> 
						$levelReg 
						
						<span id="wait_1" style="display: none;">
								<center><img alt="Please Wait" src="loading.gif"/></center><!-- loading image -->
							</span>
						<span id="result_1" style="display: none;"></span><!-- loading div -->						
						
						</td></tr>
						<tr>
						<th class = 'head' align = 'center' colspan = '2'><center> <i class="fa fa-user"></i>
						$lname $fname $mname Profile Information  </center></th>
						</tr>
						<tr><td style="padding-left: 10px;" colspan = '2'><center><img src = "$studentPic" height = '100'
						width = '100' id='wizGradeStudentPic'> </center>
						</td></tr> 

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-book"></i> School To Enroll </td> <td style="padding-left: 30px; text-align:left; width: 60%;;"> 
						 $school </td></tr>
						
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-level-up"></i> Class To Enroll </td> <td style="padding-left: 30px; text-align:left; width: 60%;;"> 
						$level</td></tr> 
						
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-user"></i> Name </td> <td style="padding-left: 30px; text-align:left; width: 60%;;">$lname 
						$fname $mname </td> </tr>
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-user"></i> Gender </td> <td style="padding-left: 30px; text-align:left; width: 60%;;">$genderM
						</td> </tr>
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-calendar"></i> Date Of Birth</td> <td style="padding-left: 30px; text-align:left; width: 60%;;">
						$date</td> </tr>
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-flag"></i> Nationality </td> <td style="padding-left: 30px; text-align:left; width: 60%;;">
						$country</td> </tr>
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-home"></i> State/Province </td> <td style="padding-left: 30px; text-align:left; width: 60%;;">
						$state</td> </tr>
						<!--
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-home"></i> LGA</td> <td style="padding-left: 30px; text-align:left; width: 60%;;">$lga</td> </tr>
						-->
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-home"></i> City </td> <td style="padding-left: 30px; text-align:left; width: 60%;;">$city</td> </tr>
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-home"></i> Address </td> <td style="padding-left: 30px; text-align:left; width: 60%;;">
						$add1</td> </tr>
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-home"></i> Address 2 </td> <td style="padding-left: 30px; text-align:left; width: 60%;;">
						$add2</td> </tr>
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-phone"></i> Phone Number </td> <td style="padding-left: 30px; text-align:left; width: 60%;;">
						$phone</td> </tr>
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-envelope"></i> Email</td> <td style="padding-left: 30px; text-align:left; width: 60%;;">
						$email</td> </tr>
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-user"></i> Sponsor Name</td> <td style="padding-left: 30px; text-align:left; width: 60%;;">
						$spon</td> </tr>
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-briefcase"></i> Sponsor Occupation</td> <td style="padding-left: 30px; text-align:left; width: 60%;;">
						$soccup</td> </tr>				
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-home"></i> Sponsor Address</td> <td style="padding-left: 30px; text-align:left; width: 60%;;">
						$adds</td> </tr>
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-phone"></i> Sponsor Phone</td> <td style="padding-left: 30px; text-align:left; width: 60%;;">
						$sphone</td> </tr>
						
						<tr>
						<th class = 'head' align = 'center' colspan = '2'><center> <i class="fa fa-medkit"></i>
						$lname Medical Information  </center></th>
						</tr>

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-medkit"></i> Blood Group</td> <td style="padding-left: 30px; text-align:left; width: 60%;;">
						$bloodGroup</td> </tr>

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-medkit"></i> Genotype</td> <td style="padding-left: 30px; text-align:left; width: 60%;;">
						$genoType</td> </tr> 	
					   
						</table>
						<!-- / table -->
						$sdo_tb_footerBio
					
				</div>
		
IGWEZE;

					echo "<div align='center'> $table </div>";
				
					echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */ $('#levelReg').trigger('change');</script>";
				
				

				}else{  /* display error */
				
					$msg_e =  "Ooooooops error , could not find Student's record information.";
							
				}
				
			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
		
		}else{		
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */		
		
		}
		
		
	
		if ($msg_e) {

         	  echo $errorMsg.$msg_e.$eEnd; echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	 echo $scrollUp; exit; 			
			

        }
		
exit;		
?>