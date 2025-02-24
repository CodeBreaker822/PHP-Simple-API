<?php 

$servername = "localhost";
$dbUsername = "root";
$dbPass = "#Shinichi123";
$dbName = "mces";

$conn = mysqli_connect($servername, $dbUsername, $dbPass, $dbName);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}


// this is for pdo connection to display data at front-end 
try
{
$dbh = new PDO("mysql:host=".$servername.";dbname=".$dbName,$dbUsername, $dbPass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

?>
