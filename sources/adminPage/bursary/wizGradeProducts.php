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
	This script handle school products
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		if (!defined('wizGrade'))

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
			require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */	
								

?>				


				<!-- row -->
					<!-- row -->	
					<div class="row">  
					<div class="col-sm-12">
					<section class="panel">
					<header class="panel-heading">
						<i class="fa fa-wrench fa-lg"></i> Product Manager
						<span class="tools pull-right">
						<a href="javascript:;" class="fa fa-chevron-down"></a>
						<a href="javascript:;" class="fa fa-times"></a>
						</span>
					</header>
					<div class="panel-body wizGrade-line"> 

						<!--tab nav start-->
						<section class="panel">
						<header class="panel-heading tab-bg-dark-navy-blue" id="scrollTarget">
							<ul class="nav nav-tabs nav-justified">
								<li class="active">
								<a data-toggle="tab" href="#viewProducts">
								<i class="fa fa-home"></i>
								School Products 
								</a>
								</li>

								<li>
								<a data-toggle="tab" href="#addProducts">
								<i class="fa fa-plus-square"></i>
								Add New Product
								</a>
								</li>
							</ul>
						</header>
						<div class="panel-body">
						<div class="tab-content">


							<div id="viewProducts" class="tab-pane active"> <?php require 'wizGradeProductsInfo.php';  ?> </div>	 

							<div id="addProducts" class="tab-pane">

								<!-- row -->
								<!-- row -->	
					<div class="row">  
								<div class="col-lg-7"> 

								<br clear="all" />
								<span id="p_price" class="display-none"></span>
								<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="saveLoader"  
								style="cursor:pointer; display:none; margin-bottom:5px;" /></center>

								<div id="hmsgBox"> </div>


								<div style="width:900px">
								<div id="msgBoxPic"></div>
								</div>

								<div id="refBox" style="clear:all;"> </div>
								<!-- form -->
								<!-- form --><form class="form-horizontal" id="frmsaveProducts" role="form">


								<div class="form-group">
									<label for="cat_id" class="col-lg-4 col-sm-4 control-label">* Product Category</label>

									<div class="col-lg-8">
									<div class="iconic-input">
									<i class="fa fa-sort-alpha-asc"></i>

									<select class="form-control"  id="pCategory" name="cat_id" required>

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


								<span id="wait" style="display: none;">
								<center><img alt="Please Wait" src="loading.gif"/> <!-- loading image --></center> <!-- loading image --><!-- loading image-->
								</span>
								<span id="result" style="display: none;"></span><!-- loading div -->

								<div id="productDetailsDiv" style="display:none;">  

									<span id="wait_1" style="display: none;">
									<center><img alt="Please Wait" src="loading.gif"/> <!-- loading image --></center> <!-- loading image --><!-- loading image-->
									</span>
									<span id="result_1" style="display: none;"></span> <!-- loading div --> <!-- loading div --> 

									<div class="form-group" >
										<label for="title" class="col-lg-4 col-sm-4 control-label"> *Product Title</label>

										<div class="col-lg-8">

										<div class="iconic-input">
										<i class="fa fa-comment"></i>

										<input type="text" class="form-control" placeholder="Enter Product Title" 
										name="title"  id="title" required>

										</div>

										</div>
									</div> 

									<div class="form-group" >
										<label for="price" class="col-lg-4 col-sm-4 control-label">* Product Price</label>

										<div class="col-lg-8">

										<div class="iconic-input">
										<i class="fa fa-money"></i>

										<input type="number" class="form-control" placeholder="Enter Product Price" 
										name="p_price"  id="p_price" <?php echo $p_price; ?> required>

										</div>

										</div>
									</div> 

									<div class="form-group">
										<label for="p_description" class="col-lg-4 col-sm-4 control-label"> * Product Details</label>

										<div class="col-lg-8">

										<textarea rows="4" cols="10" class="form-control" name="p_description" id="p_description" 
										placeholder="Enter Product Details" required></textarea>

										</div>
									</div>  

									<div class="form-group">
										<label class="control-label col-lg-4 col-sm-4">* Product Date:</label>
										<div class="col-lg-7 col-sm-7">

										<div data-date-viewmode="years" data-date-format="yyyy-mm-dd" 
										data-date="2012-12-02"  
										class="input-append date dpYears">
										<input type="text" readonly="" 
										value="<?php echo $pDay; ?>" 
										size="10" class="form-control"  name="pDay"  required />
										<span class="input-group-btn add-on">
										<button class="btn btn-danger" type="button">
										<i class="fa fa-calendar"></i></button>
										</span>
										</div>
										<span class="help-block">Select Date</span>
										<input type="hidden" name="pID" value="<?php echo $proID; ?>" />		
										</div>
									</div>


									<div class="form-group">
										<label  for="p_status" class="col-lg-4 col-sm-4 control-label">* Product Status</label>
										<div class="col-lg-8">
										<div class="iconic-input">
										<i class="fa fa-bars"></i>

										<select class="form-control"  id="p_status" name="p_status" required>
										<?php 

											foreach($productStatusArr as $statusKey => $statusVal){  /* loop array */

												if ($fiVal == $statusKey){

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
										<input type="hidden" name="productsData" value="saveProduct" /> 
										<center><button type="submit" class="btn btn-danger buttonMargin" id="saveProducts">
										<i class="fa fa-save"></i> Save</button></center>
									</div>

								</div>

								</form><!-- / form -->  
								<!-- / form -->

								</div> 


								</div>

								<!-- / row --> 


							</div>

						</div>
						</div>
						</section>
						<!--tab nav start-->



					</div>
					</section>
					</div>

				</div>
				<!-- / row -->

				<!-- product removal pop up modal start -->	
				<a href="#removeModal" data-toggle="modal" id="modalRemoveBtn" class=""> </a>

				<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" 
						data-dismiss="modal" aria-hidden="true">
						<span style='color:#fff !important;'>&times;</span></button>
						<h4 class="modal-title"> Are sure you want to remove this products information ?
						</h4>
					</div>
					<div class="modal-body">


						<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="removeLoader"  
						style="cursor:pointer; display:none; margin-bottom:5px;" /></center>

						<div id="removeMsg"> </div>


						<div class="slideUpFrmDiv">

						<section class="panel">

						<div class="panel-body">

							<div id="removeHData" style="display:none;"></div>

							<?php 
							echo "$infoMsgNX  Are sure you want to remove? <br />
							<span style='color:#000;font-weight:bold;'  id='removeInfo'> </span> $msgEnd";
							?> 

						</div>

						</section>

						</div>

					</div>
					<div class="modal-footer slideUpFrmDiv">
						<button  class="btn btn-danger demoDisenable" id="removeProducts" 
						type="button">Yes</button>
						<button data-dismiss="modal" class="btn btn-danger" 
						type="button">Cancel</button>
					</div>
					</div>
				</div>
				</div>
				<!-- product removal pop up modal end -->

				<!-- product edit pop up modal start -->
				<a href="#editModal" data-toggle="modal" id="modalEditBtn" class=""> </a>

				<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" 
						data-dismiss="modal" aria-hidden="true">
						<span style='color:#fff !important;'>&times;</span></button>
						<h4 class="modal-title"> School Product Manager
						</h4>
					</div>
					<div class="modal-body modal-body-scroll"> 

						<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="editLoader"  
						style="cursor:pointer; display:none; margin-bottom:5px;" /></center>

						<div id="editMsg"> </div>


						<div class="slideUpFrmUDiv">

							<section class="panel">

							<div class="panel-body"> 

								<div id="editProductsDiv"></div> 

							</div>

							</section>

						</div>

					</div>
					<div class="modal-footer slideUpFrmDiv">
					
						<button data-dismiss="modal" class="btn btn-danger"  type="button">Close</button>
						
					</div>
					</div>
				</div>
				</div>
				<!-- product edit pop up modal end --> 
			  
				<script type='text/javascript'> $('.dpYears').datepicker(); </script>