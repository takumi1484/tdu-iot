$(function(){
    $.getJSON("/kentyou.json", function(json){
        for(var i in json) {
            $("#ken").append("<option value=" +json[i].name + ">" + json[i].Chinese_characters+  "</option>");
          }
    })
});