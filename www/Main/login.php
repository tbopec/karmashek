<?php
	require_once('settings.php');
	require_once("../Classes/User.php");
	require_once("../Classes/Session.php");
	require_once("../Classes/Util.php");
	require_once("../Classes/Link.php");
	session_start();
	$cookie = session_id();
	if (isset($_REQUEST['login']) && isset($_REQUEST['password']))
	{
		$user = User::GetByLoginPass($_REQUEST['login'], $_REQUEST['password']);
		if ($user == null) {
			echo "-";
			exit;
		}
		else {
			$user->StartSession();
		}
	}
?>