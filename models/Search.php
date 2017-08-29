<?php

class Search
{
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

		$tag = self::getSearchTag();
		if ($tag == 0) {
			if ($params['gender'] == '') {
				if ($params['sex_pref'] == '') {
					if ($params['name']) {
						if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname");
							$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name");
							$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else if ($params['surname']) {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname");
						$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					} else {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1");
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					}
				} else {
					if ($params['name']) {
						if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.sex_pref = :sex_pref");
							$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.sex_pref = :sex_pref");
							$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else if ($params['surname']) {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.sex_pref = :sex_pref");
						$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					} else {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.sex_pref = :sex_pref");
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					}
				}
			} else {
				if ($params['sex_pref'] == '') {
					if ($params['name']) {
						if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender");
							$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender");
							$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else if ($params['surname']) {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender");
						$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					} else {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender");
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					}
				} else {
					if ($params['name']) {
						if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref");
							$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender AND ui.sex_pref = :sex_pref");
							$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else if ($params['surname']) {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref");
						$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
						$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					} else {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender AND ui.sex_pref = :sex_pref");
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
						$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					}
				}
			}
		} else {
			$res = self::searchAllWithTag($params);
		}

//		var_dump($res);
//		var_dump($params);
		foreach ($res as $row) {
			$result['avatar'] = $row['avatar'];
			$result['id'] = $row['id'];
			echo "<img src='" . $row['avatar'] . "' style='width: 100px; height: 120px'>" . "<p><a href='/profile/" . $row['id'] . "'>" . $row['login'] . "</a></p>";
		}
//		self::delSearchTag();
	}

	private static function searchAllWithTag($params)
	{
		$res = 0;
		$pdo = DataBase::getConnection();

		if ($params['gender'] == '') {
			if ($params['sex_pref'] == '') {
				if ($params['name']) {
					if ($params['surname']) {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname");
						$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
						$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					} else {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name");
						$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					}
				} else if ($params['surname']) {
					$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname");
					$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
					$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
					$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
					$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
					$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
					$stmt->execute();
					$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
				} else {
					$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1");
					$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
					$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
					$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
					$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
					$stmt->execute();
					$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			} else {
				if ($params['name']) {
					if ($params['surname']) {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.sex_pref = :sex_pref");
						$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
						$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					} else {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.sex_pref = :sex_pref");
						$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					}
				} else if ($params['surname']) {
					$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.sex_pref = :sex_pref");
					$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
					$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
					$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
					$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
					$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
					$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
					$stmt->execute();
					$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
				} else {
					$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.sex_pref = :sex_pref");
					$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
					$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
					$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
					$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
					$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
					$stmt->execute();
					$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
		} else {
			if ($params['sex_pref'] == '') {
				if ($params['name']) {
					if ($params['surname']) {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender");
						$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
						$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					} else {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender");
						$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					}
				} else if ($params['surname']) {
					$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender");
					$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
					$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
					$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
					$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
					$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
					$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
					$stmt->execute();
					$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
				} else {
					$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender");
					$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
					$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
					$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
					$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
					$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
					$stmt->execute();
					$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			} else {
				if ($params['name']) {
					if ($params['surname']) {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref");
						$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
						$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
						$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					} else {
						$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender AND ui.sex_pref = :sex_pref");
						$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
						$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
						$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
						$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
						$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
						$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
						$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					}
				} else if ($params['surname']) {
					$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref");
					$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
					$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
					$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
					$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
					$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
					$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
					$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
					$stmt->execute();
					$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
				} else {
					$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender AND ui.sex_pref = :sex_pref");
					$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
					$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
					$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
					$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
					$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
					$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
					$stmt->execute();
					$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
		}

		return $res;
	}

	public static function searchWithSort($params)
	{
		$res = 0;
		$pdo = DataBase::getConnection();

		$tag = self::getSearchTag();
		if ($params['sort'] == 1) {
			if ($tag == 0) {
				if ($params['gender'] == '') {
					if ($params['sex_pref'] == '') {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname ORDER BY ui.birthday DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 ORDER BY ui.birthday DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					}
				} else {
					if ($params['sex_pref'] == '') {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender ORDER BY ui.birthday DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender ORDER BY ui.birthday DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					}
				}
			} else {
				if ($params['gender'] == '') {
					if ($params['sex_pref'] == '') {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname ORDER BY ui.birthday DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 ORDER BY ui.birthday DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					}
				} else {
					if ($params['sex_pref'] == '') {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender ORDER BY ui.birthday DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender ORDER BY ui.birthday DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY ui.birthday DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					}
				}
			}
		} else if ($params['sort'] == 2) {

		} else if ($params['sort'] == 3) {
			if ($tag == 0) {
				if ($params['gender'] == '') {
					if ($params['sex_pref'] == '') {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname ORDER BY r.user_rating DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 ORDER BY r.user_rating DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					}
				} else {
					if ($params['sex_pref'] == '') {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender ORDER BY r.user_rating DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender ORDER BY r.user_rating DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					}
				}
			} else {
				if ($params['gender'] == '') {
					if ($params['sex_pref'] == '') {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname ORDER BY r.user_rating DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 ORDER BY r.user_rating DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					}
				} else {
					if ($params['sex_pref'] == '') {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender ORDER BY r.user_rating DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender ORDER BY r.user_rating DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY r.user_rating DESC");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					}
				}
			}
		} else if ($params['sort'] == 4) {
			$coord = self::getLat($_COOKIE['id_user']);
			if ($tag == 0) {
				if ($params['gender'] == '') {
					if ($params['sex_pref'] == '') {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname ORDER BY distance");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name ORDER BY distance");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname ORDER BY distance");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 ORDER BY distance");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.sex_pref = :sex_pref ORDER BY distance");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.sex_pref = :sex_pref ORDER BY distance");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.sex_pref = :sex_pref ORDER BY distance");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.sex_pref = :sex_pref ORDER BY distance");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					}
				} else {
					if ($params['sex_pref'] == '') {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender ORDER BY distance");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender ORDER BY distance");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender ORDER BY distance");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender ORDER BY distance");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY distance");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY distance");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY distance");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user 
							  	WHERE r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY distance");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					}
				}
			} else {
				if ($params['gender'] == '') {
					if ($params['sex_pref'] == '') {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname ORDER BY distance GROUP BY u.id");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name ORDER BY distance GROUP BY u.id");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname ORDER BY distance GROUP BY u.id");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 ORDER BY distance GROUP BY u.id");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.sex_pref = :sex_pref ORDER BY distance GROUP BY u.id");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.sex_pref = :sex_pref ORDER BY distance GROUP BY u.id");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.sex_pref = :sex_pref ORDER BY distance GROUP BY u.id");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.sex_pref = :sex_pref ORDER BY distance GROUP BY u.id");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_INT);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					}
				} else {
					if ($params['sex_pref'] == '') {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender ORDER BY distance GROUP BY u.id");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender ORDER BY distance GROUP BY u.id");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender ORDER BY distance GROUP BY u.id");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender ORDER BY distance GROUP BY u.id");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					} else {
						if ($params['name']) {
							if ($params['surname']) {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY distance GROUP BY u.id");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							} else {
								$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.name = :name AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY distance GROUP BY u.id");
								$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
								$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_INT);
								$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_INT);
								$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
								$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
								$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
								$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
								$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
								$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
								$stmt->execute();
								$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
							}
						} else if ($params['surname']) {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND u.surname = :surname AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY distance GROUP BY u.id");
							$stmt->bindParam(':surname', $params['surname'], PDO::PARAM_STR);
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						} else {
							$stmt = $pdo->prepare("SELECT u.id, u.avatar, u.login, r.user_rating, ui.birthday, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( ui.lat ) ) * cos( radians( ui.lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( ui.lat ) ) ) ) AS distance 
							  	FROM user u LEFT JOIN rating r ON u.id = r.id_user LEFT JOIN user_info ui ON u.id = ui.id_user LEFT JOIN tag t ON u.id = t.id_user 
							  	WHERE t.tag IN (SELECT tag FROM search_tag) AND r.user_rating BETWEEN :reit1 AND :reit2 AND ui.birthday BETWEEN :age2 AND :age1 AND ui.gender = :gender AND ui.sex_pref = :sex_pref ORDER BY distance");
							$stmt->bindParam(':reit1', $params['reit1'], PDO::PARAM_STR);
							$stmt->bindParam(':reit2', $params['reit2'], PDO::PARAM_STR);
							$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
							$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
							$stmt->bindParam(':gender', $params['gender'], PDO::PARAM_STR);
							$stmt->bindParam(':sex_pref', $params['sex_pref'], PDO::PARAM_STR);
							$stmt->bindParam(':lat', $coord['lat'], PDO::PARAM_STR);
							$stmt->bindParam(':lng', $coord['lng'], PDO::PARAM_STR);
							$stmt->execute();
							$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
						}
					}
				}
			}
		}

//		var_dump($res);
		foreach ($res as $row) {
			$result['avatar'] = $row['avatar'];
			$result['id'] = $row['id'];
			echo "<img src='" . $row['avatar'] . "' style='width: 100px; height: 120px'>" . "<p><a href='/profile/" . $row['id'] . "'>" . $row['login'] . "</a></p>";
		}
//		self::delSearchTag();
	}

//SELECT *, COUNT(*) AS num FROM user u LEFT JOIN tag t ON u.id = t.id_user WHERE t.tag IN (SELECT tag FROM tag WHERE id_user = 1) AND u.id != 1 GROUP BY u.id

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

//	private static function getLng($id)
//	{
//		$pdo = DataBase::getConnection();
//
//		$stmt = $pdo->prepare('SELECT lng FROM user_info WHERE id_user = :id_user');
//		$stmt->bindParam(':id_user', $id, PDO::PARAM_INT);
//		$stmt->execute();
//		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
//		return $res[0];
//	}
}