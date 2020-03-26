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
	This script handle assigning staff to a class  and subject 
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configwizGrade.php';  /* load wizGrade configuration files */	   

			if (($_REQUEST['assignData']) == 'assignFormTeacher') {  /* assigning staff to a class */	   


				$session = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['sess']);
				$level = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['level']);
				$class = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['class']);
				$staffData = $_REQUEST['staffData'];
				
				/* script validation */
				
				if ($session == "")  {
         		
					$msg_e = "* Oooooooops Error, please select a session"; 
	   			
				}elseif ($level == "")  {
         		
					$msg_e = "* Oooooooops Error, please select a level"; 
	   			
				}elseif ($class == "")  {
         		
					$msg_e = "* Oooooooops Error, please select class to assign teacher to"; 
	   			
				}elseif ($staffData == "")  {
         		
					$msg_e = "* Oooooooops Error, please select teacher/s to assign class to"; 
	   			
				}else {  /* select and assign information */ 
       	
		 			try { 
		 				 														
						$sessionID = sessionID($conn, $session);  /* school session ID */
						
						$staffArr =  explode(',', $staffData);	 

						foreach ($staffArr as $teacherID) {  /* loop array */
							
							$teacherID = trim($teacherID); 
							$teacherData = staffData($conn, $teacherID);  /* school staffs/teachers information */ 						
						
							list ($titleV, $teacherName, $sex, $rankingVal) = explode ("#@s@#", $teacherData);
							$titleVal = $title_list[$titleV];

								
							$ebele_mark = "SELECT form_id
					
									FROM $classFormTeachersTB
									
											WHERE t_id = :t_id
									
													AND session = :session
									
													AND level = :level
									
													AND class = :class";
							 
							$igweze_prep = $conn->prepare($ebele_mark);				 
							$igweze_prep->bindValue(':t_id', $teacherID);
							$igweze_prep->bindValue(':session', $sessionID);
							$igweze_prep->bindValue(':level', $level);
							$igweze_prep->bindValue(':class', $class);
							$igweze_prep->execute();
					
							$rows_count = $igweze_prep->rowCount(); 
					
							if($rows_count == $i_false) {  /* check if not assign already */

								$ebele_mark_1 = "INSERT INTO $classFormTeachersTB (t_id, session, level, class) 
											
												VALUES(:t_id, :session, :level, :class)";
												
								$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
								$igweze_prep_1->bindValue(':t_id', $teacherID);
								$igweze_prep_1->bindValue(':session', $sessionID);
								$igweze_prep_1->bindValue(':level', $level);
								$igweze_prep_1->bindValue(':class', $class);
								$igweze_prep_1->execute();

								$ebele_mark = "UPDATE $staffTB SET
							 
												t_grade = :t_grade
												
												WHERE t_id = :t_id";
												
								$igweze_prep = $conn->prepare($ebele_mark);	
								$igweze_prep->bindValue(':t_grade', $staffGradeInt);
								$igweze_prep->bindValue(':t_id', $teacherID);
								
								if ($igweze_prep->execute()) {  /* if sucessfully */ 
						
										$msg_s = "<b> $titleVal $teacherName </b> 
										was successfully assign as class manager."; 

								}else {  /* display error */

										$msg_e = "Ooooooops, an Error has occur while trying 
										to assign class manager to <b> $titleVal $teacherName</b>, 
										Please try again later";

								}
			

									
							}else{  /* display information message */ 
									
									$msg_i = "$titleVal $teacherName already assign to class.";
							
							}  
							
						} 
						
						echo "<script type='text/javascript'> $('#levelCM').val(''); $('#class').val('');
							  hidePageLoader();  /* hide page loader */ $('#teacherDiv').val(''); $('.picTDIv').text(''); </script>"; 
							
					}catch(PDOException $e) {
						
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
						 
					} 	

				}
				 
		
		
			}elseif (($_REQUEST['assignData']) == 'assignSubTeacher') {  /* assigning staff to a subject */	 

				$session = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['sess']);
				$level = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['level']);
				$class = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['class']);
				$teacherID = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['teacher']);
				$subjectID = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['subject']);

				/* script validation */ 
				
				if ($session == "")  {
         		
					$msg_e = "Please select a session ";
	   			
				}elseif ($level == "")  {
         		
					$msg_e = "Please select a level";
	   			
				}elseif ($class == "")  {
         		
					$msg_e = "Please select class to assign teacher to";
	   			
				}elseif ($subjectID == "")  {
         		
					$msg_e = "Please select subject to assign to teacher";
	   			
				}elseif ($teacherID == "")  {
         		
					$msg_e = "Please select teacher to assign subject to";
	   			
				}else {  /* select and assign information */

       	
		 			try {
		 				 														
						$sessionID = sessionID($conn, $session);  /* school session ID */
						
		  				$ebele_mark = "SELECT assign_id
				
								FROM $teachersAssignSubTB
								
										WHERE t_id = :t_id
								
												AND session = :session
								
												AND level = :level
								
												AND class = :class
												
												AND sub_id = :sub_id";
						 
 					    $igweze_prep = $conn->prepare($ebele_mark);				 
						$igweze_prep->bindValue(':t_id', $teacherID);
						$igweze_prep->bindValue(':session', $sessionID);
						$igweze_prep->bindValue(':level', $level);
						$igweze_prep->bindValue(':class', $class);
						$igweze_prep->bindValue(':sub_id', $subjectID);
 						$igweze_prep->execute();
				
						$rows_count = $igweze_prep->rowCount(); 
				
						if($rows_count == $i_false) {  /* check if not assign already */ 

							$ebele_mark_1 = "INSERT INTO $teachersAssignSubTB (t_id, sub_id, session, level,
																						 class) 
										
											VALUES(:t_id, :sub_id, :session, :level, :class)";
											
							$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
							$igweze_prep_1->bindValue(':t_id', $teacherID);
							$igweze_prep_1->bindValue(':sub_id', $subjectID);
							$igweze_prep_1->bindValue(':session', $sessionID);
							$igweze_prep_1->bindValue(':level', $level);
							$igweze_prep_1->bindValue(':class', $class); 
	
							if ($igweze_prep_1->execute()) {

								$teacherData = staffData($conn, $teacherID);  /* school staffs/teachers information */ 
												
								list ($titleV, $teacherName, $sex, $rankingVal) = explode ("#@s@#", $teacherData);
								$titleVal = $title_list[$titleV];


								$msg_s = "Subject was successfully assign to <b> 
								$titleVal $teacherName </b> ";
						
								echo "<script type='text/javascript'> $('#level').val(''); $('#class').val('');
									$('#teacherDiv').val(''); $('#subjectDiv').val(''); $('.picTDIv').text(''); </script>";

							}else {

								$msg_e = "<span>Ooooooops, An Error Has occur while trying to create assign subject to teacher,
								please try again</span>";

							}
						
						
						}else{  /* display information message */ 

								$teacherData = staffData($conn, $teacherID);  /* school staffs/teachers information */ 
												
								list ($titleV, $teacherName, $sex, $rankingVal) = explode ("#@s@#", $teacherData);
								$titleVal = $title_list[$titleV];


								$msg_i = "This subject have already been assign to <b> 
								$titleVal $teacherName </b> ";

						} 

					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		 
				

				}
        
		
		
			}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}


	 
			if ($msg_s) {

				echo $succMsg.$msg_s.$msgEnd;  
				echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
										
			}	


			if ($msg_e) {

				echo $erroMsg.$msg_e.$msgEnd;
				echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
										
			}	

			if ($msg_i) {

				echo $infMsg.$msg_i.$msgEnd; 
				echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
										
			}	
		
	 

exit;
?>