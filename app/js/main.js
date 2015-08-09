var myModule = (function() {

	var init = function () {
		_setUpListners();
	};
	var _setUpListners = function() {
		//прослушка событий ...
	}
	return {
		init: init
	};

})();

myModule.init();