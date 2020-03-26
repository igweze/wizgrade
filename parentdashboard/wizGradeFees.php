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
		         
			if ($_REQUEST['feesData'] == 'viewFees') {  /* view fees */
				
				$fID = strip_tags($_REQUEST['rData']);
				
				/* script validation */ 
				
				if ($fID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve payment information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* select information */  

		 			try { 
						
						$feesInfoArr = feesInfo($conn, $fID);  /* school fee array information */
						$feeID = $feesInfoArr[$fiVal]["fID"];
						$feeCat = $feesInfoArr[$fiVal]["feeCat"];
						$sessionID = $feesInfoArr[$fiVal]["session"];
						$regID = $feesInfoArr[$fiVal]["reg_id"];
						$regNum = $feesInfoArr[$fiVal]["regNo"];
						$schoolID = $feesInfoArr[$fiVal]["stype"];
						$level = $feesInfoArr[$fiVal]["level"];
						$class = $feesInfoArr[$fiVal]["class"];
						$term = $feesInfoArr[$fiVal]["term"];
						$method = $feesInfoArr[$fiVal]["method"];
						$fDetail = htmlspecialchars_decode($feesInfoArr[$fiVal]["f_details"]);
						$amount = $feesInfoArr[$fiVal]["amount"];
						$balance = $feesInfoArr[$fiVal]["balance"];
						$date = $feesInfoArr[$fiVal]["date"];
						$fStatus = $feesInfoArr[$fiVal]["f_status"]; 
								
						$feeCategoryInfoArr = feeCategoryInfo($conn, $feeCat);  /* school fee category information */
						$feeCategory = $feeCategoryInfoArr[$fiVal]['fee']; 
						
						$sTerm = $termIntList[$term];
						$school = $school_list[$schoolID];
						$payMethod = $paymentMethodArr[$method];
						$payStatus = $paymentStatus[$fStatus];						
						$date = date("j F Y", strtotime($date));
						$fDetail = nl2br($fDetail);
						
						$amount = wizGradeCurrency($amount, $curSymbol);  /* school currency information*/
						$balance = wizGradeCurrency($balance, $curSymbol);  /* school currency information*/
						
						
			
						$regNum = studentReg($conn, $regID);  /* student registration number  */						
						$studentName = studentName($conn, $regNum);  /* student name  */		
						$studentPic = studentPicture($conn, $regNum);  /* student picture */
						
						$levelArray = studentLevelsArray($conn);  /* student level array */ 
						$studentLevel = $levelArray[$level]['level'];
									

$showPayment =<<<IGWEZE
		
						<button  class="btn btn-white printer-icon pull-right">
						<i class="fa fa-print text-info"></i> Print </button><br clear="all"/><br clear="all"/>

						<div id = 'wizGradePrintArea'> 
						
						<!-- table -->
						<table width = '100%' class="table table-striped  table-advance table-hover"> 

							<tr><td style="padding-left: 10px;" colspan = '2'><center><img src = "$studentPic" height = '100'
							width = '100' id='wizGradeStudentPic'> </center>
							</td></tr>


							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-book"></i> Reg</td> <td style="padding-left: 30px; text-align:left; width: 60%;"> 
							$pre_regnum$regNum </td></tr>
							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-user"></i> Name </td> <td style="padding-left: 30px; text-align:left; width: 60%;">$studentName
							</td> </tr>
							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-money"></i> Fee Paid </td> <td style="padding-left: 30px; text-align:left; width: 60%;">$feeCategory
							</td> </tr>
							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-users"></i> School</td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$school</td> </tr>
							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-calendar"></i> Class </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$studentLevel $class </td> </tr>
							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-calendar-plus-o"></i> Term </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$sTerm</td> </tr>
							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-money"></i> Amount Paid</td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$amount</td> </tr>
							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-money"></i> Balance </td> <td style="padding-left: 30px; text-align:left; width: 60%;">$balance
							</td> </tr>
							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-bars"></i> Payment Method </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$payMethod</td> </tr>
							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-address-book"></i> Payment Details </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$fDetail</td> </tr>
							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-calendar-check-o"></i> Payment Date </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$date</td> </tr>
							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-exchange"></i> Status </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$payStatus</td> </tr>

						</table>

						<!-- / table -->

						</div>
		
IGWEZE;
				
						echo $showPayment; 
						
						echo "<script type='text/javascript'>  $('#editLoader').fadeOut(3000); </script>"; exit; 

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}else{
						
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}

			
exit;
?>