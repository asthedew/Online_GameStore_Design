<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors','1');
include "storescripts/connect_to_mysql.php";
?>
<?php
if(isset($_POST['pid'])){
	$pid=$_POST['pid'];
	$Found=false;
	$count=0;
	if(!isset($_SESSION["cart_array"])||count($_SESSION["cart_array"])<1){
		$_SESSION["cart_array"]=array(0=>array("item_id" => $pid, "quantity" => 1));
	}else{
		foreach($_SESSION["cart_array"] as $each_item){
			$count++;
			while(list($key,$value)=each($each_item)){
				if($key=="item_id" && $value== $pid){
					array_splice($_SESSION["cart_array"],$count-1,1,array(array("item_id"=>$pid, "quantity"=>$each_item['quantity']+1)));
					$Found=true;
				}
			}
		}
		if($Found==false){
			array_push($_SESSION["cart_array"],array("item_id" => $pid, "quantity"=>1));
		}
	}
	header("location:shoppingcart.php");
	exit();
}
?>
<?php
if(isset($_GET['cmd'])&&$_GET['cmd']=="emptycart"){
	unset($_SESSION["cart_array"]);
}
?>
<?php
if(isset($_POST['quantity_count'])&&$_POST['quantity_count']!=""){
	$remove_quan=$_POST['quantity_count'];
	if(count($_SESSION["cart_array"])<=1){
		unset($_SESSION["cart_array"]);
	}else{
		unset($_SESSION["cart_array"]["$remove_quan"]);
		sort($_SESSION["cart_array"]);
	}
}
?>
<?php
$cart="";
$totalcart="";
$order_checkout='';
$array_product='';
if(!isset($_SESSION["cart_array"])||count($_SESSION["cart_array"])<1){
	$cart="<h1 align='center'>Dear Customer You does not buy anything</h1>";
}else{
	$order_checkout.='<form action="http://localhost/onlinestore/orders.php" method="post">';
	$count = 0;
	foreach($_SESSION["cart_array"] as $each_item){
		$item_id = $each_item['item_id'];
		$sql = mysql_query("SELECT * FROM products WHERE pID='$item_id' LIMIT 1");
		while($row=mysql_fetch_array($sql)){
			$product_name=$row["product_name"];
			$price=$row["price"];
			$details=$row["details"];
		}
		$totalprice = $price * $each_item['quantity'];
		$totalcart = $totalprice + $totalcart;
		$index=$count+1;
		$order_checkout.='<input type="hidden" name="item_name_'.$index.'" value="'.$product_name.'">
		<input type="hidden" name="amount_'.$index.'" value="'.$price.'">
		<input type="hidden" name="quantity_'.$index.'" value="'.$each_item['quantity'].'">';
		$array_product.="$item_id-".$each_item['quantity'].",";
		
		///////////////////////////////////////////////////////////
		$cart.="<tr>";
		$cart.='<td><a href="product.php?id='.$item_id.'">'.$product_name.'</a><br/><img src="inventory_image/'.$item_id.'.jpg" width="100" height="130"</td>';
		$cart.='<td>' . $details .'</td>';
		$cart.='<td>US $' . $price .'</td>';
		$cart.='<td>' . $each_item['quantity'] .'</td>';
		$cart.='<td>US $' . $totalprice .'</td>';
		$cart.='<td><form action = "shoppingcart.php" method = "post"><input name="remove'.$item_id.'" type = "submit" value="Remove"/><input name="quantity_count" type="hidden" value="'.$count.'"/></form></td>';
		$cart.="</tr>";
		$count++;
	}
	$totalcart="Cart Total: US $".$totalcart. "";
	/////////////////////////////////////////////////////////////////
	
	$order_checkout.='<input type="hidden" name="product_array" value="'.$array_product.'">
	<input type="image" src="http://localhost/onlinestore/style/buybutton.jpg" name="buybutton" alt="BuyButton" width="300" height="100" border="0">
	</form>';
}
?>
<!doctype html PUBLIC" -//W3C//DTD XHTML 1.0 Transitional//EH" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset="utf-8"/>
<title>Shopping Cart</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen"/>
</head>
<body>
<div align="center" id="mainWrapper">
	<?php include_once("template_header.php");?>
    <div id="pageContent">
   	  <div style="margin:24px; text-align:left;">   
        <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="6">
        	<tr>
            	<td width="18%" align="center" valign="middle" bgcolor="#CCCCCC"><em>Product</em></td>
                <td width="42%" align="center" valign="middle" bgcolor="#CCCCCC"><em>Description</em></td>
                <td width="11%" align="center" valign="middle" bgcolor="#CCCCCC"><em>Unit Price</em></td>
                <td width="9%" align="center" valign="middle" bgcolor="#CCCCCC"><em>Quantity</em></td>
                <td width="11%" align="center" valign="middle" bgcolor="#CCCCCC"><em>Total Price</em></td>
                <td width="11%" align="center" valign="middle" bgcolor="#CCCCCC"><em>Remove Item</em></td>
            </tr>
            <?php echo $cart; ?>       		
        </table>
        <br/>
        <a href= "shoppingcart.php?cmd=emptycart"><em>Remove All Item From Cart</em><em></em></a>
        </div>
        <?php echo $totalcart ?>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        <?php echo $order_checkout ?>
  </div>
     <?php include_once("template_footer.php");?>
</div>
</body>
</html>