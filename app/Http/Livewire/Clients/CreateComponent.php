<?php

namespace App\Http\Livewire\Clients;

use App\Models\Cliente;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Clients;

class CreateComponent extends Component
{
    use LivewireAlert;

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


    public function mount()
    {
    }

    // Renderizado del Componente
    public function render()
    {
        return view('livewire.clients.create-component');
    }

    public function submit()
    {
        // Validación de datos
        $validatedData = $this->validate(
            [
                'genero' => 'required',
                'dni' => 'required',
                'nombre' => 'required',
                'apellido' => 'required',
                'email_1' => ['required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
                'email_2' => ['nullable', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
                'email_3' => ['nullable', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
                'telefono_1' => 'required',
                'telefono_2' => 'nullable',
                'telefono_3' => 'nullable',
                "direccion_tipo_calle" => 'nullable',
                "direccion_calle" => 'nullable',
                "direccion_num_calle" => 'nullable',
                "direccion_adicional_1" => 'nullable',
                "direccion_adicional_2" => 'nullable',
                "direccion_adicional_3" => 'nullable',
                "direccion_codigo_postal" => 'nullable',
                "direccion_ciudad" => 'nullable',
                'comunicacion_postal' => 'nullable',
                'comunicacion_email' => 'nullable',
                'comunicacion_sms' => 'nullable',

                 ],
            // Mensajes de error
            [
                'dni.required' => 'El dni es obligatorio.',
                'nombre.required' => 'El nombre es obligatorio.',
                'email.required' => 'El email es obligatorio.',
                'email.regex' => 'Introduce un email válido',
                'telefono.required' => 'El teléfono es obligatorio.',
                'direccion.required' => 'La dirección es obligatoria.',
            ]
        );

        // Guardar datos validados
        $clientesSave = Cliente::create($validatedData);

        // Alertas de guardado exitoso
        if ($clientesSave) {
            $this->alert('success', '¡Cliente registrado correctamente!', [
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

    public function getListeners()
    {
        return [
            'confirmed'
        ];
    }

    public function confirmed()
    {
        return redirect()->route('clients.index');
    }
}
