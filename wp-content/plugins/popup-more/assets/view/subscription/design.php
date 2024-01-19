<?php
	global $YpmDefaultsData;
	$formWidthMeasure = $YpmDefaultsData['subscriptionFormWidthMeasure'];
?>
<div class="ycf-bootstrap-wrapper">
	<div class="row">
		<div class="col-md-2">
			<label for="ypm-subscription-form-width"><?php _e('Form width', YPM_POPUP_TEXT_DOMAIN)?></label>
		</div>
		<div class="col-md-4">
			<input type="number" class="ypm-subscription-form-width form-control" id="ypm-subscription-form-width" value="<?php echo $popupTypeObj->getOptionValue('ypm-subscription-form-width');?>">
		</div>
		<div class="col-md-2">
			<?php echo YpmFunctions::createSelectBox(
				$formWidthMeasure,
				$popupTypeObj->getOptionValue('ypm-facebook-action'),
				array(
					'name' => 'ypm-subscription-form-width-mesure',
					'class' => 'js-basic-select form-control ypm-fblike-action ypm-fblike-option')
				); ?>
		</div>
	</div>
</div>