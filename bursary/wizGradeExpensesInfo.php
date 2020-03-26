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
	This script handle school expenses information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */		 
		 
		if ($_REQUEST['expensesData'] == 'dateRange') {

				
				$startDate = preg_replace("/[^0-9-]/", "", $_REQUEST['expensesFrom']);
				$endDate = preg_replace("/[^0-9-]/", "", $_REQUEST['expensesTo']);	
				$startDate = trim($startDate); $endDate = trim($endDate); 
				
				/* script validation */ 
				
				if ($startDate == "")  {
         			
					$msg_e = "* Oooooooops Error, please select expenses date from";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  hidePageLoader() </script>";exit;
					
	   			}elseif ($endDate == "")  {
         			
					$msg_e = "* Oooooooops Error please select expenses date to";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}else{
					
					try {
												
						$expensesDataArr = expensesDataRange($conn, $startDate, $endDate);  /* school expenses range array */
						
						if (is_array($expensesDataArr)){
							 $expensesDataCount = count($expensesDataArr);
						}else{ $expensesDataCount = $i_false; }
					
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}	

				
				}

				echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ </script>";	
					
					
		}else{								
					
		 
					try {
				 
						$expensesDataArr = expensesData($conn);  /* school expenses array */
						$expensesDataCount = count($expensesDataArr);
						
					}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
					}	

		}	

						
?>

  
  
				<script type='text/javascript'>  $('#paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */  </script>
				
				<!-- table -->
				<table  class='table table-hover style-table' id='wizGradeTBPage'>
						<thead><tr>
                        <th>S/N</th> 
                        <th class='text-left'>Category</th> 
						<th class='text-left'>Amount</th> 
						<th class='text-left'>Title</th> 
						<th class='text-left'>Method</th> 
						<th class='text-left'>Date</th> 
						<th class='text-left'>Tasks</th>
                        </tr></thead> <tbody>


        <?php
						
						if($expensesDataCount >= $fiVal){  /* check array is empty */		
														
								
								for($i = $fiVal; $i <= $expensesDataCount; $i++){  /* loop array */
									
									$eID = $expensesDataArr[$i]["eID"];
									$expenseCat = $expensesDataArr[$i]["expenseCat"];
									$amount = $expensesDataArr[$i]["eAmount"];
									$expTitle = $expensesDataArr[$i]["expTitle"];
									$expDetails = $expensesDataArr[$i]["expDetails"];
									$method = $expensesDataArr[$i]["method"];
									$date = $expensesDataArr[$i]["date"];
									
									$expenseCategoryInfoArr = expenseCategoryInfo($conn, $expenseCat);  /* school expenses category information */
									$expenseCategory = $expenseCategoryInfoArr[$fiVal]['expense'];
									
									$eID = trim($eID);									
									$payMethod = $paymentMethodArr[$method];															
									$date = date("j M Y", strtotime($date));									
									$amount = wizGradeCurrency($amount, $curSymbol);  /* school currency information*/								
						
									$serailNo++;								

$expensesData =<<<IGWEZE
        
									<tr id="row-$eID" >
										<td class='text-left' width="5%">$serailNo</td> 
										<td class='text-left' width="15%"> $expenseCategory </td> 
										<td class='text-left' width="15%"> $amount</td> 		
										
										<td class='text-left' width="30%"> $expTitle  </td> 
										 
										<td class='text-left' width="15%"> $payMethod </td> 
										
										<td class='text-left' width="15%"> $date </td> 
										
										<td  class='text-left' width="5%"> 
										
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
											<i class="fa fa-wrench"></i> <span class="caret"></span></button>
												<ul role="menu" class="dropdown-menu pull-right"> 												
														<li>
															<a href='javascript:;' id='$eID' class ='viewExpenses'>
															<button class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i></button> View</a>
														</li>
														<li class="divider"></li>						
														<li>					
														<a href='javascript:;' id='$eID' class ='editExpenses'>
														<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
														</li>
														<li class="divider"></li>
														<li>
														<a href='javascript:;' id='wizGrade-$eID-$expenseCategory' class ='removeExpenses'> 
														<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button> Remove</a>			
														</li>														
												</ul>	
										</div><!-- /btn-group -->
										</td>
									</tr>
		
IGWEZE;
                               
		                  		echo $expensesData;

		                        } 
								
						} 
				
          ?>
                        
                        
                </tbody>
			</table>
			
			<!-- / table -->
						