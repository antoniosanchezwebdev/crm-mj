<div class="container mx-auto">
    <form wire:submit.prevent="submit">
        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
        <div class="card mb-3">
            <h5 class="card-header">
                Añadir cita a la agenda
            </h5>
            <div class="card-body">

                    <div class="mb-3 row d-flex align-items-center">
                        <label for="cliente" class="col-sm-3 col-form-label"><strong>Cliente:</strong></label>
                        <div x-data="" x-init="$('#select2-cliente-create').select2();
                        $('#select2-cliente-create').on('change', function(e) {
                            var data = $('#select2-cliente-create').select2('val');
                            @this.set('cliente_id', data);
                        });">
                            <div class="col" wire:ignore>
                                <select class="form-control" id="select2-cliente-create">
                                    <option value="">-- Elige un cliente --</option>
                                    @foreach ($clientes as $cliente)
                                        <option value={{ $cliente->id }}>{{ $cliente->nombre_completo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row d-flex align-items-center">
                        <label for="nombre_completo" class="col-sm-2 col-form-label">Título de la cita</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="titulo" class="form-control" name="titulo" id="titulo"
                                placeholder="Título para mostrar en la agenda">
                            @error('titulo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row d-flex align-items-center">
                        <label for="nombre_completo" class="col-sm-2 col-form-label">Descripción</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="descripcion" class="form-control" name="descripcion"
                                id="descripcion" placeholder="Descripción completa sobre la cita">
                            @error('descripcion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="fecha" class="col-sm-2 col-form-label">Fecha de inicio</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" wire:model="fecha" class="form-control" name="fecha"
                            id="fecha"
                            placeholder="Nombre del cliente con apellidos (ej; Pepe Pérez González...)">
                        @error('fecha')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>
        </div>
        <div class="mb-3 row d-flex align-items-center">
            <button type="submit" class="btn btn-warning">Guardar</button>
        </div>
    </form>
</div>
