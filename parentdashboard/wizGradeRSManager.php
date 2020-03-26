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
	This script handle student result
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 

if(!session_id()){
    session_start();
}

		define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	 

 		if ($_REQUEST['rsData'] == 'viewRs') {  /* view result */ 
			
			/* script validation */ 
			
            if (($_REQUEST['level'] != '')  || ($_REQUEST['term'] != '')){ 

        		$level = strip_tags($_REQUEST['level']);
				$term = strip_tags($_REQUEST['term']);
				$rsType = strip_tags($_REQUEST['rsType']);

				try {
					
					echo "<div id='wizGradePrintArea'>";
					
					if($rsType == ""){
						$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
						$exam_status = $examArray[0]['status'];	
						$rsType = $examArray[0]['rsType'];	
					}
							 
					$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */
					$session_fi = wizGradeSession($conn, $sessionID);  /* school session */	 
		 
		 			$session_se = $session_fi + $foreal;  
					$class = studentClass($conn, $regNum, $level);  /* retrieve a student class*/
					
					if($class == ''){  /* check if student class is empty */

						$msg_e = "Ooooooops sorry, this student result has not be yet published by school authority.";						
						echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp;
						echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	exit; 	 

					} 

					$rsStatus = wizGradeResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */  

					if ($term == 'all'){  /* if annual result */
						
						
						$term = $fi_term; $promotionStatus = false;	$subfCounter = 0;
						
						if(($ewalletCheck == $fiVal) || ($ewalletCheck == $seVal)){  /* check if e-wallet is enable by school */
				
							$term = $th_term; $promotionStatus = true;
							
							$cardRecharge = eWalletCheckRecharge($conn, $regNum, $regID, $level, $term, $ewalletCheck);  /* validate card pin e - wallet information */
							
							if ($cardRecharge == ''){  /* if return e-wallet is null */
								
								$msg_e = "* Oooooops Error, you have not recharge for this level. Please recharge for this level
								using E-wallet to enable you view your result. Thanks";
								echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
								echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader * /	</script>";exit; 	
								exit;	
							}					
						
						}
						
						require  $wizGradeClassConfigDir;   /* include class configuration script */ 
						
						require ($wizGradeSessionRSDir);   /* include annual result script */ 

					}else{  /* if  termly result */

						$cardRecharge = eWalletCheckRecharge($conn, $regNum, $regID, $level, $term, $ewalletCheck);  /* validate card pin e - wallet information */

						if  ($rsStatus != $rspublishStage){	 /* check result status */		
							
							$msg_e = "Ooooooops sorry, this student result has not be yet published by school authority.";						
							echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
							echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";exit; 	

						}
						
						if(($ewalletCheck == $fiVal) || ($ewalletCheck == $seVal)){  /* check if e-wallet is enable by school */
						
							if ($cardRecharge == ''){  /* if return e-wallet is null */
								
								$msg_e = "* Oooooops Error, you have not recharge for this level. Please recharge for this level
								using E-wallet to enable you view your result. Thanks";
								echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
								echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader * /	</script>";exit; 	
									
							}
						
						} 

						require  $wizGradeClassConfigDir;   /* include class configuration script */	
						
						if($rsType == $seVal){   /* check result type */
							
							require_once $wizGradeStudentComRSDir;   /* include comment result */ 
							
						}else{	
						
							require_once $wizGradeStudentSubRSDir;   /* include computational result */
							
						}					
						
					}	 
			
					echo "</div>";
			
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
	
				echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";
			
			}else {  /* display error */ 

        			$msg_e =  $formErrorMsg;
 
        	}	
			

        }elseif ($_REQUEST['rsData'] == 'bestStudentRS') {  /* view best student result */ 
			
			/* script validation */ 
			
            if (($_REQUEST['level'] != '')  || ($_REQUEST['term'] != '') || ($_REQUEST['sr-class'] != '') ){

        		$level = strip_tags($_REQUEST['level']);
				$term = strip_tags($_REQUEST['term']);
				$rsClass = strip_tags($_REQUEST['sr-class']);

				try {
					 
					$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */
					$session_fi = wizGradeSession($conn, $sessionID);  /* school session */	
					
		 			$session_se = $session_fi + $foreal;  
					$class = studentClass($conn, $regNum, $level);  /* retrieve a student class */ 
					
					if($class == ''){  /* check if student class is empty */

						$msg_e = "Ooooooops sorry, this student result has not be yet published by school authority.";						
						echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; exit; 	 

					} 

					if ($term != 'all'){  /* if  termly result */ 

						if($rsClass == $fiVal){  /* check best student in a class */ 
							
							$rsStatus = wizGradeResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */ 
							
							if  ($rsStatus != $rspublishStage){	 /* check result status */		
								
								$msg_e = "Ooooooops sorry, this student result has not be yet published by school authority.";
								
								echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
								echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>"; exit; 	

							}

							require  $wizGradeClassConfigDir;   /* include class configuration script */	    			

							$strArray = explode(",", $query_i_strings_nj);
							$fieldPosi = $strArray[2];
							
							$regNumArr = classBestStudentReg($conn, $sdoracle_grand_score_nk, $fieldPosi, $sessionID, $class, 
															 $nk_class);  /* retrieve class best student information */
							
							if(is_array($regNumArr)){  /* check if array */
								
								$countReg = count($regNumArr);
								
								if($countReg > $fiVal){  /* check student count */
									
									$msg_ii = "Woooo fabulous and amazing, $countReg students emerge best and their results 
									summary are below."; 
								
								}else{
									
									$msg_ii = "Amazing, only one student emerge best and summary of the result is below.";
									
								}
							
								echo $infoMsg.$msg_ii.$iEnd;
								
								foreach($regNumArr as $regNumKey => $regNum){  /* loop array */
																
									require ($wizGradeClassBestRSDir);  /* include class best student result script */  echo '<hr />';
									$regNum = ""; $regNumKey = "";
									
								}
							
							}

						
						}elseif($rsClass == $seVal){  /* check best student in all class */
							
							require  $wizGradeClassConfigDir;   /* include class configuration script */		    			

							$strArray = explode(",", $query_i_strings_nj);
							$fieldPosi = $strArray[2];
							$fieldAvg = $strArray[1];
							
							$regNumArr = classSessionBeststudentReg($conn, $sdoracle_grand_score_nk, $sessionID, $fieldPosi, 
																	$fieldAvg);  /* retrieve class best student information */

							if(is_array($regNumArr)){  /* check if array */

								$countReg = count($regNumArr);
								
								if($countReg > $fiVal){  /* check student count */
									
									$msg_ii = "Woooo fabulous and amazing, $countReg students emerge best in their classes
									and their results summary are below.";
								
								
								}else{
									
									$msg_ii = "Amazing, only one student emerge best and summary of the result is below.";
									
								}
							
								echo $infMsg.$msg_ii.$msgEnd;

								foreach($regNumArr as $regNumKey => $regNum){  /* loop array */
									
									$class = studentClass($conn, $regNum, $level);							
									require ($wizGradeClassBestRSDir);  /* include class best student result script */   echo '<hr />';
									$regNum = ""; $regNumKey = "";

								}
							
							}else{  /* display error */ 
								
								$msg_e = "Ooooooops sorry, session student result has not be yet published by school authority.";							
								echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
								echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>"; exit; 
								
							}

						
						}else{  /* display error */ 
							
								$msg_e = "Ooooooops sorry, session student result has not be yet published by school authority.";							
								echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
								echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>"; exit; 

						}	
						
						
					}else{  /* display error */ 
						
							$msg_e = "Ooooooops sorry, you cannot select student annual result.";							
							echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
							echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>"; exit; 

					}	
			
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
	
				echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";

			
			}else {  /* display error */ 

        			$msg_e =  $formErrorMsg;
 
        	}	
			

        }else{
			
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
		} 
 
         
		if ($msg_s) {

			echo $succesMsg.$msg_s.$sEnd ; echo $scrollUp; exit; 				
								
		}	


		if ($msg_e) {

			echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; exit; 			
								
		}	
			
exit;	 
?>