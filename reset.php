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
	This script load admin reset password module
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}
		
		define('wizGrade', 'igweze');  /* define a check for wrong access of file */
		require_once 'sources/functions/configDirIn.php';  /* include configuration script */  
 
		
		if(($wizGradePortalRoot == '') || ($wizGradeDB == '')){  /* check script installation */

$installScript =<<<IGWEZE
        
			<meta http-equiv="refresh" content="0;URL='script-install'" />
		
IGWEZE;
		
			echo $installScript;			 
			exit;
			
		}	
		
		require $wizGradeDBConnectIndDir;  /* load connection string */ 
		require_once $wizGradeFunctionDir;  /* load script functions */	 
		
		if (isset($_COOKIE['googtrans'])) {  /* check google translator cookies */ 
			unset($_COOKIE['googtrans']);
			setcookie('googtrans', '', time() - 3600, '/'); // empty value and old timestamp
		}	
		
		/* reset and delete all session values */ 

		$_SESSION = array();

		if (ini_get("session.use_cookies")) {	
    		$params = session_get_cookie_params();
    		setcookie(session_name(), '', time() - 42000,
        		$params["path"], $params["domain"],
        		$params["secure"], $params["httponly"]
    		);
		 }

		session_unset();
		session_destroy();	 
		
		try{ 

			$userMail = preg_replace("/[^A-Za-z0-9@_.]/", "", $_REQUEST['mail']);
			
			$resetVal = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['r']);				
				
			$resetVal = strip_tags($resetVal);						
				
			$passVals = recoveryInfo($conn, $userMail, $resetVal);  /* school admin recovery password information  */
				
           	list ($adminMail, $rInfo, $rTime) = explode ("@(.$.)@", $passVals); 
		
 
		}catch(PDOException $e) {
  			
			wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		}			
		
		if($passVals != ''){   /* check if recovery information is true  */
	                 
?>

	<!DOCTYPE html>
	<html lang="en"> 
	
	<head> 

    <title>Reset Password | wizGrade</title>  

	<!-- Meta Head -->	
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="ALL">
	<meta name="rating" content="GENERAL">
	<meta name="distribution" content="GLOBAL">
	<meta name="classification" content="school portal, school management system, software">
	<meta name="copyright" content="wizGrade https://www.wizgrade.com">
    <meta name="author" content="IGWEZE EBELE MARK">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
	<meta name="keywords" content="wizgrade"  /> 
	<meta name="description" content=""/>
	
    <!-- Favicon -->	
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $wizGradeTemplateIN; ?>favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $wizGradeTemplateIN; ?>favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $wizGradeTemplateIN; ?>favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo $wizGradeTemplateIN; ?>favicon/site.webmanifest">
	<link rel="mask-icon" href="<?php echo $wizGradeTemplateIN; ?>favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#bfb3d4">
	<meta name="theme-color" content="#ffffff">    

    <!-- stylesheet -->
	
    <link href="<?php echo $wizGradeTemplateIN; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $wizGradeTemplateIN; ?>css/bootstrap-reset-27408B.css" rel="stylesheet">   
    <link href="<?php echo $wizGradeTemplateIN; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href="<?php echo $wizGradeTemplateIN; ?>css/pnotify.custom.css" rel="stylesheet">	
	<link href="<?php echo $wizGradeTemplateIN; ?>css/sweetalert2.min.css" rel="stylesheet">
    <link href="<?php echo $wizGradeTemplateIN; ?>css/style-4B0082.css" rel="stylesheet">
    <link href="<?php echo $wizGradeTemplateIN; ?>css/style-responsive.css" rel="stylesheet" />  
    <!-- / stylesheet -->
	
	<!-- jquery and javascripts -->
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo $wizGradeTemplateIN; ?>js/html5shiv.js"></script>
    <script src="<?php echo $wizGradeTemplateIN; ?>js/respond.min.js"></script>
    <![endif]-->
	<noscript> <meta http-equiv="refresh" content="0; URL=no-scripts"> </noscript>
	
	<!-- / jquery and javascripts -->
	
	</head>

	<body class="lock-screen">  
		
		<div class="container">
		
			<div id="wizGradePgContent"></div> 
		
			<div class="loader-background page-loader">
					<img src="<?php echo $wizGradeTemplateIN?>images/loading.gif" alt="please wait. Page loading >>>>>>>>>>>>>>>" /><!-- loading image -->
			</div>	
			
			<!-- form  -->  
			<form class="login-form" id="frmresetPassword" method="POST">

			<h2 class="login-form-heading">
				Reset Admin Password 
			</h2>
			<div id="resetBox" style="margin: 0% 10% 0% 10%;"></div>

			<div class="login-wrap login-wrap-reset"> 

				<div class="form-group">
					<label for="password" class="col-lg-2 col-sm-2 control-label">
					<i class="fa fa-lock  login-icon"></i></label>
					<div class="col-lg-10">
					<input type="password" name="password" value=""
					class="form-control" placeholder="Please enter new password" autofocus  style="margin-bottom: 15px; border: 
					1px solid #333;">
					</div>
				</div>				
				
				<div class="form-group">
					<label for="cpassword" class="col-lg-2 col-sm-2 control-label">
					<i class="fa fa-lock  login-icon"></i></label>
					<div class="col-lg-10">
					<input type="password" name="cpassword" value=""
					class="form-control" placeholder="Please confirm new password"  style="margin-bottom: 15px; border: 
					1px solid #333;">
					</div>
				</div>


				<input type="hidden" name="adminPass" value="changePass" />
				<button class="btn btn-lg btn-login btn-block" id="resetPassword" type="submit" > <i class="fa fa-unlock"></i> 
				Reset</button> 
			 
				<div class="login-link">
					<a href="online-application" class="application"> <i class="fa fa-user-plus fa-lg"></i>  Apply </a>
					<a href="<?php echo $wizGradePortalRoot; ?>" class="home-login userSignino  mob-gap"><i class="fa fa-lock fa-lg"></i> Sign In </a>				
				</div>

				<div class="login-footer" style=""> <b><span class="logo col-i-1">wizGrade</span></b> V1.2</div>	
 

			</div>

			</form>
			<!-- /form  --> 

<!-- form  -->  
			<form class="login-form display-none" id="frmrecoverPass" method="POST">

			<h2 class="login-form-heading">
				Recover Admin Password  
			</h2>
			<div id="resetBox" style="margin: 0% 10% 0% 10%;"></div>
			 

			<div class="login-wrap login-wrap-reset"> 
				<div class="form-group">
					<label for="email" class="col-lg-2 col-sm-2 control-label hide-res">
					<i class="fa fa-user login-icon"></i> </label>
					<div class="col-lg-10">
					<input type="email" name="adminMail" class="form-control"
					placeholder="Please enter admin. email" autofocus  style="margin-bottom: 15px; border: 1px solid #333;"> 

					</div>
				</div>  

				<input type="hidden" name="resetData"  value="to-nkiru-my-wife" />
				<button class="btn btn-lg btn-login btn-block" id="recoverPass" type="submit" > <i class="fa fa-unlock"></i> 
				Send </button>  

				<div class="login-link">
					<a href="online-application" class="application"> <i class="fa fa-user-plus fa-lg"></i> Apply</a>
					<a href="javascript:;" class="home-login userSignin mob-gap"><i class="fa fa-lock fa-lg"></i> Sign In </a> 
				</div>

				<div class="login-footer" style=""> <b><span class="logo col-i-2">wizGrade</span></b> V1.2</div>         

			</div>

			</form>	
			<!-- /form  --> 			
 
	
		</div>
		
		<!-- jquery  -->

		<script type="text/javascript" src="<?php echo $wizGradeTemplateIN; ?>js/jquery-3.4.1.min.js"></script>
		<script type="text/javascript" src="<?php echo $wizGradeTemplateIN; ?>js/bootstrap.min.js"></script>		
		<script type="text/javascript" src="<?php echo $wizGradeTemplateIN; ?>js/bootstrap-notify.js"></script>		
		<script type="text/javascript" src="<?php echo $wizGradeTemplateIN; ?>js/pnotify.custom.js"></script>
		<script type="text/javascript" src="<?php echo $wizGradeTemplateIN; ?>js/sweetalert2@9.js"></script>		
		<script type="text/javascript" src="<?php echo $wizGradeTemplateIN; ?>js/jquery.scrollTo.min.js"></script> 		 
	
		<script type="text/javascript">

			function showPageLoader(){  /* show loading image */

				$('.loader-background').fadeIn(100);
				$('.loader-background').css("z-index", "9999999");
				
			}

			function hidePageLoader(){  /* hide loading image */

				$('.loader-background').fadeOut(3000);
				
			}; 

			$(function(){  /* dynamic include jquery scripts */
				
				var postVal = 'loadScript';
		
				$('#loadScriptPage').load('loadScript', {'pageType': postVal});
						
			});
			 
			
		</script>  
 		
		<!-- / jquery  -->
					                                                                                                                                                                                                                                                                                          																																																																										<div id="loadScriptPage"> </div>

	</body>
	</html>

<?php

			$msg_i = "You can change your password to a new one. Always remember to keep your password secret only to yourself";
			echo $infoMsg.$msg_i.$iEnd; echo $scrollUp; exit; 
			

		}else{
			
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
		}

?>		