<?php

class Search
{
	public static function recommended()
	{
		$pdo = DataBase::getConnection();
		$gender = 0;
		$sex_pref = 0;

		$stmt = $pdo->prepare("SELECT gender, sex_pref FROM user_info WHERE id_user = :id_user");
		$stmt->bindParam(':id_user', $_COOKIE['id_user'], PDO::PARAM_INT);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach ($res as $row) {
			$gender = $row['gender'];
			$sex_pref = $row['sex_pref'];
		}

		if ($gender == 0) {
			$sql = "SELECT * FROM user u LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN rating r ON u.id = r.id_user WHERE u.id != :id ORDER BY r.user_rating DESC";

			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':id', $_COOKIE['id_user'], PDO::PARAM_INT);
			$stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else if ($gender == 1) {
			$sql = "SELECT * FROM user u LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN rating r ON u.id = r.id_user WHERE u.id != :id AND ui.gender = 2 AND ui.sex_pref = :sex_pref OR u.id != :id AND ui.gender = 2 AND ui.sex_pref = 0 ORDER BY r.user_rating DESC";

			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":id", $_COOKIE['id_user'], PDO::PARAM_INT);
			$stmt->bindParam(":sex_pref", $sex_pref, PDO::PARAM_INT);
			$stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else if ($gender == 2) {
			$sql = "SELECT * FROM user u LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN rating r ON u.id = r.id_user WHERE u.id != :id AND ui.gender = 1 AND ui.sex_pref = 1 OR u.id != :id AND ui.gender = 1 AND ui.sex_pref = 0 ORDER BY r.user_rating DESC";

			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':id', $_COOKIE['id_user'], PDO::PARAM_INT);
			$stmt->bindParam(":sex_pref", $sex_pref, PDO::PARAM_INT);
			$stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $res;
	}

	public static function setParams($set)
	{
		$params['name'] = '';
		$params['surname'] = '';
		$params['gender'] = '';
		$params['sex_pref'] = '';
		$params['sort'] = 0;
		$params['age1'] = date((date('Y') - 1) . '-m-d');
		$params['age2'] = date((date('Y') - 200) . '-m-d');
		$params['reit1'] = 0;
		$params['reit2'] = 1000;
		$params['sort'] = 0;

		if ($set['name']) {
			$params['name'] = $set['name'];
		}
		if ($set['surname']) {
			$params['surname'] = $set['surname'];
		}
		if ($set['gender']) {
			$params['gender'] = $set['gender'];
		}
		if ($set['sex_pref']) {
			$params['sex_pref'] = $set['sex_pref'];
		}
		if ($set['age1'] && $set['age2']) {
			$params['age1'] = date((date('Y') - $_POST['age1']) . '-m-d');
			$params['age2'] = date((date('Y') - $_POST['age2']) . '-m-d');
		}
		if ($set['reit1'] && $set['reit2']) {
			$params['reit1'] = $set['reit1'];
			$params['reit2'] = $set['reit2'];
		}
		if ($set['sort']) {
			$params['sort'] = $set['sort'];
		}
		return $params;
	}

	public static function searchWithoutSort($params)
	{
		$res = 0;
		$pdo = DataBase::getConnection();

		$sql_query = self::getSqlQuery($params);
		$coord = self::getLat($_COOKIE['id_user']);

		$sql = "SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday" . $sql_query['distance'] . $sql_query['tag_count'] . "
				FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user" . $sql_query['tag_join'] . "
				WHERE" . $sql_query['tag_query'] . $sql_query['block'] . " r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.id != :id_user" . $sql_query['name_part'] . $sql_query['surname_part'] . $sql_query['sort_part'];

		$stmt = $pdo->prepare($sql);

		if ($sql_query['name_part']) {
			$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
		}
		if ($sql_query['surname_part']) {
			$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
		}
		if ($sql_query['distance']) {
			$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
			$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
		}
		$stmt->bindParam(':id_user', $_COOKIE['id_user'], PDO::PARAM_STR);
		$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
		$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
		$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
		$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach ($res as $row) {
			echo "<img src='" . $row['avatar'] . "' style='width: 100px; height: 120px'>" . "<p><a href='/profile/" . $row['id'] . "'>" . $row['login'] . "</a></p>";
		}
	}

	private static function getSqlQuery($params)
	{
		$sql_query = array();

		$sql_query['name_part'] = "";
		$sql_query['surname_part'] = "";
		$sql_query['sort_part'] = "";
		$sql_query['distance'] = "";
		$sql_query['tag_join'] = "";
		$sql_query['tag_count'] = "";
		$sql_query['tag_join'] = "";
		$sql_query['tag_query'] = "";
		$sql_query['tag_part'] = "";
		$sql_query['block'] = " u.id NOT IN (SELECT id_user FROM block WHERE id_block_user = 1) AND";

		if ($params['name']) {
			$sql_query['name_part'] = " AND u.name = :name";
		}
		if ($params['surname']) {
			$sql_query['surname_part'] = " AND u.surname = :surname";
		}
		if ($params['sort']) {
			if ($params['sort'] == 1) {
				$sql_query['sort_part'] = " ORDER BY ui.birthday DESC";
			}
			if ($params['sort'] == 2) {
				$sql_query['tag_count'] = ", COUNT(*) AS count ";
				$sql_query['tag_join'] = " LEFT JOIN tag t ON u.id = t.id_user";
				$sql_query['tag_query'] = " t.tag IN (SELECT tag FROM tag WHERE id_user = :id_user) AND";
				$sql_query['sort_part'] = " GROUP BY u.id ORDER BY count DESC";
			}
			if ($params['sort'] == 3) {
				$sql_query['sort_part'] = " ORDER BY r.user_rating DESC";
			}
			if ($params['sort'] == 4) {
				$sql_query['distance'] = ", ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance ";
				$sql_query['sort_part'] = " ORDER BY distance";
			}
		}
		if (self::getSearchTag()) {
			$sql_query['tag_count'] = ", COUNT(*) AS count ";
			$sql_query['tag_join'] = " LEFT JOIN tag t ON u.id = t.id_user";
			$sql_query['tag_query'] = " t.tag IN (SELECT tag FROM search_tag) AND";
			$sql_query['sort_part'] = " GROUP BY u.id ORDER BY count DESC";
		}

		return $sql_query;
	}

//SELECT *, COUNT(*) AS count FROM user u LEFT JOIN tag t ON u.id = t.id_user WHERE t.tag IN (SELECT tag FROM tag WHERE id_user = :id_user) AND u.id != :id_user GROUP BY u.id ORDER BY count DESC

//SELECT *, COUNT(*) AS count FROM user u LEFT JOIN tag t ON u.id = t.id_user WHERE t.tag IN (SELECT tag FROM search_tag) AND u.id != 1 GROUP BY u.id ORDER BY count DESC

	public static function ft_true($new)
	{
		if (strlen($new) > 0)
			return (1);
		else
			return (0);
	}

	public static function delSearchTag()
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->exec("DELETE FROM search_tag");

	}

	private static function getSearchTag()
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare("SELECT * FROM search_tag");
		$stmt->execute();
		return $stmt->rowCount();
	}

	private static function getLat($id)
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare('SELECT lat, lng FROM user_info WHERE id_user = :id_user');
		$stmt->bindParam(':id_user', $id, PDO::PARAM_INT);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$result = array();
		foreach ($res as $row) {
			$result['lat'] = $row['lat'];
			$result['lng'] = $row['lng'];
		}
		return $result;
	}
}