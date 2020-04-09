<?php include('../isAdmin.php'); ?>
<?php include('../header.php'); ?>
<?php include('../settings/defaults.php'); ?>
<?php include('../settings/saved.php'); ?>


<link href="../external/dataTables.searchHighlight.css" rel="stylesheet">



<?php
  require_once '../settings/config.php';     
  $link = db_start();
  $sql = 'SELECT * from  ' . DB_TABLE_USERS . " WHERE validationdate IS NULL OR validationdate = ''";
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
      <h3 style="display: inline-block;">Validação Pendente de Utilizadores
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
          <table id = "table" class="table table-bordered table-hover table2excel text-nowrap" style="width:100%;">
            <thead>
              <tr class="info">
                <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;" width="5%"></th>
                <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">ID</th>
                <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">USERNAME</th>
                <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">PASSWORD</th>
                <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">NOME</th>
                <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">PRIVILEGIOS</th>
                <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">EMAIL</th>
                <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">TELEFONE</th>
                <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">MORADA</th>
                <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">CIDADE</th>
                <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">CÓDIGO POSTAL</th>
                <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">PAÍS</th>
                <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">NOTAS</th>
                <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">DATA DE REGISTO</th>
              </tr>
            </thead>
            <tbody id="myTable">
              <?php
                while ($row = mysqli_fetch_array($query))
                {
                  if (!is_null($row["validationdate"])) continue;
                
                      $str2 = '<tr data-id="' . $row['id'] . '"';
                       if ($row['administrator'] == 1) {
                        $str2 .= ' class="success"> ';
                        } else {
                           $str2 .= '> ';
                        }
                        $str2 .= '<td class="text-center" style="vertical-align: middle;">
                       <div class="d-inline-block">   
                        <button type="button" class="btn btn-danger btn-xs btn_delete"><span class="glyphicon glyphicon-trash"></span></button>
                        <button type="button" class="btn btn-success btn-xs btn_validate"><span class="glyphicon glyphicon-ok"></span></button>
                        </div>
                      </td>';
                  if ($row['administrator'] == 0) {
                    $str = '<td class="text-center"> PARTICIPANTE </td>';
                  } else {
                    $str = '<td class="text-center"> <kbd> ADMINISTRADOR </kbd></td>';
                  }
                  
                  echo $str2 .'
                            <td class="text-center id" style="vertical-align: middle;">'.$row['id'].'</td>
                            <td class="username" style="vertical-align: middle;">'.$row['username'].'</td>
                            <td style="vertical-align: middle;">'.$row['password'].'</td>
                            <td style="vertical-align: middle;">'.$row['firstname'].' ' . $row['lastname'] .'</td>'.
                            $str.
                            '<td style="vertical-align: middle;">'.$row['email'].'</td>
                            <td style="vertical-align: middle;">'.$row['phone'].'</td>
                            <td style="vertical-align: middle;">'.$row['address'].'</td>
                            <td style="vertical-align: middle;">'.$row['city'].'</td>
                            <td style="vertical-align: middle;">'.$row['zip'].'</td>
                            <td style="vertical-align: middle;">'.$row['country'].'</td>
                            <td style="vertical-align: middle;">'.$row['comments'].'</td>
                            <td class="text-center" style="vertical-align: middle">'.$row['date'].'</td>' . 
                        '</tr>';
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
          <h3 class="modal-title">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="font-size: 150%">&times;</span></button>
          </h3>
        </div>
        <div class="modal-body text-center">
          
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
                      Verifique cada utilizador e valide-o (<span style="color:green;" class="glyphicon glyphicon-ok"></span>) ou elimine-o (<span style="color:red;" class="glyphicon glyphicon-trash"></span>).
                    <br>
                      Ao validar um utilizador, ser-lhe-á enviado um email (caso tenha indicado um endereço de email válido aquando do seu registo), indicando que a sua conta já se encontra activa.
                    </p>
                 Operações disponíveis:
                    <ul>
                      <li><strong>Mostrar</strong> - Quantos produtos por página.</li>
                      <li><strong>Colunas a apresentar</strong> - Seleção das colunas visíveis e não visíveis. Apenas as colunas visíveis são exportadas.</li>
                      <li><strong>CSV</strong> - Exportar tabela (colunas visíveis) para uma ficheiro em formato CSV.</li>
                      <li><strong>Excel</strong> - Exportar tabela (colunas visíveis) para uma ficheiro em formato Excel.</li>
                      <li><strong>PDF</strong> - Exportar tabela (colunas visíveis) para uma ficheiro em formato Pdf.</li>
                      <li><strong>Print</strong> - Imprimir tabela (colunas visíveis).</li>
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


  
</div>


<!-- SCRIPTS -->
<script src='../external/jquery.highlight.js'></script>
<script src='../external/dataTables.searchHighlight.min.js'></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/datatables.min.js"></script>




<script>

  
  var datatable = null;

  $(document).ready(function(){

        datatable =  $('#table').DataTable( {
            "scrollY": <?php echo $table_size; ?>, //350,
            "scrollX": true,
            //"stateSave": true,
            "colReorder": true,
            "pagingType": "full_numbers",
            "order": [[ 1, "asc" ]],
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
                "className": 'noVis'
            }],

            "language": {
                "lengthMenu": "Mostrando _MENU_ utilizadores por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando _PAGE_ de _PAGES_",
                "infoEmpty": "Não existem utilizadores disponiveis",
                "infoFiltered": "(filtrado de um total de _MAX_ utilizadores)",
                 "paginate": {
                      "previous": '<span class="glyphicon glyphicon-step-backward"></span>',
                      "next": '<span class="glyphicon glyphicon-step-forward"></span>',
                      "first": '<span class="glyphicon glyphicon-fast-backward"></span>',
                      "last": '<span class="glyphicon glyphicon-fast-forward"></span>'
                  },
                "search" : "Procurar",
                buttons: {
                    pageLength: {
                        _: "Mostrar %d utilizadores <span class='glyphicon glyphicon-chevron-down'></span>",
                        '-1': "Mostrar todos"
                    }
                }          
            },
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 utilizadores', '25 utilizadores', '50 utilizadores', 'Mostrar todos' ]
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
                }
            ]
        } );

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
   $(document).on('click', '.btn_delete', function(){  
        var tr = $(this).closest('tr');
         var id = tr.attr( "data-id" );
        if (tr.hasClass("success")) tr.removeClass("success");
        tr.css("background-color","#FF3700");
  
        $.ajax({  
                url:"users/deleteuser.php",  
                method:"POST",
                data:{id:id},
                cache: false,
                dataType:"text", 
                success:function(response) {
                    if (response == "ok") {

                        tr.fadeOut(400, function(){
                           IsEmpty(tr);
                         });
                    } else {
                        window.location.href="error.php?error=" + response;
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
  
        return false;
  });


  
   // validate row
   $(document).on('click', '.btn_validate', function(){  
        var tr = $(this).closest('tr');
         var id = tr.attr( "data-id" );
        if (tr.hasClass("success")) tr.removeClass("success");
        tr.css("background-color","lightgreen");  
        $.ajax({  
                url:"users/validateuser.php",  
                method:"POST",
                data:{id:id,username:"<?php echo $_SESSION['username']?>"},
                cache: false,
                dataType:"text", 
                success:function(response) {
                    if (response == "ok") {
                       tr.fadeOut(400, function(){
                        IsEmpty(tr);
                     });
                    } else {                       
                        window.location.href="error.php?error=" + response;
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
        return false;
  });
  

  
  
  function ValidateAll() {
    var tr = $("#myTable");       
    datatable.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
       $('td', rowIdx).css('background-color', '#58FA58');
    } );      
    $.ajax({  
                url:"users/validateallusers.php",  
                method:"POST",
                data:{username:"<?php echo $_SESSION['username']?>"},
                cache: false,
                dataType:"text", 
                success:function(response) {
                    if (response == "ok") {
                      tr.fadeOut(400, function(){
                        IsEmpty(tr, true);
                   });
                    } else {                       
                        window.location.href="error.php?error=" + response;
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
  }
  
  function DeleteAll() {
      var tr = $("#myTable");         
    datatable.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
       $('td', rowIdx).css('background-color', '#FF3700');
    } );       
    $.ajax({  
                url:"users/deleteallusers.php",  
                method:"POST",
                cache: false,
                dataType:"text", 
                success:function(response) {
                    if (response == "ok") {
                      tr.fadeOut(400, function(){
                      IsEmpty(tr, true);

                     });
                    } else {                       
                      window.location.href="error.php?error=" + response;
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
  } 
  
  

  
     function IsEmpty(tr, all=false) {
      if (!all) {
        datatable.row( tr ).remove().draw(false);//.draw();
      } else {
        datatable.clear().draw();
      }

      if (datatable.rows().count() == 0) {
          ShowModal(1);
      }
    }

    function ShowModal(n) {
      if (n == 0) {
         $('#modal-1 .modal-title').append("Atenção");
         $('#modal-1 .modal-body').html("<h4>Não existem utilizadores por validar.</h4>");
        $('#modal-1').modal('show');
      } else {
        $('#modal-1 .modal-title').append("Obrigado");
        $('#modal-1 .modal-body').html("<h4>Todos os utilizadores por validar foram tratados.</h4>");
        $('#modal-1').modal('show');
      }
    }


  
    function return2Index()
    {
        window.location.href="index.php"; 
    };
  
    
  
</script>
<?php include('../footer.php'); ?>

