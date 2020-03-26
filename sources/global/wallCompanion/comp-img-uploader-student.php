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
	This script handle companion picture uploads
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 

			require ($wizGradevalidater);	

			if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){

				$picturePath = $forumPicExtTem; /* picture path */
				
				$filePic = "photoimg"; /* picture file name */
				$pageDesc = "your picture";
				
				/* call igweze file uploader */
				$uploadPicData = igwezeFileUploader($filePic, $picturePath, ($oneMB * 2), $validPicExt, $validPicType, $allowedPicExt, $fileType = "Picture", $fiVal); 				
				 
				if (is_array($uploadPicData['error'])) {  /* check if any upload error */
					 
					$msg_e = '';
					  
					foreach ($uploadPicData['error'] as $msg) {
						$msg_e .= $msg.'<br />';     /* display error messages */
					}
					echo "<img src=''   height = '1' width='1'> ";
					echo $errorMsg.$msg_e.$eEnd; exit;
				  
				  
				} else {
					
					$uploadedPic = $uploadPicData['refilename']; /* uploaded picture file */
					
					if ($uploadedPic != "") {
							
						if (move_uploaded_file($_FILES[$filePic]['tmp_name'], $picturePath.$uploadedPic )) { /* move uploaded file to its path */
								
								
							try { 

								$uploadedPicID = str_replace(".","foreal",$uploadedPic);
				
								$memberInfo = companionWallUserDetails($conn, $_SESSION['studetReg'], $seVal);  /* retrieve student companion details */
								
								list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic) = explode ("##", $memberInfo);
								
								insertTempUpload($conn, $uploadedPic, $member_id);  /* insert upload */
								
								$delPic = $wizGradeTemplate.'images/icon_del.gif'; 
								//echo "<img src=''   height = '1' width='1'> ";
								echo'<div style="padding: 10px;" Class = "picture-upload-div col-lg-3" 
								id = "picture-upload-div_'.$uploadedPicID.'">';
								echo '<span class = "uploadPic_DelBtn" style="position: relative;
								top: -3px;left:0px; 
								float:right; cursor:pointer;" 
								id= "DelPic-'.$uploadedPicID.'"><i class="fa  fa-times"></i>
								</span>';
								echo '<img src='.$forumPicExtTem.$uploadedPic.' Class = "preview" />';
								echo '</div>';	 


							}catch(PDOException $e) {

									wizGradeDie( 'Ooops Database Error: ' . $e->getMessage());

							}
							  
							  
						}else{ /* display error messages */
								
								echo "<img src=''   height = '1' width='1'> ";
								$msg_e = "Ooooooooooops, an error has occur while trying to save $pageDesc.
								Please try again or check your network connection!!!";
								echo $errorMsg.$msg_e.$eEnd; exit;

							  
						}
							
					}else{ /* display error messages */
						
							echo "<img src=''   height = '1' width='1'> ";
							$msg_e = "Ooooooooooops, an error has occur while trying to save $pageDesc.
							Please try again or check your network connection!!!";
							echo $errorMsg.$msg_e.$eEnd; exit;							

					}	
					
					
				} 				
		
			}else{
			
				exit;	
				
			}exit;	
?>