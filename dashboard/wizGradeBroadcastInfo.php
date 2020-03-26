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
	This script handle school broadcasts information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configINwizGrade.php';  /* load wizGrade configuration files */	  
		 
					try {
				 
						$broadcastDataArr = broadcastData($conn);  /* school annoucement/broadcast array */ 
						$broadcastDataCount = count($broadcastDataArr);
						
					}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
					}	
						
?>

  
				<script type='text/javascript'> 
				
						$('.wizGradeTable').DataTable( {
					
							dom: 'lBfrtip', 
							"scrollX": true,							 
							buttons: [
								
								{ "extend": 'excel', "text":'<i class="fa fa-file-excel-o fa-lg"></i> Excel', "className": 'btn btn-danger btn-datable' },	
								{ "extend": 'pdf', "text":'<i class="fa fa-file-pdf-o fa-lg"></i> PDF', "className": 'btn btn-danger btn-datable' },
								{ "extend": 'print', "text":'<i class="fa fa-print fa-lg"></i> Print', "className": 'btn btn-danger btn-datable' },
								{ "extend": 'colvis', "text":'<i class="fa fa-toggle-on fa-lg"></i> Col. Toggle', "className": 'btn btn-danger btn-datable' }							
								 
							]
						} );
						
				</script>  			
				
				<!-- table -->
				<table  class='table table-hover style-table wizGradeTable' width='100%'>
						<thead><tr>
                        <th>S/N</th>                         
						<th class='text-left'>Title</th> 						 
						<th class='text-left'>Date</th> 
						<th class='text-left'>Tasks</th>
                        </tr></thead> <tbody>


<?php
						
							if($broadcastDataCount >= $fiVal){  /* check array is empty */		
														
								
								for($i = $fiVal; $i <= $broadcastDataCount; $i++){  /* loop array */	
									
									$bID = $broadcastDataArr[$i]["bID"]; 
									$bTitle = $broadcastDataArr[$i]["bTitle"];
									$broadcastMsg = $broadcastDataArr[$i]["broadcastMsg"]; 
									$date = $broadcastDataArr[$i]["date"]; 
									 
									$bID = trim($bID); 
									
									$date = date("j M Y", strtotime($date)); 
									
									$serailNo++;
								

$broadcastData =<<<IGWEZE
        
									<tr id="row-$bID" >
									<td class='text-left' width="5%">$serailNo</td>  
									<td class='text-left' width="70%"> $bTitle  </td>  
									<td class='text-left' width="15%"> $date </td>  
									<td  class='text-left' width="10%"> 
									
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
											<i class="fa fa-wrench"></i> <span class="caret"></span></button>
												<ul role="menu" class="dropdown-menu pull-right"> 					
														<li>
															<a href='javascript:;' id='$bID' class ='viewBroadcast'>
															<button class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i></button> View</a>
														</li>
														<li class="divider"></li>						
														<li>					
														<a href='javascript:;' id='$bID' class ='editBroadcast'>
														<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
														</li>
														<li class="divider"></li>
														<li>
														<a href='javascript:;' id='wizGrade-$bID-$expenseCategory' class ='removeBroadcast'> 
														<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button> Remove</a>			
														</li>
												</ul>		 
														
										</div><!-- /btn-group -->
									
									
									</td>
									</tr>
		
IGWEZE;
                               
		                  		echo $broadcastData;
								
								

		                        } 
								
							}
 
				
?>
                        
                        
                        </tbody>
				</table>
				<!-- / table -->
						