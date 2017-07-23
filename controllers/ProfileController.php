<?php

require_once (ROOT.'/models/Profile.php');
require_once (ROOT.'/config/sql.php');

class ProfileController
{
    public function actionIndex($id)
    {
//    	echo $id;
		$user = Profile::showUser($id);
        require_once (ROOT.'/views/profile/index.php');
        return true;
    }

    public function actionSettings()
	{
		if (isset($_POST['save'])) {

		}
		require_once (ROOT.'/views/profile/settings.php');
		return true;
	}

	public function actionTest()
	{
		require_once (ROOT.'/views/profile/test.php');
		return true;
	}
}