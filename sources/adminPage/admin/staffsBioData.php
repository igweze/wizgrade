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
	This page show school staff profiles
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?> 
               
		<!-- row -->	
		<div class="row">  
		 
         <div class="col-lg-5">
                      <section class="panel">
							<header class="panel-heading">                              
								<i class="fa fa-users fa-lg"></i> Manage <span class="hide-res">School</span> Staff/s
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
				<thead><tr><th width='5%'>S/N</th> <th class='text-left' width='85%'>Staff Name</th> <th width='10%'>Tasks</th></tr></thead> <tbody>
		
IGWEZE;
				echo $table_head;
		 		 
		try {
								
				
  				$ebele_mark = "SELECT t_id, i_title, i_picture, i_firstname, i_lastname, i_midname, rank, t_grade
				
								FROM $staffTB
								
								WHERE status = :status";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':status', $fiVal);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {  
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {		
	   
						$t_id = $row['t_id'];
						$title = $row['i_title'];
						$pic = $row['i_picture'];
						$fname = $row['i_firstname'];
						$lname = $row['i_lastname'];
						$mname = $row['i_midname'];
						$ranking = $row['rank'];
						$t_grade = $row['t_grade'];
						
						//if(($t_grade > $fiVal) && ($t_grade <= $fifVal)){ /* check if this user is the main admin */
						
							$showPassDiv ="<li class='divider'></li>
							<li>
							<a href='javascript:;' id='$t_id' 
							class ='resetStaff'> <button class='btn btn-danger btn-xs'>
							<i class='fa fa-key'></i></button> Reset/Remove</a>		
							</li>";
						
						//}else{
							
							//$showPassDiv = '';
						
						//}
						
						
						$serial_no = $foreal++;
										
						$titleVal = $title_list[$title];				
						$teacherPic = $staffPicExt.$pic;

						if ((is_null($pic)) || !file_exists($teacherPic)){ $teacherPic = $wizGradeDefaultPic; }  /* check if picture exists */
						
						if(($admin_grade == $adminGrade) && ($admin_level == $adminGradeInt)) {	/* check if this user is the main admin */
					
$table_ed =<<<IGWEZE
        
							<tr id='staff-row-$t_id'>
							
							<td width='5%'>$serial_no</td>
							
							<td class='text-left' width='85%'>
							
							<a href='javascript:;' id='$t_id' class ='viewStaff'> <img src = '$teacherPic' height = '40' width = 
							'40' class='small-picture'> 
							$titleVal $lname $fname $mname</a> </td>
							
							
							<td width='10%'>  
							<!-- btn-group -->
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
								<i class="fa fa-wrench"></i> <span class="caret"></span></button>
									<ul role="menu" class="dropdown-menu pull-right">
											<li>
											<a href='javascript:;' id='$t_id' class ='viewStaff'><button class="btn btn-success btn-xs">
											<i class="fa fa-search-plus"></i></button> View</a>
											</li>
											<li class="divider"></li>
											<li>													
											<a href='javascript:;' id='$t_id' class ='staffIDCard'> <button class="btn btn-info btn-xs">
											<i class="fa fa-id-badge"></i></button> Staff ID Card </a>					
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
		
						}else{ /* else this user is not the main admin */
					
$table_ad =<<<IGWEZE
        
							<tr>
							
							<td width='10%'>$serial_no</td>
							<td class='text-left' width='80%'>
							
							<a href='javascript:;' id='$t_id' class ='viewStaff'> <img src = '$teacherPic' height = '40' width = 
							'40' class='small-picture'> 
							$titleVal $lname $fname $mname  </a> </td>
							
							
							<td width='10%'> 
							<!-- btn-group -->
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
								<i class="fa fa-wrench"></i> <span class="caret"></span></button>
									<ul role="menu" class="dropdown-menu pull-right">
											<li>
											<a href='javascript:;' id='$t_id' class ='viewStaff'><button class="btn btn-success btn-xs">
											<i class="fa fa-search-plus"></i></button> View</a>
									</ul>		</li> 
											
							</div><!-- /btn-group -->
							
							</td> </tr>
		
IGWEZE;
							echo $table_ad; 
					
						}

					}
				

				}else{
				
					$msg_e = "Ooooops, no staff record was found. Please start adding staffs bio data info";
					echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>"; //exit; 	
					 
				}
		
		}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		}
	
		
		echo  '</tbody></table><!-- /table -->';
		
		 
?>
			</div>
			
			</section>
			
			</div>	
		 
			
		 
			<div class="col-lg-7">
				<section class="panel" id="wizGradeScrollTarget">
			 
								<header class="panel-heading">
								 
								 <i class="fa fa-wrench fa-lg"></i> Bio  Tasks  
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