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
	This script handle libranian jQuery/Javascript
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     		define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         	require 'configwizGrade.php';  /* load wizGrade configuration files */	   
     
		 	if (($_POST['pageType']) == 'loadScript') {

?>

		<script type="text/javascript"> 
 
			$('body').on('click', '#changeSPass', function(event){  /* change password */	  
																		
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

			$('body').on('click','#libConfiguration',function(){  /* library configuration */	  
			
				$('#frmlibConfiguration').submit(function(event) {		
					
					$('#settingsLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
						
					$.post('wizGrade-library-configuration.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#msgBoxLib').html(data);	
						$('html, body').animate({scrollTop:$('#scrollLTarget').position().top}, 'slow'); 
					
					});
	  
					return false;
			
				});		
			}); 

			$('body').on('change','#book-lib-upload',function(){  /* upload library book */	  
					
				$(".msgBoxPic").html('');
				
				showPageLoader();	
				
				$("#frmLibrary").ajaxForm({
						target: '.msgBoxPic'
				}).submit();
				
				hidePageLoader();  /* hide page loader */ 
					
			});		 

			$('body').on('change','#book-type',function(){  /* selec book type */	  
					
				var bookType = $('#book-type').val();
				
				if(bookType == 1){
					
					$('#book-picture-div, #allow-format-doc').show(500);
					$('.book-harhcopy-divs, #allow-format-pic').hide(500);
					$('#book-name-display').text('Upload Electronic Book');
					$('#allow-format').val('1');
					
				}else if (bookType == 2){
					
					$('#book-picture-div').show(500);
					$('.book-harhcopy-divs, #allow-format-pic').show(500);
					$('#allow-format-doc').hide(500);
					$('#book-name-display').text('Upload Book Cover Picture ');
					$('#allow-format').val('2');
				
				}else{
					
					$('#book-picture-div, .book-harhcopy-divs, #allow-format-doc, #allow-format-pic').hide(500);
					$('#book-name-display').text('Book Upload');
					$('#allow-format').val('');
				
				}
					 
			});		 

			$('body').on('change','.edit-library-book',function(event){  /* edit library book */	  
			
				event.stopImmediatePropagation();					
				
				var bookLIBID = this.id.split('-');
				var bookID = bookLIBID[2];
				var bookData = 'update-lib-book';
				var bookName = $('#book-name-'+bookID).val();
				
				showPageLoader();   
				
				$('#lib-book-msg').load('wizGrade-library-manager.php', {'library-data': bookData, 
										'bookID': bookID, 'bookName': bookName }).fadeIn(1000); 
	
				return false;  
			
			}); 

			$('body').on('click','.remove-lib-book',function(event){  /* remove library book */
			
						event.stopImmediatePropagation();	
						
						var clickedID = this.id.split('-');
						var libraryData = this.id;
						var bookID = clickedID[2];
						var bookName = clickedID[3];
						var bookPic = $('#library-pic-'+bookID).html();
											
						var libraryInfo = 'Library Book Name - '+bookName;
						
						$('#remove-lib-info').text(libraryInfo);
						$('#remove-lib-data').text(libraryData);
						$('#show-lib-pic').html(bookPic);
						
						$('#modal-lib-remove-btn').trigger('click');					
						
						return false;  
			
			});

			$('body').on('click','#remove-library-book',function(event){  /* remove library book */
			
						event.stopImmediatePropagation();					
						
						var bookLIBID = $('#remove-lib-data').text().split('-');
						//var clickedID = this.id.split('-');
						var bookID = bookLIBID[2];
						var bookData = 'remove-lib-book';
						var bookPath = $('#book-path-'+bookID).text();
						
						showPageLoader();   
						
						$('#lib-book-msg').load('wizGrade-library-manager.php', {'library-data': bookData, 
												'bookID': bookID, 'bookPath': bookPath }).fadeIn(1000); 
			
						return false;  
			
			}); 
			
			$('body').on('click','.show-lib-book',function(event){  /* show library book */
			
						event.stopImmediatePropagation();
					
						showPageLoader(); 
						
						var varID = this.id;
						
						$('#lib-edit-div').load('wizGrade-lib-show-manager.php', {'bookID': varID}).fadeIn(1000);
						$('html, body').animate({ scrollTop:  $('#scrollLTarget-t').offset().top - 30 }, 'slow'); 
					
						return false;  
			
			}); 

			$('body').on('click','.showBookHistory',function(event){  /* show library book history */
			
					event.stopImmediatePropagation();		
					
					showPageLoader();   
					
					var bookID = this.id;
					$('#modalHeadHis').text('Library Books');
					$('#modalDisplayDiv').load('wizGrade-book-history-manager.php', {'bookID': bookID}).fadeIn(1000);			
					$('.bookHistoryModal').trigger('click');
					$('#bHModalTarget').animate({ scrollTop: 0 }, 'slow'); 
				
					return false;
			
			});

			$('body').on('click','.showStudentBHistory',function(event){  /* student library book history */
			
					event.stopImmediatePropagation();		
					
					showPageLoader();   
					
					var studentData = this.id;
					$('#modalHeadHis').text('Library Students');
					$('#modalDisplayDiv').load('wizGrade-student-book-history.php', {'studentData': studentData}).fadeIn(1000);			
					$('.bookHistoryModal').trigger('click');
					$('#bHModalTarget').animate({ scrollTop: 0 }, 'slow'); 
				
					return false;
			
			}); 

			$('body').on('click','.show-pending-book-info',function(event){  /* show pending library book */
			
						event.stopImmediatePropagation();
					
						showPageLoader(); 
						
						var varID = this.id;
						
						$('#lib-edit-div').load('wizGrade-show-pending-book-info.php', {'bookID': varID}).fadeIn(1000);
						$('html, body').animate({ scrollTop:  $('#scrollLTarget-t').offset().top - 30 }, 'slow'); 
					
						return false;  
			
			}); 

			$('body').on('click','#mdiscardBookApp',function(event){  /* trigger discard library book button */
			
						event.stopImmediatePropagation();		
						
						$('.discardBookApp').trigger('click');
						
						return false;
					
			}); 
			
			$('body').on('click','.discardBookApp',function(event){  /* discard pending library book */
			
						event.stopImmediatePropagation();	

						var applyData = this.id;
						var reasons = $('#discard-reason').val();
						var libData = 'discard-application';					

						$('#book-app-loader').fadeIn(100);
						
						$('#msgBoxDiv').load('wizGrade-book-app-manager.php', {'libData': libData, 'applyData': applyData, 'reasons': reasons }).fadeIn(1000);    			
						
						return false;  
			
			});	 
			
			$('body').on('click','.approveLibBook',function(event){  /* show approved library book */
			
						event.stopImmediatePropagation();	

						var applyData = this.id;
						var reasons = $('#discard-reason').val();
						var libData = 'approve-application';					

						$('#book-app-loader').fadeIn(100);
						
						$('#msgBoxDiv').load('wizGrade-book-app-manager.php', {'libData': libData, 'applyData': applyData, 'reasons': reasons }).fadeIn(1000);    			
						
						return false;  
			
			});	 

			$('body').on('click','.edit-lib-book',function(event){  /* edit library book */
			
						event.stopImmediatePropagation();
					
						showPageLoader(); 
						
						var varID = this.id;
						
						$('#lib-edit-div').load('wizGrade-lib-edit-manager.php', {'bookID': varID}).fadeIn(1000);
						$('html, body').animate({ scrollTop:  $('#scrollLTarget-t').offset().top - 30 }, 'slow'); 
					
						return false;  
			
			}); 

			$('body').on('click','#updateLibrary',function(){  /* update library book */
			
				$('#frmupdateLibrary').submit(function(event) {		
						
					showPageLoader();	
				
					event.stopImmediatePropagation();
					
					$.post('wizGrade-library-manager.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#msgBoxLib').html(data);	 
					
					});
		  
					return false;
				
				});		
			}); 

			$('body').on('click','.appBookInfo',function(event){  /* approved library book information */
			
						event.stopImmediatePropagation();
					
						showPageLoader(); 
						
						var varID = this.id;
						
						$('#lib-edit-div').load('wizGrade-show-approved-book-info.php', {'bookID': varID}).fadeIn(1000);
						$('html, body').animate({ scrollTop:  $('#scrollLTarget-t').offset().top - 30 }, 'slow'); 
					
						return false;  
			
			});

			$('body').on('click','.certyfyBReturn',function(event){  /* certify return library book */
			
						event.stopImmediatePropagation();	

						var returnBData = this.id;
						var rComments = $('#book-r-comments').val();
						var libData = 'certify-book-return';					

						$('#book-app-loader').fadeIn(100);
						
						$('#msgBoxDiv').load('wizGrade-book-app-manager.php', {'libData': libData, 'returnBData': returnBData, 
											 'rComments': rComments }).fadeIn(1000);    			
						
						return false;  
			
			});	

			$('body').on('click','.viewStaff',function(event){  /* view staff profile */
			
					event.stopImmediatePropagation();
					
					var varID = this.id;
					
					showPageLoader();    
					
					$('#wizGradeRightHalf').load('showStaffProfile.php', {'teacherID': varID}).fadeIn(1000);
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
			
			$('body').on('click','#saveStaff1',function(){  /* save staff profile */
			
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

			$('body').on('click','#saveStaff2',function(){  /* save staff profile */
			
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

			$('body').on('click','#saveStaff3',function(){  /* save staff profile */
			
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

			$('body').on('change','#uploadStaffPic',function(event){  /* upload staff profile picture */
					
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

			$('body').on('click','.viewBroadcast',function(event){  /* view broadcast */
				
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
			 
			$('body').on('click','.show-hide-btn',function(event){  /* show/hide button */
			
						event.stopImmediatePropagation();		
						
						$('#showHideCols').trigger('click');
						$('.show-hide-btn').toggle();
						
						return false;
			
			}); 
		
			$('body').on('change','#schoolType',function(){  /* load school type */
			
					$('#result_2, #lib-detail-div').hide();	
					$('#wait_1').show();
					$('#result_1').hide();
					$.get("wizGradeDropper.php", {
						func: "drop_1",
						schoolID: $('#schoolType').val()
					}, function(response){
						
						$('#result_1').fadeOut();
						setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
					 
					});
			   
				return false;
			}); 
		
			function finishAjax(id, response) {  /* load div */
				
				$('#wait_1, #wait_11, #wait_111, #fi_lga').hide();
				$('#'+id).html(unescape(response));
				$('#'+id).fadeIn();
				
			}

			function finishAjax_tier_three(id, response) {  /* load div */
				$('#wait_2, #wait_3').hide();
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

		</script>
            
		<?php
		
		}else{
			exit;
		
		}
		?>
