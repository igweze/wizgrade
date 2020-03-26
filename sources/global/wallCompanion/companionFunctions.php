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
	This script contains all companion wall and inbox functions
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		
			function checkWallRegistration($conn){  /* check if student is registered */
		
				global $wizGradeCWallTB, $foreal, $fiVal;
			
				$confirm_user = 'igweze';
				$update_user = 'nkiru';
				
				if($_SESSION['sex'] == 'Female'){ $sex = '1';}
				elseif($_SESSION['sex'] == 'Male'){ $sex = '2';}
				else{ $sex = '0';}

			
				$ebele_mark = "SELECT member_id, member_name, member_sex, member_dept, member_faculty member_program

										 FROM $wizGradeCWallTB

										WHERE member_reg = :member_reg";
						 
				
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':member_reg', $_SESSION['studetReg']);
					 
					$igweze_prep->execute();									
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$member_id = $row['member_id'];
							$faRegNum = $row['member_reg'];
							$m_name = $row['member_name'];
							$m_sex = $row['member_sex'];
							$prof_pic = $row['profile_pic'];
							$m_sex = $row['member_sex'];
							$m_dept = $row['member_dept'];
							$m_faculty = $row['member_faculty'];
							$m_program = $row['member_program'];
						
						}	

						if (($m_name == '') || ($m_sex == '')){ $update_user = 0404;}
						

					}else{
					
						$confirm_user = 0707;
			
					} 

					if($confirm_user == 0707){ 
						
						if(isset($_SESSION['wallComRank'])){	
						
							$ebele_mark_2 = "INSERT INTO $wizGradeCWallTB(member_reg, member_name, member_sex, member_rank)

																		VALUES (:member_reg, :member_name, :member_sex, :member_rank)";

							$igweze_prep_2 = $conn->prepare($ebele_mark_2);

							$igweze_prep_2->bindValue(':member_reg', $_SESSION['studetReg']);
							$igweze_prep_2->bindValue(':member_name', 'School ADMIN');
							$igweze_prep_2->bindValue(':member_sex', $sex);
							$igweze_prep_2->bindValue(':member_rank', $_SESSION['wallComRank']);
							$igweze_prep_2->execute();
						
						}else{

							$ebele_mark_2 = "INSERT INTO $wizGradeCWallTB(member_reg, member_name, member_sex, member_rank)

																		VALUES (:member_reg, :member_name, :member_sex, :member_rank)";

							$igweze_prep_2 = $conn->prepare($ebele_mark_2);

							$igweze_prep_2->bindValue(':member_reg', $_SESSION['studetReg']);
							$igweze_prep_2->bindValue(':member_name', $_SESSION['fullname']);
							$igweze_prep_2->bindValue(':member_sex', $sex);
							$igweze_prep_2->bindValue(':member_rank', $fiVal);
							$igweze_prep_2->execute();
							
						
						}
					
					
					} 

					if($update_user == 0404){

						$ebele_mark_3 = "UPDATE $wizGradeCWallTB
						
											SET
											 
											member_name = :member_name, 
											
											member_sex = :member_sex
											
											WHERE member_reg = :member_reg";

						$igweze_prep_3 = $conn->prepare($ebele_mark_3);

						$igweze_prep_3->bindValue(':member_reg', $_SESSION['studetReg']);
						$igweze_prep_3->bindValue(':member_name', $_SESSION['fullname']);
						$igweze_prep_3->bindValue(':member_sex', $sex);										
						$igweze_prep_3->execute();
					
					}
					
			}			


			function companionWallUserDetails($conn, $regNum, $SVal){  /* retrieve student companion details */
		
				global $wizGradeCWallTB, $foreal, $fiVal, $seVal;

				if ($SVal == $fiVal) {
				
						$ebele_mark = "SELECT member_id, member_reg, profile_pic, member_name, member_sex, member_dept, 
										member_faculty, member_mail, wall_pic, load_page
						
												 FROM $wizGradeCWallTB

													WHERE member_id = :member_id";
							 
						$igweze_prep = $conn->prepare($ebele_mark);
						
						$igweze_prep->bindValue(':member_id', $regNum);
				}		
				
				if ($SVal == $seVal) {
				
						$ebele_mark = "SELECT member_id, member_reg, profile_pic, member_name, member_sex, member_dept, 
										member_faculty, member_mail, wall_pic, load_page
									  
										 FROM $wizGradeCWallTB

											WHERE member_reg = :member_reg";
							 
						$igweze_prep = $conn->prepare($ebele_mark);
						
						$igweze_prep->bindValue(':member_reg', $regNum);
				}

					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$member_id = $row['member_id'];
							$faRegNum = $row['member_reg'];
							$prof_pic = $row['profile_pic'];
							$m_name = $row['member_name'];
							$m_sex = $row['member_sex'];
							$m_dept = $row['member_dept'];
							$m_faculty = $row['member_faculty'];
							$userMail = $row['member_mail'];
							$wallPic = $row['wall_pic'];
							$load_page = $row['load_page'];
						
						
						}	

						if ($member_id == ''){ $member_id = '-';}
						if ($faRegNum == '')  { $faRegNum = '-';}
						if ($m_name == '')   { $m_name = '-';}
						if ($m_sex == '')    { $m_sex = '-';}
						if ($prof_pic == '') { $prof_pic = '-';}
						if ($m_dept == '')   { $m_dept = '-';}
						if ($m_faculty == ''){ $m_faculty = '-';}
						if ($userMail == '') { $userMail = '-';}
						if ($wallPic == '')  { $wallPic = '-';}
						if ($load_page == ''){ $load_page = $fival;}
						
						$userDatails = $member_id.'##'.$faRegNum.'##'.$m_name.'##'.$m_sex.'##'.$prof_pic.'##'.$m_dept.'##'
						.$m_faculty.'##'.$userMail.'##'.$wallPic.'##'.$load_page;
						
						
					}else{
					
					
						$member_id = '-'; $faRegNum = '-'; $m_name = '-'; $m_sex = '-'; $prof_pic = '-'; $m_dept = '-'; 
						$m_faculty = '-'; 
						$userMail = '-';  $wallPic = '-'; $load_page = $fival;
						
						$userDatails = $member_id.'##'.$faRegNum.'##'.$m_name.'##'.$m_sex.'##'.$prof_pic.'##'.$m_dept.'##'
						.$m_faculty.'##'.$userMail.'##'.$wallPic.'##'.$load_page;
					
					
					}
					
					
					return $userDatails;
					

			}					

			function adminWallCmailID($conn, $rank){  /* show admin companion post */
				
					global $wizGradeCWallTB, $foreal, $fiVal, $seVal;
		
					if($rank == $seVal){ 
					 
						$ebele_mark = "SELECT member_id

										 FROM $wizGradeCWallTB

											WHERE   member_rank = :member_rank"; 
					
						$igweze_prep = $conn->prepare($ebele_mark);
						//$igweze_prep->bindValue(':member_faculty', $_SESSION['faculty_id']);member_dept = :member_dept AND
						//$igweze_prep->bindValue(':member_dept', $_SESSION['dept_id']);member_faculty = :member_faculty AND
						$igweze_prep->bindValue(':member_rank', $seVal);
					
					}else{	
						
						$ebele_mark = "SELECT member_id

										 FROM $wizGradeCWallTB 
										 
										 WHERE
										 
										 member_rank = :member_rank";					 
					
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':member_rank', $thVal);
					
					}
					
						$igweze_prep->execute();				
						$rows_count = $igweze_prep->rowCount(); 
					
						if($rows_count == $foreal) {
					
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
								$adminID = $row['member_id'];
						
							}	
						
						}else{
					
							$adminID = '-';
			
						}
					
						return $adminID;
			}
		
		
			function loadCompanionWall($conn, $loadType, $dID, $fID) {  /* load companion wall post */

				global $cWallPostTB, $wizGradeCWallTB, $foreal, $wizGradeTemplate, $forumPicExt, $fiVal, $seVal, $thVal, $foVal, $regNum, 
				$wizGradeDefaultPic, $succesMsg, $errorMsg, $warningMsg, $infoMsg,  $sEnd, $eEnd, $iEnd, $wEnd, $cWallNumPerPage;
				$changeProfPic = '';

				$checkPostAuthor = '';
				
				
		 		if ($loadType == $seVal){

						$ebele_mark = "SELECT post_id
										
                     		     		FROM $cWallPostTB  
										
										WHERE f_id = :f_id
										
										ORDER BY post_id DESC";

			    		$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':f_id', $fID);		


						$ebele_mark_1 = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, 
						post_img_th, post_img_fo, 
		 								post_date, post_ip, post_type
										
                     		     		FROM $cWallPostTB  
										
										WHERE f_id = :f_id
										
										ORDER BY post_id DESC
										
										LIMIT $cWallNumPerPage";

			    		$igweze_prep_1 = $conn->prepare($ebele_mark_1);
						$igweze_prep_1->bindValue(':f_id', $fID);		
						

						$msg_e = "Ooooops, There is not post yet in Companion Wall from your faculty classmates to display. 
						Why not be the first to start posting in your faculty. . . . . . You are Fabulous";

				}elseif ($loadType == $thVal){		


						$ebele_mark = "SELECT post_id
						
										FROM $cWallPostTB  
										
										WHERE d_id = :d_id
										
										ORDER BY post_id DESC";

			    		$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':d_id', $dID);		

						$ebele_mark_1 = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, 
						post_img_th, post_img_fo, 
		 								post_date, post_ip, post_type
						
										FROM $cWallPostTB  
										
										WHERE d_id = :d_id
										
										ORDER BY post_id DESC
										
										LIMIT $cWallNumPerPage";

			    		$igweze_prep_1 = $conn->prepare($ebele_mark_1);
						$igweze_prep_1->bindValue(':d_id', $dID);		

						$msg_e = "Ooooops, There is not post yet in Companion Wall from your Deparmental classmates to display. 
						Why not be the first to start posting in your Deparment. . . . . . You are Fabulous";
						
		
		
				}else {
			
						$ebele_mark = "SELECT post_id

                     		     		FROM $cWallPostTB  ORDER BY post_id DESC";

			    		$igweze_prep = $conn->prepare($ebele_mark);

						$ebele_mark_1 = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, 
						post_img_th, post_img_fo, 
		 								post_date, post_ip, post_type
						

                     		     		FROM $cWallPostTB  ORDER BY post_id DESC
										
										LIMIT $cWallNumPerPage";

			    		$igweze_prep_1 = $conn->prepare($ebele_mark_1);

						$loadType = 1;

						$msg_e = "Ooooops, There is not post yet in Companion Wall to display. 
						Why not be the first to start posting . . . . . . You are Fabulous";


				}
				 
 				$igweze_prep->execute();
				$rows_count = $igweze_prep->rowCount();
				
				
				$igweze_prep_1->execute();
				$rows_count_1 = $igweze_prep->rowCount(); 
				
				
				if($rows_count_1 >= $foreal) {
				
					echo '<div id="wallPaginateDiv">';	
					
					while($row = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {		

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
						
						$post_date = wallTimerBoy($post_time);					
						$post_msg = htmlspecialchars_decode($post_msg);					
						$post_Edit = $post_msg;					
						$post_msg = nl2br($post_msg);					
						$checkEdit = $i_false;
						
						$thisMemberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);
					
						list ($check_user, $tRegNum, $tm_name, $tm_sex, $tprof_pic, $tm_dept, $tm_faculty, $tUserMail, 
						$tWallPic, $tload_page) = explode ("##", $thisMemberInfo);				
			 
						$memberInfo = companionWallUserDetails($conn, $author_id, $fiVal);
					
						list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
						
						$genderVerb = genderVerb($m_sex);
						
						$postLikes = companionWallLikes($conn, $post_id, $check_user);
						
						$postLikesMore = companionWallMoreLikes($conn, $post_id, $check_user); 
						
						$commentDiv = commentsNum($conn, $post_id);
						
						if (($member_id == $author_id) && ($faRegNum == $regNum)) { $checkPostAuthor = true;}
						else {$checkPostAuthor = false;}
							
						
						if($post_type == $seVal) {
						
							if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){
							
								$fi_upload = '
								
								  <li>
									  
									  
										 <img src="'.$forumPicExt.$post_img_fi.'" alt="'.$post_img_fi.'" />
										  <!-- <figcaption>
										 
										  <h3></h3>';
										  if($checkPostAuthor == true){
										  $fi_upload .= '	
							  
											   <button style="margin-top:10px !important;" type="submit" 
											   class="btn btn-set makeProfilePic"
											   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

											   <button style="margin-top:10px !important;" type="submit" 
											   class="btn btn-set makeWallPic"
											   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>';
										  }
										   $fi_upload .= ' <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_fi.'">
											  <i class="fa fa-camera"></i> View Picture</a>
										  </figcaption> --> 
									  
								  </li>';

							
							}
							
							if (($post_img_se != '') && (file_exists($forumPicExt.$post_img_se))){
							
								$se_upload = '
								
									  <li>
										  
										  
											 <img src="'.$forumPicExt.$post_img_se.'" alt="'.$post_img_se.'" />
											  <!-- <figcaption>
											 
											  <h3></h3>';
											  if($checkPostAuthor == true){
											  $se_upload .= '		
												   
												   <button style="margin-top:10px !important;" type="submit" class="btn btn-set
												   makeProfilePic"
												   id="'.$post_img_se.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

												   <button style="margin-top:10px !important;" type="submit" 
												   class="btn btn-set makeWallPic"
												   id="'.$post_img_se.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>';
											  }
											   $se_upload .= ' <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_se.'">
												  <i class="fa fa-camera"></i> View Picture</a>
											  </figcaption> --> 
										  
									  </li>';

							}
							
							if (($post_img_th != '') && (file_exists($forumPicExt.$post_img_th))){
							
								$th_upload = '

									  <li>
										  
										  
											 <img src="'.$forumPicExt.$post_img_th.'" alt="'.$post_img_th.'"  />
											  <!--  <figcaption>
											 
											  <h3></h3>';
											  if($checkPostAuthor == true){
											  $th_upload .= '		
												   
												   <button style="margin-top:10px !important;" type="submit"
												   class="btn btn-set makeProfilePic"
												   id="'.$post_img_th.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

												   <button style="margin-top:10px !important;" type="submit" 
												   class="btn btn-set makeWallPic"
												   id="'.$post_img_th.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>';
											  }
											   $th_upload .= ' <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_th.'">
												  <i class="fa fa-camera"></i> View Picture</a>
											  </figcaption> --> 
										  
									  </li>';

							}
							
							if (($post_img_fo != '') && (file_exists($forumPicExt.$post_img_fo))){
							
								$fo_upload = '

									  <li>
										  
										  
											 <img src="'.$forumPicExt.$post_img_fo.'" alt="'.$post_img_fo.'"  />
											  <!-- <figcaption>
											 
											  <h3></h3>';
											  if($checkPostAuthor == true){
											  $fo_upload .= '		
												   
												   <button style="margin-top:10px !important;" type="submit" 
												   class="btn btn-set makeProfilePic"
												   id="'.$post_img_fo.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

												   <button style="margin-top:10px !important;" type="submit" 
												   class="btn btn-set makeWallPic"
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
						

							if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){
							
								$profilePic = '
								
									  <li>
										  
										  
											 <img src="'.$forumPicExt.$post_img_fi.'" alt="'.$post_img_fi.'" />
											  <!--  <figcaption>
											 
											  <h3></h3>';
											  if($checkPostAuthor == true){
											  $profilePic .= '		
												   
												   <button style="margin-top:10px !important;" type="submit" 
												   class="btn btn-set makeProfilePic"
												   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

												   <button style="margin-top:10px !important;" type="submit" 
												   class="btn btn-set makeWallPic"
												   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>';
											  }
											   $profilePic .= ' <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_fi.'">
												  <i class="fa fa-camera"></i> View Picture</a>
											  </figcaption> --> 
										  
									  </li>';
							
							
							}
							
							$postMessage = "<div class='fb-user-top-title'><h4 class='fb-user-top-title'> 
							Changed $genderVerb Profile Picture </h4></div>
												  <ul class='grid cs-style-1 $post_id'>

													$profilePic 
												 </ul>";
							
							
							$post_Edit = $foreal;
							$checkEdit = $foreal;
							
						
						}elseif($post_type == $foVal) {
						

							if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){
							
								$wallPic = '
								
									  <li>
										  
										  
											 <img src="'.$forumPicExt.$post_img_fi.'" alt="'.$post_img_fi.'"  />
											  <!--  <figcaption>
											 
											  <h3></h3>';
											  if($checkPostAuthor == true){
											  $wallPic .= '		
												   
												   <button style="margin-top:10px !important;" type="submit" 
												   class="btn btn-set makeProfilePic"
												   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

												   <button style="margin-top:10px !important;" type="submit" class="btn 
												   btn-set makeWallPic"
												   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>';
											  }
											   $wallPic .= ' <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_fi.'">
												  <i class="fa fa-camera"></i> View Picture</a>
											  </figcaption> --> 
										  
									  </li>';
							
							
							}
							
							$postMessage = "<div class='fb-user-top-title'><h4 class='fb-user-top-title'> 
							Changed $genderVerb Wall Cover Picture </h4></div>
												  <ul class='grid cs-style-1 $post_id'>

													$wallPic 
												 </ul>";
							
							
							$post_Edit = $foreal;
							$checkEdit = $foreal;
							
						
						
						}else{
						
							$postMessage = $post_msg;
						
						}
						
							
						if(($checkPostAuthor == true) ){ //|| ($_SESSION['wallComRank'] == $seVal)
						
							if ($checkEdit == $i_false){
							
								$show_detele = '<div class="fb-user-tasks">
								<a href="javascript:;" class="post-delete-btn " id="FDel-'.$post_id.'"> <i class="fa  fa-times"></i>  </a>  
								<br />
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
							class="sendMailPosts fb-time-action-like"> <i class="fa fa-envelope"></i> <strong> <span class="hide-res">Send Message</span> 
							</strong></a>
							
							<span>-</span> <a href="javascript:;" title="Report User" id="sendReportPosts-'.$post_id.'-'.$author_id.'" 
							class="sendReportPosts fb-time-action-like"> <i class="fa fa-comments"></i> <strong> <span class="hide-res">Report User</span> 
							</strong></a>
							<span id="mailReportPostsMsg_'.$post_id.'"></span> <span id="mailReportPostsDiv_'.$post_id.'"> </span>';

						
						}
						
						
						$showSlideUp = '<a href="javascript:;" style = "float:right; display:none;" title="Slide Up" 
						id="slideCommentsDiv-'.$post_id.'" 
						class="slideCommentsDiv clearfix"> <i class="fa  fa-chevron-up"></i> </a>';
						
						if ( (is_null($prof_pic)) || ($prof_pic == '-') || (!file_exists($forumPicExt.$prof_pic)) ){
							$stuFpic = $wizGradeDefaultPic; }
						
						else { $stuFpic = $forumPicExt.$prof_pic; }
						
						$stuPic = '<img src="'.$stuFpic.'" class="poster-img" />';
											
						$post_row_id =  "post_".$post_id;
						
						$edit_row_id =  "editPost_".$post_id;	
					
					
$posts =<<<IGWEZE

                    <section class="panel fb-user-div" id= "$post_row_id">
					  
                        <div class="panel-body">
						
                              <div class="fb-user-thumb">
                                  <a href="javascript:;" class="showcompanionWallUser" 
								  id="companionWallUser-$member_id">$stuPic</a>  
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
					
						companionWallComments($conn, $post_id);
					
						echo'</div></div></div>';					
						echo ' </section>';
						
						$post_msg =''; $checkPostAuthor = '';
						$fi_upload =''; $se_upload ='';$th_upload =''; $fo_upload ='';  $changeProfPic = '';
					
					}
						echo '</div>';	
						
					if($rows_count > $cWallNumPerPage){
							
							if($rows_count >= $i_false) {

								$paginationCount = getPagination($rows_count, $cWallNumPerPage);
								$lastPage = $paginationCount - 1;

								$pagiNav .='<ul class="tsc_pagination tsc_paginationA tsc_paginationA12">
											<li>
											<a  href="javascript:;" class="softPaginate first current" id="softPaginate-0-'.$loadType.'">F i r s t</a>
											</li>';
											for($i=0;$i<$paginationCount;$i++){
				
											$pagiNav .='<li>
												<a  href="javascript:;" class="softPaginate" id="softPaginate-'.$i.'-'.$loadType.'">
											'.($i+1).'
											</a>
											</li>';
											}
				
								$pagiNav .='<li>
											<a href="javascript:;" class="softPaginate last" id="softPaginate-'.$lastPage.'-'.$loadType.'">L a s t</a>
											</li>
											<li class="flash"></li>
											</ul>';
											
								echo $pagiNav;
							
							}
							
					

					}else{

						echo $infoMsg.$msg_e.$iEnd; //exit; 			
			
					}

		 
				}
			}	

			function userCompanionWall($conn, $userID) {  /* show a student companion wall post */
			 
				global $cWallPostTB, $foreal, $wizGradeTemplate, $forumPicExt, $fiVal, $seVal, $thVal, $foVal, $regNum, $wizGradeDefaultPic, 
				$succesMsg, $errorMsg, $warningMsg, $infoMsg,  $sEnd, $eEnd, $iEnd, $wEnd, $cWallNumPerPage;
				$changeProfPic = '';

		 		$ebele_mark = "SELECT post_id
		 
                     		     FROM $cWallPostTB  
								 
								 WHERE author_id = :author_id 
								 
								 ORDER BY post_id DESC";
					 
 			
			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':author_id', $userID);	
				
				$igweze_prep->execute();
				$rows_count = $igweze_prep->rowCount();

		 		$ebele_mark_1 = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, post_img_th, post_img_fo, 
		 				post_date, post_ip, post_type

                     		     FROM $cWallPostTB  
								 
								 WHERE author_id = :author_id 
								 
								 ORDER BY post_id DESC
								 
								 LIMIT $cWallNumPerPage";
					 
 			
			    $igweze_prep_1 = $conn->prepare($ebele_mark_1);
				$igweze_prep_1->bindValue(':author_id', $userID);				
				 
 				$igweze_prep_1->execute();
				
				$rows_count_1 = $igweze_prep_1->rowCount(); 
				
				if($rows_count_1 >= $foreal) {
					
					echo '<div id="paginatePCWDiv">';		
					
					while($row = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {		
	   
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
						
						$post_date = wallTimerBoy($post_time);						
						$post_msg = htmlspecialchars_decode($post_msg);						
						$post_Edit = $post_msg;						
						$post_msg = nl2br($post_msg);
						
						$checkEdit = $i_false;
						
						$thisUserInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);						
						list ($this_user_id, $faRegNum_this, $m_name_this, $m_sex_this, $prof_pic_comm) = explode ("##", $thisUserInfo);	
						
						$memberInfo = companionWallUserDetails($conn, $author_id, $fiVal);					
						list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
						
						$genderVerb = genderVerb($m_sex);
						
						$postLikes = companionWallLikes($conn, $post_id, $member_id);
						
						$postLikesMore = companionWallMoreLikes($conn, $post_id, $member_id); 
						
						$commentDiv = commentsNum($conn, $post_id);
						
						if($post_type == $seVal) {
						
							if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){
							
								$fi_upload = '
							
								  <li>
									  
									  
										 <img src='.$forumPicExt.$post_img_fi.' Class ="uploadPicDi"  />
										  <!-- <figcaption>
										 
										  <h3></h3>
											   
											 <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
											   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeWallPic"
											   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>
											   
											  <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_fi.'">
											  <i class="fa fa-camera"></i> View Picture</a>
										  </figcaption> --> 
									  
								  </li>';

							
							}
							
							if (($post_img_se != '') && (file_exists($forumPicExt.$post_img_se))){
							
								$se_upload = '
							
								  <li>
									  
									  
										 <img src='.$forumPicExt.$post_img_se.' Class ="uploadPicDi"  />
										  <!-- <figcaption>
										 
										  <h3></h3>
											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
											   id="'.$post_img_se.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeWallPic"
											   id="'.$post_img_se.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>
												  
											  <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_se.'">
											  <i class="fa fa-camera"></i> View Picture</a>
										  </figcaption> --> 
									  
								  </li>';

							}
							
							if (($post_img_th != '') && (file_exists($forumPicExt.$post_img_th))){
							
								$th_upload = '

								  <li>
									  
									  
										 <img src='.$forumPicExt.$post_img_th.' Class ="uploadPicDi"  />
										  <!-- <figcaption>
										 
										  <h3></h3>
											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
											   id="'.$post_img_th.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeWallPic"
											   id="'.$post_img_th.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>
												  
											  <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_th.'">
											  <i class="fa fa-camera"></i> View Picture</a>
										  </figcaption> --> 
									  
								  </li>';

							}
							
							if (($post_img_fo != '') && (file_exists($forumPicExt.$post_img_fo))){
							
								$fo_upload = '

								  <li>
									  
									  
										 <img src='.$forumPicExt.$post_img_fo.' Class ="uploadPicDi"  />
										  <!-- <figcaption>
										 
										  <h3></h3>
											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
											   id="'.$post_img_fo.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeWallPic"
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
						

							if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){
							
								$profilePic = '
								
								  <ul class="grid cs-style-1">
									  <li>
										  
										  
											 <img src='.$forumPicExt.$post_img_fi.' Class ="uploadPicDi"  />
											  <!--  <figcaption>
											 
											  <h3></h3>
												<button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
												   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

												   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeWallPic"
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
						
						if ( (is_null($prof_pic)) || ($prof_pic == '-') || (!file_exists($forumPicExt.$prof_pic)) ){ $stuFpic = $wizGradeDefaultPic; }
						
						else { $stuFpic = $forumPicExt.$prof_pic; }
						
						$stuPic = '<img src="'.$stuFpic.'" class="poster-img" />';
											
						$post_row_id =  "post_".$post_id;
						
						$edit_row_id =  "editPost_".$post_id;	
						
					
$posts =<<<IGWEZE

                      <section class="panel fb-user-div" id= "$post_row_id">
                          <div class="panel-body">
                              <div class="fb-user-thumb">
                                  <a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-$member_id">$stuPic</a>  
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
				
					companionWallComments($conn, $post_id);
				
					echo'</div></div></div>';					
					echo ' </section>';
					
					$post_msg ='';
					$fi_upload =''; $se_upload ='';$th_upload =''; $fo_upload ='';  $changeProfPic = '';
				
				}
				
					echo '</div>';		

					if($rows_count >= $i_false) {

						$paginationCount = getPagination($rows_count, $cWallNumPerPage);
						$lastPage = $paginationCount - 1;
						if($rows_count > $cWallNumPerPage){

							$pagiNav .='<ul class="tsc_pagination tsc_paginationA tsc_paginationA12">
										<li>
										<a  href="javascript:;" class="softPaginatePCW first current" id="softPaginatePCW-0-'.$member_id.'">
										F i r s t</a>
										</li>';
										
										for($i=0;$i<$paginationCount;$i++){
			
										$pagiNav .='<li>
											<a  href="javascript:;" class="softPaginatePCW" id="softPaginatePCW-'.$i.'-'.$member_id.'">
										'.($i+1).'
										</a>
										</li>';
										}
			
							$pagiNav .='<li>
										<a href="javascript:;" class="softPaginatePCW last" id="softPaginatePCW-'.$lastPage.'-'.$member_id.'">
										L a s t</a>
										</li>
										<li class="flash"></li>
										</ul>';
									
						echo $pagiNav;
						
						}
						
					}
				
				

				}else{
				
					$msg = "Ooooops, there is no post to display. . . . . . You are Fabulous";

					echo $infoMsg.$msg.$iEnd; //exit; 			
		
				}

		 
			}


			function companionWallAlerts($conn, $postID) {  /* show companion wall notification */
			 
				global $cWallPostTB, $foreal, $wizGradeTemplate, $forumPicExt, $fiVal, $seVal, $thVal, $foVal, $regNum, $wizGradeDefaultPic, 
				$succesMsg, $errorMsg, $warningMsg, $infoMsg,  $sEnd, $eEnd, $iEnd, $wEnd, $cWallNumPerPage;
				$changeProfPic = '';
		 

		 		$ebele_mark = "SELECT post_id, author_id, post_title, post_msg, post_img_fi, post_img_se, post_img_th, post_img_fo, 
		 				post_date, post_ip, post_type

                     		     FROM $cWallPostTB  
								 
								 WHERE post_id = :post_id";
 			
			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindParam(':post_id', $postID, PDO::PARAM_INT);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
						
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
						
						$post_date = wallTimerBoy($post_time);
						
						$post_msg = htmlspecialchars_decode($post_msg);
						
						$post_Edit = $post_msg;
						
						$post_msg = nl2br($post_msg);
						
						$checkEdit = $i_false;
						
						$thisUserInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);
						
						list ($this_user_id, $faRegNum_this, $m_name_this, $m_sex_this, $prof_pic_comm) = explode ("##", $thisUserInfo);	
						
						$memberInfo = companionWallUserDetails($conn, $author_id, $fiVal);
					
						list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
						
						$genderVerb = genderVerb($m_sex);
						
						$postLikes = companionWallLikes($conn, $post_id, $member_id);
						
						$postLikesMore = companionWallMoreLikes($conn, $post_id, $member_id); 
						
						$commentDiv = commentsNum($conn, $post_id);
					
						if($post_type == $seVal) {
					
							if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){
							
								$fi_upload = '
							
								  <li>
									  
									  
										 <img src='.$forumPicExt.$post_img_fi.' Class ="uploadPicDi"  />
										  <!-- <figcaption>
										 
										  <h3></h3>
											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
											   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeWallPic"
											   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>
												  
											  <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_fi.'">
											  <i class="fa fa-camera"></i> View Picture</a>
										  </figcaption> --> 
									  
								  </li>';

							
							}
							
							if (($post_img_se != '') && (file_exists($forumPicExt.$post_img_se))){
							
								$se_upload = '
							
								  <li>
									  
									  
										 <img src='.$forumPicExt.$post_img_se.' Class ="uploadPicDi"  />
										  <!-- <figcaption>
										 
										  <h3></h3>
											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
											   id="'.$post_img_se.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeWallPic"
											   id="'.$post_img_se.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>
												  
											  <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_se.'">
											  <i class="fa fa-camera"></i> View Picture</a>
										  </figcaption> --> 
									  
								  </li>';

							}
							
							if (($post_img_th != '') && (file_exists($forumPicExt.$post_img_th))){
							
								$th_upload = '

								  <li>
									  
									  
										 <img src='.$forumPicExt.$post_img_th.' Class ="uploadPicDi"  />
										  <!-- <figcaption>
										 
										  <h3></h3>
											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
											   id="'.$post_img_th.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeWallPic"
											   id="'.$post_img_th.'"> <i class="fa fa-picture-o"></i> Set as Wall Picture </button>
												  
											  <a class="fancybox" rel="group" href="'.$forumPicExt.$post_img_th.'">
											  <i class="fa fa-camera"></i> View Picture</a>
										  </figcaption> --> 
									  
								  </li>';

							}
							
							if (($post_img_fo != '') && (file_exists($forumPicExt.$post_img_fo))){
							
								$fo_upload = '

								  <li>
									  
									  
										 <img src='.$forumPicExt.$post_img_fo.' Class ="uploadPicDi"  />
										  <!-- <figcaption>
										 
										  <h3></h3>
											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
											   id="'.$post_img_fo.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

											   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeWallPic"
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
						

							if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){
							
								$profilePic = '
								
								  <ul class="grid cs-style-1">
									  <li>
										  
										  
											 <img src='.$forumPicExt.$post_img_fi.' Class ="uploadPicDi"  />
											 <!--  <figcaption>
											 
											  <h3></h3>
												   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeProfilePic"
												   id="'.$post_img_fi.'"> <i class="fa fa-picture-o"></i> Set as Profile Picture </button>

												   <button style="margin-top:10px !important;" type="submit"  class="btn btn-set makeWallPic"
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
						
						
						}elseif($post_type == $foVal) {
						

						if  (($post_img_fi != '') && (file_exists($forumPicExt.$post_img_fi))){
						
							$wallPic = '
							
								  <li>
									  
									  
										 <img src="'.$forumPicExt.$post_img_fi.'" alt="'.$post_img_fi.'"  />
										  <!-- <figcaption>
										 
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
						
						if ( (is_null($prof_pic)) || ($prof_pic == '-') || (!file_exists($forumPicExt.$prof_pic)) ){ $stuFpic = $wizGradeDefaultPic; }
						
						else { $stuFpic = $forumPicExt.$prof_pic; }
						
						$stuPic = '<img src="'.$stuFpic.'" class="poster-img" />';
											
						$post_row_id =  "post_".$post_id;
						
						$edit_row_id =  "editPost_".$post_id;	
						
					
$posts =<<<IGWEZE

                      <section class="panel fb-user-div" id= "$post_row_id">
                          <div class="panel-body">
                              <div class="fb-user-thumb">
                                  <a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-$member_id">$stuPic</a>  
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
								  
					<div class = "commentDivPostSub clearfix" id = "commentDivSub-$post_id">
					
IGWEZE;
					echo $posts;
				
					companionWallComments($conn, $post_id);
				
					echo'</div></div></div>';					
					echo ' </section>';
					
					$post_msg ='';
					$fi_upload =''; $se_upload ='';$th_upload =''; $fo_upload ='';  $changeProfPic = '';
				
				}
				
				
				

				}else{
				
					$msg = "Ooooops, something went wrong while retrieving post or the post might have been deleted. . . . . . Please try again";

					echo $infoMsg.$msg.$iEnd; //exit; 			
		
				}
				
				

		 
			}

		 
			function companionWallLikes($conn, $post_id, $check_user) {  /* show companion wall post likes & dislike */
		 		
				global $cWallLikesTB, $foreal;
		 
		 		$ebele_mark = "SELECT likes_id, post_id, member_id
				
								FROM $cWallLikesTB
				
							  WHERE post_id = :post_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				
				$igweze_prep->bindValue(':post_id', $post_id);
				 
 				$igweze_prep->execute();
				
				$memberArrays = array();	   
	   			array_unshift($memberArrays,"");
	   			unset($memberArrays[0]);
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
					
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$member_id = $row['member_id'];					
						$memberArrays[] = $member_id;
					
					
					}

					$memberArrays = array_unique($memberArrays);
					
					
					if($rows_count > $foreal){ $like = ' likes';  }
					else {$like = ' like';} 

					if(in_array($check_user, $memberArrays)){	

						$show_like = '
						<span  class="dislikePosts fb-time-action-like" 
						id="dislikePosts-'.$post_id.'"><i class="fa fa-thumbs-o-up"></i> '.$rows_count.'<strong> Dislike </strong></span>';

					}else{
					
						$show_like = '
						<span  class="likePosts fb-time-action-like" id="likePosts-'.$post_id.'"> <i class="fa fa-thumbs-o-up"></i> '.$rows_count.' 
						<strong>'.$like.'</strong></span>';
					
					}
					
				}else{
				
						$rows_count = '';
						$show_like = '<span  class="likePosts fb-time-action-like" id="likePosts-'.$post_id.'"><i class="fa fa-thumbs-o-up"></i> '
						.$rows_count.'		<strong>Like</strong></span>';
					 
				
				}
				
				
				return $show_like;					

		 
			}
		 

			function companionWallMoreLikes($conn, $fpost_id, $check_user) {  /* show more companion wall post likes & dislike */
		 		
					global $cWallLikesTB, $foreal, $fiVal, $foVal;
			 
					$ebele_mark = "SELECT member_id
					
									FROM $cWallLikesTB
					
								  WHERE post_id = :post_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					
					$igweze_prep->bindValue(':post_id', $fpost_id);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					$memberArrays = array();	   
					array_unshift($memberArrays,"");
					unset($memberArrays[0]);
					
					if($rows_count >= $foreal) {
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$member_id = $row['member_id'];					
							$memberArrays[] = $member_id;				
						
						}

						$memberArrays = array_unique($memberArrays);					
						$count = count($memberArrays);
						
						$moreLink = ' <span> like this</span>';
						if($count > $foVal) { $moreLike = ($count - $foVal); $moreLink = '<span>and</span> 
						<a href="javascript:;">'.$moreLike.' more </a> <span>like this</span>'; 
											$count = $foVal;}
						
						
						if(in_array($check_user, $memberArrays)) { 
						
							$likePpl = '<a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-'.$check_user.'">You</a>, '; 
						}

						for($i = $fiVal; $i <= $count; $i++) {
							
							$memberID = $memberArrays[$i]; 
							
							if($memberID == $check_user){
								
							
							}else{
								
								$memberInfo = companionWallUserDetails($conn, $memberID, $fiVal);
						
								list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);	

								if($m_name != '-'){
									$likePpl .= '<a href="javascript:;" class="showcompanionWallUser" 
									id="companionWallUser-'.$member_id.'">'.$m_name.'</a>, ';
								}
								
								$memberInfo = ''; $memberID = '';
							
							}
						}
						
						$pplLikes = $likePpl; 
						$likesTrim = trim($pplLikes, ', ');
						
						$likes = $likesTrim.$moreLink;
						return $likes;
						

					}
		 
		 	}

			function companionWallComments($conn, $post_id) {  /* load companion wall post comment */
			 
					global $cWallCommentTB, $foreal, $fiVal, $seVal, $wizGradeTemplate, $forumPicExt, $wizGradeDefaultPic, $wallPicLoader;
				 
					$comment_head = '<ul class="fb-comments">	';
								  
					echo $comment_head;	
				 
					$thisUserInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);
							
					list ($this_user_id, $faRegNum_this, $m_name_this, $m_sex_this, $prof_pic_comm) = explode ("##", $thisUserInfo);	

					if ( (is_null($prof_pic_comm)) || ($prof_pic_comm == '-') || (!file_exists($forumPicExt.$prof_pic_comm)) ){ 
					$stuUserpic = $wizGradeDefaultPic; }
							
					else { $stuUserpic = $forumPicExt.$prof_pic_comm; }
							
							
					$stuPicUser = '<img src="'.$stuUserpic.'" class="poster-imga" />';
			  
			 
					$ebele_mark = "SELECT comment_id, post_id, comment, comment_title, comment_pic, comment_date, comment_user	

									 FROM $cWallCommentTB 
									 
									 WHERE post_id = :post_id
									 
									 ORDER BY comment_id ASC";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					
					$igweze_prep->bindValue(':post_id', $post_id);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count >= $foreal) {
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
			   
							$comment_id = $row['comment_id'];
							$post_id = $row['post_id'];
							$comment = $row['comment'];
							$comment_title = $row['comment_title'];
							$comment_pic = $row['comment_pic'];
							$comment_date = $row['comment_date'];
							$comment_user = $row['comment_user'];
							
							$comment = htmlspecialchars_decode($comment);
							
							$comment_Edit = $comment;
							$comment = nl2br($comment);
												
							$comment_time = wallTimerBoy($comment_date);
							
							$memberInfo = companionWallUserDetails($conn, $comment_user, $fiVal);
							
							list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
							
							$commenrLikes = companionWallComLikes($conn, $comment_id, $this_user_id);
							
							if($this_user_id == $comment_user) {
							
								$show_detele = '<div class="fb-user-tasks">
						  
								<a href="javascript:;" class="comment-delete-btn" id="delC-'.$comment_id.'-'.$post_id.'"> <i class="fa  fa-times"></i> </a> 
								<br />
								<a href="javascript:;" class="comment-edit-btn" id="editC-'.$comment_id.'_'.$post_id.'"> <i class="fa  fa-edit"></i> </a> 
								
								
								</div>';
							
							}else{
								
								$show_detele = '';
								$showMailReportBox = '<span>-</span> <a href="javascript:;" title="Send Message" 
								id="sendMailComments-'.$post_id.'-'.$comment_id.'-'.$comment_user.'" 
								class="sendMailComments fb-time-action-like"> <i class="fa fa-envelope"></i> <strong> <span class="hide-res">Send Message</span> </strong></a>
								
								
								<span>-</span> <a href="javascript:;" title="Report User" 
								id="sendReportComments-'.$post_id.'-'.$comment_id.'-'.$comment_user.'" 
								class="sendReportComments fb-time-action-like"> <i class="fa fa-comments"></i> <strong> <span class="hide-res">Report User</span> </strong></a>
								<span id="mailReportCommentsMsg_'.$post_id.'_'.$comment_id.'_'.$comment_user.'"> </span>
								<span id="mailReportCommentsDiv_'.$post_id.'_'.$comment_id.'_'.$comment_user.'"> </span>';
							

							}
							
							
							if ( (is_null($prof_pic)) || ($prof_pic == '-') || (!file_exists($forumPicExt.$prof_pic)) ){ $stuFpic = $wizGradeDefaultPic; }
							
							else { $stuFpic = $forumPicExt.$prof_pic; }
							
							
							$stuPic = '<img src="'.$stuFpic.'" class="comment-imga" />';
																	
							$post_row_id =  "post_".$post_id;
							
							$edit_comment_id =  "editcomment_".$comment_id.'_'.$post_id;		
							
							$comment_row_id =  "comment_".$comment_id;

$commentMsg =<<<IGWEZE

					<li id= "$comment_row_id" class="clearfix"> $show_detele 

					<a href="javascript:;" class="cmt-thumb showcompanionWallUser" id="companionWallUser-$member_id">
                             $stuPic                
                    </a>

					 <div class="cmt-details">
                        <a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-$member_id">$m_name</a>
                         <span id='$edit_comment_id'> $comment </span>
                         <p> $comment_time - <a href="javascript:;" class="like-link"> $commenrLikes </a> $showMailReportBox</p>
						 

                     </div>
                    </li>
									         				
					
IGWEZE;
						echo $commentMsg;
						$showMailReportBox ='';$commenrLikes ='';
				
					}
				

				}else{
				
						#$msg = "Ooooops, You are Fabulous id=frmComment-$post_id | id=commentStatus-$post_id";
						#echo "<center> <div class='msg'> $msg </div></center>";
		
				}
				
						$upload_comment_img = $wizGradeTemplate.'images/upload_icon.png';
				

$comment_body =<<<IGWEZE

			<div id="newCommentDiv-$post_id"></div>				


			<li>
                <a href="javascript:;" class="cmt-thumb showcompanionWallUser hide-resa" id="companionWallUser-$this_user_id">
                   $stuPicUser
                </a>
                <div class="cmt-form">
					<!-- form --><form method="POST" id="frmComment-$post_id">
			
					<textarea  class="form-control commentField-$post_id"  placeholder="Comment on this Post" wrap="hard" 
						name="cwall-comment-div"></textarea>
					<input type="hidden" name="postFData" value="sendCommentFData" />
					<input type="hidden" name="PostID" value="$post_id" />

					<img src="$wallPicLoader" alt="Loading >>>>>" id='commentLoader-$post_id' style="cursor:pointer; float:left; 
					margin:8px 5px 5px 10px; display:none;" />
					<button class="btn btn-danger pull-right commentStatus" id="commentStatus-$post_id">Comment</button> 
					
					</form><!-- / form -->
					
                </div>
				 
				 
            </li> 
									  
			</ul>

            <div class="clearfix"></div> 

IGWEZE;
		 
					echo $comment_body;
			}
		 
		 
			function commentsNum($conn, $post_id) {  /* count number post comments */
			 
					global $cWallCommentTB, $foreal;			 
				 
					$ebele_mark = "SELECT comment_id

									 FROM $cWallCommentTB 
									 
									 WHERE post_id = :post_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);					
					$igweze_prep->bindValue(':post_id', $post_id);					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == 0){ $commment = "<i class='fa fa-comment-o'></i> <strong>0</strong> ";}
					elseif($rows_count == 1){ $commment = "<i class='fa fa-comment-o'></i>  <strong>1</strong> ";}				
					elseif($rows_count >= 2){ $commment = "<i class='fa fa-comment-o'></i> <strong>$rows_count</strong> ";}
					else{$commment = "<i class='fa fa-comment-o'></i>  <strong>0</strong>";}			
					
					return $commment;

			}

			function companionWallComLikes($conn, $comment_id, $check_user) {  /* show companion wall comment likes & dislike */
		 		
					global $cWallLikesTB, $foreal;
			 
					$ebele_mark = "SELECT likes_id, comment_id,  member_id
					
									FROM $cWallLikesTB
					
									WHERE comment_id = :comment_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);				
					$igweze_prep->bindValue(':comment_id', $comment_id);				 
					$igweze_prep->execute();

					$memberArrays = array();	   
					array_unshift($memberArrays,"");
					unset($memberArrays[0]);
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count >= $foreal) {
						
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$member_id = $row['member_id'];					
							$memberArrays[] = $member_id;					
							
						}

						$memberArrays = array_unique($memberArrays);				
				
						if($rows_count > $foreal){ $like = 'likes';  }else {$like = 'like';} 
						
						if(in_array($check_user, $memberArrays)){		
							
							$show_like = '<span  class="disLikeComments fb-time-action-like" id="disLikeComments-'.$comment_id.'">
							<i class="fa fa-thumbs-o-up"></i> '.$rows_count.'<strong> Dislike </strong></span>';

						}else{
						
							$show_like = '<span  class="likeComments fb-time-action-like" id="likeComments-'.$comment_id.'">
							<i class="fa fa-thumbs-o-up"></i> '.$rows_count.' <strong>'.$like.'</strong></span>';
						
						}
						
					}else{
					
						$rows_count = '';
						$show_like = '<span  class="likeComments fb-time-action-like" id="likeComments-'.$comment_id.'">
						<i class="fa fa-thumbs-o-up"></i> '.$rows_count.' <strong>Like</strong></span>';
						 
					
					}
					

					return $show_like;	 
		 
			}

		 
			function uploadTempDetails($conn, $member_id) {  /* upload temporary companion pictures */

					global $cWallTempUploadTB, $foreal, $fiVal;

					$ebele_mark = "SELECT upload_id, upload_pathp

									 FROM $cWallTempUploadTB

										WHERE member_id = :member_id
										
										AND upload_type = :upload_type";
						 
				
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':member_id', $member_id);
					$igweze_prep->bindValue(':upload_type', $fiVal);				 
					$igweze_prep->execute();
									
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count >= $foreal) {
					
						while($row[] = $igweze_prep->fetch(PDO::FETCH_BOTH)) { }	

						if($rows_count == 1){
						
							$picVal = $row[0][1].'@@@';
							
						}elseif($rows_count == 2){
						
							$picVal = $row[0][1].'@'.$row[1][1].'@@';
						
						}elseif($rows_count == 3){
						
							$picVal = $row[0][1].'@'.$row[1][1].'@'.$row[2][1].'@';
						
						}elseif($rows_count == 4){
						
							$picVal = $row[0][1].'@'.$row[1][1].'@'.$row[2][1].'@'.$row[3][1];
						
						}else{
						
							$picVal = '@@@@';
						
						}
						
						$uTempDetails = $rows_count.'@'.$picVal;	
					
					}else{
						
						$rows_count = 0;				
						$uTempDetails = $rows_count.'@'.$picVal;	
			
					}
					
					return $uTempDetails;
		 
			}


			function profPicTempDetails($conn, $member_id) {   /* upload temporary profile companion picture */

					global $cWallTempUploadTB, $foreal, $seVal;

					$ebele_mark = "SELECT upload_id, upload_pathp

									 FROM $cWallTempUploadTB

										WHERE member_id = :member_id
										
										AND upload_type = :upload_type";
						 
				
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':member_id', $member_id);
					$igweze_prep->bindValue(':upload_type', $seVal);					 
					$igweze_prep->execute();
									
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {
					
						while($row = $igweze_prep->fetch(PDO::FETCH_BOTH)) {		
						
							$profPic = $row['upload_pathp'];
							
						}	
						
						$uTempDetails = $profPic;	
					
					}else{
					
					
						$uTempDetails = '';	
			
					}
					
					return $uTempDetails;
			 
			}


			function insertTempUpload($conn, $upload_path, $member_id) {  /* insert companion pictures information */

					global $cWallTempUploadTB, $foreal, $fiVal, $foVal;
								
					$ebele_mark = "SELECT upload_id

									 FROM $cWallTempUploadTB

									 WHERE member_id = :member_id";
						 
				
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':member_id', $member_id);					 
					$igweze_prep->execute();
									
					$rows_count = $igweze_prep->rowCount(); 
					
					if ($rows_count < $foVal){
					
						$ebele_mark_1= "INSERT INTO $cWallTempUploadTB(upload_pathp, member_id, upload_type)

																	VALUES (:upload_pathp, :member_id, :upload_type)";

						$igweze_prep_1 = $conn->prepare($ebele_mark_1);
						$igweze_prep_1->bindValue(':upload_pathp', $upload_path);
						$igweze_prep_1->bindValue(':member_id', $member_id);
						$igweze_prep_1->bindValue(':upload_type', $fiVal);										
						$igweze_prep_1->execute();
					
					}			
					
			}
		 

			function insertTempProfPic($conn, $upload_path, $member_id) {  /* insert companion profile picture information */

					global $cWallTempUploadTB, $foreal, $fiVal, $seVal;
							
					$ebele_mark = "SELECT upload_id

									 FROM $cWallTempUploadTB

									 WHERE member_id = :member_id";						 
				
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':member_id', $member_id);					 
					$igweze_prep->execute();
									
					$rows_count = $igweze_prep->rowCount(); 
					
					if ($rows_count < $fiVal){
					
						$ebele_mark_1= "INSERT INTO $cWallTempUploadTB(upload_pathp, member_id, upload_type)

																	VALUES (:upload_pathp, :member_id, :upload_type)";

						$igweze_prep_1 = $conn->prepare($ebele_mark_1);
						$igweze_prep_1->bindValue(':upload_pathp', $upload_path);
						$igweze_prep_1->bindValue(':member_id', $member_id);
						$igweze_prep_1->bindValue(':upload_type', $seVal);										
						$igweze_prep_1->execute();
					
					}		
			 
			}
		 
			function removeTempUpload($conn, $member_id, $status) {  /* remove temporary companion pictures information */

					global $cWallTempUploadTB, $foreal, $forumPicExtTem;
							
					if($status == 'deleteTempPic'){
					
						$tempDetails = uploadTempDetails($conn, $member_id);	
						
						$tempProfPic = profPicTempDetails($conn, $member_id);	
															
						list ($count, $fi_img, $se_img, $th_img, $fo_img) = explode ("@", $tempDetails);
					
						if($fi_img == ''){ $fi_img = 'hmmmmmmmmmmmm004.jpg';}
						if($se_img == ''){ $se_img = 'hmmmmmmmmmmmm004.jpg';}
						if($th_img == ''){ $th_img = 'hmmmmmmmmmmmm004.jpg';}
						if($fo_img == ''){ $fo_img = 'hmmmmmmmmmmmm004.jpg';}
						if($tempProfPic == ''){ $tempProfPic = 'hmmmmmmmmmmmm004.jpg';}
						if(file_exists($forumPicExtTem.$fi_img)){ unlink($forumPicExtTem.$fi_img); }
						if(file_exists($forumPicExtTem.$se_img)){ unlink($forumPicExtTem.$se_img); }
						if(file_exists($forumPicExtTem.$th_img)){ unlink($forumPicExtTem.$th_img); }
						if(file_exists($forumPicExtTem.$fo_img)){ unlink($forumPicExtTem.$fo_img); }
						if(file_exists($forumPicExtTem.$tempProfPic)){ unlink($forumPicExtTem.$tempProfPic); }
						
					}	
				
					
					$ebele_mark = "DELETE FROM $cWallTempUploadTB
					
									WHERE member_id = :member_id ";

					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':member_id', $member_id);									
					$igweze_prep->execute();
									
			 
			}

			function unlinkTempUpload($conn, $member_id, $post_id) {  /* remove temporary companion pictures information */
			 
					global $cWallPostTB, $wizGradeCWallTB, $foreal, $forumPicExt, $fiVal, $seVal; 

					 
					$ebele_mark = "SELECT  post_img_fi, post_img_se, post_img_th, post_img_fo, post_type

									 FROM $cWallPostTB  
									 
									 WHERE post_id = :post_id";
						 
				
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':post_id', $post_id);					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$post_type = $row['post_type']; 
							$post_img_fi = $row['post_img_fi'];
							$post_img_se = $row['post_img_se'];
							$post_img_th = $row['post_img_th'];
							$post_img_fo = $row['post_img_fo'];
							$post_type = $row['post_type'];
						
						}

						
						if($post_type == $fiVal){
						
							if($post_img_fi == ''){ $post_img_fi = 'hmmmmmmmmmmmm004.jpg';}
							if($post_img_se == ''){ $post_img_se = 'hmmmmmmmmmmmm004.jpg';}
							if($post_img_th == ''){ $post_img_th = 'hmmmmmmmmmmmm004.jpg';}
							if($post_img_fo == ''){ $post_img_fo = 'hmmmmmmmmmmmm004.jpg';}
							if(file_exists($forumPicExt.$post_img_fi)){ unlink($forumPicExt.$post_img_fi); }
							if(file_exists($forumPicExt.$post_img_se)){ unlink($forumPicExt.$post_img_se); }
							if(file_exists($forumPicExt.$post_img_th)){ unlink($forumPicExt.$post_img_th); }
							if(file_exists($forumPicExt.$post_img_fo)){ unlink($forumPicExt.$post_img_fo); }

						
						}
						
						if($post_type == $seVal){
						
							$DelPic = '';
						
							/*$ebele_mark_1 = "UPDATE $wizGradeCWallTB 
									
									SET 
									
									profile_pic = :profile_pic
									
									WHERE member_id = :member_id";

							$igweze_prep_1 = $conn->prepare($ebele_mark_1);
							$igweze_prep_1->bindValue(':profile_pic', $DelPic);
							$igweze_prep_1->bindValue(':member_id', $member_id);
							$igweze_prep_1->execute();*/

							if($post_img_fi == ''){ $post_img_fi = 'hmmmmmmmmmmmm004.jpg';}
							if(file_exists($forumPicExt.$post_img_fi)){ unlink($forumPicExt.$post_img_fi); }

						
						}
						
					}

			}	

			function wallTimerBoy($session_time) {  /* companion wall time ago */
	 
					$time_difference = time() - $session_time ; 
					$seconds = $time_difference ; 
					$minutes = round($time_difference / 60 );
					$hours = round($time_difference / 3600 ); 
					$days = round($time_difference / 86400 ); 
					$weeks = round($time_difference / 604800 ); 
					$months = round($time_difference / 2419200 ); 
					$years = round($time_difference / 29030400 ); 

					if($seconds <= 60)	{	$time = "$seconds seconds ago";  }
					
					else if($minutes <=60){ 
					
						if($minutes == 1) { $time = "one minute ago"; }
						else {  $time = "$minutes minutes ago";  }
					}
					else if($hours <=24) {
						if($hours==1) {  $time = "one hour ago"; }
						else {  $time = "$hours hours ago";  }
					}
					else if($days <=7) { 
						if($days==1) { $time = "one day ago"; }
						else { $time = "$days days ago"; }
					}
					else if($weeks <=4) {
						if($weeks==1) {  $time = "one week ago"; }
						else  {  $time = "$weeks weeks ago"; }
					}
					else if($months <=12) {
						if($months==1) { $time = "one month ago"; }
						else { $time = "$months months ago"; }
					}
					else {
						if($years==1){ $time = "one year ago"; }
						else{$time = "$years years ago";}
					}
					
					
					return $time;

			} 


			function getExtension($str) {  /* retrieve file extensions */

					$i = strrpos($str,".");
					if (!$i) { return ""; } 

					$l = strlen($str) - $i;
					$ext = substr($str,$i+1,$l);
					 return $ext;
			}
		
		
			function genderVerb($gender){  /* gender verb */
		
					global $fiVal, $seVal;
			
					if($gender == $fiVal){
			
						$genderVerb = 'her';
			
					}elseif($gender == $seVal){
			
						$genderVerb = 'his';
			
					}else{
					
						$genderVerb = '';
					
					}
						return $genderVerb;
			}


			function companionInbox($conn, $member_id, $inboxType, $mailoffSetVal) {  /* load companion inbox information */

				global $wizGradeMailBoxTB, $foreal, $forumPicExt, $fiVal, $seVal, $thVal, $foVal, $regNum, $wizGradeDefaultPic, $succesMsg, 
				$errorMsg, $warningMsg, $infoMsg,  $sEnd, $eEnd, $iEnd, $wEnd;
				
				if (($inboxType != '') && ($inboxType != $fiVal)){
					
						$ebele_mark = "SELECT msg_id
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE njnk_reps_id = :njnk_reps_id
										
										AND  njnk_type = :njnk_type";

						$igweze_prep = $conn->prepare($ebele_mark);	 
						$igweze_prep->bindValue(':njnk_reps_id', $member_id);
						$igweze_prep->bindValue(':njnk_type', $inboxType);
						
				}else{

						$ebele_mark = "SELECT msg_id
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE njnk_reps_id = :njnk_reps_id
										
										AND  njnk_type = :njnk_type";

						$igweze_prep = $conn->prepare($ebele_mark);	 
						$igweze_prep->bindValue(':njnk_reps_id', $member_id);
						$igweze_prep->bindValue(':njnk_type', $fiVal); 
				
				}
						
						$igweze_prep->execute();
				
						$totalCount = $igweze_prep->rowCount(); 
					

						if($totalCount <= 10){

				  			$nextPage = $totalCount;
				  			$pagiDetail = '1 - '.$nextPage;

							echo  "<script type='text/javascript'> $('.prevMailBtn').fadeOut(10);  $('.nextMailBtn').fadeOut(10); 
												   				   $('#pagiDetailsDiv').html('$pagiDetail');
				  				   </script>";
				  
						}
				
				if ($inboxType == $thVal){
					
						$btnSelectMsg = '<div class="btn-group" >
											 <a class="btn mini all" href="javascript:;" data-toggle="dropdown">
												 All
												
											 </a>
											
										 </div>';
										 
						$btnSelectAction = ' <ul class="dropdown-menu">

												 <li><a href="javascript:;" id="deleteMsg"><i class="fa fa-trash-o"></i> Delete Draft</a></li>
											 </ul>';	
											 
				}elseif ($inboxType == $foVal){
					
					
						$btnSelectMsg = '<div class="btn-group" >
										 <a class="btn mini all" href="javascript:;" data-toggle="dropdown">
											 All
											 <i class="fa fa-angle-down"></i>
										 </a>
										 <ul class="dropdown-menu" id="markMsgBtn">
											
											 <li><a href="javascript:;" id="selectReadMsg"><i class="fa fa-check-square-o"></i> Read Message</a></li>
											 <li><a href="javascript:;" id="selectUnReadMsg"><i class="fa fa-pencil"></i> Unread Message</a></li>
											 <li><a href="javascript:;" id="selectAdminMsg"><i class="fa fa-user"></i> Admin Message</a></li>
											  
										 </ul>
									 </div>';
						$btnSelectAction = ' <ul class="dropdown-menu">
										 <li><a href="javascript:;" id="markRead"><i class="fa fa-check-square-o"></i> Mark as Read</a></li>
										 <li><a href="javascript:;" id="markUnread"><i class="fa fa-pencil"></i> Mark as Unread</a></li>
										 <li class="divider"></li>
										 <li><a href="javascript:;" id="moveMsgInbox"><i class="fa fa-undo"></i> Move to Inbox</a></li>
										 <li><a href="javascript:;" id="deleteMsg"><i class="fa fa-trash-o"></i> Delete Mail</a></li>
									 </ul>';
								 
				}else{
					
					
					$btnSelectMsg = '<div class="btn-group" >
                                     <a class="btn mini all" href="javascript:;" data-toggle="dropdown">
                                         Select All
                                         <i class="fa fa-angle-down"></i>
                                     </a>
                                     <ul class="dropdown-menu" id="markMsgBtn">
                                        
                                         <li><a href="javascript:;" id="selectReadMsg"><i class="fa fa-check-square-o"></i> Read Message</a></li>
                                         <li><a href="javascript:;" id="selectUnReadMsg"><i class="fa fa-pencil"></i> Unread Message</a></li>
										 <li><a href="javascript:;" id="selectAdminMsg"><i class="fa fa-user"></i> Admin Message</a></li>
										  
                                     </ul>
                                 </div>';
					$btnSelectAction = ' <ul class="dropdown-menu">
                                     <li><a href="javascript:;" id="markRead"><i class="fa fa-check-square-o"></i> Mark as Read</a></li>
                                     <li><a href="javascript:;" id="markUnread"><i class="fa fa-pencil"></i> Mark as Unread</a></li>
                                     <li class="divider"></li>
                                     <li><a href="javascript:;" id="moveMsgToTrash"><i class="fa fa-trash-o"></i> Trash Mail </a></li>
                                 </ul>';
					
				}

$nkiruMsgBoxHead =<<<IGWEZE

					<div id="inboxType" class="display-none">$inboxType</div>
					<div id="memberID" class="display-none">$member_id</div>
					<div id="totalCount" class="display-none">$totalCount</div>
                      <div class="inbox-body" id="inboxmsgBoxDiv">
                         <div class="mail-option">
                             <div class="chk-all">
                                 <input type="checkbox" class="mail-checkbox mail-group-checkbox" id="selectAll">
                                 $btnSelectMsg
                             </div>

                             <div class="btn-group">
                                 <a class="btn mini tooltips showInbox" href="javascript:;" data-toggle="dropdown" data-placement="top" 
								 data-original-title="Refresh"
								 id="showInboxMsg-$member_id">
                                     <i class=" fa fa-refresh"></i>
                                 </a>
                             </div>
                             <div class="btn-group hidden-phone">
                                 <a class="btn mini blue tasksBtn" href="javascript:;" data-toggle="dropdown">
                                     Tasks
                                     <i class="fa fa-angle-down "></i>
                                 </a>
                                
								$btnSelectAction
								
                             </div>
                             
							<div id="prevPageDiv" class="display-none"></div>
							<div id="nextPageDiv" class="display-none">10</div>
                             <ul class="unstyled inbox-pagination">
                                 <li><span id="pagiDetailsDiv">1-10</span><span> of $totalCount</span></li>
                                 <li>
                                     <a href="javascript:;" class="np-btn prevMailBtn" style="display: none;">
									 <i class="fa fa-angle-left pagination-left"></i>
									 </a>
                                 </li>
                                 <li>
                                     <a href="javascript:;" class="np-btn nextMailBtn"><i class="fa fa-angle-right pagination-right"></i>
									 </a>
                                 </li>
                             </ul>
                         </div>

				<div id="paginateMailDiv">
				<table class="table table-inbox table-hover">
				<tbody>
		
							

IGWEZE;


				if (($inboxType != '') && ($inboxType != $fiVal)){
					
						$ebele_mark_1 = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, njnk_type
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE njnk_reps_id = :njnk_reps_id
										
										AND  njnk_type = :njnk_type
										
										ORDER BY njnk_time DESC
										
										LIMIT 10 OFFSET $mailoffSetVal";

						$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
						$igweze_prep_1->bindValue(':njnk_reps_id', $member_id);
						$igweze_prep_1->bindValue(':njnk_type', $inboxType);
						
				}else{

						$ebele_mark_1 = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, njnk_type
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE njnk_reps_id = :njnk_reps_id
										
										AND  njnk_type = :njnk_type
										
										ORDER BY njnk_time DESC
										
										LIMIT 10 OFFSET $mailoffSetVal";

						$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
						$igweze_prep_1->bindValue(':njnk_reps_id', $member_id);
						$igweze_prep_1->bindValue(':njnk_type', $fiVal);

				
				}
						
						$igweze_prep_1->execute();
				
						$rows_count_1 = $igweze_prep_1->rowCount(); 

						if($rows_count_1 >= $foreal) {
							
						echo $nkiruMsgBoxHead;
						
						while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {		
	
    		    			$msg_id = $row_1['msg_id'];
							$njnk_title = $row_1['njnk_title'];
							$njnk_msg = $row_1['njnk_msg'];
							$njnk_time = $row_1['njnk_time'];
							$njnk_status = $row_1['njnk_status'];
							$njnk_sender_id = $row_1['njnk_sender_id'];
							$njnk_reps_id = $row_1['njnk_reps_id'];
							$njnk_type = $row_1['njnk_type'];
							
							$msgData = $msg_id.'-'.$njnk_reps_id.'-'.$njnk_sender_id;
							
							$memberInfo = companionWallUserDetails($conn, $njnk_sender_id, $fiVal);
				
							list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
						    $wallPic, $load_page) = explode ("##", $memberInfo);				
							
							if($njnk_type == $thVal) { $m_name = '*';}
							
							if($njnk_status == $fiVal){ $msgStatus = 'unread'; $starIcon = 'fa fa-star inbox-started'; $ckeckRU = 'checkUnread';}
							else { $msgStatus = ''; $starIcon = 'fa fa-star'; $ckeckRU = 'checkRead'; }	
							
							if($njnk_type == $seVal){ $admicIcon = '<span class="label label-danger pull-right">admin</span>'; 
													  $chkAdmin = 'checkAdminMsg'; }
							else{ $admicIcon = ''; $chkAdmin ='';}
							
							$msgTime = wallTimerBoy($njnk_time);
							$msgTime = date("F d, Y", $njnk_time);
								
							
$nkiruMsgBox =<<<IGWEZE
								
								<tr class="$msgStatus" id="mailRowID-$msg_id">
									  <td class="inbox-small-cells text-right" width="5%">
										  <input type="checkbox" class="mail-checkbox mailCheckBox $chkAdmin $ckeckRU" 
										  value='$msg_id' name="chkmailID-$msg_id" id="chkmailID-$msg_id">
									  </td>
									  <td class="inbox-small-cells readMail" id="readMail-$msgData" width="5%">
									  <span id="starIconMail-$msg_id"><i class="$starIcon"></i></span></td>
									  <td class="view-message  dont-show readMail" id="readMail-$msgData" width="30%">$m_name 
									  $admicIcon</td>
									  <td class="view-message readMail" id="readMail-$msgData" width="40%"> $njnk_title  </td>
									  <td class="view-message  inbox-small-cells readMail readMail-$msgData" 
									  id="readMail-$msgData"></td>
									  <td class="view-message  text-right readMail" id="readMail-$msgData" width="20%"> 
									  $msgTime</td>
                              	</tr>		
				
		
IGWEZE;
					
						
							echo $nkiruMsgBox;
							
							
						}
						
							echo '</tbody>
                          			</table>
									</div>
									   </div>
                  					 ';
						}else{

							if ($inboxType == $seVal){$msg = "Ooooops, Your Companion Wall Admin Message is empty.";}
							elseif ($inboxType == $thVal){$msg = "Ooooops, Your Companion Wall Draft Message is empty.";}
							elseif ($inboxType == $foVal){$msg = "Ooooops, Your Companion Wall Trash Message is empty.";}
							else {$msg = "Ooooops, Your Companion Wall Inbox Message is empty.";}
							
							echo "<br clear='all' /><br clear='all' />";
							echo $infoMsg.$msg.$iEnd; 		
							
						}
		
			}

			function viewCompanionMail($conn, $msgID, $member_id, $sender_id) {  /* view companion mail */

				global $wizGradeMailBoxTB, $wizGradeCWallTB, $foreal, $wizGradeTemplate, $forumPicExt, $fiVal, $seVal, $thVal, $regNum, $wizGradeDefaultPic, 
				$wallPicLoader, $succesMsg, $errorMsg, $warningMsg, $infoMsg,  $sEnd, $eEnd, $iEnd, $wEnd, $cWallNumPerPage;
				$changeProfPic = '';

							
				if (($msgID == '') || ($member_id == '') || ($sender_id == '')){
															 
					$msg = "Ooooops Something went wrong while tring to retrieve your mail, please try again";
					echo $errorMsg.$msg.$eEnd; //exit;
						
						
				}else{
					
					$msgData = $msgID .'-'.$member_id;
					
					try {
							
					
						$memberInfo = companionWallUserDetails($conn, $sender_id, $fiVal);
						
						list ($senderID, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
							  $wallPic, $load_page) = explode ("##", $memberInfo);		
						
							$ebele_mark = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, njnk_type
							
											FROM $wizGradeMailBoxTB
											
											WHERE njnk_reps_id = :njnk_reps_id
											
											AND njnk_sender_id = :njnk_sender_id
											
											AND msg_id = :msg_id";

							$igweze_prep = $conn->prepare($ebele_mark);	 
							$igweze_prep->bindValue(':njnk_reps_id', $member_id);
							$igweze_prep->bindValue(':njnk_sender_id', $sender_id);
							$igweze_prep->bindValue(':msg_id', $msgID);
						
							$igweze_prep->execute();
					
							$rows_count = $igweze_prep->rowCount(); 
					
							if($rows_count == $foreal) {
								
							
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		
								$msg_id = $row['msg_id'];
								$njnk_title = $row['njnk_title'];
								$njnk_msg = $row['njnk_msg'];
								$njnk_time = $row['njnk_time'];
								$njnk_status = $row['njnk_status'];
								$njnk_sender_id = $row['njnk_sender_id'];
								$njnk_reps_id = $row['njnk_reps_id'];
								$njnk_type = $row['njnk_type'];
							}
							
							
							
							$njnk_title = htmlspecialchars_decode($njnk_title);
							$njnk_msg = htmlspecialchars_decode($njnk_msg);					
						
							$njnk_msg = nl2br($njnk_msg);
							
							$msgTime = wallTimerBoy($njnk_time);
							$msgTime = date("F d, Y h:i:s", $njnk_time);					
							
							if ( (is_null($prof_pic)) || ($prof_pic == '-') || (!file_exists($forumPicExt.$prof_pic)) ){ 
							$senderPic = $wizGradeDefaultPic; }
						
							else { $senderPic = $forumPicExt.$prof_pic; }

							if($userMail == '-'){
					
								$senderMail = '';
					
							}else{
					
								$senderMail = '['.$userMail.'@wizgrade.com]';
					
							}
							
							
							if($njnk_status == $fiVal){
								
								$ebele_mark_1 = "UPDATE $wizGradeMailBoxTB 
									
													SET 
												
													njnk_status = :njnk_status

													WHERE njnk_reps_id = :njnk_reps_id
											
													AND njnk_sender_id = :njnk_sender_id
											
													AND msg_id = :msg_id";
													
									$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
									$igweze_prep_1->bindValue(':njnk_status', $seVal);	
									$igweze_prep_1->bindValue(':njnk_reps_id', $member_id);
									$igweze_prep_1->bindValue(':njnk_sender_id', $sender_id);
									$igweze_prep_1->bindValue(':msg_id', $msgID);														
									
									$igweze_prep_1->execute();
									
									if(isset($_SESSION['wallComRank'])){	

										$unreadMsg = numOfUnreadMsgAdmin($conn, $member_id);
										
										echo "<script type='text/javascript'> $('.inboxMsgNum').html('$unreadMsg'); </script>"; 	
						
									}else{
						
										$unreadMsg = numOfUnreadMsg($conn, $member_id);	
										$adminMsg = numOfAdminMsg($conn, $member_id);						
										echo "<script type='text/javascript'> $('.inboxMsgNum').html('$unreadMsg');
																		  $('.adminMsgNum').html('$adminMsg'); </script>"; 	
									}
					
							}

							if($njnk_type == $thVal) {
								
							$mailMsg = str_replace('<br />', "\n", $njnk_msg);	
								
									echo "<script type='text/javascript'> $('#mailTopTitle').html('View Draft Message');
																		  $('#mailTitleHolder').html('View Draft Message');</script>";

$nkiruViewBox =<<<IGWEZE

                       <div class="row" id="inboxmsgBoxDiv">
    					 <div class="col-lg-12">
   
                          <section class="panel">
                         
                          <div class="panel-body">
						  <div id="msgBoxInfo"> </div>
                              <!-- form --><form class="form-horizontal" id="frmsendNkirukaMail" role="form">
                              
                                          
                                  <div class="form-group">
                                      <div class="col-lg-12">
                                          <div class="iconic-input">
                                              <i class="fa  fa-envelope-o"></i>
                                              <input type="email" class="form-control" placeholder="Write your email address here" 
                                              name="msgEmail" id="msgEmail" required />
                                          </div>
                                      </div>
                                  </div>
                                  
                                 <div class="form-group">
                                      <div class="col-lg-12">
                                          <div class="iconic-input">
                                              <i class="fa fa-comment-o"></i>
                                              <input type="text" class="form-control" placeholder="Write your mesaage title here" 
                                              name="msgTitle" id="msgTitle" value="$njnk_title" required />
                                          </div>
                                      </div>
                                  </div>


                                  <div class="form-group">
                                      <div class="col-lg-12">
                                          <div class="iconic-input">
                                              <i class="fa fa-envelope"></i>
                                              <textarea class="form-control" name="Message" id="Message" style="padding: 5px 30px;"
                                              placeholder="Write your mesaage here" rows="10" required>$mailMsg</textarea>
                                             
                                          </div>
                                      </div>
                                  </div>
                                 <div class="form-group">
                                      <div class="col-lg-2"> 
                                          <input type="hidden" name="memberID" value="$member_id" />
										  <input type="hidden" name="messageData" value="sendNjidekaMail" />
                                          <button type="submit" class="btn btn-danger" id="sendNkirukaMail">
                                          <i class="fa fa-mail-forward"></i> Send  </button>
                                          
                                          
                                           
                                      </div>
                                  </div>
  

                              </form><!-- / form -->
                          </div>
                         
                      </section>
                      
                  </div>
                  
                  </div>


IGWEZE;
						}else{


$nkiruViewBox =<<<IGWEZE

                      <div class="inbox-body" id="inboxmsgBoxDiv">
                              <div id="wizGradePrintArea">
							  <div class="heading-inbox row">
                                  <div class="col-md-8">
                                      <div class="compose-btn">
                                          <button title="" data-placement="top" data-toggle="tooltip" type="button" id="printer-btn"
                                          data-original-title="Print" class="btn btn-white tooltips"><i class="fa fa-print"></i> Print</button>
                                          <button title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash" 
										  id="trashMailViewMsg-$msgData"
                                          class="btn btn-white tooltips trashMailViewMsg"><i class="fa fa-trash-o"></i> Trash</button>
                                      </div>

                                  </div>
                                  <div class="col-md-4 text-right">
                                      <p class="date"> $msgTime </p>
                                  </div>
                                  <div class="col-md-12">
                                      <h4> $njnk_title </h4>
                                  </div>
                              </div>
                              <div class="sender-info">
                                  <!-- row -->	
					<div class="row">  
                                      <div class="col-md-12">
                                         <img src="$senderPic" height="60px" width="64px" alt="Mail Sender Picture">
                                          <strong>$m_name</strong>
                                          <span>$senderMail</span>
                                          to
                                          <strong>me</strong>
                                          <a class="sender-dropdown " href="javascript:;">
                                              <i class="fa fa-chevron-down"></i>
                                          </a>
                                      </div>
                                  </div>
                              </div>
                              <div class="view-mail">
                                  $njnk_msg
                              </div>
							  
							  </div>
                             
                          <br clear='all' />    
							  
						  <div class="row" style="margin-top: 30px;">
						  <div id="replyMsgDiv"></div>
    					  <div class="col-lg-12">
   
                          <section class="panel" id="replymsgBoxDiv">
                          <header class="panel-heading">
                             Reply This Mail  <img src="$wallPicLoader" alt="Loading >>>>>" class="pull-right" id='replyMsgLoader' 
									  style="cursor:pointer; display:none; margin-right:3%; margin-bottom:10px;" />
                          </header>
                          <div class="panel-body">
                              <!-- form --><form class="form-horizontal" id="frmreplyMail" role="form">

											  <input type="hidden" name="mailBoxData" value="sendWCReplyMail" />
											  <input type="hidden" name="recepID" value="$senderID" />
											  <input type="hidden" name="recepName" value="$m_name" />
											  <input type="hidden" name="mailID" value="$msg_id" />
											  <input type="hidden" name="mailType" value="$njnk_type" />
											  <input type="hidden" name="replyMsg" value="replyMsg" />
											  <input type="hidden" name="msgTitle" value="RE: $njnk_title" />

                                 

                                  <div class="form-group">
                                      <div class="col-lg-12">
                                          <div class="iconic-input">
                                              <i class="fa fa-envelope"></i>
                                              <textarea class="form-control" name="Message" id="Message" style="padding: 5px 30px;"
                                              placeholder="Write your mesaage here" rows="10" reqired></textarea>
                                             
                                          </div>
                                      </div>
                                  </div>
			

                            

                                 <div class="form-group">
                                      <div class="col-lg-2"> 
                                          
                                          <button type="submit" class="btn btn-danger" id="replyMail">
                                          <i class="fa fa-reply"></i> Reply Message </button>
                                          
                                          
                                           
                                      </div>
                                  </div>
  

                              </form><!-- / form -->
                          </div>
                         
                      </section>
                      
                  </div>
                  
                  </div>							  
                              
                          </div>
                          
		
IGWEZE;
					
					}
					
						echo $nkiruViewBox;
				
					}else{
					
						$msg = "Ooooops Something went wrong while tring to retrieve your mail, please try again";
						echo $errorMsg.$msg.$eEnd; //exit;


					}
			   
			   						
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
			   }			


			}

			function companionSentMsg($conn, $member_id, $mailoffSetVal) {  /* view companion sent mail */

					global $wizGradeMailBoxTB, $foreal, $forumPicExt, $fiVal, $seVal, $thVal, $foVal, $regNum, $wizGradeDefaultPic, $succesMsg, 
					$errorMsg, $warningMsg, $infoMsg,  $sEnd, $eEnd, $iEnd, $wEnd; 
					
						$ebele_mark = "SELECT msg_id
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE njnk_sender_id = :njnk_sender_id";

						$igweze_prep = $conn->prepare($ebele_mark);	 
						$igweze_prep->bindValue(':njnk_sender_id', $member_id);

						
						$igweze_prep->execute();
				
						$totalCount = $igweze_prep->rowCount(); 
					

						if($totalCount <= 10){

				  			$nextPage = $totalCount;
				  			$pagiDetail = '1 - '.$nextPage;

							echo  "<script type='text/javascript'> 
										$('.prevMailBtn').fadeOut(10);  $('.nextMailBtn').fadeOut(10); 
										$('#pagiDetailsDiv').html('$pagiDetail');
				  				   </script>";
				  
						}
				
								 

$nkiruMsgBoxHead =<<<IGWEZE


					<div id="memberID" class="display-none">$member_id</div>
					<div id="totalCount" class="display-none">$totalCount</div>
                      <div class="inbox-body" id="inboxmsgBoxDiv">
                         <div class="mail-option">
                           

                             <div class="btn-group">
                                 <a class="btn mini tooltips showInbox" href="javascript:;" data-toggle="dropdown" data-placement="top" 
								 data-original-title="Refresh"
								 id="showInboxMsg-$member_id">
                                     <i class=" fa fa-refresh"></i>
                                 </a>
                             </div>

							<div id="prevPageDiv" class="display-none"></div>
							<div id="nextPageDiv" class="display-none">10</div>
                             <ul class="unstyled inbox-pagination">
                                 <li><span id="pagiDetailsDiv">1-10</span><span> of $totalCount</span></li>
                                 <li>
                                     <a href="javascript:;" class="np-btn prevMailSentBtn" style="display: none;">
									 <i class="fa fa-angle-left pagination-left"></i>
									 </a>
                                 </li>
                                 <li>
                                     <a href="javascript:;" class="np-btn nextMailSentBtn"><i class="fa fa-angle-right pagination-right"></i>
									 </a>
                                 </li>
                             </ul>
                         </div>

		<div id="paginateMailDiv">
		
			<table class="table table-inbox table-hover">
			<tbody>
		
							

IGWEZE;
					
						$ebele_mark_1 = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, 
										njnk_reps_id, njnk_type
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE njnk_sender_id = :njnk_sender_id
										
										ORDER BY njnk_time DESC
										
										LIMIT 10 OFFSET $mailoffSetVal";

						$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
						$igweze_prep_1->bindValue(':njnk_sender_id', $member_id);						
						$igweze_prep_1->execute();
				
						$rows_count_1 = $igweze_prep_1->rowCount(); 

						if($rows_count_1 >= $foreal) {
							
						echo $nkiruMsgBoxHead;
						
						while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {		
	
    		    			$msg_id = $row_1['msg_id'];
							$njnk_title = $row_1['njnk_title'];
							$njnk_msg = $row_1['njnk_msg'];
							$njnk_time = $row_1['njnk_time'];
							$njnk_status = $row_1['njnk_status'];
							$njnk_sender_id = $row_1['njnk_sender_id'];
							$njnk_reps_id = $row_1['njnk_reps_id'];
							$njnk_type = $row_1['njnk_type'];
							
							$msgData = $msg_id.'-'.$njnk_sender_id;
							
							$memberInfo = companionWallUserDetails($conn, $njnk_reps_id, $fiVal);
				
							list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
						    $wallPic, $load_page) = explode ("##", $memberInfo);				

							
							if($njnk_status == $fiVal){ $msgStatus = 'unread'; $starIcon = 'fa fa-star inbox-started'; $ckeckRU = 'checkUnread';}
							else { $msgStatus = ''; $starIcon = 'fa fa-star'; $ckeckRU = 'checkRead'; }	
							
							if($njnk_type == $seVal){ $admicIcon = '<span class="label label-danger pull-right">admin</span>'; 
													  $chkAdmin = 'checkAdminMsg'; }
							else{ $admicIcon = ''; $chkAdmin ='';}
							
							$msgTime = wallTimerBoy($njnk_time);
							$msgTime = date("F d, Y", $njnk_time);
								
							
$nkiruMsgBox =<<<IGWEZE

								<tr class="$msgStatus" id="mailRowID-$msg_id">
                                  <td class="inbox-small-cells text-right" width="5%">
                                  </td>
                                  <td class="inbox-small-cells readNkirukaSentMail" id="readNkirukaSentMail-$msgData" width="5%">
								  <span id="starIconMail-$msg_id"><i class="$starIcon"></i></span></td>
                                  <td class="view-message  dont-show readNkirukaSentMail" id="readNkirukaSentMail-$msgData" width="30%">$m_name 
								  $admicIcon</td>
                                  <td class="view-message readNkirukaSentMail" id="readNkirukaSentMail-$msgData" width="40%"> $njnk_title   </td>
                                  <td class="view-message  inbox-small-cells readNkirukaSentMail readNkirukaSentMail-$msgData" 
								  id="readNkirukaSentMail-$msgData"></td>
                                  <td class="view-message  text-right readNkirukaSentMail" id="readNkirukaSentMail-$msgData" width="20%"> 
								  $msgTime</td>
                              	</tr>		
				
		
IGWEZE;
					
						
							echo $nkiruMsgBox;
							
							
						}
						
							echo '</tbody>
                          			</table>
									</div>
									   </div>
									   
                  					 ';
						}else{

							$msg = "Ooooops, Your Companion Wall Sent Message is empty.";
							
							echo "<br clear='all' /><br clear='all' />";
							echo $infoMsg.$msg.$iEnd; //exit; 			
							
						}
		
			}

			function msgTypeStatus($conn, $msg_id) {  /* retrieve companion inbox mail type */

				global $wizGradeMailBoxTB, $foreal; 

						$ebele_mark_1 = "SELECT njnk_type
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE msg_id = :msg_id";

						$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
						$igweze_prep_1->bindValue(':msg_id', $msg_id);
						$igweze_prep_1->execute();
						
						while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {		
	
							$njnk_type = $row_1['njnk_type'];
							
						}
						
						if($njnk_type == '') { $Status = $foreal; }
						else { $Status = $njnk_type; }
						
						return $Status; 

			}

			function msgSentType($conn, $memberID) {  /* retrieve companion sent mail type */

				global $wizGradeCWallTB, $foreal; 

						$ebele_mark = "SELECT member_rank
						
                     		     		FROM $wizGradeCWallTB
										
										WHERE member_id = :member_id";

						$igweze_prep = $conn->prepare($ebele_mark);	 
						$igweze_prep->bindValue(':member_id', $memberID);
						$igweze_prep->execute();
						
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	
							$msgType = $row['member_rank'];
							
						}
						
						if($msgType == '') { $mType = $foreal; }
						else { $mType = $msgType; }
						
						return $mType; 

			}

			function returnMsgSentType($msgTypefi, $msgTypese) {  /* return companion mail type */

				global $fiVal, $seVal; 

					if ($msgTypefi > $fiVal) {
						
						$msgType = $seVal;
							
					}elseif($msgTypese > $fiVal){
					
						$msgType = $seVal;
						
					}elseif($msgTypefi > $msgTypese){
					
						$msgType = $seVal;
						
					}elseif($msgTypese > $msgTypefi){
					
						$msgType = $seVal;
						
					}else{
						
						$msgType = $fiVal;
						
					}
						
					return $msgType; 

			}

			function msgTrashStatus($conn, $msg_id) {  /* companion mail trash status */

				global $wizGradeMailBoxTB, $foreal; 

									
						$ebele_mark_1 = "SELECT njnk_trash
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE msg_id = :msg_id";

						$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
						$igweze_prep_1->bindValue(':msg_id', $msg_id);
						$igweze_prep_1->execute();
												
						while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {		
	
							$njnk_trash = $row_1['njnk_trash'];

						}
						
						if($njnk_trash == '') { $status = $foreal; }
						else { $status = $njnk_trash; }
						
						return $status;

			}

			function numOfUnreadMsg($conn, $member_id) {  /* number of unread message */

				global $wizGradeMailBoxTB, $foreal, $fiVal, $seVal, $thVal, $regNum; 

						$ebele_mark = "SELECT msg_id
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE njnk_status = :njnk_status
										
										AND njnk_type = :njnk_type
										
										AND njnk_reps_id = :njnk_reps_id";

						$igweze_prep = $conn->prepare($ebele_mark);	 
						$igweze_prep->bindValue(':njnk_status', $fiVal);
						$igweze_prep->bindValue(':njnk_type', $fiVal);
						$igweze_prep->bindValue(':njnk_reps_id', $member_id);
						
						$igweze_prep->execute();
				
						$rows_count = $igweze_prep->rowCount(); 

						return $rows_count;
		
			}		

			function numOfUnreadMsgAdmin($conn, $member_id) {  /* number of admin unread message */

				global $wizGradeMailBoxTB, $foreal, $fiVal, $seVal, $thVal, $regNum; 

						$ebele_mark = "SELECT msg_id
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE njnk_status = :njnk_status
										
										AND njnk_type = :njnk_type
										
										AND njnk_reps_id = :njnk_reps_id";

						$igweze_prep = $conn->prepare($ebele_mark);	 
						$igweze_prep->bindValue(':njnk_status', $fiVal);
						$igweze_prep->bindValue(':njnk_type', $seVal);
						$igweze_prep->bindValue(':njnk_reps_id', $member_id);
						
						$igweze_prep->execute();
				
						$rows_count = $igweze_prep->rowCount(); 

						return $rows_count;
		
			}		


			function numOfSentMsg($conn, $member_id) {  /* number of sent message */

				global $wizGradeMailBoxTB, $foreal, $fiVal, $seVal, $thVal, $regNum; 

						$ebele_mark = "SELECT msg_id
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE njnk_sender_id = :njnk_sender_id";

						$igweze_prep = $conn->prepare($ebele_mark);	 
						$igweze_prep->bindValue(':njnk_sender_id', $member_id);
						
						$igweze_prep->execute();
				
						$rows_count = $igweze_prep->rowCount(); 
				
						return $rows_count;
		
			}		

			function numOfDraftMsg($conn, $member_id) {  /* number of draft message */

				global $wizGradeMailBoxTB, $foreal, $fiVal, $seVal, $thVal, $regNum; 

						$ebele_mark = "SELECT msg_id
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE njnk_type = :njnk_type
										
										AND njnk_reps_id = :njnk_reps_id";

						$igweze_prep = $conn->prepare($ebele_mark);	 
						$igweze_prep->bindValue(':njnk_type', $thVal);
						$igweze_prep->bindValue(':njnk_reps_id', $member_id);
						
						$igweze_prep->execute();
				
						$rows_count = $igweze_prep->rowCount(); 
				
						return $rows_count;
		
			}		


			function numOfAdminMsg($conn, $member_id) {  /* number of admin message */

				global $wizGradeMailBoxTB, $foreal, $fiVal, $seVal, $thVal, $regNum; 

						$ebele_mark = "SELECT msg_id
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE njnk_type = :njnk_type
										
										AND njnk_status = :njnk_status
										
										AND njnk_reps_id = :njnk_reps_id";

						$igweze_prep = $conn->prepare($ebele_mark);	 
						$igweze_prep->bindValue(':njnk_type', $seVal);
						$igweze_prep->bindValue(':njnk_status', $fiVal);
						$igweze_prep->bindValue(':njnk_reps_id', $member_id);
						
						$igweze_prep->execute();
				
						$rows_count = $igweze_prep->rowCount(); 
				
						return $rows_count;
		
			}		


			function numOfTrashMsg($conn, $member_id) {  /* number of trash message */

				global $wizGradeMailBoxTB, $foreal, $fiVal, $seVal, $foVal;

						$ebele_mark = "SELECT msg_id
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE njnk_type = :njnk_type
										
										AND njnk_reps_id = :njnk_reps_id";

						$igweze_prep = $conn->prepare($ebele_mark);	 
						$igweze_prep->bindValue(':njnk_type', $foVal);
						$igweze_prep->bindValue(':njnk_reps_id', $member_id);
						
						$igweze_prep->execute();
				
						$rows_count = $igweze_prep->rowCount(); 
				
						return $rows_count;
		
			}		

			function emailValidator($conn, $email) {  /* check if email exits or not */

				global $wizGradeCWallTB, $foreal; 

						$Mail = trim($email, '@wizgrade.com');
						
						$ebele_mark = "SELECT member_id
						
                     		     		FROM $wizGradeCWallTB
										
										WHERE member_mail = :member_mail";

						$igweze_prep = $conn->prepare($ebele_mark);	 
						$igweze_prep->bindValue(':member_mail', $Mail);
						
						$igweze_prep->execute();
				
						$rows_count = $igweze_prep->rowCount(); 

						if($rows_count >= $foreal) {
						
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		
							$member_id = $row['member_id'];
						}
						
						}else{
							
							$member_id = '';
						}
						
						return $member_id;
		
			}		


			function njidekaCompanionInbox($conn, $member_id, $wType) {  /* companion mail notification */

					global $wizGradeMailBoxTB, $foreal, $forumPicExt, $fiVal, $sixVal;  
					global $seVal, $thVal, $regNum, $wizGradeDefaultPic; 
					global $succesMsg, $errorMsg, $warningMsg, $infMsg,  $sEnd, $eEnd, $iEnd, $wEnd, $msgEnd;
 
		 				
						$ebele_mark = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, 
										njnk_reps_id, njnk_type
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE njnk_reps_id = :njnk_reps_id
										
										ORDER BY njnk_time DESC";

						$igweze_prep = $conn->prepare($ebele_mark);	 
						$igweze_prep->bindValue(':njnk_reps_id', $member_id);						
						$igweze_prep->execute();
				
						$rows_count = $igweze_prep->rowCount(); 

						if($rows_count >= $foreal) {

						$count = $i_false;
						
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	
    		    			$count++;
							
							if($count <= $sixVal){
								
								$msg_id = $row['msg_id'];
								$njnk_title = $row['njnk_title'];
								$njnk_msg = $row['njnk_msg'];
								$njnk_time = $row['njnk_time'];
								$njnk_status = $row['njnk_status'];
								$njnk_sender_id = $row['njnk_sender_id'];
								$njnk_reps_id = $row['njnk_reps_id'];
								$njnk_type = $row['njnk_type'];
								
								$msgData = $msg_id.'-'.$njnk_reps_id.'-'.$njnk_sender_id;
								
								$msgTime = wallTimerBoy($njnk_time);
								
								$memberInfo = companionWallUserDetails($conn, $njnk_sender_id, $fiVal);
					
								list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
								$wallPic, $load_page) = explode ("##", $memberInfo);				

								
								if ( (is_null($prof_pic)) || ($prof_pic == '-') || (!file_exists($forumPicExt.$prof_pic)) ){ 
									$senderPic = $wizGradeDefaultPic; }
						
								else { $senderPic = $forumPicExt.$prof_pic; } 
							
								if($wType == $seVal){
									
									$linkMail = "readMailTopNavS";
									
								}else{
									
									$linkMail = "readMailTopNav";
									
								}	 
							
$nkiruMsgBox =<<<IGWEZE


								<li id="msgRowID-$msgData" class="$linkMail">
									<a href="javascript:;">
										<span class="photo"><img src="$senderPic" height="35px" width="35px" alt="Sender Picture"></span>
										<span class="subject">
										<span class="from"><strong>$m_name</strong></span>
										
										</span>
										
										<span class="message">
											$njnk_title
										</span>
										<span class="time pull-right"><strong>$msgTime</strong></span>
									</a>
								</li>
					
		
IGWEZE;
								 
								
								echo $nkiruMsgBox;
							
							}
							
							
						}
						
						if($count > $sixVal){
							
							echo '<li><br />
									<button type="submit" class="btn btn-danger pull-right" id="moreMailBoxInfo">
											  <i class="fa fa-external-link"></i> See all messages </button>
								</li>';
						
						}
						
						
						
						}else{
						
							echo "<b>Ooooops, You have no new message</b>";
							//echo $infoMsg.$msg.$msgEnd;
							
						}
							
 					
				
			}
		

			function wallNotifications($conn, $postComOwner, $wType) {  /* companion mail notification */
		 		
				global $cWallNotificationTB, $foreal, $fiVal, $seVal, $foVal, $sixVal, $i_false, $succesMsg, $errorMsg,
				$warningMsg, $infMsg,  $sEnd, $eEnd, $iEnd, $wEnd, $msgEnd;
		 
				$ebele_mark = "SELECT not_id, post_id, comment_id, member_id, senders_id, not_time, not_type
				
								FROM $cWallNotificationTB
				
							    WHERE member_id = :member_id";

 			    $igweze_prep = $conn->prepare($ebele_mark);				
				$igweze_prep->bindValue(':member_id', $postComOwner);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
					
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$notID = $row['not_id'];
						$post_id = $row['post_id'];
						$comment_id = $row['comment_id'];
						$member_id = $row['member_id'];
						$senders_id = $row['senders_id'];
						$not_time = $row['not_time'];
						$not_type = $row['not_type'];
						
						$noticTime = wallTimerBoy($not_time);
						
						if($not_type == $fiVal) { 
						
							$noticTypeVal = postTypeDetails($conn, $post_id);
							
							$noticIcon = '<i class="fa fa-comment-o fa-lg"></i> '; 
							$noticMsg = ' Commented on your '.$noticTypeVal; 
													  
						}elseif(($not_type == $seVal) &&  ($comment_id == '') ){ 
						
							$noticTypeVal = postTypeDetails($conn, $post_id);
							
							$noticIcon = '<i class="fa fa-thumbs-o-up fa-lg"></i> '; 
							$noticMsg = ' Like your '.$noticTypeVal; 
														 
						}elseif(($not_type == $seVal) && ($comment_id != '')) { 
						
							$noticTypeVal = commentDetails($conn, $comment_id);
							
							$noticIcon = '<i class="fa fa-thumbs-o-up fa-lg"></i> '; 
							$noticMsg = ' Like your Comment '.$noticTypeVal; 
							
						}else{
							
							$noticTypeVal = ''; $noticIcon = '';
							
						}
						
						$sendersArrays = unserialize($senders_id);
						$count = count($sendersArrays);
						
						if($count > $foVal) { $moreNot = ($count - $foVal); $moreNotLink = '<span> and </span> 
						'.$moreNot.' more <span>'.$noticMsg.'</span>'; $count = $foVal;}
						else { $moreNotLink = $noticMsg; }
						
						
						if($wType == $seVal){

							$noticLink = ' <li class="showCWallNotificationS para-noticfication" id="showCWallNotification-'.$post_id.'">
							<p class="para-noticfication"><a href="javascript:;">'.$noticIcon; 

						}else{
							
							$noticLink = ' <li class="showCWallNotification para-noticfication" id="showCWallNotification-'.$post_id.'">
							<p class="para-noticfication"><a href="javascript:;">'.$noticIcon; 
							
						}	
						
						for($i = $i_false; $i <= $count; $i++) {
							
							$memberID = $sendersArrays[$i]; 
							
							if($memberID == $senders_id){
								
							
							}else{
								
								$memberInfo = companionWallUserDetails($conn, $memberID, $fiVal);
						
								list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);	

								if($m_name != '-'){
									$noticLink .= '<strong>'.$m_name.'</strong>, ';
								}
								
								$memberInfo = ''; $memberID = '';
							
							}
							
							$post_id ='';
						
						
						}
						 
							$noticLinkTrim = trim($noticLink, ', ');					
							echo $noticLinkTrim.$moreNotLink;					
							echo '<br /><span class="time pull-right"> <strong>'.$noticTime.'</strong></span> </a></p></li>';
					
					}
					
					
					if($count > $sixVal){
							
						echo '<li><br />
								<button type="submit" class="btn btn-danger pull-right" id="moreMailBoxInfo">
                                          <i class="fa fa-external-link"></i> See all messages </button>
                            </li>';
						
					}
					
					
				}else{
					
						echo  "<b>Ooooops, You have no new notification</b>";
			   			//echo $infMsg.$msg.$iEnd; 	
				}
						
						echo '<div id="notMsgDiv" class="display-none">'.$rows_count.'</div>';


			}
			
			function saveNotifications($conn, $postComOwner, $postComSender, $postComID, $postComType, $notType) {  /* save companion mail notification */
		 		
				global $cWallNotificationTB, $foreal, $fiVal, $seVal;
		 			
		 		if ($postComType == $fiVal){ $pcType = 'post_id'; $pcTypeS = ':post_id';  }
				elseif ($postComType == $seVal){ $pcType = 'comment_id'; $pcTypeS = ':comment_id'; }
				else { $pcType = 'post_id'; $pcTypeS = ':post_id';  }
				
				$time = strtotime(date("Y-m-d H:i:s"));
				
				$ebele_mark = "SELECT not_id, senders_id
				
								FROM $cWallNotificationTB
				
							    WHERE $pcType = $pcTypeS
								
								AND not_type = :not_type
								
								AND member_id = :member_id";

 			    $igweze_prep = $conn->prepare($ebele_mark);				
				$igweze_prep->bindValue(':member_id', $postComOwner);
				$igweze_prep->bindValue("$pcTypeS", $postComID);				
				$igweze_prep->bindValue(':not_type', $notType);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
					
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$notID = $row['not_id'];
						$senders_id = $row['senders_id'];
					
					}
					
					$sendersArrays = unserialize($senders_id);
					
					$sendersArray = removeArrayByValue($sendersArrays, $postComSender);				
					
					$sendersArray[] = $postComSender;
					
					$sendersArrayU = serialize($sendersArray);
					
					
								$ebele_mark_1 = "UPDATE $cWallNotificationTB
								
												SET 
                						 	
												senders_id = :senders_id,
												
												not_time = :not_time
												
												WHERE not_id = :not_id";
												
								$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
								$igweze_prep_1->bindValue(':senders_id', $sendersArrayU);
								$igweze_prep_1->bindValue(':not_time', $time);
								$igweze_prep_1->bindValue(':not_id', $notID);								
								$igweze_prep_1->execute();
					
					
				}else{
								$pCSenderArr = array();	   
	   							array_unshift($pCSenderArr,"");
	   							unset($pCSenderArr[0]);
								$pCSenderArr[] = $postComSender;
								$sendersArr = serialize($pCSenderArr);
								$ebele_mark_1 = "INSERT INTO $cWallNotificationTB ($pcType, member_id, senders_id, not_time, not_type)

                                   							VALUES ($pcTypeS, :member_id, :senders_id, :not_time, :not_type)";

								$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
								$igweze_prep_1->bindValue("$pcTypeS", $postComID);			
								$igweze_prep_1->bindValue(':member_id', $postComOwner);
								$igweze_prep_1->bindValue(':senders_id', $sendersArr);
								$igweze_prep_1->bindValue(':not_time', $time);
								$igweze_prep_1->bindValue(':not_type', $notType);								
								$igweze_prep_1->execute();
					
				}
				
			}


			function removeNotification($conn, $postComOwner, $postComSender, $postComID, $postComType, $notType) {  /* remove companion mail notification */
		 		
				global $cWallNotificationTB, $foreal, $fiVal, $seVal;
					
		 		if ($postComType == $fiVal){ $pcType = 'post_id'; $pcTypeS = ':post_id';  }
				elseif ($postComType == $seVal){ $pcType = 'comment_id'; $pcTypeS = ':comment_id'; }
				else { $pcType = 'post_id'; $pcTypeS = ':post_id';  }
				
				$ebele_mark = "SELECT not_id, senders_id
				
								FROM $cWallNotificationTB
				
							    WHERE $pcType = $pcTypeS
								
								AND not_type = :not_type
								
								AND member_id = :member_id";

 			    $igweze_prep = $conn->prepare($ebele_mark);				
				$igweze_prep->bindValue(':member_id', $postComOwner);
				$igweze_prep->bindValue("$pcTypeS", $postComID);				
				$igweze_prep->bindValue(':not_type', $notType);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
					
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$notID = $row['not_id'];
						$senders_id = $row['senders_id'];
					
					}
					
					$sendersArrays = unserialize($senders_id);					
					$sendersArray = removeArrayByValue($sendersArrays, $postComSender);		
					$sendersArrayU = serialize($sendersArray);
					
					
								$ebele_mark_1 = "UPDATE $cWallNotificationTB
								
												SET 
                						 	
												senders_id = :senders_id
												
												WHERE not_id = :not_id";
												
								$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
								$igweze_prep_1->bindValue(':senders_id', $sendersArrayU);
								$igweze_prep_1->bindValue(':not_id', $notID);
								$igweze_prep_1->execute();

					
				}

			}

			function postTypeVal($type) {  /* companion wall post type */
	
					global $fiVal, $seVal, $thVal, $foVal;
				
						if($type == $fiVal) { $postVal = 'Post'; }
						elseif($type == $seVal) { $postVal = 'Uploaded Picture/s'; }
						elseif($type == $thVal) { $postVal = 'Profile Picture'; }
						elseif($type == $foVal) { $postVal = 'Wall Cover Picture'; }
						else {$postVal = '';}
				
						return $postVal;
			
			}
			
			function postTypeDetails($conn, $postID) {  /* companion wall post type details */
		 		
					global $cWallPostTB, $foreal, $i_false, $fiVal;
							
					$ebele_mark = "SELECT post_msg, post_type
					
									FROM $cWallPostTB
					
									WHERE post_id = :post_id";

					$igweze_prep = $conn->prepare($ebele_mark);				
					$igweze_prep->bindValue(':post_id', $postID);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {
						
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$post_msg = $row['post_msg'];
							$post_type = $row['post_type'];
						
						}
						
						if($post_type == $fiVal){
						
							$msg = substr($post_msg , 0, 30);
							
							$postDetails = '<strong> Post </strong><i>'.$msg.' . . . . </i>';
						
						}else{
						
							$postDetails = postTypeVal($post_type);
						
						}
						
					}else{
						
						$postDetails = '';
						
					}

						return $postDetails;
			}
			 
			function commentDetails($conn, $commentID) {  /* companion comment details */
		 		
					global $cWallCommentTB, $foreal, $i_false;
							
					$ebele_mark = "SELECT comment
					
									FROM $cWallCommentTB
					
									WHERE comment_id = :comment_id";

					$igweze_prep = $conn->prepare($ebele_mark);				
					$igweze_prep->bindValue(':comment_id', $commentID);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {
						
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$comment = $row['comment'];
						
						}

						$msg = substr($comment , 0, 30);
						$commentDetails = $msg;
						
					}else{
						
						$commentDetails = '';
						
					}

						return $commentDetails;
			}

			function postAuthorByPostID($conn, $postID) { /* companion wall post author ID */
		 		
					global $cWallPostTB, $foreal, $i_false;
							
					$ebele_mark = "SELECT author_id
					
									FROM $cWallPostTB
					
									WHERE post_id = :post_id";

					$igweze_prep = $conn->prepare($ebele_mark);				
					$igweze_prep->bindValue(':post_id', $postID);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {
						
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$author_id = $row['author_id'];
						
						}
						
					}else{
						
						$author_id = $i_false;
						
					}

					return $author_id;
			}
			 

			function postIDBycommentID($conn, $commentID) {  /* companion wall comment author ID */
		 		
					global $cWallCommentTB, $foreal, $i_false;
							
					$ebele_mark = "SELECT post_id
					
									FROM $cWallCommentTB
					
									WHERE comment_id = :comment_id";

					$igweze_prep = $conn->prepare($ebele_mark);				
					$igweze_prep->bindValue(':comment_id', $commentID);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {
						
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$post_id = $row['post_id'];
						
						}
						
					}else{
						
						$post_id = $i_false;
						
					}

					return $post_id;
			}

			function postDeleteStatus($conn, $postID) {  /* remove companion wall post */
		 		
					global $cWallPostTB, $foreal, $i_false;
							
					$ebele_mark = "SELECT delpost
					
									FROM $cWallPostTB
					
									WHERE post_id = :post_id";

					$igweze_prep = $conn->prepare($ebele_mark);				
					$igweze_prep->bindValue(':post_id', $postID);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {
						
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$delpost = $row['delpost'];
						
						}
						
					}else{
						
						$author_id = $foreal;
						
					}

					return $delpost;
			}
			 

			function commentDeleteStatus($conn, $commentID) {  /* remove companion wall comment */
		 		
					global $cWallCommentTB, $foreal, $i_false;
							
					$ebele_mark = "SELECT delcom
					
									FROM $cWallCommentTB
					
									WHERE comment_id = :comment_id";

					$igweze_prep = $conn->prepare($ebele_mark);				
					$igweze_prep->bindValue(':comment_id', $commentID);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {
						
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$delcom = $row['delcom'];
						
						}
						
					}else{
						
						$delcom = $foreal;
						
					}

					return $delcom;
			}
			
			
			function activeCWallMembers($conn){  /* load active companion wall users */
		
					global $wizGradeCWallTB, $foreal, $fiVal, $seVal, $wizGradeDefaultPic, $forumPicExt; 
				
					$ebele_mark = "SELECT member_id, member_reg, profile_pic, member_name, member_sex, member_dept, 
										member_faculty, member_mail, wall_pic, load_page
						
												 FROM $wizGradeCWallTB";
							 
					$igweze_prep = $conn->prepare($ebele_mark); 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count >= $foreal) {
						
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$member_id = $row['member_id'];
							$faRegNum = $row['member_reg'];
							$prof_pic = $row['profile_pic'];
							$m_name = $row['member_name'];
							$m_sex = $row['member_sex'];
							$m_dept = $row['member_dept'];
							$m_faculty = $row['member_faculty'];
							$userMail = $row['member_mail'];
							$wallPic = $row['wall_pic'];
							$load_page = $row['load_page'];							
							
							if ( (is_null($prof_pic)) || ($prof_pic == '-') || (!file_exists($forumPicExt.$prof_pic)) ){ $stuFpic = $wizGradeDefaultPic; }
						
							else { $stuFpic = $forumPicExt.$prof_pic; }
						
							echo $stuPic = '<a href="javascript:;" class="showcompanionWallUser" id="companionWallUser-'.$member_id.'">
							<img src="'.$stuFpic.'" class="poster-img"  /></a>';
						
						
						}	

						
						
					}
					

			}

?>