<div class="ycf-bootstrap-wrapper">
	<div class="row form-group">
		<div class="col-md-3">
			<label for="ypm-subscription-send-to-email"><? _e('To', YPM_POPUP_TEXT_DOMAIN)?></label>
		</div>
		<div class="col-md-5">
			<input type="email" class="ypm-subscription-form-width form-control" id="ypm-subscription-send-to-email" value="<?php echo $popupTypeObj->getOptionValue('ypm-subscription-send-to-email');?>">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-md-3">
			<label for="ypm-subscription-send-from-email"><? _e('From', YPM_POPUP_TEXT_DOMAIN)?></label>
		</div>
		<div class="col-md-5">
			<input type="email" class="ypm-subscription-form-width form-control" id="ypm-subscription-send-from-email" name="ypm-subscription-send-from-email" value="<?php echo $popupTypeObj->getOptionValue('ypm-subscription-send-from-email');?>">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-md-3">
			<label for="ypm-subscription-send-email-subject"><? _e('Subject', YPM_POPUP_TEXT_DOMAIN)?></label>
		</div>
		<div class="col-md-5">
			<input type="text" class="ypm-subscription-form-width form-control" id="ypm-subscription-send-email-subject" name="ypm-subscription-send-email-subject" value="<?php echo $popupTypeObj->getOptionValue('ypm-subscription-send-email-subject');?>">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-md-3">
			<label for="ypm-subscription-send-email-subject"><? _e('Message', YPM_POPUP_TEXT_DOMAIN)?></label>
		</div>
		<div class="col-md-5">
			<?php
			$content = $popupTypeObj->getOptionValue('ypm-subscription-message');
			$editorId = 'ypm-subscription-message';
			$settings = array(
				'wpautop' => false,
				'tinymce' => array(
					'width' => '100%',
				),
				'textarea_rows' => '6',
				'media_buttons' => true
			);
			wp_editor($content, $editorId, $settings);
			?>
		</div>
	</div>
</div>