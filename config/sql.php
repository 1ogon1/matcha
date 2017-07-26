<?php

const SQL_CREATE_DATABASE = '
	CREATE DATABASE IF NOT EXISTS mvc_test
';

const SQL_CREATE_USER_TABLE = '
	CREATE TABLE IF NOT EXISTS user (
		id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
		login VARCHAR(100) NOT NULL,
		name VARCHAR(100) NOT NULL,
		surname VARCHAR(100) NOT NULL,
		password VARCHAR(255) NOT NULL,
		email VARCHAR(100) NOT NULL,
		avatar VARCHAR(100) NOT NULL,
		active INT(1) NOT NULL,
		gender INT(1) NOT NULL,
		info VARCHAR(255) NOT NULL,
		birthday DATE NOT NULL
		)
';

const SQL_CREATE_ACTIVATE_TABLE = '
	CREATE TABLE IF NOT EXISTS activate (
		id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
		code VARCHAR(10) NOT NULL,
		email VARCHAR(100) NOT NULL
		)
';

const SQL_ADD_USER = '
	INSERT INTO user (login, name, surname, password, email, avatar, active, gender, info, birthday) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
';

const SQL_CHECK_EMAIL = '
	SELECT email FROM user WHERE email = ? 
';

const SQL_SIGN_IN = '
	SELECT * FROM user WHERE email = ?
';

const SQL_CHECK_ACTIVE = '
	SELECT active FROM user WHERE email = ?
';

const SQL_ADD_CODE = '
	INSERT INTO activate (code, email) VALUES (?, ?)
';

const SQL_GET_EMAIL_BY_CODE = '
	SELECT email FROM activate WHERE code = ?
';

const SQL_ACIVATE_ACCOUNT = '
	UPDATE user SET active = :active WHERE email = :email
';

const SQL_SHOW_NAME = '
	SELECT * FROM user WHERE id = ?
';

const SQL_DELETE_ACTIVE_CODE = '
    DELETE FROM activate WHERE email = ?
';

const SQL_USER_UPDATE = '
	UPDATE user SET login = :login, name = :name, surname = :surname, email = :email, birthday = :birthday, info = :info  WHERE id = :id
';