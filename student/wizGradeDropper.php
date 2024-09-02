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
	This script handle all dropdown auto field
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

      define('fobrain', 'igweze');  /* define a check for wrong access of file */

      
			require 'configwizGrade.php';  /* load wizGrade configuration files */	   
		
			if($_GET['func'] == "sLevel" && isset($_GET['func'])) {  /* load student level */	   

			 
					$classInfo = $_GET['level'];
					$classAll = $_GET['classAll'];
				 
					if($classInfo == ""){exit;}
					
					list($session, $level) = explode("#@@#", $classInfo);
				 
					if($level == ""){exit;}
				 
					$clArray = studentClassArray($conn, $level);  /* retrieve student class array */
				 
					$classArray = unserialize($clArray);

					$classArray_l = ((count($classArray)) - 1);
					
					for($i = $i_false; $i <= $classArray_l; $i++){  /* loop array */
					
						$classList[] = $class_list[$i];
					
					}
					
					$classArrayList = array_combine($classList, $classArray);  /* combine arrays */  

					echo '<div class="form-group">
						<label for="class" class="col-lg-4 col-sm-4 control-label">* Select Class</label>

						<div class="col-lg-8">
						<div class="iconic-input">
						<i class="fa fa-level-down"></i>

						<select class="form-control"  id="studentClass" name="class" required>

						<option value = "">Please select One</option>'; 

							foreach($classArrayList as $classKey => $classVal){ 

								echo '<option value="'.$classKey.'">'.$classVal.'</option>' ."\r\n";


							} 
							
							if($classAll == $fiVal){ echo '<option value="all"> All Class</option>' ."\r\n";} 
							
						echo '</select><input type="hidden" name="sess" value="'.$session.'"/>
						<input type="hidden" name="level" value="'.$level.'"/>	
						</div>
						</div>
					</div>'; 
 			
			}
	

?>