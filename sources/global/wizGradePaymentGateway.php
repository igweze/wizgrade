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
	This script load payment gateways checkout
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

				require ($wizGradevalidater); 
				
				$transRefNo  = wizGradeRandomString($charset, 20); /* generate auto random character */				
				$errTransRefNo  = wizGradeRandomString($charset, 20); /* generate auto random character */
				
				$wizGradePiloter = $_SESSION['wizGradePiloter'];
				
				$_SESSION['transRefNo'] = $transRefNo;				
				$_SESSION['errTransRefNo'] = $errTransRefNo; 
				
				$successURL = $wizGradePiloter."/payment-success?c=$transRefNo"; /* success URL details */
				$errorURL = $wizGradePiloter."/payment-error?c=$transRefNo"; /* success URL details */
				$totalMulti = $total* 100;
				
				if($isCart == 1){ /* check if shopping cart */
					$scripta = 	'$("#orderConfirmation").trigger( "click" );';
				}else{
					$scripta = 	"";
				}		
			
$paystack =<<<IGWEZE
				
				
				<!-- paystack -->
					
				<form >
				  <script src="https://js.paystack.co/v1/inline.js"></script>
				  <button type="button" class="display-none" id="payStackCout" onclick="payWithPaystack()"></button> 
				</form>
				 
				<script>
				  function payWithPaystack(){
					var handler = PaystackPop.setup({
					  key: '$payStackPublicKey', 
					  email: '123@wizgrade.com',
					  amount: $totalMulti,
					  currency: "$countryCurrCode",
					  ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
					  firstname: '$nameFull',
					  lastname: '',
					  // label: "Optional string that replaces customer email"
					  metadata: {
						 custom_fields: [
							{
								display_name: "Mobile Number",
								variable_name: "mobile_number",
								value: "$phone"
							}
						 ]
					  },
					  callback: function(response){
						  $("#confirm-data").text(2);
						  $('.success-pay-div').fadeOut(1000);						  
						  $succesMsg1  Your transaction was successful $sEnd1;
						  $scripta 
						 //alert('success. transaction ref is ' + response.reference);
						 
					  },
					  onClose: function(){
						  $infoMsg1 Window was closed by you $sEnd1;
					  }
					});
					handler.openIframe();
				  }
				</script>

					 
					
				
				<!-- / paystack -->

IGWEZE;
					echo $paystack; 
					
					
$voguePay =<<<IGWEZE

				
				<!-- vogue pay Use demo as your merchant ID in test environment. -->
				
					<p class="bg-info" id="msg"></p>
					<!-- form --><form method="POST" action="https://voguepay.com/pay/" target="_blank">
					
						<input type="hidden" name="v_merchant_id" value="$voguePayID" /> 
						<input type="hidden" name="memo" value="Order from $schoolNameTop website"/>
						 
						<!-- Put your notification url, eg http://democode.com/notificaton.php -->
						<input type="hidden" name="notify_url" value="$errorURL"/>
						 
						<!-- Put your Success URL eg. http://democode/process.php?type=success -->
						<input type="hidden" name="success_url" value="$successURL" />
						 
						<!-- Put your Success URL eg. http://democode/process.php?type=cancel -->
						<input type="hidden" name="fail_url" value="$errorURL" />
						 
						<input type="hidden" name="merchant_ref" value="$transRefNo" />
						<input type="hidden" name="cur" value="$countryCurrCode" />
						<input type="hidden" name="item_1" value="$productItem" />
						<input type="hidden" name="price_1" value="$total" />
						<input type="hidden" name="description_1" value="$productDesc" />
						
						<input type='hidden' name='developer_code' value='58bd6a415beb8' />						
					
						<input type="submit" id="voguePayCout" name="voguePayCout" class="display-none">
						
					</form><!-- / form -->

				<!-- / vogue pay -->
					
				
IGWEZE;
					echo $voguePay;
					

$twoCheckout =<<<IGWEZE

				
				<!-- 2checkout  https://www.2checkout.com/checkout/purchase -->
				
				<!-- form --><form action='https://sandbox.2checkout.com/checkout/purchase' method='post' target="_blank">
					
					<input type='hidden' name='sid' value='$twoCheckoutAccKey' /> 					
  
					<input type='hidden' name='mode' value='2CO' >
					<input type='hidden' name='li_0_type' value='product' >
					<input type='hidden' name='li_0_name' value='$productItem' >
					<input type='hidden' name='li_0_product_id' value='$transRefNo' >
					
					<input type='hidden' name='li_0_price' value='$total' >

					<input type="hidden" name="demo" value="Y">

					<input type='hidden' name='card_holder_name' value='$nameFull' >
					<input type='hidden' name='street_address' value='$address' >
					<input type='hidden' name='street_address2' value='' >
					<input type='hidden' name='city' value='$city' >
					<input type='hidden' name='state' value='$state' >
					<input type='hidden' name='zip' value='' >
					<input type='hidden' name='country' value='$country' >
					<input type='hidden' name='email' value='example@2co.com' >
					<input type='hidden' name='phone' value='$phone' >
					
					<input type='hidden' name='ship_name' value='$nameFull' >
					<input type='hidden' name='ship_street_address' value='$address' >
					<input type='hidden' name='ship_street_address2' value='' >
					<input type='hidden' name='ship_city' value='$city' >
					<input type='hidden' name='ship_state' value='$state' >
					<input type='hidden' name='ship_zip' value='' >
					<input type='hidden' name='ship_country' value='$country' >
					
					
					<input type="hidden" name="x_receipt_link_url" value="$successURL">
					
					<input name='submit' id="twoCheckout" type='submit' value='Checkout' class="display-none">
					<input type='hidden' name='currency_code' value='$countryCurrCode'>
					
					
				</form><!-- / form -->

				<!-- / 2checkout  -->
					
				
IGWEZE;
					echo $twoCheckout;


$payPal =<<<IGWEZE

				
				<!-- paypal -->
				<!-- form --><form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_blank">
				
					<!-- Identify your business so that you can collect the payments. -->
					<input type="hidden" name="business" value="$paypalID">
					
					<!-- Specify a Buy Now button. -->
					<input type="hidden" name="cmd" value="_xclick">
					
					<!-- Specify details about the item that buyers will purchase. -->
					<input type="hidden" name="item_name" value="$productItem">
					<input type="hidden" name="item_number" value="1">
					<input type="hidden" name="amount" value="$total">
					<input type="hidden" name="currency_code" value="$countryCurrCode">
					
					<!-- Specify URLs -->
					<input type='hidden' name='cancel_return' value='$errorURL'>
					<input type='hidden' name='return' value='$successURL'>
					
					<input name='submit' id="paypalCout" type='submit' value='Paypal Checkout' class="display-none">
					
				</form><!-- / form -->

				<!-- / paypal -->
					
				
IGWEZE;
					echo $payPal;		
					
?>