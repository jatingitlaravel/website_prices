<?php
$defaultData = YpmPopupData::defaultsData();
?>
<div class="ycf-bootstrap-wrapper">
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-popup-enable-start-date"><?php _e('Enable start date', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		<?php echo ypm_info(__('If this option is enabled, the popup will start to appear from your specified day.', YPM_POPUP_TEXT_DOMAIN)); ?>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-popup-enable-start-date" class="js-ypm-accordion" name="ypm-popup-enable-start-date" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-popup-enable-start-date')); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="ypm-margin-bottom-15">
	<div class="row form-group">
		<div class="col-md-3">
			<label for="ypm-popup-start-date" class="ycd-label-of-input">
				<?php _e('Date', YCD_TEXT_DOMAIN); ?>
			</label>
		</div>
		<div class="col-md-6">
			<input type="text" id="ypm-popup-start-date" class="form-control ypm-date-time-picker" name="ypm-popup-start-date" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-popup-start-date')); ?>">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-md-3">
			<label for="ypm-popup-start-date-time-zone" class="ycd-label-of-input">
				<?php _e('Time zone', YCD_TEXT_DOMAIN); ?>
			</label>
		</div>
		<div class="col-md-6">
			<?php echo YpmFunctions::createSelectBox(YpmAdminHelper::getTimeZones(), $popupTypeObj->getOptionValue('ypm-popup-start-date-time-zone'), array('name' => 'ypm-popup-start-date-time-zone', 'class' => 'js-basic-select form-control ypm-fblike-share-layout ypm-fblike-option')); ?>
		</div>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-popup-title"><?php _e('Show popup title', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		<?php echo ypm_info(__('if this option is enabled, the popup will show popup title.', YPM_POPUP_TEXT_DOMAIN)); ?>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-popup-title" class="js-ypm-accordion" name="ypm-popup-title" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-popup-title')); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label"><?php _e('popup title color', YPM_POPUP_TEXT_DOMAIN);?>:</label>
	</div>
	<div class="col-xs-4">
		<div id="ypm-color-picker"><input  class="ypm-color-picker" id="ypm-title-color" type="text" name="ypm-title-color" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-title-color')); ?>" /></div>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-esc-key"><?php _e('Dismiss on "esc" key', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		<?php echo ypm_info(__('The popup will close if the "Esc" key of your keyboard is clicked.', YPM_POPUP_TEXT_DOMAIN)); ?>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-esc-key" name="ypm-esc-key" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-esc-key')); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-close-button"><?php _e('Show "close" button', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		<?php echo ypm_info(__('Disable this option if you don\'t want to show a "close" button on the popup.', YPM_POPUP_TEXT_DOMAIN)); ?>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-close-button" class="js-ypm-accordion" name="ypm-close-button" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-close-button')); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="row ypm-margin-bottom-15 ypm-sub-option">
	<div class="col-xs-12">
		<div class="row ypm-margin-bottom-15">
			<div class="col-xs-3">
				<label class="control-label" for="js-ypm-enable-close-delay"><?php _e('Enable delay', YPM_POPUP_TEXT_DOMAIN);?>:</label>
				<?php echo ypm_info(__('Enable popup close showing delay', YPM_POPUP_TEXT_DOMAIN)); ?>
			</div>
			<div class="col-xs-4">
				<label class="ypm-switch">
					<input type="checkbox" id="js-ypm-enable-close-delay" class="js-ypm-enable-close-delay js-ypm-accordion" name="ypm-enable-close-delay" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-enable-close-delay')); ?>>
					<span class="ypm-slider ypm-round"></span>
				</label>
			</div>
		</div>
		<div class="row ypm-margin-bottom-15 ypm-sub-option">
			<div class="row ypm-margin-bottom-15">
				<div class="col-xs-3">
					<label class="control-label" for="ypm-close-button-delay"><?php _e('Delay', YPM_POPUP_TEXT_DOMAIN);?>:</label>
				</div>
				<div class="col-xs-4">
					<input type="number" id="ypm-close-button-delay" class="form-control" name="ypm-close-button-delay" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-close-button-delay')); ?>">
				</div>
				<div class="col-xs-1">
					<?php _e('Seconds', YPM_POPUP_TEXT_DOMAIN)?>
				</div>
			</div>
			<div class="row ypm-margin-bottom-15">
				<div class="col-xs-3">
					<label class="control-label" for="js-ypm-show-close-delay"><?php _e('show delay', YPM_POPUP_TEXT_DOMAIN);?>:</label>
					<?php echo ypm_info(__('When you enable this option, it will display the remaining seconds until the close button appears', YPM_POPUP_TEXT_DOMAIN)); ?>
				</div>
				<div class="col-xs-4">
					<label class="ypm-switch">
						<input type="checkbox" id="js-ypm-show-close-delay" class="js-ypm-enable-close-delay js-ypm-accordion" name="ypm-show-close-delay" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-show-close-delay')); ?>>
						<span class="ypm-slider ypm-round"></span>
					</label>
				</div>
			</div>
			<div class="row ypm-margin-bottom-15 ypm-sub-option">
				<div class="row ypm-margin-bottom-15">
					<div class="col-xs-3">
						<label class="control-label" for="ypm-close-delay-font-size"><?php _e('Font size', YPM_POPUP_TEXT_DOMAIN);?>:</label>
					</div>
					<div class="col-xs-4">
						<input type="text" id="ypm-close-delay-font-size" class="form-control" name="ypm-close-delay-font-size" value="<?php echo  esc_attr($popupTypeObj->getOptionValue('ypm-close-delay-font-size')); ?>">
					</div>
				</div>
				<div class="row ypm-margin-bottom-15">
					<div class="col-xs-3">
						<label class="control-label" for="ypm-close-delay-color"><?php _e('Change Text Color', YPM_POPUP_TEXT_DOMAIN);?>:</label>
					</div>
					<div class="col-xs-4">
						<div id="ypm-color-picker"><input  class="ypm-color-picker" id="ypm-close-delay-color" type="text" name="ypm-close-delay-color" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-close-delay-color')); ?>" /></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-overlay-click"><?php _e('Dismiss on overlay click', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		<?php echo ypm_info(__('The popup will close when clicked on the overlay of the popup.', YPM_POPUP_TEXT_DOMAIN)); ?>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-overlay-click" name="ypm-overlay-click" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-overlay-click')); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-content-click-status"><?php _e('Dismiss on content click', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		<?php echo ypm_info(__('The popup will close when clicked on the content of the popup.', YPM_POPUP_TEXT_DOMAIN)); ?>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-content-click-status" class="js-ypm-accordion" name="ypm-content-click-status" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-content-click-status')); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="ypm-sub-option">
	<div class="row ypm-margin-bottom-15">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-content-click-count"><?php _e('Click count', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<input type="number" id="ypm-content-click-count" name="ypm-content-click-count" class="form-control" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-content-click-count')); ?>">
		</div>
	</div>
	<div class="row ypm-margin-bottom-15">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-content-click-redirect-enable"><?php _e('Enable redirect', YPM_POPUP_TEXT_DOMAIN);?>:</label>
			<?php echo ypm_info(__('After popup content click enable redirection.', YPM_POPUP_TEXT_DOMAIN)); ?>
		</div>
		<div class="col-xs-4">
			<label class="ypm-switch">
				<input type="checkbox" id="ypm-content-click-redirect-enable" class="js-ypm-accordion" name="ypm-content-click-redirect-enable" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-content-click-redirect-enable')); ?>>
				<span class="ypm-slider ypm-round"></span>
			</label>
		</div>
	</div>
	<div>
		<div class="row ypm-margin-bottom-15">
			<div class="col-xs-3">
				<label class="control-label" for="ypm-content-click-redirect-url"><?php _e('URL', YPM_POPUP_TEXT_DOMAIN);?>:</label>
			</div>
			<div class="col-xs-4">
				<input type="url" id="ypm-content-click-redirect-url" class="form-control" name="ypm-content-click-redirect-url" placeholder="https://" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-content-click-redirect-url')); ?>">
			</div>
		</div>
		<div class="row ypm-margin-bottom-15">
			<div class="col-xs-3">
				<label class="control-label" for="ypm-content-click-redirect-tab"><?php _e('Redirect to new tab', YPM_POPUP_TEXT_DOMAIN);?>:</label>
				<?php echo ypm_info(__("It's will be redirect to new tab.", YPM_POPUP_TEXT_DOMAIN)); ?>
			</div>
			<div class="col-xs-4">
				<label class="ypm-switch">
					<input type="checkbox" id="ypm-content-click-redirect-tab" name="ypm-content-click-redirect-tab" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-content-click-redirect-tab')); ?>>
					<span class="ypm-slider ypm-round"></span>
				</label>
			</div>
		</div>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-disable-page-scrolling"><?php _e('Disable page scrolling', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		<?php echo ypm_info(__('If this option is enabled, the page won\'t scroll until the popup is open', YPM_POPUP_TEXT_DOMAIN)); ?>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-disable-page-scrolling" name="ypm-disable-page-scrolling" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-disable-page-scrolling')); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-popup-location"><?php _e('Popup location', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		<?php echo ypm_info(__('If this option is enabled, you can specify the position of the popup on the screen.', YPM_POPUP_TEXT_DOMAIN)); ?>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-popup-location" class="js-ypm-accordion" name="ypm-popup-location" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-popup-location')); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
	</div>
	<div class="col-xs-9">
		<div class="ypm-fixed-wrapper">
			<div class="js-ypm-fixed-position-style" id="ypm-fixed-position1" data-ypm-value="1"></div>
			<div class="js-ypm-fixed-position-style" id="ypm-fixed-position2" data-ypm-value="2"></div>
			<div class="js-ypm-fixed-position-style" id="ypm-fixed-position3" data-ypm-value="3"></div>
			<div class="js-ypm-fixed-position-style" id="ypm-fixed-position4" data-ypm-value="4"></div>
			<div class="js-ypm-fixed-position-style" id="ypm-fixed-position5" data-ypm-value="5"></div>
			<div class="js-ypm-fixed-position-style" id="ypm-fixed-position6" data-ypm-value="6"></div>
			<div class="js-ypm-fixed-position-style" id="ypm-fixed-position7" data-ypm-value="7"></div>
			<div class="js-ypm-fixed-position-style" id="ypm-fixed-position8" data-ypm-value="8"></div>
			<div class="js-ypm-fixed-position-style" id="ypm-fixed-position9" data-ypm-value="9"></div>
		</div>
		<input type="hidden" name="ypm-popup-fixed-position" class="js-ypm-fixed-position" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-popup-fixed-position'));?>">
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-popup-showing-limitation"><?php _e('Popup showing limitation', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		<?php echo ypm_info(__('If this option is enabled, you can estimate the popup showing frequency to the same user.', YPM_POPUP_TEXT_DOMAIN)); ?>
	</div>
	<div class="col-xs-4">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-popup-showing-limitation" class="js-ypm-accordion" name="ypm-popup-showing-limitation" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-popup-showing-limitation')); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
		<br>
	</div>
</div>
<div class="row ypm-margin-bottom-15 ypm-sub-option">
	<div class="col-xs-12">
		<div class="row ypm-margin-bottom-15">
			<div class="col-xs-3">
				<label class="control-label" for="ypm-limitation-shwoing-count"><?php _e('Popup showing count', YPM_POPUP_TEXT_DOMAIN);?>:</label>
				<?php echo ypm_info(__('Select how many times the popup will be shown for the same user.', YPM_POPUP_TEXT_DOMAIN)); ?>
			</div>
			<div class="col-xs-4">
				<input type="number" min="1" id="ypm-limitation-shwoing-count" class="form-control" name="ypm-limitation-shwoing-count" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-limitation-shwoing-count')); ?>">
			</div>
		</div>
		<div class="row ypm-margin-bottom-15">
			<div class="col-xs-3">
				<label class="control-label" for="ypm-limitation-shwoing-expiration"><?php _e('Popup showing expiry', YPM_POPUP_TEXT_DOMAIN);?>:</label>
				<?php echo ypm_info(__('Select the count of the days after which the popup will be shown to the same user, or set the value "0" if you want to save cookies by session.', YPM_POPUP_TEXT_DOMAIN)); ?>
			</div>
			<div class="col-xs-4">
				<input type="number" min="1" id="ypm-limitation-shwoing-expiration" class="form-control" name="ypm-limitation-shwoing-expiration" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-limitation-shwoing-expiration')); ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3">
				<label class="control-label" for="ypm-show-popup-same-user-page-level"><?php _e('Apply option on each page', YPM_POPUP_TEXT_DOMAIN);?>:</label>
				<?php echo ypm_info(__('If this option is checked the popup showing limitation will be saved for the current page. Otherwise, the limitation will refer site wide, and the popup will be shown for specific times on each page selected.The previously specified count of days will be reset every time you check/uncheck this option.', YPM_POPUP_TEXT_DOMAIN)); ?>
			</div>
			<div class="col-xs-4">
				<label class="ypm-switch">
					<input type="checkbox" id="ypm-show-popup-same-user-page-level" name="ypm-show-popup-same-user-page-level" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-show-popup-same-user-page-level')); ?>>
					<span class="ypm-slider ypm-round"></span>
				</label>
			</div>
		</div>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-popup-opening-animation"><?php _e('Popup opening animation', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		<?php echo ypm_info(__('Select the popup opening animation type', YPM_POPUP_TEXT_DOMAIN)); ?>
	</div>
	<div class="col-xs-3">
		<?php echo YpmAdminHelper::selectBox($defaultData['openAnimationEffects'], $popupTypeObj->getOptionValue('ypm-popup-opening-animation'), array('name' => 'ypm-popup-opening-animation', 'class' => 'js-basic-select ypm-popup-opening-animation')); ?>
		<div class="js-open-animation-effect ypm-js-opening-animation-effect"></div>
	</div>
	<div class="col-xs-1">
		<div class="ypm-animation-preview" data-type="opening"></div>
	</div>
</div>
<div class="ypm-sub-options-wrapper">
	<div class="row ypm-margin-bottom-15">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-popup-opening-animation-speed"><?php _e('Animation speed', YPM_POPUP_TEXT_DOMAIN);?>:</label>
			<?php echo ypm_info(__('Set popup opening animation duration', YPM_POPUP_TEXT_DOMAIN)); ?>
		</div>
		<div class="col-xs-3">
			<input name="ypm-popup-opening-animation-speed" id="ypm-popup-opening-animation-speed" value="<?php esc_attr_e($popupTypeObj->getOptionValue('ypm-popup-opening-animation-speed'));?>" class="form-control">
		</div>
		<div class="col-xs-1">
			Seconds
		</div>
	</div>
</div>
	<div class="row ypm-margin-bottom-15">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-popup-close-animation"><?php _e('Popup close animation', YPM_POPUP_TEXT_DOMAIN);?>:</label>
			<?php echo ypm_info(__('Select the popup close animation type', YPM_POPUP_TEXT_DOMAIN)); ?>
		</div>
		<div class="col-xs-3">
			<?php echo YpmAdminHelper::selectBox($defaultData['closeAnimationEffects'], $popupTypeObj->getOptionValue('ypm-popup-close-animation'), array('name' => 'ypm-popup-close-animation', 'class' => 'js-basic-select ypm-popup-close-animation')); ?>
			<div class="js-close-animation-effect ypm-js-close-animation-effect"></div>
		</div>
		<div class="col-xs-1">
			<div class="ypm-animation-preview" data-type="close"></div>
		</div>
	</div>
	<div class="ypm-sub-options-wrapper">
		<div class="row ypm-margin-bottom-15">
			<div class="col-xs-3">
				<label class="control-label" for="ypm-popup-close-animation-speed"><?php _e('Animation speed', YPM_POPUP_TEXT_DOMAIN);?>:</label>
				<?php echo ypm_info(__('Set popup close animation duration', YPM_POPUP_TEXT_DOMAIN)); ?>
			</div>
			<div class="col-xs-3">
				<input name="ypm-popup-close-animation-speed" id="ypm-popup-close-animation-speed" value="<?php esc_attr_e($popupTypeObj->getOptionValue('ypm-popup-close-animation-speed'));?>" class="form-control">
			</div>
			<div class="col-xs-1">
				Seconds
			</div>
		</div>
	</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-close-delay"><?php _e('Popup close delay', YPM_POPUP_TEXT_DOMAIN);?>:</label>
	</div>
	<div class="col-xs-3">
		<input type="number" min="0" id="ypm-close-delay" class="form-control" name="ypm-close-delay" value="<?php echo esc_attr((int)$popupTypeObj->getOptionValue('ypm-close-delay')); ?>"><br>
	</div>
	<div class="col-xs-1">
		<spa><?php _e('Seconds', YPM_POPUP_TEXT_DOMAIN)?></spa>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-delay"><?php _e('Popup opening delay', YPM_POPUP_TEXT_DOMAIN);?>:</label>
	</div>
	<div class="col-xs-3">
		<input type="number" min="0" id="ypm-delay" class="form-control" name="ypm-delay" value="<?php echo esc_attr((int)$popupTypeObj->getOptionValue('ypm-delay')); ?>"><br>
	</div>
	<div class="col-xs-1">
		<spa><?php _e('Seconds', YPM_POPUP_TEXT_DOMAIN)?></spa>
	</div>
</div>
<div class="row ypm-margin-bottom-15">
	<div class="col-xs-3">
		<label class="control-label" for="ypm-z-index"><?php _e('Popup Z index', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		<?php echo ypm_info(__('Increase or dicrease the value to set the priority of displaying the popup content in comparison of other elements on the page. The highest value of z-index is 2147483647.', YPM_POPUP_TEXT_DOMAIN)); ?>
	</div>
	<div class="col-xs-3">
		<input type="number" min="0" id="ypm-z-index" class="form-control" name="ypm-z-index" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-z-index')); ?>"><br>
	</div>
</div>
<div class="row">
	<div class="col-xs-3">
		<label class="control-label" for="textinput"><?php _e('Popup Content Styles', YPM_POPUP_TEXT_DOMAIN);?></label>
	</div>
</div>
<div class="ypm-sub-options-wrapper">
	<div class="row ypm-margin-bottom-15">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-content-custom-class"><?php _e('Custom class', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<input type="text" placeholder="EX: content-custom-class"  id="ypm-content-custom-class" class="form-control" name="ypm-content-custom-class" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-content-custom-class')); ?>">
		</div>
	</div>
	<div class="row ypm-margin-bottom-15">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-content-padding"><?php _e('Padding', YPM_POPUP_TEXT_DOMAIN);?>:</label>
			<?php echo ypm_info(__('Added popup content padding ex 10, 10px, 10rem', YPM_POPUP_TEXT_DOMAIN)); ?>
		</div>
		<div class="col-xs-4">
			<input type="text" min="0" id="ypm-content-padding" class="form-control" name="ypm-content-padding" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-content-padding')); ?>"><br>
		</div>
	</div>
	<div class="row ypm-margin-bottom-15">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-content-border-radius"><?php _e('Border radius', YPM_POPUP_TEXT_DOMAIN);?>:</label>
			<?php echo ypm_info(__('Added popup content border radius ex 50, 50px, 50%, Note: use with 2th and 3th themes', YPM_POPUP_TEXT_DOMAIN)); ?>
		</div>
		<div class="col-xs-4">
			<input type="text" min="0" id="ypm-content-border-radius" class="form-control" name="ypm-content-border-radius" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-content-border-radius')); ?>"><br>
		</div>
	</div>
	<div class="row ypm-margin-bottom-15">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-content-bg-color"><?php _e('Change Background Color', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<div id="ypm-color-picker"><input  class="ypm-color-picker" id="ypm-content-bg-color" type="text" name="ypm-content-bg-color" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-content-bg-color')); ?>" /></div>
		</div>
	</div>
	<div class="row ypm-margin-bottom-15">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-content-text-color"><?php _e('Change Text Color', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<div id="ypm-color-picker"><input  class="ypm-color-picker" id="ypm-content-text-color" type="text" name="ypm-content-text-color" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-content-text-color')); ?>" /></div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-enable-bg-image"><?php _e('Enable background image', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<label class="ypm-switch">
				<input type="checkbox" id="ypm-enable-bg-image" class="js-ypm-accordion" name="ypm-enable-bg-image" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-enable-bg-image')); ?>>
				<span class="ypm-slider ypm-round"></span>
			</label>
		</div>
	</div>
	<div class="row ypm-margin-bottom-15 ypm-sub-option">
		<div class="row">
			<label for="redirect-to-url" class="col-md-5 control-label ypm-static-padding-top ypm-double-sub-option">
				<?php _e('Image', YPM_POPUP_TEXT_DOMAIN)?>:
			</label>
			<div class="col-md-6 form-group">
				<div class="row">
					<div>
						<div class="ypm-button-image-uploader-wrapper">
							<input  id="js-background-upload-image" type="hidden" size="36" name="ypm-background-image" value="<?php echo (esc_attr($popupTypeObj->getOptionValue('ypm-background-image'))) ? esc_attr($popupTypeObj->getOptionValue('ypm-background-image')) : '' ; ?>" autocomplete="off">
						</div>
					</div>

					<div class="col-md-12 form-group">
						<div class="ypm-show-background-image-container">
							<span class="ypm-no-image">(<?php _e('No image selected', YPM_POPUP_TEXT_DOMAIN);?>)</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 ypm-background-change-image-wrapper">
						<input id="js-background-upload-image-button" class="btn btn-sm btn-default" type="button" value="<?php _e('Change image', YPM_POPUP_TEXT_DOMAIN);?>">
					</div>
					<div class="col-md-4 js-ypm-remove-background-image<?php echo (!$popupTypeObj->getOptionValue('ypm-background-image')) ? ' ypm-hide' : '';?>">
						<input id="js-background-upload-image-remove-button" class="btn btn-sm btn-danger" type="button" value="<?php _e('Remove', YPM_POPUP_TEXT_DOMAIN);?>">
					</div>
				</div>
			</div>
		</div>
		<div class="row form-group">
			<label for="content-padding" class="col-md-5 control-label ypm-static-padding-top ypm-double-sub-option">
				<?php _e('Mode', YPM_POPUP_TEXT_DOMAIN)?>:
			</label>
			<div class="col-md-6 form-group">
				<?php echo YpmFunctions::createSelectBox($defaultData['backroundImageModes'], $popupTypeObj->getOptionValue('ypm-background-image-mode'), array('name' => 'ypm-background-image-mode', 'class'=>'js-basic-select')); ?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-3">
		<label class="control-label" for="textinput"><?php _e('Popup Overlay Styles', YPM_POPUP_TEXT_DOMAIN);?></label>
	</div>
</div>
<div class="ypm-sub-options-wrapper">
	<div class="row ypm-margin-bottom-15">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-overlay-custom-class"><?php _e('Custom class', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<input type="text" placeholder="EX: content-custom-class"  id="ypm-overlay-custom-class" class="form-control" name="ypm-overlay-custom-class" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-overlay-custom-class')); ?>">
		</div>
	</div>
	<div class="row">
		<div class="col-xs-3">
			<label class="control-label" for="textinput"><?php _e('Change overlay color', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<div id="ypm-color-picker"><input  class="ypm-color-picker" id="ypm-overlay-color" type="text" name="ypm-overlay-color" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-overlay-color')); ?>" /></div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-3">
			<label class="control-label" for="ypm-disable-overlay"><?php _e('Disable overlay', YPM_POPUP_TEXT_DOMAIN);?>:</label>
		</div>
		<div class="col-xs-4">
			<label class="ypm-switch">
				<input type="checkbox" id="ypm-disable-overlay" name="ypm-disable-overlay" <?php echo esc_attr($popupTypeObj->getOptionValue('ypm-disable-overlay')); ?>>
				<span class="ypm-slider ypm-round"></span>
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-3 overlay-opacity-label">
			<label class="control-label" for="textinput"><?php _e('Background opacity', YPM_POPUP_TEXT_DOMAIN);?>:</label>
			<?php echo ypm_info(__('Choose the popup overlay opacity.', YPM_POPUP_TEXT_DOMAIN)); ?>
		</div>
		<div class="col-xs-4">
			<input type="text" id="range" class="ypm-range" name="ypm-overlay-opacity" value="<?php echo esc_attr($popupTypeObj->getOptionValue('ypm-overlay-opacity')); ?>">
		</div>
	</div>
</div>
</div>