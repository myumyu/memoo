<?php
$file = $_GET["f"];
if ($handlerdir = @opendir("./")) {
	while ( $filename = readdir ($handlerdir)){
		if  ( ereg(".*\.txt$",$filename)) {
			$file_stat = stat($filename);
			$file_date = $file_stat[ctime];
			$fp = fopen($filename,"r");
			$title[$filename] = htmlspecialchars(mb_convert_encoding(fgets($fp),"EUC-JP","auto"));
			fclose($fp);
			$f_list[$filename] = $file_date;
		}
	}
	arsort($f_list);
	if ($file == "") {
		$file = key($f_list);
	}
	$new_date = date("Y/m/d G:i:s",$f_list[key($f_list)]);
}
closedir ($handlerdir);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
print "<META NAME=\"WWWC\" CONTENT=\"{$new_date}\">";
?>
<title>memoo</title>
</head>

<frameset rows="*" cols="360,*">
				<frame src="left.php" name="left">
				<frame src="memoo.php?f=<?= $file ?>" name="right">
</frameset>
<noframes><body>
<p><a href="index_nf.php">フレームを使用しない</a></p>
</body></noframes>
</html>
