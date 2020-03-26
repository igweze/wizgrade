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
	This script load student level and class configurations
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		require ($wizGradevalidater);
		
        $f = $inti_result_loop_arr;
		$level = trim($level);
		
		switch ($level) {
										
			case '1':  /* if 100 level load this configurations */

					$sdoracle_score_nk = $class_one_sdoracle_score_tb;          
					$sdoracle_sub_score_nk = $class_one_sub_score_tb;          
					$sdoracle_grade_nk = $class_one_sdoracle_grade_tb;  
					$sdoracle_comment_nk = $class_one_sdoracle_comment_tb;	
					$sdoracle_grand_score_nk = $class_one_sdoracle_grand_score_tb;   
					
					$i_grade_grand = $i_class_one_grading_scale;
					$sdoracle_student_remark_nk = $class_one_class_remarks_tb;       
					$course_info_mark = $i_class_one_course_info;
					$course_info_igweze = $i_class_one_course_info_coc;
					
					$nk_class = 'class_1';
					$cal_session = false;
					$stu_class = $schoolTypeSD.' 1';

					$fiGrandTotal = $i_grade_grand[1];
					$seGrandTotal = $i_grade_grand[4];
					$thGrandTotal = $i_grade_grand[7];
					$grandTotal = $i_grade_grand[10];
					$grandAvg = $i_grade_grand[11];
					
					$fiGrandAvg = $i_grade_grand[2];
					$seGrandAvg = $i_grade_grand[5];
					$thGrandAvg = $i_grade_grand[8];
					

					if (($level == $fi_level) && ($term == $fi_term)) {  /* check if first term */ 

						$start_nkiru = $i_fi_start_class_one_fi_term;
						$stop_njideka = $i_fi_last_class_one_fi_term;	    
						$term_value = 'First Term'; $term_code = $fi_term_code;
						$query_i_scores = $query_select_class_one_fi_term;
						$query_i_strings = $query_select_class_one_fi_term_to;
						$query_i_strings_nk = $query_select_class_one_fi_term_po;
						$query_i_strings_com = $query_select_class_one_fi_term_com;
						$query_i_strings_nj = $query_select_class_one_fi_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_one_fi_term; 
						$is_certify_arr_no = $is_certify_arr_class_one_fi_term;			
						$conducts_field = "att_fi, conduct_fi, sports_fi, organ_fi, comment_fi, tcom_fi, princ_fi";
						$attendance_r = 'att_fi'; $conducts_r = 'conduct_fi'; $sports_r = 'sports_fi'; 
						$organization_r = 'organ_fi'; $comment_r ='comment_fi'; $comment_t ='tcom_fi'; $pr_comment_r ='princ_fi';
						$term_score = 'jemji_to_fi'; $term_avg = 'jemji_gr_fi'; $term_position = 'jemji_po_fi';
						
						$attrib = 'fi_term';
						
						$i_ggr = 2; $i_gpo = 3;
						
						$cal_session = false;

					}elseif (($level == $fi_level) && ($term == $se_term)){  /* check if second term */
				
						$start_nkiru = $i_se_start_class_one_se_term; 
						$stop_njideka = $i_se_last_class_one_se_term;	    
						$term_value = 'Second Term'; $term_code = $se_term_code;
						$query_i_scores = $query_select_class_one_se_term;
						$query_i_strings = $query_select_class_one_se_term_to;
						$query_i_strings_nk = $query_select_class_one_se_term_po;
						$query_i_strings_com = $query_select_class_one_se_term_com;
						$query_i_strings_nj = $query_select_class_one_se_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_one_se_term; 
						$is_certify_arr_no = $is_certify_arr_class_one_se_term;
						$conducts_field = "att_se, conduct_se, sports_se, organ_se, comment_se, tcom_se, princ_se";
						$attendance_r = 'att_se'; $conducts_r = 'conduct_se'; $sports_r = 'sports_se'; $organization_r = 'organ_se'; 
						$comment_r ='comment_se';  $comment_t = 'tcom_se'; $pr_comment_r ='princ_se';
						$term_score = 'jiemj_to_fi'; $term_avg = 'jiemj_gr_fi'; $term_position = 'jiemj_po_fi';
						
						$attrib = 'se_term';
						
						$i_ggr = 5; $i_gpo = 6;
						
						$cal_session = false;
						
					
					}elseif (($level == $fi_level) && ($term == $th_term)){  /* check if second term */
				
						$start_nkiru = $i_th_start_class_one_th_term;
						$stop_njideka = $i_th_last_class_one_th_term;	    
						$term_value = 'Third Term'; $term_code = $th_term_code;
						$query_i_scores = $query_select_class_one_th_term;
						$query_i_strings = $query_select_class_one_th_term_to;
						$query_i_strings_nk = $query_select_class_one_th_term_po;
						$query_i_strings_com = $query_select_class_one_th_term_com;
						$query_i_strings_nj = $query_select_class_one_th_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_one_th_term; 
						$is_certify_arr_no = $is_certify_arr_class_one_th_term;
						$conducts_field = "att_th, conduct_th, sports_th, organ_th, comment_th, tcom_th, princ_th";
						$attendance_r = 'att_th'; $conducts_r = 'conduct_th'; $sports_r = 'sports_th'; $organization_r = 'organ_th'; 
						$comment_r ='comment_th';  $comment_t = 'tcom_th'; $pr_comment_r ='princ_th';
						$term_score = 'jmeji_to_fi'; $term_avg ='jmeji_gr_fi'; $term_position = 'jmeji_po_fi';
						
						$attrib = 'th_term';
						
						$i_ggr = 8; $i_gpo = 9;
						
						$ji_ggr = 11; $ji_gpo = 12;
						
						$cal_session = true;

					}else{  /* else display critical error */
					
						$cal_session = false;
					
						$msg_e = "*Ooooooops, a Critcal Error has Occured, Please contact the developers. Thanks.";
						echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 			

					
					}
					
					
					$nj_position = $i_grade_grand[$i_gpo];
					$nj_grade = $i_grade_grand[$i_ggr];			

			break;
			
			case '2':  /* if 200 level load this configurations */

					$sdoracle_score_nk = $class_two_sdoracle_score_tb;          
					$sdoracle_sub_score_nk = $class_two_sub_score_tb;          
					$sdoracle_grade_nk = $class_two_sdoracle_grade_tb;      
					$sdoracle_comment_nk = $class_two_sdoracle_comment_tb;	
					$sdoracle_grand_score_nk = $class_two_sdoracle_grand_score_tb;   
					
					$i_grade_grand = $i_class_two_grading_scale;       
					$sdoracle_student_remark_nk = $class_two_class_remarks_tb;       
					$course_info_mark = $i_class_two_course_info;
					$course_info_igweze = $i_class_two_course_info_coc;
					
					$nk_class = 'class_2';
					$cal_session = false;
					$stu_class = $schoolTypeSD.' 2';

					$fiGrandTotal = $i_grade_grand[1];
					$seGrandTotal = $i_grade_grand[4];
					$thGrandTotal = $i_grade_grand[7];
					$grandTotal = $i_grade_grand[10];
					$grandAvg = $i_grade_grand[11];
					
					$fiGrandAvg = $i_grade_grand[2];
					$seGrandAvg = $i_grade_grand[5];
					$thGrandAvg = $i_grade_grand[8];
					 
					
					if (($level == $se_level) && ($term == $fi_term)) {  /* check if first term */

						$start_nkiru = $i_fi_start_class_two_fi_term;
						$stop_njideka = $i_fi_last_class_two_fi_term;	    
						$term_value = 'First Term'; $term_code = $fi_term_code;
						$query_i_scores = $query_select_class_two_fi_term;
						$query_i_strings = $query_select_class_two_fi_term_to;
						$query_i_strings_nk = $query_select_class_two_fi_term_po;
						$query_i_strings_com = $query_select_class_two_fi_term_com;
						$query_i_strings_nj = $query_select_class_two_fi_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_two_fi_term; 
						$is_certify_arr_no = $is_certify_arr_class_two_fi_term;

						$conducts_field = "att_fi, conduct_fi, sports_fi, organ_fi, comment_fi, tcom_fi, princ_fi";
						$attendance_r = 'att_fi'; $conducts_r = 'conduct_fi'; $sports_r = 'sports_fi'; 
						$organization_r = 'organ_fi'; $comment_r ='comment_fi'; $comment_t = 'tcom_fi'; $pr_comment_r ='princ_fi';

						$term_score = 'jemji_to_se'; $term_avg = 'jemji_gr_se'; $term_position = 'jemji_po_se';
						
						$attrib = 'fi_term';
						
						$i_ggr = 2; $i_gpo = 3;
						
						$cal_session = false;

					}elseif (($level == $se_level) && ($term == $se_term)){  /* check if second term */
				
						$start_nkiru = $i_se_start_class_two_se_term; 
						$stop_njideka = $i_se_last_class_two_se_term;	    
						$term_value = 'Second Term'; $term_code = $se_term_code;
						$query_i_scores = $query_select_class_two_se_term;
						$query_i_strings = $query_select_class_two_se_term_to;
						$query_i_strings_nk = $query_select_class_two_se_term_po;
						$query_i_strings_com = $query_select_class_two_se_term_com;
						$query_i_strings_nj = $query_select_class_two_se_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_two_se_term;
						$is_certify_arr_no = $is_certify_arr_class_two_se_term;
						$conducts_field = "att_se, conduct_se, sports_se, organ_se, comment_se, tcom_se, princ_se";
						$attendance_r = 'att_se'; $conducts_r = 'conduct_se'; $sports_r = 'sports_se'; $organization_r = 'organ_se'; 
						$comment_r ='comment_se';  $comment_t = 'tcom_se'; $pr_comment_r ='princ_se';
						$term_score = 'jiemj_to_se'; $term_avg = 'jiemj_gr_se'; $term_position = 'jiemj_po_se';
						
						$i_ggr = 5; $i_gpo = 6;
						
						$attrib = 'se_term';
						$cal_session = false;
						
					
					}elseif (($level == $se_level) && ($term == $th_term)){  /* check if second term */
				
						$start_nkiru = $i_th_start_class_two_th_term;
						$stop_njideka = $i_th_last_class_two_th_term;	    
						$term_value = 'Third Term'; $term_code = $th_term_code;
						$query_i_scores = $query_select_class_two_th_term;
						$query_i_strings = $query_select_class_two_th_term_to;
						$query_i_strings_nk = $query_select_class_two_th_term_po;
						$query_i_strings_com = $query_select_class_two_th_term_com;
						$query_i_strings_nj = $query_select_class_two_th_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_two_th_term; 
						$is_certify_arr_no = $is_certify_arr_class_two_th_term;
						$conducts_field = "att_th, conduct_th, sports_th, organ_th, comment_th, tcom_th, princ_th";
						$attendance_r = 'att_th'; $conducts_r = 'conduct_th'; $sports_r = 'sports_th'; $organization_r = 'organ_th'; 
						$comment_r ='comment_th';  $comment_t = 'tcom_th'; $pr_comment_r ='princ_th';
						$term_score = 'jmeji_to_se'; $term_avg = 'jmeji_gr_se'; $term_position = 'jmeji_po_se';
						
						$i_ggr = 8; $i_gpo = 9;
						
						$ji_ggr = 11; $ji_gpo = 12;
						
						$attrib = 'th_term';
						
						$cal_session = true;

					}else{  /* else display critical error */
					
						$cal_session = false;
					
						$msg_e = "*Ooooooops, a Critcal Error has Occured, Please contact the developers. Thanks.";
						echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 			

					
					}
					
					
					$nj_position = $i_grade_grand[$i_gpo];
					$nj_grade = $i_grade_grand[$i_ggr];


			break;
			
			case '3':  /* if 300 level load this configurations */

					$sdoracle_score_nk = $class_three_sdoracle_score_tb;          
					$sdoracle_sub_score_nk = $class_three_sub_score_tb;          
					$sdoracle_grade_nk = $class_three_sdoracle_grade_tb; 
					$sdoracle_comment_nk = $class_three_sdoracle_comment_tb;	
					$sdoracle_grand_score_nk = $class_three_sdoracle_grand_score_tb;   
					
					$i_grade_grand = $i_class_three_grading_scale;   
					$sdoracle_student_remark_nk = $class_three_class_remarks_tb;           
					$course_info_mark = $i_class_three_course_info;
					$course_info_igweze = $i_class_three_course_info_coc;
					
					$nk_class = 'class_3';
					$cal_session = false;
					$stu_class = $schoolTypeSD.' 3';

					$fiGrandTotal = $i_grade_grand[1];
					$seGrandTotal = $i_grade_grand[4];
					$thGrandTotal = $i_grade_grand[7];
					$grandTotal = $i_grade_grand[10];
					$grandAvg = $i_grade_grand[11];
					 
					
					$fiGrandAvg = $i_grade_grand[2];
					$seGrandAvg = $i_grade_grand[5];
					$thGrandAvg = $i_grade_grand[8];

					if (($level == $th_level) && ($term == $fi_term)) {  /* check if first term */

						$start_nkiru = $i_fi_start_class_three_fi_term;
						$stop_njideka = $i_fi_last_class_three_fi_term;	    
						$term_value = 'First Term'; $term_code = $fi_term_code;
						$query_i_scores = $query_select_class_three_fi_term;
						$query_i_strings = $query_select_class_three_fi_term_to;
						$query_i_strings_nk = $query_select_class_three_fi_term_po;
						$query_i_strings_com = $query_select_class_three_fi_term_com;
						$query_i_strings_nj = $query_select_class_three_fi_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_three_fi_term; 
						$is_certify_arr_no = $is_certify_arr_class_three_fi_term;
						$conducts_field = "att_fi, conduct_fi, sports_fi, organ_fi, comment_fi, tcom_fi, princ_fi";
						$attendance_r = 'att_fi'; $conducts_r = 'conduct_fi'; $sports_r = 'sports_fi'; 
						$organization_r = 'organ_fi'; $comment_r ='comment_fi'; $comment_t = 'tcom_fi'; $pr_comment_r ='princ_fi';
						$term_score = 'jemji_to_th'; $term_avg = 'jemji_gr_th'; $term_position = 'jemji_po_th';
						
						
						$attrib = 'fi_term';
						
						$i_ggr = 2; $i_gpo = 3;
						
						$cal_session = false;

					}elseif (($level == $th_level) && ($term == $se_term)){  /* check if second term */
				
						$start_nkiru = $i_se_start_class_three_se_term; 
						$stop_njideka = $i_se_last_class_three_se_term;	    
						$term_value = 'Second Term'; $term_code = $se_term_code;
						$query_i_scores = $query_select_class_three_se_term;
						$query_i_strings = $query_select_class_three_se_term_to;
						$query_i_strings_nk = $query_select_class_three_se_term_po;
						$query_i_strings_com = $query_select_class_three_se_term_com;
						$query_i_strings_nj = $query_select_class_three_se_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_three_se_term; 
						$is_certify_arr_no = $is_certify_arr_class_three_se_term;
						$conducts_field = "att_se, conduct_se, sports_se, organ_se, comment_se, tcom_se, princ_se";
						$attendance_r = 'att_se'; $conducts_r = 'conduct_se'; $sports_r = 'sports_se'; $organization_r = 'organ_se'; 
						$comment_r ='comment_se';  $comment_t = 'tcom_se'; $pr_comment_r ='princ_se';
						$term_score = 'jiemj_to_th'; $term_avg = 'jiemj_gr_th'; $term_position = 'jiemj_po_th';
						
						$attrib = 'se_term';
						
						$i_ggr = 5; $i_gpo = 6;
						
						$cal_session = false;
						
					
					}elseif (($level == $th_level) && ($term == $th_term)){  /* check if second term */
				
						$start_nkiru = $i_th_start_class_three_th_term;
						$stop_njideka = $i_th_last_class_three_th_term;	    
						$term_value = 'Third Term'; $term_code = $th_term_code;
						$query_i_scores = $query_select_class_three_th_term;
						$query_i_strings = $query_select_class_three_th_term_to;
						$query_i_strings_nk = $query_select_class_three_th_term_po;
						$query_i_strings_com = $query_select_class_three_th_term_com;
						$query_i_strings_nj = $query_select_class_three_th_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_three_th_term; 
						$is_certify_arr_no = $is_certify_arr_class_three_th_term;
						$conducts_field = "att_th, conduct_th, sports_th, organ_th, comment_th, tcom_th, princ_th";
						$attendance_r = 'att_th'; $conducts_r = 'conduct_th'; $sports_r = 'sports_th'; $organization_r = 'organ_th'; 
						$comment_r ='comment_th';  $comment_t = 'tcom_th'; $pr_comment_r ='princ_th';
						$term_score = 'jmeji_to_th'; $term_avg = 'jmeji_gr_th'; $term_position = 'jmeji_po_th';
						
						$i_ggr = 8; $i_gpo = 9;
						
						$ji_ggr = 11; $ji_gpo = 12;
						
						$attrib = 'th_term';
						
						$cal_session = true;

					}else{  /* else display critical error */
					
						$cal_session = false;
					
						$msg_e = "*Ooooooops, a Critcal Error has Occured, Please contact the developers. Thanks.";
						echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 			

					
					}
					
					
					$nj_position = $i_grade_grand[$i_gpo];
					$nj_grade = $i_grade_grand[$i_ggr];
			

			break;

			case '4':  /* if 400 level load this configurations */

					$sdoracle_score_nk = $class_four_sdoracle_score_tb;          
					$sdoracle_sub_score_nk = $class_four_sub_score_tb;
					$sdoracle_grade_nk = $class_four_sdoracle_grade_tb;
					$sdoracle_comment_nk = $class_four_sdoracle_comment_tb;	
					$sdoracle_grand_score_nk = $class_four_sdoracle_grand_score_tb;   
					
					$i_grade_grand = $i_class_four_grading_scale;
					$sdoracle_student_remark_nk = $class_four_class_remarks_tb; 

					$nk_class = 'class_4';
					$cal_session = false;
					$stu_class = $schoolTypeSD.' 4';

					$fiGrandTotal = $i_grade_grand[1];
					$seGrandTotal = $i_grade_grand[4];
					$thGrandTotal = $i_grade_grand[7];
					$grandTotal = $i_grade_grand[10];
					$grandAvg = $i_grade_grand[11]; 
					
					$fiGrandAvg = $i_grade_grand[2];
					$seGrandAvg = $i_grade_grand[5];
					$thGrandAvg = $i_grade_grand[8];
					
						
					$course_info_mark = $i_class_four_course_info;
					$course_info_igweze = $i_class_four_course_info_coc;
					
					
					if (($level == $fo_level) && ($term == $fi_term)) {  /* check if first term */

						$start_nkiru = $i_fi_start_class_four_fi_term;
						$stop_njideka = $i_fi_last_class_four_fi_term;	  
						$term_value = 'First Term'; $term_code = $fi_term_code;
						$query_i_scores = $query_select_class_four_fi_term;
						$query_i_strings = $query_select_class_four_fi_term_to;
						$query_i_strings_nk = $query_select_class_four_fi_term_po;
						$query_i_strings_com = $query_select_class_four_fi_term_com;
						$query_i_strings_nj = $query_select_class_four_fi_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_four_fi_term; 
						$is_certify_arr_no = $is_certify_arr_class_four_fi_term;			
						$conducts_field = "att_fi, conduct_fi, sports_fi, organ_fi, comment_fi, tcom_fi, princ_fi";
						$attendance_r = 'att_fi'; $conducts_r = 'conduct_fi'; $sports_r = 'sports_fi'; 
						$organization_r = 'organ_fi'; $comment_r ='comment_fi'; $comment_t = 'tcom_fi'; $pr_comment_r ='princ_fi';
						$term_score = 'jemji_to_fo'; $term_avg = 'jemji_gr_fo'; $term_position = 'jemji_po_fo';
						
						$attrib = 'fi_term';
						
						$i_ggr = 2; $i_gpo = 3;
						
						$cal_session = false;

					}elseif (($level == $fo_level) && ($term == $se_term)){  /* check if second term */
				
						$start_nkiru = $i_se_start_class_four_se_term; 
						$stop_njideka = $i_se_last_class_four_se_term;	    
						$term_value = 'Second Term'; $term_code = $se_term_code;
						$query_i_scores = $query_select_class_four_se_term;
						$query_i_strings = $query_select_class_four_se_term_to;
						$query_i_strings_nk = $query_select_class_four_se_term_po;
						$query_i_strings_com = $query_select_class_four_se_term_com;
						$query_i_strings_nj = $query_select_class_four_se_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_four_se_term; 
						$is_certify_arr_no = $is_certify_arr_class_four_se_term;
						$conducts_field = "att_se, conduct_se, sports_se, organ_se, comment_se, tcom_se, princ_se";
						$attendance_r = 'att_se'; $conducts_r = 'conduct_se'; $sports_r = 'sports_se'; $organization_r = 'organ_se'; 
						$comment_r ='comment_se';  $comment_t = 'tcom_se'; $pr_comment_r ='princ_se';
						$term_score = 'jiemj_to_fo'; $term_avg = 'jiemj_gr_fo'; $term_position = 'jiemj_po_fo';
						
						$attrib = 'se_term';
						
						$i_ggr = 5; $i_gpo = 6;
						
						$cal_session = false;
						
					
					}elseif (($level == $fo_level) && ($term == $th_term)){  /* check if second term */
				
						$start_nkiru = $i_th_start_class_four_th_term;
						$stop_njideka = $i_th_last_class_four_th_term;	    
						$term_value = 'Third Term'; $term_code = $th_term_code;
						$query_i_scores = $query_select_class_four_th_term;
						$query_i_strings = $query_select_class_four_th_term_to;
						$query_i_strings_nk = $query_select_class_four_th_term_po;
						$query_i_strings_com = $query_select_class_four_th_term_com;
						$query_i_strings_nj = $query_select_class_four_th_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_four_th_term; 
						$is_certify_arr_no = $is_certify_arr_class_four_th_term;
						$conducts_field = "att_th, conduct_th, sports_th, organ_th, comment_th, tcom_th, princ_th";
						$attendance_r = 'att_th'; $conducts_r = 'conduct_th'; $sports_r = 'sports_th'; $organization_r = 'organ_th'; 
						$comment_r ='comment_th';  $comment_t = 'tcom_th'; $pr_comment_r ='princ_th';
						$term_score = 'jmeji_to_fo'; $term_avg ='jmeji_gr_fo'; $term_position = 'jmeji_po_fo';
						
						$attrib = 'th_term';
						
						$i_ggr = 8; $i_gpo = 9;
						
						$ji_ggr = 11; $ji_gpo = 12;
						
						$cal_session = true; 

					}else{  /* else display critical error */
					
						$cal_session = false;
					
						$msg_e = "*Ooooooops, a Critcal Error has Occured, Please contact the developers. Thanks.";
						echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 			

					
					}
					
					$nj_position = $i_grade_grand[$i_gpo];
					$nj_grade = $i_grade_grand[$i_ggr];


			break;
			
			case '5':  /* if 500 level load this configurations */

					$sdoracle_score_nk = $class_five_sdoracle_score_tb;          
					$sdoracle_sub_score_nk = $class_five_sub_score_tb;
					$sdoracle_grade_nk = $class_five_sdoracle_grade_tb;
					$sdoracle_comment_nk = $class_five_sdoracle_comment_tb;	
					$sdoracle_grand_score_nk = $class_five_sdoracle_grand_score_tb;   
					
					$i_grade_grand = $i_class_five_grading_scale;
					$sdoracle_student_remark_nk = $class_five_class_remarks_tb; 

					$nk_class = 'class_5';
					$cal_session = false;
					$stu_class = $schoolTypeSD.' 5';
					
					$fiGrandTotal = $i_grade_grand[1];
					$seGrandTotal = $i_grade_grand[4];
					$thGrandTotal = $i_grade_grand[7];
					$grandTotal = $i_grade_grand[10];
					$grandAvg = $i_grade_grand[11];
					 
					$fiGrandAvg = $i_grade_grand[2];
					$seGrandAvg = $i_grade_grand[5];
					$thGrandAvg = $i_grade_grand[8];
					

					$course_info_mark = $i_class_five_course_info;
					$course_info_igweze = $i_class_five_course_info_coc;
					
					
					if (($level == $fif_level) && ($term == $fi_term)) {  /* check if first term */

						$start_nkiru = $i_fi_start_class_five_fi_term;
						$stop_njideka = $i_fi_last_class_five_fi_term;	  
						$term_value = 'First Term'; $term_code = $fi_term_code;
						$query_i_scores = $query_select_class_five_fi_term;
						$query_i_strings = $query_select_class_five_fi_term_to;
						$query_i_strings_nk = $query_select_class_five_fi_term_po;
						$query_i_strings_com = $query_select_class_five_fi_term_com;
						$query_i_strings_nj = $query_select_class_five_fi_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_five_fi_term; 
						$is_certify_arr_no = $is_certify_arr_class_five_fi_term;			
						$conducts_field = "att_fi, conduct_fi, sports_fi, organ_fi, comment_fi, tcom_fi, princ_fi";
						$attendance_r = 'att_fi'; $conducts_r = 'conduct_fi'; $sports_r = 'sports_fi'; 
						$organization_r = 'organ_fi'; $comment_r ='comment_fi'; $comment_t = 'tcom_fi'; $pr_comment_r ='princ_fi';
						$term_score = 'jemji_to_fif'; $term_avg = 'jemji_gr_fif'; $term_position = 'jemji_po_fif';
						
						$attrib = 'fi_term';
						
						$i_ggr = 2; $i_gpo = 3;
						
						$cal_session = false;

					}elseif (($level == $fif_level) && ($term == $se_term)){  /* check if second term */
				
						$start_nkiru = $i_se_start_class_five_se_term; 
						$stop_njideka = $i_se_last_class_five_se_term;	    
						$term_value = 'Second Term'; $term_code = $se_term_code;
						$query_i_scores = $query_select_class_five_se_term;
						$query_i_strings = $query_select_class_five_se_term_to;
						$query_i_strings_nk = $query_select_class_five_se_term_po;
						$query_i_strings_com = $query_select_class_five_se_term_com;
						$query_i_strings_nj = $query_select_class_five_se_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_five_se_term; 
						$is_certify_arr_no = $is_certify_arr_class_five_se_term;
						$conducts_field = "att_se, conduct_se, sports_se, organ_se, comment_se, tcom_se, princ_se";
						$attendance_r = 'att_se'; $conducts_r = 'conduct_se'; $sports_r = 'sports_se'; $organization_r = 'organ_se'; 
						$comment_r ='comment_se';  $comment_t = 'tcom_se'; $pr_comment_r ='princ_se';
						$term_score = 'jiemj_to_fif'; $term_avg = 'jiemj_gr_fif'; $term_position = 'jiemj_po_fif';
						
						$attrib = 'se_term';
						
						$i_ggr = 5; $i_gpo = 6;
						
						$cal_session = false;
						
					
					}elseif (($level == $fif_level) && ($term == $th_term)){  /* check if second term */
				
						$start_nkiru = $i_th_start_class_five_th_term;
						$stop_njideka = $i_th_last_class_five_th_term;	    
						$term_value = 'Third Term'; $term_code = $th_term_code;
						$query_i_scores = $query_select_class_five_th_term;
						$query_i_strings = $query_select_class_five_th_term_to;
						$query_i_strings_nk = $query_select_class_five_th_term_po;
						$query_i_strings_com = $query_select_class_five_th_term_com;
						$query_i_strings_nj = $query_select_class_five_th_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = 
						$i_stop_loop_class_five_th_term; $is_certify_arr_no = $is_certify_arr_class_five_th_term;
						$conducts_field = "att_th, conduct_th, sports_th, organ_th, comment_th, tcom_th, princ_th";
						$attendance_r = 'att_th'; $conducts_r = 'conduct_th'; $sports_r = 'sports_th'; $organization_r = 'organ_th'; 
						$comment_r ='comment_th';  $comment_t = 'tcom_th'; $pr_comment_r ='princ_th';
						$term_score = 'jmeji_to_fif'; $term_avg ='jmeji_gr_fif'; $term_position = 'jmeji_po_fif';
						
						$attrib = 'th_term';
						
						$i_ggr = 8; $i_gpo = 9;
						
						$ji_ggr = 11; $ji_gpo = 12;
						
						$cal_session = true;

					}else{  /* else display critical error */
					
						$cal_session = false;
					
						$msg_e = "*Ooooooops, a Critcal Error has Occured, Please contact the developers. Thanks.";
						echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 			

					
					}

					
					
					$nj_position = $i_grade_grand[$i_gpo];
					$nj_grade = $i_grade_grand[$i_ggr];



			break;

			case '6':  /* if 600 level load this configurations */

					$sdoracle_score_nk = $class_six_sdoracle_score_tb;          
					$sdoracle_sub_score_nk = $class_six_sub_score_tb;
					$sdoracle_grade_nk = $class_six_sdoracle_grade_tb;
					$sdoracle_comment_nk = $class_six_sdoracle_comment_tb;	
					$sdoracle_grand_score_nk = $class_six_sdoracle_grand_score_tb;   
					
					$i_grade_grand = $i_class_six_grading_scale;
					$sdoracle_student_remark_nk = $class_six_class_remarks_tb; 

					$nk_class = 'class_6';
					$cal_session = false;
					$stu_class = $schoolTypeSD.' 6';
					
					$fiGrandTotal = $i_grade_grand[1];
					$seGrandTotal = $i_grade_grand[4];
					$thGrandTotal = $i_grade_grand[7];
					$grandTotal = $i_grade_grand[10];
					$grandAvg = $i_grade_grand[11]; 
					
					$fiGrandAvg = $i_grade_grand[2];
					$seGrandAvg = $i_grade_grand[5];
					$thGrandAvg = $i_grade_grand[8];
					

					$course_info_mark = $i_class_six_course_info;
					$course_info_igweze = $i_class_six_course_info_coc;
					
					
					if (($level == $six_level) && ($term == $fi_term)) {  /* check if first term */

						$start_nkiru = $i_fi_start_class_six_fi_term;
						$stop_njideka = $i_fi_last_class_six_fi_term;	  
						$term_value = 'First Term'; $term_code = $fi_term_code;
						$query_i_scores = $query_select_class_six_fi_term;
						$query_i_strings = $query_select_class_six_fi_term_to;
						$query_i_strings_nk = $query_select_class_six_fi_term_po;
						$query_i_strings_com = $query_select_class_six_fi_term_com;
						$query_i_strings_nj = $query_select_class_six_fi_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_six_fi_term; 
						$is_certify_arr_no = $is_certify_arr_class_six_fi_term;			
						$conducts_field = "att_fi, conduct_fi, sports_fi, organ_fi, comment_fi, tcom_fi, princ_fi";
						$attendance_r = 'att_fi'; $conducts_r = 'conduct_fi'; $sports_r = 'sports_fi'; 
						$organization_r = 'organ_fi'; $comment_r ='comment_fi'; $comment_t = 'tcom_fi'; $pr_comment_r ='princ_fi';
						$term_score = 'jemji_to_six'; $term_avg = 'jemji_gr_six'; $term_position = 'jemji_po_six';
						
						$attrib = 'fi_term';
						
						$i_ggr = 2; $i_gpo = 3;
						
						$cal_session = false;

					}elseif (($level == $six_level) && ($term == $se_term)){  /* check if second term */
				
						$start_nkiru = $i_se_start_class_six_se_term; 
						$stop_njideka = $i_se_last_class_six_se_term;	    
						$term_value = 'Second Term'; $term_code = $se_term_code;
						$query_i_scores = $query_select_class_six_se_term;
						$query_i_strings = $query_select_class_six_se_term_to;
						$query_i_strings_nk = $query_select_class_six_se_term_po;
						$query_i_strings_com = $query_select_class_six_se_term_com;
						$query_i_strings_nj = $query_select_class_six_se_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = $i_stop_loop_class_six_se_term; 
						$is_certify_arr_no = $is_certify_arr_class_six_se_term;
						$conducts_field = "att_se, conduct_se, sports_se, organ_se, comment_se, tcom_se, princ_se";
						$attendance_r = 'att_se'; $conducts_r = 'conduct_se'; $sports_r = 'sports_se'; $organization_r = 'organ_se'; 
						$comment_r ='comment_se';  $comment_t = 'tcom_se'; $pr_comment_r ='princ_se';
						$term_score = 'jiemj_to_six'; $term_avg = 'jiemj_gr_six'; $term_position = 'jiemj_po_six';
						
						$attrib = 'se_term';
						
						$i_ggr = 5; $i_gpo = 6;
						
						$cal_session = false;
						
					
					}elseif (($level == $six_level) && ($term == $th_term)){  /* check if second term */
				
						$start_nkiru = $i_th_start_class_six_th_term;
						$stop_njideka = $i_th_last_class_six_th_term;	    
						$term_value = 'Third Term'; $term_code = $th_term_code;
						$query_i_scores = $query_select_class_six_th_term;
						$query_i_strings = $query_select_class_six_th_term_to;
						$query_i_strings_nk = $query_select_class_six_th_term_po;
						$query_i_strings_com = $query_select_class_six_th_term_com;
						$query_i_strings_nj = $query_select_class_six_th_term_gran;
						$i_start_loop = $i_start_rs_loop; $i_stop_loop = 
						$i_stop_loop_class_six_th_term; $is_certify_arr_no = $is_certify_arr_class_six_th_term;
						$conducts_field = "att_th, conduct_th, sports_th, organ_th, comment_th, tcom_th, princ_th";
						$attendance_r = 'att_th'; $conducts_r = 'conduct_th'; $sports_r = 'sports_th'; $organization_r = 'organ_th'; 
						$comment_r ='comment_th';  $comment_t = 'tcom_th'; $pr_comment_r ='princ_th';
						$term_score = 'jmeji_to_six'; $term_avg ='jmeji_gr_six'; $term_position = 'jmeji_po_six';
						
						$attrib = 'th_term';
						
						$i_ggr = 8; $i_gpo = 9;
						
						$ji_ggr = 11; $ji_gpo = 12;
						
						$cal_session = true;

					}else{  /* else display critical error */
					
						$cal_session = false;
					
						$msg_e = "*Ooooooops, a Critcal Error has Occured, Please contact the developers. Thanks.";
						echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 			

					
					}

					
					
					$nj_position = $i_grade_grand[$i_gpo];
					$nj_grade = $i_grade_grand[$i_ggr];


			break;

			default:  /* else display critical error */ 
				
				$msg_e = "*Ooooooops, a Critcal Error has Occured, Please contact the developers. Thanks.";
				echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 	
			
			break;

		}
			 

?> 