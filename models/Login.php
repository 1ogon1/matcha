<?php

class Login
{
	public static function sign_in($email, $password)
	{
		$pdo = DataBase::getConnection();
		$pw = hash("whirlpool", $password);
		$id = 0;
		$stmt = $pdo->prepare(SQL_SIGN_IN);
		$stmt->execute([$email]);
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($res as $row) {
			if (!strcmp($row['email'], $email) && !strcmp($row['password'], $pw)) {
				$id = $row['id'];
				return $id;
			}
		}
		return false;
	}

	public static function checkEmail($email)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_CHECK_EMAIL);
		$stmt->execute([$email]);
		if ($stmt->rowCount()) {
			return true;
		}
		return false;
	}
}