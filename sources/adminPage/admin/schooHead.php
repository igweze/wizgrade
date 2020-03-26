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
	This page is the school head index widget page
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */  

if(!session_id()){
    session_start();
}


		define('wizGrade', 'igweze');  /* define a check for wrong access of file */	  
        
		require 'configwizGrade.php';  /* load wizGrade configuration files */	 

			try {
				
				$sessionInfo = currentSessionInfo($conn); /* retrieve current school session informatio */
				$totalStaffs = activeStaffs($conn); /* retrieve school total active staff */
				$levelArray = studentLevelsArray($conn); /* retrieve school level array */
				array_unshift($levelArray,"");
				unset($levelArray[0]);
			
			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			}

			/* calculating school population class by class*/
			
			list ($fiSessionID, $fiSession) = explode ("@$@", $sessionInfo);
			
			$seSessionID =  ($fiSessionID - $fiVal);
			
			$thSessionID =  ($fiSessionID - $seVal);
			
			$foSessionID =  ($fiSessionID - $thVal);
			
			$fifSessionID =  ($fiSessionID - $foVal);
			
			$sixSessionID =  ($fiSessionID - $fifVal);

			if($schoolExt == $wizGradeNurAbr){ /* check if school loaded is nursery school */

				$fiStuTotal = studentsPerStandard($conn, $fiSessionID); /* calculating 1st level school population */
			
				if($fiStuTotal >= $foreal){
				
					$fifTotal = studentsSexPerStandard($conn, $fiSessionID, $femaleG); /* calculating 1st level school female population */
					$fimTotal = studentsSexPerStandard($conn, $fiSessionID, $maleG); /* calculating 1st level school male population */
				}

				$seStuTotal = studentsPerStandard($conn, $seSessionID); /* calculating 2nd level school population */
			
				if($seStuTotal >= $foreal){
				
					$sefTotal = studentsSexPerStandard($conn, $seSessionID, $femaleG); /* calculating 2nd level school female population */
					$semTotal = studentsSexPerStandard($conn, $seSessionID, $maleG); /* calculating 2nd level school male population */
				}

				$thStuTotal = studentsPerStandard($conn, $thSessionID); /* calculating 3rd level school population */

				if($thStuTotal >= $foreal){

					$thfTotal = studentsSexPerStandard($conn, $thSessionID, $femaleG); /* calculating 3rd level school female population */
					$thmTotal = studentsSexPerStandard($conn, $thSessionID, $maleG); /* calculating 3rd level school male population */
				}
 
				
				$activeFTotal = ($fifTotal + $sefTotal + $thfTotal); /* calculating school female population total  */
				$activeMTotal = ($fimTotal + $semTotal + $thmTotal);/* calculating school male population total  */

				$activeStuTotal = ($fiStuTotal + $seStuTotal + $thStuTotal); /* calculating school population total */
				
			}else{ /* else is not nursery school */

				$fiStuTotal = studentsPerStandard($conn, $fiSessionID); /* calculating 1st level school population */
			
				if($fiStuTotal >= $foreal){
				
					$fifTotal = studentsSexPerStandard($conn, $fiSessionID, $femaleG); /* calculating 1st level school female population */
					$fimTotal = studentsSexPerStandard($conn, $fiSessionID, $maleG); /* calculating 1st level school male population */
				}

				$seStuTotal = studentsPerStandard($conn, $seSessionID); /* calculating 2nd level school population */
			
				if($seStuTotal >= $foreal){
				
					$sefTotal = studentsSexPerStandard($conn, $seSessionID, $femaleG); /* calculating 2nd level school female population */
					$semTotal = studentsSexPerStandard($conn, $seSessionID, $maleG); /* calculating 2nd level school male population */
				}

				$thStuTotal = studentsPerStandard($conn, $thSessionID); /* calculating 3rd level school population */

				if($thStuTotal >= $foreal){

					$thfTotal = studentsSexPerStandard($conn, $thSessionID, $femaleG); /* calculating 3rd level school female population */
					$thmTotal = studentsSexPerStandard($conn, $thSessionID, $maleG); /* calculating 3rd level school male population */
				}

				$foStuTotal = studentsPerStandard($conn, $foSessionID); /* calculating 4th level school population */

				if($foStuTotal >= $foreal){

					$fofTotal = studentsSexPerStandard($conn, $foSessionID, $femaleG); /* calculating 4th level school female population */
					$fomTotal = studentsSexPerStandard($conn, $foSessionID, $maleG); /* calculating 4th level school male population */
					
				}

				$fifStuTotal = studentsPerStandard($conn, $fifSessionID); /* calculating 5th level school population */

				if($fifStuTotal >= $foreal){

					$fiffTotal = studentsSexPerStandard($conn, $fifSessionID, $femaleG); /* calculating 5th level school female population */
					$fifmTotal = studentsSexPerStandard($conn, $fifSessionID, $maleG); /* calculating 5th level school male population */
					
				}

				$sixStuTotal = studentsPerStandard($conn, $sixSessionID); /* calculating 6th level school population */

				if($sixStuTotal >= $foreal){

					$sixfTotal = studentsSexPerStandard($conn, $sixSessionID, $femaleG); /* calculating 6th level school female population */
					$sixmTotal = studentsSexPerStandard($conn, $sixSessionID, $maleG); /* calculating 6th level school male population */
					
				}
				
				$activeFTotal = ($fifTotal + $sefTotal + $thfTotal + $fofTotal + $fiffTotal + $sixfTotal); /* calculating school female population total  */
				$activeMTotal = ($fimTotal + $semTotal + $thmTotal + $fomTotal + $fifmTotal + $sixmTotal);/* calculating school male population total  */

				$activeStuTotal = ($fiStuTotal + $seStuTotal + $thStuTotal + $foStuTotal + $fifStuTotal + $sixStuTotal); /* calculating school population total */				
			}

			require_once ($wizGradeGlobalDir.'/widgets.php');   /* include page widget */		
?>          
			
            <!-- school strenght summary start -->
            <div class="row value-box" style="margin:30px 10px 0px 0px">

				<div class="col-lg-12 col-md-12">
                  <div class="panel">
                    <div class="panel-heading">
							<i class="fa fa-line-chart fa-lg"></i> School  <span class="hide-res">Strenght</span> Summary 
							<span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                    </div>
                    <div class="panel-body wizGrade-line"><br /> 
					  			  
							<div class="col-lg-4 col-lg-6">
							  <section class="panel value-box-cell">
								  <div class="symbol terques">
									  <i class="fa fa-users"></i>
								  </div>
								  <div class="value">
									  <h1 class="count">
										  <?php echo $activeStuTotal; ?>
									  </h1>
									  <p>Active <br />Students</p>
								  </div>
							  </section>
							</div>
							
							<div class="col-lg-4 col-lg-6">
							  <section class="panel value-box-cell">
								  <div class="symbol red">
									  <i class="fa fa-female"></i>
								  </div>
								  <div class="value">
									  <h1 class=" count2">
										  <?php echo $activeFTotal; ?>
									  </h1>
									  <p> Active <br />Female</p>
								  </div>
							  </section>
							</div>
							
							<div class="col-lg-4 col-lg-6">
							  <section class="panel value-box-cell">
								  <div class="symbol yellow">
									  <i class="fa fa-male"></i>
								  </div>
								  <div class="value">
									  <h1 class=" count3">
										  <?php echo $activeMTotal; ?>
									  </h1>
									  <p>Active <br /> Male</p>
								  </div>
							  </section>
							</div>
						  

                            <table  class='table table-hover style-table'>

								<thead>
                                <tr><th><i class="fa fa-book"></i> Class</th>
                                <th><i class="fa fa-female"></i> FEMALE</th>
                                <th><i class="fa fa-male"></i> MALE</th>
                                <th><i class="fa fa-users"></i> TOTAL </th></tr>
								</thead>
                                <tbody>

                          <?php 
						  if($schoolExt == $wizGradeNurAbr){ /* check if school loaded is nursery school */
						  ?> 	  
                  


                                <tr><td> <?php echo $levelArray[$fiVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $fifTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fimTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fiStuTotal; ?></span></td></tr>

                                <tr><td> <?php echo $levelArray[$seVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $sefTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $semTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $seStuTotal; ?></span></td></tr>
                                
                                <tr><td> <?php echo $levelArray[$thVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $thfTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $thmTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $thStuTotal; ?></span></td></tr>                                


                          <?php 
						  }else{  /* school loaded is not nursery school */
						  ?> 	  

                                <tr><td> <?php echo $levelArray[$fiVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $fifTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fimTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fiStuTotal; ?></span></td></tr>

                                <tr><td> <?php echo $levelArray[$seVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $sefTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $semTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $seStuTotal; ?></span></td></tr>
                                
                                <tr><td> <?php echo $levelArray[$thVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $thfTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $thmTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $thStuTotal; ?></span></td></tr>

                                <tr><td> <?php echo $levelArray[$foVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $fofTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fomTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $foStuTotal; ?></span></td></tr>

                                <tr><td> <?php echo $levelArray[$fifVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $fiffTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fifmTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fifStuTotal; ?></span></td></tr>


                                <tr><td> <?php echo $levelArray[$sixVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $sixfTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $sixmTotal; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $sixStuTotal; ?></span></td></tr>
                          <?php 
						   }
						  ?> 	  
                                </tbody>
                            </table>
                  
				 
			  
						<script src="<?php echo $wizGradeTemplate; ?>js/chartinator.js"></script>				
						<script src="<?php echo $wizGradeTemplate; ?>js/chart-wizgrade-config.js"></script> 
                
						<!-- School bar chart population start -->
						<div class="col-lg-6 col-md-6">
						
							<table id="barChart" class="barChart data-table col-table">
								<caption>Student Population Table</caption>
								<tr>
									<th scope="col" data-type="string">Student</th>
									<th scope="col" data-type="number">Student's Population</th>
									<th scope="col" data-role="annotation">Annotation</th>
								</tr>
							   <tr>
								  <td><?php echo $levelArray[$fiVal]['level'];?> </td>
								  <td align="right"><?php echo $fiStuTotal; ?></td>
								  <td align="right"><?php echo $fiStuTotal; ?></td>
							   </tr>
								<tr>
									<td><?php echo $levelArray[$seVal]['level'];?> </td>
									<td align="right"><?php echo $seStuTotal; ?></td>
									<td align="right"><?php echo $seStuTotal; ?></td>
								</tr>
						
								<tr>
									<td><?php echo $levelArray[$thVal]['level'];?>  </td>
									<td align="right"><?php echo $thStuTotal; ?></td>
									<td align="right"><?php echo $thStuTotal; ?></td>
								</tr>
						
								<tr>
									<td><?php echo $levelArray[$foVal]['level'];?>  </td>
									<td align="right"><?php echo $foStuTotal; ?></td>
									<td align="right"><?php echo $foStuTotal; ?></td>
								</tr>
						
								<tr>
									<td><?php echo $levelArray[$fifVal]['level'];?> </td>
									<td align="right"><?php echo $fifStuTotal; ?></td>
									<td align="right"><?php echo $fifStuTotal; ?></td>
								</tr>
						
								<tr>
									<td><?php echo $levelArray[$sixVal]['level'];?> </td>
									<td align="right"><?php echo $sixStuTotal; ?></td>
									<td align="right"><?php echo $sixStuTotal; ?></td>
								</tr>  
						
							</table>
							
						</div>
						<!-- School bar chart population end -->
						
						<!-- School pie chart population start -->
						<div class="col-lg-6 col-md-6">   
							<table id="pieChart" class="pieChart data-table col-table">
								<caption>Pie Chart</caption>
								<tr>
									<th scope="col" data-type="string">Student</th>
									<th scope="col" data-type="number">Student's Population</th>
								</tr>
						
								<tr>
									<td><?php echo $levelArray[$fiVal]['level'];?> </td>
									<td align="right"><?php echo $fiStuTotal; ?></td>
								</tr>
								
								<tr>
									<td><?php echo $levelArray[$seVal]['level'];?> </td>
									<td align="right"><?php echo $seStuTotal; ?></td>
								</tr>
						
								<tr>
									<td><?php echo $levelArray[$thVal]['level'];?> </td>
									<td align="right"><?php echo $thStuTotal; ?></td>
								</tr>
						
								<tr>
									<td><?php echo $levelArray[$foVal]['level'];?>  </td>
									<td align="right"><?php echo $foStuTotal; ?></td>
								</tr>
						
								<tr>
									<td><?php echo $levelArray[$fifVal]['level'];?>  </td>
									<td align="right"><?php echo $fifStuTotal; ?></td>
								</tr>
						
								<tr>
									<td><?php echo $levelArray[$sixVal]['level'];?>  </td>
									<td align="right"><?php echo $sixStuTotal; ?></td>
								</tr>
						
								
							</table>
						
						</div>
						<!-- School pie chart population end --> 
                    
					</div>
                  
				</div>

			</div>
		  				  
            </div>

			<!-- school strenght summary end -->   

			 <!-- transaction summary start -->
            <div class="row value-box" style="margin:30px 10px 0px 0px">

				<div class="col-lg-12">
					<div class="panel">
				  
					 <div class="panel-heading">
							<i class="fa fa-line-chart fa-lg"></i> <span class="hide-res">School</span>  Transaction <span class="hide-res">Summary</span> 
							<span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                      </div>	
                     
                      <div class="panel-body wizGrade-line">
					 			  
								  
							<div class="form-group ">
                                     
                                      <div class="col-md-6 pull-right">
                                          <div data-date="2018-01-01T15:25:00Z" class="input-group date chartYears">
                                              <input type="text" class="form-control" readonly="" size="16" id="chartYears">
                                              <div class="input-group-btn">
                                                  <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
												    <button type="button" class="btn btn-white date-set"><i class="fa fa-calendar"></i> 
													Select Year <span class="hide-res">Summary To View Below</span></button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

								  
						<br clear="all"/ >
						<br clear="all"/ > 
						
						
							<div id = "bursaryChart">
							
							
									<?php require_once $wizGradeGlobalDir.'/busaryCharts.php'; ?>
							
							</div> 
						
						
						</div>
				  
					</div>

				</div>
		  				  
            </div> 
            <!-- transaction summary  end -->	
			
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
									  
									  <div class="panel-body wizGrade-linea">
											<!-- school annoucement start -->  
											 
											<?php
											try {
										 
												$broadcastDataArr = broadcastData($conn);  /* school annoucement/broadcast array */
												$broadcastDataCount = count($broadcastDataArr);
												
											}catch(PDOException $e) {
											
													wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
											 
											} 
														
											?>			

								<script type='text/javascript'> $('.paginate-page').trigger('click');  /*  paginate table using Jquery dataTable */ </script> 
								<button class="paginate-page display-none"  type="submit">Paginate Page</button> 
										
								<table  class='table table-hover style-table wizGradeTBPage' id=''>
										<thead><tr>
										<th>S/N</th>                         
										<th class='text-left'>Title</th> 						 
										<th class='text-left'>Date</th> 
										<th class='text-left'>Tasks</th>
										</tr></thead> <tbody>

        <?php
						
									if($broadcastDataCount >= $fiVal){	 
											
											for($i = $fiVal; $i <= $broadcastDataCount; $i++){	
												
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
													<li class="divider"></li>						
													<li>					
													<a href='javascript:;' id='$bID' class ='editBroadcast'>
													<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button> Edit</a>
													</li>
													<li class="divider"></li>
													<li>
													<a href='javascript:;' id='wizGrade-$bID-$expenseCategory' class ='removeBroadcast'> 
													<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button> Remove</a>			
													</li>  
													
									</div><!-- /btn-group --> 
								
								</td>
								</tr>
		
IGWEZE;
                               
												echo $broadcastData;
								
								

											} 
								
								
									}else{
										
												$msg_i = "Ooooooops, there is no school annoucement to show at the momment"; 
												echo $infMsg.$msg_i.$msgEnd;
										
									}	


				
          ?>
                        
                        
									</tbody></table>
											
											<!-- school annoucement end -->  
							
										</div>
								  </section>
								</div>  
				
						</div>
                      </section>
					</div>
				  
				</div>
				<!-- school annoucement end -->				
				   
			
				<div class="row" style="margin:15px 10px 0px 0px">
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
					
				<!-- broadcast information removal pop up modal start - ->	
				<a href="#removeModal" data-toggle="modal" id="modalRemoveBtn" class=""> </a>
				
				<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" 
				aria-labelledby="wizGrade-modalLabel" aria-hidden="true">
					<div class="modal-dialog">
					  <div class="modal-content">
						  <div class="modal-header">
							  <button type="button" class="close" 
							  data-dismiss="modal" aria-hidden="true">
							  <span style='color:#fff !important;'>&times;</span></button>
							  <h4 class="modal-title"> Are sure you want to remove this broadcast information ?
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
							  <button  class="btn btn-danger demoDisenable" id="removeBroadcast" 
							  type="button">Yes</button>
							  <button data-dismiss="modal" class="btn btn-danger" 
							  type="button">Cancel</button>
						  </div>
					  </div>
					</div>
				</div>
				<!-- broadcast information removal pop up modal end -->	
		  
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
				
						/* Jquery school event calendar script */
						var date = new Date();
						var d = date.getDate();
						var m = date.getMonth();
						var y = date.getFullYear();
						var saveEvent = 'saveEvent';
						var eventInput = 'eventInput';
						var emptyVal = '';
						var eventMsg = '';
						var eMsg = '';
						//$('.fc-event').remove();
						$('#calendarH').html(emptyVal);
						$('#msgBox').html(emptyVal);
						
						var calendar = $('#calendarH').fullCalendar({
							
							theme: false,
							header: {
								left: 'prev,next today',
								center: 'title',
								right: 'month,agendaWeek,agendaDay'
							},
							selectable: true,							
							selectHelper: true,
							select: function(start, end, allDay) {
							
							var start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
							var end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
											 
							$('#dialog').load('eventManager.php', {eventData: eventInput}); 
							
								$("#dialog").dialog({
									resizable: false,
									height:300,
									width:500,
									modal: true,
									title: 'School Events Manager',
									buttons: { 
										
											 "SAVE EVENT": function() { 
												var eMsg = $('#eComment').get(0).value;
												$('#msgBox').load('eventManager.php', {eventMsg: eMsg, start: start, end: end, allDay: allDay, 
													  eventData: saveEvent });
												$('#calendarH').fullCalendar('refetchEvents');
												$("#dialog").dialog( "close" );
												
												/*calendar.fullCalendar('renderEvent', {
														eventMsg: eMsg,
														start: start,
														end: end,
														allDay: allDay
												},
												true // make the event "stick"
										
												);*/ 
									
											 },
											  
											 CLOSE: function() {
												$("#dialog").dialog( "close" );
											 }

									}
								});
									
									
								calendar.fullCalendar('unselect');
							},
					
							editable: true,
							droppable: false,
							draggable: false,
							
							eventClick: function(calEvent, jsEvent, view) {

									id = calEvent.id;
									$('#dialog').html(emptyVal);
									var loadEvent = 'loadEvent'; 
									var updateEvent = 'updateEvent'; 
									var deleteEvent = 'deleteEvent'; 
									
									$('#dialog').load('eventManager.php', {eventID: id, eventData: loadEvent}); 

									$("#dialog").dialog({
										resizable: false,
										height:300,
										width:500,
										modal: true,
										title: 'School Event Manager',
										buttons: {
												 UPDATE: function() { 
													var eventMsg = $('#eventComment').get(0).value;
													$('#msgBox').load('eventManager.php', {eventID: id, eventData: updateEvent, eventMsg: eventMsg});
													$('#calendarH').fullCalendar('refetchEvents');
													$("#dialog").dialog( "close" );
												 },
												 
												 DELETE: function() {
													$('#msgBox').load('eventManager.php', {eventID: id, eventData: deleteEvent});
													$('#calendarH').fullCalendar('refetchEvents');
													$("#dialog").dialog( "close" );
												 },
												 
												 CLOSE: function() {
													$("#dialog").dialog( "close" );
												 }

											   }
									});
							},
							
							events: "eventManager.php?eventData=showEvent",
									
							loading: function(bool) {
								if (bool) $('#loading').show();
								else $('#loading').hide();
							}
							
						});
						
						$(".chartYears").datetimepicker({
							format: "yyyy",
							startView: 'decade',
							minView: 'decade',
							viewSelect: 'decade',
							autoclose: true,
						});

					

				</script>  