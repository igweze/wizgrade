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
	This script handle student jQuery/Javascript
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     	define('wizGrade', 'igweze');  /* define a check for wrong access of file */

		require 'configwizGrade.php';  /* load wizGrade configuration files */	   
     
		if (($_POST['pageType']) == 'loadScript') {

?>


			<script type="text/javascript"> 


				$('body').on('click', '.shopCategory',function(event){  /* select shop category */ 
							
					event.stopImmediatePropagation();
					
					var category = this.id.split('-');
					var catID = category[1];
					var vCategory = 'vCategory';				
					
					$('#mallLoader').fadeIn(100);
					
					$('#sMallDiv').load('wizGradeCartProduct.php', {'shopData': vCategory, 'catID': catID
										   }).fadeIn(1000);		
										   
					$('html, body').animate({ scrollTop:  $('#sMallDiv').offset().top - 300 }, 'slow');								   
					
					return false;  
				
				});
				
				$('body').on('click', '.viewProduct',function(event){  /* view product */ 
							
					event.stopImmediatePropagation();
					
					var product = this.id.split('-');
					var pID = product[1];
					var vProduct = 'vProduct';
										
					$('#mallLoader').fadeIn(100);
					
					$('#sMallDiv').load('wizGradeCartProduct.php', {'shopData': vProduct, 'pID': pID
										   }).fadeIn(1000);		
										   
					$('html, body').animate({ scrollTop:  $('#shoppingTarget').offset().top - 30 }, 'slow');								   
					
					return false;  
				
				});
				
				$('body').on('click', '.editProduct',function(event){  /* edit product */
					
					event.stopImmediatePropagation();					
					
					var product = this.id.split('-');
					var valEmpty = '';
					var varID = 'shopping';
					var vProduct = 'vProduct';	
					var eProduct = true;	
					var pID = product[1];
					var qtyV = product[2];									
										
					$('#wizGradePgContent').html(valEmpty);
					
					showPageLoader();   
					
					$('#wizGradePgContent').load('wizGradePager.php', {'iemj': varID, 'shopData': vProduct, 'pID': pID, 
					'eProduct': eProduct, 'qtyV': qtyV }).fadeIn(1000); 
					$('#wizGradePgContent').slideDown(100);
					
					$('html, body').animate({ scrollTop:  $('#scrollBTarget').offset().top - 50 }, 'slow');
					
					return false;  
				
				});
				
				$('body').on('click', '.checkOut',function(event){  /* product check out */
					
					event.stopImmediatePropagation();					
					
					var valEmpty = '';
					var varID = 'shopping';					
					var vProduct = 'cOut';						
					
					$('#wizGradePgContent').html(valEmpty);
					
					showPageLoader();   
					
					$('#wizGradePgContent').load('wizGradePager.php', {'iemj': varID, 'shopData':vProduct }).fadeIn(1000); 
					$('#wizGradePgContent').slideDown(100);
					
					$('html, body').animate({ scrollTop:  $('#scrollBTarget').offset().top - 50 }, 'slow');
					
					return false;  
				
				});
				
				$('body').on('click', '#orderConfirmation',function(event){  /* product order confirmation */
							
					event.stopImmediatePropagation();
					
					
					var vProduct = 'confirmation';
					var confirmType = 'bankDeposit';
					var conStatus = $('#confirm-data').text();					
					$('#mallLoader').fadeIn(100);
					
					$('#sMallDiv').load('wizGradeConfirmationManager.php', {'shopData': vProduct, 'confirm': confirmType, 'conStatus': conStatus }).fadeIn(1000);		
										   
					$('html, body').animate({ scrollTop:  $('#shoppingTarget').offset().top - 30 }, 'slow');								   
					
					return false;  
				
				});
				
				$('body').on('click', '#orderConfirmation--id',function(event){  /* product order confirmation */
					
					event.stopImmediatePropagation();					
					
					var valEmpty = '';
					var varID = 'shopping';					
					var vProduct = 'confirmation';						
					
					$('#wizGradePgContent').html(valEmpty);
					
					showPageLoader();   
					
					$('#wizGradePgContent').load('wizGradeConfrimationPage.php', {'iemj': varID, 'shopData':vProduct }).fadeIn(1000); 
					$('#wizGradePgContent').slideDown(100);
					
					$('html, body').animate({ scrollTop:  $('#scrollBTarget').offset().top - 50 }, 'slow');
					
					return false;  
				
				});		
				
				$('body').on('click', '.enlargePic',function(event){  /* zoom product picture */
							
					event.stopImmediatePropagation();
					
					$(".loadingEnPic").fadeIn(10);
					
					var picture = this.id.split('-');
					var pictureID = picture[1];
					
					var pPicture = '<img src="'+pictureID+'" alt="product picture" height="372" width="370">';
										
					$("#englargeProPic").html(pPicture);
					
					$(".loadingEnPic").fadeOut(4000);
					
					return false;  
				
				}); 
				
				$('body').on('click', '.item-box button, .add-to-cart button',function(event){  /* add product to cart */
						
					event.stopImmediatePropagation();
					
					var button_content = $(this); //this triggered button
					var iqty = $(this).parent().children("select.p-qty").val(); 
					var icode = $(this).parent().children("input.p-code").val(); 
					
					$("#product-btn-"+icode).fadeOut(100);
					$("#loader-"+icode).fadeIn(100);
					
					$("#cart-info").load("wizGradeCart.php", {"quantity": iqty, "product_code": icode });	
					
					$(".cart-box").trigger( "click" ); 
					
				}); 
				
				$( ".cart-box").click(function(e) {  /* display product in cart */
					
					e.preventDefault(); 
					$(".shopping-cart-box").fadeIn(); 
					$("#shopping-cart-results").html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>'); 
					$("#shopping-cart-results" ).load( "wizGradeCart.php", {"load_cart":"1"}); 
					
				}); 
				
				$( ".close-shopping-cart-box").click(function(e){  /* close shopping cart */ 
				
					e.preventDefault(); 
					$(".shopping-cart-box").fadeOut(); 
					
				}); 
				
				$('body').on('click', 'a.remove-item', function(event) {  /* remove a product from cart */
					
					event.stopImmediatePropagation();
					
					var pcode = $(this).attr("data-code"); 
					$(this).parent().fadeOut(); 
					
					$("#cart-info").load("wizGradeCart.php", {"remove_code":pcode});					
					$(".cart-box").trigger( "click" ); 
					
				});
				
				$('body').on('click', 'a.remove-item-rs', function(event) {  /* remove a product from cart */
					
					event.stopImmediatePropagation();
					
					var pcode = $(this).attr("data-code"); 
					$('#cOut-'+pcode).fadeOut();
					
					$("#cart-info").load("wizGradeCart.php", {"remove_code":pcode});					
					$(".cart-box").trigger( "click" ); 
					
				});
				
				$('body').on('change','#selectFee',function(){  /* select fess to pay */	
								
					$('#payLoader').fadeIn(100);
					
					var payData = 'payFees';
					var selectFee = $('#selectFee').val();
					
					if (selectFee == ""){
						
						$('#payMethodDiv').fadeOut(100);						
						$('#payLoader').fadeOut(1000);
					
					}else{	
					
						$('#loadPayG').load('wizGradePayFees.php', {'payData': payData, 'feeCat': selectFee });	
						$('#payMethodDiv').fadeIn(100);					
					}	 				   
										
					return false;  
			
				});
				
				$('body').on('click','#placeOrder',function(event){  /* place product order */
			
					event.stopImmediatePropagation();	
					
					var payMethod =  $('#payMethod').val();
					
					if(payMethod == "bankDeposit"){
						
						$("#orderConfirmation").trigger( "click" ); 									   
											   
					}else if(payMethod == "2Checkout"){
						
						$("#twoCheckout").trigger( "click" ); 									   
											   
					}else if(payMethod == "cashEnvoy"){
						
						$("#cashEnvoyCout").trigger( "click" ); 									   
											   
					}else if(payMethod == "payStack"){
						
						$("#payStackCout").trigger( "click" ); 									   
											   
					}else if(payMethod == "voguePay"){
						
						$("#voguePayCout").trigger( "click" ); 									   
											   
					}else if(payMethod == "paypal"){
						
						$("#paypalCout").trigger( "click" ); 									   
											   
					}else{
						
						new PNotify({
								title: 'Error Message',
								text: 'Oooooops Error, please select your payment method.',
								type: 'error'
							});
						
					}	
					
					
					return false;  
			
				}); 
				
				$('body').on('click', '.startExam',function(event){  /* start exam */
			
					event.stopImmediatePropagation();											
					
					showPageLoader();	
					
					var postVal = 'startExam';
					var examData = this.id.split('-');
					var eID = examData[1];
					
					$('#examQuestDiv').load('wizGradeExam.php', {'onlineExamData': postVal, 'eID': eID
										   }).fadeIn(1000);					
					
					return false;  
			
				}); 
				
				$('body').on('click', '.examQuestion',function(event){  /* answer exam question  */
			
					event.stopImmediatePropagation();											
					
					showPageLoader();	
					
					var postVal = 'examQuestion';
					var examData = this.id.split('-');
					var eID = examData[1];
					
					$('#examQuestDiv').load('wizGradeExam.php', {'onlineExamData': postVal, 'eID': eID
										   }).fadeIn(1000);					
					
					return false;  
			
				}); 
				
				$('body').on('click', '.examPage',function(event){  /* load exam page  */
			
					event.stopImmediatePropagation();											
					
					showPageLoader();	
					
					$('#wizGradeExam').trigger('click');
					
					hidePageLoader();  /* hide page loader */ 
					
					return false;  
			
				});
				
				$('body').on('click', '.startAssign',function(event){  /* start assignment  */
			
					event.stopImmediatePropagation();											
					
					showPageLoader();	
					
					var postVal = 'startAssign';
					var assignData = this.id.split('-');
					var eID = assignData[1];
					
					$('#assignQuestDiv').load('wizGradeAssigment.php', {'onlineAssignData': postVal, 'eID': eID
										   }).fadeIn(1000);					
					
					return false;  
			
				}); 
				
				$('body').on('click', '.assignQuestion',function(event){  /* answer assignment question */
			
					event.stopImmediatePropagation();											
					
					showPageLoader();	
					
					var postVal = 'assignQuestion';
					var assignData = this.id.split('-');
					var eID = assignData[1];
					
					$('#assignQuestDiv').load('wizGradeAssigment.php', {'onlineAssignData': postVal, 'eID': eID
										   }).fadeIn(1000);					
					
					return false;  
			
				}); 
				
				$('body').on('click', '.assignPage',function(event){  /* load assignment page */
			
					event.stopImmediatePropagation();											
					
					showPageLoader();	
					
					$('#wizGradeHomework').trigger('click');
					
					hidePageLoader();  /* hide page loader */ 
					
					return false;  
			
				}); 
				
				$('body').on('click','.apply-lib-book',function(event){  /* apply for library book */
				
					event.stopImmediatePropagation();	
					
					var clickedID = this.id.split('-');
					var libraryData = this.id;
					var bookID = clickedID[1];
					var bookName = clickedID[2];
					var bookAuthor = clickedID[3];
					var bookPic = $('#library-pic-'+bookID).html();
										
					var libraryInfo = 'Library Book Name - '+bookName;
					
					$('#apply-lib-info').text(libraryInfo);
					$('#apply-lib-data').text(bookID);
					$('#show-lib-picture').html(bookPic);
					
					$('#modal-lib-apply-btn').trigger('click');				
					
					return false;  
				
				});

				$('body').on('click','.show-lib-book',function(event){  /* show school library book */
				
					event.stopImmediatePropagation();
				
					showPageLoader(); 
					
					var varID = this.id;
					
					$('#lib-show-div').load('wizGrade-lib-show-manager.php', {'bookID': varID}).fadeIn(1000);
					$('#modal-lib-show-btn').trigger('click');	 
				
					return false;  
				
				});

				$('body').on('click','#apply-library-book',function(event){  /* apply for library book */
				
					event.stopImmediatePropagation();
				
					showPageLoader(); 
					
					var bookID = $('#apply-lib-data').text();
										
					$('#lib-book-msg').load('wizGrade-lib-apply-manager.php', {'bookID': bookID}).fadeIn(1000);	 
				
					return false;  
				
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
	 
				$('body').on('change','#uploadStudentPic',function(){  /* upload student picture */
						
					$(".msgBoxPic").html('');
					
					$('#uploadStatusDiv').fadeOut(200);
					
					showPageLoader();	
					
					$("#formBioPic").ajaxForm({
							target: '.msgBoxPic'
					}).submit();
					
					hidePageLoader();  /* hide page loader */
						
						
				});	 
			 

				$('body').on('click','#rechargeWallet',function(){  /* recharge e-wallet */
				
					$('#frmrechargeWallet').submit(function(event) {		
						
						$('#rechargeLoader').fadeIn(100);	
					
						event.stopImmediatePropagation();
								
						$.post('ewalletRecharge.php', $(this).find('select, input').serialize(), function(data) {
							
							$('#msgBoxR').html(data);	
							$('html, body').animate({ scrollTop:  $('#msgBoxR').offset().top - 30 }, 'slow');
						
						
						});
			  
						return false;
				
					});		
				});

			
				$('body').on('click','#viewRs',function(){  /* view student result */
				
					$('#frmviewRs').submit(function(event) {		
								
							event.stopImmediatePropagation();
							
							showPageLoader();
									
							$.post('wizGradeRSManager.php', $(this).find('select, input').serialize(), function(data) {
							
								$('#wizgrade-page-div').html(data);	
								$('#wizgrade-page-div').slideDown(2000);
								$('.wizgrade-section-div').slideUp(2000);	
								$('.wizgrade-page-icons').fadeIn(200);	
								$('.printer-icon').fadeIn(200);		
							
							});
				  
							return false;
						
					});		
				});

				$('body').on('click','#bestStudents',function(){  /* view best student result */
				
					$('#frmbestStudents').submit(function(event) {		
							
						event.stopImmediatePropagation();
						
						showPageLoader();
								
						$.post('wizGradeRSManager.php', $(this).find('select, input').serialize(), function(data) {
							
							$('#wizgrade-page-div').html(data);	
							$('#wizgrade-page-div').slideDown(2000);
							$('.wizgrade-section-div').slideUp(2000);	
							$('.wizgrade-page-icons').fadeIn(200);	
							$('.printer-icon').fadeIn(200);	
							
						});
			  
						return false;
					
					});	
					
				}); 

				$('body').on('click','#viewEWallet',function(){  /* view student e-wallet */
				
						$('#frmviewEWallet').submit(function(event) {		
								
							event.stopImmediatePropagation();
							
							showPageLoader();
							
							$.post('eWalletHistory.php', $(this).find('select, input').serialize(), function(data) {
								
								$('#wizgrade-page-div').html(data);	
								$('.wizgrade-section-div').slideUp(2000);	
								$('#wizgrade-page-div').slideDown(2000);
								$('.wizgrade-page-icons').fadeIn(200);	
								$('.printer-icon').fadeIn(200);					
							
							});
				  
							return false;
						
						});		
				});

				$('body').on('click','#supportDesk',function(){  /* send support to school admin */
				
						$('#frmSupportDesk').submit(function(event) {		
							
							event.stopImmediatePropagation();
							
							showPageLoader();
							
							$.post('supportDeskManager.php', $(this).find('select, input, textarea').serialize(), function(data) {
								
								$('#msgBox').html(data);	
							
							});
				  
							return false;
					
						});		
				}); 

				$('body').on('click','.editBioData',function(event){  /* edit student profile information */
				
					event.stopImmediatePropagation();
					
					showPageLoader();   
					
					var varID = this.id;
					
					$('#wizGradeRightHalf').load('studentBio.php', {'reg': varID }).fadeIn(1000);
					$('html, body').animate({ scrollTop:  $('#wizGradeRightHalf').offset().top - 80 }, 'slow'); 
				
					return false; 
				
				}); 

				$('body').on('click','#saveStudentS1',function(){  /* edit student profile information */
				
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

				$('body').on('click','#saveStudentS2',function(){  /* edit student profile information */
				
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

				$('body').on('click','#sponsorData',function(){  /* edit sponsor profile information */
				
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
				
				$('body').on('change','#uploadStudentPic',function(event){  /*upload student picture */
					
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
								
													
					return false;
				  
				});		
			
				function finishAjax(id, response) {  /* load div */
					$('#wait_1, #wait_11').hide();
					$('#'+id).html(unescape(response));
					$('#'+id).fadeIn();
				}


				function finishAjax_tier_three(id, response) {  /* load div */
					$('#wait_2').hide();
					$('#'+id).html(unescape(response));
					$('#'+id).fadeIn();
				}
	 
			 
				setInterval(function() {  /* check inactivity user time */

					var timerData = 'checkUserTimer';

					$('#wizGradePageMsg').load('timerActivityManager.php', {'timeOutType': timerData});
					
				}, 30000);
 

				$('body').on('click','#timeOutLogin',function(){  /* screen lock validation */
				
					$('#frmTimeOut').submit(function(event) {		
							
						$('.timeOutLoader').fadeIn(100);
					
						event.stopImmediatePropagation();
								
						$.post('timeOutManger.php', $(this).find('select, input').serialize(), function(data) {
							
							$('#timeOutMsg').html(data);	
							$('.timeOutLoader').fadeOut(1000);						
						
						});
			  
						return false;
					
					});		
				}); 

				$('body').on('click', '#changeSPass', function(event){  /* change password */
																			
					$('#frmchangeSPass').submit(function(event) {
									
						event.stopImmediatePropagation();
						
						showPageLoader();
								
						$.post('changeAccess.php', $(this).find('select, input').serialize(), function(data) {
							
							$('#msgBox').html(data); 
																
						});
						
						$('html, body').animate({scrollTop:$('#msgBox').position().top}, 'slow'); 
			  
						return false;
					
					});	
											
				}); 
				
				$('body').on('click', '.checkRSDiv',function(event){  /* load e-wallet div in result page */
			
					event.stopImmediatePropagation();											
					
					$(this).slideUp(300);
					
					$('.checkeWalletDiv').slideDown(800);
					
					return false;  
			
				});				
				
				$('body').on('click','.viewFees',function(event){  /* view fees */
			
					event.stopImmediatePropagation();	
					
					var emptyStr = "";
					var feesID = this.id;
					var postVal = 'viewFees';				
					
					$('#editLoader').fadeIn(100);
					$('#editMsg').html(emptyStr);	
					$('#editFeesDiv').show();
					
					$('#editFeesDiv').load('wizGradeFees.php', {'feesData': postVal, 'rData': feesID
										   }).fadeIn(1000);										   
										   
					$('#modalEditBtn-f').trigger('click');					
					
					return false;  
			
				});
					
				$('body').on('change','#sesslevel',function(){  /* load school session div */
					
					$('#wait_1').show();
					$('#result_1').hide();   
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
 
				<?php require ($companionScriptJS);    /* include companion jquery scripts */  ?>


			</script>
            
<?php   }else{ exit; } ?>