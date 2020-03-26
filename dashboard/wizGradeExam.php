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
	This script handle student examination
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */
		
		
		         
			if ($_REQUEST['onlineExamData'] == 'saveExam') {  /* save exam */
				
				$session = preg_replace("/[^0-9]/", "", $_REQUEST['sess']);
				$level = preg_replace("/[^0-9]/", "", $_REQUEST['level']);
				$eTerm = preg_replace("/[^0-9]/", "", $_REQUEST['eTerm']);
				$class = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['class']);
				$eTitle =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['eTitle']);
				$eSubject = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['eSubject']);
				$eTime = preg_replace("/[^0-9]/", "", $_REQUEST['eTime']);
				$eDetail = $_REQUEST['eDetail']; 			
				
				/* script validation */
				
				if ($session == "")  {
         			
					$msg_e = "* Oooooooops Error, please select target exam class";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}elseif ($level == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter target exam level";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}elseif ($class == "")  {
         			
					$msg_e = "* Oooooooops Error, please select target exam class";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}elseif ($eTerm == "")  {
         			
					$msg_e = "* Oooooooops Error, please select target exam term";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}elseif ($eTitle == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter exam title";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}elseif ($eSubject == "")  {
         			
					$msg_e = "* Oooooooops Error, please select exam subject";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}elseif ($eTime == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter exam duration";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}
				/*elseif ($eDetail == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter exam instruction";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader * / </script>";exit;
					
	   			}
				
				*/
				else {  /* update information */        			
				
					$sessionID = sessionID($conn, $session);  /* school session ID */
					$eDetail = strip_tags($eDetail);
					$eDetail = str_replace('<br />', "\n", $eDetail);
					$eDetail = htmlspecialchars($eDetail);	
					$eDetail = "";	


		 			try {
						
						if ($admin_grade == $staffGrade) {    /* check admin grade */ 
						
							$eGrade = $seVal;
						
						}else{
							
							$eGrade = $fiVal;
							
						}	
						
						$ebele_mark = "INSERT INTO $wizGradeExamTB  (session, level, class, eTerm, eTitle, eSubject, eTime, eDetail, eGrade, eStaff)

																	VALUES (:session, :level, :class, :eTerm, :eTitle, :eSubject, 
																	:eTime, :eDetail, :eGrade, :eStaff)";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':session', $sessionID);
						$igweze_prep->bindValue(':level', $level);
						$igweze_prep->bindValue(':class', $class);
						$igweze_prep->bindValue(':eTerm', $eTerm);
						$igweze_prep->bindValue(':eTitle', $eTitle);
						$igweze_prep->bindValue(':eSubject', $eSubject);
						$igweze_prep->bindValue(':eTime', $eTime);
						$igweze_prep->bindValue(':eDetail', $eDetail);
						$igweze_prep->bindValue(':eGrade', $eGrade);
						$igweze_prep->bindValue(':eStaff', $_SESSION['adminID']);
						
						
						if($igweze_prep->execute()){  /* if sucessfully */ 
							
							$eID = $conn->lastInsertId($wizGradeExamTB);
							
							/*
							$eDetailS = htmlspecialchars_decode($eDetail);									
							$eDetailS = nl2br($eDetailS);
							$sessionS = ($session + $fiVal); 
							
							 <tr>
                                    <th class="text-left" width="20%"> Exam Instruction/s </th>
                                    <td class="text-left" width="80%">$eDetailS</td>
                                    
                            </tr>
							
							*/
					
$questDiv =<<<IGWEZE

						
						<section class="panel">
							<header class="panel-heading">
                             Online Examination Question & Answer Manager
							</header>
							<div class="panel-body progress-panel wizGrade-line"> 
                            <!-- table -->
							 
							<table class="table table-hover style-tablea">
                              <tbody>
                                <tr>
                                    <th class="text-left" width="20%"> Target Class </th>
                                    <td class="text-left" width="80%">$session - $sessionS Session   $level $class</td>
                                    
                                </tr>
                                <tr>
                                    <th class="text-left" width="20%"> Exam Title </th>
                                    <td class="text-left" width="80%"> $eTitle </td>
                                    
                                </tr>
                                <tr>
                                    <th class="text-left" width="20%"> Exam Subject </th>
                                    <td class="text-left" width="80%">$eSubject</td>
                                   
                                </tr>
                                <tr>
                                    <th class="text-left" width="20%"> Duration  </th>
                                    <td class="text-left" width="80%">$eTime Minutes</td>
                                    
                                </tr>
								
                              </tbody>
							</table>
							<!-- / table --> 
							
							<button type="button" class="btn btn-danger pull-right editQuestion" id="wizGrade-$i_false-$eID">  
							<i class="fa fa-question-circle-o"></i> Add Question </button>
							<br clear="all" /> <br clear="all" /> 
							<div id="examQuesDiv"> 
							  
		
IGWEZE;
							
							$msg_s = "New Online Examination information was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#examQSlideDiv').slideUp(1500);  hidePageLoader();  /* hide page loader */  
							$('.alert').fadeOut(30000); </script>";
							
							echo $questDiv; 
							require_once 'wizGradeQuestionsInfo.php';  /* include exam question div */
							echo"</div> 
							<br clear='all' />
							<button type='button' class='btn btn-danger pull-left editQuestion' id='nkiru-$i_false-$eID'>  
							 <i class='fa fa-question-circle-o'></i> Add Question </button>
							  
							  
							</div>
							</section>";
								
							exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save New Online Examination information. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		
		
         		
        	
				}
			
			}elseif ($_REQUEST['onlineExamData'] == 'updateExam') {  /* update exam */

				$eID = preg_replace("/[^0-9]/", "", $_REQUEST['eID']);			
				$session = preg_replace("/[^0-9]/", "", $_REQUEST['sess']);
				$level = preg_replace("/[^0-9]/", "", $_REQUEST['level']);
				$eTerm = preg_replace("/[^0-9]/", "", $_REQUEST['eTerm']);
				$class = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['class']);
				$eTitle =  preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['eTitle']);
				$eSubject = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['eSubject']);
				$eTime = preg_replace("/[^0-9]/", "", $_REQUEST['eTime']);
				$eDetail = $_REQUEST['eDetail'];				
				
				/* script validation */ 
								
				if ($eID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur to retrieve exam information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($session == "")  {
         			
					$msg_e = "* Oooooooops Error, please select target exam class";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($level == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter target exam level";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($class == "")  {
         			
					$msg_e = "* Oooooooops Error, please select target exam class";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($eTerm == "")  {
         			
					$msg_e = "* Oooooooops Error, please select target exam term";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($eTitle == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter exam title";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($eSubject == "")  {
         			
					$msg_e = "* Oooooooops Error, please select exam subject";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($eTime == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter exam duration";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}
				
				/*
				elseif ($eDetail == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter exam instruction";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}
				*/
				
				else {  /* update information */       			
				
					$sessionID = sessionID($conn, $session);  /* school session ID */
					$eDetail = strip_tags($eDetail);
					$eDetail = str_replace('<br />', "\n", $eDetail);
					$eDetail = htmlspecialchars($eDetail);
					$eDetail = ""; 

		 			try { 
						
						$ebele_mark = "UPDATE $wizGradeExamTB  
											
											SET 
											
											session = :session, 
											level = :level,
											class = :class,
											eTerm = :eTerm,	
											eTitle = :eTitle,
											eSubject = :eSubject,
											eTime = :eTime,
											eDetail = :eDetail
											
											
										WHERE eID = :eID";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':eID', $eID);
						$igweze_prep->bindValue(':session', $sessionID);
						$igweze_prep->bindValue(':level', $level);
						$igweze_prep->bindValue(':class', $class);
						$igweze_prep->bindValue(':eTerm', $eTerm);
						$igweze_prep->bindValue(':eTitle', $eTitle);
						$igweze_prep->bindValue(':eSubject', $eSubject);
						$igweze_prep->bindValue(':eTime', $eTime);
						$igweze_prep->bindValue(':eDetail', $eDetail); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "New Online Examination information was successfully saved."; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#examQDiv').load('wizGradeExamInfos.php'); 
							   $('#editLoader').fadeOut(1500);  $('#editExamDiv').slideUp(1500);
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save New Online Examination information. 
							Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}          		
        	
				}
			
			}elseif ($_REQUEST['onlineExamData'] == 'addQuestion') {  /* save exam question */

				
				$eID = strip_tags($_REQUEST['eID']);
				$i = $fiVal;
				
				/* script validation */ 
				
				if ($eID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve exam information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit;
					
	   			}else {      

		 			try { 
						
						$onlineExamInfoArr = onlineExamInfo($conn, $eID);  /* online student exam information */
						$sessionID = $onlineExamInfoArr[$i]["session"];
						$level = $onlineExamInfoArr[$i]["level"];
						$eTerm = $onlineExamInfoArr[$i]["eTerm"];
						$class = $onlineExamInfoArr[$i]["class"];
						$eTitle = $onlineExamInfoArr[$i]["eTitle"];
						$eSubject = $onlineExamInfoArr[$i]["eSubject"];
						$eDetail = htmlspecialchars_decode($onlineExamInfoArr[$i]["eDetail"]);
						$eTime = $onlineExamInfoArr[$i]["eTime"];
						$eTerm = $term_list[$eTerm];
						
						$session = wizGradeSession($conn, $sessionID);  /* school session ID */
						$sessionS = ($session + $fiVal);
						//$eDetail = nl2br($eDetail);
									
					}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}			
							/*
								<tr>
                                    <th class="text-left" width="20%"> Exam Instruction/s </th>
                                    <td class="text-left" width="80%">$eDetail</td>
                                    
                                </tr>
							*/	
					
$questDiv =<<<IGWEZE

						<section class="panel">
                          <header class="panel-heading">
                             Online Examination Question & Answer Manager
                          </header>
                          <div class="panel-body progress-panel wizGrade-line">
						  
                            <!-- table --> 
							<table class="table table-hover style-tablea">
                              <tbody>
                                <tr>
                                    <th class="text-left" width="20%"> Target Class </th>
                                    <td class="text-left" width="80%">$session - $sessionS Session   $level $class</td>
                                    
                                </tr>
                                <tr>
                                    <th class="text-left" width="20%"> Exam Title</th>
                                    <td class="text-left" width="80%"> $eTitle </td>
                                    
                                </tr>
                                <tr>
                                    <th class="text-left" width="20%"> Exam Subject </th>
                                    <td class="text-left" width="80%">$eSubject</td>
                                   
                                </tr>
                                <tr>
                                    <th class="text-left" width="20%"> Duration  </th>
                                    <td class="text-left" width="80%">$eTime Minutes</td>
                                    
                                </tr>
								 
                              </tbody>
							</table>
							<!-- / table -->
							
							<button type="button" class="btn btn-danger pull-right editQuestion" id="wizGrade-$i_false-$eID">  
							<i class="fa fa-question-circle-o"></i> Add Question </button>
							<br clear="all" /> <br clear="all" />
							  
							<div id="examQuesDiv">
							  
		
IGWEZE;
							
							
							echo $questDiv; 
							require_once 'wizGradeQuestionsInfo.php';  /* include assignment question div */
							echo"</div>
							
								
							<br clear='all' />
							<button type='button' class='btn btn-danger pull-left editQuestion' id='nkiru-$i_false-$eID'>  
							<i class='fa fa-question-circle-o'></i> Add Question </button>
							  
							</div>
							</section>"; 
				 	
							echo "<script type='text/javascript'>   hidePageLoader();  /* hide page loader */ </script>";exit; 
        	
				}
			
			}elseif ($_REQUEST['onlineExamData'] == 'removeExam') {  /* remove exam */

				
				$onlineExamData = $_REQUEST['eData'];
				
				list($wizGradeIg, $eID, $hName) = explode("-", $onlineExamData);			
				
				/* script validation */ 
				
				if (($onlineExamData == "")  || ($eID == "")){
         			
					$msg_e = "* Ooooooooops, an error has occur while to remove exam information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* remove information */       			


		 			try {
						
						
						$ebele_mark = "DELETE FROM 
						
										$wizGradeExamTB										
											
										WHERE eID = :eID
											
										LIMIT 1";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':eID', $eID);						
						
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$eID."').fadeOut(1000);";
							$msg_s = "<strong>$hName</strong> was successfully removed"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'>   
							$('#removeLoader').fadeOut(1500); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to remove exam information. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		 
        	
				}
			
			}elseif ($_REQUEST['onlineExamData'] == 'viewExam') {  /* view exam */

				
				$eID = strip_tags($_REQUEST['eData']);
				$i = $fiVal;
				
				if ($eID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve exam information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       			


		 			try {
						
						
									$onlineExamInfoArr = onlineExamInfo($conn, $eID);  /* online student exam information */
									$sessionID = $onlineExamInfoArr[$i]["session"];
									$level = $onlineExamInfoArr[$i]["level"];
									$eTerm = $onlineExamInfoArr[$i]["eTerm"];
									$class = $onlineExamInfoArr[$i]["class"];
									$eTitle = $onlineExamInfoArr[$i]["eTitle"];
									$eSubject = $onlineExamInfoArr[$i]["eSubject"];
									$eDetail = htmlspecialchars_decode($onlineExamInfoArr[$i]["eDetail"]);
									$eTime = $onlineExamInfoArr[$i]["eTime"];
									$eTerm = $term_list[$eTerm];
									
									$session = wizGradeSession($conn, $sessionID);  /* school session ID */
									$sessionS = ($session + $fiVal);
									//$eDetail = nl2br($eDetail);
									
									/*<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
										<i class="fa fa-sort-alpha-asc"></i> Exam Details </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
										$eDetail</td> </tr>
									*/	
									

$showExam =<<<IGWEZE
		
								<button  class="btn btn-white printer-icon pull-right">
								<i class="fa fa-print text-info"></i> Print </button><br clear="all"/><br clear="all"/>
		
								<div id = 'wizGradePrintArea'>

                                  	<!-- table -->	
									<table width = '100%' class="table table-striped  table-advance table-hover"> 
										
										<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
										<i class="fa fa-clock-o"></i> Exam Session </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
										$session - $sessionS
										</td> </tr> 
										
										<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
										<i class="fa fa-calendar"></i> Target Class </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
										$level $class </td> </tr> 
										
										<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
										<i class="fa fa-calendar-plus-o"></i> Exam Term</td> <td style="padding-left: 30px; text-align:left; width: 60%;">
										$eTerm</td> </tr>
										
										
										<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
										<i class="fa fa-bars"></i> Exam Title </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
										$eTitle</td> </tr>
										
										<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
										<i class="fa fa-book"></i> Subject Title </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
										$eSubject</td> </tr>
										
										<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
										<i class="fa fa-clock-o"></i> Duration </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
										$eTime Minutes</td> </tr>  
										
									</table>
									<!-- / table --> 
								</div>
		
IGWEZE;
				
								echo $showExam; 
								echo "<script type='text/javascript'>  $('#editLoader').fadeOut(3000); </script>"; exit; 
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['onlineExamData'] == 'editExam') {  /* edit exam */

				
				$eID = strip_tags($_REQUEST['eData']);
				
				/* script validation */
				
				if ($eID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve exam information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       			


		 			try {						
						
							$onlineExamInfoArr = onlineExamInfo($conn, $eID);  /* online student exam information */ 
							$sessionID = $onlineExamInfoArr[$fiVal]["session"];
							$level = $onlineExamInfoArr[$fiVal]["level"];
							$class = $onlineExamInfoArr[$fiVal]["class"];
							$eTerm = $onlineExamInfoArr[$fiVal]["eTerm"];
							$eTitle = $onlineExamInfoArr[$fiVal]["eTitle"];
							$eSubject = $onlineExamInfoArr[$fiVal]["eSubject"];
							$eTime = $onlineExamInfoArr[$fiVal]["eTime"];
							//$eDetail = htmlspecialchars_decode($onlineExamInfoArr[$fiVal]["eDetail"]);							
						
?>
								<!-- form -->
								<form class="form-horizontal" id="frmupdateExam" role="form">
									  
									  
									<div class="form-group">
                                      <label  for="subjTerm" class="col-lg-4 col-sm-4 control-label">* Select Term</label>
                                     
										<div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              
												<select class="form-control"  id="subjTerm" name="eTerm" required>
                                              
                                				<option value = "">Please select One</option> 
											
												<?php 

													foreach($term_list as $term_key => $term_value){  /* loop array */

														if ($eTerm == $term_key){
															$selected = "SELECTED";
														} else {
															$selected = "";
														}

														echo '<option value="'.$term_key.'"'.$selected.'>'.$term_value.'</option>' ."\r\n";

													}

												?> 											
                                              
												</select>
												<input type="hidden" value="updateExam" name = "onlineExamData"/>
												<input type="hidden" value="<?php echo $class.':<$?$>:'.$eTitle.':<$?$>:'.$eSubject; ?>" 
												name = "euData" id="euData"/>
												<input type="hidden" name="eID" value="<?php echo $eID; ?>"/>											  
                                          </div>
                                      </div>
									</div>
								  
								
									<span id="wait" style="display: none;">
										<center><img alt="Please Wait" src="loading.gif"/></center><!-- loading image -->
								  	</span>
									<span id="result" style="display: none;"></span><!-- loading div --> 
								
								<?php if ($admin_grade == $staffGrade) {    /* check admin grade */ ?>

									<div class="form-group">
                                      <label for="subjectLevel" class="col-lg-4 col-sm-4 control-label">*  School Level</label>                                     
										<div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-clock-o"></i>                                              
                                              <select class="form-control"  id="subjectLevel" name="subjectLevel" required>
                                              
                                				<option value = "">Please select One</option>					 
												<?php 
												
												   try  {
														
															formTeacherSession($conn, $adminID, $wizGradeMode); /* class teacher school session  */ 
												 
														}catch(PDOException $e) {
							
															wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
														} 
														
												?>												
                                              
                                              </select>
											  <input type="hidden" name ="classAll" id="classAll" value="<?php echo $i_false; ?>" />
                                          </div>
                                      </div>
									</div>
								  
								<?php }else{ ?>	
								<div class="form-group">
                                      <label for="sess" class="col-lg-4 col-sm-4 control-label">* School Level</label>
                                     
                                  <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-clock-o"></i>
                                              
                                              <select class="form-control"  id="subjectLevel" name="subjectLevel" required>
                                              
													<option value = "">Please select One</option>
													<?php  
													
													 try {
														 
														    $session = wizGradeSession($conn, $sessionID); /* school session  */
															$passData = trim($session.'#@@#'.$level);
														   		
															schoolSessionL($conn, $passData); /* school session  */
												 
														}catch(PDOException $e) {
							
														wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
							 
														}

													?>
                                              
                                              </select>
											  <input type="hidden" name ="classAll" id="classAll" value="<?php echo $fiVal; ?>" />
                                          </div>
                                          
                                      </div>
									</div>
								
									<?php } ?>
                                  

									<span id="wait_1" style="display: none;">
    									<center><img alt="Please Wait" src="loading.gif"/></center><!-- loading image -->
    								</span>
									<span id="result_1" style="display: none;"></span> <!-- loading div --> 
                                    
                              	
									<div class="form-group">
                                          <label for="eTime" class="col-lg-4 col-sm-4 control-label">* Exam Duration (In Minutes)</label>
                                          <div class="col-lg-8">
                                          <div class="iconic-input">
                                              <i class="fa fa-clock-o"></i>
                                              <input type="number"  id="eTime" name="eTime" 
                                              class="form-control" placeholder="60" maxlength="3" value="<?php echo $eTime; ?>" required>
                                          </div>
                                          </div>
									</div> 
									
									<!--
	
									<div class="form-group">
                                      <label for="eDetail" class="col-lg-4 col-sm-4 control-label"> * Exam Instruction/s</label>
                                      
                                      <div class="col-lg-8">
                                        
                                            <textarea rows="4" cols="10" class="form-control" name="eDetail" id="eDetail" 
                                            placeholder="Enter Exam Instructions"><?php echo $eDetail; ?></textarea>
                                           
                                          </div>
                                      </div>		
                         	
									--> 
									
                                    <div class="form-group">
                                      	  <input type="hidden" name="onlineExamData" value="updateExam" />
                                          <center><button type="submit" class="btn btn-danger buttonMargin" id="updateExam">
                                          <i class="fa fa-save"></i> Update Exam </button></center>                                          
                                    </div>
                                     
									  
                                </form>  
								<!-- / form -->	
<?php
								
								echo "<script type='text/javascript'> $('#subjectLevel').trigger('change'); $('#editLoader').fadeOut(3000); </script>"; exit;						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}		 
        	
				}
			
			}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}
			
exit;
?>