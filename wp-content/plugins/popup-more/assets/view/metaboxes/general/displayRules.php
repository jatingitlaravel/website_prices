<?php
use YpmPopup\DisplayConditionBuilder;
$savedData = $popupTypeObj->getOptionValue('ypm-display-settings');
$obj = new DisplayConditionBuilder();
$obj->setSavedData($savedData);
$type = '';
if (!empty($_GET['ypm_type'])) {
	$type = $_GET['ypm_type'];
}
if (empty($type)) {
	$type = $popupTypeObj->getOptionValue('ypm-popup-type');
}
$subId = 0;
if (!empty($_GET['ypm_module_id'])) {
	$subId = $_GET['ypm_module_id'];
}
if (empty($subId)) {
	$subId = $popupTypeObj->getOptionValue('ypm-popup-sub-id');
}
?>
<div class="ycf-bootstrap-wrapper">
	<?php echo $obj->render(); ?>
	<input type="hidden" name="ypm-popup-type" value="<?php esc_attr_e($type);?>">
	<input type="hidden" name="ypm-popup-sub-id" value="<?php esc_attr_e($subId);?>">
</div>