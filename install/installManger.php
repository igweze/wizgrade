<?php

/*  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 	
	wizGrade V 1 (Formerly SDOSMS) is Developed by Igweze Ebele Mark | https://www.iem.wizgrade.com
	https://www.wizgrade.com
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 	
	Copyright 2014-2019 IGWEZE EBELE MARK | https://www.iem.wizgrade.com 
	
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
	and To My Inestimable Sons Osinachi Michael, Ifechukwu Othniel and My Unborn lil Child.  
	
	WEBSITE 					PHONES												EMAILS
	https://www.wizgrade.com	+234 - 80 - 30 716 751, +234 - 80 - 22 000 490 		info@wizgrade.com	
	
	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Page/Code Explanation~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	This script handle installation modules
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
			define('fobrain', 'igweze');  /* define a check for wrong access of file */ 
			
			if (($_REQUEST['iData']) == 'install') {  /* save student profile */

				$fname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['fname']);
				$lname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['lname']);
				$email = preg_replace("/[^A-Za-z0-9.@]/", "", $_REQUEST['email']);
				$password = strip_tags($_REQUEST['password']);
				$url = strip_tags($_REQUEST['url']);
				$dname = preg_replace("/[^A-Za-z0-9_.]/", "", $_REQUEST['dname']);
				$dhost = preg_replace("/[^A-Za-z0-9_.]/", "", $_REQUEST['dhost']);
				$duser = preg_replace("/[^A-Za-z0-9_.]/", "", $_REQUEST['duser']);
				$dpassword = strip_tags($_REQUEST['dpassword']);
				$install = strip_tags($_REQUEST['install']);
								
				$email = strtolower($email);

				/* script validation */ 
				
				if ($lname == "")  {
         		
					$msg_e .= "Ooooooooops, please enter first name";
	   			
				}elseif($fname == "")   {
         		
					$msg_e  = "Ooooooooops, please enter last name";
	   			
				}elseif ($email == ''){
         		
					$msg_e_r = "Ooooooooops, please enter a valid email address";
	   			
				}elseif($password == "")   {
         		
					$msg_e  = "Ooooooooops, please enter admin password";
	   			
				}elseif (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)){
					
					$msg_e  = "Ooooooooops, please enter a valid full url eg http://www.wizgrade.com or http://www.school.wizgrade.com";
	   			
				}elseif($dname == "")   {
         		
					$msg_e  = "Ooooooooops, please enter database name";
	   			
				}elseif($dhost == "")   {
         		
					$msg_e  = "Ooooooooops, please enter database host";
	   			
				}elseif($duser == "")   {
         		
					$msg_e  = "Ooooooooops, please enter database user name";
	   			
				}elseif($dpassword == "")   {
         		
					$msg_e  = "Ooooooooops, please enter database password";
	   			
				}else {  /* update information */ 

					if($install == 1){  /* if installation is auto */ 
					
						$url = rtrim($url, '/') . '/'; 
						
						$iframeSrc = $url.'install/dbQuery.php';
						
						echo "<script type='text/javascript'>   
						
						$('body').on('click','#installDB',function(){  /* install wizGrade Database */
									
							event.stopImmediatePropagation();
							
							$('#ifeOsiframe').attr('src', '$iframeSrc');
							
							return false; 		
										
						});  
						
						</script>"; 
					}
					$dpassword = "";
		 			try {
 

						$dbFile = fopen("../dbConnectConfig.php","w");
						$wizGradeFile = fopen("../wizGradeConfig.php","w");

$dbInfo = "<?php \n\n
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
	This script handle database connection parameters
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		\n
		"."$"."server = '$dhost'; "."$"."username = '$duser'; "."$"."password = '$dpassword';  /* database connection parameters */ \n

?>";


$wizGradeInfo = "<?php \n\n
/*  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 	
	wizGrade V 1.2 (Formerly SDOSMS) is Designed & Developed by Igweze Ebele Mark | https://www.iem.wizgrade.com
	https://www.wizgrade.com
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 	
	Copyright 2014 - 2020 c wizGrade | IGWEZE EBELE MARK 
	
	Licensed under the Apache License, Version 2.0 (the 'License');
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

		http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an 'AS IS' BASIS,
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
	This script load school configuration parameter
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		\n
		"."$"."wizGradePortalRoot = '$url'; "."$"."wizGradeDB = '$dname';  \n

?>";
						$wizGradeDB = $dname;
						
						require_once '../sources/functions/configDir.php';  /* include configuration script */		
						require_once $wizGradeFunctionDir;  /* load script functions */
						
						if ((fwrite($dbFile, $dbInfo) > 0 ) && (fwrite($wizGradeFile, $wizGradeInfo) > 0 )){
							
							fclose($dbFile); fclose($wizGradeFile); 
							 	
							/* PDO connection start */
							try {
								
								$conn = new PDO("mysql:host=$dhost; dbname=$dname", $duser, $dpassword);
								$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$conn->exec("SET CHARACTER SET utf8"); 
								
							} catch(PDOException $e) {
								echo "<script type='text/javascript'>  
								$('.install-loader').fadeOut(100); 
								$('#installwizGrade').fadeIn(100); 	
								</script>";
								wizGradeDie( 'Oooops Database Connection failed: ' . $e->getMessage());
					   
							}
							/* PDO connection end */ 
							
							$randomL = wizGradeRandomString($charset, 16); 
							$randomD = wizGradeRandomString($charset, 16);  
							$newPass = password_hash($password, PASSWORD_BCRYPT, $options_bcrypt);
							
							/*$ebele_mark_drop = "DROP DATABASE IF EXISTS $wizGradeDB";
							
							$igweze_prep_drop = $conn->prepare($ebele_mark_drop);
							$igweze_prep_drop->execute();
							
							$ebele_mark_cr = "CREATE DATABASE IF NOT EXISTS $wizGradeDB";
							
							$igweze_prep_cr = $conn->prepare($ebele_mark_cr);
							$igweze_prep_cr->execute();
							*/
							
							$ebele_mark_create = "CREATE TABLE IF NOT EXISTS $adminAccessTB (
							  `admin_id` int(3) NOT NULL,
							  `a_title` enum('1','2','3','4','5','6') DEFAULT NULL,
							  `a_fname` varchar(50) DEFAULT NULL,
							  `a_mname` varchar(50) DEFAULT NULL,
							  `a_lname` varchar(50) DEFAULT NULL,
							  `a_name` varchar(30) NOT NULL,
							  `a_pass` varchar(255) NOT NULL,
							  `a_regno` varchar(30) DEFAULT NULL,
							  `a_picture` varchar(80) DEFAULT NULL,
							  `a_gender` enum('Male','Female') DEFAULT NULL,
							  `a_dob` date DEFAULT NULL,
							  `bloodgp` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
							  `genotype` enum('1','2','3') DEFAULT NULL,
							  `a_mstatus` enum('1','2','3','4','5') DEFAULT NULL,
							  `a_country` varchar(100) DEFAULT NULL,
							  `a_delimit` varchar(40) DEFAULT NULL,
							  `a_state` varchar(100) DEFAULT NULL,
							  `a_lga` varchar(100) DEFAULT NULL,
							  `a_city` varchar(100) DEFAULT NULL,
							  `a_paradd` varchar(256) DEFAULT NULL,
							  `a_temadd` varchar(256) DEFAULT NULL,
							  `a_phone` varchar(30) DEFAULT NULL,
							  `a_mail` varchar(50) DEFAULT NULL,
							  `a_sponsor` varchar(60) DEFAULT NULL,
							  `a_spo_phone` varchar(20) DEFAULT NULL,
							  `a_spo_add` varchar(100) DEFAULT NULL,
							  `a_sponsor_ac` char(30) DEFAULT NULL,
							  `recov_info` varchar(50) DEFAULT NULL,
							  `recov_time` int(15) DEFAULT NULL,
							  `a_grade` enum('editor','senator','general') NOT NULL,
							  `a_unique` int(10) DEFAULT NULL,
							  `a_limit` varchar(40) DEFAULT NULL,
							  `a_level` enum('1','2','3','4','5') DEFAULT NULL,
							  `cw_rank` enum('2','3','4','5') DEFAULT NULL
							) ENGINE=InnoDB DEFAULT CHARSET=latin1;
							
							";
							
							$igweze_prep_create = $conn->prepare($ebele_mark_create);

							if ($igweze_prep_create->execute()) { 
								
								$ebele_mark_insert = "INSERT INTO $adminAccessTB  (admin_id, a_fname, a_lname, a_name, a_mail, a_pass, 
								a_limit, a_delimit)

								VALUES (:admin_id, :a_fname, :a_lname, :a_name, :a_mail, :a_pass, :a_limit, :a_delimit)"; 
												
								$igweze_prep_insert = $conn->prepare($ebele_mark_insert);	 
								$igweze_prep_insert->bindValue(':admin_id', $fiVal); 
								$igweze_prep_insert->bindValue(':a_fname', $fname); 								
								$igweze_prep_insert->bindValue(':a_lname', $lname);
								$igweze_prep_insert->bindValue(':a_name', $email);
								$igweze_prep_insert->bindValue(':a_mail', $email);
								$igweze_prep_insert->bindValue(':a_pass', $newPass);
								$igweze_prep_insert->bindValue(':a_limit', $randomL);
								$igweze_prep_insert->bindValue(':a_delimit', $randomD); 

								if ($igweze_prep_insert->execute()) { 
									
									if(file_exists($wizGradeSQLPointer)){
										unlink($wizGradeSQLPointer);
									} 
									
									echo "<script type='text/javascript'>  
									
									$('.install-loader').fadeIn(100); 
									$('#installwizGrade').fadeOut(100); 									
									$('#installDB').trigger('click');
									
									</script>"; 
						
								}else {

									$msg_e = "Oooops, an error has occur while trying to insert admin information. Please try again";

								} 
								
							}else{

								$msg_e = "Oooops, an error has occur while trying to create admin table. Please try again";
									
							}	
									
						}else{
							
							$msg_e  = "../dbConnectConfig.php and ../wizGradeConfig.php needs to be writable for this script to be installed!";
							
						}	 
						
						if($install == 2){  /* if installation is manual */  
			
							$installFile = fopen("../install/index.php","w");		 
	
			
$newInfo = "<?php \n\n 
 

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
	This script handle script installation
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		define('fobrain', 'igweze');  /* define a check for wrong access of file */	  
		
	  	require_once '../sources/functions/configDir.php';  /* include configuration script */
		
		if  (file_exists("."$"."wizGradeInstallDir.'dbQuery.php')) {
			
			unlink("."$"."wizGradeInstallDir.'dbQuery.php');  
			
		}	
		
		if  (file_exists("."$"."wizGradeInstallDir.'installManger.php')) {
			
			unlink("."$"."wizGradeInstallDir.'installManger.php'); 
			
		}
		
		if  (file_exists("."$"."wizGradeInstallDir.'fobrain.sql')) {
			
			unlink("."$"."wizGradeInstallDir.'fobrain.sql');  
			
		}
		
		if  (file_exists("."$"."wizGradeInstallDir.'fobrain.sql_filepointer')) {
			
			unlink("."$"."wizGradeInstallDir.'fobrain.sql_filepointer');  
			
		} 
		\n\n
?>
	<!DOCTYPE html>
	<html lang='en'>

	<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />

    <!-- Favicon -->	
	<link rel='apple-touch-icon' sizes='180x180' href='../wizGradeTemplates/favicon/apple-touch-icon.png'>
	<link rel='icon' type='image/png' sizes='32x32' href='../wizGradeTemplates/favicon/favicon-32x32.png'>
	<link rel='icon' type='image/png' sizes='16x16' href='../wizGradeTemplates/favicon/favicon-16x16.png'>
	<link rel='manifest' href='../wizGradeTemplates/favicon/site.webmanifest'>
	<link rel='mask-icon' href='../wizGradeTemplates/favicon/safari-pinned-tab.svg' color='#5bbad5'>
	<meta name='msapplication-TileColor' content='#bfb3d4'>
	<meta name='theme-color' content='#ffffff'>  

	<title>Script Installed</title>


	<!-- stylesheet -->
	
    <link href='../wizGradeTemplates/css/bootstrap.min.css' rel='stylesheet'>
    <link href='../wizGradeTemplates/css/bootstrap-reset-4B0082.css' rel='stylesheet'>   
    <link href='../wizGradeTemplates/assets/font-awesome/css/font-awesome.css' rel='stylesheet' />     
	<link href='../wizGradeTemplates/css/pnotify.custom.css' rel='stylesheet'>
    <link href='../wizGradeTemplates/css/style-4B0082.css' rel='stylesheet'>
    <link href='../wizGradeTemplates/css/style-responsive.css' rel='stylesheet' /> 
	
	<!-- / stylesheet -->
	
	<!-- jquery and javascripts --> 
	 
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src='../wizGradeTemplates/js/html5shiv.js'></script>
    <script src='../wizGradeTemplates/js/respond.min.js'></script>
    <![endif]-->
	
	<!-- / jquery and javascripts -->
	
	</head> 

	<!-- body -->
	
	<body class='body-404'>

		<div class='container'>

			<section class='error-wrapper text-center'>

				<i class='icon-404 img-circle'></i> 

				<h1>wizGrade</h1>
				<h2>installation is successfully completed!. 
				<a href='<?php echo "."$"."wizGradePortalRoot; ?>'><b>Please click here to login</b></a></h2>
          
			</section>

		</div> 

	</body> 
	
	<!-- / body -->

	</html>

";


							if (fwrite($installFile, $newInfo) > 0 ){
								fclose($installFile);	
								$progressPercent = "98%";	
								echo "<script type='text/javascript'> 
										$('.lastProgressBar').css('width', '$progressPercent');
										$('#progress-value').text('$progressPercent');
										$('#iframe-loader').fadeOut(100);
								</script>"; 
			
								$msg_s = "<i class='fa fa-check fa-3x pull-left'></i> <span class='sr-only'>Loading...</span>
								<b>fobrain</b> installation is almost completed!. <br/> 
								<a href='$wizGradeInstallDir'><b> Please click here to delete installation files  so 
								as to complete installation</b></a>.";
								echo $succMsg.$msg_s.$msgEnd; exit;
								
							}else{

								$msg_i = "<i class='fa fa-check fa-3x pull-left'></i> <span class='sr-only'>Loading...</span>
								<b>fobrain</b> installation is almost completed!. <br/>However, some files were unable to delete due
								to your files system permission. Please manually delete the install folder to complete installation. 
								<a href='$wizGradePortalRoot'><b>Please click here to login</b></a>";
								echo $infMsg.$msg_i.$msgEnd; exit;
							
							}			
				 
			
		 
						
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
				echo "<script type='text/javascript'>  $('#loader-background').fadeOut(3000);</script>"; exit;
										
			}	


			if ($msg_e) {

				echo $erroMsg.$msg_e.$msgEnd;
				echo "<script type='text/javascript'>  $('#loader-background').fadeOut(3000);
				$('.install-loader').fadeOut(100); 
				$('#installwizGrade').fadeIn(100); 	
				</script>"; exit; 
				
										
			}	
			
exit;
?>