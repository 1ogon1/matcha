<?php
return array(
    'save' => 'profile/save',
	'search' => 'search/index',
	'settings' => 'profile/settings',
    'profile/([0-9]+)' => 'profile/index/$1',
	'activate' => 'user/activate',
	'send_code' => 'user/send_code',
	'logout' => 'user/logout',
	'register' => 'user/register',
	'login' => 'user/login',
	'' => 'user/index',
);