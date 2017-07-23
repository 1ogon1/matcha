<?php
return array(
	'geolocation' => 'profile/test',
	'settings' => 'profile/settings',
    'profile/([0-9]+)' => 'profile/index/$1',
	'activate' => 'user/activate',
	'logout' => 'user/logout',
	'' => 'user/login',
);