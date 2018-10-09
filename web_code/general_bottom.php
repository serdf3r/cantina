</div><div class="panel">
    <footer class="footer fixed-bottom" id="gatto">
    <?php
               // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            $sql = "SELECT * FROM GEN_AMB_TEMP_UMI ORDER BY id DESC LIMIT 1";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data = date('d-m-Y', strtotime(str_replace('/', '-', substr($row["TIME"], 0, 10))));
                    $ora = substr($row["TIME"], 10, 20);
                    $temperatura = $row["TEMPERATURE"];
                    $umidity = $row["UMIDITY"];
                    echo "L'ultimo valore inserito è stato in data <b>".$data."</b> alle <b>".$ora."</b> riportando i seguenti valori:</br> Temperatura: <b>".$temperatura."°C</b>  Umidità: <b>".$umidity." %</b>";
                }
            }?>
        </footer>
</div> 
</body>
</html>