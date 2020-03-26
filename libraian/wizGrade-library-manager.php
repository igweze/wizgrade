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
	This script handle library book upload
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	   

		$scrollUp = "<script type='text/javascript'> 
		 $('html, body').animate({scrollTop:$('#scrollLTarget').position().top}, 'slow'); hidePageLoader();  /* hide page loader */ </script>";

         
			if (($_REQUEST['library-data']) == 'upload-lib-book') {  /* upload library book */
			
				/* script validation */ 		
				
				$schoolID = preg_replace("/[^0-9]/", "", $_REQUEST['schoolType']);
				$bookName = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['book-name']);
				$bookAuthor = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['book-author']);
				$bookDesc = $_REQUEST['book-desc'];
				$bookType = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['book-type']);
				$bookStatus = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['book-status']);
				$bookCopies = preg_replace("/[^0-9]/", "", $_REQUEST['book-copies']);
				$bookLocation = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['book-location']);
				$bookAllf = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['allow-format']);
				
				if($schoolID == ''){
					
					echo "<img src=''   height = '1' width='1'> ";
					$msg_e = "Oooooops error, please select school  to upload books";
					echo "<script type='text/javascript'> $('#book-lib-upload').val(''); </script>";
				
				}elseif($bookName == ''){
					
					echo "<img src=''   height = '1' width='1'> ";
					$msg_e = "Oooooops error, please enter book name to upload";
					echo "<script type='text/javascript'> $('#book-lib-upload').val(''); </script>";
				
				}elseif($bookAuthor == ''){
					
					echo "<img src=''   height = '1' width='1'> ";
					$msg_e = "Oooooops error, please enter book author";
					echo "<script type='text/javascript'> $('#book-lib-upload').val(''); </script>";
				
				}elseif($bookType == ''){
					
					echo "<img src=''   height = '1' width='1'> ";
					$msg_e = "Oooooops error, please select book type you are uploading";
					echo "<script type='text/javascript'> $('#book-lib-upload').val(''); </script>";
				
				}else{  /* upload information */ 
				
					$picturePath = $wizGradeLibDir; /* picture path */
					
					$filePic = "book-lib-upload"; /* picture file name */
					$pageDesc = "Library book or Cover picture";
					
					if($bookAllf  == $fiVal){
							
						$allow_formats = $validDocFormats;
						/* call igweze file uploader */
						$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 10), $validDocExt, $validDocType, $allowedDocExt, 
						$fileType = "Library book", $seVal); 
							
					}elseif($bookAllf  == $seVal){
							
						$allow_formats = $validPicFormats;
						/* call igweze file uploader */
						$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 2), $validPicExt, $validPicType, $allowedPicExt, 
						$fileType = "Cover Picture", $fiVal); 
						
					}else{
							
						$allow_formats = $validDocFormats;
						/* call igweze file uploader */
						$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 10), $validDocExt, $validDocType, $allowedDocExt, 
						$fileType = "Library book", $seVal); 
					} 
					 
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

									 
									if($bookCopies == ''){ $bookCopies == $fiVal;}
									
									$bookDesc = str_replace('<br />', "\n", $bookDesc);

									$bookDesc = htmlspecialchars($bookDesc);

									$ebele_mark = "INSERT INTO $wizGradeSchLib (book_name, book_author, book_desc, book_path, book_type, 
																			  book_copies, book_location, stype,  book_status)
												
													VALUES(:book_name, :book_author, :book_desc, :book_path, :book_type, :book_copies, :book_location, 
														   :stype, :book_status)";
													
									$igweze_prep = $conn->prepare($ebele_mark);	
									$igweze_prep->bindValue(':book_name', $bookName);
									$igweze_prep->bindValue(':book_author', $bookAuthor);
									$igweze_prep->bindValue(':book_desc', $bookDesc);
									$igweze_prep->bindValue(':book_path', $uploadedPic);
									$igweze_prep->bindValue(':book_type', $bookType);
									$igweze_prep->bindValue(':book_copies', $bookCopies);
									$igweze_prep->bindValue(':book_location', $bookLocation);
									$igweze_prep->bindValue(':stype', $schoolID); 
									$igweze_prep->bindValue(':book_status', $bookStatus);		

									if($igweze_prep->execute()){  /* insert picture name to database */
											 
										echo "<img src=''   height = '1' width='1'> ";
										$msg_s = "$pageDesc was successfully uploaded";									
										echo $succesMsg.$msg_s.$sEnd ;  echo $scrollUp; 	
										echo "<script type='text/javascript'> $('#frmLibrary')[0].reset(); </script>"; 
										exit;									

									}else{ /* display error messages */

										echo "<img src=''   height = '1' width='1'> ";
										$msg_e = "Ooooooooooops, an error has occur while trying to save $pageDesc.
										Please try again or check your network connection!!!";
										echo $errorMsg.$msg_e.$eEnd;exit;

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
 
				}
			
			}elseif (($_REQUEST['library-data']) == 'update-lib-book') {  /* update library book */
			
				$bookID = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['bookID']);
				$bookName = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['book-name']);
				$bookAuthor = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['book-author']);
				$bookDesc = $_REQUEST['book-desc'];
				$bookCopies = preg_replace("/[^0-9]/", "", $_REQUEST['book-copies']);
				$bookLocation = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['book-location']);
				$bookStatus = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['book-status']);
				
				/* script validation */ 
				
				if($bookID == ''){
				
					$msg_e = "Oooooops error, could not find this book information. Please try again";
				
				}elseif($bookName == ''){
				
					$msg_e = "Oooooops error, please enter book name to upload";
				
				}elseif($bookAuthor == ''){
				
					$msg_e = "Oooooops error, please enter book author";
				
				}else{
					
					try {
						
						$bookDesc = str_replace('<br />', "\n", $bookDesc);

						$bookDesc = htmlspecialchars($bookDesc); 

						if($bookStatus == ''){
							
							$ebele_mark = "UPDATE $wizGradeSchLib
							
											SET 
											
											book_name = :book_name,
											book_author = :book_author,
											book_desc = :book_desc
											
											WHERE book_id = :book_id";
											
							$igweze_prep = $conn->prepare($ebele_mark);	
							$igweze_prep->bindValue(':book_id', $bookID);
							$igweze_prep->bindValue(':book_name', $bookName);
							$igweze_prep->bindValue(':book_author', $bookAuthor);
							$igweze_prep->bindValue(':book_desc', $bookDesc);
						
						}else{
							
							if($bookCopies == ''){ $bookCopies == $fiVal; }
							
							$ebele_mark = "UPDATE $wizGradeSchLib
							
											SET 
											
											book_name = :book_name,
											book_author = :book_author,
											book_desc = :book_desc,
											book_copies = :book_copies,
											book_location = :book_location,
											book_status = :book_status
											
											WHERE book_id = :book_id";
											
							$igweze_prep = $conn->prepare($ebele_mark);	
							$igweze_prep->bindValue(':book_id', $bookID);
							$igweze_prep->bindValue(':book_name', $bookName);
							$igweze_prep->bindValue(':book_author', $bookAuthor);
							$igweze_prep->bindValue(':book_desc', $bookDesc);
							$igweze_prep->bindValue(':book_copies', $bookCopies);
							$igweze_prep->bindValue(':book_location', $bookLocation);
							$igweze_prep->bindValue(':book_status', $bookStatus);									
						
						}  
							
						if ($igweze_prep->execute()) {  /* if sucessfully */ 
							
							$msgBox = "$bookName By $bookAuthor";
							$msg_s = "<b>$bookName</b> Book, was successfully updated";
							echo "<script type='text/javascript'> $('#frmupdateLibrary').slideUp('500');
							$('#lib_name-".$bookID."').html('".$msgBox."');</script>";
																	
						}else{  /* display error */ 
			
							$msg_e = "Library book  name was not successfully updated. Please try again";
			
						}

					}catch(PDOException $e) {
	
								wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
	 
					}
				}
				
			}elseif (($_REQUEST['library-data']) == 'update-lib-book-upload') {  /* update library book */
			
					
					$bookID = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['bookID']);
					$bookType = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['book-type']);
					$bookAllf = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['allow-format']);
					$bookName = preg_replace("/[^A-Za-z0-9 ]/", "", $_REQUEST['lib-book-name']);
					$bookPath = preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['lib-book-path']);
					
					/* script validation */ 
					
					if($bookType == ''){
					
						$msg_e = "Oooooops error, please select book type you are uploading";
						
					
					}elseif(($bookAllf == '') || ($bookID == '') || ($bookName == '') || ($bookPath == '')){
						
						$msg_e = "Oooooops error, could not retrieve this book information. Please try again"; 
						
					}else{
						
						
						$picturePath = $wizGradeLibDir; /* picture path */
						
						$filePic = "book-lib-upload"; /* picture file name */
						$pageDesc = "Library book or Cover picture";
						
						if($bookAllf  == $fiVal){
								
							$allow_formats = $validDocFormats;
							/* call igweze file uploader */
							$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 10), $validDocExt, $validDocType, $allowedDocExt, 
							$fileType = "Library book", $seVal); 
								
						}elseif($bookAllf  == $seVal){
								
							$allow_formats = $validPicFormats;
							/* call igweze file uploader */
							$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 1), $validPicExt, $validPicType, $allowedPicExt, 
							$fileType = "Cover Picture", $fiVal); 
							
						}else{
								
							$allow_formats = $validDocFormats;
							/* call igweze file uploader */
							$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 10), $validDocExt, $validDocType, $allowedDocExt, 
							$fileType = "Library book", $seVal); 
						} 
						 
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

										$ebele_mark = "UPDATE $wizGradeSchLib
											
															SET 
															
															book_path = :book_path,
															book_type = :book_type
															
															WHERE book_id = :book_id";
															
										$igweze_prep = $conn->prepare($ebele_mark);	
										$igweze_prep->bindValue(':book_id', $bookID);
										$igweze_prep->bindValue(':book_path', $uploadedPic);
										$igweze_prep->bindValue(':book_type', $bookType);		 
											
										if ($igweze_prep->execute()) { /* insert picture name to database */
											
											echo "<img src=''   height = '1' width='1'> ";											
											$book_type = $libraryTypeArr[$bookType];
										
											echo "<script type='text/javascript'> $('#frmLibrary').slideUp('500');
											$('#lib_type-".$bookID."').html('".$book_type."');</script>";										
											
											if (($bookPath != '') && file_exists($picturePath.$bookPath)){ 
											
												unlink($picturePath.$bookPath);
											}
											
											$msg_s = "<b>$bookName</b> was successfully uploaded to school  library";								
											echo $succesMsg.$msg_s.$sEnd ;  echo $scrollUp; exit;
																					
										}else{ /* display error messages */
											
											echo "<img src=''   height = '1' width='1'> ";
											$msg_e = "Ooooooooooops, an error has occur while trying to save $pageDesc.
											Please try again or check your network connection!!!";
											echo $errorMsg.$msg_e.$eEnd; exit;
							
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
					 
					}
			
			}elseif (($_REQUEST['library-data']) == 'remove-lib-book') {  /* remove library book */ 
						
 		   		$bookID = $_REQUEST['bookID'];
				$bookPath = $_REQUEST['bookPath'];
				
				/* script validation */ 
				
				if($bookID == ''){
				
					$msg_e = "Oooooops error, could not find this book information. Please try again";
				
				}elseif($bookPath == ''){
				
					$msg_e = "Oooooops error, could not find this book information. Please try again";
				
				}else{ 
				
					try { 

						$ebele_mark = "DELETE
						
										FROM $wizGradeSchLib
										
										WHERE book_id = :book_id
										
										LIMIT 1";
										
						$igweze_prep = $conn->prepare($ebele_mark);	
						$igweze_prep->bindValue(':book_id', $bookID); 
							
						if ($igweze_prep->execute()) {  /* if sucessfully */ 
							
							$rowID = 'lib_book_row-'.$bookID;
							
							$msg_s = "<b>$bookName</b> name was successfully remove";
							
							echo "<script type='text/javascript'> $('#".$rowID."').fadeOut('100'); </script>";
							
							if (($bookPath != '') && file_exists($wizGradeLibDir.$bookPath)){ 
							
								unlink($wizGradeLibDir.$bookPath);
							}
																	
						}else{  /* display error */
			
							$msg_e = "Library book  name was not successfully remove. Please try again";
			
						}

					}catch(PDOException $e) {
	
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
	 
					}
					
				}
				
				
			}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			}


			
			if ($msg_s) {

				echo $succesMsg.$msg_s.$sEnd ; echo $scrollUp; exit; 				
										
			}	


			if ($msg_e) {

				echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 			
				
										
			}	
			
exit;
?>