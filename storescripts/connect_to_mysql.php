<?php
// Created BY Lupei Wang
/*
1: "die()" will exit the script and show an error statement if something goes wrong with the "connect" or "select" functions.
2: A "mysql_connect()" error usually means your username/password are wrong.
3: A "mysql_select_db()" error usually means the database does not exit.
*/
// Place db host name. Somettimes "localhost" but
// sometimes looks like this:>> ???mysql??.someserver.net
$db_host = "localhost";
// Place the username for the MySQL database here
$db_username = "root";
// Place the password for the MySQL database here
$db_pass = "xiaohuxixia821";
// Place the name for the MySQL database here
$db_name = "onlinestore";

// Run the actual connectinon here
mysql_connect("$db_host", "$db_username", "$db_pass")or die("could not connect to mysql");
mysql_select_db("$db_name")or die("no database");