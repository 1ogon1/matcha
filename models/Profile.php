<?php

class Profile
{
	public static function showUser($id)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_SHOW_NAME);
		$stmt->execute([$id]);
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	public static function updateInformation($personal_info)
    {
        $pdo = DataBase::getConnection();
        $stmt = $pdo->prepare(SQL_USER_UPDATE);
        $stmt->execute([
            ':id' => $_COOKIE['id_user'],
            ':login' => $personal_info['login'],
            ':name' => $personal_info['name'],
            ':surname' => $personal_info['surname'],
            ':email' => $personal_info['email'],
            ':birthday' => $personal_info['birthday'],
            ':info' => $personal_info['info']
        ]);
    }

    public static function saveUserPhoto($name, $src)
    {
        $pdo = DataBase::getConnection();

        $stmt = $pdo->prepare(SQL_ADD_IMAGE);
        $stmt->execute([
            $_COOKIE['id_user'],
            $name,
            $src
        ]);
    }

    public static function showUserImage()
    {
        $pdo = DataBase::getConnection();

        $stmt = $pdo->prepare(SQL_SHOW_USER_IMAGE);
        $stmt->execute([$_COOKIE['id_user']]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public static function setAvatar($src)
    {
        $pdo = DataBase::getConnection();

        $stmt = $pdo->prepare(SQL_UPDATE_AVATAR);
        $stmt->execute([
            'id' => $_COOKIE['id_user'],
            ':avatar' => $src
        ]);
        $res = $stmt->rowCount();
        return $res;
    }

    public static function checkAvatar($user, $src)
    {
        foreach ($user as $row) {
            if (!strcmp($row['avatar'], $src)) {
                return true;
            }
        }
        return false;
    }

    public static function deletePhoto($id, $src)
    {
        $res = 0;
        $pdo = DataBase::getConnection();

        $stmt = $pdo->prepare(SQL_SHOW_NAME);
        $stmt->execute([$_COOKIE['id_user']]);
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = self::checkAvatar($user, $src);
        if ($result) {
            $stmt = $pdo->prepare(SQL_DELETE_IMAGE);
            $stmt->execute([$id]);
            $res = $stmt->rowCount();
            $stmtt = $pdo->prepare(SQL_UPDATE_AVATAR);
            $stmtt->execute([
                ':id' => $_COOKIE['id_user'],
                ':avatar' => '/template/images/default-avatar.png'
            ]);
        } else {
            $stmt = $pdo->prepare(SQL_DELETE_IMAGE);
            $stmt->execute([$id]);
            $res = $stmt->rowCount();
        }
        return $res;
    }

    public static function setStatus()
    {
        $pdo = DataBase::getConnection();

        $stmt = $pdo->prepare(SQL_GET_STATUS);
        $stmt->execute([$_COOKIE['id_user']]);
        $date = $stmt->fetch(PDO::FETCH_ASSOC);
        $st = $date['status'];
        $now = new DateTime('now');
        $last = new DateTime($st);
        $status = date_diff($now, $last);
        return $status;
    }

    public static function userStatus($id)
    {
        $pdo = DataBase::getConnection();

        $stmt = $pdo->prepare(SQL_GET_STATUS);
        $stmt->execute([$id]);
        $date = $stmt->fetch(PDO::FETCH_ASSOC);
        $st = $date['status'];
        $now = new DateTime('now');
        $last = new DateTime($st);
        $status = date_diff($now, $last);
        return $status;
    }

    public static function addVisitor($id_user, $id_visitor)
    {
        $pdo = DataBase::getConnection();

        $stmt = $pdo->prepare(SQL_GET_VISITOR_CHECK);
        $stmt->execute([
            $id_user,
            $id_visitor
        ]);
        $res = $stmt->rowCount();
        if (!$res) {
            $stmt = $pdo->prepare(SQL_ADD_VISITOR);
            $stmt->execute([
                $id_user,
                $id_visitor,
                0
            ]);
        }
    }
}