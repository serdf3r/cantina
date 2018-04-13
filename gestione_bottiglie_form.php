<div class="navbar main_menu ">
    <form action="gestione_bottiglie.php" method="post">
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