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
	This script handle admin jQuery/Javascript
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     	define('wizGrade', 'igweze');  /* define a check for wrong access of file */
   
		require 'configINwizGrade.php';  /* load wizGrade configuration files */	   
     
		if (($_POST['pageType']) == 'loadScript') { 

?>



		<script type="text/javascript">
		
 

			$('body').on('click','.changeSchool',function(event){  /* change school type */

						event.stopImmediatePropagation();
						showPageLoader();
						var clickedTheme = this.id.split('-');
						var schoolID = clickedTheme[1];

						var wizGrade = 'changeSchool';

						$('#schoolCDIV').load('schoolChanger.php', {'schoolT': schoolID,
						'schoolType':wizGrade }).fadeIn(300); 

						return false;

			}); 
			
			$('body').on('click','.wizGradeMode', function(event){  /* change school mode type */

						event.stopImmediatePropagation();
						showPageLoader();
						var clickMode = this.id.split('-');
						var wizGradeID = clickMode[1];

						var wizGrade = 'actMode';

						$('#wizGradePageMsg').load('wizGradeModeSetter.php', {'wizGradeMode': wizGradeID,
						'wizGradeData':wizGrade }).fadeIn(300); 

						return false; 
			});		 
			
			$('body').on('click','.btn-theme',function(event){  /* change page theme */

						event.stopImmediatePropagation();
						showPageLoader();
						var clickedTheme = this.id.split('#');
						var colorID = clickedTheme[1];

						var wizGradeColor = 'wizGradeColor';

						$('#msgBoxTheme').load('wizGradeConfigCPanel.php', {'themeColorID': colorID,
						'schoolSettings':wizGradeColor }).fadeIn(300);  

						return false;

			});

			$('body').on('click','.schoolSettingsBtn a',function(event){  /* select school settings */									  
												  
					event.stopImmediatePropagation();	
					
					var varID = this.id;
					
					showPageLoader();
					
					$(".schoolSettingsBtn a").removeClass('activeMenu');
					$(this).addClass('activeMenu');
					$("#schoolSettingsDiv").load(varID);
					$('html, body').animate({ scrollTop:  $('#schoolSettingsDiv').offset().top - 50 }, 'slow');
					
					hidePageLoader();  /* hide page loader */
			
				return false;
	  
			}); 
			
			$('body').on('click','.viewNewReg',function(event){  /* view new registration */
			
				event.stopImmediatePropagation();
					var varID = this.id;
					
					showPageLoader();   
					
					$('#wizGradeRightHalf').load('wizGradeOnlineReg.php', {'reg': varID }).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 30 }, 'slow'); 
				
					return false;  
			
			}); 

			$('body').on('click','.admitNewReg',function(event){  /* admin a new student */
			
						event.stopImmediatePropagation();	
						
						var studentID = this.id;
						var newBioData = 'newStuBioData';
						var regnum = $('#regnum').val();
						var level = $('#levelReg').val();
						var schClass = $('#class').val();
						var term = $('#term').val(); 
						
						$('.registration-loader').fadeIn(100);
						
						$('#msgBoxDiv').load('acceptRegistration.php', {'newBioData': newBioData, 'studentID': studentID, 
											 'regnum': regnum, 'level': level, 'class': schClass, 'term': term  }).fadeIn(1000); 
						
						return false;  
			
			});	 

			$('body').on('click','#mregRemoveBtn',function(event){  /* trigger remove registration */
			
					event.stopImmediatePropagation();		
					
					$('.removeNewReg').trigger('click');
					
					return false;
				
			}); 

			$('body').on('click','.removeNewReg',function(event){  /* remove registration */
			
						event.stopImmediatePropagation();	
						
						var studentID = this.id;
						var newBioData = 'remove-registration';
						

						$('.registration-loader').fadeIn(100);
						
						$('#msgBoxDiv').load('removeRegistration.php', {'newBioData': newBioData, 
											 'studentID': studentID }).fadeIn(1000);
					
						
						return false;  
			
			});	  
			
			$('body').on('click','#schoolSettings',function(){  /* school settings configuration */
			
				$('#frmschoolSettings').submit(function(event) {		
						
					$('.configLoading').fadeIn(100);	
				
					event.stopImmediatePropagation();
							
						$.post('wizGradeConfigCPanel.php', $(this).find('select, input').serialize(), function(data) {
							
							$('.msgBoxSettings').html(data);	
							$('html, body').animate({ scrollTop:  $('.msgBoxSettings').offset().top - 30 }, 'slow');
						
						});
			  
					return false;
				
				});		
			});

			$('body').on('click','#examConfigs',function(){  /* exams settings configuration */
			
				$('#frmexamConfigs').submit(function(event) {		
					
					$('.configLoading').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeHConfigCPanel.php', $(this).find('select, input').serialize(), function(data) {
						
						$('.msgBoxSettings').html(data);	
						$('html, body').animate({ scrollTop:  $('.msgBoxSettings').offset().top - 30 }, 'slow');
				
					});
	  
					return false;
			
				});		
			});

			$('body').on('click','#currentSession',function(){  /* current school settings configuration */
			
				$('#frmcurrentSession').submit(function(event) {		
						
					$('.configLoading').fadeIn(100);	
				
					event.stopImmediatePropagation();
							
					$.post('wizGradeConfigCPanel.php', $(this).find('select, input').serialize(), function(data) {
						
						$('.msgBoxSettings').html(data);	
						$('html, body').animate({ scrollTop:  $('.msgBoxSettings').offset().top - 30 }, 'slow'); 
							
						
					});
		  
					return false;
				
				});		
				
			});

			$('body').on('click','#levelSettings',function(){  /* school level settings configuration */
			
				$('#frmlevelSettings').submit(function(event) {		
						
					$('.configLoading').fadeIn(100);	
				
					event.stopImmediatePropagation();
							
					$.post('wizGradeHConfigCPanel.php', $(this).find('select, input').serialize(), function(data) {
						
						$('.msgBoxSettings').html(data);	
						$('html, body').animate({ scrollTop:  $('.msgBoxSettings').offset().top - 30 }, 'slow'); 
							
					
					});
		  
					return false;
				
				});		
			});

			$('body').on('click','#classSettings',function(){  /* school class settings configuration */
			
				$('#frmclassSettings').submit(function(event) {		
						
					$('.configLoading').fadeIn(100);	
				
					event.stopImmediatePropagation();
							
					$.post('wizGradeHConfigCPanel.php', $(this).find('select, input').serialize(), function(data) {
						
						$('.msgBoxSettings').html(data);	
						$('html, body').animate({ scrollTop:  $('.msgBoxSettings').offset().top - 30 }, 'slow'); 
						
					});
		  
					return false;
				
				});		
			});

			$('body').on('click','#classTypeSettings',function(){  /* school class type settings configuration */
			
				$('#frmclassTypeSettings').submit(function(event) {		
						
					$('.configLoading').fadeIn(100);	
				
					event.stopImmediatePropagation();
							
					$.post('wizGradeHConfigCPanel.php', $(this).find('select, input').serialize(), function(data) {
						
						$('.msgBoxSettings').html(data);	
						$('html, body').animate({ scrollTop:  $('.msgBoxSettings').offset().top - 100 }, 'slow'); 
						
					});
		  
					return false;
				
				});		
			});
			
			$('body').on('click','#minCourseConfig',function(){  /* school minimum course settings configuration */
			
				$('#frmminCourseConfig').submit(function(event) {		
						
					$('.configLoading').fadeIn(100);	
				
					event.stopImmediatePropagation();
							
					$.post('wizGradeHConfigCPanel.php', $(this).find('select, input').serialize(), function(data) {
						
						$('.msgBoxSettings').html(data);	
						$('html, body').animate({ scrollTop:  $('.msgBoxSettings').offset().top - 30 }, 'slow'); 
							
					
					});
		  
					return false;
				
				});		
			});
			
			$('body').on('click','.sessionEdit',function(event){  /* edit school session */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var sessionID = clickedID[1];
						var postVal_fi = 'EditSession_fi';
						var postVal_se = 'EditSession_se';
						var postVal_th = 'EditSession_th';
						var fiTerm = $('#editDivfi-'+sessionID).text();
						var seTerm = $('#editDivse-'+sessionID).text();
						var thTerm = $('#editDivth-'+sessionID).text();
						
						$('.frmloader-'+sessionID).fadeIn(100);
						
						$('#editDivfi-'+sessionID).load('wizGradeConfigCPanel.php', {'schoolSettings': 
														postVal_fi, 'fiTerm': fiTerm,
														'sessionID': sessionID  }).fadeIn(1000);

						$('#editDivse-'+sessionID).load('wizGradeConfigCPanel.php', 
														{'schoolSettings': postVal_se, 'seTerm': seTerm,
															  'sessionID': sessionID  }).fadeIn(1000);

						$('#editDivth-'+sessionID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal_th,
															  'thTerm': thTerm, 'sessionID': sessionID  }).fadeIn(1000);

						$('.frmloader-'+sessionID).fadeOut(3000);
						
						return false;  
			
			});

			$('body').on('click','.sessionUpdate',function(event){  /* update school session */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var sessionID = clickedID[1];
						var postVal = 'UpdateSession';
						var postVal_fi = 'UpdateSession_fi';
						var postVal_se = 'UpdateSession_se';
						var postVal_th = 'UpdateSession_th';
						var fiTerm = $('#fiTerm-'+sessionID).val();
						var seTerm = $('#seTerm-'+sessionID).val();
						var thTerm = $('#thTerm-'+sessionID).val();

						$('.frmloader-'+sessionID).fadeIn(100);
						
						$('#editDivfi-'+sessionID).load('wizGradeConfigCPanel.php', 
														{'schoolSettings': postVal_fi, 'fiTerm': fiTerm,
														'sessionID': sessionID  }).fadeIn(1000);

						$('#editDivse-'+sessionID).load('wizGradeConfigCPanel.php', 
														{'schoolSettings': postVal_se, 'seTerm': seTerm,
															  'sessionID': sessionID  }).fadeIn(1000);

						$('#editDivth-'+sessionID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal_th,
															  'thTerm': thTerm, 'sessionID': sessionID  }).fadeIn(1000);
						
						$('.frmloader-'+sessionID).fadeOut(3000);
						
						return false;  
			
			});		


			$('body').on('click','.sessionEditTF',function(event){  /* edit school session */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var sessionID = clickedID[1];
						var postVal_fi = 'EditSession_fi';
						var postVal_se = 'EditSession_se';
						var postVal_th = 'EditSession_th';
						var fiTerm = $('#editDivfi-'+sessionID).text();
						var seTerm = $('#editDivse-'+sessionID).text();
						var thTerm = $('#editDivth-'+sessionID).text();
						
						$('.frmloader-'+sessionID).fadeIn(100);
						
						$('#editDivfi-'+sessionID).load('RSTimeFrameManager.php', {'RTFSettings': postVal_fi, 'fiTerm': fiTerm,
														'sessionID': sessionID  }).fadeIn(1000);

						$('#editDivse-'+sessionID).load('RSTimeFrameManager.php', {'RTFSettings': postVal_se, 'seTerm': seTerm,
															  'sessionID': sessionID  }).fadeIn(1000);

						$('#editDivth-'+sessionID).load('RSTimeFrameManager.php', {'RTFSettings': postVal_th,
															  'thTerm': thTerm, 'sessionID': sessionID  }).fadeIn(1000);

						$('.frmloader-'+sessionID).fadeOut(3000);
						
						return false;  
			
			});

			$('body').on('click','.sessionUpdateTF',function(event){  /* update school session */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var sessionID = clickedID[1];
						var postVal = 'UpdateSession';
						var postVal_fi = 'UpdateSession_fi';
						var postVal_se = 'UpdateSession_se';
						var postVal_th = 'UpdateSession_th';
						var fiTerm = $('#fiTerm-'+sessionID).val();
						var seTerm = $('#seTerm-'+sessionID).val();
						var thTerm = $('#thTerm-'+sessionID).val();

						$('.frmloader-'+sessionID).fadeIn(100);
						
						$('#editDivfi-'+sessionID).load('RSTimeFrameManager.php', {'RTFSettings': postVal_fi, 'fiTerm': fiTerm,
														'sessionID': sessionID  }).fadeIn(1000);

						$('#editDivse-'+sessionID).load('RSTimeFrameManager.php', {'RTFSettings': postVal_se, 'seTerm': seTerm,
															  'sessionID': sessionID  }).fadeIn(1000);

						$('#editDivth-'+sessionID).load('RSTimeFrameManager.php', {'RTFSettings': postVal_th,
															  'thTerm': thTerm, 'sessionID': sessionID  }).fadeIn(1000);
						
						$('.frmloader-'+sessionID).fadeOut(3000);
						
						return false;  
			
			});		 				 

			$('body').on('click','.remarkSave',function(event){  /* save teachers remarks */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var remarkID = clickedID[1];
						var postVal = 'SaveRemarks';
						var Remarks = $('#frmRemark-'+remarkID).val();

						$('#frmloader-'+remarkID).fadeIn(100);
						
						$('#msgBoxDiv-'+remarkID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 
															  'Remarks': Remarks, 'remarkID': remarkID  }).fadeIn(1000);
						$('#frmloader-'+remarkID).fadeOut(3000);
						
						return false;  
			
			});		

			$('body').on('click','.remarkUpdate',function(event){  /* update teachers remarks */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var remarkID = clickedID[1];
						var postVal = 'UpdateRemarks';
						var Remarks = $('#frmRemark-'+remarkID).val();

						$('#frmloader-'+remarkID).fadeIn(100);
						
						$('#msgBoxDiv-'+remarkID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 
															  'Remarks': Remarks, 'remarkID': remarkID  }).fadeIn(1000);
						$('#frmloader-'+remarkID).fadeOut(3000);
						
						return false;  
			
			});		

			$('body').on('click','.remarkEdit',function(event){  /* edit teachers remarks */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var remarkID = clickedID[1];
						var postVal = 'EditRemarks';
						var Remarks = $('#editDiv-'+remarkID).text();

						$('#frmloader-'+remarkID).fadeIn(100); 
						
						$('#editDiv-'+remarkID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 'Remarks': Remarks,
															  'remarkID': remarkID  }).fadeIn(1000);
						$('#frmloader-'+remarkID).fadeOut(3000);
						
						return false;  
			
			});
			
			$('body').on('click','.remarkRemove',function(event){  /* remove teachers remarks */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var remarkID = clickedID[1];
						var postVal = 'RemoveRemarks';

						$('#frmloader-'+remarkID).fadeIn(100);
						
						$('#editDiv-'+remarkID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal,
															  'remarkID': remarkID  }).fadeIn(1000);
						$('#frmloader-'+remarkID).fadeOut(3000);
						
						return false;  
			
			}); 

			$('body').on('click','.disabilitySave',function(event){  /* save disability */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var disabilityID = clickedID[1];
						var postVal = 'SaveDisability';
						var Disability = $('#frmDisability-'+disabilityID).val();

						$('#frmloader-'+disabilityID).fadeIn(100);
						
						$('#msgBoxDiv-'+disabilityID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 
															  'Disability': Disability, 'disabilityID': disabilityID  }).fadeIn(1000);
						$('#frmloader-'+disabilityID).fadeOut(3000);
						
						return false;  
			
			});		

			$('body').on('click','.disabilityUpdate',function(event){  /* update disability */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var disabilityID = clickedID[1];
						var postVal = 'UpdateDisability';
						var Disability = $('#frmDisability-'+disabilityID).val();

						$('#frmloader-'+disabilityID).fadeIn(100);
						
						$('#msgBoxDiv-'+disabilityID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 
															  'Disability': Disability, 'disabilityID': disabilityID  }).fadeIn(1000);
						$('#frmloader-'+disabilityID).fadeOut(3000);
						
						return false;  
			
			});		

			$('body').on('click','.disabilityEdit',function(event){  /* edit disability */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var disabilityID = clickedID[1];
						var postVal = 'EditDisability';
						var Disability = $('#editDiv-'+disabilityID).text();

						$('#frmloader-'+disabilityID).fadeIn(100); 
						
						$('#editDiv-'+disabilityID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 'Disability': Disability,
															  'disabilityID': disabilityID  }).fadeIn(1000);
						$('#frmloader-'+disabilityID).fadeOut(3000);
						
						return false;  
			
			});
			
			$('body').on('click','.disabilityRemove',function(event){  /* remove disability */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var disabilityID = clickedID[1];
						var postVal = 'RemoveDisability';

						$('#frmloader-'+disabilityID).fadeIn(100);
						
						$('#editDiv-'+disabilityID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal,
															  'disabilityID': disabilityID  }).fadeIn(1000);
						$('#frmloader-'+disabilityID).fadeOut(3000);
						
						return false;  
			
			}); 

			$('body').on('click','.clubSave',function(event){  /* save school club */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var clubID = clickedID[1];
						var postVal = 'SaveClub';
						var Club = $('#frmClub-'+clubID).val();

						$('#frmloader-'+clubID).fadeIn(100);
						
						$('#msgBoxDiv-'+clubID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 
															  'Club': Club, 'clubID': clubID  }).fadeIn(1000);
						$('#frmloader-'+clubID).fadeOut(3000);
						
						return false;  
			
			});		

			$('body').on('click','.clubUpdate',function(event){  /* update school club */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var clubID = clickedID[1];
						var postVal = 'UpdateClub';
						var Club = $('#frmClub-'+clubID).val();

						$('#frmloader-'+clubID).fadeIn(100);
						
						$('#msgBoxDiv-'+clubID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 
															  'Club': Club, 'clubID': clubID  }).fadeIn(1000);
						$('#frmloader-'+clubID).fadeOut(3000);
						
						return false;  
			
			});		

			$('body').on('click','.clubEdit',function(event){  /* edit school club */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var clubID = clickedID[1];
						var postVal = 'EditClub';
						var Club = $('#editDiv-'+clubID).text();

						$('#frmloader-'+clubID).fadeIn(100);
						
						
						$('#editDiv-'+clubID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 'Club': Club,
															  'clubID': clubID  }).fadeIn(1000);
						$('#frmloader-'+clubID).fadeOut(3000);
						
						return false;  
			
			});
			
			$('body').on('click','.clubRemove',function(event){  /* remove school club */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var clubID = clickedID[1];
						var postVal = 'RemoveClub';

						$('#frmloader-'+clubID).fadeIn(100);
						
						$('#editDiv-'+clubID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal,
															  'clubID': clubID  }).fadeIn(1000);
						$('#frmloader-'+clubID).fadeOut(3000);
						
						return false;  
			
			}); 

			$('body').on('click','.clubPostSave',function(event){  /* save school club position */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var clubPostID = clickedID[1];
						var postVal = 'SaveClubPost';
						var ClubPost = $('#frmClubPost-'+clubPostID).val();

						$('#frmloader-'+clubPostID).fadeIn(100);
						
						$('#msgBoxDiv-'+clubPostID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 
															  'ClubPost': ClubPost, 'clubPostID': clubPostID  }).fadeIn(1000);
						$('#frmloader-'+clubPostID).fadeOut(3000);
						
						return false;  
			
			});		

			$('body').on('click','.clubPostUpdate',function(event){  /* update school club position */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var clubPostID = clickedID[1];
						var postVal = 'UpdateClubPost';
						var ClubPost = $('#frmClubPost-'+clubPostID).val();

						$('#frmloader-'+clubPostID).fadeIn(100);
						
						$('#msgBoxDiv-'+clubPostID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 
															  'ClubPost': ClubPost, 'clubPostID': clubPostID  }).fadeIn(1000);
						$('#frmloader-'+clubPostID).fadeOut(3000);
						
						return false;  
			
			});		

			$('body').on('click','.clubpostEdit',function(event){  /* edit school club position */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var clubPostID = clickedID[1];
						var postVal = 'EditClubPost';
						var ClubPost = $('#editDiv-'+clubPostID).text();

						$('#frmloader-'+clubPostID).fadeIn(100); 
						
						$('#editDiv-'+clubPostID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 
													   'ClubPost': ClubPost,
															  'clubPostID': clubPostID  }).fadeIn(1000);
						$('#frmloader-'+clubPostID).fadeOut(3000);
						
						return false;  
			
			});
			
			$('body').on('click','.clubPostRemove',function(event){  /* remove school club position */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var clubPostID = clickedID[1];
						var postVal = 'RemoveClubPost';

						$('#frmloader-'+clubPostID).fadeIn(100);
						
						$('#editDiv-'+clubPostID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal,
															  'clubPostID': clubPostID  }).fadeIn(1000);
						$('#frmloader-'+clubPostID).fadeOut(3000);
						
						return false;  
			
			});

			$('body').on('click','.sportSave',function(event){  /* save sport */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var sportID = clickedID[1];
						var postVal = 'SaveSport';
						var Sport = $('#frmSport-'+sportID).val();

						$('#frmloader-'+sportID).fadeIn(100);
						
						$('#msgBoxDiv-'+sportID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 
															  'Sport': Sport, 'sportID': sportID  }).fadeIn(1000);
						$('#frmloader-'+sportID).fadeOut(3000);
						
						return false;  
			
			});		

			$('body').on('click','.sportUpdate',function(event){  /* update sport */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var sportID = clickedID[1];
						var postVal = 'UpdateSport';
						var Sport = $('#frmSport-'+sportID).val();

						$('#frmloader-'+sportID).fadeIn(100);
						
						$('#msgBoxDiv-'+sportID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 
															  'Sport': Sport, 'sportID': sportID  }).fadeIn(1000);
						$('#frmloader-'+sportID).fadeOut(3000);
						
						return false;  
			
			});		

			$('body').on('click','.sportEdit',function(event){  /* edit sport */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var sportID = clickedID[1];
						var postVal = 'EditSport';
						var Sport = $('#editDiv-'+sportID).text();

						$('#frmloader-'+sportID).fadeIn(100); 
						
						$('#editDiv-'+sportID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 'Sport': Sport,
															  'sportID': sportID  }).fadeIn(1000);
						$('#frmloader-'+sportID).fadeOut(3000);
						
						return false;  
			
			});
			
			$('body').on('click','.sportRemove',function(event){  /* remove sport */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var sportID = clickedID[1];
						var postVal = 'RemoveSport';

						$('#frmloader-'+sportID).fadeIn(100);
						
						$('#editDiv-'+sportID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal,
															  'sportID': sportID  }).fadeIn(1000);
						$('#frmloader-'+sportID).fadeOut(3000);
						
						return false;  
			
			});

			$('body').on('click','.rankingSave',function(event){  /* save teacher ranking */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var rankingID = clickedID[1];
						var postVal = 'SaveRanking';
						var Ranking = $('#frmRanking-'+rankingID).val();

						$('#frmloader-'+rankingID).fadeIn(100);
						
						$('#msgBoxDiv-'+rankingID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 
															  'Ranking': Ranking, 'rankingID': rankingID  }).fadeIn(1000);
						$('#frmloader-'+rankingID).fadeOut(3000);
						
						return false;  
			
			});		

			$('body').on('click','.rankingUpdate',function(event){  /* update teacher ranking */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var rankingID = clickedID[1];
						var postVal = 'UpdateRanking';
						var Ranking = $('#frmRanking-'+rankingID).val();

						$('#frmloader-'+rankingID).fadeIn(100);
						
						$('#msgBoxDiv-'+rankingID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 
															  'Ranking': Ranking, 'rankingID': rankingID  }).fadeIn(1000);
						$('#frmloader-'+rankingID).fadeOut(3000);
						
						return false;  
			
			});		

			$('body').on('click','.rankingEdit',function(event){  /* edit teacher ranking */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var rankingID = clickedID[1];
						var postVal = 'EditRanking';
						var Ranking = $('#editDiv-'+rankingID).text();

						$('#frmloader-'+rankingID).fadeIn(100); 
						
						$('#editDiv-'+rankingID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal, 'Ranking': Ranking,
															  'rankingID': rankingID  }).fadeIn(1000);
						$('#frmloader-'+rankingID).fadeOut(3000);
						
						return false;  
			
			});
			
			$('body').on('click','.rankingRemove',function(event){  /* remove teacher ranking */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var rankingID = clickedID[1];
						var postVal = 'RemoveRanking';

						$('#frmloader-'+rankingID).fadeIn(100);
						
						$('#editDiv-'+rankingID).load('wizGradeConfigCPanel.php', {'schoolSettings': postVal,
															  'rankingID': rankingID  }).fadeIn(1000);
						$('#frmloader-'+rankingID).fadeOut(3000);
						
						return false;  
			
			});
			

			$('body').on('click','#saveSMS-future',function(){  /* save SMS */
			
				$('#frmsaveSMS').submit(function(event) {		
					
					$('#saveLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeSMS.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#hmsgBox').html(data);	
						$('html, body').animate({ scrollTop:  $('#hmsgBox').offset().top - 50 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('click','.viewSMS',function(event){  /* view SMS */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var smsID = this.id;
						var postVal = 'viewSMS';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editSMSDiv').show();
						
						$('#editSMSDiv').load('wizGradeSMS.php', {'smsData': postVal, 'rData': smsID
											   }).fadeIn(1000);											   
											   
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','.removeSMS-future',function(event){  /* remove SMS */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var smsData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];
						
						var hInfo = 'SMS '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(smsData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click', '#removeSMS-future',function(event){  /* remove SMS */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeSMS';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('wizGradeSMS.php', {'smsData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			}); 
			
			$('body').on('click','.editSMS',function(event){  /* edit SMS */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var smsID = this.id;
						var postVal = 'editSMS';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editSMSDiv').show();
						
						$('#editSMSDiv').load('wizGradeSMS.php', {'smsData': postVal, 'rData': smsID
											   }).fadeIn(1000);	 
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click','#updateSMS',function(){  /* update SMS */
			
				$('#frmupdateSMS').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeSMS.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			}); 
			
			$('body').on('click','#savePayGateway-future',function(){  /* save SMS gateway */
			
				$('#frmsavePayGateway').submit(function(event) {		
					
					$('#saveLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('paymentGateway.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#hmsgBox').html(data);	
						$('html, body').animate({ scrollTop:  $('#hmsgBox').offset().top - 50 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('click','.viewPayGateway',function(event){  /* view SMS gateway */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var paymentID = this.id;
						var postVal = 'viewPayGateway';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editPayGatewayDiv').show();
						
						$('#editPayGatewayDiv').load('paymentGateway.php', {'gatewayPaymentData': postVal, 'rData': paymentID
											   }).fadeIn(1000);	 
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','.removePayGateway-future',function(event){  /* remove SMS gateway */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var gatewayPaymentData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];
						
						var hInfo = 'Payment Gateway '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(gatewayPaymentData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click', '#removePayGateway-future',function(event){  /* remove SMS gateway */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removePayGateway';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('paymentGateway.php', {'gatewayPaymentData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			});


			$('body').on('click','.editPayGateway',function(event){  /* edit SMS gateway */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var paymentID = this.id;
						var postVal = 'editPayGateway';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editPayGatewayDiv').show();
						
						$('#editPayGatewayDiv').load('paymentGateway.php', {'gatewayPaymentData': postVal, 'rData': paymentID
											   }).fadeIn(1000); 
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			
			$('body').on('click','#updatePayGateway',function(){  /* update SMS gateway */
			
				$('#frmupdatePayGateway').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('paymentGateway.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});	 

			$('body').on('click','#saveBroadcast',function(){  /* save school broadcast */
			
				$('#frmsaveBroadcast').submit(function(event) {		
					
					$('#saveLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeBroadcast.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#hmsgBox').html(data);	
						$('html, body').animate({ scrollTop:  $('#hmsgBox').offset().top - 50 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('click','.viewBroadcast',function(event){  /* view school broadcast */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var broadcastID = this.id;
						var postVal = 'viewBroadcast';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editBroadcastDiv').show();
						
						$('#editBroadcastDiv').load('wizGradeBroadcast.php', {'broadcastData': postVal, 'rData': broadcastID
											   }).fadeIn(1000);										   
											   
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','.removeBroadcast',function(event){  /* remove school broadcast */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var broadcastData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];
						
						var hInfo = 'Broadcast '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(broadcastData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click', '#removeBroadcast',function(event){  /* remove school broadcast */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeBroadcast';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('wizGradeBroadcast.php', {'broadcastData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			}); 
			
			$('body').on('click','.editBroadcast',function(event){  /* edit school broadcast */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var broadcastID = this.id;
						var postVal = 'editBroadcast';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editBroadcastDiv').show();
						
						$('#editBroadcastDiv').load('wizGradeBroadcast.php', {'broadcastData': postVal, 'rData': broadcastID
											   }).fadeIn(1000);	 
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});  
			
			$('body').on('click','#updateBroadcast',function(){  /* update school broadcast */
			
				$('#frmupdateBroadcast').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeBroadcast.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
				
			$('body').on('click','#saveGrade',function(){  /* save school grade */
			
				$('#frmsaveGrade').submit(function(event) {		
					
					$('#saveLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeGrade.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#hmsgBox').html(data);	
						$('html, body').animate({ scrollTop:  $('#hmsgBox').offset().top - 50 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('click','.viewGrade',function(event){  /* view school grade */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var gradeID = this.id;
						var postVal = 'viewGrade';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editGradeDiv').show();
						
						$('#editGradeDiv').load('wizGradeGrade.php', {'gradeData': postVal, 'rData': gradeID
											   }).fadeIn(1000);										   
											   
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','.removeGrade',function(event){  /* remove school grade */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var gradeData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];
						
						var hInfo = 'School Score Grade '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(gradeData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click', '#removeGrade',function(event){  /* remove school grade */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeGrade';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('wizGradeGrade.php', {'gradeData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			}); 
			
			$('body').on('click','.editGrade',function(event){  /* edit school grade */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var gradeID = this.id;
						var postVal = 'editGrade';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editGradeDiv').show();
						
						$('#editGradeDiv').load('wizGradeGrade.php', {'gradeData': postVal, 'rData': gradeID
											   }).fadeIn(1000);	 
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});  
			
			$('body').on('click','#updateGrade',function(){  /* upgrade school grade */
			
				$('#frmupdateGrade').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeGrade.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('change','#rollTask',function(){  /* mark student rollCall */	
		
				var rVal = $(this).val();
				//$(".rollCall > [value=" + rVal + "]").attr("selected", "true");
				$('.classCall option[value=' + rVal + ']').prop('selected', true);
		
				return false;
				
			});


			$('body').on('click','#loadRollDiv',function(){  /* load student rollCall div */
			
				$("#frmloadRollDiv").submit(function(event) {	
				
					showPageLoader();	
					
					event.stopImmediatePropagation();	
					
					$.post('rollCallManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200);	
						$('.printer-icon').fadeIn(200);			
					});
				
					return false;
				
				});	
				
			});
			
			$('body').on('click','.saveRollCall',function(){  /* save student rollCall */
			
				$('#frmsaveRollCall').submit(function(event) {

					event.stopImmediatePropagation();
					
					showPageLoader();	
					
					$('#rollCallDiv').show();				
							
					$.post('rollCallManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#eMsgR').html(data);		
						
					});
					
					$('html, body').animate({ scrollTop:  $('#eMsgR').offset().top - 50 }, 'slow');			
		  
					return false;
				
				});		
			});
			
			
			$('body').on('click','.saveClassPromotion',function(){  /* save class promotion */
			
				$('#frmsaveClassPromotion').submit(function(event) {

					event.stopImmediatePropagation();
					
					showPageLoader();	
					
					$('#promotionDiv').show();				
							
					$.post('classPromotion.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#eMsgR').html(data);				
						
					});
					
					$('html, body').animate({ scrollTop:  $('#eMsgR').offset().top - 50 }, 'slow');			
		  
					return false;
				
				});		
			});
			
			$('body').on('click','.saveBulkRSExcel',function(event){  /* save bulk student computation result */
			
					event.stopImmediatePropagation();
					
					var uData = $('#hiRSData').text();
					var uMode = 2;
					var rsData = "bulkExcelRS";
					
					showPageLoader();   
					 
					$('#wizgrade-page-div').load('wizGradeBulkRS.php', {'rsData': rsData, 'uploadData': uData, 'uMode': uMode}).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#scrollBTarget').offset().top - 50 }, 'slow');			
				
					return false;  
			
			});
			
			$('body').on('click','.savebulkSubCom',function(event){  /* save bulk student comment result */
			
					event.stopImmediatePropagation();
					
					var uData = $('#hiRSData').text();
					var uMode = 2;
					var rsData = "bulkSubComm";
					
					showPageLoader();   
					
					$('#wizgrade-page-div').load('wizGradeBulkSubCom.php', {'rsData': rsData,'uploadData': uData, 'uMode': uMode}).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#scrollBTarget').offset().top - 50 }, 'slow');			
				
					return false;  
			
			}); 
			
			$('body').on('click','.saveBulkRegExcel',function(event){  /* save bulk student registration */
			
					event.stopImmediatePropagation();
					
					var uData = $('#hiRSData').text();
					var uMode = 2;
					var bioData = "bulkExcelBio";
					
					showPageLoader();   
					
					$('#wizgrade-page-div').load('wizGradeBulkReg.php', {'bioData': bioData,'uploadData': uData, 'uMode': uMode}).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#scrollBTarget').offset().top - 50 }, 'slow');
				
					return false;  
			
			}); 
			
			$('body').on('click','#sendSMS',function(){  /* send student SMS */
			
				$('#frmsendSMS').submit(function(event) {		
						
					showPageLoader();	
				
					event.stopImmediatePropagation();
							
					$.post('smsSender.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200);	 
										
					});
		  
					return false;
				
				});		
			});

			$('body').on('click','#sendCSMS',function(){  /* send class SMS */
			
				$('#frmsendCSMS').submit(function(event) {		
						
					showPageLoader();	
				
					event.stopImmediatePropagation();
							
					$.post('smsSender.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200);	
										
					});
		  
					return false;
				
				});		
			}); 
			
			$('body').on('click','#staffSMS',function(){  /* send staff SMS */
			
				$('#frmstaffSMS').submit(function(event) {		
						
					showPageLoader();	
				
					event.stopImmediatePropagation();
							
					$.post('smsSender.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200);						
										
					});
		  
					return false;
				
				});		
			}); 
			
			$('body').on('click','#staffsSMS',function(){  /* send all activestaff SMS */
			
				$('#frmstaffsSMS').submit(function(event) {		
						
					showPageLoader();	
				
					event.stopImmediatePropagation();
							
					$.post('smsSender.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200);						
										
					});
		  
					return false;
				
				});		
			});
			
			$('body').on('click','#saveHostel',function(){  /* save school hostel */
			
				$('#frmsaveHostel').submit(function(event) {		
					
					$('#saveLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('schoolHostel.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#hmsgBox').html(data);	
						$('html, body').animate({ scrollTop:  $('#hmsgBox').offset().top - 100 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('click','.removeHostel',function(event){  /* remove school hostel */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var hostelData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];					
						var hInfo = 'Hostel Name - '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(hostelData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click', '#removeHostel',function(event){  /* remove school hostel */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeHostel';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('schoolHostel.php', {'hostelData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			}); 
			
			$('body').on('click','.editHostel',function(event){  /* edit school hostel */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var hostelID = this.id;
						var postVal = 'editHostel';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editHostelDiv').show();
						
						$('#editHostelDiv').load('schoolHostel.php', {'hostelData': postVal, 'rData': hostelID
											   }).fadeIn(1000);											   
											   
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','#updateHostel',function(){  /* update school hostel */
			
				$('#frmupdateHostel').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('schoolHostel.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 100 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			}); 

			$('body').on('click','#saveRoute',function(){  /* save school bus route */
			
				$('#frmsaveRoute').submit(function(event) {		
					
					$('#saveLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('schoolRoute.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#hmsgBox').html(data);	
						$('html, body').animate({ scrollTop:  $('#hmsgBox').offset().top - 100 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('click','.removeRoute',function(event){  /* remove school bus route */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var routeData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];					
						var hInfo = 'Route Name - '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(routeData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click', '#removeRoute',function(event){  /* remove school bus route */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeRoute';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('schoolRoute.php', {'routeData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			}); 

			$('body').on('click','.editRoute',function(event){  /* edit school bus route */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var routeID = this.id;
						var postVal = 'editRoute';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editRouteDiv').show();
						
						$('#editRouteDiv').load('schoolRoute.php', {'routeData': postVal, 'rData': routeID
											   }).fadeIn(1000); 
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','#updateRoute',function(){  /* update school bus route */
			
				$('#frmupdateRoute').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('schoolRoute.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 100 }, 'slow');			
						
					});
	  
					return false;
			
				});		
				
			});	 
		
			$('body').on('click','#searchWord',function(){  /* search student by words  */
			
				$('#frmSearchByKey').submit(function(event) {		
						
				showPageLoader();	
				
					event.stopImmediatePropagation();
							
					$.post('searchStudentsBio.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200);									
						$('.printer-icon').fadeIn(200);	 
						
					});
			  
					return false;
				
				});		
			});


			$('body').on('click','#searchMWords',function(){  /* search student by words  */
			
				$('#formBioSearch2').submit(function(event) {		
						
					showPageLoader();	
				
					event.stopImmediatePropagation();
					
					$.post('searchStudentsBio.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200); 
						$('.printer-icon').fadeIn(200);	 
						
					});
			  
					return false;
				
				});		
			}); 

			$('body').on('click','#searchClassBio', function(){  /* search student by class  */
														   
				$('#frmSearchBySess').submit(function(event) {		
						
					showPageLoader();	
				
					event.stopImmediatePropagation();
								
					$.post('searchStudentsBio.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200);	
						$('.printer-icon').fadeIn(200); 
						
					});
			  
					return false;
				
				});		
			});
			
			$('body').on('click','#newStudent', function(){  /* register new student */
														   
				$('#frmnewStudent').submit(function(event) {		
						
					showPageLoader();	
				
					event.stopImmediatePropagation();
								
					$.post('newStudentManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('.wizgrade-section-div').slideUp(2000);
						$('#wizgrade-page-div').slideDown(2000);						
						$('.wizgrade-page-icons').fadeIn(200);	
						$('.printer-icon').fadeIn(200); 
						
					});
			  
					return false;
				
				});		
			});			 
			
			$('body').on('click','.viewBioData',function(event){  /* view student profile */
			
					event.stopImmediatePropagation();
					var varID = this.id;
					
					showPageLoader();   
					
					$('#wizGradeRightHalf').load('showStudentProfile.php', {'reg': varID }).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 30 }, 'slow'); 
				
					return false;  
			
			});
			
			$('body').on('click','.stuIDCard',function(event){  /* view student profile */
			
					event.stopImmediatePropagation();
					var varID = this.id;
					
					showPageLoader();   
					
					$('#wizGradeRightHalf').load('showStudentIDCard.php', {'reg': varID }).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 30 }, 'slow'); 
				
					return false;  
			
			});
			
			$('body').on('click','.resetBioData',function(event){  /* load student password */
			
					event.stopImmediatePropagation();
					var varID = this.id;
					
					showPageLoader();   
					
					$('#wizGradeRightHalf').load('studentAccessPanel.php', {'reg': varID }).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 30 }, 'slow'); 
				
					return false; 
			
			});

			$('body').on('click','.resetStuPass',function(event){  /* reset student password */
			
					event.stopImmediatePropagation();
					var varID = this.id;
					
					showPageLoader();   
					
					$('#stuPassDiv').load('resetstudentData.php', {'regStu': varID });
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 30 }, 'slow'); 
				
					return false; 
			
			});

			$('body').on('click','.resetSpoPass',function(event){  /* reset parent password */
			
					event.stopImmediatePropagation();
					var varID = this.id;
					
					showPageLoader();   
					
					$('#spoPassDiv').load('resetstudentData.php', {'regSpo': varID });
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 30 }, 'slow'); 
				
					return false;
			
			});
			
			
			$('body').on('click', '#removeStudent',function(event){  /* remove student profile */ 
									
					event.stopImmediatePropagation();
					
					var adminPass = $("#adminPass").val();
					var studentData = $("#studentData").text();
					$('#reSLoader').fadeIn(100);
					$('#wizGradeRMsg').load('resetStudentData.php', {'removeReg': studentData, 'adminPass': adminPass });
					
					return false; 
					
			}); 

			
			$('body').on('click','.editBioData',function(event){  /* edit student profile */
			
					event.stopImmediatePropagation();
					
					showPageLoader();   
					
					var varID = this.id;
					
					$('#wizGradeRightHalf').load('studentBio.php', {'reg': varID }).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 30 }, 'slow'); 
				
					return false; 
			
			}); 

			$('body').on('click','#saveStudentS1',function(){  /* edit student profile */
			
				$('#frmBioData1').submit(function(event) {
								
					event.stopImmediatePropagation();
					
					$('.studentLoader').fadeIn(100);
							
						$.post('studentBioManager.php', $(this).find('select, input').serialize(), function(data) {
							
							$('.msgBox1').html(data);
						
						});
						
						$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 50 }, 'slow');
			  
						return false;
				
				});		
				
			});

			$('body').on('click','#saveStudentS2',function(){  /* edit student profile */
			
				$('#frmBioData2').submit(function(event) {
								
					event.stopImmediatePropagation();
					
					$('.studentLoader').fadeIn(100);
							
						$.post('studentBioManager.php', $(this).find('select, input').serialize(), function(data) {
						
							$('.msgBox2').html(data);												
											
						});
						
						$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 50 }, 'slow');
		  
						return false;
				
				});		
			}); 

			$('body').on('click','#sponsorData',function(){  /* edit parent profile */
			
				$('#frmBioData3').submit(function(event) {
								
					event.stopImmediatePropagation();
					
						$('.studentLoader').fadeIn(100);
								
						$.post('studentBioManager.php', $(this).find('select, input').serialize(), function(data) {
						
							$('.msgBox3').html(data);													
											
						});
						
						$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 50 }, 'slow');
		  
						return false;
				
				});		
			}); 

			$('body').on('click','#saveBioClass',function(){  /* edit student class */
			
				$('#frmsaveBioClass').submit(function(event) {
								
					event.stopImmediatePropagation();
					
					$('.studentLoader').fadeIn(100);
							
						$.post('studentBioManager.php', $(this).find('select, input').serialize(), function(data) {
						
							$('.msgBoxClass').html(data);
						
						});
						
						$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 50 }, 'slow');
		  
						return false;
				
				});		
			}); 
	 
			$('body').on('click','#saveStaff1',function(){  /* edit staff profile */
			
				$('#frmBioData1').submit(function(event) {
								
					event.stopImmediatePropagation();
					
					$('.staffLoader').fadeIn(100);
							
						$.post('staffBioManager.php', $(this).find('select, input').serialize(), function(data) {
							
							$('.msgBox1').html(data);									
																		
						});
					
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 50 }, 'slow');
		  
					return false;
				
				});	
				
			}); 

			$('body').on('click','#saveStaff2',function(){  /* edit staff profile */
			
				$('#frmBioData2').submit(function(event) {
								
					event.stopImmediatePropagation();
					
					$('.staffLoader').fadeIn(100);
							
						$.post('staffBioManager.php', $(this).find('select, input').serialize(), function(data) {
						
							$('.msgBox2').html(data);
																		
						});
						
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 50 }, 'slow');
		  
					return false;
				
				});		
				
			}); 

			$('body').on('click','#saveStaff3',function(){  /* edit staff profile */
			
				$('#frmBioData3').submit(function(event) {
								
					event.stopImmediatePropagation();
					
					$('.staffLoader').fadeIn(100);
							
						$.post('staffBioManager.php', $(this).find('select, input').serialize(), function(data) {
							
							$('.msgBox3').html(data);
							
						});
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 50 }, 'slow');	
			  
					return false;
				
				});		
				
			}); 

			$('body').on('click','#saveNewStaff',function(){  /* register new staff profile */
			
				$('#frmsaveNewStaff').submit(function(event) {

					event.stopImmediatePropagation();
					
					showPageLoader();	
							
					$.post('staffBioManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200);									
									
						$('.printer-icon').fadeIn(200);	
					
					});
		  
					return false;
				
				});
				
			}); 

			$('body').on('click','#assignformTeacher',function(){  /* assign class to a staff */
			
				$('#frmassignformTeacher').submit(function(event) {

					event.stopImmediatePropagation();
					
					showPageLoader();	
							
					$.post('wizGradeAssignManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#msgBoxT').html(data);		
						
					});
		  
					return false;
				
				});		
			}); 

			$('body').on('click','#assignsubTeacher',function(){  /* assign subject to a staff */
			
				$('#frmassignsubTeacher').submit(function(event) {

					event.stopImmediatePropagation();
					
					showPageLoader();	
							
					$.post('wizGradeAssignManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#msgBoxT').html(data);			
						
					});
		  
					return false;
				
				});		
			}); 
			
			$('body').on('click','.viewHStaff',function(event){  /* vie staff profile */
			
					event.stopImmediatePropagation();
					
					var varID = this.id;
					
					showPageLoader();   
					
					$('#frmNewTBio').fadeOut(600);
					$('#saveNewStaffData').fadeIn(600);
					$('#wizGradeRightHalf').load('showStaffBioHManager.php', {'teacherID': varID}).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 30 }, 'slow');
				
					return false;  
			
			}); 
			
			$('body').on('click','.viewStaff',function(event){  /* vie staff profile */
			
					event.stopImmediatePropagation();
					
					var varID = this.id;
					
					showPageLoader();   
					
					$('#frmNewTBio').fadeOut(600);
					$('#saveNewStaffData').fadeIn(600);
					$('#wizGradeRightHalf').load('showStaffBioManager.php', {'teacherID': varID}).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 30 }, 'slow');
				
					return false;  
			
			}); 
			
			$('body').on('click','.staffIDCard',function(event){  /* vie staff profile */
			
					event.stopImmediatePropagation();
					
					var varID = this.id;
					
					showPageLoader();   
					
					$('#frmNewTBio').fadeOut(600);
					$('#saveNewStaffData').fadeIn(600);
					$('#wizGradeRightHalf').load('showStaffIDCard.php', {'teacherID': varID}).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 30 }, 'slow');
				
					return false;  
			
			}); 
			
			$('body').on('click','.editStaff',function(event){  /* edit staff profile */
			
					event.stopImmediatePropagation();
				
					var varID = this.id;
					
					showPageLoader();   
					
					$('#wizGradeRightHalf').load('staffBio.php', {'teacherID': varID }).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 30 }, 'slow');
					
					$('#editBioPic').show(2000);
					$('#editBio2').show(2000);
					$('#editBio3').show(2000);			
					$('#editBio4').show(2000); 
					$('#editSignature').show(2000);  
				
					return false;
	  
			
			});

			$('body').on('click','.resetStaff',function(event){  /* load reset staff profile */
			
					event.stopImmediatePropagation();
					
					var varID = this.id;
					
					showPageLoader();   
					
					$('#wizGradeRightHalf').load('staffAccessPanel.php', {'staff': varID}).fadeIn(1000);
					
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 30 }, 'slow'); 
				
					return false;
	  
			
			});

			$('body').on('click','.resetStaffPass',function(event){  /* reset staff password */
			
					event.stopImmediatePropagation();
					
					var varID = this.id;
					
					showPageLoader();   
					
					$('#stuPassDiv').load('resetStaffAccess.php', {'reStaff': varID});
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 30 }, 'slow');
				
					return false;
	  
			
			});
			
			
			$('body').on('click', '#removeStaff',function(event){  /* remove staff profile */								
									
					event.stopImmediatePropagation();
					
					var adminPass = $("#adminPass").val();
					var staffID = $("#staffID").text();
					$('#reSLoader').fadeIn(100);
					$('#wizGradeRMsg').load('resetStaffAccess.php', {'removeReg': staffID, 'adminPass': adminPass });
					
					return false;
	  
			
			});
			
			$('body').on('click', '.changeStaffID',function(event){  /* edit staff ID */
									
					event.stopImmediatePropagation();
					
					var varID = this.id;
					var staffUser = $("#staffUser").val();
					var postVal = "changeStaff";
					
					$('#reSLoader').fadeIn(100);
					
					$('#msgC').load('resetStaffAccess.php', {'resetData': postVal, 'staffID': varID, 'staffUser': staffUser});
					$('html, body').animate({ scrollTop:  $('#scrollTargetMPage').offset().top - 30 }, 'slow');			
					
					return false;
	  
			
			}); 

			$('body').on('click','#searchStaffBio',function(){  /* search staff profile */
			
				$('#frmsearchStaffBio').submit(function(event) {		
						
					showPageLoader();	
				
					event.stopImmediatePropagation();
							
					$.post('searchStaffsBio.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200);	 
						$('.printer-icon').fadeIn(200);	 
						
					});
			  
					return false;
				
				});		
			}); 
			
			$('body').on('click','#searchStaffBiodata',function(){  /* search staff profile */
			
				$('#frmsearchStaffBio').submit(function(event) {		
						
					showPageLoader();	
				
					event.stopImmediatePropagation();
							
					$.post('searchStaffsBiodata.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200);	 
						$('.printer-icon').fadeIn(200);	 
						
					});
			  
					return false;
				
				});		
			}); 

			
			$('body').on('click','#saveCardPin',function(){  /* save scratch card pin */
			
				$('#frmsaveCardPin').submit(function(event) {		
					
					$('#saveLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('cardPins.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#hmsgBox').html(data);	
						$('html, body').animate({ scrollTop:  $('#hmsgBox').offset().top - 50 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('click','.viewCardPin',function(event){  /* view scratch card pin */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var cardPinID = this.id;
						var postVal = 'viewCardPin';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editCardPinDiv').show();
						
						$('#editCardPinDiv').load('cardPins.php', {'cardPinData': postVal, 'rData': cardPinID
											   }).fadeIn(1000);										   
											   
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','.removeCardPin',function(event){  /* remove scratch card pin */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var cardPinData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];
						
						var hInfo = 'Scratch Card Pin '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(cardPinData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click', '#removeCardPin',function(event){  /* remove scratch card pin */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeCardPin';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('cardPins.php', {'cardPinData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			}); 
			
			$('body').on('click','.editCardPin',function(event){  /* edit scratch card pin */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var cardPinID = this.id;
						var postVal = 'editCardPin';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editCardPinDiv').show();
						
						$('#editCardPinDiv').load('cardPins.php', {'cardPinData': postVal, 'rData': cardPinID
											   }).fadeIn(1000);	 
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});  

			$('body').on('click','#updateCardPin',function(){  /* update scratch card pin */
			
				$('#frmupdateCardPin').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('cardPins.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});	
			
			$('body').on('click','#load-exportRS',function(){  /* load result export page */
			
				$('#frmload-exportRS').submit(function(event) {		
						
					event.stopImmediatePropagation();
					
					showPageLoader();
							
					$.post('commonRSManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);	
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);	
						$('.wizgrade-page-icons').fadeIn(200);	 
						$('.printer-icon').fadeIn(200); 
						
					});
			  
					return false;
				
				});		
			});
			
			$('body').on('click','#exAutoScanRS',function(){  /* load auto scan page */
			
				$('#frmexAutoScanRS').submit(function(event) {		
						
					event.stopImmediatePropagation();
					
					showPageLoader();
							
					$.post('commonRSManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);	
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);	
						$('.wizgrade-page-icons').fadeIn(200);		
						$('.printer-icon').fadeIn(200);  
						
					});
			  
					return false;
				
				});		
			});

			$('body').on('click','#searchSessionRS',function(){  /* search student result by session */
			
				$('#frmRS1').submit(function(event) {		
						
					event.stopImmediatePropagation();
					
					showPageLoader();
							
					$.post('commonRSManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);	
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);	
						$('.wizgrade-page-icons').fadeIn(200);
						$('.hideTBColsBtn').fadeIn(200); 
						$('.printer-icon').fadeIn(200);
						 
					});
			  
					return false;
				
				});		
			}); 

			$('body').on('click','#classTranscript',function(){  /* auto generate class transcript */
			
				$('#frmRS2').submit(function(event) {		
						
					showPageLoader();	
				
					event.stopImmediatePropagation();
							
					$.post('commonRSManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200);
						$('.printer-icon').fadeIn(200);
						$('#ShowSelRSbttn').fadeIn(200);
						$('#show-hide-btn').fadeIn(200); 
						
					});
			  
					return false;
				
				});		
			});

			

			$('body').on('click','#studentTranscript',function(){  /* auto generate student transcript */
			
				$('#frmRS3').submit(function(event) {		
						
					showPageLoader();	
				
					event.stopImmediatePropagation();
							
					$.post('commonRSManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200); 
						$('.printer-icon').fadeIn(200); 
						
					});
			  
					return false;
				
				});		
			}); 

			$('body').on('click','#saveTeacherRS',function(){  /* save staff result profile */
			
				$('#frmsaveTeacherRS').submit(function(event) {		
						
					event.stopImmediatePropagation();
					
					$('#rsConfigLoader').show(100);
							
					$.post('rsConfigManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#msgBoxTeach').html(data);	
					 
					});
					
					$('html, body').animate({ scrollTop:  $('#scrollTarget2').offset().top - 100 }, 'fast');
		  
					return false;
				
				});		
			}); 

			$('body').on('click','#automateRS',function(){  /* automate student results */
			
				$('#frmautomateRS').submit(function(event) {		
						
					event.stopImmediatePropagation();
					
					$('#automateRS').fadeOut(100);
					$('#publishRS').fadeOut(100);
					$('#autoRSLoader').show(100);
							
					$.post('rsConfigManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#msgBoxAuto').html(data);	
					 
					});
					
					$('html, body').animate({ scrollTop:  $('#scrollTarget3').offset().top - 100 }, 'fast');
		  
					return false;
				
				});		
			}); 

			$('body').on('click','#publishRS',function(){  /* publish student results */
			
				$('#frmpublishRS').submit(function(event) {		
						
					event.stopImmediatePropagation();
					
					$('#publishRS').fadeOut(100);
					$('#autoRSLoader').show(100);
							
					$.post('rsConfigManager.php', $(this).find('select, input').serialize(), function(data) {
					
						$('#msgBoxAuto').html(data);	
					 
					});
					
					$('html, body').animate({ scrollTop:  $('#scrollTarget3').offset().top - 100 }, 'fast');
		  
					return false;
				
				});		
			});

			$('body').on('click','.show-hide-btn',function(event){  /* show or hide button */
			
					event.stopImmediatePropagation();		
					
					$('#showHideCols').trigger('click');
					$('.show-hide-btn').toggle();
					
					return false;
				
			});
	 
			
			$('body').on('click','.editRessult',function(event){  /* edit student results */
					
					event.stopImmediatePropagation();
					
					$('#overlay-rs-box').css("background-color", "#fff");
					$('#overlay-rs-box').css("padding", "10px");
					$('#overlay-rs-box').css("width", "60%");
					$('#overlay-rs-box').css("margin-top", "580px");
					$('#overlay-rs-box').css("margin-left", "10%");
					
					var varID = this.id;			
					$('.close-ov-btn').show();			
				
					showPageLoader(); 
					
					$('#overlay-rs-box').load('editRSManager.php', {'rsData': varID }).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#overlay-rs-box').offset().top - 40 }, 'fast');
				
					return false;  
			
			});
			
			
			$('body').on('click','.viewSubCommentOV',function(event){  /* view student comment results */
					
					event.stopImmediatePropagation();
					
					$('#overlay-rs-box').css("background-color", "#fff");
					$('#overlay-rs-box').css("padding", "10px");
					$('#overlay-rs-box').css("width", "60%");
					$('#overlay-rs-box').css("margin-top", "580px");
					$('#overlay-rs-box').css("margin-left", "10%");
					
					var varID = this.id;			
					$('.close-ov-btn').show();			
				
					showPageLoader(); 
					
					$('#overlay-rs-box').load('editCommentManager.php', {'rsData': varID }).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#overlay-rs-box').offset().top - 40 }, 'fast'); 
				
					return false;  
			
			});


			$('body').on('click','.viewTermRS',function(event){  /* view student termly results */
			
					event.stopImmediatePropagation();		
					var varID = this.id;
					
					$('#overlay-rs-box').css("background-color", "#fff");
					$('#overlay-rs-box').css("padding", "10px");
					$('#overlay-rs-box').css("margin-top", "10px");
					$('#overlay-rs-box').css("width", "95%");
					$('#overlay-rs-box').css("margin-top", "580px");
					$('#overlay-rs-box').css("margin-left", "10px");
					
					$('.close-ov-btn').show();			
					
					showPageLoader();   
					$('#overlay-rs-box').load('commonRSManager.php', {'studentReg': varID }).fadeIn(1000);			
					$('html, body').animate({ scrollTop:  $('#overlay-rs-box').offset().top - 40 }, 'fast');	
				
					return false;
			
			});


			$('body').on('click','.studentConduct',function(event){  /* load student conducts page */
			
					event.stopImmediatePropagation();		

					var valEmpty = '';
					var varID = this.id;
					
					$('#wizGradeRSRight').html(valEmpty);
					showPageLoader();   
					$('#wizGradeRSRight').load('studentConduct.php', {'studentConductData': varID}).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('.rsScrollTarget').offset().top - 70 }, 'slow');
							
				
					return false;
			
			});

			
			$('body').on('click','.studentConducts',function(event){  /* load student conducts page */
			
					event.stopImmediatePropagation();		
					var varID = this.id;
					
					$('#overlay-rs-box').css("background-color", "#fff");
					$('#overlay-rs-box').css("padding", "10px");
					$('#overlay-rs-box').css("margin-top", "10px");
					$('#overlay-rs-box').css("width", "50%");
					$('#overlay-rs-box').css("margin-top", "580px");
					$('#overlay-rs-box').css("margin-left", "10%");
					$('.close-ov-btn').show();
					
					showPageLoader();   
					$('#overlay-rs-box').load('studentConduct.php', {'studentConductData': varID}).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#overlay-rs-box').offset().top - 40 }, 'fast');
					
				
					return false;
			
			});
			
			$('body').on('click','#saveConducts',function(){  /* save student conducts */
			
				$('.frmConducts').submit(function(event) {
								
					event.stopImmediatePropagation();
					
					$('.conductLoader').fadeIn(100);
							
					$.post('studentConductManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#msgBoxC').html(data);
						$('html, body').animate({ scrollTop:  $('#scrollToTarget').offset().top - 30 }, 'fast'); 
						
					});
			  
					return false;
				
				});		
			});
			

			
			$('body').on('click','.exit-overlay-box',function(event){  /* exit overlay div */
			
				event.stopImmediatePropagation();		
				
				$('#overlay-rs-box').fadeOut(300);
				//hide("blind", { direction: "horizontal" }, 1000);
			
			});

			$('body').on('click','.exit-overlay-box-2',function(event){  /* exit overlay div */
			
				event.stopImmediatePropagation();		
				
				$('#overlay-box-2').fadeOut(300);
				//hide("blind", { direction: "horizontal" }, 1000);
			
			});
			
			$('body').on('click','.exit-overlay-box-3',function(event){  /* exit overlay div */
			
				event.stopImmediatePropagation();		
				
				$('#overlay-box-3').fadeOut(300);
				//hide("blind", { direction: "horizontal" }, 1000);
			
			}); 

			$('body').on('click','#saveRS',function(){  /* save student result */
			
				$("#frmSaveRs").submit(function(event) {		
						
					showPageLoader();	
				
					event.stopImmediatePropagation();
					
					$.post('vRSManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#msgBox').html(data);
						
					});
		  
					return false;
				
				});		
				
			});
			
			$('body').on('click','#saveSubComment',function(){  /* save student comment */
			
				$("#frmsaveSubComment").submit(function(event) {		
						
					showPageLoader();	
				
					event.stopImmediatePropagation();
					
					$.post('vRSManager.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#msgBox').html(data);
						
					});
		  
					return false;
				
				});		
			});

			$('body').on('click','.editRS',function(event){  /* edit student result */
			
					event.stopImmediatePropagation();
					
					var valEmpty = '';
					var varID = this.id;
					$('#wizGradeRSRight').html(valEmpty);
					
					showPageLoader();   
					
					$('#wizGradeRSRight').load('editRSManager.php', {'rsData': varID }).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('.rsScrollTarget').offset().top - 70 }, 'slow');		
				
					return false;  
				
			});

			$('body').on('click','.viewSubComment',function(event){  /* view comment result */
			
					event.stopImmediatePropagation();
					
					var valEmpty = '';
					var varID = this.id;
					$('#wizGradeRSRight').html(valEmpty);
					
					showPageLoader();   
					
					$('#wizGradeRSRight').load('editCommentManager.php', {'rsData': varID }).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('.rsScrollTarget').offset().top - 70 }, 'slow');
					
					return false;  
			
			});


			$('body').on('click','#inputResults',function(event){  /* save student result */
			
					event.stopImmediatePropagation();
				
					showPageLoader();   
					var valEmpty = '';
				
					$('#wizGradeRSRight').html(valEmpty);
					$('#frmSaveRs').slideDown(300);
					$('#wizGradeRSRight').load('inrsManager.php', {'rsData': $(this).attr('href')}).fadeIn(1000); 
				
					return false;  
			
			});

			$('body').on('click','.link_rs',function(event){  /* scroll student result */
				
					event.stopImmediatePropagation();	

					$("#regnum").val($(this).attr('href'));
					$('html, body').animate({ scrollTop:  $('.rsScrollTarget').offset().top - 70 }, 'slow');
					
					return false;
					
			});
			
			
			$('body').on('click','#manualRSAdd',function(){  /* save student result */
			
				$('#frmmanualRSAdd').submit(function(event) {	
				
					showPageLoader();	
				
					event.stopImmediatePropagation();	
					
					$.post('manualRSManager.php', $(this).find('select, input').serialize(), function(data) {
					
						$('#wizgrade-page-div').html(data);
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200);	
						
					});
				
					return false;
				
				});		
			});
			
			$('body').on('click','#saveExam',function(){  /* save online exam */
			
				$('#frmsaveExam').submit(function(event) {

					event.stopImmediatePropagation();
					
					showPageLoader();	
							
					$.post('wizGradeExam.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200);									
						$('.printer-icon').fadeIn(200);	
					
					});
		  
					return false;
				
				});
				
			});

			
			$('body').on('click','.viewExam',function(event){  /* view online exam */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var examID = this.id;
						var postVal = 'viewExam';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editExamDiv').show();
						
						$('#editExamDiv').load('wizGradeExam.php', {'onlineExamData': postVal, 'eData': examID
											   }).fadeIn(1000);		 
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','.removeExam',function(event){  /* remove online exam */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var onlineExamData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];
						
						var hInfo = 'Exam '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(onlineExamData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			});
			
			
			$('body').on('click', '#removeExam',function(event){  /* remove online exam */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeExam';
						var eData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('wizGradeExam.php', {'onlineExamData': postVal, 'eData': eData
											   }).fadeIn(1000);					
						
						return false;  
			
			});


			$('body').on('click','.editExam',function(event){  /* edit online exam */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var examID = this.id;
						var postVal = 'editExam';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editExamDiv').show();
						
						$('#editExamDiv').load('wizGradeExam.php', {'onlineExamData': postVal, 'eData': examID
											   }).fadeIn(1000);											   
											   
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			
			
			$('body').on('click','#updateExam',function(){  /* update online exam */
			
				$('#frmupdateExam').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeExam.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			
			$('body').on('click', '.addExamQuest',function(event){  /* save exam question */
			
						event.stopImmediatePropagation();											
						
						showPageLoader();	
						
						var postVal = 'addQuestion';
						var examData = this.id.split('-');
						var eID = examData[1];
						
						$('#examQuestDiv').load('wizGradeExam.php', {'onlineExamData': postVal, 'eID': eID
											   }).fadeIn(1000);					
						
						return false;  
			
			});
			
			
			
			$('body').on('click','.viewQuestion',function(event){  /* view exam question */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var questionID = this.id;
						var postVal = 'viewQuestion';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editQuestionDiv').show();
						
						$('#editQuestionDiv').load('wizGradeQuestions.php', {'questionData': postVal, 'rData': questionID
											   }).fadeIn(1000);											   
											   
						
						$('#modalEditQBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','.removeQuestion',function(event){  /* remove exam question */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var questionData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];
						
						var hInfo = 'Exam Question: '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(questionData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveQBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click', '#removeQuestion',function(event){  /* remove exam question */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeQuestion';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('wizGradeQuestions.php', {'questionData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			}); 

			$('body').on('click','.editQuestion',function(event){  /* edit exam question */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var qData = this.id.split('-');
						var questionID = qData[1];
						var examID = qData[2];
						
						var postVal = 'editQuestion';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editQuestionDiv').show();
						
						$('#editQuestionDiv').load('wizGradeQuestions.php', {'questionData': postVal, 'questionID': questionID, 'examID': examID
															   }).fadeIn(1000);		 
															   
						$('#modalEditQBtn').trigger('click');					
						
						return false;  
			
			});
			
			
			$('body').on('click','#updateQuestion',function(){  /* update exam question */
			
				$('#frmupdateQuestion').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeQuestions.php', $(this).find('select, input, textarea, file').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('change','#eQuestionPic',function(event){  /* save exam question picture */
					
					event.stopImmediatePropagation();
					
					$("#frmupdateQuestion").ajaxForm({target: '#editMsg', 
							
							beforeSubmit:function(){ 
						
							console.log('v');
								$("#editLoader").show();
								
								
								}, 
							success:function(){ 
								console.log('z');
								 $("#editLoader").hide();
								 
								}, 
							error:function(){ 
								console.log('d');
								 $("#editLoader").hide();
								 
								} }).submit();
								
													
				  return false
				  
			});

			$('body').on('click','#saveAssign',function(){  /* save assignment */
			
				$('#frmsaveAssign').submit(function(event) {

					event.stopImmediatePropagation();
					
					showPageLoader();	
							
					$.post('wizGradeAssign.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#wizgrade-page-div').html(data);		
						$('#wizgrade-page-div').slideDown(2000);
						$('.wizgrade-section-div').slideUp(2000);
						$('.wizgrade-page-icons').fadeIn(200);									
						$('.printer-icon').fadeIn(200);	
					
					});
		  
					return false;
				
				});
				
			});

			
			$('body').on('click','.viewAssign',function(event){  /* view assignment */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var assignID = this.id;
						var postVal = 'viewAssign';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editAssignDiv').show();
						
						$('#editAssignDiv').load('wizGradeAssign.php', {'onlineAssignData': postVal, 'eData': assignID
											   }).fadeIn(1000); 
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','.removeAssign',function(event){  /* remove assignment */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var onlineAssignData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];
						
						var hInfo = 'Assignment '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(onlineAssignData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click', '#removeAssign',function(event){  /* remove assignment */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeAssign';
						var eData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('wizGradeAssign.php', {'onlineAssignData': postVal, 'eData': eData
											   }).fadeIn(1000);					
						
						return false;  
			
			}); 

			$('body').on('click','.editAssign',function(event){  /* edit assignment */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var assignID = this.id;
						var postVal = 'editAssign';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editAssignDiv').show();
						
						$('#editAssignDiv').load('wizGradeAssign.php', {'onlineAssignData': postVal, 'eData': assignID
											   }).fadeIn(1000);		 
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			
			
			$('body').on('click','#updateAssign',function(){  /* update assignment */
			
				$('#frmupdateAssign').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeAssign.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			
			$('body').on('click', '.addAssignQuest',function(event){  /* save assignment question */
			
						event.stopImmediatePropagation();											
						
						showPageLoader();	
						
						var postVal = 'addQuestion';
						var assignData = this.id.split('-');
						var eID = assignData[1];
						
						$('#assignQuestDiv').load('wizGradeAssign.php', {'onlineAssignData': postVal, 'eID': eID
											   }).fadeIn(1000);					
						
						return false;  
			
			});
			
			
			
			$('body').on('click','.viewAssignQuestion',function(event){  /* view assignment question */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var questionID = this.id;
						var postVal = 'viewAssignQuestion';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editAssignQuestionDiv').show();
						
						$('#editAssignQuestionDiv').load('wizGradeAssignQuestions.php', {'assignQuestionData': postVal, 'rData': questionID
											   }).fadeIn(1000);	 
						
						$('#modalEditQBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','.removeAssignQuestion',function(event){  /* remove assignment question */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var assignQuestionData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];
						
						var hInfo = 'Assignment Question: '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(assignQuestionData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveQBtn').trigger('click');					
						
						return false;  
			
			});			
			
			$('body').on('click', '#removeAssignQuestion',function(event){  /* remove assignment question */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeAssignQuestion';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('wizGradeAssignQuestions.php', {'assignQuestionData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			}); 

			$('body').on('click','.editAssignQuestion',function(event){  /* edit assignment question */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var qData = this.id.split('-');
						var questionID = qData[1];
						var assignID = qData[2];
						
						var postVal = 'editAssignQuestion';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editAssignQuestionDiv').show();
						
						$('#editAssignQuestionDiv').load('wizGradeAssignQuestions.php', {'assignQuestionData': postVal, 'questionID': questionID, 'assignID': assignID
															   }).fadeIn(1000);		 
						
						$('#modalEditQBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click','#updateAssignQuestion',function(){  /* update assignment question */
			
				$('#frmupdateAssignQuestion').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeAssignQuestions.php', $(this).find('select, input, textarea, file').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});

			$('body').on('change','#aQuestionPic',function(event){  /* save assignment question picture */
					
					event.stopImmediatePropagation();
					
					$("#frmupdateAssignQuestion").ajaxForm({target: '#editMsg', 
							
							beforeSubmit:function(){ 
						
							console.log('v');
								$("#editLoader").show();
								
								
								}, 
							success:function(){ 
								console.log('z');
								 $("#editLoader").hide();
								 
								}, 
							error:function(){ 
								console.log('d');
								 $("#editLoader").hide();
								 
								} }).submit();
								
													
				  return false
				  
			});	 
			
			function hideTBCols() {  /* hide table columns */
							 
					var data_table = $('#wizGradeTBPage').DataTable();
								
					data_table.columns('.hideColumn').visible(false);
								
					$('#hideTBColsBtn').fadeOut(200);
					$('#showTBColsBtn').fadeIn(200);
					
			}	
						
			function showTBCols() {  /* show table columns */
							 
					var data_table = $('#wizGradeTBPage').DataTable();
								
					data_table.columns('.hideColumn').visible(true);
								
					$('#hideTBColsBtn').fadeIn(200);
					$('#showTBColsBtn').fadeOut(200);
					
			}	 
			
			$('body').on('click','.show-rsconfig-div',function(event){  /* load result configuration div */
			
					event.stopImmediatePropagation();		
					
					$('.lowRSDiv').fadeIn(2000);
					$('.highRSDiv').fadeOut(2000);
					$('.show-rs-div').fadeIn(200);
					$('.show-rsconfig-div').fadeOut(200);
			
			});

			$('body').on('click','.show-rs-div',function(event){  /* load result div */
			
					event.stopImmediatePropagation();		
					
					$('.lowRSDiv').fadeOut(2000);
					$('.highRSDiv').fadeIn(2000);
					$('.show-rsconfig-div').fadeIn(200);
					$('.show-rs-div').fadeOut(200);
				
			
			}); 
			 
			$('body').on('change','#uploadSchlogo',function(event){  /* upload school logo */
					
					event.stopImmediatePropagation();
					$(".msgBoxPic").html('');
					
					$("#frmSchPic").ajaxForm({target: '.msgBoxPic', 
							
							beforeSubmit:function(){ 
						
							console.log('v');
								showPageLoader();	
								
								
								}, 
							success:function(){ 
								console.log('z');
								hidePageLoader();  /* hide page loader */	
								 
								}, 
							error:function(){ 
								console.log('d');
								hidePageLoader();  /* hide page loader */	
								 
								} }).submit();
								
					 
															
					return false
				  
			});	 
			
			$('body').on('change','#bulkRSExcel',function(event){  /* upload bulk result */
					
					event.stopImmediatePropagation();
					$("#wizgrade-page-div").html('');
					
					$("#frmbulkRSExcel").ajaxForm({target: '#wizgrade-page-div', 
							
							beforeSubmit:function(){ 
						
							console.log('v');
								showPageLoader();	
								
								
								}, 
							success:function(){ 
								console.log('z');
								hidePageLoader();  /* hide page loader */	
								 
								}, 
							error:function(){ 
								console.log('d');
								hidePageLoader();  /* hide page loader */	
								 
								} }).submit();
								
					$('#wizgrade-page-div').slideDown(2000);
					$('.wizgrade-section-div').slideUp(2000);
					$('.wizgrade-page-icons').fadeIn(200);	
															
					return false
				  
			});	
			
			$('body').on('change','#bulkSubComExcel',function(event){  /* upload bulk comment result */
					
					event.stopImmediatePropagation();
					$("#wizgrade-page-div").html('');
					
					$("#frmbulkSubComExcel").ajaxForm({target: '#wizgrade-page-div', 
							
							beforeSubmit:function(){ 
						
							console.log('v');
								showPageLoader();	
								
								
								}, 
							success:function(){ 
								console.log('z');
								hidePageLoader();  /* hide page loader */	
								 
								}, 
							error:function(){ 
								console.log('d');
								hidePageLoader();  /* hide page loader */	
								 
								} }).submit();
								
					$('#wizgrade-page-div').slideDown(2000);
					$('.wizgrade-section-div').slideUp(2000);
					$('.wizgrade-page-icons').fadeIn(200);				
													
					return false
				  
			});	
			
			$('body').on('change','#bulkRegExcel',function(event){  /* upload mass registration */
					
					event.stopImmediatePropagation();
					$("#wizgrade-page-div").html('');
					
					$("#frmbulkRegExcel").ajaxForm({target: '#wizgrade-page-div', 
							
							beforeSubmit:function(){ 
						
							console.log('v');
								showPageLoader();	
								
								
								}, 
							success:function(){ 
								console.log('z');
								hidePageLoader();  /* hide page loader */	
								 
								}, 
							error:function(){ 
								console.log('d');
								hidePageLoader();  /* hide page loader */	
								 
								} }).submit();
								
					$('#wizgrade-page-div').slideDown(2000);
					$('.wizgrade-section-div').slideUp(2000);
					$('.wizgrade-page-icons').fadeIn(200);				
													
					return false
				  
			});	 
			
			$('body').on('change','#uploadStudentPic',function(event){  /* upload student picture */
					
					event.stopImmediatePropagation();
					
					$("#frmBioPic").ajaxForm({target: '.msgBoxPic', 
							
							beforeSubmit:function(){ 
						
							console.log('v');
								showPageLoader();					 									
								}, 
							success:function(){ 
								console.log('z');
								 hidePageLoader();  /* hide page loader */				 		 
								}, 
							error:function(){ 
								console.log('d');
								 hidePageLoader();  /* hide page loader */						 
								} }).submit();
								
													
				  return false
				  
			});		
			
			$('body').on('change','#uploadStaffPic',function(event){  /* upload staff picture */
					
					event.stopImmediatePropagation();
					
					$("#frmBioTPic").ajaxForm({target: '.msgBoxPic', 
							
							beforeSubmit:function(){ 
						
							console.log('v');
								showPageLoader();					 									
								}, 
							success:function(){ 
								console.log('z');
								 hidePageLoader();  /* hide page loader */				 		 
								}, 
							error:function(){ 
								console.log('d');
								 hidePageLoader();  /* hide page loader */						 
								} }).submit();
								
													
				  return false
				  
			});		



			$('body').on('change','#uploadSignature',function(event){  /* upload staff signature */
					
					event.stopImmediatePropagation();
					
					$("#frmBioSign").ajaxForm({target: '.msgBoxSign', 
							
							beforeSubmit:function(){ 
						
							console.log('v');
								showPageLoader();					 									
								}, 
							success:function(){ 
								console.log('z');
								 hidePageLoader();  /* hide page loader */				 		 
								}, 
							error:function(){ 
								console.log('d');
								 hidePageLoader();  /* hide page loader */						 
								} }).submit();
								
													
				  return false
				  
			});	 
			 
			
			$('body').on('change','#uploadAdminPic',function(event){  /* upload admin picture */
					
					event.stopImmediatePropagation();
					
					$("#frmAminPic").ajaxForm({target: '.msgBoxPic', 
							
							beforeSubmit:function(){ 
						
							console.log('v');
								showPageLoader();					 									
								}, 
							success:function(){ 
								console.log('z');
								 hidePageLoader();  /* hide page loader */				 		 
								}, 
							error:function(){ 
								console.log('d');
								 hidePageLoader();  /* hide page loader */						 
								} }).submit();
								
													
				  return false
				  
			});		 

			$('body').on('change','#state',function(){  /* load state div */			
				
					$('#wait_1').show();
					$('#result_1').hide();
					$('#fi_lga').hide();
					
					$.get("emji_lga.php", {
						func: "state",
						drop_var: $('#state').val()
					}, function(response){
					 $('#result_1').fadeOut();
						setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
					});
					
					return false;
			});
			
			$('body').on('change','#teacherDiv',function(){  /* load staff div */

					$('#wait_11').show();
					$('#result_11').hide();
					$.get("wizGradeDropper.php", {
					func: "teacherPic",
					teacherID: $('#teacherDiv').val()
					}, function(response){
					$('#result_11').fadeOut();
					setTimeout("finishAjax('result_11', '"+escape(response)+"')", 400);
					});
	   
					return false;
			});  

			$('body').on('keyup','.RegNumSel',function(){  /* load registration number div */
			
						$('#wait_1').show();
						$('#result_1').hide();
						$.get("wizGradeDropper.php", {
						func: "SelectLevel",
						RegNum: $('.RegNumSel').val()
						}, function(response){
						$('#result_1').fadeOut();
						setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
						});
			   
						return false;
			});

			$('body').on('change','.RegNumNew',function(){  /* load registration number div */
			
						$('#wait_11').show();
						$('#result_11').hide();
						$.get("wizGradeDropper.php", {
						func: "CheckRegNum",
						RegNum: $('.RegNumNew').val()
						}, function(response){
						$('#result_11').fadeOut();
						setTimeout("finishAjax('result_11', '"+escape(response)+"')", 400);
						});
				   
						return false;
			});


			$('body').on('change','#level',function(){  /* load school level div */
				
						$('#wait_1').show();
						$('#result_1').hide();
						$.get("wizGradeDropper.php", {
						func: "studentLevel",
						level: $('#level').val()
						}, function(response){
						$('#result_1').fadeOut();
						setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
						});
				   
						return false;
			});
			
			$('body').on('change','#sesslevel',function(){  /* load school session div */
				
						$('#wait_1').show();
						$('#result_1').hide();
					  
						var allClass = $('#classAll').val();
					  
						if (typeof allClass === "undefined") {
						  
						  var allClass = 0;
						  
						}	  
						$.get("wizGradeDropper.php", {
							func: "sLevel",
							classAll: allClass,
							level: $('#sesslevel').val()
						}, function(response){
							$('#result_1').fadeOut();
							setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
						});
				   
					return false;
			});
			
			$('body').on('change','#studentClass',function(){  /* select student class */
				
						var selClass = $(this).val();
				  
						if(selClass == 'all'){
					
							$("select#schoolTerm option[value='annual']").remove(); 	
						
						}else{
					  
							$("select#schoolTerm option[value='annual']").remove(); 	
							$("#schoolTerm").append('<option value="annual">Annual Results</option>');
						}		
			   
					return false;
			});

			$('body').on('change','#subjectLevel',function(){  /* load student subject level */
				
						$('#wait_1').show();
						$('#result_1').hide();
					  
						var allClass = $('#classAll').val();
						
						if (typeof allClass === "undefined") {
						  
							var allClass = 0;
						  
						}	  
					  
						$.get("wizGradeDropper.php", {
							subjData: "subjLevel",
							classAll: allClass,
							subjTerm: $('#subjTerm').val(),
							level: $('#subjectLevel').val(),
							euData: $('#euData').val()
						}, function(response){
							$('#result_1').fadeOut();
							setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
						});
				   
						return false;
			});		 
			
			$('body').on('change','#subjTerm',function(){  /* load student subject term level */
					
						$('#result_1, #subjectExamDiv').hide();	
						$('#wait').show();
						$("#subjectLevel").val("");
						$.get("wizGradeDropper.php", {
							subjTerm: "subjDropTerm",
							term: $('#subjTerm').val()
						}, function(response){
						  
							$('#result').fadeOut();
							setTimeout("finishAjax('result', '"+escape(response)+"')", 400);
						 
						});
				   
						return false;
			}); 

			$('body').on('change','#levelReg',function(){  /* load school level */
				
						$('#wait_1').show();
						$('#result_1').hide();
						$.get("wizGradeDropperHome.php", {
							func: "stuLevelReg",
							level: $('#levelReg').val()
						}, function(response){
							$('#result_1').fadeOut();
							setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
						});
				   
						return false;
			}); 

			$('body').on('change','#levelCM',function(){  /* load school level */
				
						  $('#wait_1').show();
						  $('#result_1').hide();
						  $.get("wizGradeDropper.php", {
							func: "studentLevelCM",
							level: $('#levelCM').val()
						  }, function(response){
							$('#result_1').fadeOut();
							setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
						  });
					   
						return false;
			}); 

			$('body').on('change','#ftSession',function(){  /* load school session */
				
						  $('#wait_1').show();
						  $('#result_1').hide();
						  $.get("wizGradeDropper.php", {
							func: "fteachSession",
							session: $('#ftSession').val()
						  }, function(response){
							$('#result_1').fadeOut();
							setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
						  });
					   
						return false;
			});

			$('body').on('change','#ftlevel',function(){  /* load staff school level */
				
						  $('#wait_11').show();
						  $('#result_11').hide();
						  $.get("wizGradeDropper.php", {
							func: "fteachLevel",
							level: $('#ftlevel').val(),
							session: $('#ftSession').val()
						  }, function(response){
							$('#result_11').fadeOut();
							setTimeout("finishAjax('result_11', '"+escape(response)+"')", 400);
						  });
				   
						return false;
			});
			
			$('body').on('change','#ftSessL',function(){  /* load staff school session */
				
						  $('#wait_1').show();
						  $('#result_1').hide();
						  $.get("wizGradeDropper.php", {
							func: "sessionLev",
							level: $('#ftSessL').val()
						  }, function(response){
							$('#result_1').fadeOut();
							setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
						  });
				   
						return false;
			}); 

			$('body').on('change','#certifyRS',function(){  /* certify student result */
				
					  $('#wait_1').show();
					  $('#result_1').hide();
					  $.get("wizGradeDropper.php", {
						func: "Certify",
						certify: $('#certifyRS').val()
					  }, function(response){
						$('#result_1').fadeOut();
						setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
					  });
				   
					return false;
			});
 
			function finishAjax(id, response) {  /* load div */
				$('#wait, #wait_1, #wait_11, #wait_111, #fi_lga').hide();
				$('#'+id).html(unescape(response));
				$('#'+id).fadeIn();
			} 

			function finishAjax_tier_three(id, response) {  /* load div */
				$('#wait_2').hide();
				$('#'+id).html(unescape(response));
				$('#'+id).fadeIn();
			} 
			 
			setInterval(function() {  /* check inactivity user time */

				var timerData = 'checkADMINTimer';

				$('#wizGradePageMsg').load('timerActivityManager.php', {'timeOutType': timerData});
				
			}, 30000);  

			$('body').on('click','#timeOutLogin',function(){  /* screen lock validation */
			
				$('#frmTimeOut').submit(function(event) {		
						
					$('.timeOutLoader').fadeIn(100);
				
					event.stopImmediatePropagation();
							
					$.post('timeOutManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#timeOutMsg').html(data);	
						$('.timeOutLoader').fadeOut(1000); 
					
					});
		  
					return false;
				
				});		
			}); 

			$('body').on('click', '#changeAPass', function(event){  /* change admin password */
																		
				$('#frmchangeAPass').submit(function(event) {
								
					event.stopImmediatePropagation();
					
					showPageLoader();
							
					$.post('adminChangePass.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#msgBox').html(data);
																	
					});
					
					$('html, body').animate({scrollTop:$('#msgBox').position().top}, 'slow'); 
		  
					return false;
				
				});	
										
			}); 

			$('body').on('click', '#changeSPass', function(event){  /* change staff password */
																		
				$('#frmchangeSPass').submit(function(event) {
								
					event.stopImmediatePropagation();
					
					showPageLoader();
							
					$.post('changeStaffPass.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#msgBox').html(data); 
															
					});
					
					$('html, body').animate({scrollTop:$('#msgBox').position().top}, 'slow'); 
		  
					return false;
				
				});	
										
			});  
			
			$('body').on('click','.editAminBio',function(event){  /* edit admin profile */
			
				event.stopImmediatePropagation();
			
				showPageLoader();   
				$('#adminBioDiv').load('adminBio.php', {'editAdmin': $(this).attr('href')}).fadeIn(1000);
				$('html, body').animate({ scrollTop:  $('.scrollTargetMPage').offset().top - 30 }, 'slow'); 
			
				return false; 
			
			});

			$('body').on('click','#saveStep1',function(){  /* save admin profile */
			
				$('#frmStep1').submit(function(event) {
								
					event.stopImmediatePropagation();
					
					$('.BioDataLoader').fadeIn(100);
							
					$.post('adminProfileManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('.msgBox1').html(data);
																	
					});
					
					$('html, body').animate({ scrollTop:  $('.wizGradeScrollTarget').offset().top - 50 }, 'slow');
		  
					return false;
				
				});		
			}); 

			$('body').on('click','#saveStep2',function(){  /* save admin profile */
			
				$('#frmStep2').submit(function(event) {
								
					event.stopImmediatePropagation();
					
					$('.adminLoader').fadeIn(100);
							
					$.post('adminProfileManager.php', $(this).find('select, input').serialize(), function(data) {
						
						$('.msgBox2').html(data);
					
					});
					
					$('html, body').animate({ scrollTop:  $('.wizGradeScrollTarget').offset().top - 50 }, 'slow');
		  
					return false;
				
				});		
			}); 

			$('body').on('click','#saveStep3',function(){  /* save admin profile */
			
				$('#frmStep3').submit(function(event) {
								
					event.stopImmediatePropagation();
					
					$('.adminLoader').fadeIn(100);
							
					$.post('adminProfileManager.php', $(this).find('select, input').serialize(), function(data) {

						$('.msgBox3').html(data);						
					
					});
					
					$('html, body').animate({ scrollTop:  $('.wizGradeScrollTarget').offset().top - 50 }, 'slow');
		  
					return false;
				
				});		
			});  

			$('body').on('click','.cfEdit',function(event){  /* edit school subject information */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var cfID = clickedID[1];
						var postValCC = 'cfEditCC';
						var postValCT = 'cfEditCT';
						var courseCode = $('#editCourseCf-'+cfID).text();
						var courseTitle = $('#editCourseTf-'+cfID).text();

						$('#cfLoader-'+cfID).fadeIn(100);
						
						$('#editCourseCf-'+cfID).load('wizGradeSubjsManager.php', {'subConfig': postValCC, 'courseCode': courseCode,
															  'cfID': cfID  }).fadeIn(1000);
						
						$('#editCourseTf-'+cfID).load('wizGradeSubjsManager.php', {'subConfig': postValCT,  'courseTitle': courseTitle,
															  'cfID': cfID  }).fadeIn(1000);
						
						return false;  
			
			}); 

			$('body').on('click','.cfUpdate',function(event){  /* update school subject information */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var cfID = clickedID[1];
						var postValCC = 'cfUpdateCC';
						var postValCT = 'cfUpdateCT';
						var courseCode = $('#cfSubjC-'+cfID).val();
						var courseTitle = $('#cfSubjT-'+cfID).val();

						$('#cfLoader-'+cfID).fadeIn(100);
						
						$('#editCourseCf-'+cfID).load('wizGradeSubjsManager.php', {'subConfig': postValCC, 'courseCode': courseCode,
															  'cfID': cfID  }).fadeIn(1000);
						
						$('#editCourseTf-'+cfID).load('wizGradeSubjsManager.php', {'subConfig': postValCT,  'courseTitle': courseTitle,
															  'cfID': cfID  }).fadeIn(1000);
						
						return false;  
			
			}); 

			$('body').on('click','.csEdit',function(event){  /* edit school subject information */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var csID = clickedID[1];
						var postValCC = 'csEditCC';
						var postValCT = 'csEditCT';
						var courseCode = $('#editCourseCs-'+csID).text();
						var courseTitle = $('#editCourseTs-'+csID).text();

						$('#csLoader-'+csID).fadeIn(100);
						
						$('#editCourseCs-'+csID).load('wizGradeSubjsManager.php', {'subConfig': postValCC, 'courseCode': courseCode,
															  'csID': csID  }).fadeIn(1000);
						
						$('#editCourseTs-'+csID).load('wizGradeSubjsManager.php', {'subConfig': postValCT,  'courseTitle': courseTitle,
															  'csID': csID  }).fadeIn(1000);
						
						return false;  
			
			}); 

			$('body').on('click','.csUpdate',function(event){  /* update school subject information */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var csID = clickedID[1];
						var postValCC = 'csUpdateCC';
						var postValCT = 'csUpdateCT';
						var courseCode = $('#csSubjC-'+csID).val();
						var courseTitle = $('#csSubjT-'+csID).val();

						$('#csLoader-'+csID).fadeIn(100);
						
						$('#editCourseCs-'+csID).load('wizGradeSubjsManager.php', {'subConfig': postValCC, 'courseCode': courseCode,
															  'csID': csID  }).fadeIn(1000);
						
						$('#editCourseTs-'+csID).load('wizGradeSubjsManager.php', {'subConfig': postValCT,  'courseTitle': courseTitle,
															  'csID': csID  }).fadeIn(1000);
						
						return false;  
			
			}); 

			$('body').on('click','.ctEdit',function(event){  /* edit school subject information */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var ctID = clickedID[1];
						var postValCC = 'ctEditCC';
						var postValCT = 'ctEditCT';
						var courseCode = $('#editCourseCt-'+ctID).text();
						var courseTitle = $('#editCourseTt-'+ctID).text();

						$('#ctLoader-'+ctID).fadeIn(100);
						
						$('#editCourseCt-'+ctID).load('wizGradeSubjsManager.php', {'subConfig': postValCC, 'courseCode': courseCode,
															  'ctID': ctID  }).fadeIn(1000);
						
						$('#editCourseTt-'+ctID).load('wizGradeSubjsManager.php', {'subConfig': postValCT,  'courseTitle': courseTitle,
															  'ctID': ctID  }).fadeIn(1000);
						
						return false;  
			
			}); 

			$('body').on('click','.ctUpdate',function(event){  /* update school subject information */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var ctID = clickedID[1];
						var postValCC = 'ctUpdateCC';
						var postValCT = 'ctUpdateCT';
						var courseCode = $('#ctSubjC-'+ctID).val();
						var courseTitle = $('#ctSubjT-'+ctID).val();

						$('#ctLoader-'+ctID).fadeIn(100);
						
						$('#editCourseCt-'+ctID).load('wizGradeSubjsManager.php', {'subConfig': postValCC, 'courseCode': courseCode,
															  'ctID': ctID  }).fadeIn(1000);
						
						$('#editCourseTt-'+ctID).load('wizGradeSubjsManager.php', {'subConfig': postValCT,  'courseTitle': courseTitle,
															  'ctID': ctID  }).fadeIn(1000);
						
						return false;  
			
			}); 
			
			$('body').on('click', '#saveSubjects',function(event){  /* save school subject information */
			
						event.stopImmediatePropagation();	
											
						var postVal = 'saveSubj';

						var courseCode = $('#courseCode').val();
						var courseTitle = $('#courseTitle').val();
						var courseTerm = $('#courseTerm').val();
						var courseLevel = $('#courseLevel').text();
						
						var fiTermLast = $('#fiTermLast').val();
						var seTermLast = $('#seTermLast').val();
						var thTermLast = $('#thTermLast').val();
						
						//$('#ctLoader-'+ctID).fadeIn(100);
						$('#saveSubjects').fadeOut(100);
						$('#msgBoxSubjs').load('wizGradeSubjsManager.php', {'subConfig': postVal, 'courseCode': courseCode, 'courseTitle':courseTitle,
											   'courseTerm': courseTerm, 'courseLevel': courseLevel, 'fiTermLast': fiTermLast,
											   'seTermLast': seTermLast, 'thTermLast': thTermLast }).fadeIn(1000);
						
						$('#saveSubjects').fadeIn(10000);
						
						
						return false;  
			
			});

			$('body').on('click', '#refreshSubjsTab',function(event){  /* refresh school subject information */
			
						event.stopImmediatePropagation();	
											
						var postVal = 'saveSubj';

						var courseLevel = $('#courseLevel').text();
						var courseTerm = $('#couTerm').text();
						
						$('#subj-loader').fadeIn(100);
						
						$('#refreshDiv').load('wizGradeSubjsRefresher.php', {'subConfig': postVal, 'courseLevel': courseLevel,
											  'courseTerm': courseTerm,}).fadeIn(1000);
						
						
						return false;  
			
			});

			$('body').on('click','.removeSubjInfo',function(event){  /* remove school subject information */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var cfData = this.id;
						var cfCode = clickedID[5];					
						var cfTitle = clickedID[6];					
						var cfSubjInfo = 'Subject Code - '+cfCode+' and Title - '+cfTitle;					
						$('#removeInfo').text(cfSubjInfo);
						$('#removeSubData').text(cfData);					
						$('#modalRemoveBtn').trigger('click');
						
						
						return false;  
			
			});

			$('body').on('click', '#removeSubjBtn',function(event){  /* remove school subject information */
			
						event.stopImmediatePropagation();											
						var postVal = 'removeSubj';

						var courseData = $('#removeSubData').text();
						var adminPass = $('#adminPass').val();
						
						$('#subj-loader').fadeIn(100);
						
						$('#msgBoxSubjs').load('wizGradeSubjsManager.php', {'subConfig': postVal, 'courseData': courseData, 'adminPass' :adminPass
											   }).fadeIn(1000);					
						
						return false;  
			
			}); 
			
			
			$('body').on('change','#chartYears',function(event){  /* load bursary chart */	  
			
						event.stopImmediatePropagation(); 
						
						var emptyStr = "";
						var postVal = 'bursarySumm';				
						
						var chartYear =  $(this).val();
						
						if(chartYear != ""){
							
							showPageLoader();	
							$('#bursaryChart').html(emptyStr);
							
							$('#bursaryChart').load('busaryCharts.php', {'chartData': postVal, 'chartYear': chartYear
												   }).fadeIn(1000);											   
												   
						}
						return false;  
			
			});

			
			$("body").on("change", "#google_translate_element select", function (e) {  /* google translate*/
				//console.log(e);
				//console.log($(this).find(":selected").text());
				//console.log($(this).find(":selected").val());
				$('.translateBtn').trigger('click');
			});
			
			<?php require ($companionScriptJS);   /* iclude companion jquery scripts */ ?>
 


		</script>
            
           
			
            
		<?php
		
		}else{
			
			exit;
			
		
		
		}
		?>
