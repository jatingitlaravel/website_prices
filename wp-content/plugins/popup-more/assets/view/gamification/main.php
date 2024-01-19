<?php
require_once(YPM_POPUP_HELPERS."/Tabs.php");
use ypmgamification\Tabs;
$tyneMceArgs = YpmAdminHelper::getTyneMceArgs();
$settingsTab = YpmAdminHelper::getGamificationSettingsTabConfig();
?>
<div class="ycf-bootstrap-wrapper">
	<div class="row">
		<div class="col-md-8">
			<div class="ypm-tabs-content-wrapper">
				<?php
				$tabName = 'contents';
				if (!empty($_GET['ypmPageKeyTab'])) {
					$tabName = $_GET['ypmPageKeyTab'];
				}
				else if (!empty($_COOKIE['YPMGamificationActiveTab'])) {
					$tabName = $_COOKIE['YPMGamificationActiveTab'];
				}
				$tabs = Tabs::create($settingsTab, $tabName, $popupTypeObj);
				echo $tabs->render();
				?>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
	<!-- Input styles start -->
</div>
