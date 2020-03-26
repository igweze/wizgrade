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
	This script handle application login validation
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

session_start();
session_unset();
session_destroy();
session_start();

		define('wizGrade', 'igweze');  /* define a check for wrong access of file */ 
		
		setcookie('googtrans', '');
		
		require_once 'sources/functions/configDirIn.php';  /* include configuration script */		
		require_once $wizGradeFunctionDir;  /* load script functions */
		
		if (($_REQUEST['loginType'] == 'student-login') && ($_REQUEST['lData'] == 'to-nkiru-my-wife') ){  /* student  login validation */
					
			$i_username = $_REQUEST['username'];
			$i_password = $_REQUEST['password'];

			$i_username = trim($i_username);
			$i_username = strip_tags($i_username);
			$i_password = strip_tags($i_password);
			 
			$handleC = explode("/", $i_username);
			$handleCount = count($handleC); 
			
			if($handleCount == $thVal){
				
				list ($schAbbr, $username, $schoolType) =  explode ("/", $i_username);	
				
			}else{	
			
				list ($username, $schoolType) =  explode ("/", $i_username);	
				
			}	 

			$schoolSettings = schoolTypeConfig($schoolType, $fiVal);  /* school type configuration  */ 
			
			/* script validation */
			
			if (($_REQUEST['username'] == "") || ($_REQUEST['password'] == ""))   {
			 
				$msg_e = "* Oooooooops Error, please enter your Reg No and Password.!"; 
			 
			}elseif($wizGradeDB == ""){
				
				$msg_e = "* Oooooooops Error, please enter valid Reg No e.g 20010000/NUR, 20010000/PRI, 20010000/SEC!"; 
				
			}elseif ((!file_exists($schoolSettings)) || ($schoolSettings == "")){

				$msg_e = $noConnCongfigMsg; 

			}else{  /* validate user */ 
			
				try { 

					require_once ($schoolSettings);  /* include configuration script */
					require ($wizGradeDBConnectIndDir);   /* load connection string */ 				

					$ebele_mark = "SELECT r.ireg_id, nk_regno, session_id, s.stu_id, i_stupic, i_firstname, i_lastname, 
									i_midname, i_midname, i_gender

									 FROM $i_reg_tb r, $i_student_tb s

									 WHERE r.nk_regno = :nk_regno
									 
									 AND s.i_accesspass = :accesspass

									 AND r.ireg_id = s.ireg_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':nk_regno', $i_username);
					$igweze_prep->bindValue(':accesspass', $i_password , PDO::PARAM_STR);					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {  /* check array is empty */
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */
														
							$regNum = $row['nk_regno'];				 
							$regID = $row['ireg_id'];
							$student_id = $row['stu_id'];
							$stu_pic = $row['i_stupic'];
							$fname = $row['i_firstname'];
							$lname = $row['i_lastname'];
							$mname = $row['i_midname'];
							$sex = $row['i_gender'];
							$session = $row['session_id'];      
							
							$schoolSettings = schoolTypeConfig($schoolType, $seVal); /* school type configuration  */

						}	
						
						$stuFullName = "$fname $mname $lname";
						
						mt_srand((double)microtime() * 1000000);
						
						$njidekaBouncer = wizGradeRandomString($charset, 40);  /* generate auto random character */
						$nkirukaBouncer = wizGradeRandomString($charset, 40);  /* generate auto random character */
						
						$fiBouncerBabe = 'IFabuLOUSlyLoveNJideka'.$regID.'_'.$njidekaBouncer.'_Fabulous_Mum_In_the_GloBE';;					   
						$seBouncerBabe = 'IFabuLOUSlyLoveNKiruKa'.$regNum.'_'.$nkirukaBouncer.'_FabUloUS_Wife_In_the_WorlD';
															   
						$_SESSION['schoolConfigs'] = $schoolSettings;	 
						$_SESSION['isLoggedIn'] = true;      
						$_SESSION['studetPic'] = $stu_pic;   		 
						$_SESSION['picPath'] = $pic_path;
						$_SESSION['studetReg'] = $regNum;  		   
						$_SESSION['studetRegID'] = $regID;            
						$_SESSION['sessionID'] = $session;   
						$_SESSION['fullname'] = $stuFullName;     
						$_SESSION['lname'] = $lname;				
						$_SESSION['student_id'] = $student_id;     
						$_SESSION['sex'] = $sex;	
						$_SESSION['fiBouncerRand'] = $njidekaBouncer;     
						$_SESSION['seBouncerRand'] = $nkirukaBouncer;
						$_SESSION['fiBouncer'] = $fiBouncerBabe;     
						$_SESSION['seBouncer'] = $seBouncerBabe; 
							
						$schoolArray = wizGradeSchool($conn);  /* school configuration setup array  */
						$translate = $schoolArray[0]['translator'];
						$screenTimer = $schoolArray[0]['screen_timer'];
						$translator = '/'.$translate;
						setcookie("googtrans", $translator, time() + 60*60*24*100);  
						
						$_SESSION['screenTimer'] = $screenTimer; 
						
						$msg_s = "*Login Was Successfully, Please Wait. Page Redirecting . . . . . ";	
						
						$_SESSION['wizGradePiloter'] =  $headerStudentPage;
						echo "<script type='text/javascript'>  $('.login-wrap').slideUp(); 
						window.location.href = '$headerStudentPage'; </script>";
				   
					} else {  /* display error */

						$msg_e = "*Error, incorrect student Reg no. and password combination.";
						
					}
				 

				}catch(PDOException $e) {
			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				} 
		 
			} 
		 
		}elseif (($_REQUEST['loginType'] == 'parent-login') && ($_REQUEST['lData'] == 'to-nkiru-my-wife') ){  /* parent login validation */
				
			$i_username = $_REQUEST['username'];
			$i_password = $_REQUEST['password'];

			$i_username = trim($i_username);
			$i_username = strip_tags($i_username);
			$i_password = strip_tags($i_password);

			$handleC = explode("/", $i_username);
			$handleCount = count($handleC); 

			if($handleCount == $thVal){

				list ($schAbbr, $username, $schoolType) =  explode ("/", $i_username);	

			}else{	

				list ($username, $schoolType) =  explode ("/", $i_username);	

			}	 

			$schoolSettings = schoolTypeConfig($schoolType, $fiVal);  /* school type configuration  */ 
			
			/* script validation */

            if (($_REQUEST['username'] == "") || ($_REQUEST['password'] == ""))   {
			 
			 	$msg_e = "* Oooooooops Error, please enter your Reg No and Password.!"; 
			 
			}elseif($wizGradeDB == ""){
				
				$msg_e = "* Oooooooops Error, please enter valid Reg No e.g 20010000/NUR, 20010000/PRI, 20010000/SEC  !"; 
				
			}elseif ((!file_exists($schoolSettings)) || ($schoolSettings == "")){

                $msg_e = $noConnCongfigMsg; 

            }else{  /* validate user */ 
			
				try { 

					require_once ($schoolSettings);  /* include configuration script */
					require ($wizGradeDBConnectIndDir);   /* load connection string */ 					

					$ebele_mark = "SELECT r.ireg_id, nk_regno, session_id, s.stu_id, i_stupic, i_firstname, 
					i_lastname, i_midname, i_midname, i_gender

						 FROM $i_reg_tb r, $i_student_tb s

						 WHERE r.nk_regno = :nk_regno
						 
						 AND s.i_sponsor_p = :i_sponsor_p

						 AND r.ireg_id = s.ireg_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':nk_regno', $i_username);
					$igweze_prep->bindValue(':i_sponsor_p', $i_password , PDO::PARAM_STR);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {  /* check array is empty */
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */
														
							$regNum = $row['nk_regno'];				 
							$regID = $row['ireg_id'];
							$student_id = $row['stu_id'];
							$stu_pic = $row['i_stupic'];
							$fname = $row['i_firstname'];
							$lname = $row['i_lastname'];
							$mname = $row['i_midname'];
							$sex = $row['i_gender'];
							$session = $row['session_id'];                

						}	

						$schoolSettings = schoolTypeConfig($schoolType, $seVal); /* school type configuration  */		 
						$stuFullName = "$fname $mname $lname";
						
						mt_srand((double)microtime() * 1000000);

						$njidekaBouncer = wizGradeRandomString($charset, 40);  /* generate auto random character */
						$nkirukaBouncer = wizGradeRandomString($charset, 40);  /* generate auto random character */
						
						$fiBouncerBabe = 'IAmzininGlyLoveNjiDeKa'.$regID.'_'.$njidekaBouncer.'_OutStanding_MuM_In_the_GloBE';
					   
						$seBouncerBabe = 'IAmzininGLoveNKiruKa'.$regNum.'_'.$nkirukaBouncer.'_OutStanding_Wife_In_the_WorlD'; 
															   
						$_SESSION['schoolConfigs'] = $schoolSettings;
						$_SESSION['isLoggedIn'] = true;       
						$_SESSION['studetPic'] = $stu_pic;   		 
						$_SESSION['picPath'] = $pic_path;
						$_SESSION['studetReg'] = $regNum;  		   
						$_SESSION['studetRegID'] = $regID;            
						$_SESSION['sessionID'] = $session;   
						$_SESSION['fullname'] = $stuFullName;     
						$_SESSION['lname'] = $lname;				
						$_SESSION['student_id'] = $student_id;     
						$_SESSION['sex'] = $sex;	
						$_SESSION['fiBouncerRand'] = $njidekaBouncer;     
						$_SESSION['seBouncerRand'] = $nkirukaBouncer;
						$_SESSION['fiBouncer'] = $fiBouncerBabe;     
						$_SESSION['seBouncer'] = $seBouncerBabe;
						
						$schoolArray = wizGradeSchool($conn);  /* school configuration setup array  */
						$translate = $schoolArray[0]['translator'];
						$screenTimer = $schoolArray[0]['screen_timer'];
						$translator = '/'.$translate;
						setcookie("googtrans", $translator, time() + 60*60*24*100);  
						
						$_SESSION['screenTimer'] = $screenTimer; 
						
						$msg_s = "*Login Successfully, Please Wait. Page Redirecting . . . . . ";
						
						$_SESSION['wizGradePiloter'] =  $headerParentPage;
						echo "<script type='text/javascript'>  $('.login-wrap').slideUp(); 
						window.location.href = '$headerParentPage'; </script>";
				   
					} else {  /* display error */ 

						$msg_e = "* Oooooooops Error, incorrect student reg no. and parent password combination.";
						
					}
			 

			 	} catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			 	} 
		 
			} 
		 
		}elseif (($_REQUEST['loginType'] == 'admin-login') && ($_REQUEST['lData'] == 'to-nkiru-my-wife') ){  /* admin login validation */ 
		
			$nk_name = $_REQUEST['username'];
			$nk_pass = $_REQUEST['password'];

			$nk_name = trim($nk_name);
			$nk_name = strip_tags($nk_name);					
			$nk_pass = strip_tags($nk_pass);

			try { 

				require ($wizGradeDBConnectIndDir);   /* load connection string */ 		

				$checkDetail =  wizGradeAdminPassData($conn, $nk_name);  /* school admin password details */			 
				list ($adminID, $checkedPass, $adminName) =  explode ("@(.$*S*$.)@", $checkDetail);					

			}catch(PDOException $e) {

				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

			}

			/* script validation */ 

			if ($nk_name == '')   {

				$msg_e = "* Oooooooops Error, please enter admin name ";

			}elseif ($nk_pass == '')   {

				$msg_e = "* Oooooooops Error, please enter your password";

			}elseif($checkedPass != $nk_pass){

				$msg_e = "* Oooooooops Error, invalid username and password combination. Thanks";

			} else {  /* login this user */ 

				$admin_grade = $adminGrade; $admin_level = $adminGradeInt; 

				mt_srand((double)microtime() * 1000000);
							
				$njidekaBouncer = wizGradeRandomString($charset, 44);
				$nkirukaBouncer = wizGradeRandomString($charset, 44);

				$fiBouncerBabe = 'IFabuLOUSlyLoveNJidekaNCHukWUM'.$admin_level.'_'.$njidekaBouncer.'_Fabulous_Dad_In_the_GloBE';
				$seBouncerBabe =  'IFabuLOUSlyLoveNKiruKaNCHukWUM'.$admin_grade.'_'.$nkirukaBouncer.'_FabUloUS_Wife_In_the_WorlD';

				$_SESSION['adminID'] = $adminID;
				$_SESSION['adminUser'] = $nk_name;
				$_SESSION['adminLname'] = $adminName;
				$_SESSION['accessGrade'] = $admin_grade;
				$_SESSION['accessLevel'] = $admin_level;
				$_SESSION['commonPgrade'] = $comGrade;
				$_SESSION['commonPlevel'] = $comGradeInt;
				$_SESSION['random_bouncer'] = $se_random_bouncer;
				$_SESSION['ADmiNfiBouncerRand'] = $njidekaBouncer;     
				$_SESSION['ADmiNseBouncerRand'] = $nkirukaBouncer;
				$_SESSION['ADmiNfiBouncer'] = $fiBouncerBabe;     
				$_SESSION['ADmiNseBouncer'] = $seBouncerBabe;	
				$_SESSION['studetReg'] = '004004001'; 
				$_SESSION['wallComRank'] = '2'; 

				$schoolArray = wizGradeSchool($conn);  /* school configuration setup array  */
				$translate = $schoolArray[0]['translator'];
				$screenTimer = $schoolArray[0]['screen_timer'];
				$translator = '/'.$translate;
				setcookie("googtrans", $translator, time() + 60*60*24*100);  
						
				$_SESSION['screenTimer'] = $screenTimer; 
						
				$msg_s = "*Login Successfully, Please Wait. Page Redirecting . . . . . ";

				$_SESSION['wizGradePiloter'] =  $headerComPage;
				echo "<script type='text/javascript'> 
				$('.login-wrap').slideUp(); window.location.href = '$headerComPage'; </script>"; 
				///header( 'Location:' .$headerAdminPage); 

			} 
			 	
		}elseif (($_REQUEST['loginType'] == 'staff-login') || ($_REQUEST['loginType'] == 'bursary') 
					
			|| ($_REQUEST['loginType'] == 'librainain') || ($_REQUEST['loginType'] == 'principal') 
					
			&& ($_REQUEST['lData'] == 'to-nkiru-my-wife') ){  /* staffs login validation */		 
  
			$username = $_REQUEST['username'];
			$nk_pass = $_REQUEST['password'];

			$username = trim($username);
			$nk_name = strip_tags($username);
			$nk_pass = strip_tags($nk_pass);

			try { 

				require ($wizGradeDBConnectIndDir);   /* load connection string */ 				

				$checkDetail =  wizGradeStaffPassData($conn, $nk_name);  /* school staffs/teachers password details */ 			 
				list ($tID, $staffUser, $checkedPass, $staffName, $staffRank, $userGrade) = 
				explode ("@(.$*S*$.)@", $checkDetail);

			}catch(PDOException $e) {

				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

			}
			
			/* script validation */ 
			
			if ($nk_name == '')   {

				$msg_e = "* Ooooooops Error, please enter valid staff name";

			}elseif ($nk_pass == '')   {

				$msg_e = "* Ooooooops Error, please enter your password";

			}elseif($checkedPass != $nk_pass){

				$msg_e = "* Ooooooops Error, invalid username and password combination.";

			}elseif($userGrade <= $fiVal){

				$msg_e = "* Ooooooops Error, you don't have any admin priviledge assign to you.";

			}else {  /* login this user */ 

				if ($userGrade == $staffGradeInt){  /* check if school staff */

					$admin_grade = $staffGrade; $admin_level = $staffGradeInt;

				}elseif ($userGrade == $schHeadGradeInt){  /* check if school head */

					$admin_grade = $schHeadGrade; $admin_level = $schHeadGradeInt;

				}elseif ($userGrade == $libraryGradeInt){  /* check if school librainain */

					$admin_grade = $libraryGrade; $admin_level = $libraryGradeInt;

				}elseif ($userGrade == $bursaryGradeInt){  /* check if school bursary */

					$admin_grade = $bursaryGrade; $admin_level = $bursaryGradeInt;

				}else{  /* display error */

					$msg_e = "* Ooooooops Error, you don't have any admin priviledge assign to you.";
					echo "<script type='text/javascript'> $('.page-loader').fadeOut(1500); </script>";
					echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 	

					exit;

				} 

				mt_srand((double)microtime() * 1000000);

				$njidekaBouncer = wizGradeRandomString($charset, 44); /* generate auto random character */
				$nkirukaBouncer = wizGradeRandomString($charset, 44); /* generate auto random character */

				$fiBouncerBabe =  'IFabuLOUSlyLoveNJidekaNCHukWUM'.$admin_level.'_'.$njidekaBouncer.'_Fabulous_Dad_In_the_GloBE';               
				$seBouncerBabe =  'IFabuLOUSlyLoveNKiruKaNCHukWUM'.$admin_grade.'_'.$nkirukaBouncer.'_FabUloUS_Wife_In_the_WorlD';

				$_SESSION['adminID'] = $tID;
				$_SESSION['adminUser'] = $nk_name;
				$_SESSION['adminLname'] = $staffName;
				$_SESSION['accessGrade'] = $admin_grade;
				$_SESSION['accessLevel'] = $admin_level;
				$_SESSION['commonPgrade'] = $comGrade;
				$_SESSION['commonPlevel'] = $comGradeInt;
				$_SESSION['random_bouncer'] = $se_random_bouncer;
				$_SESSION['ADmiNfiBouncerRand'] = $njidekaBouncer;     
				$_SESSION['ADmiNseBouncerRand'] = $nkirukaBouncer;
				$_SESSION['ADmiNfiBouncer'] = $fiBouncerBabe;     
				$_SESSION['ADmiNseBouncer'] = $seBouncerBabe;		

				$schoolArray = wizGradeSchool($conn);  /* school configuration setup array  */
				$translate = $schoolArray[0]['translator'];
				$screenTimer = $schoolArray[0]['screen_timer'];
				$translator = '/'.$translate;
				setcookie("googtrans", $translator, time() + 60*60*24*100);  
						
				$_SESSION['screenTimer'] = $screenTimer; 

				$msg_s = "*Login was successfully, please wait. Page Redirecting . . . . . ";

				if ($userGrade == $libraryGradeInt){  /* check if school librainain */

					$_SESSION['wizGradePiloter'] =  $headerLibrarianPage;
					echo "<script type='text/javascript'>  $('.login-wrap').slideUp(); window.location.href = '$headerLibrarianPage'; </script>"; 

				}elseif ($userGrade == $bursaryGradeInt){  /* check if school bursary */

					$_SESSION['wizGradePiloter'] =  $headerBursaryPage;
					echo "<script type='text/javascript'>  $('.login-wrap').slideUp(); window.location.href = '$headerBursaryPage'; </script>"; 

				}else{  /* else school head/staff */

					$_SESSION['wizGradePiloter'] =  $headerComPage;
					echo "<script type='text/javascript'>  $('.login-wrap').slideUp(); window.location.href = '$headerComPage'; </script>"; 

				} 

			} 
			 	
		}else{  /* display error */ 
							
			$msg_e = "* Oooooops Error, please select your login type. Thanks";
			echo "<script type='text/javascript'> $('.page-loader').fadeOut(1500); </script>";
			echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 	 
			unset($_SESSION['wizGradePiloter']); 
				
		}
					
		if ($msg_s) {

			echo $succesMsg.$msg_s.$sEnd; echo $scrollUp; exit; 				
							
		}	

		if ($msg_e) {
			
			echo "<script type='text/javascript'> $('.page-loader').fadeOut(1500); </script>";
			echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 			
								
		}	
				
exit;
?>