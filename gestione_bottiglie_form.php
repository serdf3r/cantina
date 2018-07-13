<div class="panel inserimento_dati">
    <form action="#" method="post" id="gestione_bottiglie">
        <div class="panel-body">
            <div class=" row">                
                <label for="nome_vino" class="col-sm-1 control-label pull-right">Nome Vino</label>
                <div class="col-sm-2">
                    <?php
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    $sql_vini = "SELECT ID, NOME, ANNATA FROM VINI";
                    $result_vini_rabbocchi = mysqli_query($conn, $sql_vini);
                    ?>
                    <select name="nome_vino" id="nome_vino">                                 
                        <?php
                        while ($row_vini = mysqli_fetch_array($result_vini_rabbocchi)) {
                            echo "<option value='" . $row_vini['ID'] . "'>" . $row_vini['NOME'] . " " . $row_vini['ANNATA'] . "</option>";
                        }
                        ?>
                    </select>                    
                </div>
                <label for="numero_totale_bottiglie" class="col-sm-2 control-label pull-right">Numero Totale Bottiglie</label>
                <div class="col-sm-1">
                    <input type="text" class="form-control numero_totale_bottiglie" id="numero_totale_bottiglie" name="numero_totale_bottiglie"  placeholder="---">
                </div>
                <label for="bottiglie_scartate" class="col-sm-2 control-label pull-right">Numero Bottiglie Scartate</label>
                <div class="col-sm-1">
                    <input type="text" class="form-control bottiglie_scartate" id="bottiglie_scartate" name="bottiglie_scartate"  placeholder="---">
                </div>

                <label for="numero_lasciare_bottiglie" class="col-sm-2 control-label pull-right">Numero Per Cantina</label>
                <div class="col-sm-1">
                    <input type="text" class="form-control numero_lasciare_bottiglie" id="numero_lasciare_bottiglie" name="nome_ute_0"  placeholder="---">
                </div>
            </div>
            <div class=" row">
                <label for="note_vino" class="col-sm-1 control-label ">Note Vino</label>
                <div class="col-sm-11"> 
                    <textarea  class="form-control" name="note_vino" ></textarea>
                </div>
            </div>
            <div class="container_member ">
                <div class="row row_ute">
                    <label class="col-sm-1 control-label pull-right">Nome</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="nome_ute_1"  placeholder="---">
                    </div>
                    <div class="col-sm-1"><button type="button" class=" btn elimina_persona btn-danger">elimina</button></div>
                </div>
            </div>
            <div class="row row_gest pull-right">
                <input type="hidden" name="totale_persone" value="" class="totale_persone">
                <button type="button" class="btn btn-success aggiungi_persona">Aggiungi Persona</button>
                <button type="button" class="btn btn-primary generate">Genera</button>
                <?php
                if (isset($_POST["anno_vino"])) {
                    ?>
                    <button type="button" class="btn btn-primary insert_db">Conferma ed inserisci nel DB</button>
                    <?php
                }
                ?>
            </div>
        </div>
    </form>


</div>