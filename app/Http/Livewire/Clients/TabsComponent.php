<?php

namespace App\Http\Livewire\Clients;

use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class TabsComponent extends Component
{
    protected $listeners = ['seleccionarProducto' => 'selectProducto'];

    public $tab = "tab1";
    public $cliente;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
    }
    public function render()
    {

        return view('livewire.clients.tabs-component');
    }

    public function cambioTab($tab)
    {
        $this->tab = $tab;
    }
    public function selectProducto($cliente)
    {
        $this->cliente = $cliente;
        $this->tab = "tab2";
    }
}
