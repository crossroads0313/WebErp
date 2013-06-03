<?php
//  session_start(3600);
//  $sLanguage = isset($_SESSION['Language']) ? $_SESSION['Language'] : "TW";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF8">
<title><?php //echo constant("ITEM_AAB024"); ?></title><!--漢神超級商城後台系統-->
<!--
<script type="text/javascript" src="/js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="/js/jquery.form.js"></script>
<link rel="shortcut icon" href="/images/icon.gif">
-->
</head>
<body topmargin="0" >
<!--onResize="autosize()">-->
<?php /*---------------------------------------------------從這裡開始----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/?>
<script type="text/javascript">
  function showmenu(){
    if(document.getElementById('t1').style.display=='none'){
      document.getElementById('t1').style.display=''
      document.getElementById('t2').style.display='none'
    }else{
      document.getElementById('t1').style.display='none';
      document.getElementById('t2').style.display='';
    }
  };
  function getBrowserHeight() {
    if ($.browser.msie)
      return document.compatMode == "CSS1Compat" ? document.documentElement.clientHeight:document.body.clientHeight;
    else
      return self.innerHeight;
  }
  function autosize() {
    var H=(getBrowserHeight()-85)+'px';
    document.getElementById('erp_main1').style.height = H;
    document.getElementById('erp_main2').style.height = H;
    document.getElementById('menu1').style.height = H;
    document.getElementById('menu2').style.height = H;
  };
</script>
<?php /*---------------------------------------------------從這裡結束----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/?>          
  <!--     <div id='all_web' name='all_web'> 
    <table style="word-break:break-all;" border="1" width='1000' align="center" cellspacing="0" cellpadding="0"  >
   
	 <tr><td>
          <?php //include 'sys/sys_top.php';?>
      </td></tr>
	 
      <tr id='t1'>
        <td>
          <div id='erp_main1' style="height:500px;valign='top'; overflow:auto;" align="center">
		  --> 
            <?php
              $erp1=(isset($_GET['a']))?$_GET['a']:((isset($_POST['erp1']))?$_POST['erp1']:"PO");
              $erp2=(isset($_GET['b']))?$_GET['b']:((isset($_POST['erp2']))?$_POST['erp2']:"erp");
				//$erp3=(isset($_GET['c']))?$_GET['c']:((isset($_POST['erp3']))?$_POST['erp3']:"自營進銷存");
              $erp4=(isset($_POST['Typekey']))?$_POST['Typekey']:'';
              $erp4=($erp4=='E'||$erp4=='A')?'_2':(($erp4=='X')?'_3':(($erp4=='T'?'_4':'')));
			  
              include "c:/AppServ/www/erpdes/".$erp2.$erp4.".php";
            ?>
          <!--
		  </div>
        </td> 
      </tr>
      
	  <tr id='t2' style="display:none">
        <td><div id='erp_main2'>
          -->
		  <?php 
            //include 'sys/menu.php'; 
          ?>
        <!--
		</div></td> 
      </tr>
       <tr>
          <td>
             <?php //include 'sys/sys_foot.php'; ?>
          </td>
       </tr>
    </table>
  </div>
  <script type="text/javascript">
    autosize();
  </script>
  -->
</body>
</html>