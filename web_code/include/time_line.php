<?php
//$conn = mysqli_connect($servername, $username, $password, $dbname);
//$sql = "SELECT * FROM VENDEMMIE ORDER BY ID DESC";
//$result_vendemmie = mysqli_query($conn, $sql);

$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT * FROM VENDEMMIE ORDER BY ID DESC";
$result_vendemmie = mysqli_query($conn, $sql);
?>
<div style="display:inline-block;width:100%;overflow-y:auto;">
    <ul class="timeline timeline-horizontal">
        <?php
        while ($row = mysqli_fetch_assoc($result_vendemmie)) {
            ?>
            <li class="timeline-item">
                <div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i><span class="tl_data"><?php echo $row["DATA"]; ?> </span></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h3 class="timeline-title">Vendemmia <?php echo $row["LUOGO"]; ?></h3>
                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> Costo <?php echo $row["COSTO"]; ?> euro</small></p>
                    </div>
                    <div class="timeline-body">
                        <p><?php echo $row["DETTAGLI"]; ?></p>
                    </div>
                </div>
            </li>
            <?php
        }
        ?>        
    </ul>
</div>