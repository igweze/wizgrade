<?php

/*   
	Copyright (C) fobrain Tech LTD (2014 - 2024) - All Rights Reserved
	
	Licensed under the Apache License, Version 2.0 (the 'License');
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an 'AS IS' BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License	
	 
	#####################################################################################################
	fobrain (wizgrade open source) app is designed & developed by Igweze Ebele Mark for fobrain Tech LTD
	#####################################################################################################

	fobrain is Dedicated To Almighty God, My fabulous FAMILY and Amazing Parents.  
	
	WEBSITE 							PHONES/WHATSAPP					EMAILS
	https://www.fobrain.com				+234 - 80 30 716 751  			opensource@fobrain.com
										+234 - 80 22 000 490 	
	
	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Page/Code Explanation~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	This page load staff profile
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */  

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 	 
	 
				 
			try {
		 				
				$teacherID = strip_tags($_REQUEST['teacherID']);

				/* select staff profile */ 	
				
  				$ebele_mark = "SELECT t_id, i_title, i_picture, i_sign, i_firstname, i_lastname, i_midname, i_gender, i_dob, 
								i_country, i_state, i_lga, i_city, i_add_fi, i_add_se, i_phone, i_email, i_sponsor, 
								i_spo_phone, i_spo_add,
								genotype, bloodgp, rank

                     FROM $staffTB

                     WHERE t_id = :t_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
  				$igweze_prep->bindValue(':t_id', $teacherID);
 				$igweze_prep->execute();
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {  /* check array is empty */

					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
	   
						$t_id = $row['t_id'];
						$pic = $row['i_picture'];
						$signPic = $row['i_sign'];
						$title = $row['i_title'];
						$fname = $row['i_firstname'];
						$lname = $row['i_lastname'];
						$mname = $row['i_midname'];
						$sex = $row['i_gender'];
						$dateofbirth = $row['i_dob'];
						$country = $row['i_country']; 
						$state = $row['i_state'];
						$lga = $row['i_lga'];
						$city = $row['i_city'];
						$add1 = $row['i_add_fi'];
						$add2 = $row['i_add_se'];
						$phone = $row['i_phone'];
						$email = $row['i_email'];
						$sponsor = $row['i_sponsor'];
						$sponsorP = $row['i_spo_phone'];
						$sponsorA = $row['i_spo_add'];
						$bloodGP = $row['bloodgp'];
						$genoTP = $row['genotype'];
						$ranking = $row['rank'];
					
					}	

					$staffPic = $staffPicExt.$pic;

					if ((is_null($pic)) || !file_exists($staffPic)){ $staffPic = $wizGradeDefaultPic; }
					
					$teacherSign = $teachersSignExt.$signPic;
		
					if ((is_null($signPic)) || ($signPic == '') || (!file_exists($teacherSign))){ $teacherSign = $wizGradeDefaultPic; }	

					$genderM = $gender_list[$sex];
					$bloodGroup = $bloodgr_list[$bloodGP];
					$genoType = $genotype_list[$genoTP];
					 
					$titleVal = $title_list[$title];
					
					$formTeacherArray = formTeachersArrays($conn, $t_id);  /* assign class teacher array */ 	
					$fteacherCount = count($formTeacherArray);
					
					if($fteacherCount >= $foreal){  /* check array is empty */
						
						$formtTable .= "<tr>
							<th class = 'head' align = 'center' colspan = '2'><center> <i class='fa fa-book'></i>
							Class Moderating (Form Teacher) </center></th>
							</tr>";		
						$levelArray = studentLevelsArray($conn); /* student level array */
						
						array_unshift($levelArray,"");
						unset($levelArray[0]);

						for($i = $fiVal; $i <= $fteacherCount; $i++){  /* loop array */
									
							$tID = $formTeacherArray[$i]["t_id"];
							$sessionID = $formTeacherArray[$i]["session"];
							$levelID = $formTeacherArray[$i]["level"];
							$classID = $formTeacherArray[$i]["class"];								
							
							$classKey = array_search($classID, $class_list);
							$clArray = studentClassArray($conn, $levelID);  /* retrieve student class array */
							$classArray = unserialize($clArray);
							
							$wizGradeClass = $classArray[$classKey];

							$session_fi = wizGradeSession($conn, $sessionID);						

							$session_se = $session_fi + $foreal;  
							$classLevel = $levelArray[$levelID]['level'];
		
							$formtTable .= '<tr><td style="text-align:center;"
							colspan="2">
							<i class="fa fa-cogs"></i> 
							'.$classLevel.' Class '.$wizGradeClass.', '.$session_fi.' - '. $session_se.'
							Session</td> </tr>
							'; 

						}				
					
					} 

					$subjectsArray = subjectTeacherArrays($conn, $t_id);  /* school staff subjects array */	
					$steacherCount = count($subjectsArray);
					
					if($steacherCount >= $foreal){  /* check array is empty */
						
						$subtTable .= "<tr>
							<th class = 'head' align = 'center' colspan = '2'><center> <i class='fa fa-book'></i>
							Subject/s Assign To Me</center></th>
							</tr>
							<tr><th style='padding-left: 3% !important; text-align:left; width: 30%;'>
								<i class='fa fa-book'></i> Subject/s </td> <th style='padding-left: 3% !important; text-align:left; 
								width: 70%;'>
								Class </th> </tr>";		
						$levelArray = studentLevelsArray($conn); /* student level array */
						
						array_unshift($levelArray,"");
						unset($levelArray[0]);

						for($i = $fiVal; $i <= $steacherCount; $i++){  /* loop array */
									
							$tID = $subjectsArray[$i]["t_id"];
							$subID = $subjectsArray[$i]["sub_id"];
							$sessionID = $subjectsArray[$i]["session"];
							$levelID = $subjectsArray[$i]["level"];
							$classID = $subjectsArray[$i]["class"];	
							
							$subjectName = schoolSubject($conn, $subID);  /* school subjects information */
							
							$classKey = array_search($classID, $class_list);
							$clArray = studentClassArray($conn, $levelID);  /* retrieve student class array */
							$classArray = unserialize($clArray);
							
							$wizGradeClass = $classArray[$classKey];

							$session_fi = wizGradeSession($conn, $sessionID);  /* school session  */						

							$session_se = $session_fi + $foreal;  
							$classLevel = $levelArray[$levelID]['level'];
		
							$subtTable .= '<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-book"></i> '.$subjectName.'
							</th><td style="padding-left: 3% !important; text-align:left; width: 70%;">
							'.$classLevel.' Class '.$wizGradeClass.', '.$session_fi.' - '. $session_se.'
							Session </td> </tr>
							'; 

						}				
					
					}
					
				
		
				

$table =<<<IGWEZE
				
						<div id = 'wizGradePrintArea'>

							<table width = '100%' class="table table-striped table-advance table-hover">

							<tr>
							<th class = 'head' align = 'center' colspan = '2'><center> <i class="fa fa-user"></i>
							$lname $fname $mname Profile Information  </center></th>
							</tr> 
							<tr><td style="padding-left: 10px;" colspan = '2'><center><img src = "$staffPic" height = '110' width = '110' 
															class= 'img-responsive img-circle' id='wizGradeStudentPic'> </center>
							</td></tr> 
							
							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-user"></i> Name </td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">
							$titleVal $lname $fname $mname </td> </tr>
							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-user"></i> Gender </td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">$genderM</td> </tr>
							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-calendar"></i> Date Of Birth</td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">
							$dateofbirth</td> </tr>
							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-flag"></i> Country/Nationality </td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">$country
							</td> </tr>
							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-home"></i> State/Province </td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">
							$state</td> </tr>
							<!--
							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-home"></i> LGA</td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">$lga</td> </tr>
							-->
							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-home"></i> City </td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">$city</td> </tr>
							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-home"></i> Address </td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">$add1</td> </tr>
							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-home"></i> Address 2 </td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">$add2</td> </tr>
							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-phone"></i> Phone Number </td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">$phone
							</td> </tr>
							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-envelope"></i> Email</td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">$email</td> </tr>
							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-user"></i> Next of Kin Name</td> <td style="padding-left: 3% !important; text-align:left; width: 70%;"
							>$sponsor</td> </tr>
							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-home"></i> Next of Kin Address</td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">
							$sponsorA</td> </tr>
							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-phone"></i> Next of Kin Phone</td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">
							$sponsorP</td> </tr>
							
							<tr>
							<th class = 'head' align = 'center' colspan = '2'><center> <i class="fa fa-medkit"></i>
							$lname Medical Information </center></th>
							</tr>

							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-medkit"></i> Blood Group</td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">
							$bloodGroup</td> </tr>

							<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
							<i class="fa fa-medkit"></i> Genotype</td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">
							$genoType</td> </tr>

							$formtTable
							
							$subtTable
							
							<tr><td style="padding-left: 10px;" colspan = '2'><center>
							<img src = "$teacherSign" height = '100' width = '100'> </center>
							</td></tr>   
							
							</table> 
							<!-- / table -->
				
							$sdo_tb_footerBio
				
						</div>
		
IGWEZE;
						echo $table;
					
						echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";
				

				}else{  /* display error */ 
				
					$msg_e =  "Ooooooooops, staff record was not found.";
					
					
				}
				
			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
		
			if ($msg_e) {

				echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; 
				echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>"; exit;  

			}
			
exit;			
?>