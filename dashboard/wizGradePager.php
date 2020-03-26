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
	This script load admin, staff and school head modules
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}


               define('wizGrade', 'igweze');  /* define a check for wrong access of file */
			   
			   $_SESSION['lastADMINActivity'] = time(); 

               require 'configwizGrade.php';  /* load wizGrade configuration files */

     			switch ($_REQUEST['iemj']) { 
					
					case 'subjects-1':

     				require_once ($wizGradeAdminDir.'wizGradeClassSubjects.php');

     				break;
					
					case 'subjects-2':

     				require_once ($wizGradeAdminDir.'wizGradeClassSubjects.php');

     				break;
					
					case 'subjects-3':

     				require_once ($wizGradeAdminDir.'wizGradeClassSubjects.php');

     				break;
					
					case 'subjects-4':

     				require_once ($wizGradeAdminDir.'wizGradeClassSubjects.php');

     				break;
					
					case 'subjects-5':

     				require_once ($wizGradeAdminDir.'wizGradeClassSubjects.php');

     				break;
					
					case 'subjects-6':

     				require_once ($wizGradeAdminDir.'wizGradeClassSubjects.php');

     				break;
					
	 				case 'homePage':

			 		require_once ($wizGradeAdminGlobalDir.'wizGradeHPage.php');

     				break;
					
	 				case 'manualRS':

     				require_once ($wizGradeAdminGlobalDir.'manualRSADD.php');

     				break;

	 				case 'autoRSManager':

     				require_once ($wizGradeAdminGlobalDir.'autoRSADD.php');

     				break;
					
					case 'autoSubComm':

     				require_once ($wizGradeAdminGlobalDir.'autoSubComment.php');

     				break;
				
					case 'registerStudent':

			 		require_once ($wizGradeAdminDir.'newStuBioData.php');

     				break;
					
					case 'bulkReg':

			 		require_once ($wizGradeAdminDir.'autoReg.php');

     				break;

					case 'searchBioClass':

			 		require_once ($wizGradeAdminGlobalDir.'searchBioClass.php');

     				break;

					case 'searchClassBio':

			 		require_once ($wizGradeFormTeacherDir.'searchClassBio.php');

     				break;

					case 'searchByName':

			 		require_once ($wizGradeAdminGlobalDir.'searchByName.php');

     				break;
					
					case 'rsTimeFrame':

                    require_once ($wizGradeAdminDir.'rsTimeFrame.php');

                    break;
					
					case 'exportResult':
					$blankStatus = false;
			 		require_once ($wizGradeAdminGlobalDir.'loadExportRS.php');

     				break;

					case 'exportSubComm':
					$blankStatus = true;
			 		require_once ($wizGradeAdminGlobalDir.'loadExportRS.php');

     				break;
					
					case 'autoScan':
					$blankStatus = true;
			 		require_once ($wizGradeAdminGlobalDir.'autoScanExportRS.php');

     				break;

					case 'cRS':

			 		require_once ($wizGradeAdminGlobalDir.'searchClassRS.php');

     				break;

					case 'classRS':

			 		require_once ($wizGradeFormTeacherDir.'searchRS.php');

     				break;
					
					case 'rollCall':

     				require_once ($wizGradeAdminGlobalDir.'classRollCall.php');

     				break;

					case 'transcripts':

			 		require_once ($wizGradeAdminGlobalDir.'studentTranscript.php');

     				break;
					
					case 'classPromotion':

			 		require_once ($wizGradeAdminGlobalDir.'classPromotion.php');

     				break;

					case 'timeTable':

                    require_once ($wizGradeAdminGlobalDir.'timeTable.php');

                    break;
					
					case 'schoolEvents':

                    require_once ($wizGradeAdminGlobalDir.'schoolEvents.php');

                    break;
					
					case 'broadcast':

                    require_once ($wizGradeAdminGlobalDir.'wizGradeBroadcast.php');

                    break;

					case 'setExam':

                    require_once ($wizGradeAdminGlobalDir.'wizGradeExam.php');

                    break;
					
					case 'manageExam':

                    require_once ($wizGradeAdminGlobalDir.'wizGradeExamInfo.php');

                    break;
					
					case 'setAssign':

                    require_once ($wizGradeAdminGlobalDir.'wizGradeAssign.php');

                    break;
					
					case 'manageAssign':

                    require_once ($wizGradeAdminGlobalDir.'wizGradeAssignInfo.php');

                    break;					
					
					case 'assignClass':

                    require_once ($wizGradeAdminDir.'assignClass.php');

                    break;
					
					case 'assignSubject':

                    require_once ($wizGradeAdminDir.'assignSubject.php');

                    break;

					case 'smsStudent':

					require_once ($wizGradeAdminGlobalDir.'studentSMSPanel.php');

                    break;
					
					case 'schoolHostel':

					require_once ($wizGradeAdminDir.'schoolHostel.php');

                    break;
					
					case 'schoolRoute':

					require_once ($wizGradeAdminDir.'schoolRoute.php');

                    break;					
					
					case 'newRegistration':

     				require_once ($wizGradeAdminGlobalDir.'wizGradeOnlineReg.php');

     				break;					
						 
					case 'newTeacherBio':

                    require_once ($wizGradeAdminDir.'newTeacherBio.php');

                    break;

					case 'teacherBioData':

                    require_once ($wizGradeAdminDir.'staffsBioData.php');

                    break;

					case 'searchTeacher':

                    require_once ($wizGradeAdminDir.'searchStaff.php');

                    break;					

					case 'smsStaff':

					require_once ($wizGradeAdminDir.'staffSMSPanel.php');

                    break;
					
					case 'smsConfig':

					require_once ($wizGradeAdminDir.'wizGradeSMS.php');

                    break;
					
					case 'payGateway':

					require_once ($wizGradeAdminDir.'paymentGateway.php');

                    break;
					
					case 'scoreGrade':

					require_once ($wizGradeAdminDir.'wizGradeGrade.php');

                    break;

					case 'cardPins':

     				require_once ($wizGradeAdminDir.'cardPins.php');

     				break;
					
                    case 'wallCompanion':

                    require_once ($wizGradeCWallIndDir);

                    break;
						 
	 			    case 'myInbox':

                    require_once ($wizGradeCInboxIndDir);

                    break;
                   

	 			    case 'lockScreen':

                    require_once ($wizGradeAdminGlobalDir.'wizGradeScreenLocker.php');

                    break;

     				case 'editAccess':

     				require_once ($wizGradeAdminDir.'accessManager.php');

     				break;


     				case 'editPass':

     				require_once ($wizGradeAdminGlobalDir.'passwordManager.php');

     				break;

					case 'showAdminBio':

     				require_once ($wizGradeAdminDir.'showAdminBio.php');

     				break;
					
					case 'myBioData':

     				require_once ($wizGradeAdminGlobalDir.'showStaffBio.php');

     				break;

     				case 'wizGradeLogOuta':

	 				require_once ($wizGradeAdminGlobalDir.'wizGradeLogOuta.php');
	 	
     				break;

     				default:

     				require_once ($wizGradeAdminGlobalDir.'loadDashBoard.php');

     				break;
					
					
					
     		}
			
			echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	exit;


?>