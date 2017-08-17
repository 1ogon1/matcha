<?php require_once(ROOT . '/views/layout/head.php'); ?>

	<div class="container-fluid" xmlns="http://www.w3.org/1999/html">

		<?php require_once(ROOT . '/views/layout/menu.php'); ?> <!-- header -->

		<?php foreach ($user

		as $row) : ?>

		<div class="row">
			<div class="col-lg-5 col-md-5 col-sm-3 col-lg-offset-1">
				<div class="row">
					<?php echo '<p class="name">' . $row['name'] . ' ' . $row['surname'];
					if ($time - $userStatus >= 60) {
						date_default_timezone_set('Europe/Kiev');
						$online_time = date ( "d-m-Y h:i A" , $userStatus);
						echo '<span style="color: red;"> '.$online_time.'</span>';
					} else {
						echo '<span style="color: green;"> Онлайн</span>';
					}
					echo '</p>';
					?>
				</div>
				<div class="row">
					<div class="col-lg-5 col-md-6 col-sm-12">
						<img src="<?php echo $row['avatar'] ?>" width="200px" height="250px">
					</div>
					<div class="col-lg-7 col-md-4 col-sm-4 col-lg-offset-0 pull-left">

						<?php foreach ($userInfo as $rows) : ?>

							<p>
								<?php
								$now = new DateTime('now');
								$last = new DateTime($rows['birthday']);
								$status = date_diff($now, $last);
								echo $status->format('%Y%') . ' роки';
								?>
							</p>
							<p>
								<?php
								if ($rows['gender'] == 1) {
									echo 'Чоловік';
								} else if ($rows['gender'] == 2) {
									echo 'Жінка';
								}
								?>
							</p>
							<p>
								<?php
								if ($rows['sex_pref'] == 1) {
									echo 'Гетеросексуал';
								} else if ($rows['sex_pref'] == 2) {
									echo 'Гомосексуал';
								} else if ($rows['sex_pref'] == 3) {
									echo 'Бісексуал';
								}
								?>
							</p>
							<p>
								<?php
								if (!empty($rows['address'])) {
									echo $rows['address'];
								}
								?>
							</p>
							<p>
								<?php
								if (!empty($rows['biography'])) {
									echo $rows['biography'];
								}
								?>
							</p>

						<?php endforeach; ?>

					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">

						<?php foreach ($userTag as $rowss) : ?>

							<a href="/search/tag/id">#<?php echo $rowss['tag']; ?></a>

						<?php endforeach; ?>

					</div>
				</div>

				<?php if ($_COOKIE['id_user'] !== $id) : ?>

					<div class="row">
						<div class="col-lg-12">
							<div class="block_user" id="block" data-text="<?php echo $id; ?>" <?php if ($block) {echo 'style="display: none"'; } ?>>
								<strong>Блокувати</strong>
							</div>
							<div class="unblock_user" id="unblock" data-text="<?php echo $id; ?>" <?php if (!$block) {echo 'style="display: none"'; } ?>>
								<strong>Розблокувати</strong>
							</div>
							<div class="likes" id="like" data-text="<?php echo $id; ?>" <?php if ($like) {echo 'style="display: none"'; } ?>>
								<strong>Вподобати</strong>
							</div>
							<div class="unlikes" id="unlike" data-text="<?php echo $id; ?>" <?php if (!$like) {echo 'style="display: none"'; } ?>>
								<strong>Видалити</strong>
							</div>
						</div>
					</div>

				<?php endif; ?>

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
<?php require_once(ROOT . '/views/layout/footer.php'); ?>
<script src="/template/js/geolocation.js"></script>
<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQilzegM8ynJ47loUVsKUzDv8WRTy2FNY&callback=initMap"
		type="text/javascript"></script>
<script src="/template/js/online.js"></script>
<script src="/template/js/script.js"></script>
<script src="/template/js/msgnotif.js"></script>