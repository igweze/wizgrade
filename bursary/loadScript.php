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
	This script handle busary jQuery/Javascript
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
			
			$('body').on('click','#saveFeeCategory',function(){  /* save fee category */	  
			
				$('#frmsaveFeeCategory').submit(function(event) {		
					
					$('#saveLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('feeCategory.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#hmsgBox').html(data);	
						$('html, body').animate({ scrollTop:  $('#hmsgBox').offset().top - 100 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('click','.removeFeeCategory',function(event){  /* remove fee category */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var feeCategoryData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];					
						var hInfo = 'Fee Category Name - '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(feeCategoryData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			});			
			
			$('body').on('click', '#removeFeeCategory',function(event){  /* remove fee category */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeFeeCategory';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('feeCategory.php', {'feeCategoryData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			});

			$('body').on('click','.editFeeCategory',function(event){  /* edit fee category */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var feeCategoryID = this.id;
						var postVal = 'editFeeCategory';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editFeeCategoryDiv').show();
						
						$('#editFeeCategoryDiv').load('feeCategory.php', {'feeCategoryData': postVal, 'rData': feeCategoryID
											   }).fadeIn(1000);											   
											   
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','#updateFeeCategory',function(){  /* update fee category */
			
				$('#frmupdateFeeCategory').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('feeCategory.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 100 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			
			$('body').on('click','#saveExpenseCategory',function(){  /* save expense category */
			
				$('#frmsaveExpenseCategory').submit(function(event) {		
					
					$('#saveLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('expenseCategory.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#hmsgBox').html(data);	
						$('html, body').animate({ scrollTop:  $('#hmsgBox').offset().top - 100 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('click','.removeExpenseCategory',function(event){  /* remove expense category */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var expenseCategoryData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];					
						var hInfo = 'Expense Category Name - '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(expenseCategoryData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			});			
			
			$('body').on('click', '#removeExpenseCategory',function(event){  /* remove expense category */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeExpenseCategory';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('expenseCategory.php', {'expenseCategoryData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			});

			$('body').on('click','.editExpenseCategory',function(event){  /* edit expense category */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var expenseCategoryID = this.id;
						var postVal = 'editExpenseCategory';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editExpenseCategoryDiv').show();
						
						$('#editExpenseCategoryDiv').load('expenseCategory.php', {'expenseCategoryData': postVal, 'rData': expenseCategoryID
											   }).fadeIn(1000);	 
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','#updateExpenseCategory',function(){  /* update expense category */
			
				$('#frmupdateExpenseCategory').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('expenseCategory.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 100 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});			

			$('body').on('click','#burConfiguration',function(){  /* save bursary configuration */
			
				$('#frmburConfiguration').submit(function(event) {		
					
					$('#settingsLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
						
					$.post('wizGradeBursaryConfig.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#msgBoxLib').html(data);	
						$('html, body').animate({scrollTop:$('#scrollLTarget').position().top}, 'slow');
					
					});
	  
					return false;
			
				});		
			});			

			$('body').on('click','#saveFees',function(){  /* save fees */
			
				$('#frmsaveFees').submit(function(event) {		
					
					$('#saveLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeFees.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#hmsgBox').html(data);	
						$('html, body').animate({ scrollTop:  $('#hmsgBox').offset().top - 50 }, 'slow');			
						
					});
	  
					return false;
			
				});		
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
											   
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','.removeFees',function(event){  /* remove fees */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var feesData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];
						var regNo = clickedID[3];
						var student = clickedID[4];	
						var hInfo = hName+ ' payment of '+student+ ' ('+regNo+')';					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(feesData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			});			
			
			$('body').on('click', '#removeFees',function(event){  /* remove fees */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeFees';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('wizGradeFees.php', {'feesData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			});

			$('body').on('click','.editFees',function(event){  /* edit fees */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var feesID = this.id;
						var postVal = 'editFees';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editFeesDiv').show();
						
						$('#editFeesDiv').load('wizGradeFees.php', {'feesData': postVal, 'rData': feesID
											   }).fadeIn(1000);											   
											   
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});		
			
			$('body').on('click','#updateFees',function(){  /* update fees */
			
				$('#frmupdateFees').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeFees.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('click','#transferPayment',function(event){  /* transfer payment */
			
						event.stopImmediatePropagation();	
						
						var feeData = $('#feeCat').val();	
						
						var feeArray = feeData.split('-');
						var amount = feeArray[1];	
						
						$("#amountPaid").val(amount);
						
						return false;  
			
			}); 
			
			$('body').on('click','#saveExpenses',function(){  /* save expenses */
			
				$('#frmsaveExpenses').submit(function(event) {		
					
					$('#saveLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeExpenses.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#hmsgBox').html(data);	
						$('html, body').animate({ scrollTop:  $('#hmsgBox').offset().top - 50 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('click','.viewExpenses',function(event){  /* view expenses */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var expensesID = this.id;
						var postVal = 'viewExpenses';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editExpensesDiv').show();
						
						$('#editExpensesDiv').load('wizGradeExpenses.php', {'expensesData': postVal, 'rData': expensesID
											   }).fadeIn(1000);										   
											   
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','.removeExpenses',function(event){  /* remove expenses */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var expensesData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];
						
						var hInfo = 'Expenditure '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(expensesData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			});
			
			
			$('body').on('click', '#removeExpenses',function(event){  /* remove expenses */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeExpenses';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('wizGradeExpenses.php', {'expensesData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			}); 
			
			$('body').on('click','.editExpenses',function(event){  /* edit expenses */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var expensesID = this.id;
						var postVal = 'editExpenses';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editExpensesDiv').show();
						
						$('#editExpensesDiv').load('wizGradeExpenses.php', {'expensesData': postVal, 'rData': expensesID
											   }).fadeIn(1000);	 
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click','#updateExpenses',function(){  /* update expenses */
			
				$('#frmupdateExpenses').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeExpenses.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			}); 

			$('body').on('click','#saveProductCategory',function(){  /* save product category */
			
				$('#frmsaveProductCategory').submit(function(event) {		
					
					$('#saveLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('productCategory.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#hmsgBox').html(data);	
						$('html, body').animate({ scrollTop:  $('#hmsgBox').offset().top - 100 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('click','.removeProductCategory',function(event){  /* remove product category */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var productCategoryData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];					
						var hInfo = 'Product Category Name - '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(productCategoryData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click', '#removeProductCategory',function(event){  /* remove product category */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeProductCategory';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('productCategory.php', {'productCategoryData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			}); 

			$('body').on('click','.editProductCategory',function(event){  /* edit product category */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var productCategoryID = this.id;
						var postVal = 'editProductCategory';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editProductCategoryDiv').show();
						
						$('#editProductCategoryDiv').load('productCategory.php', {'productCategoryData': postVal, 'rData': productCategoryID
											   }).fadeIn(1000);											   
											   
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','#updateProductCategory',function(){  /* update product category */
			
				$('#frmupdateProductCategory').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('productCategory.php', $(this).find('select, input').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			}); 

			$('body').on('click','#saveProducts',function(){  /* save product */
			
				$('#frmsaveProducts').submit(function(event) {		
					
					$('#saveLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeProducts.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#hmsgBox').html(data);	
						$('html, body').animate({ scrollTop:  $('#hmsgBox').offset().top - 10 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('click','.viewProducts',function(event){  /* view product */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var productsID = this.id;
						var postVal = 'viewProducts';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editProductsDiv').show();
						
						$('#editProductsDiv').load('wizGradeProducts.php', {'productsData': postVal, 'rData': productsID
											   }).fadeIn(1000);	
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			});
			
			$('body').on('click','.removeProducts',function(event){  /* remove product */
			
						event.stopImmediatePropagation();	
						var emptyStr = "";
						var productsData = this.id;
						var clickedID = this.id.split('-');
						var hName = clickedID[2];
						
						var hInfo = 'Product Under Category '+hName;					
						$('#removeInfo').text(hInfo);
						$('#removeHData').text(productsData);	
						$('#removeMsg').html(emptyStr);	
						$('.slideUpFrmDiv').show();
						$('#modalRemoveBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click', '#removeProducts',function(event){  /* remove product */
			
						event.stopImmediatePropagation();											
						
						var postVal = 'removeProducts';
						var rData = $('#removeHData').text();
						
						$('#removeLoader').fadeIn(100);
						
						$('#removeMsg').load('wizGradeProducts.php', {'productsData': postVal, 'rData': rData
											   }).fadeIn(1000);					
						
						return false;  
			
			}); 
			
			$('body').on('click','.editProducts',function(event){  /* edit product */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var productsID = this.id;
						var postVal = 'editProducts';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#editProductsDiv').show();
						
						$('#editProductsDiv').load('wizGradeProducts.php', {'productsData': postVal, 'rData': productsID
											   }).fadeIn(1000);	 
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('click','#updateProducts',function(){  /* update product */
			
				$('#frmupdateProducts').submit(function(event) {		
					
					$('#editLoader').fadeIn(100);	
			
					event.stopImmediatePropagation();
							
					$.post('wizGradeProducts.php', $(this).find('select, input, textarea').serialize(), function(data) {
						
						$('#editMsg').html(data);	
						$('html, body').animate({ scrollTop:  $('#editMsg').offset().top - 30 }, 'slow');			
						
					});
	  
					return false;
			
				});		
			});
			
			$('body').on('change','#productPic',function(event){  /* upload product */
					
					event.stopImmediatePropagation();
					
					$("#frmproductPic").ajaxForm({target: '#msgBoxPic', 
							
							beforeSubmit:function(){ 
						
							console.log('v');
								$("#saveLoader").show();
								$(".productPicBtn").hide();
								
								}, 
							success:function(){ 
								console.log('z');
								 $("#saveLoader").hide();
								 $(".productPicBtn").show();
								}, 
							error:function(){ 
								console.log('d');
								 $("#saveLoader").hide();
								 $(".productPicBtn").show();
								} }).submit();
								
													
				  return false
				  
			});
			
			$('body').on('click','.remProductPic',function(event){  /* remove product picture */
			
						event.stopImmediatePropagation();					
						
						var clickedID = this.id.split('-');
						var pictureID = clickedID[1];
						
						$("#saveLoader").fadeIn(100);
						var pData = "removePic";
						$('#refBox').load('wizGradeProducts.php', {'productsData': pData, 'pictureID': pictureID }).fadeIn(1000);										
			
						return false;  
			
			}); 
			
			$('body').on('click','.viewTransaction',function(event){  /* view transaction */
			
						event.stopImmediatePropagation();	
						
						var emptyStr = "";
						var transID = this.id;
						var transData = 'viewOrder';				
						
						$('#editLoader').fadeIn(100);
						$('#editMsg').html(emptyStr);	
						$('#transactionDiv').show();
						$('.slideTransaction').show();
						
						$('#transactionDiv').load('wizGradeShopping.php', {'transData': transData, 'transID': transID
											   }).fadeIn(1000);											   
											   
						
						$('#modalEditBtn').trigger('click');					
						
						return false;  
			
			}); 
			
			$('body').on('change','#tranStatus',function(){  /* transaction status */	
								
						$('#transLoader').fadeIn(100);
						
						var transData = 'tranStatus';
						var status = $('#tranStatus').val();
						var transID = $('#transID').val(); 
						
						$('#editMsg').load('wizGradeShopping.php', {'transData': transData, 'transID': transID, 'status' :status
											   }).fadeIn(1000);											   
											   
											
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

			$('body').on('change','#feeCat',function(){  /* load fee category */
			
					  $('#result_1, #result_11, #feeDetailsDiv, #feeDetailsDivTop').hide();	
					  $('#wait').show();
					  $("#schoolType").val("");
					  $("#amountPaid").val("");
					  $.get("wizGradeDropper.php", {
							feeCat: "dropFeeDiv",
							feeCatID: $('#feeCat').val()
					  }, function(response){
						  
							$('#result').fadeOut();
							setTimeout("finishAjax('result', '"+escape(response)+"')", 400);
						 
					  });
				   
					  return false;
			});
			
			$('body').on('change','#expenseCat',function(){  /* load expense category */
			
					  $('#result_1, #expenseDetailsDiv').hide();	
					  $('#wait').show();
					  $.get("wizGradeDropper.php", {
							eCat: "dropExpenseDiv",
							eCatID: $('#expenseCat').val()
					  }, function(response){
						  
							$('#result').fadeOut();
							setTimeout("finishAjax('result', '"+escape(response)+"')", 400);
						 
					  });
				   
					  return false;
			});
			
			$('body').on('change','#pCategory',function(){  /* load product category */
			
					  $('#result_1, #productDetailsDiv').hide();	
					  $('#wait').show();
					  $.get("wizGradeDropper.php", {
							pCat: "dropPCatDiv",
							pCatID: $('#pCategory').val()
					  }, function(response){
						  
							$('#result').fadeOut();
							setTimeout("finishAjax('result', '"+escape(response)+"')", 400);
						 
					  });
				   
					  return false;
			});
			
			$('body').on('change','#schoolType',function(){  /* load school type */
			
					  $('#result_1, #result_11, #feeDetailsDiv').hide();
					  $("#amountPaid").val("");
					  $('#wait_1').show();
					  $.get("wizGradeDropper.php", {
							func: "drop_1",
							schoolID: $('#schoolType').val()
					  }, function(response){
						  
							$('#result_1').fadeOut();
							setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
						 
					  });
				   
					  return false;
			});
			
			$('body').on('change','#cLevel',function(){  /* load school level */

						$('#wait_11').show();
						$('#result_11, #feeDetailsDiv').hide();
							$.get("wizGradeDropper.php", {
								func: "loadStudents",
								clevelID: $('#cLevel').val()
							}, function(response){
								$('#result_11').fadeOut();
								setTimeout("finishAjax('result_11', '"+escape(response)+"')", 400);
							});
			   
						return false;
			});
			

		
		
			function finishAjax(id, response) {  /* load div */
					
					$('#wait, #wait_1, #wait_11, #wait_111, #fi_lga').hide();
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
