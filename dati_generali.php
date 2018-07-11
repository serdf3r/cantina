
<?php
include 'general_top.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
$generali = '';
$vendemmie = '';
$vini = '';
$analisi = '';
$laboratori = '';
if (isset($_GET['cat'])) {  
    $sql = "DELETE FROM " . strtoupper($_GET['cat']) . " WHERE ID=" . $_GET['ID'] . "";

    $result = mysqli_query($conn, $sql);
    if ($result == 1) {
        echo "<span class='ok_dati'>Dati eliminati correttamente</span>";
    } else {
        echo "<span class='ko_dati'>Chiama Tiziano</span>";
    }

    // fa aprire il pannello corrispondente
    ${$_GET['cat']} = "show";
}


$sql = "SELECT * FROM GEN_AMB_TEMP_UMI ORDER BY TEMPERATURE DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

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

$sql = "SELECT * FROM VENDEMMIE ORDER BY ID DESC";
$result_vendemmie = mysqli_query($conn, $sql);
$sql = "SELECT VINI.ID AS VINI_ID , VINI.ANNATA AS VINI_ANNATA, VINI.NOME AS VINI_NOME, VINI.DATA_IMBOTTIGLIAMENTO AS VINI_DATA_IMBOTTIGLIAMENTO,"
        . " VINI.NOTE AS VINI_NOTE, VENDEMMIE.LUOGO AS VENDEMMIE_LUOGO, VENDEMMIE.DATA  AS VENDEMMIE_DATA FROM VINI LEFT JOIN VENDEMMIE ON VINI.ID_VENDEMMIE = VENDEMMIE.ID ORDER BY VINI.ID DESC";
$result_vini = mysqli_query($conn, $sql);
$sql = "SELECT ANALISI.*, VINI.NOME AS VINI_NOME , LABORATORI.NOME AS LABORATORI_NOME FROM ANALISI LEFT JOIN VINI ON ANALISI.ID_VINI  = VINI.ID LEFT JOIN LABORATORI ON ANALISI.ID_LABORATORIO  = LABORATORI.ID ORDER BY ID DESC";
$result_analisi = mysqli_query($conn, $sql);
$sql = "SELECT * FROM LABORATORI ORDER BY ID DESC";
$result_laboratori = mysqli_query($conn, $sql);
?>
<div class="panel-group" id="accordion">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-1">Dati Generali</a>
            </h4>
        </div>
        <div id="pannello-1" class="panel-collapse collapse in">
            <div class="panel-body">
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
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-2">Vendemmie</a>
            </h4>
        </div>
        <div id="pannello-2" class="panel-collapse collapse in <?php echo $vendemmie; ?> ">
            <div class="panel-body">
                <table id="tab_vendemmie" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data</th>
                            <th>Luogo</th>
                            <th>Costo</th>
                            <th>Dettagli</th>
                            <th>Note</th>
                            <th>M</th>
                            <th>E</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_vendemmie)) {
                            echo "<tr>";
                            echo "<td>" . $row["ID"] . "</td>";
                            echo "<td>" . $row["DATA"] . "</td>";
                            echo "<td>" . $row["LUOGO"] . "</td>";
                            echo "<td>" . $row["COSTO"] . "</td>";
                            echo "<td>" . $row["DETTAGLI"] . "</td>";
                            echo "<td>" . $row["NOTE"] . "</td>";
                            echo "<td><input type='button' class='btn btn-primary' value='Modifica' onclick='location.href = \"http:\\inserimento_dati.php?type=mod&cat=vendemmie&ID=" . $row["ID"] . "\";'></td>";
                            echo "<td><input type='button' class='btn btn-danger' value='Elimina' onclick='location.href = \"http:\\dati_generali.php?type=del&cat=vendemmie&ID=" . $row["ID"] . "\";'></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>                    
                </table> 
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-3">Vini</a>
            </h4>
        </div>
        <div id="pannello-3" class="panel-collapse collapse in  <?php echo $vini; ?> ">
            <div class="panel-body">
                <table id="tab_vini" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vendemmia</th>
                            <th>Annata</th>
                            <th>Nome</th>
                            <th>Data Imbottigliamento</th>
                            <th>Note</th>
                            <th>M</th>
                            <th>E</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_vini)) {
                            echo "<tr>";
                            echo "<td>" . $row["VINI_ID"] . "</td>";
                            echo "<td>" . $row["VENDEMMIE_LUOGO"] . " del " . $row["VENDEMMIE_DATA"] . " </td>";
                            echo "<td>" . $row["VINI_ANNATA"] . "</td>";
                            echo "<td>" . $row["VINI_NOME"] . "</td>";
                            echo "<td>" . $row["VINI_DATA_IMBOTTIGLIAMENTO"] . "</td>";
                            echo "<td>" . $row["VINI_NOTE"] . "</td>";
                            echo "<td><input type='button' class='btn btn-primary' value='Modifica' onclick='location.href = \"http:\\inserimento_dati.php?type=mod&cat=vini&ID=" . $row["VINI_ID"] . "\";'></td>";
                            echo "<td><input type='button' class='btn btn-danger' value='Elimina' onclick='location.href = \"http:\\dati_generali.php?type=del&cat=vini&ID=" . $row["VINI_ID"] . "\";'></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>                    
                </table> 
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-4">Analisi</a>
            </h4>
        </div>
        <div id="pannello-4" class="panel-collapse collapse in <?php echo $analisi; ?> ">
            <div class="panel-body">
                <table id="tab_analisi" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vino</th>
                            <th>Laboratorio</th>
                            <th>Data</th>
                            <th>Titolo Alcolemico Volumetrico</th>
                            <th>Acidità Totale</th>
                            <th>Acidità Volatile</th>
                            <th>Anidiride Solforosa Totale</th>
                            <th>PH</th>
                            <th>Acido L Malico</th>
                            <th>Acido L Lattico</th>
                            <th>Trattamento Consigliato</th>
                            <th>Note</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_analisi)) {
                            echo "<tr>";
                            echo "<td>" . $row["ID"] . "</td>";
                            echo "<td>" . $row["VINI_NOME"] . "</td>";
                            echo "<td>" . $row["LABORATORI_NOME"] . "</td>";
                            echo "<td>" . $row["TITOLO_ALCOLOMETRICO_VOLUMICO"] . " " . $row["TITOLO_ALCOLOMETRICO_VOLUMICO_UM"] . "</td>";
                            echo "<td>" . $row["ACIDITA_TOTALE"] . " " . $row["ACIDITA_TOTALE_UM"] . "</td>";
                            echo "<td>" . $row["ACIDITA_VOLATILE"] . " " . $row["ACIDITA_VOLATILE_UM"] . "</td>";
                            echo "<td>" . $row["ANIDIRIDE_SOLFOROSA_TOTALE"] . " " . $row["ANIDIRIDE_SOLFOROSA_TOTALE_UM"] . "</td>";
                            echo "<td>" . $row["PH"] . "</td>";
                            echo "<td>" . $row["ACIDO_L_MALICO"] . " " . $row["ACIDO_L_MALICO_UM"] . "</td>";
                            echo "<td>" . $row["ACIDO_L_LATTICO"] . " " . $row["ACIDO_L_LATTICO_UM"] . "</td>";
                            echo "<td>" . $row["TRATTAMENTO_CONSIGLIATO"] . "</td>";
                            echo "<td>" . $row["NOTE"] . "</td>";
                            echo "<td><input type='button' class='btn btn-primary' value='Modifica' onclick='location.href = \"http:\\inserimento_dati.php?type=mod&cat=analisi&ID=" . $row["ID"] . "\";'></td>";
                            echo "<td><input type='button' class='btn btn-danger' value='Elimina' onclick='location.href = \"http:\\dati_generali.php?type=del&cat=analisi&ID=" . $row["ID"] . "\";'></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>                    
                </table> 
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-5">Laboratori</a>
            </h4>
        </div>
        <div id="pannello-5" class="panel-collapse collapse in <?php echo $laboratori; ?> ">
            <div class="panel-body">
                <table id="tab_vendemmie" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Note</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_laboratori)) {
                            echo "<tr>";
                            echo "<td>" . $row["ID"] . "</td>";
                            echo "<td>" . $row["NOME"] . "</td>";
                            echo "<td>" . $row["EMAIL"] . "</td>";
                            echo "<td>" . $row["NOTE"] . "</td>";
                            echo "<td><input type='button' class='btn btn-primary' value='Modifica' onclick='location.href = \"http:\\inserimento_dati.php?type=mod&cat=laboratori&ID=" . $row["ID"] . "\";'></td>";
                            echo "<td><input type='button' class='btn btn-danger' value='Elimina' onclick='location.href = \"http:\\dati_generali.php?type=del&cat=laboratori&ID=" . $row["ID"] . "\";'></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>                    
                </table> 
            </div>
        </div>
    </div>
</div>
<?php include 'general_bottom.php'; ?>
   