
<?php require_once(ROOT . '/views/layout/head.php'); ?>
<div class="container">

	<h1>Geolocation Demo</h1>

	<form id="geocoding_form" class="form-horizontal">
		<div class="form-group">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<button type="button" class="find-me btn btn-info btn-block">Find My Location</button>
			</div>
		</div>
	</form>

	<p class="no-browser-support">Sorry, the Geolocation API isn't supported in Your browser.</p>
	<p class="coordinates">Latitude: <b class="latitude"></b> Longitude: <b class="longitude"></b></p>

	<div class="map-overlay">
		<div id="map"></div>
	</div>
<!---->
<!--	<p id="demo">Click the button to get your position.</p>-->
<!---->
<!--	<button onclick="getLocation()">Try It</button>-->
<!---->
<!--	<div id="mapholder"></div>-->
<!---->
</div>

<?php require_once(ROOT.'/views/layout/footer.php');?>