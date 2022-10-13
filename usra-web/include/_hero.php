<div id="page-container">
    <main id="main-container">

    <!-- page hero for dashboard page -->
		<?php if(isset($currpageid) and ($currpageid==0)) {  ?>
			<div class="bg-white">
			  <div class="content content-full hero py-5">
			    <img src="assets/img/system/logo.png">
			    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
			      <h1 class="flex-sm-fill h3 my-2 text-center">
			        <?=$listpage_caption[$currpageindex]?>
			      </h1>
			    </div>
			  </div>
			</div>
			<!-- page hero for other than dashboard page -->
		<?php } else { ?>
			<div class="bg-white">
			  <div class="content content-full hero2 py-4">
			    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
			      <h1 class="flex-sm-fill h3 my-2 py-3">
			        <i class="<?=$listpage_icon[$currpageindex]?>"></i>&nbsp;
			        <?=$listpage_title[$currpageindex]?>&nbsp;&nbsp;&nbsp;
			        <small class="h6 d-block d-sm-inline-block font-w400 text-muted ls1 mb-0 mt-1">
				        <?=$listpage_caption[$currpageindex]?>
			        </small>
			      </h1>
			    </div>
			 </div>
			</div>
		<?php } ?>
