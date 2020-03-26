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
	This script handle school hostel information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

		define('wizGrade', 'igweze');  /* define a check for wrong access of file */

			require 'configwizGrade.php';  /* load wizGrade configuration files */
		 
			try {
		 
				$hostelDataArr = wizGradeHostelData($conn);  /* school hostel array  */
				$hostelDataCount = count($hostelDataArr);
				
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
                        <th class='text-left'>Hostel</th> 
                        <th class='text-left'>Limit </th>
                        <th class='text-left'>Description</th>
						<th class='text-left'>Master/Mistress</th>
						<th class='text-left'>Tasks</th>
                        </tr></thead> <tbody>


        <?php
						
						if($hostelDataCount >= $fiVal){  /* check array is empty */	 
								
							for($i = $fiVal; $i <= $hostelDataCount; $i++){  /* loop array */	
							
								$hID = $hostelDataArr[$i]["h_id"];
								$hostel = $hostelDataArr[$i]["hostel"];
								$h_limit = $hostelDataArr[$i]["h_limit"];
								$h_desc = $hostelDataArr[$i]["h_desc"];
								$h_master = $hostelDataArr[$i]["h_master"];
								
								$hostel = trim($hostel);
								$h_limit = trim($h_limit);
								$h_desc = trim($h_desc);
								$serailNo++;
								
								$staffInfo = staffData($conn, $h_master);  /* school staffs/teachers information */
								list ($staff_title, $staff_fullname, $staff_sex, $staff_rankingVal, $staff_picture, 
								$staff_lname) = explode ("#@s@#", $staffInfo);
					
								$staff_titleV = $title_list[$staff_title];
								$staffName = $staff_titleV.' '.$staff_fullname;
							
								
								

$hostelData =<<<IGWEZE
        
								<tr id="row-$hID"><td width="3%">$serailNo</td> 
								<td class='text-left' width="18%"> $hostel </td>								
								<td class='text-left' width="7%">   $h_limit</div> </td>								
								<td class='text-left' width="40%">  $h_desc</div> </td>								
								<td class='text-left' width="25%">  $staffName </div> </td>								
								<td width="7%"> 								
								<div class="btn-group">
									<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
									<i class="fa fa-wrench"></i> <span class="caret"></span></button>
										<ul role="menu" class="dropdown-menu pull-right">
												<li> 
												
												<a href='javascript:;' id='$hID' class ='editHostel'>
												<button class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
												</li>
												<li class="divider"></li>
												<li>
												<a href='javascript:;' id='wizGrade-$hID-$hostel' class ='removeHostel'> 
												<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button> Remove</a>			
												</li> 
										</ul>	
								</div><!-- /btn-group -->
								</td>
								</tr>
		
IGWEZE;
                               
									echo $hostelData;
									$staffInfo = ""; 

		                        } 
								
						} 
				
?>
                           
                    </tbody>
				</table>
				<!-- / table -->
						