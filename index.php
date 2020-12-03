<?php

include './Models/User.php';

function url($link = '') {
	$url = trim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/');

	if ($link) {
		$link = trim($link, '/');
		
		return $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['SERVER_NAME'] ."/{$url}/{$link}";
	}

	return $url;
}

$base = url();

$route = explode('/', trim(
	preg_replace("/({$base})/", '', $_SERVER['REQUEST_URI'])
	, '/')
);

$controller = (current($route) ? ucfirst(current($route)) : 'User') . 'Controller';
$method = next($route) ? current($route) : 'index';

include './Controllers/' .$controller .'.php';

$controller = new $controller;
$controller->{$method}();
