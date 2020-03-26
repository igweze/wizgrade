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
	This script handle school broadcasts
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configINwizGrade.php';  /* load wizGrade configuration files */	   
		        
			if ($_REQUEST['broadcastData'] == 'saveBroadcast') {  /* save school broadcast */	   
 
				$bTitle =  strip_tags($_REQUEST['title']);
				$broadcastMsg = $_REQUEST['broadcastMsg']; 
				$bDay = $_REQUEST['bDay'];
				
				/* script validation */
				
				if ($bTitle == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter Broadcast Title";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($broadcastMsg == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter Broadcast Message";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($bDay == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a Broadcast date";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* insert information */       			
				 
					
					$broadcastMsg = strip_tags($broadcastMsg);
					$broadcastMsg = str_replace('<br />', "\n", $broadcastMsg);
					$broadcastMsg = htmlspecialchars($broadcastMsg); 

		 			try {
						
						
						$ebele_mark = "INSERT INTO $wizGradeBroadcastTB  (bTitle, broadcastMsg, date)

								VALUES (:bTitle, :broadcastMsg, :date)";
					 
						$igweze_prep = $conn->prepare($ebele_mark); 
						$igweze_prep->bindValue(':bTitle', $bTitle); 
						$igweze_prep->bindValue(':broadcastMsg', $broadcastMsg);
						$igweze_prep->bindValue(':date', $bDay); 
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "Broadcast Message was successfully saved"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewBroadcast').load('wizGradeBroadcastInfo.php'); 
							$('#frmsaveBroadcast')[0].reset();  $('#saveLoader').fadeOut(1500);  
							$('.alert').fadeOut(30000); </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save Broadcast Message. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['broadcastData'] == 'updateBroadcast') {  /* update school broadcast */

				$bID = preg_replace("/[^0-9]/", "", $_REQUEST['bID']);	
				$bTitle =  strip_tags($_REQUEST['title']);	 
				$broadcastMsg = $_REQUEST['broadcastMsg'];
				$eAmount = $_REQUEST['eAmount']; 
				$bDay = $_REQUEST['bDay'];
				
				/* script validation */ 
				
				if ($bID == ""){
         			
					$msg_e = "* Ooooooooops, aan error has occur to retrieve broadcast information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($bTitle == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter Broadcast Title";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($broadcastMsg == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter Broadcast Message";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($bDay == "")  {
         			
					$msg_e = "* Oooooooops Error, please select a Broadcast date";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* update information */       			
				
					$broadcastMsg = strip_tags($broadcastMsg);
					$broadcastMsg = str_replace('<br />', "\n", $broadcastMsg);
					$broadcastMsg = htmlspecialchars($broadcastMsg); 

		 			try { 
						
						$ebele_mark = "UPDATE $wizGradeBroadcastTB  
											
											SET  
											 
											bTitle = :bTitle, 		
											broadcastMsg = :broadcastMsg,
											date = :date
											
										WHERE bID = :bID";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':bID', $bID); 
						$igweze_prep->bindValue(':bTitle', $bTitle); 
						$igweze_prep->bindValue(':broadcastMsg', $broadcastMsg);
						$igweze_prep->bindValue(':date', $bDay);  
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$msg_s = "Broadcast Message was successfully saved."; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'> $('#viewBroadcast').load('wizGradeBroadcastInfo.php'); 
							   $('#editLoader').fadeOut(1500);  $('#editBroadcastDiv').slideUp(1500);
							</script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to save Broadcast Message. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
							
						} 

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['broadcastData'] == 'removeBroadcast') {  /* remove school broadcast */ 
				
				$broadcastData = $_REQUEST['rData'];
				
				list($wizGradeIg, $bID, $hName) = explode("-", $broadcastData);			
				
				/* script validation */
				
				if (($broadcastData == "")  || ($bID == "")){
         			
					$msg_e = "* Ooooooooops, an error has occur while to remove Broadcast Message. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* remove information */       			


		 			try {
						
						
						$ebele_mark = "DELETE FROM 
						
										$wizGradeBroadcastTB										
											
										WHERE bID = :bID
											
										LIMIT 1";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':bID', $bID);  
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$bID."').fadeOut(1000);";
							$msg_s = "<strong>Broadcast Message</strong> was successfully removed"; 
							echo $succesMsg.$msg_s.$sEnd ; 
							echo "<script type='text/javascript'>   
							$('#removeLoader').fadeOut(1500); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to remove Broadcast Message. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['broadcastData'] == 'viewBroadcast') {  /* view school broadcast */

				
				$bID = $_REQUEST['rData'];
				
				
				if ($bID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve Broadcast Message. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       			


		 			try {
						
						
						$broadcastInfoArr = broadcastInfo($conn, $bID);  /* school annoucement/broadcast information */ 
						$bTitle = $broadcastInfoArr[$fiVal]["bTitle"];
						$broadcastMsg = htmlspecialchars_decode($broadcastInfoArr[$fiVal]["broadcastMsg"]); 
						$date = $broadcastInfoArr[$fiVal]["date"];
						 
						
						$date = date("j F Y", strtotime($date));  
						$broadcastMsg = nl2br($broadcastMsg);
									

$showBroadcast =<<<IGWEZE
		
						<button  class="btn btn-white printer-icon pull-right">
						<i class="fa fa-print text-info"></i> Print </button><br clear="all"/><br clear="all"/>

						<div id = 'wizGradePrintArea'>

						<!-- table -->
						<table width = '100%' class="table table-striped  table-advance table-hover"> 

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-comment"></i> Broadcast Title </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$bTitle class </td> </tr> 

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-comment-o"></i> Broadcast Details </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$broadcastMsg</td> </tr> 

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-calendar-check-o"></i> Broadcast Date </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$date</td> </tr> 

						</table>
						<!-- / table --> 

						</div>
		
IGWEZE;
				
						echo $showBroadcast; 
						
						echo "<script type='text/javascript'>  $('#editLoader').fadeOut(3000); </script>"; exit;
						
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		 
        	
				}
			
			}elseif ($_REQUEST['broadcastData'] == 'editBroadcast') {  /* edit school broadcast */ 
				
				$bID = strip_tags($_REQUEST['rData']); 
				
				if ($bID == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve Broadcast Message. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       

		 			try { 
						
						$broadcastInfoArr = broadcastInfo($conn, $bID);  /* school annoucement/broadcast information */ 
						$bTitle = $broadcastInfoArr[$fiVal]["bTitle"];
						$broadcastMsg = htmlspecialchars_decode($broadcastInfoArr[$fiVal]["broadcastMsg"]); 
						$date = $broadcastInfoArr[$fiVal]["date"];


?>
						<!-- form -->
						<form class="form-horizontal" id="frmupdateBroadcast" role="form"> 

							<div class="form-group" >
								<label for="title" class="col-lg-4 col-sm-4 control-label"> Broadcast Title</label>

								<div class="col-lg-8">

								<div class="iconic-input">
								<i class="fa fa-comment"></i>

								<input type="text" class="form-control" placeholder="Enter Broadcast Title" 
								name="title"  id="title" value="<?php echo $bTitle; ?>">

								</div>

								</div>
							</div>   

							<div class="form-group">
								<label for="broadcastMsg" class="col-lg-4 col-sm-4 control-label"> &nbsp;&nbsp; Broadcast Details</label>

								<div class="col-lg-8">

								<textarea rows="4" cols="10" class="form-control" name="broadcastMsg" id="broadcastMsg" 
								placeholder="Broadcast Message"><?php echo $broadcastMsg; ?></textarea>

								</div>
							</div>  

							<div class="form-group">
								<label class="control-label col-lg-4 col-sm-4">* Broadcast Date:</label>
								<div class="col-lg-7 col-sm-7">

								<div data-date-viewmode="years" data-date-format="yyyy-mm-dd" 
								data-date="2012-12-02"  
								class="input-append date dpYears">
								  <input type="text" readonly="" 
								  value="<?php echo $date; ?>" 
								  size="10" class="form-control"  name="bDay"  required />
								  <span class="input-group-btn add-on">
									<button class="btn btn-danger" type="button">
									<i class="fa fa-calendar"></i></button>
								  </span>
								</div>
								<span class="help-block">Select date</span>
								<input type="hidden" name="bID" value="<?php echo $bID; ?>" />		
								</div>
								</div>

							</div> 

							<div class="form-group">
								<input type="hidden" name="broadcastData" value="updateBroadcast" />
								<center><button type="submit" class="btn btn-danger buttonMargin" id="updateBroadcast">
								<i class="fa fa-save"></i> Update Broadcast </button></center>
							</div> 

						</form>  	
						<!-- / form -->					
						
<?php						
								
						echo "<script type='text/javascript'>  $('.dpYears').datepicker();  
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