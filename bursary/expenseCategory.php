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
	This script handle school expenses category
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */
		         
			if ($_REQUEST['expenseCategoryData'] == 'expenseCategoryConfigs') {  /* save expenses category */

				
				$expenseCategory = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['expense']);				
				$regDate = strtotime(date("Y-m-d H:i:s"));
				
				/* script validation */ 
				
				if ($expenseCategory == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter new expense category name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* insert information */      	 		


		 			try {
						
						
						$ebele_mark = "INSERT INTO $expenseCategoryTB  (expense)

								VALUES (:expense)";
					 
						$igweze_prep = $conn->prepare($ebele_mark);

						$igweze_prep->bindValue(':expense', $expenseCategory); 
						
						if($igweze_prep->execute()){  /* if sucessfully */ 
							
							$msg_s = "<strong>$expenseCategory</strong> expense was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'> $('#viewExpenseCategory').load('expenseCategoryInfo.php'); 
							$('#frmsaveExpenseCategory')[0].reset();  $('#saveLoader').fadeOut(1500);  
							$('.alert').fadeOut(18000); </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to add new expense category. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['expenseCategoryData'] == 'updateExpenseCategory') {  /* update expenses category */

				
				$expenseCategory = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['expense']);
				$eID = preg_replace("/[^0-9]/", "", $_REQUEST['eID']);			
				
				/* script validation */ 
				
				if ($eID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to save expense category information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($expenseCategory == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter new expense category name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* update information */       			


		 			try {
						
						
						$ebele_mark = "UPDATE $expenseCategoryTB
										
										SET 
										
											expense = :expense
											
											WHERE e_id = :e_id";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':expense', $expenseCategory);
						$igweze_prep->bindValue(':e_id', $eID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "<strong>$expenseCategory</strong> was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewExpenseCategory').load('expenseCategoryInfo.php'); 
							   $('#editLoader').fadeOut(1500);  $('#editExpenseCategoryDiv').slideUp(1500);
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save expense category. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['expenseCategoryData'] == 'removeExpenseCategory') {  /* remove expenses category */

				
				$expenseCategoryData = $_REQUEST['rData'];
				
				list($wizGradeIg, $eID, $hName) = explode("-", $expenseCategoryData);			
				
				/* script validation */ 
				
				if (($expenseCategoryData == "")  || ($eID == "")){
         			
					$msg_e = "* Ooooooooops, an error has occur while to remove expense category. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* update information */     			


		 			try {
						
						
						$ebele_mark = "UPDATE $expenseCategoryTB
										
										SET 										
											status = :status
											
											WHERE e_id = :e_id";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':status', $i_false);
						$igweze_prep->bindValue(':e_id', $eID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$eID."').fadeOut(1000);";
							$msg_s = "<strong>$hName</strong> was successfully Disenable"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'>   
							$('#removeLoader').fadeOut(1500); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to remove expense category. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
         		
        	
				}
			
			}elseif ($_REQUEST['expenseCategoryData'] == 'editExpenseCategory') {  /* edit expenses category */

				
				$eID = strip_tags($_REQUEST['rData']);
				
				/* script validation */
				
				if ($eID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve expense category information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* select information */       			


		 			try {
						
						
						$expenseCategoryInfoArr = expenseCategoryInfo($conn, $eID);  /* school expenses category information */
						$expenseCategory = $expenseCategoryInfoArr[$fiVal]['expense'];
						$amount = $expenseCategoryInfoArr[$fiVal]['amount'];
						$status = $expenseCategoryInfoArr[$fiVal]['status'];


$expenseCategoryFrm =<<<IGWEZE
        
						<!-- form -->
						<form class="form-horizontal" id="frmupdateExpenseCategory" role="form"> 
						
						<div class="form-group">
							<label for="expenseCategory" class="col-lg-5 control-label">*
							Expense Category </label>
							<div class="col-lg-7">
							<div class="iconic-input">
							<i class="fa fa-money"></i>
							<input type="text"  id="expense" name="expense"  class="form-control"  value="$expenseCategory"
							required style="text-transform:Capitalize;">
							</div>
							</div>
						</div>    



						<div class="form-group">
							<input type="hidden" name="expenseCategoryData" value="updateExpenseCategory" />
							<input type="hidden" name="eID" value="$eID" />		

							<center><button type="submit" class="btn btn-danger buttonMargin" id="updateExpenseCategory">
							<i class="fa fa-save"></i> Update </button></center>
						</div>

						</form> 
						
						<!-- / form -->
		
IGWEZE;
                               
		                echo $expenseCategoryFrm;														
								
								
						echo "<script type='text/javascript'>   $('#editLoader').fadeOut(3000); </script>"; exit;
						
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
         		
        	
				}
			
			}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}
 
			
exit;
?>