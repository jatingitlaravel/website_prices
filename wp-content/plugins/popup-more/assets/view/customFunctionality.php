<div class="ycf-bootstrap-wrapper">
	<div class="row ypm-margin-bottom-15">
		<div class="col-md-12">
			<label for="ypm-editor-css"><?php _e('Custom CSS', YPM_POPUP_TEXT_DOMAIN)?></label>
			<textarea id="ypm-editor-css" rows="5" name="ypm-custom-css" class="widefat textarea"><?php echo esc_attr($popupTypeObj->getOptionValue('ypm-custom-css')); ?></textarea>
		</div>
	</div>
	<div class="row ypm-margin-bottom-15">
		<div class="col-md-12">
			<label for="ypm-editor-js"><?php _e('Custom JS', YPM_POPUP_TEXT_DOMAIN)?></label>
			<textarea id="ypm-editor-js" rows="5" name="ypm-custom-js" class="widefat textarea"><?php echo esc_attr($popupTypeObj->getOptionValue('ypm-custom-js')); ?></textarea>
		</div>
	</div>
</div>