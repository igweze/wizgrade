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
	This page load student online assignments
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */
 		
			
		try {
					
				$onlineAssignDataArr = onlineAssignData($conn);  /* online student assignment array */							
				$onlineAssignDataCount = count($onlineAssignDataArr);
				
				$levelArray = studentLevelsArray($conn); /* student level array */	
				
				array_unshift($levelArray,"");
	   			unset($levelArray[0]);
				
		}catch(PDOException $e) {
  			
				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		}		

?> 		
					<!-- row -->	
                 	<div class="row">
     				  <div class="col-lg-12">
						<section class="panel wizgrade-section-div">                      	
							<header class="panel-heading">
                            <i class="fa fa-cubes fa-lg"></i>  CBT Assignment <span class="hide-res">Manager</span>
							<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line" id="assignQuestDiv"> 

							<button class="paginate-page display-none"  type="submit">Paginate Page</button> 
							<!-- table -->		
							<table  class='table table-hover style-table wizGradeTBPage'>
								
								<thead><tr>
								<th>S/N</th> 
								<th class='text-left'>Subject</th>						
								<th class='text-left'>Level</th> 
								<th class='text-left'>Term</th> 
								<th class='text-left'>Question/s No.</th> 
								<th class='text-left'>Time</th> 
								<th class='text-left'>Tasks</th> 
								</tr></thead> <tbody>							


<?php
						
						if($onlineAssignDataCount >= $fiVal){  /* check array is empty */		
														
							try {	
							
							
								for($i = $fiVal; $i <= $onlineAssignDataCount; $i++){  /* loop array */	
								
									$eID = $onlineAssignDataArr[$i]["eID"];
									$sessionID = $onlineAssignDataArr[$i]["session"];
									$level = $onlineAssignDataArr[$i]["level"];
									$eTerm = $onlineAssignDataArr[$i]["eTerm"];
									$class = $onlineAssignDataArr[$i]["class"];
									$eTitle = $onlineAssignDataArr[$i]["eTitle"];
									$eSubject = $onlineAssignDataArr[$i]["eSubject"];
									$eDetail = htmlspecialchars_decode($onlineAssignDataArr[$i]["eDetail"]);
									$eTime = $onlineAssignDataArr[$i]["eTime"];
									
									$eTerm = $termIntList[$eTerm];
									$session = wizGradeSession($conn, $sessionID);  /* school session */
									$sessionS = ($session + $fiVal);
									
									$countQuest = assignQuestions($conn, $eID);  /* online assignment question array */
									$countQuestion = count($countQuest);
									
									$eDetail = nl2br($eDetail);
						
									$serailNo++;
									
									$assignLevel = $levelArray[$level]['level'];
									
									if(strlen($eSubject) > 20){
									
										$eSubject = substr($eSubject, 0, 20); 									
										$eSubject = $eSubject.'.';
									
									}

$questionDiv =<<<IGWEZE
        
									<tr id="row-$eID">
									<td class='text-left' width="5%">$serailNo</td> 
									<td class='text-left' width="30%"> $eSubject </td> 
									<td class='text-left' width="15%">  $assignLevel $class</td> 
									<td class='text-left' width="10%"> $eTerm Term</td> 
									<td class='text-left' width="15%"> $countQuestion Q/s</td> 
									<td class='text-left' width="15%">  $eTime Mins</td> 
									<td class='text-left' width="10%">  <a href="javascript:;" class="startAssign" id="wizGrade-$eID" 
																		style="color:#228B22 !important;font-weight:600;">
																			  <i class="fa fa-check-square-o" style="color:#228B22 !important;"></i>
																			  Start 
																		</a>
									</td> 
 
									</tr>
		
IGWEZE;
                               
									echo $questionDiv;									

$onlineAssignData =<<<IGWEZE
        
									<div class="col-lg-4">
										  <!-- exam start-->
										  <section class="panel">
											  <div class="exam-head">
												  <span>
													  <i class="fa fa-book"></i>
												  </span>
												  <h3>$eSubject</h3>
												  <span class="rev-combo pull-right">
													 $eTime Mins
												  </span>
											  </div>
											  
											  <div class="panel-footer exam-foot"> 
											   
												  <ul>
													  <li class="first active">
														  <a href="javascript:;">
															  <i class="fa fa-calendar"></i>
															  $eTerm Term
														  </a>
													  </li>
													  <li class="active">
														  <a href="javascript:;">
															  <i class=" fa fa-book"></i>
															 $assignLevel $class
														  </a>
													  </li>
													  <li class="last active">
														  <a href="javascript:;" class="startAssign" id="osinachi-$eID">
															  <i class="fa fa-cubes"></i>
															  Start 
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
															   
															  $countQuestion Question/s
														  </a>
													  </li>
													  <li class="last active">
														  <a href="javascript:;" class="startAssign" id="wizGrade-$eID">
															  <i class="fa fa-cubes"></i>
															  Start 
														  </a>
													  </li> 
												  </ul>
											  </div>
										  </section>
										  <!-- exam end -->
										  
										  </div>
		
IGWEZE;
                               
									//echo $onlineAssignData;														

		                        }								
								
							}catch(PDOException $e) {
  			
									wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
								 
							}		
								
								
						} 
				
?>
						</tbody>
						</table>
						<!-- table -->		   
									</div>                         
								</section>
							</div>
						</div>
						<!-- / row -->  