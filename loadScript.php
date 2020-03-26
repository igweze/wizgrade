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
	This script load jQuery/Javascript
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
     
	if (($_POST['pageType']) == 'loadScript') {

?>

	<script type="text/javascript">
		 
    	$("body").on("click","#login-btn",function(){$("#frmLogin").submit(function(o){return o.stopImmediatePropagation(),$(".page-loader").show(),$.post("login-manager.php",$(this).find("inputs, select").serialize(),function(o){$("#iBox").html(o),$("div#iBox").show(),$("div#iBox").fadeOut(1e4)}),!1})}),$("body").on("click","#recover-pass",function(){$("#frmrecoverPass").submit(function(o){return o.stopImmediatePropagation(),$(".page-loader").show(),$.post("recovery-manager.php",$(this).find("inputs, select").serialize(),function(o){$("#rBox").html(o),$("div#rBox").show(),$("div#rBox").fadeOut(1e4)}),!1})}),$("body").on("click","#reset-password",function(){$("#frmresetPassword").submit(function(o){return o.stopImmediatePropagation(),$(".page-loader").show(),$.post("recovery-manager.php",$(this).find("inputs, select").serialize(),function(o){$("#rBox").html(o),$("div#rBox").show(),$("div#Box").fadeOut(1e4)}),!1})}),$("body").on("click","#save-reg",function(o){return o.stopImmediatePropagation(),$(".frmsave-reg").ajaxForm({target:"#msgBox",beforeSubmit:function(){console.log("y"),$("#reg-loader").fadeIn(100)},success:function(){console.log("b"),$("#reg-loader").fadeOut(5e3)},error:function(){console.log("q"),$("#reg-loader").fadeOut(100)}}).submit(),!1});  
		
	</script>


	<?php }else{ exit; } exit;?> 