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
	This page export class result for auto result scanning
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		

?>
			<script type='text/javascript'>   $(".excelExIcon").fadeIn(100); $('#maxPageIcon').trigger('click'); </script>

							

<?php 		 
 
			$academic_yr = recentAcademicYear($level, $session_fi);  /* school session academic year  */   

			$wizGradeSchTitle ="<div style = 'padding-bottom:10px;'>  $schoolNameTop </div>
								<div style = 'padding-bottom:10px;'> $schoolAddressTop</div>";  

$table_head =<<<IGWEZE

				<!-- table -->
				<table cellpadding="0" cellspacing="0" border="0" class="displ compact table-bordered 
					table-striped table-hover" id="wizGradeTBPage" width="100%">
				<thead> 
				
				<tr> 
				<th colspan = "13"> 
				<span class='rshead-cover'><center> $academic_yr Session Class $stu_class $class </center></span>     		
				</th>

				</tr> 

IGWEZE;


				$ebele_mark = "SELECT nk_regno 

							FROM $i_reg_tb WHERE

							session_id = :session_id
						 
							AND $nk_class = :class

							AND active = :foreal"; 

			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);								 
 				$igweze_prep->execute();
				
				$rows_count_1 = $igweze_prep->rowCount(); 
				
				if($rows_count_1 >= $foreal) {  /* check array is empty */ 
		  		
					echo $table_head; 
					
					echo  "<tr class='grade'> 
					<th style='text-align:center !important;'>S/N</th> 
					
					<th style='text-align:left !important; padding-left: 2% !important;'>Name</th>
					
					<th style='text-align:left !important; padding-left: 2% !important;'  width='15%'>Reg No</th>
					
					<th style='text-align:center !important;'> R. <br />TEST <br /> 5% </th>
					
					<th style='text-align:center !important;'> 1st <br />ASSIT <br /> 5% </th>
					
					<th style='text-align:center !important;'> MID <br />TEST <br /> 10% </th>
					
					<th style='text-align:center !important;'> PRO <br /> JECT   <br /> 10% </th>
					
					<th style='text-align:center !important;'> 2nd <br />W. TEST<br /> 5% </th>
					
					<th style='text-align:center !important;'> 2nd  <br />ASSIT <br /> 5%  </th>
					
					<th style='text-align:center !important;'> TOTAL  <br /> 40% </th>
					
					<th style='text-align:center !important;'> EXAM  <br /> 60%  </th>
					
					<th style='text-align:center !important;'> G <br /> TOTATL  <br /> 100%  </th>
					
					<th style='text-align:left !important; padding-left: 2% !important;' width='15%'> REMARKS </th>"; 
          			
          			echo  "</tr> </thead><tbody>"; 
				
					$f = 0; 	   
			    	$c = 0;
	   				$gr_start = ($i_stop_loop * 2) + 2;	   
	   				$gr_stop = $gr_start + 2;
					
					while($row = $igweze_prep->fetch(PDO::FETCH_BOTH)) {  /* loop array */	 
	   	   
						$serial_no++;  

						echo  "<tr  class='gradeX'>";
						echo "<td style='text-align:left !important; padding-left: 2% !important;'> $serial_no </td>";  
						
						$regNum = $row['nk_regno'];
						$stuData = studentName($conn, $regNum);
						$stuPic = studentPicture($conn, $regNum); 

						echo "<td style='text-align:left !important; padding-left: 2% !important;' width='20%'>";
						echo "<span style='text-align:left; text-transform:uppercase; font-size:12px; font-weight:700;'> 
						
								 $stuData </span>";

						echo "</td>"; 

						echo "<td style='text-align:left !important; padding-left: 2% !important;' width='5%'>";
						echo $pre_regnum.$regNum;
						echo "</td>"; 
						
						echo "<td style='text-align:left !important; padding-left: 2% !important;'> &nbsp;&nbsp;</td>
			
						<td style='text-align:left !important; padding-left: 2% !important;'>&nbsp;&nbsp;</td>
						
						<td style='text-align:left !important; padding-left: 2% !important;'>&nbsp;&nbsp;</td>
						
						<td style='text-align:left !important; padding-left: 2% !important;'> &nbsp;&nbsp;</td>
						
						<td style='text-align:left !important; padding-left: 2% !important;'>&nbsp;&nbsp;</td>
						
						<td style='text-align:left !important; padding-left: 2% !important;'> &nbsp;&nbsp;</td>
						
						<td style='text-align:left !important; padding-left: 2% !important;'> &nbsp;&nbsp;</td>
						
						<td style='text-align:left !important; padding-left: 2% !important;'> &nbsp;&nbsp;</td>
						
						<td style='text-align:left !important; padding-left: 2% !important;'> &nbsp;&nbsp;</td>
						
						<td style='text-align:left !important; padding-left: 2% !important;'> &nbsp;&nbsp;</th>"; 
   
						echo  "</tr>"; 

					} 
      
       				echo "</tbody></table>";
					echo $infoAdsMsg.$rsAutoFooter.$msgEnd; 


$table_head =<<<IGWEZE
	 		
				<div class="row text-right" >
                  <div class="col-sm-6">
                      <section class="panel">
                           
                          <div class="panel-body">
							<!-- table -->
							<table width="30%"   class=" table-striped" >
									<tr>
									<th width='5%' style='text-align:left; padding3px; font-weight:bold; font-size:24;''>Subject </th>
									<td width='15%' style='text-align:left; padding-left:10px; font-weight:bold; border-bottom-color:#000;'>
									____________________________________</td>
									
									</tr>
									<tr>
									<th width='5%' style='text-align:left; padding:3px; font-weight:bold; font-size:24;''>Name </th>
									<td width='15%' style='text-align:left; padding-left:10px; font-weight:bold; border-bottom-color:#000;'>
									____________________________________</td>
									
									</tr>
									<tr>
									<th width='5%' style='text-align:left; padding:3px; font-weight:bold; font-size:24;''>Signature</th>
									<td width='15%' style='text-align:left; padding-left:10px; font-weight:bold'>
									____________________________________</td>
									</tr>
									<tr>
									<th width='5%' style='text-align:left; padding:3px; font-weight:bold; font-size:24;'>Date</th>
									<td width='15%' style='text-align:left; padding-left:10px; font-weight:bold; border-bottom-color:#000;'>
									____________________________________</td>
									</tr> 
									 
							</table>
							<!-- / table -->
							
						</div>
                      </section>
					</div> 

IGWEZE;

					echo $table_head; 
						
			
				}else{  /* display error */ 

					$msg_e = "Ooooooops, no record was found for <span class='bold-msg'> $stu_class $class $term_value 
					$session_fi - $session_se session</span>";
					echo $erroMsg.$msg_e.$msgEnd; 
					echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ </script>"; exit; 	
					
				} 

				echo "<div id='overlay-rs-box'></div>";	 
			
?>