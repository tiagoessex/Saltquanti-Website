<?php include('../isAdmin.php'); ?>
<?php include('../header.php'); ?>
<?php include('../settings/defaults.php'); ?>
<?php include('../settings/saved.php'); ?>


<link href="../external/dataTables.searchHighlight.css" rel="stylesheet">




<?php
    $link = db_start();
    $sql = 'SELECT * from  ' . DB_TABLE_USERS . ' where validationdate is not NULL';
    $query = mysqli_query($link, $sql);
    if (!$query) {
      Error("Problemas com a base de dados: " . mysqli_error($link));
      die();
    }
    ?>

<div class="container-fluid below-nav">
    <div class="row">
        <div class="col-xs-12">
            <h3 style="display: inline-block;">Gerir Utilizadores
              <a href="#" title="Clique para obter ajuda." data-toggle="modal" data-target="#modal-help" style="font-size: 70%;">(Ajuda <span class="glyphicon glyphicon-info-sign" style="font-size: 80%;"></span>)</a>
            </h3>
        </div>
    </div>

  <br>

    <div class="row">
        <div class="col-xs-12">

            <div id="loader" style=" margin: 150px 0 0 -60px;"></div>


            <div class="supertable hidden">
                        <!-- -->
                        <table id = "table" class="table table-bordered table-hover text-nowrap" style="width:100%;">
                            <thead>
                                <tr>
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
                                    <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">VALIDADO EM</th>
                                    <th class="text-center" style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">VALIDADO POR</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php
                                    while ($row = mysqli_fetch_array($query))
                                    {
                                      if ($row['administrator'] == 0) {
                                        $str = '<td class="text-center"> PARTICIPANTE </td>';
                                      } else {
                                        $str = '<td class="text-center"> <kbd> ADMINISTRADOR </kbd></td>';
                                      }
 
                                            $str2 = '<tr data-id="' . $row['id'] . '" data-rights="' . $row['administrator'] . '"> ';
                                      if ($row['administrator'] == 1 && !is_null($row["validationdate"])) {
                                            $str2 = '<tr data-id="' . $row['id'] . '" data-rights="' . $row['administrator'] . '" class="success"> ';
                                      }
        $str2 .= '<td class="text-center" style="vertical-align: middle;">
                       <div class="d-inline-block">   
                            <button type="button" class="btn btn-danger btn-xs btn_delete"><span class="glyphicon glyphicon-trash"></span></button>        
                            <button type="button" class="btn btn-primary btn-xs btn_edit"><span class="glyphicon glyphicon-pencil"></span></button>';
            
            $str2 .= '</div></td>';
                                      echo $str2 .'
                                                <td class="text-center id">'.$row['id'].'</td>
                                                <td class="username">'.$row['username'].'</td>
                                                <td>'.$row['password'].'</td>
                                                <td>'.$row['firstname'].' ' . $row['lastname'] .'</td>'.
                                                $str.
                                                '<td>'.$row['email'].'</td>
                                                <td>'.$row['phone'].'</td>
                                                <td>'.$row['address'].'</td>
                                                <td>'.$row['city'].'</td>
                                                <td>'.$row['zip'].'</td>
                                                <td>'.$row['country'].'</td>
                                                <td>'.$row['comments'].'</td>
                                                <td class="text-center" style="vertical-align: middle">'.$row['date'].'</td>
                                                <td class="text-center" style="vertical-align: middle">'.$row['validationdate'].'</td>
                                                <td class="text-center" style="vertical-align: middle">'.$row['whovalidated'].'</td>' .
                                            '</tr>';
                                    }?>
                            </tbody>
                        </table>
              </div>
        </div>
    </div>


    <!-- MODAL -->

  <div class="modal fade" id="modal-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">
            Atenção!          
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="Logout()">
            <span aria-hidden="true" style="font-size: 150%">&times;</span></button>          
          </h3>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <h4>Não existem utilizadores!</h4>
          </div>
          <div class="text-justify">
            <p>Contacte o administrador do website, para criar uma nova conta!</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal-1-btn" onclick="Logout()"><span class="glyphicon glyphicon-ok"></span> Ok</button>
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
                      Elimine (<span style="color:red;" class="glyphicon glyphicon-trash"></span>) ou edite (<span style="color:blue;" class="glyphicon glyphicon-pencil"></span>) utilizadores.
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

<script src='../external/jquery.highlight.js'></script>
<script src='../external/dataTables.searchHighlight.min.js'></script>

<script type="text/javascript" src="js/scripts.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/datatables.min.js"></script>


<script>

    var datatable = null;

    var id = 0;
    
    $(document).ready(function(){

        datatable =  $('#table').DataTable( {
            "scrollY": <?php echo $table_size; ?>, //350,
            "scrollX": true,
           // "stateSave": true,
            "colReorder": true,
            "pagingType": "full_numbers",
            "order": [[ 1, "asc" ]],
            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "className": 'noVis'
            } ],
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
        datatable.columns.adjust();
        
        datatable.on( 'draw', function () {
            var body = $( datatable.table().body() );
     
            body.unhighlight();
            body.highlight( datatable.search() );  
        } );



    });



    $(document).on('click', '.btn_edit', function(e){
        var tr = $(this).closest('tr');
        var id = tr.attr( "data-id" );
        window.location.href="users/edituser.php?id=" + id;
    });


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


  
  
     function IsEmpty(tr, all=false) {
      if (!all) {
        datatable.row( tr ).remove().draw(false);//.draw();
      } else {
        datatable.clear().draw();
      }

      if (datatable.rows().count() == 0) {
          $('#modal-1').modal('show');
      }
    }


    $("#modal-1").on('hide.bs.modal', function(){
        Logout();
    });

    function Logout() {
        $.ajax({  
            url:"logout.php",  
            complete: function (response2) {
                window.location = "index.php";
            },
        });
    }


    
  
    
</script>
<?php include('../footer.php'); ?>

