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
	This script load product information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 
		 
		try {
		 
			$productCategoryDataArr = productCategoryData($conn);   /* school products category array */
			$productCategoryDataCount = count($productCategoryDataArr);
				
		}catch(PDOException $e) {
  			
			wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		}		
		 
?>            
			  	
				<!-- page start--> 
			  
				<div class="row col-lg-12">
			  
					<section class="panel">
                          <header class="panel-heading">
                             <i class="fa fa-shopping-cart fa-lg"></i> School Shop Manager
							 <span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
                          <div class="panel-body wizGrade-linea">
						  
							<div class="col-lg-3">
							 
							  <section class="panel">
								  <header class="panel-heading">
									 <i class="fa fa-bars fa-lg"></i> Category
								  </header>
								  <div class="panel-body wizGrade-line">
									  <ul class="nav prod-cat">


<?php
						
							if($productCategoryDataCount >= $fiVal){  /* check array is empty */	 
								
								for($i = $fiVal; $i <= $productCategoryDataCount; $i++){  /* loop array */	
								
									$pID = $productCategoryDataArr[$i]["p_id"];
									$productCategory = $productCategoryDataArr[$i]["product"];
									
									$productCategory = trim($productCategory);

$proCat =<<<IGWEZE
        
									<li ><a href='javascript:;' class='shopCategory' id='wizGrade-$pID'>
									<i class=" fa fa-cart-plus"></i> $productCategory </a></li>
		
IGWEZE;
                               
									echo $proCat;
								
								}
						
							}else{  /* display information message */
							
								$msg_i = "* Oooooooops, this category is emtpy";
								echo $infoMsg.$msg_i.$iEnd;  
						
							}	 
								
?>							  
                                     
									</ul>
								</div>
							</section>
						</div> 
                  
						<div class="col-lg-9 shoppingTarget">
				  
							<section class="panel">
								<header class="panel-heading">
									<i class="fa fa-cart-plus fa-lg"></i> Shopping Cart
								</header>
								<div class="panel-body wizGrade-line">
				  
				  
									<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="mallLoader"  
									style="cursor:pointer; display:none; margin-bottom:5px;" /></center>
									<!-- row -->
									<div class="row product-list">
					  
										<div id="sMallDiv">
									  
										<?php
										
											if (($_REQUEST['shopData'] == 'vProduct') && ($_REQUEST['pID'] >= $fiVal)){
													
												require_once 'wizGradeCartProduct.php';   /* include cart product script */								
												
											}elseif ($_REQUEST['shopData'] == 'cOut'){   /* include product checkout script */
													
												require_once 'wizGradeCheckOut.php';								
												
											}else{	
											
												$shopData = 'sProduct';
												require_once 'wizGradeCartProduct.php';	   /* include cart product script */					
											
											}
								
										?> 
										  
										</div>
                      
									</div>
									<!-- / row --> 
					  
								  </section>
								</div>
							  </div>
						  </div> 
						  
					</section>
				</div>
				<!-- page end--> 