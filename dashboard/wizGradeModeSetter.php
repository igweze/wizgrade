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
	This script handle school session activation mode
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	
		
			if (($_REQUEST['wizGradeData'] == 'actMode')){

				$wizGradeMode = $_REQUEST['wizGradeMode'];
				$wizGradeMode = strip_tags($wizGradeMode);
				
				/* script validation */ 
				
				if($wizGradeMode == ""){$wizGradeMode = $seVal;}
				
				unset($_SESSION['wizGradeRunMode']);$wizGradeRunModeArr[$seVal]; 
				
				if($wizGradeMode == $fiVal){  /* activate session run mode */
					
					$_SESSION['wizGradeRunMode'] = $fiVal;
					
					$hideMode = "$('#wizGradeMode-".$fiVal."').hide(300);";
					$showMode = "$('#wizGradeMode-".$seVal."').show(300);";
					
				 
				}elseif($wizGradeMode == $seVal){  /* activate current run mode */
					
					$_SESSION['wizGradeRunMode'] = $seVal;
					$hideMode = "$('#wizGradeMode-".$seVal."').hide(300);";
					$showMode = "$('#wizGradeMode-".$fiVal."').show(300);";
					
				}else{  /* activate current run mode */
					
					$_SESSION['wizGradeRunMode'] = $seVal;
					$hideMode = "$('#wizGradeMode-".$seVal."').hide(300);";
					$showMode = "$('#wizGradeMode-".$fiVal."').show(300);"; 					
				}	
				
				$sRunMode = $wizGradeRunModeArr[$wizGradeMode];
				
				$msg_s = "*School Running Mode Successfully Activated to <strong>$sRunMode</strong>.";
					
				echo $succesMsg.$msg_s.$sEnd ;  
					
$script =<<<IGWEZE
				
				<script type="text/javascript"> 				
				$("#runModeText").html("$sRunMode");
				$hideMode $showMode
				$(".alert-success").fadeOut(8000);
				hidePageLoader();  /* hide page loader */	
				</script>
		
IGWEZE;
				echo $script;
			 
		 
		 	}
		 
exit;
?>