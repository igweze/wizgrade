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
	
	This script load application modules
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}
		
		define('fobrain', 'igweze');  /* define a check for wrong access of file */
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
		
		try {
			
			$schoolDataArray = wizGradeSchool($conn);  /* school configuration setup array  */					
			$schoolNameTop = $schoolDataArray[0]['school_name'];  

		} catch(PDOException $e) {
			
			wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
   
		}		
	                 
?>

	<!DOCTYPE html>
	<html lang="en"> 
	
	<head>  
    
	<title><?php echo $schoolNameTop; ?> | fobrain School App </title> 

	<!-- Meta Head -->	
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="ALL">
	<meta name="rating" content="GENERAL">
	<meta name="distribution" content="GLOBAL">
	<meta name="classification" content="school portal, school management system, software, open source school management system, fobrain">
	<meta name="copyright" content="fobrain https://www.fobrain.com">
    <meta name="author" content="IGWEZE EBELE MARK for fobrain Tech LTD">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
	<meta name="keywords" content="fobrain"  /> 
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
    <link href="<?php echo $wizGradeTemplateIN; ?>css/bootstrap-reset-4B0082.css" rel="stylesheet">   
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

				<div class="login-footer" style=""> <b><span class="logo col-i-2">fobrain</span></b> V1.3</div>         

			</div>

			</form>	
			<!-- /form  --> 

			 
			<!-- / form --> 
			
			<!-- form -->
			<form class="login-form" id="frmLogin" method="POST">
			<h2 class="login-form-heading">
			<?php echo $schoolNameTop; ?><br /><span id="small_loaderS" style="display:none;">
			<img src="<?php echo $wizGradeTemplateIN?>images/loading.gif" alt="Loading >>>>>> " /> </span>
			</h2>
			<div id="loginMsgBox" style="margin: 0% 10% 0% 10%;"></div>
			<center><img src="loading.gif" id="DemoLoader" style="display:none;" alt="Please Wait"/></center>

			<div class="login-wrap">
				<div class="form-group">
					<label for="loginType" class="col-lg-2 col-sm-2 control-label  hide-res">
					<i class="fa fa-user-circle-o login-icon"></i></label>
					<div class="col-lg-10">					  
						<select name="loginType" id ="loginTypeQ" class="form-control"  style="margin-bottom: 30px; border: 1px solid #333;">
						<option value=""> Login As </option>
						<option value="student-login">Student </option>
						<option value="parent-login">Parent </option> 
						<option value="librainain">Libraian</option>
						<option value="staff-login">Class Teacher</option>									
						<option value="principal">School Head</option>       
						<option value="admin-login">Admin</option>
						</select>					  
					</div>
				</div> 

				<div class="form-group" >
					<label for="username" class="col-lg-2 col-sm-2 control-label">
					<i class="fa fa-user login-icon"></i> </label>
					<div class="col-lg-10">					  
					<input type="text" name="username" id="username" class="form-control"  value="2010001/SEC"
					placeholder="username" autofocus  style="margin-bottom: 15px; border: 1px solid #333;">					  
					</div>
				</div> 

				<div class="form-group">
					<label for="password" class="col-lg-2 col-sm-2 control-label">
					<i class="fa fa-key login-icon"></i></label>
					<div class="col-lg-10">					  
					<input type="password" name="password" id="password" value="password"
					class="form-control" placeholder="password"  style="margin-bottom: 15px; border: 
					1px solid #333;">					  
					</div>
				</div> 

				<input type="hidden" name="lData"  value="to-nkiru-my-wife" />
				<button class="btn btn-lg btn-login btn-block" id="loginBtn" type="submit" >
					<i class="fa fa-lock"></i> Sign in</button> 

				<div class="login-link">
					<a href="online-application" class="application"> <i class="fa fa-user-plus fa-lg"></i> Apply</a>
					<a href="javascript:;" class="home-login recoverPass mob-gap"><i class="fa fa-unlock fa-lg"></i> Recover Pass. </a>									
				</div>
				
				<div class="login-footer" style=""> <b><span class="logo col-i-1">fobrain</span></b> V1.3</div>                

			</div>

			</form>
			<!-- / form --> 			
	
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
			
		<script> 
		
			var $buoop = {required:{e:-4,f:-3,o:-3,s:-1,c:-3},insecure:true,api:2018.10 }; 
			function $buo_f(){ 
				var e = document.createElement("script"); 
				e.src = "//browser-update.org/update.min.js"; 
				document.body.appendChild(e);
			};
			try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
			catch(e){window.attachEvent("onload", $buo_f)}
			
		</script>		
			
		<!-- / jquery  -->
		
		<div id="loadScriptPage"> </div>
	</body>
	</html>
