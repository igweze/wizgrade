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
	This script handle student support desk
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	  
		
		if (($_REQUEST['msgData']) == 'support') {
		
			require_once ($wizGradeCWallFunctionDir); /* load companion functions */

			try {

					$msgRecep = strip_tags($_REQUEST['msgRecep']);
					$msgTitle = strip_tags($_REQUEST['msgTitle']);
					$mailMsg = strip_tags($_REQUEST['msg']);
									
					$recepID = adminWallCmailID($conn, $msgRecep);  /* admin ID check */ 
					
					/* script validation */ 
					
					if($msgRecep == ''){
					
						echo $msg_e = "please select Admin to send support message to. Thanks"; 
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> $('.alert').fadeOut(15000); hidePageLoader();  /* hide page loader */	</script>"; exit;					
											
					}elseif ($recepID == '-') { 
					
						echo $msg_e = "Ooooooooops, this admin can't receive mail for the moment. Thanks"; 
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> $('.alert').fadeOut(15000); hidePageLoader();  /* hide page loader */	</script>"; exit;					
											
					}elseif ($msgTitle == '') { 
					
						echo $msg_e = "Ooooooooops, please type your title"; 
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> $('.alert').fadeOut(15000); hidePageLoader();  /* hide page loader */	</script>"; exit;					
											
					}elseif ($mailMsg == '') { 
					
						echo $msg_e = "Ooooooooops, please type your message"; 
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> $('.alert').fadeOut(15000); hidePageLoader();  /* hide page loader */	</script>"; exit;					

					}else{  /* insert information */
					
						checkWallRegistration($conn);  /* check student registration */ 
											
						$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
						
						list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
							  $wallPic, $load_page) = explode ("##", $memberInfo);

						$time = strtotime(date("Y-m-d H:i:s"));
						$uip = $_SERVER['REMOTE_ADDR'];
						$mailMsg = str_replace('<br />', "\n", $mailMsg);
						
						$msgTitle = htmlspecialchars($msgTitle);
						$mailMsg = htmlspecialchars($mailMsg);

						$ebele_mark = "INSERT INTO $wizGradeMailBoxTB (njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, 
																njnk_reps_id, njnk_sender_ip, njnk_type)

										 VALUES (:njnk_title, :njnk_msg, :njnk_time, :njnk_status, :njnk_sender_id, :njnk_reps_id, 
										 :njnk_sender_ip, :njnk_type)";

						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':njnk_title', $msgTitle);
						$igweze_prep->bindValue(':njnk_msg', $mailMsg);
						$igweze_prep->bindValue(':njnk_time', $time);
						$igweze_prep->bindValue(':njnk_status', $foreal);
						$igweze_prep->bindValue(':njnk_sender_id', $member_id);
						$igweze_prep->bindValue(':njnk_reps_id', $recepID);
						$igweze_prep->bindValue(':njnk_sender_ip', $uip);
						$igweze_prep->bindValue(':njnk_type', $seVal); 
									
						if ($igweze_prep->execute()){  /* if sucessfully */
						
							$msg_s = "You support mail was successfully sent to ADMIN. Thanks";
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> $('#frmSupportDesk').slideUp(500); hidePageLoader();  /* hide page loader */ </script>"; exit;	

						}else{  /* display error */
							
							$msg_e = "Ooooops Something went wrong while sending your message, please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); hidePageLoader();  /* hide page loader */ </script>"; exit;					
						
						} 
					
					} 
						
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				

		}else{
			
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
		}

?>