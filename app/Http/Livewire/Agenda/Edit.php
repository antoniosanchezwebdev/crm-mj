<?php

namespace App\Http\Livewire\Agenda;

use App\Models\Cliente;
use App\Models\Inmuebles;
use Livewire\Component;
use App\Models\Evento;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;

    public $identificador;

    public $eventos;
    public $titulo;
    public $descripcion;
    public $fecha;
    public $cliente_id;
        public $clientes;

    public function mount()
    {
        $this->eventos = Evento::find($this->identificador);
        $this->clientes = Cliente::all();

        $this->titulo =  $this->eventos->titulo;
        $this->descripcion =  $this->eventos->descripcion;
        $this->fecha =  $this->eventos->fecha;
        $this->cliente_id =  $this->eventos->cliente_id;

    }

    public function render()
    {

        return view('livewire.agenda.edit');
    }

    public function update()
    {

        $this->validate(
            [
                'titulo' => 'required',
                'descripcion' => 'required',
                'fecha' => 'required',
                'cliente_id' => 'nullable',
            ],
            // Mensajes de error
            [
                'fecha.required' => 'Introduce una fecha de inicio.',
            ]
        );


        // Guardar datos validados
        // Encuentra el alumno identificado
        $clientes = Evento::find($this->identificador);

        // Guardar datos validados
        $clientesSave = $clientes->update([
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'fecha' => $this->fecha,
            'cliente_id' => $this->cliente_id,
        ]);

        // Alertas de guardado exitoso
        if ($clientesSave) {
            $this->alert('success', '¡Evento actualizado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la información del evento!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }
    }

    public function destroy()
    {
        // $product = Productos::find($this->identificador);
        // $product->delete();

        $this->alert('warning', '¿Seguro que desea borrar el clientes? No hay vuelta atrás', [
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
        return redirect()->route('agenda.index');
    }
    // Función para cuando se llama a la alerta
    public function confirmDelete()
    {
        $clientes = Evento::find($this->identificador);
        $clientes->delete();
        return redirect()->route('agenda.index');
    }
}
