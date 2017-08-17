<?php

require_once(ROOT . '/models/Search.php');
require_once(ROOT . '/models/Profile.php');
require_once ROOT . '/models/Message.php';
require_once(ROOT . '/config/sql.php');

class SearchController
{
	public function actionIndex()
	{
		Profile::setOnline();
		$status = Profile::setStatus();
		$newMessage = Message::newMessage();

		require_once(ROOT . '/views/search/index.php');
		return true;
	}
}