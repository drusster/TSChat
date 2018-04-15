jQuery(document).ready(function($){ 
    //задействую кнопки для форм регистрации и авторизации
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

// задействую клавишу Entr для форм регистрации (авторизации)
$("form[name=form_login_and_pass]").keypress(function(e){
    if(e.keyCode==13){
        $("#reg").trigger("click");
        $("#authorization").trigger("click");
    }
});

// нажатие на кнопку Отправить
 $( "#button_send_message").click(function() {
    event.preventDefault(); 
    if($( "input[name=message]" ).val() !== ""){
        $("form[name=send_message]").submit();
    }
 });
 //удаляю сообщение-приветсвие на странице чата
 if($('*').is("form[name=send_message]")){ 
    setTimeout(function(){
        $('.success').slideUp('slow', function(){
           $(this).remove();
        });
    },4000);
 }
});//jQuery(document).ready(function($)