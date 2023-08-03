<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $alertas = [];
        $tab = $request->query('tab');      // $user = Auth::user();

        return view('agenda.index', compact('alertas', 'tab'));
    }
}
