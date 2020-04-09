<?php include('../isParticipant.php'); ?>
<?php include('../header.php'); ?>
<?php include('../settings/categories.php'); ?>
<?php include_once('../settings/fields.php'); ?>
<?php include('../settings/defaults.php'); ?>
<?php include('../settings/saved.php'); ?>
<?php include('../settings/validations.php'); ?>


<div class="container below-nav">
    <div class="row">
        <div class="col-xs-12">
             <h3 style="display: inline-block;">Novo Produto
               <a href="#" title="Clique para obter ajuda." data-toggle="modal" data-target="#modal-help" style="font-size: 70%;">(Ajuda <span class="glyphicon glyphicon-info-sign" style="font-size: 80%;"></span>)</a>
            </h3>
        </div>
    </div>


    <form id="reg_form">

        <!-- START HIDDEN FIELDS -->
        <input type="text" class="form-control hidden" id="whoinserted" name="whoinserted" value="<?php echo $_SESSION['username']; ?>">
        <input type="text" class="form-control hidden" id="teor" name="teor" value="">
        <!-- END HIDDEN FIELDS -->

        <div class="row">
            <div class="col-xs-6">
                <div class="form-group has-feedback">
                    <label for="name">Designação</label>
                    <input type="text" class="form-control is-valid" id="name" placeholder="Nome do produto" name="name" required>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group has-feedback">
                    <label for="salt">Sal [g/100g]</label>
                    <input type="text" class="form-control" id="salt" placeholder="Quantidade de sal" name="salt" required>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group has-feedback">
                    <label for="teor_fake">Teor</label>
                    <input type="text" class="form-control" id="teor_fake" name="teor_fake" value="" disabled>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-3">
                <div class="form-group">

                    <label for="category">Categoria
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-categories"><span class="glyphicon glyphicon-copyright-mark" style="color:blue"></span></a>                    
                    </label>
                    <input type="text" class="form-control is-invalid" id="category" placeholder="Categoria principal" required list="categorylist" name="category">
                    <datalist id="categorylist">
                    </datalist>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <label for="subcategory1">Sub-Categoria 1
                    </label>
                    <input type="text" class="form-control is-invalid" id="subcategory1" placeholder="Subcategoria 1" list="subcategory1list" name="subcategory1">
                    <datalist id="subcategory1list">
                    </datalist>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <label for="subcategory2">Sub-Categoria 2
                    </label>
                    <input type="text" class="form-control is-invalid" id="subcategory2" placeholder="Subcategoria 2" list="subcategory2list" name="subcategory2">
                    <datalist id="subcategory2list">
                    </datalist>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <label for="subcategory3">Sub-Categoria 3
                    </label>
                    <input type="text" class="form-control is-invalid" id="subcategory3" placeholder="Subcategoria 3" list="subcategory3list" name="subcategory3">
                    <datalist id="subcategory3list">
                    </datalist>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
                <div class="form-group">
                    <label for="brand">Marca</label>
                    <input type="text" class="form-control is-valid" id="brand" placeholder="Marca do produto" name="brand">
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <label for="subbrand">Sub-marca</label>
                    <input type="text" class="form-control is-valid" id="subbrand" placeholder="Sub-marca do produto" name="subbrand">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
                <div class="form-group">
                    <label for="collectiondate">Data da recolha</label>
                    <input type="date" class="form-control is-valid datepicker" id="collectiondate" placeholder="Data da recolha" name="collectiondate">
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <label for="wherecollected">Local da recolha</label>
                    <input type="text" class="form-control is-valid" id="wherecollected" name="wherecollected" placeholder="Local da recolha">
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <label for="validationServer02">Fonte</label>
                    <input type="text" class="form-control is-valid" id="source" placeholder="Fonte da recolha" name="source">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="collectiondate">Notas</label>
                    <textarea class="form-control" name="notes" id="notes" placeholder="Notas "></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
                <div class="form-group">
                    <!--
                    <input type="submit" class="btn btn-primary" id="submit" value="Submeter">
                    <input type="reset" class="btn btn-default" value="Apagar">
                    -->
                    <button type="submit" class="btn btn-primary" id="submit"><span class="glyphicon glyphicon-save"></span> Submeter</button>
                    <button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Apagar</button>
                    
                </div>
            </div>
        </div>

    </form>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="font-size: 150%" onclick="Back()">&times;</button>
                    <h3 class="modal-title" id="title">Obrigado</h3>
                </div>
                <div class="modal-body text-center" id="msg">
                    <h4>Producto criado com sucesso</h4>
                    <p class="text-justify">Este producto será visivel assim que for validado por um administrador</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal-btn" onclick="Back()"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

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
                        Notas: 
                        Ao <strong>Continuar</strong>, irá adicionar o produto (possível duplicação).
                        Ao <strong>Editar Existente</strong>, poderá alterar os dados do produto já existente na base de dados.
                        Em ambos casos, o produto apenas estará disponivel para consulta, após a sua validação por um administrator.
                    </i>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onClick="saveNewProduct()"><span class="glyphicon glyphicon-save"></span> Continuar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="Edit()"><span class="glyphicon glyphicon-pencil"></span> Editar Existente</button>
                    <button type="button" class="btn" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Fechar</button>
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

</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>

<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

<script>
    var cat = <?php echo json_encode($CATEGORY) ?>;
    var subcat1 = <?php echo json_encode($SUBCATEGORY1) ?>;
    var subcat2 = <?php echo json_encode($SUBCATEGORY2) ?>;
    var subcat3 = <?php echo json_encode($SUBCATEGORY3) ?>;

    var path = [];
    var edit_id = -1;

    $(document).ready(function() {

        document.getElementById('collectiondate').valueAsDate = new Date();

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


        $('.cattree').load('database/_cattree.html');

        // TODO: NECESSARY?
        AdjustCategoryModal();


        $('#reg_form').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            submitHandler: function(validator, form, submitButton) {
               // saveNewProduct();
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

    });

    // TODO: NECESSARY?
    $(window).resize(AdjustCategoryModal);
    // TODO: NECESSARY?
    function AdjustCategoryModal() {
        var altura = $(window).height() - 155; //value corresponding to the modal heading + footer
        $(".activate-scroll").css({
            "max-height": altura,
            "overflow-y": "auto"
        });
    }

    // is there already a product with the same name, category and brand?
    function checkExistence() {
         $.ajax({
            url: "database/doesproductexist.php",
            method: "POST",
            data: {name:$("#name").val(), category:$("#category").val(), brand:$("#brand").val()},
            cache: false,
            success: function(response) {
                //console.log(response);
                edit_id = Number(response);
                if (response == '-1') {
                    saveNewProduct();
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

    function saveNewProduct() {
        $("#teor").val($("#teor_fake").val());
        $.ajax({
            url: "database/savenewproduct.php",
            method: "POST",
            data: $('#reg_form').serialize(),
            cache: false,
            success: function(response) {
                if (response == "ok") {
                    $('#myModal').modal('show');
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

    // categories' fields change => check value against pre-defined categories
    $("#category").on('change keyup paste', function() {
        validateCategory();
    });
    $("#subcategory1").on('change keyup paste', function() {
        validateSubCategory1();
    });
    $("#subcategory2").on('change keyup paste', function() {
        validateSubCategory2();
    });
    $("#subcategory3").on('change keyup paste', function() {
        validateSubCategory3();
    });

    // salt changes => update teor
    $("#salt").on('change keyup paste', function() {
        var qt = $(this).val();
        var teor = $("#teor_fake");
        if ( qt < <?php echo $LIMIT_SAL_ORANGE_FOOD; ?> ) {
            teor.val("BAIXO");
            teor.css("background-color", "<?php echo $salt_limit_low_background; ?>");
            teor.css("color", "<?php echo $salt_limit_low_color; ?>");
        } else if ( qt > <?php echo $LIMIT_SAL_RED_FOOD; ?> ) {
            teor.val("ALTO");
            teor.css("background-color", "<?php echo $salt_limit_high_background; ?>");
            teor.css("color", "<?php echo $salt_limit_high_color; ?>");
        } else {
            teor.val("MÉDIO");
            teor.css("background-color", "<?php echo $salt_limit_mid_background; ?>");
            teor.css("color", "<?php echo $salt_limit_mid_color; ?>");
        }
    });


    // called from _cattree.hmtl
    function setPath(p) {
        path = p;
    }


    // categories' tree -> categories fields
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

    // ok, duplicate + edit selection
    function Edit() {
        window.location.href = "database/editproductparticipant.php?id=" + edit_id;
    }
    
 
    // modal exit event
    $("#myModal").on('hide.bs.modal', function(){
        Back();
    });


    function Back() {
         window.location.href = "database/newproduct.php";
    }

</script>


<?php include('../footer.php'); ?>
