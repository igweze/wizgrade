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
	This script load staff access cpanel
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

      	require 'configwizGrade.php';  /* load wizGrade configuration files */	   
		 
		if ($_REQUEST['reg'] != '') {

				 
			try {
		 				
				$reg = strip_tags($_REQUEST['reg']);
				
				/* script validation */ 
				
				if($reg == ""){
					
					$msg_e =  "Oooooooooops, student  record  was not found.";
					
				}else{  /* select student profile */ 
 
					$sessionID = studentRegSessionID($conn, $reg);  /* student school session ID */
					$session_fi = wizGradeSession($conn, $sessionID);  /* school session */
							 
					$session_se = $session_fi + $foreal;  

					$ebele_mark = "SELECT r.ireg_id, nk_regno, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname, 
					i_accesspass, i_sponsor_p
									

									FROM $i_reg_tb r,  $i_student_tb s

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
							$spoAccess = $row['i_sponsor_p'];
							$stuAcesss = $row['i_accesspass']; 
						
						}	
 
						if (is_null($pic)){
				
							$studentPic = $wizGradeDefaultPic;

						}else{
				
							$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$pic;

						}

						if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }  /* check if picture exists */
						
						$msg_w = "*<img src = '$studentPic' height = '70' width = '90' 
						class= 'img-responsive img-circle pull-left' style='margin:0px 10px 0px 10px' id='wizGradeStudentPic' > 
						Do you really want to remove <strong>$lname $fname $mname</strong> information from school database. 
						Please Note that is an irreversible action. To continue, Please enter your password below"; 				
				        
$studentInfo =<<<IGWEZE

						<div id = 'wizGradePrintArea'>
							
							<!-- table -->
							<table width = '100%' border = '0' align = 'center' class="table table-striped table-advance table-hover">

							<tr>
							<th class = 'head' align = 'center' colspan = '3'><center> <i class="fa fa-user"></i>
							$lname $fname $mname Profile Information ($regNum) </center></th>
							</tr>
							<tr><td style="padding-left: 10px;" colspan = '3'><center>
							<img src = "$studentPic" height = '150' width = '150' 
							class= 'img-responsive img-circle' id='wizGradeStudentPic'> </center>
							</td></tr> 

							<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
							<i class="fa fa-lock"></i> Student Password </th> 
							<td style="padding-left: 30px; text-align:left; width: 55%;"> <div id="stuPassDiv"> $stuAcesss </div></td>
							<th style="padding-left: 5px; text-align:left; width: 15%;"> 
							<a href='javascript:;' id='$regNum' class ='resetStuPass demoDisenable'> <button class="btn btn-danger btn-xs">
							<i class="fa fa-refresh"></i> Reset</button> </ a>
							</th> </tr>
							<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
							<i class="fa fa-lock"></i> Parent Password </th> 
							<td style="padding-left: 30px; text-align:left; width: 55%;">
							<div id="spoPassDiv"> $spoAccess </div> </td> 
							<th style="padding-left: 5px; text-align:left; width: 15%;"> 
							<a href='javascript:;' id='$regNum' class ='resetSpoPass demoDisenable'> <button class="btn btn-danger btn-xs">
							<i class="fa fa-refresh"></i> Reset</button> </a>
							</th> </tr> 
							
							<tr><th style="padding-left: 30px; text-align:left; width: 30%;" colspan="2">
							<i class="fa fa-exclamation-triangle"></i> Deactivate/Remove Student </th> 
							
							<th  style="padding-left: 5px; text-align:left; width: 30%;"> 
							<a href="#removeStudentModal" data-toggle="modal" > <button class="btn btn-danger btn-xs">
							<i class="fa fa-times"></i> Remove</button> </a>
							</th> </tr>
						   
							</table>
							<!-- / table -->
							$sdo_tb_footerBio 
						
						</div>  
					
						<!-- student removal pop up modal start -->
						<div class="modal fade" id="removeStudentModal" tabindex="-1" role="dialog" 
						aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" 
								data-dismiss="modal" aria-hidden="true">
								<span style='color:#fff !important;'>&times;</span></button>
								<h4 class="modal-title"> Are sure you want to Remove Student ?
								</h4>
							</div>
							<div class="modal-body">

								<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="reSLoader"  
								style="cursor:pointer; display:none; margin-bottom:5px;" /></center>

								<div id="wizGradeRMsg"> </div>
								<div class="wizgrade-section-div">

								<section class="panel">

									<div class="panel-body">

									$warnMsg $msg_w $msgEnd

									<br clear= "all"/><br clear= "all"/><br clear= "all"/>

									<div class="form-group">

									<div class="col-lg-12">
										<div class="iconic-input"> <i class="fa fa-key"></i>
										<input type="password" class="form-control"
										name="adminPass" id="adminPass" placeholder ="Please enter Admin Authorisation Password" required />
										<div id="studentData" style="display:none;">$regNum</div>
										</div>
										</div>
									</div>

									</div>

								</section>

							</div>

							</div>
							<div class="modal-footer" id="reRegFooter">
								<button class="btn btn-danger demoDisenable" id="removeStudent" type="button">Yes</button>
								<button data-dismiss="modal" class="btn btn-danger" type="button">Cancel</button>
							</div>
							</div>
							</div>
						</div>
						<!-- student removal pop up modal end -->	 
		
IGWEZE;

						echo $studentInfo;
						echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	
				

					}else{  /* display error */ 
		
						$msg_e =  "Oooooooooops, student  record with <strong>$reg</strong> was not found.";
					
					}
				
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