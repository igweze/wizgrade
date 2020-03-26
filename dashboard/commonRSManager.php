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
	This script load class and student result pages
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	   		 

			if (($_REQUEST['searchData'] == 'studentTranscript') || (isset($_REQUEST['studentReg'])) ){  /* load student result transcript */	   
	
				/* script validation */ 
				
				if (((isset($_REQUEST['regnum'])) && (isset($_REQUEST['level'])) && (isset($_REQUEST['term']))) 
				|| (isset($_REQUEST['studentReg']))) {
					
					$regNum = $_REQUEST['regnum'];
					$level = $_REQUEST['level'];	
					$term = $_REQUEST['term'];
					
					$printArea = 'wizGradePrintArea';
					
					if($_REQUEST['studentReg']) {
					
						$SearchRegPara =  $_REQUEST['studentReg'];
						
						list ($regNum, $level, $term) = explode ("@@", $SearchRegPara);
						echo"<div class='close-ov-btn'><img src='";
						echo $wizGradeTemplate; echo "images/exitbtn.png' alt='Exit Page' class ='exit-overlay-box
						showPrintBtn'/></div>";
						echo "<span class='clear' style='margin-top:0px;'> </span>";
						
						echo"<div class='pull-right'>
						<button  class='btn btn-white' id ='printerOverImg' alt='Print This Result' >
									  <i class='fa fa-print text-info'></i> Print Result</button> 
						 
						</div><br/>";
						$printArea = 'wizGradeOlPrintArea';
					
					}


					try {
						
							echo "<div id='$printArea'>";  	
					 
								$sessionID = studentRegSessionID($conn, $regNum);  /* student school session ID */
								$session_fi = wizGradeSession($conn, $sessionID);   /* school session  */					
						 
								$session_se = $session_fi + $foreal;  
								$class = studentClass($conn, $regNum, $level);  /* retrieve a student class */ 

								if ($term == 'all'){  /* if annual result */  
									
									$term = $fi_term; $promotionStatus = false;	$subfCounter = 0;
									
									require  $wizGradeClassConfigDir;   /* include class configuration script */  
									
									require ($wizGradeSessionRSDir);    /* include annual result */ 
									
									$promotionStatus = false;  

								}else{  /* if  termly result */ 
									
									require  $wizGradeClassConfigDir;   /* include class configuration script */    			

									if($rsType == $seVal){   /* check result type */ 
							
										require_once $wizGradeStudentSubRSDir;   /* include computational result */ 
										
									}else{	
									
										require_once $wizGradeStudentComRSDir;   /* include comment result */ 
										
									}									

								}	
								
							echo "</div>";
				
					}catch(PDOException $e) {
					
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
					 
					}
		

				}else {  /* display error */ 

						$msg_e =  $formErrorMsg;
						
						echo $errorMsg.$msg_e.$eEnd; echo $scrollUp;  
	 
				}
				
				echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ </script>"; exit;
			
			}elseif ($_REQUEST['searchData'] == 'searchSessionRS') {  /* load class result transcript */
				
				/* script validation */
			
				if ((isset($_REQUEST['sess'])) && (isset($_REQUEST['level'])) && (isset($_REQUEST['class'])) 
					&& (isset($_REQUEST['term'])) )  { 

					$annual = false;
					
					$session = $_REQUEST['sess'];
					$level = $_REQUEST['level'];
					$class = $_REQUEST['class'];		
					$term = $_REQUEST['term']; 
					
					if($term == "annual"){
						
						$term = 3;
						$annual = true;
					}

					try {
			 
						echo "<div id='wizGradePrintArea'>";
					 
							$sessionID = sessionID($conn, $session); 					
				
							$session_fi = $session;
							$session_se = $session_fi + $foreal; 

							require  $wizGradeClassConfigDir;   /* include class configuration script */ 
							
							if($class == 'all'){
									
								require_once ($wizGradeAllClass);   /* include all class result page */ 
								
							}elseif($annual == true){
									
								require_once ($wizGradeGlobalRSDir.'classAnnualTranscript.php');   /* include class annual result page */ 
								
							}else{
								
								require_once ($wizGradeClassRSManagerDir);   /* include  class result page */ 
								
							}

						echo "</div>";
					
					
					}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}
		

				}else {  /* display error */

						$msg_e =  $formErrorMsg;
						echo $errorMsg.$msg_e.$eEnd;
	 
				}

				echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ </script>"; exit;
				
			
			}elseif ($_REQUEST['searchData'] == 'exportRS') {  /* export class result  */
			
				/* script validation */
				
				if ((isset($_REQUEST['sess'])) && (isset($_REQUEST['level'])) && (isset($_REQUEST['class'])) 
				&& (isset($_REQUEST['term'])) )  {


					$session = $_REQUEST['sess'];
					$level = $_REQUEST['level'];
					$class = $_REQUEST['class'];		
					$term = $_REQUEST['term'];

					try {
			 
						echo "<div id='wizGradePrintArea'>";
					 
							$sessionID = sessionID($conn, $session);   /* school session ID */ 
				
							$session_fi = $session;
							$session_se = $session_fi + $foreal; 

							require  $wizGradeClassConfigDir;   /* include class configuration script */ 
							
							if($query_i_scores != ""){   /* check if query is empty */ 
								
								require_once ($wizGradeExportRSDir);   /* include class export result file */ 
								
							}else{
								
								$msg_e = "Ooooooops error, no subject/course information was added for 
								<span class='bold-msg'> $stu_class $class $term_value </span>";						
								echo $erroMsg.$msg_e.$msgEnd; 	
								
							}	

						echo "</div>";
						
					}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					}
				 
        		}else {  /* display error */

        			$msg_e =  $formErrorMsg;
					echo $errorMsg.$msg_e.$eEnd; echo $scrollUp; 
 
        		}

			    echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ </script>"; exit;
			
			}elseif ($_REQUEST['searchData'] == 'exportScanRS') {  /* export class result  */
			
				/* script validation */
				
				if ((isset($_REQUEST['sess'])) && (isset($_REQUEST['level'])) && (isset($_REQUEST['class'])) )  { 

					$session = $_REQUEST['sess'];
					$level = $_REQUEST['level'];
					$class = $_REQUEST['class']; 

					try {
			 
						echo "<div id='wizGradePrintArea'>";
					 
							$sessionID = sessionID($conn, $session);   /* school session ID */ 
							
				
							$session_fi = $session;
							$session_se = $session_fi + $foreal;

							$term = $fiVal;
							
							require  $wizGradeClassConfigDir;   /* include class configuration script */ 
							
							if($query_i_scores != ""){   /* check if query is empty */
								
								require_once ($exportScanRSDir);   /* include class export result file */  
								
							}else{
								
								$msg_e = "Ooooooops error, no subject/course information was added for 
								<span class='bold-msg'> $stu_class $class $term_value </span>";						
								echo $erroMsg.$msg_e.$msgEnd; 	
								
							}	 

						echo "</div>";
						
					}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					} 

        		}else {  /* display error */

        			$msg_e =  $formErrorMsg;
					echo $errorMsg.$msg_e.$eEnd; echo $scrollUp;  
 
        		}

			    echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ </script>"; exit;
			
			}else{
			
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
			} 
			
exit;		 
?>