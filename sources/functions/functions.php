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
	This script load predefined functions
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 
		
		function wizGradeRandomChar($string){ /* generate auto random character */

				$length = strlen($string);
				$position = mt_rand(0, $length - 1);
				return($string[$position]);

		}

		function wizGradeRandomString ($charset_string, $length){ /* generate auto random character */

				$return_string = ""; // the empty string
				for ($x = 0; $x < $length; $x++)
				$return_string .= wizGradeRandomChar($charset_string);
				return($return_string);

		} 		 
		
		function getPagination($count, $NumPerPage){ /* page papination */
	
				$paginationCount= floor($count / $NumPerPage);
				$paginationModCount = $count % $NumPerPage;
				
				if(!empty($paginationModCount)){
			
					$paginationCount++;
				}
				
				return $paginationCount;
		} 
		
  	    function removeArrayByValue($array, $value){ /* remove emtpy array value   */
    
				return array_values(array_diff($array, array($value)));
	
        } 
		
		function wizGradeHighlight($inVal){ /* highlight character in a sentence or words  */

				return '<span class="high-light-text">'.$inVal.'</span>';

		}

		function highlightTerms($QueryString, $querys){  /* highlight character in a sentence or words  */

				foreach ($querys as $query){ 
				
					$queryStringRep = str_ireplace($query, '<span =style"color:red">*'.$query.'*</span>', $queryString); 
				}
			
				return $queryStringRep;
		}		 
		
		function studentPostionSup($position){  /* student result position suffix  */                               
				
				if($position == 1){
					
					$positionSup = "1<sup>st</sup>"; 
			
				}elseif($position == 2){
					
					$positionSup = "2<sup>nd</sup>"; 
			
				}elseif($position == 3){
					
					$positionSup = "3<sup>rd</sup>"; 
			
				}elseif(($position != '') && ($position > 3)){
					
					$positionSup = "$position<sup>th</sup>"; 
					
				}else{
					
					$positionSup = " - "; 
				}
				
				return $positionSup;
				
		} 	  
		
        function schoolTerm($semester) {  /* school term  */

				if ($semester == 1){

					$i_semester = 'First';

				}elseif ($semester == 2){

					$i_semester = 'Second';

				}elseif ($semester == 3){

					$i_semester = 'Third';

				}elseif ($semester == 4){

					$i_semester = 'Annual';

				}else {
			 
					$i_semester = '';

				}

				return $i_semester;

		}	 
		
	    function schoolTypeDB($school){ /* school type database  */
		   
				global $wizGradeCDB, $wizGradeNurDB, $wizGradePriDB, $wizGradeSecDB;
			   
				$school = strtolower($school);
			   
				if($school == 'nur'){
				   
					$wizGradeDB = $wizGradeNurDB;
				   
				}elseif($school == 'pri'){
				   
					$wizGradeDB = $wizGradePriDB;
				   
				}elseif($school == 'sec'){
				   
					$wizGradeDB = $wizGradeSecDB;
				   
				}else{
				   
					$wizGradeDB = '';
				   
				}
			   
				return $wizGradeDB;
	    }
		
		function schoolRegSuffix($school){  /* school type reg. no. suffix  */
		   
				global $fiVal, $seVal, $thVal;
			   
				if($school == $fiVal){
				   
					$regSuffix = '/NUR';
				   
				}elseif($school == $seVal){
				   
					$regSuffix = '/PRI';
				   
				}elseif($school == $thVal){
				   
					$regSuffix = '/SEC';
				   
				}else{
				   
					$regSuffix = '';
				   
				}
			   
				return $regSuffix;
	    }

	    function schoolType($school){  /* return school type */
		   
				$school = strtolower($school);
			   
				if($school == 'nur'){
				   
					$wizGradeDB = 'Nursery';
				   
				}elseif($school == 'pri'){
				   
					$wizGradeDB = 'Primary';
					
				}elseif($school == 'sec'){
				   
					$wizGradeDB = 'Secondary';
				   
				}else{
				   
					$wizGradeDB = '';
				   
				}
			   
				return $wizGradeDB;
	    }

	    function schoolTypeConfig($school, $type){ /* school type configuration  */
		   
				global $wizGradeNurConfig, $wizGradePRIConfig, $wizGradeSECConfig;
				global $fiVal, $seVal;
			   
				$school = strtolower($school);
		   
				if($type == $fiVal){
				   
					$ext = './'; 
				  
				}elseif($type == $seVal){
				   
					$ext = '../'; 
				   
				}else{
				   
					$ext = ''; 
				   
				}
			   
				if($school == 'nur'){
				   
					$wizGradeConfig = $ext.$wizGradeNurConfig;
				   
				}elseif($school == 'pri'){
				   
					$wizGradeConfig = $ext.$wizGradePRIConfig;
				   
				}elseif($school == 'sec'){
				   
					$wizGradeConfig = $ext.$wizGradeSECConfig;
				   
				}else{
				   
					$wizGradeConfig = '';
				   
				}
		   
				return $wizGradeConfig;
	    }
	   
	    function wizGradeThemeColor($themeColor, $themePath) { /* wizGrade theme  */
		   
				if (($themeColor != '') && ($themePath != '')){
			   
					$cssThemePath =  $themePath.'css/style-'.$themeColor.'.css';
					$cssThemeResetPath =  $themePath.'css/bootstrap-reset-'.$themeColor.'.css';

					if ( (file_exists($cssThemePath)) && (file_exists($cssThemeResetPath)) ) {

						$cssTheme =  $cssThemePath;
						$cssThemeReset =  $cssThemeResetPath;
					
					}else{

						$cssTheme =  $themePath.'css/style.css';
						$cssThemeReset =  $themePath.'css/bootstrap-reset.css';
						
					}
				
				}else{

						$cssTheme =  $themePath.'css/style.css';
						$cssThemeReset =  $themePath.'css/bootstrap-reset.css'; 
				
				} 
			
				$wizGradeTheme = $cssTheme.'@$$@'.$cssThemeReset;
					
				return $wizGradeTheme;
	    }  

		function  wizGradePrincipalRemarks($average, $d_occ, $e_occ, $f_occ){ /* principal auto remarks */
	  
				if($d_occ == 0){ $i_dgr = ''; $no_d = true;}
				if($e_occ == 0){ $i_egr = ''; $no_e = true;}
				if($f_occ == 0){ $i_fgr = ''; $no_f = true;}
				
				if($d_occ >= 1){ $i_dgr = 'D'; $no_d = false;}
				if($e_occ >= 1){ $i_egr = 'E'; $no_e = false;}
				if($f_occ >= 1){ $i_fgr = 'F'; $no_f = false;}
				
				if(($no_d == false) || ($no_e == false) || ( $no_f == false)){  
					$show_improve = ", Improve on subject/s with grade/s $i_dgr $i_egr $i_fgr";
				}

				if (($average >= 0.1) && ($average <= 29)) {
					$remark = "Very Poor Results";
					return $remark;
				}elseif (($average >= 30) && ($average <= 39)) {
					$remark = "Poor Result Work Harder";
					return $remark;
				}elseif (($average >= 40) && ($average <= 49)) {
					$remark = "Fair Result".$show_improve;
					return $remark;
				}elseif (($average >= 50) && ($average <= 59)) {
					$remark = "Good Result".$show_improve;
					return $remark;
				}elseif (($average >= 60) && ($average <= 69)) { 
			   
					if($no_f == true){
				   
						$remark = "Very Good Result".$show_improve;
				   
					}else{
				   
						$remark = "Encouraging Result".$show_improve;
				   
					}
					return $remark;
					
				}elseIf (($average >= 70) && ($average <= 79)) {
					
					if (($no_d == true) && ($no_e == true) && ($no_f == true)){
						$remark = "Excellent Result, Keep It Up";
					}else{
						$remark = "Excellent Result $show_improve";
					}
					return $remark;
				}elseIf (($average >= 80) && ($average <= 100)) {
					$remark = "Distinction, Keep It Up";
					return $remark;
				}elseIf (is_null(($average))) {
					$remark = " - ";
					return $remark;
				}

		}

		function teacherGradeRemarks($score){ /* teacher grade remarks */

				if ($score < 0) {
					$score_grd = "";
					return $score_grd;
				}elseif (($score >= 1) && ($score <= 39.9)) {
					$score_grd = "Fail";
					return $score_grd;
				}elseif (($score >= 40) && ($score <= 44.9)) {
					$score_grd = "Fair";
					return $score_grd;
				}elseif (($score >= 45) && ($score <= 49.9)) {
					$score_grd = "Pass";
					return $score_grd;
				}elseif (($score >= 50) && ($score <= 59.9)) {
					$score_grd = "Good";
					return $score_grd;
				}elseif (($score >= 60) && ($score <= 69.9)) {
					$score_grd = "V. Good";
					return $score_grd;
				}elseif (($score >= 70) && ($score <= 100)) {
					$score_grd = "Excellent";
					return $score_grd;
				}elseif (is_null(($score))) {
					$score_grd = " ";
					return $score_grd;
				}

		}  
		
		function gradeRemarks($score){ /* grade remarks */
	  
				if ($score <= 0) {

					$remark = '';
					return $remark;	   

				}elseif (($score >= 1) && ($score <= 39)) {
				   
					$remark = 'Fail';
					return $remark;	   
			   
				}else {
			   
					$remark = 'Pass';
					return $remark;
			   
				}  
	  
		} 
		
		function onlineRegPicture($conn, $studentID) {  /* online registration picture */

				global $studentOnlineRegTB, $foreal;

				$ebele_mark = "SELECT i_stupic

                     FROM $studentOnlineRegTB 

                     WHERE stu_id = :stu_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':stu_id', $studentID);		 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$picture = $row['i_stupic'];
						
					}	
				
				}else{
			
					$picture = "";
			
				}
			
				return  $picture;

		}	

		function registrationCounter($conn) {  /* student online registration counter */	

			global $studentOnlineRegTB, $foreal;

					$ebele_mark = "SELECT stu_id

									FROM $studentOnlineRegTB";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->execute();
					
					$totalStudents = $igweze_prep->rowCount(); 
					return $totalStudents;
			 
		}

		function removeRegistraion($conn, $studentID) { /* remove student online registration */	

			global $studentOnlineRegTB;

					$ebele_mark = "DELETE

									FROM $studentOnlineRegTB
									
									WHERE stu_id = :stu_id
									
									LIMIT 1";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':stu_id', $studentID);
					$igweze_prep->execute();
			 
		} 		
		
		function wizGradeEvents($conn) { /* retrieve school events */	

			global $notificationTB;
			
					$array = $conn->query("SELECT eID AS id, comments AS title, startdate AS start, 
										enddate as end
					
								FROM  $notificationTB")->fetchAll(PDO::FETCH_ASSOC);
									
								echo json_encode($array);						
			 
		}

		function wizGradeTimeTable($conn) { /* retrieve school timetable */	

			global $studentTimeTable;
			
					$array = $conn->query("SELECT tID AS id, comments AS title, startdate AS start, enddate 
											as end
					
											FROM  $studentTimeTable")->fetchAll(PDO::FETCH_ASSOC);
									
								echo json_encode($array);					
			 
		}
		
		function wizGradeStudentAttendance($conn, $regID) { /* retrieve student daily attendance  array json_encode */	

				global $daily_comments_tb;
			
				$array = $conn->query("SELECT rID AS id, comments AS title, startdate AS start, enddate as end
				
													FROM  $daily_comments_tb
													
													WHERE ireg_id = $regID")->fetchAll(PDO::FETCH_ASSOC);
								
								
				echo json_encode($array);						
			 
		}


		function wizGraderollCallArray($conn, $regID) { /* retrieve student daily attendance array */	

				global $daily_comments_tb;
			
				$rollCallArray = $conn->query("SELECT rID AS id, comments, startdate, enddate
				
													FROM  $daily_comments_tb
													
													WHERE ireg_id = $regID")->fetchAll(PDO::FETCH_ASSOC);
								
								
							array_unshift($rollCallArray,"");
	   						unset($rollCallArray[0]);
			
				return  $rollCallArray;
			 
		}		
		
		function onlineExamData($conn) { /* online student examination array */	
			
				global $wizGradeExamTB, $fiVal;

							$onlineExamData = $conn->query("SELECT eID, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, status
						
															FROM $wizGradeExamTB")->fetchAll(PDO::FETCH_ASSOC);
															
							array_unshift($onlineExamData,"");
	   						unset($onlineExamData[0]);
			
				return  $onlineExamData;
		}
		
		function onlineStaffExamData($conn, $userID) { /* online staff examination information */	
			
				global $wizGradeExamTB, $fiVal;

							$onlineExamData = $conn->query("SELECT eID, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, status
						
															FROM $wizGradeExamTB
															
															WHERE 	eStaff = $userID")->fetchAll(PDO::FETCH_ASSOC);
															
							array_unshift($onlineExamData,"");
	   						unset($onlineExamData[0]);
			
				return  $onlineExamData;
		}
		
		function onlineExamInfo($conn, $eID) { /* online student examination information */	
			
				global $wizGradeExamTB;

							$onlineExamData = $conn->query("SELECT eID, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, status
						
															FROM $wizGradeExamTB
															
															WHERE  eID = $eID")->fetchAll(PDO::FETCH_ASSOC);
															
							array_unshift($onlineExamData,"");
	   						unset($onlineExamData[0]);
			
				return  $onlineExamData;
		}		 

		function questionData($conn) { /* online exam question array */	
			
				global $wizGradeQuestionTB, $fiVal;

							$questionData = $conn->query("SELECT qID, eID, question, qPicture, qOptions, qAnswer, qMark
						
															FROM $wizGradeQuestionTB")->fetchAll(PDO::FETCH_ASSOC);
															
							array_unshift($questionData,"");
	   						unset($questionData[0]);
			
				return  $questionData;
		}
		
		function questionInfo($conn, $qID) { /* online exam question information */	
			
				global $wizGradeQuestionTB;

							$questionData = $conn->query("SELECT qID, eID, question, qPicture, qOptions, qAnswer, qMark
						
															FROM $wizGradeQuestionTB
															
															WHERE  qID = $qID")->fetchAll(PDO::FETCH_ASSOC);
															
							array_unshift($questionData,"");
	   						unset($questionData[0]);
			
				return  $questionData;
		}
		
		function examQuestions($conn, $eID) {  /* online exam question array */	
			
				global $wizGradeQuestionTB;

							$questionData = $conn->query("SELECT qID, eID, question, qPicture, qOptions, qAnswer, qMark
						
															FROM $wizGradeQuestionTB
															
															WHERE  eID = $eID")->fetchAll(PDO::FETCH_ASSOC);
															
							array_unshift($questionData,"");
	   						unset($questionData[0]);
			
				return  $questionData;
		} 
		 
		
		function onlineAssignData($conn) { /* online student assignment array */	
			
				global $wizGradeAssignTB, $fiVal;

							$onlineAssignData = $conn->query("SELECT eID, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, dDate, status
						
															FROM $wizGradeAssignTB")->fetchAll(PDO::FETCH_ASSOC);
															
							array_unshift($onlineAssignData,"");
	   						unset($onlineAssignData[0]);
			
				return  $onlineAssignData;
		}
		
		function onlineStaffAssignData($conn, $userID) { /* online staff assignment array */
			
				global $wizGradeAssignTB, $fiVal;

							$onlineAssignData = $conn->query("SELECT eID, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, dDate, status
						
															FROM $wizGradeAssignTB
															
															WHERE 	eStaff = $userID")->fetchAll(PDO::FETCH_ASSOC);
															
							array_unshift($onlineAssignData,"");
	   						unset($onlineAssignData[0]);
			
				return  $onlineAssignData;
		}
		
		function onlineAssignInfo($conn, $eID) {  /* online student assignment information */	
			
				global $wizGradeAssignTB;

							$onlineAssignData = $conn->query("SELECT eID, session, level, eTerm, class, eTitle, eSubject, eDetail, eTime, dDate, status
						
															FROM $wizGradeAssignTB
															
															WHERE  eID = $eID")->fetchAll(PDO::FETCH_ASSOC);
															
							array_unshift($onlineAssignData,"");
	   						unset($onlineAssignData[0]);
			
				return  $onlineAssignData;
		}		 

		function assignQuestionData($conn) { /* online assignment question array */
			
				global $wizGradeAssignQuestionTB, $fiVal;

							$assignQuestionData = $conn->query("SELECT qID, eID, question, qPicture, qOptions, qAnswer, qMark
						
															FROM $wizGradeAssignQuestionTB")->fetchAll(PDO::FETCH_ASSOC);
															
							array_unshift($assignQuestionData,"");
	   						unset($assignQuestionData[0]);
			
				return  $assignQuestionData;
		}
		
		function assignQuestionInfo($conn, $qID) {  /* online assignment question information */
			
				global $wizGradeAssignQuestionTB;

							$assignQuestionData = $conn->query("SELECT qID, eID, question, qPicture, qOptions, qAnswer, qMark
						
															FROM $wizGradeAssignQuestionTB
															
															WHERE  qID = $qID")->fetchAll(PDO::FETCH_ASSOC);
															
							array_unshift($assignQuestionData,"");
	   						unset($assignQuestionData[0]);
			
				return  $assignQuestionData;
		}
		
		function assignQuestions($conn, $eID) {  /* online assignment question array */
			
				global $wizGradeAssignQuestionTB;

							$assignQuestionData = $conn->query("SELECT qID, eID, question, qPicture, qOptions, qAnswer, qMark
						
															FROM $wizGradeAssignQuestionTB
															
															WHERE  eID = $eID")->fetchAll(PDO::FETCH_ASSOC);
															
							array_unshift($assignQuestionData,"");
	   						unset($assignQuestionData[0]);
			
				return  $assignQuestionData;
		} 
		
		function studentLevel($conn) {  /* retrieve student level */

				global $classLevelTB, $foreal, $schoolExt, $wizGradeNurAbr, $thVal;
		
				if($schoolExt == $wizGradeNurAbr){ $limit = "LIMIT $thVal";
			    }else{ $limit = ''; }
				
				$ebele_mark = "SELECT DISTINCT cl_id, level

                     			FROM $classLevelTB
								
								ORDER BY cl_id $limit";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   						
						$level_id = $row['cl_id'];
						$level = $row['level'];             			

              			echo "<option value=\"$level_id\">$level</option>"."\r\n";

					}	
				
				}else{
				
						echo "<option value=''>No Student Level found</option>"."\r\n";
				
				} 

		}
		
		function studentClassLevel($level) {  /* retrieve student class */
				
				if($level == 1) {
				
					$stuClass = 'class_1'; 
				
				}elseif($level == 2) {
				
					$stuClass = 'class_2'; 
				
				}elseif($level == 3) {
				
					$stuClass = 'class_3'; 
				
				}elseif($level == 4) {
				
					$stuClass = 'class_4'; 
									
				}elseif($level == 5) {
				
					$stuClass = 'class_5'; 
									
				}elseif($level == 6) {
			
					$stuClass = 'class_6'; 
									
				}else{
				
					$stuClass = 'class_1';  
				
				}
							
				return $stuClass;
	    }	
		
		function studentLevelsArray($conn) { /* student level array */

				global $classLevelTB, $foreal;
			
				$levelArray = $conn->query("SELECT DISTINCT cl_id, level

                     			FROM $classLevelTB
								
								ORDER BY cl_id")->fetchAll(PDO::FETCH_ASSOC);
			
				return  $levelArray;

		}
		
		function levelminCourseArray($conn) { /* retrieve student level minimum course array */

				global $classLevelTB, $foreal;
			
				$minCourseArray = $conn->query("SELECT DISTINCT cl_id, minCourse

                     			FROM $classLevelTB
								
								ORDER BY cl_id")->fetchAll(PDO::FETCH_ASSOC);
								
							array_unshift($minCourseArray,"");
	   						unset($minCourseArray[0]);				
			
				return  $minCourseArray;

		}

		function studentClass($conn, $stu_reg, $level) {  /* retrieve a student class*/

				global $i_reg_tb, $foreal;

				$nk_class = 'class_'.$level;
				
				$ebele_mark = "SELECT $nk_class

						 FROM $i_reg_tb 

						 WHERE nk_regno = :nk_regno";
						 
					$igweze_prep = $conn->prepare($ebele_mark);

					$igweze_prep->bindValue(':nk_regno', $stu_reg, PDO::PARAM_STR);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		   
							$class = $row[$nk_class];
							
						}	
					
					}else{
					
						$class = "";
				
					} 

			   return $class;

		}
	 
		function studentClassCount($conn, $sessionID, $class, $level) {  /* count student class */

				global $i_reg_tb, $foreal;

				$nk_class = 'class_'.$level;
				
				$ebele_mark = "SELECT ireg_id

						 FROM $i_reg_tb 

						 WHERE 	session_id = :session_id
						 
						 AND active = :active
						 
						 AND $nk_class = :class";
						 
					$igweze_prep = $conn->prepare($ebele_mark);

					$igweze_prep->bindValue(':session_id', $sessionID);
					$igweze_prep->bindValue(':active', $foreal);
					$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
				return $rows_count;

		} 

		function studentClassArray($conn, $level) {  /* retrieve student class array */

				global $classLevelTB, $foreal;

				$ebele_mark = "SELECT class

                     			FROM $classLevelTB
								
								WHERE cl_id = :cl_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':cl_id', $level);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   						
						$classArray  = $row['class'];
						
					}	
				
				}else{
				
						$classArray = '';
				
				} 
			
				return  $classArray;

		}

		function studentClassTypeArray($conn, $level) { /* retrieve student class type array */

			global $classLevelTB, $foreal;

				$ebele_mark = "SELECT class_type

                     			FROM $classLevelTB
								
								WHERE cl_id = :cl_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':cl_id', $level);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   						
						$classArray  = $row['class_type'];
						
					}	
				
				}else{
				
						$classArray = '';
				
				} 
			
				return  $classArray;

		}

		function returnStudentClassType($conn, $level, $class) {  /* return student class type array */

				global $i_false, $foVal, $class_list;
			  
				$clArray = studentClassArray($conn, $level);
			 
				$classArray = unserialize($clArray);

			    $classArray_l = ((count($classArray)) - 1);
				
				for($i = $i_false; $i <= $classArray_l; $i++){
				
					$classList[] = $class_list[$i];
				
				} 
				
				if($level >= $foVal){
					
					$clTyArray = studentClassTypeArray($conn, $level);
					$classTypeArray = unserialize($clTyArray);					
				
				} 
				
				$classArrayList = array_combine($classList, $classTypeArray);
				
				$classType = $classArrayList[$class]; 
				
				return $classType;

		}
		
		function mlevelArrays($school){ /* online registration level array */
			
				global $nursery_list, $primary_list, $secondary_list, $fiVal, $seVal, $thVal; 
			
				if($school == $fiVal){
					 
					$levelArr = $nursery_list;
					
				}elseif($school == $seVal){
					 
					$levelArr = $primary_list;
					
				}elseif($school == $thVal){
					 
					$levelArr = $secondary_list;
					
				}else{
					
					$levelArr = '';
					 
				}
				 
				return $levelArr;			
			
		}  
		
		function resetResultComputation($conn, $sessionID, $level, $class, $term) {  /* reset results computaion */

				global $rsTeachersConfigTB, $fiVal;
				
				$ebele_mark = "SELECT s_id
		
								FROM $rsTeachersConfigTB
						
								WHERE  session = :session
						
										AND level = :level
						
										AND class = :class
										
										AND term = :term";
				 
				$igweze_prep = $conn->prepare($ebele_mark);				 
				$igweze_prep->bindValue(':session', $sessionID);
				$igweze_prep->bindValue(':level', $level);
				$igweze_prep->bindValue(':class', $class);
				$igweze_prep->bindValue(':term', $term);
				$igweze_prep->execute();
		
				$rows_count = $igweze_prep->rowCount(); 
		
				if($rows_count == $fiVal) {

						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {
										
							$s_id = $row['s_id'];
							
						} 

						$ebele_mark_1 = "UPDATE  $rsTeachersConfigTB 
						
											SET 
											
											status = :status
											
											WHERE s_id = :s_id";
										
						$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
						$igweze_prep_1->bindValue(':s_id', $s_id);
						$igweze_prep_1->bindValue(':status', $fiVal);
						$igweze_prep_1->execute();
						
				}

		}

		function updateGrandSessionRS($conn, $db, $regID, $fiGrandTotal, $seGrandTotal, $thGrandTotal, $grandTotal, $grandAvg){ 
		/* update student grand annual score  */
	  
				global $foreal, $fiVal, $i_false;

				$ebele_mark = "SELECT $fiGrandTotal, $seGrandTotal, $thGrandTotal 

								FROM $db 

								WHERE  ireg_id = :reg_id";

				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':reg_id', $regID);				 
				$igweze_prep->execute();

				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {

					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

						$fiGrandT = $row[$fiGrandTotal];
						$seGrandT = $row[$seGrandTotal];
						$thGrandT = $row[$thGrandTotal];

						if($fiGrandT >= $fiVal){ $fiCount = $fiVal; }
						  
						else{ $fiCount = ''; $fiGrandT = ''; }

						if($seGrandT >= $fiVal){ $seCount = $fiVal; }
						  
						else{ $seCount = ''; $seGrandT = ''; }

						if($thGrandT >= $fiVal){ $thCount = $fiVal; }
						  
						else{ $thCount = ''; $thGrandT = ''; }

						$totalGrand = ($fiGrandT + $seGrandT + $thGrandT);
						$totalCount = ($fiCount + $seCount + $thCount);
						if(($totalGrand >= $fiVal) && ($totalCount >= $fiVal)){
						   
							$grandAverage = ($totalGrand / $totalCount);
							$grandAverage = number_format($grandAverage, 1);


							$ebele_mark_2 = "UPDATE $db SET  

									  $grandTotal = :grand_to,
									  
									  $grandAvg = :grade_nk 
									  
									  WHERE  ireg_id = :reg_id";
						  
							$igweze_prep_2 = $conn->prepare($ebele_mark_2);
							$igweze_prep_2->bindValue(':reg_id', $regID);
							$igweze_prep_2->bindValue(':grand_to', $totalGrand);
							$igweze_prep_2->bindValue(':grade_nk', $grandAverage);  
						  
							if($igweze_prep_2->execute()){
							  
								return $fiVal;
							  
							}
						  
						}else{ return $i_false;}
					}

				}else{

					  return $i_false;

				}
			  
										
		} 
	 
		function updateClassAnnualRS($conn, $db, $sessionID, $nk_class, $class, $fiGrandAvg, $seGrandAvg, $thGrandAvg, $grandAvg){
			
		/* update class annual result */	
	  
				global $i_reg_tb, $foreal, $fiVal, $i_false, $fiVal, $seVal, $thVal, $schoolCutoff; //$GrandAvg, 

				$ebele_mark = "SELECT a.$fiGrandAvg, $seGrandAvg, $thGrandAvg, r.ireg_id, nk_regno 
			  
								FROM $i_reg_tb r INNER JOIN $db a
						  
								WHERE  r.ireg_id = a.ireg_id

								AND r.session_id = :session_id
							 
								AND r.$nk_class = :class

								AND r.active = :foreal";
				  
				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);
				$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);
				$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);				  
				$igweze_prep->execute();
				  
				$rows_count = $igweze_prep->rowCount(); 
				  
				if($rows_count >= $foreal) {

					while($row = $igweze_prep->fetch(PDO::FETCH_BOTH)) {		

						$regNum = $row['nk_regno'];
						$regID = $row['ireg_id'];
						$fiGrandT = $row[$fiGrandAvg];
						$seGrandT = $row[$seGrandAvg];
						$thGrandT = $row[$thGrandAvg]; 
					  
						if($fiGrandT >= $fiVal){ $fiCount = $fiVal; }
						  
						else{ $fiCount = ''; $fiGrandT = ''; }
					  
						if($seGrandT >= $fiVal){ $seCount = $fiVal; }
						  
						else{ $seCount = ''; $seGrandT = ''; }
					  
						if($thGrandT >= $fiVal){ $thCount = $fiVal; }
						  
						else{ $thCount = ''; $thGrandT = ''; }
					  
							$totalGrand = ($fiGrandT + $seGrandT + $thGrandT);
							$totalCount = ($fiCount + $seCount + $thCount);
						   
							if(($totalGrand >= $fiVal) && ($totalCount >= $fiVal)){
							   
								$grandAverage = ($totalGrand / $totalCount);
								$grandAverage = number_format($grandAverage, 1); 
								
								if($grandAverage > $schoolCutoff){
									
									$promoted = $fiVal;
									
								}elseif($grandAverage == $schoolCutoff){
									
									$promoted = $seVal;

								}elseif($grandAverage > $schoolCutoff){
									
									$promoted = $thVal;

								}else{
									
									
									$promoted = $thVal;

								}	

								$ebele_mark_2 = "UPDATE $db SET  
								
									$grandAvg = :grade_nk,
									certify = :certify	
								  
									WHERE  ireg_id = :reg_id";
								
								$igweze_prep_2 = $conn->prepare($ebele_mark_2);
								$igweze_prep_2->bindValue(':reg_id', $regID);
								//$igweze_prep_2->bindValue(':grand_to', $totalGrand); $GrandAvg = :grand_to, //checkThis
								$igweze_prep_2->bindValue(':grade_nk', $grandAverage); 
								$igweze_prep_2->bindValue(':certify', $promoted);
								$igweze_prep_2->execute();
							  
							  
							  
							  
							}else{ 
							
								
								$ebele_mark_2 = "UPDATE $db SET  
								
									 
									certify = :certify	
								  
									WHERE  ireg_id = :reg_id";
								
								$igweze_prep_2 = $conn->prepare($ebele_mark_2);
								$igweze_prep_2->bindValue(':reg_id', $regID);
								//$igweze_prep_2->bindValue(':grand_to', $totalGrand); $GrandAvg = :grand_to,	//checkThis							 
								$igweze_prep_2->bindValue(':certify', $thVal); 	   
								$igweze_prep_2->execute();
							
							}
					}
				  
				}else{
					  
							return $i_false;
					  
				}
			  
										
		}

		function maxStudentScore($conn, $stu_reg, $db, $field, $sessionID, $class, $nk_class) { /* student termly maximum subject score */

				global $i_reg_tb, $fiVal; 

				$ebele_mark = "SELECT MAX($field) AS maximum

								FROM $i_reg_tb r, $db f
								
								WHERE r.ireg_id = f.ireg_id

                          		AND r.session_id = :session_id 
						 
						  		AND r.$nk_class = :class

				          		AND r.active = :foreal";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);				
				$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':foreal', $fiVal, PDO::PARAM_STR);								 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $fiVal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_BOTH)) {		
	   
						$max_score = $row['maximum']; 
						
					}	
		
           		}else{

           				$max_score = '';

           		}
		   
		   		
				return $max_score; 

		} 

		function classBestStudentReg($conn, $db, $fieldPosi, $sessionID, $class, $nk_class) {  /* retrieve class best student information */

				global $i_reg_tb, $foreal; 

				$ebele_mark= "SELECT r.nk_regno

								FROM $i_reg_tb r INNER JOIN $db f
							
								ON (r.ireg_id = f.ireg_id)

                          		AND r.session_id = :session_id 
						 
						  		AND r.$nk_class = :class

				          		AND r.active = :foreal
						  
						  		AND f.$fieldPosi = :fieldPosi";
                   
					 
 			    $igweze_prep= $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':fieldPosi', $foreal, PDO::PARAM_STR);
				 
 				$igweze_prep->execute();
				
				$rows_count= $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
				
					while($row= $igweze_prep->fetch(PDO::FETCH_BOTH)) {		
	   
			   	     	$regNumArr [] = $row['nk_regno'];  

					}	 
				
				}else{
					
						$regNumArr = '';
							
				}
				
				return $regNumArr;
				
	    }

		function classSessionBeststudentReg($conn, $db, $sessionID, $fieldPosi, $fieldAvg) { /* retrieve all class best student information */

				global $i_reg_tb, $foreal; 

				$ebele_mark= "SELECT r.nk_regno

								FROM $i_reg_tb r INNER JOIN $db f
							
								ON (r.ireg_id = f.ireg_id)

                          		AND r.session_id = :session_id 

				          		AND r.active = :foreal
						  
						  		AND f.$fieldPosi = :fieldPosi
								
								ORDER BY $fieldAvg DESC"; 
					 
 			    $igweze_prep= $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':fieldPosi', $foreal, PDO::PARAM_STR);				 
 				$igweze_prep->execute();
				
				$rows_count= $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
				
					while($row= $igweze_prep->fetch(PDO::FETCH_BOTH)) {		
	   
			   	     	$regNumArr [] = $row['nk_regno'];  

					}	 
				
				}else{
					
						$regNumArr = '';
							
				}
				
				return $regNumArr;
				
	    }	 
		
		function classPromotionManager($conn, $db, $regNum){  /* school class student promotion manager */
	  
				global $i_reg_tb, $foreal, $fiVal, $seVal, $thVal, $i_false; 

				$ebele_mark = "SELECT r.ireg_id, nk_regno, f.certify

                     FROM $i_reg_tb r, $db f

                     WHERE r.nk_regno = :nk_regno

                     AND r.ireg_id = f.ireg_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':nk_regno', $regNum);			  
				$igweze_prep->execute();
				  
				$rows_count = $igweze_prep->rowCount(); 
				  
				if($rows_count == $foreal) {

					while($row = $igweze_prep->fetch(PDO::FETCH_BOTH)) {		
						  
						  $promoted = $row['certify'];
						  $regID = $row['ireg_id'];
						  
					}
				  
					if($promoted == $fiVal){							
						
						$promtSub = '<div style="background-color:#dff0d8;border-color:#d6e9c6;color:#3c763d; 							
						text-align:center; width:300px; padding:15px; font-size:24px; font-weight:700;
						margin:30px 10px 10px 30px;">Promoted </div>';							
					
					}elseif($promoted == $seVal){
						
						$promtSub = '<div style="background-color:#d9edf7;border-color:#bce8f1;color:#03C;							
						text-align:center; width:300px; padding:15px; font-size:24px; font-weight:700;
						margin:30px 10px 10px 30px;">Promoted on Trial </div>';
						
					}elseif($promoted == $thVal){
						
						$promtSub = '<div style="background-color:#fcf8e3;border-color:#faebcc;color:#C30;
						text-align:center; width:300px; padding:15px; font-size:24px; font-weight:700;
						margin:30px 10px 10px 30px;">Not Promoted </div>';
						
					}else{							
						
						$promtSub = '<div style="background-color:#fcf8e3;border-color:#faebcc;color:#C30;
						text-align:center; width:300px; padding:15px; font-size:24px; font-weight:700;
						margin:30px 10px 10px 30px;">*Not Promoted </div>';							
					
					}  
				  
				}else{ 
					  
							$promtSub = '<div style="background-color:#fcf8e3;border-color:#faebcc;color:#C30;
							text-align:center; width:300px; padding:15px; font-size:24px; font-weight:700;
							margin:30px 10px 10px 30px;">*Not Promoted </div>'; 
					  
				}
				  
				  
				return $promtSub;
		}					  

		function classPromotionManagerMin($conn, $promoted){  /* school class student promotion manager */
	  
				global $fiVal, $seVal, $thVal, $i_false; 
						  
				if($promoted == $fiVal){							
					
					$promtSub = '<div style="background-color:#dff0d8;border-color:#d6e9c6;color:#3c763d; 							
					text-align:center; width:150px; padding:15px; font-size:16px; font-weight:700;
					margin:30px 10px 10px 30px;">Promoted </div>';							
				
				}elseif($promoted == $seVal){
					
					$promtSub = '<div style="background-color:#d9edf7;border-color:#bce8f1;color:#03C;							
					text-align:center; width:150px; padding:15px; font-size:16px; font-weight:700;
					margin:30px 10px 10px 30px;">Promoted on Trial </div>';
					
				}elseif($promoted == $thVal){
					
					$promtSub = '<div style="background-color:#fcf8e3;border-color:#faebcc;color:#C30;
					text-align:center; width:150px; padding:15px; font-size:16px; font-weight:700;
					margin:30px 10px 10px 30px;">Not Promoted </div>';
					
				}else{							
					
					$promtSub = '<div style="background-color:#fcf8e3;border-color:#faebcc;color:#C30;
					text-align:center; width:150px; padding:15px; font-size:16px; font-weight:700;
					margin:30px 10px 10px 30px;">*Not Promoted </div>';							
				
				}					
					  
				return $promtSub;
		}		 

		function termStatusTb($term) {  /* student result status function  */

        		global $result_status_fi_term, $result_status_se_term, $result_status_th_term;
        
         		if ($term == 1){

					$term_status_tb = $result_status_fi_term;

        		 }elseif ($term == 2){

         			$term_status_tb = $result_status_se_term;

         		}elseif ($term == 3){

         			$term_status_tb = $result_status_th_term;

         		}else {
		 
		 			$term_status_tb = '';

         		}

         		return $term_status_tb;

		} 

        function wizGradeResultStatus($conn, $sessionID, $class, $level, $term) {	 /* student result status */	 
		
				global $rsTeachersConfigTB, $foreal, $i_false;
				
		  				$ebele_mark = "SELECT s_id, status
				
								FROM $rsTeachersConfigTB
								
										WHERE  session = :session
								
												AND level = :level
								
												AND class = :class
												
												AND term = :term";
						 
 					    $igweze_prep = $conn->prepare($ebele_mark);				 
						$igweze_prep->bindValue(':session', $sessionID);
						$igweze_prep->bindValue(':level', $level);
						$igweze_prep->bindValue(':class', $class);
						$igweze_prep->bindValue(':term', $term);
 						$igweze_prep->execute();
				
						$rows_count = $igweze_prep->rowCount(); 
				
						if($rows_count == $i_false) {
				
							$statusRS = $foreal;
				
						}else{
							
								while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {
												
				                 	$statusRS = $row['status'];
									
								}
						
						}

						return $statusRS;
	
		} 
		
        function rsClassTeachers($conn, $sessionID, $class, $level, $term) {  /* retrieve subject class teachers */	 	
		
				global $rsTeachersConfigTB, $foreal, $i_false;
				
		  				$ebele_mark = "SELECT t_info
				
								FROM $rsTeachersConfigTB
								
										WHERE  session = :session
								
												AND level = :level
								
												AND class = :class
												
												AND term = :term";
						 
 					    $igweze_prep = $conn->prepare($ebele_mark);				 
						$igweze_prep->bindValue(':session', $sessionID);
						$igweze_prep->bindValue(':level', $level);
						$igweze_prep->bindValue(':class', $class);
						$igweze_prep->bindValue(':term', $term);
 						$igweze_prep->execute();
				
						$rows_count = $igweze_prep->rowCount(); 
				
						if($rows_count == $i_false) {
				
							$t_info = $foreal;
				
						}else{
							
								while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {
												
				                 	$t_info = $row['t_info'];
									
								}
						
						} 

						return $t_info; 
	
		}  
		
        function rsTimeFrame($conn, $term, $sessionID) {	/* student result time frame  */	
		
				global $schoolSessionTB, $foreal, $expireStage, $editingStage;
				
				$rstf = rsTimeFrameField($term);
		
				$ebele_mark = "SELECT $rstf

			                     FROM $schoolSessionTB WHERE
					 
								 id_sess = :id_sess";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);

  				$igweze_prep->bindValue(':id_sess', $sessionID);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$timeframe = $row[$rstf];
						
					}	
				
				}else{
				
						$timeframe = "";
				
				} 
					$frstf = new DateTime($timeframe);
	     			$frstf->format('md');
					   
                    $today = new DateTime();
					$today->format('md');
					   
					if($today >= $frstf){
						   
						$tfStatus = $expireStage;
						   
					}else{
						   
						$tfStatus = $editingStage;
							
					}

				return $tfStatus; 
	
		} 
		
        function rsTermStatus($conn, $term_status_tb, $sessionID, $level, $class) {		/* student termly result status  */
		
				global $foreal; $RClass = 'R'.$class;
		
				$ebele_mark = "SELECT $RClass

                     FROM $term_status_tb WHERE
					 
					 session = :session

                     AND level = :level";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);

  				$igweze_prep->bindValue(':session', $sessionID);
				$igweze_prep->bindValue(':level', $level);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$status = $row[$RClass];
						
					}	
				
				}else{
				
				$status = "";
				
				}

           		return $status;
						
		}  
		

		function studentRegSessionID($conn, $stu_reg) {  /* student school session ID */

				global $i_reg_tb, $foreal;

				$ebele_mark = "SELECT session_id

                     FROM $i_reg_tb 

                     WHERE nk_regno = :nk_regno";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':nk_regno', $stu_reg, PDO::PARAM_STR);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$sess_id = $row['session_id'];
						
					}	
				
				}else{
			
					$sess_id = "";
			
				}
			
				return  $sess_id;

		}

		function sessionID($conn, $stu_session) {  /* school session ID */

				global $schoolSessionTB, $foreal;

				$ebele_mark = "SELECT id_sess

						 FROM $schoolSessionTB 

						 WHERE year = :year";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':year', $stu_session);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$sessionID = $row['id_sess'];
						
					}	
				
				}else{
				
					$sessionID = "";

				
				}

           		return $sessionID; 

		}

		function wizGradeSession($conn, $sess_id) {  /* school session  */

				global $schoolSessionTB, $foreal;

				$ebele_mark = "SELECT year

						 FROM $schoolSessionTB 

						 WHERE id_sess = :id_sess";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':id_sess', $sess_id, PDO::PARAM_INT);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$session = $row['year'];
						
					}	
				
				}else{
				
					$session = "";
				
				}

           		return $session;

		} 

		function termStartDate($conn, $sessionID, $term) {  /* retrieve school next term start  */

				global $schoolSessionTB, $foreal, $fiVal, $seVal, $thVal; 
			
				if($term == $fiVal) { $termVal = 'fi_term';}
				elseif($term == $seVal) { $termVal = 'se_term';}
				elseif($term == $thVal) { $termVal = 'th_term';}
				else { $termVal = 'fi_term';}

				$ebele_mark = "SELECT $termVal

						 FROM $schoolSessionTB 

						 WHERE 	id_sess = :session_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':session_id', $sessionID);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$nextDate = $row[$termVal];
						
					}	
				
				}else{
				
					$nextDate = "";
			
				}
				

           return $nextDate; 

		} //checkThis remove fun

		function schoolSession($conn) {  /* school session  */

        		global $schoolSessionTB, $foreal, $i_false, $fiVal, $seVal, $thVal, $foVal, $fifVal, $sixVal,
				$schoolExt,$wizGradeNurAbr;
		
				$levelArray = studentLevelsArray($conn);
		
				$curSess = currentSessionInfo($conn);
				
				list ($curSessID, $cSess) = explode ("@$@", $curSess);
				
				$fi_l = $curSessID; 				$fi_level = $levelArray[$i_false]['level'];
				$se_l = ($curSessID - $fiVal);		$se_level = $levelArray[$fiVal]['level'];
				$th_l = ($curSessID - $seVal);		$th_level = $levelArray[$seVal]['level'];
				$fo_l = ($curSessID - $thVal);		$fo_level = $levelArray[$thVal]['level'];
				$fif_l = ($curSessID - $foVal);		$fif_level = $levelArray[$foVal]['level'];
				$six_l = ($curSessID - $fifVal);	$six_level = $levelArray[$fifVal]['level'];
								
				$ebele_mark = "SELECT DISTINCT id_sess, year, current

                     			FROM $schoolSessionTB 
								 
								   ORDER BY year";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				//$igweze_prep->bindValue(':used', $foreal, PDO::PARAM_STR);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
					
					$terminate = false;
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   						
						$sessID = $row['id_sess'];
						$yr = $row['year'];
              			$yr1 = $row['year'] + $foreal;
						$current = $row['current'];
              			$ses_yr = "$yr - $yr1";
						
						
						if($current == $foreal){
							
							$selectSess = 'selected';
							$currentS = ' - Current Session';
							
						}else{
							
							$selectSess = '';
							$currentS = '';
						}
						
						$verbAf = ' Class Now ';

						if($schoolExt == $wizGradeNurAbr){

								if($sessID  == $fi_l){
								
									$classLevel = ' - for student in '.$fi_level.$verbAf;
									
								}elseif($sessID  == $se_l){
								
									$classLevel = ' - for student in '.$se_level.$verbAf;						
								
								}elseif($sessID  == $th_l){
								
									$classLevel = ' - for student in '.$th_level.$verbAf;
									
								}else{
								
									$classLevel  = '';
								}
						}else{


								if($sessID  == $fi_l){
								
									$classLevel = ' - for student in '.$fi_level.$verbAf;
									
								}elseif($sessID  == $se_l){
								
									$classLevel = ' - for student in '.$se_level.$verbAf;						
								
								}elseif($sessID  == $th_l){
								
									$classLevel = ' - for student in '.$th_level.$verbAf;
									
								}elseif($sessID  == $fo_l){
								
									$classLevel = ' - for student in '.$fo_level.$verbAf;
									
								}elseif($sessID  == $fif_l){
								
									$classLevel = ' - for student in '.$fif_level.$verbAf;
									
								}elseif($sessID  == $six_l){
								
									$classLevel = ' - for student in '.$six_level.$verbAf;
									
								}else{
								
									$classLevel  = '';
								}

						}
						if($terminate == false){

							echo "<option value=\"$yr\" $selectSess >$ses_yr Session $classLevel 
							$currentS </option>"."\r\n";
						
					    }

						if($current == $foreal){
							
							$terminate = true;
							
						} 

					}	
				
				}else{
				
						echo "<option value=''>Ooooooos, no Session wass found</option>"."\r\n";
				
				} 
         
		} 
     
		function schoolSessionL($conn, $passData) { /* school session  */

        		global $schoolSessionTB, $foreal, $i_false, $fiVal, $seVal, $thVal, $foVal, $fifVal, $sixVal,
				$schoolExt,$wizGradeNurAbr;
		
				$levelArray = studentLevelsArray($conn);
		
				$curSess = currentSessionInfo($conn, $passData);
				
				list ($curSessID, $cSess) = explode ("@$@", $curSess);
				
				$fi_l = $curSessID; 				$fi_level = $levelArray[$i_false]['level'];
				$se_l = ($curSessID - $fiVal);		$se_level = $levelArray[$fiVal]['level'];
				$th_l = ($curSessID - $seVal);		$th_level = $levelArray[$seVal]['level'];
				$fo_l = ($curSessID - $thVal);		$fo_level = $levelArray[$thVal]['level'];
				$fif_l = ($curSessID - $foVal);		$fif_level = $levelArray[$foVal]['level'];
				$six_l = ($curSessID - $fifVal);	$six_level = $levelArray[$fifVal]['level'];
								
				$ebele_mark = "SELECT DISTINCT id_sess, year, current

                     			FROM $schoolSessionTB 
								 
								   ORDER BY year DESC";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   						
						$sessID = $row['id_sess'];
						$yr = $row['year'];
              			$yr1 = $row['year'] + $foreal;
						$current = $row['current'];
              			$ses_yr = "$yr - $yr1";
						
						if($current == $foreal){
							
							//$selectSess = 'selected';
							$currentS = ' - Current';
							
						}else{
							
							//$selectSess = '';
							$currentS = '';
							
						}
						
						$showClass = false;
						
						if($schoolExt == $wizGradeNurAbr){ 

								if($sessID  == $fi_l){
								
									$classLevel = $fi_level;
									$flevel = $fiVal;
									$showClass = true;
									
								}elseif($sessID  == $se_l){
								
									$classLevel = $se_level;
									$flevel = $seVal;
									$showClass = true;
								
								}elseif($sessID  == $th_l){
								
									$classLevel = $th_level;
									$flevel = $thVal;
									$showClass = true;
									
								}else{
								
									$classLevel  = '';
									$flevel = '';
									$showClass = false;
								}

						
						}else{
							
								if($sessID  == $fi_l){
								
									$classLevel = $fi_level;
									$flevel = $fiVal;
									$showClass = true;
									
								}elseif($sessID  == $se_l){
								
									$classLevel = $se_level;
									$flevel = $seVal;
									$showClass = true;
								
								}elseif($sessID  == $th_l){
								
									$classLevel = $th_level;
									$flevel = $thVal;
									$showClass = true;
									
								}elseif($sessID  == $fo_l){
								
									$classLevel = $fo_level;
									$flevel = $foVal;
									$showClass = true;
									
								}elseif($sessID  == $fif_l){
								
									$classLevel = $fif_level;
									$flevel = $fifVal;
									$showClass = true;
									
								}elseif($sessID  == $six_l){
								
									$classLevel = $six_level;
									$flevel = $sixVal;
									$showClass = true;
									
								}else{
								
									$classLevel  = '';
									$flevel = '';
									$showClass = false;
								}
						}
						
              			if($showClass == true){
							
							$slData = trim($yr.'#@@#'.$flevel);	
							if($passData == $slData){
									
								$selectSess = 'selected';
								
							}else{

								$selectSess = '';
							} 
							
							echo "<option value='$slData' $selectSess >  $classLevel </option>"."\r\n";
						
						}

					}	
				
				}else{
				
						echo "<option value=''>Ooooooos, no Session wass found</option>"."\r\n";
				
				}

         
        }

        function formTeacherSession($conn, $tID, $mType) { /* class teacher school session  */

        		global $classFormTeachersTB, $schoolSessionTB, $foreal, $i_false, $fiVal, $seVal, $thVal, $foVal, 
				$fifVal, $sixVal, $schoolExt,$wizGradeNurAbr;
		
				$levelArray = studentLevelsArray($conn);
				$curSess = currentSessionInfo($conn);
				
				list ($curSessID, $cSess) = explode ("@$@", $curSess);
				
				$fi_l = $curSessID; 				$fi_level = $levelArray[$i_false]['level'];
				$se_l = ($curSessID - $fiVal);		$se_level = $levelArray[$fiVal]['level'];
				$th_l = ($curSessID - $seVal);		$th_level = $levelArray[$seVal]['level'];
				$fo_l = ($curSessID - $thVal);		$fo_level = $levelArray[$thVal]['level'];
				$fif_l = ($curSessID - $foVal);		$fif_level = $levelArray[$foVal]['level'];
				$six_l = ($curSessID - $fifVal);	$six_level = $levelArray[$fifVal]['level'];
								


				$ebele_mark = "SELECT DISTINCT s.year, id_sess, current, f.session	

                     			FROM $schoolSessionTB s INNER JOIN $classFormTeachersTB f
								
								ON s.id_sess = f.session
								
								AND f.t_id = :t_id
								 
								ORDER BY year";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':t_id', $tID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   						
						$sessID = $row['id_sess'];
						$yr = $row['year'];
              			$yr1 = $row['year'] + $foreal;
						$current = $row['current'];
              			$ses_yr = "$yr - $yr1";
						
						if($current == $foreal){
							
							//$selectSess = 'selected';
							$currentS = ' - Current';
							
						}else{
							
							//$selectSess = '';
							$currentS = '';
							
						}
						

						$verbAf = ' Class Now ';

						if($schoolExt == $wizGradeNurAbr){

								if($sessID  == $fi_l){
								
									$classLevel = ' - for student in '.$fi_level.$verbAf;
									$classML = $fi_level; $classMLV = $fiVal;
									
								}elseif($sessID  == $se_l){
								
									$classLevel = ' - for student in '.$se_level.$verbAf;
									$classML = $se_level; $classMLV = $seVal;	 		
									
								
								}elseif($sessID  == $th_l){
								
									$classLevel = ' - for student in '.$th_level.$verbAf;
									$classML = $th_level; $classMLV = $thVal;
									
								}else{
								
									$classLevel  = ''; $classML = ''; $classMLV = '';
								}
								
								if($mType == $seVal){
									
									$classInfo = $yr.'::-::'.$classMLV;
						
									echo "<option value=\"$classInfo\" $selectSess>$classML</option>"."\r\n";
									
									$classInfo = '';
							
								}
						}else{

								if($sessID  == $fi_l){
								
									$classLevel = ' - for student in '.$fi_level.$verbAf;
									$classML = $fi_level; $classMLV = $fiVal;
									
								}elseif($sessID  == $se_l){
								
									$classLevel = ' - for student in '.$se_level.$verbAf;
									$classML = $se_level; $classMLV = $seVal;									
								
								}elseif($sessID  == $th_l){
								
									$classLevel = ' - for student in '.$th_level.$verbAf;
									$classML = $th_level; $classMLV = $thVal;
									
								}elseif($sessID  == $fo_l){
								
									$classLevel = ' - for student in '.$fo_level.$verbAf;
									$classML = $fo_level; $classMLV = $foVal;
									
								}elseif($sessID  == $fif_l){
								
									$classLevel = ' - for student in '.$fif_level.$verbAf;
									$classML = $fif_level; $classMLV = $fifVal;
									
								}elseif($sessID  == $six_l){
								
									$classLevel = ' - for student in '.$six_level.$verbAf;
									$classML = $six_level; $classMLV = $sixVal;
									
								}else{
								
									$classLevel  = ''; $classML = ''; $classMLV = '';
								}
								
								if($mType == $seVal){
									
									$classInfo = $yr.'::-::'.$classMLV;
						
									echo "<option value=\"$classInfo\" $selectSess>$classML</option>"."\r\n";
									
									$classInfo = '';
							
								}

						}

              			if($mType == $fiVal){
						
							echo "<option value=\"$yr\" $selectSess>$ses_yr Session $classLevel $currentS </option>"."\r\n";
							
						}	

					}	
				
				}else{
				
						echo "<option value=''>Ooooooos, you have no class assign to you</option>"."\r\n";
				
				}

		}

		function currentSession($conn) {  /* current school session  */

				global $schoolSessionTB, $foreal;

				$ebele_mark = "SELECT DISTINCT id_sess, year, current

                     			FROM $schoolSessionTB
								 
								   ORDER BY year";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   						
						$sessID = $row['id_sess'];
						$yr = $row['year'];
              			$yr1 = $row['year'] + $foreal;
						$current = $row['current'];
              			$ses_yr = "$yr - $yr1";
						
						if($current == $foreal){
							
							$selectSess = 'selected';
							$currentS = 'Current';
							
						}else{
							
							$selectSess = '';
							$currentS = '';
							
						}

              			echo "<option value=\"$sessID\" $selectSess>$ses_yr $currentS Session</option>"."\r\n";

					}	
				
				}else{
				
						echo "<option value=''>Ooooooos, no Session was found</option>"."\r\n";
				
				} 

        }

		function currentSessionInfo($conn) {  /* current school session information  */

				global $schoolSessionTB, $foreal;

				$ebele_mark = "SELECT id_sess, year

                     			FROM $schoolSessionTB
								 
								   WHERE current = :current";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':current', $foreal);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   						
						$sessID = $row['id_sess'];
						$cSess = $row['year'];
					
					}	
					
					$curSess = $sessID.'@$@'.$cSess;
					
				}else{
					
					$curSess = '';
					
				}
						
				return $curSess;
         
		}

		function currentSessionTerm($conn) {  /* current school term  */

				global $schoolSessionTB, $foreal;

				$ebele_mark = "SELECT cur_term

                     			FROM $schoolSessionTB
								
								WHERE current = :current";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);

  				$igweze_prep->bindValue(':current', $foreal);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   						
						$curTerm = $row['cur_term'];

					}	
				
				}else{
				
						$curTerm = '';
				
				}
				
				return $curTerm;

        }

		function schoolSessionArrays($conn) {  /* school session array  */

            global $schoolSessionTB, $foreal;
			
							$disArray = $conn->query("SELECT id_sess, year, fi_term, se_term, th_term, current, cur_term
				
													FROM  $schoolSessionTB")->fetchAll(PDO::FETCH_ASSOC);
							
							array_unshift($disArray,"");
	   						unset($disArray[0]);
			
				return  $disArray;
		}

		function rsTimeFrameArrays($conn) {  /* school time frame array  */

            global $schoolSessionTB, $foreal;
			
							$rsArray = $conn->query("SELECT id_sess, year, rtf_fi, rtf_se, rtf_th, current, cur_term
				
													FROM  $schoolSessionTB")->fetchAll(PDO::FETCH_ASSOC);
							
							array_unshift($rsArray,"");
	   						unset($rsArray[0]);
			
				return  $rsArray;
		}
		
		
		function sesssionCurent($conn) {  /* retrieve school current session */

				global $schoolSessionTB, $foreal;

				$ebele_mark = "SELECT year

                     			FROM $schoolSessionTB 

                    			 WHERE current = :used";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);

  				$igweze_prep->bindValue(':used', $foreal, PDO::PARAM_STR);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   						
						$yr = $row['year'];
              			$yr1 = $row['year'] + $foreal;
              			$session = "$yr - $yr1";

					}	
				
				}else{
				
						$session ='';
				
				}


				return $session; 

		} 
		 
		function activeStaffs($conn) {  /* school active staff count */

				global $staffTB, $foreal;

				$ebele_mark = "SELECT t_id
				
								FROM $staffTB
								 
								   WHERE status = :status";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':status', $foreal);
 				$igweze_prep->execute();
				
				$totalStaffts = $igweze_prep->rowCount(); 
				return $totalStaffts;
         
		}

		function studentsPerStandard($conn, $sessionID) {  /* school active student pupolation count */

				global $i_reg_tb, $foreal;

				$ebele_mark = "SELECT ireg_id

                     			FROM $i_reg_tb
								 
								   WHERE session_id = :session_id
								   
								   AND active = :active";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_INT);
				$igweze_prep->bindValue(':active', $foreal);
 				$igweze_prep->execute();
				
				$totalStudents = $igweze_prep->rowCount(); 
				return $totalStudents;
         
		}

		function studentsSexPerStandard($conn, $sessionID, $sexType) {  /* school active gender pupolation count */

				global $i_reg_tb, $i_student_tb, $foreal;

				$ebele_mark = "SELECT r.ireg_id, s.stu_id

                     			FROM $i_reg_tb r INNER JOIN $i_student_tb s
								 
								   ON (r.ireg_id = s.ireg_id)
								   
								   AND r.session_id = :session_id
								   
								   AND r.active = :active
								   
								   AND s.i_gender = :i_gender";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':session_id', $sessionID);
				$igweze_prep->bindValue(':active', $foreal);
				$igweze_prep->bindValue(':i_gender', $sexType);
 				$igweze_prep->execute();
				
				$totalStudents = $igweze_prep->rowCount(); 
				
				return $totalStudents;
         
		} 

		function formTeacher($conn, $sessionID, $level, $class) {  /* retrieve assign class teacher information */ 

        		global $classFormTeachersTB, $foreal, $title_list; $class_all = 'all';

				$ebele_mark = "SELECT form_id, t_id 

                     			FROM  $classFormTeachersTB 
								
								WHERE  session = :session
								
								AND level = :level
								
								AND (class = :class
								
								OR class = :class_all)";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':session', $sessionID);
				$igweze_prep->bindValue(':level', $level);
				$igweze_prep->bindValue(':class', $class);
				$igweze_prep->bindValue(':class_all', $class_all);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	
					
						$t_id = $row['t_id'];
					
						$ftData = staffData($conn, $t_id);
						list ($ft_title, $ft_fullname, $ft_sex, $ft_rankingVal, $ft_picture, $ft_lname, $ft_phone, $ft_sign) = explode ("#@s@#", $ftData);
			
						$fttitleVal = $title_list[$ft_title];
						$formTeacher .= $fttitleVal.' '.$ft_fullname.' / ';


					}
					
					 $formTeacher = trim($formTeacher, ' / ');
					
				
				}else{
					
					$formTeacher = ' - ';
				
				} 
							
				return $formTeacher;
 
		}

		function formTeacherSignatures($conn, $sessionID, $level, $class) { /* retrieve assign class teacher signature */ 

        		global $classFormTeachersTB, $teachersSignExt, $foreal, $title_list; $class_all = 'all';

				$ebele_mark = "SELECT form_id, t_id 

                     			FROM  $classFormTeachersTB 
								
								WHERE  session = :session
								
								AND level = :level
								
								AND (class = :class
								
								OR class = :class_all)";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':session', $sessionID);
				$igweze_prep->bindValue(':level', $level);
				$igweze_prep->bindValue(':class', $class);
				$igweze_prep->bindValue(':class_all', $class_all);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	
					
						$t_id = $row['t_id'];
					
						$ftData = staffData($conn, $t_id);
						list ($ft_title, $ft_fullname, $ft_sex, $ft_rankingVal, $ft_picture, $ft_lname, $ft_phone, $ft_sign) = explode ("#@s@#", $ftData);


						$ftSign = $teachersSignExt.$ft_sign;
	
						if ((is_null($ft_sign)) || ($ft_sign == '') || (!file_exists($ftSign))){ 
						
							$ftSign = '';
							
						}else{ 
						
							$ftSignature = '<img src="'.$ftSign.'" style="height: 50px; width:100px; margin-top:0px;">';
							$formTeacherSign .= $ftSignature.' / ';
							
						} 


					}
					
						$formTeacherSign = trim($formTeacherSign, ' / ');
					
				
				}else{
					
						$formTeacherSign = ' - ';
				
				}


							
				return $formTeacherSign;
 
		} 

		function formTeacherLevel($conn, $tID, $sessionID) {  /* assign class teacher session array */ 

        		global $classFormTeachersTB, $foreal;

				$levelArray = $conn->query("SELECT DISTINCT level	

                     			FROM  $classFormTeachersTB 
								
								WHERE  t_id = $tID
								
								AND session = $sessionID")->fetchAll(PDO::FETCH_ASSOC);
							array_unshift($levelArray,"");
	   						unset($levelArray[0]);
							
				return $levelArray;
 
		}

		function formTeacherClass($conn, $tID, $sessionID, $level) {  /* assign class teacher class array */ 

        		global $classFormTeachersTB, $foreal;

				$ebele_mark = "SELECT DISTINCT class	

                     			FROM  $classFormTeachersTB 
								
								WHERE t_id = :t_id
								
								AND session = :session
								
								AND level = :level";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':t_id', $tID);
				$igweze_prep->bindValue(':session', $sessionID);
				$igweze_prep->bindValue(':level', $level);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	
					
						$classArray[] = $row['class'];
					}
					
					array_unshift($classArray,"");
	   				unset($classArray[0]);
					$classArray = array_unique($classArray);
				
				}else{
					
					$classArray = '';
				
				} 
							
				return $classArray;
 
		}

		function formTeachersArrays($conn, $tID) {  /* assign class teacher array */ 

				global $classFormTeachersTB, $foreal;

				$formTeacherArray = $conn->query("SELECT form_id, session, level, class

										FROM  $classFormTeachersTB
										
										WHERE t_id = $tID
										
										ORDER BY session, level")->fetchAll(PDO::FETCH_ASSOC);
										
				array_unshift($formTeacherArray,"");
				unset($formTeacherArray[0]);

				return  $formTeacherArray;
				
		}
		
		function teacherRemarksArrays($conn) {  /* teacher remarks array */ 

				global $tRemarksTB, $foreal;

				$remarkArray = $conn->query("SELECT id_rem AS id, remarks As name

										FROM  $tRemarksTB")->fetchAll(PDO::FETCH_ASSOC);
										
				array_unshift($remarkArray,"");
				unset($remarkArray[0]);

				return  $remarkArray;
				
		}		 

		function staffPicture($conn, $tID) {  /* school staffs/teachers picture */ 

				global $staffTB, $wizGradeDefaultPic, $staffPicExt, $foreal; 

  				$ebele_mark = "SELECT i_picture
				
								FROM $staffTB
								
						 		WHERE t_id = :t_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':t_id', $tID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
					
						$pic = $row['i_picture'];
					
					} 

            	}
				
            	$teacherPic = $staffPicExt.$pic;

				if ((is_null($pic)) || ($pic == '') || (!file_exists($teacherPic))){ $teacherPic = $wizGradeDefaultPic; }
            
				return $teacherPic;
            
		} 

		function removeTeacherPicSign($conn, $tID, $typeID) {  /* remove school staffs/teachers picture/signature */ 

				global $staffTB, $wizGradeDefaultPic, $staffPicExt, $teachersSignExt, $foreal, $fiVal, $seVal; 

				$ebele_mark = "SELECT i_picture, i_sign
				
								FROM $staffTB
								
						 		WHERE t_id = :t_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':t_id', $tID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
					
						$pic = $row['i_picture'];
						$sign = $row['i_sign'];

						if($typeID == $fiVal){
							
							$teacherPic = $staffPicExt.$pic;
		
							if ((!is_null($pic)) && ($pic != '') && (file_exists($teacherPic))){ unlink($teacherPic); }
						
						}	
	
						if($typeID == $seVal){
							
							$teacherSign = $teachersSignExt.$sign;
		
							if ((!is_null($sign)) && ($sign != '') && (file_exists($teacherPic))){ unlink($teacherSign); }
						
						}

					}


            	} 
            
		} 

		function staffData($conn, $tID) {  /* school staffs/teachers information */ 

				global $staffTB, $foreal; 

  				$ebele_mark = "SELECT t_id, i_title, i_picture, i_sign, i_firstname, i_lastname, i_midname, i_gender, rank, i_phone 

								 FROM $staffTB

								 WHERE t_id = :t_id";
								 
 			    $igweze_prep = $conn->prepare($ebele_mark);			
  				$igweze_prep->bindValue(':t_id', $tID);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$teacherID = $row['t_id'];
						$title = $row['i_title'];
						$picture = $row['i_picture'];
						$sign = $row['i_sign'];
						$fname = $row['i_firstname'];
						$lname = $row['i_lastname'];
						$mname = $row['i_midname'];
						$sex = $row['i_gender'];
						$rankingVal = $row['rank'];
						$phone = $row['i_phone'];
					
					} 
					
					$teacherName = $lname.' '.$fname.' '.$mname;
					
					$teacherData = $title.'#@s@#'.$teacherName.'#@s@#'.$sex.'#@s@#'.$rankingVal.'#@s@#'.$picture.
					'#@s@#'.$lname.'#@s@#'.$phone.'#@s@#'.$sign; 

            	}else{ 
					
					$teacherData = '';
					
				}
				
				return $teacherData; 
            
		}

		function staffToken($conn) {  /* school staffs/teachers token information */ 

				global $staffTB, $foreal, $i_false, $title_list, $fiVal;				
				
				$ebele_mark = "SELECT t_id, i_title, i_firstname, i_lastname, i_midname
				
								FROM $staffTB
								
								WHERE 	status = :status";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':status', $fiVal);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {

					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	
						
	        			$tID = $row['t_id'];
						$title = $row['i_title'];
        				$fname = $row['i_firstname'];
        				$lname = $row['i_lastname'];
        				$mname = $row['i_midname'];						
						
						$titleVal = $title_list[$title];
						$staff = "$titleVal $lname $fname $mname";	
						$staff = trim($staff);
						
						$staffArr .= "{ value: '$tID', label: '$staff' },";
						
					}
					
					$staffArr = trim($staffArr, ', ');
					
				}
				
				return $staffArr;				
				
		}
		
		function staffUserExits($conn, $userName) {  /* check if school staffs/teachers exits */ 

				global $staffTB, $foreal;
			
				$userName = trim($userName);
				
  				$ebele_mark = "SELECT t_id
				
								FROM $staffTB
								
						 		WHERE staff_id = :staff_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':staff_id', $userName);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				return $rows_count;
				
		}		
		
       	function wizGradeStaffPassData($conn, $staffID) {  /* school staffs/teachers password details */ 

       		global $staffTB, $foreal, $i_false;

				$ebele_mark = "SELECT t_id, staff_id, i_firstname, i_lastname, i_midname, rank,
									i_sponsor_ac, i_accesspass, t_grade

                     		     FROM $staffTB

                     				WHERE staff_id = :staff_id";


			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue('staff_id',  $staffID);
 				$igweze_prep->execute();

				$rows_count = $igweze_prep->rowCount();

				if($rows_count == $foreal) {

					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

	        			$t_id = $row['t_id'];
						$staffID = $row['staff_id'];
        				$fname = $row['i_firstname'];
        				$lname = $row['i_lastname'];
        				$mname = $row['i_midname'];
						$ranking = $row['rank'];
	        	       	$access = $row['i_accesspass'];
	        	       	$password = $row['i_sponsor_ac'];
						$t_grade = $row['t_grade'];

					}

					$staffPass = decrypter($access, $password);
					$staffName = $lname;

					$staffData = $t_id.'@(.$*S*$.)@'.$staffID.'@(.$*S*$.)@'.$staffPass.'@(.$*S*$.)@'.
					$staffName.'@(.$*S*$.)@'.$ranking.'@(.$*S*$.)@'.$t_grade;

				}else{

					$staffData = $i_false;


				}

				return $staffData;

		}		

		function staffArrays($conn) {  /* school staffs/teachers array */ 

				global $staffTB, $foreal, $fiVal, $i_false;

				$teachersArray = $conn->query("SELECT t_id, i_title, i_picture, i_firstname, i_lastname, 
											  i_midname, rank

										FROM  $staffTB
										
										WHERE status != $i_false")->fetchAll(PDO::FETCH_ASSOC);
										
				array_unshift($teachersArray,"");
				unset($teachersArray[0]);

				return  $teachersArray;
		} 

		function staffRankingArrays($conn) {  /* school staffs/teachers ranking array */ 

				global $staffRankingTB, $foreal;

				$staffRankingArray = $conn->query("SELECT rank_id AS id, ranking As name

										FROM  $staffRankingTB")->fetchAll(PDO::FETCH_ASSOC);
										
				array_unshift($staffRankingArray,"");
				unset($staffRankingArray[0]);

				return  $staffRankingArray;
				
		}  
		
		function recentAcademicYear($level, $year1) {  /* school session academic year  */ 

				if ($level == 1){

					$second_yr = $year1 + 1;
					$first_yr = $second_yr - 1;

					$recent_a_yr = "$first_yr"." - "."$second_yr";

				}elseif ($level == 2){

					$second_yr = $year1 + 2;
					$first_yr = $second_yr - 1;

					$recent_a_yr = "$first_yr"." - "."$second_yr";

				}elseif ($level == 3){

					$second_yr = $year1 + 3;
					$first_yr = $second_yr - 1;

					$recent_a_yr = "$first_yr"." - "."$second_yr";

				}elseif ($level == 4){

					$second_yr = $year1 + 4;
					$first_yr = $second_yr - 1;

					$recent_a_yr = "$first_yr"." - "."$second_yr";

				}elseif ($level == 5){

					$second_yr = $year1 + 5;
					$first_yr = $second_yr - 1;

					$recent_a_yr = "$first_yr"." - "."$second_yr";

				}elseif ($level == 6){

					$second_yr = $year1 + 6;
					$first_yr = $second_yr - 1;

					$recent_a_yr = "$first_yr"." - "."$second_yr";

				}elseif ($level == 700){

					$second_yr = $year1 + 7;
					$first_yr = $second_yr - 1;

					$recent_a_yr = "$first_yr"." - "."$second_yr";

				}else{

					$recent_a_yr = "*";

				}

				return $recent_a_yr;
		} 

		function studentExits($conn, $stu_reg) {  /* check if a student really exist */ 

				global $i_reg_tb, $foreal, $i_false, $errorMsg, $erroMsg, $msgEnd, $eEnd;
            
				$ebele_mark = "SELECT ireg_id

                     FROM $i_reg_tb  

                     WHERE nk_regno = :nk_regno";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count > $foreal) {

           			$msg_e = "Critical Error, Student With Reg no. ($stu_reg) occurs more than once in datababse. Please delete the duplicate. Thanks";
					echo $errorMsg.$msg_e.$eEnd;  echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */ </script>";exit; 
            
            	}elseif($rows_count == $i_false){
				
					$msg_e = "Ooooooops, Student With Reg no. ($stu_reg) dose not exist and is not a valid student.  Thanks";
					echo $errorMsg.$msg_e.$eEnd;  echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */ </script>"; exit;
				}

		} 

		function studentExitsRV($conn, $stu_reg) {  /* check if a student really exist */

				global $i_reg_tb, $foreal, $i_false;
			
				$ebele_mark = "SELECT ireg_id

						 FROM $i_reg_tb  

						 WHERE nk_regno = :nk_regno";
					 
				$igweze_prep = $conn->prepare($ebele_mark);

				$igweze_prep->bindValue(':nk_regno', $stu_reg);
				 
				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $i_false){

					return $i_false;
						
				}else {
			
					return $foreal;			
				}
			
		} 
		
		function studentRegID($conn, $stu_reg) {   /* student record ID  */

				global $i_reg_tb, $foreal;
							
				$ebele_mark = "SELECT ireg_id

						 FROM $i_reg_tb  

						 WHERE nk_regno = :nk_regno";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$st_reg_id = $row['ireg_id'];
						
					}	
				
				}else{
			
					$st_reg_id = "";
			
				}
			
				return  $st_reg_id;
		}
		
		function studentReg($conn, $regID) {  /* student registration number  */

				global $i_reg_tb, $foreal;
							
				$ebele_mark = "SELECT nk_regno

						 FROM $i_reg_tb  

						 WHERE ireg_id = :ireg_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':ireg_id', $regID);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$stuReg = $row['nk_regno'];
						
					}	
					
				
				}else{
			
					$stuReg = "";
			
				}
			
				return  $stuReg;
		}
		 
		function sessionLastReg($conn, $session) {  /* school session last student registration number  */

				global $i_reg_tb, $foreal;
				
				$sessionID = sessionID($conn, $session); 
				
				$ebele_mark = "SELECT nk_regno 

						 FROM $i_reg_tb  

						 WHERE session_id = :session_id
						 
						 ORDER BY ireg_id DESC LIMIT 1";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':session_id', $sessionID);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$regNum = $row['nk_regno'];
						
					}	
				
				}else{
			
						$regNum = "";
			
				} 
			
				return  $regNum;
		}

		function sessionLastRegID($conn, $sessionID) {  /* school session last student registration ID  */

				global $i_reg_tb, $foreal;
				
				$ebele_mark = "SELECT nk_regno 

						 FROM $i_reg_tb  

						 WHERE session_id = :session_id
						 
						 ORDER BY ireg_id DESC LIMIT 1";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':session_id', $sessionID);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$regNum = $row['nk_regno'];
						
					}	
				
				}else{
			
						$regNum = "";
			
				}
			
				return  $regNum;
		}  
		
		function wizGradeSchool($conn) {  /* school configuration setup array  */

				global $wizGradeSchoolTB, $foreal;
			
				$schoolArray = $conn->query("SELECT school_id, school_name, school_address, reg_prefix, school_cutoff,
									school_head, bursary, libraian, school_theme, school_logo, school_sub_cutoff, translator, 
									screen_timer, ewallet

				FROM  $wizGradeSchoolTB")->fetchAll(PDO::FETCH_ASSOC);
			
				return  $schoolArray;
		} 

		function schoolExamConfigArrays($conn) {  /* school exam configuration array  */

				global $rsExamConfigTB, $foreal;
			
				$schoolArray = $conn->query("SELECT ex_id, fi_ass, se_ass, th_ass, fo_ass, fif_ass, six_ass, exam, rsType, status

								FROM  $rsExamConfigTB")->fetchAll(PDO::FETCH_ASSOC);
			
				return  $schoolArray;
		} 
		
		function disabilityArrays($conn) {  /* disability array  */

            global $disabilityTB, $foreal;
			
							$disArray = $conn->query("SELECT id_dis AS id, disability As name
				
													FROM  $disabilityTB")->fetchAll(PDO::FETCH_ASSOC);
							array_unshift($disArray,"");
	   						unset($disArray[0]);
			
				return  $disArray;
		} 

		function reDisabilityArrays($disability) {  /* disability array  */

				list ($disability_1, $disability_2, $disability_3, $disability_4, $disability_5, $disability_6, 
					  $disability_7, $disability_8) = explode (",", $disability);
   
				if (isset($disability_1)) { $dis1 = "$disability_1";  settype($dis1, "integer");  
					$DisArray = array($dis1);
				}
				if (isset($disability_2)) { $dis2 = "$disability_2";  settype($dis2, "integer"); $DisArray = ""; 
				$DisArray = array($dis1, $dis2);}
				if (isset($disability_3)) { $dis3 = "$disability_3";  settype($dis3, "integer"); $DisArray = ""; 
				$DisArray = array($dis1, $dis2, $dis3);}   
				if (isset($disability_4)) { $dis4 = "$disability_4";  settype($dis4, "integer"); $DisArray = ""; 
				$DisArray = array($dis1, $dis2, $dis3, $dis4);}
				if (isset($disability_5)) { $dis5 = "$disability_5";  settype($dis5, "integer"); $DisArray = ""; 
				$DisArray = array($dis1, $dis2, $dis3, $dis4, $dis5);}   
				if (isset($disability_6)) { $dis6 = "$disability_6";  settype($dis6, "integer"); $DisArray = ""; 
				$DisArray = array($dis1, $dis2, $dis3, $dis4, $dis5, $dis6);}
				if (isset($disability_7)) { $dis7 = "$disability_7";  settype($dis7, "integer");
										 $DisArray = ""; $DisArray = array($dis1, $dis2, $dis3, $dis4, $dis5, $dis6, $dis7);}   
				if (isset($disability_8)) { $dis8 = "$disability_8";  settype($dis8, "integer"); 
										 $DisArray = ""; $DisArray = array($dis1, $dis2, $dis3, $dis4, $dis5, $dis6, $dis7, $dis8);}	
			
				return  $DisArray;
		}  
		
       	function wizGradeAdminData($conn, $admiID) {  /* school admin information  */

				global $adminAccessTB, $foreal, $i_false;

				$ebele_mark = "SELECT admin_id, a_title, a_fname, a_lname, a_mname, a_picture, a_mail

									FROM $adminAccessTB

                     				WHERE admin_id = :admin_id"; 

			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue('admin_id', $admiID);
 				$igweze_prep->execute();
				$rows_count = $igweze_prep->rowCount();

				if($rows_count == $foreal) {

					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

	        			$adminID = $row['admin_id'];
						$pic = $row['a_picture'];
						$title = $row['a_title'];
        				$fname = $row['a_fname'];
        				$lname = $row['a_lname'];
        				$mname = $row['a_mname'];
	        	       	$email = $row['a_mail'];
					} 

					$adminData = $adminID.'@(.$.)@'.$pic.'@(.$.)@'.$title.'@(.$.)@'.$lname.'@(.$.)@'.$fname.'@(.$.)@'.
					$mname.'@(.$.)@'.$email; 

				}else{ 

					$adminData = $i_false; 

				} 

				return $adminData; 

		}
		
       	function wizGradeAdminPassData($conn, $adminUser) {  /* school admin password details */

				global $adminAccessTB, $foreal, $i_false;

				$ebele_mark = "SELECT admin_id,  a_fname, a_lname, a_mname, a_delimit, a_pass

                     		     FROM $adminAccessTB

                     				WHERE a_name = :a_name"; 

			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue('a_name', $adminUser);
 				$igweze_prep->execute();
				$rows_count = $igweze_prep->rowCount();

				if($rows_count == $foreal) {

					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

	        			$adminID = $row['admin_id'];
        				$fname = $row['a_fname'];
        				$lname = $row['a_lname'];
        				$mname = $row['a_mname'];
	        	       	$access = $row['a_pass'];
	        	       	$password = $row['a_delimit']; 

					}

					$adminPass = decrypter($access, $password);
					$adminName = $lname;

					$adminData = $adminID.'@(.$*S*$.)@'.$adminPass.'@(.$*S*$.)@'.$adminName;

				}else{ 

					$adminData = $i_false; 

				}

				return $adminData; 

		}
       	function recoveryInfo($conn, $email, $resetID) {  /* school admin recovery password information  */

				global $adminAccessTB, $foreal, $i_false;

				$ebele_mark = "SELECT a_mail, recov_info, recov_time

									FROM $adminAccessTB

                     				WHERE recov_info = :recov_info
									
									AND a_mail = :a_mail"; 

			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue('recov_info', $resetID);
				$igweze_prep->bindValue('a_mail', $email);
 				$igweze_prep->execute();
				$rows_count = $igweze_prep->rowCount();

				if($rows_count == $foreal) {

					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

	        			$rInfo = $row['recov_info'];
						$rTime = $row['recov_time'];
	        	       	$email = $row['a_mail'];
					} 

					$rData = $rInfo.'@(.$.)@'.$rTime.'@(.$.)@'.$email; 

				}else{ 

					$rData = ""; 

				} 

				return $rData; 

		}
		
		function removeAdminPicture($conn, $admiID) { /* remove school admin picture */

				global $adminAccessTB, $wizGradeDefaultPic, $wizGradeAdminPicDir, $foreal; 

				$ebele_mark = "SELECT a_picture
				
								FROM $adminAccessTB
								
						 		WHERE admin_id = :admin_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue('admin_id', $admiID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
					
						$pic = $row['a_picture'];

					}
					
					$adminPic = $wizGradeAdminPicDir.$pic;
		
					if ((!is_null($pic)) && ($pic != '') && (file_exists($adminPic))){ unlink($adminPic); } 

            	} 
            
		}   
		
		function studentsClubArrays($conn) {  /* school clubs array */

				global $schoolClubTB, $foreal;

				$clubArray = $conn->query("SELECT club_id AS id, club As name

										FROM  $schoolClubTB")->fetchAll(PDO::FETCH_ASSOC);
										
				array_unshift($clubArray,"");
				unset($clubArray[0]);

				return  $clubArray;
				
		}
 
		function clubPostArrays($conn) {  /* school clubs position array */

				global $schoolClubPostTB, $foreal;

				$clubArray = $conn->query("SELECT club_id AS id, club_post As name

										FROM  $schoolClubPostTB")->fetchAll(PDO::FETCH_ASSOC); 

				array_unshift($clubArray,"");
				unset($clubArray[0]);

				return  $clubArray;
				
		}

		function sportsArrays($conn) {  /* school sports array */

				global $sportsTB, $foreal;

				$sportArray = $conn->query("SELECT sport_id AS id, sport As name

										FROM  $sportsTB")->fetchAll(PDO::FETCH_ASSOC);
										
				array_unshift($sportArray,"");
				unset($sportArray[0]);

				return  $sportArray;
				
		}
		
		function sportsToken($conn) {  /* school sports token array */

				global $sportsTB, $foreal, $i_false, $title_list;				
				
				$ebele_mark = "SELECT sport_id, sport 
				
								FROM $sportsTB";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {

					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	
						
	        			$sID = $row['sport_id'];
						$sport = $row['sport'];
        				
						$sport = trim($sport);						
						$sportArr .= "{ value: '$sID', label: '$sport' },";
						
					}
					
					$sportArr = trim($sportArr, ', ');
					
				}
				
				return $sportArr;				
				
		} 

		function wizGradeSubjectsArrays($conn) {  /* school subjects array */

				global $subjectsTB, $foreal;

				$subjectsArray = $conn->query("SELECT sub_id, subjects, status

										FROM  $subjectsTB")->fetchAll(PDO::FETCH_ASSOC);
										
				array_unshift($subjectsArray,"");
				unset($subjectsArray[0]);

				return  $subjectsArray;
		}

		function schoolSubject($conn, $subID) {  /* school subjects information */

            	global $subjectsTB, $foreal;
			
  				$ebele_mark = "SELECT subjects					

                     			FROM $subjectsTB

                    		 	WHERE sub_id = :sub_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':sub_id', $subID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
        				$subject = $row['subjects']; 
        			
					}
					
            	}else{ 
					
					$subject = '';
					
				} 
				
				return $subject; 
            
		}

		function subjectTeacherArrays($conn, $tID) {  /* school staff subjects array */

				global $teachersAssignSubTB, $foreal;
			
				$subjectsArray = $conn->query("SELECT t_id, sub_id, session, level, class

										FROM  $teachersAssignSubTB
										
										WHERE t_id = $tID
										
										ORDER BY session, level")->fetchAll(PDO::FETCH_ASSOC);
										
				array_unshift($subjectsArray,"");
				unset($subjectsArray[0]);

				return  $subjectsArray;
		}		

		function checkSubjectToPass($conn, $wizGradeConfigTB, $schoolID, $level, $term, $subRCode) {  /* retrieve school compulsory subjects to pass */

				global $foreal;
				
				$ebele_mark = "SELECT sub_mpass

						 FROM $wizGradeConfigTB 

						 WHERE  cf_level = :cf_level
																
						 AND cf_term = :cf_term
																
						 AND cf_program = :cf_program
						 
						 AND cf_raw = :cf_raw";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':cf_level', $level);
				$igweze_prep->bindValue(':cf_term', $term);
				$igweze_prep->bindValue(':cf_program', $schoolID);
				$igweze_prep->bindValue(':cf_raw', $subRCode);				 
 				$igweze_prep->execute();	
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$subMpass = $row['sub_mpass'];
						
					}	
				
				}else{
			
					$subMpass  = "";
			
				}
			
				return  $subMpass;
		}

		function wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $level, $term) { /* school subjects array */

				$schoolSubjs = $conn->query("SELECT cf_raw, cf_code, cf_tittle, cf_tot, cf_pos, cf_com, cf_level, cf_term, cf_status

												FROM $wizGradeConfigTB
												
												WHERE  cf_level = $level
												
												AND cf_term = $term
												
												AND cf_program = $schoolID")->fetchAll(PDO::FETCH_NUM);
												
				array_unshift($schoolSubjs,"");
				unset($schoolSubjs[0]);

				return  $schoolSubjs;
			
		}

		function schoolCoursesInfo($conn, $schoolID, $level, $term) {  /* school subjects information */

				global $wizGradeConfigTB;

				$schoolSubjs = $conn->query("SELECT cf_id, cf_raw, cf_code, cf_tittle, cf_tot, cf_pos, cf_com, cf_level, cf_term, cf_status

												FROM $wizGradeConfigTB
												
												WHERE  cf_level = $level
												
												AND cf_term = $term
												
												AND cf_program = $schoolID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($schoolSubjs,"");
				unset($schoolSubjs[0]);

				return  $schoolSubjs;
			
		} 

		function doSubjectExists($conn, $schoolID, $level, $term, $rawCC, $rawCT, $rawCP) {  /* check if school subjects exits */
			    
            	global $wizGradeConfigTB, $foreal, $i_false, $fiVal, $seVal, $thVal;	 
					
				$ebele_mark = "SELECT cf_id					

								FROM $wizGradeConfigTB

								WHERE cf_level = :cf_level
								
								AND cf_raw = :cf_raw
								
								AND cf_tot = :cf_tot
								
								AND cf_pos = :cf_pos
								
								AND cf_term = :cf_term
								
								AND cf_program = :cf_program";
					 
				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':cf_level', $level);
				$igweze_prep->bindValue(':cf_raw', $rawCC);
				$igweze_prep->bindValue(':cf_tot', $rawCT);
				$igweze_prep->bindValue(':cf_pos', $rawCP);
				$igweze_prep->bindValue(':cf_term', $term);
				$igweze_prep->bindValue(':cf_program', $schoolID);				
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
				
					$status = $fiVal;
					
            	}else{ 
					
					$status = $i_false;
					
				} 
				
				return $status; 
            
		} 
		
		function wizGradeHostelData($conn) {  /* school hostel array  */

				global $hostelTB;

				$hostelData = $conn->query("SELECT h_id, hostel, h_limit, h_desc, h_master

												FROM $hostelTB")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($hostelData,"");
				unset($hostelData[0]);

				return  $hostelData;
				
		}

		function wizGradeHostelInfo($conn, $hID) {  /* school hostel information  */

				global $hostelTB;

				$hostelData = $conn->query("SELECT h_id, hostel, h_limit, h_desc, h_master

												FROM $hostelTB
												
												WHERE  h_id = $hID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($hostelData,"");
				unset($hostelData[0]);

				return  $hostelData;

		}

		function wizGradeRouteData($conn) {  /* school route array */

				global $routeTB;

				$routeData = $conn->query("SELECT r_id, route, r_amout, r_desc, r_master

												FROM $routeTB")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($routeData,"");
				unset($routeData[0]);

				return  $routeData;
				
		}

		function wizGradeRouteInfo($conn, $rID) {  /* school route information */

				global $routeTB;

				$routeData = $conn->query("SELECT r_id, route, r_amout, r_desc, r_master

												FROM $routeTB
												
												WHERE  r_id = $rID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($routeData,"");
				unset($routeData[0]);

				return  $routeData;

		} 
		
		function bursaryConfigsArrays($conn) {  /* school bursary configuration  */

				global $bursaryConfigTB;

				$burConfigsArray = $conn->query("SELECT b_id, currency, bank

										FROM  $bursaryConfigTB")->fetchAll(PDO::FETCH_ASSOC);

				return  $burConfigsArray;
				
		}
		
		function feeCategoryData($conn) {  /* school fee category array */

				global $feeCategoryTB, $fiVal;

				$feeCategoryData = $conn->query("SELECT f_id, fee, amount, status

												FROM $feeCategoryTB")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($feeCategoryData,"");
				unset($feeCategoryData[0]);

				return  $feeCategoryData;
				
		}
 
		function feeCategoryInfo($conn, $fID) {  /* school fee category information */

				global $feeCategoryTB;

				if($fID == ""){ exit; }

				$feeCategoryData = $conn->query("SELECT f_id, fee, amount, status

												FROM $feeCategoryTB
												
												WHERE  f_id = $fID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($feeCategoryData,"");
				unset($feeCategoryData[0]);

				return  $feeCategoryData;
				
		}	

		function expenseCategoryData($conn) {  /* school expenses category array */

				global $expenseCategoryTB, $fiVal;

				$expenseCategoryData = $conn->query("SELECT e_id, expense, status

												FROM $expenseCategoryTB")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($expenseCategoryData,"");
				unset($expenseCategoryData[0]);

				return  $expenseCategoryData;
				
		}

		function expenseCategoryInfo($conn, $eID) {  /* school expenses category information */

				global $expenseCategoryTB;

				if($eID == ""){ exit; }

				$expenseCategoryData = $conn->query("SELECT e_id, expense, status

												FROM $expenseCategoryTB
												
												WHERE  e_id = $eID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($expenseCategoryData,"");
				unset($expenseCategoryData[0]);

				return  $expenseCategoryData;
				
		}	 

		function feesData($conn) {  /* school fee array */

				global $wizGradeFeesTB, $fiVal;

				$feesData = $conn->query("SELECT fID, feeCat, feeAmount, session, reg_id, regNo, stype, level, class, term, method, 
										f_details, amount, balance, date, f_status

												FROM $wizGradeFeesTB")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($feesData,"");
				unset($feesData[0]);

				return  $feesData;
				
		}

		function feesInfo($conn, $fID) {  /* school fee array information */

				global $wizGradeFeesTB;

				$feesData = $conn->query("SELECT fID, feeCat, feeAmount, session, reg_id, regNo, stype, level, class, term, method, 
										f_details, amount, balance, date, f_status

												FROM $wizGradeFeesTB
												
												WHERE  fID = $fID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($feesData,"");
				unset($feesData[0]);

				return  $feesData;
				
		}
		
		function studentFeesInfo($conn, $regID, $regNo, $sType) {  /* student school fees array information */

				global $wizGradeFeesTB;

				$feesData = $conn->query("SELECT fID, feeCat, feeAmount, session, reg_id, regNo, stype, level, class, term, method, 
										f_details, amount, balance, date, f_status

												FROM $wizGradeFeesTB
												
												WHERE  reg_id = $regID
												
												AND regNo = '$regNo'
												
												AND stype = $sType")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($feesData,"");
				unset($feesData[0]);

				return  $feesData;
				
		}
		
		function feesDataRange($conn, $startDate, $endDate) {  /* school fee range array */

				global $wizGradeFeesTB, $foreal, $i_false;		
						
				$ebele_mark = "SELECT fID, feeCat, feeAmount, session, reg_id, regNo, stype, level, class, term, method, 
								f_details, amount, balance, date, f_status
						
								FROM $wizGradeFeesTB 
				
								WHERE (date BETWEEN :start_date AND :end_date)";

			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue('start_date',  $startDate, PDO::PARAM_STR);
				$igweze_prep->bindValue('end_date',  $endDate, PDO::PARAM_STR);
 				$igweze_prep->execute();

				$rows_count = $igweze_prep->rowCount();

				if($rows_count >= $foreal) {

					while($feesDataArr[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }
					
					array_unshift($feesDataArr,"");
	   				unset($feesDataArr[0]);
				
				}else{

					$feesDataArr = '';

				}

					return $feesDataArr;
					
		}
		
		function expensesData($conn) {  /* school expenses array */

				global $wizGradeExpenseTB, $fiVal;

				$expensesData = $conn->query("SELECT eID, expenseCat, eAmount, expTitle, method, expDetails, date

												FROM $wizGradeExpenseTB")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($expensesData,"");
				unset($expensesData[0]);

				return  $expensesData;
				
		}

		function expensesInfo($conn, $eID) {  /* school expenses information */

				global $wizGradeExpenseTB;

				$expensesData = $conn->query("SELECT eID, expenseCat, eAmount, expTitle, method, expDetails, date

												FROM $wizGradeExpenseTB
												
												WHERE  eID = $eID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($expensesData,"");
				unset($expensesData[0]);

				return  $expensesData;
				
		}
		
		function expensesDataRange($conn, $startDate, $endDate) {  /* school expenses range array */

				global $wizGradeExpenseTB, $foreal, $i_false;		
						
				$ebele_mark = "SELECT eID, expenseCat, eAmount, expTitle, method, expDetails, date
						
								from $wizGradeExpenseTB 
				
								WHERE (date BETWEEN :start_date AND :end_date)";

			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue('start_date',  $startDate, PDO::PARAM_STR);
				$igweze_prep->bindValue('end_date',  $endDate, PDO::PARAM_STR);
 				$igweze_prep->execute();

				$rows_count = $igweze_prep->rowCount();

				if($rows_count >= $foreal) {

					while($expensesDataArr[] = $igweze_prep->fetch(PDO::FETCH_ASSOC)) { }
					
					array_unshift($expensesDataArr,"");
	   				unset($expensesDataArr[0]);
				
				}else{

					$expensesDataArr = '';

				}

				return $expensesDataArr;
					
		}

		function expensesChartData($conn, $startDate, $endDate) {  /* school expenses chart information */

				global $wizGradeExpenseTB, $foreal, $i_false;		
								
				$ebele_mark = "SELECT eAmount from $wizGradeExpenseTB 
				
								WHERE date BETWEEN :start_date AND :end_date";

			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue('start_date',  $startDate);
				$igweze_prep->bindValue('end_date',  $endDate);
 				$igweze_prep->execute();

				$rows_count = $igweze_prep->rowCount();

				if($rows_count >= $foreal) {

					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

						$eAmount += preg_replace("/[^0-9.]/", "", $row['eAmount']);

					}
				
				}else{

					$eAmount = $i_false;

				}

					return $eAmount;


		}
		
		function feesIncomeChartData($conn, $startDate, $endDate) { /* school fees chart information */

				global $wizGradeFeesTB, $foreal, $i_false;		
								
				$ebele_mark = "SELECT feeAmount from $wizGradeFeesTB 
				
								WHERE date BETWEEN :start_date AND :end_date";

			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue('start_date',  $startDate);
				$igweze_prep->bindValue('end_date',  $endDate);
 				$igweze_prep->execute();

				$rows_count = $igweze_prep->rowCount();

				if($rows_count >= $foreal) {

					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

						$eAmount += preg_replace("/[^0-9.]/", "", $row['feeAmount']);

					}
				
				}else{

					$eAmount = $i_false;

				}
				
				return $eAmount;
		} 
		
		function productCategoryData($conn) {   /* school products category array */

				global $productCategoryTB, $fiVal;

				$productCategoryData = $conn->query("SELECT p_id, product, status

												FROM $productCategoryTB")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($productCategoryData,"");
				unset($productCategoryData[0]);

				return  $productCategoryData;
				
		}

		function productCategoryInfo($conn, $pID) {  /* school products category information */

				global $productCategoryTB;

				$productCategoryData = $conn->query("SELECT p_id, product, status

												FROM $productCategoryTB
												
												WHERE  p_id = $pID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($productCategoryData,"");
				unset($productCategoryData[0]);

				return  $productCategoryData;
				
		}		 

		function productsData($conn) {  /* select products array */

				global $wizGradeProductTB, $fiVal;

				$productsData = $conn->query("SELECT pID, cat_id, p_price, p_title, p_description, p_date, p_status

												FROM $wizGradeProductTB")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($productsData,"");
				unset($productsData[0]);

				return  $productsData;
				
		}

		function productsInfo($conn, $pID) {  /* select products information*/

				global $wizGradeProductTB;

				$productsData = $conn->query("SELECT pID, cat_id, p_price, p_title, p_description, p_date, p_status

												FROM $wizGradeProductTB
												
												WHERE  pID = $pID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($productsData,"");
				unset($productsData[0]);

				return  $productsData;

		}		 
		
		function productInfo($conn, $productID) {  /* school products information*/

       		global $wizGradeProductTB, $foreal, $fake;

				$ebele_mark = "SELECT pID, p_title, p_date, p_price, p_description
				
									FROM $wizGradeProductTB
									
									WHERE pID = :pID"; 
 			
			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':pID', $productID);
 				$igweze_prep->execute();
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
					
						$p_id = $row['pID'];
						$p_title = $row['p_title'];
						$p_date = $row['p_date'];
						$p_price = $row['p_price'];
						$p_description = $row['p_description'];
					}   


					$productInfo = $p_id.'@(.$*S*$.)@'.$p_title.'@(.$*S*$.)@'.$p_date.'@(.$*S*$.)@'.$p_price.'@(.$*S*$.)@'.$p_description;

				}else{ 

					$productInfo = $fake; 

				}

				return $productInfo; 

		}
		
		function productCategory($conn, $cID) {  /* school products category information*/

				global $wizGradeProductTB;

				$productsData = $conn->query("SELECT pID, cat_id, p_price, p_title, p_description, p_date, p_status

												FROM $wizGradeProductTB
												
												WHERE  cat_ID = $cID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($productsData,"");
				unset($productsData[0]);

				return  $productsData;
				
		}

		function productPictureArr($conn, $pID) {  /* school products pictures */

				global $wizGradeProductPicTB;

				$pictureArr = $conn->query("SELECT pic_id, picture

												FROM $wizGradeProductPicTB
												
												WHERE  p_id = $pID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($pictureArr,"");
				unset($pictureArr[0]);

				return  $pictureArr;
				
		}
		
		function transactionTotal($conn, $transID){  /* school total transaction information*/
			
				global $wizGradeOrderSummTB, $fiVal;
			
				$ebele_mark = "SELECT  qty, price
				
								FROM $wizGradeOrderSummTB 
								
								WHERE order_id  = :order_id";
					 
				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':order_id', $transID);							 
				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $fiVal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
											
							$qty = $row['qty'];
							$price = $row['price'];										

							$subtotal = ($price * $qty);
							$transTotal = ($transTotal + $subtotal);
					}
					
					$transTotal = number_format($transTotal, 2);
					
				}else{
					
					$transTotal = "-";
					
				}

				return $transTotal;			
			
		}	 
						 
		function clientOrdersChartData($conn, $startDate, $endDate) {  /* client order chart information*/

				global $wizGradeOrderTB, $wizGradeOrderSummTB, $foreal, $i_false;						
				
				$ebele_mark = "SELECT o.order_id, s.price 
				
								from  $wizGradeOrderTB o INNER JOIN $wizGradeOrderSummTB s
					
								WHERE o.orderDate 
								
								BETWEEN :start_date AND :end_date								
								
								AND o.order_id = s.order_id";

			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue('start_date',  $startDate);
				$igweze_prep->bindValue('end_date',  $endDate);
 				$igweze_prep->execute();

				$rows_count = $igweze_prep->rowCount();

				if($rows_count >= $foreal) {

					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {

						$eAmount += preg_replace("/[^0-9.]/", "", $row['price']);

					}
				
				}else{

					$eAmount = $i_false;

				}

					return $eAmount;


		} 

		function wizGradeCurrency($money, $curSymbol){  /* school currency information*/
							
			
			$rMoney = round($money, 2);
			
			$nMoney = number_format($rMoney,2,'.','');
			
			return $curSymbol.$nMoney;

		
		} 
		
		function studentOptions($conn, $sessionID, $type){  /* student dropdown select option field */
			
				global $i_student_tb, $i_reg_tb, $foreal, $fiVal, $seVal, $wizGradeDefaultPic, $schoolPicDir;
		
					$nk_class = studentClassLevel($level);
					
				if($type == $fiVal){
						
					$ebele_mark = "SELECT r.ireg_id, nk_regno, $nk_class, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname
					
									FROM $i_reg_tb r INNER JOIN $i_student_tb s
					
									ON (r.ireg_id = s.ireg_id)

									AND r.session_id = :session_id 
							 
									AND r.$nk_class = :class

									AND r.active = :foreal";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
					$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
					$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);		
					
				}else{
					
					$ebele_mark = "SELECT r.ireg_id, nk_regno, $nk_class, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname
					
									FROM $i_reg_tb r INNER JOIN $i_student_tb s
					
									ON (r.ireg_id = s.ireg_id)

									AND r.session_id = :session_id 

									AND r.active = :foreal";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
					$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);	
					
				}		
				
 				$igweze_prep->execute();
				
				echo $rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
					
						$session_fi = wizGradeSession($conn, $sessionID); 
						$session_se = $session_fi + $foreal;
			
				
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
        					$regNum = $row['nk_regno'];
        					$regID = $row['ireg_id'];
        					$fname = $row['i_firstname'];
        					$lname = $row['i_lastname'];
        					$mname = $row['i_midname'];
							$class = $row[$nk_class];
							$i_stupic = $row['i_stupic'];
							
							
							$studentData = $regID.'@::@'.$regNum.'@::@'.$sessionID.'@::@'.$class;
							
							$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$i_stupic;
							
							if ((is_null($i_stupic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }
							
							//<option value="$studentData" data-class="avatar" data-style="background-image: url("$studentPic");">
							//$lname $fname $mname - $regNum </option>
							
							

$showOptions =<<<IGWEZE
							
							<option value="$studentData"> $lname $fname $mname - $regNum </option>
		
IGWEZE;
							echo $showOptions;
				
						}
				
				}else{
					
$showOptions =<<<IGWEZE
							
							<option value=""> Ooooooops Error, No record was found</option>
		
IGWEZE;
							echo $showOptions;					
					
					
				} 
				
		}		
 
		function broadcastData($conn) {  /* school annoucement/broadcast array */

				global $wizGradeBroadcastTB, $fiVal;

				$broadcastData = $conn->query("SELECT bID, bTitle, broadcastMsg, date

												FROM $wizGradeBroadcastTB
												
												ORDER BY bID DESC")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($broadcastData,"");
				unset($broadcastData[0]);

				return  $broadcastData;
			
		}

		function broadcastInfo($conn, $bID) {  /* school annoucement/broadcast information */

				global $wizGradeBroadcastTB;

				$broadcastData = $conn->query("SELECT bID, bTitle, broadcastMsg, date

												FROM $wizGradeBroadcastTB
												
												WHERE  bID = $bID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($broadcastData,"");
				unset($broadcastData[0]);

				return  $broadcastData;
			
		}    

		function gradeData($conn) {  /* school grade array */

				global $wizGradeGradeTB, $fiVal;

				$gradeData = $conn->query("SELECT gID, fromGrade, toGrade, grade

												FROM $wizGradeGradeTB
												
												ORDER BY gID DESC")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($gradeData,"");
				unset($gradeData[0]);

				return  $gradeData;
			
		}
		
		function gradeDataArr($conn) {  /* school grade array */

				global $wizGradeGradeTB, $fiVal;

				$gradeDataArr = gradeData($conn);  /* school grade array */ 
				$gradeDataCount = count($gradeDataArr);

				for($i = $fiVal; $i <= $gradeDataCount; $i++){  /* loop array */	
						
						$gID = $gradeDataArr[$i]["gID"]; 
						$fromGrade = $gradeDataArr[$i]["fromGrade"];
						$toGrade = $gradeDataArr[$i]["toGrade"]; 
						$grade = $gradeDataArr[$i]["grade"]; 
						
						$gradeArray[$grade] = range($fromGrade, $toGrade); 						
				}

				return $gradeArray;	 
			
		}
		
		function wizGradeGradeScore ($gradeArray, $score){ /* student grades score */
			$score = round($score);
			foreach($gradeArray as $k => $v){ 
				if(in_array($score, $v)){ 
					$grade = $k; 
					return $grade;
				} 
			} 			
		
		}

		function gradeInfo($conn, $gID) {  /* school grade information */

				global $wizGradeGradeTB;

				$gradeData = $conn->query("SELECT gID, fromGrade, toGrade, grade

												FROM $wizGradeGradeTB
												
												WHERE  gID = $gID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($gradeData,"");
				unset($gradeData[0]);

				return  $gradeData;
			
		}   				
		
		function studentName($conn, $stu_reg) {  /* students name information  */ 

				global $i_reg_tb, $foreal, $i_student_tb;

				$ebele_mark = "SELECT r.ireg_id, s.i_firstname, i_lastname, i_midname

							 FROM $i_reg_tb r, $i_student_tb s

							 WHERE nk_regno = :nk_regno
							 
							 AND r.ireg_id = s.ireg_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$finame = $row['i_firstname'];
						$laname = $row['i_lastname'];
						$miname = $row['i_midname'];
			   		   
						$finame = stripslashes($finame);
						$laname = stripslashes($laname);
						$miname  = stripslashes($miname);

                    }
					
					$name_full = "$laname $finame $miname";
               		$name_full = ucwords($name_full); 
					
					if  ( (is_null($finame)) AND (is_null($laname)) ){ $name_full = "-"; } 
				
				}else{
			
					   $name_full = "-"; 
			
				}
				
               return $name_full;

		}

		function studentBioData($conn, $stu_reg) {  /* students record information  */ 

				global $i_reg_tb, $foreal, $i_student_tb;

				$ebele_mark = "SELECT r.ireg_id, s.i_firstname, i_lastname, i_midname, i_gender, i_dob, i_state, i_mar_status 

							 FROM $i_reg_tb r, $i_student_tb s

							 WHERE nk_regno = :nk_regno
							 
							 AND r.ireg_id = s.ireg_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
		
						$finame = $row['i_firstname'];
						$laname = $row['i_lastname'];
						$miname = $row['i_midname'];
						$i_gender = $row['i_gender'];
						$i_dob = $row['i_dob'];
						$i_state= $row['i_state'];
						$mar_status = $row['i_mar_status'];

						$name_full = "$laname $finame $miname";
						$name_full = ucwords($name_full);
						$i_gender = substr($i_gender, 0, 1);
						$mar_status = substr($mar_status, 0, 1);
					   
					   						
					}	
					
					if  ( (is_null($finame)) AND (is_null($laname)) ){ $name_full = "-"; }			   
					
					if  (is_null($i_gender)){ $i_gender = "-"; }
	   
					if  (is_null($i_dob)){ $i_dob = "-"; }
	   
					if  (is_null($i_state)){ $i_state = "-"; }
					
					if  (is_null($mar_status)){ $mar_status = "-"; } 
	   
					$bio_data = "$name_full##$i_gender##$i_dob##$i_state##$mar_status"; 
				
				}else{
			
					$name_full = "-"; $i_jambno = "-"; $i_gender = "-";  $i_dob = "-"; $i_state = "-"; $mar_status = "-";
					$bio_data = "$name_full##$i_gender##$i_dob##$i_state##$mar_status";
			
				} 
			   
				return $bio_data;

		}
		
		function billingData($conn, $stu_reg) {  /* students billing information  */ 

				global $i_reg_tb, $foreal, $i_student_tb;

				$ebele_mark = "SELECT r.ireg_id, s.i_firstname, i_lastname, i_midname, i_add_fi, i_city, i_state, i_country, i_spo_phone 

							 FROM $i_reg_tb r, $i_student_tb s

							 WHERE nk_regno = :nk_regno
							 
							 AND r.ireg_id = s.ireg_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
    		           $finame = $row['i_firstname'];
	        	       $laname = $row['i_lastname'];
               		   $miname = $row['i_midname'];
			   		   $i_add_fi = $row['i_add_fi'];
               		   $i_city = $row['i_city'];
			   		   $i_state = $row['i_state'];
					   $country = $row['i_country'];
					   $phone = $row['i_spo_phone'];			   		   					   
					   						
					}	
					
					$name_full = "$laname $finame $miname";
					$name_full = ucwords($name_full);
			
					if  ( (is_null($finame)) && (is_null($laname)) ){ $name_full = "-"; }			   
					
					if  (is_null($i_add_fi)){ $i_add_fi = "-"; }
	   
					if  (is_null($i_city)){ $i_city = "-"; }
	   
					if  (is_null($i_state)){ $i_state = "-"; }
					
					if  (is_null($country)){ $country = "-"; }
					
					if  (is_null($phone)){ $phone = "-"; } 
	   
					$billingData = "$name_full##$i_add_fi##$i_city##$i_state##$country##$phone"; 
				
				}else{
			
					$name_full = "-"; $ $i_add_fi = "-";  $i_city = "-"; $i_state = "-"; $country = "-"; $phone = "-";
					$billingData = "$name_full##$i_add_fi##$i_city##$i_state##$country##$phone";
			
				}
			   
				return $billingData;

		}
		
		function studentToken($conn) {  /* students token record information  */ 

				global $i_reg_tb, $foreal, $i_student_tb;			

				$ebele_mark = "SELECT r.nk_regno,  s.i_firstname, i_lastname, i_midname
				
								FROM $i_reg_tb r INNER JOIN $i_student_tb s
				
								ON (r.ireg_id = s.ireg_id)

				          		AND r.active = :foreal";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) { 
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
        				$regNum = $row['nk_regno'];
        				$fname = $row['i_firstname'];
        				$lname = $row['i_lastname'];
        				$mname = $row['i_midname']; 
						
						$stuName = "$lname $fname $mname - $regNum";	
						//$stuName =   preg_replace("/[^A-Za-z0-9-.// ]/", "", $stuName);	
						$stuName = trim($stuName);						
						$studentArr .= "{ value: '$stuName', label: '$stuName' },";
	   					
					}
					
					$studentArr = trim($studentArr, ', ');
				} 
				
				return $studentArr;
		}		

		function studentSMSInfo($conn, $stu_reg) {  /* students SMS record information  */ 

				global $i_reg_tb, $foreal, $i_student_tb, $schoolPicDir, $wizGradeDefaultPic;
				
				$sess_id = studentRegSessionID($conn, $stu_reg);
				$session_fi = wizGradeSession($conn, $sess_id); 
				$session_se = $session_fi + $foreal;

				$ebele_mark = "SELECT r.ireg_id, s.i_firstname, i_lastname, i_midname, i_stu_phone, i_spo_phone, i_stupic

							 FROM $i_reg_tb r, $i_student_tb s

							 WHERE nk_regno = :nk_regno
							 
							 AND r.ireg_id = s.ireg_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	 
	   
    		           $finame = $row['i_firstname'];
	        	       $laname = $row['i_lastname'];
               		   $miname = $row['i_midname'];
					   $pic = $row['i_stupic'];
					   $stuPhone = $row['i_stu_phone'];
					   $spoPhone = $row['i_spo_phone']; 

                    }
					
					$finame = trim($finame);
					$laname = trim($laname);
					$miname  = trim($miname);
					$stuPhone = trim($stuPhone);
					$spoPhone= trim($spoPhone);
									
					$name_full = "$laname $finame $miname";
					$name_full = ucwords($name_full);
					$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$pic;

					if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }
					
					$stuInfo = $name_full.'@##@'.$stuPhone.'@##@'.$spoPhone.'@##@'.$studentPic;	 
				
				}else{
			
					$stuInfo = ""; 
			
				} 
				
				return $stuInfo;

		}

		function studentPicture($conn, $stu_reg) {  /* students picture */ 

				global $i_reg_tb, $i_student_tb, $wizGradeDefaultPic, $schoolPicDir, $foreal;
				
				$sess_id = studentRegSessionID($conn, $stu_reg);
				$session_fi = wizGradeSession($conn, $sess_id); 
				$session_se = $session_fi + $foreal;

				$ebele_mark = "SELECT r.ireg_id, s.i_stupic

							 FROM $i_reg_tb r, $i_student_tb s

							 WHERE nk_regno = :nk_regno
							 
							 AND r.ireg_id = s.ireg_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
					
						$i_stupic = $row['i_stupic'];
					
					}

					$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$i_stupic;

            	}
				
            	if ((is_null($i_stupic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; } 
            
				return $studentPic;
            
		} 

		function removeStudentPicture($conn, $stu_reg, $path) {  /* remove students picture */  

				global $i_reg_tb, $i_student_tb;  global $foreal;

				$ebele_mark = "SELECT r.ireg_id, s.i_stupic

							 FROM $i_reg_tb r, $i_student_tb s

							 WHERE nk_regno = :nk_regno
							 
							 AND r.ireg_id = s.ireg_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
					
						$i_stupic = $row['i_stupic'];
					
					}
					
					if(($path != '') && ($i_stupic != '')){ 
						
						$stuPic = $path.$i_stupic;
						
						if(file_exists($stuPic)){
									   
							unlink($stuPic);		   
									   
						}
						
					
					} 
            
				}
				
		}  

		function studentParentPassword($conn, $stu_reg) {  /* students password */ 

				global $i_reg_tb, $i_student_tb, $foreal; 

				$ebele_mark = "SELECT r.ireg_id, s.i_accesspass, i_sponsor_p

							 FROM $i_reg_tb r, $i_student_tb s

							 WHERE nk_regno = :nk_regno
							 
							 AND r.ireg_id = s.ireg_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':nk_regno', $stu_reg);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
					
						$studentPass = $row['i_accesspass'];
						$parentPass = $row['i_sponsor_p'];
					
					} 
					
					$accesspass = $studentPass.'{<?..?>}'.$parentPass;

            	}else{
					
					$accesspass = "";
					
				}	
            
				return $accesspass;
            
		} 
		
		function eWalletwizGrade($conn, $cardpin) {  /* card pin e - wallet information */

				global $eWalletTB, $foreal; 
				
				$ebele_mark = "SELECT iiii_id, iiii_reg_id, iiii_reg, iiii_level, iiii_term, iiii_status

						 FROM $eWalletTB  

						 WHERE iiii_pin_iiii = :iiii_pin_iiii";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':iiii_pin_iiii', $cardpin);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$iiii_id  = $row['iiii_id'];
						$iiii_reg_id  = $row['iiii_reg_id'];
						$iiii_reg = $row['iiii_reg'];
						$iiii_level = $row['iiii_level'];
						$iiii_term = $row['iiii_term'];
						$iiii_status = $row['iiii_status'];
					}	
					
					$cardData =  $iiii_id.':@@:'.$iiii_reg_id.':@@:'.$iiii_reg.':@@:'.$iiii_level.':@@:'.$iiii_term.':@@:'.$iiii_status; 
				
				}else{
			
					$cardData = "";
			
				} 
			
				return  $cardData;
		}
 
		function eWalletCheckRecharge($conn, $regNum, $regID, $level, $term, $ewalletCheck) {  /* validate card pin e - wallet information */

				global $eWalletTB, $foreal, $fiVal, $seVal, $foVal; 
				
				if($ewalletCheck == $fiVal){
					
					$ebele_mark = "SELECT iiii_id, iiii_pin_iiii, iiii_time

									 FROM $eWalletTB  
				
									 WHERE 
									 
									 iiii_reg_id = :iiii_reg_id
									 
									 AND iiii_reg = :iiii_reg
									 
									 AND iiii_level = :iiii_level
									 
									 AND iiii_term = :iiii_term
									 
									 AND iiii_status = :iiii_status";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':iiii_reg_id', $regID);
					$igweze_prep->bindValue(':iiii_reg', $regNum);
					$igweze_prep->bindValue(':iiii_level', $level);
					$igweze_prep->bindValue(':iiii_term', $term);
					$igweze_prep->bindValue(':iiii_status', $foreal);
					
				}else{
					
					$ebele_mark = "SELECT iiii_id, iiii_pin_iiii, iiii_time

									 FROM $eWalletTB  
				
									 WHERE 
									 
									 iiii_reg_id = :iiii_reg_id
									 
									 AND iiii_reg = :iiii_reg
									 
									 AND iiii_level = :iiii_level
									 
									 AND iiii_term = :iiii_term
									 
									 AND iiii_status = :iiii_status";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':iiii_reg_id', $regID);
					$igweze_prep->bindValue(':iiii_reg', $regNum);
					$igweze_prep->bindValue(':iiii_level', $level);
					$igweze_prep->bindValue(':iiii_term', $foVal);
					$igweze_prep->bindValue(':iiii_status', $foreal);
					
				} 
				
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) { 

					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$iiii_id  = $row['iiii_id'];
						$cardPin  = $row['iiii_pin_iiii'];
						$cardRTime  = $row['iiii_time'];
					}	
					
					$cardData = $iiii_id.':@@:'.$cardPin.':@@:'.$cardRTime.':@@:'.$foreal;
					
					
				}else{
					
					$cardData = "";
			
				} 
			
				return  $cardData;
		}  

		function cardPinData($conn) {  /* school cardPin array */

				global $eWalletTB, $fiVal;

				$cardPinData = $conn->query("SELECT iiii_id, iiii_pin_iiii, iiii_serial_iiii, iiii_reg_id, iiii_reg, 
													iiii_stype, iiii_level, iiii_term, iiii_time, iiii_status

												FROM $eWalletTB
												
												ORDER BY iiii_id DESC")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($cardPinData,"");
				unset($cardPinData[0]);

				return  $cardPinData;
			
		}

		function cardPinInfo($conn, $iiii_id) {  /* school cardPin information */

				global $eWalletTB;

				$cardPinData = $conn->query("SELECT iiii_id, iiii_pin_iiii, iiii_serial_iiii, iiii_reg_id, iiii_reg, 
													iiii_stype, iiii_level, iiii_term, iiii_time, iiii_status

												FROM $eWalletTB
												
												WHERE  iiii_id = $iiii_id")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($cardPinData,"");
				unset($cardPinData[0]);

				return  $cardPinData;
			
		} 		
		
		function libraryConfigsArrays($conn) {  /* school library book array */ 

				global $wizGradeSchLibConfig;
			
				$libConfigsArray = $conn->query("SELECT c_id, book_no_apply, book_no_borrow, book_dateline
				
												FROM  $wizGradeSchLibConfig")->fetchAll(PDO::FETCH_ASSOC);
			
				return  $libConfigsArray;
				
		} 

		function libraryBookInfo($conn, $bookID) {  /* school library book information */ 

				global $wizGradeSchLib, $foreal, $i_false; 
		   
				$ebele_mark = "SELECT book_id, book_name, book_author, book_path, book_type, book_status, stype, sclass, book_hits, book_copies,
								book_location
				

							 FROM $wizGradeSchLib

							 WHERE book_id = :book_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':book_id', $bookID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
	   					$book_id = $row['book_id'];
						$book_name = $row['book_name'];
						$book_path = $row['book_path'];
						$book_author = $row['book_author'];
						$book_type = $row['book_type'];
						$book_status = $row['book_status'];	
						$schoolID = $row['stype'];
						$sClassID = $row['sclass'];
						$book_hits = $row['book_hits'];
						$book_copies = $row['book_copies'];
						$book_location = $row['book_location']; 
						
					}
					
					$bookInfo = $book_id.'@.%.@'.$book_name.'@.%.@'.$book_path.'@.%.@'.$book_author.'@.%.@'.$book_type.'@.%.@'.$book_status
					.'@.%.@'.$schoolID.'@.%.@'.$sClassID.'@.%.@'.$book_hits.'@.%.@'.$book_copies.'@.%.@'.$book_location;
					
				}else{
					
					$bookInfo = '';				
				
				}
				
				return $bookInfo;	
				
		 }

		function libraryBookTypeTotal($conn, $bookType) {  /* school library book type summary */ 

				global $wizGradeSchLib, $foreal, $i_false; 
		   
				$ebele_mark = "SELECT book_id, book_name, book_author, book_path, book_type, book_status

							 FROM $wizGradeSchLib

							 WHERE book_type = :book_type";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':book_type', $bookType);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
								
				return $rows_count;	

		}

		function libraryBookAppStatus($conn, $bookID, $regID, $schoolID) {  /* school library book application status */ 

				global $wizGradeLibApplyTB, $foreal, $i_false; 
		   
				$ebele_mark = "SELECT b_status, apply_date, approve_date, return_date

							 FROM $wizGradeLibApplyTB

							 WHERE book_id = :book_id
							 
									AND lib_user = :lib_user
									
									AND stype = :stype";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':book_id', $bookID);
				$igweze_prep->bindValue(':lib_user', $regID);
				$igweze_prep->bindValue(':stype', $schoolID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {
					
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$bookStatus = $row['b_status'];	
						$applyDate = $row['apply_date'];	
						$approveDate = $row['approve_date'];	
						$returnDate = $row['return_date'];	
						
					}
					
					$bookInfo = $bookStatus.'@.%.@'.$applyDate.'@.%.@'.$approveDate.'@.%.@'.$returnDate;
					
					
				}else{ 
					
					$bookInfo = '';
				
				} 
				
				return $bookInfo;	 

		}

		function libraryBookApplicationLimit($conn, $regID, $schoolID) {  /* check if student has exceeded book application limit */

				global $wizGradeLibApplyTB, $foreal, $i_false, $infoMsg, $msgEnd; 		
				
				$libConfigsArray = libraryConfigsArrays($conn);
					
				$applyNum = $libConfigsArray[0]['book_no_apply'];
		   
					$ebele_mark = "SELECT book_id

									FROM $wizGradeLibApplyTB
							 
									WHERE lib_user = :lib_user
									
									AND stype = :stype";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':lib_user', $regID);
				$igweze_prep->bindValue(':stype', $schoolID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $applyNum) {
											
						$msg_i = "Oooooooops, you have exceeded the School Library Book application limit of  
						<strong>$applyNum</strong>. Meanwhile, you are not allowed apply for more books for now. Thanks";	
						
						echo $infoMsg.$msg_i.$iEnd;	 
						echo  "<script type='text/javascript'> $('html, body').animate({scrollTop:$('#scrollLTarget').position().top}, 'slow'); hidePageLoader();  /* hide page loader */ </script>";
						exit;
					
				}

		}

		function libraryBookLendingLimit($conn, $regID, $schoolID) {  /* check if student has exceeded book application limit */

				global $wizGradeLibApplyTB, $foreal, $fiVal,$infoMsg, $msgEnd;		
				
				$libConfigsArray = libraryConfigsArrays($conn);
					
				$borrowNum = $libConfigsArray[0]['book_no_borrow'];

					$ebele_mark = "SELECT book_id

									FROM $wizGradeLibApplyTB
							 
									WHERE lib_user = :lib_user
									
									AND stype = :stype
									
									AND b_status = :b_status";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':lib_user', $regID);
				$igweze_prep->bindValue(':stype', $schoolID);
				$igweze_prep->bindValue(':b_status', $seVal);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $borrowNum) {
				
						$msg_i = "Oooooooops, this student have exceeded School Library Book lending limit of  
						<strong>$applyNum</strong> in his/her possesion. Meanwhile, He/She is not allowed to borrow more books at the
						moment. Thanks";						  					
						echo $infoMsg.$msg_i.$iEnd;	 exit;
					
				}


		}


        function libraryUploadsManager($conn, $type, $picture) {  /* school library book upload manager */

         		global $fiVal, $seVal, $defualtLIBPic, $wizGradeLibDir, $validDocFormats;
				
				if(($type == $fiVal) && ($picture != '')){				
					
					list($pic, $picExt) = explode(".", $picture);
					
					if($picExt == ''){
						
						$bookPicture = $defualtLIBPic;
						
					}else{
						
						if(($picExt == 'doc') || ($picExt == 'docx')){
							
							$bookPicture = $wizGradeLibDir.'icon-word.png';
							
						}elseif(($picExt == 'xls') || ($picExt == 'xlsx')){
							
							$bookPicture = $wizGradeLibDir.'icon-excel.ico';
						
						}elseif($picExt == 'pdf'){
							
							$bookPicture = $wizGradeLibDir.'icon-pdf.png';
						
						}elseif($picExt == 'txt'){
							
							$bookPicture = $wizGradeLibDir.'icon-text.png';
						
						}else{
							
							$bookPicture = $defualtLIBPic;
						
						} 
						
					}
					
				
				}elseif(($type == $seVal) && ($picture != '')){
					
					list($pic, $picExt) = explode(".", $picture);
					
					if(in_array($picExt, $validDocFormats)) {
						
						$bookPicture = $defualtLIBPic;
						
					}else{
						
						$bookPicture = $wizGradeLibDir.$picture;
						
						if ((is_null($picture)) || ($picture == '') || (!file_exists($bookPicture))) {
							
							$bookPicture = $defualtLIBPic;
									 
						}
					}
					
				}else{					
					
					$bookPicture = $defualtLIBPic;
					
				} 
				
				return $bookPicture;
		}

		function libraryBookExceededLimitChecker($conn, $regID, $schoolID) {  /* check if student has any expired library book in possession */

				global $wizGradeLibApplyTB, $libDefaultTime, $foreal, $i_false, $seVal, $infoMsg, $iEnd; 

$table_head =<<<IGWEZE

				<table width = '100%' border = '0' align = 'center' class='table table-striped table-advance table-hover PaginateTB'>
				<thead>
				<tr><th style="text-align:left !important; padding-right: 15px !important; width: 3%; ">App. ID</th>
				<th style="text-align:left !important; padding-right: 15px !important; width: 21%;">Book Details</th> 
				<th style="text-align:left !important; padding-right: 15px !important; width: 12%;">Application Time</th> 
				<th style="text-align:left !important; padding-right: 15px !important; width: 12%;">Approved Time</th> 
				</thead> <tbody>
		
IGWEZE;

  				$libConfigsArray = libraryConfigsArrays($conn);
				
				$timeDateline = $libConfigsArray[0]['book_dateline'];
				
				if($timeDateline == '') {$timeDateline = $libDefaultTime;} //AND sclass = :sclass

				$ebele_mark = "SELECT b_id, book_id, lib_user, lib_reg, apply_date, approve_date, stype
				
								FROM $wizGradeLibApplyTB
								
								WHERE  approve_date	<= NOW() - INTERVAL $timeDateline
								
								AND b_status = :b_status 
													
								AND stype = :stype
								
								AND lib_user = :lib_user
								
								ORDER BY b_id DESC";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':b_status', $seVal);
				$igweze_prep->bindValue(':stype', $schoolID);
				$igweze_prep->bindValue(':lib_user', $regID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount();

				if($rows_count >= $foreal) {
					
					echo  $table_head;

					$msg_i = "Oooooooops, School Library book/s above in your possession  have exceeded the stiputaled time limit of <strong>$timeDateline</strong>S. Meanwhile, you are not allowed to borrow any other books until you return those book/s. Thanks";
						  
					echo $infoMsg.$msg_i.$iEnd;	  
					
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		

						$bookID = $row['book_id'];
						$applyID = $row['b_id'];
						$lib_user = $row['lib_user'];
						$lib_reg = $row['lib_reg'];
						$apply_date = $row['apply_date'];
						$approve_date = $row['approve_date'];
						$schoolID = $row['stype'];
						
						
						if($apply_date != ''){
							
							$apply_date = strtotime($apply_date);
							$apply_date = date("h:i:s, d F, Y", $apply_date);
							
						}else{ $apply_date = ' - '; }

						if($approve_date != ''){
							
							$approve_date = strtotime($approve_date);
							$approve_date = date("h:i:s, d F, Y", $approve_date);
							
						}else{ $approve_date = ' - '; }


						$bookInfo = libraryBookInfo($conn, $bookID);
						list ($bookLID, $bookName, $bookPath, $bookAuthor, $bookType, $bookStatusT, $schoolID, $sClassID, $bookHits, 
							  $bookCopies, $bookLocation) = explode ("@.%.@", $bookInfo);
						
						$bookName  = trim($bookName);
						$bookAuthor  = trim($bookAuthor);

						$bookPicture = libraryUploadsManager($conn, $bookType, $bookPath);
						
						if($bookAuthor == '') { $bookAuthor = 'Anonymous'; } 
						
$bookInfo =<<<IGWEZE

					<tr> 
						<td style="text-align:left !important; padding-right: 15px !important;"> App-$applyID </td>
						<td style="text-align:left !important; padding-right: 15px !important;">
						<img src = "$bookPicture" style="width: 30px; height: 30px; float:left; border-radius: 20px; padding-right: 5px"> 
						$bookName by $bookAuthor </td> 
						<td style="text-align:left !important; padding-right: 15px !important;"> $apply_date </td> 
						<td style="text-align:left !important; padding-right: 15px !important;">$approve_date</td>  
					</tr> 
		
IGWEZE;

						echo $bookInfo; 
				
					}
					
					echo  '</tbody></table><hr />';
					
					echo  "<script type='text/javascript'> $('html, body').animate({scrollTop:$('#scrollLTarget').position().top}, 'slow'); hidePageLoader();  /* hide page loader */ </script>";
					exit;
					
				} 

		}  
		
		function smsData($conn) {  /* text message and gateway array  */ 

				global $wizGradeSMSTB, $fiVal;

				$smsData = $conn->query("SELECT sID, gateway, senderID, user, password, api, status

												FROM $wizGradeSMSTB")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($smsData,"");
				unset($smsData[0]);

				return  $smsData;
		}

		function smsInfo($conn, $sID) {  /* text message and gateway information  */ 

				global $wizGradeSMSTB;

				$smsData = $conn->query("SELECT sID, gateway, senderID, user, password, api, status

												FROM $wizGradeSMSTB
												
												WHERE  sID = $sID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($smsData,"");
				unset($smsData[0]);

				return  $smsData;
		}

		function smsCurrentGateway($conn) {  /* current text message and gateway information */ 

				global $wizGradeSMSTB, $fiVal;

				$smsData = $conn->query("SELECT sID, gateway, senderID, user, password, api, status

												FROM $wizGradeSMSTB
												
												WHERE  status = $fiVal")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($smsData,"");
				unset($smsData[0]);

				return  $smsData;
		} 
		
     	function wizGradeSendSMS($api, $senderID, $user, $password, $receiver, $sentMsg, $gType) {  /* send text message through current gateway */ 
			
				$user = urlencode($user); $password = urlencode($password); $api = urlencode($api);
				$receiver = urlencode($receiver); $sentMsg = urlencode($sentMsg);
			
				if($gType == $fiVal){
					
					$sendSMS = file_get_contents('https://api.clickatell.com/http/sendmsg?api_id='.$api.'&user='.$user.'&password='.
					$password.'&to='.$receiver.'&text='.$sentMsg);
				
				}elseif($gType == $seVal){
					
					$sendSMS = file_get_contents('http://1s2u.com/sms/sendsms/sendsms.asp?username='.$user.'&password='.
					$password.'&mno='.$receiver.'&msg='.$sentMsg.'&Sid='.$senderID.'&fl=0&mt=0&ipcl=end user');
					
				}elseif($gType == $thVal){
					
					$sendSMS = file_get_contents('http://smsclone.com/index.php?option=com_spc&comm=spc_api&username='.$user.'& password='.
					$password.'&sender=@@'.$senderID.'@@&recipient=@@'.$receiver.'@@&message=@@'.$sentMsg.'@@&');
					
				}elseif($gType == $foVal){
					
					$sendSMS = file_get_contents('http://www.bulksmsnigeria.net/components/com_spc/smsapi.php?username='.$user.'&password='.
					$password.'&sender=@@'.$senderID.'@@&recipient=@@'.$receiver.'@@&message=@@'.$sentMsg.'@@&');
					
				}else{

					$sendSMS = "";
					
				}	
				
				return $sendSMS;
			
		}  
		
		function wizGradeSMSBalance($api, $user, $password, $gType) {  /* check text message balance  */ 
		
				$user = urlencode($user); $password = urlencode($password); $api = urlencode($api);
			
				if($gType == $fiVal){
					
					$smsBalance = file_get_contents('http://api.clickatell.com/http/getbalance?api_id='.$api.'&user='.$user.'&password='.$password); 
				
				}elseif($gType == $seVal){
					
					$smsBalance = file_get_contents('http://1s2u.com/sms/sendsms/checklogin.asp?user='.$user.'&pass='.$password); 
					
				}elseif($gType == $thVal){
					
					$smsBalance = file_get_contents('http://smsclone.com/index.php?option=com_spc&comm=spc_api&username='.$user.'&password='.$password.'&balance=true'); 
					
				}elseif($gType == $foVal){
					
					$smsBalance = file_get_contents('http://www.bulksmsnigeria.net/components/com_spc/smsapi.php?username='.$user.'&password='.$password.'&balance=true&'); 
					
				}else{
					
					$smsBalance = "";

				}	
				
				if($smsBalance == "") { $smsBalance = 0; }
				return $smsBalance;
			
		}  
		
		function gatewayPaymentData($conn) {  /* payment gateways array  */
			
				global $wizGradePayGatewayTB, $fiVal;

				$gatewayPaymentData = $conn->query("SELECT gID, gateway, gatewayVerb, gateKey 

												FROM $wizGradePayGatewayTB")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($gatewayPaymentData,"");
				unset($gatewayPaymentData[0]);

				return  $gatewayPaymentData;
				
		}

		function gatewayPaymentInfo($conn, $gID) {  /* payment gateways information */

				global $wizGradePayGatewayTB;

				$gatewayPaymentData = $conn->query("SELECT gID, gateway, gatewayVerb, gateKey 

												FROM $wizGradePayGatewayTB
												
												WHERE  gID = $gID")->fetchAll(PDO::FETCH_ASSOC);
												
				array_unshift($gatewayPaymentData,"");
				unset($gatewayPaymentData[0]);

				return  $gatewayPaymentData;
				
		} 	   
		
		function clientIP() {  /* user IP Address   */
    
				$ipaddress = '';
				
				if (getenv('HTTP_CLIENT_IP')) {
					
					$ipaddress = getenv('HTTP_CLIENT_IP');
					
				}elseif(getenv('HTTP_X_FORWARDED_FOR')){
					
					$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
					
				}elseif(getenv('HTTP_X_FORWARDED')){
					
					$ipaddress = getenv('HTTP_X_FORWARDED');
					
				}elseif(getenv('HTTP_FORWARDED_FOR')){
					
					$ipaddress = getenv('HTTP_FORWARDED_FOR');
					
				}elseif(getenv('HTTP_FORWARDED')){
					
					$ipaddress = getenv('HTTP_FORWARDED');
					
				}elseif(getenv('REMOTE_ADDR')){
					
					$ipaddress = getenv('REMOTE_ADDR');
					
				}else{
					
					$ipaddress = 'UNKNOWN';
					
				}	
			 
				return $ipaddress;
	
		}	  
		
		function encrypter($value, $key){  /* character encrypter */
 		
				if($value==''){return false;}
				$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
				$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
				$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $value, MCRYPT_MODE_ECB, $iv);
				return urlencode(trim(base64_encode($crypttext)));
		
		} 

		function decrypter($value, $key){   /* character decrypter */
		  
				$value=urldecode($value);
				
				if($value=="" || base64_encode(base64_decode($value))!=$value){
					
					return $value;
					
				}else{
					
					$crypttext = base64_decode($value);
					$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
					$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
					$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
					return trim($decrypttext); 
			  
				}
		} 
		
		function timerBoy($session_time) {  /* time a go functions  */

				$time_difference = time() - $session_time;
				$seconds = $time_difference ;
				$minutes = round($time_difference / 60 );
				$hours = round($time_difference / 3600 );
				$days = round($time_difference / 86400 );
				$weeks = round($time_difference / 604800 );
				$months = round($time_difference / 2419200 );
				$years = round($time_difference / 29030400 );

				if($seconds <= 60)	{	
				
					$time = "$seconds seconds ago";  

				}elseif($minutes <=60){

					if($minutes == 1) { $time = "one minute ago"; }
					else {  $time = "$minutes minutes ago";  }
					
				} elseif($hours <=24) {
					
					if($hours==1) {  $time = "one hour ago"; }
					else {  $time = "$hours hours ago";  }
					
				} elseif($days <=7) {
					
					if($days==1) { $time = "one day ago"; }
					else { $time = "$days days ago"; }
				}  elseif($weeks <=4) {
					
					if($weeks==1) {  $time = "one week + ago"; }
					else  {  $time = "$weeks weeks ago"; }
					
				} elseif($months <=12) {
					
					if($months==1) { $time = "one month + ago"; }
					else { $time = "$months months ago"; }
					
				} else {
					
					if($years==1){ $time = "one year + ago"; }
					else{$time = "$years years ago";}
				}


				return $time;

		}

	  
		function sdomsCalendar($month, $year){  /* auto generated calendar */

					/* draw table */
					$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

					/* table headings */
					$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
					$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

					/* days and weeks vars now ... */
					$running_day = date('w',mktime(0,0,0,$month,1,$year));
					$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
					$days_in_this_week = 1;
					$day_counter = 0;
					$dates_array = array();

					/* row for week one */
					$calendar.= '<tr class="calendar-row">';

					/* print "blank" days until the first of the current week */
					for($x = 0; $x < $running_day; $x++):
						$calendar.= '<td class="calendar-day-np" height="100px"> </td>';
						$days_in_this_week++;
					endfor;

					/* keep going with days.... */
					for($list_day = 1; $list_day <= $days_in_month; $list_day++): 
						if($list_day == $today && $month == $nowmonth && $year == $nowyear) { //check variable to fit in
						$calendar.= '<td class="calendar-day calendar-day-today" height="100px">fabulous GOD *';
						} else {
						$calendar.= '<td class="calendar-day" height="100px">fabulous GOD';
						}
					//for($list_day = 1; $list_day <= $days_in_month; $list_day++):
						//$calendar.= '<td class="calendar-day" height="100px">fabulous GOD';
						
							/* add in the day number */
							$calendar.= '<div class="day-number">'.$list_day.'</div>';

							/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! 
							
							$keys = array('comment', 'shout', 'submission');

				foreach ($keys as $key) {
					${$key . '_events'} = 0;
					foreach (${$key . 's'} as $event) {

					$event_datetime = strtotime($event[$key . '_datetime']);
					$event_day = date('j', $event_datetime);
					$event_month = date('F', $event_datetime);
					$event_year = date('Y', $event_datetime);

					$now_datetime = mktime(0, 0, 0, $month, $list_day, $year);
					$now_day = date('j', $now_datetime);
					$now_month = date('F', $now_datetime);
					$now_year = date('Y', $now_datetime);

					if (($event_day == $now_day) && ($event_month == $now_month) && ($event_year == $now_year)) {
						${$key . '_events'} += 1;
					}

				}
				if (${$key . '_events'} > 0) $calendar .= '<div class="calendar-event ' . $key . '">' . ${$key . '_events'} . ' ' . $key . (${$key . '_events'} > 1 ? 's' : '' ) . '</div>';
				}

							
							**/
							$calendar.= str_repeat('<p> </p>',2);
							
						$calendar.= '</td>';
						if($running_day == 6):
							$calendar.= '</tr>';
							if(($day_counter+1) != $days_in_month):
								$calendar.= '<tr class="calendar-row">';
							endif;
							$running_day = -1;
							$days_in_this_week = 0;
						endif;
						$days_in_this_week++; $running_day++; $day_counter++;
					endfor;

					/* finish the rest of the days in the week */ //if($days_in_this_week < 8 && $days_in_this_week!=1):
					if($days_in_this_week < 8):
						for($x = 1; $x <= (8 - $days_in_this_week); $x++):
							$calendar.= '<td class="calendar-day-np" height="100px"> aa</td>';
						endfor;
					endif;

					/* final row */
					$calendar.= '</tr>';

					/* end the table */
					$calendar.= '</table>';
					
					/* all done, return result */
					return $calendar;
		}

		/**
		* Helper library for CryptoJS AES encryption/decryption
		* Allow you to use AES encryption on client side and server side vice versa
		*
		* @author BrainFooLong (bfldev.com)
		* @link https://github.com/brainfoolong/cryptojs-aes-php
		*/

		/**
		* Decrypt data from a CryptoJS json encoding string
		*
		* @param mixed $passphrase
		* @param mixed $jsonString
		* @return mixed
		*/
		function cryptoJsAesDecrypt($passphrase, $jsonString){  /* character decrypter */
			$jsondata = json_decode($jsonString, true);
			try {
				$salt = hex2bin($jsondata["s"]);
				$iv  = hex2bin($jsondata["iv"]);
			} catch(Exception $e) { return null; }
			$ct = base64_decode($jsondata["ct"]);
			$concatedPassphrase = $passphrase.$salt;
			$md5 = array();
			$md5[0] = md5($concatedPassphrase, true);
			$result = $md5[0];
			for ($i = 1; $i < 3; $i++) {
				$md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);
				$result .= $md5[$i];
			}
			$key = substr($result, 0, 32);
			$data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
			return json_decode($data, true);
		}

		/**
		* Encrypt value to a cryptojs compatiable json encoding string
		*
		* @param mixed $passphrase
		* @param mixed $value
		* @return string
		*/
		function cryptoJsAesEncrypt($passphrase, $value){  /* character encrypter */
			$salt = openssl_random_pseudo_bytes(8);
			$salted = '';
			$dx = '';
			while (strlen($salted) < 48) {
				$dx = md5($dx.$passphrase.$salt, true);
				$salted .= $dx;
			}
			$key = substr($salted, 0, 32);
			$iv  = substr($salted, 32,16);
			$encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
			$data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
			return json_encode($data);
		}
		
		
		function igwezeFileUploader ($file_field = null, $path, $max_size, $validPicExt, $validPicType, $allowedFile, $fileType, $byePass) {
			/* file upload manager */
			
			global $randChars, $fiVal, $seVal;
			
			// Create an array to hold any output
			$out = array('error'=>null);

			if (!$file_field) {
			  $out['error'][] = "Ooooooooops, please upload a $fileType. Only $allowedFile is/are allowed.";           
			}

			if (!$path) {
			  $out['error'][] = "Ooooooooops, upload path is invalid";               
			}

			if (count($out['error'])>0) {
			  return $out;
			}

			//Make sure that there is a file
			if((!empty($_FILES[$file_field])) && ($_FILES[$file_field]['error'] == 0)) {

					
					$info = new finfo(FILEINFO_MIME_TYPE);
					
					$mime_type = $info->buffer(file_get_contents($_FILES[$file_field]['tmp_name']));
					$_FILES[$file_field]["type"];
					
					// Get filename 1st funtion
					$file_info = pathinfo($_FILES[$file_field]['name']);
					$name = $file_info['filename'];
					$ext = strtolower($file_info['extension']);

					//Check file has the right extension           
					if (!in_array($ext, $validPicExt)) {
					  $out['error'][] = "Invalid $fileType Extension, please upload a valid a $fileType extension. Only $allowedFile is/are allowed.";
					}

					//Check that the file is of the right type
					if ((!in_array($_FILES[$file_field]["type"], $validPicType)) || (!in_array($mime_type, $validPicType))){
					  $out['error'][] = "Invalid $fileType Type. Please upload a valid a $fileType type. Only $allowedFile is/are allowed.";
					}
					
					//Check that the file is not too big
					if ($_FILES[$file_field]["size"] > $max_size) {
					  $out['error'][] = "$fileType maximum file allowed size is $max_size MB";
					}

					//If $check image is set as true
					if($byePass == $fiVal){
						if (!getimagesize($_FILES[$file_field]['tmp_name'])) {
							$out['error'][] = "Invalid $fileType, please upload a valid a $fileType. Only $allowedFile is/are allowed.";
						}
					}

					  // Generate random filename
					$tmp = str_replace(array('.',' '), array('',''), microtime());

					if (!$tmp || $tmp == '') {
						$out['error'][] = "Invalid $fileType Name, $fileType file must have a name";
					}     
					
					$randC = wizGradeRandomString($randChars, 6);	
					
					$newname = $tmp.$randC.'.'.$ext;                                
					

					//Check if file already exists on server
					if (file_exists($path.$newname)) {
					  $out['error'][] = "A file with this name already exists";
					}

					if (count($out['error'])>0) {
					  //The file has not correctly validated
					  return $out;
					} else{
						
						 $out['refilename'] = $newname;
						return $out;
						
					}	

					

			} else {
				
				$out['error'][] = "Ooooooooops, please upload a $fileType. Only $allowedFile is/are allowed.";
				return $out;
				
			}      
			
		}
		
		function wizGradeDie($msg) {  /* wizGrade Customize PHP Die() function */
			
			global $erroMsg, $msgEnd;
	
$err = <<<END

			$erroMsg $msg $msgEnd
		
END;

			echo $err; exit;
	
		}


		function wizMailer($to, $subject, $message, $from) {  /* wizGrade Mailer */
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= 'From: Africantab ' . $from . "\r\n";
			$headers .= 'Reply-To: ' .$from . "\r\n";
			$headers .= 'X-Mailer: PHP/' . phpversion();

			if(mail($to, $subject, $message, $headers)){
				return 1;
			} 
			return 0;
		}		
		 

		function validateMail($str) {
			return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
		}
   
?>
