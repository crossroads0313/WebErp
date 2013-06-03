<?php
 $field= array('id','name','sex','tel','orderdate','ordertime','getdate','gettime','address','note','total','p1','p2','p3','p4','p5','p6','p7','p8','p9','p10');
$field_title=array('訂單編號','姓名','性別','電話','訂購日期','訂購時間','取貨日期','取貨時間','取貨地點','備註','總金額','重乳酪蛋糕8吋','重乳酪蛋糕6吋','重乳酪蛋糕4吋','重乳酪蛋糕單片','原味奶酪','草莓奶酪','藍莓奶酪','巧克力奶酪','巧克力脆片奶酪','原味脆片奶酪');
		$product_title=array('p1','p2','p3','p4','p5','p6','p7','p8','p9','p10');
		$product_list="p1,p2,p3,p4,p5,p6,p7,p8,p9,p10";
		$table="tb_toadysale";
		$sql_1= "SELECT * FROM $table";
		$today_date=date("Ymd");
		$tomorrow_date=date("Ymd",strtotime("+1 day"));
		$today_time=date("His",strtotime("+8 hour"));
		$excel_cmd="$row[id]\t$row[date]\t$row[time]\t$row[p1]\t$row[p2]\t$row[p3]\t$row[p4]\t$row[p5]\t$row[p6]\t$row[p7]\t$row[p8]\t$row[p9]\t$row[p10]\t$row[total]\n";
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=".$todate."salenum.xls");
//資料庫連線 
    if(file_exists("conf/config_connmysql.php"))
    require_once("conf/config_connmysql.php");
	else 
    require_once("../conf/config_connmysql.php");	
$rs = mysql_query($sql_1);
for($i=0;$i<sizeof($field_title);$i++)
{
echo mb_convert_encoding("$field_title[$i]\t","big5","UTF-8");
}
echo "\n";
while($row = mysql_fetch_array($rs)){
echo mb_convert_encoding("excelcmd","big5","UTF8");
  }
?>