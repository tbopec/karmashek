<?php
	require_once('settings.php');
	require_once("../Classes/User.php");
	require_once("../Classes/Session.php");
	require_once("../Classes/Util.php");
	require_once("../Classes/Link.php");
	header('Content-type: text/html; charset=utf-8');
	session_start();
	$cookie = session_id();
	$user = User::GetUserBySession($cookie);
	$l = Link::Get($_REQUEST['id']);
	if ($l != null) {
		$l->Delete();
	}
?>