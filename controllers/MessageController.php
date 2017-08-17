<?php

require_once(ROOT . '/models/Profile.php');
require_once(ROOT . '/models/Message.php');
require_once(ROOT . '/models/User.php');
require_once(ROOT . '/config/sql.php');

class MessageController
{
	public function actionIndex()
	{
		Profile::setOnline();
		$status = Profile::setStatus();
		$users = Message::getUsers();
		$newMessage = 0;

		require_once ROOT . '/views/message/message.php';
		return true;
	}

	public function actionSendMessage()
	{
		$pdo = DataBase::getConnection();

		$mess = htmlspecialchars($_POST['msg']);
		$stmt = $pdo->prepare(SQL_ADD_MESSAGE);
		$stmt->execute([
			$_COOKIE['id_user'],
			$_POST['id'],
			$mess,
			$_POST['date'],
			0
		]);

		$sql = "SELECT * FROM user WHERE id = :id";
		$info = $pdo->prepare($sql);
		$info->bindParam(':id', $_COOKIE['id_user'], PDO::PARAM_INT);
		$info->execute();
		$id_user = $info->fetchAll(PDO::FETCH_ASSOC);

		foreach ($id_user as $rrr) {
			echo '<div class="media msg">' .
				'<a class="pull-left" href="/profile/' . $rrr['id'] . '">' .
				'<img class="media-object" data-src="holder.js/64x64" alt="64x64" src="' . $rrr['avatar'] . '">' .
				'</a>' .
				'<div class="media-body">' .
				'<small class="pull-right time"><i class="fa fa-clock-o"></i>' . $_POST['date'] . '</small>' .
				'<h5 class="media-heading">' . $rrr['login'] . '</h5>' .
				'<small class="col-lg-10">' . $mess . '</small>' .
				'</div>' .
				'</div>';
		}
	}

	public function actionShowMessage()
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_GET_MESSAGE);
		$stmt->execute([
			$_COOKIE['id_user'],
			$_POST['id'],
			$_POST['id'],
			$_COOKIE['id_user']
		]);
		if ($stmt->rowCount()) {
			$st = $pdo->prepare(SQL_SEE_MESSAGE);
			$st->execute([
				':id_sec_user' => $_COOKIE['id_user'],
				':id_user' => $_POST['id']
			]);

			$sql = "SELECT * FROM user WHERE id = :id";
			$info = $pdo->prepare($sql);
			$info->bindParam(':id', $_COOKIE['id_user'], PDO::PARAM_INT);
			$info->execute();
			$id_user = $info->fetchAll(PDO::FETCH_ASSOC);

			$sql = "SELECT * FROM user WHERE id = :id";
			$info = $pdo->prepare($sql);
			$info->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
			$info->execute();
			$id_sec = $info->fetchAll();

			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($res as $row) {
				foreach ($id_user as $rrr) {
					if ($row['id_user'] == $rrr['id']) {
						echo '<div class="media msg">' .
							'<a class="pull-left" href="/profile/' . $rrr['id'] . '">' .
							'<img class="media-object" data-src="holder.js/64x64" alt="64x64" src="' . $rrr['avatar'] . '">' .
							'</a>' .
							'<div class="media-body">' .
							'<small class="pull-right time"><i class="fa fa-clock-o"></i>' . $row['time'] . '</small>' .
							'<h5 class="media-heading">' . $rrr['login'] . '</h5>' .
							'<small class="col-lg-10">' . $row['msg'] . '</small>' .
							'</div>' .
							'</div>';
					}
				}
				foreach ($id_sec as $rrrr) {
					if ($row['id_user'] == $rrrr['id']) {
						echo '<div class="media msg">' .
							'<a class="pull-left" href="/profile/' . $rrrr['id'] . '">' .
							'<img class="media-object" data-src="holder.js/64x64" alt="64x64" src="' . $rrrr['avatar'] . '">' .
							'</a>' .
							'<div class="media-body">' .
							'<small class="pull-right time"><i class="fa fa-clock-o"></i>' . $row['time'] . '</small>' .
							'<h5 class="media-heading">' . $rrrr['login'] . '</h5>' .
							'<small class="col-lg-10">' . $row['msg'] . '</small>' .
							'</div>' .
							'</div>';
					}
				}
			}
		} else {
		}
	}

	public function actionCheckMessage()
	{
		$pdo = DataBase::getConnection();

		$stmt = $pdo->prepare(SQL_CHECK_MSG);
		$stmt->execute([
			$_POST['id'],
			$_COOKIE['id_user']
		]);
		if ($stmt->rowCount()) {
			$st = $pdo->prepare(SQL_SEE_MESSAGE);
			$st->execute([
				':id_sec_user' => $_COOKIE['id_user'],
				':id_user' => $_POST['id']
			]);

			$sql = "SELECT * FROM user WHERE id = :id";
			$info = $pdo->prepare($sql);
			$info->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
			$info->execute();
			$id_sec = $info->fetchAll();

			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($res as $row) {
				foreach ($id_sec as $rrr) {
					echo '<div class="media msg">' .
						'<a class="pull-left" href="/profile/' . $rrr['id'] . '">' .
						'<img class="media-object" data-src="holder.js/64x64" alt="64x64" src="' . $rrr['avatar'] . '">' .
						'</a>' .
						'<div class="media-body">' .
						'<small class="pull-right time"><i class="fa fa-clock-o"></i>' . $row['time'] . '</small>' .
						'<h5 class="media-heading">' . $rrr['login'] . '</h5>' .
						'<small class="col-lg-10">' . $row['msg'] . '</small>' .
						'</div>' .
						'</div>';
				}
			}
		}
	}

	public function actionMsgNotification()
	{
		echo Message::newMessage();
	}

	public function actionCheckNew()
	{
		$pdo = DataBase::getConnection();

		$array = array();
		$stmt = $pdo->prepare("SELECT id_user FROM message WHERE id_sec_user = ? AND status = 0 GROUP BY id_user");
		$stmt->execute([$_COOKIE['id_user']]);
		if ($stmt->rowCount()) {
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($res as $row) {
				$st = $pdo->prepare("SELECT * FROM MESSAGE WHERE id_user = ? AND id_sec_user = ? AND status = 0");
				$st->execute([
					$row['id_user'],
					$_COOKIE['id_user']
				]);
				$array['id'] = $row['id_user'];
				$array['count'] = $st->rowCount();
				echo json_encode($array);
			}
		}
	}
}