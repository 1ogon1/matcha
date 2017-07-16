<?php

class User
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
            '/template/images/default-avatar.png'
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