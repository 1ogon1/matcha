<?php


class Message
{
	public static function getLikedUsers($id_one, $id_two)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_GET_LIKE);
		$stmt->execute([
			$id_one,
			$id_two
		]);
		if ($stmt->rowCount()) {
			return true;
		}
		return false;
	}

	public static function getUsers()
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare("SELECT u.login, u.avatar, u.id FROM user u LEFT JOIN likes l ON u.id = l.id_user WHERE l.id_user IN (SELECT id_user FROM likes WHERE id_like_user = " . $_COOKIE['id_user'] . " AND id_user IN (SELECT id_like_user FROM likes WHERE id_user = " . $_COOKIE['id_user'] . ")) GROUP BY u.id");
		$stmt->execute();
		$idUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $idUsers;
	}

	public static function getLastMessageById($id)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_GET_LAST_MESSAGE_BY_ID);
		$stmt->execute([
			$_COOKIE['id_user'],
			$id,
			$id,
			$_COOKIE['id_user']
		]);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}