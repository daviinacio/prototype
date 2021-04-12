(function(root, factory) {
	try {
    // commonjs
    if (typeof exports === 'object') {
      module.exports = factory();
    // global
    } else {
      root.uiFx = factory();
    }
  } catch(error) {
    console.log('Isomorphic compatibility is not supported at this time for uiFx.')
  }
})(this, function() {
	if (document.readyState === 'complete')
		init();
	else
		window.addEventListener('DOMContentLoaded', init);
	
	function init(){
		document.querySelectorAll('*[ui-fx="fadein"]').forEach((element) => {
			//console.log(element);
		});
	}
});