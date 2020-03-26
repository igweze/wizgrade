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
	This script handle library book application
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	   

		$scrollUp = "<script type='text/javascript'> 
		$('html, body').animate({scrollTop:$('#scrollLTarget-t').position().top}, 'slow'); </script>";
		 
		 
		if ($_REQUEST['bookID'] != '') {

			try { 
		 				
				$applyID = strip_tags($_REQUEST['bookID']);

  				$ebele_mark = "SELECT 	b_id, book_id, lib_user, lib_reg, apply_date, stype, b_status
				
								FROM $wizGradeLibApplyTB
								
								WHERE  b_id = :b_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':b_id', $applyID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {  /* check array is empty */
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

						$book_id = $row['book_id'];
						$applyID = $row['b_id'];
						$lib_user = $row['lib_user'];
						$lib_reg = $row['lib_reg'];
						$apply_date = $row['apply_date'];
						$schoolID = $row['stype'];


							$ebele_mark_1 = "SELECT book_id, book_name, book_author, book_desc, book_path, book_type, book_hits, book_copies, book_location, 
											stype, sclass, book_status
							
											FROM $wizGradeSchLib
											
											WHERE  book_id = :book_id";
								 
							$igweze_prep_1 = $conn->prepare($ebele_mark_1);
							$igweze_prep_1->bindValue(':book_id', $book_id);
							$igweze_prep_1->execute();
							
							$rows_count_1 = $igweze_prep_1->rowCount(); 
							
							if($rows_count_1 == $foreal) {  /* check array is empty */
							
								while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
				   
									$book_id = $row_1['book_id'];
									$book_name = $row_1['book_name'];
									$book_author = $row_1['book_author'];
									$book_path = $row_1['book_path'];
									$book_desc = $row_1['book_desc'];
									$book_type = $row_1['book_type'];
									$book_hits = $row_1['book_hits'];
									$book_copies = $row_1['book_copies'];
									$book_location = $row_1['book_location'];
									$book_status = $row_1['book_status']; 
									
								}
								
							}
							
									$book_name  = trim($book_name);
									$book_author  = trim($book_author);
									$book_desc  = trim($book_desc);
									$book_desc = htmlspecialchars_decode($book_desc);
									$book_desc = nl2br($book_desc);

						
					} 

						/*
						$bookInfo = libraryBookInfo($conn, $book_id);
				        list ($book_id, $book_name, $book_path, $book_author, $book_type, $book_status) = explode ("@.%.@", $bookInfo);
						
						*/ 

						$bookPicture = libraryUploadsManager($conn, $book_type, $book_path);  /* school library book upload manager */ 

						if($book_type == $fiVal ){
							
							$bookLocation = '';				
							
						}else{
							
							$bookLocation = '<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
							<i class="fa  fa-eye"></i> Book Location </td> <td style="padding-left: 
							30px; text-align:left; width: 70%;">'.$book_location.'</td> </tr>';
							
						}

						if($book_author == '') { $book_author = 'Anonymous'; }
						if($book_type != '') { $book_type = $libraryTypeArr[$book_type]; }
						else{$book_type = '-';} 
						
						$bookStatus = $libraryStatusArr[$book_status];
						
						$schoolName = $school_list[$schoolID];					
						
						require $wizGradeSchoolTBS; /* include student database table information  */						
						
						$regNum = studentReg($conn, $lib_user);  /* student registration number  */
						
						$studentName = studentName($conn, $regNum);  /* student name  */
		
						$studentPic = studentPicture($conn, $regNum);  /* student picture  */
					
						
$bookInfo =<<<IGWEZE

						<center><img src="loading.gif" alt="Loading Page >>>>> . . . Please wait" class="book-app-loader" 
						 style="cursor:pointer; display:none;  margin-bottom:8px;" /> </center>
						
						<div id ='msgBoxDiv'> </div>
						
						<div id = 'wizGradePrintArea' class='slideUpDiv'> 

						<div class="form-group">
						<label for="book-r-comments" class="col-lg-12 col-sm-12 control-label"> Any Comment About Book Return? (Optional)</label>
						
						<div class="col-lg-12">
						  
							  <textarea rows="4" cols="10" class="form-control" name="book-r-comments" id="book-r-comments" 
							  placeholder="Write any comment about book return by student"></textarea>
							 
							</div>
						</div>

						<br clear='all' />
						
						<button  class="btn btn-white certyfyBReturn pull-right" id='$applyID-$schoolID-$lib_user' 
						style='margin-top:15px; margin-bottom:15px;'>
						<i class="fa fa-check-square-o text-info"></i> Certify This Book As Return</button> 
					
						<br clear='all' /> 
						
						<!-- table -->
						<table width = '100%' border = '0' align = 'center' class="digit-table table table-striped table-advance table-hover">
					   

						<tr>
						<th class = 'head' align = 'center' colspan = '2'><center> <i class="fa fa-user"></i>
						Library Book Information  </center></th>
						</tr>
						<tr><td style="padding-left: 10px;" colspan = '2'><center><img src = "$bookPicture" height = '100' width = '100' id='wizGradeStudentPic'> </center> </td></tr>        
						<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
						<i class="fa fa-book"></i> Book Type </td> <td style="padding-left: 30px; text-align:left; width: 70%;"> $book_type </td></tr>

						<tr><th style="padding-left: 30px; text-align:left; width: 35%;">
						<i class="fa fa-user"></i> Book Name </td> <td style="padding-left: 30px; text-align:left; width: 70%;">  $book_name </td></tr>
						
						<tr><th style="padding-left: 30px; text-align:left; width: 35%;">
						<i class="fa fa-user"></i> Book Author </td> <td style="padding-left: 30px; text-align:left; width: 70%;">$book_author</td> </tr>

						<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
						<i class="fa fa-bars"></i> Book Descriptions </td> <td style="padding-left: 30px; text-align:left; width: 70%;">$book_desc</td> </tr>
						 
						$bookLocation

						<tr><th style="text-align:center;" colspan="2"> <i class="fa fa-user"></i> Student Information 
						
						
						</th>  </tr>
						
						<tr><td style="padding-left: 10px;" colspan = '2'><center><img src = "$studentPic" height = '100' width = '100' id='wizGradeStudentPic'> </center>
						
						
						<button  class="btn btn-white showStudentBHistory pull-right" id='$schoolID-$lib_user'>
						<i class="fa fa-eye text-info"></i> Student Book History</button>

						</td></tr>  
						
						<tr><th style="padding-left: 30px; text-align:left; width: 35%;">
						<i class="fa fa-user"></i> Student Reg No. </td> <td style="padding-left: 30px; text-align:left; width: 70%;">$regNum</td> </tr>
						
						<tr><th style="padding-left: 30px; text-align:left; width: 35%;">
						<i class="fa fa-sort-alpha-asc"></i> Student Name </td> <td style="padding-left: 30px; text-align:left; width: 70%;">$studentName</td> </tr>
						
						
						<tr><th style="padding-left: 30px; text-align:left; width: 35%;">
						<i class="fa fa-suitcase"></i>  School </td> <td style="padding-left: 30px; text-align:left; width: 70%;">$schoolName</td> </tr>				
			    
						</table>
						<!-- / table -->
						
						</div>
		
IGWEZE;

					echo $bookInfo;
					echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	exit;
							

				}else{  /* display information message */ 
				
					$msg_e =  "Oooooooops error, this library book information was not found.";
					
				}
					
			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			}
	
		
		
		
		}else{		
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */		
		
		} 
	
		if ($msg_e) {

         	  echo $errorMsg.$msg_e.$eEnd; echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>"; echo $scrollUp; exit; 			

        }
		
exit;		
?>	