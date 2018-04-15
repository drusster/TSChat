jQuery(document).ready(function($){ 
$( "#reg").add("#authorization").click(function() {
    event.preventDefault();
    if($( "input[name=login]" ).val() === ""){
        $( "input[name=login]" ).attr({"placeholder":"Логин не может быть пустым!"});
    }else if( $( "input[name=pass]" ).val() === ""){
        $( "input[name=pass]" ).attr({"placeholder":"Пароль не может быть пустым!"});
    }else if ($(this).attr("name") === "registration"){ //добавлю скрытыю переменную перед отправкой регистрационной формы
        $("form[name=form_login_and_pass]").append("<input type='hidden' name='registration' />");
        $("form[name=form_login_and_pass]").submit();
    }else{
        $("form[name=form_login_and_pass]").submit();
    }  
});


$("form[name=form_login_and_pass]").keypress(function(e){
    if(e.keyCode==13){
        $("#reg").trigger("click");
        $("#authorization").trigger("click");
    }
});
    
    
});//jQuery(document).ready(function($)