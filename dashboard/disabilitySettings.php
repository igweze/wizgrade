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
	This script handle disability configuration
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configINwizGrade.php';  /* load wizGrade configuration files */
		 		 
		 
		 try {
		 

  				$disabilityArray = disabilityArrays($conn);  /* disability array  */
				
				$disabilityCount = count($disabilityArray);
				if($disabilityCount == 30){ $moreDisability = ''; }
				if($disabilityCount < 30){ $moreDisability = (30 - $disabilityCount); }
				
				
		 }catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		 }
		
		
		
?>		
					
				<!-- row -->	
				<div class="row"> 
					<div class="col-lg-9">
                      <section class="panel">
                          <header class="panel-heading">                              
							  <i class="fa fa-wrench fa-lg"></i> Disability <span class="hide-res">Configuration</span>
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
                          <div class="panel-body wizGrade-line">
                          <center><img src="loading.gif" alt="Loading >>>>>" class="configLoading" 
									  style="cursor:pointer; display:none; margin-bottom:5px;" /> </center><!-- loading image-->
                          <div class="msgBoxSettings paginateSim"></div>
                             		
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
						<thead><tr><th class='text-left'>S/N</th> <th class='text-left'>Disability Lists</th>
						<th class='text-left'>Tasks</th></tr></thead> <tbody>

        <?php

						if($disabilityCount > $fiVal){  /* check array is empty */		
								
								for($i = $fiVal; $i <= $disabilityCount; $i++){  /* loop array */	
								
									$DisabilityTeacher = $disabilityArray[$i]["name"];
									$DisabilityID = $disabilityArray[$i]["id"];
									$serial_no = $foreal++;	
									$disabilityUpdate = 'Update-'.$DisabilityID;
									$disabilityEdit = 'Edit-'.$DisabilityID;
									$disabilityRemove = 'Remove-'.$DisabilityID;
									$disabilityEditDiv = 'editDiv-'.$DisabilityID;
									$disabilityRow = 'DivRow-'.$DisabilityID;
									$frmLoader= 'frmloader-'.$DisabilityID;
									$msgBox = 'msgBoxDiv-'.$DisabilityID;
								

$disability =<<<IGWEZE
        
									<tr id='$disabilityRow'><td class='text-left'>$serial_no  </td> <td class='text-left'> 
									<center><img src="loading.gif" alt="Loading >>>>>" id="$frmLoader" 
																  style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>
									<div id='$msgBox'>	</div>						  
									<div id='$disabilityEditDiv'><i class="fa fa-medkit"></i>
									$DisabilityTeacher </div> </td>
									
									<td class='text-left'> 
									
									<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
											<i class="fa fa-wrench"></i> <span class="caret"></span></button>
												<ul role="menu" class="dropdown-menu pull-right">
														<li>
														<a href='javascript:;' id='$disabilityUpdate' class ='disabilityUpdate' style="display:none;">
														<button class="btn btn-success btn-xs">
														<i class="fa fa-save"></i></button> Update </a>
														</li>
														
														<li>
														<a href='javascript:;' id='$disabilityEdit' class ='disabilityEdit'> <button 
														class="btn btn-primary btn-xs">
														<i class="fa fa-edit"></i></button> Edit </a>					
														</li>
														<li class="divider"></li>
														<li>
														<a href='javascript:;' id='$disabilityRemove' class ='demoDisenable disabilityRemove'> 
														<button class="btn btn-danger btn-xs">
														<i class="fa fa-times"></i></button> Delete </a>						
														</li>
														
												</ul>		
														
									</div><!-- /btn-group -->
									
									</td> 
									</tr>
		
IGWEZE;
                               
		                  		echo $disability;

		                        }
						}



				if($disabilityCount != $i_false){  /* check array is empty */		
								
								for($i = $fiVal; $i <= $moreDisability; $i++){  /* loop array */	
								
						
									$serial_no = $foreal++;	
									$disabilitySave = 'Save-'.$serial_no;
									$disabilityEdit = 'Edit-'.$serial_no;
									$disabilityUpdate = 'Update-'.$serial_no;
									$disabilityRemove = 'Remove-'.$serial_no;
									$disabilityEditDiv = 'editDiv-'.$serial_no;
									$disabilityRow = 'DivRow-'.$serial_no;
									$frmDisability= 'frmDisability-'.$serial_no;
									$frmLoader= 'frmloader-'.$serial_no;
									$msgBox = 'msgBoxDiv-'.$serial_no;
								

$disabilityMore =<<<IGWEZE
        
									<tr id='$disabilityRow'><td class='text-left'>$serial_no  </td> <td class='text-left'> 
									<center><img src="loading.gif" alt="Loading >>>>>" id="$frmLoader" 
																  style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>					  
									<div id='$msgBox'>	</div>						  
									<div id='$disabilityEditDiv'> <div class="iconic-input">
																		  <i class="fa fa-medkit"></i>
																		  <input type="text" class="form-control" id="$frmDisability" 
																		  name="$frmDisability" />
																		  </div>
																		  </div> </td>
									<td class='text-left'> 
									
									
									<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
											<i class="fa fa-wrench"></i> <span class="caret"></span></button>
												<ul role="menu" class="dropdown-menu pull-right">
														<li>
														<a href='javascript:;' id='$disabilityUpdate' class ='disabilityUpdate' style="display:none;">
														<button class="btn btn-success btn-xs">
														<i class="fa fa-save"></i></button> Update </a>
														</li>
														
														<li>
														<a href='javascript:;' id='$disabilitySave' class ='disabilitySave'>
														<button class="btn btn-success btn-xs">
														<i class="fa fa-save"></i></button> Save </a>
														</li>
														
														<li>
														<a href='javascript:;' id='$disabilityEdit' class ='disabilityEdit' 
														style="display:none;"> <button class="btn btn-primary btn-xs">
														<i class="fa fa-edit"></i></button> Edit </a>					
														</li>
														<li class="divider"></li>
														<li>
														<a href='javascript:;' id='$disabilityRemove' class ='disabilityRemove' 
														style="display:none;"> <button class="btn btn-danger btn-xs">
														<i class="fa fa-times"></i></button> Delete </a>						
														</li>
												</ul>		
														
														
									</div><!-- /btn-group -->
									
									</td> 
											
									</tr>
		
IGWEZE;
                               
		                  		echo $disabilityMore;

		                        }
						}
          ?>
                        
                        </tbody>
						</table>
						<!-- / table -->
                                    
                                    
                                      
                          </div>
                      </section>
					</div>
				</div>
				<!-- / row -->		 