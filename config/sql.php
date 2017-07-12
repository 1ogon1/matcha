<?php

const SQL_ADD_USER = '
	INSERT INTO user (name, surname, password, email, avatar) VALUES (?, ?, ?, ?, ?)
';

const SQL_CHECK_EMAIL = '
	SELECT email FROM user WHERE email = ? 
';

const SQL_SIGN_IN = '
	SELECT * FROM user WHERE email = ?
';