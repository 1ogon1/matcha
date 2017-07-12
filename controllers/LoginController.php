<?php

require_once (ROOT.'/models/Login.php');
require_once (ROOT.'/config/sql.php');

class LoginController
{
	public function actionIndex()
	{
		$email = '';
		$password = '';

		$result = false;

		if (isset($_POST['submit'])) {
			$email = $_POST['email'];
			$password = $_POST['password'];

			$errors = false;

			if (!Login::checkEmail($email)) {
				$errors[] = 'Wrong email';
			}

			if ($errors == false) {
				$result = Login::sign_in($email, $password);
				if (!$result) {
					echo 'Wrong password';
				} else {
					setcookie('id_user', $result);
					header("location:/");
				}
			} else {
				echo array_shift($errors);
			}
		}
		require_once (ROOT.'/views/login/index.php');
		return true;
	}

	public function actionLogout()
	{
		setcookie('id_user', '', time()-3600);
		header('location:/');
	}
}