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
	This page is result configuration page
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
 
		
		if($showTokenDiv == true){	
		
			try {	
				
				$staffToken = staffToken($conn);  /* school staffs/teachers token information */ 									
		    	$classTeachers = rsClassTeachers($conn, $sessionID, $class, $level, $term);  /* retrieve class teacher names  */	
				$classTeachers = unserialize($classTeachers); 
				
			}catch(PDOException $e) {
					
				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
			}
		}	
			 
	?>	
	
			<!-- row -->	
			<div class="row lowRSDiv display-none">					
                     
     			<div class="col-lg-7">
                
                    <section class="panel">                      
                          <header class="panel-heading">
                            Save Class Teacher's Information
                          </header>
						<div class="panel-body wizGrade-line" id="scrollTarget2">                          
                          
            				<center><img src="loading.gif" alt="Loading >>>>>" id="rsConfigLoader" 
								style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>
						<div id="msgBoxTeach"></div>
                        <!-- form --><form class="form-horizontal" id="frmsaveTeacherRS" role="form">
                                  
      			<?php
				

					$courseCode = $course_info_mark;
					$courseCode_r = $course_info_mark;
			   
					$ii = 0;    $iii = 0; $iTeach = 0;
					$a = 1; $b = 2; $c = 3; $e = 4; $f = 0;
	   
       				for ($i = $start_nkiru ; $i <= $stop_njideka; $i++) {  /* loop array */

						$courseID = $courseCode_r[$i][$f];									   			   
						$courseID = strtolower($courseID);      

						echo '<div class="form-group">
						<label for="'.$courseID.'"  class="col-lg-5 col-sm-5 control-label">* <strong>';
						echo $courseCode[$i][$b];											
						echo '</strong> Teacher/s : </label>'; 

						echo '<div class="col-lg-7">

						<input type="text" class="form-control" 
						name="teachersInfo[]" id="'.$courseID.'" placeholder="search for teachers" />'; 

						$classTeacher = $classTeachers[$iTeach];
							
						if(isset($classTeacher)){  /* check is staff is empty */	 

							list ($fiTeacher, $seTeacher, $thTeacher) = explode (",", $classTeacher);	
							
							if($fiTeacher != ''){
								
								$ficlassTeacher = staffData($conn, $fiTeacher);  /* school staffs/teachers information */
								list ($fi_title, $fi_fullname, $fi_sex, $fi_rankingVal, $fi_picture, 
									  $fi_lname) = explode ("#@s@#", $ficlassTeacher);

								$fi_titleV = $title_list[$fi_title];
								$fi_sub_teacher = $fi_titleV.' '.$fi_fullname;
								$fi_sub_teacher = trim($fi_sub_teacher);
								
								if($ficlassTeacher != ''){
									
									$classTeach .=  "{ value: '$fiTeacher', label: '$fi_sub_teacher' },";	
								
								}
							}


							if($seTeacher != ''){
								
								$seclassTeacher = staffData($conn, $seTeacher);  /* school staffs/teachers information */
								list ($se_title, $se_fullname, $se_sex, $se_rankingVal, $se_picture, 
									  $se_lname) = explode ("#@s@#", $seclassTeacher);

								$se_titleV = $title_list[$se_title];
								$se_sub_teacher = $se_titleV.' '.$se_fullname;
								$se_sub_teacher = trim($se_sub_teacher);
								
								if($seclassTeacher != ''){
									
									$classTeach .=  "{ value: '$seTeacher', label: '$se_sub_teacher' },";
									
								
								}
							}


							if($thTeacher != ''){
								
								$thclassTeacher = staffData($conn, $thTeacher);  /* school staffs/teachers information */
								list ($th_title, $th_fullname, $th_sex, $th_rankingVal, $th_picture, 
									  $th_lname) = explode ("#@s@#", $thclassTeacher);

								$th_titleV = $title_list[$th_title];
								$th_sub_teacher = $th_titleV.' '.$th_fullname;
								$th_sub_teacher = trim($th_sub_teacher);
								
								if($thclassTeacher != ''){
									
									$classTeach .=  "{ value: '$thTeacher', label: '$th_sub_teacher' },";
								
								}
							}

							
							$classTeach = trim($classTeach, ',');
							

						}


$showCourse =<<<IGWEZE
							
						<script type='text/javascript'> 

															  
							$('#$courseID').tokenfield({
								autocomplete: {
								  
								source: [ $staffToken ],
								delay: 100,
								limit:3														
								},
								showAutocompleteOnFocus: true
							})

							$('#$courseID').tokenfield('setTokens', [$classTeach]); 
							
							$('#$courseID').on('tokenfield:createtoken', function (event) {
								var existingTokens = $(this).tokenfield('getTokens');
								$.each(existingTokens, function(index, token) {
									if (token.value === event.attrs.value)
										event.preventDefault();
								});
							});	

						</script>
						
						
						</div>
									  
                        </div> 
		
IGWEZE;
						echo $showCourse;													
													
						$classTeach = '';
						$iTeach++;
       				}
       			

?>


                                    <input type="hidden" name="sess" value="<?php echo $session ?>">
                                    <input type="hidden" name="level" value="<?php echo $level ?>">
                                    <input type="hidden" name="term" value="<?php echo $term ?>" />
                                    <input type="hidden" name="class" value="<?php echo $class ?>" />
    
               						<input type="hidden" name="save-rs-settings" value="configStaffs" />
                                     
                                    <div class="form-group">
                                          <center><button type="submit" class="btn btn-danger 
                                          buttonMargin demoDisenable" id="saveTeacherRS">
                                          <i class="fa fa-save"></i> Save  </button></center>
									</div>
                             
								</form><!-- / form -->
							</div>
                                               
						</section> 
                      
					</div>
                
                
     				<div class="col-lg-5">
                
						<section class="panel">
							<header class="panel-heading">
								Automate &amp; Publish Result
							</header>
							<div class="panel-body wizGrade-line" id="scrollTarget3">

							<center><img src="loading.gif" alt="Loading >>>>>" id="autoRSLoader" 
								style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>
                           
							<div id="msgBoxAuto"></div>
                              <!-- form --><form class="form-horizontal" id="frmautomateRS" role="form">
							  
								<input type="hidden" name="sess" value="<?php echo $session ?>">
								<input type="hidden" name="level" value="<?php echo $level ?>">
								<input type="hidden" name="term" value="<?php echo $term ?>" />
								<input type="hidden" name="class" value="<?php echo $class ?>" />

								<input type="hidden" name="save-rs-settings" value="automateRS" /> 
								<center><button type="submit" class="btn btn-white  
								buttonMargin demoDisenable" id="automateRS">
								<i class="fa fa-check-square-o text-info"></i> Automate / Compute This Result </button></center> 
                              </form><!-- / form --> 

                              <!-- form --><form class="form-horizontal" id="frmpublishRS" role="form">
																  
								<input type="hidden" name="sess" value="<?php echo $session ?>">
								<input type="hidden" name="level" value="<?php echo $level ?>">
								<input type="hidden" name="term" value="<?php echo $term ?>" />
								<input type="hidden" name="class" value="<?php echo $class ?>" />

								<input type="hidden" name="save-rs-settings" value="publishRS" />

								<center><button type="submit" class="btn btn-white 
								buttonMargin demoDisenable" id="publishRS">
								<i class="fa fa-bullhorn text-info"></i> Publish / Broadcast This Result </button></center> 
                             
                              </form><!-- / form -->

							</div>
                                               
						</section>
                      
					</div>
				  
			</div>
			<!-- / row -->	
			
			<script type='text/javascript'> 
					//$('#frmSaveRs').slideDown(300); 
					$('.show-rsconfig-div').show(); 					
					hidePageLoader();  /* hide page loader */
			</script>
