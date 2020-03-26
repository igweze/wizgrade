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
	This page load online registration manager
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
					  <i class="fa fa-user-plus fa-lg"></i> Online Registration  
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
		 
			<thead><tr><th class='text-left'>S/N</th> <th class='text-left'>Student Name</th> <th class='text-left'>Tasks</th></tr></thead> <tbody>
		
IGWEZE;

		 	echo $table_head;
			
			try {
				
				/* select information */
				
  				$ebele_mark = "SELECT stu_id, i_stupic, i_firstname, i_lastname, i_midname
				
								FROM $studentOnlineRegTB
								
								ORDER BY stu_id DESC";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				 
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {  /* check array is empty */
				
					
				
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
	   
						$stu_id = $row['stu_id'];
						$pic = $row['i_stupic'];
						$fname = $row['i_firstname'];
						$lname = $row['i_lastname'];
						$mname = $row['i_midname']; 
						
						$serial_no = $foreal++;
						
						$studentPic = $applyPSrc.$pic;
						
						if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }  /* check if picture exists */
						$rowID = 'newRegRow-'.$stu_id;
					
					
$tableBody =<<<IGWEZE
        
						<tr id ='$rowID'><td width='5%'class='text-left'>$serial_no</td>
						<td class='text-left' width='85%'>
						
						<a href='javascript:;' id='$stu_id' class ='viewNewReg'> <img src = '$studentPic' height = '40' width = 
						'40' class='small-picture'> 
						 $lname $fname $mname  </a> </td> 
						
						<td class='text-left' width='10%'> 
						
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
								<i class="fa fa-wrench"></i> <span class="caret"></span></button>
									<ul role="menu" class="dropdown-menu pull-right">
										<li>
										<a href='javascript:;' id='$stu_id' class ='viewNewReg'><button class="btn btn-success btn-xs">
										<i class="fa fa-search-plus"></i></button> View</a>
										</li>
									</ul>		
							</div><!-- /btn-group --> 
						</td> </tr>
		
IGWEZE;
						echo $tableBody; 

					} 

				}else{  /* display error */
		
					$msg_e = "Oooooooooops, no new student registration record was found. Thanks";
		
				}
		
			}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}
	
		
			echo  '</tbody></table><!-- / table -->'; 
		
			if ($msg_e) {
			 
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>"; //exit; 				

			}	
			
		
?>
						</div>
				
					</section>
				
				</div> 
				
				<div class="col-lg-7">
					<section class="panel" id="wizGradeScrollTarget">			 
						<header class="panel-heading">                               
							<i class="fa fa-wrench fa-lg"></i>    Tasks Panel
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