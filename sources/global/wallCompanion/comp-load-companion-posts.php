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
	This script handle companion message posts & comments
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 

			require ($wizGradevalidater); 

			if(($_REQUEST['cWallPaginate']) == 'paginateCompanionWall'){
				
				try {
						
						$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
						
						list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
							  $wallPic, $load_page) = explode ("##", $memberInfo);				
							
							
						/* script validation */
						
						if(isset($_REQUEST['pageID']) && !empty($_REQUEST['loadType'])){
					
								$pageID = $_POST['pageID'];
								$loadType = $_POST['loadType'];
						}else{
					
								$pageID = $i_false;
								#$msg_e = "Ooooops, There is no more post in Companion Wall to display.";
								#echo $errorMsg.$msg_e.$eEnd; exit; 			
						}
				
						$pageLimit = $cWallNumPerPage * $pageID;
						
						if ($loadType == $seVal){

								$ebele_mark = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, 
								post_img_th, post_img_fo, 
												post_date, post_ip, post_type
												
												FROM $cWallPostTB  
												
												WHERE f_id = :f_id
												
												ORDER BY post_id DESC limit $pageLimit, $cWallNumPerPage";

								$igweze_prep = $conn->prepare($ebele_mark);
								$igweze_prep->bindValue(':f_id', $m_faculty);		

								$msg_e = "Ooooops, There is no more post in Companion Wall from your faculty classmates to display.";

						}elseif ($loadType == $thVal){		
			
								$ebele_mark = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, 
								post_img_th, post_img_fo, 
												post_date, post_ip, post_type
								
												FROM $cWallPostTB  
												
												WHERE d_id = :d_id
												
												ORDER BY post_id DESC limit $pageLimit, $cWallNumPerPage";

								$igweze_prep = $conn->prepare($ebele_mark);
								$igweze_prep->bindValue(':d_id', $m_dept);		
								
								$msg_e = "Ooooops, There is no more post in Companion Wall from your Deparmental classmates to 
								display.";
								
				
				
						}else {
					

								$ebele_mark = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se,
								post_img_th, post_img_fo, 
												post_date, post_ip, post_type
								

												FROM $cWallPostTB  ORDER BY post_id DESC limit $pageLimit, $cWallNumPerPage";

								$igweze_prep = $conn->prepare($ebele_mark);

								$msg_e = "Ooooops, There is no more post in Companion Wall to display.";


						}
								$igweze_prep->execute();
								$rows_count = $igweze_prep->rowCount(); 
						
					
				
						if($rows_count > $i_false){
							
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

								$post_id = $row['post_id'];  
								$author_id = $row['author_id'];
								$post_title = $row['post_title'];
								$post_msg = $row['post_msg'];
								$post_img_fi = $row['post_img_fi'];
								$post_img_se = $row['post_img_se'];
								$post_img_th = $row['post_img_th'];
								$post_img_fo = $row['post_img_fo'];
								$post_time = $row['post_date'];
								$post_type = $row['post_type']; 
								
								$post_date = wallTimerBoy($post_time);  /* companion wall time ago */
								
								$post_msg = htmlspecialchars_decode($post_msg);
								
								$post_Edit = $post_msg;
								
								$post_msg = nl2br($post_msg);
								
								$checkEdit = $i_false;
								
								$thisMemberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
							
								list ($check_user, $tRegNum, $tm_name, $tm_sex, $tprof_pic, $tm_dept, $tm_faculty, $tUserMail, 
								  $tWallPic, $tload_page) = explode ("##", $thisMemberInfo);				
					 
								$memberInfo = companionWallUserDetails($conn, $author_id, $fiVal);  /* retrieve student companion details */
							
								list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
								
								$genderVerb = genderVerb($m_sex);  /* gender verb */
								
								$postLikes = companionWallLikes($conn, $post_id, $check_user);  /* show companion wall post likes & dislike */
		 										
								$postLikesMore = companionWallMoreLikes($conn, $post_id, $check_user); /* show companion wall post more likes & dislike */
								
								$commentDiv = commentsNum($conn, $post_id);  /* show companion wall comment number */
								
								if (($member_id == $author_id) && ($faRegNum == $regNum)) { $checkPostAuthor = true;}
								else {$checkPostAuthor = false;}
									
								
								if($post_type == $seVal) {
								
								if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){  /* display if picure exits */
								
								$fi_upload = '
								
									  <li>
										  
										  
											 <img src="'.$forumPicExt.$post_img_fi.'" alt="'.$post_img_fi.'"  />
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
											  </figcaption> --> 
										  
									  </li>';

								
								}
								
								if (($post_img_se != '') && (file_exists($forumPicExt.$post_img_se))){  /* display if picure exits */
								
								$se_upload = '
								
									  <li>
										  
										  
											 <img src="'.$forumPicExt.$post_img_se.'" alt="'.$post_img_se.'"  />
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
										  
										  
											 <img src="'.$forumPicExt.$post_img_th.'" alt="'.$post_img_th.'"  />
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
								
								$post_Edit = '';
								$checkEdit = $foreal;
								$changeProfPic = '';
								
								
								}elseif($post_type == $thVal) {
								

									if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){  /* display if picure exits */
									
										$profilePic = '
										
											  <li>
												  
												  
													 <img src="'.$forumPicExt.$post_img_fi.'" alt="'.$post_img_fi.'"  />
													  <!-- <figcaption>
													 
													  <h3></h3>';
													  if($checkPostAuthor == true){
													  $profilePic .= '		
														   
														   <button style="margin-top:10px !important;" type="submit" class="btn btn-set makeProfilePic"
														   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

														   <button style="margin-top:10px !important;" type="submit" class="btn btn-set makeWallPic"
														   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>';
													  }
													   $profilePic .= ' <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_fi.'">
														  <i class="fa fa-camera"></i> View Picture</a>
													  </figcaption> --> 
												  
											  </li>';
									
									
									}
									
									$postMessage = "<div class='fb-user-top-title'><h4 class='fb-user-top-title'> Changed $genderVerb Profile Picture </h4></div>
														  <ul class='grid cs-style-1 $post_id'>

															$profilePic 
														 </ul>";
									
									
									$post_Edit = $foreal;
									$checkEdit = $foreal;
									
								
								}elseif($post_type == $foVal) {
								

									if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){  /* display if picure exits */
									
										$wallPic = '
										
											  <li>
												  
												  
													 <img src="'.$forumPicExt.$post_img_fi.'" alt="'.$post_img_fi.'"  />
													  <!--  <figcaption>
													 
													  <h3></h3>';
													  if($checkPostAuthor == true){
													  $wallPic .= '		
														   
														   <button style="margin-top:10px !important;" type="submit" class="btn btn-set makeProfilePic"
														   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

														   <button style="margin-top:10px !important;" type="submit" class="btn btn-set makeWallPic"
														   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>';
													  }
													   $wallPic .= ' <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_fi.'">
														  <i class="fa fa-camera"></i> View Picture</a>
													  </figcaption> --> 
												  
											  </li>';
									
									
									}
									
									$postMessage = "<div class='fb-user-top-title'><h4 class='fb-user-top-title'> Changed $genderVerb Wall Cover Picture </h4></div>
														  <ul class='grid cs-style-1 $post_id'>

															$wallPic 
														 </ul>";
									
									
									$post_Edit = $foreal;
									$checkEdit = $foreal;
									
								
								
								}else{
								
									$postMessage = $post_msg;
								
								}
								
									
								if($checkPostAuthor == true){
								
									if ($checkEdit == $i_false){
									
										$show_detele = '<div class="fb-user-tasks">
										<a href="javascript:;" class="post-delete-btn " id="FDel-'.$post_id.'"> <i class="fa  fa-times"></i>  </a>  <br />
										<a href="javascript:;" class="post-edit-btn" id="FEdit-'.$post_id.'"> <i class="fa  fa-edit"></i>  </a>			  		
										</div>';
									
									}elseif($checkEdit == $foreal){
									
										$show_detele = '<div class="fb-user-tasks">
										<a href="javascript:;" class="post-delete-btn" id="FDel-'.$post_id.'"> <i class="fa  fa-times"></i>  </a>  
										</div>';
									
									}elseif($checkEdit == $seVal){
									
										$show_detele = '';					
									
									}else{
									
										$show_detele = '';
									
									}
								
								
								}else{
								
									$show_detele = '';
									$showMailReportBox = '<span>-</span> <a href="javascript:;" title="Send Message" 
									id="sendMailPosts-'.$post_id.'-'.$author_id.'" 
									class="sendMailPosts fb-time-action-like"> <i class="fa fa-envelope"></i> <strong> <span class="hide-res">Send Message</span> </strong></a>
									
									<span>-</span> <a href="javascript:;" title="Report User" id="sendReportPosts-'.$post_id.'-'.$author_id.'" 
									class="sendReportPosts fb-time-action-like"> <i class="fa fa-comments"></i> <strong> <span class="hide-res">Report User</span> </strong></a>
									<span id="mailReportPostsMsg_'.$post_id.'"></span> <span id="mailReportPostsDiv_'.$post_id.'"> </span>';

								}
								
								
								$showSlideUp = '<a href="javascript:;" style = "float:right; display:none;" title="Slide Up" 
								id="slideCommentsDiv-'.$post_id.'" 
								class="slideCommentsDiv clearfix"> <i class="fa  fa-chevron-up"></i> </a>';
								
								if ( (is_null($prof_pic)) || ($prof_pic == '-') || (!file_exists($forumPicExt.$prof_pic)) ){ $StuFpic = $wizGradeDefaultPic; }
								
								else { $StuFpic = $forumPicExt.$prof_pic; }
								
								$studentPicture = '<img src="'.$StuFpic.'" class="poster-img" />';
													
								$post_row_id =  "post_".$post_id;
								
								$edit_row_id =  "editPost_".$post_id;	
						
						
$posts =<<<IGWEZE

                      <section class="panel fb-user-div" id= "$post_row_id">
                          <div class="panel-body">
                              <div class="fb-user-thumb">
                                  <a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-$member_id">$studentPicture</a>  
                              </div>
							  $show_detele
                              <div class="fb-user-details">
                                  <h3><a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-$member_id">$m_name</a></h3>
                                  <p>$post_date</p>
                              </div>
                              <div class="clearfix"></div>
							  $changeProfPic
							  <p id='$edit_row_id' class='fb-user-message-posts'>$postMessage</p>
							  <div class="clearfix"></div>
							  

							 <div class="fb-status-container fb-border" id="commentDiv-$post_id">
                                  <div class="fb-time-action">
                                      <a href="javascript:;" title="Like this">$postLikes</a>
                                      <span>-</span>
                                      <a href="javascript:;" title="Leave a comment" class='comment-div' id='commentNumStatus-$post_id'>$commentDiv</a>

									  $showMailReportBox
									  
									  
                                  	   $showSlideUp
									   
                                  </div>
								  
                              </div>
							  
				
					<div class="fb-status-container fb-border fb-gray-bg">			  
					<div class="fb-time-action like-info">
					 
					<span id="likeDetails-$post_id">$postLikesMore</span>							  
                     
					 </div>
								  
					<div class = "commentDivPostSub clearfix" id = "commentDivSub-$post_id" style = "display:none;">
					
IGWEZE;
								echo $posts;
							
								companionWallComments($conn, $post_id);  /* load  companion wall post comments */
		 									
								echo'</div></div></div>';					
								echo ' </section>';
								
								$post_msg =''; $checkPostAuthor = '';
								$fi_upload =''; $se_upload ='';$th_upload =''; $fo_upload ='';  $changeProfPic = '';
												
							}
							
						}else{
							
								echo $errorMsg.$msg_e.$eEnd; exit; 			

						}
			
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
				
				
			}elseif(($_REQUEST['cWallPaginate']) == 'paginateMemberCWall'){
				
				try {

						/* script validation */
						
						if(isset($_REQUEST['pageID']) && !empty($_REQUEST['memberID'])){
					
								$pageID = $_POST['pageID'];
								$memberID = $_POST['memberID'];
								
						}else{
					
								$pageID = $i_false;
								
						}
				
						echo $pageLimit = $cWallNumPerPage * $pageID;
						
						
						$ebele_mark = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, post_img_th, post_img_fo, 
								post_date, post_ip, post_type

										 FROM $cWallPostTB  
										 
										 WHERE author_id = :author_id 
										 
										 ORDER BY post_id DESC
										 
										 LIMIT $pageLimit, $cWallNumPerPage";
							 
					
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':author_id', $memberID);				
						$igweze_prep->execute();
						$rows_count = $igweze_prep->rowCount(); 

						$msg_e = "Ooooops, There is no more post in Companion Wall to display.";

						
				
						if($rows_count > $i_false){
							
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

								$post_id = $row['post_id'];  
								$author_id = $row['author_id'];
								$post_title = $row['post_title'];
								$post_msg = $row['post_msg'];
								$post_img_fi = $row['post_img_fi'];
								$post_img_se = $row['post_img_se'];
								$post_img_th = $row['post_img_th'];
								$post_img_fo = $row['post_img_fo'];
								$post_time = $row['post_date'];
								$post_type = $row['post_type']; 
								
								$post_date = wallTimerBoy($post_time);  /* companion wall time ago */
								
								$post_msg = htmlspecialchars_decode($post_msg);
								
								$post_Edit = $post_msg;
								
								$post_msg = nl2br($post_msg);
								
								$checkEdit = $i_false;
								
								$thisUserInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
								
								list ($this_user_id, $faRegNum_this, $m_name_this, $m_sex_this, $prof_pic_comm) = explode ("##", $thisUserInfo);	
								
								$memberInfo = companionWallUserDetails($conn, $author_id, $fiVal);  /* retrieve student companion details */
							
								list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);  /* retrieve student companion details */
								
								$genderVerb = genderVerb($m_sex);  /* gender verb */
								
								$postLikes = companionWallLikes($conn, $post_id, $member_id);  /* show companion wall post likes & dislike */
								
								$postLikesMore = companionWallMoreLikes($conn, $post_id, $member_id);  /* show companion wall post more likes & dislike */
								
								$commentDiv = commentsNum($conn, $post_id);  /* show companion wall comment number */
								
								if($post_type == $seVal) {
								
									if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){  /* display if picure exits */
									
										$fi_upload = '
										
											  <li>
												  
												  
													 <img src='.$forumPicExt.$post_img_fi.' Class ="uploadPicDi" />
													  <!-- <figcaption>
													 
													  <h3></h3>
														   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
																	   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

																<button style="margin-top:10px !important;" type="submit" class="btn   btn-set makeWallPic"
																	   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>
															  
														  <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_fi.'">
														  <i class="fa fa-camera"></i> View Picture</a>
													  </figcaption> --> 
												  
											  </li>';

									
									}
									
									if (($post_img_se != '') && (file_exists($forumPicExt.$post_img_se))){  /* display if picure exits */
									
										$se_upload = '
										
											  <li>
												  
												  
													 <img src='.$forumPicExt.$post_img_se.' Class ="uploadPicDi"  />
													  <!-- <figcaption>
													 
													  <h3></h3>
														   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
																	   id="'.$post_img_se.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

																<button style="margin-top:10px !important;" type="submit" class="btn   btn-set makeWallPic"
																	   id="'.$post_img_se.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>
															  
														  <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_se.'">
														  <i class="fa fa-camera"></i> View Picture</a>
													  </figcaption> --> 
												  
											  </li>';

									}
									
									if (($post_img_th != '') && (file_exists($forumPicExt.$post_img_th))){  /* display if picure exits */
									
										$th_upload = '

											  <li>
												  
												  
													 <img src='.$forumPicExt.$post_img_th.' Class ="uploadPicDi"  />
													  <!-- <figcaption>
													 
													  <h3></h3>
														   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
																	   id="'.$post_img_th.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

																<button style="margin-top:10px !important;" type="submit" class="btn   btn-set makeWallPic"
																	   id="'.$post_img_th.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>
															  
														  <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_th.'">
														  <i class="fa fa-camera"></i> View Picture</a>
													  </figcaption> --> 
												  
											  </li>';

									}
									
									if (($post_img_fo != '') && (file_exists($forumPicExt.$post_img_fo))){  /* display if picure exits */
									
										$fo_upload = '

											  <li>
												  
												  
													 <img src='.$forumPicExt.$post_img_fo.' Class ="uploadPicDi"  />
													  <!-- <figcaption>
													 
													  <h3></h3>
														   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
																	   id="'.$post_img_fo.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

																<button style="margin-top:10px !important;" type="submit" class="btn   btn-set makeWallPic"
																	   id="'.$post_img_fo.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>
															  
														  <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_fo.'">
														  <i class="fa fa-camera"></i> View Picture</a>
													  </figcaption> --> 
												  
											  </li>';

									
									}


									$postMessage = "<div class='fb-user-top-title'>$post_title</div>
														  <ul class='grid cs-style-1'>

									$fi_upload $se_upload
									$th_upload $fo_upload 
									</ul>
									";
									
									$post_Edit = '';
									$checkEdit = $foreal;
									$changeProfPic = '';
								
								
								}elseif($post_type == $thVal) {
								

									if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){  /* display if picure exits */
									
										$profilePic = '
										
										  <ul class="grid cs-style-1">
											  <li>
												  
												  
													 <img src='.$forumPicExt.$post_img_fi.' Class ="uploadPicDi"  />
													  <!-- <figcaption>
													 
													  <h3></h3>
															
															  
																<button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
																	   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

																<button style="margin-top:10px !important;" type="submit" class="btn   btn-set makeWallPic"
																	   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>	  
															  
														  <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_fi.'">
														  <i class="fa fa-camera"></i> View Picture</a>
													  </figcaption> --> 
												  
											  </li></ul>';
									
									
									}
									
									$changeProfPic = "<h4 class='fb-user-top-title'> Changed $genderVerb Profile Picture </h4>";
									$postMessage = "$profilePic";
									
									$post_Edit = $foreal;
									$checkEdit = $foreal;
								
								
								}else{
								
									$postMessage = $post_msg;
								
								}
								
									
								if (($this_user_id == $author_id) && ($faRegNum_this == $faRegNum)) {
								
									if ($checkEdit == $i_false){
									
										$show_detele = '<div class="fb-user-tasks">
										<a href="javascript:;" class="post-delete-btn " id="FDel-'.$post_id.'"> <i class="fa  fa-times"></i>  </a>  <br />
										<a href="javascript:;" class="post-edit-btn" id="FEdit-'.$post_id.'"> <i class="fa  fa-edit"></i>  </a>			  		
										</div>';
									
									}elseif($checkEdit == $foreal){
									
										$show_detele = '<div class="fb-user-tasks">
										<a href="javascript:;" class="post-delete-btn" id="FDel-'.$post_id.'"> <i class="fa  fa-times"></i>  </a>  
										</div>';
										
									}elseif($checkEdit == $seVal){
									
										$show_detele = '';					
									
									}else{
									
										$show_detele = '';
									
									}
								
								
								
								}else{
								
									$show_detele = '';
									$showMailReportBox = '<span>-</span> <a href="javascript:;" title="Send Message" 
									id="sendMailPosts-'.$post_id.'-'.$author_id.'" 
									class="sendMailPosts fb-time-action-like"> <i class="fa fa-envelope"></i> <strong> <span class="hide-res">Send Message</span> </strong></a>
									
									<span>-</span> <a href="javascript:;" title="Report User" id="sendReportPosts-'.$post_id.'-'.$author_id.'" 
									class="sendReportPosts fb-time-action-like"> <i class="fa fa-comments"></i> <strong> <span class="hide-res">Report User</span> </strong></a>
									<span id="mailReportPostsMsg_'.$post_id.'"></span> <span id="mailReportPostsDiv_'.$post_id.'"> </span>';

								
								}
								
								
								$showSlideUp = '<a href="javascript:;" style = "float:right; display:none;" title="Slide Up" 
								id="slideCommentsDiv-'.$post_id.'" 
								class="slideCommentsDiv clearfix"> <i class="fa  fa-chevron-up"></i> </a>';
								
								if ( (is_null($prof_pic)) || ($prof_pic == '-') || (!file_exists($forumPicExt.$prof_pic)) ){ $StuFpic = $wizGradeDefaultPic; }
								
								else { $StuFpic = $forumPicExt.$prof_pic; }
								
								$studentPicture = '<img src="'.$StuFpic.'" class="poster-img" />';
													
								$post_row_id =  "post_".$post_id;
								
								$edit_row_id =  "editPost_".$post_id;	
					
					
$posts =<<<IGWEZE

                      <section class="panel fb-user-div" id= "$post_row_id">
                          <div class="panel-body">
                              <div class="fb-user-thumb">
                                  <a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-$member_id">$studentPicture</a>  
                              </div>
							  $show_detele
                              <div class="fb-user-details">
                                  <h3><a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-$member_id">$m_name</a></h3>
                                  <p>$post_date</p>
                              </div>
                              <div class="clearfix"></div>
							  $changeProfPic
							  <p id='$edit_row_id' class='fb-user-message-posts'>$postMessage</p>
							  <div class="clearfix"></div>
							  

							 <div class="fb-status-container fb-border" id="commentDiv-$post_id">
                                  <div class="fb-time-action">
                                      <a href="javascript:;" title="Like this">$postLikes</a>
                                      <span>-</span>
                                      <a href="javascript:;" title="Leave a comment" class='comment-div' id='commentNumStatus-$post_id'>$commentDiv</a>

									  $showMailReportBox
									  
									  
                                  	   $showSlideUp
									   
                                  </div>
								  
                              </div>
							  
				
					<div class="fb-status-container fb-border fb-gray-bg">			  
					 <div class="fb-time-action like-info">
					 
					 $postLikesMore								  
                     
					 </div>
								  
					<div class = "commentDivPostSub clearfix" id = "commentDivSub-$post_id" style = "display:none;">
					
IGWEZE;
					echo $posts;
					
								companionWallComments($conn, $post_id);  /* load  companion wall post comments */
							
								echo'</div></div></div>';					
								echo ' </section>';
								
								$post_msg ='';
								$fi_upload =''; $se_upload ='';$th_upload =''; $fo_upload ='';  $changeProfPic = '';					
					
				
							}
				
						}else{
						
							echo $errorMsg.$msg_e.$eEnd; exit; 			

						}
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
				

								   
				}else{
					
						echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
					
				}exit;
										 
										 
		
		
?>