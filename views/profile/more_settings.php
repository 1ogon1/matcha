<?php require_once(ROOT . '/views/layout/head.php'); ?>

	<div class="container-fluid">

		<?php require_once(ROOT . '/views/layout/menu.php'); ?> <!-- header -->

		<div class="row">
			<div class="col-lg-6 col-lg-offset-1">
				<h1>Налаштування</h1>
				<div class="row">
					<div class="message_block col-lg-9 col-md-3 col-sm-3"><p class="message"></p></div>
				</div>
				<div class="row">
					<div class="col-lg-9 click" id="main">

						<?php foreach ($user as $row) : ?>

							<div class="input-group mrg_bot">
								<input name="login" type="text" class="form-control" disabled id="input1"
									   value="<?php echo $row['login'] ?>">
								<span class="input-group-btn">
        						<input class="btn btn-default" data-text="input1" type="submit" value="Змінити">
      						</span>
							</div>

							<div class="input-group mrg_bot">
								<input name="name" type="text" class="form-control" disabled id="input2"
									   value="<?php echo $row['name'] ?>">
								<span class="input-group-btn">
        						<input class="btn btn-default" data-text="input2" type="submit" value="Змінити">
      						</span>
							</div>

							<div class="input-group mrg_bot">
								<input name="surname" type="text" class="form-control" disabled id="input3"
									   value="<?php echo $row['surname'] ?>">
								<span class="input-group-btn">
        						<input class="btn btn-default" data-text="input3" type="submit" value="Змінити">
      						</span>
							</div>

							<div class="input-group mrg_bot">
								<input name="email" type="text" class="form-control" disabled id="input4"
									   value="<?php echo $row['email'] ?>">
								<span class="input-group-btn">
        						<input class="btn btn-default" data-text="input4" type="submit" value="Змінити">
      						</span>
							</div>

						<?php endforeach; ?>

						<?php foreach ($user_info as $row) : ?>

							<div class="input-group mrg_bot">
								<select name="gender" disabled id="input5" class="form-control">
									<option value="0" <?php if ($row['gender'] == 0) {
										echo 'selected="selected"';
									} ?>>не вказано
									</option>
									<option value="1" <?php if ($row['gender'] == 1) {
										echo 'selected="selected"';
									} ?>>чоловік
									</option>
									<option value="2" <?php if ($row['gender'] == 2) {
										echo 'selected="selected"';
									} ?>>жінка
									</option>

								</select>
								<span class="input-group-btn">
        						<input class="btn btn-default" data-text="input5" type="submit" value="Змінити">
      						</span>
							</div>

							<div class="input-group mrg_bot">
								<select name="sex_pref" disabled id="input6" class="form-control">
									<option value="0" <?php if ($row['sex_pref'] == 0) {
										echo 'selected="selected"';
									} ?>>не вказано
									</option>
									<option value="1" <?php if ($row['sex_pref'] == 1) {
										echo 'selected="selected"';
									} ?>>гетеросексуал
									</option>
									<option value="2" <?php if ($row['sex_pref'] == 2) {
										echo 'selected="selected"';
									} ?>>гомосексуал
									</option>
									<option value="3" <?php if ($row['sex_pref'] == 3) {
										echo 'selected="selected"';
									} ?>>бісексуал
									</option>
								</select>
								<span class="input-group-btn">
        						<input class="btn btn-default" data-text="input6" type="submit" value="Змінити">
      						</span>
							</div>

							<div class="input-group mrg_bot">
								<input name="address" type="text" class="form-control" disabled id="input7"
									   value="<?php echo $row['address']; ?>" placeholder="адреса">
								<span class="input-group-btn">
        						<input class="btn btn-default" data-text="input7" type="submit" value="Змінити">
      						</span>
							</div>

							<div class="input-group mrg_bot">
								<input name="birthday" id="input8" type="date" min="1940-01-01" max="2001-01-01"
									   class="form-control" disabled value="<?php echo $row['birthday']; ?>">
								<span class="input-group-btn">
        						<input class="btn btn-default" data-text="input8" type="submit" value="Змінити">
      						</span>
							</div>

							<div class="input-group mrg_bot">
								<textarea name="info" class="form-control" disabled id="input9"
										  placeholder="додаткові дані(робота, хоббі, улюблені книги, тощо)"><?php echo $row['biography']; ?></textarea>
								<span class="input-group-btn">
        					    <input id="in6" class="btn btn-default" data-text="input9" type="submit"
									   value="Змінити">
                            </span>
							</div>

						<?php endforeach; ?>

						<div class="btn-group btn-group-justified">
							<div class="col-sm-offset-0 col-lg-2">
								<input type="submit" name="save" class="btn btn-success" value="Зберегти" id="save">
							</div>
							<div class="col-sm-offset-0 col-lg-1">
								<input type="submit" name="" class="btn btn-success" value="Змінити пароль"
									   id="change">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5">

						<div class="col-lg-12" id="passwd">
							<div id="pw_save"></div>
							<div class="form-group">
								<label class="sr-only" for="log_email">Email</label>
								<input value="" name="password" type="password" class="form-control" id="password"
									   placeholder="пароль">
							</div>
							<div class="form-group">
								<label class="sr-only" for="log_email">Email</label>
								<input value="" name="confirm_password" type="password" class="form-control"
									   id="confirm_password" placeholder="підтвердження пароля">
							</div>

							<div class="btn-group btn-group-justified">
								<div class="btn-group">
									<div class="col-sm-offset-0 col-lg-12">
										<input type="submit" name="save" class="btn btn-success" value="Зберегти"
											   id="save_pw">
									</div>
								</div>

								<div class="btn-group">
									<div class="col-sm-offset-0 col-lg-12">
										<input type="submit" name="save" class="btn btn-success" value="Назад"
											   id="back">
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>

			</div>
			<div class="col-lg-3">
				<h2>Теги</h2>
				<div class="has-feedback input-group mrg_bot">
					<span class="input-group-addon">#</span>
					<input name="tag" id="input10" type="text" class="form-control">
					<span class="glyphicon form-control-feedback" style="right: 75px"></span>
					<span class="input-group-btn">
                        <input class="btn btn-default" data-text="input10" type="submit" value="Додати">
                    </span>
				</div>
				<ul class="nav" id="tag">

					<?php foreach ($tag as $row) : ?>

						<li class="tag_gel" value="<?php echo $row['id'] ?>"><a>#<?php echo $row['tag'] ?></a></li>

					<?php endforeach; ?>
					<li id="error"></li>
				</ul>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
	<script src="/template/js/script.js"></script>
	<script src="/template/js/online.js"></script>

<?php require_once(ROOT . '/views/layout/footer.php'); ?>