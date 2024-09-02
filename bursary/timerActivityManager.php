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
	This script handle screen lock timer
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

		define('fobrain', 'igweze');  /* define a check for wrong access of file */ 
		
			if(($_SESSION['screenTimer'] != "") && (isset($_SESSION['screenTimer'])) && ($_SESSION['screenTimer'] > 1)){   /* check if inactivity time is set */ 
			
				if (($_REQUEST['timeOutType'] == 'checkADMINTimer')){  /* screen lock timer validation */ 

									
					if (isset($_SESSION['lastADMINActivity']) && (time() - $_SESSION['lastADMINActivity'] > 
					($_SESSION['screenTimer'] * 60) )) {  /* check if inactivity time */ 
				
						$_SESSION['lockAdminScreen'] = 'IluvNjideka';
						$_SESSION['lockMyfScreen'] = 'IluvMyChukwu';
						
						echo "<script type='text/javascript'>  $('.pageRefresh').trigger('click');</script>"; exit;
						  
					} 
				 
				} 

			}else{
				
					unset($_SESSION['lockAdminScreen']);
					unset($_SESSION['lockMyfScreen']);
					exit;
						
			}			

?>