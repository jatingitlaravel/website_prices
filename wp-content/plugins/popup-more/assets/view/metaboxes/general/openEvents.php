<?php
use YpmPopup\EventsConditionBuilder;
$savedData = $popupTypeObj->getOptionValue('ypm-events-settings');

$obj = new EventsConditionBuilder();
$obj->setSavedData($savedData);

?>
<div class="ycf-bootstrap-wrapper">
	<?php if(ypm_is_free()): ?>
		<?php require_once('openEventsFree.php'); ?>
	<?php endif;?>
	<?php echo $obj->render(); ?>
</div>