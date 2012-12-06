<?php
	require_once('settings.php');
	require_once('../Classes/Preview.php');
	if (!isset($_REQUEST['preview'])) return;
	$im = Preview::Get($_REQUEST['preview']);
	if ($im == null) return;
	header("Content-type: image/jpeg");
	print $im->Data;
?>