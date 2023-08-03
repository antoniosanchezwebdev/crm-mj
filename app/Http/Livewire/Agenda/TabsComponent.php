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
        if($this->tab == null){
            $this->tab = "tab3";
        }
        if($this->tab == "tab2" && $this->evento == null){
            $this->tab = "tab3";
        }
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
