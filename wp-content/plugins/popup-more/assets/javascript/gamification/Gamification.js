function ypmgamification() {
	this.extraOpions = {};
}

ypmgamification.prototype.init = function()
{
	this.animationAfterOpenPopup();
};

ypmgamification.expTime = 365;
ypmgamification.popupHeight = 0;

ypmgamification.prototype.animationAfterOpenPopup = function() {
	var that = this;
	jQuery('#ypmcolorbox').bind('ypmOnComplete', function (e, args) {
		setTimeout(function () {
			that.validateForms(args.popupId);
		}, 0)
		var popupId = args.popupId;
		ypmgamification.popupHeight = jQuery('.ypm-content-'+popupId).height();
		var gifts = jQuery('.ypm-gifts .ypm-gift');
		gifts.hide();
		var i = 0;
		gifts.each(function () {
			var current = jQuery(this);
			setTimeout(function () {
				current.show();
				current.addClass('ypm-animated ypm-bounceInUp');
			}, i*100);
			++i;
		});

		setTimeout(function(){
			window.dispatchEvent(new Event('resize'));
		}, 600);
	});
};

ypmgamification.prototype.validateForms = function(popupId)
{
	var forms = jQuery('#ycf-gamification-form');

	if (!forms.length) {
		return false;
	}
	var that = this;

	var validateObj = forms.data('validate');

	forms.each(function () {
		var form = jQuery(this);
		//var popupId = form.data('id');
		var message = jQuery(this).data('required-message');
		var emailMessage = jQuery(this).data('email-message');

		that.shakeForm(jQuery(this));
		// validateObj['ypm-subs-email'] = {
		// 	required: message,
		// 	email: emailMessage
		// };
		validateObj.submitHandler = function(e) {
			that.submitForm(form, popupId);
		};
		form.validate(validateObj);
	});
};

ypmgamification.prototype.getRandomPercentage = function () {
	return Math.random()*100;
};

ypmgamification.prototype.playGame = function(popupId)
{
	var randomPercentage = this.getRandomPercentage();
	jQuery('#ypm-popup-content-wrapper-'+popupId+' .ypm-gifts').addClass('ypm-bigger');
	var that = this;
	var i = 0;
	var gifts = jQuery('#ypm-popup-content-wrapper-'+popupId+' .ypm-gifts  .ypm-gift');
	gifts.removeClass('ypm-bounceInUp');

	gifts.each(function () {
		var current = jQuery(this);
		setTimeout(function () {
			current.show();
			current.addClass('ypm-tada');
		}, i*100);
		++i;
	});

	jQuery('#ypm-popup-content-wrapper-'+popupId+' .ypm-gifts').animate({
		marginTop: '-15%'
	}, 1000);
	jQuery('.ypm-gift').bind('click', function() {
		if (jQuery(this).hasClass('ypm-animate-double')) {
			return false;
		}
		if (randomPercentage <= that.extraOpions['ypm-gamification-win-chance']) {
			var giftsWrapper = jQuery('#ypm-popup-content-wrapper-'+popupId+' .ypm-gifts');
			var selectedGift = jQuery(this);
			jQuery('.ypm-gamification-play-text').animate(1000, function () {
				// jQuery('.ypm-gamification-play-text').hide();
				// jQuery("#ycf-gamification-form").hide()
				jQuery(this).css('visibility', 'hidden');
				var notSelectedGifts = jQuery('#ypm-popup-content-wrapper-'+popupId+' .ypm-gift').not(selectedGift);

				jQuery('.ypm-gifts').css({'margin-top': 0});

				/*where 20 is static margin from top*/
				var top = giftsWrapper.position().top+parseInt(giftsWrapper.css('margin-top'))-selectedGift.height()/2 - 200;
				selectedGift.addClass('ypm-animate-double');

				var wrapper = jQuery('.ypm-gamification-content-wrapper').width();
				/*Half width of gifts wrapper*/
				var wrapperWidth = wrapper/2;

				/*Initial position center of the current scaled gift*/
				var positionCenter = selectedGift.position().left+parseInt(selectedGift.css('margin-left'))+selectedGift.width()/2;

				notSelectedGifts.animate({ opacity: 0 }, 0);
				giftsWrapper.removeClass('ypm-bigger');

				selectedGift.animate({
					'left': (wrapperWidth - positionCenter),
					'top': 0
				}, 1000, function () {
					setTimeout(function() {
						selectedGift.parent().after(jQuery('.ypm-gamification-win-text'));
						selectedGift.parent().next('.ypm-gamification-win-text').fadeIn(500);
					}, 500);
				});
				jQuery("#ycf-gamification-form").css({'display': 'none'});
				jQuery('.ypm-gamification-start-header').css({'padding-top': '50px;'});
				jQuery(this).css({'position': 'relative'}).css({'display': 'none'});
			});
		}
		else {
			/*Lose*/
			jQuery('.ypm-gamification-play-text').fadeOut(1000);
			jQuery('.ypm-gifts').fadeOut(1000, function () {
				jQuery('.ypm-gamification-lose-text').fadeIn(800);
			});
		}
	});
};

ypmgamification.prototype.shakeForm = function(form)
{
	jQuery('.ypm-gift').bind('click', function () {
		jQuery(form).removeClass('ypm-animated ypm-shake');
		setTimeout(function () {
			jQuery(form).addClass('ypm-animated ypm-shake');
		}, 0)
	});
};

ypmgamification.allowToLoad = function(popup)
{
	var cookieObject = YpmPopup.getCookie('ypmgamification' + popup.popupId);

	if (cookieObject) {
		return false;
	}

	return true;
};

ypmgamification.prototype.submitForm = function(form, popupId)
{
	var that = this;
	jQuery('.ypm-content-'+popupId).css('height', ypmgamification.popupHeight+'px');

	var formData = form.serialize();
	var submitButton = jQuery(form).find('.ycf-submit input');
	var ajaxData = {
		action: 'ypm_subscribed',
		nonce: YPM_GAMIFICATION_PARAMS.nonce,
		beforeSend: function () {
			submitButton.val(submitButton.attr('data-progress-title'));
			submitButton.prop('disabled', true);
		},
		formData: formData,
		popupPostId: popupId
	};
	var cookieName = 'ypmgamification' + popupId;
	var popupData = jQuery(form).data('expiration-options');
	that.extraOpions = popupData;

	var alreadySubscribed = popupData['ypm-gamification-already-subscribed'];
	jQuery.post(YPM_GAMIFICATION_PARAMS.ajaxUrl, ajaxData, function (res) {
		if (jQuery('.ypm-hide-form').length) {
			jQuery('.ypm-gamification-win-text .ypm-gamification-start-header').css('margin-top', '43px');
		}
		submitButton.prop('disabled', false);
		jQuery(form).animate({ opacity: 0 },1000);

		jQuery('.ypm-gamification-gdpr-text').animate({ opacity: 0 },1000);
		jQuery('.ypm-gamification-start-text').fadeOut(1000, function () {
			jQuery('.ypm-gamification-play-text').fadeIn(1000);
		});

		jQuery(form).nextAll('.ypm-gifts').first().addClass('ypm-bigger');
		jQuery('#ypm-popup-content-wrapper-'+popupId).addClass('ypm-overflow-hidden');

		if (typeof alreadySubscribed != 'undefined' && alreadySubscribed) {
			YpmPopup.setCookie(cookieName, 1, ypmgamification.expTime);
		}

		that.playGame(popupId);
	});
};

jQuery(document).ready(function() {
	var obj = new  ypmgamification();
	obj.init();
});
