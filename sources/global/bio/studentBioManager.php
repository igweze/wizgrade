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
	This page handle student profile validation
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
         
			if (($_REQUEST['profileData']) == 'saveStudentS1') {  /* save student profile */

				$regNum = strip_tags($_REQUEST['regNum']);
				$fname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['fname']);
				$mname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['mname']);
				$lname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['lname']);
				$sex =   preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['sex']);
				$dateofbirth = preg_replace("/[^A-Za-z0-9-]/", "", $_REQUEST['dob']);
				$bloodgr =   preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['bloodgr']);
				$genotype =   preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['genotype']);
				$disability =  $_REQUEST['disability'];

				/* script validation */ 
				
				if ($regNum == "")  {
         			
					$msg_e = "Oooooooops error, please refresh your page and if persists contact the developer. 
					Thanks";
					
	   			}elseif ($lname == "")  {
         		
					$msg_e .= "Please enter student first name ";
	   			
				}elseif($fname == "")   {
         		
					$msg_e  = "Please enter student' s last name  ";
	   			
				}elseif (($sex == "")) {
         		
					$msg_e = "Please select student' s gender ";
	   			
				}/*elseif ($dateofbirth == "") {
         		
					$msg_e = "Please enter student' s date of birth ";
	   			
				}elseif ($bloodgr == "") {
         		
					$msg_e = "Please enter student' s blood group";
	   			
				}elseif ($genotype == "") {
         		
					$msg_e = "Please enter student genotype";
	   			
				}*/else {  /* update information */ 



       				$fname = strip_tags($fname);  $mname = strip_tags($mname); $lname = strip_tags($lname);
       				$sex = strip_tags($sex);    $dateofbirth = strip_tags($dateofbirth);   

       				$fname = trim($fname);  $mname = trim($mname); $lname = trim($lname);
       				$sex = trim($sex);    $dateofbirth = trim($dateofbirth);  
					
					$loadNewName = "$lname $fname $mname";   

		 			try {
		 
							$regID = studentRegID($conn, $regNum);   /* student record ID  */
			
							$ebele_mark = "UPDATE $i_student_tb SET
							 
                						 		i_firstname = :i_firstname,
                 						 		i_midname = :i_midname,
                 						 		i_lastname = :i_lastname,
                 								i_gender = :i_gender,
                 								i_dob = :i_dob,
												bloodgp = :bloodgp,
												genotype = :genotype,
												disability = :disability
												
                 								WHERE ireg_id = :ireg_id";
												
								$igweze_prep = $conn->prepare($ebele_mark);	
								
								$igweze_prep->bindValue(':i_firstname', $fname);
								$igweze_prep->bindValue(':i_midname', $mname);
								$igweze_prep->bindValue(':i_lastname', $lname);
								$igweze_prep->bindValue(':i_gender', $sex);
								$igweze_prep->bindValue(':i_dob', $dateofbirth);
								$igweze_prep->bindValue(':bloodgp', $bloodgr);
								$igweze_prep->bindValue(':genotype', $genotype);
								$igweze_prep->bindValue(':disability', $disability);
								$igweze_prep->bindValue(':ireg_id', $regID); 
		
								if ($igweze_prep->execute()) {

										$msg_s = "Student Profile with <span>$pre_regnum $regNum </span>  Step 2 was Successfully Saved.";

$script =<<<IGWEZE
									<script type="text/javascript">

										//$("#loadNewName-$regNum").html("$loadNewName");
										$('#editBio2').slideUp(2000);
										
									</script>

IGWEZE;
									echo $script;
						
								}else {

									$msg_e = "Ooooooops, an error has occur while trying to retrieve student record. Please try again";

								}
				
					}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}

        		}
        
			}elseif (($_REQUEST['profileData']) == 'saveStudentS2') {  /* save student profile */

				$regNum = strip_tags($_REQUEST['regNum']);
				$country = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['country']);
                $state = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['state']);
				$lga = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['lga']);
				$add1 = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['add1']);
				$add2 = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['add2']);
				$city = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['city']);
				$studphone = preg_replace("/[^A-Za-z0-9+]/", "", $_REQUEST['studphone']);
				$email = preg_replace("/[^A-Za-z0-9.@]/", "", $_REQUEST['email']);
				$hostelID = $_REQUEST['hostel'];
				$routeID = $_REQUEST['route'];
				
				/* script validation */ 
				
	  			if ($regNum == "")  {
         			
					$msg_e = "Oooooooops error, please refresh your page and if persists contact the developer. 
                    Thanks ";
					
	   			}elseif (($country == "")) {
					
         			$msg_e = "Please select student nationality ";
					
	   			}elseif (($state == "")) {
					
         			$msg_e = "Please select student state ";
					
	   			}elseif($city == "")   {
					
         			$msg_e = "Please enter student city ";
					
	   			}elseif($add1 == "") {
					
         			$msg_e = "Please enter student parmanent address ";
					
	   			}else{  /* update information */ 

					
       				$country = strip_tags($country); $state = strip_tags($state); $lga = strip_tags($lga);
       				$city = strip_tags($city);  $add1 = strip_tags($add1);       $add2 = strip_tags($add2);
       				$studphone = strip_tags($studphone);      $email = strip_tags($email);     

       				$country = trim($country); $state = trim($state); $lga = trim($lga);
       				$city = trim($city);  $add1 = trim($add1);       $add2 = trim($add2);
       				$studphone = trim($studphone);      $email = trim($email);    

		 			try { 
  							
							$regID = studentRegID($conn, $regNum);   /* student record ID  */
		
							$ebele_mark = "UPDATE $i_student_tb SET 

											i_country = :i_country,
											i_state = :i_state,                 								
											i_city = :i_city,
											i_add_fi = :i_add_fi,
											i_add_se = :i_add_se,
											i_stu_phone = :i_stu_phone,
											i_email = :i_email,
											hostel = :hostel,
											route = :route 

											WHERE ireg_id = :ireg_id";
											
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':i_country', $country);
							$igweze_prep->bindValue(':i_state', $state);
							//$igweze_prep->bindValue(':i_lga', $lga); i_lga = :i_lga,
							$igweze_prep->bindValue(':i_city', $city);
							$igweze_prep->bindValue(':i_add_fi', $add1);
							$igweze_prep->bindValue(':i_add_se', $add2);
							$igweze_prep->bindValue(':i_stu_phone', $studphone);
							$igweze_prep->bindValue(':i_email', $email);
							$igweze_prep->bindValue(':hostel', $hostelID);
							$igweze_prep->bindValue(':route', $routeID);
							$igweze_prep->bindValue(':ireg_id', $regID); 
	
							if ($igweze_prep->execute()) {

								$msg_s = "Student Profile with <span>$pre_regnum $regNum </span> Step 3 was Successfully Saved.";
								echo "<script type='text/javascript'> $('#editBio3').slideUp(2000);  </script>";

							}else {

								$msg_e = "Ooooooops, an error has occur while trying to retrieve student record. Please try again";

							}
							
						}catch(PDOException $e) {
  			
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
						}		

        		}
        
			}elseif (($_REQUEST['profileData']) == 'sponsorData') {  /* save student profile */

				$regNum = strip_tags($_REQUEST['regNum']);
				$sponphone = preg_replace("/[^A-Za-z0-9+]/", "", $_REQUEST['sponphone']);
				$sponsor = preg_replace("/[^A-Za-z0-9& ]/", "", $_REQUEST['sponsor']);
				$sponadd = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['sponadd']);

				/* script validation */ 
				
      			if ($regNum == "")  {
         			
					$msg_e = "Oooooooops error, please refresh your page and if persists contact the developer. 
                    Thanks ";
					
	   			}elseif($sponsor == "")   {
					
         			$msg_e = "Please enter student' s sponsor name ";
					
	   			}elseif($sponphone == "")   {
					
         			$msg_e = "Please enter student' s sponsor phone number ";
					
	   			}elseif($sponadd == "")   {
					
         			$msg_e = "Please enter student' s sponsor address ";
	   
	  			} else {  /* update information */

       	
       				$sponsor = strip_tags($sponsor);
       				$sponphone = strip_tags($sponphone);  $sponadd = strip_tags($sponadd);

       				$sponsor = trim($sponsor);
       				$sponphone = trim($sponphone);  $sponadd = trim($sponadd);

		 			try {
		 				 														
							$regID = studentRegID($conn, $regNum);   /* student record ID  */
		
							$ebele_mark = "UPDATE $i_student_tb SET 
										
											i_sponsor = :i_sponsor,
											i_spo_phone = :i_spo_phone,
											i_spo_add = :i_spo_add


											WHERE ireg_id = :ireg_id";
											
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':i_sponsor', $sponsor);
							$igweze_prep->bindValue(':i_spo_phone', $sponphone);
							$igweze_prep->bindValue(':i_spo_add', $sponadd);
							$igweze_prep->bindValue(':ireg_id', $regID);
	
							if ($igweze_prep->execute()) {  /* if sucessfully */

								$msg_s = "Student Profile with <span>$pre_regnum $regNum</span> Sponsor Data was Successfully Saved.";
								echo "<script type='text/javascript'>$('#editBio4').slideUp(2000);  </script>";

							}else {  /* display error */

								$msg_e = "<span>Ooooooops, an error has occur while trying to retrieve student record. 
										Please try again</span>";

							}
								
								
					}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}

        		}
        
			}elseif (($_REQUEST['profileData']) == 'studentPic') {  /* save student profile picture */
			
						
 		   		$regNum = strip_tags($_REQUEST['regNum']);
				
				try { 
								
					$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */
					$session_fi = wizGradeSession($conn, $sessionID);  /* school session */
					
					$regID = studentRegID($conn, $regNum);   /* student record ID  */
					$session_se = $session_fi + $foreal;  
						
					$studentPath = $schoolPicDir.$session_fi.'_'.$session_se.'/';
					
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}	
				
				if (!file_exists($studentPath)) {  /* Check if path exists */
					mkdir($studentPath, 0777, true);   /* Create path if not */
				}

				$picturePath = $studentPath; /* picture path */
				
				$filePic = "uploadPic"; /* picture file name */
				$pageDesc = "Student picture";
				
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
								
								removeStudentPicture($conn, $regNum, $picturePath);

								$ebele_mark = "UPDATE $i_student_tb SET 
												
													i_stupic = :i_stupic

													WHERE ireg_id = :ireg_id";
													
								$igweze_prep = $conn->prepare($ebele_mark);	
								$igweze_prep->bindValue(':i_stupic', $uploadedPic);
								$igweze_prep->bindValue(':ireg_id', $regID);	 

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
				
 
			
			}elseif (($_REQUEST['profileData']) == 'classSettings') {  /* save student class */

				$regNum = strip_tags($_REQUEST['regNum']);
				$class_fi = strip_tags($_REQUEST['class_fi']);
				$class_se = strip_tags($_REQUEST['class_se']);
				$class_th = strip_tags($_REQUEST['class_th']);
				$class_fo = strip_tags($_REQUEST['class_fo']);
				$class_fif = strip_tags($_REQUEST['class_fif']);
				$class_six = strip_tags($_REQUEST['class_six']);

				/* script validation */ 
				
      			if ($regNum == "")  {
         			
					$msg_e = "Oooooooops error, please refresh your page and if persists contact the developer. 
                    Thanks ";
					
	   			} else {

					try {

							$regID = studentRegID($conn, $regNum);   /* student record ID  */
			
            				if($schoolExt == $wizGradeNurAbr){  /* check if school is nursery */
                            	
                                   $ebele_mark = "UPDATE $i_reg_tb SET 
                                                
                                                    class_1 = :class_1,
                                                    class_2 = :class_2,
                                                    class_3 = :class_3
                                                    
                                                    WHERE ireg_id = :ireg_id";
                                                    
                                    $igweze_prep = $conn->prepare($ebele_mark);    
                                    $igweze_prep->bindValue(':class_1', $class_fi);
                                    $igweze_prep->bindValue(':class_2', $class_se);
                                    $igweze_prep->bindValue(':class_3', $class_th);                                   
                                    $igweze_prep->bindValue(':ireg_id', $regID);								
                                
							}else{


                                   $ebele_mark = "UPDATE $i_reg_tb SET 
                                                
                                                    class_1 = :class_1,
                                                    class_2 = :class_2,
                                                    class_3 = :class_3,
                                                    class_4 = :class_4,
                                                    class_5 = :class_5,
                                                    class_6 = :class_6
                                                    
                                                    WHERE ireg_id = :ireg_id";
                                                    
                                    $igweze_prep = $conn->prepare($ebele_mark);    
                                    $igweze_prep->bindValue(':class_1', $class_fi);
                                    $igweze_prep->bindValue(':class_2', $class_se);
                                    $igweze_prep->bindValue(':class_3', $class_th);
                                    $igweze_prep->bindValue(':class_4', $class_fo);
                                    $igweze_prep->bindValue(':class_5', $class_fif);
                                    $igweze_prep->bindValue(':class_6', $class_six);
                                    $igweze_prep->bindValue(':ireg_id', $regID);								
                            
                            }
							
							if ($igweze_prep->execute()) {  /* if sucessfully */

									$msg_s = "Student Profile with <span>$pre_regnum $regNum </span> Class Infomation was Successfully Saved";
									echo "<script type='text/javascript'>  $('#editBio5').slideUp(2000);  </script>";									

							}else {  /* display error */ 

									$msg_e = "<span>Ooooooops, an error has occur
									where trying t0 save Class Settings.
									please try again</span>";

							}
				
					}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}

        		
				}
				
			
        
			}elseif (($_REQUEST['profileData']) == 'RSSession') {  /* move student to new session */
				exit;
				$regNum = strip_tags($_REQUEST['regNum']);
				$session = $_REQUEST['sess'];


		 		try {
							
							$sess_id = studentRegSessionID($conn, $regNum);
							$c_session_fi = wizGradeSession($conn, $sess_id);
							$sessionID = sessionID($conn, $session);	 				 														
						    $regID = studentRegID($conn, $regNum);   /* student record ID  */
							
							$c_session_se = $c_session_fi + $foreal;
							
							

					if ($regNum == "")  {
						
						$msg_e = "Oooooooops error, please refresh your page and if persists contact the developer. 
						Thanks ";
						
					}elseif($session == "")   {
						$msg_e = "Please select session to move student result to";
		   
					} elseif($sess_id < $sessionID)   {
					
						$msg_e = "Please select session which is higher or the same student current 
						$c_session_fi - $c_session_se session";
		   
					} else {


								$session_se = ($session + $foreal);
								if($sess_id == $sessionID){
								
								$s_status = $session_norm;
								$session_frm = '';
								
								}else{
								
								$s_status = $session_extr_yr;
								$session_frm = $sessionID;							
								
								} 
				
									$ebele_mark = "UPDATE $reg_tb SET 
												
													session_frm = :session_frm,
													
													s_status = :s_status

													WHERE ireg_id = :ireg_id";
													
									$igweze_prep = $conn->prepare($ebele_mark);	
								
									$igweze_prep->bindValue(':session_frm', $session_frm);
									$igweze_prep->bindValue(':s_status', $s_status);
									$igweze_prep->bindValue(':ireg_id', $regID);
			
									if ($igweze_prep->execute()) {

											$msg_s = "Student Profile with $pre_regnum $regNum result session was Successfully move to $session - $session_se session.";
											echo "<script type='text/javascript'>  $('#MoveSessionDiv').slideUp(2000);  </script>";
											echo "<script type='text/javascript'>  $('.successbox').fadeOut(15000);</script>"; 

									}else {

											$msg_e = "<span>Ooooooops, 
											An Error Has occur, please try again</span>";

									}

					}
				
				}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
				}	
        
			}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}


			
			if ($msg_s) {

				echo $succesMsg.$msg_s.$sEnd;
				echo "<script type='text/javascript'>  $('.studentLoader').fadeOut(3000);</script>"; exit;
										
			}	


			if ($msg_e) {

				echo $errorMsg.$msg_e.$eEnd;
				echo "<script type='text/javascript'>  $('.studentLoader').fadeOut(3000);</script>"; exit; 
				
										
			}	
			
exit;
?>