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
						<input value="" name="email" type="email" class="form-control" id="log_email"
							   placeholder="Email">
					</div>
					<div class="form-group">
						<label class="sr-only" for="log_pass">Пароль</label>
						<input name="password" type="password" class="form-control" id="log_pass" placeholder="Пароль">
					</div>
					<input id="sign_in" name="sign_in" type="submit" class="btn btn-warning" value="Sign in">
				</div>
				<div class="log_mes"></div>
			</div>
		</div> <!-- header -->

		<div class="row">
			<div class="form-horizontal">
				<h2 class="header col-sm-offset-1">Активація аккаунта!</h2>
				<div class="mes"></div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-2">
						<input name="code" type="text" class="form-control" id="code"
							   placeholder="введіть ваш код">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-9">
						<input id="activate" type="submit" name="activate" class="btn btn-success" value="Activate">
					</div>
				</div>
			</div>
		</div> <!-- form activate -->

	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
	<script src="/template/js/script.js"></script>

<?php require_once(ROOT . '/views/layout/footer.php'); ?>