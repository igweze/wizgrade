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
	This script handle product checkout
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */


		if ($_REQUEST['shopData'] == 'cOut') { 
				
			try {
				 
				$billingData = billingData($conn, $regNum);  /* students billing information  */ 
				list($nameFull, $address, $city, $state, $country, $phone) = explode("##", $billingData);
				$refReg = preg_replace("/[^A-Za-z0-9]/", "", $regNum); 
				
						
			}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
			}			


				
$cartHead =<<<IGWEZE
	
					<!-- invoice start -->
			  
						<section class="panel" id="wizGradePrintArea">
							<header class="panel-heading">
                             <div align="center">Confirm Your Order</div>
							</header>
							<div class="panel-body wizGrade-linea success-pay-div">
			
					  
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
								  <th class='text-left'>Tasks</th>
                              </tr>
                              </thead>
                              <tbody>
							  

		
IGWEZE;
							echo $cartHead;
		
							$total = 0;
			
							foreach($_SESSION["igweze_ebele"] as $product){  /* loop array */ 
						
								try { 
						
									$productID = $product["code"];
									$productData =  productInfo($conn, $productID);  /* school products information*/
								
								}catch(PDOException $e) {

									wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

								}
								list ($p_id, $p_title, $p_date, $p_price, $p_description) = explode ("@(.$*S*$.)@", $productData);
								
								$productItem .= $p_title.', ';
								$productDesc .= $p_description.', ';
								
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
								$serialCount++;
					
$cartBody =<<<IGWEZE

								<tr id="cOut-$productID">
										 <td class='text-left'>$serialCount</td>
										 <td class='text-left'>$product_name</td>
										 <td class='text-left' >$p_title</td>
										 <td class='text-left'>$curSymbol$p_price  </td>
										 <td class='text-left'>$product_qty </td>
										 
										 <td class='text-left'> $curSymbol$subtotalS</td>
										 <td class='text-left'>
										 <a href="javascript:;" class="remove-item-rs" data-code="$product_code"><i class="fa fa-times"></i></a>
										 <a href="javascript:;" class="editProduct" id="wizGrade-$product_code-$product_qty"><i class="fa fa-edit"></i></a>
										 </td>	
								 </tr>
							  
					
		
IGWEZE;
								echo $cartBody;
					
					
							}
			
							$grand_total = number_format($total, 2);
							
							$productDesc = trim($productDesc, ', ');
							$productItem = trim($productItem, ', ');
							
							$_SESSION['cartTotal'] = $total;
					
						
$cardTail =<<<IGWEZE

							</tbody>
							</table>
							<!-- / table -->  
							
							<!-- row -->
							<div class="row">
								<div class="col-lg-8 invoice-block pull-left">
							  
								<section class="panel">
								<header class="panel-heading text-left">
								  Select Your Payment Method
								</header>
								<div class="panel-body wizGrade-line"> 
									<div id="orderConfirmation"> </div>
									<span id="confirm-data" class="display-none">1</span>
									<div class="form-group text-left">
                                    <label  for="payMethod" class="col-lg-4 col-sm-4 control-label">* Payment Method </label>
                                     
									<div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-money"></i>
                                              
                                              <select class="form-control"  id="payMethod" name="payMethod" required>
											  
												<option value = "">Please select one</option>
												<option value = "payStack">Paystack</option>
												<option value = "bankDeposit">Bank Deposit</option>
												<option value = "paypal">Paypal</option>
												<option value = "2Checkout">2Checkout</option>
                                				<!--<option value = "cashEnvoy">Cash Envoy</option>-->
												<option value = "voguePay">Vogue Pay</option> 
                                               
                                              </select>
                                              <input type="hidden" value="" name = ""/>
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
							<!-- / row -->
							<div class="text-center invoice-btn">
                              <a class="btn btn-danger btn-lg" id ="placeOrder"><i class="fa fa-check"></i> Place Your Order </a>
                              <a class="btn btn-info btn-lg printer-icon hide-res"><i class="fa fa-print"></i> Print </a>
							</div> 
					 
						</div>
						
						</section>
						<!-- invoice end -->

IGWEZE;
						echo $cardTail;
					
					
						
						$isCart = 1;
						
						echo "<script type='text/javascript'>  $('#mallLoader').fadeOut(3000); hidePageLoader();  /* hide page loader */
									$('.shopping-cart-box').fadeOut(); </script>";
						require_once $wizGradePayG;  /* include payment gateway script */			

		}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */

		}	
		
exit;	
?>