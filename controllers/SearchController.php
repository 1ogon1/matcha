<?php

require_once ROOT . '/models/Search.php';
require_once ROOT . '/models/Profile.php';
require_once ROOT . '/models/Message.php';
require_once ROOT . '/models/User.php';
require_once ROOT . '/config/sql.php';

class SearchController
{
	public function actionIndex()
	{
		User::isGuest();
		Profile::setOnline();
		$status = Profile::setStatus();
		$newMessage = Message::newMessage();
		$recommended = Search::recommended();
		Search::delSearchTag();


		require_once ROOT . '/views/search/index.php';
		return true;
	}

	public function actionAddSearchTag()
	{
		$res = explode(' ', $_POST['tag']);
		$param = array_filter($res, "Search::ft_true");
		if ($param) {
			$pdo = DataBase::getConnection();

			$stmt = $pdo->prepare("SELECT * FROM search_tag");
			$stmt->execute();
			if ($stmt->rowCount()) {
				$stmt = $pdo->prepare('DELETE FROM search_tag');
				$stmt->execute();

				$i = 0;
				while ($param) {
					$stmt = $pdo->prepare("INSERT INTO search_tag (tag) VALUES (:tag)");

					$stmt->bindParam(':tag', $param[$i], PDO::PARAM_STR);
					$stmt->execute();
					$i++;
				}
			} else {
				$i = 0;
				while ($param) {
					$stmt = $pdo->prepare("INSERT INTO search_tag (tag) VALUES (:tag)");

					$stmt->bindParam(':tag', $param[$i], PDO::PARAM_STR);
					$stmt->execute();
					$i++;
				}
			}
		} else {
			$pdo = DataBase::getConnection();

			$stmt = $pdo->prepare('DELETE FROM search_tag');
			$stmt->execute();
		}
	}

	public function actionSearchParams()
	{
		$params = Search::setParams($_POST);

//		if ($params['sort'] != 0) {
//			Search::searchWithSort($params);
//		} else {
			Search::searchWithoutSort($params);
//		}

	}
}