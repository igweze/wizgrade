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
	This script load bursary modules
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

               define('fobrain', 'igweze');  /* define a check for wrong access of file */
			   
			   $_SESSION['lastADMINActivity'] = time(); 

               require 'configwizGrade.php';  /* load wizGrade configuration files */

     			switch ($_REQUEST['iemj']) {
     					 					
					case 'feeCategory':

                    require_once ($bursaryDir.'feeCategory.php');

                    break;
					
					case 'expenseCategory':

                    require_once ($bursaryDir.'expenseCategory.php');

                    break;
					
					case 'fees':

                    require_once ($bursaryDir.'wizGradeFees.php');

                    break;

					case 'bursConfig':

                    require_once ($bursaryDir.'bursConfig.php');

                    break;
					
					case 'expenses':

                    require_once ($bursaryDir.'wizGradeExpenses.php');

                    break;

	 			    case 'productCate':

                    require_once ($bursaryDir.'productCategory.php');

                    break;
					
					case 'products':

                    require_once ($bursaryDir.'wizGradeProducts.php');

                    break;
					
					case 'orders':

                    require_once ($bursaryDir.'wizGradeOrders.php');

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
					
     				require_once ($bursaryDir.'index.php');

     				break;

     		}
			
			echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	exit;


?>