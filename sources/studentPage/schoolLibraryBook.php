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
	This page load school library books
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>
 		 		
					<!-- row -->
                 	<div class="row" id="scrollLTarget">
						<div class="col-lg-12">
							<section class="panel wizgrade-section-div" >                      
							<header class="panel-heading">
								<i class="fa fa-briefcase fa-lg"></i>  <span class="hide-res">School</span> Library Books 
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line">
                          
								<div id="lib-book-msg"></div> 
<?php 

		 
$table_head =<<<IGWEZE
        
				<!-- table -->
				<table  class='table table-hover style-table wizGradeTBPage' width="100%"> 
				<thead><tr><th>S/N</th>
				<th style="text-align:left !important; padding-right: 30px !important;">Book Name</th>
				<th style="text-align:left !important; padding-right: 30px !important;">Tasks</th></tr></thead> <tbody>
		
IGWEZE;
				
		 
			try {
		 
				
				$ebele_mark = "SELECT book_id, book_name, book_author, book_path, book_type, stype, book_status 
				
								FROM $wizGradeSchLib 
								
								ORDER BY book_id DESC";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {
				
					echo $table_head;
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$book_id = $row['book_id'];
						$book_name = $row['book_name'];
						$book_path = $row['book_path'];
						$book_author = $row['book_author'];
						$book_desc = $row['book_desc'];
						$book_type = $row['book_type'];
						$book_status = $row['book_status'];	
						$schoolID = $row['stype']; 
						
						$book_name  = trim($book_name);
						$book_author  = trim($book_author);
						$book_desc  = trim($book_desc); 
					
						$serial_no++;
									
						$bookLibPath =  $wizGradeLibDir.$book_path;	
						$bookPicture = libraryUploadsManager($conn, $book_type, $book_path);
						
						if($book_type == $fiVal) { 
						
							$showBlink = '<a href="'.$bookLibPath.'" target="_blank" alt="$book_name"> 
							<span style="color: #30F !important">
							<button class="btn btn-danger btn-xs"><i class="fa fa-download"></i></button><span class="hide-res">
							 Download</span></span></a>';
						
						}elseif($book_type == $seVal) { 
						
							if($book_status == $fiVal){
								
								
								$bookUserInfo = libraryBookAppStatus($conn, $book_id, $regID, $schoolID); 

								list ($bookStatus, $applyDate, $approveDate, $returnDate) = explode ("@.%.@", $bookUserInfo);				  
								
								if($bookStatus == $fiVal){
									
									$showBlink = '<span style="color:#C00 !important">
									<button class="btn btn-danger btn-xs"><i class="fa fa-eye"></i></button><span class="hide-res">
									 App. Pending</span></span>';
									
								}elseif($bookStatus == $seVal){
									
									$showBlink = '<span style="color:#090 !important">
									<button class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-up"></i></button><span class="hide-res"> 
									Assign To You</span></span>';								
									
								}else{
					  
									
									$showBlink = ' <a href="javascript:;" alt="$book_name" 
									id="libr-'.$book_id.'-'.$book_name.'" class="apply-lib-book"> 
									<span style="color: #090 !important">
									<button class="btn btn-danger btn-xs"><i class="fa fa-check-square-o"></i></button><span class="hide-res">
									 Borrow  </span></span></a>';
								
								}
							
							}else{
							
								$showBlink = '<span style="color:#C00 !important">
								<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button><span class="hide-res"> 
								 Unavailable</span></span>';
							
							}
							
						
						}else{
							
							$showBlink = '';
						}
						
						if($book_author == '') { $book_author = 'Anonymous'; }
						if($book_type != '') { $book_type = $libraryTypeArr[$book_type]; }
						else{$book_type = '-';}
					
					
					
					
$lib_book =<<<IGWEZE
        
						<tr id='lib_book_row-$book_id'><td>$serial_no</td>
							<td style="text-align:left !important; padding-right: 30px !important;"> 
								<span id="library-pic-$book_id"><img src="$bookPicture" alt="" style="width: 50px; height: 50px;" /> </span>
								<strong>$book_name</strong> By <strong>$book_author</strong> 
							</td> 
							
							
							<td style="vertical-align:middle !important; text-align:left !important; padding-right: 10px !important;"> 
								<a href='javascript:;' 
								id ="$book_id" class ='show-lib-book'> <button class="btn btn-danger btn-xs">
								<i class="fa fa-eye"></i></button><span class="hide-res"> View </a> &nbsp;&nbsp; </span>
								<span id='lib-btn-status-$book_id'>$showBlink</span>
							</td> 
						</tr>
		
IGWEZE;
		
						echo $lib_book; 

					}
		

				}else{  /* display error */ 
		
					$msg_e = "Oooooooops error, no book was found in school library. ";
		
				}
		
			}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}
	
		
				echo  '</tbody></table><!-- / table -->'; 

?>


							</div>
						</section>
                      
						</div>
					</div>
					<!-- / row -->
                    
     
                    <!-- library pop up modal start -->  
					<a href="#apply-lib-modal" data-toggle="modal" id="modal-lib-apply-btn" class=""> </a>

					<div class="modal fade" id="apply-lib-modal" tabindex="-1" role="dialog" 
					aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" 
							data-dismiss="modal" aria-hidden="true">
							<span style='color:#fff !important;'>&times;</span></button>
							<h4 class="modal-title"> School Library Book Application ?
							</h4>
						</div>
						<div class="modal-body">
						<div id="filterSettingsMsg"> </div>
						<div class="wizgrade-section-div">

						<section class="panel">

							<div class="panel-body">

								<div id="apply-lib-data" style="display:none;"></div> 

								<?php 

								echo "$infMsg  Are sure you want to borrow? <br />
								<span id='show-lib-picture' class='text-left'></span>
								<span style='color:#000;font-weight:bold;'  id='apply-lib-info'> </span> $msgEnd";

								?> 
								 
							</div>

						</section>

						</div>


						<div class="modal-footer">
							<button data-dismiss="modal" class="btn btn-danger" id="apply-library-book" 
							type="button">Yes</button>
							<button data-dismiss="modal" class="btn btn-danger" 
							type="button">Cancel</button>
						</div>
						</div>
						</div>
					</div>

					</div>
					<!-- library pop up modal end -->  
					
					<!-- library pop up modal start -->  
					<a href="#show-lib-book-info" data-toggle="modal" id="modal-lib-show-btn" class=""> </a>

					<div class="modal fade" id="show-lib-book-info" tabindex="-1" role="dialog" 
					aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" 
							data-dismiss="modal" aria-hidden="true">
							<span style='color:#fff !important;'>&times;</span></button>
							<h4 class="modal-title"> School Library Book Details
							</h4>
						</div>
						<div class="modal-body">
							<div id="filterSettingsMsg"> </div>
							<div class="wizgrade-section-div">

								<section class="panel">

									<div class="panel-body"> 

										<div id="lib-show-div"></div> 
											 
									</div>

								</section>

							</div> 

							<div class="modal-footer">

							</div>
						</div>
						</div>
						</div> 
					</div> 
					<!-- library pop up modal end -->  	
					  				
					
<?php

		if ($msg_s) {

			echo $succesMsg.$msg_s.$sEnd; echo $scrollUp; exit; 				
									
        } 

		if ($msg_e) {

			echo $errorMsg.$msg_e.$eEnd;  echo $scrollUp; exit; 	 
									
        } 	 

?>					