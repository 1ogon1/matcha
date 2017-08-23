<?php

const SQL_CREATE_DATABASE = '
	CREATE DATABASE IF NOT EXISTS mvc_test
';

//CREATE TABLE

const SQL_CREATE_USER_TABLE = '
	CREATE TABLE IF NOT EXISTS `user` (
		id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
		login VARCHAR(100) NOT NULL,
		name VARCHAR(100) NOT NULL,
		surname VARCHAR(100) NOT NULL,
		password VARCHAR(255) NOT NULL,
		email VARCHAR(100) NOT NULL,
		avatar VARCHAR(100) NOT NULL,
		active INT(1) NOT NULL,
        status INT(11)
		)
';

const SQL_CREATE_TABLE_USER_INFO = '
    CREATE TABLE IF NOT EXISTS user_info (
        id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
        id_user INT(10) NOT NULL,
        gender INT(1) NOT NULL,
        sex_pref INT(1) NOT NULL,
        biography TEXT NOT NULL,
        birthday DATE NOT NULL,
        lat DOUBLE,
        lng DOUBLE
    )
';

const SQL_CREATE_ACTIVATE_TABLE = '
	CREATE TABLE IF NOT EXISTS activate (
		id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
		code VARCHAR(10) NOT NULL,
		email VARCHAR(100) NOT NULL
		)
';

const SQL_CREATE_TABLE_IMAGE = '
    CREATE TABLE IF NOT EXISTS image (
        id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
        id_user INT(10) NOT NULL,
        name_img TEXT NOT NULL,
        src TEXT NOT NULL
    )
';

const SQL_CREATE_TABLE_VISITOR = '
    CREATE TABLE IF NOT EXISTS visitor (
        id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
        id_user INT(10) NOT NULL,
        id_visitor INT(10) NOT NULL,
        status INT(1) NOT NULL
    )
';

const SQL_CREATE_TABLE_TAG = '
    CREATE TABLE IF NOT EXISTS tag (
        id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
        id_user INT(10) NOT NULL,
        tag VARCHAR(255) NOT NULL
    )
';

const SQL_CREATE_TABLE_BLOCK_USER = '
	CREATE TABLE IF NOT EXISTS block (
		id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
		id_user INT(10) NOT NULL,
        id_block_user INT(10) NOT NULL
	)
';

const SQL_CREATE_TABLE_LIKE_USER = '
	CREATE TABLE IF NOT EXISTS likes (
		id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
		id_user INT(10) NOT NULL,
        id_like_user INT(10) NOT NULL
	)
';

const SQL_CREATE_TABLE_CHAT = '
	CREATE TABLE IF NOT EXISTS message (
		id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
		id_user INT(10) NOT NULL,
		id_sec_user INT(10) NOT NULL,
		msg VARCHAR(255) NOT NULL,
		status INT (2) NOT NULL 
	)
';

//OTHER QWERTY

const SQL_ADD_USER = '
	INSERT INTO user (login, name, surname, password, email, avatar, active, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
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
	UPDATE user SET login = :login, name = :name, surname = :surname, email = :email  WHERE id = :id
';

const SQL_USER_UPDATE_INFO = '
    UPDATE user_info SET gender = :gender, sex_pref = :sex_pref, biography = :biography, birthday = :birthday WHERE id_user = :id_user
';

const SQL_ADD_IMAGE = '
    INSERT INTO image (id_user, name_img, src) VALUES (?, ?, ?)
';

const SQL_SHOW_USER_IMAGE = '
    SELECT * FROM image WHERE id_user = ?
';

const SQL_UPDATE_AVATAR = '
    UPDATE user SET avatar = :avatar WHERE id = :id
';

const SQL_DELETE_IMAGE = '
    DELETE FROM image WHERE id = ?
';

const SQL_SET_ONLINE = '
    UPDATE user SET status = :status WHERE id = :id
';

const SQL_GET_STATUS = '
    SELECT status FROM user WHERE id = ?
';

const SQL_ADD_VISITOR = '
    INSERT INTO visitor (id_user, id_visitor, type, status) VALUES (?, ?, ?, ?)
';

const SQL_GET_VISITOR = '
    SELECT * FROM visitor WHERE id_user = ? ORDER BY id DESC 
';

const SQL_GET_VISITOR_LOAD = '
    SELECT * FROM visitor WHERE id_user = ? ORDER BY id DESC 
';

const SQL_GET_VISITOR_CHECK = '
    SELECT * FROM visitor WHERE id_user = ? AND id_visitor = ? 
';

const SQL_SEW_VISITOR = '
    UPDATE visitor SET status = :status WHERE id_user = :id_user
';

const SQL_DELETE_VISITOR = '
    DELETE FROM visitor WHERE id_user = ? AND id_visitor = ?
';

const SQL_ADD_INFO = '
    INSERT INTO user_info (id, id_user, gender, sex_pref, biography, birthday, lat, lng) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
';

const SELECT_USER_INFO = '
    SELECT * FROM user_info WHERE id_user = ?
';

const SQL_ADD_TAG = '
    INSERT INTO tag (id_user, tag) VALUES (?, ?)
';

const SQL_GET_TAG_BY_ID = '
    SELECT * FROM tag WHERE id_user = ?
';

const SQL_DELETE_TAG_BY_ID = '
    DELETE FROM tag WHERE id = ? 
';

const SQL_GET_TAG_BY_NAME = '
	SELECT * FROM tag  WHERE tag = ? AND id_user = ?
';

const SQL_GET_BLOCK = '
	SELECT * FROM block WHERE id_user = ? AND id_block_user = ? 
';

const SQL_BLOCK_USER = '
	INSERT INTO block (id_user, id_block_user) VALUES (?, ?)
';

const SQL_UNBLOCK_USER = '
	DELETE FROM block WHERE id_user = ? AND id_block_user = ?
';

const SQL_GET_LIKE = '
	SELECT * FROM likes WHERE id_user = ? AND id_like_user = ?
';

const SQL_LIKE_USER = '
	INSERT INTO likes (id_user, id_like_user) VALUES (?, ?)
';

const SQL_UNLIKE_USER = '
	DELETE FROM likes WHERE id_user = ? AND id_like_user = ?
';

const SQL_CHANGE_PASSWORD = '
	UPDATE user SET password = :password WHERE id = :id
';

const SQL_CHANGE_PASSWORD_BY_EMAIL = '
	UPDATE user SET password = :password WHERE email = :email
';

const SQL_CHECK_DATA = '
	SELECT * FROM activate WHERE code = ? AND email = ?
';

const SQL_ADD_MESSAGE = '
	INSERT INTO message (id_user, id_sec_user, msg, time, status) VALUES (?, ?, ?, ?, ?)
';

const SQL_GET_MESSAGE = '
	SELECT * FROM message WHERE id_user = ? AND id_sec_user = ? OR id_user = ? AND id_sec_user = ? ORDER BY id DESC 
';

const SQL_SEE_MESSAGE = '
	UPDATE message SET status = 1 WHERE id_sec_user = :id_sec_user AND id_user = :id_user
';

const SQL_CHECK_MSG = '
	SELECT * FROM message WHERE id_user = ? AND id_sec_user = ? AND status = 0
';

const SQL_GET_LAST_MESSAGE_BY_ID = '
	SELECT msg FROM message WHERE id_user = ? AND id_sec_user = ? OR id_user = ? AND id_sec_user = ? ORDER BY id DESC LIMIT 1
';