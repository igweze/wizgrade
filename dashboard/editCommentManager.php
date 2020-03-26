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
	This script handle student comment result edit
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
						$exam_score = $examArray[0]['exam'];	

						$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */ 
						
						/* select result */ 	
						
						$ebele_mark = "SELECT  s.$query_i_strings_com
						
										FROM $i_reg_tb r INNER JOIN $sdoracle_comment_nk s
										
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
							echo $errorMsg.$msg_e.$eEnd;  exit;			
							
						}	 
				
						$a = 1; $b = 2; $c = 3; $e = 4; $f = 5;
	 
					
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
							  <form class="form-horizontal" id="frmsaveSubComment" role="form">

									<input type="hidden" name="nj_level" value="<?php echo $level ?>">
                                    <input type="hidden" name="nj_term" value="<?php echo $term ?>" />
							        <input type="hidden" name="nj_class" value="<?php echo $class ?>" /> 
                                    <input type="hidden" name="hidefrm" value="hidefrmDiv" />
                                    <input type="hidden" name="regnum" value = "<?php echo $regNum; ?>"/>
                                    <?php if($scrollType == $foVal){ echo '<input type="hidden" name="scrollType" bvalue="overlayScroll" />'; }?>   
 									
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

									<?php 

										$course_codes = $course_info_mark;
										$course_codes_r = $course_info_mark;
							   
										$ii = 0;    $iii = 0; $ie = 0;

										for ($i = $start_nkiru ; $i <= $stop_njideka; $i++) {  /* loop array */
														
											$subComment = htmlspecialchars_decode(($row[0][$ie]));								
											$course_a = $course_codes_r[$i][$f];
											$course_a = strtolower($course_a); 

											echo '<div class="form-group" style="border-bottom:1px dotted #333;padding-bottom:4px;">
												  <label for="'.$course_a.'"  class="col-lg-4 col-sm-4 control-label">* ';
														echo substr($course_codes[$i][$b], 0, 20);

														echo ': </label>';

											echo '<div class="col-lg-8">
													  
														  <textarea rows="2"  class="form-control" name="'.$course_a.'" id="'.$course_a.'"
														placeholder="Enter '.$course_codes[$i][$b].' Teachers  Comment . . . . ">'.$subComment.'</textarea>
														
													
												  </div>';

											echo '</div>'; 											
											
											$subComment = '';
											$ie++;

										}
										

									?> 

               						<input type="hidden" name="validate" value="validateCom" />
                                    <div class="form-group"> 
                                          
                                    <center><button type="submit" class="btn btn-danger buttonMargin" id="saveSubComment">
                                    <i class="fa fa-save"></i> Save Comment </button></center> 
                                  
                                  </div> 

                              </form>
							  <!-- / form -->
                          </div>
                         
                    </section>
                      
                </div>


				
<?php
				echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	exit;
				
			}else{
		
					echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
					
			}
		
		
	
			if ($msg) {

				echo $errorMsg.$msg.$eEnd; echo $scrollUp; exit; 	 

			}
		
exit;
?>	