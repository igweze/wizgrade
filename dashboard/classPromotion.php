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
	This script handle class promotion
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

            define('wizGrade', 'igweze');  /* define a check for wrong access of file */
						
			require 'configwizGrade.php';  /* load wizGrade configuration files */	   
			
			if (($_REQUEST['classData']) == 'effectPromotion') {

				$regIDArr = $_REQUEST['regID'];
				$level = $_REQUEST['level'];
				$regNoArr = $_REQUEST['regNo'];
				$promotionClassArr = $_REQUEST['promotionArr'];
				$studentNameArr = $_REQUEST['studentName'];
				
				/* script validation */ 
				
				if($level == ""){
					
					$msg_e = "Ooooooops  Error, please select class level";
					echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */</script>";
					echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 		
					
				}else{  /* update information */ 	
					
						$term = $th_term; $promotionStatus = false;	$subfCounter = 0;	
				
						require  $wizGradeClassConfigDir;  /* require class configuration */
				
						foreach ($regIDArr as $id => $val) {  /* loop array */
							
							$classPromArray [$id] = array(
								'regID'  => $regIDArr[$id],
								'regNo'  => $regNoArr[$id],
								'Name'  => $studentNameArr[$id],
								'promotionID' => $promotionClassArr[$id]
							); 
							
							$regID  = $regIDArr[$id];
							$regNo  = $regNoArr[$id];
							$promotionID = $promotionClassArr[$id];
							$studentName = $studentNameArr[$id]; 
						

							try { 

								$ebele_mark = "UPDATE $sdoracle_grand_score_nk
								
													SET 
												
												certify = :certify

												WHERE ireg_id = :ireg_id";
						 
								$igweze_prep = $conn->prepare($ebele_mark);
								$igweze_prep->bindValue(':certify', $promotionID);
								$igweze_prep->bindValue(':ireg_id', $regID);
			
								if ($igweze_prep->execute()) {  /* if sucessfully */

									$promVerb = $promotionArr[$promotionID];
									$msg_s = "<strong>$studentName</strong> was successfully <strong>$promVerb<strong>.";
									echo $succesMsg2.$msg_s.$sEnd2; echo $scrollUp; //exit; 					
							
								}else {  /* display error */ 

									$msg_e = "Ooooooops, an Error occured while tring to effect class promotion.  
									Please try again";
									echo $errorMsg2.$msg_e.$eEnd2; echo $scrollUp;// exit; 		

								} 

							}catch(PDOException $e) {
					
								wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
							}

							
							$regID  = "";
							$regNo  = "";
							$promotionID = "";
							
						}
				}
				
				echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ $('#promotionDiv').slideUp(2000); </script>";
				
				
			}else{ 
			
					echo $userNavPageError; 
		
			} 
			
exit;
?>