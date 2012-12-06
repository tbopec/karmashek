$(function() {
	
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
	var getErrorMessage = function(code) {
		switch (code) {
			case "notset":
				return "Не установлен";
			case "notequal":
				return "Пароли не совпадают";
			case "incorrect":
				return "Неверная почта";
			case "is":
				return "Пользователь с такой почтой зарегистрирован";
		}
	};
	$("#registration").ajaxForm(function(er) {
		var errors = er.split('/');
		var ar = [];
		for (i = 0; i < errors.length; ++i) {
			if (errors[i].length > 0) {
				ers = errors[i].split(' ');
				type = ers[0];
				input = ers[1];
				if (ar[input] == null)
					ar[input] = [];
				ar[input].push(type);
			}
		}
		for (key in ar) {
			el = document.getElementsByName(key)[0];
			erMes = "";
			for (i in ar[key])
				erMes += getErrorMessage(ar[key][i])+",";
			$(el).parent().append(
			"<div class='alert_icon float-left'></div><div class='alert_text float-left'>"+erMes+"</div>"
			);
		}
		if (ar.length == 0) location="http://karmashek";
	});
	$(".registration_button").click(function() {
		$(".alert_icon").remove();
		$(".alert_text").remove();
		$("#registration").submit();
	});
});