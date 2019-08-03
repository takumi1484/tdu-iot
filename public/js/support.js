

function check(){
  if(window.confirm('送信してよろしいですか？')){ 
    window.location.href = '../'; 
		return true;
	}
	else{
		window.alert('キャンセルされました');
		return false;
	}
}