<?php

namespace App\Http\Controllers;

use App\Http\Requests\LancamentoRequest;
use App\Models\Categoria;
use App\Models\Lancamento;
use App\Models\Responsavel;
use App\Models\TipoCategoria;
use RealRashid\SweetAlert\Facades\Alert;

class LancamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $lancamentos = Lancamento::get();

            return view('lancamento.index', compact('lancamentos'));

        } catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categorias = Categoria::get();
            $tipoCategorias = TipoCategoria::get();
            $responsaveis = Responsavel::get();

            return view('lancamento.form', compact('categorias', 'tipoCategorias', 'responsaveis'));

        } catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LancamentoRequest $request)
    {
        try {
            Lancamento::create($request->validated());

            Alert::toast('Lancamento cadastrado com sucesso!', 'success');
            return redirect()->route('lancamento.index');

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $lancamento = Lancamento::findOrFail($id);
            $categorias = Categoria::get();
            $tipoCategorias = TipoCategoria::get();
            $responsaveis = Responsavel::get();

            return view('lancamento.form', compact('lancamento', 'categorias', 'tipoCategorias', 'responsaveis'));

        } catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LancamentoRequest $request, $id)
    {
        try {
            $lancamento = Lancamento::findOrFail($id);
            $lancamento->update($request->validated());

            Alert::toast('Lancamento atualizado com sucesso!', 'success');
            return redirect()->route('lancamento.index');

        }
        catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $lancamento = Lancamento::findOrFail($id);
            $lancamento->delete();

            Alert::toast('Lancamento excluído com sucesso!', 'success');
            return redirect()->route('lancamento.index');

        } catch (\Exception $ex) {
            Alert::toast('Erro! Contate o administrador do sistema.', 'error');
            return redirect()->back();
        }
    }
}
