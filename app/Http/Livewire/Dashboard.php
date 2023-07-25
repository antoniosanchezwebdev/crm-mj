<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use App\Models\OrdenLog;
use App\Models\OrdenTrabajo;
use App\Models\Productos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{

    public $tareas_no_completadas;
    public $tareas_completadas;
    public $tareas_facturadas;
    public $tareas_en_curso;

    public $tab = "tab1";

    public $productos;

    public function mount()
    {
        $this->tareas_en_curso = Evento::all();
        $this->tareas_no_completadas = Auth::user()->tareas->where('estado', 'Asignada');
        $this->productos = Productos::all();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }

    public function iniciarTarea($tareaId, $trabajadorId)
    {
        $log = new OrdenLog();

        $log->tarea_id = $tareaId;
        $log->trabajador_id = $trabajadorId;
        $log->fecha_inicio = Carbon::now();
        $log->estado = "En curso";

        $log->save();

        return redirect(request()->header('Referer'));
    }

    public function pausarTarea($tareaId, $trabajadorId)
    {
        $log = OrdenLog::where('tarea_id', $tareaId)
            ->where('trabajador_id', $trabajadorId)
            ->where('estado', "En curso")
            ->whereNull('fecha_fin')
            ->orderBy('fecha_inicio', 'desc')
            ->first();

        if ($log) {
            $log->fecha_fin = Carbon::now();
            $log->estado = "Pausa";
            $log->save();
        }

        $totalMinutes = $this->tiempoTotalTrabajado($tareaId, $trabajadorId);

        $tarea = OrdenTrabajo::find($tareaId);
        if ($tarea->operarios_tiempo != null && !empty($tarea->operarios_tiempo) && $tarea->operarios_tiempo != '"\"[]\""') {
            $operarios_tiempo = json_decode($tarea->operarios_tiempo, true); // Convierte el string JSON a un array

            // Actualiza el tiempo trabajado por el operario
            $operarios_tiempo[$trabajadorId] = $totalMinutes;

            // Guarda los cambios
            $tarea->operarios_tiempo = json_encode($operarios_tiempo); // Convierte el array a un string JSON
            $tarea->save();
        } else {

            // Actualiza el tiempo trabajado por el operario
            $operarios_tiempo = [$trabajadorId => $totalMinutes];

            // Guarda los cambios
            $tarea->operarios_tiempo = json_encode($operarios_tiempo); // Convierte el array a un string JSON
            $tarea->save();
        }

        return redirect(request()->header('Referer'));
    }

    public function tiempoTotalTrabajado($tareaId, $trabajadorId)
    {
        $logs = OrdenLog::where('tarea_id', $tareaId)
            ->where('trabajador_id', $trabajadorId)
            ->get();

        $totalMinutes = 0;

        foreach ($logs as $log) {
            $start = new Carbon($log->fecha_inicio);
            $end = $log->fecha_fin ? new Carbon($log->fecha_fin) : Carbon::now();

            $totalMinutes += $end->diffInSeconds($start);
        }

        return $totalMinutes;
    }

    public function calcularTiempo($tiempo)
    {
        $stringFinal = "";
        $tiempoHoras = 0;
        $tiempoMinutos = 0;

        if ($tiempo > 60) {
            $tiempoMinutos = floor($tiempo / 60);
            $tiempo = floor($tiempo % 60);
            if ($tiempoMinutos > 60) {
                $tiempoHoras = floor($tiempoMinutos / 60);
                $tiempoMinutos = floor($tiempoMinutos % 60);
            }
        }

        if (!$tiempoHoras) {
            if (!$tiempoMinutos) {
                if ($tiempo < 10) {
                    $stringSegundos = "0" . $tiempo;
                } else {
                    $stringSegundos =  $tiempo;
                }
                $stringFinal = "00:00:" . $stringSegundos;
            } else {
                if ($tiempo < 10) {
                    $stringSegundos = "0" . $tiempo;
                } else {
                    $stringSegundos =  $tiempo;
                }

                if ($tiempoMinutos < 10) {
                    $stringMinutos = "0" . $tiempoMinutos;
                } else {
                    $stringMinutos =  $tiempoMinutos;
                }

                $stringFinal = "00:" . $stringMinutos . ":" . $stringSegundos;
            }
        } else {
            if ($tiempo < 10) {
                $stringSegundos = "0" . $tiempo;
            } else {
                $stringSegundos =  $tiempo;
            }

            if ($tiempoMinutos < 10) {
                $stringMinutos = "0" . $tiempoMinutos;
            } else {
                $stringMinutos =  $tiempoMinutos;
            }
            if ($tiempoHoras < 10) {
                $stringHoras = "0" . $tiempoHoras;
            } else {
                $stringHoras =  $tiempoHoras;
            }

            $stringFinal = $stringHoras . ":" . $stringMinutos . ":" . $stringSegundos;
        }
        return $stringFinal;
    }


    public function completarTarea($tareaId)
    {
        $tarea = OrdenTrabajo::find($tareaId);
        $tarea->estado = "Completada";
        $tarea->save();
    }
    public function redirectToCaja($tarea, $metodo_pago)
    {
        session()->flash('tarea', $tarea);
        session()->flash('metodo_pago', $metodo_pago);

        return redirect()->route('caja.index');
    }

    public function cambioTab($tab)
    {
        $this->tab = $tab;
    }
}
