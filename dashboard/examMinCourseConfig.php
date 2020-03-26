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
	This script handle student level minimum course
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

		define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */
		 
			try {		 

  				$levelArray = studentLevelsArray($conn); /* student level array */				
				$minCourseArray = levelminCourseArray($conn); /* retrieve student level minimum course array */
				
			}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			} 		
?>		
 		
			<!-- row -->	
			<div class="row">
	
				<div class="col-sm-7">
					<section class="panel">
						<header class="panel-heading">
						 
						 <i class="fa fa-wrench fa-lg"></i> Minimum <span class="hide-res"> Number of</span> Subjects/Courses
							<span class="tools pull-right">
								<a href="javascript:;" class="fa fa-chevron-down"></a>
								<a href="javascript:;" class="fa fa-times"></a>
							</span>
						</header>
						<div class="panel-body wizGrade-line"> 
								
							<center><img src="loading.gif" alt="Loading >>>>>" class="configLoading" 
										style="cursor:pointer; display:none; margin-bottom:5px;" /> </center><!-- loading image-->
							<div class="msgBoxSettings"></div>

							<!-- form -->
							<form class="form-horizontal" id="frmminCourseConfig" role="form">
					<?php 	if($schoolExt == $wizGradeNurAbr){  /* check school type */  ?> 	  

								  <div class="form-group">
									  <label for="level_1" class="col-lg-3 control-label"><?php echo $levelArray[0]['level']; ?></label>
									  <div class="col-lg-9">
									  <div class="iconic-input">
										  <i class="fa fa-level-up"></i>
										  <input type="text"  id="level_1" name="level_1" 
										  value ="<?php echo $minCourseArray[1]['minCourse']; ?>"
										  class="form-control" placeholder="Enter this level minimum course offer or All for all" >
									  </div>
									  </div>
								  </div>                             
								  
								  <div class="form-group">
									  <label for="level_2" class="col-lg-3 control-label"><?php echo $levelArray[1]['level']; ?></label>
									  <div class="col-lg-9">
									  <div class="iconic-input">
										  <i class="fa fa-level-up"></i>
										  <input type="text"  id="level_2" name="level_2" 
										  value ="<?php echo $minCourseArray[2]['minCourse']; ?>"
										  class="form-control" placeholder="Enter this level minimum course offer or All for all" required>
									  </div>
									  </div>
								  </div>                             
								  <div class="form-group">
									  <label for="level_3" class="col-lg-3 control-label"><?php echo $levelArray[2]['level']; ?></label>
									  <div class="col-lg-9">
									  <div class="iconic-input">
										  <i class="fa fa-level-up"></i>
										  <input type="text"  id="level_3" name="level_3" 
										  value ="<?php echo $minCourseArray[3]['minCourse']; ?>"
										  class="form-control" placeholder="Enter this level minimum course offer or All for all" required>
									  </div>
									  </div>
								  </div>                             
								  <input type="hidden" name="schoolSettings" value="minCourseConfigNur" />
					<?php 	}else{ ?> 	  
						  
								  <div class="form-group">
									  <label for="level_1" class="col-lg-3 control-label"><?php echo $levelArray[0]['level']; ?></label>
									  <div class="col-lg-9">
									  <div class="iconic-input">
										  <i class="fa fa-level-up"></i>
										  <input type="text"  id="level_1" name="level_1" 
										  value ="<?php echo $minCourseArray[1]['minCourse']; ?>"
										  class="form-control" placeholder="Enter this level minimum course offer or All for all" >
									  </div>
									  </div>
								  </div>                             
								  
								  <div class="form-group">
									  <label for="level_2" class="col-lg-3 control-label"><?php echo $levelArray[1]['level']; ?></label>
									  <div class="col-lg-9">
									  <div class="iconic-input">
										  <i class="fa fa-level-up"></i>
										  <input type="text"  id="level_2" name="level_2" 
										  value ="<?php echo $minCourseArray[2]['minCourse']; ?>"
										  class="form-control" placeholder="Enter this level minimum course offer or All for all" required>
									  </div>
									  </div>
								  </div>                             
								  <div class="form-group">
									  <label for="level_3" class="col-lg-3 control-label"><?php echo $levelArray[2]['level']; ?></label>
									  <div class="col-lg-9">
									  <div class="iconic-input">
										  <i class="fa fa-level-up"></i>
										  <input type="text"  id="level_3" name="level_3" 
										  value ="<?php echo $minCourseArray[3]['minCourse']; ?>"
										  class="form-control" placeholder="Enter this level minimum course offer or All for all" required>
									  </div>
									  </div>
								  </div>                             

								  <div class="form-group">
									  <label for="level_4" class="col-lg-3 control-label"><?php echo $levelArray[3]['level']; ?></label>
									  <div class="col-lg-9">
									  <div class="iconic-input">
										  <i class="fa fa-level-up"></i>
										  <input type="text"  id="level_4" name="level_4" 
										  value ="<?php echo $minCourseArray[4]['minCourse']; ?>"
										  class="form-control" placeholder="Enter this level minimum course offer or All for all" required>
									  </div>
									  </div>
								  </div>             

																					   

								  <div class="form-group">
									  <label for="level_5" class="col-lg-3 control-label"><?php echo $levelArray[4]['level']; ?></label>
									  <div class="col-lg-9">
									  <div class="iconic-input">
										  <i class="fa fa-level-up"></i>
										  <input type="text"  id="level_5" name="level_5" 
										  value ="<?php echo $minCourseArray[5]['minCourse']; ?>"
										  class="form-control" placeholder="Enter this level minimum course offer or All for all" required>
									  </div>
									  </div>
								  </div>                             

								  <div class="form-group">
									  <label for="level_6" class="col-lg-3 control-label"><?php echo $levelArray[5]['level']; ?></label>
									  <div class="col-lg-9">
									  <div class="iconic-input">
										  <i class="fa fa-level-up"></i>
										  <input type="text"  id="level_6" name="level_6" 
										  value ="<?php echo $minCourseArray[6]['minCourse']; ?>"
										  class="form-control" placeholder="Enter this level minimum course offer or All for all" required>
									  </div>
									  </div>
								  </div>    

								  <input type="hidden" name="schoolSettings" value="minCourseConfig" />                                      

					  <?php }  ?> 	  

								  
								  <div class="form-group">
									  <center><button type="submit" class="btn btn-danger buttonMargin demoDisenable" 
									  id="minCourseConfig">
									  <i class="fa fa-save"></i> Save  </button></center>
									  
							  </div>
								  
							</form>
							
							<!-- / form -->	
						</div>
					</section>
				</div>
			  
			  
				<div class="col-lg-5">
					<section class="panel wizgrade-section-div">
						<header class="panel-heading">                             
						 <i class="fa fa-info-circle fa-lg"></i> INFORMATION BOARD
							<span class="tools pull-right">
								<a href="javascript:;" class="fa fa-chevron-down"></a>
								<a href="javascript:;" class="fa fa-times"></a>
							</span>
						</header>
						<div class="panel-body wizGrade-line">
						
						<?php   
							/* information message */ 
							$msg_i = "Minimum number of subjects/courses a student can offer in a level helps in student result compuation.
							Meanwhile, when a student offer above this subjects/courses limit the system will automatically compute 
							their with number of courses they do offer while a student did not meet up with the required minimum number; this
							set limit is used for their result compuation.";
							
							echo $infMsg.$msg_i.$msgEnd; 

						?>
					  
						</div>
					</section> 
				  
				</div>
		  
			</div>
			<!-- / row -->	 