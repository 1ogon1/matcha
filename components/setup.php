<?php

class DataBase
{
	public static function getConnection()
	{
		$paranmPath = ROOT.'/config/database.php';
		$params = include $paranmPath;

		$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
		$pdo = new PDO($dsn, $params['user'], $params['password']);

		return $pdo;
	}
}