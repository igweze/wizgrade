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
	This script show library book information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

		define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	   

		$scrollUp = "<script type='text/javascript'> 
		 hidePageLoader();  /* hide page loader */ $('html, body').animate({scrollTop:$('#scrollLTarget-t').position().top}, 'slow'); </script>";
		 
		 
		if ($_REQUEST['bookID'] != '') {

			try {
		 				
				$bookID = $_REQUEST['bookID'];
				
				$bookID = strip_tags($bookID);

  				$ebele_mark = "SELECT book_id, book_name, book_author, book_desc, book_path, book_type, book_hits, book_copies, book_location, 
								stype,  book_status
				
								FROM $wizGradeSchLib
								
								WHERE  book_id = :book_id";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':book_id', $bookID);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count == $foreal) {  /* check array is empty */
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
	   
						$book_id = $row['book_id'];
						$book_name = $row['book_name'];
						$book_author = $row['book_author'];
						$book_path = $row['book_path'];
						$book_desc = $row['book_desc'];
						$book_type = $row['book_type'];
						$book_hits = $row['book_hits'];
						$book_copies = $row['book_copies'];
						$book_location = $row['book_location'];
						$book_status = $row['book_status'];
						$schoolID = $row['stype']; 
						
					} 
				
					$book_name  = trim($book_name);
					$book_author  = trim($book_author);
					$book_desc  = trim($book_desc);
					$book_desc = htmlspecialchars_decode($book_desc);
					$book_desc = nl2br($book_desc);


					$bookPicture = libraryUploadsManager($conn, $book_type, $book_path);  /* school library book upload manager */

					if($book_type == $fiVal ){  /* check book type */
						
						$downloadHits = '<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-download"></i> Download/s </td> <td style="padding-left: 
										30px; text-align:left; width: 70%;">'.$book_hits.' Hit/s</td> </tr>';
						$bookLocation = '';
						$bookCopies = '';
						
					}else{
						
						$downloadHits = '';
						$bookLocation = '<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa  fa-eye"></i> Book Location </td> <td style="padding-left: 
										30px; text-align:left; width: 70%;">'.$book_location.'</td> </tr>';
						$bookCopies = '<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
										<i class="fa fa-sort-numeric-asc"></i> Book Copies </td> <td style="padding-left: 30px; text-align:left; 
										width: 70%;">'.$book_copies.'</td> </tr>';				
						
					}

					if($book_author == '') { $book_author = 'Anonymous'; }
					if($book_type != '') { $book_type = $libraryTypeArr[$book_type]; }
					else{$book_type = '-';}
					
					$bookStatus = $libraryStatusArr[$book_status];
					
					$schoolName = $school_list[$schoolID]; 
					
					
						
$bookInfo =<<<IGWEZE


					<div id = 'wizGradePrintArea' class='slideUpDiv'> 
					
					<button  class="btn btn-white showBookHistory pull-right" id='$book_id' style='margin-top:15px; margin-bottom:15px;'>
					<i class="fa fa-eye text-info"></i> Book History </button> 
				
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
					<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
					<i class="fa fa-user"></i> Book Name </td> <td style="padding-left: 30px; text-align:left; width: 70%;">  $book_name </td></tr>
					
					<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
					<i class="fa fa-user"></i> Book Author </td> <td style="padding-left: 30px; text-align:left; width: 70%;">$book_author</td> </tr>
 
					<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
					<i class="fa fa-book"></i> School </td> <td style="padding-left: 30px; text-align:left; width: 70%;">$schoolName</td> </tr>

					<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
					<i class="fa fa-bars"></i> Descriptions </td> <td style="padding-left: 30px; text-align:left; width: 70%;">$book_desc</td> </tr>
					 
					$bookLocation
					 
					<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
					<i class="fa fa-cogs"></i> Book Status </td> <td style="padding-left: 30px; text-align:left; width: 70%;">$bookStatus</td> </tr>
				   
					$bookCopies
					
					$downloadHits
					
				   
					</table>
					<!-- table -->
					
					</div>
		
IGWEZE;

					echo $bookInfo;
					echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	exit;
							

				}else{
				
						$msg_e =  "Oooooooops error, this library book information was not found.";
					
				}
						
			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			}
	
		
		
		
		}else{
		
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		
		}
		
		
	
		 if ($msg_e) {

         	  echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; exit; 			
			

        }
		
exit;		
?>