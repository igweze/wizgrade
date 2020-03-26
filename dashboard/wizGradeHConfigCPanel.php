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
	This script handle school setup configurations
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configwizGrade.php';  /* load wizGrade configuration files */	   
		 

			if (($_REQUEST['schoolSettings']) == 'examConfigs') {  /* save school exam type configuration */

				$status =  preg_replace("/[^0-9']/", "", $_REQUEST['status']);
				$rsType =  preg_replace("/[^0-9']/", "", $_REQUEST['rsType']);
				$first =  preg_replace("/[^0-9']/", "", $_REQUEST['first']);
				$second =  preg_replace("/[^0-9']/", "", $_REQUEST['second']);
				$third =  preg_replace("/[^0-9']/", "", $_REQUEST['third']);
				$fourth =  preg_replace("/[^0-9']/", "", $_REQUEST['fourth']);
				$fifth =  preg_replace("/[^0-9']/", "", $_REQUEST['fifth']);
				$sixth =  preg_replace("/[^0-9']/", "", $_REQUEST['sixth']);
				$exam =  preg_replace("/[^0-9']/", "", $_REQUEST['exam']);
				
				$total = $first + $second + $third + $fourth + $fifth + $sixth + $exam;
				
				/* script validation */ 
				
				if ($rsType == "")  {
         			
					$msg_e = "* Ooooooops Error, please select  school result type template ";
					
	   			}elseif ($status == "")  {
         			
					$msg_e = "* Ooooooops Error, please select  School No. of Continous Assessment ";
					
	   			}elseif ($first == "")  {
         			
					$msg_e = "* Ooooooops Error, please input student first Continous Assessment Score";
						
	   			}elseif ($exam == "")  {
         			
					$msg_e = "* Ooooooops Error, please input student Exam Score";
						
	   			}elseif (($total < 100) ||  ($total > 100)){
         			
					$msg_e = "* Ooooooops Error, please total student Continous Assessment should be 100";
						
	   			}else {  /* update information */

					try { 
					
						$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
						 
						$countArr = count($examArray); 
						
						if(($countArr == $i_false)){  /* check if array is empty */

							$ebele_mark = "INSERT INTO $rsExamConfigTB (fi_ass, se_ass, th_ass, fo_ass, fif_ass, six_ass, exam, 
							rsType, status)
							
							VALUES (:fi_ass, :se_ass, :th_ass, :fo_ass, :fif_ass, :six_ass, :exam, :rsType, :status)";
											
							$igweze_prep = $conn->prepare($ebele_mark);								
							$igweze_prep->bindValue(':fi_ass', $first);
							$igweze_prep->bindValue(':se_ass', $second);
							$igweze_prep->bindValue(':th_ass', $third);
							$igweze_prep->bindValue(':fo_ass', $fourth);
							$igweze_prep->bindValue(':fif_ass', $fifth);
							$igweze_prep->bindValue(':six_ass', $sixth);
							$igweze_prep->bindValue(':exam', $exam);
							$igweze_prep->bindValue(':rsType', $rsType);
							$igweze_prep->bindValue(':status', $status);
					 
						}else{	
 
							$ebele_mark = "UPDATE $rsExamConfigTB SET
						 
											fi_ass = :fi_ass,
											se_ass = :se_ass,
											th_ass = :th_ass,
											fo_ass = :fo_ass,
											fif_ass = :fif_ass,
											six_ass = :six_ass,
											exam = :exam,
											rsType = :rsType,
											status = :status
											
											WHERE ex_id = :ex_id";
											
							$igweze_prep = $conn->prepare($ebele_mark);								
							$igweze_prep->bindValue(':fi_ass', $first);
							$igweze_prep->bindValue(':se_ass', $second);
							$igweze_prep->bindValue(':th_ass', $third);
							$igweze_prep->bindValue(':fo_ass', $fourth);
							$igweze_prep->bindValue(':fif_ass', $fifth);
							$igweze_prep->bindValue(':six_ass', $sixth);
							$igweze_prep->bindValue(':exam', $exam);
							$igweze_prep->bindValue(':rsType', $rsType);
							$igweze_prep->bindValue(':status', $status);
							$igweze_prep->bindValue(':ex_id', $fiVal);
						
						}

						if($igweze_prep->execute()){  /* if sucessfully */

							$msg_s = "School continous assessment Settings was Successfully Saved.";						
							echo "<script type='text/javascript'> $('#frmexamConfigs').slideUp(2000); </script>";								
						
						}else {  /* display error */ 

							$msg_e = "Ooooooops, an error has occur while trying to save school continous assessment. Please try again";
				
						}
							
					}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}			

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'levelSettingsNur') {  /* save nursery school levels */

				$level_1 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_1']);
				$level_2 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_2']);
				$level_3 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_3']);
				
				/* script validation */ 
				
				if ($level_1 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 1";
					
	   			}elseif ($level_2 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 2";
					
	   			}elseif ($level_3 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 3";
					
	   			}else {  /* update information */ 


		 			try {
		 			
						$ebele_mark = "UPDATE $classLevelTB SET
							 
										level = :level
										
										WHERE cl_id = :cl_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
						
						$igweze_prep->bindValue(':level', $level_1);
						$igweze_prep->bindValue(':cl_id', $fiVal);
						$igweze_prep->execute();
						$igweze_prep->bindValue(':level', $level_2);
						$igweze_prep->bindValue(':cl_id', $seVal);
						$igweze_prep->execute();
						$igweze_prep->bindValue(':level', $level_3);
						$igweze_prep->bindValue(':cl_id', $thVal);
						$igweze_prep->execute();

						if ($igweze_prep) {  /* if sucessfully */

								$msg_s = "School Level Settings was Successfully Saved.";
								echo "<script type='text/javascript'>  $('#frmlevelSettings').slideUp(2000);  </script>";
								
						}else{ /* display error */

								$msg_e = "Ooooooops, An Error Has occur
								while trying to save School Level Settings, please try again";

						}
								
					}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}
					

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'levelSettings') {  /* save school levels */

				$level_1 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_1']);
				$level_2 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_2']);
				$level_3 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_3']);
				$level_4 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_4']);
				$level_5 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_5']);
				$level_6 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_6']);

				/* script validation */ 
				
				if ($level_1 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 1";
					
	   			}elseif ($level_2 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 2";
					
	   			}elseif ($level_3 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 3";
					
	   			}elseif ($level_4 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 4";
					
	   			}elseif ($level_5 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 5";
					
	   			}elseif ($level_6 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 6";
					
	   			}else {  /* update information */ 

		 			try {
		 			
						$ebele_mark = "UPDATE $classLevelTB SET
					 
										level = :level
										
										WHERE cl_id = :cl_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
						
						$igweze_prep->bindValue(':level', $level_1);
						$igweze_prep->bindValue(':cl_id', $fiVal);
						$igweze_prep->execute();
						$igweze_prep->bindValue(':level', $level_2);
						$igweze_prep->bindValue(':cl_id', $seVal);
						$igweze_prep->execute();
						$igweze_prep->bindValue(':level', $level_3);
						$igweze_prep->bindValue(':cl_id', $thVal);
						$igweze_prep->execute();
						$igweze_prep->bindValue(':level', $level_4);
						$igweze_prep->bindValue(':cl_id', $foVal);
						$igweze_prep->execute();
						$igweze_prep->bindValue(':level', $level_5);
						$igweze_prep->bindValue(':cl_id', $fifVal);
						$igweze_prep->execute();
						$igweze_prep->bindValue(':level', $level_6);
						$igweze_prep->bindValue(':cl_id', $sixVal);
						$igweze_prep->execute();  
		
						if ($igweze_prep) {  /* if sucessfully */

							$msg_s = "School Level Settings was Successfully Saved.";
							echo "<script type='text/javascript'>  $('#frmlevelSettings').slideUp(2000);  </script>";
						
        				}else {  /* display error */

							$msg_e = "Ooooooops, An Error Has occur
							 while trying to save School Level Settings, please try again";

						}
						
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}				

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'minCourseConfigNur') {  /* save nursery minimum courses */

				$level_1 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_1']);
				$level_2 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_2']);
				$level_3 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_3']);
				
				/* script validation */
				
				if ($level_1 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 1";
					
	   			}elseif ($level_2 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 2";
					
	   			}elseif ($level_3 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 3";
					
	   			}else {  /* update information */ 




		 			try {
		 			
						$ebele_mark = "UPDATE $classLevelTB SET
					 
										minCourse = :minCourse
										
										WHERE cl_id = :cl_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
						
						$igweze_prep->bindValue(':minCourse', $level_1);
						$igweze_prep->bindValue(':cl_id', $fiVal);
						$igweze_prep->execute();
						$igweze_prep->bindValue(':minCourse', $level_2);
						$igweze_prep->bindValue(':cl_id', $seVal);
						$igweze_prep->execute();
						$igweze_prep->bindValue(':minCourse', $level_3);
						$igweze_prep->bindValue(':cl_id', $thVal);
						$igweze_prep->execute();

						if ($igweze_prep) {  /* if sucessfully */

								$msg_s = "School Level Minimum Number of Subjects/Courses Settings was Successfully Saved.";
								echo "<script type='text/javascript'>  $('#frmminCourseConfig').slideUp(2000);  </script>";
								
						}else {  /* display error */

								$msg_e = "Ooooooops, An Error Has occur
								 while trying to save School Level Minimum Number of Subjects/Courses Settings, please try again";

						}
				
					}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					} 

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'minCourseConfig') {  /* save primary and secondary minimum courses */

				$level_1 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_1']);
				$level_2 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_2']);
				$level_3 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_3']);
				$level_4 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_4']);
				$level_5 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_5']);
				$level_6 =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['level_6']);

				/* script validation */ 
				
				if ($level_1 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 1";
					
	   			}elseif ($level_2 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 2";
					
	   			}elseif ($level_3 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 3";
					
	   			}elseif ($level_4 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 4";
					
	   			}elseif ($level_5 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 5";
					
	   			}elseif ($level_6 == "")  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 6";
					
	   			}else {  /* update information */  

		 			try {
		 			
						$ebele_mark = "UPDATE $classLevelTB SET
					 
										minCourse = :minCourse
										
										WHERE cl_id = :cl_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
						
						$igweze_prep->bindValue(':minCourse', $level_1);
						$igweze_prep->bindValue(':cl_id', $fiVal);
						$igweze_prep->execute();
						$igweze_prep->bindValue(':minCourse', $level_2);
						$igweze_prep->bindValue(':cl_id', $seVal);
						$igweze_prep->execute();
						$igweze_prep->bindValue(':minCourse', $level_3);
						$igweze_prep->bindValue(':cl_id', $thVal);
						$igweze_prep->execute();
						$igweze_prep->bindValue(':minCourse', $level_4);
						$igweze_prep->bindValue(':cl_id', $foVal);
						$igweze_prep->execute();
						$igweze_prep->bindValue(':minCourse', $level_5);
						$igweze_prep->bindValue(':cl_id', $fifVal);
						$igweze_prep->execute();
						$igweze_prep->bindValue(':minCourse', $level_6);
						$igweze_prep->bindValue(':cl_id', $sixVal);
						$igweze_prep->execute(); 
						
						if ($igweze_prep) {  /* if sucessfully */ 

								$msg_s = "School Level Minimum Number of Subjects/Courses Settings was Successfully Saved.";
								echo "<script type='text/javascript'>  $('#frmminCourseConfig').slideUp(2000);  </script>";
								
						}else {  /* display error */

								$msg_e = "Ooooooops, An Error Has occur
								 while trying to save School Level Minimum Number of Subjects/Courses Settings, please try again";

						}

					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}					
				

        		}
        
			}elseif (($_REQUEST['schoolSettings']) == 'classSettingsNur') {  /* save nursery classes */

				$class_fi =  preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['class_1']);
				$class_se =  preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['class_2']);
				$class_th =  preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['class_3']);
				
				/* script validation */

				foreach ($_REQUEST['class_1'] as  $value_fi){  /* loop array */
					
					$valueC_fi = preg_replace("/[^A-Za-z0-9 ]/", "", $value_fi);
					
					if ( (!empty($valueC_fi)) || ($valueC_fi != ''))  { $class_fiArr[] = $valueC_fi; }
				
				}

				foreach ($_REQUEST['class_2'] as  $value_se){  /* loop array */
					
					$valueC_se = preg_replace("/[^A-Za-z0-9 ]/", "", $value_se);
					
					if ( (!empty($valueC_se)) || ($valueC_se != ''))  { $class_seArr[] = $valueC_se; }
				
				}

				foreach ($_REQUEST['class_3'] as  $value_th){  /* loop array */
					
					$valueC_th = preg_replace("/[^A-Za-z0-9 ]/", "", $value_th);
					
					if ( (!empty($valueC_th)) || ($valueC_th != ''))  { $class_thArr[] = $valueC_th; }
				
				}

				$count_fiArr = count($class_fiArr);
				$count_seArr = count($class_seArr);
				$count_thArr = count($class_thArr);
				

				if ($count_fiArr == $i_false) {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 1";
					
	   			}elseif ($count_seArr == $i_false)  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 2";
					
	   			}elseif ($count_thArr == $i_false)  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 3";
					
	   			}else {  /* update information */   

		 			try {

						$class_fiArray = array_unique($class_fiArr);
						$class_seArray = array_unique($class_seArr);
						$class_thArray = array_unique($class_thArr);
						
						$class_1 = serialize($class_fiArray);
						$class_2 = serialize($class_seArray);
						$class_3 = serialize($class_thArray);
						
						$ebele_mark = "UPDATE $classLevelTB SET
					 
										class = :class
										
										WHERE cl_id = :cl_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
						
						$igweze_prep->bindValue(':class', $class_1);
						$igweze_prep->bindValue(':cl_id', $fiVal);
						$igweze_prep->execute();
						
						$igweze_prep->bindValue(':class', $class_2);
						$igweze_prep->bindValue(':cl_id', $seVal);
						$igweze_prep->execute();
						
						$igweze_prep->bindValue(':class', $class_3);
						$igweze_prep->bindValue(':cl_id', $thVal);
						$igweze_prep->execute();
							
						if ($igweze_prep) {  /* if sucessfully */ 

								$msg_s = "School Class Name was Successfully Saved.";
								echo "<script type='text/javascript'>  $('#frmclassSettings').slideUp(2000);  </script>";
								
						}else {  /* display error */ 

								$msg_e = "Ooooooops, An Error Has occur 
								while trying to save School Class Name, please try again";

						}

					}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					} 

        		}
				        
			}elseif (($_REQUEST['schoolSettings']) == 'classSettings') {  /* save primary and secondary classes */

				$class_fi =  preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['class_1']);
				$class_se =  preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['class_2']);
				$class_th =  preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['class_3']);
				$class_fo =  preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['class_4']);
				$class_fif =  preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['class_5']);
				$class_six =  preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['class_6']);
				
				/* script validation */ 
				
				foreach ($_REQUEST['class_1'] as  $value_fi){  /* loop array */
					
					$valueC_fi = preg_replace("/[^A-Za-z0-9 ]/", "", $value_fi);
					
					if ( (!empty($valueC_fi)) || ($valueC_fi != ''))  { $class_fiArr[] = $valueC_fi; }
				
				}

				foreach ($_REQUEST['class_2'] as  $value_se){  /* loop array */
					
					$valueC_se = preg_replace("/[^A-Za-z0-9 ]/", "", $value_se);
					
					if ( (!empty($valueC_se)) || ($valueC_se != ''))  { $class_seArr[] = $valueC_se; }
				
				}

				foreach ($_REQUEST['class_3'] as  $value_th){  /* loop array */
					
					$valueC_th = preg_replace("/[^A-Za-z0-9 ]/", "", $value_th);
					
					if ( (!empty($valueC_th)) || ($valueC_th != ''))  { $class_thArr[] = $valueC_th; }
				
				}

				foreach ($_REQUEST['class_4'] as  $value_fo){  /* loop array */
					
					$valueC_fo = preg_replace("/[^A-Za-z0-9 ]/", "", $value_fo);
					
					if ( (!empty($valueC_fo)) || ($valueC_fo != ''))  { $class_foArr[] = $valueC_fo; }
				
				}

				foreach ($_REQUEST['class_5'] as  $value_fif){  /* loop array */
					
					$valueC_fif = preg_replace("/[^A-Za-z0-9 ]/", "", $value_fif);
					
					if ( (!empty($valueC_fif)) || ($valueC_fif != ''))  { $class_fifArr[] = $valueC_fif; }
				
				}

				foreach ($_REQUEST['class_6'] as  $value_six){  /* loop array */
					
					$valueC_six = preg_replace("/[^A-Za-z0-9 ]/", "", $value_six);
					
					if ( (!empty($valueC_six)) || ($valueC_six != ''))  { $class_sixArr[] = $valueC_six; }
				
				}
 
				$count_fiArr = count($class_fiArr);
				$count_seArr = count($class_seArr);
				$count_thArr = count($class_thArr);
				$count_foArr = count($class_foArr);
				$count_fifArr = count($class_fifArr);
				$count_sixArr = count($class_sixArr); 

				if ($count_fiArr == $i_false) {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 1";
					
	   			}elseif ($count_seArr == $i_false)  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 2";
					
	   			}elseif ($count_thArr == $i_false)  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 3";
					
	   			}elseif ($count_foArr == $i_false)  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 4";
					
	   			}elseif ($count_fifArr == $i_false)  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 5";
					
	   			}elseif ($count_sixArr == $i_false)  {
         			
					$msg_e = "Oooooops Error, please input a value for Standard 6";
					
	   			}else {

		 			try {				
							$class_fiArray = array_unique($class_fiArr);
							$class_seArray = array_unique($class_seArr);
							$class_thArray = array_unique($class_thArr);
							$class_foArray = array_unique($class_foArr);
							$class_fifArray = array_unique($class_fifArr);
							$class_sixArray = array_unique($class_sixArr);
							
							$class_1 = serialize($class_fiArray);
							$class_2 = serialize($class_seArray);
							$class_3 = serialize($class_thArray);
							$class_4 = serialize($class_foArray);
							$class_5 = serialize($class_fifArray);
							$class_6 = serialize($class_sixArray); 
		 			
							$ebele_mark = "UPDATE $classLevelTB SET
						 
											class = :class
											
											WHERE cl_id = :cl_id";
											
							$igweze_prep = $conn->prepare($ebele_mark);	
							
							$igweze_prep->bindValue(':class', $class_1);
							$igweze_prep->bindValue(':cl_id', $fiVal);
							$igweze_prep->execute();
							
							$igweze_prep->bindValue(':class', $class_2);
							$igweze_prep->bindValue(':cl_id', $seVal);
							$igweze_prep->execute();
							
							$igweze_prep->bindValue(':class', $class_3);
							$igweze_prep->bindValue(':cl_id', $thVal);
							$igweze_prep->execute();
							
							$igweze_prep->bindValue(':class', $class_4);
							$igweze_prep->bindValue(':cl_id', $foVal);
							$igweze_prep->execute();
							
							$igweze_prep->bindValue(':class', $class_5);
							$igweze_prep->bindValue(':cl_id', $fifVal);
							$igweze_prep->execute();
							
							$igweze_prep->bindValue(':class', $class_6);
							$igweze_prep->bindValue(':cl_id', $sixVal);
							$igweze_prep->execute(); 

							if ($igweze_prep) {  /* if sucessfully */

									$msg_s = "School Class Name was Successfully Saved.";
									echo "<script type='text/javascript'>  $('#frmclassSettings').slideUp(2000);  </script>";
									
							}else {  /* display error */ 

									$msg_e = "Ooooooops, An Error Has occur 
									while trying to save School Class Name, please try again";

							}
				
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		
		

				
				

        		}
        
			}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}


			
			if ($msg_s) {

				echo $succesMsg.$msg_s.$sEnd ; 
				echo"<script type='text/javascript'>  $('.configLoading').fadeOut(4000); </script>";
				echo $scrollUp; exit; 				
										
			}	


			if ($msg_e) {

				echo $errorMsg.$msg_e.$eEnd; 
				echo"<script type='text/javascript'>  $('.configLoading').fadeOut(4000); </script>";
				echo $scrollUp; exit; 			
				
										
			}	
			
exit;

?>