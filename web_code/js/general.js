$(document).ready(function () {
    console.log("ready!");
//    $(".accordion-toggle").click(function () {
//        console.log('panel');
//        $(".panel-collapse").hide();
//    })
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
                + '<label class="col-sm-1 control-label pull-right">Nome</label>'
                + '<div class="col-sm-3">'
                + '<input type="text" class="form-control" name="nome_ute_' + numItems_add + '"  placeholder="---">'
                + '</div>'
                + '<div class="col-sm-1"><button type="button" class="btn elimina_persona btn-danger">elimina</button></div>'
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
    $('#tab_flussi').DataTable();
    $('#tab_analisi').DataTable({
        "scrollX": true,
        "columnDefs": [
            {
                "targets": [0],
                "orderable": false,
                "searchable": false
            },
            {
                "targets": [2],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [3],
                "width": "20%"
            },
            {
                "targets": [12],
                "orderable": false,
                "searchable": false
            },
            {
                "targets": [13],
                "orderable": false,
                "searchable": false
            },
            {
                "targets": [14],
                "orderable": false,
                "searchable": false
            },
            {
                "targets": [15],
                "orderable": false,
                "searchable": false
            },
            {
                "targets": [16],
                "orderable": false,
                "searchable": false
            }
        ]
    });
    $('#tab_laboratori').DataTable({
        "scrollX": true});
    $('#tab_rabbocchi').DataTable({
        "scrollX": true});
    $('#tab_botti').DataTable({
        "scrollX": true});
    $('#tab_vini').DataTable({
        "scrollX": true});
    $('#inserimento_vendemmia :input').keydown(function (e) {
        console.log("Element changed inserimento_vendemmia");
        if ($("#vendemmia_data").val() == '' || $("#vendemmia_luogo").val() == '') {
            $('#inserimento_vendemmia .btn-primary').addClass('disabled');
        } else {
            $('#inserimento_vendemmia .btn-primary').removeClass('disabled');
        }

    });
    $('#inserimento_vendemmia').submit(function (event) {
        if ($("#vendemmia_data").val() == '' || $("#vendemmia_luogo").val() == '') {
            alert("Data e Luogo non possono essere vuoti");
            return false;
        } else {
            return;
        }
    });

    $('#inserimento_vino :input').keydown(function (e) {
        console.log("Element changed inserimento_vino");
        if ($("#vino_nome").val() == '') {
            $('#inserimento_vino .btn-primary').addClass('disabled');
        } else {
            $('#inserimento_vino .btn-primary').removeClass('disabled');
        }

    });
    $('#inserimento_vino').submit(function (event) {
        if ($("#vino_nome").val() == '') {
            alert("Il nome del vino non può essere vuoto");
            return false;
        } else {
            return;
        }
    });

    $('#inserimento_analisi :input').keydown(function (e) {
        console.log("Element changed inserimento_analisi");
        if ($("#analisi_data").val() == '') {
            $('#inserimento_analisi .btn-primary').addClass('disabled');
        } else {
            $('#inserimento_analisi .btn-primary').removeClass('disabled');
        }

    });
    $('#inserimento_analisi').submit(function (event) {
        if ($("#analisi_data").val() == '') {
            alert("La Data non può essere vuota");
            return false;
        } else {
            return;
        }
    });

    $('#inserimento_laboratorio :input').keydown(function (e) {
        console.log("Element changed inserimento_laboratorio");
        if ($("#laboratorio_nome").val() == '') {
            $('#inserimento_laboratorio .btn-primary').addClass('disabled');
        } else {
            $('#inserimento_laboratorio .btn-primary').removeClass('disabled');
        }

    });
    $('#inserimento_laboratorio').submit(function (event) {
        if ($("#laboratorio_nome").val() == '') {
            alert("Il nome non può essere vuoto");
            return false;
        } else {
            return;
        }
    });
    $('#inserimento_rabbocchi :input').keydown(function (e) {
        console.log("Element changed inserimento_rabbocchi");
        if ($("#rabbocchi_data").val() == '') {
            $('#inserimento_rabbocchi .btn-primary').addClass('disabled');
        } else {
            $('#inserimento_rabbocchi .btn-primary').removeClass('disabled');
        }

    });
    $('#inserimento_rabbocchi').submit(function (event) {
        if ($("#rabbocchi_data").val() == '') {
            alert("Il nome non può essere vuoto");
            return false;
        } else {
            return;
        }
    });
    $('#inserimento_botti :input').keydown(function (e) {
        console.log("Element changed inserimento_botti");
        if ($("#botti_data").val() == '') {
            $('#inserimento_botti .btn-primary').addClass('disabled');
        } else {
            $('#inserimento_botti .btn-primary').removeClass('disabled');
        }

    });
    $('#inserimento_botti').submit(function (event) {
        if ($("#bottii_data").val() == '') {
            alert("Il nome non può essere vuoto");
            return false;
        } else {
            return;
        }
    });
});
