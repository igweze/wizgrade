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
	This script handle school time table
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

            define('wizGrade', 'igweze');  /* define a check for wrong access of file */
						
			require 'configwizGrade.php';  /* load wizGrade configuration files */	   

				if (($_REQUEST['timeTableData']) == 'showTimeTable') { /* show school timetable */	
					
		 			try {

							wizGradeTimeTable($conn); /* retrieve school timetable */	

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
				 

				}elseif (($_REQUEST['timeTableData']) == 'timeTableInput') { /* show school timetable input */	
					
					echo  '<textarea name="support" class="full-textarea" id="eComment" style="height: 100% !important;
					width: 100% !important; border: 0px !important;"
					placeholder="Write Your Time Table here"></textarea>';
			 

				}elseif (($_REQUEST['timeTableData']) == 'saveTimeTable') { /* save school timetable */	


					$timeTableMsg = strip_tags($_REQUEST['timeTableMsg']);
					$start = $_REQUEST['start'];
					$end = $_REQUEST['end'];
					
					/* script validation */ 
					
					if($timeTableMsg == ''){
					
						$msg_e = "Ooooooops, Time Tables Information is empty. 
						Please type a comment";
						echo $errorMsg.$msg_e.$eEnd;
						
					}else{  /* insert information */  

						try {
								$timeTableMsg = htmlspecialchars($timeTableMsg);
				
								$ebele_mark = "INSERT INTO $studentTimeTable (startdate, enddate, comments)

												VALUES (:startdate, :enddate, :comments)";
						 
								$igweze_prep = $conn->prepare($ebele_mark);

								$igweze_prep->bindValue(':startdate', $start);
								$igweze_prep->bindValue(':enddate', $end);
								$igweze_prep->bindValue(':comments', $timeTableMsg); 
			
								if ($igweze_prep->execute()) {  /* if sucessfully */ 

									$msg_s = "Successfully Saved.";
							
								}else {  /* display error */

									$msg_e = "Ooooooops, 
									An Error Has just while tring to save Time Table, Please try again";

								}

						}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
						}

						
					}
				
				
				}elseif (($_REQUEST['timeTableData']) == 'loadTimeTable') { /* show school timetable */	 
					
					$timeTabltID = strip_tags($_REQUEST['timeTabltID']);
					
					/* select information */ 	

		 			try {
		 
			
							$ebele_mark = "SELECT startdate, enddate, comments FROM $studentTimeTable 

											WHERE tID = :tID";
					 
 			    			$igweze_prep = $conn->prepare($ebele_mark);

							$igweze_prep->bindValue(':tID', $timeTabltID);
															
							$igweze_prep->execute();
							
							$rows_count = $igweze_prep->rowCount(); 
				
							if($rows_count == $foreal) {  /* check array is empty */
				
								while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
	   
									$comments = $row['comments'];
									echo  '<textarea name="support" class="full-textarea" id="timeTableComment" = style="height: 100% !important;
									width: 100% !important; border: 0px !important;"
									required>'.$comments.'</textarea>';
											
						
								}	
				
							}else{
			
								$comments = "";
			
							}

						}catch(PDOException $e) {
  			
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
						}

				}elseif (($_REQUEST['timeTableData']) == 'updateTimeTable') { /* update school timetable */	
					
					
					$timeTabltID = strip_tags($_REQUEST['timeTabltID']);
					$timeTableMsg = strip_tags($_REQUEST['timeTableMsg']);
					
					/* script validation */ 
					
					if($timeTableMsg == ''){
					
						$msg_e = "Ooooooops, Time Table Information is empty. 
						Please type a comment";
						
					}else{  /* update information */ 

						try {
		 
							$timeTableMsg = htmlspecialchars($timeTableMsg);
							
							$ebele_mark = "UPDATE $studentTimeTable 
							
											SET comments = :comments

											WHERE tID = :tID";
					 
 			    			$igweze_prep = $conn->prepare($ebele_mark);

							$igweze_prep->bindValue(':comments', $timeTableMsg);
							$igweze_prep->bindValue(':tID', $timeTabltID); 
							
							if ($igweze_prep->execute()) {  /* if sucessfully */

                 				$msg_s = "Successfully Updated.";
													
						
        					}else {  /* display error */ 

                 				$msg_e = "Ooooooops, 
								An Error Has just while tring to Update Time Table, Please try again";

        					}
							

						}catch(PDOException $e) {
  			
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
						}
				
					}

				}elseif (($_REQUEST['timeTableData']) == 'deleteTimeTable') { /* remove school timetable */	 
					
					$timeTabltID = strip_tags($_REQUEST['timeTabltID']);
					
					/* script validation */ 
					
					if($timeTabltID == ""){
						
						$msg_e = "Ooooooops,  An Error Has just while tring to Remove Time Table, Please try again";
						
					}else{	
						
						try {
		 
			
							$ebele_mark = "DELETE FROM $studentTimeTable 
							
											WHERE tID = :tID 
											
											LIMIT 1";
					 
 			    			$igweze_prep = $conn->prepare($ebele_mark);

							$igweze_prep->bindValue(':tID', $timeTabltID); 
							
							if ($igweze_prep->execute()) {  /* if sucessfully */

                 				$msg_s = "Successfully Removed."; 
						
        					}else {  /* display error */ 

                 				$msg_e = "Ooooooops,  An Error Has just while tring to Remove Time Table, Please try again";

        					}
							

						}catch(PDOException $e) {
  			
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				
						}
						
					}	

				}else{
		
		
					echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
		
				}
			

				if ($msg_s) {

					echo $succesMsg.$msg_s.$sEnd ; echo $scrollUp; exit; 						
											
				}	


				if ($msg_e) {

					echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 		
											
				}	
			
exit;

?>