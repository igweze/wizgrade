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
	This script handle student bulk result uploads
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

		define('wizGrade', 'igweze');  /* define a check for wrong access of file */

		require 'configwizGrade.php';  /* load wizGrade configuration files */	   
			 
		if (($_REQUEST['rsData']) == 'bulkExcelRS') { 
										
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
	
				$a = 1; $b = 2; $c = 3; $e = 4; $f = 0;
				
				$minCourseArray = levelminCourseArray($conn); /* retrieve student level minimum course array */
				$examArray = schoolExamConfigArrays($conn);  /* school exam configuration array  */
				$exam_status = $examArray[0]['status'];	
				$fiAssScore = $examArray[0]['fi_ass'];	
				$seAssScore = $examArray[0]['se_ass'];	
				$thAssScore = $examArray[0]['th_ass'];
				$foAssScore = $examArray[0]['fo_ass'];
				$fifAssScore = $examArray[0]['fif_ass'];
				$sixAssScore = $examArray[0]['six_ass'];	
				$exam_score = $examArray[0]['exam'];
				
				$courseCountLimit = $minCourseArray[$level]['minCourse']; //$courseCountLimit = 9;
				
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
								
									$showSaveBtn = '<div style="margin: 10px 3px;" class="display-none saveExcelBtn">
										<button  class="btn btn-white pull-right saveBulkRSExcel" id="'.$uploadData.'">
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
									
									$courseArr[] = $course_info_mark[$b][0]; //course raw codes
									$courseCodeArr[] = $course_info_mark[$b][1]; //course outer codes
									$courseToArr[] = $course_info_mark[$b][3]; //course total													
									
							} 
							
							$colCount = $stop_njideka + 3;
							
							if(!file_exists($uploadedFile)){  /* check uploaded file exits */
								
								echo "<img src=''   height = '1' width='1'> ";
								$msg_e .= "*Ooooooops error, could not locate uploaded excel file."; 
								echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
								echo "<script type='text/javascript'> 	hidePageLoader();  /* hide page loader */	$('#bulkRSExcel').val('');	</script>"; exit; 											
								
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
						
										if($j == 3){ // colums to start sorting ie second column -  for Subjects Codes
													
													$html.="<tr>";	
													
													for($kk=1;$kk<=count($data->sheets[$i][cells][$j]);$kk++) {
														// This loop is created to get data in a table format.
													
														$html.="<th>";
														$html.=$data->sheets[$i][cells][$j][$kk];
														$html.="</th>";
													
														if($kk > 3){ // colums to start sorting ie second column
															
															$excelCCodeArr[] = $data->sheets[$i][cells][$j][$kk];
														 
															if ( trim($excelCCodeArr[$inc]) != trim($courseCodeArr[$inc])){  /* cross check excel header */
																
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
																hidePageLoader();  /* hide page loader */	$('#bulkRSExcel').val('');</script>"; exit; 
															
															
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
														$html.=$data->sheets[$i][cells][$j][$k];
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
																echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	$('#bulkRSExcel').val('');</script>"; exit; 
														
																$is_clean = false;
																
															}
															
															
														//}
														
														if($k > 2){ // colums to start sorting ie second column
															
															if($rowData == ''){  /* check if excel row is empty */
															
																$rsArray[] = 0;
															
															}else{																	
																	
																 $rsArray[] = $data->sheets[$i][cells][$j][$k];																	
																	
																//$rsArray[] = preg_replace("/[^0-9-,]/", "", $data->sheets[$i][cells][$j][$k]);
																
															
															}
															
									
														} 
														
													}
													
													
													$rsSumArr[] = $rsArray[0];
													$regNum = $rsArray[0];
													 
													$c_count = 0; $cc_count = 0; $cv_count = 0;
													$scoreInt = 0;
													
													for($c=1; $c <= (count($rsArray) - 1); $c++) {  /* loop array */															
														
														$rScoreInt = ($scoreInt + $foVal);
														
														$excelScoreCol = $alphabetArr[$rScoreInt]; 
														
														if(trim($rsArray[$c]) == "-"){ goto wizGradeRSCont;   /* check if input is null goto wizGradeRSCont */ }  
														  
														if($exam_status == $fiVal){  /* check school exam status */
															 
															list ($fi_score, $examScore) = explode (",", $rsArray[$c]);
															
															$scoresC = explode(",", $rsArray[$c]);
															$scoresCount = count($scoresC); 
															
															if($scoresCount == $fiVal){
																
																if(($fi_score > 100) || ($fi_score == "")){
																
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    Exam score 
																	is <strong>$fi_score</strong>
																	which is high than required set score <strong>100</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																
																}else{ $totalScore = $fi_score; }
																
															
															}elseif($scoresCount > $seVal){ 
																
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    record  
																	is more that <b>$seVal</b> scores. Please cross check record and continue"; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																
															
															}else{	
															
																$fi_score = preg_replace("/[^0-9]/", "", $fi_score);
																$examScore = preg_replace("/[^0-9]/", "", $examScore);
																
																if(($fi_score > $fiAssScore) || ($fi_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)   1st Assessment score 
																	is <strong>$fi_score</strong>
																	which is high than required set score <strong>$fiAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($examScore > $exam_score) || ($examScore == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    Exam score is 
																	<strong>$examScore</strong>
																	which is high than required set exam score <strong>$exam_score</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}else{ $totalScore = ($fi_score + $examScore); }
														
															}
															 
														}elseif($exam_status == $seVal){  /* check school exam status */
															 
															list ($fi_score, $se_score, $examScore) = explode (",", $rsArray[$c]);
															
															$scoresC = explode(",", $rsArray[$c]);
															$scoresCount = count($scoresC); 
															
															if($scoresCount == $fiVal){
																
																if(($fi_score > 100) || ($fi_score == "")){
																
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    Exam score 
																	is <strong>$fi_score</strong>
																	which is high than required set score <strong>100</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																
																}else{ $totalScore = $fi_score; }
																
															
															}elseif($scoresCount > $thVal){ 
																
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    record  
																	is more that <b>$thVal</b> scores. Please cross check record and continue"; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																
															
															}else{	
															
																$fi_score = preg_replace("/[^0-9]/", "", $fi_score);
																$se_score = preg_replace("/[^0-9]/", "", $se_score);
																$examScore = preg_replace("/[^0-9]/", "", $examScore);
																
																
																if(($fi_score > $fiAssScore) || ($fi_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    1st Assessment 
																	score is <strong>$fi_score</strong>
																	which is high than required set score <strong>$fiAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($se_score > $seAssScore) || ($se_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    2nd Assessment 
																	score is <strong>$se_score</strong>
																	which is high than required set score <strong>$seAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($examScore > $exam_score) || ($examScore == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    Exam score 
																	is <strong>$examScore</strong>
																	which is high than required set exam score <strong>$exam_score</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}else{ $totalScore = ($fi_score + $se_score + $examScore); }
															}															 
															 
														}elseif($exam_status == $thVal){  /* check school exam status */
															 
															list ($fi_score, $se_score, $th_score, $examScore) = explode (",", $rsArray[$c]);
															
															$scoresC = explode(",", $rsArray[$c]);
															$scoresCount = count($scoresC); 
															
															if($scoresCount == $fiVal){
																
																if(($fi_score > 100) || ($fi_score == "")){
																
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    Exam score 
																	is <strong>$fi_score</strong>
																	which is high than required set score <strong>100</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																
																}else{ $totalScore = $fi_score; }
																
															
															}elseif($scoresCount > $foVal){ 
																
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    record  
																	is more that <b>$foVal</b> scores. Please cross check record and continue"; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																
															
															}else{	
															
																$fi_score = preg_replace("/[^0-9]/", "", $fi_score);
																$se_score = preg_replace("/[^0-9]/", "", $se_score);
																$th_score = preg_replace("/[^0-9]/", "", $th_score);
																$examScore = preg_replace("/[^0-9]/", "", $examScore);
																
																if(($fi_score > $fiAssScore) || ($fi_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    1st Assessment score 
																	is <strong>$fi_score</strong>
																	which is high than required set score <strong>$fiAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($se_score > $seAssScore) || ($se_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    2nd Assessment score 
																	is <strong>$se_score</strong>
																	which is high than required set score <strong>$seAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($th_score > $thAssScore) || ($th_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    3rd Assessment score 
																	is <strong>$th_score</strong>
																	which is high than required set score <strong>$thAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($examScore > $exam_score) || ($examScore == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>) 
																	Exam score is <strong>$examScore</strong>
																	which is high than required set exam score <strong>$exam_score</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	\$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}else{ $totalScore = ($fi_score + $se_score + $th_score + $examScore); }
														
															}																 
															 
														}elseif($exam_status == $foVal){  /* check school exam status */
															 
															list ($fi_score, $se_score, $th_score, $fo_score, $examScore) = explode (",", $rsArray[$c]);
															
															
															$scoresC = explode(",", $rsArray[$c]);
															$scoresCount = count($scoresC); 
															
															if($scoresCount == $fiVal){
																
																if(($fi_score > 100) || ($fi_score == "")){
																
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    Exam score 
																	is <strong>$fi_score</strong>
																	which is high than required set score <strong>100</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																
																}else{ $totalScore = $fi_score; }
																
															
															}elseif($scoresCount > $fifVal){ 
																
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    record  
																	is more that <b>$fifVal</b> scores. Please cross check record and continue"; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																
															
															}else{	
															
																$fi_score = preg_replace("/[^0-9]/", "", $fi_score);
																$se_score = preg_replace("/[^0-9]/", "", $se_score);
																$th_score = preg_replace("/[^0-9]/", "", $th_score);
																$fo_score = preg_replace("/[^0-9]/", "", $fo_score);
																$examScore = preg_replace("/[^0-9]/", "", $examScore);
																
																if(($fi_score > $fiAssScore) || ($fi_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    1st Assessment score 
																	is <strong>$fi_score</strong>
																	which is high than required set score <strong>$fiAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($se_score > $seAssScore) || ($se_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    2nd Assessment score 
																	is <strong>$se_score</strong>
																	which is high than required set score <strong>$seAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($th_score > $thAssScore) || ($th_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    3rd Assessment score 
																	is <strong>$th_score</strong>
																	which is high than required set score <strong>$thAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($fo_score > $foAssScore) || ($fo_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    4th Assessment score 
																	is <strong>$fo_score</strong>
																	which is high than required set score <strong>$foAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($examScore > $exam_score) || ($examScore == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>) 
																	Exam score is <strong>$examScore</strong>
																	which is high than required set exam score <strong>$exam_score</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}else{ $totalScore = ($fi_score + $se_score + $th_score + $fo_score + $examScore); }
																
															}
																															 
															 
														}elseif($exam_status == $fifVal){  /* check school exam status */
															 
															list ($fi_score, $se_score, $th_score, $fo_score, $fif_score,
															$examScore) = explode (",", $rsArray[$c]);
															
															$scoresC = explode(",", $rsArray[$c]);
															$scoresCount = count($scoresC); 
															
															if($scoresCount == $fiVal){
																
																if(($fi_score > 100) || ($fi_score == "")){
																
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    Exam score 
																	is <strong>$fi_score</strong>
																	which is high than required set score <strong>100</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																
																}else{ $totalScore = $fi_score; }
																
															
															}elseif($scoresCount > $sixVal){ 
																
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    record  
																	is more that <b>$sixVal</b> scores. Please cross check record and continue"; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																
															
															}else{	
															
																$fi_score = preg_replace("/[^0-9]/", "", $fi_score);
																$se_score = preg_replace("/[^0-9]/", "", $se_score);
																$th_score = preg_replace("/[^0-9]/", "", $th_score);
																$fo_score = preg_replace("/[^0-9]/", "", $fo_score);
																$fif_score = preg_replace("/[^0-9]/", "", $fif_score);
																$examScore = preg_replace("/[^0-9]/", "", $examScore);
																
																if(($fi_score > $fiAssScore) || ($fi_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    1st Assessment score 
																	is <strong>$fi_score</strong>
																	which is high than required set score <strong>$fiAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($se_score > $seAssScore) || ($se_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    2nd Assessment score 
																	is <strong>$se_score</strong>
																	which is high than required set score <strong>$seAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($th_score > $thAssScore) || ($th_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    3rd Assessment score 
																	is <strong>$th_score</strong>
																	which is high than required set score <strong>$thAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($fo_score > $foAssScore) || ($fo_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    4th Assessment score 
																	is <strong>$fo_score</strong>
																	which is high than required set score <strong>$foAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($fif_score > $fifAssScore) || ($fif_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    5th Assessment score 
																	is <strong>$fif_score</strong>
																	which is high than required set score <strong>$fifAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($examScore > $exam_score) || ($examScore == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>) 
																	Exam score is <strong>$examScore</strong>
																	which is high than required set exam score <strong>$exam_score</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}else{ $totalScore = ($fi_score + $se_score + $th_score + $fo_score + $fif_score 
																					  + $examScore); }
														
															}																 
															 
														}elseif($exam_status == $sixVal){  /* check school exam status */
															 
															list ($fi_score, $se_score, $th_score, $fo_score, $fif_score, $six_score,
															$examScore) = explode (",", $rsArray[$c]); 
															
															$scoresC = explode(",", $rsArray[$c]);
															$scoresCount = count($scoresC); 
															
															if($scoresCount == $fiVal){
																
																if(($fi_score > 100) || ($fi_score == "")){
																
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    Exam score 
																	is <strong>$fi_score</strong>
																	which is high than required set score <strong>100</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																
																}else{ $totalScore = $fi_score; }
																
															
															}elseif($scoresCount > $seVal){ 
																
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    record  
																	is more that <b>$seVal</b> scores. Please cross check record and continue"; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																
															
															}else{	
															
																$fi_score = preg_replace("/[^0-9]/", "", $fi_score);
																$se_score = preg_replace("/[^0-9]/", "", $se_score);
																$th_score = preg_replace("/[^0-9]/", "", $th_score);
																$fo_score = preg_replace("/[^0-9]/", "", $fo_score);
																$fif_score = preg_replace("/[^0-9]/", "", $fif_score);
																$six_score = preg_replace("/[^0-9]/", "", $six_score);
																$examScore = preg_replace("/[^0-9]/", "", $examScore);
																
																if(($fi_score > $fiAssScore) || ($fi_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    1st Assessment score 
																	is <strong>$fi_score</strong>
																	which is high than required set score <strong>$fiAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($se_score > $seAssScore) || ($se_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    2nd Assessment score 
																	is <strong>$se_score</strong>
																	which is high than required set score <strong>$seAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($th_score > $thAssScore) || ($th_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    3rd Assessment score 
																	is <strong>$th_score</strong>
																	which is high than required set score <strong>$thAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($fo_score > $foAssScore) || ($fo_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    4th Assessment score 
																	is <strong>$fo_score</strong>
																	which is high than required set score <strong>$foAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($fif_score > $fifAssScore) || ($fif_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    5th Assessment score 
																	is <strong>$fif_score</strong>
																	which is high than required set score <strong>$fifAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($six_score > $sixAssScore) || ($six_score == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>)    6th Assessment score 
																	is <strong>$six_score</strong>
																	which is high than required set score <strong>$sixAssScore</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}elseif(($examScore > $exam_score) || ($examScore == "")){
																	
																	echo "<img src=''   height = '1' width='1'> ";
																	$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
																	(<strong>Row No. $j - Column $excelScoreCol</strong>) 
																	Exam score is <strong>$examScore</strong>
																	which is high than required set exam score <strong>$exam_score</strong>."; 
																	unlink($uploadedFile);		 
																	echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
																	echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
																	$('#bulkRSExcel').val('');</script>"; exit; 
																	$is_clean = false;																		
																	
																}else{ $totalScore = ($fi_score + $se_score + $th_score + $fo_score + $fif_score 
																					  + $six_score + $examScore); }
															
																																 
															}	
															
														}else{  /* display error */
																 
															echo "<img src=''   height = '1' width='1'> ";
															$msg_e .= "*Ooooooops Error, could not find school exam format configurations."; 
															unlink($uploadedFile);		 
															echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
															echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	
															$('#bulkRSExcel').val('');</script>"; exit; 
											
															$is_clean = false;
																 
																 
														}
														 
														 
														wizGradeRSCont: /* if input is null continue from here */
													 
														$c_count++;
													 
														if (  (floor($totalScore) > 100) )  {  /* check subject total score is more than 100 */											
															
															echo "<img src=''   height = '1' width='1'> ";																	
															$msg_e .= "*Ooooooops Error, student with Reg. No. <strong>$regNum</strong>
															(<strong>Row No. $j - Column $excelScoreCol</strong>)   total score 
															is <strong>$totalScore</strong>. 
															Please total score can not be more than 100 or please input dashed '-' where 
															score is empty."; 
															unlink($uploadedFile);		 
															echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp; 
															echo "<script type='text/javascript'> 
															hidePageLoader();  /* hide page loader */	$('#bulkRSExcel').val('');</script>"; exit; 
															$is_clean = false;	
															
														}else{
								
															if ( (floor($totalScore) > 1) && (floor($totalScore) <= 100) )  {  /* check total */ 
															
																$cc_count++;
															
															}

														}
														
														/*if ($totalScore == '')   { 
														


														}else{
															
															
															$cc_count++;
															
															
														} */
																
														if(($courseCountLimit == 'all') || ($cc_count >= $courseCountLimit)){  /* check class course limit */	
																	
															$c_count = $cc_count;
																	
														}else{
																	
															$c_count = $courseCountLimit;
																	
														} 
																

														$rsSumArr[] = $totalScore;
														
														$scoreInt = $scoreInt + 1;
														$totalScore = '';
													
													}
												 
									 
													$courseArray = array_combine($courseArr, $rsArray);  /* combine two arrays */
													$courseArraySum = array_combine($courseToArr, $rsSumArr);  /* combine two arrays */
													
													unset($courseArray['regnum']);
													unset($courseArraySum['regnum']);
													
													$grand_c_total = array_sum($courseArraySum);  /* total array sum */ 
						 
													
												if($grand_c_total >= $fiVal){   /* check if total is an interger before dividing it */				
												
													$grade_nk = ($grand_c_total / $c_count);   														
													$grade_nk = number_format($grade_nk, 1);	
													
												}
												
												if($uMode == $seVal){   /* save information */ 	 
									
													$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */
													$rsStatus = wizGradeResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */	
													$sessionIDT = sessionID($conn, $session);  /* school session ID */	
								
													if  ($rsStatus == $rspublishStage){	 /* check student result is already publish */		
														
														$session = wizGradeSession($conn, $sessionID);  /* school session */			
														$session_se = $session + $foreal;
														$SessSem = schoolTerm($term);  /* school term */
														
														unlink($uploadedFile);																
														$msg = "$tframeF $SessSem Semester $session - $session_se $tframeS";																
														echo $erroMsg.$msg.$msgEnd; echo $scrollUp; 
														echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>"; exit;	
								
													}
													
													$ebele_mark = "SELECT f.ireg_id, r.nk_regno
									
																	 FROM $i_reg_tb r, $sdoracle_score_nk f
												
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
									
														$conn->beginTransaction();  /* begin data input transaction */				 
														echo "$sdoracle_score_nk 1 <br />";
													
														$ebele_mark_2 = "UPDATE $sdoracle_score_nk SET ";
									
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
										
														echo "$sdoracle_sub_score_nk 11 <br />";
													
														$ebele_mark_3 = "UPDATE $sdoracle_sub_score_nk SET ";
									
																			foreach($courseArraySum as $subjs => $scores) {  /* loop array */
									
																			   if($subj != 'insert' && $subjs != 'regnum') {
																															 
																					  $ebele_mark_3 .= ' '.$subjs.' = :'.$subjs.','; 
																					  $values_3[':'.$subjs] = $scores;
																					  
																				}
									
																			}
																			
																			
														$ebele_mark_3 = trim($ebele_mark_3, ', ');											
														$ebele_mark_3 .= ' WHERE  ireg_id = :reg_id';											
														$igweze_prep_3 = $conn->prepare($ebele_mark_3);											
														$values_3[':reg_id'] = $checked_id;																									 
														$igweze_prep_3->execute($values_3);
									
																			
														$ebele_mark_4 = "UPDATE $sdoracle_grand_score_nk SET  
													
																			$term_score = :grand_to,
																			
																			$term_avg = :grade_nk 
																			
																			WHERE  ireg_id = :reg_id";
																			
														$igweze_prep_4 = $conn->prepare($ebele_mark_4);											
														$igweze_prep_4->bindValue(':reg_id', $checked_id);
														$igweze_prep_4->bindValue(':grand_to', $grand_c_total);
														$igweze_prep_4->bindValue(':grade_nk', $grade_nk); 															 
														$igweze_prep_4->execute();
																		 

														if($cal_session == true){  /* if school term is third term */ 
														
															$reportStatus = updateGrandSessionRS($conn, $sdoracle_grand_score_nk, $checked_id, $fiGrandTotal, $seGrandTotal, 
																		 $thGrandTotal, $grandTotal, $grandAvg);  /* update student grand annual score  */
															
															if($reportStatus == $i_false){  /* display error */
																
																$msg_i =  "Ooooooops error, could not input student  with Reg. No
																(<span> $regNum </span>)
																 total session result. Please try again";
																echo $infMsg.$msg_i.$msgEnd;
																
															
															}								
														 
														}


															 
														  
														if  (($igweze_prep_2) && ($igweze_prep_3) && ($igweze_prep_4)){  /* if sucessfully */ 									
															  
																$conn->commit(); /* if everything is alright then insert data accross tables */	
																$rsArray = '';  $grand_c_total =''; $rsSumArr  = ''; $excelCCodeArr = ''; 
																$courseArray = ''; $courseArraySum = '';
																$grand_c_total = ''; $grade_nk = '';		
															
														}else {  /* display error */
														  
															  $conn->rollBack(); /* if everything is not alright then don't insert data accross tables */		
															  echo "<img src=''   height = '1' width='1'> ";	
															  $msg_e =  "Ooooooops error, could not input student  with Reg. No
															 (<span> $regNum </span>)
															  result. Please try again";
															  unlink($uploadedFile);
															  echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp;
															  echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";
																														  
															  exit; 
								
														} 
							
							
													}
													  
												}	  

											
										}
												
						
											
										$rsArray = '';  $grand_c_total =''; $rsSumArr  = ''; $excelCCodeArr = ''; $courseArray = ''; 
										$courseArraySum = ''; $grade_nk = '';//$courseCodeArr = '';
													
													 
													
													
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
										$msg_i =  "Excel Upload Result Auto Error Cross Checking and Preview was Successfully. Please cross check
										and save the bulk upload.";
										echo $infMsg.$msg_i.$msgEnd;
										echo $html;
										echo "<script type='text/javascript'> $('.saveExcelBtn').fadeIn(200);</script>";
									
								}else{  /* if sucessfully */ 
										echo "<img src=''   height = '1' width='1'> ";
										echo '<br />';																  
										$msg_s =  "Class Excel Bulk Result was successfully saved.";
										unlink($uploadedFile);
										echo $succMsg.$msg_s.$msgEnd ;
										echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";
																							
									
								}
								
								
								echo '</div>
									  </section>
									  </div>
								  </div>';
								$showTokenDiv = true;	
								resetResultComputation($conn, $sessionIDT, $level, $class, $term);  /* reset results computaion */
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