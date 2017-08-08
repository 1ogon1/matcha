<?php


class ErrorController
{
	public function actionIndex()
	{
		require_once ROOT . '/views/error/index.php';
		return true;
	}
}