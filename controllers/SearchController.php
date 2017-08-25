<?php

require_once ROOT . '/models/Search.php';
require_once ROOT . '/models/Profile.php';
require_once ROOT . '/models/Message.php';
require_once ROOT . '/config/sql.php';

class SearchController
{
	public function actionIndex()
	{
		Profile::setOnline();
		$status = Profile::setStatus();
		$newMessage = Message::newMessage();


		require_once ROOT . '/views/search/index.php';
		return true;
	}

	public function actionSearchParams()
	{
		$params['name'] = ' ';
		$params['surname'] = ' ';
		$params['gender'] = 0;
		$params['sex_pref'] = 0;
		$params['sort'] = $_POST['sort'];

		if ($_POST['name'] != '') {
			$params['name'] = $_POST['name'];
		}
		if ($_POST['surname'] != '') {
			$params['surname'] = $_POST['surname'];
		}
		if ($_POST['age1'] && $_POST['age2']) {

			$params['age1'] = date((date('Y') - $_POST['age1']) . '-m-d');
			$params['age2'] = date((date('Y') - $_POST['age2']) . '-m-d');
			$pdo = DataBase::getConnection();
			$res = 0;
			if ($params['sort'] == 0) {
				$stmt = $pdo->prepare("SELECT id, login, avatar FROM user WHERE id IN (SELECT id_user FROM user_info WHERE birthday BETWEEN :age2 AND :age1)");
				$stmt->bindParam(':age2', $params['age2'], PDO::PARAM_STR);
				$stmt->bindParam(':age1', $params['age1'], PDO::PARAM_STR);
				$stmt->execute();
				$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
			foreach ($res as $row) {
				$result['avatar'] = $row['avatar'];
				$result['id'] = $row['id'];
				echo "<img src='" . $row['avatar'] . "' style='width: 100px; height: 120px'>" . "<p><a href='/profile/" . $row['avatar'] . "'>" . $row['login'] . "</a></p>";
			}
		} else {

		}
	}
}