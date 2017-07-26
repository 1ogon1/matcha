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
}