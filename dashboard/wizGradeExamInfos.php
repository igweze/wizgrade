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
	This script handle student exam information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configwizGrade.php';  /* load wizGrade configuration files */		 
		 try {
		
				if ($admin_grade == $staffGrade) {    /* check admin grade */ 
				
					$onlineExamDataArr = onlineStaffExamData($conn, $_SESSION['adminID']); /* online staff exam array */
					
				}else{
					
					$onlineExamDataArr = onlineExamData($conn); /* online admin exam array */
					
				}	
				
				
				$onlineExamDataCount = count($onlineExamDataArr);
				
				$levelArray = studentLevelsArray($conn); /* student level array */		
				
				array_unshift($levelArray,"");
	   			unset($levelArray[0]);
				
		 }catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		 }		

		 
?>
				<script type='text/javascript'> $('#paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ </script>
				<!-- table -->
				<table  class='table table-hover style-table' id='wizGradeTBPage'>
						<thead><tr>
                        <th>S/N</th> 
                         
						<th class='text-left'>Class</th> 
						<th class='text-left'>Term</th> 
						<th class='text-left'>Exam Title</th> 
						<th class='text-left'>Exam Subject</th> 
						<th class='text-left'>Duration</th>
						<th class='text-left'>Quest. Num</th>	
						<th class='text-left'>Tasks</th>
                        </tr></thead> <tbody>


        <?php
						
							if($onlineExamDataCount >= $fiVal){  /* check array is empty */	 		
														
								
								for($i = $fiVal; $i <= $onlineExamDataCount; $i++){  /* loop array */		
								
									$eID = $onlineExamDataArr[$i]["eID"];
									$sessionID = $onlineExamDataArr[$i]["session"];
									$level = $onlineExamDataArr[$i]["level"];
									$eTerm = $onlineExamDataArr[$i]["eTerm"];
									$class = $onlineExamDataArr[$i]["class"];
									$eTitle = $onlineExamDataArr[$i]["eTitle"];
									$eSubject = $onlineExamDataArr[$i]["eSubject"];
									$eDetail = htmlspecialchars_decode($onlineExamDataArr[$i]["eDetail"]);
									$eTime = $onlineExamDataArr[$i]["eTime"];
									
									$eTerm = $termIntList[$eTerm]; 
									
									$countQuest = examQuestions($conn, $eID);  /* online exam question information */
									$countQuestion = count($countQuest);
									
									//$eDetail = nl2br($eDetail);
									
									$examLevel = $levelArray[$level]['level'];
						
									$serailNo++;
								

$onlineExamData =<<<IGWEZE
        
									<tr id="row-$eID" >
									<td class='text-left' width="3%">$serailNo</td> 
									<td class='text-left' width="10%"> $examLevel $class </td> 
									
									<td class='text-left' width="8%"> $eTerm</td> 				
									<td class='text-left' width="30%"> $eTitle</td> 			
									<td class='text-left' width="20%"> $eSubject </td> 		 
									<td class='text-left' width="12%"> $eTime Mins</td> 
									<td class='text-left' width="12%"> $countQuestion </td> 
									
									<td  class='text-left' width="5%"> 
									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right">
												
											<li>					
											<a href='javascript:;' id='wizGrade-$eID' class ='addExamQuest'>
											<button class="btn btn-primary btn-xs"><i class="fa fa-save"></i></button> Manage Question/s</a>
											</li>
											<li class="divider"></li> 											
											<li>
												<a href='javascript:;' id='$eID' class ='viewExam'>
												<button class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i></button> View Exam</a>
											</li>
											<li class="divider"></li>						
											<li>					
											<a href='javascript:;' id='$eID' class ='editExam'>
											<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button> Edit Exam</a>
											</li>
											<li class="divider"></li>
											<li>
											<a href='javascript:;' id='wizGrade-$eID-$eTitle' class ='removeExam'> 
											<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button> Remove Exam</a>			
											</li>
													
											</ul> 
									</div><!-- /btn-group -->
									
									
									</td>
									</tr>
		
IGWEZE;
                               
		                  		echo $onlineExamData; 

		                        }
								 
								
							}
 
?>
                        
                        
                </tbody>
				</table>
				<!-- / table -->
						