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
	This script load admin, staff and school head modules
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}


				define('fobrain', 'igweze');  /* define a check for wrong access of file */
			   
				$_SESSION['lastADMINActivity'] = time(); 

				require 'configINwizGrade.php';  /* load wizGrade configuration files */	   

     			switch ($_REQUEST['iemj']) {

					
					case 'newRegistration':

     				require_once ($wizGradeAdminGlobalDir.'wizGradeOnlineReg.php');

     				break;
					
					case 'schoolEvents':

                    require_once ($wizGradeAdminGlobalDir.'schoolEvents.php');

                    break;
					
					case 'broadcast':

                    require_once ($wizGradeAdminGlobalDir.'wizGradeBroadcast.php');

                    break;
						 
					case 'newTeacherBio':

                    require_once ($wizGradeAdminDir.'newTeacherBio.php');

                    break;

					case 'teacherBioData':

                    require_once ($wizGradeAdminDir.'staffsBioHData.php');

                    break;

					case 'searchTeacher':

                    require_once ($wizGradeAdminDir.'searchStaffs.php');

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
					
                    case 'wallCompanion':

                    require_once ($wizGradeCWallIndDir);

                    break;

					case 'cardPins':

     				require_once ($wizGradeAdminDir.'cardPins.php');

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
					
					case 'showStaffBioH':

     				require_once ($wizGradeAdminGlobalDir.'showStaffHBio.php');

     				break;
    

     				case 'wizGradeLogOuta':

	 				require_once ($wizGradeAdminGlobalDir.'wizGradeLogOuta.php');
	 	
     				break;

     				default:

     				require_once ($wizGradeAdminGlobalDir.'wizGradeCommonDashboard.php');

     				break;

     		}
			
			echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	exit;


?>