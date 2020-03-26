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
	This script handle school admin, staff and school head modules
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

ob_start(); 

if(!session_id()){
    session_start();
}

		define('wizGrade', 'igweze');  /* define a check for wrong access of file */	  	  

			unset($_SESSION['schoolConfigs']); 
			unset($_SESSION['school-type']);					 
			$_SESSION['schoolConfigs'] = ""; 
			$_SESSION['school-type'] = "";
			$_SESSION['wizGradePiloter'] =  $headerComPage;
		
			require 'configINwizGrade.php';  /* load wizGrade configuration files */	   
			require_once ($wizGradeCWallFunctionDir);  /* load companion functions */	

			if ( (!isset($_SESSION['commonPgrade']))
			|| ($_SESSION['commonPgrade'] != $comGrade)
			|| (!isset($_SESSION['commonPlevel']))
			|| ($_SESSION['commonPlevel'] != $comGradeInt) 
			
			) {  /* user validation */

				header("Location: $wizGradeLogOutDir");exit;
				/*echo "<script type='text/javascript'> window.location.href = '$wizGradeLogOutDir';</script>"; exit; */

			} 
			
			require_once ($wizGradeTemplate.'wizGradeHeader.php');  /* include template head */ 

			if(($admin_grade == $adminGrade) && ($admin_level == $adminGradeInt)){  /* check if user is admin */
				
				$showBioID = 	'showAdminBio';
				$changePassID = 'editAccess';
				$userTag = 'Super ADMIN';

				try { 
					
					$totalRegis = registrationCounter($conn);  /* student online registration counter */
					
					$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
					
					list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, 
						  $userMail,  $wallPic, $load_page) = explode ("##", $memberInfo);
					
					$unreadMsg = numOfUnreadMsgAdmin($conn, $member_id);  /* number of admin unread message */ 
					
					$userInfo = wizGradeAdminData($conn, $_SESSION['adminID']);  /* school admin information  */
					
					list ($userIDT, $user_picture, $userTitle, $userLname, $userFname, $userMname, 
						  $userEmail) = explode ("@(.$.)@", $userInfo);	
					
					$userTitleVal = $title_list[$userTitle];
					
					$userTopBName = $userTitleVal.' '.$userLname;

					if ( (is_null($user_picture)) || ($user_picture == '') || 
						(!file_exists($wizGradeAdminPicDir.$user_picture)) ){  /* check if picture exists */ 
								$userPicture = $wizGradeDefaultPic; }
					else { $userPicture = $wizGradeAdminPicDir.$user_picture; }
				   

				}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
				}

			}elseif(($admin_grade == $schHeadGrade) && ($admin_level == $schHeadGradeInt)){  /* check if user is school head */

				try {
						
					$userInfo = staffData($conn, $_SESSION['adminID']);  /* school staffs/teachers information */ 
					
					list ($userTitle, $userName, $userSex, $userRank, $userPic, $userLName) = 
					explode ("#@s@#", $userInfo);	
					
					$userTitleVal = $title_list[$userTitle];
					
					$userTopBName = $userTitleVal.' '.$userLName;

					if ( (is_null($userPic)) || ($userPic == '') || 
						(!file_exists($staffPicExt.$userPic)) ){  /* check if picture exists */ 
								$userPicture = $wizGradeDefaultPic; }
					else { $userPicture = $staffPicExt.$userPic; }

				}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
				}

				$showBioID = 	'showStaffBioH';
				$changePassID = 'editPass';
				$userTag = 'SCHOOL HEAD';

			}elseif(($admin_grade == $staffGrade) && ($admin_level == $staffGradeInt)){ /* check if user is school staff */

				try {
						
					$userInfo = staffData($conn, $_SESSION['adminID']);  /* school staffs/teachers information */ 
					
					list ($userTitle, $userName, $userSex, $userRank, $userPic, $userLName) = 
					explode ("#@s@#", $userInfo);	
					
					$userTitleVal = $title_list[$userTitle];
					
					$userTopBName = $userTitleVal.' '.$userLName;

					if ( (is_null($userPic)) || ($userPic == '') || 
						(!file_exists($staffPicExt.$userPic)) ){  /* check if picture exists */ 
								$userPicture = $wizGradeDefaultPic; }
					else { $userPicture = $staffPicExt.$userPic; }

				}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
				}

				$showBioID = 	'showStaffBioH';
				$changePassID = 'editPass';
				$userTag = 'STAFF';

			}else{  /* log this user out */
				
				header("Location: $wizGradeLogOutDir");exit;
				
			} 

			if (isset($_SESSION['lockAdminScreen']) == 'IluvNjideka') {  /* check if screen lock is activated */  

?>	

		<body class="lock-screen" onLoad="startTime()"> 

			<noscript> <?php echo $infMsg.$noscriptMsg.$msgEnd;  ?> </noscript>
			
			<div id="scrollBTarget" class="loader-background timeOutLoader">
				<img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="please wait. Page loading >>>>>>>>>>>>>>>" /><!-- loading image -->						 
			</div>
			
			<!--screen lock start-->
			<div class="lock-div">
				<div id="wizGradePagerMsg" style="display:none;"> </div><div id="wizGradePgContent"></div>
				<div class="display-none"  id="wizCall"><span class="logo col-i-1">wizGrade :::: call</span></div>
				<div id="timer-box"></div>
				
				<div id="timeOutMsg" class="pageRefresh"></div> 
				
				<!-- form --><form method="post"   role="form" class="text-center m-t-20" id="frmTimeOut">
					<div class="user-thumb">
						<img src="<?php echo $userPicture; ?>" height="180px" width="180px" 
						class="img-responsive img-circle img-thumbnail" alt="thumbnail">
					</div>
					<div class="form-group">
						<h3><?php echo $userTopBName; ?></h3>
						<h4><i class="fa fa-lock fa-lg"></i> Locked</h4>
						<p class="text-muted">Enter your password to access your dashboard</p>
						<div class="display-none" id="wizAns"><span class="col-i-2">123 :::: wizGrade</span></div>
						<div class="input-group m-t-30">
							<input type="password" name="password" class="form-control" placeholder="Enter Password">
							<input type="hidden" name="timeOutType" value="wizGradeTimeOut">
							<span class="input-group-btn wizGradeMenu1"> <button type="submit" class="btn btn-email btn-info waves-effect waves-light" 
							id="timeOutLogin">
								<i class="fa fa-unlock fa-lg"></i> Unlock
							</button> </span>
						</div>
					</div>
					<div class="text-right wizGradeMenu1">
						<a href="#" class="text-muted">Not <?php echo $stuFullName; ?> ?  <a href="javascript:;" id="wizGradeLogOuta">
							 <i class="fa fa-sign-out fa-2x"></i><span class="hide-res">Log Out</span></a> </a> 	 
					</div>
					
				</form> <!-- / form -->
			</div>
			<script>
				function startTime()
				{
					var today=new Date();
					var h=today.getHours();
					var m=today.getMinutes();
					var s=today.getSeconds();
					// add a zero in front of numbers<10
					m=checkTime(m);
					s=checkTime(s);
					document.getElementById('timer-box').innerHTML=h+":"+m+":"+s;
					t=setTimeout(function(){startTime()},500);
				}

				function checkTime(i)
				{
					if (i<10)
					{
						i="0" + i;
					}
					return i;
				}
			</script>
			<!--screen lock end -->					
			
	<?php }else{	?>

	<body id="scrollBTarget"> 
                      
	<section id="container" >
		<!-- header start -->
		<header class="header top-header-bg">
	  
			<!-- logo start -->
            <div class="sidebar-toggle-box">
                  <div class="topSoftMenu logo-menu" id="wizGradeMenuTop" data-placement="right" 
                  data-original-title="wizGrade logo"><img src="<?php echo $wizGradeTemplate?>images/logo.png" 
				  height="40"  width="40" alt="wizGrade logo" /></div>
                  <span class="topSoftMenu logo-menu display-none" id="wizGradeMenuTop2"></span>
            </div>
            <a href="javascript:;" class="logo col-i-1"><?php echo $wizGradeVersion; ?></a>
            <!-- logo end -->
			
			<div class="top-nav top-school-info"> 
				<!-- school title and logo info start -->
				<button  class="btn btn-white pull-left" id="maxPageIcon" style="margin-right:8px !important;">
				<i class="fa fa-arrow-left text-info"></i>  </button>
                                  
                <button  class="btn btn-white display-none pull-left" id="min-page-icon" style="margin-right:8px !important;">
				<i class="fa fa-arrow-right text-info"></i> </button>		 						
			  
				<span id="top-school-pic"> <img src="<?php echo $sch_logo; ?>" height="40"  width="40" alt="School logo" /> </span>
				<span id="top-school-name"><?php echo $schoolNameTop; ?></span>
				<!-- school title and logo info end -->
            </div>
			
			<div class="nav notify-row dropdown-menu-top">
				<!-- dropdown menu start -->
				<ul class="nav  top-menu nav-top-accordion">  
					<li class="dropdown pull-right">
						
						<a href="javascript:;" class="btn  dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bars fa-lg dropdown-menu-icon"></i> </a> 
						<ul class="dropdown-menu dropdown-menu-up">
								
						<li class="wizGradeMenu1">
						  <a class="active tpMenu" href="javascript:;" id="home">
							  <i class="fa fa-dashboard myDashboard" id="myDashboard"></i>
							  <span id="homePage">Dashboard</span>
						  </a>
						</li>
						<li class="sub-menu">
						  <a href="javascript:;" >
							  <i class="fa fa-arrow-circle-right"></i>
							  <span>Select School</span>
						  </a>
						  <ul class="sub">
							  <li class="changeSchool" id="log-nur"><a  class="tpMenu"  href="javascript:;">
							  <i class="fa fa-chevron-right"></i> Nursery School</a></li>
							  <li class="changeSchool" id="log-pri"><a  class="tpMenu"  href="javascript:;">
							  <i class="fa fa-chevron-right"></i> Primary School</a></li>
							  <li class="changeSchool" id="log-sec"><a  class="tpMenu"  href="javascript:;">
							  <i class="fa fa-chevron-right"></i> Secondary School</a> </li>


						  </ul>
						</li>

						<?php if(($admin_grade == $adminGrade) && ($admin_level == $adminGradeInt)){  /* check if user is admin */ ?>

						<li class="sub-menu">
						  <a href="javascript:;" >
							  <i class="fa fa-wrench"></i>
							  <span>Global Config.</span>
						  </a>
						  <ul class="sub">
							  <li class="wizGradeMenu2"><a  class="tpMenu"  href="javascript:;" id="wizGradeSchConfigs">
							  <i class="fa fa-chevron-right"></i> School Setup</a></li>
							  <li class="wizGradeMenu2"><a  class="tpMenu"  href="javascript:;" id="wizGradeTheme">
							  <i class="fa fa-chevron-right"></i> School Theme</a></li> 
							  <li class="wizGradeMenu2"><a  class="tpMenu"  href="javascript:;" id="currentSchoolSession">
							  <i class="fa fa-chevron-right"></i>  Current Session </a></li>						  
							  <li class="wizGradeMenu1"><a  class="tpMenu"  href="javascript:;" id="smsConfig">
							  <i class="fa fa-chevron-right"></i> SMS Config.</a></li>						  
							  <li class="wizGradeMenu1"><a  class="tpMenu"  href="javascript:;" id="payGateway">
							  <i class="fa fa-chevron-right"></i> Payment Gateway</a></li>
							  <li class="wizGradeMenu1"><a  class="tpMenu"  href="javascript:;" id="scoreGrade">
							  <i class="fa fa-chevron-right"></i> Grade Scores </a></li>	
							  <li class="wizGradeMenu2"><a  class="tpMenu"  href="javascript:;" id="teacherRemarks">
							  <i class="fa fa-chevron-right"></i> Teacher's Remark</a></li> 
							  <li class="wizGradeMenu2"><a  class="tpMenu"  href="javascript:;" id="disabilitySettings">
							  <i class="fa fa-chevron-right"></i> Disability List </a> </li>					 
							  <li class="wizGradeMenu2"><a  class="tpMenu"  href="javascript:;" id="schoolClubSettings">
							  <i class="fa fa-chevron-right"></i> School Clubs</a></li>
							  <li class="wizGradeMenu2"><a  class="tpMenu"  href="javascript:;" id="schoolClubPostSettings">
							  <i class="fa fa-chevron-right"></i> Clubs Postition</a> </li>
							  <li class="wizGradeMenu2"><a  class="tpMenu"  href="javascript:;" id="sportsSettings">
							  <i class="fa fa-chevron-right"></i> Sports Lists</a></li> 
						  </ul>
						</li>  

						<li class="wizGradeMenu1">
						  <a class="tpMenu"  href="javascript:;" id="newRegistration">
							  <i class="fa fa-user-circle"></i>
							 New Registration <span class="label label-danger"><span id="totalRegsCount">
							 <?php echo $totalRegis; ?></span></span>
						  </a>
						</li>

						<li class="sub-menu">
						  <a href="javascript:;" >
							 <i class="fa fa-users"></i>
							  <span>Staff HR</span>
						  </a>
						  <ul class="sub">
							  <li class="wizGradeMenu1"><a  class="tpMenu"  href="javascript:;" id="newTeacherBio">
							  <i class="fa fa-chevron-right"></i> Add Staff</a>
							  </li>
							  <li class="wizGradeMenu1"><a  class="tpMenu"  href="javascript:;" id="teacherBioData">
							  <i class="fa fa-chevron-right"></i> Manage Staffs</a></li>
							  <li class="wizGradeMenu1"><a  class="tpMenu"  href="javascript:;" id="searchTeacher">
							  <i class="fa fa-chevron-right"></i> Search Staffs</a></li>
							  <li class="wizGradeMenu1"><a  class="tpMenu"  href="javascript:;" id="smsStaff">
							  <i class="fa fa-chevron-right"></i> Send SMS</a></li> 
						  </ul>
						  
						</li> 

						<li class="wizGradeMenu1">
						  <a class="tpMenu"  href="javascript:;" id="cardPins" >
							  <i class=" fa fa-paw"></i>
							  <span>Scratch Card Pins</span>
						  </a>
						</li> 
						
						<li class="wizGradeMenu1">
						  <a class="tpMenu"  href="javascript:;" id="schoolEvents" >
							  <i class=" fa fa-calendar-plus-o"></i>
							  <span>School Events </span>
						  </a>
						</li> 

						<li class="wizGradeMenu1">
						  <a class="tpMenu"  href="javascript:;" id="wallCompanion" >
							  <i class="fa fa-group"></i>
							  <span id="CompanionWall">Companion Wall</span>
						  </a>

						</li>                  

						<li class="wizGradeMenu1">
						  <a class="tpMenu"  href="javascript:;" id="myInbox">
							  <i class="fa fa-comment-o"></i>
							  <span id="companionWallMailNav">Companion Inbox</span>
							   <span class="label label-danger inboxMsgNum"> </span>
						  </a>
						</li>

						<li class="wizGradeMenu1">
						  <a class="tpMenu"  href="javascript:;" id="broadcast">
							  <i class=" fa fa-bullhorn"></i>
							  <span>Annoucements </span>
						  </a>
						</li>	 

						<li class="wizGradeMenu1">
						  <a class="tpMenu"  href="javascript:;" id="lockScreen">
							  <i class="fa fa-lock"></i>
							  <span>Lock My Screen</span>
						  </a>

						</li> 

						<li class="wizGradeMenu1">
						  <a class="tpMenu"  href="javascript:;" id="wizGradeLogOuta">
							  <i class="fa fa-sign-out"></i>
							  <span>Sign Out</span>
						  </a>

						</li> 

						<?php } ?> 


						</ul>
					
					</li>
				
				</ul>
				<!-- dropdown menu end -->
			</div>


			<div class="top-nav dropdown-profile-top">
                <!-- user info start -->
                <ul class="nav pull-right top-menu">  
				
                    <li class="dropdown" style=" ">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                             <img alt="" src="<?php echo $userPicture; ?>" height="45" width="45" class="img-circle"> 
                            <b class="caret"></b>
                        </a> 
								  
						<ul class="dropdown-menu">
						<li>
							<div class="navbar-content">
								<div class="row">
									<div class="col-md-5">
										<img alt="" src="<?php echo $userPicture; ?>" 
										height="95px" width="110px" class="img-circle" />
									</div>
									<div class="col-md-7 wizGradeMenu1">										
										<p class="text-primary"> <?php echo $userTag; ?> </p>
										<span><b><?php echo $userTopBName; ?></b></span>	
										<div class="divider"></div> 
									</div>
								</div>
							</div>
							<div class="navbar-footer">
								<div class="navbar-footer-content">
									<div class="row">
										<div class="btn-group btn-group-justified wizGradeMenu1">
											<a class="btn btn profile-btn-1" href="javascript:;" id="<?php echo $showBioID; ?>"><i class="fa fa-user fa-2x"></i> </a>
											<a class="btn btn profile-btn-2" href="javascript:;" id="<?php echo $changePassID; ?>"><i class="fa fa-key fa-2x"></i> </a>
											<a class="btn btn profile-btn-3 pageRefresh" href="javascript:;"><i class="fa fa-refresh fa-2x"></i></a>
											<a class="btn bbtn profile-btn-2 lockScreen" href="javascript:;" id="lockScreen"><i class="fa fa-lock fa-2x"></i></a>
											<a class="btn btn profile-btn-1" href="javascript:;" id="wizGradeLogOuta"><i class="fa fa-sign-out fa-2x"></i></a>											
										</div> 
									</div>
									
								</div>
							</div>
						</li>
						</ul> 		
                         
                    </li> 
					
                </ul>
                <!-- user info  end-->
            </div>  
           	
			<div class="nav notify-row" >		
					
				<!--  notification & translator start -->
                <ul class="nav top-menu"> 
					 					
					<?php if(($admin_grade == $adminGrade) && ($admin_level == $adminGradeInt)){  /* check if user is admin */ ?>
                    <!-- inbox dropdown start -->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="btn  dropdown-toggle" href="javascript:;">
                            <i class="fa fa-envelope-o fa-lg"></i>
                            <span class="badge bg-important inboxMsgNum"></span>
                        </a>
						
                        <ul class="dropdown-menu extended inbox dropdown-scroll pull-righta">
                            
                            <li> <p class="title">You have <span class="inboxMsgNum"></span> new messages</p> </li> 
                            
							<?php
							 
								try {

									njidekaCompanionInbox($conn, $member_id, $seVal);  /* companion mail notification */ 
						 
								}catch(PDOException $e) {
				
									wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
								}

							?> 
                            
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
					
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="btn  dropdown-toggle" href="javascript:;">
                            <i class="fa fa-bell-o fa-lg"></i>
                            <span class="badge bg-warning notMsgNum"></span>
                        </a>                        
						
                        <ul class="dropdown-menu extended notification dropdown-scroll pull-righta">
                            
                            <li> <p class="title">You have <span class="notMsgNum"></span> new notifications</p>  </li>
                  
							<?php
								 
								try {

									wallNotifications($conn, $member_id, $seVal);  /* companion mail notification */ 
						 
								}catch(PDOException $e) {
				
									wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
								}

							?>
                        </ul>
                    </li>
                    <!-- notification dropdown end -->
                    <?php } ?> 
					 
                    
                </ul>
                <!--  notification  end -->
            </div> 
			
            <div class="nav notify-row flag-menu">
                
                <ul class="nav nav-top-accordiona top-menu"> 
					
					<!--  translator start -->
					<li class="dropdown">
						<a data-toggle="dropdown" class="btn  dropdown-toggle translateBtn" href="javascript:;">
							<i class="fa fa-flag fa-lg"></i> 
						</a>   
						
						<ul class="dropdown-menu pull-right" style="width:230px !important;">
							<li>
								<div class="navbar-content">
									<!-- row -->	
									<div class="row">
										<div class="col-md-4"> 

										<div id="google_translate_element" class="pull-left col-md-2" style="margin: 4px !important;"></div>

										<script type="text/javascript">

											function googleTranslateElementInit() {
												new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
											} 

										</script>

										<script type="text/javascript" 
										src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
										 
										</div> 
									</div>
									<!-- / row -->	
								</div>												 
							</li>
						</ul>			
									 
					</li> 
					<!--  translator end -->			 
                    
                </ul>
                
            </div>
            
        </header>
		<!-- header end --> 
	  
		<!--sidebar start-->
		<aside> 
      
			<div id="sidebar"  class="nav-collapse mCustomScrollbar-O">
				<!-- sidebar menu start-->
				<ul class="sidebar-menu" id="nav-accordion">
								  
					<li class="wizGradeMenu1">
					  <a class="active" href="javascript:;" id="home">
						  <i class="fa fa-dashboard myDashboard loadPager" id="myDashboard"></i>
						  <span id="homePage">Dashboard</span>
					  </a>
					</li>
					<li class="sub-menu">
					  <a href="javascript:;" >
						  <i class="fa fa-arrow-circle-right"></i>
						  <span>Select School</span>
					  </a>
					  <ul class="sub">
						  <li class="changeSchool" id="log-nur"><a  href="javascript:;">
						  <i class="fa fa-chevron-right"></i> Nursery School</a></li>
						  <li class="changeSchool" id="log-pri"><a  href="javascript:;">
						  <i class="fa fa-chevron-right"></i> Primary School</a></li>
						  <li class="changeSchool" id="log-sec"><a  href="javascript:;">
						  <i class="fa fa-chevron-right"></i> Secondary School</a> </li> 

					  </ul>
					</li>

					<?php if(($admin_grade == $adminGrade) && ($admin_level == $adminGradeInt)){  /* check if user is admin */  ?>

					<li class="sub-menu">
					  <a href="javascript:;" >
						  <i class="fa fa-wrench"></i>
						  <span>Global Config.</span>
					  </a>
					  <ul class="sub">
						  <li class="wizGradeMenu2"><a  href="javascript:;" id="wizGradeSchConfigs">
						  <i class="fa fa-chevron-right"></i> School Setup</a></li>
						  <li class="wizGradeMenu2"><a  href="javascript:;" id="wizGradeTheme">
						  <i class="fa fa-chevron-right"></i> School Theme</a></li>
						  <li class="wizGradeMenu2"><a  href="javascript:;" id="currentSchoolSession">
						  <i class="fa fa-chevron-right"></i>  Current Session </a></li>						  
						  <li class="wizGradeMenu1"><a  href="javascript:;" id="smsConfig">
						  <i class="fa fa-chevron-right"></i> SMS Config.</a></li>						  
						  <li class="wizGradeMenu1"><a  href="javascript:;" id="payGateway">
						  <i class="fa fa-chevron-right"></i> Payment Gateway</a></li>						  
						  <li class="wizGradeMenu1"><a  href="javascript:;" id="scoreGrade">
						  <i class="fa fa-chevron-right"></i> Grade Scores </a></li>						  
						  <li class="wizGradeMenu2"><a  href="javascript:;" id="teacherRemarks">
						  <i class="fa fa-chevron-right"></i> Teacher's Remark</a></li>
						  <li class="wizGradeMenu2"><a  href="javascript:;" id="disabilitySettings">
						  <i class="fa fa-chevron-right"></i> Disability List </a> </li>
						  <li class="wizGradeMenu2"><a  href="javascript:;" id="schoolClubSettings">
						  <i class="fa fa-chevron-right"></i> School Clubs</a></li>
						  <li class="wizGradeMenu2"><a  href="javascript:;" id="schoolClubPostSettings">
						  <i class="fa fa-chevron-right"></i> Clubs Postition</a> </li>
						  <li class="wizGradeMenu2"><a  href="javascript:;" id="sportsSettings">
						  <i class="fa fa-chevron-right"></i> Sports Lists</a></li> 
					  </ul>
					</li> 

					<li class="wizGradeMenu1">
					  <a href="javascript:;" id="newRegistration">
						  <i class="fa fa-user-circle"></i>
						 New Registration <span class="label label-danger"><span id="totalRegsCount">
						 <?php echo $totalRegis; ?></span></span>
					  </a>
					</li>

					<li class="sub-menu">
					  <a href="javascript:;" >
						 <i class="fa fa-users"></i>
						  <span>Staff HR</span>
					  </a>
					  <ul class="sub">
						  <li class="wizGradeMenu1"><a  href="javascript:;" id="newTeacherBio">
						  <i class="fa fa-chevron-right"></i> Add Staff</a>
						  </li>
						  <li class="wizGradeMenu1"><a  href="javascript:;" id="teacherBioData">
						  <i class="fa fa-chevron-right"></i> Manage Staffs</a></li>
						  <li class="wizGradeMenu1"><a  href="javascript:;" id="searchTeacher">
						  <i class="fa fa-chevron-right"></i> Search Staffs</a></li>
						  <li class="wizGradeMenu1"><a  href="javascript:;" id="smsStaff">
						  <i class="fa fa-chevron-right"></i> Send SMS</a></li> 
					  </ul>
					  
					</li> 
					
					<li class="wizGradeMenu1">
					  <a href="javascript:;" id="cardPins" >
						  <i class=" fa fa-paw"></i>
						  <span>Scratch Card Pins</span>
					  </a>
					</li>

					<li class="wizGradeMenu1">
					  <a href="javascript:;" id="schoolEvents" >
						  <i class=" fa fa-calendar-plus-o"></i>
						  <span>School Events </span>
					  </a>
					</li> 

					<li class="wizGradeMenu1">
					  <a href="javascript:;" id="wallCompanion" >
						  <i class="fa fa-group"></i>
						  <span id="CompanionWall">Companion Wall</span>
					  </a>

					</li>                  

					<li class="wizGradeMenu1">
					  <a href="javascript:;" id="myInbox">
						  <i class="fa fa-comment-o"></i>
						  <span id="companionWallMailNav">Companion Inbox</span>
						   <span class="label label-danger inboxMsgNum"> </span>
					  </a>
					</li>      

					<li class="wizGradeMenu1">
					  <a href="javascript:;" id="broadcast" >
						  <i class=" fa fa-bullhorn"></i>
						  <span>Annoucements </span>
					  </a>
					</li>

					<li class="wizGradeMenu1">
					  <a href="javascript:;" id="lockScreen">
						  <i class="fa fa-lock"></i>
						  <span>Lock My Screen</span>
					  </a>

					</li>

					<li class="wizGradeMenu1">
						<a href="javascript:;" id="wizGradeLogOuta">
							<i class="fa fa-sign-out"></i>
							<span>Sign Out</span>
						</a>

					</li>  

               <?php } ?> 

				</ul>
			  </ul>
              <!-- sidebar menu end-->
          </div> 
		  
		</aside>
		<!--sidebar end-->
		
		<!--main content start--> 
		<section id="main-content">
		
			<section class="wrapper site-min-height" id="scrollTargetMPage" > 
		  
				<div class="panel-body">
						
					<div class="nav pull-left  col-lg-12" style="margin: 4px !important;">  
					<div class="btn-group btn-group-justified">
						  <a class="btn btn-danger changeSchool" id="log-sec" href="javascript:;">
						  <i class="fa fa-sign-in fa-lg"></i> <span class="middle-menu-div">Go To </span>Sec<span class="middle-menu-div">ondary</span>
						  <span class="hide-res">School</span> <span class="middle-menu-div">Section</span></a>
						  <a class="btn btn-white changeSchool" id="log-pri" href="javascript:;">
						  <i class="fa fa-sign-in fa-lg"></i> <span class="middle-menu-div">Go To </span>Pri<span class="middle-menu-div">mary</span> 
						  <span class="hide-res">School</span> <span class="middle-menu-div">Section</span></a>
						  <a class="btn btn-danger changeSchool" id="log-nur" href="javascript:;">
						  <i class="fa fa-sign-in fa-lg"></i> <span class="middle-menu-div">Go To </span>Nur<span class="middle-menu-div">sery</span> 
						  <span class="hide-res">School</span> <span class="middle-menu-div">Section</span> </a>
					</div>
					</div> 
						 
				</div>							  
				 
				<!--
				<div class="wizGrade-preloader">
					<div class="wizGrade-status">&nbsp;</div>
					 <div class="wizGrade-preload">						 
					</div>
				</div> 
				--> 
			 
				<noscript> <?php echo $infMsg.$noscriptMsg.$msgEnd;  ?> </noscript>
				<div id="schoolCDIV"> </div>
				<div class="loader-background">
					<img src="<?php echo $wizGradeTemplate?>images/loading.gif" 
					alt="please wait. Page loading >>>>>>>>>>>>>>>" /><!-- loading image -->					 
				</div>
		

				<div id="wizGradePageMsg" style="display:nonea;"> </div><div id="wizGradePagerMsg" style="display:none;"> </div>
				<div id='wizGradePgContent' style="margin-top:10px; margin-bottom: 30px;">  
				</div>		

			</section>
		</section>
		<script> $( window ).load(function() { $('.loadPager').trigger('click'); /* trigger click */ }); </script>
		<!--main content end-->
      
		<?php }	?>

		<!-- footer start -->
		<?php require_once ($wizGradeTemplate.'wizGradeFooter.php');   /* include template footer */ ?>
		<!-- footer end -->