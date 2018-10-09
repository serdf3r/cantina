
<?php include 'general_top.php'; ?>
<?php
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$vendemmie = null;
$vini = null;
$analisi = null;
$laboratori = null;
$rabbocchi = null;
$botti = null;
$flussi = null;
if (isset($_GET['cat'])) {
    $sql = "SELECT * FROM " . strtoupper($_GET['cat']) . " WHERE ID=" . $_GET['ID'] . "";
    $result_{$_GET['cat']} = mysqli_query($conn, $sql);
    foreach ($result_{$_GET['cat']} as $row_{$_GET['cat']}) {
        
    }
    ${$_GET['cat']} = "show";
}


if (isset($_POST["vendemmia_luogo"])) {
    // echo "vendemmiaa";
    $vendemmia_data = $_POST["vendemmia_data"];
    $vendemmia_luogo = $_POST["vendemmia_luogo"];
    $vendemmia_uva = $_POST["vendemmia_uva"];
    $vendemmia_costo = $_POST["vendemmia_costo"];
    $vendemmia_dettagli = $_POST["vendemmia_dettagli"];
    $vendemmia_note = $_POST["vendemmia_note"];

    if (isset($_POST["vendemmia_estinta"])) {
        $vendemmia_estinta = '1';
    } else {
        $vendemmia_estinta = '0';
    }
    // convert date
    $vendemmia_data = str_replace('/', '-', $vendemmia_data);
    $vendemmia_data = date('Y-m-d', strtotime($vendemmia_data));
    if (isset($_POST["edit"]) && $_POST["edit"] == 'edit') {
        $vendemmia_id = $_POST["ID"];
        $sql = "UPDATE VENDEMMIE SET DATA ='$vendemmia_data', LUOGO='$vendemmia_luogo',UVA='$vendemmia_uva', COSTO='$vendemmia_costo',DETTAGLI='$vendemmia_dettagli',NOTE='$vendemmia_note',ESTINTA='$vendemmia_estinta' WHERE ID=$vendemmia_id";
    } else {
        $sql = "INSERT INTO VENDEMMIE VALUES('','$vendemmia_data', '$vendemmia_luogo','$vendemmia_uva', '$vendemmia_costo','$vendemmia_dettagli','$vendemmia_note', '$vendemmia_estinta') ";
    }
    print_r($sql);
    $result = mysqli_query($conn, $sql);
    if ($result == 1) {
        echo "<span class='ok_dati'>Dati inseriti correttamente</span>";
        if (isset($_POST["edit"]) && $_POST["edit"] == 'edit') {
            header("location: http:\\cantina\dati_generali.php?type=edit&cat=vendemmie");
        }
    } else {
        echo "<span class='ko_dati'>Chiama Tiziano</span>";
    }
}
if (isset($_POST["vino_nome"])) {
    // echo "vino_nome";
    $vino_data = $_POST["vino_data"];
    $vino_nome = $_POST["vino_nome"];
    $vino_vendemmia = $_POST["vino_vendemmia"];
    $vino_note = $_POST["vino_note"];

    $vino_annata = '';
    $sql_annata = "SELECT DATA FROM `VENDEMMIE`  WHERE ID=$vino_vendemmia";
    //$result_annata = mysqli_query($conn, $sql_annata);
    $result_annata = $conn->query($sql_annata);
    $row_result_annata = $result_annata->fetch_assoc();
    $vino_annata = substr($row_result_annata['DATA'], 0, 4);

    // convert date
    $vino_data = str_replace('/', '-', $vino_data);
    $vino_data = date('Y-m-d', strtotime($vino_data));

    if (isset($_POST["edit"]) && $_POST["edit"] == 'edit') {
        $vino_id = $_POST["ID"];
        $vino_annata = '';
        $sql_annata = "SELECT DATA FROM `VENDEMMIE`  WHERE ID=$vino_vendemmia";
        //$result_annata = mysqli_query($conn, $sql_annata);
        $result_annata = $conn->query($sql_annata);
        $row_result_annata = $result_annata->fetch_assoc();
        $vino_annata = substr($row_result_annata['DATA'], 0, 4);
        $sql = "UPDATE VINI SET ID_VENDEMMIE ='$vino_vendemmia', ANNATA='$vino_annata', NOME='$vino_nome',DATA_IMBOTTIGLIAMENTO='$vino_data',NOTE='$vino_note' WHERE ID=$vino_id";
    } else {
        $sql = "INSERT INTO VINI VALUES('','$vino_vendemmia', '$vino_annata', '$vino_nome','$vino_data','$vino_note') ";
    }
    $result = mysqli_query($conn, $sql);
    if ($result == 1) {
        echo "<span class='ok_dati'>Dati inseriti correttamente</span>";
        if (isset($_POST["edit"]) && $_POST["edit"] == 'edit') {
            header("location: http:\\cantina\dati_generali.php?type=edit&cat=vini");
        }
    } else {
        echo "<span class='ko_dati'>Chiama Tiziano</span>";
    }
}
if (isset($_POST["analisi_data"])) {
    // echo "analisi_data";
    $analisi_data = $_POST["analisi_data"];
    $analisi_nome_vino = $_POST["analisi_nome_vino"];
    $analisi_laboratorio = $_POST["analisi_laboratorio"];
    $analisi_tav = $_POST["analisi_tav"];
    if (trim($_POST["analisi_tav"]) == '') {
        $analisi_tav = 'null';
    }

    $analisi_tav_um = $_POST["analisi_tav_um"];
    $analisi_tav_met = $_POST["analisi_tav_met"];
    $analisi_at = $_POST["analisi_at"];
    $analisi_at_um = $_POST["analisi_at_um"];
    $analisi_at_met = $_POST["analisi_at_met"];
    $analisi_av = $_POST["analisi_av"];
    $analisi_av_um = $_POST["analisi_av_um"];
    $analisi_av_met = $_POST["analisi_av_met"];
    $analisi_asl = $_POST["analisi_asl"];
    $analisi_asl_um = $_POST["analisi_asl_um"];
    $analisi_asl_met = $_POST["analisi_asl_met"];
    $analisi_ast = $_POST["analisi_ast"];
    $analisi_ast_um = $_POST["analisi_ast_um"];
    $analisi_ast_met = $_POST["analisi_ast_met"];
    $analisi_alm = $_POST["analisi_alm"];
    $analisi_alm_um = $_POST["analisi_alm_um"];
    $analisi_alm_met = $_POST["analisi_alm_met"];
    $analisi_all = $_POST["analisi_all"];
    $analisi_all_um = $_POST["analisi_all_um"];
    $analisi_all_met = $_POST["analisi_all_met"];
    $analisi_ph = $_POST["analisi_ph"];
    $analisi_ph_met = $_POST["analisi_ph_met"];
    $analisi_trat_cons = $_POST["analisi_trat_cons"];
    $analisi_note = $_POST["analisi_note"];

    // convert date
    $analisi_data = str_replace('/', '-', $analisi_data);
    $analisi_data = date('Y-m-d', strtotime($analisi_data));

    if (isset($_POST["edit"]) && $_POST["edit"] == 'edit') {
        $analisi_id = $_POST["ID"];
        $sql = "UPDATE ANALISI SET ID_VINI =$analisi_nome_vino, ID_LABORATORIO=$analisi_laboratorio, DATA='$analisi_data',"
                . "TITOLO_ALCOLOMETRICO_VOLUMICO='$analisi_tav',TITOLO_ALCOLOMETRICO_VOLUMICO_UM='$analisi_tav_um' ,TITOLO_ALCOLOMETRICO_VOLUMICO_METODO='$analisi_tav_met' ,"
                . "ACIDITA_TOTALE='$analisi_at',ACIDITA_TOTALE_UM='$analisi_at_um' ,ACIDITA_TOTALE_METODO='$analisi_at_met' ,"
                . "ACIDITA_VOLATILE='$analisi_av',ACIDITA_VOLATILE_UM='$analisi_av_um' ,ACIDITA_VOLATILE_METODO='$analisi_av_met' ,"
                . "ANIDIRIDE_SOLFOROSA_LIBERA='$analisi_asl',ANIDIRIDE_SOLFOROSA_LIBERA_UM='$analisi_asl_um' ,ANIDIRIDE_SOLFOROSA_LIBERA_METODO='$analisi_asl_met' ,"
                . "ANIDIRIDE_SOLFOROSA_TOTALE='$analisi_ast',ANIDIRIDE_SOLFOROSA_TOTALE_UM='$analisi_ast_um' ,ANIDIRIDE_SOLFOROSA_TOTALE_METODO='$analisi_ast_met' ,"
                . "PH='$analisi_ph',PH_METODO='$analisi_ph_met' ,"
                . "ACIDO_L_MALICO='$analisi_alm',ACIDO_L_MALICO_UM='$analisi_alm_um' ,ACIDO_L_MALICO_METODO='$analisi_alm_met' ,"
                . "ACIDO_L_LATTICO='$analisi_all',ACIDO_L_LATTICO_UM='$analisi_all_um' ,ACIDO_L_LATTICO_METODO='$analisi_all_met' ,"
                . "TRATTAMENTO_CONSIGLIATO='$analisi_trat_cons',NOTE='$analisi_note' "
                . "WHERE ID=$analisi_id";
    } else {
        $sql = "INSERT INTO ANALISI VALUES('',$analisi_nome_vino, $analisi_laboratorio, '$analisi_data',"
                . "'$analisi_tav','$analisi_tav_um','$analisi_tav_met',"
                . "'$analisi_at','$analisi_at_um','$analisi_at_met',"
                . "'$analisi_av','$analisi_av_um','$analisi_av_met',"
                . "'$analisi_asl','$analisi_asl_um','$analisi_asl_met',"
                . "'$analisi_ast','$analisi_ast_um','$analisi_ast_met',"
                . "'$analisi_ph','$analisi_ph_met',"
                . "'$analisi_alm','$analisi_alm_um','$analisi_alm_met',"
                . "'$analisi_all','$analisi_all_um','$analisi_all_met',"
                . "'$analisi_trat_cons','$analisi_note',''"
                . ") ";
    }
    //print_r($sql);
    $result = mysqli_query($conn, $sql);
    if ($result == 1) {
        echo "<span class='ok_dati'>Dati inseriti correttamente</span>";
        if (isset($_POST["edit"]) && $_POST["edit"] == 'edit') {
            header("location: http:\\cantina\dati_generali.php?type=edit&cat=analisi");
        }
    } else {
        echo "<span class='ko_dati'>Chiama Tiziano</span>";
    }
}
if (isset($_POST["laboratorio_nome"])) {
    // echo "laboratorio_nome";
    $laboratorio_nome = $_POST["laboratorio_nome"];
    $laboratorio_email = $_POST["laboratorio_email"];
    $laboratorio_note = $_POST["laboratorio_note"];
    if (isset($_POST["edit"]) && $_POST["edit"] == 'edit') {
        $laboratorio_id = $_POST["ID"];
        $sql = "UPDATE LABORATORI SET NOME ='$laboratorio_nome', EMAIL='$laboratorio_email', NOTE='$laboratorio_note' WHERE ID=$laboratorio_id";
    } else {
        $sql = "INSERT INTO LABORATORI VALUES('','$laboratorio_nome', '$laboratorio_email', '$laboratorio_note') ";
    }
    $result = mysqli_query($conn, $sql);
    if ($result == 1) {
        echo "<span class='ok_dati'>Dati inseriti correttamente</span>";
        if (isset($_POST["edit"]) && $_POST["edit"] == 'edit') {
            header("location: http:\\cantina\dati_generali.php?type=edit&cat=laboratori");
        }
    } else {
        echo "<span class='ko_dati'>Chiama Tiziano</span>";
    }
}
if (isset($_POST["rabbocchi_data"])) {
    // echo "rabbocchi_data";
    $rabbocchi_data = $_POST["rabbocchi_data"];
    $rabbocchi_nome_vino = $_POST["rabbocchi_nome_vino"];
    $rabbocchi_note = $_POST["rabbocchi_note"];

    // convert date
    $rabbocchi_data = str_replace('/', '-', $rabbocchi_data);
    $rabbocchi_data = date('Y-m-d', strtotime($rabbocchi_data));
    if (isset($_POST["edit"]) && $_POST["edit"] == 'edit') {
        $rabbocchi_id = $_POST["ID"];
        $sql = "UPDATE RABBOCCHI SET ID_VINI ='$rabbocchi_nome_vino', DATA='$rabbocchi_data', NOTE='$rabbocchi_note' WHERE ID=$rabbocchi_id";
    } else {
        $sql = "INSERT INTO RABBOCCHI VALUES('','$rabbocchi_nome_vino', '$rabbocchi_data', '$rabbocchi_note') ";
    }
    $result = mysqli_query($conn, $sql);
    if ($result == 1) {
        echo "<span class='ok_dati'>Dati inseriti correttamente</span>";
        if (isset($_POST["edit"]) && $_POST["edit"] == 'edit') {
            header("location: http:\\cantina\dati_generali.php?type=edit&cat=rabbocchi");
        }
    } else {
        echo "<span class='ko_dati'>Chiama Tiziano</span>";
    }
}
if (isset($_POST["botti_data"])) {
    // echo "botti_data";
    $botti_data = $_POST["botti_data"];
    $botti_costo = $_POST["botti_costo"];
    $botti_sigla = $_POST["botti_sigla"];
    $botti_capacita = $_POST["botti_capacita"];
    $botti_descrizione = $_POST["botti_descrizione"];


    // convert date
    $botti_data = str_replace('/', '-', $botti_data);
    $botti_data = date('Y-m-d', strtotime($botti_data));
    if (isset($_POST["edit"]) && $_POST["edit"] == 'edit') {
        $botti_id = $_POST["ID"];
        $sql = "UPDATE BOTTI SET DATA ='$botti_data', COSTO='$botti_costo', SIGLA='$botti_sigla', CAPACITA='$botti_capacita', DESCRIZIONE='$botti_descrizione' WHERE ID=$botti_id";
    } else {
        $sql = "INSERT INTO BOTTI VALUES('','$botti_data', '$botti_costo', '$botti_sigla', '$botti_descrizione', '$botti_capacita') ";
    }
    $result = mysqli_query($conn, $sql);
    if ($result == 1) {
        echo "<span class='ok_dati'>Dati inseriti correttamente</span>";
        if (isset($_POST["edit"]) && $_POST["edit"] == 'edit') {
            header("location: http:\\cantina\dati_generali.php?type=edit&cat=botti");
        }
    } else {
        echo "<span class='ko_dati'>Chiama Tiziano</span>";
    }
}
if (isset($_POST["flussi_data"])) {
    // echo "flussi_data";

    $flussi_botte = $_POST["flussi_botte"];
    $flussi_provenienza_id = $_POST["flussi_provenienza_id"];
    $flussi_azione = $_POST["flussi_azione"];
    $flussi_quantita_riempimento = $_POST["flussi_quantita_riempimento"];
    $flussi_data = $_POST["flussi_data"];
    $flussi_note = $_POST["flussi_note"];
    if (strlen($flussi_provenienza_id) == 4) {
        $flussi_id_rel = $flussi_provenienza_id;
    } else {
        $flussi_id_rel = 0;
    }
    if (isset($_POST["flussi_estinta"])) {
        $flussi_estinta = '1';
    } else {
        $flussi_estinta = '0';
    }


    // convert date
    $flussi_data = str_replace('/', '-', $flussi_data);
    $flussi_data = date('Y-m-d', strtotime($flussi_data));
    if (isset($_POST["edit"]) && $_POST["edit"] == 'edit') {
        $flussi_id = $_POST["ID"];
        $sql = "UPDATE FLUSSI SET ID_REL ='$flussi_id_rel', "
                . "BOTTE='$flussi_botte', "
                . "PROVENIENZA_ID='$flussi_provenienza_id', "
                . "AZIONE='$flussi_azione', "
                . "DATA='$flussi_data', "
                . "ESTINTA='$flussi_estinta', "
                . "QUANTITA_RIEMPIMENTO='$flussi_quantita_riempimento', "
                . "NOTE='$flussi_note'"
                . "WHERE ID=$flussi_id";
    } else {
        $sql = "INSERT INTO FLUSSI VALUES('','$flussi_id_rel', '$flussi_botte', '$flussi_provenienza_id', '$flussi_quantita_riempimento', '$flussi_azione', '$flussi_data', '$flussi_estinta', '$flussi_note') ";
    }
    $result = mysqli_query($conn, $sql);
    if ($result == 1) {
        echo "<span class='ok_dati'>Dati inseriti correttamente</span>";
        if (isset($_POST["edit"]) && $_POST["edit"] == 'edit') {
            header("location: http:\\cantina\dati_generali.php?type=edit&cat=flussi");
        }
    } else {
        echo "<span class='ko_dati'>Chiama Tiziano</span>";
    }
}
// recupero dati per select
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql_laboratori = "SELECT ID, NOME FROM `LABORATORI`";
$result_laboratori = mysqli_query($conn, $sql_laboratori);

$sql_vini = "SELECT ID, NOME, ANNATA FROM VINI";
$result_vini = mysqli_query($conn, $sql_vini);

$sql_vendemmie = "SELECT ID, DATA, LUOGO FROM `VENDEMMIE`";
$result_vendemmie = mysqli_query($conn, $sql_vendemmie);

$sql_botti_vendemmie = "SELECT BOTTI.ID AS ID_RIF, BOTTI.SIGLA AS NOME FROM BOTTI 
UNION 
SELECT VENDEMMIE.ID AS ID_RIF, CONCAT(VENDEMMIE.ID, ' ',VENDEMMIE.LUOGO, ' ', VENDEMMIE.DATA) AS DATA_V FROM VENDEMMIE WHERE ESTINTA=0";
$result_botti_vendemmie = mysqli_query($conn, $sql_botti_vendemmie);
$sql_botti = "SELECT BOTTI.ID AS ID_RIF, BOTTI.SIGLA AS SIGLA FROM BOTTI";
$result_botti = mysqli_query($conn, $sql_botti);
$sql_azioni = "SELECT * FROM AZIONI";
$result_azioni = mysqli_query($conn, $sql_azioni);
$sql_uve = "SELECT * FROM UVE";
$result_uve = mysqli_query($conn, $sql_uve);
?>
<div class="panel inserimento_dati">
    <div class="panel-group" id="accordion">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-1">Vendemmie</a>
                </h4>
            </div>
            <div id="pannello-1" class="panel-collapse collapse in <?php echo $vendemmie; ?> ">
                <div class="panel-body">
                    <form action="#" method="post" id="inserimento_vendemmia">
                        <div class="row">
                            <div class="col-sm-12 titoletto">Inserimento Vendemmia</div>
                            <label for="vendemmia_data" class="col-sm-1 control-label">Data</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control datepicker" data-date-format="mm/dd/yyyy" id="vendemmia_data" name="vendemmia_data" value="<?php
                                if (isset($row_{'vendemmie'}['DATA'])) {
                                    echo $row_{'vendemmie'}['DATA'];
                                }
                                ?>">
                            </div>
                            <label for="vendemmia_uva" class="col-sm-1 control-label">Uva</label>
                            <div class="col-sm-1">
                                <select name="vendemmia_uva">
                                    <?php
                                    while ($row_uve = mysqli_fetch_array($result_uve)) {
                                        echo "<option value='" . $row_uve['ID'] . "'";
                                        if (isset($row_{'vendemmie'}['UVA'])) {
                                            if ($row_{'vendemmie'}['UVA'] == $row_uve['ID']) {
                                                echo "selected='selected' ";
                                            }
                                        }
                                        echo ">" . $row_uve['DESCRIZIONE'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label for="vendemmia_costo" class="col-sm-1 control-label">Costo</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="vendemmia_costo" name="vendemmia_costo" value="<?php
                                if (isset($row_{'vendemmie'}['COSTO'])) {
                                    echo $row_{'vendemmie'}['COSTO'];
                                }
                                ?>" placeholder="Quanto abbiamo speso">
                            </div>
                            <label for="vendemmia_estinta" class="col-sm-1 control-label">Estinta</label>
                            <div class="col-sm-1">
                                <input type="checkbox" class="checkbox form-control"  id="vendemmia_estinta" name="vendemmia_estinta" value="1" <?php
                                if ($row_{'vendemmie'}['ESTINTA'] == '1') {
                                    echo "checked";
                                }
                                ?> placeholder="Dove è stata fatta">
                            </div>
                            <label for="vendemmia_luogo" class="col-sm-1 control-label">Luogo</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control"  id="vendemmia_luogo" name="vendemmia_luogo" value="<?php
                                if (isset($row_{'vendemmie'}['LUOGO'])) {
                                    echo $row_{'vendemmie'}['LUOGO'];
                                }
                                ?>" placeholder="Dove è stata fatta">
                            </div>

                            <label for="vendemmia_dettagli" class="col-sm-1 control-label">Dettagli</label>
                            <div class="col-sm-5">
                                <textarea class="form-control"  id="vendemmia_dettagli" name="vendemmia_dettagli" ><?php
                                    if (isset($row_{'vendemmie'}['DETTAGLI'])) {
                                        echo $row_{'vendemmie'}['DETTAGLI'];
                                    }
                                    ?>
                                </textarea>
                            </div>
                            <label for="vendemmia_note" class="col-sm-1 control-label">Note</label>
                            <div class="col-sm-5">
                                <textarea class="form-control"  id="vendemmia_note" name="vendemmia_note" ><?php
                                    if (isset($row_{'vendemmie'}['NOTE'])) {
                                        echo $row_{'vendemmie'}['NOTE'];
                                    }
                                    ?></textarea>
                            </div>
                            <?php if (isset($vendemmie)) { ?>
                                <input type="hidden" value="edit" name="edit">
                                <input type="hidden" value="<?php echo $row_{'vendemmie'}['ID']; ?>" name="ID">
                                <div class="col-sm-12"><button class="btn btn-primary" type="submit">Modifica Vendemmia</button></div>
                            <?php } else { ?>
                                <div class="col-sm-12"><button class="btn btn-primary disabled" type="submit">Inserisci Vendemmia</button></div>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-7">Flussi</a>
                </h4>
            </div>
            <div id="pannello-7" class="panel-collapse collapse in <?php echo $flussi; ?> ">
                <div class="panel-body">
                    <form action="#" method="post" id="inserimento_flussi">
                        <div class="row">
                            <div class="col-sm-12 titoletto">Inserimento Flusso</div>        
                            <label for="flussi_data" class="col-sm-1 control-label">Data Operazione</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control datepicker" data-date-format="mm/dd/yyyy" id="flussi_data" name="flussi_data" placeholder="" value="<?php
                                if (isset($row_{'flussi'}['DATA'])) {
                                    // convert date
                                    $flussi_data = $row_{'flussi'}['DATA'];
                                    $flussi_data = date('d-m-Y', strtotime($flussi_data));
                                    $flussi_data = str_replace('-', '/', $flussi_data);

                                    echo $flussi_data;
                                }
                                ?>">
                            </div>

                            <label for="flussi_botte" class="col-sm-2 control-label">Botte Destinazione</label>
                            <div class="col-sm-1">
                                <select name="flussi_botte">
                                    <?php
                                    while ($row_botti = mysqli_fetch_array($result_botti)) {
                                        echo "<option value='" . $row_botti['ID_RIF'] . "'";
                                        if (isset($row_{'flussi'}['BOTTE'])) {
                                            if ($row_botti['ID_RIF'] == $row_{'flussi'}['BOTTE']) {
                                                echo "selected='selected' ";
                                            }
                                        }
                                        echo ">" . $row_botti['SIGLA'] . "</option>";
                                    }
                                    ?>

                                    <option value="999999">Fine/Bottiglie</option>
                                </select>
                            </div>
                            <label for="flussi_provenienza_id" class="col-sm-1 control-label">Provenienza</label>
                            <div class="col-sm-1">
                                <select name="flussi_provenienza_id">
                                    <?php
                                    while ($row_botti_vendemmie = mysqli_fetch_array($result_botti_vendemmie)) {
                                        echo "<option value='" . $row_botti_vendemmie['ID_RIF'] . "'";
                                        if (isset($row_{'flussi'}['PROVENIENZA_ID'])) {
                                            if ($row_botti_vendemmie['ID_RIF'] == $row_{'flussi'}['PROVENIENZA_ID']) {
                                                echo "selected='selected' ";
                                            }
                                        }
                                        echo ">" . $row_botti_vendemmie['NOME'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>                            
                            <div class="col-sm-1"></div>
                            <label for="flussi_azione" class="col-sm-1 control-label">Operazione per</label>
                            <div class="col-sm-1">
                                <select name="flussi_azione">
                                    <?php
                                    while ($row_azioni = mysqli_fetch_array($result_azioni)) {
                                        echo "<option value='" . $row_azioni['ID'] . "'";
                                        if (isset($row_{'flussi'}['AZIONE'])) {
                                            if ($row_azioni['ID'] == $row_{'flussi'}['AZIONE']) {
                                                echo "selected='selected' ";
                                            }
                                        }
                                        echo ">" . $row_azioni['DESCRIZIONE'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>  
                            <label for="flussi_estinta" class="col-sm-1 control-label">Estinta</label>
                            <div class="col-sm-1">
                                <input type="checkbox" class="checkbox form-control"  id=flussi_estinta" name="flussi_estinta" value="1" <?php
                                if (isset($row_{'flussi'}['ESTINTA'])) {
                                    if ($row_{'flussi'}['ESTINTA'] == '1') {
                                        echo "checked";
                                    }
                                }
                                ?> placeholder="Dove è stata fatta">
                            </div>
                            <label for="flussi_quantita_riempimento" class="col-sm-4 control-label">Percentuale Riempimento Botte Destinazione</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="flussi_quantita_riempimento" name="flussi_quantita_riempimento" placeholder="valore in %" value="<?php
                                if (isset($row_{'flussi'}['QUANTITA_RIEMPIMENTO'])) {
                                    echo $row_{'flussi'}['QUANTITA_RIEMPIMENTO'];
                                }
                                ?>"> 
                            </div>  
                            <label for="flussi_note" class="col-sm-1 control-label">Note</label>
                            <div class="col-sm-6">
                                <textarea class="form-control"  id="flussi_note" name="flussi_note" > 
                                    <?php
                                    if (isset($row_{'flussi'}['NOTE'])) {
                                        echo $row_{'flussi'}['NOTE'];
                                    }
                                    ?>
                                </textarea>
                                <?php if (isset($flussi)) { ?>
                                    <input type="hidden" value="edit" name="edit">
                                    <input type="hidden" value="<?php echo $row_{'flussi'}['ID']; ?>" name="ID">
                                    <div class="col-sm-12"><button class="btn btn-primary" type="submit">Modifica Flusso</button></div>
                                <?php } else { ?>
                                    <div class="col-sm-12"><button class="btn btn-primary" type="submit">Inserisci Flusso</button></div>
                                <?php } ?>
                            </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-2">Vini</a>
                </h4>
            </div>
            <div id="pannello-2" class="panel-collapse collapse in <?php echo $vini; ?> ">
                <div class="panel-body">
                    <form action="#" method="post" id="inserimento_vino">
                        <div class="row">
                            <div class="col-sm-12 titoletto">Inserimento Vino</div>
                            <label for="vino_data" class="col-sm-2 control-label">Data Imbottigliamento</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control datepicker" data-date-format="mm/dd/yyyy" id="vino_data" name="vino_data" placeholder=""  value="<?php
                                if (isset($row_{'vini'}['DATA_IMBOTTIGLIAMENTO'])) {
                                    echo $row_{'vini'}['DATA_IMBOTTIGLIAMENTO'];
                                }
                                ?>">
                            </div>
                            <label for="vino_nome" class="col-sm-1 control-label">Nome</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control"  id="vino_nome" name="vino_nome" placeholder="Il nome del vino" value="<?php
                                if (isset($row_{'vini'}['NOME'])) {
                                    echo $row_{'vini'}['NOME'];
                                }
                                ?>">
                            </div>   
                            <label for="vino_vendemmia" class="col-sm-1 control-label">Vendemmia</label>
                            <div class="col-sm-3">
                                <select name="vino_vendemmia">
                                    <?php
                                    while ($row_vendemmie = mysqli_fetch_array($result_vendemmie)) {
                                        echo "<option value='" . $row_vendemmie['ID'] . "' ";
                                        if (isset($row_{'vini'}['ID_VENDEMMIE'])) {
                                            if ($row_{'vini'}['ID_VENDEMMIE'] == $row_vendemmie['ID']) {
                                                echo "selected='selected' ";
                                            }
                                        }
                                        echo">" . $row_vendemmie['LUOGO'] . " " . $row_vendemmie['DATA'] . "</option>";
                                    }
                                    ?>
                                </select>     
                            </div>
                            <label for="vino_note" class="col-sm-2 control-label">Note</label>
                            <div class="col-sm-10">
                                <textarea class="form-control"  id="vino_note" name="vino_note" > <?php
                                    if (isset($row_{'vini'}['NOTE'])) {
                                        echo $row_{'vini'}['NOTE'];
                                    }
                                    ?></textarea>
                            </div>
                            <?php if (isset($vini)) { ?>
                                <input type="hidden" value="edit" name="edit">
                                <input type="hidden" value="<?php echo $row_{'vini'}['ID']; ?>" name="ID">
                                <div class="col-sm-12"><button class="btn btn-primary" type="submit">Modifica Vino</button></div>
                            <?php } else { ?>
                                <div class="col-sm-12"><button class="btn btn-primary" type="submit">Inserisci Vino</button></div>
                            <?php } ?>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-3">Analisi</a>
                </h4>
            </div>
            <div id="pannello-3" class="panel-collapse collapse in <?php echo $analisi; ?> ">
                <div class="panel-body">
                    <form action="#" method="post" id="inserimento_analisi">
                        <div class="row">
                            <div class="col-sm-12 titoletto">Inserimento Analisi</div>
                            <label for="analisi_data" class="col-sm-2 control-label">Data</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control datepicker" data-date-format="mm/dd/yyyy" id="analisi_data" name="analisi_data" placeholder="" value="<?php
                                if (isset($row_{'analisi'}['DATA'])) {
                                    // convert date
                                    $analisi_data = $row_{'analisi'}['DATA'];
                                    $analisi_data = date('d-m-Y', strtotime($analisi_data));
                                    $analisi_data = str_replace('-', '/', $analisi_data);

                                    echo $analisi_data;
                                }
                                ?>">
                            </div>
                            <label for="analisi_nome_vino" class="col-sm-1 control-label">Vino</label>
                            <div class="col-sm-2">
                                <select name="analisi_nome_vino">
                                    <?php
                                    while ($row_vini = mysqli_fetch_array($result_vini)) {
                                        echo "<option value='" . $row_vini['ID'] . "'";
                                        if (isset($row_{'analisi'}['ID_VINI'])) {
                                            if ($row_{'analisi'}['ID_VINI'] == $row_vini['ID']) {
                                                echo "selected='selected' ";
                                            }
                                        }
                                        echo ">" . $row_vini['NOME'] . " " . $row_vini['ANNATA'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label for="analisi_laboratorio" class="col-sm-1 control-label">Laboratorio</label>
                            <div class="col-sm-4">
                                <select name="analisi_laboratorio">
                                    <?php
                                    while ($row_laboratori = mysqli_fetch_array($result_laboratori)) {
                                        echo "<option value='" . $row_laboratori['ID'] . "'";
                                        if (isset($row_{'analisi'}['ID_LABORATORIO'])) {
                                            if ($row_{'analisi'}['ID_LABORATORIO'] == $row_laboratori['ID']) {
                                                echo "selected='selected' ";
                                            }
                                        }
                                        echo ">" . $row_laboratori['NOME'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-1"></div>
                            <label for="analisi_tav" class="col-sm-2 control-label">Titolo Alcolmetrico Volumico</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_tav" name="analisi_tav" placeholder="valore" value="<?php
                                if (isset($row_{'analisi'}['TITOLO_ALCOLOMETRICO_VOLUMICO'])) {
                                    echo $row_{'analisi'}['TITOLO_ALCOLOMETRICO_VOLUMICO'];
                                }
                                ?>">
                            </div>
                            <label for="analisi_tav_um" class="col-sm-1 control-label">Unità di misura</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_tav_um" name="analisi_tav_um" value="<?php
                                if (isset($row_{'analisi'}['TITOLO_ALCOLOMETRICO_VOLUMICO_UM'])) {
                                    echo $row_{'analisi'}['TITOLO_ALCOLOMETRICO_VOLUMICO_UM'];
                                }
                                ?>">
                            </div>
                            <label for="analisi_tav_met" class="col-sm-2 control-label">Metodo</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  id="analisi_tav_met" name="analisi_tav_met" value="<?php
                                if (isset($row_{'analisi'}['TITOLO_ALCOLOMETRICO_VOLUMICO_METODO'])) {
                                    echo $row_{'analisi'}['TITOLO_ALCOLOMETRICO_VOLUMICO_METODO'];
                                }
                                ?>">
                            </div>

                            <label for="analisi_at" class="col-sm-2 control-label">Acidità Totale</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_at" name="analisi_at" placeholder="valore" value="<?php
                                if (isset($row_{'analisi'}['ACIDITA_TOTALE'])) {
                                    echo $row_{'analisi'}['ACIDITA_TOTALE'];
                                }
                                ?>">
                            </div>
                            <label for="analisi_at_um" class="col-sm-1 control-label">Unità di misura</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_at_um" name="analisi_at_um" value="<?php
                                if (isset($row_{'analisi'}['ACIDITA_TOTALE_UM'])) {
                                    echo $row_{'analisi'}['ACIDITA_TOTALE_UM'];
                                }
                                ?>">
                            </div>
                            <label for="analisi_at_met" class="col-sm-2 control-label">Metodo</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  id="analisi_at_met" name="analisi_at_met" value="<?php
                                if (isset($row_{'analisi'}['ACIDITA_TOTALE_METODO'])) {
                                    echo $row_{'analisi'}['ACIDITA_TOTALE_METODO'];
                                }
                                ?>">
                            </div>

                            <label for="analisi_av" class="col-sm-2 control-label">Acidità Volatile</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_av" name="analisi_av" placeholder="valore" value="<?php
                                if (isset($row_{'analisi'}['ACIDITA_VOLATILE'])) {
                                    echo $row_{'analisi'}['ACIDITA_VOLATILE'];
                                }
                                ?>">
                            </div>
                            <label for="analisi_av_um" class="col-sm-1 control-label">Unità di misura</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_av_um" name="analisi_av_um" value="<?php
                                if (isset($row_{'analisi'}['ACIDITA_VOLATILE_UM'])) {
                                    echo $row_{'analisi'}['ACIDITA_VOLATILE_UM'];
                                }
                                ?>">
                            </div>
                            <label for="analisi_av_met" class="col-sm-2 control-label">Metodo</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  id="analisi_av_met" name="analisi_av_met" value="<?php
                                if (isset($row_{'analisi'}['ACIDITA_VOLATILE_METODO'])) {
                                    echo $row_{'analisi'}['ACIDITA_VOLATILE_METODO'];
                                }
                                ?>">
                            </div>

                            <label for="analisi_asl" class="col-sm-2 control-label">Anidiride Solforosa Libera</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_asl" name="analisi_asl" placeholder="valore" value="<?php
                                if (isset($row_{'analisi'}['ANIDIRIDE_SOLFOROSA_LIBERA'])) {
                                    echo $row_{'analisi'}['ANIDIRIDE_SOLFOROSA_LIBERA'];
                                }
                                ?>">
                            </div>
                            <label for="analisi_asl_um" class="col-sm-1 control-label">Unità di misura</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_asl_um" name="analisi_asl_um" value="<?php
                                if (isset($row_{'analisi'}['ANIDIRIDE_SOLFOROSA_LIBERA_UM'])) {
                                    echo $row_{'analisi'}['ANIDIRIDE_SOLFOROSA_LIBERA_UM'];
                                }
                                ?>">
                            </div>
                            <label for="analisi_asl_met" class="col-sm-2 control-label">Metodo</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  id="analisi_asl_met" name="analisi_asl_met" value="<?php
                                if (isset($row_{'analisi'}['ANIDIRIDE_SOLFOROSA_LIBERA_METODO'])) {
                                    echo $row_{'analisi'}['ANIDIRIDE_SOLFOROSA_LIBERA_METODO'];
                                }
                                ?>">
                            </div>

                            <label for="analisi_ast" class="col-sm-2 control-label">Anidiride Solforosa Totale</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_ast" name="analisi_ast" placeholder="valore" value="<?php
                                if (isset($row_{'analisi'}['ANIDIRIDE_SOLFOROSA_TOTALE'])) {
                                    echo $row_{'analisi'}['ANIDIRIDE_SOLFOROSA_TOTALE'];
                                }
                                ?>">
                            </div>
                            <label for="analisi_ast_um" class="col-sm-1 control-label">Unità di misura</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_ast_um" name="analisi_ast_um" value="<?php
                                if (isset($row_{'analisi'}['ANIDIRIDE_SOLFOROSA_TOTALE_UM'])) {
                                    echo $row_{'analisi'}['ANIDIRIDE_SOLFOROSA_TOTALE_UM'];
                                }
                                ?>">
                            </div>
                            <label for="analisi_ast_met" class="col-sm-2 control-label">Metodo</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  id="analisi_ast_met" name="analisi_ast_met" value="<?php
                                if (isset($row_{'analisi'}['ANIDIRIDE_SOLFOROSA_TOTALE_METODO'])) {
                                    echo $row_{'analisi'}['ANIDIRIDE_SOLFOROSA_TOTALE_METODO'];
                                }
                                ?>">
                            </div>

                            <label for="analisi_alm" class="col-sm-2 control-label">Acido L Malico</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_alm" name="analisi_alm" placeholder="valore" value="<?php
                                if (isset($row_{'analisi'}['ACIDO_L_MALICO'])) {
                                    echo $row_{'analisi'}['ACIDO_L_MALICO'];
                                }
                                ?>">
                            </div>
                            <label for="analisi_alm_um" class="col-sm-1 control-label">Unità di misura</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_alm_um" name="analisi_alm_um" value="<?php
                                if (isset($row_{'analisi'}['ACIDO_L_MALICO_UM'])) {
                                    echo $row_{'analisi'}['ACIDO_L_MALICO_UM'];
                                }
                                ?>">
                            </div>
                            <label for="analisi_alm_met" class="col-sm-2 control-label">Metodo</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  id="analisi_alm_met" name="analisi_alm_met" value="<?php
                                if (isset($row_{'analisi'}['ACIDO_L_MALICO_METODO'])) {
                                    echo $row_{'analisi'}['ACIDO_L_MALICO_METODO'];
                                }
                                ?>">
                            </div>

                            <label for="analisi_all" class="col-sm-2 control-label">Acido L Lattico</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_all" name="analisi_all" placeholder="valore" value="<?php
                                if (isset($row_{'analisi'}['ACIDO_L_LATTICO'])) {
                                    echo $row_{'analisi'}['ACIDO_L_LATTICO'];
                                }
                                ?>">
                            </div>
                            <label for="analisi_all_um" class="col-sm-1 control-label">Unità di misura</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_all_um" name="analisi_all_um" value="<?php
                                if (isset($row_{'analisi'}['ACIDO_L_LATTICO_UM'])) {
                                    echo $row_{'analisi'}['ACIDO_L_LATTICO_UM'];
                                }
                                ?>">
                            </div>
                            <label for="analisi_all_met" class="col-sm-2 control-label">Metodo</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  id="analisi_all_met" name="analisi_all_met" value="<?php
                                if (isset($row_{'analisi'}['ACIDO_L_LATTICO_METODO'])) {
                                    echo $row_{'analisi'}['ACIDO_L_LATTICO_METODO'];
                                }
                                ?>">
                            </div>

                            <label for="analisi_ph" class="col-sm-2 control-label">PH</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="analisi_ph" name="analisi_ph" placeholder="valore" value="<?php
                                if (isset($row_{'analisi'}['PH'])) {
                                    echo $row_{'analisi'}['PH'];
                                }
                                ?>">
                            </div>        
                            <div class="col-sm-2"></div>
                            <label for="analisi_ph_met" class="col-sm-2 control-label">Metodo</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  id="analisi_ph_met" name="analisi_ph_met" value="<?php
                                if (isset($row_{'analisi'}['PH_METODO'])) {
                                    echo $row_{'analisi'}['PH_METODO'];
                                }
                                ?>">
                            </div>

                            <label for="analisi_trat_cons" class="col-sm-1 control-label">Trattamento Consigliato</label>
                            <div class="col-sm-5">
                                <textarea class="form-control"  id="analisi_trat_cons" name="analisi_trat_cons" ><?php
                                    if (isset($row_{'analisi'}['TRATTAMENTO_CONSIGLIATO'])) {
                                        echo $row_{'analisi'}['TRATTAMENTO_CONSIGLIATO'];
                                    }
                                    ?></textarea>
                            </div>
                            <label for="analisi_note" class="col-sm-1 control-label">Note</label>
                            <div class="col-sm-5">
                                <textarea class="form-control"  id="analisi_note" name="analisi_note" ><?php
                                    if (isset($row_{'analisi'}['NOTE'])) {
                                        echo $row_{'analisi'}['NOTE'];
                                    }
                                    ?></textarea>
                            </div>
                            <?php if (isset($analisi)) { ?>
                                <input type="hidden" value="edit" name="edit">
                                <input type="hidden" value="<?php echo $row_{'analisi'}['ID']; ?>" name="ID">
                                <div class="col-sm-12"><button class="btn btn-primary" type="submit">Modifica Analisi</button></div>
                            <?php } else { ?>
                                <div class="col-sm-12"><button class="btn btn-primary" type="submit">Inserisci Analisi</button></div>
                            <?php } ?>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-4">Laboratori</a>
                </h4>
            </div>
            <div id="pannello-4" class="panel-collapse collapse in <?php echo $laboratori; ?> ">
                <div class="panel-body">
                    <form action="#" method="post" id="inserimento_laboratorio">
                        <div class="row">
                            <div class="col-sm-12 titoletto">Inserimento Laboratorio</div>        
                            <label for="laboratorio_nome" class="col-sm-1 control-label">Nome</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  id="laboratorio_nome" name="laboratorio_nome" placeholder=""  value="<?php
                                if (isset($row_{'laboratori'}['NOME'])) {
                                    echo $row_{'laboratori'}['NOME'];
                                }
                                ?>">
                            </div>
                            <label for="laboratorio_email" class="col-sm-1 control-label">E-mail</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  id="laboratorio_email" name="laboratorio_email" placeholder="Email principale del laboratorio" value="<?php
                                if (isset($row_{'laboratori'}['EMAIL'])) {
                                    echo $row_{'laboratori'}['EMAIL'];
                                }
                                ?>">
                            </div>
                            <label for="laboratorio_note" class="col-sm-1 control-label">Note</label>
                            <div class="col-sm-5">
                                <textarea class="form-control"  id="laboratorio_note" name="laboratorio_note" ><?php
                                    if (isset($row_{'laboratori'}['NOTE'])) {
                                        echo $row_{'laboratori'}['NOTE'];
                                    }
                                    ?></textarea>
                            </div>
                            <?php if (isset($laboratori)) { ?>
                                <input type="hidden" value="edit" name="edit">
                                <input type="hidden" value="<?php echo $row_{'laboratori'}['ID']; ?>" name="ID">
                                <div class="col-sm-12"><button class="btn btn-primary" type="submit">Modifica Laboratorio</button></div>
                            <?php } else { ?>
                                <div class="col-sm-12"><button class="btn btn-primary" type="submit">Inserisci Laboratorio</button></div>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-5">Rabbocchi</a>
                </h4>
            </div>
            <div id="pannello-5" class="panel-collapse collapse in <?php echo $rabbocchi; ?> ">
                <div class="panel-body">
                    <form action="#" method="post" id="inserimento_rabbocchi">
                        <div class="row">
                            <div class="col-sm-12 titoletto">Inserimento Rabbocco</div>        
                            <label for="rabbocchi_data" class="col-sm-1 control-label">Data</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control datepicker" data-date-format="mm/dd/yyyy" id="rabbocchi_data" name="rabbocchi_data" placeholder="" value="<?php
                                if (isset($row_{'rabbocchi'}['DATA'])) {
                                    // convert date
                                    $rabbocchi_data = $row_{'rabbocchi'}['DATA'];
                                    $rabbocchi_data = date('d-m-Y', strtotime($rabbocchi_data));
                                    $rabbocchi_data = str_replace('-', '/', $rabbocchi_data);

                                    echo $rabbocchi_data;
                                }
                                ?>">
                            </div>
                            <label for="rabbocchi_nome_vino" class="col-sm-1 control-label">Vino</label>
                            <div class="col-sm-2">
                                <?php
                                $sql_vini = "SELECT ID, NOME, ANNATA FROM VINI";
                                $result_vini_rabbocchi = mysqli_query($conn, $sql_vini);
                                ?>
                                <select name="rabbocchi_nome_vino">                                 
                                    <?php
                                    while ($row_vini = mysqli_fetch_array($result_vini_rabbocchi)) {
                                        echo "<option value='" . $row_vini['ID'] . "'";
                                        if (isset($row_{'rabbocchi'}['ID_VINI'])) {
                                            if ($row_{'rabbocchi'}['ID_VINI'] == $row_vini['ID']) {
                                                echo " selected='selected' ";
                                            }
                                        }
                                        echo ">" . $row_vini['NOME'] . " " . $row_vini['ANNATA'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-7"></div>
                            <label for="rabbocchi_note" class="col-sm-1 control-label">Note</label>
                            <div class="col-sm-9">
                                <textarea class="form-control"  id="rabbocchi_note" name="rabbocchi_note" ><?php
                                    if (isset($row_{'rabbocchi'}['NOTE'])) {
                                        echo $row_{'rabbocchi'}['NOTE'];
                                    }
                                    ?></textarea>
                            </div>
                            <?php if (isset($rabbocchi)) { ?>
                                <input type="hidden" value="edit" name="edit">
                                <input type="hidden" value="<?php echo $row_{'rabbocchi'}['ID']; ?>" name="ID">
                                <div class="col-sm-12"><button class="btn btn-primary" type="submit">Modifica Rabbocco</button></div>
                            <?php } else { ?>
                                <div class="col-sm-12"><button class="btn btn-primary" type="submit">Inserisci Rabbocco</button></div>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-6">Botti</a>
                </h4>
            </div>
            <div id="pannello-6" class="panel-collapse collapse in <?php echo $botti; ?> ">
                <div class="panel-body">
                    <form action="#" method="post" id="inserimento_botti">
                        <div class="row">
                            <div class="col-sm-12 titoletto">Inserimento Botte</div>        
                            <label for="botti_data" class="col-sm-1 control-label">Data Acquisto</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control datepicker" data-date-format="mm/dd/yyyy" id="botti_data" name="botti_data" placeholder="" value="<?php
                                if (isset($row_{'botti'}['DATA'])) {
                                    // convert date
                                    $botti_data = $row_{'botti'}['DATA'];
                                    $botti_data = date('d-m-Y', strtotime($botti_data));
                                    $botti_data = str_replace('-', '/', $botti_data);

                                    echo $botti_data;
                                }
                                ?>">
                            </div>
                            <label for="botti_costo" class="col-sm-1 control-label">Costo</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="botti_costo" name="botti_costo" placeholder="" value="<?php
                                if (isset($row_{'botti'}['COSTO'])) {
                                    echo $row_{'botti'}['COSTO'];
                                }
                                ?>">
                            </div>
                            <label for="botti_sigla" class="col-sm-1 control-label">Sigla</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="botti_sigla" name="botti_sigla" placeholder="" value="<?php
                                if (isset($row_{'botti'}['SIGLA'])) {
                                    echo $row_{'botti'}['SIGLA'];
                                }
                                ?>">
                            </div>
                            <label for="botti_capacita" class="col-sm-1 control-label">Capacità</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control"  id="botti_capacita" name="botti_capacita" placeholder="" value="<?php
                                if (isset($row_{'botti'}['CAPACITA'])) {
                                    echo $row_{'botti'}['CAPACITA'];
                                }
                                ?>">
                            </div>                            
                            <div class="col-sm-4"></div>
                            <label for="botti_descrizione" class="col-sm-1 control-label">Descrizione</label>
                            <div class="col-sm-9">
                                <textarea class="form-control"  id="botti_descrizione" name="botti_descrizione" ><?php
                                    if (isset($row_{'botti'}['DESCRIZIONE'])) {
                                        echo $row_{'botti'}['DESCRIZIONE'];
                                    }
                                    ?></textarea>
                            </div>
                            <?php if (isset($botti)) { ?>
                                <input type="hidden" value="edit" name="edit">
                                <input type="hidden" value="<?php echo $row_{'botti'}['ID']; ?>" name="ID">
                                <div class="col-sm-12"><button class="btn btn-primary" type="submit">Modifica Botte</button></div>
                            <?php } else { ?>
                                <div class="col-sm-12"><button class="btn btn-primary" type="submit">Inserisci Botte</button></div>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include 'general_bottom.php'; ?>
   