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
	This page handle staff profile validation
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');  

			if (($_REQUEST['bioData']) == 'newStaff') {  /* save staff profile */ 


				$title = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['title']);
				$ranking = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['ranking']);
				$lname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['lname']);
				$fname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['fname']);
				$mname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['mname']);

				/* script validation */ 
				
				if ($lname == "")  {
         		
					$msg_e = "Oooooops Error, please enter staff last name ";
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>"; exit;
	   			
				}elseif ($fname == "")  {
         		
					$msg_e = "Oooooops Error, please enter staff first name ";
					echo $erroMsg.$msg_e.$msgEnd;
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>"; exit;
	   			
				}else {  /* insert information */  
       	
       				$lname = strip_tags($lname);

       				$lname = trim($lname);

		 			try {
		 				 														
			
						$ebele_mark = "INSERT INTO $staffTB (i_title, rank, i_lastname,  i_firstname,
																	  i_midname, status) 
									
										VALUES(:i_title, :rank, :i_lastname, :i_firstname, :i_midname, :status)";
										
						$igweze_prep = $conn->prepare($ebele_mark);								
						
						$igweze_prep->bindValue(':i_title', $title);
						$igweze_prep->bindValue(':rank', $ranking);								
						$igweze_prep->bindValue(':i_lastname', $lname);
						$igweze_prep->bindValue(':i_firstname', $fname);
						$igweze_prep->bindValue(':i_midname', $mname);
						$igweze_prep->bindValue(':status', $fiVal);								
						$igweze_prep->execute();

						$lastID = $conn->lastInsertId($staffTB);
						$t_id = $lastID; 
						$newStaffID = 'staff'.$lastID;

						$ebele_mark_1 = "UPDATE $staffTB 
						
										SET  staff_id = :staff_id
										
										WHERE t_id = :t_id";
										
						$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
						$igweze_prep_1->bindValue(':staff_id', $newStaffID);
						$igweze_prep_1->bindValue(':t_id', $lastID);	
						$igweze_prep_1->execute();  
		
						if (($igweze_prep) && ($igweze_prep_1)){  /* if sucessfully */  
						
							$titleVal = $title_list[$title]; 

                 		
$newBioData =<<<IGWEZE

							<!-- table -->
							<table width = '100%' border = '0' align = 'center' class='table table-striped table-advance table-hover'>

							<thead><tr><th>S/N</th> <th>Staff Name</th><th>Tasks</th></tr></thead> <tbody>

							<tr>							
							<td width='10%'>1</td>							
							<td class='text-left' width='80%'>							
							<a href='javascript:;' id='$t_id' class ='viewStaff'> <img src = '$wizGradeDefaultPic' height = '40' width = '40' class='small-picture'> 
							$lname $fname $mname  </a> </td> 
							<td width='10%'>   		
							
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
								<i class="fa fa-wrench"></i> <span class="caret"></span></button>
									<ul role="menu" class="dropdown-menu pull-right">
											<li>
											<a href='javascript:;' id='$t_id' class ='viewStaff'><button class="btn btn-success btn-xs">
											<i class="fa fa-search-plus"></i></button> View</a>
											</li>
											<li class="divider"></li>
											<li>
											<a href='javascript:;' id='$t_id' class ='editStaff'> 
											<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
											</li>
									</ul>	   
											
							</div><!-- /btn-group -->
							
							</td> </tr>
							

							</tbody>
							</table>
							<!-- / table -->
		
IGWEZE;
						 

							echo '<!-- row -->	
							<div class="row">  
							         <div class="col-lg-5">
				                      <section class="panel" id="wizGradeScrollTargetSE">
                				      <header class="panel-heading">
											<i class="fa fa-user-plus fa-lg"></i> New Staff Info
											<span class="tools pull-right">
												<a href="javascript:;" class="fa fa-chevron-down"></a>
												<a href="javascript:;" class="fa fa-times"></a>
											</span>
			                          </header>
            			              <div class="panel-body wizGrade-line">';
									 
											echo $newBioData;
							
								echo '</div>
        
								</section>
        
								</div>	
        
        
						        <div class="col-lg-7">
									<section class="panel" id="wizGradeScrollTarget">
         
										<header class="panel-heading">
											<i class="fa fa-wrench fa-lg"></i>  Staff Profile Tasks 
											<span class="tools pull-right">
												<a href="javascript:;" class="fa fa-chevron-down"></a>
												<a href="javascript:;" class="fa fa-times"></a>
											</span>
										</header>
										<div class="panel-body wizGrade-line"> 
					
											<div id="wizGradeRightHalf">  </div>
							  
										</div>
                
          							</section>
        							</div>
        
        					</div><!-- / row -->';
									
							echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>"; exit;



        				}else{  /* display error */ 

							$msg_e = "<span>Ooooooops, 
							An Error Has occur while trying 
							to create new Staff Profile, please try again</span>";
							echo $erroMsg.$msg_e.$msgEnd;
							echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>"; exit;

						}
						
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}						

        		}
        
			}elseif (($_REQUEST['bioData']) == 'saveStaff1') {  /* save staff profile */ 

				$teacherID = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['teacherID']);
				$title = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['title']);
				$ranking = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['ranking']);
				$fname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['fname']);
				$mname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['mname']);
				$lname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['lname']);
				$sex =   preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['sex']);
				$dateofbirth = preg_replace("/[^A-Za-z0-9-]/", "", $_REQUEST['dob']);
				$bloodgr =   preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['bloodgr']);
				$genotype =   preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['genotype']);

				/* script validation */ 
				
				if ($teacherID == "")  {
         			
					$msg_e = "* An Error has occured, Please refresh your page and if persists contact the developer. Thanks";
					
	   			}elseif ($lname == "")  {
         		
					$msg_e = "Oooooops Error, please enter staff first name ";
	   			
				}elseif($fname == "")   {
         		
					$msg_e  = "Please enter teacher' s last name  ";
	   			
				}elseif (($sex == "")) {
         		
					$msg_e = "Oooooops Error, please select teacher' s gender ";
	   			
				}elseif ($dateofbirth == "") {
         		
					$msg_e = "Oooooops Error, please enter teacher' s date of birth";
	   			
				}elseif ($bloodgr == "") {
         		
					$msg_e = "Oooooops Error, please enter teacher' s blood group";
	   			
				}elseif ($genotype == "") {
         		
					$msg_e = "Oooooops Error, please enter staff genotype";
	   			
				}else {  /* update information */



       				$fname = strip_tags($fname);  $mname = strip_tags($mname); $lname = strip_tags($lname);
       				$sex = strip_tags($sex);    $dateofbirth = strip_tags($dateofbirth);   

       				$fname = trim($fname);  $mname = trim($mname); $lname = trim($lname);
       				$sex = trim($sex);    $dateofbirth = trim($dateofbirth);    


		 			try {
		 
			
						$ebele_mark = "UPDATE $staffTB SET
					 
										i_title = :i_title,
										i_firstname = :i_firstname,
										i_midname = :i_midname,
										i_lastname = :i_lastname,
										i_gender = :i_gender,
										i_dob = :i_dob,
										bloodgp = :bloodgp,
										genotype = :genotype,
										rank = :rank
										
										WHERE t_id = :t_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
						
						$igweze_prep->bindValue(':i_title', $title);
						$igweze_prep->bindValue(':i_firstname', $fname);
						$igweze_prep->bindValue(':i_midname', $mname);
						$igweze_prep->bindValue(':i_lastname', $lname);
						$igweze_prep->bindValue(':i_gender', $sex);
						$igweze_prep->bindValue(':i_dob', $dateofbirth);
						$igweze_prep->bindValue(':bloodgp', $bloodgr);
						$igweze_prep->bindValue(':genotype', $genotype);
						$igweze_prep->bindValue(':rank', $ranking);
						$igweze_prep->bindValue(':t_id', $teacherID);
												
						if ($igweze_prep->execute()) {  /* if sucessfully */ 

							$msg_s = "Staff Profile was  Successfully Saved.";
							
							echo "<script type='text/javascript'> $('#editBio2').slideUp(2000);  </script>";
							
						}else {  /* display error */ 

							$msg_e = "<span>Ooooooops,  An Error Has occur while trying to save Staff Profile, please try again</span>";

						}
				


					}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}

        		}
        
			}elseif (($_REQUEST['bioData']) == 'saveStaff2') {  /* save staff profile */ 

				$teacherID = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['teacherID']);
				$country = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['country']);
                $state = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['state']);
				$lga = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['lga']);
				$add1 = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['add1']);
				$add2 = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['add2']);
				$city = preg_replace("/[^A-Za-z0-9 ]/", "",  $_REQUEST['city']);
				$studphone = preg_replace("/[^A-Za-z0-9+]/", "", $_REQUEST['i_phone']);
				$email = preg_replace("/[^A-Za-z0-9.@]/", "", $_REQUEST['email']);
				
				/* script validation */ 
				
	  			if ($teacherID == "")  {
         			
					$msg_e = "* An Error has occured, Please refresh your page and if persists contact the developer. Thanks ";
					
	   			}elseif (($country == "")) {
					
         			$msg_e = "Oooooops Error, please select staff nationality ";
					
	   			} elseif (($state == "")) {
					
         			$msg_e = "Oooooops Error, please select staff state ";
					
	   			} elseif($city == "")   {
					
         			$msg_e = "Oooooops Error, please enter staff city ";
					
	   			} elseif($add1 == "") {
					
         			$msg_e = "Oooooops Error, please enter staff parmanent address ";
					
	   			} elseif($studphone == "")  {
					
         			$msg_e = "Oooooops Error, please enter staff mobile number ";
					
	   			}elseif($email == "")     {
					
         			$msg_e = "Oooooops Error, please enter teacher' s email address ";
					
      			
	  			} else {  /* update information */ 


       				$country = strip_tags($country); $state = strip_tags($state); $lga = strip_tags($lga);
       				$city = strip_tags($city);  $add1 = strip_tags($add1);       $add2 = strip_tags($add2);
       				$studphone = strip_tags($studphone);      $email = strip_tags($email);     

       				$country = trim($country); $state = trim($state); $lga = trim($lga);
       				$city = trim($city);  $add1 = trim($add1);       $add2 = trim($add2);
       				$studphone = trim($studphone);      $email = trim($email);     


		 			try { 
			
						$ebele_mark = "UPDATE $staffTB SET 

										i_country = :i_country,
										i_state = :i_state,                 								
										i_city = :i_city,
										i_add_fi = :i_add_fi,
										i_add_se = :i_add_se,
										i_phone = :i_phone,
										i_email = :i_email


										WHERE t_id = :t_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
					
				
						$igweze_prep->bindValue(':i_country', $country);
						$igweze_prep->bindValue(':i_state', $state);
						//$igweze_prep->bindValue(':i_lga', $lga); i_lga = :i_lga,
						$igweze_prep->bindValue(':i_city', $city);
						$igweze_prep->bindValue(':i_add_fi', $add1);
						$igweze_prep->bindValue(':i_add_se', $add2);
						$igweze_prep->bindValue(':i_phone', $studphone);
						$igweze_prep->bindValue(':i_email', $email);
						$igweze_prep->bindValue(':t_id', $teacherID);
												
						if ($igweze_prep->execute()) {  /* if sucessfully */ 
				
							echo "<script type='text/javascript'>  $('#editBio3').slideUp(2000);  </script>";
							$msg_s = "Staff Profile was Successfully Saved.";

						}else {  /* display error */ 

							$msg_e = "<span>Ooooooops,  An Error Has occur while trying to save Staff Profile, please try again</span>";

						}

					}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}

        		}
        
			}elseif (($_REQUEST['bioData']) == 'saveStaff3') {  /* save staff profile */ 

				$teacherID = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['teacherID']);
				$sponphone = preg_replace("/[^A-Za-z0-9+]/", "", $_REQUEST['sponphone']);
				$sponsor = preg_replace("/[^A-Za-z0-9& ]/", "", $_REQUEST['sponsor']);
				$sponadd = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['sponadd']);
				
				/* script validation */ 
				
      			if ($teacherID == "")  {
         			
					$msg_e = "* An Error has occured, Please refresh your page and if persists contact the developer. Thanks ";
					
	   			}elseif($sponsor == "")   {
					
         			$msg_e = "Oooooops Error, please enter teacher' s next of kin name ";
					
	   			} elseif($sponphone == "")   {
					
         			$msg_e = "Oooooops Error, please enter teacher' s next of kin phone number ";
					
	   			} elseif($sponadd == "")   {
					
         			$msg_e = "Oooooops Error, please enter teacher' s next of kin address ";
	   
	  			} else {  /* update information */ 

       	
       				$sponsor = strip_tags($sponsor);
       				$sponphone = strip_tags($sponphone);  $sponadd = strip_tags($sponadd);

       				$sponsor = trim($sponsor);
       				$sponphone = trim($sponphone);  $sponadd = trim($sponadd); 

		 			try { 												
			
						$ebele_mark = "UPDATE $staffTB SET 
									
										i_sponsor = :i_sponsor,
										i_spo_phone = :i_spo_phone,
										i_spo_add = :i_spo_add


										WHERE t_id = :t_id";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
					
						
						$igweze_prep->bindValue(':i_sponsor', $sponsor);
						$igweze_prep->bindValue(':i_spo_phone', $sponphone);
						$igweze_prep->bindValue(':i_spo_add', $sponadd);
						$igweze_prep->bindValue(':t_id', $teacherID); 
						
						if ($igweze_prep->execute()) {  /* if sucessfully */ 

							echo "<script type='text/javascript'>  $('#editBio4').slideUp(2000);  </script>";
							$msg_s = "Staff Profile was Successfully Saved."; 

						}else {  /* display error */ 

							$msg_e = "<span>Ooooooops,  An Error Has occur while trying to save Staff Profile, please try again</span>";

						} 

					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 

        		}
        
			}elseif (($_REQUEST['bioData']) == 'staffPic') {  /* save staff profile picture */ 
			
				$teacherID = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['teacherID']);
					
				$picturePath = $staffPicExt; /* picture path */
				
				$filePic = "uploadPic"; /* picture file name */
				$pageDesc = "Staff picture";
				
				/* call igweze file uploader */
				$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 2), $validPicExt, $validPicType, $allowedPicExt, $fileType = "Picture", $fiVal); 
				 
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
							
								removeTeacherPicSign($conn, $teacherID, $fiVal);  /* remove school staffs/teachers picture */ 

								$ebele_mark = "UPDATE $staffTB SET 
												
													i_picture = :i_picture

													WHERE t_id = :t_id";
													
								$igweze_prep = $conn->prepare($ebele_mark);	
								$igweze_prep->bindValue(':i_picture', $uploadedPic);
								$igweze_prep->bindValue(':t_id', $teacherID);	

								if($igweze_prep->execute()){  /* insert picture name to database */
										 
									echo "<img src=''   height = '1' width='1'> ";
									$msg_s = "$pageDesc was successfully uploaded";									
									echo $succesMsg.$msg_s.$sEnd ;  echo $scrollUp; 	
									echo "<script type='text/javascript'> $('.pictureUploader').fadeOut(1500); </script>";  exit;									

								}else{ /* display error messages */

									echo "<img src=''   height = '1' width='1'> ";
									$msg_e = "Ooooooooooops, an error has occur while trying to save $pageDesc.
									Please try again or check your network connection!!!";
									echo $errorMsg.$msg_e.$eEnd;exit;

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
						
			
			}elseif (($_REQUEST['bioData']) == 'teacherSign') {  /* save staff profile signature */ 
			
				$teacherID = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['teacherID']);
				

				$picturePath = $teachersSignExt; /* picture path */
				
				$filePic = "uploadSign"; /* picture file name */
				$pageDesc = "Staff signature";
				
				/* call igweze file uploader */
				$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 2), $validPicExt, $validPicType, $allowedPicExt, $fileType = "Picture", $fiVal); 
				 
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
								 	
								removeTeacherPicSign($conn, $teacherID, $seVal);  /* remove school staffs/teachers signature */ 

								$ebele_mark = "UPDATE $staffTB SET 
                						 	
                 								i_sign = :i_sign

                 								WHERE t_id = :t_id";
												
								$igweze_prep = $conn->prepare($ebele_mark);	
								$igweze_prep->bindValue(':i_sign', $uploadedPic);
								$igweze_prep->bindValue(':t_id', $teacherID);									

								if($igweze_prep->execute()){  /* insert picture name to database */
										 
									echo "<img src=''   height = '1' width='1'> ";
									$msg_s = "$pageDesc was successfully uploaded";									
									echo $succesMsg.$msg_s.$sEnd ;  echo $scrollUp; 	
									echo "<script type='text/javascript'> $('.signUploader').fadeOut(1500); </script>";  exit;									

								}else{ /* display error messages */

									echo "<img src=''   height = '1' width='1'> ";
									$msg_e = "Ooooooooooops, an error has occur while trying to save $pageDesc.
									Please try again or check your network connection!!!";
									echo $errorMsg.$msg_e.$eEnd;exit;

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
						
			
			}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}


			
			if ($msg_s) {

				echo $succMsg.$msg_s.$msgEnd;
				echo "<script type='text/javascript'>  $('.staffLoader').fadeOut(3000);</script>"; exit;
										
			}	


			if ($msg_e) {

				echo $erroMsg.$msg_e.$msgEnd;
				echo "<script type='text/javascript'>  $('.staffLoader').fadeOut(3000);</script>"; exit;
				
										
			}	
			
			exit;

?>