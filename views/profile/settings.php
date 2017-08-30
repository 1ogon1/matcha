<?php require_once(ROOT . '/views/layout/head.php'); ?>

	<div class="container-fluid">

		<?php require_once(ROOT . '/views/layout/menu.php'); ?> <!-- header -->

		<div class="row">
			<div class="col-lg-4 col-lg-offset-1">

				<h1>Додати фото <span class="foto_index">(max 5)</span></h1>
				<?php echo '<div style="color: red; font-size: 20px;">' . $error . '</div>'; ?>
				<form id="uploadform" name="uploadform" action="" method="post" enctype="multipart/form-data">
					<input class="btn btn-warning" type="file" name="file" id="file"
						   accept="image/*" <?php if ($maxImage >= 5) {
						echo 'disabled';
					} ?>>
					<input class="btn btn-success" type="submit" name="upload" id="upload"
						   value="Додати" <?php if ($maxImage >= 5) {
						echo 'disabled';
					} ?>>
					<input class="btn btn-danger" type="submit" id="cancel" value="Скасувати">
				</form>
				<div class="preview_img">
					<img id="preview" src=""">
				</div>
			</div>
			<div class="col-lg-3">

			</div>
		</div>
		<div class="row">
			<div class="col-lg-5 col-lg-offset-1 show_user_img">

				<?php foreach ($photo as $row) : ?>
					<div class="block_img">
						<img src="<?php echo $row['src']; ?>" data-text="<?php echo $row['id']; ?>">
						<div class="set_avatar">
							Встановити як аватар
						</div>
						<div class="delete"><span>Видалити</span></div>
					</div>

				<?php endforeach; ?>

				<div class="msg_ava"></div>
				<a class="btn btn-success" href="/more">Змінити налаштування профілю</a>
			</div>
			<div class="col-lg-4 col-lg-offset-0 hidden-md hidden-xs hidden-sm">
				<img id="image" src="" width="500px" height="800"
					 style="display: none; position:absolute; top: -100px;">
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
	<script src="/template/js/script.js"></script>
	<script src="/template/js/online.js"></script>
	<script src="/template/js/msgnotif.js"></script>

<?php require_once(ROOT . '/views/layout/footer.php'); ?>