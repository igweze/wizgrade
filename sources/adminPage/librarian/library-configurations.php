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
	This page load library configuration page
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
		 
		try {
		 
  			$libConfigsArray = libraryConfigsArrays($conn);
				
		}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		} 
		
?>		
					
				<!-- row -->	
				<div class="row">                     
					
					<div class="col-sm-7">	
					
						<section class="panel">
							<header class="panel-heading">
                            <i class="fa fa-wrench fa-lg"></i> Library Configuration
							<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header> 
						  
							<div class="panel-body wizGrade-line" id="scrollLTarget">
								<center><img src="loading.gif" alt="Loading >>>>>" id="settingsLoader" style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>
								<div id="msgBoxLib"></div>
							  
								<!-- form --><form class="form-horizontal" id="frmlibConfiguration" role="form">
									<div class="form-group">
										<label for="numApply" class="col-lg-5 control-label">* No. of Books A Student Can Apply</label>
										<div class="col-lg-7">
										<div class="iconic-input">
										<i class="fa fa-user-plus"></i>
										<input type="number"  id="numApply" name="numApply" 
										value ="<?php echo $libConfigsArray[0]['book_no_apply']; ?>"
										class="form-control" placeholder="10" maxlength="3" >
										</div>
										</div>
									</div>                             

									<div class="form-group">
										<label for="numBorrow" class="col-lg-5 control-label">* No. of Books A Student Can Borrow</label>
										<div class="col-lg-7">
										<div class="iconic-input">
										<i class="fa fa-user-circle"></i>
										<input type="number"  id="numBorrow" name="numBorrow" 
										value ="<?php echo $libConfigsArray[0]['book_no_borrow']; ?>"
										class="form-control" placeholder="5" maxlength="3" >
										</div>
										</div>
									</div>    


									<div class="form-group">
										<label for="dateline" class="col-lg-5 control-label">* Libary Book Dateline (In Days)</label>
										<div class="col-lg-7">
										<div class="iconic-input">
										<i class="fa fa-clock-o"></i>
										<input type="number"  id="dateline" name="dateline" 
										value ="<?php echo preg_replace("/[^0-9']/", "", $libConfigsArray[0]['book_dateline']); ?>"
										class="form-control" placeholder="30" maxlength="3" >
										</div>
										</div>
									</div>    


									<div class="form-group">
										<input type="hidden" name="libData" value="libConfigs" />             
										<center><button type="submit" class="btn btn-danger buttonMargin demoDisenable" 
										id="libConfiguration">
										<i class="fa fa-save"></i> Save </button></center>
									</div>

								</form><!-- / form -->                        

                                      
							</div>
						</section>
					</div>
              
                </div>
				<!-- / row -->  