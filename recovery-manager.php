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
	This script handle admin password recovery
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

session_start();
session_unset();
session_destroy();
session_start();

		define('wizGrade', 'igweze');  /* define a check for wrong access of file */ 
		
		setcookie('googtrans', '');
		
		require_once 'sources/functions/configDirIn.php';  /* include configuration script */		
		require_once $wizGradeFunctionDir;  /* load script functions */
		
		if ($_REQUEST['resetData'] == 'to-nkiru-my-wife') {  /* check and send admin reset password link */ 
		
			$adminMail = preg_replace("/[^A-Za-z0-9@_.]/", "", $_REQUEST['adminMail']);
				
			$adminMail = strip_tags($adminMail);				
			$adminMail = strtolower($adminMail);
			$adminMail = trim($adminMail);

			try { 

				require ($wizGradeDBConnectIndDir);   /* load connection string */ 		

				$adminInfo = wizGradeAdminData($conn, $fiVal);  /* school admin information  */	
				
				list ($adminIDT, $admin_picture, $adminTitle, $adminLname, $adminFname, $adminMname, 
					  $adminEmail) = explode ("@(.$.)@", $adminInfo);	

			}catch(PDOException $e) {

				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

			}

			/* script validation */
			
			if (($adminMail == '') || (!validateMail($adminMail))){
			
				$msg_e = "Oooooooops Error, please enter a valid email address";
			
			}elseif ($adminEmail != $adminMail) {
			
				 $msg_e = "Oooooooops Error, invalid admin account. Please try again";
			
			}else{

				$recovTime = strtotime(date("Y-m-d H:i:s"));

				$resetVal = wizGradeRandomString($charset, 44);
				
				$ebele_mark = "UPDATE $adminAccessTB 
				
								SET recov_info = :recov_info,
								
								recov_time = :recov_time
									
								WHERE a_mail = :a_mail";

				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':recov_info', $resetVal);
				$igweze_prep->bindValue(':recov_time', $recovTime);
				$igweze_prep->bindValue(':a_mail', $adminMail); 

				if ($igweze_prep->execute()){
				 
					$resetLink = $wizGradePortalRoot.'reset?r='.$resetVal.'&mail='.$adminMail;
				 
					$subject = 'Information to Reset your Password - wizGrade';

					$message = "Hi $adminMail, you have requested for password Recovery.<br /><br />

					Your password has not been changed yet, but you can reset it here : <br />
					$resetLink  <br /><br />
				   
				   
					Best Regards, <br /><br />
					wizGrade";


					wizMailer($adminMail, $subject, $message, "no-reply@wizgrade.com");

					$msg_s = "A link have been sent to your email address ($adminMail). Please check your inbox or spam folder for the mail and click on the link to reset your password";
					
					echo "<script type='text/javascript'>  $('.login-wrap-reset').slideUp(); $('.page-loader').fadeOut(1500); </script>";  
					
					echo $succesMsg.$msg_s.$sEnd; echo $scrollUp;  exit;

				}else{


					$msg_e = "Oooops, an error has occur while trying to reset your password. Please try again or check your network connection!!!";


				}


			}	


			 	
		}elseif($_REQUEST['adminPass'] = 'resetPass') {  /* reset admin password */ 	
      

			$new_pass = strip_tags($_REQUEST['password']);
	        $confirm_new = strip_tags($_REQUEST['cpassword']);
	         
 			try {
				
				/* script validation */ 
				
				if ($new_pass == '') {
	
					$msg_e = "*Oooops error, please enter new password";

				}elseif ((strlen($new_pass) < 7) || (strlen($new_pass) > 15) ){
					
					$msg_e = "*Oooops error, please new password should be more than 7 and less than 15 characters igweze004";
					
				}elseif ( (!preg_match("#[0-9]+#", $new_pass)) || (!preg_match("#[a-zA-Z]+#", $new_pass)) ){
					
					$msg_e = "*Oooops error, password must include at least one letter and number!  e.g igweze004";
					
				}elseif ($confirm_new == "") {

					$msg_e = "*Oooops error, please confirm new password";

				}elseif ($confirm_new != $new_pass) {         

					$msg_e = "*Oooops error, your new and confirmation password dose not match. Please try again";

				} else {  /* update information */ 


					$randomL = wizGradeRandomString($charset, 16); 
					$randomD = wizGradeRandomString($charset, 16); 
					$newPass =  encrypter($new_pass, $randomD);

					require ($wizGradeDBConnectIndDir);   /* load connection string */ 		
					
					$ebele_mark = "UPDATE $adminAccessTB SET
						 
											a_pass = :a_pass,
											a_limit = :a_limit,
											a_delimit = :a_delimit,
											recov_info = :recov_info,
											recov_time = :recov_time
																						
											WHERE admin_id = :admin_id";
											
					$igweze_prep = $conn->prepare($ebele_mark);				
					$igweze_prep->bindValue(':a_pass', $newPass);
					$igweze_prep->bindValue(':a_limit', $randomL);
					$igweze_prep->bindValue(':a_delimit', $randomD);
					$igweze_prep->bindValue(':recov_info', "");
					$igweze_prep->bindValue(':recov_time', "");
					$igweze_prep->bindValue(':admin_id', $fiVal); 
					
					if ($igweze_prep->execute()) {  /* if sucessfully */ 
									 
						$msg_s = "Your password was sucessfully reset. Page Redirecting . . . ."; 						
						
						echo "<script type='text/javascript'>  $('.login-wrap-reset').slideUp();  $('.page-loader').fadeOut(1500);
															 window.location.href = '$wizGradePortalRoot';</script>"; 

						echo $succesMsg.$msg_s.$sEnd; echo $scrollUp; exit; 

					}else{  /* display error */

						$msg_e = "*Oooops error, your password was not reset, please try again";

					}

				}

			}catch(PDOException $e) {
  			
				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}	



		}else{  /* display error */ 
							
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
				
		}

 
		if ($msg_s) {

			echo "<script type='text/javascript'> $('.page-loader').fadeOut(1500); </script>";
			echo $succesMsg.$msg_s.$sEnd; echo $scrollUp;  exit;
							
		}	

		if ($msg_e) {
			
			echo "<script type='text/javascript'> $('.page-loader').fadeOut(1500); </script>";
			echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 			
								
		}
				
exit;
?>