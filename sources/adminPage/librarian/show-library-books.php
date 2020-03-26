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
	This page is load library books
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>
 		 		

                 	<!-- row -->	
					<div class="row">  
						<div class="col-lg-6">
						<section class="panel wizgrade-section-div" id="scrollLTarget">                      
							<header class="panel-heading">
                              <i class="fa fa-line-chart fa-lg"></i> Library Manager
							  <span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line"> 
                          
								<div id="lib-book-msg"></div>


<?php
		 echo "<script type='text/javascript'> $('#paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ </script>";
		 
$table_head =<<<IGWEZE
        
								<!-- table -->
								<table  class='table table-hover style-table' id="wizGradeTBPage">
								<thead><tr><th style="text-align:left !important;">Book Name</th> 
								<th style="text-align:left !important;">School</th> 
								<th style="text-align:left !important;">Type</th>
								<th style="text-align:left !important;">Tasks</th></tr></thead> <tbody>
		
IGWEZE;

				
		 
			try {
		 
				
  				$ebele_mark = "SELECT book_id, book_name, book_author, book_path, book_type, stype 
				
								FROM $wizGradeSchLib
								
								
								ORDER BY book_id DESC";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);				
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {  /* check array is empty */
				
					echo $table_head;
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
	   
						$book_id = $row['book_id'];
						$book_name = $row['book_name'];
						$book_author = $row['book_author'];
						$book_path = $row['book_path'];
						$book_type = $row['book_type'];
						$schoolID = $row['stype']; 
						
						$bookPicture = libraryUploadsManager($conn, $book_type, $book_path);  /* school library book upload manager */
						
						$schoolName = $school_list[$schoolID]; 
						
						if($book_author == '') { $book_author = 'Anonymous'; }
						if($book_type != '') { $book_type = $libraryTypeArr[$book_type]; }
						else{$book_type = '-';}
											
						$serial_no++; 
        			
						/*<input type="text" class="form-control edit-library-book" placeholder="book name"  value="$book_name"  
						id ="book-name-$book_id"        name="book-name" maxlength="100" id="book-name" required />*/
		
$lib_book =<<<IGWEZE
        
						<tr id='lib_book_row-$book_id'>
						<td style="text-align:left !important; padding-right: 5px !important;" width='45%'> 
						<span id="library-pic-$book_id"><img src="$bookPicture" alt="" style="width: 30px; height: 30px; float:left;
						border-radius: 20px; padding-right: 5px" /> </span>
						<span id='lib_name-$book_id'><strong> $book_name </strong> By $book_author</span>
						</td> 
						
						<td style="text-align:left !important; padding-right: 5px !important;" width='25%'> 
						  $schoolName
						</td> 
						
						<td style="text-align:left !important; padding-right: 5px !important;" width='20%'> 
						<span id='lib_type-$book_id'>$book_type  </span>
						</td>  
						
						<td width='10%'><div id='book-path-$book_id' style='display:none;'>$book_path</div>
						
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
								<i class="fa fa-wrench"></i> <span class="caret"></span></button>
									<ul role="menu" class="dropdown-menu pull-right">
											<li>
											<a href='javascript:;' id ="$book_id" class ='show-lib-book'><button class="btn btn-success btn-xs">
											<i class="fa fa-search-plus"></i></button> View</a>
											</li>
											<li class="divider"></li>
											<li>
											<a href='javascript:;' id ="$book_id" class ='showBookHistory'> <button class="btn btn-primary btn-xs">
											<i class="fa fa-eye"></i></button> Book History </a>					
											</li>
											<li class="divider"></li>
											<li>
											<a href='javascript:;' id ="$book_id" class ='edit-lib-book'> <button class="btn btn-primary btn-xs">
											<i class="fa fa-edit"></i></button> Edit Book</a>					
											</li>
											<li class="divider"></li>
											<li>
											<a href='javascript:;' id ="book-lib-$book_id-$book_name" class ='remove-lib-book'> <button class="btn btn-danger btn-xs">
											<i class="fa fa-times"></i></button> Remove Book </a>					
											</li>
									</ul>	
							</div><!-- /btn-group --> 
						
						</td> </tr>
		
IGWEZE;
						echo $lib_book;
		
				

					}
		

				}else{
		
					$msg_e = "Oooooooops error, no book was found for this department in school library. ";
		
				}
		
			}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}
	
		
						echo  '</tbody></table><!-- / table -->'; 
?>


								</div>
							</section>
                      
						</div> 
                      
						<div class="col-lg-6">
							<section class="panel" id="scrollLTarget-t">                      
							<header class="panel-heading">
                              <i class="fa fa-wrench fa-lg"></i> Library Tasks 
							  <span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line">  
                          
								<div id="lib-edit-div"></div> 
                          
							</div>
							</section>
                      
						</div> 
                      
                    </div>
					<!-- / row --> 

					<!-- library book removal pop up modal start -->				

					<a href="#remove-lib-modal" data-toggle="modal" id="modal-lib-remove-btn" class=""> </a>

					<div class="modal fade" id="remove-lib-modal" tabindex="-1" role="dialog" 
					aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" 
							data-dismiss="modal" aria-hidden="true">
							<span style='color:#fff !important;'>&times;</span></button>
							<h4 class="modal-title"> Are sure you want to remove this Library Book information ?
						</h4>
						</div>
						<div class="modal-body">
						<div id="filterSettingsMsg"> </div>
						<div class="wizgrade-section-div">

							<section class="panel">

							<div class="panel-body">

								<div id="remove-lib-data" style="display:none;"></div>

								<?php 

								echo "$infoMsgNX  Are sure you want to remove? <br />
								<span id='show-lib-pic' class='text-left'></span>
								<span style='color:#000;font-weight:bold;'  id='remove-lib-info'> </span> $msgEnd";
								?> 
												 
							</div>

							</section>

						</div> 

						<div class="modal-footer">
							<button data-dismiss="modal" class="btn btn-danger" id="remove-library-book" 
							type="button">Yes</button>
							<button data-dismiss="modal" class="btn btn-danger" 
							type="button">Cancel</button>
						</div>
						</div>
						</div>
					</div>

					<!-- library book removal pop up modal end --> 

<?php

					if ($msg_s) {

						echo $succesMsg.$msg_s.$sEnd ; echo $scrollUp; //exit; 				
												
					}	


					if ($msg_e) {

						echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; //exit; 			
						
												
					}	
			
//exit;

?>