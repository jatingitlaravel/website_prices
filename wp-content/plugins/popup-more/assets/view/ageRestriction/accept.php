<div class="row form-group">
    <div class="col-md-6">
        <label class="ypm-label-of-switch"><?php _e('Accept button', YPM_POPUP_TEXT_DOMAIN)?></label>
    </div>
    <div class="col-md-6">
    </div>
</div>
<div class="row ypm-margin-bottom-15 ypm-sub-option">
	<div class="row form-group">
		<div class="col-md-6">
			<label for="ypm-restriction-accept-enable-dimension" class="ypm-label-of-switch"><?php _e('Enable custom dimension', YPM_POPUP_TEXT_DOMAIN); ?></label>
		</div>
		<div class="col-md-6">
			<label class="ypm-switch">
				<input type="checkbox" id="ypm-restriction-accept-enable-dimension" name="ypm-restriction-accept-enable-dimension" class="js-ypm-accordion js-ypm-time-status" <?php esc_attr_e($popupTypeObj->getOptionValue('ypm-restriction-accept-enable-dimension'));?>>
				<span class="ypm-slider ypm-round"></span>
			</label>
		</div>
	</div>
	<div class="ypm-accordion-content ypm-hide-content form-group">
		<div class="row form-group">
			<div class="col-md-6">
				<label for="ypm-restriction-accept-width"><?php _e('Width', YPM_POPUP_TEXT_DOMAIN)?></label>
			</div>
			<div class="col-md-6">
				<input id="ypm-restriction-accept-width" class="form-control" type="text" name="ypm-restriction-accept-width" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-restriction-accept-width'))?>">
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-6">
				<label for="ypm-restriction-accept-height"><?php _e('Height', YPM_POPUP_TEXT_DOMAIN)?></label>
			</div>
			<div class="col-md-6">
				<input id="ypm-restriction-accept-height" class="form-control" type="text" name="ypm-restriction-accept-height" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-restriction-accept-height'))?>">
			</div>
		</div>
	</div>
    <div class="row form-group">
        <div class="col-md-6">
            <label for="ypm-restriction-accept-label"><?php _e('Label', YPM_POPUP_TEXT_DOMAIN)?></label>
        </div>
        <div class="col-md-6">
            <input id="ypm-restriction-accept-label" class="form-control" type="text" name="ypm-restriction-accept-label" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-restriction-accept-label'))?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-6">
            <label for="ypm-restriction-accept-font-size"><?php _e('Font size', YPM_POPUP_TEXT_DOMAIN)?></label>
        </div>
        <div class="col-md-6">
            <input id="ypm-restriction-accept-font-size" class="form-control" type="text" name="ypm-restriction-accept-font-size" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-restriction-accept-font-size'))?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-6">
            <label for="ypm-restriction-accept-padding"><?php _e('Padding', YPM_POPUP_TEXT_DOMAIN)?></label>
        </div>
        <div class="col-md-6">
            <input id="ypm-restriction-accept-padding" class="form-control" type="text" name="ypm-restriction-accept-padding" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-restriction-accept-padding'))?>">
        </div>
    </div>
	<div class="row form-group">
        <div class="col-md-6">
            <label for="ypm-restriction-accept-border-radius"><?php _e('Border radius', YPM_POPUP_TEXT_DOMAIN)?></label>
        </div>
        <div class="col-md-6">
            <input id="ypm-restriction-accept-border-radius" class="form-control" type="text" name="ypm-restriction-accept-border-radius" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-restriction-accept-border-radius'))?>">
        </div>
    </div>
	<div class="row form-group">
		<div class="col-md-6">
			<label for="ypm-restriction-accept-bg-color" class=""><?php _e('Background color', YPM_POPUP_TEXT_DOMAIN); ?></label>
		</div>
		<div class="col-md-6 ypm-option-wrapper">
			<div class="minicolors minicolors-theme-default minicolors-position-bottom minicolors-position-left">
				<input type="text" id="ypm-restriction-accept-bg-color" placeholder="<?php _e('Select color', YPM_POPUP_TEXT_DOMAIN)?>" name="ypm-restriction-accept-bg-color" class=" minicolors-input ypm-minicolors" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-restriction-accept-bg-color')); ?>">
			</div>
		</div>
	</div>
	<div class="row form-group">
		<div class="col-md-6">
			<label for="ypm-restriction-accept-text-color" class=""><?php _e('Text color', YPM_POPUP_TEXT_DOMAIN); ?></label>
		</div>
		<div class="col-md-6 ypm-option-wrapper">
			<div class="minicolors minicolors-theme-default minicolors-position-bottom minicolors-position-left">
				<input type="text" id="ypm-restriction-accept-text-color" placeholder="<?php _e('Select color', YPM_POPUP_TEXT_DOMAIN)?>" name="ypm-restriction-accept-text-color" class=" minicolors-input ypm-minicolors" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-restriction-accept-text-color')); ?>">
			</div>
		</div>
	</div>
	<div class="row form-group">
		<div class="col-md-6">
			<label for="ypm-restriction-accept-enable-hover" class="ypm-label-of-switch"><?php _e('Enable hover', YPM_POPUP_TEXT_DOMAIN); ?></label>
		</div>
		<div class="col-md-6">
			<label class="ypm-switch">
				<input type="checkbox" id="ypm-restriction-accept-enable-hover" name="ypm-restriction-accept-enable-hover" class="js-ypm-accordion js-ypm-time-status" <?php esc_attr_e($popupTypeObj->getOptionValue('ypm-restriction-accept-enable-hover'));?>>
				<span class="ypm-slider ypm-round"></span>
			</label>
		</div>
	</div>
	<div class="ypm-accordion-content ypm-hide-content form-group">
		<div class="row form-group">
			<div class="col-md-6">
				<label for="ypm-restriction-accept-hover-bg-color" class=""><?php _e('Background color', YPM_POPUP_TEXT_DOMAIN); ?></label>
			</div>
			<div class="col-md-6 ypm-option-wrapper">
				<div class="minicolors minicolors-theme-default minicolors-position-bottom minicolors-position-left">
					<input type="text" id="ypm-restriction-accept-hover-bg-color" placeholder="<?php _e('Select color', YPM_POPUP_TEXT_DOMAIN)?>" name="ypm-restriction-accept-hover-bg-color" class=" minicolors-input ypm-minicolors" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-restriction-accept-hover-bg-color')); ?>">
				</div>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-6">
				<label for="ypm-restriction-accept-hover-text-color" class=""><?php _e('Text color', YPM_POPUP_TEXT_DOMAIN); ?></label>
			</div>
			<div class="col-md-6 ypm-option-wrapper">
				<div class="minicolors minicolors-theme-default minicolors-position-bottom minicolors-position-left">
					<input type="text" id="ypm-restriction-accept-hover-text-color" placeholder="<?php _e('Select color', YPM_POPUP_TEXT_DOMAIN)?>" name="ypm-restriction-accept-hover-text-color" class=" minicolors-input ypm-minicolors" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-restriction-accept-hover-text-color')); ?>">
				</div>
			</div>
		</div>
	</div>
</div>