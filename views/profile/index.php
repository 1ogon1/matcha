<?php require_once(ROOT . '/views/layout/head.php'); ?>

	<div class="container-fluid">

        <?php require_once (ROOT.'/views/layout/menu.php'); ?> <!-- header -->

			<?php foreach ($user as $row) : ?>

		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-lg-offset-1">
				<?php echo '<p class="name">' . $row['name'] . ' ' . $row['surname'];
                    if ($userStatus->format('%I%') >= 1) {
                        echo '<span style="color: red;"> Оффлайн</span>';
                    } else {
                        echo '<span style="color: green;"> Онлайн</span>';
                    }
                    echo '</p>';
				?>
				<img src="<?php echo $row['avatar'] ?>" width="200px" height="250px">
                <p><?php echo $row['birthday']?></p>
                <p><?php echo $row['info']?></p>
            </div>
			<?php endforeach; ?>
			<div class="col-lg-3 col-md-3 col-sm-3 col-lg-offset-2">
				<div id="map"></div>
				<input id="address" type="text" value="">
				<input name="set_address" id="submit" type="button" value="Встановити" style="margin-bottom: 20px">
			</div>
		</div>
	</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
	<script src="/template/js/geolocation.js"></script>
	<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQilzegM8ynJ47loUVsKUzDv8WRTy2FNY&callback=initMap"
			type="text/javascript"></script>
    <script src="/template/js/online.js"></script>
<?php require_once(ROOT . '/views/layout/footer.php'); ?>