$(function(){
    $.getJSON("/place_data.json", function(json){
        for(var i =0;i<47;i++) {
            $("#ken").append("<option value=" +Object.keys(json)[i]+ ">" + Object.keys(json)[i]+  "</option>");
        }
        //select要素の取得
        var select = document.querySelector("#ken");
        
        //option要素の取得（配列）
        var options = document.querySelectorAll("#ken option");
        
        //select要素のchangeイベントの登録
        select.addEventListener('change', function(){
        
        //選択されたoption番号を取得
        var index =  this.selectedIndex;
        sl = document.getElementById('siku');
	    while(sl.lastChild)
	    {
		    sl.removeChild(sl.lastChild);
        }
        for(var i =0;i<json[Object.keys(json)[index-1]].length;i++) {
            $("#siku").append("<option value=" +json[Object.keys(json)[index-1]][i]+ ">" + json[Object.keys(json)[index-1]][i]+  "</option>");
        }
        });
    })
});