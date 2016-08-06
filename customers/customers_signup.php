<?php
session_start();
//if(isset($_SESSION["customers"])){
	//header("location:index.php");
	//exit();
//}
?>
<?php
include "../storescripts/connect_to_mysql.php";
if(isset($_REQUEST['submit'])!="")
{
	if($_REQUEST["username"]=="" || $_REQUEST["password"]==""|| $_REQUEST["firstname"]=="" || $_REQUEST["lastname"]=="" || $_REQUEST["email"]== ""|| $_REQUEST["addr"]==""|| $_REQUEST["city"]=="" || $_REQUEST["state"]=="" || $_REQUEST["country"]=="" || $_REQUEST["zipcode"]=="" || $_REQUEST["phone"]==""){
		echo "please fill the empty field.";
	}else{
		$user_check = mysql_query("SELECT username FROM customers WHERE username='$username'");
		$do_user_check = mysql_num_rows($user_check);
		$password_check = mysql_query("SELECT password FROM customers WHERE password ='$password'");
		$do_password_check = mysql_num_rows($password_check);
		$email_check = mysql_query("SELECT email FROM customers WHERE email='$email'");
		$do_email_check = mysql_num_rows($email_check);
		
		if($do_user_check > 0){
			die("Username is already in use!<br>");
		}
		if($do_email_check > 0){
			die("Email is already in use!");
		}
		
		$sql = "INSERT INTO customers (username, password, firstname, lastname, email, addr, city, state, country, zipcode, phone) VALUES ('".$_REQUEST["username"]."', '".$_REQUEST["password"]."', '".$_REQUEST["firstname"]."', '".$_REQUEST["lastname"]."', '".$_REQUEST["email"]."', '".$_REQUEST["addr"]."', '".$_REQUEST["city"]."', '".$_REQUEST["state"]."', '".$_REQUEST["country"]."', '".$_REQUEST["zipcode"]."', '".$_REQUEST["phone"]."')";
		
		$res=mysql_query($sql);
		if($res)
		{
			echo "Registration sucesseful";
		}else{
			echo "There is some problem in inserting record";
		}
	}
}
?>

<!doctype html PUBLIC" -//W3C//DTD XHTML 1.0 Transitional//EH" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"utf-8"/>
<title>Customer Registration</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
</head>

<body>
<div align="center" id="mainWrapper">
 <?php include_once("../template_header.php");?>
 <div id="pageContent"><br/>
  <div align="left" style="margin-left:24px;">
    <h2>Customer LogIn</h2>
    <form  name="registration" method="post" action="customers_signup.php">
   UserName :<input name = "username" type="text" value="" size="40"/><br/>
    <br/>
   Password :<input name="password" type="password" value="" size="40"/><br/>
	<br/>
   Firstname :<input name="firstname" type="text" value="" size="40"/>
   Lastname :<input name="lastname" type="text" value="" size="40"/><br/>
    <br/> 
   Email :<input name="email" type="text" value="" size="40"/><br/>
    <br/>
   Address :<input name="addr" type="text" value="" size="40"/><br/>
    <br/>
   City :<input name="city" type="text" value="" size="40"/><br/>
    <br/>
   State :<input name="state" type="text" value="" size="40"/><br/>
    <br/>
   Country :<input name="country" type="text" value="" size="40"/><br/>
    <br/>
   Zipcode :<input name="zipcode" type="text" value="" size="40"/><br/>
    <br/>
   PhoneNo :<input name="phone" type="text" value="" size="40"/><br/>
    <br/>
    	<input type="submit" name="submit" value="Registration"/>
     </form>
     <p>&nbsp;</p>
  	</div>
    <br/>
 <br/>
 <br/>
 </div>
 <?php include_once("../template_footer.php");?>
</div>
</body>
</html>
