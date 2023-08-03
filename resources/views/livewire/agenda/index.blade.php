<div id="containerAgendaIndex">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <div class="card mb-3">
        <h5 class="card-header">
            Calendario
        </h5>
        <div class="card-body" x-data="{}" x-init="$nextTick(() => {
            console.log('hola');
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: window.innerWidth < 1000 ? 'timeGridDay' : 'dayGridMonth',
                themeSystem: 'bootstrap',
                locale: 'es',
                views: {
                    timeGridDay: {
                        dayHeaderFormat: {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }
                    },
                    dayGridMonth: {
                        monthHeaderFormat: {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }
                    },
                    timeGridDay: {
                        dayHeaderFormat: {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }
                    },
                    listWeek: {
                        weekHeaderFormat: {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }
                    },
                },
                @mobile
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: '',
                },
                footerToolbar: {
                    left: 'dayGridMonth,timeGridDay,listWeek'
                },
                @elsemobile
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                },
                @endmobile
                eventClick: function(info) {
                    Livewire.emit('seleccionarProducto', info.event.id);
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                    list: 'Lista'
                },
                events: [
                    @foreach($eventos as $evento) {
                        title: '{{ $evento->titulo }}',
                        start: '{{ $evento->fecha }}',
                        end: '{{ $evento->fecha }}',
                        description: '{{ $evento->descripcion }}',
                        id: '{{ $evento->id }}',
                        color: '#fac900',
                    },
                    @endforeach
                ],
                eventDidMount: function(info) {
                    var tooltip = new bootstrap.Tooltip(info.el, {
                        title: info.event.title + ': ' + info.event.extendedProps.description,
                        placement: 'top',
                        trigger: 'hover',
                        html: true
                    });
                },
                viewDidMount: function() {
                    $('.fc-daygrid-event .fc-event-title').css('color', '#c29e00');
                    $('.fc-list-day-text').css('color', '#c29e00');
                    $('.fc-list-day-side-text').css('color', '#c29e00');
                    $('.fc-col-header-cell-cushion').css('color', '#c29e00');
                    $('.fc-daygrid-day-number').css('color', '#c29e00');
                    $('.fc-list-day-side-text').css('color', '#c29e00');
                },
            });

            calendar.render();

            $('.fc-daygrid-event .fc-event-time').css('color', '#000');

            $('.fc-daygrid-event .fc-event-title').css('color', '#000');

        })">
            <div id='calendar'></div>
        </div>
    </div>
</div>
