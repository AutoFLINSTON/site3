var myModule = (function () {

	var init = function() {
		_setUpListeners();
	};

	var _setUpListeners = function() {
        $('#velopelorama').on('click' , _showModal); // открыть модальное окно
    };

    var _showModal = function (e) {
    	console.log('Модальное окно');
    	e.preventDefault();
    	$('#new-project-popup').bPopup({
    		modalClose: false,
            opacity: 0.6,
            positionStyle: 'fixed' //'fixed' or 'absolute'
    	});
    };
    return {
    	init : init
    };
}());

myModule.init();