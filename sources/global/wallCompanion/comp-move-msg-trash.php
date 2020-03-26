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
	This script move companion message to trash
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 

		require ($wizGradevalidater); 

		 		try {
		 
							$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
							
							list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
								  $wallPic, $load_page) = explode ("##", $memberInfo);	
							
							$mailData = array();	   
							
							foreach($_REQUEST as $mailMsg => $msg_id) {	  /* arrange $_REQUEST Message Array  */					

								$msgType =  msgTypeStatus($conn, $msg_id);
								$mailData[$msg_id] = $msgType;
								$msg_id = ''; $msgType ='';
								
							}
								

								$ebele_mark = "UPDATE $wizGradeMailBoxTB 
								
												SET 
                						 	
												njnk_type = :njnk_type,
												njnk_trash = :njnk_trash

                 								WHERE msg_id = :msg_id
												
												AND njnk_reps_id = :njnk_reps_id";
												
								$igweze_prep = $conn->prepare($ebele_mark);	

								foreach($mailData as $msgID => $mailType) {		/* move mail to trash */				
								
									$igweze_prep->bindValue(':njnk_reps_id', $member_id);
									$igweze_prep->bindValue(':njnk_type', $foVal);
									$igweze_prep->bindValue(':msg_id', $msgID);														
									$igweze_prep->bindValue(':njnk_trash', $mailType);
									
									$igweze_prep->execute();
									
									
									echo  "<script type='text/javascript'>$('#mailRowID-$msgID').fadeOut('300'); 
																		  $('#chkmailID-$msgID').each(function() { 
																			this.checked = false; 
																		  });
																		  </script>";
									$mailType = ''; $msgID = '';
								
								}
								
								

								if(isset($_SESSION['wallComRank'])){	

									$unreadMsg = numOfUnreadMsgAdmin($conn, $member_id);  /* retrieve number of admin unread message */																	
									$trashMsg = numOfTrashMsg($conn, $member_id);  /* retrieve number of trash message */
									
									echo  "<script type='text/javascript'>
																	  $('.TrashMsgNum').html('$trashMsg');	
																	  $('.inboxMsgNum').html('$unreadMsg');	
																	  $('#selectAll').each(function() { 
                													  this.checked = false; 
            														  });	</script>";

								}else{
									
									$unreadMsg = numOfUnreadMsg($conn, $member_id); /* retrieve number of nread message */									
									$adminMsg = numOfAdminMsg($conn, $member_id);  /* retrieve number of admin message */									
									$trashMsg = numOfTrashMsg($conn, $member_id);  /* retrieve number of trash message */									

									echo  "<script type='text/javascript'>
																	  $('.TrashMsgNum').html('$trashMsg');	
																	  $('.inboxMsgNum').html('$unreadMsg');	
																	  $('.adminMsgNum').html('$adminMsg');	
																	  $('#selectAll').each(function() { 
                													  this.checked = false; 
            														  });	</script>";
								}
								
				}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
				exit;
		
		
?>