<?php

/*   
	Copyright (C) fobrain Tech LTD (2014 - 2024) - All Rights Reserved
	
	Licensed under the Apache License, Version 2.0 (the 'License');
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an 'AS IS' BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License	
	 
	#####################################################################################################
	fobrain (wizgrade open source) app is designed & developed by Igweze Ebele Mark for fobrain Tech LTD
	#####################################################################################################

	fobrain is Dedicated To Almighty God, My fabulous FAMILY and Amazing Parents.  
	
	WEBSITE 							PHONES/WHATSAPP					EMAILS
	https://www.fobrain.com				+234 - 80 30 716 751  			opensource@fobrain.com
										+234 - 80 22 000 490 	
	
	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Page/Code Explanation~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	This script handle library book pending application
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	   

		$scrollUp = "<script type='text/javascript'> 
		 $('html, body').animate({scrollTop:$('#scrollLTarget-t').position().top}, 'slow'); </script>";
		 
		 
		if ($_REQUEST['bookID'] != '') {

			try {
		 				
				$applyID = strip_tags($_REQUEST['bookID']);
				
				/* select information */
				
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
					
					<button  class="btn btn-white approveLibBook pull-left" id='$applyID-$schoolID-$lib_user' style='margin-top:15px; margin-bottom:15px;'>
					<i class="fa fa-check-square-o text-info"></i> Approve Appl.</button>
					
					<button  class="btn btn-white discardBookApp pull-right display-none" id='$applyID-$schoolID-$lib_user' 
					style='margin-top:15px; margin-bottom:15px;'>
					<i class="fa fa-times text-info"></i> </button> 
			
					<a href="#removeApp-modal" data-toggle="modal" class="btn btn-white pull-right" style='margin-top:15px; margin-bottom:15px;'>
								  <i class="fa fa-times"></i>   Discard Appl.		
					</a> 
	 
					<br clear='all' /> 

					<div class="modal fade" id="removeApp-modal" tabindex="-1" role="dialog" 
					aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" 
						data-dismiss="modal" aria-hidden="true">
						<span style='color:#fff !important;'>&times;</span></button>
						<h4 class="modal-title"> Are sure you want to remove this student book Application ?
						</h4>
						</div>
						<div class="modal-body">
						<div id="filterSettingsMsg"> </div>
						<div class="wizgrade-section-div">

							<section class="panel">

								<div class="panel-body"> 

									<img src = "$bookPicture" height = '100'	width = '100' id='wizGradeStudentPic' class='pull-left'> 
									<span style='color:#000;font-weight:bold;' class='pull-left'>
									Discard Book Application <br /> $book_name By $book_author </span>  

									<br clear ='all' />
									<br clear ='all' />

									<img src = "$studentPic" height = '100'	width = '100' id='wizGradeStudentPic' class='pull-left'> 
									<span style='color:#000;font-weight:bold;' class='pull-left'>
									Applied By $studentName </span> 

									<br clear ='all' />
									<br clear ='all' />

									<div class="form-group"> 

									<div class="col-lg-12">

									<div class="iconic-input">
									<i class="fa fa-eye"></i>

									<input type="text" class="form-control" placeholder="Reason/s - Optional"
									name="discard-reason" maxlength="100" id="discard-reason" />

								</div>

							</div>
							</div>

							</div>

							</section>

						</div>

						</div>
						<div class="modal-footer">
							<button data-dismiss="modal" class="btn btn-danger" id="mdiscardBookApp" 
							type="button">Yes</button>
							<button data-dismiss="modal" class="btn btn-danger" 
							type="button">Cancel</button>
						</div>
						</div>
						</div>
					</div> 
			
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
					<div class='pull-right'>
					
					
					<button  class="btn btn-white showStudentBHistory pull-right" id='$schoolID-$lib_user' style='margin-top:15px; margin-bottom:15px;'>
					<i class="fa fa-eye text-info"></i> Student Book History</button>

					</td></tr>  
					
					<tr><th style="padding-left: 30px; text-align:left; width: 35%;">
					<i class="fa fa-user"></i> Student RegNum </td> <td style="padding-left: 30px; text-align:left; width: 70%;">$regNum</td> </tr>
					
					<tr><th style="padding-left: 30px; text-align:left; width: 35%;">
					<i class="fa fa-sort-alpha-asc"></i> Student Name </td> <td style="padding-left: 30px; text-align:left; width: 70%;">$studentName</td> </tr>
					
					<tr><th style="padding-left: 30px; text-align:left; width: 35%;">
					<i class="fa fa-suitcase"></i> School</td> <td style="padding-left: 30px; text-align:left; width: 70%;">$schoolName</td> </tr> 
					</table>
					<!-- / table -->
					
					</div>
		
IGWEZE;

					echo $bookInfo;
					echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	exit;
							

				}else{ /* display information message */
				
						$msg =  "Oooooooops error, this library book information was not found.";
					
				}
					
			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			} 
		
		}else{ 
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
		} 
	
		if ($msg) {

         	echo $errorMsg.$msg.$eEnd; echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	echo $scrollUp; exit; 			

        }
		
exit;		
?>	