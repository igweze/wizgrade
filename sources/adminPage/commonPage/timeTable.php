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
	This page is school time table manager
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
			
		$msg_i = "Click on Calendar Date/Cell or TimeTable Title to Add, Edit, Update or Delete TimeTable";
		echo $infoMsg.$msg_i.$iEnd;

?>

		

                <!-- row -->	
					<div class="row">  
					<div class="col-sm-12">
                      <section class="panel">
                          <header class="panel-heading">
                             
							 <i class="fa fa-calendar fa-lg"></i> School TimeTable <span class="hide-res">Manager</span>
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
                          <div class="panel-body wizGrade-line">
   
							<div id="dialog" title="Cpanel" style="display:none;"> </div>
							
							<div id='loading' style='display:none'><center><img src="loading.gif" alt="Loading . . . . 
							Please Wait"/> </center></div>
							<div id="TimeTablesCpanel"> </div>
							<div id="msgBox"> </div>
							
							<div id='wizGradePrintArea'>
							<div id="calendar" class="has-toolbar"></div>
							</div> 
					  
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

				<script type="text/javascript"> 

					/* Jquery school time table calendar script */
					
					var date = new Date();
					var d = date.getDate();
					var m = date.getMonth();
					var y = date.getFullYear();
					var saveTimeTable = 'saveTimeTable';
					var timeTableInput = 'timeTableInput';
					var emptyVal = '';
					var timeTableMsg = '';
					var eMsg = '';
					//$('.fc-timeTable').remove();
					$('#calendar').html(emptyVal);
					$('#msgBox').html(emptyVal);
					
					var calendar = $('#calendar').fullCalendar({
						
						theme: false,
						header: {
							left: 'prev,next today',
							center: 'title',
							right: 'month,agendaWeek,agendaDay'
						},
						selectable: true,
						
						selectHelper: true,
						select: function(start, end, allDay) {
						
							var start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
							var end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
											 
							$('#dialog').load('timeTableManager.php', {timeTableData: timeTableInput}); 
						
							$("#dialog").dialog({
							
								resizable: false,
								height:300,
								width:500,
								modal: true,
								title: 'School Time Tables Manager',
								buttons: { 
							
									"SAVE": function() { 
									
										var eMsg = $('#eComment').get(0).value;
										$('#msgBox').load('timeTableManager.php', {timeTableMsg: eMsg, start: start, end: end, allDay: allDay, 
											  timeTableData: saveTimeTable });
										$('#calendar').fullCalendar('refetchTimeTables');
										$("#dialog").dialog( "close" ); 
										
										/*calendar.fullCalendar('renderTimeTable', {
												timeTableMsg: eMsg,
												start: start,
												end: end,
												allDay: allDay
										},
										true // make the timeTable "stick"
								
										);*/ 
						
									},
								 
						
									CLOSE: function() {
										$("#dialog").dialog( "close" );
									}

								}
							});
										
							calendar.fullCalendar('unselect');
						
						},
				
						editable: true,
						droppable: false,
						draggable: false,
						
						timeTableClick: function(calTimeTable, jsTimeTable, view) {

							id = calTimeTable.id;
							$('#dialog').html(emptyVal);
							var loadTimeTable = 'loadTimeTable'; 
							var updateTimeTable = 'updateTimeTable'; 
							var deleteTimeTable = 'deleteTimeTable'; 
							
							$('#dialog').load('timeTableManager.php', {timeTableID: id, timeTableData: loadTimeTable}); 

							$("#dialog").dialog({
								resizable: false,
								height:300,
								width:500,
								modal: true,
								title: 'School TimeTable Manager',
								buttons: {
									UPDATE: function() { 
										var timeTableMsg = $('#timeTableComment').get(0).value;
										$('#msgBox').load('timeTableManager.php', {timeTableID: id, timeTableData: updateTimeTable, timeTableMsg: timeTableMsg});
										$('#calendar').fullCalendar('refetchTimeTables');
										$("#dialog").dialog( "close" );
									},
								 
									DELETE: function() {
										$('#msgBox').load('timeTableManager.php', {timeTableID: id, timeTableData: deleteTimeTable});
										$('#calendar').fullCalendar('refetchTimeTables');
										$("#dialog").dialog( "close" );
									},
								 
									CLOSE: function() {
										$("#dialog").dialog( "close" );
									}

								}
							});
						},
						
						events: "timeTableManager.php?timeTableData=showTimeTable",
						
						loading: function(bool) {
							if (bool) $('#loading').show();
							else $('#loading').hide();
						}
						
					}); 

				</script>