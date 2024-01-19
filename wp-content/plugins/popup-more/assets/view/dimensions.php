<?php
	use YpmPopup\MultipleChoiceButton;
	$defaults = YpmPopupData::defaultsData();
	$dimensionsAutoSize = $defaults['dimensionsSizes'];
	$allowedTags = YpmAdminHelper::getAllowedTags();
?>
<div class="ycf-bootstrap-wrapper">
	<div class="ypm-multichoice-wrapper">
		<?php
		$multipleChoiceButton = new MultipleChoiceButton($defaults['dimensions-modes'], esc_attr($popupTypeObj->getOptionValue('ypm-popup-dimensions-mode')));
		echo wp_kses($multipleChoiceButton, $allowedTags);
		?>
	</div>
	<div id="ypm-popup-dimensions-mode-auto" class="ypm-sub-options-wrapper ypm-hide">
		<div class="row form-group">
			<div class="col-xs-3">
				<label class="control-label" for="ypm-popup-width"><?php _e('Size', YPM_POPUP_TEXT_DOMAIN);?>:</label>
			</div>
			<div class="col-xs-4">
				<?php echo wp_kses(YpmFunctions::createSelectBox($dimensionsAutoSize, $popupTypeObj->getOptionValue('ypm-popup-dimensions-auto-size'), array('name' => 'ypm-popup-dimensions-auto-size', 'class' => 'js-basic-select form-control')), $allowedTags); ?>
			</div>
		</div>
	</div>
	<div id="ypm-popup-dimensions-mode-custom" class="ypm-sub-options-wrapper ypm-hide">
		<div class="row">
			<div class="col-xs-3">
				<label class="control-label" for="ypm-popup-width"><?php _e('Width', YPM_POPUP_TEXT_DOMAIN);?>:</label>
			</div>
			<div class="col-xs-4">
				<input type="text" id="ypm-popup-width" class="form-control" name="ypm-popup-width" value="<?php echo esc_html($popupTypeObj->getOptionValue('ypm-popup-width')); ?>"><br>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3">
				<label class="control-label" for="ypm-popup-height"><?php _e('Height', YPM_POPUP_TEXT_DOMAIN);?>:</label>
			</div>
			<div class="col-xs-4">
				<input type="text" id="ypm-popup-height" class="form-control" name="ypm-popup-height" value="<?php echo esc_html($popupTypeObj->getOptionValue('ypm-popup-height')); ?>"><br>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-popup-max-width"><?php _e('Max width', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<input type="text" id="ypm-popup-max-width" class="form-control" name="ypm-popup-max-width" value="<?php echo esc_html($popupTypeObj->getOptionValue('ypm-popup-max-width')); ?>" placeholder="<?php _e('Max width', YPM_POPUP_TEXT_DOMAIN);?>"><br>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-popup-max-height"><?php _e('Max Height', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<input type="text" class="form-control" id="ypm-popup-max-height" name="ypm-popup-max-height" value="<?php echo esc_html($popupTypeObj->getOptionValue('ypm-popup-max-height')); ?>" placeholder="<?php _e('Max Height', YPM_POPUP_TEXT_DOMAIN);?>"><br>
		</div>
	</div>
</div>