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
	This script handle teachers remarks
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('fobrain', 'igweze');  /* define a check for wrong access of file */

			require 'configINwizGrade.php';  /* load wizGrade configuration files */ 
		 
			try {
		 

  				$remarkArray = teacherRemarksArrays($conn);  /* teacher remarks array */ 
				
				$remarkCount = count($remarkArray);
				if($remarkCount == 30){ $moreRemark = ''; }
				if($remarkCount < 30){ $moreRemark = (30 - $remarkCount); }
				
				
			}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			} 
		
?>		

				<!-- row -->	
				<div class="row">					
                    <div class="col-lg-10">
						<section class="panel">
							<header class="panel-heading">
                              <i class="fa fa-wrench fa-lg"></i> Teacher Remark <span class="hide-res">Manager</span>
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line">
							<center><img src="loading.gif" alt="Loading >>>>>" class="configLoading" 
							style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>  <!-- loading image -->
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
 
							<thead><tr><th class='text-left'>S/N</th> 
							<th class='text-left'>Teacher's Remarks</th>
							<th class='text-left'>Tasks</th></tr></thead> 
							<tbody>

<?php

							if($remarkCount > $fiVal){  /* check array is empty */		
								
								for($i = $fiVal; $i <= $remarkCount; $i++){  /* loop array */	
								
									$remarksTeacher = $remarkArray[$i]["name"];
									$remarksID = $remarkArray[$i]["id"];
									$serial_no = $foreal++;	
									$remarkUpdate = 'Update-'.$remarksID;
									$remarkEdit = 'Edit-'.$remarksID;
									$remarkRemove = 'Remove-'.$remarksID;
									$remarkEditDiv = 'editDiv-'.$remarksID;
									$remarkRow = 'DivRow-'.$remarksID;
									$frmLoader= 'frmloader-'.$remarksID;
									$msgBox = 'msgBoxDiv-'.$remarksID;
								

$remark =<<<IGWEZE
        
									<tr id='$remarkRow'><td class='text-left'>$serial_no  </td> 
									<td class='text-left'> 
									<center><img src="loading.gif" alt="Loading >>>>>" id="$frmLoader" 
																  style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>
									<div id='$msgBox'>	</div>						  
									<div id='$remarkEditDiv'><i class="fa fa-user"></i>
									$remarksTeacher </div> </td>
									
									<td class='text-left'> 
									
									<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle btn-xs" type="button">
										<i class="fa fa-bars"></i> <span class="caret"></span></button>
												<ul role="menu" class="dropdown-menu pull-right">
												<li>
												<a href='javascript:;' id='$remarkUpdate' class ='remarkUpdate' style="display:none;">
												<button class="btn btn-success btn-xs">
												<i class="fa fa-save"></i></button> Update </a>
												</li>
												
												<li>
												<a href='javascript:;' id='$remarkEdit' class ='remarkEdit'> <button class="btn btn-primary btn-xs">
												<i class="fa fa-edit"></i></button> Edit </a>					
												</li>
												<li class="divider"></li>
												<li>
												<a href='javascript:;' id='$remarkRemove' class ='demoDisenable remarkRemove'> <button class="btn btn-danger btn-xs">
												<i class="fa fa-times"></i></button> Delete </a>						
												</li>
												</ul>	 
									</div><!-- /btn-group -->
									
									</td> 
									</tr>
		
IGWEZE;
                               
		                  		echo $remark;

		                        }
							}



							if($remarkCount != $i_false){  /* check if count is false */		
								
								for($i = $fiVal; $i <= $moreRemark; $i++){  /* loop array */	 
						
									$serial_no = $foreal++;	
									$remarkSave = 'Save-'.$serial_no;
									$remarkEdit = 'Edit-'.$serial_no;
									$remarkUpdate = 'Update-'.$serial_no;
									$remarkRemove = 'Remove-'.$serial_no;
									$remarkEditDiv = 'editDiv-'.$serial_no;
									$remarkRow = 'DivRow-'.$serial_no;
									$frmRemark= 'frmRemark-'.$serial_no;
									$frmLoader= 'frmloader-'.$serial_no;
									$msgBox = 'msgBoxDiv-'.$serial_no; 

$remarkMore =<<<IGWEZE
        
									<tr id='$remarkRow'><td class='text-left'>$serial_no  </td> <td class='text-left'> 
									<center><img src="loading.gif" alt="Loading >>>>>" id="$frmLoader" 
									style="cursor:pointer; display:none; margin-bottom:5px;" /> </center>	<!-- loading image -->				  
									<div id='$msgBox'>	</div>						  
									<div id='$remarkEditDiv'> <div class="iconic-input">
									  <i class="fa fa-user"></i>
									  <input type="text" class="form-control" id="$frmRemark" 
									  name="$frmRemark" />
									  </div>
									  </div> </td>
									<td class='text-left'> 
									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right">
												<li>
												<a href='javascript:;' id='$remarkUpdate' class ='remarkUpdate' style="display:none;">
												<button class="btn btn-success btn-xs">
												<i class="fa fa-save"></i></button> Update </a>
												</li>
												
												<li>
												<a href='javascript:;' id='$remarkSave' class ='remarkSave'>
												<button class="btn btn-success btn-xs">
												<i class="fa fa-save"></i></button> Save </a>
												</li>
												
												<li>
												<a href='javascript:;' id='$remarkEdit' class ='remarkEdit' style="display:none;"> <button class="btn btn-primary btn-xs">
												<i class="fa fa-edit"></i></button> Edit </a>					
												</li>
												<li class="divider"></li>
												<li>
												<a href='javascript:;' id='$remarkRemove' class ='remarkRemove' style="display:none;"> <button class="btn btn-danger btn-xs">
												<i class="fa fa-times"></i></button> Delete </a>						
												</li>
											</ul>		 
									</div><!-- /btn-group -->
									
									</td> 
											
									</tr>
		
IGWEZE;
                               
									echo $remarkMore;

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