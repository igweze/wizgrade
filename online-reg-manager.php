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
	This script handle online registration
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		define('wizGrade', 'igweze');  /* define a check for wrong access of file */

		require_once 'sources/functions/configDirIn.php';  /* include configuration script */
		
		require_once $wizGradeFunctionDir;  /* load script functions */			
		require ($wizGradeDBConnectIndDir);   /* load connection string */ 
         
		if (($_REQUEST['registration']) == 'onlineReg') {

			$school = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['school']);
			$class = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['class']);
			$fname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['fname']);
			$mname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['mname']);
			$lname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['lname']);
			$sex =   preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['sex']);
			$dateofbirth = preg_replace("/[^A-Za-z0-9-]/", "", $_REQUEST['dob']);
			$bloodgr =   preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['bloodgr']);
			$genotype =   preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['genotype']);
			$country = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['country']);
			$state = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['state']);
			$lga = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['lga']);
			$add1 = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['add1']);
			$add2 = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['add2']);
			$city = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['city']);
			$studphone = preg_replace("/[^A-Za-z0-9+]/", "", $_REQUEST['studphone']);
			$email = preg_replace("/[^A-Za-z0-9.@]/", "", $_REQUEST['email']);

			$sponphone = preg_replace("/[^A-Za-z0-9+,]/", "", $_REQUEST['sponphone']);
			$soccup = preg_replace("/[^A-Za-z0-9& ]/", "", $_REQUEST['soccup']);
			$sponsor = preg_replace("/[^A-Za-z0-9& ]/", "", $_REQUEST['sponsor']);
			$sponadd = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['sponadd']);
			$time = strtotime(date("Y-m-d H:i:s"));	 
			
			/* script validation */ 
			
			if ($school == "")  {
			
				$msg_e = "Oooooooops error, please choose school to enroll to";
			
			}elseif ($class == "")  {
			
				$msg_e = "Oooooooops error, please choose class to enroll to";
			
			}elseif ($lname == "")  {
			
				$msg_e = "Oooooooops error, please enter first name";
			
			}elseif($fname == "")   {
			
				$msg_e  = "Oooooooops error, please enter last name";
			
			}elseif (($sex == "")) {
			
				$msg_e = "Oooooooops error, please select gender";
			
			}elseif ($dateofbirth == "") {
			
				$msg_e = "Oooooooops error, please enter date of birth";
			
			}elseif ($bloodgr == "") {
			
				$msg_e = "Oooooooops error, please enter blood group";
			
			}elseif ($genotype == "") {
			
				$msg_e = "Oooooooops error, please enter genotype";
			
			}elseif (($country == "")) {
				
				$msg_e = "Oooooooops error, please select nationality";
				
			}elseif (($state == "")) {
				
				$msg_e = "Oooooooops error, please select state";
				
			}elseif($city == "")   {
				
				$msg_e = "Oooooooops error, please enter city ";
				
			}elseif($add1 == "") {
				
				$msg_e = "Oooooooops error, please enter parmanent address";
				
			}elseif($sponsor == "")   {
				
				$msg_e = "Oooooooops error, please enter sponsor name";
				
			}elseif($sponphone == "")   {
				
				$msg_e = "Oooooooops error, please enter sponsor phnone no";
				
			}elseif($soccup == "")   {
				
				$msg_e = "Oooooooops error, please enter sponsor occupation";
				
			}elseif($sponadd == "")   {
				
				$msg_e = "Oooooooops error, please enter sponsor address";
   
			}else {  /* insert information */  

				$fname = strip_tags($fname);  $mname = strip_tags($mname); $lname = strip_tags($lname);
				$sex = strip_tags($sex);    $dateofbirth = strip_tags($dateofbirth);   
				$country = strip_tags($country); $state = strip_tags($state); $lga = strip_tags($lga);
				$city = strip_tags($city);  $add1 = strip_tags($add1);       $add2 = strip_tags($add2);
				$studphone = strip_tags($studphone);      $email = strip_tags($email);  $soccup = strip_tags($soccup);    

				$sponsor = strip_tags($sponsor);
				$sponphone = strip_tags($sponphone);  $sponadd = strip_tags($sponadd);

				$fname = trim($fname);  $mname = trim($mname); $lname = trim($lname);
				$sex = trim($sex);    $dateofbirth = trim($dateofbirth);  					
				$country = trim($country); $state = trim($state); $lga = trim($lga);
				$city = trim($city);  $add1 = trim($add1);       $add2 = trim($add2);
				$studphone = trim($studphone);      $email = trim($email);     
				$sponsor = trim($sponsor);
				$sponphone = trim($sponphone);  $sponadd = trim($sponadd); $soccup = trim($soccup);
				
				$regName = "$lname $fname $mname";  

				$picturePath = $applyPSrc; /* picture path */
				
				$filePic = "uploadPic"; /* picture file name */
				$pageDesc = "your picture";
				
				/* call igweze file uploader */
				$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 2), $validPicExt, $validPicType, $allowedPicExt, $fileType = "Picture", $fiVal); 
				 
				if (is_array($uploadPicData['error'])) {  /* check if any upload error */
					 
					$msg_e = '';
					  
					foreach ($uploadPicData['error'] as $msg) {
						$msg_e .= $msg.'<br />';     /* display error messages */
					}
					echo "<img src=''   height = '1' width='1'> ";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('.alert-danger').fadeOut(20000); </script>"; exit;
				  
				  
				} else {  /* upload picture and insert information */
					
					$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
					
					if ($uploadedPic != "") {
							
						if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
								
								
							try { 

								
								$ebele_mark = "INSERT INTO $studentOnlineRegTB 
											(i_stupic, i_school, i_level, i_firstname, i_midname, i_lastname, i_gender, i_dob, 
											bloodgp, genotype, i_country, i_state, i_city, i_add_fi, i_add_se, i_stu_phone, 
											i_email,i_sponsor, i_spo_phone, i_spon_occup, i_spo_add, reg_date)
									
											VALUES (:i_stupic, :i_school, :i_level, :i_firstname, :i_midname, :i_lastname, :i_gender,
											:i_dob, :bloodgp, :genotype, :i_country, :i_state, :i_city, :i_add_fi,
											:i_add_se, :i_stu_phone, :i_email, :i_sponsor, :i_spo_phone, :i_spon_occup, :i_spo_add, :reg_date)";
												
								$igweze_prep = $conn->prepare($ebele_mark);	
								$igweze_prep->bindValue(':i_stupic', $uploadedPic);
								$igweze_prep->bindValue(':i_school', $school);
								$igweze_prep->bindValue(':i_level', $class);
								$igweze_prep->bindValue(':i_firstname', $fname);
								$igweze_prep->bindValue(':i_midname', $mname);
								$igweze_prep->bindValue(':i_lastname', $lname);
								$igweze_prep->bindValue(':i_gender', $sex);
								$igweze_prep->bindValue(':i_dob', $dateofbirth);
								$igweze_prep->bindValue(':bloodgp', $bloodgr);
								$igweze_prep->bindValue(':genotype', $genotype);
								$igweze_prep->bindValue(':i_country', $country);
								$igweze_prep->bindValue(':i_state', $state);
								$igweze_prep->bindValue(':i_city', $city);
								$igweze_prep->bindValue(':i_add_fi', $add1);
								$igweze_prep->bindValue(':i_add_se', $add2);
								$igweze_prep->bindValue(':i_stu_phone', $studphone);
								$igweze_prep->bindValue(':i_email', $email);
								$igweze_prep->bindValue(':i_sponsor', $sponsor);
								$igweze_prep->bindValue(':i_spo_phone', $sponphone);
								$igweze_prep->bindValue(':i_spon_occup', $soccup);
								$igweze_prep->bindValue(':i_spo_add', $sponadd);
								$igweze_prep->bindValue(':reg_date', $time); 
								
								//$igweze_prep->bindValue(':i_lga', $lga); i_lga,  :i_lga,
								
								if($igweze_prep->execute()){  /* insert picture name to database */
									
									$imgSrc = $picturePath.$uploadedPic;	 
									echo "<img src=''   height = '1' width='1'> ";
									$msg_s = "$regName, your online registration was successfully. We will get back to you soon. Thanks";	
									echo $succesMsg.$msg_s.$sEnd; echo $scrollUp; 	
									echo "<script type='text/javascript'>   $('.frmsaveReg').slideUp(2000); </script>";  
									exit;									

								}else{ /* display error messages */

									echo "<img src=''   height = '1' width='1'> ";
									$msg_e = "Oooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
									echo $errorMsg.$msg_e.$eEnd; exit;

								} 

							}catch(PDOException $e) {

									wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

							}
							  
							  
						}else{ /* display error messages */
								
								echo "<img src=''   height = '1' width='1'> ";
								$msg_e = "Oooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
								echo $errorMsg.$msg_e.$eEnd; exit;

							  
						}
							
					}else{ /* display error messages */
						
							echo "<img src=''   height = '1' width='1'> ";
							$msg_e = "Oooops, an error has occur while trying to save $pageDesc. Please try again or check your network connection!!!";
							echo $errorMsg.$msg_e.$eEnd; exit;							

					}	
					
					
				} 		 
	

			}
	
		}else{
		
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}




		if ($msg_e) {
			
			echo "<img src=''   height = '1' width='1'> ";
			echo $errorMsg.$msg_e.$eEnd;
			echo "<script type='text/javascript'>   $('.alert-danger').fadeOut(20000); </script>";
			exit;  
									
		}	
		
exit;
?>