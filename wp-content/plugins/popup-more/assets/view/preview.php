<div class="ypm-live-preview" id="ypm-live-preview">
	<div class="ypm-live-preview-text">
		<h3><?php _e('Live preview',YPM_POPUP_TEXT_DOMAIN)?></h3>
		<div class="ypm-toggle-icon ypm-toggle-icon-open"></div>
	</div>
	<div class="ypm-live-preview-content">
		<?php
		if(method_exists($popupTypeObj, 'renderLivePreview')) {
			$popupTypeObj->renderLivePreview();
		}
		?>
	</div>
</div>