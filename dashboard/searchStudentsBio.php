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
	This script handle search class and student profiles
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

            define('wizGrade', 'igweze');  /* define a check for wrong access of file */

            require 'configwizGrade.php';  /* load wizGrade configuration files */	   

		 
			try {
			 
					$levelArray = studentLevelsArray($conn);
					
			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			}
	
			
			  
?>

		<!-- row -->
		<div class="row">
            <div class="col-lg-5">
                    <section class="panel">
						<header class="panel-heading">                              
							  <i class="fa fa-search-plus fa-lg"></i> Student Profile  
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
						<thead><tr><th>Reg. No.</th> <th>Name</th><th>Tasks</th></tr></thead> <tbody>
		
IGWEZE;
		 
			echo $table_head;
			
			if ($_REQUEST['searchData'] == 'searchProfSess') {  /* search class profile */		 
			    
				try { 
				
					$session = $_REQUEST['sess'];
					$class = $_REQUEST['class'];
					$level = $_REQUEST['level'];
					
					$session = strip_tags($session);
					$class = strip_tags($class);
					$level = strip_tags($level);								
					
					/* script validation */
					
					if (($session == '') || ($level == '') || ($class == '')) {
					
						$msg_e =  $formErrorMsg;					
						echo $errorMsg.$msg_e.$eEnd;   //exit; 			
									
					}else{  /* search class profile */
					
						$session_se  = $session + $foreal; 
			 
						$mClass = studentClassLevel($level);  /* retrieve student class */
						$sessionID = sessionID($conn, $session);  /* school session  */
						$session_fi = wizGradeSession($conn, $sessionID);  /* school session ID  */
								 
						$session_se = $session_fi + $foreal;  
						
						$ebele_mark = "SELECT r.ireg_id, nk_regno, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname
						
										FROM $i_reg_tb r INNER JOIN $i_student_tb s
						
										ON (r.ireg_id = s.ireg_id)

										AND r.session_id = :session_id 
								 
										AND r.$mClass = :class

										AND r.active = :foreal";
							 
						$igweze_prep = $conn->prepare($ebele_mark);			
						$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
						$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
						$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);				 
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count >= $foreal) {  /* check array is empty */ 							
						
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
			   
								$regNo = $row['nk_regno'];
								$regNoID = $row['ireg_id'];
								$pic = $row['i_stupic'];
								$fname = $row['i_firstname'];
								$lname = $row['i_lastname'];
								$mname = $row['i_midname']; 
								
								$serial_no++;
												
								$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$pic;

								if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }  /* check if picture exists */
								
								if(($admin_grade == $adminGrade) && ($admin_level == $adminGradeInt)) {  /* check if school admin */		
								
									$bioPicDiv = 'bioPicDiv-'.$regNo;
									$bioNameDiv = 'bioNameDiv-'.$regNo;
									//<td width='5%'>$serial_no</td>
					
$table_ed =<<<IGWEZE
        
									<tr id='student-row-$regNoID'>
									<td width='20%'> <a href='javascript:;' id='$regNo' class ='viewBioData'>$pre_regnum$regNo </a> </td>
									<td class='text-left' style="text-align:left !important;" width='70%'>
									
									<a href='javascript:;' id='$regNo' class ='viewBioData'> 
									
									<span id = 'loadNewPic-$regNo'> <img src = '$studentPic' height = '40' width = '40' class='small-picture'> </span>
									<span id = 'loadNewName-$regNo'> $lname $fname $mname  </span> </a> </td>
									
									<td width='10%'> 
									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right">
													<li>
													<a href='javascript:;' id='$regNo' class ='viewBioData'><button class="btn btn-success btn-xs">
													<i class="fa fa-search-plus"></i></button> View</a>
													</li>
													<li class="divider"></li>
													<li>
													<a href='javascript:;' id='$regNo' class ='editBioData'> <button class="btn btn-primary btn-xs">
													<i class="fa fa-edit"></i></button> Edit </a>					
													</li>
													<li class="divider"></li>
													<li>													
													<a href='javascript:;' id='$regNo' class ='stuIDCard'> <button class="btn btn-info btn-xs">
													<i class="fa fa-id-badge"></i></button> Student ID Card </a>					
													</li>
													<li class="divider"></li>
													<li>
													<a href='javascript:;' id='$regNo' class ='resetBioData'> <button class="btn btn-danger btn-xs">
													<i class="fa fa-key"></i></button> Reset/Remove</a>						
													</li>													
											</ul>          
													
									</div><!-- /btn-group -->
									
									
									</td> </tr>
		
IGWEZE;
		echo $table_ed;
		
								}else{  /* check if school staff */
						
									//<td width='5%'>$serial_no</td>	
					
$table_ad =<<<IGWEZE
        
									<tr>
									<td width='20%'> <a href='javascript:;' id='$regNo' class ='viewBioData'>$pre_regnum$regNo </a> </td> 
									<td style="text-align:left !important;" width='70%'><a href='javascript:;' id='$regNo' class ='viewBioData'>
									<span id = 'loadNewPic-$regNo'> <img src = '$studentPic' height = '40' width = '40' class='small-picture'> </span>
									
									<span id = 'loadNewName-$regNo'> $lname $fname $mname  </span> </a> </td>
									
									<td width='10%'> 
									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right">
													<li>
													<a href='javascript:;' id='$regNo' class ='viewBioData'><button class="btn btn-success btn-xs">
													<i class="fa fa-search-plus"></i></button> View</a>
													</li>
													
													<li class="divider"></li>
													<li>													
													<a href='javascript:;' id='$regNo' class ='stuIDCard'> <button class="btn btn-info btn-xs">
													<i class="fa fa-id-badge"></i></button> Student ID Card </a>					
													</li>
											</ul>
											
									</div><!-- /btn-group -->
									
									</td> </tr>
		
IGWEZE;
								echo $table_ad;
					
					
					
								}

							}
		

						}else{  /* display error */
							
							$classLevel = $levelArray[$level-1]['level'];		
							$errMo = "$session - $session_se session $classLevel $class";	
							$msg_e = "Oooooops error, no record was found for <b>$errMo</b>"; 
							echo $erroMsg.$msg_e.$msgEnd;
						
						}
					
					}
		 
						
						
				}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
				}		
		
			}elseif($_REQUEST['searchData'] == 'searchWord'){  /* search student profile */		 
		
				/* script validation */ 
				
				if ($_REQUEST['queryWord'] == '') {
					
					$msg_e =  $formErrorMsg;
					
					echo $errorMsg.$msg_e.$eEnd;  //exit; 			
					
				}else{  /* search student profile */	
				  
				 
					try {
						
						$queryWord = $_REQUEST['queryWord'];	 $queryWord_S = $queryWord;	
						$queryWord = preg_replace("/[^A-Za-z0-9 ]/", " ", $queryWord);

						$ebele_mark = "SELECT r.ireg_id, nk_regno, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname, y.year

							 FROM $i_reg_tb r, $i_student_tb s, $schoolSessionTB y

							 WHERE 	(s.i_firstname LIKE :i_firstname
							 
							 OR  s.i_lastname LIKE :i_lastname
							 
							 OR  s.i_midname LIKE :i_midname
							 
							 OR  r.nk_regno LIKE :nk_regno)
							 
							 AND r.ireg_id = s.ireg_id
							 
							 AND r.session_id = y.ID_SESS";
							 
						$igweze_prep = $conn->prepare($ebele_mark); 
						$igweze_prep->bindValue(':i_firstname', '%'.$queryWord.'%');
						$igweze_prep->bindValue(':i_lastname', '%'.$queryWord.'%');
						$igweze_prep->bindValue(':i_midname', '%'.$queryWord.'%');
						$igweze_prep->bindValue(':nk_regno', '%'.$queryWord.'%');
										
						 
						$igweze_prep->execute();
						
						$rows_count = $igweze_prep->rowCount(); 
						
						if($rows_count >= $foreal) {  /* check array is empty */ 
						
							while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
			   
								$regNo = $row['nk_regno'];
								$regNoID = $row['ireg_id'];
								$pic = $row['i_stupic'];
								$fname = $row['i_firstname'];
								$lname = $row['i_lastname'];
								$mname = $row['i_midname'];
								$session_fi = $row['year'];
								
								$stringReplace = explode(' ', $queryWord);
								
								$replaceString = array_map('wizGradeHighlight', $stringReplace);
								
								$regNoRep = str_ireplace($stringReplace, $replaceString, $regNo);
								$lnameRep = str_ireplace($stringReplace, $replaceString, $lname);
								$fnameRep = str_ireplace($stringReplace, $replaceString, $fname);
								$mnameRep = str_ireplace($stringReplace, $replaceString, $mname);
								
								
								$session_se = $session_fi + $fiVal;
								
								$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$pic;

								if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }  /* check if picture exists */
						
								$serial_no++; 
								
								if(($admin_grade == $adminGrade) && ($admin_level == $adminGradeInt)) {  /* check if school admin */		
							 
									//<td width = '5%'>$serial_no</td>
					
$table_ed =<<<IGWEZE
        
									<tr  id='student-row-$regNoID'>
									<td> <a href='javascript:;' id='$regNo' class ='viewBioData' width = '20%'>
									$pre_regnum&nbsp;$regNoRep </a> </td>  
									
									<td class='text-left' style="text-align:left !important;" width = '70%'>
									<a href='javascript:;' id='$regNo' class ='viewBioData'> 
									
									<span id = 'loadNewPic-$regNo'> <img src = '$studentPic' height = '40' width = '40' class='small-picture'> </span>
									
									<span id = 'loadNewName-$regNo'> $lnameRep $fnameRep $mnameRep </span> </a> </td>
									
									<td width='10%'> 
								
									<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
											<i class="fa fa-wrench"></i> <span class="caret"></span></button>
												<ul role="menu" class="dropdown-menu pull-right">
														<li>
														<a href='javascript:;' id='$regNo' class ='viewBioData'><button class="btn btn-success btn-xs">
														<i class="fa fa-search-plus"></i></button> View</a>
														</li>
														<li class="divider"></li>
														<li>
														<a href='javascript:;' id='$regNo' class ='editBioData'> <button class="btn btn-primary btn-xs">
														<i class="fa fa-edit"></i></button> Edit </a>					
														</li>
														<li class="divider"></li>
														<li>													
														<a href='javascript:;' id='$regNo' class ='stuIDCard'> <button class="btn btn-info btn-xs">
														<i class="fa fa-id-badge"></i></button> Student ID Card </a>					
														</li>
														<li class="divider"></li>
														<li>
														<a href='javascript:;' id='$regNo' class ='resetBioData'> <button class="btn btn-danger btn-xs">
														<i class="fa fa-key"></i></button> Reset/Remove</a>						
														</li>
												</ul>    
														
									</div><!-- /btn-group -->
														  
								
									
									</td> </tr>
			
IGWEZE;
									echo $table_ed; 
	
								}else{  /* check if school staff */						
									//<td width = '5%'>$serial_no</td>						
					
$table_ad =<<<IGWEZE
        
									<tr>
									<td> <a href='javascript:;' id='$regNo' class ='viewBioData' width = '20%'>
									$pre_regnum&nbsp;$regNo </a> </td> 
									<td style="text-align:left !important;" width = '70%'><a href='javascript:;' id='$regNo' class ='viewBioData'> 
									<span id = 'loadNewPic-$regNo'> <img src = '$studentPic' height = '40' width = '40' class='small-picture'> </span>
									<span id = 'loadNewName-$regNo'> $lnameRep $fnameRep $mnameRep </span> </a> </td>
									
									<td width = '10%'> 
									
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right">
													<li>
													<a href='javascript:;' id='$regNo' class ='viewBioData'><button class="btn btn-success btn-xs">
													<i class="fa fa-search-plus"></i></button> View</a>
													</li>	
													<li class="divider"></li>
													<li>													
													<a href='javascript:;' id='$regNo' class ='stuIDCard'> <button class="btn btn-info btn-xs">
													<i class="fa fa-id-badge"></i></button> Student ID Card </a>					
													</li>	
											</ul>           
													
									</div><!-- /btn-group --> 									
									</td> </tr>
		
IGWEZE;
									echo $table_ad; 
					
								}

		
							} 
							
								

						}else{  /* display error */ 
		
							$msg_e =  "Oooooops error, student record with <b>$queryWord_S</b> was not found. please try search for a single word e.g. Nkiru,P, 001, Osinachi etc"; 
						  
						}
				
					}catch(PDOException $e) {
						
								wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
						 
					}
				}
		
				 
				
			}else{		
			
					echo $userNavPageError; exit;  /* else exit or redirect to 404 page */ 
		
			}
		 
			if ($msg_e) {
					 
				echo $errorMsg.$msg_e.$eEnd; 	//exit; 				

			}	
			
		
?>
				</tbody></table><!-- / table -->
		
			</div>
			
			</section>
			
			</div>	 
        
			<div class="col-lg-7">
				<section class="panel" id="wizGradeScrollTarget">
			 
					<header class="panel-heading">
						<i class="fa fa-wrench fa-lg"></i> <strong>
							<span class="hide-res">
							<?php echo "$session_fi - $session_se session </span>";
							  echo $levelArray[$level-1]['level']; echo" $class "; ?></strong>
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