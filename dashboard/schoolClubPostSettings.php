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
	This script handle school club position
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

			require 'configINwizGrade.php';  /* load wizGrade configuration files */
		 		 
		 
			try {
		 

  				$clubPostArray = clubPostArrays($conn);  /* school clubs position array */
				
				$clubPostCount = count($clubPostArray);
				if($clubPostCount == 30){ $moreClubPost = ''; }
				if($clubPostCount < 30){ $moreClubPost = (30 - $clubPostCount); }
				
				
			}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}
		
		
		
?>		
				<!-- row -->	
				<div class="row"> 					
                   <div class="col-lg-7">
                      <section class="panel">
							<header class="panel-heading">
                              
							  <i class="fa fa-wrench fa-lg"></i> <span class="hide-res">School</span>  Club Post
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
							<thead><tr><th class='text-left'>S/N</th>
							<th class='text-left'>Student's Organization Post</th><th class='text-left'>Tasks</th></tr></thead> <tbody>

        <?php

							if($clubPostCount > $fiVal){  /* check array is empty */		
								
								for($i = $fiVal; $i <= $clubPostCount; $i++){  /* loop array */	
								
									$ClubPostsTeacher = $clubPostArray[$i]["name"];
									$ClubPostsID = $clubPostArray[$i]["id"];
									$serial_no = $foreal++;	
									$clubPostUpdate = 'Update-'.$ClubPostsID;
									$clubpostEdit = 'Edit-'.$ClubPostsID;
									$clubPostRemove = 'Remove-'.$ClubPostsID;
									$clubpostEditDiv = 'editDiv-'.$ClubPostsID;
									$clubPostRow = 'DivRow-'.$ClubPostsID;
									$frmLoader= 'frmloader-'.$ClubPostsID;
									$msgBox = 'msgBoxDiv-'.$ClubPostsID;
									

$clubPost =<<<IGWEZE
        
									<tr id='$clubPostRow'><td class='text-left'>$serial_no  </td> <td class='text-left'> 
									<center><img src="loading.gif" alt="Loading >>>>>" id="$frmLoader" 
									style="cursor:pointer; display:none; margin-bottom:5px;" /> </center><!-- loading image-->
									<div id='$msgBox'>	</div>						  
									<div id='$clubpostEditDiv'><i class="fa fa-users"></i>
									$ClubPostsTeacher </div> </td>
									
									<td class='text-left'> 
									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right">
												<li>
												<a href='javascript:;' id='$clubPostUpdate' class ='clubPostUpdate' style="display:none;">
												<button class="btn btn-success btn-xs">
												<i class="fa fa-save"></i></button> Update </a>
												</li>
												
												<li>
												<a href='javascript:;' id='$clubpostEdit' class ='clubpostEdit'> <button class="btn btn-primary btn-xs">
												<i class="fa fa-edit"></i></button> Edit </a>					
												</li>
												<li class="divider"></li>
												<li>
												<a href='javascript:;' id='$clubPostRemove' class ='clubPostRemove demoDisenable'> <button class="btn btn-danger btn-xs">
												<i class="fa fa-times"></i></button> Delete </a>						
												</li> 
											</ul>		
														
									</div><!-- /btn-group -->
									
									</td> 
									</tr>
		
IGWEZE;
                               
									echo $clubPost;

		                        }
							} 

							if($clubPostCount != $i_false){  /* is count false */		
								
								for($i = $fiVal; $i <= $moreClubPost; $i++){  /* loop array */	
								
						
									$serial_no = $foreal++;	
									$clubPostSave = 'Save-'.$serial_no;
									$clubpostEdit = 'Edit-'.$serial_no;
									$clubPostUpdate = 'Update-'.$serial_no;
									$clubPostRemove = 'Remove-'.$serial_no;
									$clubpostEditDiv = 'editDiv-'.$serial_no;
									$clubPostRow = 'DivRow-'.$serial_no;
									$frmClubPost= 'frmClubPost-'.$serial_no;
									$frmLoader= 'frmloader-'.$serial_no;
									$msgBox = 'msgBoxDiv-'.$serial_no;
								

$clubPostMore =<<<IGWEZE
        
									<tr id='$clubPostRow'><td class='text-left'>$serial_no  </td> <td class='text-left'> 
									<center><img src="loading.gif" alt="Loading >>>>>" id="$frmLoader" 
									style="cursor:pointer; display:none; margin-bottom:5px;" /> </center><!-- loading image-->					  
									<div id='$msgBox'>	</div>						  
									<div id='$clubpostEditDiv'> <div class="iconic-input">
									  <i class="fa fa-users"></i>
									  <input type="text" class="form-control" id="$frmClubPost" 
									  name="$frmClubPost" />
									  </div>
									</div> </td>
									<td class='text-left'> 
									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right">
												<li>
												<a href='javascript:;' id='$clubPostUpdate' class ='clubPostUpdate' style="display:none;">
												<button class="btn btn-success btn-xs">
												<i class="fa fa-save"></i></button> Update </a>
												</li>
												
												<li>
												<a href='javascript:;' id='$clubPostSave' class ='clubPostSave'>
												<button class="btn btn-success btn-xs">
												<i class="fa fa-save"></i></button> Save </a>
												</li>
												
												<li>
												<a href='javascript:;' id='$clubpostEdit' class ='clubpostEdit' style="display:none;"> 
												<button class="btn btn-primary btn-xs">
												<i class="fa fa-edit"></i></button> Edit </a>					
												</li>
												<li class="divider"></li>
												<li>
												<a href='javascript:;' id='$clubPostRemove' class ='clubPostRemove' style="display:none;"> 
												<button class="btn btn-danger btn-xs">
												<i class="fa fa-times"></i></button> Delete </a>						
												</li>
											</ul>	 
														
									</div><!-- /btn-group -->
									
									
									</td> 
											
									</tr>
		
IGWEZE;
                               
		                  		echo $clubPostMore;

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