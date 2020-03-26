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
	This page is achool annoucements manager
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 
 

if(!session_id()){
    session_start();
}

		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');

        require 'configwizGrade.php';  /* load wizGrade configuration files */	    
		
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */
		 
		try {
	 
			$broadcastDataArr = broadcastData($conn);  /* school annoucement/broadcast array */
			$broadcastDataCount = count($broadcastDataArr);
			
		}catch(PDOException $e) {
		
				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
		 
		}	 

?>					
				<!-- row -->	
				<div class="row">  
					<div class="col-sm-12">
							<section class="panel">
							<header class="panel-heading">
                              
								<i class="fa fa-bullhorn fa-lg"></i> School Annoucements  
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line">
						  

								<button class="paginate-page display-none"  type="submit">Paginate Page</button> 
								<!-- table -->		
								<table  class='table table-hover style-table wizGradeTBPage' id=''>
										<thead><tr>
										<th>S/N</th>                         
										<th class='text-left'>Title</th> 						 
										<th class='text-left'>Date</th> 
										<th class='text-left'>Tasks</th>
										</tr></thead> <tbody>


        <?php
						
										if($broadcastDataCount >= $fiVal){  /* check array is empty */		
																	
											
											for($i = $fiVal; $i <= $broadcastDataCount; $i++){  /* loop array */	
												
												$bID = $broadcastDataArr[$i]["bID"]; 
												$bTitle = $broadcastDataArr[$i]["bTitle"];
												$broadcastMsg = $broadcastDataArr[$i]["broadcastMsg"]; 
												$date = $broadcastDataArr[$i]["date"]; 
												 
												$bID = trim($bID); 
												
												$date = date("j M Y", strtotime($date)); 
												
												$serailNo++;
								

$broadcastData =<<<IGWEZE
        
								<tr id="row-$bID" >
								<td class='text-left' width="5%">$serailNo</td>  
								<td class='text-left' width="70%"> $bTitle  </td>  
								<td class='text-left' width="15%"> $date </td>  
								<td  class='text-left' width="10%"> 
								
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right"> 
												<li>
												<a href='javascript:;' id='$bID' class ='viewBroadcast'>
												<button class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i></button> View</a>
												</li> 
											</ul>		
													
													
									</div><!-- /btn-group -->
								
								
								</td>
								</tr>
		
IGWEZE;
                               
												echo $broadcastData; 

											} 
								
										} 
				
?>
                         
									</tbody>
									</table>
									<!-- / table --> 
			
							</div>
						</section>
						<!--tab nav start-->

						 
					</div>
				  
				</div>
				<!-- / row -->  
				
							  
							  
							  
				<a href="#editModal" data-toggle="modal" id="modalEditBtn" class=""> </a>

				<div class="modal fade" id="editModal" tabindex="-1" role="dialog" 
					aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" 
                                              data-dismiss="modal" aria-hidden="true">
											  <span style='color:#fff !important;'>&times;</span></button>
                                              <h4 class="modal-title"> Annoucements  Manager
											  </h4>
                                          </div>
                                          <div class="modal-body modal-body-scroll">
					 
										 
												<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="editLoader"  
																  style="cursor:pointer; display:none; margin-bottom:5px;" /></center>
								
												<div id="editMsg"> </div>
														
														
												<div class="slideUpFrmUDiv">
									 
													<section class="panel">
													
													<div class="panel-body"> 
													
														<div id="editBroadcastDiv"></div> 
														  
													</div>
													
													</section>
										  
												</div>

                                          </div>
                                          <div class="modal-footer slideUpFrmDiv">
                                              
											  <button data-dismiss="modal" class="btn btn-danger" 
                                              type="button">Close</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
					 