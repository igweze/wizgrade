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
	This script load parent modules
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}
			   
			   
			define('wizGrade', 'igweze');  /* define a check for wrong access of file */

			$_SESSION['lastUserActivity'] = time(); 

			require 'configwizGrade.php';  /* load wizGrade configuration files */	

			switch ($_REQUEST['iemj']) {

				case 'shopping':

				require_once ($shoppingDir.'schoolShop.php');

				break;

				case 'myResult':

				require_once ($wizGradeStudentDir.'resultManager.php');

				break;

				case 'bestStudents':

				require_once ($wizGradeStudentDir.'searchBestStudent.php');

				break;

				case 'myProfile':

				require_once ($wizGradeStudentDir.'studentProfile.php');

				break;

				case 'rollCall':
				
				require_once ($wizGradeStudentDir.'rollCall.php');
				
				break;
				
				case 'rollCallList':
				
				require_once ($wizGradeStudentDir.'rollCallList.php');

				break;

				case 'examTimeTable':

				require_once ($wizGradeStudentDir.'timeTableManger.php');

				break;

				case 'schoolEvents':

				require_once ($wizGradeStudentDir.'eventsManager.php');

				break;	

				case 'wizGradeExam':

				require_once ($wizGradeStudentDir.'wizGradeExam.php');

				break;		
							 
				case 'wizGradeHomework':

				require_once ($wizGradeStudentDir.'wizGradeAssigment.php');

				break;

				case 'supportDesk':

				require_once ($wizGradeStudentDir.'supportDesk.php');

				break; 

				case 'payFee':

				require_once ($wizGradeStudentDir.'payFees.php');

				break;

				case 'feeHistory':

				require_once ($wizGradeStudentDir.'feesHistory.php');

				case 'rechargeEWallet':

				require_once ($wizGradeStudentDir.'rechargeEWallet.php');

				break;

				case 'viewEWallet':

				require_once ($wizGradeStudentDir.'viewEWallet.php');

				break; 

				case 'schoolLibrary':

				require_once ($wizGradeStudentDir.'schoolLibraryBook.php');

				break;

				case 'libraryHistory':

				require_once ($wizGradeStudentDir.'myLibraryHistory.php');

				break;

				case 'broadcast':

				require_once ($wizGradeStudentDir.'wizGradeBroadcast.php');

				break;	

				case 'lockScreen':

				require_once ($wizGradeStudentDir.'lockScreen.php');

				break;

				case 'changeAccess':

				require_once ($wizGradeStudentDir.'passwordManager.php');

				break;

				case 'wizGradeLogOuta':

				require_once ($wizGradeStudentDir.'logMeOutta.php');

				break;

				default:

				require_once ($wizGradeStudentDir .'index.php');

				break;

			}

			echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	exit;	

			
?>