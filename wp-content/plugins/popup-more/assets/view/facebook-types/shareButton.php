<?php
global $YpmDefaultsData;
$facebookShareLayout = $YpmDefaultsData['fblikeShareLayout'];
$fblikeSize = $YpmDefaultsData['fblikeSize'];
$fbLikeAlignment = $YpmDefaultsData['fbLikeAlignment'];
?>
<div class="row ypm-margin-bottom-15">
	<div class="col-md-6">
		<label class="ypm-span-margin-bottom" for="ypm-fblike-share-url"><?php _e('URL to share', YPM_POPUP_TEXT_DOMAIN)?></label><br>
		<input id="ypm-fblike-share-url" type="url" name="ypm-facebook-share-url" class="form-control ypm-fblike-share-url ypm-fblike-option" value="<?php echo esc_html($popupTypeObj->getOptionValue('ypm-facebook-share-url'))?>">
	</div>
	<div class="col-md-6">
		<label class="ypm-span-margin-bottom"><?php _e('Layout', YPM_POPUP_TEXT_DOMAIN)?></label><br>
		<?php echo YpmFunctions::createSelectBox($facebookShareLayout, $popupTypeObj->getOptionValue('ypm-facebook-share-layout'), array('name' => 'ypm-facebook-share-layout', 'class' => 'js-basic-select form-control ypm-fblike-share-layout ypm-fblike-option')); ?>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-md-6">
		<label class="ypm-span-margin-bottom"><?php _e('Button Size', YPM_POPUP_TEXT_DOMAIN); ?></label><br>
		<?php echo YpmFunctions::createSelectBox($fblikeSize, $popupTypeObj->getOptionValue('ypm-facebook-share-size'), array('name' => 'ypm-facebook-share-size', 'class' => 'js-basic-select form-control ypm-fblike-share-size ypm-fblike-option')); ?>
	</div>
	<div class="col-md-6">
		<label class="ypm-span-margin-bottom"><?php _e('Buttons alignment', YPM_POPUP_TEXT_DOMAIN); ?></label><br>
		<?php echo YpmFunctions::createSelectBox($fbLikeAlignment, $popupTypeObj->getOptionValue('ypm-facebook-share-alignment'), array('name' => 'ypm-facebook-share-alignment', 'class' => 'js-basic-select form-control ypm-fblike-share-alignment ypm-fblike-option')); ?>
	</div>
</div>