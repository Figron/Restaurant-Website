
function sendAjaxLogin(login_response, login_form, url) {
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "GET", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+login_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
        	result = $.parseJSON(response);
          if(result.status==true){
            window.location.href = 'Restaurant.php';
        }else if(result.status==false){
          $('#login_response').html("<p class='text-danger'>" + result.message + "</p>");
        }
    	},
    	error: function(response) { // Данные не отправлены
            $('#login_response').html("<p class='text-danger'>An error has occured!</p>");
    	}
 	});
}
function sendAjaxSignup(signup_response, signup_form, url) {
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+signup_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
        	result = $.parseJSON(response);
          if(result.status==true){
            window.location.href = 'Restaurant.php';
        }else if(result.status==false){
          $('#signup_response').html("<p class='text-danger'>" + result.message + "</p>");
        }
    	},
    	error: function(response) { // Данные не отправлены
            $('#signup_response').html("<p class='text-danger'>An error has occured!</p>");
    	}
 	});
}
