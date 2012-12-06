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
	$links = Link::GetForParent($_REQUEST["id"]);
	function SortByIsFolder($l1, $l2) {
		if ($l1->IsFolder > $l2->IsFolder)
			return -1;
		if ($l1->IsFolder < $l2->IsFolder)
			return 1;
		if ($l1->Date > $l2->Date)
			return -1;
		if ($l1->Date < $l2->Date)
			return 1;
		return 0;
	}
	usort($links, SortByIsFolder);
	foreach ($links as $l) {?>
	<div class="table_row table_row_not_hovered <?= $l->IsFolder > 0?"f":"r"?>" id="<?=$l->Guid?>">
					<div class="checkbox_column float-left">
						<div class="styled_checkbox float-left" sel="no">
							<div class="styled_checkbox_not_selected">
							</div>
							<div class="styled_checkbox_selected" style="display: none">
							</div>														
						</div>
					</div>
					<div class="pic_column float-left">
						<?php if ($l->IsFolder > 0) {?>
							<div class="pic_folder">
							</div>
						<?php } else {?>
						<div class="pic_preview">
							<?php if (strlen($l->Preview) > 0) {?>
								<img src = "preview.php?preview=<?= $l->Preview; ?>" class="pic_preview_image">
								</img>
							<?php } ?>
						</div>
						<?php } ?>
					</div>
					<div class="caption_column float-left">
						<?
							if ($l->IsFolder > 0)
								echo $l->Name;
							else echo "<span class=\"mylink\"> {$l->Name} </span>";
						?>
					</div>
					<div class="desc_column float-left">
						<?= $l->Info; ?>
					</div>
					<div class="add_info_column float-left">
						<? if ($l->IsFolder > 0) {
							echo $l->ChildCount;
							echo " сайтов";
						} else {
							echo $l->Date;
						} ?>
					</div>
					<div class="controls_column float-left">
						<div class="edit_control float-left">
						</div>
						<div class="delete_control float-left">
						</div>
					</div>					
					<div class="table_border"></div>
				</div>
				<div class="clear"></div>
<?php
	}
?>