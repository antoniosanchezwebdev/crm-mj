<?php

namespace App\Http\Livewire\Agenda;

use App\Models\Cliente;
use App\Models\Evento;
use App\Models\Inmuebles;
use App\Models\Intereses;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;

    public $titulo;
    public $descripcion;
    public $fecha;
    public $cliente_id;
    public $clientes;

    public function mount()
    {
        $this->clientes = Cliente::all();
    }

    // Renderizado del Componente
    public function render()
    {
        return view('livewire.agenda.create');
    }

    public function submit()
    {
        $validatedData = $this->validate(
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
        $eventoSave = Evento::create($validatedData);

        // Alertas de guardado exitoso
        if ($eventoSave) {
            $this->alert('success', '¡Cita agendada correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la cita en la agenda!', [
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
        return redirect()->route('agenda.index');
    }
}
