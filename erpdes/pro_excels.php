<?php

//設定欄位相關資料
$field= array('id','name','sex','tel','orderdate','ordertime','getdate','gettime','address','note','total','p1','p2','p3','p4','p5','p6','p7','p8','p9','p10');
$field_title=array('訂單編號','姓名','性別','電話','訂購日期','訂購時間','取貨日期','取貨時間','取貨地點','備註','總金額','p1','p2','p3','p4','p5','p6','p7','p8','p9','p10');
$product_title=array('p1','p2','p3','p4','p5','p6','p7','p8','p9','p10');
$product_sqllist="p1,p2,p3,p4,p5,p6,p7,p8,p9,p10";
//設定資料表
$table="tb_order";
$todaysale_table="tb_todaysale";

//取得時間
	$today_date=date("Ymd",strtotime("+8 hours"));
	$tomorrow_date=date("Ymd",strtotime("+1 day 8 hours"));
	$today_time=date("His",strtotime("+8 hours"));
	
//取得狀態
$status=$_GET['e'];
//資料庫連線 
    if(file_exists("conf/config_connmysql.php"))
    require_once("conf/config_connmysql.php");
	else 
    require_once("../conf/config_connmysql.php");	
	header("Content-type:application/vnd.ms-excel");
	//取得狀態值判斷如何處理
	if($status=='today_sale'){
    header("Content-Disposition:filename=sale_$today_date.xls");
	$sql="select * from $todaysale_table"; 
	}elseif($status=='today_delivery'){
	header("Content-Disposition:filename=delivery_$today_date.xls");
	$sql="select * from $table where getdate='$today_date'";
	}else{
	header("Content-Disposition:filename=delivery_$tomorrow_date.xls");
	$sql="select * from $table where getdate='$tomorrow_date'";
	}
	$rs = mysql_query($sql);
	for($i=0;$i<sizeof($field_title);$i++)
	{
	echo mb_convert_encoding("$field_title[$i]\t","big5","UTF-8");
	}
	echo "\n";
	while($row = mysql_fetch_array($rs)){
	echo mb_convert_encoding("$row[id]\t$row[name]\t$row[sex]\t$row[tel]\t$row[orderdate]\t$row[ordertime]\t$row[getdate]\t$row[gettime]\t$row[address]\t$row[note]\t$row[total]\t$row[p1]\t$row[p2]\t$row[p3]\t$row[p4]\t$row[p5]\t$row[p6]\t$row[p7]\t$row[p8]\t$row[p9]\t$row[p10]\n ","big5","UTF8");
	}
?>