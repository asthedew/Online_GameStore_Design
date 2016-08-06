<?php
session_start();
if(!isset($_SESSION["customers"])){
	header("location:customers_login.php");
	exit();
}
// Be sure to check that this manager SESSION value is in fact in thee database
$customersID = preg_replace('#[^0-9]#i','',$_SESSION["id"]); 
$customers = preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["customers"]);
$password = preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]); 
include "../storescripts/connect_to_mysql.php";
$sql = mysql_query("SELECT * FROM customers WHERE id='$customersID' AND username='$customers' AND password='$password' LIMIT 1");
$existCount = mysql_num_rows($sql);

if($existCount == 0){
	echo "Your login session data is not on record in the database.";
	exit();
}
?>
<?php
if(isset($_POST['customer_name'])){
	// Find Customer Id in the Table
	$cName = mysql_real_escape_string($_POST['customer_name']);

	$c_sql=mysql_query("SELECT * FROM customers WHERE username ='$cName' LIMIT 1")or die(mysql_error());
	$c_Count = mysql_num_rows($c_sql);
	if($c_Count > 0 ){
		while($row = mysql_fetch_array($c_sql)){
			$cid=$row["id"];
		}
	}

	// Order History
	$history='';
	$order_sql = mysql_query("SELECT * FROM orders WHERE cid = '$cid' LIMIT 100")or die(mysql_error());
	$orderCount = mysql_num_rows($order_sql);
	if($orderCount > 0 ){
		while($row = mysql_fetch_array($order_sql)){
			$oid=$row["oID"];
			$email=$row["cemail"];
			$address=$row["order_addr"];
			$city=$row["order_city"];
			$state=$row["order_state"];
			$country=$row["order_country"];
			$zip=$row["order_zip"];
			$tPrice = $row["totalprice"];
			$status =$row["status"];
			$date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));	
			$history.='<table width="100%" border="0" cellsspacing="0" cellpadding="6">
		<tr>
			<td width="83%" valign="top">Order No:&nbsp;&nbsp;' . $oid . '<br/>
			Confirm Email:&nbsp;&nbsp;' .$email. '<br/>
			Ship Address:&nbsp;&nbsp;' .$address. '<br/>
			Ship City:&nbsp;&nbsp;' .$city. '<br/>
			Ship State:&nbsp;&nbsp;' .$state. '<br/>
			Ship Country:&nbsp;&nbsp;' .$country. '<br/>
			Confirm ZipCode:&nbsp;&nbsp;' .$zip. '<br/>
			Cost:&nbsp;&nbsp;' .$tPrice. '<br/>
			Order Date:&nbsp;&nbsp;' .$date_added. '<br/>
			Status:&nbsp;&nbsp;' .$status. '<br/>
			</td>
		</tr>
</table>';
		}
	}

	header("location:order_history.php");
	exit();
}
?>
<?php
mysql_close();
?>
<!doctype html PUBLIC" -//W3C//DTD XHTML 1.0 Transitional//EH" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"utf-8"/>
<title>Order History</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
</head>

<body>
<div align="center" id="mainWrapper">
 <?php include_once("../template_header.php");?>
 <div id="pageContent"><br/>
 
 
 	<div align="left" style="margin-left:24px;">
 	<h2><em>Wishes Your Shopping Happily</em></h2>
 	<?php echo $history; ?> 
    </div>
 
    <a name="updateForm" id="updateForm"></a>
    <h1>
    <em>Order History</em></h1>
    <form action="order_history.php" enctype="multipart/form-data" name="myForm" id="myForm" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6"> 
    <tr>
     	<td width="20%">Username</td>
        <td width="80%"><label>
        	<input name="customer_name" type="text" id="customer_name" size="64"/>
        </label></td>
     </tr>
     <tr>
     	<td>&nbsp;</td>
        <td><label>
        	<input type="submit" name="button" id="button" value="Looking For Order History"/>
     		</label></td>
     	<tr>
	</table>
    </form>
 	<br/>
 <br/>
 </div>
 <?php include_once("../template_footer.php");?>
</div>
</body>
</html>