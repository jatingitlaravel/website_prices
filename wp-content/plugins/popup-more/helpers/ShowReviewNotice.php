<?php

class YpmShowReviewNotice
{
	private $isMaxOpenPopup = false;
	private $maxPopupInfo = array();
	public function __toString()
	{
		$content = '';
		$isPopupPage = $this->isPopupPage();

		if(!$isPopupPage) {
			return $content;
		}
		$this->allowOpenMaxViewedPopup();
		$allowToShow = $this->allowToShow();
		if (!$allowToShow) {
			return $content;
		}
		$notifications = array();
		$ajaxNonce = wp_create_nonce('ypmReviewNotice');
		if ($this->isMaxOpenPopup) {
			$notifications[] = $this->getMaxOpenPopup();
		}
		else {
			$notifications[] = $this->getReviewContent('usageDayes');
		}

		$content = '<div class="ypm-notification-center-wrapper">
						<h3><span class="dashicons dashicons-flag"></span> Notifications ('.count($notifications).')</h3>';

		foreach ($notifications as $notification) {
			$content .= '<div class="ypm-each-notification-wrapper-js">
							<div class="ypm-single-notification-wrapper">
								<div class="ypm-single-notification" style="border-color:#01B9FF !important;">
									<span class="dashicons dashicons-no-alt ypm-notification-close ypm-already-did-review" data-ajaxnonce="'.esc_attr($ajaxNonce).'"></span>'.
									$notification.'
								</div>
							</div>
						</div>';
		}
		$content .= '</div>';

		return $content;
	}

	private function isPopupPage() {

		return ypmTypeNow() == YPM_POPUP_POST_TYPE;
	}

	public function allowToShow()
	{
		return $this->allowToShowUsageDays() || $this->isMaxOpenPopup;
	}

	private function allowOpenMaxViewedPopup() {
		$popupIds = get_posts(array(
			'fields'          => 'ids',
			'posts_per_page'  => -1,
			'post_type' => YPM_POPUP_POST_TYPE
		));
		$maxOpenedPopupInfo = array('max' => 0, 'popup' => 0);
		foreach ($popupIds as $popupId) {
			$count = (int)get_option('YpmPopupCount'.$popupId);
			if ($count > $maxOpenedPopupInfo['max']) {
				$maxOpenedPopupInfo['max'] = $count;
				$maxOpenedPopupInfo['popup'] = $popupId;
			}
		}

		if ($maxOpenedPopupInfo['max'] >= YPM_MAX_OPEN_POPUP) {
			$this->isMaxOpenPopup = true;
			$this->maxPopupInfo = $maxOpenedPopupInfo;
		}
	}


	private function allowToShowUsageDays()
	{
		$shouldOpen = true;

		$dontShowAgain = get_option('YpmDontShowReviewNotice');
		$periodNextTime = get_option('YpmShowNextTime');

		if($dontShowAgain) {
			return !$shouldOpen;
		}

		// When period next time does not exits it means the user is old
		if(!$periodNextTime) {
			YpmShowReviewNotice::setInitialDates();

			return !$shouldOpen;
		}
		$currentData = new DateTime('now');
		$timeNow = $currentData->format('Y-m-d H:i:s');
		$timeNow = strtotime($timeNow);

		return $periodNextTime < $timeNow;
	}

	private function getReviewContent($type)
	{
		return $this->getMaxOpenDaysMessage($type);
		ob_start();
		?>
		<div id="welcome-panel" class="welcome-panel ypm-review-block">
			<div class="welcome-panel-content" id="ypm-welcome-panel-wrapper">
				<?php echo $content; ?>
			</div>
		</div>


		<?php
		$reviewContent = ob_get_contents();
		ob_end_clean();

		return $reviewContent;
	}

	private function getMainTableCreationDate()
	{
		global $wpdb;

		$query = $wpdb->prepare('SELECT table_name, create_time FROM information_schema.tables WHERE table_schema="%s" AND  table_name="%s"', DB_NAME, $wpdb->prefix.'expm_maker');
		$results = $wpdb->get_results($query, ARRAY_A);

		if(empty($results)) {
			return 0;
		}

		$createTime = $results[0]['create_time'];
		$createTime = strtotime($createTime);
		update_option('YpmInstallDate', $createTime);
		$diff = time()-$createTime;
		$days  = floor($diff/(60*60*24));

		return $days;
	}

	private function getPopupUsageDays()
	{
		$installDate = get_option('YpmInstallDate');

		$timeDate = new DateTime('now');
		$timeNow = strtotime($timeDate->format('Y-m-d H:i:s'));

		$diff = $timeNow-$installDate;

		$days  = floor($diff/(60*60*24));

		return $days;
	}

	private function getMaxOpenPopup() {
		$getUsageDays = $this->getPopupUsageDays();
		$firstHeader = '<h1 class="ypm-review-h1"><strong class="ypm-review-strong">Wow!</strong> <a href="'.YPM_REVIEW_URL.'" target="_blank"><b>Popup More</b></a> plugin helped you to share your message via <strong class="ypm-review-strong">'.esc_attr(get_the_title($this->maxPopupInfo['popup'])).'</strong> popup with your users for <strong class="sgrb-review-strong">'.esc_attr($this->maxPopupInfo['max']).' times!</strong></h1>';
		$popupContent = $this->getMaxOepnContent($firstHeader, 'maxOpenPopups');

		$popupContent .= $this->showReviewBlockJs();

		return $popupContent;
	}

	private  function getMaxOpenDaysMessage($type)
	{
		$ajaxNonce = wp_create_nonce('ypmReviewNotice');
		$getUsageDays = $this->getPopupUsageDays();
		$firstHeader = '<h1 class="ypm-review-h1"><strong class="ypm-review-strong">Wow!</strong> You’ve been using <a href="'.YPM_REVIEW_URL.'" target="_blank">Popup More</a> on your site for '.$getUsageDays.' days</h1>';
		$popupContent = $this->getMaxOepnContent($firstHeader, $type);

		$popupContent .= $this->showReviewBlockJs();

		return $popupContent;
	}

	private function getMaxOepnContent($firstHeader, $type)
	{
		$ajaxNonce = wp_create_nonce('ypmReviewNotice');

		ob_start();
		?>
		<style>
			#ypm-welcome-panel-wrapper {
				min-height: inherit !important;
			}
			.ypm-buttons-wrapper .press{
				box-sizing:border-box;
				cursor:pointer;
				display:inline-block;
				font-size:1em;
				margin:0;
				padding:0.5em 0.75em;
				text-decoration:none;
				transition:background 0.15s linear
			}
			.ypm-buttons-wrapper .press-grey {
				background-color:#9E9E9E;
				border:2px solid #9E9E9E;
				color: #FFF;
			}
			.ypm-buttons-wrapper .press-grey:hover {
				color: #9E9E9E;
				background-color:#FFF;
			}
			.ypm-buttons-wrapper .press-lightblue {
				background-color:#03A9F4;
				border:2px solid #03A9F4;
				color: #FFF;
			}
			.ypm-buttons-wrapper .press-lightblue:hover {
				color: #03A9F4;
				background-color:#FFF;
			}
			.ypm-review-wrapper{
				text-align: center;
				padding: 20px;
			}
			.ypm-review-wrapper p {
				color: black;
			}
			.ypm-review-h1 {
				font-size: 22px;
				font-weight: normal;
				line-height: 1.384;
				margin-top: 0;
			}
			.ypm-review-h2{
				font-size: 20px;
				font-weight: normal;
			}
			:root {
				--main-bg-color: #1ac6ff;
			}
			.ypm-review-strong{
				color: var(--main-bg-color);
			}
			.ypm-review-mt20{
				margin-top: 20px
			}
			.ypm-review-block {
				padding-top: 0;
			}
			.ypm-notification-close {
				float: right;
			}
			.ypm-notification-close:hover {
				cursor: pointer;
				background-color: #cccccca3;
			}
			.ypm-notification-center-wrapper {
				margin-right: 21px;
				padding: 20px 20px 0 !important;
				border: 1px solid #e5e5e5;
				background-color: #fdfdfd;
				box-shadow: 0 1px 1px rgba(0, 0, 0, .04)
			}
			.ypm-notification-center-wrapper h3 {
				border-bottom: 1px solid #ccc;
				padding-bottom: 15px;
				padding-left: 20px
			}
			.ypm-notification-center-wrapper .dashicons-flag {
				color: #01B9FF
			}
			.ypm-single-notification-wrapper {
				width: 100%;
				display: inline-block;
				padding: 0 20px
			}
			.ypm-each-notification-wrapper-js .ypm-single-notification-wrapper:not(:first-child) {
				margin: 10px 0 0
			}
			.ypm-single-notification-wrapper {
				margin-left: 2px !important
			}
			.ypm-single-notification {
				display: inline-block;
				width: 88%;
				min-height: 25px;
				float: left;
				line-height: 1.4;
				padding: 11px 15px;
				font-size: 14px;
				text-align: left;
				background-color: #fff;
				border-left: 4px solid #01B9FF;
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .2)
			}
			.ypm-single-notification-close-btn {
				width: 8%;
				float: right
			}
			.ypm-single-notification-wrapper .button.dismiss {
				flex: 0 0 45px;
				width: 45px;
				height: 45px;
				margin-left: 10px;
				line-height: inherit;
				padding: 0;
				outline: none;
				cursor: pointer
			}
			.ypm-each-notification-wrapper-js {
				padding-bottom: 15px;
			}

		</style>
		<div class="ypm-review-wrapper">
			<div class="ypm-review-description">
				<?php echo $firstHeader; ?>
				<h2 class="ypm-review-h2">This is really great for your website score.</h2>
				<p class="ypm-review-mt20">Have your input in the development of our plugin, and we’ll provide better conversions for your site!<br /> Leave your 5-star positive review and help us go further to the perfection!</p>
			</div>
			<div class="ypm-buttons-wrapper">
				<button class="press press-grey ypm-button-1 ypm-already-did-review" data-ajaxnonce="<?php echo esc_attr($ajaxNonce); ?>">I already did</button>
				<button class="press press-lightblue ypm-button-3 ypm-already-did-review" data-ajaxnonce="<?php echo esc_attr($ajaxNonce); ?>" onclick="window.open('<?php echo YPM_REVIEW_URL; ?>')">You worth it!</button>
				<button class="press press-grey ypm-button-2 ypm-show-popup-period" data-ajaxnonce="<?php echo esc_attr($ajaxNonce); ?>" data-message-type="<?php echo $type; ?>">Maybe later</button>
			</div>
		</div>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	private function showReviewBlockJs()
	{
		ob_start();
		?>
		<script type="text/javascript">
			var closeYpmPopup = function () {
				if (typeof jQuery.ypmcolorbox != 'undefined') {
					jQuery.ypmcolorbox.close()
				}
			};
			var ypmCloseNotifications = function () {
				jQuery('.ypm-notification-center-wrapper').remove();
				jQuery('.ypm-notification-icon').remove();
			}
			jQuery('.ypm-already-did-review').each(function () {
				jQuery(this).on('click', function () {
					var ajaxNonce = jQuery(this).attr('data-ajaxnonce');

					var data = {
						action: 'ypm_dont_show_review_notice',
						ajaxNonce: ajaxNonce
					};
					jQuery.post(ajaxurl, data, function(response,d) {
						if(jQuery('.ypm-review-block').length) {
							jQuery('.ypm-review-block').remove();
							closeYpmPopup();
						}
						ypmCloseNotifications();
					});
				});
			});

			jQuery('.ypm-show-popup-period').on('click', function () {
				var ajaxNonce = jQuery(this).attr('data-ajaxnonce');
				var messageType = jQuery(this).attr('data-message-type');

				var data = {
					action: 'ypm_change_review_show_period',
					messageType: messageType,
					ajaxNonce: ajaxNonce
				};
				jQuery.post(ajaxurl, data, function(response,d) {
					if(jQuery('.ypm-review-block').length) {
						jQuery('.ypm-review-block').remove();
						closeYpmPopup();
					}
					ypmCloseNotifications();
				});
			});
		</script>
		<?php
		$script = ob_get_contents();
		ob_end_clean();

		return $script;
	}

	public static function setInitialDates()
	{
		$usageDays = get_option('YpmUsageDays');
		if(!$usageDays) {
			update_option('YpmUsageDays', 0);

			$timeDate = new DateTime('now');
			$installTime = strtotime($timeDate->format('Y-m-d H:i:s'));
			update_option('YpmInstallDate', $installTime);
			$timeDate->modify('+'.YPM_SHOW_REVIEW_PERIOD.' day');

			$timeNow = strtotime($timeDate->format('Y-m-d H:i:s'));
			update_option('YpmShowNextTime', $timeNow);
		}
	}

	public static function deleteInitialDates()
	{
		delete_option('YpmDontShowReviewNotice');
		delete_option('YpmUsageDays');
		delete_option('YpmInstallDate');
		delete_option('YpmShowNextTime');
	}
}