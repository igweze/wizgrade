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
	This page is the school class subject manager
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
 

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configwizGrade.php';  /* load wizGrade configuration files */
		 
		 if (($_REQUEST['iemj']) != '') {
			 
			 list($subs, $level) = explode('-', $_REQUEST['iemj']);
		 
		 try {
		 
			    $levelArr = studentLevelsArray($conn); /* retrive this school level data */
	   		    array_unshift($levelArr,"");
			    unset($levelArr[0]);

				$firstTSubjects = schoolCoursesInfo($conn, $schoolID, $level, $fiVal); /* retrive this level first term subjects */
				$secondTSubjects = schoolCoursesInfo($conn, $schoolID, $level, $seVal); /* retrive this level second term subjects */
				$thirdTSubjects = schoolCoursesInfo($conn, $schoolID, $level, $thVal); /* retrive this level third term subjects */
				
				$firstTSubjectsC = count($firstTSubjects);
				$secondTSubjectsC = count($secondTSubjects);
				$thirdTSubjectsC = count($thirdTSubjects);
				
				
		 }catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		 }
		
		
		
?>		
					
			 		                
				<!-- row -->	
					<div class="row">  
					<div class="col-sm-12">
						<section class="panel">
							<header class="panel-heading">
                            
							<i class="fa fa-wrench fa-lg"></i> <?php echo  $levelArr[$level]['level']; ?> Subjects <span class="hide-res">Configuration</span>
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line">

								<div style="margin:30px 10px !important;">
								<center>
							 
								<!-- form --><form class="form-inline" role="form">
									<div class="form-group">
                                      <label class="sr-only" for="courseCode">*Course Code</label>
                                      <input type="text" class="form-control uppWords" maxlength="9" id="courseCode" placeholder="Enter Course Code"
                                      required>
									</div>
									<div class="form-group">
                                      <label class="sr-only" for="courseTitle">*Course Title</label>
                                      <input type="text" class="form-control capWords" maxlength="60" id="courseTitle" placeholder="Enter Course Title"
                                      required>
									</div>
                                  
									<div class="form-group">
                                      <label class="sr-only" for="courseTerm">*Course Term</label>
                                     <select class="form-control"  id="courseTerm" name="courseTerm" required>
                                              
                                				<option value = "">Please Select Term</option>
												<?php

													foreach($term_list as $term_key => $term_value){    /* loop array */  /* loop array */

														echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

													}

												?>
                                             
                                              </select>
                                              <input type="hidden" value="saveSubj" name = "subjectData"/>
                                             
                                              <div id="courseLevel" style="display:none"><?php echo $level; ?></div>
                                              <div id="couTerm" style="display:none">1</div>
									</div>
                                 
									<div class="form-group">                                   
									<button class="btn btn-danger demoDisenable" id="saveSubjects">Save Subject</button>                                   
									</div>
									
								</form><!-- / form -->
								 
								</center>
								</div>
                
								<center><img src="loading.gif" alt="Loading >>>>>" id="subj-loader"  style="display:none; margin-bottom:5px;" /> </center>
        
								<div id="msgBoxSubjs"></div>
                          
                          
								<div id="refreshSubjsTab"></div>
								<div id="refreshDiv">
								<header class="panel-heading tab-bg-dark-navy-blue"><!-- tab header start -->
								<ul class="nav nav-tabs nav-justified">
                                  
                                  <li class="active">
                                      <a data-toggle="tab" href="#fiTerm">
                                          <i class="fa fa-calendar"></i>
                                          First Term 
                                      </a>
                                  </li>
                                  <li class="">
                                      <a data-toggle="tab" href="#seTerm">
                                          <i class="fa fa-calendar"></i>
                                         Second Term 
                                      </a>
                                  </li>
                                  
                                  <li class="">
                                      <a data-toggle="tab" href="#thTerm">
                                          <i class="fa fa-calendar"></i>
                                         Third Term 
                                      </a>
                                  </li>
                                  
								</ul>
								</header><!-- tab header end -->  
								<div class="panel-body">
								<div class="tab-content">
                                  
									<div id="fiTerm" class="tab-pane active">
									
										<section class="panel">
									
										<div class="panel-body"> 
										<header class="panel-heading">
										   <?php echo  $levelArr[$level]['level']; ?> First Term Subjects
										</header>    
										
											<!-- table -->
											<table  class='table table-hover style-table wizGradeTBPage 
											id="firstTerm">
											<thead><tr>
											<th>S/N</th> 
											<th>Subjects Code</th> 
											<th>Subjects Title </th>
											<th>Tasks</th>
											</tr></thead> <tbody>

<?php
						
							if($firstTSubjectsC >= $fiVal){ /* check if retrieve data is greater or equal to 1 */	
							
								$sn_cf = $fiVal;
								
								for($i = $fiVal; $i <= $firstTSubjectsC; $i++){	/* loop to retrieve level first term subjects information */
								
									$cfID = $firstTSubjects[$i]["cf_id"];
									$cf_code = $firstTSubjects[$i]["cf_code"];
									$cf_raw = $firstTSubjects[$i]["cf_raw"];
									$cf_tittle = $firstTSubjects[$i]["cf_tittle"];
									$cf_code = trim($cf_code);
									$cf_raw = trim($cf_raw);
									$cf_tittle = trim($cf_tittle);
									
									$cfUpdate = 'cfUpdate-'.$cfID;
									$cfEdit = 'cfEdit-'.$cfID;
									$cfRemove = 'cfRemove-'.$cfID.'-'.$level.'-'.$fiVal.'-'.$cf_raw.'-'.$cf_code.'-'.$cf_tittle;
									$cfCCEdit = 'editCourseCf-'.$cfID;
									$cfCTEdit = 'editCourseTf-'.$cfID;
									$cfRow = 'cfRow-'.$cfID;
									$cfLoader = 'cfLoader-'.$cfID;
									$cfmsgBox = 'cfmsgBox-'.$cfID; 
								

$cf =<<<IGWEZE
        
									<tr id='$cfRow'><td>$sn_cf </td> 
									<td><div id='$cfCCEdit'> <i class='fa fa-book'></i> $cf_code</div>  </td> 
									
									<td class='text-left'> 
									
									<div id='$cfmsgBox'>	</div>						  
									<div id='$cfCTEdit'><i class='fa fa-bars'></i>  $cf_tittle</div> </td>
									
									<td> 
									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right">
													<li>
													<a href='javascript:;' id='$cfUpdate' class ='demoDisenable cfUpdate' style="display:none;">
													<button class="btn btn-info btn-xs"><i class="fa fa-save"></i></button> Save</a>
													
													<a href='javascript:;' id='$cfEdit' class ='cfEdit'>
													<button class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
													</li>
													<li class="divider"></li>
													<li>
													<a href='javascript:;' id='$cfRemove' class ='demoDisenable removeSubjInfo'> 
													<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button> Remove</a>			
													</li>
											</ul>		
									</div><!-- /btn-group -->
									
									<center><img src="loading.gif" alt="Loading >>>>>" id="$cfLoader"  
									style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>
									
									</td>
									</tr>
		
IGWEZE;
                               
									echo $cf;
									
									$sn_cf++;

		                        }
						} 
 
?>
											<div id="fiTermLast" style="display:none;"><?php echo $sn_cf; ?></div>
											<div id="newSubjfi"> </div> 
									
											</tbody>
											</table>
											<!-- / table -->					 
										</div>
									 
									</section>
										  
										  
										  
								</div>

								<div id="seTerm" class="tab-pane">
                                  
									<section class="panel">
                          
									<div class="panel-body">
                          
									<header class="panel-heading">
									<?php echo  $levelArr[$level]['level']; ?> Second Term Subjects
									</header>   
										
										<!-- table -->
										
										<table  class='table table-hover style-table wizGradeTBPage 
										id="secordTerm">
										<thead><tr>
										<th>S/N</th> 
										<th>Subjects Code</th> 
										<th>Subjects Title </th>
										<th>Tasks</th>
										</tr></thead> <tbody>

        <?php
		


							if($secondTSubjectsC >= $fiVal){ /* check if retrieve data is greater or equal to 1 */		
								
								$sn_cs = $fiVal;

								for($i = $fiVal; $i <= $secondTSubjectsC; $i++){ /* loop to retrieve level second term subjects information */	

									$csID = $secondTSubjects[$i]["cf_id"];
									$cs_code = $secondTSubjects[$i]["cf_code"];
									$cs_raw = $secondTSubjects[$i]["cf_raw"];
									$cs_tittle = $secondTSubjects[$i]["cf_tittle"];
									$cs_code = trim($cs_code);
									$cs_raw = trim($cs_raw);
									$cs_tittle = trim($cs_tittle);
									
									$csUpdate = 'csUpdate-'.$csID;
									$csEdit = 'csEdit-'.$csID;
									$csRemove = 'csRemove-'.$csID.'-'.$level.'-'.$seVal.'-'.$cs_raw.'-'.$cs_code.'-'.$cs_tittle;
									$csCCEdit = 'editCourseCs-'.$csID;
									$csCTEdit = 'editCourseTs-'.$csID;
									$csRow = 'csRow-'.$csID;
									$csLoader = 'csLoader-'.$csID;
									$csmsgBox = 'csmsgBox-'.$csID;
								

$cs =<<<IGWEZE
        
									<tr id='$csRow'><td>$sn_cs </td> 
									<td><div id='$csCCEdit'> <i class='fa fa-book'></i> $cs_code</div>  </td> 
									
									<td class='text-left'> 
									
									<div id='$csmsgBox'>	</div>						  
									<div id='$csCTEdit'><i class='fa fa-bars'></i>  $cs_tittle</div> </td>
									
									<td> 
									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right">
													<li>
													<a href='javascript:;' id='$csUpdate' class ='demoDisenable csUpdate' style="display:none;">
													<button class="btn btn-info btn-xs"><i class="fa fa-save"></i></button> Save</a>
													
													<a href='javascript:;' id='$csEdit' class ='csEdit'>
													<button class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
													</li>
													<li class="divider"></li>
													<li>
													<a href='javascript:;' id='$csRemove' class ='demoDisenable removeSubjInfo'> 
													<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button> Remove</a>		
													</li> 
												</ul>	
									</div><!-- /btn-group --> 
									<center><img src="loading.gif" alt="Loading >>>>>" id="$csLoader"  
									style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>
									
									</td>
									</tr>
		
IGWEZE;
                               
									echo $cs;
									
									$sn_cs++;

		                        }
						} 
				
?>
											<div id="seTermLast" style="display:none;"><?php echo $sn_cs; ?></div>
											<div id="newSubjse"> </div>
											</tbody>
											</table>
											<!-- /table -->								
								  
										</div>
								 
									</section>
										  
								</div>


								<div id="thTerm" class="tab-pane">
                                  
								<section class="panel">
                          
								<div class="panel-body">
                          
                          
								<header class="panel-heading">
									<?php echo  $levelArr[$level]['level']; ?> Third Term Subjects
								</header>   
									
									<!-- table -->
									<table  class='table table-hover style-table wizGradeTBPage 
									id="thirdTerm">
									<thead><tr>
									<th>S/N</th> 
									<th>Subjects Code</th> 
									<th>Subjects Title </th>
									<th>Tasks</th>
									</tr></thead> <tbody>

        <?php

							if($thirdTSubjectsC >= $fiVal){	/* check if retrieve data is greater or equal to 1 */	
						
								$sn_ct = $fiVal;
								
								for($i = $fiVal; $i <= $thirdTSubjectsC; $i++){	 /* loop to retrieve level third term subjects information */
								
									$ctID = $thirdTSubjects[$i]["cf_id"];
									$ct_code = $thirdTSubjects[$i]["cf_code"];
									$ct_raw = $thirdTSubjects[$i]["cf_raw"];
									$ct_tittle = $thirdTSubjects[$i]["cf_tittle"];
									$ct_code = trim($ct_code);
									$ct_raw = trim($ct_raw);
									$ct_tittle = trim($ct_tittle);
									
									$ctUpdate = 'ctUpdate-'.$ctID;
									$ctEdit = 'ctEdit-'.$ctID;
									$ctRemove = 'ctRemove-'.$ctID.'-'.$level.'-'.$thVal.'-'.$ct_raw.'-'.$ct_code.'-'.$ct_tittle;
									$ctCCEdit = 'editCourseCt-'.$ctID;
									$ctCTEdit = 'editCourseTt-'.$ctID;
									$ctRow = 'ctRow-'.$ctID;
									$ctLoader = 'ctLoader-'.$ctID;
									$ctmsgBox = 'ctmsgBox-'.$ctID;
								

$ct =<<<IGWEZE
        
										<tr id='$ctRow'><td>$sn_ct </td> 
										<td><div id='$ctCCEdit'> <i class='fa fa-book'></i> $ct_code</div>  </td> 
										
										<td class='text-left'> 
										
										<div id='$ctmsgBox'>	</div>						  
										<div id='$ctCTEdit'><i class='fa fa-bars'></i>  $ct_tittle</div> </td>
										
										<td> 
										
										
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
											<i class="fa fa-wrench"></i> <span class="caret"></span></button>
												<ul role="menu" class="dropdown-menu pull-right">
														<li>
														<a href='javascript:;' id='$ctUpdate' class ='demoDisenable ctUpdate' style="display:none;">
														<button class="btn btn-info btn-xs"><i class="fa fa-save"></i></button> Save</a>
														
														<a href='javascript:;' id='$ctEdit' class ='ctEdit'>
														<button class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
														</li>
														<li class="divider"></li>
														<li>
														<a href='javascript:;' id='$ctRemove' class ='demoDisenable removeSubjInfo'> 
														<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button> Remove</a>
														</li>
												</ul>		 
													
									</div><!-- /btn-group -->
									
									
									<center><img src="loading.gif" alt="Loading >>>>>" id="$ctLoader"  
									style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>
									
									</td>
									</tr>
		
IGWEZE;
                               
									echo $ct;
									
									$sn_ct++;

		                        }
						}
				
?>
										<div id="thTermLast" style="display:none;"><?php echo $sn_ct; ?></div>
										<div id="newSubjth"> </div>
									
											</tbody>
										</table>
										<!-- / table -->

										  
								</div>
									 
								</section>
									  
								</div>
									  
									  
									  
								</div>
                                  
                                  
								</div>
								</div><!-- refresh div -->
                
				
				
							</div>
						</section>
					</div>
				  
				</div>
				<!-- / row -->

				<!-- class subject removal pop up modal start -->                       
				<a href="#removeSub-modal" data-toggle="modal" id="modalRemoveBtn" class=""> </a>

				<div class="modal fade" id="removeSub-modal" tabindex="-1" role="dialog" 
				aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
						<div class="modal-dialog">
							  <div class="modal-content">
								  <div class="modal-header">
									  <button type="button" class="close" 
									  data-dismiss="modal" aria-hidden="true">
									  <span style='color:#fff !important;'>&times;</span></button>
									  <h4 class="modal-title"> Are sure you want to remove this subject information ?
									  </h4>
								  </div>
								  <div class="modal-body">
									<div id="filterSettingsMsg"> </div>
									<div class="wizgrade-section-div">
						 
										<section class="panel">
										
										<div class="panel-body">
										
											 <div id="removeSubData" style="display:none;"></div>
											
											<?php 
											
											echo "$infoMsgNX  Are sure you want to remove? <br />
											<span style='color:#000;font-weight:bold;'  id='removeInfo'> </span> $msgEnd";
											?>
											
											
											<div class="form-group">
													  
													  <div class="col-lg-12">
														  <div class="iconic-input">
															  <i class="fa fa-key"></i>
															  <input type="password" class="form-control"
															  name="adminPass" id="adminPass" placeholder ="Please enter Admin Authorisation Password"
															   require />
														  </div>
													  </div>
											</div>
											  
										</div>
										
										</section>
							  
									</div>

								  </div>
								  <div class="modal-footer">
									  <button data-dismiss="modal" class="btn btn-danger" id="removeSubjBtn" 
									  type="button">Yes</button>
									  <button data-dismiss="modal" class="btn btn-danger" 
									  type="button">Cancel</button>
								  </div>
							  </div>
						</div>
				</div>
				<!-- class subject removal pop up modal end --> 

				<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>

                                 
<?php 

			}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			} 
			
			if ($msg_s) {

				echo $succesMsg.$msg_s.$sEnd ; echo $scrollUp; exit; 				
										
			}	


			if ($msg_e) {

				echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit;  
										
			}	
				
exit;
?>