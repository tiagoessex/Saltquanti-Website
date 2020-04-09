<?php include('../header.php'); ?>

    <link href="css/events.css" rel="stylesheet">
    <link href="external/bootstrap-year-calendar.min.css" rel="stylesheet">

    <div class="container below-nav">

        <!-- HEADING -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 events-past-hedding text-center">
                <h1>Eventos Passados</h1>
            </div>
        </div>
        <!-- END HEADING -->

        <!-- EVENT -->
        <div class="row row-striped">
            <div class="col-md-2 col-sm-2 col-xs-2 text-right">
                <h1><span class="label label-default">26</span></h1>
                <h2>SET</h2>
            </div>
            <div class="col-md-10 col-sm-10 col-xs-10">
                <h3 class="text-uppercase"><strong><a href="events/event_26092017.php"> Reunião de parceiros do projeto SALT QUANTI</a></strong></h3>
                <ul class="list-inline">
                    <li><i class="glyphicon glyphicon-calendar"></i> <a href="#modal-calendar" data-toggle="modal" data-target="#modal-calendar" onclick="$('#calendar').data('calendar').setYear(2017)">26/09/1017</a></li>
                    <li><i class="glyphicon glyphicon-time"></i> 14:00 - 18:00</li>
                    <li><i class="glyphicon glyphicon-map-marker"></i> Sala de Atos do DEQ FEUP</li>
                </ul>
                <p>A Sessão de auscultação de parceiros do projeto Salt Quanti decorreu no dia 26 de setembro de 2017, na Sala de Atos do Departamento de Engenharia Química ...</p>
            </div>
        </div>
        <!-- END EVENT -->

       

      

        <!-- START MODAL -->
        <div class="modal fade" id="modal-calendar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Calendário
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 150%">&times;</span>
                        </button>
                    </h2>
                    </div>
                    <div id="calendar">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL -->

    </div>

    <script src='external/bootstrap-year-calendar.js'></script>

    <script>
        $(function() {
            $('#calendar').calendar();

            var currentYear = new Date().getFullYear();

            $('#calendar').calendar({
                enableContextMenu: true,
                enableRangeSelection: true,
                mouseOnDay: function(e) {
                    if (e.events.length > 0) {
                        var content = '';

                        for (var i in e.events) {
                            content += '<div class="event-tooltip-content">' + '<div class="event-name" style="color:' + e.events[i].color + '">' + e.events[i].name + '</div>' + '<div class="event-location">' + e.events[i].location + '</div>' + '</div>';
                        }

                        $(e.element).popover({
                            trigger: 'manual',
                            container: 'body',
                            html: true,
                            content: content
                        });

                        $(e.element).popover('show');
                    }
                },
                mouseOutDay: function(e) {
                    if (e.events.length > 0) {
                        $(e.element).popover('hide');
                    }
                },
                dayContextMenu: function(e) {
                    $(e.element).popover('hide');
                },
                dataSource: [
                {
                    id: 0,
                    name: 'Reunião de parceiros do projeto SALT QUANTI',
                    location: 'Porto, Portugal',
                    startDate: new Date(2017, 8, 26),
                    endDate: new Date(2017, 8, 26)
                }/*, {
                    id: 1,
                    name: 'evento 2',
                    location: 'porto, portugal',
                    startDate: new Date(currentYear, 2, 16),
                    endDate: new Date(currentYear, 2, 19)
                }*/]
            });

        });
    </script>

<?php include('../footer.php'); ?>