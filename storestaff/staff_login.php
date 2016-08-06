<?php
session_start();
//if(isset($_SESSION["staff"])){
	//header("location:staff_login.php");
	//exit();
//}
?>
<?php
// Parse the login form if the user has filled it out and pressed "Log in"
if(isset($_POST["username"])&&isset($_POST["password"])){
	
	$staff = preg_replace('#[^A-Za-z0-9]#i','',$_POST["username"]);// filter everything but numbers and letters
	$password = preg_replace('#[^A-Za-z0-9]#i','',$_POST["password"]); // filter everything but numbers and letters
	include "../storescripts/connect_to_mysql.php";
	$sql = mysql_query("SELECT id FROM staff WHERE username='$staff' AND password='$password' LIMIT 1");
	$existCount=mysql_num_rows($sql);
	if($existCount == 1){
	while($row=mysql_fetch_array($sql)){
		$id=$row["id"];
	}
	$_SESSION["id"]=$id;
	$_SESSION["staff"]=$staff;
	$_SESSION["password"]=$password;
	header("location:staff_index.php");
	exit();
	}else{
		echo 'That information is incorrect, try again<a href="staff_login.php">Click Here</a>';
		exit();
	}
}
?>
<!doctype html PUBLIC" -//W3C//DTD XHTML 1.0 Transitional//EH" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"utf-8"/>
<title>Staff LogIn</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
</head>

<body>
<div align="center" id="mainWrapper">
 <?php include_once("../template_header.php");?>
 <div id="pageContent"><br/>
  <div align="left" style="margin-left:24px;">
    <h2>Please LogIn to Manage the Store</h2>
    <form id="form1" name="form1" method="post" action="staff_login.php">
    UserName:<br/>
     <input name="username" type="text" id="username" size="40"/>
    <br/><br/>
    Password:<br/>
     <input name="password" type="password" id="password" size="40"/>
	 <br/>
     <br/>
     <br/> 		
      <input type="submit" name="button" id="button" value="LogIn"/>
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