<?php include('../isParticipant.php'); ?>
<?php include('../header.php'); ?>
<?php include('../settings/categories.php'); ?>
<?php include_once('../settings/fields.php'); ?>
<?php include('../settings/validations.php'); ?>


<link rel="stylesheet" href="css/navtabs.css" type="text/css" />

<div class="container-fluid below-nav">
    <div class="row">
        <div class="col-lg-12 text-left">
            <h3 style="display: inline-block;">Importar ficheiro de productos
               <a href="#" title="Clique para obter ajuda." data-toggle="modal" data-target="#modal-help" style="font-size: 70%;">(Ajuda <span class="glyphicon glyphicon-info-sign" style="font-size: 80%;"></span>)</a>
            </h3>
        </div>
    </div>

    <!-- *********************************** -->
    <!-- INPUT -->
    <!-- *********************************** -->
    <div class="row section-input">
        <div class="col-lg-1 text-left"> </div>
        <div class="col-lg-5 text-justify">
            <fieldset>
                <legend style="font-size: 120%;">1 - Selecione as colunas e sua respectiva ordem presentes no ficheiro <i>(arraste as colunas para sua posição relativa correcta):</i></legend>
                <div class="well" style="background-color: rgb(51, 122, 183);">
                    <ul class="list-group" id="myList">
                    </ul>
                </div>
            </fieldset>
        </div>
        <div class="col-lg-1 text-left"> </div>

        <div class="col-lg-4 text-justify">
            <legend style="font-size: 120%;">2 - Escolha um ficheiro

                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Exemplo de uma linha: Massa Spaghetonni,Arroz/Batata/Massa,Massa,Confeccionado quente,Esparguete,0.07" id="help-csv"><strong>CSV</strong> <span class="glyphicon glyphicon-info-sign" style="font-size: 80%;"></span></a> ou
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Excel 2007 ou superior. Também deve ter cabeçalho." id="help-excel"><strong>Excel</strong> <span class="glyphicon glyphicon-info-sign" style="font-size: 80%;"></span></a> contendo os novos produtos:</legend>

            <div class="panel with-nav-tabs panel-primary">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="pill" href="#home">CSV</a></li>
                        <li><a data-toggle="pill" href="#menu1">Excel</a></li>
                    </ul>
                </div>

                <br>
                <div class="panel-body">
                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <label for="sel1">Separador:</label>
                                    <select class="form-control" id="separator">
                                        <option value="," selected>Vírgula (,)</option>
                                        <option value=";">Ponto e vírgula (;)</option>
                                        <option value="/">Barra (/)</option>
                                        <option value="#">Cardinal (#)</option>
                                    </select>
                                </div>
                                <div class="col-xs-6">
                                    <label for="sel1">Delimitador:</label>
                                    <select class="form-control" id="delimiter">
                                        <option value="none" selected>Nenhum</option>
                                        <option value="quotes">Aspas("")</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="autocorrect" value="autocorrect" id="autocorrect" checked> Tentar corrigir linhas inválidas.
                                <a href="" data-toggle="tooltip" data-placement="top" title="Linhas incompletas ou com excesso de dados."><span class="glyphicon glyphicon-info-sign"></span></a>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="autocorrect_line" value="autocorrect_line" id="autocorrect_line" checked> Eliminar linhas sem dados.
                                <a href="" data-toggle="tooltip" data-placement="top" title="Linhas vazias."><span class="glyphicon glyphicon-info-sign"></span></a>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="duplicates_1" value="duplicates_1" id="duplicates_1" checked> Adicionar produtos mesmo se duplicados.
                                <a href="" data-toggle="tooltip" data-placement="top" title="Se selecionado, os novos produtos serão adicionados, mesmo se duplicados. Senão, os velhos serão substituidos pelos novos (substituir =/= combinar)."><span class="glyphicon glyphicon-info-sign"></span></a>
                            </div>
                            <div class="form-group">
                                <label class="btn btn-primary btn-file" style="font-weight: bold;">Ficheiro:
                                    <input type="file" id="files_csv" name="files_csv" accept=".csv,.txt" style="display: none;"/>
                                </label>
                            </div>

                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <div class="form-group">
                                <input type="checkbox" name="autocorrect2" value="autocorrect2" id="autocorrect2" checked> Tentar corrigir linhas inválidas.
                                <a href="" data-toggle="tooltip" data-placement="top" title="Linhas incompletas ou com excesso de dados."><span class="glyphicon glyphicon-info-sign"></span></a>
                            </div>                            
                            <div class="form-group">
                                <input type="checkbox" name="autocorrect_line2" value="autocorrect_line2" id="autocorrect_line2" checked> Eliminar linhas sem dados.
                                <a href="" data-toggle="tooltip" data-placement="top" title="Linhas vazias."><span class="glyphicon glyphicon-info-sign"></span></a>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="duplicates_2" value="duplicates_2" id="duplicates_2" checked> Adicionar produtos mesmo se duplicados.
                                <a href="" data-toggle="tooltip" data-placement="top" title="Se selecionado, os novos produtos serão adicionados, mesmo se duplicados. Senão, os velhos serão substituidos pelos novos (substituir =/= combinar)."><span class="glyphicon glyphicon-info-sign"></span></a>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="excel-header" value="excel-header" id="excel-header" checked> Possui cabeçalho.
                                <a href="" data-toggle="tooltip" data-placement="top" title="Selecione esta opção se o ficheiro possuir cabeçalho."><span class="glyphicon glyphicon-info-sign"></span></a>
                            </div>

                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <label for="sel1">Numero da Folha:</label>
                                    <a href="" data-toggle="tooltip" data-placement="top" title="Se selecionar 'Todas', as folhas deverão possuir a mesma estrutura e cabeçalho."><span class="glyphicon glyphicon-info-sign"></span></a>
                                    <select class="form-control" id="sheet-number">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="*" disabled>Todas</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                            </div>
                            <div class="form-group">
                                <label class="btn btn-primary btn-file" style="font-weight: bold;">Ficheiro:
                                    <input type="file" id="files_excel" name="files_excel" accept=".xls,.xlsx,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel"  style="display: none;" />
                                </label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- *********************************** -->
    <!-- END INPUT -->
    <!-- *********************************** -->

    <!-- *********************************** -->
    <!-- RESULTS VALIDATION  -->
    <!-- *********************************** -->

    <!-- TABLE WITH THE RESULTING IMPORTS -->
    <div class="section-validation hidden">
        <div class="row">
            <div class="col-lg-12">
                        <table id="table" class="table table-bordered table-hover table2excel text-nowrap" style="width:100%">
                            <!-- INSERT TABLE HERE -->
                        </table>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12 text-center">
                <button type="button" class="btn btn-warning" id="back"><span class="glyphicon glyphicon-repeat"></span> Voltar</button>
                <button type="button" class="btn btn-primary" id="save"><span class="glyphicon glyphicon-save"></span> Submeter Todos</button>
            </div>
        </div>
        <div class="row hidden submission-info">
            <div class="col-lg-12 text-center">
                <p><strong><span class="text-danger">Têm de corrigir todos os erros antes de conseguir submeter todos os produtos!</span></strong></p>
            </div>
        </div>
    </div>
    <!-- ****************** -->
    <!-- *********************************** -->
    <!-- END RESULTS  VALIDATION -->
    <!-- *********************************** -->

    <!-- *********************************** -->
    <!-- MODALS -->
    <!-- *********************************** -->
    <!-- MODAL -->
    <div class="modal fade" id="modal-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="font-size: 150%">&times;</span></button>
                    <h3 class="modal-title" style="color:red;"> 
                        Erro        
                    </h3>
                </div>
                <div class="modal-body text-center">
                    <h4>O seu browser pode não suportar todas as funcionalidades requeridas para o sucesso das operações que deseja efectuar.</h4>
                    <h5 class="text-justify">Utilize outro, actualize este ou arrisque.</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END-->
    <!-- MODAL -->
    <div class="modal fade" id="modal-2" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="Reset()"><span aria-hidden="true" style="font-size: 150%">&times;</span></button>
                    <h3 class="modal-title" style="color:red;"> 
                        Erro        
                    </h3>
                </div>
                <div class="modal-body text-center">
                    <h4>Numero de colunas incorrecto ou formato incorrecto.</h4>
                    <h5 class="text-justify">Verifique o ficheiro e compare as colunas selecionas com as existentes no ficheiro.</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="Reset()"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END-->
    <!-- MODAL -->
    <div class="modal fade" id="modal-3" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="Back()"><span aria-hidden="true" style="font-size: 150%">&times;</span></button>
                    <h3 class="modal-title" style="color:red;"> 
                        Erro        
                    </h3>
                </div>
                <div class="modal-body text-center">
                    <h4>Problemas com o ficheiro.</h4>
                    <h5 class="text-justify">Verifique o conteudo e o formato.</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Back()"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END-->
    <!-- MODAL -->
    <div class="modal fade" id="modal-4" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="Back()"><span aria-hidden="true" style="font-size: 150%">&times;</span></button>
                    <h3 class="modal-title" style="color:red;"> 
                        Atenção        
                    </h3>
                </div>
                <div class="modal-body text-center">
                    <h4>Necessita de resolver todos os problemas antes de continuar.</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Back()"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END-->
    <!-- MODAL -->
    <div class="modal fade" id="modal-5" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="Back()"><span aria-hidden="true" style="font-size: 150%">&times;</span></button>
                    <h3 class="modal-title" style="color:red;"> 
                        Atenção        
                    </h3>
                </div>
                <div class="modal-body text-center">
                    <h4>Tabela vazia. Nada para fazer.</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Back()"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END-->
    <!-- MODAL -->
    <div class="modal fade" id="modal-6" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="Back()"><span aria-hidden="true" style="font-size: 150%">&times;</span></button>
                    <h3 class="modal-title" style="color:blue;"> 
                        Parabéns        
                    </h3>
                </div>
                <div class="modal-body text-center">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Back()"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END-->
    <!-- MODAL -->
    <div class="modal fade" id="modal-7" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="font-size: 150%">&times;</span></button>
                    <h3 class="modal-title" style="color:red;"> 
                        Atenção        
                    </h3>
                </div>
                <div class="modal-body text-center">
                    <h4>Existem erros. Corriga-os (edite-os na tabela) ou volte atrás.</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END-->
    <!-- MODAL -->
    <div class="modal fade" id="modal-8" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="font-size: 150%">&times;</span></button>
                    <h3 class="modal-title" style="color:blue;"> 
                        Atenção        
                    </h3>
                </div>
                <div class="modal-body text-center">
                    <h4>Todos os erros foram corrigidos. Já pode submeter os produtos.</h4>
                    <p class="text-justify">(Estes productos serão visíveis assim que forem validados por um administrador)</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END-->
    <!-- MODAL -->
    <div class="modal fade" id="modal-help-csv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Ajuda
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 150%">&times;</span>
                        </button>
                    </h2>
                </div>
                <div class="modal-body">
                    <p>
                        Um ficheiro <b>CSV</b> é, como o próprio nome indica, um ficheiro sem formatação em que os valores estão separados por vírgulas, delimitados ou não por aspas e, em que, cada linha tem um registo diferente, ou seja, um produto, por linha.
                    </p>
                    <p>Exemplo do conteudo de um ficheiro csv:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i>Massa Spaghetonni,Arroz/Batata/Massa,Massa,Confeccionado quente,Esparguete,0.07<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Massa Tagliatelle Fresca,Arroz/Batata/Massa,Massa,Confeccionado quente,Esparguete,0.07<br>
                        </i>
                    </p>
                    <strong>Notas:</strong>
                    <ul>
                        <li>Se o ficheiro CSV tiver cabeçalho, apague-o antes de carregar o ficheiro ou antes da submissão final dos produtos</li>
                        <li>Só se aceitam datas com os seguintes formatos: YYYY-MM-DD ou DD-MM-YYY</li>
                    </ul>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END-->
    <!-- MODAL -->
    <div class="modal fade" id="modal-help-excel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Ajuda
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 150%">&times;</span>
                        </button>
                    </h2>
                </div>
                <div class="modal-body">
                    <p>
                        Ficheiro em Excel, preferencialmente criado com o Excel 2007 ou superior.                        
                    </p>
                    <p>
                        O livro pode possuir até 5 folhas, podendo ser selecionadas individualmente.
                        É igualmente possivel selecionar todas as folhas do livro.
                        No entanto, esta opção implica que todas as folhas deverão possuir a mesma estructura, isto é, deverão partilhar tanto o mesmo numero de colunas como a sua designação.
                    </p>
                    <strong>Atenção:</strong>
                    <ul>
                        <li>Se as folhas possuirem cabeçalho, selecione a opção correcta</li>
                        <li>Os campos podem conter aspas</li>
                        <li>Só se aceitam datas com os seguintes formatos: YYYY-MM-DD ou DD-MM-YYY</li>
                    </ul>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END-->
    <!-- MODAL -->
    <div class="modal fade" id="modal-10" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="Reset()"><span aria-hidden="true" style="font-size: 150%">&times;</span></button>
                    <h3 class="modal-title" style="color:red;"> 
                        Erro        
                    </h3>
                </div>
                <div class="modal-body text-center">
                    <h4>Problemas com o ficheiro.</h4>
                    <h5 class="text-center">Problemas com a folha de dados. Verifique.</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Reset()"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END-->
    <!-- MODAL -->
    <div class="modal fade" id="modal-11" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="Reset()"><span aria-hidden="true" style="font-size: 150%">&times;</span></button>
                    <h3 class="modal-title" style="color:red;"> 
                        Erro        
                    </h3>
                </div>
                <div class="modal-body text-center">
                    <h4>Problemas com o ficheiro.</h4>
                    <h5 class="text-center">Ficheiro e/ou folha vazia. Verifique.</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Reset()"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END-->
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
    <!-- MODAL END-->
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
                            Selecione as colunas e ordem presentes no ficheiro a importar.
                        </li>
                        <li>
                            Selecione o formato do ficheiro (CSV ou Excel).
                        </li>
                        <li>
                            Selecione as opções desejadas.
                        </li>
                        <li>
                            Selecione o ficheiro.
                            Ao selecionar o ficheiro, o processo de importação começará automaticamente.
                            No caso de um erro catastrofico, como por exemplo, devido a um formato de ficheiro incorrecto, ser-lhe-á pedido que selecione um novo ficheiro.
                        </li>
                        <li>
                            No caso de uma importação bem sucedida, verifique os dados importados, altere-os e submeta-os, individualmente (<span class="glyphicon glyphicon-save" style="color:green;" ></span>) ou todos de uma vez  (<kbd style="background-color: blue;color:white;">Submeter todos</kbd>).
                            No caso de a ordem das colunas for incorrecta, volte atrás e faça a correcção.
                            Pode remover produtos ( <span class="glyphicon glyphicon-trash" style="color:red;" ></span> ), se assim o desejar.
                            Note, que não conseguirá submeter um novo produto até que todos os erros (células a <kbd style="background-color: #F6CED8; color: black">vermelho</kbd>) desse produto não forem corrigidos.
                        </li>
                        <li>
                            Clique em ( <span class="glyphicon glyphicon-copyright-mark" style="color:blue"></span> ) para abrir uma janela com a árvore de categorias pré-definidas, onde poderá selecionar a categoria e subcategorias, bastando para isso selecionar e clicar em <kbd style="background-color: green;color:white;">Inserir</kbd>. Esta operação permitirá o preenchimento automático dos campos respetivos.                            
                        </li>
                    </ol>
                    <br>
                    Notas:
                    <ul>
                        <li>
                            Células a <kbd style="background-color: #F5F6CE;color:black;">amarelo</kbd>, apenas indicam que os valores introduzidos não pertencem a nenhuma <i>categoria pré-definida</i>.
                        </li>
                        <li>
                            Tal como numa folha de calculo, como Excel, é possivel copiar dados de um grupo de células para para outro rapidamente, bastando para isso utilizar arrastar o pequeno quadrado azul no canto inferior direito.
                        </li>
                        <li>
                            Só se aceitam <i>datas</i> com os seguintes formatos: <i>YYYY-MM-DD</i> ou <i>DD-MM-YYY</i>. 
                        </li>
                        <li>
                            São aceites <i>numeros decimais</i> expressos tanto com virgula como com ponto: <i>##.##</i>  ou <i>##,##</i>.
                        </li>
                        <li>
                            Os valores admissiveis para o <strong>Teor</strong> são: <i>BAIXO</i>, <i>MÉDIO</i> e <i>ALTO</i>.
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL END-->

    <!-- *********************************** -->
    <!-- END MODALS -->
    <!-- *********************************** -->

    <div id="empty"></div>
</div>

<script src="../js/scripts.js"></script>

<!-- for the dragging system
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script src="external/jquery-ui/jquery-ui.min.js"></script>
<!-- csv reader -->
<script src="external/jquery-csv/src/jquery.csv.min.js"></script>
<!-- date validation -->
<!--<script src="external/moment.min.js"></script>-->

<script src="external/shim.min.js"></script>

<script src="external/xlsx.full.min.js"></script>
<script src="external/FileSaver.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/datatables.min.js"></script>


<link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.1/css/autoFill.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.1/js/dataTables.autoFill.min.js"></script>



<script>
    // global because we need to be able to re-build it
    var datatable = null;
    // flags some format problem. ex: wrong number of columns.
    var error_temp = false;
    // true => there is at least one cell with an invalid value
    var errors_in_cell = false;
    // once the "no more error" modal appears, don't appear any more - no matter what
    var modal_ready_showed = false;

    var columns2name = <?php echo json_encode($COLUMN2NAME) ?>;
    var excludedcolumns = <?php echo json_encode($DATABASE_DONTIMPORT) ?>;
    var mustimport = <?php echo json_encode($DATABASE_MUSTIMPORT) ?>;

    // used to indicate if intro categories are default
    var cat = <?php echo json_encode($CATEGORY) ?>;
    var subcat1 = <?php echo json_encode($SUBCATEGORY1) ?>;
    var subcat2 = <?php echo json_encode($SUBCATEGORY2) ?>;
    var subcat3 = <?php echo json_encode($SUBCATEGORY3) ?>;

    var categories_columns = ["category","subcategory1","subcategory2","subcategory3"];

    // holds the reference of the table row where the categories selected at the jtree are to be inserted
    var tr_2_insert_categories = null;
    var path = [];  // categories selection tree

    var duplicate = true;   // by default allow duplicates



    // populate the selection lists    
    // populate columns and order by selection
    var str_columns = "";
    for (var key in columns2name) {
        if (jQuery.inArray(key, excludedcolumns) != -1) continue;
        if (jQuery.inArray(key, mustimport) != -1) {
            str_columns += '<li class="list-group-item"><input name=' + key + ' type="checkbox" checked disabled/>&nbsp;' + columns2name[key] + '</li>';
        } else {
            str_columns += '<li class="list-group-item"><input name=' + key + ' type="checkbox"/>&nbsp;' + columns2name[key] + '</li>';
        }
    }
    $("#myList").html(str_columns);


    $(document).ready(function() {
        // for the file selectors
        if (isAPIAvailable()) {
            $('#files_csv').bind('change', handleFileSelectCSV);
            $('#files_excel').bind('change', handleFileSelectExcel);
        } else {
            Error(0);
        }

        // load category tree
        $('.cattree').load('database/_cattree.html');

        // adjust modal according to category tree's size
        AdjustCategoryModal();

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

    // check if browser supports all operations
    function isAPIAvailable() {
        // Check for the various File API support.
        if (window.File && window.FileReader && window.FileList && window.Blob) {
            // Great success! All the File APIs are supported.
            return true;
        } else {
            // source: File API availability - http://caniuse.com/#feat=fileapi
            // source: <output> availability - http://html5doctor.com/the-output-element/
            document.writeln('The HTML5 APIs used in this form are only available in the following browsers:<br />');
            // 6.0 File API & 13.0 <output>
            document.writeln(' - Google Chrome: 13.0 or later<br />');
            // 3.6 File API & 6.0 <output>
            document.writeln(' - Mozilla Firefox: 6.0 or later<br />');
            // 10.0 File API & 10.0 <output>
            document.writeln(' - Internet Explorer: Not supported (partial support expected in 10.0)<br />');
            // ? File API & 5.1 <output>
            document.writeln(' - Safari: Not supported<br />');
            // ? File API & 9.2 <output>
            document.writeln(' - Opera: Not supported');
            return false;
        }
    }

    // apply jquery datatables plugin
    function ApplyTableStyle() {
        if (datatable != null) {
            datatable.destroy();
            database = null;
        }
        datatable =  $('#table').DataTable( {
            "scrollY": 350,
            "scrollX": true,
            searching: false,
            paging: false,
            "bDestroy": true,
            autoFill: {
                columns: ':not(:first-child)'
            },
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
                      "previous": "Antes",
                      "next": "Seguinte"
                  },
                "search" : "Procurar",
                buttons: {
                    pageLength: {
                        _: "Mostrar %d produtos <span class='glyphicon glyphicon-chevron-down'></span>",
                        '-1': "Mostrar todos"
                    }
                },
                autoFill: {
                    info: '<strong>Selecione a operação:</strong>',
                    cancel: 'Cancelar',
                    fill: 'Preencher todas as células com o mesmo valor',
                    fillHorizontal: 'Copiar os valores horizontalmente',
                    fillVertical: 'Copiar os valores verticalmente',
                    increment: 'Alterar cada célula por: <input type="number" value="1">'
                }
            },
        } );

        datatable.on( 'autoFill', function ( e, datatable, cells ) {
            ValidateTable();
        } );

    }

 


    // parse excel files
    // duplicate code with csv file handler -- not only because these 2 functions are legacy
    // but also because of some particularities with the excel, which required some magic
    // steps, which i have no idea why ... but it works
    function handleFileSelectExcel(e) {
        var invalid_rows = [];
        var empty_rows = [];
        var reader = new FileReader();
        var err = error_temp = false; // MAGIC
        var line_number = 0;
         
        duplicate = document.getElementById('duplicates_2').checked;

        reader.readAsArrayBuffer(e.target.files[0]);
        reader.onload = function(e) {
            // err = error_temp;
            var data2 = new Uint8Array(reader.result);
            var arr = new Array();
            for (var i = 0; i != data2.length; ++i) arr[i] = String.fromCharCode(data2[i]);
            var bstr = arr.join("");

            /* Call XLSX */ // THIS LINE FORCES THE USE OF THE MAGIC STEPS
            // IT CHANGES THE VALUE OF ERROR_TEMP FROM FALSE TO TRUE
            // WHY? NO IDEA
            var workbook = XLSX.read(bstr, {
                type: "binary",
                cellDates:true
            });

            var sheet_number = $("#sheet-number").val();
            sheet_number -= 1;

            if (workbook.SheetNames.length < sheet_number) {
                Error(5);
                return;
            }

            var first_sheet_name = workbook.SheetNames[sheet_number];

            /* Get worksheet */
            var worksheet = workbook.Sheets[first_sheet_name];
            //var content = XLSX.utils.sheet_to_json(worksheet,{raw:true});
            var cv = XLSX.utils.sheet_to_csv(worksheet, {
                raw: true, FS: ";"//, RS: "\n"
            });
            var temp = cv.split("\n");
            var data = [];
            for (var i = 0; i < temp.length; i++) {
                data.push(temp[i].split(";"));
            }

            // remove first line => header
            if (document.getElementById('excel-header').checked) {
                data.shift();
            }
            

            if (data.length == 0) {
                Error(6);
                return;
            }

            var html = '';
            var header = getHeader();
            if (header.length != data[0].length) {
                Error(1);
                err = error_temp; // MAGIC
                return;
            }

            $(".section-input").addClass("hidden");
            $(".section-validation").removeClass("hidden");

            var html = '<thead>';
            html += '<tr class="info">';
            //**************************
            html += '<th width="5%"  style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;"></th>';
            html += '<th width="3%"  style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;"">Linha</th>';
            //**************************
            for (var i = 0; i < header.length; i++) {
                if (header[i] == "salt") {
                    html += '<th class="text-center"  style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;" width="8%">' + columns2name[header[i]] + '</th>';
                } else {
                    html += '<th class="text-center"  style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;">' + columns2name[header[i]] + '</th>';
                }
            }
            html += '</tr>';
            html += '</thead>';
            html += '<tbody id="myTable">'
            error_temp = err; // MAGIC
            var line_index = 1; // not zero because the first one was removed
            for (var row in data) {
                line_number += 1;
                if (!err) {
                    line_index += 1;
                    if (isEmpty(data, row) && document.getElementById('autocorrect_line2').checked) {
                        empty_rows.push(line_index);
                        continue;
                    } else if (data[row].length != header.length) {
                        invalid_rows.push(line_index);

                        if (!document.getElementById('autocorrect2').checked) {
                            continue;
                        }

                        if (data[row].length < header.length) {
                            for (var a = data[row].length; a < header.length; a++) {
                                data[row].push('');
                            }
                        } else {
                            for (var a = header.length; a < data[row].length; a++) {
                                data[row].pop();
                            }
                        }
                    }
                }

                html += '<tr>\r\n';
                //**************************
                html += '<td class="text-center" style="vertical-align: middle;">' + 
                       '<div class="d-inline-block">'+   
                            '<button type="button" class="btn btn-danger btn-xs btn_delete"><span class="glyphicon glyphicon-trash"></span></button>  ' +  
                            '<button type="button" class="btn btn-primary btn-xs btn_category get_categories" data-toggle="modal" data-target="#modal-categories"><span class="glyphicon glyphicon-copyright-mark"></span></button> ' +       
                            '<button type="button" class="btn btn-success btn-xs btn_save save_row"><span class="glyphicon glyphicon-save"></span></button>' +
                            '</div></td>';

                html += '<td class="text-center">' + line_number + '</td>'
                    //**************************
                for (var item in data[row]) {
                    if (header[item] == "salt") {
                        html += '<td contenteditable class="text-center" data-parent="' + header[item] + '">' + data[row][item] + '</td>\r\n';
                    } else if (header[item] == "collectiondate") {
                        // required because xls.. gives us data format
                        var date = new Date(data[row][item]).toLocaleDateString("pt-PT");
                        date = date.replace(/\//g ,"-");
                         html += '<td contenteditable data-parent="' + header[item] + '">' + date + '</td>\r\n';
                    } else if (header[item] == "teor") {
                        html += '<td contenteditable data-parent="' + header[item] + '">' + data[row][item].toUpperCase() + '</td>\r\n';
                    } else {
                        html += '<td contenteditable data-parent="' + header[item] + '">' + data[row][item] + '</td>\r\n';
                    }
                }
                html += '</tr>\r\n';
            }
            html += '</tbody>';
            $('#table').html(html);
            
            ApplyTableStyle();

            if (IsTableEmpty()) { 
                Error(4);
                err = error_temp; // MAGIC
            }

            if (ValidateTable() && !err) {
                $('#modal-7').modal('show');
                if (invalid_rows.length > 0) {
                    if (!document.getElementById('autocorrect2').checked) {
                        $('#modal-7 .modal-body').html('<h4>Existem erros. Corriga-os (edite-os na tabela) ou volte atrás.</h4><p class="text-justify">Nota: As linhas <strong>' + invalid_rows.join(', ') + '</strong> foram <i>eliminadas</i> por serem inválidas.</p>');
                    } else {
                        $('#modal-7 .modal-body').html('<h4>Existem erros. Corriga-os (edite-os na tabela) ou volte atrás.</h4><p class="text-justify">Nota: As linhas <strong>' + invalid_rows.join(', ') + '</strong> foram <i>corrigidas</i> mas precisam de verificação manual.</p>');
                    }
                    if (empty_rows.length > 0) {
                        $('#modal-7 .modal-body').append('<p class="text-justify">As linhas <strong>' + empty_rows.join(", ") + '</strong> foram <i>eliminadas</i> por estarem vazias.</p>');
                    }
                } else {
                    if (empty_rows.length > 0) {
                        $('#modal-7 .modal-body').html('<p class="text-justify">As linhas <strong>' + empty_rows.join(", ") + '</strong> foram <i>eliminadas</i> por estarem vazias.</p>');
                    }
                }
            } else {
                modal_ready_showed = true;
            }

        };
        reader.onerror = function() {
            Error(2);
        };
    }




    function handleFileSelectCSV(evt) {
        var files = evt.target.files; // FileList object
        var file = files;
        var line_number = 0;

        duplicate = document.getElementById('duplicates_1').checked;

        var reader = new FileReader();
        reader.readAsText(file[0]);

        var invalid_rows = [];
        var empty_rows = [];
        reader.onload = function(event) {
            var separator = $("#separator option:selected").val();
            var delimiter = $("#delimiter option:selected").val();
            if (delimiter == "none") {
                var options = {
                    "separator": separator
                };
            } else if (delimiter == "quotes") {
                var options = {
                    "separator": separator,
                    "delimiter": "\""
                };
            }

            var csv = event.target.result;
            var data = $.csv.toArrays(csv, options);

            var html = '';
            var header = getHeader();

            if (data[0].length == 1 && data[0][0].length == 0) {
                Error(6);
                return;
            }

            if (header.length != data[0].length) {
                Error(1);
                return;
            }

            $(".section-input").addClass("hidden");
            $(".section-validation").removeClass("hidden");

            var html = '<thead>';
            html += '<tr class="info">';
            //**************************
            html += '<th width="5%"  style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;"></th>';
            html += '<th width="3%"  style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;"">Linha</th>';
            //**************************
            for (var i = 0; i < header.length; i++) {
                if (header[i] == "salt") {
                    html += '<th class="text-center"  style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;" width="8%">' + columns2name[header[i]] + '</th>';
                } else {
                    html += '<th class="text-center"  style="vertical-align: middle;background-color: rgb(51, 122, 183);color:white;" >' + columns2name[header[i]] + '</th>';
                }
            }
            html += '</tr>';
            html += '</thead>';
            html += '<tbody id="myTable">'

            var line_index = 0;
            for (var row in data) {
                line_number += 1;
                if (!error_temp) {
                    line_index += 1;
                    if (isEmpty(data, row) && document.getElementById('autocorrect_line').checked) {
                        empty_rows.push(line_index);
                        continue;
                    } else if (data[row].length != header.length) {
                        invalid_rows.push(line_index);

                        if (!document.getElementById('autocorrect').checked) {
                            continue;
                        }

                        if (data[row].length < header.length) {
                            for (var a = data[row].length; a < header.length; a++) {
                                data[row].push('');
                            }
                        } else {
                            for (var a = header.length; a < data[row].length; a++) {
                                data[row].pop();
                            }
                        }
                    }
                }

                html += '<tr>\r\n';
                //**************************
                html += '<td class="text-center" style="vertical-align: middle;">' + 
                       '<div class="d-inline-block">'+   
                            '<button type="button" class="btn btn-danger btn-xs btn_delete"><span class="glyphicon glyphicon-trash"></span></button>  ' +  
                            '<button type="button" class="btn btn-primary btn-xs btn_category get_categories" data-toggle="modal" data-target="#modal-categories"><span class="glyphicon glyphicon-copyright-mark"></span></button> ' +       
                            '<button type="button" class="btn btn-success btn-xs btn_save save_row"><span class="glyphicon glyphicon-save"></span></button>' +
                            '</div></td>';


                html += '<td class="text-center"><strong>' + line_number + '</strong></td>'
                    //**************************
                for (var item in data[row]) {
                    if (header[item] == "salt") {
                        html += '<td contenteditable class="text-center" data-parent="' + header[item] + '">' + data[row][item] + '</td>\r\n';
                    } else if (header[item] == "teor") {
                        html += '<td contenteditable data-parent="' + header[item] + '">' + data[row][item].toUpperCase() + '</td>\r\n';
                    } else {
                        html += '<td contenteditable data-parent="' + header[item] + '">' + data[row][item] + '</td>\r\n';
                    }
                }
                html += '</tr>\r\n';
            }
            html += '</tbody>';
            $('#table').html(html);


            ApplyTableStyle();

            if (IsTableEmpty()) {
                Error(4);
            }

            if (ValidateTable() && !error_temp) {
                $('#modal-7').modal('show');
                if (invalid_rows.length > 0) {
                    if (!document.getElementById('autocorrect').checked) {
                        $('#modal-7 .modal-body').html('<h4>Existem erros. Corriga-os (edite-os na tabela) ou volte atrás.</h4><p class="text-justify">Nota: As linhas <strong>' + invalid_rows.join(', ') + '</strong> foram <i>eliminadas</i> por serem inválidas.</p>');
                    } else {
                        $('#modal-7 .modal-body').html('<h4>Existem erros. Corriga-os (edite-os na tabela) ou volte atrás.</h4><p class="text-justify">Nota: As linhas <strong>' + invalid_rows.join(', ') + '</strong> foram <i>corrigidas</i> mas precisam de verificação manual.</p>');
                    }
                    if (empty_rows.length > 0) {
                        $('#modal-7 .modal-body').append('<p class="text-justify">As linhas <strong>' + empty_rows.join(", ") + '</strong> foram <i>eliminadas</i> por estarem vazias.</p>');
                    }
                } else {
                    if (empty_rows.length > 0) {
                        $('#modal-7 .modal-body').html('<p class="text-justify">As linhas <strong>' + empty_rows.join(", ") + '</strong> foram <i>eliminadas</i> por estarem vazias.</p>');
                    }
                }
            } else {
                modal_ready_showed = true;
            }

        };
        reader.onerror = function() {
            Error(2);
        };
    }

    // inverse dictionary search: get key from value
    function objectKeyByValue(obj, val) {
        return Object.entries(obj).find(i => i[1] === val);
    }

    // get the selected fields in order
    function getHeader() {
        var selected = [];
        $('#myList li input').each(function() {
            if ($(this).is(":checked")) {         
                selected.push( $(this).attr('name'));
            }
        });
        return selected;
    };

    // select file
    $(document).on('click', '.browse', function() {
        var file = $(this).parent().parent().parent().find('.file');
        file.trigger('click');
    });

    $(document).on('change', '.file', function() {
        $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });

    // back from import table to import file
    $(document).on('click', '#back', function() {
        Back();
    });

    // no errors => save button is enable => save table contents
    $(document).on('click', '#save', function() {
        SaveData(GetJsonFromTable());
    });

    // save single row
    $(document).on('click', '.save_row', function() {
        if (error_temp) return false;
        var data = [];
       var tr = $(this).closest('tr');
        // clear validation classes so all line shows the effect
        tr.find('td').each(function() {
            $(this).removeClass("validbut invalid valid");
            data.push($(this).text());
        });

        data.shift();   // remove button column
        data.shift();   // remove line number
        var header = getHeader();
        data.push("<?php echo $_SESSION['username']; ?>");
        header.push("whoinserted");
        var obj = {}
        for (var i = 0; i < header.length; i++) {
            obj[header[i]] = data[i]
        }

        tr.css("background-color", "#58FA58");


        $.ajax({
            url: "database/savesingleproduct.php",
            method: "POST",
            data: {data:JSON.stringify(obj), duplicate:duplicate,username: "<?php echo $_SESSION['username']; ?>"},
            cache: false,
            success: function(response) {
                if (response == "ok") {
                    tr.fadeOut(400, function() {
                         datatable.row( tr ).remove().draw(false);
                        if (IsTableEmpty()) {
                            Error(4);
                        }            
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

    // show categories tree for categories selection
    // but only if there was no errors with the file
    $(document).on('click', '.get_categories', function() {
        if (error_temp) return false;
        tr_2_insert_categories = $(this).closest('tr');
    });

    // called from _cattree.hmtl
    function setPath(p) {
        path = p;
    }

    // accept categories from modal window and populate categories of the selected row
    function Accept() { 
        var header = getHeader();
        var index = -2;
        tr_2_insert_categories.find('td').each(function() {
            if (header[index] == "category" && path[0] != undefined) {
                $(this).html(path[0]);
                ValidateCell($(this));
                datatable.cell( $(this) ).data($(this).html());
            }
            if (header[index] == "subcategory1" && path[1] != undefined) {
                $(this).html(path[1]);
                ValidateCell($(this));
                datatable.cell( $(this) ).data($(this).html());
            }
            if (header[index] == "subcategory2" && path[2] != undefined) {
                $(this).html(path[2]);
                ValidateCell($(this));
                datatable.cell( $(this) ).data($(this).html());
            }
            if (header[index] == "subcategory3" && path[3] != undefined) {
                $(this).html(path[3]);
                ValidateCell($(this));
                datatable.cell( $(this) ).data($(this).html());
            }
            index += 1;
        });
    };



    // dragging system
    $(function() {
        $("#myList").sortable({
            placeholder: "ui-state-highlight"
        });
        $("#myList").disableSelection();
    });

    // ************* modals
    // TODO: REPLACE MODALS WITH SIMILAR ACTION
    // WITH SINGLE ONE.
    function Error(n) {
        error_temp = true;
        $("#save").prop("disabled", true);
        if (!IsTableEmpty) {
            $(".submission-info").removeClass("hidden");
        }        
        switch (n) {
            case 0:
                $('#modal-1').modal('show');
                break;
            case 1:
                $('#modal-2').modal('show');
                break;
            case 2:
                $('#modal-3').modal('show');
                break;
            case 3:
                $('#modal-4').modal('show');
                break;
            case 4:
                $('#modal-5').modal('show');
                break;
            case 5:
                $('#modal-10').modal('show');
                break;
            case 6:
                $('#modal-11').modal('show');
                break;
            default:
                {};
        }
    };

    function return2Index() {
        window.location.href = "index.php";
    };


    // error or import done => clear all (file selection + import table)
    function Back() {
        if (datatable != null) {
            datatable.destroy();
            database = null;
        }  

        $(".section-validation").addClass("hidden");
        $(".section-input").removeClass("hidden");
        document.getElementById("files_excel").value = "";
        document.getElementById("files_csv").value = "";
        $("#save").prop("disabled", false);
        $(".submission-info").addClass("hidden");
         $('#table').empty();

        error_temp = false;
        errors_in_cell = false;
        modal_ready_showed = false;
        datatable = null;

        $('#modal-7 .modal-body').html('<h4>Existem erros. Corriga-os (edite-os na tabela) ou volte atrás.</h4>');
    };


    // file problems => clear all (file selection)
    function Reset() {
        if (datatable != null) {
            datatable.destroy();
            database = null;
        }

        document.getElementById("files_excel").value = "";
        document.getElementById("files_csv").value = "";

        error_temp = false;
    };

    function ShowHelp(a) {
        if (a == 1) $('#modal-ajuda').modal('show');
        if (a == 2) $('#modal-ajuda-excel').modal('show');
    };

    function Again() {
        window.location.href = "database/import.php";
    };

    // save table
    function GetJsonFromTable() {

        var TableData;
        var TableData = new Array();
        var fields = getHeader();

        $('#table tr').each(function(row, tr) {
            TableData[row] = {};
            // start at 2 and use (i-2) to remove the delete and the line number columns
            for (var i = 2; i < fields.length + 2; i++) {
                TableData[row][fields[i - 2]] = $(tr).find('td:eq(' + i + ')').text();
            }
        });

        // get header
        header = TableData.shift(); // remove first row - header
        return TableData;
    };

    // save all table
    function SaveData(jsondata) {
        var tr = $("#myTable");

        datatable.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
            $('td', rowIdx).css('background-color', '#58FA58');
        } );

        $.ajax({
            url: "database/saveimport.php",
            method: "POST",
            data: {
                data: JSON.stringify(jsondata),
                username: "<?php echo $_SESSION['username']; ?>",
                duplicate:duplicate
            },
            cache: false,
            dataType: "text",
            success: function(response) {
                if (response == "error1") {
                    window.location.href = "error.php?error=Problemas com a base de dados (execute statement).";
                } else if (response == "error2") {
                    window.location.href = "error.php?error=Problemas com a base de dados (prepare statement).";
                } else {
                     tr.fadeOut(400, function() {
                        datatable.clear()
                    });
                    $('#modal-6').modal('show');
                    $("#modal-6 .modal-body").html("<h4>Foram inseridos <strong>" + response + " </strong> produtos.<h4>");
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

    // delete single row
    $(document).on('click', '.btn_delete', function() {
        var tr = $(this).closest('tr');
        // clear validation classes so all line shows the effect
        tr.find('td').each(function() {
            $(this).removeClass("validbut invalid valid");
        });

        tr.css("background-color", "#FF3700");
        tr.fadeOut(400, function() {
             datatable.row( tr ).remove().draw(false);
            if (IsTableEmpty()) {
                Error(4);
            }
            if (!ValidateTable() && !modal_ready_showed) {
                $('#modal-8').modal('show');
                modal_ready_showed = true;
            }
        });
        return false;
    });


    $(document).on('click', '#help-csv', function() {
        $('#modal-help-csv').modal('show');
    });
    $(document).on('click', '#help-excel', function() {
        $('#modal-help-excel').modal('show');
    });

    
    function isEmpty(data, row) {
        var counter = 0;
        for (var item in data[row]) {
            if (data[row][item] != "") counter += 1;
        }

        if (counter > 0) return false;
        return true;
    }


    function IsTableEmpty() {
        if (datatable.rows().count() == 0) {
            return true;
        }
        return false;
    }

    function getNumberOfRows(id) {
        return $(id + ' tr').length;
    }
    


    // return true if invalid
    function setColor(element, min, max, validifempty = true, ) {
        var value = element.textContent;
        element.classList.remove("validbut");
        if (value.length == 0 && validifempty) {
            element.classList.remove("invalid");
            element.classList.add("valid");
            return false;
        }
        if (value.length < min || value.length > max) {
            element.classList.remove("valid");
            element.classList.add("invalid");
            errors_in_cell = true;
            return true;
        } else {
            element.classList.remove("invalid");
            element.classList.add("valid");
            return false;
        }
    }

    // called eveytime a cell is changed: key, paste, ...
    function ValidateCell(element) {
        if (!ValidateTable() && !modal_ready_showed) {
            $('#modal-8').modal('show');
            modal_ready_showed = true;
        }
    }


    function isNumeric(str) {
      var er = /^\d+(?:\,|.\d+)?$/;
      return (er.test(str));
    }

    // TODO: REPLACE HARD IFs WITH JSON STRUCT IN CONFIG CONTAINING
    // FIELD NAME AND VALIDATORS
    function CheckCell(element) {
        var cellvalue = element.textContent;
        var header = element.dataset.parent;

        if (header == 'name') {
            setColor(element, <?php echo NAME_MIN; ?>, <?php echo NAME_MAX; ?>, false);
        } else if (header == 'category') {
            if (setColor(element, <?php echo CATEGORY_MIN; ?>, <?php echo CATEGORY_MAX; ?>, false)) return;
            if (jQuery.inArray(cellvalue, cat) < 0) {
                element.classList.add("validbut");
            }
        } else if (header == 'salt') {
            if (/*isNaN(cellvalue) || */cellvalue.length == 0 || !isNumeric(cellvalue)) {
                element.classList.add("invalid");
                errors_in_cell = true;
            } else {
                element.classList.remove("invalid");
            }
        } else if (header == 'subcategory1') {
            if (setColor(element, <?php echo SUBCATEGORY1_MIN; ?>, <?php echo SUBCATEGORY1_MAX; ?>)) return;
            if (jQuery.inArray(cellvalue, subcat1) < 0) {
                element.classList.add("validbut");
            }
        } else if (header == 'subcategory2') {
            if (setColor(element, <?php echo SUBCATEGORY2_MIN; ?>, <?php echo SUBCATEGORY2_MAX; ?>)) return;
            if (jQuery.inArray(cellvalue, subcat2) < 0) {
                element.classList.add("validbut");
            }
        } else if (header == 'subcategory3') {
            if (setColor(element, <?php echo SUBCATEGORY3_MIN; ?>, <?php echo SUBCATEGORY3_MAX; ?>)) return;
            if (jQuery.inArray(cellvalue, subcat3) < 0) {
                element.classList.add("validbut");
            }
        } else if (header == 'source') {
            setColor(element, <?php echo SOURCE_MIN; ?>, <?php echo SOURCE_MAX; ?>);
        } else if (header == 'notes') {
            setColor(element, <?php echo NOTES_MIN; ?>, <?php echo NOTES_MAX; ?>);
        } else if (header == 'brand') {
            setColor(element, <?php echo BRAND_MIN; ?>, <?php echo BRAND_MAX; ?>);
        } else if (header == 'subbrand') {
            setColor(element, <?php echo SUBBRAND_MIN; ?>, <?php echo SUBBRAND_MAX; ?>);
        } else if (header == 'wherecollected') {
            setColor(element, <?php echo WHERECOLLECTED_MIN; ?>, <?php echo WHERECOLLECTED_MAX; ?>);
        } else if (header == 'collectiondate') {            
             if (cellvalue.length == 0 || (!isValidDate1(cellvalue) && !isValidDate2(cellvalue))) {
                element.classList.add("invalid");
                errors_in_cell = true;
            } else {
                element.classList.remove("invalid");
            }
        } else if (header == 'teor') {            
             if (cellvalue == "BAIXO" || cellvalue  == "MÉDIO" || cellvalue == "ALTO") {
                element.classList.remove("invalid");
            } else {
                element.classList.add("invalid");
                errors_in_cell = true;
            }
        }
    }

    // TODO: join these 2 functions
    function isValidDate1(dateString) {
        var regEx = /^\d{2}-\d{2}-\d{4}$/;
        return dateString.match(regEx) != null;
    }
    function isValidDate2(dateString) {
        var regEx = /^\d{4}-\d{2}-\d{2}$/;
        return dateString.match(regEx) != null;
    }


    // detect every validation error in the all table
    function ValidateTable() {
        errors_in_cell = false;
        var btn =  null;
        $('#myTable tr').each(function() {
            var error_in_line =false;
            $(this).find('td').each(function() {
                CheckCell($(this).get(0));
                if ($(this).hasClass("invalid")) {
                    error_in_line = true;
                }
            })
            btn = $(this).find('.btn_save');
            if (error_in_line) {
               if (!btn.hasClass("hidden")) btn.addClass("hidden");
            } else {
                if (btn.hasClass("hidden")) btn.removeClass("hidden");
            }
        })

        if (!errors_in_cell && !error_temp) {
            $("#save").prop("disabled", false);
            $(".submission-info").addClass("hidden");
        } else if (errors_in_cell) {
            $("#save").prop("disabled", true);
            $(".submission-info").removeClass("hidden");
        }

        return errors_in_cell;
    }

    $('body').on('focus', '[contenteditable]', function() {
        const $this = $(this);
        $this.data('before', $this.html());
        return $this;
    })
    .on('change keyup paste', '[contenteditable]', function() {
            var $this = $(this);
            if ($this.data('before') !== $this.html()) {
                $this.data('before', $this.html());
                $this.trigger('change');
                ValidateCell($this);
            }
            return $this;
        });


    $("body").on("blur", '[contenteditable]', function() {
        datatable.cell( $(this) ).data($(this).html());
    });
    

    // modals' closing events
    $("#modal-2").on('hide.bs.modal', function(){
        Reset();
    });
    $("#modal-3").on('hide.bs.modal', function(){
        Back();
    });
    $("#modal-4").on('hide.bs.modal', function(){
        Back();
    }); 
    $("#modal-5").on('hide.bs.modal', function(){
        Back();
    }); 
    $("#modal-6").on('hide.bs.modal', function(){
        Back();
    }); 
    $("#modal-10").on('hide.bs.modal', function(){
        Reset();
    }); 
    $("#modal-11").on('hide.bs.modal', function(){
        Reset();
    });


</script>

<?php include('../footer.php'); ?>
