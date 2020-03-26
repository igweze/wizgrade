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
	This script load  manual student result inputation
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

        define('wizGrade', 'igweze');  /* define a check for wrong access of file */
						
		require 'configwizGrade.php';  /* load wizGrade configuration files */	  

		try {
			 
	
					$levelArray = studentLevelsArray($conn); /* student level array */ 

					
		}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
		}

		 

		if (($_REQUEST['loadRS']) == 'manualRSCPanel') {
			
			/* script validation */ 
			
			if ( (($_REQUEST['sess']) != "") && (($_REQUEST['level']) != "") && (($_REQUEST['class']) != "") 
																							
			&& (($_REQUEST['term']) != "") )  {

				$session = $_REQUEST['sess'];
				$level = $_REQUEST['level'];
				$class = $_REQUEST['class'];
				$term = $_REQUEST['term']; 

				try { 

					$sessionID = sessionID($conn, $session); /* school session ID  */
					$rsStatus = wizGradeResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */ 
						
				}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
				}
			 
				echo '<!-- row --> <div class="row highRSDiv">
						<div class="col-lg-5">
						<section class="panel">
							<header class="panel-heading">
                              Student Results 
							</header>
							<div class="panel-body wizGrade-line">';
						  
						 
				
					if  ($rsStatus == $rspublishStage){	 /* check student result status */	 
						 	
						$session_se = $session + $foreal;
						$SessSem = schoolTerm($term);  /* school term  */
						
						$msg_e = "$tframeF $SessSem Semester $session - $session_se $tframeS";
						
						echo $erroMsg.$msg_e.$msgEnd; echo $scrollUp;
						echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */	</script>"; exit;
						exit;
						
					}
					
					echo "<script type='text/javascript'>  $('#paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */  </script>";
		
		
$table_head =<<<IGWEZE

					<!-- table -->
					<table width = '100%' border = '0' align = 'center' class="table table-striped table-advance table-hover" id="wizGradeTBPage">
					<thead><tr><th>Reg. No.</th> <th>Name</th> <th>Tasks</th></tr></thead> <tbody>

IGWEZE;
					echo $table_head;		
		 
				try {
		 
		
					$sessionID = sessionID($conn, $session); /* school session ID  */
					$session_fi = wizGradeSession($conn, $sessionID); /* school session */
					$mClass = studentClassLevel($level);  /* retrieve student class */
							 
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
		   
								$regNum = $row['nk_regno'];
								$ID = $row['ireg_id'];
								$pic = $row['i_stupic'];
								$fname = $row['i_firstname'];
								$lname = $row['i_lastname'];
								$mname = $row['i_midname'];
								
								$edit_data = $regNum.'@@'.$session.'@@'.$level.'@@'.$class.'@@'.$term;
								$conduct_data = $regNum.'@@'.$level.'@@'.$term.'@@'.$class;
								
								$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$pic;
								
								if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }
								//<a href='$regNum' class='link_rs' >
							
$table =<<<IGWEZE
								<tr>
								<td width="20%"> <a href='javascript:;' id='$edit_data' class='editRS'>$pre_regnum$regNum 
								</a> </td> 
								<td class='text-left' width="70%"><a href='javascript:;' 
								id='$edit_data' class='editRS'> <img src = '$studentPic' 
								height = '40' width = '40' class='small-picture'> 
								$lname $fname $mname </a> </td> 
								<td width="10%"> 
								
								<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
								<i class="fa fa-wrench"></i> <span class="caret"></span></button>
									<ul role="menu" class="dropdown-menu pull-right"> 
											<li>
											<a href='javascript:;' id='$edit_data' class='editRS'> <button class="btn btn-primary btn-xs">
											<i class="fa fa-book"></i></button> Student Result </a>					
											</li>
											<li class="divider"></li>
											
											<li>
											<a href='javascript:;' id='$conduct_data' class='studentConduct'><button class="btn btn-success btn-xs">
											<i class="fa fa-check-square-o"></i></button>  Student Conducts</a>
											</li>
											
											<li class="divider"></li>
											
											<li>
											<a href='javascript:;' id='$edit_data' class='viewSubComment'><button class="btn btn-danger btn-xs">
											<i class="fa fa-commenting-o"></i></button> Subject Comments</a>
											</li> 					
									</ul>		
											
								</div><!-- /btn-group -->
								
								</td>
								</tr>
		
IGWEZE;
							echo $table;

						}

						 
					
					
					}else{
			
						$classLevel = $levelArray[$level-1]['level'];;
						
						$msg_e = "Error, no record was found for <span>
						$session - $session_se session $classLevel $class $term_value </span>";
					
						echo $erroMsg.$msg_e.$mgsEnd;   	
							
					}
		
				}catch(PDOException $e) {
  			
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
	
		
?>

						</tbody></table><!-- / table -->
						
					</div>
    
    				</section>
        
				</div>	
				
				
				
				
                
        		<div class="col-lg-7 rsScrollTarget">
          			
		
					<?php	
					
						require_once $wizGradeClassConfigDir;

	    				$a = 1; $b = 2; $c = 3; $e = 4; $f = 0;
					?>       		
		

                      <section class="panel" id="wizGradeRSRight">
                      
                          <header class="panel-heading">
                          
                          <strong><?php echo "$session_fi $session_se session ";
							  echo $levelArray[$level-1]['level']; echo" $class $term_value Results"; ?></strong>
                              
                              <?php 
							  
							  	/*echo'
									<span class="pull-right">
									<img src="'.$wizGradeTemplate.'images/settings.png" alt="Enter Result Settings" 
									class="tooltip-hide tooltips Stooltips show-rsconfig-div" data-toggle="tooltip" data-placement="top" 
									title="Enter Result Settings" /></span>';
									*/
							  
							  

							  ?>
                          </header>
                          <div class="panel-body wizGrade-line">
                           
                          <?php

							$msg_i = "Please, search for students using the search box or click on 
							the student Reg No, Name, Picture or to enter their result. <br />
							 <br /> Meanwhile, you can add student
							settings, compute and publish student result by clicking on the settings icons above.";
							
							echo $infMsg.$msg_i.$msgEnd;

						  ?>
                              
							</div>
                                               
                      </section>
                      
                  </div>
				  
				</div>  
				<!-- / row -->
                
                    
                    
                    
<?php 			
				$showTokenDiv = true; require_once ($wizGradeFormTeacherDir.'rsConfigDiv.php');    /* include staff result configuration div */ 
				
				
			}else {  /* display error */  

        		$msg =  $formErrorMsg;
 
        	}
				
		}else{  /* display error */ 
		
		
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		
		}
			
			
		if ($msg) {
				
			echo $errorMsg.$msg.$eEnd; echo $scrollUp; exit; 			

		}

exit;
?>		 