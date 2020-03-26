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
	This script handle e-wallet recharge
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configwizGrade.php';  /* load wizGrade configuration files */	 


			if ($_REQUEST['eWalletData'] == 'recharge') {

        		$level = $_REQUEST['level'];
				$card_pin =   preg_replace("/[^0-9]/", "", $_REQUEST['card_pin']);
				$term =   preg_replace("/[^0-9]/", "", $_REQUEST['term']);
				$rechargeTime = strtotime(date("Y-m-d H:i:s"));


				try {
					
					$cardCheckData = eWalletCheckRecharge($conn, $regNum, $regID, $level, $term);  /* validate card pin e - wallet information */
					$cardData = eWalletwizGrade($conn, $card_pin);  /* card pin e - wallet information */	
					
					list ($cardCID, $cardPin, $cardRTime, $cardCS) = explode (":@@:", $cardCheckData);
					list ($cardID, $cardRegID, $cardReg, $cardLevel, $cardTerm, $cardStatus) = explode (":@@:", $cardData);


				}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
				
				/* script validation */ 
				
				if ($level == "")  {
         			
					$msg_e = "* Oooooops Error, please select student level to recharge for. Thanks";
					
	   			}elseif ($term == "")  {
         			
					$msg_e = "* Oooooops Error, please select student term to recharge for. Thanks";
					
	   			}elseif ($card_pin == "")  {
         			
					$msg_e = "* Oooooops Error, please enter valid Scratch Card Pin No. Thanks";
						
	   			}elseif ($cardData == "")  {
         			
					$msg_e = "* Oooooops Error, invalid Scratch Card Pin. Thanks";
						
	   			}elseif (($cardLevel == $level) && ($cardTerm == $term)){
					
					$msg_e = "* Oooooops Error, you have already recharge for this school level and term. Thanks ";
						
	   			}elseif ($cardCS == $foreal){
					
					$msg_e = "* Oooooops Error, you have already recharge for this school level and term. Thanks";
						
	   			}elseif (($cardStatus == $foreal) && ($regNum == $cardReg)){
         			
					$verbBy = "<strong> by You</strong>";											
					$msg_e = "* Oooooops Error, this Scratch Card Pin No. have been used $verbBy. Thanks";
						
	   			}elseif (($cardStatus == $foreal)){
         													
					$msg_e = "* Oooooops Error, this Scratch Card Pin No. had already been used by another student. Thanks";
						
	   			}else {  /* update information */ 

		 			try {
		 			
						$ebele_mark = "UPDATE $eWalletTB 
						
										SET
					 
										iiii_reg = :iiii_reg,
										iiii_reg_id = :iiii_reg_id,
										iiii_level = :iiii_level,
										iiii_term = :iiii_term,
										iiii_time = :iiii_time,
										iiii_stype = :iiii_stype,
										iiii_status = :iiii_status
										
										WHERE iiii_id = :iiii_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':iiii_reg', $regNum);
						$igweze_prep->bindValue(':iiii_reg_id', $regID);
						$igweze_prep->bindValue(':iiii_level', $level);
						$igweze_prep->bindValue(':iiii_term', $term);
						$igweze_prep->bindValue(':iiii_time', $rechargeTime);
						$igweze_prep->bindValue(':iiii_stype', $schoolID);
						$igweze_prep->bindValue(':iiii_status', $foreal);
						$igweze_prep->bindValue(':iiii_id', $cardID); 

						if ($igweze_prep->execute()) {  /* if sucessfully */ 
						
							$msg_s = "<strong>$stuFullName</strong> you have Successfully Recharge your e-Wallet.";								
						
						}else {  /* display error */ 

							$msg_e = "<strong>Ooooooops, An Error Has occur
							while trying to Recharge your e-Wallet, pls try again</strong>";

						}
						
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}	

        		}
        
			}else{
			
					echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			} 
			
         
			if ($msg_s) {

				echo "<script type='text/javascript'> $('#frmrechargeWallet').slideUp(2000); $('#rechargeLoader').fadeOut(3000); </script>"; 
				echo $succesMsg.$msg_s.$sEnd ; echo $scrollUp; exit;	
									
        	}	


			if ($msg_e) {
				
				echo "<script type='text/javascript'> $('#rechargeLoader').fadeOut(3000);	 </script>"; 			
				echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 	 
				 	
									
        	}	
			
exit;	 		
?>