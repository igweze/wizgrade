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
	This script handle class annual transcript
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
?>		

		<div class="col-sm-12">
			<section class="panel">
			<header class="panel-heading">
			Student's Annual Result
			</header>
			<div class="panel-body" id="promotionDiv">
						  
<?php
				$msg_i = "Click on any Student Term Total, Average or Position to view student termly result. 
				Meanwhile, you can also click on Annual Total, Average or Position to view student annual result";
				echo $infMsg.$msg_i.$msgEnd; 
			
				$rsStatus = wizGradeResultStatus($conn, $sessionID, $class, $level, $term);	 /* student result status */ 

				$wizGradeSchTitle ="<div style = 'padding-bottom:10px;'>  $schoolNameTop </div>
		   				<div style = 'padding-bottom:10px;'> $schoolAddressTop</div>";
						
				if($rsStatus != $rspublishStage){  /* if result has not been published */ 
				
					echo "<script type='text/javascript'> $('#maxPageIcon').trigger('click');   </script>";	 

					$actionSel .= ' 
					<select class="form-control"  id="rollTask" name="rollTask">

					<option value = "1">Select Action </option>';

					foreach($promotionArr as $p_key => $p_value){  /* loop array */

						$actionSel .= '<option value="'.$p_key.'"'.$selected.'>'.$p_value.'</option>' ."\r\n";

					}			

					$actionSel .= '</select>';

					$promTop = '<!-- form --><form class="form-horizontal" id="frmsaveClassPromotion" role="form">	 

					<button  class="btn btn-danger saveClassPromotion pull-right">
					<i class="fa fa-save"></i> Effect Promotion </button> 
					<br clear="all" /><br clear="all" />
					<input type="hidden" value="'.$level.'" name="level" />
					<input type="hidden" value="effectPromotion" name="classData" />';

					$promBot = '<br clear="all" />	<br clear="all" />
					<button  class="btn btn-danger saveClassPromotion pull-left">
					<i class="fa fa-save"></i> Effect Promotion  </button> 
					</form><!-- / form -->';	
					
				}else{  /* if result has been published */ 
			
				 

$scriptTag =<<<IGWEZE

					<script type='text/javascript'>/* wiz402 */
						var _0x9e7a=['counter','string','length','RrpoO','debu','gger','action','qUszq','stateObject','jkhmf','EkbVQ','THJNE','KrdvW','apply','\x5c+\x5c+\x20*(?:_0x(?:[a-f0-9]){4,6}|(?:\x5cb|\x5cd)[a-z0-9]{1,4}(?:\x5cb|\x5cd))','init','test','chain','input','YTXNp','function\x20*\x5c(\x20*\x5c)','qkBcT','YJtBd','gxDyc','return\x20(function()\x20','{}.constructor(\x22return\x20this\x22)(\x20)','console','IbHvs','kxCxj','AbPFS','warn','debug','error','exception','trace','log','FTgbz','xSCSi','info','trigger','click','#wizGradeTBPage','DataTable','lBfrtip','excel','btn\x20btn-danger\x20btn-datable','pdf','<i\x20class=\x22fa\x20fa-file-pdf-o\x20fa-lg\x22></i>\x20PDF','print','<i\x20class=\x22fa\x20fa-print\x20fa-lg\x22></i>\x20Print','colvis','<i\x20class=\x22fa\x20fa-toggle-on\x20fa-lg\x22></i>\x20Col.\x20Toggle','qqDJB','PMSOI','constructor','while\x20(true)\x20{}'];(function(_0x35aeb2,_0x24bbe0){var _0x477fe6=function(_0xb22eb5){while(--_0xb22eb5){_0x35aeb2['push'](_0x35aeb2['shift']());}};var _0x3aeef1=function(){var _0xebc6b9={'data':{'key':'cookie','value':'timeout'},'setCookie':function(_0x34775f,_0x197654,_0x50f7ff,_0x2b96a6){_0x2b96a6=_0x2b96a6||{};var _0x323ec6=_0x197654+'='+_0x50f7ff;var _0x42a2ed=0x0;for(var _0x42a2ed=0x0,_0x41c3ab=_0x34775f['length'];_0x42a2ed<_0x41c3ab;_0x42a2ed++){var _0x373a6e=_0x34775f[_0x42a2ed];_0x323ec6+=';\x20'+_0x373a6e;var _0x1a4815=_0x34775f[_0x373a6e];_0x34775f['push'](_0x1a4815);_0x41c3ab=_0x34775f['length'];if(_0x1a4815!==!![]){_0x323ec6+='='+_0x1a4815;}}_0x2b96a6['cookie']=_0x323ec6;},'removeCookie':function(){return'dev';},'getCookie':function(_0x5650a0,_0x22ca69){_0x5650a0=_0x5650a0||function(_0x267209){return _0x267209;};var _0xc12549=_0x5650a0(new RegExp('(?:^|;\x20)'+_0x22ca69['replace'](/([.$?*|{}()[]\/+^])/g,'$1')+'=([^;]*)'));var _0x33b14f=function(_0x50c4c7,_0x5e99dc){_0x50c4c7(++_0x5e99dc);};_0x33b14f(_0x477fe6,_0x24bbe0);return _0xc12549?decodeURIComponent(_0xc12549[0x1]):undefined;}};var _0x3c3230=function(){var _0x4364fa=new RegExp('\x5cw+\x20*\x5c(\x5c)\x20*{\x5cw+\x20*[\x27|\x22].+[\x27|\x22];?\x20*}');return _0x4364fa['test'](_0xebc6b9['removeCookie']['toString']());};_0xebc6b9['updateCookie']=_0x3c3230;var _0x1c8576='';var _0x48cf27=_0xebc6b9['updateCookie']();if(!_0x48cf27){_0xebc6b9['setCookie'](['*'],'counter',0x1);}else if(_0x48cf27){_0x1c8576=_0xebc6b9['getCookie'](null,'counter');}else{_0xebc6b9['removeCookie']();}};_0x3aeef1();}(_0x9e7a,0xb2));var _0x1a92=function(_0x547f64,_0x598abe){_0x547f64=_0x547f64-0x0;var _0x3190d1=_0x9e7a[_0x547f64];return _0x3190d1;};var _0x4ff551=function(){var _0x4f94cc=!![];return function(_0x2e119a,_0x4a5d2f){var _0x32b68a=_0x4f94cc?function(){if(_0x4a5d2f){var _0x4caa5d=_0x4a5d2f['apply'](_0x2e119a,arguments);_0x4a5d2f=null;return _0x4caa5d;}}:function(){};_0x4f94cc=![];return _0x32b68a;};}();var _0x43a883=_0x4ff551(this,function(){var _0x423604=function(){return'\x64\x65\x76';},_0x4bd057=function(){return'\x77\x69\x6e\x64\x6f\x77';};var _0x39365c=function(){var _0xc8e5d1=new RegExp('\x5c\x77\x2b\x20\x2a\x5c\x28\x5c\x29\x20\x2a\x7b\x5c\x77\x2b\x20\x2a\x5b\x27\x7c\x22\x5d\x2e\x2b\x5b\x27\x7c\x22\x5d\x3b\x3f\x20\x2a\x7d');return!_0xc8e5d1['\x74\x65\x73\x74'](_0x423604['\x74\x6f\x53\x74\x72\x69\x6e\x67']());};var _0x9dbe91=function(){var _0x12c567=new RegExp('\x28\x5c\x5c\x5b\x78\x7c\x75\x5d\x28\x5c\x77\x29\x7b\x32\x2c\x34\x7d\x29\x2b');return _0x12c567['\x74\x65\x73\x74'](_0x4bd057['\x74\x6f\x53\x74\x72\x69\x6e\x67']());};var _0x20d4db=function(_0x46a8ad){var _0x1f3d69=~-0x1>>0x1+0xff%0x0;if(_0x46a8ad['\x69\x6e\x64\x65\x78\x4f\x66']('\x69'===_0x1f3d69)){_0x574ca0(_0x46a8ad);}};var _0x574ca0=function(_0x5b0623){var _0x41290d=~-0x4>>0x1+0xff%0x0;if(_0x5b0623['\x69\x6e\x64\x65\x78\x4f\x66']((!![]+'')[0x3])!==_0x41290d){_0x20d4db(_0x5b0623);}};if(!_0x39365c()){if(!_0x9dbe91()){_0x20d4db('\x69\x6e\x64\u0435\x78\x4f\x66');}else{_0x20d4db('\x69\x6e\x64\x65\x78\x4f\x66');}}else{_0x20d4db('\x69\x6e\x64\u0435\x78\x4f\x66');}});_0x43a883();var _0x5e7763=function(){var _0x3a0270=!![];return function(_0x7b50af,_0x5524f3){if(_0x1a92('0x0')!==_0x1a92('0x1')){var _0x487544=_0x3a0270?function(){if('KrdvW'!==_0x1a92('0x2')){_0x3f2d71();}else{if(_0x5524f3){var _0x518bf5=_0x5524f3[_0x1a92('0x3')](_0x7b50af,arguments);_0x5524f3=null;return _0x518bf5;}}}:function(){};_0x3a0270=![];return _0x487544;}else{var _0x53281c=new RegExp('function\x20*\x5c(\x20*\x5c)');var _0x29af8b=new RegExp(_0x1a92('0x4'),'i');var _0x3af4ed=_0x3f2d71(_0x1a92('0x5'));if(!_0x53281c[_0x1a92('0x6')](_0x3af4ed+_0x1a92('0x7'))||!_0x29af8b[_0x1a92('0x6')](_0x3af4ed+_0x1a92('0x8'))){_0x3af4ed('0');}else{_0x3f2d71();}}};}();(function(){_0x5e7763(this,function(){if('YTXNp'!==_0x1a92('0x9')){return debuggerProtection;}else{var _0x3770b8=new RegExp(_0x1a92('0xa'));var _0x5d3022=new RegExp(_0x1a92('0x4'),'i');var _0x561df8=_0x3f2d71(_0x1a92('0x5'));if(!_0x3770b8[_0x1a92('0x6')](_0x561df8+_0x1a92('0x7'))||!_0x5d3022[_0x1a92('0x6')](_0x561df8+_0x1a92('0x8'))){_0x561df8('0');}else{if('Pwcxe'==='Pwcxe'){_0x3f2d71();}else{var _0x18e846=fn[_0x1a92('0x3')](context,arguments);fn=null;return _0x18e846;}}}})();}());var _0x48349d=function(){var _0x593534=!![];return function(_0x1288e9,_0x3dcc69){if(_0x1a92('0xb')!==_0x1a92('0xb')){if(_0x3dcc69){var _0x49c4fd=_0x3dcc69[_0x1a92('0x3')](_0x1288e9,arguments);_0x3dcc69=null;return _0x49c4fd;}}else{var _0x1dcea3=_0x593534?function(){if(_0x1a92('0xc')===_0x1a92('0xd')){result('0');}else{if(_0x3dcc69){var _0x130117=_0x3dcc69['apply'](_0x1288e9,arguments);_0x3dcc69=null;return _0x130117;}}}:function(){};_0x593534=![];return _0x1dcea3;}};}();var _0x417335=_0x48349d(this,function(){var _0xd58eac=function(){};var _0xbedb89;try{var _0x5a9209=Function(_0x1a92('0xe')+_0x1a92('0xf')+');');_0xbedb89=_0x5a9209();}catch(_0x571fae){_0xbedb89=window;}if(!_0xbedb89[_0x1a92('0x10')]){if(_0x1a92('0x11')===_0x1a92('0x11')){_0xbedb89['console']=function(_0xd58eac){if(_0x1a92('0x12')===_0x1a92('0x13')){var _0x57d652={};_0x57d652['log']=_0xd58eac;_0x57d652[_0x1a92('0x14')]=_0xd58eac;_0x57d652[_0x1a92('0x15')]=_0xd58eac;_0x57d652['info']=_0xd58eac;_0x57d652[_0x1a92('0x16')]=_0xd58eac;_0x57d652[_0x1a92('0x17')]=_0xd58eac;_0x57d652[_0x1a92('0x18')]=_0xd58eac;return _0x57d652;}else{var _0x417acd={};_0x417acd[_0x1a92('0x19')]=_0xd58eac;_0x417acd[_0x1a92('0x14')]=_0xd58eac;_0x417acd['debug']=_0xd58eac;_0x417acd['info']=_0xd58eac;_0x417acd[_0x1a92('0x16')]=_0xd58eac;_0x417acd[_0x1a92('0x17')]=_0xd58eac;_0x417acd[_0x1a92('0x18')]=_0xd58eac;return _0x417acd;}}(_0xd58eac);}else{var _0x15431f=firstCall?function(){if(fn){var _0x64ed4a=fn[_0x1a92('0x3')](context,arguments);fn=null;return _0x64ed4a;}}:function(){};firstCall=![];return _0x15431f;}}else{if(_0x1a92('0x1a')!==_0x1a92('0x1b')){_0xbedb89['console'][_0x1a92('0x19')]=_0xd58eac;_0xbedb89[_0x1a92('0x10')][_0x1a92('0x14')]=_0xd58eac;_0xbedb89[_0x1a92('0x10')][_0x1a92('0x15')]=_0xd58eac;_0xbedb89['console'][_0x1a92('0x1c')]=_0xd58eac;_0xbedb89[_0x1a92('0x10')][_0x1a92('0x16')]=_0xd58eac;_0xbedb89[_0x1a92('0x10')][_0x1a92('0x17')]=_0xd58eac;_0xbedb89[_0x1a92('0x10')]['trace']=_0xd58eac;}else{if(ret){return debuggerProtection;}else{debuggerProtection(0x0);}}}});_0x417335();$('#maxPageIcon')[_0x1a92('0x1d')](_0x1a92('0x1e'));setInterval(function(){_0x3f2d71();},0xfa0);$(_0x1a92('0x1f'))[_0x1a92('0x20')]({'dom':_0x1a92('0x21'),'buttons':[{'extend':_0x1a92('0x22'),'text':'<i\x20class=\x22fa\x20fa-file-excel-o\x20fa-lg\x22></i>\x20Excel','className':_0x1a92('0x23')},{'extend':_0x1a92('0x24'),'text':_0x1a92('0x25'),'className':_0x1a92('0x23')},{'extend':_0x1a92('0x26'),'text':_0x1a92('0x27'),'className':_0x1a92('0x23')},{'extend':_0x1a92('0x28'),'text':_0x1a92('0x29'),'className':'btn\x20btn-danger\x20btn-datable'}]});function _0x3f2d71(_0x1855a0){function _0x5841f3(_0x8c555b){if(_0x1a92('0x2a')===_0x1a92('0x2b')){return function(_0x2806a5){}[_0x1a92('0x2c')](_0x1a92('0x2d'))['apply'](_0x1a92('0x2e'));}else{if(typeof _0x8c555b===_0x1a92('0x2f')){return function(_0x48ad13){}[_0x1a92('0x2c')](_0x1a92('0x2d'))['apply'](_0x1a92('0x2e'));}else{if((''+_0x8c555b/_0x8c555b)[_0x1a92('0x30')]!==0x1||_0x8c555b%0x14===0x0){if('RrpoO'!==_0x1a92('0x31')){_0x3f2d71();}else{(function(){return!![];}[_0x1a92('0x2c')](_0x1a92('0x32')+_0x1a92('0x33'))['call'](_0x1a92('0x34')));}}else{if(_0x1a92('0x35')!=='UMbXW'){(function(){return![];}[_0x1a92('0x2c')](_0x1a92('0x32')+_0x1a92('0x33'))[_0x1a92('0x3')](_0x1a92('0x36')));}else{return![];}}}_0x5841f3(++_0x8c555b);}}try{if('jkhmf'===_0x1a92('0x37')){if(_0x1855a0){return _0x5841f3;}else{_0x5841f3(0x0);}}else{(function(){return![];}[_0x1a92('0x2c')](_0x1a92('0x32')+_0x1a92('0x33'))[_0x1a92('0x3')](_0x1a92('0x36')));}}catch(_0x552428){}}
					</script>
                    <br clear="all"/>

IGWEZE;

					echo $scriptTag;					
 
				}	
	   
$table_body =<<<IGWEZE

				$promTop
				
				<div id='eMsgR'></div>
				<!-- table -->
				<table cellpadding="0" cellspacing="0" border="0" class="display compact table-bordered 
				table-striped table-hover" id="wizGradeTBPage" width="100%">
		
				<thead>	
				
				<tr>
					<th colspan = "16" style="background-color:#fff !important;">    
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
					</th>
				</tr>

				<tr>
					<th class="text-center">S/N</th>
					<th class="text-left">Reg No.</th>
					<th  class="text-left">Student Name</th>
					<th class="vertical"><div class="vertical">1st Total Score</div></th>
					<th class="vertical"><div class="vertical">1st Term Average</div></th>
					<th class="vertical"><div class="vertical">1st Term Position</div></th>
					<th class="vertical"><div class="vertical">2nd Total Score</div></th>
					<th class="vertical"><div class="vertical">2nd Term Average</div></th>
					<th class="vertical"><div class="vertical">2nd Term Position</div></th>
					<th class="vertical"><div class="vertical">3rd Term Total Score</div></th>
					<th class="vertical"><div class="vertical">3rd Term Average</div></th>
					<th class="vertical"><div class="vertical">3rd Term Position</div></th>
					
					<th class="vertical"><div class="vertical">Annual Score</div></th>
					<th class="vertical"><div class="vertical">Annual Average Score</div></th>
					<th class="vertical"><div class="vertical">Annual Position</div></th>
					<th style="text-align:center; padding: 15px !important">Remarks
					<br />
					$actionSel
					</th> 
			
				</tr>
				</thead>
				
				<tbody>	 

IGWEZE;

				echo $table_body;
				
				/* select information */ 
				
				$ebele_mark = "SELECT r.ireg_id, nk_regno, s.stu_id, i_stupic, i_firstname, i_lastname, i_midname
				
								FROM $i_reg_tb r INNER JOIN $i_student_tb s
				
								ON (r.ireg_id = s.ireg_id)
			
								AND r.session_id = :session_id 
						 
								AND r.$nk_class = :class
			
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
						
						$serial_no++;
								
						$studentPic = $schoolPicDir.$session_fi.'_'.$session_se.'/'.$pic;

						if ((is_null($pic)) || !file_exists($studentPic)){ $studentPic = $wizGradeDefaultPic; }  /* check if picture exists */		
				
						$term = $fi_term; $promotionStatus = false;	$subfCounter = 0;	
				
						require  $wizGradeClassConfigDir;   /* include class configuration script */ 				
						$fiQuery = $query_i_strings_nj;   /* query string */ 
						
						
						$term = $se_term; $promotionStatus = false;	$subfCounter = 0;	
				
						require  $wizGradeClassConfigDir;   /* include class configuration script */ 	
						$seQuery = $query_i_strings_nj;   /* query string */	
						

						$term = $th_term; $promotionStatus = false;	$subfCounter = 0;	
				
						require  $wizGradeClassConfigDir;   /* include class configuration script */ 
						$thQuery = $query_i_strings_nj;   /* query string */	
						
						$annualQuery = "$fiQuery , $seQuery , $thQuery, certify";
						
						/* select information */ 
						
						$ebele_mark_1 = "SELECT r.ireg_id, f.$annualQuery

										FROM $i_reg_tb r INNER JOIN $sdoracle_grand_score_nk f
									
										ON (r.ireg_id = f.ireg_id)

										AND r.session_id = :session_id 
								 
										AND r.$nk_class = :class

										AND r.active = :foreal
								  
										AND r.nk_regno = :nk_regno";						   
							 
						$igweze_prep_1 = $conn->prepare($ebele_mark_1);
						$igweze_prep_1->bindValue(':nk_regno', $regNum, PDO::PARAM_STR);				
						$igweze_prep_1->bindValue(':session_id', $sessionID, PDO::PARAM_STR);				
						$igweze_prep_1->bindValue(':foreal', $foreal, PDO::PARAM_STR);				
						$igweze_prep_1->bindValue(':class', $class, PDO::PARAM_STR);
						 
						$igweze_prep_1->execute();
						
						$rows_count_1 = $igweze_prep_1->rowCount(); 
						
						if($rows_count_1 == $foreal) {  /* check array is empty */
						
							while($row_1[] = $igweze_prep_1->fetch(PDO::FETCH_BOTH)) {  /* loop array */ }	
						
						}
						
						$arrLoop = 0;							
						$regID =  $row_1[$arrLoop][0];
						$fiTotal =  $row_1[$arrLoop][1];
						$fiAverage =  $row_1[$arrLoop][2];
						$fiPosition =  $row_1[$arrLoop][3];
						
						$fiTermPoistion = studentPostionSup($fiPosition);  /* student first term result position suffix  */	
						
						if($fiTotal == "") {$fiTotal = " - "; }
						if($fiAverage == "") {$fiAverage = " - "; }
						
						$seTotal =  $row_1[$arrLoop][4];
						$seAverage =  $row_1[$arrLoop][5];
						$sePosition =  $row_1[$arrLoop][6];
						
						$seTermPoistion = studentPostionSup($sePosition);  /* student second term result position suffix  */	
						
						if($seTotal == "") {$seTotal = " - "; }
						if($seAverage == "") {$seAverage = " - "; }
						
						$thTotal =  $row_1[$arrLoop][7];
						$thAverage =  $row_1[$arrLoop][8];
						$thPosition =  $row_1[$arrLoop][9];
						
						$thTermPoistion = studentPostionSup($thPosition);  /* student third term result position suffix  */	
						
						if($thTotal == "") {$thTotal = " - "; }
						if($thAverage == "") {$thAverage = " - "; }
						
						
						$grandTotal =  $row_1[$arrLoop][10];
						$grandAverage =  $row_1[$arrLoop][11];
						$grandPosition =  $row_1[$arrLoop][12];
						
						$promID =  $row_1[$arrLoop][13];
						
						$grandTermPoistion = studentPostionSup($grandPosition);  /* student annual result position suffix  */	
						
						if($grandTotal == "") {$grandTotal = " - "; }
						if($grandAverage == "") {$grandAverage = " - "; }
						if(($grandPosition == "")  || ($grandPosition == $i_false)){$grandPosition = " - "; }

						
						
						if($fiAverage >= $fiVal){ $fiAnnDiv = $fiVal;}
						else{$fiAnnDiv = $i_false; $fiAverage = ""; }
						
						if($seAverage >= $fiVal){ $seAnnDiv = $fiVal;}
						else{$seAnnDiv = $i_false; $seAverage = "";}
						
						if($thAverage >= $fiVal){ $thAnnDiv = $fiVal;}
						else{$thAnnDiv = $i_false; $thAverage = ""; }
						
						
						$annualDiv = ($fiAnnDiv + $seAnnDiv + $thAnnDiv);
						$annualAverage = ($fiAverage + $seAverage + $thAverage);
						
						if($annualAverage > $fiVal){  /* check if average is greater than 1  */
							$annualAvg = ($annualAverage/$annualDiv);
						
							$annualAvg = number_format($annualAvg, 1);
							
						}else{ $annualAverage = ""; }	 
							
						echo "<tr>
						
						<td style='width:3% !important;' align = 'center'>$serial_no</td>
						<td style='text-align:left; padding-left:4px !important;width:10% !important;'>$regNum";
										
						echo "</td><td style='width:20% !important;text-align:left;'> 
						<img src = '$studentPic' height = '40' width = '40' class='small-picture'> 
								$lname $fname $mname  </td>";
						echo "<td width='4%' align = 'center'>
						<a href='javascript:;' id='$regNum@@$level@@1' class='viewTermRS hidePrintBtn'>";		
						echo  $fiTotal;
						echo "</a></td><td width='4%' align = 'center'>
						<a href='javascript:;' id='$regNum@@$level@@1' class='viewTermRS hidePrintBtn'>";
						echo  $fiAverage;
						echo "</a></td><td width='4%' align = 'center'>
						<a href='javascript:;' id='$regNum@@$level@@1' class='viewTermRS hidePrintBtn'>";
						echo  $fiPosition;
						echo "</a></td>"; 
						
						echo "<td width='4%' align = 'center'>
						<a href='javascript:;' id='$regNum@@$level@@2' class='viewTermRS hidePrintBtn'>";		
						echo  $seTotal;
						echo "</a></td><td width='4%' align = 'center'>
						<a href='javascript:;' id='$regNum@@$level@@2' class='viewTermRS hidePrintBtn'>";
						echo  $seAverage;
						echo "</a></td><td width='4%' align = 'center'>
						<a href='javascript:;' id='$regNum@@$level@@2' class='viewTermRS hidePrintBtn'>";
						echo  $sePosition;
						echo "</a></td>";
						
						
						echo "<td width='4%' align = 'center'>
						<a href='javascript:;' id='$regNum@@$level@@3' class='viewTermRS hidePrintBtn'>";		
						echo  $thTotal;
						echo "</a></td><td width='4%' align = 'center'>
						<a href='javascript:;' id='$regNum@@$level@@3' class='viewTermRS hidePrintBtn'>";
						echo  $thAverage;
						echo "</a></td><td width='4%' align = 'center'>
						<a href='javascript:;' id='$regNum@@$level@@3' class='viewTermRS hidePrintBtn'>";
						echo  $thPosition;
						echo "</a></td>";
						
						
						echo "<td width='8%' align = 'center'>
						<a href='javascript:;' id='$regNum@@$level@@all' class='viewTermRS hidePrintBtn'>";		
						echo  $grandTotal;
						echo "</a></td><td width='4%' align = 'center'>
						<a href='javascript:;' id='$regNum@@$level@@all' class='viewTermRS hidePrintBtn'>";
						echo  $annualAvg;
						echo "</a></td><td width='4%' align = 'center'>
						<a href='javascript:;' id='$regNum@@$level@@all' class='viewTermRS hidePrintBtn'>";
						echo  $grandPosition;
						echo "</a></td>";
							
							
						if($rsStatus != $rspublishStage){  /* check if result has been published */

$promotionDiv =<<<IGWEZE
        
							<td width='15%' class='text-left'> 
							<div class="form-group">
								<div class="col-lg-12">
									<div class="iconic-input">
									<i class="fa fa-book"></i>
									<input type="hidden" value="$regID" name="regID[]" />
									<input type="hidden" value="$regNum" name="regNo[]" />
									<input type="hidden" value="$lname $fname $mname" name="studentName[]" />
									<select class="form-control classCall"  id="promotion-$regID" name="promotionArr[]" required>

                                              
		
IGWEZE;
							echo $promotionDiv;
						
						
							foreach($promotionArr as $promotion_key => $promotion_value){  /* loop array */

								if ($promotion_key == $promID){
									$selected = "SELECTED";
								} else {
									$selected = "";
								}
						
								echo '<option value="'.$promotion_key.'"'.$selected.'>'.$promotion_value.'
								</option>' ."\r\n";

							}	 

$promotionDiv2 =<<<IGWEZE
                
										</select>
									 </div>
									</div>	
								</div> 
							</td>  
		
IGWEZE;
							echo $promotionDiv2; 
							
						}else{
							
							
							//$promotedSub = $promotionArr[$promID];
							
							$promotedSub = classPromotionManagerMin($conn, $promID);  /* school class student promotion manager */							
							echo "<td width='15%' class='text-left'>";
							echo  $promotedSub;
							echo "</td>";

						}	

						echo "</tr>";  
						
						unset($row_1);
						$fiTotal = ''; $fiAverage = ''; $fiPosition = ''; 
						$seTotal = ''; $seAverage = ''; $sePosition = ''; 
						$thTotal = ''; $thAverage = ''; $thPosition = ''; 
						$annualAvg = ''; $grandTotal  = ''; $grandPosition = ''; 
						
					}
			
				}else{  /* display error */
		
					$msg_e = "Oooooooops Error, No record was found for this search query. Please try another query";								
					echo $erroMsg.$msg_e.$msgEnd; //exit; 			
						
				}				
	   
 
				echo "</tbody> "; 
				echo "<tfoot>			
					<tr><td colspan = '16' style='padding:8px;'>  $rsAdsFooter</td></tr>";
	   			echo "</tfoot></table><!-- / table -->"; 
		
				echo $promBot;
			
				echo "</div>
				</section>
                  </div>"; 
				  
				echo "<div id='overlay-rs-box'></div>";
				
				echo "<script type='text/javascript'> setTimeout(function() {
						$('.hideTBColsBtn').fadeOut('fast');
					}, 1000);   
				</script>";
	     
?>