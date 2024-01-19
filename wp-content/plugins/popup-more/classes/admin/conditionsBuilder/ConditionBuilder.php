<?php
namespace YpmPopup;

use \YpmAdminHelper;

class ConditionBuilder {

	private $columnCount = 3;
	private $valueFromFirst = true;
	private $currentIndex;
	private $nameString = '';
	private $paramKey;
	private $configData;
	private $savedData = array();
	private $popupId;

	public function setColumnCount($columnCount) {
		$this->columnCount = $columnCount;
	}

	public function getColumnCount() {
		return $this->columnCount;
	}

	public function setValueFromFirst($valueFromFirst) {
		$this->valueFromFirst = (bool)$valueFromFirst;
	}

	public function getValueFromFirst() {
		return (bool)$this->valueFromFirst;
	}

	public function setSavedData($savedData) {
		$this->savedData = $savedData;
	}

	public function getSavedData() {
		return $this->savedData;
	}

	public function setConfigData($configData) {
		$this->configData = $configData;
	}

	public function getConfigData() {
		return $this->configData;
	}

	public function setCurrentIndex($currentIndex) {
		$this->currentIndex = $currentIndex;
	}

	public function getCurrentIndex() {
		return $this->currentIndex;
	}

	public function setNameString($nameString) {
		$this->nameString = $nameString;
	}

	public function getNameString() {
		return $this->nameString;
	}

	public function setParamKey($paramKey) {
		$this->paramKey = $paramKey;
	}

	public function getParamKey() {
		return $this->paramKey;
	}

	public function setPopupId($popupId) {
		$this->popupId = $popupId;
	}

	public function getPopupId() {
		return $this->popupId;
	}

	public function getChildClassName() {
		$path = explode('\\', get_class($this));

		return array_pop($path);
	}

	public function render() {
		$childClassName = $this->getChildClassName();
		$content = '<div class="ypm-conditions-wrapper" data-child-class="'.$childClassName.'">';
		$content .= $this->renderConditions();
		$content .= '</div>';

		return $content;
	}

	private function renderConditions() {
		$savedData = $this->getSavedData();

		if(empty($savedData)) {
			return '<div>'.__('No Data', YPM_POPUP_TEXT_DOMAIN).'</div>';
		}
		$conditions = '';
		foreach($savedData as $currentIndex => $data) {
			$this->setValueFromFirst(true);
			$conditions .=  $this->getConditionRowFromCurrentData($data, $currentIndex);
		}

		return $conditions;
	}

	private function getConditionRowFromCurrentData($data, $currentIndex) {

		$configData = $this->getConfigData();

		$configValues = $configData['values'];
		$attributes = $configData['attributes'];
		$valueFromFirst = $this->getValueFromFirst();

		$conditions = '<div class="ypm-condition-wrapper row form-group" data-value-from-first="'.$valueFromFirst.'" data-condition-id="'.esc_attr($currentIndex).'">';

		if(empty($data['key3']) && isset($configData['values'][$data['key1']])) {
			$data['key3'] = '';
		}

		$currentConditionIndex = 1;

		foreach($data as $keyName => $value) {
			$valueFromFirst = $this->getValueFromFirst();

			$paramKey = $keyName;

			// get 3th column key
			if($currentConditionIndex > 1) {

				if($valueFromFirst) {
					if($keyName == 'key3') {
						$paramKey = $data['key1'];
					}
				}
				else {
					$lastIndex = $currentConditionIndex-1;
                    $paramKey = $this->getParamKeyValue($lastIndex, $data, $configValues);
				}
			}

			if(empty($attributes[$paramKey])) {
				continue;
			}
            $this->setParamKey($paramKey);
			++$currentConditionIndex;
			$this->setCurrentIndex($currentIndex);
			$attributes[$paramKey]['savedValue'] = $value;

			$conditions .= $this->renderCurrentConditionRow($configValues, $attributes, $keyName, $currentIndex);
		}

		$conditions .= $this->renderConditionConfig($currentIndex, $data);
		$conditions .= '</div>';

		return $conditions;
	}

	private function getParamKeyValue($lastIndex, $data, $configValues)
    {
        if ($data['key'.$lastIndex] !== '') {
            return $data['key'.$lastIndex];
        }
        $prevIndex = $lastIndex-1;
        $prevSelected = $data['key'.$prevIndex];
        if (!empty($configValues[$prevSelected]) && is_array($configValues[$prevSelected])) {
            return key($configValues[$prevSelected]);
        }

        return '';
    }

	public function renderCurrentConditionRow($configValues, $attributes, $keyName, $key) {
		$paramKey = $this->getParamKey();
		$nameString = $this->getNameString();

		$name = $nameString.'['.$key.']['.$keyName.']';

		$currentData = @$configValues[$paramKey];
		$currentAttributes = $attributes[$paramKey];
		$this->filterForFromFirstValue($configValues, $attributes, $paramKey, $key);
		$conditions = $this->renderConditionRow($name, $currentData, $currentAttributes);

		return $conditions;
	}

	private function filterForFromFirstValue($configValues, $attributes, $keyName, $key)
	{
		if (empty($attributes[$keyName])) {
			return false;
		}

		$currentAttributes = $attributes[$keyName];
		if (empty($currentAttributes['savedValue'])) {
			return false;
		}
		$savedValue = $currentAttributes['savedValue'];

		if (!is_null(@$attributes[$savedValue]) && @isset($attributes[$savedValue]['allowFromFirstValue'])) {
			$this->setValueFromFirst($attributes[$savedValue]['allowFromFirstValue']);
		}

		return true;
	}

	private function renderConditionRow($name, $currentData, $attributes) {
		$fieldType = $attributes['fieldType'];
		$savedValue = $attributes['savedValue'];
		$fieldHtml = '<div class="col-md-3">';

		$fieldHtml .= $this->rowHeader($name, $currentData, $attributes);
		$fieldAttributes = $attributes['fieldAttributes'];

		if($fieldType == 'select') {
			if(!empty($fieldAttributes['multiple'])) {
				$name .= '[]';
			}
			$fieldAttributes['name'] = $name;
			if(!empty($fieldAttributes['data-select-type']) && $fieldAttributes['data-select-type'] == 'ajax') {
				$currentData = $savedValue;
				if (!empty($savedValue)) {
					$savedValue = @array_keys($savedValue);
				}
				else {
					$savedValue = array();
				}
			}
			$fieldHtml .= YpmAdminHelper::selectBox($currentData, $savedValue, $fieldAttributes);
		}
		else if ($fieldType == 'input') {
			$fieldAttributes['name'] = $name;
			$fieldHtml .= YpmAdminHelper::inputElement($currentData, $savedValue, $fieldAttributes);
		}
		$fieldHtml .= '</div>';

		return $fieldHtml;
	}

	private function rowHeader($name, $currentData, $attributes) {
		$fieldHtml = '<div class="ypm-condition-header">';

		if(!empty($attributes['label'])) {
			$fieldHtml .= '<label>'.__($attributes['label'], YPM_POPUP_TEXT_DOMAIN).'</label>';
		}
		$fieldHtml .= '</div>';

		return $fieldHtml;
	}

	private function renderConditionConfig($currentConditionIndex, $data)
    {
		if(empty($data) || $data['key1'] == 'select_settings') {
			return '';
		}

        $configData = $this->getConfigData();
		$currentData = $configData['attributes'][$this->getParamKey()];
		$conf = !empty($currentData['conditionsConf']) ? true: false;
		ob_start();
		?>
        <div class="col-md-3">
            <div class="ypm-condition-header ypm-conditions-buttons"><label></label></div>
            <div data-condition-id="<?php echo esc_attr($currentConditionIndex)?>" class="ypm-condition-add btn btn-primary">
                <?php  _e('Add', YPM_POPUP_TEXT_DOMAIN); ?>
            </div>
            <?php if ($conf): ?>
                <div data-condition-id="<?php echo esc_attr($currentConditionIndex); ?>" class="ypm-condition-settings btn btn-info">
                    <?php _e('Settings', YPM_POPUP_TEXT_DOMAIN); ?>
                </div>
                <div style="position: absolute; left: -9000000px;">
                    <div id="ypm-setting-<?php echo esc_attr($currentConditionIndex); ?>">
                        <h1>Settings</h1>
                        <?php echo $this->renderSettingsContent($configData, $currentConditionIndex); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div data-condition-id="<?php echo esc_attr($currentConditionIndex); ?>" class="ypm-condition-delete btn btn-danger">
                <?php _e('Delete', YPM_POPUP_TEXT_DOMAIN); ?>
            </div>
        </div>
        <?php
		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}

	public function renderConditionRowFromParam($data, $currentIndex) {
        $key2 = '';
        if (is_array($data)) {
            $param = $data[0];
            $key2 = $data[1];
        }
        else {
            $param = $data;
        }

        $key3Val = '';
		if (!empty($this->getConfigData()['attributes'][$key2]['fieldAttributes']['defaultValue'])) {
			$key3Val = $this->getConfigData()['attributes'][$key2]['fieldAttributes']['defaultValue'];

			$key3Val = str_replace( '{popupId}', $this->getPopupId(), $key3Val);
		}
		$savedData = array(
			'key1' => $param,
			'key2' => $key2,
			'key3' => $key3Val
		);
		if($param == 'select_settings') {
			$savedData = array(
				'key1' => $param
			);
		}

		return $this->getConditionRowFromCurrentData($savedData, $currentIndex);
	}

	private function renderSettingsContent($data, $currentIndex)
    {
        $settings = $data['attributes'][$this->getParamKey().'_settings'];
        $nameString = $this->getNameString();
        $savedData = $this->getSavedData();
        $savedSettings = $savedData[$currentIndex]['key3'];
        $name = $nameString.'['.$currentIndex.'][key3]';

        ob_start();
        foreach ($settings as $setting) {
            $fieldType = $setting['fieldType'];
            $infoAttrs = $setting['infoAttrs'];
            $htmlAttrs = $setting['htmlAttrs'];
            $attrName = $htmlAttrs['name'];
            $savedValue = @$savedSettings[$attrName];
            $htmlAttrs['name'] = $name.'['.$attrName.']';
            ?>
            <div class="form-group row">
                <div class="col-md-6">
                    <label <?php echo YpmAdminHelper::formatHTMLAttrStr($infoAttrs['labelAttrs'])?>><?php echo  $infoAttrs['label']; ?></label>
                </div>
                <div class="col-md-6">
                    <?php
                    if($fieldType == 'select') {
                        echo YpmAdminHelper::selectBox(array(), $savedValue, $htmlAttrs);
                    }
                    else if ($fieldType == 'input') {
                        echo YpmAdminHelper::inputElement('', $savedValue, $htmlAttrs);
                    }
                    else if ($fieldType == 'switch') {
                        echo YpmAdminHelper::switchElement('', $savedValue, $htmlAttrs);
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        $html = ob_get_contents();
        ob_end_clean();

        return '<div class="ycf-bootstrap-wrapper ypm-popup-content-wrapper">'.$html.'</div>';
    }

	public function filterForSave() {
		$settings = $this->getSavedData();
		$configData = $this->getConfigData();

		$configValues = $configData['values'];
		$attributes = $configData['attributes'];

		foreach($settings as $index => $setting) {
			$valueFromFirst = $this->getValueFromFirst();
			$valueKey = $setting['key1'];
			if (!$valueFromFirst) {
				$valueKey = $setting['key2'];
			}
			if(empty($setting['key3'])) {
				$settings[$index]['key3'] = array();
				continue;
			}
			$currentAttributes = $attributes[$valueKey]['fieldAttributes'];
			if(!empty($currentAttributes['data-select-type'])) {

				$args = array(
					'post__in' => array_values($setting['key3']),
					'posts_per_page' => 10,
					'post_type'      => $currentAttributes['data-post-type']
				);

				$searchResults = YpmAdminHelper::getPostTypeData($args);
				$settings[$index]['key3'] = $searchResults;
			}
		}

		return $settings;
	}
}