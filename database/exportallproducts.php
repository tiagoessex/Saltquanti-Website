<?php include_once('../settings/fields.php'); ?>
<?php include('../settings/saved.php'); ?>
<?php include('../header.php'); ?>

<div class="container-fluid below-nav">

    <!-- HEADING -->
    <div class="row">
        <div class="col-xs-12">
            <h3 style="display: inline-block;">Exportar Base de Dados
                <a href="javascript:void(0);" title="Clique para obter ajuda." data-toggle="modal" data-target="#modal-help" style="font-size: 70%;">(Ajuda <span class="glyphicon glyphicon-info-sign" style="font-size: 80%;"></span>)</a>
            </h3>
        </div>
    </div>
    <!-- END HEADING -->

    <br>

    <!-- CONTENT -->
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="dual-list list-left col-lg-4">
            <div class="row text-left">
                <div class="col-lg-5">
                    <h4><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Estes não serão exportados!"><kbd style="background-color: blue;">Disponiveis:</kbd></a></h4>
                </div>
            </div>
            <div class="well text-right" style="background-color: #99CCFF;">
                <ul class="list-group connectedSortable" id="left">
                </ul>
            </div>
        </div>
        <div class="dual-list list-right col-lg-4">
            <div class="row text-left">
                <div class="col-lg-5">
                    <h4><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Estes serão exportados!"><kbd style="background-color: blue;">A exportar:</kbd></a></h4>
                </div>
            </div>
            <div class="well text-left" style="background-color: rgb(51, 122, 183);">
                <ul class="list-group connectedSortable" id="right">
                </ul>
            </div>
        </div>
    </div>
    <!-- END CONTENT -->

    <div class="form-group row">
        <div class="col-xs-4"></div>
        <div class="col-xs-2">
            <button type="button" class="btn btn-primary btn-block" onclick="Export('csv')"><span class="glyphicon glyphicon-export"></span> CSV</button>
        </div>
        <div class="col-xs-2">
            <button type="button" class="btn btn-success  btn-block" onclick="Export('excel')"><span class="glyphicon glyphicon-export"></span> Excel</button>
        </div>
    </div>


    <!-- MODAL -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="font-size: 150%">&times;</button>
                    <h3 class="modal-title" id="title">Atenção!</h3>
                </div>
                <div class="modal-body text-center" id="msg">
                    <h4>Não existem campos a exportar!</h4>
                    <p>Tem que existir pelo menos um campo.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal-btn">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL -->

    <!-- MODAL -->
    <div class="modal fade" id="modal-help" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Ajuda
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 150%">&times;</span>
                            </button>
                    </h2>
                </div>
                <div class="modal-body text-justify">
                    Processo:
                    <ol>
                        <li>
                            Selecione as colunas da base de dados a exportar, arrastando da esquerda para a direita.
                        </li>
                        <li>
                            Após a seleção, selecione o formato do ficheiro (Excel ou CSV) para o qual toda a base de dados será exportada.
                        </li>
                    </ol>
                    <br> Notas:
                    <ul>
                        <li>
                            Note que <strong>toda</strong> a base de dados será exportada. No caso de não desejar toda a base de dados, deverá utilizar as opções existentes nas diversas <i>Pesquisas</i> disponíveis.
                        </li>
                        <!--
                        <li>
                            A indicação do nível de teor de sal, é automaticamente colocada em todas as exportações.
                        </li>
                    -->
                    </ul>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL -->

</div>


<script src="external/jquery-ui/jquery-ui.min.js"></script>

<script>    
    var columns2name = <?php echo json_encode($COLUMN2NAME) ?>;
    var defaultcolumns = <?php echo json_encode($MIN_DATABASE_EXPORTALL) ?>;
    var showcolumns = <?php echo json_encode($SHOW_PRODUCT_COLUMNS) ?>; 


    var logged = <?php echo (($isLogIn)?'true':'false')?>;
    var show = <?php echo (($show_all_columns ==="true")?'true':'false')?>;
    if (logged && show ) {
            for (var item in columns2name) {
              if (jQuery.inArray(item,showcolumns) == -1) {
                showcolumns.push(item);
              }
            }
    }  


    // populate the selection lists
    var str_columns_left = "";
    var str_columns_right = "";
    for (var key in defaultcolumns) { 
        str_columns_right += "<li class='list-group-item' name='" + showcolumns[key] +"'>" + columns2name[showcolumns[key]] + "</li>";
    }
    for (var key in showcolumns) {   
        if (jQuery.inArray(defaultcolumns[key], defaultcolumns) == -1) {
            str_columns_left += "<li class='list-group-item' name='" + showcolumns[key] +"'>" + columns2name[showcolumns[key]] + "</li>";
        }
    }
    $("#left").html(str_columns_left);
    $("#right").html(str_columns_right);

   
    $(function() {
        $("#left, #right").sortable({
            connectWith: ".connectedSortable"
        }).disableSelection();

        $("#left").sortable({
            items: "li:not(.ui-state-disabled)"
        });

        $("#right").sortable({
            cancel: ".ui-state-disabled"
        });

        $("#left li, #right li").disableSelection();

        $( ".connectedSortable" ).on( "mouseup", function( event, ui ) {
            counter = 0;
            $("#right li").each(function() {
                counter += 1;
            });
            if (counter == 1) {
                 $('#myModal').modal('show');
            }
        } );

    });


    function Export(format) {
        var fields = [];
        $("#right li").each(function() {
            fields.push($( this ).attr("name"));
        });
        if (fields.length == 0) {
            $('#myModal').modal('show');
        } else {
            document.location.href = 'database/exportall.php?format=' + format + '&fields=' + fields.join(',');
        }
    }

    // modal's closing events
    $(document).on('click', '#modal-btn', function(e) {
        window.location.href = "database/exportallproducts.php";
    }); 
    $("#myModal").on('hide.bs.modal', function(){
        window.location.href = "database/exportallproducts.php";
    });
   $(document).on('click', '.close', function(e) {
        window.location.href = "database/exportallproducts.php";
    });

</script>

<?php include('../footer.php'); ?>