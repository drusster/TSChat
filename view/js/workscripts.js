jQuery(document).ready(function($){
$( "#reg" ).click(function() {
    event.preventDefault();
    if($( "input[name=login]" ).val() === ""){
        $( "input[name=login]" ).attr({"placeholder":"Лонин не может быть пустым!"});
    }else if( $( "input[name=pass]" ).val() === ""){
        $( "input[name=pass]" ).attr({"placeholder":"Пароль не может быть пустым!"});
    }else if ($(this).attr("name") === "registration"){ //добавлю скрытыю переменную перед отправкой регистрационной формы
        $("form[name=form_login_and_pass]").append("<input type='hidden' name='registration' />");
        $("form[name=form_login_and_pass]").submit();
    }  
});
    
    
});//jQuery(document).ready(function($)