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
	This page export class result
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		//require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */

?>

			<script type='text/javascript'>   $(".excelExIcon").fadeIn(100); $('#maxPageIcon').trigger('click'); </script> 

<?php 
			
				$academic_yr = recentAcademicYear($level, $session_fi);  /* school session academic year  */   

				$wizGradeSchTitle ="<div style = 'padding-bottom:10px;'>  $schoolNameTop </div>
									<div style = 'padding-bottom:10px;'> $schoolAddressTop</div>"; 
		
				$top_cols = ($stop_njideka + 3);
		

       

$table_head =<<<IGWEZE


				<!-- table -->

				<table cellpadding="0" cellspacing="0" border="0" class="display compact table-bordered 
				table-striped table-hover" id="wizGradeTBPage" width="100%">

				<thead>
			
			      <tr>
					<th colspan = "$top_cols">
					
						<div class='col-lg-12'>
	  
	  					<div class='col-lg-3' style='float:left'> 
						<img src="$sch_logo" '120' width = '130' alt="School Logo" id='wizGradeStudentPic' />
						</div>
	  					<div class='col-lg-6 tbhead-title' style='float:left;'>
						<center> <h3> $wizGradeSchTitle </h3></center> </div>
	  					<div class='col-lg-3'  style='float:right'>
						<img src="$sch_logo" '120' width = '130' alt="School Logo" id='wizGradeStudentPic' />
						</div>
	  
	  	    			</div>

				 </th>

				 </tr> 

				<tr> 
				<th colspan = "$top_cols"> 
				<span class='rshead-cover'><center> $academic_yr Session Class $stu_class $class $term_value Result Sheet</center></span>     		
				</th>

				</tr>
			
			

IGWEZE;

 
				$ebele_mark = "SELECT r.nk_regno, f.$query_i_scores

							FROM $i_reg_tb r INNER JOIN $sdoracle_score_nk f
						 
							ON (r.ireg_id = f.ireg_id)

							AND r.session_id = :session_id
						 
							AND r.$nk_class = :class

							AND r.active = :foreal";						 

			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);								 
 				$igweze_prep->execute();
				
				$rows_count_1 = $igweze_prep->rowCount(); 
				
				if($rows_count_1 >= $foreal) {  /* check array is empty */ 
		  		
					echo $table_head; 

					echo  "<tr class='grade'> 
					<th class='vertical'><div class='vertical'>S/N</th> 
					
					<th align = 'left'>Name</th>
					
					<th align = 'left'  width='20%'>Reg No</th>  ";

					for ($i = $start_nkiru; $i <= $stop_njideka; $i++) {  /* loop array */

						echo "<th align = 'center' class='sort-numeric'><div class='rotate'>";
						echo $course_info_mark[$i][1];

						echo "</div></th>";  

					} 
					
          			echo  "</tr> </thead><tbody>"; 
				
					$f = 0; 	   
			    	$c = 0;
	   				$gr_start = ($i_stop_loop * 2) + 2;	   
	   				$gr_stop = $gr_start + 2;
					
					while($row[] = $igweze_prep->fetch(PDO::FETCH_BOTH)) {  /* loop array */	 
			  		
						$p = $i_stop_loop + 2;
	   	   
						$serial_no++; 

						echo  "<tr  class='gradeX'>";
	   
						echo "<td align = 'center'> $serial_no </td>"; 

       					for ($i = $inti_reg_no_arr; $i <= $inti_reg_no_arr; $i++) {  /* loop array */

       						
							$regNum = $row[$f][$inti_reg_no_arr];
							$stuData = studentName($conn, $regNum);
							$stuPic = studentPicture($conn, $regNum);

							echo "<td align = 'left' style='text-align:left !important;
							padding-left: 3px !important;' width='20%'>";
	   						echo "<span style='text-align:left; text-transform:uppercase; font-size:12px; font-weight:700;'> 
							
									<img src = '$stuPic' height = '25' width = '25' class='small-picture'> $stuData </span>";

       						echo "</td>";


							echo "<td align = 'left' style='text-align:left !important;
							padding-left: 3px !important;text-transform:uppercase;  font-weight:700;' width='5%'>";
	   						echo $pre_regnum.$regNum;
       						echo "</td>";

       					}

       					for ($i = $i_start_loop; $i <= $i_stop_loop; $i++) {  /* loop array */
	   
       						
							$scores =  $row[$f][$i];
							
							if($_REQUEST['blank'] == true){ $scores = '';}
					
							echo "<td align = 'center'>";
       						
							if($scores == '') {$scores = '&nbsp;&nbsp;-&nbsp;&nbsp;';}
							
							echo  $scores; //$row[$f][$i];
	   						
       						echo "</td>";


       						$cr = $cr + 1;
							$scores = '';
	   
       				   }


					
						$is_certify = $row[$f][$is_certify_arr_no];;

							

       					$f = $f + 1;
 
	   					$p = '';
						$is_certify = '';
	   
	   					echo  "</tr>";


					} 
      
       				echo "</tbody></table><!-- /table -->";echo '<br clear="all" />';
	   				echo $sdo_tb_footer;
					echo '<br clear="all" />';  
			
				}else{  /* display error */ 

					$msg_e = "Ooooooops, no record was found for <span class='bold-msg'> $stu_class $class $term_value 
					$session_fi - $session_se session</span>";						
					echo $erroMsg.$msg_e.$msgEnd; 
					echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ </script>"; exit; 	
				} 

				echo "<div id='overlay-rs-box'></div>";	 
			
?>