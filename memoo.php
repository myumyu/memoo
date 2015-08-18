<?php
/**
 *  memoo
 *
 *  @since      2005.3.12
 *  @author     Nob Funaki <nob.funaki@gmail.com>
 */

/**
 *  SETTING
 */

$file = $_GET["f"];
// file_exists()関数 のステータスのキャッシュをクリア 
clearstatcache(); 
if(strstr($file,"/") != false or ereg("\.txt$",$file) == false or file_exists($file) == false) {
	print "<html><body><p>Error</p></body></html>";
	exit;
}

$str  = "";
$type = "w";
if (array_key_exists("str", $_POST)) {
    $str = $_POST["str"];
} else if (array_key_exists("title", $_GET) && array_key_exists("url", $_GET)) {
    $str = rawurldecode("\n\n".$_GET["title"]."\n".$_GET["url"]);
    if (function_exists("mb_convert_encoding")) {
        $str = mb_convert_encoding($str, "UTF-8", "auto");
    }
    $type = "a";
}
if ($str != "" && is_writable($file)) {
    $str = str_replace("\\\\","\\",$str);
    $str = str_replace("\\\"","\"",$str);
    $str = preg_replace("/\\\'/","'",$str);
    $str = preg_replace("/%%D/i",date("Y/m/d G:i:s"),$str);
    $fp = fopen($file, $type);
    fwrite($fp, rawurldecode($str));
    fclose($fp);
    if ($type == "w") {
        exit;
    }
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="content-script-type" content="text/javascript">
<title>memoo:<?=$file?></title>
<?php
if ($file == "") {
	print "<body><p>ファイル名を入力してください.</p></body></html>\n";
	exit;
}
?>
<style type="text/css">
<!--
body {
    margin: 0%;
}
textarea {
    width: 100%;
    height: 100%;
    background-color: #EEE;
    padding: 0.5em;
    border: none;
}
-->
</style>
<script type="text/javascript">
<!--
function ClickUrl()
{
    if (document.all) {
        var a = document.selection.createRange();
        var b = a.parentElement(); 
        var c = b.createTextRange(); 
        c = document.body.createTextRange(); 
        c.moveToElementText(b); 
        c.setEndPoint("EndToStart", a); 
        d = document.body.createTextRange();
        d.moveToElementText(b);
        d.setEndPoint("StartToEnd", a);
        r = new RegExp("https?://[a-zA-Z0-9\./_&%?=@,:;#-]*?$");
        s = new RegExp("^[a-zA-Z0-9\./_&%?=@,:;#-]*");
        var url = "";
        if ((a.text == "http" || a.text == "https") && (ss = d.text.match(s))) {
            url = a.text + ss;
        } else if ((rr = c.text.match(r)) && (ss = d.text.match(s))) {
            url = rr + a.text + ss;
        }
        t = new RegExp("^[a-zA-Z0-9\./_&%?=@,:;#-]*\.txt");
        var urlt = "";
        if (tt = d.text.match(t)) {
            urlt = "memoo.php?f=" + a.text + tt;
        }
		if(urlt.length>0) {
			parent.right.location.href=urlt;
		}
		else if(url.length>0) {
			window.open(url);
		}
    }
}
function GetXmlHttpReqObj() {
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}
function SaveFile(kc)
{
//    var kc = event.keyCode;
    var req = GetXmlHttpReqObj();
    var filename = location.pathname.substring(location.pathname.lastIndexOf('/') + 1); // get current filename
	filename = filename + "?f=<?=$file?>";
//    var filename = "<?=$file?>"; // get current filename
    if (filename == "") {
        filename = "memoo.php?f=tmp.txt";
    }
    req.open("POST", filename, true);
    req.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); 
    var str = document.getElementById("text").value;
    str = str.replace(/&/g, "%26");
    str = str.replace(/&amp;/g, "%26");
    str = str.replace(/\+/g, "%2B");
    str = str.replace(/&gt;/g, ">");
    str = str.replace(/&lt;/g, "<");
    //str = str.replace(/\'/g, "%2C");
    req.send("str=" + str);
}

//  TAB inside textarea (and textbox)?
//  http://dotnetjunkies.com/WebLog/familjones/archive/2004/04/01/10607.aspx
function HandleKeyDown(obj,kc_2)
{
   var tabKeyCode = 9;
   if (kc_2 == tabKeyCode && event.srcElement == obj) {
      obj.selection = document.selection.createRange();
      obj.selection.text = String.fromCharCode(tabKeyCode);
      event.returnValue = false;
   }
}
function HandleKeyDown_o(obj)
{
   var tabKeyCode = 9;
   if (event.keyCode == tabKeyCode && event.srcElement == obj) {
      obj.selection = document.selection.createRange();
      obj.selection.text = String.fromCharCode(tabKeyCode);
      event.returnValue = false;
   }
}
top.document.title = document.title;
function right_flame_focus()
{
   if (parent.right) {
      parent.right.document.form1.text1.focus();
   }
   else{
      this.document.form1.text1.focus();
   }
}
-->
</script>
</head>

<body onload="right_flame_focus()">
<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST" name="form1">
<textarea id="text" rows="100" cols="100" ondblclick="ClickUrl()" onkeyup="SaveFile(event.KeyCode)" onkeydown="HandleKeyDown_o(this);" name="text1">
<?php
echo htmlspecialchars(file_get_contents($file));
?>
</textarea>
</form>
</body>
</html>
