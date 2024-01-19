<?php
global $YpmDefaultsData;
$defaults = YpmPopupData::defaultsData();
$fbButtons = $defaults['fbButtons'];
$facebookLayout = $YpmDefaultsData['fblikeLayout'];
$fblikeAction = $YpmDefaultsData['fblikeAction'];
$fblikeSize = $YpmDefaultsData['fblikeSize'];
$fbLikeAlignment = $YpmDefaultsData['fbLikeAlignment'];
$savedData = $popupTypeObj->getOptionValue('ypm-facebook-type');
$options = array(
	'popupTypeObj' => $popupTypeObj,
	'viewPath' => YPM_POPUP_VIEW.'facebook-types/'
);
?>
<div class="ycf-bootstrap-wrapper">
	<?php
		if ($_GET['post']) {
			echo YpmAdminHelper::createTypePopupNotice(YPM_FACEBOOK_POST_TYPE, $_GET['post']);
		}
	?>
	<?php echo new TabBuilder($fbButtons, $savedData, $options);?>
	<input type="hidden" name="ypm-facebook-type" class="ypm-section-tabs" value="<?php echo esc_attr($savedData); ?>">
</div>