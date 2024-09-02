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
	This script load page widgets
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

?>
			
			<!-- row -->	
 
			<div class="row widget-background">
 				
					<div class="col-lg-6">
                      <section class="panel widget-background">
                          
                          <div class="panel-body">
								
								<figure>
								  <div class="face top"><p id="sec-clock"></p></div>
								  <div class="face front"><p id="min-clock"></p></div>
								  <div class="face left"><p id="hour-clock"></p></div>
								</figure>
				
							</div>
                      </section>
					</div>
					 
					
					<div class="col-lg-6">
					<section class="panel"> 
		
                          <div class="weather-bg">
                              <div class="panel-body"> 
							  
									<a class="weatherwidget-io" href="https://forecast7.com/en/9d087d40/abuja/" data-label_1="ABUJA" data-label_2="WEATHER" data-font="Ubuntu" data-days="5" data-theme="original" data-basecolor="rgba(31, 86, 124, 0)" data-highcolor="#f3e505" data-lowcolor="#f7f8f9" >ABUJA WEATHER</a>
									<script>
									!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
									</script>

                              </div>
                          </div> 
                      </section>
					  </div>

				  
			</div>
			<!-- / row -->	