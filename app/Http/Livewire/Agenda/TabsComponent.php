<?php

namespace App\Http\Livewire\Agenda;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TabsComponent extends Component
{
    protected $listeners = ['seleccionarProducto' => 'selectProducto'];
    public $tab = "tab3";
    public $evento;

    public function render()
    {
        return view('livewire.agenda.tabs-component');
    }

    public function cambioTab($tab)
    {
        $this->tab = $tab;
    }

    public function selectProducto($evento)
    {

        $this->evento = $evento;
        $this->tab = "tab2";
    }
}
