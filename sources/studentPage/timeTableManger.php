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
	This page is school time table manager
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */  

?>
                		
                <!-- row -->	
				<div class="row">  
					<div class="col-sm-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <i class="fa fa-calendar fa-lg"></i>  Time Table <span class="hide-res">Manager</span>
							 <span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
                          <div class="panel-body wizGrade-line">
   
							<div id="dialog" title="Cpanel" style="display:none;"> </div>
							
							<div id='loading' style='display:none'><center><img src="loading.gif" alt="Loading . . . . 
							Please Wait"/> </center></div>
							<div id="EventsCpanel"> </div>
							<div id="msgBox"> </div>
							
							<div id='wizGradePrintArea'>
							<div id="calendar" class="has-toolbar"></div>
							</div>
							
								  
					  
				
							</div>
                      </section>
					</div>
				  
				</div>	
				<!-- / row -->	

				<script type="text/javascript">
					
					/* Jquery school time table calendar script */
					
					var date = new Date();
					var d = date.getDate();
					var m = date.getMonth();
					var y = date.getFullYear(); 
					var valEmpty = '';
					
					$('#calendar').html(valEmpty);
					$('#msgBox').html(valEmpty);
					
					var calendar = $('#calendar').fullCalendar({
						theme: false,
						header: {
							left: 'prev,next today',
							center: 'title',
							right: 'month,agendaWeek,agendaDay'
						},
						selectable: true,
						
						selectHelper: true,
						
						
						events: "showTimeTable.php",
						
						loading: function(bool) {
							if (bool) $('#loading').show();
							else $('#loading').hide();
						}
						
					});
				

				</script>