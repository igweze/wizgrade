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
	This script handle student result edit 
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

			require 'configwizGrade.php';  /* load wizGrade configuration files */	   
		 		 
			if ($_REQUEST['rsData'] != '') {

				list ($regNum, $session, $level, $class, $term, $exitStatus) = explode ("@@", $_REQUEST['rsData']);  
				
      			require_once $wizGradeClassConfigDir;   /* include class configuration script */  
				
				try { 
					
					$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
					
					$exam_status = $examArray[0]['status'];	
					$exam_fi = $examArray[0]['fi_ass'];	
					$exam_se = $examArray[0]['se_ass'];	
					$exam_th = $examArray[0]['th_ass'];	
					$exam_fo = $examArray[0]['fo_ass'];	
					$exam_fif = $examArray[0]['fif_ass'];	
					$exam_six = $examArray[0]['six_ass'];
					$exam_score = $examArray[0]['exam'];	

					$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */  
					
					/* select result */ 					
					
					$ebele_mark = "SELECT  s.$query_i_scores
					
									FROM $i_reg_tb r INNER JOIN $sdoracle_score_nk s
									
									ON (r.ireg_id = s.ireg_id)

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
					
					if($rows_count == $foreal) {  /* if sucessfully */
					
							while($row[] = $igweze_prep->fetch(PDO::FETCH_BOTH)) {	 }
					
					}else{  /* display error */ 
							
							$msg_e .=  "Student record with <span>$regNum
							  </span> was not found.";
							echo $erroMsg.$msg_e.$msgEnd;  exit;			
							
					} 	

				
					$a = 1; $b = 2; $c = 3; $d = 4; $e = 5; $f = 6; $g = 7; $h = 8; 
				
					$add_data = $session.'@@'.$level.'@@'.$class.'@@'.$term; 
					
					if($exitStatus == $foreal){  /* check exit status */  

						echo"<div class='close-ov-btn'><img src='";
						echo $wizGradeTemplate; echo "images/exitbtn.png' alt='Exit Page' 
						class ='exit-overlay-box showPrintBtn'/></div>";
						echo "<span class='clear' style='margin-top:0px;'> </span>"; 
						$scrollType = $foVal;
				
					}else{  
					 
						$scrollType = ''; 
							
					}

				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}					
					
				?>           

				<!-- row -->	
				<div class="row">					

                    <section class="panel">
					<header class="panel-heading">
					 <?php echo "Save Student Class $class $term_value Results"; ?>                              
					</header>
					<div class="panel-body wizGrade-line"> 
				   
					<div id="msgBox"></div>
						<!-- form -->
                        <form class="form-horizontal" id="frmSaveRs" role="form">

							<input type="hidden" name="nj_level" value="<?php echo $level ?>">
							<input type="hidden" name="nj_term" value="<?php echo $term ?>" />
							<input type="hidden" name="nj_class" value="<?php echo $class ?>" /> 
							<input type="hidden" name="hidefrm" value="hidefrmDiv" />
							<input type="hidden" name="regnum" value = "<?php echo $regNum; ?>"/>
							<?php
							if($scrollType == $foVal){ echo '<input type="hidden" name="scrollType" 
							value="overlayScroll" />'; }
							?>   
							
							<div class="form-group">
						  
							  <label for="regnumD"  class="col-lg-4 col-sm-4 control-label">* Reg Num </label>
								
							  <div class="col-lg-8">
							
							  <div class="iconic-input">
									  <i class="fa fa-user"></i>
							
									  <input type="text" class="form-control wizGrade-rs" placeholder="2007001/SEC" 
									  name="regnumD" id="regnumD" value = "<?php echo $regNum; ?>" 
									  required disabled/>  
									  
								  </div>
							  </div>
							</div>

							<div class="form-group"> 

							<?php
						

								if($exam_status == $fiVal){  /* check exam configuration status */
								
									echo '<div class="col-lg-5">
											  <strong>Subjects Name</strong>
									 </div> ';
									 
									echo '<div class="col-lg-3 wizGrade-fi-div">
											  <strong>Test/ASE('.$exam_fi.')</strong>
									  </div>
									
									<div class="col-lg-3">
											  <strong>EXAM('.$exam_score.')</strong>
									</div>';												  
								
								}elseif($exam_status == $seVal){  /* check exam configuration status */

									echo '<div class="col-lg-5">
											  <strong>Subjects Name</strong>
									 </div> ';

									echo '<div class="col-lg-2 wizGrade-fi-div">
											  <strong>Test/ASE('.$exam_fi.')</strong>
									  </div>
									<div class="col-lg-2 wizGrade-se-div">
											  <strong>Test/ASE('.$exam_se.')</strong>
									  </div>
									
									<div class="col-lg-2">
											  <strong>EXAM('.$exam_score.')</strong>
									</div>';												  
								
								}elseif($exam_status == $thVal){  /* check exam configuration status */

									echo '<div class="col-lg-4">
											  <strong>Subjects Name</strong>
									 </div> ';
					
									echo '<div class="col-lg-2 wizGrade-fi-div">
											  <strong>Test/ASE('.$exam_fi.')</strong>
									  </div>
									<div class="col-lg-2 wizGrade-se-div">
											  <strong>Test/ASE('.$exam_se.')</strong>
									  </div>
									<div class="col-lg-2 wizGrade-th-div">
											  <strong>Test/ASE('.$exam_th.')</strong>
									  </div>
									<div class="col-lg-2">
											  <strong>EXAM('.$exam_score.')</strong>
									  </div>';												  
								
								}elseif($exam_status == $foVal){  /* check exam configuration status */

									echo '<div class="col-lg-2">
											  <strong>Subjects Name</strong>
									 </div> ';
					
									echo '<div class="col-lg-2 wizGrade-fi-div">
											  <strong>Test/ASE('.$exam_fi.')</strong>
									  </div>
									<div class="col-lg-2 wizGrade-se-div">
											  <strong>Test/ASE('.$exam_se.')</strong>
									  </div>
									<div class="col-lg-2 wizGrade-th-div">
											  <strong>Test/ASE('.$exam_th.')</strong>
									  </div>									  
									<div class="col-lg-2 wizGrade-fo-div">
											  <strong>Test/ASE('.$exam_fo.')</strong>
									  </div>  
									<div class="col-lg-2">
											  <strong>EXAM('.$exam_score.')</strong>
									  </div>';												  
								
								}elseif($exam_status == $fifVal){  /* check exam configuration status */

									echo '<div class="col-lg-2">
											  <strong>Subjects Name</strong>
									 </div> ';
					
									echo '<div class="col-lg-2 wizGrade-fi-div">
											  <strong>Test/ASE('.$exam_fi.')</strong>
									  </div>
									<div class="col-lg-2 wizGrade-se-div">
											  <strong>Test/ASE('.$exam_se.')</strong>
									  </div>
									<div class="col-lg-2 wizGrade-th-div">
											  <strong>Test/ASE('.$exam_th.')</strong>
									  </div>									  
									<div class="col-lg-2 wizGrade-fo-div">
											  <strong>Test/ASE('.$exam_fo.')</strong>
									  </div> 
									<div class="col-lg-2 wizGrade-fo-div">
											  <strong>Test/ASE('.$exam_fif.')</strong>
									  </div>   
									<div class="col-lg-2">
											  <strong>EXAM('.$exam_score.')</strong>
									  </div>';												  
								
								}elseif($exam_status == $sixVal){  /* check exam configuration status */

									echo '<div class="col-lg-2">
											  <strong>Subjects Name</strong>
									 </div> ';
					
									echo '<div class="col-lg-2 wizGrade-fi-div">
											  <strong>Test/ASE('.$exam_fi.')</strong>
									  </div>
									<div class="col-lg-2 wizGrade-se-div">
											  <strong>Test/ASE('.$exam_se.')</strong>
									  </div>
									<div class="col-lg-2 wizGrade-th-div">
											  <strong>Test/ASE('.$exam_th.')</strong>
									  </div>									  
									<div class="col-lg-2 wizGrade-fo-div">
											  <strong>Test/ASE('.$exam_fo.')</strong>
									  </div> 
									<div class="col-lg-2 wizGrade-fo-div">
											  <strong>Test/ASE('.$exam_fif.')</strong>
									  </div>
									<div class="col-lg-2 wizGrade-fo-div">
											  <strong>Test/ASE('.$exam_six.')</strong>
									  </div>  
									<div class="col-lg-2">
											  <strong>EXAM('.$exam_score.')</strong>
									  </div>';												  
								
								}else{									
									
									$msg_e = "Oooooops Error, please notify school admin to set school continous assessment before student
											results can be added.";									
									echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
									echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;
								
								}

							echo '</div>';

				 


							$course_codes = $course_info_mark;
							$course_codes_r = $course_info_mark;
				   
							$ii = 0;    $iii = 0; $ie = 0;

							for ($i = $start_nkiru ; $i <= $stop_njideka; $i++) {  /* loop array */ 

								if($exam_status == $fiVal){  /* check exam configuration status */

									list ($fi_score, $exam_score) = explode (",", $row[0][$ie]);
									
									$course_a = $course_codes_r[$i][0];								
									$course_exam = $course_codes_r[$i][0];
						   
									$course_a = $course_a."[$a]";  $course_exam = $course_exam."[$g]";
						   
									$course_a = strtolower($course_a);       $course_exam = strtolower($course_exam);

									
									echo '<div class="form-group" style="border-bottom:1px dotted #333;padding-bottom:4px;">
										  <label for="'.$course_a.'"  class="col-lg-5 col-sm-5 control-label">* ';
												echo substr($course_codes[$i][$b], 0, 20);

												echo ': </label>';

									echo '<div class="col-lg-3 wizGrade-fi-div">
											  <div class="iconic-input">
												  <i class="fa fa-check-square-o"></i>
												  <input type="number" class="form-control wizGrade-rs wizGrade-fi-rs" 
												  name="'.$course_a.'" id="'.$course_a.'" value="'.$fi_score.'" require />
											  </div>
										  </div>';

									echo '<div class="col-lg-3">
											  <div class="iconic-input">
												  <i class="fa fa-check-square-o"></i>
												  <input type="number" class="form-control wizGrade-rs wizGrade-ex-rs" 
												  name="'.$course_exam.'" id="'.$course_exam.'" value="'.$exam_score.'" require />
											  </div>
										  </div>';

									echo '</div>'; 
								
								}elseif($exam_status == $seVal){  /* check exam configuration status */

									list ($fi_score, $se_score, $exam_score) = explode (",", $row[0][$ie]);
									
									$course_a = $course_codes_r[$i][0];
									$course_b = $course_codes_r[$i][0];
									$course_exam = $course_codes_r[$i][0];
						   
									$course_a = $course_a."[$a]"; $course_b = $course_b."[$b]"; $course_exam = $course_exam."[$g]";
						   
									$course_a = strtolower($course_a);      $course_b = strtolower($course_b);      $course_exam = strtolower($course_exam);
									
									
									echo '<div class="form-group" style="border-bottom:1px dotted #333;padding-bottom:4px;">
										  <label for="'.$course_a.'"  class="col-lg-5 col-sm-5 control-label">* ';
												echo substr($course_codes[$i][$b], 0, 20);

												echo ': </label>';

									echo '<div class="col-lg-2 wizGrade-fi-div">
											  <div class="iconic-input">
												  <i class="fa fa-check-square-o"></i>
												  <input type="number" class="form-control wizGrade-rs wizGrade-fi-rs" 
												  name="'.$course_a.'" id="'.$course_a.'" value="'.$fi_score.'" require />
											  </div>
										  </div>';

									echo '<div class="col-lg-2 wizGrade-se-div">
											  <div class="iconic-input">
												  <i class="fa fa-check-square-o"></i>
												  <input type="number" class="form-control wizGrade-rs wizGrade-se-rs" 
												  name="'.$course_b.'" id="'.$course_b.'" value="'.$se_score.'" require />
											  </div>
										  </div>';

									 

									echo '<div class="col-lg-2">
											  <div class="iconic-input">
												  <i class="fa fa-check-square-o"></i>
												  <input type="number" class="form-control wizGrade-rs wizGrade-ex-rs" 
												  name="'.$course_exam.'" id="'.$course_exam.'" value="'.$exam_score.'" require />
											  </div>
										  </div>';

									echo '</div>'; 
								
								}elseif($exam_status == $thVal){  /* check exam configuration status */

									list ($fi_score, $se_score, $th_score, $exam_score) = explode (",", $row[0][$ie]);
									
									$course_a = $course_codes_r[$i][0];
									$course_b = $course_codes_r[$i][0];
									$course_c = $course_codes_r[$i][0];
									$course_exam = $course_codes_r[$i][0];
						   
									$course_a = $course_a."[$a]"; $course_b = $course_b."[$b]";   $course_c = $course_c."[$c]";  					
									$course_exam = $course_exam."[$g]";
						   
									$course_a = strtolower($course_a);      $course_b = strtolower($course_b);      $course_c = strtolower($course_c);
									$course_exam = strtolower($course_exam); 
									
									echo '<div class="form-group" style="border-bottom:1px dotted #333;padding-bottom:4px;">
										  <label for="'.$course_a.'"  class="col-lg-4 col-sm-4 control-label">* ';
												echo substr($course_codes[$i][$b], 0, 20);

												echo ': </label>';

									echo '<div class="col-lg-2 wizGrade-fi-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-fi-rs" 
											  name="'.$course_a.'" id="'.$course_a.'" value="'.$fi_score.'" require />
										  </div>
									  </div>';

									echo '<div class="col-lg-2 wizGrade-se-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-se-rs" 
											  name="'.$course_b.'" id="'.$course_b.'" value="'.$se_score.'" require />
										  </div>
									  </div>';

									echo '<div class="col-lg-2 wizGrade-th-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-th-rs" 
											  name="'.$course_c.'" id="'.$course_c.'" value="'.$th_score.'" require />
										  </div>
									  </div>';

									echo '<div class="col-lg-2">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-ex-rs" 
											  name="'.$course_exam.'" id="'.$course_exam.'" value="'.$exam_score.'" require />
										  </div>
									  </div>';

									echo '</div>'; 
								
								}elseif($exam_status == $foVal){  /* check exam configuration status */

									list ($fi_score, $se_score, $th_score, $fo_score, $exam_score) = explode (",", $row[0][$ie]);
									
									$course_a = $course_codes_r[$i][0];
									$course_b = $course_codes_r[$i][0];
									$course_c = $course_codes_r[$i][0];
									$course_d = $course_codes_r[$i][0]; 
									$course_exam = $course_codes_r[$i][0];
						   
									$course_a = $course_a."[$a]"; $course_b = $course_b."[$b]";   $course_c = $course_c."[$c]";   
									$course_d = $course_d."[$d]"; $course_exam = $course_exam."[$g]";
						   
									$course_a = strtolower($course_a);      $course_b = strtolower($course_b);      $course_c = strtolower($course_c);
									$course_d = strtolower($course_d);      $course_exam = strtolower($course_exam); 
								
									echo '<div class="form-group" style="border-bottom:1px dotted #333;padding-bottom:4px;">
									  <label for="'.$course_a.'"  class="col-lg-2 col-sm-2 control-label">* ';
											echo substr($course_codes[$i][$b], 0, 20);

											echo ': </label>';

									echo '<div class="col-lg-2 wizGrade-fi-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-fi-rs" 
											  name="'.$course_a.'" id="'.$course_a.'" value="'.$fi_score.'" require />
										  </div>
									  </div>';

									echo '<div class="col-lg-2 wizGrade-se-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-se-rs" 
											  name="'.$course_b.'" id="'.$course_b.'" value="'.$se_score.'" require />
										  </div>
									  </div>';

									echo '<div class="col-lg-2 wizGrade-th-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-th-rs" 
											  name="'.$course_c.'" id="'.$course_c.'" value="'.$th_score.'" require />
										  </div>
									  </div>';
									  
									echo '<div class="col-lg-2 wizGrade-th-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-fo-rs" 
											  name="'.$course_d.'" id="'.$course_d.'" value="'.$fo_score.'" require />
										  </div>
									  </div>';	  

									echo '<div class="col-lg-2">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-ex-rs" 
											  name="'.$course_exam.'" id="'.$course_exam.'" value="'.$exam_score.'" require />
										  </div>
									  </div>';

									echo '</div>'; 
								
								}elseif($exam_status == $fifVal){  /* check exam configuration status */

									list ($fi_score, $se_score, $th_score, $fo_score, $fif_score, $exam_score) = explode (",", $row[0][$ie]);
									
									$course_a = $course_codes_r[$i][0];
									$course_b = $course_codes_r[$i][0];
									$course_c = $course_codes_r[$i][0];
									$course_d = $course_codes_r[$i][0];
									$course_e = $course_codes_r[$i][0]; 
									$course_exam = $course_codes_r[$i][0];
						   
									$course_a = $course_a."[$a]"; $course_b = $course_b."[$b]";   $course_c = $course_c."[$c]";   
									$course_d = $course_d."[$d]"; $course_e = $course_e."[$e]";   $course_exam = $course_exam."[$g]";
						   
									$course_a = strtolower($course_a);      $course_b = strtolower($course_b);      $course_c = strtolower($course_c);
									$course_d = strtolower($course_d);      $course_e = strtolower($course_e);      $course_exam = strtolower($course_exam);								
									
									echo '<div class="form-group" style="border-bottom:1px dotted #333;padding-bottom:4px;">
									  <label for="'.$course_a.'"  class="col-lg-2 col-sm-2 control-label">* ';
											echo substr($course_codes[$i][$b], 0, 20);

											echo ': </label>';

									echo '<div class="col-lg-2 wizGrade-fi-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-fi-rs" 
											  name="'.$course_a.'" id="'.$course_a.'" value="'.$fi_score.'" require />
										  </div>
									  </div>';

									echo '<div class="col-lg-2 wizGrade-se-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-se-rs" 
											  name="'.$course_b.'" id="'.$course_b.'" value="'.$se_score.'" require />
										  </div>
									  </div>';

									echo '<div class="col-lg-2 wizGrade-th-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-th-rs" 
											  name="'.$course_c.'" id="'.$course_c.'" value="'.$th_score.'" require />
										  </div>
									  </div>';
									  
									echo '<div class="col-lg-2 wizGrade-th-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-fo-rs" 
											  name="'.$course_d.'" id="'.$course_d.'" value="'.$fo_score.'" require />
										  </div>
									  </div>';	  
									  
									echo '<div class="col-lg-2 wizGrade-th-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-fif-rs" 
											  name="'.$course_e.'" id="'.$course_e.'" value="'.$fif_score.'" require />
										  </div>
									  </div>';	  

									echo '<div class="col-lg-2">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="number" class="form-control wizGrade-rs wizGrade-ex-rs" 
											  name="'.$course_exam.'" id="'.$course_exam.'" value="'.$exam_score.'" require />
										  </div>
									  </div>';

									echo '</div>';  
								
								}elseif($exam_status == $sixVal){  /* check exam configuration status */

									list ($fi_score, $se_score, $th_score, $fo_score, $fif_score, $six_score, $exam_score) = explode (",", $row[0][$ie]);
									
									$course_a = $course_codes_r[$i][0];
									$course_b = $course_codes_r[$i][0];
									$course_c = $course_codes_r[$i][0];
									$course_d = $course_codes_r[$i][0];
									$course_e = $course_codes_r[$i][0];
									$course_f = $course_codes_r[$i][0];
									$course_exam = $course_codes_r[$i][0];
						   
									$course_a = $course_a."[$a]"; $course_b = $course_b."[$b]";   $course_c = $course_c."[$c]";   
									$course_d = $course_d."[$d]"; $course_e = $course_e."[$e]";   $course_f = $course_c."[$f]";   					
									$course_exam = $course_exam."[$g]";
						   
									$course_a = strtolower($course_a);      $course_b = strtolower($course_b);      $course_c = strtolower($course_c);
									$course_d = strtolower($course_d);      $course_e = strtolower($course_e);      $course_f = strtolower($course_f);
									$course_exam = strtolower($course_exam); 
								
									echo '<div class="form-group" style="border-bottom:1px dotted #333;padding-bottom:4px;">
									  <label for="'.$course_a.'"  class="col-lg-2 col-sm-2 control-label">* ';
											echo substr($course_codes[$i][$b], 0, 20);

											echo ': </label>';

									echo '<div class="col-lg-2 wizGrade-fi-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="text" class="form-control wizGrade-rs wizGrade-fi-rs" 
											  name="'.$course_a.'" id="'.$course_a.'" value="'.$fi_score.'" require />
										  </div>
									  </div>';

									echo '<div class="col-lg-2 wizGrade-se-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="text" class="form-control wizGrade-rs wizGrade-se-rs" 
											  name="'.$course_b.'" id="'.$course_b.'" value="'.$se_score.'" require />
										  </div>
									  </div>';

									echo '<div class="col-lg-2 wizGrade-th-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="text" class="form-control wizGrade-rs wizGrade-th-rs" 
											  name="'.$course_c.'" id="'.$course_c.'" value="'.$th_score.'" require />
										  </div>
									  </div>';
									  
									echo '<div class="col-lg-2 wizGrade-th-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="text" class="form-control wizGrade-rs wizGrade-fo-rs" 
											  name="'.$course_d.'" id="'.$course_d.'" value="'.$fo_score.'" require />
										  </div>
									  </div>';	  
									  
									echo '<div class="col-lg-2 wizGrade-th-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="text" class="form-control wizGrade-rs wizGrade-fif-rs" 
											  name="'.$course_e.'" id="'.$course_e.'" value="'.$fif_score.'" require />
										  </div>
									  </div>';
								  
									echo '<div class="col-lg-2 wizGrade-th-div">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="text" class="form-control wizGrade-rs wizGrade-six-rs" 
											  name="'.$course_f.'" id="'.$course_f.'" value="'.$six_score.'" require />
										  </div>
									  </div>';	

									echo '<div class="col-lg-2">
										  <div class="iconic-input">
											  <i class="fa fa-check-square-o"></i>
											  <input type="text" class="form-control wizGrade-rs wizGrade-ex-rs" 
											  name="'.$course_exam.'" id="'.$course_exam.'" value="'.$exam_score.'" require />
										  </div>
									  </div>';

									echo '</div>'; 
								
								}else{  /* display error */  
									
									$msg_e = "Oooooops Error, please notify school admin to set school continous assessment before student
											results can be added.";									
									echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
									echo "<script type='text/javascript'> hidePageLoader(); </script>"; exit;	
								
								} 
								
								$fi_score = ''; $se_score = ''; $th_score = ''; $fo_score = ''; $fif_score = ''; $six_score = ''; $exam_score = '';
								$ie++;

							}
       			

							?>  
							
							<div class="form-group"> 	
								<input type="hidden" name="validate" value="validateRS" />							
								<center><button type="submit" class="btn btn-danger buttonMargin" id="saveRS">
								<i class="fa fa-save"></i> Save Student Result </button></center> 					  
							</div>  

                        </form>
						<!-- / form -->
                    </div>
                         
                    </section>
                      
                </div>
				<!-- / row -->


				<script type="text/javascript">
					
						hidePageLoader();  /* hide page loader */	
					
                </script>      				
                
<?php
		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
		} 
	
		if ($msg) {

			echo $errorMsg.$msg.$eEnd; echo $scrollUp; exit; 		 

        }
		
exit;		
?>	