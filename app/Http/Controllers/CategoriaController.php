<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use App\Models\TipoCategoria;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categorias = Categoria::get();
            $tipoCategorias = TipoCategoria::get();

            return view('config.categoria.index', compact('categorias', 'tipoCategorias'));
        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaRequest $request)
    {
        try {
            Categoria::create($request->validated() + [
                'cadastrado_por_usuario' => Auth::user()->id,
            ]);

            Alert::toast('Categoria cadastrado com sucesso!','success');
            return redirect()->route('configuracao.categoria.index');

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back();
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaRequest $request, $id)
    {
        try {
            $categoria = Categoria::findOrFail($id);
            $categoria->update($request->validated());

            Alert::toast('Categoria atualizado com sucesso!','success');
            return redirect()->route('configuracao.categoria.index');
        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $categoria = Categoria::findOrFail($id);
            $categoria->delete();

            Alert::toast('Categoria excluído com sucesso!','success');
            return redirect()->route('configuracao.categoria.index');

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back();
        }
    }
}
