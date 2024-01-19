<?php
use YpmPopup\SpecialEventsConditionBuilder;
$savedData = $popupTypeObj->getOptionValue('ypm-popup-special-events-settings');

$obj = new SpecialEventsConditionBuilder();
$obj->setSavedData($savedData);

?>
<div class="ycf-bootstrap-wrapper">
	<?php echo $obj->render(); ?>
</div>