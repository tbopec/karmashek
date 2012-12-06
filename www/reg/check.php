<?php
require_once('settings.php');
require_once("../Classes/User.php");
require_once("../Classes/DB.php");
	$errors = "";
	$vars = array("email", "pass1", "pass2", "nick");
	foreach ($vars as $v) {
		if (!isset($_REQUEST[$v]) || strlen($_REQUEST[$v]) == 0) {
			$errors .= "notset $v/";
		}
	}
	if (strcmp($_REQUEST["pass1"], $_REQUEST["pass2"]) != 0) {
		$errors .= "notequal pass1/";
		$errors .= "notequal pass2/";
	}
	if (isset($_REQUEST["email"]) && strlen($_REQUEST["email"]) > 0) {
		$login = $_REQUEST["email"];
		$u = DB::Get("users", "`login`='$login'", array("guid"));
		if (count($u) > 0) {
			$errors .= "is email/";
		}
	}
	if (isset($_REQUEST["email"]) && strlen($_REQUEST["email"]) > 0 && !preg_match('|([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is', $_REQUEST["email"]))
		$errors .= "incorrect email/";
	if (strlen($errors) > 0)
		echo $errors;
	else {
		$u = new User();
		$u->Login = $_REQUEST["email"];
		$u->Name = $_REQUEST["nick"];
		$u->Password = md5($_REQUEST["pass1"]);
		$u->Save();
		$u->StartSession();
	}
?>