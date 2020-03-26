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
	This script handle school fees category information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configwizGrade.php';  /* load wizGrade configuration files */
		 
		 try {
		 
				$feeCategoryDataArr = feeCategoryData($conn);  /* school fee category array */
				$feeCategoryDataCount = count($feeCategoryDataArr);
				
		 }catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		 }		

		 
?> 
			
				<script type='text/javascript'> $('.paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ </script>
				<!-- table -->
				<table  class='table table-hover style-table wizGradeTBPage'>
						<thead><tr>
                        <th>S/N</th> 
                        <th class='text-left'>Fee Category</th> 
                        <th class='text-left'>Amount</th>
                        <th class='text-left'>Status</th>
						<th class='text-left'>Tasks</th>
                        </tr></thead> <tbody>


        <?php
						
						if($feeCategoryDataCount >= $fiVal){  /* check array is empty */		
						
								
								
								for($i = $fiVal; $i <= $feeCategoryDataCount; $i++){	
								
									$fID = $feeCategoryDataArr[$i]["f_id"];
									$feeCategory = $feeCategoryDataArr[$i]["fee"];
									$amount = $feeCategoryDataArr[$i]["amount"];
									$status = $feeCategoryDataArr[$i]["status"];
									
									$feeCategory = trim($feeCategory);
									$amount = trim($amount);
									$status = trim($status);
									$status = $onOffArr[$status];
									$serailNo++;
								
							
								
								

$feeCategoryData =<<<IGWEZE
        
									<tr id="row-$fID" ><td class='text-left' width="5%">$serailNo</td> 
										<td class='text-left' width="50%"> $feeCategory </td> 
										
										<td class='text-left' width="20%">   $amount</div> </td>
										
										<td class='text-left' width="15%">  $status</div> </td>
										
										
										<td  class='text-left' width="10%"> 
										
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
											<i class="fa fa-wrench"></i> <span class="caret"></span></button>
												<ul role="menu" class="dropdown-menu pull-right">
														<li>
														
														
														<a href='javascript:;' id='$fID' class ='editFeeCategory'>
														<button class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
														</li>
														<li class="divider"></li>
														<li>
														<a href='javascript:;' id='wizGrade-$fID-$feeCategory' class ='removeFeeCategory'> 
														<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button> Disenable</a>			
														</li>
												</u>		
														
														
														
														
										</div><!-- /btn-group --> 
										</td>
									</tr>
		
IGWEZE;
                               
									echo $feeCategoryData; 

		                        } 
								
						}
				
          ?>
                        
                        
                    </tbody>
				</table>
				
				<!-- / table -->
						