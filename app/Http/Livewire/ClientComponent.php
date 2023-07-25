<?php

namespace App\Http\Livewire;
use App\Models\Cliente;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ClientComponent extends Component
{

    protected $clientes;
    public $nombre;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pagina = 10;

    public function render()
    {
        if($this->nombre != ""){
            $this->clientes = Cliente::where('nombre', 'LIKE', '%' . $this->nombre . '%')->orWhere('dni', 'LIKE', '%' . $this->nombre . '%')->paginate($this->pagina);
        }else{
            $this->clientes = Cliente::paginate($this->pagina);
        }

        return view('livewire.clients.client-component', [
            'clientes' => $this->clientes
        ]);
    }


}
