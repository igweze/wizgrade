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
	This script load staff access cpanel
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

      	require 'configINwizGrade.php';  /* load wizGrade configuration files */
		
		if ($_REQUEST['staff'] != '') {

		 
			try {
		 				
				$staffID = strip_tags($_REQUEST['staff']);
				
				/* script validation */
				
				if($staffID == ""){
					
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";
					$msg_e =  "Ooooooooooops, staff record was not found.";
					
				}else{  /* select staff profile */	

					$ebele_mark = "SELECT t_id, staff_id, i_title, i_picture, i_firstname, i_lastname, i_midname 
					
									FROM $staffTB
									
									WHERE t_id = :t_id";
						 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':t_id', $staffID);
					 
					$igweze_prep->execute();
					
					$rows_count = $igweze_prep->rowCount(); 
					
					if($rows_count == $foreal) {  /* check array is empty */
					
						while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
		   
							$t_id = $row['t_id'];
							$staffID = $row['staff_id'];
							$title = $row['i_title'];
							$pic = $row['i_picture'];
							$fname = $row['i_firstname'];
							$lname = $row['i_lastname'];
							$mname = $row['i_midname']; 
						
						}	 
				 
						$serial_no = $foreal++;
										
						$titleVal = $title_list[$title];				
						$teacherPic = $staffPicExt.$pic;

						if ((is_null($pic)) || !file_exists($teacherPic)){ $teacherPic = $wizGradeDefaultPic; }
						
						if(($admin_grade == $adminGrade) && ($admin_level == $adminGradeInt)) {  /* check if school admin */		 
						
							$msg_w = "*<img src = '$teacherPic' height = '70' width = '90' 
							class= 'img-responsive img-circle pull-left' style='margin:0px 10px 0px 10px' id='wizGradeStudentPic' > 
							Do you really want to remove <strong>$lname $fname $mname</strong> information from school database. 
							Please Note that is an irreversible action. To continue, Please enter your password below";
					
				
				        
$staffInfo =<<<IGWEZE

							
							<div id = 'wizGradePrintArea' class='staffSectionDiv'>
								<!-- table -->
								<table width = '100%' border = '0' align = 'center' class="digit-table table table-striped table-advance table-hover">

								<tr>
								<th class = 'head' align = 'center' colspan = '3'><center> <i class="fa fa-user"></i>
								$lname $fname $mname Profile Information  </center></th>
								</tr>
								<tr><td style="padding-left: 10px;" colspan = '3'><center><img src = "$teacherPic" height = '150' width = '150' 
								class= 'img-responsive img-circle' id='wizGradeStudentPic'> </center>
								</td></tr> 

								<tr id="staffUserTR"><th style="padding-left: 30px; text-align:left; width: 30%;">
								<i class="fa fa-user-circle"></i> Staff ID </th> 
								<th style="padding-left: 5px; text-align:left; width: 50%;" > <span id='msgC'></span>
									<div class="form-group">

									<div class="col-lg-12">
									<div class="iconic-input">
									<i class="fa fa-user-circle"></i>
									<input type="text" class="form-control"
									name="staffUser" id="staffUser" placeholder ="Change Staff ID"
									value="$staffID" maxlength="15"
									required />
									<div id="staffID" style="display:none;">$t_id</div>
									</div>
									</div>
									</div>
								</th>
								<th style="padding-left: 5px; text-align:left; width: 20%;"> 
								<a href='javascript:;' id='$t_id' class ='changeStaffID demoDisenable'> <button class="btn btn-success btn-sm">
								<i class="fa fa-save"></i> Save </button> </ a>
								</th>

								</tr>

								<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
								<i class="fa fa-lock"></i> Staff Password </th> 
								<td style="padding-left: 30px; text-align:left; width: 55%;"> <div id="stuPassDiv"> $stuAcesss </div></td>
								<th style="padding-left: 5px; text-align:left; width: 15%;"> 
								<a href='javascript:;' id='$t_id' class ='resetStaffPass demoDisenable'> <button class="btn btn-info btn-sm">
								<i class="fa fa-refresh"></i> Reset</button> </ a>
								</th> </tr>


								<tr><th style="padding-left: 30px; text-align:left; width: 30%;" colspan="2">
								<i class="fa fa-exclamation-triangle"></i> Deactivate/Remove Staff </th> 

								<th  style="padding-left: 5px; text-align:left; width: 30%;"> 
								<a href="#removeStaffModal" data-toggle="modal" > <button class="btn btn-danger btn-sm">
								<i class="fa fa-times"></i> Remove</button> </a>
								</th> </tr>


								</table>
								<!-- / table -->
								$sdo_tb_footerBio

							</div>

							<!-- staff removal pop up modal start -->
							<div class="modal fade" id="removeStaffModal" tabindex="-1" role="dialog"  aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
									<button type="button" class="close" 
									data-dismiss="modal" aria-hidden="true">
									<span style='color:#fff !important;'>&times;</span></button>
									<h4 class="modal-title"> Are sure you want to Remove Staff ?
									</h4>
								</div>
								<div class="modal-body">

								<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="reSLoader"  
								style="cursor:pointer; display:none; margin-bottom:5px;" /></center>

								<div id="wizGradeRMsg"> </div>
								<div class="staffSectionDiv">
								
									<section class="panel">

									<div class="panel-body">

										$warnMsg $msg_w $msgEnd

										<br clear= "all"/><br clear= "all"/><br clear= "all"/>

										<div class="form-group">
											<div class="col-lg-12"> <div class="iconic-input"> <i class="fa fa-key"></i>
											<input type="password" class="form-control"
											name="adminPass" id="adminPass" placeholder ="Please enter Admin Authorisation Password"
											required />
											<div id="staffID" style="display:none;">$t_id</div>
											</div>
											</div>
										</div>

									</div>

									</section>

								</div>

								</div>
								<div class="modal-footer"  id="reRegFooter">
								<button class="btn btn-danger demoDisenable" id="removeStaff" type="button">Yes</button>
								<button data-dismiss="modal" class="btn btn-danger" type="button">Cancel</button>
								</div>
								</div>
								</div>
							</div>
							<!-- staff removal pop up modal end -->
		
IGWEZE;

							echo $staffInfo;
				
							echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";
					
						}
					
				

					}else{  /* display error */
					
						echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";
						$msg_e =  "Ooooooooooops, staff record was not found.";
		
		
					}
					
				}
				
			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
		
		}else{ 
					
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
		} 
	
		if ($msg_e) {

         	echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 						

        }
		
exit;		
?>