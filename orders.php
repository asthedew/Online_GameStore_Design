<?php
session_start();
$pArray = $_POST['product_array'];
$pArray = rtrim($pArray, ",");
$pidArray = explode(",",$pArray);
$totalprice = 0;
include "storescripts/connect_to_mysql.php";
foreach($pidArray as $key => $value){
	$pq = explode("-", $value);
	$pid = $pq[0];
	$pQuantity = $pq[1];
	// total price calculate
	$sql = mysql_query("SELECT price FROM products WHERE pID='$pid' LIMIT 1");
	$existCount=mysql_num_rows($sql);
	if($existCount == 1){
		while($row=mysql_fetch_array($sql)){
		$price=$row["price"];
		}
	}
	$price = $price * $pQuantity;
	$totalprice = $totalprice + $price;
}

// insert data
//$order_sql = "INSERT INTO order(pid_array, totalprice) VALUES ('$pArray', '$totalprice')";
$sql = mysql_query("INSERT INTO orders(pid_array, cid, cemail, order_addr, order_city, order_state, order_country, order_zip, totalprice, date_added) VALUES ('$pArray', '4', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', '$totalprice', now())") or die(mysql_error());
//error_reporting(E_ALL);
//ini_set('display_errors','1');

?>
<?php
if(isset($_POST["username"])&&isset($_POST["password"]))
	{
		$username = preg_replace('#[^A-Za-z0-9]#i','',$_POST["username"]);
		$password = preg_replace('#[^A-Za-z0-9]#i','',$_POST["password"]); 
		$sql = mysql_query("SELECT id FROM customers WHERE username='$username' AND password='$password' LIMIT 1");
		$existCount=mysql_num_rows($sql);
		if($existCount == 1){
			while($row=mysql_fetch_array($sql)){
			$id=$row["id"];
			}
		}
		$sql = mysql_query("SELECT email FROM customers WHERE username='$username' AND password='$password' LIMIT 1");
		$existCount=mysql_num_rows($sql);
		if($existCount == 1){
			while($row=mysql_fetch_array($sql)){
			$email=$row["email"];
			}
		}
		$sql = mysql_query("SELECT addr FROM customers WHERE username='$username' AND password='$password' LIMIT 1");
		$existCount=mysql_num_rows($sql);
		if($existCount == 1){
			while($row=mysql_fetch_array($sql)){
			$address=$row["addr"];
			}
		}
		$sql = mysql_query("SELECT city FROM customers WHERE username='$username' AND password='$password' LIMIT 1");
		$existCount=mysql_num_rows($sql);
		if($existCount == 1){
			while($row=mysql_fetch_array($sql)){
			$city=$row["city"];
			}
		}
		$sql = mysql_query("SELECT state FROM customers WHERE username='$username' AND password='$password' LIMIT 1");
		$existCount=mysql_num_rows($sql);
		if($existCount == 1){
			while($row=mysql_fetch_array($sql)){
			$state=$row["state"];
			}
		}
		$sql = mysql_query("SELECT country FROM customers WHERE username='$username' AND password='$password' LIMIT 1");
		$existCount=mysql_num_rows($sql);
		if($existCount == 1){
			while($row=mysql_fetch_array($sql)){
			$country=$row["country"];
			}
		}
		$sql = mysql_query("SELECT zipcode FROM customers WHERE username='$username' AND password='$password' LIMIT 1");
		$existCount=mysql_num_rows($sql);
		if($existCount == 1){
			while($row=mysql_fetch_array($sql)){
			$zip=$row["zipcode"];
			}
		}
	
			// insert data
		//$sql = mysql_query("INSERT INTO orders(pid_array, cid, cemail, order_addr, order_city, order_state, order_country, order_zip, totalprice) VALUES ('$pArray', '$id', '$email', '$address', '$city', '$state', '$country', '$zip', '$totalprice')");
			
		mysql_close();
}
//else{
		//echo 'That information is incorrect, try again<a href="orders.php">&nbsp;Click Here</a>';
		//exit();
//}
?>

<!doctype html PUBLIC" -//W3C//DTD XHTML 1.0 Transitional//EH" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"utf-8"/>
<title>Customers LogIn</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen"/>
</head>
<body>
<div align="center" id="mainWrapper">
 <?php include_once("template_header.php");?>
 <div id="pageContent"><br/>
  <div align="left" style="margin-left:24px;">
    <h2>Check Out</h2>
    <form id="form1" name="form1" method="post" action="orders.php">
    UserName:<br/>
     <input name="username" type="text" id="username" size="40"/>
    <br/><br/>
    Password:<br/>
     <input name="password" type="password" id="password" size="40"/>
	 <br/>
     <br/>
     <br/> 		
      <input type="image" src="http://localhost/onlinestore/style/ordernow.jpg" name="submit" alt="OrderNow" width="50" height="50" border="0">
     </form>
     <p>&nbsp;</p>
  	</div>
    <br/>
 <br/>
 <br/>
 </div>
 <?php include_once("template_footer.php");?>
</div>
</body>
</html>