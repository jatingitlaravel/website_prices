<?php
use YpmPopup\SubscriptionPopup as Subscription;
use ypmDataTable\Subscribers as SubscribersTable;
$subscriptionsList = Subscription::getAllSubscriptionForms();
?>
<div class="popup-type-sub-options-wrapper">
	<div id="ypm-subscription-content">
		<div class="ycf-bootstrap-wrapper">
			<h3><?php _e('Select Subscription form to export', YPM_POPUP_TEXT_DOMAIN)?></h3>
			<select name="ypm-subscription-id" id="ypm-subscription-id">
				<?php
				$list .= '<option value="all">'.__('All subscriptions', YPM_POPUP_TEXT_DOMAIN).'</option>';
				foreach ($subscriptionsList as $id => $postTitle) {

					$selected = '';

					$list .= '<option value="'.esc_attr($id).'"'.esc_attr($selected).'>'.esc_attr($postTitle).'</option>';
				}
				echo $list;
				?>
			</select>
			<div class="create-button-wrapper">
				<button class="btn btn-success ypm-export-subscriptions">Export Subscription</button>
			</div>
		</div>
	</div>
</div>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e('Export Subscriptions', YPM_POPUP_TEXT_DOMAIN)?></h1>
	<a class="page-title-action ypm-export-link"><?php _e('Export', YPM_POPUP_TEXT_DOMAIN)?></a>
<?php
	$table = new SubscribersTable();
	echo $table;
	$list = '';
?>
	<div class="ycf-bootstrap-wrapper">

	</div>
</div>
