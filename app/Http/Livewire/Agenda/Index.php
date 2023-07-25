<?php

namespace App\Http\Livewire\Agenda;

use App\Models\Evento;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $eventos;

    public function mount()
    {
        $this->eventos = Evento::all();
    }
    public function render()
    {
        return view('livewire.agenda.index');
    }
}
