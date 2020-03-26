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
	This script handle school grades
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configINwizGrade.php';  /* load wizGrade configuration files */	   
		        
			if ($_REQUEST['gradeData'] == 'saveGrade') {  /* save school grade */	   
 
				$fromGrade =  preg_replace("/[^0-9]/", "", $_REQUEST['fromGrade']);
				$toGrade =  preg_replace("/[^0-9]/", "", $_REQUEST['toGrade']);
				$grade =  preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['grade']);				
				
				/* script validation */
				
				if ($fromGrade == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter <b>score grade from</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($toGrade == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter <b>score grade to</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($fromGrade >= $toGrade)  {
         			
					$msg_e = "* Oooooooops Error,  <b>score grade from</b> cannot be equal to or greater than <b>score grade to</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($grade == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter score grade";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* insert information */       			

		 			try {
						
						$grade = strtoupper($grade);						
						
						$ebele_mark = "INSERT INTO $wizGradeGradeTB  (fromGrade, toGrade, grade)

								VALUES (:fromGrade, :toGrade, :grade)";
					 
						$igweze_prep = $conn->prepare($ebele_mark); 
						$igweze_prep->bindValue(':fromGrade', $fromGrade); 
						$igweze_prep->bindValue(':toGrade', $toGrade);
						$igweze_prep->bindValue(':grade', $grade); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "School grade score was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewGrade').load('wizGradeGradeInfo.php'); 
							$('#frmsaveGrade')[0].reset();  $('#saveLoader').fadeOut(1500);  
							$('.alert').fadeOut(30000); </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save school grade score. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['gradeData'] == 'updateGrade') {  /* upgrade school grade */

				$gID = preg_replace("/[^0-9]/", "", $_REQUEST['gID']);	
				$fromGrade =  preg_replace("/[^0-9]/", "", $_REQUEST['fromGrade']);
				$toGrade =  preg_replace("/[^0-9]/", "", $_REQUEST['toGrade']);
				$grade =  preg_replace("/[^A-Za-z0-9]/", "", $_REQUEST['grade']);				
				
				/* script validation */ 
				
				if ($gID == ""){
         			
					$msg_e = "* Ooooooooops, aan error has occur to retrieve school grade information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($fromGrade == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter <b>score grade from</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($toGrade == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter <b>score grade to</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($fromGrade >= $toGrade)  {
         			
					$msg_e = "* Oooooooops Error,  <b>score grade from</b> cannot be equal to or greater than <b>score grade to</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($grade == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter score grade";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* upgrade information */       			
				
					
		 			try { 
						
						$grade = strtoupper($grade);
						
						$ebele_mark = "UPDATE $wizGradeGradeTB  
											
											SET  
											 
											fromGrade = :fromGrade, 		
											toGrade = :toGrade,
											grade = :grade
											
										WHERE gID = :gID";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':gID', $gID); 
						$igweze_prep->bindValue(':fromGrade', $fromGrade); 
						$igweze_prep->bindValue(':toGrade', $toGrade);
						$igweze_prep->bindValue(':grade', $grade);  
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "School grade score was successfully saved."; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewGrade').load('wizGradeGradeInfo.php'); 
							   $('#editLoader').fadeOut(1500);  $('#editGradeDiv').slideUp(1500);
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save school grade score. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
							
						} 

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['gradeData'] == 'removeGrade') {  /* remove school grade */ 
				
				$gradeData = $_REQUEST['rData'];
				
				list($wizGradeIg, $gID, $hName) = explode("-", $gradeData);			
				
				/* script validation */
				
				if (($gradeData == "")  || ($gID == "")){
         			
					$msg_e = "* Ooooooooops, an error has occur while to remove school grade score. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* remove information */       			


		 			try {
						
						
						$ebele_mark = "DELETE FROM 
						
										$wizGradeGradeTB										
											
										WHERE gID = :gID
											
										LIMIT 1";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':gID', $gID);  
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$gID."').fadeOut(1000);";
							$msg_s = "<strong>School grade score</strong> was successfully removed"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'>   
							$('#removeLoader').fadeOut(1500); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to remove school grade score. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['gradeData'] == 'viewGrade') {  /* view school grade */

				
				$gID = $_REQUEST['rData'];
				
				
				if ($gID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve school grade score. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       			


		 			try {						
						
						$gradeInfoArr = gradeInfo($conn, $gID);  /* school grade information */ 
						$fromGrade = $gradeInfoArr[$fiVal]["fromGrade"];
						$toGrade = $gradeInfoArr[$fiVal]["toGrade"]; 
						$grade = $gradeInfoArr[$fiVal]["grade"]; 
									

$showGrade =<<<IGWEZE
		
						<button  class="btn btn-white printer-icon pull-right">
						<i class="fa fa-print text-info"></i> Print </button><br clear="all"/><br clear="all"/>

						<div id = 'wizGradePrintArea'>

						<!-- table -->
						<table width = '100%' class="table table-striped  table-advance table-hover"> 

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-comment"></i> Grade Score From </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$fromGrade </td> </tr> 

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-comment-o"></i> Grade Score To </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$toGrade</td> </tr> 

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-calendar-check-o"></i> Score Grade</td> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$grade</td> </tr> 

						</table>
						<!-- / table --> 

						</div>
		
IGWEZE;
				
						echo $showGrade; 
						
						echo "<script type='text/javascript'>  $('#editLoader').fadeOut(3000); </script>"; exit;
						
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		 
        	
				}
			
			}elseif ($_REQUEST['gradeData'] == 'editGrade') {  /* edit school grade */ 
				
				$gID = strip_tags($_REQUEST['rData']); 
				
				if ($gID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve school grade score. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       

		 			try { 
						
						$gradeInfoArr = gradeInfo($conn, $gID);  /* school grade information */ 
						$fromGrade = $gradeInfoArr[$fiVal]["fromGrade"];
						$toGrade = $gradeInfoArr[$fiVal]["toGrade"]; 
						$grade = $gradeInfoArr[$fiVal]["grade"];

?>
						<!-- form -->
						<form class="form-horizontal" id="frmupdateGrade" role="form"> 

							<div class="form-group" >
								<label for="fromGrade" class="col-lg-5 col-sm-5 control-label"> * Score From  (Lowest Score)</label>

								<div class="col-lg-7">

								<div class="iconic-input">
								<i class="fa fa-comment"></i>

								<input type="text" class="form-control" placeholder="Enter Grade From" 
								name="fromGrade"  id="fromGrade" value="<?php echo $fromGrade; ?>">

								</div>

								</div>
							</div>

							<div class="form-group" >
								<label for="toGrade" class="col-lg-5 col-sm-5 control-label"> * Score To  (Highest Score)</label>

								<div class="col-lg-7">

								<div class="iconic-input">
								<i class="fa fa-comment"></i>

								<input type="text" class="form-control" placeholder="Enter Grade To" 
								name="toGrade"  id="toGrade" value="<?php echo $toGrade; ?>">

								</div>

								</div>
							</div>

							<div class="form-group" >
							
								<label for="grade" class="col-lg-5 col-sm-5 control-label"> * Score Grade</label>

								<div class="col-lg-7">

									<div class="iconic-input">
									<i class="fa fa-comment"></i>
									<input type="text" class="form-control" placeholder="Enter Score Grade" 
									name="grade"  id="grade" value="<?php echo $grade; ?>">
									</div>

								</div>
							</div>	 

							<div class="form-group">
								<input type="hidden" name="gradeData" value="updateGrade" />
								<input type="hidden" name="gID" value="<?php echo $gID; ?>" />		
								<center><button type="submit" class="btn btn-danger demoDisenable buttonMargin" id="updateGrade">
								<i class="fa fa-save"></i> Update Grade </button></center>
							</div> 

						</form>  	
						<!-- / form -->					
						
<?php						
								
						echo "<script type='text/javascript'>
						$('#editLoader').fadeOut(3000); </script>"; exit; 

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			} 
			
exit;

?>