<?php

require_once (ROOT.'/models/Register.php');
require_once (ROOT.'/config/sql.php');

class RegisterController
{
	public function actionIndex()
	{
		$name = '';
		$surname = '';
		$email = '';
		$password = '';
		$conf_pw = '';

		$result = false;

		if (isset($_POST['submit'])) {
			$name = $_POST['name'];
			$surname = $_POST['surname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$conf_pw = $_POST['c_password'];

			$errors = false;

			if (!Register::checkLogin($name, $surname)) {
				$errors[] = 'Name and surname must consists only characters(Aa-Zz)';
			}
			if (strcmp($password, $conf_pw)) {
				$errors[] = 'Passwords do not match';
			}
			if (!Register::checkPassword($password)) {
				$errors[] = 'Password must consists 6 - 25 symbols';
			}
			if (!Register::checkEmail($email)) {
				$errors[] = 'Wrong email';
			}

			if (!Register::checkEmailExists($email)) {
				$errors[] = 'This email already exists';
			}

			if ($errors == false) {
				$result = Register::register_ok($name, $surname, $email, $password);
			} else {
				echo array_shift($errors);
			}
		}
		require_once (ROOT.'/views/register/index.php');
		return true;
	}
}