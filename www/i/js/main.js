$(function(){
	$(".user_name").click(function() {
		$.ajax({url:"logout.php", success: function() {
			location = "http://karmashek";
		}});
	});
	initBehaviour();
});
function initBehaviour() {
	$(".styled_checkbox").click(function() {
		var t = $(this);
		var isSelected = t.attr("sel");
		if(isSelected == "no") {			
			t.children(".styled_checkbox_not_selected").css("display", "none");
			t.children(".styled_checkbox_selected").css("display", "block");
			t.attr("sel", "yes");
		}
		else {
			t.children(".styled_checkbox_selected").css("display", "none");
			t.children(".styled_checkbox_not_selected").css("display", "block");
			t.attr("sel", "no");		
		
		}	
	});
	$(".table_row").hover(
		function() {
			$(this).removeClass("table_row_not_hovered");
			$(this).addClass("table_row_hovered");
		},
		function() {
			$(this).removeClass("table_row_hovered");
			$(this).addClass("table_row_not_hovered");
		}
	);
	$(".f").click(function() {
		var id = $(this).attr("id");
		init(id);
	});
	$(".delete_control").click(function() {
		var parent = $(this).parent().parent();
		var id = parent.attr("id");
		$.ajax({url:"delete.php", data : {id:id}, success: function() {
			parent.remove();
		}});
	});
}
var thisId;
function init (id, type) {
	thisId = id;
	var add = function() {
		init(id, "add");
		$(".menu_add").unbind("click", add);
	};
	var addFolder = function() {
		init(id, "addFolder");
		$(".menu_add_folder").unbind("click", addFolder);
	};
	$(".menu_add").bind("click", add);
	$(".menu_add_folder").bind("click", addFolder);
	$(".table").html("");
	if (id == undefined)
		return;
	var url = "get.php";
	if (type == "add")
		url = "addLink.php";
	if (type == "addFolder")
		url = "addFolder.php";
	var params = {id:id};
	var xhr = $.ajax({
			url: url,
			data: params,
			success: function(data) {				
				$(".table").html((data.length == 0)?"Пусто":data);
				initBehaviour();
			},
			error: function() {
				$(".table").html("error");
			}
		});
}