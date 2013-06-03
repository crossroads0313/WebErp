<form name="form1" id="form1" method="post" action="">
<?php
//資料庫連線 
if(file_exists("conf/config_connmysql.php"))
require_once("conf/config_connmysql.php");
else 
require_once("../conf/config_connmysql.php");

$table="tb_order";
$read_sql="select * from $table";
$read_result=mysql_query($read_sql);

while($row=mysql_fetch_field($read_result))
{
    echo "<input type='text' id='field$$i' name='field$i' value='".$row->name."'>";
    echo "<img src='/images/edit.png'   border='0' style='cursor:pointer'>";
    echo "<img src='/images/delete.gif'   border='0' style='cursor:pointer'>";
	echo "</br>";
}



$i=0;
?>

<input type="text" name="T1"><br>  
<span id="span1"></span>  
<a href="javascript:" onclick="addField()">新增欄位</a>  
<p><input type="submit" value="提交"><input type="reset" value="重新設定"></p>  
</form>  
<script>  
var count = 2;  
var countMax = 10;  
function addField() {  
if(count == countMax)  
alert("最多"+countMax+"個欄位");  
else      
 {document.getElementById("span1").innerHTML = document.getElementById("span1").innerHTML + (++count) + '<input type="text" name="T' + count + '"><br>';    
  document.form1.u.value= count ;
  }
  }

</script> 
<?

echo $_POST['T1'];
echo $_POST['num'];

?>
<input type="text" name="u" id="u" value="">
</form>
