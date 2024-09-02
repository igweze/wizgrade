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
	This script handle regstration dropdown 
		
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 

		define('fobrain', 'igweze');  /* define a check for wrong access of file */
		 
		require_once 'sources/functions/configDirIn.php';  /* include configuration script */
		
		require_once $wizGradeFunctionDir;  /* load script functions */			
		require ($wizGradeDBConnectIndDir);   /* load connection string */ 

		if($_GET['func'] == "school-type" && isset($_GET['func'])) { 

			$school = $_GET['school'];

			$level_list = mlevelArrays($school); /* online registration level array */

			echo '<div class="form-group">
			<label for="class" class="col-lg-5 col-sm-5 control-label">* 
			Enrollment Class</label>

			<div class="col-lg-7">
			<div class="iconic-input">
			<i class="fa fa-level-down"></i>

			<select class="form-control"  id="class" name="class" required>

			<option value = "">Please select One</option>';


			foreach($level_list as $level => $levelVal){  /* loop array */

				echo '<option value="'.$level.'"'.$selected.'>'.$levelVal.'</option>' ."\r\n";

			}

			echo '</select>
			</div>
			</div>
			</div>';
  

		} 

?> 