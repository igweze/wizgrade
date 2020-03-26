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
	This script handle student annual transcript
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
 
 
 $sytleTbale =<<<IGWEZE

			<style type="text/css">
			
				tr{ padding:1px !important;}
				td{ padding:1px !important;} 
				td,th,tr{ font-size:13px !important;} 

			</style>

IGWEZE;
			
			echo $sytleTbale;
				
			$wizGradeSchTitle ="<div style = 'padding-bottom:10px;'>  $schoolNameTop </div>
		   				<div style = 'padding-bottom:10px;'> $schoolAddressTop</div>";

			$gradeArray = gradeDataArr($conn);   /* school grade array */
			
			/* select student result information */
			
			$ebele_mark_1 = "SELECT r.nk_regno, f.$queryUserBio

							FROM $i_reg_tb r INNER JOIN $i_student_tb f
						
							ON (r.ireg_id = f.ireg_id)

							AND r.session_id = :session_id 
					 
							AND r.$nk_class = :class

							AND r.active = :foreal
					  
							AND r.nk_regno =  :nk_regno";
			   
				 
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
						$studentName = "$lname $mname $fname";
				}	 
			
				if (is_null($pic)){
	
					$studentPic = $wizGradeDefaultPic;

				}else{
	
					$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$pic; 

				}
				
				if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }  /* check if picture exists */
				
			}

				
			$rs_date_pub = $rs_date_list[$rs_date];
			$next_begin = $begin_date_list[$bg_date]; 

			$academic_yr = recentAcademicYear($level, $session_fi);  /* school session academic year  */
			$levelArray = studentLevelsArray($conn); /* student level array */
			$trimLevel = ($level - $fiVal);
			$studentLevel = $levelArray[$trimLevel]['level'];
             

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
			<th width = "15%" colspan = "1" style="text-align:left; padding-left:2% !important;">Name Of Student</th>
			<td width = "40%" colspan = "2" style="text-align:left; padding-left:2% !important;">$studentName</td>
			<th width = "20%" colspan = "1" style="text-align:left; padding-left:2% !important;">Admission No</th>
			<td width = "25%" colspan = "2" style="text-align:left; padding-left:2% !important;"> $pre_regnum$regNum </td>
			</tr>

			<tr> 
			<th width = "5%" colspan = "1" style="text-align:left; padding-left:2% !important;">Class </th>
			<td width = "20%" colspan = "1" style="text-align:left; padding-left:2% !important;"> $studentLevel $class  Annual </td>
			<th width = "15%" colspan = "1" style="text-align:left; padding-left:2% !important;">Academic Year </th>
			<td width = "15%" colspan = "1" style="text-align:left; padding-left:2% !important;">$academic_yr </td>
			<th width = "20%" colspan = "1" style="text-align:left; padding-left:2% !important;"> Next Term Begin </th>
			<td width = "25%" colspan = "1" style="text-align:left; padding-left:2% !important;"> ________ </td>

			</tr> 


			</table>
			<!-- / table -->


			
					
IGWEZE;

			echo $table_head;


$sytleTbale =<<<IGWEZE

			<style type="text/css">
				
				.tableInner tr td{
					padding: 5px !important;
				} 

			</style>

IGWEZE;

					 
	   
$table_body =<<<IGWEZE

			$sytleTbale
			
			
				
				

				<!-- table -->
				<table width="100%" border="0"   class="compact table-bordered  
				table-striped table-hover tableInner" > 
				

				<tr>
				<th style='text-align:center !important;'>S/N</th>
				<th style='text-align:left; padding-left:10px;'>Subjects</th>
				<th class="vertical"><div class="vertical">First Term Score</div></th>
				<th class="vertical"><div class="vertical">Second Term Score</div></th>
				<th class="vertical"><div class="vertical">Third Term Score</div></th>
				<th class="vertical"><div class="vertical">Total Score</div></th>
				<th class="vertical"><div class="vertical">Average Score</div></th>
				<!-- <th class="vertical"><div class="vertical">Class Average</div></th> -->
				<th class="vertical"><div class="vertical">Score Grade</div></th>
				<th style='text-align:left; padding-left:10px;' class="hide-res">Subject <br />  Teacher's <br /> Remark</th>
				<!-- <th style='text-align:left; padding-left:10px;'>Subject <br />  Teacher's <br /> Signature</th> -->
				</tr>


IGWEZE;

			echo $table_body;
		
		
				/* select student first term result as array */
				
				$term = $fi_term; $promotionStatus = false;	$subfCounter = 0;	
		
        		require  $wizGradeClassConfigDir;   /* include class configuration script */ 				

			    $ebele_mark_1 = "SELECT r.nk_regno, f.$query_i_strings

                         	    FROM $i_reg_tb r INNER JOIN $sdoracle_sub_score_nk f
								
								ON (r.ireg_id = f.ireg_id)

                          		AND r.session_id = :session_id 
						 
						  		AND r.$nk_class = :class

				          		AND r.active = :foreal
						  
						  		AND r.nk_regno =  :nk_regno"; 
					 
 			    $igweze_prep_1 = $conn->prepare($ebele_mark_1);
  				$igweze_prep_1->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
				$igweze_prep_1->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep_1->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep_1->bindValue(':class', $class, PDO::PARAM_STR);				 
 				$igweze_prep_1->execute();
				
				$rows_count_1 = $igweze_prep_1->rowCount(); 
				
				if($rows_count_1 == $foreal) {  /* check array is empty */
				
					while($row_1[] = $igweze_prep_1->fetch(PDO::FETCH_BOTH)) {  /* loop array */ }	 
				
				}
				
				/* select student second term result as array */
				
				$term = $se_term; $promotionStatus = false;	$subfCounter = 0;	
		
        		require  $wizGradeClassConfigDir;   /* include class configuration script */ 	 

			    $ebele_mark_2 = "SELECT r.nk_regno, f.$query_i_strings

                         	    FROM $i_reg_tb r INNER JOIN $sdoracle_sub_score_nk f
								
								ON (r.ireg_id = f.ireg_id)

                          		AND r.session_id = :session_id 
						 
						  		AND r.$nk_class = :class

				          		AND r.active = :foreal
						  
						  		AND r.nk_regno =  :nk_regno"; 
					 
 			    $igweze_prep_2 = $conn->prepare($ebele_mark_2);
  				$igweze_prep_2->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
				$igweze_prep_2->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep_2->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep_2->bindValue(':class', $class, PDO::PARAM_STR);				 
 				$igweze_prep_2->execute();
				
				$rows_count_2 = $igweze_prep_2->rowCount(); 
				
				if($rows_count_2 == $foreal) {  /* check array is empty */
				
					while($row_2[] = $igweze_prep_2->fetch(PDO::FETCH_BOTH)) {  /* loop array */ }	
				
				}
				
				/* select student third term result as array */

				$term = $th_term; $promotionStatus = false;	$subfCounter = 0;	
		
        		require  $wizGradeClassConfigDir;	   /* include class configuration script */ 

			    $ebele_mark_3 = "SELECT r.nk_regno, f.$query_i_strings

                         	    FROM $i_reg_tb r INNER JOIN $sdoracle_sub_score_nk f
								
								ON (r.ireg_id = f.ireg_id)

                          		AND r.session_id = :session_id 
						 
						  		AND r.$nk_class = :class

				          		AND r.active = :foreal
						  
						  		AND r.nk_regno =  :nk_regno"; 
					 
 			    $igweze_prep_3 = $conn->prepare($ebele_mark_3);
  				$igweze_prep_3->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
				$igweze_prep_3->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep_3->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep_3->bindValue(':class', $class, PDO::PARAM_STR);				 
 				$igweze_prep_3->execute();
				
				$rows_count_3 = $igweze_prep_3->rowCount(); 
				
				if($rows_count_3 == $foreal) {  /* check array is empty */
				
					while($row_3[] = $igweze_prep_3->fetch(PDO::FETCH_BOTH))  {  /* loop array */ }	
				
				}
				
			   	$f = 0; 	 $c = 0;   
	   			$c = ($i_stop_loop * 2) + 1;
	   
				$p = $i_stop_loop + 2;
       			$countNum = $foreal;
				$courseNumC = $i_false;
				$subArr = $i_start_loop; $m_i = 1;
				
				
	   			for ($i = $i_start_loop; $i <= $i_stop_loop; $i++) {  /* loop array */
					
					$CourseNum = $countNum++;	
					$serialNo++;
					
					$fiTermTotal = $row_1[$f][$i];
					$seTermTotal = $row_2[$f][$i];
					$thTermTotal = $row_3[$f][$i];
					
					if($fiTermTotal >= $fiVal){ $fiTermDiv = $fiVal; $courseNumC++;}
					else{$fiTermDiv = $i_false; $fiTermTotal = "-"; }
					
					if($seTermTotal >= $fiVal){ $seTermDiv = $fiVal; $courseNumC++;}
					else{$seTermDiv = $i_false; $seTermTotal = "-";}
					
					if($thTermTotal >= $fiVal){ $thTermDiv = $fiVal; $courseNumC++;}
					else{$thTermDiv = $i_false; $thTermTotal = "-"; }
					
					$subAnnualDiv = ($fiTermDiv + $seTermDiv + $thTermDiv);
					$subAnnualTotal = ($fiTermTotal + $seTermTotal + $thTermTotal);
					
					if (($subAnnualTotal > $fiVal) && ($subAnnualDiv > $fiVal)) {
						
						$subAnnualAvg = ($subAnnualTotal/$subAnnualDiv);					
						$subAnnualAvg = number_format($subAnnualAvg, 1);
						
						$gradeRemarkAbbr = wizGradeGradeScore($gradeArray, $subAnnualAvg); /* student grades score */
						$gradeRemark = teacherGradeRemarks($subAnnualAvg); /* teacher grade remarks */ 
					
					}else{ $subAnnualAvg = " - "; $subAnnualTotal = " - "; $gradeRemarkAbbr = " - "; $gradeRemark = " - "; }
					
					
					
       				echo "<tr><td align = 'center'>$serialNo</td >
					<td style='text-align:left; padding-left:10px;'>";
       				echo $course_info_mark[$subArr][2];					
       				echo "</td><td align = 'center'>";
       				echo  $fiTermTotal;
	   				echo "</td><td align = 'center'>";
					echo  $seTermTotal;
	   				echo "</td><td align = 'center'>";
					echo  $thTermTotal;
	   				echo "</td><td align = 'center'>";
					echo  $subAnnualTotal;
	   				echo "</td><td align = 'center'>";
					echo  $subAnnualAvg;
	   				echo "</td><!-- <td align = 'center'>";
					echo  "&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;";
	   				echo "</td>--> <td align = 'center'>&nbsp;&nbsp;";
					echo  $gradeRemarkAbbr;
	   				echo "&nbsp;&nbsp;</td><td style='text-align:left; padding-left:10px;' class='hide-res'>";
					echo  $gradeRemark;
	   				echo "</td><!-- <td style='text-align:left; padding-left:10px;'>";
					echo  " - ";
	   				echo "</td>-->";

	   				echo "</tr>";
					
					$fiTermAnnTotal += $fiTermTotal;
					$seTermAnnTotal += $seTermTotal;
					$thTermAnnTotal += $thTermTotal;
					
					$annualTotala += $subAnnualTotal; 
	   
	   				if ($i_score_gr == 'F'){ $f_gr = $f_gr + 1; }
	   				if ($i_score_gr == 'D7'){ $d_gr = $d_gr + 1; }
	   				if ($i_score_gr == 'E8'){ $e_gr = $e_gr + 1; }
					
					$subAnnualTotal = ""; $subAnnualDiv = ""; $gradeRemark = ""; $gradeRemarkAbbr = "";
	   
	   				$subArr++;
					$i_score = '';
	   				$p = $p + 1;
	   				$field  = '';
	   				$c = $c + 1;
	   				$i_max_score = ''; 
	 	   
				}
			
				if($fiTermAnnTotal >= $fiVal){ $fiAnnDiv = $fiVal;}
				else{$fiAnnDiv = $i_false; $fiTermTotal = "0"; }
				
				if($seTermAnnTotal >= $fiVal){ $seAnnDiv = $fiVal;}
				else{$seAnnDiv = $i_false; $seTermTotal = "0";}
				
				if($thTermAnnTotal >= $fiVal){ $thAnnDiv = $fiVal;}
				else{$thAnnDiv = $i_false; $thTermTotal = "0"; } 
				
				$annualDiv = ($fiAnnDiv + $seAnnDiv + $thAnnDiv);
				$annualTotal = ($fiTermAnnTotal + $seTermAnnTotal + $thTermAnnTotal); 
				
				$annualAvg = ($annualTotal/$annualDiv);
				
				$annualAvg = number_format($annualAvg, 1);
				
				$annualAverage = ($annualTotal/$courseNumC);
				
				$annualAverage = number_format($annualAverage, 1); 
				
				echo "<tr><td style='text-align:left; padding-left:10px;'>";
								
				echo "</td><th style='text-align:right; padding-right:30px;'>Grand Total</th><td align = 'center'>";
				echo  $fiTermAnnTotal;
				echo "</td><td align = 'center'>";
				echo  $seTermAnnTotal;
				echo "</td><td align = 'center'>";
				echo  $thTermAnnTotal;
				echo "</td><td align = 'center'>";
				echo  "$annualTotal";
				echo "</td><td align = 'center'>";
				echo  $annualAvg;
				echo "</td><td colspan='3'></td>";	  

				echo "</tr>"; 

       			$f = $f + 1;
 
	   			$p = '';
      			
       			echo "</table><!-- / table -->"; 
	   			
				$classNum = studentClassCount($conn, $sessionID, $class, $level);  /* count student class */
				$next_begin = termStartDate($conn, $sessionID, $term);  /* retrieve school next term start  */
				$gsRemarkArray = teacherRemarksArrays($conn);  /* teacher remarks array */ 
			
				$ebele_mark = "SELECT r.nk_regno, c.$comment_r, $comment_t, $pr_comment_r

								FROM $i_reg_tb r INNER JOIN $sdoracle_student_remark_nk c
							
								ON (r.ireg_id = c.ireg_id)

                          		AND r.session_id = :session_id 
						 
						  		AND r.$nk_class = :class

				          		AND r.active = :foreal
						  
						  		AND r.nk_regno =  :nk_regno"; 
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {  /* check array is empty */
				
					while($row = $igweze_prep->fetch(PDO::FETCH_BOTH)) {  /* loop array */		
	   
        				$comment = $row[$comment_r];
						$ftRemark = $row[$comment_t];
						$pr_comment = $row[$pr_comment_r];
													
					}	 
				
				} 
				
				$ebele_mark_4 = "SELECT r.nk_regno, f.$query_i_strings_nj

								FROM $i_reg_tb r INNER JOIN $sdoracle_grand_score_nk f
							
								ON (r.ireg_id = f.ireg_id)

                          		AND r.session_id = :session_id 
						 
						  		AND r.$nk_class = :class

				          		AND r.active = :foreal
						  
						  		AND r.nk_regno = :nk_regno"; 
					 
 			    $igweze_prep_4 = $conn->prepare($ebele_mark_4);
  				$igweze_prep_4->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
				$igweze_prep_4->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep_4->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep_4->bindValue(':class', $class, PDO::PARAM_STR);
				 
 				$igweze_prep_4->execute();
				
				$rows_count_4 = $igweze_prep_4->rowCount(); 
				
				if($rows_count_4 == $foreal) {  /* check array is empty */
				
					while($row_4 = $igweze_prep_4->fetch(PDO::FETCH_BOTH)) {  /* loop array */		

			   	     	/*
							$total_score = $row_4[1]; 
							$student_avg = $row_4[2]; 
							$student_poistion = $row_4[3]; 
							$session_total = $row_4[4]; 
						*/
						$session_avg = $row_4[5]; 
						$session_poistion = $row_4[6]; 

					}	
				
				}
				
				$principalData = staffData($conn, $schoolHead);  /* school staffs/teachers information */
				list ($princ_title, $princ_fullname, $princ_sex, $princ_rankingVal, $princ_picture, 
					  $princ_lname, $princ_phone, $princ_sign) = explode ("#@s@#", $principalData);
	
				$titleVal = $title_list[$princ_title];
				$schoolPrincipal = $titleVal.' '.$princ_fullname;
								
				$formTeacher = formTeacher($conn, $sessionID, $level, $class);  /* retrieve assign class teacher information */
				
				$formTeacherSign = formTeacherSignatures($conn, $sessionID, $level, $class); /* retrieve assign class teacher signature */

			    //$gsRemark = $i_teachers_remark_list[$comment];
				
				$gsRemark = $gsRemarkArray[$comment]['name'];

	   		    $principal_remark = wizGradePrincipalRemarks($annualAvg, $d_gr, $e_gr, $f_gr); /* principal auto remarks */
				
				if($pr_comment != ''){
					
					$principal_remark = $pr_comment;
					
				} 

				$principalSign = $teachersSignExt.$princ_sign;

				if ((is_null($princ_sign)) || ($princ_sign == '') || (!file_exists($principalSign))){ $principalSign = ''; }					
				else{ $principalSign = '<img src="'.$principalSign.'" style="height: 50px; width:100px; margin-top:0px;">'; } 
				
				$annualPoistion = studentPostionSup($session_poistion);  /* student result position suffix  */
				
				$promotedSub = classPromotionManager($conn, $sdoracle_grand_score_nk, $regNum);  /* school class student promotion manager */
				
				echo $rsAdsFooter; 
	   
$table_foot =<<<IGWEZE
                         
				<!-- table -->
				<table width="100%" border="0" style="border-color:#fff; margin-top: 0px; font-size:14px;" 
				align="center" class="display table table-bordered table-striped">
				  
				<tr style="border-color:#fff;">
					<td width="50%"  style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;"><span class="hide-res">Student's</span> Annual Total Score : 
					<span class="tb-caption"> $annualTotal </span></td>
					<td width="50%" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;"><span class="hide-res">Student's</span> Annual Average: 
					<span class="tb-caption"> $annualAverage </span></td>
				</tr>
				  
				<tr style="border-color:#fff;">
					<td width="50%"  style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">No of Students  
					<span class="tb-caption"> $classNum </span></td>
					<td width="50%" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">Annual Position <span class="hide-res"> in Class</span> :
					<span class="tb-caption"> $annualPoistion </span></td>
				</tr>
				<!--
				<tr style="border-color:#fff;" class="hide-res">
					<td colspan="2" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold;"> Guidance &amp; Counsellor's Name :
					 <span class="tb-caption"> $gcTeacher </span>  </td>

				</tr>

				<tr class="hide-res">
					<td width="50%" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">
					Guidance &amp; Counsellor's Comments : 
					<span class="tb-caption"> $gsRemark  </span> </td>
					<td width="50%" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">Signature 	_____________________________ </td>
				</tr>
				-->
				<tr style="border-color:#fff;" class="hide-res">
					<td colspan="2" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold;">Form Teacher Name :
					 <span class="tb-caption"> $formTeacher </span>  </td>

				</tr> 

				<tr class="hide-res">
					<td width="50%" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">Form Teacher Comments : 
					<span class="tb-caption"> $ftRemark  </span> </td>
					<td width="50%" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">
					Signature $formTeacherSign </td>
				</tr>


				<tr class="hide-res">
					<td colspan="2" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold;">Principal Name : 
					<span class="tb-caption"> $schoolPrincipal </span> </td>
				</tr>

				<tr>
					<td width="50%" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">Principal Comments  : 
					<span class="tb-caption"> $promotedSub  </span> </td>
					<td width="50%" style="text-align:left; padding: 5px; border-color:#fff; font-weight:bold; border-bottom-color:#000;">Signature 
					$principalSign </td>
				</tr>

			 
				</table>            
				<!-- /table -->

IGWEZE;

				echo $table_foot; 

				echo "
				     
                </div>";	 

?> 