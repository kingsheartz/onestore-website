<!--
<!DOCTYPE html>
<html>
<head>
<title>map test</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
/* map needs width and height to appear */
/*
#map{
	width: 900px;
	max-width: 100%;
	height: 500px;
}
*/
</style>
</head>
-->
</script>

<body>
	<div>
		<form class="" action="single.php" method="post">
			<input type="hidden" name="d1" id="str1" value="">
			<input type="hidden" name="d2" id="str2" value="">
			<input type="hidden" name="d3" id="str3" value="">
			<input type="hidden" name="d4" id="str4" value="">
		</form>
		<!-- this div will hold your store info -->
		<script>
			// Retrieving stores details
			var stores;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					stores = JSON.parse(this.responseText);
				}
			};
			xmlhttp.open("GET", "../Main/getjson.php", true);
			xmlhttp.send();
			/*
			function handlePermission() {
			  navigator.permissions.query({name:'geolocation'}).then(function(result) {
				if (result.state == 'granted') {
				  report(result.state);
				  geoBtn.style.display = 'none';
				} else if (result.state == 'prompt') {
				  report(result.state);
				  geoBtn.style.display = 'none';
				  navigator.geolocation.getCurrentPosition(revealPosition,positionDenied,geoSettings);
				} else if (result.state == 'denied') {
				  report(result.state);
				  geoBtn.style.display = 'inline';
				}
				result.onchange = function() {
				  report(result.state);
				}
			  });
			}
			function report(state) {
			  console.log('Permission ' + state);
			}
			handlePermission();
			*/
			// Getting location info
			function getLocationa() {
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(showPositiona);
				} else {
					x.innerHTML = "Geolocation is not supported by this browser.";
				}
			}
			/////////////////////////////////////////////////////
			//ADD TO CART
			var car;
			function showPositiona(position) {
				car = { lat: position.coords.latitude, lng: position.coords.longitude };
				document.getElementById('daddr').value = car.lat + "," + car.lng;
				//last cut
				for (var i = 1; i <= stores.length; i++) {
					var el = document.getElementById('c' + i.toString());
					if (el != null) {
						document.getElementById('c' + i.toString()).innerHTML = distance(car.lat, car.lng, stores[i - 1].latitude, stores[i - 1].longitude, "K");
					}
				}
				//last cut
			}
			// Getting location info
			function getLocationb() {
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(showPositionb);
				} else {
					x.innerHTML = "Geolocation is not supported by this browser.";
				}
			}
			/////////////////////////////////////////////////////
			//WISHLIST
			function showPositionb(position) {
				car = { lat: position.coords.latitude, lng: position.coords.longitude };
				document.getElementById('wishlist_daddr').value = car.lat + "," + car.lng;
				//last cut
				for (var i = 1; i <= stores.length; i++) {
					var el = document.getElementById('w' + i.toString());
					if (el != null) {
						document.getElementById('w' + i.toString()).innerHTML = distance(car.lat, car.lng, stores[i - 1].latitude, stores[i - 1].longitude, "K");
					}
				}
				//last cut
			}
			function distance(lat1, lon1, lat2, lon2, unit) {
				if ((lat1 == lat2) && (lon1 == lon2)) {
					return 0;
				}
				else {
					var radlat1 = Math.PI * lat1 / 180;
					var radlat2 = Math.PI * lat2 / 180;
					var theta = lon1 - lon2;
					var radtheta = Math.PI * theta / 180;
					var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
					if (dist > 1) {
						dist = 1;
					}
					dist = Math.acos(dist);
					dist = dist * 180 / Math.PI;
					dist = dist * 60 * 1.1515;
					if (unit == "K") { dist = dist * 1.609344 }
					if (unit == "N") { dist = dist * 0.8684 }
					dis = Math.floor(dist * 100) / 100;
					return dist.toFixed(2);
				}
			}
			/*
				function initMap() {
				}
			*/
		</script>
		<!-- This will find the post office and store the longitude and latitude-->
		<!--
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM6g1c7vkW8WZjAy-vfKfCOQ3ysJrrIxY&callback=initMap" async defer></script>
-->
</body>

</html>