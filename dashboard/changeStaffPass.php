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
	This script handle staff change password
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'configINwizGrade.php';  /* load wizGrade configuration files */
		
      	if($_REQUEST['staffPass'] = 'changePass') {	 

            $old_pass = strip_tags($_REQUEST['old_pass']);
			$new_pass = strip_tags($_REQUEST['new_pass']);
	        $confirm_new = strip_tags($_REQUEST['confirm_new']); 
	         
 			try {
				
			 	$checkDetail =  wizGradeStaffPassData($conn, $adminUser); /* school staffs/teachers password information */ 
			 
			 	list ($staffID, $staffUser, $check_old_pass, $staffName, $staffRank, $staffGra) = 
				explode ("@(.$*S*$.)@", $checkDetail);

				/* script validation */ 	
             
				if ($old_pass == '') {

					$msg_e = '* Please enter admin old password ';

				}elseif ($new_pass == '') {

					$msg_e = '* Please enter admin new password ';

				}elseif ((strlen($new_pass) <= 7) || (!ctype_alnum($new_pass))){

					$msg_e = '* Please new password should be more than 7 characters and numbers e.g wizGrade004';

				}elseif ($confirm_new == "") {

					$msg_e = '* Please confirm your new password ';

				}elseif ($confirm_new != $new_pass) {         

					$msg_e = "*Error, Your new  and  confirmation password dose not match. please try again  ";

				}elseif ($check_old_pass != $old_pass) {

					$msg_e = '* Error, Your Old password Is Incorrect, please try again ';


				} else {  /* update information */

						$fi_rand = wizGradeRandomString($charset, 16);
						$se_rand = wizGradeRandomString($charset, 16);
								
						$newPass =  encrypter($new_pass, $fi_rand);  /* encrypt password */

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

						if ($igweze_prep->execute()) {  /* if sucessfully */ 
												 
							$msg_s = "<span class='bold-pass'>$staffName</span>, your password was sucessfully change. 
							Please always remember keep your password secret only to yourself. Thanks";
							 
							 
						}else{  /* display error */
							 
							$msg_e = "<span class='bold-pass'>$staffName</span>, your password was not change, please try again";
							 
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
			echo "<script type='text/javascript'>   $('.wizgrade-section-div').slideUp(300); hidePageLoader();  /* hide page loader */ </script>";
			echo $scrollUp; exit; 				
									
        }	


		if ($msg_e) {

			echo $errorMsg.$msg_e.$eEnd; 
			echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ </script>";
			echo $scrollUp; exit; 	 
									
        }	
			
exit;		
?>
