<?php
include 'general_top.php';
?>
<div class="panel time_line">
    <div class="panel-group" id="accordion">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-1">Timeline</a>
                </h4>
            </div>
            <div id="pannello-1" class="panel-collapse collapse in <?php echo 'show'; ?> ">
                <div class="panel-body">
                    <?php
                    include 'include/time_line.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="panel time_line">
    <div class="panel-group" id="accordion">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pannello-2">Temperatura/Umidità </a>
                </h4>
            </div>
            <div id="pannello-2" class="panel-collapse collapse in <?php echo ''; ?> ">
                <div class="panel-body">
                    <?php
                    include 'main_form.php';
                    ?>

                    <canvas id="chart_temperature" width="400" height="100"></canvas>
                    <canvas id="chart_umidity" width="400" height="100"></canvas>
                        <?php
                        if (isset($_POST["type_of_chart"])) {
                            $type_of_chart = $_POST["type_of_chart"];
                        } else {
                            $type_of_chart = 'line';
                        }
                        if (!isset($_POST["dal"]) || $_POST["dal"] == '') {
                            $dal_rec = date('d/m/Y', strtotime('-6 months'));
                            ;
                        } else {
                            $dal_rec = $_POST["dal"];
                        }
                        if (!isset($_POST["al"]) || $_POST["al"] == '') {
                            $al_rec = date('d/m/Y');
                        } else {
                            $al_rec = $_POST["al"];
                        }
                        //print_r($dal_rec);
                        $dal_query = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $dal_rec)));
                        //print_r($dal_query);
                        $al_query = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $al_rec)));
                        // Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        // Check connection
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
//SELECT count(*), DATE_FORMAT(TIME,"%Y-%m-%d") FROM `GEN_AMB_TEMP_UMI` GROUP BY DATE_FORMAT(TIME,"%Y-%m-%d")
//SELECT DATE_FORMAT(TIME,"%Y-%m-%d") AS TIME, AVG(TEMPERATURE) AS TEMPERATURE, AVG(UMIDITY) AS UMIDITY FROM `GEN_AMB_TEMP_UMI` GROUP BY DATE_FORMAT(TIME,"%Y-%m-%d")
                        $sql = "SELECT DATE_FORMAT(TIME,'%Y-%m-%d') AS GIORNO, AVG(TEMPERATURE) AS TEMPERATURE FROM `GEN_AMB_TEMP_UMI`  WHERE TIME between '$dal_query' and '$al_query' GROUP BY DATE_FORMAT(TIME,'%Y-%m-%d') ORDER BY 'TIME' ASC ";

                        $result = mysqli_query($conn, $sql);
                        $label = '[';
                        $temperatura = '[';
                        $backgroundColor = '[';
                        $borderColor = '[';
                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                $label .= '"' . date('d-m-Y', strtotime(str_replace('/', '-', substr($row["GIORNO"], 0, 10)))) . '",';
                                $temperatura .= '' . $row["TEMPERATURE"] . ',';
                                $backgroundColor .= '"rgba(255, 99, 132, 0.2)",';
                                $borderColor .= '"rgba(255,99,132,1)",';
                            }
                        } else {
                            echo "0 results";
                        }
                        $label .= ']';
                        $temperatura .= ']';
                        $backgroundColor .= ']';
                        $borderColor .= ']';

                        $um_sql = "SELECT DATE_FORMAT(TIME,'%Y-%m-%d') AS GIORNO, AVG(UMIDITY) AS UMIDITY FROM `GEN_AMB_TEMP_UMI`  WHERE TIME between '$dal_query' and '$al_query' GROUP BY DATE_FORMAT(TIME,'%Y-%m-%d') ORDER BY 'TIME' ASC";
                        $um_result = mysqli_query($conn, $um_sql);
                        $um_label = '[';
                        $um_temperatura = '[';
                        $um_backgroundColor = '[';
                        $um_borderColor = '[';
                        if (mysqli_num_rows($um_result) > 0) {
                            // output data of each row
                            while ($um_row = mysqli_fetch_assoc($um_result)) {
                                $um_label .= '"' . date('d-m-Y', strtotime(str_replace('/', '-', substr($um_row["GIORNO"], 0, 10)))) . '",';
                                $um_temperatura .= '' . $um_row["UMIDITY"] . ',';
                                $um_backgroundColor .= '"rgba(255, 99, 132, 0.2)",';
                                $um_borderColor .= '"rgba(255,99,132,1)",';
                            }
                        } else {
                            echo "0 results";
                        }
                        $um_label .= ']';
                        $um_temperatura .= ']';
                        $um_backgroundColor .= ']';
                        $um_borderColor .= ']';
                        ?>


                    <script>
                        var ctx = document.getElementById("chart_temperature").getContext('2d');
                        var label_def =<?php echo $label; ?>;
                        var temperatura_def =<?php echo $temperatura; ?>;
                        var backgroundColor_def =<?php echo $backgroundColor; ?>;
                        var borderColor_def =<?php echo $borderColor; ?>;
                        var myChart = new Chart(ctx, {
                            type: '<?php echo $type_of_chart ?>',
                            data: {
                                //labels: ["11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17", "11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17", "11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17", "11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17"],
                                labels: label_def,
                                datasets: [{
                                        label: 'Mensile - Temperatura Dal <?php echo $dal_rec; ?> al <?php echo $al_rec; ?>',
                                        //data: [18.2, 18.6, 18.5, 18.9, 21, 22, 21.4, 18.2, 18.6, 18.5, 18.9, 21, 22, 21.4, 18.2, 18.6, 18.5, 18.9, 21, 22, 21.4, 18.2, 18.6, 18.5, 18.9, 21, 22, 21.4],
                                        data: temperatura_def,
                                        backgroundColor: backgroundColor_def,
                                        borderColor: borderColor_def,
                                        borderWidth: 1
                                    }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                }
                            }
                        });
                    </script>

                    <script>
                        var ctx = document.getElementById("chart_umidity").getContext('2d');
                        var um_label_def =<?php echo $um_label; ?>;
                        var um_temperatura_def =<?php echo $um_temperatura; ?>;
                        var um_backgroundColor_def =<?php echo $um_backgroundColor; ?>;
                        var um_borderColor_def =<?php echo $um_borderColor; ?>;
                        var chart_umidity = new Chart(ctx, {
                            type: '<?php echo $type_of_chart ?>',
                            data: {
                                //labels: ["11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17", "11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17", "11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17", "11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17"],
                                labels: um_label_def,
                                datasets: [{
                                        label: 'Mensile - Umidità Dal <?php echo $dal_rec; ?> al <?php echo $al_rec; ?>',
                                        //data: [18.2, 18.6, 18.5, 18.9, 21, 22, 21.4, 18.2, 18.6, 18.5, 18.9, 21, 22, 21.4, 18.2, 18.6, 18.5, 18.9, 21, 22, 21.4, 18.2, 18.6, 18.5, 18.9, 21, 22, 21.4],
                                        data: um_temperatura_def,
                                        backgroundColor: um_backgroundColor_def,
                                        borderColor: um_borderColor_def,
                                        borderWidth: 1
                                    }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'general_bottom.php'; ?>
   