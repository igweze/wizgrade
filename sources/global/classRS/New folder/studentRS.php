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
	This script handle student termly result
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 

$sytleTbale =<<<IGWEZE

			<style type="text/css">
			
				tr{ padding:1px !important;}
				td{ padding:1px !important;} 
				td,th,tr{ font-size:12px !important;} 
 
			</style>

IGWEZE;
			
			echo $sytleTbale;
			
			$classNum = studentClassCount($conn, $sessionID, $class, $level);  /* count student class */
			$next_begin = termStartDate($conn, $sessionID, $term);  /* retrieve school next term start  */
			
			$levelArray = studentLevelsArray($conn); /* student level array */
			$trimLevel = ($level - $fiVal);
			$studentLevel = $levelArray[$trimLevel]['level'];

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
				  $princ_lname, $princ_phone, $princ_sign) = explode ("#@s@#", $principalData);

			$titleVal = $title_list[$princ_title];
			$schoolPrincipal = $titleVal.' '.$princ_fullname; 
			
			$formTeacher = formTeacher($conn, $sessionID, $level, $class);  /* retrieve assign class teacher information */
			
			$formTeacherSign = formTeacherSignatures($conn, $sessionID, $level, $class); /* retrieve assign class teacher signature */
			
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
			
			/* select student and conducts information */
			
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
					$ftRemark = $row_1[$comment_t];
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

			list ($i_att, $i_sporta, $i_conduct, $i_org, $i_off, $t_com, $t_name, $rs_date, $bg_date) = 
			explode ("#", $attribute);

			list ($NOTSchOpen, $NOTPresent, $NOTPunc) = explode (",", $attendance); 
			$NOTAbsent =  ($NOTSchOpen - $NOTPresent);

			list ($i_sport_1, $i_sport_2, $i_sport_3, $i_sport_4, $i_sport_5, $i_sport_6, $i_sport_7, 
			   $i_sport_8) = explode (",", $i_sport);

			list ($i_conduct_1, $i_conduct_2, $i_conduct_3, $i_conduct_4, $i_conduct_5, $i_conduct_6, 
			   $i_conduct_7, $i_conduct_8,
			   $i_conduct_9, $i_conduct_10) = explode (",", $conducts);
							 
			settype($t_com, "integer"); settype($t_name, "integer"); settype($rs_date, "integer"); 
			settype($bg_date, "integer");

			settype($i_sport_1, "integer"); settype($i_sport_2, "integer"); settype($i_sport_3, "integer"); 
			settype($i_sport_4, "integer"); settype($i_sport_5, "integer"); settype($i_sport_6, "integer"); 
			settype($i_sport_7, "integer");  settype($i_sport_8, "integer"); settype($i_sport_9, "integer"); 
			settype($i_sport_10, "integer");

			$sport_1 = $sportArray[$i_sport_1]['name']; $sport_2 = $sportArray[$i_sport_2]['name']; 
			$sport_3 = $sportArray[$i_sport_3]['name']; 
			$sport_4 = $sportArray[$i_sport_4]['name']; $sport_5 = $sportArray[$i_sport_5]['name']; 
			$sport_6 = $sportArray[$i_sport_6]['name']; 
			$sport_7 = $sportArray[$i_sport_7]['name']; $sport_8 = $sportArray[$i_sport_8]['name'];
			$sport_9 = $sportArray[$i_sport_9]['name']; $sport_10 = $sportArray[$i_sport_10]['name']; 

			list ($fi_social_info, $se_social_info, $th_social_info, $fo_social_info, $fif_social_info) = 
			explode ("%##%", $organization);

			list ($i_org_1, $i_off_1, $fi_contrib) = explode ("@@", $fi_social_info); 
			list ($i_org_2, $i_off_2, $se_contrib) = explode ("@@", $se_social_info);
			list ($i_org_3, $i_off_3, $th_contrib) = explode ("@@", $th_social_info);
			list ($i_org_4, $i_off_4, $fo_contrib) = explode ("@@", $fo_social_info);
			list ($i_org_5, $i_off_5, $fif_contrib) = explode ("@@", $fif_social_info);
							 
			$i_fi_org = $clubArray[$i_org_1]['name']; $i_se_org = $clubArray[$i_org_2]['name']; 
			$i_th_org = $clubArray[$i_org_3]['name']; 
			$i_fo_org = $clubArray[$i_org_4]['name']; $i_fif_org = $clubArray[$i_org_5]['name'];

			$i_fi_off = $clubPostArray[$i_off_1]['name']; $i_se_off = $clubPostArray[$i_off_2]['name']; 
			$i_th_off = $clubPostArray[$i_off_3]['name']; 
			$i_fo_off = $clubPostArray[$i_off_4]['name']; $i_fif_off = $clubPostArray[$i_off_5]['name']; 

			$rs_date_pub = $rs_date_list[$rs_date]; 

			$academic_yr = recentAcademicYear($level, $session_fi);  /* school session academic year  */ 			 

			$show_status = "<font color='#996600'> ( ".$rs_status." )</font>";

$table_head =<<<IGWEZE
			
			<div class="col-12 col-sm-12 col-lg-12">
			<!-- table -->
			<table width="100%" align = "center" class="display table table-bordered table-striped compact" 
			style='font-size:12px !importnat';>

			<tr>
				<th colspan = "6" style="background-color:#fff !important;">  

					<div class='col-lg-12'>

						<div class='col-sm-3 col-lg-3 hide-resa' style='float:left; width: 15% !important;'> 
						<img src="$studentPic" height='70' width = '90' alt="Student's Picture" id='wizGradeStudentPica' class='img-rounded' />
						</div>
						<div class='col-sm-6 col-lg-12 tbhead-title lg-side' style='float:left;  width: 70% !important;'>
						<center> <h3>  $wizGradeSchTitle </h3></center> </div>
						<div class='col-sm-3 col-lg-3 hide-res'  style='float:right; width: 15% !important;'>
						<img src="$sch_logo" height='70' width = '90' alt="School Logo" id='wizGradeStudentPica' class='img-rounded'/>
						</div>

					</div> 

				</th>
			</tr>

			<tr>
				<th width = "15%" colspan = "1" style="text-align:left; padding-left:2% !important;">Name Of Student</th>
				<td width = "40%" colspan = "2" style="text-align:left; padding-left:2% !important;">$studentName</td>
				<th width = "20%" colspan = "1" style="text-align:left; padding-left:2% !important;">Admission No</th>
				<td width = "25%" colspan = "2" style="text-align:left; padding-left:2% !important;"> $pre_regnum$regNum </td>
			</tr>
			
			 

			<tr> 
				<th width = "5%" colspan = "1" style="text-align:left; padding-left:2% !important;">Class </th>
				<td width = "20%" colspan = "1" style="text-align:left; padding-left:2% !important;"> $studentLevel $class  $term_value </td>
				<th width = "15%" colspan = "1" style="text-align:left; padding-left:2% !important;">Academic Year </th>
				<td width = "15%" colspan = "1" style="text-align:left; padding-left:2% !important;">$academic_yr </td>
				<th width = "20%" colspan = "1" style="text-align:left; padding-left:2% !important;"> Next Term Begin</th>
				<td width = "25%" colspan = "1" style="text-align:left; padding-left:2% !important;"> ___ </td>

			</tr> 
			
			
			 

IGWEZE;
			echo $table_head;

$tableTop =<<<IGWEZE

			<!-- table -->
			<table  width: "100%"   class="display table table-bordered table-striped compact">			
			   
			  <tr>
				<th width="20%" style="text-align:left; padding-left:2% !important;">No. of times School Open </th>
				<td width="5%" style="text-align:left; padding-left:1% !important;">$NOTSchOpen</td>

				<th width="20%" style="text-align:left; padding-left:2% !important;">No. of times Presents </th>
				<td width="5%" style="text-align:left; padding-left:1% !important;">$NOTPresent</td>
				
				<th width="20%" class='hide-res' style="text-align:left; padding-left:2% !important; font-weight:500;">No. of times  Punctual </th>
				<td width="5%" class='hide-res' style="text-align:left; padding-left:1% !important;">$NOTPunc</td>

				<th width="20%" style="text-align:left; padding-left:2% !important;">No. of times Absents  </th>
				<td width="5%" style="text-align:left; padding-left:1% !important;">$NOTAbsent</td>

			  </tr>
			   
			  
			</table>
			<!-- / table -->

			
			 
			<!-- table  
			<table width="100%" border="0" class="display table table-bordered table-striped">

			  <tr>
				<th colspan="4" style="margin: 0px !important; padding:0px !important;" width="40%">
				<header class="panel-heading" style="text-align:left; padding-left:4% !important;">
					Conducts 
				</header>
				</th>
				
				<th colspan="3" style="margin: 0px !important; padding:0px !important;" width="60%">				
						<header class="panel-heading" style="text-align:left; padding-left:4% !important;">
						   Student Organization 
						</header>									  
				</th>

			  </tr>

			  <tr>
				<th width="15%" style="text-align:left; padding-left:1% !important;">Student Assessment</th>
				<th width="5%" style="text-align:left;">Rating</th>

				<th width="15%" style="text-align:left; padding-left:1% !important;">Student Assessment</th>
				<th width="5%" style="text-align:left;">Rating</th>

				<th width="15%" style="text-align:left; padding-left:2% !important;">Organisation</th>
				<th width="15%" style="text-align:left; padding-left:2% !important;">Office Held </th>
				<th width="30%" style="text-align:left; padding-left:2% !important;">Contribution</th>

			  </tr>
			  <tr>
				<td width="15%" style="text-align:left; padding-left:1% !important;">Neatness</td>
				<td width="5%">$i_conduct_1</td>

				<td width="15%" style="text-align:left; padding-left:1% !important;">Emotional Stability</td>
				<td width="5%">$i_conduct_6</td>

				<td width="15%" style="text-align:left; padding-left:2% !important;">$i_fi_org</td>
				<td width="15%" style="text-align:left; padding-left:2% !important;">$i_fi_off</td>
				<td width="30%" style="text-align:left; padding-left:2% !important;">$fi_contrib</td>

			  </tr>
			  <tr>
				<td width="15%" style="text-align:left; padding-left:1% !important;">Politeness</td>
				<td width="5%">$i_conduct_2</td>

				<td width="15%" style="text-align:left; padding-left:1% !important;">Health</td>
				<td width="5%">$i_conduct_7</td>

				<td width="15%" style="text-align:left; padding-left:2% !important;">$i_se_org</td>
				<td width="15%" style="text-align:left; padding-left:2% !important;">$i_se_off</td>
				<td width="30%" style="text-align:left; padding-left:2% !important;">$se_contrib</td>

			  </tr>
			  <tr>
				<td width="15%" style="text-align:left; padding-left:1% !important;">Honesty</td>
				<td width="5%">$i_conduct_3</td>

				<td width="15%" style="text-align:left; padding-left:1% !important;">Attitude to Sch.Work</td>
				<td width="5%">$i_conduct_8</td>

				<td width="15%" style="text-align:left; padding-left:2% !important;">$i_th_org</td>
				<td width="15%" style="text-align:left; padding-left:2% !important;">$i_th_off</td>
				<td width="30%" style="text-align:left; padding-left:2% !important;">$th_contrib</td> 
			  </tr>
			  <tr>
				<td width="15%" style="text-align:left; padding-left:1% !important;">Leadership</td>
				<td width="5%">$i_conduct_4</td>

				<td width="15%" style="text-align:left; padding-left:1% !important;">Speaking</td>
				<td width="5%">$i_conduct_9</td>

				<td width="15%">$i_fo_org</td>
				<td width="15%">$i_fo_off</td>
				<td width="30%">$fo_contrib</td> 

			  </tr>
			  <tr>
				<td width="15%" style="text-align:left; padding-left:1% !important;">Attentiveness</td>
				<td width="5%">$i_conduct_5</td>

				<td width="15%" style="text-align:left; padding-left:1% !important;">Hand Writing</td>
				<td width="5%">$i_conduct_10</td>

				<td width="15%">$i_fif_org</td>
				<td width="15%">$i_fif_off</td>
				<td width="30%">$fif_contrib</td>

			  </tr> 
			  
			</table><!-- / table -->
		 

IGWEZE;

			echo $tableTop;



$table_body =<<<IGWEZE

			<!-- table -->	
			<table width="100%"  class="display table table-bordered table-striped compact">
			  
			  <tr>
				<th width="1%" rowspan="2" class="v-align hide-res" style="text-align:left; padding-left:10px;">S/N</th>
				<th width="20%" rowspan="2" class="v-align" style="text-align:left; padding-left:10px;">Subjects</th>
				$csCHRow
				
				<th rowspan="2" class="v-align">Exam  <br/> ($exam_score) </th>
				<th rowspan="2" rowspan="2" class="v-align" > Total  </th> 
				
				<th rowspan="2" class="v-align">1st<br/> Term<br/> Ratio</th>
				<th rowspan="2" class="v-align">2nd<br/> Term<br/> Ratio</th>
				<th rowspan="2" class="v-align">3rd<br/> Term<br/> Ratio</th>
				<!--<th rowspan="2" class="v-align">Grade</th>--> 
				<th rowspan="2" rowspan="2" class="v-align" >Letter Grade </th>
				<th rowspan="2" rowspan="2" class="v-align" >Position </th>
				<!--<th rowspan="2" class="v-align hide-res">Max Score</th>--> 
				<th rowspan="2" rowspan="2" class="v-align" style="text-align:left; padding-left:10px;">Teachers Remark </th>
				<!--<th rowspan="2" width="25%" class="v-align hide-res" style="text-align:left; padding-left:10px;">Teachers Name</th>-->
				
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
						$grade_remarks = teacherGradeRemarks($i_score);	 /* teacher grade remarks */				   
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
					if($i_score >= 1){
						$fRatio = ($i_score * 20)/ 100;
					}	
					$courseCount++;
					echo "<tr><th valign='middle' class='hide-res'>$courseCount</th> 
					<th style='text-align:left; padding-left:25px;' class='v-align'>";
					echo $course_info_mark[$subArr][2];
					echo "</th>";
					echo  $examRows;
					echo  $fRatio;
					echo "</td> <td class='v-align hide-res'>";
					echo  $i_score_gra;
					echo "</td> <td class='v-align hide-res'>";
					echo  $i_score_gra;
					echo "</td> <td class='v-align hide-res'>";
					echo  $i_score_gr;

					echo "</td>  <td class='v-align'>";
					echo  $subjectPoistion;
					echo "</td><!--<td class='v-align hide-res'>";
					echo $i_max_score;
					echo "</td>--><td style='text-align:left; padding-left:8px;' class='v-align hide-res'> $grade_remarks </td>
					<!--<td style='text-align:left; padding-left:4px;' class='v-align hide-res'> $sub_teacher_name </td> -->
			
					</tr>";
				   
					if ($i_score_gr == 'F'){ $f_gr = $f_gr + 1; }
					if ($i_score_gr == 'D7'){ $d_gr = $d_gr + 1; }
					if ($i_score_gr == 'E8'){ $e_gr = $e_gr + 1; } 
					   
					$subArr++;
					$i_score = '';
					$p = $p + 1;
					$field  = '';
					$c = $c + 1;
					$i_score_gr = '';
					$i_max_score = '';
					$subjectPoistion = '';
					$score_remarks = '';
					$fi = ''; $se = ''; $th = ''; $fo = ''; $fif = ''; $six = '';  $ex = ''; 
					// $row_3[$f][$c] = '';

					$sub_teacher_name = '';   
					
				} 
				
				$f = $f + 1;

				$p = ''; 

				echo  "</tr>";

				echo"  <tr>
				<th style='text-align:left; padding-left:5%;' colspan='2' class ='hide-res'>Number Of Subjects</th>
				<td class ='hide-res'>$courseNum</td>
				<th  colspan='3'>Total Score</th>
				<td> $total_score </td>

				<th colspan='3' style='text-align:left; padding-left:20px;'>Student Average</th>
				<td colspan='$exam_status' style='text-align:left; padding-left:25px;'>$student_avg</td>

				</tr>"; 


				echo "</table>";
				 
				echo $rsAdsFooter;

				$gsRemark = $gsRemarkArray[$comment]['name'];
				$principal_remark = wizGradePrincipalRemarks ($student_avg, $d_gr, $e_gr, $f_gr); /* principal auto remarks */
				$studentPoistion = studentPostionSup($student_poistion);  /* student result position suffix  */

				$pr_comment = trim($pr_comment);

				if(($pr_comment == '') || ($pr_comment == '-')){

					$principal_remark = $principal_remark;	

				}else{ 

					$principal_remark = $pr_comment; 

				} 

				$principalSign = $teachersSignExt.$princ_sign;

				if ((is_null($princ_sign)) || ($princ_sign == '') || (!file_exists($principalSign))){ $principalSign = ''; }					
				else{ $principalSign = '<img src="'.$principalSign.'" style="height: 50px; width:100px; margin-top:0px;">'; } 
				

$table_foot =<<<IGWEZE
                         
				
				<!-- row -->	
				<div class="row">  
					<div class="col-lg-8"> 

					<table width="100%" border="0" style="border-color:#fff; margin-top: 0px; font-size:14px; " class="display table table-bordered table-striped">
					<tr style="border-color:#fff;">
					<td width="50%"  style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">No of Students in Class : 
					<span class="tb-caption"> $classNum </span></td>
					<td width="50%" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">Position in Class : 
					<span class="tb-caption"> $studentPoistion </span></td> 
					</tr>
					<!--
					<tr style="border-color:#fff;">
					<td colspan="2" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold;"> Guidance &amp; Counsellor's Name :
					<span class="tb-caption"> $gcTeacher </span>  </td>
					</tr>
					

					<tr>
					<td width="50%" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">
					Guidance &amp; Counsellor's Comments : 
					<span class="tb-caption"> $gsRemark  </span> </td>
					<td width="50%" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">Signature 	_____________________________ </td>
					</tr>
					-->
					<tr style="border-color:#fff;">
					<td colspan="2" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold;">Form Teacher Name :
					<span class="tb-caption"> $formTeacher </span>  </td>
					</tr>

					<tr>
					<td width="50%" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">Form Teacher Comments : 
					<span class="tb-caption"> $ftRemark  </span> </td>
					<td width="50%" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">
					Signature $formTeacherSign </td>
					</tr>

					<tr>
					<td colspan="2" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold;">Principal Name : 
					<span class="tb-caption"> $schoolPrincipal </span> </td>
					</tr>

					<tr>
					<td width="50%" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">
					Principal Comments  : 
					<span class="tb-caption"> $principal_remark </span> </td>
					<td width="50%" valign="top" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; 
					border-bottom-color:#000;">Signature 
					$principalSign </td>
					</tr>

					 
					<tr style="border-color:#fff;">

					<th colspan="2" style="margin: 0px !important; padding:0px !important; border-color:#fff; width="100%">
					<header class="panel-heading" style="text-align:left; padding-left:4% !important; margin-top: 15px !important;">
										Sports &amp; Athletics 
					</header></th> 

					</tr>

					<tr>				

					<td colspan="2" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:1% !important;">
					$sport_1 $sport_2 $sport_3 $sport_4 $sport_5</td> 

					</tr>


					</table>
					<!-- / table -->
					  
				 
				
				</div>
			 
				<div class="col-lg-4">

					<!-- table -->
					<table width="100%" border="0" style="border-color:#fff; margin-top: 0px; font-size:12px 
					padding:1% !important;;" class="display table table-bordered table-striped">

					<tr>
					<th width="35%" style="text-align:left;  border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">Student Assessment</th>
					<th width="15%" style="text-align:left;  border-color:#fff; border-bottom-color:#000; padding-left:1% !important;">Rating</th> 
					<th width="35%" style="text-align:left;  border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">Student Assessment</th>
					<th width="15%" style="text-align:left;  border-color:#fff; border-bottom-color:#000; padding-left:1% !important;">Rating</th> 

					</tr>
					
					<tr>

					<td width="35%" style="text-align:left;  border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">Neatness</td>
					<td width="15%" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">$i_conduct_1</td> 
					
					<td width="35%" style="text-align:left;  border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">Politeness</td>
					<td width="15%" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">$i_conduct_2</td>

					</tr> 

					<tr>	

					<td width="35%" style="text-align:left;  border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">Honesty</td>
					<td width="15%" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">$i_conduct_3</td>
					<td width="35%" style="text-align:left;  border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">Leadership</td>
					<td width="15%" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">$i_conduct_4</td>

					</tr> 
					
					<tr>	

					<td width="35%" style="text-align:left;  border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">Attentiveness</td>
					<td width="15%" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">$i_conduct_5</td>
					<td width="35%" style="text-align:left;  border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">Emotional Stability</td>
					<td width="15%" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">$i_conduct_6</td> 

					</tr>

					 			
					<tr>
					
					<td width="35%" style="text-align:left;  border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">Health</td>
					<td width="15%" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">$i_conduct_7</td> 
					<td width="35%" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">Attitude to Sch.Work</td>
					<td width="15%" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">$i_conduct_8</td> 

					</tr> 

					</tr>
					<tr>				

					<td width="35%" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">Speaking</td>
					<td width="15%" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">$i_conduct_9</td> 
					<td width="35%" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">Hand Writing</td>
					<td width="15%" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">$i_conduct_10</td> 

					</tr>
					 

					<tr>				

					<td width="100%" colspan="4" style="text-align:left; border-color:#fff; border-bottom-color:#000; padding-left:4% !important;">$sdo_tb_se_grade</td> 

					</tr> 


					</table>				
					<!-- / table -->

				</div>
				<!-- / table -->
				</div>
				
IGWEZE;

				echo $table_foot; 

?> 