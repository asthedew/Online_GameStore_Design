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
//error_reporting(E_ALL);
//ini_set('display_errors','1');
?>
<?php
if(isset($_POST['product_name'])){
	$product_name = mysql_real_escape_string($_POST['product_name']);
	$price = mysql_real_escape_string($_POST['price']);
	$quantity = mysql_real_escape_string($_POST['quantity']);
	$details = mysql_real_escape_string($_POST['details']);
	$category= mysql_real_escape_string($_POST['category']);
	$subcategory = mysql_real_escape_string($_POST['subcategory']);

	$sql=mysql_query("SELECT pID FROM products WHERE product_name='$product_name' LIMIT 1");
	$productMatch=mysql_num_rows($sql);
	if($productMatch > 0){
		$sql=mysql_query("UPDATE products SET quantity = quantity+$quantity WHERE product_name='$product_name'");
		header("location:inventory_list.php");
		exit();
	}
	$sql = mysql_query("INSERT INTO products(product_name, price, quantity, details, category, subcategory, date_added) VALUES ('$product_name','$price', '$quantity', '$details', '$category', '$subcategory', now())") or die(mysql_error());
	
	$pid=mysql_insert_id();
	$newname="$pid.jpg";
	move_uploaded_file($_FILES['fileField']['tmp_name'],"../inventory_images/$newname");
}
?>
<?php
$product_list ="";
$sql=mysql_query("SELECT * FROM products ORDER BY date_added DESC");
$productCount=mysql_num_rows($sql); 
if($productCount > 0){
	while($row=mysql_fetch_array($sql)){
		$pid=$row["pID"];
		$pProduct_name=$row["product_name"];
		$pQuantity = $row["quantity"];
		$pPrice = $row["price"];
		$pDate_added=strftime("%b %d,%Y",strtotime($row["date_added"]));
		$product_list.= '<table width="100%" border="0" cellsspacing="0" cellpadding="6">
	<tr>
		<td width="17%" valign="top"><img style="border:#666 1px solid;" src="../inventory_image/'.$pid.'.jpg" alt="' . $pProduct_name . '" width="77" height="102" border="1" /></td>
		<td width="83%" valign="top">Product:&nbsp;&nbsp;' . $pProduct_name . '<br/>
		Unit Price: US&nbsp;$' .$pPrice . '<br/>
		Quantity:&nbsp;&nbsp;' .$pQuantity. '<br/>
		<a href="#">Edit</a>
		<a href="#">Delete</a></td>
	</tr>
</table>';
	}
}else{
	$product_list ="You have no products listed in your store yet";	
}
?>
<!doctype html PUBLIC" -//W3C//DTD XHTML 1.0 Transitional//EH" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"utf-8"/>
<title>Inventory List</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
</head>

<body>
<div align="center" id="mainWrapper">
 <?php include_once("../template_header.php");?>
 <div id="pageContent"><br/>
 	<div align="right" style="margin-right:32px;"><a href="inventory_list.php#inventoryForm"><a href="#">Search and Update Item</a></div>
 <div align="left" style="margin-left:24px;">
 	<h2>Inventory List</h2>
 	<?php echo $product_list;?>
    </div>
    <a name="inventoryForm" id="inventoryForm"></a>
    <h1>
    <em>Restock Item Or Add New Inventory Item</em></h1>
    <form action="inventory_list.php" enctype="multipart/form-data" name="myForm" id="myForm" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
     <tr>
     	<td width="20%">Product Name</td>
        <td width="80%"><label>
        	<input name="product_name" type="text" id="product_name" size="64"/>
        </label></td>
     </tr>
     <tr>
     	<td>Product Price</td>
        <td><label>
        	<input name="price" type="text" id="price" size="12"/>
        </label></td>
     </tr>
     <tr>
     	<td align="left"><em>Quantity</em></td>
        <td><label>
        	<input name="quantity" type="text" id="quantity" size="12"/>
        </label></td>
     </tr>
     <tr>
     	<td>Product Details</td>
        <td><label>
        	<input name="details" id="details" type="text" size="100"/>
        </label></td>
     </tr>
     <tr>
     	<td align="left">Category</td>
        <td><label>
        	<select name="category" id="category">
            <option value=""></option>
            <option value="VideoGames">Video Games</option>
            <option value="GameConsole">Game Console</option>
            <option value="Accessory">Accessory</option>
            </select>
        </label></td>
     </tr>
     <tr>
     	<td align="left">Subcategory</td>
        <td><select name="subcategory" id="subcategory">
        <option value=""></option>
        <option value="XboxOne">Xbox One</option>
        <option value="PlayStation">PlayStation</option>
        </select></td>
     </tr>     
     <tr>
     	<td>Product Image</td>
        <td><label>
        	<input type="file" name="fileField" id="fileField"/>
        </label></td>
     </tr>
     <tr>
     	<td>&nbsp;</td>
        <td><label>
        	<input type="submit" name="button" id="button" value="Add This Item"/>
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