<?php
	use YpmPopup\MultipleChoiceButton;
	$defaults = YpmPopupData::defaultsData();
$popupId = 0;
if (!empty($_GET['post'])) {
	$popupId = $_GET['post'];
};
$popups = YpmPopup\Popup::getPopupIdTitleData(array('exclude_ids' => array($popupId)));
?>
<div class="ycf-bootstrap-wrapper">
	<div class="row form-group">
		<div class="col-md-6">
			<label class="ypm-label-of-switch"><?php _e('After expiration', YPM_POPUP_TEXT_DOMAIN)?></label>
		</div>
		<div class="col-md-6">
		</div>
	</div>
	<div class="ypm-multichoice-wrapper">
		<?php
		$multipleChoiceButton = new MultipleChoiceButton($defaults['subscription-after'], esc_attr($popupTypeObj->getOptionValue('ypm-popup-subscription-behavior')));
		echo $multipleChoiceButton;
		?>
	</div>
	<div id="ypm-popup-subscription-message" class="ypm-sub-options-wrapper ypm-hide">

		<div class="row form-group">
			<div class="col-md-12">
				<?php
				$content = $popupTypeObj->getOptionValue('ypm-popup-subscription-expiration-message');
				$editorId = 'ypm-popup-subscription-expiration-message';
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
		<div class="row form-group">
			<div class="col-md-6">
				<label for="ypm-popup-subscription-enable-redirect" class="ypm-label-of-switch"><?php _e('Enable redirect', YPM_POPUP_TEXT_DOMAIN); ?></label>
			</div>
			<div class="col-md-6">
				<label class="ypm-switch">
					<input type="checkbox" id="ypm-popup-subscription-enable-redirect" name="ypm-popup-subscription-enable-redirect" class="js-ypm-accordion js-ypm-time-status" <?php esc_attr_e($popupTypeObj->getOptionValue('ypm-popup-subscription-enable-redirect'));?>>
					<span class="ypm-slider ypm-round"></span>
				</label>
			</div>
		</div>
		<div class="ypm-accordion-content ypm-hide-content form-group">
			<div class="row form-group">
				<div class="col-md-6">
					<label for="ypm-popup-subscription-text-redirect-url"><?php _e('URL', YPM_POPUP_TEXT_DOMAIN)?></label>
				</div>
				<div class="col-md-6">
					<input id="ypm-popup-subscription-text-redirect-url" class="form-control" type="url" name="ypm-popup-subscription-text-redirect-url" placeholder="https://" value="<?php echo esc_url($popupTypeObj->getOptionValue('ypm-popup-subscription-text-redirect-url'))?>">
				</div>
			</div>
		</div>
	</div>
	<div id="ypm-popup-subscription-redirect" class="ypm-sub-options-wrapper ypm-hide">
		<div class="row form-group">
			<div class="col-md-6">
				<label for="ypm-popup-subscription-redirect-url"><?php _e('URL', YPM_POPUP_TEXT_DOMAIN)?></label>
			</div>
			<div class="col-md-6">
				<input id="ypm-popup-subscription-redirect-url" class="form-control" type="url" name="ypm-popup-subscription-redirect-url" placeholder="https://" value="<?php echo esc_url($popupTypeObj->getOptionValue('ypm-popup-subscription-redirect-url'))?>">
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-6">
				<label for="ypm-popup-subscription-redirect-url-tab" class="ypm-label-of-switch"><?php _e('Redirect to new tab', YPM_POPUP_TEXT_DOMAIN); ?></label>
			</div>
			<div class="col-md-6">
				<label class="ypm-switch">
					<input type="checkbox" id="ypm-popup-subscription-redirect-url-tab" name="ypm-popup-subscription-redirect-url-tab" class="ypm-accordion-checkbox" <?php echo $popupTypeObj->getOptionValue('ypm-popup-subscription-redirect-url-tab'); ?>>
					<span class="ypm-slider ypm-round"></span>
				</label>
			</div>
		</div>
	</div>
	<div id="ypm-popup-expiration-popup" class="ypm-sub-options-wrapper ypm-hide">
		<div class="row form-group">
			<div class="col-md-6">
				<label for="ypm-popup-subscription-popup"><?php _e('Select popup', YPM_POPUP_TEXT_DOMAIN)?></label>
			</div>
			<div class="col-md-6">
				<?php echo YpmFunctions::createSelectBox($popups, $popupTypeObj->getOptionValue('ypm-popup-subscription-popup'), array('name' => 'ypm-popup-subscription-popup', 'class' => 'js-basic-select form-control')); ?>
			</div>
		</div>
	</div>
</div>