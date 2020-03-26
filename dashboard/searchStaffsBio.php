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
	This script handle search staff profile
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

            define('wizGrade', 'igweze');  /* define a check for wrong access of file */

           require 'configINwizGrade.php';  /* load wizGrade configuration files */ 
			
?>
 
                  
		<!-- row -->
		<div class="row">
            <div class="col-lg-5">
                    <section class="panel">
						<header class="panel-heading">                              
							  <i class="fa fa-search-plus fa-lg"></i> Staff Profile  
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                        </header>
                        <div class="panel-body wizGrade-line">

<?php
 
						echo "<script type='text/javascript'> $('#paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ </script>";
		 
$table_head =<<<IGWEZE
        
						<!-- table -->
						<table  class='table table-hover style-table' id='wizGradeTBPage'>
						<thead><tr><th>S/N</th> <th>Staff Name</th> <th>Tasks</th></tr></thead> <tbody>
		
IGWEZE;

		 
				echo $table_head;
		 
				if($_REQUEST['searchData'] == 'searchStaffBio'){ /* search staff profile */
					
					try {
						
						/* script validation */
						
						if ($_REQUEST['queryWord'] == '') {
						
							$msg =  $formErrorMsg;								
							echo $errorMsg.$msg.$eEnd; 
							echo $scrollUp; exit; 			
						
						}else{ /* search staff profile */
					 
							$queryWord = $_REQUEST['queryWord'];	 $queryWord_S = $queryWord;	
							$queryWord = preg_replace("/[^A-Za-z0-9 ]/", " ", $queryWord); 
					 

							$ebele_mark = "SELECT t_id, i_title, i_picture, i_firstname, i_lastname, i_midname, rank, t_grade
							
											FROM $staffTB

											WHERE 	status = :status
											
											AND i_firstname LIKE :i_firstname
								 
											OR  i_lastname LIKE :i_lastname
								 
											OR  i_midname LIKE :i_midname";
								 
							$igweze_prep = $conn->prepare($ebele_mark);				
							$igweze_prep->bindValue(':status', $fiVal);
							$igweze_prep->bindValue(':i_firstname', '%'.$queryWord.'%');
							$igweze_prep->bindValue(':i_lastname', '%'.$queryWord.'%');
							$igweze_prep->bindValue(':i_midname', '%'.$queryWord.'%');
							$igweze_prep->execute();
							
							$rows_count = $igweze_prep->rowCount(); 
							
							if($rows_count >= $foreal) { /* check array is empty */ 
							
								while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
				   
									$t_id = $row['t_id'];
									$title = $row['i_title'];
									$pic = $row['i_picture'];
									$fname = $row['i_firstname'];
									$lname = $row['i_lastname'];
									$mname = $row['i_midname'];
									$ranking = $row['rank'];
									$t_grade = $row['t_grade'];
									
									$titleVal = $title_list[$title];
									
									$serial_no = $foreal++;										
													
									$teacherPic = $staffPicExt.$pic;

									if ((is_null($pic)) || !file_exists($teacherPic)){ $teacherPic = $wizGradeDefaultPic; }  /* check if picture exists */
									
									
									
									$showPassDiv ="<li class='divider'></li>
										<li>
										<a href='javascript:;' id='$t_id'  class ='resetStaff'> <button class='btn btn-danger btn-xs'>
										<i class='fa fa-key'></i></button> Reset/Remove</a>		
										</li>";

									$stringReplace = explode(' ', $queryWord);
									
									$replaceString = array_map('wizGradeHighlight', $stringReplace);
									
									$regNumRep = str_ireplace($stringReplace, $replaceString, $regNum);
									$lnameRep = str_ireplace($stringReplace, $replaceString, $lname);
									$fnameRep = str_ireplace($stringReplace, $replaceString, $fname);
									$mnameRep = str_ireplace($stringReplace, $replaceString, $mname);
									

									if(($admin_grade == $adminGrade) && ($admin_level == $adminGradeInt)) {  /* check if school admin */	
					
$table_ed =<<<IGWEZE
			
										<tr  id='staff-row-$t_id'>
										
										<td width='10%'>$serial_no</td>
										
										<td class='text-left' width='90%'>
										
										<a href='javascript:;' id='$t_id' class ='viewHStaff'> <img src = '$teacherPic' height = '40' 
										width = '40' class='small-picture'> 
										$titleVal $lnameRep $fnameRep $mnameRep  </a> </td>
											
										<td width='10%'>   		
										
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
											<i class="fa fa-wrench"></i> <span class="caret"></span></button>
												<ul role="menu" class="dropdown-menu pull-right">
														<li>
														<a href='javascript:;' id='$t_id' class ='viewHStaff'><button class="btn btn-success btn-xs">
														<i class="fa fa-search-plus"></i></button> View</a>
														</li>
														
														<li class="divider"></li>
														<li>
														<a href='javascript:;' id='$t_id' class ='editStaff'> 
														<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
														</li>
														
														$showPassDiv
														
												</ul>		
														
														
										</div><!-- /btn-group -->
										
										</td> </tr>
		
IGWEZE;
										echo $table_ed;
		
									}else{  /* check if school staff */
					
$table_ad =<<<IGWEZE
			
										<td width='10%'>$serial_no</td>
										
										<td class='text-left' width='90%'>
										
										<a href='javascript:;' id='$t_id' class ='viewHStaff'> <img src = '$teacherPic' height = '40' 
										width = '40' class='small-picture'> 
										$titleVal $lnameRep $fnameRep $mnameRep  </a> </td>
											
										<td width='10%'>   
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
											<i class="fa fa-wrench"></i> <span class="caret"></span></button>
												<ul role="menu" class="dropdown-menu pull-right">
														<li>
														<a href='javascript:;' id='$t_id' class ='viewHStaff'><button class="btn btn-success btn-xs">
														<i class="fa fa-search-plus"></i></button> View</a>
														</li> 				
												</ul>		
														
										</div><!-- /btn-group -->
										
										</td> </tr>
		
IGWEZE;
										echo $table_ad; 
					
					
									} 
			
								}
			
							}else{  /* display error */
						
								$msg_e =  "Oooooops error, Staff record with <span>$queryWord_S
								</span> was not found. please try search for a single word e.g. Nkiru,P,001,a etc"; 
										  
							}
							
						}
									 

						
						
						
						
					}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}
		
						
				
				}else{		
			
					echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
				}
		 
				if ($msg_e) {
					 
					 echo $erroMsg.$msg_e.$msgEnd; 	// exit; 				

				}	
			
			
?>
				</tbody></table><!-- / table -->
				
			</div>
			
			</section>
			
			</div>	 
        
			<div class="col-lg-7">
				<section class="panel" id="wizGradeScrollTarget">
			 
					<header class="panel-heading">
						<i class="fa fa-wrench fa-lg"></i>   Bio Tasks  
						<span class="tools pull-right">
						<a href="javascript:;" class="fa fa-chevron-down"></a>
						<a href="javascript:;" class="fa fa-times"></a>
						</span>
					</header>
					<div class="panel-body wizGrade-line">

						<div id="wizGradeRightHalf">  </div>

					</div>
					
				</section>
			</div>
        </div>
		<!-- / row --> 
		<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>