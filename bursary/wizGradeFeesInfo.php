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
	This script handle school fees information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configwizGrade.php';  /* load wizGrade configuration files */
		 
		 
		if ($_REQUEST['feesData'] == 'dateRange') {  /* select fees date range */
				
				$startDate = preg_replace("/[^0-9-]/", "", $_REQUEST['feesFrom']);
				$endDate = preg_replace("/[^0-9-]/", "", $_REQUEST['feesTo']);	
				$startDate = trim($startDate); $endDate = trim($endDate);	
				
				/* script validation */ 
				
				if ($startDate == "")  {
         			
					$msg_e = "* Oooooooops Error, please select fees date from";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  hidePageLoader() </script>";exit;
					
	   			}elseif ($endDate == "")  {
         			
					$msg_e = "* Oooooooops Error please select fees date to";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  hidePageLoader() </script>";exit;
					
	   			}else{  /* select fees range */
					
					try {
												
						$feesDataArr = feesDataRange($conn, $startDate, $endDate);  /* school fee range array */
						
						if (is_array($feesDataArr)){   /* check if array */
							 $feesDataCount = count($feesDataArr);
						}else{ $feesDataCount = $i_false; }
					
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}	
				
				}
				echo "<script type='text/javascript'>  hidePageLoader(); /* hide page loader */ </script>";
					
					
		}else{  /* select default fees date range */ 
		 
					try {
				 
						$feesDataArr = feesData($conn);  /* school fee array */
						$feesDataCount = count($feesDataArr);
						
					}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
					}	

		}	

						
?>

				<script type='text/javascript'> $('#paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ </script>
				<!-- table -->
				<table  class='table table-hover style-table' id='wizGradeTBPage'>
						<thead><tr>
                        <th>S/N</th> 
                        <th class='text-left'>Category</th> 
						<th class='text-left'>School</th> 
						<th class='text-left'>Student Name</th> 
						<th class='text-left'>Reg No.</th> 
						<!-- <th class='text-left'>Level</th> 
						<th class='text-left'>Term</th> -->
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
									
									$feeCategoryInfoArr = feeCategoryInfo($conn, $feeCat);  /* school fee category information */
									$feeCategory = $feeCategoryInfoArr[$fiVal]['fee'];
									
									$fID = trim($fID);
									$sTerm = $termIntList[$term];
									$school = $school_list[$schoolID];
									$payMethod = $paymentMethodArr[$method];
									$payStatus = $paymentStatus[$fStatus];
									
									$date = date("jMY", strtotime($date));
									
									$amount = wizGradeCurrency($amount, $curSymbol);  /* school currency information*/
									$balance = wizGradeCurrency($balance, $curSymbol);  /* school currency information*/
									
									require $wizGradeSchoolTBS; /* include student database table information  */								
						
									$regNum = studentReg($conn, $regID);  /* student registration number  */									
									$studentName = studentName($conn, $regNum);  /* student name  */					
									$studentPic = studentPicture($conn, $regNum);  /* student picture */
									
									$levelArray = studentLevelsArray($conn);  /* student level array */ 
									$studentLevel = $levelArray[$level]['level'];
						
									$serailNo++;								

$feesData =<<<IGWEZE
        
									<tr id="row-$fID" ><td class='text-left' width="5%">$serailNo</td> 
									<td class='text-left' width="15%"> $feeCategory </td> 
									<td class='text-left' width="10%"> $school </td> 
									<td style="text-align:left !important; padding-right: 7px !important;" width="30%">
									<img src = "$studentPic" style="width: 30px; height: 30px; float:left; border-radius: 
									20px; padding-right: 5px"> $studentName </td> 
									
									<td style="text-align:left !important; padding-right: 7px !important;" width="10%"> $regNum </td> 									
									<!--<td class='text-left' width="5%"> $studentLevel $class </td> 
									 
									<td class='text-left' width="5%"> $sTerm </td> -->
									<td class='text-left' width="10%"> $amount</td> 
									<td class='text-left' width="10%"> $balance</td> 
									<td class='text-left' width="10%"> $date </td> 
									<td class='text-left' width="5%"> $payStatus</td> 
									
									<td  class='text-left' width="5%"> 
									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right"> 											
												<li>
													<a href='javascript:;' id='$fID' class ='viewFees'>
													<button class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i></button> View</a>
												</li>
												<li class="divider"></li>												
												<li>					
												<a href='javascript:;' id='$fID' class ='editFees'>
												<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
												</li>
												<li class="divider"></li>
												<li>
												<a href='javascript:;' id='wizGrade-$fID-$feeCategory-$regNum-$studentName' class ='removeFees'> 
												<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button> Remove</a>			
												</li>
											</ul>   
													
									</div><!-- /btn-group -->
									
									
									</td>
									</tr>
		
IGWEZE;
                               
									echo $feesData; 								

		                        }
								
								
						}

						echo "<script type='text/javascript'>  hidePageLoader() </script>";

				
          ?>           
                        
					</tbody>
				</table>
				<!-- table -->
						