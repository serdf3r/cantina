<?php
//$conn = mysqli_connect($servername, $username, $password, $dbname);
//$sql = "SELECT * FROM VENDEMMIE ORDER BY ID DESC";
//$result_vendemmie = mysqli_query($conn, $sql);

$conn = mysqli_connect($servername, $username, $password, $dbname);
//$sql = "SELECT * FROM VINI ORDER BY ID DESC";
$sql = "SELECT * FROM VINI";
$result_vini = mysqli_query($conn, $sql);
$vendemmia = 'ko';
$i = 0;
$a = $i;

while ($row = mysqli_fetch_assoc($result_vini)) {
      
    if ($a != $i) {
        $vendemmia = 'ko';
      
        $a = $i;
    }
    ?>
    <div class="panel-group" id="accordion">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-<?php echo $row['ID']; ?>"><?php echo $row['NOME'] . " " . $row['ANNATA'] . " --- Imbottigliato il giorno: ".date('d-m-Y', strtotime(str_replace('/', '-', substr($row["DATA_IMBOTTIGLIAMENTO"], 0, 10)))); ?></a>
                </h4>
            </div>
            <div id="pannello-<?php echo $row['ID']; ?>" class="panel-collapse collapse in ">
                <div class="panel-body">
                    <div style="display:inline-block;width:100%;overflow-y:auto;">
                        <ul class="timeline timeline-horizontal">
                            <?php
                            // --- Start Imbottigliamento ---
                            $data_prec = $row["DATA_IMBOTTIGLIAMENTO"];
                            ?>
                            <li class="timeline-item imbottigliamento">
                                <div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i><span class="tl_data"><?php echo date('d-m-Y', strtotime(str_replace('/', '-', substr($row["DATA_IMBOTTIGLIAMENTO"], 0, 10)))); ?> </span></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h3 class="timeline-title">Imbottigliamento
                                        </h3>
                                        <p>
                                            <small class="text-muted"><i class="glyphicon glyphicon-time"></i>
                                                 Data: <?php echo date('d-m-Y', strtotime(str_replace('/', '-', substr($row["DATA_IMBOTTIGLIAMENTO"], 0, 10)))); ?> </br> Annata:   
                                                <?php
                                                echo $row["ANNATA"];
                                                ?> 
                                            </small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Finalmente: 
                                            <b><?php
                                            echo $row["NOME"];
                                            ?></b>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <?php
                            // --- end Imbottigliamento ---
                           
                            $i++;
                            $id_flussi = $row['ID_FLUSSI'];
                            
                            $sql_flussi = "SELECT * FROM FLUSSI WHERE ID=$id_flussi";
                            $result_flussi = mysqli_query($conn, $sql_flussi);
                            while ($row_flussi = mysqli_fetch_assoc($result_flussi)) {
                                $data_rel = $row_flussi['DATA'];
                                $provenienza_rel = $row_flussi['PROVENIENZA_ID']; //BOTTE
                                $id_fl = $row_flussi['ID_REL'];
                                
                                while ($vendemmia == 'ko') {
                                   
                                    if ($id_fl != 0) {
                                        $sql_flussi_rel = "SELECT * FROM FLUSSI WHERE DATA<'$data_rel' AND BOTTE = $provenienza_rel ORDER BY DATA DESC LIMIT 1";
                                        $result_flussi_rel = mysqli_query($conn, $sql_flussi_rel);

                                        while ($row_flussi_rel = mysqli_fetch_assoc($result_flussi_rel)) {
                                            // --- Start Analisi ---
                                            $data_prec = $row_flussi_rel['DATA'];
                                            if (isset($data_prec)) {
                                                $sql_analisi = "SELECT * FROM ANALISI WHERE DATA BETWEEN '$data_prec' AND '$data_rel' AND ID_BOTTE = $provenienza_rel ORDER BY DATA DESC";
                                                $result_analisi = mysqli_query($conn, $sql_analisi);
                                                if ($result_analisi != '') {
                                                    while ($row_analisi = mysqli_fetch_assoc($result_analisi)) {
//                                                $data_rel = $row_flussi_rel['DATA'];
                                                        ?>
                                                        <li class="timeline-item analisi">
                                                            <div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i><span class="tl_data"><?php echo date('d-m-Y', strtotime(str_replace('/', '-', substr($row_analisi["DATA"], 0, 10)))); ?> </span></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h3 class="timeline-title">Analisi
                                                                        <?php
//                                                                while ($row = mysqli_fetch_assoc($result_botti)) {
//                                                                    echo $row["SIGLA"];
                                                                        ?>
                                                                    </h3>
                                                                    <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>  
                                                                        
  Data: <?php echo date('d-m-Y', strtotime(str_replace('/', '-', substr($row_analisi["DATA"], 0, 10)))); ?> </br>    <?php echo $row_analisi["NOTE"]; ?>
                                                                        </small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>
                                                                        <?php echo $row_analisi["TITOLO_ALCOLOMETRICO_VOLUMICO"]." ".$row_analisi["TITOLO_ALCOLOMETRICO_VOLUMICO_UM"]; ?>
                                                                        
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                            }
                                            // --- end Analisi ---
                                            $data_rel = $row_flussi_rel['DATA'];
                                            $provenienza_rel = $row_flussi_rel['PROVENIENZA_ID']; //BOTTE
                                            $id_fl = $row_flussi_rel['ID_REL'];
                                            $botte = $row_flussi_rel['BOTTE'];
                                            $azione = $row_flussi_rel['AZIONE'];
                                            $sql = "SELECT * FROM BOTTI WHERE ID=$botte";
                                            $result_botti = mysqli_query($conn, $sql);
                                            $sql = "SELECT * FROM AZIONI WHERE ID=$azione";
                                            $result_azione = mysqli_query($conn, $sql);
                                            ?>
                                            <li class="timeline-item flusso azione_<?php echo $azione;?>">
                                                <div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i><span class="tl_data"><?php echo date('d-m-Y', strtotime(str_replace('/', '-', substr($row_flussi_rel["DATA"], 0, 10)))); ?> </span></div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h3 class="timeline-title"><?php
                                                            while ($row = mysqli_fetch_assoc($result_azione)) {
                                                                echo $row["DESCRIZIONE"];
                                                            }
                                                            ?>
                                                            </h3>
                                                            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>  
                                                                    Data: <?php echo date('d-m-Y', strtotime(str_replace('/', '-', substr($row_flussi_rel["DATA"], 0, 10)))); ?> </br>
                                                            <?php
                                                            while ($row = mysqli_fetch_assoc($result_botti)) {
                                                               
                                                                    echo $row["CAPACITA"];
                                                               
                                                                ?> 
                                                                litri</small></p>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p> Botte <?php
                                                             echo $row["SIGLA"];
                                                              }
                                                                ?>
                                                                   
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                            $vendemmia = 'ko';
                                        }
                                    } else {
                                        $sql_flussi_rel = "SELECT * FROM FLUSSI WHERE DATA='$data_rel' AND BOTTE =$botte ";
                                        $result_flussi_rel = mysqli_query($conn, $sql_flussi_rel);
                                        //     print_r($sql_flussi_rel);

                                        while ($row_flussi_rel = mysqli_fetch_assoc($result_flussi_rel)) {
                                            $id_vend = $row_flussi_rel['PROVENIENZA_ID'];
//                            print_r($botte);
//                            print_r($sql_flussi_rel);
                                            $sql_vendemmie = "SELECT * FROM VENDEMMIE WHERE ID=$id_vend  ";



                                            // print_r($sql_vendemmie);
                                            $result_vendemmie = mysqli_query($conn, $sql_vendemmie);
                                            while ($row_vendemmie = mysqli_fetch_assoc($result_vendemmie)) {
                                                $uva = $row_vendemmie["UVA"];
                                                $sql = "SELECT * FROM UVE WHERE ID=$uva";
                                                $result_uve = mysqli_query($conn, $sql);
                                                ?>
                                                <li class="timeline-item vendemmia">
                                                    <div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i><span class="tl_data"><?php echo date('d-m-Y', strtotime(str_replace('/', '-', substr($row_vendemmie["DATA"], 0, 10)))); ?> </span></div>
                                                    <div class="timeline-panel">
                                                        <div class="timeline-heading">
                                                            <h3 class="timeline-title">Vendemmia <?php echo $row_vendemmie["LUOGO"]; ?></h3>
                                                            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>  
                                                                    <?php
                                                                    while ($row = mysqli_fetch_assoc($result_uve)) {
                                                                        echo $row["DESCRIZIONE"];
                                                                    }
                                                                    ?> - Costo <?php echo $row_vendemmie["COSTO"]; ?> euro</small></p>
                                                        </div>
                                                        <div class="timeline-body">
                                                            <p><?php echo $row_vendemmie["DETTAGLI"]; ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            $vendemmia = 'ok';
                                            $i++;
                                        }
                                    }
                                }
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </ul>
    </div>
    <?php
}
?>        
