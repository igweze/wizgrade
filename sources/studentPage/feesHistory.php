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
                             <i class="fa fa-line-chart fa-lg"></i> <span class="hide-res">Student</span> Fees History
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
				 
						$levelArray = studentLevelsArray($conn);  /* student level array */ 
						$feesDataArr = studentFeesInfo($conn, $regID, $regNum, $schoolID);  /* student school fee array */
						$feesDataCount = count($feesDataArr);
						
					}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
					}	

						
				?>

				<!-- table -->
				<table  class='table table-hover style-table wizGradeTBPage' id='wizGradeTBPage'>
						<thead><tr>
                        <th>S/N</th> 
                        <th class='text-left'>Category</th> 
						
						
						<th class='text-left'>Level</th> 
						<th class='text-left'>Term</th>
						<th class='text-left'>Amount </th>
						<th class='text-left'>Balance</th>
						<th class='text-left'>Date</th>
						<th class='text-left'>Status</th>
						<th class='text-left'>Tasks</th>
                        </tr></thead> <tbody>


					<?php
						
						if($feesDataCount >= $fiVal){  /* check array is empty */		
														
								
								for($i = $fiVal; $i <= $feesDataCount; $i++){  /* loop array */	
									
									$fID = $feesDataArr[$i]["fID"];
									$feeCat = $feesDataArr[$i]["feeCat"];
									$sessionID = $feesDataArr[$i]["session"];
									$regID = $feesDataArr[$i]["reg_id"];
									$regNum = $feesDataArr[$i]["regNo"];
									$schoolID = $feesDataArr[$i]["stype"];
									$level = $feesDataArr[$i]["level"];
									$class = $feesDataArr[$i]["class"];
									$term = $feesDataArr[$i]["term"];
									$method = $feesDataArr[$i]["method"];
									$fDetail = $feesDataArr[$i]["f_details"];
									$amount = $feesDataArr[$i]["amount"];
									$balance = $feesDataArr[$i]["balance"];
									$date = $feesDataArr[$i]["date"];
									$fStatus = $feesDataArr[$i]["f_status"];
									$studentLevel = $levelArray[$level]['level'];
									
									$feeCategoryInfoArr = feeCategoryInfo($conn, $feeCat);  /* school fee category information */
									$feeCategory = $feeCategoryInfoArr[$fiVal]['fee'];
									
									$fID = trim($fID);
									$sTerm = $termIntList[$term];
									
									$payMethod = $paymentMethodArr[$method];
									$payStatus = $paymentStatus[$fStatus];
									
									$date = date("j M Y", strtotime($date));
									
									$amount = wizGradeCurrency($amount, $curSymbol);  /* school currency information*/
									$balance = wizGradeCurrency($balance, $curSymbol);  /* school currency information*/
										 
						
									$serailNo++;								

$feesData =<<<IGWEZE
        
									<tr id="row-$fID" ><td class='text-left' width="5%">$serailNo</td> 
									<td class='text-left' width="20%"> $feeCategory </td> 
									<td class='text-left' width="10%"> $studentLevel $class </td> 
									 
									<td class='text-left' width="5%"> $sTerm </td>
									<td class='text-left' width="15%"> $amount</td> 
									<td class='text-left' width="15%"> $balance</td> 
									<td class='text-left' width="15%"> $date </td> 
									<td class='text-left' width="10%"> $payStatus</td> 
									
									<td  class='text-left' width="5%"> 
									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right"> 											
												<li>
													<a href='javascript:;' id='$fID' class ='viewFees'>
													<button class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i></button> View</a>
												</li>
											</ul>   
													
									</div><!-- /btn-group -->
									
									
									</td>
									</tr>
		
IGWEZE;
                               
									echo $feesData; 								

		                        }
								
								
						}else{  /* display information message */ 
										
								$msg_i = "Ooooooops, you don't have any school fees history to show at the momment"; 
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
			

 				<!-- fee edit pop up modal start -->
				<a href="#editModal-f" data-toggle="modal" id="modalEditBtn-f" class=""> </a>

				<div class="modal fade" id="editModal-f" tabindex="-1" role="dialog" aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" 
						data-dismiss="modal" aria-hidden="true">
						<span style='color:#fff !important;'>&times;</span></button>
						<h4 class="modal-title"> Fees Payment Manager
						</h4>
					</div>
					<div class="modal-body modal-body-scroll">


						<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="editLoader"  
						style="cursor:pointer; display:none; margin-bottom:5px;" /></center>

						<div id="editMsg"> </div> 

						<div class="slideUpFrmUDiv">

						<section class="panel">

						<div class="panel-body"> 

							<div id="editFeesDiv"></div> 

						</div>

						</section>

						</div>

					</div>
					<div class="modal-footer slideUpFrmDiv">

						<button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
					
					</div>
					</div>
				</div>
				</div>
				<!-- fee edit pop up modal end --> 