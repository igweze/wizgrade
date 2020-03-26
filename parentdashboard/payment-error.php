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
	This script handle product payment error
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */

			$paymentInfo = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['c']);				
				
			$paymentInfo = strip_tags($paymentInfo);	
			
			if($paymentInfo != $_SESSION['transRefNo']){   /* check if payment ref no is correct  */
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="icon" type="image/x-icon" href="<?php echo $wizGradeTemplate; ?>images/favicon.png" /> <!-- favicon -->

	<title>Ooops Error</title> 

	<!-- stylesheet -->
	
    <link href="<?php echo $wizGradeTemplate; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $wizGradeTemplate; ?>css/bootstrap-reset-27408B.css" rel="stylesheet">   
    <link href="<?php echo $wizGradeTemplate; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />     
	<link href="<?php echo $wizGradeTemplate; ?>css/pnotify.custom.css" rel="stylesheet">
    <link href="<?php echo $wizGradeTemplate; ?>css/style-27408B.css" rel="stylesheet">
    <link href="<?php echo $wizGradeTemplate; ?>css/style-responsive.css" rel="stylesheet" /> 
	
	<!-- / stylesheet -->
	
	<!-- jquery and javascripts -->
	
	<script> var locateFefe = '<?php echo $wizGradeLogOutDir;?>'; </script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="./wizGradeTemplates/js/html5shiv.js"></script>
    <script src="./wizGradeTemplates/js/respond.min.js"></script>
    <![endif]-->
	
	<!-- / jquery and javascripts -->
	
	</head> 

	<!-- body -->
	
	<body class="body-404">

		<div class="container">

			<section class="error-wrapper text-center">				
				
				<i class="icon-404 img-circle"></i> 
				
				<h1>Ooops Error</h1>
				<h2>Your payment was not successfully processed. Please try again.</h2>
          
			</section>

		</div> 

	</body> 
	
	<!-- / body -->

	</html>