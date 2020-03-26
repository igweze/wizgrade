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
	This script handle admin profile validation
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configINwizGrade.php';  /* load wizGrade configuration files */	   


			if (($_REQUEST['adminData']) == 'saveStep1') {  /* save admin profile */ 

				$adminID = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['adminID']);
				$title = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['title']);
				$fname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['fname']);
				$mname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['mname']);
				$lname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['lname']);
				$sex =   preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['sex']);
				$dateofbirth = preg_replace("/[^A-Za-z0-9-]/", "", $_REQUEST['dob']);
				$bloodgr =   preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['bloodgr']);
				$genotype =   preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['genotype']);

				/* script validation */ 
				
				if ($adminID == "")  {
         			
					$msg_e = "* An Error has occured, Please refresh your page and if persists contact the developer. Thanks";					
					
	   			}elseif ($title == "")  {
         		
					$msg_e = "Oooooops Error, please enter admin title ";
	   			
				}elseif ($lname == "")  {
         		
					$msg_e = "Oooooops Error, please enter admin first name ";
	   			
				}elseif($fname == "")   {
         		
					$msg_e  = "Please enter admin last name  ";
	   			
				}elseif($sex == "") {
         		
					$msg_e = "Oooooops Error, please select admin gender ";
	   			
				}elseif ($dateofbirth == "") {
         		
					$msg_e = "Oooooops Error, please enter admin date of birth ";
	   			
				}elseif ($bloodgr == "") {
         		
					$msg_e = "Oooooops Error, please enter admin blood group";
	   			
				}elseif ($genotype == "") {
         		
					$msg_e = "Oooooops Error, please enter admin genotype";
	   			
				}else {  /* update information */ 

       				$fname = strip_tags($fname);  $mname = strip_tags($mname); $lname = strip_tags($lname);
       				$sex = strip_tags($sex);    $dateofbirth = strip_tags($dateofbirth);   

       				$fname = trim($fname);  $mname = trim($mname); $lname = trim($lname);
       				$sex = trim($sex);    $dateofbirth = trim($dateofbirth);    


		 			try {
		 
			
							$ebele_mark = "UPDATE $adminAccessTB SET
							 
                						 		a_title = :a_title,
												a_fname = :a_fname,
                 						 		a_mname = :a_mname,
                 						 		a_lname = :a_lname,
                 								a_gender = :a_gender,
                 								a_dob = :a_dob,
												bloodgp = :bloodgp,
												genotype = :genotype
												
                 								WHERE admin_id = :admin_id";
												
								$igweze_prep = $conn->prepare($ebele_mark);	
								$igweze_prep->bindValue(':a_title', $title);
								$igweze_prep->bindValue(':a_fname', $fname);
								$igweze_prep->bindValue(':a_mname', $mname);
								$igweze_prep->bindValue(':a_lname', $lname);
								$igweze_prep->bindValue(':a_gender', $sex);
								$igweze_prep->bindValue(':a_dob', $dateofbirth);
								$igweze_prep->bindValue(':bloodgp', $bloodgr);
								$igweze_prep->bindValue(':genotype', $genotype);
								$igweze_prep->bindValue(':admin_id', $adminID);
								
								if ($igweze_prep->execute()) {  /* if sucessfully */ 

									$msg_s = "Admin Profile was  Successfully Saved.";
									echo "<script type='text/javascript'> $('#editBio2').slideUp(2000);  </script>";
								
								}else {  /* display error */ 

									$msg_e = "<span>Ooooooops, 
									An Error Has occur while trying 
									to save Admin Profile, please try again</span>";

								}	
		


					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
         		
        		}
        
			}elseif (($_REQUEST['adminData']) == 'saveStep2') {  /* save admin profile */ 

				$adminID = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['adminID']);
				$country = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['country']);
                $state = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['state']);
				$lga = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['lga']);
				$add1 = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['add1']);
				$add2 = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['add2']);
				$city = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['city']);
				$studphone = preg_replace("/[^A-Za-z0-9+]/", "", $_REQUEST['i_phone']);
				$email = preg_replace("/[^A-Za-z0-9.@]/", "", $_REQUEST['email']);
				
				/* script validation */

	  			if ($adminID == "")  {
         			
					$msg_e = "* An Error has occured, Please refresh your page and if persists contact the developer. Thanks ";
					
	   			}elseif (($country == "")) {
					
         			$msg_e = "Oooooops Error, please select admin nationality ";
					
	   			} elseif (($state == "")) {
					
         			$msg_e = "Oooooops Error, please select admin state ";
					
	   			}  elseif($city == "")   {
					
         			$msg_e = "Oooooops Error, please enter admin city ";
					
	   			} elseif($add1 == "") {
					
         			$msg_e = "Oooooops Error, please enter admin parmanent address ";
					
	   			} elseif($studphone == "")  {
					
         			$msg_e = "Oooooops Error, please enter admin mobile number ";
					
	   			} elseif($email == "")  {
					
         			$msg_e = "Oooooops Error, please enter admin email address ";
      			
	  			} else {  /* update information */


       				$country = strip_tags($country); $state = strip_tags($state); $lga = strip_tags($lga);
       				$city = strip_tags($city);  $add1 = strip_tags($add1);       $add2 = strip_tags($add2);
       				$studphone = strip_tags($studphone);      $email = strip_tags($email);     

       				$country = trim($country); $state = trim($state); $lga = trim($lga);
       				$city = trim($city);  $add1 = trim($add1);       $add2 = trim($add2);
       				$studphone = trim($studphone);      $email = trim($email);      

		 			try {
		 
  							
							
							$ebele_mark = "UPDATE $adminAccessTB SET 

                 								a_country = :a_country,
                 								a_state = :a_state, 
                 								a_city = :a_city,
                 								a_paradd = :a_add_fi,
                 								a_temadd = :a_add_se,
												a_mail = :a_mail,
                 								a_phone = :a_phone
                 								


                 								WHERE admin_id = :admin_id";
												
								$igweze_prep = $conn->prepare($ebele_mark);	
							
						
								$igweze_prep->bindValue(':a_country', $country);
								$igweze_prep->bindValue(':a_state', $state);
								//$igweze_prep->bindValue(':a_lga', $lga); a_lga = :a_lga,
								$igweze_prep->bindValue(':a_city', $city);
								$igweze_prep->bindValue(':a_add_fi', $add1);
								$igweze_prep->bindValue(':a_add_se', $add2);
								$igweze_prep->bindValue(':a_phone', $studphone);
								$igweze_prep->bindValue(':a_mail', $email);
								$igweze_prep->bindValue(':admin_id', $adminID);
								
								if ($igweze_prep->execute()) {  /* if sucessfully */
                 		
									echo "<script type='text/javascript'>  $('#editBio3').slideUp(2000);  </script>";
									$msg_s = "Admin Profile was Successfully Saved.";

								}else {  /* display error */ 

									$msg_e = "<span>Ooooooops, An Error Has occur while trying 
									to save Admin Profile, please try again</span>";

								}
		


					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		 

        		}
        
			}elseif (($_REQUEST['adminData']) == 'saveStep3') {  /* save admin profile */ 

				$adminID = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['adminID']);
				$sponphone = preg_replace("/[^A-Za-z0-9+]/", "", $_REQUEST['sponphone']);
				$sponsor = preg_replace("/[^A-Za-z0-9& ]/", "", $_REQUEST['sponsor']);
				$sponadd = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['sponadd']);
				
				/* script validation */ 
				
      			if ($adminID == "")  {
         			
					$msg_e = "* An Error has occured, Please refresh your page and if persists contact the developer. Thanks ";
					
	   			}elseif($sponsor == "")   {
					
         			$msg_e = "Oooooops Error, please enter admin next of kin name ";
	   			}

      			elseif($sponphone == "")   {
					
         			$msg_e = "Oooooops Error, please enter admin next of kin phone number ";
	   			}

      			elseif($sponadd == "")   {
					
         			$msg_e = "Oooooops Error, please enter admin next of kin address ";
	   
	  			} else {  /* update information */ 

       	
       				$sponsor = strip_tags($sponsor);
       				$sponphone = strip_tags($sponphone);  $sponadd = strip_tags($sponadd);

       				$sponsor = trim($sponsor);
       				$sponphone = trim($sponphone);  $sponadd = trim($sponadd);


		 			try {
		 				 														
			
							$ebele_mark = "UPDATE $adminAccessTB SET 
                						 	
                 								a_sponsor = :a_sponsor,
                 								a_spo_phone = :a_spo_phone,
                 								a_spo_add = :a_spo_add


                 								WHERE admin_id = :admin_id";
												
								$igweze_prep = $conn->prepare($ebele_mark);	
							
								
								$igweze_prep->bindValue(':a_sponsor', $sponsor);
								$igweze_prep->bindValue(':a_spo_phone', $sponphone);
								$igweze_prep->bindValue(':a_spo_add', $sponadd);
								$igweze_prep->bindValue(':admin_id', $adminID);								
								
								if ($igweze_prep->execute()) {  /* if sucessfully */

									echo "<script type='text/javascript'>  $('#editBio4').slideUp(2000);  </script>";
									$msg_s = "Admin Profile was Successfully Saved.";
								

								}else {  /* display error */

									$msg_e = "<span>Ooooooops, An Error Has occur while trying 
									to save Admin Profile, please try again</span>";

								} 

					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}  

        		}
        
			}elseif (($_REQUEST['adminData']) == 'adminPic') {  /* save admin profile picture */ 
			
				$adminID = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['adminID']);

				$picturePath = $wizGradeAdminPicDir; /* picture path */
				
				$filePic = "uploadPic"; /* picture file name */
				$pageDesc = "School admin. picture";
				
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
								 	
								removeAdminPicture($conn, $_SESSION['adminID']);

								$ebele_mark = "UPDATE $adminAccessTB SET 
                						 	
                 								a_picture = :a_picture

                 								WHERE admin_id = :admin_id";
												
								$igweze_prep = $conn->prepare($ebele_mark);								
								$igweze_prep->bindValue(':a_picture', $uploadedPic);
								$igweze_prep->bindValue(':admin_id', $adminID);	

								if($igweze_prep->execute()){  /* insert picture name to database */
										 
									echo "<img src=''   height = '1' width='1'> ";
									$msg_s = "$pageDesc was successfully uploaded";									
									echo $succesMsg.$msg_s.$sEnd ;  echo $scrollUp; 	
									echo "<script type='text/javascript'> $('.pictureUploader').fadeOut(1500); </script>";  exit;									

								}else{  /* display error messages */

									echo "<img src=''   height = '1' width='1'> ";
									$msg_e = "Ooooooooooops, an error has occur while trying to save $pageDesc.
									Please try again or check your network connection!!!";
									echo $errorMsg.$msg_e.$eEnd;exit;

								}


							}catch(PDOException $e) {

									wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

							}
							  
							  
						}else{  /* display error messages */
								
								echo "<img src=''   height = '1' width='1'> ";
								$msg_e = "Ooooooooooops, an error has occur while trying to save $pageDesc.
								Please try again or check your network connection!!!";
								echo $errorMsg.$msg_e.$eEnd; exit;

							  
						}
							
					}else{  /* display error messages */
						
							echo "<img src=''   height = '1' width='1'> ";
							$msg_e = "Ooooooooooops, an error has occur while trying to save $pageDesc.
							Please try again or check your network connection!!!";
							echo $errorMsg.$msg_e.$eEnd; exit;							

					}	
					
					
				} 		 
						
			
			}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}


			
			if ($msg_s) {

				echo $succesMsg.$msg_s.$sEnd ; 
				echo "<script type='text/javascript'>  $('.adminLoader').fadeOut(3000);</script>"; exit;
										
			}	


			if ($msg_e) {

				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>  $('.adminLoader').fadeOut(3000);</script>"; exit; 
										
			}	
			
exit;
?>