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
                <div class="col-lg-3 col-lg-offset-0">
                    <form id="uploadform" name="uploadform" action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="file" id="file">
                        <input type="submit" name="upload" id="upload" value="Додати">
                    </form>
                    <img id="preview" src="">
                </div>
		</div>
	</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
	<script src="/template/js/script.js"></script>
<?php require_once(ROOT . '/views/layout/footer.php'); ?>