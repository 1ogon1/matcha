<?php

require_once ROOT . '/models/Profile.php';
require_once ROOT . '/models/User.php';
require_once ROOT . '/models/Message.php';
require_once ROOT . '/config/sql.php';

class ProfileController
{
	public function actionIndex($id)
	{
		User::isGuest();
		$time = time();
		$user = Profile::showUser($id);
		self::actionOnline();
		$status = Profile::setStatus();
		$userStatus = Profile::userStatus($id);
		$userInfo = Profile::showUserInfo($id);
		$userTag = Profile::getTagById($id);
		$block = Profile::getBlock($id);
		$like = Profile::getLike($id);
		$newMessage = Message::newMessage();
		$rating = Profile::getRatingById($id);

		if ($id != $_COOKIE['id_user']) {
			Profile::addVisitor($id, $_COOKIE['id_user'], 1);
		}

		require_once(ROOT . '/views/profile/index.php');
		return true;
	}

	public function actionSettings()
	{
		User::isGuest();
		$personal_info = null;
		self::actionOnline();
		$user = Profile::showUser($_COOKIE['id_user']);
		$photo = Profile::showUserImage();
		$status = Profile::setStatus();
		$newMessage = Message::newMessage();
		$maxImage = Profile::countImage();
		$error = '';

		if (isset($_POST['upload'])) {
			$dir = '/template/foto/';
			$file = $dir . basename($_FILES['file']['name']);
			$dir2 = ROOT . '/template/foto/';
			$file2 = $dir2 . basename($_FILES['file']['name']);
			if ((($_FILES['file']['type'] == "image/png") ||
				($_FILES['file']['type'] == "image/jpg") ||
				($_FILES['file']['type'] == "image/jpeg"))
			) {
				if (copy($_FILES['file']['tmp_name'], $file2)) {
					Profile::saveUserPhoto($_FILES['file']['name'], $file);
					header('location:/settings');
				}
			} else {
				$error = 'Сталась помилка';
			}
		}

		require_once(ROOT . '/views/profile/settings.php');
		return true;
	}

	public function actionSave()
	{
		$user = [
			'login' => htmlspecialchars($_POST['login']),
			'name' => $_POST['name'],
			'surname' => $_POST['surname'],
			'email' => $_POST['email'],
			'gender' => $_POST['gender'],
			'sex_pref' => $_POST['sex_pref'],
			'biography' => htmlspecialchars($_POST['biography']),
//			'address' => htmlspecialchars($_POST['address']),
			'birthday' => $_POST['birthday']
		];
		$errors = false;
		if (!User::checkLogin($user)) {
			$errors[] = 'Name and surname must consists only characters(Aa-Zz)';
		}
		if (!User::checkEmail($_POST['email'])) {
			$errors[] = 'Wrong email';
		}
		if ($errors == false) {
			Profile::updateInformation($user);
			$rating = Profile::getRatingById($_COOKIE['id_user']);
			echo 'Зміни збережено';
//            echo $user['address'];
		} else {
			echo array_shift($errors);
		}
		return true;
	}

	public function actionAvatar()
	{
		$res = Profile::setAvatar($_POST['src']);
		if ($res) {
			echo 'Аватар встановленно';
		} else {
			echo 'Сталась помилка';
		}
	}

	public function actionDelete()
	{
		$res = Profile::deletePhoto($_POST['id'], $_POST['src']);
		if ($res) {
//            echo 'Фото видалено';
			unlink(ROOT . $_POST['src']);
		}// else {
//            echo 'Сталась помилка';
//        }
	}

	public static function actionOnline()
	{
		Profile::setOnline();
	}

	public function actionSeeNew()
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare("SELECT * FROM visitor WHERE id_user = ? AND status = 0");
		$stmt->execute([
			$_COOKIE['id_user']
		]);
		if ($stmt->rowCount()) {
			echo 'ok';
		}
	}

	public function actionVisitor()
	{
		$pdo = DataBase::getConnection();
		$stmt = $pdo->prepare(SQL_GET_VISITOR);
		$stmt->execute([
			$_COOKIE['id_user']
		]);
		$res = $stmt->rowCount();
		if ($res) {
			$id = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($id as $row) {
				$stmt = $pdo->prepare(SQL_SHOW_NAME);
				$stmt->execute([$row['id_visitor']]);
				$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach ($res as $rows) {
					if ($row['type'] == 1) {

						if ($row['status'] == 0) {
							echo '<a href="javascript: user_info(' . $rows['id'] . ')"><div class="user new_user"><img src="' . $rows['avatar'] . '">' .
								$rows['login'] .
								'<br><span>Відвідав вашу сторінку</span></div></a>';
						} else if ($row['status'] == 1) {
							echo '<a href="javascript: user_info(' . $rows['id'] . ')"><div class="user"><img src="' . $rows['avatar'] . '">' .
								$rows['login'] .
								'<br><span>Відвідав вашу сторінку</span></div></a>';
						}
					} else if ($row['type'] == 2) {

						if ($row['status'] == 0) {
							echo '<a href="javascript: user_info(' . $rows['id'] . ')"><div class="user new_user"><img src="' . $rows['avatar'] . '">' .
								$rows['login'] .
								'<br><span>Лайкнув вас</span></div></a>';
						} else if ($row['status'] == 1) {
							echo '<a href="javascript: user_info(' . $rows['id'] . ')"><div class="user"><img src="' . $rows['avatar'] . '">' .
								$rows['login'] .
								'<br><span>Лайкнув вас</span></div></a>';
						}
					} else if ($row['type'] == 3) {

						if ($row['status'] == 0) {
							echo '<a href="javascript: user_info(' . $rows['id'] . ')"><div class="user new_user"><img src="' . $rows['avatar'] . '">' .
								$rows['login'] .
								'<br><span>Дизлайкнув вас</span></div></a>';
						} else if ($row['status'] == 1) {
							echo '<a href="javascript: user_info(' . $rows['id'] . ')"><div class="user"><img src="' . $rows['avatar'] . '">' .
								$rows['login'] .
								'<br><span>Дизлайкнув вас</span></div></a>';
						}
					}
				}
			}
		}
	}

//echo '<a href="javascript: user_ifo(' . $rows['id'] . ')" title = "user info"><div class="user new_user"><img src="' . $rows['avatar'] . '">' .
//$rows['login'] .
//'</div></a>';

	public function actionVisitorload()
	{
		$pdo = DataBase::getConnection();
		$stmt = $pdo->prepare(SQL_GET_VISITOR_LOAD);
		$stmt->execute([
			$_COOKIE['id_user']
		]);
		$res = $stmt->rowCount();
		if ($res) {
			$id = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($id as $row) {
				$stmt = $pdo->prepare(SQL_SHOW_NAME);
				$stmt->execute([$row['id_visitor']]);
				$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach ($res as $rows) {
					if ($row['type'] == 1) {

						if ($row['status'] == 0) {
							echo '<a href="javascript: user_info(' . $rows['id'] . ')"><div class="user new_user"><img src="' . $rows['avatar'] . '">' .
								$rows['login'] .
								'<br><span>Відвідав вашу сторінку</span></div></a>';
						} else if ($row['status'] == 1) {
							echo '<a href="javascript: user_info(' . $rows['id'] . ')"><div class="user"><img src="' . $rows['avatar'] . '">' .
								$rows['login'] .
								'<br><span>Відвідав вашу сторінку</span></div></a>';
						}
					} else if ($row['type'] == 2) {

						if ($row['status'] == 0) {
							echo '<a href="javascript: user_info(' . $rows['id'] . ')"><div class="user new_user"><img src="' . $rows['avatar'] . '">' .
								$rows['login'] .
								'<br><span>Лайкнув вас</span></div></a>';
						} else if ($row['status'] == 1) {
							echo '<a href="javascript: user_info(' . $rows['id'] . ')"><div class="user"><img src="' . $rows['avatar'] . '">' .
								$rows['login'] .
								'<br><span>Лайкнув вас</span></div></a>';
						}
					} else if ($row['type'] == 3) {

						if ($row['status'] == 0) {
							echo '<a href="javascript: user_info(' . $rows['id'] . ')"><div class="user new_user"><img src="' . $rows['avatar'] . '">' .
								$rows['login'] .
								'<br><span>Дизлайкнув вас</span></div></a>';
						} else if ($row['status'] == 1) {
							echo '<a href="javascript: user_info(' . $rows['id'] . ')"><div class="user"><img src="' . $rows['avatar'] . '">' .
								$rows['login'] .
								'<br><span>Дизлайкнув вас</span></div></a>';
						}
					}
				}
			}
		}
	}

	public function actionDelvisit()
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_SEW_VISITOR);
		$stmt->execute([
			':id_user' => $_COOKIE['id_user'],
			':status' => 1
		]);
	}

	public function actionMore()
	{
		User::isGuest();
		self::actionOnline();
		$status = Profile::setStatus();
		$user = Profile::showUser($_COOKIE['id_user']);
		$user_info = Profile::showUserInfo($_COOKIE['id_user']);
		$tag = Profile::getTagById($_COOKIE['id_user']);
		$newMessage = Message::newMessage();

		require_once ROOT . '/views/profile/more_settings.php';
		return true;
	}

	public function actionAddtag()
	{
		$pdo = DataBase::getConnection();

		$tag = htmlspecialchars($_POST['tag']);

		$res = Profile::checkTag($tag, $_COOKIE['id_user']);
		if ($res) {
			echo 'error';
		} else {
			$stmt = $pdo->prepare(SQL_ADD_TAG);
			$stmt->execute([
				$_COOKIE['id_user'],
				$tag
			]);
			$id = $pdo->lastInsertId();
			echo '<li class="tag_gel" value="' . $id . '"><a>#' . $tag . '</a></li>';
		}
	}

	public function actionDeletetag()
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_DELETE_TAG_BY_ID);
		$stmt->execute([$_POST['tag']]);
//        echo $stmt->rowCount();
	}

	public function actionBlock()
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_BLOCK_USER);
		$stmt->execute([
			$_COOKIE['id_user'],
			$_POST['id_block_user']
		]);
		if ($stmt->rowCount()) {
			echo 'ok';
		}
	}

	public function actionUnblock()
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_UNBLOCK_USER);
		$stmt->execute([
			$_COOKIE['id_user'],
			$_POST['id_block_user']
		]);

		if ($stmt->rowCount()) {
			echo 'ok';
		}
	}

	public function actionLike()
	{
		$pdo = DataBase::getConnection();

		Profile::addVisitor($_POST['id_like_user'], $_COOKIE['id_user'], 2);
		$stmt = $pdo->prepare(SQL_LIKE_USER);
		$stmt->execute([
			$_COOKIE['id_user'],
			$_POST['id_like_user']
		]);
		if ($stmt->rowCount()) {
			echo 'ok';
		}
	}

	public function actionUnlike()
	{
		$pdo = DataBase::getConnection();

		Profile::addVisitor($_POST['id_like_user'], $_COOKIE['id_user'], 3);
		$stmt = $pdo->prepare(SQL_UNLIKE_USER);
		$stmt->execute([
			$_COOKIE['id_user'],
			$_POST['id_like_user']
		]);
		if ($stmt->rowCount()) {
			echo 'ok';
		}
	}

	public function actionChangepw()
	{
		if (!strcmp($_POST['pw'], $_POST['c_pw'])) {
			if (User::checkPassword($_POST['pw'])) {
				$passwd = hash("whirlpool", $_POST['pw']);
				Profile::changePassword($passwd);
				echo 'ok';
			} else {
				echo 'Не коректний пароль';
			}
		} else {
			echo 'Паролі не співпадають';
		}
	}

	public function actionSetAddress()
	{
		$pdo = DataBase::getConnection();

		$address = Profile::getAddress($_POST['id']);

		if (isset($_POST['change_loc'])) {
			$stmt = $pdo->prepare("UPDATE user_info SET lat = :lat, lng = :lng WHERE id_user = :id_user");
			$stmt->execute([
				':id_user' => $_COOKIE['id_user'],
				':lat' => $_POST['lat'],
				':lng' => $_POST['lng']
			]);
			$address = Profile::getAddress($_POST['id']);
			echo json_encode($address);
		} else {
			if ($address) {
				echo json_encode($address);
			} else {
				$stmt = $pdo->prepare("UPDATE user_info SET lat = :lat, lng = :lng WHERE id_user = :id_user");
				$stmt->execute([
					':id_user' => $_COOKIE['id_user'],
					':lat' => $_POST['lat'],
					':lng' => $_POST['lng']
				]);
				$address = Profile::getAddress($_POST['id']);
				echo json_encode($address);
			}
		}
	}
}