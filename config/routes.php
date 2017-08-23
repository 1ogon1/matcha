<?php
return array(
	'getAddress' => 'profile/getAddress',
	'setAddress' => 'profile/setAddress',
	'checkNew' => 'message/checkNew',
	'msgNotification' => 'message/msgNotification',
	'checkmessage' => 'message/checkMessage',
	'showMessage' => 'message/showMessage',
	'sendmessage' => 'message/sendMessage',
	'message' => 'message/index',
	'changepw' => 'profile/changepw',
	'unlike' => 'profile/unlike',
	'like' => 'profile/like',
	'unblock' => 'profile/unblock',
	'block' => 'profile/block',
	'seeNew' => 'profile/seeNew',
	'delvisit' => 'profile/delvisit',
	'visitorload' => 'profile/visitorload',
	'visitor' => 'profile/visitor',
	'online' => 'profile/online',
	'delete' => 'profile/delete',
	'set' => 'profile/avatar',
	'save' => 'profile/save',
	'search' => 'search/index',
	'addtag' => 'profile/addtag',
	'deletetag' => 'profile/deletetag',
	'more' => 'profile/more',
	'settings' => 'profile/settings',
	'profile/([0-9]+)' => 'profile/index/$1',
	'activate' => 'user/activate',
	'send_code' => 'user/send_code',
	'finishpw' => 'user/finishpw',
	'reset/finish' => 'user/finish',
	'resetpw' => 'user/resetpw',
	'reset' => 'user/reset',
	'logout' => 'user/logout',
	'register' => 'user/register',
	'login' => 'user/login',
//	'.+' => 'error/index',
	'' => 'user/index',
);