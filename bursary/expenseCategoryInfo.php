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
	This script handle school expenses category information
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

         require 'configwizGrade.php';  /* load wizGrade configuration files */
		 
		 try {
		 
				$expenseCategoryDataArr = expenseCategoryData($conn);  /* school expenses category array */
				$expenseCategoryDataCount = count($expenseCategoryDataArr);
				
		 }catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		 }		

		 
?>

				<script type='text/javascript'> $('.paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ </script>
				<!-- table -->
				<table  class='table table-hover style-table wizGradeTBPage'>
				
						<thead><tr>
                        <th>S/N</th> 
                        <th class='text-left'>Expense Category</th> 
						<th class='text-left'>Tasks</th>
                        </tr></thead> <tbody>


        <?php
						
						if($expenseCategoryDataCount >= $fiVal){  /* check array is empty */
								
								for($i = $fiVal; $i <= $expenseCategoryDataCount; $i++){	/* start loop */
								
									$eID = $expenseCategoryDataArr[$i]["e_id"];
									$expenseCategory = $expenseCategoryDataArr[$i]["expense"];
									
									$expenseCategory = trim($expenseCategory);
									
									$serailNo++; 

$expenseCategoryData =<<<IGWEZE
        
									<tr id="row-$eID" ><td class='text-left' width="5%">$serailNo</td> 
									<td class='text-left' width="80%"> $expenseCategory </td>  
									
									<td  class='text-left' width="10%"> 
									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right">
													<li> 													
													<a href='javascript:;' id='$eID' class ='editExpenseCategory'>
													<button class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
													</li>
													<li class="divider"></li>
													<li>
													<a href='javascript:;' id='wizGrade-$eID-$expenseCategory' class ='removeExpenseCategory'> 
													<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button> Disenable</a>			
													</li>
											</ul>		
													
													
													
													
									</div><!-- /btn-group -->
									
									
									</td>
									</tr>
		
IGWEZE;
                               
									echo $expenseCategoryData;
								
								

		                        }  /* end loop */ 
								
								
						} 
				
          ?>
                        
                        
                </tbody>
				
				</table>
				
				<!-- / table -->
						