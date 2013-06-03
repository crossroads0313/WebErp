<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript">
    function calu(){
	var p=new Array(20);
	  for(i=11;i<=20;i++)
     {  
	  p[i]=(document.getElementsByTagName("input")[i].value)*1;
	 }
	 
     document.form1.field10.value=p[11]*30+(p[12]+p[13]+p[14]+p[15]+p[16]+p[17]+p[18]+p[19]+p[20])*1;
	}
</script>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
<?php
   	//設定資料載入
    if(file_exists("conf/set_system.php"))
    include("conf/set_system.php");
	else 
    include("../conf/set_system.php");	
	

	//取得資料
	$sel_f   = (isset($_POST["sel_f"]))   ? addslashes($_POST["sel_f"]    ) : '' ; //搜尋條件
	$sel_k   = (isset($_POST["sel_k"]))   ? addslashes($_POST["sel_k"]    ) : '' ; //搜尋值
	$Typekey = (isset($_POST["Typekey"])) ? addslashes($_POST["Typekey"]  ) : 'A'; //A:新增 E:修改
	//資料庫連線 
    if(file_exists("conf/config_connmysql.php"))
    require_once("conf/config_connmysql.php");
	else 
    require_once("../conf/config_connmysql.php");	
	echo "新增";
	$SQLStr=$sql_1." where 1=1 ";
    for ($i=0;$i<sizeof($fkey);$i++){
      $key[$i]   = (isset($_POST["key$i"]))   ? addslashes($_POST["key$i"]    ) : '' ; //key值
      $SQLStr.="and ".$fkey[$i]."='".$key[$i]."' ";
    }

   echo $SQLStr;
	$stid = mysql_query($SQLStr);
	$row = mysql_fetch_array($stid);
	echo "<table border='1' width='98%' cellspacing='0' cellpadding='0' align='center'>\r\n"; 
	for ($i=0;$i<sizeof($field);$i++){
    if($i%2==0) echo "<tr>\r\n";
    echo "<td width='15%'>";
    echo $field_title[$i];
    echo "</td><td width='35%'>";
	if($field_title[$i]=="訂購日期")
	{
	
    echo "<input type='text' name='field$i' value='".$today_date."'>";
	}else if($field_title[$i]=="訂購時間"){
	echo "<input type='text' name='field$i' value='".$today_time."'>";
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
  echo "<input type='submit' name='setdata' value='送出' onClick=\"";
  if($Typekey=='A'){
  echo "document.form1.Typekey.value='A';\">"; 
  echo "<input type='submit' value='返回'>";
  }elseif($Typekey=='E')
  {
    echo "document.form1.Typekey.value='E';\">";
	echo "<input type='submit' value='返回'>";
  }

  
  if(isset($_POST['setdata']))
  {
  setdata($Typekey,$field,$table);
  }
 function setdata($Typekey,$field,$table){
 //echo $Typekey."<br>"; 
	if($Typekey=='E'){
	$SQLStr="UPDATE $table SET ";
		for($i=0;$i<sizeof($field);$i++){
		$key[$i]   = (isset($_POST["field$i"]))   ? addslashes($_POST["field$i"]) : '' ; 
		$SQLStr.=$field[$i]."='".$key[$i]."', ";
	}
	$SQLStr = substr($SQLStr,0,strlen($SQLStr)-2); 
	$SQLStr.= " WHERE $field[0]='$key[0]'";
   echo $SQLStr;	
	if(mysql_query($SQLStr)){ 
	echo "<input name='sel_f'   id='sel_f'   type='hidden' value='$sel_f'>";
	echo "<input name='sel_k'   id='sel_k'   type='hidden' value='$sel_k'>";
	echo "<script type='text/javascript'>alert('修改完成');</script>";
	echo "<script type='text/javascript'>document.form1.submit();</script>";
	}
	else{echo "<br/>修改失敗";
	}
	}
 
	elseif($Typekey=='A'){
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
	}
}
  ?>
  <input name="currentpage" id="currentpage" type="hidden"  value="<?php echo $currentpage;?> ">
  <input name="sel_f"    id="sel_f"    type="hidden" value="<?php echo $sel_f    ?>"><!--搜尋條件-->
  <input name="sel_k"    id="sel_k"    type="hidden" value="<?php echo $sel_k    ?>"><!--搜尋值--> 
  <input name="Typekey" id="Typekey" type="hidden" value="">
  <?php
    for ($i=0;$i<sizeof($fkey);$i++){
      echo "<input name='key$i' id='key$i' type='hidden' value='".$key[$i]."'>";
    };
  ?>
</form>