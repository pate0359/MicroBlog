<?php
$mysql_hostname = "localhost";
$mysql_database = "microblog";
$mysql_user = "root";
$mysql_password = "root";

try
{
	$pdo_link = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_database",$mysql_user,$mysql_password);
	$pdo_link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
}catch(PDOException $err)
{
	echo "Database connection error : ".$err->getMessage();
}


//$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
//mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");

?>