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
	This script handle product order information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configwizGrade.php';  /* load wizGrade configuration files */		 
		 
		if ($_REQUEST['salesOrderData'] == 'dateRange') {

				
				$startDate = preg_replace("/[^0-9-]/", "", $_REQUEST['salesOrderFrom']);
				$endDate = preg_replace("/[^0-9-]/", "", $_REQUEST['salesOrderTo']);	
				$startDate = trim($startDate); $endDate = trim($endDate);	
				
				/* script validation */ 
				
				if ($startDate == "")  {  /* select order date range */
         			
					$msg_e = "* Oooooooops Error, please select salesOrder date from";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  hidePageLoader() </script>";exit;
					
	   			}elseif ($endDate == "")  {
         			
					$msg_e = "* Oooooooops Error please select salesOrder date to";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  hidePageLoader() </script>";exit;
					
	   			}else{
					
					
					$salesOrderT = $seVal;
				
				}	
					
				echo "<script type='text/javascript'>  hidePageLoader() </script>";
				
		}else{  /* select default order date range */ 								
					
					$salesOrderT = $fiVal;
		 

		}	

						
?>

				<script type='text/javascript'> $('#paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ </script>
				<!-- table -->
				<table  class='table table-hover style-table' id='wizGradeTBPage'>
						<thead><tr>
                        <th class='text-left'>S/N</th> 
                        <th class='text-left'> Invoice</th> 
						<th class='text-left'>School</th> 
						<th class='text-left'>Student Name</th> 
						<th class='text-left'>Reg No.</th> 
						<th class='text-left'>Order Date</th>
						<th class='text-left'>Order Total</th>
						<th class='text-left'>Status</th>
						<th class='text-left'>Tasks</th>
                        </tr></thead> <tbody> 

<?php
 
				try{
						
					if($salesOrderT == $seVal){  /* select order date range */

						$ebele_mark = "SELECT order_id, reg_id, regNo, stype, orderDate, status
						
										FROM $wizGradeOrderTB
										
										WHERE (orderDate BETWEEN :start_date AND :end_date)";
							 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue('start_date',  $startDate, PDO::PARAM_STR);
						$igweze_prep->bindValue('end_date',  $endDate, PDO::PARAM_STR);	
						
					}else{	/* select default order date range */
					
						$ebele_mark = "SELECT order_id, reg_id, regNo, stype, orderDate, status
						
										FROM $wizGradeOrderTB";
							 
						$igweze_prep = $conn->prepare($ebele_mark);						 
						
					}	
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count >= $fiVal) {  /* check array is empty */
												
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
			   
									$orderID = $row['order_id'];
									$regID = $row['reg_id'];
									$regNum = $row['regNo'];
									$schoolID = $row['stype'];
									$orderDate = $row['orderDate'];
									$status = $row['status'];
									
									$orderDate = strtotime($orderDate);
									$orderTime = timerBoy($orderDate);  /* time a go functions  */
									$transTotal = transactionTotal($conn, $orderID);  /* school total transaction information*/
									$orderStatus = $transactionArr[$status];
									
									$school = $school_list[$schoolID];
									
									require $wizGradeSchoolTBS; /* include student database table information  */							
 
									$regNum = studentReg($conn, $regID);  /* student registration number  */									
									$studentName = studentName($conn, $regNum);  /* student name  */					
									$studentPic = studentPicture($conn, $regNum);  /* student picture */
									
									$serailNo++; 														
			        					
$msgBody =<<<IGWEZE
        
									<tr id="row-$orderID" ><td class='text-left' width="5%">$serailNo</td> 
									<td class='text-left' width="10%"> INVOICE-$orderID </td> 
									<td class='text-left' width="10%"> $school </td> 
									<td style="text-align:left !important; editLoader" width="25%">
									<img src = "$studentPic" style="width: 30px; height: 30px; float:left; border-radius: 
									20px; padding-right: 5px"> $studentName </td> 
									
									<td style="text-align:left !important; editLoader" width="10%"> $regNum </td> 									
									
									<td class='text-left' width="15%"> $orderTime</td> 
									<td class='text-left' width="10%"> $curSymbol$transTotal </td> 
									<td class='text-left' width="10%"> <span class="tranStatus-$orderID"> $orderStatus </span></td> 
									
									<td  class='text-left' width="5%"> 
									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right">
											
												<li>
													<a href='javascript:;' id='$orderID' class ='viewTransaction'>
													<button class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i></button> View</a>
												</li>
													
													
											</ul>        
													
									</div><!-- /btn-group -->
									
									
									</td>
									</tr> 
		
IGWEZE;
									echo $msgBody; 

							}
		

					}
					
				}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
				}
	

?>													
					</tbody>
				</table>
				<!-- table -->
						