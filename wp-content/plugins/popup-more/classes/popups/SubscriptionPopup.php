<?php
namespace YpmPopup;

class SubscriptionPopup extends Popup implements PopupViewInterface
{

	public $shortCodeName = 'ypm_subscription';

	public function getMenuLabelName()
	{

		return __('Subscription', YPM_POPUP_TEXT_DOMAIN);
	}

	public function __construct()
	{
		if (is_admin()) {
			$this->includeAdminScripts();
			$this->includeCss();
			$this->includejS();
		}
		if (!defined('YPM_FORM_REQUIRED_MESSAGE')) {
			define('YPM_FORM_REQUIRED_MESSAGE', __('This field is required.'));
		}
		if (!defined('YPM_FORM_INVALID_EMAIL')) {
			define('YPM_FORM_INVALID_EMAIL', __('Please enter a valid email address.'));
		}
		$this->extendDefaults();
		add_filter('ypmDefaultOptions', array($this, 'defOptions'));
		$this->extendDefaultData();
	}

	public function defOptions($options)
	{

		$options[] = array('name' => 'ypm-popup-subscription-behavior', 'type' => 'text', 'defaultValue' => 'message');
		$options[] = array('name' => 'ypm-popup-subscription-expiration-message', 'type' => 'textMessage', 'defaultValue' => '<p>Thank you for your subscription.</p>');

		$options[] = array('name' => 'ypm-subscription-section', 'type' => 'text', 'defaultValue' => 'fields');
		$options[] = array('name' => 'ypm-subscription-form-width', 'type' => 'text', 'defaultValue' => '100');
		$options[] = array('name' => 'ypm-subscription-send-to-email', 'type' => 'text', 'defaultValue' => get_option('admin_email'));
		$options[] = array('name' => 'ypm-subscription-send-from-email', 'type' => 'text', 'defaultValue' => get_option('admin_email'));
		$options[] = array('name' => 'ypm-subscription-send-email-subject', 'type' => 'text', 'defaultValue' => __('Contact form', YPM_POPUP_TEXT_DOMAIN));
		$options[] = array('name' => 'ypm-subscription-message', 'type' => 'textMessage', 'defaultValue' => '<p>Hello!</p><p>This is your subscription form data:</p></br><p>[form_data]</p>');
		$options[] = array('name' => 'ypm-popup-subscription-enable-redirect', 'type' => 'checkbox', 'defaultValue' => '');
		$options[] = array('name' => 'ypm-popup-subscription-text-redirect-url', 'type' => 'text', 'defaultValue' => '');

		return $options;
	}

	private function extendDefaults()
	{

		global $YpmDefaults;

		$YpmDefaults[] = array('name' => 'ypm-popup-subscription-behavior', 'type' => 'text', 'defaultValue' => 'message');
		$YpmDefaults[] = array('name' => 'ypm-popup-subscription-expiration-message', 'type' => 'textMessage', 'defaultValue' => '<p>Thank you for your message. It has been sent.</p>');

		$YpmDefaults[] = array('name' => 'ypm-subscription-section', 'type' => 'text', 'defaultValue' => 'fields');
		$YpmDefaults[] = array('name' => 'ypm-subscription-form-width', 'type' => 'text', 'defaultValue' => '100');
		$YpmDefaults[] = array('name' => 'ypm-subscription-send-to-email', 'type' => 'text', 'defaultValue' => get_option('admin_email'));
		$YpmDefaults[] = array('name' => 'ypm-subscription-send-from-email', 'type' => 'text', 'defaultValue' => get_option('admin_email'));
		$YpmDefaults[] = array('name' => 'ypm-subscription-send-email-subject', 'type' => 'text', 'defaultValue' => __('Contact form', YPM_POPUP_TEXT_DOMAIN));
		$YpmDefaults[] = array('name' => 'ypm-subscription-message', 'type' => 'textMessage', 'defaultValue' => '<p>Hello!</p><p>This is your scription form data:</p></br><p>[form_data]</p>');
	}

	private function extendDefaultData()
	{

		global $YpmDefaultsData;

		$YpmDefaultsData['subscriptionFormWidthMeasure'] = array(
			'%' => __('Percents', YPM_POPUP_TEXT_DOMAIN),
			'px' => __('Pixels', YPM_POPUP_TEXT_DOMAIN)
		);
	}

	public static function create($data, $obj = '')
	{

		$obj = new self();
		parent::create($data, $obj);
	}

	public function save()
	{

		parent::save();
		$sanitizedData = $this->getSanitizedData();
		$fieldsOrder = (!empty($sanitizedData['ypm-subscription-fields-order'])) ? $sanitizedData['ypm-subscription-fields-order'] : '';
		$fieldsData = self::changeFieldsOrdering(get_option('YcfPopupFormDraft'), $fieldsOrder);
		$formFields = json_encode($fieldsData);
		$data = $this->getSanitizedData();
		$formId = $data['ypm-popup-id'];

		global $wpdb;

		$selectForm = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "ypm_subscription_form_fields WHERE form_id=%d", $formId);
		$selectResult = $wpdb->query($selectForm);

		if (!$selectResult) {
			$insertToFieldsQuery = $wpdb->prepare("INSERT INTO " . $wpdb->prefix . "ypm_subscription_form_fields (form_id, fields_data) VALUES (%d, %s)", $formId, $formFields);
			$insertResult = $wpdb->query($insertToFieldsQuery);
		} else {
			$fieldsUpdateSql = $wpdb->prepare("UPDATE " . $wpdb->prefix . "ypm_subscription_form_fields SET fields_data=%s WHERE form_id=%d", $formFields, $formId);
			$wpdb->query($fieldsUpdateSql);
		}
	}

	public static function changeFieldsOrdering($fieldsData, $ordersId)
	{

		if (!empty($ordersId) && gettype($ordersId) == 'string') {
			$ordersId = explode(',', $ordersId);
		}

		if (!is_array($ordersId)) {
			return $fieldsData;
		}
		$newOrderingData = array();

		foreach ($ordersId as $fieldId) {

			if (empty($fieldsData[$fieldId])) {
				continue;
			}
			$currentFieldData = $fieldsData[$fieldId];
			$newOrderingData[] = $currentFieldData;
		}

		if (empty($newOrderingData)) {
			return $fieldsData;
		}

		return $newOrderingData;
	}

	private function includeAdminScripts()
	{

		wp_register_style('ypmFormAdminStyles', YPM_POPUP_CSS_URL . 'subscription/formAdmin.css');
		wp_enqueue_style('ypmFormAdminStyles');
		wp_register_script('ypmFormAdminJs', YPM_POPUP_JS_URL . 'subscription/formBackend.js', array('jquery', 'jquery-ui-sortable'));
		$backLocalizeData = array(
			'ajaxNonce' => wp_create_nonce('ycfAjaxNonce')
		);
		wp_localize_script('ypmFormAdminJs', 'ycfBackendLocalization', $backLocalizeData);

		wp_enqueue_script('ypmFormAdminJs');

	}

	private function createValidateObj($subsFields, $validationMessages = array())
	{

		$validateArray = array(
			'rules' => array(),
			'messages' => array()
		);

		//		$requiredMessage = $this->getOptionValue('ypm-subs-validation-message');
//		$emailMessage = $this->getOptionValue('ypm-subs-invalid-message');
//
//		if (empty($subsFields)) {
//			return $validateObj;
//		}
//
//		if (empty($emailMessage)) {
//			$emailMessage = 'defined message';
//		}
//
//		if (empty($requiredMessage)) {
//			$requiredMessage = 'defined message';
//		}
		$requiredMessage = YPM_FORM_REQUIRED_MESSAGE;
		$emailMessage = YPM_FORM_INVALID_EMAIL;

		foreach ($subsFields as $subsField) {

			if (empty($subsField['settings'])) {
				continue;
			}
			$settings = $subsField['settings'];
			$type = 'text';
			$name = '';
			$required = false;

			if (!empty($settings['required'])) {
				$required = $settings['required'];
			}

			if (!$required) {
				continue;
			}

			if (!empty($subsField['type'])) {
				$type = $subsField['type'];
			}
			if (!empty($subsField['name'])) {
				$name = $subsField['name'];
			}

			if ($type == 'email') {
				$validateArray['rules'][$name] = array('required' => $required, 'email' => true);
				$validateArray['messages'][$name] = array('required' => $requiredMessage, 'email' => $emailMessage);
				continue;
			}
			$validateArray['rules'][$name] = 'required';
			$validateArray['messages'][$name] = $requiredMessage;
		}

		return $validateArray;
	}

	private function getExpirationOptions()
	{
		$options = array(
			'ypm-popup-subscription-behavior',
			'ypm-popup-subscription-expiration-message',
			'ypm-popup-subscription-redirect-url',
			'ypm-popup-subscription-redirect-url-tab',
			'ypm-popup-subscription-enable-redirect',
			'ypm-popup-subscription-text-redirect-url'
		);

		$options = apply_filters('ypmContactOptions', $options);
		$keyValue = array();

		foreach ($options as $option) {
			$keyValue[$option] = $this->getOptionValue($option);
		}

		return $keyValue;
	}

	public function getSubscriptionFormObj()
	{

		$popupId = $this->getPopupId();
		require_once YPM_POPUP_CLASSES . 'form/YpmSubscriptionForm.php';
		$formObj = new YpmSubscriptionForm();
		$formObj->setFormId($popupId);

		return $formObj;
	}

	public function render($args)
	{
		$popupId = $this->getPopupId();

		if (!get_post_status($popupId)) {
			return '';
		}
		require_once(YPM_POPUP_CLASSES . 'form/YcfBuilder.php');
		$formData = $this->getSubscriptionFormObj()->getFormData();
		$validateObj = $this->createValidateObj($formData);

		$this->includeCss();
		$this->includeJs();

		$formBuilderObj = new YcfBuilder();
		$formBuilderObj->setFormId($popupId);
		$formBuilderObj->setFormElementsData($formData);
		$expirationOptions = $this->getExpirationOptions();

		$subscriptionForm = '<form 
			id="ycf-subscription-form"
			data-id="' . $popupId . '"
			class="ycf-subscription-form ycf-form-' . $popupId . '"
			action="admin-post.php"
			method="post"
			data-expiration-options=\'' . json_encode($expirationOptions) . '\'
			data-validate=\'' . json_encode($validateObj) . '\'
			>';
		$subscriptionForm .= $formBuilderObj->getFormFields();
		$subscriptionForm .= '</form>';

		return $subscriptionForm;
	}

	private function includeCss()
	{
		SubscriptionPopup::formCSS();
	}

	public static function formCSS() {
		$args = array();
		$args['styleSrc'] = YPM_POPUP_CSS_URL . '/form/';
		ScriptsManager::registerStyle('ycfFormStyle.css', $args);
		ScriptsManager::enqueueStyle('ycfFormStyle.css');
		ScriptsManager::registerStyle('theme1.css', $args);
		ScriptsManager::enqueueStyle('theme1.css');
	}

	public function includeJs()
	{
		$args = array();
		$args['dirUrl'] = YPM_POPUP_FRONT_JS_URL . 'subscription/';
		$args['dep'] = array('jquery');

		ScriptsManager::registerScript('YpmPopupValidate.js', array('dirUrl' => YPM_POPUP_FRONT_JS_URL, 'dep' => array('jquery')));
		ScriptsManager::enqueueScript('YpmPopupValidate.js');

		ScriptsManager::registerScript('YpmSubscription.js', $args);
		$backLocalizeData = array(
			'ajaxNonce' => wp_create_nonce('ycfAjaxNonce'),
			'ajaxurl' => admin_url('admin-ajax.php')
		);
		ScriptsManager::localizeScript('YpmSubscription.js', 'ypmFormLocalization', $backLocalizeData);
		ScriptsManager::enqueueScript('YpmSubscription.js');
	}

	public function renderView($args, $content)
	{
		return $this->render($args, $content);
	}

	public function subscribe($formData, $submitData)
	{
		require_once YPM_POPUP_CLASSES . 'form/YpmSubscriptionForm.php';
		$id = sanitize_text_field($submitData['formId']);
		$formObj = new YpmSubscriptionForm();
		$formObj->setFormId($id);

		$savedFields = $formObj->getFormData();
		$firstName = '';
		$lastname = '';
		$email = '';
		$data = array();
		foreach ($formData as $name => $value) {
			$foundKey = array_search($name, array_column($savedFields, 'name'));
			if (empty($savedFields[$foundKey])) {
				continue;
			}
			$fieldData = $savedFields[$foundKey];
			if ($fieldData['fieldType'] === 'firstName') {
				$firstName = $value;
			} else if ($fieldData['fieldType'] === 'lastName') {
				$lastname = $value;
			} else if ($fieldData['fieldType'] === 'email') {
				$email = $value;
			}
			$data[$name] = array('label' => $fieldData['label'], 'value' => $value);
		}

		global $wpdb;
		$selectForm = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . YPM_SUBSCRIBERS_TABLE_NAME . " WHERE email=%s", $email);
		$selectResult = $wpdb->query($selectForm);
		$date = date('Y-m-d');
		if (!$selectResult) {
			$insertToFieldsQuery = $wpdb->prepare("INSERT INTO " . $wpdb->prefix . YPM_SUBSCRIBERS_TABLE_NAME . " 
				(firstName, lastName, email, formId, popupId, cDate, status, `options`) 
					VALUES (%s, %s, %s, %d, %d, %s, %d, %s)",
				$firstName, $lastname, $email, $id, $this->getId(), $date, 1, json_encode($data));
			$wpdb->query($insertToFieldsQuery);
		} else {
			$fieldsUpdateSql = $wpdb->prepare("UPDATE " . $wpdb->prefix . YPM_SUBSCRIBERS_TABLE_NAME . " SET 
				firstName=%s, lastName=%s, email=%s, cDate=%s, options=%s  WHERE form_id=%d", $firstName, $lastname, $email, $date);
			$wpdb->query($fieldsUpdateSql);
		}

		return json_encode($data);
	}

	private function getFormMessage($formData)
	{
		$popupId = $this->getPopupId();
		$formObj = new YpmSubscriptionForm();
		$formObj->setFormId($popupId);
		$formOptionsData = $formObj->getFormList();
		$message = $this->getOptionValue('ypm-subscription-message');

		$patternFormData = '/\[form_data]/';

		$formDataString = '';

		foreach ($formData as $name => $value) {
			foreach ($formOptionsData as $optionData) {
				if ($name == $optionData['name']) {
					$sendData[$optionData['label']] = $value;
					$formDataString .= "<b>" . $optionData['label'] . "</b>: " . $value . '<br>';
					continue;
				}
			}
		}

		$message = preg_replace($patternFormData, $formDataString, $message);

		return $message;
	}

	public static function getAllSubscriptionForms()
	{
		global $wpdb;
		$subscribersTableName = $wpdb->prefix . YPM_SUBSCRIBERS_TABLE_NAME;
		$postsTableName = $wpdb->prefix . 'posts';

		$query = 'SELECT '.esc_attr($subscribersTableName).'.* , '.esc_attr($postsTableName).'.post_title as postTitle from ' . esc_attr($subscribersTableName) . ' LEFT JOIN ' . esc_attr($postsTableName) . ' ON ' . esc_attr($subscribersTableName) . '.formId = ' . esc_attr($postsTableName) . '.ID';
		$results = $wpdb->get_results($query, ARRAY_A);
		$subscriptions = array();

		// when there is not any result
		if (empty($results)) {
			return $subscriptions;
		}
		foreach ($results as $result) {
			// $result is assoc array
			$id = (int)$result['formId'];
			$title = '(no title)';
			if (!empty($result['title'])) {
				$title = $result['title'];
			}
			$subscriptions[$id] = $title .' '.$id;
		}

		return $subscriptions;
	}

	public static function getAllSubscribersDate() {
		$subsDateList = array();
		global $wpdb;
		$subscriptionPopups = $wpdb->get_results('SELECT id, cDate FROM '.$wpdb->prefix.YPM_SUBSCRIBERS_TABLE_NAME, ARRAY_A);

		if (empty($subscriptionPopups)) {
			return $subsDateList;
		}

		foreach ($subscriptionPopups as $subscriptionForm) {
			$id = $subscriptionForm['id'];
			$date = substr($subscriptionForm['cDate'], 0, 7);

			$subsDateList[$id]['date-value'] = $date;
			$subsDateList[$id]['date-title'] = \YpmAdminHelper::getFormattedDate($date);
		}

		return $subsDateList;
	}

	public function getSubPopupObj()
	{
		$subPopupId = $this->getOptionValue('ypm-popup-sub-id');
		if (empty($subPopupId)) {
			return false;
		}
		$popup = Popup::find($subPopupId);
		if (empty($popup)) {
			return false;
		}
		if ($popup->getOptionValue('ypm-popup-subscription-behavior') === 'openPopup') {

			$closePopup = $popup->getOptionValue('ypm-popup-subscription-popup');
			$subPopupObj = self::find($closePopup);

			if (!empty($subPopupObj) && ($subPopupObj instanceof Popup) && get_post_status($closePopup) != 'trash') {
				// We remove all events because this popup will be open after successful subscription
				//$subPopupObj->setEvents(array('param' => 'click', 'value' => ''));
				$subPopupObj->options['ypm-events-settings'] = array(array('param' => 'click', 'value' => ''));
				return [$subPopupObj];
			}
		}
	}
}