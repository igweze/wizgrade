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
	This script handle student result automation and configuration
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	    

		if ($_REQUEST['save-rs-settings'] == 'automateRS'){  /* automate result */
		 
            /* script validation */
			
			if ((isset($_REQUEST['sess'])) && (isset($_REQUEST['level'])) && (isset($_REQUEST['class'])) 
				&& (isset($_REQUEST['term'])) )  {

		        $session = $_REQUEST['sess'];
        		$level = $_REQUEST['level'];
		        $class = $_REQUEST['class'];
				$term = $_REQUEST['term'];
				
				try {
						
					$sessionID = sessionID($conn, $session); /* school session ID  */				

					$ebele_mark_6 = "SELECT s_id
			
									FROM $rsTeachersConfigTB
							
									WHERE  session = :session
							
											AND level = :level
							
											AND class = :class
											
											AND term = :term";
					 
					$igweze_prep_6 = $conn->prepare($ebele_mark_6);				 
					$igweze_prep_6->bindValue(':session', $sessionID);
					$igweze_prep_6->bindValue(':level', $level);
					$igweze_prep_6->bindValue(':class', $class);
					$igweze_prep_6->bindValue(':term', $term);
					$igweze_prep_6->execute();
			
					$rows_count_6 = $igweze_prep_6->rowCount(); 
			
					if($rows_count_6 == $i_false) {  /* display error */

							$msg_e = "Ooooooops, please save or add subject teachers records before you can compute 
							students result";
							echo $erroMsg.$msg_e.$msgEnd;
							
							echo "<script type='text/javascript'>  
					
								
								$('#autoRSLoader').fadeOut(4000);
								$('#automateRS').fadeIn(100);
								$('#publishRS').fadeIn(100);										
							
							</script>";									
							exit; 
							
					}else{  /* if sucessfully */ 
						
							require  $wizGradeClassConfigDir;  /* include class configuration script */ 
							
							require_once $wizGradeCalRSDir;  /* include result automation script */ 

							while($row_6 = $igweze_prep_6->fetch(PDO::FETCH_ASSOC)) {  /* loop array */
											
								$s_id = $row_6['s_id'];
								$statusRS = $row_6['status'];
								
							}
							
							/* update information */
							
							$ebele_mark_7 = "UPDATE  $rsTeachersConfigTB 
							
												SET 
												
												status = :status
												
												WHERE s_id = :s_id";
											
							$igweze_prep_7 = $conn->prepare($ebele_mark_7);	
							$igweze_prep_7->bindValue(':s_id', $s_id);
							$igweze_prep_7->bindValue(':status', $seVal);
							$igweze_prep_7->execute();
							
							echo "<script type='text/javascript'>   
							
								$('#autoRSLoader').fadeOut(4000);										
								$('#publishRS').fadeIn(100);
								$('#frmautomateRS').slideUp(1500);
							
							</script>";

							$msg_s = "Students Result  was Automatically and Successfully Commputed."; 
			
					}
							 
								  
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}			

        	}else {  /* display error */

					$msg_e =  $formErrorMsg;
 
        	}
			
			
		}elseif ($_REQUEST['save-rs-settings'] == 'configStaffs'){  /* save result configuration */
		 
            if ((isset($_REQUEST['sess'])) && (isset($_REQUEST['level'])) && (isset($_REQUEST['class'])) 
				&& (isset($_REQUEST['term'])) && (isset($_REQUEST['teachersInfo'])) )  {

		        $session = $_REQUEST['sess'];
        		$level = $_REQUEST['level'];
		        $class = $_REQUEST['class'];
				$term = $_REQUEST['term'];
				$teachersInfo = $_REQUEST['teachersInfo'];
				
				foreach ($teachersInfo as $field  => $TValue){  /* loop array */

					if ( (empty($TValue)) || ($TValue == '') )  {
	
						/*
						echo "<script type='text/javascript'>  
									
							$('#rsConfigLoader').fadeOut(4000);
								
									
						</script>";

						$msg_e .= "*Oooooops Error, please enter all subject teachers data";
					
						echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 
						*/
	
					}

				}
				
				try{
					
					$teachersInfo = serialize($teachersInfo);

					$sessionID = sessionID($conn, $session); /* school session ID  */
					
					$ebele_mark = "SELECT s_id
			
							FROM $rsTeachersConfigTB
							
									WHERE  session = :session
							
											AND level = :level
							
											AND class = :class
											
											AND term = :term";
					 
					$igweze_prep = $conn->prepare($ebele_mark);				 
					$igweze_prep->bindValue(':session', $sessionID);
					$igweze_prep->bindValue(':level', $level);
					$igweze_prep->bindValue(':class', $class);
					$igweze_prep->bindValue(':term', $term);
					$igweze_prep->execute();
			
					$rows_count = $igweze_prep->rowCount(); 
			
					if($rows_count == $i_false) {  /* insert information */  

						$ebele_mark_1 = "INSERT INTO $rsTeachersConfigTB (s_id, session, level, class, term,
																					t_info, staff_id, status) 
									
										VALUES(:s_id, :session, :level, :class, :term, :t_info, :staff_id, :status)";
										
						$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
						$igweze_prep_1->bindValue(':s_id', $teacherID);
						$igweze_prep_1->bindValue(':session', $sessionID);
						$igweze_prep_1->bindValue(':level', $level);
						$igweze_prep_1->bindValue(':class', $class);
						$igweze_prep_1->bindValue(':term', $term);
						$igweze_prep_1->bindValue(':t_info', $teachersInfo);
						$igweze_prep_1->bindValue(':staff_id', $adminID);
						$igweze_prep_1->bindValue(':status', $foreal);
						$igweze_prep_1->execute(); 

							
					}else{  /* update information */ 
						
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */
										
							$s_id = $row['s_id'];
							
						}

						$ebele_mark_1 = "UPDATE  $rsTeachersConfigTB 
						
											SET 
											
											t_info = :t_info
											
											WHERE s_id = :s_id";
										
						$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
						$igweze_prep_1->bindValue(':s_id', $s_id);
						$igweze_prep_1->bindValue(':t_info', $teachersInfo);
						$igweze_prep_1->execute(); 
					
					}

					echo "<script type='text/javascript'> $('#frmsaveTeacherRS').slideUp(1500); 
														$('#rsConfigLoader').fadeOut(4000);
						</script>";

					$msg_s = "Subject Teachers information were successfully saved";
						
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}							

        	}else {  /* display error */

					$msg_e  = "Ooooooops, an error has occur while trying to save subject teachers information.
							Please try again";

 
        	}
			
		}elseif ($_REQUEST['save-rs-settings'] == 'publishRS'){  /* publish result */
		 
            /* script validation */ 
			
			if ((isset($_REQUEST['sess'])) && (isset($_REQUEST['level'])) && (isset($_REQUEST['class'])) 
				&& (isset($_REQUEST['term'])) )  {

					$session = $_REQUEST['sess'];
					$level = $_REQUEST['level'];
					$class = $_REQUEST['class'];
					$term = $_REQUEST['term'];
		
				try{
						$sessionID = sessionID($conn, $session); /* school session ID  */
						
		  				$ebele_mark = "SELECT s_id, status
				
								FROM $rsTeachersConfigTB
								
										WHERE  session = :session
								
												AND level = :level
								
												AND class = :class
												
												AND term = :term";
						 
 					    $igweze_prep = $conn->prepare($ebele_mark);				 
						$igweze_prep->bindValue(':session', $sessionID);
						$igweze_prep->bindValue(':level', $level);
						$igweze_prep->bindValue(':class', $class);
						$igweze_prep->bindValue(':term', $term);
 						$igweze_prep->execute();
				
						$rows_count = $igweze_prep->rowCount(); 
				
						if($rows_count == $i_false) {  /* display error */

							$msg_e =  "Ooooooops, please save or add subject teachers records before you can publish this
							result. Thanks"; 
								
						}else{
							
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */
											
								$s_id = $row['s_id'];
								$statusRS = $row['status'];
								
							}
							
							if($statusRS != $seVal){  /* display error */ 
								$msg_e = "Ooooooops, please you have to compute 
								students result before you can publish it. Thanks";
								
							}else{  /* update information */ 

								$ebele_mark_1 = "UPDATE  $rsTeachersConfigTB 
								
													SET 
													
													status = :status
													
													WHERE s_id = :s_id";
												
								$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
								$igweze_prep_1->bindValue(':s_id', $s_id);
								$igweze_prep_1->bindValue(':status', $thVal);
								$igweze_prep_1->execute();

								$msg_s = "Class Results was successfully publish by you.";	
								$script = "$('#frmpublishRS').slideUp(1500); $('#frmsaveTeacherRS').slideUp(100);
										   $('#frmautomateRS').slideUp(100);";
							
						   }
						
						} 

						echo "<script type='text/javascript'>   
									
								$('#publishRS').fadeIn(100);
								$('#autoRSLoader').fadeOut(4000);
								$('html, body').animate({ scrollTop:  $('#scrollTarget3').offset().top - 100 }, 'fast');
								$script
									
							</script>";

				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}					

        	}else {  /* display error */

		    	$msg_e =  $formErrorMsg; 
 
        	}
			
		}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
		} 	
			
		if ($msg) {

			echo $errorMsg.$msg.$eEnd; echo $scrollUp; exit; 			

		} 
	 
		if ($msg_s) {

			echo $succesMsg.$msg_s.$sEnd ; echo $scrollUp; exit; 				
								
		} 

		if ($msg_e) {

			echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; exit; 			
								
		}	
		
exit;	 
?>