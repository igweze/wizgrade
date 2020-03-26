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
	This page upload library books
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>	 		

                 	<!-- row -->	
					<div class="row">  
     				  <div class="col-lg-7">
                      <section class="panel wizgrade-section-div" id="scrollLTarget">                      
                          <header class="panel-heading">
                            <i class="fa fa-line-chart fa-lg"></i> Upload  Book 
							<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
                          <div class="panel-body wizGrade-line"> 
 
			

							<div class="msgBoxPic"></div>	                          
								<!-- form --><form class="form-horizontal" id="frmLibrary" role="form"  action="wizGrade-library-manager.php"> 
								
								<div class="form-group">
                                    <label for="semester" class="col-lg-4 col-sm-4 control-label">* Select School</label>
                                          
                                    <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              
                                              <select class="form-control"  id="schoolType" name="schoolType" required>
                                              
                                				<option value = "">Please select One</option>
												
												<?php

													foreach($school_list as $school => $schoolVal){  /* loop array */

														if ($sex == $school){
														$selected = "SELECTED";
														} else {
														$selected = "";
														}

														echo '<option value="'.$school.'"'.$selected.'>'.$schoolVal.'</option>' ."\r\n";

													}

												?>
                                              
                                              
                                              </select>
                                          </div>
                                  
                                      </div>
                                </div>
                                <br clear="all" /> 

								<span id="wait_1" style="display: none;">
								<center><img alt="Please Wait" src="loading.gif"/> <!-- loading image --></center> <!-- loading image -->
								</span>
								<span id="result_1" style="display: none;"></span> <!-- loading div --> <!-- loading div -->  
                                  
                                <span id="lib-detail-div" style="display:none;">  
                                         
								<div class="form-group">
                                      <label for="book-name" class="col-lg-4 col-sm-4 control-label">* Book Title</label>
                                      
                                      <div class="col-lg-8">
                                        
                                            <div class="iconic-input">
                                                  <i class="fa fa-book"></i>
                                                  
                                            <input type="text" class="form-control" placeholder="Book Title" 
                                            name="book-name" maxlength="100" id="book-name" style="text-transform:capitalize !important;" required />
                                            
                                            </div>
                                            
                                          </div>
                                      
								</div>
                                  
                                <div class="form-group">
                                      <label for="book-authur" class="col-lg-4 col-sm-4 control-label">* Author Name</label>
                                      
                                      <div class="col-lg-8">
                                        
                                            <div class="iconic-input">
                                                  <i class="fa fa-user"></i>
                                                  
                                            <input type="text" class="form-control" placeholder="Author Name" 
                                            name="book-author" maxlength="100" id="book-author" style="text-transform:capitalize !important;" required />
                                            
                                            </div>
                                          </div>
                                </div>
                                      
                                <div class="form-group">
                                      <label for="book-desc" class="col-lg-4 col-sm-4 control-label"> &nbsp;&nbsp;Book Descriptions</label>
                                      
                                      <div class="col-lg-8">
                                        
                                            <textarea rows="4" cols="10" class="form-control" name="book-desc" id="book-desc" 
                                            placeholder="Book Descriptions"></textarea>
                                           
                                          </div>
                                </div>
                                  
                                <div class="form-group">
                                          <label for="semester" class="col-lg-4 col-sm-4 control-label">* Book Type</label>
                                         
                                      <div class="col-lg-8">
                                              <div class="iconic-input">
                                                  <i class="fa fa-book"></i>
                                                  
                                                  <select class="form-control"  id="book-type" name="book-type" required>
                                                  
                                                    <option value = "">Please select One</option>

													<?php
                    
														foreach($libraryTypeArr as $typeB => $typeBB){  /* loop array */
						
														if ( $book_type == $typeB){
														$selected = "SELECTED";
														} else {
														$selected = "";
														}
						
														echo '<option value="'.$typeB.'"'.$selected.'>'.$typeBB.'</option>' ."\r\n";
						
														}
                    
                                                    ?>

                                                    
                                                    </select>
                     
    
                                              </div>
                                          </div>
                                    </div>
                                      
                                      
                                    <div class="form-group book-harhcopy-divs" style="display:none;">
                                    <label for="book-authur" class="col-lg-4 col-sm-4 control-label">* Number of Copies</label>
                                      
                                    <div class="col-lg-8">
                                        
                                            <div class="iconic-input">
                                                  <i class="fa fa-sort-numeric-asc"></i>
                                                  
                                            <input type="number" class="form-control" placeholder="Book Copies" 
                                            name="book-copies" maxlength="5" id="book-copies" style="text-transform:capitalize !important;" required />
                                            
                                            </div>
                                          </div>
                                    </div>
                                      
                                      
                                    <div class="form-group book-harhcopy-divs" style="display:none;">
                                      
                                      <label for="book-authur" class="col-lg-4 col-sm-4 control-label">&nbsp;&nbsp;Library Book Location</label>
                                      
                                      <div class="col-lg-8">
                                        
                                            <div class="iconic-input">
                                                  <i class="fa fa-briefcase"></i>
                                                  
                                            <input type="text" class="form-control" placeholder="Library Book Location" 
                                            name="book-location" maxlength="255" id="book-location" style="text-transform: capitalize !important;"/>
                                            
                                            </div>
                                          </div>
                                    </div>
                                     
                                      
                                    <div class="form-group book-harhcopy-divs" style="display:none;">
                                          <label for="semester" class="col-lg-4 col-sm-4 control-label">* Book Status</label>
                                         
                                      		<div class="col-lg-8">
                                              
                                              <div class="iconic-input">
                                                  <i class="fa fa-cogs"></i>
                                                  
                                                  <select class="form-control"  id="book-status" name="book-status" required>
                                                   

													<?php
                    
														foreach($libraryStatusArr as $status => $statusN){  /* loop array */
						
														if ( $book_status == $status){
														$selected = "SELECTED";
														} else {
														$selected = "";
														}
						
														echo '<option value="'.$status.'"'.$selected.'>'.$statusN.'</option>' ."\r\n";
						
														}
                    
                                                    ?>

                                                    
                                                  
                                                   </select>
                     
    
                                              </div>
                                          </div>
                                    </div>
                                  
                                  
                                    <div class="form-group" id="book-picture-div" style="display:none">
                                          <label class="control-label col-md-4">* <span id="book-name-display"> Book Upload </span> </label>
                                          <div class="col-md-8">
                                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                                  <div class="fileupload-new thumbnail msgSoftBoxPic" style="width: 
                                                  200px; height: 150px;">
                                                      <img src="<?php echo $studentPic; ?>" alt="" />
                                                  </div>
                                                  <div class="fileupload-preview fileupload-exists thumbnail" 
                                                  style="max-width: 
                                                  200px; max-height: 150px; line-height: 20px;"></div>
                                                  <div>
                                                   <span class="btn btn-white btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> 
                                                   Select File</span>
                                                   
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> 
                                                   Select File</span>
                                                   <input type="file" id="book-lib-upload" 
                                                   name="book-lib-upload" class="default" required />
                                                   </span>
                                                 
                                                  </div>
                                              </div>

                                              <span class="label label-danger">NOTE!</span>
                                             <span>Only file type of 
                                             <span id="allow-format-doc">doc, docx, pdf, xls, xlsx, txt</span> 
                                             <span id="allow-format-pic">jpg, png, jpeg, JPEG, JPG, PNG</span> 
                                             and size 10MB is allowed. 
                                             </span>
                                          </div>
                                    </div>
                                      

                                    <div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
                                          <input type="hidden" name="library-data" value="upload-lib-book" />
                                          <input type="hidden" name="allow-format" id="allow-format" value="" />
										</div>
									</div>
  
                              	
  							</div>
                            
                            
                            </span>

                              </form><!-- / form -->
                          </div>
						</section>
                      
					</div>
				
				</div>
				<!-- / row -->
                    
                		
				<!-- row -->	
				<div class="row">  
					<div class="col-lg-12">						  
					  
						<div id="wizgrade-page-div"> </div> <!-- This a div where jquery loads its contents -->					 
					 
					</div>
				</div>
				<!-- / row -->	