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
	This script load and redirect school type
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
if(!session_id()){
    session_start();
}

			define('fobrain', 'igweze');  /* define a check for wrong access of file */
	
			require 'configINwizGrade.php';  /* load wizGrade configuration files */	 
			 
			unset($_SESSION['schoolConfigs']);						 
			$_SESSION['schoolConfigs'] = ""; 
	
	
			if($_REQUEST['schoolType'] == 'changeSchool') {

				$school = $_POST['schoolT'];
	        
				/* script validation */
				
				if ($school == "")   {

                    $msg_e = "* Ooooooooops Error, please select a school to login. Thanks";

				} else {
             
		   		    //$wizGradeDB = schoolTypeDB($school); /* school type database  */

					$schoolSettings = schoolTypeConfig($school, $seVal); /* school type configuration  */
               		
				    if ((!file_exists($schoolSettings)) || ($schoolSettings == "")){  /* check if file exits */

                		$msg_e = "* Ooooooooops Error, please select a school to login. Thanks";

               		}else{  /* redirect this user */ 

						$_SESSION['schoolConfigs'] = $schoolSettings;
						//$_SESSION['schoolOsinachiDB'] = $wizGradeDB;
						$_SESSION['school-type'] = $school;
				
						if(($admin_grade == $adminGrade) && ($admin_level == $adminGradeInt)){  /* check if admin */
							
							$headerLogin = $headerAdminPage;
							
						}elseif(($admin_grade == $schHeadGrade) && ($admin_level == $schHeadGradeInt)){  /* check if school head */
							
							$headerLogin = $headerSchHeadPage;
							
						}elseif(($admin_grade == $staffGrade) && ($admin_level == $staffGradeInt)){  /* check if school staff */
							
							$headerLogin = $headerStaffPage;
							
						}else{  /* log this user out */
							
							$headerLogin = $wizGradeLogOutDir; exit;
						}
						
						$msg_s = "*Success, Please Wait. Page Redirecting . . . . . ";
					
						echo $succesMsg.$msg_s.$sEnd ; 
						
						$_SESSION['wizGradePiloter'] =  $headerLogin;  /* redirect user */ 
					
						echo "<script type='text/javascript'>  window.location.href = '$headerLogin'; hidePageLoader();  /* hide page loader */ </script>";			
						exit;		
               
             		}


   	      		} 

			} 

			if ($msg_e) {

				echo $errorMsg.$msg_e.$eEnd; echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	
				echo $scrollUp; exit; 			
									
			}	
			
exit;
?>