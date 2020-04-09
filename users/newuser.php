<?php include('../isAdmin.php'); ?>
<?php include('../header.php'); ?>

<div class="container-fluid below-nav">
    <div class="col-md-12">

        <form class="form-horizontal"   id="reg_form">

            <input type="hidden" id="staticusername" name="adminuser" value="<?php echo $_SESSION['username']; ?>">
            <div class = "row">
                <div class="col-md-1"></div>
                <div class="col-md-9">
                    <legend> Conta <span style="font-size:75%;">(Obrigatório)</span></legend>
                </div>
            </div>
            <fieldset>
                <div class="form-group username">
                    <label class="col-md-4 control-label">Nome de Utilizador</label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="username_1A" placeholder="Nome de utilizador" class="form-control" type="text" id="username_1A" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" style="background-color:white;" required>
                        </div>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="password"  class="col-md-4 control-label">
                    Password
                    </label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input class="form-control" id="userPw" type="password" placeholder="password" 
                                name="password" data-minLength="5"
                                data-error="some error" 
                                autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" 
                                 style="background-color:white;"
                                required>
                            <span class="glyphicon form-control-feedback"></span>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="confirmPassword"  class="col-md-4 control-label">
                    Confirmar Password
                    </label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input class="form-control {$borderColor}" id="userPw2" type="password" placeholder="Confirmar password" 
                                name="confirmPassword" data-match="#confirmPassword" data-minLength="5"
                                data-match-error="some error 2" 
                               autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" 
                                style="background-color:white;"
                                required>
                            <span class="glyphicon form-control-feedback"></span>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Nível de acesso</label>
                    <div class="col-md-6  inputGroupContainer">
                        <label class="radio-inline">
                        <input type="radio" name="rights" value = "1">Administrador
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="rights" value = "0" checked>Participante
                        </label>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <!-- Form Name -->
                <div class = "row">
                    <div class="col-md-1"></div>
                    <div class="col-md-9">
                        <legend> Informação Pessoal <span style="font-size:75%;">(Opcional) </legend>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Nome</label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input  name="firstname" placeholder="Primeiro nome" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" >Apelido</label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="lastname" placeholder="Apelido" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Telefone</label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input name="phone" placeholder="(+351) 000000000" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Email
                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Necessário se desejar receber notificações."><span class="glyphicon glyphicon-info-sign"></span></a>
                    </label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="email" placeholder="Endereço de email" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Morada</label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                            <input name="address" placeholder="Morada" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Cidade</label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                            <input name="city" placeholder="Cidade" class="form-control" type="text" >
                        </div>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Código Postal</label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                            <input name="zip" placeholder="0000" class="form-control"  type="text">
                        </div>
                    </div>
                </div>
                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label">País</label>
                    <div class="col-md-6 selectContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select name="country" class="form-control selectpicker" >
                                <option value=" " >Selecione o país</option>
                                <option value="África do Sul">África do Sul</option>
                                <option value="Albânia">Albânia</option>
                                <option value="Alemanha">Alemanha</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antigua">Antigua</option>
                                <option value="Arábia Saudita">Arábia Saudita</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armênia">Armênia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Austrália">Austrália</option>
                                <option value="Áustria">Áustria</option>
                                <option value="Azerbaijão">Azerbaijão</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrein">Bahrein</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Bélgica">Bélgica</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermudas">Bermudas</option>
                                <option value="Botsuana">Botsuana</option>
                                <option value="Brasil">Brasil</option>
                                <option value="Brunei">Brunei</option>
                                <option value="Bulgária">Bulgária</option>
                                <option value="Burkina Fasso">Burkina Fasso</option>
                                <option value="botão">botão</option>
                                <option value="Cabo Verde">Cabo Verde</option>
                                <option value="Camarões">Camarões</option>
                                <option value="Camboja">Camboja</option>
                                <option value="Canadá">Canadá</option>
                                <option value="Cazaquistão">Cazaquistão</option>
                                <option value="Chade">Chade</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Cidade do Vaticano">Cidade do Vaticano</option>
                                <option value="Colômbia">Colômbia</option>
                                <option value="Congo">Congo</option>
                                <option value="Coréia do Sul">Coréia do Sul</option>
                                <option value="Costa do Marfim">Costa do Marfim</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Croácia">Croácia</option>
                                <option value="Dinamarca">Dinamarca</option>
                                <option value="Djibuti">Djibuti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="EUA">EUA</option>
                                <option value="Egito">Egito</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Emirados Árabes">Emirados Árabes</option>
                                <option value="Equador">Equador</option>
                                <option value="Eritréia">Eritréia</option>
                                <option value="Escócia">Escócia</option>
                                <option value="Eslováquia">Eslováquia</option>
                                <option value="Eslovênia">Eslovênia</option>
                                <option value="Espanha">Espanha</option>
                                <option value="Estônia">Estônia</option>
                                <option value="Etiópia">Etiópia</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Filipinas">Filipinas</option>
                                <option value="Finlândia">Finlândia</option>
                                <option value="França">França</option>
                                <option value="Gabão">Gabão</option>
                                <option value="Gâmbia">Gâmbia</option>
                                <option value="Gana">Gana</option>
                                <option value="Geórgia">Geórgia</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Granada">Granada</option>
                                <option value="Grécia">Grécia</option>
                                <option value="Guadalupe">Guadalupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guiana">Guiana</option>
                                <option value="Guiana Francesa">Guiana Francesa</option>
                                <option value="Guiné-bissau">Guiné-bissau</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Holanda">Holanda</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungria">Hungria</option>
                                <option value="Iêmen">Iêmen</option>
                                <option value="Ilhas Cayman">Ilhas Cayman</option>
                                <option value="Ilhas Cook">Ilhas Cook</option>
                                <option value="Ilhas Curaçao">Ilhas Curaçao</option>
                                <option value="Ilhas Marshall">Ilhas Marshall</option>
                                <option value="Ilhas Turks & Caicos">Ilhas Turks & Caicos</option>
                                <option value="Ilhas Virgens (brit.)">Ilhas Virgens (brit.)</option>
                                <option value="Ilhas Virgens(amer.)">Ilhas Virgens(amer.)</option>
                                <option value="Ilhas Wallis e Futuna">Ilhas Wallis e Futuna</option>
                                <option value="Índia">Índia</option>
                                <option value="Indonésia">Indonésia</option>
                                <option value="Inglaterra">Inglaterra</option>
                                <option value="Irlanda">Irlanda</option>
                                <option value="Islândia">Islândia</option>
                                <option value="Israel">Israel</option>
                                <option value="Itália">Itália</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japão">Japão</option>
                                <option value="Jordânia">Jordânia</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Líbano">Líbano</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lituânia">Lituânia</option>
                                <option value="Luxemburgo">Luxemburgo</option>
                                <option value="Macau">Macau</option>
                                <option value="Macedônia">Macedônia</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malásia">Malásia</option>
                                <option value="Malaui">Malaui</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marrocos">Marrocos</option>
                                <option value="Martinica">Martinica</option>
                                <option value="Mauritânia">Mauritânia</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="México">México</option>
                                <option value="Moldova">Moldova</option>
                                <option value="Mônaco">Mônaco</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Nicarágua">Nicarágua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigéria">Nigéria</option>
                                <option value="Noruega">Noruega</option>
                                <option value="Nova Caledônia">Nova Caledônia</option>
                                <option value="Nova Zelândia">Nova Zelândia</option>
                                <option value="Omã">Omã</option>
                                <option value="Palau">Palau</option>
                                <option value="Panamá">Panamá</option>
                                <option value="Papua-nova Guiné">Papua-nova Guiné</option>
                                <option value="Paquistão">Paquistão</option>
                                <option value="Peru">Peru</option>
                                <option value="Polinésia Francesa">Polinésia Francesa</option>
                                <option value="Polônia">Polônia</option>
                                <option value="Porto Rico">Porto Rico</option>
                                <option value="Portugal" selected>Portugal</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Quênia">Quênia</option>
                                <option value="Rep. Dominicana">Rep. Dominicana</option>
                                <option value="Rep. Tcheca">Rep. Tcheca</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romênia">Romênia</option>
                                <option value="Ruanda">Ruanda</option>
                                <option value="Rússia">Rússia</option>
                                <option value="Saipan">Saipan</option>
                                <option value="Samoa Americana">Samoa Americana</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serra Leone">Serra Leone</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Singapura">Singapura</option>
                                <option value="Síria">Síria</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="St. Kitts & Nevis">St. Kitts & Nevis</option>
                                <option value="St. Lúcia">St. Lúcia</option>
                                <option value="St. Vincent">St. Vincent</option>
                                <option value="Sudão">Sudão</option>
                                <option value="Suécia">Suécia</option>
                                <option value="Suiça">Suiça</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Tailândia">Tailândia</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tanzânia">Tanzânia</option>
                                <option value="Togo">Togo</option>
                                <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                <option value="Tunísia">Tunísia</option>
                                <option value="Turquia">Turquia</option>
                                <option value="Ucrânia">Ucrânia</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Uruguai">Uruguai</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnã">Vietnã</option>
                                <option value="Zaire">Zaire</option>
                                <option value="Zâmbia">Zâmbia</option>
                                <option value="Zimbábue">Zimbábue</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Text area -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Comentários </label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                            <textarea class="form-control" name="comments" placeholder="Notas "></textarea>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <br>
                <div class="form-group row">
                    <div class="col-md-5">
                    </div>
                    <div class="col-md-3"> 
                        <button type="submit" class="btn btn-primary" id = "submit"><span class="glyphicon glyphicon-save"></span>  Gravar </button>
                        <button type="reset" class="btn" value="Reset"><span class="glyphicon glyphicon-refresh"></span>  Limpar </button>
                    </div>
                </div>
            </fieldset>
            
        </form>



        <!-- -->
        <!-- Modal -->
        <div class="modal fade" id="ErrorModal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="font-size: 150%">&times;</span></button>
                        <h3 class="modal-title" id="title" style="color: red;">Erro</h3>
                    </div>
                    <div class="modal-body text-center" id="msg">
                        <h4>Nome de utilizador já existente.</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal-error-btn"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- -->
        <!-- Modal -->
        <!-- -->
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="font-size: 150%" onclick="Back()">&times;</span></button>
                        <h3 class="modal-title" id="title">Obrigado</h3>
                    </div>
                    <div class="modal-body text-center" id="msg">
                        <h4>Utilizador criado e validado com sucesso.</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal-btn" onclick="Back()"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- -->
        <!-- Modal -->


    </div>
</div>



<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>

<script>

    $(document).ready(function() {
        $('#reg_form').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            submitHandler: function(validator, form, submitButton) {
                saveNewUser();
            },
            fields: {
                firstname: {
                    validators: {
                        stringLength: {
                            min: 2,
                            max: 16,
                            message:'Entre 2 e 16 caracteres!'
                        },
                    }
                },
                lastname: {
                    validators: {
                        stringLength: {
                            min: 2,
                            max: 16,
                            message:'Entre 2 e 16 caracteres!'
                        },
                    }
                },            
                phone: {
                    validators: {
                        stringLength: {
                            min: 9,
                            max: 16,
                            message:'Entre 9 e 16 caracteres!'
                        },
                    }
                },
                address: {
                    validators: {
                        stringLength: {
                            min: 2,
                            max: 32,
                            message:'Entre 2 e 32 caracteres!'
                        },
                    }
                },
                city: {
                    validators: {
                        stringLength: {
                            min: 2,
                            max: 16,
                            message:'Entre 2 e 16 caracteres!'
                        },
                    }
                },
                state: {
                    validators: {
                        stringLength: {
                            min: 2,
                            max: 16,
                            message:'Entre 2 e 16 caracteres!'
                        },
                    }
                },
                zip: {
                    validators: {
                        stringLength: {
                            min: 2,
                            max: 10,
                            message:'Entre 2 e 10 caracteres!'
                        },
                    }
                },
                comments: {
                    validators: {
                        stringLength: {
                            min: 2,
                            max: 64,
                            message:'Entre 2 e 64 caracteres!'
                        },
                    }
                },  
                email: {
                    validators: {
                        emailAddress: {
                            message: 'Por favor, introduza um endereço de email válido!'
                        }
                    }
                },            
                username_1A: {
                    validators: {
                        stringLength: {
                            min: 8,
                            max: 16,
                            message:'Entre 8 e 16 caracteres!'
                        },
                        notEmpty: {
                            message: 'Por favor, introduza um nome de utilzador válido!'
                        }
                    }
                },          
                password: {
                    validators: {
                        stringLength: {
                            min: 8,
                            max: 16,
                            message:'Entre 8 e 16 caracteres!'
                        },
                        identical: {
                            field: 'confirmPassword',
                            message: 'Confirma a password em baixo!'
                        }
                    }
                },
                confirmPassword: {
                    validators: {
                        identical: {
                            field: 'password',
                            message: 'A password e a confirmação são diferentes!'
                        }
                    }
                },
            }
        });

    });
    
    
    
    function saveNewUser() {
        $.ajax({  
            url:"users/savenewuser.php",  
            method:"POST",
            data:$('#reg_form').serialize(),
            cache: false,
            success:function(response) {
                if (response == "usernameerror") {                     
                    $('#ErrorModal').modal('show');
                    $(".username").addClass("has-error");  
                } else if (response == "ok") {
                    $('#myModal').modal('show');
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
    

    $("#myModal").on('hide.bs.modal', function(){
        Back();
    });

    function Back() {
        window.location.href="users/newuser.php"; 
    }

    
</script>


<?php include('../footer.php'); ?>