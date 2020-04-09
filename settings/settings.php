<?php include('../isAdmin.php'); ?>
<?php include('../header.php'); ?>
<?php include_once('../settings/fields.php'); ?>
<?php include('../settings/defaults.php'); ?>
<?php include('../settings/saved.php'); ?>

<link rel="stylesheet" href="css/settings.css" type="text/css" />
<link rel="stylesheet" href="external/touchspin/jquery.bootstrap-touchspin.min.css" type="text/css" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<div class="container below-nav">
    <div class="section-ourTeam">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 settings-hedding text-center">
                <h1>Configuração</h1>
            </div>
        </div>

        <br><br>

        <div class="row">
            <div class="btn-pref btn-group btn-group-justified btn-group-lg settings-tabs" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <button type="button" id="stars" class="btn btn-primary" href="#visibility" data-toggle="tab" style="border-top-left-radius: 24px!important;border-top-right-radius: 24px!important;">
                  <h4><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Visibilidade</h4>
               </button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" id="favorites" class="btn btn-default" href="#tables" data-toggle="tab" style="border-top-left-radius: 24px!important;border-top-right-radius: 24px!important;">
                  <h4><span class="glyphicon glyphicon-film" aria-hidden="true"></span> 
                  Formato das Tabelas</h4>
               </button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" id="favorites" class="btn btn-default" href="#limits" data-toggle="tab" style="border-top-left-radius: 24px!important;border-top-right-radius: 24px!important;">
                  <h4><span class="glyphicon glyphicon-resize-small" aria-hidden="true"></span> Limites (teor de sal)</h4>
               </button>
                </div>
            </div>
            <div class="well">
                <div class="tab-content">

                    <div class="tab-pane fade in active" id="visibility">
                        <div class="row">
                            <div class="col-lg-12 text-justify">
                                <fieldset>
                                    <legend >Selecione as colunas visíveis aos utilizadores normais e a sua respectiva ordem (arraste as colunas para sua posição correcta):</legend>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 text-left"> </div>
                            <div class="col-lg-4 text-justify">
                                <div class="well" style="background-color: rgb(51, 122, 183);">
                                    <ul class="list-group" id="myList">
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 text-left"> </div>
                            <div class="col-lg-3 text-center">
                                <button type="button" class="btn btn-success btn-lg btn-block" onclick="All()"><i class="glyphicon glyphicon-check"></i> Selecionar tudo</button>
                                <button type="button" class="btn btn-warning btn-lg btn-block" onclick="None()"><i class="glyphicon glyphicon-remove"></i> Descelecionar tudo</button>
                            </div>
                        </div>


                        <br>
                        <div class="form-group row">
                            <fieldset>
                                <legend>Acesso a todas as colunas <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Acesso a todas as colunas se tiver privilegios - Participante ou Administrador." style="font-size: 75%;"><span class="glyphicon glyphicon-info-sign"></span></a></legend>
                                <div class="col-xs-12">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" <?php if ($show_all_columns=="true") echo "checked";?> id="show_all_columns" >Mostrar todas as colunas
                                    </label><br>
                                </div>  

                            </fieldset>
                        </div>
                    </div>

                    <div class="tab-pane fade in" id="tables">

                        <form>
                            <div class="form-row" style="align-items: center;">

                                <div class="form-group row">
                                    <fieldset>
                                        <legend>Cores (Sal) <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Cores da coluna de sal." style="font-size: 75%;"><span class="glyphicon glyphicon-info-sign"></span></a></legend>
                                        <div class="row text-center">
                                            <div class="col-xs-3">
                                                <h4>Cor de fundo (categorias) <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Cor da coluna de sal em Procura por Categoria."><span class="glyphicon glyphicon-info-sign"></span></a></h4>
                                            </div>
                                            <div class="col-xs-3">
                                                <h4>Cor de fundo (restantes) <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Cor da coluna de sal nas restantes tabelas."><span class="glyphicon glyphicon-info-sign"></span></a></h4>
                                            </div>
                                        </div>

                                        <div class="col-xs-3">
                                            <div id="saltcolor" class="input-group colorpicker-component">
                                                <input type="text" value='<?php echo $salt_color1; ?>' class="form-control" />
                                                <span class="input-group-addon"><i></i></span>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div id="saltcolor2" class="input-group colorpicker-component">
                                                <input type="text" value='<?php echo ($salt_color2 == "inherited"?"#ffffff" : $salt_color2); ?>' class="form-control" />
                                                <span class="input-group-addon"><i></i></span>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <p><span style="font-size: 90%; color:red;">sem cor = #ffffff</span></p>
                                        </div>

                                    </fieldset>
                                </div>

                                <br>

                                <div class="form-group row">
                                    <fieldset>
                                        <legend>Estilo (Sal) <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Formatação dos numeros da coluna de sal." style="font-size: 75%;"><span class="glyphicon glyphicon-info-sign"></span></a></legend>
                                        <div class="col-xs-2">
                                            <label class="checkbox-inline">
                                              <input type="checkbox" <?php if ($salt_style_weight == "bold") echo "checked";?> id="salt_style_weight" >Bold
                                            </label><br>
                                            <label class="checkbox-inline">
                                              <input type="checkbox" <?php if ($salt_style_font != "normal") echo "checked";?> id="salt_style_font">Italic
                                            </label><br>
                                            <label class="checkbox-inline">
                                              <input type="checkbox" <?php if ($salt_style_decoration != "none") echo "checked";?> id="salt_style_decoration">Sublinhado
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>

                                <br>

                                <div class="form-group row">
                                    <fieldset>
                                        <legend>Altura das tabelas em pixels <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Altura da tabela. Quanto maior, mais linhas poderão ser visualizadas sem necessidade de uma barra de deslizamento." style="font-size: 75%;"><span class="glyphicon glyphicon-info-sign"></span></a></legend>

                                        <div class="col-xs-2">
                                            <input id="table-height" type="text" value='<?php  echo $table_size; ?>' name="table-height" class="text-center">
                                        </div>

                                    </fieldset>
                                </div>

                                <br>

                                <div class="form-group row">
                                    <fieldset>
                                        <legend>Resultados por página <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Número de linhas a mostrar por página por defeito." style="font-size: 75%;"><span class="glyphicon glyphicon-info-sign"></span></a></legend>
                                        <div class="col-xs-6">
                                            Numero de produtos por página (por defeito):
                                            <select class="selectpicker" name="page-results" data-width="fit" id="table_results_per_page">
                                                <option value="10" <?php if ($table_results_per_page == "10") echo "selected";?> >10
                                                <option value="25" <?php if ($table_results_per_page == "25") echo "selected";?> >25
                                                <option value="50" <?php if ($table_results_per_page == "50") echo "selected";?> >50
                                                <option value="-1" <?php if ($table_results_per_page == "-1") echo "selected";?> >Todos
                                            </select>
                                        </div>
                                    </fieldset>
                                </div>

                            </div>
                        </form>

                    </div>

                    <div class="tab-pane fade in" id="limits">
                        <div class="form-group row">
                            <fieldset>
                                <legend>Teores minimos de Sal / 100g de alimento
                                    <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Maior or igual." style="font-size: 75%;"><span class="glyphicon glyphicon-info-sign"></span></a></legend>

                                <div class="row text-center">
                                    <div class="col-xs-2">
                                        <h4>Teor baixo</h4>
                                    </div>
                                    <div class="col-xs-2">
                                        <h4>Teor médio</h4>
                                    </div>
                                    <div class="col-xs-2">
                                        <h4>Teor alto</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <input id="salt-limits-green-food" type="text" value='<?php echo $LIMIT_SAL_GREEN_FOOD; ?>' name="salt-limits-green-food" style="color:black;background-color: <?php echo $salt_limit_low_background; ?>" class="btn-success text-center">
                                    </div>
                                    <div class="col-xs-2">
                                        <input id="salt-limits-orange-food" type="text" value='<?php echo $LIMIT_SAL_ORANGE_FOOD; ?>' name="salt-limits-orange-food" style="color:black;background-color: <?php echo $salt_limit_mid_background; ?>" class="btn-warning text-center">
                                    </div>
                                    <div class="col-xs-2">
                                        <input id="salt-limits-red-food" type="text" value='<?php echo $LIMIT_SAL_RED_FOOD; ?>' name="salt-limits-red-food" style="color:black;background-color: <?php echo $salt_limit_high_background; ?>" class="btn-danger text-center">
                                    </div>
                                </div>

                            </fieldset>
                        </div>

                        <br>

                        <div class="form-group row">
                            <fieldset>
                                <legend>Teores minimos de Sal / 100ml de bebida <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Maior or igual." style="font-size: 75%;"><span class="glyphicon glyphicon-info-sign"></span></a></legend>

                                <div class="row text-center">
                                    <div class="col-xs-2">
                                        <h4>Baixo</h4>
                                    </div>
                                    <div class="col-xs-2">
                                        <h4>Médio</h4>
                                    </div>
                                    <div class="col-xs-2">
                                        <h4>Alto</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <input id="salt-limits-green-drink" type="text" value='<?php echo $LIMIT_SAL_GREEN_DRINK; ?>' name="salt-limits-green-drink" style="color:black;background-color: <?php echo $salt_limit_low_background; ?>" class="btn-success text-center">
                                    </div>
                                    <div class="col-xs-2">
                                        <input id="salt-limits-orange-drink" type="text" value='<?php echo $LIMIT_SAL_ORANGE_DRINK; ?>' name="salt-limits-orange-drink" style="color:black;background-color: <?php echo $salt_limit_mid_background; ?>" class="btn-warning text-center">
                                    </div>
                                    <div class="col-xs-2">
                                        <input id="salt-limits-red-drink" type="text" value='<?php echo $LIMIT_SAL_RED_DRINK; ?>' name="salt-limits-red-drink" style="color:black;background-color: <?php echo $salt_limit_high_background; ?>" class="btn-danger text-center">
                                    </div>
                                </div>

                            </fieldset>
                        </div>

                        <br>
                        <div class="form-group row">
                            <fieldset>
                                <legend>Cores de fundo <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Cores de fundo de cada linha da tabela, de acordo com o respectivo teor de sal." style="font-size: 75%;"><span class="glyphicon glyphicon-info-sign"></span></a></legend>

                                <div class="row text-center">
                                    <div class="col-xs-2">
                                        <h4>Cor "Baixo teor"</h4>
                                    </div>
                                    <div class="col-xs-2">
                                        <h4>Cor "Médio teor"</h4>
                                    </div>
                                    <div class="col-xs-2">
                                        <h4>Cor "Alto teor"</h4>
                                    </div>
                                </div>

                                <div class="col-xs-2">
                                    <div id="salt_limit_low_background" class="input-group colorpicker-component">
                                        <input type="text" value='<?php echo $salt_limit_low_background; ?>' class="form-control" />
                                        <span class="input-group-addon">
                                <i></i>
                              </span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div id="salt_limit_mid_background" class="input-group colorpicker-component">
                                        <input type="text" value='<?php echo $salt_limit_mid_background; ?>' class="form-control" />
                                        <span class="input-group-addon">
                                <i></i>
                              </span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div id="salt_limit_high_background" class="input-group colorpicker-component">
                                        <input type="text" value='<?php echo $salt_limit_high_background; ?>' class="form-control" />
                                        <span class="input-group-addon">
                                <i></i>
                              </span>
                                    </div>
                                </div>

                            </fieldset>
                        </div>

                        <br>
                        <div class="form-group row">
                            <fieldset>
                                <legend>Cores do texto <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Cores do texto de cada linha da tabela, de acordo com o respectivo teor de sal." style="font-size: 75%;"><span class="glyphicon glyphicon-info-sign"></span></a></legend>

                                <div class="row text-center">
                                    <div class="col-xs-2">
                                        <h4>Cor "Baixo teor"</h4>
                                    </div>
                                    <div class="col-xs-2">
                                        <h4>Cor "Médio teor"</h4>
                                    </div>
                                    <div class="col-xs-2">
                                        <h4>Cor "Alto teor"</h4>
                                    </div>
                                </div>

                                <div class="col-xs-2">
                                    <div id="salt_limit_low_color" class="input-group colorpicker-component">
                                        <input type="text" value='<?php echo $salt_limit_low_color; ?>' class="form-control" />
                                        <span class="input-group-addon">
                                <i></i>
                              </span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div id="salt_limit_mid_color" class="input-group colorpicker-component">
                                        <input type="text" value='<?php echo $salt_limit_mid_color; ?>' class="form-control" />
                                        <span class="input-group-addon">
                                <i></i>
                              </span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div id="salt_limit_high_color" class="input-group colorpicker-component">
                                        <input type="text" value='<?php echo $salt_limit_high_color; ?>' class="form-control" />
                                        <span class="input-group-addon">
                                <i></i>
                              </span>
                                    </div>
                                </div>

                            </fieldset>
                        </div>




                        <br>
                        <div class="form-group row">
                            <fieldset>
                                <legend>Coluna "Teor" <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Colorir a coluna do Teor, independentemente da coloração das linhas." style="font-size: 75%;"><span class="glyphicon glyphicon-info-sign"></span></a></legend>

                                <div class="col-xs-2">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" <?php if ($show_teor_colors=="true") echo "checked";?> id="show_teor_colors" >Colorir coluna
                                    </label><br>
                                </div>  

                            </fieldset>
                        </div>





                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-2 text-center">
                <button type="button" class="btn btn-success btn-lg btn-block" onclick="Save()"><i class="glyphicon glyphicon-save"></i> Gravar</button>               
            </div>
            <div class="col-lg-2 text-justify">
                <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#modal-2"><i class="glyphicon glyphicon-remove"></i> Restaurar</button>               
            </div>
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
                    Configurações gravadas.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-2" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="font-size: 150%">&times;</button>
                    <h3 class="modal-title" id="title">Atenção</h3>
                </div>
                <div class="modal-body text-justify">
                    Esta acção irá repor todas as configurações originais.
                    Têm a certeza que quer continuar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="Restore()"><span class="glyphicon glyphicon-warning-sign"></span> Sim</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Não</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-3" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="font-size: 150%;" onclick="location.reload();">&times;</button>
                    <h3 class="modal-title" id="title">Obrigado</h3>
                </div>
                <div class="modal-body text-center">
                    Configurações originais restauradas.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="location.reload();"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>    


</div>



<script src="external/jquery-ui/jquery-ui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/js/bootstrap-colorpicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<script src="external/touchspin/jquery.bootstrap-touchspin.min.js"></script>

<script>
    var columns2name = <?php echo json_encode($COLUMN2NAME) ?>;
    var columns = <?php echo json_encode($SHOW_PRODUCT_COLUMNS) ?>;

    var saltcolor = "<?php echo $salt_color1; ?>";
    var saltcolor2 = "<?php echo $salt_color2; ?>";
    if ("<?php echo $salt_color2; ?>"== "inherited") {
      saltcolor2 = "#ffffff";
    }

    var salt_style_weight = "bold";
    var salt_style_font = "normal";
    var salt_style_decoration = "none";

    var table_height = "<?php  echo $table_size; ?>";
    var table_results_per_page = "<?php  echo $table_results_per_page; ?>";


    var salt_limits_green_food = '<?php echo $LIMIT_SAL_GREEN_FOOD; ?>';
    var salt_limits_orange_food = '<?php echo $LIMIT_SAL_ORANGE_FOOD; ?>';
    var salt_limits_red_food = '<?php echo $LIMIT_SAL_RED_FOOD; ?>';

    var salt_limits_green_drink = '<?php echo $LIMIT_SAL_GREEN_DRINK; ?>';
    var salt_limits_orange_drink = '<?php echo $LIMIT_SAL_ORANGE_DRINK; ?>';
    var salt_limits_red_drink = '<?php echo $LIMIT_SAL_RED_DRINK; ?>';


    var salt_limit_low_background = '<?php echo $salt_limit_low_background; ?>';
    var salt_limit_mid_background = '<?php echo $salt_limit_mid_background; ?>';
    var salt_limit_high_background = '<?php echo $salt_limit_high_background; ?>';

    var salt_limit_low_color = '<?php echo $salt_limit_low_color; ?>';
    var salt_limit_mid_color = '<?php echo $salt_limit_mid_color; ?>';
    var salt_limit_high_color = '<?php echo $salt_limit_high_color; ?>';


    var show_teor_colors = "<?php echo $show_teor_colors;?>";

    var show_all_columns = "<?php echo $show_all_columns;?>";

       // populate the selection lists    
       // populate columns and order by selection
       $(function() {
           var str_columns = "";
           for (var key in columns) {         
                str_columns += '<li class="list-group-item"><input name=' + columns[key] + ' type="checkbox" checked/>&nbsp;' + columns2name[columns[key]] + '</li>';
           }
           for (var key in columns2name) {
              if (jQuery.inArray(key, columns) != -1) continue;
              str_columns += '<li class="list-group-item"><input name=' + key + ' type="checkbox"/>&nbsp;' + columns2name[key] + '</li>';
           }
           $("#myList").html(str_columns);
       
           $("#myList").sortable({
               placeholder: "ui-state-highlight"
           });
           $("#myList").disableSelection();
       });
       
        $(document).ready(function() {

          // tabs
           $(".btn-pref .btn").click(function() {
               $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
               $(this).removeClass("btn-default").addClass("btn-primary");
           });
    
        
            // colors pickers
            $('#saltcolor').colorpicker({});
            $('#saltcolor').on('propertychange input', function (e) {
               saltcolor = e.target.value;
              })
            $('#saltcolor').on('colorpickerChange colorpickerCreate', function (e) {
               saltcolor = e.value;
              })
            $( "#saltcolor" ).change(function(e) {
                saltcolor = e.target.value;
              });
            $('#saltcolor').on('changeColor', function (e) {
               saltcolor = e.color.toHex();
              })


            $('#saltcolor2').colorpicker({});
            $('#saltcolor2').on('propertychange input', function (e) {
                saltcolor2 = e.target.value;
            })
            $( "#saltcolor2" ).change(function(e) {
                saltcolor2 = e.target.value;
            });  
            $('#saltcolor2').on('changeColor', function (e) {
               saltcolor2 = e.color.toHex();
            })  


            // table height
            $("input[name='table-height']").TouchSpin({
                    min: 300,
                    max: 1000,
                    step: 10,
                    decimals: 0,
                    boostat: 5,
                    maxboostedstep: 10/*,
                    postfix: '%'*/
            });

            // salt limits
            $("input[name='salt-limits-green-food']").TouchSpin({
                    min: 0,
                    max: 0.3,
                    step: 0.001,
                    decimals: 3,
                    boostat: 10,
                    maxboostedstep: 0.1
            });
            $("input[name='salt-limits-orange-food']").TouchSpin({
                    min: 0.301,
                    max: 1.5,
                    step: 0.001,
                    decimals: 3,
                    boostat: 10,
                    maxboostedstep: 0.1
            });
            $("input[name='salt-limits-red-food']").TouchSpin({
                    min: 1.501,
                    max: 100,
                    step: 0.001,
                    decimals: 3,
                    boostat: 10,
                    maxboostedstep: 0.1
            });  
            $( "#salt-limits-green-food" ).change(function(e) {
                    salt_limits_green_food = e.target.value;
            });
            $( "#salt-limits-orange-food" ).change(function(e) {
                    salt_limits_orange_food = e.target.value;
            });
            $( "#salt-limits-red-food" ).change(function(e) {
                    salt_limits_red_food = e.target.value;
            });

            $("input[name='salt-limits-green-drink']").TouchSpin({
                    min: 0,
                    max: 0.3,
                    step: 0.001,
                    decimals: 3,
                    boostat: 10,
                    maxboostedstep: 0.1
            });
            $("input[name='salt-limits-orange-drink']").TouchSpin({
                    min: 0.301,
                    max: 0.75,
                    step: 0.001,
                    decimals: 3,
                    boostat: 10,
                    maxboostedstep: 0.1
            });
            $("input[name='salt-limits-red-drink']").TouchSpin({
                    min: 0.751,
                    max: 100,
                    step: 0.001,
                    decimals: 3,
                    boostat: 10,
                    maxboostedstep: 0.1
            });  
            $( "#salt-limits-green-drink" ).change(function(e) {
                    salt_limits_green_drink = e.target.value;
            });
            $( "#salt-limits-orange-drink" ).change(function(e) {
                    salt_limits_orange_drink = e.target.value;
            });
            $( "#salt-limits-red-drink" ).change(function(e) {
                    salt_limits_red_drink = e.target.value;
            });


            $('#salt_limit_low_background').colorpicker({});
            $('#salt_limit_low_background').on('propertychange input', function (e) {
                    salt_limit_low_background = e.target.value;
            })
            $("#salt_limit_low_background" ).change(function(e) {
                    salt_limit_low_background = e.target.value;
                     salt_limit_low_background = e.target.value;
            }); 
            $('#salt_limit_low_background').on('changeColor', function (e) {
               salt_limit_low_background = e.color.toHex();
            }) 

            $('#salt_limit_mid_background').colorpicker({});
            $('#salt_limit_mid_background').on('propertychange input', function (e) {
                    salt_limit_mid_background = e.target.value;
            })
            $( "#salt_limit_mid_background" ).change(function(e) {
               salt_limit_mid_background = e.target.value;
            }); 
            $('#salt_limit_mid_background').on('changeColor', function (e) {
               salt_limit_mid_background = e.color.toHex();
            }) 

            $('#salt_limit_high_background').colorpicker({});
            $('#salt_limit_high_background').on('propertychange input', function (e) {
                salt_limit_high_background = e.target.value;
            })
            $( "#salt_limit_high_background" ).change(function(e) {
                salt_limit_high_background = e.target.value;
            }); 
            $('#salt_limit_high_background').on('changeColor', function (e) {
               salt_limit_high_background = e.color.toHex();
            }) 



            $('#salt_limit_low_color').colorpicker({});
            $('#salt_limit_low_color').on('propertychange input', function (e) {
                salt_limit_low_color = e.target.value;
            })
            $( "#salt_limit_low_color" ).change(function(e) {
                salt_limit_low_color = e.target.value;
            }); 
            $('#salt_limit_low_color').on('changeColor', function (e) {
               salt_limit_low_color = e.color.toHex();
            }) 

            $('#salt_limit_mid_color').colorpicker({});
            $('#salt_limit_mid_color').on('propertychange input', function (e) {
                salt_limit_mid_color = e.target.value;
            })
            $( "#salt_limit_mid_color" ).change(function(e) {
                salt_limit_mid_color = e.target.value;
            }); 
            $('#salt_limit_mid_color').on('changeColor', function (e) {
               salt_limit_mid_color = e.color.toHex();
            }) 

            $('#salt_limit_high_color').colorpicker({});
            $('#salt_limit_high_color').on('propertychange input', function (e) {
                salt_limit_high_color = e.target.value;
            })
            $( "#salt_limit_high_color" ).change(function(e) {
                salt_limit_high_color = e.target.value;
            }); 
            $('#salt_limit_high_color').on('changeColor', function (e) {
               salt_limit_high_color = e.color.toHex();
            }) 


    });
       
       
       // get the selected fields in order
    function getHeader() {
           var selected = [];
           $('#myList li input').each(function() {
               if ($(this).is(":checked")) {
                   selected.push($(this).attr('name'));
               }
           });
           return selected;
    };
       
    function All() {
           $('#myList li input').each(function() {
               $(this).prop('checked', true);
           });
    }
       
    function None() {
           $('#myList li input').each(function() {
               if (!$(this).is(":disabled")) {
                   $(this).prop('checked', false);
               }
           });
    }
       
    function Save() {
          if (saltcolor2 =="#ffffff") {
              saltcolor2 ="inherited";
          }
          if(document.getElementById('salt_style_weight').checked) {
              salt_style_weight = "bold";
          } else {
            salt_style_weight = "normal";
          }
          if(document.getElementById('salt_style_font').checked) {
              salt_style_font = "italic";
          } else {
            salt_style_font = "normal";
          }
          if(document.getElementById('salt_style_decoration').checked) {
              salt_style_decoration = "underline";
          } else {
            salt_style_decoration = "none";
          }
          table_height = $("#table-height").val();
          table_results_per_page = $("#table_results_per_page").val();

          if(document.getElementById('show_teor_colors').checked) {
              show_teor_colors = true;
          } else {
            show_teor_colors = false;
          }

          if(document.getElementById('show_all_columns').checked) {
            show_all_columns = true;
          } else {
            show_all_columns = false;
          }

           $.ajax({
               url: "settings/saveconfig.php",
               method: "POST",
               data: {
                  data: getHeader(),
                  salt_color1: saltcolor,
                  salt_color2: saltcolor2,
                  salt_style_weight: salt_style_weight,
                  salt_style_font: salt_style_font,
                  salt_style_decoration: salt_style_decoration,
                  table_height:table_height,
                  table_results_per_page:table_results_per_page,
                  salt_limits_green_food:salt_limits_green_food,
                  salt_limits_orange_food:salt_limits_orange_food,
                  salt_limits_red_food:salt_limits_red_food,
                  salt_limits_green_drink:salt_limits_green_drink,
                  salt_limits_orange_drink:salt_limits_orange_drink,
                  salt_limits_red_drink:salt_limits_red_drink,
                  salt_limit_low_background:salt_limit_low_background,
                  salt_limit_mid_background:salt_limit_mid_background,
                  salt_limit_high_background:salt_limit_high_background,
                  salt_limit_low_color:salt_limit_low_color,
                  salt_limit_mid_color:salt_limit_mid_color,
                  salt_limit_high_color:salt_limit_high_color,
                  show_teor_colors:show_teor_colors,
                  show_all_columns:show_all_columns
               },
               cache: false,
               dataType: "text",
               success: function(response) {
                   //console.log(response);
                   if (response == 'ok') {
                       $('#modal-1').modal('show');
                   } else {
                       window.location.href = "error.php?error=Erro ao gravar as novas configuracoes.";
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


    function Restore() {
            $.ajax({
               url: "settings/deleteconfig.php",
               dataType: "text",
               success: function(response) {
                   if (response == 'ok') {
                       $('#modal-3').modal('show');                       
                   }/* else {
                       window.location.href = "error.php?error=Erro ao restaurar as configuracoes originais.";
                   }*/
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

    $("#modal-3").on('hide.bs.modal', function(){
        location.reload();
    });

   


</script>

<?php include('../footer.php'); ?>
