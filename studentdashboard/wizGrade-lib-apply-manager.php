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

		$scrollUp = "<script type='text/javascript'> $('html, body').animate({scrollTop:$('#scrollLTarget').position().top}, 'slow'); hidePageLoader();  /* hide page loader */ </script>";
		 
		 
		if ($_REQUEST['bookID'] != '') {

			try {
							
				$bookID = strip_tags($_REQUEST['bookID']);				
				
				/* script validation */ 				
				
				if($bookID == ""){
					
					$msg_e =  "Oooooooops error, this library book information was not found. Please try again"; 
					
				}else{	
				
					libraryBookExceededLimitChecker($conn, $regID, $schoolID);  /* check if student has any expired library book in possession */

					libraryBookApplicationLimit($conn, $regID, $schoolID);  /* check if student has exceeded book application limit */

					$bookUserInfo = libraryBookAppStatus($conn, $bookID, $regID, $schoolID);

					list ($bookAppStatus, $applyDate, $approveDate, $returnDate) = explode ("@.%.@", $bookUserInfo);

					$bookInfo = libraryBookInfo($conn, $bookID);  /* school library book information */
					
					list ($book_id, $book_name, $book_path, $book_author, $book_type, $book_status) = explode ("@.%.@", $bookInfo);

					if($bookAppStatus == ''){

						$applyTime = date("Y-m-d H:i:s");

						$ebele_mark = "INSERT INTO $wizGradeLibApplyTB (book_id, lib_user, lib_reg, apply_date, stype, b_status)
								  
									  VALUES(:book_id, :lib_user, :lib_reg, :apply_date, :stype, :b_status)";
									  
						$igweze_prep = $conn->prepare($ebele_mark);	
						$igweze_prep->bindValue(':book_id', $bookID);
						$igweze_prep->bindValue(':lib_user', $regID);
						$igweze_prep->bindValue(':lib_reg', $regNum);
						$igweze_prep->bindValue(':apply_date', $applyTime);
						$igweze_prep->bindValue(':stype', $schoolID); 
						$igweze_prep->bindValue(':b_status', $fiVal); 

						if ($igweze_prep->execute()) {  /* if sucessfully */

							$msg_s = "Your application to borrow School Library book by name
							<span>$book_name</span> was Successfully received. You will be notify if your 
							application is approved";

						}else {  /* display error */

							$msg_e = "<span>Ooooooops error, your application 
							to borrow School Library book by name <span>$book_name</span> 
							was not successfully received. Please try again.</span>";

						}

					}elseif($bookAppStatus == $fiVal){  /* display information message */ 

						$applyDateS = date('h:i:s, d F, Y', strtotime($applyDate)); 
						$msg_i = "You have already apply for to borrow School Library book by name
						<span>$book_name</span> on <strong>$applyDateS</strong>.
						Meanwhile, your application is pending and you will be notify if your  application is approved.";

					}elseif($bookAppStatus == $seVal){  /* display information message */ 

						$approveDateS = date('h:i:s, d F, Y', strtotime($approveDate)); 
						$msg_i = "School Library book by name
						<span>$book_name</span> have been approved for you 
						on <strong>$approveDateS</strong> and is in your possession now.";

					}else{  /* display error */ 

						$msg_e = "<span>Ooooooops error, your application 
						to borrow School Library book by name <span>$book_name</span> 
						was not successfully received. Please try again.</span>";

					}

				}		

			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
			
		}else{
		
				$msg_e =  "Oooooooops error, this library book information was not found. Please try again";
			
		}
				 
		
	
		if ($msg_s) {

			echo $succesMsg.$msg_s.$sEnd; echo $scrollUp; exit; 				
									
        }	

		if ($msg_i) {

			echo $infMsg.$msg_i.$msgEnd; echo $scrollUp; exit; 				
									
        }	 

		if ($msg_e) {

			echo $errorMsg.$msg_e.$eEnd;  echo $scrollUp; exit;  
									
        }	 
		
exit;		
?>