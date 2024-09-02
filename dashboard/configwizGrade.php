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

					header("Location: $wizGradeLogOutDir");
					echo "<script type='text/javascript'> window.location.href = '$wizGradeLogOutDir';</script>"; exit;  
               
				}

				/* script sessions start */
				
				$_SESSION['lastADMINActivity'] = time(); 				
				$schoolExt = $_SESSION['school-type'];
				$adminID = $_SESSION['adminID'];
				$adminUser = $_SESSION['adminUser'];
				$admin_grade = $_SESSION['accessGrade'];
				$admin_level	 =	$_SESSION['accessLevel'];
				$admin_cw_rank = $_SESSION['wallComRank'];
				$njidekaBouncer = $_SESSION['ADmiNfiBouncer'];     
				$nkirukaBouncer = $_SESSION['ADmiNseBouncer'];
				$njidekaBouncerRand = $_SESSION['ADmiNfiBouncerRand'];     
				$nkirukaBouncerRand = $_SESSION['ADmiNseBouncerRand'];
				$regNum = $_SESSION['studetReg'];

				if($_SESSION['wizGradeRunMode'] != ""){
					$wizGradeMode = $_SESSION['wizGradeRunMode'] ;
				}else{
					$wizGradeMode = $seVal; $_SESSION['wizGradeRunMode'] = $seVal;
				}	
				/* script sessions end */
				
				$checkfiBouncerBabe = 'IFabuLOUSlyLoveNJidekaNCHukWUM'.
				$admin_level.'_'.$njidekaBouncerRand.'_Fabulous_Dad_In_the_GloBE';
				$checkseBouncerBabe = 'IFabuLOUSlyLoveNKiruKaNCHukWUM'.
				$admin_grade.'_'.$nkirukaBouncerRand.'_FabUloUS_Wife_In_the_WorlD';
				 

				if ( (!isset($_SESSION['ADmiNfiBouncer']))
				|| ($_SESSION['ADmiNfiBouncer'] != $checkfiBouncerBabe)
				|| (!isset($_SESSION['ADmiNseBouncer']))
				|| ($_SESSION['ADmiNseBouncer'] != $checkseBouncerBabe)

				) {	 /* user validation */

					header("Location: $wizGradeLogOutDir");
					echo "<script type='text/javascript'> window.location.href = '$wizGradeLogOutDir';</script>"; exit; 

				}


				$admin_status = $admin_grade;
				global $admin_grade; global $admin_level; global $picPath; global $adminID; global $adminFullName; 
				global $adminPic; 
				global $admin_cw_rank; global $regNum;
				global $schoolExt;	

				//if($wizGradeMode == ""){$wizGradeMode = $seVal; $_SESSION['wizGradeRunMode'] = $seVal;} 

				require $wizGradeDBConnectDir;
				require_once ($wizGradeFunctionDir);
				if (isset($_SESSION['schoolConfigs'])){  require_once ($_SESSION['schoolConfigs']); }

				  
				$schoolTypeSD = schoolType($schoolExt);  /* return school type */
				global $schoolTypeSD; 

				try {

					$schoolDataArray = wizGradeSchool($conn);  /* school configuration setup array  */
					$currentRSess = currentSessionInfo($conn);  /* current school session information  */

					list ($curRSessID, $rSessFI) = explode ("@$@", $currentRSess);

					$rSessSE = ($rSessFI + $fiVal);

					$currentSessTop = "$rSessFI - $rSessSE";

					$schoolNameTop = $schoolDataArray[0]['school_name'];
					$schoolAddressTop = $schoolDataArray[0]['school_address'];
					$schoolRegPrefix = $schoolDataArray[0]['reg_prefix'];
					$school_logo = $schoolDataArray[0]['school_logo'];
					$schoolTheme = $schoolDataArray[0]['school_theme'];
					$schoolHead = $schoolDataArray[0]['school_head'];
					$schoolCutoff = $schoolDataArray[0]['school_cutoff'];
					$subjectCutoff = $schoolDataArray[0]['school_sub_cutoff'];
					global $schoolCutoff;

					$schoolThemeC = $schoolTheme;

					$wizGradeTheme = wizGradeThemeColor($schoolTheme, $wizGradeTemplate); /* wizGrade theme  */

					list ($cssTheme, $cssThemeReset) = explode ('@$$@', $wizGradeTheme);

					list ($nurseryHead, $primaryHead, $secondaryHead) = explode (",", $schoolHead);	

					if($schoolID == $fiVal) { $schoolHead = $nurseryHead; }
					elseif($schoolID == $seVal) { $schoolHead = $primaryHead; }
					elseif($schoolID == $thVal) { $schoolHead = $secondaryHead; }
					else { $schoolHead = ""; }


					$sch_logo = $sch_logo_path.$school_logo;

					if ((is_null($school_logo)) || ($school_logo == '') || (!file_exists($sch_logo))) {  /* check if picture exists */

						$sch_logo = $wizGradeDefaultPic;

					} 

				}catch(PDOException $e) {

				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

				}

?>