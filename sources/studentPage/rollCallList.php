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
	This page is the student fee history
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>

			 
			<!-- row -->	
			<div class="row" style="margin:30px 10px 0px 0px">
					<div class="col-lg-12">
                      <section class="panel">
                        <header class="panel-heading">
                             <i class="fa fa-check-square-o fa-lg"></i> <span class="hide-res">Daily</span> Roll Call  <span class="hide-res">& Comment</span>
							 <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                        </header>
                        <div class="panel-body wizGrade-line">
								<div class="col-lg-12">
								  <section class="panel">
									  
										<div class="panel-body wizGrade-linea"> 
											 
				<?php

					try {
						
						$regID = studentRegID($conn, $regNum);    /* student record ID  */
						
						$rollCallArr = wizGraderollCallArray($conn, $regID);  /* retrieve student daily attendance array */	
						$rollCallCount = count($rollCallArr);
						
					}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
					}	

						
				?>

				<!-- table -->
				<table  class='table table-hover style-table wizGradeTBPage' id='wizGradeTBPage'>
						<thead><tr>
                        <th>S/N</th> 
                        <th class='text-left'>Date</th>						
						<th class='text-left'>Daily Comment/s</th> 
                        </tr></thead> <tbody>


					<?php
						
						if($rollCallCount >= $fiVal){  /* check array is empty */		
														
								
								for($i = $fiVal; $i <= $rollCallCount; $i++){  /* loop array */	
									
									$rID = $rollCallArr[$i]["rID"];
									$startdate = $rollCallArr[$i]["startdate"];
									$comments = $rollCallArr[$i]["comments"];
							 
									
									$startdate = date("j M, Y", strtotime($startdate)); 
										 
						
									$serailNo++;								

$rollCall =<<<IGWEZE
        
									<tr id="row-$rID" ><td class='text-left' width="5%">$serailNo</td> 
									<td class='text-left' width="20%"> $startdate </td> 
									<td class='text-left' width="75%"> $comments </td> 
 
									</tr>
		
IGWEZE;
                               
									echo $rollCall; 								

		                        }
								
								
						}else{  /* display information message */ 
										
								$msg_i = "Ooooooops, you don't have any roll call history to show at the momment"; 
								echo $infMsg.$msg_i.$msgEnd;
										
						}


				
          ?>           
                        
					</tbody>
				</table>
				<!-- table -->
																
										
										</div>
								  </section>
								</div>  
				
						</div>
                      </section>
					</div> 	
			</div>
			<!-- / row -->