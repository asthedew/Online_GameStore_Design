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
// Update the pending status
if(isset($_POST['order_number'])){
	$oid = mysql_real_escape_string($_POST['order_number']);
	$status = mysql_real_escape_string($_POST['order_status']);

	$sql=mysql_query("UPDATE orders SET status = '$status' WHERE oID ='$oid'") or die(mysql_error());
	
	// If the order has been shipped, The quantity of product will reduce one from table
	// If the quantitly of product become to zero, the product will delete from talbe
	$totalCount = 0;
	$pArray_sql = mysql_query("SELECT pid_array FROM orders WHERE oId ='$oid' LIMIT 1");
	$existCount=mysql_num_rows($pArray_sql);
	if($existCount == 1){
		while($row=mysql_fetch_array($pArray_sql)){
		$aProduct=$row["pid_array"];
		}
	}
	$pidArray = explode(",",$aProduct);	
	foreach($pidArray as $key=>$value)
	{
		$pq = explode("-", $value);
		$product_id = $pq[0];
		$pQuantity = $pq[1];
		$p_sql = mysql_query("SELECT quantity FROM products WHERE pID='$product_id' LIMIT 1");
		$existCount=mysql_num_rows($p_sql);
		if($existCount == 1){
			while($row=mysql_fetch_array($p_sql)){
			$product_count=$row["quantity"];
			}
		}
		$totalCount = $product_count - $pQuantity;
		if($totalCount>0)
		{
			$sql=mysql_query("UPDATE products SET quantity = '$totalCount' WHERE pID ='$product_id'") or die(mysql_error());
		}else{
			$sql=mysql_query("DELETE FROM products WHERE pId='$product_id'")or die(mysql_error());
		}
	}
	
	header("location:order_list.php");
	exit();
}
?>

<?php
// order condition from order table
$order_list='';
$order_sql = mysql_query("SELECT * FROM orders ORDER BY date_added DESC LIMIT 200");
$orderCount = mysql_num_rows($order_sql);


if($orderCount > 0 ){
	while($row = mysql_fetch_array($order_sql)){
		$oid = $row["oID"];
		$pid_array = $row["pid_array"];
		$cid = $row["cid"];
		$email = $row["cemail"];
		$addr = $row["order_addr"];
		$city =$row["order_city"];
		$state =$row["order_state"];
		$country =$row["order_country"];
		$zip =$row["order_zip"];
		$totalprice =$row["totalprice"];
		$status =$row["status"];
		$date_added =strftime("%b %d, %Y", strtotime($row["date_added"]));
		$order_list.= '<table width="100%" border="0" cellsspacing="0" cellpadding="6">
		<tr>
			<td width="83%" valign="top">Order No:&nbsp;&nbsp;' . $oid . '<br/>
			Order Product and Quantity:&nbsp;&nbsp;' .$pid_array . '<br/>
			Total Price:&nbsp;&nbsp;' .$totalprice. '<br/>
			Customer Id:&nbsp;&nbsp;' .$cid. '<br/>
			Email:&nbsp;&nbsp;' .$email. '<br/>
			Address:&nbsp;&nbsp;' .$addr. '<br/>
			State:&nbsp;&nbsp;' .$state. '<br/>
			Country:&nbsp;&nbsp;' .$country. '<br/>
			ZipCode:&nbsp;&nbsp;' .$zip. '<br/>
			Status:&nbsp;&nbsp;' .$status. '<br/>
			Order Date:&nbsp;&nbsp;' .$date_added. '<br/>
			</td>
		</tr>
</table>';
		}
	}else{
		echo "Order Does Not Exists.";
	}

// inventory condition	from product table	
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
<title>Manage Order</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
</head>

<body>
<div align="center" id="mainWrapper">
 <?php include_once("../template_header.php");?>
 <div id="pageContent"><br/>
 
 
 	<div align="left" style="margin-left:24px;">
 	<h2><em>&darr;Inventory List&nbsp;&nbsp;And&nbsp;&nbsp;Order List&darr;</em></h2>
 	<?php echo $order_list;?>
    <br/>
    <br/>
    <?php echo $product_list;?>
    </div>
 
    <a name="updateForm" id="updateForm"></a>
    <h1>
    <em>Ship Item to Customer</em></h1>
    <form action="order_list.php" enctype="multipart/form-data" name="myForm" id="myForm" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
     <tr>
     	<td width="20%">Order No</td>
        <td width="80%"><label>
        	<input name="order_number" type="text" id="order_number" size="64"/>
        </label></td>
     </tr>
    
     <tr>
     	<td align="left">Order Status</td>
        <td><label>
        	<select name="order_status" id="order_status">
            <option value=""></option>
            <option value="Pending">Pending</option>
            <option value="Shipped">Shipped</option>
            </select>
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