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
	This script handle student conducts validation
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

		 define('wizGrade', 'igweze');  /* define a check for wrong access of file */
		 
		require 'configwizGrade.php';  /* load wizGrade configuration files */	
		         echo "<pre>"; print_r($_REQUEST); echo "</pre>";
		if (($_REQUEST['studentData']) == 'studentConducts') {

		        $noschopen = preg_replace("/[^0-9]/", "", $_REQUEST['noschopen']);
			    $nopre = preg_replace("/[^0-9]/", "", $_REQUEST['nopre']);
			    $nopunt  = preg_replace("/[^0-9]/", "", $_REQUEST['nopunt']);
				
			    $neatness = $_REQUEST['neatness'];
				$politeness = $_REQUEST['politeness'];
                $honesty = $_REQUEST['honesty'];
				$leadership = $_REQUEST['leadership'];
				$attentiveness = $_REQUEST['attentiveness'];
				$emotionalstab = $_REQUEST['emotionalstab'];
				$health = $_REQUEST['health'];
				$attitudesch = $_REQUEST['attitudesch'];
				$speaking = $_REQUEST['speaking'];
				$handwriting = $_REQUEST['handwriting'];
				
				$fi_organ = $_REQUEST['fi_organ'];
				$fi_off = $_REQUEST['fi_off'];
				$fi_contrib  = preg_replace("/[^A-Za-z0-9', ]/", "", $_REQUEST['fi_contrib']);
				
				$se_organ = $_REQUEST['se_organ'];
				$se_off = $_REQUEST['se_off'];
				$se_contrib  = preg_replace("/[^A-Za-z0-9', ]/", "", $_REQUEST['se_contrib']);
				
				$th_organ = $_REQUEST['th_organ'];
				$th_off = $_REQUEST['th_off'];
				$th_contrib  = preg_replace("/[^A-Za-z0-9', ]/", "", $_REQUEST['th_contrib']);
				
				$fo_organ = $_REQUEST['fo_organ'];
				$fo_off = $_REQUEST['fo_off'];
				$fo_contrib  = preg_replace("/[^A-Za-z0-9', ]/", "", $_REQUEST['fo_contrib']);
				
				$fif_organ = $_REQUEST['fif_organ'];
				$fif_off = $_REQUEST['fif_off'];
				$fif_contrib  = preg_replace("/[^A-Za-z0-9', ]/", "", $_REQUEST['fif_contrib']);
				

				$sports = $_REQUEST['sports'];
			    $remarks = strip_tags($_REQUEST['remarks']);
				$pr_comment  = strip_tags($_REQUEST['pr_comment']);
				$teacherCom  = strip_tags($_REQUEST['teacherCom']);
				$sConductData = $_REQUEST['SConductData'];
		 
				/* script validation */ 
				
				/*
				if ($noschopen == "")  {
					
         			$msg_e = "Ooooooops, please enter number of Times School Open";
					$Cpage = $fiVal;
					
	   			}elseif($nopre == "")   {
					
         			$msg_e = "Ooooooops, please enter number of Times Present";
					$Cpage = $fiVal;
					
	   			}elseif (($nopunt == "")) {
					
         			$msg_e = "Ooooooops, please enter number of Times Punctual";
					$Cpage = $fiVal;
	   			
				}elseif ($neatness == "")  {
         			
					$msg_e = "Ooooooops, please select a value for student neatness";
					$Cpage = $seVal;
					
	   			}elseif (($politeness == "")) {
					
         			$msg_e = "Ooooooops, please select a value for student politeness";
					$Cpage = $seVal;
					
	   			}elseif (($honesty == "")) {
					
         			$msg_e = "Ooooooops, please select a value for student honesty";
					$Cpage = $seVal;
	   			
				}elseif (($leadership == "")) {
					
         			$msg_e = "Ooooooops, please select a value for student leadership";
					$Cpage = $seVal;
	   			
				}elseif($emotionalstab == "")   {
					
         			$msg_e = "Ooooooops, please select a value for student Emotional Stability";
					$Cpage = $seVal;
	   			
				}elseif($attentiveness == "") {
         		
					$msg_e = "Ooooooops, please select a value for student attentiveness";
					$Cpage = $seVal;
	   			
				}elseif($health == "")  {
					
         			$msg_e = "Ooooooops, please select a value for student health";
					$Cpage = $seVal;
	   			
				}elseif($attitudesch == "") {
         			
					$msg_e = "Ooooooops, please select a value for student Attitude to School Work";
					$Cpage = $seVal;
      			
	  			}elseif($speaking == ""){
					
         			$msg_e = "Ooooooops, please select a value for student speaking ability";
					$Cpage = $seVal;
      			
	  			}elseif($handwriting == "") {
					
         			$msg_e = "Ooooooops, please select a value for student handwriting skills";
					$Cpage = $seVal;
      			
	  			}else
				*/
			
				if ($teacherCom == "")  {
				
         			$msg_e = "Ooooooops, please enter teachers Comment";
					$Cpage = $fifVal;
	   			
				}else {  /* serialize and update information */ 

       				$noschopen = trim($noschopen);  $nopre = trim($nopre);
       				$nopunt = trim($nopunt);
					
					$attendance = $noschopen.','.$nopre.','.$nopunt;
					
					$stu_conducts = $neatness.','.$politeness.','.$honesty.','.$leadership.','.$attentiveness.','.$emotionalstab.','.$health.','.
					$attitudesch.','.$speaking.','.$handwriting;
				

      				if ($fi_organ == "")  { $fi_organ = '-'; } if ($se_organ == "")  { $se_organ = '-'; }
					if ($th_organ == "")  { $th_organ = '-'; } if ($fo_organ == "")  { $fo_organ = '-'; } 
					if ($fif_organ == "")  { $fif_organ = '-'; }
				
					if ($fi_off  == "")  { $fi_off  = '-'; } if ($se_off  == "")  { $se_off  = '-'; }
					if ($th_off  == "")  { $th_off  = '-'; } if ($fo_off  == "")  { $fo_off  = '-'; }
					if ($fif_off  == "")  { $fif_off  = '-'; }
				
					if ($fi_contrib  == "")  { $fi_contrib  = '-'; } if ($se_contrib  == "")  { $se_contrib  = '-'; }
					if ($th_contrib  == "")  { $th_contrib  = '-'; } if ($fo_contrib  == "")  { $fo_contrib  = '-'; }
					if ($fif_contrib  == "")  { $fif_contrib  = '-'; }
    
       				$fi_contrib = trim($fi_contrib); $se_contrib = trim($se_contrib);
       				$th_contrib = trim($th_contrib);  $fo_contrib = trim($fo_contrib); $fif_contrib = trim($fif_contrib);
					
					$nk_fi_organ =  $fi_organ.'@@'.$fi_off.'@@'.$fi_contrib;
					$nk_se_organ =  $se_organ.'@@'.$se_off.'@@'.$se_contrib;
					$nk_th_organ =  $th_organ.'@@'.$th_off.'@@'.$th_contrib;
					$nk_fo_organ =  $fo_organ.'@@'.$fo_off.'@@'.$fo_contrib;
					$nk_fif_organ =  $fif_organ.'@@'.$fif_off.'@@'.$fif_contrib;
					
					$nj_organ = $nk_fi_organ.'%##%'.$nk_se_organ.'%##%'.$nk_th_organ.'%##%'.$nk_fo_organ.'%##%'.$nk_fif_organ;


		 			try {
		 
					 		list ($regNum, $level, $term) = explode ("@@", $sConductData);
		 
		 					require  $wizGradeClassConfigDir;

							$regID = studentRegID($conn, $regNum);   /* student record ID  */ 
			
							$ebele_mark = "UPDATE $sdoracle_student_remark_nk SET 

											$attendance_r = :attendance,
											$conducts_r = :conducts,
											$organization_r = :organization,	
											$sports_r = :sports,
											$comment_r = :remarks,
											$comment_t = :teacherCom,
											$pr_comment_r = :pr_comment
											
											WHERE ireg_id = :ireg_id";
											
							$igweze_prep = $conn->prepare($ebele_mark);						
							$igweze_prep->bindValue(':attendance', $attendance);
							$igweze_prep->bindValue(':conducts', $stu_conducts);
							$igweze_prep->bindValue(':organization', $nj_organ);
							$igweze_prep->bindValue(':sports', $sports);
							$igweze_prep->bindValue(':remarks', $remarks);
							$igweze_prep->bindValue(':pr_comment', $pr_comment);
							$igweze_prep->bindValue(':teacherCom', $teacherCom);
							$igweze_prep->bindValue(':ireg_id', $regID); 
							
							if ($igweze_prep->execute()) {  /* if sucessfully */ 

									$msg_s = "Student record <span>$regNum</span> conducts was successfully saved.";
									
							}else {  /* display error */ 

									$msg_e = "<span>Ooooooops, an error has occur, please try again</span>";

							}
 

					}catch(PDOException $e) {
				
							wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
					} 
		
								
				} 
				
			
				if ($msg_s) {

					echo $succesMsg.$msg_s.$sEnd; echo "<script type='text/javascript'> 
					$('.frmConducts').slideUp(300); $('.conductLoader').fadeOut(1000);  /* hide page loader */	</script>";	 exit; 				
											
				}	


				if ($msg_e) {

					
					echo $errorMsg.$msg_e.$eEnd; 
					
					if($Cpage == $fiVal){
					
						echo "<script type='text/javascript'>  $('.step-one').trigger('click');    </script>"; exit;		
					
					}elseif($Cpage == $seVal){
					
						echo "<script type='text/javascript'>  $('#default-titles #default-title-1').trigger('click'); 
					    $('.conductLoader').fadeOut(1000);</script>"; exit;		
					
					}elseif($Cpage == $fifVal){
					
						echo "<script type='text/javascript'>  $('#default-title-3').trigger('click');  
						$('.conductLoader').fadeOut(1000); </script>"; exit;		
					
					}else{
						
						echo "<script type='text/javascript'>  $('#default-title-0').trigger('click'); 
						 $('.conductLoader').fadeOut(1000); </script>"; exit;			
						
					}
											
				}	
					
				exit;
		
		
		
		
		
		}else{
		
		
				echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
		
		
		}
			
exit;
?>