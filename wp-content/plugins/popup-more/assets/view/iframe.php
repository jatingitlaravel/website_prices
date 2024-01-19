<form class="form-horizontal">


<div class="ycf-bootstrap-wrapper">
	<?php
	if ($_GET['post']) {
		echo YpmAdminHelper::createTypePopupNotice(YPM_IFRAME_POST_TYPE, $_GET['post']);
	}
	?>
	<div class="row">
		<div class="col-md-6">
			<div class="row ypm-margin-bottom-15">
				<div class="col-md-6">
					<label class="control-label control-label "col-md-6" for="iframe-url"><?php _e('Ifrane URL', YPM_POPUP_TEXT_DOMAIN);?>:</label>
				</div>
				<div class="col-md-6">
					<input type="url" name="ypm-iframe-url" id="iframe-url" class="form-control ifrane-setting" value="<?php echo $popupTypeObj->getOptionValue('ypm-iframe-url'); ?>">
				</div>
			</div>
			<div class="row ypm-margin-bottom-15">
				<div class="col-md-6">
					<label class="control-label" for="iframe-width"><?php _e('Width', YPM_POPUP_TEXT_DOMAIN);?>:</label>
				</div>
				<div class="col-md-6">
					<input type="text" name="ypm-iframe-width" id="iframe-width" class="form-control ifrane-setting" value="<?php echo $popupTypeObj->getOptionValue('ypm-iframe-width'); ?>">
				</div>
			</div>
			<div class="row ypm-margin-bottom-15">
				<div class="col-md-6">
					<label class="control-label" for="iframe-height"><?php _e('Height', YPM_POPUP_TEXT_DOMAIN);?>:</label>
				</div>
				<div class="col-md-6">
					<input type="text" name="ypm-iframe-height" id="iframe-height" class="form-control ifrane-setting" value="<?php echo $popupTypeObj->getOptionValue('ypm-iframe-width'); ?>">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<h3 style="text-align: center;">Live preview</h3>
			<div class="iframe-preview-wrapper"></div>
		</div>
	</div>
</div>