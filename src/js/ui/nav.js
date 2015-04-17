'use.strict';

var $ = require('../tools');

var nav = {

	init : function(){
		nav.dropdown();
	},
	dropdown : function(){
		$hover = $.selector('.head');
		$drop = $.byClass('dropdown')[0];
		console.log($drop);
		$hover.addEventListener('mouseenter',function(e){
			e.preventDefault();
			$drop.classList.add('active');
			$drop.addEventListener('mouseleave',function(e){
				e.preventDefault();
				$drop.classList.remove('active');
			},false);
		},false);
	}
};
module.exports = nav;