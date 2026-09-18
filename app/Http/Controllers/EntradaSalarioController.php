<?php

namespace App\Http\Controllers;

use App\Models\EntradaSalario;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EntradaSalarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $entradasSalarios = EntradaSalario::get();

            return view('salario.index', compact('entradasSalarios'));
        }
        catch (\Exception $ex) {
            Alert::toast('Erro ao carregar os lançamentos.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EntradaSalario $entradaSalario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EntradaSalario $entradaSalario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EntradaSalario $entradaSalario)
    {
        //
    }
}
