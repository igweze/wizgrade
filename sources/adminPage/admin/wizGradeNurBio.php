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
	This page insert new student data into school database
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */
 
	
					/* check student entry level  */	
					
					if($en_level == 1) {
					
						$class_1 = $class; $class_2 = $class; $class_3 = $class; 
					
					}elseif($en_level == 2) {
					
						$class_1 = ''; $class_2 = $class; $class_3 = $class; 
					
					}elseif($en_level == 3) {
					
						$class_1 = ''; $class_2 = ''; $class_3 = $class; 					
					
					}else{ }
					
					

                    $conn->beginTransaction(); /* begin PDO transaction and prepare student data insertion across database tables */					 
		

                        $ebele_mark_1 = "INSERT INTO  $i_reg_tb (nk_regno, class_1, class_2, class_3,  
																 en_level, en_term, session_id, date_regs, active)

                                         VALUES (:nk_regno, :class_1, :class_2, :class_3, 
												 :en_level, :en_term, :session_id, :date_regs, :active)";
				         										
 			    		$igweze_prep_1 = $conn->prepare($ebele_mark_1);
  						$igweze_prep_1->bindValue(':nk_regno', $regNum);
						$igweze_prep_1->bindValue(':class_1', $class_1);
						$igweze_prep_1->bindValue(':class_2', $class_2);
						$igweze_prep_1->bindValue(':class_3', $class_3);
						$igweze_prep_1->bindValue(':en_level', $en_level);
						$igweze_prep_1->bindValue(':en_term', $en_term);
						$igweze_prep_1->bindValue(':session_id', $sessionID);
						$igweze_prep_1->bindValue(':date_regs', $regDate);
						$igweze_prep_1->bindValue(':active', $foreal);				 				 
 						$igweze_prep_1->execute();
                        
						$regID = $conn->lastInsertId(); /* new student reg number ID that will be added across all tables */	

                        if($showNewPanel == $fiVal){ /* check if student registration is from manual input */
							
							
							$ebele_mark_2 = "INSERT INTO $i_student_tb (ireg_id, i_accesspass , i_salted, i_sponsor_ac,
																		i_sponsor_p, i_firstname, i_midname, i_lastname)

											VALUES (:ireg_id,  :i_accesspass , :i_salted, :i_sponsor_ac, :i_sponsor_p,
													 :i_firstname, :i_midname, :i_lastname)"; //i_stupic
																	
							$igweze_prep_2 = $conn->prepare($ebele_mark_2);
							$igweze_prep_2->bindValue(':ireg_id', $regID);
							$igweze_prep_2->bindValue(':i_accesspass', $userPass);
							$igweze_prep_2->bindValue(':i_salted', $userPass);
							$igweze_prep_2->bindValue(':i_sponsor_ac', $userPass);				 				 
							$igweze_prep_2->bindValue(':i_sponsor_p', $spon_access);				 				 
							$igweze_prep_2->bindValue(':i_firstname', $fname);				 				 
							$igweze_prep_2->bindValue(':i_midname', $mname);				 				 
							$igweze_prep_2->bindValue(':i_lastname', $lname);
							
							$igweze_prep_2->execute();

							
						
						}else{ /* student registration is either from excel bulk upload or online registraion admission */
							
							$ebele_mark_2 = "INSERT INTO $i_student_tb (ireg_id, i_stupic, i_accesspass , i_salted, i_sponsor_ac,
											i_sponsor_p, i_firstname, i_midname, i_lastname, i_gender, i_dob, bloodgp,
											genotype, i_country, i_state, i_lga, i_city, i_add_fi, i_add_se,
											i_stu_phone, i_email, i_sponsor, i_spo_phone, i_spo_add)

											 VALUES (:ireg_id, :i_stupic, :i_accesspass , :i_salted, :i_sponsor_ac, :i_sponsor_p,
													 :i_firstname, :i_midname, :i_lastname, :i_gender, :i_dob, :bloodgp, 
													 :genotype,  :i_country, :i_state, :i_lga, :i_city, :i_add_fi,
													 :i_add_se, :i_stu_phone, :i_email, :i_sponsor, :i_spo_phone, :i_spo_add)";
																	
							$igweze_prep_2 = $conn->prepare($ebele_mark_2);
							$igweze_prep_2->bindValue(':ireg_id', $regID);
							$igweze_prep_2->bindValue(':i_stupic', $applyPic);
							$igweze_prep_2->bindValue(':i_accesspass', $userPass);
							$igweze_prep_2->bindValue(':i_salted', $userPass);
							$igweze_prep_2->bindValue(':i_sponsor_ac', $userPass);				 				 
							$igweze_prep_2->bindValue(':i_sponsor_p', $spon_access);				 				 
							$igweze_prep_2->bindValue(':i_firstname', $fname);				 				 
							$igweze_prep_2->bindValue(':i_midname', $mname);				 				 
							$igweze_prep_2->bindValue(':i_lastname', $lname);
							$igweze_prep_2->bindValue(':i_gender', $gender);
							$igweze_prep_2->bindValue(':i_dob', $dob);
							$igweze_prep_2->bindValue(':bloodgp', $bloodGP);
							$igweze_prep_2->bindValue(':genotype', $genoTP);
							//$igweze_prep_2->bindValue(':disability', $disability);
							$igweze_prep_2->bindValue(':i_country', $country);
							$igweze_prep_2->bindValue(':i_state', $state);
							$igweze_prep_2->bindValue(':i_lga', $lga);
							$igweze_prep_2->bindValue(':i_city', $city);
							$igweze_prep_2->bindValue(':i_add_fi', $add1);
							$igweze_prep_2->bindValue(':i_add_se', $add2);
							$igweze_prep_2->bindValue(':i_stu_phone', $phone);
							$igweze_prep_2->bindValue(':i_email', $email);
							$igweze_prep_2->bindValue(':hostel', $hostelID);
							$igweze_prep_2->bindValue(':route', $routeID);
							$igweze_prep_2->bindValue(':i_sponsor', $spon);
							$igweze_prep_2->bindValue(':i_spo_phone', $sphone);
							$igweze_prep_2->bindValue(':i_spon_occup', $soccup);
							$igweze_prep_2->bindValue(':i_spo_add', $adds);
							$igweze_prep_2->execute();
						}
						
                        $ebele_mark_3 = "INSERT INTO $class_one_sdoracle_score_tb  (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_3 = $conn->prepare($ebele_mark_3);
  						$igweze_prep_3->bindValue(':ireg_id', $regID);				 				 
 						$igweze_prep_3->execute();
						
						
						$ebele_mark_3_1 = "INSERT INTO $class_one_sdoracle_comment_tb  (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_3_1 = $conn->prepare($ebele_mark_3_1);
  						$igweze_prep_3_1->bindValue(':ireg_id', $regID);				 				 
 						$igweze_prep_3_1->execute(); 
						

                        $ebele_mark_4 = "INSERT INTO $class_one_sub_score_tb (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_4 = $conn->prepare($ebele_mark_4);
  						$igweze_prep_4->bindValue(':ireg_id', $regID);		 				 
 						$igweze_prep_4->execute();


                        $ebele_mark_5 = "INSERT INTO $class_one_sdoracle_grade_tb (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_5 = $conn->prepare($ebele_mark_5);
  						$igweze_prep_5->bindValue(':ireg_id', $regID);
 						$igweze_prep_5->execute();


                        $ebele_mark_6 = "INSERT INTO $class_one_sdoracle_grand_score_tb (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_6 = $conn->prepare($ebele_mark_6);
  						$igweze_prep_6->bindValue(':ireg_id', $regID);				 				 
 						$igweze_prep_6->execute();


                        $ebele_mark_7 = "INSERT INTO $class_one_class_remarks_tb (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_7 = $conn->prepare($ebele_mark_7);
  						$igweze_prep_7->bindValue(':ireg_id', $regID);				 				 
 						$igweze_prep_7->execute();


                        $ebele_mark_8 = "INSERT INTO $class_two_sdoracle_score_tb  (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_8 = $conn->prepare($ebele_mark_8);
  						$igweze_prep_8->bindValue(':ireg_id', $regID);				 				 
 						$igweze_prep_8->execute();

						
						$ebele_mark_8_1 = "INSERT INTO $class_two_sdoracle_comment_tb  (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_8_1 = $conn->prepare($ebele_mark_8_1);
  						$igweze_prep_8_1->bindValue(':ireg_id', $regID);				 				 
 						$igweze_prep_8_1->execute(); 
						

                        $ebele_mark_9 = "INSERT INTO $class_two_sub_score_tb (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_9 = $conn->prepare($ebele_mark_9);
  						$igweze_prep_9->bindValue(':ireg_id', $regID);		 				 
 						$igweze_prep_9->execute();


                        $ebele_mark_10 = "INSERT INTO $class_two_sdoracle_grade_tb (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_10 = $conn->prepare($ebele_mark_10);
  						$igweze_prep_10->bindValue(':ireg_id', $regID);
 						$igweze_prep_10->execute();


                        $ebele_mark_11 = "INSERT INTO $class_two_sdoracle_grand_score_tb (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_11 = $conn->prepare($ebele_mark_11);
  						$igweze_prep_11->bindValue(':ireg_id', $regID);				 				 
 						$igweze_prep_11->execute();


                        $ebele_mark_12 = "INSERT INTO $class_two_class_remarks_tb (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_12 = $conn->prepare($ebele_mark_12);
  						$igweze_prep_12->bindValue(':ireg_id', $regID);				 				 
 						$igweze_prep_12->execute();

                        $ebele_mark_13 = "INSERT INTO $class_three_sdoracle_score_tb  (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_13 = $conn->prepare($ebele_mark_13);
  						$igweze_prep_13->bindValue(':ireg_id', $regID);				 				 
 						$igweze_prep_13->execute();


						$ebele_mark_13_1 = "INSERT INTO $class_three_sdoracle_comment_tb  (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_13_1 = $conn->prepare($ebele_mark_13_1);
  						$igweze_prep_13_1->bindValue(':ireg_id', $regID);				 				 
 						$igweze_prep_13_1->execute(); 

						
                        $ebele_mark_14 = "INSERT INTO $class_three_sub_score_tb (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_14 = $conn->prepare($ebele_mark_14);
  						$igweze_prep_14->bindValue(':ireg_id', $regID);		 				 
 						$igweze_prep_14->execute();


                        $ebele_mark_15 = "INSERT INTO $class_three_sdoracle_grade_tb (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_15 = $conn->prepare($ebele_mark_15);
  						$igweze_prep_15->bindValue(':ireg_id', $regID);
 						$igweze_prep_15->execute();


                        $ebele_mark_16 = "INSERT INTO $class_three_sdoracle_grand_score_tb (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_16 = $conn->prepare($ebele_mark_16);
  						$igweze_prep_16->bindValue(':ireg_id', $regID);				 				 
 						$igweze_prep_16->execute();


                        $ebele_mark_17 = "INSERT INTO $class_three_class_remarks_tb (ireg_id)

                                         VALUES (:ireg_id)";
				         										
 			    		$igweze_prep_17 = $conn->prepare($ebele_mark_17);
  						$igweze_prep_17->bindValue(':ireg_id', $regID);				 				 
 						$igweze_prep_17->execute();




					if (($igweze_prep_1 == true) && ($igweze_prep_2 == true) && ($igweze_prep_3 == true) && ($igweze_prep_3_1 == true) 
					&& ($igweze_prep_4 == true) && ($igweze_prep_5 == true) && ($igweze_prep_6 == true) 
					&& ($igweze_prep_7 == true) && ($igweze_prep_8 == true) && ($igweze_prep_8_1 == true) && ($igweze_prep_9 == true) 
					&& ($igweze_prep_10 == true) && ($igweze_prep_11 == true) && ($igweze_prep_12 == true)
					&& ($igweze_prep_13 == true) && ($igweze_prep_13_1 == true) && ($igweze_prep_14 == true) && ($igweze_prep_15 == true) 
					&& ($igweze_prep_16 == true) && ($igweze_prep_17 == true)  ){

							if($showNewPanel == $fiVal){ /* check if student registration is from manual input */

									$conn->commit(); /* if everything is alright then insert student data accross tables */
								  	
$newBioData =<<<IGWEZE

        <table width = '100%' border = '0' align = 'center' class='table table-striped table-advance table-hover'>
		<thead><tr><th>Reg No.</th> <th>Name</th><th>Tasks</th></tr></thead> <tbody>
		
  
        <tr>
		
		<td width='30%'> <a href='javascript:;' id='$regNum' class ='viewBioData'>$pre_regnum$regNum </a> </td>
		<td class='text-left' style="text-align:left !important;" width='60%'>
		
		<a href='javascript:;' id='$regNum' class ='viewBioData'> 
		
		<span id = 'loadNewPic-$regNum'> <img src = '$wizGradeDefaultPic' height = '40' width = '40' class='small-picture'> </span>
		<span id = 'loadNewName-$regNum'> $lname $fname $mname  </span> </a> </td>
		
		
		
		<td width='10%'> 
		
		<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
			<i class="fa fa-wrench"></i> <span class="caret"></span></button>
                <ul role="menu" class="dropdown-menu pull-right">
                        <li>
						<a href='javascript:;' id='$regNum' class ='viewBioData'><button class="btn btn-success btn-xs">
						<i class="fa fa-search-plus"></i></button> View</a>
						</li>
						<li class="divider"></li>
						<li>
						<a href='javascript:;' id='$regNum' class ='editBioData'> <button class="btn btn-primary btn-xs">
						<i class="fa fa-edit"></i></button> Edit </a>					
						</li>
						<li class="divider"></li>
						<li>
						<a href='javascript:;' id='$regNum' class ='resetBioData'> <button class="btn btn-danger btn-xs">
						<i class="fa fa-key"></i></button> Reset/Remove</a>						
						</li> 
						
		</div><!-- /btn-group -->
		
		
		</td> </tr>

		

		</tbody></table>
		
		
		$infMsg Student and Parent Password is <strong>$userPass</strong>  $msgEnd
		
IGWEZE;

								    echo $newBioData;
									
									//echo "<script type='text/javascript'> $('.editBioData').trigger('click');</script>";
								
							}elseif($showNewPanel == $seVal){ /* check if student registration is from online registraion admission */
								
									$conn->commit(); /* if everything is alright then insert student data accross tables */
									
									$applyPicture = $applyPSrc.$applyPic;
									
									if (($applyPic != '') && (file_exists($applyPicture))){ 
									
											list($txt, $ext) = explode(".", $applyPic); 
											
											$session_fi = wizGradeSession($conn, $sessionID);
											$session_se = $session_fi + $foreal;  
												
											$newPicPath = $schoolPicDir.$session_fi.'_'.$session_se.'/';
											
											$newPicName  = $regNum . wizGradeRandomString($charset, 10);
											$movePic = $newPicName.".".$ext;
											
											$movePicture = $newPicPath.$movePic;


 											$ebele_mark_up = "UPDATE $i_student_tb 
											
															SET i_stupic = :i_stupic 
															
															WHERE ireg_id = :ireg_id";
				         										
											$igweze_prep_up = $conn->prepare($ebele_mark_up);
											$igweze_prep_up->bindValue(':ireg_id', $regID);
											$igweze_prep_up->bindValue(':i_stupic', $movePic);
											$igweze_prep_up->execute();
						
											copy($applyPicture, $movePicture); 
											
											unlink($applyPicture);		
									
									}
									
									removeRegistraion($conn, $stu_id); /* remove this student information from online registration records */
									$totalRegis = registraionCounter($conn);
							
								$msg_s = "Student <b>($lname $fname $mname)</b> was successfully 
								admitted into $schoolType with new <b> Reg No. $regNum</b>.";
							
							}else{
								
								$conn->rollBack(); /* if everything is not alright then don't insert student data accross tables */
								$msg_e = "Oooooooops Critical Error, Error(490) Has Just Occur, 
								If This Error Persist, Please Contact The Developer Immediately!!!";
		
							}
					

                    }elseif($showNewPanel == $thVal){ /* check if student registration is from mass registraion */
								
									$conn->commit(); /* if everything is alright then insert student data accross tables */

									
$newBioData =<<<IGWEZE
		
  
        <tr>
		
		<td width='30%'> <a href='javascript:;' id='$regNum' class ='viewBioData'>$pre_regnum$regNum </a> </td>
		<td class='text-left' style="text-align:left !important;" width='60%'>
		
		<a href='javascript:;' id='$regNum' class ='viewBioData'> 
		
		<span id = 'loadNewPic-$regNum'> <img src = '$wizGradeDefaultPic' height = '40' width = '40' class='small-picture'> </span>
		<span id = 'loadNewName-$regNum'> $lname $fname $mname  </span> </a> </td>
		
		
		
		<td width='10%'> 
		
		<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
			<i class="fa fa-wrench"></i> <span class="caret"></span></button>
                <ul role="menu" class="dropdown-menu pull-right">
                        <li>
						<a href='javascript:;' id='$regNum' class ='viewBioData'><button class="btn btn-success btn-xs">
						<i class="fa fa-search-plus"></i></button> View</a>
						</li>
						<li class="divider"></li>
						<li>
						<a href='javascript:;' id='$regNum' class ='editBioData'> <button class="btn btn-primary btn-xs">
						<i class="fa fa-edit"></i></button> Edit </a>					
						</li>
						<li class="divider"></li>
						<li>
						<a href='javascript:;' id='$regNum' class ='resetBioData'> <button class="btn btn-danger btn-xs">
						<i class="fa fa-key"></i></button> Reset/Remove</a>						
						</li>
						
                        
						
		</div><!-- /btn-group -->
		
		
		</td>
		
		</tr>
		
IGWEZE;

								    echo $newBioData;
							
							}else{

									$conn->rollBack(); /* if everything is not alright then don't insert student data accross tables */

									$msg_e = "Oooooooops Critical Error, An Unknown Error Has Just Occur, If This Error Persist, 
									Please Contact The Developer Immediately!!!";

							}

?>
