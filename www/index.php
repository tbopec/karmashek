<?php
	require_once('settings.php');
	require_once("Classes/User.php");
	session_start();
	$cookie = session_id();
	$user = User::GetUserBySession($cookie);
	if ($user == null)
		header("Location: http://karmashek/Main");
	else header("Location: http://karmashek/i");
	exit;
?>