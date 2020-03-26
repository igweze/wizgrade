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
	This script handle library book application
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 			 

if(!session_id()){
    session_start();
}

        define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */    
		 
		 
			if (($_REQUEST['libData']) == 'discard-application') {  /* discard student book application */ 
			 
				$applyData =  $_REQUEST['applyData'];
				$reasons =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['reasons']);
				
				$applyData = strip_tags($applyData);
				$approveTime = date("Y-m-d H:i:s");
				
				list ($applyID, $schoolID, $regID) = explode ("-", $applyData);

				
					if ($applyID == "")  {
						
						$msg_e = "* Oooooooooops error, could not locate this book application data. Thanks";
						
					}else {
	
						try {
				

							$ebele_mark = "UPDATE $wizGradeLibApplyTB SET
						 
											d_reasons = :d_reasons,
											b_status = :b_status,
											approve_date = :approve_date
											
											WHERE b_id = :b_id
											
											AND stype = :stype
											
											AND lib_user = :lib_user";
											
							$igweze_prep = $conn->prepare($ebele_mark);	
							$igweze_prep->bindValue(':d_reasons', $reasons);
							$igweze_prep->bindValue(':b_status', $foVal);
							$igweze_prep->bindValue(':approve_date', $approveTime);
							$igweze_prep->bindValue(':b_id', $applyID);
							$igweze_prep->bindValue(':stype', $schoolID);
							$igweze_prep->bindValue(':lib_user', $regID); 

							if ($igweze_prep->execute()) {  /* if sucessfully */ 
			
								$scriptSlide =  "$('.slideUpDiv').slideUp(2000); $('#lib_book_row-$applyID').slideUp(2000); ";
								$msg_s = "School library book application was Successfully discarded."; 
									
							}else {  /* display error */ 
			
								$msg_e = "<span>Oooooooooops, an error has occur
								while trying to discard School library book application, please try again</span>"; 
							
							}	
							

						}catch(PDOException $e) {
		
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
		 
						} 

        		} 
        
			}elseif (($_REQUEST['libData']) == 'approve-application') {  /* remove student book application */
			 
				$applyData =  $_REQUEST['applyData'];
				
				$applyData = strip_tags($applyData);
				$approveTime = date("Y-m-d H:i:s");
				
				list ($applyID, $schoolID, $regID) = explode ("-", $applyData);
				
				libraryBookExceededLimitChecker($conn, $regID, $schoolID);/* check if student has any expired library book in possession */
				
				libraryBookLendingLimit($conn, $regID, $schoolID);  /* check if student has exceeded book application limit */

				
					if ($applyID == "")  {
						
						$msg_e = "* Oooooooooops error, could not locate this book application data. Thanks";
						
					}else {
	
						try {
				

							$ebele_mark = "UPDATE $wizGradeLibApplyTB SET
						 
											
											b_status = :b_status,
											approve_date = :approve_date
											
											WHERE b_id = :b_id
											
											AND stype = :stype
											
											AND lib_user = :lib_user";
											
							$igweze_prep = $conn->prepare($ebele_mark);	
							$igweze_prep->bindValue(':b_status', $seVal);
							$igweze_prep->bindValue(':approve_date', $approveTime);
							$igweze_prep->bindValue(':b_id', $applyID);
							$igweze_prep->bindValue(':stype', $schoolID);
							$igweze_prep->bindValue(':lib_user', $regID); 

							if ($igweze_prep->execute()) {  /* if sucessfully */ 
			
								$scriptSlide =  "$('.slideUpDiv').slideUp(2000); $('#lib_book_row-$applyID').slideUp(2000); ";
								$msg_s = "School library book application was Successfully approved."; 
									
							}else {  /* display error */ 
			
								$msg_e = "<span>Oooooooooops, an error has occur
								while trying to  approve School library book application, please try again</span>";
							
							} 

						}catch(PDOException $e) {

							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
		 
						} 

        		} 
        
			}elseif (($_REQUEST['libData']) == 'certify-book-return') {  /* certify student book return */
			 
				$returnBData =  $_REQUEST['returnBData'];
				$rComments =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['rComments']);
				
				$returnBData = strip_tags($returnBData);
				$returnedTime = date("Y-m-d H:i:s");
				
				list ($applyID, $schoolID, $regID) = explode ("-", $returnBData); 
				
					if ($applyID == "")  {
						
						$msg_e = "* Oooooooooops error, could not locate this book application data. Thanks";
						
					}else {
	
						try { 

							$ebele_mark = "UPDATE $wizGradeLibApplyTB SET
						 
											comment = :comment,
											b_status = :b_status,
											return_date = :return_date
											
											WHERE b_id = :b_id
											
											AND stype = :stype
											
											AND lib_user = :lib_user";
											
							$igweze_prep = $conn->prepare($ebele_mark);	
							$igweze_prep->bindValue(':comment', $rComments);
							$igweze_prep->bindValue(':b_status', $thVal);
							$igweze_prep->bindValue(':return_date', $returnedTime);
							$igweze_prep->bindValue(':b_id', $applyID);
							$igweze_prep->bindValue(':stype', $schoolID);
							$igweze_prep->bindValue(':lib_user', $regID); 

							if ($igweze_prep->execute()) {  /* if sucessfully */ 
			
								$scriptSlide =  "$('.slideUpDiv').slideUp(2000); $('#lib_book_row-$applyID').slideUp(2000); ";
								$msg_s = "School library borrowed book was Successfully certified as Returned."; 
									
							}else {  /* display error */ 
			
								$msg_e = "<span>Oooooooooops, an error has occur
								while trying to certified School library book as returned, please try again</span>"; 
							
							} 
							
						}catch(PDOException $e) {
		
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
		 
						} 

        		} 
        
			}else{
			
					echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}

			if ($msg_e) {
				
				echo "<script type='text/javascript'>  $('#book-app-loader').fadeOut(3000); </script>";
				echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 							
										
			}	

			if ($msg_s) {
	
				echo "<script type='text/javascript'>  $scriptSlide $('#book-app-loader').fadeOut(3000); </script>";
				echo $succesMsg.$msg_s.$sEnd ; echo $scrollUp;  exit;
										
			}	 
			
exit;
?>