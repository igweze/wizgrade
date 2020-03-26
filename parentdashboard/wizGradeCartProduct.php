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
	This script loads shopping cart products
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */ 

		if ($shopData == 'sProduct') {  /* load products */  
				
			try {

				$productsDataArr = productsData($conn);  /* select products array */
				$productsDataCount = count($productsDataArr); 

				if($productsDataCount >= $fiVal){  /* check array is empty */	 

					for($i = $fiVal; $i <= $productsDataCount; $i++){  /* loop array */	

						$productID = $productsDataArr[$i]["pID"];
						$cat_id = $productsDataArr[$i]["cat_id"];
						$price = $productsDataArr[$i]["p_price"];
						$p_title = htmlspecialchars_decode($productsDataArr[$i]["p_title"]);
						$p_description = htmlspecialchars_decode($productsDataArr[$i]["p_description"]);
						$p_status = $productsDataArr[$i]["p_status"];
						$p_date = $productsDataArr[$i]["p_date"];
						
						$productCategoryInfoArr = productCategoryInfo($conn, $cat_id);  /* select products category information */
						$productCategory = $productCategoryInfoArr[$fiVal]['product'];
						
						$productID = trim($productID);
						
						$pStatus = $productStatusArr[$p_status];								
						
						$p_date = date("j M Y", strtotime($p_date));
						
						$price = wizGradeCurrency($price, $curSymbol);  /* school currency information*/
						
						$productID = trim($productID);
						
						$pictureArr = productPictureArr($conn, $productID);  /* select products picture array */
						$pVal = array_rand($pictureArr);	
						$pic = $pictureArr[$pVal]['picture'];									
						
						$picture = $wizGradeProductDir.$pic;
						
						if ((is_null($pic)) || !file_exists($picture)){ $picture = $defaultShopPic; }  /* check if picture exists */
									
									
									
$proCatTop =<<<IGWEZE
        
						<div class="col-md-4" >
						<section class="panel" style="border: 1px solid #FFE4C4 !important;border-radius: 15px; -webkit-border-radius: 15px">
						<div class="pro-img-box">

						<img src="$picture" width="240" height="222" class="viewProduct" id="osinachi-$productID"
						alt = "Product Picture" /> 
						<a href="javascript:;" class="adtocart viewProduct" id="nkiruka-$productID">
						<i class="fa fa-cart-plus"></i>
						</a>
						</div>

						<div class="panel-body text-center">
						<h4>
						<a href="javascript:;" class="pro-title viewProduct" id="njideka-$productID">
						$p_title
						</a>
						</h4>
						<p class="price">$price</p>

						<div class="add-to-cart"> 

							<select class="p-qty col-lg-4"  
							style="float:left; margin-left: 5px; margin-right:5px;
							height:35px !important;color:#000; border-radius:5px; border: 1px solid #ccc;
							box-shadow: none;
							background: transparent;
							background-image: none;
							-webkit-appearance: none;">

															
															
						
IGWEZE;
                               
		                  	echo $proCatTop;
								
								
							for($qtyVal = $fiVal; $qtyVal <= $tenVal; $qtyVal++){  /* loop array */	 
							
								if ($qtyV == $qtyVal){
									$selected = "SELECTED";
								} else {
									$selected = "";
								}

								echo '<option value="'.$qtyVal.'"'.$selected.'>'.$qtyVal.'</option>' ."\r\n"; 
							
							}								
								

$proCatBot =<<<IGWEZE

 
								</select> 				
															
								<input class="p-code" type="hidden" value="$productID"> 
								
								<button class="btn btn-danger button" type="button"
								type="submit"  id="product-btn-$productID" title="Update Cart">
								 Add to Cart</button>
											
                
									</div>
											
                                  </div>
                              </section>
							</div>		
IGWEZE;
                               
		                  	echo $proCatBot; 
								
						
					}
					
				}else{  /* display information message */  	
							
					$msg_i = "* Oooooooops, school product is emtpy";
					echo $infoMsg.$msg_i.$iEnd; 

				}	
								
			}catch(PDOException $e) {
						
				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
						 
			} 	 
					 	
			echo "<script type='text/javascript'>  $('#mallLoader').fadeOut(3000); hidePageLoader();  /* hide page loader */ </script>";

		}elseif ($_REQUEST['shopData'] == 'vCategory') {  /* load product category */  
				
				$catID = strip_tags($_REQUEST['catID']); 
				
				/* script validation */ 
				
				if ($catID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve product category information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else{  /* select information */
				
					try {
					 
							$productCategoryArr = productCategory($conn, $catID);  /* school products category information*/
							$productCategoryCount = count($productCategoryArr); 
		
							if($productCategoryCount >= $fiVal){  /* check array is empty */ 
								
								for($i = $fiVal; $i <= $productCategoryCount; $i++){  /* loop array */	
								
									$productID = $productCategoryArr[$i]["pID"];
									$cat_id = $productCategoryArr[$i]["cat_id"];
									$price = $productCategoryArr[$i]["p_price"];
									$p_title = htmlspecialchars_decode($productCategoryArr[$i]["p_title"]);
									$p_description = htmlspecialchars_decode($productCategoryArr[$i]["p_description"]);
									$p_status = $productCategoryArr[$i]["p_status"];
									$p_date = $productCategoryArr[$i]["p_date"];
									
									$productCategoryInfoArr = productCategoryInfo($conn, $cat_id);  /* school products category information */
									$productCategory = $productCategoryInfoArr[$fiVal]['product'];
									$productID = trim($productID);
									
									$pictureArr = productPictureArr($conn, $productID);  /* school products pictures */
									$pVal = array_rand($pictureArr);	
									$pic = $pictureArr[$pVal]['picture'];									
									
									
									$pStatus = $productStatusArr[$p_status];								
									
									$p_date = date("j M Y", strtotime($p_date));
									
									$price = wizGradeCurrency($price, $curSymbol);  /* school currency information*/
									
									$picture = $wizGradeProductDir.$pic;
									
									if ((is_null($pic)) || !file_exists($picture)){ $picture = $defaultShopPic; }  /* check if picture exists */ 
									
									
$proCatTop =<<<IGWEZE
        
									<div class="col-md-4">
									<section class="panel" style="border: 1px solid #FFE4C4 !important;border-radius: 15px; -webkit-border-radius: 15px">
									<div class="pro-img-box">

									<img src="$picture" width="240" height="222" class="viewProduct" id="osinachi-$productID"
									alt = "Product Picture" /> 
									<a href="javascript:;" class="adtocart viewProduct" id="nkiruka-$productID">
									<i class="fa fa-shopping-cart"></i>
									</a>
									</div>

									<div class="panel-body text-center">
									<h4>
									<a href="javascript:;" class="pro-title viewProduct" id="njideka-$productID">
									$p_title
									</a>
									</h4>
									<p class="price">$price</p>

									<div class="add-to-cart"> 

										<select class="p-qty col-lg-4"  
										style="float:left; margin-left: 5px; margin-right:5px;
										height:35px !important;color:#000; border-radius:5px; border: 1px solid #ccc;
										box-shadow: none;
										background: transparent;
										background-image: none;
										-webkit-appearance: none;"> 
						
IGWEZE;
                               
									echo $proCatTop;
								
								
									for($qtyVal = $fiVal; $qtyVal <= $tenVal; $qtyVal++){  /* loop array */	 
								
										if ($qtyV == $qtyVal){
											$selected = "SELECTED";
										} else {
											$selected = "";
										}

										echo '<option value="'.$qtyVal.'"'.$selected.'>'.$qtyVal.'</option>' ."\r\n";
								
									}								
								

$proCatBot =<<<IGWEZE

									</select> 
								
									<input class="p-code" type="hidden" value="$productID"> 
									
									<button class="btn   btn-danger button" type="button"
									type="submit"  id="product-btn-$productID" title="Update Cart">
									  Add to Cart</button> 

									</div>

									</div>
									</section>
								</div>		
IGWEZE;
                               
		                  		echo $proCatBot; 
								
								}
						
						}else{  /* display information message */ 
							
							$msg_i = "* Oooooooops, school product category is emtpy";
							echo $infoMsg.$msg_i.$iEnd;  
						
						}
						
					}catch(PDOException $e) {
						
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
						 
					}	 

				}
				
				echo "<script type='text/javascript'>  $('#mallLoader').fadeOut(3000); </script>";

		}elseif ($_REQUEST['shopData'] == 'vProduct') {  /* load a product details */  

				
				$pID = strip_tags($_REQUEST['pID']);
				$qtyV = strip_tags($_REQUEST['qtyV']);
				
				if($_REQUEST['eProduct'] == true){ $stopLoader = " hidePageLoader();  /* hide page loader */ "; $lableBtn = "Update Cart";}
				else {$stopLoader  = ""; $lableBtn = "Add to Cart"; }
				
				/* script validation */ 
				
				if ($pID == ""){
         			
					$msg_e = "* Oooooooops error, could not retrieve product information";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>  $stopLoader  $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else{  /* select information */
				
					try {
					 
						$productsInfoArr = productsInfo($conn, $pID);  /* school products information*/
						$productID = $productsInfoArr[$fiVal]["pID"];
						$proID = $productsInfoArr[$fiVal]["cat_id"];
						$p_price = $productsInfoArr[$fiVal]["p_price"];
						$p_title = htmlspecialchars_decode($productsInfoArr[$fiVal]["p_title"]);
						$p_description = htmlspecialchars_decode($productsInfoArr[$fiVal]["p_description"]);
						$p_status = $productsInfoArr[$fiVal]["p_status"];
						$p_date = $productsInfoArr[$fiVal]["p_date"];
						
						$productID = trim($productID);									
							
						$productCategoryInfoArr = productCategoryInfo($conn, $proID);  /* school products category information */
						$productCategory = $productCategoryInfoArr[$fiVal]['product'];
															
						$pStatus = $productStatusArr[$p_status];		
						$p_date = date("j F Y", strtotime($p_date));									
						$price = wizGradeCurrency($p_price, $curSymbol);  /* school currency information*/									
						$p_description = nl2br($p_description);
						
						$pictureArr = productPictureArr($conn, $productID);  /* school products pictures */
						$pictureCount = count($pictureArr); 
						
						$rand_keys = array_rand($pictureArr, $pictureCount);
						$fiPic = $pictureArr[$rand_keys[0]]['picture']; 
						
						$sePic = $pictureArr[$rand_keys[1]]['picture']; 
						$thPic = $pictureArr[$rand_keys[2]]['picture']; 
						$foPic = $pictureArr[$rand_keys[3]]['picture']; 
						$fifPic = $pictureArr[$rand_keys[4]['picture']];  
						
						$fiPicture = $wizGradeProductDir.$fiPic;
						$sePicture = $wizGradeProductDir.$sePic;
						$thPicture = $wizGradeProductDir.$thPic;
						$foPicture = $wizGradeProductDir.$foPic;
						$fifPicture = $wizGradeProductDir.$fifPic;
						
						if ((is_null($fiPic)) || !file_exists($fiPicture )){ $fiPicture  = $defaultShopPic; }  /* check if picture exists */
						if ((is_null($sePic)) || !file_exists($sePicture )){ $sePicture  = $defaultShopPic; }  /* check if picture exists */
						if ((is_null($thPic)) || !file_exists($thPicture )){ $thPicture  = $defaultShopPic; }  /* check if picture exists */
						if ((is_null($foPic)) || !file_exists($foPicture )){ $foPicture  = $defaultShopPic; }  /* check if picture exists */
						if ((is_null($fifPic)) || !file_exists($fifPicture )){ $fifPicture  = $defaultShopPic; }  /* check if picture exists */ 
									
									
$productInfoTop =<<<IGWEZE

						<section class="panel">
							<div class="panel-body" >
								<div class="col-md-6">
									<div class="pro-img-details" id="englargeProPic">									  
										<span id="englargeProPic">	
										<img src="$fiPicture" alt="product picture" height="372" width="370">
										</span>
									  
										<center><span class="display-none loadingEnPic">
										<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></span></center>									  
									</div>
								  
									<div class="pro-img-list">
								  
										<a href="javascript:;">
											<img src="$fiPicture" alt="product picture" height="72" width="72" class="enlargePic" id="fi-$fiPicture">
										</a>
										<a href="javascript:;">
											<img src="$sePicture" alt="product picture" height="72" width="72" class="enlargePic" id="se-$sePicture">
										</a>
										<a href="javascript:;">
											<img src="$thPicture" alt="product picture" height="72" width="72" class="enlargePic" id="th-$thPicture">
										</a>
										<a href="javascript:;">
											<img src="$foPicture" alt="product picture" height="72" width="72" class="enlargePic" id="fo-$foPicture">
										</a>
										<a href="javascript:;">
											<img src="$fifPicture" alt="product picture" height="72" width="72" class="enlargePic" id="fif-$fifPicture">
										</a>
									</div>
								</div>
							  
							  
								<div class="col-md-6">
									<h4 class="pro-d-title">
										<a href="javascript:;" class="">
                                          $p_title
										</a>
									</h4>
									<p>
										$p_description
									</p>
									<div class="product_meta">
										<span class="posted_in"> <strong>Categories:</strong> <a rel="tag" href="javascript:;">$productCategory</a></span>                                      
									</div> 
								  
									<div class="m-bot15"> <strong>Price : </strong>  <span class="pro-price">$price </span></div>
								  
										<div class="add-to-cart"> 

										<select class="p-qty col-lg-4"  
										style="float:left; margin-left: 5px; margin-right:5px;
										height:35px !important;color:#000; border-radius:5px; border: 1px solid #ccc;
										box-shadow: none;
										background: transparent;
										background-image: none;
										-webkit-appearance: none;"> 
						
IGWEZE;
                               
										echo $productInfoTop;
								
								
										for($qtyVal = $fiVal; $qtyVal <= $tenVal; $qtyVal++){  /* loop array */								
								
											if ($qtyV == $qtyVal){
												
												$selected = "SELECTED"; 
												
											} else {
												$selected = "";
											}

											echo '<option value="'.$qtyVal.'"'.$selected.'>'.$qtyVal.'</option>' ."\r\n"; 
								
										}
								

$productInfoBot =<<<IGWEZE

										</select> 	
														
										<input class="p-code" type="hidden" value="$productID"> 
									
										<button class="btn   btn-danger button" type="button"
										type="submit"  id="product-btn-$productID" title="Update Cart">
										$lableBtn </button> 
                
									</div> 
								</div>
							</div>
						</section>

						<section class="panel">
							<header class="panel-heading tab-bg-dark-navy-blue">
								<ul class="nav nav-tabs ">
									<li class="active">
										<a data-toggle="tab" href="#description">
                                          Description
										</a>
									</li>
									<li>
										<a data-toggle="tab" href="#reviews">
                                          Reviews
										</a>
									</li>

								</ul>
							</header>
							<div class="panel-body">
								<div class="tab-content tasi-tab">
									<div id="description" class="tab-pane active">
										<h4 class="pro-d-head">Product Description</h4>
										<p>$p_description</p>
                                  
									</div>
									<div id="reviews" class="tab-pane">
										<article class="media">
											<a class="pull-left thumb p-thumb enlargePic">
                                              <img src="$defaultShopPic">
											</a>
											<div class="media-body">
												<a href="javascript:;" class="cmt-head">Coming Soon.</a>
												<p> <i class="fa fa-time"></i> 1 hours ago</p>
											</div>
										</article> 
									</div>
								</div>
							</div>
							</section>        
						
IGWEZE;
                               
							echo $productInfoBot; 
						
						
					}catch(PDOException $e) {
						
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
						 
					}	 
						 

				} 
				
				echo "<script type='text/javascript'>  $stopLoader  $('#mallLoader').fadeOut(3000); </script>";

		}else{			
			
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */

		}	
		
exit;	
?>	