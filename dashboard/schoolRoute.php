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
	This script handle school route
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */
		     
			 
			if ($_REQUEST['routeData'] == 'routeConfigs') {  /* save school route */  
				
				$route = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['route']);
				$r_amout = preg_replace("/[^0-9]/", "", $_REQUEST['r_amout']);
				$r_desc = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['r_desc']);				
				$teacherID = preg_replace("/[^0-9]/", "", $_REQUEST['teacher']);
				
				$regDate = strtotime(date("Y-m-d H:i:s"));
				
				/* script validation */ 
				
				if ($route == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter new route name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($r_amout == "")  {
         		
					$msg_e = "* Oooooooops Error, please enter route amout";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
	   			
				}elseif($teacherID == "")   {
         		
					$msg_e  = "* Oooooooops Error, please select Route master or mistress";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
	   			
				}else {  /* insert information */       			


		 			try {
						
						
						$ebele_mark = "INSERT INTO $routeTB  (route, r_amout, r_desc, r_master)

								VALUES (:route, :r_amout, :r_desc, :r_master)";
					 
						$igweze_prep = $conn->prepare($ebele_mark);

						$igweze_prep->bindValue(':route', $route);
						$igweze_prep->bindValue(':r_amout', $r_amout);
						$igweze_prep->bindValue(':r_desc', $r_desc);
						$igweze_prep->bindValue(':r_master', $teacherID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */ 
							
							$msg_s = "<strong>$route</strong> was successfully added"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewRoute').load('routesInfo.php'); 
							$('#frmsaveRoute')[0].reset();  $('#saveLoader').fadeOut(1500);  
							$('.alert').fadeOut(18000); </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to add new route. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
         		
        	
				}
			
			}elseif ($_REQUEST['routeData'] == 'updateRoute') {  /* update school route */ 

				
				$route = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['route']);
				$r_amout = preg_replace("/[^0-9]/", "", $_REQUEST['r_amout']);
				$r_desc = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['r_desc']);				
				$teacherID = preg_replace("/[^0-9]/", "", $_REQUEST['teacher']);
				$hID = preg_replace("/[^0-9]/", "", $_REQUEST['hID']);			
				
				
				if ($hID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to save route information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($route == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter new route name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($r_amout == "")  {
         		
					$msg_e = "* Oooooooops Error, please maximum number of student this route can contain";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
	   			
				}elseif($teacherID == "")   {
         		
					$msg_e  = "* Oooooooops Error, please select Route master or mistress";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
	   			
				}else {  /* update information */        			


		 			try {
						
						
						$ebele_mark = "UPDATE $routeTB
										
										SET 
										
											route = :route, 
											r_amout = :r_amout, 
											r_desc = :r_desc, 
											r_master = :r_master
											
											WHERE r_id = :r_id";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':route', $route);
						$igweze_prep->bindValue(':r_amout', $r_amout);
						$igweze_prep->bindValue(':r_desc', $r_desc);
						$igweze_prep->bindValue(':r_master', $teacherID);
						$igweze_prep->bindValue(':r_id', $hID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */ 
							
							$msg_s = "<strong>$route</strong> was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewRoute').load('routesInfo.php'); 
							   $('#editLoader').fadeOut(1500);  $('#editRouteDiv').slideUp(1500);
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save route. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}  
        	
				}
			
			}elseif ($_REQUEST['routeData'] == 'removeRoute') {  /* remove school route */ 

				
				$routeData = $_REQUEST['rData'];
				
				list($wizGradeIg, $hID, $hName) = explode("-", $routeData);			
				
				/* script validation */ 
				
				if (($routeData == "")  || ($hID == "")){
         			
					$msg_e = "* Ooooooooops, an error has occur while to remove route. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* remove information */       			


		 			try {
						
						
						$ebele_mark = "DELETE FROM $routeTB 
										
										WHERE r_id = :r_id
										
										LIMIT 1";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':r_id', $hID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */ 
							
							$removeDiv = "$('#row-".$hID."').fadeOut(1000);";
							$msg_s = "<strong>$hName</strong> was successfully removed"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'>   
							$('#removeLoader').fadeOut(1500); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to remove route. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
         		
        	
				}
			
			}elseif ($_REQUEST['routeData'] == 'editRoute') {  /* edit school route */ 

				
				$hID = strip_tags($_REQUEST['rData']);
				
				/* script validation */
				
				if ($hID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve route information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       			


		 			try {
						
						
						$routeInfoArr = wizGradeRouteInfo($conn, $hID);  /* school route information */
						$route = $routeInfoArr[$fiVal]['route'];
						$r_amout = $routeInfoArr[$fiVal]['r_amout'];
						$r_desc = $routeInfoArr[$fiVal]['r_desc'];
						$r_master = $routeInfoArr[$fiVal]['r_master'];


$routeFormTop =<<<IGWEZE
        
								<!-- form -->
								<form class="form-horizontal" id="frmupdateRoute" role="form">


									  <div class="form-group">
                                          <label for="route" class="col-lg-5 control-label">*
                                           Route Name</label>
                                          <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-building-o"></i>
                                              <input type="text"  id="route" name="route"  class="form-control"  value="$route"
											  required style="text-transform:Capitalize;">
                                          </div>
                                          </div>
                                      </div>    

									  <div class="form-group">
                                          <label for="r_amout	" class="col-lg-5 control-label">*
                                           Route Amout</label>
                                          <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-users"></i>
                                              <input type="number"  id="r_amout	" name="r_amout	" class="form-control" value="$r_amout" required>
                                          </div>
                                          </div>
                                      </div>    

									  <div class="form-group">
                                          <label for="r_desc" class="col-lg-5 control-label">
                                          Route Description</label>
                                          <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-suitcase"></i>
                                              <input type="text"  id="r_desc" name="r_desc" value="$r_desc" class="form-control">
                                          </div>
                                          </div>
                                      </div>    


									  <div class="form-group">
                                      <label  for="term" class="col-lg-5 col-sm-5 control-label">* Route Master/Mistress</label>
                                     
                                      <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-user"></i>
                                              
                                              <select class="form-control"  id="teacherDiv" name="teacher" required>
                                              
                                				<option value = "">Please select One</option>
                                
                                              
                                              
		
IGWEZE;
                               
										echo $routeFormTop;	 

										$teachersArray = staffArrays($conn); /* school staffs/teachers array */ 		
										$teacherCount = count($teachersArray);
										 
								 
				
										for($i = $fiVal; $i <= $teacherCount; $i++){  /* loop array */
											
											$tID = $teachersArray[$i]["t_id"];
											$title = $teachersArray[$i]["i_title"];
											$lname = $teachersArray[$i]["i_lastname"];
											$fname = $teachersArray[$i]["i_firstname"];
											$mname = $teachersArray[$i]["i_midname"];
											$titleVal = $title_list[$title];
											
											$teacherName = $titleVal.' '.$lname.' '.$fname.' '.$mname;
											
												if ($tID == $r_master){
													$selected = "SELECTED";
												}else{
													$selected = "";
												}

												
												echo '<option value="'.$tID.'"'.$selected.'>'.$teacherName.'</option>' ."\r\n"; 
		                        		
										}
										  
								

$routeFormBot =<<<IGWEZE
        
        
                                              </select>
                                              
                                          </div>
                                      </div>
                                  </div>
								  
								  <span id="wait_11" style="display: none;">
    									<center><img alt="Please Wait" src="loading.gif"/></center>
    								</span>
    							<span id="result_11" style="display: none;"></span> 


                                      
                                      <div class="form-group">
                                      	  <input type="hidden" name="routeData" value="updateRoute" />
										  <input type="hidden" name="hID" value="$hID" />		 
                                          <center><button type="submit" class="btn btn-danger buttonMargin" id="updateRoute">
                                          <i class="fa fa-save"></i> Update </button></center>
                                          
                                  </div>
                                      
                            </form> 
							<!-- /form -->
		
IGWEZE;
                               
		                  	echo $routeFormBot; 
								
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