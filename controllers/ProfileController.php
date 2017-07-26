<?php

require_once (ROOT.'/models/Profile.php');
require_once (ROOT.'/models/User.php');
require_once (ROOT.'/config/sql.php');

class ProfileController
{
    public function actionIndex($id)
    {
		$user = Profile::showUser($id);
        require_once (ROOT.'/views/profile/index.php');
        return true;
    }

    public function actionSettings()
	{
	    $personal_info = null;
	    $user = Profile::showUser($_COOKIE['id_user']);

	    if (isset($_POST['upload'])) {
            $dir = ROOT.'/template/foto/';
            $file = $dir . basename($_FILES['file']['name']);
            if ((($_FILES['file']['type'] == "image/png") ||
                    ($_FILES['file']['type'] == "image/jpg") ||
                    ($_FILES['file']['type'] == "image/jpeg"))) {
                if (copy($_FILES['file']['tmp_name'], $file)) {
                    echo 'ok';
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
            'birthday' => $_POST['birthday'],
            'info' => $_POST['info']
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
        } else {
	        echo array_shift($errors);
        }
//        require_once (ROOT.'/views/profile/settings.php');
		return true;
	}
}