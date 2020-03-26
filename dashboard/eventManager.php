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
	This script handle school events
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

            define('wizGrade', 'igweze');  /* define a check for wrong access of file */
						
			require 'configINwizGrade.php';  /* load wizGrade configuration files */	   

				if (($_REQUEST['eventData']) == 'showEvent') {  /* show school events */
					
		 			try {

							wizGradeEvents($conn); /* retrieve school events */	

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
				 

				}elseif (($_REQUEST['eventData']) == 'eventInput') {  /* load school events input */
					
					echo  '<textarea name="support" class="full-textarea" id="eComment" style="height: 100% !important;
					width: 100% !important; border: 0px !important;"
					placeholder="Write Your Event here"></textarea>';
			 

				}elseif (($_REQUEST['eventData']) == 'saveEvent') {  /* save school events */
					
					$eventMsg = strip_tags($_REQUEST['eventMsg']);
					$start = $_REQUEST['start'];
					$end = $_REQUEST['end'];
					
					/* script validation */
					
					if($eventMsg == ''){
					
						$msg_e = "<span>Ooooooops, School Events Information is empty. 
						Please type a comment</span>";
						echo $errorMsg.$msg_e.$eEnd;
						
					}else{  /* insert information */
						
						$eventMsg = htmlspecialchars($eventMsg); 

						try {
			 
				
								$ebele_mark = "INSERT INTO $notificationTB (startdate, enddate, comments)

												VALUES (:startdate, :enddate, :comments)";
						 
								$igweze_prep = $conn->prepare($ebele_mark);

								$igweze_prep->bindValue(':startdate', $start);
								$igweze_prep->bindValue(':enddate', $end);
								$igweze_prep->bindValue(':comments', $eventMsg); 
			
								if ($igweze_prep->execute()) {  /* if sucessfully */

									$msg_s = "Successfully Saved.";
														
							
								}else {  /* display error */ 

									$msg_e = "<span>Ooooooops, 
									An Error Has just while tring to save School Event, Please try again</span>"; 

								}



						}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
						} 
						
					} 
				
				}elseif (($_REQUEST['eventData']) == 'loadEvent') {  /* load school events */ 					
					
						$eventID = strip_tags($_REQUEST['eventID']);				

		 			try {		 
			
							$ebele_mark = "SELECT startdate, enddate, comments FROM $notificationTB 

											WHERE eID = :eID";
					 
 			    			$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':eID', $eventID);
															
							$igweze_prep->execute();
							
							$rows_count = $igweze_prep->rowCount(); 
				
							if($rows_count == $foreal) {  /* if sucessfully */ 
				
								while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
	   
									$comments = $row['comments'];
									echo  '<textarea name="support" class="full-textarea" id="eventComment" = style="height: 100% !important;
									width: 100% !important; border: 0px !important;"
									required>'.$comments.'</textarea>';
											
						
								}	
				
							}else{  /* display error */ 
			
										$comments = "";
			
							}

					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}

				}elseif (($_REQUEST['eventData']) == 'updateEvent') {  /* update school events */
					
					
					$eventID = strip_tags($_REQUEST['eventID']);
					$eventMsg = strip_tags($_REQUEST['eventMsg']);

					if($eventMsg == ''){
					
						$msg_e = "<span>Ooooooops, School Event Information is empty. 
						Please type a comment</span>";
						
					}else{
						
						$eventMsg = htmlspecialchars($eventMsg);


						try {
			 
				
								$ebele_mark = "UPDATE $notificationTB 
								
												SET comments = :comments

												WHERE eID = :eID";
						 
								$igweze_prep = $conn->prepare($ebele_mark);

								$igweze_prep->bindValue(':comments', $eventMsg);
								$igweze_prep->bindValue(':eID', $eventID); 
								
								if ($igweze_prep->execute()) {  /* if sucessfully */

									$msg_s = "Successfully Updated.";														
							
								}else {  /* display error */

									$msg_e = "<span>Ooooooops, 
									An Error Has just while tring to Update School Event, Please try again</span>";

								} 

						}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
						}
					
					}

				}elseif (($_REQUEST['eventData']) == 'deleteEvent') {  /* remove school events */
					
					
					$eventID = strip_tags($_REQUEST['eventID']); 
					
					/* script validation */ 
					
					if($timeTabltID == ""){
						
						$msg_e = "Ooooooops,  An Error Has just while tring to Remove Time Table, Please try again";
						
					}else{
						
						try { 
			
							$ebele_mark = "DELETE FROM $notificationTB 
							
											WHERE eID = :eID 
											
											LIMIT 1";
					 
 			    			$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':eID', $eventID); 
							
							if ($igweze_prep->execute()) {  /* if sucessfully */

                 				$msg_s = "Successfully Removed"; 
						
        					}else { /* display error */

                 				$msg_e = "<span>Ooooooops, 
								An Error Has just while tring to Remove School Event, Please try again</span>";

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