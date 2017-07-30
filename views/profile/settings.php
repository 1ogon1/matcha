<?php require_once(ROOT . '/views/layout/head.php'); ?>

	<div class="container-fluid">

            <?php require_once (ROOT.'/views/layout/menu.php'); ?> <!-- header -->

		<div class="row">
			<div class="col-lg-5 col-md-3 col-sm-3 col-lg-offset-1">
				<h1>Налаштування</h1>
                <div class="message_block col-lg-5 col-md-3 col-sm-3"><p class="message"></p></div>
                    <div class="row">

                        <div class="col-lg-9 click">
                            <?php foreach ($user as $row) : ?>


                            <div class="input-group mrg_bot">
                                <input name="login" type="text" class="form-control" disabled id="input1" value="<?php echo $row['login']?>">
                                <span class="input-group-btn">
        						<input class="btn btn-default" data-text="input1" type="submit" value="Edit">
      						</span>
                            </div>

                            <div class="input-group mrg_bot">
                                <input name="name" type="text" class="form-control" disabled id="input2" value="<?php echo $row['name']?>">
                                <span class="input-group-btn">
        						<input class="btn btn-default" data-text="input2" type="submit" value="Edit">
      						</span>
                            </div>

                            <div class="input-group mrg_bot">
                                <input name="surname" type="text" class="form-control" disabled id="input3" value="<?php echo $row['surname']?>">
                                <span class="input-group-btn">
        						<input class="btn btn-default" data-text="input3" type="submit" value="Edit">
      						</span>
                            </div>

                            <div class="input-group mrg_bot">
                                <input name="email" type="text" class="form-control" disabled id="input4" value="<?php echo $row['email']?>">
                                <span class="input-group-btn">
        						<input class="btn btn-default" data-text="input4" type="submit" value="Edit">
      						</span>
                            </div>

                            <div class="input-group mrg_bot">
                                <input name="birthday" type="text" class="form-control" disabled id="input5" value="<?php echo $row['birthday']?>">
                                <span class="input-group-btn">
        						<input class="btn btn-default" data-text="input5" type="submit" value="Edit">
      						</span>
                            </div>

<!--                                <div class="radio">-->
<!--                                    <label>-->
<!--                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="man" checked>-->
<!--                                        чоловік-->
<!--                                    </label>-->
<!--                                </div>-->
<!--                                <div class="radio">-->
<!--                                    <label>-->
<!--                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="woman">-->
<!--                                        жінка-->
<!--                                    </label>-->
<!--                                </div>-->

                            <div class="input-group mrg_bot">
                                <textarea name="info" class="form-control"  disabled id="input6"><?php echo $row['info']?></textarea>
                                <span class="input-group-btn">
        					    <input id="in6" class="btn btn-default" data-text="input6" type="submit" value="Edit">
      						    </span>
                            </div>

                            <?php endforeach; ?>

                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-0 col-sm-9">
                                <input type="submit" name="save" class="btn btn-success" value="Save" id="save">
                            </div>
                        </div>
                    </div>
				</div>
                <div class="col-lg-6 col-lg-offset-0">
                    <div class="row">
                        <form id="uploadform" name="uploadform" action="" method="post" enctype="multipart/form-data">
                            <input class="btn btn-warning" type="file" name="file" id="file">
                            <input class="btn btn-success" type="submit" name="upload" id="upload" value="Додати">
                            <input class="btn btn-danger" type="submit" id="cancel" value="Скасувати">
                        </form>
                        <div class="preview_img">
                            <img id="preview" src=""">
                        </div>
                    </div>
                    <div class="row show_user_img">
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
                    </div>
                </div>
		</div>
	</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
	<script src="/template/js/script.js"></script>
<script>
//    setInterval(function () {
//        $('.alert').css('background-color', 'yellow');
//    }, 3000);
</script>
<?php require_once(ROOT . '/views/layout/footer.php'); ?>