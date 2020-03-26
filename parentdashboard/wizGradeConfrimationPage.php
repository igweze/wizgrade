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
	This script handle products confirmation
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */


		if ($_REQUEST['shopData'] == 'confirmation') { 
				
			try {
					
				$paymentStatus = $_REQUEST['conStatus'];
				
				if($paymentStatus == $seVal){ $payStatus = "Paid";}
				else{ $payStatus = "Unpaid";}
				
				$billingData = billingData($conn, $regNum);
				list($nameFull, $address, $city, $state, $country, $phone) = explode("##", $billingData);
				
				$tranStatus = $transactionArr[$paymentStatus]; 
				
				$orderDate = date("Y-m-d H:i:s"); //strtotime()
				$orderIP = $_SERVER['REMOTE_ADDR'];
		
				$ebele_mark = "INSERT INTO $wizGradeOrderTB (reg_id, regNo, stype, orderIP, orderDate, status)

								 VALUES (:reg_id, :regNo, :stype, :orderIP, :orderDate, :status)";

				$igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':reg_id', $regID);
				$igweze_prep->bindValue(':regNo', $regNum);
				$igweze_prep->bindValue(':stype', $schoolID);
				$igweze_prep->bindValue(':orderIP', $orderIP);
				$igweze_prep->bindValue(':orderDate', $orderDate);
				$igweze_prep->bindValue(':status', $tranStatus);
				
				if($igweze_prep->execute()){
				
					$orderID = $conn->lastInsertId($wizGradeOrderTB);		 

				
$cartHead =<<<IGWEZE
	
					<!-- invoice start -->
			  
						<section class="panel" id="wizGradePrintArea">
							<header class="panel-heading">
								Your Order Confirmation and  Review 
							</header>
							<div class="panel-body wizGrade-linea">			
							$infMsg Thanks so much for patronizing us. We really appreciate you. $msgEnd
							<div class="row invoice-list">
                              
								<div class="col-lg-4 col-sm-4">
                                  <h4><b>BILLING ADDRESS</b></h4>
                                  <p>
                                     $nameFull<br>
									  $address<br>
                                      $city, $state, $country<br>
                                      $phone<br>
                                  </p>
								</div>
								<div class="col-lg-4 col-sm-4">
                                  <h4><b>DELIVERY ADDRESS</b></h4>
                                  <p>
                                      $nameFull<br>
									  $address<br>
                                      $city, $state, $country<br>
                                      $phone<br>
                                  </p>
								</div>
							  
							  
								<div class="col-lg-4 col-sm-4">
                                  <h4>INVOICE INFORMATION</h4>
                                  <ul class="unstyled">
                                      <li>Invoice Number	: <strong>INVOICE-$orderID</strong></li>
                                      <li>Invoice Date		: <strong>$orderDate</strong></li>
                                      <li>Invoice Status	: <strong>$payStatus</strong></li>
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
			
							foreach($_SESSION["igweze_ebele"] as $product){ 
						
								try { 
						
									$productID = $product["code"];
									$productData =  productInfo($conn, $productID);  /* school products information*/
								
								}catch(PDOException $e) {

									wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

								}
								
								list ($p_id, $p_title, $p_date, $p_price, $p_description) = explode ("@(.$*S*$.)@", $productData);
								
								$titleEn =  preg_replace("/[^A-Za-z0-9 ]/", "", $p_title);
								$titleEn = str_replace(" ", "-", $titleEn);
								
								$productLink = $p_id.'-'.$titleEn;
								
								$product_price = ($product["price"] * $product["qty"]);
								$product_price = number_format($product_price, 2);
								$product_name = $product["name"];
								$product_qty = $product["qty"];
								$product_code = $product["code"]; 
												
								$subtotal = ($product["price"] * $product["qty"]);
								$total = ($total + $subtotal);
								$subtotalS = number_format($subtotal, 2);
								
								/* insert product order information */ 
								
								$ebele_mark_1 = "INSERT INTO $wizGradeOrderSummTB  (order_id, product_id, qty, price)

												 VALUES (:order_id, :product_id, :qty, :price)";

								$igweze_prep_1 = $conn->prepare($ebele_mark_1);
								$igweze_prep_1->bindValue(':order_id', $orderID);
								$igweze_prep_1->bindValue(':product_id', $product_code);
								$igweze_prep_1->bindValue(':qty', $product_qty);
								$igweze_prep_1->bindValue(':price', $product_price);
								
								if($igweze_prep_1->execute()){
					
$cartBody =<<<IGWEZE

									<tr id="cOut-$productID">
										 <td class='text-left'>1</td>
										 <td class='text-left'>$product_name</td>
										 <td class='text-left' >$p_title</td>
										 <td class='text-left'>$curSymbol$p_price  </td>
										 <td class='text-left'>$product_qty </td>
										 
										 <td class='text-left'> $curSymbol$subtotalS</td>
										 
									</tr> 
		
IGWEZE;
									echo $cartBody;
								
								}
					
							}
							
							$grand_total = number_format($total, 2);
						
$cardTail =<<<IGWEZE

							</tbody>
							</table>						  
							<!-- / table -->  
							
							<!-- row -->	
							<div class="row">
                              <div class="col-lg-8 invoice-block pull-left">
							  
								<section class="panel bank-div">
								<header class="panel-heading text-left">
									Our Bank Details
								</header>
									<div class="panel-body wizGrade-line text-left" style="font-weight:bold"> 
								  
										<p> You can make payment for your order/s through our bank details below with Invoice 
										No : <strong>INVOICE-$orderID</strong> </p>
										
										$bankDetails
								  
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
							<!-- / row -->	
							<div class="text-center invoice-btn">                              
                              <a class="btn btn-info btn-lg printer-icon"><i class="fa fa-print"></i> Print Your Invoice </a>
							</div> 
					 
						</div>
						</section>
						<!-- invoice end -->	

IGWEZE;
						
						echo $cardTail; 
					
						unset($_SESSION["igweze_ebele"]); // hidePageLoader();  /* hide page loader */ $('#cart-info').html(''); $('.shopping-cart-box').fadeOut(); 
						
						unset($_SESSION['transRefNo']);
				
						unset($_SESSION['errTransRefNo']); 
					
						$updateCart = "<i class='fa fa-shopping-cart' style='color:#fff;'></i>";
						
						if($paymentStatus == $seVal){ $bankDiv = "$('.bank-div').fadeOut(100);";}
					
						echo "<script type='text/javascript'>  
					
							var emptyCart = 'emptyCart';
							$('#cart-info').load('wizGradeCart.php', {'cartData':emptyCart});
							$('.cart-box').trigger('click');  
							$('#mallLoader').fadeOut(3000); 
							$bankDiv
						</script>";
					
				}else{  /* display error */  
							
					$msg_e = "Oooooooooop Error, you transaction was unsuccessful. Please try again."; 
					echo $errorMsg.$msg_e.$eEnd; exit;
					
				}	
					
			}catch(PDOException $e) {
					
				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
			}						

		}else{ 
			
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */

		}	
		
exit;	
?>	