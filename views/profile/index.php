<?php require_once(ROOT . '/views/layout/head.php'); ?>

	<div class="container-fluid">

		<div class="row back">
			<div class="col-lg-5 col-lg-offset-1 col-md-5 col-sm-5">
				<h1 class="header">Hello</h1>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
			</div>
			<ul class="nav nav-pills" style="color: black">
				<li><?php echo $_COOKIE['id_user'] . '<br>' ?></li>
				<li><a href="/logout" style="color: black">Вихід</a></li>
				<li><a href="/settings" style="color: black">Налаштування</a></li>
			</ul>
		</div> <!-- header -->

		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-lg-offset-1">
				<?php
				require_once(ROOT . '/models/User.php');
				$res = User::showUserName($_COOKIE['id_user']);
				?>
				<img src="/template/images/default-avatar.png">
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-lg-offset-2">
					<div id="map"></div>
					<input id="address" type="text" value="">
					<input name="set_address" id="submit" type="button" value="Встановити" style="margin-bottom: 20px">
			</div>
		</div>
	</div>

	<script src="/template/js/geolocation.js"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQilzegM8ynJ47loUVsKUzDv8WRTy2FNY&callback=initMap"
			type="text/javascript"></script>
<?php require_once(ROOT . '/views/layout/footer.php'); ?>