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
	This script send text message to students, parents and staffs
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */
		         
				 
			if ($_REQUEST['sendTextMsg'] == 'sendSMS') {  /* send SMS to selected parents/students  */

				$sendTo = preg_replace("/[^0-9]/", "", $_REQUEST['sendTo']);			
				$studentData = $_REQUEST['studentData'];
				$sentMsg = preg_replace("/[^A-Za-z0-9@%?+. ]/", "", $_REQUEST['message']);
				
				$sentMsg = strip_tags($sentMsg);
				
				/* script validation */ 				
				
				if ($sendTo == ""){
         			
					$msg_e = "* Ooooooooops Error, please selec which people to sent message to";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}elseif ($studentData == "")  {
         			
					$msg_e = "* Oooooooops Error, please select student/guardian";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}elseif ($sentMsg == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter  message to send";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}else {  /* send SMS to selected parents/students  */       			

		 			try {
						
						$smsCArr = smsCurrentGateway($conn);  /* current text message and gateway information */
						
						$sID = $smsCArr[$fiVal]["sID"];
						$gateway = $smsCArr[$fiVal]["gateway"];
						$senderID = $smsCArr[$fiVal]["senderID"];
						$user = $smsCArr[$fiVal]["user"];
						$password = htmlspecialchars_decode($smsCArr[$fiVal]["password"]);
						$api = $smsCArr[$fiVal]["api"];
						$status = $smsCArr[$fiVal]["status"];										
						$status = $onOffArr[$status];
						
						if($sID  >= $fiVal){  /* if current gateway is not empty  */
																
							$balance = wizGradeSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbHead =<<<IGWEZE

							<!-- row -->
							<div class="row">
								<div class="col-lg-12">
								  <section class="panel">
									  <header class="panel-heading">
										  Sent SMS Summary and Reports
										  <span class="tools pull-right">
											<a class="fa fa-chevron-down" href="javascript:;"></a>
											<a class="fa fa-times" href="javascript:;"></a>
										</span>
									  </header>
									  <div class="panel-body profile-activity">
										 
										  <div class="activity blue">
											  <span>
												  <i class="fa fa-bullhorn"></i>
											  </span>
											  <div class="activity-desk">
												  <div class="panel">
													  <div class="panel-body">
														  <div class="arrow"></div>
														  <i class=" fa fa-comment-o"></i>
														  <h4> SMS  Balance Before Sending - $balance</h4>
														  <p> $sentMsg</p>
													  </div>
												  </div>
											  </div>
										  </div>

										  

									  </div>
								  </section>
							  </div>
						  
						  
							<script type='text/javascript'> $('#paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ </script>
							
							<div class="col-lg-12">
								  <section class="panel">
								  
							<!-- table -->				
							<table width = '100%'  class='table table-striped  table-advance table-hover' id='wizGradeTBPage'>
									<thead>
									
									<tr>
									<th class='text-left'>S/N</th> 
									<th class='text-left'>Student Infomation</th> 
									<th class='text-left'>Reg No.</th> 
									<th class='text-left'>Phone Number</th> 
									<th class='text-left'>SMS Reports</th> 
									</tr>
									</thead> <tbody>
IGWEZE;
									
									echo $tbHead;
									
									$studentArr =  explode(',', $studentData);										

									foreach ($studentArr as $studentInfo) {										
										
										list($studentName, $regNo) = explode("-", $studentInfo);
										$studentName = trim($studentName);
										$regNo = trim($regNo);
										
										$stuData = studentSMSInfo($conn, $regNo);  /* students SMS record information  */ 
										list ($fullName, $stuPhone, $spoPhone, $studentPic) = explode ("@##@", $stuData);
										if($sendTo == $fiVal){ $receiver = $spoPhone;}
										elseif($sendTo == $seVal){ $receiver = $stuPhone;}
										else{ $receiver = ""; } 
										
										if($receiver == ""){  /* if receiver is empty display information message */ 
											
											$reports = '<button type="button" class="btn btn-white"> 
											<i class="fa fa-exclamation-triangle"></i> Message Not Sent </button>';
											$receiver = '<button type="button" class="btn btn-white"> 
											<i class="fa fa-exclamation-triangle"></i> Phone No. Empty </button>';
											
										}else{	
											
											  /* send text message through current gateway */ 
											$reports = wizGradeSendSMS($api, $senderID, $user, $password, $receiver, $sentMsg, $sID);
										
										}
										
										$serailNo++;

$sendReports =<<<IGWEZE
        
										<tr>
										<td class='text-left' width="5%">$serailNo</td> 
										<td class='text-left' width="30%"><img src = '$studentPic' 
										height = '40' width = '40' class='small-picture'> </span> $fullName </td> 
										<td class='text-left' width="20%"> $regNo</td> 		
										
										<td class='text-left' width="20%"> $receiver  </td> 
										 
										<td class='text-left' width="25%"> $reports </td> 
										
										</tr>
		
IGWEZE;
                               
										echo $sendReports;
										
										
									}


									$balanceAF = wizGradeSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbTail =<<<IGWEZE

								</tbody></table>
								<!-- / table -->
								</section>
							</div> 			 
							
							<div class="col-lg-12">
								  <section class="panel">
									  <div class="panel-body profile-activity">
										 
										  <div class="activity blue">
											  <span>
												  <i class="fa fa-bullhorn"></i>
											  </span>
											  <div class="activity-desk">
												  <div class="panel">
													  <div class="panel-body">
														  <div class="arrow"></div>
														  <i class=" fa fa-comment-o"></i>
														  <h4> SMS  Balance After Sending - $balanceAF</h4>
														  <p> $sentMsg</p>
														  
													  </div>
												  </div>
											  </div>
										  </div>
 
									  </div>
									</section>
								</div>
						  
						  
							</div>
							<!-- / row -->
IGWEZE;
									
										echo $tbTail;
										
										
										
						}else{  /* display error */

							$msg_e = "* Oooooooops Error, please configure or set your default sms gateway before you can send SMS.";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
										
						}	
									
						
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
         		
        	
				}
			
			}elseif ($_REQUEST['sendTextMsg'] == 'sendCSMS') {  /* send SMS to all class parents/students  */

				$sendTo = preg_replace("/[^0-9]/", "", $_REQUEST['sendTo']);			
				$sentMsg = preg_replace("/[^A-Za-z0-9@%?+. ]/", "", $_REQUEST['message']);
				$session = $_REQUEST['sess'];
				$class = $_REQUEST['class'];
				$level = $_REQUEST['level'];
				
				$session = strip_tags($session);
				$class = strip_tags($class);
				$level = strip_tags($level);
				$sentMsg = strip_tags($sentMsg);	

				/* script validation */ 
				
				if ($sendTo == ""){
         			
					$msg_e = "* Ooooooooops Error, please selec which people to sent message to";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}elseif (($session == '') || ($level == '') || ($class == '')) {
				
					$msg_e =  $formErrorMsg;
					
					echo $errorMsg.$msg_e.$eEnd;  
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
				
					
	   			}elseif ($sentMsg == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter  message to send";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}else {  /* send SMS to all class parents/students  */       			


					try {
						
						$smsCArr = smsCurrentGateway($conn);  /* current text message and gateway information */
					
						$sID = $smsCArr[$fiVal]["sID"];
						$gateway = $smsCArr[$fiVal]["gateway"];
						$senderID = $smsCArr[$fiVal]["senderID"];
						$user = $smsCArr[$fiVal]["user"];
						$password = htmlspecialchars_decode($smsCArr[$fiVal]["password"]);
						$api = $smsCArr[$fiVal]["api"];
						$status = $smsCArr[$fiVal]["status"];										
						$status = $onOffArr[$status];
								
						if($sID  >= $fiVal){  /* if current gateway is not empty  */
									
							$mClass = studentClassLevel($level);  /* retrieve student class */
							$sessionID = sessionID($conn, $session);  /* school session ID */
							$session_fi = wizGradeSession($conn, $sessionID);  /* school session  */
							$session_se = $session_fi + $foreal;
							
							$ebele_mark = "SELECT r.ireg_id, nk_regno, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname,
							i_stu_phone, i_spo_phone
		
											FROM $i_reg_tb r INNER JOIN $i_student_tb s
							
											ON (r.ireg_id = s.ireg_id)

											AND r.session_id = :session_id 
									 
											AND r.$mClass = :class

											AND r.active = :foreal";
								 
							$igweze_prep = $conn->prepare($ebele_mark);									
							$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
							$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
							$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);				 
							$igweze_prep->execute();
							
							$rows_count = $igweze_prep->rowCount(); 
							
							if($rows_count >= $foreal) {  /* check array is empty */
							
								$balance = wizGradeSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbHead =<<<IGWEZE

								<!-- row -->
								<div class="row">
									<div class="col-lg-12">
									  <section class="panel">
										  <header class="panel-heading">
											  Sent SMS Summary and Reports
											  <span class="tools pull-right">
												<a class="fa fa-chevron-down" href="javascript:;"></a>
												<a class="fa fa-times" href="javascript:;"></a>
											</span>
										  </header>
										  <div class="panel-body profile-activity">
											 
											  <div class="activity blue">
												  <span>
													  <i class="fa fa-bullhorn"></i>
												  </span>
												  <div class="activity-desk">
													  <div class="panel">
														  <div class="panel-body">
															  <div class="arrow"></div>
															  <i class=" fa fa-comment-o"></i>
															  <h4> SMS  Balance - $balance</h4>
															  <p> $sentMsg</p>
														  </div>
													  </div>
												  </div>
											  </div>

											  

										  </div>
									  </section>
								  </div>
							  
							  
								<script type='text/javascript'> $('#paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ </script>
								
								<div class="col-lg-12">
									  <section class="panel">
								<!-- table -->
								<table width = '100%'  class='table table-striped  table-advance table-hover' id='wizGradeTBPage'>
										<thead>
										
										<tr>
										<th class='text-left'>S/N</th> 
										<th class='text-left'>Student Infomation</th> 
										<th class='text-left'>Reg No.</th> 
										<th class='text-left'>Phone Number</th> 
										<th class='text-left'>SMS Reports</th> 
										</tr>
										</thead> <tbody>
IGWEZE;
									
										echo $tbHead;
										
										while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
							   
											$regNo = $row['nk_regno'];
											$ID = $row['ireg_id'];
											$pic = $row['i_stupic'];
											$fname = $row['i_firstname'];
											$lname = $row['i_lastname'];
											$mname = $row['i_midname'];
											$stuPhone = $row['i_stu_phone'];
											$spoPhone = $row['i_spo_phone'];
											
											$fname = trim($fname);
											$lname = trim($lname);
											$mname  = trim($mname);
											$stuPhone = trim($stuPhone);
											$spoPhone= trim($spoPhone);
											
											$studentName = "$lname $fname $mname";
											$studentName = ucwords($studentName);
											$studentName = trim($studentName);
											$regNo = trim($regNo); 
											
											$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$pic;

											if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }  /* check if picture exists */
											
											$serial_no++;
												
											if($sendTo == $fiVal){ $receiver = $spoPhone;}
											elseif($sendTo == $seVal){ $receiver = $stuPhone;}
											else{ $receiver = ""; }
											
											
											if($receiver == ""){  /* if receiver is empty display information message */
												
												$reports = '<button type="button" class="btn btn-white"> 
												<i class="fa fa-exclamation-triangle"></i> Message Not Sent </button>';
												$receiver = '<button type="button" class="btn btn-white"> 
												<i class="fa fa-exclamation-triangle"></i> Phone No. Empty </button>';
												
											}else{ 	
											
												  /* send text message through current gateway */ 
												$reports = wizGradeSendSMS($api, $senderID, $user, $password, $receiver, $sentMsg, $sID);
											
											}
											
											$serailNo++;

$sendReports =<<<IGWEZE
        
											<tr>
											<td class='text-left' width="5%">$serailNo</td> 
											<td class='text-left' width="30%"> <img src = '$studentPic' 
											height = '40' width = '40' class='small-picture'> </span> $studentName </td> 
											<td class='text-left' width="20%"> $regNo</td> 		
											
											<td class='text-left' width="20%"> $receiver  </td> 
											 
											<td class='text-left' width="25%"> $reports </td> 
											
											</tr>
		
IGWEZE;
                               
											echo $sendReports;
										
										
										}
										
										$balanceAF = wizGradeSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbTail =<<<IGWEZE

				
					<div class="col-lg-12">
                      <section class="panel">
                          <div class="panel-body profile-activity">
                             
                              <div class="activity blue">
                                  <span>
                                      <i class="fa fa-bullhorn"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow"></div>
                                              <i class=" fa fa-comment-o"></i>
                                              <h4> SMS  Balance After Sending - $balanceAF</h4>
											  <p> $sentMsg</p>
                                              
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              

                          </div>
                      </section>
                  </div>
			  
			  
				</div>
				<!-- /row -->
IGWEZE;
									
										echo $tbTail;
										
							}else{  /* display error */ 
										
								$msg_e = "Error, no record was found for <span>
								$session - $session_se session $classLevel $class</span>";
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;											
							}	
										
						}else{  /* display error */ 

							$msg_e = "* Oooooooops Error, please configure or set your default sms gateway before you can send SMS.";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
										
						}	
									
						
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
         		
        	
				}
			
			}elseif ($_REQUEST['sendTextMsg'] == 'staffSMS') {  /* send SMS to selected staffs  */

							
				$staffData = $_REQUEST['staffData'];
				$sentMsg = preg_replace("/[^A-Za-z0-9@%?+. ]/", "", $_REQUEST['message']);
				
				$sentMsg = strip_tags($sentMsg);
				
				/* script validation */ 				
				
				if ($staffData == "")  {
         			
					$msg_e = "* Oooooooops Error, please select staff/s";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}elseif ($sentMsg == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter  message to send";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}else {       			

		 			try {
						
						$smsCArr = smsCurrentGateway($conn);  /* current text message and gateway information */
						
						$sID = $smsCArr[$fiVal]["sID"];
						$gateway = $smsCArr[$fiVal]["gateway"];
						$senderID = $smsCArr[$fiVal]["senderID"];
						$user = $smsCArr[$fiVal]["user"];
						$password = htmlspecialchars_decode($smsCArr[$fiVal]["password"]);
						$api = $smsCArr[$fiVal]["api"];
						$status = $smsCArr[$fiVal]["status"];										
						$status = $onOffArr[$status];
						
						if($sID  >= $fiVal){  /* if current gateway is not empty  */
																
							$balance = wizGradeSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbHead =<<<IGWEZE

							<!-- row -->	
							<div class="row">
								<div class="col-lg-12">
								  <section class="panel">
									  <header class="panel-heading">
										  Sent SMS Summary and Reports
										  <span class="tools pull-right">
											<a class="fa fa-chevron-down" href="javascript:;"></a>
											<a class="fa fa-times" href="javascript:;"></a>
										</span>
									  </header>
									  <div class="panel-body profile-activity">
										 
										  <div class="activity blue">
											  <span>
												  <i class="fa fa-bullhorn"></i>
											  </span>
											  <div class="activity-desk">
												  <div class="panel">
													  <div class="panel-body">
														  <div class="arrow"></div>
														  <i class=" fa fa-comment-o"></i>
														  <h4> SMS  Balance Before Sending - $balance</h4>
														  <p> $sentMsg</p>
													  </div>
												  </div>
											  </div>
										  </div> 

									  </div>
								  </section>
							  </div>
						  
						  
							<script type='text/javascript'> $('#paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ </script>
							
							<div class="col-lg-12">
								  <section class="panel">
							<!-- table-->	
							<table width = '100%'  class='table table-striped  table-advance table-hover' id='wizGradeTBPage'>
									<thead>
									
									<tr>
									<th class='text-left'>S/N</th> 
									<th class='text-left'>Staff Infomation</th> 
									<th class='text-left'>Phone Number</th> 
									<th class='text-left'>SMS Reports</th> 
									</tr>
									</thead> <tbody>
IGWEZE;
									
										echo $tbHead;
										
										$staffArr =  explode(',', $staffData);										

										foreach ($staffArr as $staffID) {  /* loop array */
											
											$staffID = trim($staffID);
											
											
											$principalData = staffData($conn, $staffID);  /* school staffs/teachers information */ 
											list ($st_title, $st_fullname, $st_sex, $st_rankingVal, $pic, 
												  $st_lname, $receiver) = explode ("#@s@#", $principalData);
												  
											$teacherPic = $staffPicExt.$pic;

											if ((is_null($pic)) || ($pic == '') || (!file_exists($teacherPic))){ 
											$teacherPic = $wizGradeDefaultPic; }	   /* check if picture exists */
											
											
											if($receiver == ""){  /* if receiver is empty display information message */ 
												
												$reports = '<button type="button" class="btn btn-white"> 
												<i class="fa fa-exclamation-triangle"></i> Message Not Sent </button>';
												$receiver = '<button type="button" class="btn btn-white"> 
												<i class="fa fa-exclamation-triangle"></i> Phone No. Empty </button>';
												
											}else{	
											
												  /* send text message through current gateway */ 
												$reports = wizGradeSendSMS($api, $senderID, $user, $password, $receiver, $sentMsg, $sID);
											
											}
											
											$serailNo++;

$sendReports =<<<IGWEZE
        
											<tr>
											<td class='text-left' width="5%">$serailNo</td> 
											<td class='text-left' width="30%"><img src = '$teacherPic' 
											height = '40' width = '40' class='small-picture'> </span> $st_fullname </td> 
													
											<td class='text-left' width="20%"> $receiver  </td> 
											 
											<td class='text-left' width="25%"> $reports </td> 
											
											</tr>
		
IGWEZE;
                               
											echo $sendReports;
										
										
										}


									$balanceAF = wizGradeSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbTail =<<<IGWEZE

									</tbody>
									</table>
									<!-- / table -->	
								</section>
								</div>
													 
							
								<div class="col-lg-12">
								  <section class="panel">
									  <div class="panel-body profile-activity">
										 
										  <div class="activity blue">
											  <span>
												  <i class="fa fa-bullhorn"></i>
											  </span>
											  <div class="activity-desk">
												  <div class="panel">
													  <div class="panel-body">
														  <div class="arrow"></div>
														  <i class=" fa fa-comment-o"></i>
														  <h4> SMS  Balance After Sending - $balanceAF</h4>
														  <p> $sentMsg</p>
														  
													  </div>
												  </div>
											  </div>
										  </div> 

									  </div>
								  </section>
							  </div> 
						  
							</div>
							<!-- / row -->	
IGWEZE;
									
										echo $tbTail;
										
										
										
						}else{  /* display error */ 

							$msg_e = "* Oooooooops Error, please configure or set your default sms gateway before you can send SMS.";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
										
						}	 		
						
				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit; 
        	
				}
			
			}elseif ($_REQUEST['sendTextMsg'] == 'allStaffSMS') {  /* send SMS to all active staffs  */

				
				$sentMsg = preg_replace("/[^A-Za-z0-9@%?+. ]/", "", $_REQUEST['message']);
				
				$sentMsg = strip_tags($sentMsg);	

				/* script validation */ 
				
				if ($sentMsg == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter  message to send";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}else {       			


		 		try {
						
					$smsCArr = smsCurrentGateway($conn);  /* current text message and gateway information */
				
					$sID = $smsCArr[$fiVal]["sID"];
					$gateway = $smsCArr[$fiVal]["gateway"];
					$senderID = $smsCArr[$fiVal]["senderID"];
					$user = $smsCArr[$fiVal]["user"];
					$password = htmlspecialchars_decode($smsCArr[$fiVal]["password"]);
					$api = $smsCArr[$fiVal]["api"];
					$status = $smsCArr[$fiVal]["status"];										
					$status = $onOffArr[$status];
							
					if($sID  >= $fiVal){  /* if current gateway is not empty  */
								
						$ebele_mark = "SELECT t_id, i_title, i_picture, i_firstname, i_lastname, i_midname, rank, t_grade
	
										FROM $staffTB";
							 
						$igweze_prep = $conn->prepare($ebele_mark);									 
						$igweze_prep->execute();									
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count >= $foreal) {
						
							$balance = wizGradeSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbHead =<<<IGWEZE

						<!-- row -->
						<div class="row">
							<div class="col-lg-12">
							  <section class="panel">
								  <header class="panel-heading">
									  Sent SMS Summary and Reports
									  <span class="tools pull-right">
										<a class="fa fa-chevron-down" href="javascript:;"></a>
										<a class="fa fa-times" href="javascript:;"></a>
									</span>
								  </header>
								  <div class="panel-body profile-activity">
									 
									  <div class="activity blue">
										  <span>
											  <i class="fa fa-bullhorn"></i>
										  </span>
										  <div class="activity-desk">
											  <div class="panel">
												  <div class="panel-body">
													  <div class="arrow"></div>
													  <i class=" fa fa-comment-o"></i>
													  <h4> SMS  Balance - $balance</h4>
													  <p> $sentMsg</p>
												  </div>
											  </div>
										  </div>
									  </div> 
								  </div>
							  </section>
						  </div>
					  
					  
						<script type='text/javascript'> $('#paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ </script>
						
						<div class="col-lg-12">
							  <section class="panel">
						<!-- table -->
						<table width = '100%'  class='table table-striped  table-advance table-hover' id='wizGradeTBPage'>
								<thead>
								
								<tr>
								<th class='text-left'>S/N</th> 
								<th class='text-left'>Staff Infomation</th> 						
								<th class='text-left'>Phone Number</th> 
								<th class='text-left'>SMS Reports</th> 
								</tr>
								</thead> 
								<tbody>
IGWEZE;
									
									echo $tbHead;
									
									while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
						   
										$t_id = $row['t_id'];
										$title = $row['i_title'];
										$pic = $row['i_picture'];
										$fname = $row['i_firstname'];
										$lname = $row['i_lastname'];
										$mname = $row['i_midname'];
										$receiver = $row['i_phone'];
										
										$fname = trim($fname);
										$lname = trim($lname);
										$mname  = trim($mname);												
										$receiver = trim($receiver);
										
										$titleVal = $title_list[$title];
										
										$staffName = "$lname $fname $mname";
										$staffName = ucwords($staffName);
										$staffName = trim($staffName);
														
										$teacherPic = $staffPicExt.$pic;

										if ((is_null($pic)) || ($pic == '') || (!file_exists($teacherPic))){ $teacherPic = $wizGradeDefaultPic; }	  
																							
											
											if($receiver == ""){  /* if receiver is empty display information message */ 
												
												$reports = '<button type="button" class="btn btn-white"> 
												<i class="fa fa-exclamation-triangle"></i> Message Not Sent </button>';
												$receiver = '<button type="button" class="btn btn-white"> 
												<i class="fa fa-exclamation-triangle"></i> Phone No. Empty </button>';
												
											}else{	
											
												  /* send text message through current gateway */ 
												$reports = wizGradeSendSMS($api, $senderID, $user, $password, $receiver, $sentMsg, $sID);
											
											}
											
											$serailNo++;

$sendReports =<<<IGWEZE
        
											<tr>
											<td class='text-left' width="5%">$serailNo</td> 
											<td class='text-left' width="30%"> <img src = '$teacherPic' 
											height = '40' width = '40' class='small-picture'> </span>$titleVal $staffName</td> 
													
											<td class='text-left' width="20%"> $receiver  </td> 
											 
											<td class='text-left' width="25%"> $reports </td> 
											
											</tr>
		
IGWEZE;
                               
										echo $sendReports;
										
										
									}
										
									$balanceAF = wizGradeSMSBalance($api, $user, $password, $sID);  /* check text message balance  */ 

$tbTail =<<<IGWEZE

										</tbody>
										</table>
										<!-- / table -->
									</section>
									</div>
														 
								
									<div class="col-lg-12">
									  <section class="panel">
										  <div class="panel-body profile-activity">
											 
											  <div class="activity blue">
												  <span>
													  <i class="fa fa-bullhorn"></i>
												  </span>
												  <div class="activity-desk">
													  <div class="panel">
														  <div class="panel-body">
															  <div class="arrow"></div>
															  <i class=" fa fa-comment-o"></i>
															  <h4> SMS  Balance After Sending - $balanceAF</h4>
															  <p> $sentMsg</p>
															  
														  </div>
													  </div>
												  </div>
											  </div>

											  

										  </div>
									  </section>
								  </div>
							  
							  
								</div>
								<!-- / row -->
IGWEZE;
									
											echo $tbTail;
										
						}else{  /* display error */
										
							$msg_e = "Error, no record was found for <span>
							$session - $session_se session $classLevel $class</span>";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;		
							
						}	
										
					}else{  /* display error */

						$msg_e = "* Oooooooops Error, please configure or set your default sms gateway before you can send SMS.";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
										
					}	
									
						
				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
		
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
         		
        	
				}
			
			}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			} 
			
exit;
?>