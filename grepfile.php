<?php 
	$kw = $_POST["kw"];
	$kw = pg_escape_string($kw);
	$kw = mb_convert_encoding($kw, "UTF-8", "auto")
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--nobanner--> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript">
<!--
function ClickUrl()
{
    if (document.all) {
		a = document.selection.createRange();
        var b = a.parentElement(); 
        var c = b.createTextRange(); 
        c = document.body.createTextRange(); 
        c.moveToElementText(b); 
        c.setEndPoint("EndToStart", a); 
        d = document.body.createTextRange();
        d.moveToElementText(b);
        d.setEndPoint("StartToEnd", a);
        s = new RegExp("^[a-zA-Z0-9\./_&%?=@,:;#-]*\.txt");
        var url = "";
        if (ss = d.text.match(s)) {
            url = "memoo.php?f=" + a.text + ss;
        }

		if(url.length>0)
			parent.right.location.href=url;
    }
	else {
		var element = document.getElementById('text');
		var start = element.selectionStart;  // 開始位置
		var end   = element.selectionEnd;    // 終了位置
		var t = element.value.substr(start,end-start); // 選択文字列
		url = "memoo.php?f=" + t + ".txt";
		parent.right.location.href=url;
	}
}
//-->
</script>
<title>memoo_file_list</title>
</head>
<body>
<p>kw=<?=$kw?><br />ファイル名のダブルクリックで編集可<br />
<a href="left.php">戻る</a></p>
<textarea name="text" cols="40" rows="40" readonly="readonly" wrap="OFF"  id="text" ondblclick="ClickUrl()">
<?php 
	system("/bin/grep -i '{$kw}' *.txt");
//$result_grep = array(); 
//exec("/bin/grep '{$kw}' *.txt", $result_grep); 
//print_r($result_grep) . "\n"; 
?>
</textarea>
</body>
</html>
