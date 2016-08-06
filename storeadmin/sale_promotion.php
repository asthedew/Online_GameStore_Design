<?php
session_start();
if(!isset($_SESSION["manager"])){
	header("location:admin_login.php");
	exit();
}
// Be sure to check that this manager SESSION value is in fact in thee database
$managerID = preg_replace('#[^0-9]#i','',$_SESSION["id"]); //filter everything but numbers and letters
$manager = preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["manager"]);// filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]); // filter everything but numbers and letters
include "../storescripts/connect_to_mysql.php";
$sql = mysql_query("SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1");
$existCount = mysql_num_rows($sql);

if($existCount == 0){
	echo "Your login session data is not on record in the database.";
	exit();
}
?>
<?php
if(isset($_POST['product_number'])){
	$product_id = mysql_real_escape_string($_POST['product_number']);
	$new_price = mysql_real_escape_string($_POST['new_price']);

	$sql=mysql_query("UPDATE products SET price = '$new_price' WHERE pID ='$product_id'") or die(mysql_error());
	
	header("location:sale_promotion.php");
	exit();
}
?>
<?php

// Look up the Sales
	$sales='';
	$salse_price=0;
	$order_sql = mysql_query("SELECT * FROM orders ORDER BY date_added DESC LIMIT 200")or die(mysql_error());
	$orderCount = mysql_num_rows($order_sql);
	if($orderCount > 0 ){
		while($row = mysql_fetch_array($order_sql)){
			$tPrice = $row["totalprice"];
			$sales_price = $sales_price + $tPrice;
		}
	}
	$sales.='<table width="200%" border="0" cellsspacing="0" cellpadding="6">
		<tr>
			<td width="150%" valign="top"><h3>Sales performance For This Month:&nbsp;&nbsp;US&nbsp;&nbsp;$' . $sales_price . '</h3></td>
		</tr>
</table>';

// inventory condition from product table	
$product_list='';
$product_sql = mysql_query("SELECT * FROM products ORDER BY date_added DESC LIMIT 200");
$productCount = mysql_num_rows($product_sql);

if($productCount > 0){
	while($row = mysql_fetch_array($product_sql)){
		$pid = $row["pID"];
		$product_name=$row["product_name"];
		$price = $row["price"];
		$pQuantity = $row["quantity"];
		$product_list.= '<table width="100%" border="0" cellsspacing="0" cellpadding="6">
		<tr>
			<td width="17%" valign="top"><img style="border:#666 1px solid;" src="../inventory_image/'.$pid.'.jpg" alt="' . $product_name . '" width="77" height="102" border="1" /></td>
			<td width="83%" valign="top">Product No:&nbsp;&nbsp;' . $pid . '<br/>
			Unit Price: US&nbsp;$' .$price . '<br/>
			Quantity:&nbsp;&nbsp;' .$pQuantity. '<br/>
			</td>
		</tr>
</table>';
		}
	}else{
		echo "Product Does Not Exists.";
	}			
				
mysql_close();
?>

<!doctype html PUBLIC" -//W3C//DTD XHTML 1.0 Transitional//EH" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"utf-8"/>
<title>Promotion</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
</head>

<body>
<div align="center" id="mainWrapper">
 <?php include_once("../template_header.php");?>
 <div id="pageContent"><br/>
 
 
 	<div align="left" style="margin-left:24px;">
 	<h2><em>Which Product You Want to Update</em></h2>
 	<?php echo $product_list;?> <?php echo $sales; ?>
    </div>
 
    <a name="updateForm" id="updateForm"></a>
    <h1>
    <em>Update the Sale Promotion</em></h1>
    <form action="sale_promotion.php" enctype="multipart/form-data" name="myForm" id="myForm" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
     <tr>
     	<td width="20%">Product No</td>
        <td width="80%"><label>
        	<input name="product_number" type="text" id="product_number" size="64"/>
        </label></td>
     </tr>
    
	 <tr>
     	<td width="20%">Enter New Price</td>
        <td width="80%"><label>
        	<input name="new_price" type="text" id="new_price" size="64"/>
        </label></td>
     </tr>
     
     <tr>
     	<td>&nbsp;</td>
        <td><label>
        	<input type="submit" name="button" id="button" value="Update"/>
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