$(document).ready(function () {
    console.log("ready!");
    $(".generate").click(function () {
        var form = document.getElementById('gestione_bottiglie');
        form.action = "#";
        form.submit();
    });
    $(".insert_db").click(function () {
        var form = document.getElementById('gestione_bottiglie');
        form.action = "insert_db.php";
        form.submit();
    });
    $(".navbar-nav").on("click", function () {
        console.log("click nav");
        $("li.active").removeClass("active");
        $(this).addClass("active");
    });
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '-3d',
        maxDate: new Date('26/03/2018')
    });
    $('.aggiungi_persona').click(function () {
        console.log('aggiungi_persona');
        addFields();
    });
    $('.elimina_persona').click(function () {
        console.log('elimina_persona');
        var value_this = $(this);
        deleteField(value_this);
    });
    function addFields() {
        // Gets the number of elements with class yourClass
        var numItems = $('.container_member .row_ute').length;
        console.log(numItems);
        var numItems_add = numItems + 1;
        $(".container_member").append('<div class="row row_ute">'
                + '<label class="col-sm-2 control-label pull-right">Nome</label>'
                + '<div class="col-sm-3">'
                + '<input type="text" class="form-control" name="nome_ute_' + numItems_add + '"  placeholder="---">'
                + '</div>'
                + '<button type="button" class="col-sm-2 btn elimina_persona btn-danger">elmina</button>'
                + '</div>'
                );
        change_name();
        $('.elimina_persona').click(function () {
            console.log('elimina_persona');
            var value_this = $(this);
            deleteField(value_this);

        });
    }
    function deleteField(value_this) {
        console.log("delete Field");
        $(value_this).closest(".row_ute").remove();
        change_name();
    }
    function change_name() {
        for (var i = 0; i < $(".container_member .row_ute").length; i++)
        {
            $(".container_member .row_ute input").each(function (i) {
                $(this).attr('name', "");
                $(this).attr('name', "nome_ute_" + i);
            });
        }
        $(".totale_persone").val($(".container_member .row_ute").length);
    }
     $('#tab_vendemmie').DataTable();
     $('#tab_vini').DataTable();
     $('#tab_analisi').DataTable();
     $('#tab_laboratori').DataTable();
});