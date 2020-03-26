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
	This script handle best student termly result
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 

			$classNum = studentClassCount($conn, $sessionID, $class, $level);  /* count student class */
			$next_begin = termStartDate($conn, $sessionID, $term);  /* retrieve school next term start  */

			$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
			$exam_status = $examArray[0]['status'];		
			$exam_fi = $examArray[0]['fi_ass'];	
			$exam_se = $examArray[0]['se_ass'];	
			$exam_th = $examArray[0]['th_ass'];	
			$exam_fo = $examArray[0]['fo_ass'];	
			$exam_fif = $examArray[0]['fif_ass'];	
			$exam_six = $examArray[0]['six_ass'];	
			$exam_score = $examArray[0]['exam'];				

			$principalData = staffData($conn, $schoolHead);  /* school staffs/teachers information */
			list ($princ_title, $princ_fullname, $princ_sex, $princ_rankingVal, $princ_picture, 
				  $princ_lname) = explode ("#@s@#", $principalData);

			$titleVal = $title_list[$princ_title];
			$schoolPrincipal = $titleVal.' '.$princ_fullname;
			
			
			$formTeacher = formTeacher($conn, $sessionID, $level, $class);  /* retrieve assign class teacher information */
			
		    $classTeachers = rsClassTeachers($conn, $sessionID, $class, $level, $term);  /* retrieve subject class teachers */		
			$classTeachers = unserialize($classTeachers); 
					
			$gradeArray = gradeDataArr($conn);   /* school grade array */
					
			/* check exam configuration status  */	

			if($exam_status == $fiVal){
			
				$csCHRow = '<th width="30px" colspan="1">Continous Assessment </th>';
				
				$csCLRow = '  <tr>
					<th>1st <br/> ('.$exam_fi.') </th>
					
					</tr>';
				$rsColplus = $fiVal; 	
			
			}elseif($exam_status == $seVal){
			
				$csCHRow = '<th width="60px" colspan="2">Continous Assessment </th>';
				
				$csCLRow = '  <tr>
					<th>1st <br/>  ('.$exam_fi.') </th>
					<th>2nd  <br/> ('.$exam_se.')</th>
					
				  </tr>';
				  
				  $rsColplus = $seVal; 	
			
			}elseif($exam_status == $thVal){

				$csCHRow = '<th width="90px" colspan="3">Continous Assessment </th>';
				
				$csCLRow = '  <tr>
					<th>1st <br/>('.$exam_fi.')</th>
					<th>2nd <br/>('.$exam_se.')</th>
					<th>3rd <br/>('.$exam_th.')</th>
				  </tr>';
				  $rsColplus = $thVal; 	
				
			
			}elseif($exam_status == $foVal){

				$csCHRow = '<th width="90px" colspan="4">Continous Assessment </th>';
				
				$csCLRow = '  <tr>
					<th>1st <br/>('.$exam_fi.')</th>
					<th>2nd <br/>('.$exam_se.')</th>
					<th>3rd <br/>('.$exam_th.')</th>
					<th>4th <br/>('.$exam_fo.')</th>
				  </tr>';
				  $rsColplus = $foVal; 	
				
			
			}elseif($exam_status == $fifVal){

				$csCHRow = '<th width="90px" colspan="5">Continous Assessment </th>';
				
				$csCLRow = '  <tr>
					<th>1st <br/>('.$exam_fi.')</th>
					<th>2nd <br/>('.$exam_se.')</th>
					<th>3rd <br/>('.$exam_th.')</th>
					<th>4th <br/>('.$exam_fo.')</th>
					<th>5th <br/>('.$exam_fif.')</th>
				  </tr>';
				  $rsColplus = $fifVal; 	
				
			
			}elseif($exam_status == $sixVal){

				$csCHRow = '<th width="90px" colspan="6">Continous Assessment </th>';
				
				$csCLRow = '  <tr>
					<th>1st <br/>('.$exam_fi.')</th>
					<th>2nd <br/>('.$exam_se.')</th>
					<th>3rd <br/>('.$exam_th.')</th>
					<th>4th <br/>('.$exam_fo.')</th>
					<th>5th <br/>('.$exam_fif.')</th>
					<th>6th <br/>('.$exam_six.')</th>
				  </tr>';
				  $rsColplus = $sixVal; 	
				
			
			}else{
				
				$csCHRow = '<th width="90px" colspan="3">Continous Assessment </th>';
				
				$csCLRow = '  <tr>
					<th>1st <br/> ('.$exam_fi.') </th>
					<th>2nd  <br/> 
					('.$exam_se.')</th>
					<th>3rd  <br/> ('.$exam_th.')</th>
				  </tr>';
				  $rsColplus = $thVal; 	
			
			} 
			
			$rsColspan = (9 + $rsColplus);	
			$wizGradeSchTitle ="<div style = 'padding-bottom:10px;'>  $schoolNameTop </div>
		   				<div style = 'padding-bottom:10px;'> $schoolAddressTop</div>";
			
			/* select student result information */
			
			$ebele_mark_1 = "SELECT r.nk_regno, f.$queryUserBio, c.$conducts_field 

							FROM $i_reg_tb r INNER JOIN $i_student_tb f
						
							ON (r.ireg_id = f.ireg_id)

							AND r.session_id = :session_id 
					 
							AND r.$nk_class = :class

							AND r.active = :foreal
					  
							AND r.nk_regno =  :nk_regno
							
							INNER JOIN $sdoracle_student_remark_nk c
					 
								ON (r.ireg_id = c.ireg_id)"; 
				 
			$igweze_prep_1 = $conn->prepare($ebele_mark_1);
			$igweze_prep_1->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
			$igweze_prep_1->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
			$igweze_prep_1->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
			$igweze_prep_1->bindValue(':class', $class, PDO::PARAM_STR);				 
			$igweze_prep_1->execute();
			
			$rows_count_1 = $igweze_prep_1->rowCount(); 
			
			if($rows_count_1 == $foreal) {  /* check array is empty */
			
				while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_BOTH)) {  /* loop array */		
   
					$pic = $row_1['i_stupic'];
					$fname = $row_1['i_firstname'];
					$mname = $row_1['i_midname'];
					$lname = $row_1['i_lastname'];
					$dob = $row_1['i_dob']; 
					$attribute = $row_1[$attrib]; 
					$attendance = $row_1[$attendance_r];
					$conducts = $row_1[$conducts_r];
					$i_sport = $row_1[$sports_r];
					$organization = $row_1[$organization_r];
					$comment = $row_1[$comment_r];
					$pr_comment = $row_1[$pr_comment_r];
					$studentName = "$lname $mname $fname"; 
												
				}	 				
				
				$gsRemarkArray = teacherRemarksArrays($conn);  /* teacher remarks array */ 
				$clubArray = studentsClubArrays($conn);  /* school clubs array */
				$clubPostArray = clubPostArrays($conn);  /* school clubs position array */
				$sportArray = sportsArrays($conn);  /* school sports array */
			
				if (is_null($pic)){
	
					$studentPic = $wizGradeDefaultPic;

				}else{
	
					$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$pic; 

				}
				
				if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }  /* check if picture exists */
			
			} 

			$rs_date_pub = $rs_date_list[$rs_date]; 

            $academic_yr = recentAcademicYear($level, $session_fi);  /* school session academic year  */ 			 

            $show_status = "<font color='#996600'> ( ".$rs_status." )</font>";

$table_head =<<<IGWEZE

			<div class="table-responsive-sm">
			<!-- table -->
			<table width="100%" align = "center" class="display table table-bordered table-striped compact" 
			style='font-size:12px !importnat';>

			<tr>
				<th colspan = "6" style="background-color:#fff !important;">  

					<div class='col-lg-12'>
						<div class='col-sm-3 col-lg-3  rs-header-side'> 
						<img src="$studentPic"  alt="Student's Picture"  class='img-rounded rs-header-img' />
						</div>
						<div class='col-sm-6 col-lg-12 tbhead-title lg-sidea rs-header-center'>
						<center> <h3>  $wizGradeSchTitle </h3></center> </div>
						<div class='col-sm-3 col-lg-3 rs-header-side hide-res'>
						<img src="$sch_logo" alt="School Logo"  class='img-rounded rs-header-img'/>
						</div>
					</div> 


				</th>
			</tr>

			<tr>
				<th width = "20%" colspan = "1" style="text-align:left; padding-left:2% !important;">Name Of Student</th>
				<td width = "30%" colspan = "2" style="text-align:left; padding-left:2% !important;">$studentName</td>
				<th width = "20%" colspan = "1" style="text-align:left; padding-left:2% !important;">Admission No</th>
				<td width = "30%" colspan = "2" style="text-align:left; padding-left:2% !important;"> **** </td>
			</tr>

			<tr> 
				<th width = "20%" colspan = "1" style="text-align:left; padding-left:2% !important;">Class </th>
				<td width = "30%" colspan = "2" style="text-align:left; padding-left:2% !important;"> $stu_class $class  $term_value </td>
				<th width = "20%" colspan = "1" style="text-align:left; padding-left:2% !important;">Academic Year </th>
				<td width = "30%" colspan = "2" style="text-align:left; padding-left:2% !important;">$academic_yr </td> 
			</tr>  

		</table>
		<!-- / table -->



IGWEZE;

        echo $table_head;



$table_body =<<<IGWEZE


			<!-- table -->	
			<table width="100%" border="0" class="display table table-bordered table-striped compact">
			  
			  <tr>
				<th width="20%" rowspan="2" class="v-align" style="text-align:left; padding-left:10px;">Subjects</th>
				$csCHRow
				
				<th rowspan="2" class="v-align">Exam  <br/> ($exam_score) </th>
				<th rowspan="2" class="v-align">Total Score </th>
				<th rowspan="2" class="v-align">Grade</th>
				<th rowspan="2" class="v-align hide-res">Remarks</th>
				<th rowspan="2" class="v-align">Rank </th>
				<th rowspan="2" class="v-align hide-res">Max Score</th>
				<th rowspan="2" class="v-align hide-res" style="text-align:left; padding-left:10px;">Teachers Remark</th>
				<th rowspan="2" width="25%" class="v-align hide-res" style="text-align:left; padding-left:10px;">Teachers Name</th>
			  </tr>

				$csCLRow


			</div>

IGWEZE;

			echo $table_body;


			/* select student result information */
			
			$ebele_mark_2 = "SELECT r.nk_regno, f.$query_i_strings_nj

							FROM $i_reg_tb r INNER JOIN $sdoracle_grand_score_nk f
						
							ON (r.ireg_id = f.ireg_id)

							AND r.session_id = :session_id 
					 
							AND r.$nk_class = :class

							AND r.active = :foreal
					  
							AND r.nk_regno = :nk_regno"; 
				 
			$igweze_prep_2 = $conn->prepare($ebele_mark_2);

			$igweze_prep_2->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);
			
			$igweze_prep_2->bindValue(':session_id', $sessionID, PDO::PARAM_STR);
			
			$igweze_prep_2->bindValue(':foreal', $foreal, PDO::PARAM_STR);
			
			$igweze_prep_2->bindValue(':class', $class, PDO::PARAM_STR);
			 
			$igweze_prep_2->execute();
			
			$rows_count_2 = $igweze_prep_2->rowCount(); 
			
			if($rows_count_2 == $foreal) {  /* check array is empty */
			
				while($row_2 = $igweze_prep_2->fetch(PDO::FETCH_BOTH)) {  /* loop array */		
   
						$total_score = $row_2[1]; 
						$student_avg = $row_2[2]; 
						$student_poistion = $row_2[3]; 

				}	 
			
			} 

			$ebele_mark_3 = "SELECT r.nk_regno, f.$query_i_strings, g.$query_i_strings_nk, j.$query_i_scores

							FROM $i_reg_tb r INNER JOIN $sdoracle_sub_score_nk f
							
							ON (r.ireg_id = f.ireg_id)

							AND r.session_id = :session_id 
					 
							AND r.$nk_class = :class

							AND r.active = :foreal
					  
							AND r.nk_regno =  :nk_regno
							
								INNER JOIN $sdoracle_grade_nk g
					 
								ON (r.ireg_id = g.ireg_id)
					 
									INNER JOIN $sdoracle_score_nk j
					 
									ON (g.ireg_id = j.ireg_id)"; 
				 
			$igweze_prep_3 = $conn->prepare($ebele_mark_3);
			$igweze_prep_3->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);			
			$igweze_prep_3->bindValue(':session_id', $sessionID, PDO::PARAM_STR);			
			$igweze_prep_3->bindValue(':foreal', $foreal, PDO::PARAM_STR);			
			$igweze_prep_3->bindValue(':class', $class, PDO::PARAM_STR);			 
			$igweze_prep_3->execute();
			
			$rows_count_3 = $igweze_prep_3->rowCount(); 
			
			if($rows_count_3 == $foreal) {  /* check array is empty */
			
				while($row_3[] = $igweze_prep_3->fetch(PDO::FETCH_BOTH)) {  /* loop array */ } 
			
			}
			
			$f = 0; 	   
			$c = 0;
			$c = ($i_stop_loop * 2) + 2;
			$f_gr = 0; $e_gr = 0; $d_gr = 0; 

			$p = $i_stop_loop + 2;
			$countNum = $foreal;
			$iT = 0; $subArr = $start_nkiru;
				   
			for ($i = $i_start_loop; $i <= $i_stop_loop; $i++) {  /* loop array */
				
				$courseNum = $countNum++;		
		
				$i_score = $row_3[$f][$i]; 		
			   
				if($i_score >= $fiVal){  /* check is score is greater than 1  */			
		
					$field = $course_info_mark[$subArr][3]; 						
					$score_remarks = gradeRemarks($i_score); /* grade remarks */					   
					$grade_remarks = teacherGradeRemarks($i_score); /* teacher grade remarks */					   
					$i_score_gr = wizGradeGradeScore($gradeArray, $i_score); /* student grades score */					   
					$i_max_score = maxStudentScore($conn, $regNum, $sdoracle_sub_score_nk, $field, 
															   $sessionID, $class, $nk_class); /* student termly maximum subject score */
															   
					$subject_poistion = $row_3[$f][$p];
					$subjectPoistion = studentPostionSup($subject_poistion);  /* student result position suffix  */
				   
				}else{ 
				   
					$field = '-';  $i_score = '-';  $score_remarks = '-'; 
				   
					$grade_remarks = '-';  $i_score_gr = '-';  $i_max_score = '-'; 
				   
					$fi = '-'; $se = '-'; $th = '-'; $fo = '-'; $fif = '-'; $six = '-';  $ex = '-'; 
				   
					$subjectPoistion = '-';	
		
				}
			   
				if(is_array($classTeachers)){  /* check if array */ 

					$classteacherID = $classTeachers[$iT]; 

					list ($fiTeacher, $seTeacher, $thTeacher) = explode (",", $classteacherID);

					if($fiTeacher != ''){
						
						$ficlassTeacher = staffData($conn, $fiTeacher);  /* school staffs/teachers information */ 
						list ($fi_title, $fi_fullname, $fi_sex, $fi_rankingVal, $fi_picture, 
							  $fi_lname) = explode ("#@s@#", $ficlassTeacher);

						$fi_titleV = $title_list[$fi_title];
						$fi_sub_teacher = $fi_titleV.' '.$fi_fullname;
						
						if($ficlassTeacher != ''){
							
							$sub_teacher_name .=  $fi_sub_teacher;	
						
						}
					}


					if($seTeacher != ''){
						
						$seclassTeacher = staffData($conn, $seTeacher);  /* school staffs/teachers information */ 
						list ($se_title, $se_fullname, $se_sex, $se_rankingVal, $se_picture, 
							  $se_lname) = explode ("#@s@#", $seclassTeacher);

						$se_titleV = $title_list[$se_title];
						$se_sub_teacher = $se_titleV.' '.$se_fullname;
						
						if($seclassTeacher != ''){
							
							$sub_teacher_name .=  ' / '.$se_sub_teacher;	
						
						}
					}


					if($thTeacher != ''){
						
						$thclassTeacher = staffData($conn, $thTeacher);  /* school staffs/teachers information */ 
						list ($th_title, $th_fullname, $th_sex, $th_rankingVal, $th_picture, 
							  $th_lname) = explode ("#@s@#", $thclassTeacher);

						$th_titleV = $title_list[$th_title];
						$th_sub_teacher = $th_titleV.' '.$th_fullname;
						
						if($thclassTeacher != ''){
							
							$sub_teacher_name .=  ' / '.$th_sub_teacher;
						
						}
					}

				}else{

					$sub_teacher_name = ' - ';

				}
			   
		
				$iT++;
						
				$scoresC = explode(",", $row_3[$f][$c]);
				$scoresCount = count($scoresC); 
														
				/* check exam configuration status  */	
				
				if($exam_status == $fiVal){
					
					list ($fi, $ex) = explode (",", $row_3[$f][$c]);
					$examRows = '<td class="v-align">'.$fi.'</td> <td class="v-align">'.$ex.'</td> 
					<td >'.$i_score.'</td> <td class="v-align">';
				
				}elseif($exam_status == $seVal){
					
					list ($fi, $se, $ex) = explode (",", $row_3[$f][$c]);
					$examRows = '<td class="v-align">'.$fi.'</td> <td class="v-align">'.$se.'</td> <td class="v-align">'.$ex.'</td> 
					<td >'.$i_score.'</td> <td class="v-align">';
				
				}elseif($exam_status == $thVal){
					
					list ($fi, $se, $th, $ex) = explode (",", $row_3[$f][$c]);
					$examRows = '<td class="v-align">'.$fi.'</td> <td class="v-align">'.$se.'</td> <td class="v-align">'.$th.'</td> 
					<td class="v-align">'.$ex.'</td> 
					<td class="v-align">'.$i_score.' </td> <td class="v-align">';
				
				}elseif($exam_status == $foVal){
					
					list ($fi, $se, $th, $fo, $ex) = explode (",", $row_3[$f][$c]);
					$examRows = '<td class="v-align">'.$fi.'</td> <td class="v-align">'.$se.'</td> <td class="v-align">'.$th.'</td>
					<td class="v-align">'.$fo.'</td><td class="v-align">'.$ex.'</td> 
					<td class="v-align">'.$i_score.' </td> <td class="v-align">';
				
				}elseif($exam_status == $fifVal){
					
					list ($fi, $se, $th, $fo, $fif, $ex) = explode (",", $row_3[$f][$c]);
					$examRows = '<td class="v-align">'.$fi.'</td> <td class="v-align">'.$se.'</td> <td class="v-align">'.$th.'</td>
					<td class="v-align">'.$fo.'</td><td class="v-align">'.$fif.'</td><td class="v-align">'.$ex.'</td> 
					<td class="v-align">'.$i_score.' </td> <td class="v-align">';
				
				}elseif($exam_status == $sixVal){
					
					list ($fi, $se, $th, $fo, $fif, $six, $ex) = explode (",", $row_3[$f][$c]);
					
					if($scoresCount == $fiVal){

						$examRows = '<td class="v-align"> - </td> <td class="v-align"> - </td> <td class="v-align"> - </td>
						<td class="v-align"> - </td><td class="v-align"> - </td><td class="v-align"> - </td>
						<td class="v-align">'.$fi.'</td> 
						<td class="v-align">'.$i_score.' </td> <td class="v-align">';
					
					}else{								
					
						$examRows = '<td class="v-align">'.$fi.'</td> <td class="v-align">'.$se.'</td> <td class="v-align">'.$th.'</td>
						<td class="v-align">'.$fo.'</td><td class="v-align">'.$fif.'</td><td class="v-align">'.$six.'</td>
						<td class="v-align">'.$ex.'</td> 
						<td class="v-align">'.$i_score.' </td> <td class="v-align">';
						
					}	
				
				}else{
					
					list ($fi, $se, $th, $ex) = explode (",", $row_3[$f][$c]);	
					$examRows = '<td >'.$fi.'</td> <td >'.$se.'</td> <td >'.$th.'</td> <td >'.$ex.'</td> 
					<td >'.$i_score.' </td> <td class="v-align">';
				
				} 
		   
				echo "<tr><th style='text-align:left; padding-left:25px;'>";
				echo $course_info_mark[$subArr][2];
				echo "</th>";
				echo  $examRows;
				echo  $i_score_gr;
				echo "</td><td class='hide-res'>";
				echo  $score_remarks;
				echo "</td> <td >";
				echo  $subjectPoistion;
				echo "</td><td class='hide-res'>";
				echo $i_max_score;
				echo "</td><td style='text-align:left; padding-left:8px;' class='hide-res'> $grade_remarks </td>
				<td style='text-align:left; padding-left:4px;' class='hide-res'> $sub_teacher_name </td>
			   
		
				</tr>";
			   
				if ($i_score_gr == 'F'){ $f_gr = $f_gr + 1; }
				if ($i_score_gr == 'D7'){ $d_gr = $d_gr + 1; }
				if ($i_score_gr == 'E8'){ $e_gr = $e_gr + 1; } 
			   
				$subArr++;
				$i_score = '';
				$p = $p + 1;
				$field  = '';
				$c = $c + 1; 
				 
				$sub_teacher_name = '';  
				$i_score_gr = '';
				$i_max_score = '';
				$subjectPoistion = '';
				$score_remarks = '';
				$fi = ''; $se = ''; $th = ''; $fo = ''; $fif = ''; $six = '';  $ex = ''; 	
				
			}
			
			$f = $f + 1;

			$p = ''; 

			echo  "</tr>";

			echo"  <tr>
			<th style='text-align:left; padding-left:25px;' class='hide-res'>Number Of Subjects</th>
			<td class='hide-res'>$courseNum</td>
			<th  colspan='3'>Total Score</th>
			<td> $total_score </td>

			<th colspan='3' style='text-align:left; padding-left:20px;'>Student Average</th>
			<td colspan='3'>$student_avg</td>

			</tr>"; 

			echo "</table>";
			//echo $sdo_tb_fi_grade;  
			echo $rsAdsFooter;

			$teachers_remark = $gsRemarkArray[$comment]['name']; 
			$principal_remark = wizGradePrincipalRemarks ($student_avg, $d_gr, $e_gr, $f_gr); /* principal auto remarks */
			$studentPoistion = studentPostionSup($student_poistion);  /* student result position suffix  */ 

			if($pr_comment != ''){

				$principal_remark = $pr_comment;

			} 

$table_foot =<<<IGWEZE
                         
		<!-- table -->
		<table width="100%" border="0" style="border-color:#fff; margin-top: 15px; font-size:14px;" align="center" class="display table table-bordered table-striped">
		  <tr style="border-color:#fff;">
			<td width="50%"  style='text-align:left; padding: 10px; border-color:#fff; font-weight:bold; border-bottom-color:#000;'>
			No of Students in Class : 
			<span class='tb-caption'> $classNum </span></td>
			<td width="50%" style='text-align:left; padding: 10px; border-color:#fff; font-weight:bold; border-bottom-color:#000;'>Position in Class : 
			<span class='tb-caption'> $studentPoistion </span></td>
		  </tr>
		</table>
		<!-- / table -->						  
		</table>
		<!-- / table -->
		
		</div>

IGWEZE;

        echo $table_foot; 

		$regNum = ''; $regVal = ''; $row_1 = ''; $row_2 = ''; $row_3 = '';

?> 