<?php
session_start();
if(!isset($_SESSION["manager"])){
	header("location:admin_login.php");
	exit();
}
// Be sure to check that this manager SESSION value is in fact in thee database
$managerID=preg_replace('#[^0-9]#i','',$_SESSION["id"]); //filter everything but numbers and letters
$manager=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["manager"]);// filter everything but numbers and letters
$password=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]); // filter everything but numbers and letters
include "../storescripts/connect_to_mysql.php";
$sql=mysql_query("SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1");
$existCount=mysql_num_rows($sql);
if($existCount==0){
	echo "Your login session data is not on record in the database.";
	exit();
}
?>
<!doctype html PUBLIC" -//W3C//DTD XHTML 1.0 Transitional//EH" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"utf-8"/>
<title>Manager Page</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
</head>

<body>
<div align="center" id="mainWrapper">
 <?php include_once("../template_header.php");?>
 <div id="pageContent"></div>
 <div align="left" style="margin-left:24px;">
 <h2><em>Manager Page</em></h2>
 <em> Authority:
 </em>
 <p><em><a href="inventory_list.php">Inventory</a><br/>
     <a href="inventory_list.php">Update Inventory</a><br/>
     <a href="order_list.php">Manage Order</a><br/>
     <a href="sale_promotion.php">Sale Promotion</a></em><br/>
 </p>
 </div>
 <br/>
<br/>
<br/>
</div>
 <?php include_once("../template_footer.php");?>
</div>
</body>
</html>