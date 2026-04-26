<?php

namespace App\Http\Controllers;

use App\Models\TipoCategoria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TipoCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tipoCategorias = TipoCategoria::get();

            return view('config.tipo-categoria.index', compact('tipoCategorias'));
        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
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
     * Display the specified resource.
     */
    public function show(TipoCategoria $tipoCategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoCategoria $tipoCategoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoCategoria $tipoCategoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $tipoCategoria = TipoCategoria::findOrFail($id);
            $tipoCategoria->delete();

            Alert::toast('Tipo de Categoria excluído com sucesso!','success');
            return redirect()->route('configuracao.tipo_categoria.index');

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back();
        }
    }
}
