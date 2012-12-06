<?php
	require_once('settings.php');
	require_once('../Classes/User.php');
	require_once('../Classes/Session.php');
	require_once('../Classes/Util.php');
	session_start();
	$sess = session_id();
	if (isset($sess))
	{
		$s = Session::Get($sess);
		if ($s != null)
			$s->Delete();;
	}
?>