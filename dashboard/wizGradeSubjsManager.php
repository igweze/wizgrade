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
	This script handle school subject information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configwizGrade.php';  /* load wizGrade configuration files */	 
		 $scrollUp = "
		 <script type='text/javascript'> 
		 $('html, body').animate({ scrollTop:  $('#msgBoxSubjs').offset().top - 300 }, 'slow'); </script>";

		 if (($_REQUEST['subConfig']) == 'cfEditCC') {  /* load subject edit form  */ 

				$courseCode =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseCode']);
				
				$cfID =  strip_tags($_REQUEST['cfID']);
				
				/* script validation */ 
				
				if ($cfID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrieve subject infomation. please try again";
					
	   			}else {  /* load subject edit form  */ 
					
					$cfSubjC = "cfSubjC-".$cfID;
					
					echo '<div class="iconic-input">
                    <i class="fa fa-book"></i> <input type="text" class="form-control uppWords" id="'.$cfSubjC.'" value="'.$courseCode.'"
					name="'.$cfSubjC.'" />  </div>';

        		}
        
			}elseif (($_REQUEST['subConfig']) == 'cfEditCT') {  /* load subject edit form  */

				$courseTitle =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseTitle']);
				
				$cfID =  strip_tags($_REQUEST['cfID']);
				
				/* script validation */
				
				if ($cfID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrieve subject infomation. please try again";
					
	   			}else {  /* load subject edit form  */ 
					
					$cfSubjT = "cfSubjT-".$cfID; 
						  
					echo '<div class="iconic-input">
                    <i class="fa fa-bars"></i>
                    <input type="text" class="form-control capWords" id="'.$cfSubjT.'" value="'.$courseTitle.'"  name="'.$cfSubjT.'" />  </div>'; 

					echo "<script type='text/javascript'>  
						$('#cfUpdate-$cfID').fadeIn(100); 
						$('#cfEdit-$cfID').fadeOut(100);
						$('#cfmsgBox-$cfID').fadeOut(100);
						$('#cfLoader-$cfID').fadeOut(100);
						</script>"; 

        		}
        
			}elseif (($_REQUEST['subConfig']) == 'cfUpdateCC') {  /* update subject code */

				$courseCode =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseCode']);
				
				$cfID =  strip_tags($_REQUEST['cfID']);
				
				/* script validation */ 
				
				if ($cfID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrieve subject infomation. please try again";
					
	   			}else {  /* update information */ 
					
		 			try {

						$courseCode = strtoupper($courseCode);
						
						$ebele_mark = "UPDATE $wizGradeConfigTB
										
										SET cf_code = :cf_code
										
										WHERE cf_id = :cf_id";
			 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':cf_id', $cfID);
						$igweze_prep->bindValue(':cf_code', $courseCode); 
					
						if ($igweze_prep->execute()) {  /* if sucessfully */ 
							
								echo "<i class='fa fa-book'></i> $courseCode";	
							
								
						}else {  /* display error */

								$msg_e = "<span>Ooooooops, an 
								Error occur while trying to update subject infomation, please try again</span>";


						}								
								
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
									

        		} 	

			}elseif (($_REQUEST['subConfig']) == 'cfUpdateCT') {  /* update subject title */

				$courseTitle =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseTitle']);
				
				$cfID =  strip_tags($_REQUEST['cfID']);
				
				/* script validation */
				
				if ($cfID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrieve subject infomation. please try again";
					
	   			}else {  /* update information */  

		 			try {
						
						$courseTitle = ucwords($courseTitle);
						
						$ebele_mark = "UPDATE $wizGradeConfigTB
										
										SET cf_tittle = :cf_tittle
										
										WHERE cf_id = :cf_id";
			 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':cf_id', $cfID);
						$igweze_prep->bindValue(':cf_tittle', $courseTitle); 
						
						if ($igweze_prep->execute()) {  /* if sucessfully */
							
								echo "<i class='fa fa-bars'></i> $courseTitle";	
							
								
						}else {  /* display error */ 
								$msg_e = "<span>Ooooooops, an 
								Error occur while trying to update subject infomation, please try again</span>"; 

						}	 
		 
						echo "<script type='text/javascript'>  
						$('#cfUpdate-$cfID').fadeOut(100); 
						$('#cfEdit-$cfID').fadeIn(100);
						$('#cfmsgBox-$cfID').fadeOut(100);
						$('#cfLoader-$cfID').fadeOut(100);
						</script>";
		
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
					

        		}
        
			}elseif (($_REQUEST['subConfig']) == 'csEditCC') {  /* load subject edit form  */ 

				$courseCode =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseCode']);
				
				$csID =  strip_tags($_REQUEST['csID']);
				
				/* script validation */
				
				if ($csID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrieve subject infomation. please try again";
					
	   			}else {  /* load subject edit form  */ 
					
					$csSubjC = "csSubjC-".$csID;
					
					echo '<div class="iconic-input">
                    <i class="fa fa-book"></i> <input type="text" class="form-control uppWords" id="'.$csSubjC.'" value="'.$courseCode.'"
                    name="'.$csSubjC.'" />  </div>';

        		}
				
        
			}elseif (($_REQUEST['subConfig']) == 'csEditCT') {  /* load subject edit form  */ 

				$courseTitle =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseTitle']);
				
				$csID =  strip_tags($_REQUEST['csID']);
				
				/* script validation */
				
				if ($csID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrieve subject infomation. please try again";
					
	   			}else {  /* load subject edit form  */ 
					
					$csSubjT = "csSubjT-".$csID; 
						  
					echo '<div class="iconic-input">
                    <i class="fa fa-bars"></i>
                    <input type="text" class="form-control capWords" id="'.$csSubjT.'" value="'.$courseTitle.'"  name="'.$csSubjT.'" />  </div>';
						  
					echo "<script type='text/javascript'>  
						$('#csUpdate-$csID').fadeIn(100); 
						$('#csEdit-$csID').fadeOut(100);
						$('#csmsgBox-$csID').fadeOut(100);
						$('#csLoader-$csID').fadeOut(100);
						</script>"; 

        		}
        
			}elseif (($_REQUEST['subConfig']) == 'csUpdateCC') {  /* update subject code */

				$courseCode =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseCode']);
				
				$csID =  strip_tags($_REQUEST['csID']);
				
				/* script validation */
				
				if ($csID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrieve subject infomation. please try again";
					
	   			}else {  /* update information */ 
					
		 			try {

						$courseCode = strtoupper($courseCode);
						
						$ebele_mark = "UPDATE $wizGradeConfigTB
										
										SET cf_code = :cf_code
										
										WHERE cf_id = :cf_id";
			 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':cf_id', $csID);
						$igweze_prep->bindValue(':cf_code', $courseCode); 
					
						if ($igweze_prep->execute()) {  /* if sucessfully */ 
							
								echo "<i class='fa fa-book'></i> $courseCode";	 
								
						}else {  /* display error */

								$msg_e = "<span>Ooooooops, an 
								Error occur while trying to update subject infomation, please try again</span>"; 

						}								
								
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 		

        		} 

			}elseif (($_REQUEST['subConfig']) == 'csUpdateCT') {  /* update subject title */

				$courseTitle =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseTitle']);
				
				$csID =  strip_tags($_REQUEST['csID']);
				
				/* script validation */
				
				if ($csID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrieve subject infomation. please try again";
					
	   			}else {  /* update information */ 

		 			try {

						$courseTitle = ucwords($courseTitle);
						
						$ebele_mark = "UPDATE $wizGradeConfigTB
										
										SET cf_tittle = :cf_tittle
										
										WHERE cf_id = :cf_id";
			 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':cf_id', $csID);
						$igweze_prep->bindValue(':cf_tittle', $courseTitle); 
					
						if ($igweze_prep->execute()) {  /* if sucessfully */ 
							
								echo "<i class='fa fa-bars'></i> $courseTitle";	 
								
						}else {  /* display error */

								$msg_e = "<span>Ooooooops, an 
								Error occur while trying to update subject infomation, please try again</span>"; 
								
						}		 

						echo "<script type='text/javascript'>  
						$('#csUpdate-$csID').fadeOut(100); 
						$('#csEdit-$csID').fadeIn(100);
						$('#csmsgBox-$csID').fadeOut(100);
						$('#csLoader-$csID').fadeOut(100);
						</script>";
		
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 

        		}
        
			}elseif (($_REQUEST['subConfig']) == 'ctEditCC') {  /* load subject edit form  */ 

				$courseCode =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseCode']);
				
				$ctID =  strip_tags($_REQUEST['ctID']);
				
				/* script validation */
				
				if ($ctID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrieve subject infomation. please try again";
					
	   			}else {  /* load subject edit form  */
					
					$ctSubjC = "ctSubjC-".$ctID;
					
					echo '<div class="iconic-input">
                    <i class="fa fa-book"></i> <input type="text" class="form-control uppWords" id="'.$ctSubjC.'" value="'.$courseCode.'"
                    name="'.$ctSubjC.'" />  </div>';

        		}
        
			}elseif (($_REQUEST['subConfig']) == 'ctEditCT') {  /* load subject edit form  */ 

				$courseTitle =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseTitle']);
				
				$ctID =  strip_tags($_REQUEST['ctID']);
				
				/* script validation */
				
				if ($ctID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrieve subject infomation. please try again";
					
	   			}else {  /* load subject edit form  */
					
					$ctSubjT = "ctSubjT-".$ctID; 
						  
					echo '<div class="iconic-input">
                    <i class="fa fa-bars"></i>
                    <input type="text" class="form-control capWords" id="'.$ctSubjT.'" value="'.$courseTitle.'"  name="'.$ctSubjT.'" />  </div>';
						  
					echo "<script type='text/javascript'>  
						$('#ctUpdate-$ctID').fadeIn(100); 
						$('#ctEdit-$ctID').fadeOut(100);
						$('#ctmsgBox-$ctID').fadeOut(100);
						$('#ctLoader-$ctID').fadeOut(100);
						</script>";		 

        		}
        
			}elseif (($_REQUEST['subConfig']) == 'ctUpdateCC') {  /* update subject course */

				$courseCode =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseCode']);
				
				$ctID =  strip_tags($_REQUEST['ctID']);
				
				/* script validation */
				
				if ($ctID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrieve subject infomation. please try again";
					
	   			}else {  /* update information */
					
		 			try {

						$courseCode = strtoupper($courseCode);
						
						$ebele_mark = "UPDATE $wizGradeConfigTB
										
										SET cf_code = :cf_code
										
										WHERE cf_id = :cf_id";
			 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':cf_id', $ctID);
						$igweze_prep->bindValue(':cf_code', $courseCode); 
					
						if ($igweze_prep->execute()) {  /* if sucessfully */
							
								echo "<i class='fa fa-book'></i> $courseCode";	 
								
						}else {  /* display error */ 

								$msg_e = "<span>Ooooooops, an 
								Error occur while trying to update subject infomation, please try again</span>"; 

						}								
								
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 			

        		} 	

			}elseif (($_REQUEST['subConfig']) == 'ctUpdateCT') {  /* update subject title */

				$courseTitle =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseTitle']);
				
				$ctID =  strip_tags($_REQUEST['ctID']);
				
				/* script validation */
				
				if ($ctID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrieve subject infomation. please try again";
					
	   			}else {  /* update information */ 

		 			try {

						$courseTitle = ucwords($courseTitle);
						
						$ebele_mark = "UPDATE $wizGradeConfigTB
										
										SET cf_tittle = :cf_tittle
										
										WHERE cf_id = :cf_id";
			 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':cf_id', $ctID);
						$igweze_prep->bindValue(':cf_tittle', $courseTitle); 

						if ($igweze_prep->execute()) {  /* if sucessfully */
							
								echo "<i class='fa fa-bars'></i> $courseTitle";	 
								
						}else {  /* display error */ 

								$msg_e = "<span>Ooooooops, an 
								Error occur while trying to update subject infomation, please try again</span>"; 

						} 

						echo "<script type='text/javascript'>  
						$('#ctUpdate-$ctID').fadeOut(100); 
						$('#ctEdit-$ctID').fadeIn(100);
						$('#ctmsgBox-$ctID').fadeOut(100);
						$('#ctLoader-$ctID').fadeOut(100);
						</script>";
		
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 

        		}
        
			}elseif (($_REQUEST['subConfig']) == 'saveSubj') {  /* save subject  */


				$courseTitle =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseTitle']);
				$courseCode =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseCode']);
				$term =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseTerm']);
				$level =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['courseLevel']);
				$fiTermLast =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['fiTermLast']);
				$seTermLast =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['seTermLast']);
				$thTermLast =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['thTermLast']);
				
				/* script validation */
				
				if ($courseCode == "") {
         			
					$msg_e = "* Oooooooooops error, please enter a subject/course code";
					
	   			}elseif ($courseTitle == "") {
         			
					$msg_e = "* Oooooooooops error, please enter a subject/course title";
					
	   			}elseif ($term == "") {
         			
					$msg_e = "* Oooooooooops error, please select a subject/course term/semester";
					
	   			}elseif ($level == "") {
         			
					$msg_e = "* Oooooooooops error, please select a subject/course level";
					
	   			}else {  /* insert information */  

					$courseTitle = ucwords($courseTitle);
					$courseCode = strtoupper($courseCode);
					
					require  $wizGradeClassConfigDir;   /* include class configuration script */
					
					$rawCArr = explode(", ", $query_i_scores);
					
					$lastRawC = end($rawCArr);
					
					list($rawC, $rawNum) = explode('_', $lastRawC);
					
					/* generate new course information */
					
					if($rawNum >= $fiVal){
					
						$newRawN = ($rawNum + $fiVal);
					
						$rawCC = $rawC.'_'.$newRawN;
						$rawCT = $rawC.'_t_'.$newRawN;
						$rawCP = $rawC.'_p_'.$newRawN;
						$rawCom = $rawC.'_c_'.$newRawN;
						
					
						$rawCC_af = $rawC.'_'.$rawNum;
						$rawCT_af = $rawC.'_t_'.$rawNum;
						$rawCP_af = $rawC.'_p_'.$rawNum;
						$rawCom_af = $rawC.'_c_'.$rawNum;
						
						$rawCC_vb = "after $rawCC_af";
						$rawCT_vb = "after $rawCT_af";
						$rawCP_vb = "after $rawCP_af";
						$rawCom_vb = "after $rawCom_af";
					
					}else{
						
						$rawC = $courseRawArr[$term];
						$newRawN = $level.'01'; 
						
						$rawCC = $rawC.'_'.$newRawN;
						$rawCT = $rawC.'_t_'.$newRawN;
						$rawCP = $rawC.'_p_'.$newRawN;
						$rawCom = $rawC.'_c_'.$newRawN;
						
						
						$rawCC_vb = "after ireg_id";
						$rawCT_vb = "after ireg_id";
						$rawCP_vb = "after ireg_id";
						$rawCom_vb = "after ireg_id";
						
					}
						

		 			try {

						
						$subjStatus = doSubjectExists($conn, $schoolID, $level, $term, $rawCC, $rawCT, $rawCP);  /* check if school subjects exits */ 
						
						if($subjStatus == $fiVal){  /* check if school subjects exits */
							
							$msg_e = "* Oooooooooops error, this subject code already exits. Please try again";
						
						}else{  /* display error */ 
							
							$conn->beginTransaction();   /* begin transaction */						

							$ebele_mark = "INSERT INTO $wizGradeConfigTB (cf_raw , cf_code, cf_tittle, cf_tot, cf_pos, cf_com, cf_level, cf_term, 
																		cf_program, cf_status) 
	
											 VALUES (:cf_raw , :cf_code, :cf_tittle, :cf_tot, :cf_pos, :cf_com, :cf_level, :cf_term, :cf_program, 
													 :cf_status)"; 
																	
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':cf_raw', $rawCC);
							$igweze_prep->bindValue(':cf_code', $courseCode);
							$igweze_prep->bindValue(':cf_tittle', $courseTitle);				 				 
							$igweze_prep->bindValue(':cf_tot', $rawCT);				 				 
							$igweze_prep->bindValue(':cf_pos', $rawCP);				 				 
							$igweze_prep->bindValue(':cf_com', $rawCom);
							$igweze_prep->bindValue(':cf_level', $level);
							$igweze_prep->bindValue(':cf_term', $term);
							$igweze_prep->bindValue(':cf_program', $schoolID);
							$igweze_prep->bindValue(':cf_status', $fiVal);	
							$igweze_prep->execute();
							
							$ebele_mark_1 = "ALTER TABLE $sdoracle_score_nk ADD $rawCC VARCHAR(50) NULL $rawCC_vb";
																			
							$igweze_prep_1 = $conn->prepare($ebele_mark_1);
							$igweze_prep_1->execute();
							
							$ebele_mark_2 = "ALTER TABLE $sdoracle_sub_score_nk ADD $rawCT TINYINT(3) NULL $rawCT_vb";
																			
							$igweze_prep_2 = $conn->prepare($ebele_mark_2);
							$igweze_prep_2->execute();
							
							$ebele_mark_3 = "ALTER TABLE $sdoracle_grade_nk ADD $rawCP TINYINT(3) NULL $rawCP_vb";
																			
							$igweze_prep_3 = $conn->prepare($ebele_mark_3);
							$igweze_prep_3->execute();
							
							$ebele_mark_4 = "ALTER TABLE $sdoracle_comment_nk ADD $rawCom TEXT NULL $rawCom_vb";
																			
							$igweze_prep_4 = $conn->prepare($ebele_mark_4);
							$igweze_prep_4->execute(); 
						
							if (($igweze_prep == true) && ($igweze_prep_1 == true) && ($igweze_prep_2 == true) && ($igweze_prep_3 == true)
								&& ($igweze_prep_4 == true)) {  /* if sucessfully */ 
								
								$conn->commit();   /* insert information */
								$schoolTerm = schoolTerm($term);  /* school term  */

								echo "<script type='text/javascript'>  
									 $('#refreshSubjsTab').trigger('click');
									 $('#couTerm').text('$term');
									 $('#courseCode').val('');
									 $('#courseTitle').val('');
									 $('#courseTerm').val('');
						
									</script>";

								$msg_s = "Subject information with Code <strong>$courseCode</strong> and title <strong>$courseTitle</strong> 
								 was successfully added for <strong>$schoolTerm term</strong>. Thanks"; 
								 
								 echo $succMsg.$msg_s.$msgEnd; echo $scrollUp; exit;
																						 
							}else{  /* display error */
								
								$conn->rollBack();   /* roll back insertion */
								$msg_e = "Oooooooops Error, Subject information with Code <strong>$courseCode</strong> and title <strong>$courseTitle</strong> 
								was not successfully added. Please try again!!!"; 
								
							}
 
						}
								
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
         		
        		}
        
			}elseif (($_REQUEST['subConfig']) == 'removeSubj') {  /* remove subject */

				
				$courseData =   $_REQUEST['courseData'];
				$adminPass =   $_REQUEST['adminPass'];
				$adminPass = strip_tags($adminPass);
				
				$checkDetail =  wizGradeAdminPassData($conn, $_SESSION['adminUser']);  /* school admin password details */
			 
			 	list ($adminID, $checkedPass, $adminName) =  explode ("@(.$*S*$.)@", $checkDetail);
					
				list ($igweze, $subjID, $level, $term, $rawCC, $courseCode, $courseTitle) = explode('-', $courseData);
				
				/* script validation */ 
				
				if (($subjID == "") ||($rawCC== "") || ($courseCode == "") || ($courseTitle == "") || ($term == "") || ($level == "")) {
         			
					echo "<script type='text/javascript'>   $('#subj-loader').fadeOut(1500); </script>";

					$msg_e = "* Oooooooooops error, could not find this subject Info";
					
	   			}elseif ($adminPass != $checkedPass)   {
					
					echo "<script type='text/javascript'>   $('#subj-loader').fadeOut(1500); </script>";
					
					$msg_e = "* Oooooooooops error, your admin authorization password is invalid.";
					
				}else {  /* remove information */  
						
		 			try {

						require  $wizGradeClassConfigDir;   /* include class configuration script */
							
						$conn->beginTransaction();   /* begin transaction */		
						
						list($rawC, $rawNum) = explode('_', $rawCC);
						
						$rawCT = $rawC.'_t_'.$rawNum;
						$rawCP = $rawC.'_p_'.$rawNum;
						$rawCom = $rawC.'_c_'.$rawNum; 

						$ebele_mark = "DELETE FROM $wizGradeConfigTB 
										
										WHERE cf_id = :cf_id
										
										AND  cf_raw = :cf_raw
										
										AND  cf_level = :cf_level
										
										LIMIT 1";
																
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':cf_id', $subjID);
						$igweze_prep->bindValue(':cf_raw', $rawCC);					
						$igweze_prep->bindValue(':cf_level', $level);	
						$igweze_prep->execute();
						
						$ebele_mark_1 = "ALTER TABLE $sdoracle_score_nk DROP $rawCC";
						$igweze_prep_1 = $conn->prepare($ebele_mark_1);
						$igweze_prep_1->execute();
						
						$ebele_mark_2 = "ALTER TABLE $sdoracle_sub_score_nk DROP $rawCT";						
						$igweze_prep_2 = $conn->prepare($ebele_mark_2);
						$igweze_prep_2->execute();
						
						$ebele_mark_3 = "ALTER TABLE $sdoracle_grade_nk DROP $rawCP";
						$igweze_prep_3 = $conn->prepare($ebele_mark_3);
						$igweze_prep_3->execute();
						
						$ebele_mark_4 = "ALTER TABLE $sdoracle_comment_nk DROP $rawCom";
						$igweze_prep_4 = $conn->prepare($ebele_mark_4);
						$igweze_prep_4->execute();
						
						
						if (($igweze_prep == true) && ($igweze_prep_1 == true) && ($igweze_prep_2 == true) && ($igweze_prep_3 == true)
							&& ($igweze_prep_4 == true)){  /* if sucessfully */ 	

							if($term == $fiVal) {  /* check subject term */
								
								$subjRow = 'cfRow-'.$subjID;
							
							}elseif($term == $seVal) {  /* check subject term */
									
									$subjRow = 'csRow-'.$subjID; 
	
							}elseif($term == $thVal) {  /* check subject term */
	
									$subjRow = 'ctRow-'.$subjID;
							
							}else{ 
									
									$subjRow = 'cfRow-'.$subjID; 
									
							} 
							
							$conn->commit();   /* renove all information */
							$schoolTerm = schoolTerm($term);
							
							$msg_s = "Subject information with Code <strong>$courseCode</strong> and title <strong>$courseTitle</strong> 
							was successfully remove from <strong>$schoolTerm term</strong>. Thanks";
							 echo $succMsg.$msg_s.$msgEnd; echo $scrollUp; //exit; 	

							echo "<script type='text/javascript'>  
								
								 $('#".$subjRow."').fadeOut(1000);;
								 $('#subj-loader').fadeOut(1500);
								 $('#adminPass').val('');
					
								</script>";

							exit;			
							 
																					 
					    }else{  /* display error */ 
						
							echo "<script type='text/javascript'>  $('#subj-loader').fadeOut(1500); </script>";

							$conn->rollBack();   /* roll back insertion */
	                    	$msg_e = "Oooooooops Error, Subject information with Code <strong>$courseCode</strong> and title <strong>$courseTitle</strong> 
							 was not successfully removed. Please try again!!!"; 
							
					    } 								
								
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
         		
        		}
        
			}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			} 
			
			if ($msg_s) {

				echo $succMsg.$msg_s.$msgEnd ; echo $scrollUp; exit; 				
										
			}	


			if ($msg_e) {

				echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; exit;  
										
			}	
			
exit;
?>