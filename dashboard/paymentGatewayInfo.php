<?php

/*   
	Copyright (C) fobrain Tech LTD (2014 - 2024) - All Rights Reserved
	
	Licensed under the Apache License, Version 2.0 (the 'License');
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an 'AS IS' BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License	
	 
	#####################################################################################################
	fobrain (wizgrade open source) app is designed & developed by Igweze Ebele Mark for fobrain Tech LTD
	#####################################################################################################

	fobrain is Dedicated To Almighty God, My fabulous FAMILY and Amazing Parents.  
	
	WEBSITE 							PHONES/WHATSAPP					EMAILS
	https://www.fobrain.com				+234 - 80 30 716 751  			opensource@fobrain.com
										+234 - 80 22 000 490 	
	
	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Page/Code Explanation~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	This script handle payment gateway information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

         require 'configINwizGrade.php';  /* load wizGrade configuration files */
		 
		 try {
		 
				$gatewayPaymentDataArr = gatewayPaymentData($conn);  /* payment gateways array  */
				$gatewayPaymentDataCount = count($gatewayPaymentDataArr);
				
		 }catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		 }		

		 
		 
?>


		
		
				<!-- table -->
				<table  class='table table-hover style-table wizGradeTBPage'>
						<thead><tr>
                        <th class='text-left'>S/N</th> 
                        <th class='text-left'>Payment Gateway</th> 
						<th class='text-left'>User ID</th>  
						<th class='text-left'>Tasks</th>
                        </tr></thead> <tbody>


        <?php
						
						if($gatewayPaymentDataCount >= $fiVal){  /* check array is empty */															
								
								for($i = $fiVal; $i <= $gatewayPaymentDataCount; $i++){  /* loop array */	
								
									$gID = $gatewayPaymentDataArr[$i]["gID"]; 
									$gateway = $gatewayPaymentDataArr[$i]["gateway"];
									$gateKey = $gatewayPaymentDataArr[$i]["gateKey"]; 
									
									$gID = trim($gID); 	
									$serailNo++; 

$gatewayPaymentData =<<<IGWEZE
        
									<tr id="row-$gID" >
									<td class='text-left' width="10%">$serailNo</td> 
									<td class='text-left' width="20%"> $gateway </td> 
									<td class='text-left' width="60%"> $gateKey </td>
									<td  class='text-left' width="10%">									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right">	 
													<li>
														<a href='javascript:;' id='$gID' class ='viewPayGateway'>
														<button class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i></button> View</a>
													</li>
													<li class="divider"></li>						
													<li>					
													<a href='javascript:;' id='$gID' class ='editPayGateway'>
													<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
													</li> 
											</ul>		
									</div><!-- /btn-group -->
									</td>
									</tr>
		
IGWEZE;
                               
									echo $gatewayPaymentData;  

		                        } 
								
						} 
				
?>
                        
                        
                    </tbody>
					</table>
					<!-- / table -->
						