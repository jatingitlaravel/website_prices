<?php
namespace YpmPopup;
use YpmPopup\DataConfig;
use \DateTime;

class Ajax
{
	public function __construct()
	{
		if(YPM_POPUP_PKG != YPM_POPUP_FREE) {
			require_once YPM_POPUP_CLASSES . 'form/YcfForm.php';
		}
		$this->init();
	}

	public function init()
	{
		add_action('wp_ajax_ypm-change-element-data', array($this, 'ycfChangeElementData'));
		add_action('wp_ajax_ypm-remove-element-from-list', array($this, 'ycfRemoveElementFromList'));
		add_action('wp_ajax_ypm-add-sub-option-option', array($this, 'ycfAddSubOption'));
		add_action('wp_ajax_ypm-delete-sub-option', array($this, 'ypmDeleteSubOption'));
		add_action('wp_ajax_ypm-sub-option-change', array($this, 'ypmSubOptionChange'));
		add_action('wp_ajax_ypm_change_popup_status', array($this, 'ypmChangePopupStatus'));
		add_action('wp_ajax_ypm_export_subscription', array($this, 'ypmExportSubscription'));

		// review panel
		add_action('wp_ajax_ypm_dont_show_review_notice', array($this, 'dontShowReview'));
		add_action('wp_ajax_ypm_change_review_show_period', array($this, 'changeReviewPeriod'));

		add_action('wp_ajax_ypm_increment_popup_count', array($this, 'incrementPopupCount'));
		add_action('wp_ajax_nopriv_ypm_increment_popup_count', array($this, 'incrementPopupCount'));

		add_action('wp_ajax_ypm_reset_view_count', array($this, 'resetViewCount'));

		// conditions builder
		add_action('wp_ajax_ypm_select2_search_data', array($this, 'select2Ajax'));
		add_action('wp_ajax_ypm_edit_conditions_row', array($this, 'conditionsRow'));
		add_action('wp_ajax_ypm_add_conditions_row', array($this, 'conditionsRow'));

		add_action('wp_ajax_ypm_subscribed', array($this, 'subscribe'));
		add_action('wp_ajax_nopriv_ypm_subscribed', array($this, 'subscribe'));
		add_action('wp_ajax_ypm_subscribers_delete', array($this, 'subscribersDelete'));

		add_action('wp_ajax_ypm-shape-form-element', array($this, 'YcfShapeElementsList'));
	}

	public function YcfShapeElementsList()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		check_ajax_referer('ycfAjaxNonce', 'ajaxNonce');
		$formElement = $_POST['formElements'];

		require_once YPM_POPUP_CLASSES.'form/YpmSubscriptionForm.php';
		$formDataObj = new YpmSubscriptionForm();
		$currentElement = $formDataObj->getFormDefaultConfigByKey($formElement['type']);

		if($_POST['modification'] == 'add-element') {
			$this->addElementsToList($currentElement);
		}

		$args['oderId'] = $formElement['orderNumber'];

		$element = YcfForm::createAdminViewHtml($currentElement, $args);

		echo $element;
		die();
	}

	public function addElementsToList($formElement)
	{
		$formListData = get_option('YcfPopupFormDraft');

		$formSize = sizeof($formListData);

		array_splice($formListData, $formSize, 0, array($formElement));

		update_option('YcfPopupFormDraft', $formListData);
	}

	public function select2Ajax() {
		check_ajax_referer('ypm_ajax_nonce', 'nonce_ajax');
		DataConfig::conditionInit();
		$postTypeName = sanitize_text_field($_POST['postType']);
		$search = sanitize_text_field($_POST['searchTerm']);

		$args	 = array(
			's'			 => $search,
			'post__in'		=> ! empty( $_REQUEST['include'] ) ? array_map( 'intval', $_REQUEST['include'] ) : null,
			'page'		 => ! empty( $_REQUEST['page'] ) ? absint( $_REQUEST['page'] ) : null,
			'posts_per_page' => 100,
			'post_type'	 => $postTypeName
		);

		$searchResults = \YpmAdminHelper::getPostTypeData($args);

		if (empty($searchResults)) {
			$results['items'] = array();
		}

		/*Selected custom post type convert for select2 format*/
		foreach ($searchResults as $id => $name) {
			$results['items'][] = array(
				'id'	=> $id,
				'text' => $name
			);
		}

		echo json_encode($results);
		wp_die();
	}

	public function conditionsRow() {

		check_ajax_referer('ypm_ajax_nonce', 'nonce');
		DataConfig::conditionInit();
		$selectedParams = $_POST['selectedParams'];
		$conditionId = (int)$_POST['conditionId'];
		$childClassName = $_POST['conditionsClassName'];
		$childClassName = __NAMESPACE__.'\\'.$childClassName;
		$obj = new $childClassName();
		$obj->setPopupId($_POST['popupId']);

		$data = $selectedParams;
		if (!empty($obj->getConfigData()['attributes'][$selectedParams]['fieldAttributes']['defaultValue'])) {
			$data = array($selectedParams);
			$key2Def = $obj->getConfigData()['attributes'][$selectedParams]['fieldAttributes']['defaultValue'];
			array_push($data, $key2Def);
		}

		echo $obj->renderConditionRowFromParam($data, $conditionId);
		wp_die();
	}

	public function changeReviewPeriod()
	{
		check_ajax_referer('ypmReviewNotice', 'ajaxNonce');
		$messageType = sanitize_text_field($_POST['messageType']);

		$timeDate = new DateTime('now');
		$timeDate->modify('+'.YPM_SHOW_REVIEW_PERIOD.' day');

		$timeNow = strtotime($timeDate->format('Y-m-d H:i:s'));
		update_option('YpmShowNextTime', $timeNow);
		$usageDays = get_option('YpmUsageDays');
		$usageDays += YPM_SHOW_REVIEW_PERIOD;
		update_option('YpmUsageDays', $usageDays);

		echo YPM_AJAX_SUCCESS;
		wp_die();
	}

	public function dontShowReview()
	{
		check_ajax_referer('ypmReviewNotice', 'ajaxNonce');
		update_option('YpmDontShowReviewNotice', 1);

		echo YPM_AJAX_SUCCESS;
		wp_die();
	}

	public function ycfRemoveElementFromList()
	{

		check_ajax_referer('ycfAjaxNonce', 'ajaxNonce');

		$elementData = $_POST['removeElementData'];
		$elementId = $elementData['id'];
		$draftElements = get_option('YcfPopupFormDraft');

		foreach ($draftElements as $key => $draftElement) {
			if($elementId == $draftElement['id']) {
				unset($draftElements[$key]);
			}
		}

		update_option('YcfPopupFormDraft', $draftElements);
		echo '1';
		die();
	}


	public function ycfChangeElementData()
	{
		check_ajax_referer('ycfAjaxNonce', 'ajaxNonce');

		$elementData = $_POST['editElementData'];
		$formId = $elementData['formCurrentId'];
		$changedElementId = $elementData['changedElementId'];
		$changedValue = $elementData['changedElementValue'];
		$changedKey = $elementData['changedElementKey'];

		if($formId == 0) {
			$formListData = get_option('YcfPopupFormDraft');
		}
		else {
			ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
			$key = 'YpmSubscription';
			if (!empty($_POST['formKey'])) {
				$key = sanitize_text_field($_POST['formKey']);
			}
			require_once YPM_POPUP_CLASSES.'form/'.esc_attr($key).'Form.php';
			$className = __NAMESPACE__.'\\'.esc_attr($key).'Form';
			$formObj = new $className;
			$formObj->setFormId($formId);
			$formListData = $formObj->getFormList();
		}

		if(is_array($formListData) && !empty($formListData)) {
			foreach($formListData as $key => $currentListFieldData) {
				if($currentListFieldData['id'] == $changedElementId) {
					if (!empty($_POST['isSettings'])) {
						$formListData[$key]['settings'][$changedKey] = $changedValue;
						break;
					}
					$formListData[$key][$changedKey] = $changedValue;
				}
			}
		}

		update_option('YcfPopupFormDraft', $formListData);
	}

	public function ycfAddSubOption()
	{
		check_ajax_referer('ycfAjaxNonce', 'ajaxNonce');
		$formId  = (int)$_POST['contactFormId'];
		$elementId = (int)$_POST['elementId'];
		$elementType = sanitize_text_field($_POST['elementType']);
		$elementOrderId = (int)$_POST['elementOrderId'];
		$newSubOptionName = sanitize_text_field($_POST['newSubOptionName']);
		$newSubOptionLabel = sanitize_text_field($_POST['newSubOptionLabel']);

		$elementOptions = $this->getElementOptionsById($formId, $elementId);

		$fieldOptions =  json_decode($elementOptions['fieldsOptions'], true);
		$fieldOptions =  $elementOptions['fieldsOptions'];
		$fieldsOrder =  json_decode($elementOptions['fieldsOrder'], true);
		$fieldsOrder =  $elementOptions['fieldsOrder'];

		$newSubOption = array(
			'label' => 	$newSubOptionLabel,
			'value' => $newSubOptionName,
			'orderId' => $elementOrderId,
			'options' => ''
		);
		$fieldOptions[] = $newSubOption;
		$fieldsOrder[] = $elementOrderId;
		//$fieldOptions = json_encode($fieldOptions);
		//$fieldsOrder = json_encode($fieldsOrder);
		$elementOptions['fieldsOptions'] = addslashes($fieldOptions);
		$elementOptions['fieldsOptions'] = $fieldOptions;
		$elementOptions['fieldsOrder'] = addslashes($fieldsOrder);
		$elementOptions['fieldsOrder'] = $fieldsOrder;

		//$elementOptions = json_encode($elementOptions);
		$this->changeElementOptions($formId, $elementId, $elementOptions);

		echo YcfForm::subOptionsGroupOptions($elementOrderId, $elementId, $newSubOptionName, $newSubOptionLabel);
		die();
	}

	public function getElementOptionsById($formId, $elementId)
	{
		$formListData = get_option("YcfPopupFormDraft");

		$optionsData = array();

		if(empty($formListData)) {
			return $optionsData;
		}

		foreach ($formListData as $key => $draftElement) {
			if($elementId == $draftElement['id']) {
				$optionData = $formListData[$key];
			}
		}

		if(empty($optionData['options'])) {
			return $optionsData;
		}

		$options = $optionData['options'];

		return $options;
	}

	public function changeElementOptions($formId, $elementId, $options)
	{
		$formListData = get_option('YcfPopupFormDraft');

		if(!$formListData) {
			return true;
		}

		foreach ($formListData as $key => $draftElement) {
			if($elementId == $draftElement['id']) {
				$formListData[$key]['options'] = $options;
			}
		}

		update_option('YcfPopupFormDraft', $formListData);
	}

	public function ypmDeleteSubOption()
	{
		check_ajax_referer('ycfAjaxNonce', 'ajaxNonce');

		$formId  = $_POST['contactFormId'];
		$elementId = $_POST['elementId'];
		$elementType = $_POST['elementType'];
		$elementOrderId = $_POST['elementOrderId'];
		$elementName = $_POST['elementName'];
		$elementValue = $_POST['elementValue'];
		$modificationType = $_POST['modificationType'];

		$elementOptions = $this->getElementOptionsById($formId, $elementId);

		$fieldOptions =  $elementOptions['fieldsOptions'];
		$fieldsOrder =  $elementOptions['fieldsOrder'];
		$modifiedOptions = $fieldOptions;

		foreach($fieldOptions as $key => $field) {
			if($field['orderId'] == $elementOrderId) {
				unset($modifiedOptions[$key]);

				if(($fieldsOrderKey = array_search($elementOrderId,$fieldsOrder)) !== false) {
					unset($fieldsOrder[$fieldsOrderKey]);
				}
			}
		}

		$elementOptions['fieldsOptions'] = $modifiedOptions;
		$elementOptions['fieldsOrder'] = $fieldsOrder;

		$this->changeElementOptions($formId, $elementId, $elementOptions);

		echo "";
		wp_die();
	}

	public function ypmSubOptionChange()
	{
		check_ajax_referer('ycfAjaxNonce', 'ajaxNonce');

		$formId  = $_POST['contactFormId'];
		$elementId = $_POST['elementId'];
		$elementType = $_POST['elementType'];
		$elementOrderId = $_POST['elementOrderId'];
		$elementName = $_POST['elementName'];
		$elementValue = $_POST['elementValue'];
		$modificationType = $_POST['modificationType'];

		$elementOptions = $this->getElementOptionsById($formId, $elementId);

		$fieldOptions =  $elementOptions['fieldsOptions'];

		if($modificationType == 'change') {
			foreach($fieldOptions as $key => $field) {
				if($field['orderId'] == $elementOrderId) {
					$fieldOptions[$key][$elementName] = $elementValue;
				}
			}

			$fieldOptions = $fieldOptions;
			$elementOptions['fieldsOptions'] = $fieldOptions;
		}
		$elementOptions = $elementOptions;
		$this->changeElementOptions($formId, $elementId, $elementOptions);
	}


	public function ypmChangePopupStatus()
	{
		check_ajax_referer('ypmPmNonce', 'ajaxNonce');
		$popupId = (int)$_POST['postId'];
		$popupSavedData = Popup::getSavedData($popupId);
		$checkedValue = $_POST['value'] == 'true' ? 'checked': '';
		$popupSavedData['ypm-is-active'] = $checkedValue;
		update_post_meta($popupId, "ypm-data", $popupSavedData);

		echo 1;
		wp_die();
	}

	public function incrementPopupCount()
	{
		check_ajax_referer('ypmPMNonce', 'ajaxNonce');
		$popupId = sanitize_text_field($_POST['popupId']);
		$keyName = 'YpmPopupCount'.$popupId;

		$popupCounts = get_option($keyName);
		if (empty($popupCounts)) {
			$popupCounts = 0;
		}
		$popupCounts += 1;

		update_option($keyName, $popupCounts);

		echo 1;
		wp_die();
	}

	public function resetViewCount()
	{
		check_ajax_referer('ypmPmNonce', 'nonce');
		$postId = sanitize_text_field($_POST['postId']);
		update_option('YpmPopupCount'.$postId, 0);

		echo 1;
		wp_die();
	}

	public function subscribe() {
		check_ajax_referer('ycfAjaxNonce', 'nonce');
		parse_str (sanitize_text_field($_POST['formData']), $sendResult);
		$formId = sanitize_text_field($_POST['formId']);

		$obj = Popup::findByIdAndType(YPM_SUBSCRIPTION_POST_TYPE, $formId);
		if (empty($obj)) {
			echo 0;
			wp_die();
		}
		echo $obj->subscribe($sendResult, $_POST);
		wp_die();
	}

	public function subscribersDelete() {
		check_ajax_referer('ypm_ajax_nonce', 'nonce');
		global $wpdb;

		$query = 'DELETE FROM '.$wpdb->prefix.YPM_SUBSCRIBERS_TABLE_NAME.' WHERE id in ('.esc_attr(implode($_POST['subscribersId'], ', ')).')';
		$wpdb->get_results($query);

		wp_die();
	}

	public function ypmExportSubscription() {
		check_ajax_referer('ypm_ajax_nonce', 'nonce');
		$value = sanitize_text_field($_POST['value']);
		global $wpdb;

		$queryStr = 'Select * from '.$wpdb->prefix.YPM_SUBSCRIBERS_TABLE_NAME;
		if ($value !== 'all') {
			$queryStr .= ' where formId='.(int)$value;
		}
		$data = $wpdb->get_results($queryStr, ARRAY_A);

		$csv_content = "email,first name,last name,from id";

		foreach ($data as $currentRow) {
			$csv_content .= "\n".esc_attr($currentRow['email']).","
				.esc_attr($currentRow['firstName']).","
				.esc_attr($currentRow['lastName']).","
				.esc_attr($currentRow['formId']);
		}

		// Output the CSV content for download
		echo $csv_content;

		wp_die();
	}
}

new Ajax();