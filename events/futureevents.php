<?php include('../header.php'); ?>

    <link href="css/events.css" rel="stylesheet">
    <link href="external/bootstrap-year-calendar.min.css" rel="stylesheet">

    <div class="container below-nav">

        <!-- HEADING -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 events-future-hedding text-center">
                <h1>Eventos Futuros</h1>
            </div>
        </div>
        <!-- END HEADING -->

        <!-- EVENT -->
        <div class="row row-striped event">
            <div class="col-md-2 col-sm-2 col-xs-2 text-right">
                <h1><span class="label label-default">26</span></h1>
                <h2>OUT</h2>
            </div>
            <div class="col-md-10 col-sm-10 col-xs-10">
                <h3 class="text-uppercase"><strong><a href="events/event_26102018.php"> Sessão de Apresentação</a></strong></h3>
                <ul class="list-inline">
                    <li><i class="glyphicon glyphicon-calendar"></i> <a href="#modal-calendar" data-toggle="modal" data-target="#modal-calendar">26/10/1018</a></li>
                    <li><i class="glyphicon glyphicon-time"></i> 12:30 - 14:00</li>
                    <li><i class="glyphicon glyphicon-map-marker"></i> L003</li>
                </ul>
                <p>Sessão de apresentação</p>
            </div>
        </div>
        <!-- END EVENT -->

        <div class="noevent text-center hidden">
            <br><br>
            <h1><span style="color:#63c8ed;">NÃO EXISTEM EVENTOS AGENDADOS</span></h1>
        </div>



        <!-- MODAL -->
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

            if ($('.event').length == 0) {
                $('.noevent').removeClass("hidden");
            }

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
                dataSource: [{                    
                    id: 0,
                    name: 'Sessão de Apresentação',
                    location: 'Porto, Portugal',
                    startDate: new Date(2018, 10, 26),
                    endDate: new Date(2018, 10, 26)
                }]
            });

        });
    </script>

<?php include('../footer.php'); ?>