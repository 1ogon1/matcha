<?php require_once(ROOT . '/views/layout/head.php'); ?>

	<div class="container-fluid">

		<div class="row back">
			<div class="col-lg-5 col-lg-offset-1 col-md-5 col-sm-5">
				<h1>Hello</h1>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6" style="margin-bottom: 40px">
				<h3>Увійти</h3>
				<form class="form-inline" role="form" action="#" method="post">
					<div class="form-group">
						<label class="sr-only" for="exampleInputEmail2">Email</label>
						<input value="<?php echo $email; ?>" name="email" type="email" class="form-control" id="exampleInputEmail2" placeholder="Email">
					</div>
					<div class="form-group">
						<label class="sr-only" for="exampleInputPassword2">Пароль</label>
						<input name="password" type="password" class="form-control" id="exampleInputPassword2" placeholder="Пароль">
					</div>
					<input name="sign_in" type="submit" class="btn btn-warning" value="Sign in">
				</form>
			</div>
		</div> <!-- header -->

		<div class="row">
			<form class="form-horizontal" role="form" action="#" method="post">
				<h2 class="header col-sm-offset-1">Активація аккаунта!</h2>
				<div class="form-group">
					<!--					<label for="inputEmail3" class="col-sm-3 control-label">Логін</label>-->
					<div class="col-sm-offset-1 col-sm-2">
						<input name="code" type="text" class="form-control" id="inputEmail3"
							   placeholder="введіть ваш код">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-9">
						<input type="submit" name="activate" class="btn btn-success" value="Activate">
					</div>
				</div>
			</form>
		</div> <!-- form activate -->

	</div>

<?php require_once(ROOT . '/views/layout/footer.php'); ?>