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
	This script handle school view broadcast information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	   
		        
			if ($_REQUEST['broadcastData'] == 'viewBroadcast') {

				
				$bID = strip_tags($_REQUEST['rData']);
				
				/* script validation */
				
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

							<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
							<i class="fa fa-comment"></i> Title </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
							$bTitle class </td> </tr> 

							<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
							<i class="fa fa-comment-o"></i> Message </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
							$broadcastMsg</td> </tr>


							<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
							<i class="fa fa-calendar-check-o"></i> Date </td> <td style="padding-left: 30px; text-align:left; width: 70%;">
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
			
			}else{ 
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			} 
			
exit;
?>