<?php
// Prepare variables for database connection
$dbusername = "root";
// enter database username, I used "arduino" in step 2.2
$dbpassword = "";
// enter database password, I used "arduinotest" in step 2.2
$server     = "localhost"; // IMPORTANT: if you are using XAMPP enter "localhost", but if you have an online website enter its address, ie."www.yourwebsite.com"
// Connect to your database
$dbconnect = mysql_pconnect($server, $dbusername, $dbpassword);
$dbselect  = mysql_select_db("cantina", $dbconnect);
// Prepare the SQL statement
$sql       = "INSERT INTO `GEN_AMB_TEMP_UMI` (`ID`, `TIME`, `TEMPERATURE`, `UMIDITY`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_GET["value"]."', '".$_GET["value"]."')";

// Execute SQL statement
mysql_query($sql);
?>