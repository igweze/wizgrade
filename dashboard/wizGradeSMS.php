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
	This script handle school SMS gateway
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configINwizGrade.php';  /* load wizGrade configuration files */
		         
				 
			if ($_REQUEST['smsData'] == 'saveGateway-future') {  /* save SMS gateway */ 
				
				$user = $_REQUEST['user'];
				$api =  $_REQUEST['api'];				
				$password = $_REQUEST['password'];
				$status = preg_replace("/[^0-9]/", "", $_REQUEST['status']);
				
				$user = strip_tags($user);
				$api = strip_tags($api);
				
				/* script validation */  
				
				if ($user == "")  {
         			
					$msg_e = "* Oooooooops Error, please select sms user name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($expDetails == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter sms details";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($password == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter sms password";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($status == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a sms status";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($pDay == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a sms date";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* insert information */   

		 			try {
						
						$password = htmlspecialchars($password);
						
						$ebele_mark = "INSERT INTO $wizGradeSMSTB  (user, password, api, status)

								VALUES (:user, :password, :api, :status)";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':user', $user);
						$igweze_prep->bindValue(':password', $password);
						$igweze_prep->bindValue(':api', $api);
						$igweze_prep->bindValue(':status', $status); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "School sms was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewSMS').load('wizGradeSMSInfo.php'); 
							$('#frmsaveSMS')[0].reset();  $('#saveLoader').fadeOut(1500);  
							$('.alert').fadeOut(30000); </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save sms. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
        	
				}
			
			}elseif ($_REQUEST['smsData'] == 'updateSMS') {  /* update SMS gateway */

				$sID = preg_replace("/[^0-9]/", "", $_REQUEST['sID']);			
				$user = $_REQUEST['user'];
				$senderID = $_REQUEST['senderID'];
				$api =  $_REQUEST['api'];
				$password = $_REQUEST['password'];
				$status = preg_replace("/[^0-9]/", "", $_REQUEST['status']);
				
				$user = strip_tags($user);
				$api = strip_tags($api);
				$senderID = strip_tags($senderID);
				
				/* script validation */ 
				
				if ($sID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur to retrieve sms information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($user == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter SMS Gateway Username";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($password == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter your SMS Gateway Password";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($api == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter SMS Gateway API. Meanwhile, input <strong>none</strong> for empty API";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($status == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a sms status";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* update information */   
				
		 			try {
						
						$password = htmlspecialchars($password);
						
						if($status == $fiVal){
							
							$ebele_mark = "UPDATE $wizGradeSMSTB  
											
											SET 											
											
											status = :wizGrade
											
											WHERE status = :status";
					 
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':status', $sID);
							$igweze_prep->bindValue(':wizGrade', $i_false);
							$igweze_prep->execute();
							
							
						}	
						
						$ebele_mark = "UPDATE $wizGradeSMSTB  
											
											SET 
											
											senderID = :senderID,
											user = :user, 
											password = :password, 
											api = :api,
											status = :status
											
										WHERE sID = :sID";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':sID', $sID);
						$igweze_prep->bindValue(':user', $user);
						$igweze_prep->bindValue(':senderID', $senderID);
						$igweze_prep->bindValue(':password', $password);
						$igweze_prep->bindValue(':api', $api);
						$igweze_prep->bindValue(':status', $status); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "SMS gateway information was successfully saved."; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewSMS').load('wizGradeSMSInfo.php'); 
							   $('#editLoader').fadeOut(1500);  $('#editSMSDiv').slideUp(1500);
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save sms gateway. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
							
						} 

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}         		
        	
				}
			
			}elseif ($_REQUEST['smsData'] == 'viewSMS') {  /* view SMS gateway */ 
				
				$sID = strip_tags($_REQUEST['rData']);
				
				/* script validation */
				
				if ($sID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve sms gateway information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* select information */       	 

		 			try { 
									$smsInfoArr = smsInfo($conn, $sID);  /* text message and gateway information  */ 
									$gateway = $smsInfoArr[$fiVal]["gateway"];
									$senderID = $smsInfoArr[$fiVal]["senderID"];
									$user = $smsInfoArr[$fiVal]["user"];
									$password = htmlspecialchars_decode($smsInfoArr[$fiVal]["password"]);
									$api = $smsInfoArr[$fiVal]["api"];
									$status = $smsInfoArr[$fiVal]["status"]; 
									$status = $onOffArr[$status]; 

$showGateway =<<<IGWEZE
		
									<button  class="btn btn-white printer-icon pull-right">
									  <i class="fa fa-print text-info"></i> Print </button><br clear="all"/><br clear="all"/>
		
									<div id = 'wizGradePrintArea'>

                                  	<!-- table -->	
									<table width = '100%' class="table table-striped  table-advance table-hover">

										
										<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
										<i class="fa fa-user-o"></i> Gateway </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
										$gateway
										</td> </tr>
										
										<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
										<i class="fa fa-info"></i> Gateway Sender Name </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
										$senderID
										</td> </tr>
										
										<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
										<i class="fa fa-user"></i> Gateway User</td> <td style="padding-left: 30px; text-align:left; width: 60%;">
										$user
										</td> </tr>
										
										<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
										<i class="fa fa-key"></i> Gateway Password </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
										$password</td> </tr>
										
										<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
										<i class="fa fa-free-code-camp"></i> Gateway API </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
										$api </td> </tr>
										
										<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
										<i class="fa fa-bars"></i> SMS Status</td> <td style="padding-left: 30px; text-align:left; width: 60%;">
										$status</td> </tr>
										
									</table>
									<!-- / table --> 
								</div>
		
IGWEZE;
				
								echo $showGateway;
								
								echo "<script type='text/javascript'>  $('#editLoader').fadeOut(3000); </script>"; exit;
						
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['smsData'] == 'editSMS') {  /* edit SMS gateway */

				
				$sID = strip_tags($_REQUEST['rData']);
				
				/* script validation */
				
				if ($sID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve sms gateway information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       			


		 			try {
						
						
							$smsInfoArr = smsInfo($conn, $sID);  /* text message and gateway information  */ 
							$smsID = $smsInfoArr[$fiVal]["sID"];
							$senderID = $smsInfoArr[$fiVal]["senderID"];
							$user = $smsInfoArr[$fiVal]["user"];
							$api = $smsInfoArr[$fiVal]["api"];
							$status = $smsInfoArr[$fiVal]["status"];
							$password = htmlspecialchars_decode($smsInfoArr[$fiVal]["password"]);
							
							
						
?>

								<!-- form -->
								<form class="form-horizontal" id="frmupdateSMS" role="form"> 
									  
									<div class="form-group" >
										<label for="senderID" class="col-lg-4 col-sm-4 control-label"> Gateway Sender Name</label>                                      
										<div class="col-lg-8">
                                        
                                            <div class="iconic-input"> <i class="fa fa-info"></i>
                                                  
												<input type="text" class="form-control" placeholder="Enter SMS Gateway Sender Name" 
												name="senderID"  id="senderID" value="<?php echo $senderID; ?>">
                                            
                                            </div>
											
                                        </div>
                                    </div>
									  
									<div class="form-group" >
										<label for="user" class="col-lg-4 col-sm-4 control-label"> Gateway User Name</label>
                                      
										<div class="col-lg-8">
                                        
                                            <div class="iconic-input"> <i class="fa fa-user"></i>
                                                  
												<input type="text" class="form-control" placeholder="Enter SMS Gateway User Name" 
												name="user"  id="user" value="<?php echo $user; ?>">
                                            
                                            </div>
											
                                        </div>
                                    </div>
									  
									<div class="form-group" >
										<label for="password" class="col-lg-4 col-sm-4 control-label"> Gateway Password</label>                                      
										<div class="col-lg-8">
                                        
                                            <div class="iconic-input"> <i class="fa fa-key"></i>
                                                  
												<input type="text" class="form-control" placeholder="Enter SMS Gateway Password" 
												name="password"  id="password" value="<?php echo $password; ?>">
                                            
                                            </div>
											
                                        </div>
                                    </div>
									  
									  
									<div class="form-group" >
										<label for="api" class="col-lg-4 col-sm-4 control-label"> SMS Api</label>                                      
										<div class="col-lg-8">
                                        
                                            <div class="iconic-input"> <i class="fa fa-free-code-camp"></i>
                                                  
												<input type="text" class="form-control" placeholder="Enter SMS Api" 
												name="api"  id="api" value="<?php echo $api; ?>">
                                            
                                            </div>
											
                                        </div>
                                    </div>
									  
								  
								
									
									
									
									<div class="form-group">									
										<label  for="status" class="col-lg-4 col-sm-4 control-label">* SMS Status</label>                                     
										<div class="col-lg-8">
											<div class="iconic-input">
                                              <i class="fa fa-bars"></i>
                                              
                                              <select class="form-control"  id="status" name="status" required>
                                              
                                				<option value = "">Please select One</option>
												<?php


													foreach($onOffArr as $statusKey => $statusVal){  /* loop array */

														if ($status == $statusKey){
															
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
                                      	  <input type="hidden" name="sID" value="<?php echo $sID; ?>" />
										  <input type="hidden" name="smsData" value="updateSMS" />
                                          <center><button type="submit" class="btn btn-danger demoDisenable buttonMargin" id="updateSMS">
                                          <i class="fa fa-save"></i> Update Gateway </button></center>
                                          
                                    </div>
                                    
									
									  
                                </form>  						
								<!-- / form -->
<?php
								
		 
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