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
	This script handle school class
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	   
		 		 
		 
		 try { 

  				$levelArray = studentLevelsArray($conn); /* student level array */
				$clArray_fi = studentClassArray($conn, $fiVal); /* retrieve student class array */
				$clArray_se = studentClassArray($conn, $seVal); /* retrieve student class array */
				$clArray_th = studentClassArray($conn, $thVal); /* retrieve student class array */
				$clArray_fo = studentClassArray($conn, $foVal); /* retrieve student class array */
				$clArray_fif = studentClassArray($conn, $fifVal); /* retrieve student class array */
				$clArray_six = studentClassArray($conn, $sixVal); /* retrieve student class array */
				$classArray_fi = unserialize($clArray_fi);
				$classArray_se = unserialize($clArray_se);
				$classArray_th = unserialize($clArray_th);
				$classArray_fo = unserialize($clArray_fo);
				$classArray_fif = unserialize($clArray_fif);
				$classArray_six = unserialize($clArray_six);
				
								
		 }catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		 }
		
		
		
?>		
					
				<!-- row -->	
				<div class="row"> 
                   <div class="col-sm-12">
                      <section class="panel">
                          <header class="panel-heading">                              
							  <i class="fa fa-wrench fa-lg"></i> <span class="hide-res">School</span> Class Naming
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
                          </header>
                          <div class="panel-body wizGrade-line">
                          <center><img src="loading.gif" alt="Loading >>>>>" class="configLoading" 
									  style="cursor:pointer; display:none; margin-bottom:5px;" /> </center><!-- loading image-->
                          <div class="msgBoxSettings"></div>
						  
                          <!-- form -->
						  
						  <form class="form-horizontal" id="frmclassSettings" role="form">

                          <?php 
						  if($schoolExt == $wizGradeNurAbr){ /* check school type */
						  ?> 	  
                          

									  <div class="form-group">
                                          <label for="level_1" class="col-lg-12 control-label">
										  <?php echo $levelArray[0]['level']; ?> Classes</label>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[0]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[1]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[2]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[3]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[4]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[5]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>
                                          
                                          <div class="form-group">
                                          
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[6]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[7]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[8]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[9]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[10]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[11]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>
                                          
                                                                       
									  <div class="form-group">
                                          <label for="level_1" class="col-lg-12 control-label">
										  <?php echo $levelArray[1]['level']; ?> Classes</label>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[0]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[1]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[2]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[3]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[4]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[5]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>
                                          
                                          <div class="form-group">
                                          
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[6]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[7]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[8]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[9]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[10]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[11]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>


									  <div class="form-group">
                                          <label for="level_1" class="col-lg-12 control-label">
										  <?php echo $levelArray[2]['level']; ?> Classes</label>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[0]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[1]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[2]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[3]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[4]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[5]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>
                                          
                                          <div class="form-group">
                                          
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[6]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[7]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[8]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[9]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[10]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[11]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>
										  <input type="hidden" name="schoolSettings" value="classSettingsNur" />		
                          
                          <?php 
							}else{
						  ?> 	  
									  <div class="form-group">
                                          <label for="level_1" class="col-lg-12 control-label">
										  <?php echo $levelArray[0]['level']; ?> Classes</label>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[0]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[1]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[2]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[3]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[4]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[5]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>
                                          
                                          <div class="form-group">
                                          
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[6]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[7]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[8]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[9]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[10]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_1[]" 
                                              value ="<?php echo $classArray_fi[11]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>
                                          
                                                                       
									  <div class="form-group">
                                          <label for="level_1" class="col-lg-12 control-label">
										  <?php echo $levelArray[1]['level']; ?> Classes</label>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[0]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[1]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[2]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[3]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[4]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[5]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>
                                          
                                          <div class="form-group">
                                          
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[6]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[7]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[8]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[9]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[10]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_2[]" 
                                              value ="<?php echo $classArray_se[11]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>


									  <div class="form-group">
                                          <label for="level_1" class="col-lg-12 control-label">
										  <?php echo $levelArray[2]['level']; ?> Classes</label>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[0]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[1]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[2]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[3]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[4]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[5]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>
                                          
                                          <div class="form-group">
                                          
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[6]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[7]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[8]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[9]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[10]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_3[]" 
                                              value ="<?php echo $classArray_th[11]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>


									  <div class="form-group">
                                          <label for="level_1" class="col-lg-12 control-label">
										  <?php echo $levelArray[3]['level']; ?> Classes</label>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_4[]" 
                                              value ="<?php echo $classArray_fo[0]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_4[]"
                                               value ="<?php echo $classArray_fo[1]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_4[]" 
                                              value ="<?php echo $classArray_fo[2]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_4[]" 
                                              value ="<?php echo $classArray_fo[3]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_4[]" 
                                              value ="<?php echo $classArray_fo[4]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_4[]" 
                                              value ="<?php echo $classArray_fo[5]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>
                                          
                                          <div class="form-group">
                                          
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_4[]" 
                                              value ="<?php echo $classArray_fo[6]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_4[]" 
                                              value ="<?php echo $classArray_fo[7]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_4[]" 
                                              value ="<?php echo $classArray_fo[8]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_4[]" 
                                              value ="<?php echo $classArray_fo[9]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_4[]" 
                                              value ="<?php echo $classArray_fo[10]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_4[]" 
                                              value ="<?php echo $classArray_fo[11]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>
                                      

									  <div class="form-group">
                                          <label for="level_1" class="col-lg-12 control-label">
										  <?php echo $levelArray[4]['level']; ?> Classes</label>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_5[]" 
                                              value ="<?php echo $classArray_fif[0]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_5[]" 
                                              value ="<?php echo $classArray_fif[1]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_5[]" 
                                              value ="<?php echo $classArray_fif[2]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_5[]" 
                                              value ="<?php echo $classArray_fif[3]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_5[]" 
                                              value ="<?php echo $classArray_fif[4]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_5[]" 
                                              value ="<?php echo $classArray_fif[5]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>
                                          
                                          <div class="form-group">
                                          
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_5[]" 
                                              value ="<?php echo $classArray_fif[6]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_5[]" 
                                              value ="<?php echo $classArray_fif[7]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_5[]" 
                                              value ="<?php echo $classArray_fif[8]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_5[]" 
                                              value ="<?php echo $classArray_fif[9]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_5[]" 
                                              value ="<?php echo $classArray_fif[10]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_5[]" 
                                              value ="<?php echo $classArray_fif[11]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>

									  <div class="form-group">
                                          <label for="level_1" class="col-lg-12 control-label">
										  <?php echo $levelArray[5]['level']; ?> Classes</label>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_6[]" 
                                              value ="<?php echo $classArray_six[0]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_6[]" 
                                              value ="<?php echo $classArray_six[1]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_6[]" 
                                              value ="<?php echo $classArray_six[2]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_6[]" 
                                              value ="<?php echo $classArray_six[3]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_6[]" 
                                              value ="<?php echo $classArray_six[4]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_6[]" 
                                              value ="<?php echo $classArray_six[5]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>
                                          
                                          <div class="form-group">
                                          
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_6[]" 
                                              value ="<?php echo $classArray_six[6]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_6[]" 
                                              value ="<?php echo $classArray_six[7]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_6[]" 
                                              value ="<?php echo $classArray_six[8]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_6[]" 
                                              value ="<?php echo $classArray_six[9]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_6[]" 
                                              value ="<?php echo $classArray_six[10]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                           <div class="col-lg-2">
                                          <div class="iconic-input">
                                              <i class="fa fa-book"></i>
                                              <input type="text"  name="class_6[]" 
                                              value ="<?php echo $classArray_six[11]; ?>"
                                              class="form-control" placeholder="A, B, Mark" >
                                          </div>
                                          </div>
                                          </div>
                                          <input type="hidden" name="schoolSettings" value="classSettings" />


                          <?php 
						  	}
						  ?> 	  

									 
                                    <div class="form-group">
                                          <center><button type="submit" class="btn btn-danger buttonMargin demoDisenable" 
                                          id="classSettings">
                                          <i class="fa fa-save"></i> Save </button></center>
                                          
									</div>
                                      
                        </form>
						<!-- / form -->	 
                                      
                          </div>
                      </section>
                  </div>
			</div>
			<!-- / row -->			
                  
              