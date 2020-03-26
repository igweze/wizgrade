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
	This script handle school product information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */
		         
			if ($_REQUEST['productsData'] == 'saveProduct') {  /* save product */

				
				$proID = preg_replace("/[^0-9-]/", "", $_REQUEST['cat_id']);
				$p_title =  strip_tags($_REQUEST['title']);
				$p_description = $_REQUEST['p_description'];
				$p_price = strip_tags($_REQUEST['p_price']);
				$p_status = preg_replace("/[^0-9]/", "", $_REQUEST['p_status']);
				$pDay = $_REQUEST['pDay'];
				
				/* script validation */
				
				if ($proID == "")  {
         			
					$msg_e = "* Oooooooops Error, please select product category";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($p_title == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter product title";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($p_price == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter product price";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($p_description == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter product details";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($p_status == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a product status";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($pDay == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a product date";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* insert information */   
					
						$p_description = strip_tags($p_description);
						$p_title = strip_tags($p_title);
						$p_description = str_replace('<br />', "\n", $p_description);
						$p_description = htmlspecialchars($p_description);
						$p_title = htmlspecialchars($p_title);


		 			try {
						
						
						$ebele_mark = "INSERT INTO $wizGradeProductTB  (cat_id, p_price, p_title, p_status, p_description, p_date)

								VALUES (:cat_id, :p_price, :p_title, :p_status, :p_description, :p_date)";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':cat_id', $proID);
						$igweze_prep->bindValue(':p_price', $p_price);
						$igweze_prep->bindValue(':p_title', $p_title);
						$igweze_prep->bindValue(':p_status', $p_status);
						$igweze_prep->bindValue(':p_description', $p_description);
						$igweze_prep->bindValue(':p_date', $pDay); 
						
						if($igweze_prep->execute()){ 

							$productID = $conn->lastInsertId($wizGradeProductTB); 
				
$uploadManager =<<<IGWEZE

							<!-- form -->
							<form class="form-horizontal" id="frmproductPic" role="form"  enctype="multipart/form-data" 
                              action="wizGradeProducts.php">
							  
									<div class="form-group" >
                                      <label for="title" class="col-lg-4 col-sm-4 control-label"> Product Title</label>
                                      
                                      <div class="col-lg-8">
                                        
                                            <div class="iconic-input">
                                                  <i class="fa fa-comment"></i>
                                                  
                                            <input type="text" class="form-control" value="$p_title" 
                                            name="title"  id="title" disabled>
                                            
                                            </div>
											
                                          </div>
                                    </div>   
							
									<div class="form-group">
                                          <label class="control-label col-md-4">Upload Product Pictures</label>
										  <input type="hidden" name="productID" value="$productID">
                                          <div class="controls col-md-8">
                                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <span class="btn btn-white btn-file">
                                                <span class="fileupload-new productPicBtn"><i class="fa fa-paper-clip"></i> Select file</span>
                                                <span class="fileupload-exists productPicBtn"><i class="fa fa-undo"></i> Change</span>
                                                <input type="file" class="default" name="productPic" id="productPic" />
												
                                                </span>
                                                  <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                  <a href="javascript:;" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                              </div>
											  <span class="label label-danger">NOTE!</span>
                                             <span style="color:#ff0000">Only max image size of 2MB &amp; format of 
                                             jpg, jpeg, JPG, JPEG, png, and PNG is allowed. 
                                             </span>
                                          </div><input type="hidden" name="productsData" value="uploadPicture" />
                                    </div>
							
									     
							</form>
							
							<!-- form -->
		
IGWEZE;
				
 	
							$msg_s = "Your product was successfully saved. Please upload product pictures below"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo $uploadManager;
							echo "<script type='text/javascript'> $('#viewProducts').load('wizGradeProductsInfo.php'); 
							$('#frmsaveProducts')[0].reset(); $('#frmsaveProducts').fadeOut(1500);  $('#saveLoader').fadeOut(1500);  
							$('.alert').fadeOut(10000); </script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to save product. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
        	
				}
			
			}elseif ($_REQUEST['productsData'] == 'updateProducts') {  /* update product */

				$pID = preg_replace("/[^0-9]/", "", $_REQUEST['pID']);			
				$proID = preg_replace("/[^0-9-]/", "", $_REQUEST['cat_id']);
				$p_title =  strip_tags($_REQUEST['title']);
				$p_description = $_REQUEST['p_description'];
				$p_price = strip_tags($_REQUEST['p_price']);
				$p_status = preg_replace("/[^0-9]/", "", $_REQUEST['p_status']);
				$pDay = $_REQUEST['pDay'];
				
				/* script validation */ 
				
				if ($pID == ""){
         			
					$msg_e = "* Ooooooooops, aan error has occur to retrieve product information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($proID == "")  {
         			
					$msg_e = "* Oooooooops Error, please select product category";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($p_title == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter product title";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($p_price == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter product price";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($p_description == "")  {
         			
					$msg_e = "* Oooooooops Error, please select product details";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($p_status == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a product status";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($pDay == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a product p_date";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* update information */  
					
					$p_description = strip_tags($p_description);
					$p_title = strip_tags($p_title);
					$p_description = str_replace('<br />', "\n", $p_description);
					$p_description = htmlspecialchars($p_description);
					$p_title = htmlspecialchars($p_title); 

		 			try {						
						
						$ebele_mark = "UPDATE $wizGradeProductTB  
											
											SET 
											
											cat_id = :cat_id, 
											p_price = :p_price, 
											p_title = :p_title,
											p_status = :p_status,		
											p_description = :p_description,
											p_date = :p_date
											
										WHERE pID = :pID";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':pID', $pID);
						$igweze_prep->bindValue(':cat_id', $proID);
						$igweze_prep->bindValue(':p_price', $p_price);
						$igweze_prep->bindValue(':p_title', $p_title);
						$igweze_prep->bindValue(':p_status', $p_status);
						$igweze_prep->bindValue(':p_description', $p_description);
						$igweze_prep->bindValue(':p_date', $pDay); 
						
						if($igweze_prep->execute()){  /* if sucessfully */ 
							
							$msg_s = "School Product was successfully saved."; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewProducts').load('wizGradeProductsInfo.php'); 
							   $('#editLoader').fadeOut(1500);  $('#editProductsDiv').slideUp(1500);
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save product. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['productsData'] == 'removeProducts') {  /* remove product */

				
				$productsData = $_REQUEST['rData'];
				
				list($wizGradeIg, $pID, $hName) = explode("-", $productsData);			
				
				/* script validation */ 
				
				if (($productsData == "")  || ($pID == "")){
         			
					$msg_e = "* Ooooooooops, an error has occur while to remove product information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* remove information */      			


		 			try { 
						
						$ebele_mark = "DELETE FROM 
						
										$wizGradeProductTB										
											
										WHERE pID = :pID
											
										LIMIT 1";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':pID', $pID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$pID."').fadeOut(1000);";
							$msg_s = "<strong>$hName</strong> was successfully removed"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'>   
							$('#removeLoader').fadeOut(1500); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to remove product information. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
							
						}

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['productsData'] == 'viewProducts') {  /* view product */
				
				$pID = strip_tags($_REQUEST['rData']);
				
				/* script validation */
				
				if ($pID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve product information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       			


		 			try {						
						
						$productsInfoArr = productsInfo($conn, $pID);  /* school products information*/
						$productID = $productsInfoArr[$fiVal]["pID"];
						$proID = $productsInfoArr[$fiVal]["cat_id"];
						$p_price = $productsInfoArr[$fiVal]["p_price"];
						$p_title = htmlspecialchars_decode($productsInfoArr[$fiVal]["p_title"]);
						$p_description = htmlspecialchars_decode($productsInfoArr[$fiVal]["p_description"]);
						$p_status = $productsInfoArr[$fiVal]["p_status"];
						$p_date = $productsInfoArr[$fiVal]["p_date"];						
								
						$productCategoryInfoArr = productCategoryInfo($conn, $proID);  /* school products category information */
						$productCategory = $productCategoryInfoArr[$fiVal]['product'];						
						
						$pStatus = $productStatusArr[$p_status];						
						
						$p_date = date("j F Y", strtotime($p_date));						
						$price = wizGradeCurrency($p_price, $curSymbol);  /* school currency information*/						
						$p_description = nl2br($p_description);
									

$showProduct =<<<IGWEZE
		
						<button  class="btn btn-white printer-icon pull-right">
						<i class="fa fa-print text-info"></i> Print </button><br clear="all"/><br clear="all"/>

						<div id = 'wizGradePrintArea'> 
						
							<!-- table -->
							
							<table width = '100%' class="table table-striped  table-advance table-hover">

							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-sort-alpha-asc"></i> Product Category </td> <td style="padding-left: 30px;
							text-align:left; width: 60%;">
							$productCategory
							</td> </tr>

							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-comment"></i> Product Title </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$p_title  </td> </tr>

							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-money"></i> Product Price</td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$price</td> </tr>

							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-address-book"></i> Product Details </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$p_description</td> </tr>

							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-calendar-check-o"></i> Product Date </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$p_date</td> </tr>

							<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
							<i class="fa fa-exchange"></i> Product Status </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
							$pStatus</td> </tr>

							<tr><th style="text-align:center; width: 100%;" colspan="2">
							<i class="fa fa-picture-o"></i> Product Picture/s </td>  </tr> 
							
							</table>
							<!-- table -->

						</div>
		
		
		
IGWEZE;
				
						echo $showProduct;
									
						/* select product picture */
						  
						$ebele_mark = "SELECT pic_id, picture
						
										FROM $wizGradeProductPicTB
										
										WHERE p_id = :p_id";
							 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':p_id', $productID);				 
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count >= $fiVal) {  /* check result is empty */
							
							echo '<div style="width:600px">';
						
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */	
			   
								$picID = $row['pic_id'];
								$picture = $row['picture'];
								
								echo "<div id = 'picDiv_".$picID."' style=' cursor:pointer;height:150px; width:150px;float:left; 
								margin:10px;' >

								<img src="."'".$wizGradeProductDir.$picture."'  
								style='float:left;' class='preview' height = '140' width='140'> </div>";
								
							} 
							
						} 	
										
						echo '</div> </div>'; 
						
						echo "<script type='text/javascript'>  $('#editLoader').fadeOut(3000); </script>"; exit; 
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
         		
        	
				}
			
			}elseif ($_REQUEST['productsData'] == 'uploadPicture') {  /* upload product picture */				
				
				$productID = $_REQUEST['productID'];
				$time = strtotime(date("Y-m-d H:i:s"));

				$picturePath = $wizGradeProductDir; /* picture path */
				
				$filePic = "productPic"; /* picture file name */
				$pageDesc = "your product picture";
				
				/* call igweze file uploader */
				$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 2), $validPicExt, 
				$validPicType, $allowedPicExt, $fileType = "Picture", $fiVal);
				 
				if (is_array($uploadPicData['error'])) {  /* check if any upload error */
					 
					$msg_e = '';
					  
					foreach ($uploadPicData['error'] as $msg) {
						$msg_e .= $msg.'<br />';     /* display error messages */
					}
					echo "<img src=''   height = '1' width='1'> ";
					echo $errorMsg.$msg_e.$eEnd; exit;
				  
				  
				} else {
					
					$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
					
					if ($uploadedPic != "") {
							
						if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
								
								
							try { 

								$ebele_mark = "INSERT INTO $wizGradeProductPicTB(p_id, picture)

                                   							VALUES (:p_id, :picture)";

		        				$igweze_prep = $conn->prepare($ebele_mark);
								$igweze_prep->bindValue(':p_id', $productID);
								$igweze_prep->bindValue(':picture', $uploadedPic);	 
									
								if ($igweze_prep->execute()) {  /* if sucessfully */

									$uploadedPicID = $conn->lastInsertId($wizGradeProductPicTB); 
									echo "<img src=''   height = '1' width='1'> ";
									echo "<div id = 'picDiv_".$uploadedPicID."' style='cursor:pointer;height:150px; width:150px; float:left; 
									margin:10px;'>
									<span class = 'remProductPic' style='position: relative; top: -3px;left:0px; float:right; cursor:pointer;' 
									id = 'wizGrade-".$uploadedPicID."'><i class='fa  fa-times'></i> </span>
									<img src='".$wizGradeProductDir.$uploadedPic."'  
									style='float:left;' class='preview' height = '140' width='140'> </div>";	
							
									$msg_s = "Picture was successfully Uploaded.."; 
									echo $succesMsg.$msg_s.$sEnd; exit;
										
								}else{  /* display error */
					
									echo "<img src=''   height = '1' width='1'> ";
									$msg_e = "Ooooooooooops, product picture was not successfully uploaded. Please try again";
									echo $errorMsg.$msg_e.$eEnd; 
									echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit; 
					
								}	 

							}catch(PDOException $e) {

									wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

							}
							  
							  
						}else{ /* display error messages */
								
								echo "<img src=''   height = '1' width='1'> ";
								$msg_e = "Ooooooooooops, an error has occur while trying to save $pageDesc.
								Please try again or check your network connection!!!";
								echo $errorMsg.$msg_e.$eEnd; exit;

							  
						}
							
					}else{ /* display error messages */
						
							echo "<img src=''   height = '1' width='1'> ";
							$msg_e = "Ooooooooooops, an error has occur while trying to save $pageDesc.
							Please try again or check your network connection!!!";
							echo $errorMsg.$msg_e.$eEnd; exit;							

					}	
					
					
				} 	  
				
				echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;	 			
			
			}elseif ($_REQUEST['productsData'] == 'removePic') {  /* remove product picture */
				
				
				$pictureID = preg_replace("/[^0-9-]/", "", $_REQUEST['pictureID']);
				$pictureID = trim($pictureID);
				
				/* script validation */
				
				if ($pictureID == "")  {
         			
					$msg_e = "* Oooooooops Error, could not retrieve picture infomation. Please try again.";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('.alert').fadeOut(30000); $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}else{  /* remove picture */
					
							
						$ebele_mark = "SELECT picture
						
										FROM $wizGradeProductPicTB
										
										WHERE pic_id = :pic_id";
							 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':pic_id', $pictureID);						 
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count == $fiVal) {  /* check select is empty */
										
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
			   
								$picture = $row['picture'];
							
								$picDel = $wizGradeProductDir.$picture;
												
							}
							
							$ebele_mark_1 = "DELETE
						
											FROM $wizGradeProductPicTB
											
											WHERE pic_id = :pic_id
											
												LIMIT 1";
								 
							$igweze_prep_1 = $conn->prepare($ebele_mark_1);
							$igweze_prep_1->bindValue(':pic_id', $pictureID);	 
							
							if($igweze_prep_1->execute()){  /* if sucessfully */
								
								if(file_exists($picDel)){ unlink($picDel); }								
								
								$picDiv = '#picDiv_'.$pictureID;
								$msg_s = "Picture was successfully deleted."; 
								echo $succesMsg.$msg_s.$sEnd ; 
								
								echo "<script type='text/javascript'> $('.alert').fadeOut(30000);
								$('$picDiv').fadeOut(100); $('#saveLoader').fadeOut(1500);	</script>";exit;
								
							}else{  /* display error */								
								
								$msg_e = "Ooooooooops, could not remove picture."; 
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'> $('.alert').fadeOut(30000); $('#saveLoader').fadeOut(1500); </script>";exit;								
								
							}
							
						}else{  /* display error */								
							
							$msg_e = "Ooooooooops, could not find picture."; 
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'> $('.alert').fadeOut(30000); $('#saveLoader').fadeOut(1500); </script>";exit;

						}	 
					
				}	
				 
				
			}elseif ($_REQUEST['productsData'] == 'editProducts') {  /* edit product */

				
				$pID = strip_tags($_REQUEST['rData']);
				
				/* script validation */
				
				if ($pID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve product information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       			


		 			try {
						
						
							$productsInfoArr = productsInfo($conn, $pID);  /* school products information*/
							$productID = $productsInfoArr[$fiVal]["pID"];
							$proID = $productsInfoArr[$fiVal]["cat_id"];
							$p_title = htmlspecialchars_decode($productsInfoArr[$fiVal]["p_title"]);
							$p_description = htmlspecialchars_decode($productsInfoArr[$fiVal]["p_description"]);
							$p_status = $productsInfoArr[$fiVal]["p_status"];
							$price = $productsInfoArr[$fiVal]["p_price"];
							$p_date = $productsInfoArr[$fiVal]["p_date"]; 
						
?>

							<!-- form -->
							<form class="form-horizontal" id="frmupdateProducts" role="form"> 

								<div class="form-group">
									<label for="cat_id" class="col-lg-4 col-sm-4 control-label">* Product Category</label>

									<div class="col-lg-8">
										<div class="iconic-input">
										<i class="fa fa-sort-alpha-asc"></i>

										<select class="form-control"  id="cat_id" name="cat_id" required>
											<option value = "">Please select One</option>
											<?php


												try {

													$productCategoryDataArr = productCategoryData($conn);   /* school products category array */
													$productCategoryDataCount = count($productCategoryDataArr);

												}catch(PDOException $e) {

													wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

												}		

												if($productCategoryDataCount >= $fiVal){  /* check array is empty */

													for($i = $fiVal; $i <= $productCategoryDataCount; $i++){  /* loop array */	

														$pID = $productCategoryDataArr[$i]["p_id"];
														$productCategory = $productCategoryDataArr[$i]["product"];

														$productCategory = trim($productCategory); 

														if ( $pID == $proID){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$pID.'"'.$selected.'>
														'.$productCategory.'</option>' ."\r\n";

													}
													
												}else{

													echo '<option value="">Oooooooops Error, could not find product category.</option>' ."\r\n";

												}	 

											?> 

										</select>
										</div>
									</div>
								</div>


								<div class="form-group" >
									<label for="title" class="col-lg-4 col-sm-4 control-label"> Product Title</label>

									<div class="col-lg-8">

										<div class="iconic-input">
										<i class="fa fa-comment"></i>

										<input type="text" class="form-control" placeholder="Enter Product Title" 
										name="title"  id="title" value="<?php echo $p_title; ?>">

										</div>

									</div>
								</div> 

								<div class="form-group" >
									<label for="price" class="col-lg-4 col-sm-4 control-label">* Price Paid</label>

									<div class="col-lg-8">

										<div class="iconic-input">
										<i class="fa fa-money"></i>

										<input type="number" class="form-control" placeholder="Enter Price Paid" 
										name="p_price"  id="p_price" value = "<?php echo $price; ?>" required>

										</div>

									</div>
								</div> 

								<div class="form-group">
									<label for="p_description" class="col-lg-4 col-sm-4 control-label"> * Product Details</label>

									<div class="col-lg-8">

									<textarea rows="4" cols="10" class="form-control" name="p_description" id="p_description" 
									placeholder="Product Details eg Bank Name, Teller ID, Cheque ID, Card 
									Type" required><?php echo $p_description; ?></textarea>

									</div>
								</div> 


								<div class="form-group">
									<label class="control-label col-lg-4 col-sm-4">* Product Date:</label>
									<div class="col-lg-7 col-sm-7">

										<div data-date-viewmode="years" data-date-format="yyyy-mm-dd" 
										data-date="2012-12-02"  
										class="input-append date dpYears">
										<input type="text" readonly="" 
										value="<?php echo $p_date; ?>" 
										size="10" class="form-control"  name="pDay"  required />
										<span class="input-group-btn add-on">
										<button class="btn btn-danger" type="button">
										<i class="fa fa-calendar"></i></button>
										</span>
										</div>
										<span class="help-block">Select Date</span>
										<input type="hidden" name="pID" value="<?php echo $productID; ?>" />		
									</div>
								</div>

								<!-- </div> -->

								<div class="form-group">

									<label  for="p_status" class="col-lg-4 col-sm-4 control-label">* Product Status</label>

									<div class="col-lg-8">
										<div class="iconic-input">
										<i class="fa fa-bars"></i>

										<select class="form-control"  id="p_status" name="p_status" required>

											<option value = "">Please select One</option>
											<?php 

												foreach($productStatusArr as $statusKey => $statusVal){  /* loop array */

													if ($p_status == $statusKey){

														$selected = "SELECTED";

													} else {

														$selected = "";

													}

													echo '<option value="'.$statusKey.'"'.$selected.'>'.$statusVal.'</option>' ."\r\n";

												}

											?> 

										</select> 
										</div>
									</div>
								</div>

								<div class="form-group">
									<input type="hidden" name="productsData" value="updateProducts" />
									<center><button type="submit" class="btn btn-danger buttonMargin" id="updateProducts">
									<i class="fa fa-save"></i> Update Product </button></center>
								</div> 

							</form> 
							<!-- / form --> 						
						<?php
								
								
				
$uploadManager =<<<IGWEZE

							<!-- form -->
							<form class="form-horizontal" id="frmproductPic" role="form"  enctype="multipart/form-data" 
							action="wizGradeProducts.php"> 

								<div class="form-group">
									<label class="control-label col-md-4">Upload Product Pictures</label>
									<input type="hidden" name="productID" value="$productID">
									<div class="controls col-md-8">
									<div class="fileupload fileupload-new" data-provides="fileupload">
									<span class="btn btn-white btn-file">
									<span class="fileupload-new productPicBtn"><i class="fa fa-paper-clip"></i> Select file</span>
									<span class="fileupload-exists productPicBtn"><i class="fa fa-undo"></i> Change</span>
									<input type="file" class="default" name="productPic" id="productPic" />

									</span>
									<span class="fileupload-preview" style="margin-left:5px;"></span>
									<a href="javascript:;" class="close fileupload-exists" data-dismiss="fileupload" 
									style="float: none; margin-left:5px;"></a>
									</div>
									<span class="label label-danger">NOTE!</span>
									<span style="color:#ff0000">Only max image size of 2MB &amp; format of 
									jpg, jpeg, JPG, JPEG, png, and PNG is allowed. 
									</span>
									</div><input type="hidden" name="productsData" value="uploadPicture" />
								</div> 

							</form>
							<!-- / form -->
		
IGWEZE;


							echo  $uploadManager;
							
							$ebele_mark = "SELECT pic_id, picture
							
											FROM $wizGradeProductPicTB
											
											WHERE p_id = :p_id";
								 
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':p_id', $productID);				 
							$igweze_prep->execute();
							
							$rows_count = $igweze_prep->rowCount(); 
							
							if($rows_count >= $fiVal) {  /* check select is empty */
							
								while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
				   
									$picID = $row['pic_id'];
									$picture = $row['picture'];
									
									echo "<div id = 'picDiv_".$picID."' style=' cursor:pointer;height:150px; width:150px;float:left; 
									margin:10px;' >
									<span class = 'remProductPic' style='position: relative; top: -3px;left:0px; 
									float:right; cursor:pointer;' 
									id= 'wizGrade-".$picID."'><i class='fa  fa-times'></i>
									</span>
									<img src="."'".$wizGradeProductDir.$picture."'  
									style='float:left;' class='preview' height = '140' width='140'> </div>";	 
								
								}
																
							}	
							
							echo '<center><img src="'.$wizGradeTemplate.'images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="saveLoader"  
							style="cursor:pointer; display:none; margin-bottom:5px;" /></center>
							<div style="width:600px">
							<div id="msgBoxPic"></div>
							</div>';

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