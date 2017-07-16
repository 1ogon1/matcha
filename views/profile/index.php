<?php require_once(ROOT . '/views/layout/head.php'); ?>

    <div class="row back">
        <div class="col-lg-5 col-lg-offset-1 col-md-5 col-sm-5">
            <h1>Hello</h1>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6" style="margin-bottom: 40px">
            <?php echo $_COOKIE['id_user'].'<br>' ?>
            <a href="/logout">Logout</a>
        </div>
    </div> <!-- header -->


<?php require_once(ROOT.'/views/layout/footer.php');?>