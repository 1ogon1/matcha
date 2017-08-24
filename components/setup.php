<?php

require_once (ROOT.'/config/sql.php');

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

	public static function setUp()
	{
		self::createDataBase();
		self::createUserTable();
		self::createUserInfo();
		self::createActivateTable();
		self::createTableImage();
		self::createTableVisitor();
		self::createTableTag();
		self::createBlockUser();
		self::createLikeUser();
		self::crateChat();
		self::createRating();
	}

	private static function createDataBase()
	{
		$paranmPath = ROOT.'/config/database.php';
		$params = include $paranmPath;

		$pdo = new PDO("mysql:host={$params['host']}", $params['user'], $params['password']);
		$pdo->exec("CREATE DATABASE IF NOT EXISTS {$params['dbname']}");
		$pdo->exec("use {$params['dbname']}");
	}

	private static function createUserTable()
	{
		$pdo = self::getConnection();

		$pdo->exec(SQL_CREATE_USER_TABLE);
	}

	private static function createUserInfo()
	{
		$pdo = self::getConnection();

		$pdo->exec(SQL_CREATE_TABLE_USER_INFO);
	}

	private static function createActivateTable()
	{
		$pdo = self::getConnection();

		$pdo->exec(SQL_CREATE_ACTIVATE_TABLE);
	}

	private static function createTableImage()
	{
		$pdo = self::getConnection();

		$pdo->exec(SQL_CREATE_TABLE_IMAGE);
	}

	private static function createTableVisitor()
	{
		$pdo = self::getConnection();

		$pdo->exec(SQL_CREATE_TABLE_VISITOR);
	}

	private static function createTableTag()
	{
		$pdo = self::getConnection();

		$pdo->exec(SQL_CREATE_TABLE_TAG);
	}

	private static function createBlockUser()
	{
		$pdo = self::getConnection();

		$pdo->exec(SQL_CREATE_TABLE_BLOCK_USER);
	}

	private static function createLikeUser()
	{
		$pdo = self::getConnection();

		$pdo->exec(SQL_CREATE_TABLE_LIKE_USER);
	}

	private static function crateChat()
	{
		$pdo = self::getConnection();

		$pdo->exec(SQL_CREATE_TABLE_CHAT);
	}

	private static function createRating()
	{
		$pdo = self::getConnection();

		$pdo->exec(SQL_CREATE_TABLE_RATING);
	}
}