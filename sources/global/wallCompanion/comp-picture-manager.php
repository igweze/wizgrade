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
	This script handle companion picture uploads
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 
		
		require ($wizGradevalidater); 

		$scrollUp = "<script type='text/javascript'>  $('html, body').animate({scrollTop:$('#fmsgBox').position().top}, 'slow'); </script>";

		if (($_REQUEST['pictureData']) == 'profilePic') {

			try {

					
					$picture = strip_tags($_REQUEST['pictureID']);
					$time = strtotime(date("Y-m-d H:i:s"));
					$uip = $_SERVER['REMOTE_ADDR'];


					if  (($picture != '') && (file_exists($forumPicExt.$picture))){


							list($txt, $ext) = explode(".", $picture); 
							
							
								$newPicName  = $txt.'-prof';
								$newPic = $newPicName.".".$ext;
							
								copy($forumPicExt.$picture, $forumPicExt.$newPic); 								
				
								$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */								
				
								list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
									  $wallPic, $load_page) = explode ("##", $memberInfo);		
				
								$conn->beginTransaction();	
				
								$ebele_mark_1 = "INSERT INTO $cWallPostTB (author_id, post_img_fi, post_date, post_type, post_ip, d_id, f_id)
				
																			VALUES (:author_id, :post_img_fi, :post_date, :post_type, :post_ip, 
																					:d_id, :f_id)";
				
								$igweze_prep_1 = $conn->prepare($ebele_mark_1);
				
								$igweze_prep_1->bindValue(':author_id', $member_id);
								$igweze_prep_1->bindValue(':post_img_fi', $newPic);
								$igweze_prep_1->bindValue(':post_date', $time);
								$igweze_prep_1->bindValue(':post_type', $thVal);
								$igweze_prep_1->bindValue(':post_ip', $uip);
								$igweze_prep_1->bindValue(':d_id', $m_dept);
								$igweze_prep_1->bindValue(':f_id', $m_faculty);			
								
								$ebele_mark_2 = "UPDATE $wizGradeCWallTB
								
													SET
													 
													profile_pic = :profile_pic
													
													WHERE member_id = :member_id";
				
								$igweze_prep_2 = $conn->prepare($ebele_mark_2);
								$igweze_prep_2->bindValue(':member_id', $member_id);
								$igweze_prep_2->bindValue(':profile_pic', $newPic);
								
								if(($igweze_prep_1->execute() && ($igweze_prep_2->execute())){  /* insert information */
									
									$conn->commit();									
									$changedPic = '<a href="javascript:;" class="showcompanionWallUser" 
									id="companionWallUser-'.$member_id.'">'.$forumPicExt.$picture.'</a>';									 
									$msg_s = "Profile picture was successfully changed";
									
									
								}else{	/* display error */	 							
									
									$conn->rollBack();
									$msg_e = "OooooooopsError, could not find this picture information. Thanks";
									
								}
				

					}else{  /* display error */	 	
						
						$msg_e = "Oooooooops Error, could not find this picture information. Thanks";
						
					}
						

			}catch(PDOException $e) {
		
				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
		 
			
			
			}				
		
				
	    }

			
		if (($_REQUEST['pictureData']) == 'wallPic') {

			try {

					
					$picture = strip_tags($_REQUEST['pictureID']);
					$time = strtotime(date("Y-m-d H:i:s"));
					$uip = $_SERVER['REMOTE_ADDR'];


					if  (($picture != '') && (file_exists($forumPicExt.$picture))){

								list($txt, $ext) = explode(".", $picture); 							
							
								$newPicName  = $txt.'-wall';
								$newPic = $newPicName.".".$ext;
							
								copy($forumPicExt.$picture, $forumPicExt.$newPic); 
				
								$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
								
				
								list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
									  $wallPic, $load_page) = explode ("##", $memberInfo);			
				
								$conn->beginTransaction();	
				
								$ebele_mark_1 = "INSERT INTO $cWallPostTB (author_id, post_img_fi, post_date, post_type, post_ip, d_id, f_id)
				
																			VALUES (:author_id, :post_img_fi, :post_date, :post_type, :post_ip, 
																					:d_id, :f_id)";
				
								$igweze_prep_1 = $conn->prepare($ebele_mark_1);
				
								$igweze_prep_1->bindValue(':author_id', $member_id);
								$igweze_prep_1->bindValue(':post_img_fi', $newPic);
								$igweze_prep_1->bindValue(':post_date', $time);
								$igweze_prep_1->bindValue(':post_type', $foVal);
								$igweze_prep_1->bindValue(':post_ip', $uip);
								$igweze_prep_1->bindValue(':d_id', $m_dept);
								$igweze_prep_1->bindValue(':f_id', $m_faculty);	 
				
								$ebele_mark_2 = "UPDATE $wizGradeCWallTB
								
													SET
													 
													wall_pic = :wall_pic
													
													WHERE member_id = :member_id";
				
								$igweze_prep_2 = $conn->prepare($ebele_mark_2);
								$igweze_prep_2->bindValue(':member_id', $member_id);
								$igweze_prep_2->bindValue(':wall_pic', $newPic); 
								
								if(($igweze_prep_1->execute() && ($igweze_prep_2->execute())){  /* insert information */	 	
									
									$conn->commit();									
									$changedPic = '<a href="javascript:;" class="showcompanionWallUser" 
									id="companionWallUser-'.$member_id.'">'.$forumPicExt.$picture.'</a>';
									 
									$msg_s = "Wall picture was successfully changed";									
									
								}else{	/* display error */	 									
									
									$conn->rollBack();
									$msg_e = "OooooooopsError, could not find this picture information. Thanks";
									
								}
				

					}else{  /* display error */	 	
						
							$msg_e = "Oooooooops Error, could not find this picture information. Thanks";
						
					}
						

			}catch(PDOException $e) {
		
				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage()); 
			
			}				
		
				
	    }


		if ($msg_e) {

				echo $errorMsgIn.$msg_e.$msgEnd; echo $scrollUp; 
				exit; 			
			
        }	


		if ($msg_s) {

				echo $succesMsgIn.$msg_s.$msgEnd; echo $scrollUp; 
				echo "<script type='text/javascript'> 	$('#wallCompanion').trigger('click'); </script>";
				exit; 				
									
        }exit;	



?>