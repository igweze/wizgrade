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
	This script show student profile  ID Card
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

      	require 'configwizGrade.php';  /* load wizGrade configuration files */	   

$sytleTbale =<<<IGWEZE

			<style type="text/css">
			
				.smallSzie {font-size:12px !important;} 

			</style>

IGWEZE;
			
		echo $sytleTbale;
			
		if($_REQUEST['modalData'] == true){
		
			$loadingStop = "<script type='text/javascript'>   $('#studentSLoading').fadeOut(3000); </script>";
		}	 
		 
		if ($_REQUEST['reg'] != '') { 
				 
		    try {		 				
				
				$reg = strip_tags($_REQUEST['reg']); 
				
				$reg = trim($reg);
				
				/* script validation */ 
				
				if($reg == ""){  /* display error */
					
					$msg_e =  "Oooooooops, student registration no. is empty";
					
				}else{  /* select profile */	

					$sessionID = studentRegSessionID($conn, $reg);  /* school session ID */
					$session_fi = wizGradeSession($conn, $sessionID);  /* school session */
							 
					$session_se = $session_fi + $foreal;  

					$ebele_mark = "SELECT r.ireg_id, nk_regno, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname, 
									i_gender, i_dob, i_country, i_state, i_lga, i_city, i_add_fi, i_add_se, i_stu_phone, 
									i_email, i_sponsor, i_spo_phone, i_spo_add, genotype, bloodgp, disability, hostel, route

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
							$e_status = $row['e_status'];
							$pic = $row['i_stupic'];
							$fname = $row['i_firstname'];
							$lname = $row['i_lastname'];
							$mname = $row['i_midname'];
							$gender = $row['i_gender'];
							$dob = $row['i_dob'];
							$country = $row['i_country'];
							$state = $row['i_state'];
							$lga = $row['i_lga'];
							$city = $row['i_city'];
							$add1 = $row['i_add_fi'];
							$add2 = $row['i_add_se'];
							$phone = $row['i_stu_phone'];
							$email = $row['i_email'];
							$spon = $row['i_sponsor'];
							$sphone = $row['i_spo_phone'];
							$adds = $row['i_spo_add'];
							$bloodGP = $row['bloodgp'];
							$genoTP = $row['genotype'];
							$disability = $row['disability'];
							$fiClass = $row['class_1'];
							$seClass = $row['class_2'];
							$thClass = $row['class_3'];
							$foClass = $row['class_4'];
							$fifClass = $row['class_5'];
							$sixClass = $row['class_6'];
							$hID = $row['hostel'];
							$rID = $row['route'];
						}	

						$genderM = $gender_list[$gender];
						$bloodGroup = $bloodgr_list[$bloodGP];
						$genoType = $genotype_list[$genoTP];		
						$genderM = substr($genderM, 0, 1);	
						
						if (is_null($pic)){
				
							$studentPic = $wizGradeDefaultPic;

						}else{
				
							$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$pic;


						}

						if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }  /* check if picture exists */
				
						$principalData = staffData($conn, $schoolHead);  /* school staffs/teachers information */
						list ($princ_title, $princ_fullname, $princ_sex, $princ_rankingVal, $princ_picture, 
							  $princ_lname, $princ_phone, $princ_sign) = explode ("#@s@#", $principalData);
							  
						$principalSign = $teachersSignExt.$princ_sign;

						if ((is_null($princ_sign)) || ($princ_sign == '') || (!file_exists($principalSign))){ $principalSign = ''; }					
						else{ $principalSign = '<img src="'.$principalSign.'" height="30px" width="100px" class="img-rounded"
						style="float:left;">'; } 	  

						$titleVal = $title_list[$princ_title];
						$schoolPrincipal = $titleVal.' '.$princ_fullname; 
						$schoolPrincipal = substr($schoolPrincipal, 0, 24);	
						$studentName = $lname.' '.$fname.' '.$mname;
						$studentName = substr($studentName, 0, 50);	
						
						$schoolNameTop = substr($schoolNameTop, 0, 25);	
						$schoolAddressTop = substr($schoolAddressTop, 0, 25);	
				        
$cardInfo =<<<IGWEZE
		
					
					<div class="row smallSzie">

						<div class="col-lg-6" id = "wizGradePrintArea">	
						
							<div  class="navbar-content" style="background-color:white;border-radius:10px; 
							border:1px solid #000; padding-left:18px !important;">
							
								<div class="row" class='col-lg-12'>								
									<div class="col-lg-2">
										<img alt="" src="$sch_logo" 
										height="30px" width="40px" style="float:left;" class="img-rounded"  />
										 <p class="text-center small wizGradeMenu"></p>		
										 
									</div>
									<div class="col-lg-10 text-center">
										
										<p class="text-primary" style="line-height: 10px;">
											<b>$schoolNameTop</b> </p>
										<p style="line-height: 10px;"><b>$schoolAddressTop</b></p>	
										<div class="divider"> </div>
									</div>
									
								</div>
								
								<div class="row">
								
									<div class="col-lg-4">
										<img alt="" src="$studentPic" height="100px" width="100px" class="img-rounded" style="
										float:left; margin-right:8px;" />
										 <p class="text-center small wizGradeMenu"></p>		
										 
									</div>
									<div class="col-lg-8 wizGradeMenu">
										
										<p style="line-height: 15px;"> <b>Name:</b> <u>$studentName</u> </p>
										<p style="line-height: 15px;"> <b>RegNo.:</b> <u>$regNum</u> </p>
										<p style="line-height: 15px;"> <b>Sex:</b> <u>$genderM</u> 
										&nbsp;&nbsp;&nbsp;&nbsp;<b>DOB:</b> <u>$dob</u> </p>
										<p style="line-height: 15px;"> <b>BG:</b> &nbsp;<u>$bloodGroup</u>
										&nbsp;&nbsp;&nbsp;&nbsp;<b>GT:</b>&nbsp;<u>$genoType</u> </p>
										
										
										<div class="divider"> </div>
									</div>
								</div>
								
								<div class="row">
								
									<div class="col-lg-4">
										$principalSign
										  
										 <p class="text-center small wizGradeMenu"></p>		
										 
									</div>
									<div class="col-lg-8 text-left">
										
										<p class="text-primary" style="line-height: 10px;">
											<u>$schoolPrincipal</u> </p>
										<p style="line-height: 10px;"><b>School Head</b></p>	
										<div class="divider"> </div>
									</div>
									
								</div>
							</div>
						
						</div>
						
					</div>
		
IGWEZE;
						

						echo "$cardInfo $loadingStop";
						echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	
						

					}else{  /* display error */
					
						$msg_e =  "Student record with <strong>$reg</strong> was not found.";
					} 
				
				}
					
			}catch(PDOException $e) {
				
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
			
		
		}else{ 
		
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
		} 
	
		if ($msg_e) {

         	  echo $errorMsg.$msg_e.$eEnd; echo $loadingStop; echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	 echo $scrollUp; exit; 			

        }
		
exit;
?>	