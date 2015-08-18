<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="content-script-type" content="text/javascript">
<title>file new</title>
<body>
<?php
$newfilename = $_POST["newfilename"];
$newfilename .= ".txt";

if (!ereg("^[[:alnum:]]+$",$_POST["newfilename"])){
?>
<p>ファイル名はアルファベットと数字のみで記入してください。</p>
<?php
}
elseif (!is_file($newfilename)) {
	touch($newfilename);
	chmod($newfilename, 0666);
	//unlink("./tmp4.txt");
?>
<p>ファイルを新規作成しました。<?=$newfilename?></p>
<p><a href="memoo.php?f=<?=$newfilename?>"><?=$newfilename?></a></p>
<?php
}
else {
?>
<p>ファイルを作成できませんでした。<?=$newfilename?>はすでに存在します。</p>
<p><a href="memoo.php?f=<?=$newfilename?>"><?=$newfilename?></a></p>
<?php
}
?>
<p><a href="./">戻る</a></p>
</body>
</html>
