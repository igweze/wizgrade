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

		if(isset($_REQUEST["showEditPost"]) && strlen($_REQUEST["showEditPost"])> 0 && is_numeric($_REQUEST["showEditPost"])){
		
			$post_id = strip_tags($_REQUEST["showEditPost"]); 

			try {

					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);					
					
					$ebele_mark = "SELECT post_id, author_id, post_msg

									 FROM $cWallPostTB  
									 
									 WHERE post_id = :post_id
									 
									 AND author_id = :author_id ";
						 
				
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':post_id', $post_id);
					$igweze_prep->bindValue(':author_id', $member_id);				
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$post_id = $row['post_id'];  
							$author_id = $row['author_id'];
							$post_title = $row['post_title'];
							$post_msg = $row['post_msg'];

						}
						
						$DelPic = $wizGradeTemplate.'images/icon_del.gif';
						$post_msg = htmlspecialchars_decode($post_msg);
						$post_msgHolder = nl2br($post_msg);
					
$editPostDiv =<<<IGWEZE
				 <div id="editPostHolder-$post_id" class="display-none">$post_msgHolder</div>
				 
                 <div class="cmt-form">
				 <!-- form --><form method="POST" id="frmpostEdit-$post_id">
			
					<textarea  class="form-control cwall-edit-post-$post_id"  placeholder="Edit This Post" wrap="hard" 
						name="cwall-edit-post">$post_msg</textarea>
					<input type="hidden" name="postFData" value="editPostData" />
					<input type="hidden" name="PostID" value="$post_id" />
			
					<img src="$loader_img" alt="Loading >>>>>" id='postEditLoader-$post_id' style="cursor:pointer; float:left; 
					margin:8px 5px 5px 10px;  display:none;" />
					<button class="btn btn-danger pull-left cancelpostEdit" id="cancelpostEdit-$post_id">Cancel</button>
					<button class="btn btn-danger pull-right postEditStatus" id="postEdit-$post_id">Edit Post</button>

					
					</form><!-- / form -->
					
                 </div>
				 
				 <div class="clearfix"></div>


				

IGWEZE;
					echo $editPostDiv;	
					
					}else{
					
					
						$msg = 'Ooooops, Post was not successfully retrieve. Please try again';
						echo $errorMsg.$msg.$eEnd; echo $scrollUp; exit; 			
					
					}
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
				
		}


		if(isset($_REQUEST["showEditComment"]) && strlen($_REQUEST["showEditComment"])> 0 ){
		
			$post_data = $_REQUEST["showEditComment"]; 
			
			list ($comment_id, $post_id) = explode ("_", $post_data);

			try {

					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);					
					
					$ebele_mark = "SELECT comment_id, post_id, comment, comment_title, comment_pic, comment_date, comment_user	

									 FROM $cWallCommentTB 
									 
									 WHERE post_id = :post_id
									 
									 AND comment_id = :comment_id
									 
									 AND comment_user = :comment_user";
						 
				
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':post_id', $post_id);
					$igweze_prep->bindValue(':comment_id', $comment_id);
					$igweze_prep->bindValue(':comment_user', $member_id);				
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$comment_id = $row['comment_id'];
							$post_id = $row['post_id'];
							$comment = $row['comment'];
							$comment_title = $row['comment_title'];
							$comment_pic = $row['comment_pic'];
							$comment_date = $row['comment_date'];
							$comment_user = $row['comment_user'];

						}

						$comment = htmlspecialchars_decode($comment);
						$comment_msgHolder = nl2br($comment);
					

$editCommentDiv =<<<IGWEZE

				 <div id="editCommentHolder-$post_data" class="display-none">$comment_msgHolder</div>
				 
                 <div class="cmt-form">
				 <!-- form --><form method="POST" id="frmcommentEdit-$post_data">
			
					<textarea  class="form-control fcommentEditField-$post_data"  placeholder="Edit This Comment" wrap="hard" 
						name="fcommentEditField">$comment</textarea>
					<input type="hidden" name="postFData" value="editCommentData" />
					<input type="hidden" name="CPID" value="$post_data" />
			
					<img src="$loader_img" alt="Loading >>>>>" id='commentEditLoader-$post_data' style="cursor:pointer; float:left; 
					margin:8px 5px 5px 10px;  display:none;" />
					
					<button class="btn btn-danger pull-left cancelcommentEdit" id="cancelcommentEdit-$post_data">Cancel</button>
					<button class="btn btn-danger pull-right commentEditStatus" id="commentEdit-$post_data">Edit </button>

					
					</form><!-- / form -->
					
                 </div>
				 
				 <div class="clearfix"></div>


IGWEZE;
					echo $editCommentDiv;	
					
					}else{
										
						$msg = 'Ooooops, Comment was not successfully retrieve. Please try again';
						echo $errorMsg.$msg.$eEnd; echo $scrollUp; exit; 	
						
					}
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
				
				
				
		}

		if(isset($_REQUEST["deletePost"]) && strlen($_REQUEST["deletePost"])> 0 && is_numeric($_REQUEST["deletePost"])){
		
			$idToDelete = strip_tags($_REQUEST["deletePost"]); 

			try {
					
					$delStatus = postDeleteStatus($conn, $idToDelete);
					
					if($delStatus == $seVal) { 
					
						echo "<script type='text/javascript'> 
						alert('Oooops, Original Demo Post is hidden but cannot be totally deleted. However, you can add your post/pictures and delete it');
						</script>"; exit;
					
					}else{				
					
						$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
						
						list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
						
						unlinkTempUpload($conn, $member_id, $idToDelete);
						
						$ebele_mark = "DELETE 

										 FROM $cWallPostTB WHERE post_id = :post_id
										 
										 AND author_id = :author_id
										 
										 LIMIT 1";
							 
					
						$igweze_prep = $conn->prepare($ebele_mark);
						
						$igweze_prep->bindValue(':post_id', $idToDelete);
						$igweze_prep->bindValue(':author_id', $member_id);						 
						$igweze_prep->execute();
					
					}
				
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
		}
		
		
		if(isset($_REQUEST["deleteuploadPic"]) && strlen($_REQUEST["deleteuploadPic"])> 0){
		
			$uploadPic = $_REQUEST["deleteuploadPic"]; 
			$uploadPic = str_replace("foreal",".", $uploadPic);

			try {
				
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
					
					 $ebele_mark = "DELETE 

									 FROM $cWallTempUploadTB 
									 
									 WHERE upload_pathp = :upload_pathp	
									 
									 AND member_id = :member_id
									 
									 AND upload_type = :upload_type
									 
									 LIMIT 1";
						 
				
					$igweze_prep = $conn->prepare($ebele_mark);
					
					$igweze_prep->bindValue(':upload_pathp', $uploadPic);
					$igweze_prep->bindValue(':member_id', $member_id);
					$igweze_prep->bindValue(':upload_type', $fiVal); 
					
					if ($igweze_prep->execute()) { 
					
						if(file_exists($forumPicExtTem.$uploadPic)){ unlink($forumPicExtTem.$uploadPic); }  
										
					}				
				
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}

		}
		

		if(isset($_REQUEST["deleteProfPic"]) && strlen($_REQUEST["deleteProfPic"])> 0){
		
			$uploadPic = $_REQUEST["deleteProfPic"]; 

			try {
		 		
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);					
					
					$ebele_mark = "DELETE 

									 FROM $cWallTempUploadTB 
									 
									 WHERE upload_pathp = :upload_pathp	
									 
									 AND member_id = :member_id
									 
									 AND upload_type = :upload_type
									 
									 LIMIT 1";
						 
				
					$igweze_prep = $conn->prepare($ebele_mark);
					
					$igweze_prep->bindValue(':upload_pathp', $uploadPic);
					$igweze_prep->bindValue(':member_id', $member_id);
					$igweze_prep->bindValue(':upload_type', $seVal); 
					
					if ($igweze_prep->execute()) { 
					
						if(file_exists($forumPicExtTem.$uploadPic)){ unlink($forumPicExtTem.$uploadPic); } 
						
						echo '';

					}				
				
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}

	
				
		}

		
		if(isset($_REQUEST["likePostID"]) && strlen($_REQUEST["likePostID"])> 0 && is_numeric($_REQUEST["likePostID"])){
		
			$post_id = strip_tags($_REQUEST["likePostID"]); 

			try {
					
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
					
					$ebele_mark = "SELECT likes_id
					
									FROM $cWallLikesTB
					
									WHERE post_id = :post_id
									
									AND member_id = :member_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					
					$igweze_prep->bindValue(':post_id', $post_id);
					$igweze_prep->bindValue(':member_id', $member_id);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $i_false){
					
						$ebele_mark_1 = "INSERT INTO $cWallLikesTB(post_id, member_id)

																	VALUES (:post_id, :member_id)";

						$igweze_prep_1 = $conn->prepare($ebele_mark_1);

						$igweze_prep_1->bindValue(':post_id', $post_id);
						$igweze_prep_1->bindValue(':member_id', $member_id);
										 
						if ($igweze_prep_1->execute()) {
						
							$postComOwner = postAuthorByPostID($conn, $post_id);
								
							saveNotifications($conn, $postComOwner, $member_id, $post_id, $fiVal, $seVal);
						
						}
						
						$postLikes = companionWallLikes($conn, $post_id, $member_id); 
							
						echo $postLikes;
					
					}
					
					
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}

	
				
		}
		


		if(isset($_REQUEST["likeDetails"]) == 'postlikeDetails'){
		
			$post_id = strip_tags($_REQUEST["likePost"]); 

			try {
					
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);

					$postLikesMore = companionWallMoreLikes($conn, $post_id, $member_id); 
										
					echo $postLikesMore;
					
					
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}

	
				
		}

		
		if(isset($_REQUEST["deleteComment"]) && strlen($_REQUEST["deleteComment"])> 0 && is_numeric($_REQUEST["deleteComment"])){		
		
			$cIDToDelete = strip_tags($_REQUEST["deleteComment"]); 

			try {
					
					$delStatus = commentDeleteStatus($conn, $cIDToDelete); 
					
					if($delStatus == $seVal) { 
					
						echo "<script type='text/javascript'> 
						alert('Oooops, Original Demo Comment is hidden but cannot be totally deleted. However, you can add your comment and delete it');
						</script>"; exit;
					
					}else{
						
						$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
						
						list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
						
						$ebele_mark = "DELETE 

										 FROM $cWallCommentTB 
										 
										 WHERE comment_id = :comment_id
										 
										 AND comment_user = :comment_user
										 
										 LIMIT 1";
					
						$igweze_prep = $conn->prepare($ebele_mark);
						
						$igweze_prep->bindValue(':comment_id', $cIDToDelete);
						$igweze_prep->bindValue(':comment_user', $member_id);
						 
						$igweze_prep->execute();
						
						$postID = postIDBycommentID($conn, $cIDToDelete);
						$postComOwner = postAuthorByPostID($conn, $postID);							
						removeNotification($conn, $postComOwner, $member_id, $postID, $fiVal, $fiVal);
					
					}
			
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
		}
		


		if(isset($_REQUEST["dislikePostID"]) && strlen($_REQUEST["dislikePostID"])> 0 && is_numeric($_REQUEST["dislikePostID"])){
		
			$post_id = strip_tags($_REQUEST["dislikePostID"]); 

			try {

					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
					
					 $ebele_mark = "DELETE FROM $cWallLikesTB
					 
									WHERE post_id = :post_id
									 
									 AND member_id = :member_id";

					$igweze_prep = $conn->prepare($ebele_mark);

					$igweze_prep->bindValue(':post_id', $post_id);
					$igweze_prep->bindValue(':member_id', $member_id); 
					
					if ($igweze_prep->execute()) {
						
						$postComOwner = postAuthorByPostID($conn, $post_id);
						
						removeNotification($conn, $postComOwner, $member_id, $post_id, $fiVal, $seVal);
					
						$postLikes = companionWallLikes($conn, $post_id, $member_id); 
						
						echo $postLikes;
						
					}
			
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
		}
		
		
		
		if(isset($_REQUEST["likecommentID"]) && strlen($_REQUEST["likecommentID"])> 0 && is_numeric($_REQUEST["likecommentID"])){
		
			$comment_id = strip_tags($_REQUEST["likecommentID"]); 

			try {

					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
					
									$ebele_mark = "SELECT likes_id
					
									FROM $cWallLikesTB
					
									WHERE comment_id = :comment_id
									
									AND member_id = :member_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);					
					$igweze_prep->bindValue(':comment_id', $comment_id);
					$igweze_prep->bindValue(':member_id', $member_id);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $i_false){

						$ebele_mark_1 = "INSERT INTO $cWallLikesTB(comment_id, member_id)

																	VALUES (:comment_id, :member_id)";

						$igweze_prep_1 = $conn->prepare($ebele_mark_1);

						$igweze_prep_1->bindValue(':comment_id', $comment_id);
						$igweze_prep_1->bindValue(':member_id', $member_id);
										 
						
						if ($igweze_prep_1->execute()) {
						
							$postID = postIDBycommentID($conn, $comment_id);
							$postComOwner = postAuthorByPostID($conn, $postID);								
							saveNotifications($conn, $postComOwner, $member_id, $postID, $seVal, $seVal);
						
						}
					
					}
					
					
					$commentLikes = companionWallComLikes($conn, $comment_id, $member_id); 
						
					echo $commentLikes;				
			
			
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}

	
				
		}
		
		

		if(isset($_REQUEST["dislikecommentID"]) && strlen($_REQUEST["dislikecommentID"])> 0 && is_numeric($_REQUEST["dislikecommentID"])){
		
			$comment_id = strip_tags($_REQUEST["dislikecommentID"]); 

			try {

					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
					
					 $ebele_mark = "DELETE FROM $cWallLikesTB
					 
									WHERE comment_id = :comment_id
									 
									 AND member_id = :member_id";

					$igweze_prep = $conn->prepare($ebele_mark);

					$igweze_prep->bindValue(':comment_id', $comment_id);
					$igweze_prep->bindValue(':member_id', $member_id);
					
					if ($igweze_prep->execute()) {
					
						$postID = postIDBycommentID($conn, $comment_id);
						$postComOwner = postAuthorByPostID($conn, $postID);
						
						removeNotification($conn, $postComOwner, $member_id, $postID, $seVal, $seVal);
						
						$commentLikes = companionWallComLikes($conn, $comment_id, $member_id); 
						
						echo $commentLikes;
						
					}
						
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}

	
				
		}



		if(isset($_REQUEST["numOfCommentDiv"]) && strlen($_REQUEST["numOfCommentDiv"])> 0 && is_numeric($_REQUEST["numOfCommentDiv"])){
		
				$post_id = strip_tags($_REQUEST["numOfCommentDiv"]); 

				try {

					$commentDiv = commentsNum($conn, $post_id);
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
				echo $commentDiv;
				
				
		}


		if ($_REQUEST["deleteTempPics"] == 'deleteTempUpload' ){

				try {

		 		
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);				
					
					$status = 'deleteTempPic';
					
					removeTempUpload($conn, $member_id, $status);
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
				//echo $commentDiv;
				
		}


		if ($_REQUEST["postsType"] == 'companionWallUser'){
			
				$memberID = strip_tags($_REQUEST['memberID']);
		
				try {

					$memberInfo = companionWallUserDetails($conn, $memberID, $fiVal);
 
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);		
					 
					if ($member_id == '') { 
					
						$msg_i = "You are not allow to post on this forum. please contact your administrator for more info. Thanks"; 
						echo $infoMsg.$msg_i.$iEnd; exit; 			
					}else{
						
						
						userCompanionWall($conn, $memberID);	
					
					}
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
								
				
		}


		if ($_REQUEST["postsType"] == 'filterCWallPosts'){
			
				$filterVal = strip_tags($_REQUEST['filterVal']);
		
				try {
		 		
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
						  $wallPic, $load_page) = explode ("##", $memberInfo);				
					
					
					loadCompanionWall($conn, $filterVal, $m_dept, $m_faculty);
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
								
				
		}


		if ($_REQUEST["postsType"] == 'filterCWallSetting'){
			
				$filterVal = strip_tags($_REQUEST['filterVal']);
		
				try {
		 		
						$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
				
						list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
						$wallPic, $load_page) = explode ("##", $memberInfo);				
				
						$ebele_mark = "UPDATE $wizGradeCWallTB 
								
										SET 
										
										load_page = :load_page
										
										WHERE member_id = :member_id";

		        		$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':load_page', $filterVal);
						$igweze_prep->bindValue(':member_id', $member_id);
						
						if ($igweze_prep->execute()){
						
							$msg_s = "<b>$m_name</b>, your news feed filter settings was 
							successfully updated";
							echo $succesMsg.$msg_s.$sEnd; 

							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;
						
						}else{
							
							$msg_e = "Ooooops Something went wrong while update your news feed filter settings, please try again";
							echo $errorMsg.$msg_e.$eEnd; exit;

						
						}
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
		}

		if ($_REQUEST["postsType"] == 'validateEmail'){
			
				$filterVal = strip_tags($_REQUEST['filterVal']);
		
				if ((strlen($filterVal) < $thVal) || (strlen($filterVal) > 20) || (!ctype_alnum($filterVal))){
					
					$msg_e = "Email Address must be more than <b> 3 
					(three)  &amp; less than 20 digit</b>. Must contain only <b> 
					Alphabet &amp; Numbers eg Nkiruka, Jennifer004</b> ";
						echo $errorMsg.$msg_e.$eEnd;
					
					echo "<script type='text/javascript'> $('.AvailEmail').fadeOut(300); $('.ExitsEmail').fadeOut(300); 
												 $('.registerCMail').fadeOut(300); 
						</script>"; exit;
	
					
					
				}else{
					
					try {

						$ebele_mark = "SELECT member_id
				
										 FROM $wizGradeCWallTB

											WHERE member_mail = :member_mail";
							 
						$igweze_prep = $conn->prepare($ebele_mark);						
						$igweze_prep->bindValue(':member_mail', $filterVal);
						
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count >= $foreal) {
							
							echo "<script type='text/javascript'> $('.AvailEmail').fadeOut(300); $('.ExitsEmail').fadeIn(300); 
														$('#cMailUser').removeClass('spinner'); $('.registerCMail').fadeOut(300); 
														$('.alert').fadeOut(300); </script>"; exit;
						
						}else{
							
							echo "<script type='text/javascript'> $('.ExitsEmail').fadeOut(300); $('.AvailEmail').fadeIn(300); 
							$('#cMailUser').removeClass('spinner'); $('.registerCMail').fadeIn(300);
							$('.alert').fadeOut(300); </script>"; exit;
						}

						
								
					}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
				}
				
				
				}
								
				
		}

		if ($_REQUEST["postsType"] == 'registerMail'){
			
				$filterVal = strip_tags($_REQUEST['filterVal']);
		
				if ((strlen($filterVal) < $thVal) || (strlen($filterVal) > 20) || (!ctype_alnum($filterVal))){
					
					$msg_e = "Email Address must be more than <b> 3 
					(three)  &amp; less than 20 digit</b>. Must contain only <b> 
					Alphabet &amp; Numbers eg Nkiruka, Jennifer004</b> ";
			   		echo $errorMsg.$msg_e.$eEnd;
					
					echo "<script type='text/javascript'> $('.AvailEmail').fadeOut(300); $('.ExitsEmail').fadeOut(300); 
												 $('.registerCMail').fadeOut(300); 
						</script>"; exit;
	
					
					
				}else{
					
					try {

						$ebele_mark = "SELECT member_id
				
										 FROM $wizGradeCWallTB

											WHERE member_mail = :member_mail";
							 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':member_mail', $filterVal);
						
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count >= $foreal) {
							
								echo "<script type='text/javascript'> $('.AvailEmail').fadeOut(300); $('.ExitsEmail').fadeIn(300); 
														$('#cMailUser').removeClass('spinner'); $('.registerCMail').fadeOut(300); 
														$('.alert').fadeOut(300); </script>"; exit;
						
						}else{							
							
								$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
						
								list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
									$wallPic, $load_page) = explode ("##", $memberInfo);				
						
						
								$ebele_mark_1 = "UPDATE $wizGradeCWallTB 
										
												SET 
												
												member_mail = :member_mail
												
												WHERE member_id = :member_id";

								$igweze_prep_1 = $conn->prepare($ebele_mark_1);
								$igweze_prep_1->bindValue(':member_mail', $filterVal);
								$igweze_prep_1->bindValue(':member_id', $member_id);
								
								if ($igweze_prep_1->execute()){
									
									$newUserEmail = $filterVal.'@wizgrade.com';
									
									$msg_s = "<b>$m_name</b>, your email address <b>($newUserEmail)</b> was successfully saved";
									echo $succesMsg.$msg_s.$sEnd;
									
									echo "<script type='text/javascript'> $('#cMailUser').removeClass('spinner'); 
									$('.wizgrade-section-div').slideUp(1000); 	
									$('.registerCMail').fadeOut(300);  $('#CompEMailDiv').html('$newUserEmail');
									</script>"; exit; 
								
								}else{
									
									$msg_e = "Ooooooops Something went wrong while saving your Email Address, please try again";
									echo $errorMsg.$msg_e.$eEnd; exit;
								
								}
							
						}
 
								
					}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}
				
				
				}
								
				
		}
 

		if ($_REQUEST["postsType"] == 'companionWallPosts'){
		
				try {
		 		
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $load_page) = explode ("##", $memberInfo);				
					
					loadCompanionWall($conn, $load_page, $m_dept, $m_faculty);
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
								
				
		}

		
		if ($_REQUEST["postsType"] == 'uploadProfPic'){
		
				try {
		 		
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);				
					
					loadCompanionWall($conn);
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
								
				
		}
		

		exit; 
?>