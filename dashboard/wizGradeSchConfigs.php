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
	This script load school setup configuration
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configINwizGrade.php';  /* load wizGrade configuration files */
		 		 
		 
		try {		 

			$schoolArray = wizGradeSchool($conn);  /* school configuration setup array  */ 
			$staffToken = staffToken($conn);  /* school staffs/teachers token information */ 

			$school_logo = $schoolArray[0]['school_logo'];			
			$ewallet = $schoolArray[0]['ewallet'];
			$translator = $schoolArray[0]['translator'];
			
			$sch_logo = $sch_logo_path.$school_logo;

			if ((is_null($school_logo)) || ($school_logo == '') || (!file_exists($sch_logo))) {

			   $sch_logo = $wizGradeDefaultPic;
			   
			}
			
			list ($transFrom, $transTo) = explode ("/", $translator);	
				
		}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		}
		
		
		
?>		

				<!-- row -->	
				<div class="row"> 
					
                    <div class="col-lg-10">
					
						<center><img src="loading.gif" alt="Loading >>>>>" class="configLoading" 
									  style="cursor:pointer; display:none; margin-bottom:5px;" /> </center> 
			
                		<div class="msgBoxPic"></div>	
                        	
						<section class="panel" id = 'editBioDiv1'>
							<header class="panel-heading">
                              <i class="fa fa-camera fa-lg"></i> Upload School Logo
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line">

								<!-- form -->
								<form method="POST" id = "frmSchPic"  enctype="multipart/form-data" 
								action='wizGradeConfigCPanel.php'>


                                      <div class="form-group last">
                                          <label class="control-label col-lg-4">* Upload Your School Logo </label>
                                          <div class="col-lg-8">
                                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                                  <div class="fileupload-new thumbnail msgSoftBoxPic" style="width: 
                                                  200px; height: 150px;">
                                                      <img src="<?php echo $sch_logo; ?>" alt="" />
                                                  </div>
                                                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 
                                                  200px; max-height: 150px; line-height: 20px;"></div>
                                                  <div>
                                                   <span class="btn btn-white btn-file pictureUploader">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> 
                                                   Select School Logo</span>
                                                   
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> 
                                                   Select School Logo</span>
                                                   <input type="file" id="uploadSchlogo" 
                                                   name="uploadPic" class="default demoDisenable" required />
                                                   </span>
                                                 
                                                  </div>
                                              </div>

												<span class="label label-danger">NOTE!</span>
												<span style="color:#ff0000">Only max image size of 2MB &amp; format 
												of <?php echo $allowedPicExt; ?> are allowed.  </span>
                                          </div>
                                      </div>
                                      

                                      <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10"> 
                              
                                          <input type="hidden" name="schoolSettings" value="schoolLogo" />                                          
                                          
                                      </div>
                                  </div>
  

                                      
                         
                 
								</form>
								<!-- / form -->
							</div>
                         
						</section>
						
					
						<section class="panel">
							<header class="panel-heading">
                              <i class="fa fa-wrench fa-lg"></i>  School  Configuration
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
						  
							<div class="panel-body wizGrade-line">
								<center><img src="loading.gif" alt="Loading >>>>>" class="configLoading" 
									  style="cursor:pointer; display:none; margin-bottom:5px;" /> </center><!-- loading image -->
								<div class="msgBoxSettings"></div>
                             	
								<!-- form -->
								<form class="form-horizontal" id="frmschoolSettings" role="form">
								
									<div class="form-group">
                                          <label for="schoolName" class="col-lg-4 control-label"> * School Name</label>
                                          <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  id="schoolName" name="schoolName" 
                                              value ="<?php echo $schoolArray[0]['school_name']; ?>"
                                              class="form-control uppWords" placeholder="Igwe King Pri/Sec Sec" >
                                          </div>
                                          </div>
                                    </div>                             
                                      
									<div class="form-group">
                                          <label for="schoolAddress" class="col-lg-4 control-label"> * School Address</label>
                                          <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-home"></i>
                                              <input type="text"  id="schoolAddress" name="schoolAddress" 
                                              value ="<?php echo $schoolArray[0]['school_address']; ?>"
                                              class="form-control uppWords" placeholder="No 004 wizGrade Avenue" >
                                          </div>
                                          </div>
                                    </div>   
									<!--	
									<div class="form-group">
                                          <label for="regPrefix" class="col-lg-4 control-label"> * School Reg No Prefix</label>
                                          <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-home"></i>
                                              <input type="text"  id="regPrefix" name="regPrefix" 
                                              value ="<?php echo $schoolArray[0]['reg_prefix']; ?>"
                                              class="form-control capWords" placeholder="Reg No Prefix eg wizGrade, OSI, IFE " maxlength="6" >
                                          </div>
											<span class="label label-danger">NOTE!</span>
                                            <span style="color:#ff0000">This are School Abbrevaition for Student Reg No. Prefix eg. wizGrade/00001, OSI/00004 etc </span> 
                                          </div>
                                    </div>   	
                                    -->  
                                      
                                    <div class="form-group">
                                          <label for="schoolCutoff" class="col-lg-4 control-label"> * Percentage 
                                          To be Promoted
                                          </label>
                                          <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="number"  id="schoolCutoff" name="schoolCutoff" 
                                              value ="<?php echo $schoolArray[0]['school_cutoff']; ?>"
                                              class="form-control" placeholder="40" >
                                          </div>
                                          </div>
                                    </div>   
									  
									<div class="form-group">										
										<label  for="term" class="col-lg-4 col-sm-4 control-label">* Current School Heads</label>											 
										<div class="col-lg-8">
												  
                                            <input type="text" class="form-control" 
                                              name="schoolHead" id="schoolHead" placeholder="Search for Current Principal/School Head"  />
        									<!-- using jquery tokenfield plugin to populate school heads -->
											<script type='text/javascript'> 
																		
																		
													<?php
													
														$schooHead = $schoolArray[0]['school_head'];
														
														list ($nurseryHead, $primaryHead, $secondaryHead) = explode (",", $schoolHead);	
														
														if(isset($nurseryHead)){  /* if not empty */ 											
															
															$schooHeadInfo = staffData($conn, $nurseryHead);  /* school staffs/teachers information */ 				
				
															list ($schHeadTitle, $schHeadName, $schHeadSex, $schHeadRank, $schHeadPic, $schHeadLName) = 
															explode ("#@s@#", $schooHeadInfo);	
															
															$schHeadTitleVal = $title_list[$schHeadTitle];
															
															$titleVal = $title_list[$schHeadTitle];
															$schoolHeadV = "$titleVal $schHeadName";	
															$schoolHeadV = trim($schoolHeadV);
															
															$schoolHeadArr = "{ value: '$nurseryHead', label: '$schoolHeadV' }";
															
														}
														
														if(isset($primaryHead)){  /* if not empty */											
															
															$schooHeadInfo = staffData($conn, $primaryHead);  /* school staffs/teachers information */ 				
				
															list ($schHeadTitle, $schHeadName, $schHeadSex, $schHeadRank, $schHeadPic, $schHeadLName) = 
															explode ("#@s@#", $schooHeadInfo);	
															
															$schHeadTitleVal = $title_list[$schHeadTitle];
															
															$titleVal = $title_list[$schHeadTitle];
															$schoolHeadV = "$titleVal $schHeadName";	
															$schoolHeadV = trim($schoolHeadV);
															
															$schoolHeadArr .= ", { value: '$primaryHead', label: '$schoolHeadV' }";
															
														}
														
														if(isset($secondaryHead)){  /* if not empty */											
															
															$schooHeadInfo = staffData($conn, $secondaryHead);  /* school staffs/teachers information */ 				
				
															list ($schHeadTitle, $schHeadName, $schHeadSex, $schHeadRank, $schHeadPic, $schHeadLName) = 
															explode ("#@s@#", $schooHeadInfo);	
															
															$schHeadTitleVal = $title_list[$schHeadTitle];
															
															$titleVal = $title_list[$schHeadTitle];
															$schoolHeadV = "$titleVal $schHeadName";	
															$schoolHeadV = trim($schoolHeadV);
															
															$schoolHeadArr .= ", { value: '$secondaryHead', label: '$schoolHeadV' }";
															
														}
														
														
													?>
									
												    $('#schoolHead').tokenfield({
													  autocomplete: {
														source: [<?php echo $staffToken; ?>],
														delay: 100
														
													  },
													  limit:3,
													  showAutocompleteOnFocus: true
												    })
													
													$('#schoolHead').tokenfield('setTokens', [<?php echo $schoolHeadArr; ?>]);
													
												    /* $('#schoolHead').on('tokenfield:createtoken', function (event) {
														var existingTokens = $(this).tokenfield('getTokens');
														$.each(existingTokens, function(index, token) {
															if (token.value === event.attrs.value)
																event.preventDefault();
														});
												    });
													*/	
													
											</script>
                                            <span class="label label-danger">NOTE!</span>
                                            <span style="color:#ff0000">School Heads are arrange in order of Nursery, Primary & Secondary School. </span> 
                                          
										</div>
									</div>  
								  
									<div class="form-group">										
										<label  for="term" class="col-lg-4 col-sm-4 control-label">*  School Bursary</label>											 
										<div class="col-lg-8">
												  
                                            <input type="text" class="form-control" 
                                              name="bursary" id="bursary" placeholder="Search for  School Bursary"  />
        									<!-- using jquery tokenfield plugin to populate bursary information -->
											<script type='text/javascript'> 
																		
																		
													<?php
													
														$bursary = $schoolArray[0]['bursary'];
														
														if(isset($bursary)){  /* if not empty */											
															
															$bursaryInfo = staffData($conn, $schoolArray[0]['bursary']);  /* school staffs/teachers information */ 				
				
															list ($bursaryTitle, $bursaryName, $bursarySex, $bursaryRank, $bursaryPic, $bursaryLName) = 
															explode ("#@s@#", $bursaryInfo);	
															
															$bursaryTitleVal = $title_list[$bursaryTitle];
															
															$titleVal = $title_list[$bursaryTitle];
															$bursaryV = "$titleVal $bursaryName";	
															$bursaryV = trim($bursaryV);
															
															$bursaryArr = "{ value: '$bursary', label: '$bursaryV' }";
															
														}
														
														
													?>
									
												    $('#bursary').tokenfield({
													  autocomplete: {
														source: [<?php echo $staffToken; ?>],
														delay: 100
														
													  },
													  limit:1,
													  showAutocompleteOnFocus: true
												    })
													
													$('#bursary').tokenfield('setTokens', [<?php echo $bursaryArr; ?>]);
													
												    $('#bursary').on('tokenfield:createtoken', function (event) {
														var existingTokens = $(this).tokenfield('getTokens');
														$.each(existingTokens, function(index, token) {
															if (token.value === event.attrs.value)
																event.preventDefault();
														});
												    });	
													
											</script>
                                              
                                          
										</div>
									</div>    
								  
								  
									<div class="form-group">										
										<label  for="term" class="col-lg-4 col-sm-4 control-label">*  School Libraian</label>											 
										<div class="col-lg-8">
												  
                                            <input type="text" class="form-control" 
                                              name="libraian" id="libraian" placeholder="Search for  School Libraian"  />
        									<!-- using jquery tokenfield plugin to populate bursary information -->
											<script type='text/javascript'> 
																		
																		
													<?php
													
														$libraian = $schoolArray[0]['libraian'];
														
														if(isset($libraian)){  /* if not empty */											
															
															$libraianInfo = staffData($conn, $schoolArray[0]['libraian']);  /* school staffs/teachers information */ 				
				
															list ($libraianTitle, $libraianName, $libraianSex, $libraianRank, $libraianPic, $libraianLName) = 
															explode ("#@s@#", $libraianInfo);	
															
															$libraianTitleVal = $title_list[$libraianTitle];
															
															$titleVal = $title_list[$libraianTitle];
															$libraianV = "$titleVal $libraianName";	
															$libraianV = trim($libraianV);
															
															$libraianArr = "{ value: '$libraian', label: '$libraianV' }";
															
														}
														
														
													?>
									
												    $('#libraian').tokenfield({
													  autocomplete: {
														source: [<?php echo $staffToken; ?>],
														delay: 100
														
													  },
													  limit:1,
													  showAutocompleteOnFocus: true
												    })
													
													$('#libraian').tokenfield('setTokens', [<?php echo $libraianArr; ?>]);
													
												    $('#libraian').on('tokenfield:createtoken', function (event) {
														var existingTokens = $(this).tokenfield('getTokens');
														$.each(existingTokens, function(index, token) {
															if (token.value === event.attrs.value)
																event.preventDefault();
														});
												    });	
													
											</script>
                                              
                                          
										</div>
									</div>    
							
								
									<span id="wait_11" style="display: none;">
    									<center><img alt="Please Wait" src="loading.gif"/></center> <!-- loading image -->
    								</span>
									<span id="result_11" style="display: none;"></span> <!-- loading div -->
									
									<div class="form-group">
										<label  for="term" class="col-lg-4 col-sm-4 control-label"> Default Language Translator</label>                                     
										<div class="col-lg-4">
												<div class="iconic-input">
												  <i class="fa fa-language"></i>
												  
												  <select class="form-control"  name="transFrom" id="transFrom">
												  
													<option value = "">Please select One</option> 
												  
													<?php
													
														foreach($translatorArr as $trans_key => $trans_value){  /* loop array */

															if ($transFrom == $trans_key){
																$selected = "SELECTED";
															} else {
																$selected = "";
															}

															echo '<option value="'.$trans_key.'"'.$selected.'>'.$trans_value.'</option>' ."\r\n";

														}	
													?>
			
			
												  </select>
												  
												</div>
												<span class="label label-danger">NOTE!</span>
												<span style="color:#ff0000">Translate Language From. </span>
										</div>
										  
										<div class="col-lg-4">
											  <div class="iconic-input">
												  <i class="fa fa-language"></i>
												  
												  <select class="form-control"  name="transTo" id="transTo">
												  
													<option value = "">Please select One</option> 
												  
													<?php
													
														foreach($translatorArr as $trans_key => $trans_value){

															if ($transTo == $trans_key){
																$selected = "SELECTED";
															} else {
																$selected = "";
															}

															echo '<option value="'.$trans_key.'"'.$selected.'>'.$trans_value.'</option>' ."\r\n";

														}	
													?>
			
			
												  </select>
												  
												</div>
												<span class="label label-danger">NOTE!</span>
												<span style="color:#ff0000">Translate Language To. </span>
											 
										</div>
										  
									</div>
									
									<div class="form-group">
                                          <label for="sTime" class="col-lg-4 col-sm-4 control-label"> Screen Lock Timer (In Minutes)</label>
                                          <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-clock-o"></i>
                                              <input type="number"  id="sTime" name="sTime" 
                                              class="form-control" placeholder="10" maxlength="5" value="<?php echo $schoolArray[0]['screen_timer']; ?>">
                                          </div>
                                       
									 <span class="label label-danger">NOTE!</span>
                                            <span style="color:#ff0000">Leave this filed empty to disenable screen lock. </span> 
                                          
										</div>
									</div>  
									
									<div class="form-group">
										<label for="ewallet" class="col-lg-4 col-sm-4 control-label">* E - Wallet (Scratch Card Pin)</label>										
									<div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-level-up"></i>
                                              
                                              <select class="form-control"  id="ewallet" name="ewallet" required>
                                              
                                				<option value = "">Please select One</option>
                                
												 <?php

														foreach($ewallet_list as $ekey => $evalue){    /* loop array */

															if ($ewallet == $ekey){
																$selected = "SELECTED";
															} else {
																$selected = "";
															}

															echo '<option value="'.$ekey.'"'.$selected.'>'.$evalue.'</option>' ."\r\n";
															

														} 

												 ?>

                                              
                                              </select>
                                          </div>
                                      </div>
									</div>									
                                      
                                    <div class="form-group">
                                      	  <input type="hidden" name="schoolSettings" value="schoolSettings" /> 
                                          <center><button type="submit" class="btn btn-danger buttonMargin demoDisenable" 
                                          id="schoolSettings">
                                          <i class="fa fa-save"></i> Save  </button></center>                                          
									</div>
                                      
                                </form>             
								<!-- / form -->	 
                                      
							</div>
						</section>
					</div>
              
                </div>                 
				<!-- / row -->	              