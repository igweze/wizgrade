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
	This script handle school bursary configuration
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		if (!defined('fobrain'))

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
			require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */
		 
			try {
			 
				$burConfigsArray = bursaryConfigsArrays($conn);  /* school bursary configuration  */
				$currency = $burConfigsArray[0]['currency'];
				$bankDetails = htmlspecialchars_decode($burConfigsArray[0]['bank']);
				//$bankDetails = nl2br($bankDetails); 
					
			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			}
		
		
		
?>		
				<!-- row -->	
                <!-- row -->	
					<div class="row">      
					<div class="col-sm-8"> 
					
                      <section class="panel">
                          <header class="panel-heading">                              
							  <i class="fa fa-wrench fa-lg"></i> Busary Configuration
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
						  
                          <div class="panel-body wizGrade-line" id="scrollLTarget">
							  <center><img src="loading.gif" alt="Loading >>>>>" id="settingsLoader" 
							  style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>
							  <div id="msgBoxLib"></div> 
				
								<!-- form -->
                             	<!-- form --><form class="form-horizontal" id="frmburConfiguration" role="form"> 
				
									<div class="form-group">
                                      <label  for="term" class="col-lg-5 col-sm-5 control-label">* Select Currency</label>
                                     
									  <div class="col-lg-7">
											  <div class="iconic-input">
												  <i class="fa fa-money"></i>
												  
												  <select class="form-control"  name="currency" id="currency" required>
												  
													<option value = "">Please select One</option> 
												  
													<?php
													
														foreach($currencySymbols as $curr_key => $curr_value){  /* loop array */

															if ($currency == $curr_key){
																$selected = "SELECTED";
															} else {
																$selected = "";
															}

															echo '<option value="'.$curr_key.'"'.$selected.'>'.$curr_key.' - 
															'.$curr_value.'</option>' ."\r\n";

														}	
													?> 
													
												  </select>
												  
											  </div>
										  </div>
									  </div>

									   <div class="form-group">
                                      <label for="book-desc" class="col-lg-5 col-sm-5 control-label"> &nbsp;&nbsp; Banking Details</label>
                                      
                                      <div class="col-lg-7">
                                        
                                            <textarea rows="4" cols="10" class="form-control" name="bank" id="bank" 
                                            placeholder="School Banking Details"><?php echo $bankDetails; ?></textarea>
                                           
                                          </div>
                                      </div>     
									  
                                      
                                      <div class="form-group"> 
                                      	  <input type="hidden" name="libData" value="burConfigs" /> 
                                          <center><button type="submit" class="btn btn-danger buttonMargin demoDisenable" 
                                          id="burConfiguration">
                                          <i class="fa fa-save"></i> Save </button></center> 
                                  </div>
                                      
                                </form><!-- / form -->                         
								<!-- / form -->
                                      
                          </div>
                      </section>
                  </div>
				  
				</div>
				<!-- / row -->	 