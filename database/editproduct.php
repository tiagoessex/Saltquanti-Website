<?php include('../isAdmin.php'); ?>
<?php include('../header.php'); ?>
<?php include('../settings/categories.php'); ?>
<?php include_once('../settings/fields.php'); ?>
<?php include('../settings/defaults.php'); ?>
<?php include('../settings/saved.php'); ?>
<?php include('../settings/validations.php'); ?>


<?php
   if ($_SERVER["REQUEST_METHOD"] == "GET") {       
     $link = db_start();
     $sql = 'SELECT * from  ' . DB_TABLE_FOOD . ' where id like "'. $_GET['id'] . '" LIMIT 1';
     $query = mysqli_query($link, $sql);   
     if (!$query) {          
         Error("Problemas com a base de dados: " . mysqli_error($link));
         die();
     }   
     $row = mysqli_fetch_array($query);
   }
?>

<div class="container below-nav">

   <!-- HEADING -->
   <div class="row">
      <div class="col-xs-12">
          <h3 style="display: inline-block;">Alterar / Actualizar Produto
               <a href="#" title="Clique para obter ajuda." data-toggle="modal" data-target="#modal-help" style="font-size: 70%;">(Ajuda <span class="glyphicon glyphicon-info-sign" style="font-size: 80%;"></span>)</a>
            </h3>
      </div>
   </div>
   <!-- END HEADING -->


   <!-- INPUT FORM -->
   <form id="reg_form">

      <!-- START HIDDEN FIELDS -->
      <input type="text" class="form-control hidden" id="whoinserted" name="whoinserted" value="<?php echo $_SESSION['username']; ?>">
      <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">
      <input type="hidden" id="whoupdated" name="whoupdated" value="<?php echo $_SESSION['username']; ?>">
      <input type="text" class="form-control hidden" id="teor" name="teor" value="">
      <!-- END HIDDEN FIELDS -->


      <div class="row">
         <div class="col-xs-6">
            <div class="form-group has-feedback">
               <label for="name">Designação</label>
               <input type="text" class="form-control is-valid" id="name" placeholder="Nome do produto" name="name" value="<?php echo $row['name']; ?>" required>
            </div>
         </div>
         <div class="col-xs-2">
            <div class="form-group has-feedback">
               <label for="salt">Sal [g/100g]</label>
               <input type="text" class="form-control" id="salt" placeholder="Quantidade de sal" name="salt" value="<?php echo $row['salt']; ?>" required>
            </div>
         </div>
         <div class="col-xs-2">
                <div class="form-group has-feedback">
                    <label for="teor_fake">Teor</label>
                    <input type="text" class="form-control" id="teor_fake" name="teor_fake" value="<?php echo $row['teor']; ?>" disabled>
                </div>
          </div>
          <div class="col-xs-2">
            <label for="salt">ID</label>
            <input type="text" class="form-control is-valid" placeholder="ID" value="<?php echo $row['id']; ?>" required disabled>
         </div>
      </div>
      <div class="row">
         <div class="col-xs-3">
            <div class="form-group">
               <label for="category">Categoria
               <a href="#" data-toggle="modal" data-target="#modal-categories"><span class="glyphicon glyphicon-copyright-mark" style="color:blue"></span></a>                    
               </label>
               <input type="text" class="form-control is-invalid" id="category" placeholder="Categoria principal" required list="categorylist" name="category" value="<?php echo $row['category']; ?>">
               <datalist id="categorylist">
               </datalist>
            </div>
         </div>
         <div class="col-xs-3">
            <div class="form-group">
               <label for="subcategory1">Sub-Categoria 1
               </label>
               <input type="text" class="form-control is-invalid" id="subcategory1" placeholder="Subcategoria 1" list="subcategory1list" name="subcategory1" value="<?php echo $row['subcategory1']; ?>">
               <datalist id="subcategory1list">
               </datalist>
            </div>
         </div>
         <div class="col-xs-3">
            <div class="form-group">
               <label for="subcategory2">Sub-Categoria 2
               </label>
               <input type="text" class="form-control is-invalid" id="subcategory2" placeholder="Subcategoria 2" list="subcategory2list" name="subcategory2" value="<?php echo $row['subcategory2']; ?>">
               <datalist id="subcategory2list">
               </datalist>
            </div>
         </div>
         <div class="col-xs-3">
            <div class="form-group">
               <label for="subcategory3">Sub-Categoria 3
               </label>
               <input type="text" class="form-control is-invalid" id="subcategory3" placeholder="Subcategoria 3" list="subcategory3list" name="subcategory3" value="<?php echo $row['subcategory3']; ?>">
               <datalist id="subcategory3list">
               </datalist>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xs-3">
            <div class="form-group">
               <label for="brand">Marca</label>
               <input type="text" class="form-control is-valid" id="brand" placeholder="Marca do produto" name="brand" value="<?php echo $row['brand']; ?>">
            </div>
         </div>
         <div class="col-xs-3">
            <div class="form-group">
               <label for="subbrand">Sub-marca</label>
               <input type="text" class="form-control is-valid" id="subbrand" placeholder="Sub-marca do produto" name="subbrand" value="<?php echo $row['subbrand']; ?>">
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xs-3">
            <div class="form-group">
               <label for="collectiondate">Data da recolha</label>
               <input type="date" class="form-control is-valid datepicker" id="collectiondate" placeholder="Data da recolha" name="collectiondate" value="<?php echo $row['collectiondate']; ?>">
            </div>
         </div>
         <div class="col-xs-3">
            <div class="form-group">
               <label for="wherecollected">Local da recolha</label>
               <input type="text" class="form-control is-valid" id="wherecollected" name="wherecollected" placeholder="Local da recolha" value="<?php echo $row['wherecollected']; ?>">
            </div>
         </div>
         <div class="col-xs-3">
            <div class="form-group">
               <label for="validationServer02">Fonte</label>
               <input type="text" class="form-control is-valid" id="source" placeholder="Fonte da recolha" name="source" value="<?php echo $row['source']; ?>">
            </div>
         </div>
      </div>
      <div class="form-group row">
         <div class="col-xs-3">
            <label for="updatedate">Data da ultima actualização</label>
            <input type="date" class="form-control is-valid datepicker" id="updatedate" placeholder="Data da validação" name="updatedate" value="<?php echo $row['updatedate']; ?>" disabled>
         </div>
         <div class="col-xs-3">
            <label for="wherecollected">Quem actualizou?</label>
            <input type="text" class="form-control is-valid" placeholder="Quem validou?" value="<?php echo $_SESSION['username']; ?>" disabled>
         </div>
         <div class="col-xs-3">
            <label for="collectiondate">Data da validação</label>
            <input type="date" class="form-control is-valid datepicker" id="validationdate" placeholder="Data da validação" name="validationdate" value="<?php echo $row['validationdate']; ?>" disabled>
         </div>
         <div class="col-xs-3">
            <label for="whovalidated">Quem validou?</label>
            <input type="text" class="form-control is-valid" id="whovalidated" name="whovalidated" placeholder="Quem validou?" value="<?php echo $row['whovalidated']; ?>" disabled>
         </div>
      </div>
      <div class="row">
         <div class="col-xs-3">
            <label for="collectiondate">Data de entrada</label>
            <input type="date" class="form-control is-valid datepicker" id="entrydate" placeholder="Data de entrada" name="entrydate" value="<?php echo $row['entrydate']; ?>" disabled>
         </div>
         <div class="col-xs-3">
            <label for="whoinserted">Quem inseriu?</label>
            <input type="text" class="form-control is-valid" id="whoinserted" name="whoinserted" placeholder="Quem inseriu?" value="<?php echo $row['whoinserted']; ?>" disabled>
         </div>
         <div class="col-xs-6">
            <div class="form-group">
               <label for="collectiondate">Notas</label>
               <textarea class="form-control" name="notes" id="notes" placeholder="Notas"><?php echo $row['comments']; ?></textarea>
            </div>
         </div>
      </div>
      <div class="form-group row">
         <div class="col-xs-12">
            <button type="submit" class="btn btn-primary" id="submit"><span class="glyphicon glyphicon-save"></span> Actualizar</button>
            <button type="button" class="btn btn-success" id="validate" onclick="Validar()" <?php if (!is_null($row[ "validationdate"])) { ?> disabled
               <?php   } ?>><span class="glyphicon glyphicon-save"></span> Validar</button>
            <button type="reset" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span> Remover alterações</button>
            <button type="button" class="btn btn-danger" id = "delete"><span class="glyphicon glyphicon-remove"></span> Apagar </button>
            <button type="button" class="btn btn-success" value="voltar" id="voltar"  onclick="Back()"><span class="glyphicon glyphicon-repeat"></span> Voltar </button>
         </div>
      </div>
   </form>
   <!-- END INPUT FORM -->

   <!-- MODAL -->
   <div class="modal fade" id="modal-1" role="dialog">
      <div class="modal-dialog modal-sm">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" style="font-size: 150%" onclick="Back()">&times;</button>
               <h3 class="modal-title" id="title">Obrigado</h3>
            </div>
            <div class="modal-body text-center">
               <h4>Produto actualizado com sucesso.</h4>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal-1-btn"><span class="glyphicon glyphicon-ok"></span> Ok</button>
            </div>
         </div>
      </div>
   </div>
   <!-- END MODAL -->

   <!-- MODAL -->
   <div class="modal fade" id="modal-2" role="dialog">
      <div class="modal-dialog modal-sm">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" style="font-size: 150%" onclick="Reload()>&times;</button>
                  <h3 class="modal-title" id="title">
                  Obrigado</h3>
            </div>
            <div class="modal-body text-center msg">
            <h4>Produto validado!</h4>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal-2-btn"><span class="glyphicon glyphicon-ok"></span> Ok</button>
            </div>
         </div>
      </div>
   </div>
   <!-- END MODAL -->

   <!-- MODAL -->
   <div class="modal fade" id="modal-3" role="dialog">
      <div class="modal-dialog modal-sm">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" style="font-size: 150%">&times;</button>
               <h3 class="modal-title" id="title" style="color:red;">Atenção</h3>
            </div>
            <div class="modal-body text-center msg">
               <h4>Têm a certeza?</h4>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Não</button>
               <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Delete()"><span class="glyphicon glyphicon-ok"></span> Sim</button>                    
            </div>
         </div>
      </div>
   </div>
   <!-- END MODAL -->

   <!-- MODAL -->
   <div class="modal fade" id="modal-categories" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="font-size: 150%">&times;</span></button>
               <h3 class="modal-title" style="color:blue;"> 
                  Categorias        
               </h3>
            </div>
            <div class="modal-body text-justify activate-scroll">
               <div class="cattree">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-success" data-dismiss="modal" onClick="Accept()"><span class="glyphicon glyphicon-download-alt"></span> Inserir</button>
               <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Fechar</button>
            </div>
         </div>
      </div>
   </div>
   <!-- END MODAL -->

   <!-- MODAL -->
  <div class="modal fade" id="modal-duplicated" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="font-size: 150%">&times;</span></button>
                    <h3 class="modal-title" style="color:blue;"> 
                        Atenção        
                    </h3>
                </div>
                <div class="modal-body activate-scroll">
                    <h4 class="text-center">
                        Já existe um produto com esse nome, categoria e marca.
                        O que deseja fazer?
                    </h4>
                    <p class="text-justify">                        
                    <i>
                        Nota: 
                        Ao <strong>Continuar</strong>, irá adicionar o produto (possível duplicação).
                    </i>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onClick="UpdateProduct()"><span class="glyphicon glyphicon-save"></span> Continuar</button>
                    <button type="button" class="btn" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Fechar</button>
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
                            <p>                                
                                Clique em <span class="glyphicon glyphicon-copyright-mark" style="color:blue"></span> para abrir uma janela com a árvore de categorias (duplo clique para expandir os ramos); após o qual selecione a categoria e subcategorias e clique <kbd style="background-color: green;color:white;">Inserir</kbd> para transferir a sua escolha para os campos.               
                            </p>
                            <p>
                                Campos em <kbd style="background-color: #F5F6CE;color:black;">amarelo</kbd> apenas indicam que os valores não pertencem a valores pre-definidos, e que em nada afectam a submissão do produto.                                
                            </p>
                            <p>
                                A quantidade de sal apenas irá considerar 2 casas decimais.
                            </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL -->

</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

<script>
   var error = false;
   
   var cat = <?php echo json_encode($CATEGORY) ?>;
   var subcat1 = <?php echo json_encode($SUBCATEGORY1) ?>;
   var subcat2 = <?php echo json_encode($SUBCATEGORY2) ?>;
   var subcat3 = <?php echo json_encode($SUBCATEGORY3) ?>;
   
   var path = [];
   
   
   $(document).ready(function() {
       document.getElementById('updatedate').valueAsDate = new Date();
   
      // populate the sugestion lists
       for (var key in cat) {
           $("#categorylist").append('<option value="' + cat[key] + '">');
       }
       for (var key in subcat1) {
           $("#subcategory1list").append('<option value="' + subcat1[key] + '">');
       }
       for (var key in subcat2) {
           $("#subcategory2list").append('<option value="' + subcat2[key] + '">');
       }
       for (var key in subcat3) {
           $("#subcategory3list").append('<option value="' + subcat3[key] + '">');
       }
   
      // load and insert category list
      $('.cattree').load('database/_cattree.html');
   
      // TODO: is this really necessary?
      AdjustCategoryModal();
   
   
      // validate form inputs
      $('#reg_form').bootstrapValidator({
           // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
           feedbackIcons: {
               valid: 'glyphicon glyphicon-ok',
               invalid: 'glyphicon glyphicon-remove',
               validating: 'glyphicon glyphicon-refresh'
           },
           submitHandler: function(validator, form, submitButton) {
               //UpdateProduct();
                checkExistence();
           },
           fields: {
               name: {
                   validators: {
                       stringLength: {
                          min: <?php echo NAME_MIN; ?>,
                          max: <?php echo NAME_MAX; ?>,
                          message: 'Entre ' + <?php echo NAME_MIN; ?> + ' e ' + <?php echo NAME_MAX; ?> + ' caracteres!'
                       },
                       notEmpty: {
                           message: 'Por favor, introduza uma designação válida!'
                       }
                   }
               },
               salt: {
                   validators: {
                       notEmpty: {
                           message: 'Este valor é necessário!'
                       },
                       numeric: {
                           message: 'A quantidade deve ser um número!',
                           separator: ','
                       }
                   }
               },
               category: {
                   validators: {
                       stringLength: {
                          min: <?php echo CATEGORY_MIN; ?>,
                          max: <?php echo CATEGORY_MAX; ?>,
                          message: 'Entre ' + <?php echo CATEGORY_MIN; ?> + ' e ' + <?php echo CATEGORY_MAX; ?> + ' caracteres!'
                       },
                       notEmpty: {
                           message: 'Por favor, introduza uma categoria válida!'
                       }
                   }
               },
               subcategory1: {
                   validators: {
                       stringLength: {
                          min: <?php echo SUBCATEGORY1_MIN; ?>,
                          max: <?php echo SUBCATEGORY1_MAX; ?>,
                          message: 'Entre ' + <?php echo SUBCATEGORY1_MIN; ?> + ' e ' + <?php echo SUBCATEGORY1_MAX; ?> + ' caracteres!'
                       },
                   }
               },
               subcategory2: {
                   validators: {
                       stringLength: {
                          min: <?php echo SUBCATEGORY2_MIN; ?>,
                          max: <?php echo SUBCATEGORY2_MAX; ?>,
                          message: 'Entre ' + <?php echo SUBCATEGORY2_MIN; ?> + ' e ' + <?php echo SUBCATEGORY2_MAX; ?> + ' caracteres!'
                       },
                   }
               },
               subcategory3: {
                   validators: {
                       stringLength: {
                          min: <?php echo SUBCATEGORY3_MIN; ?>,
                          max: <?php echo SUBCATEGORY3_MAX; ?>,
                          message: 'Entre ' + <?php echo SUBCATEGORY3_MIN; ?> + ' e ' + <?php echo SUBCATEGORY3_MAX; ?> + ' caracteres!'
                       },
                   }
               },
               source: {
                   validators: {
                       stringLength: {
                          min: <?php echo SOURCE_MIN; ?>,
                          max: <?php echo SOURCE_MAX; ?>,
                          message: 'Entre ' + <?php echo SOURCE_MIN; ?> + ' e ' + <?php echo SOURCE_MAX; ?> + ' caracteres!'
                       },
                   }
               },
               notes: {
                   validators: {
                       stringLength: {
                          min: <?php echo NOTES_MIN; ?>,
                          max: <?php echo NOTES_MAX; ?>,
                          message: 'Entre ' + <?php echo NOTES_MIN; ?> + ' e ' + <?php echo NOTES_MAX; ?> + ' caracteres!'
                       },
                   }
               },
               brand: {
                   validators: {
                       stringLength: {
                          min: <?php echo BRAND_MIN; ?>,
                          max: <?php echo BRAND_MAX; ?>,
                          message: 'Entre ' + <?php echo BRAND_MIN; ?> + ' e ' + <?php echo BRAND_MAX; ?> + ' caracteres!'
                       },
                   }
               },
               subbrand: {
                   validators: {
                       stringLength: {
                          min: <?php echo SUBBRAND_MIN; ?>,
                          max: <?php echo SUBBRAND_MAX; ?>,
                          message: 'Entre ' + <?php echo SUBBRAND_MIN; ?> + ' e ' + <?php echo SUBBRAND_MAX; ?> + ' caracteres!'
                       },
                   }
               },
               wherecollected: {
                   validators: {
                       stringLength: {
                          min: <?php echo WHERECOLLECTED_MIN; ?>,
                          max: <?php echo WHERECOLLECTED_MAX; ?>,
                          message: 'Entre ' + <?php echo WHERECOLLECTED_MIN; ?> + ' e ' + <?php echo WHERECOLLECTED_MAX; ?> + ' caracteres!'
                       },
                   }
               },
           }
       })
   
   
       validateCategory();
       validateSubCategory1();
       validateSubCategory2();
       validateSubCategory3();


      updateTeor($("#salt").val());
   
   });
   
   // TODO: necessary?
   $(window).resize(AdjustCategoryModal);
   
   function AdjustCategoryModal() {
       var altura = $(window).height() - 155; //value corresponding to the modal heading + footer
       $(".activate-scroll").css({
           "max-height": altura,
           "overflow-y": "auto"
       });
   }
   
   // modals' closing events
   $(document).on('click', '#modal-1-btn', function(e) {
       if (!error) {
           Back();
       }
   });
   $("#modal-1").on('hide.bs.modal', function(){
        if (!error) {
           Back();
       }
   });   
   $(document).on('click', '#modal-2-btn', function(e) {
       Reload();
   });
   $("#modal-2").on('hide.bs.modal', function(){
       Reload();
   });
   
   
   
   $(document).on('click', '#delete', function(e) {
       $('#modal-3').modal('show');
   });
   
   
   
   function Back() {
       window.location.href = "database/manageproducts.php";
   }
   
   function Reload() {
       window.location.reload();
   }
   

    // is there already a product with the same name, category and brand?
    function checkExistence() {
         $.ajax({
            url: "database/doesproductexist.php",
            method: "POST",
            data: {name:$("#name").val(), category:$("#category").val(), brand:$("#brand").val()},
            cache: false,
            success: function(response) {
                edit_id = Number(response);
                if (response == '-1' || edit_id == <?php echo $_GET['id']; ?>) {
                    UpdateProduct();
                } else if (!isNaN(response)) {
                    $('#modal-duplicated').modal('show');
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

   
   function UpdateProduct() {
      $("#teor").val($("#teor_fake").val());
       $.ajax({
           url: "database/updateproduct.php",
           method: "POST",
           data: $('#reg_form').serialize(),
           cache: false,
           success: function(response) {
               if (response == "ok") {
                   $('#modal-1').modal('show');
                   error = false;
               } else {
                //   console.log(response);
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
   
   function Validar() {
       var date = "<?php echo $row['validationdate']; ?>";
       if (date.length > 0) {
           $('#modal-2').modal('show');
           $('#modal-2 .msg').html("<h4>Produto já validado.</h4>");
           return;
       }
       $.ajax({
           url: "database/validateproduct.php",
           method: "POST",
           data: {
               id: "<?php echo $row['id']?>",
               username: "<?php echo $_SESSION['username']?>"
           },
           cache: false,
           dataType: "text",
           success: function(response) {
               if (response == "ok") {
                   $('#modal-2').modal('show');
                   $("#validate").prop("disabled", true);
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
   
   function Delete() {
       $.ajax({
           url: "database/deleteproduct.php",
           method: "POST",
           data: {
               id: "<?php echo $row['id']?>"
           },
           cache: false,
           dataType: "text",
           success: function(response) {
               if (response == "ok") {
                   Back();
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
   };
   
   // check if intro category is a pre-defined category
   function validateCategory() {
       var value = $("#category").val();
       if (jQuery.inArray(value, cat) > -1 || value.length == 0) {
           $("#category").css('background-color', 'white');
       } else {
           $("#category").css('background-color', '#F5F6CE');
       }
   }
   
   function validateSubCategory1() {
       var value = $("#subcategory1").val();
       if (jQuery.inArray(value, subcat1) > -1 || value.length == 0) {
           $("#subcategory1").css('background-color', 'white');
       } else {
           $("#subcategory1").css('background-color', '#F5F6CE');
       }
   }
   
   function validateSubCategory2() {
       var value = $("#subcategory2").val();
       if (jQuery.inArray(value, subcat2) > -1 || value.length == 0) {
           $("#subcategory2").css('background-color', 'white');
       } else {
           $("#subcategory2").css('background-color', '#F5F6CE');
       }
   }
   
   function validateSubCategory3() {
       var value = $("#subcategory3").val();
       if (jQuery.inArray(value, subcat3) > -1 || value.length == 0) {
           $("#subcategory3").css('background-color', 'white');
       } else {
           $("#subcategory3").css('background-color', '#F5F6CE');
       }
   }
   
   // categories' validations are done everytime the user changes something in
   // their respective input field
   $("#category").on('change keydown paste input', function() {
       validateCategory();
   });
   
   $("#subcategory1").on('change keydown paste input', function() {
       validateSubCategory1();
   });
   
   $("#subcategory2").on('change keydown paste input', function() {
       validateSubCategory2();
   });
   
   $("#subcategory3").on('change keydown paste input', function() {
       validateSubCategory3();
   });
   
   
   // called from _cattree.hmtl
   function setPath(p) {
       path = p;
   }
   
   // a category's branch was selected, so now populate the 
   // categories' input fields with the respective values
   function Accept() { 
      if (path[0] != undefined) {
           $('#category').val(path[0]);
           $("#category").trigger('input');
      }
      if (path[1] != undefined) {
           $('#subcategory1').val(path[1]);
           $("#subcategory1").trigger('input');
      }
      if (path[2] != undefined) {
           $('#subcategory2').val(path[2]);
           $("#subcategory2").trigger('input');
      }
      if (path[3] != undefined) {
           $('#subcategory3').val(path[3]);
           $("#subcategory3").trigger('input');
      }
   
       validateCategory();
       validateSubCategory1();
       validateSubCategory2();
       validateSubCategory3();
   };
   

 // salt changes => update teor
    $("#salt").on('change keyup paste', function() {
       updateTeor($(this).val());
    });  

    function updateTeor(value) {       
        var teor = $("#teor_fake");
        if ( value < <?php echo $LIMIT_SAL_ORANGE_FOOD; ?> ) {
            teor.val("BAIXO");
            teor.css("background-color", "<?php echo $salt_limit_low_background; ?>");
            teor.css("color", "<?php echo $salt_limit_low_color; ?>");
        } else if ( value > <?php echo $LIMIT_SAL_RED_FOOD; ?> ) {
            teor.val("ALTO");
            teor.css("background-color", "<?php echo $salt_limit_high_background; ?>");
            teor.css("color", "<?php echo $salt_limit_high_color; ?>");
        } else {
            teor.val("MÉDIO");
            teor.css("background-color", "<?php echo $salt_limit_mid_background; ?>");
            teor.css("color", "<?php echo $salt_limit_mid_color; ?>");
        }
    } 
   
   
   
</script>


<?php include('../footer.php'); ?>

