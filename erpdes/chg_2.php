<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
 <form id="form1" name="form1" method="post" action="../erpdes/index.php">
 <?php
  //修改區域
	$fkey= array('id');
	$fseach = array('getdate','id','name','tel','orderdate');
		$field= array('id','name','sex','tel','orderdate','ordertime','getdate','gettime','address','note','total','p1','p2','p3','p4','p5','p6','p7','p8','p9','p10');
	$field_title=array('訂單編號','姓名','性別','電話','訂購日期','訂購時間','取貨日期','取貨時間','取貨地點','備註','總金額','重乳酪蛋糕8吋','重乳酪蛋糕6吋','重乳酪蛋糕4吋','重乳酪蛋糕單片','原味奶酪','草莓奶酪','藍莓奶酪','巧克力奶酪','巧克力脆片奶酪','原味脆片奶酪');
	$table="tb_order";
	$sql_1= "SELECT * FROM $table";
$sel_f   = (isset($_POST["sel_f"]))   ? addslashes($_POST["sel_f"]    ) : '' ; //搜尋條件
$sel_k   = (isset($_POST["sel_k"]))   ? addslashes($_POST["sel_k"]    ) : '' ; //搜尋值
$currentpage = (isset($_POST["currentpage"]))   ? addslashes($_POST["currentpage"]    ) : '' ; //搜尋條件
	//echo $currentpage;
//資料庫連線 
    if(file_exists("conf/config_connmysql.php"))
    require_once("conf/config_connmysql.php");
	else 
    require_once("../conf/config_connmysql.php");	
 /*if(isset($_POST['setdata']))
 {
 setdata($Typekey,$field,$chg_table);
 }

  function setdata($Typekey,$field,$chg_table){*/
 // echo $Typekey."<br>";
  if($Typekey=='E'){
  
   $SQLStr="UPDATE $table SET ";
	for($i=0;$i<sizeof($field);$i++){
	 $key[$i]   = (isset($_POST["field$i"]))   ? addslashes($_POST["field$i"]) : '' ; 
	  $SQLStr.=$field[$i]."='".$key[$i]."', ";
	}
	$SQLStr = substr($SQLStr,0,strlen($SQLStr)-2); 
	$SQLStr.= " WHERE $field[0]='$key[0]'";
	//echo $SQLStr; 
	}else{
	$SQLStr="INSERT INTO  $chg_table ( ";
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

	//echo $SQLStr;
	}
echo $SQLStr;	
	
 if(mysql_query($SQLStr)){ 
 if($Typekey=='E'){ echo "<br/>修改完成<br/>";} else {echo "新增完成<br/>";}
 }
 else{
 if($Typekey=='E'){echo "<br/>修改失敗";}else{echo "<br/>新增失敗" ;}
 }
 // }
 echo "<input type='submit' name='Submit' value='返回' onClick='document.form1.action=../test/index.php'>";
 ?>
 <input name="sel_f"    id="sel_f"    type="hidden" value="<?php echo $sel_f    ?>"><!--搜尋條件-->
<input name="sel_k"    id="sel_f"    type="hidden" value="<?php echo $sel_k    ?>"><!--搜尋條件-->
<input name="currentpage" id="currentpage"  type="hidden" value="<?php echo $currentpage;?> ">
 <form>
 </body>
 </html>