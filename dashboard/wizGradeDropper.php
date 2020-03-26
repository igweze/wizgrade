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
	This script handle all dropdown auto field
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

      define('wizGrade', 'igweze');  /* define a check for wrong access of file */

      
			require 'configwizGrade.php';  /* load wizGrade configuration files */	   

			if($_GET['func'] == "SelectLevel" && isset($_GET['func'])) {  /* load student selected level */	 

	 			$regNum = $_GET['RegNum'];
	
			
				try {		
				 
						if (studentExitsRV($conn, $regNum) == $foreal) {  /* check if a student really exist */
						
							echo '<div class="form-group">
								  <label for="levelSE" class="col-lg-4 col-sm-4 control-label">* Student
								  Level</label>
							 
								  <div class="col-lg-8">
									<div class="iconic-input">
									  <i class="fa fa-level-up"></i>
									  
									  <select class="form-control"  id="levelSE" name="level" required>
									  
										<option value = "">Please select One</option>';
							 
			
										try {
										
											studentLevel($conn);  /* retrieve student level */
								 
										}catch(PDOException $e) {

											wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
										} 
						
									  

							
							echo '	</select>
									</div>
										</div>
										</div> 
										<input type="hidden" value="studentTranscript" name = "searchData"/>';
							echo'
								<div class="form-group">
								  <label  for="term" class="col-lg-4 col-sm-4 control-label">* Student Term</label>
								 
								<div class="col-lg-8">
									  <div class="iconic-input">
										  <i class="fa fa-book"></i>
										  
										  <select class="form-control"  id="term" name="term" required>
										  
											<option value = "">Please select One</option>';

												try {
												
														$curTerm = currentSessionTerm($conn); /* current school term  */
										 
												}catch(PDOException $e) {

													wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
												} 


												foreach($term_list as $term_key => $term_value){  /* loop array */

													if ($curTerm == $term_key){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'
													</option>' ."\r\n";

												}


									  echo '<option value = "all">Annual Result</option>';
												 echo' </select>
											  </div>
										  </div>
									  </div>';
				

							echo '<div class="form-group">
								  
								  <center><button type="submit" class="btn btn-danger buttonMargin" 
								  id="studentTranscript">
								  <i class="fa fa-search-plus"></i> Search Transcripts </button></center>
								  
								  
									</div>';

						}else{  /* display error */ 
						
						
							$msg_i = "Ooooooooops, this Reg No. $regNum does not Exists";
							echo $errorMsg.$msg_i.$eEnd; echo $scrollUp; exit; 			
						
						
						}

			
					}catch(PDOException $e) {

						echo $e->GETMessage();

					}
						
			}


			if($_GET['func'] == "CheckRegNum" && isset($_GET['func'])) {  /* load new student registration number */	 

	 			$sessData = $_GET['RegNum'];	
					 
				list ($session, $level) = explode ("#@@#", $sessData);
			
				try {			
								 									
					if($session != ''){
							
						$lastSessReg = sessionLastReg($conn, $session);  /* school session last student registration number  */
						
						$regC = explode("/", $lastSessReg);
						
						$regCount = count($regC);
						
						if($regCount == $thVal){
							
							list ($schSplit, $regSplit, $sup) = explode ("/", $lastSessReg);
							
						}elseif($regCount == $seVal){
							
							list ($regSplit, $sup) = explode ("/", $lastSessReg);
							
						}else{
							
							list ($regSplit) = explode ("/", $lastSessReg);

						}	
											 
						/* generate new  student registration number  */						
						  
						if($regSplit == ''){
												
							$newReg = $session.'0001';
													
						}else{
												
							$newReg = ($regSplit + $fiVal);
									
						}			 
						
						if($regCount == $thVal){
							
							$newReg =  $schSplit.'/'.$newReg.$supRegNo; /* generate new  student registration number  */	
							
						}elseif($regCount == $seVal){
							
							$newReg =  $newReg.$supRegNo; /* generate new  student registration number  */	
							
						}else{
							
							$newReg =  $newReg.$supRegNo; /* generate new  student registration number  */	

						}
								
						echo '<div class="form-group"> <label for="regnum"  class="col-lg-4 col-sm-4 control-label">* <strong>Student 
							New Reg. No. '.$lastSessReg.'</strong></label>

							<div class="col-lg-8">
							<div class="iconic-input">
							<i class="fa fa-user"></i>
							<input type="text" class="form-control"  
							value ="'.$newReg.'"  maxlength="8"
							name="regnum" id="regnum" disabled required />
							</div>
							</div>
						</div>';

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


						echo '<div class="form-group">
						<label for="class" class="col-lg-4 col-sm-4 control-label">* Student Class
						</label>

						<div class="col-lg-8">
						<div class="iconic-input">
						<i class="fa fa-level-down"></i>

						<select class="form-control"  id="class" name="class" required>

						<option value = "">Please select One</option>'; 

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
									
									$classCount = 0;
									
								}

								echo '<option value="'.$classKey.'">'.$classVal.' -  '.$classCount.' </option>' ."\r\n";
	 
							}


						echo '</select>
						</div>
						</div>
						</div>'; 
											
						echo'
						<div class="form-group">
							<label  for="term" class="col-lg-4 col-sm-4 control-label">* Student Term
							</label>

							<div class="col-lg-8">
							<div class="iconic-input">
							<i class="fa fa-book"></i>

							<select class="form-control"  id="term" name="term" required>

							<option value = "">Please select One</option>';

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

							echo' </select>
							</div>
							</div>
						</div>'; 

						echo '<input type="hidden" value="newStuBioData" name = "newBioData"/>
						<input type="hidden" value ="'.$newReg.'" name = "newRegNum"/>


						<div class="form-group">
						<center><button type="submit" class="btn btn-danger buttonMargin" id="newStudent">
						<i class="fa fa-save"></i> Register </button></center>
						</div>'; 	
									 	

					}else{  /* display error */  		
									
						$msg_i = "Ooooooooops, Please select a valid student session.";
						echo $errorMsg.$msg_i.$eEnd; echo $scrollUp; exit; 		 
									
					} 
        				
				}catch(PDOException $e) {
  			
					echo $e->GETMessage();
			 
				}
						
			}



			if($_GET['func'] == "studentLevel" && isset($_GET['func'])) {  /* load student level */	  

					$level = $_GET['level'];
				 
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

						<select class="form-control"  id="class" name="class" required>

						<option value = "">Please select One</option>'; 

							foreach($classArrayList as $classKey => $classVal){  /* loop array */ 

								echo '<option value="'.$classKey.'">'.$classVal.'</option>' ."\r\n"; 

							} 
							
						echo '</select>
						</div>
						</div>
					</div>'; 

			}
		
		
		
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


			if($_GET['func'] == "studentLevelCM" && isset($_GET['func'])) {  /* load student level */	  

					$level = $_GET['level'];
				 
					$clArray = studentClassArray($conn, $level);  /* retrieve student class array */
				 
					$classArray = unserialize($clArray);

					$classArray_l = ((count($classArray)) - 1);
					
					for($i = $i_false; $i <= $classArray_l; $i++){  /* loop array */
					
						$classList[] = $class_list[$i];
					
					}
					
					$classArrayList = array_combine($classList, $classArray);  /* combine arrays */	 
 

					echo '<div class="form-group">
						<label for="class" class="col-lg-4 col-sm-4 control-label">* Student Class
						</label>

						<div class="col-lg-8">
						<div class="iconic-input">
						<i class="fa fa-level-down"></i>

						<select class="form-control"  id="class" name="class" required>

						<option value = "">Please select One</option>'; 

							foreach($classArrayList as $classKey => $classVal){  /* loop array */

								echo '<option value="'.$classKey.'">'.$classVal.'</option>' ."\r\n"; 

							}

						echo '<option value="all"> All Class</option>' ."\r\n";

						echo '</select>
						</div>
						</div>
					</div>'; 
 			
			}

			if($_GET['subjData'] == "subjLevel" && isset($_GET['subjData'])) {  /* load school level and subject  */ 

			 
				$classInfo = $_GET['level'];
				$classAll = $_GET['classAll'];
				$term = $_GET['subjTerm'];	
				$euData = $_GET['euData'];	

				if(($classInfo == "") || ($term == "")){exit;}	
				list($uClass, $uTitle, $uSubject) = explode(":<$?$>:", $euData);
			 
				if ($admin_grade == $staffGrade) {  /* if user is school staff/teacher */ 
				 
					list($session, $level) = explode("::-::", $classInfo);
			 
					$sessionID = sessionID($conn, $session);  /* school session ID */

					$teacherClass = formTeacherClass($conn, $adminID, $sessionID, $level);  /* assign class teacher class  array */ 

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

					<select class="form-control"  id="class" name="class" required>

					<option value = "">Please select One </option>'; 

						if (in_array('all', $teacherClass)) {  /* check if teacher was assign to all class */

							foreach($classArrayList as $classKey => $classVal){  /* loop array */ 

								$classKey = trim($classKey);

								if($classKey == $uClass){
									
									$selected = "SELECTED";
									
								}else{

									$selected = "";

								}	 

								echo '<option value="'.$classKey.'"'.$selected.'">'.$classVal.'</option>' ."\r\n"; 
											
							}

							if($uClass == "all"){
								
								$selected = "SELECTED";
								
							}else{

								$selected = "";
							}	
 
							echo '<option value="all"'.$selected.'> All Class</option>' ."\r\n";



						}else{  /* if not assign to all class */

							foreach($classArrayList as $classKey => $classVal){  /* loop array */

								if (in_array($classKey, $teacherClass)) {   /* load only class assign to this teacher */

									$classKey = trim($classKey);

									if($classKey == $uClass){
										
										$selected = "SELECTED";
										
									}else{

										$selected = "";

									}	 

									echo '<option value="'.$classKey.'"'.$selected.'">'.$classVal.'</option>' ."\r\n"; 

								}

							}

						}

					echo '</select><input type="hidden" name="sess" value="'.$session.'"/>
					<input type="hidden" name="level" value="'.$level.'"/>	
					</div>
					</div>
					</div>';
		
				}else{  /* if user is admin */ 
			 
					 
					  
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

							<select class="form-control"  id="class" name="class" required>

							<option value = "">Please select One</option>'; 

							foreach($classArrayList as $classKey => $classVal){  /* loop array */

								$classKey = trim($classKey);
								
								if($classKey == $uClass){

									$selected = "SELECTED";

								}else{

									$selected = "";
								}	

								echo '<option value="'.$classKey.'"'.$selected.'>'.$classVal.'</option>' ."\r\n"; 

							}


							if($uClass == "all"){

								$selected = "SELECTED";

							}else{

								$selected = "";
								
							}	
							
							if($classAll == $fiVal){ echo '<option value="all"'.$selected.'> All Class</option>' ."\r\n";}


							echo '</select><input type="hidden" name="sess" value="'.$session.'"/>
							<input type="hidden" name="level" value="'.$level.'"/>	
							</div>
							</div>
						</div>';
				}							
									
				echo '<div class="form-group">
					<label for="eTitle" class="col-lg-4 col-sm-4 control-label">* Title</label>
					<div class="col-lg-8">
					<div class="iconic-input">
					<i class="fa fa-header"></i>
					<input type="text"  id="eTitle" name="eTitle" 
					class="form-control" placeholder="Enter  Title" value="'.$uTitle.'">
					</div>
					</div>
				</div>';

				echo '<div class="form-group">
					<label for="eSubject" class="col-lg-4 col-sm-4 control-label">* Select Subject</label>

					<div class="col-lg-8">
					<div class="iconic-input">
					<i class="fa fa-bars"></i>

					<select class="form-control"  id="eSubject" name="eSubject" required>
						<option value = "">Please select One</option>'; 

							try {

								$subjectArr = schoolCoursesInfo($conn, $schoolID, $level, $term);  /* school subjects information */			
								$subjectArrC = count($subjectArr);

							}catch(PDOException $e) {

							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

							}

							if($subjectArrC >= $fiVal){  /* check array is empty */		

								$uSubject =  preg_replace("/[^A-Za-z0-9 ]/", "", $uSubject);
								$uSubject = trim($uSubject);

								for($i = $fiVal; $i <= $subjectArrC; $i++){  /* loop array */	

									$cfID = $subjectArr[$i]["cf_id"];
									$cf_code = $subjectArr[$i]["cf_code"];
									$cf_raw = $subjectArr[$i]["cf_raw"];
									$cf_tittle = $subjectArr[$i]["cf_tittle"];
									$cf_tittle = trim($cf_tittle);

									if($cf_tittle == $uSubject){

										$selected = "SELECTED";

									}else{

										$selected = "";
										
									}																			

									echo '<option value="'.$cf_tittle.'"'.$selected.'>'.$cf_tittle.'</option>' ."\r\n";


								}

							}	 

					echo '</select>

					</div>

					</div>
				</div>';		 
 			
			}
		
			if($_GET['subjTerm'] == "subjDropTerm" && isset($_GET['subjTerm'])) {  /* load subject exam div */	 
			
			 
					$term = $_GET['term']; 
				 
					if($term >= $fiVal){
					 
						echo "<script type='text/javascript'> $('#subjectExamDiv').show(); </script>";  				
					 
					}else{
						
						echo "<script type='text/javascript'> $('#subjectExamDiv').hide(); </script>";  
						
					}	
				
				
		
			}
		
			if($_GET['func'] == "fteachSession" && isset($_GET['func'])) {  /* load form teacher level */		

					$session = $_GET['session'];
					$sessionID = sessionID($conn, $session);  /* school session ID */
				 

					echo '<div class="form-group">
						<label for="level" class="col-lg-4 col-sm-4 control-label">* Class Level</label>

						<div class="col-lg-8">
						<div class="iconic-input">
						<i class="fa fa-level-up"></i>

						<select class="form-control"  id="ftlevel" name="level" required>

						<option value = "">Please select One</option>';

							try { 

								$teacherLevel = formTeacherLevel($conn, $adminID, $sessionID);  /* assign class teacher session array */ 
								$levelArray = studentLevelsArray($conn);  /* retrieve student class array */
								array_unshift($levelArray,"");
								unset($levelArray[0]);
													
								foreach($teacherLevel as $tLevelKey => $tLevelVal){  /* loop array */

									$tLevelMKey = $tLevelVal['level'];
									$studentLevel = $levelArray[$tLevelMKey]['level'];
									echo '<option value="'.$tLevelMKey.'">'.$studentLevel.'</option>' ."\r\n";

								} 

							}catch(PDOException $e) {

							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

							} 

						echo ' </select>
						</div>
						</div>
					</div>';

					echo '<span id="wait_11" style="display: none;">
					<center><img alt="Please Wait" src="loading.gif"/></center><!-- loading image -->
					</span>
					<span id="result_11" style="display: none;"></span> <!-- loading div --> '; 
 			
			}

			if($_GET['func'] == "fteachLevel" && isset($_GET['func'])) {   /* load form teacher level */

					$level = $_GET['level'];
					$session = $_GET['session'];
				 
					if($level == ""){exit;}
					
					$sessionID = sessionID($conn, $session);  /* school session ID */
				  
					$teacherClass = formTeacherClass($conn, $adminID, $sessionID, $level);  /* assign class teacher session array */ 
									 
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

						<select class="form-control"  id="class" name="class" required>

						<option value = "">Please select One </option>'; 

							if (in_array('all', $teacherClass)) {  /* check if teacher was assign to all class */

								foreach($classArrayList as $classKey => $classVal){  /* loop array */

									echo '<option value="'.$classKey.'">'.$classVal.'</option>' ."\r\n"; 
													
								}

							}else{   /* load only class assign to this teacher */

								foreach($classArrayList as $classKey => $classVal){  /* loop array */

									if (in_array($classKey, $teacherClass)) {   /* load only class assign to this teacher */

										echo '<option value="'.$classKey.'">'.$classVal.'</option>' ."\r\n"; 

									}

								}

							}

						echo '</select>
						</div>
						</div>
					</div>';


 			
			}
		
			if($_GET['func'] == "sessionLev" && isset($_GET['func'])) {   /* load form teacher level */ 

					$classInfo = $_GET['level'];
				 
					if($classInfo == ""){exit;}
				  
					list($session, $level) = explode("::-::", $classInfo);
				 
					$sessionID = sessionID($conn, $session);  /* school session ID */
				  
					$teacherClass = formTeacherClass($conn, $adminID, $sessionID, $level);  /* assign class teacher session array */ 
									 
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

						<select class="form-control"  id="class" name="class" required>

						<option value = "">Please select One </option>'; 


						if (in_array('all', $teacherClass)) {  /* check if teacher was assign to all class */

							foreach($classArrayList as $classKey => $classVal){  /* loop array */ 

								echo '<option value="'.$classKey.'">'.$classVal.'</option>' ."\r\n"; 
													
							}

						}else{

							foreach($classArrayList as $classKey => $classVal){   /* load only class assign to this teacher */

								if (in_array($classKey, $teacherClass)) {   /* load only class assign to this teacher */ 

									echo '<option value="'.$classKey.'">'.$classVal.'</option>' ."\r\n"; 

								}

							}

						}

						echo '</select><input type="hidden" name="sess" value="'.$session.'"/>
						<input type="hidden" name="level" value="'.$level.'"/>	
						</div>
						</div>
					</div>'; 

 			
			} 


			if($_GET['func'] == "teacherPic" && isset($_GET['func'])) {  /* load staffs/teachers picture */ 

				$teacherID = $_GET['teacherID']; 
			 
				try{
				 
					$teacherPic  = staffPicture($conn, $teacherID);  /* school staffs/teachers picture */
			 
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
			 
				echo'	<div class="form-group">
                                <label for="sess" class="col-lg-4 col-sm-4 control-label">* Teacher/Staff Picture</label>
                                     
                                <div class="col-lg-8 picTDIv">
                                          
									<center><img src="'.$teacherPic.'" height="150" width = "150"/></center>
									
                                </div>
                        </div>'; 
 			
			}

 
	

?>