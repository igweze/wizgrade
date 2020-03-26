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
	This script handle school fees category
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */
		         
			if ($_REQUEST['feeCategoryData'] == 'feeCategoryConfigs') {  /* save fees category */

				
				$feeCategory = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['fee']);
				$amount = preg_replace("/[^0-9]/", "", $_REQUEST['amount']);
				
				$regDate = strtotime(date("Y-m-d H:i:s"));
				
				/* script validation */
				
				if ($feeCategory == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter new fee category name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($amount == "")  {
         		
					$msg_e = "* Oooooooops Error, please enter fee category Amount";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
	   			
				}else {  /* update information */     			


		 			try {
						
						
						$ebele_mark = "INSERT INTO $feeCategoryTB  (fee, amount)

								VALUES (:fee, :amount)";
					 
						$igweze_prep = $conn->prepare($ebele_mark);

						$igweze_prep->bindValue(':fee', $feeCategory);
						$igweze_prep->bindValue(':amount', $amount); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "<strong>$feeCategory</strong> fee was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewFeeCategory').load('feeCategoryInfo.php'); 
							$('#frmsaveFeeCategory')[0].reset();  $('#saveLoader').fadeOut(1500);  
							$('.alert').fadeOut(18000); </script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to add new fee category. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['feeCategoryData'] == 'updateFeeCategory') {  /* update fees category */

				
				$feeCategory = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['fee']);
				$amount = preg_replace("/[^0-9]/", "", $_REQUEST['amount']);
				$status = preg_replace("/[^0-9]/", "", $_REQUEST['status']);
				$fID = preg_replace("/[^0-9]/", "", $_REQUEST['fID']);			
				
				/* script validation */ 
				
				if ($fID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur to retrieve fee category. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($feeCategory == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter new fee category name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($amount == "")  {
         		
					$msg_e = "* Oooooooops Error, please fee category amount";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
	   			
				}else {  /* update information */     			


		 			try {
						
						
						$ebele_mark = "UPDATE $feeCategoryTB
										
										SET 
										
											fee = :fee, 
											amount = :amount, 
											status = :status
											
											WHERE f_id = :f_id";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':fee', $feeCategory);
						$igweze_prep->bindValue(':amount', $amount);
						$igweze_prep->bindValue(':status', $status);
						$igweze_prep->bindValue(':f_id', $fID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "<strong>$feeCategory</strong> was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewFeeCategory').load('feeCategoryInfo.php'); 
							   $('#editLoader').fadeOut(1500);  $('#editFeeCategoryDiv').slideUp(1500);
							</script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to save fee category. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['feeCategoryData'] == 'removeFeeCategory') {  /* remove fees category */

				
				$feeCategoryData = $_REQUEST['rData'];
				
				list($wizGradeIg, $fID, $hName) = explode("-", $feeCategoryData);			
				
				/* script validation */
				
				if (($feeCategoryData == "")  || ($fID == "")){
         			
					$msg_e = "* Ooooooooops, an error has occur while to remove fee category. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}else {   /* update information */    			

		 			try {
												
						$ebele_mark = "UPDATE $feeCategoryTB
										
										SET 										
											status = :status
											
											WHERE f_id = :f_id";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':status', $i_false);
						$igweze_prep->bindValue(':f_id', $fID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$fID."').fadeOut(1000);";
							$msg_s = "<strong>$hName</strong> was successfully Disenable"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'>   
							$('#removeLoader').fadeOut(1500); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to remove fee category. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}          		
        	
				}
			
			}elseif ($_REQUEST['feeCategoryData'] == 'editFeeCategory') {  /* edit fees category */

				
				$fID = strip_tags($_REQUEST['rData']);
				
				/* script validation */ 
				
				if ($fID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve fee category information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* select information */     			

		 			try { 
						
						$feeCategoryInfoArr = feeCategoryInfo($conn, $fID);  /* school fee category information */
						$feeCategory = $feeCategoryInfoArr[$fiVal]['fee'];
						$amount = $feeCategoryInfoArr[$fiVal]['amount'];
						$status = $feeCategoryInfoArr[$fiVal]['status'];


$feeCategoryFormTop =<<<IGWEZE
        
							<!-- form -->
							<form class="form-horizontal" id="frmupdateFeeCategory" role="form"> 
							
									  <div class="form-group">
                                          <label for="feeCategory" class="col-lg-5 control-label">*
                                           Fee Category </label>
                                          <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-building-o"></i>
                                              <input type="text"  id="fee" name="fee"  class="form-control"  value="$feeCategory"
											  required style="text-transform:Capitalize;">
                                          </div>
                                          </div>
                                      </div>    

									  <div class="form-group">
                                          <label for="amount" class="col-lg-5 control-label">*
                                           Fee Amount </label>
                                          <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-money"></i>
                                              <input type="number"  id="amount" name="amount" class="form-control" value="$amount" required>
                                          </div>
                                          </div>
                                      </div>    

									  

									  <div class="form-group">
                                      <label  for="term" class="col-lg-5 col-sm-5 control-label">* Fee Status</label>
                                     
                                  <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-exchange"></i>
                                              
                                              <select class="form-control"  name="status" required>
                                              
                                				<option value = "">Please select One</option>
                                
                                              
                                              
		
IGWEZE;
                               
												echo $feeCategoryFormTop;
														
												foreach($onOffArr as $status_key => $status_value){  /* loop array */

													if ($status == $status_key){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$status_key.'"'.$selected.'>'.$status_value.'</option>' ."\r\n";

												}	     	

$feeCategoryFormBot =<<<IGWEZE
        
        
                                              </select>
                                              
                                          </div>
                                      </div>
                                  </div>
								  
								  <span id="wait_11" style="display: none;">
    									<center><img alt="Please Wait" src="loading.gif"/></center>
    								</span>
    							<span id="result_11" style="display: none;"></span> 


                                      
                                      <div class="form-group">
                                      	  <input type="hidden" name="feeCategoryData" value="updateFeeCategory" />
										  <input type="hidden" name="fID" value="$fID" />		
	
                                          <center><button type="submit" class="btn btn-danger buttonMargin" id="updateFeeCategory">
                                          <i class="fa fa-save"></i> Update </button></center>
                                          
                                  </div>
                                      
                                </form> 
								<!-- / form -->
		
IGWEZE;
                               
		                  		echo $feeCategoryFormBot;														
								
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