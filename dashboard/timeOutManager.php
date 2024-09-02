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
	This script handle screen lock validation
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     		define('fobrain', 'igweze');  /* define a check for wrong access of file */

         	require 'configINwizGrade.php';  /* load wizGrade configuration files */	
		
			if (($_REQUEST['timeOutType'] == 'wizGradeTimeOut')){

				$i_password = $_REQUEST['password'];

				$i_password = strip_tags($i_password);
				 
				/* script validation */ 
				
				if(($admin_grade == $adminGrade) && ($admin_level == $adminGradeInt)) {  /* check if school admin */

					$checkDetail =  wizGradeAdminPassData($conn, $_SESSION['adminUser']);  /* school admin password details */
				 
					list ($adminID, $checkedPass, $adminName) =  explode ("@(.$*S*$.)@", $checkDetail);
					
					if (password_verify($i_password, $checkedPass)) { /* if sucessfully login user */  

						$msg_s = "Login was Successfully. Please wait . . . .";
						echo $succesMsg.$msg_s.$sEnd ;
						
						unset($_SESSION['lockAdminScreen']);
						unset($_SESSION['lastADMINActivity']);
						unset($_SESSION['lockMyfScreen']);
						
						
						echo "<script type='text/javascript'>  
						setTimeout(function() {
								$('.pageRefresh').trigger('click');
							},1500); 
						  </script>"; exit;

					}else{  /* display error */
				 
						$msg_e = "* Error, Please enter your correct password!";
						echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 			
				 
				 
					}
				
				}else{					 

					$checkDetail =  wizGradeStaffPassData($conn, $_SESSION['adminUser']);  /* school staffs/teachers password details */
				 
					list ($tID, $staffUser, $checkedPass, $staffName, $staffRank, $staffGra) = 
						explode ("@(.$*S*$.)@", $checkDetail);
				 
					if (password_verify($i_password, $checkedPass)) { /* if sucessfully login user */  

						$msg_s = "Login was Successfully. Please wait . . . .";
						echo $succesMsg.$msg_s.$sEnd ;
						
						unset($_SESSION['lockAdminScreen']);
						unset($_SESSION['lastADMINActivity']);
						unset($_SESSION['lockMyfScreen']);
						
						
						echo "<script type='text/javascript'>  
						setTimeout(function() {
								$('.pageRefresh').trigger('click');
							},1500); 
						  </script>"; exit;

					}else{  /* display error */
				 
						$msg_e = "* Error, Please enter your correct password!";
						echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 	 
				 
					} 
				
				}  
		 
		 	}
		 
exit;
?>