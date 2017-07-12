<?php

class Register
{
	public static function register_ok($name, $surname, $email, $password)
	{
		$passwd = hash("whirlpool", $password);
		$pdo = DataBase::getConnection();
		$stmt = $pdo->prepare(SQL_ADD_USER);
		$result = $stmt->execute([
			$name,
			$surname,
			$passwd,
			$email,
			"/template/images/default-avatar.png"
		]);
		return $result;
	}

	public static function checkLogin($name, $surname)
	{
		if (preg_match("/^[a-zA-Z]+$/", $name) &&
			preg_match("/^[a-zA-Z]+$/", $surname) &&
			strlen($name) >= 1 &&
			strlen($surname) >= 1) {
			return true;
		}
		return false;
	}

	public static function checkPassword($password)
	{
		if (strlen($password) >= 6 && strlen($password) <= 25) {
			return true;
		}
		return false;
	}

	public static function checkEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}

	public static function checkEmailExists($email)
	{
		$pdo = DataBase::getConnection();
		$stmt = $pdo->prepare(SQL_CHECK_EMAIL);
		$stmt->execute([$email]);
		if ($stmt->rowCount()) {
			return false;
		}
		return true;
	}
}