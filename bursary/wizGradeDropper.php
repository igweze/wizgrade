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
	This script handle all dropdown auto field
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

      define('wizGrade', 'igweze');  /* define a check for wrong access of file */

      
      require 'configwizGrade.php';  /* load wizGrade configuration files */	   
	  
	    if($_GET['feeCat'] == "dropFeeDiv" && isset($_GET['feeCat'])) { /* load fee div */	
   				 
				$feeCatID = strip_tags($_GET['feeCatID']); 
			 
			    if($feeCatID >= $fiVal){
				 
					echo "<script type='text/javascript'> $('#feeDetailsDivTop').show(); </script>";  				
				 
			    }else{
					
					echo "<script type='text/javascript'> $('#feeDetailsDivTop').hide(); </script>";  
					
				} 
	
	    }
		
		if($_GET['eCat'] == "dropExpenseDiv" && isset($_GET['eCat'])) {   /* load expense div */   		
		 
				$eCatID = strip_tags($_GET['eCatID']); 
			 
			    if($eCatID >= $fiVal){
				 
					echo "<script type='text/javascript'> $('#expenseDetailsDiv').show(); </script>";  				
				 
			    }else{
					
					echo "<script type='text/javascript'> $('#expenseDetailsDiv').hide(); </script>";  
					
				}
	
	    }
				
		if($_GET['pCat'] == "dropPCatDiv" && isset($_GET['pCat'])) {   /* load product div */   		
		 
				$pCatID = strip_tags($_GET['pCatID']); 
			 
			    if($pCatID >= $fiVal){
				 
					echo "<script type='text/javascript'> $('#productDetailsDiv').show(); </script>";  				
				 
			    }else{
					
					echo "<script type='text/javascript'> $('#productDetailsDiv').hide(); </script>";  
					
				}	 
	
	    }
		
		if($_GET['func'] == "drop_1" && isset($_GET['func'])) {   /* load school type dropdown */		
		 
				$schoolID = strip_tags($_GET['schoolID']); 
			 
			    if($schoolID >= $fiVal){
				 
				 
					$level_list = mlevelArrays($schoolID);

					echo '<div class="form-group">
						<label for="class" class="col-lg-4 col-sm-4 control-label">* Payment Level</label>

						<div class="col-lg-8">
						<div class="iconic-input">
						<i class="fa fa-level-down"></i>

						<select class="form-control"  id="cLevel" name="class" required>

						<option value = "">Please select One</option>'; 

							foreach($level_list as $level => $levelVal){ /* loop array */											

								echo '<option value="'.$schoolID.'@$@'.$level.'"'.$selected.'>'.$levelVal.'</option>' ."\r\n";

							}

						echo '
						</select>
						</div>
						</div>
					</div>'; 
				 
			    }else{ 
					
					echo '<option value="">Oooooooops Error, could not select school</option>' ."\r\n"; 
					
				}	 
			
	
	    } 
		
		if($_GET['func'] == "loadStudents" && isset($_GET['func'])) {   /* load student dropdown */	

			$levelData = strip_tags($_GET['clevelID']);

			list ($schoolID, $level) = explode ("@$@", $levelData);	
			 
					try{
						 
						$sessionInfo = currentSessionInfo($conn);  /* current school session information  */
						
						list ($fiSessionID, $fiSession) = explode ("@$@", $sessionInfo);
						
						if($level == $fiVal){
							
							$sessionID = $fiSessionID;
						
						}elseif($level == $seVal){
				
							$sessionID  =  ($fiSessionID - $fiVal);
						
						}elseif($level == $thVal){	
							
							$sessionID  =  ($fiSessionID - $seVal);
							
						}elseif($level == $foVal){	
							
							$sessionID  =  ($fiSessionID - $thVal);
						
						}elseif($level == $fifVal){	
							
							$sessionID  =  ($fiSessionID - $foVal);
							
						}elseif($level == $sixVal){	
						
							$sessionID  =  ($fiSessionID - $fifVal);
							
						}else{
							
							$msg_e = "* Oooooooops Error, could not find records";
							echo $errorMsg.$msg_e.$eEnd; 
							exit;
							
						}	
					 
						require $wizGradeSchoolTBS;  /* include database table information  */
						
						
					}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
					}


$feesData =<<<IGWEZE
        
					<script type="text/javascript">
					  //<![CDATA[
						$(document).ready(function(){
						  $('.combobox').combobox()
						});
					  //]]>
					</script>
		
IGWEZE;
                               
					echo $feesData;			

					echo'	<div class="form-group">
										  <label for="reg" class="col-lg-4 col-sm-4 control-label">* Select Student</label>
										 
					<div class="col-lg-8">
						  <div class="iconic-input">
							  <i class="fa fa-user"></i>
							  
							  <select class="combobox form-control"  id="regStudents" name="regData" required>
							  
								<option value = "">Please select student</option>';
								
									 try {
										
											studentOptions($conn, $sessionID, $seVal);  /* student dropdown select option field */
								 
										}catch(PDOException $e) {
			
										wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
										} 
							
							  
					echo'</select>
						  </div>
						   
					  </div>
					</div>';
				  
					echo "<script type='text/javascript'> $('#feeDetailsDiv').show(); </script>";   
				  
 			
	    } 
		
		if($_GET['pay'] == "calStatus" && isset($_GET['pay'])) {   /* load fee details div */	
		 
				$feeCatID = strip_tags($_GET['amountPay']); 
			 
			    if($feeCatID >= $fiVal){
				 
					echo "<script type='text/javascript'> $('#feeDetailsDivTop').show(); </script>";  				
				 
			    }else{
					
					echo "<script type='text/javascript'> $('#feeDetailsDivTop').hide(); </script>";  
					
				}	 
	
	    }exit;

exit;//JP7JQ F85F6
?>

