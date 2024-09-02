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
	This script load school configuration and database files
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

			require ($wizGradevalidater); 

			if($schoolID == $fiVal){  /* load nursery school */
				 
				require_once ($wizGradeDir.$wizGradeNurConfig);
				$schoolExt = $wizGradeNurAbr;
				
			}elseif($schoolID == $seVal){  /* load primary school */
				 
				require_once ($wizGradeDir.$wizGradePRIConfig);
				$schoolExt = $wizGradePriAbr;
				
			}elseif($schoolID == $thVal){  /* load secondary school */
				 
				require_once ($wizGradeDir.$wizGradeSECConfig);
				$schoolExt = $wizGradeSecAbr;
				
			}else{  /* else display critical error */
				
				$msg_e = "*Ooooooops, a Critcal Error has Occured, Please contact the developers. Thanks.";
				echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit;
				 
			}
			
			require 'commonConfigTB.php';
			 
?>			 