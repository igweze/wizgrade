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
	This script load common wall companion script
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	
	?>
	
		$('body').on('click','#deleteMsg',function(event){							   

			alert('Oooooops, this function was disenable. Thanks');
			
		});
		
		$('body').on('click', '.ComingS', function(event){																
																
				alert('This function is coming soon in new upgrades. Only the picture upload is available now. Thanks you');
				
				return false;
	
		}); 
		
		/* nl2br function */
		
		function nl2br (str, is_xhtml) {   
			 var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
			 return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
		}
		
		$('body').on('click','#moreMailBoxInfo',function(){ /* load more mail from bar notification  */
			
				$('ul.sidebar-menu li a').removeClass('active');
				
				$('#myInbox').addClass('active');
				
				var postVal = 'myInbox';
				
				showPageLoader();
				
				$('#sdosmsPageContent').load('sdosmsPager.php', {'iemj': postVal}); $('#sdosmsPageContent').slideDown(100);
			 

		});

		$('body').on('click','.readMailTopNav',function(){ /*  read mail from bar notification */
														
				var clickedID = this.id.split('-');
				var msgID = clickedID[1];
				var memberID = clickedID[2];
				var senderID = clickedID[3];
				var postVal = 'myInbox';
				var viewMailTop = msgID+'-'+memberID+'-'+senderID;
				
				$('ul.sidebar-menu li a').removeClass('active');
				
				$('#myInbox').addClass('active');
				
				showPageLoader();	
				
				$('#sdosmsPageContent').load('sdosmsPager.php',  {'iemj': postVal, 'viewMailTop': viewMailTop}); 
				$('#sdosmsPageContent').slideDown(100);
				
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow'); 

		});
		
		$('body').on('click','.readMailTopNavS',function(){ /* read mail from bar notification  */
														
				var clickedID = this.id.split('-');
				var msgID = clickedID[1];
				var memberID = clickedID[2];
				var senderID = clickedID[3];
				var postVal = 'myInbox';
				var viewMailTop = msgID+'-'+memberID+'-'+senderID;
				
				$('ul.sidebar-menu li a').removeClass('active');
				
				$('#myInbox').addClass('active');
				
				showPageLoader();	
				
				$('#sdosmsPageContent').load('sdosmsPagers.php',  {'iemj': postVal, 'viewMailTop': viewMailTop}); 
				$('#sdosmsPageContent').slideDown(100);
				
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow'); 

		});
		
		$('body').on('click','.showCWallNotification',function(){ /* show companion wall notification */
														
				var clickedID = this.id.split('-');
				
				var notificPostID = clickedID[1];
				var postVal = 'wallCompanion';
				$('ul.sidebar-menu li a').removeClass('active');
				$('#wallCompanion').addClass('active');
				
				showPageLoader();	
				
				$('#sdosmsPageContent').load('sdosmsPager.php', {'iemj': postVal, 
										'notificPostID': notificPostID}); $('#sdosmsPageContent').slideDown(100); 
				
				hidePageLoader();  /* hide page loader */

		}); 
		
		$('body').on('click','.showCWallNotificationS',function(){ /* show companion wall notification */
														
				var clickedID = this.id.split('-');
				
				var notificPostID = clickedID[1];
				var postVal = 'wallCompanion';
				$('ul.sidebar-menu li a').removeClass('active');
				$('#wallCompanion').addClass('active');
				
				showPageLoader();	
				
				$('#sdosmsPageContent').load('sdosmsPagers.php', {'iemj': postVal, 
										'notificPostID': notificPostID}); $('#sdosmsPageContent').slideDown(100); 
				
				hidePageLoader();  /* hide page loader */

		});  
	 

		$('body').on('click','#sendNjidekaMail, #sendNkirukaMail',function(){ /* send mail  */
									
			$('#frmsendNjidekaMail, #frmsendNkirukaMail').submit(function(event) {

				event.stopImmediatePropagation();
				
				$('.sendMsgLoader').fadeIn(100);
				
				$.post('comp-mailbox-manager.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$('#msgBoxInfo').html(data);				
					$('.sendMsgLoader').fadeOut(1000);

				});

				return false;

			});	
			
		}); 

		$('body').on('click','#replyMail',function(){ /* reply an email */
																
			$('#frmreplyMail').submit(function(event) {

				event.stopImmediatePropagation();
				
				$('#replyMsgLoader').fadeIn(100);
				
				$.post('comp-mailbox-manager.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$('#replyMsgDiv').html(data);				
					$('#replyMsgLoader').fadeOut(1000);
				
				});

			return false;

			});	
			
		}); 

		$('body').on('click','#saveDraftMsg',function(event){ /* save draft email */

				event.stopImmediatePropagation();					
				
				var msgTitle = $('#msgTitle').val();
				var mailMsg = $('#Message').val();
				var memberID = $('#frmmemberID').text();
				var Message = 'saveDraftMail';
	
				$('.sendMsgLoader').fadeIn(100);
				
				$('#msgBoxInfo').load('comp-mailbox-manager.php', {'messageData': Message, 'memberID': memberID, 
									  'msgTitle': msgTitle, 'mailMsg': mailMsg }).fadeIn(600);					

				$('.sendMsgLoader').fadeOut(1000);
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
	
				return false;  

		});	 
			
		$('body').on('click','#composeMsg',function(event){ /* compose an email */

				event.stopImmediatePropagation();									  
				var Title = $('#mailTopTitle').text();
				$('#mailTitleHolder').html(Title);
				$('#inboxmsgBoxDiv').fadeOut(500);
				$('#composeMsg').fadeOut(500);
				$('#composeMsgBoxDiv').fadeIn(500);
				$('#mailTopTitle').html('Compose Message');	
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
													  
				return false;
	
		}); 

		$('body').on('click','#cancelComposeMsg',function(event){ /* cancel compose email */

				event.stopImmediatePropagation();		
				var Title = $('#mailTitleHolder').text();
				$('#composeMsgBoxDiv').fadeOut(500);
				$('#composeMsg').fadeIn(500);
				$('#inboxmsgBoxDiv').fadeIn(500);		
				$('#mailTopTitle').html(Title);
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow'); 
												  
				return false;

		});

		$('body').on('click','.showInbox',function(event){ /* show email message inbox */

				event.stopImmediatePropagation();					
				
				var clickedID = this.id.split('-');
				var memberID = clickedID[1];
				var Message = 'showInboxMsg';
	
				showPageLoader();   
				$('ul.inbox-nav li').removeClass('active');
				$(this).addClass('active'); 
				$('#composeMsg').fadeIn(500);
				$('#composeMsgBoxDiv').fadeOut(500);
				
				$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 
											 'memberID': memberID }).fadeIn(600);
				
				$('#mailTopTitle').html('Companion Inbox');
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');

				hidePageLoader();  /* hide page loader */
	
				return false;  

		});			

		$('body').on('click','.showSentMail',function(event){ /* show sent email */

				event.stopImmediatePropagation();					
				
				var clickedID = this.id.split('-');
				var memberID = clickedID[1];
				var Message = 'showSentMsg';
	
				showPageLoader();   
				$('ul.inbox-nav li').removeClass('active');
				$(this).addClass('active'); 
				$('#composeMsg').fadeIn(500);
				$('#composeMsgBoxDiv').fadeOut(500);
				
				$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 
											 'memberID': memberID }).fadeIn(600);
				
				$('#mailTopTitle').html(' Sent Message');
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');

				hidePageLoader();  /* hide page loader */
	
				return false;  

		});			

		$('body').on('click','.showAdminMail',function(event){ /* show school admin email */

				event.stopImmediatePropagation();					
				
				var clickedID = this.id.split('-');
				var memberID = clickedID[1];
				var Message = 'showAdminMail';
	
				showPageLoader();   
				$('ul.inbox-nav li').removeClass('active');
				$(this).addClass('active'); 
				$('#composeMsg').fadeIn(500);
				$('#composeMsgBoxDiv').fadeOut(500);
				
				$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 
											 'memberID': memberID }).fadeIn(600);
				
				$('#mailTopTitle').html(' Admin Inbox');
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');

				hidePageLoader();  /* hide page loader */
	
				return false;  


		});			

		$('body').on('click','.showDraftMail',function(event){ /* show draft email */

				event.stopImmediatePropagation();					
				
				var clickedID = this.id.split('-');
				var memberID = clickedID[1];
				var Message = 'showDraftMail';
	
				showPageLoader();   
				$('ul.inbox-nav li').removeClass('active');
				$(this).addClass('active'); 
				$('#composeMsg').fadeIn(500);
				$('#composeMsgBoxDiv').fadeOut(500);
				
				
				$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 
											 'memberID': memberID }).fadeIn(600);
				
				$('#mailTopTitle').html(' Draft Message');
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');

				hidePageLoader();  /* hide page loader */
	
				return false;  

		});	 

		$('body').on('click','.showTrashMail',function(event){ /* show trash email */

				event.stopImmediatePropagation();					
				
				var clickedID = this.id.split('-');
				var memberID = clickedID[1];
				var Message = 'showTrashMail';
	
				showPageLoader();   
				$('ul.inbox-nav li').removeClass('active');
				$(this).addClass('active'); 
				$('#composeMsg').fadeIn(500);
				$('#composeMsgBoxDiv').fadeOut(500);
				
				$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 
											 'memberID': memberID }).fadeIn(600);
				
				$('#mailTopTitle').html(' Trash Message');
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');

				hidePageLoader();  /* hide page loader */
	
				return false;  

		});			

		$('body').on('click','.readMail',function(event){ /* read an email */

				event.stopImmediatePropagation();					
				
				var clickedID = this.id.split('-');
				var msgID = clickedID[1];
				var memberID = clickedID[2];
				var senderID = clickedID[3];
				var Message = 'viewNkirukaMail';
	
				showPageLoader(); 
				
				$('#composeMsg').fadeIn(500);					
				$('#composeMsgBoxDiv').fadeOut(500);
				
				$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 'msgID': msgID, 
											 'memberID': memberID, 'senderID': senderID }).fadeIn(600);
				
				$('#mailTopTitle').html('View  Inbox');	
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
				

				hidePageLoader();  /* hide page loader */
	
				return false;  

		});			


		$('body').on('click','.readNkirukaSentMail',function(event){ /* read sent email */

				event.stopImmediatePropagation();					
				
				var clickedID = this.id.split('-');
				var msgID = clickedID[1];
				var memberID = clickedID[2];
				var Message = 'viewNkirukaSentMail';
	
				showPageLoader(); 
				
				$('#composeMsg').fadeIn(500);					
				$('#composeMsgBoxDiv').fadeOut(500);
				
				$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 'msgID': msgID, 
											 'memberID': memberID}).fadeIn(600);
				
				$('#mailTopTitle').html('View  Sent Message');
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');

				hidePageLoader();  /* hide page loader */
	
				return false;  

		});			


		$('body').on('click','.nextMailBtn',function(event){ /* navigate to next email */

				event.stopImmediatePropagation();					
				
				var offsetVal = $('#nextPageDiv').text();
				var inboxType = $('#inboxType').text();
				var memberID =  $('#memberID').text();
				var totalCount =  $('#totalCount').text();
				var Message =   'paginateMail';
				$('.prevMailBtn').fadeIn(500);
	
				showPageLoader();   
				$('#selectAll').each(function() { 
							this.checked = false; 
							});
				$('#paginateMailDiv').load('comp-mailbox-manager.php', {'messageData': Message, 'inboxType': inboxType,
										   'memberID': memberID, 'offsetVal': offsetVal, 'totalCount': totalCount }).fadeIn(600);
				
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
				hidePageLoader();  /* hide page loader */
	
				return false;  

		});			

		$('body').on('click','.nextMailSentBtn',function(event){ /* navigate to next email */

				event.stopImmediatePropagation();					
				
				var offsetVal = $('#nextPageDiv').text();
				var memberID =  $('#memberID').text();
				var totalCount =  $('#totalCount').text();
				var Message =   'paginateSentMail';
				$('.prevMailSentBtn').fadeIn(500);
	
				showPageLoader();   
				$('#paginateMailDiv').load('comp-mailbox-manager.php', {'messageData': Message, 'memberID': memberID,
											 'offsetVal': offsetVal, 'totalCount': totalCount }).fadeIn(600);
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
				hidePageLoader();  /* hide page loader */
	
				return false;  

		});			

		$('body').on('click','.prevMailBtn',function(event){ /* navigate to previous email */

				event.stopImmediatePropagation();					
				
				var offsetVal = $('#prevPageDiv').text();
				var inboxType = $('#inboxType').text();
				var memberID =  $('#memberID').text();
				var totalCount =  $('#totalCount').text();
				var Message =   'paginateMail';
	
				showPageLoader();   
				$('#selectAll').each(function() { 
							this.checked = false; 
							});
				$('#paginateMailDiv').load('comp-mailbox-manager.php', {'messageData': Message, 'inboxType': inboxType,
										   'memberID': memberID, 'offsetVal': offsetVal, 'totalCount': totalCount }).fadeIn(600);
				
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
				hidePageLoader();  /* hide page loader */
	
				return false;  

		});			

		$('body').on('click','.prevMailSentBtn',function(event){ /* navigate to previous email */

				event.stopImmediatePropagation();					
				
				var offsetVal = $('#prevPageDiv').text();
				var memberID =  $('#memberID').text();
				var totalCount =  $('#totalCount').text();
				var Message =   'paginateSentMail';
	
				showPageLoader();   
				
				$('#paginateMailDiv').load('comp-mailbox-manager.php', {'messageData': Message, 'memberID': memberID,
											 'offsetVal': offsetVal, 'totalCount': totalCount }).fadeIn(600);					
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');
				hidePageLoader();  /* hide page loader */
	
				return false;  

		});			

		$('body').on('click','.trashMailViewMsg',function(event){ /* view trash email */

				event.stopImmediatePropagation();					
				
				var clickedID = this.id.split('-');
				var msgID = clickedID[1];
				var memberID = clickedID[2];
				var Message = 'trashMailView';
	
				showPageLoader(); 
				
				$('#composeMsg').fadeIn(500);					
				$('#composeMsgBoxDiv').fadeOut(500);
				
				$('#njidekaNkirukaDiv').load('comp-mailbox-manager.php', {'messageData': Message, 'msgID': msgID, 
											 'memberID': memberID}).fadeIn(600);
				
				$('#mailTopTitle').html('Companion Inbox');
				$('html, body').animate({ scrollTop:  $('.scrollMailTarget').offset().top - 50 }, 'slow');

				hidePageLoader();  /* hide page loader */
	
				return false;  

		});	 

		$('body').on('click','#markUnread',function(event){	/* mark an email as unread */		 				   

				var mailData = $('.mailCheckBox').serialize();
				$.post('comp-mark-mail-unread.php', mailData, function(data) {
					$('#mailMsgBox').html(data);
				});

		}); 

		$('body').on('click','#markRead',function(event){	/* mark an email as read */						   

			var mailData = $('.mailCheckBox').serialize();
			$.post('comp-mark-mail-read.php', mailData, function(data) {
				$('#mailMsgBox').html(data);
			});

		}); 

		$('body').on('click','#moveMsgInbox',function(event){	/* move message to inbox */						   

			var mailData = $('.mailCheckBox').serialize();
			$.post('comp-move-msg.php', mailData, function(data) {
				$('#mailMsgBox').html(data);
			});

		});
	 
		$('body').on('click','#moveMsgToTrash',function(event){	 /* move message to trash */							   

			var mailData = $('.mailCheckBox').serialize();
			$.post('comp-move-msg-trash.php', mailData, function(data) {
			$('#mailMsgBox').html(data);
			});

		}); 
	 
		$('body').on('click','#selectAll',function(event){	/* select all email message */		
		
			   if(this.checked) { 
					$('.mailCheckBox').each(function() { 
					this.checked = true;  
					});
				}else{
					$('.mailCheckBox').each(function() { 
					this.checked = false; 
					});         
				}
		}); 

		$('body').on('click','#selectReadMsg',function(event){	/* select all read message */							   
					
					$('#selectAll').each(function() { 
					this.checked = false; 
					});								
					$('.mailCheckBox').each(function() { 
					this.checked = false; 
					});  
					$('.checkRead').each(function() { 
					this.checked = true;  
					});

		}); 

		$('body').on('click','#selectUnReadMsg',function(event){	 /* select all unread message */							   
			   
					$('#selectAll').each(function() { 
					this.checked = false; 
					});
					$('.mailCheckBox').each(function() { 
					this.checked = false; 
					});  
					$('.checkUnread').each(function() { 
					this.checked = true;  
					});

		});

		$('body').on('click','#selectAdminMsg',function(event){	/* select all admin  message */							   
			   
					$('#selectAll').each(function() { 
					this.checked = false; 
					});
					$('.mailCheckBox').each(function() { 
					this.checked = false; 
					});  
					$('.checkAdminMsg').each(function() { 
					this.checked = true;  
					});

		}); 

		
		/* Walll Companion function */
		 

		$('body').on('click','.softPaginate',function(event){ /* companion wall pagination */	

				event.stopImmediatePropagation();
				
				var clickedID = this.id.split('-');
				var pageID = clickedID[1];
				var loadType = clickedID[2];
				var cWallPaginate = 'paginateCompanionWall';
				
				showPageLoader();
				
				$('#wallPaginateDiv').load('comp-load-companion-posts.php', {'cWallPaginate': cWallPaginate, 
										   'pageID': pageID, 
										   'loadType': loadType });
				$(".softPaginate").removeClass('current');
				$('#softPaginate-'+pageID+'-'+loadType).addClass('current');

				$('html, body').animate({ scrollTop:  $('#fmsgBox').offset().top - 50 }, 'slow');
				
				hidePageLoader();  /* hide page loader */

				return false;  

		});

		$('body').on('click','.softPaginatePCW',function(event){ /* companion wall pagination */	

				event.stopImmediatePropagation();
				
				var clickedID = this.id.split('-');
				var pageID = clickedID[1];
				var memberID = clickedID[2];
				var cWallPaginate = 'paginateMemberCWall';
				
				showPageLoader();
				
				$('#paginatePCWDiv').load('comp-load-companion-posts.php', {'cWallPaginate': cWallPaginate, 
											  'pageID': pageID, 
											  'memberID': memberID });
				$(".softPaginatePCW").removeClass('current');
				$('#softPaginatePCW-'+pageID+'-'+memberID).addClass('current');
				$('html, body').animate({ scrollTop:  $('#fmsgBox').offset().top - 50 }, 'slow');
				
				hidePageLoader();  /* hide page loader */

				return false;  

		});

		$('body').on('click','#postStatus',function(){ /* post companion message */
				
			$('#frmPost').submit(function(event) {

				$('#postStatus').prop('disabled', 'disabled');
			
				event.stopImmediatePropagation();

				$('#postStatusSE').fadeOut(200);
				$('#postLoader').fadeIn(1000);
				
				$.post("comp-wall-script-validator.php", $(this).find('input, textarea').serialize(), function(data) {
					
					$("#newPostDiv").prepend(data);
					$("#fPostField").val('');
					$('#postStatusSE').fadeIn(200);			
					$('#postLoader').fadeOut(1000);
				
	
				});

				return false;

			});
		
			setTimeout(function() {
				$('#postStatus').prop('disabled', '');
			},4000); 
			
				
		});
		
		$('body').on('click', '#postStatusSE', function(event){ /* trigger post companion button */

				event.stopImmediatePropagation();

				$('#postStatus').trigger('click');
														
				return false;
					
		});	 

		$('body').on('click','.companionWallPosts',function(event){ /* load/display companion message */

				event.stopImmediatePropagation();

				var postVal = 'companionWallPosts';
	
				showPageLoader();
				
				$('#chisomLoadDiv').load('comp-wall-script-manager.php', {'postsType': postVal }).fadeIn(1000);

				hidePageLoader();  /* hide page loader */
	
				return false;  

		}); 			

		$('body').on('change','#filterCWallPosts',function(event){ /* filter post companion message */

				event.stopImmediatePropagation();		

				var filterVal = $('#filterCWallPosts').val();
				var postVal = 'filterCWallPosts';
	
				showPageLoader();
				
				$('#chisomLoadDiv').load('comp-wall-script-manager.php', {'postsType': postVal, 
										 'filterVal': filterVal}).fadeIn(1000);

				hidePageLoader();  /* hide page loader */
	
				return false;  

		}); 
		
		$('body').on('change','#filterCWallSetting',function(event){ /*  companion post filter setting */

				event.stopImmediatePropagation();		

				var filterVal = $('#filterCWallSetting').val();
				var postVal = 'filterCWallSetting';
	
				showPageLoader();
				
				$('#filterSettingsMsg').load('comp-wall-script-manager.php', {'postsType': postVal, 
											 'filterVal': filterVal}).fadeIn(1000);

				hidePageLoader();  /* hide page loader */
	
				return false;  

		}); 

		$('body').on('keyup','#cMailUser',function(event){ /* validate email registration */

				event.stopImmediatePropagation();		

				$('#cMailUser').addClass('spinner');
				var filterVal = $('#cMailUser').val();
				var postVal = 'validateEmail';
				
				$('#registMailMsg').load('comp-wall-script-manager.php', {'postsType': postVal, 
										 'filterVal': filterVal}).fadeIn(1000);

				
	
				return false;  

		});

		$('body').on('click','#registerCMail',function(event){ /* register student email */

				event.stopImmediatePropagation();		

				$('#cMailUser').addClass('spinner');
				var filterVal = $('#cMailUser').val();
				var postVal = 'registerMail';
				
				$('#registMailMsg').load('comp-wall-script-manager.php', {'postsType': postVal, 
										 'filterVal': filterVal}).fadeIn(1000);
				
				return false;  

		}); 

		$('body').on('click','.showcompanionWallUser',function(event){ /* show personalized student post/wall */
	
				event.stopImmediatePropagation();	
				
				var clickedID = this.id.split('-');
				var memberID = clickedID[1];

				var postVal = 'companionWallUser';
	
				showPageLoader();
				$('#chisomLoadDiv').slideUp(300);
				$('#chisomLoadDiv').load('comp-wall-script-manager.php', {'postsType': postVal, 
										 'memberID': memberID }).slideDown(1000);
										 
				$('html, body').animate({ scrollTop:  $('#chisomLoadDiv').offset().top - 50 }, 'slow');						 

				hidePageLoader();  /* hide page loader */
	
				return false;  

		}); 

		$('body').on('click','.post-edit-btn',function(event){ /* load edit companion post */

				event.stopImmediatePropagation();					
				
				var clickedPID = this.id.split('-');
				var PostID = clickedPID[1];
	
				showPageLoader();   
				
				$('#editPost_'+PostID).load('comp-wall-script-manager.php', {'showEditPost': PostID  }).fadeIn(1000);

				hidePageLoader();  /* hide page loader */
	
				return false;  

		});

		$('body').on('click','.postEditStatus',function(){ /* edit companion post */
		
			var clickedPID = this.id.split('-');
			var PostID = clickedPID[1];

			$('#frmpostEdit-'+PostID).submit(function(event) {

				event.stopImmediatePropagation();
				$('#cancelpostEdit-'+PostID).fadeOut(100);
				$('#postEdit-'+PostID).fadeOut(100);
				$('#postEditLoader-'+PostID).fadeIn(300);
				$.post('comp-wall-script-validator.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$('#editPost_'+PostID).html(data);
					$('#postEditLoader-'+PostID).fadeOut(1000); 
				
				}); 

				return false;

			});		
		});


		$('body').on('click','.cancelpostEdit',function(event){ /* cancel companion post edit */
		
				event.stopImmediatePropagation();
				
				var clickedPID = this.id.split('-');
				var PostID = clickedPID[1];
				var PostMsg = $('#editPostHolder-'+PostID).text();
				var formatMsg =  nl2br(PostMsg);
				$('#cancelpostEdit-'+PostID).fadeOut(100);
				$('#postEdit-'+PostID).fadeOut(100);
				$('#postEditLoader-'+PostID).fadeIn(300);
										
				$('#editPost_'+PostID).html(formatMsg);
				$('#postEditLoader-'+PostID).fadeOut(1000);
				

				return false;


		});

		$('body').on('click','.post-delete-btn',function(event){ /* delete companion post */

				event.stopImmediatePropagation();					
				
				var clickedFID = this.id.split('-');
				var DbNumberFID = clickedFID[1];
	
				showPageLoader();   
				
				$('#fmsgBox').load('comp-wall-script-manager.php', {'deletePost': DbNumberFID  }).fadeIn(1000);

				hidePageLoader();  /* hide page loader */

				$('#post_'+DbNumberFID).fadeOut(300);
	
				return false;  

		});

		$('body').on('click', '#exitUploadDiv', function(event){ /* exit companion picture upload */

				event.stopImmediatePropagation();
				var deleteID = 'deleteTempUpload';
				var valEmpty = '';

				$('.uploadPicIcon').show(300);				
				$('#uploadPicSE').hide(300);
				$('#postStatusSE').show(300);
				$('#wallMsgDiv').show(300);
				$('#wallPictureDiv').hide(300);			
				$('.refresh').load('comp-wall-script-manager.php', {'deleteTempPics': deleteID }).fadeIn(1000);
				$('#previewPic').html(valEmpty); 
	 
				return false;
					
		});	
  
		$('body').on('click','#wallPics',function(){ /* show wall picture */

			$('#postStatusSE').hide(300);
			$('#wallMsgDiv').hide(300);
			$('#wallPictureDiv').show(300);
  
		});
 
		$('body').on('change','#wallPics',function(event){ /* change wall picture */
		
			event.stopImmediatePropagation();
			
			$("#frmWallUploader").ajaxForm({target: '#previewPic', 
					
					beforeSubmit:function(){ 
				
					console.log('v');
						$("#imgUploadLoader").show();
						$(".uploadPicIcon").hide();
						$("#uploadPicSE").hide(); 
						}, 
					success:function(){ 
						console.log('z');
						$("#imgUploadLoader").hide();
						$(".uploadPicIcon").show();
						$("#uploadPicSE").show();
						$('.refresh').load('comp-uploads-refresh.php');
						}, 
					error:function(){ 
						console.log('d');
						$("#imgUploadLoader").hide();
						$(".uploadPicIcon").show();
						$("#uploadPicSE").show();
						} }).submit();
						
											
					return false
	  
		});

		$('body').on('click', '#uploadPicSE', function(event){ /* trigger upload post picture button  */

				event.stopImmediatePropagation();

				$('#uploadPic').trigger('click');
																
				return false;
						
		});	 

		$('body').on('click','#uploadPic',function(){ /* upload post picture  */
		
				var valEmpty = '';

			   $('#frmuploadPic').submit(function(event) {
			
					event.stopImmediatePropagation();
	
					$('#postLoader').fadeIn(200);		
					$('#uploadPicSE').fadeOut(200);		
					
					$.post('comp-wall-script-validator.php', $(this).find('input, textarea').serialize(), function(data) {
						
						$("#newPostDiv").prepend(data);								
						$('#uploadPicSE').hide(300);		
						$('.uploadPicIcon').show(300);
						$('#postStatusSE').show(300);
						$('#uploadPic').hide(300);
						$('#wallMsgDiv').show(300);
						$('#wallPictureDiv').hide(300);			
						$('#previewPic').html(valEmpty);
						$('#uploadPicTitle').val(valEmpty); 
						$('#postLoader').fadeOut(1000); 
		
					});
					

				return false;

				});	
			
		}); 

		$('body').on('click','.uploadPic_DelBtn',function(event){ /* delete upload picture  */

				event.stopImmediatePropagation();					
				
				var clickedID = this.id.split('-');
				var pictureID = clickedID[1];
				
				$('.uploadPicIcon').hide();
				$('#imgUploadLoader').fadeIn(100);
				
				$('.refresh').load('comp-wall-script-manager.php', {'deleteuploadPic': pictureID }).fadeIn(1000);

				$('#picture-upload-div_'+pictureID).fadeOut(100);
				
				$('#imgUploadLoader').fadeOut(1000);
				$('.uploadPicIcon').show(); 
	
				return false;  

		}); 

		$('body').on('click','.likePosts',function(event){ /* like post and pictures  */

				event.stopImmediatePropagation();
				var valEmpty = '';
				var clickedlikePosts = this.id.split('-');
				var likePostsID = clickedlikePosts[1];
				var likeDetails = 'postlikeDetails';
				
				$('#likePosts-'+likePostsID).text(valEmpty);
				$('#likeDetails-'+likePostsID).text(valEmpty);
				
				$('#likePosts-'+likePostsID).load('comp-wall-script-manager.php', {'likePostID': likePostsID }).fadeIn(300);
				
				$('#likeDetails-'+likePostsID).load('comp-wall-script-manager.php', {'likeDetails': likeDetails, 
													'likePost': likePostsID }).fadeIn(300);

				return false;  
				

		});
		
		$('body').on('click','.dislikePosts',function(event){ /* dislike post and pictures  */

				event.preventDefault();
				var valEmpty = '';
				var clickeddislikePosts = this.id.split('-');
				var dislikePostsID = clickeddislikePosts[1];
				var likeDetails = 'postlikeDetails';
				
				$('#dislikePosts-'+dislikePostsID).text(valEmpty);
				$('#likeDetails-'+dislikePostsID).text(valEmpty);
				
				$('#dislikePosts-'+dislikePostsID).load('comp-wall-script-manager.php', {
														'dislikePostID': dislikePostsID }).fadeIn(300);
				
				$('#likeDetails-'+dislikePostsID).load('comp-wall-script-manager.php', {'likeDetails': likeDetails, 
													'likePost': dislikePostsID }).fadeIn(300);

				return false;  

		});
		
		
		$('body').on('click','.commentStatus',function(){ /* post comments */
		
			var clickedcommentID = this.id.split('-');
			var commentID = clickedcommentID[1];
			var valEmpty = '';

			$('#frmComment-'+commentID).submit(function(event) {

				event.stopImmediatePropagation();
				$('.commentStatus').fadeOut(200);
				$('#commentLoader-'+commentID).fadeIn(1000);
				$.post('comp-wall-script-validator.php', $(this).find('input, textarea').serialize(), function(data) {
					
					$('#newCommentDiv-'+commentID).append(data);
					$('.commentField-'+commentID).val('');
					$('.commentStatus').fadeIn(200);			
					$('#commentLoader-'+commentID).fadeOut(1000);
				
				});
				
				$('#commentNumStatus-'+commentID).text(valEmpty);
				$('#commentNumStatus-'+commentID).load('comp-wall-script-manager.php', {
													   'numOfCommentDiv':commentID }).fadeIn(1000);

				return false;

			});	
			
		}); 
		
		$('body').on('click','.comment-div',function(event){ /* show/display comment div  */

				event.stopImmediatePropagation();					
				
				var clickedID = this.id.split('-');
				var PostID = clickedID[1];
				
				$('#slideCommentsDiv-'+PostID).fadeIn(300);
				$('#commentDivSub-'+PostID).fadeIn(300);
				$('#commentDivSub-'+PostID).animate({ scrollTop: 0 }, 'slow');
	
				return false;  
	
		});

		$('body').on('click','.slideCommentsDiv',function(event){ /* hide comment div  */
	
				event.stopImmediatePropagation();					
				
				var clickedID = this.id.split('-');
				var PostID = clickedID[1];
				
				$('#slideCommentsDiv-'+PostID).fadeOut(300);
				$('#commentDivSub-'+PostID).fadeOut(300);
	
				return false;  

		});

		$('body').on('click','.comment-edit-btn',function(event){ /* load comment edit button  */

				event.stopImmediatePropagation();					
				
				var clickedCPID = this.id.split('-');
				var CPID = clickedCPID[1];
						
				showPageLoader();   
				
				$('#editcomment_'+CPID).load('comp-wall-script-manager.php', {'showEditComment': CPID }).fadeIn(1000);

				hidePageLoader();  /* hide page loader */
	
				return false;  

		});

		$('body').on('click','.commentEditStatus',function(){ /* edit comment  */
		
				var clickedCPID = this.id.split('-');
				var CPID = clickedCPID[1];
				
				$('#frmcommentEdit-'+CPID).submit(function(event) {
	
					event.stopImmediatePropagation();
					
					$('#cancelcommentEdit-'+CPID).fadeOut(100);
					$('#commentEdit-'+CPID).fadeOut(100);
					$('#commentEditLoader-'+CPID).fadeIn(300);
					
					$.post('comp-wall-script-validator.php', $(this).find('input, textarea').serialize(), function(data) {
						
						$('#editcomment_'+CPID).html(data);
						$('#commentEditLoader-'+CPID).fadeOut(1000);
					
					});
					

					return false;
	
				});		
		});

		$('body').on('click','.cancelcommentEdit',function(event){ /* cancel edit comment  */
		
				event.stopImmediatePropagation();
				
				var clickedCPID = this.id.split('-');
				var CPID = clickedCPID[1];

				var commentMsg = $('#editCommentHolder-'+CPID).text();
				var formatMsg =  nl2br(commentMsg);
			
				$('#cancelcommentEdit-'+CPID).fadeOut(100);
				$('#commentEdit-'+CPID).fadeOut(100);
				$('#commentEditLoader-'+CPID).fadeIn(300);
				$('#editcomment_'+CPID).html(formatMsg);
				$('#commentEditLoader-'+CPID).fadeOut(1000); 

				return false; 

		}); 

		$('body').on('click','.comment-delete-btn',function(event){ /* delete comment  */

				event.stopImmediatePropagation();					
				
				var valEmpty = '';
				
				var clickedCID = this.id.split('-');
				var DbNumberCID = clickedCID[1];
				var DbNumberPID = clickedCID[2];

				$('#fmsgBox').load('comp-wall-script-manager.php', {'deleteComment': DbNumberCID  }).fadeIn(1000);

				$('#comment_'+DbNumberCID).fadeOut(300);
				
				$('#commentNumStatus-'+DbNumberPID).text(valEmpty);
				
				$('#commentNumStatus-'+DbNumberPID).load('comp-wall-script-manager.php', {
														 'numOfCommentDiv':DbNumberPID }).fadeIn(1000);
	
				return false;  

		}); 
		
		$('body').on('click','.likeComments',function(event){ /* like comment  */

				event.stopImmediatePropagation();					
				
				var clickedlikeComments = this.id.split('-');
				var likeCommentsID = clickedlikeComments[1]; 
				
				$('#likeComments-'+likeCommentsID).load('comp-wall-script-manager.php', {
														'likecommentID': likeCommentsID }).fadeIn(300);
	
				return false;  

		});
		
		$('body').on('click','.disLikeComments',function(event){ /* dislike comment  */

				event.stopImmediatePropagation();					
				
				var clickeddisLikeComments = this.id.split('-');
				var disLikeCommentsID = clickeddisLikeComments[1]; 
				
				$('#disLikeComments-'+disLikeCommentsID).load('comp-wall-script-manager.php', 
															  {'dislikecommentID': disLikeCommentsID }).fadeIn(300);
	
				return false;  

		});



		$('body').on('click','.sendMailPosts',function(event){ /* send mail through posts */

				event.stopImmediatePropagation();	
				
				var clickedPID = this.id.split('-');
				var PostID = clickedPID[1];
				var memberID = clickedPID[2];						
				
				$('#mailReportPostsDiv_'+PostID).load('comp-mailbox-manager.php', {'sendMailPosts': PostID, 
													  'Member': memberID  }).fadeIn(1000);
	
				return false;  

		}); 

		$('body').on('click','.sendMailComments',function(event){ /* send mail through comments */

				event.stopImmediatePropagation();	
				
				var clickedPID = this.id.split('-');
				var PostID = clickedPID[1];
				var commentID = clickedPID[2];
				var memberID = clickedPID[3];
				
				$('#mailReportCommentsDiv_'+PostID+'_'+commentID+'_'+memberID).load('comp-mailbox-manager.php', {
												'sendMailComments': PostID, 'Comment': commentID , 'Member': memberID  }).fadeIn(1000);
	
				return false;  

		});

		$('body').on('click','.sendReportPosts',function(event){ /* send reports through posts */

				event.stopImmediatePropagation();	
				
				var clickedPID = this.id.split('-');
				var PostID = clickedPID[1];
				var memberID = clickedPID[2];
				
				$('#mailReportPostsDiv_'+PostID).load('comp-mailbox-manager.php', {'sendReportPosts': PostID, 
													  'Member': memberID  }).fadeIn(1000);
	
				return false;  

		});

		$('body').on('click','.sendReportComments',function(event){ /* send reports through comments */

				event.stopImmediatePropagation();	
				
				var clickedPID = this.id.split('-');
				var PostID = clickedPID[1];
				var commentID = clickedPID[2];
				var memberID = clickedPID[3];
				
				$('#mailReportCommentsDiv_'+PostID+'_'+commentID+'_'+memberID).load('comp-mailbox-manager.php', {
												'sendReportComments': PostID, 'Comment': commentID, 'Member': memberID  }).fadeIn(1000);
	
	
				return false;  

		});

		$('body').on('click','.exitPostMailBoxDiv',function(event){ /* exit/cancel send mail through posts */

				event.stopImmediatePropagation();	
				
				var clickedPID = this.id.split('-');
				var PostID = clickedPID[1];
				
				$('.postMailBoxDiv_'+PostID).fadeOut(300);
				
				return false;  

		});

		$('body').on('click','.exitCommentMailBoxDiv',function(event){ /* exit/cancel send mail through comments */

				event.stopImmediatePropagation();	
				
				var clickedPID = this.id.split('-');
				var PostID = clickedPID[1];
				var commentID = clickedPID[2];
				var memberID = clickedPID[3];
				
				$('.commentMailBoxDiv_'+PostID+'_'+commentID+'_'+memberID).fadeOut(300);
				
				return false;  

		}); 

		$('body').on('click','.exitPostReportBoxDiv',function(event){ /* exit/cancel send reports through posts */

				event.stopImmediatePropagation();	
				
				var clickedPID = this.id.split('-');
				var PostID = clickedPID[1];
				
				$('.postReportBoxDiv_'+PostID).fadeOut(300);
				
				return false;  

		}); 

		$('body').on('click','.exitCommentReportBoxDiv',function(event){ /* exit/cancel send reports through comments */

				event.stopImmediatePropagation();	
				
				var clickedPID = this.id.split('-');
				var PostID = clickedPID[1];
				var commentID = clickedPID[2];
				var memberID = clickedPID[3];
				
				$('.commentReportBoxDiv_'+PostID+'_'+commentID+'_'+memberID).fadeOut(300);
				
				return false;  

		}); 

		$('body').on('click','.sendMailComp', function(){ /* send companion mail */
													  
				var clickedID = this.id.split('-');
				var mailID = clickedID[1];
				var valEmpty = '';
	
				$('#frmmailBoxPosts-'+mailID).submit(function(event) {
	
					event.stopImmediatePropagation();
					
					$('#mailBoxPosts-'+mailID).fadeOut(200);
					$('#wallpostLoader-'+mailID).fadeIn(1000);
					
					$.post('comp-mailbox-manager.php', $(this).find('input, textarea').serialize(), function(data) {
						
						$('#mailReportPostsMsg_'+mailID).html(data);				
						$('#wallpostLoader-'+mailID).fadeOut(1000);
						$('#mailBoxPosts-'+mailID).fadeIn(500);
					
					});

					return false;
	
				});	
		
		}); 

		$('body').on('click','.sendMailPComp',function(){ /* send companion mail through post */
													  
				var clickedID = this.id.split('-');
				var mailID = clickedID[1];
	
				$('#frmmailBoxPosts-'+mailID).submit(function(event) {
	
					event.stopImmediatePropagation();
					
					$('#mailBoxComments-'+mailID).fadeOut(200);
					$('#wallpostLoader-'+mailID).fadeIn(1000);
					
					$.post('comp-mailbox-manager.php', $(this).find('input, textarea').serialize(), function(data) {
						
						$('#mailReportPostsMsg_'+mailID).html(data);				
						$('#wallpostLoader-'+mailID).fadeOut(1000);
						$('#mailBoxComments-'+mailID).fadeIn(500);

					
					});

					return false;
	
				});	
		
		}); 

		$('body').on('click','.sendMailCComp',function(){ /* send companion mail through comment */
													  
				var clickedID = this.id.split('-');

				var PostID = clickedID[1];
				var commentID = clickedID[2];
				var memberID = clickedID[3];
				
				var mailData = PostID+'-'+commentID+'-'+memberID;
				var mailDataSe = PostID+'_'+commentID+'_'+memberID;

				$('#frmmailBoxComments-'+mailData).submit(function(event) {
	
					event.stopImmediatePropagation();
					
					$('#mailBoxPosts-'+mailData).fadeOut(200);
					$('#wallCommentLoader-'+mailData).fadeIn(1000);
					
					$.post('comp-mailbox-manager.php', $(this).find('input, textarea').serialize(), function(data) {
						
						$('#mailReportCommentsMsg_'+mailDataSe).html(data);		
						$('#wallCommentLoader-'+mailData).fadeOut(1000);
						$('#mailBoxComments-'+mailData).fadeIn(500); 
					
					});

					return false;
	
				});	
		
		}); 

		$('body').on('click','.makeProfilePic',function(event){ /* make a picture profile picture  */

				event.stopImmediatePropagation();	
			
				var pictureID = this.id;					
				var picture = 'profilePic';
			
				$('#fmsgBox').load('comp-picture-manager.php', {'pictureID': pictureID, 
												  'pictureData': picture  }).fadeIn(1000);

				return false;  

		}); 

		$('body').on('click','.makeWallPic',function(event){ /* make a picture wall picture  */

				event.stopImmediatePropagation();	
			
				var pictureID = this.id;					
				var picture = 'wallPic';
			
				$('#fmsgBox').load('comp-picture-manager.php', {'pictureID': pictureID, 
												  'pictureData': picture  }).fadeIn(1000);

				return false;  

		}); 			