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
	This script handle school shopping information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */

			if ($_REQUEST['transData'] == 'viewOrder') {  /* view product order */ 
				
				$transID = preg_replace("/[^0-9 ]/", "", $_REQUEST['transID']);				
				$regDate = strtotime(date("Y-m-d H:i:s"));			
				
				/* script validation */ 
				
				if ($transID == "")  {
         			
					$msg_e = "* Oooooooops Error, could not retrieve transaction information.";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {   /* select order */    
				
				
					try{
					
						$ebele_mark = "SELECT order_id, reg_id, regNo, stype, orderDate, status
						
										FROM $wizGradeOrderTB 
										
										WHERE order_id  = :order_id";
							 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':order_id', $transID);						 
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count == $fiVal) {  /* check select is empty */
						
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
			   
									$orderID = $row['order_id'];
									$regID = $row['reg_id'];
									$regNum = $row['regNo'];
									$schoolID = $row['stype'];
									$orderDate = $row['orderDate'];
									$status = $row['status']; 
							}
							
							//$orderTime = timerBoy($orderDate);
							$orderDate = strtotime($orderDate);
							$orderTime = date("j M Y", $orderDate);
							$orderStatus = $transactionArr[$status];

							$school = $school_list[$schoolID];
									
							require $wizGradeSchoolTBS; /* include student database table information  */						
								
							$regNum = studentReg($conn, $regID);  /* student registration number  */													
							$studentName = studentName($conn, $regNum);  /* student name  */										
							$studentPic = studentPicture($conn, $regNum);  /* student picture */
							$billingData = billingData($conn, $regNum);  /* students billing information  */ 
							list($nameFull, $address, $city, $state, $country, $phone) = explode("##", $billingData);	
																
							
						}else{
							
								$msg_e = "* Oooooooops Error, could not retrieve this order information.";
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
								
						}	
 	

$cartHead =<<<IGWEZE
	
				<button  class="btn btn-white printer-icon pull-right">
									  <i class="fa fa-print text-info"></i> Print </button><br clear="all"/><br clear="all"/>
		
				<div id = 'wizGradePrintArea'>		
				<!-- invoice start-->
				<section>
					<div class="panel panel-primary">
                      <div class="panel-heading"> Transaction Invoice </div>
                      <div class="panel-body wizGrade-line">
                          <div class="row invoice-list">
                              
                              <div class="col-lg-4 col-sm-4">
                                  <h4>BILLING ADDRESS</h4>
                                  <p>
                                     $nameFull<br>
									  $address<br>
                                      $city, $state, $country<br>
                                      $phone<br>
                                  </p>
                              </div>
                              <div class="col-lg-4 col-sm-4">
                                  <h4>SHIPPING ADDRESS</h4>
                                  <p>
                                      $nameFull<br>
									  $address<br>
                                      $city, $state, $country<br>
                                      $phone<br>
                                  </p>
                              </div>
                              <div class="col-lg-4 col-sm-4">
                                  <h4>INVOICE INFO</h4>
                                  <ul class="unstyled">
                                      <li>Invoice Number	: <strong>Order-$orderID</strong></li>
                                      <li>Invoice Date		: $orderTime</li>
                                      <li>Invoice Status		: <span class="tranStatus-$orderID"> $orderStatus </span></li>
                                  </ul>
                              </div>
                          </div>
						  <!-- table -->
                          <table class="table table-striped table-hover">
                              <thead>
                              <tr>
                                  <th class='text-left'>#</th>
                                  <th class='text-left'>Item</th>
                                  <th class='text-left'>Description</th>
                                  <th class='text-left'>Unit Cost</th>
                                  <th class='text-left'>Quantity</th>
                                  <th class='text-left'>Total</th>
								  
                              </tr>
                              </thead>
                              <tbody>
							  

		
IGWEZE;
						echo $cartHead;
		
						$total = 0; 

						$ebele_mark = "SELECT s_id, order_id, product_id, qty, price
						
										FROM $wizGradeOrderSummTB 
										
										WHERE order_id  = :order_id";
							 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':order_id', $orderID);							 
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count >= $fiVal) {  /* check select is empty */
						
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
			   
								$s_id = $row['s_id'];
								//$orderIDS = $row['order_id'];
								$productID = $row['product_id'];
								$qty = $row['qty'];
								$price = $row['price'];
								
								$productData =  productInfo($conn, $productID);  /* school products information*/
					
								list ($p_id, $p_title, $p_date, $p_price, $p_description) = explode ("@(.$*S*$.)@", $productData); 
	
								$product_price = ($price * $qty);
								$product_price = number_format($product_price, 2); 
					
								$subtotal = ($price * $qty);
								$total = ($total + $subtotal);
								$subtotalS = number_format($subtotal, 2);
								
								$serialNo++;
				

$cartBody =<<<IGWEZE

								<tr id="cOut-$productID">
									<td class='text-left'>$serialNo</td>
									<td class='text-left'>$product_name</td>
									<td class='text-left' >$p_title</td>
									<td class='text-left'>$curSymbol$p_price  </td>
									<td class='text-left'>$qty </td>										 
									<td class='text-left'> $curSymbol$subtotalS</td>										 
								</tr> 
		
IGWEZE;
								echo $cartBody; 
							
							} 

							$grand_total = number_format($total, 2);
						
$cardTailTop =<<<IGWEZE



							</tbody>
							</table>
						  
							<!-- / table -->  
							
							<!-- row -->
							<div class="row">
							  <div id="editMsg"> </div>
								<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="transLoader"  
												  style="cursor:pointer; display:none; margin-bottom:5px;" /></center>	
								  <div class="col-lg-8 invoice-block pull-left slideTransaction">
								  
								  <section class="panel">
								  <header class="panel-heading text-left">
									  Select Transaction Status
								  </header>
								  <div class="panel-body wizGrade-line"> 
								  
									  <div class="form-group text-left">
										  <label  for="tranStatus" class="col-lg-4 col-sm-4 control-label">* Transaction Status </label>
										 
									  <div class="col-lg-8">
											<div class="iconic-input">
											<i class="fa fa-money"></i>
												  
											<select class="form-control"  id="tranStatus" name="tranStatus" required>
                                                                              				
		
IGWEZE;
							echo $cardTailTop;
					
												foreach($transactionArr as $trans_key => $trans_value){  /* loop array */

													if ($status == $trans_key){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$trans_key.'"'.$selected.'>'.$trans_value.'</option>' ."\r\n";

												}
										

$cardTailBot =<<<IGWEZE

 
                                              </select>
											  <input type="hidden" value="$orderID" name="transID" id="transID">
												  
											  </div>
										  </div>
									  </div>

									  
									  </div>
									  </section> 
									</div>
								  
									<div class="col-lg-4 invoice-block pull-right">
									  <ul class="unstyled amounts">
										  <li><strong>Sub - Total amount :</strong> $curSymbol$grand_total </li>
										  <li><strong>VAT :</strong> -----</li>
										  <li><strong>Grand Total :</strong> $curSymbol$grand_total </li>
									  </ul>
									</div>
								  
								  
								</div> 
									  </div>
								  </div>
							  </section>
						
							</div>
							<!-- / row -->
		
IGWEZE;
							echo $cardTailBot;	 
					
						}			
							

					}catch(PDOException $e) {
						
								wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
						 
					} 
				
					echo "<script type='text/javascript'>  $('#editLoader').fadeOut(1500); </script>";exit;
				} 
				
				
		    }elseif($_REQUEST['transData'] == 'tranStatus') {  /* update transaction status */

				
				$transID = preg_replace("/[^0-9]/", "", $_REQUEST['transID']);				
				$status= $_REQUEST['status'];
				
				/* script validation */ 
				
				if($transID == "")  {
         			
					$msg_e = "* Oooooooops Error, could not retrieve transaction information.";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  $('#transLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif($status == '') { 
				
					$msg_e = "Ooooooooops Error, Please select a transaction status"; 
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  $('#transLoader').fadeOut(1500); </script>";exit;
													
				}else {  /* update information */      
				
					try{ 
						
						$ebele_mark = "UPDATE $wizGradeOrderTB
						
											SET 
											
											status = :status
											
										WHERE order_id  = :order_id";
		
						$igweze_prep = $conn->prepare($ebele_mark);
		
						$igweze_prep->bindValue(':status', $status);
						$igweze_prep->bindValue(':order_id', $transID);
						
						if ($igweze_prep->execute()){  /* if sucessfully */ 
						
							$orderStatus = $transactionArr[$status];									
							$msg_s = "Transaction Status was successfully change to <strong> $orderStatus </strong> "; 								
							echo $succesMsg.$msg_s.$sEnd; 

						
$tMsg =<<<IGWEZE

							<script type='text/javascript'> $('.slideTransaction').fadeOut(1500);
								$('#transLoader').fadeOut(1500); $('.tranStatus-$transID').html('$orderStatus');  
							</script>                                   				
		
IGWEZE;
							echo $tMsg; exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save transaction status. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#transLoader').fadeOut(1500); </script>";exit;
							
						}
						
					}catch(PDOException $e) {
						
								wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
						 
					}

				}

				
			}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			} 
			
exit; 
?>
	        
