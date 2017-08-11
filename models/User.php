<?php

class User
{

	public static function sendNewPW($email, $passwd)
	{
		$login = '';

		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_SIGN_IN);
		$stmt->execute([$email]);
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($res as$row) {
			$login = $row['login'];
		}

		$headers = "Content-Type: text/html; charset=utf-8" . "\r\n";
		$subject = "New password";
		$r1 = "<html><head><style>.button { background-color: #646464 ; border: none;color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;}</style><head>";
		$r2 = "<body><h1>New password</h1>";
		$r3 = "<article><p>Hi, {$login}!</p>";
		$r4 = "<p>Your new password = {$passwd} !</p>";
		$r5 = "<p>You can change password on your profile settings!</p>";
		$r6 = "<p>Best regards, Matcha Dev</p></body></html>";
		$message = $r1 . $r2 . $r3 . $r4 . $r5 . $r6;
		mail($email, $subject, $message, $headers);
	}

	public static function addInfo($id)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_ADD_INFO);
		$stmt->execute([
			NULL,
			$id,
			0,
			0,
			'',
			'1970-1-1',
			''
		]);
	}

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

	public static function resetPassword($email)
	{
		$nb = rand(1000000, 9999999);
		$login = '';
		$pdo = DataBase::getConnection();
		$stmt = $pdo->prepare(SQL_ADD_CODE);
		$stmt->execute([
			$nb,
			$email
		]);

		$stmt = $pdo->prepare(SQL_SIGN_IN);
		$stmt->execute([$email]);
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($res as$row) {
			$login = $row['login'];
		}

		$headers = "Content-Type: text/html; charset=utf-8" . "\r\n";
		$subject = "Reset your password";
		$r1 = "<html><head><style>.button { background-color: #646464 ; border: none;color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;}</style><head>";
		$r2 = "<body><h1>Reset your password</h1>";
		$r3 = "<article><p>Hi, {$login}!</p>";
		$r4 = "<p>To reset your password on site please copy this code: {$nb}, and click on button below!</p>";
		$r5 = "<a href='http://localhost:8080/reset/finish' class='button'>Reset</a></article>";
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

	public static function register_ok($user)
	{
		$passwd = hash("whirlpool", $user['password']);
		$pdo = DataBase::getConnection();
		$stmt = $pdo->prepare(SQL_ADD_USER);
		$result = $stmt->execute([
			$user['login'],
			$user['name'],
			$user['surname'],
			$passwd,
			$user['email'],
			'/template/images/default-avatar.png',
			0
		]);
		$id = $pdo->lastInsertId();
		self::addInfo($id);
		self::sendMail($user['email'], $user['login']);
		return $result;
	}

	public static function checkLogin($user)
	{
		if (preg_match("/^[a-zA-Z]+$/", $user['name']) &&
			preg_match("/^[a-zA-Z]+$/", $user['surname']) &&
//            preg_match("/^[a-zA-Z]+$/",$login) &&
			strlen($user['name']) >= 1 &&
			strlen($user['surname']) >= 1
//            strlen($user['login']) >= 1
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
		if ($result) {
			$stmt = $pdo->prepare(SQL_DELETE_ACTIVE_CODE);
			$stmt->execute([$email]);
		}
		return $result;
	}

	public static function updateStatus($id, $time)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_SET_ONLINE);
		$stmt->execute([
			':id' => $id,
			':status' => $time
		]);
	}

	public static function checkFinishData($code, $email)
	{
		$pdo = DataBase::getConnection();
		$passwd = '';
		$stmt = $pdo->prepare(SQL_CHECK_DATA);
		$stmt->execute([
			$code,
			$email
		]);
		if ($stmt->rowCount()) {
			$pass = rand(1000000, 9999999);
			$passwd = hash('whirlpool', $pass);
			$stmt = $pdo->prepare(SQL_CHANGE_PASSWORD_BY_EMAIL);
			$stmt->execute([
				':email' => $email,
				':password' =>$passwd
			]);
			self::sendNewPW($email, $pass);
			return true;
		}
		return false;
	}
}