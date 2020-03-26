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
	This script load and save student rollcall
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

            define('wizGrade', 'igweze');  /* define a check for wrong access of file */
						
			require 'configwizGrade.php';  /* load wizGrade configuration files */	   
			
			if (($_REQUEST['rollData']) == 'loadSheet') {  /* load student rollcall */	  
				
				/* script validation */ 
				if ( (($_REQUEST['sess']) != "") && (($_REQUEST['level']) != "") && (($_REQUEST['class']) != ""))  {

					$session = $_REQUEST['sess'];
					$level = $_REQUEST['level'];
					$class = $_REQUEST['class'];
					$term = $fiVal;
					
					require  $wizGradeClassConfigDir;   /* include class configuration script */
					
					$calendarDate = date("l, F d, Y");
					
					$today = date("Y-m-d"); 
 
					echo "<div id='wizGradePrintArea'>"; 
		
$div_head =<<<IGWEZE
				
					<!-- row -->
					<div class="row">
						<div class="col-sm-12">
							<section class="panel">
							<header class="panel-heading">
                               
							   
							   <i class="fa fa-check-square-o fa-lg"></i> $stu_class $class | $calendarDate
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line" id="rollCallDiv">
							
							<!-- form -->
							<form class="form-horizontal" id="frmsaveRollCall" role="form">
                        
				
IGWEZE;

							echo $div_head;
		 
							// echo "<script type='text/javascript'> $('#paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ </script>";
		 
							echo '<div class="col-lg-2 col-sm-2 pull-left" style="margin-right:10px!important">

								<div data-date-viewmode="years" data-date-format="yyyy-mm-dd" 
								data-date="2017-02-02"  
								class="input-append date dpYears">
								<input type="text" readonly="" 
								size="5" class="form-control"  name="rollCallDate" value="'.$today.'"  required />
								<span class="input-group-btn add-on">
								<button class="btn btn-danger" type="button">
								<i class="fa fa-calendar"></i></button>
								</span>
								</div>

							</div> '; 

							echo '
							<div class="col-lg-3 col-sm-3 pull-left">

								<div class="iconic-input">
								<i class="fa fa-book"></i>

								<select class="form-control"  id="rollTask" name="rollTask">

								<option value = "1">Select an action for all</option>'; 
						
									foreach($attendance_list as $attend_key => $attend_value){  /* loop array */

										echo '<option value="'.$attend_key.'"'.$selected.'>'.$attend_value.'</option>' ."\r\n";

									}		 
                                              
                            echo '            
								</select>
                                </div>
                            </div>'; 
		 
		 
$bioHead =<<<IGWEZE

							<div id='eMsgR'></div>							
							<script type='text/javascript'> $('.dpYears').datepicker(); </script>		
							
							<input type="hidden" name="rollData" value="saveRollCall" />

							<button  class="btn btn-danger pull-right saveRollCall">
							<i class="fa fa-save"></i> Save  </button>  
															  
							<br clear="all" />	<br clear="all" />
							<!-- table -->
							<table  class='table table-hover style-table' id='wizGradeTBPage'>
							
							<thead>
							<tr><th class='text-left'>S/N</th>
							<th class='text-left'>Regnum</th> 
							<th class='text-left'>Name</th>
							<th class='text-left'>Roll Call</th>
							<th class='text-left'>Comments</th></tr>
							
							</thead> <tbody>
		
IGWEZE;
			
						try { 
								
								$sessionID = sessionID($conn, $session); /* school session ID  */
								$session_fi = wizGradeSession($conn, $sessionID); /* school session */
										 
								$session_se = $session_fi + $foreal;  
								
								$ebele_mark = "SELECT r.ireg_id, nk_regno, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname
								
												FROM $i_reg_tb r INNER JOIN $i_student_tb s
								
												ON (r.ireg_id = s.ireg_id)

												AND r.session_id = :session_id 
										 
												AND r.$nk_class = :class

												AND r.active = :foreal";
									 
								$igweze_prep = $conn->prepare($ebele_mark);
								$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
								$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
								$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);				 
								$igweze_prep->execute();
								
								$rows_count = $igweze_prep->rowCount(); 
								
								if($rows_count >= $foreal) {  /* check array is empty */
								
									echo $bioHead;
								
									while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
					   
										$regNo = $row['nk_regno'];
										$regID = $row['ireg_id'];
										$pic = $row['i_stupic'];
										$fname = $row['i_firstname'];
										$lname = $row['i_lastname'];
										$mname = $row['i_midname'];
										
										$studentData = $regID.'@@'.$regNo.'@@'.$session.'@@'.$level.'@@'.$class.'@@'.$term;
										
										$serial_no++;
												
										$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$pic;

										if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }		
										

										$ebele_mark_1 = "SELECT rID, startdate, enddate, attendance, comments
										
														FROM $daily_comments_tb
										
														WHERE ireg_id = :ireg_id
														
														AND startdate = :startdate
														
														AND enddate = :enddate";
											 
										$igweze_prep_1 = $conn->prepare($ebele_mark_1);
										$igweze_prep_1->bindValue(':ireg_id', $regID);
										$igweze_prep_1->bindValue(':startdate', $today);
										$igweze_prep_1->bindValue(':enddate', $today);	 
										$igweze_prep_1->execute();
										
										$rows_count_1 = $igweze_prep_1->rowCount(); 
										
										if($rows_count_1 == $foreal) {  /* check array is empty */
											
											while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
				   
												$rID = $row_1['rID'];
												$rollID = $row_1['attendance'];
												$comment = $row_1['comments'];
												
											}
											
											$comment = htmlspecialchars_decode($comment);
											
										}	
													
											

$studentInfo =<<<IGWEZE
        
										<tr><td width='5%' class='text-left'>$serial_no</td>
										
										<td width='15%' class='text-left'> <a href='javascript:;' id='$regNo' class ='ViewBioData'>$pre_regnum$regNo </a> </td>
										<td width='30%' class='text-left'>
										
										<a href='javascript:;' id='$regNo' class ='ViewBioData'> 
										
										<img src = '$studentPic' height = '40' width = '40' class='small-picture'> 
										 $lname $fname $mname </a> </td>
										
										<td width='20%' class='text-left'> 
			
										<div class="form-group">
										<div class="col-lg-12">
											<div class="iconic-input">
											<i class="fa fa-book"></i>
											<input type="hidden" value="$regID" name="regID[]" />
											<input type="hidden" value="$regNo" name="regNo[]" />
											<input type="hidden" value="$lname $fname $mname" name="studentName[]" />
											<select class="form-control classCall"  id="rollCall-$regID" name="rollCall[]" required> 
		
IGWEZE;
										
										echo $studentInfo; 
							
										foreach($attendance_list as $attend_key => $attend_value){  /* loop array */

											if ($attend_key == $rollID){
												$selected = "SELECTED";
											} else {
												$selected = "";
											}

											echo '<option value="'.$attend_key.'"'.$selected.'>'.$attend_value.'
											</option>' ."\r\n";

										}	 

$studentInfo2 =<<<IGWEZE
        
                                              
												  </select>
											  </div>
										  </div>	
										</div> 
			
										</td> 
										
										<td width='30%' class='text-left'> 
										
											<div class="form-group"> 
												<div class="col-lg-12">
												<div class="iconic-input">
												<i class="fa fa-comment"></i>

												<input type="text" class="form-control" placeholder="$lname 's Remarks" 
												name="remarks[]" id="remark-$regID" value="$comment" />
												</div>
												</div>
											</div>  
	 
										
										</td> 
										
										</tr>
		
IGWEZE;
										echo $studentInfo2;
						

									}
					
									echo '</tbody>
									</table>
									<!-- / table -->
									<br clear="all" />	<br clear="all" />
									<button  class="btn btn-danger saveRollCall pull-left">
									<i class="fa fa-save"></i> Save  </button> 
									</form>							
									<!-- form -->'; 
								  
								}else{
		
									$msg_e = "Ooooooops Error, no record was found for this search query, please try another query";												
									echo $errorMsg.$msg_e.$eEnd; //exit; 			
										
								}
								
								echo $div_footer;
				
							}catch(PDOException $e) {
						
									wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
						 
							}
				
		
?>
 
								</div>
							</section>
						</div>
					</div>
					<!-- / row --> 		
        		
<?php 			
							
				}else {  /* display error */  

        			$msg_e =  $formErrorMsg;
					echo $errorMsg.$msg_e.$eEnd; //exit; 
 
        		}
						
				echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ </script>";		
						
				
			}elseif (($_REQUEST['rollData']) == 'saveRollCall') {  /* save student rollcall */

				$regIDArr = $_REQUEST['regID'];
				$regNoArr = $_REQUEST['regNo'];
				$rollCallArr = $_REQUEST['rollCall'];
				$remarksArr = $_REQUEST['remarks'];
				$start = $_REQUEST['rollCallDate'];
				$studentNameArr = $_REQUEST['studentName'];
				
				$end = $start;
				
				/* script validation */
				
				if($start == ""){
					
					$msg_e = "Ooooooops  Error, please select roll call date";
					echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */</script>";
					echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 		
					
				}else{	
					
				
					foreach ($regIDArr as $id => $val) {  /* loop array */
						
						$rollCallArray [$id] = array(
							'regID'  => $regIDArr[$id],
							'regNo'  => $regNoArr[$id],
							'Name'  => $studentNameArr[$id],
							'rollCall' => $rollCallArr[$id],
							'remarks'    => $remarksArr[$id],
						); 
						
						$regID  = $regIDArr[$id];
						$regNo  = $regNoArr[$id];
						$rollCall = $rollCallArr[$id];
						$studentName = $studentNameArr[$id];
						$remarks = $remarksArr[$id];
						$remarks = preg_replace("/[^A-Za-z0-9'%.? ]/", "", $remarks);
						$remarks = htmlspecialchars($remarks);				
					

						try { 

							$ebele_mark = "SELECT rID
							
											FROM $daily_comments_tb
							
											WHERE ireg_id = :ireg_id
											
											AND startdate = :startdate
											
											AND enddate = :enddate";
								 
							$igweze_prep = $conn->prepare($ebele_mark);
							$igweze_prep->bindValue(':ireg_id', $regID);
							$igweze_prep->bindValue(':startdate', $start);
							$igweze_prep->bindValue(':enddate', $end);	 
							$igweze_prep->execute();
							
							$rows_count = $igweze_prep->rowCount(); 
							
							if($rows_count == $foreal) {  /* check array is empty */
								
								while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
	   
									$rID = $row['rID'];
									
								}

								$ebele_mark_1 = "UPDATE $daily_comments_tb 
							
											SET 
											
											attendance = :attendance,
											comments = :comments

											WHERE rID = :rID";
					 
								$igweze_prep_1 = $conn->prepare($ebele_mark_1);
								$igweze_prep_1->bindValue(':attendance', $rollCall);
								$igweze_prep_1->bindValue(':comments', $remarks);
								$igweze_prep_1->bindValue(':rID', $rID);
							
							}else{	
						
								$ebele_mark_1 = "INSERT INTO $daily_comments_tb (ireg_id, startdate, enddate, attendance, 
																			   comments)

												VALUES (:ireg_id, :startdate, :enddate, :attendance, :comments)";
						 
								$igweze_prep_1 = $conn->prepare($ebele_mark_1);
								$igweze_prep_1->bindValue(':ireg_id', $regID);
								$igweze_prep_1->bindValue(':startdate', $start);
								$igweze_prep_1->bindValue(':enddate', $end);
								$igweze_prep_1->bindValue(':attendance', $rollCall);
								$igweze_prep_1->bindValue(':comments', $remarks); 
								
							}	
		
							if ($igweze_prep_1->execute()) {  /* if sucessfully */ 

								$msg_s = "<strong>$studentName</strong> Roll Call was successfully saved.";
								echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */</script>";
								echo $succesMsg.$msg_s.$sEnd ; echo $scrollUp; //exit; 						
													
						
							}else {  /* display error */ 

								$msg_e = "<span>Ooooooops, 
								an Error occured while tring to save roll call.  
								Please try again</span>";
								echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */</script>";
								echo $errorMsg.$msg_e.$eEnd; echo $scrollUp;// exit; 		

							} 

						}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
						} 
						
						$regID  = "";
						$regNo  = "";
						$rollCall = "";
						$remarks = "";
					}
					
				}
				
				echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ $('#rollCallDiv').slideUp(2000); </script>";
				
			}else{ 		
					
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */		
		
			} 
			
exit;
?>