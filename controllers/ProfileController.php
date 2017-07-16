<?php

require_once (ROOT.'/models/Profile.php');
require_once (ROOT.'/config/sql.php');

class ProfileController
{
    public function actionIndex()
    {
        require_once (ROOT.'/views/profile/index.php');
        return true;
    }
}