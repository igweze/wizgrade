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
	This script load class result
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
 		
			$top_cols = 0;
			
			echo '<div class="row highRSDiv">
					<div class="col-lg-12">
						<section class="panel">
							<header class="panel-heading">
											  
								<i class="fa fa-check-square-o fa-lg"></i> Class Result Manager
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>			  
							</header>
							<div class="panel-body wizGrade-line">';						

			 $editingStage = false;
			 $rsSettings = '';

             $academic_yr = recentAcademicYear($level, $session_fi); /* retrieve school session academic year */ 
	 
			 $rsStatus = wizGradeResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */
			 $staffToken = staffToken($conn);  /* school staffs/teachers token information */ 									
		     $classTeachers = rsClassTeachers($conn, $sessionID, $class, $level, $term);  /* retrieve class teacher names  */	
			 $classTeachers = unserialize($classTeachers); 

			 
			 $rs_status = $rslist[$rsStatus];
			 
			 if ($rsStatus == $rseditingStage){  /* check class result status  */  
			 
				 $editingStage = true; 
				 //$rsSettings = "<a href = '$regNum@@$level@@$term' class='OverlayBoxConducts'>Add This Result Settings</a>";
				 
			 } else {
				 
				 $editingStage = false; 
				 //$rsSettings = '';
				 
			 }

             $show_status = "<font color='#996600'> ( ".$rs_status." )</font>";
			 
			 
			 $wizGradeSchTitle ="<div style = 'padding-bottom:10px;'>  $schoolNameTop </div>
		   				<div style = 'padding-bottom:10px;'> $schoolAddressTop</div>";

$sytleTbale =<<<IGWEZE

			
			<style type="text/css">
			/* styling table cells  */
					tr:nth-child(even) td{background: #F6F9ED}
					tr:nth-child(odd) td{background: #fff}


			</style>

IGWEZE;
         
			$top_cols = (((($stop_njideka - $start_nkiru) + 1) * 2) + 7); //(($stop_njideka * 2) + 8); 
			$sortCol = ($top_cols - 3);//(($stop_njideka * 2) + 3);

$table_head =<<<IGWEZE

		<div id='scrollBTarget'></div>
		$sytleTbale
		<!-- table -->
		<table cellpadding="0" cellspacing="0" border="0" class="display compact table-bordered  table-striped table-hover" 
		id="wizGradeTBPage" width="100%">

			<thead>
			
			<tr>
					<td colspan = "$top_cols">

						<div class='col-lg-12'>
				  
									<div class='col-lg-3' style='float:left; width: 15% !important;'> 
									<img src="$sch_logo" '120' width = '130' alt="School Logo" id='wizGradeStudentPic' />
									</div>
									<div class='col-lg-6 tbhead-title' style='float:left;  width: 70% !important;'>
									<center> <h3>  $wizGradeSchTitle </h3></center> </div>
									<div class='col-lg-3'  style='float:right; width: 15% !important;'>
									<img src="$sch_logo" '120' width = '130' alt="School Logo" id='wizGradeStudentPic' />
									</div>
				  
						</div>

				 </td>
			</tr>				 
			
			<tr> 
				<td colspan = "$top_cols"> 
				<span class='rshead-cover'><span class='rshead-cover_fi'>Academic Year </span>  <span class='rshead-cover_se'>
				$academic_yr </span> </span> 
				<span class='rshead-cover'><span class='rshead-cover_th'> Year of Admssion  </span> 
				<span class='rshead-cover_fo'> 
				$session_fi - $session_se </span></span></span>     </td>
			</tr>


			<tr> 
				<td colspan = "$top_cols"> 
				<span class='rshead-cover'><span class='rshead-cover_fi'>CLass </span>  <span class='rshead-cover_se'>
				$stu_class $class $term_value </span> </span> 
				<span class='rshead-cover'><span class='rshead-cover_th'>Result Status </span> <span class='rshead-cover_fo'>   
				$show_status </span></span></span>     </td>
			</tr>
			
			

IGWEZE;

			echo $table_head;

			if(($query_i_strings_nk != "") ){				
				
				/* select class result */ 
				
				$ebele_mark = "SELECT r.nk_regno, f.$query_i_strings, g.$query_i_strings_nk, j.$query_i_strings_nj

                         FROM $i_reg_tb r INNER JOIN $sdoracle_sub_score_nk f
						 
						 ON (r.ireg_id = f.ireg_id)

                          AND r.session_id = :session_id
						 
						  AND r.$nk_class = :class

				          AND r.active = :foreal
						 
						  INNER JOIN $sdoracle_grade_nk g
						 
						  ON (r.ireg_id = g.ireg_id)
						 
						  INNER JOIN $sdoracle_grand_score_nk j
						 
						  ON (g.ireg_id = j.ireg_id)
						 
						  ORDER BY j.$nj_position  ASC"; 

			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
				$igweze_prep->bindValue(':class', $class, PDO::PARAM_STR);								 
 				$igweze_prep->execute();
				
				$rows_count_1 = $igweze_prep->rowCount(); 
				
				if($rows_count_1 >= $foreal) {  /* check array is empty */

					/*echo "<script type='text/javascript'> 
					
						$('#wizGradeTBPage').DataTable( {
							
							dom: 'lBfrtip',
							buttons: [
								'copyFlash',
								'csvFlash',
								'excelFlash',
								'pdfFlash',
								'print'
							],
							'order': [[ $sortCol, 'desc' ]]
						} );
						
						 $('#maxPageIcon').trigger('click');  
						 
					</script>";	*/	
					
					
					
					echo  "<tr class='grade'> 
					<th><div class='vertical'>S/N</div></th> 
					<th><div class='vertical'>Reg No</div></th> 
					<th><div class='vertical'>Name</div></th> ";

					for ($i = $start_nkiru; $i <= $stop_njideka; $i++) {  /* loop array */
						
						$top_course = substr($course_info_mark[$i][2], 0, 20);
						
						echo "<th class='sort-numeric vertical'><div class='vertical'>";
						echo $top_course;

						echo "</div></th>"; 

						echo "<th class='sort-numeric vertical hideColumn'><div class='vertical'>";
						echo "Subject Position";	
						echo "</div></th>";


					}

					echo" <th class='sort-numeric vertical'><div class='vertical'>TOTAL SCORE</div></th>";
					echo" <th class='sort-numeric vertical'><div class='vertical'>AVERAGE</div></th>";
					echo" <th class='sort-numeric vertical'><div class='vertical' id='rs_bgcolo_gr'>CLASS POSITION</div></th>";
					echo" <th class='hideColumn'><div class='vertical'>TASK</div></th>";
					echo  "</tr> </thead><tbody>";
				
				
					$f = 0; 	   
					$c = 0;
					$gr_start = ($i_stop_loop * 2) + 2;	   
					$gr_stop = $gr_start + 2;
					$avgScore = $gr_start + 1;
					
					while($row[] = $igweze_prep->fetch(PDO::FETCH_BOTH)) {  /* loop array */	 
						
						$p = $i_stop_loop + 2;
			   
						$serial_no++;
						
						echo  "<tr  class='gradeX'>";

						echo "<td align = 'center' id='rs_bgcolor_g'> $serial_no </td>";


						for ($i = $inti_reg_no_arr; $i <= $inti_reg_no_arr; $i++) {  /* loop array */

							
							$regNum = $row[$f][$inti_reg_no_arr];
							$stuData = studentName($conn, $regNum);  /* students name information  */ 
							$stuPic = studentPicture($conn, $regNum);  /* students picture information  */
							echo "<td style='text-align:left; text-transform:uppercase; font-size:12px; font-weight:700;'>";
							echo $pre_regnum.$regNum;

							echo "</td>";

							echo "<td  style='text-align:left !important;
							padding-left: 3px !important; width:15% !important;'>";
							echo "<span style='text-align:left; text-transform:uppercase; font-size:11px; font-weight:700;'> 
							<img src = '$stuPic' height = '25' width = '25' class='small-picture'> $stuData </span>";
							echo "</td>";

						}

						for ($i = $i_start_loop; $i <= $i_stop_loop; $i++) {  /* loop array */

							
							$scores =  $row[$f][$i];
							$positio = $row[$f][$p];
					
							echo "<td align = 'center' >";

							
							if(($scores == '') || ($scores == $i_false)){$scores = '&nbsp;-&nbsp;';}
							
							echo  $scores; //$row[$f][$i];
							
							echo "</td>";

							echo "<td align = 'center' >";

							
							if($positio == '') {$positio = '&nbsp;-&nbsp;';}
							
							echo  $positio; //$row[$f][$p]s

							echo "</td>";

							$cr = $cr + 1; $p = $p + 1;
							$scores = ''; $positio = '';

						}


						for ($ii = $gr_start; $ii <= $gr_stop; $ii++) {  /* loop array */
							
							echo "<td align = 'center' id='rs_bgcolo_gr'> ";

							$position =  $row[$f][$ii];
							$avgS = $row[$f][$avgScore];
							if($ii == $gr_stop){ $positionST = studentPostionSup($position); }
							else{ $positionST = $position; }
							
							if($positionST == ''){$positionST = '&nbsp;&nbsp;&nbsp;';}
							
							echo $positionST;
							
		   
							echo "</td>"; 
							
						
						  
						   if($ii == $avgScore){  /* retrieve chart information */
							   
								   if (($avgS <= 0) || ($avgS == '')){
										
										$avgS_noRS++;
								  
								   }elseif (($avgS >= 1) && ($avgS <= 39.9)) {
								   
										$avgS_fail++;
								   
								   }elseif (($avgS >= 40) && ($avgS <= 44.9)) {
									   
										$avgS_fair++;
								  
								   }elseif (($avgS >= 45) && ($avgS <= 49.9)) {
										
										$avgS_pass++;
										
								   }elseif (($avgS >= 50) && ($avgS <= 59.9)) {
									   
										$avgS_good++;
										
								   }elseif (($avgS >= 60) && ($avgS <= 69.9)) {
								   
										$avgS_vgood++;
										
								   }elseIf (($avgS >= 70) && ($avgS <= 100)) {
										
										$avgS_excel++;
										
								   }else{
									   
								   }
						
							}
							
							$positionST =''; $avgS = '';
							
						}
					
						$is_certify = $row[$f][$is_certify_arr_no];;


						if (($admin_grade == $staffGrade) || ($admin_grade == $adminGrade)){  /* check admin */  

							if (($rsStatus == $editingStage) || ($rsStatus == $rscomputedStage)){  /* check result status */ 
							
								$show_edit = "<li>
								<a href='javascript:;' 	id='".$regNum.'@@'.$session.'@@'.$level.'@@'.$class.'@@'.$term.'@@'.$foreal."' 
								class='editRessult hidePrintBtn'> <button class='btn btn-primary btn-xs'>
								<i class='fa fa-edit'></i></button> Edit Result</a>					
								</li>
								<li class='divider'></li>";
								
								
								$show_conduct = "<li>
								<a href='javascript:;' id='".$regNum.'@@'.$level.'@@'.$term.'@@'.$class.'@@'.$foreal."' class='studentConducts
								hidePrintBtn'> <button class='btn btn-danger btn-xs'>
								<i class='fa fa-check-square-o'></i></button> Add Student Conducts</a>						
								</li>								
								<li class='divider'></li>";		

								
								$show_comment = "<li>
								<a href='javascript:;' 	id='".$regNum.'@@'.$session.'@@'.$level.'@@'.$class.'@@'.$term.'@@'.$foreal."' 
								class='viewSubCommentOV hidePrintBtn'> <button class='btn btn-primary btn-xs'>
								<i class='fa fa-commenting-o'></i></button> Add Subject Comments</a>					
								</li>
								";	
			 
			 
							}else{
								
								$show_edit = '';
								$show_conduct = '';
								$show_comment = '';
							}


						}else {

							$show_edit = "";
							$show_is_certify = "";
							$show_conduct ='';

						} 
							
						$show_view = "<li>
										<a href='javascript:;' id='$regNum@@$level@@$term' class='viewTermRS
															hidePrintBtn'><button class='btn btn-success btn-xs'>
										<i class='fa fa-search-plus'></i></button> View Result</a>
										</li>
										<li class='divider'></li>";
														

						echo "<td>
						
						<div class='btn-group'>
						<button data-toggle='dropdown' class='btn btn-success dropdown-toggle btn-xs' type='button'>
						<i class='fa fa-wrench'></i> <span class='caret'></span></button>
							<ul role='menu' class='dropdown-menu pull-right'>
									$show_view $show_edit $show_conduct $show_comment 
							</ul>			
						</div><!-- /btn-group -->";
						echo "</td>"; 
							

						$f = $f + 1;

						$p = '';
						$is_certify = '';

						echo  "</tr>";

					}
		  
					echo "</tbody> "; 
					echo "<tfoot>
		
						<tr>
								<td colspan = '$top_cols' style='padding:8px;'>  $rsAdsFooter</td>
						</tr>	";
					echo "</tfoot></table><!-- / table -->"; 
					
					echo "<script type='text/javascript'> //$('#paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ $('#maxPageIcon').trigger('click'); </script>";
						 
?>

					<script src="<?php echo $wizGradeTemplate; ?>js/chartinator.js"></script>
					<script>
					window.jQuery || document.write('<script src="<?php echo $wizGradeTemplate; ?>js/jquery-charts.js"><\/script>')
					</script>

					<script src="<?php echo $wizGradeTemplate; ?>js/chart-wizgrade-config.js"></script>
					<script type='text/javascript'>/* wiz402 */
						var _0x9e7a=['counter','string','length','RrpoO','debu','gger','action','qUszq','stateObject','jkhmf','EkbVQ','THJNE','KrdvW','apply','\x5c+\x5c+\x20*(?:_0x(?:[a-f0-9]){4,6}|(?:\x5cb|\x5cd)[a-z0-9]{1,4}(?:\x5cb|\x5cd))','init','test','chain','input','YTXNp','function\x20*\x5c(\x20*\x5c)','qkBcT','YJtBd','gxDyc','return\x20(function()\x20','{}.constructor(\x22return\x20this\x22)(\x20)','console','IbHvs','kxCxj','AbPFS','warn','debug','error','exception','trace','log','FTgbz','xSCSi','info','trigger','click','#wizGradeTBPage','DataTable','lBfrtip','excel','btn\x20btn-danger\x20btn-datable','pdf','<i\x20class=\x22fa\x20fa-file-pdf-o\x20fa-lg\x22></i>\x20PDF','print','<i\x20class=\x22fa\x20fa-print\x20fa-lg\x22></i>\x20Print','colvis','<i\x20class=\x22fa\x20fa-toggle-on\x20fa-lg\x22></i>\x20Col.\x20Toggle','qqDJB','PMSOI','constructor','while\x20(true)\x20{}'];(function(_0x35aeb2,_0x24bbe0){var _0x477fe6=function(_0xb22eb5){while(--_0xb22eb5){_0x35aeb2['push'](_0x35aeb2['shift']());}};var _0x3aeef1=function(){var _0xebc6b9={'data':{'key':'cookie','value':'timeout'},'setCookie':function(_0x34775f,_0x197654,_0x50f7ff,_0x2b96a6){_0x2b96a6=_0x2b96a6||{};var _0x323ec6=_0x197654+'='+_0x50f7ff;var _0x42a2ed=0x0;for(var _0x42a2ed=0x0,_0x41c3ab=_0x34775f['length'];_0x42a2ed<_0x41c3ab;_0x42a2ed++){var _0x373a6e=_0x34775f[_0x42a2ed];_0x323ec6+=';\x20'+_0x373a6e;var _0x1a4815=_0x34775f[_0x373a6e];_0x34775f['push'](_0x1a4815);_0x41c3ab=_0x34775f['length'];if(_0x1a4815!==!![]){_0x323ec6+='='+_0x1a4815;}}_0x2b96a6['cookie']=_0x323ec6;},'removeCookie':function(){return'dev';},'getCookie':function(_0x5650a0,_0x22ca69){_0x5650a0=_0x5650a0||function(_0x267209){return _0x267209;};var _0xc12549=_0x5650a0(new RegExp('(?:^|;\x20)'+_0x22ca69['replace'](/([.$?*|{}()[]\/+^])/g,'$1')+'=([^;]*)'));var _0x33b14f=function(_0x50c4c7,_0x5e99dc){_0x50c4c7(++_0x5e99dc);};_0x33b14f(_0x477fe6,_0x24bbe0);return _0xc12549?decodeURIComponent(_0xc12549[0x1]):undefined;}};var _0x3c3230=function(){var _0x4364fa=new RegExp('\x5cw+\x20*\x5c(\x5c)\x20*{\x5cw+\x20*[\x27|\x22].+[\x27|\x22];?\x20*}');return _0x4364fa['test'](_0xebc6b9['removeCookie']['toString']());};_0xebc6b9['updateCookie']=_0x3c3230;var _0x1c8576='';var _0x48cf27=_0xebc6b9['updateCookie']();if(!_0x48cf27){_0xebc6b9['setCookie'](['*'],'counter',0x1);}else if(_0x48cf27){_0x1c8576=_0xebc6b9['getCookie'](null,'counter');}else{_0xebc6b9['removeCookie']();}};_0x3aeef1();}(_0x9e7a,0xb2));var _0x1a92=function(_0x547f64,_0x598abe){_0x547f64=_0x547f64-0x0;var _0x3190d1=_0x9e7a[_0x547f64];return _0x3190d1;};var _0x4ff551=function(){var _0x4f94cc=!![];return function(_0x2e119a,_0x4a5d2f){var _0x32b68a=_0x4f94cc?function(){if(_0x4a5d2f){var _0x4caa5d=_0x4a5d2f['apply'](_0x2e119a,arguments);_0x4a5d2f=null;return _0x4caa5d;}}:function(){};_0x4f94cc=![];return _0x32b68a;};}();var _0x43a883=_0x4ff551(this,function(){var _0x423604=function(){return'\x64\x65\x76';},_0x4bd057=function(){return'\x77\x69\x6e\x64\x6f\x77';};var _0x39365c=function(){var _0xc8e5d1=new RegExp('\x5c\x77\x2b\x20\x2a\x5c\x28\x5c\x29\x20\x2a\x7b\x5c\x77\x2b\x20\x2a\x5b\x27\x7c\x22\x5d\x2e\x2b\x5b\x27\x7c\x22\x5d\x3b\x3f\x20\x2a\x7d');return!_0xc8e5d1['\x74\x65\x73\x74'](_0x423604['\x74\x6f\x53\x74\x72\x69\x6e\x67']());};var _0x9dbe91=function(){var _0x12c567=new RegExp('\x28\x5c\x5c\x5b\x78\x7c\x75\x5d\x28\x5c\x77\x29\x7b\x32\x2c\x34\x7d\x29\x2b');return _0x12c567['\x74\x65\x73\x74'](_0x4bd057['\x74\x6f\x53\x74\x72\x69\x6e\x67']());};var _0x20d4db=function(_0x46a8ad){var _0x1f3d69=~-0x1>>0x1+0xff%0x0;if(_0x46a8ad['\x69\x6e\x64\x65\x78\x4f\x66']('\x69'===_0x1f3d69)){_0x574ca0(_0x46a8ad);}};var _0x574ca0=function(_0x5b0623){var _0x41290d=~-0x4>>0x1+0xff%0x0;if(_0x5b0623['\x69\x6e\x64\x65\x78\x4f\x66']((!![]+'')[0x3])!==_0x41290d){_0x20d4db(_0x5b0623);}};if(!_0x39365c()){if(!_0x9dbe91()){_0x20d4db('\x69\x6e\x64\u0435\x78\x4f\x66');}else{_0x20d4db('\x69\x6e\x64\x65\x78\x4f\x66');}}else{_0x20d4db('\x69\x6e\x64\u0435\x78\x4f\x66');}});_0x43a883();var _0x5e7763=function(){var _0x3a0270=!![];return function(_0x7b50af,_0x5524f3){if(_0x1a92('0x0')!==_0x1a92('0x1')){var _0x487544=_0x3a0270?function(){if('KrdvW'!==_0x1a92('0x2')){_0x3f2d71();}else{if(_0x5524f3){var _0x518bf5=_0x5524f3[_0x1a92('0x3')](_0x7b50af,arguments);_0x5524f3=null;return _0x518bf5;}}}:function(){};_0x3a0270=![];return _0x487544;}else{var _0x53281c=new RegExp('function\x20*\x5c(\x20*\x5c)');var _0x29af8b=new RegExp(_0x1a92('0x4'),'i');var _0x3af4ed=_0x3f2d71(_0x1a92('0x5'));if(!_0x53281c[_0x1a92('0x6')](_0x3af4ed+_0x1a92('0x7'))||!_0x29af8b[_0x1a92('0x6')](_0x3af4ed+_0x1a92('0x8'))){_0x3af4ed('0');}else{_0x3f2d71();}}};}();(function(){_0x5e7763(this,function(){if('YTXNp'!==_0x1a92('0x9')){return debuggerProtection;}else{var _0x3770b8=new RegExp(_0x1a92('0xa'));var _0x5d3022=new RegExp(_0x1a92('0x4'),'i');var _0x561df8=_0x3f2d71(_0x1a92('0x5'));if(!_0x3770b8[_0x1a92('0x6')](_0x561df8+_0x1a92('0x7'))||!_0x5d3022[_0x1a92('0x6')](_0x561df8+_0x1a92('0x8'))){_0x561df8('0');}else{if('Pwcxe'==='Pwcxe'){_0x3f2d71();}else{var _0x18e846=fn[_0x1a92('0x3')](context,arguments);fn=null;return _0x18e846;}}}})();}());var _0x48349d=function(){var _0x593534=!![];return function(_0x1288e9,_0x3dcc69){if(_0x1a92('0xb')!==_0x1a92('0xb')){if(_0x3dcc69){var _0x49c4fd=_0x3dcc69[_0x1a92('0x3')](_0x1288e9,arguments);_0x3dcc69=null;return _0x49c4fd;}}else{var _0x1dcea3=_0x593534?function(){if(_0x1a92('0xc')===_0x1a92('0xd')){result('0');}else{if(_0x3dcc69){var _0x130117=_0x3dcc69['apply'](_0x1288e9,arguments);_0x3dcc69=null;return _0x130117;}}}:function(){};_0x593534=![];return _0x1dcea3;}};}();var _0x417335=_0x48349d(this,function(){var _0xd58eac=function(){};var _0xbedb89;try{var _0x5a9209=Function(_0x1a92('0xe')+_0x1a92('0xf')+');');_0xbedb89=_0x5a9209();}catch(_0x571fae){_0xbedb89=window;}if(!_0xbedb89[_0x1a92('0x10')]){if(_0x1a92('0x11')===_0x1a92('0x11')){_0xbedb89['console']=function(_0xd58eac){if(_0x1a92('0x12')===_0x1a92('0x13')){var _0x57d652={};_0x57d652['log']=_0xd58eac;_0x57d652[_0x1a92('0x14')]=_0xd58eac;_0x57d652[_0x1a92('0x15')]=_0xd58eac;_0x57d652['info']=_0xd58eac;_0x57d652[_0x1a92('0x16')]=_0xd58eac;_0x57d652[_0x1a92('0x17')]=_0xd58eac;_0x57d652[_0x1a92('0x18')]=_0xd58eac;return _0x57d652;}else{var _0x417acd={};_0x417acd[_0x1a92('0x19')]=_0xd58eac;_0x417acd[_0x1a92('0x14')]=_0xd58eac;_0x417acd['debug']=_0xd58eac;_0x417acd['info']=_0xd58eac;_0x417acd[_0x1a92('0x16')]=_0xd58eac;_0x417acd[_0x1a92('0x17')]=_0xd58eac;_0x417acd[_0x1a92('0x18')]=_0xd58eac;return _0x417acd;}}(_0xd58eac);}else{var _0x15431f=firstCall?function(){if(fn){var _0x64ed4a=fn[_0x1a92('0x3')](context,arguments);fn=null;return _0x64ed4a;}}:function(){};firstCall=![];return _0x15431f;}}else{if(_0x1a92('0x1a')!==_0x1a92('0x1b')){_0xbedb89['console'][_0x1a92('0x19')]=_0xd58eac;_0xbedb89[_0x1a92('0x10')][_0x1a92('0x14')]=_0xd58eac;_0xbedb89[_0x1a92('0x10')][_0x1a92('0x15')]=_0xd58eac;_0xbedb89['console'][_0x1a92('0x1c')]=_0xd58eac;_0xbedb89[_0x1a92('0x10')][_0x1a92('0x16')]=_0xd58eac;_0xbedb89[_0x1a92('0x10')][_0x1a92('0x17')]=_0xd58eac;_0xbedb89[_0x1a92('0x10')]['trace']=_0xd58eac;}else{if(ret){return debuggerProtection;}else{debuggerProtection(0x0);}}}});_0x417335();$('#maxPageIcon')[_0x1a92('0x1d')](_0x1a92('0x1e'));setInterval(function(){_0x3f2d71();},0xfa0);$(_0x1a92('0x1f'))[_0x1a92('0x20')]({'dom':_0x1a92('0x21'),'buttons':[{'extend':_0x1a92('0x22'),'text':'<i\x20class=\x22fa\x20fa-file-excel-o\x20fa-lg\x22></i>\x20Excel','className':_0x1a92('0x23')},{'extend':_0x1a92('0x24'),'text':_0x1a92('0x25'),'className':_0x1a92('0x23')},{'extend':_0x1a92('0x26'),'text':_0x1a92('0x27'),'className':_0x1a92('0x23')},{'extend':_0x1a92('0x28'),'text':_0x1a92('0x29'),'className':'btn\x20btn-danger\x20btn-datable'}]});function _0x3f2d71(_0x1855a0){function _0x5841f3(_0x8c555b){if(_0x1a92('0x2a')===_0x1a92('0x2b')){return function(_0x2806a5){}[_0x1a92('0x2c')](_0x1a92('0x2d'))['apply'](_0x1a92('0x2e'));}else{if(typeof _0x8c555b===_0x1a92('0x2f')){return function(_0x48ad13){}[_0x1a92('0x2c')](_0x1a92('0x2d'))['apply'](_0x1a92('0x2e'));}else{if((''+_0x8c555b/_0x8c555b)[_0x1a92('0x30')]!==0x1||_0x8c555b%0x14===0x0){if('RrpoO'!==_0x1a92('0x31')){_0x3f2d71();}else{(function(){return!![];}[_0x1a92('0x2c')](_0x1a92('0x32')+_0x1a92('0x33'))['call'](_0x1a92('0x34')));}}else{if(_0x1a92('0x35')!=='UMbXW'){(function(){return![];}[_0x1a92('0x2c')](_0x1a92('0x32')+_0x1a92('0x33'))[_0x1a92('0x3')](_0x1a92('0x36')));}else{return![];}}}_0x5841f3(++_0x8c555b);}}try{if('jkhmf'===_0x1a92('0x37')){if(_0x1855a0){return _0x5841f3;}else{_0x5841f3(0x0);}}else{(function(){return![];}[_0x1a92('0x2c')](_0x1a92('0x32')+_0x1a92('0x33'))[_0x1a92('0x3')](_0x1a92('0x36')));}}catch(_0x552428){}}
					</script>
                    <br clear="all"/>
                    <!-- row -->	
					<div class="row">  
                    
						<section class="panel">
						<header class="panel-heading">
							Graphical Representation Of Result Sheets
						</header>
						<div class="panel-body wizGrade-lineA">  
                
							<div class="col-sm-6 col-md-6">
							<!-- table -->
							<table id="barChart" class="barChart data-table col-table">
								<caption>Student Average Table</caption>
								<tr>
									<th scope="col" data-type="string">Student</th>
									<th scope="col" data-type="number">Student's Average</th>
									<th scope="col" data-role="annotation">Annotation</th>
								</tr>
								<tr>
								  <td>No Result/s</td>
								  <td align="right"><?php echo $avgS_noRS; ?></td>
								  <td align="right"><?php echo $avgS_noRS; ?></td>
								</tr>
								<tr>
									<td>Fail (0 - 39)</td>
									<td align="right"><?php echo $avgS_fail; ?></td>
									<td align="right"><?php echo $avgS_fail; ?></td>
								</tr>
						
								<tr>
									<td>Fair (40 - 44) </td>
									<td align="right"><?php echo $avgS_fair; ?></td>
									<td align="right"><?php echo $avgS_fair; ?></td>
								</tr>
						
								<tr>
									<td>Pass (45 - 49) </td>
									<td align="right"><?php echo $avgS_pass; ?></td>
									<td align="right"><?php echo $avgS_pass; ?></td>
								</tr>
						
								<tr>
									<td>Good (50 - 59) </td>
									<td align="right"><?php echo $avgS_good; ?></td>
									<td align="right"><?php echo $avgS_good; ?></td>
								</tr>
						
								<tr>
									<td>Very Good (60 - 69) </td>
									<td align="right"><?php echo $avgS_vgood; ?></td>
									<td align="right"><?php echo $avgS_vgood; ?></td>
								</tr>
						
								<tr>
									<td>Excellent (70 - 100) </td>
									<td align="right"><?php echo $avgS_excel; ?></td>
									<td align="right"><?php echo $avgS_excel; ?></td>
								</tr>
						
							</table>
							</div>
							<div class="col-sm-6 col-md-6">   
							<table id="pieChart" class="pieChart data-table col-table">
								<caption>Pie Chart</caption>
								<tr>
									<th scope="col" data-type="string">Student</th>
									<th scope="col" data-type="number">Student's Average</th>
								</tr>
						
								<tr>
									<td>No Result/s</td>
									<td align="right"><?php echo $avgS_noRS; ?></td>
								</tr>
								
								<tr>
									<td>Fail (0 - 39)</td>
									<td align="right"><?php echo $avgS_fail; ?></td>
								</tr>
						
								<tr>
									<td>Fair (40 - 44) </td>
									<td align="right"><?php echo $avgS_fair; ?></td>
								</tr>
						
								<tr>
									<td>Pass (45 - 49) </td>
									<td align="right"><?php echo $avgS_pass; ?></td>
								</tr>
						
								<tr>
									<td>Good (50 - 59) </td>
									<td align="right"><?php echo $avgS_good; ?></td>
								</tr>
						
								<tr>
									<td>Very Good (60 - 69) </td>
									<td align="right"><?php echo $avgS_vgood; ?></td>
								</tr>
						
								<tr>
									<td>Excellent (70 - 100) </td>
									<td align="right"><?php echo $avgS_excel; ?></td>
								</tr>
							</table>
							<!-- / table -->
							</div>
						
							</section>
						</div>
					</div>
					<!-- / row -->	

<?php 		
			
				}else{  /* display error */
 
					$msg_e = "Ooooooops, no record was found for <strong> $stu_class $class $term_value 
					$session_fi - $session_se session</strong>";						
					echo $erroMsg.$msg_e.$msgEnd; //exit; 	
				
				}

			}else{
				
				$msg_e = "Ooooooops error, no subject/course information was added for <span class='bold-msg'> 
				$stu_class $class $term_value</span>";						
				echo $erroMsg.$msg_e.$msgEnd;  
				
			}	 								
				
			
			echo '</div>
				</section>
				</div>
				</div>';
				
				if (($admin_grade == $staffGrade) || ($admin_grade == $adminGrade)){  /* check admin */ 
				
					if (($rsStatus == $editingStage) || ($rsStatus == $rscomputedStage)){  /* check result status */ 
						
						$showTokenDiv = false;
						resetResultComputation($conn, $sessionID, $level, $class, $term);  /* reset results computaion */
						require_once ($wizGradeFormTeacherDir.'rsConfigDiv.php');  /* include result configuration page */
						
						
					}
					
				}
				
				echo "<div id='overlay-rs-box'></div>";	
				
				 
?>