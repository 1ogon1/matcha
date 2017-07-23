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
}