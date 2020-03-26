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
	This script handle bursary configuration
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

			define('wizGrade', 'igweze');  /* define a check for wrong access of file */

			require 'configwizGrade.php';  /* load wizGrade configuration files */  
		 
			if (($_REQUEST['libData']) == 'burConfigs') {
			 
				$currency =  preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['currency']);
				$bank =  $_REQUEST['bank'];
				
				$bank = strip_tags($bank); 
				
				if ($currency == "")  {
					
					$msg_e = "* Oooooooooops error, please select currency to be use";
					
				}else {  /*  update information */ 

					try {
						 
					   $bank = str_replace('<br />', "\n", $bank);
					   $bank = htmlspecialchars($bank);
			
						

						$ebele_mark = "UPDATE $bursaryConfigTB SET
					 
										currency = :currency,
										bank = :bank
										
										WHERE b_id = :b_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);									
						$igweze_prep->bindValue(':currency', $currency);
						$igweze_prep->bindValue(':bank', $bank);
						$igweze_prep->bindValue(':b_id', $fiVal); 
						
						if ($igweze_prep->execute()) {  /* if sucessfully */ 
		
							$scriptSlide =  "$('#frmburConfiguration').slideUp(2000);";
							$msg_s = "School Bursary Configuration was Successfully Saved.";		
								
						}else {	 /* display error */
						
							$msg_e = "<span>Oooooooooops, an error has occur
							while trying to save School Bursary Configuration, Please try again</span>"; 
						
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