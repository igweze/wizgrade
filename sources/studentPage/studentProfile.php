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
	This page load student profile
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */  

if(!session_id()){
    session_start();
}

		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 

        require 'configwizGrade.php';  /* load wizGrade configuration files */	 
	
	 	 
				
				if($schoolExt == $wizGradeNurAbr){  /* check if school is nursery */
					
					$class = 'class_1, class_2, class_3,';
					
				}else{  /* else normal school */
					
					$class = 'class_1, class_2, class_3, class_4, class_5, class_6,';
				
				}
				
				/* select information */ 
				
				$ebele_mark = "SELECT r.ireg_id, nk_regno, $class s.stu_id, i_stupic, i_firstname, i_lastname, i_midname, 
								i_gender, i_dob, i_country, i_state, i_lga, i_city, i_add_fi, i_add_se, i_stu_phone, i_email,
								i_sponsor, i_spo_phone, i_spo_add, genotype, bloodgp, hostel, route

                     			FROM $i_reg_tb r,  $i_student_tb s

                     			WHERE r.nk_regno = :nk_regno
					 
                     			AND r.ireg_id = s.ireg_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);		
  				$igweze_prep->bindValue(':nk_regno', $regNum);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 

				if($rows_count == $foreal) {  /* check array is empty */
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
	   
						$regNum = $row['nk_regno'];
						$ID = $row['ireg_id'];
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
						$fiClass = $row['class_1'];
						$seClass = $row['class_2'];
						$thClass = $row['class_3'];
						$foClass = $row['class_4'];
						$fifClass = $row['class_5'];
						$sixClass = $row['class_6'];
						$hID = $row['hostel'];
						$rID = $row['route'];
						
					}	

					if (is_null($pic)){
			
						$studentPic = $wizGradeDefaultPic;

					}else{
					
						$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$pic;

					}
					
					if ((is_null($studentPic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }  /* check if picture exists */
					$genderM = $gender_list[$gender];
					$bloodGroup = $bloodgr_list[$bloodGP];
					$genoType = $genotype_list[$genoTP];
					
					$levelArray = studentLevelsArray($conn); /* student level array */
					
					$levelOne = $levelArray[0]['level'];
					$levelTwo = $levelArray[1]['level'];
					$levelThree = $levelArray[2]['level'];
					$levelFour = $levelArray[3]['level'];
					$levelFive = $levelArray[4]['level'];
					$levelSix = $levelArray[5]['level'];
					
					if($hID != ""){
						
						$hostelInfoArr = wizGradeHostelInfo($conn, $hID);  /* school hostel information  */
						$hostel = $hostelInfoArr[$fiVal]['hostel'];
						
					}
					
					if($rID != ""){
						
						$routeInfoArr = wizGradeRouteInfo($conn, $rID);  /* school route information  */
						$route = $routeInfoArr[$fiVal]['route'];
						
					}
					
					if($schoolExt == $wizGradeNurAbr){  /* check if school is nursery */
					
$classInfo =<<<IGWEZE
		

						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-bars"></i> $levelOne </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$fiClass</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-bars"></i> $levelTwo </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$seClass</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-bars"></i> $levelThree </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$thClass</td> </tr>
					
					
IGWEZE;
					
					}else{
					
$classInfo =<<<IGWEZE
		
 							  
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-bars"></i> $levelOne </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$fiClass</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-bars"></i> $levelTwo </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$seClass</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-bars"></i> $levelThree </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$thClass</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-bars"></i> $levelFour </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$foClass</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-bars"></i> $levelFive </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$fifClass</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-bars"></i> $levelSix </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$sixClass</td> </tr>
				
					
IGWEZE;

					}
								

				
		?>

				<!-- page start-->
			
					<div class="row profile">
					<div class="col-md-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <i class="fa fa-user-plus fa-lg"></i> Student Profile <span class="hide-res">Manager</span>
							 <span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
                          <div class="panel-body wizGrade-line">
						  
					<div class="col-md-3 wizGrade-linea">
						<div class="profile-sidebar">
							<!-- sidebar user picture -->
							<div class="profile-userpic">
								<img src="<?php echo $studentPicture; ?>" height="120px" width="120px" class="img-responsive"  alt="">
							</div>
							<!-- sidebar user picture end  -->
							<!-- sidebar user title start  -->
							<div class="profile-usertitle">
								<div class="profile-usertitle-name">
									<?php echo "$fname $mname $lname"; ?>
								</div>
								<div class="profile-usertitle-job">
									Profile Details
								</div>
							</div>
							<!-- sidebar user title end  -->
							 
							<!-- sidebar profile menu start  -->
							<div class="profile-usermenu">
								<ul class="nav">
									<li class="active wizGradeMenu">
										<a href="javascript:;" id="myProfile">
										<i class="glyphicon glyphicon-home"></i>
										Overview </a>
									</li>
									<li>
										<a href="javascript:;" id="<?php echo $regNum; ?>" class ='editBioData'>
										<i class="glyphicon glyphicon-user"></i>
										Edit Profile </a>
									</li>
									<!--<li>
										<a href="javascript:;" target="_blank">
										<i class="glyphicon glyphicon-ok"></i>
										Tasks </a>
									</li>-->
									 
								</ul>
							</div>
							<!-- sidebar profile menu end  -->
						</div>
					</div>
					<div class="col-md-9  mob-gap" id="scrollTargetMPage">
						<div class="profile-content wizGrade-linea" id="wizGradeRightHalf" > 
              
<?php
        
$table =<<<IGWEZE
		
						<div id = 'wizGradePrintArea'>
								   
						<div class="profile-content-heading">
								<img src = "$studentPicture" height = '100' width = '100' id='wizGradeStudentPic' class='img-circle'>   
								$fname $mname $lname Bio Data  ($pre_regnum$regNum)
						</div>
										  
						<!-- table -->
						<table width = '100%' border = '0' align = 'center' class="table table-striped"> 

						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-book"></i> Reg</td> <td style="padding-left: 30px !important; text-align:left; width: 70%;"> 
						$pre_regnum$regNum </td></tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-user"></i> Name </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">$lname 
						$fname $mname </td> </tr>
						
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-user"></i> Gender </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">$genderM
						</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-calendar"></i> Date Of Birth</td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$date</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-flag"></i> Country<span class="hide-res">/Nationality<span> </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$country</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-home"></i> State<span class="hide-res">/Province<span> </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$state</td> </tr>
						<!--
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-home"></i> LGA</td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">$lga</td> </tr>
						-->
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-home"></i> City </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">$city</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-home"></i> Address </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$add1</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-home"></i> Address 2 </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$add2</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-phone"></i> Phone Number </td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$phone</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-envelope"></i> Email</td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$email</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-user"></i> Sponsor Name</td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$spon</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-home"></i> Sponsor Address</td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$adds</td> </tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-phone"></i> Sponsor Phone</td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$sphone</td> </tr>
						
						<tr>
						<th class = 'head' align = 'center' colspan = '2'><center> <i class="fa fa-cubes"></i>
						$lname Class Information  </center></th>
						</tr>
						$classInfo
						<tr>
						<th class = 'head' align = 'center' colspan = '2'><center> <i class="fa fa-medkit"></i>
						$lname Medical Information </center></th>
						</tr>

						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-medkit"></i> Blood Group</td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$bloodGroup</td> </tr>

						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-medkit"></i> Genotype</td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$genoType</td> </tr>
						
						<tr>
						<th class = 'head' align = 'center' colspan = '2'><center> <i class="fa fa-road"></i>
						$lname  Hostel & Transport Route  </center></th>
						</tr>
						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-building-o"></i> Hostel Name</td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$hostel</td> </tr>

						<tr><th style="padding-left: 30px !important; text-align:left; width: 30%;">
						<i class="fa fa-road"></i> Transport Route</td> <td style="padding-left: 30px !important; text-align:left; width: 70%;">
						$route</td> </tr> 
					   
						</table> 		  
						<!-- / table -->               

					   
						</div>
		
IGWEZE;

						echo $table;
				
				}else{  /* display error */ 
				
					$msg_e =  "Ooooooooops, student record was not found.";
					echo $errorMsg.$msg_e.$eEnd;  exit;
					
				}

?>
			
				</div>
					</div>
				</div>
			 
			</div>
                 </section>
					</div>
            <!-- page end-->
			  
			  
			<script type='text/javascript'> $('.wizgrade-page-icons').fadeIn(200); $('.slide-page').fadeOut(5); $('.printer-icon').fadeIn(200); 	 </script>