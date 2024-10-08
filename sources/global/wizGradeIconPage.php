<?php

/*   
	Copyright (C) fobrain Tech LTD (2014 - 2024) - All Rights Reserved
	
	Licensed under the Apache License, Version 2.0 (the 'License');
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an 'AS IS' BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License	
	 
	#####################################################################################################
	fobrain (wizgrade open source) app is designed & developed by Igweze Ebele Mark for fobrain Tech LTD
	#####################################################################################################

	fobrain is Dedicated To Almighty God, My fabulous FAMILY and Amazing Parents.  
	
	WEBSITE 							PHONES/WHATSAPP					EMAILS
	https://www.fobrain.com				+234 - 80 30 716 751  			opensource@fobrain.com
										+234 - 80 22 000 490 	
	
	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Page/Code Explanation~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	This script load common page middle menu bar
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

?>

	<!-- row -->
	<div class="row wizgrade-page-icons display-none">
		<div class="col-lg-10">
		 
			<section>
				<div class="panel-body">
				
					<ul class="ft-link">
													
					<button  class="btn btn-white slide-page">
					<i class="fa fa-arrow-circle-left fa-lg text-info"></i> Go Back </button>

					<button  class="btn btn-white printer-icon display-none" id="btnPrint">
					<i class="fa fa-print fa-lg text-info"></i> Print </button>

					<button  class="btn btn-white display-none excelExIcon" 
					onClick ="$('#wizGradeTBPage').tableExport({type:'excel',escape:'false'});">
					<i class="fa fa-cloud-download  fa-lg text-info"></i> Excel Export</button>

					<button  class="btn btn-white rsConIcon show-rsconfig-div display-none">
					<i class="fa fa-check-square-o fa-lg text-info"></i> Compute &amp; Publish Result </button>

					<button  class="btn btn-white rsConIcon show-rs-div display-none">
					<i class="fa fa-arrow-circle-o-left fa-lg text-info"></i> Back To Result  </button>

					<button  class="btn btn-white rsConIcon showTBColsBtn  display-none" 
					id ="showTBColsBtn" onclick="showTBCols();">
					<i class="fa fa-check-square-o fa-lg text-info"></i> Show Hidden Columns </button>

					<button  class="btn btn-white rsConIcon hideTBColsBtn  display-none" 
					id ="hideTBColsBtn" onclick="hideTBCols();">
					<i class="fa fa-check-square-o fa-lg text-info"></i> Hide Subject Position</button>

					<button class="paginate-page display-none"  type="submit">Paginate Page</button> 
					<button id="paginate-page"  type="submit">Paginate Page</button> 

					</ul>
				</div>

			</section>
         
        </div>
    </div>
	<!-- / row -->
	<div id="ScrollTarget"> </div>	