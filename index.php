<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<?php
// Run a select query to get my letest 6 items
include "storescripts/connect_to_mysql.php";
$dynamicList ="";
$sql = mysql_query("SELECT * FROM products ORDER BY date_added DESC LIMIT 200");
$productCount = mysql_num_rows($sql);
if($productCount > 0){
	while($row = mysql_fetch_array($sql)){
		$id = $row["pID"];
		$product_name = $row["product_name"];
		$price = $row["price"];
		$date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
		$dynamicList.= '<table width="100%" border="0" cellsspacing="0" cellpadding="6">
	<tr>
		<td width="17%" valign="top"><a href ="product.php?"><img style="border:#666 1px solid;" src="inventory_image/'.$id.'.jpg" alt="' . $product_name . '" width="77" height="102" border="1" /></a></td>
		<td width="83%" valign="top">' . $product_name . '<br/>
		US&nbsp;$' .$price . '<br/>
		<a href="product.php?id= ' . $id . '">View Product Details</a></td>
	</tr>
</table>';
	}
}else{
	$dynamicList = "We have no products listed in our store yet";
}
mysql_close();
?>

<!doctype html PUBLIC" -//W3C//DTD XHTML 1.0 Transitional//EH" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"utf-8"/>
<title>Online Store HomePage</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen"/>
</head>

<body>
<div align="center" id="mainWrapper">
 <?php include_once("template_header.php");?>
 <div id="pageContent">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
 	<tr>
 		<td width="20%" align="center" valign="top"><p>Advertisement</p>
        <p><img style="border:#666 1px solid;" src="style/advertisement1.jpg" alt="Ad1" width="156" height="444" border="1"/></p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        </td>
    	<td width="59%" valign="top"><p>Newest Item Added to the Store</p>
   	    	<p><?php echo $dynamicList;?><br/>
        		</p>
    
            <table width="100%" border="0" cellspacing="0" cellpadding="6">
            	<tr>
        			<td width="15%" valign="top"><a href="product.php?"><img style="border:#666 1px solid;" src="inventory_image/1.jpg" alt="$dynamicTitle" width="156" height="153" border="1"/></a></td>
        			<td width="83%" valign="top"><em>Product: Halo:The master Chief Collection - Microsoft Xbox One<br/>
        			Product Price: US $29.99<br/>
        			Free Shipping</a></em></td>
       			</tr>
       		</table>
            
            <table width="100%" border="0" cellspacing="0" cellpadding="6">
            	<tr>
        			<td width="15%" valign="top"><a href="product.php?"><img stylee="border:#666 1px solid;" src="inventory_image/2.jpg" alt="$dynamicTitle" width="156" height="153" border="1"/></a></td>
        			<td width="83%" valign="top"><em>Product: The Crew Xbox One Game Brand New Sealed **Clearance**<br/>
        			Price: US $27.95<br/>
        			Free Shipping</a></em><a href="product.php?"></a></td>
       			</tr>
       		</table>
            
            <table width="100%" border="0" cellspacing="0" cellpadding="6">
            	<tr>
        			<td width="15%" valign="top"><a href="product.php?"><img stylee="border:#666 1px solid;" src="inventory_image/3.jpg" alt="$dynamicTitle" width="156" height="153" border="1"/></a></td>
        			<td width="83%" valign="top"><em>Product: Fifa Soccer 14 - Brand New Sealed 2014 Xbox One<br/>
        			Price: US $22.99<br/>
        			Free Shipping</a></em></td>
       			</tr>
       		</table>
            
            <table width="100%" border="0" cellspacing="0" cellpadding="6">
            	<tr>
        			<td width="15%" valign="top"><a href="product.php?"><img stylee="border:#666 1px solid;" src="inventory_image/4.jpg" alt="$dynamicTitle" width="156" height="153" border="1"/></a></td>
        			<td width="83%" valign="top">Product: Fighter Within Microsoft Xbox One<br/>
        			Price: US $13.99<br/>
        			Free Shipping</a></td>
       			</tr>
       		</table>
            
            <table width="100%" border="0" cellspacing="0" cellpadding="6">
            	<tr>
        			<td width="15%" valign="top"><a href="product.php?"><img stylee="border:#666 1px solid;" src="inventory_image/5.jpg" alt="$dynamicTitle" width="156" height="153" border="1"/></a></td>
        			<td width="83%" valign="top"><em>Product: Madden NFL 15 Ultimate Edition Brand New Sealed - Xbox One<br/>
        			Price: US $74.95<br/>
        			Free Shipping</a></em></td>
       			</tr>
       		</table>
            
            <table width="100%" border="0" cellspacing="0" cellpadding="6">
            	<tr>
        			<td width="15%" valign="top"><a href="product.php?"><img stylee="border:#666 1px solid;" src="inventory_image/6.jpg" alt="$dynamicTitle" width="156" height="153" border="1"/></a></td>
        			<td width="83%" valign="top"><em>Product: Evolve - Xbox One<br/>
        			Price: US $48.95<br/>
        			Free Shipping</a></em><a href="product.php?"></a></td>
       			</tr>
       		</table>
            
   	    	<p><br/>
        	</p></td>
    	<td width="20%" align="center" valign="top"><p>Advertisement</p>
        <p><img style="border:#666 1px solid;" src="style/advertisement2.jpg" alt="Ad2" width="156" height="444" border="1"/></p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        </td>
	</tr>
 </table>
 </div>
 <?php include_once("template_footer.php");?>

</div>
</body>
</html>