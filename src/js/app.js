'use.strict';

var $ = require('./tools');
var loginPopup = require('./ui/loginPopup');
var nav = require('./ui/nav');

document.addEventListener('DOMContentLoaded',function(){

	loginPopup.init();
	nav.init();

},false);