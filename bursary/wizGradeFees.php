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
		         
			if ($_REQUEST['feesData'] == 'savePayment') {  /* save fees */

				
				$feeCat = preg_replace("/[^0-9-]/", "", $_REQUEST['feeCat']);
				$schoolID = preg_replace("/[^0-9]/", "", $_REQUEST['schoolType']);
				$levelData =  $_REQUEST['class'];
				$regData = $_REQUEST['regData'];
				$term = preg_replace("/[^0-9]/", "", $_REQUEST['term']);
				$amountPaid = $_REQUEST['amountPaid'];
				$method = preg_replace("/[^0-9]/", "", $_REQUEST['method']);
				$payDetails = $_REQUEST['payDetails'];
				$pDay = $_REQUEST['pDay'];				
				
				list($feeCID, $feeAmount) = explode("-", $feeCat);				
				
				$feeAmountCur = wizGradeCurrency($feeAmount, $curSymbol);  /* school currency information*/
				$amountPaidCur = wizGradeCurrency($amountPaid, $curSymbol);  /* school currency information*/
				
				/* script validation */
				
				if ($feeCat == "")  {
         			
					$msg_e = "* Oooooooops Error, please select fee category";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($schoolID == "")  {
         			
					$msg_e = "* Oooooooops Error, please select school";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($levelData == "")  {
         			
					$msg_e = "* Oooooooops Error, please select student payment level";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($regData == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a student";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($term == "")  {
         			
					$msg_e = "* Oooooooops Error, please select payment term";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($amountPaid == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter payment amount";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($amountPaid > $feeAmount)  {
         			
					$msg_e = "* Oooooooops Error, your payment amount  <strong>$amountPaidCur</strong> entered is greater than 
					fee amount <strong>$feeAmountCur</strong>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($method == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a payment method";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($pDay == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a payment date";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}else {   /* insert information */   						
				
					list($schoolID, $level) = explode("@$@", $levelData);
					list($regID, $regNo, $sessionID, $class) = explode("@::@", $regData);
					
					$feeAmount = trim($feeAmount);
					$payDetails = strip_tags($payDetails);
					$payDetails = str_replace('<br />', "\n", $payDetails);
					$payDetails = htmlspecialchars($payDetails);
					
					if($amountPaid == $feeAmount){  /* check is amount paid is equal to fee*/
						
						$pStatus = $fiVal;
						$balance = ""; $msgC = "";
						
					}else{
						
						$balance = ($feeAmount - $amountPaid);
						$pStatus = $i_false;
						$balanceCur = wizGradeCurrency($balance, $curSymbol);  /* school currency information*/
						$msgC = " Meanwhile, <strong>$regNo</strong> has a balance of <strong>$balanceCur</strong> to pay up.";
						
					}	 

		 			try {						
						
						$ebele_mark = "INSERT INTO $wizGradeFeesTB  (feeCat, feeAmount, session, reg_id, regNo, stype, level, class, term, method, 
													f_details, amount, balance, date, f_status)

								VALUES (:feeCat, :feeAmount, :session, :reg_id, :regNo, :stype, :level, :class, :term, :method, 
													:f_details, :amount, :balance, :date, :f_status)";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':feeCat', $feeCID);
						$igweze_prep->bindValue(':feeAmount', $feeAmount);
						$igweze_prep->bindValue(':session', $sessionID);
						$igweze_prep->bindValue(':reg_id', $regID);
						$igweze_prep->bindValue(':regNo', $regNo);
						$igweze_prep->bindValue(':stype', $schoolID);
						$igweze_prep->bindValue(':level', $level);
						$igweze_prep->bindValue(':class', $class);
						$igweze_prep->bindValue(':term', $term);
						$igweze_prep->bindValue(':method', $method);
						$igweze_prep->bindValue(':f_details', $payDetails);
						$igweze_prep->bindValue(':amount', $amountPaid);
						$igweze_prep->bindValue(':balance', $balance);
						$igweze_prep->bindValue(':date', $pDay);
						$igweze_prep->bindValue(':f_status', $pStatus); 
						
						if($igweze_prep->execute()){  /* if sucessfully */ 
							
							$msg_s = "Payment was successfully saved.$msgC"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewFees').load('wizGradeFeesInfo.php'); 
							$('#frmsaveFees')[0].reset();  $('#saveLoader').fadeOut(1500);  
							$('.alert').fadeOut(30000); </script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to save payment. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}          		
        	
				}
			
			}elseif ($_REQUEST['feesData'] == 'updateFees') {  /* update fees */

				$fID = preg_replace("/[^0-9]/", "", $_REQUEST['fID']);			
				$feeCat = preg_replace("/[^0-9-]/", "", $_REQUEST['feeCat']);
				$levelData =  $_REQUEST['class'];
				$regData = $_REQUEST['regData'];
				$term = preg_replace("/[^0-9]/", "", $_REQUEST['term']);
				$amountPaid = $_REQUEST['amountPaid'];
				$method = preg_replace("/[^0-9]/", "", $_REQUEST['method']);
				$payDetails = $_REQUEST['payDetails'];
				$pDay = $_REQUEST['pDay'];				
				
				list($feeCID, $feeAmount) = explode("-", $feeCat);				
				
				$feeAmountCur = wizGradeCurrency($feeAmount, $curSymbol);  /* school currency information*/
				$amountPaidCur = wizGradeCurrency($amountPaid, $curSymbol);  /* school currency information*/ 
				
				/* script validation */
				
				if ($fID == ""){
         			
					$msg_e = "* Ooooooooops, aan error has occur to retrieve payment information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($feeCat == "")  {
         			
					$msg_e = "* Oooooooops Error, please select fee category";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($levelData == "")  {
         			
					$msg_e = "* Oooooooops Error, please select student payment level";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($term == "")  {
         			
					$msg_e = "* Oooooooops Error, please select payment term";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($amountPaid == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter payment amount";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($amountPaid > $feeAmount)  {
         			
					$msg_e = "* Oooooooops Error, your payment amount  <strong>$amountPaidCur</strong> entered is greater than 
					fee amount <strong>$feeAmountCur</strong>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($method == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a payment method";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($pDay == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a payment date";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {	 /* update information */      			
								
					list($schoolID, $level) = explode("@$@", $levelData);
					
					$feeAmount = trim($feeAmount);
					$payDetails = strip_tags($payDetails);
					$payDetails = str_replace('<br />', "\n", $payDetails);
					$payDetails = htmlspecialchars($payDetails);
					
					if($amountPaid == $feeAmount){  /* check is amount paid is equal to fee*/
						
						$pStatus = $fiVal;
						$balance = ""; $msgC = "";
						
					}else{
						
						$balance = ($feeAmount - $amountPaid);
						$pStatus = $i_false;
						$balanceCur = wizGradeCurrency($balance, $curSymbol);  /* school currency information*/
						$msgC = " Meanwhile, <strong>student</strong> has a balance of <strong>$balanceCur</strong> to pay up.";
						
					} 

		 			try { 
						
						$ebele_mark = "UPDATE $wizGradeFeesTB  
											
											SET 
											
											feeCat = :feeCat, 
											feeAmount = :feeAmount, 
											level = :level, 
											term = :term, 
											method = :method, 
											f_details = :f_details, 
											amount = :amount, 
											balance = :balance, 
											date = :date, 
											f_status = :f_status
											
										WHERE fID = :fID";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':fID', $fID);
						$igweze_prep->bindValue(':feeCat', $feeCID);
						$igweze_prep->bindValue(':feeAmount', $feeAmount);
						$igweze_prep->bindValue(':level', $level);
						$igweze_prep->bindValue(':term', $term);
						$igweze_prep->bindValue(':method', $method);
						$igweze_prep->bindValue(':f_details', $payDetails);
						$igweze_prep->bindValue(':amount', $amountPaid);
						$igweze_prep->bindValue(':balance', $balance);
						$igweze_prep->bindValue(':date', $pDay);
						$igweze_prep->bindValue(':f_status', $pStatus); 
						
						if($igweze_prep->execute()){  /* if sucessfully */ 
							
							$msg_s = "Payment was successfully saved.$msgC"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewFees').load('wizGradeFeesInfo.php'); 
							   $('#editLoader').fadeOut(1500);  $('#editFeesDiv').slideUp(1500);
							</script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to save payment. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
							
						} 

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
         		
        	
				}
			
			}elseif ($_REQUEST['feesData'] == 'removeFees') {  /* remove fees */

				$feesData = $_REQUEST['rData'];				
				list($wizGradeIg, $fID, $hName) = explode("-", $feesData);			
				
				/* script validation */ 
				
				if (($feesData == "")  || ($fID == "")){
         			
					$msg_e = "* Ooooooooops, an error has occur while to remove fee payment. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* remove information */   

		 			try { 
						
						$ebele_mark = "DELETE FROM 
						
										$wizGradeFeesTB										
											
										WHERE fID = :fID
											
										LIMIT 1";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':fID', $fID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$fID."').fadeOut(1000);";
							$msg_s = "<strong>$hName</strong> was successfully removed"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'>   
							$('#removeLoader').fadeOut(1500); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to remove fee payment. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['feesData'] == 'viewFees') {  /* view fees */
				
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
						
						require $wizGradeSchoolTBS; /* include student database table information  */					
			
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
			
			}elseif ($_REQUEST['feesData'] == 'editFees') {  /* edit fees */
				
				$fID = strip_tags($_REQUEST['rData']);
				
				/* script validation */ 
				
				if ($fID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve payment information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       			


		 			try {
						
						
							$feesInfoArr = feesInfo($conn, $fID);
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
							
						
						?>

							<!-- form -->						
							<form class="form-horizontal" id="frmupdateFees" role="form"> 
							
							<div class="form-group">
								<label for="feeCat" class="col-lg-4 col-sm-4 control-label">* Fee Category</label>

								<div class="col-lg-8">
									<div class="iconic-input">
									<i class="fa fa-sort-alpha-asc"></i>

									<select class="form-control"  id="feeCat" name="feeCat" required>

										<option value = "">Please select One</option>

										<?php


											try {

												$feeCategoryDataArr = feeCategoryData($conn);  /* school fee category array */
												$feeCategoryDataCount = count($feeCategoryDataArr);

											}catch(PDOException $e) {

												wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

											}		

											if($feeCategoryDataCount >= $fiVal){  /* check array is empty */ 

												for($i = $fiVal; $i <= $feeCategoryDataCount; $i++){  /* loop array */	

													$fID = $feeCategoryDataArr[$i]["f_id"];
													$feeCategory = $feeCategoryDataArr[$i]["fee"];
													$amount = $feeCategoryDataArr[$i]["amount"];
													$status = $feeCategoryDataArr[$i]["status"];

													$feeCategory = trim($feeCategory);
													$amount = trim($amount);
													$status = trim($status);

													$amountS = wizGradeCurrency($amount, $curSymbol);  /* school currency information*/ 

													if ( $fID == $feeCat){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$fID.'-'.$amount.'"'.$selected.'>
													'.$feeCategory.' - '.$amountS.'</option>' ."\r\n";

												}
												
											}else{

												echo '<option value="">Oooooooops Error, could find fee category.</option>' ."\r\n"; 

											}	 

										?>

									</select>
									</div>
								</div>
							</div> 

							<div class="form-group">
								<label for="class" class="col-lg-4 col-sm-4 control-label">*  Payment Level</label>

								<div class="col-lg-8">
									<div class="iconic-input">
									<i class="fa fa-level-down"></i>
										<select class="form-control"  id="cLevel" name="class" required>

											<option value = "">Please select One</option>
											<?php

												$level_list = mlevelArrays($schoolID);

												foreach($level_list as $levelKey => $levelVal){	  /* loop array */			

													if ($levelKey == $level){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$schoolID.'@$@'.$levelKey.'"'.$selected.'>'.$levelVal.'</option>' ."\r\n";

												}

											?>

										</select>
									</div>
								</div>
							</div> 

							<div class="form-group">
								<label  for="term" class="col-lg-4 col-sm-4 control-label">* Payment Term</label>

								<div class="col-lg-8">
								<div class="iconic-input">
								<i class="fa fa-book"></i>
									<select class="form-control"  id="term" name="term" required>
										<option value = "">Please select One</option>
										<?php

											foreach($term_list as $term_key => $term_value){  /* loop array */

												if ($term == $term_key){
													$selected = "SELECTED";
												} else {
													$selected = "";
												}

												echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

											}

										?> 
									</select>

								</div>
								</div>
							</div> 

							<div class="form-group" >
								<label for="amount" class="col-lg-4 col-sm-4 control-label">* Amount Paid</label>

								<div class="col-lg-8">

									<div class="iconic-input">
									<i class="fa fa-money"></i>
									<input type="number" class="form-control" placeholder="Enter Amount Paid" 
									name="amountPaid"  id="amountPaid" value = "<?php echo $amount; ?>" required>

									</div>

								</div>
							</div> 

							<div class="form-group">
								<label  for="method" class="col-lg-4 col-sm-4 control-label">* Payment Method</label>

								<div class="col-lg-8">
									<div class="iconic-input">
									<i class="fa fa-bars"></i>

										<select class="form-control"  id="method" name="method" required>

										<option value = "">Please select One</option>
										<?php

											foreach($paymentMethodArr as $methodKey => $methodVal){  /* loop array */

												if ($method == $methodKey){

													$selected = "SELECTED";

												} else {

													$selected = "";

												}

												echo '<option value="'.$methodKey.'"'.$selected.'>'.$methodVal.'</option>' ."\r\n";

											}

										?> 
										
										</select>
									</div>
								</div>
							</div> 

							<div class="form-group">
								<label for="payDetails" class="col-lg-4 col-sm-4 control-label"> &nbsp;&nbsp; Payment Details</label>

								<div class="col-lg-8">

								<textarea rows="4" cols="10" class="form-control" name="payDetails" id="payDetails" 
								placeholder="Payment Details eg Bank Name, Teller ID, Cheque ID, Card Type "><?php echo $fDetail; ?></textarea>

								</div>
							</div>  
							
							<div class="form-group">
								<label class="control-label col-lg-4 col-sm-4">* Payment Date:</label>
								<div class="col-lg-7 col-sm-7">
									<div data-date-viewmode="years" data-date-format="yyyy-mm-dd" 
									data-date="2012-12-02"  
									class="input-append date dpYears">
									<input type="text" readonly="" 
									value="<?php echo $date; ?>" 
									size="10" class="form-control"  name="pDay"  required />
									<span class="input-group-btn add-on">
									<button class="btn btn-danger" type="button">
									<i class="fa fa-calendar"></i></button>
									</span>
									</div>
									<span class="help-block">Select date</span>
									<input type="hidden" name="fID" value="<?php echo $feeID; ?>" />		
								</div>
							</div>

							<!-- </div> --> 

							<span id="waitDi": style="display: none;">
								<center><img alt="Please Wait" src="loading.gif"/></center> <!-- loading image -->
							</span>
							<span id="payStatusDiv" style="display: none;"></span>  <!-- loading div -->

							<div class="form-group">
								<input type="hidden" name="feesData" value="updateFees" />
								<center><button type="submit" class="btn btn-danger buttonMargin" id="updateFees">
								<i class="fa fa-save"></i> Update Payment </button></center>
							</div>



							</form>  	
							<!-- / form -->					
<?php
								
								
								
							echo "<script type='text/javascript'>  $('.dpYears').datepicker();  
							$('#editLoader').fadeOut(3000); </script>"; exit;
						
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
         		
        	
				}
			
			}else{
						
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}

			
exit;
?>