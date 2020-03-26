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
	This script load wizGrade theme
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

if(!session_id()){
    session_start();
}

     define('wizGrade', 'igweze');  /* define a check for wrong access of file */

         require 'configINwizGrade.php';  /* load wizGrade configuration files */	   
		
?>		

				<!-- row -->	
				<div class="row">
					
                    <div class="col-sm-9">
						<section class="panel">
							<header class="panel-heading">                              
								<i class="fa fa-wrench fa-lg"></i> Select <span class="hide-res">Your Prefered Display</span> Theme
								<span class="tools pull-right">
									<a href="javascript:;" class="fa fa-chevron-down"></a>
									<a href="javascript:;" class="fa fa-times"></a>
								</span>
							</header>
							<div class="panel-body wizGrade-line">
							<div id="msgBoxTheme"> </div>

							<div class="panel-body">
								<button type="button" id="color#473C8B" class="btn btn-theme btn-theme-1">Select Theme</button><!-- theme button #01c0c8 -->
								<button type="button" id="color#00868B" class="btn btn-theme btn-theme-2">Select Theme</button><!-- theme button -->	
								<button type="button" id="color#006746" class="btn btn-theme btn-theme-3">Select Theme</button><!-- theme button -->
								<button type="button" id="color#27408B" class="btn btn-theme btn-theme-4">Select Theme</button><!-- theme button -->
								<button type="button" id="color#8B1C62" class="btn btn-theme btn-theme-5">Select Theme</button><!-- theme button -->
								<button type="button" id="color#1E1E1E" class="btn btn-theme btn-theme-6">Select Theme</button><!-- theme button -->
								<button type="button" id="color#4B0082" class="btn btn-theme btn-theme-7">Select Theme</button><!-- theme button -->
								<button type="button" id="color#330033" class="btn btn-theme btn-theme-8">Select Theme</button><!-- theme button -->
								<button type="button" id="color#033" class="btn btn-theme btn-theme-9">Select Theme</button><!-- theme button -->
								<button type="button" id="color#06c" class="btn btn-theme btn-theme-10">Select Theme</button><!-- theme button -->  
							  
							</div> 
                                      
							</div>
						</section>
					</div>
				</div>
				<!-- row -->	              
              