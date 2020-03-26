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
	This script load libranian modules
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}


               define('wizGrade', 'igweze');  /* define a check for wrong access of file */
			   
			   $_SESSION['lastADMINActivity'] = time(); 

               require 'configwizGrade.php';  /* load wizGrade configuration files */

     			switch ($_REQUEST['iemj']) {

     					 					
					case 'lib-config':

                    require_once ($wizGradeLibraryDir.'library-configurations.php');

                    break;
					
					case 'upload-books':

                    require_once ($wizGradeLibraryDir.'book-library-uploader.php');

                    break;
					
					case 'manage-library':

                    require_once ($wizGradeLibraryDir.'show-library-books.php');

                    break;

					case 'pending-apps':

                    require_once ($wizGradeLibraryDir.'pending-applications.php');

                    break;
					
					case 'approved-apps':

                    require_once ($wizGradeLibraryDir.'approved-lib-books.php');

                    break;

	 			    case 'lockScreen':

                    require_once ($wizGradeAdminGlobalDir.'wizGradeScreenLocka.php');

                    break;

     				case 'editPass':

     				require_once ($wizGradeAdminGlobalDir.'passwordManager.php');

     				break;
					
					case 'myProfile':

					require_once ($wizGradeAdminGlobalDir.'showStaffBio.php');

     				break;
     
     				case 'wizGradeLogOuta':

	 				require_once ($wizGradeAdminGlobalDir.'wizGradeLogOut.php');
	 	
     				break;

     				default:
					
     				require_once ($wizGradeLibraryDir.'index.php');

     				break;

     		}
			
			echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	exit;


?>