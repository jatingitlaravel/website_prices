<div class="ypm-free-options-wrapper ypm-pro-options-wrapper ycf-pro-wrapper">
	<div class="row">
		<div class="col-md-12">
			<?php echo UpgradeText('Upgrade Events in PRO Version') ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 ypm-free-condition-wrapper">
			<label><?php _e('Event', YPM_POPUP_TEXT_DOMAIN)?></label>
			<select class="js-ypm-select" disabled>
				<option>Scroll</option>
			</select>
		</div>
		<div class="col-md-3 ypm-free-condition-wrapper">
			<label><?php _e('Condition', YPM_POPUP_TEXT_DOMAIN)?></label>
			<select class="js-ypm-select" disabled>
				<option>Distance from top</option>
			</select>
		</div>
		<div class="col-md-3 ypm-free-condition-wrapper">
			<label><?php _e('Distance', YPM_POPUP_TEXT_DOMAIN); ?></label>
			<input class="form-control" placeholder="10px or 10%" disabled>
		</div>
		<div class="col-md-3">
			<label><?php __('Condition', YPM_POPUP_TEXT_DOMAIN)?></label>
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 ypm-free-condition-wrapper">
			<label><?php _e('Event', YPM_POPUP_TEXT_DOMAIN)?></label>
			<select class="js-ypm-select" disabled>
				<option>Exit intent</option>
			</select>
		</div>
		<div class="col-md-3 ypm-free-condition-wrapper">
			<label><?php _e('Mode', YPM_POPUP_TEXT_DOMAIN)?></label>
			<select class="js-ypm-select" disabled>
				<option>Soft</option>
			</select>
		</div>
		<div class="col-md-3 ypm-free-condition-wrapper">
		</div>
		<div class="col-md-3">
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 ypm-free-condition-wrapper">
			<label><?php _e('Event', YPM_POPUP_TEXT_DOMAIN)?></label>
			<select class="js-ypm-select" disabled>
				<option>Inactivity</option>
			</select>
		</div>
		<div class="col-md-3 ypm-free-condition-wrapper">
			<label><?php _e('Duration', YPM_POPUP_TEXT_DOMAIN)?></label>
			<input class="form-control" placeholder="Duration in seconds" disabled>
		</div>
		<div class="col-md-3 ypm-free-condition-wrapper">
		</div>
		<div class="col-md-3">
			<label><?php __('Condition', YPM_POPUP_TEXT_DOMAIN)?></label>
		</div>
	</div>
	<?php if(YPM_POPUP_PKG == YPM_POPUP_FREE): ?>
		<div class="ypm-pro-options">
		</div>
	<?php endif;?>
</div>