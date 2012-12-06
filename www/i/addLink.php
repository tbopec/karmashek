<?php
	require_once('settings.php');
	require_once("../Classes/User.php");
	require_once("../Classes/Session.php");
	require_once("../Classes/Util.php");
	require_once("../Classes/Link.php");
	session_start();
	$cookie = session_id();
	$user = User::GetUserBySession($cookie);
	$site = $_REQUEST['name'];
	$info = $_REQUEST['info'];
	if (substr($site, 0, 4) != "http")
		$site = "http://$site";
	$valid = check_url($site);
	if (isset($site) && isset($info)) {
		if ($valid)
		{
			$cnt = @file_get_contents("http://www.bitpixels.com/getthumbnail?size=200&url=$site&code=38196");
			Link::Create($_REQUEST["parent"], $user->Guid, $site, $info, $cnt);
			exit;
		}
	}
function check_url($url)
{
	$output = @get_headers($url);
	return $output ? true : false;
}
?>
<script type="text/javascript" src="./js/jquery/ajaxForm.js"></script>
<link rel="stylesheet" type="text/css" href="./css/add.css" title="" media="screen" />	
<form action="addLink.php" id="adding">
		<input type="hidden" name="parent" value="<?= $_REQUEST["id"] ?>"></input>
		<div class="registration_header">
			<div class="add_text">
				Добавление ссылки
			</div>			
			<div class="table_border">
			</div>	
		</div>

		<div class="registration_form_item margin_b">
			<div class="form_label name_text">
				Ссылка
			</div>
			<div class="form_item_content">
				<input type="text" class="my_input" name="name"></input>
			</div>					
		</div>
		<div class="registration_form_item margin_l">
			<div class="form_label info_text">
				Информация
			</div>
			<div class="clear"></div>
			<div class="form_item_content">
				<input name = "info" class="my_input" type="text"></input>					
			</div>
		</div>
		<div class="add_button">
		</div>
	</div>
</form>
<script>
	$("#adding").ajaxForm(function(data) {
		location = "http://karmashek/i"
	});
	$(".add_button").click(function() {
		$("#adding").submit();
	});
</script>