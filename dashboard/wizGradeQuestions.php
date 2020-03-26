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
	This script handle student exam questions
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */
		        
			if ($_REQUEST['questionData'] == 'updateQuestion') {  /* save exam question */
					
				$qID = preg_replace("/[^0-9]/", "", $_REQUEST['qID']);			
				$eID = preg_replace("/[^0-9-]/", "", $_REQUEST['eID']);
				$question = $_REQUEST['question'];
				$qOptions =  $_REQUEST['qOptions'];
				$qAnswer = $_REQUEST['qAnswer'];
				$qPic = $_REQUEST['qPic'];
				$qMark = preg_replace("/[^0-9-]/", "", $_REQUEST['qMark']);
				
				/* script validation */ 
				
				if ($qID == ""){
         			
					echo "<img src=''   height = '1' width='1'> ";
					$msg_e = "* Ooooooooops, an error has occur to retrieve Question information. Please try again";
					echo $erroMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($eID == "")  {
					
         			echo "<img src=''   height = '1' width='1'> ";
					$msg_e = "* Oooooooops Error, please select an Exam to add Question";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($question == "")  {
         			echo "<img src=''   height = '1' width='1'> ";
					$msg_e = "* Oooooooops Error, please enter Exam Question";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($qOptions == "")  {
         			
					echo "<img src=''   height = '1' width='1'> ";
					$msg_e = "* Oooooooops Error, please enter Question Options";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($qAnswer == "")  {
         			
					echo "<img src=''   height = '1' width='1'> ";
					$msg_e = "* Oooooooops Error, please select a Question Answer";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($qMark == "")  {
         			
					echo "<img src=''   height = '1' width='1'> ";
					$msg_e = "* Oooooooops Error, please select a Question Mark";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* insert/update information */   					
				
					$qOptionsArr = explode(", ", $qOptions);

					if(!in_array($qAnswer, $qOptionsArr)){  /* check if array */
						
						echo "<img src=''   height = '1' width='1'> ";
						$msg_e = "* Oooooooops Error, your Question Answer was not found in Question Options";
						echo $errorMsg.$msg_e.$eEnd; 
						echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit; 
					
					}	
						
					
					$question = strip_tags($question);
					$question = str_replace('<br />', "\n", $question);
					$question = htmlspecialchars($question);					
					$qOptions =  htmlspecialchars($qOptions);
					$qAnswer = htmlspecialchars($qAnswer);
	
					$name = $_FILES['qPicture']['name']; 

					if(strlen($name)) {
						
						$picturePath = $wizGradeQuestionDir; /* picture path */
						
						$filePic = "qPicture"; /* picture file name */
						$pageDesc = "Question picture";
						
						/* call igweze file uploader */
						$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 1), $validPicExt, $validPicType, $allowedPicExt, 
						$fileType = "Picture", $fiVal); 
						 
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
									
								if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
										
										
									try { 

										if($qID >= $fiVal){
											
											if($qPic != ""){
												
												$oldQpic = $picturePath.$qPic;
												
												if(file_exists($oldQpic)){
													
													unlink($oldQpic);													
												}	

											}	
									
											$ebele_mark = "UPDATE $wizGradeQuestionTB  
																
																SET 
																
																eID = :eID, 
																question = :question, 
																qPicture = :qPicture,
																qOptions = :qOptions,
																qAnswer = :qAnswer,		
																qMark = :qMark
																
															WHERE qID = :qID";
										 
											$igweze_prep = $conn->prepare($ebele_mark);
											$igweze_prep->bindValue(':qID', $qID);
											$igweze_prep->bindValue(':eID', $eID);
											$igweze_prep->bindValue(':question', $question);
											$igweze_prep->bindValue(':qPicture', $uploadedPic);
											$igweze_prep->bindValue(':qOptions', $qOptions);
											$igweze_prep->bindValue(':qAnswer', $qAnswer);
											$igweze_prep->bindValue(':qMark', $qMark);
											
										}else{

											$ebele_mark = "INSERT INTO $wizGradeQuestionTB  (eID, question, qPicture, qOptions, qAnswer, qMark)

													VALUES (:eID, :question, :qPicture, :qOptions, :qAnswer, :qMark)";
										 
											$igweze_prep = $conn->prepare($ebele_mark);
											$igweze_prep->bindValue(':eID', $eID);
											$igweze_prep->bindValue(':question', $question);
											$igweze_prep->bindValue(':qPicture', $uploadedPic);
											$igweze_prep->bindValue(':qOptions', $qOptions);
											$igweze_prep->bindValue(':qAnswer', $qAnswer);
											$igweze_prep->bindValue(':qMark', $qMark);

										}

										if($igweze_prep->execute()){ /* insert picture name to database */
											
											echo "<img src=''   height = '1' width='1'> ";
											$msg_s = "Exam Question was successfully saved."; 
											echo $succesMsg.$msg_s.$sEnd; 
											echo "<script type='text/javascript'> $('#examQuesDiv').load('wizGradeQuestionsInfo.php?eID=".$eID."'); 
											   $('#editLoader').fadeOut(1500);  $('#editQuestionDiv').slideUp(1500);
											</script>";exit;
											
										}else{ /* display error messages */
											
											echo "<img src=''   height = '1' width='1'> ";
											$msg_e =  "Ooooooooops, an error has occur while to save Exam Question. Please try again";
											echo $errorMsg.$msg_e.$eEnd; 
											echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
											
										}
										

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
						
						try{
							
							if($qID >= $fiVal){
							
								$ebele_mark = "UPDATE $wizGradeQuestionTB  
													
													SET 
													
													eID = :eID, 
													question = :question, 
													qOptions = :qOptions,
													qAnswer = :qAnswer,		
													qMark = :qMark
													
												WHERE qID = :qID";
							 
								$igweze_prep = $conn->prepare($ebele_mark);
								$igweze_prep->bindValue(':qID', $qID);
								$igweze_prep->bindValue(':eID', $eID);
								$igweze_prep->bindValue(':question', $question);
								$igweze_prep->bindValue(':qOptions', $qOptions);
								$igweze_prep->bindValue(':qAnswer', $qAnswer);
								$igweze_prep->bindValue(':qMark', $qMark);
								
							}else{

								$ebele_mark = "INSERT INTO $wizGradeQuestionTB  (eID, question, qOptions, qAnswer, qMark)

										VALUES (:eID, :question, :qOptions, :qAnswer, :qMark)";
							 
								$igweze_prep = $conn->prepare($ebele_mark);
								$igweze_prep->bindValue(':eID', $eID);
								$igweze_prep->bindValue(':question', $question);
								$igweze_prep->bindValue(':qOptions', $qOptions);
								$igweze_prep->bindValue(':qAnswer', $qAnswer);
								$igweze_prep->bindValue(':qMark', $qMark);


							}

							if($igweze_prep->execute()){  /* if sucessfully */
								
								$msg_s = "Exam Question was successfully saved."; 
								echo $succesMsg.$msg_s.$sEnd ; 
								echo "<script type='text/javascript'> $('#examQuesDiv').load('wizGradeQuestionsInfo.php?eID=".$eID."'); 
								   $('#editLoader').fadeOut(1500);  $('#editQuestionDiv').slideUp(1500);
								</script>";exit;
								
							}else{  /* display error */ 
					
								$msg_e =  "Ooooooooops, an error has occur while to save Exam Question. Please try again";
								echo $errorMsg.$msg_e.$eEnd; 
								echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
								
							}						

						}catch(PDOException $e) {
  			
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
						}			

					} 
         		
        	
				}
			
			}elseif ($_REQUEST['questionData'] == 'removeQuestion') {  /* remove exam question */

				
				$questionData = $_REQUEST['rData'];
				
				list($wizGradeIg, $qID, $hName) = explode("-", $questionData);			
				
				/* script validation */ 
				
				if (($questionData == "")  || ($qID == "")){
         			
					$msg_e = "* Ooooooooops, an error has occur while to remove Question information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}else {   

		 			try { 
						
						$ebele_mark = "DELETE FROM 
						
										$wizGradeQuestionTB										
											
										WHERE qID = :qID
											
										LIMIT 1";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':qID', $qID); 
						
						if($igweze_prep->execute()){  /* if sucessfully */ 
							
							$removeDiv = "$('#row-".$qID."').fadeOut(1000);";
							$msg_s = "<strong>$hName</strong> was successfully removed"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'>   
							$('#removeLoader').fadeOut(1500); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to remove Question information. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['questionData'] == 'viewQuestion') {  /* view exam question */

				
				$qID = strip_tags($_REQUEST['rData']);
				
				/* script validation */
				
				if ($qID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve Question information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* select information */       			


		 			try {
						
						
									$questionInfoArr = questionInfo($conn, $qID);  /* online exam question information */
									//$qID = $questionInfoArr[$fiVal]["qID"];
									$eID = $questionInfoArr[$fiVal]["eID"];
									$question = htmlspecialchars_decode($questionInfoArr[$fiVal]["question"]);
									$qPicture = $questionInfoArr[$fiVal]["qPicture"];
									$qOptions = htmlspecialchars_decode($questionInfoArr[$fiVal]["qOptions"]);
									$qAnswer = htmlspecialchars_decode($questionInfoArr[$fiVal]["qAnswer"]);
									$qMark = $questionInfoArr[$fiVal]["qMark"];
									$question = nl2br($question);
									
									$eQPic = $wizGradeQuestionDir.$qPicture;
									
									if(($qPicture != "") && (file_exists($eQPic))){  /* check if picture exits */

$showQPicture =<<<IGWEZE
		
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										Question Picture </td> <td style="padding-left: 30px; 
										text-align:left; width: 70%;">
										<img src = "$eQPic" height = '170' width = '100%' > </td> </tr> 
				
		
IGWEZE;
				
 	
									}	
									
									

$showPayment =<<<IGWEZE
		
								<button  class="btn btn-white printer-icon pull-right">
								<i class="fa fa-print text-info"></i> Print </button><br clear="all"/><br clear="all"/>
						
								<div id = 'wizGradePrintArea'>

                                  	<!-- / table -->		
									<table width = '100%' class="table table-striped  table-advance table-hover"> 
										
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										Exam Question </td> <td style="padding-left: 30px; 
										text-align:left; width: 70%;">
										$question
										</td> </tr>
										
										$showQPicture 
										
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										Question Options </td> <td style="padding-left: 30px; 
										text-align:left; width: 70%;">
										$qOptions  </td> </tr> 
										
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										 Question Answer </td> <td style="padding-left: 30px; 
										text-align:left; width: 70%;">
										$qAnswer</td> </tr> 
										
										<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										Question Mark </td> <td style="padding-left: 30px; text-align:left; 
										width: 70%;">
										$qMark</td> </tr> 
										
									</table>
									<!-- /table -->	 
		
								</div>
		
IGWEZE;
				
								echo $showPayment; 
						
								echo "<script type='text/javascript'>  $('#editLoader').fadeOut(3000); </script>"; exit;
						
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		
		
         		
        	
				}
			
			}elseif ($_REQUEST['questionData'] == 'editQuestion') {  /* edit exam question */

				
				$qID = preg_replace("/[^0-9-]/", "", $_REQUEST['questionID']);
				$eID = preg_replace("/[^0-9-]/", "", $_REQUEST['examID']);
				
				/* script validation */ 
				
				if ($eID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve Exam Question information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       			


		 			try {
						
							if($qID >= $fiVal){  /* check if question ID is true */
								
								$questionInfoArr = questionInfo($conn, $qID);  /* online exam question information */
								//$qID = $questionInfoArr[$fiVal]["qID"];
								$eID = $questionInfoArr[$fiVal]["eID"];
								$question = htmlspecialchars_decode($questionInfoArr[$fiVal]["question"]);
								$qPicture = $questionInfoArr[$fiVal]["qPicture"];
								$qOptions = $questionInfoArr[$fiVal]["qOptions"];
								$qMark = $questionInfoArr[$fiVal]["qMark"];
								$qAnswer = $questionInfoArr[$fiVal]["qAnswer"];
								$eQPic = $wizGradeQuestionDir.$qPicture;
		
								if ((is_null($qPicture)) || ($qPicture == '') || (!file_exists($eQPic))) {  /* check if picture exits */
					
								   $eQPic = $wizGradeDefaultPic;
								   
								}
								
							}else{
								
								$qID = $i_false;
								$eQPic = $wizGradeDefaultPic;
							
							}	 
						
?>

								<!-- form -->
								<form class="form-horizontal" id="frmupdateQuestion" role="form" enctype="multipart/form-data" 
									action="wizGradeQuestions.php">
									  
									  
									<div class="form-group">
                                      <label for="question" class="col-lg-4 col-sm-4 control-label"> * Exam Question</label>
                                      
                                      <div class="col-lg-8">
                                        
                                            <textarea rows="4" cols="10" class="form-control" name="question" id="question"  required
                                            placeholder="Enter Exam Question, can be indent as liked "><?php echo $question; ?></textarea>
                                           
                                          </div>
                                    </div>   
									  
									<div class="form-group">
								
                                      <label  for="term" class="col-lg-4 col-sm-4 control-label">* Question Options</label>
                                     
									  <div class="col-lg-8">
											  
												<input type="text" class="form-control" 
												  name="qOptions" id="qOptions" placeholder="Enter Each Option and Hit Enter Button" 
												  value="<?php echo $qOptions; ?>" required />
												<!-- using jquery tokenfield plugin to populate question options -->
												<script type='text/javascript'> 
																			
										
													  $('#qOptions').tokenfield({
														  autocomplete: {
															source: [],
															delay: 100,
															limit:5
														  },
														  showAutocompleteOnFocus: true
													  })
													  
												</script>
												  
											  
										  </div>
									</div>  
									  
									<div class="form-group" >
                                      <label for="title" class="col-lg-4 col-sm-4 control-label"> *Question Answer</label>
                                      
                                      <div class="col-lg-8">
                                        
                                            <div class="iconic-input">
                                                  <i class="fa fa-check-square-o"></i>
                                                  
                                            <input type="text" class="form-control" placeholder="Enter Question Correct Answer" 
                                            name="qAnswer"  id="qAnswer" value="<?php echo $qAnswer; ?>" maxlength="100" >
                                            
                                            </div>
											
                                          </div>
                                    </div>								
									
									<div class="form-group" >
                                      <label for="qMark" class="col-lg-4 col-sm-4 control-label">* Question Mark</label>
                                      
                                      <div class="col-lg-8">
                                        
                                            <div class="iconic-input">
                                                  <i class="fa fa-sort-numeric-asc"></i>
                                                  
                                            <input type="number" class="form-control" placeholder="Enter Question Mark e.g 4" 
                                            name="qMark"  id="qMark" value = "<?php echo $qMark; ?>" required>
                                            
                                            </div>
											
                                          </div>
                                    </div> 
									
									<div class="form-group">
                                          <label class="control-label col-md-4"> Upload 
										  Question Picture (Optional) </label>
                                          <div class="col-md-8">
                                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                                  <div class="fileupload-new thumbnail msgSoftBoxPic" style="width: 
                                                  200px; height: 150px;">
                                                      <img src="<?php echo $eQPic; ?>" alt="" />
                                                  </div>
                                                  <div class="fileupload-preview fileupload-exists thumbnail" 
                                                  style="max-width: 
                                                  200px; max-height: 150px; line-height: 20px;"></div>
                                                  <div>
                                                   <span class="btn btn-white btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> 
                                                   Upload File</span>
                                                   
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> 
                                                   Upload File</span>
                                                   <input type="file" id="eQuestionPic" 
                                                   name="qPicture" class="default" />
                                                   </span>
                                                 
                                                  </div>
                                              </div>

                                              <span class="label label-danger">NOTE!</span>
                                             <span>Only file type of  jpg, png, jpeg, JPEG, JPG, PNG
                                             and size 10MB is allowed. 
                                             </span>
                                          </div>
                                    </div>
                                      
                                    <div class="form-group">
                                      	  <input type="hidden" name="questionData" value="updateQuestion" />
										  <input type="hidden" name="qID" value="<?php echo $qID; ?>" />
										  <input type="hidden" name="eID" value="<?php echo $eID; ?>" />
										  <input type="hidden" name="qPic" value="<?php echo $qPicture; ?>" />										  
                                          <center><button type="submit" class="btn btn-danger buttonMargin" id="updateQuestion">
                                          <i class="fa fa-save"></i> Save Question </button></center>
                                          
                                    </div>
                                    
									
									  
                                </form>
								<!-- / form -->	
<?php
						 
								echo "<script type='text/javascript'>  $('#editLoader').fadeOut(3000); </script>"; exit;

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}


		
			
exit;
?>