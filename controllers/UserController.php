<?php

require_once (ROOT.'/models/User.php');
require_once (ROOT.'/config/sql.php');

class UserController
{
    public function actionIndex()
    {
        require_once (ROOT.'/views/login/index.php');
        return true;
    }

    public function actionLogin()
    {
        $result = false;
        $errors = false;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $time = $_POST['time'];

        if (!User::checkEmailLogin($email)) {
            $errors[] = 'Email введено не вірно';
        }

        if (!User::checkActive($email)) {
            $errors[] = 'Ваш аккаунт не активовано!';
        }

        if ($errors == false) {
            $result = User::sign_in($email, $password);
            if (!$result) {
                echo 'Пароль введено не вірно';
            } else {
                User::updateStatus($result, $time);
                setcookie('id_user', $result);
                echo $result;
            }
        } else {
            echo array_shift($errors);
        }
        return true;
    }

    public function actionRegister()
    {
        $user = [
            'login' => $_POST['login'],
            'name' => $_POST['name'],
            'surname' => $_POST['surname'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'c_password' => $_POST['c_password'],

        ];
        $errors = false;
        $result = false;
        if (!User::checkLogin($user)) {
            $errors[] = 'Не допустимі символи в імені/прізвищу';
        }
        if (!User::checkEmailExists($user['email'])) {
            $errors[] = 'Даний email існує';
        }
        if (!User::checkPassword($user['password'])) {
            $errors[] = 'Пароль містить 6-25 символів';
        }
        if (strcmp($user['password'], $user['c_password'])) {
            $errors[] = 'Паролі не співпадають';
        }
        if ($errors == false) {
            $result = User::register_ok($user);
            echo 'Email відправлено';
        } else {
            echo array_shift($errors);
        }

        return true;
    }

    public function actionActivate()
	{
		$email = '';
		$password = '';

		require_once (ROOT.'/views/activate/index.php');
		return true;
	}

	public function actionSend_code()
    {
        $email = '';
        $password = '';
        $result = false;
        $code = $_POST['code'];

        $email = User::getEmailByCode($code);
        if ($email != '') {
            $result = User::activateAccount($email);
        }
        if ($result) {
            echo 'Аккаунт активовано!';
        } else {
            echo 'Не вірний код';
        }
    }

    public function actionLogout()
    {
        setcookie('id_user', '', time()-3600);
        header('location:/');
    }
}