<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'config.php'; ?>
        <?php include 'css_js.php'; ?>
    </head>
    <body>
        <?php
        include "nav.php";
        include "gestione_bottiglie_form.php";

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
            <h4>Numero Totale Bottiglie <?php echo $numero_totale_bottiglie; ?> di cui per la cantina <?php echo $nome_ute_0; ?>  </h4>

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
                    array_push(${"nome_ute_$i" . "_a"}, $i);
                    ${"nome_ute_$i" . "_i"} ++;
                    echo $b . "  - " . $nome . " Bottiglia numero: " . $b . " <br>";
                    $i++;
                } else {
                    echo $b . " <b>Bottiglia usata</b><br>";
                }
            }
   echo "Bottiglie usate: <b><pre>".print_r($bottiglie_scartate)."</pre></b>";
           // echo $totale_persone;
            ?>
            <?php
        }
        ?>
     
    </body>
</html>