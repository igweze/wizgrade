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
	This script handle change password
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */
		
      	if($_REQUEST['studentPass'] = 'changePass') {	 

            $old_pass = strip_tags($_REQUEST['old_pass']);
			$new_pass = strip_tags($_REQUEST['new_pass']);
	        $confirm_new = strip_tags($_REQUEST['confirm_new']);
			
			/* script validation */ 
	         
 			try { 

			 	$studentParentPass =  studentParentPassword($conn, $regNum);
			 
			 	list ($studentPass, $parentPass) =  explode ("{<?..?>}", $studentParentPass); 
             
				if ($old_pass == '') {

					$msg_e = '* Please enter your old password ';

				}elseif ($new_pass == '') {

					$msg_e = '* Please enter your new password ';

				}elseif ((strlen($new_pass) <= 7) || (!ctype_alnum($new_pass))){

					$msg_e = '* Please new password should be more than 7 characters and numbers e.g wizGrade004';

				}elseif ($confirm_new == "") {

					$msg_e = '* Please confirm your new password ';

				}elseif ($confirm_new != $new_pass) {         

					$msg_e = "*Error, Your new  and  confirmation password dose not match. please try again  ";

				}elseif ($studentPass != $old_pass) {

					$msg_e = '* Error, Your Old password Is Incorrect, please try again ';


				} else {  /* update information */  
						 

					$ebele_mark = "UPDATE $i_student_tb SET
								 
								accesspass = :accesspass 
													
								WHERE ireg_id = :ireg_id";
													
					$igweze_prep = $conn->prepare($ebele_mark);	
					$igweze_prep->bindValue(':accesspass', $new_pass); 
					$igweze_prep->bindValue(':ireg_id', $regID);

					if ($igweze_prep->execute()) {  /* if sucessfully */ 
											 
						$msg_s = "Your password was sucessfully change. 
						Please always remember keep your password secret only to yourself. Thanks";
						echo "<script type='text/javascript'>   $('.wizgrade-section-div').slideUp(300); hidePageLoader();  /* hide page loader */ </script>";
						 
						 
					}else{  /* display error */ 
						 
						$msg_e = "Oooooooops, your password was not change, please try again";
						 
					}

				}

			}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}	 

		}else{
			
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
		}
 
			
		if ($msg_s) {

			echo $succesMsg.$msg_s.$sEnd ; 
			echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */ </script>";	exit; 				
									
        }	


		if ($msg_e) {

			echo $errorMsg.$msg_e.$eEnd; 
			echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */ </script>";				
			exit; 	 
									
        }	
			
exit;
?>