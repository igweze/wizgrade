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
	This script remove online registration information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configINwizGrade.php';  /* load wizGrade configuration files */
		 
		 
		 if ($_REQUEST['newBioData'] == 'remove-registration') {


				$studentID = $_REQUEST['studentID'];
				
				/* script validation */

				if ($studentID == "")  {
         		
					$msg_e .= "* Oooooooops Error, could not find new student registration infomation. It might have been
					deleted. Thanks";
	   			
				}else {  /*  remove information */ 

		 			try { 
					
						$applyPic = onlineRegPicture($conn, $studentID);  /* online registration picture */
						
						$applyPicture = $applyPSrc.$applyPic;
					  
						if (($applyPic != '') && (file_exists($applyPicture))){  
							  
							  unlink($applyPicture);  /* removeon picture */		
							  
						} 
						
						removeRegistraion($conn, $studentID);  /* remove student online registration */
						$totalRegis = registraionCounter($conn);  /* student online registration counter */	

						$msg_s = 'Student Online information was Successfully removed';
					

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}          		
        	
				}
			
			}else{
			
					echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}


			
			if ($msg_s) {

				echo $succesMsg.$msg_s.$sEnd ; 

$script =<<<IGWEZE
				<script type='text/javascript'>  
				
				$('#newRegRow-$studentID').fadeOut(1000); 
				$('.newRegDiv').fadeOut(2000); 
				$('.registration-loader').fadeOut(4000); 
				$('#totalRegsCount').html($totalRegis);
				
				</script>;
IGWEZE;
			
				echo $script;  exit;
									
			}	


			if ($msg_e) {

				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> $('.registration-loader').fadeOut(4000);  </script>";
				exit;
									
			}	
			
exit;
?>