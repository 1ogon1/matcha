<?php require_once(ROOT . '/views/layout/head.php'); ?>

	<div class="container-fluid">

		<?php require_once(ROOT . '/views/layout/menu.php'); ?> <!-- header -->

		<div class="row">
			<div class="col-lg-3">

				<?php
				$pdo = DataBase::getConnection();
				$stmt = $pdo->prepare("SELECT * FROM user");
				$stmt->execute();
				$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach ($res as $row) {
					echo "<img src='$row[avatar]' style='width: 100px; height: 120px'>";
					echo "<p><a href='/profile/$row[id]'>$row[login]</a></p>";
				}
				?>

			</div>

			<div class="col-lg-3">
				<h1>Пошук, сучка</h1>

				<div class="form-group">
					<label class="sr-only" for="log_email">Email</label>
					<input value="" name="email" type="email" class="form-control" id="log_email" placeholder="імя">
				</div>
				<div class="form-group">
					<label class="sr-only" for="log_email">Email</label>
					<input value="" name="email" type="email" class="form-control" id="log_email" placeholder="прізвище">
				</div>
				<div class="form-group">
					<label class="sr-only" for="log_email">Email</label>
					<input value="" name="email" type="email" class="form-control" id="log_email" placeholder="тег">
				</div>
				<div class="form-group">
					<label class="sr-only" for="log_email">Email</label>
					<input value="" name="email" type="email" class="form-control" id="log_email" placeholder="стать">
				</div>
				<div class="form-group">
					<label class="sr-only" for="log_email">Email</label>
					<input value="" name="email" type="email" class="form-control" id="log_email" placeholder="вподобання">
				</div>
				<div class="form-group">
					<label class="sr-only" for="log_email">Email</label>
					<input value="" name="email" type="email" class="form-control" id="log_email" placeholder="вік від">
				</div>
				<div class="form-group">
					<label class="sr-only" for="log_email">Email</label>
					<input value="" name="email" type="email" class="form-control" id="log_email" placeholder="вік до">
				</div>
				<input id="search" name="search" type="submit" class="btn btn-warning" value="SUBMIT сучка">
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
	<script src="/template/js/online.js"></script>
	<script src="/template/js/msgnotif.js"></script>

<?php require_once(ROOT . '/views/layout/footer.php'); ?>