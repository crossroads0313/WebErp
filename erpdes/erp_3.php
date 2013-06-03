<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
報表下載
<form name="form1" method="post" id="form1" action="">
<input name="today_sale" type="button" value="今日銷售" onClick="window.open('./pro_excels.php?e=today_sale');">
<input name="today_delivery" type="button" value="今日出貨" onClick="window.open('./pro_excels.php?e=today_delivery');">
<input name="tomorrow_delivery" type="button" value="明日出貨" onClick="window.open('./pro_excels.php?e=tomorrow_delivery');">
<input type="submit" value="返回">
<input name="currentpage" id="currentpage" type="hidden"  value="<?php echo $currentpage;?> ">
<input name="sel_f"    id="sel_f"    type="hidden" value="<?php echo $sel_f    ?>"><!--搜尋條件-->
<input name="sel_k"    id="sel_k"    type="hidden" value="<?php echo $sel_k    ?>"><!--搜尋值--> 
 
</form>
</body>
</html>

