<?php

/*   
	Copyright (C) fobrain Tech LTD (2014 - 2024) - All Rights Reserved
	
	Licensed under the Apache License, Version 2.0 (the 'License');
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an 'AS IS' BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License	
	 
	#####################################################################################################
	fobrain (wizgrade open source) app is designed & developed by Igweze Ebele Mark for fobrain Tech LTD
	#####################################################################################################

	fobrain is Dedicated To Almighty God, My fabulous FAMILY and Amazing Parents.  
	
	WEBSITE 							PHONES/WHATSAPP					EMAILS
	https://www.fobrain.com				+234 - 80 30 716 751  			opensource@fobrain.com
										+234 - 80 22 000 490 	
	
	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Page/Code Explanation~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	This script reset student and parent password, remove student profile
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

      	require 'configwizGrade.php';  /* load wizGrade configuration files */	   
		 
		if ($_REQUEST['regStu'] != '') {  /* reset student password */

				 
			try {
		 				
				$regNum = strip_tags($_REQUEST['regStu']);

				$regID = studentRegID($conn, $regNum);   /* student record ID  */
				
				
				if($generatePass == $foreal){  /* check generate password status */

					$userPass = wizGradeRandomString($charset, 8);  /* generate password */

				}else{

					$userPass = "password";

				}

				$newPass = password_hash($userPass, PASSWORD_BCRYPT, $options_bcrypt);
				
				/* update information */
				
				$ebele_mark = "UPDATE $i_student_tb SET
							 
                						 		i_accesspass = :i_accesspass
												
                 								WHERE ireg_id = :ireg_id";
												
				$igweze_prep = $conn->prepare($ebele_mark);	
				$igweze_prep->bindValue(':i_accesspass', $newPass);
  				$igweze_prep->bindValue(':ireg_id', $regID); 
				
				if($igweze_prep->execute()){  /* if sucessfully */
					
					echo 'Student\'s New Password is <span class="bold-pass">'.$userPass.'</span>'; 
					echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	
					
				}else{  /* display error */
		
					$msg_e =  "Ooooooooops, an error has occur while reseting student Password. Please try again"; 
					
				}
				
			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
		
		}elseif ($_REQUEST['regSpo'] != '') {  /* reset parent password */

				 
			try {
		 				
				$regNum = strip_tags($_REQUEST['regSpo']);

				$regID = studentRegID($conn, $regNum);   /* student record ID  */
				
				if($generatePass == $foreal){  /* check generate password status */

					$userPass = wizGradeRandomString($charset, 8);  /* generate password */

				}else{

					$userPass = "password";

				}
				
				$newPass = password_hash($userPass, PASSWORD_BCRYPT, $options_bcrypt);

				/* update information */
				
				$ebele_mark = "UPDATE $i_student_tb SET
							 
                						 		i_sponsor_p = :i_sponsor_p
												
                 								WHERE ireg_id = :ireg_id";
												
				$igweze_prep = $conn->prepare($ebele_mark);	
				$igweze_prep->bindValue(':i_sponsor_p', $newPass);
  				$igweze_prep->bindValue(':ireg_id', $regID);  
				
				if($igweze_prep->execute()){  /* if sucessfully */
					
					echo 'Student\'s New Password is <span class="bold-pass">'.$userPass.'</span>'; 
					echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	
					
				}else{  /* display error */
		
					$msg_e =  "Ooooooooops, an error has occur while reseting student Password. Please try again";
					
				}
				
			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
		
		
		}elseif ($_REQUEST['removeReg'] != '') {  /* remove student profile */

				 
			try {
		 				
				$regNum = strip_tags($_REQUEST['removeReg']);
				$adminPass =   strip_tags($_REQUEST['adminPass']);
				$adminPass = strip_tags($adminPass);
				
				$regID = studentRegID($conn, $regNum);   /* student record ID  */								
				$checkDetail =  wizGradeAdminPassData($conn, $_SESSION['adminUser']);  /* school admin password details */
			 
			 	list ($adminID, $checkedPass, $adminName) =  explode ("@(.$*S*$.)@", $checkDetail);
				
				/* script validation */ 
				
				if (($regNum == "") || ($regID == "")) {
         			
					echo "<script type='text/javascript'>   $('#reSLoader').fadeOut(1500); </script>";

					$msg_e = "* Oooooooooops error, could not find this student Info";
					echo $errorMsg.$msg_e.$eEnd; exit;
					
	   			}elseif ($adminPass == "")   {
					
					echo "<script type='text/javascript'>   $('#reSLoader').fadeOut(1500); </script>";
					
					$msg_e = "* Oooooooooops error, please enter your admin authorization password to continue.";
					echo $errorMsg.$msg_e.$eEnd; exit;
					
				}elseif ($adminPass != $checkedPass)   {
					
					echo "<script type='text/javascript'>   $('#reSLoader').fadeOut(1500); </script>";
					
					$msg_e = "* Oooooooooops error, your admin authorization password is invalid.";
					echo $errorMsg.$msg_e.$eEnd; exit;
					
				}else {  /* update information */
				
					$ebele_mark = "UPDATE $i_reg_tb SET
								 
									active  = :active
													
									WHERE ireg_id = :ireg_id";
													
					$igweze_prep = $conn->prepare($ebele_mark);	
					$igweze_prep->bindValue(':active', $i_false);
					$igweze_prep->bindValue(':ireg_id', $regID);  
			
					if($igweze_prep->execute()){  /* if sucessfully */
						
						$msg_s = "Student with <strong>$regNum</strong> was successfully removed by you"; 
						echo $succesMsg.$msg_s.$sEnd;
						$studentRow = "#student-row-".$regID;
						echo "<script type='text/javascript'>  $('#reSLoader, #adminPass, #reRegFooter, $studentRow ').fadeOut(1500); </script>"; exit; 
						
					}else{  /* display error */
			
						$msg_e =  "Ooooooooops, an error has occur while to remove student record. Please try again";
						echo $errorMsg.$msg_e.$eEnd;
						echo "<script type='text/javascript'>  $('#reSLoader').fadeOut(1500); </script>"; exit; 
					}
						
				} 
				
			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
		
		
		}else{
		
		
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		
		} 
	
		
		if ($msg_s) {

			echo $succMsg.$msg_s.$msgEnd; 
			echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ </script>"; exit;
									
        }	


		if ($msg_e) {

			echo $erroMsg.$msg_e.$msgEnd; 
			echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ </script>"; exit;  
									
        }	
			
exit;
?>