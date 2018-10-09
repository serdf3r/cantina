<?php
include 'general_top.php';
include "gestione_bottiglie_form.php";

if (isset($_POST["nome_vino"])) {
    $bottiglie_scartate[] = $_POST["bottiglie_scartate"];
    $anno_vino = $_POST["nome_vino"];
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
   