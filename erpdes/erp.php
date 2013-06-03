<form id="form1" name="form1" method="post" action="">	
<?php
	//設定資料載入
    if(file_exists("conf/set_system.php"))
    include("conf/set_system.php");
	else 
    include("../conf/set_system.php");	
	
	//資料庫連線 
    if(file_exists("conf/config_connmysql.php"))
    require_once("conf/config_connmysql.php");
	else 
    require_once("../conf/config_connmysql.php");	
	
	echo "Sunny Dessert&nbsp;ERP<br>\r\n";
  	echo "今日日期".$today_date." </br>";
	echo "明日日期".$tomorrow_date."</br>";
	echo "現在時間".$today_time."</br></br>";
	
 
	
	//取得搜尋條件和搜尋值
	$sel_f   = (isset($_POST["sel_f"]))   ? addslashes($_POST["sel_f"]    ) : '' ; //搜尋條件  addslashes 為在'之前+ /
	$sel_k   = (isset($_POST["sel_k"]))   ? addslashes($_POST["sel_k"]    ) : '' ; //搜尋值
	
	//刪除語法區塊
	if( ((isset($_POST["Typekey"]))? addslashes($_POST["Typekey"]):'')=='Del' ){
    $DelSQL="Delete from $table where 1=1 "; //DELETE FROM $del_table where 1=1 NITM='條碼';
	for ($i=0;$i<sizeof($fkey);$i++){
      $key[$i]   = (isset($_POST["key$i"]))   ? addslashes($_POST["key$i"]    ) : '' ; //搜尋值 $key[$i]為條碼
      $DelSQL.="and ".$fkey[$i]."='".$key[$i]."'";
    };
	//echo $DelSQL;
    if(mysql_query($DelSQL)){ 
	echo "<script type='text/javascript'>alert('刪除完成!')</script>"; 
	};
	};	
	//新增
	?>
	<input type="button" value="新增訂單" onclick="document.form1.Typekey.value='A';document.form1.submit();">
	<input type="button" value="店面銷售" onclick="document.form1.Typekey.value='T';document.form1.submit();">
	<input type="button" value="報表" onclick="document.form1.Typekey.value='X';document.form1.submit();">
	<input type="submit" value="刷新"></br>
    <?
	//echo "<a href='/erpdes/new_1.php' target='_blank'><img src='/images/new.jpg'></a>";
    //echo "<img src='/images/excel.png'></br>";
	//明日出貨
	echo "</br>明日出貨數量</br>";
	$SQL="SELECT $product_list FROM `$table` WHERE getdate = $tomorrow_date";
	show_salenum($product_title,$SQL);
	
	//今日出貨
	echo "</br>今日出貨數量</br>";
	$SQL="SELECT $product_list FROM `$table` WHERE getdate = $today_date";
	show_salenum($product_title,$SQL);

	//今日已販售
	echo "</br>今日已販售數量</br>";
	$SQL="SELECT $product_list FROM `$today_table` WHERE date = $today_date";
	show_salenum($product_title,$SQL);
	
	//搜尋選單列
	echo "<table border='0' width='98%' cellspacing='0' cellpadding='0' align='center'><tr height='10'><td align='right' width='40%'>";	
	echo "<select name='sel_f' id='sel_f'>\n";
    foreach ($fseach as $item) {
    echo "<option value='$item'";
    if($sel_f==$item) echo "selected";
    echo ">";
    echo $field_title[array_search($item,$field)]; /*title*/
	};
	echo "</select>\n";
	echo "</td><td>";
	
	//搜尋框
	echo "<input name='sel_k' id='sel_k' type='text' value='$sel_k'>";	
	echo "</td><td width='40%'>";
	?>
	<input type="button" value="搜尋" onclick="document.form1.submit()";>
	<?
	// echo "<img src='/images/sech.jpg' width='42' height='20' border='0' style='z`' onclick='document.form1.submit();'>\n";
	echo "</td></tr></table>";
	
	//將搜尋條件加在搜尋語句後
	if(isset($sel_k)) {
    if($sel_k=='')
      $sql_2="";
    else
      $sql_2=" where $sel_f like '%$sel_k%' ";
	} else {
    $sql_2=" where 1=2 ";
	};
	
	//搜尋區塊
    $SQL = $sql_1.$sql_2;
	//$searchsql="SELECT * FROM tb_for_1 WHERE `$sel_f` LIKE '%$sel_k%'";
    $c_sql_1="SELECT COUNT(*) FROM $table";
	$c_sql_1.=$sql_2;
	//echo $c_sql_1;
	$c_result = mysql_query($c_sql_1);
	$r = mysql_fetch_row($c_result);
	$numrows = $r[0];
	$rowsperpage = 10;
	$totalpages = ceil($numrows / $rowsperpage);
	if(isset($_POST['currentpage']))
	{
	$currentpage=(int) $_POST['currentpage'];
	}else{
	if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   $currentpage = (int) $_GET['currentpage'];
	} else {
   $currentpage = 1;
	} 
	}
	if ($currentpage > $totalpages) {

	$currentpage = $totalpages;
	} 
	if ($currentpage < 1) {
   $currentpage = 1;
	}
	$offset = ($currentpage - 1) * $rowsperpage;
	$SQL.=" LIMIT ".$offset.", ".$rowsperpage;
	//echo "<BR>".$SQL;
	$result = mysql_query($SQL);
	//建立表格印出資料
	echo "<table border='1' width='98%' cellspacing='0' cellpadding='0' align='center'>\n";
    echo "<tr>\n";
	foreach ($field_title as $item) echo "<td>".($item!==null ? $item:"&nbsp;")."</td>\n";
	echo "<td>管理</td></tr>\n";	
    //當有資料時使用submit會輸出表格
	while ($row = mysql_fetch_array($result)) {
    echo "<tr height='20'>\n";
	
    //設定寬度顯示資料
	foreach ($field as $item) {
      echo "<td ";
      if(isset($fwidth[$item]))
        echo "width='".$fwidth[$item]."'"; 
      echo ">";
      if ($row[$item]!==null){
        echo $row[$item];
      }else{
        echo "&nbsp;";
      }; 
      echo "</td>\n";
    };
	echo "<td>";
    
    //修改 	
 	echo "<input type='button' value='修改'  border='0' style='cursor:pointer' onClick=\"";
    echo "document.form1.Typekey.value='E';"; //設定Typekey的值為E(修改)
    for ($i=0;$i<sizeof($fkey);$i++){
    echo "document.form1.key$i.value='".$row[$fkey[$i]]."';";
    };
    echo "document.form1.submit();\">\r\n";
	
	//刪除 
	echo "<input type='button' value='刪除' border='0' style='cursor:pointer' onClick=\"";
	echo "if(confirm('確定刪除?')) {";
	for ($i=0;$i<sizeof($fkey);$i++){
	echo "document.form1.key$i.value='".$row[$fkey[$i]]."';";
	};
	echo "document.form1.Typekey.value='Del';"; //設定Typekey的值為D(刪除)
	echo "document.form1.submit();}\">\r\n"; //送出

    echo "</td>";
    echo "</tr>\n";
	};
	echo "</table>\n";
	$range = 10;
	
if ($currentpage > 1) {
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
   $prevpage = $currentpage - 1;
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
} 
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   if (($x > 0) && ($x <= $totalpages)) {
      if ($x == $currentpage) {
         echo " [<b>$x</b>] ";
      } else {
        
         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
      } 
   } 
}     
if($totalpages == 0 ){
echo "";
}elseif($currentpage != $totalpages) {
   $nextpage = $currentpage + 1;
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
}

function show_salenum($product_title,$SQL){
	echo "<table border='1' width='98%' cellspacing='0' cellpadding='0' align='center'>";
    echo "<tr>";
	foreach ($product_title as $item) 
	echo "<td>".($item!==null ? $item:"&nbsp;")."</td>";
	echo "</tr>";
	//echo $SQL;
	$result=mysql_query($SQL);
	while($row=mysql_fetch_array($result))
	{
	 for($i=0;$i<sizeof($product_title);$i++)
	 $p[$i]=$p[$i]+=$row[$i];
	}
	echo "<tr>";
	 for($i=0;$i<sizeof($product_title);$i++){
     echo "<td>";
     echo $p[$i];
	 echo "</td>";
	}
	echo "</tr>";
	echo "</table></br>";
	
	
	
}

 ?>
<!--傳值區塊-->  
<input name="currentpage" id="currentpage" type="hidden"  value="<?php echo $currentpage;?> ">
<input name="Typekey" id="Typekey" type="hidden" value="">
<?
    for ($i=0;$i<sizeof($fkey);$i++){
      echo "<input name='key$i' id='key$i' type='hidden' value=''>"; //被設定為條碼傳值到TT001_2
    };
?>
</form>

