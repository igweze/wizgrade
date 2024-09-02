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
	This script handle school grades information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'configINwizGrade.php';  /* load wizGrade configuration files */	  
		 
					try {
				 
						$gradeDataArr = gradeData($conn);  /* school grade array */ 
						$gradeDataCount = count($gradeDataArr);
						
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
						<th class='text-left'>Score From</th> 						 
						<th class='text-left'>Score To</th> 
						<th class='text-left'>Score Grades</th>
						<th class='text-left'>Tasks</th>
                        </tr></thead> <tbody>


<?php
						
							if($gradeDataCount >= $fiVal){  /* check array is empty */		
														
								
								for($i = $fiVal; $i <= $gradeDataCount; $i++){  /* loop array */	
									
									$gID = $gradeDataArr[$i]["gID"]; 
									$fromGrade = $gradeDataArr[$i]["fromGrade"];
									$toGrade = $gradeDataArr[$i]["toGrade"]; 
									$grade = $gradeDataArr[$i]["grade"]; 
									
									$gID = trim($gID);  
									
									$serailNo++;
								

$gradeData =<<<IGWEZE
        
									<tr id="row-$gID" >
									<td class='text-left' width="5%">$serailNo</td>  
									<td class='text-left' width="29%"> <b>$fromGrade</b>  </td>  
									<td class='text-left' width="29%"> <b>$toGrade</b>  </td>  
									<td class='text-left' width="29%"> <b>$grade</b> </td>  
									<td  class='text-left' width="8%"> 
									
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle btn-xs" type="button">
										<i class="fa fa-bars"></i> <span class="caret"></span></button>
												<ul role="menu" class="dropdown-menu pull-right"> 					
														<li>
															<a href='javascript:;' id='$gID' class ='viewGrade'>
															<button class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i></button> View</a>
														</li>
														<li class="divider"></li>						
														<li>					
														<a href='javascript:;' id='$gID' class ='editGrade'>
														<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
														</li>
														<li class="divider"></li>
														<li>
														<a href='javascript:;' id='wizGrade-$gID-$grade' class ='demoDisenable removeGrade'> 
														<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button> Remove</a>			
														</li>
												</ul>		 
														
										</div><!-- /btn-group -->
									
									
									</td>
									</tr>
		
IGWEZE;
                               
		                  		echo $gradeData;
								
								

		                        } 
								
							}
 
				
?>
                        
                        
                        </tbody>
				</table>
				<!-- / table --> 