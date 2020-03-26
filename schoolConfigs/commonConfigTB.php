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
	This script load database table information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
 
		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
			
		if(($schoolID == "") || ($wizGradeDB == "")){  /* if no school type was selected */
			 
			$msg_e = "*Ooooooops, a Critcal Error has Occured, Please contact the developers. Thanks.";
			echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit;
				
		}	  
		
		$i_reg_tb = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_regno';
		$i_student_tb = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_student_record'; 

		$class_one_sdoracle_score_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_one_score';
		$class_one_sub_score_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_one_sub_score';
		$class_one_sdoracle_grade_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_one_grade';
		$class_one_sdoracle_comment_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_one_comment';
		$class_one_sdoracle_grand_score_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_one_grand_score';
		$class_one_class_remarks_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_one_remark'; 
		$jss_class_repeat_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_jss_class_repeat';

		global $i_reg_tb, $i_student_tb,
		$class_one_sdoracle_score_tb, $class_one_sub_score_tb, $class_one_sdoracle_grade_tb, $class_one_sdoracle_comment_tb,
		$class_one_sdoracle_grand_score_tb, $jss_class_repeat_tb, $class_one_class_remarks_tb;

		$class_two_sdoracle_score_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_two_score';
		$class_two_sub_score_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_two_sub_score';
		$class_two_sdoracle_grade_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_two_grade';
		$class_two_sdoracle_comment_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_two_comment';
		$class_two_sdoracle_grand_score_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_two_grand_score';
		$class_two_class_remarks_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_two_remark'; 

		global $class_two_sdoracle_score_tb, $class_two_sub_score_tb, $class_two_sdoracle_grade_tb, $class_two_sdoracle_comment_tb,
		$class_two_sdoracle_grand_score_tb, $class_two_class_remarks_tb; 

		$class_three_sdoracle_score_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_three_score';
		$class_three_sub_score_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_three_sub_score';
		$class_three_sdoracle_grade_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_three_grade';
		$class_three_sdoracle_comment_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_three_comment';
		$class_three_sdoracle_grand_score_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_three_grand_score';
		$class_three_class_remarks_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_three_remark'; 

		global $class_three_sdoracle_score_tb, $class_three_sub_score_tb, $class_three_sdoracle_grade_tb,  $class_three_sdoracle_comment_tb,       
		$class_three_sdoracle_grand_score_tb, $class_three_class_remarks_tb;

		$class_four_sdoracle_score_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_four_score';
		$class_four_sub_score_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_four_sub_score';
		$class_four_sdoracle_grade_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_four_grade';
		$class_four_sdoracle_comment_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_four_comment';
		$class_four_sdoracle_grand_score_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_four_grand_score';
		$class_four_class_remarks_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_four_remark'; 
		$sss_class_repeat_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_sss_class_repeat';		 

		global $class_four_sdoracle_score_tb, $class_four_sub_score_tb, $class_four_sdoracle_grade_tb, $class_four_sdoracle_comment_tb,        
		$class_four_sdoracle_grand_score_tb, $sss_class_repeat_tb, $class_four_class_remarks_tb; 

		$class_five_sdoracle_score_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_five_score';
		$class_five_sub_score_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_five_sub_score';
		$class_five_sdoracle_grade_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_five_grade';
		$class_five_sdoracle_comment_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_five_comment';
		$class_five_sdoracle_grand_score_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_five_grand_score';
		$class_five_class_remarks_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_five_remark'; 
		$sss_class_repeat_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_sss_class_repeat';		  

		global $class_five_sdoracle_score_tb, $class_five_sub_score_tb, $class_five_sdoracle_grade_tb,         
		$class_five_sdoracle_grand_score_tb, $sss_class_repeat_tb, $class_five_class_remarks_tb; 

		$class_six_sdoracle_score_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_six_score';
		$class_six_sub_score_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_six_sub_score';
		$class_six_sdoracle_grade_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_six_grade';
		$class_six_sdoracle_comment_tb  = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_six_comment';
		$class_six_sdoracle_grand_score_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_six_grand_score';
		$class_six_class_remarks_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class_six_remark'; 
		$sss_class_repeat_tb   = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_sss_class_repeat';		 

		global $class_six_sdoracle_score_tb, $class_six_sub_score_tb, $class_six_sdoracle_grade_tb,  $class_six_sdoracle_comment_tb,
		$class_six_sdoracle_grand_score_tb, $sss_class_repeat_tb, $class_six_class_remarks_tb, $class_six_sdoracle_grand_score_tb;

		$daily_comments_tb = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_daily_comments';
		$classLevelTB = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_class';
		$classFormTeachersTB = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_form_teachers';
		$studentTimeTable = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_timetb';
		$rsTeachersConfigTB = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_config_rs';
		$rsExamConfigTB = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_exams_config';
		$hostelTB = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_hostel';
		$wizGradeExamTB = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_exams';
		$wizGradeAssignTB = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_assignment';
		$wizGradeQuestionTB = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_exam_questions';
		$wizGradeAssignQuestionTB = $wizGradeDB.'.'.$schoolTBPref.'wizgrade_assign_questions'; 

		global $wizGradeDB, $daily_comments_tb,  $rsTeachersConfigTB, $rsExamConfigTB, $classLevelTB, $classFormTeachersTB, 
		$studentTimeTable, $hostelTB, $wizGradeExamTB, $wizGradeQuestionTB; 
		 
?>	