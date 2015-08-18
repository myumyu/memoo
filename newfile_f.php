<?php
$newfilename = $_POST["newfilename"];
$newfilename .= ".txt";

if (!ereg("^[[:alnum:]]+$",$_POST["newfilename"])){
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<p>ファイル名はアルファベットと数字のみで記入してください。</p>
</body>
</html>
<?php
}
elseif (!is_file($newfilename)) {
	touch($newfilename);
	chmod($newfilename, 0666);
	//unlink("./tmp4.txt");
?>
<script type="text/javascript">
<!--
parent.left.location.href="left.php";
parent.right.location.href="memoo.php?f=<?= $newfilename?>";
-->
</script>
<html>
<head>
<meta http-equiv="refresh" content="0; url=<?=$jump_url?>">
<title>入力確認</title>
</head>
<p>入力しました。</p>
<a href="left.php">一覧に戻る</a>
</html>
<?php
}
else {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="content-script-type" content="text/javascript">
<title>file new</title>
<body>
<p>ファイルを作成できませんでした。<?=$newfilename?>はすでに存在します。</p>
<p><a href="memoo.php?f=<?=$newfilename?>"><?=$newfilename?></a></p>
<p><a href="./">戻る</a></p>
</body>
</html>
<?php
}
?>
