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
	This script reset staff password, remove staff and change staff username
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

      	require 'configINwizGrade.php';  /* load wizGrade configuration files */
		 
		if ($_REQUEST['reStaff'] != '') {  /* reset staff password */

				 
			try {
		 				
				$staffID = $_REQUEST['reStaff'];

                mt_srand((double)microtime() * 1000000);


				if($generatePass == $foreal){  /* check generate password status */

					$userPass = wizGradeRandomString($charset, 8);  /* generate password */

				}else{

					$userPass = "password";

				}

				$fi_rand = wizGradeRandomString($charset, 16);  /* generate password */
				$se_rand = wizGradeRandomString($charset, 16);  /* generate password */ 
			 	 
				$newPass = password_hash($userPass, PASSWORD_BCRYPT, $options_bcrypt);
				
				/* update information */ 
				  
				$ebele_mark = "UPDATE $staffTB SET
							 
                						 		i_accesspass = :i_accesspass,
												i_salted = :i_salted,
												i_sponsor_ac = :i_sponsor_ac
												
                 								WHERE t_id = :t_id";
												
				$igweze_prep = $conn->prepare($ebele_mark);	
				$igweze_prep->bindValue(':i_accesspass', $newPass);
				$igweze_prep->bindValue(':i_salted', $se_rand);
				$igweze_prep->bindValue(':i_sponsor_ac', $fi_rand);
				$igweze_prep->bindValue(':t_id', $staffID); 
				
				if($igweze_prep->execute()){  /* if sucessfully */
					
					echo 'Staff\'s new pass is <span class="bold-pass">'.$userPass.'</span>'; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";
					
				}else{  /* display error */ 
		
					$msg_e =  "Ooooooooops, an error has occur while reseting staff's Password. Please try again";
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";
					echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 
				}
				
			}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			} 
		
		}elseif ($_REQUEST['removeReg'] != '') {  /* remove staff profile */

				 
			try {
		 				
				$staffID = strip_tags($_REQUEST['removeReg']);
				$adminPass =   $_REQUEST['adminPass'];
				$adminPass = strip_tags($adminPass);
				
										
				$checkDetail =  wizGradeAdminPassData($conn, $_SESSION['adminUser']);  /* school admin password details */
			 
			 	list ($adminID, $checkedPass, $adminName) =  explode ("@(.$*S*$.)@", $checkDetail);
				
				/* script validation */
				
				if ($staffID == "") {
         			
					echo "<script type='text/javascript'>   $('#reSLoader').fadeOut(1500); </script>";
					$msg_e = "* Oooooooooops error, could not find this staff Info";
					echo $errorMsg.$msg_e.$eEnd;exit; 
					
	   			}elseif ($adminPass == "")   {
					
					echo "<script type='text/javascript'>   $('#reSLoader').fadeOut(1500); </script>";					
					$msg_e = "* Oooooooooops error, please enter your admin authorization password to continue.";
					echo $errorMsg.$msg_e.$eEnd;exit; 
					
				}elseif ($adminPass != $checkedPass)   {
					
					echo "<script type='text/javascript'>   $('#reSLoader').fadeOut(1500); </script>";					
					$msg_e = "* Oooooooooops error, your admin authorization password is invalid.";
					echo $errorMsg.$msg_e.$eEnd;exit; 
					
				}else {  /* update information */ 
				
						$ebele_mark = "UPDATE $staffTB SET
							 
                						 		status = :status
												
                 								WHERE t_id = :t_id";
												
						$igweze_prep = $conn->prepare($ebele_mark);	
						$igweze_prep->bindValue(':status', $i_false);
						$igweze_prep->bindValue(':t_id', $staffID);						
						
						if($igweze_prep->execute()){  /* if sucessfully */ 
							
							$msg_s = "Staff record was successfully removed by you"; 
							echo $succesMsg.$msg_s.$sEnd ;							
							$staffRow = "#staff-row-".$staffID;
							
							echo "<script type='text/javascript'>  $('#reSLoader, .staffSectionDiv,  #reRegFooter, $staffRow ').fadeOut(1500); </script>";exit; 
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to remove Staff record. Please try again";
							echo $errorMsg.$msg_e.$eEnd;
							echo "<script type='text/javascript'>  $('#reSLoader').fadeOut(1500); </script>";exit; 
						}
						
				}
				
			}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			} 
		
		}elseif ($_REQUEST['resetData'] == 'changeStaff') {  /* change staff username */

			try {
		 				
				$staffID = strip_tags($_REQUEST['staffID']);
				$staffUser =   $_REQUEST['staffUser'];
				$staffUser = strip_tags($staffUser);
				$staffUser = trim($staffUser);
				
				/* script validation */
				
				if ($staffID == "") {
         								
					$msg_e = "* Oooooooooops error, could not find this staff Info";
					echo $errorMsg.$msg_e.$eEnd;
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>"; exit;
					
	   			}elseif ($staffUser == "")   {
					
					$msg_e = "* Oooooooooops error, please enter new staff username.";
					echo $errorMsg.$msg_e.$eEnd;
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>"; exit;
					
				}elseif ((strlen($staffUser) <= 7) || (!ctype_alnum($staffUser))){
					
					$msg_e = "* Oooooooooops error, please new user name should be more than 7 characters and numbers e.g igweze4019";
					echo $errorMsg.$msg_e.$eEnd;
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>"; exit;

				}elseif (staffUserExits($conn, $staffUser) >= $fiVal)   {  /* check if school staffs/teachers exits */ 
					
					$msg_e = "* Oooooooooops error, username already exist. Please enter new one.";
					echo $errorMsg.$msg_e.$eEnd;
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>"; exit;
					
				}else {  /* update information */ 
				
						$ebele_mark = "UPDATE $staffTB SET
							 
                						 			staff_id = :staff_id
												
                 								WHERE t_id = :t_id";
												
						$igweze_prep = $conn->prepare($ebele_mark);	
						$igweze_prep->bindValue(':staff_id', $staffUser);
						$igweze_prep->bindValue(':t_id', $staffID);					
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "Staff User Name <b>$staffUser</b> was successfully updated"; 
							echo $succesMsg.$msg_s.$sEnd;														
							echo "<script type='text/javascript'>  $('#staffUserTR').fadeOut(1500);
								hidePageLoader();  /* hide page loader */ </script>";exit; 
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to update Staff user name. Please try again";
							echo $errorMsg.$msg_e.$eEnd;
							echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */</script>";exit; 
							
						}
						
				}
				
			}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			} 
		
		}else{ 
		
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */		
		
		} 
		
exit;		
?>