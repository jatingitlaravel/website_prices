<div class="ycf-bootstrap-wrapper">
	<div class="row">
		<div class="col-md-12">

			<?php
			$postId = (int)@$_GET['post'];
			if (empty($postId)) : ?>
				<label>
					<?php _e('Shortcode', YPM_POPUP_TEXT_DOMAIN); ?>
				</label>
				<p class="no-shortcode">Please do save the Popup, to getting the shortcode.</p>
			<?php else:
				$shortCodeKey = $popupTypeObj->shortCodeName;
				$shortcodeLabel = 'Shortcode';
				$eventStr = '';
				if ($shortCodeKey == 'ypm_popup') {
					$shortcodeLabel = 'Onload Shortcode';
				}
				?>
				<label>
					<?php _e($shortcodeLabel, YPM_POPUP_TEXT_DOMAIN); ?>
				</label>
				<?php
				$shortCodeName = '['.$shortCodeKey.' id="'.$postId.'" '.$eventStr.']';
				echo YpmAdminHelper::copyClipboard($postId, $shortCodeName);

				?>

					<label>
						<?php _e("Insert popup via PHP", YPM_POPUP_TEXT_DOMAIN); ?>
					</label>
				<?php
					$shortCodeName = '['.$shortCodeKey.' id="'.$postId.'" '.$eventStr.']';

				echo YpmAdminHelper::copyClipboard($postId, "<?php echo do_shortcode(\"$shortCodeName\"); ?>", 'php');
					if ($shortCodeKey == 'ypm_popup'): ?>
						<label class="ypm-margin-top-10">
							<?php _e('Click Shortcode', YPM_POPUP_TEXT_DOMAIN); ?>
						</label>
						<?php
						$shortCodeName = '['.$shortCodeKey.' id="'.$postId.'" event="click"]Click here[/'.$shortCodeKey.']';
						echo YpmAdminHelper::copyClipboard($postId, $shortCodeName, 'click');
					?>
						<label class="ypm-margin-top-10">
							<?php _e('Hover Shortcode', YPM_POPUP_TEXT_DOMAIN); ?>
						</label>
						<?php
						$shortCodeName = '['.$shortCodeKey.' id="'.$postId.'" event="hover"]Click here[/'.$shortCodeKey.']';
						echo YpmAdminHelper::copyClipboard($postId, $shortCodeName, 'hover');
					endif;
				endif; ?>

		</div>
	</div>
</div>