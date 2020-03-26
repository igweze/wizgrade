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
	This script handle payment gateway 
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configINwizGrade.php';  /* load wizGrade configuration files */
		         
				 
			if ($_REQUEST['gatewayPaymentData'] == 'saveGateway-future') {  /* save payment gateway */

				
				$user = strip_tags($_REQUEST['user']);
				$api =  strip_tags($_REQUEST['api']);				
				$password = strip_tags($_REQUEST['password']); 
				
				/* script validation */
				
				if ($user == "")  {
         			
					$msg_e = "* Oooooooops Error, please select PayGateway user name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($expDetails == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter PayGateway details";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($password == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter PayGateway password";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			} else {  /* insert information */    

		 			try { 
						
						$ebele_mark = "INSERT INTO $wizGradePayGatewayTB  (user, password, api, status)

								VALUES (:user, :password, :api, :status)";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':user', $user);
						$igweze_prep->bindValue(':password', $password);
						$igweze_prep->bindValue(':api', $api);
						$igweze_prep->bindValue(':status', $status); 
						
						if($igweze_prep->execute()){  /* if sucessfully */ 
							
							$msg_s = "School PayGateway was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewPayGateway').load('paymentGatewayInfo.php'); 
							$('#frmsavePayGateway')[0].reset();  $('#saveLoader').fadeOut(1500);  
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
			
			}elseif ($_REQUEST['gatewayPaymentData'] == 'updatePayGateway') {  /* update payment gateway */

				$gID = preg_replace("/[^0-9]/", "", $_REQUEST['gID']);	 
				$gateKey = trim($_REQUEST['gateKey']);  
				 
				$gateKey = strip_tags($gateKey);
				
				/* script validation */
								
				if ($gID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur to retrieve payment information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($gateKey == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter PayGateway Gateway Username";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* update information */     
					 
		 			try { 
						
						$ebele_mark = "UPDATE $wizGradePayGatewayTB  
											
											SET 
											
											gateKey = :gateKey 
											
										WHERE gID = :gID";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':gID', $gID); 
						$igweze_prep->bindValue(':gateKey', $gateKey); 
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "Payment gateway information was successfully saved."; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewPayGateway').load('paymentGatewayInfo.php'); 
							   $('#editLoader').fadeOut(1500);  $('#editPayGatewayDiv').slideUp(1500);
							</script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to save payment gateway. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
							
						} 

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}          		
        	
				}
			
			}elseif ($_REQUEST['gatewayPaymentData'] == 'viewPayGateway') {  /* view payment gateway */

				
				$gID = strip_tags($_REQUEST['rData']);
				
				/* script validation */ 
				
				if ($gID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve payment gateway information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  

		 			try { 
						
						$gatewayPaymentInfoArr = gatewayPaymentInfo($conn, $gID);  /* payment gateways information */ 
						$gateway = $gatewayPaymentInfoArr[$fiVal]["gateway"];
						$gatewayVerb = $gatewayPaymentInfoArr[$fiVal]["gatewayVerb"];
						$gateKey = $gatewayPaymentInfoArr[$fiVal]["gateKey"]; 	 
									

$showGateway =<<<IGWEZE
		
						<button  class="btn btn-white printer-icon pull-right">
						<i class="fa fa-print text-info"></i> Print </button><br clear="all"/><br clear="all"/>
		
						<div id = 'wizGradePrintArea'>

							<!-- table -->          		
							<table width = '100%' class="table table-striped  table-advance table-hover"> 

							<tr><th style="padding-left: 30px; text-align:left; width: 40%;"> $gatewayVerb </td> 
							<td style="padding-left: 30px; text-align:left; width: 60%;"> $gateKey </td> </tr> 

							</table>
							<!-- / table -->
						</div>
		
IGWEZE;
				
						echo $showGateway; 

						echo "<script type='text/javascript'>  $('#editLoader').fadeOut(3000); </script>"; exit;
						
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}  
        	
				}
			
			}elseif ($_REQUEST['gatewayPaymentData'] == 'editPayGateway') {  /* edit payment gateway */

				
				$gID = strip_tags($_REQUEST['rData']);
				
				/* script validation */ 
				
				if ($gID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve payment gateway information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* select information */        			


		 			try {
						
						
							$gatewayPaymentInfoArr = gatewayPaymentInfo($conn, $gID);  /* payment gateways information */
							$paymentID = $gatewayPaymentInfoArr[$fiVal]["gID"];
							$gateway = $gatewayPaymentInfoArr[$fiVal]["gateway"];
							$gatewayVerb = $gatewayPaymentInfoArr[$fiVal]["gatewayVerb"];
							$gateKey = $gatewayPaymentInfoArr[$fiVal]["gateKey"];
							 
							 
							
						
						?>

							<!-- form -->
							<form class="form-horizontal" id="frmupdatePayGateway" role="form"> 

								<div class="form-group" >
									<label for="gateKey" class="col-lg-4 col-sm-4 control-label"> <?php echo $gatewayVerb; ?></label>

									<div class="col-lg-8">

									<div class="iconic-input">
									<i class="fa fa-info"></i>

									<input type="text" class="form-control" placeholder="Enter PayGateway Gateway Sender Name" 
									name="gateKey"  id="gateKey" value="<?php echo $gateKey; ?>">

									</div>

									</div>
								</div> 

								<div class="form-group">
									<input type="hidden" name="gID" value="<?php echo $gID; ?>" />
									<input type="hidden" name="gatewayPaymentData" value="updatePayGateway" />
									<center><button type="submit" class="btn btn-danger demoDisenable buttonMargin" id="updatePayGateway">
									<i class="fa fa-save"></i> Update Gateway </button></center>
								</div> 

							</form>  	
							<!-- / form -->					
<?php
								
								
								
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