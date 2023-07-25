<?php

namespace App\Http\Livewire\Clients;

use Livewire\Component;
use App\Models\Cliente;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditComponent extends Component
{
    use LivewireAlert;

    public $identificador;
    public $genero;
    public $dni;
    public $nombre;
    public $apellido;

    public $email_1;
    public $email_2;
    public $email_3;

    public $telefono_1;
    public $telefono_2;
    public $telefono_3;

    public $direccion_tipo_calle;
    public $direccion_calle;
    public $direccion_num_calle;
    public $direccion_adicional_1;
    public $direccion_adicional_2;
    public $direccion_adicional_3;
    public $direccion_codigo_postal;
    public $direccion_ciudad;

    public $comunicacion_postal;
    public $comunicacion_email;
    public $comunicacion_sms;

    public function mount(){
        $cliente = Cliente::find($this->identificador);

        $this->genero = $cliente->genero;
        $this->dni = $cliente->dni;
        $this->nombre = $cliente->nombre;
        $this->apellido = $cliente->apellido;

        $this->telefono_1 = $cliente->telefono_1;
        $this->telefono_2 = $cliente->telefono_2;
        $this->telefono_3 = $cliente->telefono_3;

        $this->email_1 = $cliente->email_1;
        $this->email_2 = $cliente->email_2;
        $this->email_3 = $cliente->email_3;

        $this->direccion_tipo_calle = $cliente->direccion_tipo_calle;
        $this->direccion_calle = $cliente->direccion_calle;
        $this->direccion_num_calle = $cliente->direccion_num_calle;
        $this->direccion_adicional_1 = $cliente->direccion_adicional_1;
        $this->direccion_adicional_2 = $cliente->direccion_adicional_2;
        $this->direccion_adicional_3 = $cliente->direccion_adicional_3;
        $this->direccion_codigo_postal = $cliente->direccion_codigo_postal;
        $this->direccion_ciudad = $cliente->direccion_ciudad;
        }

    public function render()
    {

        return view('livewire.clients.edit-component');
    }

    public function update()
    {
        // Validación de datos
        $this->validate([
            'dni' => 'required',
            'nombre' => 'required',
            'email' => ['required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'telefono' => 'required',
            'direccion' => 'required',
        ],
            // Mensajes de error
            [
                'dni.required' => 'El DNI es obligatorio.',
                'nombre.required' => 'El nombre es obligatorio.',
                'email.required' => 'El email es obligatorio.',
                'email.regex' => 'Introduce un email válido',
                'telefono.required' => 'El teléfono es obligatorio.',
                'direccion.required' => 'La dirección es obligatoria.',
            ]);

        // Guardar datos validados
        // Encuentra el alumno identificado
        $cliente = Cliente::find($this->identificador);

        // Guardar datos validados
        $clientesSave = $cliente->update([
            'dni' => $this->dni,
            'nombre' => $this->nombre,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'observaciones' => $this->observaciones,

        ]);

        // Alertas de guardado exitoso
        if ($clientesSave) {
            $this->alert('success', '¡Cliente actualizado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la información del cliente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }
    }

    public function destroy(){
        // $product = Productos::find($this->identificador);
        // $product->delete();

        $this->alert('warning', '¿Seguro que desea borrar el cliente? No hay vuelta atrás', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmDelete',
            'confirmButtonText' => 'Sí',
            'showDenyButton' => true,
            'denyButtonText' => 'No',
            'timerProgressBar' => true,
        ]);

    }

    public function getListeners()
    {
        return [
            'confirmed',
            'confirmDelete'
        ];
    }

    // Función para cuando se llama a la alerta
    public function confirmed()
    {
        // Do something
        return redirect()->route('clients.index');

    }
    // Función para cuando se llama a la alerta
    public function confirmDelete()
    {
        $cliente = Clients::find($this->identificador);
        $cliente->delete();
        return redirect()->route('clients.index');

    }
}
