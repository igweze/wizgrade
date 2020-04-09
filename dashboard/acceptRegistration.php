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
	This script accept student online registration
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configINwizGrade.php';  /* load wizGrade configuration files */
      
		 if ($_REQUEST['newBioData'] == 'newStuBioData') {

				$regNum =  $_REQUEST['regnum'];
				$studentID = $_REQUEST['studentID'];
				$schLevel = $_REQUEST['level'];			
				$sessionClass =  $_REQUEST['class'];
				$en_term =  $_REQUEST['term'];
				$regDate =  date("Y-m-d H:i:s"); //strtotime(date("Y-m-d H:i:s"));
				
				list ($schoolAbbr, $regNum) = explode('/', $regNum);
				list($sessionID, $class) = explode('-', $sessionClass);
				list ($school, $en_level) = explode('-', $schLevel);
				
				$errorSchool = true; 
				
				/* script validation */ 
				
			    if($school == 1){  /* check school type */ 
				   
					require_once ($wizGradeDir.$wizGradeNurConfig);  /* include school configuration script */ 
					$schoolExt = $wizGradeNurAbr;
				  
			    }elseif($school == 2){  /* check school type */ 
				   
					require_once ($wizGradeDir.$wizGradePRIConfig);  /* include school configuration script */ 
					$schoolExt = $wizGradePriAbr;
				  
			    }elseif($school == 3){  /* check school type */ 
				   
					require_once ($wizGradeDir.$wizGradeSECConfig);  /* include school configuration script */ 
					$schoolExt = $wizGradeSecAbr;
				  
			    }else{  /* display error */ 
				  
					$errorSchool = false; 
					
			    }



				if ($regNum == "")  {
         			
					$msg_e = "* Oooooooops Error, could not find student information. Please refresh the page and try again";
					
	   			}elseif($errorSchool == false)   {
         		
					$msg_e  = "* Oooooooops Error, please select new student level to enroll";
	   			
				}elseif (studentExitsRV($conn, $regNum) == $foreal)  {
         		
					$msg_e .= "* Oooooooops Error, Student with this <b> Reg No $regNum </b>already  exists in database";
	   			
				}elseif ($studentID == "")  {
         		
					$msg_e .= "* Oooooooops Error, could not find new student registration infomation. It might have been
					deleted. Thanks";
	   			
				}elseif($class == "")   {
         		
					$msg_e .= "* Oooooooops Error, please select new student class to enroll";
	   			
				}elseif ($sessionID == "")  {
         		
					$msg_e .= "* Oooooooops Error, please select new student class to enroll";
	   			
				}elseif($en_level == "")   {
         		
					$msg_e  = "* Oooooooops Error, please select new student level to enroll";
	   			
				}elseif($en_term == "")   {
         		
					$msg_e  = "* Oooooooops Error, please select new student' s entry term";
	   			
				}else {  /* insert information */  

		 			try { 

						$regNum = trim($regNum); 
						
						$ebele_mark = "SELECT stu_id, i_stupic, i_school, i_level, i_firstname, i_midname, i_lastname, i_gender,
										i_country, i_state, i_add_fi, i_add_se, i_email, i_sponsor, i_spo_add, bloodgp, 
										genotype, i_spon_occup
			
											FROM $studentOnlineRegTB
			
											WHERE stu_id = :stu_id";
								 
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':stu_id', $studentID);
							 
							$igweze_prep->execute();
							
							$rows_count = $igweze_prep->rowCount(); 
							
							if($rows_count == $foreal) {  /* check array is empty */
							
								while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */	
								
										$stu_id = $row['stu_id'];
										$school = $row['i_school'];
										//$level = $row['i_level'];
										$applyPic = $row['i_stupic'];
										$fname = $row['i_firstname'];
										$lname = $row['i_lastname'];
										$mname = $row['i_midname'];
										$gender = $row['i_gender'];
										$dob = $row['i_dob'];
										$country = $row['i_country'];
										$state = $row['i_state'];
										$lga = $row['i_lga'];
										$city = $row['i_city'];
										$add1 = $row['i_add_fi'];
										$add2 = $row['i_add_se'];
										$phone = $row['i_stu_phone'];
										$email = $row['i_email'];
										$spon = $row['i_sponsor'];
										$soccup = $row['i_spon_occup'];
										$sphone = $row['i_spo_phone'];
										$adds = $row['i_spo_add'];
										$bloodGP = $row['bloodgp'];
										$genoTP = $row['genotype'];
										
								} 

								mt_srand((double)microtime() * 1000000);
							   
								if($generatePass == $foreal){  /* check generate password status */
		
									$userPass = wizGradeRandomString($charset, 8);  /* generate password */
									$spon_access = wizGradeRandomString($charset, 5);  /* generate password */
				
								}else{
				
									$userPass = "password";
									$spon_access = "password";
				
								} 		  
							   
								$schoolType = $school_list[$school];									
								
								$showNewPanel = $seVal;
				  
								if($schoolExt == $wizGradeNurAbr){  /* check school type */ 
									  
									require_once ($wizGradeAdminDir.'wizGradeNurBio.php');  /* school registration script */ 
									  
								}else{
								  
									require_once ($wizGradeAdminDir.'wizGradePSBio.php');  /* school registration script */ 
								} 

							}else{  /* display error */	 
						
								$msg_e .= "* Oooooooops Error, could not find new student registration infomation. 
								It might have been deleted. Thanks";
						
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

$script =<<<IGWEZE
				<script type='text/javascript'>  
				
				$('#newRegRow-$studentID').fadeOut(1000); 
				$('.newRegDiv').fadeOut(2000); 
				$('.registration-loader').fadeOut(4000); 
				$('#totalRegsCount').html($totalRegis);
				
				</script>;
IGWEZE;
			
				echo $script;  exit;
									
			}	


			if ($msg_e) {

				echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'> $('.registration-loader').fadeOut(4000);  </script>";
				exit;
									
			}	
			
exit; 
?>