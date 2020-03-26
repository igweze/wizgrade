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
	This script handle school setup configurations
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configINwizGrade.php';  /* load wizGrade configuration files */	 
		 

			if (($_REQUEST['schoolSettings']) == 'schoolLogo') {  /* save school logo */		
					
				$picturePath = $sch_logo_path; /* picture path */
				
				$filePic = "uploadPic"; /* picture file name */
				$pageDesc = "School logo picture";
				
				/* call igweze file uploader */
				$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 2), $validPicExt, $validPicType, $allowedPicExt, $fileType = "Picture", $fiVal); 
				 
				if (is_array($uploadPicData['error'])) {  /* check if any upload error */
					 
					$msg_e = '';
					  
					foreach ($uploadPicData['error'] as $msg) {
						$msg_e .= $msg.'<br />';     /* display error messages */
					}
					echo "<img src=''   height = '1' width='1'> ";
					echo $errorMsg.$msg_e.$eEnd; exit;
				  
				  
				} else {
					
					$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
					
					if ($uploadedPic != "") {
							
						if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
								
								
							try {
							
								$ebele_mark = "UPDATE $wizGradeSchoolTB SET
								 
													school_logo = :school_logo
													
													WHERE school_id = :school_id";
													
								$igweze_prep = $conn->prepare($ebele_mark);									
								$igweze_prep->bindValue(':school_logo', $uploadedPic);
								$igweze_prep->bindValue(':school_id', $fiVal);

								if($igweze_prep->execute()){  /* insert picture name to database */
										 
									echo "<img src=''   height = '1' width='1'> ";
									$msg_s = "$pageDesc was successfully uploaded";									
									echo $succesMsg.$msg_s.$sEnd ;  echo $scrollUp; 	
									echo "<script type='text/javascript'> $('.pictureUploader').fadeOut(1500); </script>";  exit;									

								}else{ /* display error messages */

									echo "<img src=''   height = '1' width='1'> ";
									$msg_e = "Ooooooooooops, an error has occur while trying to save $pageDesc.
									Please try again or check your network connection!!!";
									echo $errorMsg.$msg_e.$eEnd;exit;

								}


							}catch(PDOException $e) {

									wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

							}
							  
							  
						}else{ /* display error messages */
								
								echo "<img src=''   height = '1' width='1'> ";
								$msg_e = "Ooooooooooops, an error has occur while trying to save $pageDesc.
								Please try again or check your network connection!!!";
								echo $errorMsg.$msg_e.$eEnd; exit;

							  
						}
							
					}else{ /* display error messages */
						
							echo "<img src=''   height = '1' width='1'> ";
							$msg_e = "Ooooooooooops, an error has occur while trying to save $pageDesc.
							Please try again or check your network connection!!!";
							echo $errorMsg.$msg_e.$eEnd; exit;							

					}	
					
					
				} 
						
			
			}elseif (($_REQUEST['schoolSettings']) == 'schoolSettings') {  /* save school settings */	

				$schoolName =  preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['schoolName']);
				$schoolAddress =  preg_replace("/[^A-Za-z0-9'.# ]/", "", $_REQUEST['schoolAddress']);
				$regPrefix =  strtoupper(preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['regPrefix']));
				$schoolCutoff =  preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['schoolCutoff']);
				$schoolHead =  preg_replace("/[^A-Za-z0-9,']/", "", $_REQUEST['schoolHead']);
				$bursary =  preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['bursary']);
				$libraian =  preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['libraian']);
				$transFrom =  strip_tags($_REQUEST['transFrom']);
				$transTo =  strip_tags($_REQUEST['transTo']);
				$sTime = preg_replace("/[^0-9]/", "", $_REQUEST['sTime']);
				$ewallet = preg_replace("/[^0-9]/", "", $_REQUEST['ewallet']);
				
				/* script validation */
				
				if ($schoolName == "")  {
         			
					$msg_e = "Oooooops Error, please input your schoool name";
					
	   			}elseif ($schoolAddress == "")  {
         			
					$msg_e = "Oooooops Error, please input your school address";
						
	   			//}elseif ($regPrefix == "")  {
         			
					//$msg_e = "Oooooops Error, please input your school Reg No Prefix";
						
	   			}elseif (($schoolCutoff == "")  || ($schoolCutoff >= 100) || ($schoolCutoff <= $i_false)){
         			
					$msg_e = "Oooooops Error, please input a correct percentage for automated student end of term promotion. eg 40";
						
	   			}elseif ($schoolHead == "")  {
         			
					$msg_e = "Oooooops Error, please input school head/s";
						
	   			}elseif ($bursary == "")  {
         			
					$msg_e = "Oooooops Error, please input school bursary";
						
	   			}elseif ($libraian == "")  {
         			
					$msg_e = "Oooooops Error, please input school libraian";
						
	   			}elseif (($transFrom != "") && ($transTo == "")){
         			
					$msg_e = "Oooooops Error, please select language to translate To";
						
	   			}elseif (($transFrom == "") && ($transTo != "")){
         			
					$msg_e = "Oooooops Error, please select language to translate From";
						
	   			}elseif ($ewallet == ""){
         			
					$msg_e = "Oooooops Error, please select an e-wallet setting";
						
	   			}else {  /* update information */

						
						if (($transFrom != "") && ($transTo != "")){
							$translator = $transFrom.'/'.$transTo;
						}else{ $translator = "en/en"; } 
						
						try {		 			

								$schoolArray = wizGradeSchool($conn);  /* school configuration setup array  */

								$ebele_mark = "UPDATE $wizGradeSchoolTB SET
							 
                						 		school_name = :school_name,
												school_address = :school_address,												
												school_cutoff = :school_cutoff,
												school_head = :school_head,
												bursary = :bursary,
												libraian = :libraian,
												translator = :translator,
												screen_timer = :screen_timer,
												ewallet = :ewallet
												
                 								WHERE school_id = :school_id";
												
								$igweze_prep = $conn->prepare($ebele_mark);									
								$igweze_prep->bindValue(':school_name', $schoolName);
								$igweze_prep->bindValue(':school_address', $schoolAddress);
								//$igweze_prep->bindValue(':reg_prefix', $regPrefix); reg_prefix = :reg_prefix,
								$igweze_prep->bindValue(':school_cutoff', $schoolCutoff);
								$igweze_prep->bindValue(':school_head', $schoolHead);
								$igweze_prep->bindValue(':bursary', $bursary);
								$igweze_prep->bindValue(':libraian', $libraian);
								$igweze_prep->bindValue(':translator', $translator);
								$igweze_prep->bindValue(':screen_timer', $sTime);
								$igweze_prep->bindValue(':ewallet', $ewallet);
								$igweze_prep->bindValue(':school_id', $fiVal);
								$igweze_prep->execute();
								
								$schHeadID = $schoolArray[0]['school_head'];
								$libraianID = $schoolArray[0]['libraian'];
								$bursaryID = $schoolArray[0]['bursary'];
								
								//$randomSchHead  = wizGradeRandomString($charset, 5);							
								//$newSchHeadID = 'staff'.$schHeadID.$randomSchHead;
								
		
								if($schHeadID != ""){  /* check school head is empty  */
									
									$ebele_mark_1 = "UPDATE $staffTB SET
								 
													t_grade = :t_grade
													
													WHERE t_grade = :t_g";
													
									$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
									$igweze_prep_1->bindValue(':t_grade', $i_false);
									$igweze_prep_1->bindValue(':t_g', $schHeadGradeInt);
									$igweze_prep_1->execute();
									
								}
								
								list ($nurseryHead, $primaryHead, $secondaryHead) = explode (",", $schoolHead);	
															
								if($nurseryHead != ""){  /* check nursery school head is empty  */
									
									$ebele_mark_2 = "UPDATE $staffTB SET
								 
													t_grade = :t_grade 
													
													WHERE t_id = :t_id";
													
									$igweze_prep_2 = $conn->prepare($ebele_mark_2);	
									$igweze_prep_2->bindValue(':t_grade', $schHeadGradeInt);
									$igweze_prep_2->bindValue(':t_id', $nurseryHead);
									$igweze_prep_2->execute();	
									
								}
								
								if($primaryHead != ""){  /* check primary school head is empty  */
									
									$ebele_mark_2_1 = "UPDATE $staffTB SET
								 
													t_grade = :t_grade 
													
													WHERE t_id = :t_id";
													
									$igweze_prep_2_1 = $conn->prepare($ebele_mark_2_1);	
									$igweze_prep_2_1->bindValue(':t_grade', $schHeadGradeInt);
									$igweze_prep_2_1->bindValue(':t_id', $primaryHead);
									$igweze_prep_2_1->execute();	
									
								}
								
								if($secondaryHead != ""){  /* check secondary school head is empty  */
									
									$ebele_mark_2_2 = "UPDATE $staffTB SET
								 
													t_grade = :t_grade 
													
													WHERE t_id = :t_id";
													
									$igweze_prep_2_2 = $conn->prepare($ebele_mark_2_2);	
									$igweze_prep_2_2->bindValue(':t_grade', $schHeadGradeInt);
									$igweze_prep_2_2->bindValue(':t_id', $secondaryHead);
									$igweze_prep_2_2->execute();	
									
								}
		
								if($bursaryID != ""){  /* check bursary is empty  */
									
									$ebele_mark_3 = "UPDATE $staffTB SET
								 
													t_grade = :t_grade 
													
													WHERE t_id = :t_id";
													
									$igweze_prep_3 = $conn->prepare($ebele_mark_3);	
									$igweze_prep_3->bindValue(':t_grade', $i_false); 
									$igweze_prep_3->bindValue(':t_id', $bursaryID);
									$igweze_prep_3->execute();
									
								}

								$ebele_mark_4 = "UPDATE $staffTB SET
							 
                						 		t_grade = :t_grade 
												
                 								WHERE t_id = :t_id";
												
								$igweze_prep_4 = $conn->prepare($ebele_mark_4);	
								$igweze_prep_4->bindValue(':t_grade', $bursaryGradeInt); 
								$igweze_prep_4->bindValue(':t_id', $bursary);
								$igweze_prep_4->execute();
								
		
								if($libraianID != ""){  /* check libraian is empty  */
									
									$ebele_mark_5 = "UPDATE $staffTB SET
								 
													t_grade = :t_grade 
													
													WHERE t_id = :t_id";
													
									$igweze_prep_5 = $conn->prepare($ebele_mark_5);	
									$igweze_prep_5->bindValue(':t_grade', $i_false); 
									$igweze_prep_5->bindValue(':t_id', $libraianID);
									$igweze_prep_5->execute();
									
								}

								$ebele_mark_6 = "UPDATE $staffTB SET
							 
                						 		t_grade = :t_grade 
												
                 								WHERE t_id = :t_id";
												
								$igweze_prep_6 = $conn->prepare($ebele_mark_6);	
								$igweze_prep_6->bindValue(':t_grade', $libraryGradeInt); 
								$igweze_prep_6->bindValue(':t_id', $libraian);
								$igweze_prep_6->execute();
								
							


							}catch(PDOException $e) {
						
									wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
						 
							}
		
		
						if (($igweze_prep) && ($igweze_prep_2) && ($igweze_prep_4) && ($igweze_prep_6)){  /* if sucessfully */ 

							$msg_s = "School configuration was successfully saved.";
							
							unset($_SESSION['screenTimer']); 
							unset($_SESSION['lastADMINActivity']);
							
							$_SESSION['screenTimer'] = $sTime; 
							$_SESSION['lastADMINActivity'] = time();
							

$script =<<<IGWEZE
							<script type="text/javascript">

							$("#top-school-name").html("$schoolName");
							$('#frmschoolSettings').slideUp(2000);
							</script>

IGWEZE;
				echo $script;
						
        				}else {  /* display error */ 

							$msg_e = "Ooooooops, An Error Has occur
							while trying to save school settings, please try again";

        		
						}

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'wizGradeColor') {  /* save school theme */	

				$themeColor =  preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['themeColorID']);
				
				/* script validation */ 
				
				if ($themeColor == "")  {
         			
					$msg_e = "Oooooops Error, please select a color theme for your school";
					
	   			}else {  /* update information */

		 			try {
		 			
						$ebele_mark = "UPDATE $wizGradeSchoolTB SET
					 
										school_theme = :school_theme
										
										WHERE school_id = :school_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);									
						$igweze_prep->bindValue(':school_theme', $themeColor);
						$igweze_prep->bindValue(':school_id', $fiVal);
						
						if ($igweze_prep->execute()) { /* if sucessfully */ 

								$msg_s = "School Theme was Successfully change. Please wait  . . . .  Page Refreshing";
								 echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */ $('.pageRefresh').trigger('click');</script>"; exit;
							
						}else {  /* display error */

								$msg_e = "Ooooooops, An Error Has occur
								while trying to change school theme, please try again";										
								echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */  </script>"; exit;

						} 
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}

        		}
        
			}elseif (($_REQUEST['currentSess']) == 'currentSession') {  /* save school current session */	

				$sessionID =  preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['sess']);
				$termID =  preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['term']);

				/* script validation */ 
				
				if ($sessionID == "")  {
         			
					$msg_e = "Oooooops Error, please select a school current session";
					
	   			}elseif ($termID == "")  {
         			
					$msg_e = "Oooooops Error, please select a school current term";
					
	   			}else {  /* update information */

		 			try {
		 			
						$ebele_mark = "UPDATE $schoolSessionTB SET
					 
										current = :current,
										cur_term = :cur_term
										
										WHERE current = :currentS";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
						
						$igweze_prep->bindValue(':current', $i_false);
						$igweze_prep->bindValue(':cur_term', '');
						$igweze_prep->bindValue(':currentS', $fiVal);
						$igweze_prep->execute();
						
						

						$ebele_mark_3 = "UPDATE $schoolSessionTB SET
					 
										current = :current,
										cur_term = :cur_term
										
										WHERE id_sess = :id_sess";
										
						$igweze_prep_3 = $conn->prepare($ebele_mark_3);	
						
						$igweze_prep_3->bindValue(':current', $fiVal);
						$igweze_prep_3->bindValue(':cur_term', $termID);
						$igweze_prep_3->bindValue(':id_sess', $sessionID);
						$igweze_prep_3->execute(); 
		
						if (($igweze_prep) && ($igweze_prep_3)) {  /* if sucessfully */

							$msg_s = "Current School Session was Successfully Saved.";
							echo "<script type='text/javascript'>  $('#frmcurrentSession').slideUp(2000);  </script>";
						
        				}else { /* display error */

							$msg_e = "Ooooooops, An Error Has occur
							while trying to save Current School Session, please try again";
							echo $erroMsg.$msg_e.$msgEnd; 
							echo"<script type='text/javascript'>  $('.configLoading').fadeOut(4000); </script>";exit;

						} 

					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}						

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'EditRemarks') {  /* load student remarks */

				$remarks =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Remarks']);
				$remarkID =  $_REQUEST['remarkID'];
				
				/* script validation */ 
				
				if ($remarkID== "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrive remarks infomation. please try again";
					
	   			}else {  /* load student remarks input */
					
					$frmRemark= "frmRemark-".$remarkID;
					
					echo '<div class="iconic-input">
                                              <i class="fa fa-user"></i>
                                              <input type="text" class="form-control" id="'.$frmRemark.'" value="'.$remarks.'"
                                              name="'.$frmRemark.'" />
                          </div>';
					echo "<script type='text/javascript'>  
						$('#Update-$remarkID').fadeIn(100); 
						$('#Edit-$remarkID').fadeOut(100);
						$('#msgBoxDiv-$remarkID').fadeOut(100);
						
						</script>";	  

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'SaveRemarks') {  /* save student remarks */

				$remarks =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Remarks']);
				$remarkID =  $_REQUEST['remarkID'];
				
				/* script validation */ 
				
				if ($remarks == "") {
         			
					$msg_e = "Oooooops Error, please input a word for Teacher's Remark";
					echo $errorMsg.$msg_e.$eEnd;
					
	   			}else {  /* insert/update information */


		 			try {

								$ebele_mark = "INSERT INTO $tRemarksTB (remarks)

											VALUES (:remarks)";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);
  								$igweze_prep->bindValue(':remarks', $remarks); 								
							
								$ShowRemark = "<i class='fa fa-user'></i> $remarks";
		
								if ($igweze_prep->execute()) {  /* if sucessfully */ 

$script =<<<IGWEZE
									<script type="text/javascript">  
									$("#editDiv-$remarkID").html("$ShowRemark");
									$("#Edit-$remarkID").fadeIn(100); 
									$("#Remove-$remarkID").fadeIn(100);
									$("#Save-$remarkID").fadeOut(100);
									$('#msgBoxDiv-$remarkID').fadeOut(100);
									</script>
		
IGWEZE;
									echo $script;
				
						
								}else {  /* display error */

										$msg_e = "Ooooooops, An 
										Error occur while trying to save teacher's remark, please try again";

								}
				
					}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'UpdateRemarks') {  /* update student remarks */

				$remarks =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Remarks']);
				$remarkID =  $_REQUEST['remarkID'];
				
				/* script validation */
				
				if ($remarks == "") {
         			
					$msg_e = "Oooooops Error, please input a word for Teacher's Remark";
					echo $errorMsg.$msg_e.$eEnd;
					
	   			}else {  /* update information */ 


		 			try {

								$ebele_mark = "UPDATE $tRemarksTB 
                                				
                                                SET remarks = :remarks
                                                
                                                WHERE id_rem = :id_rem";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);
  								$igweze_prep->bindValue(':remarks', $remarks);
                                $igweze_prep->bindValue(':id_rem', $remarkID);
								
								$ShowRemark = "<i class='fa fa-user'></i> $remarks";
		
		
								if ($igweze_prep->execute()) {  /* if sucessfully */ 

$script =<<<IGWEZE
									<script type="text/javascript">  
									$("#editDiv-$remarkID").html("$ShowRemark");
									$("#Update-$remarkID").fadeOut(100); 
									$("#Edit-$remarkID").fadeIn(100);
									$("#Save-$remarkID").fadeOut(100);
									$('#msgBoxDiv-$remarkID').fadeOut(100);
									</script>
		
IGWEZE;
									echo $script;
						
								}else {  /* display error */ 

										$msg_e = "Ooooooops, An 
										Error occur while trying to update teacher's remark, please try again";


								}
				
					}catch(PDOException $e) {
					
								wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
					}

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'RemoveRemarks') {  /* remove student remarks */

				$remarkID =  strip_tags($_REQUEST['remarkID']);
				
				/* script validation */ 
				
				if ($remarkID == "") {
         			
					$msg_e = "Ooooooops, An 
						Error occur while trying to remove teacher's remark, please try again";
					
	   			}else {  /* remove information */ 

		 			try {

						$ebele_mark = "DELETE FROM $tRemarksTB 
										
										WHERE id_rem = :id_rem
										
										LIMIT 1";
			 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':id_rem', $remarkID);
						
						if($igweze_prep->execute()){  /* if sucessfully */

								echo "<script type='text/javascript'>  
								$('#DivRow-$remarkID').fadeOut(1000);
								$('#msgBoxDiv-$remarkID').fadeOut(100);
								</script>";							
								
						}else {  /* display error */ 

								$msg_e = "Ooooooops, An 
								Error occur while trying to remove teacher's remark, please try again";

						}
							
								
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		
		
         		

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'EditDisability') {  /* load disability */

				$disability =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Disability']);
				$disabilityID =  $_REQUEST['disabilityID'];
				
				/* script validation */ 
				
				if ($disabilityID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrive disabilitys infomation. please try again";
					
	   			}else {  /* load disability form input */
					
					$frmDisability = "frmDisability-".$disabilityID;
					
					echo '<div class="iconic-input">
                                              <i class="fa fa-medkit"></i>
                                              <input type="text" class="form-control" id="'.$frmDisability.'" value="'.$disability.'"
                                              name="'.$frmDisability.'" />
                          </div>';
					echo "<script type='text/javascript'>  
						$('#Update-$disabilityID').fadeIn(100); 
						$('#Edit-$disabilityID').fadeOut(100);
						$('#msgBoxDiv-$disabilityID').fadeOut(100);
						</script>";	  

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'SaveDisability') {  /* edit disability */

				$disability =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Disability']);
				$disabilityID =  $_REQUEST['disabilityID'];
				
				/* script validation */ 
				
				if ($disability == "") {
         			
					$msg_e = "Oooooops Error, please input a word for Student's Disability";
					
	   			}else {  /* insert information */ 


		 			try {

								$ebele_mark = "INSERT INTO $disabilityTB (disability)

											VALUES (:disability)";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);

  								$igweze_prep->bindValue(':disability', $disability);
								
								$ShowDisability = "<i class='fa fa-medkit'></i> $disability";
								
								if($igweze_prep->execute()){  /* if sucessfully */

$script =<<<IGWEZE
									<script type="text/javascript">  
									$("#editDiv-$disabilityID").html("$ShowDisability");
									$("#Edit-$disabilityID").fadeIn(100); 
									$("#Remove-$disabilityID").fadeIn(100);
									$("#Save-$disabilityID").fadeOut(100);
									$('#msgBoxDiv-$disabilityID').fadeOut(100);
									</script>
		
IGWEZE;
									echo $script;
						
						
								}else {  /* display error */

										$msg_e = "Ooooooops, An 
										Error occur while trying to save student disability data, please try again";

								}
								
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
					
					
        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'UpdateDisability') {  /* update disability */

				$disability =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Disability']);
				$disabilityID =  $_REQUEST['disabilityID'];
				
				/* script validation */ 
				
				if ($disability == "") {
         			
					$msg_e = "Oooooops Error, please input a word for Student's Disability";
					
	   			}else {  /* update information */ 


		 			try {

								$ebele_mark = "UPDATE $disabilityTB 
                                				
                                                SET disability= :disability
                                                
                                                WHERE id_dis = :id_dis";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);

  								$igweze_prep->bindValue(':disability', $disability);
                                $igweze_prep->bindValue(':id_dis', $disabilityID);
							
								$ShowDisability = "<i class='fa fa-user'></i> $disability";
								
								if($igweze_prep->execute()){  /* if sucessfully */

$script =<<<IGWEZE
									<script type="text/javascript">  
									$("#editDiv-$disabilityID").html("$ShowDisability");
									$("#Update-$disabilityID").fadeOut(100); 
									$("#Edit-$disabilityID").fadeIn(100);
									$("#Save-$disabilityID").fadeOut(100);
									$('#msgBoxDiv-$disabilityID').fadeOut(100);
									</script>
		
IGWEZE;
									echo $script;
						
						
								}else {  /* display error */

										$msg_e = "Ooooooops, An 
										Error occur while trying to update student disability data, please try again";


								}
								
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}			

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'RemoveDisability') {  /* remove disability */

				$disabilityID =  $_REQUEST['disabilityID'];
				
				/* script validation */ 
				
				if ($disabilityID == "") {
         			
					$msg_e = "Ooooooops, An 
						Error occur while trying to remove student disability data, please try again";
					
	   			}else {  /* remove information */


		 			try {

						$ebele_mark = "DELETE FROM $disabilityTB 
										
										WHERE id_dis = :id_dis
										
										LIMIT 1";
			 
						$igweze_prep = $conn->prepare($ebele_mark);

						$igweze_prep->bindValue(':id_dis', $disabilityID);
						
						if($igweze_prep->execute()){  /* if sucessfully */

								echo "<script type='text/javascript'>  
								$('#DivRow-$disabilityID').fadeOut(1000);
								$('#msgBoxDiv-$disabilityID').fadeOut(100);
								</script>";							
								
						}else {  /* display error */

								$msg_e = "Ooooooops, An 
								Error occur while trying to remove student disability data, please try again";


						}
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}			

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'EditClub') {  /* load school club */

				$club =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Club']);
				$clubID =  $_REQUEST['clubID'];
				
				/* script validation */ 
				
				if ($clubID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrive student organization infomation. please try again";
					
	   			}else {  /* load school club form input */
					
					$frmClub= "frmClub-".$clubID;
					
					echo '<div class="iconic-input">
                                              <i class="fa fa-users"></i>
                                              <input type="text" class="form-control" id="'.$frmClub.'" value="'.$club.'"
                                              name="'.$frmClub.'" />
                          </div>';
					echo "<script type='text/javascript'>  
						$('#Update-$clubID').fadeIn(100); 
						$('#Edit-$clubID').fadeOut(100);
						$('#msgBoxDiv-$clubID').fadeOut(100);
						</script>";	  

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'SaveClub') {  /* edit school club */

				$club =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Club']);
				$clubID =  $_REQUEST['clubID'];
				
				/* script validation */ 

				if ($club == "") {
         			
					$msg_e = "Oooooops Error, please input a word for Student's Organization";
					
	   			}else {  /* insert information */ 


		 			try {

								$ebele_mark = "INSERT INTO  $schoolClubTB (club)

											VALUES (:club)";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);

  								$igweze_prep->bindValue(':club', $club);
 								
								$ShowClub = "<i class='fa fa-users'></i> $club";
		
								if($igweze_prep->execute()){  /* if sucessfully */

$script =<<<IGWEZE
									<script type="text/javascript">  
									$("#editDiv-$clubID").html("$ShowClub");
									$("#Edit-$clubID").fadeIn(100); 
									$("#Remove-$clubID").fadeIn(100);
									$("#Save-$clubID").fadeOut(100);
									$('#msgBoxDiv-$clubID').fadeOut(100);
									</script>
		
IGWEZE;
									echo $script;
						
						
								}else {  /* display error */

										$msg_e = "Ooooooops, An 
										Error occur while trying to save Student's Organization data, please try again";

								}
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}			

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'UpdateClub') {  /* update school club */

				$club =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Club']);
				$clubID =  $_REQUEST['clubID'];
				
				/* script validation */
				
				if ($club == "") {
         			
					$msg_e = "Oooooops Error, please input a word for Student's Organization";
					
	   			}else {  /* update information */


		 			try {

								$ebele_mark = "UPDATE  $schoolClubTB 
                                				
                                                SET club = :club
                                                
                                                WHERE club_id = :club_id";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);

  								$igweze_prep->bindValue(':club', $club);
                                $igweze_prep->bindValue(':club_id', $clubID);
							
								$ShowClub = "<i class='fa fa-users'></i> $club";
		
								if($igweze_prep->execute()){  /* if sucessfully */

$script =<<<IGWEZE
									<script type="text/javascript">  
									$("#editDiv-$clubID").html("$ShowClub");
									$("#Update-$clubID").fadeOut(100); 
									$("#Edit-$clubID").fadeIn(100);
									$("#Save-$clubID").fadeOut(100);
									$('#msgBoxDiv-$clubID').fadeOut(100);
									</script>
		
IGWEZE;
									echo $script;
						
						
								}else {  /* display error */

										$msg_e = "Ooooooops, An 
										Error occur while trying to update Student's Organization data, please try again";


								}
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
					
					
        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'RemoveClub') {  /* remove school club */

				$clubID =  $_REQUEST['clubID'];
				
				/* script validation */
				
				if ($clubID == "") {
         			
					$msg_e = "Ooooooops, An 
						Error occur while trying to remove Student's Organization data, please try again";
					
	   			}else {  /* remove information */


		 			try {

						$ebele_mark = "DELETE FROM  $schoolClubTB 
										
										WHERE club_id = :club_id
										
										LIMIT 1";
			 
						$igweze_prep = $conn->prepare($ebele_mark);

						$igweze_prep->bindValue(':club_id', $clubID);

						if($igweze_prep->execute()){  /* if sucessfully */

								echo "<script type='text/javascript'>  
								$('#DivRow-$clubID').fadeOut(1000);
								$('#msgBoxDiv-$clubID').fadeOut(100);
								</script>";							
								
						}else {  /* display error */

								$msg_e = "Ooooooops, An 
								Error occur while trying to remove Student's Organization data, please try again";


						}
								
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'EditClubPost') {  /* load school club position */

				$clubPost =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['ClubPost']);
				$clubPostID =  $_REQUEST['clubPostID'];
				
				/* script validation */ 
				
				if ($clubPostID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrive student organization infomation. please try again";
					
	   			}else {  /* load school club position form input */
					
					$frmClubPost= "frmClubPost-".$clubPostID;
					
					echo '<div class="iconic-input">
                                              <i class="fa fa-users"></i>
                                              <input type="text" class="form-control" id="'.$frmClubPost.'" value="'.$clubPost.'"
                                              name="'.$frmClubPost.'" />
                          </div>';
					echo "<script type='text/javascript'>  
						$('#Update-$clubPostID').fadeIn(100); 
						$('#Edit-$clubPostID').fadeOut(100);
						$('#msgBoxDiv-$clubPostID').fadeOut(100);
						</script>";	  

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'SaveClubPost') {  /* save school club position */

				$clubPost =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['ClubPost']);
				$clubPostID =  $_REQUEST['clubPostID'];
				
				/* script validation */ 
				
				if ($clubPost == "") {
         			
					$msg_e = "Oooooops Error, please input a word for Student's Organization Post";
					
	   			}else {  /* insert information */ 


		 			try {

								$ebele_mark = "INSERT INTO $schoolClubPostTB (club_post)

											VALUES (:club_post)";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);

  								$igweze_prep->bindValue(':club_post', $clubPost);
 								
								$ShowClubPost = "<i class='fa fa-users'></i> $clubPost";
		
								if($igweze_prep->execute()){  /* if sucessfully */

$script =<<<IGWEZE
									<script type="text/javascript">  
									$("#editDiv-$clubPostID").html("$ShowClubPost");
									$("#Edit-$clubPostID").fadeIn(100); 
									$("#Remove-$clubPostID").fadeIn(100);
									$("#Save-$clubPostID").fadeOut(100);
									$('#msgBoxDiv-$clubPostID').fadeOut(100);
									</script>
		
IGWEZE;
									echo $script;
						
						
								}else {  /* display error */

										$msg_e = "Ooooooops, An 
										Error occur while trying to save Student's Organization data, please try again";

								}
							
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
					

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'UpdateClubPost') {  /* update school club position */

				$clubPost =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['ClubPost']);
				$clubPostID =  $_REQUEST['clubPostID'];
				
				/* script validation */ 
				
				if ($clubPost == "") {
         			
					$msg_e = "Oooooops Error, please input a word for Student's Organization Post";
					
	   			}else {  /* update information */ 


		 			try {

								$ebele_mark = "UPDATE $schoolClubPostTB 
                                				
                                                SET club_post = :club_post
                                                
                                                WHERE club_id = :club_id";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);

  								$igweze_prep->bindValue(':club_post', $clubPost);
                                $igweze_prep->bindValue(':club_id', $clubPostID);
							
								$ShowClubPost = "<i class='fa fa-users'></i> $clubPost";
		
								if($igweze_prep->execute()){  /* if sucessfully */

$script =<<<IGWEZE
									<script type="text/javascript">  
									$("#editDiv-$clubPostID").html("$ShowClubPost");
									$("#Update-$clubPostID").fadeOut(100); 
									$("#Edit-$clubPostID").fadeIn(100);
									$("#Save-$clubPostID").fadeOut(100);
									$('#msgBoxDiv-$clubPostID').fadeOut(100);
									</script>
		
IGWEZE;
									echo $script;
						
						
								}else {  /* display error */

										$msg_e = "Ooooooops, An 
										Error occur while trying to update Student's Organization data, please try again"; 

								}
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}			

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'RemoveClubPost') {  /* remove school club position */

				$clubPostID =  $_REQUEST['clubPostID'];
				
				/* script validation */ 
				
				if ($clubPostID == "") {
         			
					$msg_e = "Ooooooops, An 
						Error occur while trying to remove Student's Organization data, please try again";
					
	   			}else {  /* remove information */

		 			try {

						$ebele_mark = "DELETE FROM $schoolClubPostTB 
										
										WHERE club_id = :club_id
										
										LIMIT 1";
			 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':club_id', $clubPostID);
						
						if($igweze_prep->execute()){  /* if sucessfully */

								echo "<script type='text/javascript'>  
								$('#DivRow-$clubPostID').fadeOut(1000);
								$('#msgBoxDiv-$clubPostID').fadeOut(100);
								</script>";							
								
						}else {  /* display error */

								$msg_e = "Ooooooops, An 
								Error occur while trying to remove Student's Organization data, please try again";


						}
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}	 

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'EditSport') {  /* load school sports */

				$sport =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Sport']);
				$sportID =  $_REQUEST['sportID'];
				
				/* script validation */
				
				if ($sportID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrive sport infomation. please try again";
					
	   			}else {  /* load school sports form input */
					
					$frmSport= "frmSport-".$sportID;
					
					echo '<div class="iconic-input">
                                              <i class="fa fa-users"></i>
                                              <input type="text" class="form-control" id="'.$frmSport.'" value="'.$sport.'"
                                              name="'.$frmSport.'" />
                          </div>';
					echo "<script type='text/javascript'>  
						$('#Update-$sportID').fadeIn(100); 
						$('#Edit-$sportID').fadeOut(100);
						$('#msgBoxDiv-$sportID').fadeOut(100);
						</script>";	  

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'SaveSport') {  /* save school sports */

				$sport =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Sport']);
				$sportID =  $_REQUEST['sportID'];
				
				/* script validation */
				
				if ($sport == "") {
         			
					$msg_e = "Oooooops Error, please input a word for Student's Sport";
					
	   			}else {  /* insert information */ 


		 			try {

								$ebele_mark = "INSERT INTO $sportsTB (sport)

											VALUES (:sport)";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);
  								$igweze_prep->bindValue(':sport', $sport);
							
								$ShowSport = "<i class='fa fa-users'></i> $sport";
								
				 	
		
		
								if($igweze_prep->execute()){  /* if sucessfully */

$script =<<<IGWEZE
									<script type="text/javascript">  
									$("#editDiv-$sportID").html("$ShowSport");
									$("#Edit-$sportID").fadeIn(100); 
									$("#Remove-$sportID").fadeIn(100);
									$("#Save-$sportID").fadeOut(100);
									$('#msgBoxDiv-$sportID').fadeOut(100);
									</script>
		
IGWEZE;
									echo $script;
						
						
								}else {  /* display error */

										$msg_e = "Ooooooops, An 
										Error occur while trying to save student sport, please try again";

								}
								
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}			
					

        		}
				
        
			}elseif (($_REQUEST['schoolSettings']) == 'UpdateSport') {  /* update school sports */

				$sport =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Sport']);
				$sportID =  $_REQUEST['sportID'];
				
				/* script validation */
				
				if ($sport == "") {
         			
					$msg_e = "Oooooops Error, please input a word for Student's Sport";
					
	   			}else {  /* /update information */ 


		 			try {

								$ebele_mark = "UPDATE $sportsTB 
                                				
                                                SET sport = :sport
                                                
                                                WHERE sport_id = :sport_id";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);

  								$igweze_prep->bindValue(':sport', $sport);
                                $igweze_prep->bindValue(':sport_id', $sportID);
							
								$ShowSport = "<i class='fa fa-users'></i> $sport";
								
				 	
		
		
								if($igweze_prep->execute()){  /* if sucessfully */

$script =<<<IGWEZE
									<script type="text/javascript">
									$("#editDiv-$sportID").html("$ShowSport");
									$("#Update-$sportID").fadeOut(100);
									$("#Edit-$sportID").fadeIn(100);
									$("#Save-$sportID").fadeOut(100);
									$('#msgBoxDiv-$sportID').fadeOut(100);
									</script>

IGWEZE;
									echo $script;

						
								}else {  /* display error */

										$msg_e = "Ooooooops, An 
										Error occur while trying to update student sport, please try again"; 

								}
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}			

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'RemoveSport') {  /* remove school sports */

				$sportID =  $_REQUEST['sportID'];
				
				/* script validation */
				
				if ($sportID == "") {
         			
					$msg_e = "Ooooooops, An 
						Error occur while trying to remove student sport, please try again";
					
	   			}else {  /* remove information */ 


		 			try {

						$ebele_mark = "DELETE FROM $sportsTB 
										
										WHERE sport_id = :sport_id
										
										LIMIT 1";
			 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':sport_id', $sportID);

						if($igweze_prep->execute()){  /* if sucessfully */

								echo "<script type='text/javascript'>  
								$('#DivRow-$sportID').fadeOut(1000);
								$('#msgBoxDiv-$sportID').fadeOut(100);
								</script>";							
								
						}else {  /* display error */

								$msg_e = "Ooooooops, An 
								Error occur while trying to remove student sport, please try again</span>"; 

						}
								
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}			

        		}
        
			}else{
			
					echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}


			
			if ($msg_s) {

				echo $succesMsg.$msg_s.$sEnd ; 
				echo"<script type='text/javascript'>  $('.configLoading').fadeOut(4000); </script>";
				echo $scrollUp; exit; 				
										
			}	


			if ($msg_e) {

				echo $errorMsg.$msg_e.$eEnd; 
				echo"<script type='text/javascript'>  $('.configLoading').fadeOut(4000); </script>";
				echo $scrollUp; exit; 			
				
										
			}	
			
exit;
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			/*elseif (($_REQUEST['schoolSettings']) == 'EditSession_fi') {

				
				$sessionID =  preg_replace("/[^0-9']/", "",  $_REQUEST['sessionID']);
				$fi_term =  preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['fiTerm']);
				
				if ($sessionID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrive sessions infomation. please try again";
					
	   			}else {
					
					$fiTerm = "fiTerm-".$sessionID;
					
					echo '<div class="input-group date form_datetime-component" data-date="2016-07-21" 
					data-date-format="dd MM">
                                              <input type="text" class="form-control" readonly="" size="4"
											  id="'.$fiTerm.'" value="'.$fi_term.'"
                                              name="'.$fiTerm.'" >
                                                <span class="input-group-btn">
                                                <button type="button" class="btn btn-danger date-set"><i 
												class="fa fa-calendar"></i></button>
                                                </span>
                                          </div>';

					echo "<script type='text/javascript'>  
						
						$('.form_datetime-component').datetimepicker({
				    	    format: 'dd MM',
							autoclose: true,
					        todayBtn: true,
					        pickerPosition: 'bottom-left',
							minView: 2, 
							pickTime: false,
							'update': new Date()
						});
						
						
						</script>";	  

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'EditSession_se') {

				
				$sessionID =  preg_replace("/[^0-9']/", "", $_REQUEST['sessionID']);
				$se_term =  preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['seTerm']);
				
				if ($sessionID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrive sessions infomation. please try again";
					
	   			}else {
					
					$seTerm = "seTerm-".$sessionID;
					

					echo '<div class="input-group date form_datetime-component" data-date="2016-07-21" 
					data-date-format="dd MM">
                                              <input type="text" class="form-control" readonly="" size="4"
											  id="'.$seTerm.'" value="'.$se_term.'"
                                              name="'.$seTerm.'" >
                                                <span class="input-group-btn">
                                                <button type="button" class="btn btn-danger date-set">
												<i class="fa fa-calendar"></i></button>
                                                </span>
                                          </div>';
					echo "<script type='text/javascript'>  
						
						$('.form_datetime-component').datetimepicker({
				    	    format: 'dd MM',
							autoclose: true,
					        todayBtn: true,
					        pickerPosition: 'bottom-left',
							minView: 2, 
							pickTime: false,
							'update': new Date()
						});
						
						
						</script>";	  


        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'EditSession_th') {

				
				$sessionID =  preg_replace("/[^0-9']/", "", $_REQUEST['sessionID']);
				$th_term =  preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['thTerm']);
				
				if ($sessionID == "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrive sessions infomation. please try again";
					
	   			}else {
					
					$thTerm = "thTerm-".$sessionID;
					

					echo '<div class="input-group date form_datetime-component" data-date="2016-07-21" 
					data-date-format="dd MM">
                                              <input type="text" class="form-control" readonly="" size="4"
											  id="'.$thTerm.'" value="'.$th_term.'"
                                              name="'.$thTerm.'" >
                                                <span class="input-group-btn">
                                                <button type="button" class="btn btn-danger date-set">
												<i class="fa fa-calendar"></i></button>
                                                </span>
                                          </div>';
					echo "<script type='text/javascript'>  

						$('#Update-$sessionID').fadeIn(100); 
						$('#Edit-$sessionID').fadeOut(100);
						$('#msgBoxDiv-$sessionID').fadeOut(100);

						$('.form_datetime-component').datetimepicker({
				    	    format: 'dd MM',
							autoclose: true,
					        todayBtn: true,
					        pickerPosition: 'bottom-left',
							minView: 2, 
							pickTime: false,
							'update': new Date()
						});
						
						
						</script>";	  


        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'UpdateSession_fi') {

				$sessionID =  preg_replace("/[^0-9']/", "",  $_REQUEST['sessionID']);
				$fi_term =  preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['fiTerm']);
				
				if ($fi_term == "") {
         			
					$msg_e = "* Empty Date";
					
	   			}else {


		 			try {

								$ebele_mark = "UPDATE $schoolSessionTB
                                				
                                                SET fi_term = :fi_term
                                                
                                                WHERE id_sess = :id_sess";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);

  								$igweze_prep->bindValue(':id_sess', $sessionID);
                                $igweze_prep->bindValue(':fi_term', $fi_term);
								
								if ($igweze_prep->execute()) {
						
										echo "<i class='fa fa-calendar'></i> $fi_term";	
									
										
								}else {

										$msg_e = "Ooooooops, An 
										Error occur while trying to update date, please try again";


								}

							
								
								
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		
		

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'UpdateSession_se') {

				$sessionID =  preg_replace("/[^0-9']/", "", $_REQUEST['sessionID']);
				$se_term =  preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['seTerm']);
				
				if ($se_term == "") {
         			
					$msg_e = "* Empty Date";
					
	   			}else {


		 			try {

								$ebele_mark = "UPDATE $schoolSessionTB
                                				
                                                SET se_term = :se_term
                                                
                                                WHERE id_sess = :id_sess";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);

  								$igweze_prep->bindValue(':id_sess', $sessionID);
                                $igweze_prep->bindValue(':se_term', $se_term);
								
								if ($igweze_prep->execute()) {
					
										echo "<i class='fa fa-calendar'></i> $se_term";	
															
										
								}else {

										$msg_e = "Ooooooops, An 
										Error occur while trying to update date, please try again";


								}
							
								
								
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		
		
         		

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'UpdateSession_th') {

				$sessionID =  preg_replace("/[^0-9']/", "", $_REQUEST['sessionID']);
				$th_term =  preg_replace("/[^A-Za-z0-9']/", "", $_REQUEST['thTerm']);
				
				if ($th_term == "") {
         			
					$msg_e = "* Empty Date";
					
	   			}else {


		 			try {

								$ebele_mark = "UPDATE $schoolSessionTB
                                				
                                                SET th_term = :th_term
                                                
                                                WHERE id_sess = :id_sess";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);

  								$igweze_prep->bindValue(':id_sess', $sessionID);
                                $igweze_prep->bindValue(':th_term', $th_term);
								
								if ($igweze_prep->execute()) {
					
									echo "<i class='fa fa-calendar'></i> $th_term";	
									echo "<script type='text/javascript'>  
											$('#Update-$sessionID').fadeOut(100); 
											$('#Edit-$sessionID').fadeIn(100);

											</script>";
								}else {

										$msg_e = "Ooooooops, An 
										Error occur while trying to update date, please try again";

								}
							
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		
		
         		

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'EditRanking') { 

				$Ranking =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Ranking']);
				$rankingID =  $_REQUEST['rankingID'];
				
				if ($rankingID== "") {
         			
					$msg_e = "Oooooooooops, an error occur while trying to retrive teacher's ranking infomation. please try again";
					
	   			}else {
					
					$frmRanking= "frmRanking-".$rankingID;
					
					echo '<div class="iconic-input">
                                              <i class="fa fa-users"></i>
                                              <input type="text" class="form-control" id="'.$frmRanking.'" value="'.$Ranking.'"
                                              name="'.$frmRanking.'" />
                          </div>';
					echo "<script type='text/javascript'>  
						$('#Update-$rankingID').fadeIn(100); 
						$('#Edit-$rankingID').fadeOut(100);
						$('#msgBoxDiv-$rankingID').fadeOut(100);
						</script>";	  

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'SaveRanking') {

				$Ranking =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Ranking']);
				$rankingID =  $_REQUEST['rankingID'];
				
				if ($Ranking == "") {
         			
					$msg_e = "Oooooops Error, please input a word for teacher's ranking";
					
	   			}else {


		 			try {

								$ebele_mark = "INSERT INTO  $staffRankingTB(ranking)

											VALUES (:ranking)";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);
  								$igweze_prep->bindValue(':ranking', $Ranking);							
								$ShowRanking = "<i class='fa fa-users'></i> $Ranking";
										
		
							if ($igweze_prep->execute()) {

$script =<<<IGWEZE
						<script type="text/javascript">  
						$("#editDiv-$rankingID").html("$ShowRanking");
						$("#Edit-$rankingID").fadeIn(100); 
						$("#Remove-$rankingID").fadeIn(100);
						$("#Save-$rankingID").fadeOut(100);
                        $('#msgBoxDiv-$rankingID').fadeOut(100);
						</script>
		
IGWEZE;
				echo $script;
						
						
							}else {

									$msg_e = "Ooooooops, An 
									Error occur while trying to save teacher's ranking data, please try again";

							}
				
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'UpdateRanking') {

				$Ranking =   preg_replace("/[^A-Za-z0-9' ]/", "", $_REQUEST['Ranking']);
				$rankingID =  $_REQUEST['rankingID'];
				
				if ($Ranking == "") {
         			
					$msg_e = "Oooooops Error, please input a word for teacher's ranking";
					
	   			}else {


		 			try {

								$ebele_mark = "UPDATE  $staffRankingTB
                                				
                                                SET ranking = :ranking
                                                
                                                WHERE rank_id = :rank_id";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);

  								$igweze_prep->bindValue(':ranking', $Ranking);
                                $igweze_prep->bindValue(':rank_id', $rankingID);
								$ShowRanking = "<i class='fa fa-users'></i> $Ranking";
		
								if ($igweze_prep->execute()) {

$script =<<<IGWEZE
						<script type="text/javascript">  
						$("#editDiv-$rankingID").html("$ShowRanking");
						$("#Update-$rankingID").fadeOut(100); 
						$("#Edit-$rankingID").fadeIn(100);
						$("#Save-$rankingID").fadeOut(100);
                        $('#msgBoxDiv-$rankingID').fadeOut(100);
						</script>
		
IGWEZE;
				echo $script;
						
						
								}else {

										$msg_e = "Ooooooops, An 
										Error occur while trying to update teacher's ranking data, please try again";


								}
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}			

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'RemoveRanking') {

				$rankingID =  $_REQUEST['rankingID'];
				
				if ($rankingID == "") {
         			
					$msg_e = "Ooooooops, An 
						Error occur while trying to remove teacher's ranking data, please try again";
					
	   			}else {


		 			try {

								$ebele_mark = "DELETE FROM  $staffRankingTB
                                
                                				WHERE rank_id = :rank_id
                                                
                                                LIMIT 1";
					 
 			    				$igweze_prep = $conn->prepare($ebele_mark);
                                $igweze_prep->bindValue(':rank_id', $rankingID);
								
								if ($igweze_prep->execute()) {

										echo "<script type='text/javascript'>  
										$('#DivRow-$rankingID').fadeOut(1000);
										$('#msgBoxDiv-$rankingID').fadeOut(100);
										</script>";							
										
								}else {

										$msg_e = "Ooooooops, An 
										Error occur while trying to remove teacher's ranking data, please try again";


								}
								
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}			

        		}
        
			}
*/			
?>

