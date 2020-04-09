<?php include('../isAdmin.php'); ?>
<?php include('../header.php'); ?>
<?php include_once('../settings/fields.php'); ?>
<?php include('../settings/defaults.php'); ?>
<?php include('../settings/saved.php'); ?>



<link href="../external/dataTables.searchHighlight.css" rel="stylesheet">


<?php
    require_once '../settings/config.php';     
    $link = db_start();
    $sql = 'SELECT * from  ' . DB_TABLE_FOOD . " WHERE validationdate IS NULL OR validationdate = ''";
    $query = mysqli_query($link, $sql);
    
    if (!$query) {
        Error("Problemas com a base de dados: " . mysqli_error($link));
        die();
    }
?>

<div class="container-fluid below-nav">

    <!-- TITLE -->
    <div class="row">
        <div class="col-lg-12 text-left">
            <h3 style="display: inline-block;">Validação Pendente de Produtos
                 <a href="#" title="Clique para obter ajuda." data-toggle="modal" data-target="#modal-help" style="font-size: 70%;">(Ajuda <span class="glyphicon glyphicon-info-sign" style="font-size: 80%;"></span>)</a>
            </h3>
        </div>
    </div>
   
   <br>

    <!-- TABLE WITH THE NON VALIDATED PRODUCTS -->
    <div class="row">
        <div class="col-lg-12">


            <div id="loader" style=" margin: 150px 0 0 -60px;"></div>


            <div class="supertable hidden">
            <table id="table" class="table table-bordered table-hover table2excel text-nowrap" style="width:100%;">
                <thead>
                    <tr class="info">
                        <?php
                                    //$showtheseones = array_diff($COLUMN2NAME, $DATABASE_DONTSHOWWHENVALIDATING);
                                    echo '<th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;"></th>';
                                    foreach ($COLUMN2NAME as $title) {
                                      if (in_array(array_search ($title,$COLUMN2NAME), $DATABASE_DONTSHOWWHENVALIDATING)) continue;
                                      echo '<th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">'
                                      .
                                      $title
                                      .
                                      '</th>';
                                    }
                                ?>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php
                                while ($row = mysqli_fetch_array($query))
                                {
                                  $str = '<tr data-id="' . $row['id'] . '">';
                                  $str .= '<td class="text-center" style="vertical-align: middle;">
                                    <div class="d-inline-block">   
                                        <button type="button" class="btn btn-danger btn-xs btn_delete"><span class="glyphicon glyphicon-trash"></span></button>
                                        <button type="button" class="btn btn-success btn-xs btn_validate"><span class="glyphicon glyphicon-ok"></span></button>
                                          </div>
                                      </td>';

                                  foreach ($COLUMN2NAME as $title) {
                                      $field = array_search ($title,$COLUMN2NAME);
                                      if (in_array($field, $DATABASE_DONTSHOWWHENVALIDATING)) continue;

                                      if (is_null($row[$field]) || $row[$field] == '0000-00-00')
                                      {
                                      $str .= '<td style="vertical-align: middle;"></td>';
                                    } else if ($field=="salt") {
                                      $str .= '<td class="text-center salt" style="vertical-align: middle; background-color:' . $salt_color2 . ';text-decoration:'.$salt_style_decoration .'; font-style:' . $salt_style_font . '; font-weight:' . $salt_style_weight. ';">'.sprintf("%0.2f",$row[$field]).'</td>';
                                     } else if ($field=="teor") {
                                        $str .= '<td class="text-center" style="vertical-align: middle;">' . $row[$field].'</td>';
                                    } else {
                                      $str .= '<td style="vertical-align: middle;">'.$row[$field].'</td>';
                                    }
                                  }

                                $str .= '</tr> ';
                                echo $str;
                              }
                            ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>

    <!-- MAIN ACTIONS -->
    <div class="row global-actions hidden">
        <div class="col-lg-12 text-center">
            <button type="button" class="btn btn-success" id="validate-all" onclick="ValidateAll()"><span class="glyphicon glyphicon-save"></span> Validar Todos</button>
            <button type="button" class="btn btn-danger" id="delete-all" onclick="DeleteAll()"><span class="glyphicon glyphicon-remove"></span> Apagar Todos</button>
        </div>
    </div>


    <!-- *********************************** -->
    <!-- MODALS -->
    <!-- *********************************** -->
    <div class="modal fade" id="modal-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="font-size: 150%">&times;</button>
                    <h3 class="modal-title" id="title">Obrigado</h3>
                </div>
                <div class="modal-body text-center">
                    <!-- MESSAGES -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal-1-btn"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>



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
                     <p>
                        Verifique cada produto e valide-o (<span style="color:green;" class="glyphicon glyphicon-ok"></span>) ou elimine-o (<span style="color:red;" class="glyphicon glyphicon-trash"></span>). 
                        Estes estarão disponiveis para consulta apenas após a sua respectiva validação.
                    </p>
                     Operações disponíveis:
                    <ul>
                      <li><strong>Mostrar</strong> - Quantos produtos por página.</li>
                      <li><strong>Colunas a apresentar</strong> - Seleção das colunas visíveis e não visíveis. Apenas as colunas visíveis são exportadas.</li>
                      <li><strong>CSV</strong> - Exportar tabela (colunas visíveis) para uma ficheiro em formato CSV.</li>
                      <li><strong>Excel</strong> - Exportar tabela (colunas visíveis) para uma ficheiro em formato Excel.</li>
                      <li><strong>PDF</strong> - Exportar tabela (colunas visíveis) para uma ficheiro em formato Pdf.</li>
                      <li><strong>Print</strong> - Imprimir tabela (colunas visíveis).</li>
                      <li><strong>Teor</strong> - coloriza a tabela de acordo com os limites de sal:
                        <ul>
                          <li><span class="glyphicon glyphicon-align-justify" style="color: <?php echo $salt_limit_low_background; ?>;"></span> teor baixo de sal (&le;0,3g)</li>
                           <li><span class="glyphicon glyphicon-align-justify" style="color: <?php echo $salt_limit_mid_background; ?>;"></span> teor médio de sal (>0.3 e &le;1,5g)</li> 
                            <li><span class="glyphicon glyphicon-align-justify" style="color: <?php echo $salt_limit_high_background; ?>;"></span> teor alto de sal (>1.5g)</li>
                        </ul>
                      </li>
                      <li><strong>Procurar</strong> - Procurar termo em toda a tabela.</li>
                    </ul>
                    <br>
                    Outras operações:
                    <ul>
                      <li>Para alterar a ordem das colunas, basta pegar e arrastar as colunas pelos respetivos cabeçalhos.</li>
                      <li>Clicando sobre o cabeçalho de qualquer coluna, toda a tabela será ordenada pelos valores dessa coluna em sentido ascendente ou descendente.</li>
                    </ul> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- *********************************** -->

</div>

<!-- SCRIPTS -->
<script src='../external/jquery.highlight.js'></script>
<script src='../external/dataTables.searchHighlight.min.js'></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/datatables.min.js"></script>


<script>
    
    var datatable = null;

    var cores = false;

    var columns2name = <?php echo json_encode($COLUMN2NAME) ?>; 

    $(document).ready(function() {
        /*if (getNumberOfRows("#table") < 2) {
            ShowModal(0);
        }*/
        

        datatable = $('#table').DataTable({
            "scrollY": <?php echo $table_size; ?>, //350,
            "scrollX": true,
          //  "stateSave": true,
            "colReorder": true,
            "pagingType": "full_numbers",
            "order": [[ 1, "asc" ]],
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
                "className": 'noVis'
            }],
            "language": {
                "lengthMenu": "Mostrando _MENU_ produtos por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando _PAGE_ de _PAGES_",
                "infoEmpty": "Não existem produtos disponiveis",
                "infoFiltered": "(filtrado de um total de _MAX_ produtos)",
                "paginate": {
                      "previous": '<span class="glyphicon glyphicon-step-backward"></span>',
                      "next": '<span class="glyphicon glyphicon-step-forward"></span>',
                      "first": '<span class="glyphicon glyphicon-fast-backward"></span>',
                      "last": '<span class="glyphicon glyphicon-fast-forward"></span>'
                },
                "search": "Procurar",
                buttons: {
                    pageLength: {
                        _: "Mostrar %d produtos <span class='glyphicon glyphicon-chevron-down'></span>",
                        '-1': "Mostrar todos"
                    }
                }
            },
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 produtos', '25 produtos', '50 produtos', 'Mostrar todos']
            ],
            buttons: [
                'pageLength',
                {
                  extend: 'colvis',
                  text: 'Colunas a apresentar <span class="glyphicon glyphicon-chevron-down"></span>',
                  columns: ':not(.noVis)'
                },
                {
                  extend: 'csv',
                  exportOptions: {
                      columns: ':visible'
                  }
                },
                {
                  extend: 'excel',
                  exportOptions: {
                      columns: ':visible'
                  }
                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'portrait',
                    pageSize: 'A2',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                  extend: 'print',
                  exportOptions: {
                      columns: ':visible'
                  }
                },                
                {
                  text: 'Teor <span class="glyphicon glyphicon-align-justify" style="color: <?php echo $salt_limit_low_background; ?>;"></span> <span class="glyphicon glyphicon-align-justify" style="color: <?php echo $salt_limit_mid_background; ?>;"></span> <span class="glyphicon glyphicon-align-justify" style="color: <?php echo $salt_limit_high_background; ?>;"></span>',
                  action: function ( e, dt, node, config ) {
                    TeorColors();
                  }
                }
            ]
        });

        TeorColumnColors();

        datatable.page.len( <?php echo $table_results_per_page; ?> ).draw();

        document.getElementById("loader").style.display = "none";

        $(".supertable").removeClass("hidden");        
        datatable.columns.adjust();//.draw();

        $(".global-actions").removeClass("hidden");

        if (! datatable.data().count()) {
            ShowModal(0);
        }

        datatable.on( 'draw', function () {
            var body = $( datatable.table().body() );
     
            body.unhighlight();
            body.highlight( datatable.search() );  
        } );


    });



    // delete row
    $(document).on('click', '.btn_delete', function() {
        var tr = $(this).closest('tr');
         var id = tr.attr( "data-id" );
        tr.css("background-color", "#FF3700");

        $.ajax({
            url: "database/deleteproduct.php",
            method: "POST",
            data: {
                id: id
            },
            cache: false,
            dataType: "text",
            success: function(response) {
                if (response == "ok") {
                    tr.fadeOut(400, function() {
                        IsEmpty(tr);
                    });
                } else {
                    window.location.href = "error.php?error=" + response;
                }
            },
            error: function(jqXHR, status) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                window.location.href = "error.php?error=" + msg;
            }
        });

        return false;
    });

    // validate row
    $(document).on('click', '.btn_validate', function() {
        var tr = $(this).closest('tr');
         var id = tr.attr( "data-id" );
        tr.css("background-color", "lightgreen");

        $.ajax({
            url: "database/validateproduct.php",
            method: "POST",
            data: {
                id: id,
                username: "<?php echo $_SESSION['username']?>"
            },
            cache: false,
            dataType: "text",
            success: function(response) {
                if (response == "ok") {
                    tr.fadeOut(400, function() {
                        IsEmpty(tr);
                    });
                } else {
                    window.location.href = "error.php?error=" + response;
                }
            },
            error: function(jqXHR, status) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                window.location.href = "error.php?error=" + msg;
            }
        });

        return false;
    });

    function ValidateAll() {
        var tr = $("#myTable");
        datatable.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
             $('td', rowIdx).css('background-color', '#58FA58');
        } );
        $.ajax({
            url: "database/validateall.php",
            method: "POST",
            data: {
                username: "<?php echo $_SESSION['username']?>"
            },
            cache: false,
            dataType: "text",
            success: function(response) {
                if (response == "ok") {
                    tr.fadeOut(400, function() {
                        IsEmpty(tr, true);
                    });
                } else {
                    window.location.href = "error.php?error=" + response;
                }
            },
            error: function(jqXHR, status) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                window.location.href = "error.php?error=" + msg;
            }
        });
    }

    function DeleteAll() {
        var tr = $("#myTable");
        datatable.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
             $('td', rowIdx).css('background-color', '#FF3700');
        } );        

        $.ajax({
            url: "database/deleteallinvalid.php",
            method: "POST",
            cache: false,
            dataType: "text",
            success: function(response) {
                if (response == "ok") {
                    tr.fadeOut(400, function() {
                        IsEmpty(tr, true);
                    });
                } else {
                    window.location.href = "error.php?error=" + response;
                }
            },
            error: function(jqXHR, status) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                window.location.href = "error.php?error=" + msg;
            }
        });
    }

  
  
    function IsEmpty(tr, all=false) {
      if (!all) {
        datatable.row( tr ).remove().draw(false);//.draw();
      } else {
        datatable.clear().draw();
      }

      if (datatable.rows().count() == 0) {
          ShowModal(0);
      }
    }
  

    function ShowModal(whichone) {
        if (whichone == 0) {
            $('#modal-1').modal('show');
            $("#modal-1 .modal-body").html("<h4>Já não existem produtos por validar.</h4>");
        }
    }

    function return2Index() {
        window.location.href = "index.php";
    };

   function getColumnIndex(col_name) {
      var index = 0;
      $("#table thead tr th").each(function(){
          if ($(this).text() == col_name) {
          return false;
        }
        index++;
      });
      return index;
    }

    function TeorColors() {
        if (!cores) {
          //  $(".legend").removeClass('hidden');
          var salt_column = getColumnIndex(columns2name['salt']);
          datatable.column( salt_column ).nodes().to$().each(function(i){
              var qt = $(this).text();
              if ( qt < <?php echo $LIMIT_SAL_ORANGE_FOOD; ?>) {
                $(this).closest('tr').css("background-color", "<?php echo $salt_limit_low_background; ?>");
                $(this).closest('tr').css("color", "<?php echo $salt_limit_low_color; ?>");
               } else if (qt > <?php echo $LIMIT_SAL_RED_FOOD; ?>) {
                $(this).closest('tr').css("background-color", "<?php echo $salt_limit_high_background; ?>");
                $(this).closest('tr').css("color", "<?php echo $salt_limit_high_color; ?>");
               } else {
                $(this).closest('tr').css("background-color", "<?php echo $salt_limit_mid_background; ?>");
                $(this).closest('tr').css("color", "<?php echo $salt_limit_mid_color; ?>");
               }

        });
      } else {
        var t = datatable.rows().nodes().to$();
        t.css("background-color","white");
        t.css("color","black");
       // $(".legend").addClass('hidden');
      }
      cores = !cores;
    }

   function TeorColumnColors() {
          if (!<?php echo $show_teor_colors; ?>) return;
          var teor_column_index = getColumnIndex(columns2name['teor']);
          datatable.column( teor_column_index ).nodes().to$().each(function(i){
              var qt = $(this).text();
              if ( qt == "BAIXO") {
                $(this).css("background-color", "<?php echo $salt_limit_low_background; ?>");
                $(this).css("color", "<?php echo $salt_limit_low_color; ?>");
               } else if ( qt == "ALTO") {
                $(this).css("background-color", "<?php echo $salt_limit_high_background; ?>");
                $(this).css("color", "<?php echo $salt_limit_high_color; ?>");
               } else {
                $(this).css("background-color", "<?php echo $salt_limit_mid_background; ?>");
                $(this).css("color", "<?php echo $salt_limit_mid_color; ?>");
               }
             });
     }        


    
</script>



<?php include('../footer.php'); ?>