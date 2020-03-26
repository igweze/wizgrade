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
	This script load staff and admin common dashboard
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */  

if(!session_id()){
    session_start();
}


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!'); 
        
		require 'configINwizGrade.php';  /* load wizGrade configuration files */	 
		
		if (($_SESSION['accessGrade'] != $staffGrade)) { 

			try {
		
				$sessionInfoSec = currentSessionInfo($conn);  /* current school session information  */
				$totalStaffs = activeStaffs($conn);  /* school active staff count */				
				
				list ($fiSessionID, $fiSession) = explode ("@$@", $sessionInfoSec);
				
				$seSessionID =  ($fiSessionID - $fiVal);			
				$thSessionID =  ($fiSessionID - $seVal);
				$foSessionID =  ($fiSessionID - $thVal);			
				$fifSessionID =  ($fiSessionID - $foVal);
				$sixSessionID =  ($fiSessionID - $fifVal);


				/* Nursery School Summary */

				require_once ($wizGradeDir.$wizGradeNurConfig);   /* include configuration script */

				$levelArrayNur = studentLevelsArray($conn); /* student level array */
				array_unshift($levelArrayNur,"");
				unset($levelArrayNur[0]);


				$fiStuTotalNur = studentsPerStandard($conn, $fiSessionID);  /* school active student pupolation count */

				if($fiStuTotalNur >= $foreal){  /* school active gender pupolation count */

					$fifTotalNur = studentsSexPerStandard($conn, $fiSessionID, $femaleG);
					$fimTotalNur = studentsSexPerStandard($conn, $fiSessionID, $maleG);
				}

				$seStuTotalNur = studentsPerStandard($conn, $seSessionID);  /* school active student pupolation count */

				if($seStuTotalNur >= $foreal){  /* school active gender pupolation count */

					$sefTotalNur = studentsSexPerStandard($conn, $seSessionID, $femaleG);
					$semTotalNur = studentsSexPerStandard($conn, $seSessionID, $maleG);
				}

				$thStuTotalNur = studentsPerStandard($conn, $thSessionID);  /* school active student pupolation count */

				if($thStuTotalNur >= $foreal){  /* school active gender pupolation count */

					$thfTotalNur = studentsSexPerStandard($conn, $thSessionID, $femaleG);
					$thmTotalNur = studentsSexPerStandard($conn, $thSessionID, $maleG);
				}


				$activeFTotalNur = ($fifTotalNur + $sefTotalNur + $thfTotalNur);
				$activeMTotalNur = ($fimTotalNur + $semTotalNur + $thmTotalNur );

				$activeStuTotalNur = ($fiStuTotalNur + $seStuTotalNur + $thStuTotalNur);

				/* Nursery School Summary End */


				/* Primary School Summary */

				require_once ($wizGradeDir.$wizGradePRIConfig);   /* include configuration script */ 

				$levelArrayPri = studentLevelsArray($conn); /* student level array */
				array_unshift($levelArrayPri,"");
				unset($levelArrayPri[0]);



				$fiStuTotalPri = studentsPerStandard($conn, $fiSessionID);  /* school active student pupolation count */

				if($fiStuTotalPri >= $foreal){  /* school active gender pupolation count */

					$fifTotalPri = studentsSexPerStandard($conn, $fiSessionID, $femaleG);
					$fimTotalPri = studentsSexPerStandard($conn, $fiSessionID, $maleG);
				}

				$seStuTotalPri = studentsPerStandard($conn, $seSessionID);  /* school active student pupolation count */

				if($seStuTotalPri >= $foreal){  /* school active gender pupolation count */

					$sefTotalPri = studentsSexPerStandard($conn, $seSessionID, $femaleG);
					$semTotalPri = studentsSexPerStandard($conn, $seSessionID, $maleG);
				}

				$thStuTotalPri = studentsPerStandard($conn, $thSessionID);  /* school active student pupolation count */

				if($thStuTotalPri >= $foreal){  /* school active gender pupolation count */

					$thfTotalPri = studentsSexPerStandard($conn, $thSessionID, $femaleG);
					$thmTotalPri = studentsSexPerStandard($conn, $thSessionID, $maleG);
				}

				$foStuTotalPri = studentsPerStandard($conn, $foSessionID);  /* school active student pupolation count */

				if($foStuTotalPri >= $foreal){  /* school active gender pupolation count */

					$fofTotalPri = studentsSexPerStandard($conn, $foSessionID, $femaleG);
					$fomTotalPri = studentsSexPerStandard($conn, $foSessionID, $maleG);
					
				}

				$fifStuTotalPri = studentsPerStandard($conn, $fifSessionID);  /* school active student pupolation count */

				if($fifStuTotalPri >= $foreal){  /* school active gender pupolation count */

					$fiffTotalPri = studentsSexPerStandard($conn, $fifSessionID, $femaleG);
					$fifmTotalPri = studentsSexPerStandard($conn, $fifSessionID, $maleG);
					
				}


				$sixStuTotalPri = studentsPerStandard($conn, $sixSessionID);  /* school active student pupolation count */

				if($sixStuTotalPri >= $foreal){  /* school active gender pupolation count */

					$sixfTotalPri = studentsSexPerStandard($conn, $sixSessionID, $femaleG);
					$sixmTotalPri = studentsSexPerStandard($conn, $sixSessionID, $maleG);
					
				}

				$activeFTotalPri = ($fifTotalPri + $sefTotalPri + $thfTotalPri + $fofTotalPri + $fiffTotalPri + $sixfTotalPri);
				$activeMTotalPri = ($fimTotalPri + $semTotalPri + $thmTotalPri + $fomTotalPri + $fifmTotalPri + $sixmTotalPri);

				$activeStuTotalPri = ($fiStuTotalPri + $seStuTotalPri + $thStuTotalPri + $foStuTotalPri + $fifStuTotalPri
									  + $sixStuTotalPri);

				/* Primary School Summary End */
				

				/* Secondary School Summary */

				require_once ($wizGradeDir.$wizGradeSECConfig);   /* include configuration script */

				$levelArraySec = studentLevelsArray($conn); /* student level array */
				array_unshift($levelArraySec,"");
				unset($levelArraySec[0]);



				$fiStuTotalSec = studentsPerStandard($conn, $fiSessionID);  /* school active student pupolation count */

				if($fiStuTotalSec >= $foreal){  /* school active gender pupolation count */

					$fifTotalSec = studentsSexPerStandard($conn, $fiSessionID, $femaleG);
					$fimTotalSec = studentsSexPerStandard($conn, $fiSessionID, $maleG);
				}

				$seStuTotalSec = studentsPerStandard($conn, $seSessionID);  /* school active student pupolation count */

				if($seStuTotalSec >= $foreal){  /* school active gender pupolation count */

					$sefTotalSec = studentsSexPerStandard($conn, $seSessionID, $femaleG);
					$semTotalSec = studentsSexPerStandard($conn, $seSessionID, $maleG);
				}

				$thStuTotalSec = studentsPerStandard($conn, $thSessionID);  /* school active student pupolation count */

				if($thStuTotalSec >= $foreal){  /* school active gender pupolation count */

					$thfTotalSec = studentsSexPerStandard($conn, $thSessionID, $femaleG);
					$thmTotalSec = studentsSexPerStandard($conn, $thSessionID, $maleG);
				}

				$foStuTotalSec = studentsPerStandard($conn, $foSessionID);  /* school active student pupolation count */

				if($foStuTotalSec >= $foreal){  /* school active gender pupolation count */

					$fofTotalSec = studentsSexPerStandard($conn, $foSessionID, $femaleG);
					$fomTotalSec = studentsSexPerStandard($conn, $foSessionID, $maleG);
					
				}

				$fifStuTotalSec = studentsPerStandard($conn, $fifSessionID);  /* school active student pupolation count */

				if($fifStuTotalSec >= $foreal){  /* school active gender pupolation count */

					$fiffTotalSec = studentsSexPerStandard($conn, $fifSessionID, $femaleG);
					$fifmTotalSec = studentsSexPerStandard($conn, $fifSessionID, $maleG);
					
				}


				$sixStuTotalSec = studentsPerStandard($conn, $sixSessionID);  /* school active student pupolation count */

				if($sixStuTotalSec >= $foreal){  /* school active gender pupolation count */

					$sixfTotalSec = studentsSexPerStandard($conn, $sixSessionID, $femaleG);
					$sixmTotalSec = studentsSexPerStandard($conn, $sixSessionID, $maleG);
					
				}

				$activeFTotalSec = ($fifTotalSec + $sefTotalSec + $thfTotalSec + $fofTotalSec + $fiffTotalSec + $sixfTotalSec);
				$activeMTotalSec = ($fimTotalSec + $semTotalSec + $thmTotalSec + $fomTotalSec + $fifmTotalSec + $sixmTotalSec);

				$activeStuTotalSec = ($fiStuTotalSec + $seStuTotalSec + $thStuTotalSec + $foStuTotalSec + $fifStuTotalSec 
							  + $sixStuTotalSec);

				/* Secondary School Summary End */

				$schoolTotal = ($activeStuTotalNur + $activeStuTotalPri + $activeStuTotalSec);
				$schoolFTotal = ($activeFTotalNur + $activeFTotalPri + $activeFTotalSec);
				$schoolMTotal = ($activeMTotalNur + $activeMTotalPri + $activeMTotalSec); 

			}catch(PDOException $e) {
				
						wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
				 
			}
		
		}
		
		require_once ($wizGradeGlobalDir.'/widgets.php');   /* include page widget */
?>

 
			
			<?php
				
				if (($_SESSION['accessGrade'] != $staffGrade)) {
					
			?>		
			<!-- row -->
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
					  
					  			  
                  <div class="col-lg-3 col-lg-6">
                      <section class="panel value-box-cell">
                          <div class="symbol terques">
                              <i class="fa fa-users"></i>
                          </div>
                          <div class="value">

                              <h1 class="count">
                                  <?php echo $schoolTotal; ?>
                              </h1>
                              <p>Active <br /> Students</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-lg-6">
                      <section class="panel value-box-cell">
                          <div class="symbol red">
                              <i class="fa fa-female"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count2">
                                  <?php echo $schoolFTotal; ?>
                              </h1>
                              <p> Active <br /> Female </p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-lg-6">
                      <section class="panel value-box-cell">
                          <div class="symbol yellow">
                              <i class="fa fa-male"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count3">
                                  <?php echo $schoolMTotal; ?>
                              </h1>
                              <p>Active <br /> Male</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-lg-6">
                      <section class="panel value-box-cell">
                          <div class="symbol blue">
                              <i class="fa fa-user"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count4">
                                 <?php echo $totalStaffs; ?>
                              </h1>
                              <p> Active <br /> Staffs</p>
                          </div>
                      </section>
                  </div>
				  </div>
              </div>

          </div>
		  				  
              </div>
             <!-- / row -->	



        

              <!--row -->
              <div class="row value-box" style="margin:15px 10px 0px 0px">

			  <div class="col-lg-12 col-md-12">
                  <div class="panel">
                      <div class="panel-heading">
							<i class="fa fa-area-chart fa-lg"></i> <span class="hide-res">School</span> Population Summary
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
                                  <?php echo $activeStuTotalNur; ?>
                              </h1>
                              
                              <p>Nursery <br /> School</p>
                          </div>
                      </section>
                       <center><button  class="btn btn-white changeSchool hide-res" style="margin-bottom:30px;" id="log-nur">
                       <i class="fa fa-sign-in fa-lg text-info"></i> Go To Nursery School Section </button> </center>
                  </div>
                  <div class="col-lg-4 col-lg-6">
                      <section class="panel value-box-cell">
                          <div class="symbol red">
                              <i class="fa fa-users"></i>
                          </div>
                          <div class="value">
                              <h1 class="count">
                                  <?php echo $activeStuTotalPri; ?>
                              </h1>
                              <p>Primary <br />School</p>
                          </div>
                      </section>
                       <center><button  class="btn btn-white changeSchool hide-res" style="margin-bottom:30px;" id="log-pri">
                       <i class="fa fa-sign-in fa-lg text-info"></i> Go To Primary School Section </button> </center>
                  </div>
                  <div class="col-lg-4 col-lg-6">
                      <section class="panel value-box-cell">
                          <div class="symbol yellow">
                              <i class="fa fa-users"></i>
                          </div>
                          <div class="value">
                             <h1 class="count">
                                  <?php echo $activeStuTotalSec; ?>
                              </h1> 
                              <p>Secondary <br /> School</p>
                              
                          </div>

                      </section>
                      <center><button  class="btn btn-white changeSchool hide-res" style="margin-bottom:10px;" id="log-sec">
                       <i class="fa fa-sign-in fa-lg text-info"></i> Go To Secondary School Section</button> </center>
                  </div>

					<script src="<?php echo $wizGradeTemplate; ?>js/chartinator.js"></script>
                    <script>
                    window.jQuery || document.write('<script src="<?php echo $wizGradeTemplate; ?>js/jquery-charts.js"><\/script>')
                    </script>
                
                    <script src="<?php echo $wizGradeTemplate; ?>js/chart-wizgrade-config.js"></script>
                
                
                    <div class="col-lg-6 col-md-6">
                    <!-- table -->
                    <table id="barChart" class="barChart data-table col-table">
                        <caption>Student Nationalities Table</caption>
                        <tr>
                            <th scope="col" data-type="string">School</th>
                            <th scope="col" data-type="number">Number of Students</th>
                            <th scope="col" data-role="annotation">Annotation</th>
                        </tr>
                        <tr>
                            <td>Nursery</td>
                            <td align="right"><?php echo $activeStuTotalNur; ?></td>
                            <td align="right"><?php echo $activeStuTotalNur; ?></td>
                        </tr>
                
                        <tr>
                            <td>Primary</td>
                            <td align="right"><?php echo $activeStuTotalPri; ?></td>
                            <td align="right"><?php echo $activeStuTotalPri; ?></td>
                        </tr>
                
                        <tr>
                            <td>Secondary</td>
                            <td align="right"><?php echo $activeStuTotalSec; ?></td>
                            <td align="right"><?php echo $activeStuTotalSec; ?></td>
                        </tr>
                
                    </table>
					<!-- / table -->
                    </div>
                    <div class="col-lg-6 col-md-6">   
                    <!-- table -->
					<table id="pieChart" class="pieChart data-table col-table">
                        <caption>Pie Chart</caption>
                        <tr>
                            <th scope="col" data-type="string">School</th>
                            <th scope="col" data-type="number">Number of Students</th>
                        </tr>
                        <tr>
                            <td>Nursery</td>
                            <td align="right"><?php echo $activeStuTotalNur; ?></td>
                        </tr>
                
                        <tr>
                            <td>Primary</td>
                            <td align="right"><?php echo $activeStuTotalPri; ?></td>
                        </tr>
                
                        <tr>
                            <td>Secondary</td>
                            <td align="right"><?php echo $activeStuTotalSec; ?></td>
                        </tr>
                    </table>
					<!-- / table -->
                    </div>
                
					
   
				  </div>
              </div>

          </div>
		  				  
              </div>
            <!-- / row -->	
             
             


              <!-- nursery school div start -->
            
              <div class="row value-box" style="margin:15px 10px 0px 0px">

			  <div class="col-lg-12 col-md-12">
                  <div class="panel">
                      <div class="panel-heading">
                         <i class="fa fa-bar-chart fa-lg"></i> Nursery <span class="hide-res">School</span>  Summary 
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
                                  <?php echo $activeStuTotalNur; ?>
                              </h1>
                              <p>Active <br /> Students</p>
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
                                  <?php echo $activeFTotalNur; ?>
                              </h1>
                              <p> Active <br /> Female</p>
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
                                  <?php echo $activeMTotalNur; ?>
                              </h1>
                              <p>Active <br /> Male</p>
                          </div>
                      </section>
                  </div> 
								<!-- table -->
                                <table  class='table table-hover style-table'>

								<thead>
                                <tr><th><i class="fa fa-book"></i> Class</th>
                                <th><i class="fa fa-female"></i> FEMALE</th>
                                <th><i class="fa fa-male"></i> MALE</th>
                                <th><i class="fa fa-users"></i> TOTAL </th></tr>
								</thead>
                                <tbody>
                                <tr><td> <?php echo $levelArrayNur[$fiVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $fifTotalNur; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fimTotalNur; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fiStuTotalNur; ?></span></td></tr>

                                <tr><td> <?php echo $levelArrayNur[$seVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $sefTotalNur; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $semTotalNur; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $seStuTotalNur; ?></span></td></tr>
                                
                                <tr><td> <?php echo $levelArrayNur[$thVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $thfTotalNur; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $thmTotalNur; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $thStuTotalNur; ?></span></td></tr>
								</tbody>
                                
                                </table>
								<!-- / table -->
                 
				  </div>
                  
                  
                  
                  
                  
              </div>

				</div>
		  				  
              </div>
             <!-- nursery school div end -->



              <!-- primary school div start -->
            
              <div class="row value-box" style="margin:15px 10px 0px 0px">

			  <div class="col-lg-12 col-md-12">
                  <div class="panel">
                      <div class="panel-heading">
                       <i class="fa fa-line-chart fa-lg"></i> Primary <span class="hide-res">School</span>  Summary 
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
                                  <?php echo $activeStuTotalPri; ?>
                              </h1>
                              <p>Active <br /> Students</p>
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
                                  <?php echo $activeFTotalPri; ?>
                              </h1>
                              <p> Active <br /> Female</p>
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
                                  <?php echo $activeMTotalPri; ?>
                              </h1>
                              <p>Active <br /> Male</p>
                          </div>
                      </section>
                  </div>

								<!-- table -->
                                <table class='table table-hover style-table'>

								<thead>
                                <tr><th><i class="fa fa-book"></i> Class</th>
                                <th><i class="fa fa-female"></i> FEMALE</th>
                                <th><i class="fa fa-male"></i> MALE</th>
                                <th><i class="fa fa-users"></i> TOTAL </th></tr>
                                </thead>
								<tbody>
                                <tr><td> <?php echo $levelArrayPri[$fiVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $fifTotalPri; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fimTotalPri; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fiStuTotalPri; ?></span></td></tr>

                                <tr><td> <?php echo $levelArrayPri[$seVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $sefTotalPri; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $semTotalPri; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $seStuTotalPri; ?></span></td></tr>
                                
                                <tr><td> <?php echo $levelArrayPri[$thVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $thfTotalPri; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $thmTotalPri; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $thStuTotalPri; ?></span></td></tr>

                                <tr><td> <?php echo $levelArrayPri[$foVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $fofTotalPri; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fomTotalPri; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $foStuTotalPri; ?></span></td></tr>

                                <tr><td> <?php echo $levelArrayPri[$fifVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $fiffTotalPri; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fifmTotalPri; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fifStuTotalPri; ?></span></td></tr>


                                <tr><td> <?php echo $levelArrayPri[$sixVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $sixfTotalPri; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $sixmTotalPri; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $sixStuTotalPri; ?></span></td></tr>
                                </tbody>
                                </table>
								<!-- / table -->
                 
				  </div> 
                  
              </div>

          </div>
		  				  
              </div>
             <!-- primary school div end --> 

              <!-- secondary school div start -->
            
              <div class="row value-box" style="margin:15px 10px 0px 0px">

			  <div class="col-lg-12 col-md-12">
                  <div class="panel">
                      <div class="panel-heading">
                         <i class="fa fa-area-chart fa-lg"></i> Secondary <span class="hide-res">School</span>  Summary 
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
                                  <?php echo $activeStuTotalSec; ?>
                              </h1>
                              <p>Active <br /> Students</p>
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
                                  <?php echo $activeFTotalSec; ?>
                              </h1>
                              <p> Active <br /> Female </p>
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
                                  <?php echo $activeMTotalSec; ?>
                              </h1>
                              <p>Active <br /> Male </p>
                          </div>
                      </section>
                  </div>
								<!-- table -->

                                <table class='table table-hover style-table'>

								<thead>
                                <tr><th><i class="fa fa-book"></i> Class</th>
                                <th><i class="fa fa-female"></i> FEMALE</th>
                                <th><i class="fa fa-male"></i> MALE</th>
                                <th><i class="fa fa-users"></i> TOTAL </th></tr>
                                </thead>
								<tbody>
                                <tr><td> <?php echo $levelArraySec[$fiVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $fifTotalSec; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fimTotalSec; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fiStuTotalSec; ?></span></td></tr>

                                <tr><td> <?php echo $levelArraySec[$seVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $sefTotalSec; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $semTotalSec; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $seStuTotalSec; ?></span></td></tr>
                                
                                <tr><td> <?php echo $levelArraySec[$thVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $thfTotalSec; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $thmTotalSec; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $thStuTotalSec; ?></span></td></tr>

                                <tr><td> <?php echo $levelArraySec[$foVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $fofTotalSec; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fomTotalSec; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $foStuTotalSec; ?></span></td></tr>

                                <tr><td> <?php echo $levelArraySec[$fifVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $fiffTotalSec; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fifmTotalSec; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $fifStuTotalSec; ?></span></td></tr>


                                <tr><td> <?php echo $levelArraySec[$sixVal]['level'];?> </td>
                                <td><span class="badge bg-important"><?php echo $sixfTotalSec; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $sixmTotalSec; ?></span></td>
                                <td><span class="badge bg-important"><?php echo $sixStuTotalSec; ?></span></td></tr>
                                </tbody>
                                </table>
								
								<!-- / table -->
                 
				  </div>
                  
                  
                  
                  
                  
              </div>

          </div>
		  				  
              </div>
             <!-- secondary school div end -->

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
			 
			<?php } ?>
			  
			<!-- school annoucement start -->	
			<div class="row" style="margin:15px 10px 0px 0px">
					<div class="col-lg-12">
                      <section class="panel">
                        <header class="panel-heading">
                             <i class="fa fa-bullhorn fa-lg"></i> School Annoucements  
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
				
												if (($_SESSION['accessGrade'] != $staffGrade)) {  /* check admin status */					
			
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
													<!-- <li class="divider"></li>
													<li>
													<a href='javascript:;' id='wizGrade-$bID-$expenseCategory' class ='removeBroadcast'> 
													<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button> Remove</a>			
													</li>  -->
											</ul>		
									</div><!-- /btn-group --> 
								
								</td>
								</tr>
		
IGWEZE;
                               
												}else{
			
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
                               
													
													
													
												}	
											
												echo $broadcastData;
											} 
								
								
										}else{  /* display error */ 
										
												$msg_i = "Ooooooops, there is no school annoucement to show at the momment"; 
												echo $infMsg.$msg_i.$msgEnd;
										
										}	


?>
                        
                        
									</tbody></table><!-- / table -->
											
											<!-- school annoucement end -->  
							
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
						  <div class="modal-footer slideUpFrmDiv" style="z-index:-1">	
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
	
                <script type='text/javascript' src='<?php echo $wizGradeTemplate; ?>js/css-clocks.js'></script> 
 
				<script type="text/javascript">
						/* Jquery school event calendar script */
					<?php if (($_SESSION['accessGrade'] == $staffGrade)) { /* check admin status */ ?>
				
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
		
				
				<?php 	}else{ ?>			
				
						 
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
										
										"SAVE EVENT": function() {  /* save calendar */  
											var eMsg = $('#eComment').get(0).value;
											$('#msgBox').load('eventManager.php', {eventMsg: eMsg, start: start, end: end, 
											allDay: allDay, eventData: saveEvent });
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

										CLOSE: function() {  /* close dailog */
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
										
										UPDATE: function() {  /* update calendar */ 
											var eventMsg = $('#eventComment').get(0).value;
											$('#msgBox').load('eventManager.php', {eventID: id, eventData: updateEvent, 
											eventMsg: eventMsg});
											$('#calendarH').fullCalendar('refetchEvents');
											$("#dialog").dialog( "close" );
										},

										DELETE: function() {  /* delete calendar */ 
											$('#msgBox').load('eventManager.php', {eventID: id, eventData: deleteEvent});
											$('#calendarH').fullCalendar('refetchEvents');
											$("#dialog").dialog( "close" );
										},

										CLOSE: function() {  /* close dailog */ 
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

					
			<?php	} ?>
					

				</script>