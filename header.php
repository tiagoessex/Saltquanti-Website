<?php require_once 'settings/config.php'; ?>
<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    // If session variables are not set 
    if(!isset($_SESSION['username']) || empty($_SESSION['username'])) 
    {
      $isLogIn = false;
      include('login.php');      
    } else {
      $isLogIn = true;    
      if (isset($_SESSION['username'])) 
      {
        if (isset($_SESSION['admin']) && $_SESSION['admin'] != 0)
        {
          $admin = true;
        } else {
          $admin = false;
        }
      }    
    }    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Saltquanti</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <base href="<?php echo DOMAIN_URL; ?>"><!--[if lte IE 6]></base><![endif]-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/main.css" type="text/css" />
    <link rel="stylesheet" href="css/navbar.css" type="text/css" />
    <link rel="stylesheet" href="css/forms.css" type="text/css" />
    <link rel="stylesheet" href="css/tables.css" type="text/css" />
    <link rel="stylesheet" href="css/print.css" type="text/css" />
    <link rel="stylesheet" href="css/position.css" type="text/css" />
    <link rel="stylesheet" href="css/input.css" type="text/css" />
    <link rel="stylesheet" href="css/validation.css" type="text/css" />
    <link rel="stylesheet" href="css/modals.css" type="text/css" />
    <link rel="stylesheet" href="css/datatable.css" type="text/css" />
    <link rel="stylesheet" href="css/separators.css" type="text/css" />
    <link rel="stylesheet" href="css/buttons.css" type="text/css" />
    <link rel="stylesheet" href="css/news.css" type="text/css" />
    <link rel="stylesheet" href="css/spinner.css" type="text/css" />
    <link rel="stylesheet" href="css/login.css" type="text/css" />

    <!-- LOADING BAR -->
    <link rel='stylesheet' href='css/nprogress.css' />

    <!-- FONTS FOR ALL SITE -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <!-- JQUERY DATATABLES -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/datatables.min.css" />

    <!-- JQUERY JSTREE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

    <!-- PROGRESS BAR -->
    <script src='external/nprogress.js'></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // if nav items loads new page, then this function ensures that
            // that the corrected item is mark as active.
            var url = window.location;
            $('ul.nav a[href="' + url + '"]').parent().addClass('active');
            $('ul.nav a').filter(function() {
                return this.href == url;
            }).parent().addClass('active');

            // drop menu on hover
            $('ul.nav li.dropdown').hover(function() {
                if (!$('.navbar-toggle').is(':visible')) {
                    $(this).toggleClass('open', true);
                }
            }, function() {
                if (!$('.navbar-toggle').is(':visible')) {
                    $(this).toggleClass('open', false);
                }
            });
            $('ul.nav li.dropdown a').click(function() {
                if (!$('.navbar-toggle').is(':visible') && $(this).attr('href') != '#') {
                    $(this).toggleClass('open', false);
                    window.location = $(this).attr('href')
                }
            });

        });

        // handles the logout event
        function LogOut() {
            $.ajax({
                url: 'logout.php',
                complete: function(response) {
                    // replace => no warning messages and
                    // no resubmission issues
                    window.location.replace(window.location.href);
                },
                error: function() {
                }
            });
            return false;
        }
        
        $( document ).ajaxStart(function() {
           NProgress.start();
        });

        $( document ).ajaxStop(function() {
            NProgress.done();  
        });
        
    </script>
</head>

<body style="font-family: 'Roboto', sans-serif;">

    <!-- NAV MENU -->
    <nav class="navbar navbar-default navbar-fixed-top title-style">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" rel="home" href="https://saltquanti.eu/" title="Saltquanti">
                    <img style="max-width:120px; margin-top: -13px;" src="images/logo.png"></a>
            </div>
            <!-- END HEADER -->

            <!-- MENU -->
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a class="dropdown-toggle public" data-toggle="dropdown" href="index.php"> <span class="glyphicon glyphicon-blackboard"></span> PROJETO
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php#presentation"><span class="glyphicon glyphicon-blackboard"></span> Apresentação</a></li>
                            <li><a href="index.php#goals"><span class="glyphicon glyphicon-screenshot"></span> Objetivos</a></li>
                            <li><a href="index.php#sponsors"><span class="glyphicon glyphicon-link"></span> Consórcio</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle public" data-toggle="dropdown" href="team/team.php"><span class="glyphicon glyphicon-user"></span> EQUIPA
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="team/team.php#presentation"><span class="glyphicon glyphicon-briefcase"></span> EVOLEO</a></li>
                            <li><a href="team/team.php#fcnaup"><span class="glyphicon glyphicon-glass"></span> FCNAUP</a></li>
                            <li><a href="team/team.php#feup"><span class="glyphicon glyphicon-wrench"></span> FEUP</a></li>

                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle public" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-briefcase"></span> RECURSOS
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="materials/materials.php"><span class="glyphicon glyphicon-cog"></span> Materiais Formativos e Educativos</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle public" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-globe"></span> NOTICIAS
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="news/news.php"><span class="glyphicon glyphicon-folder-open"></span> Arquivo</a></li>
                            <li><a href="midia/midia.php"><span class="glyphicon glyphicon-picture"></span> Mídia</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle public" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-calendar"></span> EVENTOS
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="events/futureevents.php"><span class="glyphicon glyphicon-eye-open"></span> Eventos Futuros</a></li>
                            <li><a href="events/pastevents.php"><span class="glyphicon glyphicon-eye-close"></span> Eventos Passados</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="contacts.php" class="public"><span class="glyphicon glyphicon-book"></span> CONTACTOS</a>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle public" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-hdd"></span> BASE DE DADOS
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="dbconsult/consultglobal.php"><span class="glyphicon glyphicon-search"></span> Pesquisa Geral</a></li>
                            <li><a href="dbconsult/consultalpha.php"><span class="glyphicon glyphicon-search"></span> Pesquisa Alfabética</a></li>
                            <li><a href="dbconsult/consultcat.php"><span class="glyphicon glyphicon-search"></span> Pesquisa Por Categoria</a></li>
                            <li class="divider"></li>
                            <li><a href="graphs/graphs.php"><span class="glyphicon glyphicon-stats"></span> Gráficos</a></li>
                            <li class="divider"></li>
                            <li><a href="database/exportallproducts.php"><span class="glyphicon glyphicon-upload"></span> Exportar Tudo</a></li>
                        </ul>
                    </li>

                    <li class="dropdown <?php echo ($isLogIn) ? 'visible' : 'hidden'; ?>">
                        <a class="dropdown-toggle private" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-wrench"></span> GESTÃO
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <li><a href="database/newproduct.php" class="private"><span class="glyphicon glyphicon-plus"></span> Novo Produto</a></li>
                            <li><a href="database/import.php" class="private"><span class="glyphicon glyphicon-download"></span> Importar Ficheiro</a></li>

                            <li><a href="database/manageproducts.php" class="private <?php echo ($isLogIn && $admin) ? 'visible' : 'hidden'; ?>"><span class="glyphicon glyphicon-pencil"></span> Gerir Produtos</a></li>
                            <li><a href="database/validateproducts.php" class="private <?php echo ($isLogIn && $admin) ? 'visible' : 'hidden'; ?>"><span class="glyphicon glyphicon-check"></span> Validação Pendentes de Produtos</a></li>
                            <li class="divider <?php echo ($isLogIn && $admin) ? 'visible' : 'hidden'; ?>"></li>
                            <li><a href="users/newuser.php" class="private <?php echo ($isLogIn && $admin) ? 'visible' : 'hidden'; ?>"><span class="glyphicon glyphicon-plus"></span> Novo Utilizador</a></li>
                            <li><a href="users/manageusers.php" class="private <?php echo ($isLogIn && $admin) ? 'visible' : 'hidden'; ?>"><span class="glyphicon glyphicon-pencil"></span> Gerir Utilizadores</a></li>
                            <li><a href="users/validateusers.php" class="private <?php echo ($isLogIn && $admin) ? 'visible' : 'hidden'; ?>"><span class="glyphicon glyphicon-check"></span> Validação Pendentes de Utilizadores</a></li>
                            <li class="divider <?php echo ($isLogIn && $admin) ? 'visible' : 'hidden'; ?>"></li>
                            <li><a href="settings/settings.php" class="private <?php echo ($isLogIn && $admin) ? 'visible' : 'hidden'; ?>"><span class="glyphicon glyphicon-cog"></span> Configuração</a></li>
                        </ul>
                    </li>

                    <li class="dropdown <?php echo ($isLogIn) ? 'visible' : 'hidden'; ?>">
                        <a class="dropdown-toggle private" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-off private"></span>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="users/myaccount.php" class="private"><span class="glyphicon glyphicon-user"></span> A minha conta</a></li>
                            <li><a href="" onclick="LogOut();" style="color:#ff3300;"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
                        </ul>
                    </li>

                    <li class="<?php echo ($isLogIn) ? 'hidden' : 'visible'; ?>">
                        <a href="#" data-toggle="modal" data-target="#login-modal" class="public"><span class="glyphicon glyphicon-log-in"></span> ENTRAR</a>
                    </li>

                </ul>

            </div>
            <!-- END MENU -->
        </div>
    </nav>
    <!-- END NAV -->

    <!-- LOGIN MODAL -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="loginmodal-container">
                <h1>Insira as suas credenciais</h1>
                <br>
                <form action="" method="post">
                    <input type="text" name="username" id="username" placeholder="Utilizador">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <input type="submit" name="login" class="login loginmodal-submit" value="Entrar">
                </form>

                <div class="login-help">
                    <a href="users/newuserreg.php">Resgistrar-se</a> - <a href="mailto:info@evoleotech.com?subject=forgotpassword">Esqueçeu-se da password?</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END LOGIN MODAL -->