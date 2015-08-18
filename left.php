<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--nobanner--> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>memoo_file_list</title>
<script type="text/javascript">
<!--
function right_flame_focus2()
{
   if (parent.right) {
      parent.right.document.form1.text1.focus()
   }
}
function del_con(tgt_fn) {
	var conf_str;
	conf_str = "ファイル" + tgt_fn + ".txtを削除しますか";
	if (confirm(conf_str)) { 
		del_href = "delfile.php?f=" + tgt_fn + ".txt";
		parent.right.location.href=del_href;
		Sleep(1);//1秒待つ 
		parent.left.location.href="left.php";
	}
}
function Sleep( T ){ 
//http://chaichan.web.infoseek.co.jp/qa3500/qa3644.htmより転載
   var d1 = new Date().getTime(); 
   var d2 = new Date().getTime(); 
   while( d2 < d1+1000*T ){    //T秒待つ 
       d2=new Date().getTime(); 
   } 
   return; 
} 
//-->
</script>
<style type="text/css">
<!--
a.x {font-family: "Arial",serif; font-size: x-small; text-decoration:none;}
a {font-size: small; text-decoration:none;}
td.x {font-family: "Verdana",serif; font-size: x-small;}
td {font-size: small;}
td a.b {font-size: small; text-decoration:none;display:block;overflow: hidden;}
//-->
</style>
</head>
<?php
$mytoday = date("YmdHis")
?>
<body>
<form action="newfile_f.php" method="post">
<input name="newfilename" type="text"value="<?=$mytoday?>">.txt
<input name="submit0" type="submit" value="新規作成">
<input type="button" value="更新" onclick="location.reload();right_flame_focus2()">
</form>
<form action="grepfile.php" method="post">
<input name="kw" type="text">
<input name="submit1" type="submit" value="検索">
</form>
<table>
<?php
if ($handlerdir = @opendir("./")) {
	while ( $filename = readdir ($handlerdir)){
		if  ( ereg(".*\.txt$",$filename)) {
			$file_stat = stat($filename);
			$file_date = $file_stat[9];
			$fp = fopen($filename,"r");
			$title[$filename] = htmlspecialchars(mb_convert_encoding(fgets($fp),"utf-8","auto"));
			fclose($fp);
			$f_list[$filename] = $file_date;
		}
	}
	arsort($f_list);
	foreach ($f_list as $f_name => $f_date){
		$f_name_l = preg_replace("/\.txt/","",$f_name);
		if (strlen($title[$f_name]) < 1) {
			$f_title = $f_name;
		}
		else {
			$f_title = $title[$f_name];
		}
?>
<tr>
<td><a href="memoo.php?f=<?=$f_name?>" target="right" class="b"><?=$f_title?></a></td>
<td class="x"><?=date("Y/m/d_H:i",$f_date)?>
<a href='javascript:del_con("<?=$f_name_l?>")' class="x">x</a></td>
</tr>
<?php
	}
}
closedir ($handlerdir);
?>
</table>
<p><a href="index_nf.php" target="_blank">フレーム解除</a></p>
<!--
ソートのブックマークレットは下記から転載させて頂きました。すばらしいスクリプトに感謝、感謝。
http://bookmarklet.daa.jp/
<p><a href="javascript:function toArray (c){var a, k;a=new Array;for (k=0; k<c.length; ++k)a[k]=c[k];return a;}function insAtTop(par,child){if(par.childNodes.length) par.insertBefore(child, par.childNodes[0]);else par.appendChild(child);}function countCols(tab){var nCols, i;nCols=0;for(i=0;i<tab.rows.length;++i)if(tab.rows[i].cells.length>nCols)nCols=tab.rows[i].cells.length;return nCols;}function makeHeaderLink(tableNo, colNo, ord){var link;link=document.createElement('a');link.href='javascript:sortTable('+tableNo+','+colNo+','+ord+');';link.appendChild(document.createTextNode((ord>0)?'昇順':'降順'));return link;}function makeHeader(tableNo,nCols){var header, headerCell, i;header=document.createElement('tr');for(i=0;i<nCols;++i){headerCell=document.createElement('td');headerCell.appendChild(makeHeaderLink(tableNo,i,1));headerCell.appendChild(document.createTextNode('/'));headerCell.appendChild(makeHeaderLink(tableNo,i,-1));header.appendChild(headerCell);}return header;}g_tables=toArray(document.getElementsByTagName('table'));if(!g_tables.length) alert('このページにはテーブルが含まれていません.');(function(){var j, thead;for(j=0;j<g_tables.length;++j){thead=g_tables[j].createTHead();insAtTop(thead, makeHeader(j,countCols(g_tables[j])))}}) ();function compareRows(a,b){if(a.sortKey==b.sortKey)return 0;return (a.sortKey < b.sortKey) ? g_order : -g_order;}function sortTable(tableNo, colNo, ord){var table, rows, nR, bs, i, j, temp;g_order=ord;g_colNo=colNo;table=g_tables[tableNo];rows=new Array();nR=0;bs=table.tBodies;for(i=0; i<bs.length; ++i)for(j=0; j<bs[i].rows.length; ++j){rows[nR]=bs[i].rows[j];temp=rows[nR].cells[g_colNo];if(temp) rows[nR].sortKey=temp.innerHTML;else rows[nR].sortKey='';++nR;}rows.sort(compareRows);for (i=0; i < rows.length; ++i)insAtTop(table.tBodies[0], rows[i]);}">ファイルをソートモードにする</a></p>
-->
<script type="text/javascript">
<!--
javascript:function toArray (c){var a, k;a=new Array;for (k=0; k<c.length; ++k)a[k]=c[k];return a;}function insAtTop(par,child){if(par.childNodes.length) par.insertBefore(child, par.childNodes[0]);else par.appendChild(child);}function countCols(tab){var nCols, i;nCols=0;for(i=0;i<tab.rows.length;++i)if(tab.rows[i].cells.length>nCols)nCols=tab.rows[i].cells.length;return nCols;}function makeHeaderLink(tableNo, colNo, ord){var link;link=document.createElement('a');link.href='javascript:sortTable('+tableNo+','+colNo+','+ord+');';link.appendChild(document.createTextNode((ord>0)?'昇順':'降順'));return link;}function makeHeader(tableNo,nCols){var header, headerCell, i;header=document.createElement('tr');for(i=0;i<nCols;++i){headerCell=document.createElement('td');headerCell.appendChild(makeHeaderLink(tableNo,i,1));headerCell.appendChild(document.createTextNode('/'));headerCell.appendChild(makeHeaderLink(tableNo,i,-1));header.appendChild(headerCell);}return header;}g_tables=toArray(document.getElementsByTagName('table'));if(!g_tables.length) alert('このページにはテーブルが含まれていません.');(function(){var j, thead;for(j=0;j<g_tables.length;++j){thead=g_tables[j].createTHead();insAtTop(thead, makeHeader(j,countCols(g_tables[j])))}}) ();function compareRows(a,b){if(a.sortKey==b.sortKey)return 0;return (a.sortKey < b.sortKey) ? g_order : -g_order;}function sortTable(tableNo, colNo, ord){var table, rows, nR, bs, i, j, temp;g_order=ord;g_colNo=colNo;table=g_tables[tableNo];rows=new Array();nR=0;bs=table.tBodies;for(i=0; i<bs.length; ++i)for(j=0; j<bs[i].rows.length; ++j){rows[nR]=bs[i].rows[j];temp=rows[nR].cells[g_colNo];if(temp) rows[nR].sortKey=temp.innerHTML;else rows[nR].sortKey='';++nR;}rows.sort(compareRows);for (i=0; i < rows.length; ++i)insAtTop(table.tBodies[0], rows[i]);}
-->
</script>
</body>
</html>
