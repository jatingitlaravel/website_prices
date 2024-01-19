<?php
namespace YpmPopup;
require_once(YPM_POPUP_HELPERS.'ConfigDataHelper.php');

class DataConfig
{
	public static function init()
	{
		self::conditionInit();
		self::defaultValues();
		self::types();
	}

	public static function conditionInit()
	{
		self::addFilters();
		self::globalDisplaySettings();
		self::conditionsSettings();
		self::eventsSettings();
		self::customEventsSettings();
	}

	private static function eventsSettings()
	{
		global $YPM_EVENTS_SETTINGS_CONFIG;

		$keys = array(
			'select_settings' => 'Select settings',
			'Onload' => 'On Load',
			'OnClick' => 'On Click'
		);

		$keys = apply_filters('ypmEventConditionsKeys', $keys);
		$values = array(
			'key1' => $keys,
			'key2' => array('is' => 'Is', 'isnot' => 'Is not'),
			'Onload' => '',
			'OnClick' => array(
				'clickDefault' => __('Default', YPM_POPUP_TEXT_DOMAIN),
				'clickCustom' => __('Custom', YPM_POPUP_TEXT_DOMAIN)
			)
		);

		$attributes = array(
			'key1' => array(
				'label' => __('Select Conditions'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'class' => 'ypm-condition-select js-ypm-select js-conditions-param',
					'value' => ''
				)
			),
			'key2' => array(
				'label' => __('Select Conditions'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'class' => 'ypm-condition-select',
					'value' => ''
				)
			),
			'Onload' => array(
				'label' => __('Delay'),
				'fieldType' => 'input',
				'allowFromFirstValue' => false,
				'fieldAttributes' => array(
					'class' => 'form-control js-ypm-select'
				)
			),
			'OnClick' => array(
				'label' => __('Option'),
				'fieldType' => 'select',
				'allowFromFirstValue' => false,
				'conditionsConf' => true,
				'fieldAttributes' => array(
					'defaultValue' => 'clickDefault',
					'class' => 'js-ypm-sub-param form-control js-ypm-select'
				)
			),
			'clickDefault' => array(
				'label' => __('Default class'),
				'fieldType' => 'input',
				'conditional' => 'Please save to generate class name',
				'allowFromFirstValue' => false,
				'fieldAttributes' => array(
					'class' => 'form-control js-ypm-select',
					'defaultValue' => 'ypm-popup-click-{popupId}',
					'readonly' => 'readonly',
					'value' => 'ypm-popup-click-'
				)
			),
			'clickCustom' => array(
				'label' => __('Custom class'),
				'fieldType' => 'input',
				'allowFromFirstValue' => false,
				'fieldAttributes' => array(
					'class' => 'form-control js-ypm-select'
				)
			)
		);

		$values = apply_filters('ypmEventConditionsValues', $values);
		$attributes = apply_filters('ypmEventConditionsAttributes', $attributes);

		$YPM_EVENTS_SETTINGS_CONFIG = array(
			'keys' => $keys,
			'values' => $values,
			'attributes' => $attributes
		);
	}

	private static function customEventsSettings()
	{
		global $YPM_CUSTOM_EVENTS_SETTINGS_CONFIG;

		$keys = array(
			'select_settings' => 'Select event',
			'Cf7' => 'Contact from 7',
			'wpform' => 'Contact Form by WPForms',
		);

		$values = array(
			'key1' => $keys,
			'key2' => array('is' => 'Is', 'isnot' => 'Is not'),
			'Cf7' => array(
				'selectBehavior' => __('Select behavior', YPM_POPUP_TEXT_DOMAIN),
				'redirectToUrl' => __('Redirect to URL', YPM_POPUP_TEXT_DOMAIN),
				'openAnotherPopup' => __('Open another popup', YPM_POPUP_TEXT_DOMAIN),
				'closePopup' => __('Close current popup', YPM_POPUP_TEXT_DOMAIN),
			),
			'wpform' => array(
				'wpformSelectBehavior' => __('Select behavior', YPM_POPUP_TEXT_DOMAIN),
				'wpformRedirectToUrl' => __('Redirect to URL', YPM_POPUP_TEXT_DOMAIN),
				'wpformOpenAnotherPopup' => __('Open another popup', YPM_POPUP_TEXT_DOMAIN),
				'wpformClosePopup' => __('Close current popup', YPM_POPUP_TEXT_DOMAIN),
			),
			'openAnotherPopup' => \YpmPopup\Popup::getPopupIdTitleData(),
			'wpformOpenAnotherPopup' => \YpmPopup\Popup::getPopupIdTitleData()
		);

		$attributes = array(
			'key1' => array(
				'label' => __('Select Conditions'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'class' => 'ypm-condition-select js-ypm-select js-conditions-param',
					'value' => ''
				)
			),
			'key2' => array(
				'label' => __('Select Conditions'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'class' => 'ypm-condition-select',
					'value' => ''
				)
			),
			'wpform' => array(
				'label' => __('Select Condition'),
				'fieldType' => 'select',
				'allowFromFirstValue' => false,
				'conditionsConf' => false,
				'fieldAttributes' => array(
					'defaultValue' => 'clickDefault',
					'class' => 'js-ypm-sub-param form-control js-ypm-select'
				)
			),
			'Cf7' => array(
				'label' => __('Select Condition'),
				'fieldType' => 'select',
				'allowFromFirstValue' => false,
				'conditionsConf' => false,
				'fieldAttributes' => array(
					'defaultValue' => 'clickDefault',
					'class' => 'js-ypm-sub-param form-control js-ypm-select'
				)
			),
			'redirectToUrl' => array(
				'label' => __('URL'),
				'fieldType' => 'input',
				'allowFromFirstValue' => false,
				'fieldAttributes' => array(
					'class' => 'form-control js-ypm-select',
					'defaultValue' => '',
					'placeholder' => 'https://',
					'value' => ''
				)
			),
			'wpformRedirectToUrl' => array(
				'label' => __('URL'),
				'fieldType' => 'input',
				'allowFromFirstValue' => false,
				'fieldAttributes' => array(
					'class' => 'form-control js-ypm-select',
					'defaultValue' => '',
					'placeholder' => 'https://',
					'value' => ''
				)
			),
			'closePopup' => array(
				'label' => __('Delay'),
				'fieldType' => 'input',
				'allowFromFirstValue' => false,
				'fieldAttributes' => array(
					'class' => 'form-control js-ypm-select',
					'placeholder' => '',
					'value' => '0'
				)
			),
			'wpformClosePopup' => array(
				'label' => __('Delay'),
				'fieldType' => 'input',
				'allowFromFirstValue' => false,
				'fieldAttributes' => array(
					'class' => 'form-control js-ypm-select',
					'placeholder' => '',
					'value' => '0'
				)
			),
			'openAnotherPopup' => array(
				'label' => __('Select popup'),
				'fieldType' => 'select',
				'allowFromFirstValue' => false,
				'fieldAttributes' => array(
					'class' => 'form-control js-ypm-select',
					'defaultValue' => '',
					'placeholder' => '',
					'type' => 'number',
					'value' => 0
				)
			),
			'wpformOpenAnotherPopup' => array(
				'label' => __('Select popup'),
				'fieldType' => 'select',
				'allowFromFirstValue' => false,
				'fieldAttributes' => array(
					'class' => 'form-control js-ypm-select',
					'defaultValue' => '',
					'placeholder' => '',
					'type' => 'number',
					'value' => 0
				)
			),
		);

		$values = apply_filters('ypmCustomEventConditionsValues', $values);
		$attributes = apply_filters('ypmCustomEventConditionsAttributes', $attributes);

		$YPM_CUSTOM_EVENTS_SETTINGS_CONFIG = array(
			'keys' => $keys,
			'values' => $values,
			'attributes' => $attributes
		);
	}

	private static function conditionsSettings()
	{
		global $YPM_CONDITIONS_SETTINGS_CONFIG;
		$keys = array(
			'select_settings' => 'Select settings'
		);

		$keys = apply_filters('ypmConditionConditionsKeys', $keys);

		$values = array(
			'key1' => $keys,
			'key2' => array('is' => 'Is', 'isnot' => 'Is not')
		);

		$attributes = array(
			'key1' => array(
				'label' => __('Select Conditions'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'class' => 'ypm-condition-select js-ypm-select js-conditions-param',
					'value' => ''
				)
			),
			'key2' => array(
				'label' => __('Select Conditions'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'class' => 'ypm-condition-select js-ypm-select',
					'value' => ''
				)
			)
		);

		$values = apply_filters('ypmConditionConditionsValues', $values);
		$attributes = apply_filters('ypmConditionConditionsAttributes', $attributes);

		$YPM_CONDITIONS_SETTINGS_CONFIG = array(
			'keys' => $keys,
			'values' => $values,
			'attributes' => $attributes
		);
	}

	private static function globalDisplaySettings()
	{
		global $YPM_DISPLAY_SETTINGS_CONFIG;

		$keys = array(
			'select_settings' => 'Select settings',
			'everywhere' => 'Everywhere',
			'Post' => array(
				'all_post' => 'All posts',
				'selected_post' => 'Select posts',
				'categories_post' => 'Select post categories'
			),
			'Page' => array(
				'selected_page' => 'Select pages',
				'page_type' => 'Page type',
				'all_page' => 'All pages',
			),
			'Tag' => array(
				'all_tag' => 'All Tags',
				'selected_tag' => 'Select tags',
			)
		);

		$keys = apply_filters('ypmConditionsDisplayKeys', $keys);

		$values = array(
			'key1' => $keys,
			'key2' => array('is' => 'Is', 'isnot' => 'Is not'),
			'selected_post' => array(),
			'categories_post' => self::postTypeCategories(),
			'selected_tag' => self::getAllTags(),
			'all_post' => array(),
			'selected_page' => array(),
			'all_page' => array(),
			'page_type' => self::getPageTypes(),
			'everywhere' => array()
		);

		$attributes = array(
			'key1' => array(
				'label' => __('Select Conditions'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'class' => 'ypm-condition-select js-ypm-select js-conditions-param',
					'value' => ''
				)
			),
			'key2' => array(
				'label' => __('Select Conditions'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'class' => 'ypm-condition-select js-ypm-select',
					'value' => ''
				)
			),
			'selected_post' => array(
				'label' => __('Select Post(s)'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'data-post-type' => 'post',
					'data-select-type' => 'ajax',
					'multiple' => 'multiple',
					'class' => 'ypm-condition-select js-ypm-select',
					'value' => ''
				)
			),
			'categories_post' => array(
				'label' => __('Select Post categories'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'multiple' => 'multiple',
					'class' => 'ypm-condition-select js-ypm-select',
					'value' => ''
				)
			),
			'selected_page' => array(
				'label' => __('Select Page(s)'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'data-post-type' => 'page',
					'data-select-type' => 'ajax',
					'multiple' => 'multiple',
					'class' => 'ypm-condition-select js-ypm-select',
					'value' => ''
				)
			),
			'selected_tag' => array(
				'label' => __('Select Tag'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'multiple' => 'multiple',
					'class' => 'ypm-condition-select js-ypm-select',
					'value' => ''
				)
			),
			'page_type' => array(
				'label' => __('Select specific page types'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'class' => 'ypm-condition-select js-ypm-select',
					'multiple' => 'multiple',
					'value' => ''
				)
			),
		);

		$values = apply_filters('ycdConditionsDisplayValues', $values);
		$attributes = apply_filters('ycdConditionsDisplayAttributes', $attributes);

		$YPM_DISPLAY_SETTINGS_CONFIG = array(
			'keys' => $keys,
			'values' => $values,
			'attributes' => $attributes
		);
	}

	public static function defaultValues() {
		global $YpmDefaults;
		global $YpmDefaultsData;
		global $YpmPostTypesInfo;

		$options = array();

		$exitMode = array(
			'soft' => __('Soft mode', YPM_POPUP_TEXT_DOMAIN),
			'agressive' => __('Aggressive mode', YPM_POPUP_TEXT_DOMAIN),
			'softAgres' => __('Soft and Aggressive modes', YPM_POPUP_TEXT_DOMAIN),
			'alert' => __('Aggressive without popup', YPM_POPUP_TEXT_DOMAIN)
		);

		$socialThemes = array(
			'flat' => __('Flat', YPM_POPUP_TEXT_DOMAIN),
			'classic' => __('Classic', YPM_POPUP_TEXT_DOMAIN),
			'minima' => __('Minima', YPM_POPUP_TEXT_DOMAIN),
			'plain' => __('Plain', YPM_POPUP_TEXT_DOMAIN)
		);

		$socialShareIn = array(
			'blank' => __('Blank', YPM_POPUP_TEXT_DOMAIN),
			'popup' => __('Inside window', YPM_POPUP_TEXT_DOMAIN),
			'self' => __('Self', YPM_POPUP_TEXT_DOMAIN)
		);

		$socialFontSizes = array(
			'8' => '8',
			'10' => '10',
			'12' => '12',
			'14' => '14',
			'16' => '16',
			'18' => '18',
			'20' => '20',
			'24' => '24'
		);

		$socialThemeShareCount = array(
			'true' => __('True', YPM_POPUP_TEXT_DOMAIN),
			'false' => __('False', YPM_POPUP_TEXT_DOMAIN),
			'inside' => __('Inside', YPM_POPUP_TEXT_DOMAIN)
		);

		$fblikeLayout = array(
			'standard' => __('Standard', YPM_POPUP_TEXT_DOMAIN),
			'button_count' => __('Button with count', YPM_POPUP_TEXT_DOMAIN),
			'box_count' => __('Box with count', YPM_POPUP_TEXT_DOMAIN),
			'button' => __('Button', YPM_POPUP_TEXT_DOMAIN)
		);

		$fblikeShareLayout = array(
			'box_count' => __('Box with count', YPM_POPUP_TEXT_DOMAIN),
			'button_count' => __('Button with count', YPM_POPUP_TEXT_DOMAIN),
			'button' => __('Button', YPM_POPUP_TEXT_DOMAIN)
		);

		$fblikeAction = array(
			'like' => __('Like', YPM_POPUP_TEXT_DOMAIN),
			'recommend' => __('Recommend', YPM_POPUP_TEXT_DOMAIN)
		);

		$fblikeSize = array(
			'small' => __('Small', YPM_POPUP_TEXT_DOMAIN),
			'large' => __('Large', YPM_POPUP_TEXT_DOMAIN)
		);

		$fbLikeAlignment = array(
			'left' => __('Left', YPM_POPUP_TEXT_DOMAIN),
			'center' => __('Center', YPM_POPUP_TEXT_DOMAIN),
			'right' => __('Right', YPM_POPUP_TEXT_DOMAIN)
		);

		$devices = array(
			'desktop' => __('Desktop', YPM_POPUP_TEXT_DOMAIN),
			'tablet' => __('Tablet', YPM_POPUP_TEXT_DOMAIN),
			'isiOS' => __('Ios', YPM_POPUP_TEXT_DOMAIN),
			'isAndroid' => __('Android', YPM_POPUP_TEXT_DOMAIN)
		);

		$countries = array(
		);

		$postTypes = apply_filters('ypm-post-types', array(
			YPM_POPUP_POST_TYPE,
			YPM_IMAGE_POST_TYPE,
			YPM_FACEBOOK_POST_TYPE,
			YPM_YOUTUBE_POST_TYPE,
			YPM_IFRAME_POST_TYPE,
			YPM_SOCIAL_POST_TYPE,
			YPM_CONTACT_POST_TYPE,
			YPM_SUBSCRIPTION_POST_TYPE,
			YPM_COUNTDOWN_POST_TYPE
		));

		$targetDefaultValue = array(array('key1' => 'select_settings'));
		$eventsDefaultValue = array(array('key1' => 'Onload', 'key2' => '0'));

		$options[] = array('name' => 'ypm-events-settings', 'type' => 'array', 'defaultValue' => $eventsDefaultValue);
		$options[] = array('name' => 'ypm-popup-special-events-settings', 'type' => 'array', 'defaultValue' => $targetDefaultValue);
		$options[] = array('name' => 'ypm-conditions-settings', 'type' => 'array', 'defaultValue' => $targetDefaultValue);
		$options[] = array('name' => 'ypm-display-settings', 'type' => 'array', 'defaultValue' => $targetDefaultValue);
		$options[] = array('name' => 'ypm-popup-width', 'type' => 'string', 'defaultValue' => '640px');
		$options[] = array('name' => 'ypm-popup-height', 'type' => 'string', 'defaultValue' => '480px');
		$options[] = array('name' => 'ypm-popup-max-width', 'type' => 'string', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-max-height', 'type' => 'string', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-dimensions-mode', 'type' => 'string', 'defaultValue' => 'custom');
		$options[] = array('name' => 'ypm-popup-dimensions-auto-size', 'type' => 'string', 'defaultValue' => 'auto');
		$options[] = array('name' => 'ypm-popup-theme', 'type' => 'string', 'defaultValue' => 'colorbox1');
		$options[] = array('name' => 'ypm-popup-theme-close-text', 'type' => 'string', 'defaultValue' => 'close');
		$options[] = array('name' => 'ypm-esc-key', 'type' => 'checkbox', 'defaultValue' => 'on');
		$options[] = array('name' => 'ypm-close-button', 'type' => 'checkbox', 'defaultValue' => 'on');
		$options[] = array('name' => 'ypm-enable-close-delay', 'type' => 'checkbox', 'defaultValue' => 'on');
		$options[] = array('name' => 'ypm-show-close-delay', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-close-delay-font-size', 'type' => 'text', 'defaultValue' => '16px');
		$options[] = array('name' => 'ypm-close-delay-color', 'type' => 'text', 'defaultValue' => '#dd3333');
		$options[] = array('name' => 'ypm-close-button-delay', 'type' => 'text', 'defaultValue' => '1');
		$options[] = array('name' => 'ypm-overlay-click', 'type' => 'checkbox', 'defaultValue' => 'on');
		$options[] = array('name' => 'ypm-overlay-color', 'type' => 'string', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-disable-overlay', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-enable-bg-image', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-title', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-close-delay', 'type' => 'string', 'defaultValue' => 0);
		$options[] = array('name' => 'ypm-delay', 'type' => 'string', 'defaultValue' => 0);
		$options[] = array('name' => 'ypm-popup-opening-animation-speed', 'type' => 'string', 'defaultValue' => 1);
		$options[] = array('name' => 'ypm-popup-close-animation-speed', 'type' => 'string', 'defaultValue' => 1);
		$options[] = array('name' => 'ypm-z-index', 'type' => 'string', 'defaultValue' => 9999);
		$options[] = array('name' => 'ypm-content-padding', 'type' => 'string', 'defaultValue' => "0px");
		$options[] = array('name' => 'ypm-content-border-radius', 'type' => 'string', 'defaultValue' => "0px");
		$options[] = array('name' => 'ypm-popup-exit-mode', 'type' => 'string', 'defaultValue' => 'soft');
		$options[] = array('name' => 'ypm-exit-alert-text', 'type' => 'string', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-exit-per-day', 'type' => 'string', 'defaultValue' => '1');
		$options[] = array('name' => 'ypm-exit-page-lavel', 'type' => 'checkbox', 'defaultValue' => 'on');
		$options[] = array('name' => 'ypm-exit-leave-top', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-exit-enable', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-overlay-opacity', 'type' => 'text', 'defaultValue' => 0.8);
		$options[] = array('name' => 'ypm-is-active', 'type' => 'checkbox', 'defaultValue' => 'on');
		$options[] = array('name' => 'ypm-facebook-type', 'type' => 'text', 'defaultValue' => 'likeButton');
		$options[] = array('name' => 'ypm-facebook-layout', 'type' => 'text', 'defaultValue' => 'likeButton');
		$options[] = array('name' => 'ypm-facebook-action', 'type' => 'text', 'defaultValue' => 'like');
		$options[] = array('name' => 'ypm-facebook-size', 'type' => 'text', 'defaultValue' => 'small');
		$options[] = array('name' => 'ypm-facebook-url', 'type' => 'text', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-facebook-share-button', 'type' => 'checkbox', 'defaultValue' => 'on');
		$options[] = array('name' => 'ypm-facebook-like-alignment', 'type' => 'text', 'defaultValue' => 'center');
		$options[] = array('name' => 'ypm-facebook-type', 'type' => 'text', 'defaultValue' => 'center');
		$options[] = array('name' => 'ypm-facebook-share-url', 'type' => 'text', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-facebook-share-layout', 'type' => 'text', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-facebook-share-size', 'type' => 'text', 'defaultValue' => 'small');
		$options[] = array('name' => 'ypm-facebook-share-alignment', 'type' => 'text', 'defaultValue' => 'center');
		$options[] = array('name' => 'ypm-show-on-device-status', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-devices', 'type' => 'array', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-selected-countries-status', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-selected-countries', 'type' => 'array', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-content-click-status', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-content-click-redirect-enable', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-content-click-redirect-enable', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-content-click-redirect-tab', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-close-redirection-url-tab', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-showing-limitation', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-limitation-shwoing-count', 'type' => 'text', 'defaultValue' => 1);
		$options[] = array('name' => 'ypm-limitation-shwoing-expiration', 'type' => 'text', 'defaultValue' => 1);
		$options[] = array('name' => 'ypm-show-popup-same-user-page-level', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-content-click-count', 'type' => 'text', 'defaultValue' => 1);
		$options[] = array('name' => 'ypm-title-color', 'type' => 'text', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-disable-page-scrolling', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-location', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-floating-enable', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-floating-position', 'type' => 'text', 'defaultValue' => 'bottom_right');
		$options[] = array('name' => 'ypm-popup-floating-font-size', 'type' => 'text', 'defaultValue' => '16');
		$options[] = array('name' => 'ypm-popup-floating-bg-color', 'type' => 'text', 'defaultValue' => '#5263eb');
		$options[] = array('name' => 'ypm-popup-floating-text-color', 'type' => 'text', 'defaultValue' => '#ffffff');
		$options[] = array('name' => 'ypm-popup-floating-text', 'type' => 'text', 'defaultValue' => 'Click it!');
		$options[] = array('name' => 'ypm-popup-floating-border-radius', 'type' => 'text', 'defaultValue' => '0px');
		$options[] = array('name' => 'ypm-popup-floating-border-status', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-floating-enable-hover', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-floating-border-width', 'type' => 'text', 'defaultValue' => '1px');
		$options[] = array('name' => 'ypm-popup-floating-border-color', 'type' => 'text', 'defaultValue' => '#5263eb');
		$options[] = array('name' => 'ypm-popup-floating-open-event', 'type' => 'text', 'defaultValue' => 'click');
		$options[] = array('name' => 'ypm-iframe-url', 'type' => 'text', 'defaultValue' => 'https://www.wikipedia.org/');
		$options[] = array('name' => 'ypm-iframe-width', 'type' => 'text', 'defaultValue' => '300px');
		$options[] = array('name' => 'ypm-iframe-height', 'type' => 'text', 'defaultValue' => '200px');
		$options[] = array('name' => 'ypm-popup-floating-hover-text-color', 'type' => 'text', 'defaultValue' => '#5263eb');
		$options[] = array('name' => 'ypm-popup-floating-hover-bg-color', 'type' => 'text', 'defaultValue' => '#ffffff');
		// youtube defaults
		$options[] = array('name' => 'ypm-youtube-width', 'type' => 'text', 'defaultValue' => '300px');
		$options[] = array('name' => 'ypm-youtube-height', 'type' => 'text', 'defaultValue' => '300px');
		$options[] = array('name' => 'ypm-youtube-start', 'type' => 'text', 'defaultValue' => '0');
		$options[] = array('name' => 'ypm-popup-type', 'type' => 'text', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-remove-borders', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-enable-popup-close-button-position', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-close-button-top', 'type' => 'text', 'defaultValue' => '0px');
		$options[] = array('name' => 'ypm-popup-close-button-right', 'type' => 'text', 'defaultValue' => '0px');
		$options[] = array('name' => 'ypm-popup-close-button-bottom', 'type' => 'text', 'defaultValue' => '0px');
		$options[] = array('name' => 'ypm-popup-close-button-left', 'type' => 'text', 'defaultValue' => '0px');
		$options[] = array('name' => 'ypm-popup-close-behavior', 'type' => 'text', 'defaultValue' => 'default');
		$options[] = array('name' => 'ypm-popup-link-selector', 'type' => 'text', 'defaultValue' => 'all');
		$options[] = array('name' => 'ypm-popup-disable-statistic', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-enable-start-date', 'type' => 'checkbox', 'defaultValue' => '');


		$YpmDefaults = apply_filters('ypmDefaultOptions', $options);
		// ToDo: fixed thix
		$YpmDefaults[] = array('name' => 'ypm-gamification-start-text', 'type' => 'textMessage', 'defaultValue' => '');
		$YpmDefaults[] = array('name' => 'ypm-gamification-play-text', 'type' => 'textMessage', 'defaultValue' =>  '');
		$YpmDefaults[] = array('name' => 'ypm-gamification-lose-text', 'type' => 'textMessage', 'defaultValue' =>  '');
		$YpmDefaults[] = array('name' => 'ypm-gamification-win-text', 'type' => 'textMessage', 'defaultValue' =>  '');

		$YpmDefaultsData['exitMode'] = $exitMode;
		$YpmDefaultsData['socialShareIn'] = $socialShareIn;
		$YpmDefaultsData['socialThemes'] = $socialThemes;
		$YpmDefaultsData['socialThemeShareCount'] = $socialThemeShareCount;
		$YpmDefaultsData['socialFontSizes'] = $socialFontSizes;
		$YpmDefaultsData['fblikeLayout'] = $fblikeLayout;
		$YpmDefaultsData['fblikeAction'] = $fblikeAction;
		$YpmDefaultsData['fblikeSize'] = $fblikeSize;
		$YpmDefaultsData['postTypes'] = $postTypes;
		$YpmDefaultsData['fbLikeAlignment'] = $fbLikeAlignment;
		$YpmDefaultsData['fblikeShareLayout'] = $fblikeShareLayout;
		$YpmDefaultsData['devices'] = $devices;
		$YpmDefaultsData['countries'] = apply_filters('ypm-countries', $countries);

		$YpmPostTypesInfo['postTypes'] = array(
			YPM_POPUP_POST_TYPE => YPM_POPUP_FREE,
			YPM_IMAGE_POST_TYPE => YPM_POPUP_FREE,
			YPM_FACEBOOK_POST_TYPE => YPM_POPUP_FREE,
			YPM_AGE_RESTRICTION_POST_TYPE => YPM_POPUP_FREE,
			YPM_SUBSCRIPTION_POST_TYPE => YPM_POPUP_FREE,
			YPM_YOUTUBE_POST_TYPE => YPM_POPUP_FREE,
			YPM_SUBSCRIPTION_POST_TYPE => YPM_POPUP_FREE,
			YPM_GAMIFICATION_POST_TYPE => YPM_POPUP_FREE,
			YPM_IFRAME_POST_TYPE => YPM_POPUP_SILVER,
			YPM_SOCIAL_POST_TYPE => YPM_POPUP_SILVER,
			YPM_LINK_POST_TYPE => YPM_POPUP_GOLD,
			YPM_CONTACT_POST_TYPE => YPM_POPUP_GOLD,
			YPM_COUNTDOWN_POST_TYPE => YPM_POPUP_GOLD,
		);

		$YpmPostTypesInfo['postTypesLabels'] = array(
			YPM_POPUP_POST_TYPE => YPM_POPUP_FREE,
			YPM_IMAGE_POST_TYPE => __('Image', YPM_POPUP_TEXT_DOMAIN),
			YPM_FACEBOOK_POST_TYPE => __('Facebook', YPM_POPUP_TEXT_DOMAIN),
			YPM_AGE_RESTRICTION_POST_TYPE => __('Age Restriction', YPM_POPUP_TEXT_DOMAIN),
			YPM_YOUTUBE_POST_TYPE => __('Youtube', YPM_POPUP_TEXT_DOMAIN),
			YPM_IFRAME_POST_TYPE => __('Iframe', YPM_POPUP_TEXT_DOMAIN),
			YPM_SOCIAL_POST_TYPE => __('Social', YPM_POPUP_TEXT_DOMAIN),
			YPM_LINK_POST_TYPE => __('Dynamic Link Content', YPM_POPUP_TEXT_DOMAIN),
			YPM_CONTACT_POST_TYPE => __('Contact Form', YPM_POPUP_TEXT_DOMAIN),
			YPM_COUNTDOWN_POST_TYPE => __('Countdown', YPM_POPUP_TEXT_DOMAIN),
			YPM_SUBSCRIPTION_POST_TYPE => __('Subscription', YPM_POPUP_TEXT_DOMAIN),
			YPM_GAMIFICATION_POST_TYPE => __('Gamification', YPM_POPUP_TEXT_DOMAIN),
		);

		$YpmPostTypesInfo['levelLabels'] = array(
			YPM_POPUP_FREE => __('Free', YPM_POPUP_TEXT_DOMAIN),
			YPM_POPUP_SILVER => __('Silver', YPM_POPUP_TEXT_DOMAIN),
			YPM_POPUP_GOLD => __('Gold', YPM_POPUP_TEXT_DOMAIN)
		);

	}

	// helpers
	public static function getPageTypes()
	{
		$postTypes = array();

		$postTypes['is_home_page'] = __('Home Page', YPM_POPUP_TEXT_DOMAIN);
		$postTypes['is_home'] = __('Posts Page', YPM_POPUP_TEXT_DOMAIN);
		$postTypes['is_search'] = __('Search Pages', YPM_POPUP_TEXT_DOMAIN);
		$postTypes['is_404'] = __('404 Pages', YPM_POPUP_TEXT_DOMAIN);
		if (function_exists('is_shop')) {
			$postTypes['is_shop'] = __('Shop Page', YPM_POPUP_TEXT_DOMAIN);
		}
		if (function_exists('is_archive')) {
			$postTypes['is_archive'] = __('Archive Page', YPM_POPUP_TEXT_DOMAIN);
		}

		return $postTypes;
	}

	public static function postTypeCategories($postType = 'post', $taxonomy = '')
	{
		if (empty($taxonomy)) {
			$taxonomy = 'category';
		}
		$args = array(
			'type'         => $postType,
			'orderby'      => 'name',
			'hide_empty'   => 0,
			'taxonomy'     => $taxonomy
		);

		$categories = get_terms( $args );
		$slugs = array();

		foreach( $categories as $category ) {
			$slugs[ $category->term_id] =  $category->slug;
		}

		return $slugs;
	}

	public static function getAllTags() {
		$allTags = array();
		$tags = get_tags(array(
			'hide_empty' => false
		));

		foreach ($tags as $tag) {
			$allTags[$tag->slug] = $tag->name;
		}

		return $allTags;
	}

	public static function addFilters()
	{
		add_filter('ypmConditionsDisplayKeys', array(__CLASS__, 'conditionsDisplayKeys'),1,1);
		add_filter('ycdConditionsDisplayAttributes', array(__CLASS__, 'conditionsDisplayAttributes'),1,1);
		add_filter('ycdConditionsDisplayValues', array(__CLASS__, 'conditionsDisplayValues'),1,1);
	}

	public static function conditionsDisplayKeys($keys) {
		$allCustomPostTypes = self::getAllCustomPosts();
		foreach ($allCustomPostTypes as $customPostType) {
			if ($customPostType === 'product') {
				$keys['WooCommerce'] = array(
					'all_'.$customPostType => 'All WooCommerce',
					'selected_'.$customPostType => 'Select '.ucfirst($customPostType),
					'shop_page' => 'Shop Page',
					'cart_page' => 'Cart Page',
					'account_page' => 'Account Page',
					'categories_'.$customPostType => 'Select WooCommerce categories'
				);
				continue;
			}
			$keys[$customPostType] = array(
				'all_'.$customPostType => 'All '.ucfirst($customPostType).'s',
			//	$customPostType.'_archive' => 'Archives '.ucfirst($customPostType).'s',
				'selected_'.$customPostType => 'Select '.ucfirst($customPostType).'s',
				'categories_'.$customPostType => 'Select '.ucfirst($customPostType).' categories'
			);
		}

		return $keys;
	}

	public static function conditionsDisplayAttributes($attributes) {

		$allCustomPostTypes = self::getAllCustomPosts();
		foreach ($allCustomPostTypes as $customPostType) {
			$attributes['selected_'.$customPostType] = array(
				'label' => __('Select Post(s)'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'data-post-type' => $customPostType,
					'data-select-type' => 'ajax',
					'multiple' => 'multiple',
					'class' => 'ypm-condition-select js-ypm-select',
					'value' => ''
				)
			);
			$attributes['categories_'.$customPostType] = array(
				'label' => __('Select '.ucfirst($customPostType).' categories'),
				'fieldType' => 'select',
				'fieldAttributes' => array(
					'multiple' => 'multiple',
					'class' => 'ypm-condition-select js-ypm-select',
					'value' => ''
				)
			);
		}

		return $attributes;
	}

	public static function conditionsDisplayValues($values)
	{
		$allCustomPostTypes = self::getAllCustomPosts();
		foreach ($allCustomPostTypes as $customPostType) {
			$taxonomyObjects = get_object_taxonomies($customPostType);
			if ($customPostType == 'product') {
				$taxonomyObjects = array('product_cat');
			}
			$values['categories_'.$customPostType] = self::postTypeCategories($customPostType,$taxonomyObjects);
		}

		return $values;
	}

	public static function getAllCustomPosts()
	{
		$args = array(
			'public' => true,
			'_builtin' => false
		);

		$allCustomPosts = get_post_types($args);

		if (isset($allCustomPosts[YPM_POPUP_POST_TYPE])) {
			unset($allCustomPosts[YPM_POPUP_POST_TYPE]);
		}

		return $allCustomPosts;
	}

	public static function types() {
		global $YPM_TYPES;

		$YPM_TYPES['typeName'] = apply_filters('ypmTypes', array(
			YPM_IMAGE_POST_TYPE => array(
				'level' => YPM_POPUP_FREE,
				'hasType' => false,
				'displayText' => 'Image',
				'videoURL' => 'https://www.youtube.com/watch?v=sWYJeEzZTKY'
			),
			'HTML' => array(
				'level' => YPM_POPUP_FREE,
				'hasType' => false,
				'displayText' => 'HTML'
			),
			YPM_SUBSCRIPTION_POST_TYPE => array(
				'level' => YPM_POPUP_FREE,
				'hasType' => true,
				'displayText' => 'Subscription'
			),
			YPM_FACEBOOK_POST_TYPE => array(
				'level' => YPM_POPUP_FREE,
				'hasType' => true,
				'displayText' => 'Facebook'
			),
			YPM_AGE_RESTRICTION_POST_TYPE => array(
				'level' => YPM_POPUP_FREE,
				'hasType' => true,
				'displayText' => 'Age Restriction'
			),
			YPM_GAMIFICATION_POST_TYPE => array(
				'level' => YPM_POPUP_FREE,
				'hasType' => true,
				'displayText' => 'Gamification'
			),
			YPM_YOUTUBE_POST_TYPE => array(
				'level' => YPM_POPUP_FREE,
				'hasType' => true,
				'displayText' => 'Youtube'
			),
			YPM_IFRAME_POST_TYPE => array(
				'level' => YPM_POPUP_SILVER,
				'hasType' => true,
				'displayText' => 'Iframe'
			),
			YPM_SOCIAL_POST_TYPE => array(
				'level' => YPM_POPUP_SILVER,
				'hasType' => true,
				'displayText' => 'Social'
			),
			YPM_CONTACT_POST_TYPE => array(
				'level' => YPM_POPUP_SILVER,
				'hasType' => true,
				'displayText' => 'Contact form'
			),
			YPM_CONTACT_POST_TYPE => array(
				'level' => YPM_POPUP_GOLD,
				'hasType' => true,
				'displayText' => 'Contact form'
			),
			YPM_COUNTDOWN_POST_TYPE => array(
				'level' => YPM_POPUP_GOLD,
				'hasType' => true,
				'displayText' => 'Countdown',
				'videoURL' => 'https://www.youtube.com/watch?v=qe1TfIcmKGc'
			),
			YPM_LINK_POST_TYPE => array(
				'level' => YPM_POPUP_GOLD,
				'hasType' => false,
				'displayText' => 'Dynamic Link Content',
				'videoURL' => 'https://www.youtube.com/watch?v=jhA9WQ1L1i8'
			),
		));
	}

}
