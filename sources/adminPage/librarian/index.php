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
	This page load librainain dashboard
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */  

if(!session_id()){
    session_start();
}

		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');

         require 'configwizGrade.php';  /* load wizGrade configuration files */	

		 try{		

				$eBookNum = libraryBookTypeTotal($conn, $fiVal);  /* school library book type summary */
				$hBookNum = libraryBookTypeTotal($conn, $seVal);  /* school library book type summary */

			}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}			

			require_once ($wizGradeGlobalDir.'/widgets.php');   /* include page widget */ 
?>
 
				
			<!-- row -->
			<div class="row value-box" style="margin:30px 10px 0px 0px">

				<div class="col-sm-12 col-md-12">
				<div class="panel">
				<div class="panel-heading">
					<i class="fa fa-line-chart fa-lg"></i><span class="hide-res">School</span>  Library Book Info
					<span class="tools pull-right">
					<a href="javascript:;" class="fa fa-chevron-down"></a>
					<a href="javascript:;" class="fa fa-times"></a>
					</span>
				</div>
				<div class="panel-body wizGrade-line">

					<div class="col-lg-6 col-sm-6">
						<section class="panel value-box-cell">
							<div class="symbol terques">
							<i class="fa fa-book"></i>
							</div>
							<div class="value">
							<h1 class="count"><?php echo $eBookNum; ?></h1>

							<p>Electronic (E - BOOK)</p>
							</div>
						</section>

					</div>
					<div class="col-lg-6 col-sm-6">
						<section class="panel value-box-cell">
							<div class="symbol red">
							<i class="fa fa-book"></i>
							</div>
							<div class="value">
							<h1 class="count">
							<?php echo $hBookNum; ?>
							</h1>
							<p>Hard Copy</p>
							</div>
						</section>

					</div> 

					<script src="<?php echo $wizGradeTemplate; ?>js/chartinator.js"></script>
					<script>
					window.jQuery || document.write('<script src="<?php echo $wizGradeTemplate; ?>js/jquery-charts.js"><\/script>')
					</script>

					<script src="<?php echo $wizGradeTemplate; ?>js/chart-wizgrade-config.js"></script>


					<div class="col-sm-6 col-md-6">
						<!-- table -->
						<table id="barChart" class="barChart data-table col-table">
						<caption>Library Book Information Table</caption>
						<tr>
						<th scope="col" data-type="string">Library Books</th>
						<th scope="col" data-type="number">Number of Books</th>
						<th scope="col" data-role="annotation">Annotation</th>
						</tr>
						<tr>
						<td>Electronic (E - BOOK)</td>
						<td align="right"><?php echo $eBookNum; ?></td>
						<td align="right"><?php echo $eBookNum; ?></td>
						</tr>

						<tr>
						<td>Hard Copy</td>
						<td align="right"><?php echo $hBookNum; ?></td>
						<td align="right"><?php echo $hBookNum; ?></td>
						</tr> 
						</table>
						<!-- / table -->
					</div>
					<div class="col-sm-6 col-md-6">   
						<!-- table -->
						<table id="pieChart" class="pieChart data-table col-table">
						<caption>Pie Chart</caption>
						<tr>
						<th scope="col" data-type="string">Library Books</th>
						<th scope="col" data-type="number">Number of Books</th>
						</tr>
						<tr>
						<td>Electronic (E - BOOK)</td>
						<td align="right"><?php echo $eBookNum; ?></td>
						</tr>

						<tr>
						<td>Hard Copy</td>
						<td align="right"><?php echo $hBookNum; ?></td>
						</tr>

						</table>
						<!-- /table -->
					</div> 

				</div>
				</div>

				</div>

			</div>
			<!-- / row -->


            <!-- row -->
            <div class="row value-box" style="margin:15px 10px 0px 0px">

				<div class="col-sm-12 col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<i class="fa fa-clock-o fa-lg"></i> Expired <span class="hide-res">Library</span> Book 
							<span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
						</div>
						<div class="panel-body wizGrade-line"> <button id="paginate-page" class="display-none"  type="submit">Paginate Page</button> 

<?php		 
		
						

$table_head =<<<IGWEZE

		
        
						<!-- table -->
						<table  class='table table-hover style-table wizGradeTBPage' id='' width='100%'>
						<thead><tr><th style="text-align:left !important; padding-right: 15px !important;">App. ID</th>
						<th style="text-align:left !important; padding-right: 15px !important;">Book Details</th> 
						<th style="text-align:left !important; padding-right: 15px !important;">Student Details</th> 
						<th style="text-align:left !important; padding-right: 15px !important;">School</th> 
						<th style="text-align:left !important; padding-right: 15px !important;">Book Status</th> 
						<th style="text-align:left !important; padding-right: 15px !important;">Tasks</th></tr>
						</thead> <tbody>
		
IGWEZE;


			try{
				
  				$libConfigsArray = libraryConfigsArrays($conn);  /* school library book array */
				
				$timeDateline = $libConfigsArray[0]['book_dateline'];
				
				if($timeDateline == '') {$timeDateline = $libDefaultTime;}
				
				$ebele_mark = "SELECT b_id, book_id, lib_user, lib_reg, apply_date, stype, sclass, b_status
				
								FROM $wizGradeLibApplyTB
								
								WHERE  approve_date	<= NOW() - INTERVAL $timeDateline
								
								AND b_status = :b_status
								
								ORDER BY b_id DESC";
					 
 			    $igweze_prep = $conn->prepare($ebele_mark);
				$igweze_prep->bindValue(':b_status', $seVal);
 				$igweze_prep->execute();
				
				$rows_count = $igweze_prep->rowCount(); 
				
				if($rows_count >= $foreal) {  /* check array is empty */
					
					echo  $table_head;
					
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		

						$book_id = $row['book_id'];
						$applyID = $row['b_id'];
						$lib_user = $row['lib_user'];
						$lib_reg = $row['lib_reg'];
						$apply_date = $row['apply_date'];						
						$schoolID = $row['stype'];
						$sClassID = $row['sclass'];
						$b_status = $row['b_status'];


							$ebele_mark_1 = "SELECT book_id, book_name, book_author, book_desc, book_path, book_type, book_hits, book_copies, book_location, 
											stype, sclass, book_status
							
											FROM $wizGradeSchLib
											
											WHERE  book_id = :book_id";
								 
							$igweze_prep_1 = $conn->prepare($ebele_mark_1);
							$igweze_prep_1->bindValue(':book_id', $book_id);
							$igweze_prep_1->execute();
							
							$rows_count_1 = $igweze_prep_1->rowCount(); 
							
							if($rows_count_1 == $foreal) {  /* check array is empty */
							
								while($row_1 = $igweze_prep_1->fetch(PDO::FETCH_ASSOC)) {  /* loop array */		
				   
									$book_id = $row_1['book_id'];
									$book_name = $row_1['book_name'];
									$book_author = $row_1['book_author'];
									$book_path = $row_1['book_path'];
									$book_desc = $row_1['book_desc'];
									$book_type = $row_1['book_type'];
									$book_hits = $row_1['book_hits'];
									$book_copies = $row_1['book_copies'];
									$book_location = $row_1['book_location'];
									$book_status = $row_1['book_status'];
									
									
								}
								
							}
							
						$book_name  = trim($book_name);
						$book_author  = trim($book_author);
						$book_desc  = trim($book_desc);
						$book_desc = htmlspecialchars_decode($book_desc);
						$book_desc = nl2br($book_desc); 

						$bookPicture = libraryUploadsManager($conn, $book_type, $book_path);  /* school library book upload manager */ 

						if($book_type == $fiVal ){
							
							$bookLocation = '';				
							
						}else{
							
							
							$bookLocation = '<tr><th style="padding-left: 30px; text-align:left; width: 30%;">
											<i class="fa  fa-eye"></i> Book Location </td> <td style="padding-left: 
											30px; text-align:left; width: 70%;">'.$book_location.'</td> </tr>';
							
						}

						if($book_author == '') { $book_author = 'Anonymous'; }
						if($book_type != '') { $book_type = $libraryTypeArr[$book_type]; }
						else{$book_type = '-';}
						
						
						$bookStatus = $libraryAppStatusArr[$b_status];
						
						$schoolName = $school_list[$schoolID];
						
						require $wizGradeSchoolTBS;						
						
						$regNum = studentReg($conn, $lib_user);  /* student registration number  */
						
						$studentName = studentName($conn, $regNum);  /* student name  */
		
						$studentPic = studentPicture($conn, $regNum);  /* student profile picture  */
					
						
$bookInfo =<<<IGWEZE


						<tr><td style="text-align:left !important; padding-right: 7px !important;"> App-$applyID </td>
						<td style="text-align:left !important; padding-right: 7px !important;">
						<img src = "$bookPicture" style="width: 30px; height: 30px; float:left; border-radius: 20px; padding-right: 5px"> $book_name by $book_author </td> 
						<td style="text-align:left !important; padding-right: 7px !important;">
						<img src = "$studentPic" style="width: 30px; height: 30px; float:left; border-radius: 20px; padding-right: 5px"> $regNum <br /> $studentName </td> 
						<td style="text-align:left !important; padding-right: 7px !important;">$schoolName</td> 
						<td style="text-align:left !important; padding-right: 7px !important; text-transform:capitalize;">$bookStatus </td> 
						<td style="text-align:left !important; padding-right: 7px !important;">						
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
								<i class="fa fa-wrench"></i> <span class="caret"></span></button>
									<ul role="menu" class="dropdown-menu pull-right">
											<li>
											<a href='javascript:;' id='$schoolID-$lib_user' class ='showStudentBHistory'><button class="btn btn-success btn-xs">
											<i class="fa fa-eye"></i></button> Student History</a>
											</li>
											<li class="divider"></li>
											<li>
											<a href='javascript:;' id ="$book_id" class ='showBookHistory'> <button class="btn btn-primary btn-xs">
											<i class="fa fa-eye"></i></button> Book History </a>					
											</li>
									</ul> 
											
							</div><!-- /btn-group --> 
						
						</td>
						</tr>  
		
IGWEZE;

						echo $bookInfo; 
				
					}
					
					
					echo  '</tbody></table><!-- / table -->';

				}else{  /* display information message */ 
			
					$msg_i =  "Oooooooooops, no library book has exceeded its dateline. Thanks";
					echo $infMsg.$msg_i.$msgEnd; 
				
				}
				
			}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
			}
	 	
?>	

						</div>
					</div>
				</div>
		  				  
            </div>
            <!--/ row -->
			  
			  
			<!-- school annoucement start -->	
			<div class="row" style="margin:15px 10px 0px 0px">
					<div class="col-lg-12">
                      <section class="panel">
                        <header class="panel-heading">
                             <i class="fa fa-bullhorn fa-lg"></i> <span class="hide-res">School</span> Annoucements  
							 <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                        </header>
                        <div class="panel-body wizGrade-line">
								<div class="col-lg-12">
								  <section class="panel">
									  
									<div class="panel-body wizGrade-clock"> 
											 
								<?php
									try {

										$broadcastDataArr = broadcastData($conn);  /* school annoucement/broadcast array */
										$broadcastDataCount = count($broadcastDataArr);
										
									}catch(PDOException $e) {

											wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
									 
									} 
											
								?>			

							
								<button class="paginate-page display-none"  type="submit">Paginate Page</button> 
								<!-- table -->		
								<table  class='table table-hover style-table wizGradeTBPage' id=''>
										<thead><tr>
										<th>S/N</th>                         
										<th class='text-left'>Title</th> 						 
										<th class='text-left'>Date</th> 
										<th class='text-left'>Tasks</th>
										</tr></thead> <tbody>

<?php
						
										if($broadcastDataCount >= $fiVal){  /* check array is empty */	 
											
											for($i = $fiVal; $i <= $broadcastDataCount; $i++){  /* loop array */	
												
												$bID = $broadcastDataArr[$i]["bID"]; 
												$bTitle = $broadcastDataArr[$i]["bTitle"];
												$broadcastMsg = $broadcastDataArr[$i]["broadcastMsg"]; 
												$date = $broadcastDataArr[$i]["date"]; 
												 
												$bID = trim($bID); 
												
												$date = date("j M Y", strtotime($date)); 
												
												$serailNo++; 

$broadcastData =<<<IGWEZE
        
								<tr id="row-$bID" >
								<td class='text-left' width="5%">$serailNo</td>  
								<td class='text-left' width="70%"> $bTitle  </td>  
								<td class='text-left' width="15%"> $date </td>  
								<td  class='text-left' width="10%"> 
								
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button">
										<i class="fa fa-wrench"></i> <span class="caret"></span></button>
											<ul role="menu" class="dropdown-menu pull-right"> 
											
													<li>
														<a href='javascript:;' id='$bID' class ='viewBroadcast'>
														<button class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i></button> View</a>
													</li> 
											</ul>		
									</div><!-- /btn-group --> 
								
								</td>
								</tr>
		
IGWEZE;
                               
												echo $broadcastData;
								
								

											} 
								
								
										}else{  /* display information message */ 
										
											$msg_i = "Ooooooops, there is no school annoucement to show at the momment"; 
											echo $infMsg.$msg_i.$msgEnd;
										
										}
										
?>
                        
								</tbody>
								</table>
								<!-- / table -->
											
										 
							
										</div>
								  </section>
								</div>  
				
						</div>
                      </section>
					</div>
				  
				</div>
				<!-- school annoucement end -->				
				   
			
				<!-- row -->
				<div class="row" style="margin:25px 10px 0px 0px">
					<div class="col-lg-12">
                      <section class="panel">
                        <header class="panel-heading">
                             <i class="fa fa-calendar fa-lg"></i> School Events 
							 <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                        </header>
                        <div class="panel-body wizGrade-line">
								<div class="col-lg-12">
								  <section class="panel">
									  
									  <div class="panel-body wizGrade-linea">
											<!-- school event calendar start -->  
											<div id="dialog" title="Cpanel" style="display:none;"> </div>
											
											<div id='loading' style='display:none'><center><img src="loading.gif" alt="Loading . . . . 
											Please Wait"/> </center></div>
											<div id="EventsCpanel"> </div>
											<div id="msgBox"> </div>
											
											<div id='wizGradePrintArea'>
												<div id="calendarH" class="has-toolbar"></div>
											</div> 
											<!-- school event calendar end -->  
							
										</div>
								  </section>
								</div> 
								 
				
						</div>
                      </section>
					</div>
				  
				</div> 
				<!-- / row -->
 
		  
				<!-- broadcast information edit pop up modal start -->	
				<a href="#editModal" data-toggle="modal" id="modalEditBtn" class=""> </a>

				<div class="modal fade" id="editModal" tabindex="-1" role="dialog" 
					aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					<div class="modal-dialog">
					  <div class="modal-content">
						  <div class="modal-header">
							  <button type="button" class="close" 
							  data-dismiss="modal" aria-hidden="true">
							  <span style='color:#fff !important;'>&times;</span></button>
							  <h4 class="modal-title"> Annoucements  Manager
							  </h4>
						  </div>
						  <div class="modal-body modal-body-scroll"> 
						 
								<center><img src="<?php echo $wizGradeTemplate?>images/loading.gif" alt="Page Loading >>>>>" class="loader-img" id="editLoader"  
												  style="cursor:pointer; display:none; margin-bottom:5px;" /></center>
				
								<div id="editMsg"> </div> 
										
								<div class="slideUpFrmUDiv">
					 
									<section class="panel">
									
									<div class="panel-body"> 
									
										<div id="editBroadcastDiv"></div> 
										  
									</div>
									
									</section>
						  
								</div>

						  </div>
						  <div class="modal-footer slideUpFrmDiv">							  
							  <button data-dismiss="modal" class="btn btn-danger" 
							  type="button">Close</button>
						  </div>
					  </div>
					</div>
				</div>
			  
				<script type='text/javascript'>  $('.dpYears').datepicker();   </script> 
				<!-- broadcast information edit pop up modal end --> 
	
                <script type='text/javascript' src='<?php echo $wizGradeTemplate; ?>js/css-clocks.js'></script>              
				<script type="text/javascript">
				

					var date = new Date();
						var d = date.getDate();
						var m = date.getMonth();
						var y = date.getFullYear();
						var InsertCalData = 'InsertTimetable';
						var CalInputData = 'LoadTimetableInputs';
						var valEmpty = '';
						
						$('#calendarH').html(valEmpty);
						$('#msgBox').html(valEmpty);
						
						var calendar = $('#calendarH').fullCalendar({
							theme: false,
							header: {
								left: 'prev,next today',
								center: 'title',
								right: 'month,agendaWeek,agendaDay'
							},
							selectable: true,
							
							selectHelper: true,
							
							
							events: "eventManager.php?eventData=showEvent",
							
							loading: function(bool) {
								if (bool) $('#loading').show();
								else $('#loading').hide();
							}
							
						});
					

				</script>