<?php include 'config.php'; ?>
<?php

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$myfile = fopen("../../../../home/serdf3r/out_file.txt", "r+") or die("Unable to open file!");
$testo = fread($myfile, filesize("../../../../home/serdf3r/out_file.txt"));
//echo $testo;
preg_match_all("'<u>(.*)</u>'", $testo, $umidita_val);

$umidita = $umidita_val[1][0];
preg_match_all("'<t>(.*)</t>'", $testo, $temperatura_val);
$temperatura = $temperatura_val[1][0];
$dateTimeVariable = date("F j, Y \a\t g:ia");
//echo "umidita: " . $umidita . "<br>";
//echo "temperatura: " . $temperatura . "<br><br>";
//echo "dateTimeVariable: " . $dateTimeVariable . "<br><br>";
$sql_i = "INSERT INTO GEN_AMB_TEMP_UMI VALUES ('', $temperatura, $umidita,now() )";
$result = mysqli_query($conn, $sql_i);
fclose($myfile);
ftruncate($myfile, 0);
//unlink("../../../../home/serdf3r/out_file.txt");
?>
