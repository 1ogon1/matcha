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

	public static function showUserInfo($id)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SELECT_USER_INFO);
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
			':email' => $personal_info['email']
		]);
		$stmt = $pdo->prepare(SQL_USER_UPDATE_INFO);
		$stmt->execute([
			':id_user' => $_COOKIE['id_user'],
			':gender' => $personal_info['gender'],
			':sex_pref' => $personal_info['sex_pref'],
			':biography' => $personal_info['biography'],
			':birthday' => $personal_info['birthday'],
//			':address' => $personal_info['address']
		]);
	}

	public static function checkName($name)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare("SELECT * FROM image WHERE name = ?");
		$stmt->execute([
			$name
		]);
		$res = $stmt->rowCount();
		if ($res) {
			return false;
		}
		return true;
	}

	public static function saveUserPhoto($name, $src)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_ADD_IMAGE);
		$stmt->execute([
			$_COOKIE['id_user'],
			$name . $i,
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
		$time = time();
		$status = $time - $st;
		return $status;
	}

	public static function userStatus($id)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_GET_STATUS);
		$stmt->execute([$id]);
		$date = $stmt->fetch(PDO::FETCH_ASSOC);
		$st = $date['status'];
		$time = time();
//		$status = $time - $st;
		return $st;
	}

	public static function addVisitor($id_user, $id_visitor, $type)
	{
		$pdo = DataBase::getConnection();

//		$stmt = $pdo->prepare(SQL_GET_VISITOR_CHECK);
//		$stmt->execute([
//			$id_user,
//			$id_visitor
//		]);
//		$res = $stmt->rowCount();
//		if (!$res) {
		$stmt = $pdo->prepare(SQL_ADD_VISITOR);
		$stmt->execute([
			$id_user,
			$id_visitor,
			$type,
			0
		]);
//		}
	}

	public static function getTagById($id)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_GET_TAG_BY_ID);
		$stmt->execute([$id]);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function checkTag($tag, $id)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_GET_TAG_BY_NAME);
		$stmt->execute([
			$tag,
			$id
		]);
		return $stmt->rowCount();
	}

	public static function getBlock($id)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_GET_BLOCK);
		$stmt->execute([
			$_COOKIE['id_user'],
			$id
		]);
		return $stmt->rowCount();
	}

	public static function getLike($id)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_GET_LIKE);
		$stmt->execute([
			$_COOKIE['id_user'],
			$id
		]);
		return $stmt->rowCount();
	}

	public static function changePassword($password)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_CHANGE_PASSWORD);
		$stmt->execute([
			':id' => $_COOKIE['id_user'],
			':password' => $password
		]);
	}

	public static function setOnline()
	{
		$pdo = DataBase::getConnection();

		$time = time();
		$stmt = $pdo->prepare(SQL_SET_ONLINE);
		$stmt->execute([
			':id' => $_COOKIE['id_user'],
			':status' => $time
		]);
	}

	public static function getAddress($id)
	{
		$pdo = DataBase::getConnection();

		$mass = array();
		$stmt = $pdo->prepare("SELECT lat, lng FROM user_info WHERE id_user = ?");
		$stmt->execute([$_POST['id']]);
		if ($stmt->rowCount()) {
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($res as $row) {
				$mass['lat'] = $row['lat'];
				$mass['lng'] = $row['lng'];
				return $mass;
			}
		}
		return false;
	}

	public static function countImage()
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare("SELECT * FROM image WHERE id_user = ?");
		$stmt->execute([
			$_COOKIE['id_user']
		]);
		return $stmt->rowCount();
	}

	public static function getRatingById($id)
	{
		$pdo = DataBase::getConnection();

		$rating = 0;

		$stmt = $pdo->prepare("SELECT u.avatar, i.gender, i.sex_pref, i.biography, i.birthday, i.lat, i.lng FROM user u INNER JOIN user_info i ON u.id = ? AND i.id_user = ?");
		$stmt->execute([
			$id,
			$id
		]);
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($res as $row) {
			if (strcmp($row['avatar'], "/template/images/default-avatar.png")) {
				$rating += 20;
			}
			if ($row['gender'] != 0) {
				$rating += 20;
			}
			if ($row['sex_pref'] != 0) {
				$rating += 15;
			}
			if ($row['biography']) {
				$rating += 15;
			}
			if ($row['birthday'] != 0) {
				$rating += 15;
			}
			if ($row['lat'] && $row['lng']) {
				$rating += 15;
			}
		}
		$rating += 5 * self::getUsers($id);
		self::setRating($id, $rating);
		return $rating;
	}

	private static function getUsers($id)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare("SELECT u.login, u.avatar, u.id FROM user u LEFT JOIN likes l ON u.id = l.id_user WHERE l.id_user IN (SELECT id_user FROM likes WHERE id_like_user = " . $id . " AND id_user IN (SELECT id_like_user FROM likes WHERE id_user = " . $id . ")) GROUP BY u.id");
		$stmt->execute();
		return $stmt->rowCount();
	}

	private static function setRating($id, $rating)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare("UPDATE rating SET user_rating = :user_rating WHERE id_user = :id_user");
		$stmt->execute([
			':id_user' => $id,
			':user_rating' => $rating
		]);
	}
}