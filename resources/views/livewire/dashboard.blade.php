<div class="row justify-content-center">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <div class="col-md-4">
        <div class="card">
            <h5 class="card-header">Citas agendadas</h5>
            <div class="card-body" wire:ignore>
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
                    <h5 class="mt-1 text-center"> <b> No hay citas en la agenda. </b> </h5>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <h5 class="card-header">Tareas asignadas</h5>
            <div class="card-body">
                @if ($tareas_asignadas->count() > 0)
                    <div id="accordionTA">
                        @foreach ($tareas_asignadas as $tarea_asignadaIndex => $tarea_asignada)
                            <div class="card mb-0">
                                <div class="card-header" id="headingTA-{{ $tarea_asignadaIndex }}"
                                    @if ($tarea_asignada->presupuesto->vehiculo_renting == 1) style="background-color: #edc618 !important;" @endif>
                                    <h5 class="mb-0 mt-0 font-14">
                                        <a data-toggle="collapse" data-parent="#accordionTA"
                                            href="#collapseTA-{{ $tarea_asignadaIndex }}" aria-expanded="true"
                                            aria-controls="collapseTA-{{ $tarea_asignadaIndex }}" class="text-dark">
                                            {{ $tarea_asignada->descripcion }}
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTA-{{ $tarea_asignadaIndex }}" class="collapse"
                                    aria-labelledby="headingTA-{{ $tarea_asignadaIndex }}" data-parent="#accordionTA">
                                    <div class="card-body">
                                        <h5 class="border-bottom"> Datos </h5>
                                        <ul>
                                            <li><b>Cliente:</b>
                                                {{ $tarea_asignada->presupuesto->cliente->nombre }}
                                                -
                                                {{ $tarea_asignada->presupuesto->matricula }}
                                            </li>
                                            <li><b>Presupuesto:</b>
                                                {{ $tarea_asignada->presupuesto->numero_presupuesto }}
                                            </li>
                                            <li><b>Operarios:</b>
                                                <ul>
                                                    @foreach (json_decode($tarea_asignada->operarios, true) as $operario)
                                                        <li> {{ $trabajadores->where('id', $operario)->first()->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li><b>Trabajos solicitados:</b>
                                                <ul>
                                                    @foreach (json_decode($tarea_asignada->trabajos_solicitados, true) as $trabajo)
                                                        <li> {{ $trabajo }} </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li><b>Trabajos a realizar:</b>
                                                <ul>
                                                    @foreach (json_decode($tarea_asignada->trabajos_realizar, true) as $trabajo)
                                                        <li> {{ $trabajo }} </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li><b>Daños localizados</b>
                                                <ul>
                                                    @foreach (json_decode($tarea_asignada->danos_localizados, true) as $trabajo)
                                                        <li> {{ $trabajo }} </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                        <h5 class="border-bottom"> Productos </h5>
                                        <table class="table responsive"
                                            id="tableProductosTA{{ $tarea_asignadaIndex }}">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Código</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col" class="none">
                                                        Cantidad
                                                    </th>
                                                </tr>
                                            </thead>
                                            @if (count(json_decode($tarea_asignada->presupuesto->listaArticulos, true)) != 0)
                                                <tbody>
                                                    @foreach (json_decode($tarea_asignada->presupuesto->listaArticulos, true) as $productoE => $cantidad)
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
                                        <h5 class="border-bottom">&nbsp;</h5>
                                        <div class="row justify-content-center">
                                            @if ($tarea_asignada->estado == 'Facturada')
                                            @else
                                                @if ($tarea_asignada->estado == 'Completada')
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
                                                                        wire:click="redirectToCaja('{{ $tarea_asignada->id }}', 'No pagado')">Guardar
                                                                        sin cobrar</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        wire:click="redirectToCaja('{{ $tarea_asignada->id }}','Contado')">Contado</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        wire:click="redirectToCaja('{{ $tarea_asignada->id }}','Tarjeta de crédito')">Tarjeta
                                                                        de crédito</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        wire:click="redirectToCaja('{{ $tarea_asignada->id }}','Transferencia bancaria')">Transferencia
                                                                        bancaria</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        wire:click="redirectToCaja('{{ $tarea_asignada->id }}','Recibo bancario a 30 días')">Recibo
                                                                        bancario
                                                                        a 30 días</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        wire:click="redirectToCaja('{{ $tarea_asignada->id }}','Bizum')">Bizum</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        wire:click="redirectToCaja('{{ $tarea_asignada->id }}', 'Financiado')">Financiado</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    @if ($tarea_asignada->logsEnCurso()->count() > 0)
                                                        <div class="col-3" style="font-size: 2rem !important;">
                                                            <button type="button" class="btn btn-danger"
                                                                wire:click="pausarTarea('{{ $tarea_asignada->id }}', '{{ Auth::id() }}')">Pausar
                                                                tarea</button>
                                                        </div>
                                                    @else
                                                        @if ($tarea_asignada->logs()->count() > 0)
                                                            <div class="col-3" style="font-size: 2rem !important;">
                                                                <button type="button" class="btn btn-warning"
                                                                    wire:click="iniciarTarea('{{ $tarea_asignada->id }}', '{{ Auth::id() }}')">Reanudar
                                                                    tarea</button>
                                                            </div>
                                                        @else
                                                            <div class="col-3" style="font-size: 2rem !important;">
                                                                <button type="button" class="btn btn-warning"
                                                                    wire:click="iniciarTarea('{{ $tarea_asignada->id }}', '{{ Auth::id() }}')">Iniciar
                                                                    tarea</button>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    <div class="col-3" style="font-size: 2rem !important;"><button
                                                            wire:click="completarTarea({{ $tarea_asignada->id }})"
                                                            id="delete-button-{{ $tarea_asignada->id }}" type="button"
                                                            class="btn btn-secondary">Completar
                                                            tarea</button>

                                                        <script>
                                                            document.getElementById('delete-button-{{ $tarea_asignada->id }}').addEventListener('click', function(event) {
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
                                                                        @this.call('completarTarea', {{ $tarea_asignada->id }})
                                                                    }
                                                                })
                                                            });
                                                        </script>
                                                    </div>
                                                    <div class="col-6">
                                                        <h4>Tiempo empleado: <b style="font-size: 1.5rem">
                                                                {{ $this->calcularTiempo($this->tiempoTotalTrabajado($tarea_asignada->id, Auth::id())) }}
                                                            </b></h4>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>
        @else
            <h5> No tienes tareas asignadas. </h5>
            @endif
        </div>
    </div>
</div>
</div>
</div>
