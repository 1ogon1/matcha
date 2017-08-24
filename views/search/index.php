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

				<h1>Пошук</h1>

				<div class="form-group">
					<label class="sr-only" for="s_name">Email</label>
					<input value="" name="name" type="text" class="form-control" id="s_name" placeholder="імя">
				</div>

				<div class="form-group">
					<label class="sr-only" for="s_surname">Email</label>
					<input value="" name="surname" type="text" class="form-control" id="s_surname"
						   placeholder="прізвище">
				</div>

				<div class="form-group">
					<label class="sr-only" for="s_tag">Email</label>
					<input value="" name="tag" type="text" class="form-control" id="s_tag" placeholder="тег">
				</div>

				<div class="form-group">
					<select name="gender" id="s_gender" class="form-control">
						<option value="0">не вказано</option>
						<option value="1">чоловік</option>
						<option value="2">жінка</option>

					</select>
				</div>

				<div class="form-group">
					<select name="sex_pref" id="s_sex_pref" class="form-control">
						<option value="0">не вказано</option>
						<option value="1">гетеросексуал</option>
						<option value="2">гомосексуал</option>
						<option value="3">бісексуал</option>
					</select>
				</div>

				<div class="form-group">
					<label class="sr-only" for="age1">Email</label>
					<input value="" name="age1" type="text" class="form-control" id="s_age1" placeholder="вік від">
				</div>

				<div class="form-group">
					<label class="sr-only" for="age2">Email</label>
					<input value="" name="age2" type="text" class="form-control" id="s_age2" placeholder="вік до">
				</div>

				<p>Відсортувати по:</p>

				<div class="radio">
					<label>
						<input type="radio" name="blankRadio" id="blankRadio1" value="1" aria-label="..."> віку
					</label>
				</div>

				<div class="radio">
					<label>
						<input type="radio" name="blankRadio" id="blankRadio2" value="2" aria-label="..."> тегам
					</label>
				</div>

				<div class="radio">
					<label>
						<input type="radio" name="blankRadio" id="blankRadio3" value="3" aria-label="..."> рейтингу
					</label>
				</div>

				<div class="radio">
					<label>
						<input type="radio" name="blankRadio" id="blankRadio4" value="4" aria-label="..."> місцезнаходженню
					</label>
				</div>

				<input id="search" name="search" type="submit" class="btn btn-warning" value="SUBMIT сучка">

			</div>

			<div class="col-lg-3">
				<div id="search_result">

				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
	<script src="/template/js/online.js"></script>
	<script src="/template/js/msgnotif.js"></script>

<?php require_once(ROOT . '/views/layout/footer.php'); ?>
<script src="/template/js/search.js"></script>
