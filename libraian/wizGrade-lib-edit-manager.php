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
	This script handle library book edit
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
		 				
				$bookID = $_REQUEST['bookID'];

  				$ebele_mark = "SELECT book_id, book_name, book_author, book_desc, book_path, book_type, book_copies, book_location, 
								stype, sclass, book_status
				
								FROM $wizGradeSchLib
								
								WHERE book_id = :book_id";
					 
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
						$book_copies = $row['book_copies'];
						$book_location = $row['book_location'];
						$book_status = $row['book_status'];
						
					}  
				
					$book_name  = trim($book_name);
					$book_author  = trim($book_author);
					$book_desc  = trim($book_desc);
					$book_desc = htmlspecialchars_decode($book_desc);
					$book_desc = nl2br($book_desc);
					
					$bookPicture = libraryUploadsManager($conn, $book_type, $book_path);  /* school library book upload manager */  
						
?>
		
							 
												  
					<div id="msgBoxLib"></div>	<div class="msgBoxPic"></div> 

					<!-- form -->
					<form class="form-horizontal frm-update-lib-uploads" id="frmLibrary" role="form" action="wizGrade-library-manager.php">


						<div class="form-group">
						<label for="semester" class="col-lg-4 col-sm-4 control-label">* Book Type</label>

						<div class="col-lg-8">
						  <div class="iconic-input">
							  <i class="fa fa-book"></i>
							  
							  <select class="form-control"  id="book-type" name="book-type" required>
							  
								<option value = "">Please select One</option>

								<?php

									foreach($libraryTypeArr as $typeB => $typeBB){  /* loop array */

									if ( $book_type == $typeB){
										$selected = "SELECTED";
									} else {
										$selected = "";
									}

										echo '<option value="'.$typeB.'"'.$selected.'>'.$typeBB.'</option>' ."\r\n";

									}

								?>

								
								</select>


						  </div>
						</div>
						</div> 

						<div class="form-group" id="book-picture-div" style="display:none">
						<label class="control-label col-md-4">* <span id="book-name-display"> Book Upload </span> </label>
						<div class="col-md-8">
						  <div class="fileupload fileupload-new" data-provides="fileupload">
							  <div class="fileupload-new thumbnail msgSoftBoxPic" style="width: 
							  200px; height: 150px;">
								  <img src="<?php echo $bookPicture; ?>" alt="" />
							  </div>
							  <div class="fileupload-preview fileupload-exists thumbnail" 
							  style="max-width: 
							  200px; max-height: 150px; line-height: 20px;"></div>
							  <div>
							   <span class="btn btn-white btn-file">
							   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> 
							   Update File</span>
							   
							   <span class="fileupload-exists"><i class="fa fa-undo"></i> 
							   Update File</span>
							   <input type="file" id="book-lib-upload" 
							   name="book-lib-upload" class="default" required />
							   </span>
							 
							  </div>
						  </div>

						  <span class="label label-danger">NOTE!</span>
						 <span>Only file type of 
						 <span id="allow-format-doc">doc, docx, pdf, xls, xlsx, txt</span> 
						 <span id="allow-format-pic">jpg, png, jpeg, JPEG, JPG, PNG</span> 
						 and size 10MB is allowed. 
						 </span>
						</div>
						</div>


						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10"> 

							<input type="hidden" name="library-data" value="update-lib-book-upload" />
							<input type="hidden" name="bookID" value="<?php echo $book_id; ?>" />
							<input type="hidden" name="lib-book-name" value="<?php echo $book_name; ?>" />
							<input type="hidden" name="lib-book-path" value="<?php echo $book_path; ?>" />
							<input type="hidden" name="allow-format" id="allow-format" value="" />
																

							</div>
						</div>


						</div>

					</form>
					<!-- / form -->
					
					<hr /> 
					
					<!-- form -->
					<form class="form-horizontal" id="frmupdateLibrary" role="form">


					<div class="form-group">
					<label for="book-name" class="col-lg-4 col-sm-4 control-label">* Book Title</label>

						<div class="col-lg-8">

						<div class="iconic-input">
							  <i class="fa fa-book"></i>
							  
						<input type="text" class="form-control" placeholder="Book Title"  value="<?php echo $book_name; ?>"
						name="book-name" maxlength="100" id="book-name" style="text-transform:capitalize !important;" required />

						</div>

						</div>
					</div>



					<div class="form-group">
					<label for="book-authur" class="col-lg-4 col-sm-4 control-label">* Author Name</label>

						<div class="col-lg-8">

						<div class="iconic-input">
							  <i class="fa fa-user"></i>
							  
						<input type="text" class="form-control" placeholder="Author Name"  value="<?php echo $book_author; ?>"
						name="book-author" maxlength="100" id="book-author" style="text-transform:capitalize !important;" required />

						</div>
						</div>
					</div>


					<div class="form-group">
					<label for="book-desc" class="col-lg-4 col-sm-4 control-label"> &nbsp;&nbsp;Book Descriptions</label>

						<div class="col-lg-8">

						<textarea rows="4" cols="10" class="form-control" name="book-desc" id="book-desc" 
						placeholder="Book Descriptions"><?php echo $book_desc; ?></textarea>

						</div>
					</div>



					<div class="form-group book-harhcopy-divs">
					<label for="book-authur" class="col-lg-4 col-sm-4 control-label">* Number of Copies</label>

						<div class="col-lg-8">

						<div class="iconic-input">
							  <i class="fa fa-sort-numeric-asc"></i>
							  
						<input type="number" class="form-control" placeholder="Book Copies" value="<?php echo $book_copies; ?>" 
						name="book-copies" maxlength="5" id="book-copies" style="text-transform:capitalize !important;" required />

						</div>
						</div>
					</div>


					<div class="form-group book-harhcopy-divs">

					<label for="book-authur" class="col-lg-4 col-sm-4 control-label">Library Book Location </label>

						<div class="col-lg-8">

						<div class="iconic-input">
							  <i class="fa fa-briefcase"></i>
							  
						<input type="text" class="form-control" placeholder="Library Book Location"  
						value="<?php echo $book_location; ?>"
						name="book-location" maxlength="255" id="book-location" style="text-transform: capitalize !important;"/>

						</div>
						</div>
					</div>
													
					<div class="form-group book-harhcopy-divs">
					<label for="semester" class="col-lg-4 col-sm-4 control-label">* Book Status</label>

						<div class="col-lg-8">
						  <div class="iconic-input">
							  <i class="fa fa-cogs"></i>
							  
							  <select class="form-control"  id="book-status" name="book-status" required>


								<?php

									foreach($libraryStatusArr as $status => $statusN){  /* loop array */

										if ( $book_status == $status){
											$selected = "SELECTED";
										} else {
											$selected = "";
										}

										echo '<option value="'.$status.'"'.$selected.'>'.$statusN.'</option>' ."\r\n";

									}

								?>
								
								</select>                     

						  </div>
						</div>
					</div>
												

					<div class="form-group">  
						<input type="hidden" name="bookID" value="<?php echo $book_id; ?>" />
						<input type="hidden" name="library-data" value="update-lib-book" />
						<center><button type="submit" class="btn btn-success buttonMargin" id="updateLibrary">
						<i class="fa fa-save"></i> Update Book </button></center>
					</div> 

					</form>
					<!-- / form -->

					<script type='text/javascript'>  $('#book-type').trigger('change');  hidePageLoader();  /* hide page loader */ </script>
<?php
        
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

         	echo $errorMsg.$msg_e.$eEnd; echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>";	 echo $scrollUp; exit; 			

        }
		
exit;		
?>