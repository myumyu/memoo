<?php
$file = $_GET["f"];

if(strstr($file,"/") != false or ereg("\.txt$",$file) == false or file_exists($file) == false or is_writable($file) == false) {
	print "<html><body><p>Error</p></body></html>";
	exit;
}
unlink($file);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="content-script-type" content="text/javascript">
<title>file deleted</title>
<body>
<p>ファイルを削除しました。<?=$file?></p>
</body>
</html>
