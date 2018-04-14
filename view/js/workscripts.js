jQuery(document).ready(function($){
$( "#reg" ).click(function() {
    event.preventDefault();
    if($( "input[name=login]" ).val() === ""){
        $( "input[name=login]" ).attr({"placeholder":"Лонин не может быть пустым!"});
    }else if( $( "input[name=pass]" ).val() === ""){
        $( "input[name=pass]" ).attr({"placeholder":"Пароль не может быть пустым!"});
    }else{
        alert("Норм");
    }  
});
    
    
});//jQuery(document).ready(function($)