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
				<li><a href="/profile" style="color: black">Моя сторінка</a></li>
			</ul>
		</div> <!-- header -->

		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-lg-offset-1">
				<h1>Налаштування</h1>
				<div class="row" style="margin-bottom: 10px">
					<div class="col-lg-9">
						<div class="input-group">
							<input type="text" class="form-control" disabled id="input1">
							<span class="input-group-btn">
        						<input onclick="cancelDisabled('input1')" pwd
									   class="btn btn-default" type="submit" value="Edit">
      						</span>
						</div>
					</div>
				</div>
				<div class="row" style="margin-bottom: 10px">
					<div class="col-lg-9">
						<div class="input-group">
							<input type="text" class="form-control" disabled id="input2">
							<span class="input-group-btn">
        						<input class="btn btn-default" type="submit" value="Edit" onclick="cancelDisabled('input1')">
      						</span>
						</div>
					</div>
				</div>
				<div class="row" style="margin-bottom: 10px">
					<div class="col-lg-9">
						<div class="input-group">
							<input type="text" class="form-control" disabled id="input3">
							<span class="input-group-btn">
        						<input class="btn btn-default" type="submit" value="Edit" onclick="cancelDisabled('input1')">
      						</span>
						</div>
					</div>
				</div>
				<div class="row" style="margin-bottom: 10px">
					<div class="col-lg-9">
						<div class="input-group">
							<input type="text" class="form-control" disabled id="input4">
							<span class="input-group-btn">
        						<input class="btn btn-default" type="submit" value="Edit" onclick="cancelDisabled('input1')">
      						</span>
						</div>
					</div>
				</div>
				<div class="row" style="margin-bottom: 10px">
					<div class="col-lg-9">
						<div class="input-group">
							<input type="text" class="form-control" disabled id="input5">
							<span class="input-group-btn">
        						<input class="btn btn-default" type="submit" value="Edit" onclick="cancelDisabled('input1')">
      						</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src="/template/js/script.js"></script>
<?php require_once(ROOT . '/views/layout/footer.php'); ?>