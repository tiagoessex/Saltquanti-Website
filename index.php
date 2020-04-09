<?php include('header.php'); ?>


    <link rel="stylesheet" href="css/tables2.css" type="text/css" />
    <link rel="stylesheet" href="css/groupbuttons.css" type="text/css" />

    <div class="container below-nav news-big">

        <!-- CAROUSEL -->
        <div class="row">
            <div class="col-sm-12">
                <div id="myCarousel" class="carousel slide text-center" data-ride="carousel" data-interval="3500">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="img-responsive center-block" src="images/carrossel_1.png" alt="saltquanti_1">
                        </div>

                        <div class="item">
                            <img class="img-responsive center-block" src="images/carrossel_2.png" alt="saltquanti_2">
                        </div>

                        <div class="item">
                            <img class="img-responsive center-block" src="images/carrossel_3.png" alt="saltquanti_3">
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Seguinte</span>
                    </a>
                </div>
            </div>
        </div>
        <!--  END CAROUSEL -->

        <!-- NAVIGATION BUTTONS -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group btn-group-justified">
                    <a href="#presentation" class="btn btn-lg gp_button title-style">APRESENTAÇÃO</a>
                    <a href="#goals" class="btn btn-lg gp_button title-style">OBJETIVOS</a>
                    <a href="#sponsors" class="btn btn-lg gp_button title-style">CONSÓRCIO</a>
                </div>
            </div>
        </div>
        <!-- END NAVIGATION BUTTONS -->

        <!-- CONTENT -->

        <!-- FIRST SECTION - PRESENTATION -->
        <div id="presentation">

            <br>
            <br>
            <br>

            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 text-justify">

                    <h1 class="title-style text-center">Apresentação</h1>

                    <br>

                    <p>
                        <a href="https://saltquanti.eu/">SALT QUANTI</a> - Demonstração de dispositivo portátil para aquisição e processamento de dados para determinação do teor de sal em alimentos
                    </p>

                    <br>

                    <p>
                        Atualmente, o consumo excessivo de sal é uma preocupação a nível de Saúde Pública, contribuindo para o desenvolvimento de hipertensão arterial e o aumento da morbilidade e mortalidade por doenças cardiovasculares<sup><a href="#b1">1</a></sup>.
                    </p>
                    <p>
                        Nos países industrializados, as principais fontes de sal ingerido são os alimentos processados e o sal adicionado na confeção de alimentos consumidos fora de casa<sup><a href="#b2">2</a></sup>.
                    </p>
                    <p>
                        Em Portugal, as doenças cardiovasculares constituem a maior causa de morte<sup><a href="#b3">3</a></sup> e o consumo diário de sal, <i>per capita</i>, é superior ao dobro da<sup><a href="#b1">1</a></sup> quantidade máxima recomendada pela <a href="http://www.who.int/">Organização Mundial de Saúde</a> (OMS) de 5 gramas por dia<sup><a href="#b4">4</a></sup>.
                    </p>
                    <p>
                        Como preconizado pela OMS, diversos países, incluindo Portugal, estão a implementar estratégias para reduzir a ingestão de sal, salientando-se a importância do seu controlo nas refeições disponibilizadas pelo setor da alimentação coletiva e restauração<sup><a href="#b5">5</a></sup>.
                    </p>
                    <p>
                        Assim, é urgente introduzir no mercado mecanismos que permitam a quantificação e monitorização do teor de sal nos alimentos confecionados<sup><a href="#b6">6</a>,<a href="#b7">7</a></sup>. As principais técnicas e equipamentos existentes apresentam limitações, tais como: a falta de portabilidade, o elevado tempo de medição e a impossibilidade de analisar matrizes alimentares complexas (alimentos e refeições)<sup><a href="#b7">7</a></sup>.
                    </p>
                    <p>
                        Como resposta às necessidades do contexto atual, surge o projeto SALT QUANTI, que visa desenvolver e demonstrar a aplicação de um equipamento rápido, portátil e fácil de utilizar para a medir o teor de sal em alimentos, em ambiente real, isto é, cozinhas.
                    </p>
                    <p>
                        A partir de um protótipo laboratorial inovador criado em 2016<sup><a href="#b7">7</a></sup>, produzir-se-á um equipamento completo e com aplicação industrial e comercial, em contextos como cantinas escolares, empresas de restauração coletiva, estabelecimentos de saúde e autoridades de fiscalização.
                    </p>

                    <br>
                    <br>
                    <br>

                    <div style="font-size: 0.8em">
                        <ol>
                            <div id="b1">
                                <li>
                                    Polonia J, Martins L, Pinto F, Nazare J. Prevalence, awareness, treatment and control of hypertension and salt intake in Portugal: Changes over a decade the PHYSA study. J Hypertens. 2014;32(6):1211–21.
                                </li>
                            </div>
                            <div id="b2">
                                <li>
                                    World Health Organisation Forum on Reducing Salt Intake in Populations. Reducing salt intake in populations : Reducing salt intake in populations: a report of a WHO forum and technical meeting 5–7 October 2006, Paris, France. Geneva; 2007.
                                </li>
                            </div>
                            <div id="b3">
                                <li>
                                    Programa Nacional para as Doenças Cérebo-Cardiovasculares. Programa Nacional para as Doenças Cérebro-Cardiovasculares 2017. Lisboa; 2017.
                                </li>
                            </div>
                            <div id="b4">
                                <li>
                                    World Health Organization. Guideline: Sodium intake for adults and children. Geneva; 2012.
                                </li>
                            </div>
                            <div id="b5">
                                <li>
                                    Direção Geral de Saúde, Programa Nacional para a Promoção da Alimentação Saudável. Proposta de Estratégia para a redução do consumo de sal na população portuguesa através da modificação da disponibilidade da oferta. 2015. p. 2.
                                </li>
                            </div>
                            <div id="b6">
                                <li>
                                    World Health Organization. Creating an enabling environment for population-based salt reduction strategies: report of a joint technical meeting held by WHO and the Food Standards Agency. World Health Organization. Geneva; 2010.
                                </li>
                            </div>
                            <div id="b7">
                                <li>
                                    Gonçalves C. Salt intake by children and adolescents - Contribute to salt reduction strategy. Dissertação de Doutoramento em Ciências do Consumo Alimentar e Nutrição apresentada à Faculdade de Ciências da Nutrição e Alimentação e Faculdade de Ciências da Universidade . Faculdade de Ciências da Nutrição e Alimentação da Universidade do Porto; 2015.
                                </li>
                            </div>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- END FIRST SECTION - PRESENTATION -->

        <!-- SECOND SECTION - GOALS -->
        <div id="goals"></div>
        <br>
        <br>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 text-justify">

                <h1 class="title-style text-center">Objetivos</h1>

                <br>
                <p>
                    Os objetivos do Projeto são:
                </p>
                <ul>
                    <li>Desenvolver e validar um equipamento com todas as funcionalidades integradas, fiável, portátil e de fácil e rápida utilização para analisar o teor de sódio (sal), em matrizes alimentares complexas, através da metodologia analítica de Potenciometria por Elétrodo Seletivo de Ião (ISE).</li>
                    <li>Demonstrar a aplicação do equipamento pronto a ser utilizado por profissionais na medição do teor de sal <i>in loco</i> (cozinhas) em 4 vertentes estratégicas no contexto nacional:</li>
                </ul>

                <br>

                <table class="table borderless">
                    <tbody>
                        <tr>
                            <td> <img src="images/schools.png" alt="school" style="width:64px;height:64px;"></td>
                            <td style="vertical-align: middle;font-weight: bolder;">ESCOLAS
                                <br><span style="font-size:0.8em;font-weight: normal;">Direção Geral de Educação (DGE)</span></td>
                            <td> <img src="images/health.png" alt="school" style="width:64px;height:64px;"></td>
                            <td style="vertical-align: middle;font-weight: bolder;">ESTABELECIMENTOS DE SAÚDE
                                <br><span style="font-size:0.8em;font-weight: normal;">Unidades de Administração Regional de Saúde (ARS)</span></td>
                        </tr>
                        <tr>
                            <td> <img src="images/authority.png" alt="school" style="width:64px;height:64px;"></td>
                            <td style="vertical-align: middle;font-weight: bolder;">AUTORIDADES DE DISCALIZAÇÃO
                                <br><span style="font-size:0.8em;font-weight: normal;">Autoridade de Segurança Alimentar e Económica (XXX)</span></td>
                            <td> <img src="images/food.png" alt="school" style="width:64px;height:64px;"></td>
                            <td style="vertical-align: middle;font-weight: bolder;">EMPRESAS DE RESTAURAÇÃO COLETIVA</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- END SECOND SECTION - GOALS -->

        <!-- THRID SECTION - SPONSORS/PARTNERS -->
        <div id="sponsors"></div>
        <br>
        <br>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 text-justify">

                <h1 class="title-style text-center">Consórcio</h1>
                <br>

                <p>
                    O Projeto <a href="https://saltquanti.eu/">SALT QUANTI</a>, é um projeto Demonstrador em Co-promoção, financiado pelo Sistema de Incentivos à Investigação e Desenvolvimento Tecnológico - SI I&DT- (PORTUGAL2020 e NORTE 2020) e promovido pelo consórcio constituído pela <a href="http://evoleotech.com/">EVOLEO Technologies</a> (promotor-líder) e a Universidade do Porto (Co-Promotor), através da <a href="https://sigarra.up.pt/fcnaup/pt/web_page.inicial">Faculdade de Ciências da Nutrição e Alimentação</a> (FCNAUP) e da <a href="https://sigarra.up.pt/feup/pt/web_page.inicial">Faculdade de Engenharia</a> (FEUP).
                </p>

                <br>
                <h2 class="title-style">Entidade financiadora</h2>
                <br>

                <img src="images/ANI_2020.png" alt="Apoios" style="width:100%;">

                <br>
                <br>
                <h2 class="title-style">Entidade promotora</h2>
                <br>

                <div class="row">
                    <div class="col-sm-6">
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <a href="http://evoleotech.com/" target="_blank">
                            <img src="images/logo_evoleo.png" alt="EVOLEO Technologies" style="width:90%;" class="img-responsive center-block">
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <p>
                            A EVOLEO Technologies, LDA (<a href="http://evoleotech.com/">EVOLEO</a>) é uma empresa portuguesa com prestígio e reconhecimento externo e um amplo currículo de I&D comprovado por conjunto de projetos europeus e nacionais. Lidera e integra equipas multidisciplinares e possui uma elevada capacidade técnica e de concretização, comprovadas pela sua experiência ao nível do desenho de sistemas eletrónicos críticos e de elevada complexidade. Conta com um Departamento de I&D Tecnológico dedicado à criação de novos produtos, integrando elementos com vastos conhecimentos nas áreas da Engenharia Eletrotécnica e de Computadores, Telecomunicações e Informática e Ciências da Computação.
                        </p>
                    </div>
                </div>

                <br>
                <h2 class="title-style">Entidades co-promotoras</h2>
                <br>

                <div class="row">
                    <div class="col-sm-6">
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <a href="https://sigarra.up.pt/fcnaup/pt/web_page.inicial" target="_blank">
                            <img class="img-responsive center-block" src="images/logo-fcnaup.png" alt="FCNAUP" style="width:100%;">
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <p>
                            A Faculdade de Ciências da Nutrição e Alimentação da Universidade do Porto (<a href="https://sigarra.up.pt/fcnaup/pt/web_page.inicial">FCNAUP</a>) é atualmente a única instituição pública nacional responsável pela formação académica dos graduados em Ciências da Nutrição, com profundo impacto dos nutricionistas na saúde. Constitui um fator de distinção no sistema de ensino superior Português e o seu património humano liga a instituição a diversos países, onde desenvolve ensino, investigação e ação comunitária. É internacionalmente reconhecida especialmente pela atividade científica, destacando-se a participação em projetos europeus, tais como Pro-children, LIPGENE, Habeat, Food4life, Pronutrisenior e Nutrition UP65.
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>
                            A Faculdade de Engenharia da Universidade do Porto (<a href="https://sigarra.up.pt/feup/pt/web_page.inicial">FEUP</a>) desenvolve atividade de educação, investigação e inovação de nível internacional. É uma instituição reconhecida a nível nacional e internacional, cooperando estreitamente com instituições de renome. Os centros de investigação da FEUP que participam neste consórcio são o <a href="http://www.lepabe.fe.up.pt/">LEPABE</a> - Laboratório de Engenharia de Processos, Ambiente, Biotecnologia e Energia (Departamento de Engenharia Química) e a seção de Automação, Instrumentação e Controlo do Departamento de Engenharia Mecânica.
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <br>
                        <br>
                        <br>
                        <a href="https://sigarra.up.pt/feup/pt/web_page.inicial" target="_blank">
                            <img class="img-responsive center-block" src="images/logo-feup.png" alt="FEUP" style="width:90%;">
                        </a>
                        <br><br>
                        <a href="http://www.lepabe.fe.up.pt/" target="_blank">
                            <img class="img-responsive center-block" src="images/lepabe_logo.png" alt="FEUP" style="width:90%;">
                        </a>

                    </div>
                </div>

                <br>

                <br>

            </div>
        </div>
        <!-- END THIRD SECTION - SPONSORS/PARTNERS -->

    </div>

<?php include('footer.php'); ?>