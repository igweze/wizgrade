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
	This script show student profile
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

      	require 'configwizGrade.php';  /* load wizGrade configuration files */	   
		 
		if($_REQUEST['modalData'] == true){
		
			$loadingStop = "<script type='text/javascript'>   $('#studentSLoading').fadeOut(3000); </script>";
		}	 
		 
		if ($_REQUEST['reg'] != '') { 
				 
		    try {		 				
				
				$reg = strip_tags($_REQUEST['reg']); 
				
				$reg = trim($reg);
				
				/* script validation */ 
				
				if($reg == ""){  /* display error */
					
					$msg_e =  "Oooooooops, student registration is empty";
					
				}else{  /* select profile */	

					$sessionID = studentRegSessionID($conn, $reg);  /* school session ID */
					$session_fi = wizGradeSession($conn, $sessionID);  /* school session */
							 
					$session_se = $session_fi + $foreal;  
					
					if($schoolExt == $wizGradeNurAbr){  /* check is nursery school  */
						
						$class = 'class_1, class_2, class_3, ';
						
					}else{
						
						$class = 'class_1, class_2, class_3, class_4, class_5, class_6, ';
					
					}

					$ebele_mark = "SELECT r.ireg_id, nk_regno, $class s.stu_id, i_stupic, i_firstname, i_lastname, i_midname, 
									i_gender, i_dob, i_country, i_state, i_lga, i_city, i_add_fi, i_add_se, i_stu_phone, 
									i_email, i_sponsor, i_spo_phone, i_spo_add, genotype, bloodgp, disability, hostel, route

									FROM $i_reg_tb r,  $i_student_tb s

									WHERE r.nk_regno = :nk_regno
						 
									AND r.ireg_id = s.ireg_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);				
					$igweze_prep->bindValue(':nk_regno', $reg);				 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {  /* check array is empty */
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
		   
							$regNum = $row['nk_regno'];
							$ID = $row['ireg_id'];
							$e_status = $row['e_status'];
							$pic = $row['i_stupic'];
							$fname = $row['i_firstname'];
							$lname = $row['i_lastname'];
							$mname = $row['i_midname'];
							$gender = $row['i_gender'];
							$date = $row['i_dob'];
							$country = $row['i_country'];
							$state = $row['i_state'];
							$lga = $row['i_lga'];
							$city = $row['i_city'];
							$add1 = $row['i_add_fi'];
							$add2 = $row['i_add_se'];
							$phone = $row['i_stu_phone'];
							$email = $row['i_email'];
							$spon = $row['i_sponsor'];
							$sphone = $row['i_spo_phone'];
							$adds = $row['i_spo_add'];
							$bloodGP = $row['bloodgp'];
							$genoTP = $row['genotype'];
							$disability = $row['disability'];
							$fiClass = $row['class_1'];
							$seClass = $row['class_2'];
							$thClass = $row['class_3'];
							$foClass = $row['class_4'];
							$fifClass = $row['class_5'];
							$sixClass = $row['class_6'];
							$hID = $row['hostel'];
							$rID = $row['route'];
						}	

						$genderM = $gender_list[$gender];
						$bloodGroup = $bloodgr_list[$bloodGP];
						$genoType = $genotype_list[$genoTP];
						
						$levelArray = studentLevelsArray($conn); /* student level array */
						$disArrayList =	disabilityArrays($conn);  /* disability array  */
						
						$levelOne = $levelArray[0]['level'];
						$levelTwo = $levelArray[1]['level'];
						$levelThree = $levelArray[2]['level'];
						$levelFour = $levelArray[3]['level'];
						$levelFive = $levelArray[4]['level'];
						$levelSix = $levelArray[5]['level'];
						
						$disArray = reDisabilityArrays($disability);  /* disability array  */ 
					
						if(isset($disability)){  /* check array is empty */
						
							$i = $foreal; $num = count($disArray);
								
								foreach($disArray as $disabty){  /* loop array */
						
								$str_id = $disabty;
								$str_C = $disArrayList[$disabty]["name"]; 
								$str = $disArrayList[$disabty]["name"]; 
						
								if(($i) != $num){ $str.=", "; }
														
									$i++;
						
									$disabilityData .= $str;

								}
						}
									
						if($hID != ""){
							
							$hostelInfoArr = wizGradeHostelInfo($conn, $hID);  /* school hostel information  */
							$hostel = $hostelInfoArr[$fiVal]['hostel'];
							
						}
						if($rID != ""){
							
							$routeInfoArr = wizGradeRouteInfo($conn, $rID);  /* school route information  */
							$route = $routeInfoArr[$fiVal]['route'];
							
						}
						
						
						if (is_null($pic)){
				
							$studentPic = $wizGradeDefaultPic;

						}else{
				
							$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$pic;


						}

						if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }  /* check if picture exists */
						
						
						
						if($schoolExt == $wizGradeNurAbr){  /* check if nursery school */
					
$classInfo =<<<IGWEZE
		
							<!-- table -->
							<table width = '100%' border = '0' align = 'center' class="digit-table table table-striped table-advance table-hover">
											  
								<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
								<i class="fa fa-bars"></i> $levelOne </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
								$fiClass</td> </tr>
								<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
								<i class="fa fa-bars"></i> $levelTwo </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
								$seClass</td> </tr>
								<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
								<i class="fa fa-bars"></i> $levelThree </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
								$thClass</td> </tr>
												   
							</table>
							<!-- / table -->
IGWEZE;
					
						}else{
					
$classInfo =<<<IGWEZE
		
							<!-- table -->
							<table width = '100%' border = '0' align = 'center' class="digit-table table table-striped table-advance table-hover">
											  
								<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
								<i class="fa fa-bars"></i> $levelOne </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
								$fiClass</td> </tr>
								<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
								<i class="fa fa-bars"></i> $levelTwo </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
								$seClass</td> </tr>
								<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
								<i class="fa fa-bars"></i> $levelThree </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
								$thClass</td> </tr>
								<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
								<i class="fa fa-bars"></i> $levelFour </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
								$foClass</td> </tr>
								<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
								<i class="fa fa-bars"></i> $levelFive </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
								$fifClass</td> </tr>
								<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
								<i class="fa fa-bars"></i> $levelSix </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
								$sixClass</td> </tr>
												   
							</table>
							<!-- / table -->
					
IGWEZE;

					}
				
				
				        
$table =<<<IGWEZE
		
 
					<div id = 'wizGradePrintArea'> 

					<!--collapse start-->
                      <div class="panel-group m-bot20" id="accordion">
                          <div class="panel panel-default">
                              <div class="panel-heading">
                                  <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                          <i class="fa fa-user"></i> Student Profile
                                      </a>
                                  </h4>
                              </div>
                              <div id="collapseOne" class="panel-collapse collapse in">
                                  <div class="panel-body">
										
									<!-- table -->		
									<table width = '100%' border = '0' align = 'center' class="digit-table table table-striped table-advance table-hover">
										
										<tr><td style="padding-left: 10px;" colspan = '2'><center><img src = "$studentPic" height = '110' width = '110' 
										class= 'img-responsive img-circle' id='wizGradeStudentPic'> </center>
										</td></tr>										

										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-book"></i> Reg</td> <td style="padding-left: 30px; text-align:left; width: 70%;"> 
										$pre_regnum$regNum </td></tr>
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-user"></i> Name </td> <td style="padding-left: 30px; text-align:left; width: 70%;">$lname 
										$fname $mname </td> </tr>
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-user"></i> Gender </td> <td style="padding-left: 30px; text-align:left; width: 70%;">$genderM
										</td> </tr>
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-calendar"></i> Date Of Birth</td> <td style="padding-left: 30px; text-align:left; width: 70%;">
										$date</td> </tr>
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-flag"></i> Nationality </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
										$country</td> </tr>
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-home"></i> State/Province </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
										$state</td> </tr>
										<!--
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-home"></i> LGA</td> <td style="padding-left: 30px; text-align:left; width: 70%;">$lga</td> </tr>
										-->
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-home"></i> City </td> <td style="padding-left: 30px; text-align:left; width: 70%;">$city</td> </tr>
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-home"></i> Address </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
										$add1</td> </tr>
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-home"></i> Address 2 </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
										$add2</td> </tr>
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-phone"></i> Phone Number </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
										$phone</td> </tr>
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-envelope"></i> Email</td> <td style="padding-left: 30px; text-align:left; width: 70%;">
										$email</td> </tr>
										
										</table>
										<!-- / table -->
									  
                                  </div>
                              </div>
                          </div>
                          <div class="panel panel-default">
                              <div class="panel-heading">
                                  <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                          <i class="fa fa-eye"></i> Sponsor Details
                                      </a>
                                  </h4>
                              </div>
                              <div id="collapseTwo" class="panel-collapse collapse">
                                  <div class="panel-body">
                                     
									<!-- table -->	
									<table width = '100%' border = '0' align = 'center' class="digit-table table table-striped table-advance table-hover">
									  
											<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
											<i class="fa fa-user"></i> Sponsor Name</td> <td style="padding-left: 30px; text-align:left; width: 70%;">
											$spon</td> </tr>
											<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
											<i class="fa fa-home"></i> Sponsor Address</td> <td style="padding-left: 30px; text-align:left; width: 70%;">
											$adds</td> </tr>
											<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
											<i class="fa fa-phone"></i> Sponsor Phone</td> <td style="padding-left: 30px; text-align:left; width: 70%;">
											$sphone</td> </tr>
										   
									</table>
									<!-- /table --> 
									  
                                  </div>
                              </div>
                          </div>
                          <div class="panel panel-default">
                              <div class="panel-heading">
                                  <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                          <i class="fa fa-medkit"></i> Medical Information
                                      </a>
                                  </h4>
                              </div>
                              <div id="collapseThree" class="panel-collapse collapse">
                                  <div class="panel-body"> 
								  
									<!-- table -->
									<table width = '100%' border = '0' align = 'center' class="digit-table table table-striped table-advance table-hover"> 

										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-medkit"></i> Blood Group</td> <td style="padding-left: 30px; text-align:left; width: 70%;">
										$bloodGroup</td> </tr>

										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-medkit"></i> Genotype</td> <td style="padding-left: 30px; text-align:left; width: 70%;">
										$genoType</td> </tr> 
										   
									</table>
									<!-- / table -->
                                  </div>
                              </div>
                          </div>
						  
						  <div class="panel panel-default">
                              <div class="panel-heading">
                                  <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                          <i class="fa fa-bars"></i> Student Class
                                      </a>
                                  </h4>
                              </div>
                              <div id="collapseFour" class="panel-collapse collapse">
                                  <div class="panel-body">
                                      $classInfo
                                  </div>
                              </div>
                          </div>
						  
						  <div class="panel panel-default">
                              <div class="panel-heading">
                                  <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                          <i class="fa fa-bars"></i> Student Hostel & Transport Route
                                      </a>
                                  </h4>
                              </div>
                              <div id="collapseFive" class="panel-collapse collapse">
                                  <div class="panel-body">
										<!-- table -->
										<table width = '100%' border = '0' align = 'center' class="digit-table table table-striped table-advance table-hover">
											<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
											<i class="fa fa-building-o"></i> Hostel Name</td> <td style="padding-left: 30px; text-align:left; width: 70%;">
											$hostel</td> </tr>

											<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
											<i class="fa fa-road"></i> Transport Route</td> <td style="padding-left: 30px; text-align:left; width: 70%;">
											$route</td> </tr>
										</table>	
										<!-- / table -->
                                  </div>
                              </div>
                          </div>
						  
						  
						  
						</div>
						<!--collapse end-->  
		
						$sdo_tb_footerBio
		
					</div>
		
IGWEZE;
						/* <tr><th style="padding-left: 30px; text-align:left; width: 30%;">
						<i class="fa fa-medkit"></i> Disability</td> <td style="padding-left: 30px; text-align:left; width: 70%;">$disabilityData</td> </tr>

						*/

						echo "<div align='center'> $table </div> $loadingStop";
						echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	
						

					}else{  /* display error */
					
						$msg_e =  "Student record with <strong>$reg</strong> was not found.";
					} 
				
				}
					
			}catch(PDOException $e) {
				
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
			
		
		}else{ 
		
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
		} 
	
		if ($msg_e) {

         	  echo $errorMsg.$msg_e.$eEnd; echo $loadingStop; echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	 echo $scrollUp; exit; 			

        }
		
exit;
?>	