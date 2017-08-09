<?php

require_once(ROOT . '/models/Profile.php');
require_once(ROOT . '/models/User.php');
require_once(ROOT . '/config/sql.php');

class MessageController
{
	public function actionIndex()
	{
		Profile::setOnline();
		$status = Profile::setStatus();

		require_once ROOT.'/views/message/message.php';
		return true;
	}
}