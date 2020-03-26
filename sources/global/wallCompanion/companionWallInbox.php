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
	This script handle companion inbox module
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 

session_id();

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

		if(isset($_SESSION['wallComRank'])){	
		
			require 'configINwizGrade.php';  /* load wizGrade configuration files */	  
			
		}else{
			
			require 'configwizGrade.php';  /* load wizGrade configuration files */	 
			
		}
	
	 	require_once ($wizGradeCWallFunctionDir);  /* load companion functions */	 
		

		try {
				
				checkWallRegistration($conn); /* check if student is registered */
									
				$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
				
				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
					  $wallPic, $load_page) = explode ("##", $memberInfo);

				if(isset($_SESSION['wallComRank'])){	

					$unreadMsg = numOfUnreadMsgAdmin($conn, $member_id); /* retrieve number of admin unread message */
					
				}else{
					
					$unreadMsg = numOfUnreadMsg($conn, $member_id);	 /* retrieve number of unread message */
					$adminMsg = numOfAdminMsg($conn, $member_id); /* retrieve number of admin unread message */
					
				}

				$draftMsg = numOfDraftMsg($conn, $member_id); /* retrieve number of draft message */
				
				$trashMsg = numOfTrashMsg($conn, $member_id); /* retrieve number of trash message */
				
				$sentMsg = numOfSentMsg($conn, $member_id); /* retrieve number of sent message */
				
				$unreadMsgNum = '<span class="label label-danger pull-right inboxMsgNum">'.$unreadMsg.'</span>';

				$draftMsgNum = '<span class="label label-info pull-right draftMsgNum">'.$draftMsg.'</span>';
				
				$adminMsgNum = '<span class="label label-warning pull-right adminMsgNum">'.$adminMsg.'</span>'; 
				
				$sentMsgNum = '<span class="label label-success pull-right SenttMsgNum">'.$sentMsg.'</span>';
				
				$trashMsgNum = '<span class="label label-primary pull-right TrashMsgNum">'.$trashMsg.'</span>'; 
				

				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}

				if($userMail == '-'){
				
					$myMail = '<a data-toggle="modal" href="#wizGrade-modal-mail"><button type="button" class="btn mail-btn hide-res">
					<i class="fa fa-envelope"></i> Get Email </button></a>';
				
				}else{
				
					$wizGradeMail = $userMail.'@wizgrade.com';
					$myMail = "<button type='button' class='btn mail-btn'> <i class='fa fa-envelope hide-res'></i> $wizGradeMail </button>";
				
				}
				
				if(isset($_SESSION['wallComRank'])){	

					try {
					
						$adminInfo = wizGradeAdminData($conn, $i_db_ext, $_SESSION['adminID']); /* retrieve admin information */
						
						list ($adminIDT, $admin_picture, $adminTitle, $adminLname, $adminFname, $adminMname, 
							  $adminEmail) = explode ("@(.$.)@", $adminInfo);	
		 
						if ( (is_null($admin_picture)) || ($admin_picture == '') || (!file_exists($wizGradeAdminPicDir.$admin_picture)) ){ 
									$adminPic = $wizGradeDefaultPic; }
						else { $adminPic = $wizGradeAdminPicDir.$admin_picture; }


					}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}

					$stuProPic = $adminPic;
				
				}else{
					
					if ( (is_null($prof_pic)) || ($prof_pic == '-') || (!file_exists($forumPicExt.$prof_pic)) ){ 
					$stuProPic = $wizGradeDefaultPic; }
						
					else { $stuProPic = $forumPicExt.$prof_pic; }
					
				
				}
				
						$showInboxBtn = 'showInboxMsg-'.$member_id;
						$showSentMailBtn = 'showSentMail-'.$member_id;
						$showAdminMailBtn = 'showAdminMail-'.$member_id;
						$showDraftMailBtn = 'showDraftMail-'.$member_id;
						$showTrashMailBtn = 'showTrashMail-'.$member_id;
						
		
?>	

				<script type="text/javascript">
			  
					<?php 				
						if(isset($_SESSION['wallComRank'])){	
						
							echo "$('.showAdminMail').fadeOut('fast');";
						
						}
					?>

				</script>		
								
				<!-- input style --> 
				<style>
					input[type="checkbox"] {
					display:inline;
					} 
					input[type="radio"] {
						display:inline;
					} 					
				</style>
				<!-- / input style --> 
			
				<!-- row --> 
					<div class="row">  
					<div class="col-sm-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <i class="fa fa-comments-o fa-lg"></i> <span class="hide-res">Companion</span> Message Box
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line">
						  
								<!--mail inbox start-->
								
								<div class="mail-box">
							  
									<aside class="sm-side">
										   
										  <div id="showSuccessSent" class="display-none">
										   <?php
									   
												$msg = "<strong> Your mail was successfully sent </strong>"; 
									
												echo $succMsg.$msg.$msgEnd; 
										  ?>
										  </div>

										  <div id="showSuccessDraft" class="display-none">
										   <?php
									   
												$msg = "<strong> Your mail was successfully draft</strong>"; 
									
												echo $succMsg.$msg.$msgEnd; 
										  ?>
										  </div>

										  <div class="inbox-body">
										  
											
											  <a class="btn btn-compose" id="composeMsg" href="javascript:;">
												 <i class="fa fa-edit fa-lg"></i> Compose
											  </a>
											

										  </div>
										  <ul class="inbox-nav inbox-divider">
											  <li class="active showInbox" id="<?php echo $showInboxBtn;?>">
												  <a href="javascript:;">
												  <i class="fa fa-inbox"></i> Inbox  <?php echo $unreadMsgNum; ?> </a>

											  </li>
											  <li id="<?php echo $showSentMailBtn;?>" class="showSentMail">
												  <a href="javascript:;">
												  <i class="fa fa-envelope-o"></i> Sent Mail <?php echo $sentMsgNum; ?></a>
											  </li>
											  <li class="showAdminMail" id="<?php echo $showAdminMailBtn;?>">
												  <a href="javascript:;">
												  <i class="fa fa-bookmark-o"></i> School Admin Mail <?php echo $adminMsgNum; ?></a>
											  </li>
											  <li id="<?php echo $showDraftMailBtn;?>" class="showDraftMail">
												  <a href="javascript:;">
												  <i class=" fa fa-external-link"></i> Drafts  <?php echo $draftMsgNum; ?> </a>
											  </li>
											  <li id="<?php echo $showTrashMailBtn;?>" class="showTrashMail">
												  <a href="javascript:;">
												  <i class=" fa fa-trash-o"></i> Trash <?php echo $trashMsgNum; ?></a>
											  </li>
										  </ul>
									   
									  


									</aside>
									  
									  
									<aside class="lg-side scrollMailTarget">
									
										<div class="inbox-head">
											  <h3><div id="mailTopTitle">My Companion Inbox </div> 
											  <div id="mailTitleHolder" class="display-none"> </div></h3>											  
											  <h5><a href="javascript:;"><div id="CompEMailDiv"><?php echo $myMail; ?> </div></a></h5> 
										</div>
										  
										<div class="row display-none" id="composeMsgBoxDiv">
										   
											<div class="col-lg-12">
					   
												<section class="panel">
											 
												<div class="panel-body" style="background: #fff !important;">
											  
													<div id="msgBoxInfo"> </div>
											  
														  
													<!-- form --><form class="form-horizontal" id="frmsendNjidekaMail" role="form"> 
												 
														<?php echo '<img src="'.$loader_img.'" alt="Loading >>>>>" class="pull-right sendMsgLoader" 
															  style="cursor:pointer; display:none; margin-right:3%; margin-bottom:10px;" />'; ?>    
															   
														<button class="btn btn-info pull-left" id="saveDraftMsg">
															  <i class="fa fa-save"></i> Save As Draft </button> 
															  <span class="display-none" id="frmmemberID"> <?php echo $member_id; ?></span> 

														<button  class="btn btn-danger pull-right" id="cancelComposeMsg">
															  <i class="fa fa-times"></i> Cancel </button>  
															  
														<br clear="all" />		<br clear="all" />	  
															  
																	   
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
																  <input type="text" class="form-control" placeholder="Write your message title here" 
																  name="msgTitle" id="msgTitle" required />
															  </div>
														  </div>
														</div> 

														<div class="form-group">
														  <div class="col-lg-12">
															  <div class="iconic-input">
																  <i class="fa fa-envelope"></i>
																  <textarea class="form-control" name="Message" id="Message"
																   style="padding: 5px 30px; 
																  text-align:justify !important;"
																  placeholder="Write your message here" rows="10" required></textarea>
																 
															  </div>
														  </div>
														</div> 

														<div class="form-group">
														  <div class="col-lg-2"> 
															  <input type="hidden" name="memberID" value="<?php echo $member_id; ?>" />
															  <input type="hidden" name="messageData" value="sendNjidekaMail" />
															  <button type="submit" class="btn btn-danger" id="sendNjidekaMail">
															  <i class="fa fa-mail-forward"></i> Send  </button>
															  
															  
															   
														  </div>
														</div>
					  

													</form><!-- / form -->
											  
												</div>
										 
												</section>
									  
											</div>
								  
										</div>
												  
										<div id="mailMsgBox"> </div>
				 
										<div id="njidekaNkirukaDiv">		
										<?php
			 
											try {
											
												if (isset($_REQUEST["viewMailTop"])){

														$mailData = $_REQUEST['viewMailTop'];
														list ($msgID, $member_id, $sender_id) = explode ("-", $mailData);
									
														viewCompanionMail($conn, $msgID, $member_id, $sender_id);  /* load companion mail */
														
														echo "<script type='text/javascript'> 
															$('#mailTopTitle').html('View My Companion Inbox'); 
															$('html, body').animate({ scrollTop:  $('#njidekaNkirukaDiv').offset().top - 100 }, 'slow');
														</script>";
									
												}else{
												
														if(isset($_SESSION['wallComRank'])){
															
															companionInbox($conn, $member_id, $seVal, $i_false);  /* load companion inbox */
															
														}else{
															
															companionInbox($conn, $member_id, $fiVal, $i_false);  /* load companion inbox */
															
														}
												
												}
									 
											}catch(PDOException $e) {
							
												wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
											}
									
										?>
						   
										</div>
						
									</aside> 

								</div>

								<!--mail inbox end-->
				
							</div>
						  </section>
						</div>
					  
				</div>	  
				
				<!-- / row --> 
                
				<!-- companion email resgisteration modal -->
				
				<div class="modal fade" id="wizGrade-modal-mail" tabindex="-1" role="dialog" aria-labelledby="wizGrade-modalLabel"  aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal" 
							  aria-hidden="true">&times;</button>
							  <h4 class="modal-title"> Resgister for your Email Address</h4>
							</div>
							<div class="modal-body">
						  
								<div id="registMailMsg"> </div>
								<div class="wizgrade-section-div">
						 
									<section class="panel">
										
										<div class="panel-body">
										  
											<div class="form-group">
													<label for="cMailUser" class="col-lg-4 col-sm-4 control-label">* Choose Email <br/>
													<button class="btn btn-danger ExitsEmail display-none" type="button">
													<i class="fa  fa-times"></i> 
													This Email Adresss Exits</button>
													<button class="btn btn-success AvailEmail display-none" type="button">
													<i class="fa  fa-check-square-o"></i> 
													Email Adresss Available</button> </label>
												 
													<div class="col-lg-8">
														<div class="iconic-input">
															<i class="fa fa-envelope"></i>
															  <input type="text" class="form-control" name="cMailUser" 
															  id="cMailUser">
															<span class="input-group-addon">@wizgrade.com </span>
														   
															<span class="help-block"> * Only Alphabets &amp; Numbers are 
															accepted. However, you can
															only register once &amp; can't edit later.</span> 
														</div>
													</div>
												 
											</div> 

										</div>
									 
									</section>
							  
								</div>

							</div>
							<div class="modal-footer">
								  <button data-dismiss="modal" class="btn btn-danger" type="button"> Close </button>
								  <button class="btn btn-success registerCMail display-none" id="registerCMail" 
								  type="button"> Save  </button>
							</div>
						</div>
					</div>
				</div>
				
				<!-- / companion email resgisteration modal --> 