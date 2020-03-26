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
	This page show main admin profile information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

 
				$ebele_mark = "SELECT  a_title, a_fname, a_lname, a_mname, a_picture,
								a_gender, a_dob, a_mstatus, a_country, a_state, a_lga, a_city, a_paradd, 
								a_temadd, a_phone, a_mail, a_grade,
								a_sponsor, a_spo_phone, a_spo_add, genotype, bloodgp

                     			FROM $adminAccessTB

                     			WHERE admin_id = :admin_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);	
  				$igweze_prep->bindValue(':admin_id', $adminID);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 

				if($rows_count == $foreal) {
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$title = $row['a_title'];					
						$fname = $row['a_fname'];
						$lname = $row['a_lname'];
						$mname = $row['a_mname'];
						$picture = $row['a_picture'];
						$gender = $row['a_gender'];
						$date = $row['a_dob'];
						$mstatus = $row['a_mstatus'];
						$country = $row['a_country'];
						$state = $row['a_state'];
						$lga = $row['a_lga'];
						$city = $row['a_city'];
						$add1 = $row['a_paradd'];
						$add2 = $row['a_temadd'];
						$phone = $row['a_phone'];
						$email = $row['a_mail'];
						$grade = $row['a_grade'];
						$spon = $row['a_sponsor'];
						$sphone = $row['a_spo_phone'];
						$adds = $row['a_spo_add'];
						$bloodGP = $row['bloodgp'];
						$genoTP = $row['genotype'];
					
					}	


					$titleVal = $title_list[$title];
					$bloodGroup = $bloodgr_list[$bloodGP];
					$genoType = $genotype_list[$genoTP];

					if ( (is_null($picture)) || ($picture == '') || (!file_exists($wizGradeAdminPicDir.$picture)) ){   /* check if picture exists */
								$adminPic = $wizGradeDefaultPic; }
					else { $adminPic = $wizGradeAdminPicDir.$picture; }
				   
					if($email == ''){ $adminMail = ''; }
					else {$adminMail = $email.'@wizgrade.com'; }
				
		?>

				<!-- page start-->
			 
					<div class="row profile">
					<div class="col-md-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <i class="fa fa-user-plus fa-lg"></i>  Admin Profile
							 <span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
                          <div class="panel-body wizGrade-line">
						  
					<div class="col-md-3 wizGrade-line">
						<div class="profile-sidebar ">
							<!-- sidebar user picture -->
							<div class="profile-userpic">
								<img src="<?php echo $adminPic; ?>" height="120px" width="120px" class="img-responsive"  alt="">
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
										<a href="javascript:;" id="showAdminBio">
										<i class="glyphicon glyphicon-home"></i>
										Overview </a>
									</li>
									<li>
										<a href="javascript:;" class="editAminBio">
										<i class="glyphicon glyphicon-user"></i>
										Edit Profile </a>
									</li>
									<li>
										<a href="#" target="_blank">
										<i class="glyphicon glyphicon-ok"></i>
										Tasks </a>
									</li>
									 
								</ul>
							</div>
							<!-- sidebar profile menu end  -->
						</div>
					</div>
					<div class="col-md-9">
						<div class="profile-content wizGrade-line" id="adminBioDiv"> 
        
<?php


					$maritalStatus = $mslist[$mstatus];
				 
$staffBio =<<<IGWEZE
		
					<div id = 'wizGradePrintArea'>
					 
						<!-- table -->
						<table width = '100%' border = '0' align = 'center' class="digit-table table table-striped table-advance table-hover">

						<tr>
						<th class = 'head' align = 'center' colspan = '2'><center> <i class="fa fa-user"></i>
						 ADMIN $fname $mname $lname Profile </center></th>
						</tr> 
						<tr><td style="padding-left: 10px;" colspan = '2'><center><img src = "$adminPic" height = '110' width = '110' 
														class= 'img-responsive img-circle' id='wizGradeStudentPic'> </center>
						</td></tr>
						

						<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
						<i class="fa fa-user"></i> Title</td> <td style="padding-left: 3% !important; text-align:left; width: 70%;"> $titleVal 
						</td></tr>
					   
						
						<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
						<i class="fa fa-user"></i> Name </td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">
						$lname $fname $mname </td> </tr>
						<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
						<i class="fa fa-user"></i> Gender </td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">$gender</td> </tr>
						<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
						<i class="fa fa-calendar"></i> Date Of Birth</td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">
						$date</td> </tr>
						<tr><th style="padding-left: 3% !important; text-align:left; width: 30%;">
						<i class="fa fa-user"></i> Marital Status </td> <td style="padding-left: 3% !important; text-align:left; width: 70%;">
						$maritalStatus</td> </tr>
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
						
						</table> 
						<!-- /table -->
						
					</div>
		
IGWEZE;

					echo $staffBio;
				
				}

		?>
			
     </div>
					</div>
				</div>
			 
			</div>
                 </section>
					</div>
              <!-- page end-->