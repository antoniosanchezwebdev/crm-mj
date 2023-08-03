<div id="containerClientesEdit">
    <form wire:submit.prevent="update">
        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
        <div class="card text-dark bg-light mb-3">
            <h5 class="card-header">Datos básicos del cliente</h5>
            <div class="card-body">
                <div class="mb-3 row d-flex align-items-center">
                    <div class="col-sm-4">
                        &nbsp;
                    </div>
                    <div class="col-sm-2">
                        <label>
                            <input type="radio" value="Don" wire:model="genero" @if($genero == "Don" || $genero == "M") checked @endif>
                            Don
                        </label>
                    </div>
                    <div class="col-sm-2">
                        <label>
                            <input type="radio" value="Doña" wire:model="genero" @if($genero == "Doña" || $genero = "Mme" || $genero = "Melle") checked @endif>
                            Doña
                        </label>
                    </div>
                    <div class="col-sm-4">
                        &nbsp;
                    </div>
                </div>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="nombre" class="col-sm-2 col-form-label">Nombre </label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="nombre" class="form-control" name="nombre" id="nombre"
                            placeholder="Nombre del cliente, particular o empresa...">
                        @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="nombre" class="col-sm-2 col-form-label">Apellido</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="apellido" class="form-control" name="apellido" id="apellido"
                            placeholder="Apellido del cliente (en caso de ser particular)...">
                        @error('apellido')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="dni" class="col-sm-2 col-form-label">DNI</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="dni" class="form-control" name="dni" id="dni"
                            placeholder="DNI/NIF (123456789A)">
                        @error('dni')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card text-dark bg-light mb-3">
            <h5 class="card-header">Datos de contacto</h5>
            <div class="card-body">
                <div class="mb-3 row d-flex align-items-center">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="email_1" class="form-control" name="email_1" id="email_1"
                            placeholder="Correo electrónico del cliente (ejemplo@gmail.com)">
                        <input type="text" wire:model="email_2" class="form-control" name="email_2" id="email_2"
                            placeholder="Correo electrónico alternativo en caso de ser necesario.">
                        <input type="text" wire:model="email_3" class="form-control" name="email_3" id="email_3"
                            placeholder="Correo electrónico alternativo en caso de ser necesario.">
                        @error('email_1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="telefono_1" class="form-control" name="telefono_1"
                            id="telefono_1" placeholder="Teléfono del cliente (123456789)">
                        <input type="text" wire:model="telefono_2" class="form-control" name="telefono_2"
                            id="telefono_2" placeholder="Número de teléfono alternativo en caso de ser necesario.">
                        <input type="text" wire:model="telefono_3" class="form-control" name="telefono_3"
                            id="telefono_3" placeholder="Número de teléfono alternativo en caso de ser necesario.">
                        @error('telefono')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card text-dark bg-light mb-3">
            <h5 class="card-header">Dirección del cliente</h5>
            <div class="card-body">
                <div class="mb-3 row d-flex align-items-center">
                    <label for="direccion" class="col-sm-2 col-form-label">Tipo de vía</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="direccion_tipo_calle" class="form-control"
                            name="direccion" id="direccion"
                            placeholder="Tipo de vía donde se ubica la dirección (Calle, Avenida, etc...)">
                        @error('direccion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="direccion_calle" class="form-control" name="direccion"
                            id="direccion" placeholder="Ubicación del domicilio del cliente (c/ Baldomero)">
                        @error('direccion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="direccion" class="col-sm-2 col-form-label">Número de dirección</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="direccion_num_calle" class="form-control" name="direccion"
                            id="direccion" placeholder="Dentro de la calle, indica el número de la dirección (12)">
                        @error('direccion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="direccion" class="col-sm-2 col-form-label">Código postal</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="direccion_codigo_postal" class="form-control"
                            name="direccion" id="direccion"
                            placeholder="Dentro de la calle, indica el número de la dirección (12)">
                        @error('direccion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="direccion" class="col-sm-2 col-form-label">Ciudad</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="direccion_ciudad" class="form-control" name="direccion"
                            id="direccion" placeholder="Dentro de la calle, indica el número de la dirección (12)">
                        @error('direccion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="direccion" class="col-sm-2 col-form-label">Información adicional</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="direccion_adicional_1" class="form-control"
                            name="direccion" id="direccion" placeholder="Datos adicionales sobre la dirección.">
                        <input type="text" wire:model="direccion_adicional_2" class="form-control"
                            name="direccion" id="direccion" placeholder="Datos adicionales sobre la dirección.">
                        <input type="text" wire:model="direccion_adicional_3" class="form-control"
                            name="direccion" id="direccion" placeholder="Datos adicionales sobre la dirección.">
                        @error('direccion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3 row d-flex align-items-center">
            <button type="submit" class="btn btn-warning">Actualizar datos del cliente</button>
        </div>
    </form>

    <div class="mb-3 row d-flex align-items-center">
        <button type="submit" class="btn btn-danger" wire:click="destroy">Eliminar datos del cliente</button>
    </div>
</div>
