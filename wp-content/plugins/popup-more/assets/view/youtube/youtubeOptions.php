<?php
$defaults = YpmPopupData::defaultsData();
?>
<div class="ycf-bootstrap-wrapper">
	<?php
	if ($_GET['post']) {
		echo YpmAdminHelper::createTypePopupNotice(YPM_YOUTUBE_POST_TYPE, $_GET['post']);
	}
	?>
	<div class="row ypm-margin-bottom-15">
		<div class="col-md-6">
			<label class="ypm-youtube-url"><?php _e('URL', YPM_POPUP_TEXT_DOMAIN); ?></label><br>
		</div>
		<div class="col-md-6">
			<input type="text" name="ypm-youtube-url" id="ypm-youtube-url" class="form-control" value="<?php echo $popupTypeObj->getOptionValue('ypm-youtube-url'); ?>" placeholder="https://www.youtube.com/watch?v=">
		</div>
	</div>
	<div class="row ypm-margin-bottom-15">
		<div class="col-md-6">
			<label class="ypm-youtube-width"><?php _e('Width', YPM_POPUP_TEXT_DOMAIN); ?></label><br>
		</div>
		<div class="col-md-6">
			<input type="text" name="ypm-youtube-width" id="ypm-youtube-width" class="form-control ypm-youtube-dimension" data-type="width" value="<?php echo $popupTypeObj->getOptionValue('ypm-youtube-width'); ?>">
		</div>
	</div>
	<div class="row ypm-margin-bottom-15">
		<div class="col-md-6">
			<label class="ypm-youtube-height"><?php _e('Height', YPM_POPUP_TEXT_DOMAIN); ?></label><br>
		</div>
		<div class="col-md-6">
			<input type="text" name="ypm-youtube-height" id="ypm-youtube-height" class="form-control ypm-youtube-dimension" data-type="height" value="<?php echo $popupTypeObj->getOptionValue('ypm-youtube-height'); ?>">
		</div>
	</div>
	<div class="row ypm-margin-bottom-15">
		<div class="col-md-6">
			<label class="ypm-youtube-start"><?php _e('Start', YPM_POPUP_TEXT_DOMAIN); ?></label><br>
		</div>
		<div class="col-md-6">
			<input type="text" name="ypm-youtube-start" id="ypm-youtube-start" class="form-control ypm-youtube-dimension" data-type="height" value="<?php echo $popupTypeObj->getOptionValue('ypm-youtube-start'); ?>">
		</div>
	</div>
	<!-- PRO options start -->
	<?php
		$classNameProWrapper = '';
		if (YPM_POPUP_PKG == YPM_POPUP_FREE) {
			$classNameProWrapper = 'ypm-pro-options-wrapper';
		}
	?>
	<div class="<?php echo $classNameProWrapper; ?>">
		<div class="row ypm-margin-bottom-15">
			<div class="col-md-6">
				<label class="ypm-youtube-height"><?php _e('Autoplay', YPM_POPUP_TEXT_DOMAIN); ?></label><br>
			</div>
			<div class="col-md-6">
				<label class="ypm-switch">
					<input type="checkbox" id="ypm-youtube-autoplay" name="ypm-youtube-autoplay" <?php echo $popupTypeObj->getOptionValue('ypm-youtube-autoplay'); ?>>
					<span class="ypm-slider ypm-round"></span>
				</label>
			</div>
		</div>
		<div class="row ypm-margin-bottom-15">
			<div class="col-md-6">
				<label class="ypm-youtube-controls" for="ypm-youtube-controls"><?php _e('Controls', YPM_POPUP_TEXT_DOMAIN); ?></label><br>
			</div>
			<div class="col-md-6">
				<label class="ypm-switch">
					<input type="checkbox" id="ypm-youtube-controls" name="ypm-youtube-controls" <?php echo $popupTypeObj->getOptionValue('ypm-youtube-controls'); ?>>
					<span class="ypm-slider ypm-round"></span>
				</label>
			</div>
		</div>
		<div class="row ypm-margin-bottom-15">
			<div class="col-md-6">
				<label class="ypm-youtube-related-video" for="ypm-youtube-related-video"><?php _e('Color', YPM_POPUP_TEXT_DOMAIN); ?></label><br>
			</div>
			<div class="col-md-6">
				<?php echo YpmFunctions::createSelectBox($defaults['youtubeColors'], $popupTypeObj->getOptionValue('ypm-youtube-color'), array('name' => 'ypm-youtube-color', 'class' => 'js-basic-select form-control')); ?>
			</div>
		</div>
		<?php require_once(dirname(__FILE__).'/afterExpire.php'); ?>
		<?php if (YPM_POPUP_PKG == YPM_POPUP_FREE): ?>
		<a href="<?php echo YPM_POPUP_PRO_URL; ?>" target="_blank">
			<div class="ypm-pro ypm-pro-options-div" style="text-align: right">
				<button class="ypm-upgrade-button-red ypm-extension-pro">
					<b class="h2">Unlock</b><br><span class="h5">PRO features</span>
				</button>
			</div>
		</a>
		<?php endif; ?>
	</div>
	<!-- PRO options end -->
	<?php
		require_once(YPM_POPUP_VIEW.'preview.php');
	?>
</div>
