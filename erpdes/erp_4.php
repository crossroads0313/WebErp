<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript">
    function calu(){
	var p=new Array(20);
	  for(i=3;i<=12;i++)
     {  
	  p[i]=(document.getElementsByTagName("input")[i].value)*1;
	 }
     document.form1.field13.value=p[3]*30+(p[4]+p[5]+p[6]+p[7]+p[8]+p[9]+p[10]+p[11]+p[12])*1;
	}
</script>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
<?php
  //修改區域
	$fkey= array('id');
	$fseach = array('getdate','id','name','tel','orderdate');
	$field= array('id','date','time','p1','p2','p3','p4','p5','p6','p7','p8','p9','p10','total');
	$field_title=array('銷售編號','銷售日期','銷售時間','重乳酪蛋糕8吋','重乳酪蛋糕6吋','重乳酪蛋糕4吋','重乳酪蛋糕單片','原味奶酪','草莓奶酪','藍莓奶酪','巧克力奶酪','巧克力脆片奶酪','原味脆片奶酪','總金額');
	$table="tb_todaysale";
	$sql_1= "SELECT * FROM $table";
	$product_list="p1,p2,p3,p4,p5,p6,p7,p8,p9,p10";
	$product_title=array('重乳酪蛋糕8吋','重乳酪蛋糕6吋','重乳酪蛋糕4吋','重乳酪蛋糕單片','原味奶酪','草莓奶酪','藍莓奶酪','巧克力奶酪','巧克力脆片奶酪','原味脆片奶酪','總金額');
	$today_date=date("Ymd");
	//取得資料
	$sel_f   = (isset($_POST["sel_f"]))   ? addslashes($_POST["sel_f"]    ) : '' ; //搜尋條件
	$sel_k   = (isset($_POST["sel_k"]))   ? addslashes($_POST["sel_k"]    ) : '' ; //搜尋值
	$Typekey = (isset($_POST["Typekey"])) ? addslashes($_POST["Typekey"]  ) : ''; //A:新增 E:修改
	//資料庫連線 
    if(file_exists("conf/config_connmysql.php"))
    require_once("conf/config_connmysql.php");
	else 
    require_once("../conf/config_connmysql.php");	
	echo "今日銷售系統</br>";
		
	echo "新增資料";
	$SQLStr=$sql_1." where 1=1 ";
	
    for ($i=0;$i<sizeof($fkey);$i++){
      $key[$i]   = (isset($_POST["key$i"]))   ? addslashes($_POST["key$i"]    ) : '' ; //key值
      $SQLStr.="and ".$fkey[$i]."='".$key[$i]."' ";
    }

 // echo $SQLStr;
	$date=date("Ymd");
	$time=date("His",strtotime("+8 hour"));
	$stid = mysql_query($SQLStr);
	$row = mysql_fetch_array($stid);
	echo "<table border='1' width='98%' cellspacing='0' cellpadding='0' align='center'>\r\n"; 
	for ($i=0;$i<sizeof($field);$i++){
    if($i%2==0) echo "<tr>\r\n";
    echo "<td width='15%'>";
    echo $field_title[$i];
    echo "</td><td width='35%'>";
	if($field_title[$i]=="銷售日期")
	{
	
    echo "<input type='text' name='field$i' value='".$date."'>";
	}else if($field_title[$i]=="銷售時間"){
	echo "<input type='text' name='field$i' value='".$time."'>";
	}
	else{
	echo "<input type='text' name='field$i' value='".$row[$field[$i]]."'>";
	}
	
    echo "</td>\r\n";
    if($i%2==1) echo "</tr>\r\n";
  };
  echo (sizeof($field)%2==1)?"<td>&nbsp;</td><td>&nbsp;</td></tr>\r\n":"";
  echo "</table>";
  echo "<input type='button' onClick='calu()' value='計算總金額'>"; 
?><input type="submit" name="setdata" value="送出" onClick="document.form1.Typekey.value='T';">
<? 
 echo "<input type='submit' value='返回'>";
 
 if(isset($_POST['setdata']))
 {
 setdata($field,$table,$product_title,$product_list);
 }

  function setdata($field,$table,$product_title,$product_list){
	$SQLStr="INSERT INTO $table ( ";
	for($i=0;$i<sizeof($field);$i++){
	  $SQLStr.=$field[$i]." ,";
	}
	$SQLStr = substr($SQLStr,0,strlen($SQLStr)-2); 
	$SQLStr.=$field[$i]." ) VALUES (";
	
	for($i=0;$i<sizeof($field);$i++){
    $key[$i]   = (isset($_POST["field$i"]))   ? addslashes($_POST["field$i"]) : '' ; 
	$SQLStr.="'".$key[$i]."', ";
	}
	$SQLStr = substr($SQLStr,0,strlen($SQLStr)-2); 
	$SQLStr.=")";
    echo $SQLStr;	
	if(mysql_query($SQLStr)){ echo "<br/>新增完成<br/>";}
	else{echo "<br/>新增失敗" ;}
	
    //今日已販售
	$today_date=date("Ymd");
	echo "</br>今日已販售數量</br>";
	echo "<table border='1' width='98%' cellspacing='0' cellpadding='0' align='center'>";
    echo "<tr>";
	foreach ($product_title as $item) 
	echo "<td>".($item!==null ? $item:"&nbsp;")."</td>";
	echo "</tr>";
	$SQL="SELECT $product_list FROM `$table` WHERE date = '$today_date'";
	//echo $SQL;
	$pre_result=mysql_query($SQL);
	while($pre_row=mysql_fetch_array($pre_result))
	{
	 for($i=0;$i<sizeof($product_title);$i++)
	 $p[$i]=$p[$i]+=$pre_row[$i];
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
    <input name="Typekey" id="Typekey" type="hidden" value="">
	  <input name="sel_f"    id="sel_f"    type="hidden" value="<?php echo $sel_f    ?>"><!--搜尋條件-->
  <input name="sel_k"    id="sel_k"    type="hidden" value="<?php echo $sel_k    ?>"><!--搜尋值--> 
 
</form>
</body>
</html>
