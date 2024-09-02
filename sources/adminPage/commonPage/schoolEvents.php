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
	This page load school event calendar
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
			
		$msg_i = "Click on Calendar Date/Cell or Event Title to Add, Edit, Update or Delete An Event";
		echo $infoMsg.$msg_i.$iEnd;

?>
 
					<!-- row -->
					<!-- row -->	
					<div class="row">  
						<div class="col-sm-12">
							<section class="panel">
								<header class="panel-heading">
								 
								 <i class="fa fa-calendar-plus-o fa-lg"></i> School Event Manager
									<span class="tools pull-right">
										<a href="javascript:;" class="fa fa-chevron-down"></a>
										<a href="javascript:;" class="fa fa-times"></a>
									</span>
								</header>
								<div class="panel-body wizGrade-line">
									
									<!-- calendar -->
									<div id="dialog" title="Cpanel" style="display:none;"> </div>
									
									<div id='loading' style='display:none'><center><img src="loading.gif" alt="Loading . . . . 
									Please Wait"/> </center></div>
									<div id="EventsCpanel"> </div>
									<div id="msgBox"> </div>
									
									<div id='wizGradePrintArea'>
									<div id="calendar" class="has-toolbar"></div>
									</div>
									<!-- /calendar -->	
					
								</div>
							</section>
						</div>
				  
					</div>	  
                    <!-- /row -->
					
                	<!-- row -->	
					<!-- row -->	
					<div class="row">    
						<div class="col-lg-12">						  
					  
							<div id="wizgrade-page-div"> </div> <!-- This a div where jquery loads its contents -->					 
					 
						</div>
					</div>
					<!-- /row -->	

					<script type="text/javascript">
					
							/* Jquery school event calendar script */
							var date = new Date();
							var d = date.getDate();
							var m = date.getMonth();
							var y = date.getFullYear();
							var saveEvent = 'saveEvent';
							var eventInput = 'eventInput';
							var emptyVal = '';
							var eventMsg = '';
							var eMsg = '';
							//$('.fc-event').remove();
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
												 
									$('#dialog').load('eventManager.php', {eventData: eventInput}); 
								
									$("#dialog").dialog({
										resizable: false,
										height:300,
										width:500,
										modal: true,
										title: 'School Events Manager',
										buttons: { 
											
											"SAVE EVENT": function() { 
												var eMsg = $('#eComment').get(0).value;
												$('#msgBox').load('eventManager.php', {eventMsg: eMsg, start: start, end: end, allDay: allDay, 
													  eventData: saveEvent });
												$('#calendar').fullCalendar('refetchEvents');
												$("#dialog").dialog( "close" );
												
												/*calendar.fullCalendar('renderEvent', {
														eventMsg: eMsg,
														start: start,
														end: end,
														allDay: allDay
												},
												true // make the event "stick"
										
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
								
								eventClick: function(calEvent, jsEvent, view) {

									id = calEvent.id;
									$('#dialog').html(emptyVal);
									var loadEvent = 'loadEvent'; 
									var updateEvent = 'updateEvent'; 
									var deleteEvent = 'deleteEvent'; 
									
									$('#dialog').load('eventManager.php', {eventID: id, eventData: loadEvent}); 

									$("#dialog").dialog({
										resizable: false,
										height:300,
										width:500,
										modal: true,
										title: 'School Event Manager',
										buttons: {
											
											UPDATE: function() { 
												var eventMsg = $('#eventComment').get(0).value;
												$('#msgBox').load('eventManager.php', {eventID: id, eventData: updateEvent, eventMsg: eventMsg});
												$('#calendar').fullCalendar('refetchEvents');
												$("#dialog").dialog( "close" );
											},
										 
											DELETE: function() {
												$('#msgBox').load('eventManager.php', {eventID: id, eventData: deleteEvent});
												$('#calendar').fullCalendar('refetchEvents');
												$("#dialog").dialog( "close" );
											},
										 
											CLOSE: function() {
												$("#dialog").dialog( "close" );
											}

										}
									});
								},
								
								events: "eventManager.php?eventData=showEvent",
										
								loading: function(bool) {
									if (bool) $('#loading').show();
									else $('#loading').hide();
								}
								
							});
						

					</script>  