<?php

/*   
	Copyright (C) fobrain Tech LTD (2014 - 2024) - All Rights Reserved
	
	Licensed under the Apache License, Version 2.0 (the 'License');
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an 'AS IS' BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License	
	 
	#####################################################################################################
	fobrain (wizgrade open source) app is designed & developed by Igweze Ebele Mark for fobrain Tech LTD
	#####################################################################################################

	fobrain is Dedicated To Almighty God, My fabulous FAMILY and Amazing Parents.  
	
	WEBSITE 							PHONES/WHATSAPP					EMAILS
	https://www.fobrain.com				+234 - 80 30 716 751  			opensource@fobrain.com
										+234 - 80 22 000 490 	
	
	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Page/Code Explanation~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	This script handle school head modules
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

ob_start(); 

if(!session_id()){
    session_start();
}


		define('fobrain', 'igweze');  /* define a check for wrong access of file */	  
		
	  	require 'configwizGrade.php';  /* load wizGrade configuration files */	   


		if ( (!isset($_SESSION['accessGrade']))
		|| ($_SESSION['accessGrade'] != $schHeadGrade)
		|| (!isset($_SESSION['accessLevel']))
		|| ($_SESSION['accessLevel'] != $schHeadGradeInt)

		) {  /* user validation */

			header("Location: $wizGradeLogOutDir");
			echo "<script type='text/javascript'> window.location.href = '$wizGradeLogOutDir';</script>"; exit;

		} 

		try { 	
					
			$staffInfo = staffData($conn, $_SESSION['adminID']);  /* school staffs/teachers information */ 
			
			list ($staffTitle, $staffName, $staffSex, $staffRank, $staffPic, $staffLName) =
			explode ("#@s@#", $staffInfo);	
			
			$staffTitleVal = $title_list[$staffTitle];
			
			$staffTopBName = $staffTitleVal.' '.$staffLName;

			if ( (is_null($staffPic)) || ($staffPic == '') || (!file_exists($staffPicExt.$staffPic)) ){  /* check if picture exists */ 
						$adminPic = $wizGradeDefaultPic; }
			else { $adminPic = $staffPicExt.$staffPic; }
			
			$studentToken = studentToken($conn);  /* students token record information  */

		}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		}
		
		require_once ($wizGradeTemplate.'wizGradeHeader.php');  /* include template head */

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
						<img src="<?php echo $adminPic; ?>" height="180px" width="180px" 
						class="img-responsive img-circle img-thumbnail" alt="thumbnail">
					</div>
					<div class="form-group">
						<h3><?php echo $adminTopBName;; ?></h3>
						<h4><i class="fa fa-lock fa-lg"></i> Locked</h4>
						<p class="text-muted">Enter your password to access your dashboard</p>
						<div class="display-none" id="wizAns"><span class="col-i-2">123 :::: wizGrade</span></div>
						<div class="input-group m-t-30">
							<input type="password" name="password" class="form-control" placeholder="Enter Password">
							<input type="hidden" name="timeOutType" value="wizGradeTimeOut">
							<span class="input-group-btn wizGradeMenu"> <button type="submit" class="btn btn-email btn-info waves-effect waves-light" 
							id="timeOutLogin">
								<i class="fa fa-unlock fa-lg"></i> Unlock
							</button> </span>
						</div>
					</div>
					<div class="text-right wizGradeMenu">
						<a href="#" class="text-muted">Not <?php echo $staffTopBName; ?> ?  <a href="javascript:;" id="wizGradeLogOuta">
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
				height="40"  width="180" class="logo-img" alt="wizGrade logo" /></div>
				<span class="topSoftMenu logo-menu display-none" id="wizGradeMenuTop2"></span>
            </div>            
            <!-- logo end -->
			
			<div class="top-nav top-school-info"> 
				<!-- school title and logo info start -->
				<button  class="btn btn-white pull-left" id="maxPageIcon" style="margin-right:8px !important;">
				<i class="fa fa-arrow-left text-info"></i>  </button>
                                  
                <button  class="btn btn-white display-none pull-left" id="min-page-icon" style="margin-right:8px !important;">
				<i class="fa fa-arrow-right text-info"></i> </button>		 						
			  
				<span id="top-school-pic"> <img src="<?php echo $sch_logo; ?>" class="school-logo" alt="School logo" /></span> </span>
				<span id="top-school-name"><?php echo $schoolNameTop; ?></span>
				<!-- school title and logo info end -->
            </div>
			
			<div class="nav notify-row dropdown-menu-top">
				<!-- dropdown menu start -->
				<ul class="nav  top-menu nav-top-accordion">  
					<li class="dropdown pull-right">
						
						<a href="javascript:;" class="btn  dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bars fa-lg dropdown-menu-icon"></i> </a> 
						<ul class="dropdown-menu dropdown-menu-up">

						<li class="wizGradeMenu">
						  <a class="active tpMenu" href="javascript:;" id="home">
							  <i class="fa fa-dashboard myDashboard" id="myDashboard"></i>
							  <span id="homePage">My Dashboard</span>
						  </a>
						</li>

						<li class="wizGradeMenu">
						  <a  class="tpMenu"  href="javascript:;" id="homePage">
							  <i class="fa fa-arrow-left"></i>
							  <span>Select New School</span>
						  </a>
						</li>

						<li class="sub-menu">
						  <a href="javascript:;" >
							  <i class="fa fa-user"></i>
							  <span>Search Students</span>
						  </a>
						  <ul class="sub">
							 
							  <li class="sub-menu">
								  <a  href="javascript:;">Search Profile By</a>
								  <ul class="sub">
									  <li class="wizGradeMenu"><a  class="tpMenu"  href="javascript:;" id="searchByName"> 
									  <i class="fa fa-chevron-right"></i> Name / Reg No.</a></li>
									  <li class="wizGradeMenu"><a  class="tpMenu"  href="javascript:;" id="searchBioClass">
									  <i class="fa fa-chevron-right"></i> Class </a></li>
									  
								  </ul>
							  </li>
							 
						  </ul>
						</li>

						<li class="sub-menu">
						  <a href="javascript:;" >
							  <i class="fa fa-book"></i>
							  <span>Result Manager</span>
						  </a>
						  <ul class="sub">
							  <li class="wizGradeMenu"><a  class="tpMenu"  href="javascript:;" id="cRS">
							  <i class="fa fa-chevron-right"></i> Class Results</a></li>
							  
							  <li class="wizGradeMenu"><a  class="tpMenu"  href="javascript:;" id="transcripts">
							  <i class="fa fa-chevron-right"></i> Student Transcript</a></li>

						  </ul>
						</li> 

						<li class="sub-menu">
						  <a href="javascript:;">
							 <i class="fa fa-envelope-o"></i>
							  <span> Send SMS</span>
						  </a>
						  <ul class="sub">
							  
							  <li class="wizGradeMenu"><a  class="tpMenu"  href="javascript:;" id="smsStudent">
							  <i class="fa fa-chevron-right"></i> To  Parents </a></li>
							  
							  <li class="wizGradeMenu"><a  class="tpMenu"  href="javascript:;" id="smsStaff">
							  <i class="fa fa-chevron-right"></i> To Staffs</a></li>
							  
							

						  </ul>
						  
						</li>

						<li class="sub-menu">
						  <a href="javascript:;">
							 <i class="fa fa-users"></i>
							  <span> Staff HR</span>
						  </a>
						  <ul class="sub">
							  
							  <li class="wizGradeMenu1"><a  class="tpMenu"  href="javascript:;" id="teacherBioData">
							  <i class="fa fa-chevron-right"></i> View Staffs</a></li>
							  <li class="wizGradeMenu1"><a  class="tpMenu"  href="javascript:;" id="searchTeacher">
							  <i class="fa fa-chevron-right"></i> Search Staffs</a></li> 

						  </ul>
						  
						</li>

						<li class="wizGradeMenu">
						  <a class="tpMenu"  href="javascript:;" id="broadcast" >
							  <i class=" fa fa-bullhorn"></i>
							  <span>Annoucements </span>
						  </a>
						</li>  

						<li class="wizGradeMenu">
						  <a class="tpMenu"  href="javascript:;" id="timeTable" >
							  <i class=" fa fa-calendar"></i>
							  <span>Exam TimeTable </span>
						  </a>
						 
						</li>
						<li class="wizGradeMenu1">
						  <a class="tpMenu"  href="javascript:;" id="schoolEvents" >
							  <i class=" fa fa-calendar-plus-o"></i>
							  <span>School Events </span>
						  </a>
						</li>

						<li class="wizGradeMenu">
						  <a class="tpMenu"  href="javascript:;" id="schoolHostel" >
							  <i class=" fa fa-university"></i>
							  <span>School Hostel</span>
						  </a>
						</li>

						<li class="wizGradeMenu">
						  <a class="tpMenu"  href="javascript:;" id="schoolRoute" >
							  <i class=" fa fa-road"></i>
							  <span>School Route</span>
						  </a>
						</li>
						<li class="wizGradeMenu">
						  <a class="tpMenu"  href="javascript:;" id="myBioData">
							  <i class="fa fa-user"></i>
							  <span>My Profile</span>
						  </a>

						</li> 

						<li class="wizGradeMenu">
						  <a class="tpMenu"  href="javascript:;" id="lockScreen">
							  <i class="fa fa-lock"></i>
							  <span>Lock My Screen</span>
						  </a>

						</li>

						<li class="wizGradeMenu">
						  <a class="tpMenu"  href="javascript:;" id="wizGradeLogOuta">
								<i class="fa fa-sign-out"></i>
								<span>Sign Out</span>
						  </a>

						</li>  

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
                             <img alt="" src="<?php echo $adminPic; ?>" height="45" width="45" class="img-circle"> 
                            <b class="caret"></b>
                        </a> 
								  
						<ul class="dropdown-menu">
						<li>
							<div class="navbar-content">
								<div class="row">
									<div class="col-md-5">
										<img alt="" src="<?php echo $adminPic; ?>" 
										height="95px" width="110px" class="img-circle" />
									</div>
									<div class="col-md-7 wizGradeMenu">
										
										<p class="text-primary"> School Head </p>
										<span><b><?php echo $staffTopBName; ?></b></span>	
										<div class="divider"></div> 
									</div>
								</div>
							</div>
							<div class="navbar-footer">
								<div class="navbar-footer-content">
									<div class="row">
										<div class="btn-group btn-group-justified wizGradeMenu">
											<a class="btn btn profile-btn-1" href="javascript:;" id="myBioData"><i class="fa fa-user fa-2x"></i> </a>
											<a class="btn btn profile-btn-2" href="javascript:;" id="editPass"><i class="fa fa-key fa-2x"></i> </a>
											<a class="btn btn profile-btn-3 pageRefresh" href="javascript:;"><i class="fa fa-refresh fa-2x"></i></a>
											<a class="btn btn profile-btn-2 lockScreen" href="javascript:;" id="lockScreen"><i class="fa fa-lock fa-2x"></i></a>
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
			
            <div class="nav notify-row flag-menu-ni">
                
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


		<!-- sidebar start -->
		<aside>
      
			<div id="sidebar"  class="nav-collapse mCustomScrollbar-O">
				<!-- sidebar menu start-->
				<ul class="sidebar-menu" id="nav-accordion">
			  
					<li class="wizGradeMenu">
					  <a class="active" href="javascript:;" id="home">
						  <i class="fa fa-dashboard myDashboard loadPager" id="myDashboard"></i>
						  <span id="homePage">My Dashboard</span>
					  </a>
					</li>

					<li class="wizGradeMenu">
					  <a  href="javascript:;" id="homePage">
						  <i class="fa fa-arrow-left"></i>
						  <span>Select New School</span>
					  </a>
					</li>

					<li class="sub-menu">
					  <a href="javascript:;" >
						  <i class="fa fa-user"></i>
						  <span>Search Students</span>
					  </a>
					  <ul class="sub">
						 
						  <li class="sub-menu">
							  <a  href="javascript:;">Search Profile By</a>
							  <ul class="sub">
								  <li class="wizGradeMenu"><a  href="javascript:;" id="searchByName"> 
								  <i class="fa fa-chevron-right"></i> Name/Reg No.</a></li>
								  <li class="wizGradeMenu"><a  href="javascript:;" id="searchBioClass">
								  <i class="fa fa-chevron-right"></i> Class</a></li>								  
							  </ul>
						  </li>
						 
					  </ul>
					</li>

					<li class="sub-menu">
					  <a href="javascript:;" >
						  <i class="fa fa-book"></i>
						  <span>Result Manager</span>
					  </a>
					  <ul class="sub">
						  <li class="wizGradeMenu"><a  href="javascript:;" id="cRS">
						  <i class="fa fa-chevron-right"></i> Class Results</a></li>
						  
						  <li class="wizGradeMenu"><a  href="javascript:;" id="transcripts">
						  <i class="fa fa-chevron-right"></i> Transcript</a></li>

					  </ul>
					</li> 

					<li class="sub-menu">
					  <a href="javascript:;">
						 <i class="fa fa-envelope-o"></i>
						  <span> Send SMS</span>
					  </a>
					  <ul class="sub">
						  
						  <li class="wizGradeMenu"><a  href="javascript:;" id="smsStudent">
						  <i class="fa fa-chevron-right"></i> To  Parents </a></li>
						  
						  <li class="wizGradeMenu"><a  href="javascript:;" id="smsStaff">
						  <i class="fa fa-chevron-right"></i> To Staffs</a></li>
						  
						

					  </ul>
					  
					</li>

					<li class="sub-menu">
					  <a href="javascript:;">
						 <i class="fa fa-users"></i>
						  <span> Staff HR</span>
					  </a>
					  <ul class="sub">
						  
						  <li class="wizGradeMenu1"><a  href="javascript:;" id="teacherBioData">
						  <i class="fa fa-chevron-right"></i> View Staffs</a></li>
						  <li class="wizGradeMenu1"><a  href="javascript:;" id="searchTeacher">
						  <i class="fa fa-chevron-right"></i> Search Staffs</a></li> 

					  </ul>
					  
					</li>

					<li class="wizGradeMenu">
					  <a href="javascript:;" id="broadcast" >
						  <i class=" fa fa-bullhorn"></i>
						  <span>Annoucements </span>
					  </a>
					</li> 


					<li class="wizGradeMenu">
					  <a href="javascript:;" id="timeTable" >
						  <i class=" fa fa-calendar"></i>
						  <span>Exam TimeTable </span>
					  </a>
					 
					</li>
					
					<li class="wizGradeMenu1">
					  <a href="javascript:;" id="schoolEvents" >
						  <i class=" fa fa-calendar-plus-o"></i>
						  <span>School Events </span>
					  </a>
					</li>

					<li class="wizGradeMenu">
					  <a href="javascript:;" id="schoolHostel" >
						  <i class=" fa fa-university"></i>
						  <span>School Hostel</span>
					  </a>
					</li>

					<li class="wizGradeMenu">
					  <a href="javascript:;" id="schoolRoute" >
						  <i class=" fa fa-road"></i>
						  <span>School Route</span>
					  </a>
					</li>
					<li class="wizGradeMenu">
					  <a href="javascript:;" id="myBioData">
						  <i class="fa fa-user"></i>
						  <span>My Profile</span>
					  </a>

					</li> 

					<li class="wizGradeMenu">
					  <a href="javascript:;" id="lockScreen">
						  <i class="fa fa-lock"></i>
						  <span>Lock My Screen</span>
					  </a>

					</li>

					<li class="wizGradeMenu">
					  <a href="javascript:;" id="wizGradeLogOuta">
							<i class="fa fa-sign-out"></i>
							<span>Sign Out</span>
					  </a>

					</li>  

				</ul>
				<!-- sidebar menu end-->
			</div>
		</aside>
		<!--sidebar end-->
		
		<!--main content start-->
		<section id="main-content">
		
			<section class="wrapper site-min-height" id="scrollTargetMPage" > 
		  
				<div class="panel-body">
			
					<?php									  
							if ($wizGradeMode == $seVal){  /* current run mode */ $modeS = "style='display:none'"; }else{$modeS = "";}									  
							if ($wizGradeMode == $fiVal){  /* session run mode */ $modeF = "style='display:none'"; }else{$modeF = "";} 
					?> 
					 
					<div class="nav pull-left  col-lg-3" style="margin: 4px !important;">  
		
						<li class="dropdown" style=" ">
							<a data-toggle="dropdown" class="btn btn-danger dropdown-toggle" href="javascript:;">
								<i class="fa fa-calendar fa-lg"></i> <span class="middle-menu-div"> School Session </span> 
								<b class="caret"></b>
							</a>  
							<ul role="menu" class="dropdown-menu pull-left"> 
								<li class =""><a href="javascript:;"> Current Session  <strong><span class="text-bold">
								is <?php echo $currentSessTop; ?></span></strong> </a></li>  								  
							</ul>  
						</li> 
						
					</div> 
					 
					<div class="nav pull-right  col-lg-3" style="margin: 4px !important;">  
		
						<li class="dropdown" style=" ">
							<a data-toggle="dropdown" class="btn btn-danger dropdown-toggle" href="javascript:;">
								 <i class="fa fa-cubes fa-lg"></i> <span class="middle-menu-div"> Run Mode -</span> <strong><span id="runModeText">
								  <?php echo $wizGradeRunModeArr[$wizGradeMode]; ?></span></strong>
								  <b class="caret"></b>
							</a> 
							<ul role="menu" class="dropdown-menu pull-right"> 							 
								<li class ="wizGradeMode" id="wizGradeMode-2" <?php echo $modeS; ?> ><a href="javascript:;">Activate 
								<?php echo $wizGradeRunModeArr[$seVal]; ?> Mode</a></li>
							  
								<li class ="wizGradeMode" id="wizGradeMode-1" <?php echo $modeF; ?> ><a href="javascript:;">Activate 
								<?php echo $wizGradeRunModeArr[$fiVal]; ?> Mode</a></li>  									  
							</ul> 
						</li> 
						
					</div> 
							   
					<div class="col-sm-3 col-lg-3 pull-right middle-menu-div" style="margin: 4px !important;">
						<div class="input-group m-bot15">
							<span class="input-group-btn">
								<button type="button" class="btn btn-white"><i class="fa fa-search"></i></button>
							</span>
							<input type="text" class="form-control" name="searchStudent" 
							id="searchStudent" placeholder="Search for Student here">
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
				
				<noscript> <?php echo $infMsg.$noscriptMsg.$msgEnd;  ?>  </noscript>
          
				<div class="loader-background">	

					<img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="please wait. Page loading >>>>>>>>>>>>>>>" /><!-- loading image -->
			 
				</div>
				<div id="wizGradePageMsg" style="display:none;"> </div><div id="wizGradePagerMsg" style="display:none;"> </div>
				<div id='wizGradePgContent' style="margin-top:10px; margin-bottom: 30px;">               
				</div>		

			</section>
		</section>
		
		<!-- main content end -->
		<script> $( window ).load(function() { $('.loadPager').trigger('click'); /* trigger click */ }); </script>
		
		<!-- student modal search start -->

		<a href="#studentModal" data-toggle="modal" id="studentInfoModal" class=""> </a>

		<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" 
		aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" 
						data-dismiss="modal" aria-hidden="true">
						<span style='color:#fff !important;'>&times;</span></button>
						<h4 class="modal-title"> Student Profile Information
						</h4>
					</div>
					<div class="modal-body modal-body-scroll"> 

						<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="studentSLoading"  
						style="cursor:pointer; display:none; margin-bottom:5px;" /></center><!-- loading image -->

						<div id="editMsg"> </div> 

						<div class="slideUpFrmUDiv">

							<section class="panel">

								<div class="panel-body"> 

									<div id="studentSearchDiv"></div>

								</div>

							</section>

						</div>

					</div>
					<div class="modal-footer slideUpFrmDiv">
						<button data-dismiss="modal" class="btn btn-danger"  type="button">Close</button>
					</div>
				</div>
			</div>
		</div> 

		<!-- student modal search  end -->
		
		<?php }  ?>

		<!-- footer start -->
		<?php require_once ($wizGradeTemplate.'wizGradeFooter.php');   /* include template footer */ ?>
		<!-- footer end -->