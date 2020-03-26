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
	This script handle new student registration
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	   
		 
		      
		if ($_REQUEST['newBioData'] == 'newStuBioData') {
 
				$regNum =  $_REQUEST['newRegNum'];
				$fname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['fname']);
				$mname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['mname']);
				$lname = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['lname']);				
				$sessData =  $_REQUEST['sess'];
 
				$class =  $_REQUEST['class'];
				$en_term =  $_REQUEST['term'];
			 
				$regDate =  date("Y-m-d H:i:s"); //strtotime(date("Y-m-d H:i:s"));
				
				list ($session, $en_level) = explode ("#@@#", $sessData);
				
				/* script validation */
				
				if ($regNum == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter new student Reg No";
					
	   			}elseif (studentExitsRV($conn, $regNum) == $foreal)  {  /* check if a student really exist */
         		
					$msg_e .= "* Oooooooops Error, Student with this <b>
					Reg No $pre_regnum $regNum </b>already 
					exists in database";
	   			
				}elseif ($lname == "")  {
         		
					$msg_e .= "* Oooooooops Error, please enter student first name ";
	   			
				}elseif($fname == "")   {
         		
					$msg_e  = "* Oooooooops Error, please enter student' s last name  ";
	   			
				}elseif ($session == "")  {
         		
					$msg_e .= "* Oooooooops Error, please select new student class";
	   			
				}elseif($en_level == "")   {
         		
					$msg_e  = "* Oooooooops Error, please select new student class";
	   			
				}elseif($en_term == "")   {
         		
					$msg_e  = "* Oooooooops Error, please enter student' s entry term";
	   			
				}else {  /* insert information */ 

       				$e_status = strip_tags($e_status);  $regNum = strip_tags($regNum); 

       				$e_status = trim($e_status);  $regNum = trim($regNum); 
					
					$sessionID = sessionID($conn, $session); /* school session ID  */


		 			try {
						
							echo '<!-- row -->
							<div class="row">
							        <div class="col-lg-5">
										<section class="panel" id="wizGradeScrollTargetSE">
										<header class="panel-heading">
											<i class="fa fa-user-plus fa-lg"></i> New Student Info
											<span class="tools pull-right">
												<a href="javascript:;" class="fa fa-chevron-down"></a>
												<a href="javascript:;" class="fa fa-times"></a>
											</span>
										</header>
										<div class="panel-body wizGrade-line">';


											mt_srand((double)microtime() * 1000000);
											

											if($generatePass == $foreal){  /* check generate password status */
							
												$userPass = wizGradeRandomString($charset, 8);  /* generate password */
												$spon_access = wizGradeRandomString($charset, 5);  /* generate password */
							
											}else{
							
												$userPass = "password";
												$spon_access = "password";
							
											} 
											
											$showNewPanel = $fiVal;
											
											if($schoolExt == $wizGradeNurAbr){  /* check school type */
												
												require_once ($wizGradeAdminDir.'wizGradeNurBio.php');  /* school registration script */
												
											}else{
											
												require_once ($wizGradeAdminDir.'wizGradePSBio.php');  /* school registration script */
											}
							
							echo '</div>
        
								</section>
        
							</div>	
        
        
								<div class="col-lg-7">
									<section class="panel" id="wizGradeScrollTarget">
         
					         		<header class="panel-heading">
										<i class="fa fa-wrench fa-lg"></i>  Student Profile Tasks 
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
        
        					</div>
							<!-- / row -->';
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		 
        	
				}
			
						echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */  </script>";

			
		}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
		}


			
		if ($msg_s) {

			echo $succMsg.$msg_s.$msgEnd; exit;
									
        }	


		if ($msg_e) {

			echo $erroMsg.$msg_e.$msgEnd; exit;
									
        }	
			
exit;
?>