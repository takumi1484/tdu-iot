
$(function(){

  $(".btn1").click( function(){
    $("#overlay").fadeIn(500);
    setTimeout(function(){
        $("#overlay").fadeOut(500);
        //$("form").submit();
    },3000);
  });
  
});