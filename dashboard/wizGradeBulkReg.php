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
	This script handle student mass registration
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

		define('wizGrade', 'igweze');  /* define a check for wrong access of file */

		require 'configwizGrade.php';  /* load wizGrade configuration files */	  
		
		if (($_REQUEST['bioData']) == 'bulkExcelBio') {
				 
										
			$en_term = $_REQUEST['term']; 
			$en_level = $_REQUEST['level']; 
			$class = $_REQUEST['class'];
			$session = $_REQUEST['sess'];
			$uMode = $_REQUEST['uMode'];
			$uData = $_REQUEST['uploadData'];
			$regDate =  date("Y-m-d H:i:s");

			$a = 1; $b = 2; $c = 3; $e = 4; $f = 0; 
		  
			
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

							$uploadData = $en_term.'::$::'.$en_level.'::$::'.$class.'::$::'.$session.'::$::'.$uploadedPic;
							
							wizGradeSaveRS:  /* save information */		
							
							if($uMode == $seVal){   /* save information */ 
							
								list ($en_term, $en_level, $class, $session, $uploadedPic) = explode ("::$::", $uData);
								
								$uploadedFile = $rsUploadsPath.$uploadedPic;
								$showSaveBtn = "";
								
								echo '<div class="row">
									<div class="col-lg-5">
										<section class="panel">
										  <header class="panel-heading">
												<i class="fa fa-user-plus fa-lg"></i> Bulk  Excel Registration Manager
												<span class="tools pull-right">
													<a href="javascript:;" class="fa fa-chevron-down"></a>
													<a href="javascript:;" class="fa fa-times"></a>
												</span>
											  
					
										  </header>
										  <div class="panel-body wizGrade-line">'.$showSaveBtn;
								
							}else{
								
								$showSaveBtn = '<div style="margin: 10px 3px;">
									  <button  class="btn btn-white pull-right saveBulkRegExcel" id="'.$uploadData.'">
										<i class="fa fa-save text-info"></i> 
										<span> Save Bulk Reg.</span>
										</button>
										</div><br clear="all"/><br clear="all"/>';
										
								echo '<div class="row">
									<div class="col-lg-12">
										<section class="panel">
										  <header class="panel-heading">
											  Bulk Excel Registration Manager
											  
					
										  </header>
										  <div class="panel-body wizGrade-line">'.$showSaveBtn;		
							}	

							
							
							if($uMode == $seVal){   /* save information */ 																		
							
									echo "<script type='text/javascript'> $('#paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */
											$('.printer-icon').show();	</script>";		
									echo "<table id='wizGradeTBPage' class='table table-striped table-advance table-hover wizGradePrintArea'>
										<thead><tr><th>New Reg No.</th> <th>Name</th><th>Tasks</th></tr></thead> <tbody>";														
												
							} 
							
							$inc = 0; 
							
							if(!file_exists($uploadedFile)){  /* check uploaded file exits */
								
								echo "<img src=''   height = '1' width='1'> ";	
								$msg_e .= "*Ooooooops error, could not locate uploaded excel file."; 
								echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
								echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	 exit; 											
								
							}
					
							require_once 'excelReader/excel-reader.php';   /* include excel class */ 	
							
							$data = new Spreadsheet_Excel_Reader("$uploadedFile"); 
							
							$html="<section id='msgBoxSaveRS'>
							<table  id='wizGradeTBPage' class='table table-striped table-advance table-hover'> <thead>";
							
						
							for($i=0;$i<count($data->sheets);$i++) { // Loop to get all sheets in a file.
									
								
								if(count($data->sheets[$i][cells])>0) {// checking sheet not empty 										
										
									for($j=1;$j<=count($data->sheets[$i][cells]);$j++) {// loop used to get each row of the sheet
											
										if($j <= 2){												
													
												//$html.="<tr>";
												//$html.="<th colspan = '$colCount' align='center'><center>";
												//$html.=$data->sheets[$i][cells][$j][1];
												//$html.="</center></th>";
										}
						
										if($j == 1){ // colums to start sorting ie second column -  for Subjects Codes
													
													$html.="<tr>";	
													
													for($kk=1;$kk<=count($data->sheets[$i][cells][$j]);$kk++) {
														// This loop is created to get data in a table format.
													
														$html.="<th>";
														$html.=$data->sheets[$i][cells][$j][$kk];
														$html.="</th>";
													
														//if($kk > 0){ // colums to start sorting ie second column
															
															$excelCCodeArr[] = $data->sheets[$i][cells][$j][$kk]; 
															
															if (trim($excelCCodeArr[$inc]) != trim($wizGradeBioArr[$inc])){  /* cross check excel header */
																
																echo "<img src=''   height = '1' width='1'> ";	
																$subExcel = $excelCCodeArr[$inc];
																$subDB = $wizGradeBioArr[$inc];
																$rColInt = ($inc + $fiVal);
																$excelColHead = $alphabetArr[$rColInt]; 
																$msg_e = "Oooooooops Error, Registration Column <strong>$subDB (Row $j)</strong> 
																in database does not correspond with Registration Column <strong>$subExcel 
																(Column $excelColHead)</strong> in uploaded 
																Excel file.
																Please cross check the excel file and re-upload again.";
																unlink($uploadedFile);
																echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																echo "<script type='text/javascript'> 
																hidePageLoader();  /* hide page loader */	</script>";	exit; 
															
															
															}
															
															$inc = $inc + 1;
														//}
														
														
													}
													$html.="</tr></thead>
														<tbody>";
						
											
													$excelCCodeArr = ''; $wizGradeBioArr = ''; 
													
									
										}  
											
													
										if($j > 1){ //Rows to start sorting  ie second row 
								
													$html.="<tr>";
													
													for($k=1;$k<=count($data->sheets[$i][cells][$j]);$k++) {
														// This loop is created to get data in a table format.
													
														$rowData = $data->sheets[$i][cells][$j][$k]; 
																													
														$html.="<td>";
														$html.=$data->sheets[$i][cells][$j][$k];
														$html.="</td>"; 
															
															
															if($rowData == ''){  /* check if excel row is empty */
																
																$excelCol = $alphabetArr[$k]; 
																echo "<img src=''   height = '1' width='1'> ";	
																$msg_e .= "*Ooooooops error, row no. <strong>$j</strong> 
																and column <strong>$excelCol</strong> is empty in 
																uploaded file. Please input correct data or  dashed
																'-' where cell is empty. "; 
																unlink($uploadedFile);
																echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																
																echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	exit; 
														
																$is_clean = FALSE;
																
															} 
														
															
															if($rowData == ''){  /* check if excel row is empty */
															
																$bioArray[] = 0;
															
															}else{																	
																	
																 $bioArray[] = $data->sheets[$i][cells][$j][$k];	 
															
															}  
														
														
													} 
												
												
												if($uMode == $seVal){   /* save information */
														
														if($session != ''){
															 
															$sessionID = sessionID($conn, $session);  /* school session ID */
															
															$lastSessReg = sessionLastReg($conn, $session);  /* school session last student registration number  */
							
															/* generate new student registration number  */
															  
															$regC = explode("/", $lastSessReg);
															
															$regCount = count($regC);
															
															if($regCount == $thVal){
																
																list ($schSplit, $regSplit, $sup) = explode ("/", $lastSessReg);
																
															}elseif($regCount == $seVal){
																
																list ($regSplit, $sup) = explode ("/", $lastSessReg);
																
															}else{
																
																list ($regSplit) = explode ("/", $lastSessReg);

															}	 
																					
															if($regSplit == ''){
																					
																$newReg = $session.'0001';
																						
															}else{
																					
																$newReg = ($regSplit + $fiVal);
																		
															}		 
															
															if($regCount == $thVal){
																
																$regNum =  $schSplit.'/'.$newReg.$supRegNo;
																
															}elseif($regCount == $seVal){
																
																$regNum =  $newReg.$supRegNo;
																
															}else{
																
																$regNum =  $newReg.$supRegNo;

															} 
															
															mt_srand((double)microtime() * 1000000);							

															if($generatePass == $foreal){  /* check generate password status */
											
																$userPass = wizGradeRandomString($charset, 8);  /* generate password */
																$spon_access = wizGradeRandomString($charset, 5);  /* generate password */
											
															}else{
											
																$userPass = "password";
																$spon_access = "password";
											
															} 
															
															$showNewPanel = $thVal;  
															
															$lname = $bioArray[0];
															$fname = $bioArray[1];
															$mname = $bioArray[2];
															$gender = $bioArray[3];
															$dob = $bioArray[4];
															$bloodGP = $bioArray[5];
															$genoTP = $bioArray[6];
															$country = $bioArray[7];
															$state = $bioArray[8];
															$city = $bioArray[9];
															$add1 = $bioArray[10];
															$add2 = $bioArray[11];
															$phone = $bioArray[12];
															$email = $bioArray[13];
															$hostelID = $bioArray[14];
															$routeID = $bioArray[15];
															$spon = $bioArray[16];
															$sphone = $bioArray[17];
															$soccup = $bioArray[18];
															$adds = $bioArray[19];
															
															$cname = ucwords(strtolower($bioArray[0]));
															list ($lname, $fname, $mname) = explode (" ", $cname);
															
															if($schoolExt == $wizGradeNurAbr){  /* check school type */ 
																
																require ($wizGradeAdminDir.'wizGradeNurBio.php');  /* school registration script */
																
															}else{ 																		 
															
																require ($wizGradeAdminDir.'wizGradePSBio.php');  /* school registration script */
															}
															 		
															
														}else{ 
														
															//info
														} 
																	  
												} 
											
										}		
											
										$bioArray = '';  $excelCCodeArr = '' ; 
										$regNum = ''; $newReg = ''; $lastSessReg = ''; $regSplit =''; $bioArray = '';
															$regSplit = ''; $regCount = ''; $regC = ''; 
													
										$html.="</tr>"; 
													
						
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
										$msg_i =  "Bulk Excel Registration Auto Error Cross Checking and Preview was Successfully. Please kindly cross check
										and save the bulk registration.";
										echo $infMsg.$msg_i.$msgEnd;
										echo $html;
										echo '</div>  </section> </div> ';
									
								}else{  /* if sucessfully */ 
										echo "<img src=''   height = '1' width='1'> ";	
										echo '<br />';																  
										$msg_s =  "Class Excel Bulk Registration was successfully saved. Hence, click on the printer icon 
										to print new Reg. no.";
										unlink($uploadedFile);
										
										echo '</tbody></table> </div> </section> </div> ';
									
										echo '<div class="col-lg-7">
										
											  <section class="panel" id="wizGradeScrollTarget">
											 
																<header class="panel-heading">
																	<i class="fa fa-wrench fa-lg"></i>  Student Profile Tasks 
																	<span class="tools pull-right">
																		<a href="javascript:;" class="fa fa-chevron-down"></a>
																		<a href="javascript:;" class="fa fa-times"></a>
																	</span>
																</header>
																<div class="panel-body wizGrade-line">
															  
													
																<div id="wizGradeRightHalf">'; 
																echo $succMsg.$msg_s.$msgEnd ;																				
																
																echo '</div>
															  
															  </div>
													
											  </section>
											</div>';
											
											echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	 
																							
									
								}
								 
								
								echo "</div>"; 
								
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