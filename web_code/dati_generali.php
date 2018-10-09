
<?php
include 'general_top.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
$generali = '';
$vendemmie = '';
$vini = '';
$analisi = '';
$laboratori = '';
$rabbocchi = '';
$botti = '';
$flussi = '';
if (isset($_GET['cat'])) {
    if (isset($_GET['type']) && $_GET['type'] == 'del') {
        $sql = "DELETE FROM " . strtoupper($_GET['cat']) . " WHERE ID=" . $_GET['ID'] . "";

        $result = mysqli_query($conn, $sql);
        if ($result == 1) {
            echo "<span class='ok_dati'>Dati eliminati correttamente</span>";
        } else {
            echo "<span class='ko_dati'>Chiama Tiziano</span>";
        }
    }
    if (isset($_GET['type']) && $_GET['type'] == 'edit') {
        echo "<span class='ok_dati'>Dati modificati correttamente</span>";
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

$sql = "SELECT VENDEMMIE.*, UVE.DESCRIZIONE FROM VENDEMMIE LEFT JOIN UVE ON VENDEMMIE.UVA = UVE.ID ORDER BY VENDEMMIE.DATA ASC";
$result_vendemmie = mysqli_query($conn, $sql);
$sql = "SELECT VINI.ID AS VINI_ID , VINI.ANNATA AS VINI_ANNATA, VINI.NOME AS VINI_NOME, VINI.DATA_IMBOTTIGLIAMENTO AS VINI_DATA_IMBOTTIGLIAMENTO,"
        . " VINI.NOTE AS VINI_NOTE, VENDEMMIE.LUOGO AS VENDEMMIE_LUOGO, VENDEMMIE.DATA  AS VENDEMMIE_DATA FROM VINI LEFT JOIN VENDEMMIE ON VINI.ID_VENDEMMIE = VENDEMMIE.ID ORDER BY VINI.ID DESC";
$result_vini = mysqli_query($conn, $sql);
$sql = "SELECT ANALISI.*, BOTTI.SIGLA AS BOTTI_SIGLA , LABORATORI.NOME AS LABORATORI_NOME FROM ANALISI LEFT JOIN BOTTI ON ANALISI.ID_BOTTE  = BOTTI.ID LEFT JOIN LABORATORI ON ANALISI.ID_LABORATORIO  = LABORATORI.ID ORDER BY ID DESC";
$result_analisi = mysqli_query($conn, $sql);
$sql = "SELECT * FROM LABORATORI ORDER BY ID DESC";
$result_laboratori = mysqli_query($conn, $sql);
$sql = "SELECT RABBOCCHI.* , VINI.NOME AS VINI_NOME FROM RABBOCCHI LEFT JOIN VINI ON RABBOCCHI.ID_VINI  = VINI.ID ORDER BY ID DESC";
$result_rabbocchi = mysqli_query($conn, $sql);
$sql = "SELECT * FROM BOTTI ORDER BY ID DESC";
$result_botti = mysqli_query($conn, $sql);
$sql = "SELECT * FROM FLUSSI";
$result_flussi = mysqli_query($conn, $sql);
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
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-8">Flussi</a>
            </h4>
        </div>
        <div id="pannello-8" class="panel-collapse collapse in <?php echo $flussi; ?> ">
            <div class="panel-body">
                <table id="tab_flussi" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID_REL</th>
                            <th>Botte</th>
                            <th>Provenienza_ID</th>
                            <th>Riempimento</th>
                            <th>Azione</th>                            
                            <th>Data</th>
                            <th>Estinta</th>
                            <th>Note</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_flussi)) {
                            echo "<tr>";
                            echo "<td>" . $row["ID"] . "</td>";
                            echo "<td>" . $row["ID_REL"] . "</td>";
                            echo "<td>" . $row["BOTTE"] . "</td>";
                            echo "<td>" . $row["PROVENIENZA_ID"] . "</td>";
                            echo "<td>" . $row["QUANTITA_RIEMPIMENTO"] . "</td>";
                            echo "<td>" . $row["AZIONE"] . "</td>";
                            echo "<td>" . $row["DATA"] . "</td>";
                            echo "<td>";
                            if ($row["ESTINTA"] == 1) {
                                echo 'SI';
                            } echo "</td>";
                            echo "<td><button type='button' class='btn btn-info ";
                            if (trim($row["NOTE"]) == '') {
                                echo "disabled";
                            }
                            echo "' data-toggle='tooltip' data-placement='top' title='" . $row["NOTE"] . "' >Vedi</button></td>";
                            echo "<td><input type='button' " . $modifica_disable . " class='btn btn-primary' value='Modifica' onclick='location.href = \"http:\\inserimento_dati.php?type=mod&cat=flussi&ID=" . $row["ID"] . "\";'></td>";
                            echo "<td><input type='button' " . $elimina_disable . " class='btn btn-danger' value='Elimina' onclick='location.href = \"http:\\dati_generali.php?type=del&cat=flussi&ID=" . $row["ID"] . "\";'></td>";
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
                            <th>Uva</th>
                            <th>Estinta</th>
                            <th>Costo</th>                            
                            <th>Dettagli</th>
                            <th>Note</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_vendemmie)) {
                            echo "<tr>";
                            echo "<td>" . $row["ID"] . "</td>";
                            echo "<td>" . $row["DATA"] . "</td>";
                            echo "<td>" . $row["LUOGO"] . "</td>";
                            echo "<td>" . $row["DESCRIZIONE"] . "</td>";
                            echo "<td>";
                            if ($row["ESTINTA"] == 1) {
                                echo 'SI';
                            } echo "</td>";
                            echo "<td>" . $row["COSTO"] . " €</td>";
                            echo "<td><button type='button' class='btn btn-info ";
                            if (trim($row["DETTAGLI"]) == '') {
                                echo "disabled";
                            }
                            echo "' data-toggle='tooltip' data-placement='top' title='" . $row["DETTAGLI"] . "' >Vedi</button></td>";
                            echo "<td><button type='button' class='btn btn-info ";
                            if (trim($row["NOTE"]) == '') {
                                echo "disabled";
                            }
                            echo "' data-toggle='tooltip' data-placement='top' title='" . $row["NOTE"] . "' >Vedi</button></td>";
                            echo "<td><input type='button' " . $modifica_disable . " class='btn btn-primary' value='Modifica' onclick='location.href = \"http:\\inserimento_dati.php?type=mod&cat=vendemmie&ID=" . $row["ID"] . "\";'></td>";
                            echo "<td><input type='button' " . $elimina_disable . " class='btn btn-danger' value='Elimina' onclick='location.href = \"http:\\dati_generali.php?type=del&cat=vendemmie&ID=" . $row["ID"] . "\";'></td>";
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
<!--                <table id="tab_vini" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vendemmia</th>
                            <th>Annata</th>
                            <th>Nome</th>
                            <th>Data Imbottigliamento</th>
                            <th>Note</th>
                            <th></th>
                            <th></th>
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
                            if ($row["VINI_DATA_IMBOTTIGLIAMENTO"] == '1970-01-01' || $row["VINI_DATA_IMBOTTIGLIAMENTO"] == '0000-00-00') {
                                echo "<td>-</td>";
                            } else {
                                echo "<td>" . $row["VINI_DATA_IMBOTTIGLIAMENTO"] . "</td>";
                            }
                            echo "<td><button type='button' class='btn btn-info ";
                            if (trim($row["VINI_NOTE"]) == '') {
                                echo "disabled";
                            }
                            echo "' data-toggle='tooltip' data-placement='top' title='" . $row["VINI_NOTE"] . "' >Vedi</button></td>";
                            echo "<td><input type='button' " . $modifica_disable . " class='btn btn-primary' value='Modifica' onclick='location.href = \"http:\\inserimento_dati.php?type=mod&cat=vini&ID=" . $row["VINI_ID"] . "\";'></td>";
                            echo "<td><input type='button' " . $elimina_disable . " class='btn btn-danger' value='Elimina' onclick='location.href = \"http:\\dati_generali.php?type=del&cat=vini&ID=" . $row["VINI_ID"] . "\";'></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>                    
                </table> -->
                <?php
                include 'include/time_line_botti.php';
                    ?>
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
                            <th>Botte</th>
                            <th>Laboratorio</th>
                            <th>Data</th>
                            <th data-toggle='tooltip' data-placement='top' title='Gradazione alcolica (gradi % vol.= % in volume = millilitri di alcol in 100 ml di vino)

                                - Valori inferiori a 10° % vol.: generalmente sono vini deboli, non sono adatti all’invecchiamento e possono essere soggetti, nel periodo primaverile ed estivo, ad alterazioni di natura batterica;
                                - Valori tra 10° e 12° vol.: sono vini gradevoli che si possono conservare bene per alcuni anni.
                                - Valori superiori a 12° % vol.: sono vini di struttura meno soggetti ad alterazioni batteriche rispetto ai precedenti, perché l’elevato tenore alcolico garantisce una buona protezione contro gli agenti batterici.'>
                                Titolo Alcolemico Volumetrico</th>
                            <th data-toggle='tooltip' data-placement='top' title='Acidità totale (g/l = grammi per litro)

                                - Limite legale: non inferiore a 4,5 g/l.
                                - Valori inferiori a 4,5 g/l: vini che presentano valori così bassi sono tipici dei climi caldi o dei vini che hanno subito una fermentazione malolattica. Sono vini di difficile conservazione e nel periodo primaverile ed estivo, se non sono conservati con attenzione, possono essere soggetti ad alterazioni batteriche.
                                - Valori tra 5 e 7 g/l: sono vini che si manifestano gradevoli al palato oltre ad essere di facile conservazione.
                                - Valori superiori a 7 g/l: sono valori elevati tipici dei climi freddi; rendono i vini aspri e poco gradevoli.'>
                                Acidità Totale</th>
                            <th data-toggle='tooltip' data-placement='top' title='Acidità volatile (g/l = grammi per litro)

                                - Limite legale: non superiore a 1,08 g/l per i vini bianchi e 1,2 g/l per i vini rossi
                                - Valori inferiori a 0,6 g/l: sono valori che rientrano nella normalità.
                                - Valori tra 0,6 e 1 g/l: sono valori normali per i vini rossi invecchiati e i vini passiti, mentre per gli altri vini sono indice di alterazioni batteriche (acescenza, spunto lattico ecc.); l’odore di acetato che ha una bassa soglia di percezione, si riconosce all’olfatto e al gusto durante la degustazione.
                                - Valori superiori a 1 g/l: ad esclusione di alcuni vini, come già spiegato in precedenza, sono indice di un notevole attacco batterico che ha alterato irrimediabilmente le qualità organolettiche.'>
                                Acidità Volatile</th>
                            <th data-toggle='tooltip' data-placement='top' title='Anidride solforosa libera (mg/l = milligrammi per litro)

                                - Valori inferiori a 10 mg/l: il vino, se non è conservato in recipienti chiusi e a temperature basse è soggetto ad alterazioni batteriche e ad ossidazione
                                - Valori tra 10 e 25 mg/l: ottimale per tutti i vini.
                                - Valori superiori a 30 mg/l: l’eccesso di anidride solforosa alla degustazione aumenta la sensazione amara del vino ed è causa di mal di testa e bruciori di stomaco.'>
                                Anidiride Solforosa Libera</th>
                            <th data-toggle='tooltip' data-placement='top' title='Anidride solforosa totale (mg/l = milligrammi per litro)

                                - Limite legale: vino bianco e rosato 210 mg/l; per i vini aventi un tenore di zuccheri superiori a 5 g/l è portato a 260 mg/l
                                - Limite legale: vino rosso 160 mg/l; per aventi un tenore di zuccheri superiori a 5 g/l è portato a 210 mg/l
                                - I valori consigliati generalmente sufficienti per la conservazione, sono inferiori a 100 – 110 mg/l per il vino bianco e rosato, ed inferiori a 80 – 90 mg/l per il vino rosso.
                                - Valori elevati sono indice di eccessivo uso di anidride solforosa (metabisolfito di potassio) in vinificazione, di errori di dosaggio o interventi curativi energici eseguiti per bloccare alterazioni batteriche.'>
                                Anidiride Solforosa Totale</th>
                            <th data-toggle='tooltip' data-placement='top' data-html="true" title='pH (indica la concentrazione acida del vino)

                                - Valori inferiori a 3: sono valori tipici dei climi freddi o di uve raccolte immature; biologicamente il vino è molto stabile.
                                - Valori tra 3 e 3,4: valori normali dei vini bianchi.
                                - Valori tra 3,2 3 3,6: valori normali dei vini rossi.
                                - Valori superiori a 3,6: sono valori tipici dei climi caldi, di uve raccolte in sovra maturazione o di vini che hanno subito la fermentazione malolattica.'>
                                PH</th>
                            <th data-toggle='tooltip' data-placement='top' title='-'>Acido L Malico</th>
                            <th data-toggle='tooltip' data-placement='top' title='-'>Acido L Lattico</th>
                            <th>Trattamento Consigliato</th>
                            <th>Note</th>
                            <th>PDF Orig.</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_analisi)) {
                            echo "<tr>";
                            echo "<td>" . $row["ID"] . "</td>";
                            echo "<td>" . $row["BOTTI_SIGLA"] . "</td>";
                            echo "<td>" . $row["LABORATORI_NOME"] . "</td>";
                            echo "<td>" . $row["DATA"] . "</td>";
                            if ($row["TITOLO_ALCOLOMETRICO_VOLUMICO"] == 0 && trim($row["TITOLO_ALCOLOMETRICO_VOLUMICO_UM"]) == '') {
                                echo "<td>-</td>";
                            } else {
                                echo "<td>" . $row["TITOLO_ALCOLOMETRICO_VOLUMICO"] . " " . $row["TITOLO_ALCOLOMETRICO_VOLUMICO_UM"] . "</td>";
                            }
                            if ($row["ACIDITA_TOTALE"] == 0 && trim($row["ACIDITA_TOTALE_UM"]) == '') {
                                echo "<td>-</td>";
                            } else {
                                echo "<td>" . $row["ACIDITA_TOTALE"] . " " . $row["ACIDITA_TOTALE_UM"] . "</td>";
                            }
                            if ($row["ACIDITA_VOLATILE"] == 0 && trim($row["ACIDITA_VOLATILE_UM"]) == '') {
                                echo "<td>-</td>";
                            } else {
                                echo "<td>" . $row["ACIDITA_VOLATILE"] . " " . $row["ACIDITA_VOLATILE_UM"] . "</td>";
                            }
                            if ($row["ANIDIRIDE_SOLFOROSA_LIBERA"] == 0 && trim($row["ANIDIRIDE_SOLFOROSA_LIBERA_UM"]) == '') {
                                echo "<td>-</td>";
                            } else {
                                echo "<td>" . $row["ANIDIRIDE_SOLFOROSA_LIBERA"] . " " . $row["ANIDIRIDE_SOLFOROSA_LIBERA_UM"] . "</td>";
                            }
                            if ($row["ANIDIRIDE_SOLFOROSA_TOTALE"] == 0 && trim($row["ANIDIRIDE_SOLFOROSA_TOTALE_UM"]) == '') {
                                echo "<td>-</td>";
                            } else {
                                echo "<td>" . $row["ANIDIRIDE_SOLFOROSA_TOTALE"] . " " . $row["ANIDIRIDE_SOLFOROSA_TOTALE_UM"] . "</td>";
                            }
                            if ($row["PH"] == 0) {
                                echo "<td>-</td>";
                            } else {
                                echo "<td>" . $row["PH"] . "</td>";
                            }
                            if ($row["ACIDO_L_MALICO"] == 0 && trim($row["ACIDO_L_MALICO_UM"]) == '') {
                                echo "<td>-</td>";
                            } else {
                                echo "<td>" . $row["ACIDO_L_MALICO"] . " " . $row["ACIDO_L_MALICO_UM"] . "</td>";
                            }
                            if ($row["ACIDO_L_LATTICO"] == 0 && trim($row["ACIDO_L_LATTICO_UM"]) == '') {
                                echo "<td>-</td>";
                            } else {
                                echo "<td>" . $row["ACIDO_L_LATTICO"] . " " . $row["ACIDO_L_LATTICO_UM"] . "</td>";
                            }
                            echo "<td><button type='button' class='btn btn-info ";
                            if (trim($row["TRATTAMENTO_CONSIGLIATO"]) == '') {
                                echo "disabled";
                            }
                            echo "' data-toggle='tooltip' data-placement='top' title='" . $row["TRATTAMENTO_CONSIGLIATO"] . "'>Vedi</button></td>";
                            echo "<td><button type='button' class='btn btn-info ";
                            if (trim($row["NOTE"]) == '') {
                                echo "disabled";
                            }
                            echo "' data-toggle='tooltip' data-placement='top' title='" . $row["NOTE"] . "' >Vedi</button></td>";
                            echo "<td><input type='button'";
                            if (trim($row["PDF_RELATIVO"]) == '') {
                                echo "disabled";
                            }
                            echo "class='btn btn-primary' value='PDF' onclick='location.href = \"http:\\pdf_analisi/" . $row["PDF_RELATIVO"] . "\";'></td>";
                            echo "<td><input type='button' " . $modifica_disable . " class='btn btn-primary' value='Modifica' onclick='location.href = \"http:\\inserimento_dati.php?type=mod&cat=analisi&ID=" . $row["ID"] . "\";'></td>";
                            echo "<td><input type='button' " . $elimina_disable . " class='btn btn-danger' value='Elimina' onclick='location.href = \"http:\\dati_generali.php?type=del&cat=analisi&ID=" . $row["ID"] . "\";'></td>";
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
                <table id="tab_laboratori" class="display" style="width:100%">
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
                            echo "<td><button type='button' class='btn btn-info ";
                            if (trim($row["NOTE"]) == '') {
                                echo "disabled";
                            }
                            echo "' data-toggle='tooltip' data-placement='top' title='" . $row["NOTE"] . "' >Vedi</button></td>";
                            echo "<td><input type='button' " . $modifica_disable . " class='btn btn-primary' value='Modifica' onclick='location.href = \"http:\\inserimento_dati.php?type=mod&cat=laboratori&ID=" . $row["ID"] . "\";'></td>";
                            echo "<td><input type='button' " . $elimina_disable . " class='btn btn-danger' value='Elimina' onclick='location.href = \"http:\\dati_generali.php?type=del&cat=laboratori&ID=" . $row["ID"] . "\";'></td>";
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
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-6">Rabbocchi</a>
            </h4>
        </div>
        <div id="pannello-6" class="panel-collapse collapse in <?php echo $rabbocchi; ?> ">
            <div class="panel-body">
                <table id="tab_rabbocchi" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data</th>
                            <th>Vino</th>
                            <th>Note</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_rabbocchi)) {
                            echo "<tr>";
                            echo "<td>" . $row["ID"] . "</td>";
                            echo "<td>" . $row["DATA"] . "</td>";
                            echo "<td>" . $row["VINI_NOME"] . "</td>";
                            echo "<td><button type='button' class='btn btn-info ";
                            if (trim($row["NOTE"]) == '') {
                                echo "disabled";
                            }
                            echo "' data-toggle='tooltip' data-placement='top' title='" . $row["NOTE"] . "' >Vedi</button></td>";
                            echo "<td><input type='button' " . $modifica_disable . " class='btn btn-primary' value='Modifica' onclick='location.href = \"http:\\inserimento_dati.php?type=mod&cat=rabbocchi&ID=" . $row["ID"] . "\";'></td>";
                            echo "<td><input type='button' " . $elimina_disable . " class='btn btn-danger' value='Elimina' onclick='location.href = \"http:\\dati_generali.php?type=del&cat=rabbocchi&ID=" . $row["ID"] . "\";'></td>";
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
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-7">Botti</a>
            </h4>
        </div>
        <div id="pannello-7" class="panel-collapse collapse in <?php echo $botti; ?> ">
            <div class="panel-body">
                <table id="tab_botti" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data</th>
                            <th>Costo</th>
                            <th>Sigla</th>
                            <th>Capacità</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_botti)) {
                            echo "<tr>";
                            echo "<td>" . $row["ID"] . "</td>";
                            echo "<td>" . $row["DATA"] . "</td>";
                            echo "<td>" . $row["COSTO"] . " €</td>";
                            echo "<td>" . $row["SIGLA"] . "</td>";
                            echo "<td>" . $row["CAPACITA"] . " litri</td>";
                            echo "<td><button type='button' class='btn btn-info ";
                            if (trim($row["DESCRIZIONE"]) == '') {
                                echo "disabled";
                            }
                            echo "' data-toggle='tooltip' data-placement='top' title='" . $row["DESCRIZIONE"] . "' >Vedi</button></td>";
                            echo "<td><input type='button' " . $modifica_disable . " class='btn btn-primary' value='Modifica' onclick='location.href = \"http:\\inserimento_dati.php?type=mod&cat=botti&ID=" . $row["ID"] . "\";'></td>";
                            echo "<td><input type='button' " . $elimina_disable . " class='btn btn-danger' value='Elimina' onclick='location.href = \"http:\\dati_generali.php?type=del&cat=botti&ID=" . $row["ID"] . "\";'></td>";
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
   