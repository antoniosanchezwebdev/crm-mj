<div id="containerClientes">
    <div class="card mb-3">
        <h5 class="card-header">
            Clientes
        </h5>
        <div class="card-body" x-data="{}" x-init="$nextTick(() => {
            $('#tableCliente').DataTable({
                responsive: true,
                fixedHeader: true,
                searching: false,
                paging: false,
            });
        })">
        <div class="mb-3 row d-flex align-items-center">
            <label for="nombre" class="col-sm-2 col-form-label"><h4>Buscar cliente</h4></label>
            <div class="col-sm-10">
                <input type="text" wire:model="nombre" class="form-control" name="nombre" id="nombre"
                    placeholder="Nombre del cliente, particular o empresa...">
                @error('nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    <hr/>
            <table class="table" id="tableCliente">
                <thead>
                    <tr>
                        <th scope="col">ID del cliente</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Email</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($clientes != null)
                        @foreach ($clientes as $cliente)
                            <tr>
                                <th scope="row">{{ $cliente->id }}</th>
                                <td>{{ $cliente->dni }}</td>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->apellido }}</td>
                                <td>{{ $cliente->email_1 }}</td>
                                <td>{{ $cliente->direccion_calle . " , " . $cliente->direccion_ciudad }}</td>
                                <td>{{ $cliente->telefono_1 }}</td>
                                <td> <button type="button" class="btn btn-warning boton-producto"
                                        onclick="Livewire.emit('seleccionarProducto', {{ $cliente->id }});">Ver/Editar</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <h5>No hay clientes en la base de datos</h5>
                    @endif

                </tbody>
            </table>
            <br>
            {{ $clientes->links() }}

        </div>
    </div>
</div>
