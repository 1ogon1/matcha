<?php

require_once(ROOT . '/models/Profile.php');
require_once(ROOT . '/models/User.php');
require_once(ROOT . '/config/sql.php');

class ProfileController
{
	public function actionIndex($id)
	{
		$user = Profile::showUser($id);
		self::actionOnline();
		$status = Profile::setStatus();
		$userStatus = Profile::userStatus($id);
		$userInfo = Profile::showUserInfo($id);
		$userTag = Profile::getTagById($id);
		$block = Profile::getBlock($id);
		$like = Profile::getLike($id);

		if ($id != $_COOKIE['id_user']) {
			Profile::addVisitor($id, $_COOKIE['id_user']);
		}

		require_once(ROOT . '/views/profile/index.php');
		return true;
	}

	public function actionSettings()
	{
		$personal_info = null;
		self::actionOnline();
		$user = Profile::showUser($_COOKIE['id_user']);
		$photo = Profile::showUserImage();
		$status = Profile::setStatus();

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
				echo 'error file';
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
			'address' => htmlspecialchars($_POST['address']),
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
					echo '<a href="javascript: user_ifo(' . $rows['id'] . ')" title = "user info"><div class="user"><img src="' . $rows['avatar'] . '">' .
						$rows['login'] .
						'</div></a>';
				}
			}
			$stmt = $pdo->prepare(SQL_SEW_VISITOR);
			$stmt->execute([
				':id_user' => $_COOKIE['id_user'],
				':status' => 1
			]);
		}
	}

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
					echo '<a href="javascript: user_ifo(' . $rows['id'] . ')" title = "user info"><div class="user"><img src="' . $rows['avatar'] . '">' .
						$rows['login'] .
						'</div></a>';
				}
			}
			$stmt = $pdo->prepare(SQL_SEW_VISITOR);
			$stmt->execute([
				':id_user' => $_COOKIE['id_user'],
				':status' => 1
			]);
		}
	}

	public function actionDelvisit()
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_DELETE_VISITOR);
		$stmt->execute([
			$_COOKIE['id_user'],
			$_POST['id_visitor']
		]);
		$res = $stmt->rowCount();
		if ($res) {
			echo 'ok';
		}
	}

	public function actionMore()
	{
		self::actionOnline();
		$status = Profile::setStatus();
		$user = Profile::showUser($_COOKIE['id_user']);
		$user_info = Profile::showUserInfo($_COOKIE['id_user']);
		$tag = Profile::getTagById($_COOKIE['id_user']);

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
}