<div class="ycf-bootstrap-wrapper ypm-image-options-wrapper">
	<h3 class="ypm-image-header-text"><?php _e('Please choose your picture', YPM_POPUP_TEXT_DOMAIN)?></h3>
	<div class="ypm-upload-wrapper">
		<input name="ypm-image-popup-url" id="ypm-image-popup-url" class="form-control ypm-image-popup-url" value="<?php esc_attr_e($typeObj->getOptionValue('ypm-image-popup-url'));?>" placeholder="<?php _e("Image URL", YPM_POPUP_TEXT_DOMAIN)?>"><button class="btn btn-primary ypm-upload-button"><?php _e('Upload image', YPM_POPUP_TEXT_DOMAIN)?></button>
	</div>

	<div class="ypm-show-image-container">
		<span class="ypm-no-image">(No image selected)</span>
	</div>

</div>

