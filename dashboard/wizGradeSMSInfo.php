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
	This script handle school SMS gateway information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configINwizGrade.php';  /* load wizGrade configuration files */
		 
		 try {
		 
				$smsDataArr = smsData($conn);  /* text message and gateway array  */ 
				$smsDataCount = count($smsDataArr);
				
		 }catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		 }		

		 
		 
?>


		
		
				<!-- table -->
				<table  class='table table-hover style-table wizGradeTBPage'>
						<thead><tr>
                        <th class='text-left'>S/N</th> 
                        <th class='text-left'>GateWay</th> 
						<th class='text-left'>Sender Name</th> 
						<th class='text-left'>User Name</th> 
						<th class='text-left'>Password</th> 
						<th class='text-left'>Api</th> 
						<th class='text-left'>Balance</th> 
						<th class='text-left'>Status</th> 
						<th class='text-left'>Tasks</th>
                        </tr></thead> <tbody>


        <?php
						
						if($smsDataCount >= $fiVal){															
								
								for($i = $fiVal; $i <= $smsDataCount; $i++){	
								
									$sID = $smsDataArr[$i]["sID"];
									$user = $smsDataArr[$i]["user"];
									$gateway = $smsDataArr[$i]["gateway"];
									$senderID = $smsDataArr[$i]["senderID"];
									$password = htmlspecialchars_decode($smsDataArr[$i]["password"]);
									$api = $smsDataArr[$i]["api"];
									$status = $smsDataArr[$i]["status"];
									
									$sID = trim($sID);
									
									$status = $onOffArr[$status];								
															
									$serailNo++;
									
									
									$balanace = wizGradeSMSBalance($api, $user, $password, $sID);  /* check text message balance  */  
								

$smsData =<<<IGWEZE
        
									<tr id="row-$sID" >
									<td class='text-left' width="5%">$serailNo</td> 
									<td class='text-left' width="15%"> $gateway </td> 
									<td class='text-left' width="15%"> $senderID </td> 
									<td class='text-left' width="15%"> $user </td> 
									<td class='text-left' width="10%"> $password</td>
									<td class='text-left' width="15%"> $api  </td> 
									<td class='text-left' width="10%"> $balanace </td> 
									<td class='text-left' width="10%"> $status </td> 									
									
									<td  class='text-left' width="5%"> 
									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right">				
											
													<li>
														<a href='javascript:;' id='$sID' class ='viewSMS'>
														<button class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i></button> View</a>
													</li>
													<li class="divider"></li>						
													<li>					
													<a href='javascript:;' id='$sID' class ='editSMS'>
													<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
													</li>
											</ul>        
													
									</div><!-- /btn-group --> 
									
									</td>
									</tr>
		
IGWEZE;
                               
									echo $smsData; 

		                        }  
								
							} 
				
?>
                        
                        
                </tbody>
				</table>
				<!-- / table -->					