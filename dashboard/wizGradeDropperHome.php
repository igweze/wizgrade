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
	This script handle student registration dropdown 
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

			define('wizGrade', 'igweze');  /* define a check for wrong access of file */

			require 'configINwizGrade.php';  /* load wizGrade configuration files */
	  
			if($_GET['func'] == "stuLevelReg" && isset($_GET['func'])) { 

			 
				$levelSchool = $_GET['level'];
			 
				list($schoolID, $level) = explode('-', $levelSchool);
			 
				$supRegNo = $schoolRegSuffArr[$schoolID];
			
				require_once $wizGradeSchoolTBS; /* include student database table information  */
			 

				$sessionInfoSec = currentSessionInfo($conn);  /* current school session information  */
			
				list ($fiSessionID, $fiSession) = explode ("@$@", $sessionInfoSec);
			
				$seSessionID =  ($fiSessionID - $fiVal);
				
				$thSessionID =  ($fiSessionID - $seVal);
			
				$foSessionID =  ($fiSessionID - $thVal);
			
				$fifSessionID =  ($fiSessionID - $foVal);
			
				$sixSessionID =  ($fiSessionID - $fifVal);

				$clArray = studentClassArray($conn, $level);  /* retrieve student class array */
			 
				$classArray = unserialize($clArray);

			    $classArray_l = ((count($classArray)) - 1);
				
				for($i = $i_false; $i <= $classArray_l; $i++){  /* loop array */
				
					$classList[] = $class_list[$i];
				
				}
				
				$classArrayList = array_combine($classList, $classArray);  /* combine arrays */	  

				if($level == $fiVal){  /* check student level  and generate new  registration number  */
				
					$sessionID = $fiSessionID;										
					$lastSessReg = sessionLastRegID($conn, $sessionID);  /* school session last student registration ID  */
					
					list ($regSplit, $sup) = explode ("/", $lastSessReg);
										
					if($regSplit == ''){
										
						$session = wizGradeSession($conn, $sessionID);  /* school session  */											
						$newReg = $session.'0001';
											
					}else{
										
						$newReg = ($regSplit + $fiVal);
					}
										

					$newRegNo =  $newReg.$supRegNo;
					
				}elseif($level == $seVal){  /* check student level  and generate new  registration number  */
					
					$sessionID = $seSessionID;
					$lastSessReg = sessionLastRegID($conn, $sessionID);  /* school session last student registration ID  */
					
					list ($regSplit, $sup) = explode ("/", $lastSessReg);
										
					if($regSplit == ''){
						
						$session = wizGradeSession($conn, $sessionID);  /* school session  */		
						$newReg = $session.'0001';
											
					}else{
										
						$newReg = ($regSplit + $fiVal);
					}
										

					$newRegNo =  $newReg.$supRegNo;
					
				}elseif($level == $thVal){  /* check student level  and generate new  registration number  */
					
					$sessionID = $thSessionID;
					$lastSessReg = sessionLastRegID($conn, $sessionID);  /* school session last student registration ID  */
					
					list ($regSplit, $sup) = explode ("/", $lastSessReg);
										
					if($regSplit == ''){
						
						$session = wizGradeSession($conn, $sessionID);  /* school session  */	
						$newReg = $session.'0001';
											
					}else{
										
						$newReg = ($regSplit + $fiVal);
					}
										

					$newRegNo =  $newReg.$supRegNo;
					
				}elseif($level == $foVal){  /* check student level  and generate new  registration number  */
					
					$sessionID = $foSessionID;
					$lastSessReg = sessionLastRegID($conn, $sessionID);  /* school session last student registration ID  */
					
					list ($regSplit, $sup) = explode ("/", $lastSessReg);
										
					if($regSplit == ''){
						
						$session = wizGradeSession($conn, $sessionID);  /* school session  */	
						$newReg = $session.'0001';
											
					}else{
										
						$newReg = ($regSplit + $fiVal);
					}
										

					$newRegNo =  $newReg.$supRegNo;
					
				}elseif($level == $fifVal){  /* check student level  and generate new  registration number  */
					
					$sessionID = $fifSessionID;
					$lastSessReg = sessionLastRegID($conn, $sessionID);  /* school session last student registration ID  */
					
					list ($regSplit, $sup) = explode ("/", $lastSessReg);
										
					if($regSplit == ''){
						
						$session = wizGradeSession($conn, $sessionID);  /* school session  */	
						$newReg = $session.'0001';
											
					}else{
										
						$newReg = ($regSplit + $fiVal);
					}
										

					$newRegNo =  $newReg.$supRegNo;
					
				}elseif($level == $sixVal){  /* check student level  and generate new  registration number  */
					
					$sessionID = $sixSessionID;
					$lastSessReg = sessionLastRegID($conn, $sessionID);  /* school session last student registration ID  */
					
					list ($regSplit, $sup) = explode ("/", $lastSessReg);
										
					if($regSplit == ''){
										
						$session = wizGradeSession($conn, $sessionID);  /* school session  */
						$newReg = $session.'0001';
											
					}else{
										
						$newReg = ($regSplit + $fiVal);
					}
										

					$newRegNo =  $newReg.$supRegNo;
					
				}else{  /* no registration number */ 
					
					$newRegNo = '';
					$sessionID = '';
					
				}

				echo '<div class="col-lg-6">                                           
						  
						<select class="form-control"  id="class" name="class" required>
						  
							<option value = "">Select Class</option>';
							
							 	 

								foreach($classArrayList as $classKey => $classVal){  /* loop array */ 
								
									if($level == $fiVal){
									
										$classCount = studentClassCount($conn, $fiSessionID, $classKey, $level);  /* count 100 level class */
										$classCount = 'Total Student/s - '.$classCount;
									
									}elseif($level == $seVal){
										
										$classCount = studentClassCount($conn, $seSessionID, $classKey, $level);  /* count 200 level class */
										$classCount = 'Total Student/s - '.$classCount;
										
									}elseif($level == $thVal){
										
										$classCount = studentClassCount($conn, $thSessionID, $classKey, $level);  /* count 300 level class */
										$classCount = 'Total Student/s - '.$classCount;
										
									}elseif($level == $foVal){
										
										$classCount = studentClassCount($conn, $foSessionID, $classKey, $level);  /* count 400 level class */
										$classCount = 'Total Student/s - '.$classCount;
										
									}elseif($level == $fifVal){
										
										$classCount = studentClassCount($conn, $fifSessionID, $classKey, $level);  /* count 500 level class */
										$classCount = 'Total Student/s - '.$classCount;
										
									}elseif($level == $sixVal){
										
										$classCount = studentClassCount($conn, $sixSessionID, $classKey, $level);  /* count 600 level class */
										$classCount = 'Total Student/s - '.$classCount;
										
									}else{
										
										$classCount;
										
									}
									
									echo '<option value="'.$sessionID.'-'.$classKey.'">'.$classVal.' - '.$classCount.'</option>' ."\r\n";
									
									$Type++;
								
								}

				
				echo '</select> </div> <br />	<br />'; 
				
				echo '<div class="col-lg-6">
				 
						  <input type="text" class="form-control" value ="'.$pre_regnum.$newRegNo.'"  maxlength="15" name="regnum" 
						  id="regnum" disabled required />
						</div> <br />	<br /> '; 

				echo '<div class="col-lg-6">
				 
						<select class="form-control"  id="term" name="term" required>
						  
							<option value = "">Select Term</option>'; 

								try {
								
										$curTerm = currentSessionTerm($conn);  /* current school term  */
						 
								}catch(PDOException $e) {
	
								wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
	 
								}  

								foreach($term_list as $term_key => $term_value){  /* loop array */

									if ($curTerm == $term_key){
										$selected = "SELECTED";
									} else {
										$selected = "";
									}

									echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

								}

				   
				echo '</select>  </div>';

 			
			}



?>