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
	This script handle result and comment inputation
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */
	 
	 	require 'configwizGrade.php';  /* load wizGrade configuration files */	

		if (!defined('wizGrade'))

	     die('Hahahaha, Hacking attempt . . . . Be Careful !!!!');

			 
 	 	if (($_REQUEST['validate']) == 'validateRS') {  /* save student result */
	 
			/* check overlay div */ 
			
			if($_REQUEST['scrollType'] == 'overlayScroll'){

					$scrollUp = " $('html, body').animate({ scrollTop:  $('#overlay-rs-box').offset().top - 40 }, 'fast');";	
					
			}else{
			
					$scrollUp = "$('html, body').animate({scrollTop:$('#msgBox, #scrollToTarget').position().top}, 'fast');";			
			} 
		 
			$term = strip_tags($_REQUEST['nj_term']); $level = strip_tags($_REQUEST['nj_level']); $class = strip_tags($_REQUEST['nj_class']);


			try {

				$minCourseArray = levelminCourseArray($conn); /* retrieve student level minimum course array */
				$courseCountLimit = $minCourseArray[$level]['minCourse']; //$courseCountLimit = 9;
				
				$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
				$exam_status = $examArray[0]['status'];	
				$fiAssScore = $examArray[0]['fi_ass'];	
				$seAssScore = $examArray[0]['se_ass'];	
				$thAssScore = $examArray[0]['th_ass'];
				$foAssScore = $examArray[0]['fo_ass'];
				$fifAssScore = $examArray[0]['fif_ass'];
				$sixAssScore = $examArray[0]['six_ass'];	
				$exam_score = $examArray[0]['exam'];	
				
			}catch(PDOException $e) {

					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			} 

			require_once $wizGradeClassConfigDir;   /* include class configuration script */ 

			$a = 1; $b = 2; $c = 3; $e = 4; $f = 0; $rsCountCourse = 5; 

			$is_clean = false;
			
			$error_1 = ""; $error_2 = "";   

			/* script validation */ 	

			if (array_key_exists('regnum', $_REQUEST)){  /* check array is empty */
		   
			   $regNo = strip_tags($_REQUEST['regnum']);

			   if ($regNo == '') {

				   $msg_e .= "* Oooooooop Error, stdudent's Reg Number is empty";
	
				   $is_clean = false;  $error_1 = $error_add_val_1;
				   echo $errorMsg.$msg.$eEnd;
				   echo "<script type='text/javascript'> echo $scrollUp hidePageLoader();  /* hide page loader */	</script>";	 exit;	

			   }
				
				
				$c_count = 0; $cc_count = 0; $cv_count = 0;
				
				//array_unshift($course_info_igweze,"");
	   			//unset($course_info_igweze[0]);
				
				foreach ($_POST as $field  => $value){  /* loop array */
						
						if($field != 'insert' && $field != 'regnum' && $field != 'nj_term' && $field != 'nj_class'
						   && $field != 'nj_level' && 
						   $field != 'validate' && $field != 'hidefrm' && $field != 'scrollType') {
						
							$temp = is_array($value) ? $value : trim($value);
							
							$ikey = array_keys($course_info_igweze, trim($field));
							$course_index = $ikey[1];
							//$course_index = array_search(trim($field), $course_info_igweze);
							$course_name = $course_info_mark[$course_index][$b];
							
							$co = $course_info_mark[$course_index][$c]; 
							
							if($exam_status == $fiVal){  /* check school exam status */
							
								//$results[$field] = "$value[1],$value[7]"; 
								//$course_sum = $value[1] + $value[7];
								
								$value[1] = preg_replace("/[^0-9 ]/", "", $value[1]);
								$value[7] = preg_replace("/[^0-9 ]/", "", $value[7]);
								
								if(($value[1] == "") && ($value[7] != "")) {
									 
									if(($value[7] > 100)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										exam score  is <strong> $value[7] </strong>
										which is more than <strong>100</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;																	
										
									}else{ 

										$results[$field] = $value[7]; 
										$course_sum = $value[7];
									
									} 
									
								}else{									

									if(($value[1] > $fiAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										1st Assessment score  is <strong> $value[1] </strong>
										which is high than required set score <strong>$fiAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[7] > $exam_score)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										exam score  is <strong> $value[7] </strong>
										which is high than required set score <strong>$exam_score</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}else{ 

										$results[$field] = "$value[1],$value[7]"; 
										$course_sum = $value[1] + $value[7];
									
									}								
								}
							
							}elseif($exam_status == $seVal){  /* check school exam status */
							
								//$results[$field] = "$value[1],$value[2],$value[7]"; 
								//$course_sum = $value[1] + $value[2] + $value[7];

								$value[1] = preg_replace("/[^0-9 ]/", "", $value[1]);
								$value[2] = preg_replace("/[^0-9 ]/", "", $value[2]);
								$value[7] = preg_replace("/[^0-9 ]/", "", $value[7]);
								
								if(($value[1] == "") && ($value[2] == "") && ($value[7] != "")) {
									 
									if(($value[7] > 100)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										exam score  is <strong> $value[7] </strong>
										which is more than <strong>100</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}else{ 

										$results[$field] = $value[7]; 
										$course_sum = $value[7];
									
									} 
									
								}else{									

									if(($value[1] > $fiAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										1st Assessment score  is <strong> $value[1] </strong>
										which is high than required set score <strong>$fiAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[2] > $seAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										2nd Assessment score  is <strong> $value[2] </strong>
										which is high than required set score <strong>$seAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[7] > $exam_score)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										exam score  is <strong> $value[7] </strong>
										which is high than required set score <strong>$exam_score</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}else{ 

										$results[$field] = "$value[1],$value[2],$value[7]"; 
										$course_sum = $value[1] + $value[2] + $value[7];
									
									}								
								}										
							
							}elseif($exam_status == $thVal){  /* check school exam status */
							
								//$results[$field] = "$value[1],$value[2],$value[3],$value[7]"; 
								//$course_sum = $value[1] + $value[2] + $value[3] + $value[7];

								$value[1] = preg_replace("/[^0-9 ]/", "", $value[1]);
								$value[2] = preg_replace("/[^0-9 ]/", "", $value[2]);
								$value[3] = preg_replace("/[^0-9 ]/", "", $value[3]);
								$value[7] = preg_replace("/[^0-9 ]/", "", $value[7]);
								
								if(($value[1] == "") && ($value[2] == "") && ($value[3] == "") && ($value[7] != "") ) {
									 
									if(($value[7] > 100)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										exam score  is <strong> $value[7] </strong>
										which is more than <strong>100</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}else{ 

										$results[$field] = $value[7]; 
										$course_sum = $value[7];
									
									} 
									
								}else{									

									if(($value[1] > $fiAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										1st Assessment score  is <strong> $value[1] </strong>
										which is high than required set score <strong>$fiAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[2] > $seAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										2nd Assessment score  is <strong> $value[2] </strong>
										which is high than required set score <strong>$seAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[3] > $thAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										3rd Assessment score  is <strong> $value[3] </strong>
										which is high than required set score <strong>$thAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[7] > $exam_score)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										exam score  is <strong> $value[7] </strong>
										which is high than required set score <strong>$exam_score</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}else{ 

										$results[$field] = "$value[1],$value[2],$value[3],$value[7]"; 
										$course_sum = $value[1] + $value[2] + $value[3] + $value[7];
									
									}								
								}								
								
							
							}elseif($exam_status == $foVal){  /* check school exam status */
							
								//$results[$field] = "$value[1],$value[2],$value[3],$value[4],$value[7]"; 
								//$course_sum = $value[1] + $value[2] + $value[3] + $value[4] + $value[7];

								$value[1] = preg_replace("/[^0-9 ]/", "", $value[1]);
								$value[2] = preg_replace("/[^0-9 ]/", "", $value[2]);
								$value[3] = preg_replace("/[^0-9 ]/", "", $value[3]);
								$value[4] = preg_replace("/[^0-9 ]/", "", $value[4]);
								$value[7] = preg_replace("/[^0-9 ]/", "", $value[7]);
								
								if(($value[1] == "") && ($value[2] == "") && ($value[3] == "") && ($value[4] == "") &&
								($value[7] != "") ) {
									 
									if(($value[7] > 100)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										exam score  is <strong> $value[7] </strong>
										which is more than <strong>100</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}else{ 

										$results[$field] = $value[7]; 
										$course_sum = $value[7];
									
									} 
									
								}else{									

									if(($value[1] > $fiAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										1st Assessment score  is <strong> $value[1] </strong>
										which is high than required set score <strong>$fiAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[2] > $seAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										2nd Assessment score  is <strong> $value[2] </strong>
										which is high than required set score <strong>$seAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[3] > $thAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										3rd Assessment score  is <strong> $value[3] </strong>
										which is high than required set score <strong>$thAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[4] > $foAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										4th Assessment score  is <strong> $value[4] </strong>
										which is high than required set score <strong>$foAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[7] > $exam_score)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										exam score  is <strong> $value[7] </strong>
										which is high than required set score <strong>$exam_score</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}else{ 

										$results[$field] = "$value[1],$value[2],$value[3],$value[4],$value[7]"; 
										$course_sum = $value[1] + $value[2] + $value[3] + $value[4] + $value[7];
									
									}								
								}								
								
							
							}elseif($exam_status == $fifVal){  /* check school exam status */
							
								//$results[$field] = "$value[1],$value[2],$value[3],$value[4],$value[5],$value[7]"; 
								//$course_sum = $value[1] + $value[2] + $value[3] + $value[4] + $value[5] + $value[7];
								
								$value[1] = preg_replace("/[^0-9 ]/", "", $value[1]);
								$value[2] = preg_replace("/[^0-9 ]/", "", $value[2]);
								$value[3] = preg_replace("/[^0-9 ]/", "", $value[3]);
								$value[4] = preg_replace("/[^0-9 ]/", "", $value[4]);
								$value[5] = preg_replace("/[^0-9 ]/", "", $value[5]);
								$value[7] = preg_replace("/[^0-9 ]/", "", $value[7]);
								
								if(($value[1] == "") && ($value[2] == "") && ($value[3] == "") && ($value[4] == "") &&
								 ($value[5] == "") && ($value[7] != "") ) {
									 
									if(($value[7] > 100)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										exam score  is <strong> $value[7] </strong>
										which is more than <strong>100</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}else{ 

										$results[$field] = $value[7]; 
										$course_sum = $value[7];
									
									} 
									
								}else{									

									if(($value[1] > $fiAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										1st Assessment score  is <strong> $value[1] </strong>
										which is high than required set score <strong>$fiAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[2] > $seAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										2nd Assessment score  is <strong> $value[2] </strong>
										which is high than required set score <strong>$seAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[3] > $thAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										3rd Assessment score  is <strong> $value[3] </strong>
										which is high than required set score <strong>$thAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[4] > $foAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										4th Assessment score  is <strong> $value[4] </strong>
										which is high than required set score <strong>$foAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[5] > $fifAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										5th Assessment score  is <strong> $value[5] </strong>
										which is high than required set score <strong>$fifAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[7] > $exam_score)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										exam score  is <strong> $value[7] </strong>
										which is high than required set score <strong>$exam_score</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}else{ 

										$results[$field] = "$value[1],$value[2],$value[3],$value[4],$value[5],$value[7]"; 
										$course_sum = $value[1] + $value[2] + $value[3] + $value[4] + $value[5] + $value[7];
									
									}								
								}								
							
							}elseif($exam_status == $sixVal){  /* check school exam status */

								$value[1] = preg_replace("/[^0-9 ]/", "", $value[1]);
								$value[2] = preg_replace("/[^0-9 ]/", "", $value[2]);
								$value[3] = preg_replace("/[^0-9 ]/", "", $value[3]);
								$value[4] = preg_replace("/[^0-9 ]/", "", $value[4]);
								$value[5] = preg_replace("/[^0-9 ]/", "", $value[5]);
								$value[6] = preg_replace("/[^0-9 ]/", "", $value[6]);
								$value[7] = preg_replace("/[^0-9 ]/", "", $value[7]);
								
								if(($value[1] == "") && ($value[2] == "") && ($value[3] == "") && ($value[4] == "") &&
								 ($value[5] == "") && ($value[6] == "") && ($value[7] != "") ) {
									 
									if(($value[7] > 100)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										exam score  is <strong> $value[7] </strong>
										which is more than <strong>100</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}else{ 

										$results[$field] = $value[7]; 
										$course_sum = $value[7];
									
									} 
									
								}else{									

									if(($value[1] > $fiAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										1st Assessment score  is <strong> $value[1] </strong>
										which is high than required set score <strong>$fiAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[2] > $seAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										2nd Assessment score  is <strong> $value[2] </strong>
										which is high than required set score <strong>$seAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[3] > $thAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										3rd Assessment score  is <strong> $value[3] </strong>
										which is high than required set score <strong>$thAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[4] > $foAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										4th Assessment score  is <strong> $value[4] </strong>
										which is high than required set score <strong>$foAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[5] > $fifAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										5th Assessment score  is <strong> $value[5] </strong>
										which is high than required set score <strong>$fifAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[6] > $sixAssScore)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										6th Assessment score  is <strong> $value[6] </strong>
										which is high than required set score <strong>$sixAssScore</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}elseif(($value[7] > $exam_score)){
										
										$is_clean = false;
										$msg_e .= "*Ooooooops Error, <strong>$course_name</strong>
										exam score  is <strong> $value[7] </strong>
										which is high than required set score <strong>$exam_score</strong>."; 
										echo $erroMsg.$msg_e.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$scrollUp; </script>"; exit;
										
									}else{ 

										$results[$field] = "$value[1],$value[2],$value[3],$value[4],$value[5],$value[6],$value[7]"; 
										$course_sum = $value[1] + $value[2] + $value[3] + $value[4] + $value[5] + $value[6] + $value[7];
									
									}								
								}

								
							}else{  /* display error */ 								
								
								$msg_e = "Oooooops Error, please notify school admin to set school continous assessment before student results can be added.";
								
								echo $errorMsg.$msg_e.$eEnd;
								echo "<script type='text/javascript'> echo $scrollUp hidePageLoader();  /* hide page loader */	</script>";	 exit;	
							
							} 
							
							$grand_c_total = $grand_c_total + $course_sum;
							
							$total[$co] = $course_sum;
							
							$total_ch = $course_sum; 
							
							//$c_count++; 
							
							$total_ch = preg_replace("/[^0-9]/", "", $total_ch);
						
							if ( (floor($total_ch) > 100) )  {  /* check total */ 
				
								$style = $error_add_sty_back;
				
								$msg_e = "Ooooooops Error, student $course_name total score is $total_ch. Please total score 
								should not be more than 100.";
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'> echo $scrollUp hidePageLoader();  /* hide page loader */	</script>";	exit; 			
								
								if(($level >= $foVal) && ($cc_count >= $courseCountLimit)){
								
									$is_clean = true; $msg_e = ''; $error_2 = '';
								
								}else{
									
									$is_clean = false; $error_2 = $error_add_val_1;
								
								}

								$cv_count++;
								
							}else{
								
								if ( (floor($total_ch) > 1) && (floor($total_ch) <= 100) )  {  /* check total */ 
								
									$cc_count++;
								
								}

							}
						
							$value = ""; $total_ch = ""; $course_index = ""; $field = "";							

						}
						
						$value = ""; $total_ch = ""; $course_index = "";  $field = "";
						
				
					
				} 
				
					
				if(($courseCountLimit == 'all') || ($cc_count >= $courseCountLimit)){  /* check course level limit */ 
						
					$c_count = $cc_count;
						
				}else{
						
					$c_count = $courseCountLimit;
						
				} 
				 			

				if (($error_1 != $error_add_val_1) && ($error_2 != $error_add_val_1)) {

					$is_clean = true;

				} 

				if ($is_clean == true) {  /* if no error then save information */  								
								
					try {
						
						$grade_nk = ($grand_c_total / $c_count); 
						$grade_nk = number_format($grade_nk, 1); 

						$sessionID = studentRegSessionID($conn, $regNo);  /* student school session ID */
						$rsStatus = wizGradeResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */ 

						if  ($rsStatus == $rspublishStage){	 /* check student result is already publish */			
								
							$session = wizGradeSession($conn, $sessionID);  /* school session */				
							$session_se = $session + $foreal;
							$SessSem = schoolTerm($term);  /* school term */
							
							$msg_e = "$tframeF $SessSem Semester $session - $session_se $tframeS";
							
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $scrollUp hidePageLoader();  /* hide page loader */	</script>"; exit;	

						} 
						
						$ebele_mark = "SELECT f.ireg_id, r.nk_regno

							 FROM $i_reg_tb r, $sdoracle_score_nk f

							 WHERE r.nk_regno = :nk_regno

							 AND r.ireg_id = f.ireg_id";
							 
						$igweze_prep = $conn->prepare($ebele_mark);

						$igweze_prep->bindValue(':nk_regno', $regNo);
						 
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count != $foreal) {	 /* check if student really exits */
						
							$msg_e = "*Error, student with reg num <span> $regNo </span> do not exist, Record was not added !";
							echo $errorMsg.$msg_e.$eEnd;
							echo "<script type='text/javascript'> $scrollUp hidePageLoader();  /* hide page loader */	</script>"; exit; 		
								
						}else{  /* insert/update information */
					
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
			   
								$regID = $row['ireg_id'];
								
							}

							$conn->beginTransaction();  /* begin data input transaction */ 
							
							$ebele_mark_2 = "UPDATE $sdoracle_score_nk SET ";

							foreach($results as $subj => $score) {  /* loop array */

							   if($subj != 'insert' && $subj != 'regnum') {
																			 
									$ebele_mark_2 .= ' '.$subj.' = :'.$subj.','; 
									$values_2[':'.$subj] = $score;
									
								}

							} 

							$ebele_mark_2 = trim($ebele_mark_2, ', ');

							$ebele_mark_2 .= ' WHERE  ireg_id = :reg_id';

							$igweze_prep_2 = $conn->prepare($ebele_mark_2);

							$values_2[':reg_id'] = $regID;
							$igweze_prep_2->execute($values_2);


							$ebele_mark_3 = "UPDATE $sdoracle_sub_score_nk SET ";

							foreach($total as $subjs => $scores) {  /* loop array */

							   if($subj != 'insert' && $subjs != 'regnum') {
																			 
									$ebele_mark_3 .= ' '.$subjs.' = :'.$subjs.','; 
									$values_3[':'.$subjs] = $scores; 
									
								}

							} 

							$ebele_mark_3 = trim($ebele_mark_3, ', ');

							$ebele_mark_3 .= ' WHERE  ireg_id = :reg_id';

							$igweze_prep_3 = $conn->prepare($ebele_mark_3);

							$values_3[':reg_id'] = $regID;										 
							$igweze_prep_3->execute($values_3);


							$ebele_mark_4 = "UPDATE $sdoracle_grand_score_nk SET  

											$term_score = :grand_to,

											$term_avg = :grade_nk 

											WHERE  ireg_id = :reg_id";

							$igweze_prep_4 = $conn->prepare($ebele_mark_4);
							$igweze_prep_4->bindValue(':reg_id', $regID);
							$igweze_prep_4->bindValue(':grand_to', $grand_c_total);
							$igweze_prep_4->bindValue(':grade_nk', $grade_nk); 

							$igweze_prep_4->execute(); 

							if($cal_session == true){  /* if school term is third term */  

								$reportStatus = updateGrandSessionRS($conn, $sdoracle_grand_score_nk, $regID, $fiGrandTotal, 
											$seGrandTotal, $thGrandTotal, $grandTotal, $grandAvg);  /* update student grand annual score  */

								if($reportStatus == $i_false){  /* display error */
									
									$msg_e =  "Ooooooops error, could not add student (<b> $regNo </b>) total session result. Please try again";
									echo $errorMsg.$msg_e.$eEnd;
									echo "<script type='text/javascript'> $scrollUp hidePageLoader();  /* hide page loader */	</script>"; exit; 		

								}

							 
							}
								 
							if  (($igweze_prep_2) && ($igweze_prep_3) && ($igweze_prep_4)){  /* if sucessfully */ 
							  
								resetResultComputation($conn, $sessionID, $level, $class, $term);  /* reset results computaion */

								$conn->commit(); /* if everything is alright then insert data accross tables */

								$msg_s =  "Student with RegNum <b>$regNo</b>  result was successfully saved.";
							  
								if($_REQUEST['hidefrm'] == 'hidefrmDiv'){
							  
									$scriptTag = "$('#frmSaveRs').slideUp(300);"; 	
							  
								} 
										   
								echo $succesMsg.$msg_s.$sEnd;
								echo "<script type='text/javascript'> $scriptTag $scrollUp
								$('.wizGrade-rs').val('');  hidePageLoader();  /* hide page loader */	</script>"; exit; 		   			   

							}else {  /* display error */

								$conn->rollBack(); /* if everything is not alright then don't insert data accross tables */

								$msg_e =  "Oooooooop, an error has occur while trying to save student result. Please try again";
								echo $errorMsg.$msg_e.$eEnd;
								echo "<script type='text/javascript'> $scrollUp hidePageLoader();  /* hide page loader */	</script>"; exit; 		

							} 

						} 		  
										 
					}catch(PDOException $e) {
							
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
					}
		   
				}

			}
				
			exit; 
	  
	  	}elseif (($_REQUEST['validate']) == 'validateCom') {  /* save student comments */
	 
			/* check overlay div */ 
			
			if($_REQUEST['scrollType'] == 'overlayScroll'){

				$scrollUp = " $('html, body').animate({ scrollTop:  $('#overlay-rs-box').offset().top - 40 }, 'fast'); ";	
					
			}else{
			
				$scrollUp = " $('html, body').animate({scrollTop:$('#msgBox, #scrollToTarget').position().top}, 'fast'); ";			
			}     	
		 
			$term = strip_tags($_REQUEST['nj_term']); $level = strip_tags($_REQUEST['nj_level']); $class = strip_tags($_REQUEST['nj_class']);
					 
			require_once $wizGradeClassConfigDir;   /* include class configuration script */ 
	
			$a = 1; $b = 2; $c = 3; $e = 4; $f = 0;
	
			$is_clean = false;
			$error_1 = ""; $error_2 = "";               

            if (array_key_exists('regnum', $_REQUEST)){  /* check array is empty */
			   
				$regNo = strip_tags($_REQUEST['regnum']);

				if ($regNo == '') {

					$msg_e .= "* Oooooooop Error, stdudent's Reg Number is empty";
					echo $errorMsg.$msg.$eEnd; 
					echo "<script type='text/javascript'> $scrollUp hidePageLoader();  /* hide page loader */	</script>";	 exit;	
					$is_clean = false;  $error_1 = $error_add_val_1;

				} 
				
				$c_count = 0; $cc_count = 0; $cv_count = 0;
				
				foreach ($_POST as $field  => $value){  /* loop array */
				
					if($field != 'insert' && $field != 'regnum' && $field != 'nj_term' && $field != 'nj_class'
					   && $field != 'nj_level' && 
					   $field != 'validate' && $field != 'hidefrm' && $field != 'scrollType') {
					
						$temp = is_array($value) ? $value : trim($value);
						
						$course_index = array_search($field, $course_info_igweze);
		
						$co = $course_info_mark[$course_index][$c]; 
						
						$results[$field] = htmlspecialchars($value); 

					} 
					
				} 		
						
				try { 

						$sessionID = studentRegSessionID($conn, $regNo);  /* student school session ID */
						$rsStatus = wizGradeResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */ 

						if  ($rsStatus == $rspublishStage){	 /* check student result is already publish */		
							
							$session = wizGradeSession($conn, $sessionID);  /* school session */			
							$session_se = $session + $foreal;
							$SessSem = schoolTerm($term);  /* school term */
							
							$msg = "$tframeF $SessSem Semester $session - $session_se $tframeS";
							
							echo $errorMsg.$msg.$eEnd; 
							echo "<script type='text/javascript'> $scrollUp hidePageLoader();  /* hide page loader */	</script>"; exit;	

						} 
					
						$ebele_mark = "SELECT f.ireg_id, r.nk_regno

								FROM $i_reg_tb r, $sdoracle_comment_nk f

								WHERE r.nk_regno = :nk_regno

								AND r.ireg_id = f.ireg_id";
							 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':nk_regno', $regNo);							 
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count != $foreal) {	 /* check if student really exits */
						
							$msg = "*Error, student with reg num <span> $regNo </span> do not exist, record was not added !";
							echo $errorMsg.$msg.$eEnd; 
							echo "<script type='text/javascript'> $scrollUp hidePageLoader();  /* hide page loader */	</script>";exit; 		
								
						}else{
					
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
			   
								$regID = $row['ireg_id'];
								
							} 
					
							$ebele_mark_2 = "UPDATE $sdoracle_comment_nk SET ";

							foreach($results as $subj => $score) {

							   if($subj != 'insert' && $subj != 'regnum') {  /* loop array */
																			 
									$ebele_mark_2 .= ' '.$subj.' = :'.$subj.','; 
									$values_2[':'.$subj] = $score; 					  
									
								}

							} 
							
							$ebele_mark_2 = trim($ebele_mark_2, ', ');
							$ebele_mark_2 .= ' WHERE  ireg_id = :reg_id';
							$igweze_prep_2 = $conn->prepare($ebele_mark_2);
							$values_2[':reg_id'] = $regID;  
									 
							if  ($igweze_prep_2->execute($values_2)){  /* if sucessfully */
							  
								resetResultComputation($conn, $sessionID, $level, $class, $term);  /* reset results computaion */
							  
								$msg_s =  "Student with RegNum : <b>$regNo</b> $level_term result was successfully saved.";
							  
								if($_REQUEST['hidefrm'] == 'hidefrmDiv'){
								  
									$scriptTag = "$('#frmsaveSubComment').slideUp(300)"; 	
							  
								} 
								
								echo "<script type='text/javascript'> $scrollUp hidePageLoader();  /* hide page loader */$scriptTag 	</script>";
								echo $succMsg.$msg_s.$msgEnd; 
								exit; 	 

							}else {  /* display error */  

								$msg_e =  "Oooooooop, an error has occur while trying to save student subjects comment. Please try again";
								echo $errorMsg.$msg_e.$eEnd;
								echo "<script type='text/javascript'> $scrollUp hidePageLoader();  /* hide page loader */	</script>";exit; 			

							} 

						}   
							 
					}catch(PDOException $e) {
		
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
		 
					}
           
            } 
	  
			exit;		
	  
	  	}else{
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		}  	

exit;
?>