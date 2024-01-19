<?php
class YpmPopupData {

	public static function popupDefaultData() {

		$dataArray = array();
		$dataArray['ypm-popup-width'] = '';
		$dataArray['ypm-popup-height'] = '';

 		return apply_filters('YpmDefaultDataValues', $dataArray);
	}

	public static function popupOptionsKeys() {

		$popupOptions = self::popupDefaultData();
		if(empty($popupOptions)) {
			return array();
		}
		$popupOptionsName = array_keys($popupOptions);

		return $popupOptionsName;
	}

	public static function defaultsData() {

		$defaults = array();

		$defaults['themes'] = array(
			'colorbox1',
			'colorbox2',
			'colorbox3',
			'colorbox4',
			'colorbox5',
			'colorbox6'
		);

		$defaults['openAnimationEffects'] = array(
			'No effect' => __('None', YPM_POPUP_TEXT_DOMAIN),
			'ypm-flip' => __('Flip', YPM_POPUP_TEXT_DOMAIN),
			'ypm-shake' => __('Shake', YPM_POPUP_TEXT_DOMAIN),
			'ypm-wobble' => __('Wobble', YPM_POPUP_TEXT_DOMAIN),
			'ypm-swing' => __('Swing', YPM_POPUP_TEXT_DOMAIN),
			'ypm-flash' => __('Flash', YPM_POPUP_TEXT_DOMAIN),
			'ypm-bounce' => __('Bounce', YPM_POPUP_TEXT_DOMAIN),
			'ypm-bounceInRight' => __('BounceInRight', YPM_POPUP_TEXT_DOMAIN),
			'ypm-bounceIn' => __('BounceIn', YPM_POPUP_TEXT_DOMAIN),
			'ypm-pulse' => __('Pulse', YPM_POPUP_TEXT_DOMAIN),
			'ypm-rubberBand' => __('RubberBand', YPM_POPUP_TEXT_DOMAIN),
			'ypm-tada' => __('Tada', YPM_POPUP_TEXT_DOMAIN),
			'ypm-slideInUp' => __('SlideInUp', YPM_POPUP_TEXT_DOMAIN),
			'ypm-jello' => __('Jello', YPM_POPUP_TEXT_DOMAIN),
			'ypm-rotateIn' => __('RotateIn', YPM_POPUP_TEXT_DOMAIN),
			'ypm-fadeIn' => __('FadeIn', YPM_POPUP_TEXT_DOMAIN)
		);

		$defaults['closeAnimationEffects'] = array(
			'No effect' => __('None', YPM_POPUP_TEXT_DOMAIN),
			'ypm-flipInX' => __('Flip', YPM_POPUP_TEXT_DOMAIN),
			'ypm-shake' => __('Shake', YPM_POPUP_TEXT_DOMAIN),
			'ypm-wobble' => __('Wobble', YPM_POPUP_TEXT_DOMAIN),
			'ypm-swing' => __('Swing', YPM_POPUP_TEXT_DOMAIN),
			'ypm-flash' => __('Flash', YPM_POPUP_TEXT_DOMAIN),
			'ypm-bounce' => __('Bounce', YPM_POPUP_TEXT_DOMAIN),
			'ypm-bounceOutLeft' => __('BounceOutLeft', YPM_POPUP_TEXT_DOMAIN),
			'ypm-bounceOut' => __('BounceOut', YPM_POPUP_TEXT_DOMAIN),
			'ypm-pulse' => __('Pulse', YPM_POPUP_TEXT_DOMAIN),
			'ypm-rubberBand' => __('RubberBand', YPM_POPUP_TEXT_DOMAIN),
			'ypm-tada' => __('Tada', YPM_POPUP_TEXT_DOMAIN),
			'ypm-slideOutUp' => __('SlideOutUp', YPM_POPUP_TEXT_DOMAIN),
			'ypm-jello' => __('Jello', YPM_POPUP_TEXT_DOMAIN),
			'ypm-rotateOut' => __('RotateOut', YPM_POPUP_TEXT_DOMAIN),
			'ypm-fadeOut' => __('FadeOut', YPM_POPUP_TEXT_DOMAIN)
		);

		$defaults['fbButtons'] = array(
			'likeButton' => __('Like Button', YPM_POPUP_TEXT_DOMAIN),
			'shareButton' => __('Share Button', YPM_POPUP_TEXT_DOMAIN)
		);

		$defaults['ageRestriction'] = array(
			'yesNo' => __('Yes/No', YPM_POPUP_TEXT_DOMAIN),
			'ageVerification' => __('Age Verification', YPM_POPUP_TEXT_DOMAIN)
		);

		$defaults['contactFormTabs'] = array(
			'fields' => __('Contact form fields', YPM_POPUP_TEXT_DOMAIN),
			'design' => __('Contact form design', YPM_POPUP_TEXT_DOMAIN),
			'submitOption' => __('Submit Options', YPM_POPUP_TEXT_DOMAIN),
			'options' => __('Options', YPM_POPUP_TEXT_DOMAIN)
		);

		$defaults['subscriptionTabs'] = array(
			'fields' => __('Subscription form fields', YPM_POPUP_TEXT_DOMAIN),
			'design' => __('Subscription form design', YPM_POPUP_TEXT_DOMAIN),
//			'submitOption' => __('Submit Options', YPM_POPUP_TEXT_DOMAIN),
			'options' => __('Options', YPM_POPUP_TEXT_DOMAIN)
		);

		$defaults['youtubeColors'] = array(
			'read' => __('Read', YPM_POPUP_TEXT_DOMAIN),
			'white' => __('White', YPM_POPUP_TEXT_DOMAIN)
		);

		$defaults['dimensionsSizes'] = array(
			'auto' => __('Auto', YPM_POPUP_TEXT_DOMAIN),
			'10' => __('10%', YPM_POPUP_TEXT_DOMAIN),
			'20' => __('20%', YPM_POPUP_TEXT_DOMAIN),
			'30' => __('30%', YPM_POPUP_TEXT_DOMAIN),
			'40' => __('40%', YPM_POPUP_TEXT_DOMAIN),
			'50' => __('50%', YPM_POPUP_TEXT_DOMAIN),
			'60' => __('60%', YPM_POPUP_TEXT_DOMAIN),
			'70' => __('70%', YPM_POPUP_TEXT_DOMAIN),
			'80' => __('80%', YPM_POPUP_TEXT_DOMAIN),
			'90' => __('90%', YPM_POPUP_TEXT_DOMAIN),
			'100' => __('100%', YPM_POPUP_TEXT_DOMAIN)
		);

		$defaults['linkSelectorTypes'] =array(
			'template' => array(
				'fieldWrapperAttr' => array(
					'class' => 'col-md-3 ypm-choice-option-wrapper'
				),
				'labelAttr' => array(
					'class' => 'col-md-3 ypm-choice-option-wrapper'
				),
				'groupWrapperAttr' => array(
					'class' => 'row form-group ypm-choice-wrapper'
				)
			),
			'buttonPosition' => 'right',
			'nextNewLine' => true,
			'fields' => array(
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-link-selector',
						'class' => 'ypm-form-radio',
						'data-attr-href' => 'ypm-popup-links-all',
						'value' => 'all'
					),
					'label' => array(
						'name' => __('All links', YPM_POPUP_TEXT_DOMAIN)
					)
				),
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-link-selector',
						'class' => 'ypm-popup-hide-behavior ypm-form-radio',
						'data-attr-href' => 'ypm-popup-links-contain-class',
						'value' => 'contain'
					),
					'label' => array(
						'name' => __('Links contain classname', YPM_POPUP_TEXT_DOMAIN)
					)
				),
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-link-selector',
						'class' => 'ypm-popup-hide-behavior ypm-form-radio',
						'data-attr-href' => 'ypm-popup-link-does-not-contain-class',
						'value' => 'notContain'
					),
					'label' => array(
						'name' => __('Links does not contain classname', YPM_POPUP_TEXT_DOMAIN)
					)
				)
			)
		);

		$defaults['dimensions-modes'] =array(
			'template' => array(
				'fieldWrapperAttr' => array(
					'class' => 'col-md-3 ypm-choice-option-wrapper'
				),
				'labelAttr' => array(
					'class' => 'col-md-3 ypm-choice-option-wrapper'
				),
				'groupWrapperAttr' => array(
					'class' => 'row form-group ypm-choice-wrapper'
				)
			),
			'buttonPosition' => 'right',
			'nextNewLine' => true,
			'fields' => array(
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-dimensions-mode',
						'class' => 'ypm-form-radio',
						'data-attr-href' => 'ypm-popup-dimensions-mode-auto',
						'value' => 'auto'
					),
					'label' => array(
						'name' => __('Auto', YPM_POPUP_TEXT_DOMAIN)
					),
					'infoText' => __('The sizes of the popup will be counted automatically, according to the content size of the popup. You can select the size in percentages, with this mode, to specify the size on the screen.', YPM_POPUP_TEXT_DOMAIN)
				),
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-dimensions-mode',
						'class' => 'ypm-popup-hide-behavior ypm-form-radio',
						'data-attr-href' => 'ypm-popup-dimensions-mode-custom',
						'value' => 'custom'
					),
					'label' => array(
						'name' => __('Custom', YPM_POPUP_TEXT_DOMAIN)
					),
					'infoText' => __('Add your own custom dimensions for the popup to get the exact sizing for your popup.', YPM_POPUP_TEXT_DOMAIN)
				)
			)
		);

		$defaults['close-behavior'] =array(
			'template' => array(
				'fieldWrapperAttr' => array(
					'class' => 'col-md-3 ypm-choice-option-wrapper'
				),
				'labelAttr' => array(
					'class' => 'col-md-3 ypm-choice-option-wrapper'
				),
				'groupWrapperAttr' => array(
					'class' => 'row form-group ypm-choice-wrapper'
				)
			),
			'buttonPosition' => 'right',
			'nextNewLine' => true,
			'fields' => array(
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-close-behavior',
						'class' => 'ypm-form-radio',
						'data-attr-href' => 'ypm-popup-close-default',
						'value' => 'default'
					),
					'label' => array(
						'name' => __('Default', YPM_POPUP_TEXT_DOMAIN)
					),
					'infoText' => __('Popup will close without any side effects', YPM_POPUP_TEXT_DOMAIN)
				),
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-close-behavior',
						'class' => 'ypm-form-radio',
						'data-attr-href' => 'ypm-popup-close-redirect',
						'value' => 'redirect'
					),
					'label' => array(
						'name' => __('Redirect', YPM_POPUP_TEXT_DOMAIN)
					),
					'infoText' => __('After the popup close will be redirected to the specified URL', YPM_POPUP_TEXT_DOMAIN)
				),
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-close-behavior',
						'class' => 'ypm-form-radio',
						'data-attr-href' => 'ypm-popup-close-open-popup',
						'value' => 'openPopup'
					),
					'label' => array(
						'name' => __('Open new popup', YPM_POPUP_TEXT_DOMAIN)
					),
					'infoText' => __('After close the popup will open a new popup', YPM_POPUP_TEXT_DOMAIN)
				),
			)
		);

		$defaults['youtube-after-expire'] =array(
			'template' => array(
				'fieldWrapperAttr' => array(
					'class' => 'col-md-6 ypm-choice-option-wrapper'
				),
				'labelAttr' => array(
					'class' => 'col-md-6 ypm-choice-option-wrapper'
				),
				'groupWrapperAttr' => array(
					'class' => 'row form-group ypm-choice-wrapper'
				)
			),
			'buttonPosition' => 'right',
			'nextNewLine' => true,
			'fields' => array(
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-expiration-behavior',
						'class' => 'ypm-countdown-hide-behavior ypm-form-radio',
						'data-attr-href' => 'ypm-popup-expiration-default',
						'value' => 'default'
					),
					'label' => array(
						'name' => __('Default', YPM_POPUP_TEXT_DOMAIN)
					)
				),
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-expiration-behavior',
						'class' => 'ypm-popup-hide-behavior ypm-form-radio',
						'data-attr-href' => 'ypm-popup-expiration-redirect',
						'value' => 'redirect'
					),
					'label' => array(
						'name' => __('Redirect', YPM_POPUP_TEXT_DOMAIN)
					)
				),
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-expiration-behavior',
						'class' => 'ypm-countdown-hide-behavior ypm-form-radio',
						'data-attr-href' => 'ypm-popup-expiration-hide',
						'value' => 'hide'
					),
					'label' => array(
						'name' => __('Hide', YPM_POPUP_TEXT_DOMAIN)
					)
				),
			)
		);

		$defaults['subscription-after'] =array(
			'template' => array(
				'fieldWrapperAttr' => array(
					'class' => 'col-md-6 ypm-choice-option-wrapper'
				),
				'labelAttr' => array(
					'class' => 'col-md-6 ypm-choice-option-wrapper'
				),
				'groupWrapperAttr' => array(
					'class' => 'row form-group ypm-choice-wrapper'
				)
			),
			'buttonPosition' => 'right',
			'nextNewLine' => true,
			'fields' => array(
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-subscription-behavior',
						'class' => 'ypm-countdown-hide-behavior ypm-form-radio',
						'data-attr-href' => 'ypm-popup-subscription-message',
						'value' => 'message'
					),
					'label' => array(
						'name' => __('Message', YPM_POPUP_TEXT_DOMAIN)
					)
				),
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-subscription-behavior',
						'class' => 'ypm-popup-hide-behavior ypm-form-radio',
						'data-attr-href' => 'ypm-popup-subscription-redirect',
						'value' => 'redirect'
					),
					'label' => array(
						'name' => __('Redirect', YPM_POPUP_TEXT_DOMAIN)
					)
				),
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-subscription-behavior',
						'class' => 'ypm-countdown-hide-behavior ypm-form-radio',
						'data-attr-href' => 'ypm-popup-expiration-hide',
						'value' => 'hide'
					),
					'label' => array(
						'name' => __('Hide', YPM_POPUP_TEXT_DOMAIN)
					)
				),
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-subscription-behavior',
						'class' => 'ypm-countdown-hide-behavior ypm-form-radio',
						'data-attr-href' => 'ypm-popup-expiration-popup',
						'value' => 'openPopup'
					),
					'label' => array(
						'name' => __('Open popup', YPM_POPUP_TEXT_DOMAIN)
					)
				),
			)
		);

		$defaults['contact-form-after-expire'] =array(
			'template' => array(
				'fieldWrapperAttr' => array(
					'class' => 'col-md-6 ypm-choice-option-wrapper'
				),
				'labelAttr' => array(
					'class' => 'col-md-6 ypm-choice-option-wrapper'
				),
				'groupWrapperAttr' => array(
					'class' => 'row form-group ypm-choice-wrapper'
				)
			),
			'buttonPosition' => 'right',
			'nextNewLine' => true,
			'fields' => array(
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-contacted-behavior',
						'class' => 'ypm-countdown-hide-behavior ypm-form-radio',
						'data-attr-href' => 'ypm-popup-contact-message',
						'value' => 'message'
					),
					'label' => array(
						'name' => __('Message', YPM_POPUP_TEXT_DOMAIN)
					)
				),
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-contacted-behavior',
						'class' => 'ypm-popup-hide-behavior ypm-form-radio',
						'data-attr-href' => 'ypm-popup-contact-redirect',
						'value' => 'redirect'
					),
					'label' => array(
						'name' => __('Redirect', YPM_POPUP_TEXT_DOMAIN)
					)
				),
				array(
					'attr' => array(
						'type' => 'radio',
						'name' => 'ypm-popup-contacted-behavior',
						'class' => 'ypm-countdown-hide-behavior ypm-form-radio',
						'data-attr-href' => 'ypm-popup-expiration-hide',
						'value' => 'hide'
					),
					'label' => array(
						'name' => __('Hide', YPM_POPUP_TEXT_DOMAIN)
					)
				),
			)
		);

		$defaults['close-button-positions'] = array(
			'top_left' => __('Top Left', YPM_POPUP_TEXT_DOMAIN),
			'top_right' => __('Top Right', YPM_POPUP_TEXT_DOMAIN),
			'bottom_left' => __('Bottom Left', YPM_POPUP_TEXT_DOMAIN),
			'bottom_right' => __('Bottom Right', YPM_POPUP_TEXT_DOMAIN),
		);

		$defaults['backroundImageModes'] = array(
			'no-repeat' => __('None', YPM_POPUP_TEXT_DOMAIN),
			'cover' => __('Cover', YPM_POPUP_TEXT_DOMAIN),
			'contain' => __('Contain', YPM_POPUP_TEXT_DOMAIN),
			'repeat' => __('Repeat', YPM_POPUP_TEXT_DOMAIN)
		);

		return apply_filters('YpmDefaultDataOptions', $defaults);
	}
}