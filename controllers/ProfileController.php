<?php

require_once (ROOT.'/models/Profile.php');
require_once (ROOT.'/models/User.php');
require_once(ROOT . '/config/sql.php');

class ProfileController
{
    public function actionIndex($id)
    {
		$user = Profile::showUser($id);
		$status = Profile::setStatus();
        $userStatus = Profile::userStatus($id);

        if ($id != $_COOKIE['id_user']) {
            Profile::addVisitor($id, $_COOKIE['id_user']);
        }

        require_once (ROOT.'/views/profile/index.php');
        return true;
    }

    public function actionSettings()
	{
	    $personal_info = null;
	    $user = Profile::showUser($_COOKIE['id_user']);
	    $photo = Profile::showUserImage();
        $status = Profile::setStatus();

	    if (isset($_POST['upload'])) {
            $dir = '/template/foto/';
            $file = $dir . basename($_FILES['file']['name']);
            $dir2 = ROOT.'/template/foto/';
            $file2 = $dir2 . basename($_FILES['file']['name']);
            if ((($_FILES['file']['type'] == "image/png") ||
                    ($_FILES['file']['type'] == "image/jpg") ||
                    ($_FILES['file']['type'] == "image/jpeg"))) {
                if (copy($_FILES['file']['tmp_name'], $file2)) {
                    Profile::saveUserPhoto($_FILES['file']['name'], $file);
//                    echo $dir;
                    header('location:/settings');
                }
            } else {
                echo 'error file';
            }
        }

		require_once (ROOT.'/views/profile/settings.php');
		return true;
	}

	public function actionSave()
	{
	    $user = [
	        'login' => $_POST['login'],
            'name' => $_POST['name'],
            'surname' => $_POST['surname'],
            'email' => $_POST['email'],
            'gender' => $_POST['gender'],
            'sex_pref' => $_POST['sex_pref'],
            'biography' => $_POST['biography'],
            'address' => $_POST['address'],
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
            unlink(ROOT.$_POST['src']);
        }// else {
//            echo 'Сталась помилка';
//        }
    }

    public function actionOnline()
    {
        $pdo = DataBase::getConnection();

        $stmt = $pdo->prepare(SQL_SET_ONLINE);
        $stmt->execute([
            ':id' => $_COOKIE['id_user'],
            ':status' => $_POST['time']
        ]);
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
                    echo '<div class="user"><a href="/profile/'.$rows['id'].'"><img src="'.$rows['avatar'].'">'.
                        $rows['login'].
                        '</a></div>';
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
//                    echo '<div class="user" data-text="'.$rows['id'].'"><a href="/profile/'.$rows['id'].'"><img src="'.$rows['avatar'].'">'.
//                         $rows['login'].
//                         '</a></div>';
                    echo '<div class="user" data-text="'.$rows['id'].'"><a href="/profile/'.$rows['id'].'" name="'.$rows['id'].'"><img src="'.$rows['avatar'].'">'.
                        $rows['login'].
                        '</a></div>';
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
            $_COOKIE['id_user']
        ]);
        $res = $stmt->rowCount();
        if ($res) {
            echo 'ok';
        }
    }

    public function actionMore()
    {
        $status = Profile::setStatus();
        $user = Profile::showUser($_COOKIE['id_user']);
        $user_info = Profile::showUserInfo($_COOKIE['id_user']);
        $tag = Profile::getTagById($_COOKIE['id_user']);

        require_once ROOT.'/views/profile/more_settings.php';
        return true;
    }

    public function actionAddtag()
    {
        $pdo = DataBase::getConnection();

        $stmt = $pdo->prepare(SQL_ADD_TAG);
        $stmt->execute([
            $_COOKIE['id_user'],
            $_POST['tag']
        ]);
        $id = $pdo->lastInsertId();
        echo '<li class="tag_gel" value="'.$id.'"><a>#'.$_POST['tag'].'</a></li>';
    }

    public function actionDeletetag()
    {
        $pdo = DataBase::getConnection();

        $stmt = $pdo->prepare(SQL_DELETE_TAG_BY_ID);
        $stmt->execute([$_POST['tag']]);
//        echo $stmt->rowCount();
    }
}