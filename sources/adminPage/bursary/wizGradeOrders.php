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
	This script handle product transaction
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

		if (!defined('wizGrade'))

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
			require_once $wizGradeIconPage; /* This include top middle global icon page eg go back, print buttons etcs */	
								

?>	
				
				<!-- row -->
				<!-- row -->	
					<div class="row">  
					<div class="col-sm-12">
					<section class="panel">
					<header class="panel-heading">
						<i class="fa fa-wrench fa-lg"></i>  <span class="hide-res">Product</span> Sales Order
						<span class="tools pull-right">
						<a href="javascript:;" class="fa fa-chevron-down"></a>
						<a href="javascript:;" class="fa fa-times"></a>
						</span>
					</header>
					<div class="panel-body wizGrade-line"> 

						<div id='start' style="display: none;"></div> <div id='end' style="display: none;"></div>

						<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; 
						border: 1px solid #ccc; width:auto; ">
						<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
						<span></span> <b class="caret"></b> 

						</div> <br clear="all" />
						<div id="viewSalesOrder"> <?php require 'wizGradeOrdersInfo.php';  ?> </div> 

					</div>
					</section>
					</div>

				</div>	  
				<!-- / row -->
				
				<!-- product transaction removal pop up modal start -->
				<a href="#removeModal" data-toggle="modal" id="modalRemoveBtn" class=""> </a>

				<div class="modal fade" id="removeModal" tabindex="-1" role="dialog"  aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" 
						data-dismiss="modal" aria-hidden="true">
						<span style='color:#fff !important;'>&times;</span></button>
						<h4 class="modal-title"> Are sure you want to remove this products information ?
						</h4>
					</div>
					<div class="modal-body"> 

						<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="removeLoader"  
						style="cursor:pointer; display:none; margin-bottom:5px;" /></center>

						<div id="removeMsg"> </div> 

						<div class="slideUpFrmDiv">

							<section class="panel">

							<div class="panel-body">

								<div id="removeHData" style="display:none;"></div>

								<?php 

								echo "$infoMsgNX  Are sure you want to remove? <br />
								<span style='color:#000;font-weight:bold;'  id='removeInfo'> </span> $msgEnd";
								?> 

							</div>

							</section>

						</div>

					</div>
					<div class="modal-footer slideUpFrmDiv">
						<button  class="btn btn-danger demoDisenable" id="removeProducts" 
						type="button">Yes</button>
						<button data-dismiss="modal" class="btn btn-danger" 
						type="button">Cancel</button>
					</div>
					</div>
				</div>
				</div>
				<!-- product transaction removal pop up modal end -->

				<!-- product transaction edit pop up modal start -->
				<a href="#editModal" data-toggle="modal" id="modalEditBtn" class=""> </a>

				<div class="modal fade softScrollBar" id="editModal" tabindex="-1" role="dialog"  aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
				<div class="modal-dialog" >
					<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" 
					data-dismiss="modal" aria-hidden="true">
					<span style='color:#fff !important;'>&times;</span></button>
					<h4 class="modal-title"> Transaction Manager
					</h4>
					</div>
					<div class="modal-body modal-body-scroll"> 
					
						<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="editLoader"  
						style="cursor:pointer; display:none; margin-bottom:5px;" /></center>

						<div id="editMs"> </div>


						<div class="slideUpFrmUDiv">

							<section class="panel">

							<div class="panel-body"> 

								<div id="transactionDiv"></div> 

							</div>

							</section>

						</div>

					</div>
					<div class="modal-footer slideUpFrmDiv">

						<button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
					
					</div>
					</div>
				</div>
				</div>
				<!-- product transaction edit pop up modal end --> 
	
              
				<script type="text/javascript">
			  
					$(function() {  /* date range function from js plugin moment */

						var start = moment().subtract(1000, 'days');
						var end = moment();

						function cb(start, end) {
							
							$('#reportrange span').html('<b><i>Search Sales Order By Date</i></b>: ' +start.format('MMMM D, YYYY') + 
							' <b><i>To</i></b> ' + end.format('MMMM D, YYYY'));
													
							
							$('#start').html(start.format('YYYY-M-D'));
							$('#end').html(end.format('YYYY-M-D'));
							if((start != "") || (end != "")){
								
								expenseRange();
								
							}	
							
						}
						
						$('#reportrange').daterangepicker({
							startDate: start,
							endDate: end,
							ranges: {
							   'Today': [moment(), moment()],
							   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
							   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
							   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
							   'Last 90 Days': [moment().subtract(87, 'days'), moment()],
							   'This Month': [moment().startOf('month'), moment().endOf('month')],
							   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
							}
						}, cb);

						cb(start, end); 
						
					});
					
					function expenseRange(){   /* product order date range */
														
						showPageLoader();
						
						var postVal = 'dateRange';
						var start = $('#start').text();
						var end = $('#end').text();
						
						$('#viewSalesOrder').load('wizGradeOrdersInfo.php', {'salesOrderData': postVal, 'salesOrderTo': end, 
							'salesOrderFrom':start});				
						
						return false;  
			
					}
					
					//$('.dpYears').datepicker(); 
				 
				</script>
			  
			  