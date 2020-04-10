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
	This script validate companion mail module
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 

			require ($wizGradevalidater); 
		
			
			/* load mail through post */
			
			if(isset($_REQUEST["sendMailPosts"]) && strlen($_REQUEST["sendMailPosts"])> 0 && 
			isset($_REQUEST["Member"]) && strlen($_REQUEST["Member"])> 0){
		
				/* script validation */
				
				$post_id = strip_tags($_REQUEST["sendMailPosts"]); 
				$member_id = strip_tags($_REQUEST["Member"]); 
			
				try {

					$memberInfo = companionWallUserDetails($conn, $member_id, $fiVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);				
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				

$mailBoxDiv =<<<IGWEZE

							<section class="panel postMailBoxDiv_$post_id">
							<header class="panel-heading" style="background-color:#fff; color:#000; margin-top:15px;">
								Compose Message <a href="javascript:;" style = "float:right;" title="Exit Message Box" 
								id="exitPostMailBoxDiv-$post_id"
								class="exitPostMailBoxDiv clearfix"> <i class="fa  fa-times"></i> </a>
							</header>
							<div class="panel-body">
							
                              <!-- form --><form class="form-horizontal" id="frmmailBoxPosts-$post_id" role="form"> 
                                 
                                  <div class="form-group">
                                      <div class="col-lg-12">
                                          <div class="iconic-input">
                                              <i class="fa  fa-envelope-o"></i>
                                              <input type="text" class="form-control" value="$m_name" disabled
                                              name="Recep" id="Recep" />
											  <input type="hidden" name="mailBoxData" value="sendWCReplyMail" />
											  <input type="hidden" name="recepID" value="$member_id" />
											  <input type="hidden" name="recepName" value="$m_name" />
											  <input type="hidden" name="mailID" value="$post_id" />
											  <input type="hidden" name="mailType" value="Post" />
                                          </div>
                                      </div>
                                  </div>
                                  
                                 <div class="form-group">
                                      <div class="col-lg-12">
                                          <div class="iconic-input">
                                              <i class="fa fa-comment-o"></i>
                                              <input type="text" class="form-control" placeholder="Write your mesaage title here" 
                                              name="msgTitle" id="msgTitle" required />
                                          </div>
                                      </div>
                                  </div> 

                                  <div class="form-group">
                                      <div class="col-lg-12">
                                          <div class="iconic-input">
                                              <i class="fa fa-envelope"></i>
                                              <textarea class="form-control" name="Message" id="Message" 
											  style="padding: 5px 30px;"
                                              placeholder="Write your mesaage here" rows="10" required></textarea>
                                             
                                          </div>
                                      </div>
                                  </div> 

                                 <div class="form-group">
                                      <div class="col-lg-2">                                           
                                          <button type="submit" class="btn btn-danger buttonMargin sendMailPComp" id="mailBoxPosts-$post_id">
                                          <i class="fa fa-mail-forward"></i> Send Message </button>                                          
                                      </div>									  
									  <img src="$loader_img" alt="Loading >>>>>" class="pull-right" id='wallpostLoader-$post_id' 
									  style="cursor:pointer; display:none; margin-right:5%;" /> 
                                  </div> 

                              </form><!-- / form -->
							  </div>
                         
						</section>
				 
						<div class="clearfix"></div>

IGWEZE;
						echo $mailBoxDiv;	


				

		}

		/* load mail through comment */
		
		if(isset($_REQUEST["sendMailComments"]) && strlen($_REQUEST["sendMailComments"])> 0 && 
			isset($_REQUEST["Comment"]) && strlen($_REQUEST["Comment"])> 0 && 														
			isset($_REQUEST["Member"]) && strlen($_REQUEST["Member"])> 0){
			
			/* script validation */
			
			$post_id = strip_tags($_REQUEST["sendMailComments"]); 
			$comment_id = strip_tags($_REQUEST["Comment"]); 
			$member_id = strip_tags($_REQUEST["Member"]); 
			$mailData = $post_id.'-'.$comment_id.'-'.$member_id;
			$mailDataSE = $post_id.'_'.$comment_id.'_'.$member_id;

			
				try {

					$memberInfo = companionWallUserDetails($conn, $member_id, $fiVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);				
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				

$mailBoxDiv =<<<IGWEZE

							<section class="panel commentMailBoxDiv_$mailDataSE">
							<header class="panel-heading" style="background-color:#fff; color:#000; margin-top:15px;">
								Compose Message <a href="javascript:;" style = "float:right;" title="Exit Message Box" 
								id="exitCommentMailBoxDiv-$mailData"
								class="exitCommentMailBoxDiv clearfix"> <i class="fa  fa-times"></i> </a>
							</header>
							<div class="panel-body"> 
							
                              <!-- form --><form class="form-horizontal" id="frmmailBoxComments-$mailData" role="form"> 
                                 
                                  <div class="form-group">
                                      <div class="col-lg-12">
                                          <div class="iconic-input">
                                              <i class="fa  fa-envelope-o"></i>
                                              <input type="text" class="form-control" value="$m_name" disabled
                                              name="Recep" id="Recep" />
											  <input type="hidden" name="mailBoxData" value="sendWCReplyMail" />
											  <input type="hidden" name="recepID" value="$member_id" />
											  <input type="hidden" name="recepName" value="$m_name" />
											  <input type="hidden" name="mailID" value="$mailDataSE" />
											  <input type="hidden" name="mailType" value="Comment" />
                                          </div>
                                      </div>
                                  </div>
                                  
                                 <div class="form-group">
                                      <div class="col-lg-12">
                                          <div class="iconic-input">
                                              <i class="fa fa-comment-o"></i>
                                              <input type="text" class="form-control" placeholder="Write your mesaage title here" 
                                              name="msgTitle" id="msgTitle" required />
                                          </div>
                                      </div>
                                  </div> 

                                  <div class="form-group">
                                      <div class="col-lg-12">
                                          <div class="iconic-input">
                                              <i class="fa fa-envelope"></i>
                                              <textarea class="form-control" name="Message" id="Message" 
											  style="padding: 5px 30px;"
                                              placeholder="Write your mesaage here" rows="10" required></textarea>
                                             
                                          </div>
                                      </div>
                                  </div> 

                                 <div class="form-group">
                                      <div class="col-lg-2">                                           
                                         <button type="submit" class="btn btn-danger buttonMargin sendMailCComp" id="mailBoxComments-$mailData">
                                         <i class="fa fa-mail-forward"></i> Send Message </button>                                          
                                      </div>									  
									  <img src="$loader_img" alt="Loading >>>>>" class="pull-right" id='wallCommentLoader-$mailData' 
									  style="cursor:pointer; display:none; margin-right:5%;" /> 
                                  </div>
  

                              </form><!-- / form -->
							  </div>
                         
						</section>
				 
						<div class="clearfix"></div>


IGWEZE;
						echo $mailBoxDiv;	 
				

		}

		/* load reports through post */

		if(isset($_REQUEST["sendReportPosts"]) && strlen($_REQUEST["sendReportPosts"])> 0 && 
			isset($_REQUEST["Member"]) && strlen($_REQUEST["Member"])> 0){
		
			/* script validation */
			
			$post_id = strip_tags($_REQUEST["sendReportPosts"]); 
			$member_id = strip_tags($_REQUEST["Member"]);  
			
				try {

					$memberInfo = companionWallUserDetails($conn, $member_id, $fiVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);				
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				

$reportBoxDiv =<<<IGWEZE

						  <section class="panel postReportBoxDiv_$post_id">
                          <header class="panel-heading" style="background-color:#fff; color:#000; margin-top:15px;">
                             Send Report Message <a href="javascript:;" style = "float:right;" title="Exit Message Box" 
							 id="exitPostReportBoxDiv-$post_id"
							class="exitPostReportBoxDiv clearfix"> <i class="fa  fa-times"></i> </a>
                          </header>
                          <div class="panel-body">

                              <!-- form --><form class="form-horizontal" id="frmReportBoxPosts-$post_id" role="form">                              
                                 
                                  <div class="form-group">
                                      <div class="col-lg-12">
                                          <div class="iconic-input">
                                              <i class="fa  fa-envelope-o"></i>
                                              <input type="email" class="form-control" placeholder="$m_name" disabled
                                              name="title" id="title" required />
                                          </div>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="col-lg-12">
                                          <div class="iconic-input">
                                              <i class="fa fa-envelope"></i>
                                              <textarea class="form-control" name="message" id="message" style="padding: 5px 30px;"
                                              placeholder="Write your mesaage here" rows="10" required></textarea>
                                             
                                          </div>
                                      </div>
                                  </div>

                                 <div class="form-group">
                                      <div class="col-lg-2">                                           
                                          <button type="submit" class="btn btn-danger buttonMargin exitPostReportBoxDiv" 
										  id="exitPostReportBoxDiv-$post_id">
                                          <i class="fa fa-mail-forward"></i> Send Report </button>                                                                                   
                                      </div>
                                  </div> 

                              </form><!-- / form -->
							  </div>
                         
						</section>
				 
						<div class="clearfix"></div> 

IGWEZE;
						echo $reportBoxDiv;	 
				
		}

		/* load report through comment */
		
		if(isset($_REQUEST["sendReportComments"]) && strlen($_REQUEST["sendReportComments"])> 0 && 
			isset($_REQUEST["Comment"]) && strlen($_REQUEST["Comment"])> 0 && 														
			isset($_REQUEST["Member"]) && strlen($_REQUEST["Member"])> 0){
		
			/* script validation */
			
			$post_id = strip_tags($_REQUEST["sendReportComments"]); 
			$comment_id = strip_tags($_REQUEST["Comment"]); 
			$member_id = strip_tags($_REQUEST["Member"]); 
			$reportData = $post_id.'-'.$comment_id.'-'.$member_id;
			$reportDataSE = $post_id.'_'.$comment_id.'_'.$member_id;

			
				try {

					$memberInfo = companionWallUserDetails($conn, $member_id, $fiVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);				
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				

$reportBoxDiv =<<<IGWEZE

						  <section class="panel commentReportBoxDiv_$reportDataSE">
                          <header class="panel-heading" style="background-color:#fff; color:#000; margin-top:15px;">
                             Send Report <a href="javascript:;" style = "float:right;" title="Exit Message Box" 
							 id="exitCommentReportBoxDiv-$reportData"
							class="exitCommentReportBoxDiv clearfix"> <i class="fa  fa-times"></i> </a>
                          </header>
                          <div class="panel-body">

                              <!-- form --><form class="form-horizontal" id="frmReportBoxComments-$reportData" role="form">                              
                                 
                                  <div class="form-group">
                                      <div class="col-lg-12">
                                          <div class="iconic-input">
                                              <i class="fa  fa-envelope-o"></i>
                                              <input type="email" class="form-control" placeholder="$m_name" disabled
                                              name="title" id="title" required />
                                          </div>
                                      </div>
                                  </div>                                  

                                  <div class="form-group">
                                      <div class="col-lg-12">
                                          <div class="iconic-input">
                                              <i class="fa fa-envelope"></i>
                                              <textarea class="form-control" name="message" id="message" style="padding: 5px 30px;"
                                              placeholder="Write your mesaage here" rows="10" required></textarea>
                                             
                                          </div>
                                      </div>
                                  </div>

                                 <div class="form-group">
                                      <div class="col-lg-2">                                           
                                          <button type="submit" class="btn btn-danger buttonMargin exitCommentReportBoxDiv" 
										  id="exitCommentReportBoxDiv-$reportData">
                                          <i class="fa fa-mail-forward"></i> Send Report </button>
                                      </div>
                                  </div>  

                              </form><!-- / form -->
							  </div>
                         
						</section>
				 
						<div class="clearfix"></div>


IGWEZE;
						echo $reportBoxDiv;	 

		}

		/* reply mail script */
		
		if (($_REQUEST['mailBoxData']) == 'sendWCReplyMail') {

			try {

					$msgTitle = $_REQUEST['msgTitle'];
					$recepName = $_REQUEST['recepName'];
					$recepID = $_REQUEST['recepID'];
					$mailMsg = $_REQUEST['Message'];
					$mailID = $_REQUEST['mailID'];
					$mailType = $_REQUEST['mailType'];
					$replyMsg = $_REQUEST['replyMsg'];
					
									 
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
					
					/* script validation */
					
					if($recepID == ''){
					
							$msg_e = "This Mail recepient cannot receive message. Thanks"; 
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
											
					}elseif ($member_id == '') { 
					
							$msg_e = "You are not allow to post on Companion Wall. please contact your administrator for more info. Thanks"; 
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
											
					}elseif ($msgTitle == '') { 
					
							$msg_e = "Ooooooooops, please type your mail title"; 					
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
											
					}elseif ($mailMsg == '') { 
					
							$msg_e = "Ooooooooops, please type your mail message"; 					
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
							
					}else{  /* validate and insert mail */
						

						$time = strtotime(date("Y-m-d H:i:s"));
						$uip = $_SERVER['REMOTE_ADDR'];
						$mailMsg = str_replace('<br />', "\n", $mailMsg);
						
						$msgTitle = htmlspecialchars($msgTitle);
						$mailMsg = htmlspecialchars($mailMsg); 
						
						$msgTypefi = msgSentType($conn, $recepID);  /* retrieve companion sent mail type */
						$msgTypese = msgSentType($conn, $member_id);  /* retrieve companion sent mail type */						
						$msgType = returnMsgSentType($msgTypefi, $msgTypese);  /* return companion sent mail type */				
						

						$ebele_mark = "INSERT INTO $wizGradeMailBoxTB (njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, 
																 njnk_sender_ip, njnk_type)

										 VALUES (:njnk_title, :njnk_msg, :njnk_time, :njnk_status, :njnk_sender_id, :njnk_reps_id, :njnk_sender_ip,
												 :njnk_type)";

						$igweze_prep = $conn->prepare($ebele_mark);

						$igweze_prep->bindValue(':njnk_title', $msgTitle);
						$igweze_prep->bindValue(':njnk_msg', $mailMsg);
						$igweze_prep->bindValue(':njnk_time', $time);
						$igweze_prep->bindValue(':njnk_status', $foreal);
						$igweze_prep->bindValue(':njnk_sender_id', $member_id);
						$igweze_prep->bindValue(':njnk_reps_id', $recepID);
						$igweze_prep->bindValue(':njnk_sender_ip', $uip);
						$igweze_prep->bindValue(':njnk_type', $msgType);
									
						if ($igweze_prep->execute()){  /* if successfully */
						
							if(isset($replyMsg) == 'replyMsg'){
								
								$sentMsg = numOfSentMsg($conn, $member_id);	

								$msg_s = "Your mail was successfully Reply to <b>$recepName</b>"; 
								
								echo $succesMsg.$msg_s.$sEnd;								
								echo "<script type='text/javascript'> $('#replymsgBoxDiv').slideUp(800); 
								$('.SenttMsgNum').html('$sentMsg');	 </script>"; exit;

							}else{

								if($mailType == 'Post') {echo "<script type='text/javascript'> $('.alert').fadeOut(15000); 
																$('#mailReportPostsDiv_".$mailID."').fadeOut(1000);
														</script>";	}

								if($mailType == 'Comment') {echo "<script type='text/javascript'> $('.alert').fadeOut(15000); 
																$('#mailReportCommentsDiv_".$mailID."').fadeOut(1000);
														</script>";	}
								
								$msg_s = "Your mail was successfully sent to <b>$recepName</b>"; 
								
								echo $succesMsg.$msg_s.$sEnd; exit;
							
							}

						}else{  /* display error */
							
								$msg_e = "Ooooops Something went wrong while sending your mail, please try again";
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
						
						}
					
					
					
					}
				
						
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
		}

		/* send mail scripts */
		
		if (($_REQUEST['messageData']) == 'sendNjidekaMail') {

				try {

						$msgEmail = $_REQUEST['msgEmail'];
						$msgTitle = $_REQUEST['msgTitle'];
						$mailMsg = $_REQUEST['Message'];
						$member_id = strip_tags($_REQUEST['memberID']);
						
						$recepID = emailValidator($conn, $msgEmail);  /* check if email exits or not */
						
						/* script validation */
						
						if($recepID == ''){

							$msg_e = "Cannot send this mail, however this email do not exists. Thanks"; 
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					

						}elseif ($member_id == '') { 

							$msg_e = "You are not allow to send mail. please contact your administrator for more info. Thanks"; 
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					

						}elseif ($member_id == $recepID) { 

							$msg_e = "Ooooooooops, You cannot send mail to yourself. Thanks"; 
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					

						}elseif ($msgTitle == '') { 

							$msg_e = "Ooooooooops, please type your mail title"; 
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					

						}elseif ($mailMsg == '') { 

							$msg_e = "Ooooooooops, please type your mail message"; 
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
							
						}else{  /* validate and insert mail */

							$time = strtotime(date("Y-m-d H:i:s"));
							$uip = $_SERVER['REMOTE_ADDR'];
							$mailMsg = str_replace('<br />', "\n", $mailMsg);
							
							$msgTitle = htmlspecialchars($msgTitle);
							$mailMsg = htmlspecialchars($mailMsg);

							$ebele_mark = "INSERT INTO $wizGradeMailBoxTB (njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, 
																	 njnk_sender_ip, njnk_type)

											 VALUES (:njnk_title, :njnk_msg, :njnk_time, :njnk_status, :njnk_sender_id, :njnk_reps_id, :njnk_sender_ip,
													 :njnk_type)";

							$igweze_prep = $conn->prepare($ebele_mark);

							$igweze_prep->bindValue(':njnk_title', $msgTitle);
							$igweze_prep->bindValue(':njnk_msg', $mailMsg);
							$igweze_prep->bindValue(':njnk_time', $time);
							$igweze_prep->bindValue(':njnk_status', $foreal);
							$igweze_prep->bindValue(':njnk_sender_id', $member_id);
							$igweze_prep->bindValue(':njnk_reps_id', $recepID);
							$igweze_prep->bindValue(':njnk_sender_ip', $uip);
							$igweze_prep->bindValue(':njnk_type', $foreal); 
							
							if ($igweze_prep->execute()){  /* if successfully */
							
								$sentMsg = numOfSentMsg($conn, $member_id);  /* number of user sent mail */

								echo "<script type='text/javascript'> var Empty = '';
										$('#showSuccessSent').show(); 
										$('#showSuccessSent').fadeOut(18000); 
										$('.SenttMsgNum').html('$sentMsg');	
										$('#inboxmsgBoxDiv').fadeOut(1000);
										$('.showInbox').trigger('click');
										$('#msgEmail').val(Empty);
										$('#msgTitle').val(Empty);
										$('#Message').val(Empty);
								</script>"; exit;	


							}else{  /* display error */
								
								$msg_e = "Ooooops Something went wrong while sending your mail, please try again";
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
							
							} 
						
						
						}
				
						
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
		}

		/*  draft mail script */
		
		if (($_REQUEST['messageData']) == 'saveDraftMail') {

			try {

						
					$msgTitle = $_REQUEST['msgTitle'];
					$mailMsg = $_REQUEST['mailMsg'];
					$member_id = strip_tags($_REQUEST['memberID']);

					/* script validation */
					
					if ($msgTitle == '') { 

						$msg_e = "Ooooooooops, please type your mail title";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					

					}elseif ($member_id == '') { 

						$msg_e = "You are not allow to send mail. please contact your administrator for more info. Thanks"; 
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					

					}elseif ($mailMsg == '') { 

						$msg_e = "Ooooooooops, please type your mail message"; 
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
						
					}else{  /* validate and draft mail  */

						$time = strtotime(date("Y-m-d H:i:s"));
						$uip = $_SERVER['REMOTE_ADDR'];
						$mailMsg = str_replace('<br />', "\n", $mailMsg);
						
						$msgTitle = htmlspecialchars($msgTitle);
						$mailMsg = htmlspecialchars($mailMsg);

						$ebele_mark = "INSERT INTO $wizGradeMailBoxTB (njnk_title, njnk_msg, njnk_time, njnk_status, njnk_reps_id, njnk_sender_ip, njnk_type)

										 VALUES (:njnk_title, :njnk_msg, :njnk_time, :njnk_status, :njnk_reps_id, :njnk_sender_ip, :njnk_type)";

						$igweze_prep = $conn->prepare($ebele_mark);

						$igweze_prep->bindValue(':njnk_title', $msgTitle);
						$igweze_prep->bindValue(':njnk_msg', $mailMsg);
						$igweze_prep->bindValue(':njnk_time', $time);
						$igweze_prep->bindValue(':njnk_status', $foreal);
						$igweze_prep->bindValue(':njnk_reps_id', $member_id);
						$igweze_prep->bindValue(':njnk_sender_ip', $uip);
						$igweze_prep->bindValue(':njnk_type', $thVal); 
									
						if ($igweze_prep->execute()){  /* if successfully */
						
							$draftMsg = numOfDraftMsg($conn, $member_id);

							echo "<script type='text/javascript'> var Empty = '';
										$('#showSuccessDraft').show(); 
										$('#showSuccessDraft').fadeOut(18000); 
										$('.draftMsgNum').html('$draftMsg');	
										$('#inboxmsgBoxDiv').fadeOut(1000);
										$('.showInbox').trigger('click');
										$('#msgEmail').val(Empty);
										$('#msgTitle').val(Empty);
										$('#Message').val(Empty);
								</script>"; exit;	


						}else{
							
							$msg_e = "Ooooops Something went wrong while saving your mail, please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(15000); </script>"; exit;					
						
						}
					
					
					}
				
						
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
		}

		/* show inbox script */
		
		if ($_REQUEST["messageData"] == 'showInboxMsg'){

				$member_id = strip_tags($_REQUEST['memberID']);
		
				try {
		 				
							if(isset($_SESSION['wallComRank'])){
					 			
								companionInbox($conn, $member_id, $seVal, $i_false);  /* load companion inbox information */
								
							}else{
								
								companionInbox($conn, $member_id, $fiVal, $i_false);  /* load companion inbox information */
								
							}
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
								
		}

		/* show sent mail */
		
		if ($_REQUEST["messageData"] == 'showSentMsg'){

				$member_id = strip_tags($_REQUEST['memberID']);
		
				try { 
				
					companionSentMsg($conn, $member_id, $i_false);  /* load sent mail */
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}					
				
		}

		/* show admin mail */
		
		if ($_REQUEST["messageData"] == 'showAdminMail'){

				$member_id = strip_tags($_REQUEST['memberID']);
		
				try {		 				
				
					companionInbox($conn, $member_id, $seVal, $i_false);   /* load companion inbox information */
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}		
				
		}
		
		/* show draft mail */
		
		if ($_REQUEST["messageData"] == 'showDraftMail'){

				$member_id = strip_tags($_REQUEST['memberID']);
		
				try {		 				
				
					companionInbox($conn, $member_id, $thVal, $i_false);   /* load companion inbox information */
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				} 			
				
		}

		/* show trash mail */
		
		if ($_REQUEST["messageData"] == 'showTrashMail'){

				$member_id = strip_tags($_REQUEST['memberID']);
		
				try {		 				
				
					companionInbox($conn, $member_id, $foVal, $i_false);  /* load companion inbox information */
							
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				} 			
				
		}


		/* trash mail script */
		
		if ($_REQUEST["messageData"] == 'trashMailView'){

			$msgID = strip_tags($_REQUEST['msgID']);
			$member_id = strip_tags($_REQUEST['memberID']);
			
			if (($msgID == '') || ($member_id == '')){
														 
					$msg_e = "Ooooops Something went wrong while tring to trash your mail, please try again";
			   		echo $errorMsg.$msg_e.$eEnd; exit; 
					
	        }else{
		
				try {
					
						$msgType =  msgTypeStatus($conn, $msgID);  /* retrieve companion inbox mail type */

						$ebele_mark = "UPDATE $wizGradeMailBoxTB 
						
										SET 
									
										njnk_type = :njnk_type,
										njnk_trash = :njnk_trash

										WHERE msg_id = :msg_id
										
										AND njnk_reps_id = :njnk_reps_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
					
						$igweze_prep->bindValue(':njnk_reps_id', $member_id);
						$igweze_prep->bindValue(':njnk_type', $foVal);
						$igweze_prep->bindValue(':njnk_trash', $msgType);
						$igweze_prep->bindValue(':msg_id', $msgID);
						
						if($igweze_prep->execute()){

							if(isset($_SESSION['wallComRank'])){
							
								companionInbox($conn, $member_id, $seVal, $i_false);   /* load companion inbox information */
							
							}else{
							
								companionInbox($conn, $member_id, $fiVal, $i_false);   /* load companion inbox information */
							
							}
						
							$trashMsg = numOfTrashMsg($conn, $member_id);  /* number of trash mail */							
							echo  "<script type='text/javascript'> $('.TrashMsgNum').html('$trashMsg');	 </script>";
							
						}else{
							
							$msg_e = "Ooooops Something went wrong while tring to trash your mail, please try again";
							echo $errorMsg.$msg_e.$eEnd; exit;

						}	
									   
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
				
			}
								
				
		}

		/* view email script */
		
		if ($_REQUEST["messageData"] == 'viewNkirukaMail'){

				$msgID = strip_tags($_REQUEST['msgID']);
				$member_id = strip_tags($_REQUEST['memberID']);
				$sender_id = strip_tags($_REQUEST['senderID']);				
				viewCompanionMail($conn, $msgID, $member_id, $sender_id);  /* view companion mail */
				
		}
		
					
		/* view sent email script */
		
		if ($_REQUEST["messageData"] == 'viewNkirukaSentMail'){

			$msgID = strip_tags($_REQUEST['msgID']);
			$member_id = strip_tags($_REQUEST['memberID']);
			
			/* script validation */
			
			if (($msgID == '') || ($member_id == '')){
														 
					$msg_e = "Ooooops Something went wrong while tring to retrieve your sent mail, please try again";
			   		echo $errorMsg.$msg_e.$eEnd; exit; 
					
	        }else{  /* select sent mail */
				
			
				try {
		 				
				
				
						$ebele_mark = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, njnk_type
						
                     		     		FROM $wizGradeMailBoxTB
										
										WHERE njnk_sender_id = :njnk_sender_id
										
										AND msg_id = :msg_id";

						$igweze_prep = $conn->prepare($ebele_mark);	 
						$igweze_prep->bindValue(':njnk_sender_id', $member_id);
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
							$memberInfo = companionWallUserDetails($conn, $njnk_reps_id, $fiVal);  /* retrieve student companion details */
					
							list ($senderID, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
							$wallPic, $load_page) = explode ("##", $memberInfo);									
							
							$njnk_title = htmlspecialchars_decode($njnk_title);
							$njnk_msg = htmlspecialchars_decode($njnk_msg);					
						
							$njnk_msg = nl2br($njnk_msg);
							
							$msgTime = wallTimerBoy($njnk_time);  /* companion wall time ago */
							$msgTime = date("F d, Y h:i:s", $njnk_time);					
							
							if ( (is_null($prof_pic)) || ($prof_pic == '-') || (!file_exists($forumPicExt.$prof_pic)) ){ 
							$senderPic = $wizGradeDefaultPic; }
						
							else { $senderPic = $forumPicExt.$prof_pic; }

							if($userMail == '-'){
					
								$senderMail = '';
					
							}else{
					
								$senderMail = '['.$userMail.'@wizgrade.com]';
					
							}
							  
							echo "<script type='text/javascript'> $('#mailTopTitle').html('View Sent Message');
																	  $('#mailTitleHolder').html('View Sent Message');</script>";

$nkiruViewBox =<<<IGWEZE
					   <div id="wizGradePrintArea">	
                      <div class="inbox-body" id="inboxmsgBoxDiv">
                              <div class="heading-inbox row">
                                  <div class="col-md-8">
                                      <div class="compose-btn">
                                         
                                          <button title="" data-placement="top" data-toggle="tooltip" type="button" id="printer-btn"
                                          data-original-title="Print" class="btn btn-sm tooltips"><i class="fa fa-print"></i> </button>
                                          
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
                                         
                                          From <strong> Me</strong>
										  to
										  <img src="$senderPic" height="60px" width="64px" alt="Mail Sender Picture">
										  <strong>$m_name</strong>
                                          <span>$senderMail</span>
										  
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
						  
						   </div>


IGWEZE;
						
					
							echo $nkiruViewBox;
				
						}else{  /* display error */
						
							$msg_e = "Ooooops Something went wrong while tring to retrieve your sent mail, please try again";
							echo $errorMsg.$msg_e.$eEnd; exit;


						}
			   
			   						
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
			}			
				
		}
		
		/* paginate mail script */ 				

		if ($_REQUEST["messageData"] == 'paginateMail'){

			$member_id = strip_tags($_REQUEST['memberID']);
			$inboxType = $_REQUEST['inboxType'];
			$offSetVal = $_REQUEST['offsetVal'];
			$totalCount = $_REQUEST['totalCount'];
			
			$nextPageOff = $offSetVal + 10;
			$prevPageOff = $offSetVal - 10;
			$pagiNext = $offSetVal + $fiVal;
			$nextPage = $offSetVal + 10;
			
			if($totalCount <= 10){

				$nextPage = $totalCount;
				$pagiDetail = $pagiNext.'-'.$nextPage;

				echo  "<script type='text/javascript'> $('.prevMailBtn').fadeOut(10);  $('.nextMailBtn').fadeOut(10); 
												   
												   $('#pagiDetailsDiv').html('$pagiDetail');
				</script>";
				  
				  
			}else{
				
				if($nextPageOff > $totalCount){ $nextPage = $totalCount; }

				$pagiDetail = $pagiNext.'-'.$nextPage;
				
				if($prevPageOff <= $i_false){
					
						echo  "<script type='text/javascript'> $('.prevMailBtn').fadeOut(10);  $('.nextMailBtn').fadeIn(10); 
													   $('#prevPageDiv').html('');	
													   $('#pagiDetailsDiv').html('$pagiDetail'); $('#nextPageDiv').html('10');
						</script>";			
				
				}else{
				
						echo  "<script type='text/javascript'> $('#nextPageDiv').html('$nextPageOff'); $('#prevPageDiv').html('$prevPageOff'); 
													   $('#pagiDetailsDiv').html('$pagiDetail'); 
						</script>";
				
				}
				
				if($nextPageOff > $totalCount){
					
						echo  "<script type='text/javascript'> $('.nextMailBtn').fadeOut(10); $('.prevMailBtn').fadeIn(10); </script>";
				
				}
			
			}
		
			try {
		 				
					if($offSetVal == '') {$offSetVal = $i_false; }
					
					if (($inboxType != '') && ($inboxType != $fiVal)){
						
							$ebele_mark_1 = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, njnk_type
							
											FROM $wizGradeMailBoxTB
											
											WHERE njnk_reps_id = :njnk_reps_id
											
											AND  njnk_type = :njnk_type
											
											ORDER BY njnk_time ASC
											
											LIMIT 10 OFFSET $offSetVal";

							$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
							$igweze_prep_1->bindValue(':njnk_reps_id', $member_id);
							$igweze_prep_1->bindValue(':njnk_type', $inboxType);
							
					}else{

							$ebele_mark_1 = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, njnk_type
							
											FROM $wizGradeMailBoxTB
											
											WHERE njnk_reps_id = :njnk_reps_id
											
											AND  njnk_type = :njnk_type
											
											ORDER BY njnk_time ASC
											
											LIMIT 10 OFFSET $offSetVal";

							$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
							$igweze_prep_1->bindValue(':njnk_reps_id', $member_id);
							$igweze_prep_1->bindValue(':njnk_type', $fiVal);

					
					}
							
							$igweze_prep_1->execute();
					
							$rows_count_1 = $igweze_prep_1->rowCount(); 

							if($rows_count_1 >= $foreal) {  /* select email */

								echo '<table class="table table-inbox table-hover"> <tbody>';
								
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
									
									$memberInfo = companionWallUserDetails($conn, $njnk_sender_id, $fiVal);  /* retrieve student companion details */
						
									list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
									$wallPic, $load_page) = explode ("##", $memberInfo);				

									if($njnk_type == $thVal) { $m_name = '*';}
									if($njnk_status == $fiVal){ $msgStatus = 'unread'; $starIcon = 'fa fa-star inbox-started'; $ckeckRU = 'checkUnread';}
									else { $msgStatus = ''; $starIcon = 'fa fa-star'; $ckeckRU = 'checkRead'; }	
									
									if($njnk_type == $seVal){ $admicIcon = '<span class="label label-danger pull-right">admin</span>'; 
															  $chkAdmin = 'checkAdminMsg'; }
									else{ $admicIcon = ''; $chkAdmin ='';}
									
									$msgTime = wallTimerBoy($njnk_time);  /* companion wall time ago */
									$msgTime = date("F d, Y", $njnk_time);
								
							
$nkirumsgBox =<<<IGWEZE
								
								<tr class="$msgStatus" id="mailRowID-$msg_id">
                                  <td class="inbox-small-cells text-right" width="5%">
                                      <input type="checkbox" class="mail-checkbox mailCheckBox $chkAdmin $ckeckRU" 
									 value='$msg_id' name="chkmailID-$msg_id" id="chkmailID-$msg_id">
                                  </td>
                                  <td class="inbox-small-cells readMail" id="readMail-$msgData" width="5%">
								  <span id="starIconMail-$msg_id"><i class="$starIcon"></i></span></td>
                                  <td class="view-message  dont-show readMail" id="readMail-$msgData" width="30%">$m_name 
								  $admicIcon</td>
                                  <td class="view-message readMail" id="readMail-$msgData" width="40%"> $njnk_title   </td>
                                  <td class="view-message  inbox-small-cells readMail" id="readMail-$msgData"></td>
                                  <td class="view-message  text-right readMail" id="readMail-$msgData" width="20%"> 
								  $msgTime</td>
                              	</tr>	
				
		
IGWEZE;
					
						
									echo $nkirumsgBox;
								
								
								}
							
									echo '</tbody>
										</table>';
							
							}else{  /* display error */
							
								$msg_e = "Ooooops Something went wrong while tring to retrieve your mail, please try again";
								echo $errorMsg.$msg_e.$eEnd; exit;
								
							}
							


				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
								
				
		}
 
		/* paginate sent email */

		if ($_REQUEST["messageData"] == 'paginateSentMail'){

			$member_id = strip_tags($_REQUEST['memberID']);
			$offSetVal = $_REQUEST['offsetVal'];
			$totalCount = $_REQUEST['totalCount'];
			
			$nextPageOff = $offSetVal + 10;
			$prevPageOff = $offSetVal - 10;
			$pagiNext = $offSetVal + $fiVal;
			$nextPage = $offSetVal + 10;
			
			if($totalCount <= 10){

				$nextPage = $totalCount;
				$pagiDetail = $pagiNext.'-'.$nextPage;

				echo  "<script type='text/javascript'> $('.prevMailSentBtn').fadeOut(10);  $('.nextMailBtn').fadeOut(10); 
												   
												   $('#pagiDetailsDiv').html('$pagiDetail');
				  </script>";
				  
				  
			}else{
				
				if($nextPageOff > $totalCount){ $nextPage = $totalCount; }

				$pagiDetail = $pagiNext.'-'.$nextPage;
				
				if($prevPageOff <= $i_false){
					
					echo  "<script type='text/javascript'> $('.prevMailSentBtn').fadeOut(10);  $('.nextMailSentBtn').fadeIn(10); 
													   $('#prevPageDiv').html('');	
													   $('#pagiDetailsDiv').html('$pagiDetail'); $('#nextPageDiv').html('10');
					 </script>";			
				
				}else{
				
					echo  "<script type='text/javascript'> $('#nextPageDiv').html('$nextPageOff'); $('#prevPageDiv').html('$prevPageOff'); 
													   $('#pagiDetailsDiv').html('$pagiDetail'); 
					</script>";
				
				}
				
				if($nextPageOff > $totalCount){
					
					echo  "<script type='text/javascript'> $('.nextMailBtn').fadeOut(10); $('.prevMailBtn').fadeIn(10); </script>";
				
				}
			
			}
		
			try {
		 				
						if($offSetVal == '') {$offSetVal = $i_false; }
					

						
							$ebele_mark_1 = "SELECT msg_id, njnk_title, njnk_msg, njnk_time, njnk_status, njnk_sender_id, njnk_reps_id, njnk_type
							
											FROM $wizGradeMailBoxTB
											
											WHERE njnk_sender_id = :njnk_sender_id
											
											ORDER BY njnk_time ASC
											
											LIMIT 10 OFFSET $offSetVal";

							$igweze_prep_1 = $conn->prepare($ebele_mark_1);	 
							$igweze_prep_1->bindValue(':njnk_sender_id', $member_id);						
							
							$igweze_prep_1->execute();
					
							$rows_count_1 = $igweze_prep_1->rowCount(); 

							if($rows_count_1 >= $foreal) {  /* select email */

								echo '<table class="table table-inbox table-hover"> <tbody>';
								
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
									
									$memberInfo = companionWallUserDetails($conn, $njnk_sender_id, $fiVal);  /* retrieve student companion details */
						
									list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
									$wallPic, $load_page) = explode ("##", $memberInfo);			
									
									if($njnk_status == $fiVal){ $msgStatus = 'unread'; $starIcon = 'fa fa-star inbox-started'; $ckeckRU = 'checkUnread';}
									else { $msgStatus = ''; $starIcon = 'fa fa-star'; $ckeckRU = 'checkRead'; }	
									
									if($njnk_type == $seVal){ $admicIcon = '<span class="label label-danger pull-right">admin</span>'; 
															  $chkAdmin = 'checkAdminMsg'; }
									else{ $admicIcon = ''; $chkAdmin ='';}
									
									$msgTime = wallTimerBoy($njnk_time);  /* companion wall time ago */
									$msgTime = date("F d, Y", $njnk_time);
									
								
$nkirumsgBox =<<<IGWEZE
								
								<tr class="$msgStatus" id="mailRowID-$msg_id">
                                  <td class="inbox-small-cells text-right" width="5%">
                                  </td>
                                  <td class="inbox-small-cells readNkirukaSentMail" id="readNkirukaSentMail-$msgData" width="5%">
								  <span id="starIconMail-$msg_id"><i class="$starIcon"></i></span></td>
                                  <td class="view-message  dont-show readNkirukaSentMail" id="readNkirukaSentMail-$msgData" width="30%">$m_name 
								  $admicIcon</td>
                                  <td class="view-message readNkirukaSentMail" id="readNkirukaSentMail-$msgData" width="40%"> $njnk_title   </td>
                                  <td class="view-message  inbox-small-cells readNkirukaSentMail" id="readNkirukaSentMail-$msgData"></td>
                                  <td class="view-message  text-right readNkirukaSentMail" id="readNkirukaSentMail-$msgData" width="20%"> 
								  $msgTime</td>
                              	</tr>	
				
		
IGWEZE;
					
						
							echo $nkirumsgBox;
							
							
								}
						
								echo '</tbody>
                          			</table>';
						
							}else{  /* display error */
							
								$msg_e = "Ooooops Something went wrong while tring to retrieve your mail, please try again";
								echo $errorMsg.$msg_e.$eEnd; exit;
								
							}
							


				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
								
				
		} exit;
?>