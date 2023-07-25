<div class="row justify-content-center">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    @mobile
        <div class="col-md-11">
            <div class="accordion" id="accordionDashboard">
                <div class="accordion-item">
                    <button class="card-header accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseActiva" aria-expanded="false" aria-controls="collapseActiva">
                        <h4 class="accordion-header text-center" id="headingActiva">Próximas citas</b></p>
                    </button>
                    <div id="collapseActiva" class="accordion-collapse collapse" aria-labelledby="headingActiva"
                        data-bs-parent="#accordionDashboard">
                        <div class="accordion-body">
                            @if (count($tareas_en_curso) > 0)
                                <div class="accordion border-warning" id="accordionExample1">
                                    <div class="card-body" x-data="{}" x-init="$nextTick(() => {
                                        console.log('hola');
                                        var calendarEl = document.getElementById('calendar');
                                        var calendar = new FullCalendar.Calendar(calendarEl, {
                                            initialView: 'listWeek',
                                            themeSystem: 'bootstrap',
                                            locale: 'es',
                                            views: {
                                                listWeek: {
                                                    weekHeaderFormat: {
                                                        year: 'numeric',
                                                        month: '2-digit',
                                                        day: '2-digit'
                                                    }
                                                },
                                            },
                                            headerToolbar: {
                                                left: '',
                                                center: '',
                                                right: '',
                                            },
                                            footerToolbar: {
                                                left: '',
                                                center: '',
                                                right: '',
                                            },
                                            events: [
                                                @foreach($tareas_en_curso as $evento) {
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
                                            },
                                        });

                                        calendar.render();

                                        $('.fc-daygrid-event .fc-event-time').css('color', '#c29e00');

                                        $('.fc-daygrid-event .fc-event-title').css('color', '#ad8b00');

                                    })">
                                        <div id='calendar'></div>
                                    </div>
                                </div>
                            @else
                                <h5 class="mt-1 text-center"> <b> No hay tareas activas. </b> </h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elsemobile
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item" role="presentation">
                <button class="nav-link @if ($tab == 'tab1') active"  style="color: #ffaa00;" @else "  style="color: #ae9700;" @endif wire:click="cambioTab('tab1')"
                    id="curso-tab" data-bs-toggle="tab" data-bs-target="#curso" type="button" role="tab"
                    aria-controls="curso" aria-selected="false">
                    @if ($tab == 'tab1')
                        <h3>Próximas citas</h3>
                    @else
                        <h5>Próximas citas</h5>
                    @endif
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link @if ($tab == 'tab2') active"  style="color: #ffaa00;" @else "  style="color: #ae9700;" @endif wire:click="cambioTab('tab2')"
                    id="asignada-tab" data-bs-toggle="tab" data-bs-target="#asignada" type="button" role="tab"
                    aria-controls="asignada" aria-selected="false">
                    @if ($tab == 'tab2')
                        <h3>Tareas asignadas</h3>
                    @else
                        <h5>Tareas asignadas</h5>
                    @endif

                </button>
            </li>
        </ul>
        <div class="col-md-11">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade @if ($tab == 'tab1') show active @endif" id="curso"
                    role="tabpanel" aria-labelledby="curso-tab" wire:ignore>
                    @if (count($tareas_en_curso) > 0)
                        <div class="accordion border-warning" id="accordionExample1">
                            <div class="card-body" x-data="{}" x-init="$nextTick(() => {
                                console.log('hola');
                                var calendarEl = document.getElementById('calendar');
                                var calendar = new FullCalendar.Calendar(calendarEl, {
                                    initialView: 'listWeek',
                                    themeSystem: 'bootstrap',
                                    locale: 'es',
                                    views: {
                                        listWeek: {
                                            weekHeaderFormat: {
                                                year: 'numeric',
                                                month: '2-digit',
                                                day: '2-digit'
                                            }
                                        },
                                    },
                                    headerToolbar: {
                                        left: '',
                                        center: '',
                                        right: '',
                                    },
                                    footerToolbar: {
                                        left: '',
                                        center: '',
                                        right: '',
                                    },
                                    events: [
                                        @foreach($tareas_en_curso as $evento) {
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
                                            title: info.event.extendedProps.description,
                                            placement: 'top',
                                            trigger: 'hover',
                                            html: true
                                        });
                                    },
                                    viewDidMount: function() {
                                        $('.fc-daygrid-event .fc-event-title').css('color', '#c29e00');
                                        $('.fc-list-day-text').css('color', '#c29e00');
                                        $('.fc-list-day-side-text').css('color', '#c29e00');
                                    },
                                });

                                calendar.render();

                                $('.fc-daygrid-event .fc-event-time').css('color', '#c29e00');

                                $('.fc-daygrid-event .fc-event-title').css('color', '#ad8b00');

                            })">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    @else
                        <h5 class="mt-1 text-center"> <b> No hay tareas activas. </b> </h5>
                    @endif
                </div>
            </div>
            <div class="tab-pane fade @if ($tab == 'tab2') show active @endif" id="asignada" role="tabpanel"
                aria-labelledby="asignada-tab">
                @if (count($tareas_no_completadas) > 0)
                    <br>
                    <div class="accordion border-warning" id="accordionExample1">
                        @foreach ($tareas_no_completadas as $tareaIndex => $tarea)
                            <div class="card accordion-item">
                                @if ($tarea->estado == 'Facturada')
                                    <button class="card-header accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" style="background-color: #7dc15b !important;"
                                        data-bs-target="#collapseNC{{ $tareaIndex }}" aria-expanded="false"
                                        aria-controls="collapseNC{{ $tareaIndex }}">
                                        <h5 class="accordion-header" id="headingNC{{ $tareaIndex }}">
                                            {{ $tarea->presupuesto->cliente->nombre }} -
                                            {{ $tarea->presupuesto->matricula }}
                                        </h5>
                                    </button>
                                @else
                                    @if ($tarea->presupuesto->vehiculo_renting == 1)
                                        <button class="card-header accordion-button collapsed bg-warning" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseNC{{ $tareaIndex }}"
                                            aria-expanded="false" aria-controls="collapseNC{{ $tareaIndex }}">
                                            <h5 class="accordion-header" id="headingNC{{ $tareaIndex }}">
                                                {{ $tarea->presupuesto->cliente->nombre }} -
                                                {{ $tarea->presupuesto->matricula }}
                                            </h5>
                                        </button>
                                    @else
                                        <button class="card-header accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseNC{{ $tareaIndex }}"
                                            aria-expanded="false" aria-controls="collapseNC{{ $tareaIndex }}">
                                            <h5 class="accordion-header" id="headingNC{{ $tareaIndex }}">
                                                {{ $tarea->presupuesto->cliente->nombre }} -
                                                {{ $tarea->presupuesto->matricula }}
                                            </h5>
                                        </button>
                                    @endif
                                @endif

                                <div id="collapseNC{{ $tareaIndex }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingNC{{ $tareaIndex }}" data-bs-parent="#accordionExample">
                                    <div class="card-body accordion-body">
                                        <h5>ESTADO:</h5>
                                        {{ $tarea->estado }}
                                        <hr />

                                        <div class="accordion border-warning" id="accordionExample1NC{{ $tareaIndex }}">
                                            <div class="card accordion-item">
                                                <button class="card-header accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse1NC{{ $tareaIndex }}"
                                                    aria-expanded="false" aria-controls="collapse1NC{{ $tareaIndex }}">
                                                    <h5 class="accordion-header" id="heading1NC{{ $tareaIndex }}">
                                                        Datos
                                                    </h5>
                                                </button>
                                                <div id="collapse1NC{{ $tareaIndex }}"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="heading1NC{{ $tareaIndex }}"
                                                    data-bs-parent="#accordionExample1NC{{ $tareaIndex }}">
                                                    <div class="card-body accordion-body">
                                                        <h5 class="card-title">Fecha de emisión:</h5>
                                                        <p class="card-text">{{ $tarea->fecha }}</p>
                                                        <hr />
                                                        <h5 class="card-title">Descripción del trabajo:
                                                        </h5>
                                                        <p class="card-text">{{ $tarea->descripcion }}</p>
                                                        <hr />
                                                        <h5 class="card-title">Datos del vehículo:</h5>
                                                        <p><b>Matrícula:</b>
                                                            {{ $tarea->presupuesto->matricula }}</p>
                                                        <p><b>Marca:</b> {{ $tarea->presupuesto->marca }}
                                                        </p>
                                                        <p><b>Modelo:</b> {{ $tarea->presupuesto->modelo }}
                                                        </p>
                                                        <hr />
                                                        <h5 class="card-title">Precio (IVA incluido):</h5>
                                                        <p class="card-text">
                                                            {{ $tarea->presupuesto->precio + $tarea->presupuesto->precio * 0.21 }}
                                                        </p>
                                                        <hr />
                                                        <h5 class="card-title">Comentarios:</h5>
                                                        <p class="card-text" id="comentarios">
                                                            {{ $tarea->observaciones }}
                                                        </p>
                                                        <hr />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion border-warning"
                                            id="accordionExample2NC{{ $tareaIndex }}">
                                            <div class="card accordion-item" wire:ignore>
                                                <button class="card-header accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse2NC{{ $tareaIndex }}"
                                                    aria-expanded="false" aria-controls="collapse2NC{{ $tareaIndex }}">
                                                    <h5 class="accordion-header" id="heading2NC{{ $tareaIndex }}">
                                                        Productos
                                                    </h5>
                                                </button>
                                                <div id="collapse2NC{{ $tareaIndex }}"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="heading2NC{{ $tareaIndex }}"
                                                    data-bs-parent="#accordionExample2NC{{ $tareaIndex }}">
                                                    <div class="card-body accordion-body">
                                                        <div x-data="{}" x-init="$nextTick(() => {
                                                            console.log('hola');
                                                            $('#tableProductosNCNC{{ $tareaIndex }}').DataTable({
                                                                responsive: true,
                                                                fixedHeader: true,
                                                                searching: false,
                                                                paging: false,
                                                                autoWidth: false,
                                                            });
                                                        })">
                                                            <table class="table responsive"
                                                                id="tableProductosNC{{ $tareaIndex }}">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Código</th>
                                                                        <th scope="col">Nombre</th>
                                                                        <th scope="col" class="none">
                                                                            Cantidad
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                @if (count(json_decode($tarea->presupuesto->listaArticulos, true)) != 0)
                                                                    <tbody>
                                                                        @foreach (json_decode($tarea->presupuesto->listaArticulos, true) as $productoE => $cantidad)
                                                                            <tr>
                                                                                <td>{{ $productos->where('id', $productoE)->first()->cod_producto }}
                                                                                </td>
                                                                                <td>{{ $productos->where('id', $productoE)->first()->descripcion }}
                                                                                </td>
                                                                                <td>{{ $cantidad }}
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    <tbody>
                                                                @endif
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            @if ($tarea->estado == 'Facturada')
                                            @else
                                                <hr />
                                                @if ($tarea->estado == 'Completada')
                                                    <div class="col">
                                                        <div class="d-grid gap-2">
                                                            <div class="dropdown">
                                                                <button class="btn btn-secondary dropdown-toggle"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    Opciones de cobro
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#"
                                                                        wire:click="redirectToCaja('{{ $tarea->id }}', 'No pagado')">Guardar
                                                                        sin cobrar</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        wire:click="redirectToCaja('{{ $tarea->id }}','Contado')">Contado</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        wire:click="redirectToCaja('{{ $tarea->id }}','Tarjeta de crédito')">Tarjeta
                                                                        de crédito</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        wire:click="redirectToCaja('{{ $tarea->id }}','Transferencia bancaria')">Transferencia
                                                                        bancaria</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        wire:click="redirectToCaja('{{ $tarea->id }}','Recibo bancario a 30 días')">Recibo
                                                                        bancario
                                                                        a 30 días</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        wire:click="redirectToCaja('{{ $tarea->id }}','Bizum')">Bizum</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        wire:click="redirectToCaja('{{ $tarea->id }}', 'Financiado')">Financiado</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    @if ($tarea->logsEnCurso()->count() > 0)
                                                        <div class="col-4" style="font-size: 2rem !important;"> <button type="button"
                                                                class="btn btn-danger"
                                                                wire:click="pausarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Pausar
                                                                tarea</button></div>
                                                    @else
                                                        @if ($tarea->logs()->count() > 0)
                                                            <div class="col-4" style="font-size: 2rem !important;"> <button type="button"
                                                                    class="btn btn-warning"
                                                                    wire:click="iniciarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Reanudar
                                                                    tarea</button></div>
                                                        @else
                                                            <div class="col-4" style="font-size: 2rem !important;"> <button type="button"
                                                                    class="btn btn-warning"
                                                                    wire:click="iniciarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Iniciar
                                                                    tarea</button></div>
                                                        @endif
                                                    @endif
                                                    <div class="col-6"><button
                                                            wire:click="completarTarea({{ $tarea->id }})"
                                                            id="delete-button-{{ $tarea->id }}" type="button"
                                                            class="btn btn-secondary">Completar
                                                            tarea</button>

                                                        <script>
                                                            document.getElementById('delete-button-{{ $tarea->id }}').addEventListener('click', function(event) {
                                                                event.preventDefault();

                                                                Swal.fire({
                                                                    title: '¿Estás seguro?',
                                                                    text: "Asegúrate de que todo en la tarea está listo.",
                                                                    icon: 'warning',
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: '#3085d6',
                                                                    cancelButtonColor: '#d33',
                                                                    confirmButtonText: 'Marcar como completada'
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        // Esto llamará al método confirmDelete de Livewire y pasará el ID del item
                                                                        @this.call('completarTarea', {{ $tarea->id }})
                                                                    }
                                                                })
                                                            });
                                                        </script>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <hr />
                                        <h4>Tiempo empleado: <b style="font-size: 1.5rem"> {{$this->calcularTiempo($this->tiempoTotalTrabajado($tarea->id, Auth::id()))}} </b></h4>
                                    </div>
                                </div>
                                @if ($tareaIndex < count($tareas_no_completadas) - 1)
                                    <div class="p-1"></div>
                                @endif
                        @endforeach
                    </div>
                @else
                    <h3 class="mt-3 text-center"> <b> No hay tareas asignadas. </b> </h3>
                @endif
            </div>
        </div>
    </div>

@endmobile
</div>
