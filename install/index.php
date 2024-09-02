<?php

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
	This script handle installation modules
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 

		define('fobrain', 'igweze');  /* define a check for wrong access of file */	  
		
	  	require_once '../sources/functions/configDir.php';  /* include configuration script */   

		$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
		$pageUrl = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";					
		$pageUrl = str_replace("install/","", $pageUrl);					

?>	

	<!DOCTYPE html>
	<html lang="en"> 
	
	<head> 

    <title>fobrain Installation Wizard</title>  

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
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $wizGradeTemplate; ?>favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $wizGradeTemplate; ?>favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $wizGradeTemplate; ?>favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo $wizGradeTemplate; ?>favicon/site.webmanifest">
	<link rel="mask-icon" href="<?php echo $wizGradeTemplate; ?>favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#bfb3d4">
	<meta name="theme-color" content="#ffffff"> 

    <!-- stylesheet -->
	
    <link href="<?php echo $wizGradeTemplate; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $wizGradeTemplate; ?>css/bootstrap-reset-4B0082.css" rel="stylesheet">   
    <link href="<?php echo $wizGradeTemplate; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href="<?php echo $wizGradeTemplate; ?>css/pnotify.custom.css" rel="stylesheet">
	<link href="<?php echo $wizGradeTemplate; ?>css/sweetalert2.min.css" rel="stylesheet">
    <link href="<?php echo $wizGradeTemplate; ?>css/style-4B0082.css" rel="stylesheet">
    <link href="<?php echo $wizGradeTemplate; ?>css/style-responsive.css" rel="stylesheet" />

		<style> 
		 
			.stepwizard-step p {
				margin-top: 10px;
			}
			.stepwizard-row {
				display: table-row;
			}
			.stepwizard {
				display: table;
				width: 50%;
				position: relative;
			}
			.stepwizard-step button[disabled] {
				opacity: 1 !important;
				filter: alpha(opacity=100) !important;
			}
			.stepwizard-row:before {
				top: 14px;
				bottom: 0;
				position: absolute;
				content: " ";
				width: 100%;
				height: 1px;
				background-color: #ccc;
				z-order: 0;
			}
			.stepwizard-step {
				display: table-cell;
				text-align: center;
				position: relative;
			}
			.btn-circle {
				width: 30px;
				height: 30px;
				text-align: center;
				padding: 6px 0;
				font-size: 12px;
				line-height: 1.428571429;
				border-radius: 15px;
			}
			.gicon{
				color:#00CC33 !important;
			}
			.bicon{
				color:#ff0000 !important;
			}
			input[type="checkbox"] {
				display:inline;
				height:20px;
				width:20px; 
			}
			.holds-the-iframe {
				background:url('loading.gif') center center no-repeat;
			}

			.table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td {
				padding: 6px !important;
				font-size:14px !important;
			}	
		</style>	
    <!-- / stylesheet -->
	
	<!-- jquery and javascripts -->
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo $wizGradeTemplate; ?>js/html5shiv.js"></script>
    <script src="<?php echo $wizGradeTemplate; ?>js/respond.min.js"></script>
    <![endif]-->
	<noscript> <meta http-equiv="refresh" content="0; URL=no-scripts"> </noscript>
	
	<!-- / jquery and javascripts -->
	
	</head>

		<body style="background-color:#fff !important;"> 
		
			<section class="panel col-lg-12" style="margin-top:0px"> 

				<div class="panel-body wizGrade-linea">

					<noscript> <?php echo $infMsg.$noscriptMsg.$msgEnd;  ?> </noscript>
					
					<div id="scrollBTarget" class="loader-background">	
						<img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="please wait. Page loading >>>>>>>>>>>>>>>" /><!-- loading image -->
					</div> 

					<!--  start -->
					<div class="container">
					<div class="col-xs-8 col-md-offset-2" style="padding-bottom:15px !important;">
					<div class="col-md-12">
					<header class="panel-heading"> 
						<i class="fa fa-cog fa-lg fa-spin"></i> <span class="sr-only">Loading...</span> 
						fobrain Installation Wizard
						<span class="tools pull-right">
						<a href="javascript:;" class="fa fa-chevron-down"></a>
						<a href="javascript:;" class="fa fa-times"></a>
						</span>
					</header>
					</div>
					</div> 

						<div class="stepwizard col-md-offset-3">
							<div class="stepwizard-row setup-panel">
							<div class="stepwizard-step">
							<a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
							<p>Step 1</p>
							</div>
							<div class="stepwizard-step">
							<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
							<p>Step 2</p>
							</div>
							<div class="stepwizard-step">
							<a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
							<p>Step 3</p>
							</div>
							<div class="stepwizard-step">
							<a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
							<p>Step 4</p>
							</div> 
							</div>
						</div> 
						<div class="col-xs-6 col-md-offset-3"><div class="col-md-12" id="iBox"></div></div>
						<div class="row setup-content" id="step-1">
						<div class="col-xs-6 col-md-offset-3">
						<div class="col-md-12">
						
						<div class="progress">
							<div class="progress-bar progress-bar-striped progress-bar-animated active" 
							role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" 
							style="width: 25%; background-color:#228B22!important;">25%</div>
						</div>
					
						<h3> App. Server Requirements</h3>   
						 
						<?php

						if ((phpversion() < '7.0') || (phpversion() > '8.3.11')) {
							$app_error = 'You require PHP Version greater than <b>7</b> or below <b>8.3.11</b> 
							for this script to work good. However, we are upgrading latest PHP version soon !<br />'; 
						}
						if (ini_get('session.auto_start')) {
							$app_error .= 'Your site will not work with session.auto_start enabled!<br />'; 
						}
						if (!extension_loaded('mysqli')) {
							$app_error .= 'MySQL extension needs to be loaded for this script to work!<br />';
						}
						if (!extension_loaded('gd')) {
							$app_error .= 'GD extension needs to be loaded for this script to work!<br />';
						}
						if (!is_writable('../wizGradeConfig.php')) {
							$app_error .= '../wizGradeConfig.php needs to be writable for this script to be installed!';
						}
						if (!is_writable('../dbConnectConfig.php')) {
							$app_error .= '../dbConnectConfig.php needs to be writable for this script to be installed!';
						}
						
						if($app_error){
						 
							echo $erroMsg.$app_error.$msgEnd;  
							
						}
						?>
						<table width = '100%' class="table table-hover style-table"> 
						<thead>
						<tr>
						<th>App Requirements:</th>
						<th>Your Server </th>
						<th>Required</th>
						<th>Status</th>
						</tr>
						</thead> <tbody>
						<tr>
						<td>PHP Version:</td>
						<td><?php echo phpversion(); ?></td>
						<td> > 7.0  < 8.3.11 </td>
						<td><?php if ((phpversion() < '7.0') || (phpversion() > '8.3.11')) { ?> 
						<i class="fa fa-times-rectangle-o fa-lg bicon"></i>
						<?php }else{ ?>
						<i class="fa fa-check-square-o fa-lg gicon"></i>
						<?php } ?>
						</td>
						</tr>
						<tr>
						<td>Session Auto Start:</td>
						<td><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></td>
						<td>Off</td>
						<td><?php echo (!ini_get('session_auto_start')) ? 
						'<i class="fa fa-check-square-o fa-lg gicon"></i>' : '<i class="fa fa-times-rectangle-o fa-lg bicon"></i>'; ?></td>
						</tr>
						<tr>
						<td>PDO:</td>
						<td><?php echo extension_loaded('pdo') ? 'On' : 'Off'; ?></td>
						<td>On</td>
						<td><?php echo extension_loaded('pdo') ? 
						'<i class="fa fa-check-square-o fa-lg gicon"></i>' : '<i class="fa fa-times-rectangle-o fa-lg bicon"></i>'; ?></td>
						</tr>
						<tr>
						<td>MySQLI:</td>
						<td><?php echo extension_loaded('mysqli') ? 'On' : 'Off'; ?></td>
						<td>On</td>
						<td><?php echo extension_loaded('mysqli') ? 
						'<i class="fa fa-check-square-o fa-lg gicon"></i>' : '<i class="fa fa-times-rectangle-o fa-lg bicon"></i>'; ?></td>
						</tr>
						<tr>
						<td>GD:</td>
						<td><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></td>
						<td>On</td>
						<td><?php echo extension_loaded('gd') ? 
						'<i class="fa fa-check-square-o fa-lg gicon"></i>' : '<i class="fa fa-times-rectangle-o fa-lg bicon"></i>'; ?></td>
						</tr>
						<tr>
						<td>./wizGradeConfig.php</td>
						<td><?php echo is_writable('../wizGradeConfig.php') ? 'Writable' : 'Unwritable'; ?></td>
						<td>Writable</td>
						<td><?php echo is_writable('../wizGradeConfig.php') ? 
						'<i class="fa fa-check-square-o fa-lg gicon"></i>' : '<i class="fa fa-times-rectangle-o fa-lg bicon"></i>'; ?></td>
						</tr>
						<tr>
						<td>./dbConnectConfig.php</td>
						<td><?php echo is_writable('../dbConnectConfig.php') ? 'Writable' : 'Unwritable'; ?></td>
						<td>Writable</td>
						<td><?php echo is_writable('../dbConnectConfig.php') ? 
						'<i class="fa fa-check-square-o fa-lg gicon"></i>' : '<i class="fa fa-times-rectangle-o fa-lg bicon"></i>'; ?></td>
						</tr>
						</tbody>
						</table>	
						  
							<div class="form-group">							
							<center><input type="checkbox" required="required"  value="yes" name="acceptTerm" 
							id="acceptTerm"/></center>
							<label class="control-label" style="text-align:justify"> fobrain school manager is Licensed under the Apache License, Version 2.0 <br/>
							By checking the button above, you have agreed with the fobrain license you downloaded. 
							Meanwhile, you are not allowed to remove or edit fobrain logo,  name or  copyright unless 
							you have a valid license from fobrain. Thanks</label>
							</div>  
							<button class="btn btn-primary nextBtn btn-lg pull-right" id="appRequired" type="button">Next</button>
							
						</div>
						 
						</div>
						</div>
						
						<form role="form" id="frmwizGrade" method="post">						
						<div class="row setup-content" id="step-2">
							<div class="col-xs-6 col-md-offset-3">
							<div class="col-md-12">
							
							<div class="progress">
							<div class="progress-bar progress-bar-striped progress-bar-animated active" 
							role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" 
							style="width: 50%; background-color:#228B22!important;">50%</div>
							</div>
						
							<h3> Admin. Information</h3>
							<div class="form-group">
								<label class="control-label">Admin First Name</label>
								<input maxlength="50" type="text" name="fname" id="fname" required="required" 
								class="form-control" placeholder="Please Enter Your First Name">
							</div>
							<div class="form-group">
								<label class="control-label">Admin Last Name</label>
								<input maxlength="50" type="text" name="lname" id="lname" required="required" 
								class="form-control" placeholder="Please Enter Your Last Name">
							</div>
							<div class="form-group">
								<label class="control-label">Admin Email</label>
								<input maxlength="50" type="email" name="email" id="email" required="required" 
								class="form-control" placeholder="Please Enter Admin Email">
								<span class="label label-danger">NOTE!</span>
								<span style="color:#ff0000"> This is admin username and also use for password recovery.</span>								 
							</div>							
							<div class="form-group">
								<label class="control-label">Admin Password</label>
								<input maxlength="15" type="password" name="password" id="password" required="required" 
								class="form-control" placeholder="Please Enter Admin Password">
							</div>
							<button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Back</button> 
							<button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
							</div>
							</div>
						</div>
						<div class="row setup-content" id="step-3">
							<div class="col-xs-6 col-md-offset-3">
							<div class="col-md-12">
							
							<div class="progress">
							<div class="progress-bar progress-bar-striped progress-bar-animated active" 
							role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" 
							style="width: 75%; background-color:#228B22!important;">75%</div>
							</div>
							
							<h3> Database Configuration</h3>
							<div class="form-group">
								<label class="control-label">Site Full Url</label>
								<input maxlength="100" type="text" name="url" id="url" required="required" 
								class="form-control" placeholder="Please Enter Your Site Url" value="<?php echo $pageUrl; ?>">
								<span class="label label-danger">NOTE!</span>
								<span style="color:#ff0000">e.g http://www.wizgrade.com or http://www.school.wizgrade.com.</span>	
							</div>
							<div class="form-group">
								<label class="control-label">Database Name</label>
								<input maxlength="30" type="text" name="dname" id="dname" required="required" 
								class="form-control" placeholder="Please Enter Your Database Name">
								<span class="label label-danger">NOTE!</span>
								<span style="color:#ff0000"> Please manually create your database and enter its name 
								here.</span>	
							</div>
							<div class="form-group">
								<label class="control-label">Database Host</label>
								<input maxlength="30" type="text" name="dhost" id="dhost" value="localhost" 
								required="required" class="form-control" placeholder="Please Enter Your Database Host">
							</div>
							<div class="form-group">
								<label class="control-label">Database User Name</label>
								<input maxlength="30" type="text" name="duser" id="duser" required="required" 
								class="form-control" placeholder="Please Enter Your Database User Name">
								<span class="label label-danger">NOTE!</span>
								<span style="color:#ff0000"> Please grant all priviledges to this user for 
								installation to work 100%.</span>	
							</div>
							<div class="form-group">
								<label class="control-label">Database Password</label>
								<input maxlength="30" type="text" name="dpassword" id="dpassword" required="required" 
								class="form-control" placeholder="Please Enter Your Database Password"> 
							</div>
							
							<div class="form-group">
								<label class="control-label">Installation Type</label>
								<select name="install"  id="install" class="form-control">
								<option value="1">Auto (Default)</option>
								<option value="2">Manual</option> 
								</select>
								<span class="label label-danger">NOTE!</span>
								<span style="color:#ff0000"> If you are having issues with auto try manual installation. 
								In Manual installation, <b>locate & open install folder</b> and manually import <b>fobrain.sql</b> into your 
								database before you continue or click Next.</span>	
							</div>
							
														
							<input type="hidden" name="iData" value="install" /> 
							<button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Back</button>
							<button class="btn btn-primary nextBtn btn-lg pull-right display-none" id="installDB" type="button">N</button>
							<button class="btn btn-primary btn-lg pull-right" type="submit" id="installwizGrade"							
							onclick="document.getElementById('installwizGrade').style.display = 'none';
							document.getElementById('install-loader').style.display = 'block';
							setTimeout(function(){ document.getElementById('installwizGrade').style.display = 'block';
							document.getElementById('install-loader').style.display = 'none'; }, 3000);">Next</button>
							<i class="fa fa-spinner fa-pulse fa-3x fa-fw pull-right display-none install-loader" id="install-loader"></i>
							<span class="sr-only">Loading...</span>
							</div>
							</div>
						</div>
						
						<div class="row setup-content" id="step-4">
							<div class="col-xs-6 col-md-offset-3">
							<div class="col-md-12">
							
							<div class="progress">
							<div class="progress-bar progress-bar-striped progress-bar-animated active lastProgressBar" 
							role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" 
							style="width: 75%; background-color:#228B22!important;"><span id="progress-value">75%<span></div>
							</div>
							
							<h3> Database/Script Installation</h3>
							
							<div class="" id="iframe-loader">
									<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" 
									height="250px" width="250px" alt="please wait. Page loading >>>>>>>>>>>>>>>" /><!-- loading image --></center>
							</div>	
							
							<iframe  src="javascript:;" id="ifeOsiframe" scrolling="no"
							sandbox="allow-top-navigation allow-forms allow-same-origin allow-scripts allow-popups" 
							style="position: relative; height: 180px; width: 100%; border: none; 
							 background-color:#fff !important;">
							</iframe> 
							
							</div>
							</div>
						</div>
						
						
						</form>
						<div class="col-xs-6 col-md-offset-3"><div class="col-md-12"><hr  /></div></div>
						
					</div>
					<!-- installation form end -->
					<br />	<br /> 
				</div>
			</section>					
					
		<!-- jquery  -->

		<script src="<?php echo $wizGradeTemplate; ?>js/jquery-3.4.1.min.js"></script>
		<script src="<?php echo $wizGradeTemplate; ?>js/bootstrap.min.js"></script>
		
		<script type="text/javascript" src="<?php echo $wizGradeTemplate; ?>js/pnotify.custom.js"></script>
		<script type="text/javascript" src="<?php echo $wizGradeTemplate; ?>js/sweetalert2@9.js"></script>	 
		
		<script src="<?php echo $wizGradeTemplate; ?>js/jquery.scrollTo.min.js"></script>
		<script src="<?php echo $wizGradeTemplate; ?>js/jquery.nicescroll.js" type="text/javascript"></script>


		<script type="text/javascript"> 
				 
				
				function showPageLoader(){  /* show loading image */

					$('.loader-background').fadeIn(100);
					$('.loader-background').css("z-index", "9999999");
					
				}

				function hidePageLoader(){  /* hide loading image */

					$('.loader-background').fadeOut(3000);
					
				};
				
				$(document).ready(function () {
					
					<?php if($app_error){  echo "$('#appRequired').hide(100);";  } ?> 
					
					function isValidEmailAddress(emailAddress) {
						var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
						return pattern.test(emailAddress);
					}
					
					var navListItems = $('div.setup-panel div a'),
						  allWells = $('.setup-content'),
						  allNextBtn = $('.nextBtn'),
						  allPrevBtn = $('.prevBtn');

					allWells.hide();

					navListItems.click(function (e) {
					  e.preventDefault();
					  var $target = $($(this).attr('href')),
							  $item = $(this);

					  if (!$item.hasClass('disabled')) {
						  navListItems.removeClass('btn-primary').addClass('btn-default');
						  $item.addClass('btn-primary');
						  allWells.hide();
						  $target.show();
						  $target.find('input:eq(0)').focus();
					  }
					});

					allPrevBtn.click(function(){
					  var curStep = $(this).closest(".setup-content"),
						  curStepBtn = curStep.attr("id"),
						  prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

						  prevStepWizard.trigger('click');
					});

					allNextBtn.click(function(){
						var curStep = $(this).closest(".setup-content"),
						  curStepBtn = curStep.attr("id"),
						  nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
						  curInputs = curStep.find("input[type='text'],input[type='password'],input[type='email'],input[type='url'],input[type='checkbox']"),
						  isValid = true;

						$(".form-group").removeClass("has-error");
						for(var i=0; i<curInputs.length; i++){
						  if (!curInputs[i].validity.valid){
							  isValid = false;
							  $(curInputs[i]).closest(".form-group").addClass("has-error");
						  }
						}

						if (isValid)
						  nextStepWizard.removeAttr('disabled').trigger('click');
					});

					$('div.setup-panel div a.btn-primary').trigger('click'); 
										
					
					$('body').on('click','#installwizGrade',function(){  /* install wizGrade Script */
					
						var email = $("#email").val(); 
						
						if($('#acceptTerm').is(":not(:checked)")){
							
							<?php echo "$infoMsg1 Ooooooooops, please accept our terms $sEnd1"; ?>
							
						}else if($('#fname').val() == ""){
						
							<?php echo "$infoMsg1 Ooooooooops, please enter first name $sEnd1"; ?>
											   
						}else if($('#lname').val() == ""){
						
							<?php echo "$infoMsg1 Ooooooooops, please enter last name $sEnd1"; ?>
											   
						}else if((email == "") || (!isValidEmailAddress(email))){
						
							<?php echo "$infoMsg1 Ooooooooops, please enter a valid email address $sEnd1"; ?>
											   
						}else if($('#password').val() == ""){
						
							<?php echo "$infoMsg1 Ooooooooops, please enter a password $sEnd1"; ?>
											   
						}else if($('#url').val() == ""){
						
							<?php echo "$infoMsg1 Ooooooooops, please enter a valid full url $sEnd1"; ?>
											   
						}else if($('#dname').val() == ""){
						
							<?php echo "$infoMsg1 Ooooooooops, please enter database name $sEnd1"; ?>
											   
						}else if($('#dhost').val() == ""){
						
							<?php echo "$infoMsg1 Ooooooooops, please enter database host $sEnd1"; ?>
											   
						}else if($('#duser').val() == ""){
						
							<?php echo "$infoMsg1 Ooooooooops, please enter database user name $sEnd1"; ?>
											   
						}else if($('#dpassword').val() == ""){
						
							<?php echo "$infoMsg1 Ooooooooops, please enter database  password $sEnd1"; ?>
											   
						}else{ 
							
							$('#frmwizGrade').submit(function(event) {
									
								event.stopImmediatePropagation();
											
								$('#loader-background').show();
								$('#installwizGrade').fadeOut(100); 
								$('.install-loader').fadeIn(100); 
								
								$('html, body').animate({ scrollTop:  $('#iBox').offset().top - 150 }, 'slow');
													
								$.post('installManger.php', $(this).find('input, select').serialize(), function(data) { 
									
									$("#iBox").html(data); 
								
								});
								
								return false;
						
							});

						}	
										
					}); 
				
				});
		</script> 
 		
		<!-- / jquery  -->		
		

	</body>
	</html>