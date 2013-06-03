<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<form id="form1" name="form1" method="post" action="../erpdes/chg_2.php">
<?php
  //修改區域
	$fkey= array('id');
	$fseach = array('getdate','id','name','tel','orderdate');
	$field= array('id','name','sex','tel','orderdate','ordertime','getdate','gettime','address','note','total','p1','p2','p3','p4','p5','p6','p7','p8','p9','p10');
	$field_title=array('訂單編號','姓名','性別','電話','訂購日期','訂購時間','取貨日期','取貨時間','取貨地點','備註','總金額','重乳酪蛋糕8吋','重乳酪蛋糕6吋','重乳酪蛋糕4吋','重乳酪蛋糕單片','原味奶酪','草莓奶酪','藍莓奶酪','巧克力奶酪','巧克力脆片奶酪','原味脆片奶酪');
	$table="tb_order";
	$sql_1= "SELECT * FROM $table";
//資料庫連線 
    if(file_exists("conf/config_connmysql.php"))
    require_once("conf/config_connmysql.php");
	else 
    require_once("../conf/config_connmysql.php");	
    $currentpage = (isset($_POST["currentpage"]))   ? addslashes($_POST["currentpage"]    ) : '' ; //搜尋條件
	//echo $currentpage;
	$sel_f   = (isset($_POST["sel_f"]))   ? addslashes($_POST["sel_f"]    ) : '' ; //搜尋條件
  $sel_k   = (isset($_POST["sel_k"]))   ? addslashes($_POST["sel_k"]    ) : '' ; //搜尋值
   $Typekey = (isset($_POST["Typekey"])) ? addslashes($_POST["Typekey"]  ) : 'A'; //A:新增 E:修改
  //echo $sel_f;
  //echo $sel_k;
  $SQLStr=$sql_1."where 1=1 ";
  //修改 
  
  if($Typekey=='E'){echo "編輯";}else{echo "新增";}
  //echo $Typekey;
  //echo $sel_f;
  //echo $sel_k;
  $SQLStr=$sql_1." where 1=1 ";
  
  //修改
  if($Typekey=='E' || $Typekey=='A'){
    for ($i=0;$i<sizeof($fkey);$i++){
      $key[$i]   = (isset($_POST["key$i"]))   ? addslashes($_POST["key$i"]    ) : '' ; //key值
      $SQLStr.="and ".$fkey[$i]."='".$key[$i]."' ";
    }
  } else {
    $SQLStr.="and 1=2 ";
  };
  echo "</br>".$SQLStr;
  $stid = mysql_query($SQLStr);
  $row = mysql_fetch_array($stid);
  echo "<table border='1' width='98%' cellspacing='0' cellpadding='0' align='center'>\r\n"; 
  for ($i=0;$i<sizeof($field);$i++){
    if($i%2==0) echo "<tr>\r\n";
    echo "<td width='15%'>";
    echo $field_title[$i];
    echo "</td><td width='35%'>";
    echo "<input input='text' name='field$i' value='".$row[$field[$i]]."'>";
    echo "</td>\r\n";
    if($i%2==1) echo "</tr>\r\n";
  };
  echo (sizeof($field)%2==1)?"<td>&nbsp;</td><td>&nbsp;</td></tr>\r\n":"";
  echo "</table>";
  
  echo "<input type='submit' name='submit' value='送出' >";

  ?>
  <input name="sel_f"    id="sel_f"    type="hidden" value="<?php echo $sel_f    ?>"><!--搜尋條件-->
  <input name="sel_k"    id="sel_k"    type="hidden" value="<?php echo $sel_k    ?>"><!--搜尋值-->
  <input name="Typekey"  id="Typekey"  type="hidden" value="<?php echo $Typekey  ?>">
<input name="currentpage" id="currentpage"  type="hidden" value="<?php echo $currentpage;?> ">
  <?php
    for ($i=0;$i<sizeof($fkey);$i++){
      echo "<input name='key$i' id='key$i' type='hidden' value='".$key[$i]."'>";
    };
  ?>
</form>

</body>
</html>
