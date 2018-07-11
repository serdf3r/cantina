
<?php
include 'general_top.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT * FROM GEN_AMB_TEMP_UMI ORDER BY TEMPERATURE DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
asddfLLLAAA}{}!"£$$/()/%6uy7777eìù88888"
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_temp_max = date('d-m-Y', strtotime(str_replace('/', '-', substr($row["TIME"], 0, 10))));
        $ora_temp_max = substr($row["TIME"], 10, 20);
        $temperatura_temp_max = $row["TEMPERATURE"];
        $umidity_temp_max = $row["UMIDITY"];
    }
}
$sql = "SELECT * FROM GEN_AMB_TEMP_UMI ORDER BY TEMPERATURE ASC LIMIT 1";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_temp_min = date('d-m-Y', strtotime(str_replace('/', '-', substr($row["TIME"], 0, 10))));
        $ora_temp_min = substr($row["TIME"], 10, 20);
        $temperatura_temp_min = $row["TEMPERATURE"];
        $umidity_temp_min = $row["UMIDITY"];
    }
}
$sql = "SELECT * FROM GEN_AMB_TEMP_UMI ORDER BY UMIDITY DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_umi_max = date('d-m-Y', strtotime(str_replace('/', '-', substr($row["TIME"], 0, 10))));
        $ora_umi_max = substr($row["TIME"], 10, 20);
        $temperatura_umi_max = $row["TEMPERATURE"];
        $umidity_umi_max = $row["UMIDITY"];
    }
}
$sql = "SELECT * FROM GEN_AMB_TEMP_UMI ORDER BY UMIDITY ASC LIMIT 1";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_umi_min = date('d-m-Y', strtotime(str_replace('/', '-', substr($row["TIME"], 0, 10))));
        $ora_umi_min = substr($row["TIME"], 10, 20);
        $temperatura_umi_min = $row["TEMPERATURE"];
        $umidity_umi_min = $row["UMIDITY"];
    }
}
$sql = "SELECT * FROM GEN_AMB_TEMP_UMI ORDER BY UMIDITY ASC LIMIT 1";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_umi_min = date('d-m-Y', strtotime(str_replace('/', '-', substr($row["TIME"], 0, 10))));
        $ora_umi_min = substr($row["TIME"], 10, 20);
        $temperatura_umi_min = $row["TEMPERATURE"];
        $umidity_umi_min = $row["UMIDITY"];
    }
}
$sql = "SELECT AVG(TEMPERATURE) FROM GEN_AMB_TEMP_UMI";
$result = mysqli_query($conn, $sql);
$temperatura_media = mysqli_fetch_assoc($result);
$sql = "SELECT AVG(UMIDITY) FROM GEN_AMB_TEMP_UMI";
$result = mysqli_query($conn, $sql);
$umidity_media = mysqli_fetch_assoc($result);

// questo serve per il nuemro di righe
$sql = "SELECT * FROM GEN_AMB_TEMP_UMI";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

$sql = "SELECT * FROM GEN_AMB_TEMP_UMI ORDER BY id ASC LIMIT 1";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_prima = date('d-m-Y', strtotime(str_replace('/', '-', substr($row["TIME"], 0, 10))));
        $ora_prima = substr($row["TIME"], 10, 20);
    }
}
$sql = "SELECT * FROM GEN_AMB_TEMP_UMI ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_ultima = date('d-m-Y', strtotime(str_replace('/', '-', substr($row["TIME"], 0, 10))));
        $ora_ultima = substr($row["TIME"], 10, 20);
    }
}
?>
<ul class="dati_generali">
    <li>Prima misurazione inserita: <b><?php echo $data_prima; ?> </b> alle <b><?php echo $ora_prima; ?></b></li>
    <li>Ultima misurazione inserita: <b><?php echo $data_ultima; ?> </b> alle <b><?php echo $ora_ultima; ?></b></li>
    <li>Totale misurazioni inserite: <b><?php echo $count; ?> </b></li>
    <li>Temperatura Media: <b><?php echo substr($temperatura_media["AVG(TEMPERATURE)"], 0, 2); ?> °C</b></li>
    <li>Temperatura Massima: <b><?php echo $temperatura_temp_max; ?> °C</b> il giorno <?php echo $data_temp_max; ?> alle <?php echo $ora_temp_max; ?> l'umidità era di <?php echo $umidity_temp_max; ?>%<li>
    <li>Temperatura Minima: <b><?php echo $temperatura_temp_min; ?> °C</b> il giorno <?php echo $data_temp_min; ?> alle <?php echo $ora_temp_min; ?> l'umidità era di <?php echo $umidity_temp_min; ?>%<li>
    <li>Umidità Media: <b><?php echo substr($umidity_media["AVG(UMIDITY)"], 0, 2); ?> %</b><li>
    <li>Umidità Massima: <b><?php echo $umidity_umi_max; ?> %</b> il giorno <?php echo $data_umi_max; ?> alle <?php echo $ora_umi_max; ?> la temperatura era di <?php echo $temperatura_umi_max; ?>°C<li>
    <li>Umidità Minima: <b><?php echo $umidity_umi_min; ?> %</b> il giorno <?php echo $data_umi_min; ?> alle <?php echo $ora_umi_min; ?> la temperatura era di <?php echo $temperatura_umi_min; ?>°C<li>
</ul>
<?php include 'general_bottom.php'; ?>
   