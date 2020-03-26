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
	This script handle student online assignment
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	
				
		if ($_REQUEST['onlineAssignData'] == 'startAssign') {  /* load assignment module */
						
			$eID =   preg_replace("/[^0-9]/", "", $_REQUEST['eID']);
			
			/* script validation */
			
			if ($eID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur to retrieve assign information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   		}else{
				
				
				try {
						$onlineAssignInfoArr = onlineAssignInfo($conn, $eID);  /* online student assignment information */
						$sessionID = $onlineAssignInfoArr[$fiVal]["session"];
						$level = $onlineAssignInfoArr[$fiVal]["level"];
						$eTerm = $onlineAssignInfoArr[$fiVal]["eTerm"];
						$class = $onlineAssignInfoArr[$fiVal]["class"];
						$eTitle = $onlineAssignInfoArr[$fiVal]["eTitle"];
						$eSubject = $onlineAssignInfoArr[$fiVal]["eSubject"];
						$eDetail = htmlspecialchars_decode($onlineAssignInfoArr[$fiVal]["eDetail"]);
						$eTime = $onlineAssignInfoArr[$fiVal]["eTime"];
						$eTerm = $term_list[$eTerm];

						$session = wizGradeSession($conn, $sessionID);  /* school session  */
						$sessionS = ($session + $fiVal);
						$eDetail = nl2br($eDetail);	
						
						$assignQuestionsArr = assignQuestions($conn, $eID);  /* online assignment question array */
						shuffle($assignQuestionsArr);
						array_unshift($assignQuestionsArr,"");
						unset($assignQuestionsArr[0]);
						$countQuestion = count($assignQuestionsArr);
						
						$levelArray = studentLevelsArray($conn); /* student level array */	
				
						array_unshift($levelArray,"");
						unset($levelArray[0]);
						
						
						$assignLevel = $levelArray[$level]['level'];
						
						
$onlineAssignData =<<<IGWEZE
        
						<div class="col-lg-12">
							  <!-- exam assignment -->
							  <section class="panel">
								  <div class="exam-head">
									  <span class="hide-res">
										  <i class="fa fa-book"></i>
									  </span>
									  <h3>$eSubject</h3>
									  <span class="rev-combo pull-right">
										 $eTime Mins
									  </span>
								  </div>
								  
								  <div class="panel-footer exam-foot">
										<ul>
										<section style="padding:15px !important;  font-weight:700;">
										
											<p><strong><u><i>ASSIGNMENT TITLE: $eTitle </i></u></strong></p>  
										
											<strong><u><i>ASSIGNMENT INSTRUCTIONS</i></u></strong> <br clear="all" />
											1. You are expected to select only one option as your answer to each question.
											<br clear="all" /><br clear="all" />

												2. You have $eTime minutes which will be counting down at the top right corner of 
												the test page to take this test.
												<br clear="all" /><br clear="all" /> 
												 
												3. If you are unable to complete the test in time, it will automatically save 
												and submit what you were able to attempt for assessment.
												<br clear="all" /><br clear="all" />

												4. If you do not have an instant idea of a question you can skip it by clicking on 
												the next button, you can 
												re-attempt the skipped question when you have attempted others. Meanwhile at the 
												end of the test, you will have access to the 
												various answers for the different questions.<br clear="all" /><br clear="all" />
												
												<p><strong><u><i>Wishes you best of LUCK !</i></u></strong></p> 

										</section>
									  </ul>		
									  <ul>
										  <li class="first active">
											  <a href="javascript:;">
												  <i class="fa fa-calendar"></i>
												  $eTerm 
											  </a>
										  </li>
										  <li class="active">
											  <a href="javascript:;">
												  <i class=" fa fa-book"></i>
												 $assignLevel $class
											  </a>
										  </li>
										  <li class="last active">
											  <a href="javascript:;" class="assignPage">
												  <i class="fa fa-chevron-left"></i>
												  Go Back
											  </a>
										  </li>
										  
										  
									  </ul>
									  
									  <ul>
										  <li class="first active">
											  <a href="javascript:;">
												  <i class="fa fa-clock-o"></i>
												  $eTime Mins
											  </a>
										  </li>
										  <li class="active">
											  <a href="javascript:;">
												  <i class="fa fa-question-circle-o"></i>
												  $countQuestion <span class="hide-res">Question/s</span>
											  </a>
										  </li>
										  <li class="last active">
											  <a href="javascript:;" class="assignQuestion" id="wizGrade-$eID">
												  <i class="fa fa-cubes"></i>
												  Start <span class="hide-res">Test</span>
											  </a>
										  </li>
										  
										  
									  </ul>
								  </div>
							  </section>
							  <!-- exam assignment -->
							  
							   </div>
		
IGWEZE;
                               
		                  		echo $onlineAssignData;
								
						
					}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
					}	
				
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
			}	
			
		}elseif ($_REQUEST['onlineAssignData'] == 'assignQuestion') {  /* start assignment question */			
			
			$eID =   preg_replace("/[^0-9]/", "", $_REQUEST['eID']);
			
			/* script validation */
			
			if ($eID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur to retrieve assign information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   		}else{

				try {
						$onlineAssignInfoArr = onlineAssignInfo($conn, $eID);  /* online student assignment information */
						$sessionID = $onlineAssignInfoArr[$fiVal]["session"];
						$level = $onlineAssignInfoArr[$fiVal]["level"];
						$eTerm = $onlineAssignInfoArr[$fiVal]["eTerm"];
						$class = $onlineAssignInfoArr[$fiVal]["class"];
						$eTitle = $onlineAssignInfoArr[$fiVal]["eTitle"];
						$eSubject = $onlineAssignInfoArr[$fiVal]["eSubject"];
						$eDetail = htmlspecialchars_decode($onlineAssignInfoArr[$fiVal]["eDetail"]);
						$eTime = $onlineAssignInfoArr[$fiVal]["eTime"];
						$eTerm = $term_list[$eTerm];

						$session = wizGradeSession($conn, $sessionID);  /* school session  */
						$sessionS = ($session + $fiVal);
						$eDetail = nl2br($eDetail);	
						
						$assignQuestionsArr = assignQuestions($conn, $eID);  /* online assignment question array */
						shuffle($assignQuestionsArr);
						array_unshift($assignQuestionsArr,"");
						unset($assignQuestionsArr[0]);
						$assignQuestionsCount = count($assignQuestionsArr);
						
				 }catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
				 }					
				 
				 
					if($assignQuestionsCount >= $fiVal){  /* check array is empty */			
								
								$assignSeconds =	($eTime * 60);
								
								for($i = $fiVal; $i <= $assignQuestionsCount; $i++){  /* loop array */	
								
									$qID = $assignQuestionsArr[$i]["qID"];
									$eID = $assignQuestionsArr[$i]["eID"];
									$question = htmlspecialchars_decode($assignQuestionsArr[$i]["question"]);
									$qPicture = $assignQuestionsArr[$i]["qPicture"];
									$qOptions = htmlspecialchars_decode($assignQuestionsArr[$i]["qOptions"]);
									$qAnswer = htmlspecialchars_decode($assignQuestionsArr[$i]["qAnswer"]);
									$qMark = $assignQuestionsArr[$i]["qMark"];									
									$question = nl2br($question);
									$qNo++;		
									
									
									$qOptionsArr = explode(", ", $qOptions);
									shuffle($qOptionsArr);
									
									foreach($qOptionsArr as $optKey => $options){  /* loop array */
											
											$optNo++;
											
											if($options == $qAnswer){												
												$optVal = $fiVal;
												$ansQClass = "";//correctAns	
											}else{
												$optVal = $i_false;
												$ansQClass = "";
											}	

											$optionLists .= '<p class='.$ansQClass.' width="300px;" id="p-'.$optNo.'-'.$qMark.'-'.$qNo.'-'.$optVal.'">

											    <input type="radio" id="qOpt-'.$optNo.'-'.$qMark.'-'.$qNo.'-'.$optVal.'" 
												 name="qOpt-'.$qNo.'" value="'.$optVal.'"/>
												<label for="qOpt-'.$optNo.'-'.$qMark.'-'.$qNo.'-'.$optVal.'"><span></span>'.$options.'</label>
												</p>';//
											$ansQClass = '';		
									
									}
									
									$optNo = "";
									
									if($qMark != ""){
										
										if($qMark > $fiVal){
											
											$qMarkV = "Marks";
											
										}else{ $qMarkV = "Mark"; }	
										
										$qMarkDiv = "$qMark $qMarkV";
										
									}

									if($qPicture != ""){

										$eQpic = $wizGradeQuestionDir.$qPicture;
										$eQpicDiv = "<img src='$eQpic' class='pull-right questionImg' alt='Question $qNo Image' />";
												
									}else{ $eQpicDiv = ""; }				


$questNum =<<<IGWEZE
        							  
									 
                            <button class="eBtn btn btn-white assignQuestNum" id="eQNo-$qNo" type="button">$qNo</button>
                                     
		
IGWEZE;
                               
									$questionNum .= $questNum;
									

$questDiv =<<<IGWEZE
        					<div class="question-$qNo" id="question-$qNo">		  
							
							<h3> <i class="fa fa-question-circle"></i> Question <b><i>$qNo</i></b> of $assignQuestionsCount <b><i>($qMarkDiv)</i></b></h3>
							  
							<section class="questionStyle">
								$question 
							</section>
							  
							<section class="radios optionsQDiv">
							
								$eQpicDiv
								
                                $optionLists
											  
                            </section>
							
							</div>
		
IGWEZE;
                               
									$questionDiv .= $questDiv;
									
									$optionLists = "";

									
								}
					}					
								

?>
                 	  
                    
			<!-- row -->		
			<div class="row">
                  <div class="col-lg-4">
                      
                      <section class="panel">
                          <div class="panel-body">
						  
						<header class="panel-heading">
                              Question Status
                          </header>
						  
                             
                              <div class="task-thumb-details assignQuestionDiv">
                                 
								  
								  <div class="btn-toolbar">									
									  
                                      <?php echo $questionNum; ?>									
									  
                                  </div>
                              </div>
							  
                          </div>
						  <!-- table -->
                          <table class="table table-hover style-table"  id="questDescTB">
                              <tbody>
                                <tr>
                                    <td>
                                        <button class="btn btn-info eBtnDesc" type="button"></button>
                                    </td>
                                    <td class="text-left">Answered</td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-default eBtnDesc" type="button"></button>
                                    </td>
                                    <td class="text-left"> Not Answered</td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-success eBtnDesc" type="button"></button>
                                    </td>
                                    <td class="text-left">Review Later</td>
                                   
                                </tr>
                                <tr>
                                    <td>
                                        
                                          <button class="btn btn-white eBtnDesc" type="button"></button>
                                      
                                    </td>
                                    <td class="text-left">Not Visited</td>
                                    
                                </tr>
                              </tbody>
                          </table>
						  <!-- / table -->
						  <!-- table -->
						  <table class="table table-hover style-table display-none" id="ansDescTB">
                              <tbody>
                                <tr>
                                    <td>
                                        <button class="btn btn-success eBtnDesc" type="button"></button>
                                    </td>
                                    <td class="text-left">Correct Answer</td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-info eBtnDesc" type="button"></button>
                                    </td>
                                    <td class="text-left"> Not Answered (Correct)</td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <button style="background-color:#ee0000 !important" 
										class="btn  eBtnDesc" type="button"></button>
                                    </td>
                                    <td class="text-left">Wrong Answer</td>
                                   
                                </tr>
                               
								
								
                              </tbody>
                          </table>
						  <!-- / table -->

<?php


$assignSummary =<<<IGWEZE

						
						<!-- table -->
						
						<table class="table table-hover style-table display-none" id="assignSummary">
                              <tbody>
							  
								<tr>

                                    <td class="text-left" style="padding-left:25px !important"><strong>Your time has elapsed!</strong></td>
                                    
                                </tr>
								
								 <tr>

                                    <td class="text-left" style="padding-left:25px !important"><strong>Time Spent:</strong> $eTime Minutes</td>
                                    
                                </tr>
								
								<tr>
								
                                    <td class="text-left" style="padding-left:25px !important"> <strong>Course Subject </strong>: Biology </td>                                    
                                    
                                </tr>
								
								<tr>
								
                                    <td class="text-left" style="padding-left:25px !important"> <strong>Below is Your Assign Performance</strong> </td>                                    
                                    
                                </tr>
								
                                
                                
                                <tr>
                                    <td class="text-left" style="padding-left:25px !important"> You answered
									<strong><span id="correctAnswer"></span></strong> out of 
									<strong>$assignQuestionsCount</strong> questions correctly! </td>                                    
                                   
                                </tr>
                               
								
								<tr>

                                    <td class="text-left" style="padding-left:25px !important">You  
									score <strong><span id="studentScore"></span></strong> out of 
									<strong><span id="assignScore"></span></strong> Marks, 
									(<strong><span class="scorePercent"></span>%</strong>)</td>
                                    
                                </tr>
								
								<tr>

                                    <td class="text-left" style="padding-left:25px !important">
									
									<div class="pull-left">Your Score Average : <strong><span class="scorePercent"></span>%</strong></div>
									<br clear="all"/>
									<div class="progress progress-striped active progress-sm">
									  <div class="progress-bar progress-bar-success styleProgress"  role="progressbar" 
									  aria-valuenow="" 
									  aria-valuemin="0" aria-valuemax="">
										  
									  </div>
									</div>
								
                                      
							  
									</td>
                                    
                                </tr>
								
								
							  
                              </tbody>
                          </table>	
						<!-- / table -->
						  
IGWEZE;

						echo $assignSummary;

?>							

						  
						  
                      </section>
                      
                  </div>
                  <div class="col-lg-8">
                      
                      <section class="panel">
                          <div class="panel-body progress-panel">
						  
						  <header class="panel-heading">
                              Assign Questions
                          </header>
						  
						  <div class="topQuestDiv">
							
									<div id="assignProgressDiv">
									
										<div class="percent pull-left"></div>
										<div class="elapsed pull-right"></div><br clear="all"/>
										<div class="pbar"></div>
									
									</div>
									

							</div>
							
							<div class="display-none reviewAssign pull-right" style="margin: 10px 0px 10px 0px;">
							<button type="button" class="btn btn-success" id="reviewAssign">
								<i class="fa fa-eye"></i> Review My Assign </button></div>
						
							<div class="assignQuestionDiv" id="assignQuestionDiv">
							  
								<div class="assignQuestDiv">  
								  
									<?php echo $questionDiv; ?>
								
								</div>
											  
								<div class="panel-body" style="clear:both;">
									
									<!-- question navigation button -->
									<button type="button" class="btn btn-primary pull-left" id="prev"><i class="fa fa-chevron-left"></i> Previous</button>
									<button type="button" class="btn btn-primary pull-right" id="next">Next <i class="fa fa-chevron-right"></i> </button>
									<center>
									<button type="button" class="btn btn-success" id="reviewQuest"><i class="fa fa-eye"></i> <span class="hide-res"> Review Later</span> </button>
									<!--<button type="button" class="btn btn-info" id="clearQuest"><i class="fa fa-refresh"></i> Clear </button>-->
									</center>
									<!-- / question navigation button -->
								  
								</div>
								
							</div> 
							
						</div>

								  
                      </section>
                  
                  </div>
            </div>
			<!-- / row -->
			
			



		<script type="text/javascript">
 
			  
			$(document).ready(function(){
					
					var assignSeconds = <?php echo $assignSeconds; ?>;					
					var scorePercenta = 30;
					$('.styleProgress').css('width', scorePercenta+'%');
				 
					jQuery.fn.assignProgress = function (aOptions) {
						/* define values */
						var iCms = 1000;
						var iMms = 60 * iCms;
						var iHms = 3600 * iCms;
						var iDms = 24 * 3600 * iCms;
						/* define options */
						var aDefOpts = {
							start: new Date(), // now
							finish: new Date().setTime(new Date().getTime() + assignSeconds * iCms), // now + 60 sec
							interval: 100
						}
						var aOpts = jQuery.extend(aDefOpts, aOptions);
						var vPb = this;
						/* each progress bar */ 
							return this.each(
								function() {
								var iDuration = aOpts.finish - aOpts.start;
								/* calling original progressbar */
								$(vPb).children('.pbar').progressbar();
								/* loop array */
									var vInterval = setInterval(
										function(){
											var iLeftMs = aOpts.finish - new Date(); // left time in MS
											var iElapsedMs = new Date() - aOpts.start, // elapsed time in MS
											iDays = parseInt(iLeftMs / iDms), // elapsed days
											iHours = parseInt((iLeftMs - (iDays * iDms)) / iHms), // elapsed hours
											iMin = parseInt((iLeftMs - (iDays * iDms) - (iHours * iHms)) / iMms), // elapsed minutes
											iSec = parseInt((iLeftMs - (iDays * iDms) - (iMin * iMms) - (iHours * iHms)) / iCms), // elapsed seconds
											iPerc = (iElapsedMs > 0) ? iElapsedMs / iDuration * 100 : 0; // percentages
											/* display current positions and progress */
											$(vPb).children('.percent').html('<b>'+iPerc.toFixed(1)+'%</b>');
											//$(vPb).children('.elapsed').html(iDays+' Days '+iHours+'H : '+iMin+'M : '+iSec+'S</b>');
											$(vPb).children('.elapsed').html(iHours+'H : '+iMin+'M : '+iSec+'S</b>'); //Removing Day
											$(vPb).children('.pbar').children('.ui-progressbar-value').css('width', iPerc+'%');
											/* in case of finish */
											if (iPerc >= 100) {
												clearInterval(vInterval);
												$(vPb).children('.percent').html('<b>100%</b>');
												$(vPb).children('.elapsed').html('Time Elapsed!');
												assignFinished();													
											}
										} ,aOpts.interval
									);
								}
							);
					}
					
					/* default mode */
					$('#assignProgressDiv').assignProgress();
				
					$(".assignQuestDiv div").each(function(e) {
						if (e != 0)
							$(this).hide();
					});
					
					$("#next").click(function(){ /* navigate to next question */
						
						var vQuest = $('.assignQuestDiv div:visible'),
						vQuestID = vQuest.attr('id'); 
						
						var sQuestID = vQuestID.split('-');
						var qID = sQuestID[1];
						var qName = 'qOpt-'+qID;
						
						var ansQuest = $('input:radio[name='+qName+']:checked').val();					
						
						if (ansQuest === undefined || ansQuest === null) {							
							
							$('#eQNo-'+qID).removeClass("btn-white");	
							$('#eQNo-'+qID).addClass('btn-default');
							
						}else{
							
							//if(ansQuest == 1){ , btn-info, btn-default
							$('#eQNo-'+qID).removeClass("btn-white");
							$('#eQNo-'+qID).addClass('btn-info');

						}	 
						
						if ($(".assignQuestDiv div:visible").next().length != 0)
							$(".assignQuestDiv div:visible").next().show().prev().hide();
						else {
							$(".assignQuestDiv div:visible").hide();
							$(".assignQuestDiv div:first").show();
						}
						return false;
						
					});

					$("#prev").click(function(){ /* navigate to previous question */					
						
						var vQuest = $('.assignQuestDiv div:visible'),
						vQuestID = vQuest.attr('id');
						
						var sQuestID = vQuestID.split('-');
						var qID = sQuestID[1];
						var qName = 'qOpt-'+qID;
						
						var ansQuest = $('input:radio[name='+qName+']:checked').val();					
						
						if (ansQuest === undefined || ansQuest === null) {							
							
							$('#eQNo-'+qID).removeClass("btn-white");	
							$('#eQNo-'+qID).addClass('btn-default');
							
						}else{
							
							$('#eQNo-'+qID).removeClass("btn-white");
							$('#eQNo-'+qID).addClass('btn-info');

						}	
						
						if ($(".assignQuestDiv div:visible").prev().length != 0)
							$(".assignQuestDiv div:visible").prev().show().next().hide();
						else {
							$(".assignQuestDiv div:visible").hide();
							$(".assignQuestDiv div:last").show();
						}
						return false;
					});
					
					$("#reviewQuest").click(function(){ /* revisit a question */
						
						var vQuest = $('.assignQuestDiv div:visible'),
						vQuestID = vQuest.attr('id'); 
						
						var sQuestID = vQuestID.split('-');
						var qID = sQuestID[1];
						var qName = 'qOpt-'+qID;
						
						var ansQuest = $('input:radio[name='+qName+']:checked').val();					
						
						if (ansQuest === undefined || ansQuest === null) {							
							
							$('#eQNo-'+qID).removeClass("btn-white");	
							$('#eQNo-'+qID).addClass('btn-success');
							
						}else{
							
							//if(ansQuest == 1){ , btn-info, btn-default
							$('#eQNo-'+qID).removeClass("btn-white");
							$('#eQNo-'+qID).addClass('btn-success');

						}	 
						
						if ($(".assignQuestDiv div:visible").next().length != 0)
							$(".assignQuestDiv div:visible").next().show().prev().hide();
						else {
							$(".assignQuestDiv div:visible").hide();
							$(".assignQuestDiv div:first").show();
						}
						return false;
						
					});
					
					$(".assignQuestNum").click(function(){ /* navigate to a question using exam number */
						
						var eQBtn = this.id;
						var eQBtnID = eQBtn.split('-');
						var eQID = eQBtnID[1];

						$(".assignQuestDiv div:visible").hide();
						$("#question-"+eQID).show();
						$('html, body').animate({ scrollTop:  $('#assignQuestionDiv').offset().top - 150 }, 'slow');	
						
						return false;
					});
					
					$("#reviewAssign").click(function(){ /* review exam question */

						$("#assignQuestionDiv, #ansDescTB").slideDown(1800);
						$("#reviewQuest, .reviewAssign").hide();
						
						return false;
						
					});
					
					 
					function assignFinished(){  /* execute this function when exam elapsed */
						
						$(".assignQuestionDiv, #questDescTB").slideUp(1800);						

						var groups = [];
						
						/* distinct groups */
						
						$('.assignQuestDiv input:radio').each(function (index, value) {
							var name = $(this).attr('name');
							if ($.inArray(name, groups) == -1 ) {

								groups.push(name);
							}
							//groups.sort().reverse();
						}); 
						
						var assignScore = 0;
						var eQuesMark = 1;
						var studentScore = 0;
						var correctAnswer = 0;
						
						/* loop groups */
						
						$.each(groups, function (index, value) { 
							
							if ($('.assignQuestDiv input[name="' + value + '"]').is(':checked')) {
								
								var eQuestAns = parseInt($('.assignQuestDiv input[name="' + value + '"]:checked').val());
								var vQuestData = $('.assignQuestDiv input[name="' + value + '"]:checked');
								
							}else{
								
								var eQuestAns = null;
								var vQuestData = $('.assignQuestDiv input[name="' + value + '"]');
								
							}	 
								
							var eQuestAnsID = $(this).attr('id'); 
							
							var vQuID = vQuestData.attr('id');
							var eQuestSplit = vQuID.split('-');
							var optNo = eQuestSplit[1];
							var eQMark = eQuestSplit[2];
							var qNo = eQuestSplit[3];
							var eQAns = eQuestSplit[4]; 
									
							assignScore += (eQuesMark * eQMark);
							
							$('input:radio[name="' + value + '"]').each(function(i) {  /* loop question array */
																 
								 var optionsID = $(this).attr('id');
								 var optionSplit = optionsID.split('-');
								 var eQOptNo = optionSplit[1];
								 var eQOptMark = optionSplit[2];
								 var eQOptqNo = optionSplit[3];
								 var eQOptAns = optionSplit[4];								 
								 

										if ((eQuestAns === null) && (eQOptAns == 1)){
											
											$('#p-'+eQOptNo+'-'+eQOptMark+'-'+eQOptqNo+'-1').addClass('notAns');	
											
										}else if((eQuestAns == 1) && (eQOptAns == 1)){
										  
											$('#p-'+eQOptNo+'-'+eQOptMark+'-'+eQOptqNo+'-'+eQOptAns).addClass('correctAns');
										  
										}else if((eQuestAns == 0) && (eQOptAns == 1)){
											  
											$('#p-'+eQOptNo+'-'+eQOptMark+'-'+eQOptqNo+'-'+eQOptAns).addClass('correctAns');
											  
										}else if((eQuestAns == 0) && (eQOptAns == 0)){
										  
											$('#p-'+optNo+'-'+eQMark+'-'+qNo+'-'+eQAns).addClass('wrongAns');
										  
										}else{
										
											//options value
										} 
								
							}); 
							
							if(($.isNumeric(eQuestAns)) && ($.isNumeric(eQMark))){  /* check if value is numeric */

										if(eQuestAns == 1){
											
											studentScore += (eQuestAns * eQMark);
											correctAnswer++
										}	
											
							} 
							
						}); 
						
						if(($.isNumeric(studentScore)) && ($.isNumeric(assignScore))){  /* check if value is numeric */
							
							var scorePercent = (studentScore * 100 / assignScore).toFixed(2);
						
						}else{
							
							var scorePercent = 0;
							
						}	 
						
						$("#correctAnswer").html(correctAnswer);
						$("#studentScore").html(studentScore);
						$("#assignScore").html(assignScore);
						$(".scorePercent").html(scorePercent);
						$('.styleProgress').css('width', scorePercent+'%');
						$(".reviewAssign").show();
						$("#assignSummary").slideDown(1500); 
						
					} 
					
					/*
					$("#clearQuest").click(function(){					
						
						var vQuest = $('.assignQuestDiv div:visible'),
						vQuestID = vQuest.attr('id');
						
						var sQuestID = vQuestID.split('-');
						var qID = sQuestID[1];
						var qName = 'qOpt-'+qID;
						//$('input:radio[name="correctAnswer"]').prop('checked', false);
						$('input:radio[name='+qName+']').prop('checked', false);
						
						return false;
					});
					*/ 
				
			}); 

			hidePageLoader();  /* hide page loader */

		</script>

<?php 
			
			} 
			
			
		}else{  /* display error */ 
			
			$msg_e = "* Ooooooooops, an error has occur to retrieve assignment information. Please try again";
			echo $errorMsg.$msg_e.$eEnd; 
			echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
						
		}	
		
exit;
?>	