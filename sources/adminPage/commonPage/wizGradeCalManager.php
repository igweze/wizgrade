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
	This page calculate student class and subject position ranking
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */ 


		if (!defined('wizGrade')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */
	 
	 	require 'configwizGrade.php';  /* load wizGrade configuration files */
		 
			$conLI = mysqli_connect($server, $username, $password, $wizGradeDB); /* database parameters */
 
			if (mysqli_connect_errno()){ /* validating database connection */
			  
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  
				$msg_e ='Ooooops, a critical has occur. Please contact the devloper immediately and report as error C404';
				
				echo $errorMsg.$msg_e.$eEnd;  exit; 
			  
			}

			 

		    for($i = $start_nkiru; $i <= $stop_njideka; $i++){ /* loop through student subject scores */
		   
				$score = $course_info_mark[$i][3];
				$posi = $course_info_mark[$i][4];
				
				/* select and rank subject position  */
				$ebele = "SELECT f.ireg_id, f.$score, a.ireg_id, a.$nk_class, 
           
		   				FIND_IN_SET(
            
			    					f.$score,
            
			   		    (SELECT  GROUP_CONCAT(
                            		DISTINCT f.$score
                            		ORDER BY f.$score  DESC
                        )
                		
						FROM    $sdoracle_sub_score_nk f, $i_reg_tb a  
		  
		  					WHERE f.ireg_id = a.ireg_id
		  
		  					AND a.$nk_class = '$class' 
		  
		  					AND  a.session_id = $sessionID)
		  
            				) as rank
          					
						FROM   $sdoracle_sub_score_nk f, $i_reg_tb a  
		  
		  					WHERE f.ireg_id = a.ireg_id
		  
		  					AND a.$nk_class = '$class' 
		  
		  					AND  a.session_id = $sessionID";
	 
	 
				$igweze_mark = mysqli_query($conLI, $ebele);
				

          		while ($row = mysqli_fetch_array($igweze_mark, MYSQLI_ASSOC)) {		
					
					$ireg_m = $row[ireg_id]; 
					$c = $row[$score]; 
					$position = $row[rank]; 
					$d = $row[$nk_class]; 
		
						/* update subject position  */ 
						$ebele_update = "UPDATE $sdoracle_grade_nk SET 
		 
								   $posi = $position
								  
								   
								   WHERE ireg_id = $ireg_m ";


						 $igweze_mark_update = mysqli_query($conLI, $ebele_update);
				}

			} 

			$score_2 = ''; $posi_2 = '';

			$score_2 = $i_grade_grand[$i_ggr];
			$posi_2 = $i_grade_grand[$i_gpo];
				
			/* select and rank class position  */
			$ebele_2 = "SELECT f.ireg_id, f.$score_2, a.ireg_id, a.$nk_class,
           
		   				FIND_IN_SET(
            
			    					f.$score_2,
            
			   		    (SELECT  GROUP_CONCAT(
                            		DISTINCT f.$score_2
                            		ORDER BY f.$score_2  DESC
                        )
                		
						FROM    $sdoracle_grand_score_nk f, $i_reg_tb a  
		  
		  					WHERE f.ireg_id = a.ireg_id
		  
		  					AND a.$nk_class = '$class' 
		  
		  					AND  a.session_id = $sessionID)
		  
            				) as rank
          					
						FROM   $sdoracle_grand_score_nk f, $i_reg_tb a  
		  
		  					WHERE f.ireg_id = a.ireg_id
		  
		  					AND a.$nk_class = '$class' 
		  
		  					AND  a.session_id = $sessionID";
	 
	 
			$igweze_mark_2 = mysqli_query($conLI, $ebele_2) or die(mysqli_error()); 
				
			while ($row_2 = mysqli_fetch_array($igweze_mark_2, MYSQLI_ASSOC)) { 
				
				$ireg_m_2 = $row_2[ireg_id]; 
				$c = $row_2[$score_2]; 
				$position_2 = $row_2[rank]; 
   		        $d = $row_2[$nk_class]; 
				
					/* update class position  */ 		
	
					$ebele_update_2 = "UPDATE $sdoracle_grand_score_nk SET 
     
                               $posi_2 = $position_2
                              
                               
                               WHERE ireg_id = $ireg_m_2 ";


		             $igweze_mark_update_2 = mysqli_query($conLI, $ebele_update_2);
			}



			if($cal_session == true){ /* if calculate annual is true  */
				 
				$score_3 = ''; $posi_3 = '';
				$score_3 = $i_grade_grand[$ji_ggr];
				$posi_3 = $i_grade_grand[$ji_gpo];
				
				updateClassAnnualRS($conn, $sdoracle_grand_score_nk, $sessionID, $nk_class, $class, $fiGrandAvg, $seGrandAvg, $thGrandAvg, $grandAvg);
				
				/* select and rank class annual position  */
				
				$ebele_3 = "SELECT f.ireg_id, f.$score_3, a.ireg_id, a.$nk_class,
			   
							FIND_IN_SET(
				
										f.$score_3,
				
							(SELECT  GROUP_CONCAT(
										DISTINCT f.$score_3
										ORDER BY f.$score_3  DESC
							)
							
							FROM    $sdoracle_grand_score_nk f, $i_reg_tb a  
			  
								WHERE f.ireg_id = a.ireg_id
			  
								AND a.$nk_class = '$class' 
			  
								AND  a.session_id = $sessionID)
			  
								) as rank
								
							FROM   $sdoracle_grand_score_nk f, $i_reg_tb a  
			  
								WHERE f.ireg_id = a.ireg_id
			  
								AND a.$nk_class = '$class' 
			  
								AND  a.session_id = $sessionID";
		 
		 
				$igweze_mark_3 = mysqli_query($conLI, $ebele_3) or die(mysqli_error());
			 
					while ($row_3 = mysqli_fetch_array($igweze_mark_3, MYSQLI_ASSOC)) {
						 
						$ireg_m_3 = $row_3[ireg_id]; 
						$c = $row_3[$score_3]; 
						$position_3 = $row_3[rank]; 
						$d = $row_3[$nk_class]; 
			
							/* update class annual position  */	
							$ebele_update_3 = "UPDATE $sdoracle_grand_score_nk SET 
			 
									   $posi_3 = $position_3
									  
									   
									   WHERE ireg_id = $ireg_m_3 ";


							$igweze_mark_update_3 = mysqli_query($conLI, $ebele_update_3);
					}


			}
?>

<?php
/*
if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */
	 
	 	require 'configwizGrade.php';  /* load wizGrade configuration files * /
		
			$class = strip_tags($class);
			
		    for($i = $start_nkiru; $i <= $stop_njideka; $i++){
		   
				$score = $course_info_mark[$i][3];
				$posi = $course_info_mark[$i][4];
				
					$ebele_mark = "SELECT f.ireg_id, f.$score, a.ireg_id, a.$nk_class,
			   
							FIND_IN_SET(
				
										f.$score,
				
							(SELECT  GROUP_CONCAT(
										DISTINCT f.$score
										ORDER BY f.$score  DESC
							)
							
							FROM    $sdoracle_sub_score_nk f, $i_reg_tb a  
			  
								WHERE f.ireg_id = a.ireg_id
			  
								AND a.$nk_class = :sClass
			  
								AND  a.session_id = $sessionID
								
								AND  a.active = $fiVal)
			  
								) as rank
								
							FROM   $sdoracle_sub_score_nk f, $i_reg_tb a  
			  
								WHERE f.ireg_id = a.ireg_id
			  
								AND a.$nk_class = :sClass
			  
								AND  a.session_id = $sessionID
								
								AND  a.active = $fiVal";
		 
					$igweze_prep = $conn->prepare($ebele_mark);
					$igweze_prep->bindValue(':sClass', $class);
					$igweze_prep->execute();
					
					while($row = $igweze_prep->fetch(PDO::FETCH_ASSOC)) {	
					
			
						$ireg_m = $row[ireg_id]; 
						$c = $row[$score]; 
						$position = $row[rank]; 
						$d = $row[$nk_class]; 			
			
						$ebele_mark_1 = "UPDATE $sdoracle_grade_nk 
						
										SET 
		 
										$posi = :position
								  
								   
										WHERE ireg_id = :ireg_id";
								   
						$igweze_prep_1 = $conn->prepare($ebele_mark_1);	
						$igweze_prep_1->bindValue(':position', $position);
						$igweze_prep_1->bindValue(':ireg_id', $ireg_m);
						$igweze_prep_1->execute();		   

					}

			}



				$score_2 = ''; $posi_2 = '';

				$score_2 = $i_grade_grand[$i_ggr];
				$posi_2 = $i_grade_grand[$i_gpo];
				
			
				$ebele_mark_2 = "SELECT f.ireg_id, f.$score_2, a.ireg_id, a.$nk_class,
			   
							FIND_IN_SET(
				
										f.$score_2,
				
							(SELECT  GROUP_CONCAT(
										DISTINCT f.$score_2
										ORDER BY f.$score_2  DESC
							)
							
							FROM    $sdoracle_grand_score_nk f, $i_reg_tb a  
			  
								WHERE f.ireg_id = a.ireg_id
			  
								AND a.$nk_class = :sClass
			  
								AND  a.session_id = $sessionID
								
								AND  a.active = $fiVal)
			  
								) as rank
								
							FROM   $sdoracle_grand_score_nk f, $i_reg_tb a  
			  
								WHERE f.ireg_id = a.ireg_id
			  
								AND a.$nk_class = :sClass 
			  
								AND  a.session_id = $sessionID
								
								AND  a.active = $fiVal";
								
				$igweze_prep_2 = $conn->prepare($ebele_mark_2);
				$igweze_prep_2->bindValue(':sClass', $class);
				$igweze_prep_2->execute();
					
				while($row_2 = $igweze_prep_2->fetch(PDO::FETCH_ASSOC)) {					
		 
					  
					$ireg_m_2 = $row_2[ireg_id]; 
					$c = $row_2[$score_2]; 
					$position_2 = $row_2[rank]; 
					$d = $row_2[$nk_class]; 			
						 
						$ebele_mark_3 = "UPDATE $sdoracle_grand_score_nk 
						
										SET 
		 
										$posi_2 = :position
								  
								   
										WHERE ireg_id = :ireg_id";
								   
						$igweze_prep_3 = $conn->prepare($ebele_mark_3);	
						$igweze_prep_3->bindValue(':position', $position_2);
						$igweze_prep_3->bindValue(':ireg_id', $ireg_m_2);
						$igweze_prep_3->execute();		 
				}



			if($cal_session == true){
			 
					$score_3 = ''; $posi_3 = '';
					$score_3 = $i_grade_grand[$ji_ggr];
					$posi_3 = $i_grade_grand[$ji_gpo];
					
					updateClassAnnualRS($conn, $sdoracle_grand_score_nk, $sessionID, $nk_class, $class, $fiGrandAvg, $seGrandAvg, $thGrandAvg, $grandAvg);
					
					$ebele_mark_4 = "SELECT f.ireg_id, f.$score_3, a.ireg_id, a.$nk_class,
				   
								FIND_IN_SET(
					
											f.$score_3,
					
								(SELECT  GROUP_CONCAT(
											DISTINCT f.$score_3
											ORDER BY f.$score_3  DESC
								)
								
								FROM    $sdoracle_grand_score_nk f, $i_reg_tb a  
				  
									WHERE f.ireg_id = a.ireg_id
				  
									AND a.$nk_class = :sClass
				  
									AND  a.session_id = $sessionID
									
									AND  a.active = $fiVal)
				  
									) as rank
									
								FROM   $sdoracle_grand_score_nk f, $i_reg_tb a  
				  
									WHERE f.ireg_id = a.ireg_id
				  
									AND a.$nk_class = :sClass
				  
									AND  a.session_id = $sessionID
									
									AND  a.active = $fiVal";
									
					$igweze_prep_4 = $conn->prepare($ebele_mark_4);
					$igweze_prep_4->bindValue(':sClass', $class);
					$igweze_prep_4->execute();
							
						while($row_4 = $igweze_prep_4->fetch(PDO::FETCH_ASSOC)) {	
				  
							$ireg_m_4 = $row_4[ireg_id]; 
							$c = $row_4[$score_3]; 
							$position_4 = $row_4[rank]; 
							$d = $row_4[$nk_class]; 
				
			
							$ebele_mark_5 = "UPDATE $sdoracle_grand_score_nk 
								
												SET 
				 
												$posi_2 = :position
										  
										   
												WHERE ireg_id = :ireg_id";
										   
							$igweze_prep_5 = $conn->prepare($ebele_mark_5);	
							$igweze_prep_5->bindValue(':position', $position_3);
							$igweze_prep_5->bindValue(':ireg_id', $ireg_m_3);
							$igweze_prep_5->execute();		 
						}


			}
*/
?>