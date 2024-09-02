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
	This script handle library book history
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
		 				
				$bookID = $_REQUEST['bookID'];
				
				$bookID = strip_tags($bookID);
				
				$bookInfo = libraryBookInfo($conn, $bookID);  /* school library book information */
				list ($bookLID, $bookName, $bookPath, $bookAuthor, $bookType, $bookStatusT, $schoolID, $sClassID, $bookHits, 
					  $bookCopies, $bookLocation) = explode ("@.%.@", $bookInfo);
				


				$bookName  = trim($bookName);
				$bookAuthor  = trim($bookAuthor);


				$bookPicture = libraryUploadsManager($conn, $bookType, $bookPath);  /* school library book upload manager */
				
				$schoolNameT = $school_list[$schoolID];
				

				if($bookType == $fiVal ){
					
					$bookMore = "<br /> <strong> Book Downloads </strong> - $bookHits";
					
					
				}else{
					
					
					$bookMore = "<br /> <strong> Book Copies </strong> - $bookCopies
									 <br /> <strong> Book Location </strong> - $bookLocation";
					
				}

				if($bookAuthor == '') { $bookAuthor = 'Anonymous'; }
				if($bookType != '') { $bookType = $libraryTypeArr[$bookType]; }
				else{$bookType = '-';}
				
				
				$bookStatusT = $libraryStatusArr[$bookStatusT];

				
				echo "<script type='text/javascript'> $('.paginate-page-1').trigger('click');  /*  paginate table using Jquery dataTable */ </script>";
				

$table_head =<<<IGWEZE

				<!-- table -->
				<table width = '100%' border = '0' align = 'center' class='table table-striped table-advance table-hover'> 
					
				<tr>
				<td style="text-align:left !important; padding-right: 15px !important;">
				<img src = "$bookPicture" style="width: 130px; height: 130px; float:left; border-radius: 20px; padding-right: 10px"> 
				<strong> Book Name </strong> - $bookName
				<br /><strong> Book Author </strong> - $bookAuthor 
				<br /><strong> Book Type </strong> - $bookType
				<br /> <strong> Book Status </strong> - $bookStatusT
				
				<br /> <strong>$schoolNameT</strong> 
				
				$bookMore </td> 
				
				</tr>
				</table>
				<!-- / table -->
				
				<!-- table -->
				<table width = '100%' border = '0' align = 'center' class='table table-striped table-advance table-hover wizGradeTBPage-1'>
				<thead><tr><th style="text-align:left !important; padding-right: 15px !important;">App. ID</th>
				<th style="text-align:left !important; padding-right: 15px !important; width: 30% !important;">Student Details</th> 
				<th style="text-align:left !important; padding-right: 15px !important;">School</th> 
				<th style="text-align:left !important; padding-right: 15px !important;">Book Status</th> 
				<th style="text-align:left !important; padding-right: 15px !important; width: 30% !important;">Book Comments</th> 
				</tr>
				</thead> <tbody>
		
IGWEZE;


				/* select information */ 
				
  				$ebele_mark = "SELECT b_id, book_id, lib_user, lib_reg, apply_date, comment, stype, sclass, b_status
				
								FROM $wizGradeLibApplyTB
								
								WHERE  book_id = :book_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':book_id', $bookID);
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
						$bComments = $row['comment'];
						
						$schoolID = $row['stype'];
						$sClassID = $row['sclass'];
						$b_status = $row['b_status'];
						
						$bookStatus = $libraryAppStatusArr[$b_status];							
						
						$schoolName = $school_list[$schoolID];
						
						require $wizGradeSchoolTBS; /* include student database table information  */						
						
						$regNum = studentReg($conn, $lib_user);  /* student registration number  */
						
						$studentName = studentName($conn, $regNum);  /* student name  */
		
						$studentPic = studentPicture($conn, $regNum);  /* student picture  */
					
						
$bookInfo =<<<IGWEZE


						<tr><td style="text-align:left !important; padding-right: 15px !important;"> App-$applyID </td> 
						<td style="text-align:left !important; padding-right: 15px !important;">
						<img src = "$studentPic" style="width: 30px; height: 30px; float:left; border-radius: 20px; padding-right: 5px"> $regNum <br /> $studentName </td> 
						<td style="text-align:left !important; padding-right: 15px !important;">$schoolName</td> 
						<td style="text-align:left !important; padding-right: 15px !important; text-transform:capitalize;">$bookStatus</td> 
						<td style="text-align:left !important; padding-right: 15px !important;">$bComments</td></tr>
		
IGWEZE;

						echo $bookInfo;
				
				
				
					}
					
					
						echo  '</tbody></table><!-- / table -->';
						echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	exit;

				}else{  /* display information message */ 
		
					$msg_i =  "Oooooooooops, this library book has no history information to show. Thanks";
			
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