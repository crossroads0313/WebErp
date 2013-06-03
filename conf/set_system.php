    <?
    //資料表欄位
	$field= array('id','name','sex','tel','orderdate','ordertime','getdate','gettime','address','note','total','p1','p2','p3','p4','p5','p6','p7','p8','p9','p10');
	//資料表表格名稱
	$field_title=array('訂單編號','姓名','性別','電話','訂購日期','訂購時間','取貨日期','取貨時間','取貨地點','備註','總金額','重乳酪蛋糕8吋','重乳酪蛋糕6吋','重乳酪蛋糕4吋','重乳酪蛋糕單片','原味奶酪','草莓奶酪','藍莓奶酪','巧克力奶酪','巧克力脆片奶酪','原味脆片奶酪');
	//產品表格名稱
	$product_title=array('重乳酪蛋糕8吋','重乳酪蛋糕6吋','重乳酪蛋糕4吋','重乳酪蛋糕單片','原味奶酪','草莓奶酪','藍莓奶酪','巧克力奶酪','巧克力脆片奶酪','原味脆片奶酪');
	//產品列表
	$product_list="p1,p2,p3,p4,p5,p6,p7,p8,p9,p10";
	//搜尋主要條件
	$fkey= array('id');
	//要使用那些欄位搜尋
	$fseach = array('getdate','id','name','tel','orderdate');
	//使用到之table
	$table="tb_order";
	$today_table="tb_todaysale";
	$sql_1= "SELECT * FROM $table";
    $todaysale_table="tb_todaysale";
	
	//取得時間
	$today_date=date("Ymd",strtotime("+8 hours"));
	$tomorrow_date=date("Ymd",strtotime("+1 day 8 hours"));
	$today_time=date("His",strtotime("+8 hours"));
	
	?>
	