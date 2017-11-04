<?php
if (!defined('BLARG')) die();
// Catchall page, for legacy blargboard pages

// Set the page and id, as REQUEST
$_REQUEST['page'] = $pageParams['page'];

if (isset($pageParams['id']))
	$_REQUEST['id'] = $pageParams['id'];

if (isset($pageParams['name']))
	$_REQUEST['name'] = $pageParams['name'];

// Set the page, in both POST and GET when required
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$_POST['page'] = $pageParams['page'];

	if (isset($pageParams['id']))
		$_POST['id'] = $pageParams['id'];

	if (isset($pageParams['name']))
		$_POST['name'] = $pageParams['name'];
} else {
	$_GET['page'] = $pageParams['page'];

	if (isset($pageParams['id']))
		$_GET['id'] = $pageParams['id'];

	if (isset($pageParams['name']))
		$_GET['name'] = $pageParams['name'];
}

$fallbackPage = __DIR__ . '/' . $pageParams['page'] . '.php';

if (file_exists($fallbackPage)) {
	require_once($fallbackPage);
} else {
	 throw new Exception(404);
}

