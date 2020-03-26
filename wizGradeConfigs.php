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
	This main script define school variables, database tables, directory links, and predefined arrays
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

				/* DON'T EDIT BELOW UNLESS YOU KNOW WHAT YOU ARE DOING */
				
				error_reporting(0);  /* Comment this line to view unknown error */ 
			
				require 'wizGradeConfig.php';

				date_default_timezone_set('Africa/Lagos');  /* user time zone */
				
				$wizGradeSQLData = 'wizGrade.sql';  /* SQL Installation files */
				
				$wizGradeSQLPointer = $wizGradeSQLData.'_filepointer';  /* SQL Installation files pointer */
				
				/* 				
				PLEASE DON'T EDIT THIS 3 LINES BELOW.
				
				Meanwhile, if you want remove this, you should a valid license from wizGrade. 
				
				Please, note that defaulter will be FULLY SANCTION
				
				Thanks 
				*/
				
				$wizGradeVersion = 'wizGrade';
				$wizGradeVfooter = '<a href="https://www.wizgrade.com" class="col-i-2"
				target="_blank" style="color:#fff;">2014-2020 &copy '.$wizGradeVersion.' 1.2</a>'; 
				
				/* school type settings */
				
				$wizGradeNurAbr = 'nur';
				$wizGradePriAbr = 'pri';
				$wizGradeSecAbr = 'sec';
				
				$wizGradeNurPref = 'nur_';
				$wizGradePriPref = 'pri_';
				$wizGradeSecPref = 'sec_';

				$generatePass = 0;  /* 0 means don't generate passwords while 1 will generate passwords */ 
						 
				$rseditingStage = 1;  /* result editing stage status */
				$rscomputedStage = 2;  /* result computed stage status */
				$rspublishStage = 3;  /* result published stage status */				

				$femaleG = 1; $maleG = 2;

				/* grade level integer */		
				
				$adminGradeInt = 1; $staffGradeInt = 2; $schHeadGradeInt = 3; 
				$libraryGradeInt = 4; $bursaryGradeInt = 5; $comGradeInt = 1992;
				
				/* grade level name */
				
				$adminGrade = 'admin'; $staffGrade = 'staff'; $schHeadGrade = 'schoolhead'; 
				$libraryGrade = 'libraian'; $bursaryGrade = 'bursary'; $comGrade = 'commonPage';  

				$showNewPanel = false;  /* set show panel div to false */

				$i_r_cr_ar = 0; /* index raw course array position */
				$i_cc_ar = 1;   /* index course code array position */
				$i_tit_ar = 2;  /* index course title array position */
				$i_cu_ar = 3;   /* index credit units array position */
				$i_cc_in = 4;   /* index credit units array position */

				/* looping array starter */
				
				$inti_reg_no_arr = 0;
				$inti_result_loop_arr = 0;
				$inti_cr_course_arr_start = 1;
				$i_start_rs_loop = 1;

				/* semester code */
				
				$first_semester_code = 1; $second_semester_code = 2; 

				/* predefined integer start */
				
				$foreal = 1; $i_false = 0;

				$fi_level = 1; $se_level = 2; $th_level = 3; $fo_level = 4; $fif_level = 5; $six_level = 6; $sev_level = 7;
				$eig_level = 8; $nine_level = 9; $ten_level = 10; $extra_year = "extra"; $all_year = "all";

				$fi_term = 1; $se_term = 2; $th_term = 3;

				$fiVal = 1; $seVal = 2; $thVal = 3; $foVal = 4; $fifVal = 5; $sixVal = 6; $sevVal = 7; $eightVal = 8; 
				$nineVal = 9; $tenVal = 10;  

				$start_level = 1;
				
				$courseDuration = 6;
     	
				$mailoffSetVal = 2;

				$cWallNumPerPage = 5;  

				$error_add_val_1 = 9361;
				
                $error_add_val_2 = 16841;	
				
				/* predefined integer end */ 
				
				$queryUserBio = 'i_firstname, i_midname, i_lastname, i_dob, i_stupic';  /* student profile query string */  
                
				/* random character generator */
				
  			    $charset = "aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ123456789";
				$charsetSe = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
				
				$randChars = "aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ0123456789"; 
				$randCharBig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$randNumber = '0123456789';

                $gradeNkiruka = "100 - 70 (A), 69 - 60 (B), 59 - 50 (C), 49 - 45 (D), 44 - 40 (E), 39 - 0 (F)"; /* student grader */
				
				$oneMB = 1048576;  /* one mb size value */ 
				
				$allowedPicExt = "jpeg, jpg and png";	/* allow defined files */
				$allowedDocExt = "doc, docx, pdf, xls, xlsx and txt";	/* allow defined files */
				$allowedExcelExt = "xls";	/* allow defined files */
				
				/* script directory start */ 

				$headerStudentPage = $wizGradePortalRoot.'studentdashboard';
				
				$headerParentPage = $wizGradePortalRoot.'parentdashboard';
				
				$headerAdminIndex = $wizGradePortalRoot.'dashboard/';    
				
				$headerAdminPage = $wizGradePortalRoot.'dashboard/admin';
				
				$headerComPage = $wizGradePortalRoot.'dashboard/';
				
				$headerStaffPage = $wizGradePortalRoot.'dashboard/staff';
				
				$headerSchHeadPage = $wizGradePortalRoot.'dashboard/schoolhead';
				
				$headerLibrarianPage = $wizGradePortalRoot.'libraian';	
				
				$headerBursaryPage = $wizGradePortalRoot.'bursary';	 

				$wizGradeLogOutDir = $wizGradePortalRoot;
				
				$wizGrade404Dir = $wizGradePortalRoot.'404';
				
				$wizGradeDBConnectIndDir = './wizGradeConnect.php';
				
				$wizGradeDBConnectDir = '../wizGradeConnect.php';	
				
				$wizGradeTemplateIN = './wizGradeTemplates/';
				
				$wizGradeTemplate = '../wizGradeTemplates/';  
				
				$wizGradeNurConfig = 'schoolConfigs/wizGradeNUR.php';
				
				$wizGradePRIConfig = 'schoolConfigs/wizGradePRI.php';
				
				$wizGradeSECConfig = 'schoolConfigs/wizGradeSEC.php';
				
				$wizGradeComTBConfig = 'schoolConfigs/commonConfigTB.php';				

			 	$wizGradeStudentDir = $wizGradeDir.'sources/studentPage/';
				
				$wizGradeAdminDir = $wizGradeDir.'sources/adminPage/admin/';
				
				$wizGradeLibraryDir = $wizGradeDir.'sources/adminPage/librarian/';
				
				$bursaryDir = $wizGradeDir.'sources/adminPage/bursary/';
			 
			 	$wizGradeFormTeacherDir = $wizGradeDir.'sources/adminPage/formTeacher/';
				 
			 	$wizGradeGlobalDir = $wizGradeDir.'sources/global';
			 
			 	$wizGradeLevelDir = $wizGradeDir.'sources/global/class/';
				
				$wizGradeGlobalScriptsDir = $wizGradeDir.'sources/global/scripts/';
				
				$wizGradeGlobalBioDir = $wizGradeDir.'sources/global/bio/';
				
				$companionScriptJS = $wizGradeGlobalScriptsDir.'common-js-scripts.php';
				
				$wizGradevalidater = $wizGradeGlobalScriptsDir.'validate-pages.php';
			 
			 	$shoppingDir = $wizGradeDir.'sources/global/shopping/'; 
			 
			 	$wizGradeGlobalRSDir = $wizGradeDir.'sources/global/classRS/';
			 
			 	$wizGradeAdminGlobalDir = $wizGradeDir.'sources/adminPage/commonPage/';
			 
			 	$wizGradeFunctionDir = $wizGradeDir.'sources/functions/functions.php';
			 
			 	$wizGradeClassRSManagerDir = $wizGradeDir.'sources/adminPage/commonPage/wizGradeClassRS.php';
			 
			 	$wizGradeAllClass = $wizGradeDir.'sources/adminPage/commonPage/wizGradeClassSessionRS.php';
				
				$wizGradeCalRSDir = $wizGradeAdminGlobalDir.'wizGradeCalManager.php';
				
				$wizGradeIconPage = $wizGradeGlobalDir.'/wizGradeIconPage.php';
				
				$wizGradePayG = $wizGradeGlobalDir.'/wizGradePaymentGateway.php';
				
				$wizGradeFDashBoard = $wizGradeGlobalDir.'/commonFDashBoard.php';  
				
				$wizGradeSchoolTBS = $wizGradeGlobalDir.'/wizGradeCommonTBs.php';
				
				$wizGradeClassConfigDir = $wizGradeGlobalDir.'/wizGradeClassConfig.php';	
				
			 	$wizGradeExportRSDir = $wizGradeDir.'sources/adminPage/commonPage/wizGradeExportRS.php';
				
				$exportScanRSDir = $wizGradeDir.'sources/adminPage/commonPage/wizGradeExScanRS.php';
			 
			 	$wizGradeStudentComRSDir = $wizGradeGlobalRSDir.'wizGradeCommentRS.php';
				
				$wizGradeStudentSubRSDir = $wizGradeGlobalRSDir.'studentRS.php';
				
				$wizGradeClassBestRSDir = $wizGradeGlobalRSDir.'studentClassBestRS.php'; 
			 
			 	$wizGradeSessionRSDir = $wizGradeGlobalRSDir.'studentSessionRS.php'; 			
				
				$wizGradeCWallDir = $wizGradeDir.'sources/global/wallCompanion/';
                
                $wizGradeFunctionDir = $wizGradeDir.'sources/functions/functions.php';
				
				$wizGradeCWallFunctionDir = $wizGradeGlobalDir.'/wallCompanion/companionFunctions.php';
				
                $wizGradePicDir = $wizGradeDir.'wizGradePic/'; 
				
				$forumPicExt = $wizGradePicDir.'comp-wall/';
				
				$staffPicExt = $wizGradePicDir.'staffs/';
				
				$teachersSignExt = $wizGradePicDir.'staffs/signature/';
				
				$forumPicExtTem = $wizGradePicDir.'comp-wall-temp/';
				
				$wizGradeAdminPicDir = $wizGradePicDir.'admin/';
				
				$applyPSrc = $wizGradePicDir.'application/';
				
				$wizGradeDefaultPic = $wizGradeTemplate.'images/avatar.png';
				
				$defualt_pic_forum = $wizGradeDefaultPic;
				
				$defualtLIBPic = $wizGradePicDir.'wizGradeLibDPic.png'; 
				
				$defaultShopPic = $wizGradePicDir.'defaultShopping.jpg'; 
				
				$wallPicLoader = $wizGradeTemplate.'images/s_loader.gif'; 
				
				$sch_logo = $wizGradeTemplate.'images/sch_logo.png';			
				
				$sch_logo_path = $wizGradePicDir.'school/';	
				
				$rsUploadsPath = $wizGradePicDir.'rs-uploads/';
				
				$wizGradeLibDir =  $wizGradePicDir.'library-book/';
				
				$wizGradeProductDir =  $wizGradePicDir.'products/';
				
				$wizGradeQuestionDir =  $wizGradePicDir.'examQuestion/';
				
				$wizGradeCWallIndDir = $wizGradeCWallDir.'companionWall.php';
				
				$wizGradeCInboxIndDir = $wizGradeCWallDir.'companionWallInbox.php';        
					
				$wizGradeInstallDir = $wizGradeDir.'install/';	
				
				/* script directory end */ 
				
				
				/* report messages start */ 
				
				$noscriptMsg = 'Ooooooooops, you need to turn on your javascript in your web browser to access this web application. Thanks';

				$noConnCongfigMsg = 'Ooooooooops critical error, some important configuration files are missing. Thanks';
										
				$tframeF = "*Oooooops Error,
						 you don't have right again to add / edit this session class result. This
						 session class result <span style = 'font-weight:bold;color:#000; 
						 text-transform:uppercase;'>(";

				$tframeS = ") </span><span style='font-weight:bold;color:#000'> has been published. Thank You</span>";
						 
				$sessNote = "<span class='label label-danger'>NOTE!</span>
				<span style='color:#ff0000'>School Session is to enable school search for their
									 previous student records even years after graduation.
									 </span>";		
				/*					 
				$rsAdsFooter = "<div class='rs-water-mark'><i class='fa fa-info-circle'></i> Computed by <b>wizGrade School Manager</b>. 
				Visits <b>www.wizgrade.com</b> for more info</div>";
				*/

				$rsAutoFooter = "<b>wizGrade</b> Automatic Subject Result Scanning Format. Visits <b>www.wizgrade.com</b> for more info";	

				$msg_required_fields = "*Note: This field is Required !!!!";
				$msg_required_fields_date = "*Note: Format Year/Month/Day - 2017/10/16 !!!!";		 
				$wizGradeCriticalMsg = "Critical Error, An unknown error has just Occured. Please report this error to  developers";

				//if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
				if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || preg_match('~Trident/7.0(; Touch)?; rv:11.0~',$_SERVER['HTTP_USER_AGENT'])) {
					$succesMsg = "<script type='text/javascript'>
						
						new PNotify({
						title: 'Success Message',
						text: '";

					$errorMsg = "<script type='text/javascript'>
						
						new PNotify({
						title: 'Error Message',
						text: '";	
						
					$warningMsg = "<script type='text/javascript'>
						
						new PNotify({
						title: 'Warning Message',
						text: '";
						
					$infoMsg = "<script type='text/javascript'>
						
						new PNotify({
						title: 'Info Message',
						text: '";

					$infoMsg1 = "
						
						new PNotify({
						title: 'Info Message',
						text: '";		
										 

					$sEnd =  "',
							type: 'success'
						});

						</script>";

					$eEnd =  "',
							type: 'error'
						});

						</script>";

					$iEnd =  "',
							type: 'info'
						});

						</script>";

					$iEnd1 =  "',
							type: 'info'
						});

						";		

					$wEnd =  "',
							type: 'info'
						});

						</script>";	   
				}else{
					
					$succesMsg = "<script type='text/javascript'>
						
						Swal.fire(
						  'Success Message!',
						  '";
						  
					$succesMsg1 = "
						
						Swal.fire(
						  'Success Message!',
						  '";	  

					$errorMsg = "<script type='text/javascript'>
						
						Swal.fire(
						  'Error Message!',
						  '"; 	
						
					$warningMsg = "<script type='text/javascript'>
						
						Swal.fire(
						  'Warning Message!',
						  '";
						
					$infoMsg = "<script type='text/javascript'>
						
						Swal.fire(
						  'Info Message!',
						  '";	
					
					$infoMsg1 = "
						
						Swal.fire(
						  'Info Message!',
						  '";		
										 

					$sEnd =  "',
						  'success'
						)
					 
						</script>";
						
					$sEnd1 =  "',
						  'success'
						)
					 
						 ";	

					$eEnd =  "',
						  'error'
						)
					 
						</script>";

					$iEnd =  "',
						  'info'
						)
					 
						</script>";	

					$iEnd1 =  "',
						  'info'
						)
					 
						";			

					$wEnd =  "',
						  'warning'
						)
					 
						</script>"; 
				}
				$succesMsg2 = "<script type='text/javascript'>
					
					new PNotify({
					title: 'Success Message',
					text: '";

				$errorMsg2 = "<script type='text/javascript'>
					
					new PNotify({
					title: 'Error Message',
					text: '";	
					
				$warningMsg2 = "<script type='text/javascript'>
					
					new PNotify({
					title: 'Warning Message',
					text: '";
					
				$infoMsg2 = "<script type='text/javascript'>
					
					new PNotify({
					title: 'Info Message',
					text: '";		
									 

				$sEnd2 =  "',
						type: 'success'
					});

					</script>";

				$eEnd2 =  "',
						type: 'error'
					});

					</script>";

				$iEnd2 =  "',
						type: 'info'
					});

					</script>";			

				$wEnd2 =  "',
						type: 'info'
					});

					</script>";	 					

				$succMsg = '<div class="alert alert-success alert-block fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
					<i class="fa fa-times"></i>
					</button>
					<h4>
					<i class="fa fa-check-square-o"> </i>
					Success Message!
					</h4><p>'; 

				$erroMsg = '<div class="alert alert-block alert-danger fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
					<i class="fa fa-times"></i>
					</button>
					<h4>
					<i class="fa fa-times-rectangle"></i>
					Error Message!
					</h4><p>';  

				$warnMsg = '  <div class="alert alert-warning fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
					<i class="fa fa-times"></i>
					</button>
					<h4>
					<i class="fa fa-times-rectangle-o"></i>
					Warning Message!
					</h4><p>';

				$infMsg = '  <div class="alert alert-info fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
					<i class="fa fa-times"></i>
					</button>
					<h4>
					<i class="fa fa-info-circle"></i>
					Information Message!
					</h4><p>';

				$infoAdsMsg = '  <div class="alert alert-info fade in">
						<p><i class="fa fa-info-circle"></i> ';	

				$msgEnd =  '</p></div>'; 
				
				$sdo_tb_fi_grade = "<span class='wizGrade-footer'>70 - 100 = Excellent, 60 - 69 = V. Good, 50 - 59 = Good, 
				45 - 49 = Pass, 40 - 44 = Fair, 0 - 39 = Fail</span>"; 
				
				$sdo_tb_se_grade = "<span class='wizGrade-footer'>5 = Excellent, 4 = V. Good, 3 = Good, 2 = Pass, 1 = Fair, 
				0 = Fail</span>";

				$userNavPageError =  "<script type='text/javascript'> window.location.href = '$wizGrade404Dir';</script>; exit;"; 
			    
			    $formErrorMsg = "*Ooooooops Error, please all  form input must be fill in";	 
				
				$sdo_tb_footer = $infoAdsMsg.$rsAdsFooter.$msgEnd;	 
				
				/* report messages end */ 
				
				
				/* predefined array start */
				
				$modeLogPages = array (
				
						1=> 'admin.php', 'staff.php', 'schoolhead.php', 'libraian.php', 'bursary.php'
				
				);
				
				$validPicFormats = array("
						
						jpg", "png", "jpeg"
						
				);
				
				$validDocFormats = array(
				
						"doc", "docx", "pdf", "xls", "xlsx", "txt"
						
				); 
				
				$validRSformat = array(
				
						"xls"
						
				); 
				
				$validPicExt = array(
				
					'jpeg','jpg','png'
					
				); 
				
				$validPicType = array(
				
					'image/jpeg', 'image/jpg', 'image/png'
					
				); 
				
                $validPicFormats = array(
				
					"jpg", "png", "jpeg"
					
				); 
				
				$validDocExt = array(
				
					"doc", "docx", "pdf", "xls", "xlsx", "txt"
					
				); 
				
				$validDocType = array(
				
					'doc' => 'application/msword', 'pdf' => 'application/pdf', 'xls' => 'application/vnd.ms-excel', 'txt' => 'text/plain',
					'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
					'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' 
					
				); 	
				
                $validDocFormats = array(
				
					"doc", "docx", "pdf", "xls", "xlsx", "txt"
					
				);
				
				$validExcelExt = array(
				
					"xls" 
				); 
				
				$validExcelType = array(
				
					'xls' => 'application/vnd.ms-excel', 'xlsx' => 'application/octet-stream'  
					
				); 	
				
                $validExcelFormats = array(
				
					"xls" 
					
				);
				
				$validMediaType = array(
	
					'audio/mpeg',  'audio/ogg', 'audio/x-matroska', 'audio/x-wav', 'audio/x-ms-wma', 
					'video/mpeg', 'video/mp4', 'video/ogg', 'video/x-matroska', 'video/x-msvideo', 'video/x-flv', 'video/x-ms-wmv', 
					'video/quicktime'
					
				);
				
				$validMediaExt = array(
				
						'mp3', 'mpga', 'ogg', 'mka', 'wav', 'wma', 'mp2', 'mpeg', 'mp4', 'ogv', 'mkv', 'avi', 'flv', 'wmv', 'mov'
						
				);
				
                $validMediaFormats = array(
						
						"mp3", "mp4", "MP3", "MP4"
						
				);
				$validAudioFormats = array(
				
						'mp3', 'mpga', 'ogg', 'mka', 'wav', 'wma'
				
				);
				$validVideoFormats = array(
						
						'mp2', 'mpeg', 'mp4', 'ogv', 'mkv', 'avi', 'flv', 'wmv', 'mov'
						
				); 

                $countrylist = array (
				
						1=> "Afghanistan",
						"Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda",
						"Argentina", "Armenia",  "Australia", "Austria", "Azerbaijan", "Bahamas", 
						"Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin",
						"Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", 
						"Bulgaria", "Burkina Faso", "Burundi",  "Cambodia", "Cameroon", "Canada", 
						"Cape Verde", "Central African Republic", "Chad", "Chile", "China", "Colombia", 
						"Comoros", "Congo", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", 
						"Czech Republic", "Congo", "Denmark", "Djibouti", "Dominica", "Dominican Republic",
						"Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", 
						"Ethiopia", "Fiji", "Finland", "France",  "Gabon", "Gambia", "Georgia", "Germany",
						"Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", 
						"Haiti",  "Honduras", "Hungary",  "Iceland", "India", "Indonesia", "Iran", "Iraq", 
						"Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", 
						"Kenya", "Kiribati", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", 
						"Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg",
						"Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", 
						"Marshall Islands", "Mauritania", "Mauritius", "Mexico",  "Micronesia",
						"Moldova", "Monaco", "Mongolia", "Morocco", "Mozambique", "Myanmar", "Namibia", 
						"Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", 
						"North Korea", "Norway", "Oman", "Pakistan", "Palau", "Panama", 
						"Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", 
						"Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", 
						"Saint Vincent and the Grenadines", "Samoa", "San Marino", 
						"Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", 
						"Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", 
						"Somalia", "South Africa", "South Korea", "Spain", "Sri Lanka", "Sudan", 
						"Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan",
						"Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago",
						"Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", 
						"United Arab Emirates", "United Kingdom", "United States", "Uruguay", 
						"Uzbekistan", "Vanuatu", "Vatican", "Venezuela", "Vietnam", "Western Sahara",
						"Yemen", "Zambia", "Zimbabwe"

				);  
               
                $statelist = array (
				
						1=> 'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 
						'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'FCT', 'Gombe', 'Imo', 
						'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 
						'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba', 
						'Yobe', 'Zamfara', '****'

				);
								   
				$gender_list = array (
				
						1=> 'Female','Male'
				
				);

				$attendance_list = array (
				
						'Absent', 'Present', 'Present But Was Late', 'Holiday'
				
				);
				
				$promotionArr = array ( 
				
						1=> 'Promoted', 'Promoted On Trial', 'Not Promoted'
						
				);
				
				$wizGradeRunModeArr = array (
				
						1=> 'Session', 'Current'
						
				); 
				
				$admission_status = array ( 
				
						1 => 'UME' , 2 => 'SSCE', 3 => 'Direct Entry'

				);
				
				$bloodgr_list = array ( 
				
						1 => 'A+' , 2 => 'A-', 3 => 'B+', 4 => 'B-', 5 => 'AB+', 6 => 'AB-', 7 => 'O+', 8 => 'O-'

				);

				$genotype_list = array ( 
				
						1 => 'AA' , 2 => 'AS', 3 => 'SS'

				);

				$rs_status_list = array ( 
				
						1 => 'Editing' , 2 => 'Confirmation', 3 => 'Approved'

				);	
				
				$conduct_list = array (
				
						1=> '1', '2', '3', '4', '5'

				);								   

				$classType_list = array (
				
						1 => 'Science Class', 'Art Class', 'Commerce Class', 'General Class'

				 );				   
				
				$term_list = array ( 
				
						1 => 'First Term' , 2 => 'Second Term',  3 => 'Third Term' 
						
				);
				
				$termIntList = array ( 
				
						1 => '1st' , 2 => '2nd',  3 => '3rd'

				);				   

				$class_list = array (
				
						'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q'

                ); 
				
				$active_status_list = array (
				
						0 => 'No', 1 => 'Yes'

				);			   

                $mslist = array (
				
						1=> 'Single', 'Married', 'Divorced', 'Widowed'

                );

                $rslist = array (
				
						1=> 'Editing', 'Computed', 'Published'

                );

                $title_list = array (
				
						1=> 'Mr', 'Mrs', 'Miss', 'Dr', 'Engr', 'Prof', 

                );
				
                $certifylist = array ( 
				
						0 => 'FALSE', 1 => 'TRUE' 
						
				);
				
				$onOffArr = array (
				
						'Disenable', 1 => 'Enable' 
						
				);

                $gradelist = array (
				
						1=> 'A', 'B', 'C', 'D', 'E', 'F'

                );

                $school_list = array (
				
						1=> 'Nursery', 'Primary', 'Secondary'

                );
								   
				$schoolRegSuffArr = array (
				
						1=> '/NUR', '/PRI', '/SEC'

                );				   

				$nursery_list = array (
				
						1=> 'Nursery 1', 'Nursery 2', 'Nursery 3'

                );

				$primary_list = array (
				
						1=> 'Primary 1', 'Primary 2', 'Primary 3', 'Primary 4', 'Primary 5', 'Primary 6'

                );

				$secondary_list = array (
				
						1=> 'JSS 1', 'JSS 2', 'JSS 3', 'SSS 1', 'SSS 2', 'SSS 3'

                );
				
				$courseRawArr = array (
				
						1=> 'jemji', 'jiemj', 'jmeji'
						
				);
				
				$wizGradeDBArr = array (
				
						1=> "$wizGradeNurDB", "$wizGradePriDB", "$wizGradeSecDB", "$wizGradeDB"
						
				);
				
				$wizGradeBioArr = array (
				
						'Surname', 'First Name', 'Middle Name', 'Gender', 
						'Birthday', 'Blood Group', 'Genotype', 'Country', 'State/Province', 'City', 'Parmanent Address', 
						'Temporary Address', 'Student Phone No.', 'Student Email', 'Hostel ID', 'Transport ID', 'Sponsor Name', 
						'Sponsor Phone No.', 'Sponsor Occupation', 'Sponsor Address'
				);
				
				$alphabetArr = array(
				
						1=> 'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
						
				); 
								   
				$libraryStatusArr = array (
				
						'Unavailable', 'Available'
						
				);
				
				$libraryAppStatusArr = array (
				
						1=> 'Pending', 'Approved', 'Returned', 'Dis-approved'
						
				);
				
				$libraryTypeArr = array (
				
						1=> 'E - Book', 'Hard Copy'
						
				);
				
				$productStatusArr = array (
				
						'Out of Stock', 'In Stock'
						
				);
				
				$paymentMethodArr = array (
				
						1=> 'Cash', 'Bank Deposit', 'Cheque', 'Card'
						
				);
				
				$paymentStatus = array (
				
						'Part', 'Paid'
						
				); 
				
				$cardStatusArr = array (
				
						'Unuse', 'Used'
						
				); 
				
				$transactionArr = array ( 
				
						1 => 'Still Open',  'Paid',  'Sent',  'Delivered'
						
				);
				
				$rsTypeArr = array ( 
				
						1 => 'Computational  Result',  'Subject Comment Result'
						
				); 
				
				$ewallet_list = array ( 
				
						0 => "Don't Use" , 1 => "Termly" , 2 => "Annually"
						
				);
									  
				$currencySymbols = array(
				
						'AED' => 'United Arab Emirates dirham - د.إ',
						'AFN' => 'Afghan afghani - ؋',
						'ALL' => 'Albanian lek - L',
						'AMD' => 'Armenian dram - դր',
						'AOA' => 'Angolan kwanza - Kz',
						'ARS' => 'Argentine peso - $',
						'AUD' => 'Australian dollar - $',
						'AWG' => 'Aruban florin - ƒ',
						'AZN' => 'Azerbaijani manat - ',
						'BAM' => 'Bosnia and Herzegovina convertible mark - KM',
						'BBD' => 'Barbadian dollar - $',
						'BDT' => 'Bangladeshi taka - ৳',
						'BGN' => 'Bulgarian lev - лв',
						'BHD' => 'Bahraini dinar - .د.ب',
						'BIF' => 'Burundian franc - Fr',
						'BMD' => 'Bermudian dollar - $',
						'BND' => 'Brunei dollar - $',
						'BOB' => 'Bolivian boliviano - Bs',
						'BRL' => 'Brazilian real - R$',
						'BSD' => 'Bahamian dollar - $',
						'BTN' => 'Bhutanese ngultrum - Nu',
						'BWP' => 'Botswana pula - P',
						'BYR' => 'Belarusian ruble - Br',
						'BZD' => 'Belize dollar - $',
						'CAD' => 'Canadian dollar - $',
						'CDF' => 'Congolese franc - Fr',
						'CHF' => 'Swiss franc - Fr',
						'CLP' => 'Chilean peso - $',
						'CNY' => 'Chinese yuan - ¥',
						'COP' => 'Colombian peso - $',
						'CRC' => 'Costa Rican colón - ₡',
						'CUP' => 'Cuban convertible peso - $',
						'CVE' => 'Cape Verdean escudo - $',
						'CZK' => 'Czech koruna - Kč',
						'DJF' => 'Djiboutian franc - Fr',
						'DKK' => 'Danish krone - kr',
						'DOP' => 'Dominican peso - $',
						'DZD' => 'Algerian dinar - د.ج',
						'EGP' => 'Egyptian pound - ج.م',
						'ERN' => 'Eritrean nakfa - Nfk',
						'ETB' => 'Ethiopian birr - Br',
						'EUR' => 'Euro - €',
						'FJD' => 'Fijian dollar - $',
						'FKP' => 'Falkland Islands pound - £',
						'GBP' => 'British pound - £',
						'GEL' => 'Georgian lari - ლ',
						'GHS' => 'Ghana cedi - ₵',
						'GMD' => 'Gambian dalasi - D',
						'GNF' => 'Guinean franc - Fr',
						'GTQ' => 'Guatemalan quetzal - Q',
						'GYD' => 'Guyanese dollar - $',
						'HKD' => 'Hong Kong dollar - $',
						'HNL' => 'Honduran lempira - L',
						'HRK' => 'Croatian kuna - kn',
						'HTG' => 'Haitian gourde - G',
						'HUF' => 'Hungarian forint - Ft',
						'IDR' => 'Indonesian rupiah - Rp',
						'ILS' => 'Israeli new shekel - ₪',
						'IMP' => 'Manx pound - £',
						'INR' => 'Indian rupee - টকা',
						'IQD' => 'Iraqi dinar - ع.د',
						'IRR' => 'Iranian rial - ﷼',
						'ISK' => 'Icelandic króna - kr',
						'JEP' => 'Jersey pound - £',
						'JMD' => 'Jamaican dollar - $',
						'JOD' => 'Jordanian dinar - د.ا',
						'JPY' => 'Japanese yen - ¥',
						'KES' => 'Kenyan shilling - Sh',
						'KGS' => 'Kyrgyzstani som - лв',
						'KHR' => 'Cambodian riel - ៛',
						'KMF' => 'Comorian franc - Fr',
						'KPW' => 'North Korean won - ₩',
						'KRW' => 'South Korean won - ₩',
						'KWD' => 'Kuwaiti dinar - د.ك',
						'KYD' => 'Cayman Islands dollar - $',
						'KZT' => 'Kazakhstani tenge - ₸',
						'LAK' => 'Lao kip - ₭',
						'LBP' => 'Lebanese pound - ل.ل',
						'LKR' => 'Sri Lankan rupee - Rs',
						'LRD' => 'Liberian dollar - $',
						'LSL' => 'Lesotho loti - L',
						'LTL' => 'Lithuanian litas - Lt',
						'LVL' => 'Latvian lats - Ls',
						'LYD' => 'Libyan dinar - ل.د',
						'MAD' => 'Moroccan dirham - د.م.',
						'MDL' => 'Moldovan leu - L',
						'MGA' => 'Malagasy ariary - Ar',
						'MKD' => 'Macedonian denar - ден',
						'MMK' => 'Burmese kyat - Ks',
						'MNT' => 'Mongolian tögrög - ₮',
						'MOP' => 'Macanese pataca - P',
						'MRO' => 'Mauritanian ouguiya - UM',
						'MUR' => 'Mauritian rupee - Rs',
						'MVR' => 'Maldivian rufiyaa - .ރ',
						'MWK' => 'Malawian kwacha - MK',
						'MXN' => 'Mexican peso - $',
						'MYR' => 'Malaysian ringgit - MR',
						'MZN' => 'Mozambican metical - MT',
						'NAD' => 'Namibian dollar - $',
						'NGN' => 'Nigerian naira - ₦',
						'NIO' => 'Nicaraguan córdoba - C$',
						'NOK' => 'Norwegian krone - kr',
						'NPR' => 'Nepalese rupee - Rs',
						'NZD' => 'New Zealand dollar - $',
						'OMR' => 'Omani rial - ر.ع.',
						'PAB' => 'Panamanian balboa - B/.',
						'PEN' => 'Peruvian nuevo sol - S/.',
						'PGK' => 'Papua New Guinean kina - K',
						'PHP' => 'Philippine peso - ₱',
						'PKR' => 'Pakistani rupee - Rs',
						'PLN' => 'Polish złoty - zł',
						'PRB' => 'Transnistrian ruble - р.',
						'PYG' => 'Paraguayan guaraní - ₲',
						'QAR' => 'Qatari riyal - ر.ق',
						'RON' => 'Romanian leu - L',
						'RSD' => 'Serbian dinar - дин',
						'RUB' => 'Russian ruble - руб.',
						'RWF' => 'Rwandan franc - Fr',
						'SAR' => 'Saudi riyal - ر.س',
						'SBD' => 'Solomon Islands dollar - $',
						'SCR' => 'Seychellois rupee - Rs',
						'SDG' => 'Singapore dollar - $',
						'SEK' => 'Swedish krona - kr',
						'SGD' => 'Singapore dollar - $',
						'SHP' => 'Saint Helena pound - £',
						'SLL' => 'Sierra Leonean leone - Le',
						'SOS' => 'Somali shilling - Sh',
						'SRD' => 'Surinamese dollar - $',
						'SSP' => 'South Sudanese pound - £',
						'STD' => 'São Tomé and Príncipe dobra - Db',
						'SVC' => 'Salvadoran colón - ₡',
						'SYP' => 'Syrian pound - £',
						'SZL' => 'Swazi lilangeni - L',
						'THB' => 'Thai baht - ฿',
						'TJS' => 'Tajikistani somoni - SM',
						'TMT' => 'Turkmenistan manat - m',
						'TND' => 'Tunisian dinar - د.ت',
						'TOP' => 'Tongan paʻanga - T$',
						'TRY' => 'Turkish lira - ',
						'TTD' => 'Trinidad and Tobago dollar - $',
						'TWD' => 'New Taiwan dollar - $',
						'TZS' => 'Tanzanian shilling - Sh',
						'UAH' => 'Ukrainian hryvnia - ₴',
						'UGX' => 'Ugandan shilling - Sh',
						'USD' => 'United States dollar - $',
						'UYU' => 'Uruguayan peso - $',
						'UZS' => 'Uzbekistani som - лв',
						'VEF' => 'Venezuelan bolívar - Bs F',
						'VND' => 'Vietnamese đồng - ₫',
						'VUV' => 'Vanuatu vatu - Vt',
						'WST' => 'Samoan tālā - T',
						'XAF' => 'Central African CFA franc - Fr',
						'XCD' => 'East Caribbean dollar - $',
						'XOF' => 'West African CFA franc - Fr',
						'XPF' => 'CFP franc - Fr',
						'YER' => 'Yemeni rial - ﷼',
						'ZAR' => 'South African rand - R',
						'ZMW' => 'Zambian kwacha - ZK',
						'ZWL' => 'Zimbabwean dollar - $'
						
				);							  
						
				$currencySymbolsa = array(
				
						'AED' => '&#1583;.&#1573;', // ?
						'AFN' => '&#65;&#102;',
						'ALL' => '&#76;&#101;&#107;',
						'AMD' => 'դր',
						'ANG' => '&#402;',
						'AOA' => '&#75;&#122;', // ?
						'ARS' => '&#36;',
						'AUD' => '&#36;',
						'AWG' => '&#402;',
						'AZN' => '&#1084;&#1072;&#1085;',
						'BAM' => '&#75;&#77;',
						'BBD' => '&#36;',
						'BDT' => '&#2547;', // ?
						'BGN' => '&#1083;&#1074;',
						'BHD' => '.&#1583;.&#1576;', // ?
						'BIF' => '&#70;&#66;&#117;', // ?
						'BMD' => '&#36;',
						'BND' => '&#36;',
						'BOB' => '&#36;&#98;',
						'BRL' => '&#82;&#36;',
						'BSD' => '&#36;',
						'BTN' => '&#78;&#117;&#46;', // ?
						'BWP' => '&#80;',
						'BYR' => '&#112;&#46;',
						'BZD' => '&#66;&#90;&#36;',
						'CAD' => '&#36;',
						'CDF' => '&#70;&#67;',
						'CHF' => '&#67;&#72;&#70;',
						'CLF' => '', // ?
						'CLP' => '&#36;',
						'CNY' => '&#165;',
						'COP' => '&#36;',
						'CRC' => '&#8353;',
						'CUP' => '&#8396;',
						'CVE' => '&#36;', // ?
						'CZK' => '&#75;&#269;',
						'DJF' => '&#70;&#100;&#106;', // ?
						'DKK' => '&#107;&#114;',
						'DOP' => '&#82;&#68;&#36;',
						'DZD' => '&#1583;&#1580;', // ?
						'EGP' => '&#163;',
						'ETB' => '&#66;&#114;',
						'EUR' => '&#8364;',
						'FJD' => '&#36;',
						'FKP' => '&#163;',
						'GBP' => '&#163;',
						'GEL' => '&#4314;', // ?
						'GHS' => '&#162;',
						'GIP' => '&#163;',
						'GMD' => '&#68;', // ?
						'GNF' => '&#70;&#71;', // ?
						'GTQ' => '&#81;',
						'GYD' => '&#36;',
						'HKD' => '&#36;',
						'HNL' => '&#76;',
						'HRK' => '&#107;&#110;',
						'HTG' => '&#71;', // ?
						'HUF' => '&#70;&#116;',
						'IDR' => '&#82;&#112;',
						'ILS' => '&#8362;',
						'INR' => '&#8377;',
						'IQD' => '&#1593;.&#1583;', // ?
						'IRR' => '&#65020;',
						'ISK' => '&#107;&#114;',
						'JEP' => '&#163;',
						'JMD' => '&#74;&#36;',
						'JOD' => '&#74;&#68;', // ?
						'JPY' => '&#165;',
						'KES' => '&#75;&#83;&#104;', // ?
						'KGS' => '&#1083;&#1074;',
						'KHR' => '&#6107;',
						'KMF' => '&#67;&#70;', // ?
						'KPW' => '&#8361;',
						'KRW' => '&#8361;',
						'KWD' => '&#1583;.&#1603;', // ?
						'KYD' => '&#36;',
						'KZT' => '&#1083;&#1074;',
						'LAK' => '&#8365;',
						'LBP' => '&#163;',
						'LKR' => '&#8360;',
						'LRD' => '&#36;',
						'LSL' => '&#76;', // ?
						'LTL' => '&#76;&#116;',
						'LVL' => '&#76;&#115;',
						'LYD' => '&#1604;.&#1583;', // ?
						'MAD' => '&#1583;.&#1605;.', //?
						'MDL' => '&#76;',
						'MGA' => '&#65;&#114;', // ?
						'MKD' => '&#1076;&#1077;&#1085;',
						'MMK' => '&#75;',
						'MNT' => '&#8366;',
						'MOP' => '&#77;&#79;&#80;&#36;', // ?
						'MRO' => '&#85;&#77;', // ?
						'MUR' => '&#8360;', // ?
						'MVR' => '.&#1923;', // ?
						'MWK' => '&#77;&#75;',
						'MXN' => '&#36;',
						'MYR' => '&#82;&#77;',
						'MZN' => '&#77;&#84;',
						'NAD' => '&#36;',
						'NGN' => '&#8358;',
						'NIO' => '&#67;&#36;',
						'NOK' => '&#107;&#114;',
						'NPR' => '&#8360;',
						'NZD' => '&#36;',
						'OMR' => '&#65020;',
						'PAB' => '&#66;&#47;&#46;',
						'PEN' => '&#83;&#47;&#46;',
						'PGK' => '&#75;', // ?
						'PHP' => '&#8369;',
						'PKR' => '&#8360;',
						'PLN' => '&#122;&#322;',
						'PYG' => '&#71;&#115;',
						'QAR' => '&#65020;',
						'RON' => '&#108;&#101;&#105;',
						'RSD' => '&#1044;&#1080;&#1085;&#46;',
						'RUB' => '&#1088;&#1091;&#1073;',
						'RWF' => '&#1585;.&#1587;',
						'SAR' => '&#65020;',
						'SBD' => '&#36;',
						'SCR' => '&#8360;',
						'SDG' => '&#163;', // ?
						'SEK' => '&#107;&#114;',
						'SGD' => '&#36;',
						'SHP' => '&#163;',
						'SLL' => '&#76;&#101;', // ?
						'SOS' => '&#83;',
						'SRD' => '&#36;',
						'STD' => '&#68;&#98;', // ?
						'SVC' => '&#36;',
						'SYP' => '&#163;',
						'SZL' => '&#76;', // ?
						'THB' => '&#3647;',
						'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
						'TMT' => '&#109;',
						'TND' => '&#1583;.&#1578;',
						'TOP' => '&#84;&#36;',
						'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
						'TTD' => '&#36;',
						'TWD' => '&#78;&#84;&#36;',
						'TZS' => '',
						'UAH' => '&#8372;',
						'UGX' => '&#85;&#83;&#104;',
						'USD' => '&#36;',
						'UYU' => '&#36;&#85;',
						'UZS' => '&#1083;&#1074;',
						'VEF' => '&#66;&#115;',
						'VND' => '&#8363;',
						'VUV' => '&#86;&#84;',
						'WST' => '&#87;&#83;&#36;',
						'XAF' => '&#70;&#67;&#70;&#65;',
						'XCD' => '&#36;',
						'XDR' => '',
						'XOF' => '',
						'XPF' => '&#70;',
						'YER' => '&#65020;',
						'ZAR' => '&#82;',
						'ZMK' => '&#90;&#75;', // ?
						'ZWL' => '&#90;&#36;',
						
				); 

				$translatorArr = array(
				
						'af' => 'Afrikaans',
						'ak' => 'Akan',
						'sq' => 'Albanian',
						'am' => 'Amharic',
						'ar' => 'Arabic',
						'hy' => 'Armenian',
						'az' => 'Azerbaijani',
						'eu' => 'Basque',
						'be' => 'Belarusian',
						'bem' => 'Bemba',
						'bn' => 'Bengali',
						'bh' => 'Bihari',
						'xx-bork' => 'Bork, bork, bork!',
						'bs' => 'Bosnian',
						'br' => 'Breton',
						'bg' => 'Bulgarian',
						'km' => 'Cambodian',
						'ca' => 'Catalan',
						'chr' => 'Cherokee',
						'ny' => 'Chichewa',
						'zh-CN' => 'Chinese (Simplified)',
						'zh-TW' => 'Chinese (Traditional)',
						'co' => 'Corsican',
						'hr' => 'Croatian',
						'cs' => 'Czech',
						'da' => 'Danish',
						'nl' => 'Dutch',
						'xx-elmer' => 'Elmer Fudd',
						'en' => 'English',
						'eo' => 'Esperanto',
						'et' => 'Estonian',
						'ee' => 'Ewe',
						'fo' => 'Faroese',
						'tl' => 'Filipino',
						'fi' => 'Finnish',
						'fr' => 'French',
						'fy' => 'Frisian',
						'gaa' => 'Ga',
						'gl' => 'Galician',
						'ka' => 'Georgian',
						'de' => 'German',
						'el' => 'Greek',
						'gn' => 'Guarani',
						'gu' => 'Gujarati',
						'xx-hacker' => 'Hacker',
						'ht' => 'Haitian Creole',
						'ha' => 'Hausa',
						'haw' => 'Hawaiian',
						'iw' => 'Hebrew',
						'hi' => 'Hindi',
						'hu' => 'Hungarian',
						'is' => 'Icelandic',
						'ig' => 'Igbo',
						'id' => 'Indonesian',
						'ia' => 'Interlingua',
						'ga' => 'Irish',
						'it' => 'Italian',
						'ja' => 'Japanese',
						'jw' => 'Javanese',
						'kn' => 'Kannada',
						'kk' => 'Kazakh',
						'rw' => 'Kinyarwanda',
						'rn' => 'Kirundi',
						'xx-klingon' => 'Klingon',
						'kg' => 'Kongo',
						'ko' => 'Korean',
						'kri' => 'Krio (Sierra Leone)',
						'ku' => 'Kurdish',
						'ckb' => 'Kurdish (Soranî)',
						'ky' => 'Kyrgyz',
						'lo' => 'Laothian',
						'la' => 'Latin',
						'lv' => 'Latvian',
						'ln' => 'Lingala',
						'lt' => 'Lithuanian',
						'loz' => 'Lozi',
						'lg' => 'Luganda',
						'ach' => 'Luo',
						'mk' => 'Macedonian',
						'mg' => 'Malagasy',
						'ms' => 'Malay',
						'ml' => 'Malayalam',
						'mt' => 'Maltese',
						'mi' => 'Maori',
						'mr' => 'Marathi',
						'mfe' => 'Mauritian Creole',
						'mo' => 'Moldavian',
						'mn' => 'Mongolian',
						'sr-ME' => 'Montenegrin',
						'ne' => 'Nepali',
						'pcm' => 'Nigerian Pidgin',
						'nso' => 'Northern Sotho',
						'no' => 'Norwegian',
						'nn' => 'Norwegian (Nynorsk)',
						'oc' => 'Occitan',
						'or' => 'Oriya',
						'om' => 'Oromo',
						'ps' => 'Pashto',
						'fa' => 'Persian',
						'xx-pirate' => 'Pirate',
						'pl' => 'Polish',
						'pt-BR' => 'Portuguese (Brazil)',
						'pt-PT' => 'Portuguese (Portugal)',
						'pa' => 'Punjabi',
						'qu' => 'Quechua',
						'ro' => 'Romanian',
						'rm' => 'Romansh',
						'nyn' => 'Runyakitara',
						'ru' => 'Russian',
						'gd' => 'Scots Gaelic',
						'sr' => 'Serbian',
						'sh' => 'Serbo-Croatian',
						'st' => 'Sesotho',
						'tn' => 'Setswana',
						'crs' => 'Seychellois Creole',
						'sn' => 'Shona',
						'sd' => 'Sindhi',
						'si' => 'Sinhalese',
						'sk' => 'Slovak',
						'sl' => 'Slovenian',
						'so' => 'Somali',
						'es' => 'Spanish',
						'es-419' => 'Spanish (Latin American)',
						'su' => 'Sundanese',
						'sw' => 'Swahili',
						'sv' => 'Swedish',
						'tg' => 'Tajik',
						'ta' => 'Tamil',
						'tt' => 'Tatar',
						'te' => 'Telugu',
						'th' => 'Thai',
						'ti' => 'Tigrinya',
						'to' => 'Tonga',
						'lua' => 'Tshiluba',
						'tum' => 'Tumbuka',
						'tr' => 'Turkish',
						'tk' => 'Turkmen',
						'tw' => 'Twi',
						'ug' => 'Uighur',
						'uk' => 'Ukrainian',
						'ur' => 'Urdu',
						'uz' => 'Uzbek',
						'vi' => 'Vietnamese',
						'cy' => 'Welsh',
						'wo' => 'Wolof',
						'xh' => 'Xhosa',
						'yi' => 'Yiddish',
						'yo' => 'Yoruba',
						'zu' => 'Zulu'
						
				); 
				
				/* predefined array end */ 
				
				
				/* database table name start */ 
				
				$schoolSessionTB = $wizGradeDB.'.wizgrade_session';
				$studentOnlineRegTB = $wizGradeDB.'.wizgrade_registration';
				$adminAccessTB = $wizGradeDB.'.nkiruka_wizgrade_access';
				$wizGradeSchoolTB = $wizGradeDB.'.wizgrade_schoolinfo';
				$eWalletTB = $wizGradeDB.'.wizgrade_ewallet_nkiruka';
				$disabilityTB = $wizGradeDB.'.wizgrade_disability';
				$tRemarksTB = $wizGradeDB.'.wizgrade_remarks';
				$schoolClubTB = $wizGradeDB.'.wizgrade_club';
				$schoolClubPostTB = $wizGradeDB.'.wizgrade_cpost';
				$sportsTB = $wizGradeDB.'.wizgrade_sports';
				$staffTB = $wizGradeDB.'.wizgrade_teachers_record';	
				$staffRankingTB = $wizGradeDB.'.wizgrade_teacher_rank';
				$subjectsTB = $wizGradeDB.'.wizgrade_school_subjects';
				$teachersAssignSubTB = $wizGradeDB.'.wizgrade_assign_subject_teachers';
				$notificationTB = $wizGradeDB.'.wizgrade_events_notification';
				$routeTB = $wizGradeDB.'.wizgrade_route';
				$wizGradeSchLibConfig = $wizGradeDB.'.wizgrade_library_configs';
				$wizGradeSchLib = $wizGradeDB.'.wizgrade_library';
				$wizGradeLibApplyTB = $wizGradeDB.'.wizgrade_library_apply';
				$feeCategoryTB = $wizGradeDB.'.wizgrade_fee_category';
				$expenseCategoryTB = $wizGradeDB.'.wizgrade_expense_category';
				$bursaryConfigTB = $wizGradeDB.'.wizgrade_bursary';
				$wizGradeFeesTB = $wizGradeDB.'.wizgrade_fees';
				$wizGradeExpenseTB = $wizGradeDB.'.wizgrade_expenses';
				$productCategoryTB = $wizGradeDB.'.wizgrade_product_category';
				$wizGradeProductTB = $wizGradeDB.'.wizgrade_products';
				$wizGradeProductPicTB = $wizGradeDB.'.wizgrade_product_pic';
				$wizGradeOrderTB = $wizGradeDB.'.wizgrade_product_order';
				$wizGradeOrderSummTB = $wizGradeDB.'.wizgrade_order_summ';
				$wizGradeSMSTB = $wizGradeDB.'.wizgrade_sms'; 
				$wizGradePayGatewayTB = $wizGradeDB.'.wizgrade_payment_gateway';	
				$wizGradeBroadcastTB = $wizGradeDB.'.wizgrade_broadcast';	
				$wizGradeGradeTB = $wizGradeDB.'.wizgrade_grades';	
				
				$wizGradeCWallTB = $wizGradeDB.'.wizgrade_cw_forum'; 
				$wizGradeMailBoxTB = $wizGradeDB.'.wizgrade_cw_mailbox'; 
				$cWallNotificationTB = $wizGradeDB.'.wizgrade_cw_notification'; 
				$cWallLikesTB = $wizGradeDB.'.wizgrade_cw_likes_track'; 
				$cWallCommentTB = $wizGradeDB.'.wizgrade_cw_comments';
				$cWallPostTB = $wizGradeDB.'.wizgrade_cw_posts';
				$cWallTempUploadTB = $wizGradeDB.'.wizgrade_cw_temp_upload_pic'; 
				
				/* database table name end */ 			

				global $rseditingStage, $rscomputedStage, $rspublishStage;
				
				global $wizGradeDB, $wizGradeNurAbr, $wizGradePriAbr, $wizGradeSecAbr; 

				global $first_semester_code, $second_semester_code;
				
				global $foreal, $i_false;
				
				global $fiVal, $seVal, $thVal, $foVal, $fifVal, $sixVal, $sevVal, $eightVal, $nineVal, $tenVal;  
				
				global $cWallNumPerPage, $randChars, $randCharBig, $randNumber, $oneMB, $validPicExt, $validPicType; 	
				
				global $wizGradeTemplate, $wizGradeTemplateIN, $wizGradeDBConnectDir;
				
				global $wallPicLoader, $defualtLIBPic, $defaultShopPic, $wizGradePicDir, $wizGradeDefaultPic, $studentPic, $pic_path, 
				$teachersSignExt, $staffPicExt, $forumPicExt, $wizGradeCWallDir, $wizGradeAdminPicDir, $forumPicExtTem;
				
				global $nursery_list, $primary_list, $secondary_list, $title_list;
				
				global $succesMsg, $errorMsg, $warningMsg, $infoMsg, $sEnd, $iEnd, $eEnd, $wEnd,$msgEnd, $userNavPageError, $formErrorMsg;
				
				global $currencySymbols, $translatorArr;				

				global $adminAccessTB, $eWalletTB,  $disabilityTB, $tRemarksTB, $schoolClubTB, $schoolClubPostTB,
				$sportsTB, $wizGradeSchoolTB, $TeachersTb, $staffRankingTB, $schoolSessionTB, $teachersAssignSubTB,
				$studentOnlineRegTB, $notificationTB, $routeTB, $wizGradeSchLibConfig, $wizGradeSchLib, $wizGradeLibApplyTB, 
				$feeCategoryTB, $expenseCategoryTB, $bursaryConfigTB, $wizGradeFeesTB, $wizGradeExpenseTB, $productCategoryTB,
				$wizGradeProductTB, $wizGradeProductPicTB, $wizGradeOrderTB, $wizGradeOrderSummTB, $wizGradeSMSTB, $wizGradePayGatewayTB, 
				$wizGradeBroadcastTB; 

				global $cWallPostTB, $cWallCommentTB, $wizGradeCWallTB , $cWallLikesTB, 
				$cWallTempUploadTB, $wizGradeMailBoxTB, $cWallNotificationTB; 		
				
?>