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
		        
			if ($_REQUEST['expensesData'] == 'savePayment') {  /* save school expenses */

				
				$expID = preg_replace("/[^0-9-]/", "", $_REQUEST['expenseCat']);
				$expTitle =  strip_tags($_REQUEST['title']);
				$expDetails = $_REQUEST['expDetails'];
				$eAmount = strip_tags($_REQUEST['eAmount']);
				$method = preg_replace("/[^0-9]/", "", $_REQUEST['method']);
				$pDay = $_REQUEST['pDay'];
				
				/* script validation */ 
				
				if ($expID == "")  {
         			
					$msg_e = "* Oooooooops Error, please select expenditure category";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($expDetails == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter expenditure details";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($eAmount == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter expenditure amount";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($method == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a expenditure method";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($pDay == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a expenditure date";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}else {   /* insert information */   
					
					$expDetails = strip_tags($expDetails);
					$expDetails = str_replace('<br />', "\n", $expDetails);
					$expDetails = htmlspecialchars($expDetails); 

		 			try {
						
						
						$ebele_mark = "INSERT INTO $wizGradeExpenseTB  (expenseCat, eAmount, expTitle, method, expDetails, date)

								VALUES (:expenseCat, :eAmount, :expTitle, :method, :expDetails, :date)";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':expenseCat', $expID);
						$igweze_prep->bindValue(':eAmount', $eAmount);
						$igweze_prep->bindValue(':expTitle', $expTitle);
						$igweze_prep->bindValue(':method', $method);
						$igweze_prep->bindValue(':expDetails', $expDetails);
						$igweze_prep->bindValue(':date', $pDay); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "School expenditure was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewExpenses').load('wizGradeExpensesInfo.php'); 
							$('#frmsaveExpenses')[0].reset();  $('#saveLoader').fadeOut(1500);  
							$('.alert').fadeOut(30000); </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save expenditure. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}          		
        	
				}
			
			}elseif ($_REQUEST['expensesData'] == 'updateExpenses') {  /* update school expenses */

				$eID = preg_replace("/[^0-9]/", "", $_REQUEST['eID']);			
				$expID = preg_replace("/[^0-9-]/", "", $_REQUEST['expenseCat']);
				$expTitle =  strip_tags($_REQUEST['title']);
				$expDetails = $_REQUEST['expDetails'];
				$eAmount = strip_tags($_REQUEST['eAmount']);
				$method = preg_replace("/[^0-9]/", "", $_REQUEST['method']);
				$pDay = $_REQUEST['pDay'];
				
				/* script validation */
								
				if ($eID == ""){
         			
					$msg_e = "* Ooooooooops, aan error has occur to retrieve expenditure information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($expID == "")  {
         			
					$msg_e = "* Oooooooops Error, please select expenditure category";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($eAmount == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter expenditure amount";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($expDetails == "")  {
         			
					$msg_e = "* Oooooooops Error, please select expenditure details";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($method == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a expenditure method";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($pDay == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a expenditure date";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {   /* update information */     			
				
					$expDetails = strip_tags($expDetails);
					$expDetails = str_replace('<br />', "\n", $expDetails);
					$expDetails = htmlspecialchars($expDetails); 

		 			try { 
						
						$ebele_mark = "UPDATE $wizGradeExpenseTB  
											
											SET 
											
											expenseCat = :expenseCat, 
											eAmount = :eAmount, 
											expTitle = :expTitle,
											method = :method,		
											expDetails = :expDetails,
											date = :date
											
										WHERE eID = :eID";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':eID', $eID);
						$igweze_prep->bindValue(':expenseCat', $expID);
						$igweze_prep->bindValue(':eAmount', $eAmount);
						$igweze_prep->bindValue(':expTitle', $expTitle);
						$igweze_prep->bindValue(':method', $method);
						$igweze_prep->bindValue(':expDetails', $expDetails);
						$igweze_prep->bindValue(':date', $pDay); 
						
						if($igweze_prep->execute()){  /* if sucessfully */ 
							
							$msg_s = "School Expenditure was successfully saved."; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewExpenses').load('wizGradeExpensesInfo.php'); 
							   $('#editLoader').fadeOut(1500);  $('#editExpensesDiv').slideUp(1500);
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save expenditure. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['expensesData'] == 'removeExpenses') {  /* remove school expenses */

				
				$expensesData = $_REQUEST['rData'];
				
				list($wizGradeIg, $eID, $hName) = explode("-", $expensesData);			
				
				/* script validation */ 
				
				if (($expensesData == "")  || ($eID == "")){
         			
					$msg_e = "* Ooooooooops, an error has occur while to remove expenditure information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* remove information */      			


		 			try {
						
						
						$ebele_mark = "DELETE FROM 
						
										$wizGradeExpenseTB										
											
										WHERE eID = :eID
											
										LIMIT 1";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':eID', $eID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$eID."').fadeOut(1000);";
							$msg_s = "<strong>$hName</strong> was successfully removed"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'>   
							$('#removeLoader').fadeOut(1500); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to remove expenditure information. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}          		
        	
				}
			
			}elseif ($_REQUEST['expensesData'] == 'viewExpenses') {  /* view school expenses */

				
				$eID = strip_tags($_REQUEST['rData']);
				
				/* script validation */
				
				if ($eID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve expenditure information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {   /* select information */      			


		 			try {
						
						
						$expensesInfoArr = expensesInfo($conn, $eID);  /* school expenses information */
						//$expID = $expensesInfoArr[$fiVal]["eID"];
						$expID = $expensesInfoArr[$fiVal]["expenseCat"];
						$eAmount = $expensesInfoArr[$fiVal]["eAmount"];
						$expTitle = $expensesInfoArr[$fiVal]["expTitle"];
						$expDetails = htmlspecialchars_decode($expensesInfoArr[$fiVal]["expDetails"]);
						$method = $expensesInfoArr[$fiVal]["method"];
						$date = $expensesInfoArr[$fiVal]["date"];						
								
						$expenseCategoryInfoArr = expenseCategoryInfo($conn, $expID);  /* school expenses category information */
						$expenseCategory = $expenseCategoryInfoArr[$fiVal]['expense'];
						
						$payMethod = $paymentMethodArr[$method];				
						$date = date("j F Y", strtotime($date));						
						$amount = wizGradeCurrency($eAmount, $curSymbol);						
						$expDetails = nl2br($expDetails);
									

$showPayment =<<<IGWEZE
		
						<button  class="btn btn-white printer-icon pull-right">
						<i class="fa fa-print text-info"></i> Print </button><br clear="all"/><br clear="all"/>

						<div id = 'wizGradePrintArea'>
						
							<!-- table -->
							
							<table width = '100%' class="table table-striped  table-advance table-hover">

							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-money"></i> Expense Paid </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$expenseCategory
							</td> </tr>

							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-calendar"></i> Class </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$expTitle class </td> </tr>

							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-money"></i> Amount Paid</td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$amount</td> </tr>

							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-address-book"></i> Payment Details </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$expDetails</td> </tr>

							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-calendar-check-o"></i> Payment Date </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$date</td> </tr>

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
			
			}elseif ($_REQUEST['expensesData'] == 'editExpenses') {  /* edit school expenses */

				
				$eID = $_REQUEST['rData'];
				
				/* script validation */ 
				
				if ($eID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve expenditure information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       			


		 			try { 
						
							$expensesInfoArr = expensesInfo($conn, $eID);  /* school expenses information */
							$expID = $expensesInfoArr[$fiVal]["eID"];
							$expID = $expensesInfoArr[$fiVal]["expenseCat"];
							$expTitle = $expensesInfoArr[$fiVal]["expTitle"];
							$expDetails = htmlspecialchars_decode($expensesInfoArr[$fiVal]["expDetails"]);
							$method = $expensesInfoArr[$fiVal]["method"];
							$amount = $expensesInfoArr[$fiVal]["eAmount"];
							$date = $expensesInfoArr[$fiVal]["date"];
							
						
						?>
						
						<!-- form -->
						
						<form class="form-horizontal" id="frmupdateExpenses" role="form"> 
									  
							<div class="form-group">
							<label for="expenseCat" class="col-lg-4 col-sm-4 control-label">* Expense Category</label>

							<div class="col-lg-8">
							  <div class="iconic-input">
								  <i class="fa fa-sort-alpha-asc"></i>								  
								  <select class="form-control"  id="expenseCat" name="expenseCat" required>
								  
									<option value = "">Please select One</option>

									<?php									
									
										try {

												$expenseCategoryDataArr = expenseCategoryData($conn);  /* school expenses category array */
												$expenseCategoryDataCount = count($expenseCategoryDataArr);
												
										}catch(PDOException $e) {
											
													wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
											 
										}		
										 
										if($expenseCategoryDataCount >= $fiVal){	/* check array is empty */	 

											for($i = $fiVal; $i <= $expenseCategoryDataCount; $i++){	/* loop array */
											
												$eID = $expenseCategoryDataArr[$i]["e_id"];
												$expenseCategory = $expenseCategoryDataArr[$i]["expense"];
												
												$expenseCategory = trim($expenseCategory); 

												if ( $eID == $expID){
													$selected = "SELECTED";
												} else {
													$selected = "";
												}

												echo '<option value="'.$eID.'"'.$selected.'>
												'.$expenseCategory.'</option>' ."\r\n";

											}
											
										}else{
											
												echo '<option value="">Oooooooops Error, could not find expense
												category.</option>' ."\r\n";
												
										}	
										
									?>
								
									</select>
							  </div>
							</div>
							</div> 

							<div class="form-group" >
								<label for="title" class="col-lg-4 col-sm-4 control-label"> Expense Title</label>

								<div class="col-lg-8">

								<div class="iconic-input">
									  <i class="fa fa-comment"></i>
									  
								<input type="text" class="form-control" placeholder="Enter Expense Title" 
								name="title"  id="title" value="<?php echo $expTitle; ?>">

								</div>

								</div>
							</div> 

							<div class="form-group" >
								<label for="amount" class="col-lg-4 col-sm-4 control-label">* Amount Paid</label>

								<div class="col-lg-8">

								<div class="iconic-input">
									  <i class="fa fa-money"></i>
									  
								<input type="number" class="form-control" placeholder="Enter Amount Paid" 
								name="eAmount"  id="eAmount" value = "<?php echo $amount; ?>" required>

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
									
										foreach($paymentMethodArr as $methodKey => $methodVal){ /* loop array */

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
								<label for="expDetails" class="col-lg-4 col-sm-4 control-label"> &nbsp;&nbsp; Payment Details</label>

								<div class="col-lg-8">

								<textarea rows="4" cols="10" class="form-control" name="expDetails" id="expDetails" 
								placeholder="Payment Details eg Bank Name, Teller ID, Cheque ID, Card 
								Type "><?php echo $expDetails; ?></textarea>

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
									  <input type="hidden" name="eID" value="<?php echo $expID; ?>" />		
								  </div>
							</div>

							<!-- </div> --> 

							<div class="form-group">
								<input type="hidden" name="expensesData" value="updateExpenses" />
								<center><button type="submit" class="btn btn-danger buttonMargin" id="updateExpenses">
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