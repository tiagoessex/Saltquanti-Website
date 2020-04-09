<?php include('../isAdmin.php'); ?>
<?php include('../header.php'); ?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {    
      $link = db_start();
      $sql = 'SELECT * from  ' . DB_TABLE_USERS . ' where id like "'. $_GET['id'] . '" LIMIT 1';
      $query = mysqli_query($link, $sql);
      if (!$query) {          
          Error("Problemas com a base de dados: " . mysqli_error($link));
          die();
      }    
      $row = mysqli_fetch_array($query);
    }
?>


<div class="container-fluid below-nav">
    <div class="col-md-12">

        <form class="form-horizontal"   id="reg_form">

            <input type="hidden" id="userid" name="userid" value="<?php echo $_GET['id']; ?>">


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
                            <input name="username" placeholder="Nome de utilizador" class="form-control" type="text" id="username" required value = "<?php echo $row['username']; ?>" disabled>
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
                                required
                                 value = "<?php echo $row['password']; ?>" >
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
                                required
                                 value = "<?php echo $row['password']; ?>" >
                            <span class="glyphicon form-control-feedback"></span>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-md-4 control-label">Nível de acesso</label>
                    <div class="col-md-6  inputGroupContainer">
                        <label class="radio-inline">
                            <input type="radio" name="rights" value = "1" <?php echo ($row['administrator'] == "1"? "checked='checked'" : "" ); ?>>Administrador
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="rights" value = "0" <?php echo ((!isset($_GET['id']) || $row['administrator'] == "0")? "checked='checked'" : "" ); ?>>Participante
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
                            <input  name="firstname" placeholder="Primeiro nome" class="form-control"  type="text" value = "<?php echo $row['firstname']; ?>">
                        </div>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" >Apelido</label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="lastname" placeholder="Apelido" class="form-control"  type="text" value = "<?php echo $row['lastname']; ?>">
                        </div>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Telefone</label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input name="phone" placeholder="(+351) 000000000" class="form-control" type="text" value = "<?php echo $row['phone']; ?>">
                        </div>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Email
                       <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Necessário se desejar receber notificações."><span class="glyphicon glyphicon-info-sign"></span></a>
                    </label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="email" placeholder="Endereço de email" class="form-control"  type="text" value = "<?php echo $row['email']; ?>">
                        </div>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Morada</label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                            <input name="address" placeholder="Morada" class="form-control" type="text" value = "<?php echo $row['address']; ?>">
                        </div>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Cidade</label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                            <input name="city" placeholder="Cidade" class="form-control" type="text" value="<?php echo $row['city']; ?>">
                        </div>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Código Postal</label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                            <input name="zip" placeholder="0000" class="form-control"  type="text" value = "<?php echo $row['zip']; ?>">
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
                                <option value="África do Sul" <?php echo ($row['country'] == "África do Sul"? "selected" : "" ); ?> > África do Sul</option>        
                                <option value="Albânia" <?php echo ($row['country'] == "Albânia"? "selected" : "" ); ?> > Albânia</option>
                                <option value="Alemanha" <?php echo ($row['country'] == "Alemanha"? "selected" : "" ); ?> > Alemanha</option>
                                <option value="Andorra" <?php echo ($row['country'] == "Andorra"? "selected" : "" ); ?> > Andorra</option>
                                <option value="Angola" <?php echo ($row['country'] == "Angola"? "selected" : "" ); ?> > Angola</option>
                                <option value="Anguilla" <?php echo ($row['country'] == "Anguilla"? "selected" : "" ); ?> > Anguilla</option>
                                <option value="Antigua" <?php echo ($row['country'] == "Antigua"? "selected" : "" ); ?> > Antigua</option>
                                <option value="Arábia Saudita" <?php echo ($row['country'] == "Arábia Saudita"? "selected" : "" ); ?> > Arábia Saudita</option>
                                <option value="Argentina" <?php echo ($row['country'] == "Argentina"? "selected" : "" ); ?> > Argentina</option>
                                <option value="Armênia" <?php echo ($row['country'] == "Armênia"? "selected" : "" ); ?> > Armênia</option>
                                <option value="Aruba" <?php echo ($row['country'] == "Aruba"? "selected" : "" ); ?> > Aruba</option>
                                <option value="Austrália" <?php echo ($row['country'] == "Austrália"? "selected" : "" ); ?> > Austrália</option>
                                <option value="Áustria" <?php echo ($row['country'] == "Áustria"? "selected" : "" ); ?> > Áustria</option>
                                <option value="Azerbaijão" <?php echo ($row['country'] == "Azerbaijão"? "selected" : "" ); ?> > Azerbaijão</option>
                                <option value="Bahamas" <?php echo ($row['country'] == "Bahamas"? "selected" : "" ); ?> > Bahamas</option>
                                <option value="Bahrein" <?php echo ($row['country'] == "Bahrein"? "selected" : "" ); ?> > Bahrein</option>
                                <option value="Bangladesh" <?php echo ($row['country'] == "Bangladesh"? "selected" : "" ); ?> > Bangladesh</option>
                                <option value="Barbados" <?php echo ($row['country'] == "Barbados"? "selected" : "" ); ?> > Barbados</option>
                                <option value="Bélgica" <?php echo ($row['country'] == "Bélgica"? "selected" : "" ); ?> > Bélgica</option>
                                <option value="Benin" <?php echo ($row['country'] == "Benin"? "selected" : "" ); ?> > Benin</option>
                                <option value="Bermudas" <?php echo ($row['country'] == "Bermudas"? "selected" : "" ); ?> > Bermudas</option>
                                <option value="Botsuana" <?php echo ($row['country'] == "Botsuana"? "selected" : "" ); ?> > Botsuana</option>
                                <option value="Brasil" <?php echo ($row['country'] == "Brasil"? "selected" : "" ); ?> >Brasil</option>
                                <option value="Brunei" <?php echo ($row['country'] == "Brunei"? "selected" : "" ); ?> > Brunei</option>
                                <option value="Bulgária" <?php echo ($row['country'] == "Bulgária"? "selected" : "" ); ?> > Bulgária</option>
                                <option value="Burkina Fasso" <?php echo ($row['country'] == "Burkina Fasso"? "selected" : "" ); ?> > Burkina Fasso</option>
                                <option value="Cabo Verde" <?php echo ($row['country'] == "Cabo Verde"? "selected" : "" ); ?> > Cabo Verde</option>
                                <option value="Camarões" <?php echo ($row['country'] == "Camarões"? "selected" : "" ); ?> > Camarões</option>
                                <option value="Camboja" <?php echo ($row['country'] == "Camboja"? "selected" : "" ); ?> > Camboja</option>
                                <option value="Canadá" <?php echo ($row['country'] == "Canadá"? "selected" : "" ); ?> > Canadá</option>
                                <option value="Cazaquistão" <?php echo ($row['country'] == "Cazaquistão"? "selected" : "" ); ?> > Cazaquistão</option>
                                <option value="Chade" <?php echo ($row['country'] == "Chade"? "selected" : "" ); ?> > Chade</option>
                                <option value="Chile" <?php echo ($row['country'] == "Chile"? "selected" : "" ); ?> > Chile</option>
                                <option value="China" <?php echo ($row['country'] == "China"? "selected" : "" ); ?> > China</option>
                                <option value="Cidade do Vaticano" <?php echo ($row['country'] == "Cidade do Vaticano"? "selected" : "" ); ?> > Cidade do Vaticano</option>
                                <option value="Colômbia" <?php echo ($row['country'] == "Colômbia"? "selected" : "" ); ?> > Colômbia</option>
                                <option value="Congo" <?php echo ($row['country'] == "Congo"? "selected" : "" ); ?> > Congo</option>
                                <option value="Coréia do Sul" <?php echo ($row['country'] == "Coréia do Sul"? "selected" : "" ); ?> > Coréia do Sul</option>
                                <option value="Costa do Marfim" <?php echo ($row['country'] == "Costa do Marfim"? "selected" : "" ); ?> > Costa do Marfim</option>
                                <option value="Costa Rica" <?php echo ($row['country'] == "Costa Rica"? "selected" : "" ); ?> > Costa Rica</option>
                                <option value="Croácia" <?php echo ($row['country'] == "Croácia"? "selected" : "" ); ?> > Croácia</option>
                                <option value="Dinamarca" <?php echo ($row['country'] == "Dinamarca"? "selected" : "" ); ?> > Dinamarca</option>
                                <option value="Djibuti" <?php echo ($row['country'] == "Djibuti"? "selected" : "" ); ?> > Djibuti</option>
                                <option value="Dominica" <?php echo ($row['country'] == "Dominica"? "selected" : "" ); ?> > Dominica</option>
                                <option value="EUA" <?php echo ($row['country'] == "EUA"? "selected" : "" ); ?> > EUA</option>
                                <option value="Egito" <?php echo ($row['country'] == "Egito"? "selected" : "" ); ?> > Egito</option>
                                <option value="El Salvador" <?php echo ($row['country'] == "El Salvador"? "selected" : "" ); ?> > El Salvador</option>
                                <option value="Emirados Árabes" <?php echo ($row['country'] == "Emirados Árabes"? "selected" : "" ); ?> > Emirados Árabes</option>
                                <option value="Equador" <?php echo ($row['country'] == "Equador"? "selected" : "" ); ?> > Equador</option>
                                <option value="Eritréia" <?php echo ($row['country'] == "Eritréia"? "selected" : "" ); ?> > Eritréia</option>
                                <option value="Escócia" <?php echo ($row['country'] == "Escócia"? "selected" : "" ); ?> > Escócia</option>
                                <option value="Eslováquia" <?php echo ($row['country'] == "Eslováquia"? "selected" : "" ); ?> > Eslováquia</option>
                                <option value="Eslovênia" <?php echo ($row['country'] == "Eslovênia"? "selected" : "" ); ?> > Eslovênia</option>
                                <option value="Espanha" <?php echo ($row['country'] == "Espanha"? "selected" : "" ); ?> > Espanha</option>
                                <option value="Estônia" <?php echo ($row['country'] == "Estônia"? "selected" : "" ); ?> > Estônia</option>
                                <option value="Etiópia" <?php echo ($row['country'] == "Etiópia"? "selected" : "" ); ?> > Etiópia</option>
                                <option value="Fiji" <?php echo ($row['country'] == "Fiji"? "selected" : "" ); ?> > Fiji</option>
                                <option value="Filipinas" <?php echo ($row['country'] == "Filipinas"? "selected" : "" ); ?> > Filipinas</option>
                                <option value="Finlândia" <?php echo ($row['country'] == "Finlândia"? "selected" : "" ); ?> > Finlândia</option>
                                <option value="França" <?php echo ($row['country'] == "França"? "selected" : "" ); ?> > França</option>
                                <option value="Gabão" <?php echo ($row['country'] == "Gabão"? "selected" : "" ); ?> > Gabão</option>
                                <option value="Gâmbia" <?php echo ($row['country'] == "Gâmbia"? "selected" : "" ); ?> > Gâmbia</option>
                                <option value="Gana" <?php echo ($row['country'] == "Gana"? "selected" : "" ); ?> > Gana</option>
                                <option value="Geórgia" <?php echo ($row['country'] == "Geórgia"? "selected" : "" ); ?> > Geórgia</option>
                                <option value="Gibraltar" <?php echo ($row['country'] == "Gibraltar"? "selected" : "" ); ?> > Gibraltar</option>
                                <option value="Granada" <?php echo ($row['country'] == "Granada"? "selected" : "" ); ?> > Granada</option>
                                <option value="Grécia" <?php echo ($row['country'] == "Grécia"? "selected" : "" ); ?> > Grécia</option>
                                <option value="Guadalupe" <?php echo ($row['country'] == "Guadalupe"? "selected" : "" ); ?> > Guadalupe</option>
                                <option value="Guam" <?php echo ($row['country'] == "Guam"? "selected" : "" ); ?> > Guam</option>
                                <option value="Guatemala" <?php echo ($row['country'] == "Guatemala"? "selected" : "" ); ?> > Guatemala</option>
                                <option value="Guiana" <?php echo ($row['country'] == "Guiana"? "selected" : "" ); ?> > Guiana</option>
                                <option value="Guiana Francesa" <?php echo ($row['country'] == "Guiana Francesa"? "selected" : "" ); ?> > Guiana Francesa</option>
                                <option value="Guiné-bissau" <?php echo ($row['country'] == "Guiné-bissau"? "selected" : "" ); ?> > Guiné-bissau</option>
                                <option value="Haiti" <?php echo ($row['country'] == "Haiti"? "selected" : "" ); ?> > Haiti</option>
                                <option value="Holanda" <?php echo ($row['country'] == "Holanda"? "selected" : "" ); ?> > Holanda</option>
                                <option value="Honduras" <?php echo ($row['country'] == "Honduras"? "selected" : "" ); ?> > Honduras</option>
                                <option value="Hong Kong" <?php echo ($row['country'] == "Hong Kong"? "selected" : "" ); ?> > Hong Kong</option>
                                <option value="Hungria" <?php echo ($row['country'] == "Hungria"? "selected" : "" ); ?> > Hungria</option>
                                <option value="Iêmen" <?php echo ($row['country'] == "Iêmen"? "selected" : "" ); ?> > Iêmen</option>
                                <option value="Ilhas Cayman" <?php echo ($row['country'] == "Ilhas Cayman"? "selected" : "" ); ?> > Ilhas Cayman</option>
                                <option value="Ilhas Cook" <?php echo ($row['country'] == "Ilhas Cook"? "selected" : "" ); ?> > Ilhas Cook</option>
                                <option value="Ilhas Curaçao" <?php echo ($row['country'] == "Ilhas Curaçao"? "selected" : "" ); ?> > Ilhas Curaçao</option>
                                <option value="Ilhas Marshall" <?php echo ($row['country'] == "Ilhas Marshall"? "selected" : "" ); ?> > Ilhas Marshall</option>
                                <option value="Ilhas Turks & Caicos" <?php echo ($row['country'] == "Ilhas Turks & Caicos"? "selected" : "" ); ?> > Ilhas Turks & Caicos</option>
                                <option value="Ilhas Virgens (brit.)" <?php echo ($row['country'] == "Ilhas Virgens (brit.)"? "selected" : "" ); ?> > Ilhas Virgens (brit.)</option>
                                <option value="Ilhas Virgens(amer.)" <?php echo ($row['country'] == "Ilhas Virgens(amer.)"? "selected" : "" ); ?> > Ilhas Virgens(amer.)</option>
                                <option value="Ilhas Wallis e Futuna" <?php echo ($row['country'] == "Ilhas Wallis e Futuna"? "selected" : "" ); ?> > Ilhas Wallis e Futuna</option>
                                <option value="Índia" <?php echo ($row['country'] == "Índia"? "selected" : "" ); ?> > Índia</option>
                                <option value="Indonésia" <?php echo ($row['country'] == "Indonésia"? "selected" : "" ); ?> > Indonésia</option>
                                <option value="Inglaterra" <?php echo ($row['country'] == "Inglaterra"? "selected" : "" ); ?> > Inglaterra</option>
                                <option value="Irlanda" <?php echo ($row['country'] == "Irlanda"? "selected" : "" ); ?> > Irlanda</option>
                                <option value="Islândia" <?php echo ($row['country'] == "Islândia"? "selected" : "" ); ?> > Islândia</option>
                                <option value="Israel" <?php echo ($row['country'] == "Israel"? "selected" : "" ); ?> > Israel</option>
                                <option value="Itália" <?php echo ($row['country'] == "Itália"? "selected" : "" ); ?> > Itália</option>
                                <option value="Jamaica" <?php echo ($row['country'] == "Jamaica"? "selected" : "" ); ?> > Jamaica</option>
                                <option value="Japão" <?php echo ($row['country'] == "Japão"? "selected" : "" ); ?> > Japão</option>
                                <option value="Jordânia" <?php echo ($row['country'] == "Jordânia"? "selected" : "" ); ?> > Jordânia</option>
                                <option value="Kuwait" <?php echo ($row['country'] == "Kuwait"? "selected" : "" ); ?> > Kuwait</option>
                                <option value="Latvia" <?php echo ($row['country'] == "Latvia"? "selected" : "" ); ?> > Latvia</option>
                                <option value="Líbano" <?php echo ($row['country'] == "Líbano"? "selected" : "" ); ?> > Líbano</option>
                                <option value="Liechtenstein" <?php echo ($row['country'] == "Liechtenstein"? "selected" : "" ); ?> > Liechtenstein</option>
                                <option value="Lituânia" <?php echo ($row['country'] == "Lituânia"? "selected" : "" ); ?> > Lituânia</option>
                                <option value="Luxemburgo" <?php echo ($row['country'] == "Luxemburgo"? "selected" : "" ); ?> > Luxemburgo</option>
                                <option value="Macau" <?php echo ($row['country'] == "Macau"? "selected" : "" ); ?> > Macau</option>
                                <option value="Macedônia" <?php echo ($row['country'] == "Macedônia"? "selected" : "" ); ?> > Macedônia</option>
                                <option value="Madagascar" <?php echo ($row['country'] == "Madagascar"? "selected" : "" ); ?> > Madagascar</option>
                                <option value="Malásia" <?php echo ($row['country'] == "Malásia"? "selected" : "" ); ?> > Malásia</option>
                                <option value="Malaui" <?php echo ($row['country'] == "Malaui"? "selected" : "" ); ?> > Malaui</option>
                                <option value="Mali" <?php echo ($row['country'] == "Mali"? "selected" : "" ); ?> > Mali</option>
                                <option value="Malta" <?php echo ($row['country'] == "Malta"? "selected" : "" ); ?> > Malta</option>
                                <option value="Marrocos" <?php echo ($row['country'] == "Marrocos"? "selected" : "" ); ?> > Marrocos</option>
                                <option value="Martinica" <?php echo ($row['country'] == "Martinica"? "selected" : "" ); ?> > Martinica</option>
                                <option value="Mauritânia" <?php echo ($row['country'] == "Mauritânia"? "selected" : "" ); ?> > Mauritânia</option>
                                <option value="Mauritius" <?php echo ($row['country'] == "Mauritius"? "selected" : "" ); ?> > Mauritius</option>
                                <option value="México" <?php echo ($row['country'] == "México"? "selected" : "" ); ?> > México</option>
                                <option value="Moldova" <?php echo ($row['country'] == "Moldova"? "selected" : "" ); ?> > Moldova</option>
                                <option value="Mônaco" <?php echo ($row['country'] == "Mônaco"? "selected" : "" ); ?> > Mônaco</option>
                                <option value="Montserrat" <?php echo ($row['country'] == "Montserrat"? "selected" : "" ); ?> > Montserrat</option>
                                <option value="Nepal" <?php echo ($row['country'] == "Nepal"? "selected" : "" ); ?> > Nepal</option>
                                <option value="Nicarágua" <?php echo ($row['country'] == "Nicarágua"? "selected" : "" ); ?> > Nicarágua</option>
                                <option value="Niger" <?php echo ($row['country'] == "Niger"? "selected" : "" ); ?> > Niger</option>
                                <option value="Nigéria" <?php echo ($row['country'] == "Nigéria"? "selected" : "" ); ?> > Nigéria</option>
                                <option value="Noruega" <?php echo ($row['country'] == "Noruega"? "selected" : "" ); ?> > Noruega</option>
                                <option value="Nova Caledônia" <?php echo ($row['country'] == "Nova Caledônia"? "selected" : "" ); ?> > Nova Caledônia</option>
                                <option value="Nova Zelândia" <?php echo ($row['country'] == "Nova Zelândia"? "selected" : "" ); ?> > Nova Zelândia</option>
                                <option value="Omã" <?php echo ($row['country'] == "Omã"? "selected" : "" ); ?> > Omã</option>
                                <option value="Palau" <?php echo ($row['country'] == "Palau"? "selected" : "" ); ?> > Palau</option>
                                <option value="Panamá" <?php echo ($row['country'] == "Panamá"? "selected" : "" ); ?> > Panamá</option>
                                <option value="Papua-nova Guiné" <?php echo ($row['country'] == "Papua-nova Guiné"? "selected" : "" ); ?> > Papua-nova Guiné</option>
                                <option value="Paquistão" <?php echo ($row['country'] == "Paquistão"? "selected" : "" ); ?> > Paquistão</option>
                                <option value="Peru" <?php echo ($row['country'] == "Peru"? "selected" : "" ); ?> > Peru</option>
                                <option value="Polinésia Francesa" <?php echo ($row['country'] == "Polinésia Francesa"? "selected" : "" ); ?> > Polinésia Francesa</option>
                                <option value="Polônia" <?php echo ($row['country'] == "Polônia"? "selected" : "" ); ?> > Polônia</option>
                                <option value="Porto Rico" <?php echo ($row['country'] == "Porto Rico"? "selected" : "" ); ?> > Porto Rico</option>
                                <option value="Portugal" <?php echo ($row['country'] == "Portugal"? "selected" : "" ); ?> > Portugal</option>
                                <option value="Qatar" <?php echo ($row['country'] == "Qatar"? "selected" : "" ); ?> > Qatar</option>
                                <option value="Quênia" <?php echo ($row['country'] == "Quênia"? "selected" : "" ); ?> > Quênia</option>
                                <option value="Rep. Dominicana" <?php echo ($row['country'] == "Rep. Dominicana"? "selected" : "" ); ?> > Rep. Dominicana</option>
                                <option value="Rep. Tcheca" <?php echo ($row['country'] == "Rep. Tcheca"? "selected" : "" ); ?> > Rep. Tcheca</option>
                                <option value="Reunion" <?php echo ($row['country'] == "Reunion"? "selected" : "" ); ?> > Reunion</option>
                                <option value="Romênia" <?php echo ($row['country'] == "Romênia"? "selected" : "" ); ?> > Romênia</option>
                                <option value="Ruanda" <?php echo ($row['country'] == "Ruanda"? "selected" : "" ); ?> > Ruanda</option>
                                <option value="Rússia" <?php echo ($row['country'] == "Rússia"? "selected" : "" ); ?> > Rússia</option>
                                <option value="Saipan" <?php echo ($row['country'] == "Saipan"? "selected" : "" ); ?> > Saipan</option>
                                <option value="Samoa Americana" <?php echo ($row['country'] == "Samoa Americana"? "selected" : "" ); ?> > Samoa Americana</option>
                                <option value="Senegal" <?php echo ($row['country'] == "Senegal"? "selected" : "" ); ?> > Senegal</option>
                                <option value="Serra Leone" <?php echo ($row['country'] == "Serra Leone"? "selected" : "" ); ?> > Serra Leone</option>
                                <option value="Seychelles" <?php echo ($row['country'] == "Seychelles"? "selected" : "" ); ?> > Seychelles</option>
                                <option value="Singapura" <?php echo ($row['country'] == "Singapura"? "selected" : "" ); ?> > Singapura</option>
                                <option value="Síria" <?php echo ($row['country'] == "Síria"? "selected" : "" ); ?> > Síria</option>
                                <option value="Sri Lanka" <?php echo ($row['country'] == "Sri Lanka"? "selected" : "" ); ?> > Sri Lanka</option>
                                <option value="St. Kitts & Nevis" <?php echo ($row['country'] == "St. Kitts & Nevis"? "selected" : "" ); ?> > St. Kitts & Nevis</option>
                                <option value="St. Lúcia" <?php echo ($row['country'] == "St. Lúcia"? "selected" : "" ); ?> > St. Lúcia</option>
                                <option value="St. Vincent" <?php echo ($row['country'] == "St. Vincent"? "selected" : "" ); ?> > St. Vincent</option>
                                <option value="Sudão" <?php echo ($row['country'] == "Sudão"? "selected" : "" ); ?> > Sudão</option>
                                <option value="Suécia" <?php echo ($row['country'] == "Suécia"? "selected" : "" ); ?> > Suécia</option>
                                <option value="Suiça" <?php echo ($row['country'] == "Suiça"? "selected" : "" ); ?> > Suiça</option>
                                <option value="Suriname" <?php echo ($row['country'] == "Suriname"? "selected" : "" ); ?> > Suriname</option>
                                <option value="Tailândia" <?php echo ($row['country'] == "Tailândia"? "selected" : "" ); ?> > Tailândia</option>
                                <option value="Taiwan" <?php echo ($row['country'] == "Taiwan"? "selected" : "" ); ?> > Taiwan</option>
                                <option value="Tanzânia" <?php echo ($row['country'] == "Tanzânia"? "selected" : "" ); ?> > Tanzânia</option>
                                <option value="Togo" <?php echo ($row['country'] == "Togo"? "selected" : "" ); ?> > Togo</option>
                                <option value="Trinidad & Tobago" <?php echo ($row['country'] == "Trinidad & Tobago"? "selected" : "" ); ?> > Trinidad & Tobago</option>
                                <option value="Tunísia" <?php echo ($row['country'] == "Tunísia"? "selected" : "" ); ?> > Tunísia</option>
                                <option value="Turquia" <?php echo ($row['country'] == "Turquia"? "selected" : "" ); ?> > Turquia</option>
                                <option value="Ucrânia" <?php echo ($row['country'] == "Ucrânia"? "selected" : "" ); ?> > Ucrânia</option>
                                <option value="Uganda" <?php echo ($row['country'] == "Uganda"? "selected" : "" ); ?> > Uganda</option>
                                <option value="Uruguai" <?php echo ($row['country'] == "Uruguai"? "selected" : "" ); ?> > Uruguai</option>
                                <option value="Venezuela" <?php echo ($row['country'] == "Venezuela"? "selected" : "" ); ?> > Venezuela</option>
                                <option value="Vietnã" <?php echo ($row['country'] == "Vietnã"? "selected" : "" ); ?> > Vietnã</option>
                                <option value="Zaire" <?php echo ($row['country'] == "Zaire"? "selected" : "" ); ?> > Zaire</option>
                                <option value="Zâmbia" <?php echo ($row['country'] == "Zâmbia"? "selected" : "" ); ?> > Zâmbia</option>
                                <option value="Zimbábue" <?php echo ($row['country'] == "Zimbábue"? "selected" : "" ); ?> > Zimbábue</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Text area -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Comentários </label>
                    <div class="col-md-6  inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                            <textarea class="form-control" name="comments" placeholder="Notas "><?php echo $row['comments']; ?></textarea>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <br>
                <div class="form-group row">
                    <div class="col-md-5">
                    </div>
                    <div class="col-md-7"> 
                        <button type="submit" class="btn btn-primary" id = "submit"><span class="glyphicon glyphicon-save"></span> Gravar </button>
                        <button type="reset" class="btn" value="Reset"><span class="glyphicon glyphicon-refresh"></span> Limpar alterações </button>
                        <button type="button" class="btn btn-success" value="voltar" id="voltar"><span class="glyphicon glyphicon-repeat"></span> Voltar </button>
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
                        <h4>Utilizador actualizado com sucesso.</h4>
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

<script type="text/javascript">
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
                username: {
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
            url:"users/saveedituser.php",  
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
    
    /*
    $(document).on('click', '#modal-btn', function(e){
        window.location.href="manageusers.php"; 
    });
    */

    $(document).on('click', '#voltar', function(e){
        Back();
    });

    $("#myModal").on('hide.bs.modal', function(){
        Back();
    });

    function Back() {
        window.location.href="users/manageusers.php"; 
    }
    
    
</script>


<?php include('../footer.php'); ?>