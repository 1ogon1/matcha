<?php

class User
{

	public static function sendMail($email, $login)
	{
		$nb = rand(1000000, 9999999);

		$pdo = DataBase::getConnection();
		$stmt = $pdo->prepare(SQL_ADD_CODE);
		$stmt->execute([
			$nb,
			$email
		]);

		$headers = "Content-Type: text/html; charset=utf-8" . "\r\n";
		$subject = "Matcha Account Activation";
		$r1 = "<html><head><style>.button { background-color: #646464 ; border: none;color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;}</style><head>";
		$r2 = "<body><h1>Matcha Account Activation</h1>";
		$r3 = "<article><p>Hi, {$login}!</p><p>Thanks for registration on <span>Matcha<span></p>";
		$r4 = "<p>To activate your account on site please copy this code: {$nb}, and click on button below!</p>";
		$r5 = "<a href='http://localhost:8080/activate' class='button'>Activate</a></article>";
		$r6 = "<p>Best regards, Matcha Dev</p></body></html>";
		$message = $r1 . $r2 . $r3 . $r4 . $r5 . $r6;
		mail($email, $subject, $message, $headers);
	}

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

	public static function checkActive($email)
	{
		$pdo = DataBase::getConnection();
		$stmt = $pdo->prepare(SQL_CHECK_ACTIVE);
		$stmt->execute([$email]);
		$res = $stmt->fetch(PDO::FETCH_LAZY);
		return $res[0];
	}

	public static function checkEmailLogin($email)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_CHECK_EMAIL);
		$stmt->execute([$email]);
		if ($stmt->rowCount()) {
			return true;
		}
		return false;
	}

	public static function register_ok($login, $name, $surname, $email, $password)
	{
		$passwd = hash("whirlpool", $password);
		$pdo = DataBase::getConnection();
		$stmt = $pdo->prepare(SQL_ADD_USER);
		$result = $stmt->execute([
			$login,
			$name,
			$surname,
			$passwd,
			$email,
			'/template/images/default-avatar.png',
			0
		]);
		self::sendMail($email, $login);
		return $result;
	}

	public static function checkLogin($name, $surname)
	{
		if (preg_match("/^[a-zA-Z]+$/", $name) &&
			preg_match("/^[a-zA-Z]+$/", $surname) &&
			strlen($name) >= 1 &&
			strlen($surname) >= 1
		) {
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

	public static function getEmailByCode($code)
	{
		$pdo = DataBase::getConnection();
		$stmt = $pdo->prepare(SQL_GET_EMAIL_BY_CODE);
		$stmt->execute([$code]);
		$res = $stmt->fetch(PDO::FETCH_LAZY);
		return $res[0];
	}

	public static function activateAccount($email)
	{
		$pdo = DataBase::getConnection();
		$stmt = $pdo->prepare(SQL_ACIVATE_ACCOUNT);
		$result = $stmt->execute([
			':email' => $email,
			':active' => 1
		]);
		return $result;
	}

	public static function showUserName($id)
	{
		$pdo = DataBase::getConnection();
		$stmt = $pdo->prepare(SQL_SHOW_NAME);
		$stmt->execute([$id]);
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($res as $row) {
			echo '<p class="name">' . $row['name'] . ' ' . $row['surname'] . '</p>';
		}
	}
}