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
	This script handle library book student history
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	   

		$scrollUp = "<script type='text/javascript'> 
		 $('html, body').animate({scrollTop:$('#scrollLTarget-t').position().top}, 'slow'); </script>";
		 
		if ($_REQUEST['studentData'] != '') {

			try {
		 				
				$studentData = $_REQUEST['studentData'];
				
				$studentData = strip_tags($studentData);
				
				list ($schoolID, $regID) = explode ("-", $studentData);


						$schoolName = $school_list[$schoolID];												

						require $wizGradeSchoolTBS; /* include student database table information  */						
						
						$regNum = studentReg($conn, $lib_user);  /* student registration number  */
						
						$studentName = studentName($conn, $regNum);  /* student name  */
		
						$studentPic = studentPicture($conn, $regNum);  /* student picture  */
						

						echo "<script type='text/javascript'> $('.paginate-page-1').trigger('click');  /*  paginate table using Jquery dataTable */ </script>";
				

$table_head =<<<IGWEZE

        <!-- table -->
		<table width = '100%' border = '0' align = 'center' class='table table-striped table-advance table-hover'> 
			
		<tr>
		<td style="text-align:left !important; padding-right: 15px !important;">
		<img src = "$studentPic" style="width: 100px; height: 100px; float:left; border-radius: 20px; padding-right: 10px"> 
		<strong>Reg No.</strong> - $regNum 
		<br /><strong>Name</strong> - $studentName 
		
		<br /> <strong>School</strong> - $schoolName
		</td> 
		
		</tr>
		</table>

        <table width = '100%' border = '0' align = 'center' class='table table-striped table-advance table-hover wizGradeTBPage-1'>
		<thead>
		<tr><th style="text-align:left !important; padding-right: 15px !important; width: 3%; ">App. ID</th>
		<th style="text-align:left !important; padding-right: 15px !important; width: 21%;">Book Details</th> 
		<th style="text-align:left !important; padding-right: 15px !important; width: 12%;">Apply. Time</th> 
		<th style="text-align:left !important; padding-right: 15px !important; width: 12%;">Approved Time</th> 
		<th style="text-align:left !important; padding-right: 15px !important; width: 12%;">Return Date</th> 
		<th style="text-align:left !important; padding-right: 15px !important; width: 30%;">Book Comments</th>
		<th style="text-align:left !important; padding-right: 15px !important; width: 10%;">Book Status</th></tr>
		</thead> <tbody>
		
IGWEZE;



  				$ebele_mark = "SELECT b_id, book_id, lib_user, lib_reg, apply_date, approve_date, return_date, d_reasons, comment, 
								stype, sclass,  b_status
				
								FROM $wizGradeLibApplyTB
								
								WHERE   stype = :stype
								
								AND lib_user = :lib_user";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark); 
				$igweze_prep->bindValue(':stype', $schoolID);
				$igweze_prep->bindValue(':lib_user', $regID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {  /* check array is empty */
					
					echo  $table_head;
					
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

						$book_id = $row['book_id'];
						$applyID = $row['b_id'];
						$lib_user = $row['lib_user'];
						$lib_reg = $row['lib_reg'];
						$apply_date = $row['apply_date'];
						$approve_date = $row['approve_date'];
						$return_date = $row['return_date'];
						$d_reasons = $row['d_reasons'];
						$comment = $row['comment'];
						
						$schoolID = $row['stype']; 
						$b_status = $row['b_status'];
						
						if($b_status == $foVal){$comment = $d_reasons;}
						
						if($apply_date != ''){
							
							$apply_date = strtotime($apply_date);
							$apply_date = date("h:i:s, d F, Y", $apply_date);
							
						}else{ $apply_date = ' - '; }

						if($approve_date != ''){
							
							$approve_date = strtotime($approve_date);
							$approve_date = date("h:i:s, d F, Y", $approve_date);
							
						}else{ $approve_date = ' - '; }


						if($return_date != ''){
							
							$return_date = strtotime($return_date);
							$return_date = date("h:i:s, d F, Y", $return_date);
							
						}else{ $return_date = ' - '; }


							$ebele_mark_1 = "SELECT book_id, book_name, book_author, book_desc, book_path, book_type, book_hits, book_copies, 
											book_location, stype, book_status
							
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
						
						
						$bookStatus = $libraryAppStatusArr[$b_status];
						
					
						
$bookInfo =<<<IGWEZE


						<tr><td style="text-align:left !important; padding-right: 15px !important;"> App-$applyID </td>
						<td style="text-align:left !important; padding-right: 15px !important;">
						<img src = "$bookPicture" style="width: 30px; height: 30px; float:left; border-radius: 20px; padding-right: 5px"> $book_name by $book_author </td> 
						<td style="text-align:left !important; padding-right: 15px !important;"> $apply_date </td> 
						<td style="text-align:left !important; padding-right: 15px !important;">$approve_date</td> 
						<td style="text-align:left !important; padding-right: 15px !important; text-transform:capitalize;">$return_date</td> 
						<td style="text-align:left !important; padding-right: 15px !important;">$comment</td>
						<td style="text-align:left !important; padding-right: 15px !important;">$bookStatus</td></tr> 
		
IGWEZE;

						echo $bookInfo; 
				
					} 
					
					echo  '</tbody></table><!-- / table -->';
					
					echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	exit;

				}else{  /* display information message */ 
				
						$msg_i =  "Oooooooooops, this student has no book history information to show. Thanks";
					
				}
					
			}catch(PDOException $e) {
				
				wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			}  
		
		}else{		
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */		
		
		} 
		
	
		if ($msg_i) {

         	echo $infMsg.$msg_i.$msgEnd; echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	echo $scrollUp; exit; 			

        }
		
exit;
?>