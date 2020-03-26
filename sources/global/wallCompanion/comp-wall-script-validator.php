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
	This script handle companion wall validation
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 

		require ($wizGradevalidater); 
				
		if (($_REQUEST['postFData']) == 'sendpostFData') {

			try {

					
					$posts = $_REQUEST['fPostField'];
					$time = strtotime(date("Y-m-d H:i:s"));
					$uip = $_SERVER['REMOTE_ADDR'];
					$posts = str_replace('<br />', "\n", $posts);
					
					$posts = htmlspecialchars($posts);
					 
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */ 
					

					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
						  $wallPic, $load_page) = explode ("##", $memberInfo);				
					
					/* script validation */
					
					if ($member_id == '') { 
					
						$msg_e = "You are not allow to post on this forum. please contact your administrator for more info. Thanks"; 
						echo $errorMsg.$msg_e.$eEnd; exit; 			
						
					}elseif ($posts == '') { 
					
						$msg_e = "Ooooooooops, please type a post"; 
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
						
					}else{
					
						$ebele_mark_1 = "INSERT INTO $cWallPostTB (author_id, post_msg, post_date, post_ip, d_id, f_id)

																	VALUES (:author_id, :post_msg, :post_date, :post_ip, :d_id, :f_id)";

						$igweze_prep_1 = $conn->prepare($ebele_mark_1);

						$igweze_prep_1->bindValue(':author_id', $member_id);
						$igweze_prep_1->bindValue(':post_msg', $posts);
						$igweze_prep_1->bindValue(':post_date', $time);
						$igweze_prep_1->bindValue(':post_ip', $uip);
						$igweze_prep_1->bindValue(':d_id', $m_dept);
						$igweze_prep_1->bindValue(':f_id', $m_faculty);
						
									
						if ($igweze_prep_1->execute()){  /* insert information */	
							
							$last_id = $conn->lastInsertId(); 
							
							$ebele_mark_2 = "SELECT post_id, author_id, post_title, post_msg, post_date

											 FROM $cWallPostTB

												WHERE post_id = :post_id
												
												AND author_id = :author_id";
								 
						
							$igweze_prep_2 = $conn->prepare($ebele_mark_2);

							$igweze_prep_2->bindValue(':post_id', $last_id);
							$igweze_prep_2->bindValue(':author_id', $member_id);
							 
							$igweze_prep_2->execute();
							
							$rows_count_2 = $igweze_prep_2->rowCount(); 
							
							if($rows_count_2 == $foreal) {
							
								while($row_2 = $igweze_prep_2->fetch(PDO::FETCH_ASSOC)) {		
				   
									$post_id = $row_2['post_id'];
									$author_id = $row_2['author_id'];
									$post_title = $row_2['post_title'];
									$post_msg = $row_2['post_msg'];
									$post_time = $row_2['post_date'];
								
								}	
								$post_msg = htmlspecialchars_decode($post_msg);
								$post_msg = nl2br($post_msg);
								
								$post_date = wallTimerBoy($post_time); /* companion wall time ago */ 
								
								$postLikes = companionWallLikes($conn, $post_id, $member_id);  /* show companion wall post likes & dislike */
								$postLikesMore = companionWallMoreLikes($conn, $post_id, $check_user);  /* show companion wall post more likes & dislike */ 
								$commentDiv = commentsNum($conn, $post_id);  /* show companion wall comment number */
						  
								if($member_id == $author_id) {
									
									$show_detele = '<div class="fb-user-tasks">
							  
									<a href="javascript:;" class="post-delete-btn" id="del-'.$post_id.'"> <i class="fa  fa-times"></i> </a> <br />
									
									<a href="javascript:;" class="post-edit-btn" id="del-'.$post_id.'"><i class="fa  fa-edit"></i> </a> 
									</div>';
								
								}else{
									
									$show_detele = '';
									
								}
								
								$showSlideUp = '<a href="javascript:;" style = "float:right; display:none;" title="Slide Up" 
								id="slideCommentsDiv-'.$post_id.'" 
								class="slideCommentsDiv clearfix"> <i class="fa  fa-chevron-up"></i> </a>';
								
								if ( (is_null($prof_pic)) || ($prof_pic == '') || (!file_exists($forumPicExt.$prof_pic)) ){ $StuFpic = $wizGradeDefaultPic; }
								
								else { $StuFpic = $forumPicExt.$prof_pic; }
								
								$studentPicture = '<img src="'.$StuFpic.'" class="poster-img" />';							
								$post_row_id =  "post_".$post_id;								
								$edit_row_id =  "editPost_".$post_id;
			 

$posts =<<<IGWEZE

						  <section class="panel" id= "$post_row_id">
							  <div class="panel-body">
								  <div class="fb-user-thumb">
								  <a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-$member_id">
									  $studentPicture  
								  </a> 	  
								  </div>
								  $show_detele
								  <div class="fb-user-details">
									  <h3><a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-$member_id">$m_name</a></h3>
									  <p>$post_date</p>
								  </div>
								  <div class="clearfix"></div>
								  $changeProfPic
								  <p id='$edit_row_id' class='fb-user-message-posts'>$post_msg </p>
								  <div class="clearfix"></div>
								  

								 <div class="fb-status-container fb-border comment-div" id="commentDiv-$post_id">
									  <div class="fb-time-action">
										  <a href="javascript:;" title="Like this">$postLikes</a>
										  <span>-</span>
										  <a href="javascript:;" title="Leave a comment" id='commentNumStatus-$post_id'>$commentDiv</a>
										$showSlideUp  
									  </div>
								  </div>
						
						<div class="fb-status-container fb-border fb-gray-bg">
									  <div class="fb-time-action like-info">
									  <span id="likeDetails-$post_id">$postLikesMore</span>							  
									  </div>
									  
						<div class = 'commentDivPostSub' id="commentDivSub-$post_id" style="display:none;">
							  
       				
					
IGWEZE;
								echo $posts;
								
								companionWallComments($conn, $post_id);  /* load  companion wall post comments */
								
								echo'</div></div>';					
								echo ' </section>';

							}else{
							
								$msg_e = "Ooooops Something went wrong while posting your message, please try again";
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
							}

					
					
						}
					
						$scrollUp = "<script type='text/javascript'> $('html, body').animate({scrollTop:$('#fmsgBox').position().top}, 'slow'); </script>";
						echo $scrollUp;			 				
					
					}
				
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				
				
				}				
				exit;
				
		}
				
		if (($_REQUEST['postFData']) == 'editPostData') {

			try {
				
					
					$posts = $_REQUEST['cwall-edit-post'];
					$post_id = $_REQUEST['PostID'];
					$posts = str_replace('<br />', "\n", $posts);
					$posts = htmlspecialchars($posts);
					
					$targetScroll = "editPost_".$post_id;
					$scrollUp = "<script type='text/javascript'> $('html, body').animate({scrollTop:$('#".$targetScroll."').position().top}, 'slow'); </script>";	
					 
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
					
					/* script validation */
					
					if ($member_id == '') { 
					
						$msg_e = "You are not allow to post on this forum. please contact your administrator for more info. Thanks"; 
						echo $errorMsg.$msg_e.$eEnd; exit; 			
						
					}elseif ($posts == '') { 
					
						$msg_e = "Ooooooooops, please type a post"; 
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
											
					}else{  /* update information */
							
					
						$ebele_mark_1 = "UPDATE $cWallPostTB 
										
										SET 
										
										post_msg = :post_msg
										
										WHERE post_id = :post_id
										
										AND author_id = :author_id";

						$igweze_prep_1 = $conn->prepare($ebele_mark_1);
						$igweze_prep_1->bindValue(':post_msg', $posts);
						$igweze_prep_1->bindValue(':post_id', $post_id);
						$igweze_prep_1->bindValue(':author_id', $member_id);			
						$igweze_prep_1->execute();
						
						$ebele_mark_2 = "SELECT post_msg

										 FROM $cWallPostTB

											WHERE post_id = :post_id
											
											AND author_id = :author_id";
							 
					
						$igweze_prep_2 = $conn->prepare($ebele_mark_2);

						$igweze_prep_2->bindValue(':post_id', $post_id);
						$igweze_prep_2->bindValue(':author_id', $member_id);
						 
						$igweze_prep_2->execute();
						
						$rows_count_2 = $igweze_prep_2->rowCount(); 
						
						if($rows_count_2 == $foreal) {
						
							while($row_2 = $igweze_prep_2->fetch(PDO::FETCH_ASSOC)) {		
			   
								$post_msg = $row_2['post_msg'];
						
							}	
							$post_msg = htmlspecialchars_decode($post_msg);
							$post_msg = nl2br($post_msg);
							
							echo $post_msg; echo $scrollUp;			 				
							
						}else{
						
							$msg_e = "Ooooops Something went wrong while editing your post, please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
				
						} 
					
					
					}
				 
				
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				
				
				}				
				
				exit;
				
		}
				
				
				
		if (($_REQUEST['postFData']) == 'sendCommentFData') {
		
				
			try {

				
				$comments = $_REQUEST['cwall-comment-div'];
				$post_id = $_REQUEST['PostID'];
				$time = strtotime(date("Y-m-d H:i:s"));
				$uip = $_SERVER['REMOTE_ADDR'];
				
				
				$comments = str_replace('<br />', "\n", $comments );
				
				$comments = htmlspecialchars($comments);
				 
				$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
				
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
				
				/* script validation */
				
				if ($member_id == '') { 
				
					$msg_e = "You are not allow to comment on this forum. please contact your administrator for more info. Thanks"; 
					echo $errorMsg.$msg_e.$eEnd; exit;

				}elseif ($comments == '') { 
				
					$msg_e = "Ooooooooops, please type your comment"; 
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;	
					
				}else{  /* insert information */
								
					$ebele_mark_1 = "INSERT INTO $cWallCommentTB (post_id, comment, comment_date, comment_user, comment_ip)

																VALUES (:post_id, :comment, :comment_date, :comment_user, :comment_ip)";

					$igweze_prep_1 = $conn->prepare($ebele_mark_1);

					$igweze_prep_1->bindValue(':post_id', $post_id);
					$igweze_prep_1->bindValue(':comment', $comments);
					$igweze_prep_1->bindValue(':comment_date', $time);
					$igweze_prep_1->bindValue(':comment_user', $member_id);
					$igweze_prep_1->bindValue(':comment_ip', $uip); 
								
					if ($igweze_prep_1->execute()){
					
						$last_id = $conn->lastInsertId(); 
						
						$ebele_mark_2 = "SELECT comment_id, post_id, comment, comment_title, comment_pic, comment_date, comment_user	

										 FROM $cWallCommentTB

											WHERE comment_id = :comment_id
											
											AND comment_user = :comment_user";
							 
					
						$igweze_prep_2 = $conn->prepare($ebele_mark_2);

						$igweze_prep_2->bindValue(':comment_id', $last_id);
						$igweze_prep_2->bindValue(':comment_user', $member_id);

						$igweze_prep_2->execute();
						
						$rows_count_2 = $igweze_prep_2->rowCount(); 
						
						if($rows_count_2 == $foreal) {
						
							while($row_2 = $igweze_prep_2->fetch(PDO::FETCH_ASSOC)) {		
			   
								$comment_id = $row_2['comment_id'];
								$post_id = $row_2['post_id'];
								$comment = $row_2['comment'];
								$comment_title = $row_2['comment_title'];
								$comment_pic = $row_2['comment_pic'];
								$comment_date = $row_2['comment_date'];
								$comment_user = $row_2['comment_user'];
							
							}	
							
							$postComOwner = postAuthorByPostID($conn, $post_id);  /* companion wall post author ID */
							
							saveNotifications($conn, $postComOwner, $member_id, $post_id, $fiVal, $fiVal);	 /* save companion notification */
							
							$comment = htmlspecialchars_decode($comment);
							
							$comment = nl2br($comment);
							
							$comment_time = wallTimerBoy($comment_date);  /* companion wall time ago */
							
							$memberInfo = companionWallUserDetails($conn, $comment_user, $fiVal);  /* retrieve student companion details */
							
							$thisUserInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
						
							list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
							
							list ($this_user_id, $faRegNum_this, $m_name_this, $m_sex_this, $prof_pic_this) = explode ("##", $thisUserInfo);
							
							$commenrLikes = companionWallComLikes($conn, $comment_id, $member_id);  /* show companion wall post likes & dislike */
							
							
							if($this_user_id == $comment_user) {
								
								$show_detele = '<div class="delete-wrapper">
						  
								<a href="javascript:;" class="comment-delete-btn" id="delC-'.$comment_id.'-'.$post_id.'"> <i class="fa  fa-times"></i> </a> <br />
								<a href="javascript:;" class="comment-edit-btn" id="editC-'.$comment_id.'_'.$post_id.'"> <i class="fa  fa-edit"></i></a> 
								
								</div>';
							
							}else{
								
								$show_detele = '';
								
							}
							
							if ( (is_null($prof_pic)) || ($prof_pic == '') || (!file_exists($forumPicExt.$prof_pic)) ){ $StuFpic = $wizGradeDefaultPic; }
							
							else { $StuFpic = $forumPicExt.$prof_pic; }
							
							if ( (is_null($prof_pic_comm)) || ($prof_pic_comm == '') || (!file_exists($forumPicExt.$prof_pic_comm)) ){ 
							$stuUserpic = $wizGradeDefaultPic; }
							
							else { $stuUserpic = $forumPicExt.$prof_pic_comm; }
							
							$studentPicture = '<img src="'.$StuFpic.'" class="comment-img" />';
							
							$studentPictureUser = '<img src="'.$stuUserpic.'" class="comment-img" />';
							
							$post_row_id =  "post_".$post_id;
							
							$edit_comment_id =  "editcomment_".$comment_id.'_'.$post_id;		
							
							$comment_row_id =  "comment_".$comment_id;

$commentMsg =<<<IGWEZE

							<li id= "$comment_row_id" class="clearfix"> $show_detele 

							<a href="javascript:;" class="cmt-thumb showcompanionWallUser" id="companionWallUser-$member_id">
													  $studentPicture 
							</a>

							 <div class="cmt-details subcomment-div">
								<a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-$member_id">$m_name</a>
								 <span id='$edit_comment_id'> $comment </span>
								 <p> $comment_time - <a href="javascript:;" class="like-link"> $commenrLikes </a></p>
							 </div>
							</li> 
					
IGWEZE;
							echo $commentMsg;
					

						}else{
					
							$msg_e = "Ooooops Something went wrong while posting your comment, please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
			
						}

				
				
					}
				
					$scrollUp = "<script type='text/javascript'> 
					$('html, body').animate({scrollTop:$('#newCommentDiv-$post_id').position().top}, 'slow'); </script>";	
				
					echo $scrollUp;			 				
				}
					
					
			}catch(PDOException $e) {
  			
				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}
									
			exit;
				
		}
				
			
			
		if (($_REQUEST['postFData']) == 'editCommentData') {

			try {
				
					
					$comments = $_REQUEST['fcommentEditField'];
					$post_data = $_REQUEST['CPID'];
					$comments = str_replace('<br />', "\n", $comments);
					
					$comments = htmlspecialchars($comments);
					
					list ($comment_id, $post_id) = explode ("_", $post_data);
					
					$targetScroll = "editcomment_".$post_data;
					$scrollUp = "<script type='text/javascript'> 
					$('html, body').animate({scrollTop:$('#".$targetScroll."').position().top}, 'slow'); </script>";	
					 
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
					
					/* script validation */
					
					if ($member_id == '') { 
					
						$msg_e = "You are not allow to post on this forum. please contact your administrator for more info. Thanks"; 
						echo $errorMsg.$msg_e.$eEnd; exit;
						
					}elseif ($comments == '') { 
					
						$msg_e = "Ooooooooops, please type a comment"; 
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;			
						
					}else{  /* update information */
					
						$ebele_mark_1 = "UPDATE $cWallCommentTB 
										
											SET 
										
											comment = :comment
										
											WHERE comment_id = :comment_id
										
											AND comment_user = :comment_user";

						$igweze_prep_1 = $conn->prepare($ebele_mark_1);
						$igweze_prep_1->bindValue(':comment', $comments);
						$igweze_prep_1->bindValue(':comment_id', $comment_id);
						$igweze_prep_1->bindValue(':comment_user', $member_id);			
						$igweze_prep_1->execute();
						
						$ebele_mark_2 = "SELECT comment

										 FROM $cWallCommentTB

											WHERE comment_id = :comment_id
											
											AND comment_user = :comment_user";
							 
					
						$igweze_prep_2 = $conn->prepare($ebele_mark_2);

						$igweze_prep_2->bindValue(':comment_id', $comment_id);
						$igweze_prep_2->bindValue(':comment_user', $member_id);			
						 
						$igweze_prep_2->execute();
						
						$rows_count_2 = $igweze_prep_2->rowCount(); 
						
						if($rows_count_2 == $foreal) {
						
							while($row_2 = $igweze_prep_2->fetch(PDO::FETCH_ASSOC)) {		
			   
								$commentMsg = $row_2['comment'];
						
							}	
							
							$commentMsg = htmlspecialchars_decode($commentMsg);
				
							$commentMsg = nl2br($commentMsg);
							
							echo $commentMsg; echo $scrollUp;			 				
							
						}else{
						
							$msg_e = "Ooooops Something went wrong while editing your comment, please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
				
						} 
					
					
					} 
					
				
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage()); 
				
				}				
				
				exit;
				
		}

				
		if (($_REQUEST['postUploadData']) == 'senduploadPicData') {
		
				
			try {

					
					$post_title = $_REQUEST['uploadPicTitle'];
					$time = strtotime(date("Y-m-d H:i:s"));
					$uip = $_SERVER['REMOTE_ADDR'];
					
					$post_title = htmlspecialchars($post_title);
					
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
						  $wallPic, $load_page) = explode ("##", $memberInfo);				
					
									
					$tempDetails = uploadTempDetails($conn, $member_id);  /* upload temporary pictures */	
										
					list ($count, $fi_img, $se_img, $th_img, $fo_img) = explode ("@", $tempDetails);
					
					/* script validation */
					
					if  (($fi_img != '') && (file_exists($forumPicExtTem.$fi_img))){  /* if file really exits copy and remove pictures */

						copy($forumPicExtTem.$fi_img, $forumPicExt.$fi_img);
						unlink($forumPicExtTem.$fi_img);

					}

					if  (($se_img != '') && (file_exists($forumPicExtTem.$se_img))){  /* if file really exits copy and remove pictures */

						copy($forumPicExtTem.$se_img, $forumPicExt.$se_img);
						unlink($forumPicExtTem.$se_img);

					}

					if  (($th_img != '') && (file_exists($forumPicExtTem.$th_img))){  /* if file really exits copy and remove pictures */

						copy($forumPicExtTem.$th_img, $forumPicExt.$th_img);
						unlink($forumPicExtTem.$th_img);

					}

					if  (($fo_img != '') && (file_exists($forumPicExtTem.$fo_img))){  /* if file really exits copy and remove pictures */

						copy($forumPicExtTem.$fo_img, $forumPicExt.$fo_img);
						unlink($forumPicExtTem.$fo_img);

					}					
					
					
					if (($fi_img == '') && ($se_img == '') && ($th_img == '') && ($fo_img == '')){
					
						$postMessage = '';
						
					
					}else{  /* insert pictures information */

										
						$ebele_mark = "INSERT INTO $cWallPostTB(author_id, post_title, post_img_fi, post_img_se, post_img_th, post_img_fo, 
																   post_date, post_ip, post_type, d_id, f_id)

														VALUES (:author_id, :post_title, :post_img_fi, :post_img_se, :post_img_th, 
																:post_img_fo, :post_date, :post_ip, :post_type, :d_id, :f_id)";

						$igweze_prep = $conn->prepare($ebele_mark);

						$igweze_prep->bindValue(':author_id', $member_id);
						$igweze_prep->bindValue(':post_title', $post_title);
						$igweze_prep->bindValue(':post_img_fi', $fi_img);
						$igweze_prep->bindValue(':post_img_se', $se_img);
						$igweze_prep->bindValue(':post_img_th', $th_img);
						$igweze_prep->bindValue(':post_img_fo', $fo_img);
						$igweze_prep->bindValue(':post_date', $time);
						$igweze_prep->bindValue(':post_ip', $uip);
						$igweze_prep->bindValue(':post_type', $seVal);
						$igweze_prep->bindValue(':d_id', $m_dept);
						$igweze_prep->bindValue(':f_id', $m_faculty);
										
						if($igweze_prep->execute()){
						
							
							$last_id = $conn->lastInsertId();
							
							$ebele_mark_2 = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, 
							post_img_th, post_img_fo, post_date, post_ip, post_type

												 FROM $cWallPostTB

													WHERE post_id = :post_id
													
													AND author_id = :author_id";
								 
						
							$igweze_prep_2 = $conn->prepare($ebele_mark_2);

							$igweze_prep_2->bindValue(':post_id', $last_id);
							$igweze_prep_2->bindValue(':author_id', $member_id);
							 
							$igweze_prep_2->execute();
							
							$rows_count_2 = $igweze_prep_2->rowCount(); 
							
							if($rows_count_2 == $foreal) {
							
								while($row_2 = $igweze_prep_2->fetch(PDO::FETCH_ASSOC)) {		
				   
									$post_id = $row_2['post_id']; 
									$author_id = $row_2['author_id'];
									$post_title = $row_2['post_title'];
									$post_msg = $row['post_msg'];
									$post_img_fi = $row_2['post_img_fi'];
									$post_img_se = $row_2['post_img_se'];
									$post_img_th = $row_2['post_img_th'];
									$post_img_fo = $row_2['post_img_fo'];
									$post_time = $row_2['post_date'];
									$post_type = $row_2['post_type'];
								
								}
								
								$post_title = htmlspecialchars_decode($post_title);
								
								if (($member_id == $author_id) && ($faRegNum == $regNum)) { $checkPostAuthor = true;}
								else {$checkPostAuthor = false;}
								
								if($post_type == $seVal) {
								
									if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){  /* display if picure exits */
									
										$fi_upload = '
									
										  <li>
											  
											  
												 <img src="'.$forumPicExt.$post_img_fi.'" alt="'.$post_img_fi.'" />
												  <!-- <figcaption>
												 
												  <h3></h3>';
												  if($checkPostAuthor == true){
												  $fi_upload .= '		
													   
													   <button style="margin-top:10px !important;" type="submit" class="btn btn-set makeProfilePic"
													   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

													   <button style="margin-top:10px !important;" type="submit" class="btn btn-set makeWallPic"
													   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>';
												  }
												   $fi_upload .= ' <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_fi.'">
													  <i class="fa fa-camera"></i> View Picture</a>
												  </figcaption>--> 
											  
										  </li>';

									
									}
									
									if (($post_img_se != '') && (file_exists($forumPicExt.$post_img_se))){  /* display if picure exits */
									
										$se_upload = '
									
										  <li>
											  
											  
												 <img src="'.$forumPicExt.$post_img_se.'" alt="'.$post_img_se.'" />
												  <!-- <figcaption>
												 
												  <h3></h3>';
												  if($checkPostAuthor == true){
												  $se_upload .= '		
													   
													   <button style="margin-top:10px !important;" type="submit" class="btn btn-set makeProfilePic"
													   id="'.$post_img_se.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

													   <button style="margin-top:10px !important;" type="submit" class="btn btn-set makeWallPic"
													   id="'.$post_img_se.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>';
												  }
												   $se_upload .= ' <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_se.'">
													  <i class="fa fa-camera"></i> View Picture</a>
												  </figcaption> --> 
											  
										  </li>';

									}
									
									if (($post_img_th != '') && (file_exists($forumPicExt.$post_img_th))){  /* display if picure exits */
									
										$th_upload = '

										  <li>
											  
											  
												 <img src="'.$forumPicExt.$post_img_th.'" alt="'.$post_img_th.'" />
												  <!-- <figcaption>
												 
												  <h3></h3>';
												  if($checkPostAuthor == true){
												  $th_upload .= '		
													   
													   <button style="margin-top:10px !important;" type="submit" class="btn btn-set makeProfilePic"
													   id="'.$post_img_th.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

													   <button style="margin-top:10px !important;" type="submit" class="btn btn-set makeWallPic"
													   id="'.$post_img_th.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>';
												  }
												   $th_upload .= ' <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_th.'">
													  <i class="fa fa-camera"></i> View Picture</a>
												  </figcaption> --> 
											  
										  </li>';

									}
									
									if (($post_img_fo != '') && (file_exists($forumPicExt.$post_img_fo))){  /* display if picure exits */
									
										$fo_upload = '

										  <li>
											  
											  
												 <img src="'.$forumPicExt.$post_img_fo.'" alt="'.$post_img_fo.'" />
												  <!-- <figcaption>
												 
												  <h3></h3>';
												  if($checkPostAuthor == true){
												  $fo_upload .= '		
													   
													   <button style="margin-top:10px !important;" type="submit" class="btn btn-set makeProfilePic"
													   id="'.$post_img_fo.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

													   <button style="margin-top:10px !important;" type="submit" class="btn btn-set makeWallPic"
													   id="'.$post_img_fo.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>';
												  }
												   $fo_upload .= ' <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_fo.'">
													  <i class="fa fa-camera"></i> View Picture</a>
												  </figcaption> --> 
											  
										  </li>';
									
									}


									$postMessage = "<div class='fb-user-top-title'>$post_title</div>
													<ul class='grid cs-style-1 $post_id'>
													$fi_upload $se_upload
													$th_upload $fo_upload 
													</ul>";
									
								
								}
								
								$post_date = wallTimerBoy($post_time); /* companion wall time ago */
								
								$postLikes = companionWallLikes($conn, $post_id, $member_id);
								$commentDiv = commentsNum($conn, $post_id);
						  
								if($member_id == $author_id) {
									
									$show_detele = '<div class="fb-user-tasks">
							  
									<a href="javascript:;" class="post-delete-btn" id="del-'.$post_id.'"> <i class="fa  fa-times"></i> </a>  
									</div>';
								
								}else{
									
									$show_detele = '';
								
								}
								
								$showSlideUp = '<a href="javascript:;" style = "float:right; display:none;" title="Slide Up" 
								id="slideCommentsDiv-'.$post_id.'" 
								class="slideCommentsDiv clearfix"> <i class="fa  fa-chevron-up"></i> </a>';
								
								if ( (is_null($prof_pic)) || ($prof_pic == '') || (!file_exists($forumPicExt.$prof_pic)) ){ $StuFpic = $wizGradeDefaultPic; }
								
								else { $StuFpic = $forumPicExt.$prof_pic; }
								
								$studentPicture = '<img src="'.$StuFpic.'" class="poster-img" />';
								
								$post_row_id =  "post_".$post_id;
			 

$posts =<<<IGWEZE


						<section class="panel fb-user-div" id= "$post_row_id">
                          <div class="panel-body">
                              <div class="fb-user-thumb">
							  <a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-$member_id">
                                  $studentPicture  
							  </a>	  
                              </div>
							  $show_detele
                              <div class="fb-user-details">
                                  <h3><a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-$member_id">$m_name</a></h3>
                                  <p>$post_date</p>
                              </div>
                              <div class="clearfix"></div>
							  $changeProfPic
							  <p id='$edit_row_id' class='fb-user-message-posts'>$postMessage </p>
							  <div class="clearfix"></div>
							  

							 <div class="fb-status-container fb-border comment-div" id="commentDiv-$post_id">
                                  <div class="fb-time-action">
                                      <a href="javascript:;" title="Like this">$postLikes</a>
                                      <span>-</span>
                                      <a href="javascript:;" title="Leave a comment" id='commentNumStatus-$post_id'>$commentDiv</a>
                                      $showSlideUp 
                                  </div>
                              </div>
					
								<div class="fb-status-container fb-border fb-gray-bg">
											  <div class="fb-time-action like-info">
											   
											   <span id="likeDetails-$post_id"> </span>							  
											   
											  </div>
											  
								<div class = 'commentDivPostSub' id="commentDivSub-$post_id" style="display:none;">


					
       				
					
IGWEZE;
								echo $posts;
								
								companionWallComments($conn, $post_id);  /* load  companion wall post comments */								
								
								echo'</div></div>';					
									echo ' </section>';

								$status = 'deleteTempPic';
								
								removeTempUpload($conn, $member_id, $status);  /* remove temporary pictures */


							}else{
							
								$msg_e = "Ooooops Something went wrong while uploading your picture/s, please try again";
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
					
							}

				
				
						}

				
					}					

				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				} 
				
				exit;
	
	    } 
		

		if (($_REQUEST['postUploadData']) == 'uploadProfilePic') {
		
				
			try {
				
					$time = strtotime(date("Y-m-d H:i:s"));
					$uip = $_SERVER['REMOTE_ADDR'];
					
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);	
					
					$genderVerb = genderVerb($m_sex);  /* gender verb */
									
					$tempProfPic = profPicTempDetails($conn, $member_id);  /* upload temporary profile companion picture */
					
					/* script validation */
					
					if  (($tempProfPic != '') && (file_exists($forumPicExtTem.$tempProfPic))){  /* if file really exits remove pictures */

						copy($forumPicExtTem.$tempProfPic, $forumPicExt.$tempProfPic);
						unlink($forumPicExtTem.$tempProfPic);

					} 
					
					if ($tempProfPic == ''){
					
						$postMessage = '';
						
					
					}else{  /* insert & update pictures information */
					
									
						$ebele_mark = "INSERT INTO $cWallPostTB (author_id, post_img_fi, post_date, post_ip, post_type)

														VALUES (:author_id, :post_img_fi, :post_date, :post_ip, :post_type)";

						$igweze_prep = $conn->prepare($ebele_mark);

						$igweze_prep->bindValue(':author_id', $member_id);
						$igweze_prep->bindValue(':post_img_fi', $tempProfPic);
						$igweze_prep->bindValue(':post_date', $time);
						$igweze_prep->bindValue(':post_ip', $uip);
						$igweze_prep->bindValue(':post_type', $seVal);
										
						if($igweze_prep->execute()){	
						
							$last_id = $conn->lastInsertId();
									
							$ebele_mark_1 = "UPDATE $wizGradeCWallTB 
											
											SET 
											
											profile_pic = :profile_pic
											
											WHERE member_id = :member_id";

							$igweze_prep_1 = $conn->prepare($ebele_mark_1);
							$igweze_prep_1->bindValue(':profile_pic', $tempProfPic);
							$igweze_prep_1->bindValue(':member_id', $member_id);
							$igweze_prep_1->execute(); 
									
							$status = 'deleteTempPic';
							
							removeTempUpload($conn, $member_id, $status);  /* remove temporary pictures */
								
						}	
					
					}	
				
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}exit;		
						
	
	    }exit;
?>