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
	This script handle library configuration
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

            define('fobrain', 'igweze');  /* define a check for wrong access of file */

            require 'configwizGrade.php';  /* load wizGrade configuration files */
		 
			if (($_REQUEST['libData']) == 'libConfigs') {
			 
				$numApply =  preg_replace("/[^0-9']/", "", $_REQUEST['numApply']);
				$numBorrow =  preg_replace("/[^0-9']/", "", $_REQUEST['numBorrow']);
				$dateline =  preg_replace("/[^0-9']/", "", $_REQUEST['dateline']);

				/* script validation */ 
				
				if ($numApply == "")  {
					
					$msg_e = "* Oooooooooops error, please enter number of book/s a student can apply from school library. Thanks";
					
				}elseif ($numBorrow == "")  {
					
					$msg_e = "* Oooooooooops error, please enter number of book/s a student can borrow from school library. Thanks";
						
				}elseif ($dateline == "")  {
					
					$msg_e = "* Oooooooooops error, please enter school library book dateline in Days. Thanks";
						
				}else {  /* select information */

					try {
			
						$datelineM = $dateline.' DAY';

						$ebele_mark = "UPDATE $wizGradeSchLibConfig SET
					 
										book_no_apply = :book_no_apply,
										book_no_borrow = :book_no_borrow,
										book_dateline = :book_dateline
										
										WHERE c_id = :c_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
						
						$igweze_prep->bindValue(':book_no_apply', $numApply);
						$igweze_prep->bindValue(':book_no_borrow', $numBorrow);
						$igweze_prep->bindValue(':book_dateline', $datelineM);
						$igweze_prep->bindValue(':c_id', $fiVal);
						
						if ($igweze_prep->execute()) {  /* if sucessfully */ 
		
								$scriptSlide =  "$('#frmlibConfiguration').slideUp(2000);";
								$msg_s = "School Library Configuration was Successfully Saved.";
		
								
						}else {  /* display error */ 
		
								$msg_e = "<span>Oooooooooops, an error has occur
								while trying to save School Library Configuration, Please try again</span>";	
						
						} 

					}catch(PDOException $e) {
			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 

				} 
        
			}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			} 
			
			if ($msg_s) {
	
				echo "<script type='text/javascript'>  $scriptSlide $('#settingsLoader').fadeOut(3000); </script>";
				echo $succesMsg.$msg_s.$sEnd ; echo $scrollUp; exit; 				
										
			}	
	
	
			if ($msg_e) {
				
				echo "<script type='text/javascript'>  $('#settingsLoader').fadeOut(3000); </script>";
				echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit;	 
										
			}	
			
exit;
?>