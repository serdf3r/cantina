<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'config.php'; ?>
        <?php include 'css_js.php'; ?>
    </head>
    <body>
        <?php
        include "nav.php";      
        include "main_form.php";
        ?>

        <canvas id="myChart" width="400" height="100"></canvas>
        <?php
        $output = array();
        $retval = null;
        exec("stty -F /dev/ttyUSB0", $output, $retval);
        var_dump($output);
        var_dump($retval);
        ?>
        <?php
//        include "php_serial.class.php";
//
//        // Let's start the class
//        $serial = new phpSerial();
//
//        // First we must specify the device. This works on both Linux and Windows (if
//        // your Linux serial device is /dev/ttyS0 for COM1, etc.)
//        $serial->deviceSet("/dev/ttyUSB0");
//
//        // Set for 9600-8-N-1 (no flow control)
//        $serial->confBaudRate(9600); //Baud rate: 9600
//        $serial->confParity("none");  //Parity (this is the "N" in "8-N-1")
//        $serial->confCharacterLength(8); //Character length     (this is the "8" in "8-N-1")
//        $serial->confStopBits(1);  //Stop bits (this is the "1" in "8-N-1")
//        $serial->confFlowControl("none");
//
//        // Then we need to open it
//        $serial->deviceOpen();
//
//        // Read data
//        $read   = $serial->readPort();
//// Print out the data
//        $data   = preg_split('/\s+/', $read);
////print_r($data); // red and split the data by spaces to array
//        $array  = array_count_values($data); // count the array values
//        $values = array_keys($array, max($array)); // count the maximum repeating value
//        echo $values[0];
//// If you want to change the configuration, the device must be closed.
//        // Print out the data
//        print_r("->");
//        print_r($read);
//        print_r("<-");
//
//        // If you want to change the configuration, the device must be closed.
//        $serial->deviceClose();
        ?>
        <?php
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
       

        $sql = "SELECT * FROM GEN_AMB_TEMP_UMI ORDER BY 'TIME' ASC";
        $result = mysqli_query($conn, $sql);
        $label = '[';
        $temperatura = '[';
        $backgroundColor = '[';
        $borderColor = '[';
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $label.='"' . substr($row["TIME"], 0, 10) . '",';
                $temperatura.='' . $row["TEMPERATURE"] . ',';
                $backgroundColor .= '"rgba(255, 99, 132, 0.2)",';
                $borderColor .= '"rgba(255,99,132,1)",';
            }
        } else {
            echo "0 results";
        }
        $label.=']';
        $temperatura.=']';
        $backgroundColor .= ']';
        $borderColor .= ']';

        $um_sql = "SELECT * FROM GEN_AMB_TEMP_UMI ORDER BY 'TIME' ASC";
        $um_result = mysqli_query($conn, $um_sql);
        $um_label = '[';
        $um_temperatura = '[';
        $um_backgroundColor = '[';
        $um_borderColor = '[';
        if (mysqli_num_rows($um_result) > 0) {
            // output data of each row
            while ($um_row = mysqli_fetch_assoc($um_result)) {
                $um_label.='"' . substr($um_row["TIME"], 0, 10) . '",';
                $um_temperatura.='' . $um_row["UMIDITY"] . ',';
                $um_backgroundColor .= '"rgba(255, 99, 132, 0.2)",';
                $um_borderColor .= '"rgba(255,99,132,1)",';
            }
        } else {
            echo "0 results";
        }
        $um_label.=']';
        $um_temperatura.=']';
        $um_backgroundColor .= ']';
        $um_borderColor .= ']';
        ?>


        <script>
            var ctx = document.getElementById("myChart").getContext('2d');
            var label_def =<?php echo $label; ?>;
            var temperatura_def =<?php echo $temperatura; ?>;
            var backgroundColor_def =<?php echo $backgroundColor; ?>;
            var borderColor_def =<?php echo $borderColor; ?>;
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    //labels: ["11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17", "11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17", "11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17", "11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17"],
                    labels: label_def,
                    datasets: [{
                            label: 'Mensile - Temperatura Mese Settembre 2017',
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
        <canvas id="chart_umidity" width="400" height="100"></canvas>
        <script>
            var ctx = document.getElementById("chart_umidity").getContext('2d');
            var um_label_def =<?php echo $um_label; ?>;
            var um_temperatura_def =<?php echo $um_temperatura; ?>;
            var um_backgroundColor_def =<?php echo $um_backgroundColor; ?>;
            var um_borderColor_def =<?php echo $um_borderColor; ?>;
            var chart_umidity = new Chart(ctx, {
                type: 'bar',
                data: {
                    //labels: ["11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17", "11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17", "11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17", "11-09-17", "12-09-17", "13-09-17", "14-09-17", "15-09-17", "16-09-17", "17-09-17"],
                    labels: um_label_def,
                    datasets: [{
                            label: 'Mensile - Umidità Mese Settembre 2017',
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
    </body>
</html>