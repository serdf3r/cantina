<?php
include 'general_top.php';
// include "gestione_bottiglie_form.php";
?>
<div class="navbar main_menu ">
    <form action="gestione_bottiglie_response.php" method="post">
        <div class="form-group">
            <div class=" row">
                <label for="anno_vino" class="col-sm-1 control-label">Anno</label>
                <div class="col-sm-2">
                    <select class="form-control anno_vino_datepicker" data-date-format="yyyy" id="anno_vino" name="anno_vino" >
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select> 
                </div>
                <label for="nome_vino" class="col-sm-1 control-label pull-right">Nome Vino</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control nome_vino" id="nome_vino" name="nome_vino"  placeholder="---">
                </div>
                <label for="numero_totale_bottiglie" class="col-sm-2 control-label pull-right">Numero Totale Bottiglie</label>
                <div class="col-sm-1">
                    <input type="text" class="form-control numero_totale_bottiglie" id="numero_totale_bottiglie" name="numero_totale_bottiglie"  placeholder="---">
                </div>
                 <label for="bottiglie_scartate" class="col-sm-2 control-label pull-right">Numero Bottiglie Scartate</label>
                <div class="col-sm-1">
                    <input type="text" class="form-control bottiglie_scartate" id="bottiglie_scartate" name="bottiglie_scartate"  placeholder="---">
                </div>
            </div>
            <div class=" row">
                 <div class="col-sm-12"> 
                    <textarea name="note_vino" ></textarea>
                </div>
                </div>
            <div class="container_member ">
                <div class="row row_ute ">
                    <label for="numero_lasciare_bottiglie" class="col-sm-2 control-label pull-right">Numero Per Cantina</label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control numero_lasciare_bottiglie" id="numero_lasciare_bottiglie" name="nome_ute_0"  placeholder="---">
                    </div>
                </div>
                <div class="row row_ute">
                    <label class="col-sm-2 control-label pull-right">Nome</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="nome_ute_1"  placeholder="---">
                    </div>
                    <button type="button" class="col-sm-2 btn elimina_persona btn-danger">elmina</button>
                </div>
            </div>
            <div class="row row_gest pull-right">
                <input type="hidden" name="totale_persone" value="" class="totale_persone">
                <button type="button" class="btn btn-success aggiungi_persona">Aggiungi Persona</button>
                <button type="submit" class="btn btn-primary">Genera</button>
            </div>
        </div>
    </form>

</div>
<?php
if (isset($_POST["anno_vino"])) {
    $bottiglie_scartate[] = $_POST["bottiglie_scartate"];
    $anno_vino = $_POST["anno_vino"];
    $nome_vino = $_POST["nome_vino"];
    $numero_totale_bottiglie = $_POST["numero_totale_bottiglie"];
    $nome_ute_0 = $_POST["nome_ute_0"];
    $totale_persone = $_POST["totale_persone"];
    for ($i = 0; $i < $totale_persone; $i++) {
        ${"nome_ute_$i"} = $_POST["nome_ute_" . $i];
        ${"nome_ute_$i" . "_i"} = '';
        ${"nome_ute_$i" . "_a"} = [];
    }
    ?>
    <h2><?php echo $nome_vino ?> Anno <?php echo $anno_vino; ?> </h2>
    <h4>Numero Totale Bottiglie <?php echo $numero_totale_bottiglie; ?> di cui sicuro per la cantina le prime <?php echo $nome_ute_0; ?>  </h4>
    1 ->
    <?php
    for ($b = $nome_ute_0; $b <= $numero_totale_bottiglie; $b++) {
        if (!in_array($b, $bottiglie_scartate)) {
            if ($i == $totale_persone) {
                $i = 0;
            }
            $nome = "";
            if ($i == 0) {
                $nome = "Cantina ";
            } else {
                $nome = ${"nome_ute_$i"} . " ";
            }
            array_push(${"nome_ute_$i" . "_a"}, $b);
            ${"nome_ute_$i" . "_i"} ++;
            echo $b . "  - " . $nome . " Bottiglia numero: " . $b . " <br>";
            $i++;
        } else {
            echo $b . " <b>Bottiglia usata</b><br>";
        }
    }
    //echo "Bottiglie usate: <b><pre>" . print_r($bottiglie_scartate) . "</pre></b>";
    // echo $totale_persone;
    ?>
    <br><br>
    <?php
    for ($i = 0; $i < $totale_persone; $i++) {
        if ($i == 0) {
            $tot_cantina = sizeof(${"nome_ute_$i" . "_a"}) + $nome_ute_0;
            echo "Totale Cantina : " . $tot_cantina . "<br> 1->";
            $nome = "Cantina ";
        } else {
            echo "Totale " . ${"nome_ute_$i"} . " : " . sizeof(${"nome_ute_$i" . "_a"}) . "<br>";
        }

        foreach (${"nome_ute_$i" . "_a"} as $key => $value) {
            echo $value . "-";
        }
        echo "<br><br><br>";
    }
}

include 'general_bottom.php';
?>
   