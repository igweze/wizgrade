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
	This page load bursary dashboard
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */  

if(!session_id()){
    session_start();
}

		define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */
		 
		require_once ($wizGradeGlobalDir.'/widgets.php');   /* include page widget */ 
 
?>
 	
 
			<!--value box start -->
            <div class="row value-box" style="margin:30px 10px 0px 0px">

				<div class="col-lg-12">
					<div class="panel">
				  
					 <div class="panel-heading">
							<i class="fa fa-line-chart fa-lg"></i> <span class="hide-res">School</span>  Transaction <span class="hide-res">Summary</span> 
							<span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                      </div>	
                     
                      <div class="panel-body wizGrade-line">
					 			  
								  
							<div class="form-group ">
                                     
                                      <div class="col-md-6 pull-right">
                                          <div data-date="2018-01-01T15:25:00Z" class="input-group date chartYears">
                                              <input type="text" class="form-control" readonly="" size="16" id="chartYears">
                                              <div class="input-group-btn">
                                                  <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
												    <button type="button" class="btn btn-white date-set"><i class="fa fa-calendar"></i> 
													Select Year <span class="hide-res">Summary To View Below</span></button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

								  
						<br clear="all"/ >
						<br clear="all"/ > 
						
						
							<div id = "bursaryChart">
							
							
									<?php require_once 'busaryCharts.php'; ?>
							
							</div> 
						
						
						</div>
				  
					</div>

				</div>
		  				  
            </div> 
            <!-- value box end -->	
				
				
			<!-- school annoucement start -->	
			<div class="row" style="margin:15px 10px 0px 0px">
					<div class="col-lg-12">
                      <section class="panel">
                        <header class="panel-heading">
                             <i class="fa fa-bullhorn fa-lg"></i> <span class="hide-res">School</span> Annoucements  
							 <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                        </header>
                        <div class="panel-body wizGrade-line">
								<div class="col-lg-12">
								  <section class="panel">
									  
									  <div class="panel-body wizGrade-linea">
											<!-- school annoucement start -->  
											 
											<?php
											try {
										 
												$broadcastDataArr = broadcastData($conn);  /* school annoucement/broadcast array */
												$broadcastDataCount = count($broadcastDataArr);
												
											}catch(PDOException $e) {
											
													wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
											 
											} 
														
											?>			

								<button class="paginate-page display-none"  type="submit">Paginate Page</button> 
										
								<table  class='table table-hover style-table wizGradeTBPage' id=''>
										<thead><tr>
										<th>S/N</th>                         
										<th class='text-left'>Title</th> 						 
										<th class='text-left'>Date</th> 
										<th class='text-left'>Tasks</th>
										</tr></thead> <tbody>

        <?php
						
									if($broadcastDataCount >= $fiVal){	 
											
											for($i = $fiVal; $i <= $broadcastDataCount; $i++){	
												
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
													
									</div><!-- /btn-group --> 
								
								</td>
								</tr>
		
IGWEZE;
                               
												echo $broadcastData;
								
								

											} 
								
								
									}else{
										
												$msg_i = "Ooooooops, there is no school annoucement to show at the momment"; 
												echo $infMsg.$msg_i.$msgEnd;
										
									}	


				
          ?>
                        
                        
									</tbody></table>
											
											<!-- school annoucement end -->  
							
										</div>
								  </section>
								</div>  
				
						</div>
                      </section>
					</div>
				  
				</div>
				<!-- school annoucement end -->				
				   
			
				<!-- row -->
				<div class="row" style="margin:25px 10px 0px 0px">
					<div class="col-lg-12">
                      <section class="panel">
                        <header class="panel-heading">
                             <i class="fa fa-calendar fa-lg"></i> School Events 
							 <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                        </header>
                        <div class="panel-body wizGrade-line">
								<div class="col-lg-12">
								  <section class="panel">
									  
									  <div class="panel-body wizGrade-linea">
											<!-- school event calendar start -->  
											<div id="dialog" title="Cpanel" style="display:none;"> </div>
											
											<div id='loading' style='display:none'><center><img src="loading.gif" alt="Loading . . . . 
											Please Wait"/> </center></div>
											<div id="EventsCpanel"> </div>
											<div id="msgBox"> </div>
											
											<div id='wizGradePrintArea'>
												<div id="calendarH" class="has-toolbar"></div>
											</div> 
											<!-- school event calendar end -->  
							
										</div>
								  </section>
								</div> 
								 
				
						</div>
                      </section>
					</div>
				  
				</div> 
				<!-- / row -->
 
		  
				<!-- broadcast information edit pop up modal start -->	
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
			  
				<script type='text/javascript'>  $('.dpYears').datepicker();   </script> 
				<!-- broadcast information edit pop up modal end -->	 
			  
                <script type='text/javascript' src='<?php echo $wizGradeTemplate; ?>js/css-clocks.js'></script> 
				 
				<script type="text/javascript">
				

					var date = new Date();
						var d = date.getDate();
						var m = date.getMonth();
						var y = date.getFullYear();
						var InsertCalData = 'InsertTimetable';
						var CalInputData = 'LoadTimetableInputs';
						var valEmpty = '';
						
						$('#calendarH').html(valEmpty);
						$('#msgBox').html(valEmpty);
						
						var calendar = $('#calendarH').fullCalendar({
							theme: false,
							header: {
								left: 'prev,next today',
								center: 'title',
								right: 'month,agendaWeek,agendaDay'
							},
							selectable: true,
							
							selectHelper: true,
							
							
							events: "eventManager.php?eventData=showEvent",
							
							loading: function(bool) {
								if (bool) $('#loading').show();
								else $('#loading').hide();
							}
							
						});
					

				</script>
          
                 

								