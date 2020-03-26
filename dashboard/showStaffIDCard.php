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
	This page load staff profile ID Card
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */  

if(!session_id()){
    session_start();
}


		define('wizGrade', 'igweze');  /* define a check for wrong access of file */			

		require 'configwizGrade.php';  /* load wizGrade configuration files */	 
			
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 

$sytleTbale =<<<IGWEZE

			<style type="text/css">
			
				.smallSzie {font-size:12px !important;} 

			</style>

IGWEZE;
			
		echo $sytleTbale;		

		if ($_REQUEST['teacherID'] != '') { 
				 
		    try {		 				
				
				$teacherID = strip_tags($_REQUEST['teacherID']); 
				
				$teacherID = trim($teacherID);
				
				/* script validation */ 
				
				if($teacherID == ""){  /* display error */
					
					$msg_e =  "Oooooooops, staff registration no. is empty";
					
				}else{  /* select profile */	
				
					$teacherID = strip_tags($_REQUEST['teacherID']);
		 
					/* select staff profile */ 	
					$ebele_mark = "SELECT t_id, i_title, i_picture, i_sign, i_firstname, i_lastname, i_midname, i_gender, i_dob, 
									i_country, i_state, i_lga, i_city, i_add_fi, i_add_se, i_phone, i_email, i_sponsor, 
									i_spo_phone, i_spo_add,
									genotype, bloodgp, rank

									 FROM $staffTB

									 WHERE t_id = :t_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':t_id', $teacherID);				 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {  /* check array is empty */

						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
		   
							$t_id = $row['t_id'];
							$pic = $row['i_picture'];
							$signPic = $row['i_sign'];
							$title = $row['i_title'];
							$fname = $row['i_firstname'];
							$lname = $row['i_lastname'];
							$mname = $row['i_midname'];
							$sex = $row['i_gender'];
							$dob = $row['i_dob'];
							$country = $row['i_country']; 
							$state = $row['i_state'];
							$lga = $row['i_lga'];
							$city = $row['i_city'];
							$add1 = $row['i_add_fi'];
							$add2 = $row['i_add_se'];
							$phone = $row['i_phone'];
							$email = $row['i_email'];
							$sponsor = $row['i_sponsor'];
							$sponsorP = $row['i_spo_phone'];
							$sponsorA = $row['i_spo_add'];
							$bloodGP = $row['bloodgp'];
							$genoTP = $row['genotype'];
							$ranking = $row['rank'];
						
						}	

						$staffPic = $staffPicExt.$pic;

						if ((is_null($pic)) || !file_exists($staffPic)){ $staffPic = $wizGradeDefaultPic; }

						$genderM = $gender_list[$sex];
						$genderM = substr($genderM, 0, 1);	
						$bloodGroup = $bloodgr_list[$bloodGP];
						$genoType = $genotype_list[$genoTP];
						 
						$titleVa = $title_list[$title];
										
						$principalData = staffData($conn, $schoolHead);  /* school staffs/teachers information */
						list ($princ_title, $princ_fullname, $princ_sex, $princ_rankingVal, $princ_picture, 
							  $princ_lname, $princ_phone, $princ_sign) = explode ("#@s@#", $principalData);

						if ((is_null($princ_sign)) || ($princ_sign == '') || (!file_exists($principalSign))){ $principalSign = ''; }					
						else{ $principalSign = '<img src="'.$principalSign.'" height="30px" width="100px" class="img-rounded"
						style="float:left;">'; } 	  

						$titleVal = $title_list[$princ_title];
						$schoolPrincipal = $titleVal.' '.$princ_fullname; 
						$schoolPrincipal = substr($schoolPrincipal, 0, 24);	
						$staffName = $titleVa.' '.$lname.' '.$fname.' '.$mname;
						$staffName = substr($staffName, 0, 50);	
						
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
										<img alt="" src="$staffPic" height="90px" width="100px" class="img-rounded" style="
										float:left; margin-right:8px;" />
										 <p class="text-center small wizGradeMenu"></p>		
										 
									</div>
									<div class="col-lg-8 wizGradeMenu">
										
										<p style="line-height: 15px;"> <b>Name:</b> <u>$staffName</u> </p>
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
						

						echo $cardInfo;

							echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";
				

				}else{  /* display error */ 
				
					$msg_e =  "Ooooooooops, Staff record with was not found.";
					echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; 
					
				}
			
				}
				
			}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}

		}else{ 
		
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
		} 			
		
		if ($msg_e) {

			echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; 
			echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>"; exit;  

		}
			
exit;			
?>	