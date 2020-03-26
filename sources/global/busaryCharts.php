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
	This script laod bursary chart/s
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

 		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
		 
		/* validate chart year */
		
		if ($_REQUEST['chartData'] == 'bursarySumm') {

				$chartYear = preg_replace("/[^0-9-]/", "", $_REQUEST['chartYear']);
				$chartYear = trim($chartYear);					
				
				if ($chartYear == "")  {
         			
					$chartYear = date('Y');
					
	   			}	
					
				echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";	
				
		}else{	
		 
				$chartYear = date('Y');

		}	

						
?>
							<!-- row -->

							<div class="col-lg-4 col-sm-6">
								  <section class="panel value-box-cell">
									  <div class="symbol terques">
										  <i class="fa fa-shopping-cart"></i>
									  </div>
									  <div class="value" >
									  
										<p><?php echo $chartYear; ?> <br /> <span class="hide-res">Order</span> Sales</p>
										
										<h1 class="count"> 
											 
											 <?php 
											  
												/* client order chart information*/
												$salesAmount = clientOrdersChartData($conn, $chartYear.'-01-01', $chartYear.'-12-31'); 
												echo wizGradeCurrency($salesAmount, $curSymbol);
												
											?>
											
										  </h1>
										  
										  
										  
										  </div>
								  </section>
								   
							  </div>
							  
							  
							   <div class="col-lg-4 col-sm-6">
								  <section class="panel value-box-cell">
									  <div class="symbol red">
										  <i class="fa fa-bar-chart-o"></i>
									  </div>
									  <div class="value">
									  
										<p><?php echo $chartYear; ?> <br /> Income</p>
										  <h1 class="count">
											  <?php 
											  
												/* fees chart information*/
												$feeAmount = feesIncomeChartData($conn, $chartYear.'-01-01', $chartYear.'-12-31'); 
												echo wizGradeCurrency($feeAmount, $curSymbol);
												
											  ?>
										  </h1>
										  
									  </div>
								  </section>
								   
							  </div>
							  
							   <div class="col-lg-4 col-sm-6">
								  <section class="panel value-box-cell">
									  <div class="symbol yellow">
										  <i class="fa fa-bar-chart-o"></i>
									  </div>
									  <div class="value">
									  
										  <p><?php echo $chartYear; ?> <br /> Expenses</p>
										  
										  <h1 class="count">
										  
											<?php 
											  
												/* expenses chart information*/
												$expensesAmount = expensesChartData($conn, $chartYear.'-01-01', $chartYear.'-12-31'); 
												echo wizGradeCurrency($expensesAmount, $curSymbol);
												
											?>
											  
											  
										  </h1>
										  
									  </div>
								  </section>
								   
							  </div>
							  
							 
							 <br clear="all"/ >
						<br clear="all"/ >
						
						<!-- / row -->
						
						<!-- chart -->
						
						<script src="<?php echo $wizGradeTemplate; ?>js/chartinator.js"></script>
                        <!--<script>
                        window.jQuery || document.write('<script src="<?php echo $wizGradeTemplate; ?>js/jquery-charts.js"><\/script>')
                        </script>
						-->
                    
                        <script src="<?php echo $wizGradeTemplate; ?>js/chart-wizgrade-config.js"></script>
						<table id="columnChart" class="columnChart data-table col-table" style="display:none !important;">
					
							<caption>Column Chart</caption>
							<tr>
								<th scope="col" data-type="string">Months</th>
								<th scope="col" data-type="number"><?php echo $chartYear; ?> School Fees Income In (<?php echo $curSymbol; ?>)</th>
								<th scope="col" data-type="number"><?php echo $chartYear; ?> Sales Order Income In (<?php echo $curSymbol; ?>)</th>
								<th scope="col" data-type="number"><?php echo $chartYear; ?> School Expenses In (<?php echo $curSymbol; ?>)</th>
							</tr>
							<tr>
								<td>JAN</td>
								<td align="right"><?php echo  feesIncomeChartData($conn, $chartYear.'-01-01', $chartYear.'-01-31');  ?></td>
								<td align="right"><?php echo  clientOrdersChartData($conn, $chartYear.'-01-01', $chartYear.'-01-31');  ?></td>
								<td align="right"><?php echo  expensesChartData($conn, $chartYear.'-01-01', $chartYear.'-01-31');  ?></td>
							</tr>

							<tr>
								<td>FEB</td>
								<td align="right"><?php echo  feesIncomeChartData($conn, $chartYear.'-02-01', $chartYear.'-02-31');  ?></td>
								<td align="right"><?php echo  clientOrdersChartData($conn, $chartYear.'-02-01', $chartYear.'-02-31');  ?></td>
								<td align="right"><?php echo  expensesChartData($conn, $chartYear.'-02-01', $chartYear.'-02-31');  ?></td>
							</tr>
							
							<tr>
								<td>MAR</td>
								<td align="right"><?php echo  feesIncomeChartData($conn, $chartYear.'-03-01', $chartYear.'-03-31');  ?></td>
								<td align="right"><?php echo  clientOrdersChartData($conn, $chartYear.'-03-01', $chartYear.'-03-31');  ?></td>
								<td align="right"><?php echo  expensesChartData($conn, $chartYear.'-03-01', $chartYear.'-03-31');  ?></td>
							</tr>
							
							<tr>
								<td>APR</td>
								<td align="right"><?php echo  feesIncomeChartData($conn, $chartYear.'-04-01', $chartYear.'-04-31');  ?></td>
								<td align="right"><?php echo  clientOrdersChartData($conn, $chartYear.'-04-01', $chartYear.'-04-31');  ?></td>
								<td align="right"><?php echo  expensesChartData($conn, $chartYear.'-04-01', $chartYear.'-04-31');  ?></td>
							</tr>
							
							<tr>
								<td>MAY</td>
								<td align="right"><?php echo  feesIncomeChartData($conn, $chartYear.'-05-01', $chartYear.'-05-31');  ?></td>
								<td align="right"><?php echo  clientOrdersChartData($conn, $chartYear.'-05-01', $chartYear.'-05-31');  ?></td>
								<td align="right"><?php echo  expensesChartData($conn, $chartYear.'-05-01', $chartYear.'-05-31');  ?></td>
							</tr>
							
							<tr>
								<td>JUN</td>
								<td align="right"><?php echo  feesIncomeChartData($conn, $chartYear.'-06-01', $chartYear.'-06-31');  ?></td>
								<td align="right"><?php echo  clientOrdersChartData($conn, $chartYear.'-06-01', $chartYear.'-06-31');  ?></td>
								<td align="right"><?php echo  expensesChartData($conn, $chartYear.'-06-01', $chartYear.'-06-31');  ?></td>
							</tr>
							
							<tr>
								<td>JUL</td>
								<td align="right"><?php echo  feesIncomeChartData($conn, $chartYear.'-07-01', $chartYear.'-07-31');  ?></td>
								<td align="right"><?php echo  clientOrdersChartData($conn, $chartYear.'-07-01', $chartYear.'-07-31');  ?></td>
								<td align="right"><?php echo  expensesChartData($conn, $chartYear.'-07-01', $chartYear.'-07-31');  ?></td>
							</tr>
							
							<tr>
								<td>AUG</td>
								<td align="right"><?php echo  feesIncomeChartData($conn, $chartYear.'-08-01', $chartYear.'-08-31');  ?></td>
								<td align="right"><?php echo  clientOrdersChartData($conn, $chartYear.'-08-01', $chartYear.'-08-31');  ?></td>
								<td align="right"><?php echo  expensesChartData($conn, $chartYear.'-08-01', $chartYear.'-08-31');  ?></td>
							</tr>
							
							<tr>
								<td>SEP</td>
								<td align="right"><?php echo  feesIncomeChartData($conn, $chartYear.'-09-01', $chartYear.'-09-31');  ?></td>
								<td align="right"><?php echo  clientOrdersChartData($conn, $chartYear.'-09-01', $chartYear.'-09-31');  ?></td>
								<td align="right"><?php echo  expensesChartData($conn, $chartYear.'-09-01', $chartYear.'-09-31');  ?></td>
							</tr>
							
							<tr>
								<td>OCT</td>
								<td align="right"><?php echo  feesIncomeChartData($conn, $chartYear.'-10-01', $chartYear.'-10-31');  ?></td>
								<td align="right"><?php echo  clientOrdersChartData($conn, $chartYear.'-10-01', $chartYear.'-10-31');  ?></td>
								<td align="right"><?php echo  expensesChartData($conn, $chartYear.'-10-01', $chartYear.'-10-31');  ?></td>
							</tr>
							
							<tr>
								<td>NOV</td>
								<td align="right"><?php echo  feesIncomeChartData($conn, $chartYear.'-11-01', $chartYear.'-11-31');  ?></td>
								<td align="right"><?php echo  clientOrdersChartData($conn, $chartYear.'-11-01', $chartYear.'-11-31');  ?></td>
								<td align="right"><?php echo  expensesChartData($conn, $chartYear.'-11-01', $chartYear.'-11-31');  ?></td>
							</tr>
							
							<tr>
								<td>DEC</td>
								<td align="right"><?php echo  feesIncomeChartData($conn, $chartYear.'-12-01', $chartYear.'-12-31');  ?></td>
								<td align="right"><?php echo  clientOrdersChartData($conn, $chartYear.'-12-01', $chartYear.'-12-31');  ?></td>
								<td align="right"><?php echo  expensesChartData($conn, $chartYear.'-12-01', $chartYear.'-12-31');  ?></td>
							</tr>
							
				
				
						</table>
						
					<!-- /chart -->	