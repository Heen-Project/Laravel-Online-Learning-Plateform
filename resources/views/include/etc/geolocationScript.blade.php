
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script>
	var x = document.getElementById("country");	
	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition, showError);
		} else { 
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
	}
	function showPosition(position) {
		var geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		// var temp;
		geocoder.geocode({'location': latlng}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (results[0]) {
					console.log(results[0]['address_components']);
					// x.innerHTML = results[0]['address_components'][8]['long_name']+" "+results[0]['address_components'][9]['long_name'];\
					x.innerHTML = results[0]['address_components'][results[0]['address_components'].length-2]['long_name'];	
/*
					if (results[0]['address_components'].length ==10){
						x.innerHTML = results[0]['address_components'][8]['long_name'];	
						// temp = results[0]['address_components'][8]['long_name'];		
					}
					else if (results[0]['address_components'].length ==11){
						x.innerHTML = results[0]['address_components'][9]['long_name'];
							// temp = results[0]['address_components'][9]['long_name'];		
					}
					else{
						x.innerHTML = results[0]['address_components'][9]['short_name'];
						// if (getCookie("checkCountry")=="")
						// {
						// 	var todayMidnight = new Date();
						// 	todayMidnight.setHours(23,59,59,0);
						// 	var expires = "expires="+todayMidnight.toUTCString();
						// 	document.cookie = "checkCountry" + "=" + temp + "; " + expires;
						// }
					}
*/
				} else {
					window.alert('No results found');
				}
			} else {
				window.alert('Geocoder failed due to: ' + status);
			}
		});

}
function showError(error) {
	switch(error.code) {
		case error.PERMISSION_DENIED:
		x.innerHTML = "User denied the request for Geolocation."
		break;
		case error.POSITION_UNAVAILABLE:
		x.innerHTML = "Location information is unavailable."
		break;
		case error.TIMEOUT:
		x.innerHTML = "The request to get user location timed out."
		break;
		case error.UNKNOWN_ERROR:
		x.innerHTML = "An unknown error occurred."
		break;
	}
}

</script>