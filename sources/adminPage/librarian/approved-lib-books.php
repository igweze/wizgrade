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
	This page load library approved books
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
                             <i class="fa fa-check-square-o fa-lg"></i> Approved <span class="hide-res">Library</span> Book 
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
				<thead><tr><th>S/N</th><th style="text-align:left !important;">Book Name</th> 
				<th style="text-align:left !important;">Apply Time</th>
				<th style="text-align:left !important;">Tasks</th></tr></thead> <tbody>
		
IGWEZE;

				
		 
			try {
		 
				
  				$ebele_mark = "SELECT b_id, book_id, lib_user, lib_reg, apply_date, approve_date, stype, sclass, b_status
				
								FROM $wizGradeLibApplyTB								
								
								WHERE b_status = :b_status
								
								ORDER BY b_id DESC";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':b_status', $seVal);				
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {  /* check array is empty */
				
					echo $table_head;
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */

						$applyID = $row['b_id'];
						$book_id = $row['book_id'];
						$lib_user = $row['lib_user'];
						$lib_reg = $row['lib_reg'];
						$approve_date = $row['approve_date'];
						$schoolID = $row['stype'];
						$sClassID = $row['sclass'];
						
						$bookInfo = libraryBookInfo($conn, $book_id);  /* school library book information */ 
				        list ($book_id, $book_name, $book_path, $book_author, $book_type, $book_status) = explode ("@.%.@", $bookInfo); 
						
						$bookPicture = libraryUploadsManager($conn, $book_type, $book_path);  /* school library book upload manager */						
					
						if($book_author == '') { $book_author = 'Anonymous'; }						
						
						$approve_date = strtotime($approve_date);
					    $applyDate = timerBoy($approve_date);
						//$a = date("h:i:s, d F, Y", $a);
											
						$serial_no++;
									
		
$lib_book =<<<IGWEZE
        
						<tr id='lib_book_row-$applyID' width='5%'><td>$serial_no</td>
						<td style="text-align:left !important; padding-right: 15px !important;" width='55%'> 
						<span id="library-pic-$book_id"><img src="$bookPicture" alt="" style="width: 30px; height: 30px; float:left;
						border-radius: 20px; padding-right: 5px" /> </span>
						<span id='lib_name-$book_id'><strong> $book_name </strong> By $book_author</span>
						</td> 		
						
						<td width='30%' style="text-align:left !important; padding-right: 15px !important;"> 
						<strong> $applyDate </strong> 
						</td> 		
						
						<td width='10%'>
						
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
								<i class="fa fa-wrench"></i> <span class="caret"></span></button>
									<ul role="menu" class="dropdown-menu pull-right">
											<li>
											<a href='javascript:;' id ="$applyID" class ='appBookInfo'><button class="btn btn-success btn-xs">
											<i class="fa fa-check-square-o"></i></button> Endorse Return</a>
											</li>
											<li class="divider"></li>
											<li>
											<a href='javascript:;' id ="$book_id" class ='showBookHistory'> <button class="btn btn-primary btn-xs">
											<i class="fa fa-eye"></i></button> Book History </a>					
											</li>
									</ul>	
							</div><!-- /btn-group -->
						
						</td> 
						
						</tr>
		
IGWEZE;
						echo $lib_book; 

					} 

				}else{  /* display information */ 
		
					$msg_i = "Oooooooops, no library approved book was found.";
					echo $infMsg.$msg_i.$msgEnd;
		
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
                              <i class="fa fa-wrench fa-lg"></i>  Book Info							  
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

						echo $succesMsg.$msg_s.$sEnd ; echo $scrollUp;// exit; 				
												
					}	


					if ($msg_e) {

						echo $errorMsg.$msg_e.$eEnd; echo $scrollUp;// exit; 			
						
												
					}	
					
		//exit;
?>