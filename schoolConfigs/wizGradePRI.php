<?php

/*   
	Copyright (C) fobrain Tech LTD (2014 - 2024) - All Rights Reserved
	
	Licensed under the Apache License, Version 2.0 (the 'License');
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an 'AS IS' BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License	
	 
	#####################################################################################################
	fobrain (wizgrade open source) app is designed & developed by Igweze Ebele Mark for fobrain Tech LTD
	#####################################################################################################

	fobrain is Dedicated To Almighty God, My fabulous FAMILY and Amazing Parents.  
	
	WEBSITE 							PHONES/WHATSAPP					EMAILS
	https://www.fobrain.com				+234 - 80 30 716 751  			opensource@fobrain.com
										+234 - 80 22 000 490 	
	
	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Page/Code Explanation~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	This script load primary school configurations
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
		 
		$schoolID = $seVal;		$schoolTBPref = $wizGradePriPref;	
		$supRegNo = $schoolRegSuffArr[$schoolID]; 
		$schoolPicDir = $wizGradePicDir.'primary/'; global $schoolPicDir;
		$wizGradeConfigTB = $wizGradeDB.'.wizgrade_config_pri'; global $wizGradeConfigTB;
		
		$schoolExt = 'pri';	

		if(file_exists($wizGradeDBConnectDir)){ require ($wizGradeDBConnectDir); /* include database connection script */ }
		elseif(file_exists($wizGradeDBConnectIndDir)){ require ($wizGradeDBConnectIndDir); /* include database connection script */ }
		else { echo $infoMsg.$noConnCongfigMsg.$iEnd; exit;  /* display error */ }													  


		##############################################
		##############################################
		#######   Class One Configurations   #########
		##############################################
		##############################################

		/* database query strings */
		
		$query_select_class_one_fi_term_gran = 'jemji_to_fi, jemji_gr_fi, jemji_po_fi';

		$query_select_class_one_se_term_gran = 'jiemj_to_fi, jiemj_gr_fi, jiemj_po_fi';

		$query_select_class_one_th_term_gran = 'jmeji_to_fi, jmeji_gr_fi, jmeji_po_fi, jgrand_to_fi, jgrand_gr_fi, jgrand_po_fi';

		$i_class_one_grading_scale = array ('0', 'jemji_to_fi', 'jemji_gr_fi', 'jemji_po_fi', 'jiemj_to_fi', 'jiemj_gr_fi',
					   'jiemj_po_fi',  'jmeji_to_fi', 'jmeji_gr_fi', 'jmeji_po_fi', 'jgrand_to_fi', 
					   'jgrand_gr_fi', 'jgrand_po_fi', 'certify');

		$query_select_class_one_gran = 'jgrand_to_fi, jgrand_gr_fi, jgrand_po_fi, certify';  

		try {

			$configOneF = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $fiVal, $fiVal); /* first term subjects array */
			$configOneS = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $fiVal, $seVal); /* second term subjects array */
			$configOneT = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $fiVal, $thVal); /* third term subjects array */

			$configOneFC = count($configOneF);
			$configOneSC = count($configOneS);
			$configOneTC = count($configOneT);


		}catch(PDOException $e) {

			wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

		} 

		$arrOneMerge = array_merge($configOneF, $configOneS);

		$i_class_one_course_info = array_merge($arrOneMerge, $configOneT);

		array_unshift($i_class_one_course_info,"");
		unset($i_class_one_course_info[0]);

		$i_fi_start_class_one_fi_term = 1;           			 
		$i_fi_last_class_one_fi_term = $configOneFC; 

		$i_se_start_class_one_se_term = ($configOneFC + 1);    
		$i_se_last_class_one_se_term = ($configOneFC + $configOneSC); 

		$i_th_start_class_one_th_term = ($configOneFC + $configOneSC + 1);           	
		$i_th_last_class_one_th_term = ($configOneFC + $configOneSC + $configOneTC); 

		$i_gr_start_class_one = 1;           $i_gr_last_class_one = ($configOneFC + $configOneSC + $configOneTC); 

		$i_class_one_course_info_coc[] = 0;	

		#$$$$$$$$$$$ initialise first term configuation - class One $$$$$$$$$$$$$#

		$i_stop_loop_class_one_fi_term = $configOneFC; 

		$is_certify_arr_class_one_fi_term = ($configOneFC + 1); 

		#$$$$$$$$$$$ initialise second term configuation - class One $$$$$$$$$$$$$#

		$i_stop_loop_class_one_se_term = $configOneSC; 

		$is_certify_arr_class_one_se_term = ($configOneSC + 1); 

		#$$$$$$$$$$$ initialise third term configuation - class One $$$$$$$$$$$$$#

		$i_stop_loop_class_one_th_term = $configOneTC; 

		$is_certify_arr_class_one_th_term = ($configOneTC + 1);  

		for ($i = $i_fi_start_class_one_fi_term; $i <= $i_fi_last_class_one_fi_term; $i++){  /* loop array */ 

			$query_select_class_one_fi_term .= $i_class_one_course_info[$i][0].', ';
			$query_select_class_one_fi_term_to .= $i_class_one_course_info[$i][3].', ';
			$query_select_class_one_fi_term_po .= $i_class_one_course_info[$i][4].', ';
			$query_select_class_one_fi_term_com .= $i_class_one_course_info[$i][5].', ';

		}

		$query_select_class_one_fi_term = trim($query_select_class_one_fi_term, ', '); 

		$query_select_class_one_fi_term_to .= ' CF'; 

		$query_select_class_one_fi_term_po = trim($query_select_class_one_fi_term_po, ', ');

		$query_select_class_one_fi_term_com = trim($query_select_class_one_fi_term_com, ', '); 

		for ($i = $i_se_start_class_one_se_term; $i <= $i_se_last_class_one_se_term; $i++){  /* loop array */ 

			$query_select_class_one_se_term .= $i_class_one_course_info[$i][0].', ';
			$query_select_class_one_se_term_to .= $i_class_one_course_info[$i][3].', ';
			$query_select_class_one_se_term_po .= $i_class_one_course_info[$i][4].', ';
			$query_select_class_one_se_term_com .= $i_class_one_course_info[$i][5].', ';

		}

		$query_select_class_one_se_term = trim($query_select_class_one_se_term, ', '); 

		$query_select_class_one_se_term_to .= ' CS'; 

		$query_select_class_one_se_term_po = trim($query_select_class_one_se_term_po, ', ');

		$query_select_class_one_se_term_com = trim($query_select_class_one_se_term_com, ', '); 

		for ($i = $i_th_start_class_one_th_term; $i <= $i_th_last_class_one_th_term; $i++){  /* loop array */ 

			$query_select_class_one_th_term .= $i_class_one_course_info[$i][0].', ';
			$query_select_class_one_th_term_to .= $i_class_one_course_info[$i][3].', ';
			$query_select_class_one_th_term_po .= $i_class_one_course_info[$i][4].', ';
			$query_select_class_one_th_term_com .= $i_class_one_course_info[$i][5].', ';

		}

		$query_select_class_one_th_term = trim($query_select_class_one_th_term, ', '); 

		$query_select_class_one_th_term_to .= ' CT'; 

		$query_select_class_one_th_term_po = trim($query_select_class_one_th_term_po, ', ');

		$query_select_class_one_th_term_com = trim($query_select_class_one_th_term_com, ', '); 

		for ($i = $i_gr_start_class_one; $i <= $i_gr_last_class_one; $i++){  /* loop array */ 

			$i_class_one_course_info_coc[] = $i_class_one_course_info[$i][0];

		}


		##############################################
		##############################################
		#######   Class Two Configurations   #########
		##############################################
		##############################################

		/* database query strings */
		
		$query_select_class_two_fi_term_gran = 'jemji_to_se, jemji_gr_se, jemji_po_se';

		$query_select_class_two_se_term_gran = 'jiemj_to_se, jiemj_gr_se, jiemj_po_se';

		$query_select_class_two_th_term_gran = 'jmeji_to_se, jmeji_gr_se, jmeji_po_se, jgrand_to_se, jgrand_gr_se, jgrand_po_se'; 

		$i_class_two_grading_scale = array ('0', 'jemji_to_se', 'jemji_gr_se', 'jemji_po_se', 'jiemj_to_se', 'jiemj_gr_se',
								   'jiemj_po_se',  'jmeji_to_se', 'jmeji_gr_se', 'jmeji_po_se', 'jgrand_to_se', 
								   'jgrand_gr_se', 'jgrand_po_se', 'certify');

		$query_select_class_two_gran = 'jgrand_to_se, jgrand_gr_se, jgrand_po_se, certify'; 

		try {

			$configTwoF = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $seVal, $fiVal); /* first term subjects array */
			$configTwoS = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $seVal, $seVal); /* second term subjects array */
			$configTwoT = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $seVal, $thVal); /* third term subjects array */

			$configTwoFC = count($configTwoF);
			$configTwoSC = count($configTwoS);
			$configTwoTC = count($configTwoT);


		}catch(PDOException $e) {

			wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

		}

		$arrTwoMerge = array_merge($configTwoF, $configTwoS);

		$i_class_two_course_info = array_merge($arrTwoMerge, $configTwoT);

		array_unshift($i_class_two_course_info,"");
		unset($i_class_two_course_info[0]);

		$i_fi_start_class_two_fi_term = 1;           			 
		$i_fi_last_class_two_fi_term = $configTwoFC; 

		$i_se_start_class_two_se_term = ($configTwoFC + 1);    
		$i_se_last_class_two_se_term = ($configTwoFC + $configTwoSC); 

		$i_th_start_class_two_th_term = ($configTwoFC + $configTwoSC + 1);           	
		$i_th_last_class_two_th_term = ($configTwoFC + $configTwoSC + $configTwoTC); 

		$i_gr_start_class_two = 1;           $i_gr_last_class_two = ($configTwoFC + $configTwoSC + $configTwoTC); 

		$i_class_two_course_info_coc[] = 0;	

		#$$$$$$$$$$$ initialise first term configuation - class Two $$$$$$$$$$$$$#

		$i_stop_loop_class_two_fi_term = $configTwoFC; 

		$is_certify_arr_class_two_fi_term = ($configTwoFC + 1); 

		#$$$$$$$$$$$ initialise second term configuation - class Two $$$$$$$$$$$$$#

		$i_stop_loop_class_two_se_term = $configTwoSC; 

		$is_certify_arr_class_two_se_term = ($configTwoSC + 1); 

		#$$$$$$$$$$$ initialise third term configuation - class Two $$$$$$$$$$$$$#

		$i_stop_loop_class_two_th_term = $configTwoTC; 

		$is_certify_arr_class_two_th_term = ($configTwoTC + 1);  

		for ($i = $i_fi_start_class_two_fi_term; $i <= $i_fi_last_class_two_fi_term; $i++){  /* loop array */ 

			$query_select_class_two_fi_term .= $i_class_two_course_info[$i][0].', ';
			$query_select_class_two_fi_term_to .= $i_class_two_course_info[$i][3].', ';
			$query_select_class_two_fi_term_po .= $i_class_two_course_info[$i][4].', ';
			$query_select_class_two_fi_term_com .= $i_class_two_course_info[$i][5].', ';

		}

		$query_select_class_two_fi_term = trim($query_select_class_two_fi_term, ', '); 

		$query_select_class_two_fi_term_to .= ' CF'; 

		$query_select_class_two_fi_term_po = trim($query_select_class_two_fi_term_po, ', ');

		$query_select_class_two_fi_term_com = trim($query_select_class_two_fi_term_com, ', ');	 

		for ($i = $i_se_start_class_two_se_term; $i <= $i_se_last_class_two_se_term; $i++){  /* loop array */ 

			$query_select_class_two_se_term .= $i_class_two_course_info[$i][0].', ';
			$query_select_class_two_se_term_to .= $i_class_two_course_info[$i][3].', ';
			$query_select_class_two_se_term_po .= $i_class_two_course_info[$i][4].', ';
			$query_select_class_two_se_term_com .= $i_class_two_course_info[$i][5].', ';

		}

		$query_select_class_two_se_term = trim($query_select_class_two_se_term, ', '); 

		$query_select_class_two_se_term_to .= ' CS'; 

		$query_select_class_two_se_term_po = trim($query_select_class_two_se_term_po, ', ');

		$query_select_class_two_se_term_com = trim($query_select_class_two_se_term_com, ', '); 

		for ($i = $i_th_start_class_two_th_term; $i <= $i_th_last_class_two_th_term; $i++){  /* loop array */ 

			$query_select_class_two_th_term .= $i_class_two_course_info[$i][0].', ';
			$query_select_class_two_th_term_to .= $i_class_two_course_info[$i][3].', ';
			$query_select_class_two_th_term_po .= $i_class_two_course_info[$i][4].', ';
			$query_select_class_two_th_term_com .= $i_class_two_course_info[$i][5].', ';

		}

		$query_select_class_two_th_term = trim($query_select_class_two_th_term, ', '); 

		$query_select_class_two_th_term_to .= ' CT'; 

		$query_select_class_two_th_term_po = trim($query_select_class_two_th_term_po, ', ');

		$query_select_class_two_th_term_com = trim($query_select_class_two_th_term_com, ', '); 

		for ($i = $i_gr_start_class_two; $i <= $i_gr_last_class_two; $i++){  /* loop array */ 

			$i_class_two_course_info_coc[] = $i_class_two_course_info[$i][0];

		}


		##############################################
		##############################################
		#######   Class Three Configurations   #######
		##############################################
		##############################################


		/* database query strings */
		
		$query_select_class_three_fi_term_gran = 'jemji_to_th, jemji_gr_th, jemji_po_th';

		$query_select_class_three_se_term_gran = 'jiemj_to_th, jiemj_gr_th, jiemj_po_th';

		$query_select_class_three_th_term_gran = 'jmeji_to_th, jmeji_gr_th, jmeji_po_th, jgrand_to_th, jgrand_gr_th, jgrand_po_th'; 

		$i_class_three_grading_scale = array ('0', 'jemji_to_th', 'jemji_gr_th', 'jemji_po_th', 'jiemj_to_th', 'jiemj_gr_th',
									   'jiemj_po_th',  'jmeji_to_th', 'jmeji_gr_th', 'jmeji_po_th', 'jgrand_to_th', 
									   'jgrand_gr_th', 'jgrand_po_th', 'certify');

		$query_select_class_three_gran = 'jgrand_to_se, jgrand_gr_th, jgrand_po_th, certify'; 

		try {

			$configThreeF = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $thVal, $fiVal); /* first term subjects array */
			$configThreeS = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $thVal, $seVal); /* second term subjects array */
			$configThreeT = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $thVal, $thVal); /* third term subjects array */

			$configThreeFC = count($configThreeF);
			$configThreeSC = count($configThreeS);
			$configThreeTC = count($configThreeT); 

		}catch(PDOException $e) {

			wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

		} 

		$arrThreeMerge = array_merge($configThreeF, $configThreeS);

		$i_class_three_course_info = array_merge($arrThreeMerge, $configThreeT);

		array_unshift($i_class_three_course_info,"");
		unset($i_class_three_course_info[0]);

		$i_fi_start_class_three_fi_term = 1;           			 
		$i_fi_last_class_three_fi_term = $configThreeFC; 

		$i_se_start_class_three_se_term = ($configThreeFC + 1);    
		$i_se_last_class_three_se_term = ($configThreeFC + $configThreeSC); 

		$i_th_start_class_three_th_term = ($configThreeFC + $configThreeSC + 1);           	
		$i_th_last_class_three_th_term = ($configThreeFC + $configThreeSC + $configThreeTC); 

		$i_gr_start_class_three = 1;           $i_gr_last_class_three = ($configThreeFC + $configThreeSC + $configThreeTC); 

		$i_class_three_course_info_coc[] = 0;	

		#$$$$$$$$$$$ initialise first term configuation - class Three $$$$$$$$$$$$$#

		$i_stop_loop_class_three_fi_term = $configThreeFC; 

		$is_certify_arr_class_three_fi_term = ($configThreeFC + 1); 

		#$$$$$$$$$$$ initialise second term configuation - class Three $$$$$$$$$$$$$#

		$i_stop_loop_class_three_se_term = $configThreeSC; 

		$is_certify_arr_class_three_se_term = ($configThreeSC + 1); 

		#$$$$$$$$$$$ initialise third term configuation - class Three $$$$$$$$$$$$$#

		$i_stop_loop_class_three_th_term = $configThreeTC; 

		$is_certify_arr_class_three_th_term = ($configThreeTC + 1);  

		for ($i = $i_fi_start_class_three_fi_term; $i <= $i_fi_last_class_three_fi_term; $i++){  /* loop array */ 

			$query_select_class_three_fi_term .= $i_class_three_course_info[$i][0].', ';
			$query_select_class_three_fi_term_to .= $i_class_three_course_info[$i][3].', ';
			$query_select_class_three_fi_term_po .= $i_class_three_course_info[$i][4].', ';
			$query_select_class_three_fi_term_com .= $i_class_three_course_info[$i][5].', ';

		}

		$query_select_class_three_fi_term = trim($query_select_class_three_fi_term, ', '); 

		$query_select_class_three_fi_term_to .= ' CF'; 

		$query_select_class_three_fi_term_po = trim($query_select_class_three_fi_term_po, ', ');

		$query_select_class_three_fi_term_com = trim($query_select_class_three_fi_term_com, ', ');		  


		for ($i = $i_se_start_class_three_se_term; $i <= $i_se_last_class_three_se_term; $i++){  /* loop array */ 

			$query_select_class_three_se_term .= $i_class_three_course_info[$i][0].', ';
			$query_select_class_three_se_term_to .= $i_class_three_course_info[$i][3].', ';
			$query_select_class_three_se_term_po .= $i_class_three_course_info[$i][4].', ';
			$query_select_class_three_se_term_com .= $i_class_three_course_info[$i][5].', ';

		}

		$query_select_class_three_se_term = trim($query_select_class_three_se_term, ', '); 

		$query_select_class_three_se_term_to .= ' CS'; 

		$query_select_class_three_se_term_po = trim($query_select_class_three_se_term_po, ', ');

		$query_select_class_three_se_term_com = trim($query_select_class_three_se_term_com, ', '); 

		for ($i = $i_th_start_class_three_th_term; $i <= $i_th_last_class_three_th_term; $i++){  /* loop array */ 

			$query_select_class_three_th_term .= $i_class_three_course_info[$i][0].', ';
			$query_select_class_three_th_term_to .= $i_class_three_course_info[$i][3].', ';
			$query_select_class_three_th_term_po .= $i_class_three_course_info[$i][4].', ';
			$query_select_class_three_th_term_com .= $i_class_three_course_info[$i][5].', ';

		}

		$query_select_class_three_th_term = trim($query_select_class_three_th_term, ', '); 

		$query_select_class_three_th_term_to .= ' CT'; 

		$query_select_class_three_th_term_po = trim($query_select_class_three_th_term_po, ', ');

		$query_select_class_three_th_term_com = trim($query_select_class_three_th_term_com, ', ');	 

		for ($i = $i_gr_start_class_three; $i <= $i_gr_last_class_three; $i++){  /* loop array */ 

			$i_class_three_course_info_coc[] = $i_class_three_course_info[$i][0];

		}


		##############################################
		##############################################
		#######   Class Four Configurations   ########
		##############################################
		##############################################

		/* database query strings */
		
		$query_select_class_four_fi_term_gran = 'jemji_to_fo, jemji_gr_fo, jemji_po_fo';

		$query_select_class_four_se_term_gran = 'jiemj_to_fo, jiemj_gr_fo, jiemj_po_fo';

		$query_select_class_four_th_term_gran = 'jmeji_to_fo, jmeji_gr_fo, jmeji_po_fo, jgrand_to_fo, jgrand_gr_fo, jgrand_po_fo'; 

		$i_class_four_grading_scale = array ('0', 'jemji_to_fo', 'jemji_gr_fo', 'jemji_po_fo', 'jiemj_to_fo', 'jiemj_gr_fo',
									   'jiemj_po_fo',  'jmeji_to_fo', 'jmeji_gr_fo', 'jmeji_po_fo', 'jgrand_to_fo', 
									   'jgrand_gr_fo', 'jgrand_po_fo', 'certify');

		$query_select_class_four_gran = 'jgrand_to_fo, jgrand_gr_fo, jgrand_po_fo, certify';  

		try {

			$configFourF = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $foVal, $fiVal); /* first term subjects array */
			$configFourS = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $foVal, $seVal); /* second term subjects array */
			$configFourT = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $foVal, $thVal); /* third term subjects array */

			$configFourFC = count($configFourF);
			$configFourSC = count($configFourS);
			$configFourTC = count($configFourT); 

		}catch(PDOException $e) {

			wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

		} 

		$arrFourMerge = array_merge($configFourF, $configFourS);

		$i_class_four_course_info = array_merge($arrFourMerge, $configFourT);

		array_unshift($i_class_four_course_info,"");
		unset($i_class_four_course_info[0]);

		$i_fi_start_class_four_fi_term = 1;           			 
		$i_fi_last_class_four_fi_term = $configFourFC; 

		$i_se_start_class_four_se_term = ($configFourFC + 1);    
		$i_se_last_class_four_se_term = ($configFourFC + $configFourSC); 

		$i_th_start_class_four_th_term = ($configFourFC + $configFourSC + 1);           	
		$i_th_last_class_four_th_term = ($configFourFC + $configFourSC + $configFourTC); 

		$i_gr_start_class_four = 1;           $i_gr_last_class_four = ($configFourFC + $configFourSC + $configFourTC); 

		$i_class_four_course_info_coc[] = 0;	

		#$$$$$$$$$$$ initialise first term configuation - class Four $$$$$$$$$$$$$#

		$i_stop_loop_class_four_fi_term = $configFourFC; 

		$is_certify_arr_class_four_fi_term = ($configFourFC + 1); 

		#$$$$$$$$$$$ initialise second term configuation - class Four $$$$$$$$$$$$$#

		$i_stop_loop_class_four_se_term = $configFourSC; 

		$is_certify_arr_class_four_se_term = ($configFourSC + 1); 

		#$$$$$$$$$$$ initialise third term configuation - class Four $$$$$$$$$$$$$#

		$i_stop_loop_class_four_th_term = $configFourTC; 

		$is_certify_arr_class_four_th_term = ($configFourTC + 1);  

		for ($i = $i_fi_start_class_four_fi_term; $i <= $i_fi_last_class_four_fi_term; $i++){  /* loop array */ 

			$query_select_class_four_fi_term .= $i_class_four_course_info[$i][0].', ';
			$query_select_class_four_fi_term_to .= $i_class_four_course_info[$i][3].', ';
			$query_select_class_four_fi_term_po .= $i_class_four_course_info[$i][4].', ';
			$query_select_class_four_fi_term_com .= $i_class_four_course_info[$i][5].', ';

		}

		$query_select_class_four_fi_term = trim($query_select_class_four_fi_term, ', '); 

		$query_select_class_four_fi_term_to .= ' CF'; 

		$query_select_class_four_fi_term_po = trim($query_select_class_four_fi_term_po, ', ');

		$query_select_class_four_fi_term_com = trim($query_select_class_four_fi_term_com, ', ');  

		for ($i = $i_se_start_class_four_se_term; $i <= $i_se_last_class_four_se_term; $i++){  /* loop array */ 

			$query_select_class_four_se_term .= $i_class_four_course_info[$i][0].', ';
			$query_select_class_four_se_term_to .= $i_class_four_course_info[$i][3].', ';
			$query_select_class_four_se_term_po .= $i_class_four_course_info[$i][4].', ';
			$query_select_class_four_se_term_com .= $i_class_four_course_info[$i][5].', ';

		}

		$query_select_class_four_se_term = trim($query_select_class_four_se_term, ', '); 

		$query_select_class_four_se_term_to .= ' CS'; 

		$query_select_class_four_se_term_po = trim($query_select_class_four_se_term_po, ', ');

		$query_select_class_four_se_term_com = trim($query_select_class_four_se_term_com, ', '); 

		for ($i = $i_th_start_class_four_th_term; $i <= $i_th_last_class_four_th_term; $i++){  /* loop array */ 

			$query_select_class_four_th_term .= $i_class_four_course_info[$i][0].', ';
			$query_select_class_four_th_term_to .= $i_class_four_course_info[$i][3].', ';
			$query_select_class_four_th_term_po .= $i_class_four_course_info[$i][4].', ';
			$query_select_class_four_th_term_com .= $i_class_four_course_info[$i][5].', ';

		}

		$query_select_class_four_th_term = trim($query_select_class_four_th_term, ', '); 

		$query_select_class_four_th_term_to .= ' CT'; 

		$query_select_class_four_th_term_po = trim($query_select_class_four_th_term_po, ', ');

		$query_select_class_four_th_term_com = trim($query_select_class_four_th_term_com, ', '); 

		for ($i = $i_gr_start_class_four; $i <= $i_gr_last_class_four; $i++){  /* loop array */ 

			$i_class_four_course_info_coc[] = $i_class_four_course_info[$i][0];

		}


		##############################################
		##############################################
		#######   Class Five Configurations   ########
		##############################################
		##############################################

		/* database query strings */
		
		$query_select_class_five_fi_term_gran = 'jemji_to_fif, jemji_gr_fif, jemji_po_fif';

		$query_select_class_five_se_term_gran = 'jiemj_to_fif, jiemj_gr_fif, jiemj_po_fif';

		$query_select_class_five_th_term_gran = 'jmeji_to_fif, jmeji_gr_fif, jmeji_po_fif, jgrand_to_fif, jgrand_gr_fif, jgrand_po_fif'; 

		$i_class_five_grading_scale = array ('0', 'jemji_to_fif', 'jemji_gr_fif', 'jemji_po_fif', 'jiemj_to_fif', 'jiemj_gr_fif',
									   'jiemj_po_fif',  'jmeji_to_fif', 'jmeji_gr_fif', 'jmeji_po_fif', 'jgrand_to_fif', 
									   'jgrand_gr_fif', 'jgrand_po_fif', 'certify');

		$query_select_class_five_gran = 'jgrand_to_fif, jgrand_gr_fif, jgrand_po_fif, certify';  

		try {

			$configFiveF = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $fifVal, $fiVal); /* first term subjects array */
			$configFiveS = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $fifVal, $seVal); /* second term subjects array */
			$configFiveT = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $fifVal, $thVal); /* third term subjects array */

			$configFiveFC = count($configFiveF);
			$configFiveSC = count($configFiveS);
			$configFiveTC = count($configFiveT); 

		}catch(PDOException $e) {

			wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

		} 

		$arrFiveMerge = array_merge($configFiveF, $configFiveS);

		$i_class_five_course_info = array_merge($arrFiveMerge, $configFiveT);

		array_unshift($i_class_five_course_info,"");
		unset($i_class_five_course_info[0]);

		$i_fi_start_class_five_fi_term = 1;           			 
		$i_fi_last_class_five_fi_term = $configFiveFC; 

		$i_se_start_class_five_se_term = ($configFiveFC + 1);    
		$i_se_last_class_five_se_term = ($configFiveFC + $configFiveSC); 

		$i_th_start_class_five_th_term = ($configFiveFC + $configFiveSC + 1);           	
		$i_th_last_class_five_th_term = ($configFiveFC + $configFiveSC + $configFiveTC); 

		$i_gr_start_class_five = 1;           $i_gr_last_class_five = ($configFiveFC + $configFiveSC + $configFiveTC); 

		$i_class_five_course_info_coc[] = 0;	

		#$$$$$$$$$$$ initialise first term configuation - class Five $$$$$$$$$$$$$#

		$i_stop_loop_class_five_fi_term = $configFiveFC; 

		$is_certify_arr_class_five_fi_term = ($configFiveFC + 1); 

		#$$$$$$$$$$$ initialise second term configuation - class Five $$$$$$$$$$$$$#

		$i_stop_loop_class_five_se_term = $configFiveSC; 

		$is_certify_arr_class_five_se_term = ($configFiveSC + 1); 

		#$$$$$$$$$$$ initialise third term configuation - class Five $$$$$$$$$$$$$#

		$i_stop_loop_class_five_th_term = $configFiveTC; 

		$is_certify_arr_class_five_th_term = ($configFiveTC + 1);  

		for ($i = $i_fi_start_class_five_fi_term; $i <= $i_fi_last_class_five_fi_term; $i++){  /* loop array */ 

			$query_select_class_five_fi_term .= $i_class_five_course_info[$i][0].', ';
			$query_select_class_five_fi_term_to .= $i_class_five_course_info[$i][3].', ';
			$query_select_class_five_fi_term_po .= $i_class_five_course_info[$i][4].', ';
			$query_select_class_five_fi_term_com .= $i_class_five_course_info[$i][5].', ';

		}

		$query_select_class_five_fi_term = trim($query_select_class_five_fi_term, ', '); 

		$query_select_class_five_fi_term_to .= ' CF'; 

		$query_select_class_five_fi_term_po = trim($query_select_class_five_fi_term_po, ', ');

		$query_select_class_five_fi_term_com = trim($query_select_class_five_fi_term_com, ', '); 

		for ($i = $i_se_start_class_five_se_term; $i <= $i_se_last_class_five_se_term; $i++){  /* loop array */ 

			$query_select_class_five_se_term .= $i_class_five_course_info[$i][0].', ';
			$query_select_class_five_se_term_to .= $i_class_five_course_info[$i][3].', ';
			$query_select_class_five_se_term_po .= $i_class_five_course_info[$i][4].', ';
			$query_select_class_five_se_term_com .= $i_class_five_course_info[$i][5].', ';

		}

		$query_select_class_five_se_term = trim($query_select_class_five_se_term, ', '); 

		$query_select_class_five_se_term_to .= ' CS'; 

		$query_select_class_five_se_term_po = trim($query_select_class_five_se_term_po, ', ');

		$query_select_class_five_se_term_com = trim($query_select_class_five_se_term_com, ', '); 

		for ($i = $i_th_start_class_five_th_term; $i <= $i_th_last_class_five_th_term; $i++){  /* loop array */ 

			$query_select_class_five_th_term .= $i_class_five_course_info[$i][0].', ';
			$query_select_class_five_th_term_to .= $i_class_five_course_info[$i][3].', ';
			$query_select_class_five_th_term_po .= $i_class_five_course_info[$i][4].', ';
			$query_select_class_five_th_term_com .= $i_class_five_course_info[$i][5].', ';

		}

		$query_select_class_five_th_term = trim($query_select_class_five_th_term, ', '); 

		$query_select_class_five_th_term_to .= ' CT'; 

		$query_select_class_five_th_term_po = trim($query_select_class_five_th_term_po, ', ');

		$query_select_class_five_th_term_com = trim($query_select_class_five_th_term_com, ', '); 

		for ($i = $i_gr_start_class_five; $i <= $i_gr_last_class_five; $i++){  /* loop array */ 

			$i_class_five_course_info_coc[] = $i_class_five_course_info[$i][0];

		}


		##############################################
		##############################################
		#######   Class Six Configurations   #########
		##############################################
		##############################################
		
		/* database query strings */
		
		$query_select_class_six_fi_term_gran = 'jemji_to_six, jemji_gr_six, jemji_po_six';

		$query_select_class_six_se_term_gran = 'jiemj_to_six, jiemj_gr_six, jiemj_po_six';

		$query_select_class_six_th_term_gran = 'jmeji_to_six, jmeji_gr_six, jmeji_po_six, jgrand_to_six, jgrand_gr_six, jgrand_po_six'; 

		$i_class_six_grading_scale = array ('0', 'jemji_to_six', 'jemji_gr_six', 'jemji_po_six', 'jiemj_to_six', 'jiemj_gr_six',
					   'jiemj_po_six',  'jmeji_to_six', 'jmeji_gr_six', 'jmeji_po_six', 'jgrand_to_six', 
					   'jgrand_gr_six', 'jgrand_po_six', 'certify');

		$query_select_class_six_gran = 'jgrand_to_six, jgrand_gr_six, jgrand_po_six, certify';  

		try {

			$configSixF = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $sixVal, $fiVal); /* first term subjects array */
			$configSixS = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $sixVal, $seVal); /* second term subjects array */
			$configSixT = wizGradeSchoolCoursesData($conn, $wizGradeConfigTB, $schoolID, $sixVal, $thVal); /* third term subjects array */

			$configSixFC = count($configSixF);
			$configSixSC = count($configSixS);
			$configSixTC = count($configSixT); 

		}catch(PDOException $e) {

			wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

		} 

		$arrSixMerge = array_merge($configSixF, $configSixS);

		$i_class_six_course_info = array_merge($arrSixMerge, $configSixT);

		array_unshift($i_class_six_course_info,"");
		unset($i_class_six_course_info[0]);

		$i_fi_start_class_six_fi_term = 1;           			 
		$i_fi_last_class_six_fi_term = $configSixFC; 

		$i_se_start_class_six_se_term = ($configSixFC + 1);    
		$i_se_last_class_six_se_term = ($configSixFC + $configSixSC); 

		$i_th_start_class_six_th_term = ($configSixFC + $configSixSC + 1);           	
		$i_th_last_class_six_th_term = ($configSixFC + $configSixSC + $configSixTC); 

		$i_gr_start_class_six = 1;           $i_gr_last_class_six = ($configSixFC + $configSixSC + $configSixTC); 

		$i_class_six_course_info_coc[] = 0;	

		#$$$$$$$$$$$ initialise first term configuation - class Six $$$$$$$$$$$$$#

		$i_stop_loop_class_six_fi_term = $configSixFC; 

		$is_certify_arr_class_six_fi_term = ($configSixFC + 1); 

		#$$$$$$$$$$$ initialise second term configuation - class Six $$$$$$$$$$$$$#

		$i_stop_loop_class_six_se_term = $configSixSC; 

		$is_certify_arr_class_six_se_term = ($configSixSC + 1); 

		#$$$$$$$$$$$ initialise third term configuation - class Six $$$$$$$$$$$$$#

		$i_stop_loop_class_six_th_term = $configSixTC; 

		$is_certify_arr_class_six_th_term = ($configSixTC + 1); 

		for ($i = $i_fi_start_class_six_fi_term; $i <= $i_fi_last_class_six_fi_term; $i++){  /* loop array */ 

			$query_select_class_six_fi_term .= $i_class_six_course_info[$i][0].', ';
			$query_select_class_six_fi_term_to .= $i_class_six_course_info[$i][3].', ';
			$query_select_class_six_fi_term_po .= $i_class_six_course_info[$i][4].', ';
			$query_select_class_six_fi_term_com .= $i_class_six_course_info[$i][5].', ';

		}

		$query_select_class_six_fi_term = trim($query_select_class_six_fi_term, ', '); 

		$query_select_class_six_fi_term_to .= ' CF'; 

		$query_select_class_six_fi_term_po = trim($query_select_class_six_fi_term_po, ', ');

		$query_select_class_six_fi_term_com = trim($query_select_class_six_fi_term_com, ', '); 

		for ($i = $i_se_start_class_six_se_term; $i <= $i_se_last_class_six_se_term; $i++){  /* loop array */ 

			$query_select_class_six_se_term .= $i_class_six_course_info[$i][0].', ';
			$query_select_class_six_se_term_to .= $i_class_six_course_info[$i][3].', ';
			$query_select_class_six_se_term_po .= $i_class_six_course_info[$i][4].', ';
			$query_select_class_six_se_term_com .= $i_class_six_course_info[$i][5].', ';

		}

		$query_select_class_six_se_term = trim($query_select_class_six_se_term, ', '); 

		$query_select_class_six_se_term_to .= ' CS'; 

		$query_select_class_six_se_term_po = trim($query_select_class_six_se_term_po, ', ');

		$query_select_class_six_se_term_com = trim($query_select_class_six_se_term_com, ', '); 

		for ($i = $i_th_start_class_six_th_term; $i <= $i_th_last_class_six_th_term; $i++){  /* loop array */ 

			$query_select_class_six_th_term .= $i_class_six_course_info[$i][0].', ';
			$query_select_class_six_th_term_to .= $i_class_six_course_info[$i][3].', ';
			$query_select_class_six_th_term_po .= $i_class_six_course_info[$i][4].', ';
			$query_select_class_six_th_term_com .= $i_class_six_course_info[$i][5].', ';

		}

		$query_select_class_six_th_term = trim($query_select_class_six_th_term, ', '); 

		$query_select_class_six_th_term_to .= ' CT'; 

		$query_select_class_six_th_term_po = trim($query_select_class_six_th_term_po, ', ');

		$query_select_class_six_th_term_com = trim($query_select_class_six_th_term_com, ', '); 

		for ($i = $i_gr_start_class_six; $i <= $i_gr_last_class_six; $i++){  /* loop array */ 

			$i_class_six_course_info_coc[] = $i_class_six_course_info[$i][0];

		} 

		require 'commonConfigTB.php';  /* include common database table information  */

?>