<?php
namespace YpmPopup;

use \ypm\Updates;
use ypmFrontend\PopupLoader;
use \YpmFunctions;
use \YpmShowReviewNotice;

class Actions
{
	private $postTypeObj;

	public function setPostTypeObj($postTypeObj)
	{
		$this->postTypeObj = $postTypeObj;
	}

	public function getPostTypeObj()
	{
		return $this->postTypeObj;
	}

	public function __construct()
	{
		$this->init();
	}

	public function init()
	{
		add_action('init', array($this, 'postTypeInit'));
		add_action('admin_init', array($this, 'removeWpEditorFormSomePopupTypes'));
		add_action('add_meta_boxes', array($this, 'addMetaBoxes'));
		register_activation_hook(YPM_MAIN_FILE, array($this, 'activate'));
		add_action('upgrader_post_install', array($this, 'pluginUpgradeCompleted'), 10, 2);
		register_deactivation_hook(YPM_MAIN_FILE, array($this, 'deactivate'));
		register_uninstall_hook(YPM_MAIN_FILE, array(__CLASS__, 'uninstall'));
		add_action('admin_init', array($this, 'pluginRedirect'));

		add_action('save_post', 'YpmSavePopup::savePopupData', 10, 3);
		add_action('admin_enqueue_scripts', 'YpmPopup\Style::enqueueStyles');

		add_shortcode('ypm_popup', array($this, 'ypmShortCode'));
		add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
		add_action('media_buttons', array($this, 'ypmPopupMediaButton'), 11);
		add_action('media_buttons', array($this, 'ypmPopupMediaModules'), 11);
		add_action('admin_footer', array($this, 'ypmPopupMediaButtonThickboxs'));
		add_action('admin_footer', array($this, 'ypmPopupModulesTickboxs'));
		add_action('add_meta_boxes', array($this, 'pageSelection'));
		add_action('plugins_loaded', array($this, 'ypmPluginLoaded'));
		add_action('admin_action_ypm_duplicate_post_as_draft', array($this, 'duplicatePostSave'));

		add_action('admin_head', array($this, 'adminHead'));
		add_filter('pll_get_post_types', array($this, 'addCptToPll'), 10, 2);
		add_action('default_content', array($this, 'add_default_content_to_wp_editor'));

		$this->reviewNotice();
		add_action('admin_menu', array($this, 'append_alert_count'), 999);
	}

	public function add_default_content_to_wp_editor($content)
	{
		if (!empty($_GET['ypm_type']) && !empty($_GET['ypm_module_id'])) {
			$shortcodeKey = str_replace(
				'ypm',
				'',
				$_GET['ypm_type']
			);

			$content = "[ypm_" . esc_attr($shortcodeKey) . " id='" . esc_attr($_GET['ypm_module_id']) . "']";
		}

		return $content;
	}

	public function addCptToPll($postTypes, $hide)
	{
		$postTypes[YPM_POPUP_POST_TYPE] = YPM_POPUP_POST_TYPE;

		return $postTypes;
	}

	public function duplicatePostSave()
	{
		global $wpdb;
		if (!(isset($_GET['post']) || isset($_POST['post']) || (isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action']))) {
			wp_die('No post to duplicate has been supplied!');
		}
		/*
		 * Nonce verification
		 */
		if (!isset($_GET['duplicate_nonce']) || !wp_verify_nonce($_GET['duplicate_nonce'], YPM_POPUP_POST_TYPE))
			return;

		/*
		 * get the original post id
		 */
		$post_id = (int)(isset($_GET['post']) ? absint($_GET['post']) : absint($_POST['post']));
		/*
		 * and all the original post data then
		 */
		$post = get_post($post_id);

		/*
		 * if you don't want current user to be the new post author,
		 * then change next couple of lines to this: $new_post_author = $post->post_author;
		 */
		$current_user = wp_get_current_user();
		$new_post_author = $current_user->ID;

		/*
		 * if post data exists, create the post duplicate
		 */
		if (isset($post) && $post != null) {

			/*
			 * new post data array
			 */
			$args = array(
				'comment_status' => $post->comment_status,
				'ping_status' => $post->ping_status,
				'post_author' => $new_post_author,
				'post_content' => $post->post_content,
				'post_excerpt' => $post->post_excerpt,
				'post_name' => $post->post_name,
				'post_parent' => $post->post_parent,
				'post_password' => $post->post_password,
				'post_status' => 'publish',
				'post_title' => $post->post_title . '(clone)',
				'post_type' => $post->post_type,
				'to_ping' => $post->to_ping,
				'menu_order' => $post->menu_order
			);

			/*
			 * insert the post by wp_insert_post() function
			 */
			$new_post_id = wp_insert_post($args);

			/*
			 * get all current post terms ad set them to the new post draft
			 */
			$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
			foreach ($taxonomies as $taxonomy) {
				$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
				wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
			}

			/*
			 * duplicate all post meta just in two SQL queries
			 */
			$post_meta_infos = $wpdb->get_results($wpdb->prepare("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=%d", $post_id));
			if (count($post_meta_infos) != 0) {
				$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
				foreach ($post_meta_infos as $meta_info) {
					$meta_key = $meta_info->meta_key;
					if ($meta_key == '_wp_old_slug') continue;
					$meta_value = $meta_info->meta_value;
					$sql_query_sel[] = $wpdb->prepare("SELECT %d, %s, %s", $new_post_id, $meta_key, $meta_value);
				}
				$sql_query .= implode(" UNION ALL ", $sql_query_sel);

				$wpdb->query($sql_query);
			}


			/*
			 * finally, redirect to the edit post screen for the new draft
			 */
			wp_redirect(admin_url('edit.php?post_type=' . YPM_POPUP_POST_TYPE));
			exit;
		} else {
			wp_die('Post creation failed, could not find original post: ' . $post_id);
		}
	}

	public function ypmPopupMediaButton()
	{
		if (!get_option('ypm-hide-media-button')) {
			YpmMediaButton::addMediaButton();
		}
	}

	public function ypmPopupMediaModules()
	{
		YpmMediaButton::addMediaModuleButton();
	}

	public function ypmPopupMediaButtonThickboxs()
	{
		YpmMediaButton::ypmThickbox();
	}

	public function ypmPopupModulesTickboxs()
	{
		YpmMediaButton::ypmModulesThickbox();
	}

	public function ypmShortCode($args, $content)
	{
		$obj = new YpmShortcode();

		$obj->setAttrs($args);
		$obj->setContent($content);

		return $obj->render();
	}

	public function enqueueScripts()
	{
		$popupLoaderObj = PopupLoader::instance();
		if (is_object($popupLoaderObj)) {
			$popupLoaderObj->loadPopups();
		}
	}

	public function postTypeInit()
	{
		add_action('wp_head', array($this, 'ypmHeadAction'));
		$postType = new \YpmRegistration();
		$this->setPostTypeObj($postType);
		if (!ypm_is_free()) {
			new Updates();
		}
		require_once(dirname(__FILE__).'/admin/ElementorWidget.php');
	}

	public function removeWpEditorFormSomePopupTypes()
	{
		$remove = false;

		if (!empty($_GET['ypm_type']) && in_array($_GET['ypm_type'], array(YPM_IMAGE_POST_TYPE, YPM_LINK_POST_TYPE, YPM_GAMIFICATION_POST_TYPE))  && $_GET['post_type'] === YPM_POPUP_POST_TYPE) {
			if ($_GET['ypm_type'] === YPM_IMAGE_POST_TYPE) {
				$popupTypeObj = Popup::findByIdAndType('image', 0);
			}
			else if ($_GET['ypm_type'] === YPM_LINK_POST_TYPE) {
				$popupTypeObj = Popup::findByIdAndType('link', 0);
			}
			else if ($_GET['ypm_type'] === YPM_GAMIFICATION_POST_TYPE) {
				$popupTypeObj = Popup::findByIdAndType('gamification', 0);
			}

			$remove = true;
		} else if (!empty($_GET['post'])) {
			$postType = get_post_type($_GET['post']);
			if ($postType === YPM_POPUP_POST_TYPE) {
				$popupSavedData = Popup::getSavedData($_GET['post']);
//				$popupTypeObj = Popup::findByIdAndType('image',$_GET['post']);
//				$popupType = $popupTypeObj->getOptionValue('ypm-popup-type');
				if ($popupSavedData['ypm-popup-type'] === YPM_IMAGE_POST_TYPE) {
					$popupTypeObj = Popup::findByIdAndType('image', $_GET['post']);
				}
				if ($popupSavedData['ypm-popup-type'] === YPM_LINK_POST_TYPE) {
					$popupTypeObj = Popup::findByIdAndType('link', $_GET['post']);
				}
				if ($popupSavedData['ypm-popup-type'] === YPM_GAMIFICATION_POST_TYPE) {
					$popupTypeObj = Popup::findByIdAndType('gamification', $_GET['post']);
				}
				if (in_array($popupSavedData['ypm-popup-type'], array(YPM_IMAGE_POST_TYPE, YPM_LINK_POST_TYPE, YPM_GAMIFICATION_POST_TYPE))) {
					$remove = true;
				}
			}
		}

		if ($remove) {
			remove_post_type_support(YPM_POPUP_POST_TYPE, 'editor');
		}
		DataConfig::init();
	}

	public function addMetaBoxes()
	{
		$this->getPostTypeObj()->addMetaBoxes();

		if (YPM_POPUP_PKG == YPM_POPUP_FREE) {
			$this->getPostTypeObj()->upgradeToProMetabox();
		}

		$typeObj = $this->getPostTypeObj();

		$metaboxes = array(
			'popup_master_display_rules' => array(
				'support_post_type' => array(YPM_POPUP_POST_TYPE),
				'label' => __('Display rules', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'popupDisplayRules')
			),
			'popup_master_open_events' => array(
				'support_post_type' => array(YPM_POPUP_POST_TYPE),
				'label' => __('Open events', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'popupOpenEvents')
			),
			'popup_master_dimension' => array(
				'support_post_type' => array(YPM_POPUP_POST_TYPE),
				'label' => __('Popup dimensions', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'popupDimensionsOptions')
			),
			'popup_master_options' => array(
				'support_post_type' => array(YPM_POPUP_POST_TYPE),
				'label' => __('General', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'popupGeneralOptions')
			),
			'popup_master_close_behavior' => array(
				'support_post_type' => array(YPM_POPUP_POST_TYPE),
				'label' => __('Close behavior', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'popupCloseBehavior')
			),
			'popup_master_settings' => array(
				'support_post_type' => array(YPM_POPUP_POST_TYPE),
				'label' => __('Settings', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'popupGeneralSettings')
			),
			'popup_master_exit' => array(
				'support_post_type' => array(YPM_POPUP_POST_TYPE),
				'label' => __('Exit intent', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'popupExitIntent')
			),
			'popup_master_customFunctionality' => array(
				'support_post_type' => array(YPM_POPUP_POST_TYPE),
				'label' => __('Custom functionality', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'customFunctionality')
			),
			'popup_master_conditions' => array(
				'support_post_type' => array(YPM_POPUP_POST_TYPE),
				'label' => __('Conditions', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'popupConditions')
			),
			'facebook_options' => array(
				'support_post_type' => array(YPM_FACEBOOK_POST_TYPE),
				'label' => __('Facebook options', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'popupFacebookOptions')
			),
			'agerestriction_options' => array(
				'support_post_type' => array(YPM_AGE_RESTRICTION_POST_TYPE),
				'label' => __('Age Restriction options', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'popupAgeRestriction')
			),
			'youtube_options' => array(
				'support_post_type' => array(YPM_YOUTUBE_POST_TYPE),
				'label' => __('Youtube options', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'popupYoutubeOptions')
			),
			'ifranme_options' => array(
				'support_post_type' => array(YPM_IFRAME_POST_TYPE),
				'label' => __('Facebook options', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'popupIframeOptions')
			),
			'social_options' => array(
				'support_post_type' => array(YPM_SOCIAL_POST_TYPE),
				'label' => __('Social options', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'popupSocialOptions')
			),
			'countdown_options' => array(
				'support_post_type' => array(YPM_COUNTDOWN_POST_TYPE),
				'label' => __('Countdown options', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'popupCountdownOptions')
			),
			'countdown_gameification' => array(
				'support_post_type' => array(YPM_GAMIFICATION_POST_TYPE),
				'label' => __('Gamification', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'gamification')
			),
			'countdown_after_expiration' => array(
				'support_post_type' => array(YPM_COUNTDOWN_POST_TYPE),
				'label' => __('Countdown expirations behavior', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'countdownExpiration')
			),
			'subscription_fields' => array(
				'support_post_type' => array(YPM_SUBSCRIPTION_POST_TYPE),
				'label' => __('Subscription form fields', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'subscriptionFormFields')
			),
			'contact_fields' => array(
				'support_post_type' => array(YPM_CONTACT_POST_TYPE),
				'label' => __('Contact form fields', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'contactFormFields')
			),
			'popup_master_floating_button' => array(
				'support_post_type' => array(YPM_POPUP_POST_TYPE),
				'label' => __('Floating button', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'floatingButton')
			),
			'popup_master_special_events' => array(
				'support_post_type' => array(YPM_POPUP_POST_TYPE),
				'label' => __('Behavior after special event', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'specialEvent')
			),
			'popup_master_support_metabox' => array(
				'support_post_type' => 'allTypes',
				'label' => __('Support', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'support'),
				'possition' => 'side'
			),
			'popup_master_feature_metabox' => array(
				'support_post_type' => 'allTypes',
				'label' => __('Info section', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'featureRequest'),
				'possition' => 'side',
				'priority' => 'high'
			),
			'popup_master_shortcode_metabox' => array(
				'support_post_type' => 'allTypes',
				'label' => __('Info', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'info'),
				'possition' => 'side'
			),
			'popup_master_statistic' => array(
				'support_post_type' => 'allTypes',
				'label' => __('Popup statistics', YPM_POPUP_TEXT_DOMAIN),
				'callback' => array($typeObj, 'statistic'),
				'possition' => 'side'
			),
		);
		$metaboxes = apply_filters('ypmMetaboxes', $metaboxes);
		$typeObj->renderMetaboxes($metaboxes);
	}

	public function ypmHeadAction()
	{
		new Header();
	}

	public function pageSelection()
	{
		$screens = array('post', 'page');
		foreach ($screens as $screen) {
			add_meta_box('ypmSelectedPopup', __('Select popup maker on page load', YPM_POPUP_TEXT_DOMAIN), array($this, 'pageSelectionMetaBox'), $screen, 'side');
		}
	}

	public function pageSelectionMetaBox()
	{
		$popupData = Popup::getPopupIdTitleData();
		$metaboxData = array('' => 'Not Selected') + $popupData;
		$postId = '';

		if (!empty($_GET['post'])) {
			$postId = (int)$_GET['post'];
		}
		$popupSelectedId = get_post_meta($postId, 'ypm-metabox-popup');
		echo YpmFunctions::createSelectBox($metaboxData, $popupSelectedId, array('id' => 'ypm-metabox-popup-id', 'name' => 'ypm-metabox-popup'));
	}

	public function ypmPluginLoaded()
	{
		load_plugin_textdomain(YPM_POPUP_TEXT_DOMAIN, false, YPM_FOLDER_NAME . '/languages/');
	}

	public function activate()
	{
		Installer::install();
	}

	public function pluginUpgradeCompleted( $wp_upgrader, $context)
	{
		if (!empty($context['plugin']) && $context['plugin'] == 'popup-more/popup-more.php') {
			Installer::install();
		}
	}

	public function deactivate()
	{
		delete_option('ypm_redirect');
	}

	public static function uninstall()
	{
		Installer::uninstall();
	}

	public function adminHead()
	{
		$script = '';
		$editUrl = admin_url('edit.php');
		ob_start();
		?>
		<script>
			jQuery(document).ready(function() {
				jQuery('[href*="page=<?php echo YPM_FACEBOOK_POST_TYPE; ?>"]').attr("href", "<?php echo add_query_arg('post_type', YPM_FACEBOOK_POST_TYPE, $editUrl); ?>");
				jQuery('[href*="page=<?php echo YPM_YOUTUBE_POST_TYPE; ?>"]').attr("href", "<?php echo add_query_arg('post_type', YPM_YOUTUBE_POST_TYPE, $editUrl); ?>");
				jQuery('[href*="page=<?php echo YPM_CONTACT_POST_TYPE; ?>"]').attr("href", "<?php echo add_query_arg('post_type', YPM_CONTACT_POST_TYPE, $editUrl); ?>");
				jQuery('[href*="page=<?php echo YPM_COUNTDOWN_POST_TYPE; ?>"]').attr("href", "<?php echo add_query_arg('post_type', YPM_COUNTDOWN_POST_TYPE, $editUrl); ?>");
			});
		</script>
		<?php
		$script .= ob_get_contents();
		ob_end_clean();
		if (YPM_POPUP_PKG == YPM_POPUP_FREE) {
			$script .=  '<script>';
			$script .= "jQuery(document).ready(function() {jQuery('[href*=\"ypmsocial\"], [href*=\"ypmiframe\"], [href*=\"ypmcontactform\"], [href*=\"ypmcountdown\"]').attr(\"href\", '".YPM_POPUP_PRO_URL."').attr('target', '_blank');})";
			$script .= '</script>';
		}

		echo $script;
	}

	private function reviewNotice()
	{
		add_action('admin_notices', array($this, 'showReviewNotice'));
		add_action('network_admin_notices', array($this, 'showReviewNotice'));
		add_action('user_admin_notices', array($this, 'showReviewNotice'));
	}

	public static function append_alert_count() {
		global $menu;
		$reviewNotice = new YpmShowReviewNotice();
		$count = (int)$reviewNotice->allowToShow();
		foreach ( $menu as $key => $item ) {
			if ( $item[2] == 'edit.php?post_type='.YPM_POPUP_POST_TYPE ) {
				$menu[ $key ][0] .= $count ? ' <span class="ypm-notification-icon update-plugins count-' . $count . '"><span class="plugin-count ypm-alert-count" aria-hidden="true">' . $count . '</span></span>' : '';
			}
		}
	}

	public function showReviewNotice()
	{
		echo new YpmShowReviewNotice();
	}

	public function pluginRedirect()
	{
		if (!get_option('ypm_redirect') && post_type_exists(YPM_POPUP_POST_TYPE)) {
			update_option('ypm_redirect', 1);
			exit(wp_redirect(admin_url('edit.php?post_type='.YPM_POPUP_POST_TYPE)));
		}
	}
}