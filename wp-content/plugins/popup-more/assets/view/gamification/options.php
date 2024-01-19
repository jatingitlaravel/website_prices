<?php
$winChance = YpmAdminHelper::winningChance();
?>
<div class="row form-group">
	<label class="col-md-6 control-label">
		<?php _e('Winning chance', YPM_POPUP_TEXT_DOMAIN); ?>
		<?php if(ypm_is_free()): ?>
			<?php echo YpmAdminHelper::proSpan(); ?>
		<?php endif;?>
		:
	</label>
	<div class="col-md-6">
		<?php if(!ypm_is_free()): ?>
			<?php echo YpmFunctions::createSelectBox($winChance, esc_html($popupTypeObj->getOptionValue('ypm-gamification-win-chance')), array('name' => 'ypm-gamification-win-chance', 'class'=>'js-ypm-select2')); ?>
		<?php endif; ?>

		<?php if(ypm_is_free()): ?>
			<?php echo YpmFunctions::createSelectBox(array('0' => '0%'), esc_html($popupTypeObj->getOptionValue('ypm-gamification-win-chance')), array('name' => 'ypm-gamification-win-chance', 'class'=>'js-ypm-select2', 'disabled' => true)); ?>
		<?php endif; ?>
	</div>
</div>

<div class="row form-group">
	<label class="col-md-6 control-label" for="ypm-gamification-already-subscribed">
		<?php _e('Hide for already played users', YPM_POPUP_TEXT_DOMAIN); ?>:
	</label>
	<div class="col-md-6">
		<label class="ypm-switch">
			<input type="checkbox" id="ypm-gamification-already-subscribed" name="ypm-gamification-already-subscribed" class="ypm-accordion-checkbox" <?php echo $popupTypeObj->getOptionValue('ypm-gamification-already-subscribed'); ?>>
			<span class="ypm-slider ypm-round"></span>
		</label>
	</div>
</div>