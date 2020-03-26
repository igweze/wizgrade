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
	This script handle school scratch card pins
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configINwizGrade.php';  /* load wizGrade configuration files */	   
		        
			if ($_REQUEST['cardPinData'] == 'saveCardPin') {  /* save school cardPin */	   
 
				$pinCount =  preg_replace("/[^0-9]/", "", $_REQUEST['pinCount']);
				$iiii_serial_iiii =  strip_tags($_REQUEST['iiii_serial_iiii']);
				
				/* script validation */
				
				if (($pinCount == "") || ($pinCount <= $fiVal)) {
         			
					$msg_e = "* Oooooooops Error, please enter <b>No. of Pins to Generate</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}elseif ($iiii_serial_iiii == "")  {
         			
					$msg_e = "* Oooooooops Error, please enter <b>Card Serial No</b>";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* insert information */   

						$msg_s = "<strong>$pinCount Scratch card pin/s</strong> was successfully created"; 
						echo $succesMsg.$msg_s.$sEnd;     			

		 			try {
						
$tableHead =<<<IGWEZE
        
				<script type='text/javascript'> $('.paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ </script> 
				<button class="paginate-page display-none"  type="submit">Paginate Page</button> 										
				
				<!-- table -->
				<table  class='table table-hover style-table wizGradeTBPage'>
						<thead><tr>
                        
						<th class='text-left'>S/N</th> 						 
						<th class='text-left'>Card Pin</th> 
						<th class='text-left'>Serial No.</th>
						
                        </tr></thead> <tbody>
		
IGWEZE;
                               
		        echo $tableHead;
				echo "<script type='text/javascript'>   $('#frmsaveCardPin').slideUp(500); </script>";										
				
						for ($i = 1; $i <= $pinCount; $i++){
						
							mt_srand((double)microtime() * 1000000);
							
							$iiii_pin = wizGradeRandomString($randNumber, 12);	
						
							$ebele_mark = "INSERT INTO $eWalletTB  (iiii_pin_iiii, iiii_serial_iiii)

									VALUES (:iiii_pin_iiii, :iiii_serial_iiii)";
						 
							$igweze_prep = $conn->prepare($ebele_mark); 
							$igweze_prep->bindValue(':iiii_pin_iiii', $iiii_pin); 
							$igweze_prep->bindValue(':iiii_serial_iiii', $iiii_serial_iiii);
							 
							
							if($igweze_prep->execute()){  /* if sucessfully */
							

$tableHead =<<<IGWEZE
        
								<tr id='row-$iiii_id'>
								<td class='text-left' width='10%'>$i</td>
								<td class='text-left' width='45%'>$iiii_pin</td>
								<td class='text-left' width='45%'>$iiii_serial_iiii</td>
								</tr>
		
IGWEZE;
                               
								echo $tableHead;															
								
							}else{  /* display error */ 
					
								$msg_e =  "Ooooooooops, an error has occur while to save scratch card pins. Please try again";
								echo $errorMsg.$msg_e.$eEnd; exit;
								
							}
							
							$iiii_pin = '';
						}								
						
						echo "</tbody>
						</table>
						<!-- / table --> ";
						echo "<script type='text/javascript'>   $('#saveLoader').fadeOut(1500); </script>";exit;

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['cardPinData'] == 'removeCardPin') {  /* remove school cardPin */ 
				
				$cardPinData = $_REQUEST['rData'];
				
				list($wizGradeIg, $iiii_id, $hName) = explode("-", $cardPinData);			
				
				/* script validation */
				
				if (($cardPinData == "")  || ($iiii_id == "")){
         			
					$msg_e = "* Ooooooooops, an error has occur while to remove scratch card pins. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
					
	   			}else {  /* remove information */       			


		 			try {
						
						
						$ebele_mark = "DELETE FROM 
						
										$eWalletTB										
											
										WHERE iiii_id = :iiii_id
											
										LIMIT 1";
					 
						$igweze_prep = $conn->prepare($ebele_mark);
						$igweze_prep->bindValue(':iiii_id', $iiii_id);  
						
						if($igweze_prep->execute()){  /* if sucessfully */
							
							$removeDiv = "$('#row-".$iiii_id."').fadeOut(1000);";
							$msg_s = "<strong>Scratch card pin</strong> was successfully removed"; 
							echo $succesMsg.$msg_s.$sEnd; 
							echo "<script type='text/javascript'>   
							$('#removeLoader').fadeOut(1500); $('.slideUpFrmDiv').fadeOut(3000); $removeDiv  </script>";exit;
							
						}else{  /* display error */ 
				
							$msg_e =  "Ooooooooops, an error has occur while to remove scratch card pin. Please try again";
							echo $errorMsg.$msg_e.$eEnd; 
							echo "<script type='text/javascript'>   $('#removeLoader').fadeOut(1500); </script>";exit;
							
						}
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					} 
        	
				}
			
			}elseif ($_REQUEST['cardPinData'] == 'viewCardPin') {  /* view school cardPin */

				$iiii_id = $_REQUEST['rData'];				
				
				if ($iiii_id == ""){
         			
					$msg_e = "* Ooooooooops, an error has occur while to retrieve scratch card pin information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   $('#editLoader').fadeOut(1500); </script>";exit;
					
	   			}else {       			

		 			try {						
													
						$cardPinInfoArr = cardPinInfo($conn, $iiii_id);  /* school cardPin information */ 
						$iiii_pin_iiii = $cardPinInfoArr[$fiVal]["iiii_pin_iiii"];
						$iiii_serial_iiii = $cardPinInfoArr[$fiVal]["iiii_serial_iiii"];
						$iiii_reg_id = $cardPinInfoArr[$fiVal]["iiii_reg_id"];
						$regNum = $cardPinInfoArr[$fiVal]["iiii_reg"];
						$schoolID = $cardPinInfoArr[$fiVal]["iiii_stype"];
						$iiii_level = $cardPinInfoArr[$fiVal]["iiii_level"];
						$iiii_term = $cardPinInfoArr[$fiVal]["iiii_term"];
						$reTime = $cardPinInfoArr[$fiVal]["iiii_time"];
						$iiii_status = $cardPinInfoArr[$fiVal]["iiii_status"];
				
						if($iiii_status == ""){ $iiii_status = $i_false; }
						$schoolName = $school_list[$schoolID];												
						$cardStatus = $cardStatusArr[$iiii_status];
						if($schoolID == ""){ $schoolID = $fiVal; }

						require $wizGradeSchoolTBS; /* include student database table information  */		
						
						$studentName = studentName($conn, $regNum);  /* student name  */
		
						$studentPic = studentPicture($conn, $regNum);  /* student picture  */
						
						$levelArray = studentLevelsArray($conn);  /* student level array */ 
						
						$schoolLevel = $levelArray[$iiii_level]['level'];
						
						//$rechargeTime = date("j M Y", strtotime($reTime)); 
						If($rechargeTime != "") {$rechargeTime = date("j M Y", $reTime); }					

$showCardPin =<<<IGWEZE
		
						<button  class="btn btn-white printer-icon pull-right">
						<i class="fa fa-print text-info"></i> Print </button><br clear="all"/><br clear="all"/>

						<div id = 'wizGradePrintArea'>

						<!-- table -->
						<table width = '100%' class="table table-striped  table-advance table-hover"> 

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-lock"></i> Card Pin </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$iiii_pin_iiii </td> </tr> 

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-lock-o"></i> Serial No. </td> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$iiii_serial_iiii</td> </tr> 

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-book"></i> School</td> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$schoolName</td> </tr> 
						
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-book"></i> Class Level</td> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$schoolLevel</td> </tr> 
						
						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-book"></i> School Term</td> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$iiii_term</td> </tr>

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-clock-o"></i> Recharge Time</td> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$rechargeTime</td> </tr>

						<tr><th style="padding-left: 30px; text-align:left; width: 40%;">
						<i class="fa fa-bars"></i> Card Status</td> <td style="padding-left: 30px; text-align:left; width: 60%;">
						$cardStatus</td> </tr>	

						</table>
						<!-- / table --> 

						</div>
		
IGWEZE;
				
						echo $showCardPin; 
						
						echo "<script type='text/javascript'>  $('#editLoader').fadeOut(3000); </script>"; exit;
						
						

				 	}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
					}
		 
        	
				}
			
			}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			} 
			
exit;

?>