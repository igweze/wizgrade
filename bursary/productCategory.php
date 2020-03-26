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
	This script handle product category
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */
		         
			if ($_REQUEST['productCategoryData'] == 'productCategoryConfigs') {  /* save product category */

				
				$productCategory = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['product']);
				
				$regDate = strtotime(date("Y-m-d H:i:s"));
				
				/* script validation */ 
				
				if ($productCategory == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter new product category name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* insert information */      			


		 			try {
						
						
						$ebele_mark = "INSERT INTO $productCategoryTB  (product)

								VALUES (:product)";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':product', $productCategory); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "<strong>$productCategory</strong> product was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewProductCategory').load('productCategoryInfo.php'); 
							$('#frmsaveProductCategory')[0].reset();  $('#saveLoader').fadeOut(1500);  
							$('.alert').fadeOut(18000); </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to add new product category. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
							
						}
						
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}          		
        	
				}
			
			}elseif ($_REQUEST['productCategoryData'] == 'updateProductCategory') {  /* update product category */

				
				$productCategory = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['product']);
				$pID = preg_replace("/[^0-9]/", "", $_REQUEST['pID']);			
				
				/* script validation */ 
				
				if ($pID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to save product category information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($productCategory == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter new product category name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* update information */    

		 			try { 
						
						$ebele_mark = "UPDATE $productCategoryTB
										
										SET 
										
											product = :product
											
											WHERE p_id = :p_id";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':product', $productCategory);
						$igweze_prep->bindValue(':p_id', $pID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */ 
							
							$msg_s = "<strong>$productCategory</strong> was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewProductCategory').load('productCategoryInfo.php'); 
							   $('#editLoader').fadeOut(1500);  $('#editProductCategoryDiv').slideUp(1500);
							</script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to save product category. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
							
						}

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['productCategoryData'] == 'removeProductCategory') {  /* remove product category */

				
				$productCategoryData = $_REQUEST['rData'];
				
				list($wizGradeIg, $pID, $hName) = explode("-", $productCategoryData);			
				
				/* script validation */ 
				
				if (($productCategoryData == "")  || ($pID == "")){
         			
					$msg_e = "* Ooooooooops, an error has occur while to remove product category. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}else {   /* update information */     			


		 			try {
						
						
						$ebele_mark = "UPDATE $productCategoryTB
										
										SET 										
											status = :status
											
											WHERE p_id = :p_id";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':status', $i_false);
						$igweze_prep->bindValue(':p_id', $pID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$pID."').fadeOut(1000);";
							$msg_s = "<strong>$hName</strong> was successfully Disenable"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'>   
							$('#removeLoader').fadeOut(1500); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to remove product category. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
							
						}

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['productCategoryData'] == 'editProductCategory') {  /* edit product category */

				
				$pID = strip_tags( $_REQUEST['rData']);
				
				/* script validation */ 
				
				if ($pID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve product category information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {   /* select information */     			


		 			try {
						
						
						$productCategoryInfoArr = productCategoryInfo($conn, $pID);  /* school products category information */
						$productCategory = $productCategoryInfoArr[$fiVal]['product'];
						$amount = $productCategoryInfoArr[$fiVal]['amount'];
						$status = $productCategoryInfoArr[$fiVal]['status'];


$productCategoryFrm =<<<IGWEZE
        
							<!-- form -->
							<form class="form-horizontal" id="frmupdateProductCategory" role="form"> 
							
									  <div class="form-group">
                                          <label for="productCategory" class="col-lg-5 control-label">*
                                           Product Category </label>
                                          <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-money"></i>
                                              <input type="text"  id="product" name="product"  class="form-control"  value="$productCategory"
											  required style="text-transform:Capitalize;">
                                          </div>
                                          </div>
                                      </div>   
                                      
                                      <div class="form-group">
                                      	  <input type="hidden" name="productCategoryData" value="updateProductCategory" />
										  <input type="hidden" name="pID" value="$pID" />		
	
                                          <center><button type="submit" class="btn btn-danger buttonMargin" id="updateProductCategory">
                                          <i class="fa fa-save"></i> Update </button></center>
                                          
									  </div>
                                      
                            </form> 
							<!-- / form -->
		
IGWEZE;
                               
		                  	echo $productCategoryFrm;														
								
								
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