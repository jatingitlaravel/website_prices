<?php
global $YpmDefaultsData;
$defaults = YpmPopupData::defaultsData();
$fbButtons = $defaults['fbButtons'];
$facebookLayout = $YpmDefaultsData['fblikeLayout'];
$fblikeAction = $YpmDefaultsData['fblikeAction'];
$fblikeSize = $YpmDefaultsData['fblikeSize'];
$fbLikeAlignment = $YpmDefaultsData['fbLikeAlignment'];
?>
<div class="row ypm-margin-bottom-15">
	<div class="col-md-6">
		<label class="ypm-span-margin-bottom"><?php _e('Layout', YPM_POPUP_TEXT_DOMAIN); ?></label><br>
		<?php echo YpmFunctions::createSelectBox($facebookLayout, $popupTypeObj->getOptionValue('ypm-facebook-layout'), array('name' => 'ypm-facebook-layout', 'class' => 'js-basic-select form-control ypm-fblike-layout ypm-fblike-option')); ?>
	</div>
	<div class="col-md-6">
		<label class="ypm-span-margin-bottom"><?php _e('Action Type', YPM_POPUP_TEXT_DOMAIN); ?></label><br>
		<?php echo YpmFunctions::createSelectBox($fblikeAction, $popupTypeObj->getOptionValue('ypm-facebook-action'), array('name' => 'ypm-facebook-action', 'class' => 'js-basic-select form-control ypm-fblike-action ypm-fblike-option')); ?>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-md-6">
		<span class="ypm-span-margin-bottom"><?php _e('Button Size', YPM_POPUP_TEXT_DOMAIN); ?></span><br>
		<?php echo YpmFunctions::createSelectBox($fblikeSize, $popupTypeObj->getOptionValue('ypm-facebook-size'), array('name' => 'ypm-facebook-size', 'class' => 'js-basic-select form-control ypm-fblike-size ypm-fblike-option')); ?>
	</div>
	<div class="col-md-6">
		<label for="ypm-fblike-url" class="ypm-span-margin-bottom"><?php _e('URL to Like', YPM_POPUP_TEXT_DOMAIN); ?></label><br>
		<input id="ypm-fblike-url" type="text" name="ypm-facebook-url" class="form-control ypm-fblike-url ypm-fblike-option" value="<?php echo esc_html($popupTypeObj->getOptionValue('ypm-facebook-url'))?>">
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-md-6">
		<label class="ypm-switch">
			<input id="ypm-facebook-share-button" type="checkbox" class="ypm-fblike-option" name="ypm-facebook-share-button" <?php echo $popupTypeObj->getOptionValue('ypm-facebook-share-button'); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<label for="ypm-facebook-share-button" class="checkbox-right-label">Add share button</label>
	</div>
	<div class="col-md-6">
		<label class="ypm-span-margin-bottom"><?php _e('Buttons alignment', YPM_POPUP_TEXT_DOMAIN); ?></label><br>
		<?php echo YpmFunctions::createSelectBox($fbLikeAlignment, $popupTypeObj->getOptionValue('ypm-facebook-like-alignment'), array('name' => 'ypm-facebook-like-alignment', 'class' => 'js-basic-select form-control ypm-fblike-alignment ypm-fblike-option')); ?>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-md-6">
		<div class="ypmAjaxPrev">

		</div>
	</div>
	<div class="col-md-6"></div>

</div>