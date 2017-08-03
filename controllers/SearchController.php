<?php

require_once (ROOT.'/models/Search.php');
require_once (ROOT.'/models/Profile.php');
require_once(ROOT . '/config/sql.php');

class SearchController
{
    public function actionIndex()
    {
        $status = Profile::setStatus();

        require_once (ROOT.'/views/search/index.php');
        return true;
    }
}