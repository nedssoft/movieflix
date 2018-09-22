$(function() {
	$.fn.beConfig = {
		registerFormUsername: '#formUsername',
		registerFormEmail: '#formEmail',
		registerFormPassword: '#formPassword',
		registerFormMessage: '#formOutputMessage',
		registerCaptcha: '*[name=g-recaptcha-response]',
		lastCallKey: 'clxLastCall',
		cabinetUrl: '#redirectCabinetUrl',
		captchaModal: '#recaptchaModal',
		headerText: '#headerTextFieldData',
		footerProfitSimulation: '#footerSeeYourProfitTextData',
		proofTable: '#proofTable',
		proofTableBody: '#proofTableBody',
		cookies: {
			sponsor: 'CryptoLuxSponsor',
			campaign: 'CryptoLuxCampaign',
			campaignTracked: 'CryptoLuxCampaignTracked',
		},
	};
	window.captchaCallback = function() {
		if ($.fn.registerCheckFields()) {
			let result = $.fn.submitRegisterForm($($.fn.beConfig.registerFormUsername).val(), $($.fn.beConfig.registerFormPassword).val(), $($.fn.beConfig.registerFormEmail).val(), $($.fn.beConfig.registerCaptcha).val(), );
			if (typeof result === 'object' && result.success) {
				window.location.href = $($.fn.beConfig.cabinetUrl).val();
			} else {
				$($.fn.beConfig.captchaModal).modal('hide');
			}
		}
	};
	$.fn.registerCheckFields = function() {
		let $username = $($.fn.beConfig.registerFormUsername);
		let $email = $($.fn.beConfig.registerFormEmail);
		let $password = $($.fn.beConfig.registerFormPassword);
		let isOk = true;
		if (!$username || $username.val().length < 6) {
			isOk = false;
			$.fn.setErrorMessage('Username has to be at least 6 characters long');
		}
		if (!$password || $password.val().length < 6) {
			isOk = false;
			$.fn.setErrorMessage('Password has to be at least 6 characters long');
		}
		if (!$email || typeof $email.val() !== "string" || !$.fn.isEmailValid($email.val())) {
			isOk = false;
			$.fn.setErrorMessage('Your eMail address has an invalid format');
		}
		if (isOk) {
			$.fn.setErrorMessage('');
		}
		return isOk;
	};
	$.fn.setErrorMessage = function(message, isHtml = false) {
		let $errorMessageField = $($.fn.beConfig.registerFormMessage);
		if (typeof $errorMessageField === 'object') {
			isHtml ? $errorMessageField.html(message) : $errorMessageField.text(message);
			$errorMessageField.show();
			return true;
		}
		return false;
	};
	$.fn.getApiUrl = function(type) {
		let $el = $('#reqApiUrl' + type);
		if ($el) {
			return $el.val();
		}
		return '';
	};
	$.fn.makeApiCall = function(type, data, method = "POST", async = false) {
		let apiResult = null;
		$.ajax({
			async: async,
			type: method,
			url: $.fn.getApiUrl(type),
			data: data,
			success: function(data) {
				apiResult = data;
			},
		});
		return apiResult;
	};
	$.fn.submitRegisterForm = function(username, password, email, captcha) {
		let result = $.fn.makeApiCall('Register', {
			username: username,
			password: password,
			email: email,
			'g-recaptcha-response': captcha
		});
		if (typeof result['errorMessage'] === 'string' && result['errorMessage'].length > 0) {
			$.fn.setErrorMessage(result['errorMessage']);
		}
		return result;
	};
	$.fn.isEmailValid = function isEmail(email) {
		let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	};
	$.fn.getTextArray = function(selector) {
		let result = [];
		let $el = $(selector);
		if (typeof $el === 'object' && typeof $el.val() === "string" && $el.val().length > 0) {
			result = $el.val().split(';');
		}
		return result;
	};
	$.fn.createTypedText = function(selector, data, typeSpeed = 60, backSpeed = 30, loop = true) {
		try {
			new Typed(selector, {
				strings: data,
				backSpeed: backSpeed,
				typeSpeed: typeSpeed,
				loop: loop
			});
		} catch (e) {
			$(selector).text(data[0]);
		}
	};
	$.fn.loadProofTable = function() {
		let $tableEl = $($.fn.beConfig.proofTable)
		let $tableBody = $($.fn.beConfig.proofTableBody);
		if (typeof $tableEl === 'object' && $tableEl.length > 0 && typeof $tableBody === 'object') {
			let data = $.fn.makeApiCall('ProofList', []);
			let targetData = '';
			$.each(data, function(key, value) {
				targetData += '<tr>' +
				'                                <td><p><strong>' + value['date'] + '</strong></p>' +
				'                                    <p>' + value['time'] + '</p></td>' +
				'                                <td><p><strong>' + value['username'] + '</strong></p>' +
				'<p><a href="' + $.fn.getTransactionLink(value['currencyContraction'], value['transactionId']) + '" target="_blank">' + value['target'] + '</a></p>' +
				'                                    </td>' +
				'                                <td><p><strong>$' + value['amountUsd'] + '</strong></p>' +
				'                                    <p>' + value['amountInCurrency'] + ' ' + value['currencyContraction'] + '</p></td>' +
				'                            </tr>';
			});
			$tableBody.html(targetData);
		}
	};
	$.fn.getTransactionLink = function(currencyContraction, addressOrTransactionId) {
		let transactionLink = '';
		if (typeof currencyContraction === 'string' && typeof addressOrTransactionId === 'string') {
			currencyContraction = currencyContraction.trim().toLowerCase();
			if (currencyContraction === 'btc' || currencyContraction === 'ltc' || currencyContraction === 'dash') {
				transactionLink = 'https://live.blockcypher.com/' + currencyContraction + '/tx/' + addressOrTransactionId + '/';
			}
			if (currencyContraction === 'eth') {
				transactionLink = 'https://etherscan.io/address/' + addressOrTransactionId;
			}
			if (currencyContraction === 'clx') {
				transactionLink = 'https://explorer.cryptolux.io/tx/' + addressOrTransactionId;
			}
		}
		return transactionLink;
	};
	$.fn.getSponsorAndCampaign = function() {
		let url = new URL(window.location.href);
		let sponsor = url.searchParams.get("sponsor");
		let campaign = url.searchParams.get("campaign");
		if (sponsor) {
			localStorage.setItem('sponsor', sponsor);
			$.removeCookie($.fn.beConfig.cookies.sponsor);
			$.cookie($.fn.beConfig.cookies.sponsor, sponsor, {
				expires: 90
			});
		}
		if (campaign) {
			$.removeCookie($.fn.beConfig.cookies.campaign);
			$.cookie($.fn.beConfig.cookies.campaign, campaign, {
				expires: 90
			});
		}
	};
	$.fn.setSponsor = function() {
		let plainUrl = window.location.href;
		let url = new URL(plainUrl);
		let sponsor = url.searchParams.get("sponsor");
		if (plainUrl.indexOf("register") !== -1 && !sponsor && localStorage.getItem('sponsor')) {
			url.searchParams.set('sponsor', localStorage.getItem('sponsor'));
			let campaignValue = $.cookie($.fn.beConfig.cookies.campaign);
			if (typeof campaignValue === 'string' && campaignValue.length > 0) {
				url.searchParams.set('campaign', campaignValue);
			}
			localStorage.removeItem("sponsor");
			window.location.href = url.toString();
		}
	};
	$.fn.trackCampaign = function() {
		let campaign = $.cookie($.fn.beConfig.cookies.campaign);
		let tracked = $.cookie($.fn.beConfig.cookies.campaignTracked);
		if (typeof campaign === "string" && campaign !== tracked) {
			let data = {
				campaign: campaign,
			};
			$.removeCookie($.fn.beConfig.cookies.campaignTracked);
			if ($.fn.makeApiCall("CampaignTrack", data).length > 0) {
				$.cookie($.fn.beConfig.cookies.campaignTracked, campaign, {
					expires: 1
				});
			}
		}
	};
	$.fn.beOnLoad = function() {
		$.fn.createTypedText('#headerTitleText', $.fn.getTextArray($.fn.beConfig.headerText));
		$.fn.createTypedText('#justStepsAway', $.fn.getTextArray($.fn.beConfig.footerProfitSimulation));
		$.fn.getSponsorAndCampaign();
		$.fn.setSponsor();
		$.fn.loadProofTable();
		$.fn.trackCampaign();
	};
	$.fn.beOnLoad();
});


// $(function(){$.fn.beConfig={registerFormUsername:'#formUsername',registerFormEmail:'#formEmail',registerFormPassword:'#formPassword',registerFormMessage:'#formOutputMessage',registerCaptcha:'*[name=g-recaptcha-response]',lastCallKey:'clxLastCall',cabinetUrl:'#redirectCabinetUrl',captchaModal:'#recaptchaModal',headerText:'#headerTextFieldData',footerProfitSimulation:'#footerSeeYourProfitTextData',proofTable:'#proofTable',proofTableBody:'#proofTableBody',cookies:{sponsor:'CryptoLuxSponsor',campaign:'CryptoLuxCampaign',campaignTracked:'CryptoLuxCampaignTracked',},};window.captchaCallback=function(){if($.fn.registerCheckFields()){let result=$.fn.submitRegisterForm($($.fn.beConfig.registerFormUsername).val(),$($.fn.beConfig.registerFormPassword).val(),$($.fn.beConfig.registerFormEmail).val(),$($.fn.beConfig.registerCaptcha).val(),);if(typeof result==='object'&&result.success){window.location.href=$($.fn.beConfig.cabinetUrl).val();}else{$($.fn.beConfig.captchaModal).modal('hide');}}};$.fn.registerCheckFields=function(){let $username=$($.fn.beConfig.registerFormUsername);let $email=$($.fn.beConfig.registerFormEmail);let $password=$($.fn.beConfig.registerFormPassword);let isOk=true;if(!$username||$username.val().length<6){isOk=false;$.fn.setErrorMessage('Username has to be at least 6 characters long');}
// if(!$password||$password.val().length<6){isOk=false;$.fn.setErrorMessage('Password has to be at least 6 characters long');}
// if(!$email||typeof $email.val()!=="string"||!$.fn.isEmailValid($email.val())){isOk=false;$.fn.setErrorMessage('Your eMail address has an invalid format');}
// if(isOk){$.fn.setErrorMessage('');}
// return isOk;};$.fn.setErrorMessage=function(message,isHtml=false){let $errorMessageField=$($.fn.beConfig.registerFormMessage);if(typeof $errorMessageField==='object'){isHtml?$errorMessageField.html(message):$errorMessageField.text(message);$errorMessageField.show();return true;}
// return false;};$.fn.getApiUrl=function(type){let $el=$('#reqApiUrl'+type);if($el){return $el.val();}
// return '';};$.fn.makeApiCall=function(type,data,method="POST",async=false){let apiResult=null;$.ajax({async:async,type:method,url:$.fn.getApiUrl(type),data:data,success:function(data){apiResult=data;},});return apiResult;};$.fn.submitRegisterForm=function(username,password,email,captcha){let result=$.fn.makeApiCall('Register',{username:username,password:password,email:email,'g-recaptcha-response':captcha});if(typeof result['errorMessage']==='string'&&result['errorMessage'].length>0){$.fn.setErrorMessage(result['errorMessage']);}
// return result;};$.fn.isEmailValid=function isEmail(email){let regex=/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;return regex.test(email);};$.fn.getTextArray=function(selector){let result=[];let $el=$(selector);if(typeof $el==='object'&&typeof $el.val()==="string"&&$el.val().length>0){result=$el.val().split(';');}
// return result;};$.fn.createTypedText=function(selector,data,typeSpeed=60,backSpeed=30,loop=true){try{new Typed(selector,{strings:data,backSpeed:backSpeed,typeSpeed:typeSpeed,loop:loop});}catch(e){$(selector).text(data[0]);}};$.fn.loadProofTable=function(){let $tableEl=$($.fn.beConfig.proofTable)
// let $tableBody=$($.fn.beConfig.proofTableBody);if(typeof $tableEl==='object'&&$tableEl.length>0&&typeof $tableBody==='object'){let data=$.fn.makeApiCall('ProofList',[]);let targetData='';$.each(data,function(key,value){targetData+='<tr>'+
// '                                <td><p><strong>'+value['date']+'</strong></p>'+
// '                                    <p>'+value['time']+'</p></td>'+
// '                                <td><p><strong>'+value['username']+'</strong></p>'+
// '<p><a href="'+$.fn.getTransactionLink(value['currencyContraction'],value['transactionId'])+'" target="_blank">'+value['target']+'</a></p>'+
// '                                    </td>'+
// '                                <td><p><strong>$'+value['amountUsd']+'</strong></p>'+
// '                                    <p>'+value['amountInCurrency']+' '+value['currencyContraction']+'</p></td>'+
// '                            </tr>';});$tableBody.html(targetData);}};$.fn.getTransactionLink=function(currencyContraction,addressOrTransactionId){let transactionLink='';if(typeof currencyContraction==='string'&&typeof addressOrTransactionId==='string'){currencyContraction=currencyContraction.trim().toLowerCase();if(currencyContraction==='btc'||currencyContraction==='ltc'||currencyContraction==='dash'){transactionLink='https://live.blockcypher.com/'+currencyContraction+'/tx/'+addressOrTransactionId+'/';}
// if(currencyContraction==='eth'){transactionLink='https://etherscan.io/address/'+addressOrTransactionId;}
// if(currencyContraction==='clx'){transactionLink='https://explorer.cryptolux.io/tx/'+addressOrTransactionId;}}
// return transactionLink;};$.fn.getSponsorAndCampaign=function(){let url=new URL(window.location.href);let sponsor=url.searchParams.get("sponsor");let campaign=url.searchParams.get("campaign");if(sponsor){localStorage.setItem('sponsor',sponsor);$.removeCookie($.fn.beConfig.cookies.sponsor);$.cookie($.fn.beConfig.cookies.sponsor,sponsor,{expires:90});}
// if(campaign){$.removeCookie($.fn.beConfig.cookies.campaign);$.cookie($.fn.beConfig.cookies.campaign,campaign,{expires:90});}};$.fn.setSponsor=function(){let plainUrl=window.location.href;let url=new URL(plainUrl);let sponsor=url.searchParams.get("sponsor");if(plainUrl.indexOf("register")!==-1&&!sponsor&&localStorage.getItem('sponsor')){url.searchParams.set('sponsor',localStorage.getItem('sponsor'));let campaignValue=$.cookie($.fn.beConfig.cookies.campaign);if(typeof campaignValue==='string'&&campaignValue.length>0){url.searchParams.set('campaign',campaignValue);}
// localStorage.removeItem("sponsor");window.location.href=url.toString();}};$.fn.trackCampaign=function(){let campaign=$.cookie($.fn.beConfig.cookies.campaign);let tracked=$.cookie($.fn.beConfig.cookies.campaignTracked);if(typeof campaign==="string"&&campaign!==tracked){let data={campaign:campaign,};$.removeCookie($.fn.beConfig.cookies.campaignTracked);if($.fn.makeApiCall("CampaignTrack",data).length>0){$.cookie($.fn.beConfig.cookies.campaignTracked,campaign,{expires:1});}}};$.fn.beOnLoad=function(){$.fn.createTypedText('#headerTitleText',$.fn.getTextArray($.fn.beConfig.headerText));$.fn.createTypedText('#justStepsAway',$.fn.getTextArray($.fn.beConfig.footerProfitSimulation));$.fn.getSponsorAndCampaign();$.fn.setSponsor();$.fn.loadProofTable();$.fn.trackCampaign();};$.fn.beOnLoad();});