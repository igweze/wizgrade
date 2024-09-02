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
	This script load application configurations
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
				
			require_once '../sources/functions/configDir.php';  /* include configuration script */ 

			if ( (empty($_SESSION['schoolConfigs']))
			) {	 /* user validation */  

				//header("Location: $wizGradeLogOutDir");exit;
				echo "<script type='text/javascript'> window.location.href = '$wizGradeLogOutDir';</script>"; exit; 

			}

			/* script sessions start */
			
			$_SESSION['lastUserActivity'] = time(); 
			$regNum = $_SESSION['studetReg']; 			   
			$regID = $_SESSION['studetRegID'];  
			$student_pic = $_SESSION['studetPic'];
			$sessionID = $_SESSION['sessionID']; 
			$stuFullName = $_SESSION['fullname'];   
			$lname =  $_SESSION['lname']; 
			$studentPic = $_SESSION['studetPic'];
			$picPath  = $_SESSION['picPath'];                  
			$studentName = $_SESSION['fullname']; 
			$njidekaBouncer = $_SESSION['fiBouncer']; 
			$nkirukaBouncer = $_SESSION['seBouncer'];
			$njidekaBouncerRand = $_SESSION['fiBouncerRand'];
			$nkirukaBouncerRand = $_SESSION['seBouncerRand'];
			$_SESSION['accessGrade'] = "";
			$hideWallCom = '1987';				
			$nameFull = $stuFullName;	
			
			/* script sessions end */

			if($studentName == ''){$studentName = $regNum;} 

			$checkfiBouncerBabe = 'IAmzininGlyLoveNjiDeKa'.$regID.'_'.$njidekaBouncerRand.'_OutStanding_MuM_In_the_GloBE';

			$checkseBouncerBabe = 'IAmzininGLoveNKiruKa'.$regNum.'_'.$nkirukaBouncerRand.'_OutStanding_Wife_In_the_WorlD'; 

			if ( (!isset($_SESSION['fiBouncer']))
			|| ($_SESSION['fiBouncer'] != $checkfiBouncerBabe)
			|| (!isset($_SESSION['seBouncer']))
			|| ($_SESSION['seBouncer'] != $checkseBouncerBabe)

			) {	 /* user validation */   

				header("Location: $wizGradeLogOutDir");exit;
				/*echo "<script type='text/javascript'> window.location.href = '$wizGradeLogOutDir';</script>"; exit; */

			}

			require $wizGradeDBConnectDir;  /* load connection string */
			require_once $wizGradeFunctionDir;  /* load script functions */
			
			if (isset($_SESSION['schoolConfigs'])){	 /* user validation */   
				
					require_once ($_SESSION['schoolConfigs']); 
					
			}else { 
			
					header("Location: $wizGradeLogOutDir");exit; 
					
			}

			try {

				$schoolDataArray = wizGradeSchool($conn);  /* school configuration setup array  */

				$schoolNameTop = $schoolDataArray[0]['school_name'];
				$schoolAddressTop = $schoolDataArray[0]['school_address'];
				$school_logo = $schoolDataArray[0]['school_logo'];
				$schoolTheme = $schoolDataArray[0]['school_theme'];
				$schoolHead = $schoolDataArray[0]['school_head'];
				$schoolCutoff = $schoolDataArray[0]['school_cutoff'];
				$subjectCutoff = $schoolDataArray[0]['school_sub_cutoff'];
				$ewalletCheck = $schoolDataArray[0]['ewallet'];

				$schoolThemeC = $schoolTheme;

				$wizGradeTheme = wizGradeThemeColor($schoolTheme, $wizGradeTemplate); /* wizGrade theme  */

				list ($cssTheme, $cssThemeReset) = explode ('@$$@', $wizGradeTheme);

				list ($nurseryHead, $primaryHead, $secondaryHead) = explode (",", $schoolHead);	

				if($schoolID == $fiVal) { $schoolHead = $nurseryHead; }
				elseif($schoolID == $seVal) { $schoolHead = $primaryHead; }
				elseif($schoolID == $thVal) { $schoolHead = $secondaryHead; }
				else { $schoolHead = ""; }

				$burConfigsArray = bursaryConfigsArrays($conn);  /* school bursary configuration  */

				$countryCurrCode = $burConfigsArray[0]['currency'];
				$bankDetails = htmlspecialchars_decode($burConfigsArray[0]['bank']);
				$bankDetails = nl2br($bankDetails);

				$curVal = $currencySymbols[$countryCurrCode];
						
				list($countryCur, $symbol) = explode("-", $curVal);
				$curSymbol = trim($symbol);

				$sch_logo = $sch_logo_path.$school_logo;

				if ((is_null($school_logo)) || ($school_logo == '') || (!file_exists($sch_logo))) {  /* check if picture exists */

					$sch_logo = $wizGradeDefaultPic;

				}

				$studentPicture = studentPicture($conn, $regNum);  /* students picture */ 	
				
				$gatewayPaymentDataArr = gatewayPaymentData($conn);  /* payment gateways array  */

				$paypalID = trim($gatewayPaymentDataArr[$fiVal]["gateKey"]); 
				$twoCheckoutAccKey = trim($gatewayPaymentDataArr[$seVal]["gateKey"]); 
				$payStackPublicKey = trim($gatewayPaymentDataArr[$thVal]["gateKey"]);
				$voguePayID = trim($gatewayPaymentDataArr[$foVal]["gateKey"]);  

				$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
				$exam_status = $examArray[0]['status'];	
				$rsType = $examArray[0]['rsType'];					

			}catch(PDOException $e) {

				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

			} 

			global $regNum, $regID, $i_db_ext, $wizGradeDBConnectDir, $studentName, $studentPic, $pic_path,  $picPath;			

?>