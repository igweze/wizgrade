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
	This script handle student bulk comment result uploads
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

		define('wizGrade', 'igweze');  /* define a check for wrong access of file */

		require 'configwizGrade.php';  /* load wizGrade configuration files */	   
			 
		if (($_REQUEST['rsData']) == 'bulkSubComm') {	 
				
					
			$term = $_REQUEST['term']; 
			$level = $_REQUEST['level']; 
			$class = $_REQUEST['class'];
			$session = $_REQUEST['sess'];
			$uMode = $_REQUEST['uMode'];
			$uData = $_REQUEST['uploadData'];
			$time = strtotime(date("Y-m-d H:i:s"));
			
			try {
				
				$sessionIDT = sessionID($conn, $session);  /* school session ID */			
				$rsStatus = wizGradeResultStatus($conn, $sessionIDT, $class, $level, $term);	 /* student result status */	
				
				if  ($rsStatus == $rspublishStage){	 /* check student result status */			
												
						$session = wizGradeSession($conn, $sessionIDT);  /* school session  */			
						$session_se = $session + $foreal;
						$SessSem = schoolTerm($term);  /* school term  */
												
						$msg_e = "$tframeF $SessSem Semester $session - $session_se $tframeS";											
						echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
						echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>"; exit;	

				}	
		
				$a = 1; $b = 2; $c = 3; $e = 4; $f = 5;
				$rsCountCourse = 5;
				$courseCountLimit = 9;
				 
			}catch(PDOException $e) {

					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

			} 
			
			
			if($uMode == $seVal){ goto wizGradeSaveRS; }  /* save information */

			$picturePath = $rsUploadsPath; /* picture path */
			
			$filePic = "bulkExcel"; /* picture file name */
			$pageDesc = "Excel upload";
			
			/* call igweze file uploader */
			$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 10), $validExcelExt, $validExcelType, 
			$allowedExcelExt, $fileType = "Excel", $seVal); 
			 
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
					
					$uploadedFile = $rsUploadsPath.$uploadedPic;
						
					if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
							
							
						try { 

							$uploadData = $term.'::$::'.$level.'::$::'.$class.'::$::'.$session.'::$::'.$uploadedPic;
							
							wizGradeSaveRS:  /* save information */		
							
							if($uMode == $seVal){   /* save information */ 
							
								list ($term, $level, $class, $session, $uploadedPic) = explode ("::$::", $uData);
								
								$uploadedFile = $rsUploadsPath.$uploadedPic;
								$showSaveBtn = "";
								
							}else{
								
									$showSaveBtn = '<div style="margin: 10px 3px;">
										<button  class="btn btn-white pull-right savebulkSubCom" id="'.$uploadData.'">
										<i class="fa fa-save text-info"></i> 
										<span> Save Result</span>
										</button>
										</div><br clear="all"/><br clear="all"/>';
							}	

									echo '<div class="row highRSDiv">
									<div class="col-lg-12">
										<section class="panel">
										  <header class="panel-heading">
											<i class="fa fa-wrench fa-lg"></i> Bulk Excel Result Manager
											<span class="tools pull-right">
												<a href="javascript:;" class="fa fa-chevron-down"></a>
												<a href="javascript:;" class="fa fa-times"></a>
											</span>
										  </header>
										  <div class="panel-body wizGrade-line">'.$showSaveBtn; 
							
							
							require_once $wizGradeClassConfigDir;   /* include class configuration script */ 
					
							$course_codes = $course_info_mark;
							$course_codes_r = $course_info_mark;
									
							$courseArr[] = 'regnum';
							$courseToArr[] = 'regnum';
							$inc = 0;
							$scoreInt = 0;
										
									
							for ($b = $start_nkiru; $b <= $stop_njideka; $b++) {  /* loop array */
									
									$courseArr[] = $course_info_mark[$b][5]; //course raw codes
									$courseCodeArr[] = $course_info_mark[$b][1]; //course outer codes
									$courseToArr[] = $course_info_mark[$b][3]; //course total													
									
							} 
							
							$colCount = $stop_njideka + 3;
							
							if(!file_exists($uploadedFile)){  /* check uploaded file exits */
								
								echo "<img src=''   height = '1' width='1'> ";	
								$msg_e .= "*Ooooooops error, could not locate uploaded excel file."; 
								echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
								echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>"; exit; 											
								
							}
					
							require_once 'excelReader/excel-reader.php';   /* include excel class */ 	
							
							$data = new Spreadsheet_Excel_Reader("$uploadedFile");
							
							//echo "Total Sheets in this xls file: ".cPaginateTBount($data->sheets)."<br /><br />";
							
							
							$html="<section id='msgBoxSaveRS'>
							<table  id='wizGradeTBPage' class='table table-striped table-advance table-hover'> <thead>";
							
						
							for($i=0;$i<count($data->sheets);$i++) { // Loop to get all sheets in a file.
									
								
								if(count($data->sheets[$i][cells])>0) {// checking sheet not empty
										
										#echo "Sheet $i:<br /><br />Total rows in sheet $i  ".count($data->sheets[$i][cells])."<br />";
										
										
									for($j=1;$j<=count($data->sheets[$i][cells]);$j++) {// loop used to get each row of the sheet
											
										
										if($j <= 2){
												
													
												//$html.="<tr>";
												//$html.="<th colspan = '$colCount' align='center'><center>";
												//$html.=$data->sheets[$i][cells][$j][1];
												//$html.="</center></th>";
										}
										
						
										if($j == 3){ // colums to start sorting ie second column -  for Subjects Codes
													
													$html.="<tr>";	
													
													for($kk=1;$kk<=count($data->sheets[$i][cells][$j]);$kk++) {
														// This loop is created to get data in a table format.
													
														$html.="<th>";
														$html.=$data->sheets[$i][cells][$j][$kk];
														$html.="</th>";
													
														if($kk > 3){ // colums to start sorting ie second column
															
															$excelCCodeArr[] = $data->sheets[$i][cells][$j][$kk]; 
															
															if (trim($excelCCodeArr[$inc]) != trim($courseCodeArr[$inc])){  /* cross check excel header */
																
																echo "<img src=''   height = '1' width='1'> ";	
																$subExcel = $excelCCodeArr[$inc];
																$subDB = $courseCodeArr[$inc];
																$rColInt = ($inc + $foVal);
																$excelColHead = $alphabetArr[$rColInt]; 
																$msg_e = "Oooooooops Error, Subject Code <strong>$subDB (Row $j)</strong> 
																in database does not correspond with Subjects Code <strong>$subExcel 
																(Column $excelColHead)</strong> in uploaded 
																Excel file.
																Please cross check the excel file and re-upload again.";
																unlink($uploadedFile);
																echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																echo "<script type='text/javascript'> 
																hidePageLoader();  /* hide page loader */	</script>"; exit; 
															
															
															}
															
															$inc = $inc + 1;
														}
														
														
													}
						
											
													$excelCCodeArr = ''; $courseCodeArr = '';
													
													
									
										}
											
											
											
													
										if($j > 3){ //Rows to start sorting  ie second row
											
											
								
													$html.="<tr>";
													
													for($k=1;$k<=count($data->sheets[$i][cells][$j]);$k++) {
														// This loop is created to get data in a table format.
													
														$rowData = $data->sheets[$i][cells][$j][$k]; 
																													
														$html.="<td>";
														$html.=substr($data->sheets[$i][cells][$j][$k], 0, 30);
														$html.="</td>";
						
														//if($k <= 3){
															
															
															if($rowData == ''){  /* check if excel row is empty */
																
																$excelCol = $alphabetArr[$k]; 
																echo "<img src=''   height = '1' width='1'> ";	
																$msg_e .= "*Ooooooops error, row no. <strong>$j</strong> 
																and column <strong>$excelCol</strong> is empty in 
																uploaded file. Please input correct data or  dashed
																'-' where cell is empty. "; 
																unlink($uploadedFile);
																echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>"; exit; 
														
																$is_clean = FALSE;
																
															}
															
															
														//}
														
														if($k > 2){ // colums to start sorting ie second column
															
															if($rowData == ''){  /* check if excel row is empty */
															
																$rsArray[] = 0;
															
															}else{																	
																	
																 $rsArray[] = htmlspecialchars($data->sheets[$i][cells][$j][$k]);																	
																
															
															}
															
									
														}
														
														
														
														
													}
													 
									 
													$regNum = $rsArray[0];
													
													$courseArray = array_combine($courseArr, $rsArray);  /* combine two arrays */
													
													unset($courseArray['regnum']); 
													
																
												
												if($uMode == $seVal){   /* save information */ 	
									
									
													$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */
													$rsStatus = wizGradeResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */
													$sessionIDT = sessionID($conn, $session);  /* school session ID */	
								
													if  ($rsStatus == $rspublishStage){	 /* check student result is already publish */		
														
														$session = wizGradeSession($conn, $sessionID);  /* school session  */			
														$session_se = $session + $foreal;
														$SessSem = schoolTerm($term);  /* school session term */
														
														unlink($uploadedFile);																
														$msg = "$tframeF $SessSem Semester $session - $session_se $tframeS";																
														echo $errorMsg.$msg.$eEnd; echo $scrollUp; 
														echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>"; exit;	
								
													}									
													
													$ebele_mark = "SELECT f.ireg_id, r.nk_regno
									
																	 FROM $i_reg_tb r, $sdoracle_comment_nk f
												
																	 WHERE r.nk_regno = :nk_regno
												
																	 AND r.ireg_id = f.ireg_id
																	 
																	 AND  r.session_id = :session_id
																	 
																	 AND r.$nk_class = :sClass
																	 
																	 AND  r.active = :active";
														 
													$igweze_prep = $conn->prepare($ebele_mark);										
													$igweze_prep->bindValue(':nk_regno', $regNum);
													$igweze_prep->bindValue(':sClass', $class);	
													$igweze_prep->bindValue(':session_id', $sessionIDT);	
													$igweze_prep->bindValue(':active', $fiVal);	
													$igweze_prep->execute();
													
													$rows_count = $igweze_prep->rowCount(); 
													
													if($rows_count != $foreal) {	 /* check if student really exits */
														
														echo "<img src=''   height = '1' width='1'> ";
														$msg = "*Oooooooops Error, student with Reg. No.
																<span> $regNum </span>
																do not exist or is inactive or does not belong to this class, this 
																record was not added !. 
																Please kindly delete this row from excel to continue.<br />";
																unlink($uploadedFile);
																echo $erroMsg.$msg.$msgEnd; echo $scrollUp; 
																echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																$('#bulkRSExcel').val('');</script>"; exit; 		
															
													}else{  /* insert/update information */
														
												
														while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
										   
															$checked_id = $row['ireg_id'];
															
														}
									
													
														$ebele_mark_2 = "UPDATE $sdoracle_comment_nk SET ";
									
																			foreach($courseArray as $subj => $score) {  /* loop array */
									
																			   if($subj != 'insert' && $subj != 'regnum') {
																															 
																					  $ebele_mark_2 .= ' '.$subj.' = :'.$subj.','; 
																					  $values_2[':'.$subj] = $score; 
																					
																				}
									
																			}
																			
														$ebele_mark_2 = trim($ebele_mark_2, ', ');											
														$ebele_mark_2 .= ' WHERE  ireg_id = :reg_id';											
														$igweze_prep_2 = $conn->prepare($ebele_mark_2);											
														$values_2[':reg_id'] = $checked_id;															 
														$igweze_prep_2->execute($values_2); 																	 
														  
														if  ($igweze_prep_2->execute($values_2)){  /* if sucessfully */ 									
															  
															
															
														}else {  /* display error */
														  
															  echo "<img src=''   height = '1' width='1'> ";									
															  $msg_e =  "Ooooooops error, could not input student  with Reg. No
															 (<span> $regNum </span>)
															  result. Please try again";
															  unlink($uploadedFile);
															  echo $scrollUp;
															  echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";
															   echo $erroMsg.$msg_e.$msgEnd;
																														  
															  exit; 
								
														} 
							
							
													}
													  
												}	 
												 
											
										}
										
										$rsArray = '';  $excelCCodeArr = ''; 
													
													
													
										$html.="</tr>";
													
										if($j == 3){
														
											$html.="</thead>
											<tbody>";
											
										}
									
						
									}
											
								}
							
							}
										
										
								$html.="</tbody></table></section>
												
									<script type='text/javascript'> 
																										
											$('#hiRSData').text('".$uploadData."');											
											hidePageLoader();  /* hide page loader */			 
										
									</script>"; 
												
								if($uMode == $fiVal){  /* if sucessfully excel upload validation */  
									
									echo "<img src=''   height = '1' width='1'> ";	
									$msg_i =  "Excel Upload Comments Auto Error Cross Checking and Preview was was Successfully. Please cross check
									and save bulk upload.";
									echo $html;
									echo $infMsg.$msg_i.$msgEnd;
									
									
								}else{  /* if sucessfully */ 
										echo "<img src=''   height = '1' width='1'> ";	
										echo '<br />';																  
										$msg_s =  "Class Subject Teacher Comment Bulk Excel  was successfully saved.";
										unlink($uploadedFile);
										echo $succMsg.$msg_s.$msgEnd;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";
																							
									
								}
								
								
								echo '</div>
									  </section>
									  </div>
								  </div>';
								$showTokenDiv = true;	
								resetResultComputation($conn, $sessionID, $level, $class, $term);  /* reset results computaion */
								require_once ($wizGradeFormTeacherDir.'rsConfigDiv.php');  /* include result configuration div */    
								
								exit;	 


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
					
exit;
?>