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

            <div class="col-lg-4 col-lg- col-md-5 col-sm-5 col-lg-offset-1">
                <h3 class="header col-sm-offset-3">Ви вперше у нас?</h3>
                <form class="form-horizontal" role="form" action="#" method="post">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Ім'я</label>
                        <div class="col-sm-9">
                            <input value="<?php echo $name; ?>" name="name" type="text" class="form-control" id="inputEmail3" placeholder="Ім'я">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">По-батькові</label>
                        <div class="col-sm-9">
                            <input value="<?php echo $surname; ?>" name="surname" type="text" class="form-control" id="inputEmail3" placeholder="По-батькові">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input value="<?php echo $emailr; ?>" name="email" type="email" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Пароль</label>
                        <div class="col-sm-9">
                            <input name="password" type="password" class="form-control" id="inputPassword3" placeholder="Пароль">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Повторіть</label>
                        <div class="col-sm-9">
                            <input name="c_password" type="password" class="form-control" id="inputPassword3" placeholder="Підтвердження пароля">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <input type="submit" name="sign_up" class="btn btn-success" value="Sign in">
                        </div>
                    </div>
                </form>
            </div> <!-- register form -->

            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-9 col-lg-offset-1 col-sm-offset-0">
                <h3>Відгуки про нас</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam asperiores assumenda consequuntur cupiditate dolorum earum est ex impedit, in maiores molestias, nihil non, odio pariatur sequi sunt suscipit ut? Fugiat.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam asperiores assumenda consequuntur cupiditate dolorum earum est ex impedit, in maiores molestias, nihil non, odio pariatur sequi sunt suscipit ut? Fugiat.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam asperiores assumenda consequuntur cupiditate dolorum earum est ex impedit, in maiores molestias, nihil non, odio pariatur sequi sunt suscipit ut? Fugiat.</p>
            </div> <!-- feedback -->

        </div> <!-- main block -->
    </div>
<?php require_once(ROOT.'/views/layout/footer.php');?>