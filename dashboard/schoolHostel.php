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
	This script handle school hostel
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */
		         
			if ($_REQUEST['hostelData'] == 'hostelConfigs') {  /* save school hostel */ 
				
				$hostel = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['hostel']);
				$h_max = preg_replace("/[^0-9]/", "", $_REQUEST['h_max']);
				$h_desc = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['h_desc']);				
				$teacherID = preg_replace("/[^0-9]/", "", $_REQUEST['teacher']);
				
				$regDate = strtotime(date("Y-m-d H:i:s"));
				
				/* script validation */ 
				
				if ($hostel == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter new hostel name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($h_max == "")  {
         		
					$msg_e = "* Oooooooops Error, please maximum number of student this hostel can contain";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
	   			
				}elseif($teacherID == "")   {
         		
					$msg_e  = "* Oooooooops Error, please select Hostel master or mistress";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
	   			
				}else {  /* insert information */   

		 			try {
						
						
						$ebele_mark = "INSERT INTO $hostelTB  (hostel, h_limit, h_desc, h_master)

								VALUES (:hostel, :h_limit, :h_desc, :h_master)";
					 
						$igweze_prep = $conn->prepare($ebele_mark);

						$igweze_prep->bindValue(':hostel', $hostel);
						$igweze_prep->bindValue(':h_limit', $h_max);
						$igweze_prep->bindValue(':h_desc', $h_desc);
						$igweze_prep->bindValue(':h_master', $teacherID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "<strong>$hostel</strong> was successfully added"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewHostel').load('hostelsInfo.php'); 
							$('#frmsaveHostel')[0].reset();  $('#saveLoader').fadeOut(1500);  
							$('.alert').fadeOut(18000); </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to add new hostel. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
							
						} 

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['hostelData'] == 'updateHostel') {  /* update school hostel */

				
				$hostel = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['hostel']);
				$h_max = preg_replace("/[^0-9]/", "", $_REQUEST['h_max']);
				$h_desc = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['h_desc']);				
				$teacherID = preg_replace("/[^0-9]/", "", $_REQUEST['teacher']);
				$hID = preg_replace("/[^0-9]/", "", $_REQUEST['hID']);			
				
				/* script validation */ 
				
				if ($hID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to save hostel information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($hostel == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter new hostel name";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($h_max == "")  {
         		
					$msg_e = "* Oooooooops Error, please maximum number of student this hostel can contain";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
	   			
				}elseif($teacherID == "")   {
         		
					$msg_e  = "* Oooooooops Error, please select Hostel master or mistress";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
	   			
				}else {  /* update information */       			


		 			try {
						
						
						$ebele_mark = "UPDATE $hostelTB
										
										SET 
										
											hostel = :hostel, 
											h_limit = :h_limit, 
											h_desc = :h_desc, 
											h_master = :h_master
											
											WHERE h_id = :h_id";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':hostel', $hostel);
						$igweze_prep->bindValue(':h_limit', $h_max);
						$igweze_prep->bindValue(':h_desc', $h_desc);
						$igweze_prep->bindValue(':h_master', $teacherID);
						$igweze_prep->bindValue(':h_id', $hID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "<strong>$hostel</strong> was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewHostel').load('hostelsInfo.php'); 
							   $('#editLoader').fadeOut(1500);  $('#editHostelDiv').slideUp(1500);
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save hostel. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
         		
        	
				}
			
			}elseif ($_REQUEST['hostelData'] == 'removeHostel') {  /* remove school hostel */

				
				$hostelData = $_REQUEST['rData'];
				
				list($wizGradeIg, $hID, $hName) = explode("-", $hostelData);			
				
				/* script validation */ 
				
				if (($hostelData == "")  || ($hID == "")){
         			
					$msg_e = "* Ooooooooops, an error has occur while to remove hostel. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* remove information */       			


		 			try { 
						
						$ebele_mark = "DELETE FROM $hostelTB 
										
										WHERE h_id = :h_id
										
										LIMIT 1";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':h_id', $hID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$hID."').fadeOut(1000);";
							$msg_s = "<strong>$hName</strong> was successfully removed"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'>   
							$('#removeLoader').fadeOut(1500); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */
				
							$msg_e =  "Ooooooooops, an error has occur while to remove hostel. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['hostelData'] == 'editHostel') {  /* edit school hostel */

				
				$hID = $_REQUEST['rData'];
				
				/* script validation */ 
				
				if ($hID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve hostel information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       			


		 			try {
						
						
						$hostelInfoArr = wizGradeHostelInfo($conn, $hID);  /* school hostel information  */
						$hostel = $hostelInfoArr[$fiVal]['hostel'];
						$h_limit = $hostelInfoArr[$fiVal]['h_limit'];
						$h_desc = $hostelInfoArr[$fiVal]['h_desc'];
						$h_master = $hostelInfoArr[$fiVal]['h_master'];


$hostelFormTop =<<<IGWEZE
        
								<!-- form -->
								<form class="form-horizontal" id="frmupdateHostel" role="form"> 

									  <div class="form-group">
                                          <label for="hostel" class="col-lg-5 control-label">*
                                           Hostel Name</label>
                                          <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-building-o"></i>
                                              <input type="text"  id="hostel" name="hostel"  class="form-control"  value="$hostel"
											  required style="text-transform:Capitalize;">
                                          </div>
                                          </div>
                                      </div>    

									  <div class="form-group">
                                          <label for="h_max" class="col-lg-5 control-label">*
                                           Maximum No. of Student Hostel can contain</label>
                                          <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-users"></i>
                                              <input type="number"  id="h_max" name="h_max" class="form-control" value="$h_limit" required>
                                          </div>
                                          </div>
                                      </div>    

									  <div class="form-group">
                                          <label for="h_desc" class="col-lg-5 control-label">
                                          Hostel Description</label>
                                          <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-suitcase"></i>
                                              <input type="text"  id="h_desc" name="h_desc" value="$h_desc" class="form-control">
                                          </div>
                                          </div>
                                      </div>    

									  <div class="form-group">
                                      <label  for="term" class="col-lg-5 col-sm-5 control-label">* Hostel Master/Mistress</label>
                                     
									  <div class="col-lg-7">
                                          <div class="iconic-input">
                                              <i class="fa fa-user"></i>
                                              
                                              <select class="form-control"  id="teacherDiv" name="teacher" required>
                                              
                                				<option value = "">Please select One</option>
                                
                                              
                                              
		
IGWEZE;
                               
										echo $hostelFormTop;						

								
								
									 

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
											
												if ($tID == $h_master){
													$selected = "SELECTED";
												}else{
													$selected = "";
												}

												
												echo '<option value="'.$tID.'"'.$selected.'>'.$teacherName.'</option>' ."\r\n";
		
		                        		} 
								

$hostelFormBot =<<<IGWEZE
        
        
                                              </select>
                                              
                                          </div>
                                      </div>
                                  </div>
								  
								  <span id="wait_11" style="display: none;">
    									<center><img alt="Please Wait" src="loading.gif"/></center> <!-- loading image -->
    								</span>
    							  <span id="result_11" style="display: none;"></span> 


                                      
                                      <div class="form-group">
                                      	  <input type="hidden" name="hostelData" value="updateHostel" />
										  <input type="hidden" name="hID" value="$hID" />
                                          <center><button type="submit" class="btn btn-danger buttonMargin" id="updateHostel">
                                          <i class="fa fa-save"></i> Update </button></center>
                                          
                                  </div>
                                      
                            </form> 
							<!-- / form -->
IGWEZE;
                               
		                  	echo $hostelFormBot;														
								
								
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