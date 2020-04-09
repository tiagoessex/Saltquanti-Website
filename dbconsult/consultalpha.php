<?php include('../header.php'); ?>
<?php include('../settings/fields.php'); ?>
<?php include('../settings/defaults.php'); ?>
<?php include('../settings/saved.php'); ?>


<link href="../external/dataTables.searchHighlight.css" rel="stylesheet">


<?php
      /* 
        which columns to show and hide
        if logged && $show_all_columns then load all columns but hide if they are not specified in $SHOW_PRODUCT_COLUMNS
        if logged && not $show_all_columns only load and show the columns specified by $SHOW_PRODUCT_COLUMNS
      */      
      $hide = array();
      if ($isLogIn && $show_all_columns === "true" ) {
            foreach  (array_keys($COLUMN2NAME) as $item) {
              if (!in_array($item, $SHOW_PRODUCT_COLUMNS)) {
                array_push($SHOW_PRODUCT_COLUMNS, $item);
                array_push($hide, $item);
              }
            }
        }  


    $link = db_start();
    $col = implode(",", $SHOW_PRODUCT_COLUMNS);
    $sql = 'SELECT ' . $col . ' from  ' . DB_TABLE_FOOD . ' where validationdate is not NULL order by id';
    $query = mysqli_query($link, $sql);
    
    if (!$query) {
        Error("Problemas com a base de dados: " . mysqli_error($link));
        die();
    }
?>


<div class="container-fluid below-nav">
    <div class="row">
        <div class="col-lg-12">
            <h3 style="display: inline-block;">Pesquisa Alfabética
               <a href="#" title="Clique para obter ajuda." data-toggle="modal" data-target="#modal-help" style="font-size: 70%;">(Ajuda <span class="glyphicon glyphicon-info-sign" style="font-size: 80%;"></span>)</a>
            </h3>
        </div>
    </div>


    <div class="row">
      <div class="message" style="margin-right: 20px;margin-left: 10px;">
        <div class="col-sm-12 text-justify table-message">
          Esta Base de Dados resulta da recolha sistematizada (nos websites e in loco) do teor de sal nos produtos alimentares disponíveis no mercado português (considerando os três principais distribuidores alimentares portugueses), contendo também os produtos disponíveis na Tabela de Composição de Alimentos Portuguesa.
        </div>
      </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div id="alpha">
                    <p></p>
                </div>
            </div>
        </div>
    </div>


    
    <div class="row">
        <div class="col-sm-12">

          <div id="loader" style=" margin: 150px 0 0 -60px;"></div>


          <div class="supertable hidden">
             <table id = "table" class="table table-bordered table-hover table2excel text-nowrap" style="width:100%;">
                        <thead>
                            <tr class="info">
                                <?php
                                    foreach ($SHOW_PRODUCT_COLUMNS as $title) {
                                      if ($title == 'id') {
                                        echo '<th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;" width="5%">' . $COLUMN2NAME[$title] . '</th>';
                                      } else  if ($title == 'salt') {
                                        echo '<th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;" width="10%">' . $COLUMN2NAME[$title] . '</th>';

                                      } else  if ($title == 'teor') {
                                        echo '<th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;" width="5%">' . $COLUMN2NAME[$title] . '</th>';
                                      } else {
                                        echo '<th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">' . $COLUMN2NAME[$title] . '</th>';
                                      }                                     
                                    }
                                  ?>
                            </tr>
                        </thead>
                        <tbody id="myTable"> 
                            <?php
                                while ($row = mysqli_fetch_array($query))
                                {
                                  $str = '<tr>'; 
                                  foreach ($SHOW_PRODUCT_COLUMNS as $title) {
                                    $value = $row[$title];
                                    if (is_null($value) || $value == '0000-00-00' || $value == '' || $value =="NULL") $value = '';
                                    if ($title=="id") {
                                      $str .= '<td class = "id text-center">' . $value . "</td>";
                                    } else if ($title=="salt") {
                                      $str .= '<td class = "text-center salt" style="background-color:<?php echo $salt_color2; ?>; text-decoration:<?php echo $salt_style_decoration;?>; font-style:<?php echo $salt_style_font;?>; font-weight:<?php echo $salt_style_weight;?>;">' . sprintf("%0.2f",$value) . "</td>";
                                    } else if ($title=="teor") {
                                      $str .= '<td class = "text-center">' . $value . "</td>";
                                    } else {
                                      $str .= '<td>' . $value . "</td>";
                                    }
                                  }
                                  $str .= '</tr>';
                                  echo $str;
                                }
                            ?>
                        </tbody>
                    </table>
          </div>
        </div>
    </div>

    <br>


    <div class="row">
      <div class="message hidden"  style="margin-right: 20px;margin-left: 10px;">
        <div class="col-sm-12 text-justify table-message same-name-message hidden">
            Cada produto contém um ID identitário e único. A mesma designação, poderá significar que são produtos com a mesma designação comercial, no entanto, pertencentes a marcas comerciais diferentes.
        </div>
      </div>
    </div>


    <!-- *************** modal - display product info *************** -->
    <!-- MODAL THAT PRESENTS PRODUCT INFO -->
    <!-- called by all consultX files -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <!--<div id="print-me">-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Informações:</h4>
                </div>
                <div class="print-me">
                    <!-- -->
                    <div class="table-responsive">
                        <table id = "infoTable" class="table table-bordered table-hover text-nowrap">
                            <tbody class="tablebody">
                                <!-- insert table here--> 
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- -->
                <div class="modal-footer">
                    <button type="button" class="btn btn" onclick="printDiv('.print-me')"><span class="glyphicon glyphicon-print"></span> Print</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Ok</button>
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
                    Operações disponíveis:
                    <ul>
                      <li><strong>Mostrar</strong> - Quantos produtos por página.</li>
                      <li><strong>Colunas a apresentar</strong> - Seleção das colunas visíveis e não visíveis. Apenas as colunas visíveis são exportadas.</li>
                      <li><strong>CSV</strong> - Exportar tabela (colunas visíveis) para uma ficheiro em formato CSV.</li>
                      <li><strong>Excel</strong> - Exportar tabela (colunas visíveis) para uma ficheiro em formato Excel.</li>
                      <li><strong>PDF</strong> Exportar tabela (colunas visíveis) para uma ficheiro em formato Pdf.</li>
                      <li><strong>Print</strong> - Imprimir tabela (colunas visiveis).</li>
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
                      <li>Clique sobre qualquer produto para visualizar informações relativas a apenas esse produto.</li>
                    </ul>
                    <br>
                    Notas:
                    <ol>
                      <li>Esta Base de Dados resulta da recolha sistematizada (nos websites e in loco) do teor de sal nos produtos alimentares disponíveis no mercado português (considerando os três principais distribuidores alimentares portugueses), contendo também os produtos disponíveis na Tabela de Composição de Alimentos Portuguesa.</li>
                      <li> Cada produto contém um ID identitário e único. A mesma designação, poderá significar que são produtos com a mesma designação comercial, no entanto, pertencentes a marcas comerciais diferentes.</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!--  *************** -->


</div>


<script src="js/scripts.js" ></script>

<script src='../external/jquery.highlight.js'></script>
<script src='../external/dataTables.searchHighlight.min.js'></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/datatables.min.js"></script>



<script>
    var cores = false;

    // to cancel ajax requests
    var xhr = null;

    // table format
    var datatable = null;

    // detailed info of selected product
    var productinfo = {};

    // table content
    var content = [];

    // config info
    var columns2name = <?php echo json_encode($COLUMN2NAME) ?>; 
    var showcolumns = <?php echo json_encode($SHOW_PRODUCT_COLUMNS) ?>; 

    var orderby = <?php echo json_encode($DEFAULT_TABLE_ORDER) ?>;
    var chosenletter = 'A';

    var hide_columns = <?php echo json_encode($hide) ?>;

       
    $(document).ready(function(){

      // create the alphabet link list
      createAlphaList();

      ShowTable();

    });


    // get product info
    $(document).on('click', '#myTable tr', function(e){
        var id = $(this).find(".id").html();
        $.ajax({
                   url:"dbconsult/getproductinfo.php",
                   method:"POST",
                   data:{id:id},
                   dataType:"text",
                   success:function(response) {
                     if (response == "error") {
                        window.location.href="error.php?error=" + response;
                      } else {
                        $('#myModal').modal('show');
                        $(".tablebody").html(response);
                     }                     
                   },
                   error: function( jqXHR, status ) {
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
                        window.location.href="error.php?error=" + msg; 
                    }
        });
    });
    
    
    // filter table: get all products with name starting with letter
    function getProductByLetter(letter) {
      chosenletter = letter;
      datatable.column(getIndex('name')).search("^" + letter, true, false, true).draw();
    }


    
    // create alphabet list
    function createAlphaList() {
      var html = '', chr = '';
      for (var i = 65; i <= 90; i++) {
        chr = String.fromCharCode(i);
        html+= '<a style="font-size: 1.25em;" href="javascript:void(0);" onClick="getProductByLetter(\''+chr+'\')"> '+ chr +' </a> ';      
      }
      $('#alpha').append(html);
    }




    // turn array of arrays into html table and apply datatable plugin
     function ShowTable() {
       datatable =  $('#table').DataTable( {
            "scrollY": <?php echo $table_size; ?>,
            "scrollX": true,
            "colReorder": true,
            "bDestroy": true,
            "pagingType": "full_numbers",
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
                "search" : "Procurar",
                buttons: {
                    pageLength: {
                        _: "Mostrar %d produtos <span class='glyphicon glyphicon-chevron-down'></span>",
                        '-1': "Mostrar todos"
                    }
                }          
            },
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 produtos', '25 produtos', '50 produtos', 'Mostrar todos' ]
              ],
            buttons: [
                'pageLength',
                {
                  extend: 'colvis',
                  text: 'Colunas a apresentar <span class="glyphicon glyphicon-chevron-down"></span>',
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

        } );

        TeorColumnColors();

        // hide columns
         if (hide_columns.length > 0) {
          var h = [];
          for (var i = 0; i < showcolumns.length; i++) {
            if (jQuery.inArray(showcolumns[i],hide_columns) != -1)
              h.push(i);
          }
          datatable.columns(h).visible(false);
        }     
       
       datatable.page.len( <?php echo $table_results_per_page; ?> ).draw();


       // table ready to be showed => hide spinner
        document.getElementById("loader").style.display = "none";
        
        // table ready => show table
        $(".supertable").removeClass("hidden");

        // just in case header and body are not aligned
        datatable.columns.adjust();

        // highlight searches
        datatable.on( 'draw', function () {
            var body = $( datatable.table().body() );
     
            body.unhighlight();
            body.highlight( datatable.search() );  
        } );

      // if brand field is not showed => show message informing
      // about why products with same name and such appear
      if (jQuery.inArray( "brand", showcolumns ) == -1) {
        $(".same-name-message").removeClass('hidden');
      }
      $(".message").removeClass('hidden');     

      // get all products started with letter 'A'
      getProductByLetter(chosenletter);

    }
    

    // find column index of which
    function getIndex(which) {
           var columns = $('#table').dataTable().dataTableSettings[0].aoColumns;
      for (var i = 0; i < columns.length; i++) {
          if (columns[i].sTitle == columns2name[which]) return i;
      }
      return 0;
    }

    // if teor button press => colorize all rows according to teor value
    function TeorColors() {
        if (!cores) {
          var salt_column = getIndex('salt');
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
      }  
      cores = !cores;    
    }    

    // colorize teor column
    function TeorColumnColors() {
          if (!<?php echo $show_teor_colors; ?>) return;
          var teor_column_index = getIndex('teor');
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