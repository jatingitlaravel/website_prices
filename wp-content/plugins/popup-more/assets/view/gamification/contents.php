<?php
$tyneMceArgs = YpmAdminHelper::getTyneMceArgs();
?>
<div class="row form-group">
	<div class="col-md-12">
		<div class="form-group row">
			<label class="col-md-12 control-label">
				<?php _e('Main screen message', YPM_POPUP_TEXT_DOMAIN); ?>:
			</label>
		</div>
		<?php
		$editorId = 'ypm-gamification-start-text';
		$content = $popupTypeObj->getOptionValue($editorId);
		wp_editor(stripslashes($content), $editorId, $tyneMceArgs);
		?>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-12">
		<div class="form-group row">
			<label class="col-md-12 control-label">
				<?php _e('Play screen message', YPM_POPUP_TEXT_DOMAIN); ?>:
			</label>
		</div>
		<?php
		$editorId = 'ypm-gamification-play-text';
		$content = $popupTypeObj->getOptionValue($editorId);
		wp_editor($content, $editorId, $tyneMceArgs);
		?>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-12">
		<div class="form-group row">
			<label class="col-md-12 control-label">
				<?php _e('Win screen message', YPM_POPUP_TEXT_DOMAIN); ?>:
			</label>
		</div>
		<?php
		$editorId = 'ypm-gamification-win-text';
		$content = $popupTypeObj->getOptionValue($editorId);
		wp_editor($content, $editorId, $tyneMceArgs);
		?>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-12">
		<div class="form-group row">
			<label class="col-md-12 control-label">
				<?php _e('Lose screen message', YPM_POPUP_TEXT_DOMAIN); ?>:
			</label>
		</div>
		<?php
		$editorId = 'ypm-gamification-lose-text';
		$content = $popupTypeObj->getOptionValue($editorId);
		wp_editor($content, $editorId, $tyneMceArgs);
		?>
	</div>
</div>