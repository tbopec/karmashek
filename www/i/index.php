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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>

	<META NAME="Keywords" CONTENT="karmashek, кармашек" />
	<META NAME="Description" CONTENT="KARMASHEK: Сервис для хранения списков ссылок" />
	<title>KARMASHEK</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<link rel="stylesheet" type="text/css" href="./css/main.css" title="" media="screen" />	
	
	
	<script type="text/javascript" src="./js/jquery/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="./js/main.js"></script>
	<script>
		$(function() {
			init("<?= $user->Guid?>");
		});
	</script>
	<link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAFk3UAB6B/AAakggAFp4UA8/PzAAiwjSQJyJ//Cdqt/wjLov8Hr4x48/PzAPPz8wD+/v4A////AP///wAAAAAAA5FzAP///wD///8ABaeFgQnNo/8NqZH/EuLE/xLevv8P4sT/DaqT/wnNo/8GqIXn////AP///wD///8AAAAAAAaUdgAGn35FB7+X/wyrk/8T1LX/EtW1/xLWtf8S17X/Ete2/xDVtP8V1bb/DamS/wa8lf8FmntU/v7+AAAAAAAFk3WEC7uX/w7Jq/8Ryqr/Esuq/w/Lqf8Py6n/Dsup/wvLqf8Py6r/EMqp/xHIqP8Syar/Cq+P/wWSdIQAAAAABqOC/wu9nv8Ov5//DL6e/w6/nv8Jvpz/DcGd/wrBnf8KwZ7/DcGe/w7Anv8Lvp3/DL2e/xG9oP8HpIL/AAAAAASdff8LtZb/CrSU/wq1lP8JtZL/B7WR/we2kf8HtpL/BraR/we0kP8ItJH/CrSS/wu1lf8Ls5X/BqB//wAAAAAGm3z/C66O/waphv8Gq4j/B66L/wavjP8Iso7/CLOP/weyjv8Hr4z/B62K/waph/8FpoT/CamK/wWae/8AAAAABJZ3/waigP8Eo4H/BaeF/wesif8Hr4z/B66K/weohv8Ir4z/B6+M/wariP8GpoT/BqKB/wScfP8Fl3j/AAAAAAeUd/8EfWP/BH5k/wWCaP8Hhmv/BW9c/wIeXv8FKn7/Ah5d/wRuW/8FhWr/BYBm/wR8Y/8Fe2L/BI9y/wAAAAAEjG3/CqiE/wiphP8IqYT/CqmE/wYwj/8PO5//Ah5d/w87n/8GMI//CKeC/wiphP8Kq4b/CquG/wOGaP8AAAAABbOP/we1kf8Fs4//CbeT/wjGpP8HN6b/BREs/wovZv8HFTT/Bzem/wbEo/8Jt5P/B7WR/we1kf8Fs4//AAAAAAnGpP8HxKL/B8Si/wfEov8HxKL/CEC//w0VHP8CFkT/Cg4Q/whAv/8HxKL/BcKg/wfEov8HxKL/Ccak/wAAAAAE0bL/CNW2/wbTtP8I1bb/BtO0/wlH1v8JRtT/AQ0q/wlH1v8JR9b/BNGy/wTRsv8I1bb/CNW2/wbTtP8AAAAABePF/wXjxf8D4cP/BePF/wflx/8F48X/Ck3n/wpN5/8KT+f/BePF/wXjxf8D4cP/BePF/wXjxf8H5cf/AAAAAALu0/8E8NX/BPDV/wTw1f8C7tP/BvLX/wTw1f8E8NX/BPDV/wby1/8G8tf/BPDV/wTw1f8E8NX/BvLX/wAAAAAD48b/A9a//wT64P8C0Lr/BdO+/wb84v8C0Lr/A9K8/wL43v8C0Lr/AtC6/wL43v8D0rz/Avje/wXQs8cAAAAA/H8AAOAPAADABwAAAAEAAAABAAAAAQAAAAEAAAABAAAAAQAAAAEAAAABAAAAAQAAAAEAAAABAAAAAQAAAAEAAA==" rel="icon" type="image/vnd.microsoft.icon" />
	<link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAFk3UAB6B/AAakggAFp4UA8/PzAAiwjSQJyJ//Cdqt/wjLov8Hr4x48/PzAPPz8wD+/v4A////AP///wAAAAAAA5FzAP///wD///8ABaeFgQnNo/8NqZH/EuLE/xLevv8P4sT/DaqT/wnNo/8GqIXn////AP///wD///8AAAAAAAaUdgAGn35FB7+X/wyrk/8T1LX/EtW1/xLWtf8S17X/Ete2/xDVtP8V1bb/DamS/wa8lf8FmntU/v7+AAAAAAAFk3WEC7uX/w7Jq/8Ryqr/Esuq/w/Lqf8Py6n/Dsup/wvLqf8Py6r/EMqp/xHIqP8Syar/Cq+P/wWSdIQAAAAABqOC/wu9nv8Ov5//DL6e/w6/nv8Jvpz/DcGd/wrBnf8KwZ7/DcGe/w7Anv8Lvp3/DL2e/xG9oP8HpIL/AAAAAASdff8LtZb/CrSU/wq1lP8JtZL/B7WR/we2kf8HtpL/BraR/we0kP8ItJH/CrSS/wu1lf8Ls5X/BqB//wAAAAAGm3z/C66O/waphv8Gq4j/B66L/wavjP8Iso7/CLOP/weyjv8Hr4z/B62K/waph/8FpoT/CamK/wWae/8AAAAABJZ3/waigP8Eo4H/BaeF/wesif8Hr4z/B66K/weohv8Ir4z/B6+M/wariP8GpoT/BqKB/wScfP8Fl3j/AAAAAAeUd/8EfWP/BH5k/wWCaP8Hhmv/BW9c/wIeXv8FKn7/Ah5d/wRuW/8FhWr/BYBm/wR8Y/8Fe2L/BI9y/wAAAAAEjG3/CqiE/wiphP8IqYT/CqmE/wYwj/8PO5//Ah5d/w87n/8GMI//CKeC/wiphP8Kq4b/CquG/wOGaP8AAAAABbOP/we1kf8Fs4//CbeT/wjGpP8HN6b/BREs/wovZv8HFTT/Bzem/wbEo/8Jt5P/B7WR/we1kf8Fs4//AAAAAAnGpP8HxKL/B8Si/wfEov8HxKL/CEC//w0VHP8CFkT/Cg4Q/whAv/8HxKL/BcKg/wfEov8HxKL/Ccak/wAAAAAE0bL/CNW2/wbTtP8I1bb/BtO0/wlH1v8JRtT/AQ0q/wlH1v8JR9b/BNGy/wTRsv8I1bb/CNW2/wbTtP8AAAAABePF/wXjxf8D4cP/BePF/wflx/8F48X/Ck3n/wpN5/8KT+f/BePF/wXjxf8D4cP/BePF/wXjxf8H5cf/AAAAAALu0/8E8NX/BPDV/wTw1f8C7tP/BvLX/wTw1f8E8NX/BPDV/wby1/8G8tf/BPDV/wTw1f8E8NX/BvLX/wAAAAAD48b/A9a//wT64P8C0Lr/BdO+/wb84v8C0Lr/A9K8/wL43v8C0Lr/AtC6/wL43v8D0rz/Avje/wXQs8cAAAAA/H8AAOAPAADABwAAAAEAAAABAAAAAQAAAAEAAAABAAAAAQAAAAEAAAABAAAAAQAAAAEAAAABAAAAAQAAAAEAAA==" rel="shortcut icon" type="image/vnd.microsoft.icon" />	
</head>
<body>
	<div class="wrapper">
		<div class="header_wrapper">
			<div class="header">
				<div class="logo float-left">
				</div>
				<div class="user_area float-right">
					<div class="green_arrow float-right">
					</div>
					<div class="user_name float-right">
						<?=$user->Name?>
					</div>	
				</div>
			</div>
		</div>
		<div class="navigation_wrapper">
			<div class="navigation">
				<div class="in_my_pocket float-left">
				</div>
				<div class="menu float-right">
					<div class="menu_column float-right">
						<div class="menu_item menu_delete float-right">
						</div>
						<div class="clear"></div>						
						<div class="menu_text float-right">
						Удалить
						</div>
					</div>
					<div class="menu_column float-right">
						<div class="menu_item menu_share float-right">
						</div>
						<div class="clear"></div>						
						<div class="menu_text float-right">
						
						</div>						
					</div>
					<div class="menu_column float-right">
						<div class="menu_item menu_just_folder float-right">
						</div>
					</div>
					<div class="menu_column float-right">
						<div class="menu_item menu_add_folder float-right">
						</div>
					</div>
					<div class="menu_column float-right">
						<div class="menu_item menu_add float-right">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="table_wrapper">
			<div class="table">
				<div class="table_row table_row_not_hovered">
					<div class="checkbox_column float-left">
						<div class="styled_checkbox float-left" sel="no">
							<div class="styled_checkbox_not_selected">
							</div>
							<div class="styled_checkbox_selected" style="display: none">
							</div>														
						</div>
					</div>
					<div class="pic_column float-left">
						<div class="pic_folder">
						</div>
					</div>
					<div class="caption_column float-left">
						Блоги о дизайне
					</div>
					<div class="desc_column float-left">
						Сайты, посвященные дизайну, искусству и графике
					</div>
					<div class="add_info_column float-left">
						5 сайтов
					</div>
					<div class="controls_column float-left">
						<div class="edit_control float-left">
						</div>
						<div class="delete_control float-left">
						</div>
					</div>					
				</div>
				<div class="table_border"></div>
				<div class="clear"></div>
				<div class="table_row table_row_not_hovered">
					<div class="checkbox_column float-left">
						<div class="styled_checkbox float-left" sel="no">
							<div class="styled_checkbox_not_selected">
							</div>
							<div class="styled_checkbox_selected" style="display: none">
							</div>														
						</div>
					</div>
					<div class="pic_column float-left">
						<div class="pic_folder">
						</div>
					</div>
					<div class="caption_column float-left">
						Блоги о дизайне
					</div>
					<div class="desc_column float-left">
						Сайты, посвященные дизайну, искусству и графике
					</div>
					<div class="add_info_column float-left">
						5 сайтов
					</div>
					<div class="controls_column float-left">
						<div class="edit_control float-left">
						</div>
						<div class="delete_control float-left">
						</div>
					</div>					
				</div>			
				<div class="table_border"></div>	
				<div class="clear"></div>
				<div class="table_row table_row_not_hovered">
					<div class="checkbox_column float-left">
						<div class="styled_checkbox float-left" sel="no">
							<div class="styled_checkbox_not_selected">
							</div>
							<div class="styled_checkbox_selected" style="display: none">
							</div>														
						</div>
					</div>
					<div class="pic_column float-left">
						<div class="pic_folder">
						</div>
					</div>
					<div class="caption_column float-left">
						Блоги о дизайне
					</div>
					<div class="desc_column float-left">
						Сайты, посвященные дизайну, искусству и графике
					</div>
					<div class="add_info_column float-left">
						5 сайтов
					</div>
					<div class="controls_column float-left">
						<div class="edit_control float-left">
						</div>
						<div class="delete_control float-left">
						</div>
					</div>					
				</div>				
				<div class="table_border"></div>				
				<div class="clear"></div>
				<div class="table_row table_row_not_hovered">					
					<div class="checkbox_column float-left">
						<div class="styled_checkbox float-left" sel="no">
							<div class="styled_checkbox_not_selected">
							</div>
							<div class="styled_checkbox_selected" style="display: none">
							</div>														
						</div>
					</div>
					<div class="pic_column float-left">
						<div class="pic_folder">
						</div>
					</div>
					<div class="caption_column float-left">
						Блоги о дизайне
					</div>
					<div class="desc_column float-left">
						Сайты, посвященные дизайну, искусству и графике
					</div>
					<div class="add_info_column float-left">
						5 сайтов
					</div>
					<div class="controls_column float-left">
						<div class="edit_control float-left">
						</div>
						<div class="delete_control float-left">
						</div>
						<div class="clear"></div>
					</div>						
				</div>	
				<div class="table_border"></div>	
				<div class="clear"></div>
				<div class="table_row table_row_not_hovered">
					<div class="checkbox_column float-left">
						<div class="styled_checkbox float-left" sel="no">
							<div class="styled_checkbox_not_selected">
							</div>
							<div class="styled_checkbox_selected" style="display: none">
							</div>														
						</div>
					</div>
					<div class="pic_column float-left">
						<div class="pic_preview">
							<div class="pic_preview_image">								
							</div>
						</div>
					</div>
					<div class="caption_column float-left">
						<span class="mylink">www.pickerlab.com</span>
					</div>
					<div class="desc_column float-left">
						Блог о дизайне и мое личное портфолио. Поиск. Главное меню. Перейти к основному содержимому. Перейти к...
					</div>
					<div class="add_info_column float-left">
						09.05.2012
					</div>
					<div class="controls_column float-left">
						<div class="edit_control float-left">
						</div>
						<div class="delete_control float-left">
						</div>
					</div>
				</div>	
				<div class="table_border"></div>
				<div class="clear"></div>
				<div class="table_row table_row_not_hovered">
					<div class="checkbox_column float-left">
						<div class="styled_checkbox float-left" sel="no">
							<div class="styled_checkbox_not_selected">
							</div>
							<div class="styled_checkbox_selected" style="display: none">
							</div>														
						</div>
					</div>
					<div class="pic_column float-left">
						<div class="pic_preview">
							<div class="pic_preview_image">								
							</div>
						</div>
					</div>
					<div class="caption_column float-left">
						<span class="mylink">www.pickerlab.com</span>
					</div>
					<div class="desc_column float-left">
						Блог о дизайне и мое личное портфолио. Поиск. Главное меню. Перейти к основному содержимому. Перейти к...
					</div>
					<div class="add_info_column float-left">
						09.05.2012
					</div>
					<div class="controls_column float-left">
						<div class="edit_control float-left">
						</div>
						<div class="delete_control float-left">
						</div>
					</div>
				</div>	
				<div class="table_border"></div>		
				<div class="clear"></div>
				<div class="table_row table_row_not_hovered">
					<div class="checkbox_column float-left">
						<div class="styled_checkbox float-left" sel="no">
							<div class="styled_checkbox_not_selected">
							</div>
							<div class="styled_checkbox_selected" style="display: none">
							</div>														
						</div>
					</div>
					<div class="pic_column float-left">
						<div class="pic_preview">
							<div class="pic_preview_image">								
							</div>
						</div>
					</div>
					<div class="caption_column float-left">
						<span class="mylink">www.pickerlab.com</span>
					</div>
					<div class="desc_column float-left">
						Блог о дизайне и мое личное портфолио. Поиск. Главное меню. Перейти к основному содержимому. Перейти к...
					</div>
					<div class="add_info_column float-left">
						09.05.2012
					</div>
					<div class="controls_column float-left">
						<div class="edit_control float-left">
						</div>
						<div class="delete_control float-left">
						</div>
					</div>
				</div>	
				<div class="table_border"></div>
				<div class="clear"></div>				
			</div>
		</div>
		<div class="table_bottom">
		</div>
		<div id="empty">&nbsp;</div>		
		<div class="footer">
			<div class="footer_copyright float-left">
				Karmashek &copy; 2012
			</div>
			<div class="footer_about float-left">
				О проекте
			</div>
			<div class="footer_sn float-left">
				<div class="footer_sn_text float-left">
					Мы в социальных сетях:
				</div>				
				<div class="footer_sn_icons float-left">				
					<div class="footer_icon vk_icon float-left">
					</div>
					<div class="footer_icon fb_icon float-left">
					</div>
					<div class="footer_icon twitter_icon float-left">
					</div>					
				</div>
			</div>			
		</div>
	</div>

</body>
</html>