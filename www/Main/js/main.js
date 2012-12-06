$(function(){
	$(".enter-button").click(function() {
		var t = $(this);
		t.css("display","none");
		//t.css("opacity","0");
		
		//$(".enter-panel").css("opacity","1");
		$(".enter-panel").css("display","block");
		
	});
	
	$(".enter_inside_button").click(function() {
		$(".enter-panel").css("display","none");
		$(".enter-button").css("display","block");	
	});
	
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
	$("#loginForm").ajaxForm(function(er) {
		if (er[0] == '-') {
			$(".my_input_enter").removeClass("no_error");
			$(".my_input_enter").addClass("have_error");
			$(".have_error").focus(function() {
				$(".have_error").removeClass("have_error");
				$(".have_error").addClass("no_error");
			});
		}
		else
			location = "http://karmashek";
	});
	$(".enter_active_button").click(function() {
		$("#loginForm").submit();
	});
	$(".registration_link").click(function() {
		window.location = "http://karmashek/reg"
	});
});