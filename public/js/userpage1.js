
$(function(){

    $(document).on("click", ".btn1", function(){
    $("#overlay").fadeIn(500);
    setTimeout(function(){
        $("#overlay").delay(500).fadeOut(500);
        //$("form").submit();
    },3000);
  });
  
});