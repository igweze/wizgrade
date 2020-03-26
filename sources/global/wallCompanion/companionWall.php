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
	This script handle companion wall module

	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

session_id();

			define('wizGrade', 'igweze');  /* define a check for wrong access of file */

			if(isset($_SESSION['wallComRank'])){	

				require 'configINwizGrade.php';  /* load wizGrade configuration files */	  

			}else{

				require 'configwizGrade.php';  /* load wizGrade configuration files */	 

			}

			require_once ($wizGradeCWallFunctionDir); /* load companion functions */	 

			try {

				checkWallRegistration($conn);	/* check if student is registered */	 


				$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */

				list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
				$wallPic, $load_page) = explode ("##", $memberInfo);				

				$status = 'deleteTempPic';

				removeTempUpload($conn, $member_id, $status); /* remove temporary companion pictures information */


			}catch(PDOException $e) {

			wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

			}

			if($userMail == '-'){

				$myMail = '<a data-toggle="modal" href="#wizGrade-modal-mail"><button type="button" class="btn btn-white">
				<i class="fa fa-envelope"></i>  Get Email <span class="hide-res">Adresss<span>   </button></a>';

			}else{

				$myMail = $userMail.'@wizgrade.com';

			}

			if ( (is_null($prof_pic)) || ($prof_pic == '-') || (!file_exists($forumPicExt.$prof_pic)) ){ 
			$stuProPic = $wizGradeDefaultPic; }

			else { $stuProPic = $forumPicExt.$prof_pic; }

			if ( (is_null($wallPic)) || ($wallPic == '-') || (!file_exists($forumPicExt.$wallPic)) ){ 
			$stuWallpic = $wizGradeDefaultPic; }

			else { $stuWallpic = $forumPicExt.$wallPic; } 


?>	

			<!-- companion wall news feed settings modal -->
			<div class="modal fade" id="wizGrade-modal-filter" tabindex="-1" role="dialog" 
			aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
				<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close showFilterWall" 
					data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">My Companion Wall News Feed Settings</h4>
				</div>
				<div class="modal-body">
				<div id="filterSettingsMsg"> </div>
				<div class="wizgrade-section-div">

				<section class="panel">

					<div class="panel-body">
					<!-- form -->
					<form class="form-horizontal" id="frmRS2" role="form">

					<div class="form-group">
					<label for="filterCWallSetting" class="col-lg-6 col-sm-6 control-label">* 
					Always Filter My Companion Wall News Feed
					</label>

					<div class="col-lg-6">
						<div class="iconic-input">
						<i class="fa fa-filter"></i>

						<select class="form-control"  id="filterCWallSetting" 
						name="filterCWallSetting" required>

						<?php

							foreach($filterCWall as $filterCWallKey => $filterCWallVal){

							if ($load_page == $filterCWallKey){
								
								$selected = "SELECTED";
								
							} else {

								$selected = "";

							}

							echo '<option value="'.$filterCWallKey.'"'.$selected.'>
							'.$filterCWallVal.'</option>' ."\r\n";

							}

						?>
															  
						</select>
						</div>
					</div>
					</div>


					</form>
					<!-- / form -->
					</div>

				</section>

				</div>

				</div>
				<div class="modal-footer">
					<button data-dismiss="modal" class="btn btn-danger showFilterWall" 
					type="button">Close</button>
				</div>
				</div>
				</div>
			</div>
			<!-- / companion wall news feed settings modal -->          

			<!-- companion email registration modal -->
			<div class="modal fade" id="wizGrade-modal-mail" tabindex="-1" role="dialog" 
			aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"> Resgister for your Email Address</h4>
				</div>
				<div class="modal-body">
					<div id="registMailMsg"> </div>
					<div class="wizgrade-section-div">

					<section class="panel">

					<div class="panel-body">

						<div class="form-group">
							<label for="cMailUser" class="col-lg-4 col-sm-4 control-label">* Choose Email <br/>
							<button class="btn btn-danger ExitsEmail display-none" 
							type="button"><i class="fa  fa-times"></i> This Email Adresss Exits</button>
							<button class="btn btn-success AvailEmail display-none" 
							type="button"><i class="fa  fa-check-square-o"></i> Email Adresss Available</button>
							</label>

							<div class="col-lg-8">
							<div class="iconic-input">
							<i class="fa fa-envelope"></i>
							<input type="text" class="form-control" name="cMailUser" id="cMailUser">
							<span class="input-group-addon">@wizgrade.com </span>
							<span class="help-block"> * Only Alphabets &amp; Numbers are accepted. However, you can
							only register once &amp; can't edit later.</span>
							</div>
							</div>

						</div>


					</div>

					</section>

					</div>

				</div>
				<div class="modal-footer">
					<button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
					<button class="btn btn-success registerCMail display-none" id="registerCMail" type="button">
					Save Email <span class="hide-res">Adresss<span>  </button>
				</div>
				</div>
				</div>
			</div>

			<!-- / companion email registration modal --> 
			
			<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script> 
			
			<!-- row -->	
			<div class="row">
				<div class="col-lg-12">
					<section class="panel">
					<header class="panel-heading">
						<i class="fa fa-comments-o fa-lg"></i> Companion Wall
						<span class="tools pull-right">
						<a href="javascript:;" class="fa fa-chevron-down"></a>
						<a href="javascript:;" class="fa fa-times"></a>
						</span>
					</header>
					<div class="panel-body wizGrade-line"> 
						<div class="col-lg-8">
							<section class="panel" style="border: 1px solid #999999 !important;border-radius: 30px 30px 0px 0px;
							-webkit-border-radius: 30px 30px 0px 0px;">
								<div class="cover-photo">
								<div class="fb-timeline-img">
								<img src="<?php echo $stuWallpic; ?>" height="210px" width="100%" alt="My Wall Picture">
								</div>   
								<div class="fb-name hide-res">
								<h2><a href="javascript:;"><?php echo $m_name; ?></a></h2>
								</div>
								</div>
								<div class="panel-body">
									<div class="profile-thumb">
									<img src="<?php echo $stuProPic; ?>" height="90px" width="90px" alt="My Profile Picture">
									</div>
									<a href="javascript:;" class="fb-user-mail"> <div id="CompEMailDiv"><?php echo $myMail; ?> </div> </a>

									<!--
									div class="col-lg-5 pull-right">
									<div class="iconic-input">
									<i class="fa fa-filter"></i>

									<select class="form-control"  id="filterCWallPosts" name="filterCWallPosts" required>

										<?php /* filter companion posts 

										foreach($filterCWall as $filterCWallKey => $filterCWallVal){

											if ($load_page == $filterCWallKey){

												$selected = "SELECTED";

											} else {

												$selected = "";

											}

											echo '<option value="'.$filterCWallKey.'"'.$selected.'>'.$filterCWallVal.'</option>' ."\r\n";

										}
											*/
										?>

									</select>

									</div>
									</div> -->

								</div>
								<hr style="border-top: 1px solid #999999 !important;" />
								<div class="row" style="margin-top:0px; ">
									<div class="col-lg-12 cWallMenu" style="margin: 0px 10px 15px 10px;">
										<a href="javascript:;" class="companionWallPosts fb-top-btn current">
										<button type="button" class="btn btn-white"><i class="fa fa-home fa-lg"></i> <span class="hide-res">Home<span></button></a>
										<a href="javascript:;" class="showcompanionWallUser fb-top-btn" 
										<?php echo 'id="companionWallUser-'.$member_id.'">'; ?>											  
										<button type="button" class="btn btn-white"><i class="fa fa-user fa-lg"></i> <span class="hide-res">My Wall<span> </button></a>
										<a data-toggle="modal" href="#wizGrade-modal-filter" class="fb-top-btn">
										<button type="button" class="btn btn-white
										cWallSettings"><i class="fa fa-wrench fa-lg"></i> <span class="hide-res">Settings<span> </button></a>
									</div>
								</div>
							</section>

							<section class="panel profile-info" style="background: #F8F8FF !important; border: 1px solid #999999;">

								<div id="wallMsgDiv">
									<!-- form -->
									<form method="POST" id="frmPost" class="highlight-textarea">
										<input type="hidden" name="postFData" value="sendpostFData" />                         
										<textarea class="form-control input-lg p-text-area" style="border: 1px solid #999999 !important;" 
										rows="3" name="fPostField" onclick="highlight();"
										id="fPostField" placeholder="What&#039;s going on?"></textarea>
										<button class="btn btn-white pull-right" id='postStatus' style="display:none;">Post</button>
									</form>
									<!-- / form -->
								</div>

								<div id="wallPictureDiv" class="display-none col-lg-12">
									<img src="<?php echo $wizGradeTemplate?>images/icon_exit.png" alt="Cancel Upload" 
									id="exitUploadDiv" style="position: relative; top: 0px; left:0px; cursor:pointer; float: right" /> 
									<!-- form -->
									<form id="frmuploadPic" method="post">	
										<div id="StatusImgHolder" class="col-lg-12" style="border: 1px solid #CCC; height: 230px; 
										overflow:hidden; background:#fff; clear:both; overflow:auto;">
										<div class="form-group">
											<div class="col-lg-12">
											<div class="iconic-input">
											<i class="fa fa-comment-o"></i>
											<input type="text" class="form-control" placeholder="Your Picture or ALbum Caption" 
											name="uploadPicTitle" id="uploadPicTitle" style="border:0px;" />
											</div>
											</div>
										</div>
										<div id='previewPic' class="col-lg-12"> </div>
										<input type="hidden" name="postUploadData" value="senduploadPicData" />
										<button id='uploadPic' style="display:none;"></button>
										</div>
									</form>
									<!-- / form -->  

									<div class="col-lg-12" style="height:30px; margin-bottom:8px !important; margin-top:6px;">

										<span class="col-lg-12">* Maximum of 4 image per upload, picture size of 2 MB &amp; only
										<?php echo $allowedPicExt; ?> are allowed.</span>

										<img src="<?php echo $wizGradeTemplate?>images/s_loader.gif" alt="Loading >>>>>" id='imgUploadLoader' 
										style="cursor:pointer; float:right; margin-right:10px; display:none;" />

									</div>

								</div>
								<footer class="panel-footer" style="background: #F8F8FF !important;">
									<button class="btn btn-danger pull-right" id='postStatusSE'>Post</button>
									<button class="btn btn-danger pull-right display-none" id='uploadPicSE'>Upload</button>
									<img src="<?php echo $wizGradeTemplate?>images/s_loader.gif" alt="Loading >>>>>" 
									id='postLoader' style="cursor:pointer; float:right; margin:8px 5px 5px 10px; display:none;" />	

									<ul class="nav nav-pills"  >
										<li style="margin-top:3px;">
											<!-- form -->
											<form id="frmWallUploader" method="post" enctype="multipart/form-data" 
											action='comp-img-upolader.php'>
												<input type="hidden" name="postUploadData" value="senduploadPicData" /> 
												<input type="hidden" name="postUploadData" value="uploadPicData" />
												<span class="btn btn-file uploadPicIcon">
												<span class="fileupload-new"><i class="fa fa-camera fa-lg"></i></span>

												<input type="file" name="photoimg" id="wallPics" class="default" required />
												</span>
											</form>
											<!-- / form -->
										</li>
										<li class="ComingS" style="margin-top:3px;">
										<span class="btn "><i class=" fa fa-film fa-lg"></i></span>
										</li>
									</ul>
								</footer>
							</section> 

							<div id="fmsgBox"> </div> <div id="newPostDiv"></div>

							<div id="chisomLoadDiv"> 
								<?php 
								
									try {

										if (isset($_REQUEST["notificPostID"])){

											$postID = $_REQUEST['notificPostID'];

											companionWallAlerts($conn, $postID); /* load companion posts*/

											echo "<script type='text/javascript'>

											$('html, body').animate({ scrollTop:  $('#chisomLoadDiv').offset().top - 100 }, 'slow'); 

											</script>";

										}else{

											loadCompanionWall($conn, $load_page, $m_dept, $m_faculty);  /* load companion posts*/

										}

									}catch(PDOException $e) {

										wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

									}

								?>							
							</div>


						</div>

						
						<div class="col-lg-4 mob-gap">
							<div class="fb-timeliner">
								<h2 class="recent-highlight">Active Members</h2>
								<div class="active-member">

									<?php

										try {

											activeCWallMembers($conn);  /* load active companion wall users */

										}catch(PDOException $e) {

											wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

										}

									?>
								</div>
							</div>
						</div>
					
					</div>
					
					</section>
				
				</div>
				
			</div> 
			<!--  / row --> 

			<div class="refresh"> </div> <div id="status-overlay" style="display: none"></div>

			<script type='text/javascript'>

				$(document).ready(function(){
					$('textarea').on('click', function(e) {
						e.stopPropagation();
					});
					
					$(document).on('click', function (e) {
						
						$("#status-overlay").hide();
						$(".highlight-textarea").css('z-index','1');
						$(".highlight-textarea").css('position', '');
					
					});
				});

				function highlight() {

					$("#status-overlay").show();
					$(".highlight-textarea").css('z-index','9999999');
					$(".highlight-textarea").css('position', 'relative');
					
				}  
				
			</script>	
