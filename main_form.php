<div class="navbar main_menu ">
    <form action="index.php" method="post">
        <div class="form-group row">
            <label for="dal" class="col-sm-1 control-label">Dal</label>
            <div class="col-sm-2">
                <input type="text" class="form-control datepicker" readonly='true' data-date-format="mm/dd/yyyy"id="dal" name="dal" placeholder="<?php
                if (!isset($_POST["dal"]) || $_POST["dal"] == '') {
                     echo date('d/m/Y', strtotime('-6 months'));
                } else {
                    echo $_POST["dal"];
                }
                ?>">
            </div>
            <label for="al" class="col-sm-1 control-label pull-right">al</label>
            <div class="col-sm-2">
                <input type="text" class="form-control datepicker" readonly='true' data-date-format="mm/dd/yyyy" id="al" name="al"  placeholder="
                <?php
                if (!isset($_POST["al"]) || $_POST["al"] == '') {
                      echo date('d/m/Y');
                } else {
                    echo $_POST["al"];
                }
                ?>">
            </div>
            <label for="type_of_chart" class="col-sm-1  pull-right">Lineare</label>
            <div class="col-sm-1"> 
                <input type="radio"  name="type_of_chart"  checked="checked" value="line"  >
            </div>
            <label for="type_of_chart" class="col-sm-1  pull-right">A Barre</label>
            <div class="col-sm-1">  
                <input type="radio"  name="type_of_chart" value="bar"  >
            </div>
            <div class="col-sm-1  pull-right">
                <button type="submit" class="btn btn-primary">Filtra</button>
            </div>
        </div>
    </form>

</div>