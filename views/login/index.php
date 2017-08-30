<?php require_once(ROOT . '/views/layout/head.php'); ?>

<div class="container-fluid">

	<div class="row back">
		<div class="col-lg-5 col-lg-offset-1 col-md-5 col-sm-5">
			<h1 class="header"><a href="/">Welcome</a></h1>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6" style="margin-bottom: 40px">
			<h3>Увійти</h3>
			<div class="form-inline">
				<div class="form-group">
					<label class="sr-only" for="log_email">Email</label>
					<input value="" name="email" type="email" class="form-control" id="log_email" placeholder="Email">
				</div>
				<div class="form-group">
					<label class="sr-only" for="log_pass">Пароль</label>
					<input name="password" type="password" class="form-control" id="log_pass" placeholder="Пароль">
				</div>
				<input id="sign_in" name="sign_in" type="submit" class="btn btn-warning" value="Sign in">
			</div>
			<div class=""><a href="/reset" id="reset">Забув пароль </a><span class="log_mes"></span></div>

		</div>
	</div> <!-- header -->

	<div class="row">

		<div class="col-lg-4 col-lg- col-md-5 col-sm-5 col-lg-offset-1">
			<h3 class="header col-sm-offset-3">Ви вперше у нас?</h3>
			<div class="mes col-sm-offset-3"></div>
			<div class="form-horizontal">
				<div class="form-group has-feedback">
					<label for="login" class="col-sm-3 control-label">Логін</label>
					<div class="col-sm-9 ">
						<input value="" name="login" type="text" class="form-control" id="login" placeholder="Логін">
						<span class=""></span>
					</div>
				</div>
				<div class="form-group has-feedback">
					<label for="name" class="col-sm-3 control-label">Ім'я</label>
					<div class="col-sm-9">
						<input value="" name="name" type="text" class="form-control" id="name" placeholder="Ім'я">
						<span class=""></span>
					</div>
				</div>
				<div class="form-group has-feedback">
					<label for="surname" class="col-sm-3 control-label">Прізвище</label>
					<div class="col-sm-9">
						<input value="" name="surname" type="text" class="form-control" id="surname"
							   placeholder="Прізвище">
						<span class=""></span>
					</div>
				</div>
				<div class="form-group has-feedback">
					<label for="email" class="col-sm-3 control-label">Email</label>
					<div class="col-sm-9">
						<input value="" name="email" type="email" class="form-control" id="email" placeholder="Email">
						<span class=""></span>
					</div>
				</div>
				<div class="form-group has-feedback">
					<label for="password" class="col-sm-3 control-label">Пароль</label>
					<div class="col-sm-9">
						<input name="password" type="password" class="form-control" id="password" placeholder="Пароль">
						<span class=""></span>
					</div>
				</div>
				<div class="form-group has-feedback">
					<label for="c_password" class="col-sm-3 control-label">Повторіть</label>
					<div class="col-sm-9">
						<input name="c_password" type="password" class="form-control" id="c_password"
							   placeholder="Підтвердження пароля">
						<span class=""></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
						<input type="submit" name="sign_up" class="btn btn-success" value="Sign up" id="sign_up">
					</div>
				</div>
			</div>
		</div> <!-- register form -->

	</div> <!-- main block -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
<script src="/template/js/script.js"></script>

<?php require_once(ROOT . '/views/layout/footer.php'); ?>
