<?php
session_start();
if(!isset($_SESSION["customers"])){
	header("location:customers_login.php");
	exit();
}
// Be sure to check that this manager SESSION value is in fact in thee database
$customersID=preg_replace('#[^0-9]#i','',$_SESSION["id"]); //filter everything but numbers and letters
$customers=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["customers"]);// filter everything but numbers and letters
$password=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]); // filter everything but numbers and letters
include "../storescripts/connect_to_mysql.php";
$sql=mysql_query("SELECT * FROM customers WHERE id='$customersID' AND username='$customers' AND password='$password' LIMIT 1");
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
<title>Customers Page</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
</head>

<body>
<div align="center" id="mainWrapper">
 <?php include_once("../template_header.php");?>
 <div id="pageContent"></div>
 <div align="left" style="margin-left:24px;">
 <h2><strong>Success to LogIn. Wishes Your Shopping Happily</strong></h2>
 <em> Authority:
 </em>
 <p><em><a href="order_history.php">Order History</a><br/></em><br/>
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