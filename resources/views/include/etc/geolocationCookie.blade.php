//DOMNodeInserted DOMSubtreeModified DOMNodeRemoved
$("#country").bind('DOMSubtreeModified', function(event) {
	console.log('Changed');
	if($.cookie('country') == null) { 
		var currentDate = new Date();
		expirationDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate()+1, 0, 0, 0);
		var data = $("#country").html();
		$.cookie('country', data, {expires:expirationDate});
		console.log('Cookie Created');
	}
});