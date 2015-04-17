'use.strict';

var $ = require('../tools.js');

var loginPopup = {

	init : function(){
		loginPopup.toggle();
		console.log('test');
	},

	toggle : function(){
		var $buttons = $.byClass('login-popup-button');
		var $layout = $.byId('login-layout');
		var $loginPopup = $.byId('login-popup');

		for (var i = 0; i < $buttons.length; i++) {
			$buttons[i].addEventListener('click',function(e){
				e.preventDefault();
				$layout.classList.add('active');
			},false);
		};

		$layout.addEventListener('click',function(e){
			e.preventDefault();
			this.classList.remove('active');
		},false);

		$loginPopup.addEventListener('click',function(e){
			e.stopPropagation();
		},false);
	}



};
module.exports = loginPopup;