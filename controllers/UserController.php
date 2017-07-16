<?php

require_once (ROOT.'/models/User.php');
require_once (ROOT.'/config/sql.php');

class UserController
{
    public function actionLogin()
    {
        $name = '';
        $surname = '';
        $email = '';
        $emailr = '';
        $password = '';
        $conf_pw = '';

        $result = false;
        if (isset($_POST['sign_in'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkEmailLogin($email)) {
                $errors[] = 'Wrong email';
            }

            if ($errors == false) {
                $result = User::sign_in($email, $password);
                if (!$result) {
                    echo 'Wrong password';
                } else {
                    setcookie('id_user', $result);
                    header("location:/profile");
                }
            } else {
                echo array_shift($errors);
            }
        } //sign in

        if (isset($_POST['sign_up'])) {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $emailr = $_POST['email'];
            $password = $_POST['password'];
            $conf_pw = $_POST['c_password'];

            $errors = false;

            if (!User::checkLogin($name, $surname)) {
                $errors[] = 'Name and surname must consists only characters(Aa-Zz)';
            }
            if (strcmp($password, $conf_pw)) {
                $errors[] = 'Passwords do not match';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Password must consists 6 - 25 symbols';
            }
            if (!User::checkEmail($emailr)) {
                $errors[] = 'Wrong email';
            }

            if (!User::checkEmailExists($emailr)) {
                $errors[] = 'This email already exists';
            }

            if ($errors == false) {
                $result = User::register_ok($name, $surname, $emailr, $password);
                echo 'ok';
            } else {
                echo array_shift($errors);
            }
        } //register

        require_once (ROOT.'/views/login/index.php');
        return true;
    }

    public function actionLogout()
    {
        setcookie('id_user', '', time()-3600);
        header('location:/');
    }
}