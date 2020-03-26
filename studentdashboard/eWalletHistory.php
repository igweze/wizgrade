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
	This script handle e-wallet history
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

        require 'configwizGrade.php';  /* load wizGrade configuration files */	 

 		if ($_REQUEST['eWalletData'] == 'eHistory' ) {
			
			/* script validation */
			
            if (($_REQUEST['level'] != '')  || ($_REQUEST['term'] != '')){

        		$level = $_REQUEST['level'];
				$term =   preg_replace("/[^0-9]/", "", $_REQUEST['term']); 
				
				$school_term = schoolTerm($term);  /* school term  */   

				try { 
					
					$studentName = studentName($conn, $regNum);  /* students name information  */  

					$cardCheckData = eWalletCheckRecharge($conn, $regNum, $regID, $level, $term, $ewalletCheck);  /* validate card pin e - wallet information */
						
					list ($cardCID, $cardPin, $cardRTime, $cardCS) = explode (":@@:", $cardCheckData);
					$cardRTime = date("h:i:s, d F, Y", $cardRTime);	 
					
					
					$levelArray = studentLevelsArray($conn); /* student level array */
					$trimLevel = ($level - $fiVal);
					$studentLevel = $levelArray[$trimLevel]['level'];
					
					 
?>
 
					<!-- row -->
					<div class="row profile">
						<div class="col-md-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <i class="fa fa-money fa-lg"></i> Student E-Wallet Information 
                          </header>
                          <div class="panel-body wizGrade-line">
						  
						<div class="col-md-3 wizGrade-line">
						<div class="profile-sidebar ">
							<!-- sidebar user picture -->
							<div class="profile-userpic">
								<img src="<?php echo $studentPicture; ?>" height="120px" width="120px" class="img-responsive"  alt="">
							</div>
							<!-- sidebar user picture end  -->
							<!-- sidebar user title start  -->
							<div class="profile-usertitle">
								<div class="profile-usertitle-name">
									<?php echo $studentName; ?>
								</div>
								<div class="profile-usertitle-job">
									Profile Details
								</div>
							</div>
							<!-- sidebar user title end  -->
							 
							<!-- sidebar profile menu start  -->
							<div class="profile-usermenu">
								<ul class="nav">
									<li class="active wizGradeMenu">
										<a href="javascript:;" id="myProfile">
										<i class="glyphicon glyphicon-home"></i>
										Overview </a>
									</li>
									<li>
										<a href="javascript:;" id="<?php echo $regNum; ?>" class ='editBioData'>
										<i class="glyphicon glyphicon-user"></i>
										Edit Profile </a>
									</li>
									<!--<li>
										<a href="javascript:;" target="_blank">
										<i class="glyphicon glyphicon-ok"></i>
										Tasks </a>
									</li>-->
									 
								</ul>
							</div>
							<!-- sidebar profile menu end  -->
						</div>
					</div>
					<div class="col-md-9" id="scrollTargetMPage">
						<div class="profile-content wizGrade-line" id="wizGradeRightHalf">
        
<?php


        
$walletMsgSuc =<<<IGWEZE
		
                
								<div class="profile-content-heading">
										<img src = "$studentPicture" height = '100' width = '100' id='wizGradeStudentPic' class='img-circle'>   
										$studentName    ($regNum)
								</div>
								<!-- table -->
								<table width="100%" class="table table-striped">
								  <tr>
								    <th width="30%" style ="padding-left: 10% !important; text-align:left;">Student Class</th>
								    <td width="70%" style ="padding-left: 10% !important; text-align:left;">$studentLevel</td>
								  </tr>
								  <tr>
								    <th width="30%" style ="padding-left: 10% !important; text-align:left;">School Term</th>
								    <td width="70%" style ="padding-left: 10% !important; text-align:left;">$school_term</td>
								  </tr>
								  <tr>
								    <th width="30%" style ="padding-left: 10% !important; text-align:left;">E-Wallet Pin</th>
								    <td width="70%" style ="padding-left: 10% !important; text-align:left;">$cardPin</td>
								  </tr>
								  
								  <tr>
								    <th width="30%" style ="padding-left: 10% !important; text-align:left;">Date Recharged</th>
								    <td width="70%" style ="padding-left: 10% !important; text-align:left;">$cardRTime</td>
								  </tr>
								</table>
								<!-- / table -->

                              
		
IGWEZE;

				$msg_err = "* Oooooops <span style = 'font-weight:bold;text-transform: capitalize; color:#000;'>
				$stuFullName</span>, you have not recharge for <strong'> $studentLevel $school_term 
				</strong>. Thanks";
				
				

$walletMsgErr =<<<IGWEZE
		
                 
							  
							  
								<div class="profile-content-heading">
										<img src = "$studentPicture" height = '100' width = '100' id='wizGradeStudentPic' class='img-circle'>   
										$studentName  ($regNum)
								</div>
								<!-- table -->
								<table width="100%" class="table table-striped">
								  <tr>
								    
								    <th width="100%" style ="text-align:left;">
									$erroMsg $msg_err $msgEnd</th>
								  </tr>
								  
								</table>
								<!-- / table -->

                             
		
IGWEZE;

					if($cardCheckData != ''){  /* check if e-wallet data is empty */
					
						echo $walletMsgSuc;
						
					}else{
						
						echo $walletMsgErr;
					}
				

?>
			
				</div>
					</div>
				</div>
			 
			</div>
                 </section>
					</div>
              <!-- row -->
      

<?php


					echo "<script type='text/javascript'> hidePageLoader();  /* hide page loader */	</script>"; 

				}catch(PDOException $e) {
  			
					wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());
			 
				}
			
			}else {
					
        			$msg_e =  $formErrorMsg;
 
        	}	 

        }else{
			
			echo $userNavPageError; exit;  /* else exit or redirect to 404 page */
			
		} 
			
			
		if ($msg_s) {

			echo $succMsg.$msg_s.$msgEnd; echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ </script>";  echo $scrollUp; exit;	
								
		}	 

		if ($msg_e) {

			echo $erroMsg.$msg_e.$msgEnd; echo "<script type='text/javascript'>  hidePageLoader();  /* hide page loader */ </script>";  echo $scrollUp; exit; 	 				 	
								
		}	 
			
exit;	 
?>