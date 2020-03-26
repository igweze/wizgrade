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

		define('wizGrade', 'igweze');  /* define a check for wrong access of file */	  
		
	  	require_once '../sources/functions/configDir.php';  /* include configuration script */
		require ($wizGradeDBConnectDir);   /* load connection string */ 
		require_once $wizGradeFunctionDir;  /* load script functions */
				
		
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="icon" type="image/x-icon" href="<?php echo $wizGradeTemplate; ?>images/favicon.png" />

	<title> wizGrade School App Installation Guide Wizard</title>

    <!-- stylesheet -->
	
    <link href="<?php echo $wizGradeTemplate; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $wizGradeTemplate; ?>css/bootstrap-reset-4B0082.css" rel="stylesheet">   
    <link href="<?php echo $wizGradeTemplate; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href="<?php echo $wizGradeTemplate; ?>css/pnotify.custom.css" rel="stylesheet">
    <link href="<?php echo $wizGradeTemplate; ?>css/style-4B0082.css" rel="stylesheet">
    <link href="<?php echo $wizGradeTemplate; ?>css/style-responsive.css" rel="stylesheet" /> 
	
<?php   
 
		 
		$maxRuntime = 8; /* less then your max script execution limit */

		$deadline = time()+$maxRuntime; 
		$progressFilename = $wizGradeSQLData.'_filepointer'; /* tmp file for progress */
		$errorFilename = $wizGradeSQLData.'_error'; /* tmp file for erro */ 
		
		echo ' <meta http-equiv="refresh" content="'.($maxRuntime+2).'"> ';  /* activate automatic reload in browser */
		
?>		

	</head><body style="background-color:#fff !important">
	
	<section class="panel col-lg-12" style="margin-top:3px;background-color:#fff !important"> 
<?php
			
		 
		($fp = fopen($wizGradeSQLData, 'r')) OR die('failed to open file:'.$wizGradeSQLData);

		if( file_exists($errorFilename) ){ /* check for previous error */
		
			die(' previous error: '.file_get_contents($errorFilename));
			
		} 
		
		/* go to previous file position */
		$filePosition = 0;
		if( file_exists($progressFilename) ){
			$filePosition = file_get_contents($progressFilename);
			fseek($fp, $filePosition);
		}

		$queryCount = 0;
		$query = '';
		while( $deadline>time() AND ($line=fgets($fp, 1024000)) ){
			
			if(substr($line,0,2)=='--' OR trim($line)=='' ){
				continue;
			}

			$query .= $line;
			
			if( substr(trim($query),-1)==';' ){
				
				try {
					$igweze_prep = $conn->prepare($query);
							
					if(!($igweze_prep->execute())){	
						
						$msg_e = 'Ooooooooops, an error has occur while performing database query. Please try again 
						or manually empty all database table.';
						echo $erroMsg.$msg_e.$msgEnd; exit; 
						
					}
				
				} catch(PDOException $e) {
						 
					wizGradeDie( 'Oooops Database Connection failed: ' . $e->getMessage());
					   
				}
				
				$query = '';
				file_put_contents($progressFilename, ftell($fp)); /* save the current file position for */
				$queryCount++;
				
			}
		}
		
		$dbPercent = (round(ftell($fp)/filesize($wizGradeSQLData), 2)*100);
		$remPercent = (100 - $dbPercent);	
		
		$progressPercent = $dbPercent.'%';
		

		
$queryPercent =<<<IGWEZE
        
						<div class="progress">
							<div class="progress-bar progress-bar-striped progress-bar-animated active" 
							role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" 
							style="width: $progressPercent;background-color:#228B22!important">$progressPercent</div>
						</div>  
		
IGWEZE;

		if($dbPercent > 75){
			echo "<script type='text/javascript'> 
					window.parent.$('.lastProgressBar').css('width', '$progressPercent');
					window.parent.$('#progress-value').text('$progressPercent');
			</script>"; 
			$remaingPer = "<b>$remPercent"."%"." Remaining.</b>";
		}else{
			
			$remaingPer = "<b>25% Remaining.</b>";

		}	
		
		if( feof($fp) ){  
   
			
			$installFile = fopen("../install/index.php","w");		 
	
			
$newInfo = "<?php \n\n 
 

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
	This script handle script installation
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		define('wizGrade', 'igweze');  /* define a check for wrong access of file */	  
		
	  	require_once '../sources/functions/configDir.php';  /* include configuration script */
		
		if  (file_exists("."$"."wizGradeInstallDir.'dbQuery.php')) {
			
			unlink("."$"."wizGradeInstallDir.'dbQuery.php');  
			
		}	
		
		if  (file_exists("."$"."wizGradeInstallDir.'installManger.php')) {
			
			unlink("."$"."wizGradeInstallDir.'installManger.php'); 
			
		}
		
		if  (file_exists("."$"."wizGradeInstallDir.'wizGrade.sql')) {
			
			unlink("."$"."wizGradeInstallDir.'wizGrade.sql');  
			
		}
		
		if  (file_exists("."$"."wizGradeInstallDir.'wizGrade.sql_filepointer')) {
			
			unlink("."$"."wizGradeInstallDir.'wizGrade.sql_filepointer');  
			
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
							
				$msg_s = "<i class='fa fa-check fa-3x pull-left'></i> <span class='sr-only'>Loading...</span>
				<b>wizGrade</b> installation is almost completed!. <br/> 
				<a href='$wizGradeInstallDir'  target='_top'><b>
				Please click here to delete installation files  so as to complete installation</b></a>.";
				echo $succMsg.$msg_s.$msgEnd; 
				
			}else{

				$msg_i = "<i class='fa fa-check fa-3x pull-left'></i> <span class='sr-only'>Loading...</span>
				<b>wizGrade</b> installation is almost completed!. <br/>However, some files were unable to delete due
				to your files system permission. Please manually delete the install folder to complete installation. 
				<a href='$wizGradePortalRoot'><b>Please click here to login</b></a>";
				echo $infMsg.$msg_i.$msgEnd;
			
			}			
			 
			
		}else{	  
		 
			
			$msg_i = "<i class='fa fa-spinner fa-pulse fa-3x fa-fw pull-left'></i> <span class='sr-only'>Loading...</span>
			<b>wizGrade</b> installation is currently running. <br />
			Please, don't disconnect your network or shut down your system. <br />
			This might take <b>3 to 15 minutes</b> depending on your system and server configuration.
			<br />Please wait . . . . $remaingPer";
			echo $infMsg.$msg_i.$msgEnd;
			
		}
		


?>

					 
			</section>	
			
			<script type='text/javascript'> 
					window.parent.$('#iframe-loader').fadeOut(100);
			</script>
		 	
		

	</body>
	</html>