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
	This script handle shopping cart
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */ 

		if(isset($_POST["load_cart"]) && $_POST["load_cart"]==1){  /* load cart information */ 

			if(isset($_SESSION["igweze_ebele"]) && count($_SESSION["igweze_ebele"])>0){
			 
				$cart_box = '<ul class="cart-products-loaded">';
				$total = 0;
				foreach($_SESSION["igweze_ebele"] as $product){ /* loop though items and prepare html content */
			
					try { 
			
						$productID = $product["code"];
						$productData =  productInfo($conn, $productID);  /* school products information*/
					
					}catch(PDOException $e) {

						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

					}
					
					list ($pID, $p_title, $p_date, $p_price, $p_description) = explode ("@(.$*S*$.)@", $productData);
					
					$titleEn =  preg_replace("/[^A-Za-z0-9 ]/", "", $p_title);
					$titleEn = str_replace(" ", "-", $titleEn);
					
					$productLink = $pID.'-'.$titleEn;
					
					$product_price = ($product["price"] * $product["qty"]);
					$product_price = number_format($product_price, 2);
					
					$product_name = $product["name"];
					if(strlen($product_name) >= 11){
						$product_name = substr($product_name, 0, 11).".";
					}
			
					$cart_box .=  '<li> <i class="fa fa-cart-plus"></i> ' . $product_name. ' (Qty : ' . $product["qty"]. ') &mdash; ' 
					. $curSymbol. $product_price . ' 
					
					<a href="javascript:;" class="remove-item hide-res" data-code="'.$product["code"].'"><i class="fa fa-times"></i></a>
					<a href="javascript:;" class="editProduct hide-res" id="wizGrade-'.$pID.'-'.$product["qty"].'"><i class="fa fa-edit"></i></a>
					</li>';
					$subtotal = ($product["price"] * $product["qty"]);
					$total = ($total + $subtotal);
					//'.$productLink.'
				}
			
				$product_total = number_format($total, 2);
			
				$cart_box .= "</ul>";
				$cart_box .= '<div class="cart-products-total"> <i class="fa fa-cart-plus"></i>  Total : '.$curSymbol.$product_total.' <u>
				<a href="javascript:;" title="Review Cart and Check-Out" class="checkOut"><i class="fa fa-sign-out"></i>Check Out</a>
				</u></div>';
				
				die($cart_box); /* exit and display content */
				
			}else{
				die("Your Cart is empty");   /* display error */
			}
	
		} 
		
		if(isset($_REQUEST["remove_code"]) && isset($_SESSION["igweze_ebele"])){  /* remove item from shopping cart */ 		
			
    		$product_code   = strip_tags($_REQUEST["remove_code"]);  
   			
			$product = array();
			
			foreach ($_SESSION["igweze_ebele"] as $cart_itm){  /* loop array */
     
				if($cart_itm["code"]!= $product_code){ /* item do not exist in the list */
				
            		$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
				}
				
				$_SESSION["igweze_ebele"] = $product;
			
			}
						
			echo '<i class="fa fa-shopping-cart" style="color:#000;"></i>';
			echo ' <span class="badge bg-warning"> '; 
 			echo $total_items = count($_SESSION["igweze_ebele"]);
			echo ' </span>';
			
			$msg_s = "Product Item was successfully deleted"; 
			echo $succesMsg.$msg_s.$sEnd; 
							
			//die(json_encode(array('items'=>$total_items)));
		}

		if(isset($_POST["quantity"]) && isset($_POST["product_code"])){  /* add item to shopping cart */ 		

			$product_code = strip_tags($_POST["product_code"]); //product code
			$product_qty = strip_tags($_POST["quantity"]); //product quantity
			$product = array();
			$found 	= false;
			/* fetch item from database using product code */
			$statement = $mysqli_conn->prepare("SELECT p_title, p_price FROM $wizGradeProductTB WHERE pID=? LIMIT 1");
			$statement->bind_param('s', $product_code);
			$statement->execute();
			$statement->bind_result($product_name, $product_price);
	
			while($statement->fetch()){  /* loop array */

				$new_product = array( array('name'=> $product_name, 'price'=> $product_price, 'code'=>$product_code, 'qty'=>$product_qty)); 
				//prepare new product
				if(isset($_SESSION["igweze_ebele"])) {
				
            		foreach ($_SESSION["igweze_ebele"] as $cart_itm){  /* loop array */
            	 
						if($cart_itm["code"] == $product_code){ /* if item found in the list, update with new quantity */
						
							$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$product_qty, 
							'price'=> $cart_itm["price"]);
                    		$found = true;
							
						}else{ /* else continue with other items */
							
							$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=> $cart_itm["price"]);
							
						}
					}
					if(!$found){ /* we did not find item, merge new product to list */
					
						$_SESSION["igweze_ebele"] = array_merge($product, $new_product);
						
					 }else{
					 
						$_SESSION["igweze_ebele"] = $product; //create new product list
					}
				
				}else{ /* if there's no session variable, create new */
					$_SESSION["igweze_ebele"] = $new_product;
					//die(json_encode(array('items'=>1)));
				}
			}
	
			echo '<i class="fa fa-shopping-cart" style="color:#000;"></i>';
			echo ' <span class="badge bg-warning"> '; 
			echo $total_items = count($_SESSION["igweze_ebele"]); 
			echo ' </span>';
			
			$msg_s = "Product Item was successfully save"; 
			echo $succesMsg.$msg_s.$sEnd;
		
			//count items in variable
			//die(json_encode(array('items'=>$total_items))); //exit script outputing json data
	
$script =<<<IGWEZE

						<script>  $("#product-btn-$product_code").fadeIn(300);  </script>
		
IGWEZE;
			echo $script;

		
	
		}
		
		if(isset($_REQUEST["cartData"]) == "emptyCart"){  /* emty shopping cart */ 				
			
			echo '<i class="fa fa-shopping-cart" style="color:#000;"></i>';
			echo ' <span class="badge bg-warning"> 0 </span>'; 
			
		}
