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
	This script load school route information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

         require 'configwizGrade.php';  /* load wizGrade configuration files */
		 
		 try {
		 
				$routeDataArr = wizGradeRouteData($conn);  /* school route array */
				$routeDataCount = count($routeDataArr);
				
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
                        <th class='text-left'>S/N</th> 
                        <th class='text-left'>Route</th> 
                        <th class='text-left'>Amount </th>
                        <th class='text-left'>Description</th>
						<th class='text-left'>Master/Mistress</th>
						<th class='text-left'>Tasks</th>
                        </tr></thead> <tbody> 

<?php
						
						if($routeDataCount >= $fiVal){  /* check array is empty */	 
								
							for($i = $fiVal; $i <= $routeDataCount; $i++){  /* loop array */	
							
								$hID = $routeDataArr[$i]["r_id"];
								$route = $routeDataArr[$i]["route"];
								$r_amout = $routeDataArr[$i]["r_amout"];
								$r_desc = $routeDataArr[$i]["r_desc"];
								$r_master = $routeDataArr[$i]["r_master"];
								
								$route = trim($route);
								$r_amout = trim($r_amout);
								$r_desc = trim($r_desc);
								$serailNo++;
								
								$staffInfo = staffData($conn, $r_master);
								list ($staff_title, $staff_fullname, $staff_sex, $staff_rankingVal, $staff_picture, 
								$staff_lname) = explode ("#@s@#", $staffInfo);
					
								$staff_titleV = $title_list[$staff_title];
								$staffName = $staff_titleV.' '.$staff_fullname; 
								

$routeData =<<<IGWEZE
        
								<tr id="row-$hID"><td width="3%">$serailNo</td> 
								<td class='text-left' width="18%"> $route </td>
								<td class='text-left' width="7%">   $r_amout</div> </td>
								<td class='text-left' width="40%">  $r_desc</div> </td>
								<td class='text-left' width="25%">  $staffName </div> </td>
								<td width="7%"> 
								
								<div class="btn-group">
									<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
									<i class="fa fa-wrench"></i> <span class="caret"></span></button>
										<ul role="menu" class="dropdown-menu pull-right">
												<li>  
												<a href='javascript:;' id='$hID' class ='editRoute'>
												<button class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
												</li>
												<li class="divider"></li>
												<li>
												<a href='javascript:;' id='wizGrade-$hID-$route' class ='removeRoute'> 
												<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button> Remove</a>			
												</li>
										</ul>  	
								</div><!-- /btn-group --> 
								
								</td>
								</tr>
		
IGWEZE;
                               
		                  		echo $routeData;
								$staffInfo = ""; 

		                    } 
								
						}
 
				
?>                      
                </tbody>
				</table>
				<!-- / table -->
						