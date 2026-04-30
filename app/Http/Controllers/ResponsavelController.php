<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResponsavelRequest;
use App\Models\Responsavel;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ResponsavelController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $responsaveis = Responsavel::get();

            return view('config.responsavel.index', compact('responsaveis'));
        }
        catch (\Exception $ex) {
            return $ex->getMessage();
            // Alert::toast('Erro! Contate o administrador do sistema.','error');
            // return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResponsavelRequest $request)
    {
        try {
            Responsavel::create($request->validated() + [
                'cadastrado_por_usuario' => Auth::user()->id,
            ]);

            Alert::toast('Responsável cadastrado com sucesso!','success');
            return redirect()->route('configuracao.responsavel.index');
        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResponsavelRequest $request, $id)
    {
        try {
            $responsavel = Responsavel::findOrFail($id);
            $responsavel->update($request->validated());

            Alert::toast('Responsável atualizado com sucesso!','success');
            return redirect()->route('configuracao.responsavel.index');
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
            $responsavel = Responsavel::findOrFail($id);
            $responsavel->delete();

            Alert::toast('Responsável excluído com sucesso!','success');
            return redirect()->route('configuracao.responsavel.index');

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.','error');
            return redirect()->back();
        }
    }
}
