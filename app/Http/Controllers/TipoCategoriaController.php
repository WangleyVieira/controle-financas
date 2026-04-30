<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoCategoriaRequest;
use App\Models\TipoCategoria;
use Illuminate\Support\Facades\Auth;
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
     * Store a newly created resource in storage.
     */
    public function store(TipoCategoriaRequest $request)
    {
        try {
            TipoCategoria::create($request->validated() + [
                'cadastrado_por_usuario' => Auth::user()->id,
            ]);

            Alert::toast('Tipo de Categoria cadastrado com sucesso!','success');
            return redirect()->route('configuracao.tipo_categoria.index');
        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoCategoriaRequest $request, $id)
    {
        try {
            $tipoCategoria = TipoCategoria::findOrFail($id);
            $tipoCategoria->update($request->validated());

            Alert::toast('Tipo de Categoria atualizado com sucesso!','success');
            return redirect()->route('configuracao.tipo_categoria.index');
        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back()->withInput();
        }
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
